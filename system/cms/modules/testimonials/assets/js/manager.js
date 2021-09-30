$(document).ready(function() {

  'use strict';
  
  $('#memberItsssems').DataTable({
	  "iDisplayLength": 50 ,
	   "order": [[ 4, "desc" ]]
	
	});
    
    
	$(document).on('click', '.remove', function (e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		var dataCite = $(this).data('cite');
		$('.modal-span-cite').html( dataCite );
		$('.modal-footer button').attr('data-dataid', dataId);
	});
	
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		var id = $(this).data('dataid') ;
		
		$.ajax({
			url: '/admin/testimonials/remove' ,
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
					      text: 'The user has been removed from the database.' ,
					      class_name: 'with-icon thumbs-o-up primary'
					    });
					});
					
					window.setTimeout(function(){location.reload()},1000);
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
	
	
	$(document).on('click', '.modal-order', function (e) {
		e.preventDefault();
		
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/testimonials/publish_testimonials_order' ,
			data: 'publish_team_order=TRUE',
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
	
	
	
	$('#testimonialItems').tableDnD({
    	onDrop: function(table, row) {

	    	$('.order_result').load('/admin/testimonials/sort_order?'+$.tableDnD.serialize());
	    	//$('#pending-status').fadeIn();
			$.gritter.add({
			      title: 'SUCCESS!',
			      text: 'The order has been set.' ,
			      class_name: 'with-icon thumbs-o-up primary'
		    });
		    
		   // window.setTimeout(function(){location.reload()},2000);


        }
    });
    


});