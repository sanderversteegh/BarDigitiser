<?php
defined('ABSPATH') or exit;

add_shortcode('bar_saldo_lookup', 'bar_saldo_loopkup_page');

function bar_saldo_loopkup_page()
{
    if (true == true) {

        global $card_balance_table;

        $captcha_response = apply_filters('gglcptch_verify_recaptcha', true, 'string', 'bar_see_balance_form');



        if (isset($_POST['get_balance'])) {
            $card_uid = esc_textarea($_POST["card_uid"]);

            if (true !== $captcha_response) {
                printf(
                    __('<span style="color: #ff0000;">Error: </span>%s<br>', 'bar'),
                    $captcha_response
                );
                bar_balance_again_button();

            } else {

                list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code) = bar_get_card($card_uid);
                if ($code != NULL) {
                    _e($code->get_error_message());
                    bar_balance_again_button();
                } else {

                    print ("The name of this card: <b>" . $card_name) . "</b><br>
                        <br>";
                    $price_softdrink = number_format((float)get_option('bar_softdrink_price_field'), 2, '.', '');  // Outputs -> 105.00
                    $price_beer = number_format((float)get_option('bar_beer_price_field'), 2, '.', '');

                    if ($card_balance >= $price_beer) {
                        _e('You can keep going.<br>', 'bar');
                    } else {
                        _e('<span style="color: #ff0000;">Oh noo!</span>, I have some bad news.<br>', 'bar');
                    }

                    $nummber_of_beers = $card_balance / $price_beer;
                    $nummber_of_softdrinks = $card_balance / $price_softdrink;

                    print("Your balance is <b>" .  $card_balance . " </b> bar coins.<br>
                    <br>
                    This is anouth to get <b>" . round($nummber_of_beers, 4) . " </b> beer(s) <br>
                    or to get <b>" . round($nummber_of_softdrinks, 4) . "</b> softdrink(s). <br>
                    Cheers!!");

                    bar_balance_again_button();
                    return;
                }
            }
        } else { {
                //print de velden etc        
                _e('<span style="color: #ff0000;"> Fields with * are mandatory.</span><b>', 'bar');
?>
                <form method="POST" name="bar_saldo_form">
                    <p>
                        <label for="card_uid"> <?php _e('Card UID:*', 'bar') ?> </label>
                        <input type="nummber" name="card_uid" required>
                    </p>
                    <?php echo apply_filters('gglcptch_display_recaptcha', '', 'bar_saldo_form'); ?>
                    <input type="submit" name="get_balance" value='Get balance'>
                    </p>
                </form>
<?php
            }
        }
    }
    else
    {
        _e('<span style="color: #ff0000;">Error:</span> You dont have permision for this page.<br>', 'bar'); 
    }
}


function bar_balance_again_button()
{
    print("<br>");
    ?>
    <div class="btn-group">
        <form action="/">
            <input type="submit" value="Another nummber" />
        </form>
        &nbsp;
    </div>
<?php
}