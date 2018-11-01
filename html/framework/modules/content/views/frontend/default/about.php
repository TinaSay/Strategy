<?php

/* @var $this \yii\web\View */
/* @var $dto \krok\content\dto\frontend\ContentDto */

use yii\helpers\Url;

$this->title = $dto->getTitle();

$this->registerMetaTag(['name' => 'keywords', 'content' => $dto->getKeywords()]);
$this->registerMetaTag(['name' => 'description', 'content' => $dto->getDescription()]);
?>
<div class="row">
    <div class="col-xs-12 col-md-9">
        <div class="text-content">
            <?= $dto->getText(); ?>
        </div>
    </div>
    <div class="col-xs-12 col-md-3">
    </div>
    <div class="col-xs-12">
        <div class="sr-block-wrap">
            <div class="br-top"></div>
            <h3 class="sub-head">Ключевые направления</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <a href="#" class="str-block">
                        <div class="str-block__image">
                            <img src="/static/default/img/fish/ic-st-1.svg">
                        </div>
                        <div class="str-block__text">Продолжительность жизни и здоровье</div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <a href="#" class="str-block">
                        <div class="str-block__image">
                            <img src="/static/default/img/fish/ic-st-2.svg">
                        </div>
                        <div class="str-block__text">Комфортная среда проживания</div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <a href="#" class="str-block">
                        <div class="str-block__image">
                            <img src="/static/default/img/fish/ic-st-3.svg">
                        </div>
                        <div class="str-block__text">Цифровое общество и Люди будущего</div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <a href="#" class="str-block">
                        <div class="str-block__image">
                            <img src="/static/default/img/fish/ic-st-4.svg">
                        </div>
                        <div class="str-block__text">Технологический и промышленный потенциал</div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <a href="#" class="str-block">
                        <div class="str-block__image">
                            <img src="/static/default/img/fish/ic-st-5.svg">
                        </div>
                        <div class="str-block__text">Экономическое развитие</div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <a href="#" class="str-block">
                        <div class="str-block__image">
                            <img src="/static/default/img/fish/ic-st-6.svg">
                        </div>
                        <div class="str-block__text">Благосостояние людей</div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <a href="#" class="str-block">
                        <div class="str-block__image">
                            <img src="/static/default/img/fish/ic-st-7.svg">
                        </div>
                        <div class="str-block__text">Пространство и природные ресурсы</div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <a href="#" class="str-block">
                        <div class="str-block__image">
                            <img src="/static/default/img/fish/ic-st-8.svg">
                        </div>
                        <div class="str-block__text">Регион будущего</div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <a href="#" class="str-block">
                        <div class="str-block__image">
                            <img src="/static/default/img/fish/ic-st-9.svg">
                        </div>
                        <div class="str-block__text">Наша земля</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="page-btn-wrap">
            <a href="<?= Url::home(); ?>" class="btn btn-border btn-prew"><i class="icon-arrow-left"></i>Вернуться назад</a>
        </div>
    </div>
</div>
        
