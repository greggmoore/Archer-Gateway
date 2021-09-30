<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="HandheldFriendly" content="true">
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<title><?php echo $this->meta_title; ?></title>
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="<?php echo SITE_NAME; ?>"/>
		<meta name="msvalidate.01" content="766058DD8CE39899AD5D54E371764B64" />
		<?php echo open_graph($this->open_graph); ?>
		<?php if(isset($this->ogimage)) echo '<link rel="image_src" href="'.$this->ogimage.'" />' ; ?>
		
		<link rel="apple-touch-icon" href="apple-touch-icon.png">
		<?php echo meta($this->meta_info); ?>
		<link rel="icon" type="image/x-icon"  sizes="16x16" href="<?php echo base_url().$this->template_path ; ?>/assets/images/favicon.ico" hreflang="en-us" />
		<link rel="icon" href="/<?php echo base_url().$this->template_path ; ?>/assets/images/favicons/favicon.ico" />
		
		<!-- GOOGLE FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">		
		<link href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" hreflang="en-us" href="/<?php echo $this->template_path ; ?>/assets/css/bootstrap.min.css" />
		<!-- FONT ICONS -->
		<script src="https://kit.fontawesome.com/b0d9d8ce81.js" crossorigin="anonymous"></script>	
		<link href="/<?php echo $this->template_path ; ?>/assets/css/flaticon.css" rel="stylesheet">
	
	<!-- PLUGINS STYLESHEET -->
		<link href="/<?php echo $this->template_path ; ?>/assets/css/menu.css" rel="stylesheet">	
		<link id="effect" href="/<?php echo $this->template_path ; ?>/assets/css/dropdown-effects/fade-down.css" media="all" rel="stylesheet">
		<link href="/<?php echo $this->template_path ; ?>/assets/css/magnific-popup.css" rel="stylesheet">	
		<link href="/<?php echo $this->template_path ; ?>/assets/css/flexslider.css" rel="stylesheet">
		<link href="/<?php echo $this->template_path ; ?>/assets/css/owl.carousel.min.css" rel="stylesheet">
		<link href="/<?php echo $this->template_path ; ?>/assets/css/owl.theme.default.min.css" rel="stylesheet">
		
		<!-- ON SCROLL ANIMATION -->
		<link href="/<?php echo $this->template_path ; ?>/assets/css/animate.css" rel="stylesheet">
		
		<link href="/<?php echo $this->template_path ; ?>/assets/css/dodgerblue.css" rel="stylesheet">
		
		<link href="/<?php echo $this->template_path ; ?>/assets/css/responsive.css" rel="stylesheet"> 
		
	<?php if (isset( $css_global )) echo $css_global; ?>
	<?php if (isset( $css )) echo $css; ?>
	<?php if (isset( $canonical )) echo $canonical; ?>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-CNHV4WLEE5"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'G-CNHV4WLEE5');
		</script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-184477919-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'UA-184477919-1');
		</script>
     <?php 
	   // if($this->ga_tracking) echo $this->ga_tracking ;
	    if( isset($map['js']) ) echo $map['js']; 
	?>
  </head>
  <body <?php if( isset( $onload ) ) echo $onload; ?>>
	    
    <div id="page" class="page">
	    <!-- HEADER
			============================================= -->
			<header id="header" class="header tra-menu navbar-light">
				<div class="header-wrapper">


					<!-- MOBILE HEADER -->
				    <div class="wsmobileheader clearfix">	
				    	<a href="/" id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>	    	
				    	<span class="smllogo smllogo-black"><img src="/<?php echo $this->template_path ; ?>/assets/images/blue-chip-logo.png" width="162" height="40" alt="mobile-logo"/></span>
				    	<span class="smllogo smllogo-white"><img src="/<?php echo $this->template_path ; ?>/assets/images/blue-chip-logo-white.png" width="162" height="40" alt="mobile-logo"/></span>
				    	<a href="tel:123456789" class="callusbtn"><i class="fas fa-phone"></i></a>
				 	</div>


				  	<!-- NAVIGATION MENU -->
				  	<div class="wsmainfull menu clearfix">
	    				<div class="wsmainwp clearfix">


	    					<!-- LOGO IMAGE -->
	    					<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 334 x 80 pixels) -->
	    					<div class="desktoplogo"><a href="/" class="logo-black"><img src="/<?php echo $this->template_path ; ?>/assets/images/blue-chip-logo.png" width="200" height="77" alt="header-logo"></a></div>
	    					<div class="desktoplogo"><a href="/" class="logo-white"><img src="/<?php echo $this->template_path ; ?>/assets/images/blue-chip-logo-white.png" width="200" height="77" alt="header-logo"></a></div>


	    					<!-- MAIN MENU -->
	      					<nav class="wsmenu clearfix blue-header txt-shadow">
	        					<ul class="wsmenu-list">


	        						<!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="#about">About</a></li>


						          	

							    	<!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="#services">Services</a></li>


							 

								    
								    <!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="#team">Meet The Team</a></li>


							    	<!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="/contact">Contact</a></li>


								    <!-- HEADER PHONE NUMBER -->
								    <li class="nl-simple primary-scroll" aria-haspopup="true">
								    	<a href="tel:<?php echo DEFAULT_TELEPHONE; ?>" class="last-link last-link-number">
								    		<i class="fas fa-phone-square-alt"></i> <?php echo DEFAULT_TELEPHONE; ?>
								    	</a>
								    </li>


								    <!-- HEADER BUTTON 
								    <li class="nl-simple" aria-haspopup="true">
								    	<a href="#" class="btn btn-primary tra-white-hover last-link">Get In Touch</a>
								    </li> -->


	        					</ul>
	        				</nav>	<!-- END MAIN MENU -->

	    				</div>
	    			</div>	<!-- END NAVIGATION MENU -->


				</div>     <!-- End header-wrapper -->
			</header>	<!-- END HEADER -->
			
			
			<?php if(isset($partial)) echo $partial; ?>
			
			
			<section id="contacts-2" class="bg-darkblue bg-map contacts-section division">				
				<div class="container white-color">
					<div class="row">	


						<!-- LOCATION -->
						<div class="col-md-4">
							<div class="contact-box icon-sm clearfix">

								<!-- Icon --> 
								<img class="img-50" src="/<?php echo $this->template_path ; ?>/assets/images/icons/placeholder-4.png" alt="clock-icon" />
							
								<!-- Text -->
								<div class="cbox-2-txt">

									<!-- Title -->	
									<h5 class="h5-lg">Our Location:</h5>
									<!-- Title -->	
									<p>Blue Chip Transaction Services</p>
									<p><?php echo DEFAULT_ADDRESS; ?></p> 
									<p><?php echo DEFAULT_CITY; ?>, NC <?php echo DEFAULT_ZIPCODE; ?></p>

								</div>

							</div>
						</div>


						<!-- QUICK CONTACTS -->
						<div class="col-md-4">
							<div class="contact-box icon-sm clearfix">

								<!-- Icon --> 
								<img class="img-50" src="/<?php echo $this->template_path ; ?>/assets/images/icons/contacts.png" alt="clock-icon" />
							
								<!-- Text -->
								<div class="cbox-2-txt">

									<!-- Title -->	
									<h5 class="h5-lg">Quick Contacts:</h5>

									<!-- Text -->	
									<p>Phone: <?php echo DEFAULT_TELEPHONE; ?></p>
									<p>Fax: <?php echo DEFAULT_FAX; ?></p>
									<p><a href="mailto:yourdomain@mail.com">info@bluechiptransactions.com</a></p>

								</div>

							</div>
						</div>


						<!-- WORKING HOURS -->
						<div class="col-md-4">
							<div class="contact-box clearfix">

								<!-- Icon --> 
								<img class="img-50" src="/<?php echo $this->template_path ; ?>/assets/images/icons/clock-1.png" alt="clock-icon" />
							
								<!-- Text -->
								<div class="cbox-2-txt">

									<!-- Title -->	
									<h5 class="h5-lg">Office Hours:</h5>

									<!-- Text -->	
									<p>Mon-Fri: 8:30AM - 7:30PM</p>
									<p>Saturday: 8:30AM - 3:30PM</p>
									<p>Sunday: 12:00PM - 5:00PM</p>

								</div>

							</div>
						</div>

			 		
				 	</div>	   <!-- End row -->
				</div>	   <!-- End container -->		
			</section>	<!-- END CONTACTS-2 -->
			<!-- FOOTER-3
			============================================= -->
			<footer id="footer-1" class="pt-100 footer division">
				<div class="container">


					<!-- FOOTER CONTENT -->
					<div class="row">	


						<!-- FOOTER LINKS -->
						<div class="col-md-4 col-lg-2 col-xl-3">
							<div class="footer-links mb-40">
						
								<img src="/<?php echo $this->template_path ; ?>/assets/images/blue-chip-logo.png" class="img-fluid"/>
								

							</div>
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-md-4 col-lg-3 col-xl-3">
							<div class="footer-links mb-40">
							
								<!-- Title -->
								<h5 class="h5-sm darkblue-color">Info Links</h5>

								<!-- Footer Links -->
								<ul class="foo-links clearfix">
									<li><a href="#about">About</a></li>
									<li><a href="#services">Services</a></li>
									<li><a href="#team">Meet The Team</a></li>
																
								</ul>

							</div>
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-md-4 col-lg-3 col-xl-3">
							<div class="footer-links mb-40">
							
								<!-- Title -->
								<h5 class="h5-sm darkblue-color">Helpful Links</h5>

								<!-- Footer Links -->
								<ul class="foo-links clearfix">
									<li><a href="/privacy-policy">Privacy Policy</a></li>
									<li><a href="/terms-of-use">Terms of Use</a></li>
									<li><a href="/join-our-team">Join Our Team</a></li>	
															
								</ul>

							</div>
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-lg-4 col-xl-3">
							<div class="footer-contacts text-center mb-40">
							
								<!-- Title -->
								<a href="/contact" class="btn btn-primary tra-black-hover">Questions? Comments?</a>
								<!--
								<ul class="foo-socials text-center clearfix">
									
									<li><a href="#" class="ico-facebook"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#" class="ico-twitter"><i class="fab fa-twitter"></i></a></li>	
									<li><a href="#" class="ico-google-plus"><i class="fab fa-google-plus-g"></i></a></li>
									<li><a href="#" class="ico-tumblr"><i class="fab fa-tumblr"></i></a></li>			
																															
									
									<li><a href="#" class="ico-behance"><i class="fab fa-behance"></i></a></li>	
									<li><a href="#" class="ico-dribbble"><i class="fab fa-dribbble"></i></a></li>									
									<li><a href="#" class="ico-instagram"><i class="fab fa-instagram"></i></a></li>	
									<li><a href="#" class="ico-linkedin"><i class="fab fa-linkedin-in"></i></a></li>
									<li><a href="#" class="ico-pinterest"><i class="fab fa-pinterest-p"></i></a></li>								
									<li><a href="#" class="ico-youtube"><i class="fab fa-youtube"></i></a></li>										
									<li><a href="#" class="ico-vk"><i class="fab fa-vk"></i></a></li>
									<li><a href="#" class="ico-yelp"><i class="fab fa-yelp"></i></a></li>
									<li><a href="#" class="ico-yahoo"><i class="fab fa-yahoo"></i></a></li>
								    

								</ul>-->	
								<p class="mt-10"><?php echo SITE_NAME; ?></p> 
								<p><?php echo DEFAULT_ADDRESS; ?></p> 
								<p><?php echo DEFAULT_CITY; ?>, NC <?php echo DEFAULT_ZIPCODE; ?></p>

							</div>
						</div>


					</div>	  <!-- END FOOTER CONTENT -->


					<!-- BOTTOM FOOTER -->
					<div class="bottom-footer">
						<div class="row">


							<!-- FOOTER COPYRIGHT -->
							<div class="col-lg-10">
								<ul class="bottom-footer-list">
									<li><p>&copy; Copyright <?php echo date('Y'); ?>, <?php echo SITE_NAME; ?></p></li>
									<li><p><a href="tel:<?php echo DEFAULT_TELEPHONE; ?>"><?php echo DEFAULT_TELEPHONE; ?></a></p></li>
									<li><p class="last-li"><a href="mailto:<?php echo DEFAULT_EMAIL; ?>"><?php echo DEFAULT_EMAIL; ?></a></p></li>
								</ul>
							</div>


						</div>
					</div>	<!-- END BOTTOM FOOTER -->


				</div>	   <!-- End container -->										
			</footer>	<!-- END FOOTER-3 -->
    </div>
  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    
    
    <script src="/<?php echo $this->template_path ; ?>/assets/js/modernizr.custom.js"></script>
	<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.easing.js"></script>
	<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.appear.js"></script>
	<script src="/<?php echo $this->template_path ; ?>/assets/js/menu.js"></script>
	<script src="/<?php echo $this->template_path ; ?>/assets/js/materialize.js"></script>	
	<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.scrollto.js"></script>
	<script src="/<?php echo $this->template_path ; ?>/assets/js/imagesloaded.pkgd.min.js"></script>
	<script src="/<?php echo $this->template_path ; ?>/assets/js/isotope.pkgd.min.js"></script>
	<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.flexslider.js"></script>
	<script src="/<?php echo $this->template_path ; ?>/assets/js/owl.carousel.min.js"></script>
	<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.magnific-popup.min.js"></script>	
	<script src="/<?php echo $this->template_path ; ?>/assets/js/seo-form.js"></script>	
	<script src="/<?php echo $this->template_path ; ?>/assets/js/contact-form.js"></script>	
	<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.validate.min.js"></script>	
	<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.ajaxchimp.min.js"></script>	
	<script src="/<?php echo $this->template_path ; ?>/assets/js/wow.js"></script>	

	<!-- Custom Script -->	
	<script type="text/javascript" src="/<?php echo $this->template_path ; ?>/assets/js/bootstrapValidator/bootstrapValidator.js"></script>
	<script type="text/javascript" src="/<?php echo $this->template_path ; ?>/assets/js/mask.js"></script>
	
	<!-- Custom Script -->		
		<script src="/<?php echo $this->template_path ; ?>/assets/js/custom.js"></script>

		<script>
			new WOW().init();
		</script>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
		<!-- [if lt IE 9]>
			<script src="js/html5shiv.js" type="text/javascript"></script>
			<script src="js/respond.min.js" type="text/javascript"></script>
		<![endif] -->
		
    <?php 
	    if (isset( $js_global )) echo $js_global; 
	    if (isset( $js )) echo $js;
	    
    ?>
	<script>
  jQuery($ => {
    // The speed of the scroll in milliseconds
    const speed = 1000;

    $('a[href*="#"]')
      .filter((i, a) => a.getAttribute('href').startsWith('#') || a.href.startsWith(`${location.href}#`))
      .unbind('click.smoothScroll')
      .bind('click.smoothScroll', event => {
        const targetId = event.currentTarget.getAttribute('href').split('#')[1];
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          event.preventDefault();
          $('html, body').animate({ scrollTop: $(targetElement).offset().top }, speed);
        }
      });
  });
</script>
  </body>
</html>