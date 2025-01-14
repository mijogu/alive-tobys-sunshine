<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Accelerate Pro
 * @since Accelerate Pro 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'accelerate_before_post_content' ); ?>

	<?php if( get_post_format() ) { get_template_part( 'inc/post-formats' ); } ?>

	<?php if( ( accelerate_options('accelerate_page_header_setting', '1') == '1') &&  (accelerate_options('accelerate_page_header_style', 'default') == 'default') ) { ?>
		<header class="entry-header">
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
		</header>
	<?php } ?>

	<?php accelerate_entry_meta(); ?>

	<div class="entry-content clearfix">
		<?php
		accelerate_display_thumbnail( $post );

		the_content();

		wp_link_pages(
			array(
				'before'      => '<div style="clear: both;"></div><div class="pagination clearfix">' . __( 'Pages:', 'accelerate' ),
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			)
		);
		?>
	</div>

	<?php do_action( 'accelerate_after_post_content' ); ?>
</article>
