<?php

/* @var $query \app\modules\expert\models\Expert[] */

$this->title = 'Эксперты';

?>
<?php if ($query): ?>
    <div class="block-expert-wrap">
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
    </div>
<?php endif; ?>
