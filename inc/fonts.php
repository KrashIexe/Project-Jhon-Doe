<?php
/**
 * Custom functions to handle the theme fonts
 *
 * @package Perennial
 */

/**
 * Fonts Custom Control
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class Perennial_WP_Customize_Control_Fonts extends WP_Customize_Control {
		/**
		 * @access public
		 * @var string
		 */
		public $type = 'perennial_fonts';

		/**
		 * Render the control's content.
		 */
		public function render_content() {

			// Fonts Library
			$fonts = perennial_fonts_library();

			// Optgroup Logic
			$serif       = false;
			$sans_serif  = false;
			$display     = false;
			$handwriting = false;
			$monospace   = false;

			// Build Options
			foreach( $fonts as $key => $val ) {
				switch( $val['category'] ) {
					case 'serif':
					$serif .= sprintf( '<option %1$s value="%2$s">%3$s</option>', selected( $this->value(), $key, false ), esc_attr( $key ), esc_html( $val['name'] ) );
					break;

					case 'sans-serif':
					$sans_serif .= sprintf( '<option %1$s value="%2$s">%3$s</option>', selected( $this->value(), $key, false ), esc_attr( $key ), esc_html( $val['name'] ) );
					break;

					case 'display':
					$display .= sprintf( '<option %1$s value="%2$s">%3$s</option>', selected( $this->value(), $key, false ), esc_attr( $key ), esc_html( $val['name'] ) );
					break;

					case 'handwriting':
					$handwriting .= sprintf( '<option %1$s value="%2$s">%3$s</option>', selected( $this->value(), $key, false ), esc_attr( $key ), esc_html( $val['name'] ) );
					break;

					case 'monospace':
					$monospace .= sprintf( '<option %1$s value="%2$s">%3$s</option>', selected( $this->value(), $key, false ), esc_attr( $key ), esc_html( $val['name'] ) );
					break;
				}
			}

		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?>>
				<optgroup label="<?php esc_attr_e( 'Serif', 'perennial-pro' ); ?>">
					<?php echo $serif; ?>
				</optgroup>
				<optgroup label="<?php esc_attr_e( 'Sans Serif', 'perennial-pro' ); ?>">
					<?php echo $sans_serif; ?>
				</optgroup>
				<optgroup label="<?php esc_attr_e( 'Display', 'perennial-pro' ); ?>">
					<?php echo $display; ?>
				</optgroup>
				<optgroup label="<?php esc_attr_e( 'Handwriting', 'perennial-pro' ); ?>">
					<?php echo $handwriting; ?>
				</optgroup>
				<optgroup label="<?php esc_attr_e( 'Monospace', 'perennial-pro' ); ?>">
					<?php echo $monospace; ?>
				</optgroup>
			</select>
		</label>
		<?php
		}
	}

}

/**
 * Font Getter.
 *
 * @see https://fonts.google.com/
 * @param string $font.
 * @return Array
 */
function perennial_font( $font = 'open-sans', $column = false ) {

	// Fonts Library
	$fonts_library = perennial_fonts_library();

	// Font Validation
	if ( ! array_key_exists( $font, $fonts_library ) ) {
		$font = perennial_default( 'perennial_body_font' );
	}

	// Return Column Value
	if ( false !== $column ) {
		return $fonts_library[$font][$column];
	}

	// Return Font Array
	return $fonts_library[$font];

}

/**
 * Font Enqueue Format.
 *
 * @param string $context.
 * @return string
 */
