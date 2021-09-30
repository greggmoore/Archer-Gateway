$( document ).ready(function() {

	
	 $(".select2").select2();
	 $('.phone_us').mask('(000) 000-0000');
	 $('#activezips div.checkbox:nth-child(odd)').addClass('alt');
	
	$('#first_name, #last_name').keyup(function(){
		var id = $("input[name='id']").val();
		var first = $("input[name='first_name']").val().toLowerCase();
		var last = $("input[name='last_name']").val().toLowerCase(); 
		
		
		var uri = first + '-' + last.replace(/[^a-z0-9\s]/gi, '-').replace(/ /g, '-').toLowerCase().toLowerCase();
		
		var original_uri = $("input[name='original_uri']").val(); 

		$("small.x").text(uri);
		$("input[name='uri']").val(uri);
	   
	  
	  if(uri.length > 2)
	  {
		  $.ajax({
			url: '/admin/users/check_uri' ,
			data: 'uri=' + uri + '&original_uri=' + original_uri ,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(response){
			
				if(response.response==0)
				{
					$('.btn').prop('disabled', true);
				}
					else
				{
					$('.btn').prop('disabled', false);
				}
				
				$('small.xx').fadeIn(200).html(response.html);
			}
			
		});
	  }
	  
	  
	});
		
	$('#uri').keyup(function(){
	  var text = $('#uri').val();
	  var uri = text.replace(/ /g, '-').toLowerCase() ;
	  var ou = $('input[name=original_uri]').val();
	  $("small.x").text(uri);
	  if(uri.length > 2)
	  {
		  	$.ajax({
				url: "/admin/users/check_uri",
				data: 'uri=' + uri + '&ou=' + ou,
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(response){
				
					if(response.response==0)
					{
						$('.btn').prop('disabled', true);
						//$('#uri').prop('readonly', true);
						$('#uri').addClass('has-error');
					}
					
					$('small.u_valid').fadeIn(200).html(response.html);
				}
			
			});
	  }
	});
	
	$('form').submit(function(e){
		e.preventDefault();
		loading('Please, stand by ...', 1);
		var form = this;
			$.ajax({
				url: "/admin/users/edit",
				data: $(form).serialize(),
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					 unloading();
					if(data.response == 1)
					{
						$.gritter.add({
							title: 'SUCCESS!',
							text: data.response_txt ,
							class_name: 'with-icon thumbs-o-up primary'
				    	});
				    	
				    	if(data.has_html == 1)
				    	{
					    	$('#activezips').fadeIn(400).html(data.html.html);
					    	$('span.count').fadeIn(400).html(data.html.count);
							$("textarea#zipcodes").val('')
				    	}
					}
						else
					{
						$.gritter.add({
					      title: 'ERROR!',
					      text: 'Your request was not processed. Please try again or contact support.' ,
					      class_name: 'with-icon question-circle danger'
					    });
					}
				}
			
			});
		
	});
	
	
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		
		var id = $('#remove-user').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/users/remove' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
					window.location.href = "/admin/users";
				}
					else
				{
					$('#myModal').modal('hide');
					unloading();
					$.gritter.add({
				      title: 'ERROR!',
				      text: 'Your request was not processed. Please try again or contact support.' ,
				      class_name: 'with-icon question-circle danger'
				    });
				}
			}
		});
	});
	
	
	 $(document).on('click', '.open-micro-edit', function (e) {
			e.preventDefault();
		    var microId = $(this).data('id');
			
			if(microId > 0)
			{
				$.ajax({
					url: '/admin/users/get_micro' ,
					data: 'id=' + microId,
					cache: false,
					type: "POST",
					dataType: 'json',
					success: function(data){
						if(data.response == 1)
						{
							
							$("#micro_title").val(data.data.title);
							$("#micro_content").val(data.data.content);
							
						}
					}
				});
			}

		});
	
	
});