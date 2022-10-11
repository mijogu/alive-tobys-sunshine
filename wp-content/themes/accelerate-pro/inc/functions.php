<?php
/**
 * Accelerate functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package    ThemeGrill
 * @subpackage Accelerate Pro
 * @since      Accelerate Pro 1.0
 */

/****************************************************************************************/

// Accelerate theme options
function accelerate_options( $id, $default = false ) {
	// getting options value
	$accelerate_options = get_option( 'accelerate' );
	if ( isset( $accelerate_options[ $id ] ) ) {
		return $accelerate_options[ $id ];
	} else {
		return $default;
	}
}

/****************************************************************************************/

add_action( 'wp_enqueue_scripts', 'accelerate_scripts_styles_method' );
/**
 * Register jquery scripts
 */
function accelerate_scripts_styles_method() {
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	/**
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'accelerate_style', get_stylesheet_uri() );

	$accelerate_googlefonts = array();
	array_push( $accelerate_googlefonts, accelerate_options( 'accelerate_site_title_font', 'Roboto+Slab:700,400' ) );
	array_push( $accelerate_googlefonts, accelerate_options( 'accelerate_site_tagline_font', 'Roboto+Slab:700,400' ) );
	array_push( $accelerate_googlefonts, accelerate_options( 'accelerate_primary_menu_font', 'Roboto:400,300,100' ) );
	array_push( $accelerate_googlefonts, accelerate_options( 'accelerate_header_menu_font', 'Roboto:400,300,100' ) );
	array_push( $accelerate_googlefonts, accelerate_options( 'accelerate_titles_font', 'Roboto+Slab:700,400' ) );
	array_push( $accelerate_googlefonts, accelerate_options( 'accelerate_content_font', 'Roboto:400,300,100' ) );

	// Assign required fonts from database in array and make it unique.
	$accelerate_googlefonts          = array_unique( $accelerate_googlefonts );
	$accelerate_google_fonts         = accelerate_google_fonts();
	$accelerate_standard_fonts_array = accelerate_standard_fonts_array();

	// Check for the Google Fonts arrays.
	foreach ( $accelerate_googlefonts as $accelerate_googlefont ) {

		// If the array_key_exists for currently selected fonts,
		// then only proceed to create new array to include,
		// only the required Google fonts.
		// For Standard fonts, no need for loading up the Google Fonts array.
		if ( array_key_exists( $accelerate_googlefont, $accelerate_google_fonts ) ) {
			$accelerate_googlefont_lists[] = $accelerate_googlefont;
		}

	}

	// Check for the Standard Fonts arrays.
	foreach ( $accelerate_googlefonts as $accelerate_standard_font ) {

		// If the array_key_exists for currently selected fonts,
		// then only proceed to create new array to include,
		// only the required Standard fonts,
		// in order to enqueue to Google Fonts only when,
		// no theme_mods data is altered.
		if ( array_key_exists( $accelerate_standard_font, $accelerate_standard_fonts_array ) ) {
			$accelerate_standard_font_lists[] = $accelerate_standard_font;
		}

	}

	// Proceed only if the Google Fonts array is available,
	// to enqueue the Google Fonts.
	if ( isset( $accelerate_googlefont_lists ) ) :

		$accelerate_googlefont_lists = implode( "|", $accelerate_googlefont_lists );

		wp_register_style( 'accelerate_googlefonts', '//fonts.googleapis.com/css?family=' . $accelerate_googlefont_lists . '&display=swap' );
		wp_enqueue_style( 'accelerate_googlefonts' );

	// Proceed only if the theme is installed first time,
	// or the theme_mods data for typography is not changed.
	elseif ( ! isset( $accelerate_standard_font_lists ) ) :

		$accelerate_googlefonts = implode( "|", $accelerate_googlefonts );

		wp_register_style( 'accelerate_googlefonts', '//fonts.googleapis.com/css?family=' . $accelerate_googlefonts . '&display=swap' );
		wp_enqueue_style( 'accelerate_googlefonts' );

	endif;

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Register JQuery cycle js file for slider.
	 */
	wp_register_script( 'jquery_cycle', ACCELERATE_JS_URL . '/jquery.cycle2' . $suffix . '.js', array( 'jquery' ), '2.1.6', true );
	wp_register_script( 'jquery-cycle2-swipe', ACCELERATE_JS_URL . '/jquery.cycle2.swipe' . $suffix . '.js', array( 'jquery' ), false, true );

	/**
	 * Enqueue Slider setup js file.
	 */
	if ( accelerate_options( 'accelerate_activate_slider', '0' ) == '1' ) {
		if ( ( accelerate_options( 'accelerate_slider_status', 'front_page' ) == 'all_page' ) || ( is_front_page() && accelerate_options( 'accelerate_slider_status', 'front_page' ) == 'front_page' ) ) {
			wp_enqueue_script( 'jquery_cycle' );
			wp_enqueue_script( 'jquery-cycle2-swipe' );
		}
	}

	// Sticky menu.
	If ( accelerate_options( 'accelerate_sticky_menu_option', 0 ) == 1 ) {
		wp_enqueue_script( 'jquery-sticky', ACCELERATE_JS_URL . '/jquery.sticky' . $suffix . '.js', array( 'jquery' ), false, true );
	}

	// Masonry JS.
	if ( ( ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) == 'masonry_image' ) || ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) == 'masonry_image' ) ) && ( is_home() || is_archive() || is_search() ) ) {
		wp_enqueue_script( 'masonry' );
	}

	// Waypoints Script
	wp_enqueue_script( 'waypoints', ACCELERATE_JS_URL . '/waypoints' . $suffix . '.js', array( 'jquery' ), '2.0.3', true );

	// CounterUp Script
	wp_enqueue_script( 'counterup', ACCELERATE_JS_URL . '/jquery.counterup' . $suffix . '.js', array( 'jquery' ), false, true );

	wp_enqueue_script( 'accelerate-navigation', ACCELERATE_JS_URL . '/navigation' . $suffix . '.js', array( 'jquery' ), false, true );

	// Skip link focus fix JS enqueue.
	wp_enqueue_script( 'accelerate-skip-link-focus-fix', ACCELERATE_JS_URL . '/skip-link-focus-fix.js', array(), false, true );

	wp_enqueue_script( 'accelerate-custom', ACCELERATE_JS_URL . '/accelerate-custom' . $suffix . '.js', array( 'jquery' ), false, true );

	wp_enqueue_style( 'accelerate-fontawesome', get_template_directory_uri() . '/fontawesome/css/font-awesome' . $suffix . '.css', array(), '4.7.0' );

	wp_enqueue_script( 'html5shiv', ACCELERATE_JS_URL . '/html5shiv.js', array(), '3.7.3', false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lte IE 8' );

	// Theia Sticky Sidebar enqueue
	if ( accelerate_options( 'accelerate_sticky_content_sidebar', '0' ) == '1' ) {
		wp_enqueue_script( 'theia-sticky-sidebar', ACCELERATE_JS_URL . '/theia-sticky-sidebar/theia-sticky-sidebar' . $suffix . '.js', array( 'jquery' ), '1.7.0', true );
		wp_enqueue_script( 'ResizeSensor', ACCELERATE_JS_URL . '/theia-sticky-sidebar/ResizeSensor' . $suffix . '.js', array( 'jquery' ), false, true );
	}


}

function accelerate_block_editor_styles() {
	wp_enqueue_style( 'accelerate-editor-googlefonts', '//fonts.googleapis.com/css?family=Roboto:400,300,100|Roboto+Slab:700,400&display=swap' );
	wp_enqueue_style( 'accelerate-block-editor-styles', get_template_directory_uri() . '/style-editor-block.css' );
}

add_action( 'enqueue_block_editor_assets', 'accelerate_block_editor_styles', 1, 1 );

/****************************************************************************************/
/**
 * Add admin scripts and styles.
 */

function accelerate_admin_scripts( $hook ) {
	global $post_type;
	if ( $hook == 'widgets.php' || $hook == 'customize.php' ) {
		wp_enqueue_media();
		// For color
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'accelerate-color-picker', ACCELERATE_JS_URL . '/color-picker.js', array( 'jquery' ), false, true );

	}
}

add_action( 'admin_enqueue_scripts', 'accelerate_admin_scripts' );

/****************************************************************************************/

add_filter( 'excerpt_length', 'accelerate_excerpt_length' );
/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function accelerate_excerpt_length( $length ) {
	$excerpt_length = accelerate_options( 'accelerate_excerpt_length', '40' );

	return $excerpt_length;
}

add_filter( 'excerpt_more', 'accelerate_read_more' );
/**
 * Returns a "Read more" link for excerpts
 */
function accelerate_read_more() {
	return '';
}

/****************************************************************************************/

/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be medium from thumbnail to be used in WordPress gallery as a default size
 */
function accelerate_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	$out['size'] = $atts['size'];

	return $out;

}

add_filter( 'shortcode_atts_gallery', 'accelerate_gallery_atts', 10, 3 );

add_filter( 'post_class', 'accelerate_post_class' );
/**
 * Filter post class
 *
 * throwing different post class for the different column option.
 **/
