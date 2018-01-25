<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Perennial
 */

/**
 * Theme Mod Defaults
 *
 * @param string $theme_mod - Theme modification name.
 * @return mixed
 */
function perennial_default( $theme_mod = '' ) {

	$default = array (
		'perennial_sticky_menu'                       => false,
		'perennial_custom_header_title'               => '',
		'perennial_custom_header_summary'             => '',
		'perennial_site_hero_post_global'             => false,
		'perennial_site_hero_post'                    => true,
		'perennial_site_hero_page'                    => true,
		'perennial_site_hero_jetpack_portfolio'       => true,
		'perennial_primary_color'                     => '#4a8cc7',
		'perennial_secondary_color'                   => '#4d94d1',
		'perennial_content_card_bg_color'             => '#ffffff',
		'perennial_footer_widgets_bg_color'           => '#ffffff',
		'perennial_footer_social_bg_color'            => ( perennial_has_footer_widgets() ) ? '#f5f5f5' : '#ffffff',
		'perennial_footer_info_bg_color'              => '#ffffff',
		'perennial_headings_font'                     => 'roboto-condensed',
		'perennial_body_font'                         => 'lato',
		'perennial_branding_font'                     => 'roboto-condensed',
		'perennial_menu_font'                         => 'montserrat',
		'perennial_headings_font_variant_100'         => false,
		'perennial_headings_font_variant_200'         => false,
		'perennial_headings_font_variant_300'         => false,
		'perennial_headings_font_variant_500'         => false,
		'perennial_headings_font_variant_600'         => false,
		'perennial_headings_font_variant_700'         => true,
		'perennial_headings_font_variant_800'         => false,
		'perennial_headings_font_variant_900'         => false,
		'perennial_body_font_variant_100'             => false,
		'perennial_body_font_variant_200'             => false,
		'perennial_body_font_variant_300'             => false,
		'perennial_body_font_variant_500'             => false,
		'perennial_body_font_variant_600'             => false,
		'perennial_body_font_variant_700'             => true,
		'perennial_body_font_variant_800'             => false,
		'perennial_body_font_variant_900'             => false,
		'perennial_branding_font_variant_100'         => false,
		'perennial_branding_font_variant_200'         => false,
		'perennial_branding_font_variant_300'         => false,
		'perennial_branding_font_variant_500'         => false,
		'perennial_branding_font_variant_600'         => false,
		'perennial_branding_font_variant_700'         => false,
		'perennial_branding_font_variant_800'         => false,
		'perennial_branding_font_variant_900'         => false,
		'perennial_menu_font_variant_100'             => false,
		'perennial_menu_font_variant_200'             => false,
		'perennial_menu_font_variant_300'             => false,
		'perennial_menu_font_variant_500'             => false,
		'perennial_menu_font_variant_600'             => false,
		'perennial_menu_font_variant_700'             => false,
		'perennial_menu_font_variant_800'             => false,
		'perennial_menu_font_variant_900'             => false,
		'perennial_ad_post_content_before'            => '',
		'perennial_ad_post_content_after'             => '',
		'perennial_ad_post_global'                    => false,
		'perennial_ad_post'                           => false,
		'perennial_ad_page'                           => false,
		'perennial_ad_portfolio'                      => false,
		'perennial_woocommerce'                       => false,
		'perennial_woocommerce_archive_sidebar'       => false,
		'perennial_woocommerce_product_sidebar'       => false,
		'perennial_woocommerce_site_hero_post'        => false,
		'perennial_woocommerce_ad_post'               => false,
		'perennial_woocommerce_ad_page'               => false,
		'perennial_copyright'                         => sprintf( '&copy; Copyright %1$s - <a href="%2$s">%3$s</a>', date( 'Y' ), esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) ),
		'perennial_credit'                            => true,
		'perennial_header_scripts'                    => '',
		'perennial_footer_scripts'                    => '',
		'perennial_header_scripts_control'            => false,
		'perennial_footer_scripts_control'            => false,
		'perennial_svg_mime'                          => false,
		'perennial_ver_param'                         => false,
	);

	return ( isset ( $default[$theme_mod] ) ? $default[$theme_mod] : '' );

}

/**
 * Theme Mod Wrapper
 *
 * @param string $theme_mod - Name of the theme mod to retrieve.
 * @return mixed
 */
function perennial_mod( $theme_mod = '' ) {
	return get_theme_mod( $theme_mod, perennial_default( $theme_mod ) );
}

