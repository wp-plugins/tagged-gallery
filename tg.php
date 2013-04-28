<?php
/*
Plugin Name: Tagged Gallery
Plugin URI: http://wordpress.org/extend/plugins/tagged-gallery/
Description: Tagged Gallery enables you to easily generate a gallery in any post or page based on tagged media.
Author: Erik Bergh
Version: 0.7
Author URI: http://www.bergh.me
*/

include_once ( dirname(__FILE__) . "/tg_class.php");
include_once ( dirname(__FILE__) . "/tg_admin.php");

wp_enqueue_script('jquery');

wp_register_style( 'tg-style', plugins_url('/css/tg.css', __FILE__) );
wp_enqueue_style( 'tg-style' );
	
wp_register_script( 'tg-lighbox', plugins_url( '/js/tgbox.jquery.js', __FILE__ ) );
wp_enqueue_script('tg-lighbox');

wp_register_script( 'jqresize-script', plugins_url( '/js/jquery.resizecrop-1.0.3.js', __FILE__ ) );
wp_enqueue_script('jqresize-script');

wp_register_script( 'resize-script', plugins_url( '/js/resize.js', __FILE__ ) );
wp_enqueue_script('resize-script');

wp_register_script( 'tg-script', plugins_url( '/js/tg.js', __FILE__ ) );
wp_enqueue_script('tg-script');



add_filter('the_content','tg_gallery');

$wctest = new wctg();
