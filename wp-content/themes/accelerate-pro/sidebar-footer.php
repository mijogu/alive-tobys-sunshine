<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package    ThemeGrill
 * @subpackage Accelerate Pro
 * @since      Accelerate Pro 1.0
 */

/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( ! is_active_sidebar( 'accelerate_footer_sidebar_one' ) &&
     ! is_active_sidebar( 'accelerate_footer_sidebar_two' ) &&
     ! is_active_sidebar( 'accelerate_footer_sidebar_three' ) &&
     ! is_active_sidebar( 'accelerate_footer_sidebar_four' ) ) {
	return;
}

$footer_columns = accelerate_options( 'accelerate_footer_widget_column_select_type', 'three' );

$footer_column_class = '';
if ( $footer_columns == 'two-style-1' || $footer_columns == 'two-style-2' || $footer_columns == 'three-style-1' || $footer_columns == 'three-style-2' || $footer_columns == 'three-style-3' || $footer_columns == 'four-style-1' || $footer_columns == 'four-style-2' ) {
	$footer_column_class = 'footer-sidebar-dynamic-width';
}

$accelerate_footer_sidebars = array(
	'one'           => array(
		'footer_column_one'   => 'tg-column-full',
		'footer_column_two'   => '',
		'footer_column_three' => '',
		'footer_column_four'  => '',
	),
	'two'           => array(
		'footer_column_one'   => 'tg-one-half',
		'footer_column_two'   => 'tg-one-half tg-one-half-last',
		'footer_column_three' => '',
		'footer_column_four'  => '',
	),
	'three'         => array(
		'footer_column_one'   => 'tg-one-third',
		'footer_column_two'   => 'tg-one-third tg-column-2',
		'footer_column_three' => 'tg-one-third tg-after-two-blocks-clearfix',
		'footer_column_four'  => '',
	),
	'four'          => array(
		'footer_column_one'   => 'tg-one-fourth tg-column-1',
		'footer_column_two'   => 'tg-one-fourth tg-column-2',
		'footer_column_three' => 'tg-one-fourth tg-after-two-blocks-clearfix tg-column-3',
		'footer_column_four'  => 'tg-one-fourth tg-one-fourth-last tg-column-4',
	),
	'two-style-1'   => array(
		'footer_column_one'   => 'tg-one-half-large',
		'footer_column_two'   => 'tg-one-half-small',
		'footer_column_three' => '',
		'footer_column_four'  => '',
	),
	'two-style-2'   => array(
		'footer_column_one'   => 'tg-one-half-small',
		'footer_column_two'   => 'tg-one-half-large',
		'footer_column_three' => '',
		'footer_column_four'  => '',
	),
	'three-style-1' => array(
		'footer_column_one'   => 'tg-one-third-small',
		'footer_column_two'   => 'tg-one-third-large',
		'footer_column_three' => 'tg-one-third-small',
		'footer_column_four'  => '',
	),
	'three-style-2' => array(
		'footer_column_one'   => 'tg-one-third-large',
		'footer_column_two'   => 'tg-one-third-small',
		'footer_column_three' => 'tg-one-third-small',
		'footer_column_four'  => '',
	),
	'three-style-3' => array(
		'footer_column_one'   => 'tg-one-third-small',
		'footer_column_two'   => 'tg-one-third-small',
		'footer_column_three' => 'tg-one-third-large',
		'footer_column_four'  => '',
	),
	'four-style-1'  => array(
		'footer_column_one'   => 'tg-one-fourth-large',
		'footer_column_two'   => 'tg-one-fourth-small',
		'footer_column_three' => 'tg-one-fourth-small',
		'footer_column_four'  => 'tg-one-fourth-small',
	),
	'four-style-2'  => array(
		'footer_column_one'   => 'tg-one-fourth-small',
		'footer_column_two'   => 'tg-one-fourth-small',
		'footer_column_three' => 'tg-one-fourth-small',
		'footer_column_four'  => 'tg-one-fourth-large',
	),
);
?>

<div class="footer-widgets-wrapper">
	<div class="inner-wrap">
		<div class="footer-widgets-area <?php echo esc_attr( $footer_column_class ); ?> clearfix">
			<?php foreach ( $accelerate_footer_sidebars as $key => $accelerate_footer_sidebar ) { ?>
				<?php if ( $footer_columns == $key ) : ?>

					<div class="<?php echo esc_attr( $accelerate_footer_sidebar['footer_column_one'] ); ?>">
						<?php
						if ( is_active_sidebar( 'accelerate_footer_sidebar_one' ) ) :
							dynamic_sidebar( 'accelerate_footer_sidebar_one' );
						endif;
						?>
					</div>

					<?php if ( $accelerate_footer_sidebar['footer_column_two'] ) { ?>
						<div class="<?php echo esc_attr( $accelerate_footer_sidebar['footer_column_two'] ); ?>">
							<?php
							if ( is_active_sidebar( 'accelerate_footer_sidebar_two' ) ) :
								dynamic_sidebar( 'accelerate_footer_sidebar_two' );
							endif;
							?>
						</div>
					<?php } ?>

					<?php if ( $accelerate_footer_sidebar['footer_column_three'] ) { ?>
						<div class="<?php echo esc_attr( $accelerate_footer_sidebar['footer_column_three'] ); ?>">
							<?php
							if ( is_active_sidebar( 'accelerate_footer_sidebar_three' ) ) :
								dynamic_sidebar( 'accelerate_footer_sidebar_three' );
							endif;
							?>
						</div>
					<?php } ?>

					<?php if ( $accelerate_footer_sidebar['footer_column_four'] ) { ?>
						<div class="<?php echo esc_attr( $accelerate_footer_sidebar['footer_column_four'] ); ?>">
							<?php
							if ( is_active_sidebar( 'accelerate_footer_sidebar_four' ) ) :
								dynamic_sidebar( 'accelerate_footer_sidebar_four' );
							endif;
							?>
						</div>
					<?php } ?>

				<?php endif; ?>
			<?php } ?>
		</div>
	</div>
</div>