/**
 * Filter 'get_custom_logo'
 *
 * @return string
 */
function perennial_get_custom_logo( $html ) {
	return sprintf( '<div class="site-logo-wrapper" %2$s>%1$s</div>', $html, perennial_schema( 'site-logo', false ) );
}
add_filter( 'get_custom_logo', 'perennial_get_custom_logo' );

/**
 * Filter 'upload_mimes'
 * Support for SVG logos.
 *
 * @return string
 */
function perennial_svg_mime_types( $mimes ) {
	if ( perennial_mod( 'perennial_svg_mime' ) ) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
	}
	return $mimes;
}
add_filter( 'upload_mimes', 'perennial_svg_mime_types' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function perennial_page_menu_args( $args ) {
	$args['show_home'] = true;
	$args['menu_class'] = 'site-header-menu';
	return $args;
}
add_filter( 'wp_page_menu_args', 'perennial_page_menu_args' );

/**
 * Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
 */
function perennial_page_menu_class( $class ) {
  return preg_replace( '/<ul>/', '<ul class="header-menu sf-menu">', $class, 1 );
}
add_filter( 'wp_page_menu', 'perennial_page_menu_class' );

/**
 * Filter 'excerpt_length'
 *
 * @param int $length
 * @return int
 */
function perennial_excerpt_length( $length ) {
	return apply_filters( 'perennial_excerpt_length', 30 );
}
add_filter( 'excerpt_length', 'perennial_excerpt_length' );

/**
 * Filter 'excerpt_more'
 *
 * Remove [...] string
 * @param str $more
 * @return str
 */
function perennial_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'perennial_excerpt_more' );

/**
 * Filter 'the_content_more_link'
 * Prevent Page Scroll When Clicking the More Link.
 *
 * @param string $link
 * @return filtered link
 */
function perennial_the_content_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'perennial_the_content_more_link_scroll' );

/**
 * Filter 'get_the_archive_title'
 * Add `<span>` tag around title.
 *
 * @param string $title
 * @return filtered string
 */
function perennial_archive_title( $title ) {

	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: ', 'perennial-pro' ) . '<span>%s</span>', single_cat_title( '', false ) );
	}  elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: ', 'perennial-pro' ) . '<span>%s</span>', single_tag_title( '', false ) );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: ', 'perennial-pro' ) . '<span>%s</span>', get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'perennial-pro' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: ', 'perennial-pro' ) . '<span>%s</span>', get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'perennial-pro' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: ', 'perennial-pro' ) . '<span>%s</span>', get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'perennial-pro' ) ) );
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: ', 'perennial-pro' ) . '<span>%s</span>', post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		$title = sprintf( '%1$s: <span>%2$s</span>', $tax->labels->singular_name, single_term_title( '', false ) );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'perennial_archive_title' );

/**
 * Filter `body_class`
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function perennial_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Site Title & Tagline Class
	if ( display_header_text() ) {
		$classes[] = 'has-site-branding';
	}

	// Custom Background Image Class
	if ( get_background_image() ) {
		$classes[] = 'has-custom-background-image';
	}

	// Site Hero Class
	if ( perennial_has_featured_content() || perennial_has_custom_header() || perennial_has_site_hero_post_global() || perennial_has_site_hero_page() ) {
		$classes[] = 'has-site-hero';
	}

	// Full Width Class
	if ( perennial_has_fullwidth() ) {
		$classes[] = 'has-full-width';
	}

	// Footer Widgets Class
	if ( perennial_has_footer_widgets() ) {
		$classes[] = 'has-footer-widgets';
	}

	// Excerpt Class
	if ( perennial_has_excerpt() ) {
		$classes[] = 'has-excerpt';
	}

	// Sticky Menu Class
	if ( perennial_mod( 'perennial_sticky_menu' ) ) {
		$classes[] = 'has-sticky-menu';
	}

	// Custom Background Color Class
	if ( get_background_color() !== get_theme_support( 'custom-background', 'default-color' ) ) {
		$classes[] = 'custom-background-' . perennial_get_background_yiq( get_background_color() );
	}

	// Custom Card Color Class
	if ( perennial_has_custom_card_color() ) {
		$classes[] = 'custom-background-card-' . perennial_get_background_yiq( perennial_mod( 'perennial_content_card_bg_color' ) );
	}

	// Custom Footer Widgets Color Class
	if ( perennial_has_custom_footer_widgets_color() ) {
		$classes[] = 'custom-background-footer-widgets-' . perennial_get_background_yiq( perennial_mod( 'perennial_footer_widgets_bg_color' ) );
	}

	// Custom Footer Social Color Class
	if ( perennial_has_custom_footer_social_color() ) {
		$classes[] = 'custom-background-footer-social-' . perennial_get_background_yiq( perennial_mod( 'perennial_footer_social_bg_color' ) );
	}

	// Custom Footer Info Color Class
	if ( perennial_has_custom_footer_info_color() ) {
		$classes[] = 'custom-background-footer-info-' . perennial_get_background_yiq( perennial_mod( 'perennial_footer_info_bg_color' ) );
	}

	return $classes;
}
add_filter( 'body_class', 'perennial_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function perennial_attachment_link( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) ) {
		return $url;
	}

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id ) {
		$url .= '#main';
	}

	return $url;
}
add_filter( 'attachment_link', 'perennial_attachment_link', 10, 2 );

/**
 * Filter 'the_content'
 *
 * https://codex.wordpress.org/Plugin_API/Filter_Reference/the_content
 *
 * @param str $content
 * @return $content
 */
