<?php
/**
 * Single Product Up-Sells
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 *
 * @author 		WooThemes
 *
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) {
	?>

	<section class="up-sells upsells products">

		<h2><?php esc_html_e( 'You may also like', 'siteorigin-corp' ); ?></h2>

		<?php
		woocommerce_product_loop_start();
		foreach ( $upsells as $upsell ) {
			$post_object = get_post( $upsell->get_id() );
			setup_postdata( $GLOBALS['post'] = & $post_object );
			wc_get_template_part( 'content', 'product' );
		}
		woocommerce_product_loop_end();
		?>

	</section>

<?php
}
wp_reset_postdata();
