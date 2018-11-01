<?php

namespace app\modules\news\models;

use app\behaviors\StorageBehavior\StorageBehavior;
use app\modules\auth\models\Auth;
use krok\extend\behaviors\CreatedByBehavior;
use krok\extend\behaviors\LanguageBehavior;
use krok\extend\behaviors\TagDependencyBehavior;
use krok\extend\behaviors\TimestampBehavior;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;
use krok\storage\dto\StorageDto;
use krok\storage\interfaces\StorageInterface;
use tina\metatag\behaviors\MetatagBehavior;
use tina\metatag\models\Metatag;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $announce
 * @property string $text
 * @property string $date
 * @property integer $hidden
 * @property string $language
 * @property integer $createdBy
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Auth $createdByRelation
 * @mixin StorageBehavior
 */
class News extends \yii\db\ActiveRecord implements HiddenAttributeInterface, StorageInterface
{
    use HiddenAttributeTrait;

    /**
     * @var null|Metatag
     */
    public $meta;

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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'CreatedByBehavior' => CreatedByBehavior::class,
            'TimestampBehavior' => TimestampBehavior::class,
            'TagDependencyBehavior' => TagDependencyBehavior::class,
            'StorageBehaviorImage' => [
                'class' => StorageBehavior::class,
                'attribute' => 'src',
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
                'multiple' => true,
                'uploadedDirectory' => '/storage',
            ],
            'MetatagBehavior' => [
                'class' => MetatagBehavior::class,
                'metaAttribute' => 'meta',
            ],
            'LanguageBehavior' => LanguageBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['announce', 'text'], 'required'],
            [['announce', 'text'], 'string'],
            [['date', 'createdAt', 'updatedAt'], 'safe'],
            [['hidden', 'createdBy'], 'integer'],
            [['title'], 'string', 'max' => 256],
            [['language'], 'string', 'max' => 8],
            [
                ['createdBy'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Auth::class,
                'targetAttribute' => ['createdBy' => 'id']
            ],
            [
                ['src'],
                'image',
                'extensions' => 'png, jpg, jpeg',
                'maxFiles' => 10,
                'skipOnEmpty' =>
                    true
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
            'src' => 'Изображение',
            'title' => 'Заголовок',
            'announce' => 'Краткий текст',
            'text' => 'Полный текст',
            'date' => 'Дата публикации',
            'language' => 'Язык',
            'hidden' => 'Скрыта',
            'createdBy' => 'Создана',
            'createdAt' => 'Создана',
            'updatedAt' => 'Обновлена',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedByRelation()
    {
        return $this->hasOne(Auth::class, ['id' => 'createdBy']);
    }

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
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

}
