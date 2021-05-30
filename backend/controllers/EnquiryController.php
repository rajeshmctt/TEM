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
use backend\models\enums\EnquiryStatusTypes;

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
        $dataProvider = $searchModel->search(EnquiryStatusTypes::ACTIVE, Yii::$app->request->queryParams);
        // echo "<pre>"; print_r($searchModel); exit; 
        return $this->render('index', [
            'title' => 'Enquiries',
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists potential Enquiry models.
     * @return mixed
     */
    public function actionPotential()
    {
        $searchModel = new EnquirySearch();
        $dataProvider = $searchModel->search(EnquiryStatusTypes::POTENTIAL, Yii::$app->request->queryParams);

        return $this->render('index', [
            'title' => 'Potential Users',
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists joined Enquiry models.
     * @return mixed
     */
    public function actionJoined()
    {
        $searchModel = new EnquirySearch();
        $dataProvider = $searchModel->search(EnquiryStatusTypes::JOINED, Yii::$app->request->queryParams);

        return $this->render('index', [
            'title' => 'Joined Users',
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
        $model = $this->findModel($id);
        if($model->status == 0)
		{
            $model->status = 10;
            if($model->save())
	        {
		        Yii::$app->getSession()->setFlash('success','Record Activated successfully');
			    return $this->redirect(Yii::$app->request->referrer);
	        }
        }else{
            $model->status = 0;
            if($model->save())
	        {
		        Yii::$app->getSession()->setFlash('error','Record deactivated successfully');
		        return $this->redirect(Yii::$app->request->referrer);
		        // echo "<pre>"; print_r($this->redirect(Yii::$app->request->referrer)); exit;
	        }else{
				echo "parameters missing "; exit;
			}
        }
        return $this->redirect(['index']);
    }

    /**
     * Potential an existing Enquiry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTopotential($id)
    {
        $model = $this->findModel($id);        
        $model->status = 6;
        if($model->save())
        {
            Yii::$app->getSession()->setFlash('success','Record Moved to Potential Users successfully');
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->redirect(['index']);
    }

    /**
     * Joined an existing Enquiry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTojoined($id)
    {
        $model = $this->findModel($id);
        if($model->status == 0)
		
        $model->status = 3;
        if($model->save())
        {
            Yii::$app->getSession()->setFlash('success','Record Moved to Joined Users successfully');
            return $this->redirect(Yii::$app->request->referrer);
        }
        
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
