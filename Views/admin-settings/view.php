<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminSettings */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header" >
                <h3 class="title"><?= Html::encode($this->title) ?></h3>
                <ol class="breadcrumb">
                    <li><a href="<?php echo Url::to(['/training-booking']); ?>"><i class="fa fa-male"></i>   <?= Html::encode($this->title) ?></a></li>
                    <li class="active">List</li>
                </ol> 
                <br>
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
                        'name',
                        'email:email',
                        'phone_number',
                        'address:ntext',
                        'mobile',
                        'website',
                        'facebook_link',
                        'twitter_link',
                        'youtube_link',
                    ],
                ])
                ?>

            </div>
        </div>
    </div>
</div>
