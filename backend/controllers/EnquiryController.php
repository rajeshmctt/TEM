<?php

namespace backend\controllers;

use Yii;
use common\models\Enquiry;
use common\models\EnquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Location;
use common\models\Currency;
use common\models\Program;
use common\models\Batch;

/**
 * EnquiryController implements the CRUD actions for Enquiry model.
 */
class EnquiryController extends Controller
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
     * Lists all Enquiry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnquirySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Enquiry model.
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
     * Creates a new Enquiry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Enquiry();
        $countries = [];
        foreach(Location::find()->all() as $ctry){
            $countries[$ctry->id] = $ctry->name;
        }
        $currency = [];
        foreach(Currency::find()->all() as $crr){
            $currency[$crr->id] = $crr->name;
        }
        $programs = [];
        foreach(Program::find()->all() as $prg){
            $programs[$prg->id] = $prg->name;
        }
        $pbatches =[];
        if ($model->load(Yii::$app->request->post())) {
            $model->date_of_enquiry = strtotime($model->date_of_enquiry);
            if($model->l1_batch==0){
                $model->l1_batch = NULL;
            }
            if($model->l2_batch==0){
                $model->l2_batch = NULL;
            }
            if($model->l3_batch==0){
                $model->l3_batch = NULL;
            }
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                echo "<pre>"; print_r($model->getErrors()); exit;
            }            
        }

        return $this->render('create', [
            'model' => $model,
            'countries' => $countries,
            'currency' => $currency,
            'programs' => $programs,
            'pbatches' => $pbatches,
        ]);
    }

    /**
     * Updates an existing Enquiry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $countries = [];
        foreach(Location::find()->all() as $ctry){
            $countries[$ctry->id] = $ctry->name;
        }
        $currency = [];
        foreach(Currency::find()->all() as $crr){
            $currency[$crr->id] = $crr->name;
        }
        $programs = [];
        foreach(Program::find()->all() as $prg){
            $programs[$prg->id] = $prg->name;
        }
        $pbatches =[];
        $pbatch = Batch::find()->where(['program_id'=>$model->program_id])->all();
        foreach($pbatch as $pbt){
            $pbatches[0] = '--Select Batch--';
            $pbatches[$pbt->id] = $pbt->name;
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->date_of_enquiry = strtotime($model->date_of_enquiry);
            if($model->l1_batch==0){
                $model->l1_batch = NULL;
            }
            if($model->l2_batch==0){
                $model->l2_batch = NULL;
            }
            if($model->l3_batch==0){
                $model->l3_batch = NULL;
            }
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                echo "<pre>"; print_r($model->getErrors()); exit;
            } 
        }

        return $this->render('update', [
            'model' => $model,
            'countries' => $countries,
            'currency' => $currency,
            'programs' => $programs,
            'pbatches' => $pbatches,
        ]);
    }

    /**
     * Deletes an existing Enquiry model.
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
     * Finds the Enquiry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Enquiry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Enquiry::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
