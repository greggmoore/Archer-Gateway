<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/team"> Team Manager</a></li>
			<li><a href="/admin/team/categories"> Team Category Manager</a></li>
			<li class="active">Edit > <?php if( isset($title) ) echo $title; ?></li>
		</ol>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Category Info</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					
					<form id="formContent" class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="original_uri" value="<?php echo $data->uri; ?>" />
						<input type="hidden" name="update" value="category_info" />
					
						<div class="form-group">
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="Title" value="<?php if( isset($data->title) ) echo $data->title; ?>" class="form-control" data-error="Title name can not be left empty." required />
							<div class="help-block with-errors"></div>
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
				<button id="remove-category" type="submit" class="btn btn-danger submit pull-right" data-toggle="modal" data-target="#myModal" data-id="<?php echo $data->id; ?>">DELETE CATEGORY</button>
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
		<p>Deleting the team member of <strong><?php if( isset($data->fullname) ) echo $data->fullname; ?></strong> will remove all related content from the database.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" data-dataid=""  class="btn btn-primary modal-confirm">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->