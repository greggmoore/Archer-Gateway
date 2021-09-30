$( document ).ready(function() {
	$('#optionsForm').bootstrapValidator({
    	message: 'This value is not valid',
		submitHandler: function(validator, form) {
        
		loading('Please, stand by ...', 1);
            
            $.ajax({
                data: $('#optionsForm').serialize(),
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
	        fields: {}
	    });
});