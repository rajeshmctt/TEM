<?php

namespace backend\controllers;

use Yii;
use common\models\EnquiryBatch;
use common\models\Enquiry;
use common\models\Elective;
use common\models\EnquiryBatchElectives;
use common\models\EnquiryBatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\enums\EnquiryStatusTypes;

/**
 * EnquiryBatchController implements the CRUD actions for EnquiryBatch model.
 */
class EnquiryBatchController extends Controller
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
     * Lists all EnquiryBatch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnquiryBatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EnquiryBatch model.
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
     * Creates a new EnquiryBatch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($eid)
    {
        $model = new EnquiryBatch();
        $model->enquiry_id = $eid;
        $enquiry = Enquiry::findOne($eid);
        // echo "<pre>"; print_r($enquiry); exit;
        if ($model->load(Yii::$app->request->post())) {
            // echo "<pre>"; print_r($model); exit;
            if($model->save()){
                Yii::$app->getSession()->setFlash('success','Record Added successfully');
                // Electives functionality 5-7-2021(pending) hide for now RDM 
                /*foreach($model->electives as $elec){
                    $elective = new EnquiryBatchElectives();
                    $elective->enquiry_batch_id = $model->id;
                    $elective->elective_id = $elec;
                    $elective->save();
                }*/
            }
            return $this->redirect(['enquiry/updatej', 'id' => $eid]);
        }

        return $this->render('create', [
            'model' => $model,
            'enquiry' => $enquiry,
        ]);
    }

    /**
     * Creates a new EnquiryBatch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPcreate($eid)
    {
        $model = new EnquiryBatch();
        $model->enquiry_id = $eid;
        $enquiry = Enquiry::findOne($eid);
        // echo "<pre>"; print_r($enquiry); exit;
        if ($model->load(Yii::$app->request->post())) {
            // echo "<pre>"; print_r($model); exit;
            if($model->save()){
                Yii::$app->getSession()->setFlash('success','Record Added successfully');
                // Electives functionality 5-7-2021(pending) hide for now RDM 
                /*foreach($model->electives as $elec){
                    $elective = new EnquiryBatchElectives();
                    $elective->enquiry_batch_id = $model->id;
                    $elective->elective_id = $elec;
                    $elective->save();
                }*/
            }
            return $this->redirect(['enquiry/updatej', 'id' => $eid]);
        }

        return $this->render('pcreate', [
            'model' => $model,
            'enquiry' => $enquiry,
        ]);
    }

    /**
     * Updates an existing EnquiryBatch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success','Record Updated successfully');
            // return $this->redirect(['index']);

            // Electives functionality 5-7-2021(pending) hide for now RDM 
            /*echo "<pre>"; print_r($model->electives); exit;
            foreach($model->electives as $elec){

            }
            $add = array_diff($newbatches,$batches); 
            $remov = array_diff($batches,$newbatches);	
            foreach($remov as $rem){
                $enquiry_batch = EnquiryBatch::find()->where(['enquiry_id'=>$model->id, 'batch_id'=>$rem])->one();
                $enquiry_batch->status = Program::STATUS_DELETED;
                if($enquiry_batch->save()){
                    echo 'saved'; exit;
                }else{
                    print_r($enquiry_batch->getErrors()); exit;
                }
            }
            foreach($add as $ad){
                $enquiry_batch = EnquiryBatch::find()->where(['enquiry_id'=>$model->id, 'batch_id'=>$ad])->one();
                if(count((array)$enquiry_batch)==0){
                    $enquiry_batch = new EnquiryBatch();
                }
                $enquiry_batch->enquiry_id = $model->id; 
                $enquiry_batch->batch_id = $ad;
                $enquiry_batch->status = Program::STATUS_ACTIVE;
                $enquiry_batch->save();
            } */



            return $this->redirect(['enquiry/updatej', 'id' => $model->enquiry_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EnquiryBatch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPupdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success','Record Updated successfully');

            if($model->enquiry->status == EnquiryStatusTypes::JOINED){
                return $this->redirect(['enquiry/updatej', 'id' => $model->enquiry_id]);
            }else{
                return $this->redirect(['enquiry/updatep', 'id' => $model->enquiry_id]);
            }
        }

        return $this->render('pupdate', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EnquiryBatch model.
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
     * Finds the EnquiryBatch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EnquiryBatch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EnquiryBatch::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
