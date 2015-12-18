$( function() {  

  Waves.displayEffect();
  new WOW().init();

  var $body = $( 'body' ),
      $navbar = $( '.navbar.navbar-livestock' ),
      $navPrimary = $navbar.find( '.nav-primary' ),
      $navMeta = $navbar.find( '.nav-meta' ),
      navbarHeight = $navbar.outerHeight(),
      adminBarHeight = ( $( '#wpadminbar' ).length > 0 ? $( '#wpadminbar' ).outerHeight() : 0 );
      scrollOffset = adminBarHeight + navbarHeight
      activePriceItem = 0;

  var hash = window.location.hash;

  function getUrlParameter( sParam ) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
      var sParameterName = sURLVariables[i].split('=');
      if (sParameterName[0] == sParam) {
        return sParameterName[1];
      }
    }
  }

  $.isMobile = function() {
    if ( $( window ).width() <= 768 ) {
      return true;
    }
    return false;
  }

  $.adjustForFixedItems = function() {
    if ( $( 'section.intro.fixed' ).length > 0 ) {
      $body.css( 'padding-top', $( window ).height() );
    }
    if ( $( 'footer.fixed' ).length > 0 ) {
      $( 'section:last' ).css( 'margin-bottom', $( 'footer' ).outerHeight() );
    }
  }

  $.scrollTo = function( el ) {
    el = el.replace( '!/', '' );
    
    // check for colon in string
    var el_arr = el.split( ':' );

    if ( $( el_arr[0] ).length > 0 ) {
      var el_pos = $( el_arr[0] ).position().top;
      var scrollTo = el_pos - scrollOffset;
      $( 'html, body' ).animate({ scrollTop: scrollTo }, 500 );
      if ( el_arr[0].indexOf( '#' ) >= 0 ) {
        window.location.hash = '!/' + el_arr[0].replace( '#', '' );
      }
    }
  }

  $.checkPricesScaleHeight = function() {
    if ( $( 'section.prices' ).hasClass( 'show-scale' ) ) {
      $( 'section.prices .prices-grid .item .inner' ).css( 'height', $( window ).height() - 400 );
    }
    else {
      $( 'section.prices .prices-grid .item .inner' ).css( 'height', '' );
    }
  }

  $.checkPricesNav = function() {
    var min = 0,
        max = $( '.prices-grid .item' ).length - 1,
        $active = $( '.prices-grid .item.active' ),
        activeIndex = $active.data( 'index' ),
        $nav = $( '.prices-navigation' ),
        $navPrev = $nav.find( 'a[data-direction="prev"]' ),
        $navNext = $nav.find( 'a[data-direction="next"]' );

    if ( $( '.prices-grid .item' ).length > 1 ) {
      if ( activeIndex <= min ) { $navPrev.addClass( 'hidden' ); } else { $navPrev.removeClass( 'hidden' ); }
      if ( activeIndex >= max ) { $navNext.addClass( 'hidden' ); } else { $navNext.removeClass( 'hidden' ); }
    }
    else {
      $nav.addClass( 'hidden' );
    }
  }

  $.hidePricesScale = function( options ) {

    var settings = $.extend({
        back: true
    }, options );

    var $parent = $( 'section.prices' );
    var $items = $parent.find( '.item' );
    $items.removeClass( 'active hidden' );
    $parent.removeClass( 'show-scale' );
    $parent.css( 'background-image', '' );
    $.checkPricesScaleHeight();
    $.adjustForFixedItems();
    if ( settings.back == true ) {
      window.history.back();
    }
  };

  $( document ).ready( function() {

    // $body.on('activate.bs.scrollspy', function () {
    //   window.location.hash = '';
    // } );

    $( '.navbar-toggle' ).on( 'click tap', function( e ) {
      e.preventDefault();
      var $$ = $( this ),
          $icon = $$.find( 'i' ),
          iconActive = $icon.data( 'icon-active' ),
          iconDefault = $icon.data( 'icon-default' ),
          $target = $( $$.data( 'target' ) );

      if ( ! $target.hasClass( 'in' ) ) {
        $icon.removeClass( iconDefault ).addClass( iconActive );
      }
      else {
        $icon.removeClass( iconActive ).addClass( iconDefault );
      }
    } )

    // $( '.show-in-modal' ).magnificPopup({
    //   type: 'image',
    //   gallery: { enabled: false },
    //   zoom: {
    //     enabled: true,
    //     duration: 300, 
    //     easing: 'ease-in-out',
    //     opener: function(openerElement) {
    //       return openerElement.is('img') ? openerElement : openerElement.find('img');
    //     }
    //   }
    // });

    $( '.iframe-modal' ).magnificPopup({
      type: 'iframe',
      gallery: { enabled: false },
      zoom: {
        enabled: true,
        duration: 300, 
        easing: 'ease-in-out',
        preloader: true
      }
    });

  
    // If links in primary nav references a hash, but visitor is not on the homepage
    // prefix with fwd slash to send visitor to the right place
    if ( ! $body.hasClass( 'home' ) ) {
      $( $navPrimary ).find( 'a' ).each( function() {
        var $$ = $( this );
        $$.attr( 'href', '/' + $$.attr( 'href' ) );
      })
    }

  
    // close prices grid view mode
    $( '.prices .close' ).on( 'click', function( e ) {
      e.preventDefault();
      $.hidePricesScale();
    } );

    // change view to show scale of frame
    $( '.prices-grid .item' ).on( 'click', function( e ) {
      e.preventDefault();

      if ( $.isMobile() ) return;

      var $parent = $( 'section.prices' );
      var $siblings = $( '.prices-grid .item' );
      var $$ = $( this );

      $siblings.removeClass( 'active' ).addClass( 'hidden' );
      $$.removeClass( 'hidden' ).addClass( 'active' );

      $parent.addClass( 'show-scale' );
      $parent.css( 'background-image', '' );
      $parent.css( 'background-image', 'url(' + $$.data( 'img-lg' ) + ')' );

      window.location.hash = '#!/prices:zoom';
      // history.pushState({ urlPath:'/#!/prices:zoom' },"",'/#!/prices:zoom' );

      $.checkPricesNav();
      $.checkPricesScaleHeight();
      
      $.scrollTo( 'section.prices' );
      
    } );

    // l/r nav between frames in scale view
    $( '.prices-navigation a' ).on( 'click', function( e ) {
      e.preventDefault();
      var $$ = $( this ),
          index = $( '.prices-grid .active' ).data( 'index' ),
          item = ( $$.data( 'direction' ) == 'prev' ? index - 1 : index + 1 );

      $( '.prices-grid .item[data-index="' + item + '"]' ).click();
    } );

    $( document ).keydown( function( e ) {
      if ( $( 'section.prices' ).hasClass( 'show-scale' ) ) {
        switch(e.which) {
            case 27: // esc
              e.preventDefault();
              $.hidePricesScale();
            break;
            case 37: // left
              e.preventDefault();
              $( '.prices-navigation a[data-direction="prev"]' ).click();
              $( '.prices-navigation a[data-direction="prev"]' ).addClass( 'active' );
              setTimeout( function() {
                $( '.prices-navigation a[data-direction="prev"]' ).removeClass( 'active' );
              }, 500 );
            break;
            case 39: // right
              e.preventDefault();
              $( '.prices-navigation a[data-direction="next"]' ).click();
              $( '.prices-navigation a[data-direction="next"]' ).addClass( 'active' );
              setTimeout( function() {
                $( '.prices-navigation a[data-direction="next"]' ).removeClass( 'active' );
              }, 500 );
            break;
            default: return; // exit this handler for other keys
        }
      }
    } );


    $( '.show-in-modal.frame-styles' ).magnificPopup({
      type: 'image',
      preload: [0,4],
      gallery: { enabled: true },
      zoom: {
        enabled: true,
        duration: 300, 
        easing: 'ease-in-out',
        opener: function(openerElement) {
          return openerElement.is('img') ? openerElement : openerElement.find('img');
        }
      }
    });
    
    $body.scrollspy({
      target: $body.data( 'target' ),
      offset: scrollOffset
    });

    $( '.btn' ).addClass( 'waves-effect waves-lights' );

    $( 'a' ).on( 'click tap', function( e ) {
      var $$ = $( this ),
          href = $$.attr( 'href' );

      if ( href.indexOf( '#' ) === 0 ) {
        e.preventDefault();
        $.scrollTo( href );
      }

    } );

  } );
  $( document ).ready( function() {
	  $( window ).on( 'resize', function() {
	
	    // fix scrollspy
	    $( '[data-spy="scroll"]' ).each( function () {
	      var $spy = $( this ).scrollspy( 'refresh' );
	    } );
	
	    // console.log( $( window ).height() );
	    // console.log( $( 'section.intro .container' ) .outerHeight()  );
	    if ( $( window ).width() > 1024 && $( window ).height() > $( 'section.intro .container' ) .outerHeight() ) {
	      $( 'section.intro' ).addClass( 'adjusted-height' ).css(  'height', $( window ).height() - $navbar.height() );
	    }
	    else {
	      $( 'section.intro' ).removeClass( 'adjusted-height' ).css( 'height', '' ); 
	    }
	    
	    // if the admin bar is visible move nav down so it clears it
	    if ( $( '#wpadminbar' ).length > 0 ) {
	      $( '.navbar-fixed-top' ).css( 'top', ( $( '#wpadminbar' ).outerHeight() ) );
	    }
	
	    $.adjustForFixedItems();
	    $.checkPricesScaleHeight();
	
	  } ).resize();

  });

  $( window ).on( 'load', function() {

    var hash = window.location.hash;

    hash = hash.replace( '!/', '' );

    // if hash is defined in address, scroll to it after page renders
    var hash = window.location.hash;
    if ( hash ) { $.scrollTo( hash ); }

    // turn this on after the page loads to movement during initial load
    $body.addClass( 'animation-enabled' );
    $navbar.addClass( 'animation-enabled' );

    if ( $( 'section.intro.fixed' ).length > 0 ) {
      var indicateScrollable = setTimeout( function() {
        // $body.css( 'padding-top', ( $( window ).height() - 90 ) );
        $( 'section' ).eq( 0 ).prepend( '<a class="arrow-wrap animated bounceInUp waves-effect waves-light waves-circle" href="#howitworks"><span class="arrow"></span></a>' );
      }, 4000 );
      
      // if visitor scrolls at all cancel the scroll indicator
      $( window ).on( 'scroll', function() {
        clearTimeout( indicateScrollable );
      } );
    }

  } );

  $( window ).on( 'load scroll', function() {

    // if ( $( '.intro .container' ).length > 0 ) {
      if( $( window ).scrollTop() > ( $( 'section:first .container' ).position().top + $( 'section:first .container' ).outerHeight() ) ) {
       $( '.navbar-livestock' ).removeClass( 'navbar-white' );
       // $( '.navbar-brand' ).removeClass( 'hide-me' );
      }
      else {
        $( '.navbar-livestock' ).addClass( 'navbar-white' );
        $body.css( 'padding-top', $navbar.height() );
        // $( '.navbar-brand' ).addClass( 'hide-me' );
      }
    // }

  } );

  $( window ).on( 'hashchange', function() {
    var hash = window.location.hash;

    hash = hash.replace( '!/', '' );
    
    // check for colon in string
    var hash_arr = hash.split( ':' );

    if ( hash_arr[1] && hash_arr[1] == 'zoom' ) {
      if ( $( 'section.prices .prices-grid .item.active' ).length == 0 ) {
        $( 'section.prices .prices-grid .item:first' ).click();
      }
    }
    else if ( $( 'section.prices' ).hasClass( 'show-scale' ) ) {
      $.hidePricesScale( { back: false } );
    }

  } );
  
  $( document ).ready( 'load', function() {
    $('[id^=masonry-gallery-thumbnails_]').addCss('width','100%');
  });
} );