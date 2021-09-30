<div id="top" class="header-inner">
	<?php 
		if(isset($title)) echo $title; 
		if(isset($subtitle)) echo $subtitle;
	?>
</div>

<a id="add" href="/user/<?php echo $user->username ; ?>/widget_add" class="btn btn-success btn-sm" >
  <span class="glyphicon glyphicon-plus"></span> Add
</a>

<div class="col-md-offset-2 alert" style="display: none;"></div>

<?php if( !empty($widgets) ) : ?>

	<div id="sa-wrapper">
	<table id="sa-table" cellspacing="0">
	<thead>
		<tr>
			<th>id#</th>
			<th>Description</th>
			<th>Options</th>
		</tr>	
	</thead>
	<tfoot>
		<tr>
			<td colspan="2"></td>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach($widgets as $w): ?>
			<tr id="row_<?php if(isset( $w->id )) echo $w->id ; ?>">
				<td><?php if(isset( $w->id )) echo $w->id ; ?></td>
				<td><?php if(isset( $w->title )) echo $w->description ; ?></td>
				<td>
					<ul>
						<li class="manage"><a href="/user/<?php echo $user->username ; ?>/widget_edit/<?php if(isset( $w->id )) echo $w->id ; ?>"><span class="glyphicon glyphicon-edit"></span></a></li>
						<li class="remove"><a href="#" id="<?php if(isset( $w->id )) echo $w->id ; ?>" class="delete"><span class="glyphicon glyphicon-trash"></span></a></li>
					</ul>
				</td>
			</tr>
						
	
	   	<?php endforeach; ?>
	 </tbody>
	
	</table>
	</div>
<?php else: ?>
<p>You currently have no saved widgets on record. <a href="/user/<?php echo $user->username ; ?>/widget_add">Click here to create one.</a></p>
<?php endif; ?>
