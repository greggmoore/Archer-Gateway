<?php if(isset($title)) echo '<h3>'.$title.'</h3>'; ?>
<div id="top">&nbsp;</div>
<div class="col-md-offset-2 alert" style="display: none;"></div>

<div id="message" style="display: none;"></div>
<form id="passwordForm" data-uri="password" role="form">
<input type="hidden" name="user" value="update_password" />

	<div class="form-group">
		<label for="current_password">Current Password</label>
		<input type="password" class="form-control" id="current_password" name="current_password" value="<?php if(isset($user->password)) echo $user->password; ?>" placeholder="Current Password">
	</div>
	
	<div class="form-group">
		<label for="new_password">New Password</label>
		<input type="password" class="form-control" id="new_password"  name="new_password" placeholder="New Password">
	</div>
	
	
	<div class="form-group">
		<label for="verify_password">Re-type New Password</label>
		<input type="password" class="form-control" id="verify_password" name="verify_password" placeholder="Re-type New Password">
	</div>
	
	
	<br />
	
	<div class="form-group">
		 <button type="submit" class="btn btn-block btn-primary">Submit</button>
	</div>

  
</form>