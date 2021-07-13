<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Currency */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Import Enquiries';
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


<div class="page-content">
    <div class="panel">
    <div class="panel-body container-fluid">
    <div class="row row-lg">
    <div class="col-sm-10 col-md-offset-1">
    <!-- Example Basic Form -->
    <div class="example-wrap">
    <div class="example">
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'data-link-to' => 'user-create'
            ]
        ]); ?>


        <div class="form-group row"><!--form-material-->
            <div class="col-sm-3">
                <label class="control-label">CSV<span class="red-theme">*</span></label>
                <?= $form->field($model, 'file1')->fileInput()->label(false) ?>
            </div>
        </div>
        <div class="form-group form-material">
            <?= Html::submitButton($model->isNewRecord?'Add':'Update', ['class' => 'btn btn-success pull-right btn_client_add']) ?>
            
        </div>
		<?php ActiveForm::end(); ?>
    
    </div>
    </div>
    <!-- End Example Basic Form -->
    </div>
    </div>
    </div>
    </div>
    </div>

</div>

</div>
