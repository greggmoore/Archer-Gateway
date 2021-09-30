<?php if(isset($title)) echo '<h3>'.$title.'</h3>'; ?>


<div class="alert" style="display: none;"></div>


	<div class="row zipcodes">
	  <div class="col-xs-5 left">
		<h4>Add Zips</h4>
		<form id="zipAdd" data-uri="zipcodes" class="form-horizontal" role="form">
		  <input type="hidden" name="user" value="add_zipcodes" />
		  
		 <div class="form-group">
			  <textarea name="zipcodes" id="zipcodes" class="form-control"></textarea>
		 </div>
		  
		  <div class="form-group">  
			  <div class="col-sm-5" style="padding-left: 0;">
			      <button type="submit" class="btn btn-block btn-primary">Add</button>
			  </div>
		  </div>
		</form>
	  </div>
	  <div class="col-xs-5 right">
	  	<h4>Active Zips</h4>
	  	<div class="zipStats">
	  		<ul>
		  		<li>total zips: <span class="count"><?php if( isset( $zipcodes['count'] ) ) echo $zipcodes['count']; ?></span></li>
	  		</ul>
  		</div>
		<form id="zipRemove" data-uri="zipcodes" class="form-horizontal" role="form">
		  <input type="hidden" name="user" value="remove_zipcodes" />
	  		<div id="activezips">
		  		<?php if( isset( $zipcodes['html'] ) ) echo $zipcodes['html']; ?>
	  		</div>	  		
	  		
	  		<div class="form-group">  
			  <div class="col-sm-6">
			      <button type="submit" class="btn btn-block btn-danger">Remove</button>
			  </div>
		  </div>
		</form>
		 				
	  </div>
	</div>