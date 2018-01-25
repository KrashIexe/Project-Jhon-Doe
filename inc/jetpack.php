<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Perennial
 */

function perennial_jetpack_setup() {

	/**
	 * Add theme support for Portfolios CPT.
	 * See: https://jetpack.me/support/custom-content-types/
	 */
	add_theme_support( 'jetpack-portfolio', array(
		'title'          => true,
		'content'        => true,
		'featured-image' => false,
	) );

	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container'       => 'post-wrapper',
		'wrapper'         => false,
		'render'          => 'perennial_infinite_scroll_render',
		'footer'          => 'page',
		'footer_widgets'  => array( 'sidebar-2', 'sidebar-3', 'sidebar-4' ),
		'posts_per_page'  => 8,
	) );

	/**
	 * Add theme support for Responsive Videos.
	 * See: http://jetpack.me/support/responsive-videos/
	 */
	add_theme_support( 'jetpack-responsive-videos' );

	/**
	 * Add theme support for Featured Content.
	 * See: http://jetpack.me/support/featured-content/
	 */
	add_theme_support( 'featured-content', array(
	    'filter'     => 'perennial_get_featured_posts',
	    'max_posts'  => 5,
	    'post_types' => array( 'post', 'page' ),
	) );

	/**
	 * Add theme support for Content Options.
	 * See: https://jetpack.com/support/content-options/
	 */
	add_theme_support( 'jetpack-content-options', array (
		'author-bio' => true, // display or not the author bio: true or false
		'post-details' => array(
			'stylesheet' => 'perennial-style', // name of the theme's stylesheet
			'date'       => '.posted-on',    // a CSS selector matching the elements that display the post date.
			'categories' => '.cat-links',    // a CSS selector matching the elements that display the post categories.
			'tags'       => '.tags-links',   // a CSS selector matching the elements that display the post tags.
			'author'     => '.byline',       // a CSS selector matching the elements that display the post author.
		)
	) );

}
add_action( 'after_setup_theme', 'perennial_jetpack_setup' );

/**
 * Load Jetpack related scripts.
 */
function perennial_jetpack_scripts() {

	// Featured Content Carousel
	if ( perennial_has_featured_content() ) {
		wp_enqueue_script( 'perennial-featured-carousel', get_template_directory_uri() . '/js/featured-carousel.js', array( 'jquery', 'perennial-flexslider' ), '1.0', true );
	}

}
add_action( 'wp_enqueue_scripts', 'perennial_jetpack_scripts' );

/**
 * Infinite Scroll supports
 */
function perennial_infinite_scroll_archive_supported() {

    // Jetpack defualt support
    return current_theme_supports ( 'infinite-scroll' ) && ( is_home() || is_archive() || is_search() ) && ! ( is_post_type_archive( 'product' ) || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) );

}
add_filter( 'infinite_scroll_archive_supported', 'perennial_infinite_scroll_archive_supported' );

/**
 * Custom render function for Infinite Scroll.
 */
function perennial_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();

		// Jetpack Portfolio
		if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
			get_template_part( 'template-parts/content', 'portfolio-archive' );
		}

		// Blog
		else {
			get_template_part( 'template-parts/content', get_post_format() );
		}
	}
}

/**
 * Functions related to Content Options
 */

/**
 * Return early if Author Bio is not available.
 */
function perennial_author_bio() {
    if ( function_exists( 'jetpack_author_bio' ) ) {
        jetpack_author_bio();
    }
}

/**
 * Author Bio Avatar Size.
 */
function perennial_author_bio_avatar_size() {
    return 80; // in px
}
add_filter( 'jetpack_author_bio_avatar_size', 'perennial_author_bio_avatar_size' );

/**
 * Functions related to Jetpack Featured Content
 */

/**
 * Getter function for Featured Content Plugin.
 *
 * @return array An array of WP_Post objects.
 */
