<?php

namespace WPEventsImporter;

use strobj\StringObjects;

class Formats
{
	protected static $db_names = [
		'queue' => WPEVENTSIMPORTER_DOMAIN . '_queue',
	];

	protected static $option_names = [
		'connections'		=> WPEVENTSIMPORTER_DOMAIN . '_conn',
		'single_settings'	=> WPEVENTSIMPORTER_DOMAIN . '_adj_single',
		'multiple_settings'	=> WPEVENTSIMPORTER_DOMAIN . '_adj',
		'license'			=> WPEVENTSIMPORTER_DOMAIN . '_license',
	];

	protected static $plugin_paths = [
		'ai1ec_event' 				=> 'all-in-one-event-calendar/all-in-one-event-calendar.php',
		'theeventcalendar_event'	=> 'the-events-calendar/the-events-calendar.php',
		'eventon_event'				=> 'eventON/eventon.php',
		'calendarizeit_event'		=> 'calendarize-it/calendarize-it.php',
	];

	// Importer Key => [ Importer Label, Importer Group ]
	public static $import_types = [
		'ai1ec_event' => [
			'All in One Event Calendar',
			'Plugins'
		],
		'theeventcalendar_event' => [
			'The Event Calendar',
			'Plugins'
		],
		'eventon_event' => [
			'EventOn Calendar',
			'Plugins'
		],
		'calendarizeit_event' => [
			'CalendarizeIt Calendar',
			'Plugins'
		],
		'eventchamp_event' => [
			'EventChamp Theme Events',
			'Themes'
		],
		'post' => [
			'Posts',
			'Post Types'
		],
		'page' => [
			'Pages',
			'Post Types'
		],
	];

	public static $import_fields = [
		'name'					=> 'Event Name',
		'event_image'			=> 'Event Image',
		'description'			=> 'Description',

		'start'					=> 'Start Date',
		'end'					=> 'End Date',
		'timezone_name'			=> 'Timezone Name',
		'ticket_fee'			=> 'Ticket Fee',
		'ticket_currency'		=> 'Ticket Currency',
		'ticket_url'			=> 'Ticket URL',
		'venue_name'			=> 'Venue Name',
		'venue_country'			=> 'Venue Country',
		'venue_address'			=> 'Venue Address',
		'venue_city'			=> 'Venue City',
		'venue_phone'			=> 'Venue Phone',
		'venue_email'			=> 'Venue e-Mail',
		'venue_state'			=> 'Venue State',
		'venue_postal_code'		=> 'Venue Postal Code',
		'venue_latitude'		=> 'Venue Latitude',
		'venue_longitude'		=> 'Venue Longitude',
		'venue_url'				=> 'Venue URL',
		'organizer_name'		=> 'Organizer Name',
		'organizer_country'		=> 'Organizer Country',
		'organizer_latitude'	=> 'Organizer Latitude',
		'organizer_longitude'	=> 'Organizer Longitude',
		'organizer_address'		=> 'Organizer Address',
		'organizer_phone'		=> 'Organizer Phone',
		'organizer_email'		=> 'Organizer E-mail',
		'organizer_url'			=> 'Organizer URL',
	];

	// Standardization of import fields - Common event fields
	public static $event_data_fields = [
		'start'				=> null,
		'end'				=> null,
		'timezone_name'		=> null,
		'ticket_url'		=> null,
		'ticket_fee'		=> null,
		'ticket_currency'	=> null,
		'venue_name'		=> null,
		'venue_country'		=> null,
		'venue_address'		=> null,
		'venue_city'		=> null,
		'venue_phone'		=> null,
		'venue_email'		=> null,
		'venue_state'		=> null,
		'venue_postal_code'	=> null,
		'venue_latitude'	=> null,
		'venue_longitude'	=> null,
		'venue_url'			=> null,
		'organizer_name'	=> null,
		'organizer_address'	=> null,
		'organizer_phone'	=> null,
		'organizer_email'	=> null,
		'organizer_url'		=> null,
	];



	/**
	 * This function allows you to retrieve the name of any option.
	 *
	 * @param string $name option name
	 * @return string|bool
	 */
	public static function get_option_name( $name = null )
	{
		if ( empty( $name ) ) {
			return self::$option_names;
		}

		if ( isset( self::$option_names[ $name ] ) ) {
			return self::$option_names[ $name ];
		}

		return false;
	}



