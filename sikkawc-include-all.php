<?php
/*
Sikka for WooCommerce
https://github.com/unclemusclez/sikka-woocommerce/
*/

//---------------------------------------------------------------------------
// Global definitions
if (!defined('SIKKAWC_PLUGIN_NAME'))
  {
  define('SIKKAWC_VERSION',           '0.01');

  //-----------------------------------------------
  define('SIKKAWC_EDITION',           'Standard');    

  //-----------------------------------------------
  define('SIKKAWC_SETTINGS_NAME',     'SIKKAWC-Settings');
  define('SIKKAWC_PLUGIN_NAME',       'Sikka for WooCommerce');   


  // i18n plugin domain for language files
  define('SIKKAWC_I18N_DOMAIN',       'sikkawc');

  }
//---------------------------------------------------------------------------

//------------------------------------------
// Load wordpress for POSTback, WebHook and API pages that are called by external services directly.
if (defined('SIKKAWC_MUST_LOAD_WP') && !defined('WP_USE_THEMES') && !defined('ABSPATH'))
   {
   $g_blog_dir = preg_replace ('|(/+[^/]+){4}$|', '', str_replace ('\\', '/', __FILE__)); // For love of the art of regex-ing
   define('WP_USE_THEMES', false);
   require_once ($g_blog_dir . '/wp-blog-header.php');

   // Force-elimination of header 404 for non-wordpress pages.
   header ("HTTP/1.1 200 OK");
   header ("Status: 200 OK");

   require_once ($g_blog_dir . '/wp-admin/includes/admin.php');
   }
//------------------------------------------


// This loads necessary modules
require_once (dirname(__FILE__) . '/libs/forknoteWalletdAPI.php');

require_once (dirname(__FILE__) . '/sikkawc-cron.php');
require_once (dirname(__FILE__) . '/sikkawc-utils.php');
require_once (dirname(__FILE__) . '/sikkawc-admin.php');
require_once (dirname(__FILE__) . '/sikkawc-render-settings.php');
require_once (dirname(__FILE__) . '/sikkawc-sikka-gateway.php');

?>