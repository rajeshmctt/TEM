<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryBatch */

$this->title = 'Create Enquiry Batch';
$this->params['breadcrumbs'][] = ['label' => 'Enquiry Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-batch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
