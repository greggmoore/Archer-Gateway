$( document ).ready(function() {
	$('#accountForm').bootstrapValidator({
    	message: 'This value is not valid',
		submitHandler: function(validator, form) {
        
		loading('Please, stand by ...', 1);
            
            $.ajax({
                data: $('#accountForm').serialize(),
                type: "POST",
                url: "/users/account", 
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
	            first_name: {
	                message: 'Your first name is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Your first name is required and can\'t be empty'
	                    },
	                    stringLength: {
	                        min: 2,
	                        max: 30,
	                        message: 'Your first name must be more than 2 and less than 30 characters long'
	                    }
	                   
	                }
	            },
	            
	            last_name: {
	                message: 'Your last name is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Your last name is required and can\'t be empty'
	                    },
	                    stringLength: {
	                        min: 2,
	                        max: 30,
	                        message: 'Your last name must be more than 2 and less than 30 characters long'
	                    }
	                    
	                }
	            },
	            
	            email: {
	                validators: {
	                    notEmpty: {
	                        message: 'The email address is required and can\'t be empty'
	                    },
	                    emailAddress: {
	                        message: 'The input is not a valid email address'
	                    }
	                }
	            }
	        }
	    });
});