<?php if(isset($title)) echo '<h3>'.$title.'</h3>'; ?>
<div id="top">&nbsp;</div>

<div id="alert_message" class="alert" style="display: none;"></div>
<form id="optionsForm" class="form-horizontal" data-uri="options" role="form">
<input type="hidden" name="user" value="options" />

	<div class="form-group">
		<input type="checkbox" id="no_user_data_flow" class="col-sm-2" name="no_user_data_flow" value="1" style="margin-top: 10px;" <?php if(isset($user->no_user_data_flow) && $user->no_user_data_flow == 1) echo ' checked="checked"'; ?>>
		<div class="col-sm-10">
			<label for="no_user_data_flow" class="control-label">No User Data</label>
			<p class="help-block">If enabled, data will be sent regardless if visitor completes registration or not.</p>
		</div>
	</div>
	
	<hr />
	
	<div class="form-group">
		<input type="checkbox" class="col-sm-2" style="margin-top: 10px;" id="auto_responder" name="auto_responder" value="1" <?php if(isset($user->auto_responder) && $user->auto_responder == 1) echo ' checked="checked"' ; ?>>
		<div class="col-sm-10">
			<label for="auto_responder" class="control-label">Enable Auto Responder</label>
			<p class="help-block">Personal or business profile. All about yourself!</p>
		</div>
	</div>
	
	<hr />
	
	<div class="form-group">
		<label for="auto_responder_message" class="control-label">Auto Responder Message</label>
		<textarea class="form-control redactor_content" id="auto_responder_message" name="auto_responder_message" rows="3"><?php if(isset($user->auto_responder_message)) echo $user->auto_responder_message ; ?></textarea>
		<p class="help-block">If enabled, visitor will receive an email upon completion of registration.</p>
	</div>
		
	<hr /> 
	
	<br />
	
	<div class="form-group">
		 <button type="submit" class="btn btn-block btn-primary">Update Options</button>
	</div>

  
</form>