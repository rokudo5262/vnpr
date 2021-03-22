<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Helpers\Apphelper;

/**
 * WUD_Form_Handler class.
 */
class WUD_Form_Handler {

	/**
	 * Hook in methods.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'watch' ), 14 );
	}

	/**
	 * Watch
	 */
	public static function watch() {
		/**
		 * ignore this watch if it is a request ajax
		 */
		if (wp_doing_ajax()) {
			return;
		}

		if ( isset( $_GET['wud_delete_doc'] ) ) {
			$delete = intval( $_GET['wud_delete_doc'] );
			if ( $delete == 1 ) {
				Apphelper::set_var( 'zufusion', 'site', 'REQUEST' );
				Apphelper::set_var( 'zufusionapp', 'wud', 'REQUEST' );
				Apphelper::set_var( 'controller', 'doc', 'REQUEST' );
				Apphelper::set_var( 'task', 'delete', 'REQUEST' );
			}
		}

		wud_app()->start();
	}
}

WUD_Form_Handler::init();
