<?php
/**
 * Loop Name: Blog Standard
 *
 * @license GPL 2.0
 */
if ( have_posts() ) { ?>

	<div class="blog-layout-standard">

		<?php
			/* Start the Loop */
			while ( have_posts() ) {
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );
			} ?>

	</div><?php

	if ( is_rtl() ) {
		the_posts_pagination( array(
			'prev_text' => '&rarr;',
			'next_text' => '&larr;',
		) );
	} else {
		the_posts_pagination( array(
			'prev_text' => '&larr;',
			'next_text' => '&rarr;',
		) );
	}
} else {
	get_template_part( 'template-parts/content', 'none' );
} ?>
