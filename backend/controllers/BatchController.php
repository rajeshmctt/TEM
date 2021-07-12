<?php

namespace backend\controllers;

use Yii;
use common\models\Batch;
use common\models\BatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BatchController implements the CRUD actions for Batch model.
 */
class BatchController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Batch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Batch();

        if ($model->load(Yii::$app->request->post())) {
            // echo "<pre>"; print_r($model); exit;
            if($model->save()){
                Yii::$app->getSession()->setFlash('success','Batch added successfully');
                return $this->redirect(['index']);
            }
            
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Batch model.
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
     * Creates a new Batch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Batch();

        if ($model->load(Yii::$app->request->post())) {
            // echo "<pre>"; print_r($model); exit;
            if($model->save()){
                return $this->redirect(['index']);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Batch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Batch model.
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
     * Finds the Batch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Batch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Batch::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	public function actionSearchForBatches2()
    {
        $program = yii::$app->request->get('program');
        //echo "<pre>"; print_r($action_steps); exit;
        $out = [];
        if($program != '') {
            $batches = Batch::find()->where(['program_id' => $program])->all();
            // $out[] = 'Select a batch';
            foreach ($batches as $val) {
                $out[$val->id] = $val->name;
            }
		}
        return json_encode($out);
    }
    
    public function actionForprog($id)
    {
        // $batches = $this->find()->where(['program_id' => $id])->all();

        // return $batches;

        $batches = Batch::find()
				->where(['program_id' => $id])
				->orderBy('id DESC')
				->all();
				
		if (!empty($batches)) {
			echo "<option value='0'>--Select a Batch--</option>";
            foreach($batches as $batch) {
				echo "<option value='".$batch->id."'>".$batch->name."</option>";
			}
		} else {
			echo "<option value='0'>--Select a Batch--</option>";
		}
    }
}
