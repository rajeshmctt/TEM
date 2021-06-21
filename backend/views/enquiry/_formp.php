<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\enums\UserTypes;
use yii\helpers\Url;
use kartik\select2\Select2;
use common\models\Program;
use common\models\Batch;
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
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'owner')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'country_id')->textInput() ?>
    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'referred_by')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'amount')->textInput() ?>
    <?= $form->field($model, 'currency_id')->textInput() ?>
    <?= $form->field($model, 'status')->textInput() ?>
    <!--<?= $form->field($model, 'created_at')->textInput() ?>-->
    <!--<?= $form->field($model, 'updated_at')->textInput() ?>-->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!---new code -->


<div class="page-content">




<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
                <div class="panel">
                    <div class="panel-heading" id="exampleHeadingDefaultClient" role="tab">
                        <a class="panel-title collapsed" id="panel-theme" data-toggle="collapse"
                           href="#exampleCollapseDefaultClient"
                           data-parent="#exampleAccordionDefault" aria-expanded="false"
                           aria-controls="exampleCollapseDefaultClient">
                            <?= $model->full_name ?> <span style="font-size:10px">Click for details</span>
                        </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultClient"
                         aria-labelledby="exampleHeadingDefaultClient"
                         role="tabpanel">
                        <div class="panel-body" style="padding:0px;">

                                <div class="panel-body container-fluid" style="padding:0px;">
                                    <div class="row row-lg">
                                        <div class="col-sm-10 col-md-offset-1">
                                            <div class="example-wrap">
                                                <div class="example" style="margin-top:0px;">
                                                    <div class="form-group">
                                                        <?php $form = ActiveForm::begin(['options' => [
																'data' => ['link-to' => 'user-view'],
																//'id'=> 'addco'
															]]); ?>


                                                        <div class="form-group form-material row">
                                                        <div class="col-sm-3">    
                <label class="control-label">Enquiry Date<span class="red-theme">*</span></label>
                <input type="text" name="Enquiry[date_of_enquiry]" id="enquiry_date" class="form-control" data-provide="datepicker" placeholder="Enquiry Date" value="<?=isset($model->date_of_enquiry)? date("m/d/Y",$model->date_of_enquiry):''?>" >
            </div>
            <div class="col-sm-3">
                <label class="control-label">Full Name<span class="red-theme">*</span></label>
                <?= $form->field($model, 'full_name')->textInput()->label(false) ?>
                <input type="hidden" name="Enquiry[pgcount]" id="pgcount" value="<?=$pgcount?>">
            </div>
            <div class="col-sm-3">
                <label class="control-label">Email<span class="red-theme">*</span></label>
                <?= $form->field($model, 'email')->textInput()->label(false) ?>
				
				<h5 style="display: none;" class='error red-theme' id="email_error" style="display: none">Email has already been taken.<a href="" id="conv" class="btn btn-success btn-xs">Check User</a></h5>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Contact No<span class="red-theme">*&nbsp;&nbsp;</span></label><label id="descr" class="mask-label"></label>
                <?= $form->field($model, 'contact_no')->textInput(['id' => 'customer_phone'])->label(false); ?>
                <p class="theme_2 help-block">+91(8567)234-678</p>

                <div style="display:none;" class="theme"><input type="checkbox" id="phone_mask" checked></div>
                
            </div>
            <div class="col-sm-3">
                <label class="control-label">Address<span class="red-theme">*</span></label>
                <?= $form->field($model, 'address')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Owner<span class="red-theme">*</span></label>
                <?= $form->field($model, 'owner')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">City<span class="red-theme">*</span></label>
                <?= $form->field($model, 'city')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Country<span class="red-theme">*</span></label>
                <?= $form->field($model, 'country_id')->dropDownList($countries, ['options' => [$model->country_id => ['Selected' => 'selected']], 'prompt' => ' -- Select Country --'])->label(false) ?>
            </div>
        <!--</div>
		<div class="form-group row">form-material-->
            <div class="col-sm-3">
                <label class="control-label">Source<span class="red-theme">*</span></label>
                <?= $form->field($model, 'source')->dropDownList(UserTypes::$sources, ['options' => [$model->source => ['Selected' => 'selected']], 'prompt' => ' -- Select Source --'])->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Subject<span class="red-theme">*</span></label>
                <?= $form->field($model, 'subject')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Referred by<span class="red-theme">*</span></label>
                <?= $form->field($model, 'referred_by')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3" style="display:none">
                <label class="control-label">Program<span class="red-theme">*</span></label>
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
            </div>

            <div class="col-sm-3" style="display:none">
                <label class="control-label">amount<span class="red-theme">*</span></label>
                <?= $form->field($model, 'amount')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3" style="display:none">
                <label class="control-label">currency<span class="red-theme">*</span></label>
                <?= $form->field($model, 'currency_id')->dropDownList($currency, ['options' => [$model->currency_id => ['Selected' => 'selected']], 'prompt' => ' -- Select Currency --'])->label(false) ?>
            </div>
                                                    </div>
        <div class="form-group form-material">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success pull-right btn_client_add']) ?>
        </div>


                                                        <?php ActiveForm::end(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>




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


        <div class="form-group row" style="display:none"><!--form-material-->
            
        </div>
        <div class="form-group row"><!--grant-div panel-body-->
                            
			<!--<div class="col-sm-11 panel-body"  > <!--style="border: 1px solid black"-->
				<div class="col-sm-6">
					<label class="control-label">Program</label>
					<!--<?/*= Html:: dropDownList('User[program][]','',Program::getPrograms(),['id'=>'prog1','class'=>'form-control program','prompt'=>'Select Program'])*/?>-->
					<?= Select2::widget([
						'name' => 'Enquiry[program1]',
						'id' => 'prog',
						'value' => isset($batches[0])?$myprograms[$batches[0]]:$model->program_id, // initial value
						'data' => Program::getPrograms(),
						'options' => ['placeholder' => 'Select a Program','class'=>'prog'],
						'pluginOptions' => [
							'tags' => true,
							//'multiple' => 'true',
							'tokenSeparators' => [',', ' '],
							'maximumInputLength' => 20,
						],
					]); ?>
					<!--<p class="theme_3 help-block">&nbsp You can also add a new Country</p>-->
					<h5 style="display:none" class='error red-theme'>Country cannot be a
						number.</h5>
				</div>
				<div class="col-sm-5">
					<label class="control-label">Batch</label>
					<?= Select2::widget([
						'name' => 'Enquiry[batch1]',
						'id' => 'bat',
						'value' => isset($batches[0])?$batches[0]:'', // initial value
						'data' => isset($batches[0])?Batch::getProgBatches($myprograms[$batches[0]]):[],
						'options' => ['placeholder' => 'Select a Batch','class'=>'bat'],
						'pluginOptions' => [
							'tags' => true,
							//'multiple' => 'true',
							'tokenSeparators' => [',', ' '],
							'maximumInputLength' => 20,
						],
					]); ?>
					<!--<?//= Html:: dropDownList('User[batches][]','',[],['id'=>'bat','class'=>'form-control batches','prompt'=>'Select Batch'])?>-->
				</div>
			<!--</div>-->
			<div class="col-sm-1">
				<label class="control-label add-grant-button"> Add </label>
				<button type="button" class="btn btn-success btn-round add-grant-button"><i class="glyphicon glyphicon-plus"></i></button>
			</div>
		</div>
        <div class="form-group row" id="pb2" <?= (count($batches)>1?'':'style="display:none"')?>><!--grant-div panel-body-->
			<!--<div class="col-sm-11 panel-body"  > <!--style="border: 1px solid black"-->
				<div class="col-sm-6">
					<label class="control-label">Program</label><br>
					<!--<?/*= Html:: dropDownList('User[program][]','',Program::getPrograms(),['id'=>'prog1','class'=>'form-control program','prompt'=>'Select Program'])*/?>-->
					<?= Select2::widget([
						'name' => 'Enquiry[program2]',
						'id' => 'prog2',
						'value' => isset($batches[1])?$myprograms[$batches[1]]:'', // initial value
						'data' => Program::getPrograms(),
						'options' => ['placeholder' => 'Select a Program','class'=>'prog'],
						'pluginOptions' => [
							'tags' => true,
							//'multiple' => 'true',
							'tokenSeparators' => [',', ' '],
							'maximumInputLength' => 20,
						],
					]); ?>
					<h5 style="display:none" class='error red-theme'>Country cannot be a
						number.</h5>
				</div>
				<div class="col-sm-5">
					<label class="control-label">Batch</label>
					<?= Select2::widget([
						'name' => 'Enquiry[batch2]',
						'id' => 'bat2',
						'value' => isset($batches[1])?$batches[1]:'', // initial value
						'data' => isset($batches[1])?Batch::getProgBatches($myprograms[$batches[1]]):[],
						'options' => ['placeholder' => 'Select a Batch','class'=>'bat'],
						'pluginOptions' => [
							'tags' => true,
							//'multiple' => 'true',
							'tokenSeparators' => [',', ' '],
							'maximumInputLength' => 20,
						],
					]); ?>
				</div>
			<!--</div>-->
			<div class="col-sm-1">
				<label class="control-label remove-grant-button"> Remove </label>
				<button type="button" class="btn btn-success btn-round remove-grant-button"><i class="glyphicon glyphicon-minus"></i></button>
			</div>
		</div>
		<div class="form-group row" id="pb3" <?= (count($batches)>2?'':'style="display:none"')?>><!--grant-div panel-body-->
			<!--<div class="col-sm-11 panel-body"  > <!--style="border: 1px solid black"-->
				<div class="col-sm-6">
					<label class="control-label">Program</label>
					<!--<?/*= Html:: dropDownList('User[program][]','',Program::getPrograms(),['id'=>'prog1','class'=>'form-control program','prompt'=>'Select Program'])*/?>-->
					<?= Select2::widget([
						'name' => 'Enquiry[program3]',
						'id' => 'prog3',
						'value' => isset($batches[2])?$myprograms[$batches[2]]:'', // initial value
						'data' => Program::getPrograms(),
						'options' => ['placeholder' => 'Select a Program','class'=>'prog'],
						'pluginOptions' => [
							'tags' => true,
							//'multiple' => 'true',
							'tokenSeparators' => [',', ' '],
							'maximumInputLength' => 20,
						],
					]); ?>
					<h5 style="display:none" class='error red-theme'>Country cannot be a
						number.</h5>
				</div>
				<div class="col-sm-5">
					<label class="control-label">Batch</label>
					<?= Select2::widget([
						'name' => 'Enquiry[batch3]',
						'id' => 'bat3',
						'value' => isset($batches[2])?$batches[2]:'', // initial value
						'data' => isset($batches[2])?(Batch::getProgBatches($myprograms[$batches[2]])):[],
						'options' => ['placeholder' => 'Select a Batch','class'=>'bat'],
						'pluginOptions' => [
							'tags' => true,
							//'multiple' => 'true',
							'tokenSeparators' => [',', ' '],
							'maximumInputLength' => 20,
						],
					]); ?>
				</div>
			<!--</div>-->
			<div class="col-sm-1">
				<label class="control-label remove-grant-button"> Remove </label>
				<button type="button" class="btn btn-success btn-round remove-grant-button"><i class="glyphicon glyphicon-minus"></i></button>
			</div>
		</div>
		
        <div class="form-group row"><!--form-material-->

        </div>
        <div class="form-group form-material">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success pull-right btn_client_add']) ?>
            <?= Html::a('Move to Enquiry', '#', [
                            'title' => Yii::t('yii', 'Move to Enquiries'),
                            'class' => 'swal-info-enq btn btn-warning',
                            'data' => [
                                'url' => Yii::$app->getUrlManager()->createUrl(['/enquiry/toenq', 'id' => $model->id]),
                                'no-link' => "true",
                            ],
                        ]) ?>
            <?= Html::a('Move to Confirmed', '#', [
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
    
	$("#enquiry_date").datepicker({
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
    
	$("#prog").change(function(){
		var program = $(this).val();
		//var program = 1;
		console.log(program);
		$.ajax({
			url: "' . Yii::$app->getUrlManager()->createUrl(['batch/search-for-batches2']) . '",
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
			url: "' . Yii::$app->getUrlManager()->createUrl(['batch/search-for-batches2']) . '",
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
			url: "' . Yii::$app->getUrlManager()->createUrl(['batch/search-for-batches2']) . '",
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
        $("#pgcount").val( function(i, oldval) {
            if(oldval<3){
                console.log(oldval);
                return ++oldval;
            }else{
                return oldval;
            }
        });
    });
    $(".remove-grant-button").click(function(){
        $(this).parent().parent().hide();
        $("#pgcount").val( function(i, oldval) {
            console.log(oldval);
            return --oldval;
        });
    });


});
');