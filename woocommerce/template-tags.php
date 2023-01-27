<?php
/**
 * Custom WooCommerce template tags for this theme.
 *
 * @license GPL 2.0
 */
if ( ! function_exists( 'siteorigin_corp_woocommerce_change_hooks' ) ) {
	/**
	 * Change default WooCommerce hooks as required.
	 */
	function siteorigin_corp_woocommerce_change_hooks() {
		// Modify the archive content.
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'siteorigin_corp_woocommerce_archive_product_image' );

		// Use a custom upsell function to change number of items.
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		add_action( 'woocommerce_after_single_product_summary', 'siteorigin_corp_woocommerce_output_upsells', 15 );

		// Add Quick View hooks.
		add_action( 'siteorigin_corp_woocommerce_quick_view_images', 'siteorigin_corp_woocommerce_quick_view_image', 5 );
		add_action( 'siteorigin_corp_woocommerce_quick_view_title', 'woocommerce_template_single_title', 5 );
		add_action( 'siteorigin_corp_woocommerce_quick_view_title', 'woocommerce_template_single_rating', 15 );
		add_action( 'siteorigin_corp_woocommerce_quick_view_content', 'woocommerce_template_single_price' );
		add_action( 'siteorigin_corp_woocommerce_quick_view_content', 'woocommerce_template_single_excerpt', 15 );
		add_action( 'siteorigin_corp_woocommerce_quick_view_content', 'woocommerce_template_single_add_to_cart', 20 );

		// Remove store notice hook.
		remove_action( 'wp_footer', 'woocommerce_demo_store' );
	}
}
add_action( 'after_setup_theme', 'siteorigin_corp_woocommerce_change_hooks' );

/**
 * Output the store notification.
 */
function siteorigin_corp_woocommerce_demo_store() {
	if ( ! is_store_notice_showing() ) {
		return;
	}

	$notice = get_option( 'woocommerce_demo_store_notice' );

	if ( empty( $notice ) ) {
		$notice = __( 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'siteorigin-corp' );
	}

	echo '<p class="woocommerce-store-notice demo_store">' . wp_kses_post( $notice ) . ' <a href="#" class="woocommerce-store-notice__dismiss-link">' . esc_html__( 'Dismiss', 'siteorigin-corp' ) . '</a></p>';
}

if ( ! function_exists( 'siteorigin_corp_woocommerce_archive_product_image' ) ) {
	/**
	 * Archive product images.
	 */
	function siteorigin_corp_woocommerce_archive_product_image() { ?>
	<div class="loop-product-thumbnail">
		<?php woocommerce_template_loop_product_link_open(); ?>
		<?php woocommerce_template_loop_product_thumbnail(); ?>
		<?php woocommerce_template_loop_product_link_close(); ?>
		<?php if ( siteorigin_setting( 'woocommerce_quick_view' ) && siteorigin_setting( 'woocommerce_quick_view_location' ) == 'hover' ) {
			siteorigin_corp_woocommerce_quick_view_button();
		}

			if ( siteorigin_setting( 'woocommerce_add_to_cart' ) && siteorigin_setting( 'woocommerce_add_to_cart_location' ) == 'hover' ) {
				woocommerce_template_loop_add_to_cart();
			} ?>
	</div>
<?php }
	}

if ( ! function_exists( 'siteorigin_corp_woocommerce_archive_buttons' ) ) {
	/**
	 * Archive product image buttons.
	 */
	function siteorigin_corp_woocommerce_archive_buttons() {
		if ( siteorigin_setting( 'woocommerce_quick_view' ) && siteorigin_setting( 'woocommerce_quick_view_location' ) == 'below' ) {
			siteorigin_corp_woocommerce_quick_view_button();
		}

		if ( siteorigin_setting( 'woocommerce_add_to_cart' ) && siteorigin_setting( 'woocommerce_add_to_cart_location' ) == 'below' ) {
			woocommerce_template_loop_add_to_cart();
		}
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'siteorigin_corp_woocommerce_archive_buttons' );

if ( ! function_exists( 'siteorigin_corp_woocommerce_description_title' ) ) {
	/**
	 * Remove the product description title.
	 */
	function siteorigin_corp_woocommerce_description_title() {
		return '';
	}
}
add_filter( 'woocommerce_product_description_heading', 'siteorigin_corp_woocommerce_description_title' );

if ( ! function_exists( 'siteorigin_corp_woocommerce_paypal_icon' ) ) {
	/**
	 * Add a consistent PayPal icon.
	 */
	function siteorigin_corp_woocommerce_paypal_icon( $url ) {
		return get_template_directory_uri() . '/woocommerce/images/paypal-icon.png';
	}
}
add_filter( 'woocommerce_paypal_icon', 'siteorigin_corp_woocommerce_paypal_icon' );

if ( ! function_exists( 'siteorigin_corp_woocommerce_reviews_title' ) ) {
	/**
	 * Remove the product reviews title.
	 */
	function siteorigin_corp_woocommerce_reviews_title() {
		return '';
	}
}
add_filter( 'woocommerce_product_review_heading', 'siteorigin_corp_woocommerce_reviews_title' );

if ( ! function_exists( 'siteorigin_corp_woocommerce_tag_cloud_widget' ) ) {
	/**
	 * Filter the WooCommerce Tag Cloud widget.
	 */
	function siteorigin_corp_woocommerce_tag_cloud_widget() {
		$args['unit'] = 'px';
		$args['largest'] = 13;
		$args['smallest'] = 13;
		$args['taxonomy'] = 'product_tag';

		return $args;
	}
}
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'siteorigin_corp_woocommerce_tag_cloud_widget' );

