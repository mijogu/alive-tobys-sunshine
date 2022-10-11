<?php
/**
 * Accelerate Theme Customizer
 *
 * @package    ThemeGrill
 * @subpackage Accelerate
 * @since      Accelerate 1.0.7
 */

function accelerate_customize_register( $wp_customize ) {

	require ACCELERATE_INCLUDES_DIR . '/customize-controls/class-accelerate-additional-social-icons-control.php';
	require ACCELERATE_INCLUDES_DIR . '/customize-controls/class-accelerate-editor-custom-control.php';
	require ACCELERATE_INCLUDES_DIR . '/customize-controls/class-accelerate-important-links.php';
	require ACCELERATE_INCLUDES_DIR . '/customize-controls/class-accelerate-typography-control.php';
	require ACCELERATE_INCLUDES_DIR . '/customize-controls/class-accelerate-text-area-control.php';
	require ACCELERATE_INCLUDES_DIR . '/customize-controls/class-accelerate-image-radio-control.php';
	$wp_customize->register_control_type( 'Accelerate_Editor_Custom_Control' );

	// Transport postMessage variable set
	$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '#site-title a',
			'render_callback' => 'accelerate_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '#site-description',
			'render_callback' => 'accelerate_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_section( 'accelerate_important_links', array(
		'priority' => 700,
		'title'    => __( 'Accelerate Pro', 'accelerate' ),
	) );

	/**
	 * This setting has the dummy Sanitization function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'accelerate_important_links', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_links_sanitize',
	) );

	$wp_customize->add_control( new Accelerate_Important_Links( $wp_customize, 'important_links', array(
		'section'  => 'accelerate_important_links',
		'settings' => 'accelerate_important_links',
	) ) );
	// Theme Important Links Ended

	// Start of the Header Options
	// Header Options Area
	$wp_customize->add_panel( 'accelerate_header_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 500,
		'title'      => __( 'Header', 'accelerate' ),
	) );

	// Header logo and text display type option
	$wp_customize->add_section( 'accelerate_show_option', array(
		'priority' => 2,
		'title'    => __( 'Show', 'accelerate' ),
		'panel'    => 'accelerate_header_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_show_header_logo_text]', array(
		'default'           => 'text_only',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_show_header_logo_text]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the option that you want.', 'accelerate' ),
		'section' => 'title_tagline',
		'choices' => array(
			'logo_only' => __( 'Header Logo Only', 'accelerate' ),
			'text_only' => __( 'Header Text Only', 'accelerate' ),
			'both'      => __( 'Show Both', 'accelerate' ),
			'none'      => __( 'Disable', 'accelerate' ),
		),
	) );

	// Header display type option
	$wp_customize->add_section( 'accelerate_header_display_type_option', array(
		'priority' => 2,
		'title'    => __( 'Header Display Type', 'accelerate' ),
		'panel'    => 'accelerate_header_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_header_display_type]', array(
		'default'           => 'one',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_header_display_type]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the header display type that you want.', 'accelerate' ),
		'section' => 'accelerate_header_display_type_option',
		'choices' => array(
			'one'   => __( 'Type 1 (Default): Header text & logo on left, header sidebar on right', 'accelerate' ),
			'two'   => __( 'Type 2: Header sidebar on left, header text & logo on right', 'accelerate' ),
			'three' => __( 'Type 3: Header text, header sidebar both aligned center', 'accelerate' ),
		),
	) );

	// Menu display type option
	$wp_customize->add_section( 'accelerate_menu_display_type_option', array(
		'priority' => 2,
		'title'    => __( 'Menu Display Type', 'accelerate' ),
		'panel'    => 'accelerate_header_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_menu_display_type]', array(
		'default'           => 'one',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_menu_display_type]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the menu display type that you want.', 'accelerate' ),
		'section' => 'accelerate_menu_display_type_option',
		'choices' => array(
			'one'   => __( 'Type 1 (Default): Menu aligned left', 'accelerate' ),
			'two'   => __( 'Type 2: Menu aligned center', 'accelerate' ),
			'three' => __( 'Type 3: Menu aligned right', 'accelerate' ),
		),
	) );

	// Menu background cover full width option
	$wp_customize->add_setting( 'accelerate[accelerate_menu_background_cover_full_width_option]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_menu_background_cover_full_width_option]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to make the menu background cover the full width of its container', 'accelerate' ),
		'section'  => 'accelerate_menu_display_type_option',
		'settings' => 'accelerate[accelerate_menu_background_cover_full_width_option]',
	) );

	// Header Top bar activate option
	$wp_customize->add_section( 'accelerate_activate_top_header_bar_option', array(
		'priority' => 2,
		'title'    => __( 'Activate Header Top Bar', 'accelerate' ),
		'panel'    => 'accelerate_header_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_activate_top_header_bar]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_activate_top_header_bar]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to show top header bar. The top header bar includes social icons and menu area.', 'accelerate' ),
		'section'  => 'accelerate_activate_top_header_bar_option',
		'settings' => 'accelerate[accelerate_activate_top_header_bar]',
	) );

	// Header top bar display type option
	$wp_customize->add_section( 'accelerate_hedaer_top_bar_display_type_option', array(
		'priority' => 2,
		'title'    => __( 'Header Top Bar Display Type', 'accelerate' ),
		'panel'    => 'accelerate_header_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_top_bar_display_type]', array(
		'default'           => 'one',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_top_bar_display_type]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose top bar display type.', 'accelerate' ),
		'section' => 'accelerate_hedaer_top_bar_display_type_option',
		'choices' => array(
			'one' => __( 'Type 1 (Default): Social icons on left and top menu area on right', 'accelerate' ),
			'two' => __( 'Type 2: Top menu on left and social icons on right', 'accelerate' ),
		),
	) );

	// Header image position option
	$wp_customize->add_section( 'accelerate_header_image_position_section', array(
		'priority' => 3,
		'title'    => __( 'Header Image Position', 'accelerate' ),
		'panel'    => 'accelerate_header_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_header_image_position]', array(
		'default'           => 'position_two',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_header_image_position]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose top header image display position.', 'accelerate' ),
		'section' => 'accelerate_header_image_position_section',
		'choices' => array(
			'position_one'   => __( 'Position One: Display the Header image just above the site title/text.', 'accelerate' ),
			'position_two'   => __( 'Position Two (Default): Display the Header image between site title/text and the main/primary menu.', 'accelerate' ),
			'position_three' => __( 'Position Three: Display the Header image below main/primary menu.', 'accelerate' ),
		),
	) );

	// Sticky menu option.
	$wp_customize->add_section( 'accelerate_sticky_menu', array(
		'priority' => 4,
		'title'    => esc_html__( 'Sticky Menu', 'accelerate' ),
		'panel'    => 'accelerate_header_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_sticky_menu_option]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_sticky_menu_option]', array(
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Check to enable sticky menu.', 'accelerate' ),
		'section' => 'accelerate_sticky_menu',
		'setting' => 'accelerate[accelerate_sticky_menu_option]',
	) );

	// Page Header.
	$wp_customize->add_section( 'accelerate_page_header', array(
		'priority' => 10,
		'title'    => esc_html__( 'Page Header', 'accelerate' ),
		'panel'    => 'accelerate_header_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_page_header_style]', array(
		'default'           => 'default',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_page_header_style]', array(
		'type'    => 'radio',
		'label'   => esc_html__( 'Layout', 'accelerate' ),
		'choices' => array(
			'default'   => esc_html__( 'Default', 'accelerate' ),
			'style-one' => esc_html__( 'Style 1', 'accelerate' ),
		),
		'section' => 'accelerate_page_header',
	) );

	// Page header Style.
	$wp_customize->add_setting( 'accelerate[accelerate_page_header_position]', array(
		'default'           => 'left',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_page_header_position]', array(
		'type'            => 'radio',
		'label'           => esc_html__( 'Page Header Position', 'accelerate' ),
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'accelerate' ),
			'right'  => esc_html__( 'Right', 'accelerate' ),
			'center' => esc_html__( 'Center', 'accelerate' ),
		),
		'section'         => 'accelerate_page_header',
		'active_callback' => 'accelerate_page_header_background_image',
	) );

	// Text Color option.
	$wp_customize->add_setting( 'accelerate[accelerate_page_header_text_color]', array(
		'default'              => '#444444',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
		'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accelerate[accelerate_page_header_text_color]', array(
		'label'           => esc_html__( 'Color', 'accelerate' ),
		'section'         => 'accelerate_page_header',
		'setting'         => 'accelerate[accelerate_page_header_text_color]',
		'active_callback' => 'accelerate_page_header_background_image',
	) ) );

	// Background Color option.
	$wp_customize->add_setting( 'accelerate[accelerate_page_header_background_color]', array(
		'default'              => '#ffffff',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
		'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accelerate[accelerate_page_header_background_color]', array(
		'label'           => esc_html__( 'Background Color', 'accelerate' ),
		'section'         => 'accelerate_page_header',
		'setting'         => 'accelerate[accelerate_page_header_background_color]',
		'active_callback' => 'accelerate_page_header_background_image',
	) ) );

	// Page header font size.
	$wp_customize->add_setting( 'accelerate[accelerate_page_header_font_size]', array(
		'default'           => '32px',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_page_header_font_size]', array(
		'label'           => esc_html__( 'Font Size', 'accelerate' ),
		'section'         => 'accelerate_page_header',
		'settings'        => 'accelerate[accelerate_page_header_font_size]',
		'active_callback' => 'accelerate_page_header_background_image',
	) );

	// Header background image upload setting.
	$wp_customize->add_setting( 'accelerate[accelerate_page_header_background_image]', array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'accelerate[accelerate_page_header_background_image]', array(
		'label'           => esc_html__( 'Background Image', 'accelerate' ),
		'setting'         => 'accelerate[accelerate_page_header_background_image]',
		'section'         => 'accelerate_page_header',
		'active_callback' => 'accelerate_page_header_background_image',
	) ) );

	// Page header background image position setting.
	$wp_customize->add_setting( 'accelerate[accelerate_page_header_background_image_position]', array(
		'default'           => 'center-center',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_page_header_background_image_position]', array(
		'type'            => 'select',
		'label'           => esc_html__( 'Background Image Position', 'accelerate' ),
		'setting'         => 'accelerate[accelerate_page_header_background_image_position]',
		'section'         => 'accelerate_page_header',
		'choices'         => array(
			'left-top'      => esc_html__( 'Top Left', 'accelerate' ),
			'center-top'    => esc_html__( 'Top Center', 'accelerate' ),
			'right-top'     => esc_html__( 'Top Right', 'accelerate' ),
			'left-center'   => esc_html__( 'Center Left', 'accelerate' ),
			'center-center' => esc_html__( 'Center Center', 'accelerate' ),
			'right-center'  => esc_html__( 'Center Right', 'accelerate' ),
			'left-bottom'   => esc_html__( 'Bottom Left', 'accelerate' ),
			'center-bottom' => esc_html__( 'Bottom Center', 'accelerate' ),
			'right-bottom'  => esc_html__( 'Bottom Right', 'accelerate' ),
		),
		'active_callback' => 'accelerate_page_header_background_image',
	) );

	// Page header background size setting.
	$wp_customize->add_setting( 'accelerate[accelerate_page_header_background_image_size]', array(
		'default'           => 'auto',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_page_header_background_image_size]', array(
		'type'            => 'select',
		'label'           => esc_html__( 'Background Image Size', 'accelerate' ),
		'setting'         => 'accelerate[accelerate_page_header_background_image_size]',
		'section'         => 'accelerate_page_header',
		'choices'         => array(
			'cover'   => esc_html__( 'Cover', 'accelerate' ),
			'contain' => esc_html__( 'Contain', 'accelerate' ),
			'auto'    => esc_html__( 'Auto', 'accelerate' ),
		),
		'active_callback' => 'accelerate_page_header_background_image',
	) );

	// Page header background attachment setting.
	$wp_customize->add_setting( 'accelerate[accelerate_page_header_background_image_attachment]', array(
		'default'           => 'scroll',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_page_header_background_image_attachment]', array(
		'type'            => 'select',
		'label'           => esc_html__( 'Background Image Attachment', 'accelerate' ),
		'setting'         => 'accelerate[accelerate_page_header_background_image_attachment]',
		'section'         => 'accelerate_page_header',
		'choices'         => array(
			'scroll' => esc_html__( 'Scroll', 'accelerate' ),
			'fixed'  => esc_html__( 'Fixed', 'accelerate' ),
		),
		'active_callback' => 'accelerate_page_header_background_image',
	) );

	// Page header background repeat setting.
	$wp_customize->add_setting( 'accelerate[accelerate_page_header_background_image_repeat]', array(
		'default'           => 'repeat',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_page_header_background_image_repeat]', array(
		'type'            => 'select',
		'label'           => esc_html__( 'Background Image Repeat', 'accelerate' ),
		'setting'         => 'accelerate[accelerate_page_header_background_image_repeat]',
		'section'         => 'accelerate_page_header',
		'choices'         => array(
			'no-repeat' => esc_html__( 'No Repeat', 'accelerate' ),
			'repeat'    => esc_html__( 'Repeat', 'accelerate' ),
			'repeat-x'  => esc_html__( 'Repeat Horizontally', 'accelerate' ),
			'repeat-y'  => esc_html__( 'Repeat Vertically', 'accelerate' ),
		),
		'active_callback' => 'accelerate_page_header_background_image',
	) );

	// New Responsive Menu
	$wp_customize->add_section( 'accelerate_new_menu', array(
		'priority' => 4,
		'title'    => esc_html__( 'Responsive Menu Style', 'accelerate' ),
		'panel'    => 'accelerate_header_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_new_menu]', array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_new_menu]', array(
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Switch to new responsive menu.', 'accelerate' ),
		'section' => 'accelerate_new_menu',
	) );

	// make header image as link option
	$wp_customize->add_setting( 'accelerate[accelerate_header_image_link]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_header_image_link]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to make header image link back to home page.', 'accelerate' ),
		'section'  => 'accelerate_header_image_position_section',
		'settings' => 'accelerate[accelerate_header_image_link]',
	) );
	// Custom link to header image
	$wp_customize->add_setting( 'accelerate[accelerate_header_image_link_to_url]', array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_header_image_link_to_url]', array(
		'type'     => 'text',
		'label'    => esc_html__( 'Custom link to header image.', 'accelerate' ),
		'section'  => 'accelerate_header_image_position_section',
		'settings' => 'accelerate[accelerate_header_image_link_to_url]',
	) );
	// End of Header Options

	// Start of the Design Options
	$wp_customize->add_panel( 'accelerate_design_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 505,
		'title'      => __( 'Design', 'accelerate' ),
	) );

	// site layout setting
	$wp_customize->add_section( 'accelerate_site_layout_setting', array(
		'priority' => 1,
		'title'    => __( 'Site Layout', 'accelerate' ),
		'panel'    => 'accelerate_design_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_site_layout]', array(
		'default'           => 'wide',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_site_layout]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose your site layout. The change is reflected in whole site.', 'accelerate' ),
		'choices' => array(
			'box'  => __( 'Boxed layout', 'accelerate' ),
			'wide' => __( 'Wide layout', 'accelerate' ),
		),
		'section' => 'accelerate_site_layout_setting',
	) );

	// default layout setting
	$wp_customize->add_section( 'accelerate_default_layout_setting', array(
		'priority' => 2,
		'title'    => __( 'Default layout', 'accelerate' ),
		'panel'    => 'accelerate_design_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_default_layout]', array(
		'default'           => 'right_sidebar',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Accelerate_Image_Radio_Control( $wp_customize, 'accelerate[accelerate_default_layout]', array(
		'type'     => 'radio',
		'label'    => __( 'Select default layout. This layout will be reflected in whole site archives, search etc. The layout for a single post and page can be controlled from below options.', 'accelerate' ),
		'section'  => 'accelerate_default_layout_setting',
		'settings' => 'accelerate[accelerate_default_layout]',
		'choices'  => array(
			'right_sidebar'               => ACCELERATE_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => ACCELERATE_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		),
	) ) );

	// default layout for pages
	$wp_customize->add_section( 'accelerate_default_page_layout_setting', array(
		'priority' => 3,
		'title'    => __( 'Default layout for pages only', 'accelerate' ),
		'panel'    => 'accelerate_design_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_pages_default_layout]', array(
		'default'           => 'right_sidebar',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Accelerate_Image_Radio_Control( $wp_customize, 'accelerate[accelerate_pages_default_layout]', array(
		'type'     => 'radio',
		'label'    => __( 'Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'accelerate' ),
		'section'  => 'accelerate_default_page_layout_setting',
		'settings' => 'accelerate[accelerate_pages_default_layout]',
		'choices'  => array(
			'right_sidebar'               => ACCELERATE_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => ACCELERATE_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		),
	) ) );

	// default layout for single posts
	$wp_customize->add_section( 'accelerate_default_single_posts_layout_setting', array(
		'priority' => 4,
		'title'    => __( 'Default layout for single posts only', 'accelerate' ),
		'panel'    => 'accelerate_design_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_single_posts_default_layout]', array(
		'default'           => 'right_sidebar',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Accelerate_Image_Radio_Control( $wp_customize, 'accelerate[accelerate_single_posts_default_layout]', array(
		'type'     => 'radio',
		'label'    => __( 'Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'accelerate' ),
		'section'  => 'accelerate_default_single_posts_layout_setting',
		'settings' => 'accelerate[accelerate_single_posts_default_layout]',
		'choices'  => array(
			'right_sidebar'               => ACCELERATE_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => ACCELERATE_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		),
	) ) );

	// Posts page listing display type setting
	$wp_customize->add_section( 'accelerate_post_page_display_type_setting', array(
		'priority' => 5,
		'title'    => __( 'Posts page listing display type', 'accelerate' ),
		'panel'    => 'accelerate_design_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_posts_page_display_type]', array(
		'default'           => 'large_image',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_posts_page_display_type]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the display type for the latests posts view or posts page view (static front page).', 'accelerate' ),
		'choices' => array(
			'large_image'           => __( 'Large featured image', 'accelerate' ),
			'small_image'           => __( 'Small featured image', 'accelerate' ),
			'small_image_alternate' => __( 'Small featured image with alternating sides', 'accelerate' ),
			'grid_image'            => __( 'Grid', 'accelerate' ),
			'masonry_image'         => __( 'Masonry', 'accelerate' ),
		),
		'section' => 'accelerate_post_page_display_type_setting',
	) );

	// Column Option.
	$wp_customize->add_setting( 'accelerate[accelerate_blog_column_option]', array(
		'default'           => '2',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_blog_column_option]', array(
		'type'            => 'select',
		'label'           => __( 'Column', 'accelerate' ),
		'choices'         => array(
			'2' => __( 'Two', 'accelerate' ),
			'3' => __( 'Three', 'accelerate' ),
		),
		'section'         => 'accelerate_post_page_display_type_setting',
		'active_callback' => 'accelerate_blog_column_option',
	) );

	// Archive/category posts listing display type setting
	$wp_customize->add_section( 'accelerate_archive_category_display_type_setting', array(
		'priority' => 6,
		'title'    => __( 'Archive/Category posts listing display type', 'accelerate' ),
		'panel'    => 'accelerate_design_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_archive_display_type]', array(
		'default'           => 'large_image',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_archive_display_type]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the display type for the archive/category view.', 'accelerate' ),
		'choices' => array(
			'large_image'           => __( 'Large featured image', 'accelerate' ),
			'small_image'           => __( 'Small featured image', 'accelerate' ),
			'small_image_alternate' => __( 'Small featured image with alternating sides', 'accelerate' ),
			'grid_image'            => esc_html__( 'Grid', 'accelerate' ),
			'masonry_image'         => esc_html__( 'Masonry', 'accelerate' ),
		),
		'section' => 'accelerate_archive_category_display_type_setting',
	) );

	// Column Option.
	$wp_customize->add_setting( 'accelerate[accelerate_archive_blog_column_option]', array(
		'default'           => '2',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_archive_blog_column_option]', array(
		'type'            => 'select',
		'label'           => esc_html__( 'Column', 'accelerate' ),
		'choices'         => array(
			'2' => esc_html__( 'Two', 'accelerate' ),
			'3' => esc_html__( 'Three', 'accelerate' ),
		),
		'section'         => 'accelerate_archive_category_display_type_setting',
		'active_callback' => 'accelerate_archive_blog_column_option',
	) );

	// End of Design Options

	// Start of the Social Links Options
	$wp_customize->add_panel( 'accelerate_social_links_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 510,
		'title'      => __( 'Social Links', 'accelerate' ),
	) );

	// Social links activate option
	$wp_customize->add_section( 'accelerate_social_links_setting', array(
		'priority' => 1,
		'title'    => __( 'Activate social links area', 'accelerate' ),
		'panel'    => 'accelerate_social_links_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_activate_social_links]', array(
		'default'           => 0,
		'type'              => 'option',
		'transport'         => $customizer_selective_refresh,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_activate_social_links]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to activate social links area. You also need to activate the header top bar section in Header options to show this social links area', 'accelerate' ),
		'section'  => 'accelerate_social_links_setting',
		'settings' => 'accelerate[accelerate_activate_social_links]',
	) );

	// Selective refresh for social links enable
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'accelerate[accelerate_activate_social_links]', array(
			'selector'        => '.social-links',
			'render_callback' => '',
		) );
	}

	$accelerate_social_links = array(
		'accelerate_social_facebook'    => __( 'Facebook', 'accelerate' ),
		'accelerate_social_twitter'     => __( 'Twitter', 'accelerate' ),
		'accelerate_social_googleplus'  => __( 'GooglePlus', 'accelerate' ),
		'accelerate_social_instagram'   => __( 'Instagram', 'accelerate' ),
		'accelerate_social_codepen'     => __( 'CodePen', 'accelerate' ),
		'accelerate_social_digg'        => __( 'Digg', 'accelerate' ),
		'accelerate_social_dribbble'    => __( 'Dribbble', 'accelerate' ),
		'accelerate_social_flickr'      => __( 'Flickr', 'accelerate' ),
		'accelerate_social_github'      => __( 'GitHub', 'accelerate' ),
		'accelerate_social_linkedin'    => __( 'LinkedIn', 'accelerate' ),
		'accelerate_social_pinterest'   => __( 'Pinterest', 'accelerate' ),
		'accelerate_social_reddit'      => __( 'Reddit', 'accelerate' ),
		'accelerate_social_skype'       => __( 'Skype', 'accelerate' ),
		'accelerate_social_stumbleupon' => __( 'StumbleUpon', 'accelerate' ),
		'accelerate_social_tumblr'      => __( 'Tumblr', 'accelerate' ),
		'accelerate_social_vimeo'       => __( 'Vimeo', 'accelerate' ),
		'accelerate_social_wordpress'   => __( 'WordPress', 'accelerate' ),
		'accelerate_social_youtube'     => __( 'YouTube', 'accelerate' ),
		'accelerate_social_xing'        => __( 'Xing', 'accelerate' ),
		'accelerate_social_weibo'       => __( 'Weibo', 'accelerate' ),
	);

	$i = 1;
	foreach ( $accelerate_social_links as $key => $value ) {

		$wp_customize->add_section( 'accelerate_social_sites_section' . $i, array(
			'priority' => 2,
			'title'    => $value,
			'panel'    => 'accelerate_social_links_options',
		) );

		// adding social sites link
		$wp_customize->add_setting( 'accelerate[' . $key . ']', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( 'accelerate[' . $key . ']', array(
			'label'   => sprintf( __( 'Add link for %1$s', 'accelerate' ), $value ),
			'section' => 'accelerate_social_sites_section' . $i,
			'setting' => 'accelerate[' . $key . ']',
		) );

		// adding social open in new page tab setting
		$wp_customize->add_setting( 'accelerate[' . $key . 'new_tab]', array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_checkbox_sanitize',
		) );

		$wp_customize->add_control( 'accelerate[' . $key . 'new_tab]', array(
			'type'    => 'checkbox',
			'label'   => __( 'Check to show in new tab', 'accelerate' ),
			'section' => 'accelerate_social_sites_section' . $i,
			'setting' => 'accelerate[' . $key . 'new_tab]',
		) );

		$i ++;

	}

	//Array for Additional Icons
	$accelerate_additional_icons = array(
		'accelerate_additional_icon_one'   => esc_html__( 'First Additional Social Icon', 'accelerate' ),
		'accelerate_additional_icon_two'   => esc_html__( 'Second Additional Social Icon', 'accelerate' ),
		'accelerate_additional_icon_three' => esc_html__( 'Third Additional Social Icon', 'accelerate' ),
		'accelerate_additional_icon_four'  => esc_html__( 'Fourth Additional Social Icon', 'accelerate' ),
		'accelerate_additional_icon_five'  => esc_html__( 'Fifth Additional Social Icon', 'accelerate' ),
	);

	//Start of Additional Social Icons Section
	$wp_customize->add_section( 'accelerate_additional_icons_section', array(
		'priority' => 3,
		'title'    => esc_html__( 'Additional Social Icons', 'accelerate' ),
		'panel'    => 'accelerate_social_links_options',
	) );

	foreach ( $accelerate_additional_icons as $key => $value ) {

		// additional social icon link
		$wp_customize->add_setting( 'accelerate[' . $key . '_link]', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( 'accelerate[' . $key . '_link]', array(
			'label'   => sprintf( esc_html__( 'Add link for %1$s', 'accelerate' ), $value ),
			'section' => 'accelerate_additional_icons_section',
			'setting' => 'accelerate[' . $key . '_link]',
		) );

		// FontAwesome icon class
		$wp_customize->add_setting( 'accelerate[' . $key . '_icon]', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( new Accelerate_Additional_Social_Icons_Control( $wp_customize, 'accelerate[' . $key . '_icon]', array(
			'section' => 'accelerate_additional_icons_section',
			'setting' => 'accelerate[' . $key . '_icon]',
		) ) );

		// additional icon color
		$wp_customize->add_setting( 'accelerate[' . $key . '_color]', array(
			'default'              => '',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
			'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accelerate[' . $key . '_color]', array(
			'label'   => sprintf( esc_html__( 'Choose a color for %1$s', 'accelerate' ), $value ),
			'section' => 'accelerate_additional_icons_section',
			'setting' => 'accelerate[' . $key . '_color]',
		) ) );

		//additional icon open in new tab
		$wp_customize->add_setting( 'accelerate[' . $key . '_new_tab]', array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_checkbox_sanitize',
		) );

		$wp_customize->add_control( 'accelerate[' . $key . '_new_tab]', array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Check to open in new tab', 'accelerate' ),
			'section' => 'accelerate_additional_icons_section',
			'setting' => 'accelerate[' . $key . '_new_tab]',
		) );
	}
	// End of Social Links Options

	// Start of the Footer Options
	$wp_customize->add_panel( 'accelerate_footer_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 510,
		'title'      => esc_html__( 'Footer', 'accelerate' ),
	) );

	// Footer widgets column select type
	$wp_customize->add_section( 'accelerate_footer_column_select_section', array(
		'priority' => 5,
		'title'    => esc_html__( 'Footer Widgets Column', 'accelerate' ),
		'panel'    => 'accelerate_footer_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_footer_widget_column_select_type]', array(
		'default'           => 'three',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Accelerate_Image_Radio_Control( $wp_customize, 'accelerate[accelerate_footer_widget_column_select_type]', array(
		'label'   => __( 'Choose the number of column for the footer widgetized areas.', 'accelerate' ),
		'choices' => array(
			'one'           => ACCELERATE_ADMIN_IMAGES_URL . '/footer-full-column.png',
			'two'           => ACCELERATE_ADMIN_IMAGES_URL . '/footer-two-column.png',
			'three'         => ACCELERATE_ADMIN_IMAGES_URL . '/footer-third-column.png',
			'four'          => ACCELERATE_ADMIN_IMAGES_URL . '/footer-fourth-column.png',
			'two-style-1'   => ACCELERATE_ADMIN_IMAGES_URL . '/footer-two-style1.png',
			'two-style-2'   => ACCELERATE_ADMIN_IMAGES_URL . '/footer-two-style2.png',
			'three-style-1' => ACCELERATE_ADMIN_IMAGES_URL . '/footer-three-style1.png',
			'three-style-2' => ACCELERATE_ADMIN_IMAGES_URL . '/footer-three-style2.png',
			'three-style-3' => ACCELERATE_ADMIN_IMAGES_URL . '/footer-three-style3.png',
			'four-style-1'  => ACCELERATE_ADMIN_IMAGES_URL . '/footer-four-style1.png',
			'four-style-2'  => ACCELERATE_ADMIN_IMAGES_URL . '/footer-four-style2.png',
		),
		'section' => 'accelerate_footer_column_select_section',
	) ) );

	// Footer background section.
	$wp_customize->add_section( 'accelerate_footer_background_section', array(
		'priority' => 10,
		'title'    => esc_html__( 'Footer Background', 'accelerate' ),
		'panel'    => 'accelerate_footer_options',
	) );

	// Footer background image upload setting.
	$wp_customize->add_setting( 'accelerate[accelerate_footer_background_image]', array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'accelerate[accelerate_footer_background_image]', array(
		'label'   => esc_html__( 'Background Image', 'accelerate' ),
		'setting' => 'accelerate[accelerate_footer_background_image]',
		'section' => 'accelerate_footer_background_section',
	) ) );

	// Footer background image position setting.
	$wp_customize->add_setting( 'accelerate[accelerate_footer_background_image_position]', array(
		'default'           => 'center-center',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_footer_background_image_position]', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Background Image Position', 'accelerate' ),
		'setting' => 'accelerate[accelerate_footer_background_image_position]',
		'section' => 'accelerate_footer_background_section',
		'choices' => array(
			'left-top'      => esc_html__( 'Top Left', 'accelerate' ),
			'center-top'    => esc_html__( 'Top Center', 'accelerate' ),
			'right-top'     => esc_html__( 'Top Right', 'accelerate' ),
			'left-center'   => esc_html__( 'Center Left', 'accelerate' ),
			'center-center' => esc_html__( 'Center Center', 'accelerate' ),
			'right-center'  => esc_html__( 'Center Right', 'accelerate' ),
			'left-bottom'   => esc_html__( 'Bottom Left', 'accelerate' ),
			'center-bottom' => esc_html__( 'Bottom Center', 'accelerate' ),
			'right-bottom'  => esc_html__( 'Bottom Right', 'accelerate' ),
		),
	) );

	// Footer background size setting.
	$wp_customize->add_setting( 'accelerate[accelerate_footer_background_image_size]', array(
		'default'           => 'auto',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_footer_background_image_size]', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Background Image Size', 'accelerate' ),
		'setting' => 'accelerate[accelerate_footer_background_image_size]',
		'section' => 'accelerate_footer_background_section',
		'choices' => array(
			'cover'   => esc_html__( 'Cover', 'accelerate' ),
			'contain' => esc_html__( 'Contain', 'accelerate' ),
			'auto'    => esc_html__( 'Auto', 'accelerate' ),
		),
	) );

	// Footer background attachment setting.
	$wp_customize->add_setting( 'accelerate[accelerate_footer_background_image_attachment]', array(
		'default'           => 'scroll',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_footer_background_image_attachment]', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Background Image Attachment', 'accelerate' ),
		'setting' => 'accelerate[accelerate_footer_background_image_attachment]',
		'section' => 'accelerate_footer_background_section',
		'choices' => array(
			'scroll' => esc_html__( 'Scroll', 'accelerate' ),
			'fixed'  => esc_html__( 'Fixed', 'accelerate' ),
		),
	) );

	// Footer background repeat setting.
	$wp_customize->add_setting( 'accelerate[accelerate_footer_background_image_repeat]', array(
		'default'           => 'repeat',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_footer_background_image_repeat]', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Background Image Repeat', 'accelerate' ),
		'setting' => 'accelerate[accelerate_footer_background_image_repeat]',
		'section' => 'accelerate_footer_background_section',
		'choices' => array(
			'no-repeat' => esc_html__( 'No Repeat', 'accelerate' ),
			'repeat'    => esc_html__( 'Repeat', 'accelerate' ),
			'repeat-x'  => esc_html__( 'Repeat Horizontally', 'accelerate' ),
			'repeat-y'  => esc_html__( 'Repeat Vertically', 'accelerate' ),
		),
	) );

	// Footer editor option
	$default_footer_value = __( 'Copyright &copy; ', 'accelerate' ) . '[the-year] [site-link]. ' . esc_html__( 'All rights reserved.', 'accelerate' ) . '<br>' . esc_html__( 'Theme: ', 'accelerate' ) . '[tg-link]' .esc_html__( ' by ThemeGrill. Powered by ', 'accelerate' ) . '[wp-link].';

	$wp_customize->add_section( 'accelerate_footer_copyright_section', array(
		'priority' => 6,
		'title'    => __( 'Footer Copyright Editor', 'accelerate' ),
		'panel'    => 'accelerate_footer_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_footer_editor]', array(
		'default'           => $default_footer_value,
		'type'              => 'option',
		'transport'         => $customizer_selective_refresh,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_footer_editor_sanitize',
	) );

	$wp_customize->add_control( new Accelerate_Editor_Custom_Control( $wp_customize, 'accelerate[accelerate_footer_editor]', array(
		'label'   => __( 'Edit the Copyright information in your footer. You can also use shortcodes [the-year], [site-link], [wp-link], [tg-link] for current year, your site link, WordPress site link and ThemeGrill site link respectively.', 'accelerate' ),
		'section' => 'accelerate_footer_copyright_section',
		'setting' => 'accelerate[accelerate_footer_editor]',
	) ) );

	// Selective refresh for footer copyright
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'accelerate[accelerate_footer_editor]', array(
			'selector'        => '.copyright',
			'render_callback' => 'accelerate_footer_copyright',
		) );
	}

	// Footer copyright alignment.
	$wp_customize->add_section( 'accelerate_footer_copyright_alignment', array(
		'priority' => 6,
		'title'    => esc_html__( 'Copyright Alignment', 'accelerate' ),
		'panel'    => 'accelerate_footer_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_footer_copyright_alignment_setting]', array(
		'default'           => 'left',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_footer_copyright_alignment_setting]', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Display Copyright and Footer Menu either on left/right or on center position.', 'accelerate' ),
		'choices' => array(
			'left'   => esc_html__( 'Left/Right', 'accelerate' ),
			'right'  => esc_html__( 'Right/Left', 'accelerate' ),
			'center' => esc_html__( 'Center', 'accelerate' ),
		),
		'section' => 'accelerate_footer_copyright_alignment',
		'setting' => 'accelerate_footer_copyright_alignment_setting',
	) );

	// End of the Footer Options

	// Start of Woocommerce options.
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_panel( 'accelerate_woocommerce_options', array(
			'priority'    => 535,
			'title'       => esc_html__( 'WooCommerce Options', 'accelerate' ),
			'capability'  => 'edit_theme_options',
			'description' => esc_html__( 'Change the WooCommerce Settings from here as you want', 'accelerate' ),
		) );

		$wp_customize->add_section( 'accelerate_woocommerce_setting', array(
			'priority' => 1,
			'title'    => esc_html__( 'Woocommerce Settings', 'accelerate' ),
			'panel'    => 'accelerate_woocommerce_options',
		) );

		// Add additional sidebar area for WooCommerce pages.
		$wp_customize->add_setting( 'accelerate[accelerate_woocommerce_sidebar_register_setting]', array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_checkbox_sanitize',
		) );

		$wp_customize->add_control( 'accelerate[accelerate_woocommerce_sidebar_register_setting]', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to register different sidebar areas to be used for WooCommerce pages.', 'accelerate' ),
			'section'  => 'accelerate_woocommerce_setting',
			'settings' => 'accelerate[accelerate_woocommerce_sidebar_register_setting]',
		) );

		// WooCommerce Shop Page Layout.
		$wp_customize->add_setting( 'accelerate[accelerate_woocmmerce_shop_page_layout]', array(
			'default'           => 'no_sidebar_full_width',
			'capability'        => 'edit_theme_options',
			'type'              => 'option',
			'sanitize_callback' => 'accelerate_radio_select_sanitize',
		) );

		$wp_customize->add_control( new Accelerate_Image_Radio_Control( $wp_customize, 'accelerate[accelerate_woocmmerce_shop_page_layout]', array(
			'type'     => 'radio',
			'label'    => esc_html__( 'WooCommerce Shop Page Layout', 'accelerate' ),
			'section'  => 'accelerate_woocommerce_setting',
			'settings' => 'accelerate[accelerate_woocmmerce_shop_page_layout]',
			'choices'  => array(
				'right_sidebar'               => ACCELERATE_ADMIN_IMAGES_URL . '/right-sidebar.png',
				'left_sidebar'                => ACCELERATE_ADMIN_IMAGES_URL . '/left-sidebar.png',
				'no_sidebar_full_width'       => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered' => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
			),
		) ) );

		// WooCommerce Archive Page Layout.
		$wp_customize->add_setting( 'accelerate[accelerate_woocmmerce_archive_page_layout]', array(
			'default'           => 'no_sidebar_full_width',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_radio_select_sanitize',
		) );

		$wp_customize->add_control( new Accelerate_Image_Radio_Control( $wp_customize, 'accelerate[accelerate_woocmmerce_archive_page_layout]', array(
			'type'     => 'radio',
			'label'    => esc_html__( 'WooCommerce Archive Page Layout', 'accelerate' ),
			'section'  => 'accelerate_woocommerce_setting',
			'settings' => 'accelerate[accelerate_woocmmerce_archive_page_layout]',
			'choices'  => array(
				'right_sidebar'               => ACCELERATE_ADMIN_IMAGES_URL . '/right-sidebar.png',
				'left_sidebar'                => ACCELERATE_ADMIN_IMAGES_URL . '/left-sidebar.png',
				'no_sidebar_full_width'       => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered' => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
			),
		) ) );

		// WooCommerce Single Product Page Layout.
		$wp_customize->add_setting( 'accelerate[accelerate_woocmmerce_single_product_page_layout]', array(
			'default'           => 'no_sidebar_full_width',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_radio_select_sanitize',
		) );

		$wp_customize->add_control( new Accelerate_Image_Radio_Control( $wp_customize, 'accelerate[accelerate_woocmmerce_single_product_page_layout]', array(
			'type'     => 'radio',
			'label'    => esc_html__( 'WooCommerce Single Product Page Layout', 'accelerate' ),
			'section'  => 'accelerate_woocommerce_setting',
			'settings' => 'accelerate[accelerate_woocmmerce_single_product_page_layout]',
			'choices'  => array(
				'right_sidebar'               => ACCELERATE_ADMIN_IMAGES_URL . '/right-sidebar.png',
				'left_sidebar'                => ACCELERATE_ADMIN_IMAGES_URL . '/left-sidebar.png',
				'no_sidebar_full_width'       => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered' => ACCELERATE_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
			),
		) ) );
	}
	// End of WooCommerce options.

	// Start of the Additional Options
	$wp_customize->add_panel( 'accelerate_additional_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 510,
		'title'      => esc_html__( 'Additional', 'accelerate' ),
	) );

	// excerpt/full post option
	$wp_customize->add_section( 'accelerate_excerpt_full_post_setting', array(
		'priority' => 3,
		'title'    => __( 'Excerpts or Full Posts option', 'accelerate' ),
		'panel'    => 'accelerate_additional_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_toggle_excerpt_full_post]', array(
		'default'           => 'full_post',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_toggle_excerpt_full_post]', array(
		'type'    => 'radio',
		'label'   => __( 'Toggle between displaying excerpts and full posts on your blog and archives.', 'accelerate' ),
		'choices' => array(
			'full_post' => __( 'Show full post content', 'accelerate' ),
			'excerpt'   => __( 'Show excerpt', 'accelerate' ),
		),
		'section' => 'accelerate_excerpt_full_post_setting',
	) );

	// excerpt length setting
	$wp_customize->add_section( 'accelerate_excerpt_length_setting', array(
		'priority' => 4,
		'title'    => __( 'Excerpt Length', 'accelerate' ),
		'panel'    => 'accelerate_additional_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_excerpt_length]', array(
		'default'           => 40,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_excerpt_length_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_excerpt_length]', array(
		'label'   => __( 'Enter the number of Words you wish to show on excerpt. Default value is 40 words.', 'accelerate' ),
		'setting' => 'accelerate[accelerate_excerpt_length]',
		'section' => 'accelerate_excerpt_length_setting',
	) );

	// excerpt text setting
	$wp_customize->add_section( 'accelerate_excerpt_text_setting', array(
		'priority' => 5,
		'title'    => __( 'Excerpt Read More Text', 'accelerate' ),
		'panel'    => 'accelerate_additional_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_read_more_text]', array(
		'default'           => __( 'Read more', 'accelerate' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_read_more_text]', array(
		'label'   => __( 'Replace the default Read more text with your own words', 'accelerate' ),
		'setting' => 'accelerate[accelerate_read_more_text]',
		'section' => 'accelerate_excerpt_text_setting',
	) );

	// Sticky post and sidebar section
	$wp_customize->add_section( 'accelerate_sticky_content_sidebar_setting', array(
		'priority' => 7,
		'title'    => esc_html__( 'Sticky Content And Sidebar', 'accelerate' ),
		'panel'    => 'accelerate_additional_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_sticky_content_sidebar]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_sticky_content_sidebar]', array(
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Check to activate the sticky options for content and sidebar areas.', 'accelerate' ),
		'setting' => 'accelerate[accelerate_sticky_content_sidebar]',
		'section' => 'accelerate_sticky_content_sidebar_setting',
	) );

	// Feadtured image show/hide option.
	$wp_customize->add_section( 'accelerate_featured_image_display', array(
		'priority' => 7,
		'title'    => esc_html__( 'Featured Image', 'accelerate' ),
		'panel'    => 'accelerate_additional_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_featured_image_display_setting]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_featured_image_display_setting]', array(
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Check to display featured image in single page.', 'accelerate' ),
		'setting' => 'accelerate[accelerate_featured_image_display_setting]',
		'section' => 'accelerate_featured_image_display',
	) );

	// Author Bio Option.
	$wp_customize->add_section( 'accelerate_author_bio_section', array(
		'priority' => 7,
		'title'    => esc_html__( 'Author Bio Option', 'accelerate' ),
		'panel'    => 'accelerate_additional_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_author_bio_setting]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_author_bio_setting]', array(
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Check to display the author bio.', 'accelerate' ),
		'setting' => 'accelerate[accelerate_author_bio_setting]',
		'section' => 'accelerate_author_bio_section',
	) );

	// Author bio social site display.
	$wp_customize->add_setting( 'accelerate[accelerate_author_bio_social_sites_show]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_author_bio_social_sites_show]', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Check to show the Social Profiles in the Author Bio', 'accelerate' ),
		'section'  => 'accelerate_author_bio_section',
		'settings' => 'accelerate[accelerate_author_bio_social_sites_show]',
	) );

	// Author bio link display.
	$wp_customize->add_setting( 'accelerate[accelerate_author_bio_link_show]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_author_bio_link_show]', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( ' Check to display the link to the author page in the Author Bio section', 'accelerate' ),
		'section'  => 'accelerate_author_bio_section',
		'settings' => 'accelerate[accelerate_author_bio_link_show]',
	) );

	// Related posts.
	$wp_customize->add_section( 'accelerate_related_posts_section', array(
		'priority' => 4,
		'title'    => esc_html__( 'Related Posts', 'accelerate' ),
		'panel'    => 'accelerate_additional_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_related_posts_activate]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_related_posts_activate]', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Check to activate the related posts', 'accelerate' ),
		'section'  => 'accelerate_related_posts_section',
		'settings' => 'accelerate[accelerate_related_posts_activate]',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_related_posts]', array(
		'default'           => 'categories',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_related_posts]', array(
		'type'     => 'radio',
		'label'    => esc_html__( 'Related Posts Must Be Shown As:', 'accelerate' ),
		'section'  => 'accelerate_related_posts_section',
		'settings' => 'accelerate[accelerate_related_posts]',
		'choices'  => array(
			'categories' => esc_html__( 'Related Posts By Categories', 'accelerate' ),
			'tags'       => esc_html__( 'Related Posts By Tags', 'accelerate' ),
		),
	) );

	// Select option to display number of posts
	$wp_customize->add_setting( 'accelerate_related_post_number_display', array(
		'default'           => '3',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate_related_post_number_display', array(
		'type'     => 'select',
		'section'  => 'accelerate_related_posts_section',
		'settings' => 'accelerate_related_post_number_display',
		'label'    => esc_html__( 'Number of post to display', 'accelerate' ),
		'choices'  => array(
			'3' => esc_html__( '3', 'accelerate' ),
			'6' => esc_html__( '6', 'accelerate' ),
		),
	) );
	// End of Additional Options

	// Start of the Slider Options
	$wp_customize->add_panel( 'accelerate_slider_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 515,
		'title'      => __( 'Slider', 'accelerate' ),
	) );

	// Slider activate option
	$wp_customize->add_section( 'accelerate_slider_activate_section', array(
		'priority' => 1,
		'title'    => __( 'Activate slider', 'accelerate' ),
		'panel'    => 'accelerate_slider_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_activate_slider]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'transport'         => $customizer_selective_refresh,
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_activate_slider]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to activate slider.', 'accelerate' ),
		'section'  => 'accelerate_slider_activate_section',
		'settings' => 'accelerate[accelerate_activate_slider]',
	) );

	// Selective refresh for slider
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'accelerate[accelerate_activate_slider]', array(
			'selector'        => '#featured-slider',
			'render_callback' => '',
		) );
	}

	// Slider status option
	$wp_customize->add_section( 'accelerate_slider_status_section', array(
		'priority' => 2,
		'title'    => __( 'Slider Status', 'accelerate' ),
		'panel'    => 'accelerate_slider_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_slider_status]', array(
		'default'           => 'front_page',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_slider_status]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the slider status that you want.', 'accelerate' ),
		'setting' => 'accelerate[accelerate_slider_status]',
		'section' => 'accelerate_slider_status_section',
		'choices' => array(
			'front_page' => __( 'Slider on Front page', 'accelerate' ),
			'all_page'   => __( 'Slider on all pages', 'accelerate' ),
		),
	) );

	// Slider setting option
	$wp_customize->add_section( 'accelerate_slider_setting_section', array(
		'priority' => 3,
		'title'    => __( 'Slider Settings', 'accelerate' ),
		'panel'    => 'accelerate_slider_options',
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_slider_transition_effect]', array(
		'default'           => 'fade',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_slider_radio_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_slider_transition_effect]', array(
		'type'    => 'select',
		'label'   => __( 'Slider transition effect. Choose the transition effect that you like. Default is "fade".', 'accelerate' ),
		'setting' => 'accelerate[accelerate_slider_transition_effect]',
		'section' => 'accelerate_slider_setting_section',
		'choices' => array(
			'fade'       => esc_html__( 'Fade', 'accelerate' ),
			'fadeout'    => esc_html__( 'FadeOut', 'accelerate' ),
			'none'       => esc_html__( 'None', 'accelerate' ),
			'scrollHorz' => esc_html__( 'ScrollHorz', 'accelerate' ),
			'flipHorz'   => esc_html__( 'FlipHorz', 'accelerate' ),
			'flipVert'   => esc_html__( 'FlipVert', 'accelerate' ),
			'tileBlind'  => esc_html__( 'TileBlind', 'accelerate' ),
			'shuffle'    => esc_html__( 'Shuffle', 'accelerate' ),
		),
	) );

	// Slider transition delay time
	$wp_customize->add_setting( 'accelerate[accelerate_slider_transition_delay]', array(
		'default'           => 4,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_slider_transition_delay_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_slider_transition_delay]', array(
		'label'   => __( 'Slider transition delay time. Add number in seconds. Default is 4.', 'accelerate' ),
		'setting' => 'accelerate[accelerate_slider_transition_delay]',
		'section' => 'accelerate_slider_setting_section',
	) );

	// Slider transition length time
	$wp_customize->add_setting( 'accelerate[accelerate_slider_transition_length]', array(
		'default'           => 1,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_slider_transition_length_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_slider_transition_length]', array(
		'label'   => __( 'Slider transition length time. Add number in seconds. Default is 1.', 'accelerate' ),
		'setting' => 'accelerate[accelerate_slider_transition_length]',
		'section' => 'accelerate_slider_setting_section',
	) );

	// slider number sanitize
	$wp_customize->add_setting( 'accelerate[accelerate_slider_number]', array(
		'default'           => 4,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_slider_number_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_slider_number]', array(
		'label'   => __( 'Number of slides Enter the number of slides you want then click "Save Options".', 'accelerate' ),
		'setting' => 'accelerate[accelerate_slider_number]',
		'section' => 'accelerate_slider_setting_section',
	) );

	// slider image link option
	$wp_customize->add_setting( 'accelerate[accelerate_slider_image_link_option]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_slider_image_link_option]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to make the slider images link back to respective links.', 'accelerate' ),
		'section'  => 'accelerate_slider_setting_section',
		'settings' => 'accelerate[accelerate_slider_image_link_option]',
	) );

	// slider full width option
	$wp_customize->add_setting( 'accelerate[accelerate_slider_image_cover_full_width_option]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'accelerate_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_slider_image_cover_full_width_option]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to make the slider cover the full width of its container', 'accelerate' ),
		'section'  => 'accelerate_slider_setting_section',
		'settings' => 'accelerate[accelerate_slider_image_cover_full_width_option]',
	) );

	$num_of_slides = accelerate_options( 'accelerate_slider_number', '4' );
	for ( $i = 1; $i <= $num_of_slides; $i ++ ) {
		// adding slider section
		$wp_customize->add_section( 'accelerate_slider_number_section' . $i, array(
			'priority' => 10,
			'title'    => sprintf( __( 'Slider #%1$s', 'accelerate' ), $i ),
			'panel'    => 'accelerate_slider_options',
		) );

		// adding slider image url
		$wp_customize->add_setting( 'accelerate[accelerate_slider_image' . $i . ']', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'accelerate[accelerate_slider_image' . $i . ']', array(
			'label'   => __( 'Upload image', 'accelerate' ),
			'section' => 'accelerate_slider_number_section' . $i,
			'setting' => 'accelerate[accelerate_slider_image' . $i . ']',
		) ) );

		// adding slider title
		$wp_customize->add_setting( 'accelerate[accelerate_slider_title' . $i . ']', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		) );

		$wp_customize->add_control( 'accelerate[accelerate_slider_title' . $i . ']', array(
			'label'   => __( 'Enter title for this slide', 'accelerate' ),
			'section' => 'accelerate_slider_number_section' . $i,
			'setting' => 'accelerate[accelerate_slider_title' . $i . ']',
		) );

		// adding slider description
		$wp_customize->add_setting( 'accelerate[accelerate_slider_text' . $i . ']', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_text_sanitize',
		) );

		$wp_customize->add_control( new Accelerate_Text_Area_Control( $wp_customize, 'accelerate[accelerate_slider_text' . $i . ']', array(
			'label'   => __( 'Enter description for this slide', 'accelerate' ),
			'section' => 'accelerate_slider_number_section' . $i,
			'setting' => 'accelerate[accelerate_slider_text' . $i . ']',
		) ) );

		// adding slider text position
		$wp_customize->add_setting( 'accelerate[accelerate_slide_text_position' . $i . ']', array(
			'default'           => 'right',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_radio_select_sanitize',
		) );

		$wp_customize->add_control( 'accelerate[accelerate_slide_text_position' . $i . ']', array(
			'type'    => 'radio',
			'label'   => __( 'Slider text position.', 'accelerate' ),
			'section' => 'accelerate_slider_number_section' . $i,
			'setting' => 'accelerate[accelerate_slide_text_position' . $i . ']',
			'choices' => array(
				'right' => __( 'Right side', 'accelerate' ),
				'left'  => __( 'Left side', 'accelerate' ),
			),
		) );

		// adding button url
		$wp_customize->add_setting( 'accelerate[accelerate_slider_link' . $i . ']', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( 'accelerate[accelerate_slider_link' . $i . ']', array(
			'label'   => __( 'Enter link to redirect for the slide title', 'accelerate' ),
			'section' => 'accelerate_slider_number_section' . $i,
			'setting' => 'accelerate[accelerate_slider_link' . $i . ']',
		) );
	}
	// End of Slider Options

	// Start of the Typography Option.
	$wp_customize->add_panel( 'accelerate_typography_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 520,
		'title'      => __( 'Typography', 'accelerate' ),
	) );

	$accelerate_fonts_families = array(
		'accelerate_site_title_font'   => array(
			'id'      => 'accelerate[accelerate_site_title_font]',
			'default' => 'Roboto+Slab:700,400',
			'title'   => __( 'Site title font. Default is "Roboto Slab".', 'accelerate' ),
		),
		'accelerate_site_tagline_font' => array(
			'id'      => 'accelerate[accelerate_site_tagline_font]',
			'default' => 'Roboto+Slab:700,400',
			'title'   => __( 'Site tagline font. Default is "Roboto Slab".', 'accelerate' ),
		),
		'accelerate_primary_menu_font' => array(
			'id'      => 'accelerate[accelerate_primary_menu_font]',
			'default' => 'Roboto:400,300,100',
			'title'   => __( 'Primary menu font. Default is "Roboto".', 'accelerate' ),
		),
		'accelerate_header_menu_font'  => array(
			'id'      => 'accelerate[accelerate_header_menu_font]',
			'default' => 'Roboto:400,300,100',
			'title'   => __( 'Header menu font. Default is "Roboto".', 'accelerate' ),
		),
		'accelerate_titles_font'       => array(
			'id'      => 'accelerate[accelerate_titles_font]',
			'default' => 'Roboto+Slab:700,400',
			'title'   => __( 'All Titles font. Default is "Roboto Slab".', 'accelerate' ),
		),
		'accelerate_content_font'      => array(
			'id'      => 'accelerate[accelerate_content_font]',
			'default' => 'Roboto:400,300,100',
			'title'   => __( 'Content font and for others. Default is "Roboto".', 'accelerate' ),
		),
	);

	$wp_customize->add_section( 'accelerate_google_font_section', array(
		'priority' => 1,
		'title'    => __( 'Google Font Options', 'accelerate' ),
		'panel'    => 'accelerate_typography_options',
	) );

	foreach ( $accelerate_fonts_families as $accelerate_fonts_family ) {

		$wp_customize->add_setting( $accelerate_fonts_family['id'], array(
			'default'           => $accelerate_fonts_family['default'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_fonts_sanitize',
		) );

		$wp_customize->add_control(
			new Accelerate_Typography_Control(
				$wp_customize,
				$accelerate_fonts_family['id'], array(
					'label'   => $accelerate_fonts_family['title'],
					'section' => 'accelerate_google_font_section',
					'setting' => $accelerate_fonts_family['id'],
				)
			)
		);

	}

	// Font Size options
	$accelerate_font_size_range_10_16 = array(
		'10' => '10',
		'11' => '11',
		'12' => '12',
		'13' => '13',
		'14' => '14',
		'15' => '15',
		'16' => '16',
	);
	$accelerate_font_size_range_10_18 = array(
		'10' => '10',
		'11' => '11',
		'12' => '12',
		'13' => '13',
		'14' => '14',
		'15' => '15',
		'16' => '16',
		'17' => '17',
		'18' => '18',
	);
	$accelerate_font_size_range_12_20 = array(
		'12' => '12',
		'13' => '13',
		'14' => '14',
		'15' => '15',
		'16' => '16',
		'17' => '17',
		'18' => '18',
		'19' => '19',
		'20' => '20',
	);
	$accelerate_font_size_range_16_30 = array(
		'16' => '16',
		'17' => '17',
		'18' => '18',
		'19' => '19',
		'20' => '20',
		'21' => '21',
		'22' => '22',
		'23' => '23',
		'24' => '24',
		'25' => '25',
		'26' => '26',
		'27' => '27',
		'28' => '28',
		'29' => '29',
		'30' => '30',
	);
	$accelerate_font_size_range_18_30 = array(
		'18' => '18',
		'19' => '19',
		'20' => '20',
		'21' => '21',
		'22' => '22',
		'23' => '23',
		'24' => '24',
		'25' => '25',
		'26' => '26',
		'27' => '27',
		'28' => '28',
		'29' => '29',
		'30' => '30',
	);
	$accelerate_font_size_range_20_34 = array(
		'20' => '20',
		'21' => '21',
		'22' => '22',
		'23' => '23',
		'24' => '24',
		'25' => '25',
		'26' => '26',
		'27' => '27',
		'28' => '28',
		'29' => '29',
		'30' => '30',
		'31' => '31',
		'32' => '32',
		'33' => '33',
		'34' => '34',
	);
	$accelerate_font_size_range_24_40 = array(
		'24' => '24',
		'25' => '25',
		'26' => '26',
		'27' => '27',
		'28' => '28',
		'29' => '29',
		'30' => '30',
		'31' => '31',
		'32' => '32',
		'33' => '33',
		'34' => '34',
		'35' => '35',
		'36' => '36',
		'37' => '37',
		'38' => '38',
		'39' => '39',
		'40' => '40',
	);
	$accelerate_font_size_range_26_46 = array(
		'26' => '26',
		'27' => '27',
		'28' => '28',
		'29' => '29',
		'30' => '30',
		'31' => '31',
		'32' => '32',
		'33' => '33',
		'34' => '34',
		'35' => '35',
		'36' => '36',
		'37' => '37',
		'38' => '38',
		'39' => '39',
		'40' => '40',
		'41' => '41',
		'42' => '42',
		'43' => '43',
		'44' => '44',
		'45' => '45',
		'46' => '46',
	);

	// header font size options
	$accelerate_header_font_sizes = array(
		'accelerate_site_title_font_size'       => array(
			'id'      => 'accelerate[accelerate_site_title_font_size]',
			'default' => '36',
			'title'   => __( 'Site title font size. Default is 36px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_26_46,
		),
		'accelerate_tagline_font_size'          => array(
			'id'      => 'accelerate[accelerate_tagline_font_size]',
			'default' => '16',
			'title'   => __( 'Site tagline font size. Default is 16px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_12_20,
		),
		'accelerate_primary_menu_font_size'     => array(
			'id'      => 'accelerate[accelerate_primary_menu_font_size]',
			'default' => '16',
			'title'   => __( 'Primary menu. Default is 16px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_12_20,
		),
		'accelerate_primary_sub_menu_font_size' => array(
			'id'      => 'accelerate[accelerate_primary_sub_menu_font_size]',
			'default' => '14',
			'title'   => __( 'Primary sub menu. Default is 14px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_10_18,
		),
		'accelerate_header_menu_font_size'      => array(
			'id'      => 'accelerate[accelerate_header_menu_font_size]',
			'default' => '14',
			'title'   => __( 'Header menu. Default is 14px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_10_18,
		),
		'accelerate_header_sub_menu_font_size'  => array(
			'id'      => 'accelerate[accelerate_header_sub_menu_font_size]',
			'default' => '12',
			'title'   => __( 'Header sub menu. Default is 12px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_10_16,
		),
	);

	$wp_customize->add_section( 'accelerate_header_font_size_section', array(
		'priority' => 2,
		'title'    => __( 'Header font size Options', 'accelerate' ),
		'panel'    => 'accelerate_typography_options',
	) );

	foreach ( $accelerate_header_font_sizes as $accelerate_header_font_size ) {

		$wp_customize->add_setting( $accelerate_header_font_size['id'], array(
			'default'           => $accelerate_header_font_size['default'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_radio_select_sanitize',
		) );

		$wp_customize->add_control( $accelerate_header_font_size['id'], array(
			'label'   => $accelerate_header_font_size['title'],
			'type'    => 'select',
			'section' => 'accelerate_header_font_size_section',
			'setting' => $accelerate_header_font_size['id'],
			'choices' => $accelerate_header_font_size['choice'],
		) );

	}

	// slider font size options
	$accelerate_slider_font_sizes = array(
		'accelerate_slider_title_font_size'   => array(
			'id'      => 'accelerate[accelerate_slider_title_font_size]',
			'default' => '22',
			'title'   => __( 'Slider title. Default is 22px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_18_30,
		),
		'accelerate_slider_content_font_size' => array(
			'id'      => 'accelerate[accelerate_slider_content_font_size]',
			'default' => '15',
			'title'   => __( 'Slider content. Default is 15px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_10_18,
		),
	);

	$wp_customize->add_section( 'accelerate_slider_font_size_section', array(
		'priority' => 3,
		'title'    => __( 'Slider font size Options', 'accelerate' ),
		'panel'    => 'accelerate_typography_options',
	) );

	foreach ( $accelerate_slider_font_sizes as $accelerate_slider_font_size ) {

		$wp_customize->add_setting( $accelerate_slider_font_size['id'], array(
			'default'           => $accelerate_slider_font_size['default'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_radio_select_sanitize',
		) );

		$wp_customize->add_control( $accelerate_slider_font_size['id'], array(
			'label'   => $accelerate_slider_font_size['title'],
			'type'    => 'select',
			'section' => 'accelerate_slider_font_size_section',
			'setting' => $accelerate_slider_font_size['id'],
			'choices' => $accelerate_slider_font_size['choice'],
		) );

	}

	// title font size options
	$accelerate_titles_font_sizes = array(
		'accelerate_h1_title_font_size'                    => array(
			'id'      => 'accelerate[accelerate_h1_title_font_size]',
			'default' => '30',
			'title'   => __( 'Heading h1 tag. Default is 30px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_24_40,
		),
		'accelerate_h2_title_font_size'                    => array(
			'id'      => 'accelerate[accelerate_h2_title_font_size]',
			'default' => '28',
			'title'   => __( 'Heading h2 tag. Default is 28px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_20_34,
		),
		'accelerate_h3_title_font_size'                    => array(
			'id'      => 'accelerate[accelerate_h3_title_font_size]',
			'default' => '26',
			'title'   => __( 'Heading h3 tag. Default is 26px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_20_34,
		),
		'accelerate_h4_title_font_size'                    => array(
			'id'      => 'accelerate[accelerate_h4_title_font_size]',
			'default' => '24',
			'title'   => __( 'Heading h4 tag. Default is 24px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_18_30,
		),
		'accelerate_h5_title_font_size'                    => array(
			'id'      => 'accelerate[accelerate_h5_title_font_size]',
			'default' => '22',
			'title'   => __( 'Heading h5 tag. Default is 22px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_16_30,
		),
		'accelerate_h6_title_font_size'                    => array(
			'id'      => 'accelerate[accelerate_h6_title_font_size]',
			'default' => '19',
			'title'   => __( 'Heading h6 tag. Default is 19px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_16_30,
		),
		'accelerate_image_service_widget_title_font_size'  => array(
			'id'      => 'accelerate[accelerate_image_service_widget_title_font_size]',
			'default' => '22',
			'title'   => __( 'TG: Image Services widget title. Default is 22px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_16_30,
		),
		'accelerate_call_to_action_widget_title_font_size' => array(
			'id'      => 'accelerate[accelerate_call_to_action_widget_title_font_size]',
			'default' => '28',
			'title'   => __( 'TG: Call to Action widget title. Default is 28px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_20_34,
		),
		'accelerate_featured_widget_titles_font_size'      => array(
			'id'      => 'accelerate[accelerate_featured_widget_titles_font_size]',
			'default' => '16',
			'title'   => __( 'TG: Featured Widget titles that appear over images. Default is 16px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_12_20,
		),
		'accelerate_widget_titles_font_size'               => array(
			'id'      => 'accelerate[accelerate_widget_titles_font_size]',
			'default' => '22',
			'title'   => __( 'Widget Titles. Default is 22px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_16_30,
		),
		'accelerate_post_title_font_size'                  => array(
			'id'      => 'accelerate[accelerate_post_title_font_size]',
			'default' => '26',
			'title'   => __( 'Post Title. Default is 26px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_20_34,
		),
		'accelerate_page_title_font_size'                  => array(
			'id'      => 'accelerate[accelerate_page_title_font_size]',
			'default' => '30',
			'title'   => __( 'Page Title. Default is 30px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_20_34,
		),
		'accelerate_comment_title_font_size'               => array(
			'id'      => 'accelerate[accelerate_comment_title_font_size]',
			'default' => '26',
			'title'   => __( 'Comment Title. Default is 26px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_20_34,
		),
	);

	$wp_customize->add_section( 'accelerate_titles_font_size_section', array(
		'priority' => 4,
		'title'    => __( 'Titles related font size options', 'accelerate' ),
		'panel'    => 'accelerate_typography_options',
	) );

	foreach ( $accelerate_titles_font_sizes as $accelerate_titles_font_size ) {

		$wp_customize->add_setting( $accelerate_titles_font_size['id'], array(
			'default'           => $accelerate_titles_font_size['default'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_radio_select_sanitize',
		) );

		$wp_customize->add_control( $accelerate_titles_font_size['id'], array(
			'label'   => $accelerate_titles_font_size['title'],
			'type'    => 'select',
			'section' => 'accelerate_titles_font_size_section',
			'setting' => $accelerate_titles_font_size['id'],
			'choices' => $accelerate_titles_font_size['choice'],
		) );

	}

	// content font sizes
	$accelerate_content_font_sizes = array(
		'accelerate_content_font_size'         => array(
			'id'      => 'accelerate[accelerate_content_font_size]',
			'default' => '16',
			'title'   => __( 'Content font size, also applies to other text like in search fields, post comment button etc. Default is 16px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_12_20,
		),
		'accelerate_post_meta_font_size'       => array(
			'id'      => 'accelerate[accelerate_post_meta_font_size]',
			'default' => '16',
			'title'   => __( 'Post meta font size: author and categories. Default is 16px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_12_20,
		),
		'accelerate_other_post_meta_font_size' => array(
			'id'      => 'accelerate[accelerate_other_post_meta_font_size]',
			'default' => '12',
			'title'   => __( 'Post meta font size: other than author and categories. Default is 12px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_10_18,
		),
	);

	$wp_customize->add_section( 'accelerate_content_font_size_section', array(
		'priority' => 5,
		'title'    => __( 'Content font size options', 'accelerate' ),
		'panel'    => 'accelerate_typography_options',
	) );

	foreach ( $accelerate_content_font_sizes as $accelerate_content_font_size ) {

		$wp_customize->add_setting( $accelerate_content_font_size['id'], array(
			'default'           => $accelerate_content_font_size['default'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_radio_select_sanitize',
		) );

		$wp_customize->add_control( $accelerate_content_font_size['id'], array(
			'label'   => $accelerate_content_font_size['title'],
			'type'    => 'select',
			'section' => 'accelerate_content_font_size_section',
			'setting' => $accelerate_content_font_size['id'],
			'choices' => $accelerate_content_font_size['choice'],
		) );

	}

	// footer font sizes
	$accelerate_footer_font_sizes = array(
		'accelerate_footer_widget_titles_font_size'  => array(
			'id'      => 'accelerate[accelerate_footer_widget_titles_font_size]',
			'default' => '22',
			'title'   => __( 'Footer widget Titles. Default is 22px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_16_30,
		),
		'accelerate_footer_widget_content_font_size' => array(
			'id'      => 'accelerate[accelerate_footer_widget_content_font_size]',
			'default' => '14',
			'title'   => __( 'Footer widget content font size. Default is 14px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_10_18,
		),
		'accelerate_footer_copyright_text_font_size' => array(
			'id'      => 'accelerate[accelerate_footer_copyright_text_font_size]',
			'default' => '12',
			'title'   => __( 'Footer copyright text font size. Default is 12px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_10_16,
		),
		'accelerate_small_footer_menu_font_size'     => array(
			'id'      => 'accelerate[accelerate_small_footer_menu_font_size]',
			'default' => '12',
			'title'   => __( 'Footer small menu. Default is 12px.', 'accelerate' ),
			'choice'  => $accelerate_font_size_range_10_16,
		),
	);

	$wp_customize->add_section( 'accelerate_footer_font_size_section', array(
		'priority' => 5,
		'title'    => __( 'Footer font size options', 'accelerate' ),
		'panel'    => 'accelerate_typography_options',
	) );

	foreach ( $accelerate_footer_font_sizes as $accelerate_footer_font_size ) {

		$wp_customize->add_setting( $accelerate_footer_font_size['id'], array(
			'default'           => $accelerate_footer_font_size['default'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'accelerate_radio_select_sanitize',
		) );

		$wp_customize->add_control( $accelerate_footer_font_size['id'], array(
			'label'   => $accelerate_footer_font_size['title'],
			'type'    => 'select',
			'section' => 'accelerate_footer_font_size_section',
			'setting' => $accelerate_footer_font_size['id'],
			'choices' => $accelerate_footer_font_size['choice'],
		) );

	}
	// End of Typography Options

	// Start of Color Options
	$wp_customize->add_panel( 'accelerate_color_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 525,
		'title'      => __( 'Color', 'accelerate' ),
	) );

	// Site primary color option
	$wp_customize->add_section( 'accelerate_primary_color_setting', array(
		'panel'    => 'accelerate_color_options',
		'priority' => 1,
		'title'    => __( 'Primary color option', 'accelerate' ),
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_primary_color]', array(
		'default'              => '#77cc6d',
		'type'                 => 'option',
		'transport'            => 'postMessage',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
		'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accelerate[accelerate_primary_color]', array(
		'label'    => __( 'This will reflect in links, buttons and many others. Choose a color to match your site.', 'accelerate' ),
		'section'  => 'accelerate_primary_color_setting',
		'settings' => 'accelerate[accelerate_primary_color]',
	) ) );

	// Font Color options
	// header color options
	$accelerate_header_colors = array(
		'accelerate_site_title_text_color'              => array(
			'id'      => 'accelerate[accelerate_site_title_text_color]',
			'title'   => __( 'Site Title. Default is #555555.', 'accelerate' ),
			'default' => '#555555',
		),
		'accelerate_site_tagline_text_color'            => array(
			'id'      => 'accelerate[accelerate_site_tagline_text_color]',
			'title'   => __( 'Site Tagline. Default is #999999.', 'accelerate' ),
			'default' => '#999999',
		),
		'accelerate_primary_menu_text_color'            => array(
			'id'      => 'accelerate[accelerate_primary_menu_text_color]',
			'title'   => __( 'Primary menu text color. Default is #444444.', 'accelerate' ),
			'default' => '#444444',
		),
		'accelerate_primary_menu_background_color'      => array(
			'id'      => 'accelerate[accelerate_primary_menu_background_color]',
			'title'   => __( 'Primary menu selected/hovered item background color. Default is #77cc6d.', 'accelerate' ),
			'default' => '#77cc6d',
		),
		'accelerate_primary_menu_bar_background_color'  => array(
			'id'      => 'accelerate[accelerate_primary_menu_bar_background_color]',
			'title'   => __( 'Primary menu bar (unselected/unhovered) background color. Default is #ffffff.', 'accelerate' ),
			'default' => '#ffffff',
		),
		'accelerate_header_background_color'            => array(
			'id'      => 'accelerate[accelerate_header_background_color]',
			'title'   => __( 'Header background color. Default is #f8f8f8.', 'accelerate' ),
			'default' => '#f8f8f8',
		),
		'accelerate_header_top_bar_background_color'    => array(
			'id'      => 'accelerate[accelerate_header_top_bar_background_color]',
			'title'   => __( 'Header top bar background color. Default is #262626.', 'accelerate' ),
			'default' => '#262626',
		),
		'accelerate_top_menu_item_color'                => array(
			'id'      => 'accelerate[accelerate_top_menu_item_color]',
			'title'   => __( 'Header top menu item text color. Default is #cccccc.', 'accelerate' ),
			'default' => '#cccccc',
		),
		'accelerate_top_menu_selected_item_color'       => array(
			'id'      => 'accelerate[accelerate_top_menu_selected_item_color]',
			'title'   => __( 'Header top menu seleted/hovered item text color. Default is #ffffff.', 'accelerate' ),
			'default' => '#ffffff',
		),
		'accelerate_top_menu_dropdown_background_color' => array(
			'id'      => 'accelerate[accelerate_top_menu_dropdown_background_color]',
			'title'   => __( 'Header menu dropdown background color. Default is #262626.', 'accelerate' ),
			'default' => '#262626',
		),
		'accelerate_header_top_line_color'              => array(
			'id'      => 'accelerate[accelerate_header_top_line_color]',
			'title'   => __( 'Header top line color. Default is #77cc6d.', 'accelerate' ),
			'default' => '#77cc6d',
		),
	);

	$wp_customize->add_section( 'accelerate_header_color_section', array(
		'priority' => 2,
		'title'    => __( 'Header Color Options', 'accelerate' ),
		'panel'    => 'accelerate_color_options',
	) );

	foreach ( $accelerate_header_colors as $accelerate_header_color ) {

		$wp_customize->add_setting( $accelerate_header_color['id'], array(
			'default'              => $accelerate_header_color['default'],
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
			'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
			'transport'            => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $accelerate_header_color['id'], array(
			'label'    => $accelerate_header_color['title'],
			'section'  => 'accelerate_header_color_section',
			'settings' => $accelerate_header_color['id'],
		) ) );

	}

	// slider part color options
	$accelerate_slider_colors = array(
		'accelerate_slider_title_color'            => array(
			'id'      => 'accelerate[accelerate_slider_title_color]',
			'title'   => __( 'Slider title. Default is #ffffff.', 'accelerate' ),
			'default' => '#ffffff',
		),
		'accelerate_slider_title_background_color' => array(
			'id'      => 'accelerate[accelerate_slider_title_background_color]',
			'title'   => __( 'Slider title box background color. Default is #77cc6d.', 'accelerate' ),
			'default' => '#77cc6d',
		),
		'accelerate_slider_content_color'          => array(
			'id'      => 'accelerate[accelerate_slider_content_color]',
			'title'   => __( 'Slider content. Default is #ffffff.', 'accelerate' ),
			'default' => '#ffffff',
		),
		'accelerate_slider_background_color'       => array(
			'id'      => 'accelerate[accelerate_slider_background_color]',
			'title'   => __( 'Slider background color. Default is #ffffff.', 'accelerate' ),
			'default' => '#ffffff',
		),
	);

	$wp_customize->add_section( 'accelerate_slider_color_section', array(
		'priority' => 3,
		'title'    => __( 'Slider part color options', 'accelerate' ),
		'panel'    => 'accelerate_color_options',
	) );

	foreach ( $accelerate_slider_colors as $accelerate_slider_color ) {

		$wp_customize->add_setting( $accelerate_slider_color['id'], array(
			'default'              => $accelerate_slider_color['default'],
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
			'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
			'transport'            => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $accelerate_slider_color['id'], array(
			'label'    => $accelerate_slider_color['title'],
			'section'  => 'accelerate_slider_color_section',
			'settings' => $accelerate_slider_color['id'],
		) ) );

	}

	// content color options
	$accelerate_content_colors = array(
		'accelerate_content_part_titles_color'       => array(
			'id'      => 'accelerate[accelerate_content_part_titles_color]',
			'title'   => __( 'Content Part titles color. Default is #444444.', 'accelerate' ),
			'default' => '#444444',
		),
		'accelerate_posts_title_color'               => array(
			'id'      => 'accelerate[accelerate_posts_title_color]',
			'title'   => __( 'Posts title color. Default is #444444.', 'accelerate' ),
			'default' => '#444444',
		),
		'accelerate_page_title_color'                => array(
			'id'      => 'accelerate[accelerate_page_title_color]',
			'title'   => __( 'Page title color. Default is #444444.', 'accelerate' ),
			'default' => '#444444',
		),
		'accelerate_content_text_color'              => array(
			'id'      => 'accelerate[accelerate_content_text_color]',
			'title'   => __( 'Content text color. Default is #666666.', 'accelerate' ),
			'default' => '#666666',
		),
		'accelerate_post_meta_color'                 => array(
			'id'      => 'accelerate[accelerate_post_meta_color]',
			'title'   => __( 'Post meta (author and category) color. Default is #77cc6d.', 'accelerate' ),
			'default' => '#77cc6d',
		),
		'accelerate_post_other_meta_color'           => array(
			'id'      => 'accelerate[accelerate_post_other_meta_color]',
			'title'   => __( 'Post meta (other than author and category) color. Default is #aaaaaa.', 'accelerate' ),
			'default' => '#aaaaaa',
		),
		'accelerate_button_text_color'               => array(
			'id'      => 'accelerate[accelerate_button_text_color]',
			'title'   => __( 'Button text color. Default is #ffffff.', 'accelerate' ),
			'default' => '#ffffff',
		),
		'accelerate_button_background_color'         => array(
			'id'      => 'accelerate[accelerate_button_background_color]',
			'title'   => __( 'Button background color. Default is #77cc6d.', 'accelerate' ),
			'default' => '#77cc6d',
		),
		'accelerate_widget_title_color'              => array(
			'id'      => 'accelerate[accelerate_widget_title_color]',
			'title'   => __( 'Left and Right sidebar widget title color. Default is #444444.', 'accelerate' ),
			'default' => '#444444',
		),
		'accelerate_content_background_color'        => array(
			'id'      => 'accelerate[accelerate_content_background_color]',
			'title'   => __( 'Content section background color. Default is #ffffff.', 'accelerate' ),
			'default' => '#ffffff',
		),
		'accelerate_call_to_action_background_color' => array(
			'id'      => 'accelerate[accelerate_call_to_action_background_color]',
			'title'   => __( 'TG: Call to Action widget background color. Default is #f8f8f8.', 'accelerate' ),
			'default' => '#f8f8f8',
		),
		'accelerate_testimonial_background_color'    => array(
			'id'      => 'accelerate[accelerate_testimonial_background_color]',
			'title'   => __( 'TG: Testimonial widget text background color. Default is #fcfcfc.', 'accelerate' ),
			'default' => '#fcfcfc',
		),
	);

	$wp_customize->add_section( 'accelerate_content_color_section', array(
		'priority' => 4,
		'title'    => __( 'Content part color options', 'accelerate' ),
		'panel'    => 'accelerate_color_options',
	) );

	foreach ( $accelerate_content_colors as $accelerate_content_color ) {

		$wp_customize->add_setting( $accelerate_content_color['id'], array(
			'default'              => $accelerate_content_color['default'],
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
			'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
			'transport'            => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $accelerate_content_color['id'], array(
			'label'    => $accelerate_content_color['title'],
			'section'  => 'accelerate_content_color_section',
			'settings' => $accelerate_content_color['id'],
		) ) );

	}

	// footer color options
	$accelerate_footer_colors = array(
		'accelerate_footer_widget_title_color'              => array(
			'id'      => 'accelerate[accelerate_footer_widget_title_color]',
			'title'   => __( 'Widget title color. Default is #ffffff.', 'accelerate' ),
			'default' => '#ffffff',
		),
		'accelerate_footer_widget_content_color'            => array(
			'id'      => 'accelerate[accelerate_footer_widget_content_color]',
			'title'   => __( 'Footer widget content color. Default is #aaaaaa.', 'accelerate' ),
			'default' => '#aaaaaa',
		),
		'accelerate_footer_widget_link_color'               => array(
			'id'      => 'accelerate[accelerate_footer_widget_link_color]',
			'title'   => __( 'Footer widget content link text color. Default is #ffffff.', 'accelerate' ),
			'default' => '#ffffff',
		),
		'accelerate_footer_widget_background_color'         => array(
			'id'      => 'accelerate[accelerate_footer_widget_background_color]',
			'title'   => __( 'Footer widget background color. Default is #27313d.', 'accelerate' ),
			'default' => '#27313d',
		),
		'accelerate_footer_copyright_text_color'            => array(
			'id'      => 'accelerate[accelerate_footer_copyright_text_color]',
			'title'   => __( 'Footer copyright text color. Default is #666666.', 'accelerate' ),
			'default' => '#666666',
		),
		'accelerate_footer_small_menu_color'                => array(
			'id'      => 'accelerate[accelerate_footer_small_menu_color]',
			'title'   => __( 'Footer small menu text color. Default is #666666.', 'accelerate' ),
			'default' => '#666666',
		),
		'accelerate_footer_copyright_part_background_color' => array(
			'id'      => 'accelerate[accelerate_footer_copyright_part_background_color]',
			'title'   => __( 'Footer copyright part background color. Default is #f8f8f8.', 'accelerate' ),
			'default' => '#f8f8f8',
		),
	);

	$wp_customize->add_section( 'accelerate_footer_color_section', array(
		'priority' => 5,
		'title'    => __( 'Footer part color options', 'accelerate' ),
		'panel'    => 'accelerate_color_options',
	) );

	foreach ( $accelerate_footer_colors as $accelerate_footer_color ) {

		$wp_customize->add_setting( $accelerate_footer_color['id'], array(
			'default'              => $accelerate_footer_color['default'],
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
			'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
			'transport'            => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $accelerate_footer_color['id'], array(
			'label'    => $accelerate_footer_color['title'],
			'section'  => 'accelerate_footer_color_section',
			'settings' => $accelerate_footer_color['id'],
		) ) );

	}

	// Heading Color Options
	$wp_customize->add_section( 'accelerate_headings_color_setting', array(
		'panel'    => 'accelerate_color_options',
		'priority' => 6,
		'title'    => esc_html__( 'Headings', 'accelerate' ),
	) );

	$wp_customize->add_setting( 'accelerate[accelerate_h1_color]', array(
		'default'              => '#444444',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
		'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accelerate[accelerate_h1_color]', array(
		'label'    => esc_html__( 'H1', 'accelerate' ),
		'section'  => 'accelerate_headings_color_setting',
		'settings' => 'accelerate[accelerate_h1_color]',
	) ) );

	$wp_customize->add_setting( 'accelerate[accelerate_h2_color]', array(
		'default'              => '#444444',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
		'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accelerate[accelerate_h2_color]', array(
		'label'    => esc_html__( 'H2', 'accelerate' ),
		'section'  => 'accelerate_headings_color_setting',
		'settings' => 'accelerate[accelerate_h2_color]',
	) ) );

	$wp_customize->add_setting( 'accelerate[accelerate_h3_color]', array(
		'default'              => '#444444',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'accelerate_color_option_hex_sanitize',
		'sanitize_js_callback' => 'accelerate_color_escaping_option_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accelerate[accelerate_h3_color]', array(
		'label'    => esc_html__( 'H3', 'accelerate' ),
		'section'  => 'accelerate_headings_color_setting',
		'settings' => 'accelerate[accelerate_h3_color]',
	) ) );

	// End of Color Options

	// Start of the WordPress default options.
	// Background image clickable
	$wp_customize->add_setting( 'accelerate[accelerate_background_image_link]', array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'accelerate[accelerate_background_image_link]', array(
		'label'           => esc_html__( 'Add the background link url.', 'accelerate' ),
		'section'         => 'background_image',
		'setting'         => 'accelerate[accelerate_background_image_link]',
		'active_callback' => 'accelerate_background_image',
	) );
	// End of the WordPress default options.

	// Start of data sanitization
	// Radio/select sanitize.
	function accelerate_radio_select_sanitize( $input, $setting ) {
		// Ensuring that the input is a slug.
		$input = sanitize_key( $input );
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// Active CallBack for column option.
	function accelerate_blog_column_option() {
		if ( ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) == 'masonry_image' ) || ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) == 'grid_image' ) ) {
			return true;
		}

		return false;
	}

	function accelerate_archive_blog_column_option() {
		if ( ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) == 'grid_image' ) || ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) == 'masonry_image' ) ) {
			return true;
		}

		return false;
	}


	// Slider radio sanitize
	function accelerate_slider_radio_sanitize( $input, $setting ) {
		// Ensuring that the input is a slug.
		$input = sanitize_text_field( $input );
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// google fonts sanitization
	function accelerate_fonts_sanitize( $input ) {
		$accelerate_standard_fonts_array = accelerate_standard_fonts_array();
		$accelerate_google_fonts         = accelerate_google_fonts();
		$valid_keys                      = array_merge( $accelerate_standard_fonts_array, $accelerate_google_fonts );

		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	// checkbox sanitize
	function accelerate_checkbox_sanitize( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	// footer section sanitization
	function accelerate_footer_editor_sanitize( $input ) {
		if ( isset( $input ) ) {
			$input = stripslashes( wp_filter_post_kses( addslashes( $input ) ) );
		}

		return $input;
	}

	// color sanitization
	function accelerate_color_option_hex_sanitize( $color ) {
		if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
			return '#' . $unhashed;
		}

		return $color;
	}

	function accelerate_color_escaping_option_sanitize( $input ) {
		$input = esc_attr( $input );

		return $input;
	}

	// text-area sanitize
	function accelerate_text_sanitize( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}

	// excerpt length sanitize
	function accelerate_excerpt_length_sanitize( $input ) {
		if ( is_numeric( $input ) ) {
			return intval( $input );
		} else {
			return 40;
		}
	}

	// slider transition delay time sanitize
	function accelerate_slider_transition_delay_sanitize( $input ) {
		if ( is_numeric( $input ) ) {
			return intval( $input );
		} else {
			return 4;
		}
	}

	// slider transition length sanitize
	function accelerate_slider_transition_length_sanitize( $input ) {
		if ( is_numeric( $input ) ) {
			return intval( $input );
		} else {
			return 1;
		}
	}

	// slider number sanitize
	function accelerate_slider_number_sanitize( $input ) {
		if ( is_numeric( $input ) ) {
			return intval( $input );
		} else {
			return 4;
		}
	}

	// sanitization of links
	function accelerate_links_sanitize() {
		return false;
	}

	// Active callback for header title background image option.
	function accelerate_page_header_background_image() {

		if ( accelerate_options( 'accelerate_page_header_style', 'default' ) == 'default' ) {
			return false;
		}

		return true;
	}

}

add_action( 'customize_register', 'accelerate_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Accelerate 2.1.7
 */
