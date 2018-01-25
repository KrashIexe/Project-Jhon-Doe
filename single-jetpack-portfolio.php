<?php
/**
 * The Template for displaying all single projects.
 *
 * @package Perennial
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<div id="primary" class="content-area col-xxl-12">
				<main id="main" class="site-main" role="main">

					<div id="post-wrapper" class="post-wrapper post-wrapper-single skin-card">
						<div class="post-wrapper-inside post-wrapper-single-inside">

							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'template-parts/content', 'portfolio-single' ); ?>

								<?php perennial_author_bio(); ?>

								<?php perennial_the_post_navigation(); ?>

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
