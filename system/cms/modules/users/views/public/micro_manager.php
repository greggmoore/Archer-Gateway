<div id="top" class="header-inner">
	<?php 
		if(isset($title)) echo $title; 
		if(isset($subtitle)) echo $subtitle;
	?>
</div>

<a id="add" href="/users/micro_add" class="btn btn-success btn-sm" >
  <span class="glyphicon glyphicon-plus"></span> Add
</a>

<?php if($this->uri->segment(3) == 'success'): ?>
<div class="col-md-offset-2 alert alert-success">
	<p>Success! Your micro has been created.</p>
</div>
<?php endif; ?>

<div class="col-md-offset-2 alert" style="display: none;"></div>

	<table id="umicro" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="width: 80%;">Description</th>
            <th>Options</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
            <th>Description</th>
            <th>Options</th>
        </tr>
    </tfoot>
 
    <tbody>
        
      	<?php foreach($micro as $m): ?>
       	<tr id="row_">
            <td><?php if(isset( $m->subdomain )) echo $m->subdomain ; ?>.myrocketlisting.com</td>
            <td>
	            <a href="/users/micro_edit/<?php if(isset( $m->id )) echo $m->id ; ?>">Edit</a>
	            <a href="/users/micro_edit/<?php if(isset( $m->id )) echo $m->id ; ?>">Delete</a>
            </td>
        
        </tr>
       	<?php endforeach; ?>
       
    </tbody>
</table>

