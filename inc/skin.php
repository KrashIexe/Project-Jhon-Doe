<?php
/**
 * Custom functions to handle the theme skin
 *
 * @package Perennial
 */

/**
 * Theme Primary Color Inline Style
 *
 * @return string
 */
function perennial_primary_color_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_primary_color_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		3.4 Links
		--------------------------------------------------------------*/
		a,
		a:visited {
		  color: %1$s;
		}

		/*--------------------------------------------------------------
		4.6 Forms
		--------------------------------------------------------------*/
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"] {
		  background: %1$s;
		}

		/*--------------------------------------------------------------
		10.6 Site Hero
		--------------------------------------------------------------*/
		.site-hero-wrapper .entry-image-site-hero {
		  background-color: %1$s;
		}

		/*--------------------------------------------------------------
		11.1 HEntry
		--------------------------------------------------------------*/
		.entry-image-wrapper {
		  background-color: %1$s;
		}

		/*--------------------------------------------------------------
		11.6 Comments
		--------------------------------------------------------------*/
		.comment-list .bypostauthor > .comment-body {
		  border-bottom: 3px solid %1$s;
		}

		/*--------------------------------------------------------------
		16.6 Contact Info
		--------------------------------------------------------------*/
		.widget_contact_info .confit-address:before,
		.widget_contact_info .confit-phone:before,
		.widget_contact_info .confit-hours:before {
		  color: %1$s;
		}
		';

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, perennial_mod( 'perennial_primary_color' ) ) );

	}

	return $custom_css;
}

/**
 * Theme Secondary Color Inline Style
 *
 * @return string
 */
function perennial_secondary_color_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_secondary_color_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		3.4 Links
		--------------------------------------------------------------*/
		a:hover,
		a:focus,
		a:active {
		  color: %1$s;
		}

		/*--------------------------------------------------------------
		4.6 Forms
		--------------------------------------------------------------*/
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"] {
		  border: 1px solid %1$s;
		  border-bottom: 3px solid %1$s;
		}
		button:hover, button:focus, button:active,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="button"]:active,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="reset"]:active,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		input[type="submit"]:active {
		  background: %1$s;
		}

		/*--------------------------------------------------------------
		9.5 Navigation Common Styles: Comments, Attachments
		--------------------------------------------------------------*/
		.comment-navigation .nav-previous a:hover,
		.comment-navigation .nav-previous a:focus,
		.comment-navigation .nav-previous a:active,
		.comment-navigation .nav-next a:hover,
		.comment-navigation .nav-next a:focus,
		.comment-navigation .nav-next a:active,
		.image-navigation .nav-previous a:hover,
		.image-navigation .nav-previous a:focus,
		.image-navigation .nav-previous a:active,
		.image-navigation .nav-next a:hover,
		.image-navigation .nav-next a:focus,
		.image-navigation .nav-next a:active {
		  color: %1$s;
		}
		.comment-navigation .nav-previous a:before,
		.image-navigation .nav-previous a:before {
		  color: %1$s;
		}
		.comment-navigation .nav-next a:after,
		.image-navigation .nav-next a:after {
		  color: %1$s;
		}

		/*--------------------------------------------------------------
		11.6 Comments
		--------------------------------------------------------------*/
		.comment-list .comment-awaiting-moderation {
		  color: %1$s;
		}

		/*--------------------------------------------------------------
		13.3 Media Elements
		--------------------------------------------------------------*/
		.hentry .mejs-controls .mejs-time-rail .mejs-time-current {
		  background: %1$s;
		}
		';

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, perennial_mod( 'perennial_secondary_color' ) ) );

	}

	return $custom_css;
}

/**
 * Theme Card Color Inline Style
 *
 * @return string
 */
function perennial_card_color_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_card_color_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		11.1 HEntry
		--------------------------------------------------------------*/
		.skin-card {
			background: %1$s;
		}
		.skin-card-archive {
			background: %1$s;
			background: rgba(%2$s, %3$s, %4$s, 0.90);
		}
		.skin-card-archive:hover {
			background: rgba(%2$s, %3$s, %4$s, 1);
		}
		';

		// Hex
		$hex = perennial_mod( 'perennial_content_card_bg_color' );

		// RGB
		$rgb = perennial_hex_to_rgb( $hex );

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, $hex, $rgb['r'], $rgb['g'], $rgb['b'] ) );

	}

	return $custom_css;
}

/**
 * Theme Footer Widgets Color Inline Style
 *
 * @return string
 */
function perennial_footer_widgets_color_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_footer_widgets_color_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		10.9 Footer
		--------------------------------------------------------------*/
		.skin-footer-widgets {
			background: %1$s;
		}
		';

		// Hex
		$hex = perennial_mod( 'perennial_footer_widgets_bg_color' );

		// RGB
		$rgb = perennial_hex_to_rgb( $hex );

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, $hex, $rgb['r'], $rgb['g'], $rgb['b'] ) );

	}

	return $custom_css;
}

/**
 * Theme Footer Social Color Inline Style
 *
 * @return string
 */
function perennial_footer_social_color_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_footer_social_color_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		10.9 Footer
		--------------------------------------------------------------*/
		.skin-footer-social,
		.has-footer-widgets .skin-footer-social {
			background: %1$s;
		}
		';

		// Hex
		$hex = perennial_mod( 'perennial_footer_social_bg_color' );

		// RGB
		$rgb = perennial_hex_to_rgb( $hex );

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, $hex, $rgb['r'], $rgb['g'], $rgb['b'] ) );

	}

	return $custom_css;
}

/**
 * Theme Footer Info Color Inline Style
 *
 * @return string
 */
