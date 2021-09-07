<?php
defined('ABSPATH') or exit;


function bar_plugin_activate()
{
  add_bar_function();
  bar_card_tables();
  bar_log_tables();
}

/** make tables */
function bar_card_tables()
{
  global $wpdb;

  $card_saldotable = $wpdb->prefix . 'card_balance';

  $table_name = $card_saldotable;

  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $table_name (
  id mediumint(10) NOT NULL AUTO_INCREMENT,
  card_uid varchar(20) DEFAULT NULL,
  card_name varchar(50) DEFAULT NULL,
  card_balance decimal(15,2) DEFAULT 0,
  nummber_softdrink varchar(50) DEFAULT 0,
  nummber_beer varchar(50) DEFAULT 0,
  total_spend decimal(15,2) DEFAULT 0,
  card_register_date datetime DEFAULT '0000-00-00 00:00:00',
  enable varchar(1) DEFAULT 1,
  PRIMARY KEY  (id)
) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}

function bar_log_tables()
{
  global $wpdb;

  $table_name = $wpdb->prefix . 'bar_log';

  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $table_name (
  id mediumint(10) NOT NULL AUTO_INCREMENT,
  card_uid varchar(20) DEFAULT NULL,
  card_balance decimal(15,2) DEFAULT 0,
  users_name varchar(50) DEFAULT NULL,
  source varchar(50) DEFAULT NULL,
  log varchar(200) DEFAULT NULL,
  date_time datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (id)
) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}

function add_bar_function()
{

  add_role(
    'barganger',
    'Barganger',
    array(
      'read'         => true,
      'see_balance'   => true,
    )
  );

  add_role(
    'barman',
    'Barman',
    array(
      'read'        => true,
      'see_balance'   => true,
      'add_balance'   => true,
      'edit_balance'  => true,
      'see_card_info' => true,
      'sell'        => true,
      'add_card'    => true,
    )
  );

  add_role(
    'barmaster',
    'Barmaster',
    array(
      'read'        => true,
      'see_balance'   => true,
      'add_balance'   => true,
      'edit_balance'  => true,
      'sell'        => true,
      'add_card'    => true,
      'see_card_info' => true,
      'see_card_info_detail' => true,
      'edit_card_info'   => true,
      'edit_prices' => true,
      'edit_bar_options' => true,
      'see_statistics' => true,
    )
  );

  add_role(
    'terminal',
    'Terminal',
    array(
      'read'        => true,
      'see_balance'   => true,
      'see_card_info' => true,
      'sell'        => true,
    )
  );
}
