<?php
/**
 * Template part for displaying posts.
 *
 * @see https://codex.wordpress.org/Template_Hierarchy
 *
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! is_single() && ! siteorigin_corp_is_post_loop_widget() && siteorigin_setting( 'blog_archive_layout' ) == 'offset' || siteorigin_corp_is_post_loop_template( 'offset' ) ) { ?>
		<div class="entry-offset">
			<?php siteorigin_corp_offset_post_meta(); ?>
		</div>
	<?php } ?>

	<?php if ( has_post_thumbnail() ) { ?>
		<?php siteorigin_corp_entry_thumbnail(); ?>
	<?php } ?>	

	<div class="corp-content-wrapper">
		<?php
		$title = siteorigin_corp_get_post_title();

		if (
			! is_single() &&
			! siteorigin_corp_is_post_loop_widget() &&
			siteorigin_setting( 'blog_archive_layout' ) == 'offset'
			|| siteorigin_corp_is_post_loop_template( 'offset' )
		) {
			$meta = siteorigin_corp_posted_on( false );
		} else {
			$meta = siteorigin_corp_post_meta( true, '', false );
		}
		?>

		<?php if ( ! empty( $title ) || ! empty( $entry_meta ) ) { ?>
			<header class="entry-header">
				<?php
				if ( ! empty( $title ) ) {
					echo $title;
				}
				?>
				<?php if ( 'post' === get_post_type() ) { ?>
					<div class="entry-meta">
							<?php echo $meta; ?>
					</div><!-- .entry-meta -->
				<?php } ?>
			</header><!-- .entry-header -->
		<?php } ?>

		<div class="entry-content">
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

	<?php siteorigin_corp_entry_footer(); ?>
</article><!-- #post-## -->
