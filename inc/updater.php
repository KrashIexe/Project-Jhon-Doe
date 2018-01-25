<?php
/**
 * Load theme updater functions.
 * Action is used so that child themes can easily disable.
 */
function perennial_theme_updater() {
	require( get_template_directory() . '/inc/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'perennial_theme_updater' );
