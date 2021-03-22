<?php
/**
 * WPEventsImporter All-in-One Event Calendar Import Module
 * @package wpeventsimporter
 */

namespace WPEventsImporter\Importers;

class AIOEC extends Common
{

	public function main( $post_data, $meta_data )
	{
		$override = false;
		// Add new event
		$event_id = $this->add_custom_post(
			'ai1ec_event',
			[
				'override'		=> $override,
				'id'			=> $post_data[ 'id' ],
				'name'			=> $post_data[ 'name' ],
				'description'	=> $post_data[ 'description' ],
				'image_url'		=> $post_data[ 'event_image' ],
			]
		);

		// Add event category taxonomy term
		if ( ! empty( $post_data[ 'categories' ] ) && is_array( $post_data[ 'categories' ] ) ) {
			foreach ( $post_data[ 'categories' ] as $category ) {
				$category_id = $this->add_taxonomy_term(
					$event_id,
					$category[ 'name' ],
					'events_categories',
					[
						'description'	=> $category[ 'name' ],
						'slug'			=> sanitize_title( $category[ 'shortname' ] ),
						'parent'		=> 0,
					]
				);
			}
		}

		$this->add_to_table(
			'ai1ec_events',// table name
			[
				'contact_name'		=> [ $meta_data[ 'organizer_name' ], '%s' ],
				'contact_email'		=> [ $meta_data[ 'organizer_email' ], '%s' ],
				'contact_phone'		=> [ $meta_data[ 'organizer_phone' ], '%s' ],
				'contact_url'		=> [ $meta_data[ 'organizer_url' ], '%s' ],
				'latitude'			=> [ $meta_data[ 'venue_latitude' ], '%f' ],
				'longitude'			=> [ $meta_data[ 'venue_longitude' ], '%f' ],
				'allday'			=> [ 0, '%d' ],
				'show_map'			=> [ 1, '%d' ],

				'post_id'			=> [ $event_id, '%d' ],
				'instant_event'		=> [ '', '%d' ],
				'province'			=> [ '', '%s' ],
				'cost'				=> [ $meta_data[ 'ticket_fee' ], '%s' ],
				'ical_uid'			=> [ '', '%s' ],
				'show_coordinates'	=> [ 1, '%d' ],
				'start'				=> [ $meta_data[ 'start' ], '%d' ],
				'end'				=> [ $meta_data[ 'end' ], '%d' ],
				'timezone_name'		=> [ $meta_data[ 'timezone_name' ], '%s' ],
				'ticket_url'		=> [ $meta_data[ 'ticket_url' ], '%s' ],
				'venue'				=> [ $meta_data[ 'venue_name' ], '%s' ],
				'country'			=> [ $meta_data[ 'venue_country' ], '%s' ],
				'address'			=> [ $meta_data[ 'venue_address' ], '%s' ],
				'city'				=> [ $meta_data[ 'venue_city' ], '%s' ],
				'postal_code'		=> [ $meta_data[ 'venue_postal_code' ], '%s' ],
			],
			[
				'bind' => [
					'post_type'	=> 'event',
					'col'		=> 'post_id',
				],
				'override' => $override,
			]
		);
	}
}
