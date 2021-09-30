<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, Blumoocreative.com
 * @package \System\Application\
 * copyright Copyright (c) 2028, Blumoocreative.com
 */

// ------------------------------------------------------------------------
?>

<section id="contact-page" class="page-hero-section division">
	<div class="container">	
		<div class="row">	


			<!-- PAGE HERO TEXT -->
			<div class="col-md-10 offset-md-1">
				<div class="hero-txt text-center white-color txt-shadow">

					<!-- Title -->
					<h3 class="h3-xl">Start Your Career With Us!</h3>

					<!-- Text -->
					<p>Become part of a driven and dedicated team!</p>

				</div>
			</div>	<!-- END PAGE HERO TEXT -->


		</div>    <!-- End row --> 
	</div>	   <!-- End container --> 
</section>	<!-- END PAGE HERO -->


<section id="about-1" class="wide-60 about-section division">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-md-8 offset-md-2">
				<h1>Join Our Team!</h1>
				<p>We are always looking for talented individuals to help us expand. We are looking for high energy, hard working, focused, business minded individuals.</p>
				<p>If you are interested in joining our team and you would just like to achieve a higher level of success, please contact us using the form below or call us: <strong><?php echo DEFAULT_TELEPHONE; ?>.</strong></p>
			</div>
		</div>
	</div>
</section>

<section class="pb-100 about-section division">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-md-8 offset-md-2">
				<div id="alert_message" class="alert"></div>
				<div id="message"></div>			
				<form id="joinForm">
					<input type="hidden" name="form_title" value="Join Our Team"/>
					<input type="hidden" name="location_url" value="<?php echo HTTPS_URL?>/join-our-team"/>
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="first_name">First Name</label>
								<input id="first_name" type="text" class="form-control validate-required" name="first_name" placeholder="First Name" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input id="last_name" type="text" class="form-control validate-required" name="last_name" placeholder="Last Name">
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="text" class="form-control" id="email" name="email" placeholder="">
								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="telephone">Phone</label>
								<input type="text" class="form-control us_phone" name="telephone" placeholder="Phone">
							</div>
						</div>
					</div>
					<div class="form-group">
					    <label for="comments">Questions/Comments:</label>
					    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
					  </div>
					  <button type="submit" class="btn btn-primary wci-btn float-right">Submit</button>
				</form>
			</div>
		</div>
	</div>
</section>