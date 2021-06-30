<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Faculty */

$this->title = 'Create Enquiry';
$this->params['breadcrumbs'][] = ['label' => 'Enquiries', 'url' => ['enquiry/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page enquiry-create">

	<?php if(!Yii::$app->request->isAjax){?>
		<div class="page-header">
			<h1 class="page-title"><?= Html::encode($this->title) ?></h1>
			<ol class="breadcrumb">
				<li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index");?>" data-link-to='site'>Home</a></li>
				<?php foreach($this->params['breadcrumbs'] as $k=>$v){
					if(isset($v['label'])){
						echo "<li><a href=".Yii::$app->urlManager->createAbsoluteUrl($v['url'])." data-link-to='enquiry-index'>".$v['label']."</a></li>";
					}else{
						echo "<li class='active'>$v</li>";
					}
				}?>
			</ol>
		</div>
	<?php }?>

    <?= $this->render('_form', [
        'model' => $model,
        'countries' => $countries,
		'states' => $states,
		'cities' => $cities,
        'currency' => $currency,
        'programs' => $programs,
        'pbatches' => $pbatches,
        'owners' => $owners,
    ]) ?>

</div>

<?php
$this->registerJs('
$(document).ready(function(){
var add = '.$add.';
link =  "'.$link.'";
if(add==1){
		swal({
			title: "Information",
			text: "Do you want to create another enquiry?",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#ff9988",
			confirmButtonText: "No",
			cancelButtonText: "Yes",
			cancelButtonColor: "#EE6B55",
			closeOnConfirm: true
		}, function(){
			window.location.href = link;
	  	});
	
	}
});
');?>