<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content">
    <div class="header">
        <div class="logo text-center"><img src="<?= Yii::$app->request->baseUrl ?>/images/icon_logo.png" alt="Gymemba Logo"></div>
        <p class="lead">Login to your account</p>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="form-group">
        <!-- <label for="signin-email" class="control-label sr-only">Email</label>
        <input type="email" class="form-control" id="signin-email" value="samuel.gold@domain.com" placeholder="Email">-->
        <?php
        echo $form->field($model, 'username', [
            'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control transparent']
        ])->textInput()->input('username', ['placeholder' => "Username"])->label(false);
        ?>
    </div>
    <div class="form-group">
        <!--                                        <label for="signin-password" class="control-label sr-only">Password</label>
                                                <input type="password" class="form-control" id="signin-password" value="thisisthepassword" placeholder="Password">-->
        <?php
        echo $form->field($model, 'password', [
            'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control transparent']
        ])->passwordInput()->input('password', ['placeholder' => "Password"])->label(false);
        ?> 
    </div>
    <div class="form-group clearfix">
        <!--        <label class="fancy-checkbox element-left">
                    <input type="checkbox">
                    <span>Remember me</span>
                </label>-->
        <?=
        $form->field($model, 'rememberMe', [
            'labelOptions' => [ 'class' => 'fancy-checkbox element-left']
        ])->checkbox()
        ?>
    </div>
    <?php // $form->field($model, 'rememberMe')->checkbox() ?>       


    <!--<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>-->
    <?= Html::submitButton('LOGIN', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
    <div class="bottom">
        <!--<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>-->
    </div>
    <?php ActiveForm::end(); ?>
</div>