<div id="top">&nbsp;</div>

<div class="row">
	<div class="col-md-6">
		<?php 
			if(isset($title)) echo $title; 
		?>
	</div>
	<div class="col-md-6">
		<a id="add" href="/users/micro_add" class="btn btn-success btn-sm pull-right" >
			<span class="glyphicon glyphicon-plus"></span> Add
		</a>
	</div>
</div>
	



<?php if($this->uri->segment(3) == 'success'): ?>
<div class="col-md-12 alert alert-success">
	<p>Success! Your micro has been created.</p>
</div>
<?php endif; ?>

<div id="top" class="col-md-12  alert" style="display: none;"></div>


<!-- Nav tabs -->
<ul class="nav nav-tabs micro">
  <li class="active"><a href="#tsubdomain" data-toggle="tab">Subdomain</a></li>
  <li><a href="#tcontent" data-toggle="tab">Content</a></li>
  <li><a href="#tbackground" data-toggle="tab">Background</a></li>
  <li><a href="#tmeta" data-toggle="tab">Meta</a></li>
  <li><a href="#tparked" data-toggle="tab">Parked Domain</a></li>
  <li><a href="#ttracking" data-toggle="tab">Tracking Code(s)</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="tsubdomain">
	  <form id="microSubdomain" role="form">
		  <input type="hidden" name="micro" value="subdomain" />
		  <input type="hidden" name="id" value="<?php if(isset($micro->id))echo $micro->id; ?>" />
		  
		  <div class="form-group">
		    <span class="help-block urimessage"></span>
		    <label for="subdomain">Subdomain</label>
		    <input type="text" class="form-control" id="subdomain" name="subdomain" placeholder="Subdomain" value="<?php if(isset($micro->subdomain)) echo $micro->subdomain ; ?>" />
			<span class="help-block uri">https://<b><?php echo isset($micro->subdomain) ?  $micro->subdomain : 'mysubdomain' ; ?></b>.<?php echo SITE_DOMAIN; ?></span>
		  </div>
		  
		  <div class="form-group">  
			  <button type="submit" class="btn sub-btn btn-primary pull-right">Submit</button>
		  </div>
  
	  </form>
  </div>
  <div class="tab-pane" id="tcontent">
	  <form id="microContent" class="form-horizontal" role="form">
		  <input type="hidden" name="micro" value="content" />
		  <input type="hidden" name="id" value="<?php if(isset($micro->id))echo $micro->id; ?>" />
		   
		   <div class="form-group">
		    <label for="title">Title</label>
		    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php if(isset($micro->title)) echo $micro->title ; ?>" />
			<!--<span class="help-block">Content that will appear <strong>above</strong> the search field</span-->
		  </div>
		  
		  <div class="form-group">
		    <label for="content">Content</label>
			<textarea class="form-control redactor_content" id="content" name="content" rows="3"><?php if(isset($micro->content)) echo $micro->content ; ?></textarea>
			<!--<span class="help-block">Content that will appear <strong>below</strong> the search field</span>-->
		  </div>
		  <div class="form-group">  
			  <button type="submit" class="btn btn-primary pull-right">Submit</button>
		  </div>
	  </form>
  </div>
  
  <div class="tab-pane" id="tbackground">
	  <form id="microContent" class="form-horizontal" role="form">
		  <input type="hidden" name="micro" value="content" />
		  <input type="hidden" name="id" value="<?php if(isset($micro->id))echo $micro->id; ?>" />

			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">Browse</label>
				<input id="file_upload" name="file_upload" type="file" multiple="false" />
				<span class="help-block">The background image for the micro site.</span>
			</div>
	  </form>
	  
	  
	  <div class="row">
		  <div class="col-md-12">
		  	<div class="ms-photo">
		  		<?php if(isset($micro->background)) echo '<img class="img-responsive" src="/data/uploads/'.$micro->background.'" />'; ?>
		  	</div>
	  	</div>
	  </div>
  </div>
  
  <div class="tab-pane" id="tmeta">
	  <form id="microMeta" class="form-horizontal" role="form">
		  <input type="hidden" name="micro" value="meta" />
		  <input type="hidden" name="id" value="<?php if(isset($micro->id))echo $micro->id; ?>" />
		  <div class="form-group">
		    <label for="meta_title" class="col-sm-2 control-label">Meta Title</label>
		    <div class="col-sm-10">
				<textarea class="form-control" id="meta_title" name="meta_title" rows="3"><?php if(isset($micro->meta_title)) echo $micro->meta_title ; ?></textarea>
				<span class="help-block">Content that will appear <strong>above</strong> the search field</span>
		    </div>
		  </div>
		  
		   <div class="form-group">
		    <label for="meta_description" class="col-sm-2 control-label">Description</label>
		    <div class="col-sm-10">
				<textarea class="form-control" id="meta_description" name="meta_description" rows="3"><?php if(isset($micro->meta_description)) echo $micro->meta_description ; ?></textarea>
				<span class="help-block">Content that will appear <strong>below</strong> the search field</span>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="meta_keywords" class="col-sm-2 control-label">Keywords</label>
		    <div class="col-sm-10">
				<textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3"><?php if(isset($micro->meta_keywords)) echo $micro->meta_keywords ; ?></textarea>
				<span class="help-block">Content that will appear <strong>below</strong> the search field</span>
		    </div>
		  </div>
		  
		  <div class="form-group">  
			  <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-block btn-primary">Submit</button>
			  </div>
		  </div>
	  </form>
  </div>
  <div class="tab-pane" id="tparked">
  
  	
	
  <?php if(empty($micro->domain)): ?>
  	
	<div class="col-md-offset-2 alert alert-warning">
		<p style="font-size: 11px;">Please use the following nameservers when pointing your domain to our servers.</p>
		<p style="font-size: 12px;">NS1.MYROCKETLISTING.COM<br />NS2.MYROCKETLISTING.COM</p>
	</div>
  
   <form id="microPark" class="form-horizontal" role="form">
	  <input type="hidden" name="micro" value="parkdomain" />
	  <input type="hidden" name="id" value="<?php if(isset($micro->id))echo $micro->id; ?>" />
	  <div class="form-group">
	    <label for="domain" class="col-sm-2 control-label">Park Domain</label>
	    <div class="col-sm-10">
	    	<span class="help-block durimessage"></span>
	    	<input type="text" class="form-control" id="domain" name="domain" value="<?php if(isset($micro->domain)) echo $micro->domain ; ?>" />
			<span class="help-block">You have the option to register &amp; park a domain within the system. <strong>Limit 1</strong></span>
	    </div>
	  </div>
	 

	  <div class="form-group">  
		  <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-block btn-primary">Park Domain</button>
		  </div>
	  </div>
  </form>
   <?php else: ?>
	
	<form id="microUnpark" class="form-horizontal" role="form">
	  <input type="hidden" name="micro" value="unpark" />
	  <input type="hidden" name="domain" value="<?php if(isset($micro->domain)) echo $micro->domain ; ?>" />
	  <input type="hidden" name="id" value="<?php if(isset($micro->id))echo $micro->id; ?>" />
	  <div class="form-group">
	    <label for="domain" class="col-sm-2 control-label">Domain</label>
	    <div class="col-sm-10">
	    	<span class="help-block durimessage"></span>
	    	<input type="text" class="form-control" id="domain" name="domain" value="<?php if(isset($micro->domain)) echo $micro->domain ; ?>" disabled/>
			<span class="help-block">One parked domain per account.</span>
	    </div>
	  </div>
	 

	  <div class="form-group">  
		  <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-block btn-primary">Unpark Domain</button>
		  </div>
	  </div>
  </form>
  
  
   <form id="microPark" class="form-horizontal" role="form" style="display: none;">
	  <input type="hidden" name="micro" value="parkdomain" />
	  <input type="hidden" name="id" value="<?php if(isset($micro->id))echo $micro->id; ?>" />
	  <div class="form-group">
	    <label for="domain" class="col-sm-2 control-label">Park Domain</label>
	    <div class="col-sm-10">
	    	<span class="help-block durimessage"></span>
	    	<input type="text" class="form-control" id="domain" name="domain" value="<?php if(isset($micro->domain)) echo $micro->domain ; ?>" />
			<span class="help-block">You have the option to register &amp; park a domain within the system. <strong>Limit 1</strong></span>
	    </div>
	  </div>
	 

	  <div class="form-group">  
		  <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-block btn-primary">Park Domain</button>
		  </div>
	  </div>
  </form>
  	  	
   <?php endif; ?>
  </div>
  
	<div class="tab-pane" id="ttracking">
		<form id="microTracking" class="form-horizontal" role="form">
		  <input type="hidden" name="micro" value="tracking_code" />
		  <input type="hidden" name="id" value="<?php if(isset($micro->id))echo $micro->id; ?>" />
		  
		  <div class="form-group">
		    <label for="ga_tracking" class="col-sm-2 control-label">Google Analytics</label>
		    <div class="col-sm-10">
				<textarea class="form-control" id="ga_tracking" name="ga_tracking" rows="6"><?php if(isset($micro->ga_tracking)) echo $micro->ga_tracking ; ?></textarea>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="gw_conversion" class="col-sm-2 control-label">Google Adwords</label>
		    <div class="col-sm-10">
				<textarea class="form-control" id="gw_conversion" name="gw_conversion" rows="6"><?php if(isset($micro->gw_conversion)) echo $micro->gw_conversion ; ?></textarea>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="fb_conversion" class="col-sm-2 control-label">Facebook</label>
		    <div class="col-sm-10">
				<textarea class="form-control" id="fb_conversion" name="fb_conversion" rows="6"><?php if(isset($micro->fb_conversion)) echo $micro->fb_conversion ; ?></textarea>
		    </div>
		  </div>
		  
		  <div class="form-group">  
			  <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-block btn-primary">Submit</button>
			  </div>
		  </div>
		  
		  
		</form>
		
		
	</div>
  	
</div>

