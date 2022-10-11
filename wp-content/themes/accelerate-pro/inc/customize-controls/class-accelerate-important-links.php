<?php
/**
 * Extend WP_Customize_Control for theme important links.
 *
 * Class Accelerate_Important_Links
 *
 * @since 2.2.5
 */
// Theme important links started
class Accelerate_Important_Links extends WP_Customize_Control {

	public $type = 'accelerate-important-links';

	public function render_content() {
		//Add Theme instruction, Support Forum, Demo Link, Rating Link
		$important_links = array(
			'support'       => array(
				'link' => esc_url( 'https://themegrill.com/contact/' ),
				'text' => __( 'Support Forum', 'accelerate' ),
			),
			'documentation' => array(
				'link' => esc_url( 'https://docs.themegrill.com/accelerate/' ),
				'text' => __( 'Documentation', 'accelerate' ),
			),
			'demo'          => array(
				'link' => esc_url( 'https://themegrilldemos.com/accelerate-pro/' ),
				'text' => __( 'View Demo', 'accelerate' ),
			),
		);
		foreach ( $important_links as $important_link ) {
			echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr( $important_link['text'] ) . ' </a></p>';
		}
	}

}
