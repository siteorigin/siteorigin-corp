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
			$comment_count = get_comments_number();
			if ( 1 === $comment_count ) {
				printf(
					/* Translators: 1: title. */
					esc_html_e( '1 Comment', 'siteorigin-corp' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* Translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s Comment', '%1$s Comments', $comment_count, 'comments title', 'siteorigin-corp' ) ),
					number_format_i18n( $comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!--. comments-title -->

		<?php 
			$args = array(
				'prev_text' => '<span class="icon-long-arrow-left"></span> ' . esc_html__( 'Older comments', 'siteorigin-corp' ),
				'next_text' => esc_html__( 'Newer comments', 'siteorigin-corp' ) . ' <span class="icon-long-arrow-right"></span>',
			);
			the_comments_navigation( $args ); 
		?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'	=> 'ol',
					'callback' => 'siteorigin_corp_comment',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php 
			$args = array(
				'prev_text' => '<span class="icon-long-arrow-left"></span> ' . esc_html__( 'Older comments', 'siteorigin-corp' ),
				'next_text' => esc_html__( 'Newer comments', 'siteorigin-corp' ) . ' <span class="icon-long-arrow-right"></span>',
			);
			the_comments_navigation( $args ); 

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'siteorigin-corp' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
