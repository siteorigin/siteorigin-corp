<?php
/**
 * Custom WooCommerce template tags for this theme.
 *
 * @package polestar
 * @license GPL 2.0 
 */

if ( ! function_exists( 'siteorigin_corp_woocommerce_change_hooks' ) ) :
/**
 * Change default WooCommerce hooks as required.
 */
function siteorigin_corp_woocommerce_change_hooks() {

	// Remove store notice hook.
	remove_action( 'wp_footer', 'woocommerce_demo_store' );

}
endif;
add_action( 'after_setup_theme', 'siteorigin_corp_woocommerce_change_hooks' );

/**
 * Output the store notification.
 */
function siteorigin_corp_woocommerce_demo_store() {
	if ( ! is_store_notice_showing() ) {
		return;
	}

	$notice = get_option( 'woocommerce_demo_store_notice' );

	if ( empty( $notice ) ) {
		$notice = __( 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'siteorigin_corp' );
	}

	echo '<p class="woocommerce-store-notice demo_store">' . wp_kses_post( $notice ) . ' <a href="#" class="woocommerce-store-notice__dismiss-link">' . esc_html__( 'Dismiss', 'siteorigin_corp' ) . '</a></p>';
}
