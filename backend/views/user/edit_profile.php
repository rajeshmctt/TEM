<?php
/**
 * Created by PhpStorm.
 * User: Priyanka
 * Date: 05-05-2016
 * Time: 19:14
 */
use backend\models\enums\DirectoryTypes;
use backend\models\enums\ICFTypes;
use backend\models\enums\UserTypes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\View;

$this->title = 'Edit Profile: ' . $model->full_name;
$this->params['breadcrumbs'][] = $this->title;
?>

    <!-- Page -->
    <div class="page">
    <?php if (!Yii::$app->request->get("ajax")) { ?>
        <div class="page-header">
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>"
                       data-link-to="site">Home</a></li>
                <?php foreach ($this->params['breadcrumbs'] as $k => $v) {
                    if (isset($v['label'])) {
                        echo "<li><a href=" . Yii::$app->urlManager->createAbsoluteUrl($v['url'][0]) . ">" . $v['label'] . "</a></li>";
                    } else {
                        echo "<li class='active'>$v</li>";
                    }
                }?>
            </ol>
        </div>
    <?php } ?>
    <div class="page-content">
    <div class="panel">
    <div class="panel-body container-fluid">
    <?php if (!Yii::$app->request->get("ajax")) { ?>
        <button id="change-password" class="btn btn-success pull-right" type="button">Change password</button>
    <?php } ?>

    <!--<button class="btn btn-success pull-right" data-target="#exampleNiftyFadeScale" data-toggle="modal"
type="button">Change password</button>
<div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content modal-top">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<h4 class="modal-title">Change Password</h4>
</div>
<div class="modal-body">

<?php $form = ActiveForm::begin(); ?>
<div class="form-group form-material popup">

<label class="control-label">Old Password</label>
<?= $form->field($password_model, 'old_password')->passwordInput()->label(false) ?>

</div>
<div class="form-group form-material popup">

<label class="control-label">New Password</label>
<?= $form->field($password_model, 'new_password')->passwordInput()->label(false) ?>

</div>
<div class="form-group form-material popup">

<label class="control-label">Confirm Password</label>
<?= $form->field($password_model, 'confirm_password')->passwordInput()->label(false) ?>

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-pure margin-0" data-dismiss="modal">Close</button>

