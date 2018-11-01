<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.10.15
 * Time: 21:20
 */

/* @var $tree [] */

use elfuvo\menu\models\Menu;
use yii\helpers\Html;
use yii\helpers\Url;

if (!empty($tree)) : ?>
    <div id="navbar" class="nav-wrap">
        <ul class="list-show nav-list clearfix">
            <?php foreach ($tree as $model): ?>
                <li class="nav-ell<?= isset($model['selected']) && $model['selected'] ? ' active' : '' ?>">
                    <?php if ($model['type'] == Menu::TYPE_VOID): ?>
                        <span class="menu-item"><?= Html::encode($model['title']) ?></span>
                    <?php elseif ($model['type'] == Menu::TYPE_LINK): ?>
                        <a class="menu-item" href="<?= $model['extUrl']; ?>"
                           target="_blank"><?= Html::encode($model['title']) ?></a>
                    <?php else: ?>
                        <a class="menu-item"
                           href="<?= Url::to(['/' . $model['url']]); ?>"><?= Html::encode($model['title']) ?></a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
            <li class="nav-ell dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-doots"></i></a>
                <div class="nav-mobile dropdown-menu">
                    <i class="icon-close"></i>
                    <ul class="list-hide dropdown-menu-list"></ul>
                </div>
            </li>
        </ul>
    </div>
<?php endif; ?>