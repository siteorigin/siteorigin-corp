<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php if ( siteorigin_page_setting( 'page_title' ) && siteorigin_page_setting( 'overlap' ) == 'disabled' ) : ?>
				<header class="page-header">
					<?php 
						the_archive_title( '<h1 class="page-title">', '</h1>' ); 
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
			<?php endif; ?>

			<?php
			if ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) :

				if ( have_posts() ) : ?>

					<div class="portfolio-archive-layout">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'portfolio' );

						endwhile;
						?>
					</div><?php

					if ( is_rtl() ) :
						the_posts_pagination( array( 
							'prev_text' => '&rarr;', 
							'next_text' => '&larr;' 
						) );
					else :
						the_posts_pagination( array( 
							'prev_text' => '&larr;', 
							'next_text' => '&rarr;' 
						) );
					endif;
					
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;

			else :

				get_template_part( 'loops/loop', 'blog-' . siteorigin_setting( 'blog_archive_layout' ) );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
