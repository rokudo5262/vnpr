<?php

namespace WPEventsImporter;

use WPEventsImporter\API\Facebook;
use WPEventsImporter\API\Meetup;
use WPEventsImporter\API\Eventbrite;
use WPEventsImporter\API\Ical;
use WPEventsImporter\API\XML;
use WPEventsImporter\Exceptions\APIException;
use WPOauth\OAuth;

class EventsManager
{
	protected $settings_list;

	protected $facebook;

	protected $eventbrite;

	protected $meetup;

	protected $ical;

	protected $xml;



	public function __get( $name )
	{
		return self::connect( $name );
	}



	public function __call( $method, $params )
	{
		return false;
	}



	protected static function _set_api_connection( $platform )
	{
		$api_settings	= Admin::get_connection_settings();
		$api			= null;
		$api_			= null;

		if ( ! empty( $api_settings ) ) {
			// Append null values if not setted
			$api_settings += [
				'eventbrite_api_id'		=> null,
				'eventbrite_api_secret'	=> null,
				'facebook_api_id'		=> null,
				'facebook_api_secret'	=> null,
				'meetup_api_key'		=> null,
				'meetup_api_secret'		=> null,
			];

			$eb_id		= $api_settings[ 'eventbrite_api_id' ];
			$eb_key		= $api_settings[ 'eventbrite_api_secret' ];

			$fb_id		= $api_settings[ 'facebook_api_id' ];
			$fb_key		= $api_settings[ 'facebook_api_secret' ];

			$mup_id		= $api_settings[ 'meetup_api_key' ];
			$mup_key	= $api_settings[ 'meetup_api_secret' ];
		}

		if ( $platform === 'eventbrite' ) {
			if ( ! empty( $eb_id ) && ! empty( $eb_key ) ) {
				// Eventbrite API references
				$api_ = new Eventbrite( $eb_id, $eb_key );
			}

		} elseif( $platform === 'facebook' ) {
			if ( ! empty( $fb_id ) && ! empty( $fb_key ) ) {
				// Facebook API references
				$api_ = new Facebook( $fb_id, $fb_key );
			}

		} elseif ( $platform === 'meetup' ) {
			if ( ! empty( $mup_id ) && ! empty( $mup_key ) ) {
				// Meetup API references
				$api_ = new Meetup( $mup_id, $mup_key );
			}

		} elseif ( $platform === 'xml' ) {
			// XML API
			$api = new XML();

		} elseif ( $platform === 'ical' ) {
			// ICAL API
			$api = new Ical();
		}

		if ( ! empty( $api_ ) ) {

			if ( $api_ instanceof OAuth ) {
				$api = $api_;
			} else {
				throw new APIException( $platform . ' API doesn`t have OAuth class ' );
			}
		}

		if ( empty( $api ) ) {
			return new static();
		}

		return $api;
	}



	public static function connect( $platform )
	{
		try {
			$api = self::_set_api_connection( $platform );
		} catch ( APIException $err ) {
			$err->push();

			return new static();
		}

		return $api;
	}



	public static function get( $import_setting )
	{
		$new_events	= [];
		$platform	= $import_setting[ 'platform' ];

		try {
			$events = self::_get_api_events( $import_setting );

			if ( ! empty( $events ) ) {
				if ( is_array( $events ) ) {
					foreach ( $events as $event ) {
						$new_events[] = Formats::convert_data_array( $platform, $event );
					}
				} else {
					$new_events[] = Formats::convert_data_array( $platform, $events );
				}
			}
		} catch ( APIException $err ) {
			$err->push();

			return false;
		}

		if ( empty( $new_events ) ) return false;

		return $new_events;
	}



