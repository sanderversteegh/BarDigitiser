<?php
defined('ABSPATH') OR exit;


//----------------------------------------------------get menu button in menu------------------

add_action('admin_menu', 'bar_menu');

function bar_menu()
{
add_menu_page('Bar', 'Bar', 'edit_bar_options', 'bar_main-slug', 'bar_mainmenu');
	add_submenu_page('bar_main-slug', 'Settings', 'Settings', 'edit_prices', 'bar_settings-slug', 'bar_settings');
}

function bar_mainmenu()
{
    ?>
	<div class="wrap pmc-fs">
	<?php
	echo '<div class="wrap"><h2>Bar settings</h2>';
	bar_settings_page();
}


//----------------------------------------------------Create the settings------------------

function bar_settings_init()
{
    register_setting('bar', 'bar_softdrink_price_field');
    register_setting('bar', 'bar_beer_price_field');

    add_settings_section(
        'bar_settings_section',
        __('Pricing settings.', 'bar'),
        'bar_section_cb',
        'bar'
    );
    add_settings_field(
        'bar_softdrink_price_field', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Price of a softdrink', 'bar'), //The label bevore a setting
        'bar_softdrink_price_cb',
        'bar',
        'bar_settings_section',
        array(
            'Price in bar coins'
        )
    );
    // register a new field in the "wporg_section_developers" section, inside the "wporg" page
    add_settings_field(
        'bar_beer_price_field', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Price of a beer', 'bar'), //The label bevore a setting
        'bar_beer_price_cb',
        'bar',
        'bar_settings_section',
        array(
            'Price in bar coins'
        )
    );
}

//----------------------------------------------------Visualise the settings------------------

function bar_softdrink_price_cb($args)
{
    // Note the ID and the name attribute of the element should match that of the ID in the call to add_settings_field
    $html = '<input type="nummber" id="bar_softdrink_price_field" name="bar_softdrink_price_field" value="' . get_option('bar_softdrink_price_field') . '"/>';

    // Here, we will take the first argument of the array and add it to a label next to the checkbox
    $html .= '<label for="bar_softdrink_price_field"> '  . $args[0] . '</label>';

    echo $html;
}

function bar_beer_price_cb($args)
{
    // Note the ID and the name attribute of the element should match that of the ID in the call to add_settings_field
    $html = '<input type="nummber" id="bar_beer_price_field" name="bar_beer_price_field" value="' . get_option('bar_beer_price_field') . '"/>';

    // Here, we will take the first argument of the array and add it to a label next to the checkbox
    $html .= '<label for="bar_beer_price_field"> '  . $args[0] . '</label>';

    echo $html;
}



/**
 * register our wporg_settings_init to the admin_init action hook
 */
add_action('admin_init', 'bar_settings_init');

// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function bar_section_cb($args)
{
?>
    <p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e('Edit here the prices of the difrent products.', 'wporg'); ?></p>
<?php
}

//----------------------------------------------------Cretae the form and save (main)------------------

function bar_settings_page()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if (isset($_GET['settings-updated'])) {
        // add settings saved message with the class of "updated"
        add_settings_error('bar_messages', 'bar_message', __('Settings Saved', 'bar'), 'updated');
    }

    // show error/update messages
    settings_errors('bar_messages');
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg"
            settings_fields('bar');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('bar');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
<?php
}