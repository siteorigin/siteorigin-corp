<?php
/**
 * Template part for displaying offset posts.
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

$num_comments = get_comments_number();
if ( comments_open() ) {
	if ( $num_comments == 0 ) {
		$comments = esc_html__( 'Post a Comment', 'siteorigin-corp' );
	} elseif ( $num_comments > 1 ) {
		$comments = $num_comments . esc_html__( ' Comments', 'siteorigin-corp' );
	} else {
		$comments = esc_html__( '1 Comment', 'siteorigin-corp' );
	}
} else {
	$comments = NULL;
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-entry' ); ?>>

	<div class="entry-offset">

		<div class="entry-author-avatar">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
			</a>
		</div>

		<div class="entry-author-link">
			<span class="meta-text"><?php esc_html_e( 'Written by', 'siteorigin-corp' ); ?></span>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_the_author(); ?>
			</a>
		</div>

		<?php if ( siteorigin_setting( 'blog_post_categories' ) ) : ?>
			<div class="entry-categories">
				<span class="meta-text"><?php esc_html_e( 'Posted in', 'siteorigin-corp' ); ?></span>
				<?php the_category( ', ', '', '' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $comments && siteorigin_setting( 'blog_post_comment_count' ) ) : ?>
			<div class="entry-comments">
				<span class="meta-text"><?php esc_html_e( 'Comments', 'siteorigin-corp' ); ?></span>
				<a href="<?php get_comments_link(); ?>"><?php echo $comments; ?></a>
			</div>
		<?php endif; ?>

	</div>

	<div class="entry-content">	

		<div class="entry-thumbnail">
			<?php if ( get_post_format() == 'gallery' && siteorigin_corp_get_gallery() ) : ?>
				<?php $gallery = siteorigin_corp_get_gallery(); ?>
				<div class="flexslider entry-thumbnail">
					<ul class="slides">
						<?php foreach ( $gallery['src'] as $image ) : ?>
							<li class="gallery-format-slide">
								<img src="<?php echo $image; ?>">
							</li>
						<?php endforeach; ?>
					</ul>
					<ul class="flex-direction-nav">
						<li class="flex-nav-prev">
							<a class="flex-prev" href="#"><?php siteorigin_corp_display_icon( 'left-arrow' ); ?></a>
						</li>
						<li class="flex-nav-next">
							<a class="flex-next" href="#"><?php siteorigin_corp_display_icon( 'right-arrow' ); ?></a>
						</li>
					</ul>
				</div>
			<?php elseif ( get_post_format() == 'image' && siteorigin_corp_get_image() ) : ?>
				<div class="entry-thumbnail">
					<a href="<?php the_permalink() ?>">
						<?php echo siteorigin_corp_get_image(); ?>
					</a>
				</div>
			<?php elseif ( get_post_format() == 'video' && siteorigin_corp_get_video() ) : ?>
				<div class="entry-video">
					<?php echo siteorigin_corp_get_video(); ?>
				</div>
			<?php elseif ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'aligncenter' ) ); ?>
				</a>
			<?php endif; ?>
		</div>

		<div class="corp-content-wrapper">

			<div class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<div class="entry-meta">
					<?php siteorigin_corp_post_meta_date(); ?>
				</div><!-- .entry-meta -->
			</div>		

			<?php
				if ( is_single() || ( siteorigin_setting( 'blog_archive_content' ) == 'full' ) ) {
					the_content();
				} else {
					siteorigin_corp_excerpt();
				}

				wp_link_pages( array(
					'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'siteorigin-corp' ) . '</span>',
					'after'  => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>

		</div><!-- .entry-content -->
	</div><!-- .corp-content-wrapper -->

</article>