function perennial_font_enqueue_format( $context = 'body' ) {

	// Font Context
	if ( 'headings' === $context ) {

		// Headings Font
		$font = perennial_mod( 'perennial_headings_font' );

		// Headings Font Variants
		$font_variants = array(
			'perennial_headings_font_variant_100' => '100',
			'perennial_headings_font_variant_200' => '200',
			'perennial_headings_font_variant_300' => '300',
			'perennial_headings_font_variant_400' => '400',
			'perennial_headings_font_variant_500' => '500',
			'perennial_headings_font_variant_600' => '600',
			'perennial_headings_font_variant_700' => '700',
			'perennial_headings_font_variant_800' => '800',
			'perennial_headings_font_variant_900' => '900',
		);

	} else if ( 'body' === $context ) {

		// Body Font
		$font = perennial_mod( 'perennial_body_font' );

		// Body Font Variants
		$font_variants = array(
			'perennial_body_font_variant_100' => '100',
			'perennial_body_font_variant_200' => '200',
			'perennial_body_font_variant_300' => '300',
			'perennial_body_font_variant_400' => '400',
			'perennial_body_font_variant_500' => '500',
			'perennial_body_font_variant_600' => '600',
			'perennial_body_font_variant_700' => '700',
			'perennial_body_font_variant_800' => '800',
			'perennial_body_font_variant_900' => '900',
		);

	} else if ( 'branding' === $context ) {

		// Body Font
		$font = perennial_mod( 'perennial_branding_font' );

		// Body Font Variants
		$font_variants = array(
			'perennial_branding_font_variant_100' => '100',
			'perennial_branding_font_variant_200' => '200',
			'perennial_branding_font_variant_300' => '300',
			'perennial_branding_font_variant_400' => '400',
			'perennial_branding_font_variant_500' => '500',
			'perennial_branding_font_variant_600' => '600',
			'perennial_branding_font_variant_700' => '700',
			'perennial_branding_font_variant_800' => '800',
			'perennial_branding_font_variant_900' => '900',
		);

	} else {

		// Menu Font
		$font = perennial_mod( 'perennial_menu_font' );

		// Menu Font Variants
		$font_variants = array(
			'perennial_menu_font_variant_100' => '100',
			'perennial_menu_font_variant_200' => '200',
			'perennial_menu_font_variant_300' => '300',
			'perennial_menu_font_variant_400' => '400',
			'perennial_menu_font_variant_500' => '500',
			'perennial_menu_font_variant_600' => '600',
			'perennial_menu_font_variant_700' => '700',
			'perennial_menu_font_variant_800' => '800',
			'perennial_menu_font_variant_900' => '900',
		);

	}

	// Get Font
	$font = perennial_font( $font );

	// Font Variants Format
	$font_variants_format = '';

	// Build Font Variants
	foreach ( $font_variants as $key => $val ) {
		if ( perennial_mod( $key ) ) {
			$font_variants_format .= $val . ',';
		}
	}

	// Font Variants Validation
	if ( ! empty ( $font_variants_format ) ) {
		$font_variants_format = sprintf( '%1$s:%2$s,%3$s', urlencode( $font['name'] ), '400', rtrim( $font_variants_format, ',' )  );
	} else {
		$font_variants_format = sprintf( '%1$s', urlencode( $font['name'] ) );
	}

	return $font_variants_format;

}

/**
 * CSS Font Family Format.
 *
 * @param string $context.
 * @return string
 */
function perennial_font_family_format( $context = 'body' ) {

	// Font Context
	if ( 'headings' === $context ) {
		// Headings Font
		$font = perennial_mod( 'perennial_headings_font' );
	} else if ( 'body' === $context ) {
		// Body Font
		$font = perennial_mod( 'perennial_body_font' );
	} else if ( 'branding' === $context ) {
		// Branding Font
		$font = perennial_mod( 'perennial_branding_font' );
	} else {
		// Menu Font
		$font = perennial_mod( 'perennial_menu_font' );
	}

	// Get Font
	$font = perennial_font( $font );

	// Font Variants Format
	switch ( $font['category'] ) {

		case 'serif':
		$font_variants_format = 'serif';
		break;

		case 'sans-serif':
		$font_variants_format = 'sans-serif';
		break;

		default:
		$font_variants_format = 'cursive';
	}

	// Font Family
	$font_family = sprintf( '\'%1$s\', %2$s;', $font['name'], $font_variants_format );

	// Return
	return $font_family;

}

/**
 * Fonts format for Headings Fonts.
 *
 * @return string Fonts URL for the theme.
 */
function perennial_headings_font_enqueue_format() {

	// Get Transient
	$font_enqueue_format = get_transient( 'perennial_headings_font_enqueue_format' );

	if ( false === $font_enqueue_format || is_customize_preview() ) {
		$font_enqueue_format = perennial_font_enqueue_format( 'headings' );
	}

	return $font_enqueue_format;
}

/**
 * Fonts format for Body Fonts.
 *
 * @return string Fonts URL for the theme.
 */
