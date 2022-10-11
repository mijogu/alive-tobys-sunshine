<?php
/**
 * Template Name: Business Template Three
 *
 * Displays the Business Template of the theme.
 *
 * @package ThemeGrill
 * @subpackage Accelerate
 * @since Accelerate 1.0
 */
?>

<?php get_header(); ?>

<div id="content" class="clearfix">

	<?php 
		if( is_active_sidebar( 'accelerate_business_sidebar_3' ) ) {
			if ( !dynamic_sidebar( 'accelerate_business_sidebar_3' ) ):
			endif;
		}
	?>

</div>

<?php get_footer(); ?>