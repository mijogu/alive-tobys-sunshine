<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ThemeGrill
 * @subpackage Accelerate Pro
 * @since Accelerate Pro 1.0
 */
get_header(); ?>

<?php do_action( 'accelerate_before_body_content' ); ?>
<?php $blog_display = accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ); ?>

<div id="primary">
	<div id="content" class="clearfix">
		<?php if ( have_posts() ) : ?>
			<?php
			if ( ( accelerate_options( 'accelerate_page_header_setting', '1' ) == '1' ) && ( accelerate_options( 'accelerate_page_header_style', 'default' ) ) == 'default' ) {
				?>
				<header class="page-header">
					<h1 class="page-title">
						<?php _e( 'Search Results', 'accelerate' ); ?>
					</h1>
				</header><!-- .page-header -->
			<?php } ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php $format = accelerate_archive_display_type_select(); ?>

				<?php get_template_part( 'content', $format ); ?>

			<?php endwhile; ?>

			<?php if ( ( $blog_display == 'large_image' ) || ( $blog_display == 'small_image' ) || ( $blog_display == 'blog_medium_alternate' ) || ( $blog_display == 'small_image_alternate' ) ) { ?>
				<?php get_template_part( 'navigation', 'search' ); ?>
			<?php } ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

	</div><!-- #content -->

	<?php if ( ( $blog_display == 'grid_image' ) || ( $blog_display == 'masonry_image' ) ) { ?>
		<?php get_template_part( 'navigation', 'search' ); ?>
	<?php } ?>

</div><!-- #primary -->

<?php accelerate_sidebar_select(); ?>

<?php do_action( 'accelerate_after_body_content' ); ?>

<?php get_footer(); ?>
