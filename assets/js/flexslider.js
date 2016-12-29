/**
 * Flexslider js for theme
 */

( function( $ ) {

  $( document ).ready( function() {

    $( '.featured-content' ).removeClass( 'no-js' ).flexslider( {
      selector: '.featured-content--inner > .featured-content--slide',
      smoothHeight: true,
      slideshow: false
    } );

  } );

} )( jQuery );
