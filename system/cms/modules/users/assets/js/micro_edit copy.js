$(document).ready(function () {

	
	$('.redactor_content').redactor({
		buttons: ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'image', 'table', 'link', 'alignment', 'horizontalrule'],
		cleanup: false,
		convertDivs: false,
		imageUpload: '/users/upload_photo'
		//imageGetJson: '../demo/json/data.json'
	});
	
	
$(function() {
	$('#file_upload').uploadifive({

		'buttonClass'  : 'muploader',
		'buttonText'   : 'Select',
		'multi'        : false,
		'width'        : 100,
		'multi'        : false,
		'uploadScript' : '/users/micro_upload_background',
		'onUploadComplete' : function(file, data) { 
				var data = '';		
				$.ajax({
					url: "/users/micro_get_background",
					data: data,
					success: function(data){
						if(data.response==1){
							$('.ms-photo').html(data.html);
						}
					},
					cache: false, type: "POST", dataType: 'json'
				});
				
			}
	});
});
	$(document).on('click', 'a.delete', function (e) {
		e.preventDefault();
		
   		var id = $(this).attr('id');
		var data ='img='+ id;
		
		if(confirm('Are you sure want to delete this background?'))
		{
			loading('Please wait...', 1500);
			$.ajax({
				url: "/users/micro_delete_background",
				data: data,
				success: function(data){
					if(data.check==1){
						$("#row-"+id).fadeOut('slow', function(){
							$("#row-"+id).slideUp("slow");
						});
						setTimeout("unloading()",1500);
						return false;
					}
				},
				cache: false,
				type: 'POST',
				dataType: 'json'
			});
	
		}
		
		return false;
   	});
	       	
	       	
            
	$('#subdomain').keyup(function(){
	  var uri = $("input#subdomain").val();
	  if(uri.length > 0)
	  {
			$.ajax({
				url: "/users/check_subdomain",
				data: 'subdomain=' + uri,
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
				
					if(data.response==0)
					{
						$('.sub-btn').prop('disabled', true);
					}
						else
					{
						$('.sub-btn').prop('disabled', false);
					}
					
					$('span.urimessage').fadeIn(200).html(data.message);
				}
			
			});

	  }
	  	
	  var text = uri.replace(/ /g, '-').toLowerCase();
	  $("span.uri b").text(text);
	});
	
	
	$('#domain').keyup(function(){
	  var uri = $("input#domain").val();
	  if(uri.length > 4)
	  {
			$.ajax({
				url: "/users/check_domain",
				data: 'domain=' + uri,
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
				
					if(data.response==0)
					{
						$('.btn').prop('disabled', true);
					}
					
					$('span.durimessage').fadeIn(200).html(data.message);
				}
			
			});

	  }

	});
	
	//check email
	
	$('#email').keyup(function(){
	  var email = $("input#email").val();
	  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  if(email.length > 7)
	  {
			$.ajax({
				url: "/users/check_email",
				data: 'email=' + email,
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
				
					if(data.response==0)
					{
						$('.btn').prop('disabled', true);
					}
					
					$('span.emailmessage').fadeIn().html(data.message);
				}
			
			});

	  }

	});

	
	$('#micro_add').bootstrapValidator({
        message: 'This value is not valid',
        live: 'disabled',
        submitHandler: function(validator, form) {
        
        loading('...updating', 1);
            
            $.ajax({
                data: $('#micro_add').serialize(),
                type: "POST",
                url: "/users/micro", 
                contentType: "application/x-www-form-urlencoded; iso-8859-7",
                dataType: 'json',
                success: function(data, status) {
                    
                    $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
                    
                    if(data.response=1){
						window.location.href = '/users/micro/success';
                    }
                    
                    if(data.response==0){
						$('.alert').addClass(data.css).fadeIn(400).html(data.message);
                    }
					
					if(data.response){
						$('.alert').addClass('alert-warning').fadeIn(400).html('<strong>Hmmm...</strong> Not sure what happened. Please try again or contact support.');

                    }
                    
              
                    unloading();
                }
                
               
            });
            
            return false;
        },
                
        fields: {           
            subdomain: {
                message: 'The subdomain is not valid',
                validators: {
                    notEmpty: {
                        message: 'The subdomain is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The subdomain must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The subdomain can only consist of alphabetical, number, dot and underscore'
                    }
                }
            }
        }
    });
    
    
    
    $('#microSubdomain').bootstrapValidator({
        message: 'This value is not valid',
        live: 'disabled',
        submitHandler: function(validator, form) {
        
        loading('...updating', 1);
            
            $.ajax({
                data: $('#microSubdomain').serialize(),
                type: "POST",
                url: "/users/micro", 
                contentType: "application/x-www-form-urlencoded; iso-8859-7",
                dataType: 'json',
                success: function(data, status) {
                    
                    $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
                    
                    if(data.response){
						$('.alert').addClass(data.css).fadeIn(400).html(data.message);
                    }
                    	else
                    {
	                    $('.alert').addClass('alert-warning').fadeIn(400).html('<strong>Hmmm...</strong> Not sure what happened. Please try again or contact support.');

                    }					
                    
                    unloading();
                }
                
               
            });
            
            return false;
        },
                
        fields: {           
            subdomain: {
                message: 'The subdomain is not valid',
                validators: {
                    notEmpty: {
                        message: 'The subdomain is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The subdomain must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The subdomain can only consist of alphabetical, number, dot and underscore'
                    }
                }
            }
        }
    });
    
    
    $('#microContent').bootstrapValidator({
        message: 'This value is not valid',
        live: 'disabled',
        submitHandler: function(validator, form) {
        
        loading('...updating', 1);
            
            $.ajax({
                data: $('#microContent').serialize(),
                type: "POST",
                url: "/users/micro", 
                contentType: "application/x-www-form-urlencoded; iso-8859-7",
                dataType: 'json',
                success: function(data, status) {
                    
                    $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
                    
                    if(data.response){
						$('.alert').addClass(data.css).fadeIn(400).html(data.message);
                    }
                    	else
                    {
	                    $('.alert').addClass('alert-warning').fadeIn(400).html('<strong>Hmmm...</strong> Not sure what happened. Please try again or contact support.');

                    }
                    
              
                    unloading();
                }
                
               
            });
            
            return false;
        },
        fields: {           
            subdomain: {
                message: 'The subdomain is not valid',
                validators: {
                    notEmpty: {
                        message: 'The subdomain is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The subdomain must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The subdomain can only consist of alphabetical, number, dot and underscore'
                    }
                }
            }
        }
    });
    
     $('#microMeta').bootstrapValidator({
        message: 'This value is not valid',
        live: 'disabled',
        submitHandler: function(validator, form) {
        
        loading('...updating', 1);
            
            $.ajax({
                data: $('#microMeta').serialize(),
                type: "POST",
                url: "/users/micro", 
                contentType: "application/x-www-form-urlencoded; iso-8859-7",
                dataType: 'json',
                success: function(data, status) {
                    
                    $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
                    
                    if(data.response){
						$('.alert').addClass(data.css).fadeIn(400).html(data.message);
                    }
                    	else
                    {
	                    $('.alert').addClass('alert-warning').fadeIn(400).html('<strong>Hmmm...</strong> Not sure what happened. Please try again or contact support.');

                    }              
                    unloading();
                }
                
               
            });
            
            return false;
        },
        fields: {           
            subdomain: {
                message: 'The subdomain is not valid',
                validators: {
                    notEmpty: {
                        message: 'The subdomain is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The subdomain must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The subdomain can only consist of alphabetical, number, dot and underscore'
                    }
                }
            }
        }
    });
    
    
    
    $('#microPark').bootstrapValidator({
        message: 'This value is not valid',
        live: 'disabled',
        submitHandler: function(validator, form) {
        
        loading('...updating', 1);
            
            $.ajax({
                data: $('#microPark').serialize(),
                type: "POST",
                url: "/users/micro", 
                contentType: "application/x-www-form-urlencoded; iso-8859-7",
                dataType: 'json',
                success: function(data, status) {
                    
                    $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
                    
                    if(data.response==1){
						$('.alert').addClass(data.css).fadeIn(400).html(data.message);
                    }
                    
                     if(data.response==2){
						$('.alert').addClass(data.css).fadeIn(400).html(data.message);
                    }
                    
                    if(!data.response)
                    {
	                    $('.alert').addClass('alert-warning').fadeIn(400).html('<strong>Darn...</strong> Not sure what happened. Please try again or contact support.');
                    }					
                    
                    unloading();
                }
                
               
            });
            
            return false;
        },
                
        fields: {           
            domain: {
                message: 'The domain is not valid',
                validators: {
                    notEmpty: {
                        message: 'The domain is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 30,
                        message: 'The domain must be more than 4 and less than 30 characters long and be a valid domain.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The domain can only consist of alphabetical, number, dot and/or underscore'
                    }
                }
            }
        }
    });
    
    
    $('#microUnpark').bootstrapValidator({
        message: 'This value is not valid',
        live: 'disabled',
        submitHandler: function(validator, form) {
        
        loading('...updating', 1);
            
            $.ajax({
                data: $('#microUnpark').serialize(),
                type: "POST",
                url: "/users/micro", 
                contentType: "application/x-www-form-urlencoded; iso-8859-7",
                dataType: 'json',
                success: function(data, status) {
                    
                    $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
                    
                    if(data.response==1){
						$('.alert').addClass(data.css).fadeIn(400).html(data.message);
						
						$('#microUnpark').fadeOut(400, function() {
							$('#microPark').fadeIn(400);
						});
						 
						 //microUnpark
						 
						 //$('input#domain').removeAttr('disabled');
						 //$('input#domain').val('');
                    }
                    
                     if(data.response==2){
						$('.alert').addClass(data.css).fadeIn(400).html(data.message);
                    }
                    
                    if(!data.response)
                    {
	                    $('.alert').addClass('alert-warning').fadeIn(400).html('<strong>Darn...</strong> Not sure what happened. Please try again or contact support.');
                    }					
                    
                    unloading();
                }
                
               
            });
            
            return false;
        },
                
        fields: {           
            domain: {
                message: 'The domain is not valid',
                validators: {
                    notEmpty: {
                        message: 'The domain is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 30,
                        message: 'The domain must be more than 4 and less than 30 characters long and be a valid domain.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The domain can only consist of alphabetical, number, dot and/or underscore'
                    }
                }
            }
        }
    });    
});
//end $(document).ready()

function loading(t, e) { 
	$('body').append('<div id="form_overlay"></div><div id="updating">'+ t +'..</div>');
		if(e==1){
		  $('#form_overlay').css('opacity',0.4).fadeIn(400,function(){  $('#updating').fadeIn(400);	});
		  return  false;
	   }
	   
	$('#updating').fadeIn();	  
}

function unloading() { 
	
	setTimeout(function() {
		$('#updating').fadeOut(400,function(){ $('#form_overlay').fadeOut(); /**$.fancybox.close();**/ }).remove();
	}, 2000);
}

////User
function user_loading(t, e) { 
	$('.modal').append('<div id="u_form_overlay"></div><div id="updating">'+ t +'..</div>');
		if(e==1){
		  $('#u_form_overlay').css('opacity',0.4).fadeIn(400,function(){  $('#updating').fadeIn(400);	});
		  return  false;
	   }
	   
	$('#updating').fadeIn();	  
}

function user_unloading() { 
	
	setTimeout(function() {
		$('#updating').fadeOut(400,function(){ $('#u_form_overlay').fadeOut(); /**$.fancybox.close();**/ }).remove();
	}, 2000);
}