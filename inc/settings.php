<?php
/**
 * Theme settings.
 *
 * @package siteorigin-corp
 * @license GPL 2.0
 */

/**
 * Localize the theme settings.
 */
function siteorigin_corp_settings_localize( $loc ) {
	return wp_parse_args( array(
		'section_title' => esc_html__( 'Theme Settings', 'siteorigin-corp' ),
		'section_description' => esc_html__( 'Change settings for your theme.', 'siteorigin-corp' ),
		'premium_only' => esc_html__( 'Available in Premium', 'siteorigin-corp' ),

		// Controls.
		'variant' => esc_html__( 'Variant', 'siteorigin-corp' ),
		'subset' => esc_html__( 'Subset', 'siteorigin-corp' ),

		// Settings metabox.
		'meta_box' => esc_html__( 'Page settings', 'siteorigin-corp' ),
	), $loc );
}
add_filter( 'siteorigin_settings_localization', 'siteorigin_corp_settings_localize' );

/**
 * Initialize the settings.
 */
function siteorigin_corp_settings_init() {

	SiteOrigin_Settings::single()->configure( apply_filters( 'siteorigin_corp_settings_array', array(

		'header' => array(
			'title' => esc_html__( 'Header', 'siteorigin-corp' ),
			'fields' => array(
				'retina_logo' => array(
					'type' => 'media',
					'label' => esc_html__( 'Retina Logo', 'siteorigin-corp' ),
					'description' => esc_html__( 'A double sized logo to use on retina devices. Must be used in addition to a regular logo added in the Site Identity section.', 'siteorigin-corp' ),
				),
				'site_description' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Tagline', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the website tagline below the logo or site title.', 'siteorigin-corp' ),
				),
				'sticky' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Sticky Header', 'siteorigin-corp' ),
					'description' => esc_html__( 'Sticks the header to the top of the screen on scroll.', 'siteorigin-corp' ),
				),
				'scales' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Sticky Header Scales Logo', 'siteorigin-corp' ),
					'description' => esc_html__( 'Scales the logo down as the header becomes sticky.', 'siteorigin-corp' ),
				),
				'background' => array(
					'type' => 'color',
					'label' => esc_html__( 'Background Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'border' => array(
					'type' => 'color',
					'label' => esc_html__( 'Border Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Padding', 'siteorigin-corp' ),
					'description' => esc_html__( 'Top and bottom padding.', 'siteorigin-corp' ),
					'live'	=> true,
				),
				'margin'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Bottom Margin', 'siteorigin-corp' ),
					'live'	=> true,
				),
			),
		),

		'navigation' => array(
			'title' => esc_html__( 'Navigation', 'siteorigin-corp' ),
			'fields' => array(
				'header_menu' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Header Menu', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display header menu.', 'siteorigin-corp' )
				),
				'mobile_menu' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Mobile Menu', 'siteorigin-corp' ),
					'description' => esc_html__( 'Use a mobile menu for small screen devices. Header Menu setting must be enabled.', 'siteorigin-corp' )
				),
				'mobile_menu_collapse' => array(
					'label' => esc_html__( 'Mobile Menu Collapse', 'siteorigin-corp' ),
					'type' => 'number',
					'description' => esc_html__( 'The pixel resolution when the header menu collapses into the mobile menu.', 'siteorigin-corp' ),
					'live'	=> true
				),
				'menu_search' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Menu Search', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display a search icon in the header menu.', 'siteorigin-corp' )
				),
				'post' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Navigation', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display next/previous navigation on single post pages.', 'siteorigin-corp' )
				),
				'scroll_to_top' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Scroll to Top', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the scroll to top button.', 'siteorigin-corp' )
				),
				'link' => array(
					'type' => 'color',
					'label' => esc_html__( 'Link Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Header menu link color.', 'siteorigin-corp' ),
					'live' => true,
				),
				'link_accent' => array(
					'type' => 'color',
					'label' => esc_html__( 'Link Hover Accent Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Header menu accent color used on hover.', 'siteorigin-corp' ),
					'live' => true,
				),
				'drop_down_link' => array(
					'type' => 'color',
					'label' => esc_html__( 'Drop Down Link Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Header menu drop down link color.', 'siteorigin-corp' ),
					'live' => true,
				),
				'drop_down_link_hover' => array(
					'type' => 'color',
					'label' => esc_html__( 'Drop Down Link Hover Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Header menu drop down link hover color.', 'siteorigin-corp' ),
					'live' => true,
				),
				'drop_down_divider' => array(
					'type' => 'color',
					'label' => esc_html__( 'Drop Down Link Divider Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Header menu drop down link divider color.', 'siteorigin-corp' ),
					'live' => true,
				),
				'drop_down_background' => array(
					'type' => 'color',
					'label' => esc_html__( 'Drop Down Background', 'siteorigin-corp' ),
					'description' => esc_html__( 'Header menu drop down background color.', 'siteorigin-corp' ),
					'live' => true,
				),
				'search_overlay_text' => array(
					'type' => 'color',
					'label' => esc_html__( 'Menu Search Overlay Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Header menu search overlay text color.', 'siteorigin-corp' ),
					'live' => true,
				),
				'search_overlay_background' => array(
					'type' => 'color',
					'label' => esc_html__( 'Menu Search Overlay Background', 'siteorigin-corp' ),
					'description' => esc_html__( 'Header menu search background color.', 'siteorigin-corp' ),
					'live' => true,
				),
			),
		),

		'typography' => array(
			'title' => esc_html__( 'Typography', 'siteorigin-corp' ),
			'fields' => array(
				'site_title_font' => array(
					'type' => 'font',
					'label' => esc_html__( 'Site Title Font', 'siteorigin-corp' ),
					'live' => true,
				),
				'site_tagline_font' => array(
					'type' => 'font',
					'label' => esc_html__( 'Site Tagline Font', 'siteorigin-corp' ),
					'live' => true,
				),
				'heading_font' => array(
					'type' => 'font',
					'label' => esc_html__( 'Heading Font', 'siteorigin-corp' ),
					'live' => true,
				),
				'body_font' => array(
					'type' => 'font',
					'label' => esc_html__( 'Body Font', 'siteorigin-corp' ),
					'live' => true,
				),
				'site_title' => array(
					'type' => 'color',
					'label' => esc_html__( 'Site Title Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'site_tagline' => array(
					'type' => 'color',
					'label' => esc_html__( 'Site Tagline Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'accent' => array(
					'type' => 'color',
					'label' => esc_html__( 'Accent Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Used for links, buttons and blockquotes.', 'siteorigin-corp' ),
					'live' => true,
				),
				'heading' => array(
					'type' => 'color',
					'label' => esc_html__( 'Heading Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'text' => array(
					'type' => 'color',
					'label' => esc_html__( 'Text Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'secondary_text' => array(
					'type' => 'color',
					'label' => esc_html__( 'Secondary Text Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Used for for post meta.', 'siteorigin-corp' ),
					'live' => true,
				),
				'border' => array(
					'type' => 'color',
					'label' => esc_html__( 'Border Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Used for section borders and hr tags.', 'siteorigin-corp' ),
					'live' => true,
				),
				'border_dark' => array(
					'type' => 'color',
					'label' => esc_html__( 'Border Dark Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Used for tables and form fields.', 'siteorigin-corp' ),
					'live' => true,
				),
			),
		),

		'blog' => array(
			'title' => esc_html__( 'Blog', 'siteorigin-corp' ),
			'fields' => array(
				'archive_featured_image' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Archive Featured Image', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the featured image on blog and archive pages.', 'siteorigin-corp' )
				),
				'archive_content' => array(
					'type' => 'select',
					'label' => esc_html__( 'Archive Post Content', 'siteorigin-corp' ),
					'options' => array(
						'excerpt'  => esc_html__( 'Post Excerpt', 'siteorigin-corp' ),
						'full' => esc_html__( 'Full Post Content', 'siteorigin-corp' ),
					),
					'description' => esc_html__( 'Choose how to display your post content on blog and archive pages. Select Full Post Content if using the "more" quicktag.', 'siteorigin-corp' ),
				),
				'excerpt_length' => array(
					'type' => 'number',
					'label' => esc_html__( 'Excerpt Length', 'siteorigin-corp' ),
					'description' => esc_html__( 'If no manual post excerpt is added one will be generated. Choose how many words it should be.', 'siteorigin-corp' ),
				),
				'post_excerpt_read_more_link' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Excerpt Read More Link', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the Read More link below the post excerpt.', 'siteorigin-corp' )
				),
				'post_featured_image' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Featured Image', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the featured image on the single post page.', 'siteorigin-corp' )
				),
				'post_date' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Date', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the post date on blog, archive and single post pages.', 'siteorigin-corp' )
				),
				'post_categories' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Categories', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the post categories on blog, archive and single post pages.', 'siteorigin-corp' )
				),
				'post_comment_count' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Comment Count', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the post comment count on blog, archive and single post pages.', 'siteorigin-corp' )
				),
				'post_tags' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Tags', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the post tags on single post pages.', 'siteorigin-corp' )
				),
				'post_author_box' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Author Box', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the post author biographical info on single post pages.', 'siteorigin-corp' )
				),
				'related_posts' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Related Posts', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display related posts on single post pages.', 'siteorigin-corp' )
				),
				'ajax_comments' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Ajax Comments', 'siteorigin-corp' ),
					'description' => esc_html__( 'Keep the conversation flowing with ajax loading comments.', 'siteorigin-corp' ),
					'teaser' => true,
				),
			),
		),

		'sidebar' => array(
			'title' => esc_html__( 'Sidebar', 'siteorigin-corp' ),
			'fields' => array(
				'position'	=> array(
					'type'	=> 'select',
					'label'	=> esc_html__( 'Position', 'siteorigin-corp' ),
					'options' => array(
						'right' => esc_html__( 'Right', 'siteorigin-corp' ),
						'left'  => esc_html__( 'Left', 'siteorigin-corp' ),
					),
				),
				'width' => array(
					'label'       => esc_html__( 'Width', 'siteorigin-corp' ),
					'type'        => 'measurement',
					'live'        => true,
				),
			),
		),

		'footer' => array(
			'title' => esc_html__( 'Footer', 'siteorigin-corp' ),
			'fields' => array(
				'text' => array(
					'type' => 'text',
					'label' => esc_html__( 'Footer Text', 'siteorigin-corp' ),
					'description' => esc_html__( "{site-title} and {year} can be used to display your website title and the current year.", 'siteorigin-corp' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'attribution' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Display SiteOrigin Attribution', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display a SiteOrigin link in your footer bottom bar.', 'siteorigin-corp' ),
					'teaser' => true,
				),
				'social_widget' => array(
					'type' => 'widget',
					'widget_class' => 'SiteOrigin_Widget_SocialMediaButtons_Widget',
					'bundle_widget' => 'social-media-buttons',
					'plugin' => 'so-widgets-bundle',
					'plugin_name' => esc_html__( 'SiteOrigin Widgets Bundle', 'siteorigin-corp' ),
					'description' => esc_html__( 'Add social icons to the bottom bar.', 'siteorigin-corp' ),
				),
				'widget_title' => array(
					'type' => 'color',
					'label' => esc_html__( 'Widget Title Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'widget_text' => array(
					'type' => 'color',
					'label' => esc_html__( 'Widget Text Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'widget_link' => array(
					'type' => 'color',
					'label' => esc_html__( 'Widget Link Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'widget_link_hover' => array(
					'type' => 'color',
					'label' => esc_html__( 'Widget Link Hover Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'background' => array(
					'type' => 'color',
					'label' => esc_html__( 'Widget Background Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'bottom_bar_text' => array(
					'type' => 'color',
					'label' => esc_html__( 'Bottom Bar Text Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'Bottom bar appears below footer widget area.', 'siteorigin-corp' ),
					'live' => true,
				),
				'bottom_bar_link' => array(
					'type' => 'color',
					'label' => esc_html__( 'Bottom Bar Link Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'bottom_bar_link_hover' => array(
					'type' => 'color',
					'label' => esc_html__( 'Bottom Bar Link Hover Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'bottom_bar_background' => array(
					'type' => 'color',
					'label' => esc_html__( 'Bottom Bar Background Color', 'siteorigin-corp' ),
					'live' => true,
				),
				'padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Padding', 'siteorigin-corp' ),
					'description' => esc_html__( 'Footer widget area top and bottom padding.', 'siteorigin-corp' ),
					'live'	=> true,
				),
				'margin'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Top Margin', 'siteorigin-corp' ),
					'description' => esc_html__( 'Footer top margin. The space between the footer and content.', 'siteorigin-corp' ),
					'live'	=> true,
				),
			),
		),
	) ) );
}
add_action( 'siteorigin_settings_init', 'siteorigin_corp_settings_init' );

function siteorigin_corp_woocommerce_settings( $settings ) {
	if ( ! function_exists( 'is_woocommerce' ) ) return $settings;

	$wc_settings = array(
		'woocommerce' => array(
			'title' => esc_html__( 'WooCommerce', 'siteorigin-corp' ),
			'fields' => array(

				'shop_sidebar' => array(
					'type' => 'select',
					'label' => esc_html__( 'Shop Sidebar Position', 'siteorigin-corp' ),
					'description' => esc_html__( 'Choose the shop sidebar position.', 'siteorigin-corp' ),
					'options' => array(
						'left' => esc_html__( 'Left', 'siteorigin-corp' ),
						'right' => esc_html__( 'Right', 'siteorigin-corp' ),
					),
				),						

				'product_gallery' => array(
					'type' => 'select',
					'label' => esc_html__( 'Product Gallery', 'siteorigin-corp' ),
					'options' => array(
						'slider' => esc_html__( 'Gallery Slider', 'siteorigin-corp' ),
						'slider-lightbox' => esc_html__( 'Gallery Slider + Lightbox', 'siteorigin-corp' ),
						'slider-zoom' => esc_html__( 'Gallery Slider + Zoom', 'siteorigin-corp' ),
						'slider-lightbox-zoom' => esc_html__( 'Gallery Slider + Lightbox + Zoom', 'siteorigin-corp' ),
					),
				),
			)
		)
	);

	return array_merge( $settings, $wc_settings );
}
add_filter( 'siteorigin_corp_settings_array', 'siteorigin_corp_woocommerce_settings' );

/**
 * Tell the settings framework which settings we're using as fonts.
 *
 * @param $settings
 *
 * @return array
 */
function siteorigin_corp_font_settings( $settings ) {

	$settings['typography_site_title_font'] = array(
		'name'    => 'Montserrat',
		'weights' => array(
			400,
			500,
			600,
			700
		),
	);
	$settings['typography_site_tagline_font'] = array(
		'name'    => 'Open Sans',
		'weights' => array(
			300,
			400,
			600,
		),
	);
	$settings['typography_heading_font'] = array(
		'name'    => 'Montserrat',
		'weights' => array(
			400,
		),
	);
	$settings['typography_body_font'] = array(
		'name'    => 'Open Sans',
		'weights' => array(
			300,
			400,
			600,
		),
	);

	return $settings;
}
add_filter( 'siteorigin_settings_font_settings', 'siteorigin_corp_font_settings' );

/**
 * Add custom CSS for the theme settings.
 *
 * @param $css
 *
 * @return string
 */
function siteorigin_corp_settings_custom_css( $css ) {

$css .= 'body,button,input,select,optgroup,textarea {
	color: ${typography_text};
	.font( ${typography_body_font} );
	}
	h1,h2,h3,h4,h5,h6 {
	color: ${typography_heading};
	.font( ${typography_heading_font} );
	}
	h1 a,h1 a:visited,h2 a,h2 a:visited,h3 a,h3 a:visited,h4 a,h4 a:visited,h5 a,h5 a:visited,h6 a,h6 a:visited {
	color: ${typography_heading};
	}
	.sub-heading,.site-content #jp-relatedposts .jp-relatedposts-headline,.site-content #primary .sharedaddy h3,.yarpp-related .related-posts,.related-posts-section .related-posts,.comments-title,.comment-reply-title {
	color: ${typography_text};
	}
	blockquote {
	border-left: 3px solid ${typography_accent};
	}
	blockquote cite {
	color: ${typography_text};
	}
	abbr,acronym {
	border-bottom: 1px dotted ${typography_text};
	}
	hr {
	background-color: ${typography_border};
	}
	table {
	border: 1px solid ${typography_border_dark};
	.font( ${typography_body_font} );
	}
	table thead th {
	color: ${typography_heading};
	}
	table th,table td {
	border: 1px solid ${typography_border};
	}
	.button,button,input[type="button"],input[type="reset"],input[type="submit"] {
	background: ${typography_accent};
	.font( ${typography_body_font} );
	}
	.button:hover,button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover {
	background: .rgba( ${typography_accent}, .8);
	}
	.button:active,.button:focus,button:active,button:focus,input[type="button"]:active,input[type="button"]:focus,input[type="reset"]:active,input[type="reset"]:focus,input[type="submit"]:active,input[type="submit"]:focus {
	background: ${typography_accent};
	}
	input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="number"],input[type="tel"],input[type="range"],input[type="date"],input[type="month"],input[type="week"],input[type="time"],input[type="datetime"],input[type="datetime-local"],input[type="color"],textarea {
	border: 1px solid ${typography_border_dark};
	}
	input[type="text"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="search"]:focus,input[type="number"]:focus,input[type="tel"]:focus,input[type="range"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="week"]:focus,input[type="time"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="color"]:focus,textarea:focus {
	border-color: .rgba( ${typography_border_dark}, .8);
	}
	select {
	border: 1px solid ${typography_border_dark};
	}
	label {
	color: ${typography_heading};
	}
	fieldset legend {
	color: ${typography_heading};
	.font( ${typography_heading_font} );
	}
	a {
	color: ${typography_accent};
	}
	a:visited {
	color: ${typography_accent};
	}
	a:hover,a:focus,a:active {
	color: ${typography_text};
	}
	.main-navigation ul ul li a {
	background: ${navigation_drop_down_background};
	border-color: ${navigation_drop_down_divider};
	color: ${navigation_drop_down_link};
	}
	.main-navigation ul ul li:hover > a {
	color: ${navigation_drop_down_link_hover};
	}
	.main-navigation ul ul li:first-of-type {
	border-top: 2px solid ${navigation_link_accent};
	}
	.main-navigation ul li {
	.font( ${typography_heading_font} );
	}
	.main-navigation ul li a {
	color: ${navigation_link};
	}
	#site-navigation.main-navigation ul .menu-button a {
	background: ${typography_accent};
	}
	#site-navigation.main-navigation ul .menu-button a:hover {
	background: .rgba( ${typography_accent}, .8);
	}
	.main-navigation div > ul > li:hover > a {
	border-color: ${navigation_link_accent};
	}
	.main-navigation div > ul > li.current > a,.main-navigation div > ul > li.current_page_item > a,.main-navigation div > ul > li.current-menu-item > a,.main-navigation div > ul > li.current_page_ancestor > a,.main-navigation div > ul > li.current-menu-ancestor > a {
	border-color: ${navigation_link_accent};
	}
	.main-navigation .search-toggle .open svg path {
	fill: ${navigation_link};
	}
	#mobile-menu-button svg path {
	fill: ${navigation_link};
	}
	#mobile-navigation {
	background: ${navigation_drop_down_background};
	}
	#mobile-navigation ul li {
	.font( ${typography_heading_font} );
	}
	#mobile-navigation ul li a {
	border-color: ${navigation_drop_down_divider};
	color: ${navigation_drop_down_link};
	}
	#mobile-navigation ul li a:hover {
	color: ${navigation_drop_down_link_hover};
	}
	#mobile-navigation ul li .dropdown-toggle {
	color: ${navigation_drop_down_link};
	}
	#mobile-navigation ul li .dropdown-toggle:hover {
	color: ${navigation_drop_down_link_hover};
	}
	.pagination .page-numbers {
	border: 1px solid ${typography_text};
	color: ${typography_text};
	.font( ${typography_body_font} );
	}
	.pagination .page-numbers:visited {
	color: ${typography_text};
	}
	.pagination .page-numbers:hover {
	border-color: ${typography_accent};
	color: ${typography_accent};
	}
	.pagination .page-numbers.dots:hover {
	color: ${typography_text};
	}
	.pagination .current {
	border-color: ${typography_accent};
	color: ${typography_accent};
	}
	.post-navigation {
	border-top: 1px solid ${typography_border};
	}
	.post-navigation a span {
	color: ${typography_secondary_text};
	}
	.post-navigation a div {
	color: ${typography_heading};
	.font( ${typography_heading_font} );
	}
	.post-navigation a:hover div {
	color: ${typography_accent};
	}
	.comment-navigation a {
	color: ${typography_text};
	}
	.comment-navigation a:hover {
	color: ${typography_accent};
	}
	.breadcrumbs {
	color: ${typography_secondary_text};
	}
	.breadcrumbs a {
	color: ${typography_secondary_text};
	}
	.breadcrumbs a:hover {
	color: ${typography_accent};
	}
	.site-main #infinite-handle span button {
	border-color: ${typography_heading};
	color: ${typography_heading};
	}
	.site-main #infinite-handle span button:hover {
	border-color: ${typography_accent};
	color: ${typography_accent};
	}
	.site-content #jp-relatedposts .jp-relatedposts-headline {
	.font( ${typography_heading_font} );
	}
	.site-content #jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-title a {
	color: ${typography_heading};
	.font( ${typography_heading_font} );
	}
	.site-content #jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-title a:hover {
	color: ${typography_accent};
	}
	.site-content #jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-date,.site-content #jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-context {
	color: ${typography_text};
	}
	.site-content #primary .sharedaddy {
	border-top: 1px solid ${typography_border};
	}
	.widget-area .widget a:not(.button),.site-footer .widget a:not(.button) {
	color: ${typography_text};
	}
	.widget-area .widget a:not(.button):hover,.site-footer .widget a:not(.button):hover {
	color: ${typography_accent};
	}
	.calendar_wrap {
	border: 1px solid ${typography_border};
	}
	.widget #wp-calendar caption {
	color: ${typography_heading};
	}
	.widget #wp-calendar tbody td a {
	color: ${typography_accent};
	}
	.widget #wp-calendar tbody td a:hover {
	color: ${typography_text};
	}
	.widget #wp-calendar tfoot #prev a,.widget #wp-calendar tfoot #next a {
	color: ${typography_heading};
	}
	.widget #wp-calendar tfoot #prev a:hover,.widget #wp-calendar tfoot #next a:hover {
	color: ${typography_accent};
	}
	.widget_archive li,.widget_categories li {
	color: ${typography_secondary_text};
	}
	.widget_archive li a,.widget_categories li a {
	color: ${typography_heading};
	}
	.widget_archive li span,.widget_categories li span {
	color: ${typography_secondary_text};
	}
	.widget_recent_comments .recentcomments {
	color: ${typography_secondary_text};
	}
	.widget_recent_comments .recentcomments .comment-author-link {
	color: ${typography_heading};
	}
	.widget_recent_comments .recentcomments .comment-author-link:before {
	color: ${typography_secondary_text};
	}
	.widget_recent_comments .recentcomments a {
	color: ${typography_heading};
	}
	.widget_recent_entries li {
	color: ${typography_secondary_text};
	}
	.widget_recent_entries li a {
	color: ${typography_heading};
	}
	.widget.recent-posts-extended h3 {
	color: ${typography_heading};
	}
	.widget.recent-posts-extended h3 a {
	color: ${typography_heading};
	}
	.widget.recent-posts-extended h3 a:hover {
	color: ${typography_text};
	}
	.widget.recent-posts-extended time {
	color: ${typography_secondary_text};
	}
	.site-footer aside.widget.widget_tag_cloud .tagcloud a:after {
	background: ${footer_background};
	}
	.sidebar .content-area {
	margin: 0 -${sidebar_width} 0 0;
	}
	.sidebar .site-main {
	margin: 0 ${sidebar_width} 0 0;
	}
	.sidebar-left .content-area {
	margin: 0 0 0 -${sidebar_width};
	}
	.sidebar-left .site-main {
	margin: 0 0 0 ${sidebar_width};
	}
	.widget-area {
	width: ${sidebar_width};
	}
	@media (max-width: 768px) {
	.widget-area {
	border-top: 1px solid ${typography_border_dark};
	}
	}
	.site-header {
	background: ${header_background};
	border-bottom: 1px solid ${header_border};
	margin-bottom: ${header_margin};
	padding: ${header_padding} 0;
	}
	.site-header .site-branding .site-title {
	.font( ${typography_site_title_font} );
	}
	.site-header .site-branding .site-title a {
	color: ${typography_site_title};
	}
	.site-header .site-branding .site-description {
	color: ${typography_site_tagline};
	.font( ${typography_site_tagline_font} );
	}
	#fullscreen-search {
	background: .rgba( ${navigation_search_overlay_background}, .95);
	}
	#fullscreen-search h3 {
	color: ${navigation_search_overlay_text};
	.font( ${typography_body_font} );
	}
	#fullscreen-search form {
	border-bottom: 1px solid ${navigation_search_overlay_text};
	}
	#fullscreen-search form button[type="submit"] svg {
	fill: ${navigation_search_overlay_text};
	}
	#fullscreen-search .search-close-button .close svg path {
	fill: ${navigation_search_overlay_text};
	}
	body:not(.single) .hentry {
	border: 1px solid ${typography_border};
	}
	.entry-title {
	color: ${typography_heading};
	}
	.entry-title a:hover {
	color: ${typography_text};
	}
	.entry-meta {
	.font( ${typography_body_font} );
	}
	.entry-meta span {
	color: ${typography_secondary_text};
	}
	.entry-meta span a:hover {
	color: ${typography_accent};
	}
	.page-links .page-links-title {
	color: ${typography_heading};
	}
	.page-links .page-links-title {
	color: ${typography_text};
	}
	.page-links .page-links-title:hover {
	color: ${typography_text};
	}
	.page-links span {
	border: 1px solid ${typography_text};
	color: ${typography_text};
	.font( ${typography_body_font} );
	}
	.page-links span:visited {
	color: ${typography_text};
	}
	.page-links span:hover {
	border-color: ${typography_accent};
	color: ${typography_accent};
	}
	.page-links a span {
	color: ${typography_text};
	}
	.tags-links a,aside.widget.widget_tag_cloud .tagcloud a {
	color: ${typography_text};
	}
	.tags-links a:hover,aside.widget.widget_tag_cloud .tagcloud a:hover {
	background: ${typography_accent};
	}
	.tags-links a:hover:after,aside.widget.widget_tag_cloud .tagcloud a:hover:after {
	border-right-color: ${typography_accent};
	}
	.search-form button[type="submit"] svg path {
	fill: ${typography_text};
	}
	.author-box {
	border-top: 1px solid ${typography_border};
	}
	.author-box .author-description span a {
	color: ${typography_text};
	}
	.author-box .author-description span a:hover {
	color: ${typography_accent};
	}
	.yarpp-related ol li .corp-content-wrapper,.related-posts-section ol li .corp-content-wrapper {
	border: 1px solid ${typography_border};
	}
	.yarpp-related ol li .related-post-title:hover,.related-posts-section ol li .related-post-title:hover {
	color: ${typography_accent};
	}
	.yarpp-related ol li .related-post-date,.related-posts-section ol li .related-post-date {
	color: ${typography_secondary_text};
	}
	.yarpp-related ol li .related-post-date:hover,.related-posts-section ol li .related-post-date:hover {
	color: ${typography_accent};
	}
	.comment-list .comment,.comment-list .pingback {
	color: ${typography_text};
	}
	.comment-list .comment .comment-box,.comment-list .pingback .comment-box {
	border-bottom: 1px solid ${typography_border};
	}
	.comment-list .comment .author,.comment-list .pingback .author {
	color: ${typography_heading};
	.font( ${typography_heading_font} );
	}
	.comment-list .comment .author a,.comment-list .pingback .author a {
	color: ${typography_heading};
	}
	.comment-list .comment .author a:hover,.comment-list .pingback .author a:hover {
	color: ${typography_text};
	}
	.comment-list .comment .date,.comment-list .pingback .date {
	color: ${typography_secondary_text};
	}
	.comment-list .comment .comment-reply-link,.comment-list .pingback .comment-reply-link {
	color: ${typography_heading};
	.font( ${typography_heading_font} );
	}
	.comment-list .comment .comment-reply-link:hover,.comment-list .pingback .comment-reply-link:hover {
	color: ${typography_accent};
	}
	.comment-reply-title #cancel-comment-reply-link {
	color: ${typography_secondary_text};
	}
	.comment-reply-title #cancel-comment-reply-link:hover {
	color: ${typography_accent};
	}
	#commentform .comment-notes a,#commentform .logged-in-as a {
	color: ${typography_text};
	}
	#commentform .comment-notes a:hover,#commentform .logged-in-as a:hover {
	color: ${typography_accent};
	}
	#commentform .comment-subscription-form label {
	color: ${typography_text};
	}
	.site-footer {
	background: ${footer_background};
	margin-top: ${footer_margin};
	}
	.site-footer .widgets {
	padding-top: ${footer_padding};
	}
	.site-footer .widgets .widget .widget-title {
	color: ${footer_widget_title};
	}
	.site-footer .widgets .widget *:not(.widget-title):not(a) {
	color: ${footer_widget_text};
	}
	.site-footer .widgets .widget a {
	color: ${footer_widget_link};
	}
	.site-footer .widgets .widget a:hover {
	color: ${footer_widget_link_hover};
	}
	.site-footer .bottom-bar {
	background: ${footer_bottom_bar_background};
	color: ${footer_bottom_bar_text};
	}
	.site-footer .bottom-bar a {
	color: ${footer_bottom_bar_link};
	}
	.site-footer .bottom-bar a:hover {
	color: ${footer_bottom_bar_link_hover};
	}
	.wp-caption {
	color: ${typography_secondary_text};
	}
	.featured-posts-slider .slides .slide {
	background-color: ${typography_text};
	}';

	return $css;
}
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_corp_settings_custom_css' );

