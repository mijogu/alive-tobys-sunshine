<?php
/**
 * Featured service widget to show pages.
 */

class accelerate_image_service_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_image_service_block',
			'description'                 => esc_html__( 'Display some pages as services. Best for Business Top or Bottom sidebar.', 'accelerate' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Image Services', 'accelerate' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$defaults = array();
		for ( $i = 0; $i < 9; $i ++ ) {
			$defaults[ 'page_id' . $i ] = '';
		}
		$defaults['image_link']        = '0';
		$defaults['display_read_more'] = '0';
		$defaults['open_in_new_tab']   = '0';
		$defaults['style']             = 'center';
		$defaults['select_column']     = 'services-column-layout-3';
		$instance                      = wp_parse_args( (array) $instance, $defaults );

		$image_link        = $instance['image_link'] ? 'checked="checked"' : '';
		$display_read_more = $instance['display_read_more'] ? 'checked="checked"' : '';
		$open_in_new_tab   = $instance['open_in_new_tab'] ? 'checked="checked"' : '';
		$style             = $instance['style'];
		$select_column     = $instance['select_column'];

		for ( $i = 0; $i < 9; $i ++ ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'page_' . $i ); ?>"><?php esc_html_e( 'Page:', 'accelerate' ); ?></label>
				<?php
				$arg = array(
					'class'            => 'widefat',
					'show_option_none' => ' ',
					'name'             => $this->get_field_name( 'page_id' . $i ),
					'id'               => $this->get_field_id( 'page_id' . $i ),
					'selected'         => absint( $instance[ 'page_id' . $i ] ),
				);
				wp_dropdown_pages( $arg ); ?>
			</p>
		<?php endfor; ?>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $image_link; ?> id="<?php echo $this->get_field_id( 'image_link' ); ?>" name="<?php echo $this->get_field_name( 'image_link' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'image_link' ); ?>"><?php esc_html_e( 'Link featured image to their respective page', 'accelerate' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $display_read_more; ?> id="<?php echo $this->get_field_id( 'display_read_more' ); ?>" name="<?php echo $this->get_field_name( 'display_read_more' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'display_read_more' ); ?>"><?php esc_html_e( 'Display Read more', 'accelerate' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $open_in_new_tab; ?> id="<?php echo $this->get_field_id( 'open_in_new_tab' ); ?>" name="<?php echo $this->get_field_name( 'open_in_new_tab' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'open_in_new_tab' ); ?>"><?php esc_html_e( 'Check to open in new tab.', 'accelerate' ); ?></label>
		</p>
		<?php esc_html_e( 'Select the image service column', 'accelerate' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'select_column' ); ?>" name="<?php echo $this->get_field_name( 'select_column' ); ?>">
				<option value="services-column-layout-2" <?php if ( $select_column == 'services-column-layout-2' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Two Column', 'accelerate' ); ?></option>
				<option value="services-column-layout-3" <?php if ( $select_column == 'services-column-layout-3' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Three Column', 'accelerate' ); ?></option>
				<option value="services-column-layout-4" <?php if ( $select_column == 'services-column-layout-4' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Four Column', 'accelerate' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php esc_html_e( 'Alignment:', 'accelerate' ); ?></label><br/>
			<input type="radio" <?php checked( $style, 'left' ) ?> id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'style' ); ?>" value="left"/><?php esc_html_e( 'Left', 'accelerate' ); ?>
			<input type="radio" <?php checked( $style, 'right' ) ?> id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'style' ); ?>" value="right"/><?php esc_html_e( 'Right', 'accelerate' ); ?>
			<input type="radio" <?php checked( $style, 'center' ) ?> id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'style' ); ?>" value="center"/><?php esc_html_e( 'Center', 'accelerate' ); ?>
		</p>
	<?php }

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		for ( $i = 0; $i < 9; $i ++ ) {
			$instance[ 'page_id' . $i ] = absint( $new_instance[ 'page_id' . $i ] );
		}
		$instance['image_link']        = isset( $new_instance['image_link'] ) ? 1 : 0;
		$instance['display_read_more'] = isset( $new_instance['display_read_more'] ) ? 1 : 0;
		$instance['open_in_new_tab']   = isset( $new_instance['open_in_new_tab'] ) ? 1 : 0;
		$instance['style']             = sanitize_key( $new_instance['style'] );
		$instance['select_column']     = sanitize_key( $new_instance['select_column'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$pages = array();
		for ( $i = 0; $i < 9; $i ++ ) {
			$pages[] = isset( $instance[ 'page_id' . $i ] ) ? $instance[ 'page_id' . $i ] : '';
		}
		$image_link        = ! empty( $instance['image_link'] ) ? 'true' : 'false';
		$display_read_more = ! empty( $instance['display_read_more'] ) ? 1 : 0;
		$open_in_new_tab   = ! empty( $instance['open_in_new_tab'] ) ? 'true' : 'false';
		$select_column     = isset( $instance['select_column'] ) ? $instance['select_column'] : 'services-column-layout-3';
		$style             = empty( $instance['style'] ) ? 'center' : $instance['style'];

		$get_featured_pages = new WP_Query( array(
			'posts_per_page' => count( $pages ),
			'post_type'      => array( 'page' ),
			'post__in'       => $pages,
			'orderby'        => 'post__in',
		) );
		echo $before_widget; ?>
		<?php
		if ( ! empty( $pages ) ) :
			$post_count = 1;
			while ( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
				$page_title    = get_the_title();
				$service_class = '';
				$selected_col  = '';
				if ( $select_column == 'services-column-layout-2' ) :
					if ( $post_count % 2 == 0 ) {
						$service_class = 'tg-one-half tg-one-half-last';
					} else {
						$service_class = 'tg-one-half';
					}
					$selected_col = '2';
				elseif ( $select_column == 'services-column-layout-3' ) :
					if ( $post_count % 3 == 0 ) {
						$service_class = 'tg-one-third tg-one-third-last';
					} else {
						$service_class = 'tg-one-third';
					}
					$selected_col = '3';
				elseif ( $select_column == 'services-column-layout-4' ) :
					if ( $post_count % 4 == 0 ) {
						$service_class = 'tg-one-fourth tg-one-fourth-last';
					} else {
						$service_class = 'tg-one-fourth';
					}
					$selected_col = '4';
				endif;
				// style class
				$style_class = '';
				if ( $style == 'left' ) {
					$style_class = 'left';
				} elseif ( $style == 'right' ) {
					$style_class = 'right';
				} else {
					$style_class = 'center';
				}
				?>
				<div class="<?php echo esc_attr( $service_class ); ?> image-service-wrapper-<?php echo esc_attr( $style_class ); ?>">
					<?php
					$new_tab = '';
					if ( $open_in_new_tab == "true" ) {
						$new_tab = 'target="_blank"';
					} ?>

					<?php
					if ( has_post_thumbnail() ) {
						if ( $image_link == 'true' ) {
							echo '<a title="' . esc_attr( get_the_title() ) . '" href="' . esc_url( get_permalink() ) . '"' . esc_attr( $new_tab ) . '><div class="service-image">' . get_the_post_thumbnail( $post->ID, 'featured-service' ) . '</div></a>';
						} else {
							echo '<div class="service-image">' . get_the_post_thumbnail( $post->ID, 'featured-service' ) . '</div>';
						}

					} ?>

					<h2 class="entry-title">
						<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" <?php echo esc_attr( $new_tab ); ?>><?php echo esc_html( $page_title ); ?></a>
					</h2>
					<?php the_excerpt(); ?>

					<?php if ( $display_read_more ) {
						echo '<a class="more-link" href="' . esc_url( get_permalink() ) . '" ' . esc_attr( $new_tab ) . '><span>' . accelerate_options( 'accelerate_read_more_text', esc_html__( 'Read more', 'accelerate' ) ) . '</span></a>';
					} ?>
				</div>
				<?php
				if ( $post_count % $selected_col == 0 ) {
					echo '<div class="clearfix"></div>';
				}
				$post_count ++; ?>
			<?php endwhile;
			// Reset Post Data
			wp_reset_postdata();
		endif;
		?>
		<?php
		echo $after_widget;
	}
}
