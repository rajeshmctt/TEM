<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Program;
use common\models\Batch;
use common\models\Elective;
use common\models\Currency;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryBatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-batch-form" style="display:none">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'enquiry_id')->textInput() ?>

    <?= $form->field($model, 'program_id')->textInput() ?>

    <?= $form->field($model, 'batch_id')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'final_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'installment_plan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'invoicing')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

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
            <div class="col-sm-4">
                <label class="control-label">Program<span class="red-theme">*</span></label>
                <?= $form->field($model, 'program_id')->label(false)->widget(Select2::classname(), [
					//'name' => 'User[location_id]',
					//'id' => 'location', // location 6-4-18
					//'value' => $location_name, // initial value
					'data' => Program::getPrograms(),
					'options' => ['placeholder' => 'Select Program', 'id' => 'prog'],
					'pluginOptions' => [
						'tags' => true,
						'tokenSeparators' => [',', ' '],
						// 'multiple'=>true, ,'multiple'=>true
						'maximumInputLength' => 10
					],
				]);?>
            </div>
            <div class="col-sm-4">
                <label class="control-label">Batch<span class="red-theme">*</span></label>
                <?= $form->field($model, 'batch_id')->label(false)->widget(Select2::classname(), [
					//'name' => 'User[location_id]',
					//'id' => 'location', // location 6-4-18
					//'value' => $location_name, // initial value
					'data' => Batch::getProgBatches($model->program_id),
					'options' => ['placeholder' => 'Select a Batch', 'id' => 'bat'],
					'pluginOptions' => [
						'tags' => true,
						'tokenSeparators' => [',', ' '],
						// 'multiple'=>true, ,'multiple'=>true
						'maximumInputLength' => 10
					],
				]);?>
            </div>
            <div class="col-sm-4">    
                <label class="control-label">Electives<span class="red-theme">*</span></label>
                <?= Select2::widget([
                                    'name' => 'EnquiryBatch[electives]',
                                    'id' => 'electives1',
                                    'value' => isset($electives)?$electives:[], // initial value
                                    'data' => Elective::getElectives(),
                                    'options' => ['placeholder' => 'Select Electives','class'=>'electives'],
                                    'pluginOptions' => [
                                        'tags' => true,
                                        'multiple' => 'true',
                                        'tokenSeparators' => [',', ' '],
                                        'maximumInputLength' => 20,
                                    ],
                                ]); ?>
            </div>
        </div>    
        <div class="form-group row"><!--form-material-->
            <div class="col-sm-4">
                <label class="control-label">Currency<span class="red-theme">*</span></label>
                <?= $form->field($model, 'currency')->label(false)->widget(Select2::classname(), [
					//'name' => 'User[location_id]',
					//'id' => 'location', // location 6-4-18
					//'value' => $location_name, // initial value
					'data' => Currency::getCurrency(),
					'options' => ['placeholder' => 'Select a Currency', 'id' => 'currency'],
					'pluginOptions' => [
						'tags' => true,
						'tokenSeparators' => [',', ' '],
						// 'multiple'=>true, ,'multiple'=>true
						'maximumInputLength' => 10
					],
				]);?>
            </div>
            <div class="col-sm-4">
                <label class="control-label">Amount<span class="red-theme">*</span></label>
                <?= $form->field($model, 'amount')->textInput(['type' => 'number'])->label(false) ?>
            </div>
            <div class="col-sm-4">    
                <label class="control-label">Installment Plan<span class="red-theme">*</span></label>
                <?= $form->field($model, 'installment_plan')->textInput()->label(false) ?>
            </div>
        </div>
        <div class="form-group form-material">
            <?= Html::submitButton($model->isNewRecord?'Add':'Update', ['class' => 'btn btn-success pull-right btn_client_add']) ?>
            
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
});
');