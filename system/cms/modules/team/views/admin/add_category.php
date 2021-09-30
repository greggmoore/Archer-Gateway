<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/team"> Team Manager</a></li>
			<li class="active">Add User</li>
		</ol>
	</div>
</div>
<form class="form-material"  data-toggle="validator">
	<input type="hidden" name="add" value="add_category" />
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Category Info</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
													
						<div class="form-group">
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="Title" value="" class="form-control" data-error="Title name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label for="uri">Uri</label>
							<input id="uri" type="text" name="uri" placeholder="Uri" value="" class="form-control"  />
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
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<button type="submit" class="btn btn-primary submit pull-right">ADD TEAM CATEGORY</button>
				</div>
			</div>
			</div>
		</div>
	</div>

</form>