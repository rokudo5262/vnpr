<?php

namespace WPEventsImporter;

class UpdateHelper
{
	protected $plugin_data = null;

	protected static $updateReady;

	protected static $code;

	protected static $version;

	protected static $token;

	protected static $slug;

	protected static $errors;

	protected static $itemID;

	protected static $pluginFile;

	protected static $updateOptionName;



	public static function init( $slug, $base, $version, $code, $token, $item )
	{
		if ( empty( $item ) ) return;

		self::$slug				= $slug;
		self::$pluginFile		= $base;
		self::$updateOptionName	= $slug . '_update_status';
		self::$code				= $code;
		self::$version			= $version;
		self::$itemID			= $item;
		self::$token			= $token;
		self::$updateReady		= \get_option( self::$updateOptionName );

		$obj = new static();

		$hook = "in_plugin_update_message-" . self::$pluginFile;

		add_filter( 'pre_set_site_transient_update_plugins', [ $obj, 'updateTransient' ] );

		add_action( $hook, [ $obj, 'updateMessage' ], 10, 2 );

		add_filter( 'plugins_api', [ $obj, 'pluginsInfo' ], 10, 3 );

		return $obj;
	}


	/**
	 * Checks whether verification of Envato form data
	 *
	 * @return bool|string
	 */
	public static function isValidated()
	{
		$obj = new static();
		$obj->download();

		$errors = self::$errors;

		if ( isset( $errors->message ) && ! empty( $errors->message ) ) {
			return $errors->message;
		}

		return false;
	}



	public static function isNewVersion( $version )
	{
		if ( version_compare( self::$version, $version, '<' ) ) {
			return true;
		}

		return false;
	}



	public function pluginsInfo( $false, $action, $arg )
	{
		if ( $arg->slug === self::$slug ) {
			$pluginData = $this->getPluginData();
			$pluginInfo = (object) [];
			$pluginInfo->lastUpdate = date( "Y-m-d G:i:s" );
			$pluginInfo->sections[ 'description' ] = $pluginData[ 'wordpress_plugin_metadata' ][ 'description' ];

			preg_match(
				"#.*<h3 id=\"item-description__change-log\">Change log</h3>(.*)(?:<h3)?.*#siu",
				$pluginData[ 'description' ],
				$changelog
			);

			$pluginInfo->sections[ 'changelog' ] = $changelog[ 1 ];

			return $pluginInfo;
		}
	}



	public function request( $url )
	{
		if ( empty( $url ) || empty( self::$token ) ) {
			return false;
		}

		$args = [
			'headers' => array(
				'Authorization' => 'Bearer ' . self::$token,
				'User-Agent'    => 'ENVATO Updater',
			),
			'timeout' => 14,
		];

		$response			= wp_remote_get( esc_url_raw( $url ), $args );
		$response_code    	= wp_remote_retrieve_response_code( $response );
		$response_message	= wp_remote_retrieve_response_message( $response );

		if ( intval( $response_code / 100 ) === 4 ) {
			$errors = (object) [];
			$errors->message = $response_message;
			self::$errors = $errors;
		}

		if ( ! empty( $response->errors ) && isset( $response->errors[ 'http_request_failed' ] ) ) {
			return false;
		}

		return json_decode( wp_remote_retrieve_body( $response ), true );
	}



	public function download()
	{
		$code = self::$code;

		if ( empty( $code ) ) {
			return;
		}

		$downloadName = self::$slug . '_downloaded_file';
		$downloadedFileUrl = \get_transient( $downloadName );

		if ( ! empty( $downloadedFileUrl ) ) {
			return $downloadedFileUrl;
		}

		$url = 'https://api.envato.com/v3/market/buyer/download?purchase_code=' . $code;
		$response = $this->request( $url );

		if ( ! isset( $response[ 'wordpress_plugin' ] ) ) {
			return false;
		}

		if ( ! empty( $response[ 'wordpress_plugin' ] ) ) {
			\set_transient( $downloadName, $response[ 'wordpress_plugin' ], 600 );
			return $response[ 'wordpress_plugin' ];
		}

		return false;
	}



	public function getPluginData()
	{
		if ( ! empty( $this->plugin_data ) ) {
			return $this->plugin_data;
		}

		$url = 'https://api.envato.com/v3/market/catalog/item?id=' . self::$itemID;
		$response = $this->request( $url );

		if ( ! isset( $response[ 'wordpress_plugin_metadata' ] ) ) {
			return false;
		}

		$this->plugin_data = $response;

		return $this->plugin_data;
	}



	public static function getUpdateStatus()
	{
		if( self::$updateReady !== false ) {
			return true;
		}

		return false;
	}



	protected static function _setUpdateStatus( $status )
	{
		if ( $status && ! empty( self::$updateOptionName ) ) {
			\update_option( self::$updateOptionName, '1' );
			self::$updateReady = true;
		}
	}



	public static function checkUpdates()
	{
		$obj	= new static();
		$init	= $obj->getPluginData();

		if ( isset( $init[ 'wordpress_plugin_metadata' ][ "requires_php" ] ) ) {
			$requires_php	= $init[ 'wordpress_plugin_metadata' ][ "requires_php" ];

			if ( version_compare( phpversion(), $requires_php, '>=' ) ) {
				return false;
			}
		}

		if ( $init && ! empty( $init[ 'wordpress_plugin_metadata' ][ 'version' ] ) ) {
			$version = $init[ 'wordpress_plugin_metadata' ][ 'version' ];

			if ( self::isNewVersion( $version ) ) {
				self::_setUpdateStatus( true );

				return $version;
			}

			self::_setUpdateStatus( false );
		}

		return false;
	}



	public function updateMessage( $data, $response )
	{
		if ( self::getUpdateStatus() ) {
			return;
		}

		$license_link = '<a href="' . \admin_url( '?page=' . self::$slug . '-license' ) . '">license</a>';

		printf(
			esc_html__(
				" To receive automatic updates license activation is required." .
				" Please visit %s page to activate your Events Importer Plugin.",
				self::$slug
			),
			$license_link
		);
	}



	public function updateTransient( $transient )
	{
		if ( isset( $transient->response[ self::$pluginFile ] ) ) {
			return $transient;
		}

		$new_version = self::checkUpdates();

		if ( ! $new_version ) {
			return $transient;
		}

		$new_response = array(
			'slug'        => self::$slug,
			'plugin'      => self::$pluginFile,
			'new_version' => $new_version,
			'url'         => '',
			'package'     => $this->download(),
		);

		$transient->response[ self::$pluginFile ] = (object) $new_response;

		return $transient;
	}
}
?>
