<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use backend\models\enums\UserTypes;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
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
                                        
                                        <?php $form = ActiveForm::begin([
                                            'action' => ['index'],
                                            'method' => 'get',
                                        ]); ?>
                                            <div class="form-group">
                                                <!--<a href="javascript:void(0);" data-no-link="true" id="addRowBtn" class="btn btn-success btn-sm"><i class="icon md-plus" aria-hidden="true"></i>Add New
                                                    Level</a>-->
                                                <?= Html::a('Create Enquiry', ['create'], ['class' => 'btn btn-success']) ?>
                                                <?= Html::submitButton( '<i class="icon md-download"></i> Export To Excel', ['class' => 'btn btn-warning', 'name' => 'export']) ?>
                                                <!--<a class="btn btn-success add_enq waves-effect waves-light" href="#">Create Enquiry (modal)</a>-->
                                            </div>

                                        <?php ActiveForm::end(); ?>
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
            // 'owner', //hide
            //'city',
            /*[
                'label' => 'Country',
                'attribute' => 'country_id',
                'value' => function ($model) {
                    return isset($model->country_id)?$model->country->name:'Not Set';
                },
            ],*/
            'subject',
            [
                'label' => 'Source',
                'attribute' => 'source',
                'value' => function ($model) {
                    return isset($model->source)?UserTypes::$sources[$model->source]:'N/A';
                },
            ],
            'referred_by',  //hide
            [
                'label' => 'Program',
                'attribute' => 'program_id',
                'value' => function ($model) {
                    return isset($model->program_id)?$model->program->name:'N/A';
                },
            ],
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
            // 'amount',
            // [
            //     'label' => 'Currency',
            //     'attribute' => 'currency_id',
            //     'value' => function ($model) {
            //         return isset($model->currency_id)?$model->currency->name:'-Not Set-';
            //     },
            // ],
            //'status',
            //'created_at',
            //'updated_at',

            // ['class' => 'yii\grid\ActionColumn'],
            [
                // 'header'=>'View / Potential / Joined / Delete',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{updatep}{updatej}{enquiries}{potential}{joined}{delete}',

                'buttons' => [
                    'update' => function ($url, $model) {
                        return $model->status == 10 ? Html::a('<span class="icon md-eye"></span>', Yii::$app->getUrlManager()->createUrl(['/enquiry/update', 'id' => $model->id]), [
                            'title' => Yii::t('yii', 'Update'),
                            'data' => [
                                'link-to' => 'user-update',
                            ],
                        ]):'';
                    },
                    'updatep' => function ($url, $model) {
                        return $model->status == 6 ? Html::a('<span class="icon md-eye"></span>', Yii::$app->getUrlManager()->createUrl(['/enquiry/updatep', 'id' => $model->id]), [
                            'title' => Yii::t('yii', 'Update'),
                            'data' => [
                                'link-to' => 'user-update',
                            ],
                        ]):'';
                    },
                    'updatej' => function ($url, $model) {
                        return $model->status == 3 ? Html::a('<span class="icon md-eye"></span>', Yii::$app->getUrlManager()->createUrl(['/enquiry/updatej', 'id' => $model->id]), [
                            'title' => Yii::t('yii', 'Update'),
                            'data' => [
                                'link-to' => 'user-update',
                            ],
                        ]):'';
                    },
                    'enquiries' => function ($url, $model) {
                        return ($model->status == 3 || $model->status == 6) ? "&nbsp;&nbsp;&nbsp;" . Html::a('<span class="icon md-skip-previous"></span>', '#', [
                            'title' => Yii::t('yii', 'Move to Enquiries'),
                            'class' => 'swal-info-enq',
                            'data' => [
                                'url' => Yii::$app->getUrlManager()->createUrl(['/enquiry/toenq', 'id' => $model->id]),
                                'no-link' => "true",
                            ],
                        ]) : '';
                    },
                    'potential' => function ($url, $model) {
                        return ($model->status == 3 || $model->status == 10) ? "&nbsp;&nbsp;&nbsp;" . Html::a('<span class="icon md-favorite-outline"></span>', '#', [
                            'title' => Yii::t('yii', 'Move to Potential'),
                            'class' => 'swal-warning-poten',
                            'data' => [
                                'url' => Yii::$app->getUrlManager()->createUrl(['/enquiry/topotential', 'id' => $model->id]),
                                'no-link' => "true",
                            ],
                        ]) : '';
                    },
                    'joined' => function ($url, $model) {
                        return ($model->status == 6 ) ? "&nbsp;&nbsp;&nbsp;" . Html::a('<span class="icon md-favorite"></span>', '#', [
                            'title' => Yii::t('yii', 'Move to Joined'),
                            'class' => 'swal-info-join',
                            'data' => [
                                'url' => Yii::$app->getUrlManager()->createUrl(['/enquiry/tojoined', 'id' => $model->id]),
                                'no-link' => "true",
                            ],
                        ]) : '';
                    },
                    'delete' => function ($url, $model) {
                        return $model->status != 0 ? "&nbsp;&nbsp;&nbsp;" . Html::a('<span class="icon md-delete"></span>', '#', [
                            'title' => Yii::t('yii', 'Deactivate'),
                            'class' => 'swal-warning-confirm',
                            'data' => [
                                'url' => Yii::$app->getUrlManager()->createUrl(['/enquiry/delete', 'id' => $model->id]),
                                'no-link' => "true",
                            ],
                        ]) : '';
                    },
                ],
            ],
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


		<!--  Create Enquiry modal start-->
		<div class="modal fade modal-fade-in-scale-up modal-theme" id="create_enquiry" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
			<div class="modal-dialog" id="modal-dialog">
				<div class="modal-content">
					<?php $form = ActiveForm::begin(); ?>
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true" class="close-theme">×</span>
							</button>
							<h4 class="modal-title modal-title-theme">Notes</h4>
						</div>
						<div class="modal-body">
							<div class="form-group form-material row">
								<div class="col-sm-12">
									<!--<?/*= $form->field($model, 'agreement_content')->textarea(['id' => 'summernote', 'data-plugin' => 'summernote', 'value' => $agreement])->label(false) */?>-->
									<textarea  class="form-control" name="notes" required></textarea><!--id="summernote" data-plugin="summernote" style="display: none;"-->
								</div>
							</div>
							<div class="col-sm-12">
								<?= Html::hiddenInput('session_id', null, ['id' => 'session_id2']); ?>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default btn-pure margin-0" data-dismiss="modal">Close</button>
							<?= Html::submitButton('Update', ['class' => 'btn btn-success pull-right', 'id' => 'btn_reschedule']) ?>
						</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
			<!--  Create Enquiry modal end-->

            <?php

Yii::$app->view->registerJs("

	$(document).ready(function() {
		$('#dt').datepicker({
			/*format: 'dd/mm/yyyy',*/
			autoclose: true
		});

        $('.add_enq').click(function(){
            $('#create_enquiry').modal('show');
        });

        $('.notes1').click(function(){
			var id = $(this).data('id');
            $('#session_id2').val(id);
			$.ajax({
				url :'" . Yii::$app->getUrlManager()->createUrl(['session/search-model']) . "',
				data:{id:id},
				success:function(data)
				{
                    obj = $.parseJSON(data);
                    $('.note-editable').html(obj.notes);
                    $('.note-editable').css('height','100px');
					$('#update_notes').modal('show');
				}
			});
		});
	});

", \yii\web\View::POS_END);

?>