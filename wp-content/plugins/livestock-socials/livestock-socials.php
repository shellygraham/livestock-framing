<?php
/*
Plugin Name: Livestock Socials
Description: Simple plugin providing space to define socials as WP Options
Version: 1.0
Author: Joey Yax @ Grady Britton
Author URI: http://gradybritton.com
*/


if ( ! class_exists( 'Livestock_Socials' ) ) {
	class Livestock_Socials {
		private $nicename = 'livestock_socials';

		function __construct() {
			add_action( 'admin_menu', array( $this, 'mk_submenu' ) );
			add_action( 'admin_init', array( $this, 'register_settings') );
			wp_register_script( $this->nicename . '-script', plugins_url( 'submenus/settings/script.js', __FILE__), 1 );
			wp_register_style( $this->nicename . '-style', plugins_url( '/submenus/settings/style.css', __FILE__ ), 1 );
		}

		// create submenu
		public function mk_submenu() {
			add_submenu_page(
		      	'options-general.php', // parent
		        'Socials', // page title
		        'Socials', // menu title
		        'manage_options', // capability
		        'socials-settings', // menu slug
		        array( $this, 'settings_content' ) // content
	    	);
		}

		public function settings_content() {
			include_once( plugin_dir_path( __FILE__ ) . 'submenus/settings/settings.php' );
			wp_enqueue_style( $this->nicename . '-style' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_media();
			wp_enqueue_script( $this->nicename . '-script' );
		}

		public function register_settings() {

			register_setting( 'livestock-socials-group', 'social_twitter' );
			register_setting( 'livestock-socials-group', 'social_facebook' );
			register_setting( 'livestock-socials-group', 'social_instagram' );
			register_setting( 'livestock-socials-group', 'social_youtube' );
			register_setting( 'livestock-socials-group', 'social_linkedin' );

		}

		public function get_social( $network ) {
			return get_option( 'social_' . strtolower( $network ) );
		}

		public function get_socials() {
			if ( get_option( 'social_twitter' ) ) $socials['twitter'] = get_option( 'social_twitter' );
			if ( get_option( 'social_facebook' ) ) $socials['facebook'] = get_option( 'social_facebook' );
			if ( get_option( 'social_instagram' ) ) $socials['instagram'] = get_option( 'social_instagram' );
			if ( get_option( 'social_youtube' ) ) $socials['youtube'] = get_option( 'social_youtube' );
			if ( get_option( 'social_linkedin' ) ) $socials['linkedin'] = get_option( 'social_linkedin' );
			return $socials;
		}

		public function get_username( $network, $url ) {
			switch( $network ) {
				case 'twitter' :
					preg_match( "|https?://(www\.)?twitter\.com/(#!/)?@?([^/]*)|", $url, $matches );
					$username = $matches[3];
				break;
			}
			return $username;
		}

		public function get_path() {
			return plugins_url( null, __FILE__ );
		}
		
	}

	$livestock_socials = new Livestock_Socials();
}
else {
	throw new Exception( 'The Livestock Socials plugin is already active.' );
}
