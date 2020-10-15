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

// function cf7ps_add_logo($output, $tag, $atts, $m) {

// 	$formid = sanitize_text_field(intval($atts['id']));

// 	$enable = get_post_meta( $formid, "_cf7ps_enable", true);

// 	if ($enable) {
// 		if ($tag === 'contact-form-7') {
// 			$image = plugins_url('../images/paystack_secure.png',__FILE__);
// 			$logo = "<div><img style='margin: auto;' src='$image' alt='Secured by Paystack'></div>";
// 			$output .= $logo;
// 		}
// 	}
//     return $output;
// }

// add_filter('do_shortcode_tag', 'cf7ps_add_logo', 10, 4);