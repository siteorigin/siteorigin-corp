<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

if ( ! is_active_sidebar( 'sidebar-main' ) ) return;
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-main' ); ?>
</aside><!-- #secondary -->
