<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @license GPL 2.0
 */
if ( ! function_exists( 'siteorigin_corp_author_box' ) ) {
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
			<?php if ( get_the_author_meta( 'description' ) ) { ?>
				<div><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></div>
			<?php } ?>
		</div><!-- .author-description -->
	</div><!-- .author-box -->
<?php }
	}

if ( ! function_exists( 'siteorigin_corp_breadcrumbs' ) ) {
	/**
	 * Display's breadcrumbs supported by Breadcrumb NavXT, Rank Math, and Yoast SEO.
	 */
	function siteorigin_corp_breadcrumbs() {
		if ( siteorigin_page_setting( 'overlap' ) != 'disabled' ) {
			return;
		}

		siteorigin_settings_breadcrumbs();
	}
}
add_action( 'siteorigin_corp_content_top', 'siteorigin_corp_breadcrumbs' );

if ( ! function_exists( 'siteorigin_corp_comment' ) ) {
	/**
	 * The callback function for wp_list_comments in comments.php.
	 *
	 * @see https://codex.wordpress.org/Function_Reference/wp_list_comments.
	 */
	function siteorigin_corp_comment( $comment, $args, $depth ) {
		?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<?php $type = get_comment_type( $comment->comment_ID ); ?>
		<div class="comment-box">
			<?php if ( $type == 'comment' ) { ?>
				<div class="avatar-container">
					<?php echo get_avatar( get_comment_author_email(), 60 ); ?>
				</div>
			<?php } ?>

			<div class="comment-container">
				<div class="info">
					<span class="author"><?php comment_author_link(); ?></span><span class="date"><?php comment_date(); ?></span>
				</div>

				<div class="comment-content content">
					<?php if ( ! $comment->comment_approved ) { ?>
						<p class="comment-awaiting-moderation">
							<?php esc_html_e( 'Your comment is awaiting moderation.', 'siteorigin-corp' ); ?>
						</p>
					<?php } ?>
					<?php comment_text(); ?>
				</div>

				<?php if ( $depth <= $args['max_depth'] ) { ?>
					<?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ); ?>
				<?php } ?>
			</div>
		</div>
	<?php
	}
}

if ( ! function_exists( 'siteorigin_corp_display_logo' ) ) {
	/**
	 * Display the logo or site title.
	 */
	function siteorigin_corp_display_logo() {
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		} else {
			if ( is_front_page() ) { ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php } else { ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php }
		}
	}
}

/**
 * Add the retina srcset to the custom logo attributes.
 */
