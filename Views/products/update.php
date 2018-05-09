<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Packages */

$this->title = 'Packages';
$this->params['breadcrumbs'][] = ['label' => 'Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header" >
                <h3 class="title"><?= Html::encode($this->title) ?></h3>
                <ol class="breadcrumb">
                    <li><a href="<?php echo Url::to(['/packages']); ?>"><i class="lnr lnr-list"></i>   <?= Html::encode($this->title) ?></a></li>
                    <li class="active">Update</li>
                </ol>             
            </div>
            <div class="card-content table-responsive">  
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </div>
    </div>
</div>