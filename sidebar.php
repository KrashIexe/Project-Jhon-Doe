<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Perennial
 */

if ( ! perennial_has_sidebar() ) {
	return;
}
?>

<div id="site-sidebar" class="sidebar-area">
	<div id="secondary" class="sidebar widget-area" role="complementary" <?php perennial_schema( 'site-sidebar' ); ?>>
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- .sidebar -->

	<div class="sidebar-close-control"></div>
</div><!-- .sidebar-area -->
