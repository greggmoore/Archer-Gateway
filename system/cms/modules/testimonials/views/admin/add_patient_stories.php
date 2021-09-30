<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="<?php if(isset($section_path)) echo $section_path; ?>"> <?php if(isset($section_title)) echo $section_title; ?></a></li>
			<li><a href="<?php if(isset($cat_path)) echo $cat_path; ?>"><?php if(isset($cat_title)) echo $cat_title; ?></a></li>
			<li class="active">Add</li>
		</ol>
	</div>
</div>


<form id="" class="form-material"  data-toggle="validator">
	<input type="hidden" name="add" value="add_story" />
	<input type="hidden" name="photo" value="" />
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Patient Story</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
													
						<div class="form-group">
							<label for="cite">Name</label>
							<input id="cite" type="text" name="cite" placeholder="Name" value="" class="form-control" />
							<div class="help-block with-errors"></div>
						</div>
						
						
						<div class="form-group">
							<label for="quote">Quote</label>
							<textarea id="quote" name="quote" class="summernote"></textarea>
							
							<div class="help-block with-errors"></div>
						</div>

	
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
								<span id="quotephoto"><p>upload photo to display</p></span>
							</div>
							<div class="col-md-6">
								<div class="form-group">
										<label for="photo">Upload Photo</label>
										<input type="file" name="photo" id="photo" />
									</div>
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
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<button type="submit" class="btn btn-primary submit pull-right">ADD PATIENT STORY</button>
				</div>
			</div>
			</div>
		</div>
	</div>

</form>
