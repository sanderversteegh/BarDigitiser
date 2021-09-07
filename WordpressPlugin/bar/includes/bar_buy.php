<?php
defined('ABSPATH') or exit;

add_shortcode('bar_buy_page', 'bar_buy_page');

function bar_buy_page()
{
    if (current_user_can('sell')) {

        $captcha_response = apply_filters('gglcptch_verify_recaptcha', true, 'string', 'bar_buy_form');



        if (isset($_POST['beer'])) {
            $card_uid = esc_textarea($_POST["card_uid"]);

            if (true !== $captcha_response) {
                printf(
                    __('<span style="color: #ff0000;">Error: </span>%s<br>', 'bar'),
                    $captcha_response
                );
            } else {
                $product = 'beer';

                $return_v = bar_buy($card_uid, $product);

                if ($return_v != NULL) {
                    print($return_v->get_error_message());
                } else {
                    $price_beer = number_format((float)get_option('bar_beer_price_field'), 2, '.', '');
                    list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code) = bar_get_card($card_uid);

                    _e('The purchase was a succes. <br>
                        There is <b>' . $price_beer . '</b> withdrawn from youre card.<br>
                        <br>
                        New balance: <b>' . $card_balance . '</b>', 'bar');
                        bar_log(array(
                            'card_uid'  => $card_uid,
                            'log'       => 'Bought beer with succes! ' . $price_beer . ' witdrown from card.',
                            'card_balance' => $card_balance,
                            'source' => 'browser'
                        ));
                }
                return;
            }
        } elseif (isset($_POST['softdrink'])) {
            $card_uid = esc_textarea($_POST["card_uid"]);

            if (true !== $captcha_response) {
                printf(
                    __('<span style="color: #ff0000;">Error: </span>%s<br>', 'bar'),
                    $captcha_response
                );
            } else {
                $product = 'softdrink';

                $return_v = bar_buy($card_uid, $product);

                if ($return_v != NULL) {
                    print($return_v->get_error_message());
                } else {
                    $price_softdrink = number_format((float)get_option('bar_softdrink_price_field'), 2, '.', '');  // Outputs -> 105.00
                    list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage) = bar_get_card($card_uid);

                    print('The purchase was a succes. <br>
                        There is <b>' . $price_softdrink . '</b> withdrawn from youre card.<br>
                        <br>
                        New balance: <b>' . $card_balance . '</b> coins.');
                        bar_log(array(
                            'card_uid'  => $card_uid,
                            'log'       => 'Bought softdrink with succes! ' . $price_softdrink . ' witdrown from card.',
                            'card_balance' => $card_balance,
                            'source' => 'browser'
                        ));
                }
                    
                return;
            }
        } else { {
                //print de velden etc        
                _e('<span style="color: #ff0000;"> Fields with * are mandatory.</span><b>', 'bar');
?>
                <form method="POST" name="bar_buy_form">
                    <p>
                        <label for="card_uid"> <?php _e('Card UID:*', 'bar') ?> </label>
                        <input type="nummber" name="card_uid" required>
                    </p>
                    <?php echo apply_filters('gglcptch_display_recaptcha', '', 'bar_buy_form'); ?>
                    <input type="submit" name="beer" value='Beer'>
                    </p>
                    
                    <input type="submit" name="softdrink" value='Softdrink'>
                </form>
<?php
            }
        }
    } else {
        _e('<span style="color: #ff0000;">Error:</span> You dont have permision for this page.<br>', 'bar');
    }
}


function bar_buy($card_uid, $product)
{
    if (current_user_can('sell')) {
        global $wpdb;
        global $card_balance_table;

        $return_m = NULL;


        list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code) = bar_get_card($card_uid);
        if ($code != NULL) {
            return $code;
        } else {
            $price_softdrink = number_format((float)get_option('bar_softdrink_price_field'), 2, '.', '');  // Outputs -> 105.00
            $price_beer = number_format((float)get_option('bar_beer_price_field'), 2, '.', '');

            if ($product == 'beer') {
                if ($card_balance >= $price_beer) {
                    $update_return = $wpdb->update(
                        $card_balance_table,
                        array(
                            'card_balance' => ($card_balance - $price_beer),
                            'nummber_beer' => ($nummber_beer + 1)
                        ),
                        array('id' => $id)
                    );
                    return $code;
                } else {
                    return status_codes(6, $card_uid);
                }
            } elseif ($product == 'softdrink') {
                if ($card_balance >= $price_softdrink) {
                    $update_return = $wpdb->update(
                        $card_balance_table,
                        array(
                            'card_balance' => ($card_balance - $price_softdrink),
                            'nummber_softdrink' => ($nummber_softdrink + 1)
                        ),
                        array('id' => $id)
                    );
                    return $code;
                } else {
                    return status_codes(6, $card_uid);
                }
            } else {
                return status_codes(7, $card_uid);
            }
        }
    } else {
        _e('<span style="color: #ff0000;">Error:</span> You dont have permision for this page.<br>', 'bar');
    }
}
