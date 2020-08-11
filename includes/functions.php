<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	// format currency
	function cf7ps_format_currency( $price ) {
		$price 		= 	floatval( preg_replace( '/[^\d\.]/', '', $price ) );
		$price 		=	number_format( ( float )$price, 2, '.', '' );
		return $price;
	}
	

	// display activation notice
	function cf7ps_my_plugin_admin_notices() {
		if ( !get_option( 'cf7ps_my_plugin_notice_shown' ) ) {
			echo "<div class='updated'><p><a href='admin.php?page=cf7ps_admin_table'>Click here to view the plugin settings</a>.</p></div>";
			update_option( "cf7ps_my_plugin_notice_shown", "true" );
		}
	}
	add_action( 'admin_notices', 'cf7ps_my_plugin_admin_notices' );


	// admin footer rate us link
	function cf7ps_admin_rate_us( $footer_text ) {
		
		$screen = get_current_screen();

		if ( $screen->base == 'contact_page_cf7ps_admin_table' ) {
			
			$rate_text = sprintf( __( 'Thank you for using our plugin. Please <a href="%2$s" target="_blank">rate us on WordPress.org</a>', '' ),
				'https://crystalwebpro.com',
				'https://wordpress.org/support/plugin/contact-form-7-paystack-integration/reviews/?filter=5'
			);
			
			return str_replace( '</span>', '', $footer_text ) . ' | ' . $rate_text . '</span>';
			
		} else {
			return $footer_text;
		}

	}
	add_filter( 'admin_footer_text', 'cf7ps_admin_rate_us' );