function perennial_the_content_ad( $content ) {

	// Post or Page Contextual Control
	if ( ! ( perennial_has_ad_post_global() || perennial_has_ad_page() ) ) {
		return $content;
	}

	// Ad Before
	$ad = perennial_mod( 'perennial_ad_post_content_before' );
	if ( ! empty ( $ad ) ) {
		$ad = sprintf( '<p class="entry-ad entry-ad-post-content-before">%1$s</p>', $ad );
		$content = $ad . $content;
	}

	// Ad After
	$ad = perennial_mod( 'perennial_ad_post_content_after' );
	if ( ! empty ( $ad ) ) {
		$ad = sprintf( '<p class="entry-ad entry-ad-post-content-after">%1$s</p>', $ad );
		$content = $content . $ad;
	}

	return $content;
}
add_filter( 'the_content', 'perennial_the_content_ad', 12 );

/**
 * Filter 'perennial_has_ad_post_global'
 * We will modify the filter only, if the post type is `post`.
 *
 * @param bool $post_ad
 * @return bool
 */
function perennial_has_ad_post( $post_ad ) {

	if ( is_singular( 'post' ) ) {
		return apply_filters( 'perennial_has_ad_post', (bool) ( perennial_mod( 'perennial_ad_post' ) ) );
	}

	return (bool) $post_ad;

}
add_filter( 'perennial_has_ad_post_global', 'perennial_has_ad_post', 20 );

/**
 * Filter 'perennial_has_site_hero_post_global'
 * We will modify the filter only, if the post type is `post`.
 *
 * @param bool $site_hero
 * @return bool
 */
function perennial_has_site_hero_post( $site_hero ) {

	if ( is_singular( 'post' ) ) {
		return apply_filters( 'perennial_has_site_hero_post', (bool) ( perennial_mod( 'perennial_site_hero_post' ) && perennial_has_post_thumbnail() ) );
	}

	return (bool) $site_hero;

}
add_filter( 'perennial_has_site_hero_post_global', 'perennial_has_site_hero_post', 20 );

/**
 * Filter 'style_loader_src'
 * Filter 'script_loader_src'
 *
 * Remove 'ver=x' from src
 *
 * @param str $src
 * @return str
 */
function perennial_version_param( $src ) {
	if ( perennial_mod( 'perennial_ver_param' ) && strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'perennial_version_param', 9999 );
add_filter( 'script_loader_src', 'perennial_version_param', 9999 );

/**
 * Adjust content_width value according to template.
 *
 * @return void
 */
function perennial_template_redirect_content_width() {

	// Full Width Page Template
	if ( perennial_has_fullwidth() ) {
		$GLOBALS['content_width'] = 1010;
	}

}
add_action( 'template_redirect', 'perennial_template_redirect_content_width' );

/**
 * Echo header scripts in to wp_head().
 *
 * @return void
 */
function perennial_header_scripts() {
	// Validation Check
	$header_scripts = perennial_mod( 'perennial_header_scripts' );
	if ( false === perennial_mod( 'perennial_header_scripts_control' ) || empty( $header_scripts ) ) {
		return;
	}

	// Echo Script
	echo apply_filters( 'perennial_header_scripts', $header_scripts );
}
add_action( 'wp_head', 'perennial_header_scripts', 100 );

/**
 * Echo footer scripts in to wp_footer().
 *
 * @return void
 */
function perennial_footer_scripts() {
	// Validation Check
	$footer_scripts = perennial_mod( 'perennial_footer_scripts' );
	if ( false === perennial_mod( 'perennial_footer_scripts_control' ) || empty( $footer_scripts ) ) {
		return;
	}

	// Echo Script
	echo apply_filters( 'perennial_footer_scripts', $footer_scripts );
}
add_action( 'wp_footer', 'perennial_footer_scripts', 100 );

/**
 * Blog Credits.
 *
 * @return void
 */
function perennial_credits_blog() {
?>
<div class="credits-blog">
	<?php echo convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( perennial_mod( 'perennial_copyright' ) ) ) ) ) ) ); ?>
