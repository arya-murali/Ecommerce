<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-settings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin Settings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'phone_number',
            'address:ntext',
            // 'mobile',
            // 'website',
            // 'facebook_link',
            // 'twitter_link',
            // 'youtube_link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
