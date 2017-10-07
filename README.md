# Sikka for WooCommerce

Sikka for WooCommerce is a Wordpress plugin that allows merchants to accept SIKKA at WooCommerce-powered online stores.

Contributors: unclemusclez, KittyCatTech, gesman

Tags: sikka, sikka wordpress plugin, sikka plugin, sikka payments, accept sikka, sikkas

Requires at least: 3.0.1

Tested up to: Wordpress 4.8.2, WooCommerce 3.1.2

Stable tag: trunk

License: BipCot NoGov Software License bipcot.org

License URI: https://github.com/unclemusclez/sikka-woocommerce/blob/master/LICENSE

## Description

Your online store must use WooCommerce platform (free wordpress plugin).
Once you have installed and activated WooCommerce, you may install and activate Sikka for WooCommerce.

### Benefits 

* Fully automatic operation.
* Can be used with view only wallet so only the view private key is on the server and none of the spend private keys are required to be kept anywhere on your online store server.
* Accept payments in Sikkas directly into your Sikka wallet.
* Sikka wallet payment option completely removes dependency on any third party service and middlemen.
* Accept payment in Sikkas for physical and digital downloadable products.
* Add Sikka option to your existing online store with alternative main currency.
* Flexible exchange rate calculations fully managed via administrative settings.
* Zero fees and no commissions for Sikka processing from any third party.
* Set main currency of your store in USD, SIKKA or BTC.
* Automatic conversion to Sikka via realtime exchange rate feed and calculations.
* Ability to set exchange rate calculation multiplier to compensate for any possible losses due to bank conversions and funds transfer fees.


## Installation 


1.  Install WooCommerce plugin and configure your store (if you haven't done so already - http://wordpress.org/plugins/woocommerce/).
2.  Install "Sikka for WooCommerce" wordpress plugin just like any other Wordpress plugin.
3.  Activate.
4.  Download and install on your computer Sikka wallet program from: http://getsikka.org/
5.  Copy and setup your wallet on the server. Change permission to executable. Run sikkad as a service.
6.  Generate Container (optionally reset containter to view only container and add view only address). Run walletd as a service.
7.  Get your wallet address from walletd.
8.  Within your site's Wordpress admin, navigate to:
	    WooCommerce -> Settings -> Checkout -> Sikka
	    and paste your wallet address into "Wallet Address" field.
9.  Select "Sikka service provider" = "Local Wallet" and fill-in other settings at Sikka management panel.
10. Press [Save changes]
11. If you do not see any errors - your store is ready for operation and to access payments in Sikkas!


## Remove plugin

1. Deactivate plugin through the 'Plugins' menu in WordPress
2. Delete plugin through the 'Plugins' menu in WordPress


## Changelog

none

## Donate

XMR Address   : `41kGrwzD9jzTgdRJbGZ3YbGBTJezqWYD1AGyRgBQkTmcXkyJoGABQ1V5ra1vxiQmd4Hk3dsuxbvqKR3sJqN9YN8y7v3oVWr`
SIKKA Address : `39eYXNT9K4w2oJyP8VVfbtRErPqnudarPZFRqABCrwbSEAs7Ma64sosS1rn1bzLDK4ZWwUiHfyWCcUBG1iVWVXKYUut3xsm`