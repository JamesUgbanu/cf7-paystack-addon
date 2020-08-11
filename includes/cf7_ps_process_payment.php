<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed

	// hook into contact form 7 - after send
add_action('wpcf7_before_send_mail', 'cf7ps_before_send_mail');

	// returns the form id of the forms that have paystack enabled
	function cf7ps_before_send_mail($cf7) {

		global $postid;
		
		$postid = $cf7->id();

		$enable = get_post_meta( $postid, "_cf7ps_enable", true);
		if ($enable == "1") {
			include_once ('redirect.php');
		}
	}