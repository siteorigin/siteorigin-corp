<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

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
