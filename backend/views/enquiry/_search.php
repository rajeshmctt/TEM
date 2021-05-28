<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EnquirySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_of_enquiry') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'contact_no') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'owner') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'subject') ?>

    <?php // echo $form->field($model, 'referred_by') ?>

    <?php // echo $form->field($model, 'program_id') ?>

    <?php // echo $form->field($model, 'final_status_l1') ?>

    <?php // echo $form->field($model, 'invoice_raised_l1') ?>

    <?php // echo $form->field($model, 'l1_batch') ?>

    <?php // echo $form->field($model, 'l1_status') ?>

    <?php // echo $form->field($model, 'final_status_l2') ?>

    <?php // echo $form->field($model, 'invoice_raised_l2') ?>

    <?php // echo $form->field($model, 'l2_batch') ?>

    <?php // echo $form->field($model, 'l2_status') ?>

    <?php // echo $form->field($model, 'final_status_l3') ?>

    <?php // echo $form->field($model, 'invoice_raised_l3') ?>

    <?php // echo $form->field($model, 'l3_batch') ?>

    <?php // echo $form->field($model, 'l3_status') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'currency_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
