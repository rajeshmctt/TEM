<?php
/**
 * Created by PhpStorm.
 * User: Priyanka
 * Date: 28-04-2016
 * Time: 19:10
 */
use yii\helpers\Html;
use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;

AppAsset::register($this);
$this->beginPage() ?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<!-- Mirrored from urban.nyasha.me/html/extras-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Dec 2015 12:49:02 GMT -->
<head>
	<base target="_parent">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
   <!--stylesheet-->
  
    <?php $this->registerCssFile("@web/css/bootstrap.min3f0d.css?v2.2.0");?>
    <?php $this->registerCssFile("@web/css/bootstrap-extend.min3f0d.css?v2.2.0");?>
    <?php $this->registerCssFile("@web/css/site.min3f0d.css?v2.2.0");?>
	
	<!--skintools-->
<!--	<?php /*$this->registerCssFile("@web/css/skintools.min3f0d.css?v2.2.0");?>
 --><?php /*$this->registerJsFile('@web/js/skintools.min.js'); */?>
	
	 
	  
	<!--plugins-->
	 <?php $this->registerCssFile("@web/css/animsition.min3f0d.css?v2.2.0");?>
	 <?php $this->registerCssFile("@web/css/asScrollable.min3f0d.css?v2.2.0");?>
	 <?php $this->registerCssFile("@web/css/switchery.min3f0d.css?v2.2.0");?>
	 <?php $this->registerCssFile("@web/css/introjs.min3f0d.css?v2.2.0");?>
	 <?php $this->registerCssFile("@web/css/slidePanel.min3f0d.css?v2.2.0");?>
	 <?php $this->registerCssFile("@web/css/flag-icon.min3f0d.css?v2.2.0");?>
	 <?php $this->registerCssFile("@web/css/waves.min3f0d.css?v2.2.0");?>
	
	 <!-- Page -->
	    <?php $this->registerCssFile("@web/css/login-v3.min3f0d.css?v2.2.0");?>
	
	<!--fonts-->
 <?php $this->registerCssFile("@web/css/material-design.min3f0d.css?v2.2.0");?>
 <?php $this->registerCssFile("@web/css/brand-icons.min3f0d.css?v2.2.0");?>
 <?php $this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto:400,400italic,700');?>
	
	 <?php $this->registerJsFile('@web/js/modernizr.min.js'); ?>
	 <?php $this->registerJsFile('@web/js/breakpoints.min.js'); ?>


