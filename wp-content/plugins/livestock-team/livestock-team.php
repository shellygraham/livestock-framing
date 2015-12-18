<?php
/*
Plugin Name: Livestock Team
Description: Define livestock team
Version: 1.0
Author: Joey Yax @ Grady Britton
Author URI: http://gradybritton.com
*/


class Livestock_Team {
	private $nicename = 'livestock_team';

	function __construct() {

		// post type
		add_action( 'init', array( $this, 'mk_post_type' ) );

		// meta box
		add_action( 'add_meta_boxes', array( $this, 'mk_meta_box' ) ); // create
		add_action( 'save_post',  array( $this, 'metabox_save' ) ); // save

		// shortcode
		add_shortcode( 'team', array( $this, 'sc_team' ) );
	}

	public function mk_post_type() {
		register_post_type( $this->nicename, array(
			'public'				=> false,
			'show_ui'				=> true,
			'menu_icon'				=> 'dashicons-groups',
			'capability_type'		=> 'page',
			'rewrite'				=> array( 'slug' => $this->slug, 'with_front' => false ),
			'can_export'			=> true,
			'hierarchical'			=> false,
			'has_archive'			=> false,
			'supports'				=> array(
				'title',
				'editor',
				'excerpt',
				'revisions'
			),
			'show_in_menu'			=> true,
			'show_in_nav_menus'		=> false,
			'exclude_from_search'	=> true,
			'labels'				=> array(
				'name'					=> 'Team',
				'singular_name'			=> 'Team Member',
				'add_new'				=> 'Add New',
				'all_items'				=> 'All Team Members',
				'add_new_item'			=> 'Add New Team Members',
				'edit_item'				=> 'Edit Team Members',
				'new_item'				=> 'New Team Members',
				'view_item'				=> 'View Team Members',
				'search_items'			=> 'Search Team Members',
				'not_found'				=> 'No team members found',
				'not_found_in_trash'	=> 'No team members found in Trash'
			)
		) );
	}

	// create meta box
	public function mk_meta_box() {
		global $post;

		// register js
		wp_register_script( $this->nicename . '-script', plugins_url( '/metabox/script.js', __FILE__), 1 );
		wp_localize_script( $this->nicename . '-script', $this->nicename . '_params', array(
			'url' => get_bloginfo( 'url' ),
			'plugin_dir' => plugin_dir_path( __FILE__ ),
			'template_dir' => get_bloginfo( 'template_directory' )
		) );

		// register css
		wp_register_style( $this->nicename . '-style', plugins_url( '/metabox/style.css', __FILE__ ), 1 );

		add_meta_box( $this->nicename . '_metabox', 'Team Attributes', array( $this, 'metabox_content' ), $this->nicename, 'normal', 'low' );
	}

	public function metabox_content() {
		global $post;

		// custom fields
		$data = $this->get_page_custom( $post->ID );

		// template
		include_once( plugin_dir_path( __FILE__ ) . 'metabox/template.php' );

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
		update_post_meta( $post->ID, 'photo', $_POST['photo'] );
		update_post_meta( $post->ID, 'role', $_POST['role'] );

	}

	public function get_page_custom( $pid ) {
		$custom = get_post_custom( $pid );
		$data['photo'] = $custom['photo'][0];
		$data['role'] = $custom['role'][0];

		return $data;
	}

	public function get_team_template() {
		$team = get_posts( array(
			'post_type' => $this->nicename,
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => -1
		) );

		foreach ( $team as $key => $post ) {
			$custom = $this->get_page_custom( $post->ID );
			$post->photo = $custom['photo'];
			$post->role = $custom['role'];
		}

		ob_start();
		include( locate_template( 'parts/part-team.php' ) );
		$output = ob_get_clean();
		return $output;
	}

	public function sc_team() {
		global $post;
		return $this->get_team_template();
	}


}

$livestock_team = new Livestock_Team();
