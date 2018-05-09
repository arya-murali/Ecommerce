<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dosamigos\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Packages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packages-form">
    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'specification')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?php
            $status = backend\models\Status::find()->Where(['status_type' => 'status'])->all();
            $listData = ArrayHelper::map($status, 'sid', 'caption');
            ?>    
            <?php echo $form->field($model, 'status')->dropDownList($listData, ['prompt' => 'Select']); ?>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div> 

</div>
