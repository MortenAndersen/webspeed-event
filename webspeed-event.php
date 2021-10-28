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

if( function_exists('acf_add_local_field_group') ):
  require_once ('files/acf.php');
  require_once ('files/functions.php');
  require_once ('files/posttype.php');
  require_once ('files/taxonomy.php');
  require_once ('files/data-alt-page.php');
  require_once ('files/shortcode.php');
  require_once ('files/shortcode-liste.php');
  require_once ('files/shortcode-related.php');
endif;