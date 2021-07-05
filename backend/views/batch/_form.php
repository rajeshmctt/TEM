<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Program;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Batch */
/* @var $form yii\widgets\ActiveForm */
?>

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
                <label class="control-label">Name</label>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
            </div>

            <!--<?//= $form->field($model, 'program_id')->textInput() ?>-->
            <div class="col-sm-4">
                <label class="control-label">Program</label>
                <!--<?/*= Html:: dropDownList('User[program][]','',Program::getPrograms(),['id'=>'prog1','class'=>'form-control program','prompt'=>'Select Program'])*/?>-->
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
                <!--<p class="theme_3 help-block">&nbsp You can also add a new Country</p>-->
                <h5 style="display:none" class='error red-theme'>Country cannot be a
                    number.</h5>
            </div>
        </div>

    <div class="form-group">
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