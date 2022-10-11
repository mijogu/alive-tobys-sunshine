<?php
/**
 * Clients images widget
 */

class accelerate_our_clients_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_our_clients',
			'description' => __( 'Widget to show clients/partners images', 'accelerate' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Our Clients', 'accelerate' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$instance        = wp_parse_args( (array) $instance, array(
			'title'           => '',
			'text'            => '',
			'image-1'         => '',
			'image-2'         => '',
			'image-3'         => '',
			'image-4'         => '',
			'image-5'         => '',
			'image-6'         => '',
			'image-7'         => '',
			'image-8'         => '',
			'image-9'         => '',
			'image-10'        => '',
			'link-1'          => '',
			'link-2'          => '',
			'link-3'          => '',
			'link-4'          => '',
			'link-5'          => '',
			'link-6'          => '',
			'link-7'          => '',
			'link-8'          => '',
			'link-9'          => '',
			'link-10'         => '',
			'hover-text1'     => '',
			'hover-text2'     => '',
			'hover-text3'     => '',
			'hover-text4'     => '',
			'hover-text5'     => '',
			'hover-text6'     => '',
			'hover-text7'     => '',
			'hover-text8'     => '',
			'hover-text9'     => '',
			'hover-text10'    => '',
			'new_tab'         => 0,
			'carousel_enable' => 0,
		) );
		$title           = esc_attr( $instance['title'] );
		$text            = esc_textarea( $instance['text'] );
		$new_tab         = $instance['new_tab'] ? 'checked="checked"' : '';
		$carousel_enable = $instance['carousel_enable'] ? 'checked="checked"' : '';
		$speed           = isset( $instance['speed'] ) ? $instance['speed'] : 2000;
		for ( $i = 1; $i < 11; $i ++ ) {
			$image                   = 'image-' . $i;
			$link                    = 'link-' . $i;
			$hover_text              = 'hover-text' . $i;
			$instance[ $image ]      = esc_url( $instance[ $image ] );
			$instance[ $link ]       = esc_url( $instance[ $link ] );
			$instance[ $hover_text ] = strip_tags( $instance[ $hover_text ] );
		}
		?>
		<p><?php _e( 'Note: To add the image. Go to Media->Add New. Upload an image. Copy the image path link and paste in image input field. Recommended size for the image is 150px * 80x.', 'accelerate' ); ?></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php _e( 'Description', 'accelerate' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

		<?php for ( $i = 1; $i < 11; $i ++ ) {
			$image      = 'image-' . $i;
			$link       = 'link-' . $i;
			$hover_text = 'hover-text' . $i;
			?>
			<p>
				<label for="<?php echo $this->get_field_id( $image ); ?>"><?php _e( 'Image Path Link ', 'accelerate' );
					echo $i; ?></label>
				<input style="width:100%;" id="<?php echo $this->get_field_id( $image ); ?>" name="<?php echo $this->get_field_name( $image ); ?>" type="text" value="<?php echo $instance[ $image ]; ?>" />
			</p>
			<p><?php _e( 'Redirect Link ', 'accelerate' );
				echo $i; ?>
				<input style="width:100%;" name="<?php echo $this->get_field_name( $link ); ?>" type="text" value="<?php if ( isset ( $instance[ $link ] ) ) {
					echo esc_url( $instance[ $link ] );
				} ?>" /></p>
			<p>
				<label for="<?php echo $this->get_field_id( $hover_text ); ?>"><?php _e( 'Hover Title Text ', 'accelerate' );
					echo $i; ?></label>
				<input style="width:100%;" id="<?php echo $this->get_field_id( $hover_text ); ?>" name="<?php echo $this->get_field_name( $hover_text ); ?>" type="text" value="<?php echo $instance[ $hover_text ]; ?>" />
			</p>
			<hr />

		<?php } ?>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $new_tab; ?> id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'new_tab' ); ?>"><?php esc_html_e( 'Check to open in same window', 'accelerate' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $carousel_enable; ?> id="<?php echo $this->get_field_id( 'carousel_enable' ); ?>" name="<?php echo $this->get_field_name( 'carousel_enable' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'carousel_enable' ); ?>"><?php esc_html_e( 'Enable carousel', 'accelerate' ); ?></label>
		</p>
		<p>
			<?php _e( 'Slider Transition Speed', 'accelerate' ); ?>
			<input id="<?php echo $this->get_field_id( 'speed' ); ?>" name="<?php echo $this->get_field_name( 'speed' ); ?>" type="text" value="<?php echo absint( $speed ); ?>" />
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['speed'] = isset( $new_instance['speed'] ) ? absint( $new_instance['speed'] ) : 2000;
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		}

		$instance['new_tab']         = isset( $new_instance['new_tab'] ) ? 1 : 0;
		$instance['carousel_enable'] = isset( $new_instance['carousel_enable'] ) ? 1 : 0;

		for ( $i = 1; $i < 11; $i ++ ) {
			$image                   = 'image-' . $i;
			$link                    = 'link-' . $i;
			$hover_text              = 'hover-text' . $i;
			$instance[ $image ]      = esc_url_raw( $new_instance[ $image ] );
			$instance[ $link ]       = esc_url_raw( $new_instance[ $link ] );
			$instance[ $hover_text ] = strip_tags( $new_instance[ $hover_text ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$new_tab         = ! empty( $instance['new_tab'] ) ? '' : 'target="_blank"';
		$carousel_enable = ! empty( $instance['carousel_enable'] ) ? 'true' : 'false';
		if ( ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) && ( $carousel_enable == 'true' ) ) {
			wp_enqueue_script( 'jquery_cycle' );
			wp_enqueue_script( 'jquery-cycle2-swipe' );
		}

		$title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text  = isset( $instance['text'] ) ? $instance['text'] : '';
		$speed = isset( $instance['speed'] ) ? $instance['speed'] : 2000;

		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'Accelerate Pro', 'TG: Our Clients text' . $this->id, $text );
		}

		$image_array      = array();
		$link_array       = array();
		$hover_text_array = array();

		$j = 0;
		for ( $i = 1; $i < 11; $i ++ ) {
			$image      = 'image-' . $i;
			$link       = 'link-' . $i;
			$hover_text = 'hover-text' . $i;
			$image      = isset( $instance[ $image ] ) ? $instance[ $image ] : '';
			$link       = isset( $instance[ $link ] ) ? $instance[ $link ] : '';
			$hover_text = isset( $instance[ $hover_text ] ) ? $instance[ $hover_text ] : '';

			array_push( $image_array, $image );
			array_push( $link_array, $link );
			array_push( $hover_text_array, $hover_text );
			// For WPML plugin compatibility
			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( 'Accelerate Pro', 'TG: Our Clients Image Path' . $this->id . $j, $image_array[ $j ] );
			}
			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( 'Accelerate Pro', 'TG: Our Clients Image Redirect Link' . $this->id . $j, $link_array[ $j ] );
			}
			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( 'Accelerate Pro', 'TG: Our Clients Image Hover text' . $this->id . $j, $hover_text_array[ $j ] );
			}
			$j ++;
		}

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}
		if ( ! empty( $text ) ) { ?>
			<p><?php
				// For WPML plugin compatibility
				if ( function_exists( 'icl_t' ) ) {
					$text = icl_t( 'Accelerate Pro', 'TG: Our Clients text' . $this->id, $text );
				}
				echo esc_textarea( $text ); ?></p>
		<?php }
		if ( ! empty( $image_array ) ) {
			$output = '';
			if ( $carousel_enable == 'true' ) {
				$output .= '<div id="' . esc_attr( $this->id ) . '_clients-cycle-prev" class="clients-cycle-prev"></div>';
				$output .= '<div id="' . esc_attr( $this->id ) . '_clients-cycle-next" class="clients-cycle-next"></div>';
			} ?>

			<div class="our-clients-wrapper">

				<?php

				if ( $carousel_enable == 'false' ) {
					$output .= '<div class="accelerate_clients_wrap">';
				} else {
					$output .= '<div class="accelerate_clients_wrap slide" data-cycle-fx="carousel" data-cycle-timeout="' . $speed . '" data-cycle-slides="> div" data-cycle-prev="#' . $this->id . '_clients-cycle-prev" data-cycle-next="#' . $this->id . '_clients-cycle-next">';
				} ?>

				<?php
				for ( $i = 1; $i < 11; $i ++ ) {
					$j                  = $i - 1;
					$attachment_post_id = attachment_url_to_postid( $image_array[ $j ] );
					$image_attributes   = wp_get_attachment_image_src( $attachment_post_id, 'full' );
					if ( ! empty( $image_array[ $j ] ) ) {
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							$hover_text_array[ $j ] = icl_t( 'Accelerate Pro', 'TG: Our Clients Image Hover text' . $this->id . $j, $hover_text_array[ $j ] );
						}

						if ( function_exists( 'icl_t' ) ) {
							$image_array[ $j ] = icl_t( 'Accelerate Pro', 'TG: Our Clients Image Path' . $this->id . $j, $image_array[ $j ] );
						}

						if ( function_exists( 'icl_t' ) ) {
							$link_array[ $j ] = icl_t( 'Accelerate Pro', 'TG: Our Clients Image Redirect Link' . $this->id . $j, $link_array[ $j ] );
						}

						$output .= '<div class="accelerate_single_client">';
						if ( ! empty( $link_array[ $j ] ) ) {
							$output .= '<a href="' . $link_array[ $j ] . '" title="' . $hover_text_array[ $j ] . '" ' . $new_tab . '>
											<img src="' . $image_array[ $j ] . '" width="' . esc_attr( $image_attributes[1] ) . '" height="' . esc_attr( $image_attributes[2] ) . '" alt="' . $hover_text_array[ $j ] . '" >
										</a>';
						} else {
							$output .= '<img src="' . $image_array[ $j ] . '" width="' . esc_attr( $image_attributes[1] ) . '" height="' . esc_attr( $image_attributes[2] ) . '" alt="' . $hover_text_array[ $j ] . '">';
						}
						$output .= '</div>';
					}
				}
				$output .= '</div>';
				echo $output;
				?>

			</div>

		<?php }

		echo $after_widget;
	}

}
