<div id="top">&nbsp;</div>
<?php if(isset($title)) echo '<h3>'.$title.'</h3>'; ?>

<?php if(isset($leads)): ?>
<div class="table-responsive">
	<table id="leadsTable"  class="table table-striped display"  cellspacing="0" width="100%">
		<thead>
	        <tr>
	            <th>First</th>
	            <th>Last</th>
	            <th class="hidden">Email</th>
	            <th>Street</th>
	            <th>City</th>
	            <th>State</th>
	            <th>Created</th>
	            <th>View</th>
	            <!-- <th>Print</th> -->
	        </tr>
	    </thead>
	 
	    <tfoot>
	        <tr>
	            <th>First</th>
	            <th>Last</th>
	            <th class="hidden">Email</th>
	            <th>Street</th>
	            <th>City</th>
	            <th>State</th>
				<th>Created</th>
	            <th>View</th>
	           <!-- <th>Print</th> -->
	        </tr>
	    </foot>
	    
	    <tbody>
        
       
       	
       	<?php foreach($leads as $l): ?>
       	<tr>
            <td><?php if(isset( $l->first_name )) echo $l->first_name ; ?></td>
            <td><?php if(isset( $l->last_name )) echo $l->last_name ; ?></td>
            <td class="hidden"><?php if(isset( $l->email )) echo $l->email ; ?></td>
            <td><?php if(isset( $l->street )) echo $l->street ; ?></td>
            <td><?php if(isset( $l->city )) echo $l->city ; ?></td>
            <td><?php if(isset( $l->state )) echo $l->state ; ?></td>
            <td><?php if(isset( $l->lead_created )) echo date('m-d-Y', strtotime($l->lead_created)) ; ?></td>
            <td><a href="/users/lead/<?php if(isset( $l->lead_id )) echo $l->lead_id ; ?>">Details</a></td>
            <!--<td><a class="btnSmall" href="/user/<?php echo $user->username ; ?>/print_details/<?php if(isset( $l->lead_id )) echo $l->lead_id ; ?>"><span class="glyphicon glyphicon-print"></span></a></td>-->
        </tr>
       	<?php endforeach; ?>
       	</tbody>
	</table>
</div>
<?php else: ?>
<div class="row">
	<div class="col-md-12">
		<p>No leads to display at this.</p>
	</div>
</div>
<?php endif; ?>
       
