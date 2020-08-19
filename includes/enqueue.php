<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



	// admin enqueue
	function cf7ps_admin_enqueue() {

		// admin css
		wp_register_style( 'cf7ps-admin-css',plugins_url('../assets/css/cfps-admin.css',__FILE__),false,false );
		wp_enqueue_style( 'cf7ps-admin-css' );

		// admin js
		wp_enqueue_script( 'cf7ps-admin',plugins_url('../assets/js/admin.js',__FILE__),array( 'jquery' ),false );

	}
	add_action( 'admin_enqueue_scripts','cf7ps_admin_enqueue' );



	// public enqueue
	function cf7ps_public_enqueue() {

		// ps Options from Admin
		$options = get_option( 'cf7ps_options' );
		
		
		// set defaults in case uplugin has been updated without savings the settings page
		if (!isset($options['failed'])) {

			$options['failed'] 			= 	'Payment Failed';
			$options['processing'] 		= 	'Processing Payment';
			$options['mode_ps'] 	    = 	'live';
			$options['sec_key_live'] 	= 	'';

		}

		if ($options['mode'] == "1") {
			$key = $options['sec_key_test'];
		} else {
			$key = $options['sec_key_live'];
		}
		
		//redirect js
		wp_enqueue_script( 'cf7ps-redirect_method',plugins_url('../assets/js/redirect.js',__FILE__),array( 'jquery' ),null );
		wp_localize_script('cf7ps-redirect_method', 'ajax_object_cf7ps',
		array (
			'ajax_url' 			=> admin_url('admin-ajax.php'),
		)
	);
	}
	add_action('wp_enqueue_scripts','cf7ps_public_enqueue',10);
