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

            <?php if (Yii::$app->user->identity->role == (UserTypes::SUPER_ADMIN || UserTypes::CLIENT)) { ?>
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
                                                <span class="counter-number"><?= $e_cnt ?></span>
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
                                                <span class="counter-number"> <?= $p_cnt ?></span>
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
                                                <span class="counter-number"><?= $c_cnt ?> </span>
                                                <span class="counter-number-related text-capitalize">Confirmed</span>
                                            </div>
                                            <div class="counter-label text-capitalize"><a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl(["enquiry/joined"]); ?>"> Manage Confirmed</a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <div class="widget">
                                    <div class="widget-content padding-30 bg-green-600">
                                        <div class="widget-watermark darker font-size-60 margin-15"><i
                                                class="icon md-collection-text" aria-hidden="true"></i></div>
                                        <div class="counter counter-md counter-inverse text-left">
                                            <div class="counter-number-group">
                                                <span class="counter-number"><?= $x_cnt ?> </span>
                                                <span class="counter-number-related text-capitalize">Closed</span>
                                            </div>
                                            <div class="counter-label div-theme text-capitalize"><a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl(["enquiry/closed"]); ?>"> Manage Closed</a></div>

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

                    </div>
                </div>


            <?php } ?>
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
