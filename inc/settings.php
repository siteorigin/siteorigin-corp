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
					'label' => esc_html__( 'Site Description', 'siteorigin-corp' ),
					'description' => esc_html__( 'Show your site description below your site title or logo.', 'siteorigin-corp' )
				),
			)
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

/**
 * Add default settings.
 *
 * @param $defaults
 *
 * @return mixed
 */
function siteorigin_corp_settings_defaults( $defaults ) {

	// Header.
	$defaults['header_retina_logo']			= false;
	$defaults['header_site_description']	= false;
	
	// Footer.
	$defaults['footer_text']	= esc_html__( '{year} &copy; {sitename}.', 'siteorigin-corp' );

	return $defaults;
}
add_filter( 'siteorigin_settings_defaults', 'siteorigin_corp_settings_defaults' );
