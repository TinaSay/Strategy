<?php

use app\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<main class="main-page">
    <?= $this->render('//parts/header'); ?>
    <!-- content -->
    <?= $content; ?>
    <!-- /content -->
    <?= $this->render('//parts/footer'); ?>
</main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