</head>
<body class="page-login-v3 layout-full" >
<!--start page-->
<!--<div class="container">-->
<!--<div class="row">
	<div class="col-md-4">
		<div class="page animsitio vertical-align text-center padding-top-70">
			<div class="page-content vertical-align-middle">
				<div class="panel">
					<div class="panel-body">
						if you are a Client and interested in Coaching or Internal coach training, then please contact us <br><a href="https://coach-to-transformation.com/contact-us/" class="btl"><span class="btn btn-success  btn-md margin-top-10 margin-bottom-10 waves-effect waves-light">Contact us</span></a><br> or call us at +919971701403 
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">-->
		<div class="page animsitio vertical-align text-center " data-animsition-in="fade-in" data-animsition-out="fade-out">
		<!--<div class="page animsitio vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">-->
		<!--<div class="page animation vertical-align text-center" data-animation-in="fade-in" data-animation-out="fade-out">-->
			<!--<div class="page animsitio vertical-align text-center padding-top-70" style="position:absolute; top:100px; left:20px;">-->
			
			<!--not needed for lms 4-8-18 rajesh-->
			<!--<div class="page-content vertical-align-middle hidden-sm hidden-xs"  style="width:calc(45% - 200px)">
				<div class="panel2">
					<div class="panel2-body">
						if you are a <span style="color:#00afd8; ">Client </span>and interested in Coaching or Internal coach training, then please contact us <br><?= Html::a('<span class="btn btn-warning  btn-md margin-top-10 margin-bottom-10 waves-effect waves-light "  data-target="#contact" data-toggle="modal">Contact us</span>', "javascript:void(0);", [
							'title' => Yii::t('yii', 'Contact Us'),
						]); ?><br> or call us at +919971701403 
						
					</div>
				</div>
			</div>-->
			<!--<a href="https://coach-to-transformation.com/contact-us/" class="btl"><span class="btn btn-warning  btn-md margin-top-10 margin-bottom-10 waves-effect waves-light">Contact us</span></a>-->
			
			
			<div class="page-content vertical-align-middle">
				<?= $content; ?>

			  <footer class="page-copyright page-copyright-inverse">
				<!--<p>WEBSITE BY amazingSurge</p>-->
				<p>© <?= date('Y'); ?>. All RIGHT RESERVED.</p>
				<!--<div class="social">
				  <a class="btn btn-icon btn-pure" href="javascript:void(0)">
					<i class="icon bd-twitter" aria-hidden="true"></i>
				  </a>
				  <a class="btn btn-icon btn-pure" href="javascript:void(0)">
					<i class="icon bd-facebook" aria-hidden="true"></i>
				  </a>
				  <a class="btn btn-icon btn-pure" href="javascript:void(0)">
					<i class="icon bd-google-plus" aria-hidden="true"></i>
				  </a>
				</div>--><!--RDM 3-10-2019 hide-->
			  </footer>
			</div>
			
			<!--not needed in lms -->
			<!--<div class="page-content vertical-align-middle"  style="width:calc(45% - 200px)">
				<div class="panel2">
					<div class="panel2-body">
						If you are a <span style="color:#00afd8; ">Coach</span> and intersted in getting coaching work through us, please register yourself here and we will reach out to you.<br><a href="https://coach-to-transformation.com/coach-registration-form/" class="btl"><span class="btn btn-warning  btn-md margin-top-10 margin-bottom-10 waves-effect waves-light">Register Now</span></a> 
					</div>
				</div>
			</div>-->
			
		</div><!--end page-->
	<!--</div>
	
	<div class="col-md-4">
		<div class="page animsitio vertical-align text-center padding-top-70">
			<div class="page-content vertical-align-middle">
				<div class="panel">
					<div class="panel-body">
						If you are a Coach and intersted in getting coaching work through us, please register yourself here and we will reach out to you.<br><a href="https://coach-to-transformation.com/coach-registration-form/" class="btl"><span class="btn btn-success  btn-md margin-top-10 margin-bottom-10 waves-effect waves-light">Register Now</span></a> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>-->
<!--</div>-->
	<div class="modal fade modal-fade-in-scale-up modal-theme" id="contact" aria-hidden="true"
         aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content agreement-modal" id="modal-content">
				<?php $form = ActiveForm::begin([
					'action' => ['site/contact'],
					'method' => 'get',
					'id'=>'contact-form',
					/*'options' => [
							'enctype' => 'multipart/form-data',
						]*/
					]); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="close-theme">×</span>
                    </button>
                    <h4 class="modal-title modal-title-theme">Contact Us</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="name" class="control-label">Name</label>
							<input type="text" id="name" name="name" class="form-control" placeholder="Your Name"/>
							<!--<h5 class="red-theme" id="common-name">name</h5>-->
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="control-label">Email</label>
							<input type="text" id="email" name="email" class="form-control" placeholder="Your Email"/>
							<!--<h5 class="red-theme" id="common-name">name</h5>-->
						</div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="subject" class="control-label">Subject</label>
							<input type="text" id="subject" name="subject" class="form-control" placeholder="Subject"/>
                        </div>
                    </div>
					<div class="form-group row">
                        <div class="col-md-12">
                            <label for="message" class="control-label">Message</label>
							<textarea id="message" name="message" class="form-control" placeholder="Message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-success btn-pure margin-0 btn-check" data-dismiss="modal">Send a Message</button>-->
                    <input type="submit" class="btn btn-success btn-pure margin-0 btn-check"  value="Send a Message">
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php $this->render("_js_css_includes"); ?>

<?php $this->registerJs('
Breakpoints();
(function(document, window, $) {
      "use strict";

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
		// console.log("yetstst");
      });
    })(document, window, jQuery);
', \yii\web\View::POS_END); ?>

 

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
