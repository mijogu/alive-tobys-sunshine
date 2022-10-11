<?php
/**
 * The template for displaying Archive page.
 *
 * @package ThemeGrill
 * @subpackage Accelerate Pro
 * @since Accelerate Pro 1.0
 */
get_header(); ?>
<?php do_action( 'accelerate_before_body_content' ); ?>
<?php $blog_display = accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ); ?>

<div id="primary">

	<?php if ( have_posts() ) : ?>

<?php if ( ( accelerate_options( 'accelerate_page_header_setting', '1' ) == '1' ) && ( accelerate_options( 'accelerate_page_header_style', 'default' ) == 'default' ) ) { ?>
	<header class="page-header">
		<h1 class="page-title">
			<?php
			if ( is_category() ) :
				single_cat_title();

			elseif ( is_tag() ) :
				single_tag_title();

			elseif ( is_author() ) :
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				*/
				the_post();
				printf( __( 'Author: %s', 'accelerate' ), '<span class="vcard">' . get_the_author() . '</span>' );
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			elseif ( is_day() ) :
				printf( __( 'Day: %s', 'accelerate' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				printf( __( 'Month: %s', 'accelerate' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				printf( __( 'Year: %s', 'accelerate' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
				_e( 'Asides', 'accelerate' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
				_e( 'Images', 'accelerate' );

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
				_e( 'Videos', 'accelerate' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
				_e( 'Quotes', 'accelerate' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
				_e( 'Links', 'accelerate' );

			else :
				_e( 'Archives', 'accelerate' );

			endif;
			?>
		</h1>
		<?php
		// Show an optional term description.
		$term_description = term_description();
		if ( ! empty( $term_description ) ) :
			printf( '<div class="taxonomy-description">%s</div>', $term_description );
		endif;
		?>
	</header><!-- .page-header -->
<?php } ?>
	<div id="content" class="clearfix">
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php $format = accelerate_archive_display_type_select(); ?>

			<?php get_template_part( 'content', $format ); ?>

		<?php endwhile; ?>

		<?php if ( ( $blog_display == 'large_image' ) || ( $blog_display == 'small_image' ) || ( $blog_display == 'blog_medium_alternate' ) || ( $blog_display == 'small_image_alternate' ) ) { ?>
			<?php get_template_part( 'navigation', 'archive' ); ?>
		<?php } ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

	</div><!-- #content -->

	<?php if ( ( $blog_display == 'grid_image' ) || ( $blog_display == 'masonry_image' ) ) { ?>
		<?php get_template_part( 'navigation', 'archive' ); ?>
	<?php } ?>

</div><!-- #primary -->

<?php accelerate_sidebar_select(); ?>

<?php do_action( 'accelerate_after_body_content' ); ?>

<?php get_footer(); ?>
