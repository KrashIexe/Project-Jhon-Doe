<?php
/**
 * The template for displaying image attachments
 *
 * @package Perennial
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<section id="primary" class="content-area col-xxl-12">
				<main id="main" class="site-main" role="main">

					<div id="post-wrapper" class="post-wrapper post-wrapper-single post-wrapper-full-width skin-card">
						<div class="post-wrapper-inside post-wrapper-single-inside">

							<?php while ( have_posts() ) : the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php perennial_schema( 'entry' ); ?>>

									<?php
									// Retrieve attachment metadata.
									$metadata = wp_get_attachment_metadata();
									?>

									<div class="entry-header-wrapper-single">
										<header class="entry-header entry-header-single">
											<?php the_title( '<h1 class="entry-title entry-title-single">', '</h1>' ); ?>
										</header><!-- .entry-header -->

										<div class="entry-meta entry-meta-header-after">
											<?php perennial_posted_on(); ?>
											<?php if ( $post->post_parent ) : ?>
											<span class="parent-post-link">
												<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rel="gallery">
													<?php echo esc_html( get_the_title( $post->post_parent ) ); ?>
												</a>
											</span>
											<?php endif; ?>
											<span class="full-size-link">
												<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" target="_blank">
													<?php echo esc_html( $metadata['width'] ); ?> &times; <?php echo esc_html( $metadata['height'] ); ?>
												</a>
											</span>
											</ul>
										</div><!-- .entry-meta -->
									</div><!-- .entry-header-wrapper-single -->

									<div class="entry-attachment">
										<div class="attachment">
											<?php perennial_the_attached_image(); ?>
										</div><!-- .attachment -->

										<?php if ( has_excerpt() ) : ?>
										<div class="entry-caption">
											<?php the_excerpt(); ?>
										</div><!-- .entry-caption -->
										<?php endif; ?>
									</div><!-- .entry-attachment -->

									<div class="entry-content entry-content-attachment">
										<?php the_content(); ?>
										<?php
											wp_link_pages( array(
												'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'perennial-pro' ) . '</span>',
												'after'       => '</div>',
												'link_before' => '<span>',
												'link_after'  => '</span>',
											) );
										?>
									</div><!-- .entry-content -->

									<?php if ( '' != get_edit_post_link() ) : ?>
									<footer class="entry-meta entry-meta-footer">
										<?php edit_post_link( esc_html__( 'Edit', 'perennial-pro' ), '<span class="edit-link">', '</span>' ); ?>
									</footer><!-- .entry-meta -->
									<?php endif; ?>

								</article><!-- #post-## -->

								<nav id="image-navigation" class="navigation image-navigation">
									<div class="nav-links">
										<div class="previous-image nav-previous"><?php previous_image_link( false, esc_html__( 'Previous Image', 'perennial-pro' ) ); ?></div>
										<div class="next-image nav-next"><?php next_image_link( false, esc_html__( 'Next Image', 'perennial-pro' ) ); ?></div>
									</div><!-- .nav-links -->
								</nav><!-- #image-navigation -->

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
			</section><!-- #primary -->

		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
