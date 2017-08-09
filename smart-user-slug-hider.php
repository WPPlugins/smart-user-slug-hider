<?php
/*
Plugin Name: smart User Slug Hider
Plugin URI: http://petersplugins.com/free-wordpress-plugins/smart-user-slug-hider
Description: Hide usernames in author pages URLs to enhance security
Version: 1.2
Author: Peter's Plugins, smartware.cc
Author URI: http://petersplugins.com
Text Domain: smart-user-slug-hider
License: GPL2+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . '/inc/class-smart-user-slug-hider.php' );

$smart_user_slug_hider = new Smart_User_Slug_Hider( __FILE__ );

// theme functions

function get_smart_user_slug( $user_id = false ) {
  $smart_user_slug_hider = new Smart_User_Slug_Hider( __FILE__ );
  return $smart_user_slug_hider->get_smart_user_slug( $user_id );
}

function the_smart_user_slug( $user_id = false ) {
  $smart_user_slug_hider = new Smart_User_Slug_Hider( __FILE__ );
  $smart_user_slug_hider->the_smart_user_slug( $user_id );
}

?>