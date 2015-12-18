<?php
/*
 * ==========================================================================================
 * General theme support
 * ==========================================================================================
 */
function theme_support() {

	add_theme_support('post-thumbnails'); // wp thumbnails (sizes handled in functions.php)

	add_theme_support( 'automatic-feed-links' ); // RSS

	add_theme_support(
			'post-formats', // post formats
		array(
			'aside',   // title less blurb
			'gallery', // gallery of images
			'link',    // quick link to other site
			'image',   // an image
			'quote',   // a quick quote
			'status',  // a Facebook like status update
			'video',   // video
			'audio',   // audio
		)
	);

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	register_nav_menus( array(
		'primary'  => __( 'Primary Navigation', 'Livestock' ),
		'meta'     => __( 'Meta Navigation',	'Livestock' ),
		'footer'  => __( 'Footer Navigation',	'Livestock' )
	) );
}

add_action( 'after_setup_theme', 'theme_support' );
