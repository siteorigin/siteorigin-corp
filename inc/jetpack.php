<?php
/**
 * Jetpack Compatibility File.
 *
 * @see https://jetpack.me/
 *
 * @license GPL 2.0
 */

/**
 * Jetpack setup function.
 *
 * See https://jetpack.com/support/featured-content/
 * See: https://jetpack.me/support/infinite-scroll/
 */
function siteorigin_corp_jetpack_setup() {
	/*
	 * Enable support for Jetpack Featured Content.
	 * See https://jetpack.com/support/featured-content/
	 */
	add_theme_support( 'featured-content', array(
		'filter'     => 'siteorigin_corp_get_featured_posts',
		'post_types' => array( 'post' ),
	) );

	/*
	 * Enable support for Jetpack Infinite Scroll.
	 * See https://jetpack.com/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render' => 'siteorigin_corp_infinite_scroll_render',
		'footer' => 'page',
	) );

	/*
	 * Enable support for Jetpack Portfolio custom post type.
	 * See https://jetpack.com/support/custom-content-types/
	 */
	add_theme_support( 'jetpack-portfolio' );
}
add_action( 'after_setup_theme', 'siteorigin_corp_jetpack_setup' );

/**
 * Remove the Jetpack stylesheets we don't require.
 */
function siteorigin_corp_remove_jetpack_css() {
	wp_deregister_style( 'jetpack-portfolio-style' );
}
add_action( 'wp_footer', 'siteorigin_corp_remove_jetpack_css' );

if ( ! function_exists( 'siteorigin_corp_infinite_scroll_render' ) ) {
	/**
	 * Custom render function for Infinite Scroll.
	 */
	function siteorigin_corp_infinite_scroll_render() {
		if ( is_search() ) {
			?>
			<div class="corp-search-results">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', 'search' );
				}
				?>
			</div>
		<?php
		} elseif ( function_exists( 'is_woocommerce' ) && ( is_shop() || is_woocommerce() ) ) {
			echo '<ul class="products columns-' . esc_attr( wc_get_loop_prop( 'columns' ) ) . '">';

			while ( have_posts() ) {
				the_post();
				wc_get_template_part( 'content', 'product' );
			}
			echo '</ul>';
		} elseif ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) { ?>
			<div id="projects-container">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', 'portfolio' );
				}
				?>
			</div>
			<?php
		} elseif ( siteorigin_setting( 'blog_archive_layout' ) == 'grid' ) { ?>
			<div class="blog-layout-grid">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				}
				?>
			</div>
			<?php
		} elseif ( siteorigin_setting( 'blog_archive_layout' ) == 'standard' ) { ?>
			<div class="blog-layout-standard">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				}
				?>
			</div>
			<?php
		} elseif ( siteorigin_setting( 'blog_archive_layout' ) == 'offset' ) { ?>
			<div class="blog-layout-offset">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				}
				?>
			</div>
		<?php
		} elseif ( siteorigin_setting( 'blog_archive_layout' ) == 'alternate' ) { ?>
			<div class="blog-layout-alternate">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				}
				?>
			</div>
			<?php
		} elseif ( siteorigin_setting( 'blog_archive_layout' ) == 'masonry' ) {
			wp_enqueue_script( 'jquery-masonry' ); ?>
			<div class="blog-layout-masonry">
				<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', get_post_format() );
					}
					?>
			</div>
			<?php
		} else {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			}
		}
	}
}

/**
 * Remove sharing buttons from their default locations.
 */
function siteorigin_corp_remove_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );

	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'siteorigin_corp_remove_share' );

if ( ! function_exists( 'siteorigin_corp_jetpack_related_projects' ) ) {
	/**
	 * Displays jetpack related posts for projects.
	 */
	function siteorigin_corp_jetpack_related_projects( $allowed_post_types ) {
		$allowed_post_type[] = 'jetpack-portfolio';

		return $allowed_post_type;
	}
}
add_filter( 'rest_api_allowed_post_types', 'siteorigin_corp_jetpack_related_projects' );

if ( ! function_exists( 'siteorigin_corp_jetpackme_related_posts_headline' ) ) {
	/**
	 * Changing the Jetpack Related Posts title.
	 */
	function siteorigin_corp_jetpackme_related_posts_headline( $headline ) {
		$headline = sprintf(
			'<h3 class="jp-relatedposts-headline">%s</h3>',
			esc_html__( 'Related Posts', 'siteorigin-corp' )
		);

		return $headline;
	}
}
add_filter( 'jetpack_relatedposts_filter_headline', 'siteorigin_corp_jetpackme_related_posts_headline' );

if ( ! function_exists( 'siteorigin_corp_jetpackme_remove_rp' ) ) {
	/**
	 * Removing Jetpack Related Posts from the bottom of posts.
	 */
	function siteorigin_corp_jetpackme_remove_rp() {
		if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
			$jprp = Jetpack_RelatedPosts::init();
			$callback = array( $jprp, 'filter_add_target_to_dom' );
			remove_filter( 'the_content', $callback, 40 );
		}
	}
}
add_filter( 'wp', 'siteorigin_corp_jetpackme_remove_rp', 20 );
