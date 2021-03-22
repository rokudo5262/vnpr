<?php
/**
 * WPEventsImporter Page Import Module
 * @package wpeventsimporter
 */

namespace WPEventsImporter\Importers;


class Page extends Common
{
	protected $custom_page_type = null;



	public function __construct( $type = 'page' )
	{
		$this->custom_page_type = $type;
	}



	public function main( $post_data, $meta_data )
	{
		$override = false;
		// Remove empty meta data
		$meta_data = array_filter( $meta_data );

		$event_id = $this->add_custom_post(
			$this->custom_page_type,
			[
				'override'		=> $override,
				'id'			=> $post_data[ 'id' ],
				'name'			=> $post_data[ 'name' ],
				'description'	=> $post_data[ 'description' ],
				'image_url'		=> $post_data[ 'event_image' ],
			],
			$meta_data
		);

		// Add event category taxonomy term
		if ( ! empty( $post_data[ 'categories' ] ) && is_array( $post_data[ 'categories' ] ) ) {
			foreach ( $post_data[ 'categories' ] as $category ) {
				$organizer_term_id = $this->add_taxonomy_term(
					$event_id,
					$category[ 'name' ],
					'category',
					[
						'description'	=> $category[ 'name' ],
						'slug'			=> sanitize_title( $category[ 'shortname' ] ),
						'parent'		=> 0,
					]
				);
			}
		}
	}
}
