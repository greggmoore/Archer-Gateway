$(document).ready(function() {

  'use strict';

  	$('#dataTable').DataTable();
    
  
	$(document).on('click', '.remove', function (e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		var dataTitle = $(this).data('title');
		$('.modal-span-title').html( datatitle );
		$('.modal-footer button').attr('data-dataid', dataId);
	});
	
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		var id = $(this).data('dataid') ;
		
		$.ajax({
			url: '/admin/team/remove_category' ,
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
					      text: 'The team category has been removed from the database.' ,
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