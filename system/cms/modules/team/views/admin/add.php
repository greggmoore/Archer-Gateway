<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/team"> Team Manager</a></li>
			<li class="active">Add User</li>
		</ol>
	</div>
</div>


<form id="" class="form-material"  data-toggle="validator">
	<input type="hidden" name="add" value="add_member" />
	<input type="hidden" name="photo" value="" />
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Member Info</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
													
						<div class="form-group">
							<label for="title">First Name</label>
							<input id="first_name" type="text" name="first_name" placeholder="First Name" value="" class="form-control" data-error="First name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						
						<div class="form-group">
							<label for="middle_name">Middle Name</label>
							<input id="middle_name" type="text" name="middle_name" placeholder="Middle name" value="" class="form-control" />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input id="last_name" type="text" name="last_name" placeholder="Last Name" value="" class="form-control" data-error="Last name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="designation">Designation</label>
							<input id="designation" type="text" name="designation" placeholder="Designation" value="" class="form-control" />
							<span class="help-block">
								<small>e.g.: Dr, NMD, MD, Ph.D, etc..</small>
							</span>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="Title" value="" class="form-control" />
							<span class="help-block">
								<small>e.g.: President, CEO, Founder, Technician, etc...</small>
							</span>
							<div class="help-block with-errors"></div>
						</div>
	
						
						<div class="form-group">
							<label for="credentials">Credentials</label>
							<input id="credentials" type="text" name="credentials" placeholder="Credentials" value="" class="form-control" />
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
				<div class="panel-heading">Photo</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<span id="memberphoto"><p>upload photo to display</p></span>
							</div>
							<div class="col-md-6">
								<div class="form-group">
										<label for="photo">Update Photo</label>
										<input type="file" name="team_photo" id="photo" />
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Bio</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="form-group">
							<textarea id="bio" name="bio" class="summernote"></textarea>
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
							<?php if( isset( $category_checkbox ) ) echo $category_checkbox; ?>
						</div>
						<!--
						<div class="form-group">
							<label for="is_active" class="col-md-3">Is Active</label>
							<input type="checkbox" id="is_active" value="1" class="js-switch" name="is_active" data-color="#5cb85c" checked />
						</div>
						-->
				
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
					<button type="submit" class="btn btn-primary submit pull-right">ADD TEAM MEMBER</button>
				</div>
			</div>
			</div>
		</div>
	</div>

</form>
