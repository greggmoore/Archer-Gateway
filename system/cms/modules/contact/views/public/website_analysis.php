<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, BluMooCreative.com
 * @package \System\Application\
 * copyright Copyright (c) 2018, BluMooCreative.com
 */

// ------------------------------------------------------------------------
?>


<section class="page-mod hero-mod moo-base-bg text-center">
	<div class="inner-page-mod">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-mod-preheading"><?php if(isset($title)) echo $title; ?></div>
					<h1 class="h1"><?php if(isset($subtitle)) echo $subtitle; ?></h1>
					<div class="page-mod-subheading">Not all sites are created equal!</div>
					
					<div class="banner-mod-scrolling-arrows">
						<span class="hero-banner-mod-scroll-link-container">
							<a class="hero-banner-mod-scroll-link scrollto" href="#request-consultation" data-location="#request-consultation">					
							<svg enable-background="new 0 0 62.5 70.8" version="1.1" viewBox="0 0 62.5 70.8" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
								<g class="scroll-arrow-group">
									<polygon class="scroll-arrow scroll-arrow-three" points="62.5 39.6 31.3 70.8 0 39.6 5.7 33.9 31.3 59.4 56.8 33.9"/>
									<polygon class="scroll-arrow scroll-arrow-two" points="62.5 22.6 31.3 53.9 0 22.6 5.7 16.9 31.3 42.4 56.8 16.9"/>
									<polygon class="scroll-arrow scroll-arrow-one" points="62.5 5.7 31.3 37 0 5.7 5.7 0 31.3 25.5 56.8 0"/>
								</g>
							</svg>
							</a>
						</span>	
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>

