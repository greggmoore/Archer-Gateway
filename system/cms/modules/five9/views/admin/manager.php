<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, blumoocreative.com
 * @package System\Cms\Modules\Five9\Models
 * copyright Copyright (c) 2021, Blu0oo Creative, LLC
 */

// ------------------------------------------------------------------------
?>


<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li class="active">Five9 Manager</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<div class="table-responsive">
				<table id="dataTable" class="table table-striped">
					<thead>
						<tr>
							<th>Client</th>
							<th>Status</th>
							<th class="hidden-xs">List Name</th>
							<th class="hidden-xs">Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($pages)) echo $pages; ?>
					</tbody>
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
		<p>Deleting the <span class="modal-span-title"></span> page will remove all related content from the database.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" data-dataid=""  class="btn btn-primary modal-confirm">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->