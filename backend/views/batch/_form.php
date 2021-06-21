<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Program;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Batch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="batch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!--<?//= $form->field($model, 'program_id')->textInput() ?>-->
    <div class="col-sm-3">
        <label class="control-label">Program</label>
        <!--<?/*= Html:: dropDownList('User[program][]','',Program::getPrograms(),['id'=>'prog1','class'=>'form-control program','prompt'=>'Select Program'])*/?>-->
        <?= Select2::widget([
            'name' => 'Batch[program_id]',
            'id' => 'prog',
            'value' => isset($batches[0])?$myprograms[$batches[0]]:'', // initial value
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

    <?= $form->field($model, 'start_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
