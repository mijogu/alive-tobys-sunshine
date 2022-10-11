<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package ThemeGrill
 * @subpackage Accelerate Pro
 * @since Accelerate Pro 2.1.4
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function accelerate_jetpack_setup() {
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

   // Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'accelerate_style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tag-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'accelerate_jetpack_setup' );