/**
 * Add custom CSS for the theme woocommerce elements.
 *
 * @param $css
 *
 * @return string
 */
function siteorigin_corp_wc_settings_custom_css( $css ) {
	if ( ! function_exists( 'is_woocommerce' ) ) return $css;
	$css .= '.woocommerce.woocommerce-sidebar .content-area {
	margin: 0 -${sidebar_width} 0 0;
	}
	.woocommerce.woocommerce-sidebar .site-main {
	margin: 0 ${sidebar_width} 0 0;
	}
	.woocommerce.woocommerce-sidebar-left .content-area {
	margin: 0 0 0 -${sidebar_width};
	}
	.woocommerce.woocommerce-sidebar-left .site-main {
	margin: 0 0 0 ${sidebar_width};
	}
	@keyframes "spin" {
	100% {
	}
	}
	.woocommerce .woocommerce-breadcrumb {
	color: ${typography_secondary_text};
	}
	.woocommerce .woocommerce-breadcrumb a {
	color: ${typography_secondary_text};
	}
	.woocommerce .woocommerce-breadcrumb a:hover {
	color: ${typography_accent};
	}
	.woocommerce .woocommerce-pagination ul li a,.woocommerce .woocommerce-pagination ul li > span {
	border: 1px solid ${typography_text};
	color: ${typography_text};
	.font( ${typography_body_font} );
	}
	.woocommerce .woocommerce-pagination ul li a:hover,.woocommerce .woocommerce-pagination ul li a.current,.woocommerce .woocommerce-pagination ul li > span:hover,.woocommerce .woocommerce-pagination ul li > span.current {
	border-color: ${typography_accent};
	color: ${typography_accent};
	}
	.woocommerce .woocommerce-breadcrumb {
	color: ${typography_secondary_text};
	}
	.woocommerce .woocommerce-breadcrumb a {
	color: ${typography_secondary_text};
	}
	.woocommerce .woocommerce-breadcrumb a:hover {
	color: ${typography_accent};
	}
	.woocommerce .woocommerce-result-count {
	color: ${typography_secondary_text};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper {
	border: 1px solid ${typography_border_dark};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper svg path {
	fill: ${typography_text};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper:hover {
	color: ${typography_heading};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper:hover svg path {
	fill: ${typography_heading};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper .ordering-dropdown {
	border: 1px solid ${typography_border_dark};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper .ordering-dropdown li {
	color: ${typography_secondary_text};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper .ordering-dropdown li:hover {
	color: ${typography_heading};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper.open-dropdown svg path {
	fill: ${typography_heading};
	}
	.woocommerce .onsale {
	background: ${typography_accent};
	}
	.woocommerce .star-rating {
	color: ${typography_accent};
	}
	.woocommerce .star-rating:before {
	color: ${typography_accent};
	}
	.woocommerce a .star-rating {
	color: ${typography_accent};
	}
	.woocommerce .products .product .woocommerce-loop-product__title:hover,.woocommerce .products .product .woocommerce-loop-category__title:hover {
	color: ${typography_text};
	}
	.woocommerce .price {
	color: ${typography_text};
	}
	.woocommerce .price ins {
	color: ${typography_accent};
	}
	.woocommerce .product .summary .woocommerce-review-link,.woocommerce .product .product-info-wrapper .woocommerce-review-link {
	color: ${typography_secondary_text};
	}
	.woocommerce .product .summary .woocommerce-review-link:hover,.woocommerce .product .product-info-wrapper .woocommerce-review-link:hover {
	color: ${typography_accent};
	}
	.woocommerce .product .summary .variations .label label,.woocommerce .product .product-info-wrapper .variations .label label {
	color: ${typography_heading};
	}
	.woocommerce .product .summary .variations .reset_variations,.woocommerce .product .product-info-wrapper .variations .reset_variations {
	color: ${typography_text};
	}
	.woocommerce .product .summary .variations .reset_variations:hover,.woocommerce .product .product-info-wrapper .variations .reset_variations:hover {
	color: ${typography_accent};
	}
	.woocommerce .product .summary .woocommerce-grouped-product-list td a,.woocommerce .product .product-info-wrapper .woocommerce-grouped-product-list td a {
	color: ${typography_text};
	}
	.woocommerce .product .summary .woocommerce-grouped-product-list td a:hover,.woocommerce .product .product-info-wrapper .woocommerce-grouped-product-list td a:hover {
	color: ${typography_accent};
	}
	.woocommerce .product .summary .stock,.woocommerce .product .product-info-wrapper .stock {
	color: ${typography_accent};
	}
	.woocommerce .product .summary .product_meta,.woocommerce .product .product-info-wrapper .product_meta {
	border-top: 1px solid ${typography_border};
	color: ${typography_text};
	}
	.woocommerce .product .summary .product_meta a,.woocommerce .product .product-info-wrapper .product_meta a {
	color: ${typography_heading};
	}
	.woocommerce .product .summary .product_meta a:hover,.woocommerce .product .product-info-wrapper .product_meta a:hover {
	color: ${typography_accent};
	}
	.woocommerce .product .woocommerce-tabs h2 {
	color: ${typography_text};
	}
	.woocommerce .product .woocommerce-tabs .wc-tabs {
	border-bottom: 1px solid ${typography_border};
	}
	.woocommerce .product .woocommerce-tabs .wc-tabs li {
	.font( ${typography_heading_font} );
	}
	.woocommerce .product .woocommerce-tabs .wc-tabs li a {
	color: ${typography_text};
	}
	.woocommerce .product .woocommerce-tabs .wc-tabs li a:hover {
	color: ${typography_heading};
	}
	.woocommerce .product .woocommerce-tabs .wc-tabs li.active {
	box-shadow: 0 2px 0 ${typography_accent};
	}
	.woocommerce .product .woocommerce-tabs .wc-tabs li.active a {
	color: ${typography_heading};
	}
	.woocommerce .product .shop_attributes tr th {
	color: ${typography_heading};
	}
	.woocommerce .product .woocommerce-Reviews .comment_container {
	border-bottom: 1px solid ${typography_border};
	}
	.woocommerce .product .woocommerce-Reviews .meta {
	color: ${typography_heading};
	}
	.woocommerce .product .woocommerce-Reviews .meta a {
	color: ${typography_heading};
	}
	.woocommerce .product .woocommerce-Reviews .meta a:hover {
	color: ${typography_text};
	}
	.woocommerce .product .woocommerce-Reviews .comment-date {
	color: ${typography_secondary_text};
	}
	.woocommerce .product .woocommerce-Reviews .comment-reply-title {
	color: ${typography_text};
	}
	.woocommerce .product .woocommerce-Reviews .stars a:hover {
	color: ${typography_accent};
	}
	#quick-view-container .quickview-close-icon {
	color: ${typography_heading};
	}
	#quick-view-container .quickview-close-icon:hover {
	color: ${typography_text};
	}
	.woocommerce #secondary .button,.woocommerce #secondary button {
	border: 2px solid ${typography_heading};
	color: ${typography_heading};
	}
	.woocommerce #secondary .button:hover,.woocommerce #secondary button:hover {
	background: ${typography_heading};
	}
	.woocommerce #secondary .widget_tag_cloud .tagcloud a {
	border: 1px solid ${typography_text};
	}
	.woocommerce #secondary .widget_tag_cloud .tagcloud a:hover {
	background: ${typography_text};
	}
	.widget.widget_layered_nav_filters .chosen a:before {
	color: ${typography_accent};
	}
	.widget.widget_layered_nav_filters .chosen a:hover {
	color: ${typography_heading};
	}
	.cart_list li,.product_list_widget li {
	border-bottom: 1px solid ${typography_border};
	}
	.widget_shopping_cart .total {
	border: 1px solid ${typography_border};
	}
	.widget_shopping_cart .buttons .button:first-of-type {
	border: 2px solid ${typography_heading};
	color: ${typography_heading};
	}
	.widget_shopping_cart .buttons .button:first-of-type:hover {
	background: ${typography_heading};
	}
	.widget_product_categories .product-categories li,.woocommerce-widget-layered-nav-list li {
	color: ${typography_secondary_text};
	}
	.widget_product_categories .product-categories li a,.woocommerce-widget-layered-nav-list li a {
	color: ${typography_heading};
	}
	.widget_product_categories .product-categories li span,.woocommerce-widget-layered-nav-list li span {
	color: ${typography_secondary_text};
	}
	.widget_price_filter .ui-slider {
	background: ${typography_border_dark};
	}
	.widget_price_filter .ui-slider .ui-slider-range {
	background: ${typography_heading};
	}
	.widget_price_filter .ui-slider .ui-slider-handle {
	background: ${typography_heading};
	}
	.widget.widget_rating_filter .wc-layered-nav-rating a {
	color: ${typography_secondary_text};
	}
	.widget.widget_product_tag_cloud .tagcloud a {
	border: 1px solid ${typography_text};
	color: ${typography_text};
	}
	.widget.widget_product_tag_cloud .tagcloud a:hover {
	border-color: ${typography_accent};
	color: ${typography_accent};
	}
	.woocommerce-message,.woocommerce-error,.woocommerce-info,.woocommerce-store-notice {
	color: ${typography_text};
	}
	.woocommerce-message a:not(.button),.woocommerce-error a:not(.button),.woocommerce-info a:not(.button),.woocommerce-store-notice a:not(.button) {
	color: ${typography_heading};
	}
	.woocommerce-message a:not(.button):hover,.woocommerce-error a:not(.button):hover,.woocommerce-info a:not(.button):hover,.woocommerce-store-notice a:not(.button):hover {
	color: ${typography_accent};
	}
	.woocommerce-cart table.cart thead {
	border: 1px solid ${typography_border_dark};
	}
	.woocommerce-cart table.cart tr {
	border: 1px solid ${typography_border_dark};
	}
	.woocommerce-cart table.cart .cart_item a {
	color: ${typography_heading};
	}
	.woocommerce-cart table.cart .cart_item a:hover {
	color: ${typography_text};
	}
	.woocommerce-cart table.cart .cart_item .product-remove a {
	color: ${typography_text};
	}
	.woocommerce-cart table.cart .cart_item .product-remove a:hover {
	color: ${typography_secondary_text};
	}
	.woocommerce-cart table.cart td.actions .coupon label {
	color: ${typography_heading};
	}
	.woocommerce-cart .cart_totals h2 {
	.font( ${typography_body_font} );
	}
	.woocommerce-cart .cart_totals table tr {
	border-bottom: 1px solid ${typography_border_dark};
	}
	.woocommerce-cart .cart_totals table th {
	color: ${typography_heading};
	}
	.woocommerce-cart .cart_totals table td {
	color: ${typography_text};
	}
	.site-header .shopping-cart-link {
	.font( ${typography_heading_font} );
	}
	.site-header .shopping-cart-link .shopping-cart-count {
	background: ${typography_accent};
	}
	.site-header .shopping-cart-link:hover svg {
	fill: ${typography_text};
	}
	.site-header .shopping-cart-link:hover .shopping-cart-text {
	color: ${typography_text};
	}
	.site-header .shopping-cart-dropdown {
	border: 1px solid ${typography_border_dark};
	}
	.site-header .shopping-cart-dropdown * {
	.font( ${typography_body_font} );
	}
	.site-header .shopping-cart-dropdown .widget li a {
	color: ${typography_text};
	}
	.site-header .shopping-cart-dropdown .widget li a:hover {
	color: ${typography_accent};
	}
	#mobile-navigation .shopping-cart-text {
	color: ${typography_heading};
	}
	#mobile-navigation .shopping-cart-link:hover .shopping-cart-text {
	color: ${typography_text};
	}
	.woocommerce .woocommerce-checkout-review-order {
	border: 1px solid ${typography_border_dark};
	}
	.woocommerce table.woocommerce-checkout-review-order-table tr {
	border-bottom: 1px solid ${typography_border_dark};
	}
	.woocommerce table.woocommerce-checkout-review-order-table tfoot {
	color: ${typography_heading};
	}
	.woocommerce table.woocommerce-checkout-review-order-table tfoot tr {
	border-bottom: 1px solid ${typography_border_dark};
	}
	.woocommerce #payment .payment_methods li {
	border-bottom: 1px solid ${typography_border_dark};
	}
	.woocommerce #payment .wc-terms-and-conditions {
	border-bottom: 1px solid ${typography_border_dark};
	}
	.woocommerce-order-received table {
	border: 1px solid ${typography_border_dark};
	}
	.woocommerce-order-received table thead th {
	border: 1px solid ${typography_border_dark};
	}
	.woocommerce-order-received table tr {
	border-bottom: 1px solid ${typography_border_dark};
	}
	.woocommerce-order-received table th a,.woocommerce-order-received table td a {
	color: ${typography_text};
	}
	.woocommerce-order-received table th a:hover,.woocommerce-order-received table td a:hover {
	color: ${typography_accent};
	}
	.woocommerce-order-received table tfoot th {
	color: ${typography_heading};
	}
	.woocommerce-order-received .woocommerce-thankyou-order-details {
	border: 1px solid ${typography_border_dark};
	}
	.woocommerce-order-received .woocommerce-thankyou-order-details li {
	border-bottom: 1px solid ${typography_border_dark};
	color: ${typography_heading};
	}
	.woocommerce-order-received .woocommerce-thankyou-order-details li strong {
	color: ${typography_text};
	}
	.woocommerce-account .woocommerce-MyAccount-navigation {
	border: 1px solid ${typography_border_dark};
	}
	.woocommerce-account .woocommerce-MyAccount-navigation ul li a {
	color: ${typography_text};
	}
	.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover {
	color: ${typography_accent};
	}';

	return $css;
}
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_corp_wc_settings_custom_css' );

