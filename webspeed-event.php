<?php
/*
Plugin Name: Webspeed Event
Version: 1.00
Plugin URI: https://www.web.dk
Description: Simple list of events
Author: Morten Andersen
Text Domain: webspeed-domain
Domain Path: /translation
Author URI: https://www.web.dk
*/

if( class_exists('ACF') ) {
  require_once ('files/acf.php');
  require_once ('files/icon.php');
  require_once ('files/img.php');
  require_once ('files/alternative-datoer.php');
  require_once ('files/show-date.php');
  require_once ('files/functions.php');
  require_once ('files/posttype.php');
  require_once ('files/taxonomy.php');
  require_once ('files/data-alt-page.php');
  require_once ('files/shortcode.php');
  require_once ('files/shortcode-liste.php');
  require_once ('files/shortcode-related.php');
}

add_theme_support('post-thumbnails');
add_image_size('event-img', 615, 615, true);