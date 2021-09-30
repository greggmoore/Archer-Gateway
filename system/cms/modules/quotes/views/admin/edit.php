<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/community/edit/community">Be a Part of The Team</a></li>
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
		<a class="btn btn-warning" rel="external" href="/staging/pages/community#quotes">REVIEW</a>
		<a id="publish-page" class="btn btn-success" href="#myPublishModal" data-toggle="modal" data-title="<?php echo $data->title; ?>" data-target="#myPublishModal" data-id="<?php echo $data->id; ?>" >PUBLISH</a>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					
					<form id="formContent" class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="update" value="quote_info" />
					
						<div class="form-group">
							<label for="quotee">Author</label>
							<input id="quotee" type="text" name="quotee" placeholder="Author" value="<?php if( isset($data->quotee) ) echo $data->quotee; ?>" class="form-control" data-error="Author can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label for="first_name">Quote</label>
							<textarea id="quote" name="quote" class="summernote">
								<?php if(isset($data->quote)) echo $data->quote; ?>
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
			<div class="panel-heading">Photo</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<?php if(!empty($data->photo)): ?>
								<span id="quotephoto">
									<img src="/data/quotes/<?php echo $data->photo; ?>" class="img-repsonsive" />
								</span>
							<?php else: ?>
								<span id="quotephoto"><p>no photo to display</p></span>
							<?php endif; ?>
						</div>
						<div class="col-md-6">
							<form class="form-material" >
								<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
								<input type="hidden" name="uri" value="<?php if(isset($data->uri)) echo $data->uri; ?>" />
								<input type="hidden" name="update" value="photo" />
								
								<div class="form-group">
									<label for="photo">Update Photo</label>
									<input type="file" name="photo" id="photo" data-quoteid="<?php echo $data->id; ?>"  />
								</div>
								
							</form>
						</div>
					</div>
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


<!-- Modal -->
<div class="modal fade animated" id="myPublishModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Publish Quote of: <?php if( isset($data->quotee) ) echo $data->quotee; ?></h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
		<p>This will update the live quote of <strong><?php if( isset($data->quotee) ) echo $data->quotee; ?></strong> with the current changes.</p>
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