/**
 * Add CSS for mobile menu breakpoint.
 */
function siteorigin_corp_menu_breakpoint_css( $css, $settings ) {
	// Ensure mobile menu is enabled before outputting any CSS.
	$navigation_mobile_menu = siteorigin_setting( 'navigation_mobile_menu' );
	if( empty( $navigation_mobile_menu ) ){
		return;	
	}
	
	if ( is_rtl() ) {
		$css .= '@media (max-width: ' . intval( siteorigin_setting( 'navigation_mobile_menu_collapse' ) ) . 'px) {
			#masthead .search-toggle {
				margin-right: 0;
				margin-left: 20px;
			}

			#masthead #mobile-menu-button {
				display: inline-block;
			}

			#masthead .main-navigation ul {
				display: none;
			}

			#masthead .main-navigation .search-icon {
				display: none;
			}
		}
		@media (min-width: ' . ( 1 + intval( siteorigin_setting( 'navigation_mobile_menu_collapse' ) ) ) . 'px) {
			#masthead #mobile-navigation {
				display: none !important;
			}
		}';		
	} else {
		$css .= '@media (max-width: ' . intval( siteorigin_setting( 'navigation_mobile_menu_collapse' ) ) . 'px) {
			#masthead .search-toggle {
				margin-right: 20px;
			}

			#masthead #mobile-menu-button {
				display: inline-block;
			}

			#masthead .main-navigation ul {
				display: none;
			}

			#masthead .main-navigation .search-icon {
				display: none;
			}
		}
		@media (min-width: ' . ( 1 + intval( siteorigin_setting( 'navigation_mobile_menu_collapse' ) ) ) . 'px) {
			#masthead #mobile-navigation {
				display: none !important;
			}
		}';		
	}

	return $css;
}
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_corp_menu_breakpoint_css', 10, 2 );

