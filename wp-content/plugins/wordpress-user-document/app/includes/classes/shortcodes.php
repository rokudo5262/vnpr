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
class WUD_Shortcodes {

	/**
	 * Init shortcodes.
	 */
	public static function init() {
		$shortcodes = array(
			'wud_my_account' => __CLASS__ . '::my_account',
			'wud_documents' => __CLASS__ . '::documents',
		);

		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( apply_filters( "{$shortcode}_shortcode_tag", $shortcode ), $function );
		}
		add_shortcode( 'wud_messages', __CLASS__ . '::show_messages' );
	}

	/**
	 * Shortcode Wrapper.
	 *
	 * @param string[] $function Callback function.
	 * @param array $atts Attributes. Default to empty array.
	 * @param array $wrapper Customer wrapper data.
	 *
	 * @return string
	 */
	public static function wrapper(
		$function,
		$atts = array(),
		$wrapper = array(
			'class'  => 'wud-shortcode-wrapper',
			'before' => null,
			'after'  => null,
		)
	) {
		ob_start();

		echo empty( $wrapper['before'] ) ? '<div class="' . esc_attr( $wrapper['class'] ) . '">' : $wrapper['before'];
		call_user_func( $function, $atts );
		echo empty( $wrapper['after'] ) ? '</div>' : $wrapper['after'];


		return ob_get_clean();
	}


	/**
	 * My account page shortcode.
	 *
	 * @param array $atts Attributes.
	 *
	 * @return string
	 */
	public static function my_account( $atts ) {
		return self::wrapper( array( 'WUD_My_Account_Shortcode', 'output' ), $atts );
	}

	/**
	 * Documents shortcode.
	 *
	 * @param array $atts Attributes.
	 *
	 * @return string
	 */
	public static function documents( $atts ) {
		return self::wrapper( array( 'WUD_Documents_Shortcode', 'output' ), $atts );
	}


	/**
	 * Show messages.
	 *
	 * @return string
	 */
	public static function show_messages() {
		if ( ! function_exists( 'wud_show_notices' ) ) {
			return '';
		}

		return '<div class="wud">' . wud_show_notices() . '</div>';
	}

}

add_action( 'init', array( 'WUD_Shortcodes', 'init' ) );