;( function ( $ ) {
  // Uploading files
  var file_frame,
  	wp_media_post_id = wp.media.model.settings.post.id, // Store the old id
  	set_to_post_id = 0, // Set this
  	input_field,
  	title,
  	btn_text;

  var sections = {};

  jQuery(function() {
    var $ = jQuery;

  	// uploads
    $('#livestock_components_metabox').on( 'click', '.button-upload', function( e ) {

  		e.preventDefault();

  		input_field = jQuery( this ).data( 'input-field' ),
  		title = jQuery( this ).data( 'uploader-title' ),
  		btn_text = jQuery( this ).data( 'uploader-button-text' );

  		// If the media frame already exists, reopen it.
  		if ( file_frame ) {
  			file_frame.uploader.uploader.param( 'post_id', set_to_post_id ); // Set the post ID to what we want
  			file_frame.open(); // Open frame
  			return;
  		}
  		else {
  			wp.media.model.settings.post.id = set_to_post_id; // Set the wp.media post id so the uploader grabs the ID we want when initialised
  		}

  		// Create the media frame.
  		file_frame = wp.media.frames.file_frame = wp.media({
  			title: title,
  			button: {
  				text: btn_text,
  			},
  			multiple: false
  		});

  		// When an image is selected, run a callback.
  		file_frame.on( 'select', function() {
  			// We set multiple to false so only get one image from the uploader
  			attachment = file_frame.state().get('selection').first().toJSON();

  			// Do something with attachment.id and/or attachment.url here

  			// alert( attachment.url );
  			$( '[name="' + input_field + '"]' ).val( attachment.url );

  			// Restore the main post ID
  			wp.media.model.settings.post.id = wp_media_post_id;
  		});

  		// Finally, open the modal
  		file_frame.open();

  	});

    // jquery ui plugin to allow sections to be sorted
    $( ".sections" ).sortable({
      placeholder: "movement-placeholder",
      handle: ".handle",
      update: function( event, ui ) {
        $( '.section' ).each( function( index ) {
          $( 'select', $( this ) ).each( function() {

            var parts = $( this ).attr( 'name' ).match( /[^[\]]+(?=])/g );

            if ( parts == null ) return;

            parts[0] = index; // assign new index

            var name = 'options';
            $.each( parts, function( index, val ) {
              name = name + '[' + val + ']';
            });

            $( this ).attr( 'name', name );

          });
        });
      }
    });
    $( ".sections" ).disableSelection();

    // toggle display of options for section
    $( 'body' ).on( 'click', '.action-toggle', function( e ) {
        e.preventDefault();

        var $this = $( this ),
            $icon = $this,
            $section = $this.parents( '.section' ),
            $options = $section.find( '.options' );

        if ( $options.hasClass( 'hidden' ) ) {
          $icon.addClass( 'flip' );
          // $icon.removeClass( 'fa-chevron-down' ).addClass( 'fa-chevron-up' );
          $options.removeClass( 'hidden' );
        }
        else {
          $icon.removeClass( 'flip' );
          // $icon.removeClass( 'fa-chevron-up' ).addClass( 'fa-chevron-down' );
          $options.addClass( 'hidden' );
        }
    });

    // delete page / component
    $( 'body' ).on( 'click', '.action-remove', function( e ) {
        e.preventDefault();

        var $this = $( this ),
            $section = $this.parents( '.section' );

        $section.remove();
    });

    // delete page / component
    $( 'body' ).on( 'click', '.button-add-section', function( e ) {
        e.preventDefault();

        var $sections = $( 'ul.sections' );

        $.ajax({
          url: $( this ).attr( 'href' ),
          cache: true,
          async: true,
          dataType: 'json',
          complete: function( data, status ) {
            // console.dir( data );
            $sections.append( data.responseText );
          },
          error: function() {}
        });

        // $( '.section-data > li' ).clone().appendTo( 'ul.sections' );

    });

    // get options
    $( 'body' ).on( 'change', '.section .title select', function( e ) {
        e.preventDefault();

        var $sections = $( 'ul.sections' ),
            $$ = $( this ),
            $section = $$.parents( '.section' );

            var section_parts = $( ':selected', $$ ).val().split( ':' );
            var section_type = section_parts[0];
            var section_id = section_parts[1];

  			index = $sections.find( '.section' ).length - 1;

  			if ( $$.find( ':selected' ).val() == '' ) {
  				$section.find( '.options' ).html( 'Select a component above. If it has options they will appear here.' );
  				return;
  			}

        $.ajax({
          url: livestock_components.url + '?action=livestock_components_get_section_options&post_id=' + livestock_components.post_id + '&section_name=' + section_id + '&index=' + index,
          cache: true,
          async: false,
          dataType: 'json',
          complete: function( data, status ) {
            // console.log( data.responseText );
            $section.find( '.options' ).html( data.responseText );

  					// setTimeout( function() {
  					// 	tinyMCE.init({
  					// 			menubar : false,
  					// 			mode : "textareas",
  					// 			// elements: "section_content",
  					// 			// theme : "simple",
  					// 			skin: 'wp_theme'
  					// 	});
  					// }, 500 );

          },
          error: function() {}
        });

        // $( '.section-data > li' ).clone().appendTo( 'ul.sections' );

    });

    // check if livestock_components has sections - if so, get 'em!
    if ( typeof livestock_components.sections != 'undefined' ) {
      var sections = livestock_components.sections;
      var $sections = $( 'ul.sections' );

      $.each( sections, function( index, value ) {
        var section_parts = value.split( ':' );
        var section_type = section_parts[0];
        var section_id = section_parts[1];

        var new_data = livestock_components.url_data + '&type=' + section_type + '&id=' + section_id + '&index=' + index;

  			if ( value == '' ) {
  				$section.find( '.options' ).html( 'Select a component above. If it has options they will appear here.' );
  				return;
  			}

        $.ajax({
          url: livestock_components.url,
          data: new_data,
          cache: true,
          async: false,
          dataType: 'json',
          complete: function( data, status ) {
            $sections.append( data.responseText );

            $.ajax({
              url: livestock_components.url + '?action=livestock_components_get_section_options&post_id=' + livestock_components.post_id + '&section_name=' + section_id + '&index=' + index,
              cache: false,
              async: false,
              dataType: 'json',
              complete: function( data, status ) {
                // console.log( data.responseText );
                $( '.section' ).eq( index ).find( '.options' ).html( data.responseText );

  							// tinyMCE.init({
  							// 		menubar : false,
  							// 		mode : "textareas",
  							// 		// elements: "section_content",
  							// 		// theme : "simple",
  							// 		skin: 'wp_theme'
  							// });
              },
              error: function() {}
            });
          },
          error: function() {}
        });
      });
    }

  	// $( window ).on( 'load', function() {
  	//
  	// 	$( '.has-dependency' ).each( function() {
  	//
  	// 		var $this = $( this ),
  	// 				$container = $( $this.parent( '.section' ).attr( 'id' ) ),
  	// 				field = $this.data( 'dependency' ),
  	// 				value = $this.data( 'dependency-value' );
  	//
  	// 		// $container.find( '' )
  	//
  	// 		$( '[name="' + field + '"]' ).on( 'change', function() {
  	//
  	// 			if ( $( this ).is( '[type="checkbox"]' ) || $( this ).is( '[type="radio"]' ) ) {
  	// 				$status = ( $( this ).is( ':checked' ) && $( this ).val() == value ? true : false );
  	// 			}
  	// 			else {
  	// 				$status = ( $( this ).val() == value ? true : false );
  	// 			}
  	//
  	// 			if ( $status ) {
  	// 				$this.addClass( 'dependency-met' );
  	// 			}
  	// 			else {
  	// 				$this.removeClass( 'dependency-met' );
  	// 			}
  	// 		} );
  	//
  	// 	} );
  	// } )
  });
} ) ( jQuery );