/**
 * Add default settings.
 *
 * @param $defaults
 *
 * @return mixed
 */
function siteorigin_corp_settings_defaults( $defaults ) {

	$defaults['header_retina_logo']							= false;
	$defaults['header_site_description']					= false;
	$defaults['header_sticky']								= false;
	$defaults['header_scales']								= false;
	$defaults['header_background']							= '#ffffff';
	$defaults['header_border']								= '#e6e6e6';
	$defaults['header_padding']								= '25px';
	$defaults['header_margin']								= '60px';

	$defaults['navigation_header_menu']						= true;
	$defaults['navigation_mobile_menu']						= true;
	$defaults['navigation_mobile_menu_collapse']			= 768;
	$defaults['navigation_menu_search']						= true;
	$defaults['navigation_post']							= true;
	$defaults['navigation_scroll_to_top']					= true;
	$defaults['navigation_link']							= '#2d2d2d';
	$defaults['navigation_link_accent']						= '#f14e4e';
	$defaults['navigation_drop_down_link']					= '#b2b2b2';
	$defaults['navigation_drop_down_link_hover']			= '#ffffff';
	$defaults['navigation_drop_down_divider']				= '#353538';
	$defaults['navigation_drop_down_background']			= '#262627';
	$defaults['navigation_search_overlay_text']				= '#b2b2b2';
	$defaults['navigation_search_overlay_background']		= '#090d14';

	$defaults['blog_archive_featured_image']				= true;
	$defaults['blog_archive_content']         				= 'excerpt';
	$defaults['blog_excerpt_length']          				= 55;
	$defaults['blog_post_excerpt_read_more_link']			= false;
	$defaults['blog_post_featured_image']					= true;
	$defaults['blog_post_date']								= true;
	$defaults['blog_post_categories']						= true;
	$defaults['blog_post_comment_count']					= true;
	$defaults['blog_post_tags']								= true;
	$defaults['blog_post_author_box']						= true;
	$defaults['blog_related_posts']							= true;

	$defaults['typography_site_title']						='#2d2d2d';
	$defaults['typography_site_tagline']					='#929292';
	$defaults['typography_accent']							='#f14e4e';
	$defaults['typography_heading']							='#2d2d2d';
	$defaults['typography_text']							='#626262';
	$defaults['typography_secondary_text']					='#929292';
	$defaults['typography_border']							='#e6e6e6';
	$defaults['typography_border_dark']						='#d6d6d6';

	$defaults['sidebar_position']							= 'right';
	$defaults['sidebar_width']								= '34%%';

	$defaults['footer_text']								= esc_html__( '{year} &copy; {sitename}.', 'siteorigin-corp' );
	$defaults['footer_widget_title']						= '#ffffff';
	$defaults['footer_widget_text']							= '#b4b5b8';
	$defaults['footer_widget_link']							= '#ffffff';
	$defaults['footer_widget_link_hover']					= '#b4b5b8';
	$defaults['footer_background']							= '#363a43';
	$defaults['footer_bottom_bar_text']						= '#b4b5b8';
	$defaults['footer_bottom_bar_link']						= '#b4b5b8';
	$defaults['footer_bottom_bar_link_hover']				= '#ffffff';
	$defaults['footer_bottom_bar_background']				= '#2f333b';
	$defaults['footer_padding']								= '95px';
	$defaults['footer_margin']								= '80px';

	$defaults['woocommerce_shop_sidebar']       			= 'right';
	$defaults['woocommerce_product_gallery']    			= 'slider-lightbox';

	return $defaults;
}
add_filter( 'siteorigin_settings_defaults', 'siteorigin_corp_settings_defaults' );

