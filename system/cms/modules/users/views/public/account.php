<?php if(isset($title)) echo '<h3>'.$title.'</h3>'; ?>

<div id="top">&nbsp;</div>

<div id="alert_message" class="alert" style="display: none;"></div>
<form id="accountForm" data-uri="account" role="form">
<input type="hidden" name="user" value="account" />

	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" class="form-control" id="first_name" name="first_name" value="<?php if(isset($user->first_name)) echo $user->first_name; ?>" placeholder="First Name">
	</div>
	
	<div class="form-group">
		<label for="last_name">First Name</label>
		<input type="text" class="form-control" id="last_name" name="last_name" value="<?php if(isset($user->last_name)) echo $user->last_name; ?>" placeholder="Last Name">
	</div>
	
	
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" value="<?php if(isset($user->email)) echo $user->email; ?>" placeholder="Email">
	</div>
	
	
	<div class="form-group">
		<label for="telephone">Telephone</label>
		<input type="text" class="form-control phone_us" id="telephone" name="telephone" value="<?php if(isset($user->telephone)) echo $user->telephone; ?>" placeholder="Telephone">
	</div>
	
	<div class="form-group">
		<label for="mobilephone">Mobile Phone</label>
		<input type="text" class="form-control phone_us" id="mobilephone" name="mobilephone" value="<?php if(isset($user->mobilephone)) echo $user->mobilephone; ?>" placeholder="Mobile Phone">
	</div>
	
	
	<div class="form-group">
		<label for="bio">Bio</label>
		<textarea class="form-control redactor_content" id="bio" name="bio" rows="3"><?php if(isset($user->bio)) echo $user->bio ; ?></textarea>
	</div>
	
	<br />
	
	<div class="form-group">
		 <button type="submit" class="btn btn-block btn-primary">Submit</button>
	</div>

  
</form>