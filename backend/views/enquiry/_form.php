<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\enums\UserTypes;
use yii\helpers\Url;
use kartik\select2\Select2;
use common\models\Company;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Enquiry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-form" style="display:none">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?//= $form->field($model, 'date_of_enquiry')->textInput() ?>-->
    <input type="text" name="Enquiry[date_of_enquiry]" id="enquiry_date11" class="form-control" data-provide="datepicker" placeholder="Start Date" value="<?=isset($model->start_date)? date("m/d/Y",$model->start_date):''?>" >

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
    <!--<?= $form->field($model, 'created_at')->textInput() ?>-->
    <!--<?= $form->field($model, 'updated_at')->textInput() ?>-->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!---new code -->


<div class="page-content">
    <div class="panel">
    <div class="panel-body container-fluid">
    <div class="row row-lg">
    <div class="col-sm-10 col-md-offset-1">
    <!-- Example Basic Form -->
    <div class="example-wrap">
    <div class="example">
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'data-link-to' => 'user-create'
            ]
        ]); ?>


        <div class="form-group row"><!--form-material-->
            <div class="col-sm-3">    
                <label class="control-label">Enquiry Date<span class="red-theme">*</span></label>
                <input type="text" name="Enquiry[date_of_enquiry]" id="enquiry_date" class="form-control" data-provide="datepicker" placeholder="Enquiry Date" value="<?=isset($model->date_of_enquiry)? date("m/d/Y",$model->date_of_enquiry):''?>" >
            </div>
            <div class="col-sm-3">
                <label class="control-label">Full Name<span class="red-theme">*</span></label>
                <?= $form->field($model, 'full_name')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Email<span class="red-theme">*</span></label>
                <?= $form->field($model, 'email')->textInput()->label(false) ?>				
				<h5 style="display: none;" class='error red-theme' id="email_error" style="display: none">Email already exists.</h5>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Contact No<span class="red-theme">*&nbsp;&nbsp;</span></label><label id="descr" class="mask-label"></label>
                <?= $form->field($model, 'contact_no')->textInput(['id' => 'customer_phone'])->label(false); ?>
                <p class="theme_2 help-block">+91(8567)234-678</p>

                <div style="display:none;" class="theme"><input type="checkbox" id="phone_mask" checked></div>				
				<h5 style="display: none;" class='error red-theme' id="phone_error" style="display: none">Contact number already exists.</h5>
                
            </div>
        </div>
        <div class="form-group row"><!--form-material-->
            <div class="col-sm-3">
                <label class="control-label">Address</label>
                <?= $form->field($model, 'address')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Country</label>
                <!--<?//= $form->field($model, 'country_id')->dropDownList($countries, ['options' => [$model->country_id => ['Selected' => 'selected']], 'prompt' => ' -- Select Country --'])->label(false) ?>-->
                <?= Select2::widget([
						'name' => 'Enquiry[countries_id]',
						'id' => 'coun',
                        'value' => isset($model->countries_id)?$model->countries_id:'', // initial value
						'data' => $countries,
						'options' => ['placeholder' => 'Select a Country','class'=>'country'],
						'pluginOptions' => [
							'tags' => true,
							//'multiple' => 'true',
							'tokenSeparators' => [',', ' '],
							'maximumInputLength' => 20,
						],
					]); ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">State</label>
                    <?= Select2::widget([
                        'name' => 'Enquiry[state_id]',
                        'id' => 'stat',
                        'value' => isset($model->state_id)?$model->state_id:'', // initial value
                        'data' => (count((array)$states)!=0)?$states:[],
                        'options' => ['placeholder' => 'Select a State','class'=>'stat'],
                        'pluginOptions' => [
                            'tags' => true,
                            //'multiple' => 'true',
                            'tokenSeparators' => [',', ' '],
                            'maximumInputLength' => 20,
                        ],
                    ]); ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">City</label>                
                <?= Select2::widget([
                        'name' => 'Enquiry[city_id]',
                        'id' => 'city',
                        'value' => isset($model->city_id)?$model->city_id:'', // initial value
                        'data' => isset($model->state_id)?$cities:[],
                        'options' => ['placeholder' => 'Select a City','class'=>'city'],
                        'pluginOptions' => [
                            'tags' => true,
                            //'multiple' => 'true',
                            'tokenSeparators' => [',', ' '],
                            'maximumInputLength' => 20,
                        ],
                    ]); ?>
            </div>
        </div>
		<div class="form-group row"><!--form-material-->
            <div class="col-sm-3">
                <label class="control-label">Program</label>
                <?php
                $dataProgram=ArrayHelper::map(\common\models\Program::find()->asArray()->all(), 'id', 'name');
                echo $form->field($model, 'program_id')->dropDownList($dataProgram, 
             ['prompt'=>'-Choose a Program-',
                      'onchange'=>'
                            $.get( "'.Url::toRoute('/batch/forprog').'", {id:$(this).val()}, function( data ) {
                              $( "select#l1_batch" ).html( data );
                              $( "select#l2_batch" ).html( data );
                              $( "select#l3_batch" ).html( data );
                            });
                    '])->label(false); 

                ?>
                <!--<?//= $form->field($model, 'program_id')->dropDownList($programs, ['options' => [$model->program_id => ['Selected' => 'selected']], 'prompt' => ' -- Select Program --'])->label(false) ?>-->
            </div>
            <div class="col-sm-3">
                <label class="control-label">Source</label>
                <?= $form->field($model, 'source')->dropDownList(UserTypes::$sources, ['id'=>'source','options' => [$model->source => ['Selected' => 'selected']], 'prompt' => ' -- Select Source --'])->label(false) ?>
            </div>
            <div class="col-sm-3" id="referred_by" style="<?=$model->source==1?'':'display:none' ?>">
                <label class="control-label">Referred by</label>
                <?= $form->field($model, 'referred_by')->textInput()->label(false) ?>
            </div>

        </div>
		<div class="form-group row">
            <div class="col-sm-3">
                <label class="control-label">Owner</label>
                <?= $form->field($model, 'owner_id')->dropDownList($owners, ['options' => [$model->owner_id => ['Selected' => 'selected']], 'prompt' => ' -- Select Owner --'])->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Subject</label>
                <?= $form->field($model, 'subject')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3" <?=$model->isNewRecord?'style="display:none"':'' ?>>
                <label class="control-label">Status</label>
                <?= $form->field($model, 'enq_status')->dropDownList(UserTypes::$estatus, ['options' => [$model->enq_status => ['Selected' => 'selected']], 'prompt' => ' -- Select Status --'])->label(false) ?>
            </div>

        </div>
		<div class="form-group row" <?=$model->isNewRecord?'style="display:none"':'' ?>>
            <div class="col-sm-6" style="display:none">
                <label class="control-label">Remarks</label>
                <?= $form->field($model, 'remarks')->textarea(['rows' => 4])->label(false) ?>
            </div>

            <div class="col-sm-3">
                <label class="control-label">Call date</label>
                <input type="text" name="Remark[date_of_remark]" id="remark_date" class="form-control" data-provide="datepicker" placeholder="Call Date" value="" >
            </div>
            <div class="col-sm-9">
                <label class="control-label">New Remark</label>
                <div class="form-group field-enquiry-remarks">
                    <textarea id="remarks" class="form-control" name="Remark[remark]" rows="1" aria-invalid="false"></textarea>
                </div>            
            </div>
<!--
        </div>
        <div class="form-group row">form-material-->
            <div class="col-sm-12" >
                <label class="control-label">Remarks</label>
                <textarea style="width:100%" readonly>
                <?php foreach($model->enquiryRemarks as $rem){ ?>
                    <?= date("m/d/Y",$rem->date).": ".$rem->remarks."\n" ?>
                <?php } ?>
                </textarea>
            </div>
        <table class="table table-striped table-bordered" style="display:none">
            <thead>
                <tr>
                    <th style="width=20%">Date</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model->enquiryRemarks as $rem){ ?>
                <tr>
                    <td><?= $rem->date ?></td>
                    <td><?= $rem->remarks ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <div class="form-group form-material">
            <?= Html::submitButton($model->isNewRecord?'Add':'Update', ['class' => 'btn btn-success pull-right btn_client_add']) ?>
            
            <?= $model->isNewRecord?'':Html::a('Move to Potential', '#', [
                            'title' => Yii::t('yii', 'Move to Potential'),
                            'class' => 'swal-warning-poten btn btn-warning',
                            'data' => [
                                'url' => Yii::$app->getUrlManager()->createUrl(['/enquiry/topotential', 'id' => $model->id]),
                                'no-link' => "true",
                            ],
                        ]); ?>
                        <?= $model->isNewRecord?'':Html::a('Move to Confirmed', '#', [
                                        'title' => Yii::t('yii', 'Move to Joined'),
                                        'class' => 'swal-info-join btn btn-primary',
                                        'data' => [
                                            'url' => Yii::$app->getUrlManager()->createUrl(['/enquiry/tojoined', 'id' => $model->id]),
                                            'no-link' => "true",
                                        ],
                                    ]) ?>
        </div>
		<?php ActiveForm::end(); ?>
    
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
    
		$("#coun").change(function(){
			var country = $(this).val();
			console.log(country);
			$.ajax({
				url: "' . Yii::$app->getUrlManager()->createUrl(["enquiry/search-for-states"]) . '",
				data: {country:country},
				type:"get",
				success: function (data) {
					var obj = JSON.parse(data);
					//alert(obj.results);
					console.log(data);
					console.log(data);
					$("#stat").find("option").remove();
					$.each(obj, function(key,value) {
						var key_string = JSON.stringify(key);
						$("#stat").append("<option value="+key_string+">"+value+"</option>");
					});
				}
			});

		});
		$("#stat").change(function(){
			var state = $(this).val();
			console.log(state);
			$.ajax({
				url: "' . Yii::$app->getUrlManager()->createUrl(["enquiry/search-for-cities"]) . '",
				data: {state:state},
				type:"get",
				success: function (data) {
					var obj = JSON.parse(data);
					//alert(obj.results);
					console.log(data);
					console.log(data);
					$("#city").find("option").remove();
					$.each(obj, function(key,value) {
						var key_string = JSON.stringify(key);
						$("#city").append("<option value="+key_string+">"+value+"</option>");
					});
				}
			});

		});

    $("#source").change(function() {
        console.log("test");
        var inputVal = $(this).val();
        if(inputVal==1) {
            $("#referred_by").show();
        }else{
            $("#referred_by").hide();
        }
    });

    $("#enquiry_date").datepicker({
        /*format: "dd/mm/yyyy",*/
        autoclose: true
    });

    $("#remark_date").datepicker({
        /*format: "dd/mm/yyyy",*/
        autoclose: true
    });
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

        $("#enquiry-email").on("blur","input",function(){
            alert("finally bye");
        });

        console.log("testing this one also");
		$("#enquiry-email").focusout(function(e) {
            console.log("testing this one ");
			var email = $("#enquiry-email").val();
			$.ajax({
				type:"GET",
				url: "' . Yii::$app->getUrlManager()->createUrl(['enquiry/validate-email']) . '",
				data: {email: email},
				success: function (data) {
					if(data){
						console.log(data);
						$("#email_error").show();
					 }
					 else
						$("#email_error").hide();
					}
            });
        });
        
        
		$("#customer_phone").focusout(function(e) {
            var phone = $("#customer_phone").val();
            console.log(phone);
			$.ajax({
				type:"GET",
				url: "' . Yii::$app->getUrlManager()->createUrl(['enquiry/validate-phone']) . '",
				data: {phone: phone},
				success: function (data) {
					if(data){
						console.log(data);
						$("#phone_error").show();
					 }
					 else
						$("#phone_error").hide();
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
    console.log("mansasmnas");
	$("#enquiry-program_id2").change(function(){
		var id = $(this).val();
		//var program = 1;
		console.log(id);
		$.ajax({
			url: "' . Yii::$app->getUrlManager()->createUrl(['batch/forprog']) . '",
			data: {id:id},
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


});
');