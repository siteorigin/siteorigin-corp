<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package siteorigin-corp
 * @license GPL 2.0
 */

if ( ! function_exists( 'siteorigin_corp_author_box' ) ) :
/**
 * Display the post author biographical info on single posts.
 */
function siteorigin_corp_author_box() { ?>
	<div class="author-box">
		<div class="author-avatar">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
			</a>
		</div><!-- .author-avatar -->
		<div class="author-description">
			<h3><?php echo get_the_author(); ?></h3>
			<span class="author-posts">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php esc_html_e( 'View posts by ', 'siteorigin-corp' );
					echo get_the_author(); ?>
				</a>
			</span>	
			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<div><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></div>
			<?php endif; ?>
		</div><!-- .author-description -->
	</div><!-- .author-box -->
<?php }
endif;

if ( ! function_exists( 'siteorigin_corp_breadcrumbs' ) ) :
/**
 * Display's breadcrumbs supported by Yoast SEO & Breadcrumb NavXT.
 */
function siteorigin_corp_breadcrumbs() {
	if ( function_exists( 'bcn_display' ) ) {
		?><div class="breadcrumbs bcn">
			<?php bcn_display(); ?>
		</div><?php
	} elseif( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
	}
}
endif;

if ( ! function_exists( 'siteorigin_corp_comment' ) ) :
/**
 * Comment list callback function.
 */
function siteorigin_corp_comment( $comment, $args, $depth ) {
	?>
	<li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<?php $type = get_comment_type( $comment->comment_ID ); ?>
		<div class="comment-box">
			<?php if ( $type == 'comment' ) : ?>
				<div class="avatar-container">
					<?php echo get_avatar( get_comment_author_email(), 60 ) ?>
				</div>
			<?php endif; ?>

			<div class="comment-container">
				<div class="info">
					<span class="author"><?php comment_author_link(); ?></span><span class="date"><?php comment_date(); ?></span>
				</div>

				<div class="comment-content content">
					<?php comment_text() ?>
				</div>

				<?php if($depth <= $args['max_depth']) : ?>
					<?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ?>
				<?php endif; ?>
			</div>
		</div>
	<?php
}
endif;

if ( ! function_exists( 'siteorigin_corp_display_logo' ) ) :
/**
 * Display the logo or site title.
 */
function siteorigin_corp_display_logo() {
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo();
	} else {
		if ( is_front_page() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif;
	}
}
endif;

/**
 * Add the retina srcset to the custom logo attributes.
 */