</div>
<?php
}
add_action( 'perennial_credits', 'perennial_credits_blog' );

/**
 * Designer Credits.
 *
 * @return void
 */
function perennial_credits_designer() {
	$credit = 'https://designorbital.com/magazine-wordpress-themes/';
	echo apply_filters( 'perennial_credits_designer', sprintf( '<div class="credits-designer"><a href="%1$s">Magazine WordPress Themes</a> by DesignOrbital</div>', $credit ) );
}
add_action( 'perennial_credits', 'perennial_credits_designer' );

/**
 * Enqueues front-end CSS to hide elements.
 *
 * @see wp_add_inline_style()
 */
function perennial_hide_elements() {
	// Elements
	$elements = array();

	// Credit
	if ( false === perennial_mod( 'perennial_credit' ) ) {
		$elements[] = '.credits-designer';
	}

	// Bail if their are no elements to process
	if ( 0 === count( $elements ) ) {
		return;
	}

	// Build Elements
	$elements = implode( ',', $elements );

	// Build CSS
	$css = sprintf( '%1$s { clip: rect(1px, 1px, 1px, 1px); position: absolute; }', $elements );

	// Add Inline Style
	wp_add_inline_style( 'perennial-style', perennial_minify_css( $css ) );
}
add_action( 'wp_enqueue_scripts', 'perennial_hide_elements', 11 );

if ( ! function_exists( 'perennial_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @return void
 */
function perennial_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Perennial attachment size.
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 1140.
	 *     @type int $width  Width of the image in pixels. Default 1140.
	 * }
	 */
	$attachment_size     = apply_filters( 'perennial_attachment_size', 'full' );
	$next_attachment_url = wp_get_attachment_url();

	if ( $post->post_parent ) { // Only look for attachments if this attachment has a parent object.

		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 100,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {

			foreach ( $attachment_ids as $key => $attachment_id ) {
				if ( $attachment_id === $post->ID ) {
					break;
				}
			}

			// For next attachment
			$key++;

			if ( isset( $attachment_ids[ $key ] ) ) {
				// get the URL of the next image attachment
				$next_attachment_url = get_attachment_link( $attachment_ids[$key] );
			} else {
				// or get the URL of the first image attachment
				$next_attachment_url = get_attachment_link( $attachment_ids[0] );
			}

		}

	} // end post->post_parent check

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		esc_attr( get_the_title() ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);

}
endif;

/**
 * Minify the CSS.
 *
 * @param string $css.
 * @return minified css
 */
function perennial_minify_css( $css ) {

    // Remove CSS comments
    $css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );

    // Remove space after colons
	$css = str_replace( ': ', ':', $css );

	// Remove space before curly braces
	$css = str_replace( ' {', '{', $css );

    // Remove whitespace i.e tabs, spaces, newlines, etc.
    $css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '     '), '', $css );

    return $css;
}

/**
 * Get image src from a specified post in the following order:
 *
 * 1. Post Thumbnail
 * 2. First Attached Image (Fallback)
 * 3. First Image from `the_content` HTML (Fallback)
 *
 * @return string | bool
 */
