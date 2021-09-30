<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$this->load->model('testimonials/testimonials_m');
		$testimonials = $this->testimonials_m->aside(3, 55);
	
	

?>



<div class="testimonial-callout-content">
	<?php if(isset($testimonials)) echo $testimonials; ?>	
</div>