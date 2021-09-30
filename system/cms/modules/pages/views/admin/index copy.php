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
			<div class="panel-heading">Content</div>
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
						
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#cards" aria-controls="cards" role="tab" data-toggle="tab" aria-expanded="true">Card Callouts</a></li>
							<li role="presentation"><a href="#section1" aria-controls="section1" role="tab" data-toggle="tab" aria-expanded="true">Section 1</a></li>
							<li role="presentation"><a href="#section2" aria-controls="section2" role="tab" data-toggle="tab" aria-expanded="true">Section 2</a></li>
						</ul>
						
						<div class="tab-content">
							
							<div role="tabpanel" class="tab-pane active" id="cards">
								<label for="left_card">Left Card</label>
								<textarea id="left_card" name="left_card" class="summernote">
									<?php if(isset($data->left_card)) echo $data->left_card; ?>
								</textarea>
								
								<label for="center_card">Center Card</label>
								<textarea id="center_card" name="center_card" class="summernote">
									<?php if(isset($data->center_card)) echo $data->center_card; ?>
								</textarea>
								
								<label for="right_card">Right Card</label>
								<textarea id="right_card" name="right_card" class="summernote">
									<?php if(isset($data->right_card)) echo $data->right_card; ?>
								</textarea>
								<div class="clearfix"></div>
							</div>
							
							<div role="tabpanel" class="tab-pane" id="section1">
								<div class="form-group">
									<label for="section1">Section 1</label>
									<textarea id="section1" name="section1" class="summernote">
										<?php if(isset($data->section1)) echo $data->section1; ?>
									</textarea>
								</div>
								<div class="clearfix"></div>
							</div>
							<div role="tabpanel" class="tab-pane" id="section2">
								<div class="form-group">
									<label for="section2">Section 2</label>
									<textarea id="section2" name="section2" class="summernote">
										<?php if(isset($data->section2)) echo $data->section2; ?>
									</textarea>
								</div>
								<div class="clearfix"></div>
							</div>
							
							
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