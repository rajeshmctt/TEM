<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\web\View;
use backend\models\enums\UserTypes;
?>

<?php $form = ActiveForm::begin([
'enableAjaxValidation'=>true,
//'action' => ['change-password'],
 'options' => ['id' => 'dynamic-form111'],
 //'validateOnSubmit'=>true
]); ?>
<div class="modal-body">
	<div class="form-group form-material popup">

		<label class="control-label">Reason for Closing the Enquiry</label>
		<?= $form->field($e_model, 'close_reason')->dropDownList(UserTypes::$reasons, ['options' => [$e_model->close_reason => ['Selected' => 'selected']], 'prompt' => ' -- Select a Reason --'])->label(false) ?>

		<!-- $form->field($e_model, 'close_reason')->dropDownList(UserTypes::$reasons, ['options' => [$e_model->close_reason => ['Selected' => 'selected']], 'prompt' => ' -- Select a Reason --'])->label(false) -->		
	</div>

	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-default btn-pure margin-0" data-dismiss="modal">Close</button>

	<?= Html::submitButton('Close Enquiry', ['id' => 'change-pass', 'class' => 'btn btn-success pull-right']); ?>
	</div>
	<?php ActiveForm::end(); ?>
	
<script type="text/javascript">
 $(document).ready(function () {
	 
	 
        $('body').on('submit', '#dynamic-form111', function (e) {
			
            var form = $(this);
            // return false if form still have some validation errors
            if (form.find('.has-error').length) 
            {
                return false;
            }
            // submit form
            $.ajax({
				url    : form.attr('action'),
				type   : 'get',
				data   : form.serialize(),
				success: function (response) 
				{
					// $.pjax.reload('#note_update_id'); for pjax update
					$("#modal-content-password").html(response);
					$("#user-old_password").val('');
					$("#user-new_password").val('');
					$("#user-confirm_password").val('');
					//console.log(getupdatedata);
				},
				error  : function (data) 
				{
					console.log('internal server error');
				}
            });
			
			return false;
         });
    });


</script>

	
	