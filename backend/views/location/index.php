<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page enquiry-index"><!-- program-index -->
		<div class="page-header">
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>"
                       data-link-to="site">Home</a></li>
                <?php foreach ($this->params['breadcrumbs'] as $k => $v) {
                    if (isset($v['label'])) {
                        echo "<li><a href=" . Yii::$app->urlManager->createAbsoluteUrl($v['url'][0]) . ">" . $v['label'] . "</a></li>";
                    } else {
                        echo "<li class='active'>$v</li>";
                    }
                }?>
            </ol>
        </div>
		<div class="page-content">
            <div class="row row-lg mgcut">
                <div class="col-lg-12">
                    <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
					<div class="panel">
						<div class="panel-collapse collapse in" id="exampleCollapseDefaultLevel" aria-labelledby="exampleHeadingDefaultLevel"
                    role="tabpanel">
							<div class="panel-body">
								<div class="form-inline padding-bottom-15">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        
                                            <div class="form-group">
                                                <!--<a href="javascript:void(0);" data-no-link="true" id="addRowBtn" class="btn btn-success btn-sm"><i class="icon md-plus" aria-hidden="true"></i>Add New
                                                    Level</a>-->
                                                <!--<?= Html::a('Add Country', ['create'], ['class' => 'btn btn-success']) ?>-->
                                                <a href="javascript:void(0);" data-no-link="true" id="addRowBtn"
                                                   class="btn btn-success btn-sm">
                                                    <i class="icon md-plus" aria-hidden="true"></i>Add Country</a>
                                            </div>

                                        </div>
                                    </div>

                                    
                                </div>


                                <div class="panel" id="location" style="display: none;">

                                        <div class="row row-lg mgcut">
                                            <div class="col-sm-10 col-md-offset-1">
                                                <div class="example-wrap">
                                                    <div class="example">
                                                        <?php $form = ActiveForm::begin(); ?>
                                                        <div class="form-group row"><!-- form-material-->
                                                            <div class="col-sm-4">
                                                                <label class="control-label">Country</label>
                                                                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
                                                                <?php // $form->field($model, 'name')->textInput(['id' => 'locationname'])->label(false) ?>
                                                                <h5 class="loc-error red-theme">Location cannnot be blank</h5>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <?= Html::submitButton('Add', ['class' => 'btn btn-success pull-right', 'id' => 'sub_location']) ?>
                                                            </div>
                                                        </div>
                                                        <?php ActiveForm::end(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
                        </div>
                        </div>
                        </div>
                    </div>
                    <!-- End Panel Add &amp; Remove Rows -->
                </div>
            </div>
        </div>
</div>


<?php


Yii::$app->view->registerJs("
	$(document).ready(function() {
        $('.con-error').hide();
        $('.loc-error').hide();

$('#addRowBtn').click(function(e) {
		      $('#location').animate( { height: 'toggle' }, 800, 'linear' )
          .delay( 500 )
		});
	});
	

", \yii\web\View::POS_END);

?>