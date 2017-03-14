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
		'premium_url' => 'https://siteorigin.com/premium/?target=theme_corp',

		// For the controls.
		'variant' => esc_html__( 'Variant', 'siteorigin-corp' ),
		'subset' => esc_html__( 'Subset', 'siteorigin-corp' ),

		// For the settings metabox.
		'meta_box' => esc_html__( 'Page settings', 'siteorigin-corp' ),
	), $loc);
}
add_filter( 'siteorigin_settings_localization', 'siteorigin_unwind_settings_localize' );

/**
 * Initialize the settings.
 */
function siteorigin_corp_settings_init() {

	SiteOrigin_Settings::single()->configure( apply_filters( 'siteorigin_unwind_settings_array', array(

		'branding' => array(
			'title' => esc_html__( 'Branding', 'siteorigin-corp' ),
			'fields' => array(
				'logo' => array(
					'type' => 'media',
					'label' => esc_html__( 'Logo', 'siteorigin-corp' ),
					'description' => esc_html__( 'Logo displayed in your header.', 'siteorigin-corp' )
				),
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
				'attribution' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Display SiteOrigin Attribution', 'siteorigin-corp' ),
					'description' => esc_html__( 'Choose if the link to SiteOrigin is displayed in your footer.', 'siteorigin-corp' ),
					'teaser' => true,
				),
				'accent' => array(
					'type' => 'color',
					'label' => esc_html__( 'Accent Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'The color used for links and various other accents.', 'siteorigin-corp' ),
					'live' => true,
				),
				'accent_dark' => array(
					'type' => 'color',
					'label' => esc_html__( 'Dark Accent Color', 'siteorigin-corp' ),
					'description' => esc_html__( 'The color used for link hovers and various other accents.', 'siteorigin-corp' ),
					'live' => true,
				),
			)
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

				'constrained' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Constrain', 'siteorigin-corp' ),
					'description' => esc_html__( "Constrain the footer width.", 'siteorigin-corp' ),
				),

				'top_padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Top Padding', 'siteorigin-corp' ),
					'live'	=> true,
				),

				'side_padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Side Padding', 'siteorigin-corp' ),
					'description' => esc_html__( "Applies if the footer width is not constrained.", 'siteorigin-corp' ),
					'live'	=> true,
				),

				'top_margin' => array(
					'type' => 'measurement',
					'label' => esc_html__( 'Top Margin', 'siteorigin-corp' ),
					'live' => true,
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

	// Branding defaults.
	$defaults['branding_logo']             = false;
	$defaults['branding_site_description'] = false;
	$defaults['branding_attribution']      = true;
	$defaults['branding_accent']           = '#24c48a';
	$defaults['branding_accent_dark']      = '#00a76a';

	// Footer settings.
	$defaults['footer_text']         = esc_html__( '{year} &copy; {sitename}.', 'siteorigin-corp' );
	$defaults['footer_constrained']  = true;
	$defaults['footer_top_padding']  = '80px';
	$defaults['footer_side_padding'] = '40px';
	$defaults['footer_top_margin']   = '80px';

	return $defaults;
}
add_filter( 'siteorigin_settings_defaults', 'siteorigin_corp_settings_defaults' );
