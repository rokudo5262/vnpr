<?php
/**
 * WPEventsImporter Main Class
 * @package wpeventsimporter
 */

namespace WPEventsImporter;

class Main
{
	protected $admin;



	public function __construct()
	{
		AjaxProgress::init();

		$license_settings = Admin::get_license_settings();
		$token	= null;
		$code	= null;

		if ( isset( $license_settings[ 'license_token' ] ) ) {
			$token	= $license_settings[ 'license_token' ];
		}

		if ( isset( $license_settings[ 'purchase_code' ] ) ) {
			$code	= $license_settings[ 'purchase_code' ];
		}

		UpdateHelper::init(
			WPEVENTSIMPORTER_DOMAIN, // slug
			WPEVENTSIMPORTER_BASENAME, // base
			WPEVENTSIMPORTER_VERSION, //version
			$code,
			$token,
			'' // Envato Plugin Item ID
		);

		// Admin Handler
		$this->admin = new Admin();

		// Bootstrap loader
		add_action( 'init', array( $this, 'bootstrap_loader' ), 0 );

		// Admin init
		add_action( 'admin_init', array( $this->admin, 'init' ) );
	}



	public function __clone()
	{
		_e( 'Don\'t waste your time', WPEVENTSIMPORTER_DOMAIN );
	}



	public function activate()
	{
		global $wpdb;

		$queue_table		= Formats::get_db_table_name( 'queue' );
		$charset_collate	= $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $queue_table (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  event_id varchar(50) NOT NULL,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  name tinytext NOT NULL,
		  event_data longtext NOT NULL,
		  origin varchar(120) DEFAULT '' NOT NULL,
		  settings text NULL,
		  import_type varchar(120) DEFAULT '' NOT NULL,
		  PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}



	public function deactivate()
	{
		// Code space
	}



	public static function uninstall()
	{
		global $wpdb;

		// Security control for vulnerability attempts
		if ( ! current_user_can( 'delete_plugins' ) ) {
			wp_die( 'Cheating!' );
		}

		$table_names = Formats::get_db_table_name();
		$sql = '';

		foreach ( $table_names as $table_name ) {
			if ( empty( $table_name ) ) {
				continue;
			}

			$sql .= "DROP TABLE IF EXISTS $table_name;";
		}

		$wpdb->query( $sql );

		// Remove options
		$admin_forms = new Admin();
		$admin_forms->get_single_form()->remove_settings();
		$admin_forms->get_multi_form()->remove_settings();
		$admin_forms->get_connection_form()->remove_settings();
	}



	public function bootstrap_loader()
	{
		EventsManager::callback_init();

		// Define cron schedules
		add_filter( 'cron_schedules', 'WPEventsImporter\CronManager::importer_cron_intervals' );

		// Trigger the event importer
		add_action( 'init', 'WPEventsImporter\CronManager::import_events_trigger', 20 );
	}
}
