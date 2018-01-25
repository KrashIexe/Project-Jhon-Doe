<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Perennial
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo" <?php perennial_schema( 'site-footer' ); ?>>

		<?php if ( perennial_has_footer_widgets() ) : ?>
		<div id="supplementary" class="site-footer-widgets skin-footer-widgets">

			<div class="site-footer-widgets-wrapper">
				<div class="container">
					<div class="row">

						<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
							<div id="footer-sidebar-first" class="footer-sidebar footer-sidebar-first widget-area" role="complementary">
								<?php dynamic_sidebar( 'sidebar-2' ); ?>
							</div><!-- .footer-sidebar -->
						</div><!-- .col-* -->
						<?php endif; ?>

						<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
							<div id="footer-sidebar-second" class="footer-sidebar footer-sidebar-second widget-area" role="complementary">
								<?php dynamic_sidebar( 'sidebar-3' ); ?>
							</div><!-- .footer-sidebar -->
						</div><!-- .col-* -->
						<?php endif; ?>

						<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
							<div id="footer-sidebar-third" class="footer-sidebar footer-sidebar-third widget-area" role="complementary">
								<?php dynamic_sidebar( 'sidebar-4' ); ?>
							</div><!-- .footer-sidebar -->
						</div><!-- .col-* -->
						<?php endif; ?>

					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .site-footer-widgets-wrapper -->

		</div><!-- #supplementary -->
		<?php endif; // end footer widget area ?>

		<?php if ( has_nav_menu( 'social-menu-footer' ) ) : ?>
		<div class="social-menu-footer-wrapper skin-footer-social">
			<div class="container">
				<div class="row">
					<div class="col-xxl-12">
						<?php
						wp_nav_menu( apply_filters( 'perennial_social_menu_footer_args', array(
							'container'       => 'div',
							'container_class' => 'site-social-menu-footer',
							'theme_location'  => 'social-menu-footer',
							'menu_class'      => 'social-menu-footer',
							'menu_id'         => 'menu-4',
							'depth'           => 1,
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>',
						) ) );
						?>
					</div><!-- .col -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .social-menu-footer-wrapper -->
		<?php endif; ?>

		<div class="site-info-wrapper skin-footer-info">
			<div class="container">

				<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
				<div class="row">
					<div class="col-xxl-12">
						<nav id="secondary-navigation" class="secondary-navigation" role="navigation" <?php perennial_schema( 'site-footer-menu' ); ?>>
							<?php
							wp_nav_menu( apply_filters( 'perennial_footer_menu_args', array(
								'container'       => 'div',
								'container_class' => 'site-footer-menu',
								'theme_location'  => 'footer-menu',
								'menu_class'      => 'footer-menu',
								'menu_id'         => 'menu-2',
								'depth'           => 1,
							) ) );
							?>
						</nav><!-- .secondary-navigation -->
					</div><!-- .col -->
				</div><!-- .row -->
				<?php endif; ?>

				<div class="row">
					<div class="col-xxl-12">
						<div class="credits">
							<?php do_action( 'perennial_credits' ); ?>
						</div><!-- .credits -->
					</div><!-- .col -->
				</div><!-- .row -->

			</div><!-- .container -->
		</div><!-- .site-info-wrapper -->

	</footer><!-- #colophon -->

</div><!-- #page .site-wrapper -->

<div class="overlay"></div><!-- .overlay -->
<div class="back-to-top">
	<a href="#"><?php esc_html_e( 'Top', 'perennial-pro' ); ?></a>
</div><!-- .back-to-top -->

<?php get_sidebar( perennial_sidebar_template() ); ?>
<?php wp_footer(); ?>
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>

</body>
</html>
