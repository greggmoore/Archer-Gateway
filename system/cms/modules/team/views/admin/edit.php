<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/team/index">Team</a></li>
			<li class="active"><?php if( isset($title) ) echo $title; ?></li>
		</ol>
	</div>
</div>

<div id="pending-status" class="row">
	<div class="col-md-10 col-xs-12">
		<div class="alert alert-info" role="alert">
			<p><i class="fa fa-exclamation-circle"></i> You have changes that are pending!</p>
		</div>
	</div>
	<div class="col-md-2 col-xs-12 moxie-btns">
		<a class="btn btn-warning" rel="external" href="/staging/about/leadership#<?php echo $data->uri; ?>">REVIEW</a>
		<a id="publish-page" class="btn btn-success" href="#myPublishModal" data-toggle="modal" data-title="<?php echo $data->title; ?>" data-target="#myPublishModal" data-id="<?php echo $data->id; ?>" >PUBLISH</a>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Name/Title</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<form class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="original_uri" value="<?php echo $data->uri; ?>" />
						<input type="hidden" name="update" value="name_title" />
						
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input id="first_name" type="text" name="first_name" placeholder="First Name" value="<?php if( isset($data->first_name) ) echo $data->first_name; ?>" class="form-control" data-error="First name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="middle_name">Middle Name</label>
							<input id="middle_name" type="text" name="middle_name" placeholder="Middle Name" value="<?php if( isset($data->middle_name) ) echo $data->middle_name; ?>" class="form-control" />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input id="last_name" type="text" name="last_name" placeholder="Last Name" value="<?php if( isset($data->last_name) ) echo $data->last_name; ?>" class="form-control" data-error="Last name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="designation">Designation</label>
							<input id="designation" type="text" name="designation" placeholder="Designation" value="<?php if( isset($data->designation) ) echo $data->designation; ?>" class="form-control"  />
							<span class="help-block">
								<small>e.g.: Dr, NMD, MD, Ph.D, etc..</small>
							</span>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="Title" value="<?php if( isset($data->title) ) echo $data->title; ?>" class="form-control"  />
							<span class="help-block">
								<small>e.g.: President, CEO, Founder, Technician, etc...</small>
							</span>
							<div class="help-block with-errors"></div>
							
						</div>
						
						
						
						
						
						<div class="form-group ">
							<div class="row">
								<div class="col-sm-12 submit-row">
									<ul class="pull-right help-block">
										<li class="">[ Submit each section individually ]</li>
										<li><button type="submit" class="btn btn-primary submit">Submit</button></li>
									</ul>
								</div>
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
			<div class="panel-heading">Credentials</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<form class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="update" value="credentials" />
						
						<div class="form-group">
							<textarea id="credentials" name="credentials" class="summernote">
								<?php if(isset($data->credentials)) echo $data->credentials; ?>
							</textarea>
						</div>
						
						<div class="col-sm-12 submit-row">
							<ul class="pull-right help-block">
								<li class="">[ Submit each section individually ]</li>
								<li><button type="submit" class="btn btn-primary submit">Submit</button></li>
							</ul>
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
			<div class="panel-heading">Bio</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<form class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="update" value="bio" />
						
						<div class="form-group">
							<textarea id="bio" name="bio" class="summernote">
								<?php if(isset($data->bio)) echo $data->bio; ?>
							</textarea>
						</div>
						
						<div class="col-sm-12 submit-row">
							<ul class="pull-right help-block">
								<li class="">[ Submit each section individually ]</li>
								<li><button type="submit" class="btn btn-primary submit">Submit</button></li>
							</ul>
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
			<div class="panel-heading">Photo</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<?php if(!empty($data->photo)): ?>
								<span id="memberphoto">
									<img src="/data/team/<?php echo $data->photo; ?>" class="img-repsonsive" />
								</span>
							<?php else: ?>
								<span id="memberphoto"><p>no photo to display</p></span>
							<?php endif; ?>
						</div>
						<div class="col-md-6">
							<form class="form-material" >
								<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
								<input type="hidden" name="uri" value="<?php if(isset($data->uri)) echo $data->uri; ?>" />
								<input type="hidden" name="update" value="photo" />
								
								<div class="form-group">
									<label for="photo">Update Photo</label>
									<input type="file" name="photo" id="photo" data-memberid="<?php echo $data->id; ?>" data-memberuri="<?php if(isset($data->uri)) echo $data->uri; ?>" />
								</div>
								
							</form>
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
			<div class="panel-heading">Categories</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<form class="form-material">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="update" value="options" />
						<div class="form-group">
							<?php if( isset( $category_checkbox ) ) echo $category_checkbox; ?>
						</div>
						<!--
						<div class="form-group">
							<label for="is_active" class="col-md-3">Is Active</label>
							<input type="checkbox" id="is_active" value="1" class="js-switch" name="is_active" data-color="#5cb85c" <?php if(isset($data->is_active) && ($data->is_active == 1)) echo 'checked' ; ?> />
						</div>
						-->

						<div class="col-sm-12 submit-row with-border">
							<ul class="pull-right help-block">
								<li class="">[ Submit each section individually ]</li>
								<li><button type="submit" class="btn btn-primary submit">Submit</button></li>
							</ul>
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
				<button id="remove-team" type="submit" class="btn btn-danger submit pull-right" data-toggle="modal" data-target="#myModal" data-id="<?php echo $data->id; ?>">DELETE MEMBER</button>
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
        <h3 class="modal-title" id="myModalLabel">Deleting: <?php if( isset($data->fullname) ) echo $data->fullname; ?></h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
		<p>Deleting the team member of <strong><?php if( isset($data->fullname) ) echo $data->fullname; ?></strong> will remove it from the databse.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" data-dataid=""  class="btn btn-primary modal-confirm">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->


<!-- Modal -->
<div class="modal fade animated" id="myPublishModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Publish: <?php if( isset($data->fullname) ) echo $data->fullname; ?></h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
		<p>This will update the live team member of <strong><?php if( isset($data->fullname) ) echo $data->fullname; ?></strong> with the current changes.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" data-dataid="<?php echo $data->id; ?>"  class="btn btn-primary btn-publish">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->



<?php if($data->status == 'live'): ?>
<script type="text/javascript">
	$('#pending-status').hide();
</script>
<?php endif; ?>