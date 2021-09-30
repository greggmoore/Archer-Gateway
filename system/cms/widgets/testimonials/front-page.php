<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$this->load->model('testimonials/testimonials_m');
		$testimonials = $this->testimonials_m->featured_home_page(3, 55);
	
	

?>
<section class="bg-lt-grey text-center spacer-60">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>What Our Clients Are Saying</h2>
				<hr />
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<?php if(isset($testimonials)) echo $testimonials; ?>				
			</div>
		</div>
	</div>
</section>