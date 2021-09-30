$( document ).ready(function() {
	
	$('#program_success, #faq_success').hide();

	$('#title').keyup(function(){
		var id = $("input[name='id']").val(); 
		var original_uri = $("input[name='original_uri']").val(); 
		var uri = $('#title').val().replace(/ /g, '-').toLowerCase();
		$("small.x").text(uri);
		$("input[name='uri']").val(uri);
	   
	  
	  if(uri.length > 2)
	  {
		  $.ajax({
			url: '/admin/pages/check_uri' ,
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
				url: "/admin/pages/check_uri",
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
				url: "/admin/pages/edit",
				data: $(form).serialize(),
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					 unloading();
					if(data.response == 1)
					{
						
						if(data.is_program == 1)
						{
							$('#program_success').fadeIn(400);
							setTimeout(function(){
		                        location.reload();
		                    }, 3000); 
						}
						
						if(data.reload == 1)
						{
							location.reload();
						}
							else
						{
							$('#editFaq').modal('hide');
							$('#pending-status').fadeIn();
							$.gritter.add({
								title: 'SUCCESS!',
								text: data.response_txt ,
								class_name: 'with-icon thumbs-o-up primary'
					    	});
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
		
		var id = $('#remove-page').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/pages/remove' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
					window.location.href = "/admin/pages";
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
	
	
	$(document).on('click', '.btn-publish', function (e) {
		e.preventDefault();
		
		var id = $('#publish-page').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/pages/publish' ,
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
							title: 'SUCCESS! THE PAGE HAS BEEN PUBLISHED!',
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
	
	$(document).on('click', '#reset-status', function (e) {
		e.preventDefault();
		
		var id = $('#reset-status').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/pages/reset' ,
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
	
	/////////
	
	//Edit FAQ
	
	$(document).on('click', '.edit-faq', function (e) {
		e.preventDefault();
		var dataId = $(this).data('faqid');
		
		$.ajax({
			url: '/admin/faqs/get_faq' ,
			data: 'id=' + dataId,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{					
					$('#question').val(data.question);
					$("#answer.summernote").code(data.answer);
					$("#faq_staging_status").html(data.faq_staging_status);
				}
			}
		});

		//alert(dataAnswer);
		//$('#faq_id').attr('data-faqid', dataId);
		$('#edit_faq_id').val(dataId);
		//$("#answer.summernote").code(dataAnswer);
		//$('.modal-span-question').html( dataQuestion );
		//$('.modal-footer button').attr('data-faqid', dataId);
	});
	
	
	//Remove FAQ
	$(document).on('click', '.remove-faq', function (e) {
		e.preventDefault();
		var dataId = $(this).data('faqid');
		var dataQuestion = $(this).data('question');
		$('.modal-span-question').html( dataQuestion );
		$('.modal-footer button').attr('data-faqid', dataId);
	});
	
	
	$(document).on('click', '.modal-faq-confirm', function (e) {
		e.preventDefault();
		
		var id = $(this).data('faqid') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/faqs/remove' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
					location.reload();
					
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
	
	
	
	$('form#addFaq').submit(function(e){
		e.preventDefault();
		loading('Please, stand by ...', 1);
		var form = this;
			$.ajax({
				url: "/admin/pages/add_faq",
				data: $(form).serialize(),
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					 unloading();
					if(data.response == 1)
					{
						location.reload();
						
					}
						else
					{
						$('#addFaq').modal('hide');
							$('#pending-status').fadeIn();
							$.gritter.add({
								title: 'SUCCESS!',
								text: data.response_txt ,
								class_name: 'with-icon thumbs-o-up primary'
					    	});
					}
				}
			
			});
		
	});
	
	
	//Edit Program
	
	$(document).on('click', '.edit-program', function (e) {
		e.preventDefault();
		var dataId = $(this).data('programid');
		$.ajax({
			url: '/admin/pipeline/get_program' ,
			data: 'id=' + dataId,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{					
					
					$('#program_title').val(data.program.title);
					$('#program_subtitle').val(data.program.subtitle);
					$('#program_disease').val(data.program.disease);
					$("#program_content.summernote").code(data.program.content);
					$("#clinical_trials_content.summernote").code(data.program.clinical_trials_content);
					$("#clinical_data_content.summernote").code(data.program.clinical_data_content);
					$("#collaboration.summernote").code(data.program.collaboration);
					$("#colorscheme").html(data.program.color_scheme);
					$("#phase_dd").html(data.phase_dd);
					$("#color_scheme_dd").html(data.color_scheme_dd);
					$("#program_staging_status").html(data.program_staging_status);
					
				}
			}
		});

		$('#program_id').val(dataId);

	});
	
	
	$(document).on('click', '#publish-program', function (e) {
		e.preventDefault();
		
		var id = $('#publish-program').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/pipeline/publish_programs' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
						$('#program_staging_status').fadeOut();
						unloading();
						
						$.gritter.add({
							title: 'SUCCESS! THE PROGRAM HAS BEEN PUBLISHED!',
							text: data.response_txt ,
							class_name: 'with-icon thumbs-o-up primary'
				    	});
				    	
				    	location.reload();
				    	
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