<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\models\enums\DirectoryTypes;
use backend\models\enums\UserTypes;
use backend\models\enums\TimeZoneTypes;
use backend\models\enums\AsmTypes;
use common\models\User;
use common\models\Payment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\widgets\Toastr;
use yii\web\View;
use kartik\select2\Select2;
use common\models\Notification;
use common\models\Assessment;


AppAsset::register($this);
//$dashboardNotifications = Yii::$app->user?Yii::$app->user->identity->dashboardNotifications:[];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<base target="_parent"><!--href="https://www.w3schools.com/" -->
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!--stylesheet-->
    <?php $this->registerCssFile("@web/css/bootstrap-editable.css"); ?>
    <?php $this->registerCssFile("@web/css/bootstrap.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/bootstrap-extend.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/site.min3f0d.css?v2.2.0"); ?>

    <!--skintools-->
    <?php //$this->registerCssFile("@web/css/skintools.min3f0d.css?v2.2.0");?>
    <?php //$this->registerJsFile('@web/js/skintools.min.js');?>

    <!--plugins-->
    <?php $this->registerCssFile("@web/css/animsition.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/asScrollable.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/switchery.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/asSpinner.min3f0d.css"); ?>
    <?php $this->registerCssFile("@web/css/introjs.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/slidePanel.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/flag-icon.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/waves.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/toastr.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/summernote.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/font-awesome/font-awesome.min3f0d.css?v2.2.0"); ?>


    <?php $this->registerCssFile("@web/css/sweet-alert.css"); ?>
    <?php $this->registerCssFile("@web/css/modals.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/checkBo.min.css"); ?>
    <?php $this->registerCssFile("@web/css/chosen.min.css"); ?>
    <?php $this->registerCssFile("@web/css/clockpicker.min3f0d.css"); ?>
    <?php $this->registerCssFile("@web/css/bootstrap-datetimepicker.css"); ?>

    <!-- Page -->
    <?php //$this->registerCssFile("@web/css/login-v3.min3f0d.css?v2.2.0");?>
    <?php $this->registerCssFile("@web/css/v1.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/toastr.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/alerts.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/summernote.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/rating.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/social.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/chartjs.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/chart.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/chartist.min3f0d.css?v2.2.0"); ?>

    <!--fonts-->
    <?php $this->registerCssFile("@web/css/material-design.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/brand-icons.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto:400,400italic,700'); ?>

    <?php $this->registerJsFile('@web/js/modernizr.min.js', ["position" => View::POS_HEAD], 'modernizer'); ?>
    <?php $this->registerJsFile('@web/js/breakpoints.min.js', ["position" => View::POS_HEAD], 'breakpoint'); ?>


    <?php $this->registerJs('Breakpoints();', View::POS_HEAD, 'breakpoint-call'); ?>

</head>
<body class="dashboard site-navbar-small">


<?= toastr::widget() ?>
<?php $this->beginBody() ?>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<nav class="site-navbar navbar navbar navbar-fixed-top navbar-mega navbar"
     role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggle collapsed btmore" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <a class="navbar-brand navbar-brand-center"
           href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>">
            <!--<img class="navbar-brand-logo navbar-brand-logo-normal" src="<?= Yii::$app->urlManager->baseUrl; ?>/images/logo.png"
        title="Remark">-->
            <img class="navbar-brand-logo navbar-brand-logo-special"
                 src="<?= Yii::$app->urlManager->baseUrl; ?>/images/logo_new.jpg"
                 title="Training Enquiry Mangement">
			<!--<h3>Slot Scheduler</h3>-->
        </a>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="dropdown">
                    <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
          <?php  
		  // echo Yii::$app->user->identity->id; exit;
		  if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) { ?>
              <img src="<?= Url::to('@web/images/profile_pic.png', true); ?>" alt="...">
          <?php } ?>
                  <?php if (Yii::$app->user->identity->role == UserTypes::CLIENT) {
                      $model = User::findOne(Yii::$app->user->identity->id);?>
                      <img
                          src="<?= isset($model->media_id) ? DirectoryTypes::getParticipantDirectory(true) . $model->media->file_name : Url::to('@web/images/profile_pic.png', true); ?>"
                          alt="...">
                  <?php } ?>
                  <i></i>
              </span>
                <span>
                <?php if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) {
                    echo "Admin";
                } else {
                    ?>
                    <?= Yii::$app->user->identity->full_name;
                } ?>
                </span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <?php if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN ) { ?>

                            <li role="presentation">
                                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl("user/profile"); ?>"
                                   role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Edit Profile</a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" class="change-password"><i class="icon md-lock" aria-hidden="true"></i> Change Password</a>
                            </li>
                            <li class="divider" role="presentation"></li>
                        <?php } ?>

                        <?php if (Yii::$app->user->identity->role == UserTypes::CLIENT ) {

                            //if (Yii::$app->user->identity->accept_agreement == 1) {
                                ?>
                                <li role="presentation">
                                    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl("user/profile"); ?>"
                                       role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Edit
                                        Profile</a>
                                </li>
                                <li role="presentation">
                                    <a role="menuitem" class="change-password"><i class="icon md-lock" aria-hidden="true"></i> Change Password</a>
                                </li>
                                <li class="divider" role="presentation"></li>
                            <?php
                            //}
                        } ?>
                        <li role="presentation">
                            <a id="mainLogout" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/logout"); ?>"
                               role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
                        </li>
                    </ul>

                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
    </div>