function perennial_get_image_src( $args = array() ) {

	// Defaults
	$defaults = array (
 		'post_id'  => null,
 		'size'     => 'perennial-featured',
 		'attr'     => '',
 		'fallback' => true
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	// Post Id
	$args['post_id'] = ( null === $args['post_id'] ) ? get_the_ID() : $args['post_id'];

	// 1. Post Thumbnail
	if ( '' !== get_the_post_thumbnail( $args['post_id'] ) ) {
		$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $args['post_id'] ), $args['size'] );
		return $image_attributes[0];
	}

	// Fallback
	if ( true === $args['fallback'] ) {

		// 2. First Attached Image
		$attached_images = get_attached_media( 'image' );
		if ( ! empty( $attached_images ) ) {
			$first_attached_image = array_shift( $attached_images );
			$image_attributes = wp_get_attachment_image_src( $first_attached_image->ID, $args['size'] );
			return $image_attributes[0];
		}

		// 3. First Image from `the_content` HTML (Fallback)
		if ( class_exists( 'Jetpack_PostImages' ) ) {
			global $_wp_additional_image_sizes;

			$args_jetpack = array(
				'from_thumbnail'  => false,
				'from_slideshow'  => true,
				'from_gallery'    => true,
				'from_attachment' => false,
			);

			$image = Jetpack_PostImages::get_image( $args['post_id'], $args_jetpack );

			if ( ! empty( $image ) ) {
				$image['width']  = '';
				$image['height'] = '';

				if ( array_key_exists( $args['size'], $_wp_additional_image_sizes ) ) {
					$image['width']  = $_wp_additional_image_sizes[$args['size']]['width'];
					$image['height'] = $_wp_additional_image_sizes[$args['size']]['height'];
				}

				$image_src = Jetpack_PostImages::fit_image_url( $image['src'], $image['width'], $image['height'] );
				return $image_src;
			}
		}

	}

	return false;
}

/**
 * Calculating Color Contrast
 *
 * @see https://24ways.org/2010/calculating-color-contrast
 * @param string $hex The hex value of a color.
 * @return str light || dark.
 */
function perennial_get_background_yiq( $hexcolor = '#fff', $route = 'contrast' ) {

	// Calculate RGB
	$rgb = perennial_hex_to_rgb( $hexcolor );

	// Calculate YIQ
	$yiq = absint( ( ( $rgb['r'] * 299 ) + ( $rgb['g'] * 587 ) + ( $rgb['b'] * 114 ) ) / 1000 );

	if ( 'yiq' === $route ) {
		return $yiq;
	}

	return ( $yiq >= 128 ) ? 'light' : 'dark';
}

/**
 * Convert HEX to RGB.
 *
 * @param string $hexcolor The original color, in 3- or 6-digit hexadecimal form.
 * @return str|array Array containing RGB (red, green, and blue) values for the given HEX code.
 */
function perennial_hex_to_rgb( $hexcolor = '#fff' ) {

	// Trim #
	$hexcolor = trim( $hexcolor, '#' );

	// Validate
	$hexcolor = ( 3 === strlen( $hexcolor ) || 6 === strlen( $hexcolor ) ) ? $hexcolor : 'fff';

	// Calculate RGB
	if ( 3 === strlen( $hexcolor ) ) {

		$r = hexdec( substr( $hexcolor, 0, 1 ).substr( $hexcolor, 0, 1 ) );
		$g = hexdec( substr( $hexcolor, 1, 1 ).substr( $hexcolor, 1, 1 ) );
		$b = hexdec( substr( $hexcolor, 2, 1 ).substr( $hexcolor, 2, 1 ) );

	} else if ( 6 === strlen( $hexcolor ) ) {

		$r = hexdec( substr( $hexcolor, 0, 2 ) );
		$g = hexdec( substr( $hexcolor, 2, 2 ) );
		$b = hexdec( substr( $hexcolor, 4, 2 ) );

	}

	// @return
	return array( 'r' => $r, 'g' => $g, 'b' => $b );
}

/**
 * Adjusts brightness of the $hex color.
 *
 * @param str $hex The hex value of a color.
 * @param int $steps Should be between -255 and 255. Negative = darker, positive = lighter.
 * @return str Returns hex color.
 */
function perennial_adjust_brightness( $hex = '#fff', $steps = '255' ) {
	// Validation
	$hex   = trim( $hex, '#' );
	$steps = max( -255, min( 255, $steps ) );

	// Adjust number of steps and keep it inside 0 to 255.
	$red   = max( 0, min( 255, hexdec( substr( $hex, 0, 2 ) ) + $steps ) );
	$green = max( 0, min( 255, hexdec( substr( $hex, 2, 2 ) ) + $steps ) );
	$blue  = max( 0, min( 255, hexdec( substr( $hex, 4, 2 ) ) + $steps ) );

	$red_hex   = str_pad( dechex( $red ), 2, '0', STR_PAD_LEFT );
	$green_hex = str_pad( dechex( $green ), 2, '0', STR_PAD_LEFT );
	$blue_hex  = str_pad( dechex( $blue ), 2, '0', STR_PAD_LEFT );

	// @return
	return '#' . $red_hex . $green_hex . $blue_hex;
}
