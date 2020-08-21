<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly


// admin table
function cf7ps_admin_table()
{


    if (!current_user_can("manage_options")) {
        wp_die(__("You do not have sufficient permissions to access this page."));
    }


    // save and update options
    if (isset($_POST['update'])) {

        $options['mode'] = sanitize_text_field($_POST['mode']);
        if (empty($options['mode'])) {
            $options['mode'] = '';
        }

        $options['currency'] = sanitize_text_field($_POST['currency']);
        if (empty($options['currency'])) {
            $options['currency'] = '';
        }

        $options['sec_key_live'] = sanitize_text_field($_POST['sec_key_live']);
        if (empty($options['sec_key_live'])) {
            $options['sec_key_live'] = '';
        }


        $options['sec_key_test'] = sanitize_text_field($_POST['sec_key_test']);
        if (empty($options['sec_key_test'])) {
            $options['sec_key_test'] = '';
        }

        $options['paystack_return'] = sanitize_text_field($_POST['paystack_return']);

        if (empty($options['paystack_return'])) {
            $options['paystack_return'] = '';
        }

        update_option("cf7ps_options", $options);

        echo "<br /><div class='updated'><p><strong>";
        _e("Settings Updated.");
        echo "</strong></p></div>";

    }


    // get options
    $options = get_option('cf7ps_options');

    if (empty($options['mode'])) {
        $options['mode'] = '1';
    }

    if (empty($options['currency'])) {
        $options['currency'] = '';
    }

    if (empty($options['sec_key_live'])) {
        $options['sec_key_live'] = '';
    }

    if (empty($options['sec_key_test'])) {
        $options['sec_key_test'] = '';
    }

    if (empty($options['paystack_return'])) {
        $options['paystack_return'] = '';
    }
    $siteurl = get_site_url();

    if (isset($_POST['hidden_tab_value'])) {
        $active_tab = sanitize_text_field($_POST['hidden_tab_value']);
    } else {
        $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : '1';
    }

    ?>


    <form method='post'>

        <table width='70%'>
            <tr>
                <td>
                    <div class='wrap'><h2>Contact Form 7 - paystack Settings</h2></div>
                    <br/></td>
                <td><br/>
                    <input type='submit' name='btn2' class='button-primary'
                           style='font-size: 17px;line-height: 28px;height: 32px;float: right;' value='Save Settings'>
                </td>
            </tr>
        </table>

        <table width='100%'>
            <tr>
                <td width='70%' valign='top'>


                    <h2 class="nav-tab-wrapper">
                        <a onclick='closetabs("1,2,3,4");newtab("1");' href="#" id="id1"
                           class="nav-tab <?php echo $active_tab == '1' ? 'nav-tab-active' : ''; ?>">Getting Started</a>
                        <a onclick='closetabs("1,2,3,4");newtab("2");' href="#" id="id2"
                           class="nav-tab <?php echo $active_tab == '2' ? 'nav-tab-active' : ''; ?>">
                            Currency</a>
                        <a onclick='closetabs("1,2,3,4");newtab("3");' href="#" id="id3"
                           class="nav-tab <?php echo $active_tab == '3' ? 'nav-tab-active' : ''; ?>">paystack</a>
                        <a onclick='closetabs("1,2,3,4");newtab("4");' href="#" id="id3"
                           class="nav-tab <?php echo $active_tab == '4' ? 'nav-tab-active' : ''; ?>">Other Settings</a>
                    </h2>
                    <br/>


                </td>
                <td colspan='3'></td>
            </tr>
            <tr>
                <td valign='top'>


                    <div id="1"
                         style="display:none;border: 1px solid #CCCCCC;<?php echo $active_tab == '1' ? 'display:block;' : ''; ?>">
                        <div style="background-color:#E4E4E4;padding:8px;color:#000;font-size:15px;color:#464646;font-weight: 700;border-bottom: 1px solid #CCCCCC;">
                            &nbsp; Getting Started
                        </div>
                        <div style="background-color:#fff;padding:8px;">

                            When go to your list of contact forms, make a new form or edit an existing form, you will
                            see a new tab called 'paystack'. Here you can
                            setup individual settings for that specific contact form.

                            <br/><br/>
                            You will need to have 'price' as form field for the paystack integration to work correctly.
                            <br/><br/>
                            On this page, you can setup your general paystack settings which will be used for all
                            of your contact forms.
                            <br/><br/>
                            Once you have paystack enabled on a form, you will receive an email as soon as the customer
                            submits the form. Then after they have paid, you should receive a payment
                            notification from paystack with the details of the transaction.


                            <br/>

                        </div>
                    </div>


                    <div id="2"
                         style="display:none;border: 1px solid #CCCCCC;<?php echo $active_tab == '2' ? 'display:block;' : ''; ?>">
                        <div style="background-color:#E4E4E4;padding:8px;color:#000;font-size:15px;color:#464646;font-weight: 700;border-bottom: 1px solid #CCCCCC;">
                            &nbsp; Currency
                        </div>
                        <div style="background-color:#fff;padding:8px;">

                            <table>
                                <tr>
                                    <td>
                                    </td>
                                </tr>

                                <tr>
                                    <td class='cf7ps_width'>
                                        <b>Currency:</b></td>
                                    <td>
                                        <select name="currency">
                                            <option <?php if ($options['currency'] == "1") {
                                                _e("SELECTED");
                                            } ?> value="1">Nigeria Naira - NGN
                                            </option>
                                            <option <?php if ($options['currency'] == "2") {
                                                _e("SELECTED");
                                            } ?> value="2">Ghana - GHC
                                            </option>
                                        </select></td>
                                </tr>

                            </table>

                        </div>
                    </div>


                    <div id="3"
                         style="display:none;border: 1px solid #CCCCCC;<?php echo $active_tab == '3' ? 'display:block;' : ''; ?>">
                        <div style="background-color:#E4E4E4;padding:8px;color:#000;font-size:15px;color:#464646;font-weight: 700;border-bottom: 1px solid #CCCCCC;">
                            &nbsp; paystack Account
                        </div>
                        <div style="background-color:#fff;padding:8px;">
                            <center>
                            <b>Important: To use paystack in live mode, an HTTPS certificate is required.</b>
                            </center>
                            <br/>
                          <table width='100%'>
                                <tr>
                                <td class='cf7ps_width'><b>Test Mode:</b></td>
		                        <td class='cf7ps_width'>
                                <input <?php if ($options['mode'] == "1") { _e("checked='checked'"); } ?> type='radio' name='mode' value='1'>On (Test mode)
		                        <input <?php if ($options['mode'] == "2") { _e("checked='checked'"); } ?> type='radio' name='mode' value='2'>Off (Live mode)</td>
                                </tr>
                                <tr>
                                    <td class='cf7ps_width'><b>Test Secret Key: </b></td>
                                    <td><input type='text' size=40 name='sec_key_test'
                                               value='<?php _e($options['sec_key_test']); ?>'> Optional
                                    </td>
                                </tr>
                                <tr>
                                    <td class='cf7ps_width'><b>Live Secret Key: </b></td>
                                    <td><input type='text' size=40 name='sec_key_live'
                                               value='<?php _e($options['sec_key_live']); ?>'> Required to use paystack
                                    </td>
                                </tr>

                                <tr></td>
                                    <td>
                                    <td>
                                        <br/>
                                        You can get your API keys here: <a target='_blank'
                                                                           href='https://dashboard.paystack.com/#/settings/developer'>https://dashboard.paystack.com/#/settings/developer</a>
                                        <br/><br/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <br/>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>


                    <div id="4"
                         style="display:none;border: 1px solid #CCCCCC;>
                        <div style="background-color:#E4E4E4;padding:8px;font-size:15px;color:#464646;font-weight: 700;border-bottom: 1px solid #CCCCCC;">
                            &nbsp; Other Settings
                        </div>
                        <div style="background-color:#fff;padding:8px;">

                            <table style="width: 100%;">

                                <tr>
                                    <td class='cf7ps_width'><b>Paystack Redirect URL: </b></td>
                                    <td><input type='text' name='paystack_return'
                                    value='<?php _e($options['paystack_return']); ?>'> Optional <br/></td>
                                </tr>
                                <tr>
                                    <td class='cf7ps_width'></td>
                                    <td>If the customer successfully pays with paystack, where are they redirected to
                                        after. Example: http://example.com/thankyou.
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <br/>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>


                    <input type='hidden' name='update' value='1'>
                    <input type='hidden' name='hidden_tab_value' id="hidden_tab_value"
                           value="<?php _e($active_tab); ?>">

    </form>


    </td>
    <td width="3%" valign="top">

    </td>
    <td width="24%" valign="top">

    </td>
    <td width="2%" valign="top">


    </td></tr></table>

<?php

}