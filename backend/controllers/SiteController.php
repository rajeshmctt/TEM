<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Enquiry;
use common\models\User;
use backend\models\enums\EnquiryStatusTypes;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','forgot-password', 'reset-password','change-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', ''],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $e_cnt = count((array)Enquiry::find()->where(['status'=>EnquiryStatusTypes::ACTIVE])->all());
        $p_cnt = count((array)Enquiry::find()->where(['status'=>EnquiryStatusTypes::POTENTIAL])->all());
        $c_cnt = count((array)Enquiry::find()->where(['status'=>EnquiryStatusTypes::JOINED])->all());
        $x_cnt = count((array)Enquiry::find()->where(['status'=>EnquiryStatusTypes::CLOSED])->all());
        // echo $ecnt; exit;
        return $this->render('index',[
            'e_cnt' => $e_cnt,
            'p_cnt' => $p_cnt,
            'c_cnt' => $c_cnt,
            'x_cnt' => $x_cnt,
        ]);
    }

    public function actionChangePassword()
    {

        $password_model = User::findone(Yii::$app->user->identity->id);
        // $password_model->scenario = 'changepass';

        //if (Yii::$app->request->isAjax && $model->load($_POST))
        $validationResult = $this->ajaxValidation($password_model);
        if ($validationResult) {
            return $validationResult;
        }


        if ($password_model->load(Yii::$app->request->get())) {	//echo "test"; exit;
            //$password_model->new_password
            $user = Yii::$app->request->get('User');
            // echo "<pre>123"; print_r($user['new_password']); exit;
			// if($password_model->role != UserTypes::COACH){
			// }
			// $password_model->setPassword($password_model->new_password);
			$password_model->setPassword($user['new_password']);
			// $password_model->save();
			// echo "<pre>".$password_model->role; print_r($password_model->getErrors()); exit;
            if ($password_model->save()) {	//echo 1; exit;
                Yii::$app->getSession()->setFlash('info', 'Password updated successfully');
                return $this->redirect(Yii::$app->request->referrer);	
            } else {	//echo 2; exit;
                return $this->renderAjax('change_password_content', [
                    'password_model' => $password_model]);
            }
        } else {

            return $this->renderPartial('change_password_content', [
                'password_model' => $password_model
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
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            
			$this->layout = "login";
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionForgotPassword()
    {
        $model = new User();

        /* $validationResult = $this->ajaxValidation($model);
        if($validationResult){
            return $validationResult;
        } */
		
        if ($model->load(Yii::$app->request->post())) {
            //echo $model->email;exit;
            if ($model->sendEmail($model->email)) { //echo "test1"; exit;
                Yii::$app->getSession()->setFlash('success', ['message' => 'Check your email for further instructions.']);
                if(!Yii::$app->request->get("ajax")){
					return $this->redirect(['site/login']);
                }else{
                    return $this->redirect('site/login');
                }
            } else {    //echo "test2"; exit;
                Yii::$app->getSession()->setFlash('error', ['message' => 'Sorry, we are unable to reset password for email provided.']);
                if(!Yii::$app->request->get("ajax")){
					return $this->redirect(['site/login']);
                }else{
                    return $this->redirect('site/login');
                }
            }
        } else {
			//if(!Yii::$app->request->get("from_app")){
				if(!Yii::$app->request->get("ajax")){
					$this->layout = "login";
				}
				return $this->render('forgot_password', [
					'model' => $model,
				]);
			/* }else{
				return $this->renderPartial('forgot_password', [
					'model' => $model,
				]);
			} */
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
