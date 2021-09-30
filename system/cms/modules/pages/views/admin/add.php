<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/pages"> Page Manager</a></li>
			<li class="active">Add/Create Page</li>
		</ol>
	</div>
</div>
<form class="form-material"  data-toggle="validator">
	<input type="hidden" name="add" value="add_page" />
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Main Content</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
													
						<div class="form-group">
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="Title" value="<?php if( isset($data->title) ) echo $data->title; ?>" class="form-control" data-error="Title can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="title">Page Uri</label>
							<input type="text" id="uri" class="form-control" name="uri" value="" />
							<span class="help-block x"><?php if(isset($this->settings->site_url)) echo $this->settings->site_url ?>/<small class="x"></small><small class="pull-right u_valid"></small></span>
						</div>
						
						<div class="form-group">
							<label for="description">Page Description</label>
							<input id="description" type="text" name="description" placeholder="Page Description" value="<?php if( isset($data->description) ) echo $data->description; ?>" class="form-control" />
							<span class="help-block">
								<small>For reference only.</small>
							</span>
						</div>
						
						<div class="form-group">
							<label for="content">Content</label>
							<textarea id="content" name="content" class="summernote">
								<?php if( isset($data->content) ) echo $data->content; ?>
							</textarea>
						</div>
						
	
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
						<div class="form-group">
							<label for="meta_title">Site/Meta Title</label>
							<input id="meta_title" type="text" name="meta_title" value="" class="form-control"  />
						</div>
						
						<div class="form-group">
							<label for="meta_description">Meta Description</label>
							<input id="meta_description" type="text" name="meta_description" value="" class="form-control"  />
						</div>
						
						<div class="form-group">
							<label for="meta_keywords">Meta Keywords</label>
							<input id="meta_keywords" type="text" name="meta_keywords" value="" class="form-control"  />
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
							<label for="is_active" class="col-md-3">Is Active</label>
							<input type="checkbox" id="is_active" value="1" class="js-switch" name="is_active" data-color="#5cb85c"  checked />
						</div>					
						
						<div class="form-group">
							<label for="is_restricted" class="col-sm-3">Is Restricted</label>
							<input type="checkbox" id="is_restricted" value="1" class="js-switch" name="is_restricted" data-color="#5cb85c"  />
						</div>
		
						
						<div class="form-group">
							<label for="display_title" class="col-sm-3">Show Page Title</label>
							<input type="checkbox" id="display_title" value="1" class="js-switch" name="display_title" data-color="#5cb85c"  checked />
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
					<button type="submit" class="btn btn-primary submit pull-right">ADD PAGE</button>
				</div>
			</div>
			</div>
		</div>
	</div>

</form>