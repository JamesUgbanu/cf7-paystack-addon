<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// add ps menu under contact form 7 menu
add_action( 'admin_menu', 'cf7ps_admin_menu', 20 );
function cf7ps_admin_menu() {
	add_submenu_page('wpcf7',__( 'Paystack Settings', 'contact-form-7' ),__( 'Paystack Settings', 'contact-form-7' ),'wpcf7_edit_contact_forms', 'cf7ps_admin_table','cf7ps_admin_table');
}

// plugin page links
add_filter('plugin_action_links', 'cf7ps_plugin_settings_link', 10, 2 );
function cf7ps_plugin_settings_link($actions, $plugin_file) {
	static $plugin;
	if (!isset($plugin))
        $plugin = plugin_basename(__FILE__);
   if ($plugin == $plugin_file) {
      $settings = array('settings' => '<a href="admin.php?page=cf7ps_admin_table"">' 
	  . __('Settings', 'General') . '</a>');     
      $actions = array_merge($settings, $actions);
   }
     
   return $actions;
}