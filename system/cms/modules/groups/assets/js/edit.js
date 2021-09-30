$( document ).ready(function() {

	
	$('#name').keyup(function(){
		var id = $("input[name='id']").val(); 
		var original_uri = $("input[name='original_uri']").val(); 
		var uri = $('#name').val().replace(/ /g, '-').toLowerCase();
		$("small.x").text(uri);
		$("input[name='uri']").val(uri);
	   
	  
	  if(uri.length > 2)
	  {
		  $.ajax({
			url: '/admin/groups/check_uri' ,
			data: 'uri=' + uri + '&ou=' + original_uri ,
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
				
				$('small.u_valid').fadeIn(200).html(response.html);
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
				url: "/admin/groups/check_uri",
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
				url: "/admin/groups/edit",
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
		
		var id = $('#remove-group').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/groups/remove' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
					window.location.href = "/admin/groups";
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
	
	
});