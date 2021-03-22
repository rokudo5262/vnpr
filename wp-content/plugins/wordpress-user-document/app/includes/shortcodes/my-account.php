<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Shortcodes class.
 */
class WUD_My_Account_Shortcode {

	/**
	 * Output the shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 */
	public static function output( $atts ) {
		global $wp;

		if ( ! is_user_logged_in() ) {
			$message = apply_filters( 'wud_my_account_message', '' );

			if ( ! empty( $message ) ) {
				wud_store_notices( 'error', $message, false );
			}

			include wud_get_template( 'my-account/required-login', false );

		} else {

			ob_start();

			// Output the new account page.
			$args = shortcode_atts(
				array(),
				$atts
			);

			include wud_get_template( 'my-account/content', false );

			// Send output buffer.
			ob_end_flush();
		}
	}

}