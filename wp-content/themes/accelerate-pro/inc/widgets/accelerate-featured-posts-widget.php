<?php
/**
 * Featured Posts widget
 */

class accelerate_featured_posts_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_featured_posts',
			'description'                 => __( 'Display latest posts or posts of specific category', 'accelerate' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Featured Posts', 'accelerate' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults['title']       = '';
		$tg_defaults['text']        = '';
		$tg_defaults['number']      = 4;
		$tg_defaults['image_size']  = 'featured-blog-small';
		$tg_defaults['type']        = 'latest';
		$tg_defaults['category']    = '';
		$tg_defaults['button_text'] = '';
		$tg_defaults['button_url']  = '';
		$tg_defaults['tag']         = '';
		$tg_defaults['author']      = '';
		$tg_defaults['column']      = '2';
		$tg_defaults['post_style']  = 'default';
		$instance                   = wp_parse_args( (array) $instance, $tg_defaults );
		$title                      = esc_attr( $instance['title'] );
		$text                       = esc_textarea( $instance['text'] );
		$number                     = $instance['number'];
		$type                       = $instance['type'];
		$category                   = $instance['category'];
		$image_size                 = $instance['image_size'];
		$button_text                = esc_attr( $instance['button_text'] );
		$button_url                 = esc_url( $instance['button_url'] );
		$tag                        = $instance['tag'];
		$author                     = $instance['author'];
		$column                     = $instance['column'];
		$post_style                 = $instance['post_style'];
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>
		<?php _e( 'Description', 'accelerate' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>"
			       name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>"
			       size="3"/>
		</p>

		<p>
			<input type="radio" <?php checked( $image_size, 'featured' ) ?>
			       id="<?php echo $this->get_field_id( 'image_size' ); ?>"
			       name="<?php echo $this->get_field_name( 'image_size' ); ?>"
			       value="featured"/><?php _e( 'Large Featured Image', 'accelerate' ); ?>
			<br/>
			<input type="radio" <?php checked( $image_size, 'featured-blog-small' ) ?>
			       id="<?php echo $this->get_field_id( 'image_size' ); ?>"
			       name="<?php echo $this->get_field_name( 'image_size' ); ?>"
			       value="featured-blog-small"/><?php _e( 'Small Featured Image', 'accelerate' ); ?>
			<br/></p>

		<p>
			<input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
			       name="<?php echo $this->get_field_name( 'type' ); ?>"
			       value="latest"/><?php _e( 'Show latest Posts', 'accelerate' ); ?>
			<br/>
			<input type="radio" <?php checked( $type, 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
			       name="<?php echo $this->get_field_name( 'type' ); ?>"
			       value="category"/><?php _e( 'Show posts from a category', 'accelerate' ); ?>
			<br/>
			<input type="radio" <?php checked( $type, 'tag' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
			       name="<?php echo $this->get_field_name( 'type' ); ?>"
			       value="tag"/><?php _e( 'Show posts from a tag', 'accelerate' ); ?>
			<br/>
			<input type="radio" <?php checked( $type, 'author' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
			       name="<?php echo $this->get_field_name( 'type' ); ?>"
			       value="author"/><?php _e( 'Show posts from an author', 'accelerate' ); ?>
			<br/>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'accelerate' ); ?>
				:</label>
			<?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'category' ),
				'selected'         => $category,
			) ); ?>
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'tag' ) ); ?>"><?php esc_html_e( 'Select tag', 'accelerate' ); ?></label>
			<?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'tag' ),
				'selected'         => $tag,
				'taxonomy'         => 'post_tag',
			) ); ?>
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>"><?php esc_html_e( 'Select author', 'accelerate' ); ?></label>
			<?php
			wp_dropdown_users( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'author' ),
				'selected'         => $author,
				'orderby'          => 'name',
				'order'            => 'ASC',
				'who'              => 'authors'
			) );
			?>
		</p>

		<?php esc_html_e( 'Column Option', 'accelerate' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'column' ); ?>"
			        name="<?php echo $this->get_field_name( 'column' ); ?>">
				<option value="1" <?php if ( $column == '1' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'One Column', 'accelerate' ); ?></option>
				<option value="2" <?php if ( $column == '2' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Two Column', 'accelerate' ); ?></option>
			</select>
		</p>

		<?php esc_html_e( 'Style Option', 'accelerate' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'post_style' ); ?>"
			        name="<?php echo $this->get_field_name( 'post_style' ); ?>">
				<option value="default" <?php if ( $post_style == 'default' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Default', 'accelerate' ); ?></option>
				<option value="style-1" <?php if ( $post_style == 'style-1' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Style One', 'accelerate' ); ?></option>
				<option value="style-2" <?php if ( $post_style == 'style-2' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Style Two', 'accelerate' ); ?></option>
			</select>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_text' ); ?>"
			       name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text"
			       value="<?php echo $button_text; ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Redirect Link:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_url' ); ?>"
			       name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text"
			       value="<?php echo $button_url; ?>"/>
		</p>
		<p><?php _e( 'Note: Use this button to redirect to specific category or any link as you like.', 'accelerate' ); ?></p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		}
		$instance['number']      = absint( $new_instance['number'] );
		$instance['image_size']  = $new_instance['image_size'];
		$instance['type']        = $new_instance['type'];
		$instance['category']    = $new_instance['category'];
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
		$instance['button_url']  = esc_url_raw( $new_instance['button_url'] );
		$instance['tag']         = $new_instance['tag'];
		$instance['author']      = $new_instance['author'];
		$instance['column']      = $new_instance['column'];
		$instance['post_style']  = $new_instance['post_style'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title       = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text        = isset( $instance['text'] ) ? $instance['text'] : '';
		$number      = empty( $instance['number'] ) ? 4 : $instance['number'];
		$image_size  = isset( $instance['image_size'] ) ? $instance['image_size'] : 'featured-blog-small';
		$type        = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category    = isset( $instance['category'] ) ? $instance['category'] : '';
		$button_text = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
		$button_url  = isset( $instance['button_url'] ) ? $instance['button_url'] : '#';
		$tag         = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author      = isset( $instance['author'] ) ? $instance['author'] : '';
		$column      = isset( $instance['column'] ) ? $instance['column'] : '2';
		$post_style  = isset( $instance['post_style'] ) ? $instance['post_style'] : 'default';

		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'Accelerate Pro', 'TG: Featured posts widget description text' . $this->id, $text );
			icl_register_string( 'Accelerate Pro', 'TG: Featured posts widget Button text' . $this->id, $button_text );
			icl_register_string( 'Accelerate Pro', 'TG: Featured posts widget Button redirect link' . $this->id, $button_url );
		}

		$args = array(
			'posts_per_page'      => $number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
		);

		// Displays from category chosen.
		if ( $type == 'category' ) {
			$args['category__in'] = $category;
		}

		// Displays from tag chosen.
		if ( $type == 'tag' ) {
			$args['tag__in'] = $tag;
		}

		// Displays from author choosen.
		if ( $type == 'author' ) {
			$args['author__in'] = $author;
		}

		// Loop only if featured image is available.
		if ( $post_style == 'style-2' || $post_style == 'style-1' ) {
			$args['meta_query'] = array(
				array(
					'key'     => '_thumbnail_id',
					'compare' => 'EXISTS'
				),
			);
		}

		echo $before_widget;
		?>
		<?php
		$small_featured_post = '';
		if ( $image_size == 'featured-blog-small' ) {
			$featured            = 'featured-blog-small';
			$image_class         = 'post-featured-image';
			$small_featured_post = 'small-featured-image';
		} else {
			$featured    = 'featured-blog-large';
			$image_class = 'post-featured-image-large';
		}

		if ( $post_style == 'style-2' ) {
			$featured = 'featured-service';
		}

		if ( ! empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		} ?>
		<p><?php
			// For WPML plugin compatibility
			if ( function_exists( 'icl_t' ) ) {
				$text = icl_t( 'Accelerate Pro', 'TG: Featured posts widget description text' . $this->id, $text );
			}
			echo esc_textarea( $text ); ?></p>
		<?php
		$i                  = 1;
		$get_featured_posts = new WP_Query( $args );
		while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
			$post_style_class = '';
			if ( $post_style == 'style-1' ) {
				$post_style_class = 'post-style-one';
			} elseif ( $post_style == 'style-2' ) {
				$post_style_class = 'post-style-two';
			}
			if ( $column == '2' ) {
				if ( $i % 2 == 0 ) {
					$class = 'tg-one-half tg-one-half-last';
				} else {
					$class = 'tg-one-half';
				}
				if ( $i % 2 == 1 && $i > 1 ) {
					$class .= ' tg-featured-posts-clearfix';
				}
			} elseif ( $column == '1' ) {
				$class = 'tg-column-full';
			}
			?>
			<div
				class="<?php echo $class; ?> <?php echo esc_attr( $post_style_class ); ?> <?php echo esc_attr( $small_featured_post ); ?>">
				<?php if ( $post_style == 'default' ) { ?>
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>"
							   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2><!-- .entry-title -->
					</header>
					<?php accelerate_entry_meta(); ?>
				<?php } ?>

				<?php
				if ( has_post_thumbnail() ) {
					$image           = '';
					$title_attribute = get_the_title( $post->ID );
					$image           .= '<figure class="' . $image_class . '">';
					$image           .= '<a href="' . get_permalink() . '" title="' . the_title( '', '', false ) . '">';
					$image_id        = get_post_thumbnail_id( get_the_ID() );
					$image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
					$image_alt_text  = ! empty( $image_alt ) ? $image_alt : $title_attribute;
					$image           .= get_the_post_thumbnail( $post->ID, $featured, array(
							'title' => esc_attr( $title_attribute ),
							'alt'   => esc_attr( $image_alt_text ),
						) ) . '</a>';
					$image           .= '</figure>';

					echo $image;
				}
				?>

				<?php if ( $post_style == 'style-1' || $post_style == 'style-2' ) { ?>
					<div class="entry-meta-header-wrapper">
						<div class="entry-meta">
							<?php if ( $post_style != 'style-2' ) { ?>
								<span
									class="byline"><span
										class="author vcard"><?php echo get_avatar( get_the_author_meta( 'ID' ), 20 ); ?><a
											class="url fn n"
											href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
											title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
							<?php } ?>
							<?php $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
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

						<header class="entry-header">
							<h2 class="entry-title">
								<a href="<?php the_permalink(); ?>"
								   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2><!-- .entry-title -->
						</header>
					</div>
				<?php } ?>

				<?php if ( $post_style != 'style-2' ) { ?>
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
				<?php } ?>
			</div>
			<?php
			$i ++;
		endwhile;
		if ( ! empty( $button_text ) ) {
			?>
			<?php
			// For WPML plugin compatibility
			if ( function_exists( 'icl_t' ) ) {
				$button_text = icl_t( 'Accelerate Pro', 'TG: Featured posts widget Button text' . $this->id, $button_text );
			}
			if ( function_exists( 'icl_t' ) ) {
				$button_url = icl_t( 'Accelerate Pro', 'TG: Featured posts widget Button redirect link' . $this->id, $button_url );
			}
			?>
			<div class="featured-posts-show-more">
				<a class="read-more" href="<?php echo $button_url; ?>"
				   title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
			</div>
			<?php
		}
		// Reset Post Data
		wp_reset_query();
		?>
		<?php echo $after_widget;
	}

}
