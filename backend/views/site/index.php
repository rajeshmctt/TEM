<?php

/* @var $this yii\web\View */
use backend\models\enums\SessionStatusTypes;
use backend\models\enums\UserTypes;
use backend\models\enums\ServiceTypes;
use backend\models\enums\ServiceModes;
use backend\models\enums\DirectoryTypes;
use backend\models\enums\TimeZoneTypes;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Services;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\ListView;
use ogheo\comments\widget\Comments;
use dosamigos\datepicker\DatePicker;

$this->title = 'TEM';
?>
<div class="page">
    <div class="site-index">
        <div class="page-content">

            <?php if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) { ?>
                <div class="panel dashboard-panel">
                    <div class="panel-body container-fluid">
                        <div class="row">
                            <div class="col-md-3 col-xs-12">
                                <div class="widget">
                                    <div class="widget-content padding-30 bg-orange-600">
                                        <div class="widget-watermark darker font-size-60 margin-15"><i
                                                class="icon md-balance" aria-hidden="true"></i></div>
                                        <div class="counter counter-md counter-inverse text-left">
                                            <div class="counter-number-group">
                                                <span class="counter-number"><?= $clients=90 ?></span>
                                                <span class="counter-number-related text-capitalize">Enquiries</span>
                                            </div>
                                            <div class="counter-label text-capitalize">
											<a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['enquiry/index']); ?>">Manage Enquiries</a>
											</div>
											<div class="counter-label text-capitalize"><br>
											<?= Html::a('Create Enquiry', ['enquiry/create'], ['class' => 'btn btn-primary']) ?>
											</div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <div class="widget">
                                    <div class="widget-content padding-30 bg-red-600">
                                        <div class="widget-watermark darker font-size-60 margin-15"><i
                                                class="icon md-accounts" aria-hidden="true"></i></div>
                                        <div class="counter counter-md counter-inverse text-left">
                                            <div class="counter-number-group">
                                                <span class="counter-number"> <?= $ecount=30 ?></span>
                                                <span class="counter-number-related text-capitalize">Potential</span>
                                            </div>
                                            <div class="counter-label text-capitalize"><a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['enquiry/potential']); ?>"> Manage Potential</a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <div class="widget">
                                    <div class="widget-content padding-30 bg-blue-custom-600">
                                        <div class="widget-watermark darker font-size-60 margin-15"><i
                                                class="icon md-accounts" aria-hidden="true"></i></div>
                                        <div class="counter counter-md counter-inverse text-left">
                                            <div class="counter-number-group">
                                                <span class="counter-number">20 </span>
                                                <span class="counter-number-related text-capitalize">Joined</span>
                                            </div>
                                            <div class="counter-label text-capitalize"><a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl(["enquiry/joined"]); ?>"> Manage Joined</a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <div class="widget">
                                    <div class="widget-content padding-30 bg-orange-600">
                                        <div class="widget-watermark darker font-size-60 margin-15"><i
                                                class="icon md-collection-text" aria-hidden="true"></i></div>
                                        <div class="counter counter-md counter-inverse text-left">
                                            <div class="counter-number-group">
                                                <span class="counter-number"></span>
                                                <!--<span class="counter-number-related text-capitalize">Sub-categories</span>-->
                                            </div>
                                            <div class="counter-label div-theme text-capitalize">
                                                    </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php
                            $array = [
                                ['id' => 10, 'name' => 'Active'],
                                ['id' => 0, 'name' => 'Inactive'],
                            ];
                            $accept = [
                                ['id' => 1, 'name' => 'Accepted'],
                                ['id' => '', 'name' => 'Pending'],
                            ];
                            ?>
                            <?php
                            /*$columns = [
                                [
									'label' => 'Name',
									/*'label' => function($data){
										if ($data->role == UserTypes::CLIENT) {
											return 'Client Name';
										}else{
											return 'Coach Name';
										}
									},
									'attribute' => 'fullName',
									//'attribute' => 'assignment_id',
									'value' =>  function($data){
										//return 'assignment.coach.first_name'.' '.'assignment.coach.last_name' ;
										return $data->first_name .' '. $data->last_name ;
									},
								],
                                [
									'label' => 'Country',
									'attribute' => 'country_id',
									'value' =>  function($data){
										//return 'assignment.coach.first_name'.' '.'assignment.coach.last_name' ;
										return isset($data->country)?$data->country->name:'' ;
									},
								],
								// 'email',
                                [
                                    'attribute' => 'contact_no',
                                    'contentOptions' => function ($model) {
                                        return [
                                            'class' => $model->status == 10 ? 'contact_no editable-pointer' : '',
                                            'data-pk' => $model->id,
                                        ];
                                    }
                                ],
                                [
                                    'format' => 'raw',
									'attribute' => 'accept_agreement',
                                    'value' => function ($model) {
                                        if ($model->accept_agreement == 1) {
											return '<span class="label label-lg label-success">Accepted</span>';
										} else {
											return '<span class="label label-lg label-warning">Pending</span>';
										}
                                    },
									// 'filter' => Html::activeDropDownList($searchModel, 'accept_agreement', ArrayHelper::map($accept, 'id', 'name'), ['class' => 'form-control', 'prompt' => 'Select Agreement Status']),
                                ],
                                [
                                    'label' => 'Services',
									// 'attribute' => 'accept_agreement',
                                    'value' => function ($model) {
										// foreach($model->services as $sv){
											// $loc = isset($sv->services)?$sv->location->name:'';
											// $loc = isset($sv->services)?$sv->location->name:'';
										// }
										return count($model->services);
										
									},
                                ]
                            ];*/
                            ?>
                            <?php
                            if (Yii::$app->user->identity->role == UserTypes::CLIENT) {
								$columns = [
									['class' => 'yii\grid\SerialColumn'],

									// 'id',
									// 'name',
									// 'event_id',
									'date:date',
									'start_time:time',
									'end_time:time',
									/*[
										'label' => 'End Time',
										'value'=> function($model){	
											return date('h:i A',$model->end_time);
										},
										'filter' => '<input type="text" class="timepicker entp form-control" data-plugin="clockpicker" data-twelvehour="true" data-autoclose="true" name="end_time[]" id="tm2">'
									],*/
									//'status',
									[
										// 'attribute'=>'cancellable',
										// 'format'=>'raw',
										'label'=>'Slot Status',
										'value'=> function($model)
										{
											// return count($model->userSlots).'/'.$model->event->user_per_slot;
											return count($model->bookers).'/'.$model->event->user_per_slot;
										}
									],
									//'created_at',
									//'updated_at',

									// ['class' => 'yii\grid\ActionColumn'],
									[
										// 'header'=>'Delete',    {email} 
										'class' => 'yii\grid\ActionColumn',
										'template' => (Yii::$app->user->identity->role == UserTypes::CLIENT)?'{users} {delete}':'{users}', //{view} {update} 
										'buttons' => [
											'users' => function ($url, $model) {
												return Html::a('<span class="glyphicon glyphicon-user"></span>', Yii::$app->getUrlManager()->createUrl(['/booker/slot-users', 'sid' => $model->id]), [
													'title' => Yii::t('yii', 'Users'),
												]);
											},
										],
									]
								];
                                /*$columns[] = [

                                    'label' => 'Location',
                                    'value' => function ($model) {
										foreach($model->userLocations as $ul){
											$loc = isset($ul->location)?$ul->location->name:'';
										}
										return $loc;
										
									},
                                    //'filter' => Html::activeDropDownList($searchModel, 'organization_id', ArrayHelper::map(Organization::find()->where(['status' => 10])->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Organization']),

                                ];*/

                            } ?>
						<?php	if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN){
									$columns = [
									['class' => 'yii\grid\SerialColumn'],

									// 'id',
									// 'name',
									// 'event_id',
									'date:date',
									'start_time:time',
									'end_time:time',
									/*[
										'label' => 'End Time',
										'value'=> function($model){	
											return date('h:i A',$model->end_time);
										},
										'filter' => '<input type="text" class="timepicker entp form-control" data-plugin="clockpicker" data-twelvehour="true" data-autoclose="true" name="end_time[]" id="tm2">'
									],*/
									//'status',
									[
										// 'attribute'=>'cancellable',
										'label'=>'Slot Status',
										'value'=> function($model)
										{
											// return count($model->userSlots).'/'.$model->event->user_per_slot;
											return count($model->bookers).'/'.$model->event->user_per_slot;
										}
									],
									//'created_at',
									//'updated_at',

									// ['class' => 'yii\grid\ActionColumn'],
									[
										// 'header'=>'Delete',    {email} 
										'class' => 'yii\grid\ActionColumn',
										'template' => (Yii::$app->user->identity->role == UserTypes::CLIENT)?'{users} {delete}':'{users}', //{view} {update} 
										'buttons' => [
											'users' => function ($url, $model) {
												return Html::a('<span class="glyphicon glyphicon-user"></span>', Yii::$app->getUrlManager()->createUrl(['/booker/slot-users', 'sid' => $model->id]), [
													'title' => Yii::t('yii', 'Users'),
												]);
											},
										],
									]
								];/*$columns[] = [
									'format' => 'raw',
									'attribute' => 'status',
									'value' => function ($model) {
										if ($model->status == 10) {
											return '<span class="label label-lg label-success">Active</span>';
										} else {
											return '<span class="label label-lg label-danger">Inactive</span>';
										}
									},
									'contentOptions' => function ($model) {
										return [
											// 'class' => Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN ? $model->agreement_content != "" ?'client_status editable-pointer': '' : '',
											'class' => Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN ? 'client_status editable-pointer': '',
											'data-pk' => $model->id,
											'data-value' => $model->status,

										];
									},
									'filter' => Html::activeDropDownList($searchModel, 'status', ArrayHelper::map($array, 'id', 'name'), ['class' => 'form-control', 'prompt' => 'Select Status']),
								];*/
								

							?>

							
							<div class="table-responsive">
                            <!--<?/*= GridView::widget([

                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => $columns,

                            ]);  */?>-->
							</div>
							<?php
						}
                            ?>
                        <!--<div class="row">
                            <div class="col-md-3 col-xs-12 ">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Clients/Organization</h3>
                                    </div>
                                    <div class="example-wrap text-center">
                                            <canvas id="exampleChartjsPie4" height="250" >clients</canvas>
									</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 ">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Sessions/Coaches</h3>
                                    </div>
                                    <div class="example-wrap text-center">
                             <canvas id="exampleChartjsPie5" height="250"></canvas>
                            </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12 ">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Sessions/Client</h3>
                                    </div>

