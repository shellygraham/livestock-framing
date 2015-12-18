<?php
/*
Plugin Name: Livestock Page Properties
Description: Misc adjustments to pages to support the Livestock theme
Version: 1.0
Author: Joey Yax @ Grady Britton
Author URI: http://gradybritton.com
*/


class Livestock_Page_Properties {
	private $nicename = 'livestock_page_properties';
	private $post_type = 'page';
	private $use_on_hp = true;

	function __construct() {

		// meta box
		add_action( 'add_meta_boxes', array( $this, 'mk_meta_box' ) ); // create
		add_action( 'save_post',  array( $this, 'metabox_save' ) ); // save

	}

	// create meta box
	public function mk_meta_box() {
		global $post;

		if ( $post->ID == get_option( 'page_on_front' ) && $this->use_on_hp == false ) return; 

		// register js
		wp_register_script( $this->nicename . '-script', plugins_url( '/metabox/properties/script.js', __FILE__), 1 );
		wp_localize_script( $this->nicename . '-script', $this->nicename . '_page_params', array(
			'url' => get_bloginfo( 'url' ),
			'plugin_dir' => plugin_dir_path( __FILE__ ),
			'template_dir' => get_bloginfo( 'template_directory' )
		) );

		// register css
		wp_register_style( $this->nicename . '-style', plugins_url( '/metabox/properties/style.css', __FILE__ ), 1 );

		add_meta_box( $this->nicename . '_metabox', 'Page Properties', array( $this, 'metabox_content' ), $this->post_type, 'normal', 'low' );
	}

	public function metabox_content() {
		global $post;

		// custom fields
		$custom = get_post_custom( $homepage_id );
		$subhead = $custom['subhead'][0];

		// template
		include_once( plugin_dir_path( __FILE__ ) . 'metabox/properties/template.php' );

		// styles
		wp_enqueue_style( $this->nicename . '-style' );

		// js
		wp_enqueue_script( 'jquery' );
		wp_enqueue_media();
		wp_enqueue_script( $this->nicename . '-script' );
	}

	public function metabox_save() {
		global $post;

		// Do nothing on auto save.
		if ( defined( 'DOING_AUTOSAVE' ) && true === DOING_AUTOSAVE ) { return; }

		// Save post meta.
		update_post_meta( $post->ID, 'title', $_POST['title'] );
		update_post_meta( $post->ID, 'subhead', $_POST['subhead'] );

	}

	public function the_header_classes( $options = array() ) {
		global $post;

		if ( isset( $options['additional_classes'] ) ) {
			foreach( $options['additional_classes'] as $key => $class ) {
				$nav_classes[$key] = $class;
			}
		}

	    $custom = get_post_custom( $post->ID );
		$subhead = $custom['subhead'][0];

		$nav_classes['subhead'] = ( $subhead != '' ? 'has-supporting-copy' : 'no-supporting-copy' );

	    array_filter( $nav_classes );

	    $nav_classes_str = implode( ' ', $nav_classes );

		echo 'class="' . $nav_classes_str . '"';
	}

	public function get_page_custom( $pid = null ) {
		global $post;
		$pid = ( $pid == null ? $post->ID : $pid );
		$custom = get_post_custom( $pid );
		$data['subhead'] = $custom['subhead'][0];

		return $data;
	}


}

$livestock_page_properties = new Livestock_Page_Properties();
