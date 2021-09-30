<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/posts/">All Posts</a></li>
			<li class="active">Add</li>
		</ol>
	</div>
</div>
<form class="form-material" data-toggle="validator">
	<input type="hidden" name="add" value="add_post" />
	<input type="hidden" name="category[]" value="<?php echo $this->uri->segment(4); ?>" />
	<input type="hidden" name="cid" value="<?php echo $this->uri->segment(4); ?>" />
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Main Content</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
													
						<div class="form-group">
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="Title" value="" class="form-control" data-error="Title can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="author">Author</label>
							<input id="author" type="text" name="author" placeholder="Author" value="" class="form-control" />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
			                 <label for="author">Publication Date</label><br />
				             <div class="col-md-4">
					             <div class="input-group date datepicker-autoclose">
				                    <input type="text" name="publication_date" class="form-control" value="" />
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
				             </div>
			            </div>
	
						
						<div class="form-group">
							<label for="content">Content</label>
							 <textarea id="content" name="content" class="summernote">
								
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
				<div class="panel-heading">Options</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
			
						<div class="form-group">
							<label for="category" class="col-md-3">Category</label>
							<?php if(isset($categories)) echo $categories; ?>
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
					<button type="submit" class="btn btn-primary submit pull-right">ADD POST</button>
				</div>
			</div>
			</div>
		</div>
	</div>

</form>