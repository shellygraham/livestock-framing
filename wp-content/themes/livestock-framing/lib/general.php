<?php

date_default_timezone_set( 'America/Los_Angeles' );

add_post_type_support( 'attachment', 'page-attributes' );

/*
 * ==========================================================================================
 * Cleanup wordpress head
 * ==========================================================================================
 */
function head_cleanup() {
	// remove header links
	remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
	remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
	remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' );                         // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' );                           // WP version
	if (!is_admin()) {
		wp_deregister_script('jquery');                                   // De-Register jQuery
	}
}
add_action('init', 'head_cleanup');


/*
 * ==========================================================================================
 * Force uploads into /wp-content/uploads dir. Adjust URLS. (WP 3.5 doesn't have settings for this in
 * admin anymore
 * ==========================================================================================
 */
$upload_dir = wp_upload_dir();
add_filter( 'upload_dir', 'mv_uploads' );
function mv_uploads($upload) {
	global $selected_environment;
	$dir = '/wp-content/uploads';
	$upload['path']	= $selected_environment['uploads']->dir;
  $upload['url']		= $selected_environment['uploads']->url;
	$upload['subdir']	= '';
  $upload['basedir']	= $selected_environment['uploads']->dir;
  $upload['baseurl']	= $selected_environment['uploads']->url;
  return $upload;
}

// echo '<pre>' . print_r( wp_upload_dir(), 1 ) . '</pre>';

/*
 * ==========================================================================================
 * Fire after an asset is uploaded. Potentially used to sync uploads to a CDN.
 * ==========================================================================================
 */
// function post_upload_hook( $post_id ) {
//     $src = wp_get_attachment_image_src( $post_id, 'full' )[0];
//     shell_exec( 'echo ' . $src . ' >> ~/Sites/cleanenergyworks/public/upload.txt' );
//     return $post_id;
// }

// add_filter('add_attachment', 'post_upload_hook', 10, 2);

/*
 * ==========================================================================================
 * Remove height and width attributes inserted via wp media
 * ==========================================================================================
 */

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');

function fixed_img_caption_shortcode($attr, $content = null) {
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}

	$output = apply_filters('img_caption_shortcode', '', $attr, $content);

	if ( $output != '' ) return $output;

	extract( shortcode_atts( array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => 'aaa'
	), $attr ) );

	if ( 1 > (int) $width || empty($caption) ) return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

/*
 * ==========================================================================================
 * Remove Wordpress version number from RSS
 * ==========================================================================================
 */
function rss_version() { return ''; }
add_filter('the_generator', 'rss_version');


/*
 * ==========================================================================================
 * Removes the annoying […] to a Read More link
 * ==========================================================================================
 */
function excerpt_more($more) {
	global $post;
	// edit here if you like
	return '';
	// return ' &rsaquo; <a href="'. get_permalink($post->ID) . '" class="read_more" title="Read '.get_the_title($post->ID).'">read more</a>';
}
add_filter('excerpt_more', 'excerpt_more');
function excerpt_read_more_link( $output ) {
 global $post;
 return substr( $output, 0, -5 ) . '&hellip; <a href="'. get_permalink($post->ID) . '" class="read_more" title="Read '.get_the_title($post->ID).'">read more</a>';
}
add_filter( 'the_excerpt', 'excerpt_read_more_link' );



/*
 * ==========================================================================================
 * Removes the annoying […] to a Read More link
 * ==========================================================================================
 */

function custom_excerpt_length( $length ) {
   return 20;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 9 );

/*
 * ==========================================================================================
 * Remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
 * ==========================================================================================
 */
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


/*
 * ==========================================================================================
 * Remove autop
 * ==========================================================================================
 */
// remove_filter('the_content', 'wpautop');


/**
 * ==========================================================================================
 * function to load all site scripts
 * ==========================================================================================
 *
 * @return boolean true
 */
function site_scripts() {

  // register and enqueue jQuery -- native WP jQuery has been removed in head_cleanup()
	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', null, '2.1.3', false );
	wp_enqueue_script( 'jquery' );

	// register, enqueue and localize site js
	wp_register_script( apply_filters( 'theme_js', 'js' ), get_template_directory_uri() . '/assets/js/compiled.min.js', '', '1.1', true );
	wp_enqueue_script( apply_filters( 'theme_js', 'js' ) );
	wp_localize_script( 'js', 'js_params', array(
		'url' => get_bloginfo( 'url' ),
		'template_dir' => get_bloginfo( 'template_directory' )
	) );

	return true;
}

// only need to load scripts on frontend
if ( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'site_scripts' );
}

/*
 * ==========================================================================================
 * Get page/post id by slug
 * ==========================================================================================
 */

function get_page_id_by_slug($page_slug) {
    $page = get_page_by_path( $page_slug );
    return ( $page ? $page->ID : null );
}


/*
 * ==========================================================================================
 * Twitter Bootstrap style pagination
 * ==========================================================================================
 */

function bootstrap_pagination($pages = '', $range = 2) {
	$showitems = ($range * 2)+1;

	global $paged;

	if(empty($paged)) $paged = 1;

	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}

	if( 1 != $pages ) {
		echo '<div class="pagination-container"><ul class="pagination pagination-centered pagination-chokit">';
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
		if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

		for ($i=1; $i <= $pages; $i++) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
			}
		}

		if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
		if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
		echo '</ul></div>' . "\n";
	}
}
