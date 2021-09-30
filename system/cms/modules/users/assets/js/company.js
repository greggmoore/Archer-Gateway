$( document ).ready(function() {
	$('#companyForm').bootstrapValidator({
    	message: 'This value is not valid',
		submitHandler: function(validator, form) {
        
		loading('Please, stand by ...', 1);
            
            $.ajax({
                data: $('#companyForm').serialize(),
                type: "POST",
                url: "/users/company", 
                contentType: "application/x-www-form-urlencoded; iso-8859-7",
                dataType: 'json',
                success: function(data) {
                     $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
						if(data.response)
						{
							$('#alert_message').addClass(data.response_css).fadeIn(400).html(data.response_txt);
						}
						
						unloading();
                }
               
            });
            return false;
            
	        },
	        fields: {
	            company_name: {
	                message: 'The company name is not valid.',
	                validators: {
	                    notEmpty: {
	                        message: 'The company name is required and can\'t be empty'
	                    },
	                    stringLength: {
	                        min: 2,
	                        max: 30,
	                        message: 'The company name must be more than 2 and less than 30 characters long'
	                    }
	                   
	                }
	            }}
	    });
});