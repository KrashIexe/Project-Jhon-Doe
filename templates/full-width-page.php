<?php
/**
 * Template Name: Full Width
 * The template for displaying a page without a sidebar.
 *
 * @package Perennial
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<div id="primary" class="content-area col-xxl-12">
				<main id="main" class="site-main" role="main">

					<div id="post-wrapper" class="post-wrapper post-wrapper-single post-wrapper-full-width skin-card">
						<div class="post-wrapper-inside post-wrapper-single-inside">

							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'template-parts/content', 'page' ); ?>

								<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || '0' != get_comments_number() ) :
										comments_template();
									endif;
								?>

							<?php endwhile; // end of the loop. ?>

						</div><!-- .post-wrapper-inside -->
					</div><!-- .post-wrapper -->

				</main><!-- #main -->
			</div><!-- #primary -->

		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
