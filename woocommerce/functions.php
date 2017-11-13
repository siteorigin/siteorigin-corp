<?php
/**
 * Add theme support for Woocommerce.
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

function siteorigin_corp_woocommerce_setup() {

	/**
	 * Add support for WooCommerce.
	 * @link https://docs.woocommerce.com/document/declare-woocommerce-support-in-third-party-theme/
	 */
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'siteorigin_corp_woocommerce_setup' );	

/**
 * Custom WooCommerce template tags.
 */
include get_template_directory() . '/woocommerce/template-tags.php';
