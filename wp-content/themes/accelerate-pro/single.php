<?php
/**
 * Theme Single Post Section for our theme.
 *
 * @package    ThemeGrill
 * @subpackage Accelerate Pro
 * @since      Accelerate Pro 1.0
 */
get_header(); ?>

<?php do_action( 'accelerate_before_body_content' ); ?>

<div id="primary">
	<div id="content" class="clearfix">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php get_template_part( 'navigation', 'single' ); ?>

			<?php if ( ( accelerate_options( 'accelerate_author_bio_setting', 0 ) == 1 ) && ( get_the_author_meta( 'description' ) ) ) { ?>
				<div class="author-box clearfix">
					<div class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?></div>
					<div class="author-description-wrapper">
						<h4 class="author-name"><?php the_author_meta( 'display_name' ); ?></h4>

						<p class="author-description"><?php the_author_meta( 'description' ); ?></p>

						<?php if ( accelerate_options( 'accelerate_author_bio_social_sites_show', 0 ) == 1 ) {
							accelerate_author_social_link();
						}
						?>
						<?php if ( accelerate_options( 'accelerate_author_bio_link_show', 0 ) == 1 ) { ?>
							<p class="author-url"><?php printf( __( '%1$s has %2$s posts and counting.', 'accelerate' ), get_the_author_meta( 'display_name' ), absint( count_user_posts( get_the_author_meta( 'ID' ) ) ) ); ?>
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php printf( __( 'See all posts by %1$s', 'accelerate' ), get_the_author_meta( 'display_name' ) ); ?></a>
							</p>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( accelerate_options( 'accelerate_related_posts_activate', 0 ) == 1 ) {
				get_template_part( 'inc/related-posts' );
			} ?>

			<?php
			do_action( 'accelerate_before_comments_template' );
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) {
				comments_template();
			}
			do_action( 'accelerate_after_comments_template' );
			?>

		<?php endwhile; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php accelerate_sidebar_select(); ?>

<?php do_action( 'accelerate_after_body_content' ); ?>

<?php get_footer(); ?>
