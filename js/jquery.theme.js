/**
 * File jquery.theme.js.
 *
 * Handles the primary JavaScript functions for the theme.
 */

/* globals jQuery, siteoriginCorp */

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

	// Setup FitVids for entry content, video post formats, SiteOrigin panels and WooCommerce pages. Ignore Tableau.
	if ( typeof $.fn.fitVids !== 'undefined' ) {
		$( '.entry-content, .entry-content .panel, .entry-video, .woocommerce #main' ).fitVids( { ignore: '.tableauViz' } );
	}

	// FlexSlider.
	$( document ).ready( function() {
		$( '.flexslider' ).each( function() {
			$( this ).flexslider( {
				animation: 'slide',
				customDirectionNav: $( this ).find( '.flex-direction-nav a' ),
				start: function() {
					$( '.flexslider .slides img' ).show();
				}
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
	}

	// Main menu current menu item indication.
	jQuery( document ).ready( function( $ ) {
		if ( window.location.hash ) {
			return;
		} else {
			$( '#site-navigation a[href="'+ window.location.href +'"]' ).parent( 'li' ).addClass( 'current-menu-item' );
		}
		$( window ).scroll( function() {
			if ( $( '#site-navigation ul li' ).hasClass( 'current' ) ) {
				$( '#site-navigation li' ).removeClass( 'current-menu-item' );
			}
		} );
	} );

	// Smooth scroll from internal page anchors.
	var adminBarHeight = $( '#wpadminbar' ).outerHeight(),
		isAdminBar = $( 'body' ).hasClass( 'admin-bar' ),
		isStickyHeader = $( 'header' ).hasClass( 'sticky' ),
		headerHeight;

	// Header height. 1px to account for header shadow.
	if ( isStickyHeader && isAdminBar && jQuery( window ).width() > 600 ) { // From 600px the admin bar isn't sticky so we shouldn't take its height into account.
		headerHeight = adminBarHeight + $( 'header' ).outerHeight() - 1;
	} else if ( isStickyHeader ) {
		headerHeight = $( 'header' ).outerHeight() - 1;
	} else {
		headerHeight = 0;
	}

	$.fn.siteoriginCorpSmoothScroll = function() {

		if ( $( 'body' ).hasClass( 'disable-smooth-scroll' ) ) {
			return;
		}

		$( this ).click( function( e ) {

			var hash    = this.hash;
			var idName  = hash.substring( 1 ); // Get ID name.
			var alink   = this;                // This button pressed.

			// Check if there is a section that had same id as the button pressed.
			if ( jQuery( '.panel-grid [id*=' + idName + ']' ).length > 0 ) {
				jQuery( '#site-navigation .current' ).removeClass('current');
				jQuery( alink ).parent( 'li' ).addClass( 'current' );
			} else {
				jQuery( '#site-navigation .current' ).removeClass( 'current' );
			}
			if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
				var target = jQuery( this.hash );
				target = target.length ? target : jQuery( '[name=' + this.hash.slice( 1 ) +']' );
				if ( target.length ) {
					jQuery( 'html, body' ).animate( {
						scrollTop: target.offset().top - headerHeight
					}, 1200 );
					return false;
				}
			}
		} );
	};

	jQuery( window ).load( function() {
		$( '#site-navigation a[href*="#"]:not([href="#"]), .comments-link a[href*="#"]:not([href="#"]), .corp-scroll[href*="#"]:not([href="#"])' ).siteoriginCorpSmoothScroll();
	} );

	// Adjust for sticky header when linking from external anchors.
	jQuery( window ).load( function() {

		if ( location.pathname.replace( /^\//,'' ) == window.location.pathname.replace( /^\//,'' ) && location.hostname == window.location.hostname ) {
			var target = jQuery( window.location.hash );
			if ( target.length ) {
				jQuery( 'html, body' ).animate( {
					scrollTop: target.offset().top - headerHeight
				}, 0 );
				return false;
			}
		}
	} );

	// Indicate which section of the page we're viewing with selected menu classes.
	function siteoriginCorpSelected() {

		// Cursor position.
		var scrollTop = jQuery( window ).scrollTop();

		// Used for checking if the cursor is in one section or not.
		var isInOneSection = 'no';

		// For all sections check if the cursor is inside a section.
		jQuery( '.panel-row-style' ).each( function() {

			// Section ID.
			var thisID = '#' + jQuery( this ).attr( 'id' );

			// Distance between top and our section. Minus 1px to compensate for an extra pixel produced when a Page Builder row bottom margin is set to 0.
			var offset = jQuery( this ).offset().top - 1;

			// Section height.
			var thisHeight = jQuery( this ).outerHeight();

			// Where the section begins.
			var thisBegin = offset - headerHeight;

			// Where the section ends.
			var thisEnd = offset + thisHeight - headerHeight;

			// If position of the cursor is inside of the this section.
			if ( scrollTop >= thisBegin && scrollTop <= thisEnd ) {
				isInOneSection = 'yes';
				jQuery( '#site-navigation .current' ).removeClass( 'current' );
				// Find the menu button with the same ID section.
				jQuery( '#site-navigation a[href$="' + thisID + '"]' ).parent( 'li' ).addClass( 'current' ); // Find the menu button with the same ID section.
				return false;
			}
			if ( isInOneSection === 'no' ) {
				jQuery( '#site-navigation .current' ).removeClass( 'current' );
			}
		} );
	}

	jQuery( window ).on( 'scroll', siteoriginCorpSelected );

	// Mobile Menu.
	var $mobileMenu = false;
	$( '#mobile-menu-button' ).click( function( e ) {
		e.preventDefault();
		var $$ = $( this );
		$$.toggleClass( 'to-close' );

		if ( $mobileMenu === false ) {
			$mobileMenu = $( '<div></div>' )
				.append( $( '.main-navigation ul' ).first().clone() )
				.attr( 'id', 'mobile-navigation' )
				.appendTo( '#masthead' ).hide();

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
					$( this ).siblings( '.dropdown-toggle' ).trigger( 'click' );
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
			if ( ! $( this ).hasClass( 'has-dropdown' ) || ( typeof $( this ).attr( 'href' ) !== "undefined" && $( this ).attr( 'href' )  !== "#" ) ) {
				if ( $mobileMenu.is(' :visible' ) ) {
					$mobileMenu.slideUp( 'fast' );
				}
			}
			$$.removeClass( 'to-close' );
		} );

		$( '#mobile-navigation a[href*="#"]:not([href="#"])' ).siteoriginCorpSmoothScroll();

	} );

	// Fullscreen search.
	$( '#search-button' ).click( function( e ) {
		e.preventDefault();
		var $$ = $( this );
		$$.toggleClass( 'close-search' );

		$( "input[type='search']" ).each( function() { $( this ).attr( 'size', $( this ).attr( 'placeholder' ).length ); } );

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
		$( this ).find( 'button svg' ).hide();
		$( this ).find( 'button svg:last-child' ).show();
	} );

	// Close fullscreen search with close button.
	$( '#fullscreen-search #search-close-button' ).click( function( e ) {
		e.preventDefault();
		$( '#search-button.close-search' ).trigger( 'click' );
	} );

	// Close fullscreen search with escape key.
	$( document ).keyup( function( e ) {
		if ( e.keyCode === 27 ) { // escape key maps to keycode `27`
			$( '#search-button.close-search' ).trigger( 'click' );
		}
	} );

	// Scroll to top.
	var sttWindowScroll = function() {
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
	$( '#scroll-to-top' ).click( function() {
		$( 'html, body' ).animate( { scrollTop: 0 } );
	} );

	// Sticky header.
	if ( $( '#masthead' ).hasClass( 'sticky' ) ) {
		var $mhs = false,
			$mh = $( '#masthead' ),
			$tb = $( '#topbar' ),
			$tbwc = $( '#topbar .woocommerce-store-notice[style*="display: none"]' );

		var smSetup = function() {

			if ( $( 'body' ).hasClass( 'mobile-header-ns' ) && ( $( window ).width() < siteoriginCorp.collapse ) ) {
				return;
			}

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
			var $img = $mh.find( '.site-branding img' ),
				imgWidth = $img.width(),
				imgHeight = $img.height();
				scaledWidth = imgWidth * siteoriginCorp.logoScale;
				scaledHeight = imgHeight * siteoriginCorp.logoScale;

			var smResizeLogo = function() {
				var $branding = $mh.find( '.site-branding > *' ),
					top = window.pageYOffset || document.documentElement.scrollTop;

				// Check if the menu is meant to be sticky or not, and if it is apply padding/class.
				if ( top > 0 ) {
					$mh.css( {
						'padding-top': mhPadding.top * siteoriginCorp.logoScale,
						'padding-bottom': mhPadding.bottom * siteoriginCorp.logoScale
					} ).addClass( 'stuck' );

				} else {
					$mh.css( {
						'padding-top': mhPadding.top,
						'padding-bottom': mhPadding.bottom
					} ).removeClass( 'stuck' );
				}

				if ( $img.length ) {
					// If Scale == siteoriginCorp.logoScale, logo is completely scaled.
					if ( $img.height() != scaledHeight || $img.width() != scaledWidth ) {
						var scale = siteoriginCorp.logoScale + ( Math.max( 0, 48 - top ) / 48 * ( 1 - siteoriginCorp.logoScale ) );
						$('.site-branding img').css( {
							width: imgWidth * scale,
							height: imgHeight * scale,
							'max-width' : 'none'
						} );
					}
				} else {
					if ( top > 0 ) {
						$branding.css( 'transform', 'scale(' + siteoriginCorp.logoScale + ')' );
					} else {
						$branding.css( 'transform', 'scale(1)' );
					}
				}
			};
			smResizeLogo();
			$( window ).scroll( smResizeLogo ).resize( smResizeLogo );
		}
	}

} );

( function( $ ) {
	$( window ).load( function() {
		siteoriginCorp.logoScale = parseFloat( siteoriginCorp.logoScale );
		// Masonry blog layout.
		if ( $( '.blog-layout-masonry' ).length ) {
			$( '.blog-layout-masonry' ).masonry( {
				itemSelector: '.hentry',
				columnWidth: '.hentry'
			} );
		}

	} );

} )( jQuery );
