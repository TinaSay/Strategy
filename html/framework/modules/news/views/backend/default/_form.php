<?php

use app\modules\news\models\News;
use kartik\file\FileInput;
use krok\editor\EditorWidget;
use tina\metatag\widgets\backend\MetatagWidget;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\news\models\News */
?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'src[]')->widget(FileInput::class, [
    'language' => 'ru',
    'options' => [
        'multiple' => true,
        'class' => 'fileinput',
        'accept' => 'image/jpeg, image/png'
    ],
    'pluginOptions' => [
        'initialPreview' => $model->getImagePreviewLink('src', 'list'),
        'initialPreviewAsData' => true,
        'initialPreviewConfig' => $model->getImagePreviewConfig('src'),
        'previewFileType' => 'any', //All file type preview
        'overwriteInitial' => false,
        'maxFileCount' => 10,
        'allowedFileExtensions' => ['jpg', 'png'],
        'showUpload' => false,//Don't show Load button
        'showRemove' => false,//Don't show Remove button
        'msgPlaceholder' => 'Выберите изображения',
        'fileActionSettings' => [
            'showDrag' => false,
            'showUpload' => false,
        ]
    ]
]); ?>

<?= $form->field($model, 'announce')->textarea(['maxlength' => true, 'rows' => true]); ?>

<?= $form->field($model, 'text')->widget(EditorWidget::class) ?>

<?= $form->field($model, 'date')->widget(
    DatePicker::class, [
    'dateFormat' => 'php:Y-m-d',
    'options' => [
        'class' => 'form-control',
    ],
]) ?>

<?= MetatagWidget::widget([
    'model' => $model->meta,
    'form' => $form,
]) ?>


<?= $form->field($model, 'hidden')->dropDownList(News::getHiddenList()) ?>
