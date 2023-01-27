<?php
/**
 * YARPP Template: SiteOrigin Corp.
 *
 * @see https://wordpress.org/plugins/yet-another-related-posts-plugin/
 *
 * @license GPL 2.0
 */
?>

<h2 class="related-posts"><?php esc_html_e( 'You May Also Like', 'siteorigin-corp' ); ?></h2>
<?php if ( have_posts() ) { ?>
	<ol>
		<?php while ( have_posts() ) {
			the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail( 'related-post' ); ?>
					<?php } ?>
					<h3 class="related-post-title"><?php the_title(); ?></h3>
					<p class="related-post-date"><?php echo get_the_date(); ?></p>
				</a>
			</li>
		<?php } ?>
	</ol>
<?php } else { ?>
	<p><?php esc_html_e( 'No related posts.', 'siteorigin-corp' ); ?></p>
<?php } ?>
