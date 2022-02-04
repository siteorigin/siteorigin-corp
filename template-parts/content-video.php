<?php
/**
 * Template part for displaying video format posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-corp
 * @license GPL 2.0
 */

$post_class = ( is_singular() ) ? 'entry' : 'archive-entry';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( siteorigin_corp_get_video() ) : ?>
		<div class="entry-thumbnail entry-video">
			<?php echo siteorigin_corp_get_video(); ?>
		</div>
	<?php elseif ( has_post_thumbnail() ) : ?>
		<?php siteorigin_corp_entry_thumbnail(); ?>
	<?php endif; ?>

	<div class="corp-content-wrapper">
		<?php
		$title = siteorigin_corp_get_post_title();

		if ( 'post' === get_post_type() ) {
			$meta = siteorigin_corp_post_meta( true, '', false );
		}

		if ( ! empty( $title ) || ! empty( $meta ) ) : ?>
			<header class="entry-header">
				<?php
				if ( ! empty( $title ) ) {
					echo $title;
				}
				?>
				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
							<?php echo $meta; ?>
					</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->
		<?php endif; ?>


		<div class="entry-content">
			<?php
				if ( is_single() || ( siteorigin_setting( 'blog_archive_content' ) == 'full' ) ) {
					echo apply_filters( 'the_content', siteorigin_corp_filter_video( get_the_content() ) );
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
