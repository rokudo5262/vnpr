<?php
/**
 * WPEventsImporter FacebookApi Importer Class
 *
 * @package wpeventsimporter
 */

namespace WPEventsImporter\API;

use WPEventsImporter\Exceptions\APIException;
use WPOauth\OAuth;

class Facebook extends OAuth
{
	const FB_URL					= 'https://www.facebook.com';

	const FB_GRAPH_API_URL			= 'https://graph.facebook.com';

	const FB_API_VERSION			= '5.0';

	const WP_PLUGIN_DOMAIN			= 'wpeventsimporter';

	const WP_SETTINGS_PREFIX_NAME	= 'wpeventsimporter_fb';

	protected $api_version;

	protected $api_name;

	protected $api_id;

	protected $api_secret;

	protected $api_url;

	protected $curl;

	protected $access_token;

	protected $selected_user_page_id;

	protected $settings;

	protected $wp_option_name;

	protected $return_url;

	protected $redirect_uri;

	protected $oauth_connection;



	/**
	* Facebook Api constructor.
	*
	* @param $client_id
	* @param $client_secret
	*/
	public function __construct( $client_id, $client_secret )
	{
		$fb_args = [
			'oauth_url' 	=> self::FB_GRAPH_API_URL . '/v' . self::FB_API_VERSION,
			'locate_domain' => self::WP_PLUGIN_DOMAIN,
			'settings_name' => self::WP_SETTINGS_PREFIX_NAME,
			'client_secret' => $client_secret,
			'client_id'	 	=> $client_id,
			'return_url'	=> admin_url( 'admin.php?page=wpeventsimporter' ),
			'request_args'  => [
				'url'			=> self::FB_URL . '/v' . self::FB_API_VERSION,
				'service_name'  => 'dialog/oauth',
				'method'		=> 'GET',
				'data'			=> [
					'referenced'	=> [ 'client_id', 'redirect_uri' ],
					'manual'		=> [
						'state' => md5( uniqid( rand(), true ) ),
						'scope' => 'user_events,public_profile,manage_pages',
					]
				]
			],
			'token_args' => [
				'service_name'  => 'oauth/access_token',
				'method'		=> 'GET',
				'data'			=> [
					'referenced' => [ 'code', 'client_secret', 'client_id', 'redirect_uri' ],
				]
			],
			'check_args' => [
				'service_name'		=> 'me',
				'method'			=> 'GET',
				'data'				=> [
					'access_token'
				],
				'expired_control'   => [
					'compare' => [ 'error' => [ 'type' => 'OAuthException' ] ]
				]
			]
		];

		parent::__construct( $fb_args );
	}



	/**
 	* Gets the user pages from facebook and save them in wp settings
 	*/
	public function save_user_pages()
	{
		$access_token	= $this->get_token();

		if ( empty( $access_token ) ) return false;

		$url_args	= [
			'access_token'	=> $access_token,
			'limit'			=> '100',
			'offset'		=> '0',
		];

		$accounts	= $this->get_remote_api_data( 'me/accounts', $url_args );
		$accounts	= isset( $accounts->data ) ? $accounts->data : array();

		if ( ! empty( $accounts ) ) {
			$pages = array();

			foreach ( $accounts as $account ) {
				$pages[ $account->id ] = [
					'id' => $account->id,
					'name' => $account->name,
					'access_token' => $account->access_token
				];
			}

			$this->set_option( 'user_pages', $pages );

			return true;
		}

		return false;
	}



	/**
 	* @param int $id
 	*/
	public function set_events_page( $id )
	{
		if ( ! empty( $id ) ) {
			$this->selected_user_page_id = $id;
		}
	}



	/**
 	* @param string $name
	*
 	* @return mixed
 	*/
	public function get_setting( $name )
	{
		if ( isset( $this->settings[ $name ] ) ) {
			return $this->settings[ $name ];
		}

		return false;
	}



