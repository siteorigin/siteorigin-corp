/**
 * File jquery.theme.js.
 *
 * Handles the primary JavaScript functions for the theme.
 */

/* globals jQuery, siteoriginCorp */

( function( $ ) {

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
	$( document ).on( 'mousemove', function( e ) {
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

			// Prevent potential sizing issue if a FlexSlider is added inside of a PB full width row.
			$( window ).one( 'panelsStretchRows', function() {
				$( 'body:not(.siteorigin-panels-css-container) .siteorigin-panels-stretch .flexslider' ).flexslider().resize();
			} );
		} );
	} );

	// Main menu.
	// Remove the no-js body class.
	$( 'body.no-js' ).removeClass( 'no-js' );
	if ( $( 'body' ).hasClass( 'css3-animations' ) ) {

		// Add keyboard access to the menu.
		$( '.menu-item' ).children( 'a' ).on( 'focusin', function() {
			$( this ).parents( 'ul, li' ).addClass( 'focus' );
		} );

		// Click event fires after focus event.
		$( '.menu-item' ).children( 'a' ).on( 'click', function() {
			$( this ).parents( 'ul, li' ).removeClass( 'focus' );
		} );

		$( '.menu-item' ).children( 'a' ).on( 'focusout', function() {
			$( this ).parents( 'ul, li' ).removeClass( 'focus' );
		} );
	}

	// Main menu current menu item indication.
	$( document ).ready( function( $ ) {
		if ( window.location.hash ) {
			return;
		} else {
			$( '#site-navigation a[href="'+ window.location.href +'"]' ).parent( 'li' ).addClass( 'current-menu-item' );
		}
		$( window ).on( 'click', function() {
			if ( $( '#site-navigation ul li' ).hasClass( 'current' ) ) {
				$( '#site-navigation li' ).removeClass( 'current-menu-item' );
				$( '#site-navigation li.current-menu-ancestor' ).removeClass( 'current-menu-ancestor current-menu-parent' );
			} else {
				if ( $( document ).scrollTop() == 0 ) {
					$( '#site-navigation a[href="'+ window.location.href +'"]' ).parent( 'li' ).addClass( 'current-menu-item' );
					$( '#site-navigation a[href="'+ window.location.href +'"]' ).parents( 'li.menu-item-has-children' ).addClass( 'current-menu-ancestor current-menu-parent' );
				}
			}
		} );
	} );

	// Smooth scroll from internal page anchors.
	var calcHeaderHeight = function() {
		var adminBarHeight = $( '#wpadminbar' ).outerHeight(),
			isAdminBar = $( 'body' ).hasClass( 'admin-bar' ),
			isStickyHeader = $( 'header' ).hasClass( 'sticky' ),
			$mh = $( '.site-header' ),
			headerHeight;

		// Header height. 1px to account for header shadow.
		if ( isStickyHeader && isAdminBar && $( window ).width() > 600 ) { // From 600px the admin bar isn't sticky so we shouldn't take its height into account.
			headerHeight = adminBarHeight + $( 'header' ).outerHeight() - 1;
		} else if ( isStickyHeader ) {
			headerHeight = $( 'header' ).outerHeight() - 1;
		} else {
			headerHeight = 0;
		}

		if ( $mh.data( 'scale-logo' ) && ! $mh.hasClass( 'stuck' ) ) {
			var mhPadding = parseInt( $mh.css( 'padding-bottom' ) );
			headerHeight += mhPadding - mhPadding * siteoriginCorp.logoScale * 2;
		}

		return headerHeight;
	};

	$.fn.siteoriginCorpSmoothScroll = function() {

		if ( $( 'body' ).hasClass( 'disable-smooth-scroll' ) ) {
			return;
		}

		$( this ).on( 'click', function( e ) {

			var hash    = this.hash;
			var idName  = hash.substring( 1 ); // Get ID name.
			var alink   = this;                // This button pressed.

			// Check if there is a section that had same id as the button pressed.
			if ( $( '.panel-grid [id*=' + idName + ']' ).length > 0 ) {
				$( '#site-navigation .current' ).removeClass( 'current' );
				$( alink ).parent( 'li' ).addClass( 'current' );
			} else {
				$( '#site-navigation .current' ).removeClass( 'current' );
			}
			if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
				var target = $( this.hash );
				target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) +']' );
				if ( target.length ) {
					$( 'html, body' ).stop().animate( {
						scrollTop: target.offset().top - calcHeaderHeight()
					},
					{
						duration: 1200,
						start: function() {
							$( 'html, body' ).on( 'wheel touchmove', function() {
								$( 'html, body' ).stop().off( 'wheel touchmove' );
							} );
						},
						complete: function() {
							$( 'html, body' ).finish().off( 'wheel touchmove' );
						},
					} );
					return false;
				}
			}
		} );
	};

	$( window ).on( 'load', function() {
		$( '#site-navigation a[href*="#"]:not([href="#"]), .comments-link a[href*="#"]:not([href="#"]), .woocommerce-review-link[href*="#"]:not([href="#"]), .corp-scroll[href*="#"]:not([href="#"])' ).siteoriginCorpSmoothScroll();

		// Adjust for sticky header when linking from external anchors.
		if ( location.pathname.replace( /^\//,'' ) == window.location.pathname.replace( /^\//,'' ) && location.hostname == window.location.hostname ) {
			var target = $( window.location.hash );
			if ( target.length ) {
				setTimeout( function() {
					$( 'html, body' ).animate(
						{
							scrollTop: target.offset().top - calcHeaderHeight()
						},
						0,
						function() {
							if ( $( '#masthead' ).hasClass( 'sticky-menu' ) ) {
								// Avoid a situation where the logo can be incorrectly sized due to the page jump.
								smSetup();
							}
						}
					);
				}, 100 );
			}
		}
	} );

	// Indicate which section of the page we're viewing with selected menu classes.
	function siteoriginCorpSelected() {

		// Cursor position.
		var scrollTop = $( window ).scrollTop();

		// Used for checking if the cursor is in one section or not.
		var isInOneSection = 'no';

		// For all sections check if the cursor is inside a section.
		$( '.panel-row-style' ).each( function() {

			// Section ID.
			var thisID = '#' + $( this ).attr( 'id' );

			// Distance between top and our section. Minus 1px to compensate for an extra pixel produced when a Page Builder row bottom margin is set to 0.
			var offset = $( this ).offset().top - 1;

			// Section height.
			var thisHeight = $( this ).outerHeight();

			// Where the section begins.
			var thisBegin = offset - calcHeaderHeight();

			// Where the section ends.
			var thisEnd = offset + thisHeight - calcHeaderHeight();

			// If position of the cursor is inside of the this section.
			if ( scrollTop >= thisBegin && scrollTop <= thisEnd ) {
				isInOneSection = 'yes';
				$( '#site-navigation .current' ).removeClass( 'current' );
				// Find the menu button with the same ID section.
				$( '#site-navigation a[href$="' + thisID + '"]' ).parent( 'li' ).addClass( 'current' ); // Find the menu button with the same ID section.
				return false;
			}
			if ( isInOneSection === 'no' ) {
				$( '#site-navigation .current' ).removeClass( 'current' );
			}
		} );
	}

	$( window ).on( 'scroll', siteoriginCorpSelected );

	// Mobile Menu.
	var $mobileMenu = false;
	$( '#mobile-menu-button' ).on( 'click', function( e ) {
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
			$mobileMenu.find( '.dropdown-toggle' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-open' ).next( '.children, .sub-menu' ).slideToggle( 'fast' );
			} );

			$mobileMenu.find( '.has-dropdown' ).on( 'click', function( e ) {
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

			$( window ).on( 'resize', mmOverflow );
			$( '#mobile-navigation' ).on( 'scroll', mmOverflow );

		}

		$mobileMenu.slideToggle( 'fast' );

		$( '#mobile-navigation a' ).on( 'click', function( e ) {
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
	$( '#search-button' ).on( 'click', function( e ) {
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
		$( window ).on( 'resize', fullscreenSearch );

		// Disable scrolling when fullscreen search is open.
		if ( $$.hasClass( 'close-search' ) ) {
			$( 'body' ).css( 'margin-right', ( window.innerWidth - $( 'body' ).width() ) + 'px' );
			$( 'body' ).css( 'overflow', 'hidden' );
		} else {
			$( 'body' ).css( 'overflow', '' );
			$( 'body' ).css( 'margin-right', '' );
		}

		$( '#fullscreen-search' ).slideToggle( 'fast' );

		$( '#fullscreen-search input' ).trigger( 'focus' );

	} );

	$( '#fullscreen-search-form' ).on( 'submit', function() {
		$( this ).find( 'button svg' ).hide();
		$( this ).find( 'button svg:last-child' ).show();
	} );

	// Close fullscreen search with close button.
	$( '#fullscreen-search #search-close-button' ).on( 'click', function( e ) {
		e.preventDefault();
		$( '#search-button.close-search' ).trigger( 'click' );
	} );

	// Close fullscreen search with escape key.
	$( document ).on( 'keyup', function( e ) {
		if ( e.keyCode === 27 ) { // escape key maps to keycode `27`
			$( '#search-button.close-search' ).trigger( 'click' );
		}
	} );

	// Scroll to top.
	var sttWindowScroll = function () {
		var top = window.pageYOffset || document.documentElement.scrollTop;
		var scrollOffset = $( '#masthead' ).length ? $( '#masthead' ).outerHeight() : $( window ).outerHeight() / 2;

		if ( top > scrollOffset ) {
			if ( ! $( '#scroll-to-top' ).hasClass( 'show' ) ) {
				$( '#scroll-to-top' ).css( 'pointer-events', 'auto' ).addClass( 'show' );
			}
		} else if ( $( '#scroll-to-top' ).hasClass( 'show' ) ) {
			$( '#scroll-to-top' ).css( 'pointer-events', 'none' ).removeClass( 'show' );
		}
	};
	sttWindowScroll();
	$( window ).on( 'scroll', sttWindowScroll );
	$( '#scroll-to-top' ).on( 'click', function() {
		$( 'html, body' ).stop().animate( { scrollTop: 0 } );
	} );

	// Detect if is a touch device. We detect this through ontouchstart, msMaxTouchPoints and MaxTouchPoints.
	if ( 'ontouchstart' in document.documentElement || window.navigator.msMaxTouchPoints || window.navigator.MaxTouchPoints ) {
		if ( /iPad|iPhone|iPod/.test( navigator.userAgent ) && ! window.MSStream ) {
			$( 'body' ).css( 'cursor', 'pointer' );
			$( 'body' ).addClass( 'ios' );
		}

		$( '.main-navigation #primary-menu' ).find( '.menu-item-has-children > a' ).each( function() {
			$( this ).on( 'click touchend', function( e ) {
				var link = $( this );
				e.stopPropagation();

				if ( e.type == 'click' ) {
					return;
				}

				if ( ! link.parent().hasClass( 'hover' ) ) {
					// Remove .hover from all other sub menus
					$( '.menu-item.hover' ).removeClass( 'hover' );
					link.parents('.menu-item').addClass( 'hover' );
					e.preventDefault();
				}

				// Remove .hover class when user clicks outside of sub menu
				$( document ).one( 'click', function() {
					link.parent().removeClass( 'hover' );
				} );

			} );
		} );
	}

	// Setup the load more button in portfolio widget loop if there's a portfolio loop present on the page.
	if ( $( '#portfolio-loop' ).length ) {
		$infinite_scroll = 0;
		$( document.body ).on( 'post-load', function() {
			var $container = $( '#portfolio-loop' );

			$infinite_scroll = $infinite_scroll + 1;
			var $container = $( '#projects-container' ),
				$selector = $( '#infinite-view-' + $infinite_scroll ),
				$elements = $selector.find( '.jetpack-portfolio.post' );

			$elements.hide();
			$container.append( $elements ).isotope( 'appended', $elements );
		} );
	}

	$( window ).on( 'load', function() {
		siteoriginCorp.logoScale = parseFloat( siteoriginCorp.logoScale );
		// Masonry blog layout.
		if ( $( '.blog-layout-masonry' ).length ) {
			$( '.blog-layout-masonry' ).masonry( {
				itemSelector: '.hentry',
				columnWidth: '.hentry'
			} );
		}

		// Portfolio loop filter.
		var $container = $( '#projects-container' );
		if ( $( '.portfolio-filter-terms' ).length ) {
			$container.isotope( {
				itemSelector: '.post',
				filter: '*',
				layoutMode: 'fitRows',
				resizable: true,
			} );
		}

		$( '.portfolio-filter-terms button' ).on( 'click', function() {
			var selector = $( this ).attr( 'data-filter' );
			$container.isotope( {
				filter: selector,
			} );
			$( '.portfolio-filter-terms button' ).removeClass( 'active' );
			$( this ).addClass( 'active' );
			return false;
		} );

		// Header padding to be used if logo scaling is enabled.
		var $mh = $( '#masthead' ),
			mhPadding = {
				top: parseInt( $mh.css( 'padding-top' ) ),
				bottom: parseInt( $mh.css( 'padding-bottom' ) )
			};

		// Sticky header logo scaling.
		if ( $mh.data( 'scale-logo' ) ) {
			var $img = $mh.find( '.site-branding img' ),
				imgWidth = $img.width(),
				imgHeight = $img.height(),
				scaledWidth = imgWidth * siteoriginCorp.logoScale,
				scaledHeight = imgHeight * siteoriginCorp.logoScale;

			$( ".site-branding img" ).wrap( "<div class='custom-logo-wrapper'></div>" );

			var smResizeLogo = function() {
				var $branding = $mh.find( '.site-branding > *' ),
					top = window.pageYOffset || document.documentElement.scrollTop;

				// Check if the menu is meant to be sticky or not, and if it is apply padding/class.
				if ( top > siteoriginCorp.stickyOffset ) {
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
					// Are we at the top of the page?
					if ( top > 0 ) {
						// Calulate scale amount based on distance from the top of the page.
						var logoScale = siteoriginCorp.logoScale + ( Math.max( 0, 48 - top ) / 48 * ( 1 - siteoriginCorp.logoScale ) );
						if ( $img.height() != scaledHeight || $img.width() != scaledWidth || logoScale != siteoriginCorp.logoScale ) {
							$( '.site-branding img' ).css( {
								width: logoScale * 100 + '%',
							} );
						}
					} else {
						// Ensure no scaling is present.
						$( '.site-branding img' ).css( {
							width: '',
						} );
					}

				} else if ( top > 0 ) {
					$branding.css( 'transform', 'scale(' + siteoriginCorp.logoScale + ')' );

				} else {
					$branding.css( 'transform', 'scale(1)' );
				}
			};
			smResizeLogo();
			$( window ).on( 'scroll resize', smResizeLogo );
		}

		// Sticky header.
		if ( $( '#masthead' ).hasClass( 'sticky' ) ) {
			var $mh = $( '#masthead' ),
				$mhs = $( '<div class="masthead-sentinel"></div>' ).insertAfter( $mh ),
				$tb = $( '#topbar' ),
				$tbwc = $( '#topbar .woocommerce-store-notice[style*="display: none"]' );

			// Sticky header shadow.
			var smShadow = function() {
				if ( $( window ).scrollTop() > siteoriginCorp.stickyOffset ) {
					$( $mh ).addClass( 'stuck' );
				} else {
					$( $mh ).removeClass( 'stuck' );
				}
			};
			smShadow();
			$( window ).on( 'scroll', smShadow );

			var smSetup = function() {

				if ( $( 'body' ).hasClass( 'mobile-header-ns' ) && ( $( window ).width() < siteoriginCorp.collapse ) ) {
					return;
				}

				if ( $mhs !== false ) {
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

				if (
					$( 'body' ).hasClass( 'no-topbar' ) ||
					(
						! $( 'body' ).hasClass( 'no-topbar' ) &&
						$( 'body' ).hasClass( 'topbar-out' )
					) ||
					$tbwc.length
				) {
				var top = window.pageYOffset || document.documentElement.scrollTop;
					if ( top > siteoriginCorp.stickyOffset ) {
						$mh.css( 'position', 'fixed' );
					} else {
						$mh.css( 'position', 'absolute' );
					}
				} else if ( ! $( 'body' ).hasClass( 'no-topbar' ) && ! $( 'body' ).hasClass( 'topbar-out' ) ) {
					$mh.css( 'position', 'absolute' );
				}

			};
			smSetup();
			$( window ).on( 'resize scroll', smSetup );

		}
	} );
} )( jQuery );
