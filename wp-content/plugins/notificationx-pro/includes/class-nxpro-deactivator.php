<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link       https://wpdeveloper.net
 * @since      1.0.0
 * @package    NotificationX Pro
 * @subpackage NotificationX Pro/includes
 * @author     WPDeveloper <support@wpdeveloper.net>
 */
class NotificationXPro_Deactivator {
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		/**
		 * Reqrite the rules on deactivation.
		 */
		flush_rewrite_rules();
	}

}
