<?php
defined('ABSPATH') OR exit;

add_shortcode('bar_card_info', 'bar_card_info');

function bar_card_info()
{
    if (current_user_can('see_card_info')) {
    global $card_balance_table;

    $captcha_response = apply_filters('gglcptch_verify_recaptcha', true, 'string', 'bar_card_info_form');



    if (isset($_POST['get_balance'])) {
        $card_uid = esc_textarea($_POST["card_uid"]);

        //if (true !== $captcha_response) {
        if (true !== $captcha_response) {  
            printf(__( '<span style="color: #ff0000;">Error: </span>%s<br>', 'bar' ),
            $captcha_response);
        }
        else
        {
            //bar_saldo_lookup($card_uid);

            list($id, $card_uid, $card_name, $card_balance, $nummber_softdrinks, $nummber_beer, $total_spend, $card_register_date, $enable, $massage) = bar_get_card($card_uid);
            if ($massage != NULL){
                _e($massage);
            }
            else
            {
                
                


                printf(__( 'Card UID = <b>%s</b> <br>', 'bar' ),
                            $card_uid);
                printf(__( 'Card name = <b>%s</b> <br>', 'bar' ),
                            $card_name);
                printf(__( 'Card balance = <b>%s</b> <br>', 'bar' ),
                            $card_balance);
                if (current_user_can('see_card_info_detail')) {
                printf(__( 'Nummber of softdrink(s) = <b>%s</b> <br>', 'bar' ),
                            $nummber_softdrinks);
                printf(__( 'Nummber of beer(s) = <b>%s</b> <br>', 'bar' ),
                            $nummber_beer);
                printf(__( 'Total spend = <b>%s</b> <br>', 'bar' ),
                            $total_spend);
                }
                printf(__( 'Card register date = <b>%s</b> <br>', 'bar' ),
                            $card_register_date);
                printf(__( 'Card enabled = <b>%s</b> <br>', 'bar' ),
                            $enable);
                return;
            } 
        }



    }
    else
    {
        {
            //print de velden etc        
            _e( '<span style="color: #ff0000;"> Fields with * are mandatory.</span><b>', 'bar' );
    ?>
            <form method="POST" name="bar_saldo_form">
                <p>
                    <label for="card_uid"> <?php _e( 'Card UID:*', 'bar' ) ?> </label>
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
    else {
        _e('<span style="color: #ff0000;">Error:</span> You dont have permision for this page.<br>', 'bar');
    }

}

