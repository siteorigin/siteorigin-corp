<?php
/**
 * Add theme support for Woocommerce.
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

/**
 * Add support for WooCommerce.
 * @link https://docs.woocommerce.com/document/declare-woocommerce-support-in-third-party-theme/
 */
add_theme_support( 'woocommerce' );

/**
 * Remove the default WooCommerce stylesheets.
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Enqueue WooCommerce scripts and styles.
 */
function siteorigin_corp_woocommerce_scripts() {
	wp_enqueue_style( 'siteorigin-corp-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), SITEORIGIN_THEME_VERSION );

	// WooCommerce JavaScript.
	if ( is_woocommerce() || is_cart() ) {
		wp_enqueue_script( 'siteorigin-corp-woocommerce-script', get_template_directory_uri() . '/js/jquery.woocommerce'  . SITEORIGIN_THEME_JS_PREFIX .  '.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION, true );
	}

	$script_data = array(
		'chevron_down' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10" height="10" viewBox="0 0 32 32"><path d="M30.054 14.429l-13.25 13.232q-0.339 0.339-0.804 0.339t-0.804-0.339l-13.25-13.232q-0.339-0.339-0.339-0.813t0.339-0.813l2.964-2.946q0.339-0.339 0.804-0.339t0.804 0.339l9.482 9.482 9.482-9.482q0.339-0.339 0.804-0.339t0.804 0.339l2.964 2.946q0.339 0.339 0.339 0.813t-0.339 0.813z"></path></svg>',
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	);
	wp_localize_script( 'siteorigin-corp-woocommerce-script', 'siteorigin_corp_data', $script_data );		
}
add_action( 'wp_enqueue_scripts', 'siteorigin_corp_woocommerce_scripts' );

// Remove the default WooCommerce containers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

/**
 * Markup to be outputted before WooCommerce content.
 */
function siteorigin_corp_woocommerce_wrapper_before() {
	echo '<div id="primary" class="content-area"><main id="main" class="site-main" role="main">';
}
add_action( 'woocommerce_before_main_content', 'siteorigin_corp_woocommerce_wrapper_before' );

/**
 * Markup to be outputted after WooCommerce content.
 */
function siteorigin_corp_woocommerce_wrapper_after() {
	echo '</main><!-- #main --></div><!-- #primary -->';
}
add_action( 'woocommerce_after_main_content', 'siteorigin_corp_woocommerce_wrapper_after' );

/**
 * Remove the Add to Cart button from archive pages.
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
