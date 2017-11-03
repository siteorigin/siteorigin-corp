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

		// For the controls.
		'variant' => esc_html__( 'Variant', 'siteorigin-corp' ),
		'subset' => esc_html__( 'Subset', 'siteorigin-corp' ),

		// For the settings metabox.
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
					'description' => esc_html__( 'A double sized logo to use on retina devices.', 'siteorigin-corp' )
				),				
				'site_description' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Tagline', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the website tagline below the logo or site title.', 'siteorigin-corp' )
				),
				'sticky' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Sticky Header', 'siteorigin-corp' ),
					'description' => esc_html__( 'Sticks the header to the top of the screen as the user scrolls down.', 'siteorigin-corp' )
				),			
				'scales' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Sticky Header Scales Logo', 'siteorigin-corp' ),
					'description' => esc_html__( 'Scales the logo down as the header becomes sticky.', 'siteorigin-corp' )
				),						
			),
		),

		'navigation' => array(
			'title' => esc_html__( 'Navigation', 'siteorigin-corp' ),
			'fields' => array(
				'header_menu' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Header Menu', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the main menu in the header.', 'siteorigin-corp' )
				),
				'mobile_menu' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Mobile Menu', 'siteorigin-corp' ),
					'description' => esc_html__( 'Use a mobile menu for small screen devices. Header Menu setting must be enabled.', 'siteorigin-corp' )
				),	
				'mobile_menu_collapse' => array(
					'label' => esc_html__( 'Mobile Menu Collapse', 'siteorigin-corp' ),
					'type' => 'number',
					'description' => esc_html__( 'The pixel resolution when the primary menu collapses into the mobile menu.', 'siteorigin-corp' )
				),							
				'menu_search' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Menu Search', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display a search icon in the main menu.', 'siteorigin-corp' )
				),
				'post' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Navigation', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the next/previous post navigation.', 'siteorigin-corp' )
				),
				'scroll_to_top' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Scroll to Top', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the scroll to top button.', 'siteorigin-corp' )
				),											
			),
		),		

		'blog' => array(
			'title' => esc_html__( 'Blog', 'siteorigin-corp' ),
			'fields' => array(
				'archive_featured_image' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Archive Featured Image', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the featured image on the archive and single post pages.', 'siteorigin-corp' )
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
					'description' => esc_html__( 'Display the post date on archive and single post pages.', 'siteorigin-corp' )
				),		
				'post_categories' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Categories', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the post categories on archive and single post pages.', 'siteorigin-corp' )
				),							
				'post_comment_count' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Comment Count', 'siteorigin-corp' ),
					'description' => esc_html__( 'Display the post comment count on archive and single post pages.', 'siteorigin-corp' )
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
					'description' => esc_html__( 'Display related posts on the single post page.', 'siteorigin-corp' )
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
					'description' => esc_html__( 'Choose the sidebar position.', 'siteorigin-corp' ),
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
					'description' => esc_html__( "{sitename} and {year} are your site's name and current year.", 'siteorigin-corp' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'attribution' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Hide SiteOrigin Attribution', 'siteorigin-corp' ),
					'description' => esc_html__( 'Hide the SiteOrigin link in your footer.', 'siteorigin-corp' ),
					'teaser' => true,
				),
			),
		),
	) ) );
}
add_action( 'siteorigin_settings_init', 'siteorigin_corp_settings_init' );

/**
 * Add custom CSS for the theme settings
 *
 * @param $css
 *
 * @return string
 */
function siteorigin_corp_settings_custom_css( $css ) {
	// Custom CSS.
	$css .= '/* style */
	.widget-area {
	width: ${sidebar_width};
	}';
	return $css;
}
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_corp_settings_custom_css' );

if ( ! function_exists( 'siteorigin_corp_menu_breakpoint_css' ) ) :
/**
 * Add CSS for mobile menu breakpoint.
 */
function siteorigin_corp_menu_breakpoint_css( $css, $settings ) {
	$breakpoint = isset( $settings[ 'theme_settings_navigation_mobile_menu_collapse' ] ) ? $settings[ 'theme_settings_navigation_mobile_menu_collapse' ] : 768;

	$css .= '@media (max-width: ' . intval( $breakpoint ) . 'px) {
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
	@media (min-width: ' . ( 1 + intval( $breakpoint ) ) . 'px) {
		#masthead #mobile-navigation {
			display: none !important;
		}
	}';
	return $css;
}
endif;
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_corp_menu_breakpoint_css', 10, 2 );

if ( ! function_exists( 'siteorigin_corp_sidebar_width' ) ) :
/**
 * Add CSS for the sidebar width setting.
 */
function siteorigin_corp_sidebar_width( $css, $settings ) {
	if ( ! isset( $settings['theme_settings_sidebar_width'] ) ) {
		return $css;
	}

	$sidebar_width = str_replace( '%', '', $settings['theme_settings_sidebar_width'] );
	$content_width = 100 - $sidebar_width;

	$css .= '.sidebar .content-area {
		width: ' . intval( $content_width ) .'%;	
	}';
	return $css;
}
endif;
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_corp_sidebar_width', 10, 2 );

/**
 * Add default settings.
 *
 * @param $defaults
 *
 * @return mixed
 */
function siteorigin_corp_settings_defaults( $defaults ) {

	// Header.
	$defaults['header_retina_logo']						= false;
	$defaults['header_site_description']				= false;
	$defaults['header_sticky']							= false;
	$defaults['header_scales']							= false;
	
	// Navigation
	$defaults['navigation_header_menu']					= true;
	$defaults['navigation_mobile_menu']					= true;
	$defaults['navigation_mobile_menu_collapse']		= 768;
	$defaults['navigation_menu_search']					= true;
	$defaults['navigation_post']						= true;
	$defaults['navigation_scroll_to_top']				= true;

	// Blog.
	$defaults['blog_archive_featured_image']			= true;
	$defaults['blog_archive_content']         			= 'excerpt';
	$defaults['blog_excerpt_length']          			= 55;	
	$defaults['blog_post_excerpt_read_more_link']		= false;
	$defaults['blog_post_featured_image']				= true;
	$defaults['blog_post_date']							= true;
	$defaults['blog_post_categories']					= true;
	$defaults['blog_post_comment_count']				= true;
	$defaults['blog_post_tags']							= true;
	$defaults['blog_post_author_box']					= true;
	$defaults['blog_related_posts']						= true;

	// Sidebar.
	$defaults['sidebar_position']						= 'right';
	$defaults['sidebar_width']							= '34%%';

	// Footer.
	$defaults['footer_text']							= esc_html__( '{year} &copy; {sitename}.', 'siteorigin-corp' );

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
	$defaults['layout']                 = 'default';
	$defaults['header_margin']        	= true;
	$defaults['page_title']             = true;
	$defaults['footer_margin']          = true;
	$defaults['footer_widgets'] 		= true;

	return $defaults;
}
add_filter( 'siteorigin_page_settings_defaults', 'siteorigin_corp_setup_page_setting_defaults', 10, 3 );
