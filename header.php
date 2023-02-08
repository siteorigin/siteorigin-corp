<?php
/**
 * The theme header.
 *
 * This is the template that displays all of the <head> section and everything up until <div class="corp-container">.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @license GPL 2.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
do_action( 'siteorigin_corp_body_top' );
?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'siteorigin-corp' ); ?></a>

	<?php if ( class_exists( 'Woocommerce' ) && is_store_notice_showing() ) { ?>
		<div id="topbar">
			<?php siteorigin_corp_woocommerce_demo_store(); ?>
		</div><!-- #topbar -->
	<?php } ?>
	<?php do_action( 'siteorigin_corp_header_before' ); ?>
	<?php
	$header_classes = '';
	if ( siteorigin_setting( 'header_layout' ) == 'centered' ) {
		$header_classes .= ' centered';
	}

	if ( siteorigin_setting( 'header_sticky' ) ) {
		$header_classes .= ' sticky';
	}

	if ( siteorigin_setting( 'navigation_mobile_menu' ) ) {
		$header_classes .= ' mobile-menu';
	} 

	?>
	<header id="masthead" class="site-header<?php echo $header_classes; ?>" <?php if ( siteorigin_setting( 'header_scales' ) ) echo 'data-scale-logo="true"'; ?> >

		<div class="corp-container">

			<div class="site-header-inner">

				<div class="site-branding">
					<?php siteorigin_corp_display_logo(); ?>
					<?php if ( siteorigin_setting( 'header_site_description' ) ) { ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php } ?>
				</div><!-- .site-branding -->

				<?php $mega_menu_active = function_exists( 'ubermenu' ) || function_exists( 'max_mega_menu_is_enabled' ) && max_mega_menu_is_enabled( 'menu-1' ); ?>

				<?php 
				$nav_classes = '';
				if ( siteorigin_setting( 'navigation_menu_link_hover_underline' ) ) {
					$nav_classes .= ' link-underline ';
				}

				if ( $mega_menu_active ) {
					$nav_classes .= ' mega-menu';
				}

				?>

				<nav id="site-navigation" class="main-navigation<?php echo $nav_classes; ?>">

					<?php
					if ( siteorigin_setting( 'navigation_header_menu' ) ) {
						wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) );
					}
					?>

					<?php
					if ( function_exists( 'is_woocommerce' ) && siteorigin_setting( 'woocommerce_mini_cart' ) && ! $mega_menu_active ) {
						siteorigin_corp_woocommerce_mini_cart();
					}
					?>

					<?php if ( siteorigin_setting( 'navigation_menu_search' ) && ! $mega_menu_active ) { ?>
						<button id="search-button" class="search-toggle" aria-label="<?php esc_attr_e( 'Open Search', 'siteorigin-corp' ); ?>">
							<span class="open"><?php siteorigin_corp_display_icon( 'search' ); ?></span>
						</button>
					<?php } ?>

					<?php if ( siteorigin_setting( 'navigation_header_menu' ) && siteorigin_setting( 'navigation_mobile_menu' ) && ! $mega_menu_active ) { ?>
						<a href="#menu" id="mobile-menu-button">
							<?php siteorigin_corp_display_icon( 'menu' ); ?>
							<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'siteorigin-corp' ); ?></span>
						</a>
					<?php } ?>

				</nav><!-- #site-navigation -->

				<?php if ( siteorigin_setting( 'navigation_menu_search' ) ) { ?>
					<div id="fullscreen-search">
						<div class="corp-container">
							<span><?php esc_html_e( 'Type and press enter to search', 'siteorigin-corp' ); ?></span>
							<form id="fullscreen-search-form" method="get" action="<?php echo esc_url( home_url() ); ?>">
								<input type="search" name="s" placeholder="" aria-label="<?php esc_attr_e( 'Search for', 'siteorigin-corp' ); ?>" value="<?php echo get_search_query(); ?>" />
								<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'siteorigin-corp' ); ?>">
									<?php siteorigin_corp_display_icon( 'search' ); ?>
								</button>
							</form>
						</div>
						<button id="search-close-button" class="search-close-button" aria-label="<?php esc_attr_e( 'Close search', 'siteorigin-corp' ); ?>">
							<span class="close"><?php siteorigin_corp_display_icon( 'close' ); ?></span>
						</button>
					</div><!-- #header-search -->
				<?php } ?>

			</div><!-- .site-header-inner -->

		</div><!-- .corp-container -->

	</header><!-- #masthead -->

	<?php do_action( 'siteorigin_corp_content_before' ); ?>

	<div id="content" class="site-content">

		<div class="corp-container">

			<?php do_action( 'siteorigin_corp_content_top' ); ?>