function perennial_body_font_enqueue_format() {

	// Get Transient
	$font_enqueue_format = get_transient( 'perennial_body_font_enqueue_format' );

	if ( false === $font_enqueue_format || is_customize_preview() ) {
		$font_enqueue_format = perennial_font_enqueue_format( 'body' );
	}

	return $font_enqueue_format;
}

/**
 * Fonts format for Branding Fonts.
 *
 * @return string Fonts URL for the theme.
 */
function perennial_branding_font_enqueue_format() {

	// Get Transient
	$font_enqueue_format = get_transient( 'perennial_branding_font_enqueue_format' );

	if ( false === $font_enqueue_format || is_customize_preview() ) {
		$font_enqueue_format = perennial_font_enqueue_format( 'branding' );
	}

	return $font_enqueue_format;
}

/**
 * Fonts format for Menu Fonts.
 *
 * @return string Fonts URL for the theme.
 */
function perennial_menu_font_enqueue_format() {

	// Get Transient
	$font_enqueue_format = get_transient( 'perennial_menu_font_enqueue_format' );

	if ( false === $font_enqueue_format || is_customize_preview() ) {
		$font_enqueue_format = perennial_font_enqueue_format( 'nav' );
	}

	return $font_enqueue_format;
}

/**
 * Register fonts for theme.
 *
 * @return string Fonts URL for the theme.
 */
function perennial_fonts_url() {

    // Fonts and Other Variables
    $fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

    // Headings Font
	$fonts[] = urldecode( perennial_headings_font_enqueue_format() );

    // Body Font
    $fonts[] = urldecode( perennial_body_font_enqueue_format() );

    // Branding Font
    $fonts[] = urldecode( perennial_branding_font_enqueue_format() );

    // Menu Font
    $fonts[] = urldecode( perennial_menu_font_enqueue_format() );

	/* Translators: To add an additional character subset specific to your language,
	* translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'.
	* Do not translate into your own language.
	*/
	$subset = esc_html_x( 'no-subset', 'Add new subset (cyrillic, greek, devanagari, vietnamese)', 'perennial-pro' );

	if ( 'cyrillic' === $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' === $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' === $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' === $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

/**
 * Theme Headings Font Inline Style
 *
 * @return string
 */
function perennial_headings_font_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_headings_font_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		3.3 Headings
		--------------------------------------------------------------*/
		h1, h2, h3, h4, h5, h6 {
		  font-family: %1$s
		}

		/*--------------------------------------------------------------
		3.6 Dropcap
		--------------------------------------------------------------*/
		.dropcap {
		  font-family: %1$s
		}
		';

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, perennial_font_family_format( 'headings' ) ) );

	}

	return $custom_css;
}

/**
 * Theme Body Font Inline Style
 *
 * Adds inline styles to the head.
 *
 * @return string
 */
function perennial_body_font_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_body_font_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		3.1 Global
		--------------------------------------------------------------*/
		body {
		  font-family: %1$s
		}
		';

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, perennial_font_family_format( 'body' ) ) );

	}

	return $custom_css;
}

/**
 * Theme Branding Font Inline Style
 *
 * Adds inline styles to the head.
 *
 * @return string
 */
function perennial_branding_font_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_branding_font_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		8.1 Header Menu
		--------------------------------------------------------------*/
		.hamburger-wrapper .hamburger .hamburger-label {
		  font-family: %1$s
		}

		/*--------------------------------------------------------------
		10.5 Site Branding
		--------------------------------------------------------------*/
		.site-title {
		  font-family: %1$s
		}
		.site-description {
		  font-family: %1$s
		}
		';

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, perennial_font_family_format( 'branding' ) ) );

	}

	return $custom_css;
}

/**
 * Theme Menu Font Inline Style
 *
 * Adds inline styles to the head.
 *
 * @return string
 */
function perennial_menu_font_inline_style() {

	// Get Transient
	$custom_css = get_transient( 'perennial_menu_font_inline_style' );

	if ( false === $custom_css || is_customize_preview() ) {

		// Custom CSS
		$custom_css = '
		/*--------------------------------------------------------------
		8.1 Header Menu
		--------------------------------------------------------------*/
		.header-menu a, .header-menu a:visited {
		  font-family: %1$s
		}
		.header-menu ul a, .header-menu ul a:visited {
		  font-family: %1$s
		}
		';

		// Minify CSS
		$custom_css = perennial_minify_css( sprintf( $custom_css, perennial_font_family_format( 'nav' ) ) );

	}

	return $custom_css;
}

