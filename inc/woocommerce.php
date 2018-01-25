<?php
/**
 * WooCommerce Compatibility File
 * Using hooks
 *
 * WooCommerce Docs
 *
 * http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 * http://docs.woothemes.com/documentation/plugins/woocommerce/woocommerce-codex/theming/
 * http://docs.woothemes.com/documentation/plugins/woocommerce/woocommerce-codex/snippets/snippets-theming/
 *
 * @package Perennial
 */

/**
 * WooCommerce Templates
 *
 * WooCommerce has two type of templates.
 *
 * 1. WooCommerce Core Templates i.e. Shop/Archive and Product Detail Page
 * @ These templates are controlled by WooCommerce internally
 *
 * 2. Standard Templates i.e. My Account, Cart, Checkout
 * @ These templates will be served by standard WordPress pages by using WooCommerce shortcodes
 *
 */

/**
 * A helper conditional function.
 * Theme has WooCommerce Core Template/Pages or Not
 *
 * @return bool
 */
function perennial_has_woocommerce_template() {
	if ( is_woocommerce() ) {
		return true;
	}

    return false;
}

/**
 * A helper conditional function.
 * Theme has WooCommerce Sidebar Page Template or Not
 *
 * @return bool
 */
function perennial_has_woocommerce_sidebar_page_template() {
	if ( is_page_template( 'templates/woocommerce-sidebar.php' ) ) {
		return true;
	}

    return false;
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @return bool Whether WooCommerce shop sidebar should use or not.
 */
function perennial_has_woocommerce_sidebar() {

	if ( is_active_sidebar( 'shop' ) ) {

		// 1. For WooCommerce Core Templates
		if ( perennial_has_woocommerce_template() ) {

			// WooCommerce Product Template
			if ( perennial_mod( 'perennial_woocommerce_product_sidebar' ) && is_product() ) {
				return true;
			}

			// For all other WooCommerce Templates e.g. Main Shop Page, Product Category Archive, Product Tag Archive
			else if ( perennial_mod( 'perennial_woocommerce_archive_sidebar' ) && ! is_product() ) {
				return true;
			}

		}

		// For all other WooCommerce pages which are using theme templates i.e. WooCommerce Sidebar Page template
		// Example: Cart and Checkout are standard pages with shortcodes and thus are not included in WooCommerce Tempaltes
		else {

			return true;

		}

	}

	return false;

}

/**
 * Theme Sidebar Template Filter
 * We will modify the filter only, if we are in WooCommerce templates.
 *
 * @param (string|null) $name
 * @return (string|null)
 */
function perennial_woocommerce_sidebar_template_filter( $name ) {

	// We will modify the filter only, if we are in WooCommerce Core Templates or WooCommerce Sidebar Page Template.
	if ( perennial_has_woocommerce_template() || perennial_has_woocommerce_sidebar_page_template() ) {
		return 'shop';
	}

	return $name;

}
add_filter( 'perennial_sidebar_template', 'perennial_woocommerce_sidebar_template_filter', 20 );

/**
 * Theme Sidebar Active Filter
 * We will modify the filter only, if we are in WooCommerce templates.
 *
 * @param bool $sidebar
 * @return bool
 */
function perennial_has_woocommerce_sidebar_filter( $sidebar ) {

	// We will modify the filter only, if we are in WooCommerce Core Templates or WooCommerce Sidebar Page Template.
	if ( perennial_has_woocommerce_template() || perennial_has_woocommerce_sidebar_page_template() ) {

		if ( perennial_has_woocommerce_sidebar() ) {
			return true;
		}

		return false;

	}

	return (bool) $sidebar;

}
add_filter( 'perennial_has_sidebar', 'perennial_has_woocommerce_sidebar_filter', 20 );

/**
 * Theme Full width Filter
 * We will modify the filter only, if we are in WooCommerce templates.
 *
 * @param bool $fullwidth
 * @return bool
 */
function perennial_has_woocommerce_fullwidth_filter( $fullwidth ) {

	// We will modify the filter only, if we are in WooCommerce Core Templates or WooCommerce Sidebar Page Template.
	if ( perennial_has_woocommerce_template() || perennial_has_woocommerce_sidebar_page_template() ) {

		if ( ! perennial_has_woocommerce_sidebar() ) {
			return true;
		}

		return false;

	}

	return (bool) $fullwidth;

}
add_filter( 'perennial_has_fullwidth', 'perennial_has_woocommerce_fullwidth_filter', 20 );

/**
 * Site Hero Single Post Global Filter
 * We will modify the filter only, if we are in WooCommerce templates.
 *
 * @param bool $site_hero
 * @return bool
 */
function perennial_has_site_hero_post_woocommerce_filter( $site_hero ) {

	// We will modify the filter only, if we are in WooCommerce Core Templates.
	if ( perennial_has_woocommerce_template() ) {

		// WooCommerce Product Template
		if ( perennial_mod( 'perennial_woocommerce_site_hero_post' ) && is_product() ) {
			return true;
		}

		return false;

	}

	return (bool) $site_hero;

}
add_filter( 'perennial_has_site_hero_post_global', 'perennial_has_site_hero_post_woocommerce_filter', 20 );

/**
 * Filter 'perennial_has_ad_post_global'
 * We will modify the filter only, if we are in WooCommerce templates.
 *
 * @param bool $post_ad
 * @return bool
 */
function perennial_has_ad_post_woocommerce_filter( $post_ad ) {

	// We will modify the filter only, if we are in WooCommerce Core Templates.
	if ( perennial_has_woocommerce_template() ) {

		// WooCommerce Product Template
		if ( perennial_mod( 'perennial_woocommerce_ad_post' ) && is_product() ) {
			return true;
		}

		return false;

	}

	return (bool) $post_ad;

}
add_filter( 'perennial_has_ad_post_global', 'perennial_has_ad_post_woocommerce_filter', 20 );

/**
 * Filter 'perennial_has_ad_page'
 * We will modify the filter only, if we are in WooCommerce Sidebar Page template.
 *
 * @param bool $page_ad
 * @return bool
 */
function perennial_has_ad_page_woocommerce_filter( $page_ad ) {

	// We will modify the filter only, if we are in WooCommerce Sidebar Page template.
	if ( perennial_has_woocommerce_sidebar_page_template() ) {

		// WooCommerce Ad Page Mod
		if ( perennial_mod( 'perennial_woocommerce_ad_page' ) ) {
			return true;
		}

		return false;

	}

	return (bool) $page_ad;

}
add_filter( 'perennial_has_ad_page', 'perennial_has_ad_page_woocommerce_filter', 20 );

// Register widgetized area.
function perennial_woocommerce_widgets_init() {

	// Widget Areas
	register_sidebar( array(
		'name'          => esc_html__( 'Shop', 'perennial-pro' ),
		'id'            => 'shop',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'perennial_woocommerce_widgets_init' );

// Unhook the WooCommerce wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Unhook the WooCommerce Sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Hook the WooCommerce start wrapper
function perennial_woocommerce_wrapper_start() {
?>
<div class="container">
	<div class="row">

		<div id="primary" class="content-area col-xxl-12">
			<main id="main" class="site-main" role="main">

				<div id="post-wrapper" class="post-wrapper post-wrapper-single post-wrapper-full-width post-wrapper-woocommerce skin-card">
					<div class="post-wrapper-inside post-wrapper-single-inside">
<?php
}
add_action( 'woocommerce_before_main_content', 'perennial_woocommerce_wrapper_start', 10 );

// Hook the WooCommerce end wrapper
function perennial_woocommerce_wrapper_end() {
?>
					</div><!-- .post-wrapper-inside -->
				</div><!-- .post-wrapper -->

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .row -->
</div><!-- .container -->
<?php
}
add_action( 'woocommerce_after_main_content', 'perennial_woocommerce_wrapper_end', 10 );

// Declare WooCommerce support
function perennial_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'perennial_woocommerce_support' );
