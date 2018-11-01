<?php

namespace app\modules\expert\models;

use krok\extend\behaviors\TimestampBehavior;
use krok\extend\traits\HiddenAttributeTrait;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\behaviors\TagDependencyBehavior;
use krok\storage\behaviors\StorageBehavior;
use krok\storage\dto\StorageDto;
use krok\storage\interfaces\StorageInterface;
use League\Flysystem\FilesystemInterface;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "{{%expert}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $position
 * @property integer $hidden
 * @property string $createdAt
 * @property string $updatedAt
 */
class Expert extends \yii\db\ActiveRecord implements HiddenAttributeInterface, StorageInterface
{
    use HiddenAttributeTrait;

    /**
     * @var UploadedFile|StorageDto
     */
    private $src;

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
            'StorageBehaviorImage' => [
                'class' => StorageBehavior::class,
                'attribute' => 'src',
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
            ],
            'TagDependencyBehavior' => TagDependencyBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%expert}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['hidden'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['position'], 'string', 'max' => 255],
            [
                ['src'],
                'image',
                'extensions' => 'png, jpg, jpeg',
                'skipOnEmpty' => true,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'position' => 'Должность',
            'src' => 'Изображение',
            'hidden' => 'Скрыто',
            'createdAt' => 'Дата создания',
            'updatedAt' => 'Дата обновления',
        ];
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return static::class;
    }

    /**
     * @return int
     */
    public function getRecordId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return null;
    }

    /**
     * @return null|string
     */
    public function getHint(): ?string
    {
        return null;
    }

    /**
     * @param $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @return StorageDto|UploadedFile
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        if ($this->src instanceof StorageDto) {
            $filesystem = Yii::createObject(FilesystemInterface::class);
            return $filesystem->getPublicUrl($this->src->getSrc());
        }

        return '';
    }

    /**
     * @inheritdoc
     * @return ExpertQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExpertQuery(get_called_class());
    }
}
