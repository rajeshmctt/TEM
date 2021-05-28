<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\enums\UserTypes;
use yii\helpers\Url;
use kartik\select2\Select2;
use common\models\Company;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="page-content">
    <div class="panel">
    <div class="panel-body container-fluid">
    <div class="row row-lg">
    <div class="col-sm-10 col-md-offset-1">
    <!-- Example Basic Form -->
    <div class="example-wrap">
    <div class="example">
    <?php if ($model->role == UserTypes::CLIENT) { ?>
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'data-link-to' => 'user-create'
            ]
        ]); ?>


        <div class="form-group row"><!--form-material-->
            <div class="col-sm-6">
                <label class="control-label">First Name<span class="red-theme">*</span></label>
                <?= $form->field($model, 'first_name')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Last Name</label>
                <?= $form->field($model, 'last_name')->textInput()->label(false) ?>
            </div>
        </div>
		<div class="form-group row"><!--form-material-->
            <div class="col-sm-6">
                <label class="control-label">Email<span class="red-theme">*</span></label>
                <?= $form->field($model, 'email')->textInput()->label(false) ?>
				
				<h5 style="display: none;" class='error red-theme' id="email_error" style="display: none">Email has already been taken.<a href="" id="conv" class="btn btn-success btn-xs">Check User</a></h5>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Password<span class="red-theme">*</span></label>
                <?= $form->field($model, 'password_hash')->passwordInput()->label(false) ?>
            </div>
        </div>
		<div class="form-group row"><!--form-material-->
            <div class="col-sm-6">
                <label class="control-label">Company<span class="red-theme">*</span></label>
                <?= $form->field($model, 'company')->textInput()->label(false) ?>
            </div>
        </div>
        <div class="form-group row"><!--form-material-->
            <div class="col-sm-6">
                <label class="control-label">Contact No<span class="red-theme">*</span></label>
                <?= $form->field($model, 'contact_no')->textInput(['id' => 'customer_phone'])->label(false); ?>
                <p class="theme_2 help-block">+91(8567)234-678</p>

                <div style="display:none;" class="theme"><input type="checkbox" id="phone_mask" checked></div>
                <label id="descr" class="mask-label"></label>
            </div>
			<div class="col-sm-6">
				<label class="control-label">Status</label>
				<?= $form->field($model, 'status')->dropDownList($status, ['options' => [$model->status => ['Selected' => 'selected']]])->label(false) ?>
			</div>

        </div>
        <div class="form-group form-material">
            <?= Html::submitButton('Add', ['class' => 'btn btn-success pull-right btn_client_add']) ?>
        </div>
		<?php ActiveForm::end(); ?>
    <?php }else { ?>
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'data-link-to' => 'user-create'
            ]
        ]); ?>
		<?= $form->field($model, 'flag')->hiddenInput()->label(false) ?>
		<?php if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) { ?>
            <div class="form-group form-material row">
                <div class="col-sm-2" >
                    <?= $form->field($model, 'media_id')->fileInput() ?>
                    <div style="position:relative"><img src="<?php echo Url::to('@web/images/profile_pic.png', true); ?> "
                         class="profile-photo image responsive" id="profile-photo" width="100" height="100"
                         alt="Profile Image"/>
					<img src="<?php echo Url::to('@web/images/cam.png', true); ?> "
                         class="image responsive" id="cam" style="position:absolute; bottom:0; left:0"
                         alt="Profile Image"/></div>
                </div>
                <div class="col-sm-4"></div>
                <!--<div class="col-sm-2">
                    <label class="control-label">Client Agreement</label>
                    <?= Html::a('<i id="agreement" class="icon md-assignment agreement-icon" data-target="#viewAgreement" data-toggle="modal"></i>', "javascript:void(0);", [
                        'title' => Yii::t('yii', 'View Agreement'),
                    ]); ?>
                    <input type="hidden" class="hidden_agreement" name="agreement"  value=<?php $agreement ?>>

                    <h5 class="agreement_error red-theme" style="display: none">Agreement cannot be blank</h5>

				</div>-->
            </div>
        <?php } ?>


        <div class="form-group row"><!--form-material-->
            <div class="col-sm-6">
                <label class="control-label">First Name<span class="red-theme">*</span></label>
                <?= $form->field($model, 'first_name')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Last Name</label>
                <?= $form->field($model, 'last_name')->textInput()->label(false) ?>
            </div>
        </div>
		<div class="form-group row"><!--form-material-->
            <div class="col-sm-6">
                <label class="control-label">Email<span class="red-theme">*</span></label>
                <?= $form->field($model, 'email')->textInput()->label(false) ?>
				
				<h5 style="display: none;" class='error red-theme' id="email_error" style="display: none">Email has already been taken.<a href="" id="conv2" class="btn btn-success btn-xs">Check User</a></h5>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Password<span class="red-theme">*</span></label>
                <?= $form->field($model, 'password_hash')->passwordInput()->label(false) ?>
            </div>
        </div>
        
        <div class="form-group row"><!--form-material-->
            <div class="col-sm-6">
                <label class="control-label">Country<span class="red-theme">*</span></label>
                <?= Select2::widget([
                    'name' => 'User[country_id]',
                    'id' => 'country_first',
                    'value' => 'country', // initial value
                    'data' => $countryname,
                    'options' => ['placeholder' => 'Select a Country'],
                    'pluginOptions' => ['tags' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumInputLength' => 20,
                    ],]); ?>
                <p class="theme_3 help-block">&nbsp You can also add a new Country</p>
                <h5 class='error red-theme' style="display: none">Country cannot be a number.</h5>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Location<span class="red-theme">*</span></label>
                <?= Select2::widget([
                    //'name' => 'User[location_id]',
                    'name' => 'User[location]',
                    'id' => 'location_first',
                    'value' => 'location', // initial value
                    'data' => [],
                    'options' => ['placeholder' => 'Select a Location'],
                    'pluginOptions' => ['tags' => true,
                        'tokenSeparators' => [',', ' '],
                        'multiple'=>true,
                        'maximumInputLength' => 10],]); ?>
                <p class="theme_3 help-block">&nbsp You can also add a new Location</p>
                <h5 class='error1 red-theme' style="display: none">Location cannot be a number.</h5>
            </div>
        </div>
        <div class="form-group row"><!--form-material-->
            <div class="col-sm-6">
                <label class="control-label">Contact No<span class="red-theme">*</span></label>
                <?= $form->field($model, 'contact_no')->textInput(['id' => 'customer_phone'])->label(false); ?>
                <p class="theme_2 help-block">+91(8567)234-678</p>

                <div style="display:none;" class="theme"><input type="checkbox" id="phone_mask" checked></div>
                <label id="descr" class="mask-label"></label>
            </div>
            <?php if (Yii::$app->user->identity->role != UserTypes::ORGANIZATION) { ?>
                <div class="col-sm-6">
                    <label class="control-label">Status</label>
                    <?= $form->field($model, 'status')->dropDownList($status, ['options' => [$model->status => ['Selected' => 'selected']]])->label(false) ?>
                </div>
            <?php } ?>
		</div>
        <div class="form-group form-material">
            <?= Html::submitButton('Add', ['class' => 'btn btn-success pull-right btn_client_add']) ?>
        </div>
		<?php ActiveForm::end(); ?>
    <?php }  ?>
    </div>
    </div>
    <!-- End Example Basic Form -->
    </div>
    </div>
    </div>
    </div>
    </div>

