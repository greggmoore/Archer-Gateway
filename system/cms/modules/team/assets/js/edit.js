$( document ).ready(function() {
	$('.summernote').summernote({
        height: 350,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false                 // set focus to editable area after initializing summernote
    });
	
	 $(".select2").select2();
	 
	$('#title').keyup(function(){
		var id = $("input[name='id']").val(); 
		var original_uri = $("input[name='original_uri']").val(); 
		var uri = $('#title').val().replace(/ /g, '-').toLowerCase();
		$("small.x").text(uri);
		$("input[name='uri']").val(uri);
	   
	  
	  if(uri.length > 2)
	  {
		  $.ajax({
			url: '/admin/team/check_uri' ,
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
				url: "/admin/team/check_uri",
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
				url: "/admin/team/edit",
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
	
	
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		
		var id = $('#remove-team').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/team/remove' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
					window.location.href = "/admin/team";
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
	
	var memberId = $('#photo').data('memberid');
	var memberUri = $('#photo').data('memberuri');
	
	$('#photo').uploadifive({		
		
		'buttonClass'  : 'muploader',
		'buttonText'   : '<i class="fa fa-photo"></i> Add Photo',
		'multi'        : false,
		'width'        : 130,
		'multi'        : false,
		'lineHeight'	: 18 ,
		'formData'		: {'id' : memberId , 'uri' : memberUri },
		'uploadScript' : '/admin/team/upload_photo',
		'onUploadComplete' : function(file, data) { 
				var json = $.parseJSON(data);
				if(json.response == 1)
				{
					
					$.gritter.add({
						title: 'SUCCESS!',
						text: json.response_txt ,
						class_name: 'with-icon thumbs-o-up primary'
			    	});
			    	
			    	$( '#memberphoto' ).html(json.response_img);
			    	setTimeout(function(){
	                        location.reload();
	                    }, 3000); 
			    	
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
	
	
	$(document).on('click', '.btn-publish', function (e) {
		e.preventDefault();
		
		var id = $('#publish-page').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/team/publish' ,
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
	
	$(document).on('click', '#reset-status', function (e) {
		e.preventDefault();
		
		var id = $('#reset-status').data('id') ;
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/team/reset' ,
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
	
});