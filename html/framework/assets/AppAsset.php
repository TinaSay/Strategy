<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot/static/default/';

    /**
     * @var string
     */
    public $baseUrl = '@web/static/default/';

    /**
     * @var array
     */
    public $css = [
        'css/icon.css',
        'css/slick.css',
        'css/main.css',
        'css/site.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/slick.js',
        'js/main.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
        BootstrapAsset::class,
    ];
}
