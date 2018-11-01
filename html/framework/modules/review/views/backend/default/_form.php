<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

/* @var $model app\modules\review\models\Review */

use krok\tinymce\TinyMceWidget;

?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'src')->fileInput(['accept' => 'image/jpeg, image/png']) ?>

<?= $form->field($model, 'post')->textarea(['maxlength' => true, 'rows' => 2]); ?>

<?= $form->field($model, 'text')->widget(TinyMceWidget::class) ?>

<?= $form->field($model, 'hidden')->dropDownList($model::getHiddenList()) ?>
