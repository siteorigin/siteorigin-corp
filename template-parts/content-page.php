<?php
/**
 * Template part for displaying page content in page.php
 *
 * @see https://codex.wordpress.org/Template_Hierarchy
 *
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && siteorigin_setting( 'pages_featured_image' ) ) { ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php } ?>

	<?php if (
		siteorigin_page_setting( 'overlap' ) == 'disabled' ||
		siteorigin_page_setting( 'overlap' ) != 'disabled' &&
		( has_post_thumbnail() &&
			siteorigin_setting( 'pages_featured_image' )
		)
	) {
		?>
		<?php if ( siteorigin_page_setting( 'page_title' ) ) { ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		<?php } ?>
	<?php } ?>

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

</article><!-- #post-## -->
