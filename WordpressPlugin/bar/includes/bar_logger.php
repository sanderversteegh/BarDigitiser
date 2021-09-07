<?php
defined('ABSPATH') or exit;

function bar_log(array $log_array){
    global $wpdb;
    global $bar_log_table;
    
    if (array_key_exists('card_uid', $log_array)){
        $card_uid =     $log_array ['card_uid'];
    } else {
        $card_uid = NULL;
    }
    if (array_key_exists('source', $log_array)){
        $source =     $log_array ['source'];
    } else {
        $source = NULL;
    }
    if (array_key_exists('card_balance', $log_array)){
        $card_balance =     $log_array ['card_balance'];
    } else {
        $card_balance = NULL;
    }
    if (array_key_exists('log', $log_array)){
        $log =     $log_array ['log'];
    } else {
        $log = NULL;
    }
    $dt = current_time('Y-m-d H:i:s');
    $current_user = wp_get_current_user();
    $user_name = $current_user -> user_login;
    

    $wpdb->insert(
        $bar_log_table,
        array(
            'card_uid'       => $card_uid,
            'card_balance'     => $card_balance,
            'users_name'     => $user_name,
            'source'     => $source,
            'log'     => $log,            
            'date_time' => $dt
        )
    );
    return;
}