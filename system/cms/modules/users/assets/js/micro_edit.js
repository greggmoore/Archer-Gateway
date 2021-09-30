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
	
		var $validator = $("#microContent").validate({
		  rules: {

		    title: {
		      required: true,
		      minlength: 3
		    }
		  }
		});
	
	/**
	$('form').submit(function(e){
		e.preventDefault();
		loading('Please, stand by ...', 1);
		var form = this;
		
			$.ajax({
				url: "/users/micro_edit",
				data: $(form).serialize(),
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					 unloading();
					 $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
					if(data.response)
					{
						$('.alert').addClass(data.css).fadeIn(400).html(data.message);
					}
				}
			
			});
		
	});
	
	**/
	
	$('#microContent').bootstrapValidator({
    	message: 'This value is not valid',
		submitHandler: function(validator, form) {
        
		loading('Please, stand by ...', 1);
            
            $.ajax({
                data: $('#microContent').serialize(),
                type: "POST",
                url: "/users/micro_edit", 
                contentType: "application/x-www-form-urlencoded; iso-8859-7",
                dataType: 'json',
                success: function(data) {
                     $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
						if(data.response)
						{
							$('.alert').addClass(data.css).fadeIn(400).html(data.message);
						}
                }
               
            });
            return false;
            
	        },
	        fields: {
	            title: {
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
	            }
	            
	        }
	    });
});
//end $(document).ready()
