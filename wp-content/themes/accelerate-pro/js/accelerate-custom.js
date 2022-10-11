/* global accelerate_slider_value */
jQuery( document ).ready( function () {
	jQuery( '#scroll-up' ).hide();
	jQuery( function () {
		jQuery( window ).scroll( function () {
			if ( jQuery( this ).scrollTop() > 1000 ) {
				jQuery( '#scroll-up' ).fadeIn();
			} else {
				jQuery( '#scroll-up' ).fadeOut();
			}
		} );
		jQuery( 'a#scroll-up' ).click( function () {
			jQuery( 'body,html' ).animate( {
				scrollTop : 0
			}, 800 );
			return false;
		} );
	} );

	// CounterUP
	if ( typeof jQuery.fn.counterUp !== 'undefined' ) {
		jQuery( '.counter' ).counterUp( {
			delay : 10,
			time  : 1000
		} );
	}

	// fixed sidebar js
	if ( ( typeof jQuery.fn.theiaStickySidebar !== 'undefined' ) && ( typeof ResizeSensor !== 'undefined' ) ) {
		jQuery( '#primary, #secondary' ).theiaStickySidebar( {
			additionalMarginTop : 40
		} );
	}

	// Setting for sticky menu.
	if ( typeof jQuery.fn.sticky !== 'undefined' ) {
		var wpAdminBar = jQuery( '#wpadminbar' );
		if ( wpAdminBar.length ) {
			jQuery( '#site-navigation' ).sticky( {
				topSpacing : wpAdminBar.height(),
				zIndex: 9999
			} );
		} else {
			jQuery( '#site-navigation' ).sticky( {
				topSpacing : 0,
				zIndex: 9999
			} );
		}
	}
} );

jQuery( window ).on( 'load', function () {
	//Slider Setting
	if ( typeof jQuery.fn.cycle !== 'undefined' ) {
		var slides = jQuery( '.slider-rotate' ).children().length;
		if ( slides <= 1 ) {
			jQuery( '.slide-next, .slide-prev' ).css( 'display', 'none' );
		}

		if ( typeof accelerate_slider_value !== 'undefined' ) {
			var transition_effect   = accelerate_slider_value.transition_effect;
			var transition_delay    = accelerate_slider_value.transition_delay;
			var transition_duration = accelerate_slider_value.transition_duration;
			jQuery( '.slider-rotate' ).cycle( {
				fx                : transition_effect,
				timeout           : parseInt( transition_delay ),
				speed             : parseInt( transition_duration ),
				slides            : '> div',
				pager             : '> #controllers',
				pagerActiveClass  : 'active',
				pagerTemplate     : '<a></a>',
				prev              : '.slide-prev',
				next              : '.slide-next',
				pause             : 1,
				pauseOnPagerHover : 1,
				width             : '100%',
				containerResize   : 0,
				autoHeight        : 'container',
				fit               : 1,
				after             : function () {
					jQuery( this ).parent().css( 'height', jQuery( this ).height() );
				},
				cleartypeNoBg     : true,
				log               : false,
				swipe             : true
			} );
		};

		// Clients carousel
		function initCycle() {
			var width = jQuery( document ).width(); // Getting the width and checking my layout
			if ( width < 400 ) {
				jQuery( '.accelerate_clients_wrap' ).cycle( {
					carouselVisible : 1,
					swipe           : true
				} );
			} else if ( width > 400 && width < 600 ) {
				jQuery( '.accelerate_clients_wrap' ).cycle( {
					carouselVisible : 2,
					swipe           : true
				} );
			} else if ( width > 600 && width < 768 ) {
				jQuery( '.accelerate_clients_wrap' ).cycle( {
					carouselVisible : 3,
					swipe           : true
				} );
			} else if ( width > 768 && width < 992 ) {
				jQuery( '.accelerate_clients_wrap' ).cycle( {
					carouselVisible : 4,
					swipe           : true
				} );
			} else {
				jQuery( '.accelerate_clients_wrap' ).cycle( {
					carouselVisible : 5,
					swipe           : true
				} );
			}
		}

		initCycle();

		function reinit_cycle() {
			var width = jQuery( window ).width(); // Checking size again after window resize
			if ( width < 400 ) {
				jQuery( '.accelerate_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 1 );
			} else if ( width > 400 && width < 600 ) {
				jQuery( '.accelerate_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 2 );
			} else if ( width > 600 && width < 768 ) {
				jQuery( '.accelerate_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 3 );
			} else if ( width > 768 && width < 992 ) {
				jQuery( '.accelerate_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 4 );
			} else {
				jQuery( '.accelerate_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 5 );
			}
		}

		function reinitCycle( visibleSlides ) {
			jQuery( '.accelerate_clients_wrap' ).cycle( {
				carouselVisible : visibleSlides,
				swipe           : true
			} );
		}

		var reinitTimer;
		jQuery( window ).resize( function () {
			clearTimeout( reinitTimer );
			reinitTimer = setTimeout( reinit_cycle, 100 ); // Timeout limits the number of calculations
		} );
		// Complete clients carousel
	}

	if ( typeof jQuery.fn.masonry !== 'undefined' ) {
		// Masonry JS.
		jQuery('.blog-masonry #content').masonry({

			// options.
			itemSelector: '.hentry',

		});
	}
} );
