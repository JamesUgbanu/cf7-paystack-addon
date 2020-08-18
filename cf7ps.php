<?php
/*
Plugin Name: Contact Form Paystack Add-on
Plugin URI: https://crystalwebpro.com/open-source/
Description: Integrates Paystack Payment Gateway with Contact Form 7
Author: James Ugbanu
Text Domain: cf7-ps
Author URI: https://crystalwebpro.com
License: GPL2
Version: 1.0
*/

/*  Copyright 2020 James Ugbanu

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/



// plugin variable: cf7ps


//  plugin functions
register_activation_hook( 	__FILE__, "cf7ps_activate" );
register_deactivation_hook( __FILE__, "cf7ps_deactivate" );
register_uninstall_hook( 	__FILE__, "cf7ps_uninstall" );

function cf7ps_activate() {
	
	// default options
	$cf7ps_options = array(
		'mode' 				=> '1',
		'sec_key_live'		=> '',
		'sec_key_test'		=> '',
	);
	
	add_option("cf7ps_options", $cf7ps_options);
	
}

function cf7ps_deactivate() {	
	delete_option("cf7ps_my_plugin_notice_shown");
}

function cf7ps_uninstall() {
}

// check to make sure contact form 7 is installed and active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {		
	
	// public includes
	include_once('includes/functions.php');
	include_once('includes/cf7_ps_process_payment.php');
	include_once('includes/enqueue.php');
	
	// admin includes
	if (is_admin()) {
		include_once('includes/admin/tabs_page.php');
		include_once('includes/admin/settings_page.php');
		include_once('includes/admin/menu_links.php');
	}
	
} else {
	
	// give warning if contact form 7 is not active
	function cf7ps_my_admin_notice() {
		?>
		<div class="error">
			<p><?php _e( '<b>Contact Form 7 - ps Add-on:</b> Contact Form 7 is not installed and / or active! Please install <a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>.', 'cf7ps' ); ?></p>
		</div>
		<?php
	}
	add_action( 'admin_notices', 'cf7ps_my_admin_notice' );
	
}

add_action( 'plugins_loaded', 'cf7ps_load_textdomain' );
function cf7ps_load_textdomain() {
	load_plugin_textdomain( 'cf7-ps', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}

?>