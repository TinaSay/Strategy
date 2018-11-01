<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 31.05.18
 * Time: 17:38
 */
/** @var $this yii\web\View */

/* @var $pagination yii\data\Pagination */

use app\widgets\pagination\LinkPager;

?>
<?php if ($pagination->getPageCount() > 1) : ?>
    <?= LinkPager::widget([
        'pagination' => $pagination,
        'maxButtonCount' => 5,
        'renderFormatter' => function ($page) {
            return is_int($page) ? sprintf('%02d', $page) : $page;
        },
    ]); ?>
<?php endif; ?>