<?= Html::submitButton('Change Password', ['class' => 'btn btn-success pull-right']) ?>
<?php ActiveForm::end(); ?>
</div>
</div>
</div>
</div>-->


    <div class="row row-lg">
    <div class="col-sm-10 col-md-offset-1">
    <!-- Example Basic Form -->
    <div class="example-wrap">
    <div class="example">
    <?php if (1) { ?>					<!-- $model->role != UserTypes::COACH  *********************** for coach  ******************** -->
        <div class="main-content checkbo">
		<?php if(!Yii::$app->request->get("ajax")){?>
        <!--<form id=commentForm class=form-horizontal role=form>-->
        <?php $form = ActiveForm::begin([
//  'enableClientValidation' => true,
// 'validateOnSubmit' => true,
            'options' => [
                'enctype' => 'multipart/form-data',
                'id' => 'coach_form',
            ]
        ]); ?>
        <?php if(0){ ?>
		<div class="box-tab justified" id=rootwizard>
        <ul class="nav nav-tabs">
            <li class="active"><a href=#tab1 data-toggle=tab aria-expanded="true" data-no-link="true">Personal</a></li>
            <li><a href=#tab2 data-toggle=tab data-no-link="true">Coaching</a></li>
            <li><a href=#tab3 data-toggle=tab data-no-link="true">Coaching Mode</a></li>
            <li><a href=#tab4 data-toggle=tab data-no-link="true">Additional Details</a></li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active wizard-tab" id=tab1>
		<?php } ?>
            <div class="form-group row"><!-- form-material-->
                <div class="col-sm-6">
                    <label class="control-label">Email</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'email')->textInput(['disabled' => true])->label(false) ?>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Contact No</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'contact_no')->textInput(['id' => 'customer_phone'])->label(false); ?><!--, 'name' => 'contact_no'-->
                    <p class="theme_2 help-block">+91(8567)234-678</p>

                    <div style="display:none;" class="theme"><input type="checkbox" id="phone_mask" checked></div>
                    <label id="descr" class="mask-label"></label>
                </div>
            </div>

            <div class="form-group row"><!--- form-material-->
                <div class="col-sm-6">
                    <label class="control-label">Full Name</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'full_name')->textInput()->label(false) ?><!--['name' => 'full_name']-->
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Username</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'username')->textInput()->label(false) ?>
                </div>
            </div>
			<!--Rajesh 26-8-19 one page form -->
			<div class="form-group form-material">
				<?= Html::submitButton('Update', ['class' => 'btn btn-success pull-right']) ?>
			</div>
			
			<!--Disable old code 26-8-19 rajesh-->
            <!--<div class=wizard-pager>
                <div class=pull-right>
                    <button type=button class="btn btn-default button-previous">Previous</button>
                    <button type=button class="btn btn-success button-next">Next</button>
                </div>
            </div>-->
			
		<!--Disable old code 26-8-19 rajesh--><!--Rajesh 26-8-19 one page form -->
        <?php if(0){ ?>
		</div>
        <div class="tab-pane wizard-tab" id=tab2>
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    <label class="control-label">ICF Credentials</label><span class="red-theme">*</span><br>

                    <div class="form-group">
                        <label class="switch switch-sm">
                            <input type=radio id="ic1" value="<?= ICFTypes::ICF_ACC ?>" name="icf_credentials"
                                <?= $model->icf_credentials == ICFTypes::ICF_ACC ? 'checked' : ''; ?>>
                            <span class="switch-span">
                                <i class=handle></i>
                            </span>
                        </label>
                        <label for="ic1" class="control-label">ICF ACC</label>
                    </div>
                    <div class="form-group">
                        <label class="switch switch-sm">
                            <input id="ic2" type=radio value="<?= ICFTypes::ICF_PCC ?>" name="icf_credentials"
                                <?= $model->icf_credentials == ICFTypes::ICF_PCC ? 'checked' : ''; ?>>
                            <span class="switch-span">
                                <i class=handle></i>
                            </span>
                        </label>
                        <label for="ic2" class="control-label">ICF PCC</label>
                    </div>
                    <div class="form-group">
                        <label class="switch switch-sm">
                            <input id="ic3" type=radio value="<?= ICFTypes::ICF_MCC ?>" name="icf_credentials"
                                <?= $model->icf_credentials == ICFTypes::ICF_MCC ? 'checked' : ''; ?>>
                            <span class="switch-span">
                                <i class=handle></i>
                            </span>
                        </label>
                        <label for="ic3" class="control-label">ICF MCC</label>
                    </div>
                    <div class="form-group">
                        <label class="switch switch-sm">
                            <input id="ic4" type=radio value="<?= ICFTypes::NONE_FROM_ICF ?>" name="icf_credentials"
                                <?= $model->icf_credentials == ICFTypes::NONE_FROM_ICF ? 'checked' : ''; ?>>
                            <span class="switch-span">
                                <i class=handle></i>
                            </span>
                        </label>
                        <label for="ic4" class="control-label">None From ICF</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Non ICF Credentials</label>
                    <?= $form->field($model, 'non_icf_credentials')->textarea(['rows' => 6])->label(false) ?>
                </div>
            </div>
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    <label class="control-label">Years Of Actual Coaching Experience</label><span
                        class="red-theme">*</span>
                    <?= $form->field($model, 'years_of_experience')->textarea(['rows' => 6, 'name' => 'years_experience'])->label(false) ?>
                    <p class="theme_2 help-block">&nbsp Number of years since you got a coaching credential</p>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Assessment Tools Certifications</label>
                    <?= $form->field($model, 'certificates')->textarea(['rows' => 6])->label(false) ?>
                    <p class="theme_2 help-block">If Any</p>
                </div>
            </div>
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    <label class="control-label">Individual Clients</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'individual_clients')->textarea(['rows' => 6, 'name' => 'individual_client'])->label(false) ?>
                    <p class="theme_2 help-block">Number of Individual clients coached you have worked with as a Coach.
                        Include total number of coaching hours done till date after your credential</p>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Client Organizations</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'client_organization')->textarea(['rows' => 6, 'name' => 'client_organization'])->label(false) ?>
                    <p class="theme_2 help-block">Client organizations you have worked with as a Coach. Include total
                        number of coaching hours done till date after your credential.</p>
                </div>
            </div>
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    <label class="control-label">Coaching Philosophy</label>
                    <?= $form->field($model, 'philosophy')->textarea(['rows' => 6])->label(false) ?>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Bio</label>
                    <?= $form->field($model, 'bio')->textarea(['rows' => 6])->label(false) ?>
                    <p class="theme_2 help-block">Anything else you want to share with us which differentiates
                        you!! </p>

                </div>
            </div>
            <div class=wizard-pager>
                <div class=pull-right>
                    <button type=button class="btn btn-default button-previous">Previous</button>
                    <button type=button class="btn btn-success button-next">Next</button>
                </div>
            </div>
        </div>
        <div class="tab-pane wizard-tab" id=tab3>
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    <label class="control-label">Minimum Price</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'min_price')->textInput(['name' => 'min_price'])->label(false) ?>
                    <p class="theme_2 help-block">This is the minimum below which you want take up assignments. You will
                        have a choice to change the prices later on.</p>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Maximum Price</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'max_price')->textInput(['name' => 'max_price'])->label(false) ?>
                    <p class="theme_2 help-block">Think carefully before deciding since it will be used to shortlist
                        your profile. You will have a choice to change the prices later on.</p>
                </div>
            </div>
            <div class="form-group form-material row">
                <div class="col-sm-6">

                    <label class="control-label">Coaching Medium</label><span class="red-theme">*</span>

                    <p class="theme_medium help-block">Which coaching medium(s) are you comfortable with?</p>
                    <?= $form->field($model, 'coaching_medium')->checkboxList(['Face To Face' => 'Face To Face', 'Video Calls' => 'Video Calls', 'Phone Calls' => 'Phone Calls', 'Other' => 'Other'], ['itemOptions' => ['class' => 'checkboxlist']])->label(false) ?>
                    <?= Html::input('text', 'other_medium', $other_text, ['class' => 'form-control', 'id' => 'other_txt']); ?>
                    <h5 style="display:none;" class='error red-theme' id="other_error">Other Medium can not br
                        blank.</h5>
                </div>
            </div>
            <div class=wizard-pager>
                <div class=pull-right>
                    <button type=button class="btn btn-default button-previous">Previous</button>
                    <button type=button class="btn btn-success button-next">Next</button>
                </div>
            </div>
        </div>
        <div class="tab-pane wizard-tab" id=tab4>
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    <label class="control-label">Domain Experience</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'domain_experience')->textarea(['rows' => 6, 'name' => 'domain_experience'])->label(false) ?>
                    <p class="theme_2 help-block">Your past experience including organizations, department and
                        designation. Whatever is relevant to your coaching profile</p>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Languages</label>
                    <?= $form->field($model, 'languages')->textarea(['rows' => 6])->label(false) ?>
                </div>
            </div>
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    <label class="control-label">Graduation Degree</label><span class="red-theme">*</span>
                    <?= $form->field($model, 'graduation_degree')->textarea(['rows' => 6, 'name' => 'graduation_degree'])->label(false) ?>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Post Graduation Degree</label>
                    <?= $form->field($model, 'post_graduation_degree')->textarea(['rows' => 6])->label(false) ?>
                    <p class="theme_2 help-block">If Any</p>
                </div>
            </div>
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    <label class="control-label">Publications</label>
                    <?= $form->field($model, 'publications')->textarea(['rows' => 6])->label(false) ?>
                    <p class="theme_2 help-block">If Any</p>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Blog URL</label>
                    <?= $form->field($model, 'blog_url')->textarea(['rows' => 6])->label(false) ?>
                    <p class="theme_2 help-block">If Any</p>
                </div>
            </div>
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    <label class="control-label">Books</label>
                    <?= $form->field($model, 'books')->textarea(['rows' => 6])->label(false) ?>
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Awards</label>
                    <?= $form->field($model, 'awards')->textarea(['rows' => 6])->label(false) ?>
                    <p class="theme_2 help-block">If Any</p>
                </div>
            </div>
            <div class=wizard-pager>
                <div class=pull-right>
                    <button type=button class="btn btn-default button-previous">Previous</button>
                    <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
		</div>
        </div>
        <?php } ?>
        <?php ActiveForm::end(); ?>
		<?php }else{
						echo $this->render("_edit_profile_for_app",["model"=>$model,'location_name' => $location_name,'locationname' => $locationname,'country_name' => $country_name,'countryname' => $countryname,'other_text'=>$other_text]);
					}
		?>
        </div>
    <?php } ?>
    <div class="hidden" id="user-edit-profile-medium-json"><?= json_encode($med); ?></div>
    </div>
    </div>
    <!-- End Example Basic Form -->
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- End Page -->
<?php

