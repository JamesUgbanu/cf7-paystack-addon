<?php

// get variables
global $postid;

$post_id = $postid;

$enable = get_post_meta($post_id, "_cf7ps_enable", true);
$name = get_post_meta($post_id, "_cf7ps_name", true);
$amount = get_post_meta($post_id, "_cf7ps_price", true);
$description = get_post_meta($post_id, "_cf7ps_description", true);

// get options
$options = get_option('cf7ps_options');

$currency = $options['currency'];
$payment_success = $options['success'];
$payment_failed = $options['failed'];
$payment_processing = $options['processing'];


if ($options['mode'] == '1') {
    $key = $options['sec_key_test'];
} else {
    $key = $options['sec_key_live'];
}

if (empty($key)){
    echo "Api keys not set";
}

if (empty($options['paystack_return'])) {
    $options['paystack_return'] = '';
}
if (empty($options['paystack_cancel'])) {
    $options['paystack_cancel'] = '';
}

// language
if ($currency == "1") {
	$language = "NGN";
} //Nigeria

if ($currency == "2") {
	$language = "GHC";
} //Ghana

if (empty($email)) {
    $email = '';
}

$kobo_amount = $amount*100;

//$email = sanitize_text_field($_POST['email'])


$paystack_url = 'https://api.paystack.co/transaction/initialize';
                    $headers = array(
                        'Content-Type'  => 'application/json',
                        'Authorization' => 'Bearer '.$key,
                    );
                    
                    $body = array(
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
                            
                            wp_redirect($url);
                            exit;
                   }
                    exit;
                 }
                 
                 