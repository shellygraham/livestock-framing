jQuery( function( $ ) {
	var $container = $( '.' + properties.container_class ),
		target = properties.target;

	// exit if no hash is defined
	// if ( target == '' ) { $container.html( 'No target was defined.' ); return; }

	// display loading message
	$container.html( properties.loading_message );

	$( document ).ready( function() {
		$.ajax({
			url: properties.url,
			type: 'get',
			async: true,
			beforeSend: function() {
				$container.html( properties.loading_message );
			},
			success: function( data, status ) {

				// hide the container while parsing data
				$container.hide( 0 );

				// retrieve content and temp add to container div so we can search it
				var content = $container.append( data );

				var targets = [];
				$container.find( 'section' ).each( function( index, el ) {
					var id = $( el ).attr( 'id' );
					if ( typeof id != 'undefined') {
						targets.push( '#' + id );
					}
				});

				if ( $.inArray( target, targets ) == -1 ) {
					$container.html( 'Invalid target (' + ( target ? target : 'no target provided' ) + '). Available targets: ' + targets.join( ', ' ) ).show( 0 );
					return;
				}

				// get section content
				body = $container.find( target ).wrap('<p/>').parent().html(); // use temp wrap so we can get the container, not just inner html
				
				// add domain to relative paths
				body = body.replace( new RegExp( properties.url, 'g' ), '' ); // remove url so we don't double up the urls
				body = body.replace( new RegExp( '\/wp-content\/', 'g' ), properties.url + '/wp-content/' ); // add url

				// content
				$container.html( $( body ).unwrap() ).show( 0 );

				// style
				$container.append( '<link rel="stylesheet" href="' + properties.url + '/wp-content/themes/livestock-framing/assets/css/compiled.min.css">' );

				// script
				var script = document.createElement( 'script' );
				script.type = 'text/javascript';
				script.src = properties.url + '/wp-content/themes/livestock-framing/assets/js/compiled.min.js?ver=1.1';
				$container.append( script );
			},
			error: function( data, status ) {
				$container.html( '<strong>Error:</strong> Unable to load content.' );
			}
		});
	})

} );