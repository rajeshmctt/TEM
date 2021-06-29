<?php
/**
 * Created by PhpStorm.
 * User: Priyanka
 * Date: 06-05-2016
 * Time: 15:44
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Forgot Password';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="panel">
        <div class="panel-body">
			<div class="site-forgot-password">
				<h3><?= Html::encode($this->title) ?></h3>
				<p>Input your registered email to reset your password</p>
				<?php $form = ActiveForm::begin(['id' => 'forgot-password-form']); ?>

				<?= $form->field($model, 'email',[
					'template'=>' <div class="form-group form-material floating">
															{input}
															<label class="floating-label">Email</label>
															{hint}{error}
														</div>' ])->textInput(['autofocus' => true]) ?>
				<div class="form-group clearfix">
					<a class="pull-right" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/login");?>">Return to Login</a>
				</div>
				
				<?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block btn-lg margin-top-40']) ?>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
