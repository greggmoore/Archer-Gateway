$( document ).ready(function() {

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
					url: '/team/get_modal' ,
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

	$(document).ready(function() {
    if(location.hash) {
        $('a[href=' + location.hash + ']').tab('show');
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on('popstate', function() {
    var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
    $('a[href=' + anchor + ']').tab('show');
});