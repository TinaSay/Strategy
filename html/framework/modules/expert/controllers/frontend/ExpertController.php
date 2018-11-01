<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 05.06.18
 * Time: 17:42
 */

namespace app\modules\expert\controllers\frontend;

use app\modules\expert\models\Expert;
use krok\system\components\frontend\Controller;

/**
 * Class ExpertController
 *
 * @package app\modules\expert\controllers\frontend
 */
class ExpertController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = Expert::find()->active()->limit(100)->all();
        return $this->render('index', [
            'query' => $query,
        ]);
    }
}
