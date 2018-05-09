<?php

namespace backend\controllers;

use Yii;
use backend\models\Opportunity;
use backend\models\OpportunitySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OpportunityController implements the CRUD actions for Opportunity model.
 */
class OpportunityController extends Controller
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
     * Lists all Opportunity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OpportunitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Opportunity model.
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
     * Creates a new Opportunity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Opportunity();
		$lead=\backend\models\Lead::find()->all();

        if ($model->load(Yii::$app->request->post()) ) {
			$model->save(false);
            //echo "success";die;
            Yii::$app->session->setFlash('success', "Created successfully");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,'lead'=>$lead
        ]);
    }

    /**
     * Updates an existing Opportunity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$lead=\backend\models\Lead::find()->all();

        if ($model->load(Yii::$app->request->post())) {
			 
			$model->save(false);
            //echo "success";die;
            Yii::$app->session->setFlash('success', "Updated successfully");
			
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,'lead'=>$lead
        ]);
    }

    /**
     * Deletes an existing Opportunity model.
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
     * Finds the Opportunity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Opportunity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Opportunity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
