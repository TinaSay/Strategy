<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\expert\models\Expert */
?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'position')->textarea([
    'rows' => '3',
]) ?>

<?= $form->field($model, 'src')->fileInput(['accept' => 'image/jpeg, image/png']) ?>

<?= $form->field($model, 'hidden')->dropDownList($model::getHiddenList()) ?>

