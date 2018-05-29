<?php
/**
 * Deprecated functions.
 *
 * @package siteorigin-corp
 * @license GPL 2.0
 */

if ( ! function_exists( 'siteorigin_corp_excerpt_length' ) ) :
/**
 * Filter the excerpt length.
 * @deprecated 1.4.3 Use siteorigin_corp_excerpt()
 */
function siteorigin_corp_excerpt_length( $length ) {
	return siteorigin_setting( 'blog_excerpt_length' );
}
add_filter( 'excerpt_length', 'siteorigin_corp_excerpt_length', 10 );
endif;

if ( ! function_exists( 'siteorigin_corp_excerpt_more' ) ) :
/**
 * Add a more link to the excerpt.
 * @deprecated 1.4.3 Use siteorigin_corp_excerpt() 
 */
function siteorigin_corp_excerpt_more( $more ) {
	if ( is_search() ) return;
	if ( siteorigin_setting( 'blog_archive_content' ) == 'excerpt' && siteorigin_setting( 'blog_post_excerpt_read_more_link' ) ) {
		$read_more_text = esc_html__( 'Continue reading', 'siteorigin-corp' );
		return '<a class="more-link" href="' . get_permalink() . '"><span class="more-text">' . $read_more_text . ' <span class="icon-long-arrow-right"></span></span></a>';
	}
}
endif;
add_filter( 'excerpt_more', 'siteorigin_corp_excerpt_more' );
