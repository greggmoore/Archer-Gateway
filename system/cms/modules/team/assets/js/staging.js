$( document ).ready(function() {
	
	/**
	var newURL = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;
	var pathArray = window.location.pathname.split( '/' );
	var memberUri = pathArray[3];
	
	if(memberUri.length > 0)
	{
		//e.preventDefault();
		   
			$.ajax({
				url: '/team/staging/get_modal_by_uri' ,
				data: 'memberUri=' + memberUri,
				cache: false,
				type: "POST",
				dataType: 'json',
				success: function(data){
					if(data.response == 1)
					{
						$('.modal-body').html( data.html );
						
						$('#teamModal').modal('show');
						
						//$('.modal-body').html( data.html );
					}
				}
			});
	}
	**/

	
	
	var url = document.location.toString();
	if (url.match('#')) {
	    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
	} 
	
	// Change hash for page-reload
	$('.nav-tabs a').on('shown.bs.tab', function (e) {
	    window.location.hash = e.target.hash;
	})
	
	
	$(function() {
	    function reposition() {
	        var modal = $(this),
	            dialog = modal.find('.modal-dialog');
				modal.css('display', 'block');
	        
	        // Dividing by two centers the modal exactly, but dividing by three 
	        // or four works better for larger screens.
	        //That's my theory and I'm sticking to it!
	        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
	    }
	    // Reposition when a modal is shown... weeeee!
	    $('.modal').on('show.bs.modal', reposition);
	    
	   
	    // Reposition when the window is resized, yahoo!
	    $(window).on('resize', function() {
	        $('.modal:visible').each(reposition);
	    });
	    
	    
	    
	    $(document).on('click', '.open-modal', function (e) {
			e.preventDefault();
		    var dataId = $(this).data('id');
			
			if(dataId > 0)
			{
				$.ajax({
					url: '/team/staging/get_modal' ,
					data: 'id=' + dataId,
					cache: false,
					type: "POST",
					dataType: 'json',
					success: function(data){
						if(data.response == 1)
						{
							$('.modal-body').html( data.html );
							
							$('#teamModal').modal('show');
							
							//$('.modal-body').html( data.html );
						}
					}
				});
			}

		});

	    
	});


});