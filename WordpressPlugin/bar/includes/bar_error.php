<?php

defined('ABSPATH') or exit;

function status_codes($code_id, $card_uid)
{

    if ($code_id == 0) {
        return;
    } elseif ($code_id == 1) {
        $return = new WP_Error('card_exists', __('<span style="color: #ff0000;">Error:</span> Card allready exist in database.', 'bar'), array('status' => 406));
    } elseif ($code_id == 2) {
        $return = new WP_Error('write_error', __('<span style="color: #ff0000;">Error:</span> Something wend whrong with writing to the database, contact the administrator.', 'bar'), array('status' => 502));
    } elseif ($code_id == 3) {
        $return = new WP_Error('card_unkown', __('<span style="color: #ff0000;">Error:</span> The card with this ID is unkown.', 'bar'), array('status' => 405));
    } elseif ($code_id == 4) {
        $return = new WP_Error('double_ID', __('<span style="color: #ff0000;">Error:</span> There are multple record found with this ID. Contact the developer.', 'bar'), array('status' => 503));
    } elseif ($code_id == 5) {
        $return = new WP_Error('card_diabled', __('<span style="color: #ff0000;">Error:</span> This card has been sed as diabled.', 'bar'), array('status' => 101));
    } elseif ($code_id == 6) {
        $return = new WP_Error('no_balance', __('<span style="color: #ff0000;">Error:</span> Not anouth balance.', 'bar'), array('status' => 102));
    } elseif ($code_id == 7) {
        $return = new WP_Error('product_unkown', __('<span style="color: #ff0000;">Error:</span> This product is unkown by the system', 'bar'), array('status' => 504));
    } else {
        $return = new WP_Error('unkown code', __('<span style="color: #ff0000;">Error:</span> This error code is unkown by the system', 'bar'), array('status' => 501));
    }

    bar_log(array(
        'card_uid'  => $card_uid,
        'log'       => $return -> get_error_code()
    ));

    return $return;

}

