<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

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
        <?= Html::encode($this->title) ?>&nbsp; &nbsp;<a href="<?php echo Url::to(['/user/update','id'=> Yii::$app->user->identity->id]); ?>"><button type="button" class="btn btn-info btn-sm" data-id="<?= $model->id; ?>" id="myBtn">Edit</button></a>
        <small>View</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Url::to(['/site/myprofile']); ?>"><i class="fa fa-globe"></i>  <?= Html::encode($this->title) ?></a></li>
        <li class="active">View</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="site-about">        
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                    <th>Field</th>
                    <th>value</th>
                    </thead>
                    <tbody>                  
                        <tr>
                            <td>First Name</td>
                            <td class="editable" data-type="firstname"><?= $model['firstname']; ?></td>
                        </tr>
                        <tr>
                            <td>Second Name</td>
                            <td class="editable"  data-type="lastname"><?= $model['lastname']; ?></td>
                        </tr>
                        <tr>
                            <td>User Name</td>
                            <td class="editable"  data-type="username"><?= $model['username']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td class="editable"  data-type="email"><?= $model['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Date of birth</td>
                            <td class="editable"  data-type="dob"><?php echo date('d-M-Y', strtotime($model->dob)); ?></td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td class="editable"  data-type="mobile"><?= $model['mobile']; ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body" id="user-details">               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
