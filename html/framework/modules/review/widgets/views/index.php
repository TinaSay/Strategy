<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 05.06.18
 * Time: 15:39
 */

/** @var $this yii\web\View */

/** @var $list \app\modules\review\models\Review[] */

use yii\helpers\Url;

?>
<?php if ($list): ?>
    <h2 class="section-head">
        <img class="header-logo" src="/static/default/img/arr-logo.svg">
        <span class="col-prime">Стратегия:</span><br/><span
                class="col-sub">МНЕНИЯ</span>
    </h2>
    <div class="slider-maind-wrap">
        <div class="slider-maind">
            <?php foreach ($list as $model): ?>
                <div class="slider-maind__ell">
                    <div class="catd-maind">
                        <i class="icon-blockuot"></i>
                        <div class="catd-maind__text">
                            <?= $model->text; ?>
                        </div>
                        <div class="catd-maind__autor">
                            <<?php if ($model->getSrc()): ?>div class="catd-maind__avatar"
                                                                style="background-image: url('<?= $model->getImage(); ?>');"></div><?php endif; ?>
                            <div class="catd-maind__autor-name"><?= $model->name; ?></div>
                            <div class="catd-maind__autor-position"><?= Yii::$app->formatter->asNtext($model->post); ?></div>
                            <?php /*<div class="catd-maind__autor-descr">ООО «КНАУФ ГИПС НОВОМОСКОВСК»</div> */ ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="slider-nav">
            <div class="slide-prew slide-arrow"><i class="icon-arrow-left"></i></div>
            <div class="slide-next slide-arrow"><i class="icon-arrow-right"></i></div>
        </div>
    </div>
    <a href="<?= Url::to(['/review']) ?>" class="btn btn-prime">Все МНЕНИЯ</a>
<?php endif; ?>