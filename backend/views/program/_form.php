<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Program */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-form" style="display:none">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hours')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'tentative_date')->textInput() ?>

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
                <label class="control-label">Program<span class="red-theme">*</span></label>
                <?= $form->field($model, 'name')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Hours<span class="red-theme">*</span></label>
                <?= $form->field($model, 'hours')->textInput(['type' => 'number'])->label(false) ?>
            </div>
            <div class="col-sm-3">    
                <label class="control-label">Tentative Date<span class="red-theme">*</span></label>
                <input type="text" name="Program[tentative_date]" id="tentative_date" class="form-control" data-provide="datepicker" placeholder="Tentative Date" value="<?=($model->tentative_date!=0)? date("m/d/Y",$model->tentative_date):''?>" >
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
$eid = ($model->id=="")?0:$model->id;
$this->registerCss('
    .datepicker-days{
        display: none;
    }
	.table {
		background-color: white;
	}
');

$this->registerJs('
$(document).ready(function(){
    


    $("#tentative_date").datepicker({
        /*format: "dd/mm/yyyy",*/
        autoclose: true
    });
    

});
');