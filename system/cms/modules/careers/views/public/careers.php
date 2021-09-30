<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, BluMooCreative.com
 * @package \System\Application\
 * copyright Copyright (c) 2018, BluMooCreative.com
 */

// ------------------------------------------------------------------------
?>


<section class="intro">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php if(isset($data->section1_title)) echo '<h1 class="subpage-title">'.$data->section1_title.'</h1>'; ?>
				<?php if(isset($data->section1)) echo $data->section1; ?>
			</div>
		</div>
	</div>
</section>
		
		
<section class="section" id="contact-form">
	<div class="container">
		<div class="row">
		
			<div class="col-md-10 offset-md-1 offset-sm-0">
				<div id="alert_message" class="alert"></div>
				<div id="message"></div>			
				<form id="defaultForm">
					<input type="hidden" id="response_filename" name="response_filename" value="" />
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
					
					<hr />
					
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="website">Website</label>
								<input type="text" class="form-control" id="website" name="website" placeholder="http://">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="facebook">Facebook</label>
								<input type="text" class="form-control" name="facebook" placeholder="Facebook URL">
							</div>
						</div>
					</div>					
					
					<div class="form-group">
						<label for="skills_software">Skills &amp; Software Experience</label>
						<textarea class="form-control" id="skills_software" name="skills_software" rows="3"></textarea>
					</div>
					
					<hr />
						
					<div class="form-group">
						<label for="project_experience">Project Experience</label>
						<small id="projectHelp" class="form-text text-muted">Please list the company name, your role, and project description.</small>
						<textarea class="form-control" id="project_experience" name="project_experience" rows="3" placeholder=""></textarea>
						
					</div>
					
					<hr />
					
					<div class="form-group">
						<label for="self_description">Tell us about yourself!</label>
						<textarea class="form-control" id="self_description" name="self_description" rows="3"></textarea>
					</div>
					
					<hr />
					
					<div class="form-group">
						<label for="resume">Attach your résumé</label><br />
						<input type="file" name="resume" id="resume" data-resumeID="<?php echo time(); ?>" />
					</div>
					
					  <button type="submit" class="btn text-light my-2 my-sm-0 float-right">Submit</button>
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
