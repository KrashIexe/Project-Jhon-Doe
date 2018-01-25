<?php
/**
 * Perennial Theme Customizer
 *
 * @see https://poststatus.com/customize-wordpress-theme-customizer/
 * @package Perennial
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function perennial_customize_register ( $wp_customize ) {

	// Custom Labels
	$wp_customize->get_control( 'header_textcolor' )->label     = esc_html__( 'Site Title & Tagline Text Color', 'perennial-pro' );

	// Custom Transport
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Theme Options Panel
	 */
	$wp_customize->add_panel( 'perennial_theme_options', array(
	    'title'     => esc_html__( 'Theme Options', 'perennial-pro' ),
	    'priority'  => 1,
	) );

	/**
	 * General Options Section
	 */
	$wp_customize->add_section( 'perennial_general_options', array (
		'title'     => esc_html__( 'General Options', 'perennial-pro' ),
		'panel'     => 'perennial_theme_options',
		'priority'  => 10,
		'description' => esc_html__( 'Personalize the settings of your theme.', 'perennial-pro' ),
	) );

	// Sticky Menu Control
	$wp_customize->add_setting ( 'perennial_sticky_menu', array (
		'default'           => perennial_default( 'perennial_sticky_menu' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_sticky_menu', array (
		'label'    => esc_html__( 'Enable Sticky Menu', 'perennial-pro' ),
		'section'  => 'perennial_general_options',
		'priority' => 1,
		'type'     => 'checkbox',
	) );

	// Custom Header Title
	$wp_customize->add_setting ( 'perennial_custom_header_title', array (
		'default'           => perennial_default( 'perennial_custom_header_title' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control ( 'perennial_custom_header_title', array (
		'label'           => esc_html__( 'Custom Header Title', 'perennial-pro' ),
		'section'         => 'perennial_general_options',
		'priority'        => 2,
		'type'            => 'text',
		'active_callback' => 'perennial_custom_header_active_callback',
	) );

	// Custom Header Summary
	$wp_customize->add_setting ( 'perennial_custom_header_summary', array (
		'default'           => perennial_default( 'perennial_custom_header_summary' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control ( 'perennial_custom_header_summary', array (
		'label'           => esc_html__( 'Custom Header Summary', 'perennial-pro' ),
		'section'         => 'perennial_general_options',
		'priority'        => 3,
		'type'            => 'textarea',
		'active_callback' => 'perennial_custom_header_active_callback',
	) );

	/**
	 * Site Hero Options Section
	 */
	$wp_customize->add_section( 'perennial_site_hero_options', array (
		'title'     => esc_html__( 'Site Hero Options', 'perennial-pro' ),
		'panel'     => 'perennial_theme_options',
		'priority'  => 20,
		'description' => esc_html__( 'Site hero settings of your theme.', 'perennial-pro' ),
	) );

	// Site Hero Post of All Types Control
	$wp_customize->add_setting ( 'perennial_site_hero_post_global', array (
		'default'           => perennial_default( 'perennial_site_hero_post_global' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_site_hero_post_global', array (
		'label'    => esc_html__( 'Enable Site Hero at Single Blog Post of All Post Types (if has featured image)', 'perennial-pro' ),
		'section'  => 'perennial_site_hero_options',
		'priority' => 1,
		'type'     => 'checkbox',
	) );

	// Site Hero Post Control
	$wp_customize->add_setting ( 'perennial_site_hero_post', array (
		'default'           => perennial_default( 'perennial_site_hero_post' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_site_hero_post', array (
		'label'    => esc_html__( 'Enable Site Hero at Single Blog Post (if has featured image)', 'perennial-pro' ),
		'section'  => 'perennial_site_hero_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	// Site Hero Page Control
	$wp_customize->add_setting ( 'perennial_site_hero_page', array (
		'default'           => perennial_default( 'perennial_site_hero_page' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_site_hero_page', array (
		'label'    => esc_html__( 'Enable Site Hero at Single Blog Page (if has featured image)', 'perennial-pro' ),
		'section'  => 'perennial_site_hero_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );

	// Site Hero Jetpack Portfolio Post Control
	$wp_customize->add_setting ( 'perennial_site_hero_jetpack_portfolio', array (
		'default'           => perennial_default( 'perennial_site_hero_jetpack_portfolio' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_site_hero_jetpack_portfolio', array (
		'label'    => esc_html__( 'Enable Site Hero at Single Portfolio Post (if has featured image)', 'perennial-pro' ),
		'section'  => 'perennial_site_hero_options',
		'priority' => 4,
		'type'     => 'checkbox',
	) );

	/**
	 * Skin Section
	 */
	$wp_customize->add_section( 'perennial_skin_options', array (
		'title'       => esc_html__( 'Skin Options', 'perennial-pro' ),
		'panel'       => 'perennial_theme_options',
		'priority'    => 30,
		'description' => esc_html__( 'Personalize the skin of your theme.', 'perennial-pro' ),
	) );

	// Primary Color
	$wp_customize->add_setting ( 'perennial_primary_color', array (
		'default'           =>  perennial_default( 'perennial_primary_color' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control (
		new WP_Customize_Color_Control (
	        $wp_customize,
	        'perennial_primary_color',
	        array(
				'label'       => esc_html__( 'Primary Color', 'perennial-pro' ),
				'description' => esc_html__( 'It includes content links, featured image backfill, form buttons and some other areas.', 'perennial-pro' ),
				'section'     => 'perennial_skin_options',
				'priority'    => 1,
	        )
	    )
	);

	// Secondary Color
	$wp_customize->add_setting ( 'perennial_secondary_color', array (
		'default'           =>  perennial_default( 'perennial_secondary_color' ),
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control (
		new WP_Customize_Color_Control (
	        $wp_customize,
	        'perennial_secondary_color',
	        array(
				'label'       => esc_html__( 'Secondary Color', 'perennial-pro' ),
				'description' => esc_html__( 'It includes content hover links and mostly hover effect on other elements.', 'perennial-pro' ),
				'section'     => 'perennial_skin_options',
				'priority'    => 2,
	        )
	    )
	);

	// Card Background Color
	$wp_customize->add_setting ( 'perennial_content_card_bg_color', array (
		'default'           =>  perennial_default( 'perennial_content_card_bg_color' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control (
		new WP_Customize_Color_Control (
	        $wp_customize,
	        'perennial_content_card_bg_color',
	        array(
				'label'       => esc_html__( 'Content Card Background Color', 'perennial-pro' ),
				'description' => esc_html__( 'It includes content card/box of archive/single pages.', 'perennial-pro' ),
				'section'     => 'perennial_skin_options',
				'priority'    => 3,
	        )
	    )
	);

	// Footer Widgets Background Color
	$wp_customize->add_setting ( 'perennial_footer_widgets_bg_color', array (
		'default'           =>  perennial_default( 'perennial_footer_widgets_bg_color' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control (
		new WP_Customize_Color_Control (
	        $wp_customize,
	        'perennial_footer_widgets_bg_color',
	        array(
				'label'       => esc_html__( 'Footer Widgets Background Color', 'perennial-pro' ),
				'description' => esc_html__( 'It includes footer having widgets.', 'perennial-pro' ),
				'section'     => 'perennial_skin_options',
				'priority'    => 4,
	        )
	    )
	);

	// Footer Social Menu Background Color
	$wp_customize->add_setting ( 'perennial_footer_social_bg_color', array (
		'default'           =>  perennial_default( 'perennial_footer_social_bg_color' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control (
		new WP_Customize_Color_Control (
	        $wp_customize,
	        'perennial_footer_social_bg_color',
	        array(
				'label'       => esc_html__( 'Footer Social Background Color', 'perennial-pro' ),
				'description' => esc_html__( 'It includes footer having social menu.', 'perennial-pro' ),
				'section'     => 'perennial_skin_options',
				'priority'    => 5,
	        )
	    )
	);

	// Footer Info Menu Background Color
	$wp_customize->add_setting ( 'perennial_footer_info_bg_color', array (
		'default'           =>  perennial_default( 'perennial_footer_info_bg_color' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control (
		new WP_Customize_Color_Control (
	        $wp_customize,
	        'perennial_footer_info_bg_color',
	        array(
				'label'       => esc_html__( 'Footer Info Background Color', 'perennial-pro' ),
				'description' => esc_html__( 'It includes footer having credits and menu.', 'perennial-pro' ),
				'section'     => 'perennial_skin_options',
				'priority'    => 6,
	        )
	    )
	);

	/**
	 * Headings Fonts Section
	 */
	$wp_customize->add_section( 'perennial_headings_fonts_options', array (
		'title'       => esc_html__( 'Headings Fonts Options', 'perennial-pro' ),
		'panel'       => 'perennial_theme_options',
		'priority'    => 40,
		'description' => sprintf( esc_html_x( 'Personalize headings typography with %s popular Google fonts.', 'Headings Fonts Description', 'perennial-pro' ), count( perennial_fonts_library() ) ),
	) );

	// Headings Font
	$wp_customize->add_setting ( 'perennial_headings_font', array (
		'default'           => perennial_default( 'perennial_headings_font' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_font',
	) );

	$wp_customize->add_control (
		new Perennial_WP_Customize_Control_Fonts (
	        $wp_customize,
	        'perennial_headings_font',
	        array(
				'label'    => sprintf( esc_html_x( 'Headings Font (%s)', 'Headings Font', 'perennial-pro' ), perennial_font( perennial_default( 'perennial_headings_font' ), 'name' ) ),
				'section' => 'perennial_headings_fonts_options',
				'priority' => 1,
				'type'     => 'perennial_fonts',
	        )
	    )
	);

	// Headings Font Variant 100 Control
	$wp_customize->add_setting ( 'perennial_headings_font_variant_100', array (
		'default'           => perennial_default( 'perennial_headings_font_variant_100' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_headings_font_variant_100', array (
		'label'    => esc_html__( 'Add Thin Font Weight - 100', 'perennial-pro' ),
		'section'  => 'perennial_headings_fonts_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	// Headings Font Variant 200 Control
	$wp_customize->add_setting ( 'perennial_headings_font_variant_200', array (
		'default'           => perennial_default( 'perennial_headings_font_variant_200' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_headings_font_variant_200', array (
		'label'    => esc_html__( 'Add Extra Light Font Weight - 200', 'perennial-pro' ),
		'section'  => 'perennial_headings_fonts_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );


	// Headings Font Variant 300 Control
	$wp_customize->add_setting ( 'perennial_headings_font_variant_300', array (
		'default'           => perennial_default( 'perennial_headings_font_variant_300' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_headings_font_variant_300', array (
		'label'    => esc_html__( 'Add Light Font Weight - 300', 'perennial-pro' ),
		'section'  => 'perennial_headings_fonts_options',
		'priority' => 4,
		'type'     => 'checkbox',
	) );

	// Headings Font Variant 500 Control
	$wp_customize->add_setting ( 'perennial_headings_font_variant_500', array (
		'default'           => perennial_default( 'perennial_headings_font_variant_500' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_headings_font_variant_500', array (
		'label'    => esc_html__( 'Add Medium Font Weight - 500', 'perennial-pro' ),
		'section'  => 'perennial_headings_fonts_options',
		'priority' => 5,
		'type'     => 'checkbox',
	) );

	// Headings Font Variant 600 Control
	$wp_customize->add_setting ( 'perennial_headings_font_variant_600', array (
		'default'           => perennial_default( 'perennial_headings_font_variant_600' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_headings_font_variant_600', array (
		'label'    => esc_html__( 'Add Semi Bold Font Weight - 600', 'perennial-pro' ),
		'section'  => 'perennial_headings_fonts_options',
		'priority' => 6,
		'type'     => 'checkbox',
	) );

	// Headings Font Variant 700 Control
	$wp_customize->add_setting ( 'perennial_headings_font_variant_700', array (
		'default'           => perennial_default( 'perennial_headings_font_variant_700' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_headings_font_variant_700', array (
		'label'    => esc_html__( 'Add Bold Font Weight - 700', 'perennial-pro' ),
		'section'  => 'perennial_headings_fonts_options',
		'priority' => 7,
		'type'     => 'checkbox',
	) );

	// Headings Font Variant 800 Control
	$wp_customize->add_setting ( 'perennial_headings_font_variant_800', array (
		'default'           => perennial_default( 'perennial_headings_font_variant_800' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_headings_font_variant_800', array (
		'label'    => esc_html__( 'Add Extra Bold Font Weight - 800', 'perennial-pro' ),
		'section'  => 'perennial_headings_fonts_options',
		'priority' => 8,
		'type'     => 'checkbox',
	) );

	// Headings Font Variant 900 Control
	$wp_customize->add_setting ( 'perennial_headings_font_variant_900', array (
		'default'           => perennial_default( 'perennial_headings_font_variant_900' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_headings_font_variant_900', array (
		'label'    => esc_html__( 'Add Black Font Weight - 900', 'perennial-pro' ),
		'section'  => 'perennial_headings_fonts_options',
		'priority' => 9,
		'type'     => 'checkbox',
	) );

	/**
	 * Body Fonts Section
	 */
	$wp_customize->add_section( 'perennial_body_fonts_options', array (
		'title'       => esc_html__( 'Body Fonts Options', 'perennial-pro' ),
		'panel'       => 'perennial_theme_options',
		'priority'    => 50,
		'description' => sprintf( esc_html_x( 'Personalize body typography with %s popular Google fonts.', 'Body Fonts Description', 'perennial-pro' ), count( perennial_fonts_library() ) ),
	) );

	// Body Font
	$wp_customize->add_setting ( 'perennial_body_font', array (
		'default'           => perennial_default( 'perennial_body_font' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_font',
	) );

	$wp_customize->add_control (
		new Perennial_WP_Customize_Control_Fonts (
	        $wp_customize,
	        'perennial_body_font',
	        array(
				'label'    => sprintf( esc_html_x( 'Body Font (%s)', 'Body Font', 'perennial-pro' ), perennial_font( perennial_default( 'perennial_body_font' ), 'name' ) ),
				'section' => 'perennial_body_fonts_options',
				'priority' => 1,
				'type'     => 'perennial_fonts',
	        )
	    )
	);

	// Body Font Variant 100 Control
	$wp_customize->add_setting ( 'perennial_body_font_variant_100', array (
		'default'           => perennial_default( 'perennial_body_font_variant_100' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_body_font_variant_100', array (
		'label'    => esc_html__( 'Add Thin Font Weight - 100', 'perennial-pro' ),
		'section'  => 'perennial_body_fonts_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	// Body Font Variant 200 Control
	$wp_customize->add_setting ( 'perennial_body_font_variant_200', array (
		'default'           => perennial_default( 'perennial_body_font_variant_200' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_body_font_variant_200', array (
		'label'    => esc_html__( 'Add Extra Light Font Weight - 200', 'perennial-pro' ),
		'section'  => 'perennial_body_fonts_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );


	// Body Font Variant 300 Control
	$wp_customize->add_setting ( 'perennial_body_font_variant_300', array (
		'default'           => perennial_default( 'perennial_body_font_variant_300' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_body_font_variant_300', array (
		'label'    => esc_html__( 'Add Light Font Weight - 300', 'perennial-pro' ),
		'section'  => 'perennial_body_fonts_options',
		'priority' => 4,
		'type'     => 'checkbox',
	) );

	// Body Font Variant 500 Control
	$wp_customize->add_setting ( 'perennial_body_font_variant_500', array (
		'default'           => perennial_default( 'perennial_body_font_variant_500' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_body_font_variant_500', array (
		'label'    => esc_html__( 'Add Medium Font Weight - 500', 'perennial-pro' ),
		'section'  => 'perennial_body_fonts_options',
		'priority' => 5,
		'type'     => 'checkbox',
	) );

	// Body Font Variant 600 Control
	$wp_customize->add_setting ( 'perennial_body_font_variant_600', array (
		'default'           => perennial_default( 'perennial_body_font_variant_600' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_body_font_variant_600', array (
		'label'    => esc_html__( 'Add Semi Bold Font Weight - 600', 'perennial-pro' ),
		'section'  => 'perennial_body_fonts_options',
		'priority' => 6,
		'type'     => 'checkbox',
	) );

	// Body Font Variant 700 Control
	$wp_customize->add_setting ( 'perennial_body_font_variant_700', array (
		'default'           => perennial_default( 'perennial_body_font_variant_700' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_body_font_variant_700', array (
		'label'    => esc_html__( 'Add Bold Font Weight - 700', 'perennial-pro' ),
		'section'  => 'perennial_body_fonts_options',
		'priority' => 7,
		'type'     => 'checkbox',
	) );

	// Body Font Variant 800 Control
	$wp_customize->add_setting ( 'perennial_body_font_variant_800', array (
		'default'           => perennial_default( 'perennial_body_font_variant_800' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_body_font_variant_800', array (
		'label'    => esc_html__( 'Add Extra Bold Font Weight - 800', 'perennial-pro' ),
		'section'  => 'perennial_body_fonts_options',
		'priority' => 8,
		'type'     => 'checkbox',
	) );

	// Body Font Variant 900 Control
	$wp_customize->add_setting ( 'perennial_body_font_variant_900', array (
		'default'           => perennial_default( 'perennial_body_font_variant_900' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_body_font_variant_900', array (
		'label'    => esc_html__( 'Add Black Font Weight - 900', 'perennial-pro' ),
		'section'  => 'perennial_body_fonts_options',
		'priority' => 9,
		'type'     => 'checkbox',
	) );

	/**
	 * Branding Fonts Section
	 */
	$wp_customize->add_section( 'perennial_branding_fonts_options', array (
		'title'       => esc_html__( 'Branding Fonts Options', 'perennial-pro' ),
		'panel'       => 'perennial_theme_options',
		'priority'    => 60,
		'description' => sprintf( esc_html_x( 'Personalize branding typography with %s popular Google fonts. It includes site title, tagline and menu label.', 'Branding Fonts Description', 'perennial-pro' ), count( perennial_fonts_library() ) ),
	) );

	// Branding Font
	$wp_customize->add_setting ( 'perennial_branding_font', array (
		'default'           => perennial_default( 'perennial_branding_font' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_font',
	) );

	$wp_customize->add_control (
		new Perennial_WP_Customize_Control_Fonts (
	        $wp_customize,
	        'perennial_branding_font',
	        array(
				'label'       => sprintf( esc_html_x( 'Branding Font (%s)', 'Branding Font', 'perennial-pro' ), perennial_font( perennial_default( 'perennial_branding_font' ), 'name' ) ),
				'section'     => 'perennial_branding_fonts_options',
				'priority'    => 1,
				'type'        => 'perennial_fonts',
	        )
	    )
	);

	// Branding Font Variant 100 Control
	$wp_customize->add_setting ( 'perennial_branding_font_variant_100', array (
		'default'           => perennial_default( 'perennial_branding_font_variant_100' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_branding_font_variant_100', array (
		'label'    => esc_html__( 'Add Thin Font Weight - 100', 'perennial-pro' ),
		'section'  => 'perennial_branding_fonts_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	// Branding Font Variant 200 Control
	$wp_customize->add_setting ( 'perennial_branding_font_variant_200', array (
		'default'           => perennial_default( 'perennial_branding_font_variant_200' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_branding_font_variant_200', array (
		'label'    => esc_html__( 'Add Extra Light Font Weight - 200', 'perennial-pro' ),
		'section'  => 'perennial_branding_fonts_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );


	// Branding Font Variant 300 Control
	$wp_customize->add_setting ( 'perennial_branding_font_variant_300', array (
		'default'           => perennial_default( 'perennial_branding_font_variant_300' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_branding_font_variant_300', array (
		'label'    => esc_html__( 'Add Light Font Weight - 300', 'perennial-pro' ),
		'section'  => 'perennial_branding_fonts_options',
		'priority' => 4,
		'type'     => 'checkbox',
	) );

	// Branding Font Variant 500 Control
	$wp_customize->add_setting ( 'perennial_branding_font_variant_500', array (
		'default'           => perennial_default( 'perennial_branding_font_variant_500' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_branding_font_variant_500', array (
		'label'    => esc_html__( 'Add Medium Font Weight - 500', 'perennial-pro' ),
		'section'  => 'perennial_branding_fonts_options',
		'priority' => 5,
		'type'     => 'checkbox',
	) );

	// Branding Font Variant 600 Control
	$wp_customize->add_setting ( 'perennial_branding_font_variant_600', array (
		'default'           => perennial_default( 'perennial_branding_font_variant_600' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_branding_font_variant_600', array (
		'label'    => esc_html__( 'Add Semi Bold Font Weight - 600', 'perennial-pro' ),
		'section'  => 'perennial_branding_fonts_options',
		'priority' => 6,
		'type'     => 'checkbox',
	) );

	// Branding Font Variant 700 Control
	$wp_customize->add_setting ( 'perennial_branding_font_variant_700', array (
		'default'           => perennial_default( 'perennial_branding_font_variant_700' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_branding_font_variant_700', array (
		'label'    => esc_html__( 'Add Bold Font Weight - 700', 'perennial-pro' ),
		'section'  => 'perennial_branding_fonts_options',
		'priority' => 7,
		'type'     => 'checkbox',
	) );

	// Branding Font Variant 800 Control
	$wp_customize->add_setting ( 'perennial_branding_font_variant_800', array (
		'default'           => perennial_default( 'perennial_branding_font_variant_800' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_branding_font_variant_800', array (
		'label'    => esc_html__( 'Add Extra Bold Font Weight - 800', 'perennial-pro' ),
		'section'  => 'perennial_branding_fonts_options',
		'priority' => 8,
		'type'     => 'checkbox',
	) );

	// Branding Font Variant 900 Control
	$wp_customize->add_setting ( 'perennial_branding_font_variant_900', array (
		'default'           => perennial_default( 'perennial_branding_font_variant_900' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_branding_font_variant_900', array (
		'label'    => esc_html__( 'Add Black Font Weight - 900', 'perennial-pro' ),
		'section'  => 'perennial_branding_fonts_options',
		'priority' => 9,
		'type'     => 'checkbox',
	) );

	/**
	 * Menu Fonts Section
	 */
	$wp_customize->add_section( 'perennial_menu_fonts_options', array (
		'title'       => esc_html__( 'Menu Fonts Options', 'perennial-pro' ),
		'panel'       => 'perennial_theme_options',
		'priority'    => 70,
		'description' => sprintf( esc_html_x( 'Personalize menu typography with %s popular Google fonts.', 'Menu Fonts Description', 'perennial-pro' ), count( perennial_fonts_library() ) ),
	) );

	// Menu Font
	$wp_customize->add_setting ( 'perennial_menu_font', array (
		'default'           => perennial_default( 'perennial_menu_font' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_font',
	) );

	$wp_customize->add_control (
		new Perennial_WP_Customize_Control_Fonts (
	        $wp_customize,
	        'perennial_menu_font',
	        array(
				'label'    => sprintf( esc_html_x( 'Menu Font (%s)', 'Menu Font', 'perennial-pro' ), perennial_font( perennial_default( 'perennial_menu_font' ), 'name' ) ),
				'section' => 'perennial_menu_fonts_options',
				'priority' => 1,
				'type'     => 'perennial_fonts',
	        )
	    )
	);

	// Menu Font Variant 100 Control
	$wp_customize->add_setting ( 'perennial_menu_font_variant_100', array (
		'default'           => perennial_default( 'perennial_menu_font_variant_100' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_menu_font_variant_100', array (
		'label'    => esc_html__( 'Add Thin Font Weight - 100', 'perennial-pro' ),
		'section'  => 'perennial_menu_fonts_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	// Menu Font Variant 200 Control
	$wp_customize->add_setting ( 'perennial_menu_font_variant_200', array (
		'default'           => perennial_default( 'perennial_menu_font_variant_200' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_menu_font_variant_200', array (
		'label'    => esc_html__( 'Add Extra Light Font Weight - 200', 'perennial-pro' ),
		'section'  => 'perennial_menu_fonts_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );


	// Menu Font Variant 300 Control
	$wp_customize->add_setting ( 'perennial_menu_font_variant_300', array (
		'default'           => perennial_default( 'perennial_menu_font_variant_300' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_menu_font_variant_300', array (
		'label'    => esc_html__( 'Add Light Font Weight - 300', 'perennial-pro' ),
		'section'  => 'perennial_menu_fonts_options',
		'priority' => 4,
		'type'     => 'checkbox',
	) );

	// Menu Font Variant 500 Control
	$wp_customize->add_setting ( 'perennial_menu_font_variant_500', array (
		'default'           => perennial_default( 'perennial_menu_font_variant_500' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_menu_font_variant_500', array (
		'label'    => esc_html__( 'Add Medium Font Weight - 500', 'perennial-pro' ),
		'section'  => 'perennial_menu_fonts_options',
		'priority' => 5,
		'type'     => 'checkbox',
	) );

	// Menu Font Variant 600 Control
	$wp_customize->add_setting ( 'perennial_menu_font_variant_600', array (
		'default'           => perennial_default( 'perennial_menu_font_variant_600' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_menu_font_variant_600', array (
		'label'    => esc_html__( 'Add Semi Bold Font Weight - 600', 'perennial-pro' ),
		'section'  => 'perennial_menu_fonts_options',
		'priority' => 6,
		'type'     => 'checkbox',
	) );

	// Menu Font Variant 700 Control
	$wp_customize->add_setting ( 'perennial_menu_font_variant_700', array (
		'default'           => perennial_default( 'perennial_menu_font_variant_700' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_menu_font_variant_700', array (
		'label'    => esc_html__( 'Add Bold Font Weight - 700', 'perennial-pro' ),
		'section'  => 'perennial_menu_fonts_options',
		'priority' => 7,
		'type'     => 'checkbox',
	) );

	// Menu Font Variant 800 Control
	$wp_customize->add_setting ( 'perennial_menu_font_variant_800', array (
		'default'           => perennial_default( 'perennial_menu_font_variant_800' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_menu_font_variant_800', array (
		'label'    => esc_html__( 'Add Extra Bold Font Weight - 800', 'perennial-pro' ),
		'section'  => 'perennial_menu_fonts_options',
		'priority' => 8,
		'type'     => 'checkbox',
	) );

	// Menu Font Variant 900 Control
	$wp_customize->add_setting ( 'perennial_menu_font_variant_900', array (
		'default'           => perennial_default( 'perennial_menu_font_variant_900' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_menu_font_variant_900', array (
		'label'    => esc_html__( 'Add Black Font Weight - 900', 'perennial-pro' ),
		'section'  => 'perennial_menu_fonts_options',
		'priority' => 9,
		'type'     => 'checkbox',
	) );

	/**
	 * Ads Section
	 */
	$wp_customize->add_section( 'perennial_ad_options', array (
		'title'       => esc_html__( 'Ad Options', 'perennial-pro' ),
		'panel'       => 'perennial_theme_options',
		'priority'    => 80,
		'description' => esc_html__( 'Personalize the Ad settings of your theme.', 'perennial-pro' ),
	) );

	// Ad Post Content Before
	$wp_customize->add_setting ( 'perennial_ad_post_content_before', array (
		'default'           => perennial_default( 'perennial_ad_post_content_before' ),
		'sanitize_callback' => 'perennial_sanitize_unfiltered_html',
	) );

	$wp_customize->add_control ( 'perennial_ad_post_content_before', array (
		'label'       => esc_html__( 'Ad Code', 'perennial-pro' ),
		'description' => esc_html__( 'This code will output before the post content in the single post or page.', 'perennial-pro' ),
		'section'     => 'perennial_ad_options',
		'priority'    => 1,
		'type'        => 'textarea',
	) );

	// Ad Post Content After
	$wp_customize->add_setting ( 'perennial_ad_post_content_after', array (
		'default'           => perennial_default( 'perennial_ad_post_content_after' ),
		'sanitize_callback' => 'perennial_sanitize_unfiltered_html',
	) );

	$wp_customize->add_control ( 'perennial_ad_post_content_after', array (
		'label'       => esc_html__( 'Ad Code', 'perennial-pro' ),
		'description' => esc_html__( 'This code will output after the post content in the single post or page.', 'perennial-pro' ),
		'section'     => 'perennial_ad_options',
		'priority'    => 2,
		'type'        => 'textarea',
	) );

	// Ad Post of All Post Types Control
	$wp_customize->add_setting ( 'perennial_ad_post_global', array (
		'default'           => perennial_default( 'perennial_ad_post_global' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_ad_post_global', array (
		'label'    => esc_html__( 'Enable Ad at Single Blog Post of All Post Types', 'perennial-pro' ),
		'section'  => 'perennial_ad_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );

	// Ad Post Control
	$wp_customize->add_setting ( 'perennial_ad_post', array (
		'default'           => perennial_default( 'perennial_ad_post' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_ad_post', array (
		'label'    => esc_html__( 'Enable Ad at Single Blog Post', 'perennial-pro' ),
		'section'  => 'perennial_ad_options',
		'priority' => 4,
		'type'     => 'checkbox',
	) );

	// Ad Page Control
	$wp_customize->add_setting ( 'perennial_ad_page', array (
		'default'           => perennial_default( 'perennial_ad_page' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_ad_page', array (
		'label'    => esc_html__( 'Enable Ad at Single Blog Page', 'perennial-pro' ),
		'section'  => 'perennial_ad_options',
		'priority' => 5,
		'type'     => 'checkbox',
	) );

	// Ad Portfolio Control
	$wp_customize->add_setting ( 'perennial_ad_portfolio', array (
		'default'           => perennial_default( 'perennial_ad_portfolio' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_ad_portfolio', array (
		'label'    => esc_html__( 'Enable Ad at Single Portfolio Post', 'perennial-pro' ),
		'section'  => 'perennial_ad_options',
		'priority' => 6,
		'type'     => 'checkbox',
	) );

	/**
	 * WooCommerce Section
	 */
	$wp_customize->add_section( 'perennial_woocommerce_options', array (
		'title'       => esc_html__( 'WooCommerce Options', 'perennial-pro' ),
		'panel'       => 'perennial_theme_options',
		'priority'    => 90,
		'description' => esc_html__( 'Personalize the WooCommerce settings of your theme.', 'perennial-pro' ),
	) );

	// WooCommerce Control
	$wp_customize->add_setting ( 'perennial_woocommerce', array (
		'default'           => perennial_default( 'perennial_woocommerce' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_woocommerce', array (
		'label'    => esc_html__( 'Enable WooCommerce Support', 'perennial-pro' ),
		'section'  => 'perennial_woocommerce_options',
		'priority' => 1,
		'type'     => 'checkbox',
	) );

	// WooCommerce Archive Sidebar Control
	$wp_customize->add_setting ( 'perennial_woocommerce_archive_sidebar', array (
		'default'           => perennial_default( 'perennial_woocommerce_archive_sidebar' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_woocommerce_archive_sidebar', array (
		'label'    => esc_html__( 'Show Shop Sidebar at WooCommerce Shop and Archive Pages', 'perennial-pro' ),
		'section'  => 'perennial_woocommerce_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	// WooCommerce Product Sidebar Control
	$wp_customize->add_setting ( 'perennial_woocommerce_product_sidebar', array (
		'default'           => perennial_default( 'perennial_woocommerce_product_sidebar' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_woocommerce_product_sidebar', array (
		'label'    => esc_html__( 'Show Shop Sidebar at WooCommerce Product Page', 'perennial-pro' ),
		'section'  => 'perennial_woocommerce_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );

	// WooCommerce Site Hero Post Control
	$wp_customize->add_setting ( 'perennial_woocommerce_site_hero_post', array (
		'default'           => perennial_default( 'perennial_woocommerce_site_hero_post' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_woocommerce_site_hero_post', array (
		'label'    => esc_html__( 'Enable Site Hero at WooCommerce Product Page (if has product image)', 'perennial-pro' ),
		'section'  => 'perennial_woocommerce_options',
		'priority' => 4,
		'type'     => 'checkbox',
	) );

	// Ad WooCommerce Product Page Control (Post Type: Post)
	$wp_customize->add_setting ( 'perennial_woocommerce_ad_post', array (
		'default'           => perennial_default( 'perennial_woocommerce_ad_post' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_woocommerce_ad_post', array (
		'label'    => esc_html__( 'Enable Ad at WooCommerce Product Page', 'perennial-pro' ),
		'section'  => 'perennial_woocommerce_options',
		'priority' => 5,
		'type'     => 'checkbox',
	) );

	// Ad WooCommerce Shortcode Page Control (Post Type: Page)
	$wp_customize->add_setting ( 'perennial_woocommerce_ad_page', array (
		'default'           => perennial_default( 'perennial_woocommerce_ad_page' ),
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_woocommerce_ad_page', array (
		'label'    => esc_html__( 'Enable Ad at WooCommerce Page(s) having WooCommerce Sidebar Page Template.', 'perennial-pro' ),
		'section'  => 'perennial_woocommerce_options',
		'priority' => 6,
		'type'     => 'checkbox',
	) );

	/**
	 * Footer Section
	 */
	$wp_customize->add_section( 'perennial_footer_options', array (
		'title'       => esc_html__( 'Footer Options', 'perennial-pro' ),
		'panel'       => 'perennial_theme_options',
		'priority'    => 100,
		'description' => esc_html__( 'Personalize the footer settings of your theme.', 'perennial-pro' ),
	) );

	// Copyright Control
	$wp_customize->add_setting ( 'perennial_copyright', array (
		'default'           => perennial_default( 'perennial_copyright' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control ( 'perennial_copyright', array (
		'label'    => esc_html__( 'Copyright', 'perennial-pro' ),
		'section'  => 'perennial_footer_options',
		'priority' => 1,
		'type'     => 'textarea',
	) );

	// Credit Control
	$wp_customize->add_setting ( 'perennial_credit', array (
		'default'           => perennial_default( 'perennial_credit' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_credit', array (
		'label'    => esc_html__( 'Display Designer Credit', 'perennial-pro' ),
		'section'  => 'perennial_footer_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	/**
	 * Utility Section
	 */
	$wp_customize->add_section( 'perennial_utility_options', array (
		'title'       => esc_html__( 'Utility Options', 'perennial-pro' ),
		'panel'       => 'perennial_theme_options',
		'priority'    => 110,
		'description' => esc_html__( 'Utility settings of your theme.', 'perennial-pro' ),
	) );

	// Header Scripts
	$wp_customize->add_setting ( 'perennial_header_scripts', array (
		'default'           => perennial_default( 'perennial_header_scripts' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_unfiltered_html',
	) );

	$wp_customize->add_control ( 'perennial_header_scripts', array (
		'label'       => esc_html__( 'Header Scripts', 'perennial-pro' ),
		'description' => esc_html__( 'This code will output immediately before the closing </head> tag in the document source.', 'perennial-pro' ),
		'section'     => 'perennial_utility_options',
		'priority'    => 1,
		'type'        => 'textarea',
	) );

	// Footer Scripts
	$wp_customize->add_setting ( 'perennial_footer_scripts', array (
		'default'           => perennial_default( 'perennial_footer_scripts' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_unfiltered_html',
	) );

	$wp_customize->add_control ( 'perennial_footer_scripts', array (
		'label'       => esc_html__( 'Footer Scripts', 'perennial-pro' ),
		'description' => esc_html__( 'This code will output immediately before the closing </body> tag in the document source.', 'perennial-pro' ),
		'section'     => 'perennial_utility_options',
		'priority'    => 2,
		'type'        => 'textarea',
	) );

	// Header Scripts Control
	$wp_customize->add_setting ( 'perennial_header_scripts_control', array (
		'default'           => perennial_default( 'perennial_header_scripts_control' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_header_scripts_control', array (
		'label'    => esc_html__( 'Enable Header scripts', 'perennial-pro' ),
		'section'  => 'perennial_utility_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );

	// Footer Scripts Control
	$wp_customize->add_setting ( 'perennial_footer_scripts_control', array (
		'default'           => perennial_default( 'perennial_footer_scripts_control' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_footer_scripts_control', array (
		'label'    => esc_html__( 'Enable Footer scripts', 'perennial-pro' ),
		'section'  => 'perennial_utility_options',
		'priority' => 4,
		'type'     => 'checkbox',
	) );

	// SVG Upload Control
	$wp_customize->add_setting ( 'perennial_svg_mime', array (
		'default'           => perennial_default( 'perennial_svg_mime' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_svg_mime', array (
		'label'    => esc_html__( 'Enable SVG upload support', 'perennial-pro' ),
		'section'  => 'perennial_utility_options',
		'priority' => 5,
		'type'     => 'checkbox',
	) );

	// Scripts Version Param Control
	$wp_customize->add_setting ( 'perennial_ver_param', array (
		'default'           => perennial_default( 'perennial_ver_param' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'perennial_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'perennial_ver_param', array (
		'label'    => esc_html__( 'Remove version parameter from enqueued styles and scripts', 'perennial-pro' ),
		'section'  => 'perennial_utility_options',
		'priority' => 6,
		'type'     => 'checkbox',
	) );

}
add_action( 'customize_register', 'perennial_customize_register' );

/**
 * Active callback for Custom Header
 *
 * @return bool Whether the header image is available in the absence of featured content.
 */
function perennial_custom_header_active_callback() {
	return ( ( perennial_has_custom_header() && ! perennial_has_featured_content() ) ? true : false );
}

/**
 * Sanitize Select.
 *
 * @param string $input Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function perennial_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize the checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function perennial_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize Font
 *
 * @param string $font.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Filtered font.
 */
function perennial_sanitize_font( $font, $setting ) {
	return ( array_key_exists( $font, perennial_fonts_library() ) ? $font : $setting->default );
}

/**
 * Sanitize Unfiltered HTML.
 *
 * @param string $html HTML to sanitize.
 * @return string Sanitized HTML.
 */
function perennial_sanitize_unfiltered_html( $html ) {
	return ( current_user_can( 'unfiltered_html' ) ? $html : wp_kses_post( $html ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function perennial_customize_preview_js() {
	wp_enqueue_script( 'jquery-color' );
	wp_enqueue_script( 'perennial_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140120', true );
}
add_action( 'customize_preview_init', 'perennial_customize_preview_js' );
