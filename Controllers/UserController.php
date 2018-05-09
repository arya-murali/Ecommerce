<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use backend\models\UserRole;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\UploadForm;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
	 //public $layout='dashboard';
    public function behaviors()
    {
        return [
		'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        
                        [
                        'actions' => [ 'index','create','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
				],
				
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
       $model = new User();
	    $userRole=userRole::find()->all();
		
		//echo '<pre>';    
       // print_r($userRole);        
		//die();
		
		 $model->created_at=Yii::$app->formatter->asDate('now','yyyy-MM-dd');
		  $model->updated_at=Yii::$app->formatter->asDate('now','yyyy-MM-dd');
		
        $model->dob=Yii::$app->formatter->asDate('now','dd-M-yyyy');

        if ($model->load(Yii::$app->request->post()) ) {
//            && $model->validate()
//            echo '<pre>';
//            print_r(Yii::$app->request->post());
//            die();
            
             if (isset($_POST['User']['dob']) && $_POST['User']['dob'] != '') {
                $model->dob = date('yyyy-M-dd', strtotime($_POST['User']['dob']));
            } else {
                $model->dob = '';
            }
            
            $uploadedFile = UploadedFile::getInstance($model, 'profile_image');
            $firstname=$_POST['User']['firstname'];
            $rnd = rand();
            $fileName = "{$firstname}-{$rnd}-{$uploadedFile}";   // random number + file name             
            if (!empty($uploadedFile)) {
                $model->profile_image = $fileName;
            } else {
                unset($model->profile_image);
            }

            if ($uploadedFile != '') {
                $uploadedFile->saveAs(\Yii::getAlias('@webroot') . '/uploads/user/' . $fileName);
            }
            //if($model->validate())           
            $model->save(false);
            //echo "success";die;
            Yii::$app->session->setFlash('success', "Created successfully");
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else {
          
        return $this->render('create', [
            'model' => $model,'userRole'=>$userRole
        ]);
    }
    }

    

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
         $model = $this->findModel($id);
		$userRole = userRole::find()->all();
        //$model->updated_by = Yii::$app->user->id;
        //$model->updated_at = date('Y-m-d');
        //$model->password= $model->getPassword($model->password_hash);
        $model->dob = date('d-M-Y', strtotime($model->dob));
		
		if ($model->load(Yii::$app->request->post())) {
//            echo '<pre>';
//            print_r($model);
//            die();
            if (!empty($model->password_hash)) {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            } else {
                unset($model->password_hash);
            }
            if (isset($_POST['User']['dob']) && $_POST['User']['dob'] != '') {
                $model->dob = date('Y-m-d', strtotime($_POST['User']['dob']));
            } else {
                $model->dob = '';
            }

            $uploadedFile = UploadedFile::getInstance($model, 'profile_image');
            $rnd = rand();
            $fileName = "{$rnd}-{$uploadedFile}";   // random number + file name             
            if (!empty($uploadedFile)) {
                $model->profile_image = $fileName;
            } else {
                unset($model->profile_image);
            }

            if ($uploadedFile != '') {
                $uploadedFile->saveAs(\Yii::getAlias('@webroot') . '/uploads/user/' . $fileName);
            }
            //if($model->validate())           
            $model->save(false);
            //echo "success";die;
            Yii::$app->session->setFlash('success', "Updated successfully");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model, 'userRole' => $userRole
            ]);
        }
    }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
