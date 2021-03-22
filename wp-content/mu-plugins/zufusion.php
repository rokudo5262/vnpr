<?php
/*
Plugin Name: ZuFusion Core
Plugin URI: http://zufusion.com
Description: ZuFusion Framework for WordPress.
Version: 1.4.8
Author: ZuFusion
Author URI: http://zufusion.com
*/
/**
 * Define core version
 */
define( 'ZUFUSION_CORE_VERSION', '1.4.8' );

require_once 'zufusion/vendor/autoload.php';
require_once 'zufusion/core/includes/taxonomy_walker.php';
require_once 'zufusion/core/includes/functions.php';
/**
 * Check version
 * @param $version
 * @param string $file
 */
function zufusion_check_update( $version, $file = __FILE__ ) {

	if ( version_compare( $version, ZUFUSION_CORE_VERSION, '>' ) ) {

		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem();
		$fd = new WP_Filesystem_Direct( array() );
		$fd->rmdir( WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'zufusion', true );
		$fd->delete( WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'zufusion.php' );


		if ( ! file_exists( WPMU_PLUGIN_DIR ) ) {
			wp_mkdir_p( WPMU_PLUGIN_DIR );
		}

		copy_dir( dirname( $file ) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR, WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR );

		include_once WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'zufusion.php';

	}
}

/**
 * Autoload classes
 * @param $class
 */
function zufusion_core_autoload( $class ) {

	// Namespace prefix
	$prefix = 'Zufusion\\Core\\';

	$base_dir = __DIR__ . '/zufusion/core/';

	$len = strlen( $prefix );
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		return;
	}

	$relative_class = substr( $class, $len );

	$file = $base_dir . str_replace( '\\', '/', strtolower( $relative_class ) ) . '.php';

	if ( file_exists( $file ) ) {
		require_once $file;
	}

}

spl_autoload_register( 'zufusion_core_autoload' );