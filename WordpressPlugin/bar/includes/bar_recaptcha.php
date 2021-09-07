<?php
defined('ABSPATH') OR exit;

function add_custom_recaptcha_forms_bar_see_balance($forms)
{
    $forms['bar_see_balance_form'] = array("form_name" => "Bar balance");
    return $forms;
}
add_filter('gglcptch_add_custom_form', 'add_custom_recaptcha_forms_bar_see_balance');

function add_custom_recaptcha_forms_bar_add_card_form($forms)
{
    $forms['bar_add_card_form'] = array("form_name" => "Bar add card");
    return $forms;
}
add_filter('gglcptch_add_custom_form', 'add_custom_recaptcha_forms_bar_add_card_form');

function add_custom_recaptcha_forms_bar_add_balance_form($forms)
{
    $forms['bar_add_balance_form'] = array("form_name" => "Bar add balance");
    return $forms;
}
add_filter('gglcptch_add_custom_form', 'add_custom_recaptcha_forms_bar_add_balance_form');

function add_custom_recaptcha_forms_bar_buy_form($forms)
{
    $forms['bar_buy_form'] = array("form_name" => "Bar buy");
    return $forms;
}
add_filter('gglcptch_add_custom_form', 'add_custom_recaptcha_forms_bar_buy_form');

function add_custom_recaptcha_forms_bar_card_info_form($forms)
{
    $forms['bar_card_info_form'] = array("form_name" => "Bar card info");
    return $forms;
}
add_filter('gglcptch_add_custom_form', 'add_custom_recaptcha_forms_bar_card_info_form');