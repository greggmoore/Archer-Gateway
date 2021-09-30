<div id="top" class="header-inner">
	<?php 
		if(isset($title)) echo $title; 
	?>
</div>

<div id="top">&nbsp;</div>

<!--
<div class="col-md-offset-2 alert alert-warning">
	<p>You will have more options once the micro has been registered.</p>
</div>
-->

<div class="alert" style="display: none;"></div>


<form id="microAdd" role="form">
<input type="hidden" name="micro" value="add" />

  	<div class="form-group">
	  	<label for="subdomain" class="control-label">Subdomain</label>
	  	<span class="help-block urimessage"></span>
    	<input type="text" class="form-control" id="subdomain" name="subdomain" value="" />
		<span class="help-block uri">https://<b>yoursubdomain</b>.<?php echo SITE_DOMAIN; ?></span>
  	</div>
  	
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" class="form-control" id="title" name="title" placeholder="Title" value="" />
	<!--<span class="help-block">Content that will appear <strong>above</strong> the search field</span-->
	</div>


  		<div class="form-group">  
			  <button type="submit" class="btn sub-btn btn-primary pull-right">Submit</button>
		  </div>
    
</form>
