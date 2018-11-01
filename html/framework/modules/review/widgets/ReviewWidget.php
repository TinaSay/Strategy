<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 05.06.18
 * Time: 15:33
 */

namespace app\modules\review\widgets;

use app\modules\review\models\Review;
use Yii;
use yii\base\Widget;
use yii\caching\TagDependency;

/**
 * Class ReviewWidget
 *
 * @package app\modules\review\widgets
 */
class ReviewWidget extends Widget
{

    /**
     * @var Review[]
     */
    protected $list;

    /**
     * @var int
     */
    public $limit = 6;

    public function init()
    {
        $key = [
            __METHOD__,
            Yii::$app->language,
            $this->limit,
        ];

        $dependency = new TagDependency([
            'tags' => [
                Review::class,
            ],
        ]);

        if (($this->list = Yii::$app->cache->get($key)) === false) {
            $this->list = Review::find()
                ->active()
                ->limit($this->limit)
                ->orderBy([Review::tableName() . '.[[createdAt]]' => SORT_DESC])
                ->all();

            Yii::$app->cache->set($key, $this->list, 3600, $dependency);
        }
    }

    public function run()
    {
        return $this->render('index', ['list' => $this->list]);
    }
}