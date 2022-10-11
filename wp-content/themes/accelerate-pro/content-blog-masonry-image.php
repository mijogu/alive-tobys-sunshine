<?php
/**
 * The template used for displaying blog image masonry post.
 *
 * @package    ThemeGrill
 * @subpackage Accelerate Pro
 * @since      Accelerate Pro 2.2.6
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'accelerate_before_post_content' ); ?>

		<div class="masonry-container">
			<header class="entry-header">
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h2>
			</header>

			<div class="entry-meta">
			<span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>

			<?php
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
			}
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);
			printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'accelerate' ),
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				$time_string
			); ?>
		</div>

			<?php
			if ( has_post_thumbnail() ) {
				$image = '';
				$title_attribute = get_the_title( $post->ID );
				$image_id = get_post_thumbnail_id( get_the_ID() );
				$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				$image_alt_text = ! empty( $image_alt ) ? $image_alt : $title_attribute;
				$image .= '<figure class="post-featured-image">';
				$image .= '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">';
				$image .= get_the_post_thumbnail( $post->ID, 'featured-blog-large', array(
						'title' => esc_attr( $title_attribute ),
						'alt'   => esc_attr( $image_alt ),
					) ) . '</a>';
				$image .= '</figure>';
				echo $image;
			}
			?>

			<div class="entry-content clearfix">
				<?php
				global $more;
				$more = 0;
				if ( accelerate_options( 'accelerate_toggle_excerpt_full_post', 'full_post' ) == 'excerpt' ) {
					the_excerpt();
					echo '<a class="more-link" href="' . get_permalink() . '"><span>' . accelerate_options( 'accelerate_read_more_text', __( 'Read more', 'accelerate' ) ) . '</span></a>';
				} else {
					the_content( '<span>' . accelerate_options( 'accelerate_read_more_text', __( 'Read more', 'accelerate' ) ) . '</span>' );
				}
				?>
			</div>
		</div>

	<?php do_action( 'accelerate_after_post_content' ); ?>
</article>