function siteorigin_corp_display_retina_logo( $attr, $attachment ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$retina = siteorigin_setting( 'header_retina_logo' );
	if( ! empty( $retina ) && ! empty( $custom_logo_id ) && $attachment->ID == $custom_logo_id ) {
		$srcset = empty( $attr['srcset'] ) ? array() : explode( ',', $attr['srcset'] );
		$retina_src = wp_get_attachment_image_src( $retina, 'full' );
		if ( ! empty( $retina_src ) ) {
			$srcset[] = $retina_src[0] . ' 2x';
		}
		if ( ! empty( $srcset ) ) {
			$attr['srcset'] = implode( ',', $srcset );
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'siteorigin_corp_display_retina_logo', 10, 2 );

if ( ! function_exists( 'siteorigin_corp_display_icon' ) ) :
/**
 * Displays SVG icons.
 */
function siteorigin_corp_display_icon( $type ) {

	switch( $type ) {

		case 'close' : ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
				<path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
			</svg>
		<?php break;

		case 'menu': ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="27" height="32" viewBox="0 0 27 32">
				<path d="M27.429 24v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804zM27.429 14.857v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804zM27.429 5.714v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804z"></path>
			</svg>
		<?php break;

		case 'search': ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="26" height="28" viewBox="0 0 26 28">
				<path d="M18 13c0-3.859-3.141-7-7-7s-7 3.141-7 7 3.141 7 7 7 7-3.141 7-7zM26 26c0 1.094-0.906 2-2 2-0.531 0-1.047-0.219-1.406-0.594l-5.359-5.344c-1.828 1.266-4.016 1.937-6.234 1.937-6.078 0-11-4.922-11-11s4.922-11 11-11 11 4.922 11 11c0 2.219-0.672 4.406-1.937 6.234l5.359 5.359c0.359 0.359 0.578 0.875 0.578 1.406z"></path>
			</svg>
		<?php break;		

		case 'up-arrow': ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
				<path class="st0" d="M12,2c0.3,0,0.5,0.1,0.7,0.3l7,7C19.9,9.5,20,9.7,20,10c0,0.3-0.1,0.5-0.3,0.7S19.3,11,19,11
	                c-0.3,0-0.5-0.1-0.7-0.3L13,5.4V21c0,0.3-0.1,0.5-0.3,0.7S12.3,22,12,22s-0.5-0.1-0.7-0.3S11,21.3,11,21V5.4l-5.3,5.3
	                C5.5,10.9,5.3,11,5,11c-0.3,0-0.5-0.1-0.7-0.3C4.1,10.5,4,10.3,4,10c0-0.3,0.1-0.5,0.3-0.7l7-7C11.5,2.1,11.7,2,12,2z"/>
			</svg>
		<?php break;		
	}
}
endif;

if ( ! function_exists( 'siteorigin_corp_the_post_navigation' ) ) :
/**
 * Display navigation to next/previous posts.
 */
function siteorigin_corp_the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'siteorigin-corp' ); ?></h2>
		<div class="nav-links">
			<div class="nav-previous">
				<?php previous_post_link ( '%link', '<span class="sub-title"> ' . esc_html__( 'Previous Post', 'siteorigin-corp' ) . '</span> <div>%title</div>' ); ?>
			</div>
			<div class="nav-next">
				<?php next_post_link( '%link', '<span class="sub-title">' . esc_html__( 'Next Post', 'siteorigin-corp' ) . ' </span> <div>%title</div>' ); ?>
			</div>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


if ( ! function_exists( 'siteorigin-corp_read_more_link' ) ) :
/**
 * Filter the read more link.
 */
function siteorigin_corp_read_more_link() {
	$read_more_text = esc_html__( 'Continue reading', 'siteorigin-corp' );
	return '<a class="more-link" href="' . get_permalink() . '"><span class="more-text">' . $read_more_text . '</a></span>';
}
endif;
add_filter( 'the_content_more_link', 'siteorigin-corp_read_more_link' );

if ( ! function_exists( 'siteorigin_corp_related_posts' ) ) :
/**
 * Display related posts on single posts.
 */
function siteorigin_corp_related_posts( $post_id ) {
	if ( function_exists( 'related_posts' ) ) { // Check for YARPP plugin (https://wordpress.org/plugins/yet-another-related-posts-plugin/).
		related_posts();
	} else { // The fallback loop.
		$categories = get_the_category( $post_id );
		$first_cat = $categories[0]->cat_ID;
		$args=array(
			'category__in' => array( $first_cat ),
			'post__not_in' => array( $post_id ),
			'posts_per_page' => 3,
			'ignore_sticky_posts' => -1
		);
		$related_posts = new WP_Query( $args ); ?>

		<div class="related-posts-section">
			<h3 class="related-posts"><?php esc_html_e( 'Related Posts', 'siteorigin-corp' ); ?></h3>
			<?php if ( $related_posts ) : ?>
				<ol>
					<?php if ( $related_posts->have_posts() ) : ?>
						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<?php 
									if ( has_post_thumbnail() && is_active_sidebar( 'sidebar-main' ) )
										the_post_thumbnail( 'siteorigin-corp-247x164-crop' );
									elseif ( has_post_thumbnail() )
										the_post_thumbnail( 'siteorigin-corp-354x234-crop' );
									?>
									<div>
										<h3 class="related-post-title"><?php the_title(); ?></h3>
										<p class="related-post-date"><?php the_time( apply_filters( 'siteorigin_corp_date_format', 'F d, Y' ) ); ?></p>
									</div>
								</a>
							</li>
						<?php endwhile; ?>
					<?php endif; ?>
				</ol>
			<?php else : ?>
				<p><?php esc_html_e( 'No related posts.', 'siteorigin-corp' ); ?></p>
			<?php endif; ?>
		</div>
		<?php wp_reset_query();
	}
}
endif;

if ( ! function_exists( 'siteorigin_corp_tag_cloud' ) ) :
/**
 * Filter the Tag Cloud widget.
 */
function siteorigin_corp_tag_cloud( $args ) {

	$args['unit'] = 'px';
	$args['largest'] = 12;
	$args['smallest'] = 12;
	return $args;
}
endif;
add_filter( 'widget_tag_cloud_args', 'siteorigin_corp_tag_cloud' );

if ( ! function_exists( 'siteorigin_corp_post_meta' ) ) :
/**
 * Print HTML with meta information for the sticky status, current post-date/time, author, comment count and post categories.
 */
function siteorigin_corp_post_meta() {
	if ( ( is_home() || is_archive() || is_search() ) ) {
		echo '<span class="entry-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date( apply_filters( 'siteorigin_corp_date_format', 'F d, Y' ) ) ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></span></a>';
	}

	if ( is_single() ) {
		echo '<span class="entry-date"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date( apply_filters( 'siteorigin_corpdate_format', 'F d, Y' ) ) ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></span>';
	}

	if ( has_category() ) {
		echo '<span>' . get_the_category_list( ', ' ) . '</span>';
	}
	
	if ( comments_open() ) { 
		echo '<span class="comments-link">';
  		comments_popup_link( esc_html__( 'Leave a comment', 'siteorigin-corp' ), esc_html__( 'One Comment', 'siteorigin-corp' ), esc_html__( '% Comments', 'siteorigin-corp' ) );
  		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'siteorigin_corpentry_footer' ) ) :
/**
 * Print HTML with meta information for the post tags.
 */
function siteorigin_corp_entry_footer() {

	if ( is_single() && has_tag() ) {
		echo '<footer class="entry-footer"><span class="tags-links">' . get_the_tag_list() . '</span></footer>';
	}	
}
endif;

if ( ! function_exists( 'siteorigin_corp_footer_text' ) ) :
/**
 * Insert footer text from theme settings.
 */
function siteorigin_corp_footer_text() {
	$text = siteorigin_setting( 'footer_text' );
	$text = str_replace(
		array( '{sitename}', '{year}' ),
		array( get_bloginfo( 'sitename' ), date( 'Y' ) ),
		$text
	);
	echo wp_kses_post( $text );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function siteorigin_corp_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'siteorigin_corp_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'siteorigin_corp_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so siteorigin_corp_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so siteorigin_corp_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in siteorigin_corp_categorized_blog.
 */
function siteorigin_corp_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'siteorigin_corp_categories' );
}
add_action( 'edit_category', 'siteorigin_corp_category_transient_flusher' );
add_action( 'save_post',     'siteorigin_corp_category_transient_flusher' );

if ( ! function_exists( 'siteorigin_corp_comment' ) ) :
/**
 * The callback function for wp_list_comments in comments.php.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments.
 */		
function siteorigin_corp_comment( $comment, $args, $depth ) {
	?>
	<li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<?php $type = get_comment_type( $comment->comment_ID ); ?>
		<div class="comment-box">
			<?php if ( $type == 'comment' ) : ?>
				<div class="avatar-container">
					<?php echo get_avatar( get_comment_author_email(), 60 ) ?>
				</div>
			<?php endif; ?>

			<div class="comment-container">
				<div class="info">
					<span class="author"><?php comment_author_link(); ?></span><br>
					<span class="date"><?php comment_date( apply_filters( 'siteorigin_corp_date_format', 'F d, Y' ) ); ?></span>
				</div>

				<div class="comment-content content">
					<?php comment_text(); ?>
				</div>

				<?php if ( $depth <= $args['max_depth'] ) : ?>
					<?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ?>
				<?php endif; ?>
			</div>
		</div>
	<?php
}
endif;
