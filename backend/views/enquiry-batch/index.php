<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquiryBatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enquiry Batches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-batch-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Enquiry Batch', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'enquiry_id',
            'program_id',
            'batch_id',
            //'start_date',
            //'created_at',
            //'updated_at',
            //'final_status',
            'currency',
            'amount',
            'installment_plan:ntext',
            'invoicing',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
