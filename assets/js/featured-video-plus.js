/**
 * Featured Video Plus js for theme
 */

( function( $ ) {
  var $document = $( document ),
      player,
      playButton,
      $featured_video,
      firstScriptTag;

  function videoOverlayControl() {
    $( '.video-toggle' ).on( 'click', function( e ) {
      var $this = $( this );

			e.preventDefault();

      // Stop video
      if ( $( '.overlay--video' ).hasClass( 'show' ) ) {
        if (typeof player !== 'undefined') {
      		// Youtube
      		if (player.pauseVideo) {
      			player.pauseVideo();
      		}

      		// Vimeo and <video> tag
      		if (player.pause) {
      			player.pause();
      		}
      	}
      }

			$( '.overlay--video' ).toggleClass( 'show' ).resize();
			$( 'body' ).toggleClass( 'overlay-open' );

			$this.attr( 'aria-expanded', 'false' == $( this ).attr( 'aria-expanded' ) ? 'true' : 'false' );

      $( '.menu-toggle, .search-toggle' ).toggleClass( 'hide' );
		} );
  }

  $document.ready( function() {
		videoOverlayControl();

    playButton = $( '.video-toggle' )[0];
    $featured_video = $('.overlay--video iframe');

    if ($featured_video === null) {
      $featured_video = $('.overlay--video video');
    }

    if ($featured_video && $featured_video !== null) {
      $featured_video.id = 'video-overlay-video';

      var sep = '?';
      if ($featured_video.src.indexOf('?') !== -1) {
        sep = '&';
      }

      if ($featured_video.src.indexOf('youtube.com') !== -1) {
        // Append the embed url with the api param
        $featured_video.src += sep + 'enablejsapi=1';

        /**
         * Inject YouTube API script
         */
        var tag = document.createElement('script');
        tag.src = 'https://www.youtube.com/player_api';
        firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      } else if ($featured_video.src.indexOf('vimeo.com') !== -1 && typeof Vimeo !== 'undefined') {
        // Append the embed url with the api param
        $featured_video.src += sep + 'api=1';

        /* jshint ignore:start */
        player = new Vimeo.Player($featured_video);
        /* jshint ignore:end */

        // Click listener for play button
        playButton.addEventListener('click', function() {
          /* jshint ignore:start */
          player.play();
          /* jshint ignore:end */
        });
      } else if ($featured_video.play) {
        // Click listener for play button
        playButton.addEventListener('click', function() {
          $featured_video.play();
        });
      }
    }
	} );

  $document.keyup( function( e ) {
    if ( 27 === e.keyCode && $( '.overlay--video' ).hasClass( 'show' ) ) {
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
  player = new YT.Player(VIDEO_ID, {
    events: {
      'onReady': onPlayerReady
    }
  });
}

/**
 * Function to be called once the player is ready
 */
function onPlayerReady(event) {
  // Click listener for play button
  playButton.addEventListener('click', function() {
    player.playVideo();
  });
}
