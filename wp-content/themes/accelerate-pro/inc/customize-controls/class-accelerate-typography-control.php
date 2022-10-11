<?php
/**
 * Extend WP_Customize_Control to include accelerate typography options.
 *
 * Class Accelerate_Typography_Control
 *
 * @since 2.2.5
 */

// Extending `WP_Customize_Control` to include accelerate typography options.
class Accelerate_Typography_Control extends WP_Customize_Control {

	// Assign the type of control to be rendered.
	public $type = 'accelerate-typography-options';

	/**
	 * Function to display typography select options in customize options.
	 */
	public function render_content() {
		$this_value = $this->value();
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

		<select class="accelerate-typography-select" <?php $this->link(); ?>>

			<?php
			// Get Standard font options
			if ( $std_fonts = accelerate_standard_fonts_array() ) { ?>
				<optgroup label="<?php esc_attr_e( 'Standard Fonts', 'accelerate' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $std_fonts as $font => $value ) { ?>
						<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php } ?>
				</optgroup>
			<?php }
			?>

			<?php
			// Google font options
			if ( $google_fonts = accelerate_google_fonts() ) { ?>
				<optgroup label="<?php esc_attr_e( 'Google Fonts', 'accelerate' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $google_fonts as $font => $value ) { ?>
						<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php } ?>
				</optgroup>
			<?php } ?>

		</select>

		<?php
	}
}