function accelerate_customize_preview_js() {
	wp_enqueue_script( 'accelerate-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), false, true );
}

add_action( 'customize_preview_init', 'accelerate_customize_preview_js' );

/**
 * Enqueue customize controls scripts.
 */
function accelerate_enqueue_customize_controls() {

	/**
	 * Enqueue required Customize Controls CSS files.
	 */
	// Main CSS file.
	wp_enqueue_style(
		'accelerate-customize-controls',
		get_template_directory_uri() . '/css/customize-controls.css',
		array(),
		false
	);

	wp_enqueue_script(
		'accelerate-customize-controls',
		get_template_directory_uri() . '/js/customize-controls.js',
		array(
			'wp-color-picker',
		),
		false,
		true
	);
}

add_action( 'customize_controls_enqueue_scripts', 'accelerate_enqueue_customize_controls' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function accelerate_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function accelerate_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Check if the background image is set or not.
 *
 * @return bool
 */
function accelerate_background_image() {
	$background_image = get_background_image();
	if ( $background_image ) {
		return true;
	}

	return false;
}

if ( ! function_exists( 'accelerate_standard_fonts_array' ) ) :

	/**
	 * Standard Fonts array
	 *
	 * @return array of Standarad Fonts
	 */
	function accelerate_standard_fonts_array() {
		$accelerate_standard_fonts = array(
			'Georgia,Times,"Times New Roman",serif'                                                                                                 => 'serif',
			'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif' => 'sans-serif',
			'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace'                                                   => 'monospace',
		);

		return $accelerate_standard_fonts;
	}

endif;

if ( ! function_exists( 'accelerate_google_fonts' ) ) :

	/**
	 * Google Fonts array
	 *
	 * @return array of Google Fonts
	 */
	function accelerate_google_fonts() {
		$accelerate_google_font = array(
			'ABeeZee'                   => 'ABeeZee',
			'Abel'                      => 'Abel',
			'Abhaya Libre'              => 'Abhaya Libre',
			'Abril Fatface'             => 'Abril Fatface',
			'Aclonica'                  => 'Aclonica',
			'Acme'                      => 'Acme',
			'Actor'                     => 'Actor',
			'Adamina'                   => 'Adamina',
			'Advent Pro'                => 'Advent Pro',
			'Aguafina Script'           => 'Aguafina Script',
			'Akronim'                   => 'Akronim',
			'Aladin'                    => 'Aladin',
			'Aldrich'                   => 'Aldrich',
			'Alef'                      => 'Alef',
			'Alegreya'                  => 'Alegreya',
			'Alegreya SC'               => 'Alegreya SC',
			'Alegreya Sans'             => 'Alegreya Sans',
			'Alegreya Sans SC'          => 'Alegreya Sans SC',
			'Alex Brush'                => 'Alex Brush',
			'Alfa Slab One'             => 'Alfa Slab One',
			'Alice'                     => 'Alice',
			'Alike'                     => 'Alike',
			'Alike Angular'             => 'Alike Angular',
			'Allan'                     => 'Allan',
			'Allerta'                   => 'Allerta',
			'Allerta Stencil'           => 'Allerta Stencil',
			'Allura'                    => 'Allura',
			'Almendra'                  => 'Almendra',
			'Almendra Display'          => 'Almendra Display',
			'Almendra SC'               => 'Almendra SC',
			'Amarante'                  => 'Amarante',
			'Amaranth'                  => 'Amaranth',
			'Amatic SC'                 => 'Amatic SC',
			'Amatica SC'                => 'Amatica SC',
			'Amethysta'                 => 'Amethysta',
			'Amiko'                     => 'Amiko',
			'Amiri'                     => 'Amiri',
			'Amita'                     => 'Amita',
			'Anaheim'                   => 'Anaheim',
			'Andada'                    => 'Andada',
			'Andika'                    => 'Andika',
			'Angkor'                    => 'Angkor',
			'Annie Use Your Telescope'  => 'Annie Use Your Telescope',
			'Anonymous Pro'             => 'Anonymous Pro',
			'Antic'                     => 'Antic',
			'Antic Didone'              => 'Antic Didone',
			'Antic Slab'                => 'Antic Slab',
			'Anton'                     => 'Anton',
			'Arapey'                    => 'Arapey',
			'Arbutus'                   => 'Arbutus',
			'Arbutus Slab'              => 'Arbutus Slab',
			'Architects Daughter'       => 'Architects Daughter',
			'Archivo Black'             => 'Archivo Black',
			'Archivo Narrow'            => 'Archivo Narrow',
			'Aref Ruqaa'                => 'Aref Ruqaa',
			'Arima Madurai'             => 'Arima Madurai',
			'Arimo'                     => 'Arimo',
			'Arizonia'                  => 'Arizonia',
			'Armata'                    => 'Armata',
			'Arsenal'                   => 'Arsenal',
			'Artifika'                  => 'Artifika',
			'Arvo'                      => 'Arvo',
			'Arya'                      => 'Arya',
			'Asap'                      => 'Asap',
			'Asar'                      => 'Asar',
			'Asset'                     => 'Asset',
			'Assistant'                 => 'Assistant',
			'Astloch'                   => 'Astloch',
			'Asul'                      => 'Asul',
			'Athiti'                    => 'Athiti',
			'Atma'                      => 'Atma',
			'Atomic Age'                => 'Atomic Age',
			'Aubrey'                    => 'Aubrey',
			'Audiowide'                 => 'Audiowide',
			'Autour One'                => 'Autour One',
			'Average'                   => 'Average',
			'Average Sans'              => 'Average Sans',
			'Averia Gruesa Libre'       => 'Averia Gruesa Libre',
			'Averia Libre'              => 'Averia Libre',
			'Averia Sans Libre'         => 'Averia Sans Libre',
			'Averia Serif Libre'        => 'Averia Serif Libre',
			'Bad Script'                => 'Bad Script',
			'Bahiana'                   => 'Bahiana',
			'Baloo'                     => 'Baloo',
			'Baloo Bhai'                => 'Baloo Bhai',
			'Baloo Bhaina'              => 'Baloo Bhaina',
			'Baloo Chettan'             => 'Baloo Chettan',
			'Baloo Da'                  => 'Baloo Da',
			'Baloo Paaji'               => 'Baloo Paaji',
			'Baloo Tamma'               => 'Baloo Tamma',
			'Baloo Thambi'              => 'Baloo Thambi',
			'Balthazar'                 => 'Balthazar',
			'Bangers'                   => 'Bangers',
			'Barrio'                    => 'Barrio',
			'Basic'                     => 'Basic',
			'Battambang'                => 'Battambang',
			'Baumans'                   => 'Baumans',
			'Bayon'                     => 'Bayon',
			'Belgrano'                  => 'Belgrano',
			'Belleza'                   => 'Belleza',
			'BenchNine'                 => 'BenchNine',
			'Bentham'                   => 'Bentham',
			'Berkshire Swash'           => 'Berkshire Swash',
			'Bevan'                     => 'Bevan',
			'Bigelow Rules'             => 'Bigelow Rules',
			'Bigshot One'               => 'Bigshot One',
			'Bilbo'                     => 'Bilbo',
			'Bilbo Swash Caps'          => 'Bilbo Swash Caps',
			'BioRhyme'                  => 'BioRhyme',
			'BioRhyme Expanded'         => 'BioRhyme Expanded',
			'Biryani'                   => 'Biryani',
			'Bitter'                    => 'Bitter',
			'Black Ops One'             => 'Black Ops One',
			'Bokor'                     => 'Bokor',
			'Bonbon'                    => 'Bonbon',
			'Boogaloo'                  => 'Boogaloo',
			'Bowlby One'                => 'Bowlby One',
			'Bowlby One SC'             => 'Bowlby One SC',
			'Brawler'                   => 'Brawler',
			'Bree Serif'                => 'Bree Serif',
			'Bubblegum Sans'            => 'Bubblegum Sans',
			'Bubbler One'               => 'Bubbler One',
			'Buda'                      => 'Buda',
			'Buenard'                   => 'Buenard',
			'Bungee'                    => 'Bungee',
			'Bungee Hairline'           => 'Bungee Hairline',
			'Bungee Inline'             => 'Bungee Inline',
			'Bungee Outline'            => 'Bungee Outline',
			'Bungee Shade'              => 'Bungee Shade',
			'Butcherman'                => 'Butcherman',
			'Butterfly Kids'            => 'Butterfly Kids',
			'Cabin'                     => 'Cabin',
			'Cabin Condensed'           => 'Cabin Condensed',
			'Cabin Sketch'              => 'Cabin Sketch',
			'Caesar Dressing'           => 'Caesar Dressing',
			'Cagliostro'                => 'Cagliostro',
			'Cairo'                     => 'Cairo',
			'Calligraffitti'            => 'Calligraffitti',
			'Cambay'                    => 'Cambay',
			'Cambo'                     => 'Cambo',
			'Candal'                    => 'Candal',
			'Cantarell'                 => 'Cantarell',
			'Cantata One'               => 'Cantata One',
			'Cantora One'               => 'Cantora One',
			'Capriola'                  => 'Capriola',
			'Cardo'                     => 'Cardo',
			'Carme'                     => 'Carme',
			'Carrois Gothic'            => 'Carrois Gothic',
			'Carrois Gothic SC'         => 'Carrois Gothic SC',
			'Carter One'                => 'Carter One',
			'Catamaran'                 => 'Catamaran',
			'Caudex'                    => 'Caudex',
			'Caveat'                    => 'Caveat',
			'Caveat Brush'              => 'Caveat Brush',
			'Cedarville Cursive'        => 'Cedarville Cursive',
			'Ceviche One'               => 'Ceviche One',
			'Changa'                    => 'Changa',
			'Changa One'                => 'Changa One',
			'Chango'                    => 'Chango',
			'Chathura'                  => 'Chathura',
			'Chau Philomene One'        => 'Chau Philomene One',
			'Chela One'                 => 'Chela One',
			'Chelsea Market'            => 'Chelsea Market',
			'Chenla'                    => 'Chenla',
			'Cherry Cream Soda'         => 'Cherry Cream Soda',
			'Cherry Swash'              => 'Cherry Swash',
			'Chewy'                     => 'Chewy',
			'Chicle'                    => 'Chicle',
			'Chivo'                     => 'Chivo',
			'Chonburi'                  => 'Chonburi',
			'Cinzel'                    => 'Cinzel',
			'Cinzel Decorative'         => 'Cinzel Decorative',
			'Clicker Script'            => 'Clicker Script',
			'Coda'                      => 'Coda',
			'Coda Caption'              => 'Coda Caption',
			'Codystar'                  => 'Codystar',
			'Coiny'                     => 'Coiny',
			'Combo'                     => 'Combo',
			'Comfortaa'                 => 'Comfortaa',
			'Coming Soon'               => 'Coming Soon',
			'Concert One'               => 'Concert One',
			'Condiment'                 => 'Condiment',
			'Content'                   => 'Content',
			'Contrail One'              => 'Contrail One',
			'Convergence'               => 'Convergence',
			'Cookie'                    => 'Cookie',
			'Copse'                     => 'Copse',
			'Corben'                    => 'Corben',
			'Cormorant'                 => 'Cormorant',
			'Cormorant Garamond'        => 'Cormorant Garamond',
			'Cormorant Infant'          => 'Cormorant Infant',
			'Cormorant SC'              => 'Cormorant SC',
			'Cormorant Unicase'         => 'Cormorant Unicase',
			'Cormorant Upright'         => 'Cormorant Upright',
			'Courgette'                 => 'Courgette',
			'Cousine'                   => 'Cousine',
			'Coustard'                  => 'Coustard',
			'Covered By Your Grace'     => 'Covered By Your Grace',
			'Crafty Girls'              => 'Crafty Girls',
			'Creepster'                 => 'Creepster',
			'Crete Round'               => 'Crete Round',
			'Crimson Text'              => 'Crimson Text',
			'Croissant One'             => 'Croissant One',
			'Crushed'                   => 'Crushed',
			'Cuprum'                    => 'Cuprum',
			'Cutive'                    => 'Cutive',
			'Cutive Mono'               => 'Cutive Mono',
			'Damion'                    => 'Damion',
			'Dancing Script'            => 'Dancing Script',
			'Dangrek'                   => 'Dangrek',
			'David Libre'               => 'David Libre',
			'Dawning of a New Day'      => 'Dawning of a New Day',
			'Days One'                  => 'Days One',
			'Dekko'                     => 'Dekko',
			'Delius'                    => 'Delius',
			'Delius Swash Caps'         => 'Delius Swash Caps',
			'Delius Unicase'            => 'Delius Unicase',
			'Della Respira'             => 'Della Respira',
			'Denk One'                  => 'Denk One',
			'Devonshire'                => 'Devonshire',
			'Dhurjati'                  => 'Dhurjati',
			'Didact Gothic'             => 'Didact Gothic',
			'Diplomata'                 => 'Diplomata',
			'Diplomata SC'              => 'Diplomata SC',
			'Domine'                    => 'Domine',
			'Donegal One'               => 'Donegal One',
			'Doppio One'                => 'Doppio One',
			'Dorsa'                     => 'Dorsa',
			'Dosis'                     => 'Dosis',
			'Dr Sugiyama'               => 'Dr Sugiyama',
			'Droid Sans'                => 'Droid Sans',
			'Droid Sans Mono'           => 'Droid Sans Mono',
			'Droid Serif'               => 'Droid Serif',
			'Duru Sans'                 => 'Duru Sans',
			'Dynalight'                 => 'Dynalight',
			'EB Garamond'               => 'EB Garamond',
			'Eagle Lake'                => 'Eagle Lake',
			'Eater'                     => 'Eater',
			'Economica'                 => 'Economica',
			'Eczar'                     => 'Eczar',
			'Ek Mukta'                  => 'Ek Mukta',
			'El Messiri'                => 'El Messiri',
			'Electrolize'               => 'Electrolize',
			'Elsie'                     => 'Elsie',
			'Elsie Swash Caps'          => 'Elsie Swash Caps',
			'Emblema One'               => 'Emblema One',
			'Emilys Candy'              => 'Emilys Candy',
			'Engagement'                => 'Engagement',
			'Englebert'                 => 'Englebert',
			'Enriqueta'                 => 'Enriqueta',
			'Erica One'                 => 'Erica One',
			'Esteban'                   => 'Esteban',
			'Euphoria Script'           => 'Euphoria Script',
			'Ewert'                     => 'Ewert',
			'Exo'                       => 'Exo',
			'Exo 2'                     => 'Exo 2',
			'Expletus Sans'             => 'Expletus Sans',
			'Fanwood Text'              => 'Fanwood Text',
			'Farsan'                    => 'Farsan',
			'Fascinate'                 => 'Fascinate',
			'Fascinate Inline'          => 'Fascinate Inline',
			'Faster One'                => 'Faster One',
			'Fasthand'                  => 'Fasthand',
			'Fauna One'                 => 'Fauna One',
			'Federant'                  => 'Federant',
			'Federo'                    => 'Federo',
			'Felipa'                    => 'Felipa',
			'Fenix'                     => 'Fenix',
			'Finger Paint'              => 'Finger Paint',
			'Fira Mono'                 => 'Fira Mono',
			'Fira Sans'                 => 'Fira Sans',
			'Fira Sans Condensed'       => 'Fira Sans Condensed',
			'Fira Sans Extra Condensed' => 'Fira Sans Extra Condensed',
			'Fjalla One'                => 'Fjalla One',
			'Fjord One'                 => 'Fjord One',
			'Flamenco'                  => 'Flamenco',
			'Flavors'                   => 'Flavors',
			'Fondamento'                => 'Fondamento',
			'Fontdiner Swanky'          => 'Fontdiner Swanky',
			'Forum'                     => 'Forum',
			'Francois One'              => 'Francois One',
			'Frank Ruhl Libre'          => 'Frank Ruhl Libre',
			'Freckle Face'              => 'Freckle Face',
			'Fredericka the Great'      => 'Fredericka the Great',
			'Fredoka One'               => 'Fredoka One',
			'Freehand'                  => 'Freehand',
			'Fresca'                    => 'Fresca',
			'Frijole'                   => 'Frijole',
			'Fruktur'                   => 'Fruktur',
			'Fugaz One'                 => 'Fugaz One',
			'GFS Didot'                 => 'GFS Didot',
			'GFS Neohellenic'           => 'GFS Neohellenic',
			'Gabriela'                  => 'Gabriela',
			'Gafata'                    => 'Gafata',
			'Galada'                    => 'Galada',
			'Galdeano'                  => 'Galdeano',
			'Galindo'                   => 'Galindo',
			'Gentium Basic'             => 'Gentium Basic',
			'Gentium Book Basic'        => 'Gentium Book Basic',
			'Geo'                       => 'Geo',
			'Geostar'                   => 'Geostar',
			'Geostar Fill'              => 'Geostar Fill',
			'Germania One'              => 'Germania One',
			'Gidugu'                    => 'Gidugu',
			'Gilda Display'             => 'Gilda Display',
			'Give You Glory'            => 'Give You Glory',
			'Glass Antiqua'             => 'Glass Antiqua',
			'Glegoo'                    => 'Glegoo',
			'Gloria Hallelujah'         => 'Gloria Hallelujah',
			'Goblin One'                => 'Goblin One',
			'Gochi Hand'                => 'Gochi Hand',
			'Gorditas'                  => 'Gorditas',
			'Goudy Bookletter 1911'     => 'Goudy Bookletter 1911',
			'Graduate'                  => 'Graduate',
			'Grand Hotel'               => 'Grand Hotel',
			'Gravitas One'              => 'Gravitas One',
			'Great Vibes'               => 'Great Vibes',
			'Griffy'                    => 'Griffy',
			'Gruppo'                    => 'Gruppo',
			'Gudea'                     => 'Gudea',
			'Gurajada'                  => 'Gurajada',
			'Habibi'                    => 'Habibi',
			'Halant'                    => 'Halant',
			'Hammersmith One'           => 'Hammersmith One',
			'Hanalei'                   => 'Hanalei',
			'Hanalei Fill'              => 'Hanalei Fill',
			'Handlee'                   => 'Handlee',
			'Hanuman'                   => 'Hanuman',
			'Happy Monkey'              => 'Happy Monkey',
			'Harmattan'                 => 'Harmattan',
			'Headland One'              => 'Headland One',
			'Heebo'                     => 'Heebo',
			'Henny Penny'               => 'Henny Penny',
			'Herr Von Muellerhoff'      => 'Herr Von Muellerhoff',
			'Hind'                      => 'Hind',
			'Hind Guntur'               => 'Hind Guntur',
			'Hind Madurai'              => 'Hind Madurai',
			'Hind Siliguri'             => 'Hind Siliguri',
			'Hind Vadodara'             => 'Hind Vadodara',
			'Holtwood One SC'           => 'Holtwood One SC',
			'Homemade Apple'            => 'Homemade Apple',
			'Homenaje'                  => 'Homenaje',
			'IM Fell DW Pica'           => 'IM Fell DW Pica',
			'IM Fell DW Pica SC'        => 'IM Fell DW Pica SC',
			'IM Fell Double Pica'       => 'IM Fell Double Pica',
			'IM Fell Double Pica SC'    => 'IM Fell Double Pica SC',
			'IM Fell English'           => 'IM Fell English',
			'IM Fell English SC'        => 'IM Fell English SC',
			'IM Fell French Canon'      => 'IM Fell French Canon',
			'IM Fell French Canon SC'   => 'IM Fell French Canon SC',
			'IM Fell Great Primer'      => 'IM Fell Great Primer',
			'IM Fell Great Primer SC'   => 'IM Fell Great Primer SC',
			'Iceberg'                   => 'Iceberg',
			'Iceland'                   => 'Iceland',
			'Imprima'                   => 'Imprima',
			'Inconsolata'               => 'Inconsolata',
			'Inder'                     => 'Inder',
			'Indie Flower'              => 'Indie Flower',
			'Inika'                     => 'Inika',
			'Inknut Antiqua'            => 'Inknut Antiqua',
			'Irish Grover'              => 'Irish Grover',
			'Istok Web'                 => 'Istok Web',
			'Italiana'                  => 'Italiana',
			'Italianno'                 => 'Italianno',
			'Itim'                      => 'Itim',
			'Jacques Francois'          => 'Jacques Francois',
			'Jacques Francois Shadow'   => 'Jacques Francois Shadow',
			'Jaldi'                     => 'Jaldi',
			'Jim Nightshade'            => 'Jim Nightshade',
			'Jockey One'                => 'Jockey One',
			'Jolly Lodger'              => 'Jolly Lodger',
			'Jomhuria'                  => 'Jomhuria',
			'Josefin Sans'              => 'Josefin Sans',
			'Josefin Slab'              => 'Josefin Slab',
			'Joti One'                  => 'Joti One',
			'Judson'                    => 'Judson',
			'Julee'                     => 'Julee',
			'Julius Sans One'           => 'Julius Sans One',
			'Junge'                     => 'Junge',
			'Jura'                      => 'Jura',
			'Just Another Hand'         => 'Just Another Hand',
			'Just Me Again Down Here'   => 'Just Me Again Down Here',
			'Kadwa'                     => 'Kadwa',
			'Kalam'                     => 'Kalam',
			'Kameron'                   => 'Kameron',
			'Kanit'                     => 'Kanit',
			'Kantumruy'                 => 'Kantumruy',
			'Karla'                     => 'Karla',
			'Karma'                     => 'Karma',
			'Katibeh'                   => 'Katibeh',
			'Kaushan Script'            => 'Kaushan Script',
			'Kavivanar'                 => 'Kavivanar',
			'Kavoon'                    => 'Kavoon',
			'Kdam Thmor'                => 'Kdam Thmor',
			'Keania One'                => 'Keania One',
			'Kelly Slab'                => 'Kelly Slab',
			'Kenia'                     => 'Kenia',
			'Khand'                     => 'Khand',
			'Khmer'                     => 'Khmer',
			'Khula'                     => 'Khula',
			'Kite One'                  => 'Kite One',
			'Knewave'                   => 'Knewave',
			'Kotta One'                 => 'Kotta One',
			'Koulen'                    => 'Koulen',
			'Kranky'                    => 'Kranky',
			'Kreon'                     => 'Kreon',
			'Kristi'                    => 'Kristi',
			'Krona One'                 => 'Krona One',
			'Kumar One'                 => 'Kumar One',
			'Kumar One Outline'         => 'Kumar One Outline',
			'Kurale'                    => 'Kurale',
			'La Belle Aurore'           => 'La Belle Aurore',
			'Laila'                     => 'Laila',
			'Lakki Reddy'               => 'Lakki Reddy',
			'Lalezar'                   => 'Lalezar',
			'Lancelot'                  => 'Lancelot',
			'Lateef'                    => 'Lateef',
			'Lato'                      => 'Lato',
			'League Script'             => 'League Script',
			'Leckerli One'              => 'Leckerli One',
			'Ledger'                    => 'Ledger',
			'Lekton'                    => 'Lekton',
			'Lemon'                     => 'Lemon',
			'Lemonada'                  => 'Lemonada',
			'Libre Baskerville'         => 'Libre Baskerville',
			'Libre Franklin'            => 'Libre Franklin',
			'Life Savers'               => 'Life Savers',
			'Lilita One'                => 'Lilita One',
			'Lily Script One'           => 'Lily Script One',
			'Limelight'                 => 'Limelight',
			'Linden Hill'               => 'Linden Hill',
			'Lobster'                   => 'Lobster',
			'Lobster Two'               => 'Lobster Two',
			'Londrina Outline'          => 'Londrina Outline',
			'Londrina Shadow'           => 'Londrina Shadow',
			'Londrina Sketch'           => 'Londrina Sketch',
			'Londrina Solid'            => 'Londrina Solid',
			'Lora'                      => 'Lora',
			'Love Ya Like A Sister'     => 'Love Ya Like A Sister',
			'Loved by the King'         => 'Loved by the King',
			'Lovers Quarrel'            => 'Lovers Quarrel',
			'Luckiest Guy'              => 'Luckiest Guy',
			'Lusitana'                  => 'Lusitana',
			'Lustria'                   => 'Lustria',
			'Macondo'                   => 'Macondo',
			'Macondo Swash Caps'        => 'Macondo Swash Caps',
			'Mada'                      => 'Mada',
			'Magra'                     => 'Magra',
			'Maiden Orange'             => 'Maiden Orange',
			'Maitree'                   => 'Maitree',
			'Mako'                      => 'Mako',
			'Mallanna'                  => 'Mallanna',
			'Mandali'                   => 'Mandali',
			'Marcellus'                 => 'Marcellus',
			'Marcellus SC'              => 'Marcellus SC',
			'Marck Script'              => 'Marck Script',
			'Margarine'                 => 'Margarine',
			'Marko One'                 => 'Marko One',
			'Marmelad'                  => 'Marmelad',
			'Martel'                    => 'Martel',
			'Martel Sans'               => 'Martel Sans',
			'Marvel'                    => 'Marvel',
			'Mate'                      => 'Mate',
			'Mate SC'                   => 'Mate SC',
			'Maven Pro'                 => 'Maven Pro',
			'McLaren'                   => 'McLaren',
			'Meddon'                    => 'Meddon',
			'MedievalSharp'             => 'MedievalSharp',
			'Medula One'                => 'Medula One',
			'Meera Inimai'              => 'Meera Inimai',
			'Megrim'                    => 'Megrim',
			'Meie Script'               => 'Meie Script',
			'Merienda'                  => 'Merienda',
			'Merienda One'              => 'Merienda One',
			'Merriweather'              => 'Merriweather',
			'Merriweather Sans'         => 'Merriweather Sans',
			'Metal'                     => 'Metal',
			'Metal Mania'               => 'Metal Mania',
			'Metamorphous'              => 'Metamorphous',
			'Metrophobic'               => 'Metrophobic',
			'Michroma'                  => 'Michroma',
			'Milonga'                   => 'Milonga',
			'Miltonian'                 => 'Miltonian',
			'Miltonian Tattoo'          => 'Miltonian Tattoo',
			'Miniver'                   => 'Miniver',
			'Miriam Libre'              => 'Miriam Libre',
			'Mirza'                     => 'Mirza',
			'Miss Fajardose'            => 'Miss Fajardose',
			'Mitr'                      => 'Mitr',
			'Modak'                     => 'Modak',
			'Modern Antiqua'            => 'Modern Antiqua',
			'Mogra'                     => 'Mogra',
			'Molengo'                   => 'Molengo',
			'Molle'                     => 'Molle',
			'Monda'                     => 'Monda',
			'Monofett'                  => 'Monofett',
			'Monoton'                   => 'Monoton',
			'Monsieur La Doulaise'      => 'Monsieur La Doulaise',
			'Montaga'                   => 'Montaga',
			'Montez'                    => 'Montez',
			'Montserrat'                => 'Montserrat',
			'Montserrat Alternates'     => 'Montserrat Alternates',
			'Montserrat Subrayada'      => 'Montserrat Subrayada',
			'Moul'                      => 'Moul',
			'Moulpali'                  => 'Moulpali',
			'Mountains of Christmas'    => 'Mountains of Christmas',
			'Mouse Memoirs'             => 'Mouse Memoirs',
			'Mr Bedfort'                => 'Mr Bedfort',
			'Mr Dafoe'                  => 'Mr Dafoe',
			'Mr De Haviland'            => 'Mr De Haviland',
			'Mrs Saint Delafield'       => 'Mrs Saint Delafield',
			'Mrs Sheppards'             => 'Mrs Sheppards',
			'Mukta Vaani'               => 'Mukta Vaani',
			'Muli'                      => 'Muli',
			'Mystery Quest'             => 'Mystery Quest',
			'NTR'                       => 'NTR',
			'Neucha'                    => 'Neucha',
			'Neuton'                    => 'Neuton',
			'New Rocker'                => 'New Rocker',
			'News Cycle'                => 'News Cycle',
			'Niconne'                   => 'Niconne',
			'Nixie One'                 => 'Nixie One',
			'Nobile'                    => 'Nobile',
			'Nokora'                    => 'Nokora',
			'Norican'                   => 'Norican',
			'Nosifer'                   => 'Nosifer',
			'Nothing You Could Do'      => 'Nothing You Could Do',
			'Noticia Text'              => 'Noticia Text',
			'Noto Sans'                 => 'Noto Sans',
			'Noto Serif'                => 'Noto Serif',
			'Nova Cut'                  => 'Nova Cut',
			'Nova Flat'                 => 'Nova Flat',
			'Nova Mono'                 => 'Nova Mono',
			'Nova Oval'                 => 'Nova Oval',
			'Nova Round'                => 'Nova Round',
			'Nova Script'               => 'Nova Script',
			'Nova Slim'                 => 'Nova Slim',
			'Nova Square'               => 'Nova Square',
			'Numans'                    => 'Numans',
			'Nunito'                    => 'Nunito',
			'Nunito Sans'               => 'Nunito Sans',
			'Odor Mean Chey'            => 'Odor Mean Chey',
			'Offside'                   => 'Offside',
			'Old Standard TT'           => 'Old Standard TT',
			'Oldenburg'                 => 'Oldenburg',
			'Oleo Script'               => 'Oleo Script',
			'Oleo Script Swash Caps'    => 'Oleo Script Swash Caps',
			'Open Sans'                 => 'Open Sans',
			'Open Sans Condensed'       => 'Open Sans Condensed',
			'Oranienbaum'               => 'Oranienbaum',
			'Orbitron'                  => 'Orbitron',
			'Oregano'                   => 'Oregano',
			'Orienta'                   => 'Orienta',
			'Original Surfer'           => 'Original Surfer',
			'Oswald'                    => 'Oswald',
			'Over the Rainbow'          => 'Over the Rainbow',
			'Overlock'                  => 'Overlock',
			'Overlock SC'               => 'Overlock SC',
			'Overpass'                  => 'Overpass',
			'Overpass Mono'             => 'Overpass Mono',
			'Ovo'                       => 'Ovo',
			'Oxygen'                    => 'Oxygen',
			'Oxygen Mono'               => 'Oxygen Mono',
			'PT Mono'                   => 'PT Mono',
			'PT Sans'                   => 'PT Sans',
			'PT Sans Caption'           => 'PT Sans Caption',
			'PT Sans Narrow'            => 'PT Sans Narrow',
			'PT Serif'                  => 'PT Serif',
			'PT Serif Caption'          => 'PT Serif Caption',
			'Pacifico'                  => 'Pacifico',
			'Padauk'                    => 'Padauk',
			'Palanquin'                 => 'Palanquin',
			'Palanquin Dark'            => 'Palanquin Dark',
			'Pangolin'                  => 'Pangolin',
			'Paprika'                   => 'Paprika',
			'Parisienne'                => 'Parisienne',
			'Passero One'               => 'Passero One',
			'Passion One'               => 'Passion One',
			'Pathway Gothic One'        => 'Pathway Gothic One',
			'Patrick Hand'              => 'Patrick Hand',
			'Patrick Hand SC'           => 'Patrick Hand SC',
			'Pattaya'                   => 'Pattaya',
			'Patua One'                 => 'Patua One',
			'Pavanam'                   => 'Pavanam',
			'Paytone One'               => 'Paytone One',
			'Peddana'                   => 'Peddana',
			'Peralta'                   => 'Peralta',
			'Permanent Marker'          => 'Permanent Marker',
			'Petit Formal Script'       => 'Petit Formal Script',
			'Petrona'                   => 'Petrona',
			'Philosopher'               => 'Philosopher',
			'Piedra'                    => 'Piedra',
			'Pinyon Script'             => 'Pinyon Script',
			'Pirata One'                => 'Pirata One',
			'Plaster'                   => 'Plaster',
			'Play'                      => 'Play',
			'Playball'                  => 'Playball',
			'Playfair Display'          => 'Playfair Display',
			'Playfair Display SC'       => 'Playfair Display SC',
			'Podkova'                   => 'Podkova',
			'Poiret One'                => 'Poiret One',
			'Poller One'                => 'Poller One',
			'Poly'                      => 'Poly',
			'Pompiere'                  => 'Pompiere',
			'Pontano Sans'              => 'Pontano Sans',
			'Poppins'                   => 'Poppins',
			'Port Lligat Sans'          => 'Port Lligat Sans',
			'Port Lligat Slab'          => 'Port Lligat Slab',
			'Pragati Narrow'            => 'Pragati Narrow',
			'Prata'                     => 'Prata',
			'Preahvihear'               => 'Preahvihear',
			'Press Start 2P'            => 'Press Start 2P',
			'Pridi'                     => 'Pridi',
			'Princess Sofia'            => 'Princess Sofia',
			'Prociono'                  => 'Prociono',
			'Prompt'                    => 'Prompt',
			'Prosto One'                => 'Prosto One',
			'Proza Libre'               => 'Proza Libre',
			'Puritan'                   => 'Puritan',
			'Purple Purse'              => 'Purple Purse',
			'Quando'                    => 'Quando',
			'Quantico'                  => 'Quantico',
			'Quattrocento'              => 'Quattrocento',
			'Quattrocento Sans'         => 'Quattrocento Sans',
			'Questrial'                 => 'Questrial',
			'Quicksand'                 => 'Quicksand',
			'Quintessential'            => 'Quintessential',
			'Qwigley'                   => 'Qwigley',
			'Racing Sans One'           => 'Racing Sans One',
			'Radley'                    => 'Radley',
			'Rajdhani'                  => 'Rajdhani',
			'Rakkas'                    => 'Rakkas',
			'Raleway'                   => 'Raleway',
			'Raleway Dots'              => 'Raleway Dots',
			'Ramabhadra'                => 'Ramabhadra',
			'Ramaraja'                  => 'Ramaraja',
			'Rambla'                    => 'Rambla',
			'Rammetto One'              => 'Rammetto One',
			'Ranchers'                  => 'Ranchers',
			'Rancho'                    => 'Rancho',
			'Ranga'                     => 'Ranga',
			'Rasa'                      => 'Rasa',
			'Rationale'                 => 'Rationale',
			'Ravi Prakash'              => 'Ravi Prakash',
			'Redressed'                 => 'Redressed',
			'Reem Kufi'                 => 'Reem Kufi',
			'Reenie Beanie'             => 'Reenie Beanie',
			'Revalia'                   => 'Revalia',
			'Rhodium Libre'             => 'Rhodium Libre',
			'Ribeye'                    => 'Ribeye',
			'Ribeye Marrow'             => 'Ribeye Marrow',
			'Righteous'                 => 'Righteous',
			'Risque'                    => 'Risque',
			'Roboto:400,300,100'        => 'Roboto',
			'Roboto Condensed'          => 'Roboto Condensed',
			'Roboto Mono'               => 'Roboto Mono',
			'Roboto+Slab:700,400'       => 'Roboto Slab',
			'Rochester'                 => 'Rochester',
			'Rock Salt'                 => 'Rock Salt',
			'Rokkitt'                   => 'Rokkitt',
			'Romanesco'                 => 'Romanesco',
			'Ropa Sans'                 => 'Ropa Sans',
			'Rosario'                   => 'Rosario',
			'Rosarivo'                  => 'Rosarivo',
			'Rouge Script'              => 'Rouge Script',
			'Rozha One'                 => 'Rozha One',
			'Rubik'                     => 'Rubik',
			'Rubik Mono One'            => 'Rubik Mono One',
			'Ruda'                      => 'Ruda',
			'Rufina'                    => 'Rufina',
			'Ruge Boogie'               => 'Ruge Boogie',
			'Ruluko'                    => 'Ruluko',
			'Rum Raisin'                => 'Rum Raisin',
			'Ruslan Display'            => 'Ruslan Display',
			'Russo One'                 => 'Russo One',
			'Ruthie'                    => 'Ruthie',
			'Rye'                       => 'Rye',
			'Sacramento'                => 'Sacramento',
			'Sahitya'                   => 'Sahitya',
			'Sail'                      => 'Sail',
			'Salsa'                     => 'Salsa',
			'Sanchez'                   => 'Sanchez',
			'Sancreek'                  => 'Sancreek',
			'Sansita'                   => 'Sansita',
			'Sarala'                    => 'Sarala',
			'Sarina'                    => 'Sarina',
			'Sarpanch'                  => 'Sarpanch',
			'Satisfy'                   => 'Satisfy',
			'Scada'                     => 'Scada',
			'Scheherazade'              => 'Scheherazade',
			'Schoolbell'                => 'Schoolbell',
			'Scope One'                 => 'Scope One',
			'Seaweed Script'            => 'Seaweed Script',
			'Secular One'               => 'Secular One',
			'Sevillana'                 => 'Sevillana',
			'Seymour One'               => 'Seymour One',
			'Shadows Into Light'        => 'Shadows Into Light',
			'Shadows Into Light Two'    => 'Shadows Into Light Two',
			'Shanti'                    => 'Shanti',
			'Share'                     => 'Share',
			'Share Tech'                => 'Share Tech',
			'Share Tech Mono'           => 'Share Tech Mono',
			'Shojumaru'                 => 'Shojumaru',
			'Short Stack'               => 'Short Stack',
			'Shrikhand'                 => 'Shrikhand',
			'Siemreap'                  => 'Siemreap',
			'Sigmar One'                => 'Sigmar One',
			'Signika'                   => 'Signika',
			'Signika Negative'          => 'Signika Negative',
			'Simonetta'                 => 'Simonetta',
			'Sintony'                   => 'Sintony',
			'Sirin Stencil'             => 'Sirin Stencil',
			'Six Caps'                  => 'Six Caps',
			'Skranji'                   => 'Skranji',
			'Slabo 13px'                => 'Slabo 13px',
			'Slabo 27px'                => 'Slabo 27px',
			'Slackey'                   => 'Slackey',
			'Smokum'                    => 'Smokum',
			'Smythe'                    => 'Smythe',
			'Sniglet'                   => 'Sniglet',
			'Snippet'                   => 'Snippet',
			'Snowburst One'             => 'Snowburst One',
			'Sofadi One'                => 'Sofadi One',
			'Sofia'                     => 'Sofia',
			'Sonsie One'                => 'Sonsie One',
			'Sorts Mill Goudy'          => 'Sorts Mill Goudy',
			'Source Code Pro'           => 'Source Code Pro',
			'Source Sans Pro'           => 'Source Sans Pro',
			'Source Serif Pro'          => 'Source Serif Pro',
			'Space Mono'                => 'Space Mono',
			'Special Elite'             => 'Special Elite',
			'Spicy Rice'                => 'Spicy Rice',
			'Spinnaker'                 => 'Spinnaker',
			'Spirax'                    => 'Spirax',
			'Squada One'                => 'Squada One',
			'Sree Krushnadevaraya'      => 'Sree Krushnadevaraya',
			'Sriracha'                  => 'Sriracha',
			'Stalemate'                 => 'Stalemate',
			'Stalinist One'             => 'Stalinist One',
			'Stardos Stencil'           => 'Stardos Stencil',
			'Stint Ultra Condensed'     => 'Stint Ultra Condensed',
			'Stint Ultra Expanded'      => 'Stint Ultra Expanded',
			'Stoke'                     => 'Stoke',
			'Strait'                    => 'Strait',
			'Sue Ellen Francisco'       => 'Sue Ellen Francisco',
			'Suez One'                  => 'Suez One',
			'Sumana'                    => 'Sumana',
			'Sunshiney'                 => 'Sunshiney',
			'Supermercado One'          => 'Supermercado One',
			'Sura'                      => 'Sura',
			'Suranna'                   => 'Suranna',
			'Suravaram'                 => 'Suravaram',
			'Suwannaphum'               => 'Suwannaphum',
			'Swanky and Moo Moo'        => 'Swanky and Moo Moo',
			'Syncopate'                 => 'Syncopate',
			'Tangerine'                 => 'Tangerine',
			'Taprom'                    => 'Taprom',
			'Tauri'                     => 'Tauri',
			'Taviraj'                   => 'Taviraj',
			'Teko'                      => 'Teko',
			'Telex'                     => 'Telex',
			'Tenali Ramakrishna'        => 'Tenali Ramakrishna',
			'Tenor Sans'                => 'Tenor Sans',
			'Text Me One'               => 'Text Me One',
			'The Girl Next Door'        => 'The Girl Next Door',
			'Tienne'                    => 'Tienne',
			'Tillana'                   => 'Tillana',
			'Timmana'                   => 'Timmana',
			'Tinos'                     => 'Tinos',
			'Titan One'                 => 'Titan One',
			'Titillium Web'             => 'Titillium Web',
			'Trade Winds'               => 'Trade Winds',
			'Trirong'                   => 'Trirong',
			'Trocchi'                   => 'Trocchi',
			'Trochut'                   => 'Trochut',
			'Trykker'                   => 'Trykker',
			'Tulpen One'                => 'Tulpen One',
			'Ubuntu'                    => 'Ubuntu',
			'Ubuntu Condensed'          => 'Ubuntu Condensed',
			'Ubuntu Mono'               => 'Ubuntu Mono',
			'Ultra'                     => 'Ultra',
			'Uncial Antiqua'            => 'Uncial Antiqua',
			'Underdog'                  => 'Underdog',
			'Unica One'                 => 'Unica One',
			'UnifrakturCook'            => 'UnifrakturCook',
			'UnifrakturMaguntia'        => 'UnifrakturMaguntia',
			'Unkempt'                   => 'Unkempt',
			'Unlock'                    => 'Unlock',
			'Unna'                      => 'Unna',
			'VT323'                     => 'VT323',
			'Vampiro One'               => 'Vampiro One',
			'Varela'                    => 'Varela',
			'Varela Round'              => 'Varela Round',
			'Vast Shadow'               => 'Vast Shadow',
			'Vesper Libre'              => 'Vesper Libre',
			'Vibur'                     => 'Vibur',
			'Vidaloka'                  => 'Vidaloka',
			'Viga'                      => 'Viga',
			'Voces'                     => 'Voces',
			'Volkhov'                   => 'Volkhov',
			'Vollkorn'                  => 'Vollkorn',
			'Voltaire'                  => 'Voltaire',
			'Waiting for the Sunrise'   => 'Waiting for the Sunrise',
			'Wallpoet'                  => 'Wallpoet',
			'Walter Turncoat'           => 'Walter Turncoat',
			'Warnes'                    => 'Warnes',
			'Wellfleet'                 => 'Wellfleet',
			'Wendy One'                 => 'Wendy One',
			'Wire One'                  => 'Wire One',
			'Work Sans'                 => 'Work Sans',
			'Yanone Kaffeesatz'         => 'Yanone Kaffeesatz',
			'Yantramanav'               => 'Yantramanav',
			'Yatra One'                 => 'Yatra One',
			'Yellowtail'                => 'Yellowtail',
			'Yeseva One'                => 'Yeseva One',
			'Yesteryear'                => 'Yesteryear',
			'Yrsa'                      => 'Yrsa',
			'Zeyada'                    => 'Zeyada',
		);

		return $accelerate_google_font;
	}

endif;
