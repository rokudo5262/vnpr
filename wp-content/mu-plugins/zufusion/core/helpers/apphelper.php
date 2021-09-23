<?php
/**
 * @version    $Id$
 * @package   ZuFusion Core
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Zufusion\Core\Helpers;
/**
 * Class Apphelper
 *
 * @package Zufusion\Core\Helpers
 */
class Apphelper {
	/**
	 * Get value by type
	 *
	 * @param string $name variable name.
	 * @param string $type input type.
	 * @param string $filter filter variable.
	 * @param string $default default value.
	 *
	 * @return mixed|string|string[]|null
	 */
	public static function get_var( $name, $type = 'GET', $filter = 'cmd', $default = '' ) {
		$input = $default;
		switch ( strtoupper( $type ) ) {
			case 'GET':
				if ( isset( $_GET[ $name ] ) ) {
					$input = self::filter( $_GET[ $name ] , $filter );
				}
				break;
			case 'POST':
				if ( isset( $_POST[ $name ] ) ) {
					$input = self::filter( $_POST[ $name ] , $filter ) ;
				}
				break;
			case 'REQUEST':
				if ( isset( $_REQUEST[ $name ] ) ) {
					$input = self::filter( $_REQUEST[ $name ] , $filter ) ;
				}
				break;
			case 'FILES':
				if ( isset( $_FILES[ $name ] ) ) {
					$input = self::filter( $_FILES[ $name ] , $filter );
				}
				break;
			case 'COOKIE':
				if ( isset( $_COOKIE[ $name ] ) ) {
					$input = self::filter( $_COOKIE[ $name ] , $filter );
				}
				break;
			case 'SERVER':
				if ( isset( $_SERVER[ $name ] ) ) {
					$input = self::filter( $_SERVER[ $name ] , $filter );
				}
				break;
			default:
				break;
		}



		return $input;
	}
	/**
	 * Set value by type
	 *
	 * @param string $name variable name.
	 * @param string $value value.
	 * @param string $type input type.
	 * @param string $filter filter variable.
	 */
	public static function set_var( $name, $value = '', $type = 'GET', $filter = 'none') {

		switch ( strtoupper( $type ) ) {
			case 'GET':
				$_GET[ $name ] = self::filter( $value, $filter );
				break;
			case 'POST':
				$_POST[ $name ] = self::filter( $value, $filter );
				break;
			case 'REQUEST':
				$_REQUEST[ $name ] = self::filter( $value, $filter );
				break;
			case 'FILES':
				$_FILES[ $name ] = self::filter( $value, $filter );
				break;
			case 'COOKIE':
				$_FILES[ $name ] = self::filter( $value, $filter );
				break;
			case 'SERVER':
				$_SERVER[ $name ] = self::filter( $value, $filter );
				break;
			default:
				break;
		}
	}

	/**
	 * Filter input
	 * @param string $input
	 * @param string $filter
	 *
	 * @return int|string|string[]|null
	 */
	public static function filter( $input = '', $filter = 'none') {

		switch ( strtolower( $filter ) ) {
			case 'cmd' :
				$input = preg_replace( '/[^a-z\.]+/', '', strtolower( $input ) );
				break;
			case 'int' :
				$input = intval( $input );
				break;
			case 'bool':
				$input = $input ? 1 : 0;
				break;
			case 'string':
				$input = sanitize_text_field( $input );
				break;
			case 'none':
				break;
			default :
				$input = null;
				break;
		}

		return $input;
	}

}
