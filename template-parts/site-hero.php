<?php
/**
 * The template for displaying site hero
 *
 * Logic Order:
 *
 * 1. Front Page Hero i.e. Jetpack Featured Content
 * 2. Front Page Hero i.e. Custom Header
 * 3. Single Post Hero i.e. Blog Post, Blog Page, Jetpack Portfolio
 *
 * @package Perennial
 */
?>

<?php
// 1. Front Page Hero i.e. Jetpack Featured Content
if ( perennial_has_featured_content() ) :
?>

	<section class="site-hero-wrapper featured-content-wrapper featured-content-loader">
		<div class="featured-content-spinner-wrapper">
			<div class="featured-content-spinner"></div>
		</div><!-- .featured-content-spinner-wrapper -->

		<a href="#content" class="site-hero-mouse-control">
			<div class="site-hero-mouse">
	            <span class="site-hero-mouse-wheel"></span>
	        </div>
		</a><!-- .site-hero-mouse-control -->

		<div class="perennial-featured-content flexslider">
			<ul class="slides">
				<?php
				// Jetpack Featured Posts
				$featured_posts = perennial_get_featured_posts();
				foreach ( (array) $featured_posts as $order => $post ) :

					// Setup Postdata
					setup_postdata( $post );

				?>
				<li>
					<div class="entry-image-site-hero" title="<?php the_title_attribute(); ?>" <?php perennial_post_thumbnail_background( array( 'size' => 'perennial-site-hero' ) ); ?>></div>

					<div class="entry-content-site-hero-wrapper">
						<div class="entry-content-site-hero-wrapper-inside">

							<?php if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta entry-meta-site-hero">
								<?php perennial_first_category(); ?>
							</div><!-- .entry-meta-site-hero -->
							<?php endif; ?>

							<header class="entry-header-site-hero">
								<?php the_title( sprintf( '<h1 class="entry-title-site-hero" %2$s><a href="%1$s" rel="bookmark">', esc_url( get_permalink() ), perennial_schema( 'entry-title', false ) ), '</a></h1>' ); ?>
							</header><!-- .entry-header-site-hero -->

						</div><!-- .entry-content-site-hero-wrapper-inside -->
					</div><!-- .entry-content-site-hero-wrapper -->
				</li>
				<?php
				endforeach;
				wp_reset_postdata();
				?>
			</ul><!-- .slides -->
		</div><!-- .perennial-featured-content -->
	</section><!-- .site-hero-wrapper -->

<?php
// 2. Front Page Hero i.e. Custom Header
elseif ( perennial_has_custom_header() ) :
?>

	<section class="site-hero-wrapper site-hero-wrapper-custom-header">
		<a href="#content" class="site-hero-mouse-control">
			<div class="site-hero-mouse">
	            <span class="site-hero-mouse-wheel"></span>
	        </div>
		</a><!-- .site-hero-mouse-control -->

		<div class="entry-image-site-hero" style="background-image: url(<?php header_image(); ?>)"></div><!-- .entry-image-site-hero -->

		<div class="entry-content-site-hero-wrapper">
			<div class="entry-content-site-hero-wrapper-inside">

				<?php
				$custom_header_title   = perennial_mod( 'perennial_custom_header_title' );
				$custom_header_summary = perennial_mod( 'perennial_custom_header_summary' );
				?>

				<?php if ( ! empty( $custom_header_title ) ) : ?>
				<header class="entry-header-site-hero">
					<h1 class="entry-title-site-hero entry-title-site-hero-custom-header"><?php echo esc_html( $custom_header_title ); ?></h1>
				</header><!-- .entry-header-site-hero -->
				<?php endif; ?>

				<?php if ( ! empty( $custom_header_summary ) ) : ?>
				<div class="entry-summary entry-summary-site-hero entry-summary-site-hero-custom-header">
					<?php echo convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( $custom_header_summary ) ) ) ) ) ); ?>
				</div><!-- .entry-summary-site-hero -->
				<?php endif; ?>

			</div><!-- .entry-content-site-hero-wrapper-inside -->
		</div><!-- .entry-content-site-hero-wrapper -->
	</section><!-- .site-hero-wrapper -->

<?php
// 3. Single Post Hero i.e. Blog Post, Blog Page, Jetpack Portfolio
elseif ( perennial_has_site_hero_post_global() || perennial_has_site_hero_page() ) :
?>

	<section class="site-hero-wrapper site-hero-wrapper-single">
		<div class="entry-image-site-hero" title="<?php the_title_attribute(); ?>" <?php perennial_post_thumbnail_background( array( 'size' => 'perennial-site-hero' ) ); ?>></div>
	</section><!-- .site-hero-wrapper -->

<?php
endif;
