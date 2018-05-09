<?php

namespace backend\controllers;

use Yii;
use backend\models\Lead;
use backend\models\LeadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * LeadController implements the CRUD actions for Lead model.
 */
class LeadController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * Lists all Lead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lead model.
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
     * Creates a new Lead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lead();
		$userrole=\backend\models\UserRole::find()->all();
		
		$model->created_at=Yii::$app->formatter->asDate('now','yyyy-MM-dd');
		  $model->updated_at=Yii::$app->formatter->asDate('now','yyyy-MM-dd');

        if ($model->load(Yii::$app->request->post())) {
			$model->save(false);
			 Yii::$app->session->setFlash('success', "Created successfully");
            return $this->redirect(['view', 'id' => $model->id]);
			
        }

        return $this->render('create', [
            'model' => $model,'userrole'=>$userrole
        ]);
    }

    /**
     * Updates an existing Lead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$userrole=\backend\models\UserRole::find()->all();
		
		$model->created_at=Yii::$app->formatter->asDate('now','yyyy-MM-dd');
		  $model->updated_ats=Yii::$app->formatter->asDate('now','yyyy-MM-dd');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->save(false);
            //echo "success";die;
            Yii::$app->session->setFlash('success', "Updated successfully");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,'userrole'=>$userrole
        ]);
    }

    /**
     * Deletes an existing Lead model.
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
     * Finds the Lead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lead::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