	/**
	 * This function allows you to retrieve the name of any table.
	 *
	 * @param string $name table name
	 * @return string|bool
	 */
	public static function get_db_table_name( $name = null )
	{
		global $wpdb;

		if ( empty( $name ) ) {
			$db_names = self::$db_names;

			$db_names = array_map(
				function( $val ) use ( $wpdb ) {
					return $wpdb->prefix . $val;
				},
				$db_names
			);

			return $db_names;
		}

		if ( isset( self::$db_names[ $name ] ) && isset( $wpdb->prefix ) ) {
			return $wpdb->prefix . self::$db_names[ $name ];
		}

		return false;
	}



	/**
	 * Automatically converts the data to the desired format.
	 *
	 * @param string $source
	 * @param object $data
	 * @return bool|array
	 */
	public static function convert_data_array( $source, $data )
	{
		$data_cols = false;

		if ( empty( $source ) ) {
			return false;
		}

		if ( $source == 'facebook' ) {
			$data_cols = self::facebook_format( $data );
		} elseif ( $source == 'eventbrite' ) {
			$data_cols = self::eventbrite_format( $data );
		} elseif ( $source == 'meetup' ) {
			$data_cols = self::meetup_format( $data );
		} elseif ( $source == 'ical' ) {
			$data_cols = self::ical_format( $data );
		} elseif ( $source == 'xml' ) {
			$data_cols = self::xml_format( $data );
		}

		if ( $data_cols === false ) {
			$data_cols = $data;
		}

		return $data_cols;
	}



	/**
	 * Converts data to XML format
	 *
	 * @param object $data
	 * @return array
	 */
	public static function xml_format( $data )
	{
		$obj_data = new StringObjects( $data );

		$cols = [];

		$obj_post_data = $obj_data->get( 'post', [
				'title'		=> null,
				'content'	=> null,
			]
		);

		// POST DATA
		$cols[ 'post_data' ] = [
			'id'			=> sanitize_title( $obj_data->get( 'id', null ) ),
			'name'			=> sanitize_text_field( $obj_post_data[ 'title' ] ),
			'description'	=> sanitize_textarea_field( $obj_post_data[ 'content' ] ),
			'event_image'	=> null,
			'post_status'	=> 'publish',
		];

		$categories = $obj_data->get( 'categories', null );

		if ( ! empty( $categories ) && is_array( $categories ) ) {
			$cols[ 'post_data' ][ 'categories' ] = $categories;
		}

		// META DATA
		$cols[ 'meta_data' ] = (array) $obj_data->get( 'meta', null );

		return $cols;
	}



	/**
	 * Converts data to Ical format
	 *
	 * @param object $data
	 * @return array
	 */
	public static function ical_format( $data )
	{
		$obj_data = new StringObjects( $data );

		$cols = [];
		$cat_index = [];

		// POST DATA
		$cols[ 'post_data' ] = [
			'id'			=> sanitize_title( $obj_data->get( 'id', null ) ),
			'name'			=> sanitize_text_field( $obj_data->get( 'title', 'null' ) ),
			'description'	=> sanitize_textarea_field( $obj_data->get( 'description', 'null' ) ),
			'event_image'	=> null,
			'post_status'	=> 'publish',
		];

		$categories = $obj_data->get( 'categories', null );

		if ( ! empty( $categories ) ) {
			$categories = preg_split( '#\s*,\s*#', $categories );

			foreach ( $categories as $category ) {
				$cat_name	= $category;
				$cat_short	= \sanitize_title( $category );

				$cat_index[] = [
					'name'		=> $cat_name,
					'shortname'	=> $cat_short
				];
			}

			unset( $categories );
		}
		$cols[ 'post_data' ][ 'categories' ] = $cat_index;

		$venue		= sanitize_text_field( $obj_data->get( 'location', null ) );
		$lat_lon	= sanitize_text_field( $obj_data->get( 'lat_lon', null ) );
		$lat_lon	= preg_split( '#\s*;\s*#', $lat_lon );
		$org_name 	= sanitize_text_field( $obj_data->get( 'organizer.cn', null ) );
		$org_name	= strtr( $org_name, [ '"' => '', '\'' => '' ] );
		$org_email	= sanitize_text_field( $obj_data->get( 'organizer', null ) );
		$org_email	= strtr( $org_email, [ 'mailto:' => '' ] );
		$org_uid	= sanitize_text_field( $obj_data->get( 'user_id', null ) );

		// META DATA
		$cols[ 'meta_data' ] = [
			'start'				=> strtotime( $obj_data->get( 'start_time', null ) ),
			'end'				=> strtotime( $obj_data->get( 'end_time', null ) ),
			'timezone_name'		=> $obj_data->get( 'timezone' ),
			'venue_name'		=> $venue,
			'venue_address'		=> $venue,
			'venue_latitude'	=> $lat_lon[ 0 ],
			'venue_longitude'	=> $lat_lon[ 1 ],
			'organizer_name'	=> $org_name,
			'organizer_email'	=> $org_email,
			'organizer_address'	=> $org_uid,
		];

		return $cols;
	}



