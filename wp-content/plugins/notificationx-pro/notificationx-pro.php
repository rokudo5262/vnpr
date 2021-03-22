<?php
/**
 * @link              https://wpdeveloper.net
 * @since             1.0.0
 * @package           NotificationX Pro
 *
 * @wordpress-plugin
 * Plugin Name:       NotificationX Pro
 * Plugin URI:        https://notificationx.com/
 * Description:       Social Proof & Recent Sales Popup, Comment Notification, Subscription Notification, Notification Bar and many more.
 * Version:           1.5.2
 * Author:            WPDeveloper
 * Author URI:        https://wpdeveloper.net
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       notificationx-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'NOTIFICATIONX_PRO_VERSION', '1.5.2' );
define( 'NOTIFICATIONX_PRO_ROOT_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'NOTIFICATIONX_PRO_EXT_DIR_PATH', NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'extensions/' );
define( 'NOTIFICATIONX_PRO_ADMIN_PATH', NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'admin/' );
define( 'NOTIFICATIONX_PRO_URL', plugins_url( '/', __FILE__ ) );
define( 'NOTIFICATIONX_PRO_ADMIN_URL', NOTIFICATIONX_PRO_URL . 'admin/' );
define( 'NOTIFICATIONX_FREE_PLUGIN', NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'assets/library/notificationx.zip' );

// Licensing
define( 'NOTIFICATIONX_PRO_STORE_URL', 'https://wpdeveloper.net/' );
define( 'NOTIFICATIONX_PRO_SL_ITEM_ID', 99658 );
define( 'NOTIFICATIONX_PRO_SL_ITEM_SLUG', 'notificationx-pro' );
define( 'NOTIFICATIONX_PRO_SL_ITEM_NAME', 'NotificationX Pro' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nxpro-activator.php
 */
function activate_notificationx_pro() {
	require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'includes/class-nxpro-activator.php';
	NotificationXPro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nxpro-deactivator.php
 */
function deactivate_notificationx_pro() {
	require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'includes/class-nxpro-deactivator.php';
	NotificationXPro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_notificationx_pro' );
register_deactivation_hook( __FILE__, 'deactivate_notificationx_pro' );

function check_hook_func( $link ){
    $link = false;
    return $link;
}

require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'includes/class-nxpro.php';

function run_notificationxpro() {
	$plugin = new NotificationXPro();
	$plugin->run();
}
run_notificationxpro();


// Install Core plugin
include_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . '/includes/class-nxpro-core-installer.php';
new NotificationX_Install_Core('');

/**
 * Admin Notices
 */
function notificationx_install_core_notice() {

	$has_installed = get_plugins();
	$button_text = isset( $has_installed['notificationx/notificationx.php'] ) ? __( 'Activate Now!', 'notificationx-pro' ) : __( 'Install Now!', 'notificationx-pro' );

	if( ! class_exists( 'NotificationX' ) ) :
	?>
		<div class="error notice is-dismissible">
			<p><strong>NotificationX Pro</strong> requires <strong>NotificationX</strong> core plugin to be installed. Please get the plugin now! <button id="notificationx-install-core" class="button button-primary"><?php echo $button_text; ?></button></p>
		</div>
	<?php
	endif;
}
add_action( 'admin_notices', 'notificationx_install_core_notice' );


/**
 * Plugin Licensing
 *
 * @since v1.0.0
 */
function notificationx_plugin_licensing() {

	// Requiring Licensing Class
	require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH.'includes/licensing/nxpro-licensing.php';
	if ( is_admin() ) {
		// Setup the settings page and validation
		$licensing = new NotificationX_Licensing(
			NOTIFICATIONX_PRO_SL_ITEM_SLUG,
			NOTIFICATIONX_PRO_SL_ITEM_NAME,
			'notificationx-pro'
		);
	}

}
notificationx_plugin_licensing();

/**
 * Handles Updates
 *
 * @since 1.0.0
 */
function notificationx_plugin_updater() {

	// Requiring the Updater class
	require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH.'includes/licensing/nxpro-updater.php';

	// Disable SSL verification
	add_filter( 'edd_sl_api_request_verify_ssl', '__return_false' );

	// Setup the updater
	$license = get_option( NOTIFICATIONX_PRO_SL_ITEM_SLUG . '-license-key' );
	$updater = new NotificationX_Plugin_Updater( NOTIFICATIONX_PRO_STORE_URL, __FILE__, array(
			'version'      => NOTIFICATIONX_PRO_VERSION,
			'license'      => $license,
			'item_id'      => NOTIFICATIONX_PRO_SL_ITEM_ID,
			'author'       => 'WPDeveloper',
		)
	);
}
add_action( 'admin_init', 'notificationx_plugin_updater' );