/**
 * A helper conditional function.
 * Theme has Headings Font Inline Style
 *
 * @return bool
 */
function perennial_has_headings_font_inline_style() {

	/**
	 * Headings Font Inline Style Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_headings_font_inline_style', ( perennial_default( 'perennial_headings_font' ) !== perennial_mod( 'perennial_headings_font' ) ) );

}

/**
 * A helper conditional function.
 * Theme has Body Font Inline Style
 *
 * @return bool
 */
function perennial_has_body_font_inline_style() {

	/**
	 * Body Font Inline Style Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_body_font_inline_style', ( perennial_default( 'perennial_body_font' ) !== perennial_mod( 'perennial_body_font' ) ) );

}

/**
 * A helper conditional function.
 * Theme has Branding Font Inline Style
 *
 * @return bool
 */
function perennial_has_branding_font_inline_style() {

	/**
	 * Menu Font Inline Style Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_branding_font_inline_style', ( perennial_default( 'perennial_branding_font' ) !== perennial_mod( 'perennial_branding_font' ) ) );

}

/**
 * A helper conditional function.
 * Theme has Menu Font Inline Style
 *
 * @return bool
 */
function perennial_has_menu_font_inline_style() {

	/**
	 * Menu Font Inline Style Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_menu_font_inline_style', ( perennial_default( 'perennial_menu_font' ) !== perennial_mod( 'perennial_menu_font' ) ) );

}

/**
 * Enqueues front-end Inline CSS for the theme custom fonts.
 *
 * @see wp_add_inline_style()
 */
function perennial_custom_fonts() {

	// Custom Headings Font Inline CSS
	if ( perennial_has_headings_font_inline_style() ) {
		wp_add_inline_style( 'perennial-style', perennial_headings_font_inline_style() );
	}

	// Custom Body Inline Font CSS
	if ( perennial_has_body_font_inline_style() ) {
		wp_add_inline_style( 'perennial-style', perennial_body_font_inline_style() );
	}

	// Custom Branding Inline Font CSS
	if ( perennial_has_branding_font_inline_style() ) {
		wp_add_inline_style( 'perennial-style', perennial_branding_font_inline_style() );
	}

	// Custom Menu Inline Font CSS
	if ( perennial_has_menu_font_inline_style() ) {
		wp_add_inline_style( 'perennial-style', perennial_menu_font_inline_style() );
	}

}
add_action( 'wp_enqueue_scripts', 'perennial_custom_fonts', 11 );

/**
 * Theme Custom Fonts Transients.
 *
 * @return void
 */
function perennial_custom_fonts_transients( $wp_customize_manager ) {

	// Headings Font Enqueue Format
	set_transient( 'perennial_headings_font_enqueue_format', perennial_headings_font_enqueue_format() );

	// Body Font Enqueue Format
	set_transient( 'perennial_body_font_enqueue_format', perennial_body_font_enqueue_format() );

	// Branding Font Enqueue Format
	set_transient( 'perennial_branding_font_enqueue_format', perennial_branding_font_enqueue_format() );

	// Menu Font Enqueue Format
	set_transient( 'perennial_menu_font_enqueue_format', perennial_menu_font_enqueue_format() );

	/**
	 * Inline Fonts CSS
	 */

	// Custom Inline Headings Font CSS
	if ( perennial_has_headings_font_inline_style() ) {
		set_transient( 'perennial_headings_font_inline_style', perennial_headings_font_inline_style() );
	}

	// Custom Inline Body Font CSS
	if ( perennial_has_body_font_inline_style() ) {
		set_transient( 'perennial_body_font_inline_style', perennial_body_font_inline_style() );
	}

	// Custom Inline Branding Font CSS
	if ( perennial_has_branding_font_inline_style() ) {
		set_transient( 'perennial_branding_font_inline_style', perennial_branding_font_inline_style() );
	}

	// Custom Inline Menu Font CSS
	if ( perennial_has_menu_font_inline_style() ) {
		set_transient( 'perennial_menu_font_inline_style', perennial_menu_font_inline_style() );
	}

}
add_action( 'customize_save_after', 'perennial_custom_fonts_transients' );
