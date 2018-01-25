<?php
/**
 * The template for displaying search forms.
 *
 * @package Perennial
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" <?php perennial_schema( 'search-form' ); ?>>
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'perennial-pro' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'perennial-pro' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'perennial-pro' ); ?>" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'perennial-pro' ); ?></span></button>
</form>
