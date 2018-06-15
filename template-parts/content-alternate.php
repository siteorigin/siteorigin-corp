<?php
/**
 * Template part for displaying alternate posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

$content = siteorigin_corp_strip_gallery( get_the_content() );
$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
				<a href="<?php the_permalink(); ?>">
					<?php echo siteorigin_corp_get_image(); ?>
				</a>
			</div>
		<?php elseif ( get_post_format() == 'video' && siteorigin_corp_get_video() ) : ?>
			<div class="entry-thumbnail entry-video">
				<?php echo siteorigin_corp_get_video(); ?>
			</div>
		<?php elseif ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'siteorigin-corp-720x480-crop' ); ?>
				</a>
			</div>
		<?php endif; ?>

	<div class="corp-content-wrapper">

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php siteorigin_corp_post_meta(); ?>
				</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php 
				if ( get_post_format() == 'gallery' && siteorigin_corp_get_gallery() ) {
					echo $content;	
				} elseif ( get_post_format() == 'image' && siteorigin_corp_get_image() ) {
					echo apply_filters( 'the_content', siteorigin_corp_strip_image( siteorigin_corp_excerpt() ) );
				} elseif ( get_post_format() == 'video' && siteorigin_corp_get_video() ) {
					echo apply_filters( 'the_content', siteorigin_corp_filter_video( siteorigin_corp_excerpt() ) );
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
