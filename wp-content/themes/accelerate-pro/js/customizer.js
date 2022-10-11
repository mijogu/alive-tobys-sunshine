/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function ( $ ) {
	// Site title
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Site layout
	wp.customize( 'accelerate[accelerate_site_layout]', function ( value ) {
		value.bind( function ( layout ) {
			var layout_options = layout;
			if ( layout_options == 'wide' ) {
				$( 'body' ).addClass( 'wide' );
			} else if ( layout == 'box' ) {
				$( 'body' ).removeClass( 'wide' );
			}
		} );
	} );

	/**
	 * Header font size
	 */
	// Site title
	wp.customize( 'accelerate[accelerate_site_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '#site-title a' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Site tagline
	wp.customize( 'accelerate[accelerate_tagline_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '#site-description' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Primary menu
	wp.customize( 'accelerate[accelerate_primary_menu_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.main-navigation ul li a' ).not( '.main-navigation ul li ul li a' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Primary sub menu
	wp.customize( 'accelerate[accelerate_primary_sub_menu_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.main-navigation ul li ul li a' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Header menu
	wp.customize( 'accelerate[accelerate_header_menu_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.small-menu ul li a' ).not( '.small-menu ul li ul li a' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Header sub menu
	wp.customize( 'accelerate[accelerate_header_sub_menu_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.small-menu ul li ul li a' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	/**
	 * Slider font size
	 */
	// Slider title
	wp.customize( 'accelerate[accelerate_slider_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.slider-title-head .entry-title a' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Slider content
	wp.customize( 'accelerate[accelerate_slider_content_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '#featured-slider .entry-content p' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	/**
	 * Titles related font size
	 */
	// Heading h1 tag
	wp.customize( 'accelerate[accelerate_h1_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( 'h1' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Heading h2 tag
	wp.customize( 'accelerate[accelerate_h2_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( 'h2' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Heading h3 tag
	wp.customize( 'accelerate[accelerate_h3_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( 'h3' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Heading h4 tag
	wp.customize( 'accelerate[accelerate_h4_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( 'h4' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Heading h5 tag
	wp.customize( 'accelerate[accelerate_h5_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( 'h5' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Heading h6 tag
	wp.customize( 'accelerate[accelerate_h6_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( 'h6' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// TG: Image Services widget title
	wp.customize( 'accelerate[accelerate_image_service_widget_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.widget_image_service_block .entry-title' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// TG: Call to Action widget title
	wp.customize( 'accelerate[accelerate_call_to_action_widget_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.call-to-action-content h3' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// TG: Featured Widget titles that appear over images
	wp.customize( 'accelerate[accelerate_featured_widget_titles_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.widget_recent_work .recent_work_title .title_box h5' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Widget Titles
	wp.customize( 'accelerate[accelerate_widget_titles_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '#secondary h3.widget-title' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Post Title
	wp.customize( 'accelerate[accelerate_post_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.post .entry-title' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Page Title
	wp.customize( 'accelerate[accelerate_page_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.type-page .entry-title' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Comment Title
	wp.customize( 'accelerate[accelerate_comment_title_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.comments-title, .comment-reply-title' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	/**
	 * Content font size options
	 */
	// Content font size
	wp.customize( 'accelerate[accelerate_content_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( 'body, button, input, select, textarea, p, dl, .accelerate-button, input[type="reset"], input[type="button"], input[type="submit"], button, .previous a, .next a, .widget_testimonial .testimonial-author span, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, #secondary .widget, .error-404 .widget' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Post meta font size: author and categories
	wp.customize( 'accelerate[accelerate_post_meta_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.entry-meta' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Post meta font size: other than author and categories
	wp.customize( 'accelerate[accelerate_other_post_meta_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.entry-meta .posted-on, .entry-meta .comments-link, .entry-meta .edit-link, .entry-meta .tag-links' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	/**
	 * Footer font size options
	 */
	// Footer widget Titles
	wp.customize( 'accelerate[accelerate_footer_widget_titles_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '#colophon .widget-title' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Footer widget content
	wp.customize( 'accelerate[accelerate_footer_widget_content_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '#colophon, #colophon p' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Footer copyright text
	wp.customize( 'accelerate[accelerate_footer_copyright_text_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '.footer-socket-wrapper .copyright' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Footer small menu
	wp.customize( 'accelerate[accelerate_small_footer_menu_font_size]', function ( value ) {
		value.bind( function ( fontSize ) {
			$( '#colophon .footer-menu a' ).css( 'fontSize', parseInt( fontSize ) );
		} );
	} );

	// Site title color.
	wp.customize( 'accelerate[accelerate_site_title_text_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-title a' ).css( 'color', to );
		} );
	} );

	// Site tagline color.
	wp.customize( 'accelerate[accelerate_site_tagline_text_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-description' ).css( 'color', to );
		} );
	} );

	// Primary menu text color.
	wp.customize( 'accelerate[accelerate_primary_menu_text_color]', function ( value ) {
		value.bind( function ( to ) {
			$( ' .main-navigation a, .main-navigation ul li ul li a, .main-navigation ul li.current-menu-item ul li a, .main-navigation ul li ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor ul li a, .main-navigation ul li.current-menu-ancestor ul li a, .main-navigation ul li.current_page_item ul li a ' ).css( 'color', to );
		} );
	} );

	// Primary menu background color.
	wp.customize( 'accelerate[accelerate_primary_menu_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a, .main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover ' ).css( 'background-color', to );
		} );
	} );

	// Primary menu bar background color.
	wp.customize( 'accelerate[accelerate_primary_menu_bar_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.main-navigation, .main-navigation ul li ul li a, .main-navigation ul li.current-menu-item ul li a, .main-navigation ul li ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor ul li a,\n.main-navigation ul li.current-menu-ancestor ul li a, .main-navigation ul li.current_page_item ul li a,\n.main-navigation .menu-toggle, .main-small-navigation .menu-toggle, .main-small-navigation ul li ul li a, .main-small-navigation ul li.current-menu-item ul li a, .main-small-navigation ul li ul li.current-menu-item a, .main-small-navigation ul li.current_page_ancestor ul li a, .main-small-navigation li' ).css( 'background-color', to );
		} );
	} );

	// Header background color.
	wp.customize( 'accelerate[accelerate_header_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( ' #header-text-nav-container' ).css( 'background-color', to );
		} );
	} );

	// Header top bar background color.
	wp.customize( 'accelerate[accelerate_header_top_bar_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '#header-meta' ).css( 'background-color', to );
		} );
	} );

	// Top menu item color.
	wp.customize( 'accelerate[accelerate_top_menu_item_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.small-menu a, .small-menu ul li ul li a, .small-menu ul li.current-menu-item ul li a, .small-menu ul li ul li.current-menu-item a, .small-menu ul li.current_page_ancestor ul li a, .small-menu ul li.current-menu-ancestor ul li a, .small-menu ul li.current_page_item ul li a ' ).css( 'color', to );
		} );
	} );

	// Top menu selected item color.
	wp.customize( 'accelerate[accelerate_top_menu_selected_item_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a,.small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a, .small-menu ul li:hover > a, .small-menu ul li ul li a:hover, .small-menu ul li ul li:hover > a, .small-menu ul li.current-menu-item ul li a:hover' ).css( 'background-color', to );
		} );
	} );

	//Top menu dropdown background color.
	wp.customize( 'accelerate[accelerate_top_menu_dropdown_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.small-menu ul li ul li a, .small-menu ul li.current-menu-item ul li a, .small-menu ul li ul li.current-menu-item a, .small-menu ul li.current_page_ancestor ul li a, .small-menu ul li.current-menu-ancestor ul li a, .small-menu ul li.current_page_item ul li a' ).css( 'background-color', to );
		} );
	} );

	// Header top line color.
	wp.customize( 'accelerate[accelerate_header_top_line_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '#page' ).css( 'border-top-color', to );
		} );
	} );

	// Slider title color.
	wp.customize( 'accelerate[accelerate_slider_title_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.slider-title-head .entry-title a' ).css( 'color', to );
		} );
	} );

	// Slider title background color.
	wp.customize( 'accelerate[accelerate_slider_title_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.slider-title-head .entry-title a' ).css( 'background-color', to );
		} );
	} );

	// Slider content color.
	wp.customize( 'accelerate[accelerate_slider_content_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '#featured-slider .entry-content' ).css( 'color', to );
		} );
	} );

	// Slider background color.
	wp.customize( 'accelerate[accelerate_slider_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '#featured-slider, #featured-slider .slider-cycle' ).css( 'color', to );
		} );
	} );

	// Content Part titles color.
	wp.customize( 'accelerate[accelerate_content_part_titles_color]', function ( value ) {
		value.bind( function ( to ) {
			$( 'h1, h2, h3, h4, h5, h6, .widget_our_clients .widget-title, .widget_recent_work .widget-title,.widget_image_service_block .entry-title a, .widget_featured_posts .widget-title' ).css( 'color', to );
		} );
	} );

	// Posts title color.
	wp.customize( 'accelerate[accelerate_posts_title_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.post .entry-title, .post .entry-title a, .widget_featured_posts .tg-one-half .entry-title a' ).css( 'color', to );
		} );
	} );

	// Page title color.
	wp.customize( 'accelerate[accelerate_page_title_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.type-page .entry-title' ).css( 'color', to );
		} );
	} );

	// Content text color.
	wp.customize( 'accelerate[accelerate_content_text_color]', function ( value ) {
		value.bind( function ( to ) {
			$( 'body, button, input, select, textarea' ).css( 'color', to );
		} );
	} );

	// Post meta (author and category) color.
	wp.customize( 'accelerate[accelerate_post_meta_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.entry-meta .byline i, .entry-meta .cat-links i, .related-posts-wrapper .entry-meta .byline a, .entry-meta a' ).css( 'color', to );
		} );
	} );

	// Post meta (other than author and category) color.
	wp.customize( 'accelerate[accelerate_post_other_meta_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.entry-meta .posted-on a, .entry-meta .comments-link a, .entry-meta .edit-link a, .entry-meta .tag-links a' ).css( 'color', to );
		} );
	} );

	// Button text color.
	wp.customize( 'accelerate[accelerate_button_text_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.accelerate-button, input[type="reset"], input[type="button"], input[type="submit"], button, .read-more, .more-link span' ).css( 'color', to );
		} );
	} );

	// Button background color.
	wp.customize( 'accelerate[accelerate_button_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.accelerate-button, input[type="reset"], input[type="button"], input[type="submit"], button, .read-more, .more-link span' ).css( 'background-color', to );
		} );
	} );

	// Left and Right sidebar widget title color.
	wp.customize( 'accelerate[accelerate_widget_title_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '#secondary h3.widget-title' ).css( 'color', to );
		} );
	} );

	// Content section background color.
	wp.customize( 'accelerate[accelerate_content_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '#main' ).css( 'background-color', to );
		} );
	} );

	// TG: Call to Action widget background color.
	wp.customize( 'accelerate[accelerate_call_to_action_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.call-to-action-content-wrapper' ).css( 'background-color', to );
		} );
	} );

	// TG: Testimonial widget text background color
	wp.customize( 'accelerate[accelerate_testimonial_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.widget_testimonial .testimonial-post' ).css( 'background-color', to );
		} );
	} );

	// Widget title color.
	wp.customize( 'accelerate[accelerate_footer_widget_title_color]', function ( value ) {
		value.bind( function ( to ) {
			$( 'accelerate_footer_widget_content_color' ).css( 'color', to );
		} );
	} );

	// Footer widget content color.
	wp.customize( 'accelerate[accelerate_footer_widget_link_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.footer-widgets-area a' ).css( 'background-color', to );
		} );
	} );
	// Footer widget content link text color.
	wp.customize( 'accelerate[accelerate_footer_widget_content_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.footer-widgets-area, .footer-widgets-area p' ).css( 'background-color', to );
		} );
	} );
	// Footer widget background color.
	wp.customize( 'accelerate[accelerate_footer_widget_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.footer-widgets-wrapper' ).css( 'background-color', to );
		} );
	} );
	// Footer copyright text color.
	wp.customize( 'accelerate[accelerate_footer_copyright_text_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.footer-socket-wrapper .copyright' ).css( 'color', to );
		} );
	} );
	// Footer small menu text color.
	wp.customize( 'accelerate[accelerate_footer_small_menu_color]', function ( value ) {
		value.bind( function ( to ) {
			$( '.footer-menu a' ).css( 'color', to );
		} );
	} );
	// Footer copyright part background color.
	wp.customize( 'accelerate[accelerate_footer_copyright_part_background_color]', function ( value ) {
		value.bind( function ( to ) {
			$( 'footer-socket-wrapper' ).css( 'background-color', to );
		} );
	} );

	/**
	 * Primary color option
	 */
	wp.customize( 'accelerate[accelerate_primary_color]', function ( value ) {
		value.bind( function ( primaryColor ) {

			// Store internal style for primary color
			var primaryColorStyle = '<style id="accelerate-internal-primary-color">.accelerate-button,blockquote,button,input[type=button],input[type=reset],input[type=submit]{background-color:' + primaryColor + '}' +
				'#site-title a:hover,.next a:hover,.previous a:hover,a{color:' + primaryColor + '}' +
				'#search-form span,.main-navigation a:hover,.main-navigation ul li ul li a:hover,.main-navigation ul li ul li:hover>a,.main-navigation ul li.current-menu-ancestor a,.main-navigation ul li.current-menu-item a,.main-navigation ul li.current-menu-item ul li a:hover,.main-navigation ul li.current_page_ancestor a,.main-navigation ul li.current_page_item a,.main-navigation ul li:hover>a,.main-small-navigation li:hover > a,.main-navigation ul ul.sub-menu li.current-menu-ancestor> a,.main-navigation ul li.current-menu-ancestor li.current_page_item> a{background-color:' + primaryColor + '}' +
				'.site-header .menu-toggle:before{color:' + primaryColor + '}' +
				'.main-small-navigation li a:hover,.widget_team_block .more-link{background-color:' + primaryColor + '}' +
				'.main-small-navigation .current-menu-item a,.main-small-navigation .current_page_item a,.team-title::b {background:' + primaryColor + '}' +
				'.footer-menu a:hover,.footer-menu ul li.current-menu-ancestor a,.footer-menu ul li.current-menu-item a,.footer-menu ul li.current_page_ancestor a,.footer-menu ul li.current_page_item a,.footer-menu ul li:hover>a,.widget_team_block .team-title:hover>a{color:' + primaryColor + '}' +
				'a.slide-prev,a.slide-next,.slider-title-head .entry-title a{background-color:' + primaryColor + '}' +
				'#controllers a.active,#controllers a:hover,.widget_team_block .team-social-icon a:hover{background-color:' + primaryColor + ';color:' + primaryColor + '}' +
				'.format-link .entry-content a{background-color:' + primaryColor + '}' +
				'.tg-one-fourth .widget-title a:hover,.tg-one-half .widget-title a:hover,.tg-one-third .widget-title a:hover,.widget_featured_posts .tg-one-half .entry-title a:hover,.widget_image_service_block .entry-title a:hover,.widget_service_block i.fa,.widget_fun_facts .counter-icon i{color:' + primaryColor + '}' +
				'#content .wp-pagenavi .current,#content .wp-pagenavi a:hover,.pagination span{background-color:' + primaryColor + '}' +
				'.pagination a span:hover{color:' + primaryColor + ';border-color:' + primaryColor + '}' +
				'#content .comments-area a.comment-edit-link:hover,#content .comments-area a.comment-permalink:hover,#content .comments-area article header cite a:hover,.comments-area .comment-author-link a:hover,.widget_testimonial .testimonial-icon:before,.widget_testimonial i.fa-quote-left{color:' + primaryColor + '}' +
				'#wp-calendar #today,.comment .comment-reply-link:hover,.nav-next a:hover,.nav-previous a:hover{color:' + primaryColor + '}' +
				'.widget-title span{border-bottom:2px solid ' + primaryColor + '}' +
				'#secondary h3 span:before,.footer-widgets-area h3 span:before{color:' + primaryColor + '}' +
				'#secondary .accelerate_tagcloud_widget a:hover,.footer-widgets-area .accelerate_tagcloud_widget a:hover{background-color:' + primaryColor + '}' +
				'.footer-socket-wrapper .copyright a:hover,.footer-widgets-area a:hover{color:' + primaryColor + '}' +
				'a#scroll-up{background-color:' + primaryColor + '}' +
				'.entry-meta .byline i,.entry-meta .cat-links i,.entry-meta a,.post .entry-title a:hover{color:' + primaryColor + '}' +
				'.entry-meta .post-format i{background-color:' + primaryColor + '}' +
				'.entry-meta .comments-link a:hover,.entry-meta .edit-link a:hover,.entry-meta .posted-on a:hover,.entry-meta .tag-links a:hover{color:' + primaryColor + '}' +
				'.more-link span,.read-more{background-color:' + primaryColor + '}' +
				'.single #content .tags a:hover{color:' + primaryColor + '}' +
				'#page{border-top:3px solid ' + primaryColor + '}' +
				'.nav-menu li a:hover,.top-menu-toggle:before{color:' + primaryColor + '}' +
				'.footer-socket-wrapper{border-top: 3px solid ' + primaryColor + ';}' +
				'.comments-area .comment-author-link span,{background-color:' + primaryColor + '}' +
				'.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button,main-navigation li.menu-item-has-children:hover, .main-small-navigation .current_page_item > a, .main-small-navigation .current-menu-item > a { background-color: ' + primaryColor + '; }' +
				'@media( max-width: 1024px ) and ( min-width: 768px ){ .main-navigation li.menu-item-has-children:hover,.main-navigation li.current_page_item{background:' + primaryColor + ';}}' +
				'.widget_our_clients .clients-cycle-prev, .widget_our_clients .clients-cycle-next{background-color:' + primaryColor + '}</style>';

			// Remove previously create internal style and add new one.
			$( 'head #accelerate-internal-primary-color' ).remove();
			$( 'head' ).append( primaryColorStyle );

		} );

	} );

	// For footer copyright alignment.
	wp.customize( 'accelerate[accelerate_footer_copyright_alignment_setting]', function ( value ) {
		value.bind( function ( layout ) {
				var layout_options = layout;

				if ( layout_options == 'left' ) {
					$( '.footer-socket-wrapper' ).removeClass( 'copyright-center copyright-right' );
				} else if ( layout_options == 'center' ) {
					$( '.footer-socket-wrapper' ).addClass( 'copyright-center' ).removeClass( 'copyright-right' );
				} else if ( layout_options == 'right' ) {
					$( '.footer-socket-wrapper' ).addClass( 'copyright-right' ).removeClass( 'copyright-center' );
				}
			}
		);
	} );

} )( jQuery );
