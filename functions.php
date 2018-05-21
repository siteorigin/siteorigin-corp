<?php
/**
 * Siteorigin Corp functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package siteorigin-corp
 * @license GPL 2.0
 */

define( 'SITEORIGIN_THEME_VERSION', 'dev' );
define( 'SITEORIGIN_THEME_JS_PREFIX', '' );
define( 'SITEORIGIN_THEME_CSS_PREFIX', '' );

if ( ! function_exists( 'siteorigin_corp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function siteorigin_corp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on siteorigin-corp, use a find and replace
	 * to change 'siteorigin-corp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'siteorigin-corp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Custom image sizes.
	add_image_size( 'siteorigin-corp-247x164-crop', 247, 163, true );
	add_image_size( 'siteorigin-corp-354x234-crop', 354, 234, true );
	add_image_size( 'siteorigin-corp-551x364-crop', 551, 364, true );

	/*
	 * Enable support for the custom logo.
	 */
	add_theme_support( 'custom-logo' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Header Menu', 'siteorigin-corp' ),
		'menu-2' => esc_html__( 'Footer Menu', 'siteorigin-corp' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
		'image',
		'video',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'siteorigin_corp_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add theme support for SiteOrigin Page Template Settings.
	add_theme_support( 'siteorigin-template-settings' );
}
endif;
add_action( 'after_setup_theme', 'siteorigin_corp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function siteorigin_corp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'siteorigin_corp_content_width', 1140 );
}
add_action( 'after_setup_theme', 'siteorigin_corp_content_width', 0 );

/**
 * Add the viewport tag.
 */
function siteorigin_corp_viewport_tag() { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php }
add_action( 'wp_head', 'siteorigin_corp_viewport_tag' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function siteorigin_corp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'siteorigin-corp' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Visible on posts and pages that use the Default or Full Width, With Sidebar layout.', 'siteorigin-corp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'siteorigin-corp' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'A column will be automatically assigned to each widget inserted', 'siteorigin-corp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if ( function_exists( 'is_woocommerce' ) ) {
		register_sidebar( array(
			'name' 			=> esc_html__( 'Shop', 'siteorigin-corp' ),
			'id' 			=> 'shop-sidebar',
			'description' 	=> esc_html__( 'Displays on WooCommerce pages.', 'siteorigin-corp' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h2 class="widget-title">',
			'after_title' 	=> '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'siteorigin_corp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function siteorigin_corp_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( 'siteorigin-corp-style', get_template_directory_uri() . '/style' . SITEORIGIN_THEME_CSS_PREFIX . '.css', array(), SITEORIGIN_THEME_VERSION );

	// FitVids.
	wp_register_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), '1.1', true );

	if ( ! class_exists( 'Jetpack' ) ) {
		wp_enqueue_script( 'jquery-fitvids' );
	}

	// Flexslider.
	wp_register_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), '2.6.3', true );

	if ( is_home() && siteorigin_corp_has_featured_posts() ) {
		wp_enqueue_script( 'jquery-flexslider' );
	}

	// Theme JavaScript.
	wp_enqueue_script( 'siteorigin-corp-script', get_template_directory_uri() . '/js/jquery.theme' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION, true );

	// Mobile menu collapse localisation.
	$menu_params = array(
		'collapse' => siteorigin_setting( 'navigation_mobile_menu_collapse' )
	);
	wp_localize_script( 'siteorigin-corp-script', 'siteorigin_corp_resp_menu_params', $menu_params );

	// Theme icons.
	wp_enqueue_style( 'siteorigin-corp-icons', get_template_directory_uri() . '/css/siteorigin-corp-icons' . SITEORIGIN_THEME_JS_PREFIX . '.css', array(), SITEORIGIN_THEME_JS_PREFIX );

	// Skip link focus fix.
	wp_enqueue_script( 'siteorigin-corp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . SITEORIGIN_THEME_JS_PREFIX . '.js', array(), SITEORIGIN_THEME_VERSION, true );

	// Comment reply.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'siteorigin_corp_scripts' );

/**
 * Enqueue Flexslider.
 */
function siteorigin_corp_enqueue_flexslider() {
	wp_enqueue_script( 'jquery-flexslider' );
}

if ( ! function_exists( 'siteorigin_corp_premium_setup' ) ) :
/**
 * Add support for SiteOrigin Premium theme addons.
 */
function siteorigin_corp_premium_setup() {

	// Ajax Comments addon.
	add_theme_support( 'siteorigin-premium-ajax-comments', array(
		'enabled' => siteorigin_setting( 'blog_ajax_comments' ),
		'siteorigin_setting' => 'blog_ajax_comments'
	) );

	// No Attribution addon.
	add_theme_support( 'siteorigin-premium-no-attribution', array(
		'filter'  => 'siteorigin_corp_footer_credits',
		'enabled' => ! siteorigin_setting( 'footer_attribution' ),
		'siteorigin_setting' => '!footer_attribution'
	) );
}
endif;
add_action( 'after_setup_theme', 'siteorigin_corp_premium_setup' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Jetpack compatibility file.
 */
if ( class_exists( 'Jetpack' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * SiteOrigin Settings framework.
 */
require get_template_directory() . '/inc/settings/settings.php';

/**
 * Theme settings.
 */
require get_template_directory() . '/inc/settings.php';

/**
 * Page Builder by SiteOrigin compatibility file.
 */
require get_template_directory() . '/inc/siteorigin-panels.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility.
 */
if ( function_exists( 'is_woocommerce' ) ) {
	require get_template_directory() . '/woocommerce/functions.php';
}

/* IMPORTANT NOTICE: Please don't edit this file; any changes made here will be lost during the theme update process.
If you need to add custom functions, use the Code Snippets plugin (https://wordpress.org/plugins/code-snippets/) or a child theme. */
