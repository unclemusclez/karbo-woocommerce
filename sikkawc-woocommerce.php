<?php
/*

Plugin Name: Sikka for WooCommerce
Plugin URI: https://github.com/unclemusclez/sikka-woocommerce/
Description: Sikka for WooCommerce plugin allows you to accept payments in Sikkas for physical and digital products at your WooCommerce-powered online store.
Version: 0.01
Author: unclemusclez
Author URI: https://github.com/unclemusclez/sikka-woocommerce/
License: BipCot NoGov Software License bipcot.org

*/


// Include everything
include (dirname(__FILE__) . '/sikkawc-include-all.php');

//---------------------------------------------------------------------------
// Add hooks and filters

// create custom plugin settings menu
add_action( 'admin_menu',                   'SIKKAWC_create_menu' );

register_activation_hook(__FILE__,          'SIKKAWC_activate');
register_deactivation_hook(__FILE__,        'SIKKAWC_deactivate');
register_uninstall_hook(__FILE__,           'SIKKAWC_uninstall');

add_filter ('cron_schedules',               'SIKKAWC__add_custom_scheduled_intervals');
add_action ('SIKKAWC_cron_action',             'SIKKAWC_cron_job_worker');     // Multiple functions can be attached to 'SIKKAWC_cron_action' action

SIKKAWC_set_lang_file();
//---------------------------------------------------------------------------

//===========================================================================
// activating the default values
function SIKKAWC_activate()
{
    global  $g_SIKKAWC__config_defaults;

    $sikkawc_default_options = $g_SIKKAWC__config_defaults;

    // This will overwrite default options with already existing options but leave new options (in case of upgrading to new version) untouched.
    $sikkawc_settings = SIKKAWC__get_settings ();

    foreach ($sikkawc_settings as $key=>$value)
    	$sikkawc_default_options[$key] = $value;

    update_option (SIKKAWC_SETTINGS_NAME, $sikkawc_default_options);

    // Re-get new settings.
    $sikkawc_settings = SIKKAWC__get_settings ();

    // Create necessary database tables if not already exists...
    SIKKAWC__create_database_tables ($sikkawc_settings);
    SIKKAWC__SubIns ();

    //----------------------------------
    // Setup cron jobs

    if ($sikkawc_settings['enable_soft_cron_job'] && !wp_next_scheduled('SIKKAWC_cron_action'))
    {
    	$cron_job_schedule_name = $sikkawc_settings['soft_cron_job_schedule_name'];
    	wp_schedule_event(time(), $cron_job_schedule_name, 'SIKKAWC_cron_action');
    }
    //----------------------------------

}
//---------------------------------------------------------------------------
// Cron Subfunctions
function SIKKAWC__add_custom_scheduled_intervals ($schedules)
{
	$schedules['seconds_30']     = array('interval'=>30,     'display'=>__('Once every 30 seconds'));
	$schedules['minutes_1']      = array('interval'=>1*60,   'display'=>__('Once every 1 minute'));
	$schedules['minutes_2.5']    = array('interval'=>2.5*60, 'display'=>__('Once every 2.5 minutes'));
	$schedules['minutes_5']      = array('interval'=>5*60,   'display'=>__('Once every 5 minutes'));

	return $schedules;
}
//---------------------------------------------------------------------------
//===========================================================================

//===========================================================================
// deactivating
function SIKKAWC_deactivate ()
{
    // Do deactivation cleanup. Do not delete previous settings in case user will reactivate plugin again...

    //----------------------------------
    // Clear cron jobs
    wp_clear_scheduled_hook ('SIKKAWC_cron_action');
    //----------------------------------
}
//===========================================================================

//===========================================================================
// uninstalling
function SIKKAWC_uninstall ()
{
    $sikkawc_settings = SIKKAWC__get_settings();

    if ($sikkawc_settings['delete_db_tables_on_uninstall'])
    {
        // delete all settings.
        delete_option(SIKKAWC_SETTINGS_NAME);

        // delete all DB tables and data.
        SIKKAWC__delete_database_tables ();
    }
}
//===========================================================================

//===========================================================================
function SIKKAWC_create_menu()
{

    // create new top-level menu
    // http://www.fileformat.info/info/unicode/char/e3f/index.htm
    add_menu_page (
        __('Woo Sikka', SIKKAWC_I18N_DOMAIN),                    // Page title
        __('Sikka', SIKKAWC_I18N_DOMAIN),                        // Menu Title - lower corner of admin menu
        'administrator',                                        // Capability
        'sikkawc-settings',                                        // Handle - First submenu's handle must be equal to parent's handle to avoid duplicate menu entry.
        'SIKKAWC__render_general_settings_page',                   // Function
        plugins_url('/images/sikka_16x.png', __FILE__)      // Icon URL
        );

    add_submenu_page (
        'sikkawc-settings',                                        // Parent
        __("WooCommerce Sikka Gateway", SIKKAWC_I18N_DOMAIN),                   // Page title
        __("General Settings", SIKKAWC_I18N_DOMAIN),               // Menu Title
        'administrator',                                        // Capability
        'sikkawc-settings',                                        // Handle - First submenu's handle must be equal to parent's handle to avoid duplicate menu entry.
        'SIKKAWC__render_general_settings_page'                    // Function
        );

}
//===========================================================================

//===========================================================================
// load language files
function SIKKAWC_set_lang_file()
{
    # set the language file
    $currentLocale = get_locale();
    if(!empty($currentLocale))
    {
        $moFile = dirname(__FILE__) . "/lang/" . $currentLocale . ".mo";
        if (@file_exists($moFile) && is_readable($moFile))
        {
            load_textdomain(SIKKAWC_I18N_DOMAIN, $moFile);
        }

    }
}
//===========================================================================