</nav>
<div class="site-menubar">
<div class="site-menubar-body">
<div>
<div>
<ul class="site-menu">
<li class="site-menu-item">
    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>">
        <i class="site-menu-icon md-home" aria-hidden="true"></i>
        <span class="site-menu-title">Home</span>
    </a>
</li>

<?php if (Yii::$app->user->identity->role == (UserTypes::SUPER_ADMIN || UserTypes::CLIENT)) {  ?>
	<li class="dropdown site-menu-item has-sub" style="display:none">
        <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
            <i class="site-menu-icon md-account-box" aria-hidden="true"></i>
            <span class="site-menu-title">Clients</span>
            <span class="site-menu-arrow"></span>
        </a>

        <div class="dropdown-menu">
            <div class="site-menu-scroll-wrap is-list">
                <div>
                    <div>
                        <ul class="site-menu-sub site-menu-normal-list">
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl(["user/create-client","type"=>2]); ?>">
                                    <span class="site-menu-title">Add Client</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl(["user/index", 'type' => UserTypes::CLIENT]); ?>">
                                    <span class="site-menu-title">Manage Clients</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
	<li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("enquiry/index"); ?>">
            <i class="site-menu-icon md-star-outline" aria-hidden="true"></i>
            <span class="site-menu-title"> Enquiries</span>
		</a>
    </li>
	<li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("enquiry/potential"); ?>">
            <i class="site-menu-icon md-star-half" aria-hidden="true"></i>
            <span class="site-menu-title"> Potential</span>
		</a>
    </li>
	<li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("enquiry/joined"); ?>">
            <i class="site-menu-icon md-star" aria-hidden="true"></i>
            <span class="site-menu-title"> Confirmed</span>
		</a>
    </li>
	<li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("enquiry/closed"); ?>">
            <i class="site-menu-icon md-close" aria-hidden="true"></i>
            <span class="site-menu-title"> Closed Enquiries</span>
		</a>
    </li>
<?php } ?>

<?php if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) { ?>
	<li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("user/index"); ?>">
            <i class="site-menu-icon md-account-circle" aria-hidden="true"></i>
            <span class="site-menu-title"> Users</span>
		</a>
    </li>
<?php } ?>

