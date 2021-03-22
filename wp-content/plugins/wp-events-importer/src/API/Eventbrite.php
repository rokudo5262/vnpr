<?php

/**
 * WPEventsImporter EventbriteApi Importer Class
 *
 * https://www.eventbriteapi.com/v3
 *
 * GET
 * https://www.eventbrite.com/oauth/authorize?response_type=code&client_id=[KEY]
 *
 * POST
 * https://www.eventbrite.com/oauth/token
 * 'code'=>$code, 'client_secret'=>$client_secret, 'client_id'=>$app_key,
 * 'grant_type'=>'authorization_code'
 *
 * @package wpeventsimporter
 */

namespace WPEventsImporter\API;


use WPOauth\OAuth;

class Eventbrite extends OAuth
{
	const WP_SETTINGS_PREFIX_NAME = 'wpeventsimporter_eventbrite';

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
			'oauth_url'		=> 'https://www.eventbriteapi.com/v3',
			'locate_domain' => 'wpeventsimporter',
			'settings_name' => 'wpeventsimporter_eventbrite',
			'client_secret' => $client_secret,
			'client_id'	 	=> $client_key,
			'return_url'	=> admin_url( 'admin.php?page=wpeventsimporter' ),
			'request_args'  => [
				'url'			=> 'https://www.eventbrite.com',
				'service_name'  => 'oauth/authorize',
				'method'		=> 'GET',
				'data'			=> [
					'referenced'	=> [ 'client_id' ],
					'manual'		=> [ 'response_type' => 'code' ],
				]
			],
			'token_args' 	=> [
				'url'			=> 'https://www.eventbrite.com',
				'service_name'  => 'oauth/token',
				'method'		=> 'POST',
				'data'			=> [
					'referenced'	=> [ 'code', 'client_secret', 'client_id' ],
					'manual'		=> [ 'grant_type' => 'authorization_code' ]
				]
			]
		];

		parent::__construct( $configs );
	}



	function set_refresh_token( $token )
	{
		if ( ! empty( $token ) ) {
			$this->refresh_token = $token;
			$this->set_option( 'refresh_token', $this->refresh_token );
		}
	}



	public function get_events( array $args )
	{
		$api_token		= $this->get_token();

		// OAuth service name for fetching events which belong to connected user
		$service_name	= 'users/me/events/';
		$status = 'live';

		if ( isset( $args[ 'event_status' ] ) ) {
			$status = $args[ 'event_status' ];
		}

		// If organizer_id exists, set the OAuth service name in order to fetch the events of the organizer.
		if ( isset( $args[ 'organizer_id' ] ) ) {
			$service_name = 'organizers/' . $args[ 'organizer_id' ] . '/events/';
		}

		if ( ! empty( $api_token ) ) {
			$event_args = [
				'token'		=> $api_token,
				'status'	=> $status,
				'expand'	=> 'category,organizer,venue',
			];
			// Fetches remote events data from API
			$api_events_data = $this->get_remote_api_data( $service_name, $event_args );

			if ( ! isset( $api_events_data->events ) ) {
				return false;
			}

			return $api_events_data;
		}

		return false;
	}
}
