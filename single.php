<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) {
			the_post(); 

			get_template_part( 'template-parts/content', get_post_format() );

			if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'sharedaddy' ) ) {
				echo sharing_display();
			}

			if ( siteorigin_setting( 'navigation_post' ) ) {
				siteorigin_corp_the_post_navigation();
			}

			if ( siteorigin_setting( 'blog_post_author_box' ) ) {
				siteorigin_corp_author_box();
			}

			if ( ! is_attachment() && siteorigin_setting( 'blog_related_posts' ) ) {
				siteorigin_corp_related_posts( $post->ID );
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

		} // End while.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
