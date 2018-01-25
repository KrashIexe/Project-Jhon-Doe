/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

/* global wp:true */

( function( $ ) {
	"use strict";

	/**
	 * jquery-color
	 * Using jQuery plugin for color manipulation and animation support.
	 * @see https://github.com/jquery/jquery-color/
	 *
	 * Examples
	 * var r = $.Color( '#abcdef' ).red();
	 */

	/**
	 * Calculating Color Contrast
	 * @see https://24ways.org/2010/calculating-color-contrast
	 */
	function perennialGetBackgroundYIQ( r, g, b ) {
		var yiq = Math.floor( ( ( r * 299 ) + ( g * 587 ) + ( b * 114 ) ) / 1000 );
		//console.log( 'r=' + r + ', g=' + g + ', b=' + b + ', yiq=' + yiq );
		return yiq >= 128 ? 'light' : 'dark';
	}

	/**
	 * Uppercase the first character of each word in a string
	 * http://blog.justin.kelly.org.au/ucwords-javascript/
	 */
	function perennialUCWords( str ) {
	    str = str.toLowerCase();
	    return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
	        function($1){
	            return $1.toUpperCase();
	        });
	}

	// Site Title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site Description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Custom Header Title.
	wp.customize( 'perennial_custom_header_title', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title-site-hero-custom-header' ).text( to );
		} );
	} );

	// Custom Header Summary.
	wp.customize( 'perennial_custom_header_summary', function( value ) {
		value.bind( function( to ) {
			$( '.entry-summary-site-hero-custom-header' ).text( to );
		} );
	} );

	// Background Color
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-color', to );

			// Hex to RGB
			// https://github.com/jquery/jquery-color/
			var r = $.Color( to ).red();
			var g = $.Color( to ).green();
			var b = $.Color( to ).blue();

			// Update Colors
			if ( 'dark' === perennialGetBackgroundYIQ( r, g, b ) ) {

				$( '.skin-page-header .page-title' ).css( {
					'color': '#fff'
				} );

				$( '.skin-page-header .page-title span' ).css( {
					'color': '#e5e5e5'
				} );

				$( '.skin-page-header .taxonomy-description' ).css( {
					'color': '#fff'
				} );

			} else {

				$( '.skin-page-header .page-title' ).css( {
					'color': '#3d3d3d'
				} );

				$( '.skin-page-header .page-title span' ).css( {
					'color': '#4d4d4d'
				} );

				$( '.skin-page-header .taxonomy-description' ).css( {
					'color': '#999'
				} );

			}

		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {

				// Hex to RGB
				// https://github.com/jquery/jquery-color/
				var r = $.Color( to ).red();
				var g = $.Color( to ).green();
				var b = $.Color( to ).blue();

				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
				$( '.site-description' ).css( {
					'color': 'rgba('+ r + ',' + g + ',' + b + ', 0.70)'
				} );
			}
		} );
	} );

	// Primary color.
	wp.customize( 'perennial_primary_color', function( value ) {
		value.bind( function( to ) {

			// Update Colors
			$( '.entry-content-single a, .author-bio a, .comment-metadata a, .comment-reply-link, .logged-in-as a' ).css( {
				'color': to
			} );

			$( 'button, input[type="button"], input[type="reset"], input[type="submit"]' ).css( {
				'background': to
			} );

			$( '.entry-image-site-hero, .entry-image-wrapper' ).css( {
				'background-color': to
			} );

		} );
	} );

	// Content Card color.
	wp.customize( 'perennial_content_card_bg_color', function( value ) {
		value.bind( function( to ) {

			// Hex to RGB
			// https://github.com/jquery/jquery-color/
			var r = $.Color( to ).red();
			var g = $.Color( to ).green();
			var b = $.Color( to ).blue();

			// Update Background Color
			$( '.skin-card-archive' ).css( {
				'background': 'rgba('+ r + ',' + g + ',' + b + ', 0.90)'
			} );

			$( '.skin-card' ).css( {
				'background': to
			} );

			// Update Colors
			if ( 'dark' === perennialGetBackgroundYIQ( r, g, b ) ) {

				$( '.skin-card blockquote' ).css( {
					'border-top': '1px solid rgba(255,255,255,0.1)',
					'border-bottom': '1px solid rgba(255,255,255,0.1)',
					'color': '#fff'
				} );

				$( '.skin-card blockquote cite, .skin-card blockquote cite a' ).css( {
					'color': '#bfbfbd'
				} );

				$( '.skin-card .dropcap' ).css( {
					'text-shadow': '8px 8px 0px rgba(255,255,255,0.1)'
				} );

				$( '.skin-card .two-columns, .skin-card .three-columns, .skin-card .four-columns' ).css( {
					'column-rule': '1px solid rgba(255,255,255,0.1)'
				} );

				$( '.skin-card mark, .skin-card .highlight' ).css( {
					'background': 'rgba(252,248,227,0.3)'
				} );

				$( '.skin-card, .skin-card p' ).css( {
					'color': '#f2f2f2'
				} );

				$( '.skin-card h1, .skin-card h2, .skin-card h3, .skin-card h4, .skin-card h5, .skin-card h6' ).css( {
					'color': '#fff'
				} );

				$( '.skin-card .entry-title, .skin-card .entry-title a, .skin-card .author-title, .skin-card .meta-nav, .skin-card .comments-title, .skin-card .comment-reply-title' ).css( {
					'color': '#fff'
				} );

				$( '.skin-card .entry-caption, .skin-card .wp-caption' ).css( {
					'color': '#fff',
					'border': '1px solid rgba(26,26,26,0.2)'
				} );

				$( '.skin-card .wp-caption-text, .skin-card .gallery-caption' ).css( {
					'color': '#fff'
				} );

				$( '.skin-card .entry-meta, .skin-card .entry-meta a, .skin-card .more-link, .skin-card .post-navigation a, .skin-card .comment-navigation a, .skin-card .image-navigation a, .skin-card .fn a' ).css( {
					'color': '#e5e5e5'
				} );

				$( '.skin-card .post-navigation, .skin-card .image-navigation, .skin-card .entry-author, .skin-card .comments-area-wrapper, .skin-card .no-comments-wrapper, .skin-card div#respond, .skin-card .comment-list, .skin-card .comment-list > li > .comment-body, .skin-card .comment-list > li > .children .comment-body' ).css( {
					'border-top': '1px solid rgba(26,26,26,0.2)'
				} );

				$( '.skin-card .featured-content-loader' ).css( {
					'border-bottom': '1px solid rgba(26,26,26,0.2)'
				} );

				$( '.skin-card #infinite-handle span' ).css( {
					'border': '1px solid rgba(26,26,26,0.2)'
				} );

			} else {

				$( '.skin-card blockquote' ).css( {
					'border-top': '1px solid rgba(0,0,0,0.1)',
					'border-bottom': '1px solid rgba(0,0,0,0.1)',
					'color': '#020202'
				} );

				$( '.skin-card blockquote cite, .skin-card blockquote cite a' ).css( {
					'color': '#595959'
				} );

				$( '.skin-card .dropcap' ).css( {
					'text-shadow': '8px 8px 0px rgba(0,0,0,0.1)'
				} );

				$( '.skin-card .two-columns, .skin-card .three-columns, .skin-card .four-columns' ).css( {
					'column-rule': '1px solid rgba(0,0,0,0.1)'
				} );

				$( '.skin-card mark, .skin-card .highlight' ).css( {
					'background': 'rgba(252,248,227,1)'
				} );

				$( '.skin-card, .skin-card p, .skin-card .entry-meta, .skin-card .entry-meta a' ).css( {
					'color': '#3d3d3d'
				} );

				$( '.skin-card h1, .skin-card h2, .skin-card h3, .skin-card h4, .skin-card h5, .skin-card h6' ).css( {
					'color': '#020202'
				} );

				$( '.skin-card .entry-title, .skin-card .entry-title a, .skin-card .author-title, .skin-card .meta-nav, .skin-card .comments-title, .skin-card .comment-reply-title' ).css( {
					'color': '#020202'
				} );

				$( '.skin-card .entry-caption, .skin-card .wp-caption' ).css( {
					'color': '#999',
					'border': '1px solid rgba(232,232,232,1)'
				} );

				$( '.skin-card .wp-caption-text, .skin-card .gallery-caption' ).css( {
					'color': '#999'
				} );

				$( '.skin-card .more-link, .skin-card .comment-navigation a, .skin-card .image-navigation a' ).css( {
					'color': '#999'
				} );

				$( '.post-navigation a' ).css( {
					'color': '#595959'
				} );

				$( '.skin-card .fn a' ).css( {
					'color': '#333'
				} );

				$( '.skin-card .post-navigation, .skin-card .image-navigation, .skin-card .entry-author, .skin-card .comments-area-wrapper, .skin-card .no-comments-wrapper, .skin-card div#respond, .skin-card .comment-list, .skin-card .comment-list > li > .comment-body, .skin-card .comment-list > li > .children .comment-body' ).css( {
					'border-top': '1px solid rgba(232,232,232,1)'
				} );

				$( '.skin-card .featured-content-loader' ).css( {
					'border-bottom': '1px solid rgba(232,232,232,1)'
				} );

				$( '.skin-card #infinite-handle span' ).css( {
					'border': '1px solid rgba(232,232,232,1)'
				} );

			}

		} );

	} );

	// Footer Widgets color.
	wp.customize( 'perennial_footer_widgets_bg_color', function( value ) {
		value.bind( function( to ) {

			// Hex to RGB
			// https://github.com/jquery/jquery-color/
			var r = $.Color( to ).red();
			var g = $.Color( to ).green();
			var b = $.Color( to ).blue();

			// Update Background Color
			$( '.skin-footer-widgets' ).css( {
				'background': to
			} );

			// Update Colors
			if ( 'dark' === perennialGetBackgroundYIQ( r, g, b ) ) {

				$( '.skin-footer-widgets .widget, .skin-footer-widgets .widget-title, .skin-footer-widgets .widget a' ).css( {
					'color': '#fff'
				} );

				$( '.skin-footer-widgets blockquote' ).css( {
					'border-top': '1px solid rgba(255,255,255,0.1)',
					'border-bottom': '1px solid rgba(255,255,255,0.1)',
					'color': '#fff'
				} );

				$( '.skin-footer-widgets blockquote cite, .skin-footer-widgets blockquote cite a' ).css( {
					'color': '#bfbfbd'
				} );

				$( '.skin-footer-widgets .wp-caption' ).css( {
					'color': '#fff',
					'border': '1px solid rgba(26,26,26,0.2)'
				} );

				$( '.skin-footer-widgets .wp-caption-text' ).css( {
					'color': '#fff'
				} );

				$( '.skin-footer-widgets .postlist-date' ).css( {
					'color': '#e5e5e5'
				} );

			} else {

				$( '.skin-footer-widgets .widget, .skin-footer-widgets .widget-title, .skin-footer-widgets .widget a' ).css( {
					'color': '#020202'
				} );

				$( '.skin-footer-widgets blockquote' ).css( {
					'border-top': '1px solid rgba(0,0,0,0.1)',
					'border-bottom': '1px solid rgba(0,0,0,0.1)',
					'color': '#020202'
				} );

				$( '.skin-footer-widgets blockquote cite, .skin-footer-widgets blockquote cite a' ).css( {
					'color': '#595959'
				} );

				$( '.skin-footer-widgets .wp-caption' ).css( {
					'color': '#999',
					'border': '1px solid rgba(232,232,232,1)'
				} );

				$( '.skin-footer-widgets .wp-caption-text' ).css( {
					'color': '#999'
				} );

				$( '.skin-footer-widgets .postlist-date' ).css( {
					'color': '#999'
				} );

			}

		} );

	} );

	// Footer Social color.
	wp.customize( 'perennial_footer_social_bg_color', function( value ) {
		value.bind( function( to ) {

			// Hex to RGB
			// https://github.com/jquery/jquery-color/
			var r = $.Color( to ).red();
			var g = $.Color( to ).green();
			var b = $.Color( to ).blue();

			// Update Background Color
			$( '.skin-footer-social' ).css( {
				'background': to
			} );

			// Update Colors
			if ( 'dark' === perennialGetBackgroundYIQ( r, g, b ) ) {

				$( '.skin-footer-social a' ).css( {
					'color': '#fff'
				} );

			} else {

				$( '.skin-footer-social a' ).css( {
					'color': '#464646'
				} );

			}

		} );

	} );

	// Footer Info color.
	wp.customize( 'perennial_footer_info_bg_color', function( value ) {
		value.bind( function( to ) {

			// Hex to RGB
			// https://github.com/jquery/jquery-color/
			var r = $.Color( to ).red();
			var g = $.Color( to ).green();
			var b = $.Color( to ).blue();

			// Update Background Color
			$( '.skin-footer-info' ).css( {
				'background': to
			} );

			// Update Colors
			if ( 'dark' === perennialGetBackgroundYIQ( r, g, b ) ) {

				$( '.skin-footer-info, .skin-footer-info a, .credits-blog, .credits-designer' ).css( {
					'color': '#fff'
				} );

			} else {

				$( '.skin-footer-info, .skin-footer-info a, .credits-blog, .credits-designer' ).css( {
					'color': '#3d3d3d'
				} );

			}

		} );

	} );

	// Headings Font.
	wp.customize( 'perennial_headings_font', function( value ) {
		value.bind( function( to ) {
			// Formatting
			to = to.replace(/-/g, ' ');
			to = perennialUCWords( to );

			// Preparation for Google Fonts Call
			var enqueue = 'https://fonts.googleapis.com/css?family=' + to.replace(/ /g, '+');
			var family = "'" + to + "'";

			// Load Google Fonts
			var $head = $( 'head' );
			$( '<link rel="stylesheet" href="'+ enqueue +'" type="text/css" media="all" >' ).appendTo( $head );

			// Appropriate CSS
			$( 'h1, h2, h3, h4, h5, h6, .dropcap' ).css( {
				'font-family': family
			} );
		} );
	} );

	// Body Font.
	wp.customize( 'perennial_body_font', function( value ) {
		value.bind( function( to ) {
			// Formatting
			to = to.replace(/-/g, ' ');
			to = perennialUCWords( to );

			// Preparation for Google Fonts Call
			var enqueue = 'https://fonts.googleapis.com/css?family=' + to.replace(/ /g, '+');
			var family = "'" + to + "'";

			// Load Google Fonts
			var $head = $( 'head' );
			$( '<link rel="stylesheet" href="'+ enqueue +'" type="text/css" media="all" >' ).appendTo( $head );

			// Appropriate CSS
			$( 'body' ).css( {
				'font-family': family
			} );
		} );
	} );

	// Branding Font.
	wp.customize( 'perennial_branding_font', function( value ) {
		value.bind( function( to ) {
			// Formatting
			to = to.replace(/-/g, ' ');
			to = perennialUCWords( to );

			// Preparation for Google Fonts Call
			var enqueue = 'https://fonts.googleapis.com/css?family=' + to.replace(/ /g, '+');
			var family = "'" + to + "'";

			// Load Google Fonts
			var $head = $( 'head' );
			$( '<link rel="stylesheet" href="'+ enqueue +'" type="text/css" media="all" >' ).appendTo( $head );

			// Appropriate CSS
			$( '.site-title, .site-description, .hamburger-label' ).css( {
				'font-family': family
			} );
		} );
	} );

	// Menu Font.
	wp.customize( 'perennial_menu_font', function( value ) {
		value.bind( function( to ) {
			// Formatting
			to = to.replace(/-/g, ' ');
			to = perennialUCWords( to );

			// Preparation for Google Fonts Call
			var enqueue = 'https://fonts.googleapis.com/css?family=' + to.replace(/ /g, '+');
			var family = "'" + to + "'";

			// Load Google Fonts
			var $head = $( 'head' );
			$( '<link rel="stylesheet" href="'+ enqueue +'" type="text/css" media="all" >' ).appendTo( $head );

			// Appropriate CSS
			$( '.header-menu a' ).css( {
				'font-family': family
			} );
		} );
	} );

	// Copyright Control
	wp.customize( 'perennial_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.credits-blog' ).html( to );
		} );
	} );

	// Credit Control
	wp.customize( 'perennial_credit', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.credits-designer' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
			} else {
				$( '.credits-designer' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			}
		} );
	} );

} )( jQuery );
