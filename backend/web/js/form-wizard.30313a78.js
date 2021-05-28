(function ($) {
    'use strict';
    //$('#w0').card({container: '.card'});
    $('.checkbo').checkBo();
    $('.chosen').chosen({disable_search_threshold: 10, width: '100%'});
    var $validator = $('#coach_form').validate({
        rules: {
           /*
            passwordfield: {required: true, minlength: 6},
            cpasswordfield: {required: true, minlength: 6, equalTo: '#passwordfield'},
           */

            'User[email]': {required: true},
            'User[password_hash]': {required: true},
            first_name: {required: true},
            contact_no: {required: true},
            country: {required: true},
            location: {required: true},
            icf_credentials: {required: true},
            years_experience: {required: true},
            individual_client: {required: true},
            client_organization: {required: true},
            min_price: {required: true},
            max_price: {required: true},
            'coaching_medium[]': {required:true},
            domain_experience: {required: true},
            graduation_degree: {required: true}
        }
			
		
    });

    function checkValidation() {
        var $valid = $('#coach_form').valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        }
    }

    $('#rootwizard').bootstrapWizard({
        tabClass: '',
        'nextSelector': '.button-next',
        'previousSelector': '.button-previous',
        onNext: checkValidation,
        onLast: checkValidation,
        onTabClick: checkValidation
    });
})(jQuery);