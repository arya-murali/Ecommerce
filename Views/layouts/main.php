<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags(); ?>      
        <link rel="icon" type="image/png" sizes="96x96" href="<?= Yii::$app->request->baseUrl; ?>/images/icon.png">
        <?php //echo $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => 'favicon.ico']); ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <?php $this->beginBody() ?>
        <div id="wrapper">
            <!-- NAVBAR -->

            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="brand">
                    <a href="<?= Yii::$app->request->baseUrl; ?>"><img src="<?= Yii::$app->request->baseUrl ?>/images/innerimg.png" alt="Gym logo" class="img-responsive logo"></a>
                </div>
                <div class="container-fluid">

                    <div class="navbar-btn">
                        <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                    </div>                    
                    <?php if (isset(Yii::$app->user->identity)) { ?>
                        <div id="navbar-menu">
                            <ul class="nav navbar-nav navbar-right">                          
                                <?php
                                $usermodel = backend\models\User::findOne(Yii::$app->user->id);
                                if (isset($usermodel->profile_image)) {
                                    $url1 = Yii::$app->request->baseUrl . '/uploads/user/' . $usermodel->profile_image;
                                } else {
                                    $url1 = Yii::$app->request->baseUrl . '/images/profile.png';
                                }
                                ?>  
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?= $url1 ?>" class="img-circle" alt="Avatar"> <span><?= Yii::$app->user->identity->username ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Url::to(['site/myprofile']); ?>"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <!--    <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                                        <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>-->
                                        <li><a href="<?php echo Url::to(['site/logout']); ?>" data-method="post"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </nav>           
            <!-- END NAVBAR -->
            <!-- LEFT SIDEBAR -->
            <?php if (isset(Yii::$app->user->identity)) { ?>
                <div id="sidebar-nav" class="sidebar nav-side-menu">
                    <div class="sidebar-scroll">
                        <div class="menu-list">
                            <nav>
                                <ul class="nav">
                                        <!--<li><a href="index.html" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>-->
                                    <li><a class="<?php echo (Yii::$app->controller->id == 'site') ? 'active' : '' ?>" href="<?php echo Url::to(['/site/index']); ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>    

                                    <?php if (Yii::$app->user->identity->user_role_id == 1 || Yii::$app->user->identity->user_role_id == 2) { ?>
                                        <li>
                                            <a class="<?php echo ((Yii::$app->controller->id == 'user') || (Yii::$app->controller->id == 'user-roles')) ? 'active' : '' ?>" href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user-icon"></i> <span>User</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                            <div id="subPages" class="collapse ">
                                                <ul class="nav">
                                                    <li><a data-method ="REQUEST" href="<?php echo Url::to(['/user']); ?>"><i class="lnr lnr-user_list"></i>User List</a></li>
                                                    <li><a data-method ="REQUEST" href="<?php echo Url::to(['/user-roles']); ?>"><i class="lnr lnr-user_role"></i>User Role</a></li> 
                                                </ul>
                                            </div>
                                        </li>
                                    <?php } ?>

                                    <li><a class="<?php echo (Yii::$app->controller->id == 'gym') ? 'active' : '' ?>" href="<?php echo Url::to(['/gym']); ?>"><i class="lnr lnr-gym"></i> <span>Gym</span></a></li>   
                                    <li><a class="<?php echo (Yii::$app->controller->id == 'packages') ? 'active' : '' ?>" href="<?php echo Url::to(['/packages']); ?>"><i class="lnr lnr-package"></i> <span>Packages</span></a></li> 
                                    <li><a class="<?php echo (Yii::$app->controller->id == 'categories') ? 'active' : '' ?>" href="<?php echo Url::to(['/categories']); ?>"><i class="lnr lnr-category"></i> <span>Categories</span></a></li>                                                                
                                    <li>
                                        <a class="<?php echo ((Yii::$app->controller->id == 'city-rates') || (Yii::$app->controller->id == 'package-rates') || (Yii::$app->controller->id == 'training-rates')) ? 'active' : '' ?>" href="#rating" data-toggle="collapse" class="collapsed"><i class="lnr lnr-rate"></i> <span>Rating system</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                        <div id="rating" class="collapse ">
                                            <ul class="nav">
                                                <li><a class="<?php echo (Yii::$app->controller->id == 'city-rates') ? 'active' : '' ?>" href="<?php echo Url::to(['/city-rates']); ?>"><i class="lnr lnr-city_rating"></i> <span>City Rating</span></a></li>   
                                                <li><a class="<?php echo (Yii::$app->controller->id == 'package-rates') ? 'active' : '' ?>" href="<?php echo Url::to(['/package-rates']); ?>"><i class="lnr lnr-package_rating"></i> <span>Package rating</span></a></li>   
    <!--                                            <li><a class="<?php echo (Yii::$app->controller->id == 'training-rates') ? 'active' : '' ?>" href="<?php echo Url::to(['/training-rates']); ?>"><i class="lnr lnr-training_rating"></i> <span>Training rating/Requests</span></a></li>   -->
                                            </ul>
                                        </div>
                                    </li>    
                                    <li>
                                        <a class="<?php echo ((Yii::$app->controller->id == 'training-booking') || (Yii::$app->controller->id == 'training')) ? 'active' : '' ?>" href="#trainingPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-training"></i> <span>Training</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                        <div id="trainingPages" class="collapse ">
                                            <ul class="nav">
                                                <li><a class="<?php echo (Yii::$app->controller->id == 'training') ? 'active' : '' ?>" href="<?php echo Url::to(['/training']); ?>"><i class="lnr lnr-training"></i> <span>Training Session</span></a></li>   
                                                <li><a class="<?php echo (Yii::$app->controller->id == 'training-booking') ? 'active' : '' ?>" href="<?php echo Url::to(['/training-booking']); ?>"><i class="lnr lnr-training_request"></i> <span>Training Booking/Requests</span></a></li>   
                                            </ul>
                                        </div>
                                    </li>    
                                    <li><a class="<?php echo (Yii::$app->controller->id == 'workout-history') ? 'active' : '' ?>" href="<?php echo Url::to(['/workout-history']); ?>"><i class="lnr lnr-workout"></i> <span>Work out History</span></a></li>     
                                    <li><a class="<?php echo (Yii::$app->controller->id == 'admin-settings') ? 'active' : '' ?>" href="<?php echo Url::to(['/admin-settings/view', 'id' => 1]); ?>"><i class="lnr lnr-settings"></i> <span>Settings</span></a></li>                                   
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- END LEFT SIDEBAR -->
            <!-- MAIN -->
            <div class="main">
                <!-- MAIN CONTENT -->
                <div class="main-content dashboard">
                    <?= $content ?>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
            <!-- END MAIN -->
            <div class="clearfix"></div>
            <footer>
                <div class="container-fluid">
                    <p class="copyright">&copy; 2017 <a href="https://www.unitybees.com" target="_blank">Gymemba | Unitybees</a>. All Rights Reserved.</p>
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->
        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>
<style type="text/css">


    .nav-side-menu {
        overflow: auto;
        font-family: verdana;
        font-size: 12px;
        font-weight: 200;
        background-color: #2e353d;
        position: fixed;
        top: 0px;
        width: 300px;
        height: 100%;
        color: #e1ffff;
    }
    .nav-side-menu .brand {
        background-color: #23282e;
        line-height: 50px;
        display: block;
        text-align: center;
        font-size: 14px;
    }
    .nav-side-menu .toggle-btn {
        display: none;
    }
    .nav-side-menu ul,
    .nav-side-menu li {
        list-style: none;
        padding: 0px;
        margin: 0px;
        line-height: 35px;
        cursor: pointer;
        /*    
          .collapsed{
             .arrow:before{
                       font-family: FontAwesome;
                       content: "\f053";
                       display: inline-block;
                       padding-left:10px;
                       padding-right: 10px;
                       vertical-align: middle;
                       float:right;
                  }
           }
        */
    }
    .nav-side-menu ul :not(collapsed) .arrow:before,
    .nav-side-menu li :not(collapsed) .arrow:before {
        font-family: FontAwesome;
        content: "\f078";
        display: inline-block;
        padding-left: 10px;
        padding-right: 10px;
        vertical-align: middle;
        float: right;
    }
    .nav-side-menu ul .active,
    .nav-side-menu li .active {
        border-left: 3px solid #d19b3d;
        background-color: #4f5b69;
    }
    .nav-side-menu ul .sub-menu li.active,
    .nav-side-menu li .sub-menu li.active {
        color: #d19b3d;
    }
    .nav-side-menu ul .sub-menu li.active a,
    .nav-side-menu li .sub-menu li.active a {
        color: #d19b3d;
    }
    .nav-side-menu ul .sub-menu li,
    .nav-side-menu li .sub-menu li {
        background-color: #181c20;
        border: none;
        line-height: 28px;
        border-bottom: 1px solid #23282e;
        margin-left: 0px;
    }
    .nav-side-menu ul .sub-menu li:hover,
    .nav-side-menu li .sub-menu li:hover {
        background-color: #020203;
    }    
    .nav-side-menu li .sub-menu li:before {
        font-family: FontAwesome;
        content: "\f105";
        display: inline-block;
        padding-left: 10px;
        padding-right: 10px;
        vertical-align: middle;
    }
    .nav-side-menu li {
        padding-left: 0px;
        border-left: 3px solid #2e353d;
        border-bottom: 1px solid #23282e;
    }
    .nav-side-menu li a {
        text-decoration: none;
        color: #e1ffff;
    }
    .nav-side-menu li a i {
        padding-left: 10px;
        width: 20px;
        padding-right: 20px;
    }
    .nav-side-menu li:hover {
        /*border-left: 3px solid #0081c2;*/
        background-color: #4f5b69;
        -webkit-transition: all 1s ease;
        -moz-transition: all 1s ease;
        -o-transition: all 1s ease;
        -ms-transition: all 1s ease;
        transition: all 1s ease;
    }
    @media (max-width: 767px) {
        .nav-side-menu {
            position: relative;
            width: 100%;
            margin-bottom: 10px;
        }
        .nav-side-menu .toggle-btn {
            display: block;
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 10 !important;
            padding: 3px;
            background-color: #ffffff;
            color: #000;
            width: 40px;
            text-align: center;
        }
        .brand {
            text-align: left !important;
            font-size: 22px;
            padding-left: 20px;
            line-height: 50px !important;
        }
    }
    @media (min-width: 767px) {
        .nav-side-menu .menu-list .menu-content {
            display: block;
        }
    }
    body {
        margin: 0px;
        padding: 0px;
    }
    .nav-side-menu li{
        padding-left: 0px !important;
    }
    .sidebar .nav > li > a{
        padding:5px 10px; 
    }
    .sidebar .nav .nav > li > a{
        padding: 0px !important;
    }
    .nav-side-menu ul .sub-menu li{
        padding-left: 20px !important;
    }
    .main-content {
        padding: 0px 15px !important;
    }
    .main-content.dashboard{
        padding: 10px 15px !important;
    }
</style>