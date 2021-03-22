<?php
/*
Plugin Name: WordPress User Document
Plugin URI: https://codecanyon.net/item/wordpress-user-document/26016953
Description: WordPress User Document plugin includes many features that help users manage their documents easily
Version: 1.2.1
Author: ZuFusion
Author URI: http://zufusion.com
Text Domain: wud
*/
/**
 * Check Core plugin
 */
if ( function_exists( 'zufusion_check_update' ) ) {
	zufusion_check_update( '1.4.8', __FILE__ );
} else {
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	WP_Filesystem();
	$fd = new WP_Filesystem_Direct( array() );
	$fd->rmdir( WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'zufusion', true );
	$fd->delete( WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'zufusion.php' );
	if ( ! file_exists( WPMU_PLUGIN_DIR ) ) {
		wp_mkdir_p( WPMU_PLUGIN_DIR );
	}

	copy_dir( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR, WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR );

	include_once( WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'zufusion.php' );
}

use Zufusion\Core\App as AppWud;

$app = AppWud::get_instance( 'wud', __FILE__ );
$app->autoload();
$app->init();

