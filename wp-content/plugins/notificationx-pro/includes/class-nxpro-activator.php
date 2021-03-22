<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link       https://wpdeveloper.net
 * @since      1.0.0
 * @package    NotificationX Pro
 * @subpackage NotificationX Pro/includes
 * @author     WPDeveloper <support@wpdeveloper.net>
 */
class NotificationXPro_Activator {
	/**
	 * my modules
	 * @var array
	 * @since 1.1.1
	 */
	protected static $my_modules = [];
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		/**
		 * Free installer 
		 * @since 1.1.3
		 */
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'includes/class-install-notificationx.php';
		new NotificationX_Installer();
		/**
		 * Making pro modules active by default.
		 * @since 1.1.1
		 */
		self::save_modules();
		/**
		 * Reqrite the rules on activation.
		 */
		flush_rewrite_rules();
	}
	/**
	 * Saving the modules data.
	 * @return void
	 * @since 1.1.1
	 */
	protected static function save_modules(){
		$saved_settings = NotificationX_DB::get_settings();
		$pro_modules = NotificationX_Settings::settings_args();
		$pro_modules = NotificationX_Settings::get_modules( $pro_modules['general']['sections']['modules_sections']['fields'] );
		$active_modules = isset( $saved_settings['nx_modules'] ) ? $saved_settings['nx_modules'] : [];
		array_walk( $pro_modules[1], array( __CLASS__, 'modules'), $active_modules );
		
		if( empty( $active_modules ) ) {
			$active_modules = array_merge( array_fill_keys( array_keys( $pro_modules[0] ), true ), self::$my_modules );
		} else {
			$active_modules = array_merge( self::$my_modules, $active_modules );
		}
		$saved_settings['nx_modules'] = $active_modules;
		NotificationX_DB::update_settings( $saved_settings );
	}
	/**
	 * Helper function for modules
	 * @since 1.1.1
	 */
	protected static function modules( &$item, $key, $active_modules ) {
		if( isset( $active_modules[ $key ] ) ) {
			self::$my_modules[ $key ] = $active_modules[ $key ];
		} else {
			self::$my_modules[ $key ] = true;
			if( is_string( $item ) ) {
				self::$my_modules[ $key ] = version_compare( NOTIFICATIONX_PRO_VERSION, $item, '>=' );
			}
		}
	}
}
