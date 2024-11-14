<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'css/admin/my_main.css',
        'css/admin/ie.css',
        //'css/admin/login.css',
        'css/admin/pager.css',
        //'css/admin/print.css',
        'js/jquery/jqwidgets/styles/jqx.base.css',


    ];
    public $js = [
        'js/admin/main.js',
        'js/jquery/jqwidgets/jqxcore.js',
        'js/jquery/jqwidgets/jqxpanel.js',
        'js/jquery/jqwidgets/jqxscrollbar.js',
        //'js/admin/jquery-1.11.1.min.js',
        'js/jquery/jqwidgets/jqxbuttons.js'


    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        'yii\bootstrap5\BootstrapIconAsset',
    ];
}
