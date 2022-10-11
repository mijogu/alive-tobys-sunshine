<?php
/**
 * Theme Header Section for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main" class="clearfix"> <div class="inner-wrap">
 *
 * @package    ThemeGrill
 * @subpackage Accelerate Pro
 * @since      Accelerate Pro 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11"/>
	<?php
	/**
	 * This hook is important for wordpress plugins and other many things
	 */
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>

<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<?php
$background_image_url_link = accelerate_options( 'accelerate_background_image_link' );
if ( $background_image_url_link ) {
	echo '<a href="' . esc_url( $background_image_url_link ) . '" class="background-image-clickable" target="_blank"></a>';
}
?>

<?php do_action( 'before' ); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'accelerate' ); ?></a>
	<?php do_action( 'accelerate_before_header' ); ?>
	<header id="masthead" class="site-header clearfix">

		<?php if ( accelerate_options( 'accelerate_activate_top_header_bar', 0 ) == 1 ) { ?>
			<div id="header-meta" class="clearfix">
				<div class="inner-wrap">
					<?php
					if ( accelerate_options( 'accelerate_activate_social_links', 0 ) == 1 ) {
						accelerate_social_links();
					}
					?>
					<nav id="top-site-navigation" class="small-menu" class="clearfix">
						<h3 class="top-menu-toggle"></h3>
						<div class="nav-menu clearfix">
							<?php
							if ( has_nav_menu( 'header' ) ) {
								wp_nav_menu( array( 'theme_location' => 'header' ) );
							}
							?>
						</div><!-- .nav-menu -->
					</nav>
				</div>
			</div>
		<?php } ?>

		<div id="header-text-nav-container" class="clearfix">

			<?php if ( accelerate_options( 'accelerate_header_image_position', 'position_two' ) == 'position_one' ) {
				accelerate_render_header_image();
			} ?>

			<div class="inner-wrap">

				<div id="header-text-nav-wrap" class="clearfix">
					<div id="header-left-section">
						<?php
						if ( ( accelerate_options( 'accelerate_show_header_logo_text', 'text_only' ) == 'both' || accelerate_options( 'accelerate_show_header_logo_text', 'text_only' ) == 'logo_only' ) ) {
							?>
							<div id="header-logo-image">
								<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo( $blog_id = 0 ) ) {
									accelerate_the_custom_logo();
								} ?>
							</div><!-- #header-logo-image -->
							<?php
						}
						$screen_reader = '';
						if ( ( accelerate_options( 'accelerate_show_header_logo_text', 'text_only' ) == 'logo_only' || accelerate_options( 'accelerate_show_header_logo_text', 'text_only' ) == 'none' ) ) {
							$screen_reader = 'screen-reader-text';
						}
						?>
						<div id="header-text" class="<?php echo $screen_reader; ?>">
							<?php
							if ( is_front_page() || is_home() ) : ?>
								<h1 id="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</h1>
							<?php else : ?>
								<h3 id="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</h3>
							<?php endif;
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p id="site-description"><?php echo $description; ?></p>
							<?php endif;
							?>
						</div><!-- #header-text -->
					</div><!-- #header-left-section -->
					<div id="header-right-section">
						<?php
						if ( is_active_sidebar( 'accelerate_header_sidebar' ) ) {
							?>
							<div id="header-right-sidebar" class="clearfix">
								<?php
								// Calling the header sidebar if it exists.
								if ( ! dynamic_sidebar( 'accelerate_header_sidebar' ) ):
								endif;
								?>
							</div>
							<?php
						}
						?>
					</div><!-- #header-right-section -->

				</div><!-- #header-text-nav-wrap -->

			</div><!-- .inner-wrap -->

			<?php if ( accelerate_options( 'accelerate_header_image_position', 'position_two' ) == 'position_two' ) {
				accelerate_render_header_image();
			} ?>

			<?php if ( function_exists( 'max_mega_menu_is_enabled' ) && max_mega_menu_is_enabled( 'primary' ) ) : ?>
				<div class="mega-menu-integrate">
					<div class="inner-wrap clearfix">
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</div>
				</div>
			<?php else: ?>
				<?php
				if ( accelerate_options( 'accelerate_menu_background_cover_full_width_option', 0 ) == 1 ) {
					$nav_classes = 'main-navigation clearfix';
				} else {
					$nav_classes = 'main-navigation inner-wrap clearfix';
				}
				?>

				<nav id="site-navigation" class="<?php echo $nav_classes; ?>" role="navigation">
					<h3 class="menu-toggle"><?php _e( 'Menu', 'accelerate' ); ?></h3>
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'theme_location'  => 'primary',
							'container_class' => 'menu-primary-container inner-wrap',
						) );
					} else {
						wp_page_menu( array( 'menu_class' => 'menu inner-wrap' ) );
					}
					?>
				</nav>
			<?php endif; ?>
		</div><!-- #header-text-nav-container -->

		<?php if ( accelerate_options( 'accelerate_header_image_position', 'position_two' ) == 'position_three' ) {
			accelerate_render_header_image();
		} ?>

		<?php
		if ( accelerate_options( 'accelerate_activate_slider', '0' ) == '1' ) {
			if ( ( accelerate_options( 'accelerate_slider_status', 'front_page' ) == 'all_page' ) || ( is_front_page() && accelerate_options( 'accelerate_slider_status', 'front_page' ) == 'front_page' ) ) {
				accelerate_pass_slider_parameters();
				accelerate_featured_image_slider();
			}
		}
		?>

	</header>
	<?php do_action( 'accelerate_after_header' ); ?>
	<?php do_action( 'accelerate_before_main' ); ?>

	<?php if ( accelerate_options( 'accelerate_page_header_style', 'default' ) == 'style-one' ) : ?>
		<?php
		$header_style_class = '';
		if ( accelerate_options( 'accelerate_page_header_position', 'left' ) == 'left' ) {
			$header_style_class = ' header-title-left';
		} elseif ( accelerate_options( 'accelerate_page_header_position', 'right' ) == 'right' ) {
			$header_style_class = ' header-title-right';
		} elseif ( accelerate_options( 'accelerate_page_header_position', 'center' ) == 'center' ) {
			$header_style_class = ' header-title-center';
		}
		?>

		<?php if ( ! is_front_page() ) { ?>
			<div class="page-header clearfix">
				<div class="inner-wrap">
					<div class="header-title-style-two <?php echo esc_attr( $header_style_class ); ?>">
						<h1 class="header-title"><?php echo accelerate_header_title(); ?></h1>
						<?php accelerate_breadcrumb(); ?>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php endif; ?>

	<div id="main" class="clearfix">
		<div class="inner-wrap clearfix">
