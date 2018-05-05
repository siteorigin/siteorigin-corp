<?php
/**
 * Custom WooCommerce template tags for this theme.
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

if ( ! function_exists( 'siteorigin_corp_woocommerce_change_hooks' ) ) :
/**
 * Change default WooCommerce hooks as required.
 */
function siteorigin_corp_woocommerce_change_hooks() {

	// Modify the archive content.
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'siteorigin_corp_woocommerce_archive_product_image', 10 );
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	// Use a custom upsell function to change number of items.
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'siteorigin_corp_woocommerce_output_upsells', 15 );

	// Remove the cross-sell display.
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

	// Add Quick View hooks.
	add_action( 'siteorigin_corp_woocommerce_quick_view_images', 'siteorigin_corp_woocommerce_quick_view_image', 5 );
	add_action( 'siteorigin_corp_woocommerce_quick_view_title', 'woocommerce_template_single_title', 5 );
	add_action( 'siteorigin_corp_woocommerce_quick_view_title', 'woocommerce_template_single_rating', 15 );
	add_action( 'siteorigin_corp_woocommerce_quick_view_content', 'woocommerce_template_single_price', 10 );
	add_action( 'siteorigin_corp_woocommerce_quick_view_content', 'woocommerce_template_single_excerpt', 15 );
	add_action( 'siteorigin_corp_woocommerce_quick_view_content', 'woocommerce_template_single_add_to_cart', 20 );	

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
		$notice = __( 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'siteorigin-corp' );
	}

	echo '<p class="woocommerce-store-notice demo_store">' . wp_kses_post( $notice ) . ' <a href="#" class="woocommerce-store-notice__dismiss-link">' . esc_html__( 'Dismiss', 'siteorigin-corp' ) . '</a></p>';
}

if ( ! function_exists( 'siteorigin_corp_woocommerce_archive_product_image' ) ) :
/**
 * Archive product images.
 */
function siteorigin_corp_woocommerce_archive_product_image() { ?>
	<div class="loop-product-thumbnail">
		<?php woocommerce_template_loop_product_link_open(); ?>
		<?php woocommerce_template_loop_product_thumbnail(); ?>
		<?php woocommerce_template_loop_product_link_close(); ?>
		<?php if ( siteorigin_setting( 'quick_view' ) && ! ( siteorigin_setting( 'archive_columns' ) == 5 ) ) {
			siteorigin_corp_woocommerce_quick_view_button();
		} ?>		
		<?php if ( siteorigin_setting( 'add_to_cart' ) && ! ( siteorigin_setting( 'archive_columns' ) == 5 ) ) {
			woocommerce_template_loop_add_to_cart();
		} ?>
	</div>
<?php }
endif;

if ( ! function_exists( 'siteorigin_corp_woocommerce_description_title' ) ) :
/**
 * Remove the product description title.
 */
function siteorigin_corp_woocommerce_description_title() {
	return '';
}
endif;
add_filter( 'woocommerce_product_description_heading', 'siteorigin_corp_woocommerce_description_title' );

if ( ! function_exists( 'siteorigin_corp_woocommerce_paypal_icon' ) ) :
/**
 * Add a consistent PayPal icon.
 */
function siteorigin_corp_woocommerce_paypal_icon( $url ) {
	return get_template_directory_uri() . '/woocommerce/images/paypal-icon.png';
}
endif;
add_filter( 'woocommerce_paypal_icon', 'siteorigin_corp_woocommerce_paypal_icon' );

if ( ! function_exists( 'siteorigin_corp_woocommerce_reviews_title' ) ) :
/**
 * Remove the product reviews title.
 */
function siteorigin_corp_woocommerce_reviews_title() {
	return '';
}
endif;
add_filter( 'woocommerce_product_review_heading', 'siteorigin_corp_woocommerce_reviews_title' );

if ( ! function_exists( 'siteorigin_corp_woocommerce_tag_cloud_widget' ) ) :
/**
 * Filter the WooCommerce Tag Cloud widget.
 */
function siteorigin_corp_woocommerce_tag_cloud_widget() {
	$args['unit'] = 'px';
	$args['largest'] = 13;
	$args['smallest'] = 13;
	$args['taxonomy'] = 'product_tag';
	return $args;	
}
endif;
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'siteorigin_corp_woocommerce_tag_cloud_widget' );

if ( ! function_exists( 'siteorigin_corp_woocommerce_output_upsells' ) ) {
	/*
	 * Change the number of up-sell items.
	 *
	 * @link https://docs.woocommerce.com/document/change-number-of-upsells-output/
	 */
	function siteorigin_corp_woocommerce_output_upsells() {
		woocommerce_upsell_display( 4, 4 );
	}
}

if ( ! function_exists( 'siteorigin_corp_woocommerce_quick_view_button' ) ) :
/**
 * Quick view button for the products in loop
 */
function siteorigin_corp_woocommerce_quick_view_button() {
	global $product;
	echo '<a href="#" id="product-id-' . $product->get_id() . '" class="button product-quick-view-button" data-product-id="' . $product->get_id() . '">' . esc_html__( 'Quick View', 'siteorigin-corp') . '</a>';
}
endif;

if ( ! function_exists( 'siteorigin_corp_woocommerce_quick_view_image' ) ) :
/**
 * Displays image in the product quick view.
 */
function siteorigin_corp_woocommerce_quick_view_image() {
	echo woocommerce_get_product_thumbnail( 'shop_single' );
}
endif;

if ( ! function_exists( 'siteorigin_corp_woocommerce_quick_view' ) ) :
/**
 * Setup quick view modal in the footer.
 */
function siteorigin_corp_woocommerce_quick_view() { ?>
	<?php if ( siteorigin_setting( 'quick_view' ) ) : ?>
		<!-- WooCommerce Quick View -->
		<div id="quick-view-container">
			<div id="product-quick-view" class="quick-view"></div>
		</div>
	<?php endif; ?>
<?php }
endif;
add_action( 'wp_footer', 'siteorigin_corp_woocommerce_quick_view', 100 );

if ( ! function_exists( 'siteorigin_corp_product_quick_view_ajax' ) ) :
/**
 * Add the Quick View modal content.
 */
function siteorigin_corp_product_quick_view_ajax() {

	if ( ! isset( $_REQUEST['product_id'] ) ) {
		die();
	}
	$product_id = intval( $_REQUEST['product_id'] );

	// Set the main wp query for the product.
	wp( 'p=' . $product_id . '&post_type=product' );

	ob_start();
	// Load content template.
	wc_get_template( 'quick-view.php' );
	echo ob_get_clean();

	die();
}
endif;
add_action( 'wp_ajax_siteorigin_corp_product_quick_view', 'siteorigin_corp_product_quick_view_ajax' );
add_action( 'wp_ajax_nopriv_siteorigin_corp_product_quick_view', 'siteorigin_corp_product_quick_view_ajax' );
