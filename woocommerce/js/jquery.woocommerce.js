/**
 * File jquery.woocommerce.js.
 *
 * Handles the WooCommerce JavaScript functions for the theme.
 */
jQuery( function( $ ) {

	// Product archive order drop-down.
	var setupWCDropdowns = function( dropdown ) {
		var $$ = $( dropdown );

		var c = $( '<div></div>' )
			.html( '<span class="current">' + $$.find( ':selected' ).html() + '</span>' + siteorigin_corp_data.chevron_down )
			.addClass( 'ordering-selector-wrapper' )
			.insertAfter( $$ );

		var dropdownContainer = $( '<div/>' )
			.addClass( 'ordering-dropdown-container' )
			.appendTo( c );

		var dropdown = $( '<ul></ul>' )
			.addClass( 'ordering-dropdown' )
			.appendTo( dropdownContainer );

		$$.find( 'option' ).each( function() {
			var $o = $(this);
			dropdown.append(
				$( '<li></li>' )
					.html( $o.html() )
					.data( 'val', $o.attr( 'value' ) )
					.on( 'click', function() {
						$$.val( $( this ).data( 'val' ) ).trigger( 'change' );
						if ( $$.hasClass( 'woocommerce-ordering' ) ) {
							$$.closest( 'form' ).trigger( 'submit' );
						} else {
							c.find( '.current' ).text(  $( this ).text() );
						}
					} )
			);

			c.find( '.current' ).html( $o.html() );
		} );

		$$.hide();
	}

	$( '.woocommerce-ordering select, .corp-variations-wrapper select' ).each( function() {
		setupWCDropdowns( this );
	} );

	// Open dropdown on click.
	$( document ).on( 'click', '.ordering-selector-wrapper', function() {
		$( this ).toggleClass( 'open-dropdown' );
	} );

	// Close dropdown on click outside dropdown wrapper.
	$( window ).on( 'click', function( e ) {
		if ( ! $( e.target ).closest( '.ordering-selector-wrapper.open-dropdown' ).length ) {
			$( '.ordering-selector-wrapper.open-dropdown' ).removeClass( 'open-dropdown' );
		}
	} );

	// Reset dropdown when clicking clear.
	$( document ).on( 'click', '.woocommerce .product .variations .reset_variations', function() {
		$( this ).parents( '.variations_form' ).find( '.corp-variations-wrapper' ).each( function() {
			var $$ = $( this );
			$$.find( '.current' ).text( $$.find( '.ordering-dropdown li' ).first().text() );

			$$.find( 'option:selected' ).prop( 'selected', false );
			$$.find( 'select' ).trigger( 'change' );
		} );
	} );

	// Quick View modal.
	$( '.product-quick-view-button' ).on( 'click', function( e ) {
		e.preventDefault();

		var $container = '#quick-view-container';
		var $content = '#product-quick-view';

		var id = $( this ).attr( 'data-product-id' );

		$.post(
			siteorigin_corp_data.ajaxurl,
			{ action: 'siteorigin_corp_product_quick_view', product_id: id },
			function( data ) {
				$( document ).find( $container ).find( $content ).html( data );
				$( document ).find( '#product-quick-view .variations_form' ).wc_variation_form();
				$( document ).find( '#product-quick-view .variations_form' ).trigger( 'check_variations' );
				// Setup variation drop downs to use the Corp WC Drop Down.
				$( '#quick-view-container .corp-variations-wrapper select' ).each( function() {
					setupWCDropdowns( this );
				} );
			}
		);

		$( document ).ajaxComplete( function() {
			if ( $.isFunction( $.fn.flexslider ) ) {
				$( '.product-images-slider' ).flexslider( {
					animation: 'slide',
					customDirectionNav: $( this ).find( '.flex-direction-nav a' ),
					start: function() {
						$( '.flexslider .slides img' ).show();
					}
				} );

				// If variation has image, change to flexslider slide.
				$( '#product-quick-view .variations_form' ).on( 'found_variation.wc-variation-form', function( event, variation ) {
					if ( variation && variation.image && variation.image.full_src ) {
						var variationItem = $( '#product-quick-view .product-gallery-image' ).find( 'img[src="' + variation.image.full_src + '"]' );
						if ( variationItem.length > 0 ) {
							 $( '.product-images-slider' ).flexslider( variationItem.parent().index('.product-images-slider  .slide') - 1 );
						} else {
							$( '.product-images-slider' ).flexslider( 0 );
						}
					}
				} );

				// Reset flexslider when WooCommerce wants to
				$( '#product-quick-view .variations_form' ).on( 'reset_image', function( event, variation ) {
					$( '.product-images-slider' ).flexslider( 0 );
				} );

			}
		} );

		if ( $( document ).find( $container ).is( ':hidden' ) ) {
			$( document ).find( $container ).find( $content ).empty();
		}

		$( document ).find( $container ).fadeIn( 300 );
		// Disable scrolling when quick view is open.
		$( 'body' ).css( 'margin-right', ( window.innerWidth - $( 'body' ).width() ) + 'px' );
		$( 'body' ).css( 'overflow', 'hidden' );

		$( window ).on( 'mouseup', function( e ) {
			var container = $( $content );
			if ( ( ! container.is( e.target ) && container.has( e.target ).length === 0 ) || $( '.quickview-close-icon' ).is( e.target ) ) {
				$( $container).fadeOut( 300 );
				// Enable scrolling.
				$( 'body' ).css( 'overflow', '' );
				$( 'body' ).css( 'margin-right', '' );
			}
		} );

		$( document ).on( 'keyup', function( e ) {
			var container = $( $content );
			if ( e.keyCode == 27 ) { // Escape key maps to keycode 27.
				$( $container ).fadeOut( 300 );
				// Enable scrolling.
				$( 'body' ).css( 'overflow', '' );
				$( 'body' ).css( 'margin-right', '' );
			}
		} );

	} );

} );
