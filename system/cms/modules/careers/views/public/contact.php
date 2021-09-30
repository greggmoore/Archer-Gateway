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
					<div class="page-mod-subheading">Making the web a better place one page at a time!</div>
					
					<div class="banner-mod-scrolling-arrows">
						<span class="hero-banner-mod-scroll-link-container">
							<a class="hero-banner-mod-scroll-link scrollto" href="#contact-callout-intro" data-location="#contact-callout-intro">					
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

<section id="contact-callout-intro" class="lead-gen-mod lightblue-bg text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<h2 class="h2">IT'S TRUE, WE ARE ACTUALLY HUMANS!</h2>
					<p>You're not going to hit a ridiculously long phone menu when you call us. Your email isn't going to the inbox abyss, never to be seen or heard from again. At Blumoo Creative, we provide the exceptional service we'd want to experience ourselves!</p>
					<div class="page-mod-telephone">
						<a href="tel:<?php echo DEFAULT_TELEPHONE; ?>" title="Call Us!"><?php echo DEFAULT_TELEPHONE; ?></a>
					</div>
			</div>
		</div>
	</div>
</section>

<section class="lead-gen-mod" id="contact-form">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-12">
				<h4 class="h4">While a cowbell will grab our attention, there is a simpler way to get in touch with us!</h4>
			</div>
		</div>
		<div class="row">
		
			<div class="col-md-8 offset-md-2">
				<div id="alert_message" class="alert"></div>
				<div id="message"></div>			
				<form id="defaultForm">
					<div class="form-row">
						<div class="col">
							<div class="form-group">
								<label for="first_name">First Name</label>
								<input id="first_name" type="text" class="form-control validate-required" name="first_name" placeholder="First Name" required>
								
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input id="last_name" type="text" class="form-control validate-required" name="last_name" placeholder="Last Name">
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col">
							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="text" class="form-control" id="email" name="email" placeholder="">
								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div>
						</div>
						<div class="col">
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
					  <button type="submit" class="btn btn-moo-base float-right">Submit</button>
					</form>
			</div>
		</div>
	</div>
</section>

