<?php
/*======
*
* Columns for the Events
*
======*/
if( !function_exists( 'eventchamp_event_admin_columns' ) ) {

	function eventchamp_event_admin_columns( $columns ) {

		return array_merge(

			$columns,
			array(
				'event_status' => esc_html__( 'Status', 'eventchamp' ),
				'event_venue' => esc_html__( 'Venue', 'eventchamp' ),
				'event_start_date' => esc_html__( 'Start Date', 'eventchamp' ),
				'event_start_time'   => esc_html__( 'Start Time', 'eventchamp' ),
				'event_end_date' => esc_html__( 'End Date', 'eventchamp' ),
				'event_end_time'   => esc_html__( 'End Time', 'eventchamp' ),
				'event_price'   => esc_html__( 'Price', 'eventchamp' ),
			)

		);

	}
	add_filter( 'manage_event_posts_columns', 'eventchamp_event_admin_columns' );

}



/*======
*
* Columns Content for the Events
*
======*/
if( !function_exists( 'eventchamp_event_admin_columns_content' ) ) {

	function eventchamp_event_admin_columns_content( $column, $post_id ) {

		switch( $column ) {

			case 'event_status':

				echo eventchamp_event_status( $post_id = $post_id );

			break;

			case 'event_venue':

				$event_venues = get_post_meta( $post_id, 'event_venue', true );

				if( !empty( $event_venues ) and is_array( $event_venues ) ) {

					echo '<ul>';

						foreach( $event_venues as $event_venue ) {

							if( !empty( $event_venue ) ) {

								echo '<li>';
									echo '<a href="' . esc_url( get_the_permalink( $event_venue ) ) . '">' . get_the_title( $event_venue ) . '</a>';
								echo '</li>';

							}

						}

					echo '</ul>';

				}

			break;

			case 'event_start_date':

				$event_start_date = get_post_meta( $post_id, 'event_start_date', true );

				if( !empty( $event_start_date ) ) {

					echo eventchamp_global_date_converter( $date = esc_attr( $event_start_date ) );

				}

			break;

			case 'event_start_time':

				$event_start_time = get_post_meta( $post_id, 'event_start_time', true );

				if( !empty( $event_start_time ) ) {

					echo eventchamp_global_time_converter( $time = esc_attr( $event_start_time ) );
					
				}

			break;

			case 'event_end_date':

				$event_end_date = get_post_meta( $post_id, 'event_end_date', true );

				if( !empty( $event_end_date ) ) {

					echo eventchamp_global_date_converter( $date = esc_attr( $event_end_date ) );

				}

			break;

			case 'event_end_time':

				$event_end_time = get_post_meta( $post_id, 'event_end_time', true );

				if( !empty( $event_end_time ) ) {

					echo eventchamp_global_time_converter( $time = esc_attr( $event_end_time ) );
					
				}

			break;

			case 'event_price':

				$free_event_price = ot_get_option( 'event-free-events-price', 'free' );
				$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
				$currency = ot_get_option( 'event-price-currency' );

				$price = esc_attr( get_post_meta( $post_id, 'event-ticket-main-price', true ) );

				if( empty( $price ) or $price == "0" ) {

					if( $free_event_price == "free" ) {

						echo esc_html__( 'Free', 'eventchamp' );

					} elseif( $free_event_price == "0" ) {

						echo '0';

					} elseif( $free_event_price == "0-currency" ) {

						if( $currency_position == "left" ) {

							echo esc_attr( $currency );

						}

						if( $currency_position == "left-space" ) {

							echo esc_attr( $currency ) . ' ';

						}

						echo esc_attr( $price );

						if( $currency_position == "right" ) {

							echo esc_attr( $currency );

						}

						if( $currency_position == "right-space" ) {

							echo ' ' . esc_attr( $currency );

						}

					}

				} elseif( !empty( $price ) ) {

					if( $currency_position == "left" ) {

						echo esc_attr( $currency );

					}

					if( $currency_position == "left-space" ) {

						echo esc_attr( $currency ) . ' ';

					}

					echo esc_attr( $price );

					if( $currency_position == "right" ) {

						echo esc_attr( $currency );

					}

					if( $currency_position == "right-space" ) {

						echo ' ' . esc_attr( $currency );

					}

				}

			break;

		}

	}
	add_action( 'manage_event_posts_custom_column', 'eventchamp_event_admin_columns_content', 10, 2 );

}



/*======
*
* Columns for the Speakers
*
======*/
if( !function_exists( 'eventchamp_speaker_admin_columns' ) ) {

	function eventchamp_speaker_admin_columns( $columns ) {

		return array_merge(

			$columns,
			array(
				'speaker_profession' => esc_html__( 'Profession', 'eventchamp' ),
				'speaker_company' => esc_html__( 'Company', 'eventchamp' ),
			)

		);

	}
	add_filter( 'manage_speaker_posts_columns', 'eventchamp_speaker_admin_columns' );

}



/*======
*
* Columns Content for the Speakers
*
======*/
if( !function_exists( 'eventchamp_speaker_admin_columns_content' ) ) {

	function eventchamp_speaker_admin_columns_content( $column, $post_id ) {

		switch( $column ) {

			case 'speaker_profession':

				$speaker_profession = get_post_meta( $post_id, 'speaker_profession', true );

				if( !empty( $speaker_profession ) ) {

					echo esc_attr( get_post_meta( $post_id, 'speaker_profession', true ) );

				}

			break;

			case 'speaker_company':

				$speaker_company = get_post_meta( $post_id, 'speaker_company', true );

				if( !empty( $speaker_company ) ) {

					echo esc_attr( get_post_meta( $post_id, 'speaker_company', true ) );

				}

			break;

		}

	}
	add_action( 'manage_speaker_posts_custom_column', 'eventchamp_speaker_admin_columns_content', 10, 2 );

}