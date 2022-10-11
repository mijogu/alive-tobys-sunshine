<?php
/**
 * Pricing Table widget
 */

class accelerate_pricing_table_widget extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_table_pricing',
			'description'                 => esc_html__( 'Use this widdget to show the Pricing Table plan. Best for Business Top or Bottom sidebar.', 'accelerate' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Pricing Table', 'accelerate' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$defaults            = array();
		$defaults['title']   = '';
		$defaults['text']    = '';
		$defaults['col_num'] = 3;
		for ( $col_count = 0; $col_count < $defaults['col_num']; $col_count ++ ) {
			$defaults[ 'package_badge_' . $col_count ]       = '';
			$defaults[ 'package_badge_bg_' . $col_count ]    = '#b50101';
			$defaults[ 'package_name_' . $col_count ]        = '';
			$defaults[ 'package_price_' . $col_count ]       = '';
			$defaults[ 'package_desc_' . $col_count ]        = '';
			$defaults[ 'package_subtitle_' . $col_count ]    = '';
			$defaults[ 'package_feature_num_' . $col_count ] = '4';
			$defaults[ 'package_features_' . $col_count ]    = '';
			$defaults[ 'package_btn_txt_' . $col_count ]     = '';
			$defaults[ 'package_btn_url_' . $col_count ]     = '';
			$defaults[ 'package_color_' . $col_count ]       = '#79cc8c';
		}

		$instance = wp_parse_args( (array) $instance, $defaults );
		$title    = $instance['title'];
		$text     = $instance['text'];
		$col_num  = $instance['col_num'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php esc_html_e( 'Description:', 'accelerate' ); ?>
		<textarea id="<?php echo $this->get_field_id( 'text' ); ?>" class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
		<p>
			<?php esc_html_e( 'Note: Enter number of columns for Pricing Table (default 3 columns) and save it then enter the data in respective field.', 'accelerate' ); ?>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'col_num' ); ?>" class="widefat"><?php esc_html_e( 'Display no of Columns:', 'accelerate' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'col_num' ); ?>" name="<?php echo $this->get_field_name( 'col_num' ); ?>">
				<option value="2" <?php echo esc_attr( '2' == $col_num ? 'selected="selected"' : '' ); ?> ><?php esc_html_e( 'Two', 'accelerate' ); ?></option>
				<option value="3" <?php echo esc_attr( '3' == $col_num ? 'selected="selected"' : '' ); ?>><?php esc_html_e( 'Three', 'accelerate' ); ?></option>
				<option value="4" <?php echo esc_attr( '4' == $col_num ? 'selected="selected"' : '' ); ?>><?php esc_html_e( 'Four', 'accelerate' ); ?></option>
			</select>
		</p>
		<hr />
		<?php for ( $col_count = 0; $col_count < $instance['col_num']; $col_count ++ ) : ?>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_name_' . $col_count ); ?>"><?php esc_html_e( 'Title :', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'package_name_' . $col_count ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'package_name_' . $col_count ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'package_name_' . $col_count ] ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_price_' . $col_count ); ?>"><?php esc_html_e( 'Price :', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'package_price_' . $col_count ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'package_price_' . $col_count ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'package_price_' . $col_count ] ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_desc_' . $col_count ); ?>"><?php esc_html_e( 'Description :', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'package_desc_' . $col_count ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'package_desc_' . $col_count ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'package_desc_' . $col_count ] ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_subtitle_' . $col_count ); ?>"><?php esc_html_e( 'Sub Title :', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'package_subtitle_' . $col_count ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'package_subtitle_' . $col_count ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'package_subtitle_' . $col_count ] ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_badge_' . $col_count ); ?>"><?php esc_html_e( 'Badge :', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'package_badge_' . $col_count ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'package_badge_' . $col_count ); ?>" type="text" maxlength="9" value="<?php echo esc_attr( $instance[ 'package_badge_' . $col_count ] ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_badge_bg_' . $col_count ); ?>"><?php esc_html_e( 'Badge background :', 'accelerate' ); ?></label><br />
				<input id="<?php echo $this->get_field_id( 'package_badge_bg_' . $col_count ); ?>" class="widefat tg-color-picker" name="<?php echo $this->get_field_name( 'package_badge_bg_' . $col_count ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'package_badge_bg_' . $col_count ] ); ?>" />
			</p>

			<p>
				<?php esc_html_e( 'Note: Enter the number of features to display in column (default 4 features) and save it then enter the data in respective field.', 'accelerate' ); ?>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_feature_num_' . $col_count ); ?>"><?php esc_html_e( 'Number of features to display :', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'package_feature_num_' . $col_count ); ?>" class="tiny-text" step="1" min="1" name="<?php echo $this->get_field_name( 'package_feature_num_' . $col_count ); ?>" type="number" value="<?php echo absint( $instance[ 'package_feature_num_' . $col_count ] ); ?>" />
			</p>

			<p><?php esc_html_e( 'Features :', 'accelerate' ); ?></p>

			<?php for ( $feature_count = 0; $feature_count < $instance[ 'package_feature_num_' . $col_count ]; $feature_count ++ ) : ?>
				<p>
					<label for="<?php echo $this->get_field_id( 'package_features_' . $col_count ); ?>[<?php echo absint( $feature_count ); ?>]"></label>
					<input id="<?php echo $this->get_field_id( 'package_features_' . $col_count ); ?>[<?php echo absint( $feature_count ); ?>]" class="widefat" name="<?php echo $this->get_field_name( 'package_features_' . $col_count ); ?>[]" type="text" value="<?php if ( isset( $instance[ 'package_features_' . $col_count ][ $feature_count ] ) ) {
						echo esc_attr( $instance[ 'package_features_' . $col_count ][ $feature_count ] );
					} ?>" />
				</p>
			<?php endfor; ?>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_btn_txt_' . $col_count ); ?>"><?php esc_html_e( 'Button Text :', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'package_btn_txt_' . $col_count ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'package_btn_txt_' . $col_count ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'package_btn_txt_' . $col_count ] ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_btn_url_' . $col_count ); ?>"><?php esc_html_e( 'Button URL :', 'accelerate' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'package_btn_url_' . $col_count ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'package_btn_url_' . $col_count ); ?>" type="text" value="<?php echo esc_url( $instance[ 'package_btn_url_' . $col_count ] ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'package_color_' . $col_count ); ?>"><?php esc_html_e( 'Color :', 'accelerate' ); ?></label><br />
				<input id="<?php echo $this->get_field_id( 'package_color_' . $col_count ); ?>" class="widefat tg-color-picker" name="<?php echo $this->get_field_name( 'package_color_' . $col_count ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'package_color_' . $col_count ] ); ?>" />
			</p>

			<hr>
		<?php endfor; ?>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = sanitize_text_field( $new_instance['title'] );
		$instance['col_num'] = absint( $new_instance['col_num'] );

		for ( $col_count = 0; $col_count < $instance['col_num']; $col_count ++ ) {
			$instance[ 'package_badge_' . $col_count ]       = sanitize_text_field( $new_instance[ 'package_badge_' . $col_count ] );
			$instance[ 'package_badge_bg_' . $col_count ]    = isset( $new_instance[ 'package_badge_bg_' . $col_count ] ) ? esc_attr( $new_instance[ 'package_badge_bg_' . $col_count ] ) : '#b50101';
			$instance[ 'package_name_' . $col_count ]        = sanitize_text_field( $new_instance[ 'package_name_' . $col_count ] );
			$instance[ 'package_price_' . $col_count ]       = sanitize_text_field( $new_instance[ 'package_price_' . $col_count ] );
			$instance[ 'package_desc_' . $col_count ]        = sanitize_text_field( $new_instance[ 'package_desc_' . $col_count ] );
			$instance[ 'package_subtitle_' . $col_count ]    = sanitize_text_field( $new_instance[ 'package_subtitle_' . $col_count ] );
			$instance[ 'package_feature_num_' . $col_count ] = isset( $new_instance[ 'package_feature_num_' . $col_count ] ) ? absint( $new_instance[ 'package_feature_num_' . $col_count ] ) : 4;
			$instance[ 'package_btn_txt_' . $col_count ]     = sanitize_text_field( $new_instance[ 'package_btn_txt_' . $col_count ] );
			$instance[ 'package_btn_url_' . $col_count ]     = esc_url_raw( $new_instance[ 'package_btn_url_' . $col_count ] );
			$instance[ 'package_color_' . $col_count ]       = isset( $new_instance[ 'package_color_' . $col_count ] ) ? esc_attr( $new_instance[ 'package_color_' . $col_count ] ) : '#79cc8c';
			$col_features                                    = 'package_features_' . $col_count;
			$instance[ $col_features ]                       = array();
			if ( isset( $new_instance[ $col_features ] ) ) {
				foreach ( $new_instance[ $col_features ] as $feature ) {
					$instance[ $col_features ][] = sanitize_text_field( $feature );
				}
			}
		}
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance );
		$text  = isset( $instance['text'] ) ? $instance['text'] : '';
		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) && ! empty( $text ) ) {
			icl_register_string( 'Accelerate Pro', 'TG: Pricing Table widget description text' . $this->id, $text );
		}
		$col_num       = empty( $instance['col_num'] ) ? '3' : $instance['col_num'];
		$badge         = array();
		$badge_bg      = array();
		$packages      = array();
		$prices        = array();
		$package_descs = array();
		$subtitles     = array();
		$feature_num   = array();
		$features      = array();
		$btn_text      = array();
		$btn_URL       = array();
		$colors        = array();
		for ( $col_count = 0; $col_count < $col_num; $col_count ++ ) {
			$badge[]         = isset( $instance[ 'package_badge_' . $col_count ] ) ? $instance[ 'package_badge_' . $col_count ] : '';
			$badge_bg[]      = isset( $instance[ 'package_badge_bg_' . $col_count ] ) ? $instance[ 'package_badge_bg_' . $col_count ] : '';
			$packages[]      = isset( $instance[ 'package_name_' . $col_count ] ) ? $instance[ 'package_name_' . $col_count ] : '';
			$prices[]        = isset( $instance[ 'package_price_' . $col_count ] ) ? $instance[ 'package_price_' . $col_count ] : '';
			$package_descs[] = isset( $instance[ 'package_desc_' . $col_count ] ) ? $instance[ 'package_desc_' . $col_count ] : '';
			$subtitles[]     = isset( $instance[ 'package_subtitle_' . $col_count ] ) ? $instance[ 'package_subtitle_' . $col_count ] : '';
			$feature_num[]   = isset( $instance[ 'package_feature_num_' . $col_count ] ) ? $instance[ 'package_feature_num_' . $col_count ] : '';
			$btn_text[]      = isset( $instance[ 'package_btn_txt_' . $col_count ] ) ? $instance[ 'package_btn_txt_' . $col_count ] : '';
			$btn_URL[]       = isset( $instance[ 'package_btn_url_' . $col_count ] ) ? $instance[ 'package_btn_url_' . $col_count ] : '';
			$colors[]        = isset( $instance[ 'package_color_' . $col_count ] ) ? $instance[ 'package_color_' . $col_count ] : '';
			$features[]      = isset( $instance[ 'package_features_' . $col_count ] ) ? $instance[ 'package_features_' . $col_count ] : '';

			// For WPML plugin compatibility
			if ( function_exists( 'icl_register_string' ) && ! empty( $packages ) ) {
				icl_register_string( 'Accelerate Pro', 'TG: Pricing Table Package Title' . $this->id . $col_count, $packages[ $col_count ] );
				if ( ! empty( $prices ) ) {
					icl_register_string( 'Accelerate Pro', 'TG: Pricing Table Package Price' . $this->id . $col_count, $prices[ $col_count ] );
				}
				if ( ! empty( $package_descs ) ) {
					icl_register_string( 'Accelerate Pro', 'TG: Pricing Table Package Description' . $this->id . $col_count, $package_descs[ $col_count ] );
				}
				if ( ! empty( $subtitles ) ) {
					icl_register_string( 'Accelerate Pro', 'TG: Pricing Table Package Sub Title' . $this->id . $col_count, $subtitles[ $col_count ] );
				}
				if ( ! empty( $badge ) ) {
					icl_register_string( 'Accelerate Pro', 'TG: Pricing Table Package Badge' . $this->id . $col_count, $badge[ $col_count ] );
				}
				if ( ! empty( $btn_text ) ) {
					icl_register_string( 'Accelerate Pro', 'TG: Pricing Table Package Button Text' . $this->id . $col_count, $btn_text[ $col_count ] );
				}
				if ( ! empty( $features ) ) {
					foreach ( $features[ $col_count ] as $key => $value ) {
						icl_register_string( 'Accelerate Pro', 'TG: Pricing Table Table Features' . $this->id . $col_count . $key, $value );
					}
				}
			}
		}
		echo $before_widget; ?>

		<div class="section-wrapper">

			<div class="tg-container pricing-table pricing-column-<?php echo esc_attr( $col_num ); ?> clearfix">
				<?php if ( ! empty( $title ) ) : ?>
					<h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>

				<?php if ( ! empty( $text ) ) : ?>
					<p><?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							$text = icl_t( 'Accelerate Pro', 'TG: Pricing Table widget description text' . $this->id, $text );
						}
						echo esc_textarea( $text ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $packages ) ) : ?>

					<?php for ( $col_count = 0; $col_count < $col_num; $col_count ++ ) :
						$item = $col_count + 1;
						$column_class = '';
						if ( $col_num == 2 ) :
							if ( $item % 2 == 0 ) {
								$column_class = 'tg-one-half tg-one-half-last';
							} else {
								$column_class = 'tg-one-half';
							}
						elseif ( $col_num == 3 ) :
							if ( $item % 3 == 0 ) {
								$column_class = "tg-one-third tg-one-third-last";
							} else {
								$column_class = "tg-one-third";
							}
						elseif ( $col_num == 4 ) :
							if ( $item % 4 == 0 ) {
								$column_class = 'tg-one-fourth tg-one-fourth-last';
							} else {
								$column_class = 'tg-one-fourth';
							}
						endif;
						?>
						<div class="<?php echo esc_attr( $column_class ) ?>">

							<?php if ( $packages[ $col_count ] != '' ) : ?>
								<div class="pricing-table-wrapper-<?php echo absint( $col_count ); ?> pricing-table-wrapper">
									<?php if ( $badge[ $col_count ] ) :
										// For WPML plugin compatibility
										if ( function_exists( 'icl_t' ) ) {
											$badge[ $col_count ] = icl_t( 'Accelerate Pro', 'TG: Pricing Table Package Badge' . $this->id . $col_count, $badge[ $col_count ] );
										} ?>
										<span class="pricing-as-popular" style="background: <?php echo esc_attr( $badge_bg[ $col_count ] ); ?>"><?php echo esc_html( $badge[ $col_count ] ); ?></span>
									<?php endif; ?>

									<?php // For WPML plugin compatibility
									if ( function_exists( 'icl_t' ) ) {
										$packages[ $col_count ] = icl_t( 'Accelerate Pro', 'TG: Pricing Table Package Name' . $this->id . $col_count, $packages[ $col_count ] );
									} ?>
									<?php if ( ! empty( $packages[ $col_count ] ) ) : ?>
										<h4 class="pricing-title" style="background: <?php echo esc_attr( $colors[ $col_count ] ); ?>"><?php echo esc_html( $packages[ $col_count ] ); ?></h4>
									<?php endif; ?>

									<?php // For WPML plugin compatibility
									if ( function_exists( 'icl_t' ) ) {
										$prices[ $col_count ]        = icl_t( 'Accelerate Pro', 'TG: Pricing Table Package Price' . $this->id . $col_count, $prices[ $col_count ] );
										$package_descs[ $col_count ] = icl_t( 'Accelerate Pro', 'TG: Pricing Table Package Description' . $this->id . $col_count, $package_descs[ $col_count ] );

									} ?>

									<?php if ( ! empty( $subtitles[ $col_count ] ) || ! empty( $prices[ $col_count ] ) || ! empty( $package_descs[ $col_count ] ) ) : ?>
										<?php // For WPML plugin compatibility
										if ( function_exists( 'icl_t' ) ) {
											$subtitles[ $col_count ] = icl_t( 'Accelerate Pro', 'TG: Pricing Table Package Sub Title' . $this->id . $col_count, $subtitles[ $col_count ] );
										}
										?>
										<div class="pricing-price">
											<?php if ( $prices[ $col_count ] != '' ) : ?>
												<span class="pricing-currnecy"><?php echo esc_html( $prices[ $col_count ] ); ?></span>
											<?php endif; ?>
											<?php if ( $package_descs[ $col_count ] != '' ) : ?>
												<span class="pricing-date"><?php echo esc_html( $package_descs[ $col_count ] ); ?></span>
											<?php endif; ?>
											<?php if ( $subtitles[ $col_count ] != '' ) : ?>
												<span class="pricing-subtitle" style="color: <?php echo esc_attr( $colors[ $col_count ] ); ?>"><?php echo esc_html( $subtitles[ $col_count ] ); ?></span>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<?php if ( ! empty( $feature_num ) ) : ?>
										<ul class="pricing-list-wrapper">

											<?php if ( ! empty( $features[ $col_count ] ) ) :
												foreach ( $features[ $col_count ] as $key => $value ) {
													if ( $value != '' ) {
														// For WPML plugin compatibility
														if ( function_exists( 'icl_t' ) ) {
															$value = icl_t( 'Accelerate Pro', 'TG: Pricing Table Table Features' . $this->id . $col_count . $key, $value );
														}
														echo '<li class="pricing-list">' . esc_html( $value ) . '</li>';
													}
												}
											endif; ?>
										</ul>
									<?php endif; ?>

									<?php // For WPML plugin compatibility
									if ( function_exists( 'icl_t' ) ) {
										$btn_text[ $col_count ] = icl_t( 'Accelerate Pro', 'TG: Pricing Table Package Button Text' . $this->id . $col_count, $btn_text[ $col_count ] );
									} ?>

									<?php if ( ! empty( $btn_text[ $col_count ] ) ) : ?>
										<div class="pricing-btn">
											<a href="<?php echo esc_url( $btn_URL[ $col_count ] ); ?>" style="background: <?php echo esc_attr( $colors[ $col_count ] ); ?>"><?php echo esc_html( $btn_text[ $col_count ] ); ?></a>
										</div>
									<?php endif; ?>
								</div><!-- pricing-table-wrapper -->
								<?php $item ++; endif; ?>
						</div> <!-- end of column -->
					<?php endfor; ?>
				<?php endif; ?>
			</div>
		</div>

		<?php echo $after_widget;
	}
}