<?php if (Yii::$app->user->identity->role == (UserTypes::SUPER_ADMIN || UserTypes::CLIENT) ) { ?>
	<li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("program/index"); ?>">
            <i class="site-menu-icon md-desktop-mac" aria-hidden="true"></i>
            <span class="site-menu-title"> Program</span>
		</a>
    </li>
	<li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("batch/index"); ?>">
            <i class="site-menu-icon md-city" aria-hidden="true"></i>
            <span class="site-menu-title"> Batches</span>
		</a>
    </li>
	<li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("elective/index"); ?>">
            <i class="site-menu-icon md-desktop-mac" aria-hidden="true"></i>
            <span class="site-menu-title"> Electives</span>
		</a>
    </li>
	
    <!--RDM 3-10-19 hide events menu-->
	<li class="site-menu-item" style="display:none">
		<a href="<?= Yii::$app->urlManager->createAbsoluteUrl("location/index"); ?>">
			<i class="site-menu-icon md-archive" aria-hidden="true"></i>
			<span class="site-menu-title">Country</span>
		</a>
	</li>
	<li class="site-menu-item">
		<a href="<?= Yii::$app->urlManager->createAbsoluteUrl("currency/index"); ?>">
			<i class="site-menu-icon md-archive" aria-hidden="true"></i>
			<span class="site-menu-title">Currency</span>
		</a>
	</li>
	<li class="dropdown site-menu-item has-sub">
        <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
            <i class="site-menu-icon md-assignment" aria-hidden="true"></i>
            <span class="site-menu-title"> Reports</span>
			<span class="site-menu-arrow"></span>
		</a>
		<div class="dropdown-menu">
            <div class="site-menu-scroll-wrap is-list">
                <div>
                    <div>
                        <ul class="site-menu-sub site-menu-normal-list">
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl("enquiry/alldata"); ?>">
                                    <span class="site-menu-title">All Data</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
<?php } ?>

<?php if (Yii::$app->user->identity->role == UserTypes::CLIENT) { ?>
<!--<li class="site-menu-item">-->
<!--</li>-->
<?php } ?>

<?php if (0) { ?>
	<li class="dropdown site-menu-item has-sub">
        <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
            <i class="site-menu-icon md-assignment" aria-hidden="true"></i>
            <span class="site-menu-title"> Questions</span>
			<span class="site-menu-arrow"></span>
		</a>
		<div class="dropdown-menu">
            <div class="site-menu-scroll-wrap is-list">
                <div>
                    <div>
                        <ul class="site-menu-sub site-menu-normal-list">
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl("question/create"); ?>">
                                    <span class="site-menu-title">Add Question</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl(["question/index"]); ?>">
                                    <span class="site-menu-title">Manage Questions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
	<li class="dropdown site-menu-item has-sub">
        <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
            <i class="site-menu-icon md-assignment" aria-hidden="true"></i>
            <span class="site-menu-title"> Company</span>
			<span class="site-menu-arrow"></span>
		</a>
		<div class="dropdown-menu">
            <div class="site-menu-scroll-wrap is-list">
                <div>
                    <div>
                        <ul class="site-menu-sub site-menu-normal-list">
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl(["company/index"]); ?>">
                                    <span class="site-menu-title">Manage Companies</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>

<?php } ?>



<?php if (0) { //Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN ?> 
    <!--<li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("location/index"); ?>">
            <i class="site-menu-icon md-city" aria-hidden="true"></i>
            <span class="site-menu-title"> Country/Locations</span></a>
    </li>-->

   <!-- <li class="dropdown site-menu-item has-sub">
        <a class="animsition-link" href="<?php // Yii::$app->urlManager->createAbsoluteUrl("country/index"); ?>">
            <i class="site-menu-icon md-globe" aria-hidden="true"></i>
            <span class="site-menu-title">Countries</span></a>
    </li>-->
    <li class="dropdown site-menu-item has-sub">
        <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
            <i class="site-menu-icon md-receipt" aria-hidden="true"></i>
            <span class="site-menu-title">More</span>
            <span class="site-menu-arrow"></span>
        </a>

        <div class="dropdown-menu">
            <div class="site-menu-scroll-wrap is-list">
                <div>
                    <div>
                        <ul class="site-menu-sub site-menu-normal-list">
							<li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl("location/index"); ?>">
                                    <span class="site-menu-title">Country/Locations</span>
                                </a>
                            </li>
							<!--<li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl("faculty/create"); ?>">
                                    <span class="site-menu-title">Add faculty</span>
                                </a>
                            </li>-->
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?= Yii::$app->urlManager->createAbsoluteUrl("batch-user/index"); ?>">
									<span class="site-menu-title">Certification</span>
								</a>
                            </li>
							<!--<li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl("company/create"); ?>">
                                    <span class="site-menu-title">Add company</span>
                                </a>
                            </li>-->
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="<?= Yii::$app->urlManager->createAbsoluteUrl("template/index"); ?>">
                                    <span class="site-menu-title">Manage Templates</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
<?php } ?>

	<?php if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN){ ?>

		
		<li class="site-menu-item editpr" style="display:none">
			<a href="<?= Yii::$app->urlManager->createAbsoluteUrl("user/profile"); ?>">
				<i class="site-menu-icon md-account" aria-hidden="true"></i> 
				<span class="site-menu-title">Edit Profile</span>
			</a>
		</li>
		<!--<li class="site-menu-item">
			<a role="menuitem" class="change-password">
				<i class="site-menu-icon md-lock" aria-hidden="true"></i> 
				<span class="site-menu-title">Change Password</span>
			</a>
		</li>-->
	<?php } ?>

	<?php if (Yii::$app->user->identity->role == UserTypes::CLIENT) {

		//if (Yii::$app->user->identity->accept_agreement == 1) {
			?>
			<li class="site-menu-item editpr" style="display:none">
				<a href="<?= Yii::$app->urlManager->createAbsoluteUrl("user/profile"); ?>">
					<i class="site-menu-icon md-account" aria-hidden="true"></i>
					<span class="site-menu-title">Edit Profile</span>
				</a>
			</li>
			<!--<li role="presentation">
				<a role="menuitem" class="change-password"><i class="icon md-lock" aria-hidden="true"></i> Change Password</a>
			</li>-->
		<?php
		//}
	} ?>
	<li class="site-menu-item logout" style="display:none">
		<a id="mainLogout2" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/logout2"); ?>">
			<i class="site-menu-icon md-power" aria-hidden="true"></i> 
			<span class="site-menu-title">Logout</span>
		</a>
	</li>
		
