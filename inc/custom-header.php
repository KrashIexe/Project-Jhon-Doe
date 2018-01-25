<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Perennial
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses perennial_header_style()
 */
function perennial_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'perennial_custom_header_args', array(
		'default-text-color' => 'ffffff',
		'width'              => 1440,
		'height'             => 900,
		'flex-height'        => true,
		'wp-head-callback'   => 'perennial_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'perennial_custom_header_setup' );

if ( ! function_exists( 'perennial_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see perennial_custom_header_setup().
 */
function perennial_header_style() {
?>

	<?php
	// Header Text Color
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :

		// Hex
		$hex = '#' . $header_text_color;

		// RGB
		$rgb = perennial_hex_to_rgb( $hex );

		// Custom CSS
		$custom_css = '
			.site-title a,
			.site-title a:visited {
				color: %1$s;
			}
			.site-title a:hover,
			.site-title a:focus,
			.site-title a:active {
				color: rgba(%2$s, %3$s, %4$s, 0.80);
			}
			.site-description {
				color: rgba(%2$s, %3$s, %4$s, 0.80);
			}
		';

		// Print CSS
		echo perennial_minify_css( sprintf( $custom_css, $hex, $rgb['r'], $rgb['g'], $rgb['b'] ) );

		endif;
	?>
	</style>

<?php
}
endif; // perennial_header_style
