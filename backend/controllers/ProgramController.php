<?php

namespace backend\controllers;

use Yii;
use common\models\Program;
use common\models\ProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramController implements the CRUD actions for Program model.
 */
class ProgramController extends Controller
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
     * Lists all Program models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Program();

        if ($model->load(Yii::$app->request->post()) ) {
            // echo "<pre>"; print_r($model); exit;
            $model->tentative_date = strtotime($model->tentative_date);
            // echo "<pre>"; print_r($model); exit;
            if($model->save()){
                Yii::$app->getSession()->setFlash('success','Program added successfully');
                return $this->redirect(['index']);
            }else{
                echo "<pre>"; print_r($model->getErrors()); exit;
            }
            
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Program model.
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
     * Creates a new Program model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Program();

        if ($model->load(Yii::$app->request->post()) ) {
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
     * Updates an existing Program model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->tentative_date==''){
            $model->tentative_date = 0;
        }
        // echo "<pre>"; print_r($model); exit;
        if ($model->load(Yii::$app->request->post()) ) {
            $model->tentative_date = strtotime($model->tentative_date);
            if($model->save()){

            }else{
                echo "<pre>"; print_r($model->getErrors()); exit;
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Program model.
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
     * Finds the Program model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Program the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Program::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // public function actionBatches($id)
    // {
    //     $this->findModel($id);

    //     return $this->redirect(['index']);
    // }
}
