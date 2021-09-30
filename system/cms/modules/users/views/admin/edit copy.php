<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/users"> User Manager</a></li>
			<li class="active">Edit > <?php if( isset($data->fullname) ) echo $data->fullname; ?></li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Main Account Info</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					
					<form id="formContent" class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="original_uri" value="<?php echo $data->uri; ?>" />
						<input type="hidden" name="original_username" value="<?php echo $data->username; ?>" />
						<input type="hidden" name="update" value="main_account_info" />
					
						<div class="form-group">
							<label for="title">First Name</label>
							<input id="first_name" type="text" name="first_name" placeholder="First Name" value="<?php if( isset($data->first_name) ) echo $data->first_name; ?>" class="form-control" data-error="First name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input id="last_name" type="text" name="last_name" placeholder="Last Name" value="<?php if( isset($data->last_name) ) echo $data->last_name; ?>" class="form-control" data-error="Last name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
	
						
						<div class="form-group">
							<label for="title">Uri</label>
							<input type="text" id="uri" class="form-control" name="uri" value="<?php echo (isset($_POST['uri']))?$_POST['uri']:$data->uri; ?>" />
							<span class="help-block x"><small class="xx"></small></span>
						</div>
						
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" id="email" class="form-control" name="email" value="<?php echo (isset($_POST['email']))?$_POST['email']:$data->email; ?>" data-error="Email can not be left empty." required />
							<span class="help-block x"><small class="xx"></small></span>
						</div>

									            
						<div class="form-group submit-row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary submit pull-right">Submit</button>
							</div>
						</div>
					</form>
						
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Phone(s)</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<form class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="update" value="phone_numbers" />
						<div class="form-group">
							<label for="telephone">Telephone</label>
							<input id="telephone" type="text" name="telephone" value="<?php if( isset($data->telephone) ) echo $data->telephone; ?>" class="form-control phone_us"  />
						</div>
						
						<div class="form-group">
							<label for="mobilephone">Mobile Phone</label>
							<input id="mobilephone" type="text" name="mobilephone" value="<?php if( isset($data->mobilephone) ) echo $data->mobilephone; ?>" class="form-control phone_us"  />
						</div>
	
						
						<div class="form-group submit-row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary submit pull-right">Submit</button>
							</div>
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Security</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<form class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="email" value="<?php echo $data->email; ?>" />
						<input type="hidden" name="update" value="security" />
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" type="password" name="password" data-toggle="validator" data-minlength="6" value="" class="form-control"  data-error="Password can not be left empty and a minimum of 6 characters." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="confirm_password">Confirm Password</label>
							<input id="confirm_password" type="password" name="confirm_password" value="" class="form-control"  data-match="#password" data-match-error="Password do not match." required />
							<div class="help-block with-errors"></div>
						</div>
	
						
						<div class="form-group submit-row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary submit pull-right">Submit</button>
							</div>
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Options</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<form class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="update" value="options" />
						
						<div class="form-group">
							<label for="groups" class="col-md-3">Groups</label>
							<?php if( isset( $groups ) ) echo $groups; ?>
						</div>
						
						<div class="form-group">
							<label for="active" class="col-md-3">Is Active</label>
							<input type="checkbox" id="active" value="1" class="js-switch" name="active" data-color="#5cb85c" <?php if(isset($data->active) && ($data->active == 1)) echo 'checked' ; ?> />
						</div>
						
						<div class="form-group submit-row with-border">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary submit pull-right">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
		<div class="panel-wrapper collapse in">
			<div class="panel-body">
				<button id="remove-user" type="submit" class="btn btn-danger submit pull-right" data-toggle="modal" data-target="#myModal" data-id="<?php echo $data->id; ?>">DELETE USER</button>
			</div>
		</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade animated" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Deleting: <?php if( isset($data->title) ) echo $data->title; ?></h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
		<p>Deleting the <strong><?php if( isset($data->title) ) echo $data->title; ?></strong> page will remove all related content from the database.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" data-dataid=""  class="btn btn-primary modal-confirm">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->