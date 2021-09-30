<?php
	
?>


<div class="row bg-title">
	<div class="col-md-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-md-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li><a href="/admin/leads"> Leads Manager</a></li>
			<li class="active">Lead Details: <?php echo $data->street; ?></li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
			<?php if( isset( $map['html'] ) ) echo '<div class="gmap">'.$map['html'].'</div>'; ?>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Details</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					
					<?php if(isset($details)) echo $details; ?>
					
				</div>
			</div>
		</div>
	</div>
</div>