<section class="lead-gen-mod" id="request-consultation">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-12">
				<h2 class="h2">A website analysis from Blumoo Creative includes:</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2 offset-sm-0">
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
								<label for="email">Business Email Address</label>
								<input type="text" class="form-control" id="email" name="email" placeholder="blu@cowhouse.com">
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
					
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="website">Website</label>
								<input type="text" class="form-control" id="website" name="website" placeholder="https://www.yourwebsite.com">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="industry">Please Select Your Industry</label>
								<select class="form-control" name="industry" id="industry">
									<option value="Accounting">Accounting</option>
									<option value="Airlines/Aviation">Airlines/Aviation</option>
									<option value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
									<option value="Alternative Medicine">Alternative Medicine</option>
									<option value="Animation">Animation</option>
									<option value="Antiques">Antiques</option>
									<option value="Apparel &amp; Fashion">Apparel &amp; Fashion</option>
									<option value="Architecture &amp; Planning">Architecture &amp; Planning</option>
									<option value="Arts and Crafts">Arts and Crafts</option>
									<option value="Auction">Auction</option>
									<option value="Automotive">Automotive</option>
									<option value="Banking">Banking</option>
									<option value="Biotechnology">Biotechnology</option>
									<option value="Boat Charters">Boat Charters</option>
									<option value="Boating / Marina">Boating / Marina</option>
									<option value="Broadcast Media">Broadcast Media</option>
									<option value="Building Materials">Building Materials</option>
									<option value="Business Supplies and Equipment">Business Supplies and Equipment</option>
									<option value="Chemicals">Chemicals</option>
									<option value="Childcare">Childcare</option>
									<option value="Civic &amp; Social Organization">Civic &amp; Social Organization</option>
									<option value="Cleaning &amp; Janitorial">Cleaning &amp; Janitorial</option>
									<option value="Commercial Real Estate">Commercial Real Estate</option>
									<option value="Computer &amp; Network Security">Computer &amp; Network Security</option>
									<option value="Computer Games">Computer Games</option>
									<option value="Computer Hardware">Computer Hardware</option>
									<option value="Computer Networking">Computer Networking</option>
									<option value="Computer Software">Computer Software</option>
									<option value="Construction/Home Improvement">Construction/Home Improvement</option>
									<option value="Consumer Electronics">Consumer Electronics</option>
									<option value="Consumer Goods">Consumer Goods</option>
									<option value="Consumer Services">Consumer Services</option>
									<option value="Cosmetics">Cosmetics</option>
									<option value="Design">Design</option>
									<option value="Education Management">Education Management</option>
									<option value="E-Learning">E-Learning</option>
									<option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
									<option value="Embroidery">Embroidery</option>
									<option value="Entertainment">Entertainment</option>
									<option value="Environmental Services">Environmental Services</option>
									<option value="Equestrian">Equestrian</option>
									<option value="Events Services">Events Services</option>
									<option value="Facilities Services">Facilities Services</option>
									<option value="Farming">Farming</option>
									<option value="Financial Services">Financial Services</option>
									<option value="Fine Art">Fine Art</option>
									<option value="Fishery">Fishery</option>
									<option value="Florist">Florist</option>
									<option value="Food &amp; Beverages">Food &amp; Beverages</option>
									<option value="Food Production">Food Production</option>
									<option value="Fund-Raising">Fund-Raising</option>
									<option value="Furniture">Furniture</option>
									<option value="Gambling &amp; Casinos">Gambling &amp; Casinos</option>
									<option value="Gift Shops/Gift Baskets">Gift Shops/Gift Baskets</option>
									<option value="Glass, Ceramics &amp; Concrete">Glass, Ceramics &amp; Concrete</option>
									<option value="Government Administration">Government Administration</option>
									<option value="Government Relations">Government Relations</option>
									<option value="Graphic Design">Graphic Design</option>
									<option value="Healers/Spiritual Guides">Healers/Spiritual Guides</option>
									<option value="Health, Wellness &amp; Fitness">Health, Wellness &amp; Fitness</option>
									<option value="Higher Education">Higher Education</option>
									<option value="Hobby">Hobby</option>
									<option value="Hospital &amp; Health Care">Hospital &amp; Health Care</option>
									<option value="Hospitality">Hospitality</option>
									<option value="Home Inspection">Home Inspection</option>
									<option value="Human Resources">Human Resources</option>
									<option value="HVAC">HVAC</option>
									<option value="Import and Export">Import and Export</option>
									<option value="Individual &amp; Family Services">Individual &amp; Family Services</option>
									<option value="Information Services">Information Services</option>
									<option value="Information Technology and Services">Information Technology and Services</option>
									<option value="Instructors/Education">Instructors/Education</option>
									<option value="Insurance">Insurance</option>
									<option value="Interior Design/Home Staging">Interior Design/Home Staging</option>
									<option value="Internet">Internet</option>
									<option value="Landscaping">Landscaping</option>
									<option value="Law Practice">Law Practice</option>
									<option value="Legal Services">Legal Services</option>
									<option value="Leisure, Travel &amp; Tourism">Leisure, Travel &amp; Tourism</option>
									<option value="Logistics and Supply Chain">Logistics and Supply Chain</option>
									<option value="Luxury Goods &amp; Jewelry">Luxury Goods &amp; Jewelry</option>
									<option value="Machinery">Machinery</option>
									<option value="Management Consulting">Management Consulting</option>
									<option value="Maritime">Maritime</option>
									<option value="Market Research">Market Research</option>
									<option value="Marketing and Advertising">Marketing and Advertising</option>
									<option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
									<option value="Media Production">Media Production</option>
									<option value="Medical Devices">Medical Devices</option>
									<option value="Medical Practice">Medical Practice</option>
									<option value="Mental Health Care">Mental Health Care</option>
									<option value="Military">Military</option>
									<option value="Mining &amp; Metals">Mining &amp; Metals</option>
									<option value="Motion Pictures and Film">Motion Pictures and Film</option>
									<option value="Music">Music</option>
									<option value="Non-Profit Organization Management">Non-Profit Organization Management</option>
									<option value="Oil &amp; Energy">Oil &amp; Energy</option>
									<option value="Online Media">Online Media</option>
									<option value="Outdoors">Outdoors</option>
									<option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
									<option value="Packaging and Containers">Packaging and Containers</option>
									<option value="Paper &amp; Forest Products">Paper &amp; Forest Products</option>
									<option value="Performing Arts">Performing Arts</option>
									<option value="Pest Control">Pest Control</option>
									<option value="Pet Services">Pet Services</option>
									<option value="Pharmaceuticals">Pharmaceuticals</option>
									<option value="Photography">Photography</option>
									<option value="Plastics">Plastics</option>
									<option value="Pools">Pools</option>
									<option value="Primary/Secondary Education">Primary/Secondary Education</option>
									<option value="Printing">Printing</option>
									<option value="Professional Training &amp; Coaching">Professional Training &amp; Coaching</option>
									<option value="Professional Organizers">Professional Organizers</option>
									<option value="Promotional Products">Promotional Products</option>
									<option value="Psychics">Psychics</option>
									<option value="Public Relations and Communications">Public Relations and Communications</option>
									<option value="Public Safety">Public Safety</option>
									<option value="Publishing">Publishing</option>
									<option value="Quilting">Quilting</option>
									<option value="Ranching">Ranching</option>
									<option value="Real Estate">Real Estate</option>
									<option value="Recreational Facilities and Services">Recreational Facilities and Services</option>
									<option value="Religious Institutions">Religious Institutions</option>
									<option value="Renewables &amp; Environment">Renewables &amp; Environment</option>
									<option value="Research">Research</option>
									<option value="Restaurants">Restaurants</option>
									<option value="Retail">Retail</option>
									<option value="Security and Investigations">Security and Investigations</option>
									<option value="Smoke Shop">Smoke Shop</option>
									<option value="Solar">Solar</option>
									<option value="Sporting Goods">Sporting Goods</option>
									<option value="Sports">Sports</option>
									<option value="Staffing and Recruiting">Staffing and Recruiting</option>
									<option value="Tactical">Tactical</option>
									<option value="Taxidermy">Taxidermy</option>
									<option value="Telecommunications">Telecommunications</option>
									<option value="Textiles">Textiles</option>
									<option value="Tobacco">Tobacco</option>
									<option value="Translation and Localization">Translation and Localization</option>
									<option value="Transportation/Trucking/Railroad">Transportation/Trucking/Railroad</option>
									<option value="Utilities">Utilities</option>
									<option value="Venture Capital &amp; Private Equity">Venture Capital &amp; Private Equity</option>
									<option value="Veterinary">Veterinary</option>
									<option value="Warehousing">Warehousing</option>
									<option value="Wedding">Wedding</option>
									<option value="Wholesale">Wholesale</option>
									<option value="Wine and Spirits">Wine and Spirits</option>
									<option value="Woodworking">Woodworking</option>
									<option value="Writing and Editing">Writing and Editing</option>
							    </select>
							</div>
						</div>
					</div>
					
					<div class="form-group">
					    <label for="comments">Questions/Comments:</label>
					    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
					  </div>
					  <button type="submit" class="btn btn-moo-base float-right">Submit</button>
					</form>
			</div>
		</div>
	</div>
</section>

