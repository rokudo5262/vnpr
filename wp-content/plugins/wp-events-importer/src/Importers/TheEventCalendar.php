<?php

/**
 * WPEventsImporter Import Module for The Event Calendar PRO Wordpress Plugin
 * @package wpeventsimporter
 */

namespace WPEventsImporter\Importers;

class TheEventCalendar extends Common
{

	public function main( $post_data, $meta_data )
	{
		$override	= false;
		$start_date	= date( "Y-m-d", $meta_data[ 'start' ] );
		$start_time	= date( "H:i:s", $meta_data[ 'start' ] );
		$end_date	= date( "Y-m-d", $meta_data[ 'end' ] );
		$end_time	= date( "H:i:s", $meta_data[ 'end' ] );

		// Add new venue to custom post type named tribe_venue
		$venue_post_id = $this->add_custom_post(
			'tribe_venue',
			[
				'override'	=> $override,
				'id'		=> sanitize_title( $meta_data[ 'venue_name' ] ) . '-venue',
				'name'		=> $meta_data[ 'venue_name' ],
			],
			[
				'_VenueAddress'			=> $meta_data[ 'venue_address' ],
				'_VenueCity'			=> $meta_data[ 'venue_city' ],
				'_VenueCountry'			=> $meta_data[ 'venue_country' ],
				'_VenueZip'				=> $meta_data[ 'venue_postal_code' ],
				'_VenueStateProvince'	=> '',
				'_VenueProvince'		=> '',
				'_VenueState'			=> $meta_data[ 'venue_state' ],
				'_VenuePhone'			=> $meta_data[ 'venue_phone' ],
				'_VenueURL'				=> $meta_data[ 'venue_url' ],
				'_EventShowMapLink'		=> '1',
				'_EventShowMap'			=> '1',
				'_VenueShowMapLink'		=> '1',
				'_VenueShowMap'			=> '1',
				'_VenueEventShowMap'	=> '1',
				'_VenueOrigin'			=> 'wpeventsimporter',
				'_VenueEventShowMapLink' => '1',
			]
		);

		// Add new organizer to custom post type named tribe_organizer
		$organizer_post_id = $this->add_custom_post(
			'tribe_organizer',
			[
				'override'	=> $override,
				'id'		=> sanitize_title( $meta_data[ 'organizer_name' ] ) . '-organizer',
				'name'		=> $meta_data[ 'organizer_name' ],
			],
			[
				'_OrganizerEmail'		=> $meta_data[ 'organizer_email' ],
				'_OrganizerWebsite'		=> $meta_data[ 'organizer_url' ],
				'_OrganizerPhone'		=> $meta_data[ 'organizer_phone' ],
				'_OrganizerOrganizerID' => '0',
			]
		);

		// Add new event
		$event_id = $this->add_custom_post(
			'tribe_events',
			[
				'override'		=> $override,
				'id'			=> $post_data[ 'id' ],
				'name'			=> $post_data[ 'name' ],
				'description'	=> $post_data[ 'description' ],
				'image_url'		=> $post_data[ 'event_image' ],
			],
			[
				/*
				 * start, end, timezone_name, ticket_url,
				 * venue, country, address, city, postal_code,
				 * latitude, longitude, contact_name,
				 * contact_phone, contact_email, contact_url
				 */
				'_EventStartDate'			=> $start_date,
 				'_EventEndDate'				=> $end_date,
 				'_EventStartTime'			=> $start_time,
 				'_EventEndTime'				=> $end_time,
 				'_EventCost'				=> $meta_data[ 'venue_address' ],
 				'_EventURL'					=> $meta_data[ 'venue_address' ],
				'_EventStartDateUTC'		=> '',
				'_EventEndDateUTC'			=> '',
				'_EventDuration'			=> ( intval( $meta_data[ 'end' ] ) - intval( $meta_data[ 'start' ] ) ),
				'_EventCurrencySymbol'		=> $meta_data[ 'ticket_currency' ],// add to settings
				'_EventCurrencyPosition'	=> '',// add to settings
				'_EventShowMapLink'			=> '',// add to settings
				'_EventShowMap'				=> '',// add to settings
				'_EventCost'				=> $meta_data[ 'ticket_fee' ],
				'_EventURL'					=> $meta_data[ 'ticket_url' ],
				'_EventTimezone'			=> $meta_data[ 'timezone_name' ],
				'_EventTimezoneAbbr'		=> $meta_data[ 'timezone_name' ],

				'_EventVenueID'				=> $venue_post_id,
				'_EventOrganizerID'			=> $organizer_post_id,
				'_EventOrigin'				=> 'wpeventsimporter',
			]
		);

		// Add event category taxonomy term
		if ( ! empty( $post_data[ 'categories' ] ) && is_array( $post_data[ 'categories' ] ) ) {
			foreach ( $post_data[ 'categories' ] as $category ) {
				$cat_name = $category[ 'name' ];
				$cat_slug = $category[ 'shortname' ];

				if ( empty( $cat_name ) ) {
					continue;
				}

				$category_term_id = $this->add_taxonomy_term(
					$event_id,
					$cat_name,
					'tribe_events_cat',
					[
						'description'	=> $cat_name,
						'slug'			=> $cat_slug,
						'parent'		=> 0,
					]
				);
			}
		}
	}
}
