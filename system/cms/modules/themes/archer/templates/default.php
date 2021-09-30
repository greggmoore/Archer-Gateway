<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
	<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.min.js"></script>
    <script src="/<?php echo $this->template_path ; ?>/assets/js/main.js"></script>
	<link rel="stylesheet" href="/<?php echo $this->template_path ; ?>/assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="/<?php echo $this->template_path ; ?>/assets/css/style.css">
    <link rel="stylesheet" href="/<?php echo $this->template_path ; ?>/assets/css/glide.css">
    <link rel="stylesheet" href="/<?php echo $this->template_path ; ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/<?php echo $this->template_path ; ?>/assets/css/content-box.css">
    <link rel="stylesheet" href="/<?php echo $this->template_path ; ?>/assets/css/contact-form.css">
    <link rel="stylesheet" href="/<?php echo $this->template_path ; ?>/assets/css/media-box.css">

	<link rel="stylesheet" href="/<?php echo $this->template_path ; ?>/assets/css/skin.css" rel="stylesheet">	
	
	<script src="https://kit.fontawesome.com/b0d9d8ce81.js" crossorigin="anonymous"></script>

    
		
	<?php if (isset( $css_global )) echo $css_global; ?>
	<?php if (isset( $css )) echo $css; ?>
	<?php if (isset( $canonical )) echo $canonical; ?>

     <?php 
	   // if($this->ga_tracking) echo $this->ga_tracking ;
	    if( isset($map['js']) ) echo $map['js']; 
	?>
  </head>
  <body <?php if( isset( $onload ) ) echo $onload; ?>>
	 
    <nav class="menu-classic menu-fixed menu-transparent menu-one-page align-right light" data-menu-anima="fade-bottom" data-scroll-detect="true">
        <div class="container">
            <div class="menu-brand">
                <a href="#">
                    <img class="logo-default" src="/<?php echo $this->template_path ; ?>/assets/media/logo-light-02.svg" alt="logo" />
                    <img class="logo-retina" src="/<?php echo $this->template_path ; ?>/assets/media/logo-light-02.svg" alt="logo" />
                </a>
            </div>
            <i class="menu-btn"></i>
            <div class="menu-cnt">
                <ul>
                    <li>
                        <a href="#overview">Overview</a>
                    </li>
                    <li>
                        <a href="#features">About</a>
                    </li>
                    
                </ul>
                <div class="menu-right">
                    <div class="menu-custom-area">
                        <a class="btn btn-border btn-circle btn-xs" href="#">Contact Us</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </nav>   
    <main>
        <section class="section-image section-full-width light align-center" style="background-image:url(/<?php echo $this->template_path ; ?>/assets/media/bg.svg)">
            <div class="container">
                <hr class="space-lg" />
                <h1 data-anima="fade-in" data-time="1000">
                    SOFTWARE CONSULTING AND DEVELOPMENT<br class="hidden-md" />FOR YOUR DIGITAL SUCCESS
                </h1>
                <p class="width-750" data-anima="fade-in" data-time="1000">
                    With over 20 years of experience in CRM development, Archer Gateway provides software implementation services, including consulting, configuration, customization (tuning the platform and custom development), migration, integration. We also deliver support and evolution services. We help to support sales, service, and marketing efforts for various industries, such as IT, manufacturing, retail, healthcare, finance and banking, public sector, telecoms and more.
                </p>
                <a href="#" class="btn btn-sm btn-circle shadow-1 full-width-sm" data-anima="fade-in" data-time="1000">Learn More</a><span class="space hidden-sm"></span>
                <hr class="space-sm visible-sm" />
                
            </div>
        </section>
        
        <section class="section-base">
            <div class="container">
                <ul class="slider" data-options="type:carousel,arrows:false,nav:false,perView:5,perViewMd:3,perViewSm:2,perViewXs:1,gap:100,autoplay:3000">
                    <li>
                        <img src="/<?php echo $this->template_path ; ?>/assets/media/logos/logo-1.png" alt="" />
                    </li>
                    <li>
                        <img src="/<?php echo $this->template_path ; ?>/assets/media/logos/logo-2.png" alt="" />
                    </li>
                    <li>
                        <img src="/<?php echo $this->template_path ; ?>/assets/media/logos/logo-3.png" alt="" />
                    </li>
                    <li>
                        <img src="/<?php echo $this->template_path ; ?>/assets/media/logos/logo-6.png" alt="" />
                    </li>
                    <li>
                        <img src="/<?php echo $this->template_path ; ?>/assets/media/logos/logo-5.png" alt="" />
                    </li>
                    <li>
                        <img src="/<?php echo $this->template_path ; ?>/assets/media/logos/logo-4.png" alt="" />
                    </li>
                </ul>
                
            </div>
        </section>
        <section id="overview" class="section-base section-color">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <hr class="space-xs" />
                        <h2>Trusted all over the world<br />by a wide range of companies.</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipiscing elitsed do eiusmod tempor incididunt utlabore et dolore magna aliqua.
                            Utenim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquo.
                        </p>
                        <a href="#" class="btn btn-circle btn-sm">View about us</a>
                    </div>
                    <div class="col-lg-6">
                        <hr class="space-sm visible-md" />
                        <table class="table table-grid table-border align-left no-padding-y">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="counter counter-horizontal counter-icon">
                                            <div>
                                                <h3>Downloads</h3>
                                                <div class="value text-lg">
                                                    <span data-to="150" data-speed="3000">150</span>
                                                    <span class="text-md">K</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="counter counter-horizontal counter-icon">
                                            <div>
                                                <h3>Active users</h3>
                                                <div class="value text-lg">
                                                    <span data-to="12" data-speed="3000">12</span>
                                                    <span class="text-md">K</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="counter counter-horizontal counter-icon">
                                            <div>
                                                <h3>Positive reviews</h3>
                                                <div class="value text-lg">
                                                    <span data-to="10" data-speed="3000">10</span>
                                                    <span class="text-md">K</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr class="space space-25" />
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipiscing elitsed do eiusmod tempor incididunt utlabore et dolore magna aliqua.
                            Utenim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquo.
                        </p>
                        <hr class="space space-40" />
                        <a href="#" class="btn btn-border btn-circle btn-sm">View all scores</a>
                    </div>
                </div>
            </div>
        </section>
        
        
        <section id="services" class="section-image light" style="background-image:url(/<?php echo $this->template_path ; ?>/assets/media/bg.svg)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>Up to the mountains<br />is where our numbers bring us.</h2>
                        <p>
                            Lorem ipsum dolor sit ametno sea takimata sanctus est oremipo dolorecante sit amete.
                            Ut enim ad minim veniam aorem exercitation ipsumdolore sit amete sanctus maratallo dolora sitano.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <div class="progress-bar">
                            <h4>Hardware structure</h4>
                            <div>
                                <div data-progress="50">
                                    <span class="counter" data-to="50" data-speed="2000" data-unit="%">30%</span>
                                </div>
                            </div>
                        </div>
                        <hr class="space-sm" />
                        <div class="progress-bar">
                            <h4>Service up time</h4>
                            <div>
                                <div data-progress="99">
                                    <span class="counter" data-to="99" data-speed="2000" data-unit="%">99%</span>
                                </div>
                            </div>
                        </div>
                        <hr class="space-sm" />
                        <div class="progress-bar">
                            <h4>Software driven</h4>
                            <div>
                                <div data-progress="70">
                                    <span class="counter" data-to="70" data-speed="2000" data-unit="%">70%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        <section class="section-base section-color">
            <div class="container">
                <div class="row" data-anima="fade-bottom" data-time="1000">
                    <div class="col-lg-6">
                        <form action="themekit/scripts/contact-form/contact-form.php" class="form-box form-ajax boxed-area" method="post" data-email="example@domain.com">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>First name</p>
                                    <input id="name" name="name" placeholder="Name" type="text" class="input-text" required>
                                </div>
                                <div class="col-lg-6">
                                    <p>Last name</p>
                                    <input id="surname" name="surname" placeholder="Surname" type="text" class="input-text" required>
                                </div>
                                <div class="col-lg-6">
                                    <p>Email</p>
                                    <input id="email" name="email" placeholder="Email" type="email" class="input-text" required>
                                </div>
                                <div class="col-lg-6">
                                    <p>Phone</p>
                                    <input id="phone" name="phone" placeholder="Phone" type="text" class="input-text" required>
                                </div>
                                <div class="col-lg-12">
                                    <p>Address</p>
                                    <input id="Address" name="Address" placeholder="Address" type="text" class="input-text" required>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-circle" type="submit">Send message</button>
                            <div class="form-checkbox">
                                <input type="checkbox" id="check" name="check" value="check" required>
                                <label for="check">You accept the terms of service and the privacy policy</label>
                            </div>
                            <div class="success-box">
                                <div class="alert alert-success">Congratulations. Your message has been sent successfully</div>
                            </div>
                            <div class="error-box">
                                <div class="alert alert-warning">Error, please retry. Your message has not been sent</div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <hr class="space-sm visible-md" />
                        <h2>
                            Start now the adventure by<br />subscribing to our new promotion.
                        </h2>
                        <p>
                            Lorem ipsum dolor sit amet no sea takimata sanctus est Lorem ipsum dolor sit amete
                            sare nostrud exercitation ullamco sea takiquis nostra.
                        </p>
                        <ul class="icon-list icon-circle">
                            <li>Lorem ipsum dolor sit ameteminim verese veniam amoartes.</li>
                            <li>Lorem exercitation ipsum dolor sitta magna doloros.</li>

                        </ul>
                        <hr class="space space-40" />
                        <img src="media/sign-dark.png" alt="" />
                    </div>
                </div>
            </div>
        </section>
    </main>
    <i class="scroll-top-btn scroll-top show"></i>
    <footer class="footer-parallax light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h4>Company and team</h4>
                    <div class="menu-inner menu-inner-vertical">
                        <ul>
                            <li>
                                <a href="#">Company details and team</a>
                            </li>
                            <li>
                                <a href="#">News and blog</a>
                            </li>
                            <li>
                                <a href="#">Press area</a>
                            </li>
                            <li>
                                <a href="#">Affiliates and marketing</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Help and support</h4>
                    <div class="menu-inner menu-inner-vertical">
                        <ul>
                            <li>
                                <a href="#">Help centre</a>
                            </li>
                            <li>
                                <a href="#">Feedbacks</a>
                            </li>
                            <li>
                                <a href="#">Request new features</a>
                            </li>
                            <li>
                                <a href="#">Contact us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Learn more</h4>
                    <div class="menu-inner menu-inner-vertical">
                        <ul>
                            <li>
                                <a href="#">Apps stores</a>
                            </li>
                            <li>
                                <a href="#">Partners</a>
                            </li>
                            <li>
                                <a href="#">Privacy and terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Follow us</h4>
                    <div class="icon-links icon-social icon-links-grid social-colors">
                        <a class="facebook"><i class="icon-facebook"></i></a>
                        <a class="twitter"><i class="icon-twitter"></i></a>
                        <a class="linkedin"><i class="icon-linkedin"></i></a>
                        <a class="youtube"><i class="icon-youtube"></i></a>
                        <a class="instagram"><i class="icon-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bar">
            <div class="container">
                <span>&copy; Archer Gateway <?php echo date('Y'); ?>. All rights reserved.</span>
                <span><img src="/<?php echo $this->template_path ; ?>/assets/media/logo-light-02.svg" /></span>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
	
	<script src="/<?php echo $this->template_path ; ?>/assets/js/parallax.min.js"></script>
        <script src="/<?php echo $this->template_path ; ?>/assets/js/glide.min.js"></script>
        <script src="/<?php echo $this->template_path ; ?>/assets/js/magnific-popup.min.js"></script>
        <script src="/<?php echo $this->template_path ; ?>/assets/js/tab-accordion.js"></script>
        <script src="/<?php echo $this->template_path ; ?>/assets/js/pagination.min.js"></script>
        <script src="/<?php echo $this->template_path ; ?>/assets/js/imagesloaded.min.js"></script>
        <script src="/<?php echo $this->template_path ; ?>/assets/js/contact-form/contact-form.js"></script>
        <script src="/<?php echo $this->template_path ; ?>/assets/js/progress.js"></script>
        <script src="/<?php echo $this->template_path ; ?>/assets/media/custom.js"></script>
	
	<script src="/<?php echo $this->template_path ; ?>/assets/media/custom.js"></script>

    <?php 
	    if (isset( $js_global )) echo $js_global; 
	    if (isset( $js )) echo $js;
	    
    ?>

  </body>
</html>