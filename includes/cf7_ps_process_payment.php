<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly 
	
// start session if not already started
add_action('init', 'cf7ps_session');

function cf7ps_session() {
     if (!session_id()) {
            session_start();
    }
}

	// hook into contact form 7 - before send
add_action('wpcf7_before_send_mail', 'cf7ps_before_send_mail');


function cf7ps_before_send_mail($cf7) {

        $postid = $cf7->id;
        $_SESSION['posted_id'] = $postid;
        $_SESSION['email'] = sanitize_text_field($_POST['your-email']);
}


// listen for and process paystack charge
add_action('wp_ajax_cf7ps_paystack_charge', 'cf7ps_paystack_charge_callback');
add_action('wp_ajax_nopriv_cf7ps_paystack_charge', 'cf7ps_paystack_charge_callback');

	// returns the form id of the forms that have paystack enabled
function cf7ps_paystack_charge_callback() {
        
        $enable = get_post_meta( $_SESSION['posted_id'], "_cf7ps_enable", true);
  
		if ($enable == "1") {
			include_once ('redirect.php');
		}
        
		
}