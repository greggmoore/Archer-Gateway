$(document).ready(function() {
    
  
	$(document).on('click', '.remove', function (e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		
		
		var dataTitle = $(this).data('title');
		$('.modal-span-title').html( dataTitle );
		$('.modal-footer button').attr('data-dataid', dataId);
	});
	
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		var id = $(this).data('dataid') ;
		$.ajax({
			url: '/users/micro' ,
			data: 'id=' + id,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
					$("#row_"+id).fadeOut('slow', function(){
						$("#row_"+id).slideUp("slow");
						$('#myModal').modal('hide');
						
					});
				}
					else
				{
					$('#myModal').modal('hide');
						
				}
			}
		});
	});

});