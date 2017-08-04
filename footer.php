<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

?>

		</div><!-- .corp-container -->
	</div><!-- #content -->

	<?php do_action( 'siteorigin_corp_before' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php do_action( 'siteorigin_corp_top' ); ?>

		<div class="corp-container">
			<?php
				if ( is_active_sidebar( 'sidebar-footer' ) ) {
					$corp_sidebars = wp_get_sidebars_widgets();
					?>
					<div class="widgets widgets-<?php echo count( $corp_sidebars['sidebar-footer'] ) ?>" role="complementary" aria-label="<?php esc_html_e( 'Footer Widgets', 'siteorigin-corp' ); ?>">
						<?php dynamic_sidebar( 'sidebar-footer' ); ?>
					</div>
					<?php
				}
			?>
		</div><!-- .corp-container -->
		<div class="bottom-bar">
			<div class="corp-container">
				<div class="site-info">
						<?php
						siteorigin_corp_footer_text();

						$credit_text = apply_filters(
							'siteorigin_corp_footer_credits',
							sprintf( esc_html__( 'Crafted with love by %s.', 'siteorigin-corp' ), '<a href="https://siteorigin.com/" rel="designer">SiteOrigin</a>' )
						);

						if ( ! empty( $credit_text ) ) {
							?>&nbsp;<?php
							echo wp_kses_post( $credit_text );
						}
						?>
				</div><!-- .site-info -->
				<?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'container_class' => 'footer-menu', 'depth' => 1, 'fallback_cb' => '' ) ); ?>	
			</div><!-- .corp-container -->
		</div><!-- .bottom-bar -->

		<?php do_action( 'siteorigin_corp_bottom' ); ?>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<div id="scroll-to-top">
	<span class="screen-reader-text"><?php esc_html_e( 'Scroll to top', 'siteorigin-corp' ); ?></span>
	<?php siteorigin_corp_display_icon( 'up-arrow' ); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
