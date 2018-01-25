<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Perennial
 */

if ( perennial_has_woocommerce_support() && ! perennial_has_woocommerce_sidebar() ) {
	return;
}
?>
<div id="site-sidebar" class="sidebar-area">
	<div id="secondary" class="sidebar widget-area" role="complementary" <?php perennial_schema( 'site-sidebar' ); ?>>
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'shop' ); ?>
	</div><!-- .sidebar -->
</div><!-- .col-* columns of main sidebar -->
