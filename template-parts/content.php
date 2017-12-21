<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php 
	if ( is_single() && has_post_thumbnail() && siteorigin_setting( 'blog_post_featured_image' ) ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php elseif ( ! is_single() && has_post_thumbnail() && siteorigin_setting( 'blog_archive_featured_image' ) ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'siteorigin-corp-551x364-crop' ); ?>		
			</a>
		</div>
	<?php endif; ?>	

	<div class="corp-content-wrapper">
		<header class="entry-header">
			<?php
			if ( is_single() ) :
				if ( siteorigin_page_setting( 'page_title' ) ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				endif;
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php siteorigin_corp_post_meta(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				if ( is_single() || ( siteorigin_setting( 'blog_archive_content' ) == 'full' ) ) {
					the_content();
				} else {
					the_excerpt();
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

	<?php siteorigin_corp_entry_footer(); ?>
</article><!-- #post-## -->