	/**
	 * Converts data to Facebook format
	 *
	 * @param object $data
	 * @return array mixed
	 */
	public static function facebook_format( $data )
	{
		$obj_data	= new StringObjects( $data );
		$cols		= [];

		// POST DATA
		$cols[ 'post_data' ] = [
			'id'			=> $obj_data->get( 'id', null ),
			'name'			=> sanitize_text_field( $obj_data->get( 'name', 'null' ) ),
			'description'	=> sanitize_textarea_field( $obj_data->get( 'description', 'null' ) ),
		];

		$post_status = 'publish';

		if ( $canceled = $obj_data->get( 'is_canceled' ) ) {
			if ( ! empty( $canceled ) ) {
				$post_status = 'draft';
			}
		}

		// post_status
		$cols[ 'post_data' ][ 'post_status' ] = $post_status;

		// event_image
		$event_image = $obj_data->get( 'cover/source' );

		if ( $event_image ) {
			$cols[ 'post_data' ][ 'event_image' ] = \esc_url_raw( $event_image );
		}

		if ( $category = $obj_data->get( 'category' ) ) {
			$read_name	= strtr( $category, [ '_' => ' ' ] );
			$read_name	= esc_html__( $read_name, WPEVENTSIMPORTER_DOMAIN );
			$categories = [
				'name'		=> $read_name,
				'shortname'	=> sanitize_title( $category ),
			];

			$cols[ 'post_data' ][ 'categories' ] = [ $categories ];
		}

		// META DATA
		$meta_arr = [
			'start'					=> strtotime( $obj_data->get( 'start_time', null ) ),
			'end'					=> strtotime( $obj_data->get( 'end_time', null ) ),
			'timezone_name'			=> $obj_data->get( 'timezone' ),

			'ticket_url'			=> $obj_data->get( 'ticket_uri' ),
			'ticket_fee'			=> '',
			'ticket_currency'		=> '',

			'venue_name'			=> sanitize_text_field( $obj_data->get( 'place/name', null ) ),
			'venue_country'			=> $obj_data->get( 'place/location/country', null ),
			'venue_country_code'	=> self::country_name( $obj_data->get( 'place/location/country', null ), true ),
			'venue_address'			=> sanitize_text_field( $obj_data->get( 'place/location/street', null ) ),
			'venue_city'			=> $obj_data->get( 'place/location/city' ),
			'venue_postal_code'		=> $obj_data->get( 'place/location/zip' ),
			'venue_latitude'		=> $obj_data->get( 'place/location/latitude', 0 ),
			'venue_longitude'		=> $obj_data->get( 'place/location/longitude', 0 ),
			'venue_state' 			=> $obj_data->get( 'place/location/state' ),

			'organizer_name'		=> $obj_data->get( 'organizations/name' ),
			//'organizer_address'	=> sanitize_text_field( $obj_data->get( 'organizations/location' ) ),
			//'organizer_country'	=> '',
			//'organizer_latitude'	=> '',
			//'organizer_longitude'	=> '',
			//'organizer_phone'		=> $obj_data->get( 'organizations/phone' ),
			//'organizer_email'		=> sanitize_email( $obj_data->get( 'organizations/emails' ) ),
			//'organizer_url'		=> sanitize_text_field( $obj_data->get( 'organizations/link' ) ),
		];

		// show_coordinates
		if ( intval( $meta_arr[ 'venue_latitude' ] ) <> 0 && intval( $meta_arr[ 'venue_longitude' ] ) <> 0 ) {
			$meta_arr[ 'show_coordinates' ] = '1';
		}

		$cols[ 'meta_data' ] = $meta_arr;

		return $cols;
	}



