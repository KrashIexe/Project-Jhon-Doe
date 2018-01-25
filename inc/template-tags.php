<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Perennial
 */

if ( ! function_exists( 'perennial_the_posts_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function perennial_the_posts_pagination() {

	// Previous/next posts navigation @since 4.1.0
	the_posts_pagination( array(
		'prev_text'          => '<span class="screen-reader-text">' . esc_html__( 'Previous Page', 'perennial-pro' ) . '</span>',
		'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next Page', 'perennial-pro' ) . '</span>',
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'perennial-pro' ) . ' </span>',
	) );

}
endif;

if ( ! function_exists( 'perennial_the_post_navigation' ) ) :
/**
 * Previous/next post navigation.
 *
 * @return void
 */
function perennial_the_post_navigation() {

	// Previous/next post navigation @since 4.1.0.
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav">' . esc_html__( 'Next', 'perennial-pro' ) . '</span> ' . '<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav">' . esc_html__( 'Prev', 'perennial-pro' ) . '</span> ' . '<span class="post-title">%title</span>',
	) );

}
endif;

if ( ! function_exists( 'perennial_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function perennial_posted_on( $before = '', $after = '' ) {

	// No need to display date for sticky posts
	if ( perennial_has_sticky_post() ) {
		return;
	}

	$time_string = '<time class="entry-date published updated" datetime="%1$s" %5$s>%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s" %5$s>%2$s</time><time class="updated" datetime="%3$s" %6$s>%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() ),
		perennial_schema( 'entry-date', false ),
		perennial_schema( 'entry-date-modified', false )
	);

	$posted_on = sprintf( '<span class="screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark"> %3$s</a>',
		esc_html_x( 'Posted on', 'post date', 'perennial-pro' ),
		esc_url( get_permalink() ),
		$time_string
	);

	$posted_on_string = '<span class="posted-on">' . $posted_on . '</span>';

	echo $before . $posted_on_string . $after; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'perennial_posted_by' ) ) :
/**
 * Prints author.
 */
function perennial_posted_by( $before = '', $after = '' ) {

	// Global Post
	global $post;

	// We need to get author meta data from both inside/outside the loop.
	$post_author_id = get_post_field( 'post_author', $post->ID );

	// Post Author
	$post_author = sprintf( '<span class="author vcard" %3$s><a class="entry-author-link url fn n" href="%1$s" %4$s rel="author"><span class="entry-author-name" %5$s>%2$s</span></a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ) ),
		esc_html( get_the_author_meta( 'display_name', $post_author_id ) ),
		perennial_schema( 'entry-author', false ),
		perennial_schema( 'entry-author-link', false ),
		perennial_schema( 'entry-author-name', false )

	);

	// Byline
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'perennial-pro' ),
		$post_author
	);

	$byline_string = '<span class="byline"> ' . $byline . '</span>';

	echo $before . $byline_string . $after; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'perennial_sticky_post' ) ) :
/**
 * Prints HTML label for the sticky post.
 */
function perennial_sticky_post( $before = '', $after = '' ) {

	// Sticky Post Validation
	if ( ! perennial_has_sticky_post() ) {
		return;
	}

	$sticky_post_string = sprintf( '<span class="post-label post-label-sticky">%1$s</span>',
		esc_html_x( 'Featured', 'sticky post label', 'perennial-pro' )
	);

	echo $before . $sticky_post_string . $after; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'perennial_first_category' ) ) :
/**
 * Prints first category for the current post.
 *
 * @return void
*/
function perennial_first_category( $before = '', $after = '' ) {

	// Show the First Category Name Only
	$category = get_the_category();
	if ( $category[0] ) {
		$category_string = sprintf( '<span class="cat-links first-category"><a href="%1$s">%2$s</a></span>', esc_url( get_category_link( $category[0]->term_id ) ), esc_html( $category[0]->cat_name ) );
		echo $before . $category_string . $after; // WPCS: XSS OK.
	}

}
endif;

