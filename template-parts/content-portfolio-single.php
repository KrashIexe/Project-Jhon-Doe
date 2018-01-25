<?php
/**
 * Template part for displaying single projects.
 *
 * @package Perennial
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php perennial_schema( 'entry' ); ?>>

	<div class="entry-header-wrapper-single">
		<header class="entry-header entry-header-single">
			<?php the_title( sprintf( '<h1 class="entry-title entry-title-single" %1$s>', perennial_schema( 'entry-title', false ) ), '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-meta entry-meta-header-after">
			<?php
				perennial_posted_by();
				perennial_posted_on();
			?>
		</div><!-- .entry-meta -->
	</div><!-- .entry-header-wrapper-single -->

	<div class="entry-content" <?php perennial_schema( 'entry-content' ); ?>>
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

	<footer class="entry-meta entry-meta-footer">
		<?php perennial_jetpack_portfolio_entry_footer(); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-## -->
