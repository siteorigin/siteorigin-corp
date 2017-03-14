/**
 * File jquery.woocommerce.js.
 *
 * Handles the WooCommerce JavaScript functions for the theme.
 */
jQuery( function( $ ) {

	// Product images slider.
	$( document ).ready( function() {
		if ( $.isFunction( $.fn.flexslider ) ) {
			$( '.product-images-carousel' ).flexslider( {
				animation: "slide",
				controlNav: false,
				animationLoop: false,
				slideshow: false,
				itemWidth: 100,
				itemMargin: 20,
				maxItems: 4,
				asNavFor: '.product-images-slider'
			} );
			$( '.product-images-slider' ).flexslider( {
				animation: "slide",
				animationLoop: false,
				slideshow: false,
				controlNav: false,
				directionNav: false
			} );
		}
	} );

	// Product archive order drop-down.
	$( '.woocommerce-ordering select' ).each( function() {
		var $$ = $(this);

		var c = $( '<div></div>' )
			.html( '<span class="current">' + $$.find( ':selected' ).html() + '</span>' + polestar_data.chevron_down )
			.addClass( 'ordering-selector-wrapper' )
			.insertAfter( $$ );

		var dropdownContainer = $( '<div/>' )
			.addClass( 'ordering-dropdown-container' )
			.appendTo( c );

		var dropdown = $( '<ul></ul>' )
			.addClass( 'ordering-dropdown' )
			.appendTo(dropdownContainer);

		var widest = 0;
		$$.find( 'option' ).each( function() {
			var $o = $(this);
			dropdown.append(
				$( '<li></li>' )
					.html( $o.html() )
					.data( 'val', $o.attr( 'value' ) )
					.click( function(){
						$$.val( $( this ).data( 'val' ) );
						$$.closest( 'form' ).submit();
					} )
			);

			widest = Math.max( c.find( '.current' ).html( $o.html() ).width(), widest );

		} );

		c.find( '.current' ).html( $$.find( ':selected' ).html()).width( widest );

		$$.hide();
	} );	

} );
