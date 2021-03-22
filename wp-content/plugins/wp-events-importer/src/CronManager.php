<?php

namespace WPEventsImporter;

use WPEventsImporter\Formats;
use WPEventsImporter\ExportManager;
use WPEventsImporter\EventsManager;
use WPEventsImporter\AjaxProgress;
use WPEventsImporter\Admin;

class CronManager
{
	protected $events;

	protected $export;

	protected $settings_list;

	protected $db_queue_table;

	protected static $scheduleTimes = [];



	public static function get_time_periods()
	{
		$hour	= HOUR_IN_SECONDS;
		$day	= DAY_IN_SECONDS;

		$time_periods = [
			'wpei_every_five_seconds' => [
				'interval'  => 5,
				'display'   => __( 'Every Five Seconds', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_every_five_minutes' => [
				'interval'  => 60 * 5,
				'display'   => __( 'Every Five Minutes', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_every_fifteen_minutes' => [
				'interval'  => 60 * 15,
				'display'   => __( 'Every Fifteen Minutes', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_every_thirty_minutes' => [
				'interval'  => 60 * 30,
				'display'   => __( 'Every Thirty Minutes', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_hourly' => [
				'interval'  => $hour,
				'display'   => __( 'Every Hour', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_every_three_hours' => [
				'interval'  => $hour * 3,
				'display'   => __( 'Every Three Hours', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_every_six_hours' => [
				'interval'  => $hour * 6,
				'display'   => __( 'Every Six Hours', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_every_nine_hours' => [
				'interval'  => $hour * 9,
				'display'   => __( 'Every Nine Hours', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_every_twelve_hours' => [
				'interval'  => $hour * 12,
				'display'   => __( 'Twice in a day', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_daily' => [
				'interval'  => $day,
				'display'   => __( 'Every Day', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_every_two_days' => [
				'interval'  => $day * 2,
				'display'   => __( 'Every 2 Days', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_every_three_days' => [
				'interval'  => $day * 3,
				'display'   => __( 'Every 3 Days', WPEVENTSIMPORTER_DOMAIN )
			],
			'wpei_weekly' => [
				'interval'  => WEEK_IN_SECONDS,
				'display'   => __( 'Every Week', WPEVENTSIMPORTER_DOMAIN )
			],
		];

		return $time_periods;
	}



	/**
	 * This function removes the any scheduled cron
	 *
	 * @param string $name
	 * @param array $settings
	 */
	public static function delete_cron( $name )
	{
		$pre	= WPEVENTSIMPORTER_DOMAIN . '_scheduler_';
		$name	= $pre . $name . '_hook';

		wp_unschedule_hook( $name );
	}



	public static function getScheduleTime( $id )
	{
		if ( isset( self::$scheduleTimes[ $id ] ) ) {
			$next = self::$scheduleTimes[ $id ];
			$next = $next + get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;
			$next_date = date( "Y-m-d G:i:s", $next );

			return $next_date;
		}

		return false;
	}



	/**
	 * This function starts all schedule process as first trigger
	 */
	public static function import_events_trigger()
	{
		$offset_time 		= time();// + get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;
		$hook_name_pre		= WPEVENTSIMPORTER_DOMAIN . '_scheduler_';
		$queue_hook_name 	= $hook_name_pre . 'queue_hook';
		$multi_settings		= Admin::get_multi_settings();

		if ( $multi_settings !== false ) {
			// Multi event importer settings
			foreach ( $multi_settings as $setting_id => $setting_values ) {
				$import_hook_name	= $hook_name_pre . $setting_id . '_hook';
				$import_period		= isset( $setting_values[ 'import_period' ] ) ? $setting_values[ 'import_period' ] : null;
				$event_args			= [
					$setting_id,
					$setting_values,
				];

				$next_scheduler = wp_next_scheduled( $import_hook_name, $event_args );

				if ( $next_scheduler ) {
					self::$scheduleTimes[ $setting_id ] = $next_scheduler;

					if ( empty( $import_period ) ) {
						wp_unschedule_hook( $import_hook_name );
					}
				} else {
					wp_schedule_event(
						$offset_time,
						$import_period,
						$import_hook_name,
						$event_args
					);
				}

				add_action( $import_hook_name, 'WPEventsImporter\CronManager::enqueue_settings', 30, 2 );
			}
		}

		// Run enqueued events with a scheduler every five seconds
		if ( self::get_scheduled_queue() !== false ) {

			if ( ! wp_next_scheduled( $queue_hook_name ) ) {
				wp_schedule_event(
					$offset_time,
					'wpei_every_five_seconds',
					$queue_hook_name
				);
			}

			add_action( $queue_hook_name, 'WPEventsImporter\CronManager::run_queue', 30, 0 );
		} else {
			wp_unschedule_hook( $queue_hook_name );
		}
	}



	/**
	 * That function adds new event data to scheduler queue multiple times
	 *
	 * @param string $id
	 * @param array $settings
	 *
	 * @return bool
	 */
	public static function enqueue_settings( $id, $settings )
	{
		$events	= EventsManager::get( $settings );

		if ( empty( $events ) || ! is_array( $events ) ) {
			return false;
		}

		foreach ( $events as $event ) {
			self::enqueue_event( $id, $event, $settings );
		}

		AjaxProgress::setTotalCount( $id );

		return true;
	}



	/**
	 * That function checks whether event id exists or not
	 *
	 * @param string $event_id
	 *
	 * @return bool
	 */
	protected static function check_id( $event_id )
	{
		global $wpdb;

		// Search in import queue
		$table_name	= Formats::get_db_table_name( 'queue' );
		$query		= "SELECT COUNT(*) FROM {$table_name} WHERE event_id = %s";
		$prepare	= $wpdb->prepare( $query, $event_id );

		if ( $count = $wpdb->get_var( $prepare ) ) {
			if ( $count > 0 ) {
				return true;
			}
		}

//Formats::post_exists( $this->source );

		// Search in postmeta
		$meta_name	= 'wpeventsimporter_event_id';
		$table_name	= $wpdb->postmeta;
		$query		= "SELECT COUNT(*) FROM {$table_name} WHERE meta_key = %s and meta_value = %s";
		$prepare	= $wpdb->prepare( $query, $meta_name, $event_id );

		if ( $count = $wpdb->get_var( $prepare ) ) {
			if ( $count > 0 ) {
				return true;
			}
		}

		return false;
	}



	/**
	 * That function adds new event data to scheduler queue
	 *
	 * @param string $id
	 * @param array $event
	 * @param array $settings
	 * @return bool
	 */
	public static function enqueue_event( $id, $event, array $settings )
	{
		global $wpdb;

		$platform		= $settings[ 'platform' ];
		$import_type	= $settings[ 'import_post_type' ];
		$name			= WPEVENTSIMPORTER_DOMAIN . '_scheduled_queue_' . $id;
		$queue_table	= Formats::get_db_table_name( 'queue' );
		$is_xml			= false;
		$start_time		= null;
		$end_time		= null;

		if ( ! empty( $settings[ 'event_xml_source_index' ] ) ) {
			$is_xml = true;
			$xml_source_index	= unserialize( stripslashes( $settings[ 'event_xml_source_index' ] ) );

			unset( $settings[ 'event_xml_source_index' ] );

			foreach ( $xml_source_index as $src_key => $src_val ) {
				$xml_src_val = $settings[ 'event_xml_source_name_' . $src_key ];
				unset( $settings[ 'event_xml_source_name_' . $src_key ] );

				if ( empty( $xml_src_val ) ) {
					unset( $event[ 'meta_data' ][ $src_val ] );
				} elseif ( isset( $event[ 'meta_data' ][ $src_val ] ) ) {
					$event[ 'meta_data' ][ $xml_src_val ] = $event[ 'meta_data' ][ $src_val ];
					unset( $event[ 'meta_data' ][ $src_val ] );
				}
			}
		}

		if ( isset( $settings[ 'event_selected_sources' ] ) && is_array( $settings[ 'event_selected_sources' ] ) ) {
			$selected_src = $settings[ 'event_selected_sources' ];

			foreach ( $event[ 'meta_data' ] as $src_key => $src_val ) {
				if ( ! isset( $selected_src[ $src_key ] ) ) {
					unset( $event[ 'meta_data' ][ $src_key ] );
				}
			}
		} elseif ( ! $is_xml ) {
			$event[ 'meta_data' ] = [];
		}

		$custom_post_types	= Formats::get_custom_post_types( true );
		$is_custom_post		= in_array( $import_type, $custom_post_types );
		$rename_meta_data	= ( $is_custom_post && ! empty( $settings[ 'custom_meta_names' ] ) );

		if ( isset( $settings[ 'date_format' ] ) && isset( $settings[ 'time_format' ] ) && $is_custom_post ) {

			if ( isset( $event[ 'meta_data' ][ 'start' ] ) ) {
				$start_time = $event[ 'meta_data' ][ 'start' ];
			}

			if ( isset( $event[ 'meta_data' ][ 'end' ] ) ) {
				$end_time = $event[ 'meta_data' ][ 'end' ];
			}

			$date_format	= $settings[ 'date_format' ];
			$time_format	= $settings[ 'time_format' ];
			$full_format	= $date_format . ' ' . $time_format;

			if ( $start_time < 100000 ) {
				$start_time = strtotime( $start_time );
			}

			if ( $start_time > 0 ) {
				$start_date = date( $full_format, $start_time );
				$event[ 'meta_data' ][ 'start' ] = $start_date;
			}

			if ( $end_time < 100000 ) {
				$end_time = strtotime( $end_time );
			}

			if ( $end_time > 0 ) {
				$end_date = date( $full_format, $end_time );
				$event[ 'meta_data' ][ 'end' ] = $end_date;
			}
		}

		if ( $rename_meta_data ) {
			$event[ 'meta_data' ] = Formats::rename_meta_names( $event[ 'meta_data' ], $settings[ 'custom_meta_names' ] );
		}

		$event_data	= json_encode( $event );
		$event_id	= Formats::create_event_id(
			$event[ 'post_data' ][ 'id' ],
			$platform,
			$event_data
		);

		if ( self::check_id( $event_id ) ) {
			return false;
		}

		$wpdb->insert(
			$queue_table,
			array(
				'event_id'		=> $event_id,
				'name'			=> $name,
				'time'			=> current_time( 'mysql' ),
				'import_type'	=> $import_type,
				'origin'		=> $platform,
				'settings'		=> serialize( $settings ),
				'event_data'	=> $event_data,
			)
		);

		return true;
	}



	public static function dequeue_event( $id )
	{
		global $wpdb;

		$queue_table = Formats::get_db_table_name( 'queue' );

		if ( empty( $queue_table ) || empty( $id ) ) return false;

		return $wpdb->delete( $queue_table, array( 'id' => $id ) );
	}



	public static function get_scheduled_queue()
	{
		global $wpdb;

		$queue_table	= Formats::get_db_table_name( 'queue' );
		$table_data		= $wpdb->get_row( "SELECT * FROM {$queue_table}", ARRAY_A, 0 );

		if ( $table_data ) {
			$table_data[ 'event_data' ] = json_decode( $table_data[ 'event_data' ], true );

			return $table_data;
		}

		return false;
	}



	/**
	 * Run the next event import process
	 *
	 * @return bool
	 */
	public static function run_queue()
	{
		// Get event data from queue
		$queue_data	= self::get_scheduled_queue();
		extract( $queue_data );

		// Delete event data from queue
		self::dequeue_event( $id );

		unset( $queue_data );

		if ( empty( $import_type ) || empty( $origin ) || empty( $event_data ) ) {
			return false;
		}

		// ***Export Events Data*** If event data doesn`t exported return false
		if ( ! ExportManager::export( $import_type, $origin, $event_data ) ) {
			return false;
		}

		return true;
	}



	public static function importer_set_crons()
	{
		$periods = [ '' => 'Inactive' ];
		$time_periods = self::get_time_periods();

		foreach ( $time_periods as $key => $value ) {
			$periods[ $key ] = $value[ 'display' ];
		}

		return $periods;
	}



	public static function importer_cron_intervals( $schedules )
	{
		$schedules += self::get_time_periods();

		return $schedules;
	}
}
