<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="container">
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */
?><!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<!--[if lte IE 8]>
     <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.ie.css" />
 <![endif]-->
<head>

  <meta charset="utf-8">

  <meta name="author" content="Yatta - Gilles Vauvarin" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />


<?php 

/* Hooks */
yatta_hook_head();

/* Hooks */
wp_head();

?>

</head>


<?php $yatta_get_body_class = get_body_class(); ?>
<body <?php if ( !empty( $yatta_get_body_class ) AND $yatta_get_body_class[0] != 'error404' ) { body_class(); } else { echo 'class="yatta-page-custom"'; } ?>>

  <!--[if lt IE 8]>
    <p class="chromeframe">Your browser is <em>ancient!</em> 
    <a href="http://browsehappy.com/">Upgrade to a different browser</a> or 
    <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.
    </p>
  <![endif]-->



  <div style="display:none" id="yatta-header-toggle" class="yatta-header-toggle" data-collapse>
    <div class="yatta-header-toggle-container">

    <?php 
    /* Hooks */
    yatta_hook_header_hide();
    ?>

    </div>
  </div>


  <div class="yatta-container"> <!-- </div> in the footer.php file -->



  