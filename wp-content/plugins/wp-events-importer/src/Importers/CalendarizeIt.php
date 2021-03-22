<?php

/**
 * WPEventsImporter Import Module for Calendarize It! Wordpress Plugin
 * @package wpeventsimporter
 */

namespace WPEventsImporter\Importers;

class CalendarizeIt extends Common
{

	public function main( $post_data, $meta_data )
	{
		$override = false;

		$event_id = $this->add_custom_post(
			'events',
			[
				'override'		=> $override,
				'id'			=> $post_data[ 'id' ],
				'name'			=> $post_data[ 'name' ],
				'description'	=> $post_data[ 'description' ],
				'image_url'		=> $post_data[ 'event_image' ],
			],
			[
				'fc_rrule'				=> '',
				'fc_allday'				=> '1',
				'fc_start'				=> date( "Y-m-d", $meta_data[ 'start' ] ),
				'fc_end'				=> date( "Y-m-d", $meta_data[ 'end' ] ),
				'fc_start_datetime'		=> date( "Y-m-d G:i:s", $meta_data[ 'start' ] ),
				'fc_end_datetime'		=> date( "Y-m-d G:i:s", $meta_data[ 'end' ] ),
				'fc_range_start'		=> date( "Y-m-d G:i:s", $meta_data[ 'start' ] ),
				'fc_range_end'			=> date( "Y-m-d G:i:s", $meta_data[ 'end' ] ),

				'fc_interval'			=> '',
				'fc_end_interval'		=> '',
				'fc_dow_except'			=> '',

				'fc_exdate'				=> '',
				'fc_rdate'				=> '',
				'fc_event_map'			=> '',

				'fc_post_info'			=> '',
				'rhc_top_image'			=> '',
				'rhc_dbox_image'		=> '',
				'rhc_tooltip_image'		=> '',
				'rhc_month_image'		=> '',

				'enable_featuredimage'	=> '1',
				'enable_postinfo'		=> '1',
				'enable_postinfo_image'	=> '1',
				'enable_venuebox'		=> '1',
				'enable_venuebox_gmap'	=> '1',
				'fc_color'				=> '#',
				'fc_text_color'			=> '#',
				'fc_click_link'			=> 'view',
				'fc_click_target'		=> '_blank',
			]
		);

		$venue_id = $this->add_taxonomy_term(
			$event_id,
			$meta_data[ 'venue_name' ],
			'venue',
			[
				'description'	=> '',
				'slug'			=> sanitize_title( $meta_data[ 'venue_name' ] ),
				'parent'		=> 0,
			],
			[
				'content'			=> $meta_data[ 'venue_name' ],
				'address'			=> $meta_data[ 'venue_address' ],
				'city'				=> $meta_data[ 'venue_city' ],
				'state'				=> $meta_data[ 'venue_state' ],
				'zip'				=> $meta_data[ 'venue_postal_code' ],
				'country'			=> $meta_data[ 'venue_country' ],
				'gaddress'			=> '',
				'glat'				=> $meta_data[ 'venue_latitude' ],
				'glon'				=> $meta_data[ 'venue_longitude' ],
				'gzoom'				=> '5',
				'ginfo'				=> '',
				'phone'				=> $meta_data[ 'venue_phone' ],
				'email'				=> $meta_data[ 'venue_email' ],
				'website'			=> $meta_data[ 'venue_url' ],
				'websitelabel'		=> '',
				'website_nofollow'	=> '',
				'image'				=> '',
				'iso3166_country_code' => $meta_data[ 'venue_country_code' ],
			]
		);

		$org_id = $this->add_taxonomy_term(
			$event_id,
			$meta_data[ 'organizer_name' ],
			'organizer',
			[
				'description'	=> '',
				'slug'			=> sanitize_title( $meta_data[ 'organizer_name' ] ),
				'parent'		=> 0,
			],
			[
				'content'			=> $meta_data[ 'organizer_name' ],
				'phone'				=> $meta_data[ 'organizer_phone' ],
				'email'				=> $meta_data[ 'organizer_email' ],
				'website'			=> $meta_data[ 'organizer_url' ],
				'websitelabel'		=> '',
				'website_nofollow'	=> '',
				'image'				=> '',
			]
		);
	}
}
