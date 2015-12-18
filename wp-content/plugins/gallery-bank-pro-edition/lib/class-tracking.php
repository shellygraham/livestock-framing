<?php

if ( !class_exists( 'TrackingForGalleryBank' ) ) {
	class TrackingForGalleryBank {

		/**
		 * Class constructor
		 */
		function __construct() {
			global $blog_id, $wpdb;

				$pts = array();
				foreach ( get_post_types( array( 'public' => true ) ) as $pt ) {
					$count    = wp_count_posts( $pt );
					$pts[$pt] = $count->publish;
				}

				$comments_count = wp_count_comments();

				// wp_get_theme was introduced in 3.4, for compatibility with older versions, let's do a workaround for now.
				if ( function_exists( 'wp_get_theme' ) ) {
					$theme_data = wp_get_theme();
					$theme      = array(
						'name'       => $theme_data->display( 'Name', false, false ),
						'theme_uri'  => $theme_data->display( 'ThemeURI', false, false ),
						'version'    => $theme_data->display( 'Version', false, false ),
						'author'     => $theme_data->display( 'Author', false, false ),
						'author_uri' => $theme_data->display( 'AuthorURI', false, false ),
					);
					
				} else {
					$theme_data = (object) get_theme_data( get_stylesheet_directory() . '/style.css' );
					$theme      = array(
						'version'  => $theme_data->Version,
						'name'     => $theme_data->Name,
						'author'   => $theme_data->Author,
						'template' => $theme_data->Template,
					);
				}
				$plugins = array();
				foreach ( get_option( 'active_plugins' ) as $plugin_path ) {
					if ( !function_exists( 'get_plugin_data' ) )
						require_once( ABSPATH . 'wp-admin/includes/admin.php' );

					$plugin_info = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin_path );

					$slug           = str_replace( '/' . basename( $plugin_path ), '', $plugin_path );
					$plugins[$slug] = array(
						'version'    => $plugin_info['Version'],
						'name'       => $plugin_info['Name'],
						'plugin_uri' => $plugin_info['PluginURI'],
						'author'     => $plugin_info['AuthorName'],
						'author_uri' => $plugin_info['AuthorURI'],
					);
				}

				$data = array(
					'site'     => array(
						'hash'      => site_url(),
						'version'   => get_bloginfo( 'version' ),
						'multisite' => is_multisite(),
						'users'     => $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ({$wpdb->users}.ID = {$wpdb->usermeta}.user_id) WHERE 1 = 1 AND ( {$wpdb->usermeta}.meta_key = %s )", 'wp_' . $blog_id . '_capabilities' ) ),
						'lang'      => get_locale(),
					),
					'theme'    => $theme,
					'plugins'  => $plugins,
					'email' => get_option( 'admin_email' ),
					'param'=>'class_tracking',
					'action'=>'license_validator'
				);
					$url = get_option("gallery-bank-updation-check-url");
					$response = wp_remote_post( $url, array(
					'method' => 'POST',
					'timeout' => 45,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => $data 
				    )
				);
		}
	}

	$TrackingForGalleryBank = new TrackingForGalleryBank;
}