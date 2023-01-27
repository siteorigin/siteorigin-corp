<?php
/**
 * The sidebar for WooCommerce shop pages.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @license GPL 2.0
 */
if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
	return;
}

if ( is_product() ) {
	return;
}

if ( siteorigin_page_setting( 'layout' ) != 'default' ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</aside><!-- #secondary -->
