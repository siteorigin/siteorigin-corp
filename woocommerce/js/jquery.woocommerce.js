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
					.click( function() {
						$$.val( $( this ).data( 'val' ) );
						$$.closest( 'form' ).submit();
					} )
			);

			widest = Math.max( c.find( '.current' ).html( $o.html() ).width(), widest);

		} );

		c.find('.current').html( $$.find( ':selected' ).html() ).width( widest );

		$$.hide();
	} );

	// Open dropdown on click.
	$( '.ordering-selector-wrapper' ).click( function() {
		$( this ).toggleClass( 'open-dropdown' );
	} );

	// Close dropdown on click outside dropdown wrapper.
	$( window ).click( function( e ) {
		if ( ! $( e.target ).closest( '.ordering-selector-wrapper.open-dropdown' ).length ) {
			$( '.ordering-selector-wrapper.open-dropdown' ).removeClass( 'open-dropdown' );
		}
	} );	
	
	// Quick View modal.
	$( '.product-quick-view-button' ).click( function( e ) {
		e.preventDefault();

		var $container = '#quick-view-container';
		var $content = '#product-quick-view';

		var id = $( this ).attr( 'data-product-id' );

		$.post(
			siteorigin_corp_data.ajaxurl,
			{ action: 'siteorigin_corp_product_quick_view', product_id: id },
			function( data ) {
				$( document ).find( $container ).find( $content ).html( data );
			}
		);

		if ( $( document ).find( $container ).is( ':hidden' ) ) {
			$( document ).find( $container ).find( $content ).empty();
		}

		$( document ).find( $container ).fadeIn( 300 );
		// Disable scrolling when quick view is open.
		$( 'body' ).css( 'margin-right', ( window.innerWidth - $( 'body' ).width() ) + 'px' );
		$( 'body' ).css( 'overflow', 'hidden' );

		$( window ).mouseup( function( e ) {
			var container = $( $content );
			if ( ( ! container.is( e.target ) && container.has( e.target ).length === 0 ) || $( '.quickview-close-icon' ).is( e.target ) ) {
				$( $container).fadeOut( 300 );
				// Enable scrolling.
				$( 'body' ).css( 'overflow', '' );
				$( 'body' ).css( 'margin-right', '' );
			}
		} );

		$( document ).keyup( function( e ) {
			var container = $( $content );
			if ( e.keyCode == 27 ) { // Escape key maps to keycode 27.
				$($container).fadeOut( 300 );
				// Enable scrolling.
				$( 'body' ).css( 'overflow', '' );
				$( 'body' ).css( 'margin-right', '' );
			}
		} );		

	} );	

} );
