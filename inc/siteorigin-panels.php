<?php
/**
 * Compatibility with Page Builder by SiteOrigin.
 *
 * @link https://wordpress.org/plugins/siteorigin-panels/
 *
 * @package siteorigin-corp
 * @license GPL 2.0
 */

/**
 * Remove Post Loop widget templates that aren't complete loops.
 */
function siteorigin_unwind_filter_post_loop_widget( $templates ) {
    $disallowed_template_patterns = array(
        'template-parts/content.php',
        'template-parts/content-gallery.php',
        'template-parts/content-image.php',
        'template-parts/content-none.php',
        'template-parts/content-page.php',
        'template-parts/content-search.php',
        'template-parts/content-single.php',
        'template-parts/content-video.php'
    );
    foreach ( $templates as $template ) {
        if ( in_array( $template, $disallowed_template_patterns ) ) {
            $key = array_search( $template, $templates );
            if ( false !== $key ) {
                unset( $templates[$key] );
            }
        }
    }
    return $templates;	
}
add_filter( 'siteorigin_panels_postloop_templates', 'siteorigin_unwind_filter_post_loop_widget', 10, 1 );
