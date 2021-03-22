<?php

namespace WPEventsImporter\API;

use WPEventsImporter\Exceptions\APIException;
use WPOauth\OAuth;

/**
 * WPEventsImporter MeetupApi Importer Class
 *
 * @package wpeventsimporter
 */

class Meetup extends OAuth
{
	const WP_SETTINGS_PREFIX_NAME = 'wpeventsimporter_meetup';

	protected $redirect_uri;

	protected $callback_request_uri;

	protected $return_uri;

	protected $access_token;

	protected $refresh_token;

	protected $client_key;

	protected $client_secret;

	protected $user_agent;



	function __construct( $client_key, $client_secret )
	{
		$configs = [
			'oauth_url'	 	=> 'https://api.meetup.com',
			'locate_domain' => 'wpeventsimporter',
			'settings_name' => 'wpeventsimporter_meetup',
			'client_secret' => $client_secret,
			'client_id'	 	=> $client_key,
			'return_url'	=> admin_url( 'admin.php?page=wpeventsimporter' ),
			'request_args'  => [
				'url'			=> 'https://secure.meetup.com',
				'service_name'  => 'oauth2/authorize',
				'method'		=> 'GET',
				'data'			=> [
					'referenced'	=> [ 'client_id', 'redirect_uri' ],
					'manual'		=> [ 'response_type' => 'code' ],
				]
			],
			'token_args' 	=> [
				'url'			=> 'https://secure.meetup.com',
				'service_name'  => 'oauth2/access',
				'method'		=> 'POST',
				'data'			=> [
					'referenced'	=> [ 'code', 'client_secret', 'client_id', 'redirect_uri' ],
					'manual'		=> [ 'grant_type' => 'authorization_code' ],
				]
			]
		];

		parent::__construct( $configs );
	}



	public function get_events( $args )
	{
		$token	= $this->get_token();
		$status	= 'upcoming';

		if ( ! $token || empty( $token ) ) {
			throw new APIException( 'Invalid access token!' );
		}

		if ( isset( $args[ 'event_status' ] ) ) {
			$status = $args[ 'event_status' ];
		}

		if ( ! isset( $args[ 'group_urlname' ] ) || empty( $args[ 'group_urlname' ] ) ) {
			$service = '/self/events';
		} else {
			$service = '/' . $args[ 'group_urlname' ] . '/events';
		}

		$args = [
			'fields'	=> 'featured_photo,fee,fee_options,group_category',
			'status'	=> $status,
			'page'		=> '20',
			'token'		=> $token,
		];

		$api_data = $this->get_remote_api_data( $service, $args );
		// var_dump( $api_data );

		if ( $api_data ) {
			if ( ! is_object( $api_data ) && ! is_array( $api_data ) ) {
				throw new APIException( 'Invalid meetup event data result!' );
			}

			if ( count( $api_data ) > 0 ) {
				return $api_data;
			}
		}

		return false;
	}
}
