/**
 * File jquery.theme.js.
 *
 * Handles the primary JavaScript functions for the theme.
 */
jQuery( function( $ ) {

	// no-js Body Class.
	$ ( 'body.no-js' ).removeClass( 'no-js' );
	if ( $( 'body' ).hasClass( 'css3-animations' ) ) {

		var resetMenu = function() {
			$( '.main-navigation ul ul' ).each( function() {
				var $$ = $( this );
				var width = Math.max.apply(Math, $$.find( '> li > a' ).map( function() { return $( this ).width(); } ).get() );
				$$.find( '> li > a' ).width( width );
			} );
		};
		resetMenu();
		$( window ).resize( resetMenu );

	}

    // Setup FitVids for entry content, video post formats, SiteOrigin panels and WooCommerce pages. Ignore Tableau.
    if ( typeof $.fn.fitVids !== 'undefined' ) {
        $( '.entry-content, .entry-content .panel, .entry-video, .woocommerce #main' ).fitVids( { ignore: '.tableauViz' } );
    }	

	// Mobile menu.
	var $mobileMenu = false;
	$( '#mobile-menu-button' ).click( function(e){
		e.preventDefault();

		$( '#search-button.close-search' ).trigger( 'click' );

		var $$ = $(this);
		$$.toggleClass( 'to-close' );
		var $mobileMenuDiv = $( '#mobile-navigation' );

		if( $mobileMenu === false ) {
			$mobileMenu = $mobileMenuDiv
				.append( $( '.main-navigation ul' ).first().clone() )
				.appendTo( $mobileMenuDiv ).hide();
		}

		$mobileMenu.slideToggle( 'fast' );

		$mobileMenu.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"><svg version="1.1" class="svg-icon-submenu" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><path d="M30.054 14.429l-13.25 13.232q-0.339 0.339-0.804 0.339t-0.804-0.339l-13.25-13.232q-0.339-0.339-0.339-0.813t0.339-0.813l2.964-2.946q0.339-0.339 0.804-0.339t0.804 0.339l9.482 9.482 9.482-9.482q0.339-0.339 0.804-0.339t0.804 0.339l2.964 2.946q0.339 0.339 0.339 0.813t-0.339 0.813z"></path></svg></button>' );
		$mobileMenuDiv.find( '.menu-item-has-children a' ).width( '100%' );
		$mobileMenuDiv.find( '.dropdown-toggle' ).click( function( e ) {
			e.preventDefault();
			$( this ).next( '.children, .sub-menu' ).slideToggle( 'fast' );
		} );
	} );

} );