<div class="example-wrap text-center">
                                            <canvas id="exampleChartjsPie6" height="250"></canvas>
</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 ">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Sessions/Date</h3>
                                </div>
                                <div class="text-center">
                                        <canvas id="exampleChartjsBar4"  height="330" width="280"></canvas>
</div>
                            </div>
                            </div>



                            </div>
                        -->    

                    </div>
                </div>


            <?php }
            if (Yii::$app->user->identity->role == UserTypes::CLIENT) {
                
					// echo "<pre>"; print_r(Yii::$app->user->identity); exit; 
                    if (Yii::$app->user->identity->role == UserTypes::CLIENT) {
						$columns = [
									['class' => 'yii\grid\SerialColumn'],

									// 'id',
									// 'name',
									// 'date:date',
									[
										'attribute'=>'date',
										'value'=> function($model){
											return date('M-d-Y',$model->date);
										},
										'format' => 'raw',
										// 'filter' => DatePicker::widget([
											// 'model' => $searchModel,
											// 'attribute' => 'date',
											// 'template' => '{addon}{input}',
												// 'clientOptions' => [
													// 'autoclose' => true,
													// 'format' => 'yyyy-mm-dd'
												// ]
										// ])
									],
									// 'start_time:time',
									[
										'label' => 'Start Time',
										'attribute' => 'start_time',
										'value'=> function($model){	
											return date('h:i A',$model->start_time);
										},
									],
									// 'end_time:time',
									[
										'label' => 'End Time',
										'attribute' => 'end_time',
										'value'=> function($model){	
											return date('h:i A',$model->end_time);
										},
										// 'filter' => '<input type="text" class="timepicker entp form-control" data-plugin="clockpicker" data-twelvehour="true" data-autoclose="true" name="end_time[]" id="tm2">'
									],
									[
										'attribute' => 'event_id',
										'label' => 'Event',
										'value' => function($model){
											return $model->event->topic;
										}
									],
									//'status',
									[
										// 'attribute'=>'cancellable',
										'format'=>'raw',
										'label'=>'Slot Status',
										'value'=> function($model)
										{
											// return count($model->userSlots).'/'.$model->event->user_per_slot;
											$label = 'label-warning';
											if(count($model->bookers)/$model->event->user_per_slot == 1){
												$label = 'label-danger';
											}
											if(count($model->bookers)/$model->event->user_per_slot == 0){
												$label = 'label-success';
											}
											return '<span class="label label-lg '. $label .'">'.count($model->bookers).'/'.$model->event->user_per_slot.'</span>';
										}
									],
									//'created_at',
									//'updated_at',

									// ['class' => 'yii\grid\ActionColumn'],
									[
										// 'header'=>'Delete',    {email} 
										'class' => 'yii\grid\ActionColumn',
										'template' => (Yii::$app->user->identity->role == UserTypes::CLIENT)?'{users}':'{users}', //{view} {update} 
										'buttons' => [
											'users' => function ($url, $model) {
												return Html::a('<span class="glyphicon glyphicon-user"></span>', Yii::$app->getUrlManager()->createUrl(['/booker/slot-users', 'sid' => $model->id]), [
													'title' => Yii::t('yii', 'Users'),
												]);
											},
										],
									]
								];
                        ?>
                        <!-- Start Competency -->
						
                        <div class="panel dashboard-panel">
                            <div class="panel-body container-fluid">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 masonry-item">
										
									</div>
								</div>
                                <div class="row">
									<?php $sel = ''; //$tzs=[1,2,3];
									?>
                                    <div class="col-md-12 col-xs-12">
										<div class="widget">
											<div class="widget-content padding-30 bg-blue-custom-600">
												<!--<div class="widget-watermark darker font-size-60 margin-15"><i
														class="icon md-group-work" aria-hidden="true"></i></div>-->
												<div class="counter counter-md counter-inverse text-left">
													<div class="counter-number-group row">
														<div class="col-md-10 ">
															<span class="counter-number-related text-capitalize">All Slots</span>
														</div>
														<!--<div class="col-md-2 col-xs-12">
															<?/*= TimeZoneTypes::$tz2[$tzname] */?>
														</div>-->
														<div class="col-md-2 col-xs-12">
															<label class="control-label" style="font-size:12px">Timezone</label>
															<?= html::dropDownList('timezone',$tzname,$tzs,['class'=>'form-control time_zone','prompt'=>'Select Timezone']) ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--modal for email svc-->
									<?php Modal::begin([
									'id' => 'activity-modal2',
									'header' => '<h4 class="modal-title">Contact Provider</h4>',
									//'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
									]); ?>
									<div class="well">
									</div>
									<?php Modal::end(); ?>
									
									<!--modal for view svc-->
									<?php Modal::begin([
									'id' => 'activity-modal3',
									'size' => 'modal-medium', //medium
									'header' => '<h4 class="modal-title sertitle">View Service</h4>',
									//'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
									]); ?>
									<div class="well">
									</div>
									<?php Modal::end(); ?>
									
									
									
									
                                </div>

							<div class="row">
								<div class="col-md-7 "><!--col-md-offset-3-->													
									<div class="table-responsive">
									<?= GridView::widget([

										'dataProvider' => $dataProvider,
										'filterModel' => $searchModel,
										'columns' => $columns,

									]);  ?>
									</div>
								</div>
								<div class="col-md-5 "><!--col-md-offset-3-->
								  <?= \yii2fullcalendar\yii2fullcalendar::widget([
										'events'=> $events,
								  ]);?>
								</div>
							</div>
                            </div>
                        </div>
                        <?php
                    }


            }
            ?>
        </div>
    </div>
