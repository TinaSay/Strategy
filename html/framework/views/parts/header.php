<?php

/** @var $this yii\web\View */
?>
<section class="section-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-8 col-md-9">
                <?= \elfuvo\menu\widgets\MenuWidget::widget([
                    'view' => '@app/modules/menu/widgets/views/main'
                ]) ?>
            </div>
            <?php /*<div class="col-xs-8 col-sm-4 col-md-3">
                <a href="#" class="btn btn-sub">Личный кабинет</a>
            </div> */ ?>
        </div>
    </div>
</section>
