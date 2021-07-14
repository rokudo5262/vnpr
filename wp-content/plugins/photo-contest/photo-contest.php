<?php

/**
 *
 * @package   Photo Contest WordPress Plugin
 * @author    Zbyněk Hovorka
 * @link      http://galleryplugins.com/photo-contest/
 * @copyright 2014-2018 Zbyněk Hovorka
 *
 * @wordpress-plugin
 * Plugin Name:       Photo Contest WordPress Plugin
 * Plugin URI:        http://galleryplugins.com/photo-contest/
 * Description:       Thanks to Photo Contest WordPress Plugin you can easily organize a photo contest on your website.
 * Version:           4.2
 * Author:            Zbyněk Hovorka
 * Author URI:        http://galleryplugins.com/photo-contest/
 * Text Domain:       photo-contest

 */

// If this file is called directly, abort.

if ( ! defined( 'WPINC' ) ) {
	die;
}

//Run updates
$plugin_version = get_option('pcplugin-version');
if (empty($plugin_version) or $plugin_version !="4.2") {
	include_once( plugin_dir_path( __FILE__ ) . 'install-tables.php' );
	update_option('pcplugin-version', '4.2');
}

//Define a main HOOK - Very important
function photo_contest_hook() {
  do_action('photo_contest_hook');
}


define( 'PHOTODIR', plugin_dir_path( __FILE__ ) );

/*

 *  Reqire classes

 */

require_once( plugin_dir_path( __FILE__ ) . 'class-photo-contest.php' );
require_once( plugin_dir_path( __FILE__ ) . 'widget-photo-contest.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-photo-contest-admin.php' );


/*

 * Register hooks that are fired when the plugin is activated or deactivated.

 * When the plugin is deleted, the uninstall.php file is loaded.

 */

register_activation_hook( __FILE__, array( 'Photo_Contest', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Photo_Contest', 'deactivate' ) );


/*
 *  Load classes
 */

add_action( 'plugins_loaded', array( 'Photo_Contest', 'get_instance' ) );
add_action( 'plugins_loaded', array( 'Photo_Contest_Admin', 'get_instance' ) );


/*

 *  Include shortcodes

 */

include_once( plugin_dir_path( __FILE__ ) . 'shortcodes/shortcodes.php');

/*
 *  Include functions
 */


if (is_admin()){
   require_once( plugin_dir_path( __FILE__ ) . 'includes/admin/pc-admin-functions.php' );
}

//Global functions
include_once(plugin_dir_path( __FILE__ ) . 'includes/pc-cron-functions.php' );
//Load SEO
if (isset($_GET['contest']) and $_GET['contest'] == 'photo-detail') {
	include_once(plugin_dir_path( __FILE__ ) .'includes/pc-seo.php');
}


?>