<?php

$this->registerJs('
    function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$("#profile-photo").attr("src", e.target.result);
				var test = e.target.file;
				console.log(test);
				var files = e.target.files; // FileList object

			}
			reader.readAsDataURL(input.files[0]);
		}
	}
$(document).ready(function(){
	$("#text").hide();
	$("#common-name").hide();
	$("#save").click(function(){
		if($("#save").prop("checked")== true)
		{
		$("#text").show();
		}
		else{
		 $("#text").hide();
		}
    });

$(".btn-check").click(function(){
if($("#common-name").attr("class")== "red-theme stop"){
return false;
}
});

    $("#text").keyup(function(){
    var text = $(this).val();

    $.ajax({
           url:"'.Yii::$app->getUrlManager()->createUrl(['user/unique-agreement-name']).'",
           data:{text:text},
           success:function(data)
           {
           if(data == "exist")
           {
           $("#common-name").show();
           $("#common-name").addClass("stop");
               }else
           {
            $("#common-name").hide();
             $("#common-name").removeClass("stop");

           }

           }
    })
    });



//$("#country_first").select2("destroy");
//$("#country").select2("destroy");
		$(".error").hide();
		$(".error1").hide();
		$(".error_level").hide();
        $(".agreement_error").hide();

        $("#other_txt").hide();

        $("#user-media_id").innerHTML = "";
		
		$("#user-media_id").change(function(){
			readURL(this);
		});
                $("#user-media_id").click(function() {
                    $("input[id=\'profile-photo\']");
                });

         $("#other_txt") .on("focusout",function() {
            if($(this).val()==""){
                $("#other_error").show();
			$("#button-next").attr("disabled","disabled");
			}
            else{
                 $("#other_error").hide();
				 $("#button-next").removeAttr("disabled");
			}
        });

		$("#user-email").focusout(function(e) {
			var email = $("#user-email").val();
			$.ajax({
				type:"GET",
				url: "' . Yii::$app->getUrlManager()->createUrl(['user/validate-email']) . '",
				data: {email: email},
				success: function (data) {
					if(data != 0){
						console.log(data);
						$("#email_error").show();
						$("#conv").attr("href",data);
					 }
					 else
						$("#email_error").hide();
					}
            });
			$.ajax({
				type:"GET",
				url: "' . Yii::$app->getUrlManager()->createUrl(['user/validate-email2']) . '",
				data: {email: email},
				success: function (data) {
					if(data != 0){
						console.log(data);
						$("#email_error").show();
						$("#conv2").attr("href",data);
					 }
					 else
						$("#email_error").hide();
					}
            });
        });
		
		$("#conv").click(function(){
			console.log("ahs");
		});

   $("#country").select2().change(function(){
var country_name = $(this).val();

 $.ajax({
                   url: "' . Yii::$app->getUrlManager()->createUrl(['organization/search-for-location']) . '",

                    data: {country_name:country_name},
                    success: function (data) {
                          var obj = JSON.parse(data);
						//alert(obj.results);

$("#location").empty().select2({data: obj.results, tags:true,width :"100%"});
//$("#country").select2({tags:true,width :"100%"});
}
 });

});

   $("#country_first").change(function(){
		var country_name = $(this).val();

		$.ajax({
			url: "' . Yii::$app->getUrlManager()->createUrl(['user/search-for-location']) . '",
			data: {country_name:country_name},
			success: function (data) {
			var obj = JSON.parse(data);
			//alert(obj.results);

			//$("#location_first").select2().empty().select2({data: obj.results,tags:true,width :"100%"});
			$("#location_first").find("option").remove();
			$.each(obj, function(key,value) {
				var key_string = JSON.stringify(key);
				$("#location_first").append("<option value="+key_string+">"+value+"</option>");
			});
			//$("#country_first").select2({tags:true,width :"100%"});
		}
		});

	});

       /*  $("#country").change(function() {

        var inputVal = $(this).val();
        var numericReg = /^[a-zA-Z]+(\s[a-zA-Z]+)?$/i;
        if(!numericReg.test(inputVal)) {
            $(this).val(" ");
            $("span#select2-country-container").html(" ");
           $(".error").show();
        }
        else
	    {
		 $(".error").hide();
	    }
    });
    $("#location").change(function() {

        var inputVal = $(this).val();
        var numericReg = /^[a-zA-Z]+(\s[a-zA-Z]+)?$/i;
        if(!numericReg.test(inputVal)) {
            $(this).val(" ");
            $("span#select2-country-container").html(" ");
            $(".error1").show();
        }
        else
        {
            $(".error1").hide();
        }
    });*/



	$(".btn_client_add").click(function(){
		$(".hidden_agreement").val($("#summernote").code());
		if($("#summernote").code()=="")
		{
			$(".agreement_error").show();
			$(".agreement_error").show();
			return false;
		}
		else
		{
			$(".agreement_error").hide();
			return true;
		}

		var level_value=$("#user-level_id").val();
		if(level_value==null)
		{
			$(".error_level").show();
			return false;
		}
		else
		{
			$(".error_level").hide();
			return true;
		}
    });


	$(".btn_coach_add").click(function(){
		$(".hidden_agreement").val($("#summernote").code());
	});

	
	
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
				$("#customer_phone").inputmask("+[####################]", maskOpts.inputmask)
				.attr("placeholder"," ");
				$("#descr").html("");
			}
		});
		$("#phone_mask").change();
	

	$("#user-organization_id").change(function(){
         var o_id = $("#user-organization_id option:selected").val();
        $.ajax({
                    type:"GET",
                    url: "' . Yii::$app->getUrlManager()->createUrl(['user/search-level']) . '",
                    data: {o_id: o_id},
                    dataType: "json",
                    success: function (data) {
                              $("#user-level_id").find("option").remove();
                                 $.each(data, function(key, value) {
                                   if(key!=""){
                                         $("#user-level_id").append($("<option></option>").attr("value", key).text(value));

                                    }
                                 });
                                  $("#user-level_id").prepend("<option value=\'default\' selected=\'selected\'>Select Level</option>");
                                  $("#user-level_id option:first").prop("disabled", "disabled");
                    }
            });
    });
	
	$("#prog").change(function(){
		var program = $(this).val();
		//var program = 1;
		console.log(program);
		$.ajax({
			url: "' . Yii::$app->getUrlManager()->createUrl(['batches/search-for-batches2']) . '",
			data: {program:program},
			type:"get",
			success: function (data) {
				var obj = JSON.parse(data);
				//alert(obj.results);
				console.log(data);
				//$("#bat").empty().select2({data: obj.results, tags:true,width :"100%"});
				$("#bat").find("option").remove();
				$.each(obj, function(key,value) {
					var key_string = JSON.stringify(key);
					$("#bat").append("<option value="+key_string+">"+value+"</option>");
				});
				//$("#country").select2({tags:true,width :"100%"});
			}
		});

	});
	$("#prog2").change(function(){
		var program = $(this).val();
		//var program = 1;
		console.log(program);
		$.ajax({
			url: "' . Yii::$app->getUrlManager()->createUrl(['batches/search-for-batches2']) . '",
			data: {program:program},
			type:"get",
			success: function (data) {
				var obj = JSON.parse(data);
				//alert(obj.results);
				console.log(data);
				//$("#bat2").empty().select2({data: obj.results, tags:true,width :"100%"});
				$("#bat2").find("option").remove();
				$.each(obj, function(key,value) {
					var key_string = JSON.stringify(key);
					$("#bat2").append("<option value="+key_string+">"+value+"</option>");
				});
				//$("#country").select2({tags:true,width :"100%"});
			}
		});

	});
	$("#prog3").change(function(){
		var program = $(this).val();
		//var program = 1;
		console.log(program);
		$.ajax({
			url: "' . Yii::$app->getUrlManager()->createUrl(['batches/search-for-batches2']) . '",
			data: {program:program},
			type:"get",
			success: function (data) {
				var obj = JSON.parse(data);
				//alert(obj.results);
				console.log(data);
				//$("#bat3").empty().select2({data: obj.results, tags:true,width :"100%"});
				$("#bat3").find("option").remove();
				$.each(obj, function(key,value) {
					var key_string = JSON.stringify(key);
					$("#bat3").append("<option value="+key_string+">"+value+"</option>");
				});
				//$("#country").select2({tags:true,width :"100%"});
			}
		});

	});
	$(".add-grant-button").click(function(){
		if(!$("#pb2").is(":visible")){
			$("#pb2").show();
		}else{
			$("#pb3").show();
		}
	});
	$(".remove-grant-button").click(function(){
		$(this).parent().parent().hide();
	});
});
');