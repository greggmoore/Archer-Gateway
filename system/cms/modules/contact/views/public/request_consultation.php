<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, BluMooCreative.com
 * @package \System\Application\
 * copyright Copyright (c) 2018, BluMooCreative.com
 */

// ------------------------------------------------------------------------
?>


<section class="section text-center intro">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-sm-12 offset-md-1 offset-xs-0">
				<?php if(isset($data->section1_title)) echo '<h1 class="h2 subpage-title">'.$data->section1_title.'</h1>'; ?>
				<?php if(isset($data->section1)) echo $data->section1; ?>
			</div>
		</div>
	</div>
</section>

<section class="section light-grey" id="contact-form">
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div id="alert_message" class="alert"></div>
				<div id="message"></div>			
					<form id="requestConsultationForm">
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

<!-- BEGIN MAP SECTION -->
<section id="maps">
    <div class="map-content">
        <?php if( isset( $map['html'] ) ) echo '<div class="gmap">'.$map['html'].'</div>'; ?>
    </div>
</section>
<!-- END MAP SECTION -->