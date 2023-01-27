<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @see https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @license GPL 2.0
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'siteorigin-corp' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'Try the search form below or browse using the main menu above.', 'siteorigin-corp' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
