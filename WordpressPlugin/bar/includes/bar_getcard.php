<?php

function bar_get_card($card_uid){
    global $card_balance_table;
    global $wpdb;

    $id = NULL;
    
    $card_name = NULL;
    $card_balance = NULL;
    $nummber_softdrink = NULL;
    $nummber_beer = NULL;
    $total_spend = NULL;
    $card_register_date = NULL;
    $enable = NULL;
    $massage = NULL;
    $code = NULL;

    $check_statement = $wpdb->get_results("SELECT * FROM $card_balance_table WHERE EXISTS (SELECT card_uid FROM $card_balance_table WHERE card_uid LIKE '$card_uid')");

    if ($check_statement == false) {
        //Bestaat de qr code niet? error
        $massage = ( '<span style="color: #ff0000;">Error: </span> A card with UID: <b>'.$card_uid . '</b> could not been found. <br>
                    Check your input and try again.<br>');
        $code = status_codes(3, $card_uid);
        return array($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code);
        //qr code lijkt te bestaan, ga door.
    } 
    else 
    {
        $number_of_result = $wpdb->get_var("SELECT COUNT(*) FROM $card_balance_table WHERE card_uid LIKE '$card_uid'");
        
        if ($number_of_result > 1){
            $massage = ( '<span style="color: #ff0000;">Error: </span> found double UID, this should not happen. <br> 
                    <br>');
            $code = status_codes(4, $card_uid);
            return array($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code);
        
        }
        else
        {        
        $results = $wpdb->get_results("SELECT * FROM $card_balance_table WHERE card_uid LIKE '$card_uid'");
        foreach ($results as $result) {
            
            $id =                   $result   -> id;
            $card_name =            $result   -> card_name;
    (double)$card_balance =         $result   -> card_balance;
            $nummber_softdrink =    $result   -> nummber_softdrink;
            $nummber_beer =         $result   -> nummber_beer;
            $total_spend =          $result   -> total_spend;
            $card_register_date =   $result   -> card_register_date;
            $enable =               $result   -> enable;

            if ($enable == 0){
                //This card is diabled
                $massage = ('<span style="color: #ff0000;">Error: </span> this card is disabled. <br> 
                            <br>');
                $code = status_codes(5, $card_uid);
                return array($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code);
        
            }
            else
            {

                return array($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code);
            }
        }
    
    }
    }
}