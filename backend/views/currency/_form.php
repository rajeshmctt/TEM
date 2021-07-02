<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Currency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-form" style="display:none">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

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
                <label class="control-label">Currency<span class="red-theme">*</span></label>
                <?= $form->field($model, 'name')->textInput()->label(false) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label">Country<span class="red-theme">*</span></label>
                <?= Select2::widget([
						'name' => 'Currency[country_id]',
						'id' => 'coun',
                        'value' => isset($model->country_id)?$model->country_id:'', // initial value
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
