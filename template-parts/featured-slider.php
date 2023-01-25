<?php
/**
 * Template part for displaying Jetpack Featured Content posts slider.
 *
 * @see https://jetpack.com/support/featured-content/
 *
 * @license GPL 2.0
 */

// Get our Jetpack Featured Content posts.
$slider = siteorigin_corp_get_featured_posts();

// Check if Featured Content posts exist.
if ( empty( $slider ) ) {
	return;
}

// Looping through our posts
?>

<div class="flexslider featured-posts-slider">

	<ul class="slides">

		<?php foreach ( $slider as $post ) {
			setup_postdata( $post ); ?>

			<?php if ( has_post_thumbnail() ) {
				$thumbnail = wp_get_attachment_url( get_post_thumbnail_id() );
			} ?>

			<li class="slide" <?php if ( ! empty( $thumbnail ) ) {
				echo 'style="background-image: url( \'' . esc_url( $thumbnail ) . '\' )"';
			} ?>>
				<div class="overlay"><a href="<?php the_permalink(); ?>"></a></div>
				<div class="slide-content">
					<div class="entry-meta">
						<?php siteorigin_corp_post_meta(); ?>
					</div><!-- .entry-meta -->
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				</div>
			</li>

		<?php } ?>

	</ul>

	<ul class="flex-direction-nav">
		<li class="flex-nav-prev">
			<a class="flex-prev" href="#"><?php siteorigin_corp_display_icon( 'left-arrow' ); ?></a>
		</li>
		<li class="flex-nav-next">
			<a class="flex-next" href="#"><?php siteorigin_corp_display_icon( 'right-arrow' ); ?></a>
		</li>
	</ul>

</div><!-- .featured-posts-slider -->

<?php wp_reset_postdata(); ?>
