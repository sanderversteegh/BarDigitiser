<?php

defined('ABSPATH') or exit;

//------------------------------test---------------------------------
add_action('rest_api_init', function () {
  register_rest_route('bar/v1', '/author', array(
    'methods' => 'GET',
    'callback' => 'my_awesome_func',
    'args' => array(
      'id' => array(
        'validate_callback' => function ($param, $request, $key) {
          return is_numeric($param);
        }
      ),
    ),
    'permission_callback' => function () {
      return current_user_can('edit_others_posts');
    }
  ));
});


function my_awesome_func(WP_REST_Request $request)
{

  $card_uid = $request['UID'];

  list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spent, $card_register_date, $enable, $massage) = bar_get_card($card_uid);



  $response = array("Name" => (string)$card_name, "card_balance" => (string)$card_balance);


  return $response;
}

//------------------------------add_balance---------------------------------

add_action('rest_api_init', function () {
  register_rest_route('bar/v1', '/add_balance', array(
    'methods' => 'POST',
    'callback' => 'API_add_balance',
    'args' => array(
      'id' => array(
        'validate_callback' => function ($param, $request, $key) {
          return is_numeric($param);
        }
      ),
    ),
    'permission_callback' => function () {
      return current_user_can('add_balance');
    }
  ));
});


function API_add_balance(WP_REST_Request $request)
{

  $card_uid = $request['UID'];

  $body_obj = json_decode($request->get_body());
  $add_quantity = $body_obj->add_quantity;

  list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code) = bar_get_card($card_uid);

  if ($code !== NULL){
    return $code;
  }

  $new_balance = bar_add_balance($card_uid, $add_quantity);

  bar_log(array(
    'card_uid'  => $card_uid,
    'log'       => 'Added ' . $add_quantity . ' BC succes!',
    'card_balance' => $new_balance,
    'source' => 'API'
));

  $response = array("card_name" => $card_name, "card_balance" => $new_balance);


  return $response;
}


//------------------------------Buy---------------------------------

add_action('rest_api_init', function () {
  register_rest_route('bar/v1', '/buy', array(
    'methods' => 'POST',
    'callback' => 'API_buy',
    'args' => array(
      'id' => array(
        'validate_callback' => function ($param, $request, $key) {
          return is_numeric($param);
        }
      ),
    ),
    'permission_callback' => function () {
      return current_user_can('sell');
    }
  ));
});


function API_buy(WP_REST_Request $request)
{

  $card_uid = $request['UID'];

  $body_obj = json_decode($request->get_body());
  $product = $body_obj->product;

  list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code) = bar_get_card($card_uid);

  if ($code != NULL) {
    return $code;
  } else {

    $return_v = bar_buy($card_uid, $product);

    if ($return_v != NULL) {
      return $return_v;
    }
  }

  $old_balance = $card_balance;
  list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $code) = bar_get_card($card_uid);

  bar_log(array(
    'card_uid'  => $card_uid,
    'log'       => 'Bought '. $product . ' with succes! Old balance ' . $old_balance . ' BC.',
    'card_balance' => $card_balance,
    'source' => 'API'
));

  $response = array("card_name" => $card_name, "card_balance" => $card_balance);
  return $response;
}


//------------------------------add card---------------------------------

add_action('rest_api_init', function () {
  register_rest_route('bar/v1', '/add_card', array(
    'methods' => 'POST',
    'callback' => 'API_add_card',
    'args' => array(
      'id' => array(
        'validate_callback' => function ($param, $request, $key) {
          return is_numeric($param);
        }
      ),
    ),
    'permission_callback' => function () {
      return current_user_can('add_card');
    }
  ));
});


function API_add_card(WP_REST_Request $request)
{

  $card_uid = $request['UID'];

  $body_obj = json_decode($request->get_body());
  $card_name = $body_obj->card_name;

  $return_code = bar_add_card($card_uid, $card_name);

  if ($return_code != NULL) {
    return $return_code; 
  }

  list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spend, $card_register_date, $enable, $massage, $r_code) = bar_get_card($card_uid);
  
  bar_log(array(
    'card_uid'  => $card_uid,
    'log'       => 'Added card with succes! New card name is ' . $card_name,
    'source' => 'API'
      ));

  $response = array("card_name" => $card_name, "card_balance" => $card_balance);
  return $response;
}


//------------------------------get balance---------------------------------
add_action('rest_api_init', function () {
  register_rest_route('bar/v1', '/get_balance', array(
    'methods' => 'GET',
    'callback' => 'my_get_balance',
    'args' => array(
      'id' => array(
        'validate_callback' => function ($param, $request, $key) {
          return is_numeric($param);
        }
      ),
    ),
    'permission_callback' => function () {
      return current_user_can('see_balance');
    }
  ));
});


function my_get_balance(WP_REST_Request $request)
{

  $card_uid = $request['UID'];

  list($id, $card_uid, $card_name, $card_balance, $nummber_softdrink, $nummber_beer, $total_spent, $card_register_date, $enable, $massage, $code) = bar_get_card($card_uid);

  if ($code != NULL) {
    return $code; 
  }

  $response = array("card_name" => (string)$card_name, "card_balance" => (string)$card_balance);


  return $response;
}