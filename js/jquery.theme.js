/**
 * File jquery.theme.js.
 *
 * Handles the primary JavaScript functions for the theme.
 */
jQuery( function( $ ) {

	// Element viewport visibility.
	$.fn.siteoriginCorpIsVisible = function() {
		var rect = this[0].getBoundingClientRect();
		return (
			rect.bottom >= 0 &&
			rect.right >= 0 &&
			rect.top <= ( window.innerHeight || document.documentElement.clientHeight ) &&
			rect.left <= ( window.innerWidth || document.documentElement.clientWidth )
		);
	};

	// Burst animation.
	var mousePos = {x: 0, y: 0};
	$( document ).mousemove( function( e ) {
		mousePos = {
			x: e.pageX,
			y: e.pageY
		};
	} );

	$.fn.siteoriginCorpBurstAnimation = function( options ) {
		var settings = $.extend( {
			event: "click",
			container: "parent"
		}, options );

		return $( this ).each( function() {
			var $$ = $( this ),
				$p = settings.container === 'parent' ? $$.parent() : $$.closest( settings.container ),
				$o = $( '<div class="burst-animation-overlay"></div>' ),
				$c = $( '<div class="burst-circle"></div>' ).appendTo( $o );

			$$.on( settings.event, function() {
				$o.appendTo( $p );
				$c
					.css( {
						top: mousePos.y - $p.offset().top,
						left: mousePos.x - $p.offset().left,
						opacity: 0.1,
						scale: 1
					} )
					.transition( {
						opacity: 0,
						scale: $p.width()
					}, 500, 'ease', function() {
						$o.detach();
					} );
			} );

		} );
	};

	// Setup FitVids for entry content, video post formats, SiteOrigin panels and WooCommerce pages. Ignore Tableau.
	if ( typeof $.fn.fitVids !== 'undefined' ) {
		$( '.entry-content, .entry-content .panel, .entry-video, .woocommerce #main' ).fitVids( { ignore: '.tableauViz' } );
	}

	// FlexSlider.
	$( window ).on( 'load', function() {
		$( '.flexslider' ).each( function() {
			$( this ).flexslider( {
				animation: 'slide',
				customDirectionNav: $( this ).find( '.flex-direction-nav a' )
			} );
		} );
	} );

	// Main menu.
	// Remove the no-js body class.
	$( 'body.no-js' ).removeClass( 'no-js' );
	if ( $( 'body' ).hasClass( 'css3-animations' ) ) {

		var siteoriginCorpResetMenu = function() {
			$( '.main-navigation ul ul' ).each( function() {
				var $$ = $( this );
				var width = Math.max.apply( Math, $$.find( '> li:not(.mini_cart_item) > a' ).map( function() {
					return $( this ).width();
				} ).get() );
				$$.find( '> li > a' ).width( width );
			} );
		};
		siteoriginCorpResetMenu();
		$( window ).resize( siteoriginCorpResetMenu );

		// Add keyboard access to the menu.
		$( '.menu-item' ).children( 'a' ).focus( function() {
			$( this ).parents( 'ul, li' ).addClass( 'focus' );
		} );

		// Click event fires after focus event.
		$( '.menu-item' ).children( 'a' ).click( function() {
			$( this ).parents( 'ul, li' ).removeClass( 'focus' );
		} );

		$( '.menu-item' ).children( 'a' ).focusout( function() {
			$( this ).parents( 'ul, li' ).removeClass( 'focus' );
		} );

		// Burst animation when the user clicks on a sub link.
		$( '.main-navigation ul ul li a' ).siteoriginCorpBurstAnimation( {
			event: "click",
			container: "parent"
		} );
	}

	// Mobile Menu.
	var $mobileMenu = false;
	$( '#mobile-menu-button' ).click( function ( e ) {
		e.preventDefault();
		var $$ = $( this );
		$$.toggleClass( 'to-close' );

		if ( $mobileMenu === false ) {
			$mobileMenu = $( '<div></div>' )
				.append( $( '.main-navigation ul' ).first().clone() )
				.attr( 'id', 'mobile-navigation' )
				.appendTo( '#masthead' ).hide();

			if ( $( '.main-navigation .shopping-cart' ).length ) {
				$mobileMenu.append( $( '.main-navigation .shopping-cart .shopping-cart-link' ).clone() );
			}

			$mobileMenu.find( '#primary-menu' ).show().css( 'opacity', 1 );
			$mobileMenu.find( '.menu-item-has-children > a' ).addClass( 'has-dropdown' );
			$mobileMenu.find( '.page_item_has_children > a' ).addClass( 'has-dropdown' );
			$mobileMenu.find( '.has-dropdown' ).after( '<button class="dropdown-toggle" aria-expanded="false"><i class="icon-angle-down" aria-hidden="true"></i></button>' );
			$mobileMenu.find( '.dropdown-toggle' ).click( function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-open' ).next( '.children, .sub-menu' ).slideToggle( 'fast' );
			} );

			$mobileMenu.find( '.has-dropdown' ).click( function( e ) {
				if ( typeof $( this ).attr( 'href' ) === "undefined" || $( this ).attr( 'href' ) == "#" ) {
					e.preventDefault();
					$( this ). siblings( '.dropdown-toggle' ).trigger( 'click' );
				}
			} );

			var mmOverflow = function() {
				if ( $( '#masthead' ).hasClass( 'sticky' ) ) {
					var adminBarHeight = $( '#wpadminbar' ).css( 'position' ) === 'fixed' ? $( '#wpadminbar' ).outerHeight() : 0;
					var mhHeight = $( '#masthead' ).innerHeight();
					var mobileMenuHeight = $( window ).height() - mhHeight - adminBarHeight;
					$( '#mobile-navigation' ).css( 'max-height', mobileMenuHeight );
				}
			}
			mmOverflow();

			$( window ).resize( mmOverflow );
			$( '#mobile-navigation' ).scroll( mmOverflow );

		}

		$mobileMenu.slideToggle( 'fast' );

		$( '#mobile-navigation a' ).click( function( e ) {
			if ( typeof $( this ).hasClass( 'has-dropdown' ).attr( 'href' ) !== "undefined" || $( this ).hasClass( 'has-dropdown' ).attr( 'href' ) != "#" ) {
				if ( $mobileMenu.is(' :visible' ) ) {
					$mobileMenu.slideUp( 'fast' );
				}
			}
			$$.removeClass( 'to-close' );
		} );

	} );

	// Fullscreen search.
	$( '#search-button' ).click( function( e ) {
		e.preventDefault();
		var $$ = $( this );
		$$.toggleClass( 'close-search' );

		$( "input[type='search']" ).each( function () { $( this ).attr( 'size', $( this ).attr( 'placeholder' ).length ); } );

		var fullscreenSearch = function() {
			var vpw = $( window ).width(),
				vph = $( window ).height();
			$( '#fullscreen-search' ).css( { 'height': vph + 'px', 'width': vpw + 'px' } );
		};
		fullscreenSearch();
		$( window ).resize( fullscreenSearch );

		// Disable scrolling when fullscreen search is open.
		if ( $$.hasClass( 'close-search' ) ) {
			$( 'body' ).css( 'margin-right', ( window.innerWidth - $( 'body' ).width() ) + 'px' );
			$( 'body' ).css( 'overflow', 'hidden' );
		} else {
			$( 'body' ).css( 'overflow', '' );
			$( 'body' ).css( 'margin-right', '' );
		}

		$( '#fullscreen-search' ).slideToggle( 'fast' );

		$( '#fullscreen-search input' ).focus();

	} );

	$( '#fullscreen-search-form' ).submit( function() {
		$(this).find( 'button svg' ).hide();
		$(this).find( 'button svg:last-child' ).show();
	} );

	// Close fullscreen search with close button
	$( '#fullscreen-search #search-close-button' ).click( function(e) {
		e.preventDefault();
		$( '#search-button.close-search' ).trigger( 'click' );
	} );

	// Close fullscreen search with escape key.
	$( document ).keyup( function(e) {
		if ( e.keyCode == 27 ) { // escape key maps to keycode `27`
			$( '#search-button.close-search' ).trigger( 'click' );
		}
	} );

	// Scroll to top.
	var sttWindowScroll = function () {
		var top = window.pageYOffset || document.documentElement.scrollTop;

		if ( top > $( '#masthead' ).outerHeight() ) {
			if ( ! $( '#scroll-to-top' ).hasClass( 'show' ) ) {
				$( '#scroll-to-top' ).css( 'pointer-events', 'auto' ).addClass( 'show' );
			}
		} else {
			if ( $( '#scroll-to-top' ).hasClass( 'show' ) ) {
				$( '#scroll-to-top' ).css( 'pointer-events', 'none' ).removeClass( 'show' );
			}
		}
	};
	sttWindowScroll();
	$( window ).scroll( sttWindowScroll );
	$( '#scroll-to-top' ).click( function () {
		$( 'html, body' ).animate( { scrollTop: 0 } );
	} );

	// Sticky header.
	if ( $( '#masthead' ).hasClass( 'sticky' ) ) {
		var $mhs = false,
			pageTop = $( '#page' ).offset().top,
			$mh = $( '#masthead' ),
			$tb = $( '#topbar' ),
			$tbwc = $( '#topbar .woocommerce-store-notice[style*="display: none"]' );

		var smSetup = function() {

			if ( $( 'body' ).hasClass( 'mobile-header-ns' ) && ( $( window ).width() < siteorigin_corp_resp_menu_params.collapse ) ) return;

			if ( $mhs === false ) {
				$mhs = $( '<div class="masthead-sentinel"></div>' ).insertAfter( $mh );
				$mhs.css( 'height', $mh.outerHeight() );
			}

			if ( ! $( 'body' ).hasClass( 'no-topbar' ) && ! $tb.siteoriginCorpIsVisible() ) {
				$( 'body' ).addClass( 'topbar-out' );
			}

			if ( $tb.length && $( 'body' ).hasClass( 'topbar-out' ) && $tb.siteoriginCorpIsVisible() ) {
				$( 'body' ).removeClass( 'topbar-out' );
			}

			if ( $( 'body' ).hasClass( 'no-topbar' ) && ! $( window ).scrollTop() ) {
				$( 'body' ).addClass( 'topbar-out' );
			}

			if ( $( 'body' ).hasClass( 'no-topbar' ) || ( ! $( 'body' ).hasClass( 'no-topbar' ) &&  $( 'body' ).hasClass( 'topbar-out' ) ) || $tbwc.length ) {
				$mh.css( 'position', 'fixed' );
			} else if ( ! $( 'body' ).hasClass( 'no-topbar' ) && ! $( 'body' ).hasClass( 'topbar-out' ) ) {
				$mh.css( 'position', 'absolute' );
			}

		};
		smSetup();
		$( window ).resize( smSetup ).scroll( smSetup );

		// Sticky header shadow.
		var smShadow = function() {
			if ( $( window ).scrollTop() > 0 ) {
				$( $mh ).addClass( 'stuck' );
			} else {
				$( $mh ).removeClass( 'stuck' );
			}
		};
		smShadow();
		$( window ).scroll( smShadow );

		// Header padding to be used if logo scaling is enabled.
		var mhPadding = {
			top: parseInt( $mh.css( 'padding-top' ) ),
			bottom: parseInt( $mh.css( 'padding-bottom' ) )
		};

		// Sticky header logo scaling.
		if ( $mh.data( 'scale-logo' ) ) {
			var smResizeLogo = function () {
				var top = window.pageYOffset || document.documentElement.scrollTop;
				top -= pageTop;

				var $img = $mh.find( '.site-branding img' ),
					$branding = $mh.find( '.site-branding > *' );

				$img.removeAttr( 'style' );
				var imgWidth = $img.width(),
					imgHeight = $img.height();

				if ( top > 0 ) {
					var scale = 0.775 + ( Math.max( 0, 48 - top ) / 48 * ( 1 - 0.775 ) );

					if ( $img.length ) {

						$img.css( {
							width: imgWidth * scale,
							height: imgHeight * scale,
							'max-width' : 'none'
						} );
					} else {
						$branding.css( 'transform', 'scale(' + scale + ')' );
					}

					$mh.css( {
						'padding-top': mhPadding.top * scale,
						'padding-bottom': mhPadding.bottom * scale
					} ).addClass( 'stuck' );
				} else {
					if ( ! $img.length ) {
						$branding.css( 'transform', 'scale(1)' );
					}

					$mh.css( {
						'padding-top': mhPadding.top,
						'padding-bottom': mhPadding.bottom
					} ).removeClass( 'stuck' );
				}
			};
			smResizeLogo();
			$( window ).scroll( smResizeLogo ).resize( smResizeLogo );
		}
	}

} );
