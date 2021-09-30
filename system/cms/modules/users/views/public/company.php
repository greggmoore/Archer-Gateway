<?php if(isset($title)) echo '<h3>'.$title.'</h3>'; ?>
<div id="top">&nbsp;</div>

<div class="col-md-offset-2 alert" style="display: none;"></div>

<div id="alert_message" class="alert" style="display: none;"></div>
<form id="companyForm" data-uri="company" role="form">
<input type="hidden" name="user" value="company" />

	<div class="form-group">
		<label for="company_name">Company Name</label>
		<input type="text" class="form-control" id="company_name" name="company_name" value="<?php if(isset($user->company_name)) echo $user->company_name; ?>" placeholder="Company Name">
	</div>
	
	<div class="form-group">
		<label for="company_address">Address</label>
		<input type="text" class="form-control" id="company_address" name="company_address" value="<?php if(isset($user->company_address)) echo $user->company_address; ?>" placeholder="Company Address">
	</div>
	
	<div class="form-group">
		<label for="company_city">City</label>
		<input type="text" class="form-control" id="company_city" name="company_city" value="<?php if(isset($user->company_city)) echo $user->company_city; ?>" placeholder="Company City">
	</div>
	
	<div class="form-group">
		<label for="company_state">State</label>
		<input type="text" class="form-control" id="company_state" name="company_state" value="<?php if(isset($user->company_state)) echo $user->company_state; ?>" placeholder="Company State">
	</div>
	
	<div class="form-group">
		<label for="company_zipcode">Zip Code</label>
		<input type="text" class="form-control" id="company_zipcode" name="company_zipcode" value="<?php if(isset($user->company_zipcode)) echo $user->company_zipcode; ?>" placeholder="Company Zipcode">
	</div>
	
	<div class="form-group">
		<label for="company_phone">Company Phone</label>
		<input type="text" class="form-control phone_us" id="company_phone" name="company_phone" value="<?php if(isset($user->company_phone)) echo $user->company_phone; ?>" placeholder="Company Phone">
	</div>

	<div class="form-group">
		<label for="team_name">Team Name</label>
		<input type="text" class="form-control" id="team_name" name="team_name" value="<?php if(isset($user->team_name)) echo $user->team_name; ?>" placeholder="Team Name">
	</div>
	
	<br />
	
	<div class="form-group">
		 <button type="submit" class="btn btn-block btn-primary">Submit</button>
	</div>

  
</form>