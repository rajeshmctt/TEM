<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Elective */

$this->title = 'Create Elective';
$this->params['breadcrumbs'][] = ['label' => 'Electives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elective-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
