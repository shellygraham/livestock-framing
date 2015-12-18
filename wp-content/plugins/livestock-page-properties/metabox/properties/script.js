jQuery( function( $ ) {
	// Uploading files
	var file_frame,
	wp_media_post_id = wp.media.model.settings.post.id,
	set_to_post_id = 0,
	input_field,
	title,
	btn_text;

	$( document ).ready( function() {

		$( '#livestock_page_properties_metabox' ).appendTo( '#titlediv' );

		// if ( $( '#titlediv #inside' ).text() == '' ) {
		// 	$( this ).text( 'permalink will appear here.' );
		// }

		$( '#livestock_page_properties_metabox' ).on( 'click', '.button-upload', function( e ) {

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
				button: { text: btn_text, },
				multiple: false
			});

			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();

				// Do something with attachment.id and/or attachment.url here
				$( '[name="' + input_field + '"]' ).val( attachment.url );

				// Restore the main post ID
				wp.media.model.settings.post.id = wp_media_post_id;
			});

			// Finally, open the modal
			file_frame.open();

		} );

	} );

} );