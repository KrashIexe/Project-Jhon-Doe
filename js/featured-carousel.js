/**
 * Featured Content Carousel v1.0 - depends on `owl-carousel.js`
 * Contains handlers for the featured content carousel
 *
 * Copyright (c) 2013-2016 DesignOrbital.com
 * License: GNU General Public License v2 or later
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

( function( $ ) {
	"use strict";

	// Window Load
	$( window ).load( function() {
		$( '.perennial-featured-content' ).flexslider({
			animation: 'slide',

			// Primary Controls
			directionNav: false,

			// Callback API
			start: function() {
				// Show Carousel
				$( '.featured-content-spinner-wrapper' ).remove();
				$( '.featured-content-wrapper' ).removeClass( 'featured-content-loader' );
			}
		});
	});

} )( jQuery );