/**
 * Setup Page Settings.
 */
function siteorigin_corp_page_settings( $settings, $type, $id ) {

	$settings['layout'] = array(
		'type'    => 'select',
		'label'   => esc_html__( 'Page Layout', 'siteorigin-corp' ),
		'options' => array(
			'default'            	=> esc_html__( 'Default', 'siteorigin-corp' ),
			'no-sidebar'         	=> esc_html__( 'No Sidebar', 'siteorigin-corp' ),
			'full-width-no-sidebar' => esc_html__( 'Full Width, No Sidebar', 'siteorigin-corp' ),
		),
	);

	$settings['overlap'] = array(
		'type'    => 'select',
		'label'   => esc_html__( 'Header Overlap', 'siteorigin-corp' ),
		'options' => array(
			'disabled'	=> esc_html__( 'Disabled', 'siteorigin-corp' ),
			'enabled'	=> esc_html__( 'Enabled', 'siteorigin-corp' ),
			'light'		=> esc_html__( 'Enabled - Light Text', 'siteorigin-corp' ),
			'dark'		=> esc_html__( 'Enabled - Dark Text', 'siteorigin-corp' ),
		),
	);

	$settings['header_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header Bottom Margin', 'siteorigin-corp' ),
		'checkbox_label' => esc_html__( 'Enable', 'siteorigin-corp' ),
		'description'    => esc_html__( 'Display the margin below the header.', 'siteorigin-corp' )
	);

	$settings['page_title'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Page Title', 'siteorigin-corp' ),
		'checkbox_label' => esc_html__( 'Enable', 'siteorigin-corp' ),
		'description'    => esc_html__( 'Display the page title.', 'siteorigin-corp' )
	);

	$settings['footer_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Top Margin', 'siteorigin-corp' ),
		'checkbox_label' => esc_html__( 'Enable', 'siteorigin-corp' ),
		'description'    => esc_html__( 'Display the margin above the footer.', 'siteorigin-corp' )
	);

	$settings['footer_widgets'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Widgets', 'siteorigin-corp' ),
		'checkbox_label' => esc_html__( 'Enable', 'siteorigin-corp' ),
		'description'    => esc_html__( 'Display the footer widgets.', 'siteorigin-corp' )
	);

	return $settings;
}
add_action( 'siteorigin_page_settings', 'siteorigin_corp_page_settings', 10, 3 );

