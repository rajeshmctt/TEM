<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Elective */

$this->title = 'Update Elective: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Electives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elective-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
