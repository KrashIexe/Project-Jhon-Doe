<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Perennial
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head <?php perennial_schema( 'head' ); ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> <?php perennial_schema( 'body' ); ?>>
<div id="page" class="site-wrapper site">
	
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner" <?php perennial_schema( 'site-header' ); ?>>
		<div class="site-header-inside-wrapper">
			<div class="hamburger-wrapper">
				<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'perennial-pro' ); ?></a>
				<a href="#header-menu-responsive" title="<?php esc_attr_e( 'Menu', 'perennial-pro' ); ?>" class="hamburger">
					<span class="hamburger-icon"></span>
					<span class="hamburger-label"><?php esc_html_e( 'Menu', 'perennial-pro' ); ?></span>
				</a>
			</div><!-- .hamburger-wrapper -->

			<div class="site-branding-wrapper">
				<?php
				// Site Custom Logo
				if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				}
				?>

				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title" <?php perennial_schema( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
					<p class="site-title" <?php perennial_schema( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>

					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
					?>
					<p class="site-description" <?php perennial_schema( 'site-description' ); ?>><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div>
			</div><!-- .site-branding-wrapper -->

			<?php if ( perennial_has_sidebar() ) : ?>
			<div class="sidebar-control-wrapper">
				<span class="screen-reader-text"><?php echo esc_html_e( 'Sidebar', 'perennial-pro' ); ?></span>
				<span class="sidebar-control-icon"></span>
			</div><!-- .sidebar-control-wrapper -->
			<?php endif; ?>
		</div><!-- .site-header-inside-wrapper -->
	</header><!-- #masthead -->

	<?php
	// Site Menu
	get_template_part( 'template-parts/site-menu' );
	?>
	<?php //if (is_front_page() || is_home() )
	//echo do_shortcode('[super_hero_slider=421]');
	//super_hero_slider(); 
	
	?> 
	<?php
	// Site Hero
	get_template_part( 'template-parts/site-hero' );
	?>

	<div id="content" class="site-content">
