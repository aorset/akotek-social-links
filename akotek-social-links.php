<?php

/*
Plugin Name: Akotek Social Links
Plugin URI: https://akotek.no
Description: Twitter, Linkedin and Facebook links
Version: 0.01
Author URI: https://akotek.no
*/

function asl_load_styles() {
  wp_enqueue_style( 'font-awesome-styles', plugins_url( 'font-awesome-4.6.3/css/font-awesome.min.css', __FILE__ ) );
  // wo_enqueue_script( '', plugins_url('pd101-scripts.js', 'ASL_PLUGIN_PATH' ) );
}
add_action( 'wp_enqueue_scripts', 'asl_load_styles' );

function sl_add_social_links( $content ){
  $social_content = '<a href="http://twitter.com"><i class="fa fa-twitter-square"></i></a> <a href="http://facebook.com"><i class="fa fa-facebook-square"></i></a><a href="http://linkedin.com"> <i class="fa fa-linkedin-square"></i></a>';

  if (is_singular()) {
    $content .= $social_content;
  }
  return $content;
}

add_filter('the_content', 'sl_add_social_links');