</ul>
</div>
</div>
</div>
</div>


<?= $content ?>


<!-- Footer -->
<footer class="site-footer">
    <!--<div class="site-footer-legal">© <?= date('Y'); ?> <a href="#">InMuto Consulting LLP</a></div>-->
    <div class="site-footer-legal">© <?= date('Y'); ?> <a target="_blank" rel="noopener noreferrer" href="https://www.coach-to-transformation.com/">Training Enquiry Management
	</a></div>
    <div class="site-footer-right">
        <!--Crafted with <i class="red-600 icon md-favorite"></i> by <a href="http://fierydevs.com">Fierydevs</a>-->
		<img src="<?php echo Url::to('@web/images/logo2.jpg', true); ?>" class="profile-photo image responsive" id="profile-photo" width="15" height="20" alt="logo Image"/>
    </div>
</footer>
<!-- Core  -->

<?php echo $this->render("change_password_popup"); ?>

<?php $this->registerJs('
	$("document").ready(function(){
		// $("nav").css("position","fixed");
		$(".select2-dropdown").css("z-index","100000");
	});
		$("#mainLogout").on("click",function(e){
			e.preventDefault();
			var url = $(this).attr("href");
			$.ajax({
				type:"post",
				url:url
			});
		});
		$("#mainLogout2").on("click",function(e){
			e.preventDefault();
			var url = $(this).attr("href");
			$.ajax({
				type:"post",
				url:url
			});
		});
		$(".toastclose").on("click",function(e){
			$("#toast-top-right").remove();
			
		
		});
		$(".change-password").on("click", function() {
			$.ajax({
				url: "' . Yii::$app->urlManager->createUrl('site/change-password') . '",
				data: {},
				method: "POST",
				success: function(data) {
					$("#modal-content-password").html(data);
					$("#examplePasswordPopup").modal("show");
				},
				error: function(error) {
					
				}
			});
		});
		
		if ($(window).width() < 750) {
		   // alert("Less than 750");
		   $(".site-menu-title").css("color","#fff");
		   $(".btmore").hide();
		   $(".editpr").show();
		   $(".logout").show();
		   $(".page-content").css("padding","0");
		   // $(".row").css("margin-right","0");
		   // $(".row").css("margin-left","0");
		   $(".example-wrap").parent().css("padding","0");
		}
		else {
		   // alert("More than 750");
		   // $(".site-menu-title").css("color","#e65a00");
		   $(".clientlnk").show();
		   $(".editpr").hide();
		   $(".logout").hide();
		   $(".page-content").css("padding","30px 30px");
		}
		console.log($(window).width());
	// $(document).ready(function() {
		// $("#examplePasswordPopup").hide();
	// });
			
			
			
		
		
		
', View::POS_END, 'logout');?>

<?php echo $this->render("_js_css_includes"); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