function perennial_footer_info_color_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_footer_info_color_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		10.9 Footer
		--------------------------------------------------------------*/
		.skin-footer-info {
			background: %1$s;
		}
		';

		// Hex
		$hex = perennial_mod( 'perennial_footer_info_bg_color' );

		// RGB
		$rgb = perennial_hex_to_rgb( $hex );

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, $hex, $rgb['r'], $rgb['g'], $rgb['b'] ) );

	}

	return $custom_css;
}

/**
 * A helper conditional function.
 * Theme has Custom Primary Color
 *
 * @return bool
 */
function perennial_has_custom_primary_color() {

	/**
	 * Custom Primary Color Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_custom_primary_color', ( perennial_default( 'perennial_primary_color' ) !== perennial_mod( 'perennial_primary_color' ) ) );

}

/**
 * A helper conditional function.
 * Theme has Custom Secondary Color
 *
 * @return bool
 */
function perennial_has_custom_secondary_color() {

	/**
	 * Custom Secondary Color Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_custom_secondary_color', ( perennial_default( 'perennial_secondary_color' ) !== perennial_mod( 'perennial_secondary_color' ) ) );

}

/**
 * A helper conditional function.
 * Theme has Custom Card Color
 *
 * @return bool
 */
function perennial_has_custom_card_color() {

	/**
	 * Custom Card Color Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_custom_card_color', ( perennial_default( 'perennial_content_card_bg_color' ) !== perennial_mod( 'perennial_content_card_bg_color' ) ) );

}

/**
 * A helper conditional function.
 * Theme has Footer Widgets Color
 *
 * @return bool
 */
function perennial_has_custom_footer_widgets_color() {

	/**
	 * Custom Footer Widgets Custom Color Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_custom_footer_widgets_color', ( perennial_default( 'perennial_footer_widgets_bg_color' ) !== perennial_mod( 'perennial_footer_widgets_bg_color' ) ) );

}

/**
 * A helper conditional function.
 * Theme has Footer Social Custom Color
 *
 * @return bool
 */
function perennial_has_custom_footer_social_color() {

	/**
	 * Custom Footer Social Color Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_custom_footer_social_color', ( perennial_default( 'perennial_footer_social_bg_color' ) !== perennial_mod( 'perennial_footer_social_bg_color' ) ) );

}

/**
 * A helper conditional function.
 * Theme has Footer Info Custom Color
 *
 * @return bool
 */
function perennial_has_custom_footer_info_color() {

	/**
	 * Custom Footer Info Color Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_custom_footer_info_color', ( perennial_default( 'perennial_footer_info_bg_color' ) !== perennial_mod( 'perennial_footer_info_bg_color' ) ) );

}

/**
 * Enqueues front-end Inline CSS for the theme skin.
 *
 * @see wp_add_inline_style()
 */
function perennial_custom_skin() {

	// Custom Primary Color Inline Style
	if ( perennial_has_custom_primary_color() ) {
		wp_add_inline_style( 'perennial-style', perennial_primary_color_inline_style() );
	}

	// Custom Secondary Color Inline Style
	if ( perennial_has_custom_secondary_color() ) {
		wp_add_inline_style( 'perennial-style', perennial_secondary_color_inline_style() );
	}

	// Custom Card Color Inline Style
	if ( perennial_has_custom_card_color() ) {
		wp_add_inline_style( 'perennial-style', perennial_card_color_inline_style() );
	}

	// Custom Footer Widgets Color Inline Style
	if ( perennial_has_custom_footer_widgets_color() ) {
		wp_add_inline_style( 'perennial-style', perennial_footer_widgets_color_inline_style() );
	}

	// Custom Footer Social Color Inline Style
	if ( perennial_has_custom_footer_social_color() ) {
		wp_add_inline_style( 'perennial-style', perennial_footer_social_color_inline_style() );
	}

	// Custom Footer Info Color Inline Style
	if ( perennial_has_custom_footer_info_color() ) {
		wp_add_inline_style( 'perennial-style', perennial_footer_info_color_inline_style() );
	}

}
add_action( 'wp_enqueue_scripts', 'perennial_custom_skin', 11 );

/**
 * Theme Skin Transients.
 *
 * @return void
 */
function perennial_custom_skin_transients( $wp_customize_manager ) {

	// Custom Primary Color Inline Style
	if ( perennial_has_custom_primary_color() ) {
		set_transient( 'perennial_primary_color_inline_style', perennial_primary_color_inline_style() );
	}

	// Custom Secondary Color Inline Style
	if ( perennial_has_custom_secondary_color() ) {
		set_transient( 'perennial_secondary_color_inline_style', perennial_secondary_color_inline_style() );
	}

	// Custom Card Color Inline Style
	if ( perennial_has_custom_card_color() ) {
		set_transient( 'perennial_card_color_inline_style', perennial_card_color_inline_style() );
	}

	// Custom Footer Widgets Color Inline Style
	if ( perennial_has_custom_footer_widgets_color() ) {
		set_transient( 'perennial_footer_widgets_color_inline_style', perennial_footer_widgets_color_inline_style() );
	}

	// Custom Footer Social Color Inline Style
	if ( perennial_has_custom_footer_social_color() ) {
		set_transient( 'perennial_footer_social_color_inline_style', perennial_footer_social_color_inline_style() );
	}

	// Custom Footer Info Color Inline Style
	if ( perennial_has_custom_footer_info_color() ) {
		set_transient( 'perennial_footer_info_color_inline_style', perennial_footer_info_color_inline_style() );
	}

}
add_action( 'customize_save_after', 'perennial_custom_skin_transients' );
