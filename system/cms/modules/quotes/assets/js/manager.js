$(document).ready(function() {

  'use strict';

  
	$(document).on('click', '.remove', function (e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		var dataQuotee = $(this).data('quotee');
		$('.modal-span-quotee').html( dataQuotee );
		$('.modal-footer button').attr('data-dataid', dataId);
	});
	
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		var id = $(this).data('dataid') ;
		
		$.ajax({
			url: '/admin/quotes/remove' ,
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
					      text: 'The quote has been removed from the database.' ,
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
	
	$(document).on('click', '.modal-order', function (e) {
		e.preventDefault();
		
		
		loading('Please, stand by ...', 1);
		$.ajax({
			url: '/admin/quotes/publish_order' ,
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
	
	$('#quoteItems').tableDnD({
    	onDrop: function(table, row) {

	    $('.order_result').load('/admin/quotes/sort_order?'+$.tableDnD.serialize());
			
			$.gritter.add({
		      title: 'SUCCESS!',
		      text: 'The order of the quotes has been set.' ,
		      class_name: 'with-icon thumbs-o-up primary'
		    });
			
			
			window.location.href = "/admin/quotes" ;
			
        }     
    });

});