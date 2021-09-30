

<div id="top" class="header-inner">
	<?php 
		if(isset($title)) echo $title; 
		if(isset($subtitle)) echo $subtitle;
	?>
	<a href="/user/sub_accounts" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
	
</div>
<div class="sa-details-wrapper">
	<dl>
		<dt>Sub Account</dt>
			<dd>Name: <span><?php if(isset($sa->fullname)) echo $sa->fullname; ?></dd></span></dd>
			<dd>Email: <span><?php if(isset($sa->email)) echo $sa->email; ?></dd></span></dd>
	</dl>
</div>

<div class="alert" style="display: none;"></div>

<div class="checkall-wrapper">
	<button type="button" id="checkall" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> Check All Zips</button>
</div>
<form id="defaultForm" class="form-horizontal" role="form">
<input type="hidden" name="sa_id" value="<?php if(isset( $sa->sa_id )) echo $sa->sa_id; ?>" />
  <?php if( isset( $zips ) ) echo $zips; ?>
  <div class="form-group" style="padding-left: 20px; border-top: 1px #ccc dotted; padding-top: 20px; margin-top: 20px; ">  
	 <button type="submit" class="btn btn-primary submit">Assign Zip Codes</button>
  </div>
</form>