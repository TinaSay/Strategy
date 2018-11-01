<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 05.06.18
 * Time: 14:39
 */

namespace app\modules\review\controllers\frontend;

use app\modules\review\models\Review;
use krok\system\components\frontend\Controller;
use yii\data\Pagination;


/**
 * Class DefaultController
 *
 * @package app\modules\review\controllers\frontend
 */
class DefaultController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = Review::find()->active();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $list = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['createdAt' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'list' => $list,
            'pagination' => $pages,
        ]);
    }

}