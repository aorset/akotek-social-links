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
}
add_action( 'wp_enqueue_scripts', 'asl_load_styles' );

function asl_add_social_links( $content ){
  $social_content = '<a href="http://twitter.com/intent/tweet?status=' . get_the_title() . '+' . get_permalink() . '" target="_blank"><i class="fa fa-twitter-square fa-lg" style="padding-right: 3px;"></i></a><a href="http://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '&title=' . get_the_title() . '" target="_blank"><i class="fa fa-facebook-square fa-lg" style="padding-right: 3px;"></i></a><a href="http://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . get_the_title() . '&source=' . get_site_url() . '" target="_blank"><i class="fa fa-linkedin-square fa-lg" style="padding-right: 3px;"></i></a>';


  if (is_singular()) {
    $content .= $social_content;
  }
  return $content;
}

add_filter('the_content', 'asl_add_social_links');
