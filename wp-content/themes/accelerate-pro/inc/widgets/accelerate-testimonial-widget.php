<?php
/**
 * Testimonial widget
 */

class accelerate_testimonial_widget extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_testimonial',
			'description'                 => __( 'Display Testimonial', 'accelerate' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Testimonial', 'accelerate' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title           = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$testimonial_num = isset( $instance['testimonial_num'] ) ? $instance['testimonial_num'] : 2;

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}

		for ( $i = 1; $i <= $testimonial_num; $i ++ ) {
			$name   = empty( $instance[ 'name' . $i ] ) ? '' : $instance[ 'name' . $i ];
			$byline = empty( $instance[ 'byline' . $i ] ) ? '' : $instance[ 'byline' . $i ];
			$text   = empty( $instance[ 'text' . $i ] ) ? '' : $instance[ 'text' . $i ];
			$image  = empty( $instance[ 'image' . $i ] ) ? '' : $instance[ 'image' . $i ];

			// For WPML plugin compatibility
			if ( function_exists( 'icl_register_string' ) ) {
				if ( $i == 1 ) {
					icl_register_string( 'Accelerate Pro', 'TG: First Testimonial widget text' . $this->id, $text );
					icl_register_string( 'Accelerate Pro', 'TG: First Testimonial widget name' . $this->id, $name );
					icl_register_string( 'Accelerate Pro', 'TG: First Testimonial widget byline' . $this->id, $byline );
					icl_register_string( 'Accelerate Pro', 'TG: First Testimonial widget image one' . $this->id, $image );
				} elseif ( $i == 2 ) {
					icl_register_string( 'Accelerate Pro', 'TG: Second Testimonial widget text' . $this->id, $text );
					icl_register_string( 'Accelerate Pro', 'TG: Second Testimonial widget name' . $this->id, $name );
					icl_register_string( 'Accelerate Pro', 'TG: Second Testimonial widget byline' . $this->id, $byline );
					icl_register_string( 'Accelerate Pro', 'TG: Second Testimonial widget image two' . $this->id, $image );
				} else {
					icl_register_string( 'Accelerate Pro', 'TG: Testimonial widget text' . $i . $this->id, $text );
					icl_register_string( 'Accelerate Pro', 'TG: Testimonial widget name' . $i . $this->id, $name );
					icl_register_string( 'Accelerate Pro', 'TG: Testimonial widget byline' . $i . $this->id, $byline );
					icl_register_string( 'Accelerate Pro', 'TG: Testimonial widget image' . $i . $this->id, $image );
				}
			}

			$testimonial_class = 'first-testimonial';
			if ( $i % 2 == 0 ) {
				$testimonial_class = 'second-testimonial';
			}
			?>

			<div class="<?php echo esc_attr( $testimonial_class ); ?>">
				<?php if ( ! empty( $text ) ) { ?>
					<div class="testimonial-post"><i class="fa fa-quote-left"></i>
						<?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							if ( $i == 1 ) {
								$text = icl_t( 'Accelerate Pro', 'TG: First Testimonial widget text' . $this->id, $text );
							} elseif ( $i == 2 ) {
								$text = icl_t( 'Accelerate Pro', 'TG: Second Testimonial widget text' . $this->id, $text );
							} else {
								$text = icl_t( 'Accelerate Pro', 'TG: Testimonial widget text' . $i . $this->id, $text );
							}
						}
						echo '<p>' . esc_textarea( $text ) . '</p>'; ?></div>
				<?php } ?>
				<div class="testimonial-author">
					<div class="testimonial-author-detail">
					<span><?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							if ( $i == 1 ) {
								$name = icl_t( 'Accelerate Pro', 'TG: First Testimonial widget name' . $this->id, $name );
							} elseif ( $i == 2 ) {
								$name = icl_t( 'Accelerate Pro', 'TG: Second Testimonial widget name' . $this->id, $name );
							} else {
								$name = icl_t( 'Accelerate Pro', 'TG: Testimonial widget name' . $i . $i . $this->id, $name );
							}
						}
						echo esc_html( $name ); ?></span><br />
						<?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							if ( $i == 1 ) {
								$byline = icl_t( 'Accelerate Pro', 'TG: First Testimonial widget byline' . $this->id, $byline );
							} elseif ( $i == 2 ) {
								$byline = icl_t( 'Accelerate Pro', 'TG: Second Testimonial widget byline' . $this->id, $byline );
							} else {
								$byline = icl_t( 'Accelerate Pro', 'TG: Testimonial widget byline' . $i . $this->id, $byline );
							}
						}
						echo esc_html( $byline ); ?>
					</div>
					<?php if ( ! empty( $image ) ) {
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							if ( $i == 1 ) {
								$image = icl_t( 'Accelerate Pro', 'TG: First Testimonial widget image one' . $this->id, $image );
							} elseif ( $i == 2 ) {
								$image = icl_t( 'Accelerate Pro', 'TG: Second Testimonial widget image two' . $this->id, $image );
							} else {
								$image = icl_t( 'Accelerate Pro', 'TG: Testimonial widget image' . $i . $this->id, $image );
							}
						}
						?>
						<div class="testimonial-author-image">
							<img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
						</div>
					<?php } ?>
				</div>
			</div>

			<?php
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['testimonial_num'] = absint( $new_instance['testimonial_num'] );

		for ( $i = 1; $i <= $instance['testimonial_num']; $i ++ ) {
			$instance[ 'name' . $i ]   = strip_tags( $new_instance[ 'name' . $i ] );
			$instance[ 'byline' . $i ] = strip_tags( $new_instance[ 'byline' . $i ] );
			if ( current_user_can( 'unfiltered_html' ) ) {
				$instance[ 'text' . $i ] = $new_instance[ 'text' . $i ];
			} else {
				$instance[ 'text' . $i ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' . $i ] ) ) );
			} // wp_filter_post_kses() expects slashed

			$instance[ 'image' . $i ] = esc_url_raw( $new_instance[ 'image' . $i ] );
		}


		return $instance;
	}

	function form( $instance ) {

		$defaults['title']           = '';
		$defaults['testimonial_num'] = 2;

		for ( $i = 1; $i <= $defaults['testimonial_num']; $i ++ ) {
			$defaults[ 'name' . $i ]   = '';
			$defaults[ 'byline' . $i ] = '';
			$defaults[ 'text' . $i ]   = '';
			$defaults[ 'image' . $i ]  = '';
		}

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title           = strip_tags( $instance['title'] );
		$testimonial_num = absint( $instance['testimonial_num'] );
		?>
		<p><?php _e( 'Note: To add the image. Go to Media->Add New. Upload an image. Copy the image path link and paste in image input field. Recommended size for the image is 72 x 72 pixels.', 'accelerate' ); ?></p>
		<p>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'accelerate' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'testimonial_num' ); ?>"><?php _e( 'No. of Testimonials:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'testimonial_num' ); ?>" name="<?php echo $this->get_field_name( 'testimonial_num' ); ?>" type="text" value="<?php echo $testimonial_num; ?>" />
		</p>

		<?php
		for ( $i = 1; $i <= $instance['testimonial_num']; $i ++ ) {
			$name   = $instance[ 'name' . $i ];
			$byline = $instance[ 'byline' . $i ];
			$text   = $instance[ 'text' . $i ];
			$image  = $instance[ 'image' . $i ];

			if ( $i == 1 ) {
				?>
				<strong><?php _e( 'First Testimonial', 'accelerate' ); ?></strong><br />
				<?php
			} elseif ( $i == 2 ) {
				?>
				<strong><?php _e( 'Second Testimonial', 'accelerate' ); ?></strong><br />
				<?php
			} else {
				?>
				<strong><?php _e( 'Testimonial number', 'accelerate' ); ?><?php echo ' ' . $i; ?></strong><br />
				<?php
			}

			_e( 'Testimonial Description', 'accelerate' ); ?>
			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id( 'text' . $i ); ?>" name="<?php echo $this->get_field_name( 'text' . $i ); ?>"><?php echo $text; ?></textarea>

			<p>
				<label for="<?php echo $this->get_field_id( 'name' . $i ); ?>"><?php _e( 'Name:', 'accelerate' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'name' . $i ); ?>" name="<?php echo $this->get_field_name( 'name' . $i ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'byline' . $i ); ?>"><?php _e( 'Byline:', 'accelerate' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'byline' . $i ); ?>" name="<?php echo $this->get_field_name( 'byline' . $i ); ?>" type="text" value="<?php echo esc_attr( $byline ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'image' . $i ); ?>"><?php _e( 'Image:', 'accelerate' ); ?></label>
				<input style="width:100%;" id="<?php echo $this->get_field_id( 'image' . $i ); ?>" name="<?php echo $this->get_field_name( 'image' . $i ); ?>" type="text" value="<?php echo $image; ?>" />
			</p>
		<?php }

	}
}
