<?php
/**
 * YARPP Template: SiteOrigin Corp.
 *
 * @link https://wordpress.org/plugins/yet-another-related-posts-plugin/
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */
?>

<h2 class="related-posts"><?php esc_html_e( 'You May Also Like', 'siteorigin-corp' ); ?></h2>
<?php if ( have_posts() ) :?>
	<ol>
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php if ( has_post_thumbnail() ) :?>
						<?php the_post_thumbnail( 'related-post' ); ?>
					<?php endif; ?>
					<h3 class="related-post-title"><?php the_title(); ?></h3>
					<p class="related-post-date"><?php the_time( apply_filters( 'sitorigin_corp_date_format', 'F d, Y' ) ); ?></p>
				</a>
			</li>
		<?php endwhile; ?>
	</ol>
<?php else: ?>
	<p><?php esc_html_e( 'No related posts.', 'siteorigin-corp' ); ?></p>
<?php endif; ?>
