/**
 * Custom js for theme
 */

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
		menuIcon = $( '#svg-icon-menu-icon' ).length > 0 ? new SVGMorpheus( '#svg-icon-menu-icon', morpheusConfig ) : undefined,
		searchIcon = $( '#svg-icon-search-icon' ).length > 0 ? new SVGMorpheus( '#svg-icon-search-icon', morpheusConfig ) : undefined,
		bookmarkIcon = $( '#svg-icon-bookmark-icon' ).length > 0 ? new SVGMorpheus( '#svg-icon-bookmark-icon', morpheusConfig ) : undefined;

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

			menuIcon.to( $this.hasClass( 'toggle-on' ) ? 'svg-icon-menu-close' : 'svg-icon-menu' );

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

			searchIcon.to( $this.hasClass( 'toggle-on' ) ? 'svg-icon-search-close' : 'svg-icon-search' );

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

			bookmarkIcon.to( $this.hasClass( 'toggle-on' ) ? 'svg-icon-bookmark-close' : 'svg-icon-bookmark' );

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
			bookmarkIcon.to( 'svg-icon-bookmark' );
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
			menuIcon.to( 'svg-icon-menu' );
		}

		if ( 27 === e.keyCode && searchOverlay.hasClass( 'show' ) ) {
			body.removeClass( 'overlay-open' );
			searchToggle.removeClass( 'toggle-on' );
			searchToggle.attr( 'aria-expanded', 'false' );
			searchOverlay.removeClass( 'show' ).resize();
			menuToggle.removeClass( 'hide' );
			chapterToggle.removeClass( 'hide' );
			searchIcon.to( 'svg-icon-search' );
		}

		if ( 27 === e.keyCode && chapterOverlay.hasClass( 'show' ) ) {
			body.removeClass( 'overlay-open' );
			chapterToggle.removeClass( 'toggle-on' );
			chapterToggle.attr( 'aria-expanded', 'false' );
			chapterOverlay.removeClass( 'show' ).resize();
			menuToggle.removeClass( 'hide' );
			searchToggle.removeClass( 'hide' );
			bookmarkIcon.to( 'svg-icon-bookmark' );
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
