<?php
/**
 * The template for displaying Jetpack Portfolio archive pages.
 *
 * @see https://codex.wordpress.org/Template_Hierarchy
 *
 * @license GPL 2.0
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php if ( siteorigin_page_setting( 'page_title' ) && siteorigin_page_setting( 'overlap' ) == 'disabled' ) { ?>
				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				</header><!-- .page-header -->
			<?php } ?>

			<?php get_template_part( 'loops/loop', 'portfolio' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
