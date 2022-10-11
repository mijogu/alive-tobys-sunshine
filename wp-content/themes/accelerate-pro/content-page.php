<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package    ThemeGrill
 * @subpackage Accelerate Pro
 * @since      Accelerate Pro 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'accelerate_before_post_content' ); ?>

	<?php accelerate_display_thumbnail( $post ); ?>

	<?php if( ( accelerate_options('accelerate_page_header_setting', '1') == '1') &&  (accelerate_options('accelerate_page_header_style', 'default') == 'default') ) { ?>
		<header class="entry-header">
			<?php if ( is_front_page() ):
				the_title( '<h2 class="entry-title">', '</h2>' );
			else:
				the_title( '<h1 class="entry-title">', '</h1>' );
			endif; ?>
		</header>
	<?php } ?>

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before'      => '<div style="clear: both;"></div><div class="pagination clearfix">' . __( 'Pages:', 'accelerate' ),
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
		?>
	</div>

	<?php do_action( 'accelerate_after_post_content' ); ?>
</article>
