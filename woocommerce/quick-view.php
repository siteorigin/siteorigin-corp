<?php
/**
 * The template for displaying WooCommerce product Quick View.
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

while ( have_posts() ) : the_post();

	global $post, $product;

	if ( ! function_exists( 'siteorigin_corp_woocommerce_quick_view_class' ) ) :
	/**
	 * Adds the product-quick-view class to the Quick View post.
	 */
	function siteorigin_corp_woocommerce_quick_view_class( $classes ) {
		$classes[] = "product-quick-view";
		return $classes;
	}
	endif;
	add_filter( 'post_class', 'siteorigin_corp_woocommerce_quick_view_class' );

	?>
	<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="product-content-wrapper">
	
			<div class="product-image-wrapper">

				<?php do_action( 'siteorigin_corp_woocommerce_quick_view_images' ); ?>

			</div>

			<div class="product-info-wrapper">

				<a class="quickview-close">
					<span class="screen-reader-text"><?php esc_html_e( 'Close Quick View modal window', 'siteorigin-corp' ); ?></span>
					<span class="quickview-close-icon">+</span>
				</a>

				<a href="<?php the_permalink(); ?>">
					<?php do_action( 'siteorigin_corp_woocommerce_quick_view_title' ); ?>
				</a>

				<?php do_action( 'siteorigin_corp_woocommerce_quick_view_content' ); ?>

			</div>

		</div>

	</div>

<?php endwhile;