if ( ! function_exists( 'siteorigin_corp_woocommerce_output_upsells' ) ) {
	/*
	 * Change the number of up-sell items.
	 *
	 * @link https://docs.woocommerce.com/document/change-number-of-upsells-output/
	 */
	function siteorigin_corp_woocommerce_output_upsells() {
		woocommerce_upsell_display( 4, 4 );
	}
}

if ( ! function_exists( 'siteorigin_corp_woocommerce_quick_view_button' ) ) {
	/**
	 * Quick view button for the products in loop
	 */
	function siteorigin_corp_woocommerce_quick_view_button() {
		global $product;

		if ( siteorigin_setting( 'woocommerce_quick_view_location' ) == 'hover' ) {
			echo '<a href="#" id="product-id-' . $product->get_id() . '" class="product-quick-view-button" data-product-id="' . $product->get_id() . '"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="26" height="28" viewBox="0 0 26 28"><path d="M18 13c0-3.859-3.141-7-7-7s-7 3.141-7 7 3.141 7 7 7 7-3.141 7-7zM26 26c0 1.094-0.906 2-2 2-0.531 0-1.047-0.219-1.406-0.594l-5.359-5.344c-1.828 1.266-4.016 1.937-6.234 1.937-6.078 0-11-4.922-11-11s4.922-11 11-11 11 4.922 11 11c0 2.219-0.672 4.406-1.937 6.234l5.359 5.359c0.359 0.359 0.578 0.875 0.578 1.406z"></path></svg></a>';
		} else {
			echo '<a href="#" id="product-id-' . $product->get_id() . '" class="button product-quick-view-button" data-product-id="' . $product->get_id() . '">' . esc_html__( 'Quick View', 'siteorigin-corp' ) . '</a>';
		}

		$gallery = $product->get_gallery_image_ids();

		if ( ! empty( $gallery ) && ! has_action( 'wp_footer', 'siteorigin_corp_enqueue_flexslider' ) ) {
			add_action( 'wp_footer', 'siteorigin_corp_enqueue_flexslider' );
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_woocommerce_quick_view_image' ) ) {
	/**
	 * Displays image in the product quick view.
	 */
	function siteorigin_corp_woocommerce_quick_view_image() {
		global $product;
		$gallery = $product->get_gallery_image_ids();

		if ( empty( $gallery ) && ! has_post_thumbnail() ) {
			return;
		}

		if ( empty( $gallery ) ) {
			echo woocommerce_get_product_thumbnail( 'shop_single' );
		} else {
			?>
		<div class="product-images-slider flexslider">
			<ul class="slides">
				<?php if ( has_post_thumbnail() ) {
					$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_element = get_the_post_thumbnail( $product->get_id(), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'title' => $image_title, 'alt' => $image_title ) );
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li class="slide product-featured-image">%s</li>', $image_element ), $product->get_id() );
				} ?>

				<?php if ( $gallery ) {
					foreach ( $gallery as $image ) {
						$image_link = wp_get_attachment_url( $image );
						$image_title = esc_attr( get_the_title( $image ) );
						?>

						<li class="slide product-gallery-image">
							<img src="<?php echo $image_link; ?>" alt="<?php echo $image_title; ?>" title="<?php echo $image_title; ?>" />
						</li>

						<?php
					}
				} ?>

			</ul>

			<ul class="flex-direction-nav">
				<li class="flex-nav-prev">
					<a class="flex-prev" href="#"><?php siteorigin_corp_display_icon( 'left-arrow' ); ?></a>
				</li>
				<li class="flex-nav-next">
					<a class="flex-next" href="#"><?php siteorigin_corp_display_icon( 'right-arrow' ); ?></a>
				</li>
			</ul>
		</div>
	<?php
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_woocommerce_quick_view' ) ) {
	/**
	 * Setup quick view modal in the footer.`
	 */
	function siteorigin_corp_woocommerce_quick_view() { ?>
	<?php if ( siteorigin_setting( 'woocommerce_quick_view' ) ) { ?>
		<!-- WooCommerce Quick View -->
		<div id="quick-view-container">
			<div id="product-quick-view" class="quick-view"></div>
		</div>
	<?php } ?>
<?php }
	}
add_action( 'wp_footer', 'siteorigin_corp_woocommerce_quick_view', 100 );

if ( ! function_exists( 'siteorigin_corp_product_quick_view_ajax' ) ) {
	/**
	 * Add the Quick View modal content.
	 */
	function siteorigin_corp_product_quick_view_ajax() {
		if ( ! isset( $_REQUEST['product_id'] ) ) {
			die();
		}
		$product_id = intval( $_REQUEST['product_id'] );

		// Set the main wp query for the product.
		wp( 'p=' . $product_id . '&post_type=product' );

		ob_start();
		// Load content template.
		wc_get_template( 'quick-view.php' );
		echo ob_get_clean();

		die();
	}
}
add_action( 'wp_ajax_siteorigin_corp_product_quick_view', 'siteorigin_corp_product_quick_view_ajax' );
add_action( 'wp_ajax_nopriv_siteorigin_corp_product_quick_view', 'siteorigin_corp_product_quick_view_ajax' );