function perennial_get_featured_posts() {
	/**
	 * Filter the featured posts to return in theme.
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'perennial_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @return bool Whether there are featured posts.
 */
function perennial_has_featured_posts() {

	if ( is_paged() ) {
        return false;
	}

	$featured_posts = perennial_get_featured_posts();

    if ( ! is_array( $featured_posts ) ) {
        return false;
    }

    if ( count( $featured_posts ) < 1 ) {
        return false;
    }

    return true;

}

/**
 * Functions related to Jetpack Portfolio
 */

/**
 * Portfolio Title.
 */
function perennial_portfolio_title( $before = '', $after = '' ) {
	$jetpack_portfolio_title = get_option( 'jetpack_portfolio_title' );
	$title = '';

	if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
		if ( isset( $jetpack_portfolio_title ) && '' != $jetpack_portfolio_title ) {
			$title = esc_html( $jetpack_portfolio_title );
		} else {
			$title = post_type_archive_title( '', false );
		}
	} elseif ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
		$title = single_term_title( '', false );
	}

	echo $before . $title . $after;
}

/**
 * Portfolio Content.
 */
function perennial_portfolio_content( $before = '', $after = '' ) {
	$jetpack_portfolio_content = get_option( 'jetpack_portfolio_content' );

	if ( is_tax() && get_the_archive_description() ) {
		echo $before . get_the_archive_description() . $after;
	} else if ( isset( $jetpack_portfolio_content ) && '' != $jetpack_portfolio_content ) {
		$content = convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( $jetpack_portfolio_content ) ) ) ) ) );
		echo $before . $content . $after;
	}
}

/**
 * Site Hero Single Post Global Filter
 * We will modify the filter only, if the post belongs to Jetpack portfolio CPT.
 *
 * @param bool $site_hero
 * @return bool
 */
function perennial_has_site_hero_jetpack_portfolio_filter( $site_hero ) {

	// We will modify the filter only, if the post belongs to Jetpack portfolio CPT.
	if ( is_singular( 'jetpack-portfolio' ) ) {
		return apply_filters( 'perennial_site_hero_jetpack_portfolio', (bool) ( perennial_mod( 'perennial_site_hero_jetpack_portfolio' ) && perennial_has_post_thumbnail() ) );
	}

	return $site_hero;

}
add_filter( 'perennial_has_site_hero_post_global', 'perennial_has_site_hero_jetpack_portfolio_filter' );

/**
 * Filter 'perennial_has_ad_post_global'
 * We will modify the filter only, if the post belongs to Jetpack portfolio CPT.
 *
 * @param bool $post_ad
 * @return bool
 */
function perennial_has_ad_jetpack_portfolio_filter( $post_ad ) {

	if ( is_singular( 'jetpack-portfolio' ) ) {
		return apply_filters( 'perennial_has_ad_jetpack_portfolio_filter', (bool) ( perennial_mod( 'perennial_ad_portfolio' ) ) );
	}

	return (bool) $post_ad;

}
add_filter( 'perennial_has_ad_post_global', 'perennial_has_ad_jetpack_portfolio_filter', 20 );

/**
 * Prints first project type for the current Jetpack portfolio post.
 *
 * @return void
*/
function perennial_jetpack_portfolio_first_type( $before = '', $after = '' ) {

	// Show the First Project Type Name Only
	$term = get_the_terms( get_the_ID(), 'jetpack-portfolio-type' );
	if ( $term[0] ) {
		$term_string = sprintf( '<span class="cat-links first-category first-portfolio-type"><a href="%1$s">%2$s</a></span>', esc_url( get_term_link( $term[0]->term_id, 'jetpack-portfolio-type' ) ), esc_html( $term[0]->name ) );
		echo $before . $term_string . $after; // WPCS: XSS OK.
	}

}

/**
 * Prints HTML with meta information for the Jetpack project type and tags.
 */
function perennial_jetpack_portfolio_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', _x(', ', 'Used between portfolio type, there is a space after the comma.', 'perennial-pro' ) );
	if ( $categories_list ) {
		printf( '<span class="cat-links cat-links-single">' . esc_html__( 'Posted in %1$s', 'perennial-pro' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	}

	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '', _x(', ', 'Used between portfolio tag, there is a space after the comma.', 'perennial-pro' ) );
	if ( $tags_list ) {
		printf( '<span class="tags-links tags-links-single">' . esc_html__( 'Tagged %1$s', 'perennial-pro' ) . '</span>', $tags_list ); // WPCS: XSS OK.
	}

	/* Edit Link */
	edit_post_link( sprintf( esc_html__( 'Edit %1$s', 'perennial-pro' ), '<span class="screen-reader-text">' . the_title_attribute( 'echo=0' ) . '</span>' ), '<span class="edit-link">', '</span>' );

}
