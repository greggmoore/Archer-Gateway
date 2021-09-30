$( document ).ready(function() {
	$('#nothankyou-form, .thankyou-message').hide();
	$('#myModal').modal('show');
	
	$(document).on('click', '.removeblur', function (e) {
		e.preventDefault();
	    //var dataId = $(this).data('id');
		//alert('hello');
		$('.container').removeClass("blur");
		$.ajax({
			url: '/report/register' ,
			data: $('#register').serialize(),
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
					$('#myModal').modal('hide');
				}
			}
		});

	});
	
	$(document).on('click', '.nothankyou', function (e) {
		$('#nothankyou-form').show();
	});
	
	
	$('#contact').bootstrapValidator({
        message: 'This value is not valid',
        submitHandler: function(validator, form) {
            
            start_process(1);
	            
	            $.ajax({
	                data: $('#contact').serialize(),
	                type: "POST",
	                url: "/report/register", 
	                contentType: "application/x-www-form-urlencoded; iso-8859-7",
	                dataType: 'json',
	                success: function(data) {
	                    if(data.response==0){
							end_process();
	                    }
	                    
	                    if(data.response==1)
	                    {
	                        end_process();
	                    }
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
                    
                    /**
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                    **/
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
                    
                    /**
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                    **/
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
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    }
                }
            }
        }
    });
    
    
    //////
    
    $('#noproperty').bootstrapValidator({
        message: 'This value is not valid',
        submitHandler: function(validator, form) {
            
            start_process(1);
	            
	            $.ajax({
	                data: $('#noproperty').serialize(),
	                type: "POST",
	                url: "/report/register", 
	                contentType: "application/x-www-form-urlencoded; iso-8859-7",
	                dataType: 'json',
	                success: function(data) {
	                    if(data.response==0){
							end_process();
	                    }
	                    
	                    if(data.response==1)
	                    {
	                        end_process();
	                    }
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
                    
                    /**
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                    **/
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
                    
                    /**
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                    **/
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
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    }
                }
            }
        }
    });
	
});


function start_process(t) {
    if (t == 1) {
        
        var html = '<p>Processing, please wait...</p><img class="img-responsive" src="/system/cms/modules/contact/assets/images/loading_bar_animated.gif" />';
                
        $("#contact").fadeOut(400, function () {
        	$(".thankyou-message").fadeIn(400).html(html);
		});
        return false
    }
}

function end_process() {
	
	var html = '<h2>Form has been sent!</h2><p>Thank you for your interest in MyRocketListing.com.<br />A representative will be contacting you soon.</p><p>Again, thank you and have a great day!</p><p><strong>MyRocketListing.com</strong></p>';
	
	$(".thankyou-message").delay(2000).fadeOut(400, function () {
		$(".thankyou-message").fadeIn(400).html(html);
	});
	return false
	
	
	
}