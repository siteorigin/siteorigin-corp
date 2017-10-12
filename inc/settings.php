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
	), $loc );
}
add_filter( 'siteorigin_settings_localization', 'siteorigin_corp_settings_localize' );

/**
 * Initialize the settings.
 */
function siteorigin_corp_settings_init() {

	SiteOrigin_Settings::single()->configure( apply_filters( 'siteorigin_corp_settings_array', array(

		// Header.
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
			)
		),

		// Navigation.
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

		// Footer.
		'footer' => array(
			'title' => esc_html__( 'Footer', 'siteorigin-corp' ),
			'fields' => array(

				'text' => array(
					'type' => 'text',
					'label' => esc_html__( 'Footer Text', 'siteorigin-corp' ),
					'description' => esc_html__( "{sitename} and {year} are your site's name and current year.", 'siteorigin-corp' ),
					'sanitize_callback' => 'wp_kses_post',
				),
			),
		),		

	) ) );
}
add_action( 'siteorigin_settings_init', 'siteorigin_corp_settings_init' );

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
	@media (min-width: ' . ( 1 + $breakpoint ) . 'px) {
		#masthead #mobile-navigation {
			display: none !important;
		}
	}';
	return $css;
}
endif;
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_corp_menu_breakpoint_css', 10, 2 );

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

	// Footer.
	$defaults['footer_text']	= esc_html__( '{year} &copy; {sitename}.', 'siteorigin-corp' );

	return $defaults;
}
add_filter( 'siteorigin_settings_defaults', 'siteorigin_corp_settings_defaults' );
