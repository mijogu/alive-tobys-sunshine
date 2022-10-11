<?php
/**
 * Fun Facts widget
 */

class accelerate_fun_facts_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_fun_facts',
			'description' => esc_html__( 'Widget to show Fun Facts', 'accelerate' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Fun Facts', 'accelerate' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$defaults                = array();
		$defaults['facts_title'] = '';
		$defaults['facts_desc']  = '';
		$defaults['facts_style'] = 'fact-style-default';
		for ( $i = 0; $i < 4; $i ++ ) {
			$defaults[ 'fact_num_' . $i ]    = '';
			$defaults[ 'fact_detail_' . $i ] = '';
			$defaults[ 'fact_icon_' . $i ]   = '';
		}
		$instance = wp_parse_args( (array) $instance, $defaults );

		$facts_title = $instance['facts_title'];
		$facts_desc  = $instance['facts_desc'];
		$facts_style = $instance['facts_style'];
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'facts_title' ); ?>"><?php esc_html_e( 'Title:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'facts_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'facts_title' ); ?>" type="text" value="<?php echo esc_attr( $facts_title ); ?>"/>
		</p>

		<?php esc_html_e( 'Description:', 'accelerate' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'facts_desc' ); ?>" name="<?php echo $this->get_field_name( 'facts_desc' ); ?>"><?php echo esc_textarea( $facts_desc ); ?></textarea>

		<?php for ( $i = 0; $i < 4; $i ++ ) : ?>

			<p>
				<label for="<?php echo $this->get_field_id( 'fact_num_' . $i ); ?>"><?php esc_html_e( 'Fact number: ', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'fact_num_' . $i ); ?>" name="<?php echo $this->get_field_name( 'fact_num_' . $i ); ?>" type="text" min="1" step="1" value="<?php echo absint( $instance[ 'fact_num_' . $i ] ); ?>"/>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'fact_detail_' . $i ); ?>"><?php esc_html_e( 'Fact Detail:', 'accelerate' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'fact_detail_' . $i ); ?>" name="<?php echo $this->get_field_name( 'fact_detail_' . $i ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'fact_detail_' . $i ] ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'fact_icon_' . $i ); ?>"><?php esc_html_e( 'Icon Class:', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'fact_icon_' . $i ); ?>" name="<?php echo $this->get_field_name( 'fact_icon_' . $i ); ?>" placeholder="fa-trophy" type="text" value="<?php echo esc_attr( $instance[ 'fact_icon_' . $i ] ); ?>"/>
			</p>
			<hr/>
		<?php endfor; ?>

		<p>
			<?php
			$url  = 'http://fontawesome.io/icons/';
			$link = sprintf( __( '<a href="%s" target="_blank">Refer here</a> For Icon Class', 'accelerate' ), esc_url( $url ) );
			echo $link;
			?>
		</p>

		<?php esc_html_e( 'Style Option:', 'accelerate' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'facts_style' ); ?>" name="<?php echo $this->get_field_name( 'facts_style' ); ?>">
				<option value="fact-style-default" <?php if ( $facts_style == 'fact-style-default' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Default', 'accelerate' ); ?></option>
				<option value="fact-style-1" <?php if ( $facts_style == 'fact-style-1' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Style One', 'accelerate' ); ?></option>
				<option value="fact-style-2" <?php if ( $facts_style == 'fact-style-2' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Style Two', 'accelerate' ); ?></option>
				<option value="fact-style-3" <?php if ( $facts_style == 'fact-style-3' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Style Three', 'accelerate' ); ?></option>
			</select>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['facts_title'] = sanitize_text_field( $new_instance['facts_title'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['facts_desc'] = $new_instance['facts_desc'];
		} else {
			$instance['facts_desc'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['facts_desc'] ) ) ); // wp_filter_post_kses() expects slashed
		}

		$instance['facts_style'] = $new_instance['facts_style'];

		for ( $i = 0; $i < 4; $i ++ ) {
			$instance[ 'fact_num_' . $i ]    = absint( $new_instance[ 'fact_num_' . $i ] );
			$instance[ 'fact_detail_' . $i ] = sanitize_text_field( $new_instance[ 'fact_detail_' . $i ] );
			$instance[ 'fact_icon_' . $i ]   = sanitize_text_field( $new_instance[ 'fact_icon_' . $i ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$facts_title = apply_filters( 'widget_title', isset( $instance['facts_title'] ) ? $instance['facts_title'] : '' );
		$facts_desc  = isset( $instance['facts_desc'] ) ? $instance['facts_desc'] : '';
		$facts_style = isset( $instance['facts_style'] ) ? $instance['facts_style'] : 'fact-style-default';

		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) && ! empty( $facts_desc ) ) {
			icl_register_string( 'Accelerate Pro', 'TG: Fun Facts' . $this->id . $i, $packages[ $i ] );
		}
		$fact_nums    = array();
		$fact_deatils = array();
		$fact_icons   = array();
		for ( $i = 0; $i < 4; $i ++ ) {
			$fact_nums[]    = isset( $instance[ 'fact_num_' . $i ] ) ? $instance[ 'fact_num_' . $i ] : '';
			$fact_deatils[] = isset( $instance[ 'fact_detail_' . $i ] ) ? $instance[ 'fact_detail_' . $i ] : '';
			$fact_icons[]   = isset( $instance[ 'fact_icon_' . $i ] ) ? $instance[ 'fact_icon_' . $i ] : '';
			// For WPML plugin compatibility
			if ( function_exists( 'icl_register_string' ) && ! empty( $packages ) ) {
				icl_register_string( 'Accelerate Pro', 'TG: Fun Facts' . $this->id . $i, $fact_deatils[ $i ] );
			}
		}

		echo $before_widget; ?>

		<div class="section-wrapper">
			<div class="tg-container fact clearfix">
				<?php if ( ! empty( $facts_title ) ) {
					echo $before_title . esc_html( $facts_title ) . $after_title;
				}
				if ( ! empty( $facts_desc ) ) { ?>
					<p><?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							$facts_desc = icl_t( 'Accelerate Pro', 'TG: Fun Facts' . $this->id, $facts_desc );
						}
						echo esc_textarea( $facts_desc ); ?></p>
				<?php } ?>

				<div class="counter-wrapper clearfix">
					<?php
					$facts_class = '';
					if ( $facts_style == 'fact-style-1' ) {
						$facts_class = 'fact-style-1';
					} elseif ( $facts_style == 'fact-style-2' ) {
						$facts_class = 'fact-style-2';
					} elseif ( $facts_style == 'fact-style-3' ) {
						$facts_class = 'fact-style-3';
					}

					for ( $i = 0; $i < 4; $i ++ ) :
						if ( isset( $fact_nums ) || isset( $fact_deatils ) || isset( $fact_icons ) ) : ?>
							<div class="counter-block-wrapper <?php echo esc_attr( $facts_style ); ?> clearfix">
								<div class="counter-inner-wrapper">
									<?php
									// For WPML plugin compatibility
									if ( function_exists( 'icl_t' ) ) {
										$fact_deatils[ $i ] = icl_t( 'Accelerate Pro', 'TG: Fun Facts' . $this->id . $i, $fact_deatils[ $i ] );
									} ?>
									<div id="container"></div>
									<?php
									echo '<span class="counter-icon"> <i class="fa ' . esc_attr( $fact_icons[ $i ] ) . '"></i> </span>';
									echo '<div class="counter-content">';
									if ( $fact_nums[ $i ] ) {
										echo '<span class="counter">' . esc_html( $fact_nums[ $i ] ) . '</span>';
									}
									echo '<span class="counter-text">' . esc_html( $fact_deatils[ $i ] ) . '</span>';
									echo '</div>';
									?>
								</div>
							</div>
						<?php endif;
					endfor;
					?>
				</div>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
}