function accelerate_post_class( $classes ) {
	$classes[] = '';

	if ( is_archive() || is_search() ) {
		if ( accelerate_options( 'accelerate_archive_blog_column_option', '2' ) == '2' ) {
			$classes[] = 'tg-column-two';
		} elseif ( accelerate_options( 'accelerate_archive_blog_column_option', '2' ) == '3' ) {
			$classes[] = 'tg-column-third';
		}
	} else {
		if ( accelerate_options( 'accelerate_blog_column_option', '2' ) == '2' ) {
			$classes[] = 'tg-column-two';
		} elseif ( accelerate_options( 'accelerate_blog_column_option', '2' ) == '3' ) {
			$classes[] = 'tg-column-third';
		}
	}

	return $classes;
}

/****************************************************************************************/

add_filter( 'body_class', 'accelerate_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function accelerate_body_class( $classes ) {
	global $post;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'accelerate_page_layout', true );
	}

	if ( is_home() ) {
		$queried_id  = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'accelerate_page_layout', true );
	}
	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}
	$accelerate_default_layout = accelerate_options( 'accelerate_default_layout', 'right_sidebar' );

	$accelerate_default_page_layout = accelerate_options( 'accelerate_pages_default_layout', 'right_sidebar' );
	$accelerate_default_post_layout = accelerate_options( 'accelerate_single_posts_default_layout', 'right_sidebar' );
	$woocommerce_widgets_enabled    = accelerate_options( 'accelerate_woocommerce_sidebar_register_setting', 0 );

	// Proceed only if WooCommerce extra widget option is not enabled as well as
	// Proceed only if WooCommerce is enabled and not in WooCommerce pages.
	if ( ( $woocommerce_widgets_enabled == 0 ) || ( ( $woocommerce_widgets_enabled == 1 ) && ( function_exists( 'is_woocommerce' ) && ( ! is_woocommerce() ) ) ) ) :
		if ( $layout_meta == 'default_layout' ) {
			if ( is_page() ) {
				if ( $accelerate_default_page_layout == 'right_sidebar' ) {
					$classes[] = '';
				} elseif ( $accelerate_default_page_layout == 'left_sidebar' ) {
					$classes[] = 'left-sidebar';
				} elseif ( $accelerate_default_page_layout == 'no_sidebar_full_width' ) {
					$classes[] = 'no-sidebar-full-width';
				} elseif ( $accelerate_default_page_layout == 'no_sidebar_content_centered' ) {
					$classes[] = 'no-sidebar';
				}
			} elseif ( is_single() ) {
				if ( $accelerate_default_post_layout == 'right_sidebar' ) {
					$classes[] = '';
				} elseif ( $accelerate_default_post_layout == 'left_sidebar' ) {
					$classes[] = 'left-sidebar';
				} elseif ( $accelerate_default_post_layout == 'no_sidebar_full_width' ) {
					$classes[] = 'no-sidebar-full-width';
				} elseif ( $accelerate_default_post_layout == 'no_sidebar_content_centered' ) {
					$classes[] = 'no-sidebar';
				}
			} elseif ( $accelerate_default_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $accelerate_default_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $accelerate_default_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $accelerate_default_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			}
		} elseif ( $layout_meta == 'right_sidebar' ) {
			$classes[] = '';
		} elseif ( $layout_meta == 'left_sidebar' ) {
			$classes[] = 'left-sidebar';
		} elseif ( $layout_meta == 'no_sidebar_full_width' ) {
			$classes[] = 'no-sidebar-full-width';
		} elseif ( $layout_meta == 'no_sidebar_content_centered' ) {
			$classes[] = 'no-sidebar';
		}
	endif;

	if ( accelerate_options( 'accelerate_new_menu', '1' ) == '1' ) {
		$classes[] = 'better-responsive-menu';
	}
	if ( ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) === 'small_image' && is_home() ) || ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) === 'small_image' && ! is_home() ) ) {
		$classes[] = 'blog-small';
	}
	if ( ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) === 'small_image_alternate' && is_home() ) || ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) === 'small_image_alternate' && ! is_home() ) ) {
		$classes[] = 'blog-alternate-small';
	}

	if ( ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) === 'grid_image' && is_home() ) || ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) === 'grid_image' ) && ( is_archive() || is_search() ) ) {
		$classes[] = 'blog-grid';
	}

	if ( ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) === 'masonry_image' && is_home() ) || ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) === 'masonry_image' ) && ( is_archive() || is_search() ) ) {
		$classes[] = 'blog-masonry';
	}

	if ( accelerate_options( 'accelerate_site_layout', 'wide' ) === 'wide' ) {
		$classes[] = 'wide';
	} elseif ( accelerate_options( 'accelerate_site_layout', 'wide' ) === 'box' ) {
		$classes[] = '';
	}

	// For background image clickable.
	$background_image_url_link = accelerate_options( 'accelerate_background_image_link' );
	if ( $background_image_url_link ) {
		$classes[] = 'clickable-background-image';
	}

	return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'accelerate_sidebar_select' ) ) :
	/**
	 * Fucntion to select the sidebar
	 */
	function accelerate_sidebar_select() {
		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'accelerate_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'accelerate_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}
		$accelerate_default_layout = accelerate_options( 'accelerate_default_layout', 'right_sidebar' );

		$accelerate_default_page_layout = accelerate_options( 'accelerate_pages_default_layout', 'right_sidebar' );
		$accelerate_default_post_layout = accelerate_options( 'accelerate_single_posts_default_layout', 'right_sidebar' );

		if ( $layout_meta == 'default_layout' ) {
			if ( is_page() ) {
				if ( $accelerate_default_page_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $accelerate_default_page_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			}
			if ( is_single() ) {
				if ( $accelerate_default_post_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $accelerate_default_post_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( $accelerate_default_layout == 'right_sidebar' ) {
				get_sidebar();
			} elseif ( $accelerate_default_layout == 'left_sidebar' ) {
				get_sidebar( 'left' );
			}
		} elseif ( $layout_meta == 'right_sidebar' ) {
			get_sidebar();
		} elseif ( $layout_meta == 'left_sidebar' ) {
			get_sidebar( 'left' );
		}
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'accelerate_posts_listing_display_type_select' ) ) :
	/**
	 * Function to select the posts listing display type
	 */
	function accelerate_posts_listing_display_type_select() {
		if ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) == 'large_image' ) {
			$format = 'blog-large-image';
		} elseif ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) == 'small_image' ) {
			$format = 'blog-small-image';
		} elseif ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) == 'small_image_alternate' ) {
			$format = 'blog-small-image';
		} elseif ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) == 'grid_image' ) {
			$format = 'blog-grid-image';
		} elseif ( accelerate_options( 'accelerate_posts_page_display_type', 'large_image' ) == 'masonry_image' ) {
			$format = 'blog-masonry-image';
		} else {
			$format = get_post_format();
		}

		return $format;
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'accelerate_archive_display_type_select' ) ) :
	/**
	 * Function to select the archive page posts listing display type
	 */
	function accelerate_archive_display_type_select() {
		if ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) == 'large_image' ) {
			$format = 'blog-large-image';
		} elseif ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) == 'small_image' ) {
			$format = 'blog-small-image';
		} elseif ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) == 'small_image_alternate' ) {
			$format = 'blog-small-image';
		} elseif ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) == 'grid_image' ) {
			$format = 'blog-grid-image';
		} elseif ( accelerate_options( 'accelerate_archive_display_type', 'large_image' ) == 'masonry_image' ) {
			$format = 'blog-masonry-image';
		} else {
			$format = get_post_format();
		}

		return $format;
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'accelerate_entry_meta' ) ) :
	function accelerate_entry_meta() {
		echo '<div class="entry-meta">';
		?>
		<span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
		<?php

		$categories_list = get_the_category_list( __( ', ', 'accelerate' ) );
		if ( $categories_list ) {
			printf( __( '<span class="cat-links"><i class="fa fa-folder-open"></i>%1$s</span>', 'accelerate' ), $categories_list );
		}

		$post_format_icon = '';
		if ( 'gallery' == get_post_format() ) {
			$post_format_icon = 'fa-picture-o';
		} elseif ( 'video' == get_post_format() ) {
			$post_format_icon = 'fa-youtube-play';
		} elseif ( 'quote' == get_post_format() ) {
			$post_format_icon = 'fa-quote-left';
		} elseif ( 'link' == get_post_format() ) {
			$post_format_icon = 'fa-link';
		} elseif ( 'image' == get_post_format() ) {
			$post_format_icon = 'fa-picture-o';
		} elseif ( 'audio' == get_post_format() ) {
			$post_format_icon = 'fa-volume-up';
		} elseif ( 'aside' == get_post_format() ) {
			$post_format_icon = 'fa-dot-circle-o';
		} elseif ( 'chat' == get_post_format() ) {
			$post_format_icon = 'fa-comments-o';
		} elseif ( 'status' == get_post_format() ) {
			$post_format_icon = 'fa-pencil';
		}

		if ( is_sticky() ) {
			$post_format_icon = 'fa-paperclip';
		}
		?>

		<span class="sep"><span class="post-format"><i class="fa <?php echo $post_format_icon; ?>"></i></span></span>

		<?php
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'accelerate' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string
		);

		$tags_list = get_the_tag_list( '<span class="tag-links"><i class="fa fa-tags"></i>', __( ', ', 'accelerate' ), '</span>' );
		if ( $tags_list ) {
			echo $tags_list;
		}

		if ( ! post_password_required() && comments_open() ) { ?>
			<span class="comments-link"><?php comments_popup_link( __( '<i class="fa fa-comment"></i> 0 Comment', 'accelerate' ), __( '<i class="fa fa-comment"></i> 1 Comment', 'accelerate' ), __( '<i class="fa fa-comments"></i> % Comments', 'accelerate' ) ); ?></span>
		<?php }

		edit_post_link( __( 'Edit', 'accelerate' ), '<span class="edit-link"><i class="fa fa-edit"></i>', '</span>' );

		echo '</div>';
	}
