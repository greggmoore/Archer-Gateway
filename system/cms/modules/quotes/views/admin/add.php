<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/community/edit/community">Be a Part of The Team</a></li>
			<li class="active">Add Quote</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info" role="alert">
			<i class="fa fa-info-circle"></i> You will have the option to add a photo after the quote has been created.
		</div>
	</div>
</div>
<form class="form-material"  data-toggle="validator">
	<input type="hidden" name="add" value="add_quote" />
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
													
						<div class="form-group">
							<label for="quotee">Author</label>
							<input id="quotee" type="text" name="quotee" placeholder="Author" value="" class="form-control" data-error="Author name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="quote">Quote</label>
							<textarea id="quote" name="quote" class="summernote"></textarea>
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
					<button type="submit" class="btn btn-primary submit pull-right">ADD QUOTE</button>
				</div>
			</div>
			</div>
		</div>
	</div>
	
	

</form>