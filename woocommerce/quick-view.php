<?php
/**
 * The template for displaying WooCommerce product Quick View.
 *
 * @license GPL 2.0
 */
while ( have_posts() ) {
	the_post();

	global $post, $product;

	if ( ! function_exists( 'siteorigin_corp_woocommerce_quick_view_class' ) ) {
		/**
		 * Adds the product-quick-view class to the Quick View post.
		 */
		function siteorigin_corp_woocommerce_quick_view_class( $classes ) {
			$classes[] = 'product';
			$classes[] = 'product-quick-view';

			return $classes;
		}
	}
	add_filter( 'post_class', 'siteorigin_corp_woocommerce_quick_view_class' );

	?>
	<div class="woocommerce">

		<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php do_action( 'siteorigin_corp_woocommerce_quick_view_before_product' ); ?>

			<div class="product-content-wrapper">
				<?php do_action( 'siteorigin_corp_woocommerce_quick_view_before_image' ); ?>

				<div class="product-image-wrapper">
					<?php do_action( 'siteorigin_corp_woocommerce_quick_view_images' ); ?>
				</div>

				<?php do_action( 'siteorigin_corp_woocommerce_quick_view_after_image' ); ?>

				<div class="product-info-wrapper">

					<a class="quickview-close">
						<span class="screen-reader-text"><?php esc_html_e( 'Close Quick View modal window', 'siteorigin-corp' ); ?></span>
						<span class="quickview-close-icon">+</span>
					</a>

					<?php do_action( 'siteorigin_corp_woocommerce_quick_view_before_title' ); ?>
					<a href="<?php the_permalink(); ?>">
						<?php do_action( 'siteorigin_corp_woocommerce_quick_view_title' ); ?>
					</a>
					<?php do_action( 'siteorigin_corp_woocommerce_quick_view_after_title' ); ?>

					<?php do_action( 'siteorigin_corp_woocommerce_quick_view_before_content' ); ?>
					<?php do_action( 'siteorigin_corp_woocommerce_quick_view_content' ); ?>
					<?php do_action( 'siteorigin_corp_woocommerce_quick_view_after_content' ); ?>
				</div>

			</div>

			<?php do_action( 'siteorigin_corp_woocommerce_quick_view_after_product' ); ?>

		</div>

	</div>

<?php }
