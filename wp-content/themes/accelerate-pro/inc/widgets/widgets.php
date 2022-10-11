<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package    ThemeGrill
 * @subpackage Accelerate Pro
 * @since      Accelerate Pro 1.0
 */

add_action( 'widgets_init', 'accelerate_widgets_init' );
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function accelerate_widgets_init() {

	// Registering main right sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'accelerate' ),
		'id'            => 'accelerate_right_sidebar',
		'description'   => esc_html__( 'Shows widgets at Right side.', 'accelerate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering main left sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'accelerate' ),
		'id'            => 'accelerate_left_sidebar',
		'description'   => esc_html__( 'Shows widgets at Left side.', 'accelerate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering Header sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Header Sidebar', 'accelerate' ),
		'id'            => 'accelerate_header_sidebar',
		'description'   => esc_html__( 'Shows widgets in header section just above the main navigation menu.', 'accelerate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering Business Page template sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Business Sidebar', 'accelerate' ),
		'id'            => 'accelerate_business_sidebar',
		'description'   => esc_html__( 'Shows widgets on Business Page Template.', 'accelerate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Business Sidebar Two', 'accelerate' ),
		'id'            => 'accelerate_business_sidebar_2',
		'description'   => esc_html__( 'Shows widgets on Business Template Two.', 'accelerate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Business Sidebar Three', 'accelerate' ),
		'id'            => 'accelerate_business_sidebar_3',
		'description'   => esc_html__( 'Shows widgets on Business Template Three.', 'accelerate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Business Sidebar Four', 'accelerate' ),
		'id'            => 'accelerate_business_sidebar_4',
		'description'   => esc_html__( 'Shows widgets on Business Template Four.', 'accelerate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Business Sidebar Five', 'accelerate' ),
		'id'            => 'accelerate_business_sidebar_5',
		'description'   => esc_html__( 'Shows widgets on Business Template Five.', 'accelerate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering contact Page sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Page Sidebar', 'accelerate' ),
		'id'            => 'accelerate_contact_page_sidebar',
		'description'   => esc_html__( 'Shows widgets on Contact Page Template.', 'accelerate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering Error 404 Page sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Error 404 Page Sidebar', 'accelerate' ),
		'id'            => 'accelerate_error_404_page_sidebar',
		'description'   => esc_html__( 'Shows widgets on Error 404 page.', 'accelerate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar one
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar One', 'accelerate' ),
		'id'            => 'accelerate_footer_sidebar_one',
		'description'   => esc_html__( 'Shows widgets at footer sidebar one.', 'accelerate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Custom footer sidebar column select
	$sidebar_num = accelerate_options( 'accelerate_footer_widget_column_select_type', 'three' );
	if ( $sidebar_num == 'four' || $sidebar_num == 'three' || $sidebar_num == 'two' || $sidebar_num == 'two-style-1' || $sidebar_num == 'two-style-2' || $sidebar_num == 'three-style-1' || $sidebar_num == 'three-style-2' || $sidebar_num == 'three-style-3' || $sidebar_num == 'four-style-1' || $sidebar_num == 'four-style-2' ) {
		// Registering footer sidebar two
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar Two', 'accelerate' ),
			'id'            => 'accelerate_footer_sidebar_two',
			'description'   => esc_html__( 'Shows widgets at footer sidebar two.', 'accelerate' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	if ( $sidebar_num == 'four' || $sidebar_num == 'three' || $sidebar_num == 'three-style-1' || $sidebar_num == 'three-style-2' || $sidebar_num == 'three-style-3' || $sidebar_num == 'four-style-1' || $sidebar_num == 'four-style-2' ) {
		// Registering footer sidebar three
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar Three', 'accelerate' ),
			'id'            => 'accelerate_footer_sidebar_three',
			'description'   => esc_html__( 'Shows widgets at footer sidebar three.', 'accelerate' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	if ( $sidebar_num == 'four' || $sidebar_num == 'four-style-1' || $sidebar_num == 'four-style-2' ) {
		// Registering footer sidebar four
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar Four', 'accelerate' ),
			'id'            => 'accelerate_footer_sidebar_four',
			'description'   => esc_html__( 'Shows widgets at footer sidebar four.', 'accelerate' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	// Registering sidebar for WooCommerce pages.
	if ( ( accelerate_options( 'accelerate_woocommerce_sidebar_register_setting', 0 ) == 1 ) && class_exists( 'WooCommerce' ) ) {
		// Registering WooCommerce Right Sidebar.
		register_sidebar( array(
			'name'          => esc_html__( 'WooCommerce Right Sidebar', 'accelerate' ),
			'id'            => 'accelerate_woocommerce_right_sidebar',
			'description'   => esc_html__( 'Shows widgets at WooCommerce Right sidebar.', 'accelerate' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );

		// Registering WooCommerce Left Sidebar.
		register_sidebar( array(
			'name'          => esc_html__( 'WooCommerce Left Sidebar', 'accelerate' ),
			'id'            => 'accelerate_woocommerce_left_sidebar',
			'description'   => esc_html__( 'Shows widgets at WooCommerce Left sidebar.', 'accelerate' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	// Registering widgets.
	register_widget( 'accelerate_featured_single_page_widget' );
	register_widget( 'accelerate_call_to_action_widget' );
	register_widget( 'accelerate_testimonial_widget' );
	register_widget( 'accelerate_recent_work_widget' );
	register_widget( 'accelerate_image_service_widget' );
	register_widget( 'accelerate_featured_posts_widget' );
	register_widget( 'accelerate_our_clients_widget' );
	register_widget( 'accelerate_custom_tag_widget' );
	register_widget( 'accelerate_fun_facts_widget' );
	register_widget( 'accelerate_team_widget' );
	register_widget( 'accelerate_pricing_table_widget' );
}

// Require file for TG: Featured Single Page.
require ACCELERATE_WIDGETS_DIR . '/accelerate-featured-single-page-widget.php';

// Require file for TG: Call To Action Widget.
require ACCELERATE_WIDGETS_DIR . '/accelerate-call-to-action-widget.php';

// Require file for TG: Testimonial.
require ACCELERATE_WIDGETS_DIR . '/accelerate-testimonial-widget.php';

// Require file for TG: Featured Widget.
require ACCELERATE_WIDGETS_DIR . '/accelerate-recent-work-widget.php';

// Require file for TG: Featured Posts.
require ACCELERATE_WIDGETS_DIR . '/accelerate-featured-posts-widget.php';

// Require file for TG: Our Clients.
require ACCELERATE_WIDGETS_DIR . '/accelerate-our-clients-widget.php';

// Require file for TG: Image Services.
require ACCELERATE_WIDGETS_DIR . '/accelerate-image-service-widget.php';

// Require file for TG: Custom Tag Cloud.
require ACCELERATE_WIDGETS_DIR . '/accelerate-custom-tag-widget.php';

// Require file for TG: Fun Facts.
require ACCELERATE_WIDGETS_DIR . '/accelerate-fun-facts-widget.php';

// Require file for TG: Team.
require ACCELERATE_WIDGETS_DIR . '/accelerate-team-widget.php';

// Require file for TG: Pricing Table.
require ACCELERATE_WIDGETS_DIR . '/accelerate-pricing-table-widget.php';
