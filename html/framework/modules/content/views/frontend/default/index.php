<?php

/* @var $this \yii\web\View */

/* @var $dto \krok\content\dto\frontend\ContentDto */

use tina\html\widgets\HtmlWidget;
use yii\helpers\Url;

$this->title = $dto->getTitle();

$this->registerMetaTag(['name' => 'keywords', 'content' => $dto->getKeywords()]);
$this->registerMetaTag(['name' => 'description', 'content' => $dto->getDescription()]);
?>
<section class="section-top bg-gray">
    <div class="fix-bg"></div>

    <div class="container block-prime">
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <img class="logo" src="/static/default/img/logo.png">
            </div>
            <?php /*<div class="col-xs-12 col-sm-4">
                <div class="card-stat">
                    <div class="card-stat__content">
                        <p class="date">1 июня 2018 года</p>
                        <div class="stat-box">
                            <div class="stat-box__head">92565</div>
                            <div class="stat-box__text">человек приняло участие в разработке стратегии</div>
                        </div>
                    </div>
                </div>
            </div> */ ?>
        </div>
    </div>

    <div class="container block-blockout">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="autor-wrap">
                    <img class="autor" src="/static/default/img/fish/governer.png">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
                <div class="blockout-content">
                    <i class="icon-blockuot"></i>
                    <div class="more-block-wrap">
                        <div class="more-block">
                            <div class="more-block__text" data-hei="90">
                                <?= $dto->getText(); ?>
                            </div>
                        </div>
                        <span class="more-link">Читать далее</span>
                    </div>
                    <div class="blockout-content__user-name">
                        <div class="name">ГЛЕБ Никитин</div>
                        <div class="descr">Врио Губернатора Нижегородской области</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php /* <div class="container block-pr-chuse">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="pr-chuse-card">
                    ПРИМИ УЧАСТИЕ <br/>В ОПРОСЕ
                    <img src="/static/default/img/check.jpg">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="pr-chuse-card">
                    ПРЕДЛОЖИ <br/>СВОЮ ИДЕЮ
                    <img src="/static/default/img/bulb.jpg">
                </div>
            </div>
        </div>
        <img class="arr-logo" src="/static/default/img/arr-logo.svg">
    </div> */ ?>

</section>

<section class="section-strategy bg-gray">
    <div class="container">
        <h2 class="section-head">
            <img class="header-logo" src="/static/default/img/arr-logo.svg">
            <span class="col-prime">Стратегия:</span><br/><span class="col-sub">Ключевые направления</span>
        </h2>
        <div class="more-block-wrap">
            <div class="more-block">
                <div class="more-block__text" data-hei="135">
                    <?= HtmlWidget::widget([
                        'name' => 'strategy_short_text',
                    ]); ?>
                </div>
            </div>
            <span class="more-link">Читать далее</span>
        </div>

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
</section>
<section class="section-news bg-gray">
    <?= \app\modules\news\widgets\MainPageNewsWidget::widget(); ?>

    <?php /* <div class="block-discus container">
        <h2 class="section-head">
            <img class="header-logo" src="/static/default/img/arr-logo.svg">
            <span class="col-prime">ПРИМИ УЧАСТИЕ В ОБСУЖДЕНИИ:</span><br/><span class="col-sub">ГРАФИК СТРАТЕГИЧЕСКИХ СЕССИЙ</span>
        </h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat.</p>
        <div class="slider-discus-wrap">
            <div class="slider-discus">
                <div class="slider-discus__ell">
                    <a href="#" class="discus-card">
                        <div class="discus-card__content">
                            <h4 class="name">Арзамас</h4>
                            <p class="text"><span class="t-prime">Тема:</span> Арзамасские гуси и их применение в
                                сельском хозяйстве</p>
                            <p class="text"><span class="t-prime">МЕСТО ПРОВЕДЕНИЯ:</span><br/>ДК г. Арзамаза, ул.
                                Юбилейная, д. 5</p>
                            <p class="text"><span class="t-prime">ВРЕМЯ:</span> 10:00 — 16:00</p>
                        </div>
                        <div class="discus-card__date">15 июня</div>
                    </a>
                </div>
                <div class="slider-discus__ell">
                    <a href="#" class="discus-card">
                        <div class="discus-card__content">
                            <h4 class="name">Арзамас</h4>
                            <p class="text"><span class="t-prime">Тема:</span> Арзамасские гуси и их применение в
                                сельском хозяйстве</p>
                            <p class="text"><span class="t-prime">МЕСТО ПРОВЕДЕНИЯ:</span><br/>ДК г. Арзамаза, ул.
                                Юбилейная, д. 5</p>
                            <p class="text"><span class="t-prime">ВРЕМЯ:</span> 10:00 — 16:00</p>
                        </div>
                        <div class="discus-card__date">16 июля</div>
                    </a>
                </div>
                <div class="slider-discus__ell">
                    <a href="#" class="discus-card">
                        <div class="discus-card__content">
                            <h4 class="name">Арзамас</h4>
                            <p class="text"><span class="t-prime">Тема:</span> Арзамасские гуси и их применение в
                                сельском хозяйстве</p>
                            <p class="text"><span class="t-prime">МЕСТО ПРОВЕДЕНИЯ:</span><br/>ДК г. Арзамаза, ул.
                                Юбилейная, д. 5</p>
                            <p class="text"><span class="t-prime">ВРЕМЯ:</span> 10:00 — 16:00</p>
                        </div>
                        <div class="discus-card__date">1 августа</div>
                    </a>
                </div>
                <div class="slider-discus__ell">
                    <a href="#" class="discus-card">
                        <div class="discus-card__content">
                            <h4 class="name">Арзамас</h4>
                            <p class="text"><span class="t-prime">Тема:</span> Арзамасские гуси и их применение в
                                сельском хозяйстве</p>
                            <p class="text"><span class="t-prime">МЕСТО ПРОВЕДЕНИЯ:</span><br/>ДК г. Арзамаза, ул.
                                Юбилейная, д. 5</p>
                            <p class="text"><span class="t-prime">ВРЕМЯ:</span> 10:00 — 16:00</p>
                        </div>
                        <div class="discus-card__date">15 июня</div>
                    </a>
                </div>
                <div class="slider-discus__ell">
                    <a href="#" class="discus-card">
                        <div class="discus-card__content">
                            <h4 class="name">Арзамас</h4>
                            <p class="text"><span class="t-prime">Тема:</span> Арзамасские гуси и их применение в
                                сельском хозяйстве</p>
                            <p class="text"><span class="t-prime">МЕСТО ПРОВЕДЕНИЯ:</span><br/>ДК г. Арзамаза, ул.
                                Юбилейная, д. 5</p>
                            <p class="text"><span class="t-prime">ВРЕМЯ:</span> 10:00 — 16:00</p>
                        </div>
                        <div class="discus-card__date">16 июля</div>
                    </a>
                </div>
                <div class="slider-discus__ell">
                    <a href="#" class="discus-card">
                        <div class="discus-card__content">
                            <h4 class="name">Арзамас</h4>
                            <p class="text"><span class="t-prime">Тема:</span> Арзамасские гуси и их применение в
                                сельском хозяйстве</p>
                            <p class="text"><span class="t-prime">МЕСТО ПРОВЕДЕНИЯ:</span><br/>ДК г. Арзамаза, ул.
                                Юбилейная, д. 5</p>
                            <p class="text"><span class="t-prime">ВРЕМЯ:</span> 10:00 — 16:00</p>
                        </div>
                        <div class="discus-card__date">1 августа</div>
                    </a>
                </div>
            </div>
            <div class="slider-nav">
                <div class="slide-prew slide-arrow"><i class="icon-arrow-left"></i></div>
                <div class="slide-next slide-arrow"><i class="icon-arrow-right"></i></div>
            </div>
        </div>
        <a href="#" class="btn btn-prime">Все стратегические сессии</a>
    </div> */ ?>
