<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

$is_page_builder_post_loop_widget = class_exists( 'SiteOrigin_Panels_Widgets_PostLoop' ) &&
method_exists( 'SiteOrigin_Panels_Widgets_PostLoop', 'is_rendering_loop' ) &&
SiteOrigin_Panels_Widgets_PostLoop::is_rendering_loop();

$is_post_loop_template_offset = class_exists( 'SiteOrigin_Panels' ) && SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-blog-offset.php';
$is_post_loop_template_grid = class_exists( 'SiteOrigin_Panels' ) && SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-blog-grid.php';
$is_post_loop_template_alternate = class_exists( 'SiteOrigin_Panels' ) && SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-blog-alternate.php';
$is_post_loop_template_masonry = class_exists( 'SiteOrigin_Panels' ) && SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-blog-masonry.php';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! $is_page_builder_post_loop_widget && siteorigin_setting( 'blog_archive_layout' ) == 'offset' || $is_post_loop_template_offset ) : ?>
		<div class="entry-offset">
			<?php siteorigin_corp_offset_post_meta(); ?>
		</div>
	<?php endif; ?>		

	<?php if ( is_single() && has_post_thumbnail() && siteorigin_setting( 'blog_post_featured_image' ) ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>	
	<?php elseif ( ! $is_page_builder_post_loop_widget && has_post_thumbnail() && siteorigin_setting( 'blog_archive_featured_image' ) && siteorigin_setting( 'blog_archive_layout' ) == 'grid' || has_post_thumbnail() && $is_post_loop_template_grid ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'siteorigin-corp-720x480-crop' ); ?>	
			</a>
		</div>
	<?php elseif ( ! $is_page_builder_post_loop_widget && has_post_thumbnail() && siteorigin_setting( 'blog_archive_featured_image' ) && siteorigin_setting( 'blog_archive_layout' ) == 'alternate' || has_post_thumbnail() && $is_post_loop_template_alternate ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'siteorigin-corp-720x480-crop' ); ?>	
			</a>
		</div>		
	<?php elseif ( ! $is_page_builder_post_loop_widget && has_post_thumbnail() && siteorigin_setting( 'blog_archive_featured_image' ) && siteorigin_setting( 'blog_archive_layout' ) == 'masonry' || has_post_thumbnail() && $is_post_loop_template_masonry ) : ?>
		<div class="entry-thumbnail">
			<?php if ( siteorigin_setting( 'blog_post_categories' ) ) siteorigin_corp_entry_thumbnail_meta(); ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>	
			</a>
		</div>
	<?php elseif ( has_post_thumbnail() && siteorigin_setting( 'blog_archive_featured_image' ) ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>	

	<div class="corp-content-wrapper">

		<header class="entry-header">
			<?php 
			if ( is_single() ) {
				if ( siteorigin_page_setting( 'page_title' ) ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				}
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			} ?>

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php 
					if ( ! $is_page_builder_post_loop_widget && siteorigin_setting( 'blog_archive_layout' ) == 'offset' || $is_post_loop_template_offset ) :
						siteorigin_corp_posted_on();
					else :
						siteorigin_corp_post_meta();
					endif; 
					?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

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
