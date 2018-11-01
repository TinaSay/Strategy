<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 05.06.18
 * Time: 14:42
 */
/** @var $this yii\web\View */
/** @var $list \app\modules\review\models\Review[] */
/** @var $pagination \yii\data\Pagination */

$this->title = 'Мнения';
?>
<?php if ($list): ?>
    <div class="block-maind-wrap">
        <div class="row">
            <?php foreach ($list as $model): ?>
                <div class="col-xs-12 col-md-6">
                    <div class="catd-maind">
                        <i class="icon-blockuot"></i>
                        <div class="more-block-wrap">
                            <div class="more-block">
                                <div class="more-block__text" data-hei="135">
                                    <div class="catd-maind__text">
                                        <?= $model->text; ?>
                                    </div>
                                </div>
                            </div>
                            <span class="more-link">Читать далее</span>
                        </div>
                        <div class="catd-maind__autor">
                            <?php if ($model->getSrc()): ?>
                                <div class="catd-maind__avatar"
                                     style="background-image: url('<?= $model->getImage(); ?>');"></div>
                            <?php endif; ?>
                            <div class="catd-maind__autor-name"><?= $model->name ?></div>
                            <div class="catd-maind__autor-position"><?= Yii::$app->formatter->asNtext($model->post); ?></div>
                            <?php /*<div class="catd-maind__autor-descr">ООО «КНАУФ ГИПС НОВОМОСКОВСК»</div>*/ ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?= $this->render('//parts/pagination', ['pagination' => $pagination]); ?>
