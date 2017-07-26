<?php
/**
 * siteorigin-corp functions and definitions
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

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Header Menu', 'polestar' ),
		'menu-2' => esc_html__( 'Footer Menu', 'polestar' )
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'siteorigin_corp_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
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
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function siteorigin_corp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'siteorigin-corp' ),
		'id'            => 'main-sidebar',
		'description'   => esc_html__( 'Visible on posts and pages that use the Default or Full Width, With Sidebar layout.', 'siteorigin-corp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title heading-strike">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'siteorigin-corp' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'A column will be automatically assigned to each widget inserted', 'siteorigin-corp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title heading-strike">',
		'after_title'   => '</h2>',
	) );

	if ( function_exists( 'is_woocommerce' ) ) {
		register_sidebar( array(
			'name' 			=> esc_html__( 'Shop', 'siteorigin-corp' ),
			'id' 			=> 'shop-sidebar',
			'description' 	=> esc_html__( 'Displays on WooCommerce pages.', 'siteorigin-corp' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h2 class="widget-title heading-strike">',
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
	wp_enqueue_style( 'siteorigin-unwind-style', get_template_directory_uri() . '/style' . SITEORIGIN_THEME_CSS_PREFIX . '.css', array(), SITEORIGIN_THEME_JS_PREFIX );

	// FitVids.
	if ( ! class_exists( 'Jetpack' ) ) {
		wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), 1.1, true );
	}

	// Flexslider.
	wp_register_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), '2.6.3', true );
	
	if ( ( function_exists( 'is_woocommerce' ) && is_product() ) ) {
		wp_enqueue_script( 'jquery-flexslider' );
	}

	// Theme JavaScript.
	wp_enqueue_script( 'siteorigin-corp-script', get_template_directory_uri() . '/js/jquery.theme' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION, true );

	// Theme icons.
	wp_enqueue_style( 'siteorigin-corp-icons', get_template_directory_uri() . '/css/siteorigin-corp-icons' . SITEORIGIN_THEME_JS_PREFIX . '.css', array(), SITEORIGIN_THEME_JS_PREFIX );  	

	// Google Fonts.
	wp_enqueue_style( 'google-font-montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700' );	
	wp_enqueue_style( 'google-font-raleway', '//fonts.googleapis.com/css?family=Open+Sans' );	

	// Skip link focus fix.
	wp_enqueue_script( 'siteorigin-unwind-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . SITEORIGIN_THEME_JS_PREFIX . '.js', array(), SITEORIGIN_THEME_VERSION, true );

	// Comment reply.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'siteorigin_corp_scripts' );

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

/* IMPORTANT NOTICE: Please don't edit this file; any changes made here will be lost during the theme update process. 
If you need to add custom functions, use the Code Snippets plugin (https://wordpress.org/plugins/code-snippets/) or a child theme. */

