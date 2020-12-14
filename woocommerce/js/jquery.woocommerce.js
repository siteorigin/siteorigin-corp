/**
 * File jquery.woocommerce.js.
 *
 * Handles the WooCommerce JavaScript functions for the theme.
 */
jQuery( function( $ ) {

	// Product archive order drop-down.
	$( '.woocommerce-ordering select' ).each( function() {
		var $$ = $(this);

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

		var widest = 0;
		$$.find( 'option' ).each( function() {
			var $o = $(this);
			dropdown.append(
				$( '<li></li>' )
					.html( $o.html() )
					.data( 'val', $o.attr( 'value' ) )
					.on( 'click', function() {
						$$.val( $( this ).data( 'val' ) );
						$$.closest( 'form' ).trigger( 'submit' );
					} )
			);

			widest = Math.max( c.find( '.current' ).html( $o.html() ).width(), widest);

		} );

		c.find('.current').html( $$.find( ':selected' ).html() ).width( widest );

		$$.hide();
	} );

	// Open dropdown on click.
	$( '.ordering-selector-wrapper' ).on( 'click', function() {
		$( this ).toggleClass( 'open-dropdown' );
	} );

	// Close dropdown on click outside dropdown wrapper.
	$( window ).on( 'click', function( e ) {
		if ( ! $( e.target ).closest( '.ordering-selector-wrapper.open-dropdown' ).length ) {
			$( '.ordering-selector-wrapper.open-dropdown' ).removeClass( 'open-dropdown' );
		}
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

				// Reset flexslider when WordPress wants to
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
