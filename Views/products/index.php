<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use backend\models\Status;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Packages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header" >
                <h3 class="title"><?= Html::encode($this->title) ?></h3>
                <ol class="breadcrumb">
                    <li><a href="<?php echo Url::to(['/packages']); ?>"><i class="lnr lnr-list"></i>   <?= Html::encode($this->title) ?></a></li>
                    <li class="active">List</li>
                </ol>
                <p>
                    <?= Html::a('Create Packages', ['create'], ['class' => 'btn btn-success']) ?>
                    &nbsp;
                    <?= Html::a('Packages Rate System', ['/package-rates'], ['class' => 'btn btn-info']) ?>
                </p>                
            </div>
            <div class="card-content table-responsive">      
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        // 'id',
                        'specification',
                        [
                            'attribute' => 'status',
                            'value' => function($data) {
                                return isset($data->status) ? $data->status0['caption'] : '';
                            },
                            'filter' => ArrayHelper::map(Status::find()->asArray()->all(), 'sid', 'caption'),
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>