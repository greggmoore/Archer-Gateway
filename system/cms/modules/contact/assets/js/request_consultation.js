function start_process(name, overlay) { 
	$('body').append('<div id="overlay"></div><div id="preloader">'+name+'..</div>');
		if(overlay==1){
		  $('#overlay').css('opacity',0.4).fadeIn(600, function(){  $('#preloader').fadeIn(600);	});
		  return  false;
	   }
	$('#preloader').fadeIn();	  
}

function end_process() { 
	//$('#preloader').fadeOut(400, function(){ $('#overlay').fadeOut(); });
	
	//$('#preloader').fadeOut(400);
	$( "#overlay" ).fadeOut( 600, function() {
		$( "#preloader" ).fadeOut( 600 );
		return  false;
	});
}

$(document).ready(function(){

	
	$('.process, #alert_message, #message, #sf-message').hide();
	$('.us_phone').mask('(000) 000-0000');
	$('.zipcode').mask('00000-000');
	
		$('#requestConsultationForm').bootstrapValidator({
	        message: 'This value is not valid',
	        submitHandler: function(validator, form) {
	            
	            	start_process('Processing...', 1);
		            
		            $.ajax({
		                data: $('#requestConsultationForm').serialize(),
		                type: "POST",
		                url: "/contact/request_consultation", 
		                contentType: "application/x-www-form-urlencoded; iso-8859-7",
		                dataType: 'json',
		                success: function(data) {
		               
		                    if(data)
		                    {
								$('#requestConsultationForm').fadeOut(400, function() {
									$('#alert_message').addClass(data.css).fadeIn(400).html(data.alert_message);
									$('#message').fadeIn(400).html(data.message) ;
								});
		                    }
		                    
		                    end_process();
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