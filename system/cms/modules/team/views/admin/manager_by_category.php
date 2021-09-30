<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-md-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin">Dashboard</a></li>
			<li><a href="/admin/team">Team</a></li>
			<li class="active"><?php echo $category->title; ?></li>
		</ol>
		<a class="btn btn-success pull-right" href="/admin/team/add">ADD NEW</a>
	</div>
</div>
<div id="pending-status" class="row">
	<div class="col-md-9 col-xs-12">
		<div class="alert alert-info" role="alert">
			<p><i class="fa fa-exclamation-circle"></i> The recent team order has changed and needs approval. Please review and publish.</p>
		</div>
	</div>
	<div class="col-md-3 col-xs-12 moxie-btns">
		<a class="btn btn-warning" rel="external" href="/staging/about/leadership#<?php echo $category->uri; ?>">REVIEW</a>
		<a id="publish-page" class="btn btn-success" href="#myPublishModal" data-toggle="modal" data-target="#myPublishModal">PUBLISH</a>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group" style="margin-bottom: 0;">
						<?php echo $this->team_m->category_select_menu($category->id); ?>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<div class="table-responsive">
				<table id="memberItems" class="table table-striped" data-category="<?php echo $category->id; ?>">
					<thead>
						<tr class="nodrop nodrag">
							<th>First</th>
							<th class="hidden-xs">Last</th>
							<th class="text-center">Sort Order</th>
							<th>Status</th>
							<th class="hidden-xs">Category</th>
							<th class="hidden-xs text-center">Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($team)) echo $team; ?>
					</tbody>
					<tfoot>
						<tr class="nodrop nodrag">
							<td colspan="5">
								<span class="order_result"></span>
							</td>
						</tr>
					</tfoot>
				</table>
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
        <h3 class="modal-title" id="myModalLabel">Deleting: <span class="modal-span-title"></span></h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
		<p>Deleting the team member of <span class="modal-span-title"></span> will remove all related content from the database.</p>
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
        <h3 class="modal-title" id="myModalLabel">Update/Publish team order</h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
		<p>This will publish the current team order to the <strong>live</strong> site.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary btn-publish modal-order">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->


<?php if($sort_status == 'live'): ?>
<script type="text/javascript">
	$('#pending-status').hide();
</script>
<?php endif; ?>