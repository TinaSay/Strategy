<?php

/* @var $this yii\web\View */

/* @var $model app\modules\news\models\News */

/* @var $nextNewsId int|null */

use tina\html\widgets\HtmlWidget;
use yii\helpers\Url;

$this->title = $model->title;
?>
<div class="row">
    <div class="col-xs-12 col-md-9">
        <div class="text-content">
            <?php if ($model->getSrc()): ?>
                <div class="image-wrap">
                    <img alt="" src="<?= $model->getImagePreview('src', 'initial'); ?>">
                </div>
            <?php endif; ?>
            <p class="text-upper"><?= $model->title; ?></p>
            <div>
                <?= $model->text; ?>
            </div>
        </div>
        <?= HtmlWidget::widget([
            'name' => 'experts_list',
        ]); ?>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="card-date">
            <p class="name">Дата публикации</p>
            <p class="date"><?= Yii::$app->formatter->asDate($model->date); ?></p>
        </div>
        <?= $this->render('//parts/share-card'); ?>
    </div>
    <div class="col-xs-12">
        <div class="page-btn-wrap">
            <a href="<?= Url::to(['/news/default/index']) ?>" class="btn btn-border btn-prew"><i
                        class="icon-arrow-left"></i>Все новости</a>
            <?php if ($nextNewsId): ?>
                <a href="<?= Url::to(['/news/default/view', 'id' => $nextNewsId]); ?>" class="btn btn-border btn-next">следующая<i
                            class="icon-arrow-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>
