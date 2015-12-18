<?php

/*
 * ==========================================================================================
 * Buttons
 * ==========================================================================================
 */
function bs_button( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'size' => 'default', /* mini, small, default, large */
	'url'  => ''
	), $atts ) );
	
	if($type == "default"){ $type = ""; }
	else{  $type = "btn-" . $type; }
	
	if($size == "default"){ $size = ""; }
	else{ $size = "btn-" . $size; }
	
	$output = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '">';
	$output .= do_shortcode( $content );
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'bs_button'); 


/*
 * ==========================================================================================
 * Code
 * ==========================================================================================
 */
function bs_code($atts, $content = null) {
 return '<pre><code>' . do_shortcode( $content ) . '</code></pre>';
}
add_shortcode('code', 'bs_code'); 
  


/*
 * ==========================================================================================
 * Row
 * ==========================================================================================
 */
function bs_row( $atts, $content = null ) {
	return '<div class="row">' . do_shortcode( $content ) . '</div>';
}
add_shortcode('row', 'bs_row'); 


/*
 * ==========================================================================================
 * Spans
 * ==========================================================================================
 */
function bs_span1( $atts, $content = null ) { return '<div class="span1">' . do_shortcode( $content ) . '</div>'; }
function bs_span2( $atts, $content = null ) { return '<div class="span2">' . do_shortcode( $content ) . '</div>'; }
function bs_span3( $atts, $content = null ) { return '<div class="span3">' . do_shortcode( $content ) . '</div>'; }
function bs_span4( $atts, $content = null ) { return '<div class="span4">' . do_shortcode( $content ) . '</div>'; }
function bs_span5( $atts, $content = null ) { return '<div class="span5">' . do_shortcode( $content ) . '</div>'; }
function bs_span6( $atts, $content = null ) { return '<div class="span6">' . do_shortcode( $content ) . '</div>'; }
function bs_span7( $atts, $content = null ) { return '<div class="span7">' . do_shortcode( $content ) . '</div>'; }
function bs_span8( $atts, $content = null ) { return '<div class="span8">' . do_shortcode( $content ) . '</div>'; }
function bs_span9( $atts, $content = null ) { return '<div class="span9">' . do_shortcode( $content ) . '</div>'; }
function bs_span10( $atts, $content = null ) { return '<div class="span10">' . do_shortcode( $content ) . '</div>'; }
function bs_span11( $atts, $content = null ) { return '<div class="span11">' . do_shortcode( $content ) . '</div>'; }
function bs_span12( $atts, $content = null ) { return '<div class="span12">' . do_shortcode( $content ) . '</div>'; }
add_shortcode('span1', 'bs_span1');
add_shortcode('span2', 'bs_span2');
add_shortcode('span3', 'bs_span3');
add_shortcode('span4', 'bs_span4');
add_shortcode('span5', 'bs_span5');
add_shortcode('span6', 'bs_span6');
add_shortcode('span6', 'bs_span6');
add_shortcode('span7', 'bs_span7');
add_shortcode('span8', 'bs_span8');
add_shortcode('span9', 'bs_span9');
add_shortcode('span10', 'bs_span10');
add_shortcode('span11', 'bs_span11');
add_shortcode('span12', 'bs_span12');


/*
 * ==========================================================================================
 * Icon
 * ==========================================================================================
 */
function bs_icon( $atts, $content = null ) {
	extract(shortcode_atts(array(
	  "type" => 'type'
	), $atts));
	return '<i class="icon icon-' . $type . '"></i>';
}
add_shortcode('icon', 'bs_icon'); 


/*
 * ==========================================================================================
 * Well
 * ==========================================================================================
 */
function bs_well( $atts, $content = null ) {
  extract(shortcode_atts(array(
    "size" => 'size'
  ), $atts));

  return '<div class="well well-' . $size . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode('well', 'bs_well'); 


/*
 * ==========================================================================================
 * Messages
 * ==========================================================================================
 */
function bs_message( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('message', 'bs_message'); 


/*
 * ==========================================================================================
 * Gallery
 * ==========================================================================================
 */

// remove the standard shortcode
remove_shortcode('gallery', 'gallery_shortcode');

function bs_gallery($attr) {
	global $post, $wp_locale;

	$output = "";

	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
	if ($attachments) {
		$output = '<div class="row-fluid"><ul class="thumbnails">';
		foreach ( $attachments as $attachment ) {
			$output .= '<li class="span2">';
			$att_title = apply_filters( 'the_title' , $attachment->post_title );
			$output .= wp_get_attachment_link( $attachment->ID , 'thumbnail', true );
			$output .= '</li>';
		}
		$output .= '</ul></div>';
	}

	return $output;
}
add_shortcode('gallery', 'bs_gallery');



/*
 * ==========================================================================================
 * Alerts
 * ==========================================================================================
 */
function bs_alert( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}
add_shortcode('alert', 'bs_alert');



/*
 * ==========================================================================================
 * Block Quotes
 * ==========================================================================================
 */
function bs_blockquote( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'bs_blockquote');



/*
 * ==========================================================================================
 * Read More Button
 * ==========================================================================================
 */
function btn_read_more( $atts ) {
	global $post;
	
	$output = '<a class="btn" href="' . get_permalink( $post->ID ) . '">' . __( 'Read More' ) . '</a>';
	
	return $output;
}
add_shortcode('read_more', 'btn_read_more');