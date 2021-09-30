$( document ).ready(function() {
	
	$('.redactor_content').redactor({
		buttons: ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'table', 'link', 'alignment', 'horizontalrule'],
		cleanup: false,
		convertDivs: false
		//fileUpload: '../demo/scripts/file_upload.php',
		//imageGetJson: '../demo/json/data.json'
	});
	
	/*-----------------------------------------------
		CONVERT TABLES TO SORTBALE
	----------------------------------------------- */


	$('#activezips div.checkbox:nth-child(odd)').addClass('alt');
	
	
	$('#zipAdd').submit(function(e){
		e.preventDefault();
		
		loading('Please, stand by ...', 1);
		
		var form = this;
		var uri = $(this).data('uri');
				
		
		$.ajax({
			url: "/users/zipcodes",
			data: $(form).serialize(),
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				 unloading();
				if(data.response == 1)
				{
					$('html, body').animate({ scrollTop: 0 }, 0);
					$('#activezips').fadeIn(400).html(data.html.html);
					$('span.count').fadeIn(400).html(data.html.count);
					$("textarea#zipcodes").val('')
					$('#alert_message').addClass(data.response_css).fadeIn(400).html(data.response_txt);					
				}
					else
				{
					$('html, body').animate({ scrollTop: 0 }, 0);
					$('#alert_message').addClass(data.response_css).fadeIn(400).html(data.response_txt);
				}
			}
		
		});
		
	});
	
	$('#zipRemove').submit(function(e){
		e.preventDefault();
		
		loading('Please, stand by ...', 1);
		
		var form = this;
		var uri = $(this).data('uri');
				
		
		$.ajax({
			url: "/users/zipcodes",
			data: $(form).serialize(),
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				 unloading();
				if(data.response == 1)
				{
					$('html, body').animate({ scrollTop: 0 }, 0);
					$('#activezips').fadeIn(400).html(data.html.html);
					$('span.count').fadeIn(400).html(data.html.count);
					$("textarea#zipcodes").val('')
					$('#alert_message').addClass(data.response_css).fadeIn(400).html(data.response_txt);					
				}
					else
				{
					$('html, body').animate({ scrollTop: 0 }, 0);
					$('#alert_message').addClass(data.response_css).fadeIn(400).html(data.response_txt);
				}
			}
		
		});
		
	});
	
});