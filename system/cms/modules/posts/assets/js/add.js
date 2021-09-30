$( document ).ready(function() {
	
	$(".select2").select2();
	
	$('.summernote').summernote({
        height: 350,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false                 // set focus to editable area after initializing summernote
    });
    
    
    $('.datepicker-autoclose').datepicker({
        format: 'mm/dd/yyyy' ,
        autoclose: true,
        todayHighlight: true
      });
    
    var postForm = function() {
		var content = $('textarea[name="content"]').html($('#content').code());
	}
	
	
	$('#title').keyup(function(){
		var uri = $('#title').val().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
		$("small.x").text(uri);
		$("input[name='uri']").val(uri);
	   
	   var original_uri = '';
	  
	  if(uri.length > 1)
	  {
		  $.ajax({
			url: '/admin/posts/check_uri' ,
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
	
	$('form').submit(function(e){
		e.preventDefault();
		loading('Please, stand by ...', 1);
		var form = this;
			$.ajax({
				url: "/admin/posts/add",
				data: $(form).serialize(),
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					 
					if(data.response == 1)
					{
						window.location.href = "/admin/posts/edit/" + data.id;
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