</div>


<?php
$this->registerJs('
	$("#target-div").load("http://localhost/ecosystem/hub/index.php?r=space%2Fspace&cguid=f79d8f4b-13f1-4d90-8837-588606588f6c");
		
	setTimeout(function(){
		console.log(e1);	  
		var e1  = [
			{
				title  : "eventb",
				start  : "2018-03-03",
				end    : "2018-03-05"
			},
			{
				title  : "eventc",
				start  : "2018-03-09T12:30:00",
				allDay : false // will make the time show
			}
		];
		/*var calendar = $("#calendar").fullCalendar({  
			header: {
				left: "prev,next today",
				center: "title",
				right: "month,agendaWeek,agendaDay,listWeek"
			},
			navLinks: true, 
			editable: false,
			eventLimit: true, 
			events: e2,
			
		});*/
	},2000);
', View::POS_READY, 'init-calendar');

$this->registerJs('

$(document).ready(function() {
	// $("#slotsearch-date").datepicker("option", "dateFormat", "@");
	
	// $("#w1").fullCalendar("option", "height", 400); //calendar height
	// $("#w1").fullCalendar("option", "contentHeight", 400);
	$("#w1").fullCalendar("option","eventMouseover", function(calEvent, jsEvent, view) {
			// alert("Event: "" + calEvent.title);
			// alert("Coordinates: " + jsEvent.pageX + "," + jsEvent.pageY);
			// console.log("View: ");
			// change the border color just for fun
			// $(this).css("border-color", "red");
		}
	);
	$(".time_zone").change(function(){
		var tz = $(this).val();
		var tz_name = $(".time_zone option:selected").text();
		console.log(tz);
		$.ajax({
			url:"'.Yii::$app->getUrlManager()->createUrl(['slot/change-tz2']).'",
			type:"get",
			data:{tz:tz},
			success:function(data)
			{
				// location.reload();
			}
		});
	});
	
	$(".bat").click(function(){
		$("#login_username").val("test "); 
		console.log("tetetet");
	});
  var role = '.Yii::$app->user->identity->role.';

	$("#dt").datepicker({
        /*format: "dd/mm/yyyy",*/
        autoclose: true
    });
$("#dt").val("'.date("M-d-Y").'");

        $(".rate-update").click(function(){
            var com_id = $(this).data("id");

            var name = "current_value"+com_id;


            var current_val = $("input[name="+name+"]").val();


             $.ajax({
                     type:"GET",
                    url: "' . Yii::$app->getUrlManager()->createUrl(['assignment/add-current-value']) . '",
                    data: {com_id: com_id, current_val:current_val},
                });
         });





	if(role=='.UserTypes::SUPER_ADMIN.' && 0){


		$.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-clients-for-admin']) . '",
            success: function(data) {
         var obj = JSON.parse(data);
            var pieData =obj
            if(pieData=="")
            {

              $("#exampleChartjsPie4").parent().html("<h3 class=\'red-theme\'>No Clients Yet</h3>");

            }
            else
            {
            new Chart(document.getElementById("exampleChartjsPie4").getContext("2d")).Pie(pieData)
            }




            }

        });

        $.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-client-session-for-admin']) . '",
            success: function(data) {
         var obj = JSON.parse(data);
            var pieData =obj
       if(pieData=="")
            {

              $("#exampleChartjsPie6").parent().html("<h3 class=\'red-theme\'>No Sessions Yet</h3>");

            }
            else
            {
           new Chart(document.getElementById("exampleChartjsPie6").getContext("2d")).Pie(pieData)
            }

            }

        });

 $.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-coach-session-for-admin']) . '",
            success: function(data) {
         var obj = JSON.parse(data);
            var pieData =obj
            if(pieData=="")
            {

              $("#exampleChartjsPie5").parent().html("<h3 class=\'red-theme\'>No Sessions Yet</h3>");

            }
            else
            {
           new Chart(document.getElementById("exampleChartjsPie5").getContext("2d")).Pie(pieData)
            }

            }

 });

        $.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-date-session-for-admin']) . '",
            success: function(data) {
                var obj = JSON.parse(data);
 

 
                var barChartData = {
                    labels: obj.date_unique,
                    scaleShowGridLines: !0,
                    scaleShowVerticalLines: !1,
                    scaleGridLineColor: "#ebedf0",
                    barShowStroke: !1,
                    datasets: [{
                        fillColor: $.colors("blue", 500),
                        strokeColor: $.colors("blue", 500),
                        highlightFill: $.colors("blue", 500),
                        highlightStroke: $.colors("blue", 500),
                        data: obj.date_session,
                    }]
                };

               
		 if(obj.date_unique=="" && obj.date_session=="")
            {

              $("#exampleChartjsBar4").parent().html("<h3 class=\'red-theme\'>No Sessions Yet</h3>").addClass("example-wrap");

            }
			else
            {
                new Chart(document.getElementById("exampleChartjsBar4").getContext("2d")).Bar(barChartData);


            }
            }
        });

        }

});


'); ?>