$this->registerJs('
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#profile-photo").attr("src", e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function(){

    var maskList = $.masksSort($.masksLoad("' . Url::base() . '/js/phone-codes.json"), ["#"], /[0-9]|#/, "mask");
    var maskOpts = {
		inputmask: {
			definitions: {
				"#": {
					validator: "[0-9]",
					cardinality: 1
				}
			},
			//clearIncomplete: true,
			showMaskOnHover: false,
			autoUnmask: true
		},
		match: /[0-9]/,
		replace: "#",
		list: maskList,
		listKey: "mask",
		onMaskChange: function(maskObj, completed) {
			if (completed) {
				var hint = maskObj.name_en;
				if (maskObj.desc_en && maskObj.desc_en != "") {
					hint += " (" + maskObj.desc_en + ")";
				}
				$("#descr").html(hint);
			} else {
				$("#descr").html("");
			}
			$(this).attr("placeholder"," ");
		}
    };

    $("#phone_mask").change(function() {
		if ($("#phone_mask").is(":checked")) {
			$("#customer_phone").inputmasks(maskOpts);
		} else {
			$("#customer_phone").inputmask("+[####################]", maskOpts.inputmask).attr("placeholder"," ");
			$("#descr").html("");
		}
    });

    $("#phone_mask").change();

    $("#change-password").on("click", function() {
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
	/*$("#country").select2().change(function(){
		var country_name = $(this).val();
		$.ajax({
			url: "' . Yii::$app->getUrlManager()->createUrl(['organization/search-for-location']) . '",
			data: {country_name:country_name},
			success: function (data) {
				var obj = JSON.parse(data);
				//alert(obj.results);
				$("#location").select2().empty().select2({data: obj.results} );
				$("#location").select2({tags:true,width :"100%"});
			}
		});
	});*/

    $(".error").hide();
    $(".error1").hide();
    $("#other_txt").hide();

    $("#user-media_id").innerHTML = "";
    $("#user-media_id").change(function(){
        readURL(this);
    });
    $("#user-media_id").click(function() {
        $("input[id=\'profile-photo\']");
    });

    var med = ' . json_encode($med) . ';

    if($.inArray("Other", med) !== -1){
        $("#other_txt").show();
    }

    $(".checkboxlist").on("change", function() {
        var is_checked= $(this).is(":checked");
        if (is_checked){
            if($(this).val()=="Other")
            {
                $("#other_txt").show();
                	if($("#other_txt").val()==""){
                $("#other_error").show();
			$(".button-next").attr("disabled","disabled");
			}
            }
        }
        if (!is_checked){
            if($(this).val()=="Other")
            {
                $("#other_txt").hide();
					   $("#other_error").hide();
					$(".button-next").removeAttr("disabled");
            }
        }
    });

     $("#other_txt") .on("focusout",function() {
            if($(this).val()==""){
                $("#other_error").show();
			$(".button-next").attr("disabled","disabled");
			}
            else{
                 $("#other_error").hide();
				 $(".button-next").removeAttr("disabled");
			}
        });
		$("#location") .on("change",function() {
			console.log($(this).val());
			if($(this).val().length==0){
				console.log("empty");
				$(".loc-block").show();
			}
			else{
				$(".loc-block").hide();
			}
		});
});	

');

