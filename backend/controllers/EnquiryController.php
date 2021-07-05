<?php

namespace backend\controllers;

use Yii;
use common\models\Enquiry;
use common\models\EnquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Location;
use common\models\EnquiryBatch;
use common\models\EnquiryRemarks;
use common\models\Currency;
use common\models\Program;
use common\models\Elective;
use common\models\Batch;
use common\models\Owner;
use common\models\Country;
use common\models\State;
use common\models\City;
use backend\models\enums\EnquiryStatusTypes;
use backend\models\enums\UserTypes;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Fill;
use common\models\EnquiryBatchSearch;

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
        // Export excel functionality 19june21 RDM
        $export = Yii::$app->request->get('export');
        if(isset($export)) // && !isset($search)
        {
            $this->export(EnquiryStatusTypes::ACTIVE);
        }
		else {
            $searchModel = new EnquirySearch();
            $dataProvider = $searchModel->search(EnquiryStatusTypes::ACTIVE, Yii::$app->request->queryParams);
            // echo "<pre>"; print_r($searchModel); exit; 
            return $this->render('index', [
                'title' => 'Enquiries',
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Lists potential Enquiry models.
     * @return mixed
     */
    public function actionPotential()
    {
        // Export excel functionality 19june21 RDM
        $export = Yii::$app->request->get('export');
        if(isset($export)) // && !isset($search)
        {
            $this->export(EnquiryStatusTypes::POTENTIAL);
        }
		else {
            $searchModel = new EnquirySearch();
            $dataProvider = $searchModel->search(EnquiryStatusTypes::POTENTIAL, Yii::$app->request->queryParams);

            return $this->render('indexp', [
                'title' => 'Potential Participants',
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Lists joined Enquiry models.
     * @return mixed
     */
    public function actionJoined()
    {
        // Export excel functionality 19june21 RDM
        $export = Yii::$app->request->get('export');
        if(isset($export)) // && !isset($search)
        {
            $this->export(EnquiryStatusTypes::JOINED);
        }
		else {
            $searchModel = new EnquirySearch();
            $dataProvider = $searchModel->search(EnquiryStatusTypes::JOINED, Yii::$app->request->queryParams);

            return $this->render('indexj', [
                'title' => 'Confirmed Participants',
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Lists closed Enquiry models.
     * @return mixed
     */
    public function actionClosed()
    {
        // Export excel functionality 19june21 RDM
        $export = Yii::$app->request->get('export');
        if(isset($export)) // && !isset($search)
        {
            $this->export(EnquiryStatusTypes::CLOSED);
        }
		else {
            $searchModel = new EnquirySearch();
            $dataProvider = $searchModel->search(EnquiryStatusTypes::CLOSED, Yii::$app->request->queryParams);

            return $this->render('indexc', [
                'title' => 'Closed Enquiries',
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
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
    public function actionCreate($add=0)
    {
        // echo $add; exit;
        $model = new Enquiry();
        $countries = [];
        foreach(Country::find()->all() as $ctry){
            $countries[$ctry->id] = $ctry->name;
        }
        // foreach(Location::find()->all() as $ctry){
        //     $countries[$ctry->id] = $ctry->name;
        // }
        $states = [];
        $cities = [];
        $currency = [];
        foreach(Currency::find()->all() as $crr){
            $currency[$crr->id] = $crr->name;
        }
        $programs = [];
        foreach(Program::find()->all() as $prg){
            $programs[$prg->id] = $prg->name;
        }
        $pbatches =[];
        $owners_m = Owner::find()->all();
        $owners =[];
        foreach($owners_m as $owner){
            $owners[$owner->id] = $owner->name;
        }
        $link = \Yii::$app->urlManager->createAbsoluteUrl(["enquiry/index"]);
        // echo $link; exit; 
        if ($model->load(Yii::$app->request->post())) {
            // echo "<pre>"; print_r($model->state_id); exit;
            if($model->state_id == 0){
                $model->state_id = NULL;
            }
            if($model->city_id == 0){
                $model->city_id = NULL;
            }
            $model->date_of_enquiry = strtotime($model->date_of_enquiry);
            //default enq_status on create = open
            $model->enq_status = 0;
            /*if($model->l1_batch==0){
                $model->l1_batch = NULL;
            }
            if($model->l2_batch==0){
                $model->l2_batch = NULL;
            }
            if($model->l3_batch==0){
                $model->l3_batch = NULL;
            }*/
            if($model->save()){
                Yii::$app->getSession()->setFlash('success','You have successfully added an enquiry');
                // return $this->redirect(['index']);
                return $this->redirect(['create','add'=>1]);
            }else{
                echo "<pre>"; print_r($model->getErrors()); exit;
            }            
        }

        return $this->render('create', [
            'model' => $model,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'currency' => $currency,
            'programs' => $programs,
            'pbatches' => $pbatches,
            'owners' => $owners,
            'add' => $add,
            'link' => $link,
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
        foreach(Country::find()->all() as $ctry){
            $countries[$ctry->id] = $ctry->name;
        }
        $states = [];
        foreach(State::find()->where(['country_id'=>$model->countries_id])->all() as $state){
            $states[$state->id] = $state->name;
        }
        $cities = [];
        foreach(City::find()->where(['state_id'=>$model->state_id])->all() as $city){
            $cities[$city->id] = $city->name;
        }
        // echo "<pre>"; print_r($cities); exit;

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
        $owners_m = Owner::find()->all();
        $owners =[];
        foreach($owners_m as $owner){
            $owners[$owner->id] = $owner->name;
        }
        // echo "<pre>"; print_r($owners); exit;
        if ($model->load(Yii::$app->request->post())) {
            if($model->state_id == 0){
                $model->state_id = NULL;
            }
            if($model->city_id == 0){
                $model->city_id = NULL;
            }
            $model->date_of_enquiry = strtotime($model->date_of_enquiry);
            // if($model->l1_batch==0){
            // echo "<pre>"; print_r($model->date_of_enquiry); exit;
            //     $model->l1_batch = NULL;
            // }
            // if($model->l2_batch==0){
            //     $model->l2_batch = NULL;
            // }
            // if($model->l3_batch==0){
            //     $model->l3_batch = NULL;
            // }
            $remark = Yii::$app->request->post('Remark');
            // echo "<pre>"; print_r($remark); exit;
            if($model->save()){
                if($remark['date_of_remark']!=''){
                    $remark_m = new EnquiryRemarks();
                    $remark_m->date = strtotime($remark['date_of_remark']);
                    $remark_m->remarks = $remark['remark'];
                    $remark_m->enquiry_id = $model->id;
                    if($remark_m->save()){
    
                    }else{
                        echo "1<pre>"; print_r($remark_m->getErrors()); exit;
                    }
                }
                // return $this->redirect(['index']);
		        Yii::$app->getSession()->setFlash('success','Record Updated successfully');
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                echo "<pre>"; print_r($model->getErrors()); exit;
            } 
        }

        return $this->render('update', [
            'model' => $model,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'currency' => $currency,
            'programs' => $programs,
            'pbatches' => $pbatches,
            'owners' => $owners,
        ]);
    }

    /**
     * Updates an existing Enquiry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatep($id)
    {
        $model = $this->findModel($id);
		$batches = EnquiryBatch::getEnquiryBatches($id);
        $myprograms = Batch::getBatchPrograms($batches);
        $pgcount = count((array)$batches); 
        // echo "<pre>"; print_r($batches); exit;
        $countries = [];
        // $countries = [];
        foreach(Country::find()->all() as $ctry){
            $countries[$ctry->id] = $ctry->name;
        }
        $states = [];
        foreach(State::find()->where(['country_id'=>$model->countries_id])->all() as $state){
            $states[$state->id] = $state->name;
        }
        $cities = [];
        foreach(City::find()->where(['state_id'=>$model->state_id])->all() as $city){
            $cities[$city->id] = $city->name;
        }
        // foreach(Location::find()->all() as $ctry){
        //     $countries[$ctry->id] = $ctry->name;
        // }
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
        $doe = $model->date_of_enquiry;
        $owners_m = Owner::find()->all();
        $owners =[];
        foreach($owners_m as $owner){
            $owners[$owner->id] = $owner->name;
        }
        if ($model->load(Yii::$app->request->post())) {
            if($model->state_id == 0){
                $model->state_id = NULL;
            }
            if($model->city_id == 0){
                $model->city_id = NULL;
            }
            if($model->date_of_enquiry != ''){
                $model->date_of_enquiry = $doe;
            }
            $enquiries = Yii::$app->request->post('Enquiry');
			// echo'<pre>'; print_r($model->date_of_enquiry); exit;	
			$pwup = Yii::$app->request->post();
			$newbatches = [];
			if(isset($enquiries['batch1'])){
				// echo 'no'; exit;
				for($i=1;$i<=3;$i++){
					if($enquiries['batch'.$i]!=''){
						$newbatches[] = $enquiries['batch'.$i];
					}
				}
				$add = array_diff($newbatches,$batches); 
				//echo'<pre>'; print_r($batches); exit;	
				$remov = array_diff($batches,$newbatches);
				// echo'<pre>'; print_r($batches); print_r($newbatches); exit;	
				foreach($remov as $rem){
					$enquiry_batch = EnquiryBatch::find()->where(['enquiry_id'=>$model->id, 'batch_id'=>$rem])->one();
					//$enquiry_batch = new BatchUser();
					$enquiry_batch->status = Program::STATUS_DELETED;
					if($enquiry_batch->save()){
                        // echo 'saved'; exit;
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
				}
			}

            // if($model->l1_batch==0){
            //     $model->l1_batch = NULL;
            // }
            // if($model->l2_batch==0){
            //     $model->l2_batch = NULL;
            // }
            // if($model->l3_batch==0){
            //     $model->l3_batch = NULL;
            // }
            $remark = Yii::$app->request->post('Remark');
            if($model->save()){
                if($remark['date_of_remark']!=''){
                    $remark_m = new EnquiryRemarks();
                    $remark_m->date = strtotime($remark['date_of_remark']);
                    $remark_m->remarks = $remark['remark'];
                    $remark_m->enquiry_id = $model->id;
                    if($remark_m->save()){

                    }else{
                        echo "<pre>"; print_r($remark_m->getErrors()); exit;
                    }
                }
                // return $this->redirect(['index']);
		        Yii::$app->getSession()->setFlash('success','Record Updated successfully');
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                echo "<pre>"; print_r($model->getErrors()); exit;
            } 
        }

        return $this->render('updatep', [
            'model' => $model,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'currency' => $currency,
            'programs' => $programs,
            'myprograms' => $myprograms,
            'pbatches' => $pbatches,
            'batches' => $batches,
            'pgcount' => $pgcount,
            'owners' => $owners,
        ]);
    }

    public function actionCloseEnquiry($id)
    {

        $e_model = Enquiry::findone($id);
        // echo  "<pre>123"; print_r($e_model); exit;
        if ($e_model->load(Yii::$app->request->get())) {	//echo "test"; exit;
            //$password_model->new_password
            

            if($e_model->status == 2)
            {
                $e_model->status = 10;
                if($e_model->save())
                {
                    Yii::$app->getSession()->setFlash('success','Record Moved to Enquiries successfully');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }else{
                $e_model->status = 2;
                if($e_model->save())
                {
                    Yii::$app->getSession()->setFlash('error','Enquiry closed successfully');
                    return $this->redirect(Yii::$app->request->referrer);
                    // echo "<pre>"; print_r($this->redirect(Yii::$app->request->referrer)); exit;
                }else {	//echo 2; exit;
                    return $this->renderAjax('change_password_content', [
                        'e_model' => $e_model]);
                }
            }

        } else {

            return $this->renderPartial('close_enquiry_content', [
                'e_model' => $e_model
            ]);
        }

    }

    /**
     * Updates an existing Enquiry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatej2($id)
    {
        $model = $this->findModel($id);
		$batches = EnquiryBatch::getEnquiryBatches($id);
        $myprograms = Batch::getBatchPrograms($batches);
        $pgcount = count((array)$batches); 
		$others = EnquiryBatch::getEbo($id);
        $allelec1 = Elective::find()->all();
        $allelec = [];
        foreach($allelec1 as $elec){
            $allelec[$elec->id] = $elec->name;
        }
        // echo "<pre>"; print_r(count($model->enquiryBatches)); exit;

        // echo "<pre>"; print_r($model->enquiryBatches); exit;
        $countries = [];
        foreach(Country::find()->all() as $ctry){
            $countries[$ctry->id] = $ctry->name;
        }
        $states = [];
        foreach(State::find()->where(['country_id'=>$model->countries_id])->all() as $state){
            $states[$state->id] = $state->name;
        }
        $cities = [];
        foreach(City::find()->where(['state_id'=>$model->state_id])->all() as $city){
            $cities[$city->id] = $city->name;
        }
        // foreach(Location::find()->all() as $ctry){
        //     $countries[$ctry->id] = $ctry->name;
        // }
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
        $doe = $model->date_of_enquiry;
        $owners_m = Owner::find()->all();
        $owners =[];
        foreach($owners_m as $owner){
            $owners[$owner->id] = $owner->name;
        }
        if ($model->load(Yii::$app->request->post())) {
            if($model->state_id == 0){
                $model->state_id = NULL;
            }
            if($model->city_id == 0){
                $model->city_id = NULL;
            }
            if($model->date_of_enquiry != ''){
                $model->date_of_enquiry = $doe;
            }

            $enquiries = Yii::$app->request->post('Enquiry');
			// echo'<pre>'; print_r($enquiries); exit;	
			$pwup = Yii::$app->request->post();
			$newbatches = [];
			if(isset($enquiries['batch1'])){
				// echo 'no'; exit;
				for($i=1;$i<=3;$i++){
					if($enquiries['batch'.$i]!=''){
						$newbatches[] = $enquiries['batch'.$i];
						$newcurrency[] = $enquiries['currency'.$i];
						$newamount[] = $enquiries['amount'.$i];
						$newinstall[] = $enquiries['installment_plan'.$i];
					}
				}
				$add = array_diff($newbatches,$batches); 
				//echo'<pre>'; print_r($batches); exit;	
				$remov = array_diff($batches,$newbatches);
				// echo'<pre>'; print_r($newcurrency); print_r($newamount); exit;	
				foreach($remov as $rem){
					$enquiry_batch = EnquiryBatch::find()->where(['enquiry_id'=>$model->id, 'batch_id'=>$rem])->one();
					//$enquiry_batch = new BatchUser();
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
				}
			}
            $remark = Yii::$app->request->post('Remark');
            if($model->save()){
                if($remark['date_of_remark']!=''){
                    $remark_m = new EnquiryRemarks();
                    $remark_m->date = strtotime($remark['date_of_remark']);
                    $remark_m->remarks = $remark['remark'];
                    $remark_m->enquiry_id = $model->id;
                    $remark_m->save();
                }
                // return $this->redirect(['index']);
		        Yii::$app->getSession()->setFlash('success','Record Updated successfully');
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                echo "<pre>"; print_r($model->getErrors()); exit;
            } 
        }

        return $this->render('updatej2', [
            'model' => $model,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'currency' => $currency,
            'programs' => $programs,
            'pbatches' => $pbatches,
            'myprograms' => $myprograms,
            'batches' => $batches,
            'pgcount' => $pgcount,
            'owners' => $owners,
            'allelec' => $allelec,
        ]);
    }

    public function actionValidateEmail($email)
    {
		$user = Enquiry::find()->where(['email' => $email])->one();
		if(count((array)$user)>0){
			// $result = 1;
            return true;
		}else{
            return false;
        }
    }

    public function actionValidatePhone($phone)
    {
		$enqs = Enquiry::find()->all();
        $phones = [];
        foreach($enqs as $enq){
            $cont = str_replace('-', '', $enq->contact_no); // Replaces all spaces with hyphens.
            $phones[$enq->id] = preg_replace('/[^A-Za-z0-9\-]/', '', $cont); // Removes special chars.
        }
        // echo "<pre>"; print_r($phones); exit;
        
        // echo $phone; exit;
		if(in_array($phone,$phones)){
			// $result = 1;
            return true;
		}else{
            return false;
        }
    }

    /**
     * Updates an existing Enquiry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatej($id)
    {
        $model = $this->findModel($id);
		$batches = EnquiryBatch::getEnquiryBatches($id);
        $myprograms = Batch::getBatchPrograms($batches);
        $pgcount = count((array)$batches); 
		$others = EnquiryBatch::getEbo($id);
        $allelec1 = Elective::find()->all();
        $allelec = [];

        //Show  Enquiry Batches  list
        $searchModel = new EnquiryBatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$model->id);
        
        foreach($allelec1 as $elec){
            $allelec[$elec->id] = $elec->name;
        }
        // echo "<pre>"; print_r(count($model->enquiryBatches)); exit;

        // echo "<pre>"; print_r($model->enquiryBatches); exit;
        $countries = [];
        foreach(Country::find()->all() as $ctry){
            $countries[$ctry->id] = $ctry->name;
        }
        $states = [];
        foreach(State::find()->where(['country_id'=>$model->countries_id])->all() as $state){
            $states[$state->id] = $state->name;
        }
        $cities = [];
        foreach(City::find()->where(['state_id'=>$model->state_id])->all() as $city){
            $cities[$city->id] = $city->name;
        }
        // foreach(Location::find()->all() as $ctry){
        //     $countries[$ctry->id] = $ctry->name;
        // }
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
        $doe = $model->date_of_enquiry;
        $owners_m = Owner::find()->all();
        $owners =[];
        foreach($owners_m as $owner){
            $owners[$owner->id] = $owner->name;
        }
        if ($model->load(Yii::$app->request->post())) {
            if($model->state_id == 0){
                $model->state_id = NULL;
            }
            if($model->city_id == 0){
                $model->city_id = NULL;
            }
            if($model->date_of_enquiry != ''){
                $model->date_of_enquiry = $doe;
            }
            if(!isset($model->city_id)){
                $model->city_id = NULL;
            }
            $enquiries = Yii::$app->request->post('Enquiry');
			// echo'<pre>'; print_r($enquiries); exit;	
			/*$pwup = Yii::$app->request->post();
			$newbatches = [];
			if(isset($enquiries['batch1'])){
				// echo 'no'; exit;
				for($i=1;$i<=3;$i++){
					if($enquiries['batch'.$i]!=''){
						$newbatches[] = $enquiries['batch'.$i];
						$newcurrency[] = $enquiries['currency'.$i];
						$newamount[] = $enquiries['amount'.$i];
						$newinstall[] = $enquiries['installment_plan'.$i];
					}
				}
				$add = array_diff($newbatches,$batches); 
				//echo'<pre>'; print_r($batches); exit;	
				$remov = array_diff($batches,$newbatches);
				echo'<pre>'; print_r($newcurrency); print_r($newbatches); exit;	
				foreach($remov as $rem){
					$enquiry_batch = EnquiryBatch::find()->where(['enquiry_id'=>$model->id, 'batch_id'=>$rem])->one();
					//$enquiry_batch = new BatchUser();
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
				}
			}*/
            $remark = Yii::$app->request->post('Remark');
            if($model->save()){
                if($remark['date_of_remark']!=''){
                    $remark_m = new EnquiryRemarks();
                    $remark_m->date = strtotime($remark['date_of_remark']);
                    $remark_m->remarks = $remark['remark'];
                    $remark_m->enquiry_id = $model->id;
                    $remark_m->save();
                }
                // return $this->redirect(['index']);
		        Yii::$app->getSession()->setFlash('success','Record Updated successfully');
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                echo "<pre>"; print_r($model->getErrors()); exit;
            } 
        }

        return $this->render('updatej', [
            'model' => $model,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'currency' => $currency,
            'programs' => $programs,
            'pbatches' => $pbatches,
            'myprograms' => $myprograms,
            'batches' => $batches,
            'pgcount' => $pgcount,
            'owners' => $owners,
            'allelec' => $allelec,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function export($e_sts) //='',$str_date='',$end_date=''
    {
        $searchModel = new EnquirySearch();
        $dataProvider = $searchModel->search($e_sts, Yii::$app->request->queryParams)->query->all();
        $count = count((array)$dataProvider);

        $objPHPExcel = new PHPExcel();
        $styleArray = [
            'font'  => [
                'bold'  => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size'  => 12,
            ],
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '#4caf50')
            ]
        ];
        if(Yii::$app->user->identity->role == (UserTypes::SUPER_ADMIN || UserTypes::CLIENT)){
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Enquiry Date');
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Full Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Phone');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
            $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Subject');
            $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Source');
            $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Referred By');
            $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Program');
            $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Owner');
            $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Address');
            $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'City');
            $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'State');
            $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Country');
            $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Remarks');
            
            for ($i = 2; $i < $count + 2; $i++) {
                $current=[];
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $i, date('M-d-Y',$dataProvider[$i - 2]->date_of_enquiry));
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $i, $dataProvider[$i - 2]->full_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $i,  $dataProvider[$i - 2]->contact_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $i,  $dataProvider[$i - 2]->email );
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $i, $dataProvider[$i - 2]->subject);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $i, isset($dataProvider[$i - 2]->source)?UserTypes::$sources[$dataProvider[$i - 2]->source]:'N/A');
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $i, $dataProvider[$i - 2]->referred_by);                
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $i, isset($dataProvider[$i - 2]->program_id)?$dataProvider[$i - 2]->program->name:'N/A');
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $i, isset($dataProvider[$i - 2]->owner_id)?$dataProvider[$i - 2]->owner0->name:'');
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $i, $dataProvider[$i - 2]->address);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $i, isset($dataProvider[$i - 2]->city_id)?$dataProvider[$i - 2]->city0->name:''); 
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . $i, isset($dataProvider[$i - 2]->state_id)?$dataProvider[$i - 2]->state->name:''); 
                $objPHPExcel->getActiveSheet()->SetCellValue('M' . $i, isset($dataProvider[$i - 2]->countries_id)?$dataProvider[$i - 2]->countries->name:'');                
                $objPHPExcel->getActiveSheet()->SetCellValue('N' . $i, $dataProvider[$i - 2]->remarks);
            }
        }
        $objPHPExcel->getActiveSheet()->setTitle(EnquiryStatusTypes::$titles[$e_sts]);

// Redirect output to a client’s web browser (Excel5)
        $filename = EnquiryStatusTypes::$titles[$e_sts] . date('m-d-Y_his') . ".xlsx";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');// Excel5 to Excel2007 - RDM3mar21 
        $objWriter->save('php://output');
		exit;
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
        // $model = 
        $this->findModel($id)->delete();
        /*if($model->status == 0)
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
        }*/
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Enquiry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionClose($id)
    {
        $model = $this->findModel($id);
        if($model->status == 2)
		{
            $model->status = 10;
            if($model->save())
	        {
		        Yii::$app->getSession()->setFlash('success','Record Moved to Enquiries successfully');
			    return $this->redirect(Yii::$app->request->referrer);
	        }
        }else{
            $model->status = 2;
            if($model->save())
	        {
		        Yii::$app->getSession()->setFlash('error','Enquiry closed successfully');
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
            // return $this->redirect(Yii::$app->request->referrer);
            return $this->redirect(['enquiry/updatep','id'=> $id]);
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
        
		
        $model->status = 3;
        if($model->save())
        {
            Yii::$app->getSession()->setFlash('success','Record Moved to Joined Users successfully');
            // return $this->redirect(Yii::$app->request->referrer);
            return $this->redirect(['enquiry/updatej','id'=> $id]);
        }
        
        return $this->redirect(['enquiry/index','id'=> $id]);
    }

    /**
     * To Enquiries an existing Enquiry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionToenq($id)
    {
        $model = $this->findModel($id);
        
		
        $model->status = 10;
        if($model->save())
        {
            Yii::$app->getSession()->setFlash('success','Record Moved to Enquiries successfully');
            // return $this->redirect(Yii::$app->request->referrer);
            // return $this->redirect(['enquiry/update','id'=> $id]);
            return $this->redirect(['potential']);
        }
        
        return $this->redirect(['index']);
    }
    
	public function actionSearchForStates()
    {
        $country = yii::$app->request->get('country');
        //echo "<pre>"; print_r($action_steps); exit;
        $out = [];
        if($country != '') {
            $states = State::find()->where(['country_id' => $country])->all();
            $out[] = 'Select a State';
            foreach ($states as $val) {
                $out[$val->id] = $val->name;
            }
		}
        return json_encode($out);
    }
    
	public function actionSearchForCities()
    {
        $state = yii::$app->request->get('state');
        //echo "<pre>"; print_r($action_steps); exit;
        $out = [];
        if($state != '') {
            $cities = City::find()->where(['state_id' => $state])->all();
            $out[] = 'Select a City';
            foreach ($cities as $val) {
                $out[$val->id] = $val->name;
            }
		}
        return json_encode($out);
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
