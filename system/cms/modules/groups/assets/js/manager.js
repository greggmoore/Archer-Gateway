$(document).ready(function() {

  'use strict';
    
  
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
			url: '/admin/groups/remove' ,
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
						$.gritter.add({
				      title: 'SUCCESS!',
				      text: 'The page has been removed from the database.' ,
				      class_name: 'with-icon thumbs-o-up primary'
				    });
					});
				}
					else
				{
					$('#myModal').modal('hide');
						$.gritter.add({
				      title: 'ERROR!',
				      text: 'Please try again or contact support.' ,
				      class_name: 'with-icon question-circle danger'
				    });
				}
			}
		});
	});

});