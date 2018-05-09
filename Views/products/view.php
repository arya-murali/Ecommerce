<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Packages */

$this->title = $model->specification;
$this->params['breadcrumbs'][] = ['label' => 'Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header" >
                <h3 class="title"><?= Html::encode($this->title) ?></h3>
                <ol class="breadcrumb">
                    <li><a href="<?php echo Url::to(['/packages']); ?>"><i class="fa fa-video-camera"></i>   <?= Html::encode($this->title) ?></a></li>
                    <li class="active">Create</li>
                </ol>             
            </div>
            <div class="card-content table-responsive">   
                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?=
                    Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </p>

                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'specification',
                        [
                            'attribute' => 'status',
                            'value' => isset($model->status) ? $model->status0->caption : '',
                        ],
                    ],
                ])
                ?>

            </div>
        </div>
    </div>
</div>