	/**
	 * Converts data to Meetup format
	 *
	 * @param object $data
	 * @return array mixed
	 */
	public static function meetup_format( $data )
	{
		$obj_data	= new StringObjects( $data );
		$cols		= [];

		// POST DATA
		$cols[ 'post_data' ] = [
			'id'			=> $obj_data->get( 'id', null ),
			'name'			=> sanitize_text_field( $obj_data->get( 'name', 'null' ) ),
			'description'	=> sanitize_textarea_field( $obj_data->get( 'description', 'null' ) ),
			'post_status'	=> ( $obj_data->get( 'status' ) == 'canceled' ) ? 'draft' : 'publish',
		];

		$post_image_url = $obj_data->get( 'featured_photo/highres_link', false );

		if ( ! $post_image_url ) {
			$post_image_url = $obj_data->get( 'featured_photo/photo_link', '' );
		}

		$cols[ 'post_data' ][ 'event_image' ] = \esc_url_raw( $post_image_url );

		// META DATA
		$meta_arr[ 'timezone_name' ] = 'UTC';

		$meta_arr		= [];
		$utc_offset		= $obj_data->get( 'utc_offset', 0 );
		$utc_offset		= floor( $utc_offset / 3600 );
		$event_duration	= $obj_data->get( 'duration', 0 );
		$event_start	= $obj_data->get( 'time', 0 );

		if ( $event_start ) {
			$event_start = floor( $event_start / 1000 );
			$meta_arr[ 'start' ] = $event_start + $utc_offset;

			if ( $event_duration ) {
				$event_duration = floor( $event_duration / 1000 );
				$meta_arr[ 'end' ] = $event_start + $event_duration + $utc_offset;
			}
		}

		$event_address = $obj_data->get( 'venue/address_1', null );

		if ( $addr = $obj_data->get( 'venue/address_2' ) ) {
			$event_address .= ' ' . $addr;
		}

		if ( $addr = $obj_data->get( 'venue/address_3' ) ) {
			$event_address .= ' ' . $addr;
		}
		unset( $addr );

		$group_location = $obj_data->get( 'group/localized_location' );

		if ( ! empty( $group_location ) ) {
			$group_location_exp	= explode( ',', $group_location );
			$group_city			= trim( $group_location_exp[ 0 ], ' ' );
			$group_country		= trim( $group_location_exp[ 1 ], ' ' );
		}

		// POST CATEGORY
		$cols[ 'post_data' ][ 'categories' ] = [
			[
				'name'		=> esc_html( $obj_data->get( 'group/category/name' ), WPEVENTSIMPORTER_DOMAIN ),
				'shortname'	=> $obj_data->get( 'group/category/shortname' ),
			]
		];

		// META VENUE
		$meta_arr[ 'venue_name' ]			= sanitize_text_field( $obj_data->get( 'venue/name', null ) );
		$meta_arr[ 'venue_country' ]		= $obj_data->get( 'venue/localized_country_name' );
		$meta_arr[ 'venue_address' ]		= sanitize_text_field( $event_address );
		$meta_arr[ 'venue_city' ]			= $obj_data->get( 'venue/city' );
		$meta_arr[ 'venue_state' ]			= $obj_data->get( 'venue/state' );
		$meta_arr[ 'venue_postal_code' ]	= $obj_data->get( 'venue/zip' );
		$meta_arr[ 'venue_latitude' ]		= $obj_data->get( 'venue/lat' );
		$meta_arr[ 'venue_longitude' ]		= $obj_data->get( 'venue/lon' );

		// META TICKET
		$meta_arr[ 'ticket_fee' ]			= $obj_data->get( 'fee/amount' );
		$meta_arr[ 'ticket_currency' ]		= $obj_data->get( 'fee/currency' );
		$meta_arr[ 'ticket_url'	]			= '';

		// META ORGANIZER
		$meta_arr[ 'organizer_name' ]		= sanitize_text_field( $obj_data->get( 'group/name', null ) );
		$meta_arr[ 'organizer_country' ]	= $group_country;
		$meta_arr[ 'organizer_latitude' ]	= $obj_data->get( 'group/lat' );
		$meta_arr[ 'organizer_longitude' ]	= $obj_data->get( 'group/lon' );
		$meta_arr[ 'organizer_address' ]	= $group_location;
		$meta_arr[ 'organizer_phone' ]		= $obj_data->get( 'group/phone' );
		$meta_arr[ 'organizer_email' ]		= sanitize_email( $obj_data->get( 'group/email', null ) );

		// organizer_url
		if ( $org_url = $obj_data->get( 'group/urlname' ) ) {
			$meta_arr[ 'organizer_url' ] = 'https://www.meetup.com/' . $org_url . '/';
		}

		// show_coordinates
		if ( intval( $meta_arr[ 'venue_latitude' ] ) <> 0 && intval( $meta_arr[ 'venue_longitude' ] ) <> 0 ) {
			$meta_arr[ 'show_coordinates' ] = '1';
		}

		$cols[ 'meta_data' ] = $meta_arr;

		return $cols;
	}