endif;

/****************************************************************************************/
if ( ! function_exists( 'accelerate_darkcolor' ) ) :
	/**
	 * Generate darker color
	 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
	 */
	function accelerate_darkcolor( $hex, $steps ) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( -255, min( 255, $steps ) );

		// Normalize into a six character long hex string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Split into three parts: R, G and B
		$color_parts = str_split( $hex, 2 );
		$return      = '#';

		foreach ( $color_parts as $color ) {
			$color  = hexdec( $color ); // Convert to decimal
			$color  = max( 0, min( 255, $color + $steps ) ); // Adjust color
			$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
		}

		return $return;
	}
endif;

/****************************************************************************************/

add_action( 'wp_head', 'accelerate_custom_css', 100 );
/**
 * Hooks the Custom Internal CSS to head section
 */
function accelerate_custom_css() {
	$accelerate_internal_css = '';

	if ( accelerate_options( 'accelerate_header_display_type', 'one' ) == 'two' ) {
		$accelerate_internal_css .= ' #header-left-section{float:right;margin-right:0}#header-logo-image{padding-left:20px}#header-text{padding-right:0}#header-right-section{float:left}#header-right-section .widget{text-align:left}@media screen and (max-width:768px){#header-left-section,#header-right-section{float:none}#header-right-section .widget{text-align:center}}' . "\n";
	} elseif ( accelerate_options( 'accelerate_header_display_type', 'one' ) == 'three' ) {
		$accelerate_internal_css .= ' #header-text-nav-wrap{padding:15px 0}#header-left-section{float:none;max-width:100%;margin-right:0}#header-logo-image{float:none;text-align:center;margin-bottom:10px}#header-text{float:none;text-align:center;padding:0;margin-bottom:10px}#site-description{padding-bottom:5px}#header-right-section{float:none;max-width:100%}#header-right-section .widget{padding:0 0 10px;float:none;text-align:center}' . "\n";
	} else {
		$accelerate_internal_css .= '';
	}

	if ( accelerate_options( 'accelerate_menu_display_type', 'one' ) == 'two' ) {
		$accelerate_internal_css .= ' .main-navigation{text-align:center}.main-navigation a,.main-navigation li{display:inline-block;float:none}.main-navigation ul li ul li:last-child{float:left}.main-navigation ul li ul li{float:left;text-align:left}.main-navigation ul li ul li a,.main-navigation ul li ul li.current-menu-item a,.main-navigation ul li.current-menu-ancestor ul li a,.main-navigation ul li.current-menu-item ul li a,.main-navigation ul li.current_page_ancestor ul li a,.main-navigation ul li.current_page_item ul li a{width:172px}' . "\n";
	} elseif ( accelerate_options( 'accelerate_menu_display_type', 'one' ) == 'three' ) {
		$accelerate_internal_css .= ' .menu-primary-container{float:right}.main-navigation ul li ul li ul{right:200px;left:auto}' . "\n";
	} else {
		$accelerate_internal_css .= '';
	}

	if ( accelerate_options( 'accelerate_top_bar_display_type', 'one' ) == 'two' ) {
		$accelerate_internal_css .= ' .social-links{float:right;padding-left:15px;padding-right:0}.small-menu{float:left}.small-menu li:last-child a{padding-right:12px}.small-menu ul li ul li ul{left:150px;right:auto}@media screen and (max-width:768px){.top-menu-toggle{left:12px;position:absolute;right:auto}}' . "\n";
	} else {
		$accelerate_internal_css .= '';
	}

	$primary_color = accelerate_options( 'accelerate_primary_color', '#77cc6d' );
	$primary_dark  = accelerate_darkcolor( $primary_color, -50 );
	if ( $primary_color != '#77cc6d' ) {
		$accelerate_internal_css .= ' .accelerate-button,blockquote,button,input[type=button],input[type=reset],input[type=submit]{background-color:' . $primary_color . '}#site-title a:hover,.next a:hover,.previous a:hover,a{color:' . $primary_color . '}#search-form span,.main-navigation a:hover,.main-navigation ul li ul li a:hover,.main-navigation ul li ul li:hover>a,.main-navigation ul li.current-menu-ancestor a,.main-navigation ul li.current-menu-item a,.main-navigation ul li.current-menu-item ul li a:hover,.main-navigation ul li.current_page_ancestor a,.main-navigation ul li.current_page_item a,.main-navigation ul li:hover>a,.main-small-navigation li:hover > a,.main-navigation ul ul.sub-menu li.current-menu-ancestor> a,.main-navigation ul li.current-menu-ancestor li.current_page_item> a{background-color:' . $primary_color . '}.site-header .menu-toggle:before{color:' . $primary_color . '}.main-small-navigation li a:hover,.widget_team_block .more-link{background-color:' . $primary_color . '}.main-small-navigation .current-menu-item a,.main-small-navigation .current_page_item a,.team-title::b {background:' . $primary_color . '}.footer-menu a:hover,.footer-menu ul li.current-menu-ancestor a,.footer-menu ul li.current-menu-item a,.footer-menu ul li.current_page_ancestor a,.footer-menu ul li.current_page_item a,.footer-menu ul li:hover>a,.widget_team_block .team-title:hover>a{color:' . $primary_color . '}a.slide-prev,a.slide-next,.slider-title-head .entry-title a{background-color:' . $primary_color . '}#controllers a.active,#controllers a:hover,.widget_team_block .team-social-icon a:hover{background-color:' . $primary_color . ';color:' . $primary_color . '}.format-link .entry-content a{background-color:' . $primary_color . '}.tg-one-fourth .widget-title a:hover,.tg-one-half .widget-title a:hover,.tg-one-third .widget-title a:hover,.widget_featured_posts .tg-one-half .entry-title a:hover,.widget_image_service_block .entry-title a:hover,.widget_service_block i.fa,.widget_fun_facts .counter-icon i{color:' . $primary_color . '}#content .wp-pagenavi .current,#content .wp-pagenavi a:hover,.pagination span{background-color:' . $primary_color . '}.pagination a span:hover{color:' . $primary_color . ';border-color:' . $primary_color . '}#content .comments-area a.comment-edit-link:hover,#content .comments-area a.comment-permalink:hover,#content .comments-area article header cite a:hover,.comments-area .comment-author-link a:hover,.widget_testimonial .testimonial-icon:before,.widget_testimonial i.fa-quote-left{color:' . $primary_color . '}#wp-calendar #today,.comment .comment-reply-link:hover,.nav-next a:hover,.nav-previous a:hover{color:' . $primary_color . '}.widget-title span{border-bottom:2px solid ' . $primary_color . '}#secondary h3 span:before,.footer-widgets-area h3 span:before{color:' . $primary_color . '}#secondary .accelerate_tagcloud_widget a:hover,.footer-widgets-area .accelerate_tagcloud_widget a:hover{background-color:' . $primary_color . '}.footer-socket-wrapper .copyright a:hover,.footer-widgets-area a:hover{color:' . $primary_color . '}a#scroll-up{background-color:' . $primary_color . '}.entry-meta .byline i,.entry-meta .cat-links i,.entry-meta a,.post .entry-title a:hover{color:' . $primary_color . '}.entry-meta .post-format i{background-color:' . $primary_color . '}.entry-meta .comments-link a:hover,.entry-meta .edit-link a:hover,.entry-meta .posted-on a:hover,.entry-meta .tag-links a:hover{color:' . $primary_color . '}.more-link span,.read-more{background-color:' . $primary_color . '}.single #content .tags a:hover{color:' . $primary_color . '}#page{border-top:3px solid ' . $primary_color . '}.nav-menu li a:hover,.top-menu-toggle:before{color:' . $primary_color . '}.footer-socket-wrapper{border-top: 3px solid ' . $primary_color . ';}.comments-area .comment-author-link span,{background-color:' . $primary_color . '}@media screen and (max-width: 767px){.better-responsive-menu .sub-toggle{background-color:' . $primary_dark . '}}.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button,main-navigation li.menu-item-has-children:hover, .main-small-navigation .current_page_item > a, .main-small-navigation .current-menu-item > a { background-color: ' . $primary_color . '; } @media(max-width: 1024px) and (min-width: 768px){
			.main-navigation li.menu-item-has-children:hover,.main-navigation li.current_page_item{background:' . $primary_color . ';}}.widget_our_clients .clients-cycle-prev, .widget_our_clients .clients-cycle-next{background-color:' . $primary_color . '}.counter-block-wrapper.fact-style-3 .counter-inner-wrapper{background: ' . $primary_color . '}.team-title::before{background:' . $primary_color . '}';
	}

	if ( accelerate_options( 'accelerate_site_title_font', 'Roboto+Slab:700,400' ) != 'Roboto+Slab:700,400' ) {
		$accelerate_internal_css .= ' #site-title a { font-family: ' . accelerate_options( 'accelerate_site_title_font', 'Roboto+Slab:700,400' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_site_tagline_font', 'Roboto+Slab:700,400' ) != 'Roboto+Slab:700,400' ) {
		$accelerate_internal_css .= ' #site-description { font-family: ' . accelerate_options( 'accelerate_site_tagline_font', 'Roboto+Slab:700,400' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_primary_menu_font', 'Roboto:400,300,100' ) != 'Roboto:400,300,100' ) {
		$accelerate_internal_css .= ' .main-navigation li { font-family: ' . accelerate_options( 'accelerate_primary_menu_font', 'Roboto:400,300,100' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_header_menu_font', 'Roboto:400,300,100' ) != 'Roboto:400,300,100' ) {
		$accelerate_internal_css .= ' .small-menu li { font-family: ' . accelerate_options( 'accelerate_header_menu_font', 'Roboto:400,300,100' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_titles_font', 'Roboto+Slab:700,400' ) != 'Roboto+Slab:700,400' ) {
		$accelerate_internal_css .= ' h1, h2, h3, h4, h5, h6, .widget_recent_work .recent_work_title .title_box h5 { font-family: ' . accelerate_options( 'accelerate_titles_font', 'Roboto+Slab:700,400' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_content_font', 'Roboto:400,300,100' ) != 'Roboto:400,300,100' ) {
		$accelerate_internal_css .= ' body, button, input, select, textarea, p, .entry-meta, .read-more, .more-link, .widget_testimonial .testimonial-author, .widget_testimonial .testimonial-author span { font-family: ' . accelerate_options( 'accelerate_content_font', 'Roboto:400,300,100' ) . '; }';
	}

	if ( accelerate_options( 'accelerate_site_title_font_size', '36' ) != '36' ) {
		$accelerate_internal_css .= ' #site-title a { font-size: ' . accelerate_options( 'accelerate_site_title_font_size', '36' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_tagline_font_size', '16' ) != '16' ) {
		$accelerate_internal_css .= ' #site-description { font-size: ' . accelerate_options( 'accelerate_tagline_font_size', '16' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_primary_menu_font_size', '16' ) != '16' ) {
		$accelerate_internal_css .= ' .main-navigation ul li a { font-size: ' . accelerate_options( 'accelerate_primary_menu_font_size', '16' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_primary_sub_menu_font_size', '14' ) != '14' ) {
		$accelerate_internal_css .= ' .main-navigation ul li ul li a { font-size: ' . accelerate_options( 'accelerate_primary_sub_menu_font_size', '14' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_header_menu_font_size', '14' ) != '14' ) {
		$accelerate_internal_css .= ' .small-menu ul li a { font-size: ' . accelerate_options( 'accelerate_header_menu_font_size', '14' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_header_sub_menu_font_size', '12' ) != '12' ) {
		$accelerate_internal_css .= ' .small-menu ul li ul li a { font-size: ' . accelerate_options( 'accelerate_header_sub_menu_font_size', '12' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_slider_title_font_size', '22' ) != '22' ) {
		$accelerate_internal_css .= ' .slider-title-head .entry-title a  { font-size: ' . accelerate_options( 'accelerate_slider_title_font_size', '22' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_slider_content_font_size', '15' ) != '15' ) {
		$accelerate_internal_css .= ' #featured-slider .entry-content p { font-size: ' . accelerate_options( 'accelerate_slider_content_font_size', '15' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_h1_title_font_size', '30' ) != '30' ) {
		$accelerate_internal_css .= ' h1 { font-size: ' . accelerate_options( 'accelerate_h1_title_font_size', '30' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_h2_title_font_size', '28' ) != '28' ) {
		$accelerate_internal_css .= ' h2 { font-size: ' . accelerate_options( 'accelerate_h2_title_font_size', '28' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_h3_title_font_size', '26' ) != '26' ) {
		$accelerate_internal_css .= ' h3 { font-size: ' . accelerate_options( 'accelerate_h3_title_font_size', '26' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_h4_title_font_size', '24' ) != '24' ) {
		$accelerate_internal_css .= ' h4 { font-size: ' . accelerate_options( 'accelerate_h4_title_font_size', '24' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_h5_title_font_size', '22' ) != '22' ) {
		$accelerate_internal_css .= ' h5 { font-size: ' . accelerate_options( 'accelerate_h5_title_font_size', '22' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_h6_title_font_size', '19' ) != '19' ) {
		$accelerate_internal_css .= ' h6 { font-size: ' . accelerate_options( 'accelerate_h6_title_font_size', '19' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_image_service_widget_title_font_size', '22' ) != '22' ) {
		$accelerate_internal_css .= ' .widget_image_service_block .entry-title { font-size: ' . accelerate_options( 'accelerate_image_service_widget_title_font_size', '22' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_call_to_action_widget_title_font_size', '28' ) != '28' ) {
		$accelerate_internal_css .= ' .call-to-action-content h3 { font-size: ' . accelerate_options( 'accelerate_call_to_action_widget_title_font_size', '28' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_featured_widget_titles_font_size', '16' ) != '16' ) {
		$accelerate_internal_css .= ' .widget_recent_work .recent_work_title .title_box h5 { font-size: ' . accelerate_options( 'accelerate_featured_widget_titles_font_size', '16' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_widget_titles_font_size', '22' ) != '22' ) {
		$accelerate_internal_css .= ' #secondary h3.widget-title { font-size: ' . accelerate_options( 'accelerate_widget_titles_font_size', '22' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_footer_widget_titles_font_size', '22' ) != '22' ) {
		$accelerate_internal_css .= ' #colophon .widget-title { font-size: ' . accelerate_options( 'accelerate_footer_widget_titles_font_size', '22' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_post_title_font_size', '26' ) != '26' ) {
		$accelerate_internal_css .= ' .post .entry-title { font-size: ' . accelerate_options( 'accelerate_post_title_font_size', '26' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_page_title_font_size', '30' ) != '30' ) {
		$accelerate_internal_css .= ' .type-page .entry-title { font-size: ' . accelerate_options( 'accelerate_page_title_font_size', '30' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_comment_title_font_size', '26' ) != '26' ) {
		$accelerate_internal_css .= ' .comments-title, .comment-reply-title { font-size: ' . accelerate_options( 'accelerate_comment_title_font_size', '26' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_content_font_size', '16' ) != '16' ) {
		$accelerate_internal_css .= ' body, button, input, select, textarea, p, dl, .accelerate-button, input[type="reset"], input[type="button"], input[type="submit"], button, .previous a, .next a, .widget_testimonial .testimonial-author span, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"],
#respond form textarea, #secondary .widget, .error-404 .widget { font-size: ' . accelerate_options( 'accelerate_content_font_size', '16' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_post_meta_font_size', '16' ) != '16' ) {
		$accelerate_internal_css .= ' .entry-meta { font-size: ' . accelerate_options( 'accelerate_post_meta_font_size', '16' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_other_post_meta_font_size', '12' ) != '12' ) {
		$accelerate_internal_css .= ' .entry-meta .posted-on, .entry-meta .comments-link, .entry-meta .edit-link, .entry-meta .tag-links { font-size: ' . accelerate_options( 'accelerate_other_post_meta_font_size', '12' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_footer_widget_content_font_size', '14' ) != '14' ) {
		$accelerate_internal_css .= ' #colophon, #colophon p { font-size: ' . accelerate_options( 'accelerate_footer_widget_content_font_size', '14' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_footer_copyright_text_font_size', '12' ) != '12' ) {
		$accelerate_internal_css .= ' .footer-socket-wrapper .copyright { font-size: ' . accelerate_options( 'accelerate_footer_copyright_text_font_size', '12' ) . 'px; }';
	}
	if ( accelerate_options( 'accelerate_small_footer_menu_font_size', '12' ) != '12' ) {
		$accelerate_internal_css .= ' #colophon .footer-menu a { font-size: ' . accelerate_options( 'accelerate_small_footer_menu_font_size', '12' ) . 'px; }';
	}

	// For color options.
	if ( accelerate_options( 'accelerate_site_title_text_color', '#555555' ) != '#555555' ) {
		$accelerate_internal_css .= ' #site-title a { color: ' . accelerate_options( 'accelerate_site_title_text_color', '#555555' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_site_tagline_text_color', '#999999' ) != '#999999' ) {
		$accelerate_internal_css .= ' #site-description { color: ' . accelerate_options( 'accelerate_site_tagline_text_color', '#999999' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_primary_menu_text_color', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' .main-navigation a, .main-navigation ul li ul li a, .main-navigation ul li.current-menu-item ul li a, .main-navigation ul li ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor ul li a, .main-navigation ul li.current-menu-ancestor ul li a, .main-navigation ul li.current_page_item ul li a { color: ' . accelerate_options( 'accelerate_primary_menu_text_color', '#444444' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_primary_menu_background_color', '#77cc6d' ) != '#77cc6d' ) {
		$accelerate_internal_css .= ' .main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a, .main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover { background-color: ' . accelerate_options( 'accelerate_primary_menu_background_color', '#77cc6d' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_primary_menu_bar_background_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' .main-navigation, .main-navigation ul li ul li a, .main-navigation ul li.current-menu-item ul li a, .main-navigation ul li ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor ul li a,
.main-navigation ul li.current-menu-ancestor ul li a, .main-navigation ul li.current_page_item ul li a,
.main-navigation .menu-toggle, .main-small-navigation .menu-toggle, .main-small-navigation ul li ul li a, .main-small-navigation ul li.current-menu-item ul li a, .main-small-navigation ul li ul li.current-menu-item a, .main-small-navigation ul li.current_page_ancestor ul li a, .main-small-navigation li { background-color: ' . accelerate_options( 'accelerate_primary_menu_bar_background_color', '#ffffff' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_header_background_color', '#f8f8f8' ) != '#f8f8f8' ) {
		$accelerate_internal_css .= ' #header-text-nav-container { background-color: ' . accelerate_options( 'accelerate_header_background_color', '#f8f8f8' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_header_top_bar_background_color', '#262626' ) != '#262626' ) {
		$accelerate_internal_css .= ' #header-meta { background-color: ' . accelerate_options( 'accelerate_header_top_bar_background_color', '#262626' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_top_menu_item_color', '#cccccc' ) != '#cccccc' ) {
		$accelerate_internal_css .= ' .small-menu a, .small-menu ul li ul li a, .small-menu ul li.current-menu-item ul li a, .small-menu ul li ul li.current-menu-item a, .small-menu ul li.current_page_ancestor ul li a, .small-menu ul li.current-menu-ancestor ul li a, .small-menu ul li.current_page_item ul li a { color: ' . accelerate_options( 'accelerate_top_menu_item_color', '#cccccc' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_top_menu_selected_item_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' .small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a,.small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a, .small-menu ul li:hover > a, .small-menu ul li ul li a:hover, .small-menu ul li ul li:hover > a, .small-menu ul li.current-menu-item ul li a:hover { color: ' . accelerate_options( 'accelerate_top_menu_selected_item_color', '#ffffff' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_top_menu_dropdown_background_color', '#262626' ) != '#262626' ) {
		$accelerate_internal_css .= ' .small-menu ul li ul li a, .small-menu ul li.current-menu-item ul li a, .small-menu ul li ul li.current-menu-item a, .small-menu ul li.current_page_ancestor ul li a, .small-menu ul li.current-menu-ancestor ul li a, .small-menu ul li.current_page_item ul li a { background-color: ' . accelerate_options( 'accelerate_top_menu_dropdown_background_color', '#262626' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_header_top_line_color', '#77cc6d' ) != '#77cc6d' ) {
		$accelerate_internal_css .= ' #page { border-top-color: ' . accelerate_options( 'accelerate_header_top_line_color', '#77cc6d' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_slider_title_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' .slider-title-head .entry-title a { color: ' . accelerate_options( 'accelerate_slider_title_color', '#ffffff' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_slider_title_background_color', '#77cc6d' ) != '#77cc6d' ) {
		$accelerate_internal_css .= ' .slider-title-head .entry-title a { background-color: ' . accelerate_options( 'accelerate_slider_title_background_color', '#77cc6d' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_slider_content_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' #featured-slider .entry-content { color: ' . accelerate_options( 'accelerate_slider_content_color', '#ffffff' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_slider_background_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' #featured-slider, #featured-slider .slider-cycle { background-color: ' . accelerate_options( 'accelerate_slider_background_color', '#ffffff' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_content_part_titles_color', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' h1, h2, h3, h4, h5, h6, .widget_our_clients .widget-title, .widget_recent_work .widget-title,.widget_image_service_block .entry-title a, .widget_featured_posts .widget-title { color: ' . accelerate_options( 'accelerate_content_part_titles_color', '#444444' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_posts_title_color', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' .post .entry-title, .post .entry-title a, .widget_featured_posts .tg-one-half .entry-title a { color: ' . accelerate_options( 'accelerate_posts_title_color', '#444444' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_page_title_color', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' .type-page .entry-title { color: ' . accelerate_options( 'accelerate_page_title_color', '#444444' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_content_text_color', '#666666' ) != '#666666' ) {
		$accelerate_internal_css .= ' body, button, input, select, textarea { color: ' . accelerate_options( 'accelerate_content_text_color', '#666666' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_post_meta_color', '#77cc6d' ) != '#77cc6d' ) {
		$accelerate_internal_css .= ' .entry-meta .byline i, .entry-meta .cat-links i, .related-posts-wrapper .entry-meta .byline a, .entry-meta a { color: ' . accelerate_options( 'accelerate_post_meta_color', '#77cc6d' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_post_other_meta_color', '#aaaaaa' ) != '#aaaaaa' ) {
		$accelerate_internal_css .= ' .entry-meta .posted-on a, .entry-meta .comments-link a, .entry-meta .edit-link a, .entry-meta .tag-links a { color: ' . accelerate_options( 'accelerate_post_other_meta_color', '#aaaaaa' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_button_text_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' .accelerate-button, input[type="reset"], input[type="button"], input[type="submit"], button, .read-more, .more-link span { color: ' . accelerate_options( 'accelerate_button_text_color', '#ffffff' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_button_background_color', '#77cc6d' ) != '#77cc6d' ) {
		$accelerate_internal_css .= ' .accelerate-button, input[type="reset"], input[type="button"], input[type="submit"], button, .read-more, .more-link span { background-color: ' . accelerate_options( 'accelerate_button_background_color', '#77cc6d' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_widget_title_color', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' #secondary h3.widget-title { color: ' . accelerate_options( 'accelerate_widget_title_color', '#444444' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_content_background_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' #main { background-color: ' . accelerate_options( 'accelerate_content_background_color', '#ffffff' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_call_to_action_background_color', '#f8f8f8' ) != '#f8f8f8' ) {
		$accelerate_internal_css .= ' .call-to-action-content-wrapper { background-color: ' . accelerate_options( 'accelerate_call_to_action_background_color', '#f8f8f8' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_testimonial_background_color', '#fcfcfc' ) != '#fcfcfc' ) {
		$accelerate_internal_css .= ' .widget_testimonial .testimonial-post { background-color: ' . accelerate_options( 'accelerate_testimonial_background_color', '#fcfcfc' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_footer_widget_title_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' .footer-widgets-area h3.widget-title { color: ' . accelerate_options( 'accelerate_footer_widget_title_color', '#ffffff' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_footer_widget_content_color', '#aaaaaa' ) != '#aaaaaa' ) {
		$accelerate_internal_css .= ' .footer-widgets-area, .footer-widgets-area p { color: ' . accelerate_options( 'accelerate_footer_widget_content_color', '#aaaaaa' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_footer_widget_link_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' .footer-widgets-area a { color: ' . accelerate_options( 'accelerate_footer_widget_link_color', '#ffffff' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_footer_widget_background_color', '#27313d' ) != '#27313d' ) {
		$accelerate_internal_css .= ' .footer-widgets-wrapper { background-color: ' . accelerate_options( 'accelerate_footer_widget_background_color', '#27313d' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_footer_copyright_text_color', '#666666' ) != '#666666' ) {
		$accelerate_internal_css .= ' .footer-socket-wrapper .copyright { color: ' . accelerate_options( 'accelerate_footer_copyright_text_color', '#666666' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_footer_small_menu_color', '#666666' ) != '#666666' ) {
		$accelerate_internal_css .= ' .footer-menu a { color: ' . accelerate_options( 'accelerate_footer_small_menu_color', '#666666' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_footer_copyright_part_background_color', '#f8f8f8' ) != '#f8f8f8' ) {
		$accelerate_internal_css .= ' .footer-socket-wrapper { background-color: ' . accelerate_options( 'accelerate_footer_copyright_part_background_color', '#f8f8f8' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_h1_color', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' h1 { color: ' . accelerate_options( 'accelerate_h1_color', '#444444' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_h2_color', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' h2 { color: ' . accelerate_options( 'accelerate_h2_color', '#444444' ) . '; }';
	}
	if ( accelerate_options( 'accelerate_h3_color', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' h3 { color: ' . accelerate_options( 'accelerate_h3_color', '#444444' ) . '; }';
	}

	// Footer background image option
	if ( accelerate_options( 'accelerate_footer_background_image' ) ) {
		$accelerate_internal_css .= '#colophon { background-image: url(' . accelerate_options( 'accelerate_footer_background_image' ) . ') } #colophon .footer-widgets-wrapper{background-color: transparent}';
	}

	// Footer background image position setting
	$footer_background_image_position_setting = accelerate_options( 'accelerate_footer_background_image_position', 'center-center' );
	if ( $footer_background_image_position_setting == 'left-top' ) { // For `left-top`
		$accelerate_internal_css .= '#colophon { background-position: left top; }';
	} elseif ( $footer_background_image_position_setting == 'center-top' ) { // For `center-top`
		$accelerate_internal_css .= '#colophon { background-position: center top; }';
	} elseif ( $footer_background_image_position_setting == 'right-top' ) { // For `right-top`
		$accelerate_internal_css .= '#colophon { background-position: right top; }';
	} elseif ( $footer_background_image_position_setting == 'left-center' ) { // For `left-center`
		$accelerate_internal_css .= '#colophon { background-position: left center; }';
	} elseif ( $footer_background_image_position_setting == 'right-center' ) { // For `right-center`
		$accelerate_internal_css .= '#colophon { background-position: right center; }';
	} elseif ( $footer_background_image_position_setting == 'left-bottom' ) { // For `left-bottom`
		$accelerate_internal_css .= '#colophon { background-position: left bottom; }';
	} elseif ( $footer_background_image_position_setting == 'center-bottom' ) { // For `center-bottom`
		$accelerate_internal_css .= '#colophon { background-position: center bottom; }';
	} elseif ( $footer_background_image_position_setting == 'right-bottom' ) { // For `right-bottom`
		$accelerate_internal_css .= '#colophon { background-position: right bottom; }';
	} else { // For `center-center`
		$accelerate_internal_css .= '#colophon { background-position: center center; }';
	}
	// Footer background size setting
	$footer_background_size_setting = accelerate_options( 'accelerate_footer_background_image_size', 'auto' );
	if ( $footer_background_size_setting == 'cover' ) { // For `cover`
		$accelerate_internal_css .= '#colophon { background-size: cover; }';
	} elseif ( $footer_background_size_setting == 'contain' ) { // For `contain`
		$accelerate_internal_css .= '#colophon { background-size: contain; }';
	} else { // for `auto`
		$accelerate_internal_css .= '#colophon { background-size: auto; }';
	}
	// Footer background attachment setting
	$footer_background_attachment_setting = accelerate_options( 'accelerate_footer_background_image_attachment', 'scroll' );
	if ( $footer_background_attachment_setting == 'fixed' ) { // For `fixed`
		$accelerate_internal_css .= '#colophon { background-attachment: fixed; }';
	} else { // for `scroll`
		$accelerate_internal_css .= '#colophon { background-attachment: scroll; }';
	}
	// Footer background repeat setting
	$footer_background_repeat_setting = accelerate_options( 'accelerate_footer_background_image_repeat', 'scroll' );
	if ( $footer_background_repeat_setting == 'no-repeat' ) { // For `no-repeat`
		$accelerate_internal_css .= '#colophon { background-repeat: no-repeat; }';
	} elseif ( $footer_background_repeat_setting == 'repeat-x' ) { // for `repeat-x`
		$accelerate_internal_css .= '#colophon { background-repeat: repeat-x; }';
	} elseif ( $footer_background_repeat_setting == 'repeat-y' ) { // for `repeat-y`
		$accelerate_internal_css .= '#colophon { background-repeat: repeat-y; }';
	} else { // for `repeat`
		$accelerate_internal_css .= '#colophon { background-repeat: repeat; }';
	}

	// Header title text color.
	if ( accelerate_options( 'accelerate_page_header_text_color', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' .header-title { color: ' . accelerate_options( 'accelerate_page_header_text_color', '#444444' ) . '; }';
	}

	// Header title text font size.
	if ( accelerate_options( 'accelerate_page_header_font_size', '#444444' ) != '#444444' ) {
		$accelerate_internal_css .= ' .header-title { font-size: ' . accelerate_options( 'accelerate_page_header_font_size', '#444444' ) . '; }';
	}

	// Header title background.
	if ( accelerate_options( 'accelerate_page_header_background_color', '#ffffff' ) != '#ffffff' ) {
		$accelerate_internal_css .= ' .page-header { background: ' . accelerate_options( 'accelerate_page_header_background_color', '#ffffff' ) . '; }';
	}

	// Header background image option
	if ( accelerate_options( 'accelerate_page_header_background_image' ) ) {
		$accelerate_internal_css .= '.page-header { background-image: url(' . accelerate_options( 'accelerate_page_header_background_image' ) . ') } .page-header {background-color: transparent}';
	}

	// Header background image position setting.
	$header_background_image_position_setting = accelerate_options( 'accelerate_page_header_background_image_position', 'center-center' );
	if ( $header_background_image_position_setting == 'left-top' ) { // For `left-top`
		$accelerate_internal_css .= '.page-header { background-position: left top; }';
	} elseif ( $header_background_image_position_setting == 'center-top' ) { // For `center-top`
		$accelerate_internal_css .= '.page-header { background-position: center top; }';
	} elseif ( $header_background_image_position_setting == 'right-top' ) { // For `right-top`
		$accelerate_internal_css .= '.page-header { background-position: right top; }';
	} elseif ( $header_background_image_position_setting == 'left-center' ) { // For `left-center`
		$accelerate_internal_css .= '.page-header { background-position: left center; }';
	} elseif ( $header_background_image_position_setting == 'right-center' ) { // For `right-center`
		$accelerate_internal_css .= '.page-header { background-position: right center; }';
	} elseif ( $header_background_image_position_setting == 'left-bottom' ) { // For `left-bottom`
		$accelerate_internal_css .= '.page-header { background-position: left bottom; }';
	} elseif ( $header_background_image_position_setting == 'center-bottom' ) { // For `center-bottom`
		$accelerate_internal_css .= '.page-header { background-position: center bottom; }';
	} elseif ( $header_background_image_position_setting == 'right-bottom' ) { // For `right-bottom`
		$accelerate_internal_css .= '.page-header { background-position: right bottom; }';
	} else { // For `center-center`
		$accelerate_internal_css .= '.page-header { background-position: center center; }';
	}
	// Header background size setting.
	$header_background_size_setting = accelerate_options( 'accelerate_page_header_background_image_size', 'auto' );
	if ( $header_background_size_setting == 'cover' ) { // For `cover`
		$accelerate_internal_css .= '.page-header { background-size: cover; }';
	} elseif ( $header_background_size_setting == 'contain' ) { // For `contain`
		$accelerate_internal_css .= '.page-header { background-size: contain; }';
	} else { // for `auto`
		$accelerate_internal_css .= '.page-header { background-size: auto; }';
	}
	// Header background attachment setting.
	$header_background_attachment_setting = accelerate_options( 'accelerate_page_header_background_image_attachment', 'scroll' );
	if ( $header_background_attachment_setting == 'fixed' ) { // For `fixed`
		$accelerate_internal_css .= '.page-header { background-attachment: fixed; }';
	} else { // for `scroll`
		$accelerate_internal_css .= '.page-header { background-attachment: scroll; }';
	}
	// Header background repeat setting.
	$header_background_repeat_setting = accelerate_options( 'accelerate_page_header_background_image_repeat', 'scroll' );
	if ( $header_background_repeat_setting == 'no-repeat' ) { // For `no-repeat`
		$accelerate_internal_css .= '.page-header { background-repeat: no-repeat; }';
	} elseif ( $header_background_repeat_setting == 'repeat-x' ) { // for `repeat-x`
		$accelerate_internal_css .= '.page-header { background-repeat: repeat-x; }';
	} elseif ( $header_background_repeat_setting == 'repeat-y' ) { // for `repeat-y`
		$accelerate_internal_css .= '.page-header { background-repeat: repeat-y; }';
	} else { // for `repeat`
		$accelerate_internal_css .= '.page-header { background-repeat: repeat; }';
	}

	// For WooCommerce active class.
	$woocommerce_active = accelerate_options( 'accelerate_woocommerce_sidebar_register_setting', 0 );
	if ( $woocommerce_active ) {
		$accelerate_internal_css .= '.woocommerce-active.woocommerce #primary,.woocommerce-active.woocommerce-page #primary{width:65.4546%}.woocommerce-active.woocommerce #secondary,.woocommerce-active.woocommerce-page #secondary{display:block}@media screen and (max-width: 767px){.woocommerce-active.woocommerce #primary,.woocommerce-active.woocommerce-page #primary{width:100%}}.woocommerce-active.no-sidebar-full-width #primary{width:100%}';
	}

	if ( ! empty( $accelerate_internal_css ) ) {
		?>
		<style type="text/css"><?php echo $accelerate_internal_css; ?></style>
		<?php
	}

}

/**************************************************************************************/

/**
 * Removing the more link jumping to middle of content
 */
function accelerate_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end - $offset );
	}

	return $link;
}

add_filter( 'the_content_more_link', 'accelerate_remove_more_jump_link' );

/**************************************************************************************/

if ( ! function_exists( 'accelerate_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 */
	function accelerate_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

		?>
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
			<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'accelerate' ); ?></h3>

			<?php if ( is_single() ) : // navigation links for single posts ?>

				<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'accelerate' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'accelerate' ) . '</span>' ); ?>

			<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'accelerate' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'accelerate' ) ); ?></div>
				<?php endif; ?>

			<?php endif; ?>

		</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
		<?php
	}
endif; // accelerate_content_nav

/**************************************************************************************/

if ( ! function_exists( 'accelerate_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function accelerate_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				// Display trackbacks differently than normal comments.
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'accelerate' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'accelerate' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default :
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard">
						<?php
						echo get_avatar( $comment, 74 );
						printf( '<div class="comment-author-link"><i class="fa fa-user"></i>%1$s%2$s</div>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'accelerate' ) . '</span>' : ''
						);
						printf( '<div class="comment-date-time"><i class="fa fa-calendar-o"></i>%1$s</div>',
							sprintf( __( '%1$s at %2$s', 'accelerate' ), get_comment_date(), get_comment_time() )
						);
						printf( '<a class="comment-permalink" href="%1$s"><i class="fa fa-link"></i>Permalink</a>', esc_url( get_comment_link( $comment->comment_ID ) ) );
						edit_comment_link();
						?>
					</header><!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'accelerate' ); ?></p>
					<?php endif; ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => __( 'Reply', 'accelerate' ),
							'after'      => '',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) ); ?>
					</section><!-- .comment-content -->

				</article><!-- #comment-## -->
				<?php
				break;
		endswitch; // end comment_type check
	}
endif;

/**************************************************************************************/

/* Register shortcodes. */
add_action( 'init', 'accelerate_add_shortcodes' );
/**
 * Creates new shortcodes for use in any shortcode-ready area.  This function uses the add_shortcode()
 * function to register new shortcodes with WordPress.
 *
 * @uses add_shortcode() to create new shortcodes.
 */
function accelerate_add_shortcodes() {
	/* Add theme-specific shortcodes. */
	add_shortcode( 'the-year', 'accelerate_the_year_shortcode' );
	add_shortcode( 'site-link', 'accelerate_site_link_shortcode' );
	add_shortcode( 'wp-link', 'accelerate_wp_link_shortcode' );
	add_shortcode( 'tg-link', 'accelerate_themegrill_link_shortcode' );
}

/**
 * Shortcode to display the current year.
 *
 * @return string
 * @uses date() Gets the current year.
 */
function accelerate_the_year_shortcode() {
	return date( 'Y' );
}

/**
 * Shortcode to display a link back to the site.
 *
 * @return string
 * @uses get_bloginfo() Gets the site link
 */
function accelerate_site_link_shortcode() {
	return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}

/**
 * Shortcode to display a link to WordPress.org.
 *
 * @return string
 */
function accelerate_wp_link_shortcode() {
	return '<a href="' . esc_url( 'https://wordpress.org' ) . '" target="_blank" title="' . esc_attr__( 'WordPress', 'accelerate' ) . '"rel="nofollow"><span>' . esc_html__( 'WordPress', 'accelerate' ) . '</span></a>';
}

/**
 * Shortcode to display a link to accelerate.com.
 *
 * @return string
 */
function accelerate_themegrill_link_shortcode() {
	return '<a href="' . esc_url( 'https://themegrill.com' ) . '" target="_blank" title="' . esc_attr__( 'Accelerate Pro', 'accelerate' ) . '" rel="nofollow"><span>' . __( 'Accelerate Pro', 'accelerate' ) . '</span></a>';
}

add_action( 'accelerate_footer_copyright', 'accelerate_footer_copyright', 10 );
/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'accelerate_footer_copyright' ) ) :
	function accelerate_footer_copyright() {
		$default_footer_value        = accelerate_options( 'accelerate_footer_editor', __( 'Copyright &copy; ', 'accelerate' ) . '[the-year] [site-link]. ' . esc_html__( 'All rights reserved.', 'accelerate' ) . '<br>' . esc_html__( 'Theme: ', 'accelerate' ) . '[tg-link]' .esc_html__( ' by ThemeGrill. Powered by ', 'accelerate' ) . '[wp-link].');
		$accelerate_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';
		echo do_shortcode( $accelerate_footer_copyright );
	}
endif;

/**************************************************************************************/

add_filter( 'body_class', 'accelerate_woocommerce_body_class' );

if ( ! function_exists( 'accelerate_woocommerce_body_class' ) ) {

	/**
	 * Filter body class for WooCommerce pages.
	 *
	 * @return array classes for WooCommerce pages.
	 *
	 * @since 2.2.1
	 */
	function accelerate_woocommerce_body_class( $classes ) {
		$classes[] = '';

		// Filter body class if WooCommerce plugin is activated.
		if ( class_exists( 'WooCommerce' ) ) {
			$classes[] = 'woocommerce-active';

			$woocommerce_shop_page_layout           = accelerate_options( 'accelerate_woocmmerce_shop_page_layout', 'right_sidebar' );
			$woocommerce_archive_page_layout        = accelerate_options( 'accelerate_woocmmerce_archive_page_layout', 'right_sidebar' );
			$woocommerce_single_product_page_layout = accelerate_options( 'accelerate_woocmmerce_single_product_page_layout', 'right_sidebar' );

			$woocommerce_widgets_enabled = accelerate_options( 'accelerate_woocommerce_sidebar_register_setting', 0 );

			if ( ( $woocommerce_widgets_enabled == 1 ) ) :
				if ( is_shop() ) {
					if ( $woocommerce_shop_page_layout == 'right_sidebar' ) {
						$classes[] = '';
					} elseif ( $woocommerce_shop_page_layout == 'left_sidebar' ) {
						$classes[] = 'left-sidebar';
					} elseif ( $woocommerce_shop_page_layout == 'no_sidebar_full_width' ) {
						$classes[] = 'no-sidebar-full-width';
					} elseif ( $woocommerce_shop_page_layout == 'no_sidebar_content_centered' ) {
						$classes[] = 'no-sidebar';
					}
				} elseif ( is_product_category() || is_product_tag() ) {
					if ( $woocommerce_archive_page_layout == 'right_sidebar' ) {
						$classes[] = '';
					} elseif ( $woocommerce_archive_page_layout == 'left_sidebar' ) {
						$classes[] = 'left-sidebar';
					} elseif ( $woocommerce_archive_page_layout == 'no_sidebar_full_width' ) {
						$classes[] = 'no-sidebar-full-width';
					} elseif ( $woocommerce_archive_page_layout == 'no_sidebar_content_centered' ) {
						$classes[] = 'no-sidebar';
					}
				} elseif ( is_product() ) {
					if ( $woocommerce_single_product_page_layout == 'right_sidebar' ) {
						$classes[] = '';
					} elseif ( $woocommerce_single_product_page_layout == 'left_sidebar' ) {
						$classes[] = 'left-sidebar';
					} elseif ( $woocommerce_single_product_page_layout == 'no_sidebar_full_width' ) {
						$classes[] = 'no-sidebar-full-width';
					} elseif ( $woocommerce_single_product_page_layout == 'no_sidebar_content_centered' ) {
						$classes[] = 'no-sidebar';
					}
				}
			endif;
		}

		return $classes;
	}
}

if ( ! function_exists( 'accelerate_woocommerce_sidebar_select' ) ) {

	/**
	 * Select different sidebars for WooCommerce pages as set by the user
	 * when extra WooCommerce widgets is enabled.
	 *
	 * @since 2.2.1
	 */
	function accelerate_woocommerce_sidebar_select() {
		// Bail out if extra sidebar area for WooCommerce page is not activated.
		if ( accelerate_options( 'accelerate_woocommerce_sidebar_register_setting', 0 ) == 0 ) {
			return;
		}

		// Proceed only if WooCommerce plugin is activated.
		if ( class_exists( 'WooCommerce' ) ) {
			$woocommerce_shop_page_layout           = accelerate_options( 'accelerate_woocmmerce_shop_page_layout', 'right_sidebar' );
			$woocommerce_archive_page_layout        = accelerate_options( 'accelerate_woocmmerce_archive_page_layout', 'right_sidebar' );
			$woocommerce_single_product_page_layout = accelerate_options( 'accelerate_woocmmerce_single_product_page_layout', 'right_sidebar' );

			if ( is_shop() ) { // For Shop page.
				if ( $woocommerce_shop_page_layout == 'right_sidebar' ) {
					get_sidebar( 'woocommerce-right' );
				} elseif ( $woocommerce_shop_page_layout == 'left_sidebar' ) {
					get_sidebar( 'woocommerce-left' );
				}
			} elseif ( is_product_category() || is_product_tag() ) { // For Archive page
				if ( $woocommerce_archive_page_layout == 'right_sidebar' ) {
					get_sidebar( 'woocommerce-right' );
				} elseif ( $woocommerce_archive_page_layout == 'left_sidebar' ) {
					get_sidebar( 'woocommerce-left' );
				}
			} elseif ( is_product() ) { // For Single product page
				if ( $woocommerce_single_product_page_layout == 'right_sidebar' ) {
					get_sidebar( 'woocommerce-right' );
				} elseif ( $woocommerce_single_product_page_layout == 'left_sidebar' ) {
					get_sidebar( 'woocommerce-left' );
				}
			}
		}
	}
}

/**
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
// Remove default WooCommerce sidebar call.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_before_main_content', 'accelerate_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'accelerate_wrapper_end', 10 );

function accelerate_wrapper_start() {
	echo '<div id="primary">';
}

function accelerate_wrapper_end() {
	echo '</div>';

	if ( accelerate_options( 'accelerate_woocommerce_sidebar_register_setting', 0 ) == 1 ) {
		accelerate_woocommerce_sidebar_select();
	} else {
		accelerate_sidebar_select();
	}
}

if ( ! function_exists( 'accelerate_woo_related_products_limit' ) ) {

	/**
	 * WooCommerce Extra Feature
	 * --------------------------
	 *
	 * Change number of related products on product page
	 * Set your own value for 'posts_per_page'
	 *
	 */
	function accelerate_woo_related_products_limit() {
		global $product;
		$args = array(
			'posts_per_page' => 4,
			'columns'        => 4,
			'orderby'        => 'rand',
		);

		return $args;
	}
}
add_filter( 'woocommerce_output_related_products_args', 'accelerate_woo_related_products_limit' );

if ( ! function_exists( 'accelerate_pingback_header' ) ) :

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function accelerate_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

endif;

add_action( 'wp_head', 'accelerate_pingback_header' );

/**************************************************************************************/

if ( ! function_exists( 'accelerate_the_custom_logo' ) ) {
	/**
	 * Displays the optional custom logo.
	 */
	function accelerate_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}

/**************************************************************************************/

/**
 * List of allowed social protocols in HTML attributes.
 * @ param  array $protocols Array of allowed protocols.
 * @ return array
 */
function accelerate_allowed_social_protocols( $protocols ) {
	$social_protocols = array(
		'skype',
	);

	return array_merge( $protocols, $social_protocols );
}

add_filter( 'kses_allowed_protocols', 'accelerate_allowed_social_protocols' );

/**
 * Adding the Custom Generated User Field
 */
add_action( 'show_user_profile', 'accelerate_extra_user_field' );
add_action( 'edit_user_profile', 'accelerate_extra_user_field' );

function accelerate_extra_user_field( $user ) {
	?>
	<h3><?php _e( 'User Social Links', 'accelerate' ); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="accelerate_twitter"><?php _e( 'Twitter', 'accelerate' ); ?></label></th>
			<td>
				<input type="text" name="accelerate_twitter" id="accelerate_twitter" value="<?php echo esc_attr( get_the_author_meta( 'accelerate_twitter', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="accelerate_facebook"><?php _e( 'Facebook', 'accelerate' ); ?></label></th>
			<td>
				<input type="text" name="accelerate_facebook" id="accelerate_facebook" value="<?php echo esc_attr( get_the_author_meta( 'accelerate_facebook', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="accelerate_google_plus"><?php _e( 'Google Plus', 'accelerate' ); ?></label></th>
			<td>
				<input type="text" name="accelerate_google_plus" id="accelerate_google_plus" value="<?php echo esc_attr( get_the_author_meta( 'accelerate_google_plus', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="accelerate_flickr"><?php _e( 'Flickr', 'accelerate' ); ?></label></th>
			<td>
				<input type="text" name="accelerate_flickr" id="accelerate_flickr" value="<?php echo esc_attr( get_the_author_meta( 'accelerate_flickr', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="accelerate_linkedin"><?php _e( 'LinkedIn', 'accelerate' ); ?></label></th>
			<td>
				<input type="text" name="accelerate_linkedin" id="accelerate_linkedin" value="<?php echo esc_attr( get_the_author_meta( 'accelerate_linkedin', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="accelerate_instagram"><?php _e( 'Instagram', 'accelerate' ); ?></label></th>
			<td>
				<input type="text" name="accelerate_instagram" id="accelerate_instagram" value="<?php echo esc_attr( get_the_author_meta( 'accelerate_instagram', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="accelerate_tumblr"><?php _e( 'Tumblr', 'accelerate' ); ?></label></th>
			<td>
				<input type="text" name="accelerate_tumblr" id="accelerate_tumblr" value="<?php echo esc_attr( get_the_author_meta( 'accelerate_tumblr', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="accelerate_youtube"><?php _e( 'Youtube', 'accelerate' ); ?></label></th>
			<td>
				<input type="text" name="accelerate_youtube" id="accelerate_youtube" value="<?php echo esc_attr( get_the_author_meta( 'accelerate_youtube', $user->ID ) ); ?>" class="regular-text"/>
			</td>
		</tr>
	</table>
	<?php
}

// Saving the user field used above
add_action( 'personal_options_update', 'accelerate_extra_user_field_save_option' );
add_action( 'edit_user_profile_update', 'accelerate_extra_user_field_save_option' );

function accelerate_extra_user_field_save_option( $user_id ) {

	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	update_user_meta( $user_id, 'accelerate_twitter', wp_filter_nohtml_kses( $_POST['accelerate_twitter'] ) );
	update_user_meta( $user_id, 'accelerate_facebook', wp_filter_nohtml_kses( $_POST['accelerate_facebook'] ) );
	update_user_meta( $user_id, 'accelerate_google_plus', wp_filter_nohtml_kses( $_POST['accelerate_google_plus'] ) );
	update_user_meta( $user_id, 'accelerate_flickr', wp_filter_nohtml_kses( $_POST['accelerate_flickr'] ) );
	update_user_meta( $user_id, 'accelerate_linkedin', wp_filter_nohtml_kses( $_POST['accelerate_linkedin'] ) );
	update_user_meta( $user_id, 'accelerate_instagram', wp_filter_nohtml_kses( $_POST['accelerate_instagram'] ) );
	update_user_meta( $user_id, 'accelerate_tumblr', wp_filter_nohtml_kses( $_POST['accelerate_tumblr'] ) );
	update_user_meta( $user_id, 'accelerate_youtube', wp_filter_nohtml_kses( $_POST['accelerate_youtube'] ) );
}

// fucntion to show the profile field data
function accelerate_author_social_link() {
	?>
	<ul class="author-social-sites">
		<?php if ( get_the_author_meta( 'accelerate_twitter' ) ) { ?>
			<li class="twitter-link">
				<a href="https://twitter.com/<?php the_author_meta( 'accelerate_twitter' ); ?>"><i class="fa fa-twitter"></i></a>
			</li>
		<?php } // End check for twitter ?>
		<?php if ( get_the_author_meta( 'accelerate_facebook' ) ) { ?>
			<li class="facebook-link">
				<a href="https://facebook.com/<?php the_author_meta( 'accelerate_facebook' ); ?>"><i class="fa fa-facebook"></i></a>
			</li>
		<?php } // End check for facebook ?>
		<?php if ( get_the_author_meta( 'accelerate_google_plus' ) ) { ?>
			<li class="google_plus-link">
				<a href="https://plus.google.com/<?php the_author_meta( 'accelerate_google_plus' ); ?>"><i class="fa fa-google-plus"></i></a>
			</li>
		<?php } // End check for google_plus ?>
		<?php if ( get_the_author_meta( 'accelerate_flickr' ) ) { ?>
			<li class="flickr-link">
				<a href="https://flickr.com/<?php the_author_meta( 'accelerate_flickr' ); ?>"><i class="fa fa-flickr"></i></a>
			</li>
		<?php } // End check for flickr ?>
		<?php if ( get_the_author_meta( 'accelerate_linkedin' ) ) { ?>
			<li class="linkedin-link">
				<a href="https://linkedin.com/<?php the_author_meta( 'accelerate_linkedin' ); ?>"><i class="fa fa-linkedin"></i></a>
			</li>
		<?php } // End check for linkedin ?>
		<?php if ( get_the_author_meta( 'accelerate_instagram' ) ) { ?>
			<li class="instagram-link">
				<a href="https://instagram.com/<?php the_author_meta( 'accelerate_instagram' ); ?>"><i class="fa fa-instagram"></i></a>
			</li>
		<?php } // End check for instagram ?>
		<?php if ( get_the_author_meta( 'accelerate_tumblr' ) ) { ?>
			<li class="tumblr-link">
				<a href="https://tumblr.com/<?php the_author_meta( 'accelerate_tumblr' ); ?>"><i class="fa fa-tumblr"></i></a>
			</li>
		<?php } // End check for tumblr ?>
		<?php if ( get_the_author_meta( 'accelerate_youtube' ) ) { ?>
			<li class="youtube-link">
				<a href="https://youtube.com/<?php the_author_meta( 'accelerate_youtube' ); ?>"><i class="fa fa-youtube"></i></a>
			</li>
		<?php } // End check for youtube ?>
	</ul>
	<?php
}

/*	 * *********************************************************************************** */

if ( ! function_exists( 'accelerate_related_posts_function' ) ) {

	/**
	 * Display the related posts
	 */
	function accelerate_related_posts_function() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => accelerate_options( 'accelerate_related_post_number_display', '3' ),
		);

		// Related by categories.
		if ( accelerate_options( 'accelerate_related_posts', 'categories' ) == 'categories' ) {
			$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			$args['category__in'] = $cats;
		}

		// Related by tags.
		if ( accelerate_options( 'accelerate_related_posts', 'categories' ) == 'tags' ) {
			$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
			$args['tag__in'] = $tags;

			// If no tags added, return.
			if ( ! $tags ) {
				$break = true;
			}
		}
		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query;

		return $query;

	}
}

if ( ! function_exists( 'accelerate_display_thumbnail' ) ) :
	/**
	 * Displays post thumbnail.
	 */
	function accelerate_display_thumbnail( $post ) {

		if ( ( accelerate_options( 'accelerate_featured_image_display_setting', 0 ) === 1 ) && has_post_thumbnail() ) {

			$title_attribute     = get_the_title( $post->ID );
			$thumb_id            = get_post_thumbnail_id( get_the_ID() );
			$img_altr            = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
			$img_alt             = ! empty( $img_altr ) ? $img_altr : $title_attribute;
			$post_thumbnail_attr = array(
				'alt'   => esc_attr( $img_alt ),
				'title' => esc_attr( $title_attribute ),
			);

			the_post_thumbnail( 'featured-blog-large', $post_thumbnail_attr );
		}

	}
endif;

/**
 * Plugin check.
 */
if ( ! function_exists( 'accelerate_plugin_version_compare' ) ) {
	function accelerate_plugin_version_compare( $plugin_slug, $version_to_compare ) {
		$installed_plugins = get_plugins();

		// Plugin not installed.
		if ( ! isset( $installed_plugins[ $plugin_slug ] ) ) {
			return false;
		}

		$tdi_user_version = $installed_plugins[ $plugin_slug ]['Version'];

		return version_compare( $tdi_user_version, $version_to_compare, '<' );
	}
}