	protected static function _get_api_events( $import_setting )
	{
		$args			= [];
		$events_data	= [];
		$platform		= $import_setting[ 'platform' ];
		$event_api		= self::connect( $platform );

		if ( $event_api === false ) return false;

		if ( isset( $import_setting[ 'event_status' ] ) ) {
			$args[ 'event_status' ] = $import_setting[ 'event_status' ];
		}

		// Eventbrite
		if ( $platform === 'eventbrite' ) {
			$import_page_limit	= 'page_count';
			$current_page		= 'page_number';
			$events_container	= 'events';
			$pagination_name	= 'pagination';

			if ( isset( $import_setting[ 'eb_selected_organizer_id' ] ) ) {
				$args[ 'organizer_id' ] = $import_setting[ 'eb_selected_organizer_id' ];
			}

			$events = $event_api->get_events( $args );

			if ( ! $events ) return false;

			if ( ! isset( $events->{ $events_container } ) ) {
				return false;
			}

			return $events->{ $events_container };
		}

		// Facebook
		if ( $platform === 'facebook' ) {
			if ( isset( $import_setting[ 'event_id' ] ) && ! empty( $import_setting[ 'event_id' ] ) ) {
				$event = $event_api->get_single_event( $import_setting[ 'event_id' ], $args );
				if ( isset( $event->data ) ) {
					$data = $event->data;

					if ( ! is_array( $event->data ) ) {
						return false;
					}
				} elseif ( isset( $event->name ) ) {
					$data = $event;
				}

				return $data;
			} elseif ( isset( $import_setting[ 'fb_selected_user_page_id' ] ) ) {

				if ( empty( $import_setting[ 'fb_selected_user_page_id' ] ) ) {
					return false;
				}

				$event_api->set_events_page( $import_setting[ 'fb_selected_user_page_id' ] );
				$events = $event_api->get_events( $args );

				if ( ! $events ) {
					return false;
				}

				return ( isset( $events->data ) ) ? $events->data : false;
			}
		}

		// Meetup
		if ( $platform === 'meetup' ) {
			$import_page_limit	= 'page_count';
			$current_page		= 'page_number';
			$pagination_name	= 'meta';

			if ( isset( $import_setting[ 'mup_selected_group_id' ] ) ) {
				$args[ 'group_urlname' ] = $import_setting[ 'mup_selected_group_id' ];
			} elseif ( isset( $import_setting[ 'event_id' ] ) ) {
				$args[ 'group_urlname' ] = $import_setting[ 'event_id' ];
			}

			$events	= $event_api->get_events( $args );

			if ( ! $events ) {
				return false;
			}

			return $events;
		}

		// ICAL
		if ( $platform === 'ical' ) {
			if ( isset( $import_setting[ 'ical_source_file' ][ 'url' ] ) ) {
				$import_source = $import_setting[ 'ical_source_file' ][ 'url' ];
			} elseif ( ! empty( $import_setting[ 'ical_source_url' ] ) ) {
				$import_source = $import_setting[ 'ical_source_url' ];
			} else {
				return false;
			}

			$event_api->load_events( $import_source );
			$events = $event_api->get_events();

			if ( ! $events ) {
				return false;
			}

			return $events;
		}

		// XML
		if ( $platform === 'xml' ) {

			if ( isset( $import_setting[ 'xml_source_file' ][ 'url' ] ) ) {
				$import_source = $import_setting[ 'xml_source_file' ][ 'url' ];
			} elseif ( ! empty( $import_setting[ 'xml_source_url' ] ) ) {
				$import_source = $import_setting[ 'xml_source_url' ];
			} else {
				return false;
			}

			$events = $event_api->load_xml( $import_source )->get_results();

			if ( ! $events ) {
				return false;
			}

			return $events;
		}

		return false;
	}



	public static function callback_init()
	{
		$facebook	= self::connect( 'facebook' );
		$eventbrite	= self::connect( 'eventbrite' );
		$meetup		= self::connect( 'meetup' );

		if ( $facebook instanceof OAuth ) {
			// Facebook API callback hooks
			$facebook->callback_init();
		}

		if ( $eventbrite instanceof OAuth ) {
			// Eventbrite API callback hooks
			$eventbrite->callback_init();
		}

		if ( $meetup instanceof OAuth ) {
			// Meetup API callback hooks
			$meetup->callback_init();
		}
	}
}
