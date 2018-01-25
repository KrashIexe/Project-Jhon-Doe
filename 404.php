<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Perennial
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<div id="primary" class="content-area col-xxl-12">
				<main id="main" class="site-main" role="main">

					<header class="page-header skin-page-header">
						<h1 class="page-title"><?php printf( esc_html__( '404: ', 'perennial-pro' ) . '<span>' . esc_html__( 'Page Not Found', 'perennial-pro' ) . '</span>' ); ?></h1>
						<div class="taxonomy-description"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'perennial-pro' ); ?></div>
					</header><!-- .page-header -->

					<div id="post-wrapper" class="post-wrapper post-wrapper-single post-wrapper-full-width skin-card">
						<div class="post-wrapper-inside post-wrapper-single-inside">

							<section class="error-404 not-found">

								<div class="page-content">

									<?php the_widget( 'WP_Widget_Search' ); ?>

									<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

									<?php
									/* translators: %1$s: smiley */
									$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'perennial-pro' ), convert_smilies( ':)' ) ) . '</p>';
									the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
									?>

									<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

								</div><!-- .page-content -->
							</section><!-- .error-404 -->

						</div><!-- .post-wrapper-inside -->
					</div><!-- .post-wrapper -->

				</main><!-- #main -->
			</div><!-- #primary -->

		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
