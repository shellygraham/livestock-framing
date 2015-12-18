<?php
// ** MySQL settings ** //

// define environments
$environment_path = $_SERVER['DOCUMENT_ROOT'] . ( $_SERVER['REDIRECT_SUBDOMAIN'] ? '/' . $_SERVER['REDIRECT_SUBDOMAIN'] : null );
$environments = array(
	'local' => ( file_exists( $environment_path . '/environment-local.json' ) ? (array) json_decode( file_get_contents( $environment_path . '/environment-local.json' ) ) : null ),
	'staging' => ( file_exists( $environment_path . '/environment-staging.json' ) ? (array) json_decode( file_get_contents( $environment_path . '/environment-staging.json' ) ) : null ),
	'production' => ( file_exists( $environment_path . '/environment-production.json' ) ? (array) json_decode( file_get_contents( $environment_path . '/environment-production.json' ) ) : null )
);

// echo '<pre>' . print_r( $environments, 1 ) . '</pre>';

// This function allows wildcards in the array to be searched
function better_in_array( $needle, $haystack ) {
	foreach ($haystack as $value) {
		if ( fnmatch( $value, $needle ) === true ) {
			return true;
		}
 	}
	return false;
}

// loop through environments to get proper db credentials
foreach( $environments as $key => $env ) {

	if ( is_array( $env ) && better_in_array( $_SERVER['SERVER_NAME'] , $env['address'] ) ) {
		$selected_environment = $env;

		foreach( $env['db'] as $k => $v ) {
			$selected_db[$k] = $v;
		}

		// echo '<pre>' . print_r( $selected_db, 1 ) . '</pre>';

		// selected credentials
		if ( isset( $selected_db ) && is_array( $selected_db ) ) {
			// if we find a matching environment, apply db credentials
			define( 'DB_NAME', 		$selected_db['name'] 		);
			define( 'DB_USER', 		$selected_db['user']		);
			define( 'DB_PASSWORD', 	$selected_db['password'] 	);
			define( 'DB_HOST', 		$selected_db['host'] 		);
			define( 'DB_CHARSET', 	$selected_db['charset'] 	);
			define( 'DB_COLLATE', 	$selected_db['collate'] 	);

			if ( $selected_environment['ssl'] == true ) {
				define( 'FORCE_SSL_ADMIN', true );
				define( 'FORCE_SSL_LOGIN', true );

				if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) ) {
					$_SERVER['HTTPS'] = ( $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ? 'on' : 'off' );
				}

				if ( !isset( $_SERVER['HTTPS'] ) || ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'on' ) ) {
					if( !headers_sent() ) {
						header("Status: 301 Moved Permanently");
						header(sprintf(
							'Location: https://%s%s',
							$_SERVER['HTTP_HOST'],
							$_SERVER['REQUEST_URI']
						));
						exit();
					}
				}
			}

			if ( $selected_environment->dev == true ) {
				define( 'WP_DEBUG', true );  // Turn debugging ON
				define( 'WP_DEBUG_DISPLAY', true ); // Turn forced display ON
				define( 'WP_DEBUG_LOG', true );  // Turn logging to wp-content/debug.log ON
			}
			else {
				define( 'WP_DEBUG', true );				// Turn debugging ON
				define( 'WP_DEBUG_DISPLAY', false );	// Turn forced display OFF
				define( 'WP_DEBUG_LOG', true );			// Turn logging to wp-content/debug.log ON
				define( 'WP_CACHE', true );				//
			}

			$environment = $key;
		}
		else {
			echo 'Environment found but credentials are invalid.';
			exit;
		}

		break; // break foreach if we find a match
	}
}
