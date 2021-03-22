<?php
/*======
*
* Event Repater
*
======*/
if( !function_exists( 'eventchamp_multiple_event_repeat_controller' ) ) {

	function eventchamp_multiple_event_repeat_controller( $post_id ) {

		$args = [ $post_id ];

		$repeat_dates = get_post_meta( esc_attr( $post_id ), 'event_repeat_dates', true );

		if( !empty( $repeat_dates ) ) {

			foreach( $repeat_dates as $repeat_date ) {

				if( !empty( $repeat_date["event_repeat_date"] ) ) {

					if( wp_next_scheduled( 'eventchamp_multiple_repeater_cron_action', $args ) ) {

						wp_clear_scheduled_hook( 'eventchamp_multiple_repeater_cron_action', $args );

					}

					$repeat_start_date = esc_attr( $repeat_date["event_repeat_date"] );

					if( empty( $repeat_start_date ) ) {

						return;

					}

					wp_schedule_single_event(
						strtotime( $repeat_start_date ),
						'eventchamp_multiple_repeater_cron_action',
						$args
					);

				}

			}

		}

	}

}

if( !function_exists( 'eventchamp_scheduled_multiple_event_repeater_appends' ) ) {

	function eventchamp_scheduled_multiple_event_repeater_appends( $post_id ) {

		if( empty( $post_id ) ) {

			return;

		}

		$repeat_dates = get_post_meta( esc_attr( $post_id ), 'event_repeat_dates', true );

		if( !empty( $repeat_dates ) ) {

			foreach( $repeat_dates as $repeat_date ) {

				$start_date = esc_attr( $repeat_date["event_repeat_start_date"] );
				$start_time = esc_attr( $repeat_date["event_repeat_start_time"] );
				$end_date = esc_attr( $repeat_date["event_repeat_end_date"] );
				$end_time = esc_attr( $repeat_date["event_repeat_end_time"] );
				$expire_date = esc_attr( $repeat_date["event_repeat_expire_date"] );

				if( !empty( $start_date ) && !empty( $start_time ) ) {

					update_post_meta( esc_attr( $post_id ), 'event_start_date', esc_attr( $start_date ) );
					update_post_meta( esc_attr( $post_id ), 'event_start_time', esc_attr( $start_time ) );

				}

				if( !empty( $end_date ) && !empty( $end_time ) ) {

					update_post_meta( esc_attr( $post_id ), 'event_end_date', esc_attr( $end_date ) );
					update_post_meta( esc_attr( $post_id ), 'event_end_time', esc_attr( $end_time ) );

				}

				if( !empty( $expire_date ) ) {

					update_post_meta( esc_attr( $post_id ), 'event_expire_date', esc_attr( $expire_date ) );

				}

			}

		}

	}

}

add_action( 'save_post', 'eventchamp_multiple_event_repeat_controller' );
add_action( 'eventchamp_multiple_repeater_cron_action', 'eventchamp_scheduled_multiple_event_repeater_appends', 10, 2 );