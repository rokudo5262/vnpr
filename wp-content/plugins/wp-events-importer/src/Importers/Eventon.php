<?php

/**
 * WPEventsImporter Import Module for The EventOn Wordpress Plugin
 * @package wpeventsimporter
 */

namespace WPEventsImporter\Importers;

class Eventon extends Common
{

	public function main( $post_data, $meta_data )
	{
		$override = false;

		$event_id = $this->add_custom_post(
			'ajde_events',
			[
				'override'		=> $override,
				'id'			=> $post_data[ 'id' ],
				'name'			=> $post_data[ 'name' ],
				'description'	=> $post_data[ 'description' ],
				'image_url'		=> $post_data[ 'event_image' ],
			],
			[
				'date_range_start'		=> $meta_data[ 'start' ],
				'date_range_end'		=> $meta_data[ 'end' ],
				'evcal_srow'			=> $meta_data[ 'start' ],
				'evcal_erow'			=> $meta_data[ 'end' ],
				'event_year'			=> date( "Y", $meta_data[ 'end' ] ),
				'evcal_allday'			=> 'no',
				'_edata'				=> [ 'day_light' => 'no' ],
				'evo_event_timezone'	=> 'PST'
			]
		);

		// Add event category taxonomy term
		if ( ! empty( $post_data[ 'categories' ] ) && is_array( $post_data[ 'categories' ] ) ) {
			foreach ( $post_data[ 'categories' ] as $category ) {
				$category_term_id = $this->add_taxonomy_term(
					$event_id,
					$category[ 'name' ],
					'event_type',
					[
						'description'	=> $category[ 'name' ],
						'slug'			=> $category[ 'shortname' ],
						'parent'		=> 0,
					]
				);
			}
		}

		$tax_org_id = $this->add_taxonomy_term(
			$event_id,
			$meta_data[ 'organizer_name' ],
			'event_organizer',
			[
				'description'	=> '',
				'slug'			=> sanitize_title( $meta_data[ 'organizer_name' ] ),
				'parent'		=> 0,
			]
		);

		$tax_venue_id = $this->add_taxonomy_term(
			$event_id,
			$meta_data[ 'venue_name' ],
			'event_location',
			[
				'description'	=> '',
				'slug'			=> sanitize_title( $meta_data[ 'venue_name' ] ),
				'parent'		=> 0,
			]
		);

		if ( function_exists( 'evo_save_term_metas' ) ) {
			$org_data = [
				"evcal_org_contact"			=> $meta_data[ 'organizer_name' ],
				"evcal_org_address"			=> $meta_data[ 'organizer_address' ],
				"evcal_org_exlink"			=> $meta_data[ 'organizer_url' ],
				"evo_org_img"				=> '',
				"_evocal_org_exlink_target"	=> '',
			];

			$venue_data = [
				"location_lon"			=> $meta_data[ 'venue_longitude' ],
				"location_lat"			=> $meta_data[ 'venue_latitude' ],
				"location_address"		=> $meta_data[ 'venue_address' ],
				"location_city"			=> $meta_data[ 'venue_city' ],
				"location_state"		=> $meta_data[ 'venue_state' ],
				"location_country"		=> $meta_data[ 'venue_country' ],
				"evcal_location_link"	=> $meta_data[ 'venue_url' ],
				"evo_loc_img"			=> '',
			];

			if ( $tax_org_id > 0 ) {
				evo_save_term_metas( 'event_organizer', $tax_org_id, $org_data );
			}

			if ( $tax_venue_id > 0 ) {
				evo_save_term_metas( 'event_location', $tax_venue_id, $venue_data );
			}
		}
	}
}
