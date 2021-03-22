<?php
/**
 * Wordpress event importer tool
 *
 * @package wpeventsimporter
 * @license GPL v3
 * Plugin Name: WP Events Importer
 * Plugin URI: https://gloriathemes.com/
 * Description: Eventbrite, Facebook, Meetup, Ical, XML event importer plugin.
 * Version: 1.0.0
 * Author: GloriaThemes
 * Author URI: https://gloriathemes.com/
 * License: GPL v3
 * Text Domain : wpeventsimporter
 * Domain Path:  /languages/
 * Requires PHP: 5.6.5 or later
 */

defined( 'ABSPATH' ) or die( esc_html__( 'No script kiddies please!', 'wpeventsimporter' ) );

if ( ! defined( 'WPEVENTSIMPORTER_VERSION' ) ) {
	define( 'WPEVENTSIMPORTER_VERSION', '1.0.0' );
}

if ( ! defined( 'WPEVENTSIMPORTER_PATH' ) ) {
	define( 'WPEVENTSIMPORTER_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WPEVENTSIMPORTER_BASENAME' ) ) {
	define( 'WPEVENTSIMPORTER_BASENAME', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'WPEVENTSIMPORTER_DOMAIN' ) ) {
	define( 'WPEVENTSIMPORTER_DOMAIN', 'wpeventsimporter' );
}

require_once( WPEVENTSIMPORTER_PATH . 'vendor/autoload.php' );

use WPEventsImporter\Main;

$wpEventsImporter = new Main();

// Load localize
load_plugin_textdomain( WPEVENTSIMPORTER_DOMAIN, false, WPEVENTSIMPORTER_PATH . '/languages' );

// Activate hook
register_activation_hook( __FILE__, array( $wpEventsImporter, 'activate' ) );

// Deactivate hook
register_deactivation_hook( __FILE__, array( $wpEventsImporter, 'deactivate' ) );

// Uninstall hook
register_uninstall_hook( __FILE__, 'WPEventsImporter\Main::uninstall' );

unset( $wpEventsImporter );
