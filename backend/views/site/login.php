<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel">
        <div class="panel-body">
			<div class="site-login">
				<!--<h1><?= Html::encode($this->title) ?></h1>-->
				<h1><img class="navbar-brand-logo navbar-brand-logo-special"
                 src="<?= Yii::$app->urlManager->baseUrl; ?>/images/logo_new.jpg"  title="Remark"></h1>

						<?php $form = ActiveForm::begin(['id' => 'login-form','options' => ['data-link-to'=>'site-login']]); ?>
							
							<?= $form->field($model, 'email',[
									'template'=>' <div class="form-group form-material floating">
															{input}
															<label class="floating-label">Email</label>
															{hint}{error}
														</div>' ])->textInput(['autofocus' => false]) ?>

							<?= $form->field($model, 'password',[
									'template'=>' <div class="form-group form-material floating">
															{input}
														<label class="floating-label">Password</label>
														{hint}{error}
													</div>' ]
							
							)->passwordInput() ?>
					
			        	
							<p id="question"></p><input id="ans" type="text"><button type="reset" value="reset">Reset</button>
							<div id="message">Please verify.</div>
							<div id="success">Validation complete </div>
							<div id="fail">Validation failed </div>	
						
							<div class="form-group clearfix">
								<!--<div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg pull-left">
									<?php /*  $form->field($model, 'rememberMe',[
											'template'=>'{input}
												<label for="inputCheckbox">Remember Me</label>
											{hint}{error}' ])->checkbox(['label'=>'Remember Me']); */ ?>
								</div>-->
								<a class="pull-right" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/forgot-password");?>">Forgot password?</a>
							</div>

							<?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-lg margin-top-40', 'name' => 'login-button']) ?>
							
						<?php ActiveForm::end(); ?>
						<img src="<?php echo Url::to('@web/images/logo2.jpg', true); ?>" class="profile-photo image responsive" id="profile-photo" width="15" height="20" alt="logo Image"/><br>
						<div class="">© <?= date('Y'); ?> <a target="_blank" rel="noopener noreferrer" href="https://coach-to-transformation.com/">Coach-To-Transformation</a></div>
			</div>
        </div>
      </div>

<?php $this->registerCss('
	
	#success, #fail{
		display: none;

	}
	#message, #success, #fail{
		margin-top: 10px;
		margin-bottom: 10px;
	}

	p{
		display: inline;
		margin-right: 5px;
	}
	#ans{
		// border: 1px solid #FFBBD7;
		width: 60px;
		// height: 20px;
		text-align: center;
	}
');?>
<?php $this->registerJs("
$(document).ready(function() {

	/*$('#my-captcha-image').yiiCaptcha('refresh');
	$('#refresh-captcha').hide();
    $('#refresh-captcha').on('click', function(e){
        e.preventDefault();
        $('#my-captcha-image').yiiCaptcha('refresh');
    });
	if ($(window).width() < 960) {
		$('.g-recaptcha').css({'transform':'scale(0.77)'});
	}*/
	if ($(window).width() < 417) {
		var sp = (($(window).width() - 412))/2; 
		console.log(sp);
		$('.field-loginform-recaptcha').css('margin-left',sp+'px');
		// $('.clientlnk').hide();
	}
	else {
	   // alert('More than 960');
	   // $('.coachlnk').show();
	   // $('.clientlnk').show();
	}
	
	
	$('button[type=submit]').attr('disabled','disabled');
	console.log('test');
    var randomNum1;
    var randomNum2;

    //set the largeest number to display

    var maxNum = 20;
    var total;

    randomNum1 = Math.ceil(Math.random()*maxNum);
    randomNum2 = Math.ceil(Math.random()*maxNum);
    total =randomNum1 + randomNum2;

    $( '#question' ).prepend( randomNum1 + ' + ' + randomNum2 + '=' );

    // When users input the value

    $( '#ans' ).keyup(function() {

        var input = $(this).val();
        var slideSpeed = 200;

        $('#message').hide();
        if (input == total) {
            $('button[type=submit]').removeAttr('disabled');
            $('#success').slideDown(slideSpeed);
            $('#fail').slideUp(slideSpeed);
        }
        else {
            $('button[type=submit]').attr('disabled','disabled');
            $('#fail').slideDown(slideSpeed);
            $('#success').slideUp(slideSpeed);
        }

    });
});
"); ?>