	/**
	 * Converts data to Eventbrite format
	 *
	 * @param object $data
	 * @return array mixed
	 */
	public static function eventbrite_format( $data )
	{
		$obj_data	= new StringObjects( $data );
		$cols		= [];
		// POST DATA
		$cols[ 'post_data' ] = [
			'id'			=> $obj_data->get( 'id', null ),
			'name'			=> sanitize_text_field( $obj_data->get( 'name/text', 'null' ) ),
			'description'	=> sanitize_textarea_field( $obj_data->get( 'description/html', 'null' ) ),
			'post_status'	=> ( $obj_data->get( 'status' ) == 'live' ) ? 'publish' : 'draft',
		];

		// event_image
		$event_image = $obj_data->get( 'logo/original/url', null );

		if ( ! empty( $event_image ) ) {
			$cols[ 'post_data' ][ 'event_image' ] = \esc_url_raw( $event_image );
		}

		$venue_country = $obj_data->get( 'venue/address/country', null );

		if ( ! empty( $venue_country ) ) {
			$venue_country = self::country_name( $venue_country );
		}

		// META DATA
		$meta_arr = [
			'start'					=> strtotime( $obj_data->get( 'start/local', null ) ),
			'end'					=> strtotime( $obj_data->get( 'end/local', null ) ),
			'timezone_name'			=> $obj_data->get( 'start/timezone' ),

			'ticket_url'			=> '',
			'ticket_fee'			=> '',
			'ticket_currency'		=> '',

			'venue_name'			=> sanitize_text_field( $obj_data->get( 'venue/name', null ) ),
			'venue_country_code'	=> $obj_data->get( 'venue/address/country' ),
			'venue_country'			=> $venue_country,
			'venue_state'			=> '',
			'venue_city'			=> $obj_data->get( 'venue/address/city' ),
			'venue_latitude'		=> $obj_data->get( 'venue/address/latitude', 0 ),
			'venue_longitude'		=> $obj_data->get( 'venue/address/longitude', 0 ),
			'venue_url'				=> '',

			'organizer_name'		=> sanitize_text_field( $obj_data->get( 'organizer/name', null ) ),
			'organizer_address'		=> '',
			'organizer_phone'		=> sanitize_text_field( $obj_data->get( 'organizer/phone', null ) ),
			'organizer_email'		=> sanitize_email( $obj_data->get( 'organizer/email', null ) ),
			'organizer_url'			=> sanitize_text_field( $obj_data->get( 'organizer/url', null ) ),
		];

		// venue_address
		$event_address	= $obj_data->get( 'venue/address/address_1', null );
		$event_address2	= $obj_data->get( 'venue/address/address_2', null );

		if ( $event_address2 ) {
			$event_address .= ' ' . $event_address2;
		}

		$meta_arr[ 'venue_address' ] = sanitize_text_field( $event_address );
		unset( $addr, $event_address );

		// venue_postal_code
		if ( $postal_code = $obj_data->get( 'venue/address/postal_code' ) ) {
			$meta_arr[ 'venue_postal_code' ] = $postal_code;
		}

		unset( $postal_code );

		// show_coordinates
		if ( intval( $meta_arr[ 'venue_latitude' ] ) <> 0 && intval( $meta_arr[ 'venue_longitude' ] ) <> 0 ) {
			$meta_arr[ 'show_coordinates' ] = '1';
		}

		// POST CATEGORY
		$category = $obj_data->get( 'category/name' );

		$cols[ 'post_data' ][ 'categories' ]	= [
			[
				'name'			=> esc_html__( $category, WPEVENTSIMPORTER_DOMAIN ),
				'shortname'	=> sanitize_title( $category ),
			]
		];

		$cols[ 'meta_data' ] = $meta_arr;

		return $cols;
	}



