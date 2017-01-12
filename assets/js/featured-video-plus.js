/**
 * Featured Video Plus js for theme
 */

var player;

( function( $ ) {
  var $document = $( document ),
      playButton,
      featuredVideo,
      tag,
      firstScriptTag,
      sep = '?';

  $document.ready( function() {
		playButton = $( '.video-play' )[0];
    featuredVideo = $( '.overlay--video iframe' )[0];

    if ( 'undefined' === typeof featuredVideo ) {
      featuredVideo = $( '.overlay--video video' )[0];
    }

    if ( featuredVideo && null !== featuredVideo ) {
      featuredVideo.id = 'overlay--video__video';

      if ( featuredVideo.src.indexOf( '?' ) !== -1 ) {
        sep = '&';
      }

      if ( featuredVideo.src.indexOf( 'youtube.com' ) !== -1 ) {

        // Append the embed url with the api param
        featuredVideo.src += sep + 'enablejsapi=1';

        /**
         * Inject YouTube API script
         */
        tag = document.createElement( 'script' );
        tag.src = 'https://www.youtube.com/player_api';
        firstScriptTag = document.getElementsByTagName( 'script' )[0];
        firstScriptTag.parentNode.insertBefore( tag, firstScriptTag );
      } else if ( featuredVideo.src.indexOf( 'vimeo.com' ) !== -1 && 'undefined' !== typeof Vimeo ) {

        // Append the embed url with the api param
        featuredVideo.src += sep + 'api=1';

        player = new Vimeo.Player( featuredVideo );

      } else if ( featuredVideo.play ) {

        player = featuredVideo;

      }
    }

    $( '.video-toggle' ).on( 'click', function( e ) {
      var $this = $( this );

			e.preventDefault();

      $( '.overlay--video' ).toggleClass( 'show' ).resize();
			$( 'body' ).toggleClass( 'overlay-open' );

			$this.attr( 'aria-expanded', 'false' == $( this ).attr( 'aria-expanded' ) ? 'true' : 'false' );

      $( '.menu-toggle, .search-toggle' ).toggleClass( 'hide' );

		} );

    $( '.video-play' ).on( 'click', function( e ) {
      e.preventDefault();

      if ( 'undefined' !== typeof player ) {

        // Vimeo and video tag
        if ( player.play ) {
          player.play();
        }

      }
    } );

    $( '.video-stop' ).on( 'click', function( e ) {
      e.preventDefault();

      if ( 'undefined' !== typeof player ) {

        // Vimeo and video tag
        if ( player.pause ) {
          player.pause();
        }

      }
    } );
	} );

  $document.keyup( function( e ) {
    if ( 27 === e.keyCode && $( '.overlay--video' ).hasClass( 'show' ) ) {

      // Stop video
      if ( 'undefined' !== typeof player ) {

        // Youtube
        if ( player.pauseVideo ) {
          player.pauseVideo();
        }

        // Vimeo and video tag
        if ( player.pause ) {
          player.pause();
        }
      }

      $( 'body' ).removeClass( 'overlay-open' );
      $( '.video-toggle' ).attr( 'aria-expanded', 'false' );
      $( '.overlay--video' ).removeClass( 'show' ).resize();
      $( '.menu-toggle, .search-toggle' ).removeClass( 'hide' );
    }
  } );

} )( jQuery );

/**
 * Function called once the Youtube API loads.
 * This is dependent on checking the "Enable JavaScript API"
 * checkbox in the plugin options (/wp-admin/options-media.php).
 */
function onYouTubePlayerAPIReady() {

  // Define player as Youtube player
  player = new YT.Player( 'overlay--video__video', {
    events: {
      'onReady': onPlayerReady
    }
  } );
}

/**
 * Function to be called once the player is ready
 */
function onPlayerReady( event ) {
  playButton = jQuery( '.video-play' )[0];
  stopButton = jQuery( '.video-stop' )[0];

  // Click listener for play button
  playButton.addEventListener( 'click', function() {
    player.playVideo();
  } );

  // Click listener for stop button
  stopButton.addEventListener( 'click', function() {
    player.pauseVideo();
  } );
}
