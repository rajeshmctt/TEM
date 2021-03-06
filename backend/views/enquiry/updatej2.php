<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Enquiry */

$this->title = 'Update Joined User: ' . $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Confirmed Participants', 'url' => ['enquiry/joined']];
// $this->params['breadcrumbs'][] = ['label' => 'Ann '.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page enquiry-update">

	<?php if(!Yii::$app->request->isAjax){?>
		<div class="page-header">
			<h1 class="page-title"><?= Html::encode($this->title) ?></h1>
			<ol class="breadcrumb">
				<li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index");?>" data-link-to='site'>Home</a></li>
				<?php 
					//echo "<pre>"; print_r($this->params['breadcrumbs']); exit;
					foreach($this->params['breadcrumbs'] as $k=>$v){
					if(isset($v['label'])){ 
						//echo "<pre>"; print_r($v); exit;
						echo "<li><a href=".Yii::$app->urlManager->createAbsoluteUrl($v['url'])." data-link-to='faculty-index'>".$v['label']."</a></li>";
					}else{
						//echo "<pre>"; print_r($v); exit;
						echo "<li class='active'>$v</li>";
					}
				}?>
			</ol>
		</div>

        <?php }?>
    <?= $this->render('_formj2', [
        'model' => $model,
        'countries' => $countries,
		'states' => $states,
		'cities' => $cities,
        'currency' => $currency,
        'programs' => $programs,
        'pbatches' => $pbatches,
		'myprograms' => $myprograms,
		'batches' => $batches,
		'pgcount' => $pgcount,
        'owners' => $owners,
        'allelec' => $allelec,
    ]) ?>

</div>
