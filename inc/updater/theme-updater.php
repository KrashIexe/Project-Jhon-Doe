<?php
/**
 * DesignOrbital Market Theme Updater
 *
 * @package Perennial
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://designorbital.market', // Site where EDD is hosted
		'item_name'      => 'Perennial Pro', // Name of theme
		'theme_slug'     => 'perennial-pro', // Theme slug
		'version'        => '1.0.2', // The current version of this theme
		'author'         => 'DesignOrbital Market', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Perennial Pro License', 'perennial-pro' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'perennial-pro' ),
		'license-key'               => __( 'License Key', 'perennial-pro' ),
		'license-action'            => __( 'License Action', 'perennial-pro' ),
		'deactivate-license'        => __( 'Deactivate License on this site', 'perennial-pro' ),
		'activate-license'          => __( 'Activate License on this site', 'perennial-pro' ),
		'status-unknown'            => __( 'License status is unknown.', 'perennial-pro' ),
		'renew'                     => __( 'Renew?', 'perennial-pro' ),
		'unlimited'                 => __( 'unlimited', 'perennial-pro' ),
		'license-key-is-active'     => __( 'License key is active.', 'perennial-pro' ),
		'expires%s'                 => __( 'Expires %s.', 'perennial-pro' ),
		'expires-never'             => __( 'Lifetime License.', 'perennial-pro' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated on this key.', 'perennial-pro' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'perennial-pro' ),
		'license-key-expired'       => __( 'License key has expired.', 'perennial-pro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'perennial-pro' ),
		'license-is-inactive'       => __( 'License is inactive.', 'perennial-pro' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'perennial-pro' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'perennial-pro' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'perennial-pro' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'perennial-pro' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'perennial-pro' ),
	)

);
