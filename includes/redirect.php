<?php

$post_id = sanitize_text_field($_SESSION['posted_id']);
$email = sanitize_text_field($_SESSION['email']);
$name = get_post_meta($post_id, "_cf7ps_name", true);
$amount = get_post_meta($post_id, "_cf7ps_price", true);
$description = get_post_meta($post_id, "_cf7ps_description", true);

// get options
$options = get_option('cf7ps_options');

$currency = $options['currency'];


if ($options['mode'] == '1') {
    $key = $options['sec_key_test'];
} else {
    $key = $options['sec_key_live'];
}

if (empty($key)){
    _e("Api keys not set");
}

// language
if ($currency == "1") {
	$language = "NGN";
} //Nigeria

if ($currency == "2") {
	$language = "GHC";
} //Ghana

if (!is_email($email)) {
    $email = '';
}

$kobo_amount = $amount*100;


$paystack_url = 'https://api.paystack.co/transaction/initialize';

                    $headers = array(
                        'Content-Type'  => 'application/json',
                        'Authorization' => 'Bearer '.$key,
                    );
                    
                    $body = array(
                        'email'        => $email,
                        'amount'       => $kobo_amount,
                        'currency'     => $language,
                    );

                    $args = array(
                        'body'      => json_encode($body),
                        'headers'   => $headers,
                        'timeout'   => 60
                    );

                    $request = wp_remote_post($paystack_url, $args);
  
                    if (!is_wp_error($request)) {
                      $paystack_response = json_decode(wp_remote_retrieve_body($request));
                
                        if ($paystack_response->status) {
                            
                            $url = $paystack_response->data->authorization_url;
                           
                            $response = array(
                                'redirect_url' => esc_url($url),
                                );
                                
                             _e(json_encode($response));
                                wp_die();
                  }
                    exit;
                 }
                 
                 