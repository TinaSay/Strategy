<?php

namespace app\behaviors\StorageBehavior;

use app\behaviors\StorageBehavior\services\CreateService;
use app\behaviors\StorageBehavior\services\DeleteService;
use krok\storage\adapters\FilesystemAdapter;
use krok\storage\behaviors\StorageBehavior as BaseStorageBehavior;
use krok\storage\dto\StorageDto;
use krok\storage\File;
use krok\storage\interfaces\StorageBehaviorInterface;
use krok\storage\interfaces\StorageInterface;
use krok\storage\services\FindService;
use League\Flysystem\FilesystemInterface;
use Yii;
use yii\base\Event;
use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Class StorageBehavior
 * @package app\behaviors\StorageBehavior
 */
class StorageBehavior extends BaseStorageBehavior implements StorageBehaviorInterface
{
    /*
     * @var boolean 
     */
    public $multiple = false;

    public function __construct(FilesystemInterface $filesystem, array $config = [])
    {
        $this->filesystem = $filesystem;
        parent::__construct($this->filesystem, $config);
    }

    public function init()
    {
        parent::init();
    }

    /**
     * @param Event $event
     */
    public function beforeValidate(Event $event)
    {
        /* @var $model StorageInterface|ActiveRecord */
        $model = $event->sender;

        if (!in_array($model->getScenario(), $this->scenarios)) {
            return;
        }

        if ($this->multiple === true) {
            $attribute = is_array($model->{$this->attribute}) ? $model->{$this->attribute} : [];
            if (!empty(current($attribute))) {
                $this->file = $attribute;
            } else {
                $this->file = UploadedFile::getInstances($model, $this->attribute);
            }

            if (!empty($this->file)) {
                foreach ($this->file as $key => &$file) {
                    if (!($file instanceof UploadedFile)) {
                        unset($this->file[$key]);
                    }
                }
                $model->{$this->attribute} = $this->file;
            }
        } else {
            if (($file = $model->{$this->attribute}) instanceof UploadedFile) {
                $this->file = $file;
            } else {
                $this->file = UploadedFile::getInstance($model, $this->attribute);
            }

            if ($this->file instanceof UploadedFile) {
                $model->{$this->attribute} = $this->file;
            }
        }
    }

    /**
     * @param Event $event
     */
    public function afterFind(Event $event)
    {
        /** @var StorageInterface|ActiveRecord $model */
        $model = $event->sender;

        $where = [
            'model' => $model->getModel(),
            'recordId' => $model->getRecordId(),
            'attribute' => $this->attribute,
        ];

        /** @var StorageDto $dto */
        $find = Yii::createObject(FindService::class, [$where]);
        $dto = $this->multiple === true ? $find->all() : $find->one();
        if (empty($dto)) {
            $dto = null;
        }

        $model->{$this->attribute} = $dto;
        Event::trigger(StorageBehaviorInterface::class, StorageBehaviorInterface::EVENT_AFTER_FIND, $event);
    }

    /**
     * @param Event $event
     */
    public function beforeSave(Event $event)
    {
        /* @var $model StorageInterface|ActiveRecord */
        $model = $event->sender;

        if (!in_array($model->getScenario(), $this->scenarios)) {
            if (!$model->getIsNewRecord()) {
                $this->delete($model, $event);
            }
            return;
        }

        if ($this->multiple === true) {
            foreach ($this->file as $key => &$file) {
                if (!($file instanceof UploadedFile)) {
                    unset($this->file[$key]);
                }
            }
            if (!empty($this->file)) {
                $model->{$this->attribute} = $this->file;
            } else {
                // Protect attribute
                unset($model->{$this->attribute});
            }
        } else {
            if ($this->file instanceof UploadedFile) {
                if (!$model->getIsNewRecord()) {
                    $this->delete($model, $event);
                }
                $model->{$this->attribute} = $this->file;
            } else {
                // Protect attribute
                unset($model->{$this->attribute});
            }
        }
    }

    /**
     * @param StorageInterface $model
     * @param Event $event
     */
    protected function delete(StorageInterface $model, Event $event)
    {
        $where = [
            'model' => $model->getModel(),
            'recordId' => $model->getRecordId(),
            'attribute' => $this->attribute,
        ];

        /** @var StorageDto $dto */
        $dto = Yii::createObject(FindService::class, [$where])->all();

        foreach ($dto as $item) {
            if ($item instanceof StorageDto) {
                $path = $this->uploadedDirectory . '/' . $item->getSrc();

                if ($this->filesystem->has($path)) {
                    $this->filesystem->delete($path);
                }

                Yii::createObject(DeleteService::class, [$where])->execute();
            }
        }

        Event::trigger(StorageBehaviorInterface::class, StorageBehaviorInterface::EVENT_BEFORE_DELETE, $event);
    }

    /**
     * @param Event $event
     */
    public function afterSave(Event $event)
    {
        /* @var $model StorageInterface|ActiveRecord */
        $model = $event->sender;

        if ($this->multiple === true) {
            $this->file = [];
            $attribute = is_array($model->{$this->attribute}) ? $model->{$this->attribute} : [];
            foreach ($attribute as $file) {
                if ($file instanceof UploadedFile) {
                    $this->file[] = $file;
                }
            }
            if (!empty($this->file)) {
                $model->{$this->attribute} = $this->file;
                $this->save($model, $event);
            }
        } else {
            if ($model->{$this->attribute} instanceof UploadedFile) {
                $this->save($model, $event);
            }
        }
    }

