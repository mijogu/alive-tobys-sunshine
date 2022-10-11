<?php
/**
 * Featured call to action widget.
 */

class accelerate_call_to_action_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_call_to_action',
			'description'                 => esc_html__( 'Use this widget to show the call to action section.', 'accelerate' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Call To Action Widget', 'accelerate' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$accelerate_defaults['style']           = 'first';
		$accelerate_defaults['text_main']       = '';
		$accelerate_defaults['text_additional'] = '';
		$accelerate_defaults['button_text']     = '';
		$accelerate_defaults['button_url']      = '';
		$accelerate_defaults['new_tab']         = '0';
		$instance                               = wp_parse_args( (array) $instance, $accelerate_defaults );
		$style                                  = $instance['style'];
		$text_main                              = $instance['text_main'];
		$text_additional                        = $instance['text_additional'];
		$button_text                            = $instance['button_text'];
		$button_url                             = $instance['button_url'];
		$new_tab                                = $instance['new_tab'] ? 'checked="checked"' : '';
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php esc_html_e( 'Choose style:', 'accelerate' ); ?></label><br />
			<input type="radio" <?php checked( $style, 'first' ) ?> id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'style' ); ?>" value="first" /><?php esc_html_e( 'Style One', 'accelerate' ); ?>
			<input type="radio" <?php checked( $style, 'second' ) ?> id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'style' ); ?>" value="second" /><?php esc_html_e( 'Style Two', 'accelerate' ); ?>
		</p>

		<?php esc_html_e( 'Call to Action Main Text', 'accelerate' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'text_main' ); ?>" name="<?php echo $this->get_field_name( 'text_main' ); ?>"><?php echo esc_textarea( $text_main ); ?></textarea>
		<?php esc_html_e( 'Call to Action Additional Text', 'accelerate' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'text_additional' ); ?>" name="<?php echo $this->get_field_name( 'text_additional' ); ?>"><?php echo esc_textarea( $text_additional ); ?></textarea>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php esc_html_e( 'Button Text:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php esc_html_e( 'Button Redirect Link:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo esc_url( $button_url ); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $new_tab; ?> id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'new_tab' ); ?>"><?php esc_html_e( 'Open in new tab', 'accelerate' ); ?></label>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text_main'] = $new_instance['text_main'];
		} else {
			$instance['text_main'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text_main'] ) ) );
		} // wp_filter_post_kses() expects slashed

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text_additional'] = $new_instance['text_additional'];
		} else {
			$instance['text_additional'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text_additional'] ) ) );
		} // wp_filter_post_kses() expects slashed

		$instance['style']       = sanitize_text_field( $new_instance['style'] );
		$instance['button_text'] = sanitize_text_field( $new_instance['button_text'] );
		$instance['button_url']  = esc_url_raw( $new_instance['button_url'] );
		$instance['new_tab']     = isset( $new_instance['new_tab'] ) ? 1 : 0;

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$new_tab         = ! empty( $instance['new_tab'] ) ? 'true' : 'false';
		$style           = empty( $instance['style'] ) ? 'first' : $instance['style'];
		$text_main       = empty( $instance['text_main'] ) ? '' : $instance['text_main'];
		$text_additional = empty( $instance['text_additional'] ) ? '' : $instance['text_additional'];
		$button_text     = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
		$button_url      = isset( $instance['button_url'] ) ? $instance['button_url'] : '#';

		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'Accelerate Pro', 'TG: Call to Action widget main text' . $this->id, $text_main );
			icl_register_string( 'Accelerate Pro', 'TG: Call to Action widget additional text' . $this->id, $text_additional );
			icl_register_string( 'Accelerate Pro', 'TG: Call to Action widget button text' . $this->id, $button_text );
			icl_register_string( 'Accelerate Pro', 'TG: Call to Action widget button redirect link' . $this->id, $button_url );
		}

		// style class
		$style_class = '';
		if ( $style == 'first' ) {
			$style_class = 'first';
		} else {
			$style_class = 'second';
		}

		echo $before_widget;
		?>
		<div class="call-to-action-content-wrapper call-to-action-content-wrapper-<?php echo esc_attr( $style_class ); ?> clearfix">
			<div class="call-to-action-content">
				<?php
				if ( ! empty( $text_main ) ) {
					?>
					<h3><?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							$text_main = icl_t( 'Accelerate Pro', 'TG: Call to Action widget main text' . $this->id, $text_main );
						}
						echo esc_html( $text_main ); ?></h3>
					<?php
				}
				if ( ! empty( $text_additional ) ) {
					?>
					<p><?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							$text_additional = icl_t( 'Accelerate Pro', 'TG: Call to Action widget additional text' . $this->id, $text_additional );
						}
						echo esc_html( $text_additional ); ?></p>
					<?php
				}
				?>
			</div>
			<?php
			if ( ! empty( $button_text ) ) {
				?>
				<?php
				// For WPML plugin compatibility
				if ( function_exists( 'icl_t' ) ) {
					$button_text = icl_t( 'Accelerate Pro', 'TG: Call to Action widget button text' . $this->id, $button_text );
				}
				if ( function_exists( 'icl_t' ) ) {
					$button_url = icl_t( 'Accelerate Pro', 'TG: Call to Action widget button redirect link' . $this->id, $button_url );
				}
				?>
				<a class="read-more" <?php if ( $new_tab == 'true' ) {
					echo 'target="_blank"';
				} ?> href="<?php echo esc_url( $button_url ); ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
				<?php
			}
			?>
		</div>
		<?php
		echo $after_widget;
	}
}
