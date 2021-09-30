
<div id="top" class="header-inner">
	<?php 
		if(isset($title)) echo $title; 
		if(isset($subtitle)) echo $subtitle;
	?>
</div>
<button class="btn btn-primary btn-sm addsub" data-toggle="modal" data-target="#addSub">
	<span class="glyphicon glyphicon-plus"></span> Add Sub Account
</button>
<div class="alert" style="display: none;"></div>
<?php if( isset( $alert ) ) echo $alert; ?>
<?php if( isset( $subaccounts ) ) echo $subaccounts; ?>

<!-- Begin: Add Sub Account -->
<div class="modal" id="addSub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Sub Account</h4>
      </div>
      <div class="modal-body">
      	<div id="sa_message" class="col-md-offset-2 alert" style="display: none;"></div>
        <form id="defaultForm" class="defaultForm form-horizontal" role="form">
        	<input type="hidden" name="user" value="add_sub_account" />
        	<div class="form-group">
			    <label for="first_name" class="col-sm-3 control-label">First Name</label>
			    <div class="col-sm-9">
			    	<input type="text" class="form-control" id="first_name" name="first_name" value="" />
					<span class="help-block">Enter first name of the user.</span>
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="last_name" class="col-sm-3 control-label">Last Name</label>
			    <div class="col-sm-9">
			    	<input type="text" class="form-control" id="last_name" name="last_name" value="" />
					<span class="help-block">Enter last name of the user.</span>
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="email" class="col-sm-3 control-label">Email</label>
			    <div class="col-sm-9">
			    	<span class="help-block emailmessage"></span>
			    	<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" />
					<span class="help-block">The email where the engagements will be delivered.</span>
			    </div>
			  </div>			 
			  			  
			  <div class="form-group">  
				  <div class="col-sm-offset-3 col-sm-9">
				      <button type="submit" class="btn btn-block btn-primary submit">Add Sub Account</button>
				  </div>
			  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default dismiss" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End: Add Sub Account -->