</section>

<section class="section-maind bg-gray">
    <div class="block-maind container">
        <?= \app\modules\review\widgets\ReviewWidget::widget(); ?>
    </div>
</section>

<section class="section-expert bg-gray">
    <?= \app\modules\expert\widgets\ExpertWidget::widget(); ?>

    <?php /*<div class="block-comment container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 mr-base">
                <div class="card-all-comment">
                    <img class="card-all-comment__icon" src="/static/default/img/message.png">
                    <h4 class="card-all-comment__head">Последние<br/>комментарии</h4>
                    <p class="card-all-comment__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt.</p>
                    <a href="#" class="btn btn-white">все комментарии</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mr-base">
                <div class="card-comment">
                    <div class="card-comment__top">
                        <span class="name">ЮРИЙ</span>
                        <span class="date">10:30  28 мая 2018</span>
                    </div>
                    <div class="card-comment__content">
                        <h4 class="head">Человеческий капитал</h4>
                        <div class="text">Мера денег 1 энергетический рубль = 1 джоуль. Количество денег сумма(энергия
                            ЕТЭБ + работа рабочих всех отраслей) за год. Энергия ЕТЭБ в джоулях. Работа - прожиточный
                            минимум души населения ...
                        </div>
                    </div>
                    <div class="card-comment__foot">
                        <a href="#" class="answer">Ответить</a>
                        <ul class="info-list">
                            <li>
                                <i class="icon-message"></i>
                                <span class="num">135</span>
                            </li>
                            <li>
                                <i class="icon-like"></i>
                                <span class="num">961</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mr-base">
                <div class="card-comment">
                    <div class="card-comment__top">
                        <span class="name">Михаил</span>
                        <span class="date">10:30  28 мая 2018</span>
                    </div>
                    <div class="card-comment__content">
                        <h4 class="head">Макроэкономика</h4>
                        <div class="text">Мера денег 1 энергетический рубль = 1 джоуль. Количество денег сумма(энергия
                            ЕТЭБ + работа рабочих всех отраслей) за год. Энергия ЕТЭБ в джоулях. Работа - прожиточный
                            минимум души населения ...
                        </div>
                    </div>
                    <div class="card-comment__foot">
                        <a href="#" class="answer">Ответить</a>
                        <ul class="info-list">
                            <li>
                                <i class="icon-message"></i>
                                <span class="num">135</span>
                            </li>
                            <li>
                                <i class="icon-like"></i>
                                <span class="num">961</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> */ ?>
</section>
