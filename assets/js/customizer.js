/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Accent color.
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				hue = style.data( 'hue' ),
				css = style.html();

			// Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.
			css = css.split( hue + ',' ).join( to + ',' );
			style.html( css ).data( 'hue', to );
		} );
	} );

	// Overlay color scheme.
	wp.customize( 'overlay_colorscheme', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'overlay-light overlay-dark' ).addClass( 'overlay-' + to );
		} );
	} );

	// Footer color scheme.
	wp.customize( 'footer_colorscheme', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'footer-light footer-dark footer-accent' ).addClass( 'footer-' + to );
		} );
	} );

	// Icon accent.
	wp.customize( 'icon_accent', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'icon-accent' );
			if ( !! to ) {
				$( 'body' ).addClass( 'icon-accent' );
			}
		} );
	} );

} )( jQuery );
