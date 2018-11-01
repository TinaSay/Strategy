<?php

/* @var $this yii\web\View */
/* @var $list app\modules\news\models\News[] */

/* @var $pagination \yii\data\Pagination */

use yii\helpers\Url;

$this->title = 'Новости';

?>

<div class="row">
    <?php if ($list): ?>
        <?php foreach ($list as $model): ?>
            <div class="col-xs-12 col-md-4 mr-base">
                <div class="news-card-wrap">
                    <?= $this->render('//parts/share'); ?>
                    <a href="<?= Url::to(['/news/default/view', 'id' => $model->id]) ?>" class="news-card">
                        <?php if ($model->getSrc()): ?>
                            <div class="news-card__image"
                                 style="background-image: url('<?= $model->getImagePreview('src'); ?>');"></div>
                        <?php endif; ?>

                        <div class="news-card__cont">
                            <div class="news-card__text">
                                <?= $model->title; ?>
                            </div>
                            <div class="news-card__config">
                                <span class="date"><?= Yii::$app->formatter->asDate($model->date); ?></span>
                                <div class="sheare-block"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->render('//parts/pagination', ['pagination' => $pagination]); ?>



