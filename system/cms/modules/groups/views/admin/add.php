<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/groups"> Groups Manager</a></li>
			<li class="active">Add Group</li>
		</ol>
	</div>
</div>
<form class="form-material"  data-toggle="validator">
	<input type="hidden" name="add" value="add_group" />
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Group Info</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
													
						<div class="form-group">
							<label for="name">Name</label>
							<input id="name" type="text" name="name" placeholder="Name" value="" class="form-control" data-error="Name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="alt_name">Alt Name</label>
							<input id="alt_name" type="text" name="alt_name" placeholder="Alt Name" value="" class="form-control" data-error="Alt name can not be left empty." required />
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label for="title">Page Uri</label>
							<input type="text" id="uri" class="form-control" name="uri" value="" />
							<span class="help-block x"><small class="x"></small><small class="pull-right u_valid"></small></span>
						</div>
						
						<div class="form-group">
							<label for="description">Description</label>
							<input id="description" type="text" name="description" placeholder="Page Description" value="<?php if( isset($data->description) ) echo $data->description; ?>" class="form-control" />
							<span class="help-block">
								<small>For reference only.</small>
							</span>
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
					<button type="submit" class="btn btn-primary submit pull-right">ADD GROUP</button>
				</div>
			</div>
			</div>
		</div>
	</div>

</form>