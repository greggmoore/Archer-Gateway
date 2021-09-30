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
	
	$('.process').hide();
	$('.us_phone').mask('(000) 000-0000');
	$('.zipcode').mask('00000-000');
	
	
	$('#alert_message, #message, #sf-alert_message, #sf-message').hide();
	$('.us_phone').mask('(000) 000-0000');
	$('.zipcode').mask('00000-000');
	
		$('#defaultForm').bootstrapValidator({
	        message: 'This value is not valid',
	        submitHandler: function(validator, form) {
	            
	            	start_process('Processing...', 1);
		            
		            $.ajax({
		                data: $('#defaultForm').serialize(),
		                type: "POST",
		                url: "/careers", 
		                contentType: "application/x-www-form-urlencoded; iso-8859-7",
		                dataType: 'json',
		                success: function(data) {
		               
		                    if(data)
		                    {
								$('#defaultForm').fadeOut(400, function() {
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

/**
	var waypoint = new Waypoint({
	  element: document.getElementById('integrity'),
	  handler: function(dir) { 
		  $('#integrity.culture-code').addClass('integrity');
		  this.destroy();
	  },
	  offset: 200
	});
	
	
	$('#integrity').waypoint('viewport', {
		  enter: function () {
			  $('#integrity.culture-code').addClass('integrity');
		  },
		  exit: function () {
			  $('#integrity.culture-code').removeClass('integrity');
		  },
		  entered: function () {},
		  exited: function () {},
		  offset: 200
		});


	
	var waypoint = new Waypoint({
	  element: document.getElementById('dedication'),
	  handler: function(dir) { 
		  $('#dedication.culture-code').addClass('dedication');
		  this.destroy();
	  },
	  offset: 200
	});
	
**/


var resumeID = $('#resume').data('documentID');
	
	$('#resume').uploadifive({		
		
		'buttonClass'  : 'muploader',
		'buttonText'   : '<i class="fa fa-file"></i> Upload Resume',
		'multi'        : false,
		'width'        : 150,
		'multi'        : false,
		'lineHeight'	: 18 ,
		'formData'		: {'id' : resumeID , 'uri' : resumeID },
		'uploadScript' : '/careers/upload_resume',
		'onUploadComplete' : function(file, data) { 
				var json = $.parseJSON(data);
				
				//alert(json.response);
				if(json.response == 1)
				{
					$('#response_filename').val(json.response_filename);
					
					$.gritter.add({
						title: 'SUCCESS!',
						text: json.response_txt ,
						class_name: 'with-icon thumbs-o-up primary'
			    	});
	
			    	
				}
			}
	});