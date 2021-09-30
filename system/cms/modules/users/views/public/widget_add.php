<div id="top" class="header-inner">
	<?php 
		if(isset($title)) echo $title; 
		if(isset($subtitle)) echo $subtitle;
	?>
</div>

<a id="return" href="/user/<?php echo $user->username ; ?>/widgets" class="btn btn-success btn-sm" >
  <span class="glyphicon glyphicon-chevron-left"></span> Return
</a>

<div class="col-md-offset-2 alert" style="display: none;"></div>


<form id="widgetAdd" class="form-horizontal" role="form">
<input type="hidden" name="widget" value="new" />
<input type="hidden" name="username" id="username" value="<?php echo $user->username ; ?>" />
  <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
    	<span class="help-block"></span>
    	<input type="text" class="form-control" id="description" name="description" value="" />
		<span class="help-block">Simple note to help organize your widgets.</span>
    </div>
  </div>
  
  <div class="form-group">
    <label for="origin" class="col-sm-2 control-label">Origin Url</label>
    <div class="col-sm-10">
    	<span class="help-block"></span>
    	<input type="text" class="form-control" id="origin" name="origin" value="" placeholder="http://www.mywebsite.com/mypage"/>
		<span class="help-block">Page URL where the widget will reside. Use this to help track where leads came from</span>
    </div>
  </div>

  
  <hr />
    
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
		<textarea class="form-contro redactor_content" id="title" name="title" rows="3"></textarea>
		<span class="help-block">Text that will appear as the title for the widget</span>
    </div>
  </div>

  
   <hr />
   
   
   <div class="form-group">
    <label for="btntxt" class="col-sm-2 control-label">Button Text</label>
    <div class="col-sm-10">
		<input type="text" class="form-control" id="btntxt" name="btntxt" value="" />
		<span class="help-block">Text that will appear within the button.</span>
    </div>
  </div>
  
  <div class="form-group">
  		<label for="btntxt" class="col-sm-2 control-label">Button<br />Text Color</label>
		<div class="col-sm-10">
			
			<input type="text" class="pick-a-color form-control" id="btncolor" name="btncolor" value="FFFFFF" />
			<span class="help-block">Color of button text.</span>
		</div>
	</div>
	
	
	<div class="form-group">
		<label for="btntxt" class="col-sm-2 control-label">Button Background</label>
		<div class="col-sm-10">
			<input type="text" class="pick-a-color form-control" id="btnbkg" name="btnbkg" value="004F9C" />
			<span class="help-block">Background color of button.</span>
		</div>
	</div>
  
  <hr />
   
  
  <div class="form-group">  
	  <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-block btn-primary">Submit</button>
	  </div>
  </div>
  
  <hr />
  
</form>
