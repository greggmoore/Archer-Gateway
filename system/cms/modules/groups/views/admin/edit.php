<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/groups"> Group Manager</a></li>
			<li class="active">Edit > <?php if( isset($title) ) echo $title; ?></li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Group Info</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					
					<form id="formContent" class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="original_uri" value="<?php if( isset($data->uri) ) echo $data->uri; ?>" />
						<input type="hidden" name="update" value="group_info" />
					
						<div class="form-group">
							<label for="name">Name</label>
							<input id="name" type="text" name="name" placeholder="Name" value="<?php if( isset($data->name) ) echo $data->name; ?>" class="form-control" data-error="Name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
					
						<div class="form-group">
							<label for="alt_name">Alt Name</label>
							<input id="alt_name" type="text" name="name" placeholder="Alt Name" value="<?php if( isset($data->alt_name) ) echo $data->alt_name; ?>" class="form-control" data-error="Name can not be left empty." required />
							<div class="help-block with-errors">(Long Name)</div>
						</div>
						
						<div class="form-group">
							<label for="description">Description</label>
							<input id="description" type="text" name="description" placeholder="Description" value="<?php if( isset($data->description) ) echo $data->description; ?>" class="form-control"  />
							<span class="help-block">
								<small>For reference only.</small>
							</span>
						</div>
						
						<div class="form-group">
							<label for="uri">Uri</label>
							<input id="uri" type="text" name="uri" placeholder="Uri" value="<?php if( isset($data->uri) ) echo $data->uri; ?>" class="form-control"  />
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
		<div class="panel-wrapper collapse in">
			<div class="panel-body">
				<button id="remove-group" type="submit" class="btn btn-danger submit pull-right" data-toggle="modal" data-target="#myModal" data-id="<?php echo $data->id; ?>">DELETE GROUP</button>
			</div>
		</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal bounceIn animated" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Deleting: <?php if( isset($data->alt_name) ) echo $data->alt_name; ?></h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
		<p>Deleting the <strong><?php if( isset($data->alt_name) ) echo $data->alt_name; ?></strong> group will remove all related content from the database.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" data-dataid=""  class="btn btn-primary modal-confirm">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

			