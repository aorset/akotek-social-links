<?php
/*
Plugin Name: Akotek Social Links
Plugin URI: https://akotek.no
Description: Twitter, Linkedin and Facebook links
Version: 0.03
Author URI: https://akotek.no
*/

function asl_load_styles() {
  wp_enqueue_style( 'font-awesome-styles', plugins_url( 'font-awesome-4.6.3/css/font-awesome.min.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'asl_load_styles' );

function asl_add_social_links( $content ){

  $social_content = '<style type="text/css">
       div.social-links { height: 20px; margin: 10px auto 10px 0; text-align: left; clear: left; }
    </style>
    <div class="social-links">';

  if ( get_option( 'facebook-checkbox' ) ) {
    $social_content .= '<a href="http://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '&title=' . get_the_title() . '" target="_blank"><i class="fa fa-facebook-square fa-lg" style="padding-right: 3px;"></i></a>';
  }
  if ( get_option( 'twitter-checkbox' ) ) {
    $social_content .= '<a href="http://twitter.com/intent/tweet?status=' . get_the_title() . '+' . get_permalink() . '" target="_blank"><i class="fa fa-twitter-square fa-lg" style="padding-right: 3px;"></i></a>';
  }
  if ( get_option( 'lnkd-checkbox' ) ) {
    $social_content .= '<a href="http://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . get_the_title() . '&source=' . get_site_url() . '" target="_blank"><i class="fa fa-linkedin-square fa-lg" style="padding-right: 3px;"></i></a>';
  }

  $social_content .= '</div>';


  if (is_singular()) {
    $content .= $social_content;
  }
  return $content;
}
add_filter('the_content', 'asl_add_social_links');

function asl_settings_page()
{
    add_settings_section("section", __('Velg sosiale medier du vil vise i bunnen av hvert innlegg:', 'akotek-social-links' ), null, "asl");
    add_settings_field("facebook-checkbox", "Facebook", "facebook_checkbox_display", "asl", "section");
    register_setting("section", "facebook-checkbox");
    add_settings_field("twitter-checkbox", "Twitter", "twitter_checkbox_display", "asl", "section");
    register_setting("section", "twitter-checkbox");
    add_settings_field("lnkd-checkbox", "Linkedin", "lnkd_checkbox_display", "asl", "section");
    register_setting("section", "lnkd-checkbox");
}

function facebook_checkbox_display()
{
   ?>
        <!-- Here we are comparing stored value with 1. Stored value is 1 if user checks the checkbox otherwise empty string. -->
        <input type="checkbox" name="facebook-checkbox" value="1" <?php checked(1, get_option('facebook-checkbox'), true); ?> />
   <?php
}

function twitter_checkbox_display()
{
   ?>
        <!-- Here we are comparing stored value with 1. Stored value is 1 if user checks the checkbox otherwise empty string. -->
        <input type="checkbox" name="twitter-checkbox" value="1" <?php checked(1, get_option('twitter-checkbox'), true); ?> />
   <?php
}

function lnkd_checkbox_display()
{
   ?>
        <!-- Here we are comparing stored value with 1. Stored value is 1 if user checks the checkbox otherwise empty string. -->
        <input type="checkbox" name="lnkd-checkbox" value="1" <?php checked(1, get_option('lnkd-checkbox'), true); ?> />
   <?php
}

add_action("admin_init", "asl_settings_page");

function asl_page()
{
  ?>
  <div class="wrap">
         <h1>Akotek Social Links</h1>

         <form method="post" action="options.php">
            <?php
               settings_fields("section");
               do_settings_sections("asl");
               submit_button();
            ?>
         </form>
         <p>
           Support: <a href="mailto:post@akotek.no">post@akotek.no</a>
      </div>
   <?php
}
function menu_item()
{
  add_submenu_page("options-general.php", "Akotek Social Links", "Social Links", "manage_options", "asl", "asl_page");
}
add_action("admin_menu", "menu_item");
