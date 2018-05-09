<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'My Profile';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->registerJs("
// $(document).ready(function (e) {
//   $('#myBtn').click(function(){
//    $('#myModal').modal();
//        var id= $(this).attr('data-id');     
//         $.ajax({
//                        method: 'POST',
//                        dataType: 'html',
//                        url: '" . Url::toRoute(['user/updateprofile'], true) . "?id='+id,                        
//                        success: function (data) {  
//                            $('#user-details').html(data);                        
//                        }
//                    });
//       
//        
//    });
// });
// 
", \yii\web\VIEW::POS_READY); ?>
<section class="content-header">
    <h1>
        <?= Html::encode($this->title) ?>&nbsp; &nbsp;<a href="<?php echo Url::to(['/user/update', 'id' => Yii::$app->user->identity->id]); ?>"><button type="button" class="btn btn-info btn-sm" data-id="<?= $model->id; ?>" id="myBtn">Edit</button></a>
<!--        <small>View</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Url::to(['/site/myprofile']); ?>"><i class="fa fa-globe"></i>  <?= Html::encode($this->title) ?></a></li>       
    </ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?php
                    $model = \backend\models\User::findOne(Yii::$app->user->identity->id);
                    if (isset($model->profile_image)) {
                        $url = Yii::$app->request->baseUrl . '/uploads/user/' . $model->profile_image;
                        echo Html::img($url, ['width' => '70', 'height' => '40', 'class' => 'profile-user-img img-responsive img-circle']);
                    } else {
                        ?>
                        <img src = "<?php echo Yii::$app->request->baseUrl . '/uploads/download.png'; ?>" alt = "User Image" class="profile-user-img img-responsive img-circle">
                    <?php } ?>
                    <?php /*
                      $url = Yii::$app->request->baseUrl . '/images/profile.png';
                      ?>
                      <img class="profile-user-img img-responsive img-circle" src="<?php echo $url; ?>" alt="User profile picture">
                     */ ?>
                    <h3 class="profile-username text-center"><?php echo $model->firstname; ?></h3>

                    <p class="text-muted text-center"><?php //echo isset($model->gurnec_category) ? $model->gurnecCategory['category_name'] : 'Customer';        ?></p>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

                    <p class="text-muted">
                        <?php echo $model->email; ?>
                    </p>

                    <hr>

                    <strong><i class="fa fa-mobile margin-r-5"></i> Mobile</strong>

                    <p class="text-muted"><?php echo $model->mobile; ?></p>

                    <hr>



                    <strong><i class="fa fa-user-circle margin-r-5"></i>Status</strong>

                    <p class="text-muted"><?php echo isset($model->status) ? $model->status0->caption : ''; ?></p>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Info</a></li>
                    <!--                    <li><a href="#settings" data-toggle="tab">Settings</a></li>-->

                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    //'id',
                                    //'user_role_id',
                                    [
                                        'attribute' => 'user_role_id',
                                        'value' => isset($model->user_role_id) ? $model->userRole->user_role : '',
                                    ],
                                    'username',
                                    'firstname',
                                    'lastname',
                                    //'auth_key',
                                    //'password_hash',
                                    //'password_reset_token',
                                    'email:email',
                                    'mobile',
                                   // 'dob',
                                    // 'status',
                                    [
                                        'attribute' => 'status',
                                        'value' => isset($model->status) ? $model->status0->caption : '',
                                    ],
//                                    [
//                                        'attribute' => 'created_by',
//                                        'value' => isset($model->created_by) ? $model->createdBy['firstname'] : '',
//                                    ],
//                                    [
//                                        'attribute' => 'updated_by',
//                                        'value' => isset($model->updated_by) ? $model->updatedBy['firstname'] : '',
//                                    ],
                                    [
                                        'attribute' => 'created_at',
                                        'value' => isset($model->created_at) ? $model->created_at : '',
                                    ],
                                    [
                                        'attribute' => 'updated_at',
                                        'value' => isset($model->updated_at) ? $model->updated_at : '',
                                    ],
                                // 'created_by',
                                //'updated_by',
                                // 'updated_at',
                                // 'created_at',
                                ],
                            ])
                            ?>
                        </div>
                        <!-- /.post -->



                        <!-- Post -->

                        <!-- /.post -->
                    </div>
                    <!-- /.tab-pane -->


                    <div class="tab-pane" id="settings">
                        <h4>Reset Password</h4><br>
                        <div class="user-form">

                            <?php //$form = ActiveForm::begin();  ?>
                            <?php $form = ActiveForm::begin(['action' => Url::to(['user/resetpassword', 'id' => $model->id]), 'id' => 'forum_post', 'method' => 'post']); ?>

                            <div class="row">

                                <div class="col-md-6">
                                    <?= $form->field($model, 'password')->textInput()->Input('password'); ?>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'password')->textInput()->Input('password'); ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <?= Html::Button($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'btnsubmit']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>

</section>