<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// add ps menu under contact form 7 menu
add_action( 'admin_menu', 'cf7ps_admin_menu', 20 );
function cf7ps_admin_menu() {
	add_submenu_page('wpcf7',__( 'Paystack Settings', 'contact-form-7' ),__( 'Paystack Settings', 'contact-form-7' ),'wpcf7_edit_contact_forms', 'cf7ps_admin_table','cf7ps_admin_table');
}

// plugin page links
add_filter('plugin_action_links', 'cf7ps_plugin_settings_link', 10, 2 );
function cf7ps_plugin_settings_link($links,$file) {
	
	if ($file == 'contact-form-7-paystack-integration/ps.php') {		
		$settings_link = 	'<a href="admin.php?page=cf7ps_admin_table">' . __('Settings', 'PTP_LOC') . '</a>';
		array_unshift($links, $settings_link);
	}
	
	return $links; 
}