<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 30.05.18
 * Time: 13:55
 */

namespace app\modules\news\widgets;

use app\modules\news\models\News;
use Yii;
use yii\base\Widget;
use yii\caching\TagDependency;

/**
 * Class MainPageNewsWidget
 * @package app\modules\news\widgets
 */
class MainPageNewsWidget extends Widget
{
    /**
     * @var News[]
     */
    protected $list;

    /**
     * @var int
     */
    public $limit = 3;

    /**
     *
     */
    public function init()
    {
        parent::init();

        $key = [
            __METHOD__,
            Yii::$app->language,
            $this->limit,
        ];

        $dependency = new TagDependency([
            'tags' => [
                News::class,
            ],
        ]);

        if (($this->list = Yii::$app->cache->get($key)) === false) {
            $this->list = News::find()
                ->active()
                ->limit($this->limit)
                ->orderBy([News::tableName() . '.[[date]]' => SORT_DESC])
                ->all();

            Yii::$app->cache->set($key, $this->list, 3600, $dependency);
        }
    }

    /**
     * @return string
     */
    public function run(): string
    {

        return $this->render('index', [
            'list' => $this->list,
        ]);
    }
}