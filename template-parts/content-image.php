<?php
/**
 * Template part for displaying image format posts.
 *
 * @see https://codex.wordpress.org/Template_Hierarchy
 *
 * @license GPL 2.0
 */
$post_class = ( is_singular() ) ? 'entry' : 'archive-entry';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( siteorigin_corp_get_image() ) { ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php echo siteorigin_corp_get_image(); ?>
			</a>
		</div>
	<?php } elseif ( has_post_thumbnail() ) { ?>
		<?php siteorigin_corp_entry_thumbnail(); ?>
	<?php } ?>

	<div class="corp-content-wrapper">
		<header class="entry-header">
			<?php
			if ( is_single() ) {
				if ( siteorigin_page_setting( 'page_title' ) ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				}
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

			if ( 'post' === get_post_type() ) { ?>
			<div class="entry-meta">
				<?php siteorigin_corp_post_meta(); ?>
			</div><!-- .entry-meta -->
			<?php
			} ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				if ( is_single() || ( siteorigin_setting( 'blog_archive_content' ) == 'full' ) ) {
					echo apply_filters( 'the_content', siteorigin_corp_strip_image( get_the_content() ) );
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

	<?php siteorigin_corp_entry_footer(); ?>
</article><!-- #post-## -->
