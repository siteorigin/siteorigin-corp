<?php
/**
 * Loop Name: Portfolio (only for Jetpack portfolio projects)
 *
 * @license GPL 2.0
 */
?>

<?php if ( post_type_exists( 'jetpack-portfolio' ) && ! ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) ) { ?>
	<?php wp_enqueue_script( 'jquery-isotope' ); ?>
	<div class="portfolio-filter-terms">
		<button data-filter="*" class="active"><?php echo esc_html__( 'All', 'siteorigin-corp' ); ?></button>
		<?php
		$taxonomy = 'jetpack-portfolio-type';
		$tax_terms = get_terms( $taxonomy );

		foreach ( $tax_terms as $tax_term ) { ?>
				<button data-filter=".<?php echo $tax_term->slug; ?>"><?php echo $tax_term->slug; ?></button>
			<?php }
		?>
	</div>
<?php } ?>

<div class="portfolio-loop" id="portfolio-loop">
	<?php

	$args = array(
		'post_type'      => 'jetpack-portfolio',
		'paged'          => $paged,
		'posts_per_page' => get_option( 'jetpack_portfolio_posts_per_page' ),
	);

	if ( ! is_post_type_archive() ) {
		$portfolio_query = new WP_Query( $args );
	} else {
		$portfolio_query = $wp_query;
	}

	if ( post_type_exists( 'jetpack-portfolio' ) && $portfolio_query->have_posts() ) { ?>

		<div id="projects-container">

			<?php
		while ( $portfolio_query->have_posts() ) {
			$portfolio_query->the_post();

			get_template_part( 'template-parts/content', 'portfolio' );
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
	}
	?>

</div><!-- .portfolio-loop -->