	public static function country_name( $code, $type = false )
	{
		$file_name = WPEVENTSIMPORTER_PATH . 'src/misc/country-codes.php';

		if ( file_exists( $file_name ) ) {
			$converter = include( $file_name );
			return $converter( $code, $type );
		}

		return $code;
	}



	public static function get_custom_post_types( $extend = false )
	{
		// Get WP Custom Post Types
		$custom_post_types = \get_post_types(
			[
				'public' => true,
				'_builtin' => false
			],
			'names',
			'and'
		);

		$return = $extend ? [ 'post' => 'post', 'page' => 'page' ] : [];

		// Preparing to custom post type list
		foreach ( $custom_post_types as $custom_post_val ) {
			if ( isset( self::$import_types[ $custom_post_val ] ) ) {
				continue;
			}

			$return[ $custom_post_val ] = $custom_post_val;
		}

		return $return;
	}



	/**
	* That function renames meta names with new ones
	*
	* @param array $data An array will review for new meta data names
	* @param array $formats new meta data names [ oldname => newname ]
	* @return array|bool
	*/
	public static function rename_meta_names( $data, $formats )
	{
		$meta = [];

		if ( empty( $formats ) || ! is_array( $formats ) ) {
			return false;
		}

		foreach ( $formats as $old_name => $new_name ) {
			if ( isset( $data[ $old_name ] ) ) {
				$meta[ $new_name ] = $data[ $old_name ];
			}
		}

		return $meta;
	}



	/**
	* Checks if the plugin is activated.
	*
	* @param string $name The name of the plugin.
	* @return bool
	*/
	public static function check_activated_plugin( $name )
	{
		if ( ! function_exists( 'is_plugin_active' ) ) {
			return false;
		}

		$target_plugins = self::$plugin_paths;

		if ( isset( $target_plugins[ $name ] ) ) {
			$plugin_path = $target_plugins[ $name ];

			if ( ! empty( $plugin_path ) && \is_plugin_active( $plugin_path ) ) {
				return true;
			}
		}

		return false;
	}



	/**
	 * @param string $type
	 * @param integer $event_id
	 * @return bool|int
	 */
	public static function post_exists( $type, $event_id, $platform )
	{
		if ( empty( $type ) || empty( $event_id ) ) {
			return false;
		}

		$check_args = [
			'post_type'		=> $type,
			'post_status'	=> 'publish',
			'meta_query'	=> [
				[
					'key'	=> 'wpeventsimporter_event_id',
					'value' => $event_id
				],
				[
					'key'	=> 'wpeventsimporter_event_platform',
					'value' => $platform
				]
			]
		];
		$post_data = \get_posts( $check_args );

		if ( count( $post_data ) > 0 ) {
			return $post_data[ 0 ]->ID;
		}

		return false;
	}



	public static function create_event_id( $id, $platform, $args, $suffix = '' )
	{
		if ( empty( $id ) ) {
			$id = '';

			if ( ! empty( $platform ) ) {
				$id = $platform . '-';
			}

			$id .= md5( $args );
		}

		if ( ! empty( $suffix ) ) {
			$id .= $suffix;
		}

		return $id;
	}
}
