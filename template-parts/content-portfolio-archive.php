<?php
/**
 * The template for displaying the Portfolio archive page.
 *
 * @package Perennial
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php perennial_schema( 'entry' ); ?>>

		<div class="entry-image-wrapper" <?php perennial_post_thumbnail_background(); ?>></div><!-- .entry-image-wrapper -->

		<div class="entry-content-wrapper skin-card skin-card-archive">

			<div class="entry-meta entry-meta-header-before">
				<?php perennial_posted_on(); ?>
			</div><!-- .entry-meta -->

			<header class="entry-header entry-header-archive">
				<?php the_title( sprintf( '<h1 class="entry-title" %2$s><a href="%1$s" rel="bookmark">', esc_url( get_permalink() ), perennial_schema( 'entry-title', false ) ), '</a></h1>' ); ?>
			</header><!-- .entry-header -->

			<?php if ( perennial_has_excerpt() ) : ?>
			<div class="entry-summary" <?php perennial_schema( 'entry-summary' ); ?>>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php endif; ?>

			<div class="more-link-wrapper">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php esc_html_e( 'Continue Reading', 'perennial-pro' ); ?></a>
			</div><!-- .more-link-wrapper -->

		</div><!-- .entry-content-wrapper -->

</article><!-- #post-## -->
