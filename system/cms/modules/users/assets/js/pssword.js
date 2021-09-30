$( document ).ready(function() {
	$('#passwordForm').bootstrapValidator({
    	message: 'This value is not valid',
		submitHandler: function(validator, form) {
        
		loading('Please, stand by ...', 1);
            
            $.ajax({
                data: $('#passwordForm').serialize(),
                type: "POST",
                url: "/users/options", 
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
		        new_password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    }
                }
            },
            verify_password: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
	        }
	    });
});