$(document).ready(function() {

  'use strict';
  
  $('#memberItemsss').DataTable({
	  "iDisplayLength": 50 ,
	   "order": [[ 4, "desc" ]]
	
	});
    
    
	$(document).on('click', '.remove', function (e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		var dataFullname = $(this).data('fullname');
		$('.modal-span-title').html( dataFullname );
		$('.modal-footer button').attr('data-dataid', dataId);
	});
	
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		var id = $(this).data('dataid') ;
		
		$.ajax({
			url: '/admin/team/remove' ,
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
			url: '/admin/team/publish_team_order' ,
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
	
	
	
	$('#memberItems').tableDnD({
    	onDrop: function(table, row) {
			
			var catId = $('#memberItems').data('category');
			
	    	$('.order_result').load('/admin/team/sort_order?'+$.tableDnD.serialize());
	    	$('#pending-status').fadeIn();
			$.gritter.add({
			      title: 'SUCCESS!',
			      text: 'The order of the team has been set.' ,
			      class_name: 'with-icon thumbs-o-up primary'
		    });
		    
		    //window.location.href = "/admin/team/category/" + catId ;


        }
    });
    
    
    $(function(){
      // bind change event to select
      $('#category_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });

});