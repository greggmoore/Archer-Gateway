$( document ).ready(function() {

	$(".select2").select2();
	$('.phone_us').mask('(000) 000-0000');
	 
	$('#first_name, #last_name').keyup(function(){
		var first = $("input[name='first_name']").val().toLowerCase();
		var last = $("input[name='last_name']").val().toLowerCase(); 
		
		
		var uri = first + '-' + last.replace(/[^a-z0-9\s]/gi, '-').replace(/ /g, '-').toLowerCase().toLowerCase();
		
		$("small.x").text(uri);
		$("input[name='uri']").val(uri);
	   
	  
	  if(uri.length > 2)
	  {
		  $.ajax({
			url: '/admin/users/check_uri' ,
			data: 'uri=' + uri ,
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
	  $("small.x").text(uri);
	  if(uri.length > 2)
	  {
		  	$.ajax({
				url: "/admin/users/check_uri",
				data: 'uri=' + uri,
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
				url: "/admin/users/add",
				data: $(form).serialize(),
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					 
					if(data.response == 1)
					{
						window.location.href = "/admin/users/edit/" + data.id;
					}
						else
					{
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
	
	
});