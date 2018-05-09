<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>Contact</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Url::to(['/site/contact']); ?>"><i class="fa fa-globe"></i>  <?= Html::encode($this->title) ?></a></li>
        <li class="active">Contact</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="site-contact">

        <div class="row">
            <div class="col-lg-6">            
                <p>
                    If you have inquiries contact us.
                </p>

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

                <?php
                $tag = $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',]);
                $tag = preg_replace('/backend/', 'frontend', $tag);
                echo $tag;
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-6">
                <h1>Support</h1>
                <div class="table-support table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>Field</th>
                        <th>value</th>
                        </thead>
                        <tbody>                  
                            <tr>
                                <td>Name</td>
                                <td class="editable" data-type="firstname"><?= $adminmodel['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="editable"  data-type="lastname"><?= $adminmodel['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td class="editable"  data-type="username"><?= $adminmodel['phone_number']; ?></td>
                            </tr>                    
                            <tr>
                                <td>Mobile</td>
                                <td class="editable"  data-type="dob"><?= $adminmodel['mobile']; ?></td>
                            </tr>
                            <tr>
                                <td>Website</td>
                                <td class="editable"  data-type="email"><?= $adminmodel['website']; ?></td>
                            </tr>  
                            <tr>
                                <td>Address</td>
                                <td class="editable"  data-type="email"><?= $adminmodel['address']; ?></td>
                            </tr> 

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>