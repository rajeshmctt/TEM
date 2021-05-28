<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enquiries';
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
                        <!--<div class="panel-heading" id="exampleHeadingDefaultLevel" role="tab">
							<a class="panel-title collapsed" id="panel-theme" data-toggle="collapse" href="#exampleCollapseDefaultLevel"
                                  data-parent="#exampleAccordionDefault" aria-expanded="true"
                                  aria-controls="exampleCollapseDefaultLevel">
								Faculties
							</a>
                        </div>-->
						<div class="panel-collapse collapse in" id="exampleCollapseDefaultLevel" aria-labelledby="exampleHeadingDefaultLevel"
                    role="tabpanel">
							<div class="panel-body">
								<div class="form-inline padding-bottom-15">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!--<a href="javascript:void(0);" data-no-link="true" id="addRowBtn" class="btn btn-success btn-sm"><i class="icon md-plus" aria-hidden="true"></i>Add New
                                                Level</a>-->
											<?= Html::a('Create Enquiry', ['create'], ['class' => 'btn btn-success']) ?>
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

            // 'id',
            // 'date_of_enquiry',
            [
                // 'label' => 'Program',
                'attribute' => 'date_of_enquiry',
                'value' => function ($model) {
                    return date('M-d-Y',$model->date_of_enquiry);
                },
            ],
            'full_name',
            'contact_no',
            'email:email',
            //'address',
            'owner',
            //'city',
            [
                'label' => 'Country',
                'attribute' => 'country_id',
                'value' => function ($model) {
                    return isset($model->country_id)?$model->country->name:'Not Set';
                },
            ],
            //'source',
            'subject',
            'referred_by',
            // 'program_id',
            //'final_status_l1',
            //'invoice_raised_l1',
            //'l1_batch',
            //'l1_status',
            //'final_status_l2',
            //'invoice_raised_l2',
            //'l2_batch',
            //'l2_status',
            //'final_status_l3',
            //'invoice_raised_l3',
            //'l3_batch',
            //'l3_status',
            'amount',
            [
                'label' => 'Currency',
                'attribute' => 'currency_id',
                'value' => function ($model) {
                    return isset($model->currency_id)?$model->currency->name:'-Not Set-';
                },
            ],
            //'status',
            //'created_at',
            //'updated_at',

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
