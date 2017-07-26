<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package siteorigin-corp
 * @license GPL 2.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function siteorigin_corp_body_classes( $classes ) {
	// Group blog.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Mobile compatibility classes.
	$classes[] = 'css3-animations';
	$classes[] = 'no-js';
	$classes[] = 'no-touch';

	// Responsive layout.
	$classes[] = 'responsive';

	// Sidebar.
	if ( is_active_sidebar( 'sidebar-main' ) ) {
		 $classes[] = 'sidebar';
	}

	// WooCommerce sidebar.
	if ( is_active_sidebar( 'shop-sidebar' ) ) {
		 $classes[] = 'woocommerce-sidebar';
	}		

	// Non-singlar pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}		

	return $classes;
}
add_filter( 'body_class', 'siteorigin_corp_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function siteorigin_corp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'siteorigin_corp_pingback_header' );

if ( ! function_exists( 'siteorigin_corp_post_class_filter' ) ) :
/**
* Filter post classes as required.
* @link https://codex.wordpress.org/Function_Reference/post_class.
*/
function siteorigin_corp_post_class_filter( $classes ) {
	$classes[] = 'post';

	// Resolves structured data issue in core. See https://core.trac.wordpress.org/ticket/28482.
	if ( is_page() ) {
		$class_key = array_search( 'hentry', $classes );

		if ( $class_key !== false) {
			unset( $classes[ $class_key ] );
		}
	}

	$classes = array_unique( $classes );
	return $classes;
}
endif;
add_filter( 'post_class', 'siteorigin_corp_post_class_filter' );
