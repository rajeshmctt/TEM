
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'CaaS - Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="panel">
        <div class="panel-body">
							<?php if($reset){ ?>
							<!--<div class="panel-body">-->
								<div class='alert alert-danger'>This link is already used to reset the password.</div>
							<!--</div>-->
							<?php } ?>
<div class="login-box animated fadeInDown">
    <!--<div class="login-logo"></div>-->
    <h3>Reset Password</h3>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form-horizontal']); ?>

        <?= $form->field($model, 'password_hash',[
            'template'=>' <div class="form-group form-material floating">
												{input}
												<label class="floating-label">Password</label>
												{hint}{error}
											</div>' ])->passwordInput(['autofocus' => true]) ?>

        <div class="form-group">
            <div class="col-md-12">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block btn-lg margin-top-40']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
</div>
