<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Model;

class wudTokenModel extends Model {

	/**
	 * Create a new token
	 */
	public function create() {
		$token            = md5( uniqid( mt_rand(), true ) );
		$tokens           = get_option( 'wud_tokens', array() );
		$tokens[ $token ] = time();
		update_option( 'wud_tokens', $tokens, false );

		return $token;
	}

	/**
	 * Check if a token exists
	 *
	 * @param $token
	 *
	 * @return $token file if exist, false if not exists
	 */
	public function token_exists( $token ) {
		$tokens = get_option( 'wud_tokens', array() );
		if ( array_key_exists( $token, $tokens ) ) {
			return $token;
		}

		return false;
	}

	/**
	 * Remove a token
	 *
	 * @param $token
	 */
	public function remove_token( $token ) {
		$tokens = get_option( 'wud_tokens', array() );
		if ( array_key_exists( $token, $tokens ) ) {
			unset( $tokens[ $token ] );
			update_option( 'wud_tokens', $tokens, false );
		}

	}

	/**
	 * update a token
	 *
	 * @param $token
	 */
	public function update_token( $token ) {
		$tokens           = get_option( 'wud_tokens', array() );
		$tokens[ $token ] = time();
		update_option( 'wud_tokens', $tokens, false );
	}

	/**
	 * delete all tokens
	 */
	public function remove_tokens() {
		$tokens = get_option( 'wud_tokens', array() );
		$time   = time() - 15 * 60; //15 mins
		if ( count( $tokens ) > 0 ) {
			foreach ( $tokens as $key => $val ) {
				if ( (int) $val < $time ) {
					unset( $tokens[ $key ] );
				}
			}
		}

		update_option( 'wud_tokens', $tokens, false );
	}

	/**
	 * Store token
	 * @return mixed|null
	 */
	public function store_token() {
		$session_token = isset( $_SESSION['wud_token'] ) ? $_SESSION['wud_token'] : null;
		if ( $session_token === null ) {
			$token                 = $this->create();
			$_SESSION['wud_token'] = $token;
		} else {
			$token_id = $this->token_exists( $session_token );
			if ( $token_id ) {
				$this->update_token( $token_id );
				$token = $session_token;
			} else {
				$token                 = $this->create();
				$_SESSION['wud_token'] = $token;
			}
		}

		return $token;
	}
}
