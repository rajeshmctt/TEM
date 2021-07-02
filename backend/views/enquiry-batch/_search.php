<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryBatchSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-batch-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'enquiry_id') ?>

    <?= $form->field($model, 'program_id') ?>

    <?= $form->field($model, 'batch_id') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'final_status') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'installment_plan') ?>

    <?php // echo $form->field($model, 'invoicing') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
