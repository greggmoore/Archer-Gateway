<?php
	
?>


<div class="row bg-title">
	<div class="col-md-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-md-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/pages"> Page Manager</a></li>
			<li class="active"><?php echo $data->title; ?></li>
		</ol>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Main Content</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					
					<form id="formContent" class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="original_uri" value="<?php echo $data->uri; ?>" />
						<input type="hidden" name="update" value="content" />

						<div class="form-group">
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="Title" value="<?php if( isset($data->title) ) echo $data->title; ?>" class="form-control title" data-error="Title can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						

						<div class="form-group">
							<label for="content">Content</label>
							<textarea id="content" name="content" class="summernote">
								<?php if(isset($data->content)) echo $data->content; ?>
							</textarea>
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
			<div class="panel-heading">Meta Info</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<form class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $this->uri->segment(4); ?>" />
						<input type="hidden" name="update" value="meta_info" />
						<div class="form-group">
							<label for="meta_title">Site/Meta Title</label>
							<input id="meta_title" type="text" name="meta_title" value="<?php if( isset($data->meta_title) ) echo $data->meta_title; ?>" class="form-control"  />
						</div>
						
						<div class="form-group">
							<label for="meta_description">Meta Description</label>
							<input id="meta_description" type="text" name="meta_description" value="<?php if( isset($data->meta_description) ) echo $data->meta_description; ?>" class="form-control"  />
						</div>
						
						<div class="form-group">
							<label for="meta_keywords">Meta Keywords</label>
							<input id="meta_keywords" type="text" name="meta_keywords" value="<?php if( isset($data->meta_keywords) ) echo $data->meta_keywords; ?>" class="form-control"  />
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
						<input type="hidden" name="id" value="<?php echo $this->uri->segment(4); ?>" />
						<input type="hidden" name="update" value="options" />
						<div class="form-group">
							<label for="is_active" class="col-md-3">Is Active</label>
							<input type="checkbox" id="is_active" value="1" class="js-switch" name="is_active" data-color="#5cb85c" <?php if(isset($data->is_active) && ($data->is_active == 1)) echo 'checked' ; ?> />
						</div>
						
						<div class="form-group">
							<label for="is_restricted" class="col-md-3">Is Restricted</label>
							<input type="checkbox" id="is_restricted" value="1" class="js-switch" name="is_restricted" data-color="#5cb85c" <?php if(isset($data->is_restricted) && ($data->is_restricted == 1)) echo 'checked' ; ?> />
						</div>
						
						<div class="form-group">
							<label for="display_title" class="col-md-3">Display Title</label>
							<input type="checkbox" id="display_title" value="1" class="js-switch" name="display_title" data-color="#5cb85c" <?php if(isset($data->display_title) && ($data->display_title == 1)) echo 'checked' ; ?> />
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



<!-- Delete page Modal -->
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
        <button type="button" data-dataid="<?php echo $data->id; ?>"  class="btn btn-primary modal-confirm">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->


<!-- Publish page Modal -->
<div class="modal fade animated" id="myPublishModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Publish: <?php if( isset($data->title) ) echo $data->title; ?></h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
		<p>This will update the live page of <strong><?php if( isset($data->title) ) echo $data->title; ?></strong> with the current changes.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" data-dataid="<?php echo $data->id; ?>"  class="btn btn-primary btn-publish">Confirm</button>
      </div>
    </div>
  </div>
</div><!-- modal -->