if ( ! function_exists( 'perennial_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function perennial_entry_footer() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( _x(', ', 'Used between category, there is a space after the comma.', 'perennial-pro' ) );
		if ( $categories_list && perennial_categorized_blog() ) {
			printf( '<span class="cat-links cat-links-single">' . esc_html__( 'Posted in %1$s', 'perennial-pro' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', _x(', ', 'Used between tag, there is a space after the comma.', 'perennial-pro' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links tags-links-single">' . esc_html__( 'Tagged %1$s', 'perennial-pro' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link( sprintf( esc_html__( 'Edit %1$s', 'perennial-pro' ), '<span class="screen-reader-text">' . the_title_attribute( 'echo=0' ) . '</span>' ), '<span class="edit-link">', '</span>' );

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function perennial_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'perennial_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array (
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'perennial_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so perennial_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so perennial_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in perennial_categorized_blog.
 */
function perennial_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'perennial_categories' );
}
add_action( 'edit_category', 'perennial_category_transient_flusher' );
add_action( 'save_post',     'perennial_category_transient_flusher' );

/**
 * Post Thumbnail or Post Thumbnail Fallback as Background
 *
 * @return void
*/
function perennial_post_thumbnail_background( $args = array() ) {

	// Defaults
	$defaults = array (
 		'post_id'  => null,
 		'size'     => 'perennial-featured',
 		'attr'     => '',
 		'fallback' => true
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	// Image src
	$image_src = perennial_get_image_src( $args );

	// Image src check
	if ( false === $image_src ) {
		return;
	}

	// Post thumbnail background
	$post_thumbnail_background = sprintf( 'style="background-image: url(%1$s);"', esc_attr( esc_url( $image_src ) ) );

	// Output
	echo $post_thumbnail_background;

}

/**
 * A helper conditional function.
 * Whether there is a post thumbnail or post thumbnail fallback.
 *
 * @return bool
 */
function perennial_has_post_thumbnail( $args = array() ) {

	// Defaults
	$defaults = array (
 		'post_id'  => null,
 		'size'     => 'perennial-featured',
 		'attr'     => '',
 		'fallback' => true
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	// Image Src
	$image_src = ( false === perennial_get_image_src( $args ) ) ? false : true;

	/**
	 * Post Thumbnail Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_post_thumbnail', $image_src );

}

/**
 * A helper conditional function.
 * Post is Sticky or Not
 *
 * @return bool
 */
function perennial_has_sticky_post() {

	/**
	 * Full width Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_sticky_post', (bool) ( is_sticky() && is_home() && ! is_paged() ) );

}

/**
 * A helper conditional function.
 * Theme has Fullwidth or Not
 *
 * @return bool
 */
function perennial_has_fullwidth() {

	/**
	 * Full width Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_fullwidth', (bool) ( is_attachment() && wp_attachment_is_image() ) || is_page_template( 'templates/full-width-page.php' ) );

}

/**
 * A helper conditional function.
 * Theme has Excerpt or Not
 *
 * @return bool
 */
function perennial_has_excerpt() {

	// Post Excerpt
	$post_excerpt = get_the_excerpt();

	/**
	 * Excerpt Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_excerpt', (bool) ! empty ( $post_excerpt ) );

}

/**
 * Theme Sidebar Template
 *
 * @param (string|null) Name of the specific sidebar file to use. null for the default sidebar.
 * @return (string|null)
 */
function perennial_sidebar_template( $name = null ) {

	/**
	 * Sidebar Template
	 * @return (string|null)
	 */
	return apply_filters( 'perennial_sidebar_template', $name );

}

/**
 * A helper conditional function.
 * Theme has Sidebar or Not
 *
 * @return bool
 */
function perennial_has_sidebar() {

	/**
	 * Sidebar Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_sidebar', (bool) is_active_sidebar( 'sidebar-1' ) );

}

/**
 * A helper conditional function.
 * Theme has Footer Widgets or Not
 *
 * @return bool
 */
function perennial_has_footer_widgets() {

	/**
	 * Sidebar Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_footer_widgets', (bool) is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) );

}

/**
 * A helper conditional function.
 * Theme has Front Page or Not
 *
 * @see https://developer.wordpress.org/reference/functions/is_home/
 * @return bool
 */
function perennial_has_front_page() {

	/**
	 * Featured Content Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_front_page', (bool) ( is_front_page() || is_home() ) );

}

/**
 * A helper conditional function.
 * Theme has Static Front Page or Not
 *
 * @see https://developer.wordpress.org/reference/functions/is_home/
 * @return bool
 */
function perennial_has_static_front_page() {

	/**
	 * Featured Content Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_static_front_page', (bool) ( 'page' === get_option( 'show_on_front' ) && is_front_page() ) );

}

/**
 * A helper conditional function.
 * Theme has Custom Header on front/home page or Not
 *
 * @return bool
 */
function perennial_has_custom_header() {

	/**
	 * Custom Header Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_custom_header', (bool) ( get_header_image() && perennial_has_front_page() && ! is_paged() ) );

}

/**
 * A helper conditional function.
 * Theme has Featured Posts on front/home page or Not
 *
 * @return bool
 */
function perennial_has_featured_content() {

	/**
	 * Featured Content Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_featured_content', (bool) ( perennial_has_featured_posts() && perennial_has_front_page() ) );

}

/**
 * A helper conditional function.
 * Theme has Site Hero on single post of all post types or Not
 *
 * @return bool
 */
function perennial_has_site_hero_post_global() {


	/**
	 * Site Hero Single Post Global Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_site_hero_post_global', (bool) ( perennial_mod( 'perennial_site_hero_post_global' ) && is_single() && ! is_attachment() && perennial_has_post_thumbnail() ) );

}

/**
 * A helper conditional function.
 * Theme has Site Hero on single page or Not
 *
 * @return bool
 */
function perennial_has_site_hero_page() {

	/**
	 * Site Hero Single Page Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_site_hero_page', (bool) ( perennial_mod( 'perennial_site_hero_page' ) && is_singular( 'page' ) && perennial_has_post_thumbnail() && ! perennial_has_front_page() ) );

}

/**
 * A helper conditional function.
 * Theme has Ad on single post of all post types or Not
 *
 * @return bool
 */
function perennial_has_ad_post_global() {

	/**
	 * Ad Single Post Global Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_ad_post_global', (bool) ( perennial_mod( 'perennial_ad_post_global' ) && is_single() && ! is_attachment() ) );

}

/**
 * A helper conditional function.
 * Theme has Ad on single post or Not
 *
 * @return bool
 */
function perennial_has_ad_page() {

	/**
	 * Ad Single Page Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_ad_page', (bool) ( perennial_mod( 'perennial_ad_page' ) && is_singular( 'page' ) && ! perennial_has_front_page() ) );

}

/**
 * A helper conditional function.
 * Theme has WooCommerce support
 *
 * @return bool
 */
function perennial_has_woocommerce_support() {

	/**
	 * Ad Single Page Filter
	 * @return bool
	 */
	return apply_filters( 'perennial_has_woocommerce_support', (bool) ( function_exists( 'is_woocommerce' ) && function_exists( 'is_product' ) && perennial_mod( 'perennial_woocommerce' ) ) );

}

/**
 * Parse the element schema.
 *
 * @param array $attributes
 * @return string
 */
function perennial_parse_schema( $attributes = array() ) {

	// Output
	$output = '';

	// Build Schema
	foreach ( $attributes as $key => $value ) {

		// Validation
		if ( ! $value ) {
			continue;
		}

		// Schema Pair
		if ( true === $value ) {
			$output .= esc_html( $key ) . ' ';
		} else {
			$output .= sprintf( '%s="%s" ', esc_html( $key ), esc_attr( $value ) );
		}

	}

	// Return
	return trim( $output );

}

/**
 * Element schema.
 *
 * @param string $context - Name of the element to retrieve the schema
 * @return void or string
 */
function perennial_schema( $context = 'head', $echo = true ) {

	// Attributes Array
	$attributes = array();

	// Attributes Schema
	switch( $context ) {

		case 'body':
			$attributes['itemscope'] = true;
			$attributes['itemtype']  = 'http://schema.org/WebPage';

			// Search Page
			if ( is_search() ) {
				$attributes['itemtype'] = 'http://schema.org/SearchResultsPage';
			}
		break;

		case 'site-header':
			$attributes['itemscope'] = true;
			$attributes['itemtype']  = 'http://schema.org/WPHeader';
		break;

		case 'site-sidebar':
			$attributes['itemscope'] = true;
			$attributes['itemtype']  = 'http://schema.org/WPSideBar';
		break;

		case 'site-footer':
			$attributes['itemscope'] = true;
			$attributes['itemtype']  = 'http://schema.org/WPFooter';
		break;

		case 'site-logo':
			$attributes['itemscope'] = true;
			$attributes['itemtype']  = 'http://schema.org/Organization';
		break;

		case 'site-title':
			$attributes['itemprop'] = 'headline';
		break;

		case 'site-description':
			$attributes['itemprop'] = 'description';
		break;

		case 'site-header-menu':
		case 'site-footer-menu':
			$attributes['itemscope'] = true;
			$attributes['itemtype']  = 'http://schema.org/SiteNavigationElement';
		break;

		case 'entry':
			if ( is_main_query() ) {
				$attributes['itemscope'] = true;
				$attributes['itemtype']  = 'http://schema.org/CreativeWork';
			}
		break;

		case 'entry-title':
			$attributes['itemprop'] = 'headline';
		break;

		case 'entry-content':
		case 'entry-summary':
			$attributes['itemprop'] = 'text';
		break;

		case 'entry-author':
			$attributes['itemprop']  = 'author';
			$attributes['itemscope'] = true;
			$attributes['itemtype']  = 'http://schema.org/Person';
		break;

		case 'entry-author-link':
			$attributes['itemprop'] = 'url';
		break;

		case 'entry-author-name':
			$attributes['itemprop'] = 'name';
		break;

		case 'entry-author-bio':
			$attributes['itemprop'] = 'description';
		break;

		case 'entry-date':
			$attributes['itemprop'] = 'datePublished';
		break;

		case 'entry-date-modified':
			$attributes['itemprop'] = 'dateModified';
		break;

		case 'search-form':
			$attributes['itemprop']  = 'potentialAction';
			$attributes['itemscope'] = true;
			$attributes['itemtype']  = 'http://schema.org/SearchAction';
		break;

		case 'head':
		default:
			if ( is_front_page() ) {
				$attributes['itemscope'] = true;
				$attributes['itemtype']  = 'http://schema.org/WebSite';
			}

	}

	// Parse Schema
	$schema = perennial_parse_schema( $attributes );

	// Output
	if ( true === $echo ) {
		echo $schema;
	} else {
		return $schema;
	}

}
