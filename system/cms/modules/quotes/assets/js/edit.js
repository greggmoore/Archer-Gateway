$( document ).ready(function() {
	$('form').submit(function(e){
		e.preventDefault();
		loading('Please, stand by ...', 1);
		var form = this;
			$.ajax({
				url: "/admin/quotes/edit",
				data: $(form).serialize(),
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					 unloading();
					if(data.response == 1)
					{
						$('#pending-status').fadeIn();
						
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
	
	
	$(document).on('click', '.btn-publish', function (e) {
		e.preventDefault();
		
		var id = $('#publish-page').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/quotes/publish' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
						$('#myPublishModal').modal('hide');						
						$('#pending-status').fadeOut();
						unloading();
						
						$.gritter.add({
							title: 'SUCCESS!',
							text: data.response_txt ,
							class_name: 'with-icon thumbs-o-up primary'
				    	});
				}
					else
				{
					$('#myPublishModal').modal('hide');
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
	
	
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		
		var id = $('#remove-team').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/quotes/remove' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
					window.location.href = "/admin/quotes";
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
	
	
	$(document).on('click', '#reset-status', function (e) {
		e.preventDefault();
		
		var id = $('#reset-status').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/quotes/reset' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
						$('#pending-status').fadeOut();
						unloading();
						
						$.gritter.add({
							title: 'SUCCESS!',
							text: data.response_txt ,
							class_name: 'with-icon thumbs-o-up primary'
				    	});
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
	
	var quoteID = $('#photo').data('quoteid');
	
	$('#photo').uploadifive({		
		
		'buttonClass'  : 'muploader',
		'buttonText'   : '<i class="fa fa-photo"></i> Add Photo',
		'multi'        : false,
		'width'        : 130,
		'multi'        : false,
		'lineHeight'	: 18 ,
		'formData'		: {'id' : quoteID  },
		'uploadScript' : '/admin/quotes/upload_photo',
		'onUploadComplete' : function(file, data) { 
				var json = $.parseJSON(data);
				if(json.response == 1)
				{
					
					$.gritter.add({
						title: 'SUCCESS!',
						text: json.response_txt ,
						class_name: 'with-icon thumbs-o-up primary'
			    	});
			    	
			    	$( '#quotephoto' ).html(json.response_img);
			    	
			    	
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