<?php

namespace backend\controllers;

use Yii;
use backend\models\Deal;
use backend\models\DealSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DealController implements the CRUD actions for Deal model.
 */
class DealController extends Controller
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
                        'actions' => [ 'index','create','view','update','delete','deal-history'],
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
     * Lists all Deal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DealSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
	 public function actionDealHistory()
    {
		//$this->layout='dashboard';
        $searchModel = new \backend\models\DealSearch();
        $dataProvider = $searchModel->historysearch(Yii::$app->request->queryParams);

        return $this->render('dealhistory', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Deal model.
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
     * Creates a new Deal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Deal();
		$Opportunity=\backend\models\Opportunity::find()->all();
		
		$model->deal_closingdate=Yii::$app->formatter->asDate('now','yyyy-MM-dd');
		$model->start_date=Yii::$app->formatter->asDate('now','yyyy-MM-dd');
		  $model->end_date=Yii::$app->formatter->asDate('now','yyyy-MM-dd');
		

        if ($model->load(Yii::$app->request->post())) {
			$model->save(false);
			 Yii::$app->session->setFlash('success', "Created successfully");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,'Opportunity'=>$Opportunity
        ]);
    }

    /**
     * Updates an existing Deal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$Opportunity=\backend\models\Opportunity::find()->all();

        if ($model->load(Yii::$app->request->post()) ) {
			$model->save(false);
            //echo "success";die;
            Yii::$app->session->setFlash('success', "Updated successfully");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,'Opportunity'=>$Opportunity
        ]);
    }

    /**
     * Deletes an existing Deal model.
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
     * Finds the Deal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Deal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
