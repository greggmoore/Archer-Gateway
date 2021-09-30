<div id="top">&nbsp;</div>

<div class="row">
	<div class="col-md-6">
		<?php 
			if(isset($title)) echo $title; 
		?>
	</div>
	<div class="col-md-6">
		<a id="add" href="/users/micro_add" class="btn btn-success btn-sm pull-right" >
			<span class="glyphicon glyphicon-plus"></span> Add
		</a>
	</div>
</div>

<?php if(isset($title)) echo '<h3>'.$title.'</h3>'; ?>
<?php if(isset($micros)): ?>
<div class="table-responsive">
	<table id="dataTable" class="table table-striped" cellspacing="0" width="100%">
		<thead>
	        <tr>
	            <th>Title</th>
	            <th>Sub-domain</th>
	            <th>ParkedDomain</th>
	            <th>City</th>
	        </tr>
	    </thead>
	 
	    <tfoot>
	        <tr>
	            <th>Title</th>
	            <th>Sub-domain</th>
	            <th>Parked Domain</th>
	            <th>City</th>
	        </tr>
	    </foot>
	    
	    <tbody>
        
       
       	
       	<?php foreach($micros as $m): ?>
       	<tr id="row_<?php echo $m->id; ?>">
            <td><a href="/users/micro_edit/<?php if(isset( $m->id )) echo $m->id ; ?>"><?php if(isset( $m->title )) echo $m->title ; ?></a></td>
            <td><?php if(isset( $m->subdomain )) echo $m->subdomain.'.<span>'.SITE_DOMAIN.'</span>' ; ?></td>
            <td><?php if(isset( $m->domain )) echo $m->domain ; ?></td>
            <td>
	            <ul class="table-options">
					<li><a class="remove" href="#myModal" data-toggle="modal" data-id="<?php echo $m->id; ?>" data-title="<?php echo $m->title; ?>" data-target="#myModal"><i class="fa fa-trash confirm-delete"></i></a></li>
				</ul>
			</tr>
       	<?php endforeach; ?>
       	</tbody>
	</table>
</div>
<?php else: ?>
<div class="row">
	<div class="col-md-12">
		<p>No landing pages to display at this.</p>
	</div>
</div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade animated" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Deleting: <span class="modal-span-title"></span></h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
		<p>Deleting the <span class="modal-span-title"></span> page will remove all related content from the database.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" data-dataid=""  class="btn btn-primary modal-confirm">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->
