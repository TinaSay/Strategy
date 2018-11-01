<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 05.06.18
 * Time: 18:16
 */

namespace app\modules\expert\widgets;

use app\modules\expert\models\Expert;
use yii\base\Widget;
use Yii;
use yii\caching\TagDependency;

/**
 * Class ExpertWidget
 *
 * @package app\modules\expert\widgets
 */
class ExpertWidget extends Widget
{
    /**
     * @var Expert[]
     */
    protected $list;

    public $limit = 4;

    public function init()
    {
        $key = [
            __METHOD__,
            Yii::$app->language,
            $this->limit,
        ];
        $dependency = new TagDependency([
            'tags' => [
                Expert::class,
            ],
        ]);

        if (($this->list = Yii::$app->cache->get($key)) === false) {
            $this->list = Expert::find()
                ->active()
                ->limit($this->limit)
                ->orderBy([Expert::tableName() . '.[[createdAt]]' => SORT_DESC])
                ->all();

            Yii::$app->cache->set($key, $this->list, 3600, $dependency);
        }
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('index', [
            'query' => $this->list,
        ]);
    }
}