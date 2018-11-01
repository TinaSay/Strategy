<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 30.05.18
 * Time: 13:58
 */

/** @var $this yii\web\View */

/** @var $list \app\modules\news\models\News[] */

use yii\helpers\Url;

?>
<?php if ($list): ?>
    <div class="block-news container">
        <h2 class="section-head">
            <img class="header-logo" src="/static/default/img/arr-logo-w.svg">
            НОВОСТИ
        </h2>
        <div class="row">
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
        </div>
        <a href="<?= Url::to(['/news/default/index']) ?>" class="btn btn-border">Все новости</a>
    </div>
<?php endif; ?>