function siteorigin_corp_display_retina_logo( $attr, $attachment ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$retina = siteorigin_setting( 'header_retina_logo' );

	if ( ! empty( $retina ) && ! empty( $custom_logo_id ) && $attachment->ID == $custom_logo_id ) {
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

if ( ! function_exists( 'siteorigin_corp_display_icon' ) ) {
	/**
	 * Displays SVG icons.
	 */
	function siteorigin_corp_display_icon( $type ) {
		switch ( $type ) {
			case 'cart': ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="16.97" height="16" viewBox="0 0 16.97 16">
				<path id="cart" class="cls-1" d="M1313.9,36.289l-2.01,6a0.994,0.994,0,0,1-.95.711h-7.35a0.962,0.962,0,0,1-.35-0.072c-0.04-.015-0.07-0.037-0.11-0.056a0.969,0.969,0,0,1-.19-0.131,0.644,0.644,0,0,1-.1-0.1c-0.04-.056-0.08-0.117-0.12-0.184-0.02-.043-0.04-0.084-0.06-0.13-0.01-.024-0.02-0.043-0.03-0.068l-2.09-7.07A1.779,1.779,0,0,0,1298.98,34h-0.99a1,1,0,0,1,0-2h0.99a3.773,3.773,0,0,1,3.49,2.669l0.1,0.332h10.38a1,1,0,0,1,.8.4A0.969,0.969,0,0,1,1313.9,36.289Zm-10.74.71,1.18,4h5.85l1.41-4h-8.44Zm0.81,7a2,2,0,1,1-2,2A2,2,0,0,1,1303.97,44Zm6.99,0a2,2,0,1,1-2,2A2,2,0,0,1,1310.96,44Z" transform="translate(-1297 -32)"/>
			</svg>
		<?php break;

			case 'close': ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
				<path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
			</svg>
		<?php break;

			case 'left-arrow': ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18" height="32" viewBox="0 0 18 32">
				<path fill="#fff" d="M18.284 29.705l-2.284 2.285-15.99-15.99 15.99-15.99 2.284 2.285-13.705 13.705z"></path>
			</svg>
		<?php break;

			case 'menu': ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="27" height="32" viewBox="0 0 27 32">
				<path d="M27.429 24v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804zM27.429 14.857v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804zM27.429 5.714v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804z"></path>
			</svg>
		<?php break;

			case 'right-arrow': ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18" height="32" viewBox="0 0 18 32">
				<path fill="#fff" d="M17.589 16l-15.402 15.989-2.2-2.283 13.202-13.706-13.202-13.706 2.2-2.283 13.202 13.704z"></path>
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
}

if ( ! function_exists( 'siteorigin_corp_the_post_navigation' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function siteorigin_corp_the_post_navigation() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		$previous_post = get_previous_post();

		if ( ! empty( $previous_post ) ) {
			$previous_thumb = get_the_post_thumbnail( $previous_post->ID, 'thumbnail' );
		}
		$next_post = get_next_post();

		if ( ! empty( $next_post ) ) {
			$next_thumb = get_the_post_thumbnail( $next_post->ID, 'thumbnail' );
		}

		?>
	<nav class="navigation post-navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'siteorigin-corp' ); ?></h2>
		<div class="nav-links">
			<?php if ( ! empty( $previous_post ) ) { ?>
				<div class="nav-previous">
					<?php previous_post_link( '%link', ' ' . $previous_thumb . '<div class="nav-innner"><span>' . esc_html__( 'Previous Post', 'siteorigin-corp' ) . '</span> <div>%title</div></div>' ); ?>
				</div>
			<?php } ?>
			<?php if ( ! empty( $next_post ) ) { ?>
				<div class="nav-next">
					<?php next_post_link( '%link', '<div class="nav-innner"><span>' . esc_html__( 'Next Post', 'siteorigin-corp' ) . '</span> <div>%title</div></div>' . $next_thumb . ' ' ); ?>
				</div>
			<?php } ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
	}
}

if ( ! function_exists( 'siteorigin_corp_read_more_link' ) ) {
	/**
	 * Filter the read more link.
	 */
	function siteorigin_corp_read_more_link() {
		$read_more_text = esc_html__( 'Continue reading', 'siteorigin-corp' );

		return '<a class="more-link" href="' . esc_url( get_permalink() ) . '"><span class="more-text">' . $read_more_text . ' <span class="icon-long-arrow-right"></span></span></a>';
	}
}
add_filter( 'the_content_more_link', 'siteorigin_corp_read_more_link' );

if ( ! function_exists( 'siteorigin_corp_excerpt_length' ) ) {
	/**
	 * Filter the excerpt length.
	 */
	function siteorigin_corp_excerpt_length( $length ) {
		return ! empty( siteorigin_setting( 'blog_excerpt_length' ) ) ? siteorigin_setting( 'blog_excerpt_length' ) : 55;
	}
	add_filter( 'excerpt_length', 'siteorigin_corp_excerpt_length', 10 );
}

if ( ! function_exists( 'siteorigin_corp_excerpt' ) ) {
	/**
	 * Outputs the excerpt.
	 */
	function siteorigin_corp_excerpt() {
		if ( ( siteorigin_setting( 'blog_archive_content' ) == 'excerpt' ) && siteorigin_setting( 'blog_post_excerpt_read_more_link', true ) && ! is_search() ) {
			$read_more_text = esc_html__( 'Continue reading', 'siteorigin-corp' );
			$read_more_text = '<a class="more-link excerpt" href="' . esc_url( get_permalink() ) . '"><span class="more-text">' . $read_more_text . ' <span class="icon-long-arrow-right"></span></span></a>';
		} else {
			$read_more_text = '';
		}

		if ( is_search() ) {
			$length = 30;
		} else {
			$length = ! empty( siteorigin_setting( 'blog_excerpt_length' ) ) ? siteorigin_setting( 'blog_excerpt_length' ) : 55;
		}

		$excerpt = get_the_excerpt();
		$excerpt_add_read_more = str_word_count( $excerpt ) >= $length;

		if ( ! has_excerpt() ) {
			$excerpt = wp_trim_words( $excerpt, $length, '...' );
		}

		if ( ! empty( $read_more_text ) && ( has_excerpt() || $excerpt_add_read_more ) ) {
			$excerpt .= $read_more_text;
		}

		echo '<p>' . wp_kses_post( $excerpt ) . '</p>';
	}
}

if ( ! function_exists( 'siteorigin_corp_entry_thumbnail_meta' ) ) {
	/**
	 * Print HTML with meta information for the sticky status, current post-date/time, author, comment count and post categories.
	 */
	function siteorigin_corp_entry_thumbnail_meta() {
		echo '<div class="thumbnail-meta">';

		if ( has_category() ) {
			echo get_the_category_list();
		}
		echo '</div>';
	}
}

if ( ! function_exists( 'siteorigin_corp_offset_post_meta' ) ) {
	/**
	 * Print HTML with meta information for the post author, categories and comment count for the offset blog layout.
	 */
	function siteorigin_corp_offset_post_meta() {
		$num_comments = get_comments_number();

		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = esc_html__( 'Post a Comment', 'siteorigin-corp' );
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . esc_html__( ' Comments', 'siteorigin-corp' );
			} else {
				$comments = esc_html__( '1 Comment', 'siteorigin-corp' );
			}
		} else {
			$comments = null;
		} ?>
	<div class="entry-author-avatar">
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
		</a>
	</div>
	<div class="entry-author-link">
		<span class="meta-text"><?php esc_html_e( 'Written by', 'siteorigin-corp' ); ?></span>
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
			<?php echo get_the_author(); ?>
		</a>
	</div>
	<?php if ( siteorigin_setting( 'blog_post_categories' ) ) { ?>
		<div class="entry-categories">
			<span class="meta-text"><?php esc_html_e( 'Posted in', 'siteorigin-corp' ); ?></span>
			<?php the_category( ', ', '', '' ); ?>
		</div>
	<?php } ?>
	<?php if ( $comments && siteorigin_setting( 'blog_post_comment_count' ) ) { ?>
		<div class="entry-comments">
			<span class="meta-text"><?php esc_html_e( 'Comments', 'siteorigin-corp' ); ?></span>
			<a href="<?php get_comments_link(); ?>"><?php echo $comments; ?></a>
		</div>
	<?php }
	}
}

if ( ! function_exists( 'siteorigin_corp_related_posts' ) ) {
	/**
	 * Display related posts on single posts.
	 */
	function siteorigin_corp_related_posts( $post_id ) {
		if ( function_exists( 'related_posts' ) ) { // Check for YARPP plugin (https://wordpress.org/plugins/yet-another-related-posts-plugin/).
			related_posts();
		} elseif ( class_exists( 'Jetpack' ) && class_exists( 'Jetpack_RelatedPosts' ) ) {
			echo do_shortcode( '[jetpack-related-posts]' );
		} else { // The fallback loop.
			$categories = get_the_category( $post_id );

			if ( empty( $categories ) ) {
				return;
			}
			$first_cat = $categories[0]->cat_ID;
			$args = array(
				'category__in' => array( $first_cat ),
				'post__not_in' => array( $post_id ),
				'posts_per_page' => 3,
				'ignore_sticky_posts' => -1,
			);
			$related_posts = new WP_Query( $args ); ?>

		<div class="related-posts-section">
			<h3 class="related-posts"><?php esc_html_e( 'Related Posts', 'siteorigin-corp' ); ?></h3>
			<?php if ( $related_posts->have_posts() ) { ?>
				<ol>
					<?php while ( $related_posts->have_posts() ) {
						$related_posts->the_post(); ?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail( 'siteorigin-corp-720x480-crop' ); ?>
								<div class="corp-content-wrapper">
									<h3 class="related-post-title"><?php the_title(); ?></h3>
									<p class="related-post-date"><?php echo get_the_date(); ?></p>
								</div>
							</a>
						</li>
					<?php } ?>
				</ol>
			<?php } else { ?>
				<br /><p><?php esc_html_e( 'No related posts.', 'siteorigin-corp' ); ?></p>
			<?php } ?>
		</div>
		<?php wp_reset_query();
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_related_projects' ) ) {
	/**
	 * Displays related posts in single projects.
	 */
	function siteorigin_corp_related_projects( $post_id ) {
		if ( class_exists( 'Jetpack' ) && class_exists( 'Jetpack_RelatedPosts' ) ) {
			echo do_shortcode( '[jetpack-related-posts]' );
		} else { // The fallback loop.
			$categories = get_the_terms( $post_id, 'jetpack-portfolio-type' );
			$first_cat = $categories[0]->term_id;
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'jetpack-portfolio-type',
						'field' => 'term_id',
						'terms' => $first_cat,
					),
				),
				'post__not_in' => array( $post_id ),
				'posts_per_page' => 3,
				'ignore_sticky_posts' => -1,
			);
			$related_posts = new WP_Query( $args ); ?>

		<div class="related-projects-section">
			<h3><?php esc_html_e( 'Related Posts', 'siteorigin-corp' ); ?></h2>
			<?php if ( $related_posts->have_posts() ) { ?>
				<div class="related-projects">
					<?php if ( $related_posts->have_posts() ) { ?>
						<?php while ( $related_posts->have_posts() ) {
							$related_posts->the_post(); ?>
							<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>
						<?php } ?>
					<?php } ?>
				</div>
			<?php } else { ?>
				<p><?php esc_html_e( 'No related projects.', 'siteorigin-corp' ); ?></p>
			<?php } ?>
		</div>
		<?php wp_reset_query();
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_tag_cloud' ) ) {
	/**
	 * Filter the Tag Cloud widget.
	 */
	function siteorigin_corp_tag_cloud( $args ) {
		$args['unit'] = 'px';
		$args['largest'] = 12;
		$args['smallest'] = 12;

		return $args;
	}
}
add_filter( 'widget_tag_cloud_args', 'siteorigin_corp_tag_cloud' );

if ( ! function_exists( 'siteorigin_corp_post_meta' ) ) {
	/**
	 * Print HTML with meta information for the sticky status, current post-date/time, author, post categories and comment count.
	 */
	function siteorigin_corp_post_meta( $cats = true, $post_id = '', $echo = true ) {
		$output = '';
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'siteorigin-corp' ) );

		if ( is_sticky() && ! is_paged() ) {
			$output .= '<span class="featured-post">' . esc_html__( 'Sticky', 'siteorigin-corp' ) . '</span>';
		}

		if ( ( is_home() || is_archive() || is_search() ) && siteorigin_setting( 'blog_post_date' ) ) {
			$output .= '<span class="entry-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></a></span>';
		}

		if ( is_single() && siteorigin_setting( 'blog_post_date' ) ) {
			$output .= '<span class="entry-date"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></span>';
		}

		if ( siteorigin_setting( 'blog_post_author' ) ) {
			$output .= '<span class="byline"><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a></span></span>';
		}

		if ( siteorigin_setting( 'blog_post_categories' ) ) {
			if ( 'jetpack-portfolio' == get_post_type() ) {
				$portfolio_terms = get_the_term_list( $post_id, 'jetpack-portfolio-type', '', ', ', '' );

				if ( $portfolio_terms ) {
					$output .= sprintf( '<span class="entry-category">' . '%1$s' . '</span>', $portfolio_terms );
				}
			} else {
				if ( $categories_list && $cats == true ) {
					$output .= sprintf( '<span class="entry-category">' . '%1$s' . '</span>', $categories_list ); // WPCS: XSS OK.
				}
			}
		}

		if ( comments_open() && siteorigin_setting( 'blog_post_comment_count' ) ) {
			$output .= '<span class="comments-link">';
			ob_start();
			comments_popup_link( esc_html__( 'Leave a comment', 'siteorigin-corp' ), esc_html__( 'One Comment', 'siteorigin-corp' ), esc_html__( '% Comments', 'siteorigin-corp' ) );
			$output .= ob_get_clean();
			$output .= '</span>';
		}

		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function siteorigin_corp_posted_on( $echo = true ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'siteorigin-corp' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$output = '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_entry_footer' ) ) {
	/**
	 * Print HTML with meta information for the post tags.
	 */
	function siteorigin_corp_entry_footer( $post_id = '' ) {
		if ( is_single() && has_tag() && siteorigin_setting( 'blog_post_tags' ) ) {
			echo '<footer class="entry-footer"><span class="tags-links">' . get_the_tag_list() . '</span></footer>';
		}
		$portfolio_terms = get_the_term_list( $post_id, 'jetpack-portfolio-tag', '', '', '' );

		if ( 'jetpack-portfolio' == get_post_type() && $portfolio_terms ) {
			printf( '<footer class="entry-footer"><span class="tags-links">' . '%1$s' . '</span></footer>', $portfolio_terms );
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_footer_text' ) ) {
	/**
	 * Insert footer text from theme settings.
	 */
	function siteorigin_corp_footer_text() {
		$text = siteorigin_setting( 'footer_text' );

		if ( empty( $text ) ) {
			return;
		}
		$text = str_replace(
			array( '{sitename}', '{year}' ),
			array( get_bloginfo( 'sitename' ), date( 'Y' ) ),
			'<span>' . $text . '</span>'
		);
		echo wp_kses_post( $text );
	}
}

/**
 * Add a filter for Jetpack Featured Content.
 */
function siteorigin_corp_get_featured_posts() {
	return apply_filters( 'siteorigin_corp_get_featured_posts', array() );
}

/**
 * Check the Jetpack Featured Content.
 */
function siteorigin_corp_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() ) {
		return false;
	}

	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'siteorigin_corp_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) ) {
		return false;
	}

	if ( $minimum > count( $featured_posts ) ) {
		return false;
	}

	return true;
}

if ( ! function_exists( 'siteorigin_corp_display_featured_posts' ) ) {
	/**
	 * Output the Jetpack Featured Content.
	 */
	function siteorigin_corp_display_featured_posts() {
		if ( is_home() && siteorigin_corp_has_featured_posts() ) {
			get_template_part( 'template-parts/featured', 'slider' );
		}
	}
}
add_action( 'siteorigin_corp_content_before', 'siteorigin_corp_display_featured_posts' );

if ( ! function_exists( 'siteorigin_corp_strip_gallery' ) ) {
	/**
	 * Remove gallery.
	 */
	function siteorigin_corp_strip_gallery( $content ) {
		preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

		if ( ! empty( $matches ) ) {
			foreach ( $matches as $shortcode ) {
				if ( 'gallery' === $shortcode[2] ) {
					$pos = strpos( $content, $shortcode[0] );

					if ( false !== $pos ) {
						return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
					}
				}
			}
		}

		return $content;
	}
}

if ( ! function_exists( 'siteorigin_corp_get_gallery' ) ) {
	/**
	 * Get gallery from content for gallery format posts.
	 */
	function siteorigin_corp_get_gallery() {
		$gallery = get_post_gallery( get_the_ID(), false );

		if ( ! empty( $gallery ) && ! has_action( 'wp_footer', 'siteorigin_corp_enqueue_flexslider' ) ) {
			add_action( 'wp_footer', 'siteorigin_corp_enqueue_flexslider' );
		}

		return ( '' !== $gallery ) ? $gallery : false;
	}
}

if ( ! function_exists( 'siteorigin_corp_get_video' ) ) {
	/**
	 * Get the video from the current post.
	 */
	function siteorigin_corp_get_video() {
		$first_url = '';
		$first_video = '';

		$i = 0;

		preg_match_all( '|^\s*https?://[^\s"]+\s*$|im', get_the_content(), $urls );

		foreach ( $urls[0] as $url ) {
			$i++;

			if ( 1 === $i ) {
				$first_url = trim( $url );
			}

			$oembed = wp_oembed_get( esc_url( $url ) );

			if ( ! $oembed ) {
				continue;
			}

			$first_video = $oembed;

			break;
		}

		wp_enqueue_script( 'jquery-fitvids' );

		return ( '' !== $first_video ) ? $first_video : false;
	}
}

if ( ! function_exists( 'siteorigin_corp_filter_video' ) ) {
	/**
	 * Removes the video from the page.
	 */
	function siteorigin_corp_filter_video( $content ) {
		if ( siteorigin_corp_get_video() ) {
			preg_match_all( '|^\s*https?://[^\s"]+\s*$|im', $content, $urls );

			if ( ! empty( $urls[0] ) ) {
				$content = str_replace( $urls[0][0], '', $content );
			}

			return $content;
		} else {
			return $content;
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_get_image' ) ) {
	/**
	 * Removes the first image from the page.
	 */
	function siteorigin_corp_get_image() {
		preg_match_all( '/<img[^>]+\>/i', get_the_content(), $images );

		if ( empty( $images[0] ) ) {
			return false;
		}

		$first_image = $images[0][0];

		return ( '' !== $first_image ) ? $first_image : false;
	}
}

if ( ! function_exists( 'siteorigin_corp_strip_image' ) ) {
	/**
	 * Removes the first image from the page.
	 */
	function siteorigin_corp_strip_image( $content ) {
		return preg_replace( '/<img[^>]+\>/i', '', $content, 1 );
	}
}

if ( ! function_exists( 'siteorigin_corp_is_post_loop_widget' ) ) {
	/**
	 * Checks if we're currently rendering a post loop widget.
	 */
	function siteorigin_corp_is_post_loop_widget() {
		return method_exists( 'SiteOrigin_Panels_Widgets_PostLoop', 'is_rendering_loop' ) && SiteOrigin_Panels_Widgets_PostLoop::is_rendering_loop();
	}
}

if ( ! function_exists( 'siteorigin_corp_is_post_loop_template' ) ) {
	/**
	 * Check if we're currently rendering a specific Page Builder Post Loop widget template.
	 *
	 * @return bool
	 */
	function siteorigin_corp_is_post_loop_template( $check ) {
		if ( ! method_exists( 'SiteOrigin_Panels_Widgets_PostLoop', 'get_current_loop_template' ) ) {
			return false;
		}

		switch( $check ) {
			case 'offset':
				return SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-blog-offset.php';

			case 'grid':
				return SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-blog-grid.php';

			case 'alternate':
				return SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-blog-alternate.php';

			case 'masonry':
				return SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-blog-masonry.php';
		}

		return false;
	}
}

if ( ! function_exists( 'siteorigin_corp_entry_thumbnail' ) ) {
	/**
	 * Displays the entry thumbnail for all blog loops.
	 */
	function siteorigin_corp_entry_thumbnail() {
		if ( is_single() ) {
			if ( siteorigin_setting( 'blog_post_featured_image' ) ) { ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php }
		} elseif (
			(
				! siteorigin_corp_is_post_loop_widget() &&
				siteorigin_setting( 'blog_archive_featured_image' ) &&
				siteorigin_setting( 'blog_archive_layout' ) == 'grid'
			) ||
			siteorigin_corp_is_post_loop_template( 'grid' )
		) {
		?>
			<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'siteorigin-corp-720x480-crop' ); ?>
				</a>
			</div>
			<?php
		} elseif (
			(
				! siteorigin_corp_is_post_loop_widget() &&
				siteorigin_setting( 'blog_archive_featured_image' ) &&
				siteorigin_setting( 'blog_archive_layout' ) == 'alternate'
			) ||
			siteorigin_corp_is_post_loop_template( 'alternate' )
		) {
		?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'siteorigin-corp-720x480-crop' ); ?>
			</a>
		</div>
		<?php
		} elseif (
			(
				! siteorigin_corp_is_post_loop_widget() &&
				siteorigin_setting( 'blog_archive_featured_image' ) &&
				siteorigin_setting( 'blog_archive_layout' ) == 'masonry'
			)
			|| siteorigin_corp_is_post_loop_template( 'masonry' )
		) {
			?>
			<div class="entry-thumbnail">
				<?php
				if ( siteorigin_setting( 'blog_post_categories' ) ) {
					siteorigin_corp_entry_thumbnail_meta();
				}
				?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
			<?php
		} elseif ( siteorigin_setting( 'blog_archive_featured_image' ) ) {
			?>
			<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
		<?php
		}
	}
}

if ( ! function_exists( 'siteorigin_corp_get_post_title' ) ) {
	/**
	 * Displays the current post title.
	 */
	function siteorigin_corp_get_post_title() {
		if ( ! empty( get_the_title() ) ) {
			if ( is_single() ) {
				if ( siteorigin_page_setting( 'page_title' )  ) {
					return '<h1 class="entry-title">' . get_the_title() . '</h1>';
				}
			} else {
				return '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title() . '</a></h2>';
			}
		}
	}
}
