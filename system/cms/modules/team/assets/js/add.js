$( document ).ready(function() {
	$('.summernote').summernote({
        height: 350,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false                 // set focus to editable area after initializing summernote
    });
    
	$(".select2").select2();
	
	/**	 
	$('#first_name, #last_name').keyup(function(){
		
		var first = $("input[name='first_name']").val().toLowerCase();
		var last = $("input[name='last_name']").val().toLowerCase(); 
		
		var uri = first + '-' + last.replace(/[^a-z0-9\s]/gi, '-').replace(/ /g, '-').toLowerCase().toLowerCase();
		
		$("small.x").text(uri);
		$("input[name='uri']").val(uri);
	   
	  
	  if(uri.length > 2)
	  {
		  $.ajax({
			url: '/admin/team/check_uri' ,
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
				url: "/admin/team/check_uri",
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
	
	**/

	
	$('form').submit(function(e){
		e.preventDefault();
		loading('Please, stand by ...', 1);
		var form = this;
			$.ajax({
				url: "/admin/team/add",
				data: $(form).serialize(),
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					 
					if(data.response == 1)
					{
						window.location.href = "/admin/team/";
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
	
	$('#photo').uploadifive({		
		
		'buttonClass'  : 'muploader',
		'buttonText'   : '<i class="fa fa-photo"></i> Add Photo',
		'multi'        : false,
		'width'        : 130,
		'multi'        : false,
		'lineHeight'	: 18 ,
		'formData'		: {},
		'uploadScript' : '/admin/team/add_photo',
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
			    	$("input[name='photo']").val(json.response_filename);
			    				    	
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