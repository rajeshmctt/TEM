<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Enquiry */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enquiries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="enquiry-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date_of_enquiry',
            'full_name',
            'contact_no',
            'email:email',
            'address',
            'owner',
            'city',
            'country_id',
            'source',
            'subject',
            'referred_by',
            'program_id',
            'final_status_l1',
            'invoice_raised_l1',
            'l1_batch',
            'l1_status',
            'final_status_l2',
            'invoice_raised_l2',
            'l2_batch',
            'l2_status',
            'final_status_l3',
            'invoice_raised_l3',
            'l3_batch',
            'l3_status',
            'amount',
            'currency_id',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
