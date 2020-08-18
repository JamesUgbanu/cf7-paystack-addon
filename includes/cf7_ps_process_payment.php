<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly

// listen for and process paystack charge
add_action('wp_ajax_cf7ps_paystack_charge', 'cf7ps_paystack_charge_callback');
add_action('wp_ajax_nopriv_cf7ps_paystack_charge', 'cf7ps_paystack_charge_callback');

	// returns the form id of the forms that have paystack enabled
function cf7ps_paystack_charge_callback() {
        global $formid;
        $formid = sanitize_text_field(intval($_POST['id']));
        $enable = get_post_meta( $formid, "_cf7ps_enable", true);
  
		if ($enable == "1") {
			include_once ('redirect.php');
		}
        
		
}