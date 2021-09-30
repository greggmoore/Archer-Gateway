

<div id="top" class="header-inner">
	<?php 
		if(isset($title)) echo $title; 
		if(isset($subtitle)) echo $subtitle;
	?>
	<a href="/user/sub_accounts" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
</div>

<div class="alert" style="display: none;"></div>

<form id="defaultForm" class="form-horizontal" role="form">
<input type="hidden" name="sa_id" value="<?php if(isset( $sa->sa_id )) echo $sa->sa_id; ?>" />
  <div class="form-group">
    <label for="first_name" class="col-sm-2 control-label">First Name</label>
    <div class="col-sm-10">
    	<input type="text" class="form-control" id="first_name" name="first_name" value="<?php if(isset($sa->first_name)) echo $sa->first_name ; ?>" />
		<span class="help-block">Enter first name of the user.</span>
    </div>
  </div>
  
  <div class="form-group">
    <label for="last_name" class="col-sm-2 control-label">Last Name</label>
    <div class="col-sm-10">
    	<input type="text" class="form-control" id="last_name" name="last_name" value="<?php if(isset($sa->last_name)) echo $sa->last_name ; ?>" />
		<span class="help-block">Enter last name of the user.</span>
    </div>
  </div>
  
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
    	<span class="help-block emailmessage"></span>
    	<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php if(isset($sa->email)) echo $sa->email ; ?>" />
		<span class="help-block">The email where the engagements will be delivered.</span>
    </div>
  </div>
  
 
  
  <hr />
  
  <div class="form-group">  
	  <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-block btn-primary">Submit</button>
	  </div>
  </div>

  
</form>