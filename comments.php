<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-corp
 * @license GPL 2.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'siteorigin-corp' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'siteorigin-corp' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( '<span class="icon-long-arrow-left"></span> ' . esc_html__( 'Older comments', 'siteorigin-corp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer comments', 'siteorigin-corp' ) . ' <span class="icon-long-arrow-right"></span>' ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'	=> 'ol',
					'callback' => 'siteorigin_corp_comment',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'siteorigin-corp' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( '<span class="icon-long-arrow-left"></span> ' . esc_html__( 'Older comments', 'siteorigin-corp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer comments', 'siteorigin-corp' ) . ' <span class="icon-long-arrow-right"></span>' ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'siteorigin-corp' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
