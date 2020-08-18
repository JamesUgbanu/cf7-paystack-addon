<?php
/*
Plugin Name: CF7 - Paystack Add-on
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
		'currency'    		=> '25',
		'language'    		=> '3',
		'cancel'			=> '',
        'return' 			=> '',
		'mode' 				=> '2',
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


	// start session if not already started
	function cf7ps_session() {
		if(!session_id()) {
			session_start();
		}
	}
	add_action('init', 'cf7ps_session', 1);


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
 66  readme.txt 
@@ -0,0 +1,66 @@
=== Contact Form 7 - Paystack Add-on ===
Contributors: James Ugbanu
Donate link: https://crystalwebpro.com/
Tags: Paystack, contact form 7, contact form, Paystack Donation Addon
Author URI: https://crystalwebpro.com/
Requires at least: 3.0
Tested up to: 5.6.0
Requires PHP: 5.6
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Integrates Paystack with Contact Form 7 for redirecting user to payment page for the any purpose like donations or any other payment. 

== Description ==
= Overview =

This Addon integrates Paystack with Contact Form 7.

Each contact form can have its own Paystack settings. When a contact form is enabled with Paystack, and the user submits the form it will send the email as usual, then auto redirect to payment confirmation with details entered in plugin settings.  

If you have any problems, questions, or issues about this plugin then please create a support request and we will be more than happy to help

Note: This Paystack plugin works with both the old and new Contact Form 7 interface. A Paystack account is required to use Paystack integration. 

= Contact Form 7 - Paystack Integration Add-on Features =

*	Set Payment Title, Description and Amount per contact form
*   Built in support 2 currencies (Please confirm if your country has Paystack payment gateway. For any issue please contact to plugin support)
*	Paystack testing through SandBox
*	Choose a cancel payment URL
*	Choose a succesful payment URL

== Installation ==

= Automatic Installation =
> 1. Sign in to your WordPress site as an administrator.
> 2. In the main menu go to Plugins -> Add New.
> 3. Search for Contact Form 7 - Paystack Add-on and click install.
> 4. That's it. You are now ready to start accepting Paystack payment on your website through your contact form.

== Frequently Asked Questions ==

= How do I use it? = 

You can integrate Paystack payment gateway with Contact Form 7 plugin. If configured properly, form will redirected to Paystack payment gateway with amount you have configured in the settings. 

= How do I get help? =

Help is provided via the [plugin support forum](https://wordpress.org/support/plugin/contact-form-paystack-addon) only.

= How do I get Secret or Test Key on Paystack  =

1. You can find your live or test secret key in your Paystack Dashboard [https://dashboard.paystack.com/#/settings/developer]


== Screenshots ==
1. Paystack settings Paystack Tab
2. Paystack settings Other Setting Tab
3. Options while editing a contact form


== Changelog ==

= 1.0 =
Initial release