<?php
/**
* Plugin Name: Eventchamp Elements
* Plugin URI: https://themeforest.net/user/gloriathemes
* Description: The elements of Eventchamp theme is exists in the plugin.
* Version: 1.7.4
* Author: Gloria Themes
* Author URI: https://gloriathemes.com/
*/

if( !defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}

final class eventchamp_core_plugin {

	/*====== Constants ======*/
	const VERSION = '1.7.3';
	const MINIMUM_PHP_VERSION = '5.0';

	/*====== Constructor ======*/
	public function __construct() {

		/* Load translation */
		add_action( 'init', array( $this, 'i18n' ) );

		/* Init plugin */
		add_action( 'plugins_loaded', array( $this, 'init' ) );

	}

	/*====== Load Textdomain ======*/
	public function i18n() {

	   load_plugin_textdomain( 'eventchamp-core' );

	}

	/*====== Initialize The Plugin ======*/
	public function init() {

		/*====== Check PHP Version ======*/
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {

			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );

			return;

		}

		/*====== Main Files ======*/
		require_once ( dirname( __FILE__ ) . '/user-social-media.php' );
		require_once ( dirname( __FILE__ ) . '/post-types.php' );
		require_once ( dirname( __FILE__ ) . '/custom-post-types.php' );

		/*====== Special Theme Files ======*/
		if( get_option( 'stylesheet' ) == 'eventchamp' or get_option( 'stylesheet' ) == 'eventchamp-child' ) {

			if( function_exists( 'vc_map' ) ) {

				require_once ( dirname( __FILE__ ) . '/page-builder-elements.php' );
				require_once ( dirname( __FILE__ ) . '/template-studio.php' );
		 
			}

			require_once ( dirname( __FILE__ ) . '/widgets.php' );

		}

	}

	/*====== PHP Version Admin Notice ======*/
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) {

			unset( $_GET['activate'] );

		}

		$message = sprintf( esc_html__( '%1$s requires %2$s version must be %3$s or greater.', 'eventchamp-core' ), '<strong>' . esc_html__( 'Eventchamp Core', 'eventchamp-core' ) . '</strong>', '<strong>' . esc_html__( 'PHP', 'eventchamp-core' ) . '</strong>', self::MINIMUM_PHP_VERSION );

		printf( '<div class="notice notice-warning is-dismissible">%1$s</div>', wpautop( $message ) );

	}

}
new eventchamp_core_plugin();