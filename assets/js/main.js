/**
 * Custom js for theme
 */

// CustomEvent polyfill
( function() {
	if ( 'function' === typeof window.CustomEvent ) {
		return false;
	}
	function CustomEvent( event, params ) {
		var evt = document.createEvent( 'CustomEvent' );
		params = params || { bubbles: false, cancelable: false, detail: undefined };
		evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
		return evt;
	}
	CustomEvent.prototype = window.Event.prototype;
	window.CustomEvent = CustomEvent;
} )();

( function( $ ) {
	var $window   = $( window ),
		$document = $( document ),
		resizeTimer,
		siteHeader = $( '.site-header' ),
		menuOverlay = $( '.overlay--menu' ),
		searchOverlay = $( '.overlay--search' ),
		chapterOverlay = $( '.overlay--chapter' ),
		body = $( 'body' ),
		menuToggle = $( '.menu-toggle' ),
		searchToggle = $( '.search-toggle' ),
		chapterToggle = $( '.chapter-toggle' ),
		button = '<button class="showsub-toggle" aria-expanded="false">' + menuToggleText.icon + '<span class="screen-reader-text">' + menuToggleText.open + '</span></button>',
		headroom,
		morpheusConfig = {
			duration: 200,
			rotation: 'none'
		},
		clickEvent = new CustomEvent( 'click' ), // For programmatically firing the click event on SVG icons
		menuIcon = document.getElementById( 'svg-icon-menu-icon' ),
		searchIcon = document.getElementById( 'svg-icon-search-icon' ),
		bookmarkIcon = document.getElementById( 'svg-icon-bookmark-icon' );

	/**
	 * Header
	 *
	 * Controls the header's show/hide on scroll.
	 * Adds "back to top" funcionality to the header.
	 */
	function initHeader() {
		if ( siteHeader.length > 0 ) {
			headroom = new Headroom( siteHeader.get( 0 ) );
		}
		if ( undefined !== headroom ) {
			headroom.init();
		}

		siteHeader.click( function( e ) {
			if ( 0 === $( e.target ).closest( 'a' ).length && 0 === $( e.target ).closest( 'button' ).length ) {
				$( 'html, body' ).animate({
					scrollTop: $( 'html' ).offset().top
				});
			}
		});
	}

	/**
	 * Overlay
	 *
	 * Swaps classes for overlay so it uses CSS transformations.
	 */
	function overlayControl() {
		menuToggle.on( 'click', function( e ) {
			var $this = $( this );

			e.preventDefault();

			menuOverlay.toggleClass( 'show' ).resize();
			body.toggleClass( 'overlay-open' );

			$this.toggleClass( 'toggle-on' );
			$this.attr( 'aria-expanded', 'false' == $( this ).attr( 'aria-expanded' ) ? 'true' : 'false' );

			menuIcon.dispatchEvent( clickEvent );

			searchToggle.toggleClass( 'hide' );
			chapterToggle.toggleClass( 'hide' );
		} );

		searchToggle.on( 'click', function( e ) {
			var $this = $( this ),
				searchField = searchOverlay.find( 'input.search-field' );

			e.preventDefault();

			searchOverlay.toggleClass( 'show' ).resize();
			body.toggleClass( 'overlay-open' );

			$this.toggleClass( 'toggle-on' );
			$this.attr( 'aria-expanded', 'false' == $( this ).attr( 'aria-expanded' ) ? 'true' : 'false' );

			searchIcon.dispatchEvent( clickEvent );

			menuToggle.toggleClass( 'hide' );
			chapterToggle.toggleClass( 'hide' );

			if ( searchField.is( ':visible' ) ) {
				setTimeout( function() {
					searchOverlay.find( 'input.search-field' ).focus();
				}, 200 ); // Matches the transition timing in css
			}
		} );

		chapterToggle.on( 'click', function( e ) {
			var $this = $( this );

			e.preventDefault();

			chapterOverlay.toggleClass( 'show' ).resize();
			body.toggleClass( 'overlay-open' );

			$this.toggleClass( 'toggle-on' );
			$this.attr( 'aria-expanded', 'false' == $( this ).attr( 'aria-expanded' ) ? 'true' : 'false' );

			bookmarkIcon.dispatchEvent( clickEvent );

			menuToggle.toggleClass( 'hide' );
			searchToggle.toggleClass( 'hide' );
		} );
	}

	function navigationControl() {
		var target;

		/**
		 * Navigation sub menu show and hide
		 *
		 * Show sub menus with an arrow click to work across all devices.
		 * This switches classes and changes the icon.
		 */
		$( '.page_item_has_children > a, .menu-item-has-children > a' ).each( function() {
			$( this ).append( button );
		} );
		$( '.children' ).each(function() {
			$( this ).closest( 'li' ).find( '> a' ).append( button );
		});
		$( '.showsub-toggle' ).click( function( e ) {
			var $this = $( this );
			var $screenReaderText = $( this ).find( '.screen-reader-text' );
			e.preventDefault();
			$this.toggleClass( 'sub-on' );
			$screenReaderText.text( $screenReaderText.text() == menuToggleText.open ? menuToggleText.close : menuToggleText.open );
			$this.parent().next( '.children, .sub-menu' ).toggleClass( 'sub-on' );
			$this.attr( 'aria-expanded', 'false' == $this.attr( 'aria-expanded' ) ? 'true' : 'false' );
		} );

		/**
		 * Clicking away from the mini-menu popup will close it.
		 */
		$document.on( 'click', function( e ) {
			var $toggle = $( '.mini-menu-container .showsub-toggle.sub-on' );
			if ( $toggle.length > 0 && (
					! $( e.target ).is( '.mini-menu-container .showsub-toggle' ) &&
					! $( e.target ).closest( '.showsub-toggle' ).is( '.mini-menu-container .showsub-toggle' ) ) ) {
				$toggle.parent().next( '.children, .sub-menu' ).removeClass( 'sub-on' );
				$toggle.attr( 'aria-expanded', 'false' ).removeClass( 'sub-on' );
			}
		} );

		/**
		 * Performs a smooth page scroll to an anchor on the same page.
		 * Ignore Aesop Story Engine ids and comment paging.
		 * https://css-tricks.com/snippets/jquery/smooth-scrolling/
		 */
		$( 'a[href*="#"]:not([href="#"]):not([href*="#comments"]):not([data-action="toggle-overlay"]):not([id^="aesop"])' ).click( function() {
		    if ( location.pathname.replace( /^\//, '' ) === this.pathname.replace( /^\//, '' ) && location.hostname === this.hostname ) {
		      target = $( this.hash );
		      target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
		      if ( target.length ) {

				headroom.tolerance = Number.MAX_SAFE_INTEGER;
				headroom.unpin();

				$( 'html,body' ).animate( {
		          scrollTop: target.offset().top
		        }, 500 );

				setTimeout( function() {
					headroom.tolerance = Headroom.options.tolerance;
				}, 1000 );

				return false;
		      }
			}
		});

		/**
		 * Aesop enhancements.
		 *
		 * Disable headroom while we're scrolling to a chapter or timeline point.
		 */
		$document.on( 'click', '.scroll-nav__link', function() {
			headroom.tolerance = Number.MAX_SAFE_INTEGER;
			headroom.unpin();
			setTimeout( function() {
				headroom.tolerance = Headroom.options.tolerance;
			}, 1000 );
		});

		/**
		 * Clicking on a list item will be passed on to its child link.
		 */
		$document.on( 'click', '.scroll-nav__item', function() {
			if ( !! $( this ).children( '.scroll-nav__link' ).get( 0 ) ) {
				$( this ).children( '.scroll-nav__link' ).get( 0 ).click();
			}
		});

		/**
		 * Close chapter overlay when jumping to chapter.
		 */
		chapterOverlay.on( 'click', '.scroll-nav__link', function() {
			body.removeClass( 'overlay-open' );
			chapterToggle.removeClass( 'toggle-on' );
			chapterToggle.attr( 'aria-expanded', 'false' );
			chapterOverlay.removeClass( 'show' ).resize();
			menuToggle.removeClass( 'hide' );
			searchToggle.removeClass( 'hide' );
			bookmarkIcon.dispatchEvent( clickEvent );
		} );
	}

	/**
	 * Close overlay with escape key
	 */
	$document.keyup( function( e ) {
		if ( 27 === e.keyCode && menuOverlay.hasClass( 'show' ) ) {
			body.removeClass( 'overlay-open' );
			menuToggle.removeClass( 'toggle-on hide' );
			menuToggle.attr( 'aria-expanded', 'false' );
			menuOverlay.removeClass( 'show' ).resize();
			searchToggle.removeClass( 'hide' );
			chapterToggle.removeClass( 'hide' );
			menuIcon.dispatchEvent( clickEvent );
		}

		if ( 27 === e.keyCode && searchOverlay.hasClass( 'show' ) ) {
			body.removeClass( 'overlay-open' );
			searchToggle.removeClass( 'toggle-on' );
			searchToggle.attr( 'aria-expanded', 'false' );
			searchOverlay.removeClass( 'show' ).resize();
			menuToggle.removeClass( 'hide' );
			chapterToggle.removeClass( 'hide' );
			searchIcon.dispatchEvent( clickEvent );
		}

		if ( 27 === e.keyCode && chapterOverlay.hasClass( 'show' ) ) {
			body.removeClass( 'overlay-open' );
			chapterToggle.removeClass( 'toggle-on' );
			chapterToggle.attr( 'aria-expanded', 'false' );
			chapterOverlay.removeClass( 'show' ).resize();
			menuToggle.removeClass( 'hide' );
			searchToggle.removeClass( 'hide' );
			bookmarkIcon.dispatchEvent( clickEvent );
		}
	} );

	/**
	 * Loader for all the theme functions: props to Resonar for resizing
	 */
	$window.on( 'resize', function() {
		clearTimeout( resizeTimer );
		resizeTimer = setTimeout( function() {
		}, 100 );
	} );

	$document.ready( function() {
		initHeader();
		overlayControl();
		navigationControl();
	} );

} )( jQuery );
