<?php
/**
 * Template part for displaying project posts.
 *
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && siteorigin_setting( 'blog_post_featured_image' ) ) { ?>
		<?php siteorigin_corp_entry_thumbnail(); ?>
	<?php } ?>

	<div class="corp-content-wrapper">

		<header class="entry-header">
			<?php if ( siteorigin_page_setting( 'page_title' ) ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} ?>
			<div class="entry-meta">
				<?php siteorigin_corp_post_meta(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content();

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
