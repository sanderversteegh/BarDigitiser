<?php
defined('ABSPATH') or exit;

add_shortcode('bar_add_card', 'add_card_page');

function add_card_page()
{

    if (current_user_can('add_card')) {
        $captcha_response = apply_filters('gglcptch_verify_recaptcha', true, 'string', 'bar_add_card_form');

        if (isset($_POST['add'])) {
            $card_uid = $_POST["card_uid"];
            $card_name = esc_textarea($_POST["card_name"]);

            if (true !== $captcha_response) {
                printf(
                    _e('<span style="color: #ff0000;">Error: </span>%s<br>', 'bar'),
                    $captcha_response
                );
            } else {
                //Ga veder met zoeken
                $f_return = bar_add_card($card_uid, $card_name);
                if ($f_return == NULL){
                    _e("Card with UID <b>" . $card_uid . "</b> is added.", "bar");

                    bar_log(array(
                        'card_uid'  => $card_uid,
                        'log'       => 'Added card with succes! New card name is ' . $card_name,
                        'source' => 'browser'
                    ));

                    return;
                }
                
                elseif ($f_return->get_error_code() == 'card_exists') {
                    _e('<span style="color: #ff0000;">Error: </span> card UID: <b>' . $card_uid . '</b> allready in use.<br>', 'bar');
                    _e('Every card needs his own UID.<br><br>', 'bar');
                    bar_nogmaals_knop();
                } else
                {
                    printf($f_return->get_error_message());
                }
            }
        } else {
            //print de velden etc        
            _e('<span style="color: #ff0000;"> Fields with * are mandatory.</span><b>', 'bar');
?>
            <form method="POST" name="add_card_form">
                <p>
                    <label for="card_uid"> <?php _e('Card UID*', 'bar') ?> </label>
                    <input type="text" name="card_uid" maxlength="10" required>
                </p>
                <p>
                    <label for="card_name"><?php _e('Card name ', 'bar') ?></label>
                    <input type="text" name="card_name">
                </p>
                <p>
                    <?php echo apply_filters('gglcptch_display_recaptcha', '', 'add_card_form'); ?>
                    <input type="submit" name="add" value='add'>
                </p>
            </form>
    <?php
        }
    } else {
        _e('<span style="color: #ff0000;">Error:</span> You dont have permision for this page.<br>', 'bar');
    }
}


function bar_add_card($card_uid, $card_name)
{
    if (current_user_can('add_card')) {
        global $wpdb;
        global $card_balance_table;
        $dt = current_time('Y-m-d H:i:s');

        $check_statement = $wpdb->get_results("SELECT * FROM $card_balance_table WHERE EXISTS (SELECT card_uid FROM $card_balance_table WHERE card_uid LIKE '$card_uid')");

        if ($check_statement == true) {
            return status_codes(1, $card_uid);
        } else {

            $wpdb_return = $wpdb->insert(
                $card_balance_table,
                array(
                    'card_uid'       => $card_uid,
                    'card_name'     => $card_name,
                    'card_register_date' => $dt
                )
            );
            if ($wpdb_return == false) {
                return status_codes(2, $card_uid);
            } else {
                return;
            }
        }
    }
}


function bar_nogmaals_knop()
{
    ?>
    <div class="btn-group">
        <form action="/add-card/">
            <input type="submit" value="Probeer nogmaals" />
        </form>
        &nbsp;
    </div>
<?php
}
