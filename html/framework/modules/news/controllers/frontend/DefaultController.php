<?php

namespace app\modules\news\controllers\frontend;

use app\modules\news\models\News;
use krok\system\components\frontend\Controller;
use tina\metatag\components\Metatag;
use yii\base\Module;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

/**
 * Class DefaultController
 *
 * @package app\modules\news\controllers\frontend
 */
class DefaultController extends Controller
{
    /**
     * @var Metatag
     */
    protected $component;

    /**
     * DefaultController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param Metatag $component
     * @param array $config
     */
    public function __construct(string $id, Module $module, Metatag $component, array $config = [])
    {
        $this->component = $component;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = News::find()->active();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 9]);
        $list = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['createdAt' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'list' => $list,
            'pagination' => $pages,
        ]);
    }

    /**
     * @param $id
     *
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->component->metatagComposer($model->meta, $model->title);

        $nextNewsId = News::find()->select(['id'])
            ->active()
            ->andWhere([
                '>=',
                'date',
                $model->date
            ])->andWhere([
                '!=',
                'id',
                $model->id
            ])->scalar();

        return $this->render('view', [
            'model' => $model,
            'nextNewsId' => $nextNewsId,
        ]);

    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne(['id' => $id, 'hidden' => News::HIDDEN_NO])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
