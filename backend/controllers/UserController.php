<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\enums\UserTypes;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success','User Created successfully');
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateUser()
    {
        if (Yii::$app->user->identity->role != UserTypes::SUPER_ADMIN) {
			return $this->redirect(["site/index"]);
		}
        $model = new User();
        $model->role = UserTypes::CLIENT;
		$status = ['10' => 'Active', '0' => 'Inactive'];
        if ($model->load(Yii::$app->request->post())) {
			$password = $model->password_hash;
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
			// $model->save();
			// echo "<pre>"; print_r($model->getErrors()); exit;
			// echo "<pre>"; print_r($model); exit;
			if($model->save()){
                Yii::$app->getSession()->setFlash('info', 'User Created successfully');
				// return $this->redirect(['view', 'id' => $model->id]);
				return $this->redirect(['index', 'type' => UserTypes::CLIENT]);
			}else{
				echo "<pre>"; print_r($model->getErrors()); exit;
			}
        }

        return $this->render('create', [
            'model' => $model,
            'status' => $status,
        ]);
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
	
		
    public function actionProfile()
    {
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        $password_model = $this->findModel($id);
        $country_name = "";
        $location_name = [];
        $location_array=[];
        $coaching_med = "";
        $other_text = "";
        $med = [];
        $client_level = [];

        //echo '<pre>';print_r($model);exit;
        if (isset($model->coaching_medium)) {
            $med = explode(",", $model->coaching_medium);
            if (in_array("Other", $med)) {
                $other_text = $med[count((array)$med) - 1];
            }

        }
		
        $password_model->scenario = 'changepass';

        $validationResult = $this->ajaxValidation($model);
        if ($validationResult) {
            return $validationResult;
        }

        
		if ($model->load(Yii::$app->request->post())) {

			$model->contact_no = preg_replace('/(\D+)/', '', $model->contact_no);
			// echo "<pre>"; print_R($model); exit;
			
			// $model->save();
			// echo "<pre>"; print_r($model->getErrors()); exit;
			if ($model->save()) {

				/***userlocation***/
				if(count((array)$location_array)>0) {
					UserLocation::deleteAll(['user_id'=>$model->id]);
					$location_count = count((array)$location_array);
					//echo "<pre>"; print_r($locationname); exit;
					$location_diff = array_diff($location_array, $locationname);
					$location_same = array_intersect($location_array, $locationname);

					if (count((array)$location_diff) > 0) {
						foreach ($location_diff as $loc) {
							$location_model = new Location();
							$location_model->name = $loc;
							$location_model->country_id = $model->country_id;
							if ($location_model->save()) {
								$user_location_model = new UserLocation();
								$user_location_model->user_id = $model->id;
								$user_location_model->location_id = $location_model->id;
								$user_location_model->country_id = $model->country_id;
								$user_location_model->save();
							}
						}
					} else {

						$location_id = Location::find()->where(['IN', 'name', $location_same])->all();

						foreach ($location_id as $val) {
							$user_location_model = new UserLocation();
							$user_location_model->user_id = $model->id;
							$user_location_model->location_id = $val->id;
							$user_location_model->country_id = $model->country_id;
							$user_location_model->save();
						}
					}
				}

				/******/

				Yii::$app->getSession()->setFlash('info', 'Profile updated successfully');
			} else {
				foreach($location_name as $ml){	//12-4
					if(!is_numeric($ml)){
						$m2 = Location::find()->where(['name'=>$ml])->one();
						$model->location[]  = $m2->id;
					}else{
						$model->location[]  = $ml;
					}
				}
				return $this->render('edit_profile', [
					'model' => $model,
					'password_model' => $password_model,
					'other_text'=>$other_text,
					'med'=>$med,
					'client_level'=> $client_level,
				]);
			}
			//return $this->redirect(Yii::$app->homeUrl);
			return $this->redirect(["site/index"]);
		} else {
			foreach($location_name as $ml){	//12-4
				if(!is_numeric($ml)){
					$m2 = Location::find()->where(['name'=>$ml])->one();
					$model->location[]  = $m2->id;
				}else{
					$model->location[]  = $ml;
				}
			}
			//echo "<pre>"; print_r($country); exit;
			return $this->render('edit_profile', [
				'model' => $model,
				'password_model' => $password_model,
				'country_name' => $country_name,
				'location_name' => $location_name,
				'other_text' => $other_text,
				'med' => $med,
				'client_level'=> $client_level,
			]);
		}
    }

    private function ajaxValidation($model)
    {
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = "json";
            return ActiveForm::validate($model);
        } else {
            return false;
        }
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
