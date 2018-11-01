<?php

use yii\helpers\Url;

/** @var $query \app\modules\expert\models\Expert[] */
?>
<div class="block-expert container">
    <h2 class="section-head">
        <img class="header-logo" src="/static/default/img/arr-logo-w.svg">
        Стратегия:<br/>ЭКСПЕРТы
    </h2>
    <?php if ($query): ?>
        <div class="row">
            <?php foreach ($query as $model): ?>
                <div class="col-xs-12 col-md-6 mr-base">
                    <div class="card-expert">
                        <?php if ($model->getSrc()): ?>
                            <div class="card-expert__image"
                                 style="background-image: url(<?= $model->getImage(); ?>);"></div>
                        <?php endif ?>
                        <div class="card-expert__name"><?= $model->name ?></div>
                        <div class="card-expert__text"><?= $model->position ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <? endif; ?>
    <a href="<?= Url::to(['/expert/expert/index']) ?>" class="btn btn-border">Все
        ЭКСПЕРТЫ</a>
</div>