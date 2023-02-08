<?php
/**
 * Deprecated functions.
 *
 * @license GPL 2.0
 */
if ( ! function_exists( 'siteorigin_corp_excerpt_more' ) ) {
	/**
	 * Add a more link to the excerpt.
	 *
	 * @deprecated 1.4.3 Use siteorigin_corp_excerpt()
	 */
	function siteorigin_corp_excerpt_more( $more ) {
		if ( is_search() ) {
			return;
		}

		if ( siteorigin_setting( 'blog_archive_content' ) == 'excerpt' && siteorigin_setting( 'blog_post_excerpt_read_more_link' ) ) {
			$read_more_text = esc_html__( 'Continue reading', 'siteorigin-corp' );

			return '<a class="more-link" href="' . get_permalink() . '"><span class="more-text">' . $read_more_text . ' <span class="icon-long-arrow-right"></span></span></a>';
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_woocommerce_archive_product_image_buttons' ) ) {
	/**
	 * Archive product image buttons.
	 */
	function siteorigin_corp_woocommerce_archive_product_image_buttons() { ?>
	<?php if ( siteorigin_setting( 'woocommerce_quick_view' ) ) {
		siteorigin_corp_woocommerce_quick_view_button();
	}

if ( siteorigin_setting( 'woocommerce_add_to_cart' ) ) {
	woocommerce_template_loop_add_to_cart();
} ?>
<?php }
	}
