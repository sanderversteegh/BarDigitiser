<?php
defined('ABSPATH') or exit;

add_shortcode('bar_add_balance', 'bar_add_balance_page');

function bar_add_balance_page()
{
    if (current_user_can('add_balance')) {
        $captcha_response = apply_filters('gglcptch_verify_recaptcha', true, 'string', 'bar_add_balance_form');
        if (isset($_POST['add_balance'])) {
            $card_uid = esc_textarea($_POST["card_uid"]);
            $quantity = esc_textarea($_POST["add_quantity"]);

            //if (true !== $captcha_response) {
            if (true !== $captcha_response) {
                printf(
                    __('<span style="color: #ff0000;">Error: </span>%s<br>', 'bar'),
                    $captcha_response
                );
            } else {

                list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spent, $card_register_date, $enable, $massage) = bar_get_card($card_uid);
                if ($massage != NULL) {
                    _e($massage);
                } else {

                    $new_balance = bar_add_balance($card_uid, $quantity);

                    _e('There are <b>' . str_replace(',', '.', $quantity) . '</b> coins added to the card <b>' . $card_name . '</b>. <br>
                        The new balance is <b>' . $new_balance . '</b> bar coins.', 'bar');

                        bar_log(array(
                            'card_uid'  => $card_uid,
                            'log'       => 'Added ' . $quantity . ' BC succes! Old balance: ' . $card_balance,
                            'card_balance' => $new_balance,
                            'source' => 'browser'
                        ));

                    return;
                }
            }
        } else { {
                //print de velden etc        
                _e('<span style="color: #ff0000;"> Fields with * are mandatory.</span><b>', 'bar');
?>
                <form method="POST" name="bar_add_balance_form">
                    <p>
                        <label for="card_uid"> <?php _e('Card UID:*', 'bar') ?> </label>
                        <input type="nummber" name="card_uid" required>
                    </p>
                    <p>
                        <label for="add_quantity"> <?php _e('Nummber of coins:*', 'bar') ?> </label>
                        <input type="nummber" name="add_quantity" required>
                    </p>
                    <?php echo apply_filters('gglcptch_display_recaptcha', '', 'bar_add_balance_form'); ?>
                    <input type="submit" name="add_balance" value='Add balance'>
                    </p>
                </form>
<?php
            }
        }
    } else {
        _e('<span style="color: #ff0000;">Error:</span> You dont have permision for this page.<br>', 'bar');
    }
}

function bar_add_balance($card_uid, $add_quantity)
{
    if (current_user_can('add_balance')) {
        global $wpdb;
        global $card_balance_table;


        (float)$quantity = str_replace(',', '.', $add_quantity);

        list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage) = bar_get_card($card_uid);

        $new_balance = $card_balance + $quantity;

        $update_return = $wpdb->update(
            $card_balance_table,
            array(
                'card_balance' => $new_balance,
                'total_spend' => ($total_spend + $quantity)
            ),
            array('id' => $id)
        );

        return $new_balance;
    } else {
        _e('<span style="color: #ff0000;">Error:</span> You dont have permision for this page.<br>', 'bar');
    }
}
