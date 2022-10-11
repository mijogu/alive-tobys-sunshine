<?php
/**
 * Extend WP_Customize_Control for additional social icons control.
 *
 * Class Accelerate_Additional_Social_Icons_Control
 *
 * @since 2.2.5
 */
// Additional Social Icons setting
class Accelerate_Additional_Social_Icons_Control extends WP_Customize_Control {

	public $type = 'accelerate-additional-social-icons';

	public function render_content() {
		_e( 'Add Font Awesome icon name. Example: whatsapp. You can find list <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'accelerate' );
		?>
		<input type="text" value="<?php echo sanitize_text_field( $this->value() ); ?>" <?php $this->link(); ?>>
	<?php }

}
