<?php
/**
 * The WooCommerce right sidebar widget area.
 *
 * @package ThemeGrill
 * @subpackage Accelerate
 * @since Accelerate 2.2.1
 */
?>

<div id="secondary">
	<?php do_action( 'accelerate_before_sidebar' ); ?>

		<?php if ( ! dynamic_sidebar( 'accelerate_woocommerce_right_sidebar' ) ) :
			the_widget( 'WP_Widget_Text',
				array(
					'title'  => __( 'Example Widget', 'accelerate' ),
					'text'   => sprintf( __( 'This is an example widget to show how the WooCommerce Right Sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'accelerate' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
					'filter' => true,
				),
				array(
					'before_widget' => '<aside class="widget widget_text clearfix">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title"><span>',
					'after_title'   => '</span></h3>'
				)
			);
		endif; ?>

	<?php do_action( 'accelerate_after_sidebar' ); ?>
</div>
