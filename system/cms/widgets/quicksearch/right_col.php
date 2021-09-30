<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore BluMoo Creative
 * @package System\Cms\Modules\Changeme\Controllers
 * copyright Copyright (c) 2017, BluMoo Creative, LLC
 */
?>

<div class="box grey-outline quick-search">
	<div class="box-title-header">
		<h5>Quick Search</h5>
	</div>
	
	<p>Search all homes for sale in the Leland &amp; Wilmington area and surrounding communities.</p>
	
	<form action="/property" method="post">
		<input type="hidden" name="search" value="1" />
		<div class="input-group mb-2">
			<label class="sr-only" for="quick_search">Quick Search</label>
			<input type="text" class="form-control" id="quick_search" placeholder="Address, City or MLS Number">
			<div class="input-group-prepend">
				<div class="input-group-text">
					<button type="submit" class="btn btn-search red my-1"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</div>
	</form>
	
</div>