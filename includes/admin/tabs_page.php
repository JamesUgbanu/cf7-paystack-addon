<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	// hook into contact form 7 form
	function cf7ps_editor_panels ( $panels ) {

		$new_page = array(
			'ps' => array(
				'title' => __( 'Paystack', 'contact-form-7-ps' ),
				'callback' => 'cf7ps_admin_after_additional_settings'
			)
		);

		$panels = array_merge( $panels , $new_page );

		return $panels;

	}
	add_filter( 'wpcf7_editor_panels', 'cf7ps_editor_panels' );


	function cf7ps_admin_after_additional_settings( $cf7 ) {

		$post_id = sanitize_text_field( $_GET['post'] );

		$enable 			= 			get_post_meta( $post_id , "_cf7ps_enable", true );
		$name 				= 			get_post_meta( $post_id, "_cf7ps_name", true );
		$description 		= 			get_post_meta( $post_id, "_cf7ps_description", true );
		$price 				= 			get_post_meta( $post_id, "_cf7ps_price", true );

		if ($enable == "1") { 
			$checked = "CHECKED"; 
		} else { 
			$checked = ""; 
		}
		
		$admin_table_output = "";
		$admin_table_output .= "<h2>Payment Details</h2>";

		$admin_table_output .= "<div class='mail-field'></div>";
		
		$admin_table_output .= "<table><tr>";
		
		$admin_table_output .= "<td width='195px'><label>Enable Paystack on this form: </label></td>";
		$admin_table_output .= "<td width='250px'><input name='enable' value='1' type='checkbox' $checked></td></tr>";


		$admin_table_output .= "<tr><td>Payment Name: </td>";
		$admin_table_output .= "<td><input type='text' name='name' value='$name'> </td></tr>";

		$admin_table_output .= "<tr><td>Payment Description: </td>";
		$admin_table_output .= "<td><textarea name='description' rows='4'>$description</textarea> </td><td> (Optional)</td></tr>";

		$admin_table_output .= "<tr><td>Payment Amount: </td>";
		$admin_table_output .= "<td><input type='text' name='price' value='$price'> </td></tr>";
		
		$admin_table_output .= "<input type='hidden' name='post' value='$post_id'>";

		$admin_table_output .= "</td></tr></table>";

		echo $admin_table_output;

	}


	// hook into contact form 7 admin form save
	add_action('wpcf7_after_save', 'cf7ps_save_contact_form');

	function cf7ps_save_contact_form( $cf7 ) {

			$post_id = sanitize_text_field( $_POST['post'] );

			if (!empty($_POST['enable'])) {
				$enable = sanitize_text_field( $_POST['enable'] );
				update_post_meta( $post_id, "_cf7ps_enable", $enable );
			} else {
				update_post_meta( $post_id, "_cf7ps_enable", 0 );
			}

			$name = sanitize_text_field( $_POST['name'] );
			update_post_meta( $post_id, "_cf7ps_name", $name );

			$description = sanitize_text_field( $_POST['description'] );
			update_post_meta( $post_id, "_cf7ps_description", $description );

			$price = sanitize_text_field( $_POST['price'] );
			$price = cf7ps_format_currency( $price );
			update_post_meta( $post_id, "_cf7ps_price", $price );

			$id = sanitize_text_field( $_POST['id'] );
			update_post_meta ( $post_id, "_cf7ps_id", $id );

	}