/**
 * Add the default Page Settings.
 */
function siteorigin_corp_setup_page_setting_defaults( $defaults, $type, $id ) {
	$defaults['layout']					= 'default';
	$defaults['overlap']				= 'disabled';
	$defaults['header_margin']			= true;
	$defaults['page_title']				= true;
	$defaults['footer_margin']			= true;
	$defaults['footer_widgets']			= true;

	return $defaults;
}
add_filter( 'siteorigin_page_settings_defaults', 'siteorigin_corp_setup_page_setting_defaults', 10, 3 );

/**
 * Add the about page sections.
 */
function siteorigin_corp_about_page_sections( $about ) {
	$about['documentation_url'] = 'https://siteorigin.com/corp-documentation/';

	$about['description'] = esc_html__( "A modern business theme from SiteOrigin. Corp is versatile and quick to customize. Fast loading and fully loaded with all the modern theme features you've come to expect and enjoy.", 'siteorigin-corp' );

	$about['review'] = true;

	$about['no_video'] = true;

	$about['video_url'] = 'https://siteorigin.com/theme/corp/';

	$about['sections'] = array(
		'free',
		'woocommerce',
		'documentation',
		'page-builder',
		'github',
	);

	return $about;
}
add_filter( 'siteorigin_about_page', 'siteorigin_corp_about_page_sections' );
