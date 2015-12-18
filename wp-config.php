<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define( 'WPCACHEHOME', dirname( __FILE__ ) . '/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define( 'WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp' );
define( 'WP_HOME', 'http://' . $_SERVER['SERVER_NAME'] );
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content' );
define( 'FS_CHMOD_DIR', (0755 & ~ umask() ) );
define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );
define( 'WP_ALLOW_REPAIR', true );
define( 'EMPTY_TRASH_DAYS', 7 );
define( 'DISALLOW_FILE_EDIT', true );
define( 'UPLOADS', 'uploads' );
define( 'WP_MEMORY_LIMIT', '128M' );
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
define( 'WPLANG', '' );
define( 'WP_DEFAULT_THEME', 'livestock-framing' );
$table_prefix  = 'livestock_';

require( 'wp-environments.php' );

if ( !defined( 'DB_NAME' ) || !defined( 'DB_USER' ) || !defined( 'DB_PASSWORD' ) || !defined( 'DB_HOST' ) || !defined( 'DB_CHARSET' ) || !defined( 'DB_COLLATE' ) ) {
	echo 'Environment not configured.';
	exit;
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'G)N}D}U?/(;`oB*|^[U7Rg-f?-[Ij2aqP6m#iw|}0%6@as4+`_L|_a#|z:ccxh0w');
define('SECURE_AUTH_KEY',  '-j]%}orG4VM/SX3;/U}thM(Z,-#i{v:rmu->ZSAh47|nrSa<*%GNk)r8+6>|+fp4');
define('LOGGED_IN_KEY',    'Ud(u GfU@d#C?%gX[)=~r]{?Q]}[5Y#n3#{|yS(81Ge+ws=Z v/#_DA|7+L,U~Y0');
define('NONCE_KEY',        'xOr$)Kp($2-M+HpwI.Ow-#2o|<]I&lM~w|VW*`=R[1EWZeLo[?}!9~U}E2<ouz;O');
define('AUTH_SALT',        'mX)?v7)DsA3$N)=q &p3-5-}*`~&yh*)rfdE5ky56Z#}~_^TVL<vr75Q<OB0}9PP');
define('SECURE_AUTH_SALT', 'Bc$%)dKa<v|*2r!8j_|HQ?@)ODg^ n92>wVRnEhP$EE/rrh+JvR=P|zrURfH}a)>');
define('LOGGED_IN_SALT',   '1CS$w$fBD-7O$G:ko(F-F%2_|39))5Z_!IS3k6[y!rJd/q>J_c&SqlDrGjD8@X*/');
define('NONCE_SALT',       'hef1k7||$o0r`PXl, ~x{%H-*nMIgn$YV9@~0@N6:NZdMW(bKJZaf|gKkbw5T~<5');

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

require_once( ABSPATH . 'wp-settings.php' );