	/**
 	* @param object $api_data
	*
 	* @return object|bool
 	*/
	protected function _get_owner_data( $api_data )
	{
		$access_token	= $this->get_token();
		$event_data		= [ $api_data ];

		if ( ! $access_token ) {
			throw new APIException( 'Invalid access token!' );
		}

		if ( isset( $api_data->data ) ) {
			$event_data = $api_data->data;
		} else {
			$event_data = $api_data;
		}

		if ( is_array( $event_data ) ) {
			$new_api_data = [ 'data' => [] ];

			foreach ( $event_data as $data_row => $data_val ) {
				// Skip next when owner data doesn`t exists
				if ( ! isset( $data_val->owner ) ) continue;

				$org_args			= [
					'fields' => 'id,name,link,phone,emails,location',
					'access_token' => $access_token
				];
				$api_org_data	= $this->get_remote_api_data( $data_val->owner->id, $org_args );
				$modified_row	= (array)$data_val;

				// Skip next when no owner record has been found
				if ( ! $api_org_data ) continue;

				$modified_row[ 'organizations' ] = $api_org_data;

				$modified_row = (object)$modified_row;

				$new_api_data[ 'data' ][ $data_row ] = $modified_row;
			}

			$api_data = (object)$new_api_data;
		}

		return $api_data;
	}



	public function get_single_event( $id, $args )
	{
		$fields = 'id,name,description,category,start_time,end_time,event_times,cover,' .
		'timezone,place,is_canceled,updated_time,attending_count,maybe_count,' .
		'ticket_uri,noreply_count,owner,can_guests_invite,parent_group';

		$status = 'upcoming';

		if ( isset( $args[ 'event_status' ] ) ) {
			$status = $args[ 'event_status' ];
		}

		$access_token	= $this->get_token();
		$event_args		= array(
			'time_filter'	=> $status,
		);

		if ( isset( $args[ 'fields' ] ) && is_array( $args[ 'fields' ] ) ) {
			if ( count( $args[ 'fields' ] ) > 0 ) {
				$event_args[ 'fields' ] = implode( ',', $args[ 'fields' ] );
			}
		} else {
			$event_args[ 'fields' ] = $fields;
		}

		if ( ! empty( $access_token ) ) {
			$event_args[ 'access_token' ] = $access_token;
			$api_data = $this->get_remote_api_data( $id, $event_args );
		}

		if ( isset( $api_data->error ) ) {
			// Errors
			throw new APIException( $api_data->error->type );

			return false;
		}
		$api_data = $this->_get_owner_data( $api_data );

		if ( ! $api_data ) {
			$api_data = $api_data->data[ 0 ];
		}

		return $api_data;
	}



	/**
 	* @param array $fields
 	* @return array|bool|mixed|object
 	*/
	public function get_events( $args )
	{
		$fields = 'id,name,description,category,start_time,end_time,event_times,cover,' .
		'ticket_uri,timezone,place,is_canceled,updated_time,attending_count,' .
		'maybe_count,noreply_count,owner,can_guests_invite,parent_group';

		$status = 'upcoming';

		if ( isset( $args[ 'event_status' ] ) ) {
			$status = $args[ 'event_status' ];
		}

		$selected_page = $this->_get_selected_user_page();

		if ( ! $selected_page ) {
			return false;
		}

		$page_id		= $selected_page[ 'id' ];
		$page_token	= $selected_page[ 'access_token' ];

		$event_args = array(
			'limit'	  		=> 999,
			'time_filter'	=> $status,
		);

		if ( isset( $args[ 'fields' ] ) && is_array( $args[ 'fields' ] ) ) {
			if ( count( $args[ 'fields' ] ) > 0 ) {
				$event_args[ 'fields' ] = implode( ',', $args[ 'fields' ] );
			}
		} else {
			$event_args[ 'fields' ] = $fields;
		}

		if ( ! empty( $page_token ) ) {
			$event_args[ 'access_token' ] = $page_token;
			$api_data = $this->get_remote_api_data( $page_id . '/events', $event_args );

			if ( isset( $api_data->error ) && $api_data->error->type == "OAuthException" ) {
				// Errors
				throw new APIException( $api_data->error->type );
			} else {
				$this->save_user_pages();
			}

			$api_data = $this->_get_owner_data( $api_data );

			return $api_data;
		}

		return false;
	}



	/**
 	* @return bool
 	*/
	protected function _get_selected_user_page()
	{
		if ( isset( $this->selected_user_page_id ) ) {
			$user_page_id = $this->selected_user_page_id;
		} else {
			return false;
		}

		$user_pages = $this->get_user_pages();

		return $user_pages[ $user_page_id ];
	}



	/**
 	* @return bool|array
 	*/
	public function get_user_pages()
	{
		$this->save_user_pages();
		$user_pages = get_option( self::WP_SETTINGS_PREFIX_NAME . '_user_pages' );

		return $user_pages;
	}
}
