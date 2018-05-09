<?php

namespace backend\assets;

use yii\web\AssetBundle;

class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
         'css/bootstrap.min.css',
         'css/bootstrap-responsive.min.css',
         'css/theme.css',
         'css/font-awesome.css',
        'css/fontawesome.min.css',
        'css/fontawesome.css',
        'css/fontawesome-all.css',
        'css/fontawesome-all.min.css',
        
        
    ];
    public $js = [
		'js/jquery-1.9.1.min.js',
       'js/bootstrap.min.js',
        'js/jquery-ui-1.10.1.custom.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


