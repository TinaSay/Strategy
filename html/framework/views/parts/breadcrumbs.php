<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 31.05.18
 * Time: 17:30
 */

use app\modules\menu\widgets\BreadcrumbsWidget;
use yii\helpers\Url;

?>
<?= BreadcrumbsWidget::widget([
    'homeLink' => [
        'label' => 'Главная страница',
        'url' => Url::home(),
    ],
    'hideLastLink' => true,
    'options' => [
        'class' => 'breadcrumbs',
    ]
]); ?>
