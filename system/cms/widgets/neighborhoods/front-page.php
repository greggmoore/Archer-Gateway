<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore BluMoo Creative
 * @package System\Cms\Modules\Changeme\Controllers
 * copyright Copyright (c) 2017, BluMoo Creative, LLC
 */
 
 $communities = $this->communities_m->communities_front_callouts(COMMUNITIES_CALLOUT_LIMIT);

?>

<?php if(isset($communities)): ?>

<section id="main-communities" class="bg-beige spacer-60 text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Our Communities</h2>
				<hr />
			</div>
		</div>
		
		<?php echo $communities; ?>
		
	</div>
</section>

<?php endif; ?>
