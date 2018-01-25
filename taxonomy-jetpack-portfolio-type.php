<?php
/**
 * The template for displaying the Portfolio archive page.
 *
 * @package Perennial
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<section id="primary" class="content-area col-xxl-12">
				<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header skin-page-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<div id="post-wrapper" class="post-wrapper post-wrapper-archive">
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'portfolio-archive' ); ?>

					<?php endwhile; ?>
					</div><!-- .jetpack-portfolio-wrapper -->

					<?php perennial_the_posts_pagination(); ?>

				<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>

				</main><!-- #main -->
			</section><!-- #primary -->

		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
