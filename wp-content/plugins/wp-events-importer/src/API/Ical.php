<?php

/**
 * WPEventsImporter icalApi Importer Class
 *
 * @package wpeventsimporter
 */

namespace WPEventsImporter\API;

use Liliumdev\ICalendar\ZCiCal;
use Liliumdev\ICalendar\ZCiCalDataNode;

class Ical extends ZCiCal
{
	// Human readable props
	const event_props = [
		'DTSTART'		=> 'start_time',
		'DTEND'			=> 'end_time',
		'CATEGORIES'	=> 'categories',
		'DTSTAMP'		=> 'timestamp',
		'ORGANIZER'		=> 'organizer',
		'UID'			=> 'user_id',
		'ATTENDEE'		=> 'attendee',
		'CLASS'			=> 'class',
		'CREATED'		=> 'create_time',
		'DESCRIPTION'	=> 'description',
		'LAST-MODIFIED'	=> 'last_modified',
		'LOCATION'		=> 'location',
		'GEO'			=> 'lat_lon',
		'SEQUENCE'		=> 'sequence',
		'STATUS'		=> 'status',
		'SUMMARY'		=> 'title',
		'TRANSP'		=> 'transp',
	];

	protected $event_flag;

	protected $events_count;

	protected $events;

	protected $event;

	protected $props;

	protected $line_number;

	protected $total_line;

	protected $min_date;

	protected $max_date;

	protected $skip;



	public function __construct()
	{
		$this->event_flag	= false;
		$this->min_date	 	= time();// today as default
		$this->max_date	 	= time() + 60*60*24*30*12;// 1 year later as default
		$this->skip		 	= false;
		$this->events_count	= 0;
	}



	public function read( $filename )
	{
		$is_url	= false;
		$stream	= null;

		if ( substr_count( $filename, '://' ) ) {
			$is_url = true;
		}

		if ( $is_url ) {
			if ( function_exists( 'wp_remote_get' ) ) {
				$remote_file	= wp_remote_get( $filename );
				$response_code	= wp_remote_retrieve_response_code( $remote_file );

				if ( ! in_array( $response_code, array( 200, 201 ) ) ) {
					return false;
				}

				$stream = wp_remote_retrieve_body( $remote_file );
			}
		} elseif( file_exists( $filename ) ) {
			$stream = file_get_contents( $filename );
		} else {
			return false;
		}

		return $stream;
	}



	public function load_events( $file = '', $max_event = 10, $start_at = 0 )
	{
		if ( ! empty( $file ) ) {
			$stream	= $this->read( $file );

			if ( $stream !== false ) {
				parent::__construct( $stream, $max_event, $start_at );
			}
		}
	}



	public function convert_time( $date )
	{
		if ( is_integer( $date ) ) {
			return $date;
		}

		return strtotime( $date );
	}



	public function min_date( $date )
	{
		$this->min_date = $this->convert_time( $date );
	}



	public function max_date( $date )
	{
		$this->max_date = $this->convert_time( $date );
	}



	public function get_events()
	{
		$results = [];

		if ( empty( $this->tree ) ) {
			return false;
		}

		foreach ( $this->tree->child as $key => $node ) {
			if ( $node->getName() == "VEVENT" ) {
				$results[ $key ] = [];

				foreach ( self::event_props as $id => $val ) {
					if ( isset( $node->data[ $id ] ) ) {
						$data = $node->data[ $id ];

						if ( $data instanceof ZCiCalDataNode ) {
							$params = $data->getParameters();
							$values = $data->getValues();

							if ( count( $params ) > 0 ) {
								foreach ( $params as $param_key => $param_val ) {
									$results[ $key ][ $val . '.' . $param_key ] = $param_val;
								}
							}

							$results[ $key ][ $val ] = $values;
						}
					}
				} // foreach

				$results[ $key ] = (object) $results[ $key ];
			}
		} // foreach

		$this->events = $results;

		if ( count( $this->events ) < 1 ) {
			return false;
		}

		return $this->events;
	}
}
