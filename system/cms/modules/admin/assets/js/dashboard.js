$(document).ready(function() {

  'use strict';
  
  $(document).on('click', '.publish-item', function (e) {
	  e.preventDefault();
	  var dataId = $(this).data('id');
	  var dataTitle = $(this).data('title');
	  var dataPath = $(this).data('path');
	  
	  $('.modal-span-title').html( dataTitle );
	  $('.modal-footer button').attr('data-dataid', dataId);
	  $('.modal-footer button').attr('data-path', dataPath);
	  
  });
  
  $(document).on('click', '.modal-confirm', function (e) {
	  e.preventDefault();
		var dataId = $(this).data('dataid') ;
		var dataPath = $(this).data('path') ;
		//alert(id);
		if(dataId > 0)
		{
			loading('Please, stand by ...', 1);
			$.ajax({
				url: '/admin/' + dataPath + '/publish' ,
				data: 'id=' + dataId,
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					if(data.success == 1)
					{
							
							/**
								$('#'+ dataPath + '_' + dataId).fadeOut('slow', function(){
								$('#myPublishModal').modal('hide');	
							});
							
							**/
						
							unloading();
							
							$.gritter.add({
								title: 'SUCCESS!',
								text: data.response_txt ,
								class_name: 'with-icon thumbs-o-up primary'
					    	});
					    	
					    	window.location.href = "/admin" ;
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
		}
  	});
  	
  	 $(document).on('click', '.reset-item', function (e) {
		  e.preventDefault();
		  
		  var dataId = $(this).data('id');
		  var dataPath = $(this).data('path') ;
		  
		  loading('Please, stand by ...', 1);
		  
		  $.ajax({
			url: '/admin/' + dataPath + '/reset' ,
			data: 'id=' + dataId,
			cache: false,
			type: "POST",
			dataType: 'json',
			success: function(data){
				if(data.success == 1)
				{
						unloading();
						
						$.gritter.add({
							title: 'SUCCESS!',
							text: data.response_txt ,
							class_name: 'with-icon thumbs-o-up primary'
				    	});
				    	
				    	window.location.href = "/admin" ;
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