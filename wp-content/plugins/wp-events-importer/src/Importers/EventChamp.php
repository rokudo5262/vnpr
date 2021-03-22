<?php

/**
 * WPEventsImporter Import Module for Event Calendar of EventChamp Wordpress Theme
 * @package wpeventsimporter
 */

namespace WPEventsImporter\Importers;

class EventChamp extends Common
{
	const event_meta_names  = [
		'event_start_date'						=> '',
		'event_start_time'						=> '',
		'event_end_date'						=> '',
		'event_end_time'						=> '',
		'event_expire_date'						=> '',
		'event-content-listing-type'			=> '',
		'event_faq'								=> '',
		'extra-event-details-position'			=> '',
		'event-schedule-style'					=> '',
		'event-grouped-schedule'				=> '',
		'event-remaining-tickets'				=> '',
		'event-ticket-style'					=> '',
		'event-ticket-column'					=> '',
		'event-ticket-column-space'				=> '',
		'event-header-status'					=> '',
		'event-header-style'					=> '',
		'event-photos-status'					=> '',
		'event-photo-column'					=> '',
		'event-photo-column-space'				=> '',
		'event-sponsors-status'					=> '',
		'event-sponsors-style'					=> '',
		'event-sponsors-column'					=> '',
		'event-sponsors-column-space'			=> '',
		'labels_status'							=> '',
		'social-links'							=> '',
		'event_speakers'						=> '',
		'event_extra_tabs'						=> '',
		'event_detailed_address'				=> '',
		'event_phone'							=> '',
		'event_email'							=> '',
		'event-fax'								=> '',
		'event_google_street_link'				=> '',
		'event-ticket-main-price'				=> '',
		'event_media_tab_images'				=> '',
		'event_schedule'						=> '',
		'event-map-lng'							=> '',
		'event-map-lat'							=> '',
		'event-map-style'						=> '',
		'event_venue'							=> '',
		'event_sponsors'						=> '',
		'event_tickets'							=> '',
		'event-remaining-ticket-woocommerce'	=> '',
		'event-ticket-main-price-currency'		=> '',
		'_thumbnail_id'							=> '',
		'_dp_original'							=> '',
		'_edit_last'							=> '',
		'_wp_old_date'							=> '',
		'_wp_old_slug'							=> '',
		'_wp_old_slug'							=> '',
	];



	public function main( $post_data, $meta_data )
	{
		$override = false;

		// Add new event
		$event_id = $this->add_custom_post(
			'event',
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

				'event_start_date'				=> date( "Y-m-d", $meta_data[ 'start' ] ),
				'event_start_time'				=> date( "G:i", $meta_data[ 'start' ] ),
				'event_end_date'				=> date( "Y-m-d", $meta_data[ 'end' ] ),
				'event_end_time'				=> date( "G:i", $meta_data[ 'end' ] ),
				'event_expire_date'				=> date( "Y-m-d G:i", $meta_data[ 'end' ] ),
				'event-content-listing-type'	=> "default",
				'event_faq'						=> '',
				'event-schedule-style'			=> "default",
				'event-grouped-schedule'		=> '',
				'event-remaining-tickets'		=> '',
				'event-ticket-style'			=> "default",
				'event-ticket-column'			=> '',
				'event-ticket-column-space'		=> '',
				'event-header-status'			=> '',
				'event-header-style'			=> '',
				'event-photos-status'			=> '',
				'event-photo-column'			=> '',
				'event-photo-column-space'		=> '',
				'event-sponsors-status'			=> '',
				'event-sponsors-style'			=> '',
				'event-sponsors-column'			=> '',
				'event-sponsors-column-space'	=> '',
				'labels_status'					=> '',
				'social-links'					=> '',
				'event_speakers'				=> '',
				'event_extra_tabs'				=> '',
				'event_detailed_address'		=> $meta_data[ 'venue_address' ],
				'event_phone'					=> $meta_data[ 'organizer_phone' ],
				'event_email'					=> $meta_data[ 'organizer_email' ],
				'event-fax'						=> '',
				'event_google_street_link'		=> '',
				'event-ticket-main-price'		=> '',
				'event_media_tab_images'		=> '',
				'event_schedule'				=> [],
				'event-map-lng'					=> $meta_data[ 'venue_longitude' ],
				'event-map-lat'					=> $meta_data[ 'venue_latitude' ],
				'event-map-style'				=> "default",
				'event_venue'					=> $meta_data[ 'venue_name' ],
				'event_sponsors'				=> [],
				'event_tickets'					=> [],
				'extra-event-details-position'	=> '',
				'event-remaining-ticket-woocommerce' => '',
				'event-ticket-main-price-currency' => '',
			]
		);

		// Add new venue to custom post type named venue
		$venue_id = $this->add_custom_post(
			'venue',
			[
				'override'	=> $override,
				'id'		=> $post_data[ 'id' ] . '-venue',
				'name'		=> $meta_data[ 'venue_name' ],
			],
			[
				'venue_detailed_address'	=> $meta_data[ 'venue_address' ],
				'venue_phone'				=> $meta_data[ 'venue_phone' ],
				'venue_fax'					=> '',
				'venue_email'				=> $meta_data[ 'venue_email' ],
				'venue-website'				=> $meta_data[ 'venue_url' ],
				'venue_image_gallery'		=> '',
			]
		);

		// Add event organizer taxonomy term
		if ( ! empty( $meta_data[ 'organizer_name' ] ) ) {
			$organizer_term_id = $this->add_taxonomy_term(
				$event_id,
				$meta_data[ 'organizer_name' ],
				'organizer',
				[
					'description'	=> '',
					'slug'			=> sanitize_title( $meta_data[ 'organizer_name' ] ),
					'parent'		=> 0,
				]
			);
		}

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
					'eventcat',
					[
						'description'	=> $cat_name,
						'slug'			=> $cat_slug,
						'parent'		=> 0,
					]
				);
			}
		}

		// Add location taxonomy terms
		if ( ! empty( $meta_data[ 'venue_country' ] ) ) {
			$country_term_id = $this->add_taxonomy_term(
				$event_id,
				$meta_data[ 'venue_country' ],
				'location',
				[
					'description'	=> '',
					'slug'			=> sanitize_title( $meta_data[ 'venue_country' ] ),
					'parent'		=> 0,
				]
			);

			if ( $country_term_id > 0 && ! empty( $meta_data[ 'venue_city' ] ) ) {
				$this->add_taxonomy_term(
					$event_id,
					$meta_data[ 'venue_city' ],
					'location',
					[
						'description'	=> '',
						'slug'			=> sanitize_title( $meta_data[ 'venue_city' ] ),
						'parent'		=> $country_term_id,
					]
				);
			}
		}
	}
}
