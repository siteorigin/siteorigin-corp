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

	<?php do_action( 'siteorigin_corp_footer_before' ); ?>

	<footer id="colophon" class="site-footer">

		<?php do_action( 'siteorigin_corp_footer_top' ); ?>

		<?php if ( siteorigin_page_setting( 'footer_widgets' ) ) : ?>
			<div class="corp-container">
				<?php
					if ( is_active_sidebar( 'sidebar-footer' ) ) {
						$corp_sidebars = wp_get_sidebars_widgets();
						?>
						<div class="widgets widgets-<?php echo count( $corp_sidebars['sidebar-footer'] ) ?>" aria-label="<?php esc_attr_e( 'Footer Widgets', 'siteorigin-corp' ); ?>">
							<?php dynamic_sidebar( 'sidebar-footer' ); ?>
						</div>
						<?php
					}
				?>
			</div><!-- .corp-container -->
		<?php endif; ?>

		<div class="bottom-bar">
			<div class="corp-container">
				<div class="site-info">
						<?php
						siteorigin_corp_footer_text();

						$credit_text = apply_filters(
							'siteorigin_corp_footer_credits',
							sprintf( esc_html__( 'Crafted with love by %s.', 'siteorigin-corp' ), '<a href="https://siteorigin.com/">SiteOrigin</a>' )
						);

						if ( ! empty( $credit_text ) ) {
							?>&nbsp;<?php
							echo wp_kses_post( $credit_text );
						}
						?>
				</div><!-- .site-info -->
				<?php 
					$widget = siteorigin_setting( 'footer_social_widget' ); 
					if ( has_nav_menu( 'menu-2' ) || ! empty( $widget['networks'] ) ) : ?>
					<div class="footer-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'depth' => 1, 'fallback_cb' => '' ) ); ?>
						<?php if ( ! empty( $widget['networks'] ) && class_exists( 'SiteOrigin_Widget_SocialMediaButtons_Widget' ) ) {
		                		the_widget( 'SiteOrigin_Widget_SocialMediaButtons_Widget', $widget ); 
		                	} 
		                ?>					
					</div><!-- .footer-menu -->					
				<?php endif; ?>
			</div><!-- .corp-container -->
		</div><!-- .bottom-bar -->

	<?php do_action( 'siteorigin_corp_footer_bottom' ); ?>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( siteorigin_setting( 'navigation_scroll_to_top' ) ) : ?>
	<div id="scroll-to-top">
		<span class="screen-reader-text"><?php esc_html_e( 'Scroll to top', 'siteorigin-corp' ); ?></span>
		<?php siteorigin_corp_display_icon( 'up-arrow' ); ?>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>
<?php do_action( 'siteorigin_corp_footer_after' ); ?>

</body>
</html>