    /**
     * @param StorageInterface $model
     * @param Event $event
     */
    protected function save(StorageInterface $model, Event $event)
    {
        if ($this->multiple) {
            foreach ($model->{$this->attribute} as $file) {
                $this->saveFile($model, $file);
            }
        } else {
            $this->saveFile($model, $model->{$this->attribute});
        }

        Event::trigger(StorageBehaviorInterface::class, StorageBehaviorInterface::EVENT_AFTER_SAVE, $event);
    }

    /**
     * @param StorageInterface $model
     * @param UploadedFile $file
     */
    public function saveFile(StorageInterface $model, UploadedFile $file)
    {
        $path = $this->filesystem->getHashGrid($file->tempName, $file->extension);
        $resource = fopen($file->tempName, 'rb');
        if (is_string($path) && is_resource($resource)) {
            if ($this->filesystem->writeStream($this->uploadedDirectory . '/' . $path, $resource)) {

                $adapter = Yii::createObject(FilesystemAdapter::class, [$this->uploadedDirectory, $path]);
                $storageFile = Yii::createObject(File::class, [$adapter]);
                Yii::createObject(CreateService::class, [$model, $this->attribute, $storageFile, $file])->execute();
            }
        } else {
            throw new InvalidArgumentException('The specified directory could not be created.');
        }
    }

    /**
     * @param Event $event
     */
    public function beforeDelete(Event $event)
    {
        /** @var StorageInterface|ActiveRecord $model */
        $model = $event->sender;

        $this->delete($model, $event);
    }

    /**
     * @param StorageInterface $model
     * @param string $file
     * @param string $attribute
     * @return bool
     */
    public function deleteFile(StorageInterface $model, string $file, string $attribute)
    {
        $where = [
            'model' => $model->getModel(),
            'recordId' => $model->getRecordId(),
            'attribute' => $attribute,
            'src' => $file,
        ];

        /** @var StorageDto $dto */
        $dto = Yii::createObject(FindService::class, [$where])->one();

        if ($dto instanceof StorageDto) {
            $path = $this->uploadedDirectory . '/' . $dto->getSrc();

            if ($this->filesystem->has($path)) {
                $this->filesystem->delete($path);
            }

            return Yii::createObject(DeleteService::class, [$where])->execute();
        }

        return false;
    }

    /**
     * @param string $attribute
     * @param string $size
     * @param bool $all
     * @param bool $emptyStub
     * @return string
     */
    public function getImagePreview(string $attribute, string $size = 'list', $all = false, $emptyStub = true): string
    {
        $model = $this->owner;
        if ($model->{$attribute} !== null) {
            $config = Yii::$app->params['imageConfig'];

            $filesystem = Yii::createObject(FilesystemInterface::class);
            if (is_array($model->{$attribute})) {
                if ($all == false && isset($model->{$attribute}[0])) {
                    $file = $model->{$attribute}[0];
                    if ($file instanceof StorageDto) {
                        return $filesystem->getPublicUrl($file->getSrc(), $config[$size]);
                    }
                } else {
                    $result = '';
                    foreach ($model->{$attribute} as $file) {
                        if (!$file instanceof StorageDto) {
                            continue;
                        }
                        $result .= $filesystem->getPublicUrl($file->getSrc(), $config[$size]);
                    }
                    return $result;
                }
            } else {
                return $filesystem->getPublicUrl($model->{$attribute}->getSrc(), $config[$size]);
            }
        }
        return $emptyStub ? 'static/default/img/noimg.gif' : '';
    }

    /**
     * @param string $attribute
     * @param string $size
     * @return array
     */
    public function getImagePreviewLink(string $attribute, string $size = 'initial'): array
    {
        $model = $this->owner;
        if ($model->{$attribute} !== null) {
            $config = Yii::$app->params['imageConfig'];

            $filesystem = Yii::createObject(FilesystemInterface::class);
            if (is_array($model->{$attribute})) {
                $result = [];
                foreach ($model->{$attribute} as $file) {
                    if ($file instanceof StorageDto) {
                        $result[] = $filesystem->getPublicUrl($file->getSrc(), $config[$size]);
                    }
                }
                return $result;
            } else {
                if ($model->{$attribute} instanceof StorageDto) {
                    return [$filesystem->getPublicUrl($model->{$attribute}->getSrc(), $config[$size])];
                } else {
                    return [];
                }
            }
        } else {
            return [];
        }
    }

    /**
     * @param string $attribute
     * @return array
     */
    public function getImagePreviewConfig(string $attribute): array
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        if ($model->{$attribute} !== null) {
            $filesystem = \Yii::createObject(FilesystemInterface::class);
            if (is_array($model->{$attribute})) {
                $result = [];
                foreach ($model->{$attribute} as $file) {
                    if ($file instanceof StorageDto) {
                        $result[] = [
                            'caption' => $file->getTitle(),
                            //'type' => 'text',
                            'downloadUrl' => $filesystem->getPublicUrl($file->getSrc()),
                            'key' => $file->getSrc(),
                            'url' => Url::to([
                                'remove-file',
                                'id' => $model->primaryKey,
                                'attribute' => $attribute
                            ]),
                        ];
                    }
                }
                return $result;
            } else {
                if ($model->{$attribute} instanceof StorageDto) {
                    return [
                        [
                            'caption' => $model->{$attribute}->getTitle(),
                            //'type' => 'text',
                            'downloadUrl' => $filesystem->getPublicUrl($model->{$attribute}->getSrc()),
                            'key' => $model->{$attribute}->getSrc(),
                            'url' => Url::to([
                                'remove-file',
                                'id' => $model->primaryKey,
                                'attribute' => $attribute
                            ]),
                        ]
                    ];
                } else {
                    return [];
                }
            }
        } else {
            return [];
        }
    }

}
