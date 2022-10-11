<?php
/**
 * Display the Post Format.
 *
 * @package    ThemeGrill
 * @subpackage Accelerate Pro
 * @since      Accelerate Pro 1.0
 */
?>

<?php if ( has_post_format( 'image' ) ) :

	if ( has_post_thumbnail() ) {
		$image           = '';
		$title_attribute = the_title_attribute( 'echo=0' );
		$image           .= '<figure class="post-featured-image">';
		$image           .= get_the_post_thumbnail( $post->ID, 'featured-blog-large', array(
			'title' => $title_attribute,
			'alt'   => $title_attribute,
		) );
		$image           .= '</figure>';

		echo $image;
	}
endif;
?>
