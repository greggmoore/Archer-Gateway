$( document ).ready(function() {
	
	$('.redactor_content').redactor({
		buttons: ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'table', 'link', 'alignment', 'horizontalrule'],
		cleanup: false,
		convertDivs: false
		//fileUpload: '../demo/scripts/file_upload.php',
		//imageGetJson: '../demo/json/data.json'
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
	
	
	$('#microAdd').bootstrapValidator({
		
		alert('hello');
		
    	message: 'This value is not valid',
		submitHandler: function(validator, form) {
        
		loading('Please, stand by ...', 1);
            
            $.ajax({
                data: $('#microAdd').serialize(),
                type: "POST",
                url: "/users/micro_add", 
                contentType: "application/x-www-form-urlencoded; iso-8859-7",
                dataType: 'json',
                success: function(data) {
                     $('html,body').animate({scrollTop: $('#top').offset().top}, 800);
						if(data.response == 0)
						{
							$('.alert').addClass(data.css).fadeIn(400).html(data.message);
						}
						
						if(data.response == 1)
						{
							window.location.href = '/users/micro';
							
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