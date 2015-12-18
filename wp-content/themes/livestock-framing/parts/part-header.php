<?php
/**
 * Header Template Part
 *
 * @package WordPress
 * @subpackage Livestock Framing
 * @since 1.0
 */
global $page_url;
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title><?php echo wp_title( '|', true, 'right' ); ?></title>
      
    <!-- seo -->
    <meta name="description" content="" />

    
    <!-- facebook -->
    <meta property="og:title" content="<?php echo wp_title( '|', true, 'right' ); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $page_url; ?>" />
    <meta property="og:image" content="<?php echo $page_url . get_bloginfo( 'template_directory' ); ?>/assets/img/branding-icon.png" />
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
    <meta property="og:description" content="<?php bloginfo( 'description' ); ?>" />

    <?php if ( class_exists( 'Livestock_Socials' ) ) : $livestock_socials = new Livestock_Socials(); if ( $livestock_socials->get_social( 'twitter' ) != '' ) : ?>
    <!-- twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@<?php echo $livestock_socials->get_username( 'twitter', $livestock_socials->get_social( 'twitter' ) ); ?>" />
    <meta name="twitter:title" content="<?php echo wp_title( '|', true, 'right' ); ?>" />
    <meta name="twitter:description" content="<?php bloginfo( 'description' ); ?>" />
    <meta name="twitter:image" content="<?php echo $page_url . get_bloginfo( 'template_directory' ); ?>/assets/img/branding-icon.png" />
    <meta name="twitter:url" content="<?php echo $page_url; ?>" />
    <?php endif; endif; ?>

    <!-- for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- icons -->
    <link rel="icon" type="image/x-icon" href="<?php echo get_bloginfo( 'template_directory' ); ?>/assets/icons/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="512x512" href="<?php echo get_bloginfo( 'template_directory' ); ?>/assets/icons/apple-touch-icon-512x512-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_bloginfo( 'template_directory' ); ?>/assets/icons/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_bloginfo( 'template_directory' ); ?>/assets/icons/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_bloginfo( 'template_directory' ); ?>/assets/icons/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_bloginfo( 'template_directory' ); ?>/assets/icons/apple-touch-icon-57x57-precomposed.png">

    <!-- styles -->
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/assets/css/compiled.min.css">
	<link href='https://fonts.googleapis.com/css?family=Rokkitt|Source+Sans+Pro:300,400' rel='stylesheet' type='text/css'>

    <?php wp_head(); ?>
  </head>
  <body data-spy="scroll" data-target=".navbar" <?php body_class( 'livestock-framing' ); ?>>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <nav class="navbar navbar-livestock navbar-light navbar-fixed-top animation-enabled navbar-white">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <i class="fa fa-bars" data-icon-active="fa-times" data-icon-default="fa-bars"></i>
          </button>
          <div class="navbar-brand">
            <a href="<?php bloginfo( 'url' ); ?>" class="" onclick="_gaq.push([ '_trackEvent', 'Navigation', 'Clicked', 'Brand' ]);">
              <img class="dark" src="<?php bloginfo( 'template_directory' ); ?>/assets/img/logo-dark.png" />
              <img class="light" src="<?php bloginfo( 'template_directory' ); ?>/assets/img/logo-white.png" />
            </a>
          </div>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
          <?php
            wp_nav_menu( array( 
              'theme_location' => 'primary', 
              'depth' => 1, 
              'menu_class' => 'nav-primary nav navbar-nav', 
              'walker' => new Walker_Bootstrap
            ) );
            wp_nav_menu( array( 
              'theme_location' => 'meta', 
              'depth' => 1, 
              'menu_class' => 'nav-meta nav-meta nav navbar-nav navbar-right', 
              'walker' => new Walker_Bootstrap
            ) );
          ?>
        </div>
      </div>
    </nav>