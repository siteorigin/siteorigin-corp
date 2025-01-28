<?php
/**
 * Single Product Up-Sells
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

	<section class="up-sells upsells products">
		<?php
		$heading = apply_filters(
			'woocommerce_product_upsells_products_heading',
			__( 'You may also like', 'siteorigin-corp' )
		);

		if ( $heading ) {
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php
		}

		woocommerce_product_loop_start();
		foreach ( $upsells as $upsell ) {
			$post_object = get_post( $upsell->get_id() );
			setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
			wc_get_template_part( 'content', 'product' );
			
		}

		woocommerce_product_loop_end();
		?>
	</section>

	<?php
endif;

wp_reset_postdata();
