<?php
defined('ABSPATH') OR exit;
/**
 * Plugin Name:         Bar
 * Description:         Bar funtionaliteit
 * Version:             1.0
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author:              Sander Versteegh
 * Text Domain:         bar
 */

global $wpdb;
$card_balance_table = $wpdb->prefix . 'card_balance';
$bar_log_table = $wpdb->prefix . 'bar_log';

require_once 'includes/add_card.php';
require_once 'includes/bar_activate_plugin.php';
require_once 'includes/bar_balance_page.php';
require_once 'includes/bar_recaptcha.php';
require_once 'includes/bar_backend_menu.php';
require_once 'includes/bar_getcard.php';
require_once 'includes/bar_add_balance.php';
require_once 'includes/bar_card_info.php';
require_once 'includes/bar_buy.php';
require_once 'includes/bar_API.php';
require_once 'includes/bar_error.php';
require_once 'includes/bar_logger.php';



/**maak de database aan waneer plugin word geactiveerd.*/
register_activation_hook( __FILE__, 'bar_plugin_activate' );



