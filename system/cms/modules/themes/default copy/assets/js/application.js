s// IIFE with jQuery Wrapper
(function ($) {
    "use strict";

    // Script handler
    $(window).on('load', function () {
        bpCounterUphendle();
        bpMixProjects();
        bpMenuareaFixed();
        bpMenuarea2Fixed();
        bpMenuarea3Fixed();
    });

    // Site Preloader
    $(window).on ('load', function (){ // makes sure the whole site is loaded
        $('#loader').fadeOut(); // will first fade out the loading animation
        $('#loader-wrapper').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({'overflow':'visible'});
    })




    // stellarnav DropDown Menu
    $('.stellarnav').stellarNav({
        breakpoint: 991,
    });


    // home 1 sticky
    function bpMenuareaFixed() {
        if ($('.h1-navigation-area').length) {
            $(window).on('scroll', function () {
                if ($(window).scrollTop() > 140) {
                    $('.h1-navigation-area').addClass('navbar-fixed-top');
                } else {
                    $('.h1-navigation-area').removeClass('navbar-fixed-top');
                }
            });
        }
    }

    // home 2 sticky
    function bpMenuarea2Fixed() {
        if ($('.h2-navigation-area').length) {
            $(window).on('scroll', function () {
                if ($(window).scrollTop() > 140) {
                    $('.h2-navigation-area').addClass('navbar-fixed-top');
                } else {
                    $('.h2-navigation-area').removeClass('navbar-fixed-top');
                }
            });
        }
    }

    // home 2 sticky
    function bpMenuarea3Fixed() {
        if ($('.h3-navigation-area').length) {
            $(window).on('scroll', function () {
                if ($(window).scrollTop() > 140) {
                    $('.h3-navigation-area').addClass('navbar-fixed-top');
                } else {
                    $('.h3-navigation-area').removeClass('navbar-fixed-top');
                }
            });
        }
    }


     // counter
    function bpCounterUphendle() {
        $('.counter').counterUp();
    };

    // MixItUp Activation
    function bpMixProjects() {
        if ( $('#mixitup-projects').length != 0 ) {
          var containerEl = document.querySelector('#mixitup-projects');
          var mixer = mixitup(containerEl, {
              selectors: {
                  control: '[data-mixitup-control]'
              }
          })
        }
    };
    
    function slider_area() {
        var owl = $(".slider-area");
        owl.owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navigation: false,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 1,
            smartSpeed: 1000,
            dots: true,
            autoplay: true,
	        autoplaySpeed: 1000,
	        autoplayTimeout: 8000,
	        autoplayHoverPause: false,
	        lazyLoadEager: 3,
            center: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 1
                }
            }
        });
    }
    slider_area();

    // h3 slider
    function h3_slider_area() {
        var owl = $("#main-slider");
        owl.owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 1,
            smartSpeed: 1000,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            center: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 1
                }
            }
        });
    }
    h3_slider_area();

    // h1 blog carousel
    function h1_blog_carousels() {
        var owl = $("#blog-list");
        owl.owlCarousel({
            loop: false,
            margin: 30,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: true,
            items: 3,
            smartSpeed: 1000,
            dots: false,
            autoplay: false,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 2
                },
                980: {
                    items: 3
                }
            }
        });
    }
    h1_blog_carousels();

    // h2 blog carousel
    function h2_blog_carousel() {
        var owl = $("#blog-list-2");
        owl.owlCarousel({
            loop: true,
            margin: 30,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: true,
            items: 2,
            smartSpeed: 1000,
            dots: false,
            autoplay: false,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 2
                }
            }
        });
    }
    h2_blog_carousel();

    // h2 blog carousel
    function h3_blog_carousel() {
        var owl = $("#blog-list-3");
        owl.owlCarousel({
            loop: true,
            margin: 30,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: true,
            items: 2,
            smartSpeed: 1000,
            dots: false,
            autoplay: false,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 2
                }
            }
        });
    }
    h3_blog_carousel();

    // h1 Testimonial Carousel
    function h1_testimonial_carousels() {
        var owl = $("#testimonial-items");
        owl.owlCarousel({
            loop: true,
            margin: 30,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: true,
            items: 2,
            smartSpeed: 1000,
            dots: false,
            autoplay: false,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 2
                }
            }
        });
    }
    h1_testimonial_carousels();

    // h2 Testimonial Carousel
    function h2_testimonial_carousels() {
        var owl = $("#h2-testimonial-items");
        owl.owlCarousel({
            loop: true,
            margin: 30,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: true,
            items: 2,
            smartSpeed: 1000,
            dots: false,
            autoplay: false,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 2
                }
            }
        });
    }
    h2_testimonial_carousels();

    // h3 Testimonial Carousel
    function h3_testimonial_carousels() {
        var owl = $("#h3-testimonial-items");
        owl.owlCarousel({
            loop: true,
            margin: 30,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 2,
            smartSpeed: 1000,
            dots: true,
            autoplay: false,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 2
                }
            }
        });
    }
    h3_testimonial_carousels();

    // client-carousel-items
    function dustrial_client_carousel() {
        var owl = $("#client-carousel-items");
        owl.owlCarousel({
            loop: true,
            responsiveClass: true,
            navigation: false,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 5,
            smartSpeed: 1000,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 3
                },
                760: {
                    items: 3
                },
                992: {
                    items: 5
                },
            }
        });
    }
    dustrial_client_carousel();

    // Elements Animation
    if($('.wow').length){
        var wow = new WOW(
          {
            boxClass:     'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset:       0,          // distance to the element when triggering the animation (default is 0)
            mobile:       true,       // trigger animations on mobile devices (default is true)
            live:         true       // act on asynchronously loaded content (default is true)
          }
        );
        wow.init();
    }

    // Magnific Popup
    $('#inline-popups').magnificPopup({
      delegate: 'a',
      removalDelay: 500, //delay removal by X to allow out-animation
      callbacks: {
        beforeOpen: function() {
           this.st.mainClass = this.st.el.attr('data-effect');
        }
      },
      midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
    });

    // Inline popups
    $('.popup-vimeo, .popup-gmaps').magnificPopup({
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,

      fixedContentPos: false
    });
    
    
    $('.popup-youtube').magnificPopup({
	    // your default config here
		type: 'iframe',
	      mainClass: 'mfp-fade',
	      removalDelay: 160,
	      preloader: false,
	
	      fixedContentPos: false,
	    // All below settings are default except the rel attribute in youtube-src
	    // This is here to remove the related videos from showing up after the video ends
	    // Adding rel=0 from url in html template stopped autoplay, hence this hack
	    iframe: {
	      markup: '<div class="mfp-iframe-scaler">'+
	        '<div class="mfp-close"></div>'+
	        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
	        '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
	
	      patterns: {
	        youtube: {
	          index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
	
	          id: 'v=', // String that splits URL in a two parts, second part should be %id%
	          // Or null - full URL will be returned
	          // Or a function that should return %id%, for example:
	          // id: function(url) { return 'parsed id'; }
	
	          src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0' // URL that will be set as a source for iframe.
	        }
	      }
	    }
	});



    // Line Bar Progressbar
    $('#bar1').barfiller();
    $('#bar2').barfiller();
    $('#bar3').barfiller();
    $('#bar4').barfiller();
    
    $("a[rel*=external]").click(function () {
	    window.open(this.href);
	    return false
	});
	
	$('a.back').click(function(){
        parent.history.back();
        return false;
    });

}(jQuery));