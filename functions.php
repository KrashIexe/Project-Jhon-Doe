<?php
/**
 * Perennial functions and definitions
 *
 * @package Perennial
 */

if ( ! function_exists( 'perennial_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function perennial_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Perennial, use a find and replace
	 * to change 'perennial-pro' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'perennial-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 580,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Theme Image Sizes
	add_image_size( 'perennial-featured',       600,   600, true );
	add_image_size( 'perennial-site-hero',      1440,  900, true );
	add_image_size( 'perennial-thumbnail',      150,   150, true );

	// This theme uses wp_nav_menu() in four locations.
	register_nav_menus( array (
		'header-menu'        => esc_html__( 'Header Menu',        'perennial-pro' ),
		'footer-menu'        => esc_html__( 'Footer Menu',        'perennial-pro' ),
		'social-menu-footer' => esc_html__( 'Social Menu Footer', 'perennial-pro' ),
	) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array ( 'css/editor-style.css', 'css/font-awesome.css', perennial_fonts_url() ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array (
		'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'perennial_custom_background_args', array (
		'default-color' => 'f5f5f5',
		'default-image' => '',
	) ) );

}
endif; // perennial_setup
add_action( 'after_setup_theme', 'perennial_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function perennial_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'perennial_content_width', 750 );
}
add_action( 'after_setup_theme', 'perennial_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function perennial_widgets_init() {

	// Widget Areas
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'perennial-pro' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area One', 'perennial-pro' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'An optional widget area for your site footer', 'perennial-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area Two', 'perennial-pro' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'An optional widget area for your site footer', 'perennial-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area Three', 'perennial-pro' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'An optional widget area for your site footer', 'perennial-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'perennial_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function perennial_scripts() {

	/**
	 * Enqueue JS files
	 */

	// Debounced Resize
	wp_enqueue_script( 'perennial-debouncedresize', get_template_directory_uri() . '/js/debouncedresize.js', array( 'jquery' ), '1.0', true );

	// Flexslider
	if ( perennial_has_featured_content() ) {
		wp_enqueue_script( 'perennial-flexslider', get_template_directory_uri() . '/js/flexslider.js', array( 'jquery' ), '2.6.3', true );
		wp_enqueue_style( 'perennial-flexslider-style', get_template_directory_uri() . '/css/flexslider.css' );
	}

	// Sticky Menu
	if ( perennial_mod( 'perennial_sticky_menu' ) ) {
		wp_enqueue_script( 'perennial-headroom', get_template_directory_uri() . '/js/headroom.js', array( 'jquery' ), '0.9.3', true );
	}

	// Scrollup
	wp_enqueue_script( 'perennial-scrollup', get_template_directory_uri() . '/js/scrollup.js', array( 'jquery' ), '2.4.0', true );

	// Comment Reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Keyboard image navigation support
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'perennial-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20140127', true );
	}

	// Custom Script
	wp_enqueue_script( 'perennial-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );

	/**
	 * Enqueue CSS files
	 */

	// Bootstrap
	wp_enqueue_style( 'perennial-bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );

	// Fontawesome
	wp_enqueue_style( 'perennial-fontawesome', get_template_directory_uri() . '/css/font-awesome.css' );

	// Fonts
	wp_enqueue_style( 'perennial-fonts', perennial_fonts_url(), array(), null );

	// Theme Stylesheet
	wp_enqueue_style( 'perennial-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'perennial_scripts' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Fonts library.
 */
require get_template_directory() . '/inc/fonts-library.php';

/**
 * Custom functions to handle the theme fonts.
 */
require get_template_directory() . '/inc/fonts.php';

/**
 * Custom functions to handle the theme skin.
 */
require get_template_directory() . '/inc/skin.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( perennial_has_woocommerce_support() ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';

/**
 * Load updater file to update themes from  admin interface.
 */
require get_template_directory() . '/inc/updater.php';
