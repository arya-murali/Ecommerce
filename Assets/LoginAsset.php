<?php

namespace backend\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
         'css/bootstrap.min.css',
         'css/bootstrap-responsive.min.css',
         'css/theme.css',
         'css/font-awesome.css',  
    ];
    public $js = [
       // 'js/bootstrap.min.js',
       // 'js/jquery-1.9.1.min.js',
        //'js/jquery-ui-1.10.1.custom.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


