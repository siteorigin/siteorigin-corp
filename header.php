<?php
/**
 * The theme header.
 *
 * This is the template that displays all of the <head> section and everything up until <div class="corp-container">.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package siteorigin-corp
 * @license GPL 2.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'siteorigin-corp' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="corp-container">

			<div class="site-header-inner">

				<div class="site-branding">
					<?php siteorigin_corp_display_logo(); ?>
					<?php if ( siteorigin_setting( 'header_site_description' ) ) : ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php endif ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" role="navigation">

					<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>

	                <button id="search-button" class="search-toggle">
	                    <span class="open"><?php siteorigin_corp_display_icon( 'search' ); ?></span>
                	</button>

					<a href="#menu" id="mobile-menu-button">
						<?php siteorigin_corp_display_icon( 'menu' ); ?>
						<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'siteorigin-corp' ); ?></span>
					</a>

				</nav><!-- #site-navigation -->

				<div id="fullscreen-search">
					<div class="corp-container">
						<h3><?php esc_html_e( 'Type and press enter to search', 'siteorigin-corp' ); ?></h3>
						<form id="fullscreen-search-form" method="get" action="<?php echo esc_url( site_url() ) ?>">
							<input type="search" name="s" placeholder="" value="<?php echo get_search_query() ?>" />
							<button type="submit">
								<label class="screen-reader-text"><?php esc_html_e( 'Search', 'siteorigin-corp' ); ?></label>
								<?php siteorigin_corp_display_icon( 'search' ); ?>
							</button>
						</form>
					</div>
					<button id="search-close-button" class="search-close-button">
		            	<span class="close"><?php siteorigin_corp_display_icon( 'close' ); ?></span>
	                </button>					
				</div><!-- #header-search -->

			</div><!-- .site-header-inner -->

		</div><!-- .corp-container -->

	</header><!-- #masthead -->

	<?php do_action( 'siteorigin_corp_content_before' ); ?>

	<div id="content" class="site-content">

		<div class="corp-container">

			<?php do_action( 'siteorigin_corp_content_top' ); ?>
