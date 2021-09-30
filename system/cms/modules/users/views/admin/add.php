<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/users"> User Manager</a></li>
			<li class="active">Add User</li>
		</ol>
	</div>
</div>
<form class="form-material"  data-toggle="validator">
	<input type="hidden" name="add" value="add_user" />
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Main Account Info</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
													
						<div class="form-group">
							<label for="title">First Name</label>
							<input id="first_name" type="text" name="first_name" placeholder="First Name" value="" class="form-control" data-error="First name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input id="last_name" type="text" name="last_name" placeholder="Last Name" value="" class="form-control" data-error="Last name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
	
						
						<div class="form-group">
							<label for="title">Uri</label>
							<input type="text" id="uri" class="form-control" name="uri" value="" />
							<span class="help-block x"><small class="xx"></small></span>
						</div>
						
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" id="email" class="form-control" name="email" value="" data-error="Email can not be left empty." required />
							<span class="help-block x"><small class="xx"></small></span>
						</div>

	
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
						<div class="form-group">
							<label for="phone">Telephone</label>
							<input id="phone" type="text" name="phone" value="" class="form-control phone_us"  />
						</div>
						
						<div class="form-group">
							<label for="mobile">Mobile Phone</label>
							<input id="mobile" type="text" name="mobile" value="" class="form-control phone_us"  />
						</div>
	
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
			
						<div class="form-group">
							<label for="groups" class="col-md-3">Groups</label>
							<?php if( isset( $groups ) ) echo $groups; ?>
						</div>
						
						<div class="form-group">
							<label for="is_active" class="col-md-3">Is Active</label>
							<input type="checkbox" id="is_active" value="1" class="js-switch" name="is_active" data-color="#5cb85c" checked />
						</div>
				
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
					<button type="submit" class="btn btn-primary submit pull-right">ADD USER</button>
				</div>
			</div>
			</div>
		</div>
	</div>

</form>