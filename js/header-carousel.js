( function () {
	'use strict';

	var SWITCH_DELAY = 6000;
	var FADE_DURATION = 900;
	var FADE_SWAP_DELAY = FADE_DURATION / 2;

	function applyImage( container, url, onReady ) {
		var bg = container.querySelector( '.header-image-bg' );
		var img = container.querySelector( 'img' );
		var isDone = false;
		var fallbackTimer;

		function done() {
			if ( isDone ) {
				return;
			}
			isDone = true;
			if ( fallbackTimer ) {
				window.clearTimeout( fallbackTimer );
			}
			if ( typeof onReady === 'function' ) {
				onReady();
			}
		}

		if ( bg ) {
			bg.style.backgroundImage = 'url("' + url + '")';
		}

		if ( img ) {
			if ( img.currentSrc === url || img.src === url ) {
				done();
				return;
			}

			fallbackTimer = window.setTimeout( done, 1500 );
			img.addEventListener( 'load', done, { once: true } );
			img.addEventListener( 'error', done, { once: true } );
			img.src = url;
			return;
		}

		done();
	}

	function updateDots( dots, activeIndex ) {
		dots.forEach( function ( dot, index ) {
			var isActive = index === activeIndex;
			dot.classList.toggle( 'is-active', isActive );
			dot.setAttribute( 'aria-selected', isActive ? 'true' : 'false' );
		} );
	}

	function createDots( container, images, onSelect ) {
		var nav = document.createElement( 'div' );
		nav.className = 'header-carousel-dots';
		nav.setAttribute( 'role', 'tablist' );
		nav.setAttribute( 'aria-label', 'Navigation carousel' );

		var dots = images.map( function ( _url, index ) {
			var dot = document.createElement( 'button' );
			dot.type = 'button';
			dot.className = 'header-carousel-dot';
			dot.setAttribute( 'role', 'tab' );
			dot.setAttribute( 'aria-label', 'Slide ' + ( index + 1 ) );
			dot.addEventListener( 'click', function () {
				onSelect( index );
			} );
			nav.appendChild( dot );
			return dot;
		} );

		container.appendChild( nav );
		return dots;
	}

	function startCarousel( container ) {
		var rawImages = container.getAttribute( 'data-carousel-images' );
		if ( ! rawImages ) {
			return;
		}

		var images = [];
		try {
			images = JSON.parse( rawImages );
		} catch ( error ) {
			return;
		}

		if ( ! Array.isArray( images ) || images.length < 2 ) {
			return;
		}

		var currentIndex = 0;
		var isPaused = false;
		var dots = [];
		var isTransitioning = false;

		function goToIndex( nextIndex ) {
			if ( isTransitioning || nextIndex === currentIndex ) {
				return;
			}

			isTransitioning = true;
			container.classList.add( 'is-fading' );

			window.setTimeout( function () {
				applyImage( container, images[ nextIndex ], function () {
					currentIndex = nextIndex;
					updateDots( dots, currentIndex );

					// Let the browser paint the new image at low opacity before fading back in.
					window.requestAnimationFrame( function () {
						container.classList.remove( 'is-fading' );
					} );

					window.setTimeout( function () {
						isTransitioning = false;
					}, FADE_SWAP_DELAY );
				} );
			}, FADE_SWAP_DELAY );
		}

		dots = createDots( container, images, function ( index ) {
			goToIndex( index );
		} );
		updateDots( dots, currentIndex );

		container.addEventListener( 'mouseenter', function () {
			isPaused = true;
		} );

		container.addEventListener( 'mouseleave', function () {
			isPaused = false;
		} );

		window.setInterval( function () {
			if ( isPaused || isTransitioning ) {
				return;
			}
			goToIndex( ( currentIndex + 1 ) % images.length );
		}, SWITCH_DELAY );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		var carousels = document.querySelectorAll( '.header-image[data-carousel-images]' );
		carousels.forEach( startCarousel );
	} );
}() );
