<?php
/*
Plugin Name: Tagged Gallery
Plugin URI: http://www.bergh.me/prosjekter/tagged-gallery/
Description: Gallery
Author: Erik Bergh
Version: 0.5
Author URI: http://www.bergh.me
*/

include_once ( dirname(__FILE__) . "/tg_class.php");
include_once ( dirname(__FILE__) . "/tg_admin.php");

wp_register_style( 'tg-style', plugins_url('/css/tg.css', __FILE__) );
wp_enqueue_style( 'tg-style' );
	
wp_enqueue_script("jquery");

wp_register_script( 'tg-script', plugins_url( '/js/tg.js', __FILE__ ) );
wp_enqueue_script('tg-script');

add_filter('the_content','tg_gallery');

$wctest = new wctg();
