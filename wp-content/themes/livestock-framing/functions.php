<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * To keep this file tidy parts are categirized and placed into separate files
 * editable in a /inc sub-directory within this themes directory.
 *
 * @package WordPress
 * @subpackage Livestock
 * @since 1.0
 */

define( 'PATH', 'lib' );


/*
 * ==========================================================================================
 * HTTPS Support
 * ==========================================================================================
 */
$page_url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
$page_url .= '://' . $_SERVER['SERVER_NAME'];
$page_url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
$page_url .= $_SERVER['REQUEST_URI'];

/*
 * ==========================================================================================
 * General
 * ==========================================================================================
 */
require( PATH . '/general.php');

/*
 * ==========================================================================================
 * Theme Support
 * ==========================================================================================
 */
require( PATH . '/theme-support.php');

/*
 * ==========================================================================================
 * Navigation
 * ==========================================================================================
 */
require( PATH . '/nav-walkers.php');

/*
 * ==========================================================================================
 * General Admin Adjustments
 * ==========================================================================================
 */
require( PATH . '/admin-adjustments.php');

/*
 * ==========================================================================================
 * Shortcodes
 * ==========================================================================================
 */
require( PATH . '/shortcodes.php');
