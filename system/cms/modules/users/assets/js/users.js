$( document ).ready(function() {
	
	$('.redactor_content').redactor({
		buttons: ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'table', 'link', 'alignment', 'horizontalrule'],
		cleanup: false,
		convertDivs: false
		//fileUpload: '../demo/scripts/file_upload.php',
		//imageGetJson: '../demo/json/data.json'
	});
	
	/*-----------------------------------------------
		CONVERT TABLES TO SORTBALE
	----------------------------------------------- */
	
	$('.href').click(function() {
        window.document.location = $(this).data("href");
    });

	
});



function loading(t, e) { 
	$('body').append('<div id="form_overlay"></div><div id="updating">'+ t +'..</div>');
		if(e==1){
		  $('#form_overlay').css('opacity',0.4).fadeIn(400,function(){  $('#updating').fadeIn(400);	});
		  return  false;
	   }
	   
	$('#updating').fadeIn();	  
}

function unloading() { 
	
	setTimeout(function() {
		$('#updating').fadeOut(400,function(){ $('#form_overlay').fadeOut(); /**$.fancybox.close();**/ }).remove();
	}, 2000);
}

////User
function user_loading(t, e) { 
	$('.modal').append('<div id="u_form_overlay"></div><div id="updating">'+ t +'..</div>');
		if(e==1){
		  $('#u_form_overlay').css('opacity',0.4).fadeIn(400,function(){  $('#updating').fadeIn(400);	});
		  return  false;
	   }
	   
	$('#updating').fadeIn();	  
}

function user_unloading() { 
	
	setTimeout(function() {
		$('#updating').fadeOut(400,function(){ $('#u_form_overlay').fadeOut(); /**$.fancybox.close();**/ }).remove();
	}, 2000);
}