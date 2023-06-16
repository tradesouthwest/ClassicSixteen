<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ClassicSixteen
 * @since ClassicSixteen 1.0.3
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'classicsixteen' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu',
							)
						);
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'classicsixteen' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							)
						);
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>
			<div class="clear"></div>

			<div class="footer-widget-section">
				<div class="footer-item-left">
				    <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
					<div id="secondary" class="sidebar widget-area" role="complementary">
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
					</div>
				    <?php endif; ?>
				</div>
				<div class="footer-item-right">
				    <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
					<div id="secondary" class="sidebar widget-area" role="complementary">
						<?php dynamic_sidebar( 'sidebar-3' ); ?>
					</div>
				    <?php endif; ?>
				</div><!-- .footer .widget-section -->
			</div>
			
			<div class="site-info">
				<p><?php
					/**
					 * Fires before the classicsixteen footer text for footer customization.
					 *
					 * @since ClassicSixteen 1.0
					 */
					do_action( 'classicsixteen_credits' );
				?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<a href="<?php echo esc_url( __( 'https://www.classicpress.net/', 'classicsixteen' ) ); ?>" class="imprint">
					<?php
					/* translators: %s: WordPress */
					printf( esc_attr__( 'Proudly powered by %s', 'classicsixteen' ), 'ClassicPress' );
					?>
				</a></p>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
