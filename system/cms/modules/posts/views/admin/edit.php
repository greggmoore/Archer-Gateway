<?php 
	
	$review_uri = $this->uri->segment(6) == 'perspectives' ? 'news/'.$this->uri->segment(6) : 'home' ;
	
?>
<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php echo $title; ?></h4>
	</div>
	<div class="col-md-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/posts">All Posts</a></li>
			<li class="active">Edit</li>
		</ol>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					
					<form id="formContent" class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="original_uri" value="<?php echo $data->uri; ?>" />
						<input type="hidden" name="update" value="content" />
					
						<div class="form-group">
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="Title" value="<?php if( isset($data->title) ) echo $data->title; ?>" class="form-control" data-error="Title can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="author">Author</label>
							<input id="author" type="text" name="author" placeholder="Author" value="<?php if( isset($data->author) ) echo $data->author; ?>" class="form-control" />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
			                 <label for="author">Publication Date</label><br />
				             <div class="col-md-4">
					             <div class="input-group date datepicker-autoclose">
				                    <input type="text" name="publication_date" class="form-control" value="<?php if( isset($data->publication_date) ) echo date('m/d/Y', strtotime($data->publication_date)); ?>" />
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
				             </div>
			            </div>

						
						
						<div class="form-group">
							<label for="content">Content</label>
							 <textarea id="content" name="content" class="summernote">
								<?php if( isset($data->content) ) echo $data->content; ?>
							</textarea>
						</div>

						<div class="form-group submit-row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary submit pull-right">Update</button>
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
					
					<form id="formOptions" class="form-material"  data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
						<input type="hidden" name="update" value="options" />
						<div class="panel-body">

							
							<div class="form-group">
								<label for="category" class="col-md-3">Category</label>
								<?php if(isset($categories)) echo $categories; ?>
							</div>

							
							<div class="form-group submit-row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary submit pull-right">Submit</button>
							</div>
						</div>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>