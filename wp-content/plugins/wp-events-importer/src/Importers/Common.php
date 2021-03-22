<?php

/**
 * WPEventsImporter Common Importer module
 *
 * @package wpeventsimporter
 */

namespace WPEventsImporter\Importers;

use WPEventsImporter\Formats;

abstract class Common
{
	protected $event_post_type;

	protected $venue_post_type;

	protected $speaker_post_type;

	protected $event_db_table;

	protected $venue_db_table;

	protected $speaker_db_table;

	protected $source;

	protected $meta_values;



	/**
	 * @param string $source
	 */
	public function set_source( $source )
	{
		if ( ! empty( $source ) ) {
			$this->source = $source;
		}
	}



	/**
	 * @param integer $post_id
	 * @param string $title
	 * @param string $image_url
	 * @param string $img_name
	 *
	 * @return bool|string
	 */
	protected function add_event_image( $post_id, $title, $image_url, $img_name )
	{
		$image			= \wp_get_image_editor( $image_url );
		$uploads_dir	= 'event-images/';

		if ( ! \is_wp_error( $image ) ) {
			$image_dir	= \wp_upload_dir();
			$file_save	= $image->save( $image_dir[ 'basedir' ] . '/' . $uploads_dir . $img_name );

			if ( $file_save ) {
				$filename   = $file_save[ 'path' ];
				$attachment = array(
					'guid'				=> $filename,
					'post_mime_type'	=> $file_save[ 'mime-type' ],
					'post_title'		=> $title,
					'post_content'		=> '',
					'post_status'		=> 'inherit',
				);

				// Insert the attachment.
				$attach_id = \wp_insert_attachment( $attachment, $filename, $post_id );

				// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
				require_once( ABSPATH . 'wp-admin/includes/image.php' );

				// Generate the metadata for the attachment, and update the database record.
				$full_size_path = \get_attached_file( $attach_id );

				$attach_data = \wp_generate_attachment_metadata( $attach_id, $full_size_path );
				\wp_update_attachment_metadata( $attach_id, $attach_data );
				\set_post_thumbnail( $post_id, $attach_id );

				return $filename;
			}
		}
		return false;
	}



	/**
	 * This function fires in Classes of WPEventsImporter\Importers
	 *
	 * @param string $table_name
	 * @param array $table_args [ col_name => [ value, value_type ] ] or [ col_name => value ] for string values
	 * @param array $args
	 * @return bool
	 */
	function add_to_table( $table_name, $table_args, $args = [] )
	{
		global $wpdb;

		$post_id		= 0;
		$override		= false;
		$table_values	= [];
		$table_types	= [];
		$post_exists	= null;

		if ( empty( $table_name ) ) {
			return false;
		}

		if ( isset( $args[ 'bind' ] ) && isset( $args[ 'post_type' ] ) && ! empty( $args[ 'post_type' ] ) ) {
			$bind_name = $args[ 'bind' ];

			if ( isset( $args[ $bind_name ] ) && is_integer( $args[ $bind_name ] ) ) {
				$post_id = $args[ $bind_name ];
			}

			if ( isset( $args[ 'override' ] ) && $args[ 'override' ] ) {
				$override = true;
			}

			$post_exists = Formats::post_exists( $args[ 'post_type' ], $post_id, $this->source );
		}

		foreach ( $table_args as $col_key => $col_args ) {
			$col_value  = $col_args;
			$col_type   = '%s';

			if ( is_array( $col_args ) ) {
				$col_value	= ( isset( $col_args[ 'value' ] ) ) ? $col_args[ 'value' ] : $col_args[ 0 ];
				$col_type	= ( isset( $col_args[ 'type' ] ) ) ? $col_args[ 'type' ] : $col_args[ 1 ];
			}

			if ( empty( $col_value ) ) {
				$col_value = '';
			}

			$table_values[ $col_key ]	= $col_value;
			$table_types[ $col_key ]	= $col_type;
		}

		if ( $post_exists > 0 && $post_exists !== true ) {
			if ( $override ) {
				$wpdb->update(
					$wpdb->prefix . $table_name,
					$table_values,
					[ 'post_id' => $post_id ]
				);
			}

			return false;
		} else {
			$result = $wpdb->insert(
				$wpdb->prefix . $table_name,
				$table_values,
				$table_types
			);
		}

		return true;
	}



	/**
	 * This function fires in Classes of WPEventsImporter\Importers
	 * Taxonomy -> Term -> Child Term
	 * Args [ 'description' => 'Description text', 'slug' => 'slug-text', 'parent' => 'id' ]
	 *
	 * @param int $post_id
	 * @param string $term
	 * @param string $taxonomy
	 * @param array $args
	 * @return bool|int false or 'term_id'
	 */
	function add_taxonomy_term( $post_id, $term, $taxonomy, $args = [], $meta = [] )
	{
		$exists_term	= \term_exists( $term, $taxonomy );
		$selected_terms	= [];

		// Retrieves current term_id list
		if ( $terms = \get_the_terms( $post_id, $taxonomy ) ) {
			$selected_terms = \wp_list_pluck( $terms, 'term_id' );
		}

		if ( ! empty( $exists_term ) ) {
			if ( ! is_array( $exists_term ) ) {
				$term_id = $exists_term;
			} else {
				$term_id = $exists_term[ 'term_id' ];
			}
		} elseif ( is_array( $args ) ) {
			$result	= \wp_insert_term( $term, $taxonomy, $args );

			if ( isset( $result[ 'term_id' ] ) ) {
				$term_id = $result[ 'term_id' ];
			}

			if ( is_array( $meta ) && count( $meta ) > 0 ) {
				foreach ( $meta as $meta_key => $meta_value ) {
					\add_term_meta( $term_id, $meta_key, $meta_value, true );
				}
			}
		} else {
			return false;
		}

		$term_id = (int)$term_id;

		if ( $term_id > 0 ) {
			$selected_terms[] = $term_id;
		}

		if ( isset( $args[ 'parent' ] ) && $args[ 'parent' ] > 0 ) {
			$selected_terms[] = $args[ 'parent' ];
		}

		if ( $selected_terms ) {
			\wp_set_post_terms( $post_id, $selected_terms, $taxonomy );
		}

		return $term_id;
	}



	/**
	 * This function fires in Classes of WPEventsImporter\Importers
	 *
	 * @param $type_name
	 * @param $args
	 * @param array $meta_args
	 * @param string $status
	 * @return bool|int
	 */
	public function add_custom_post( $type_name, $args, $meta_args = [], $status = "publish" )
	{
		$inserted_post_id = 0;
		$override = false;

		if ( empty( $type_name ) || ! isset( $args[ 'name' ] ) ) {
			return false;
		}

		if ( ! isset( $args[ 'description' ] ) ) {
			$args[ 'description' ] = '';
		}

		$post_data_args = [
			'post_title'	=> $args[ 'name' ],
			'post_content'	=> $args[ 'description' ],
			'post_type'		=> $type_name,
			'post_status'	=> $status,
		];

		if ( isset( $args[ 'override' ] ) && $args[ 'override' ] ) {
			$override = true;
		}

		$update = Formats::post_exists( $type_name, $args[ 'id' ], $this->source );

		if ( $update > 0 ) {
			if ( $override ) {
				$post_data_args[ 'ID' ] = $update;
			} else {
				// If override closed and event already exists then break the process in here
				return $update;
			}
		}

		$inserted_post_id   = \wp_insert_post( $post_data_args, true );
		$insert_post_error  = \is_wp_error( $inserted_post_id );

		// Break the function and return false, if the post not added
		if ( $insert_post_error || $inserted_post_id < 1 ) {
			return false;
		}

		// Add event image
		if ( isset( $args[ 'image_url' ] ) && ! empty( $args[ 'image_url' ] ) ) {
			$img_name = $this->source . '-event-' . $inserted_post_id;

			$this->add_event_image( $inserted_post_id, $args[ 'name' ], $args[ 'image_url' ], $img_name );
		}

		// Add post meta
		if ( ! is_array( $meta_args ) ) {
			$meta_args = [];
		}

		$meta_args += [
			'wpeventsimporter_event_id' => $args[ 'id' ],
			'wpeventsimporter_event_platform' => $this->source,
		];

		// Add post meta data
		if ( count( $meta_args ) > 0 ) {
			foreach ( $meta_args as $meta_name => $meta_value ) {
				if ( get_post_meta( $inserted_post_id, $meta_name ) ) {
					\update_post_meta( $inserted_post_id, $meta_name, $meta_value );
				} else {
					\add_post_meta( $inserted_post_id, $meta_name, $meta_value, true );
				}
			}
		}

		return $inserted_post_id;
	}



	/**
	 * @param string $name
	 * @param mixed $value
	 */
	protected function add_post_meta( $name, $value )
	{
		if ( ! empty( $value ) ) {
			$this->meta_values[ $name ] = $value;
		}
	}



	/**
	 * @param string $source (import origin for example facebook)
	 * @param array $data [ 'post_data'(array), 'meta_data'(array) ]
	 * @return bool
	 */
	public function import( $source, array $data )
	{
		$this->set_source( $source );

		$post_data	= $data[ 'post_data' ];
		$meta_data	= $data[ 'meta_data' ];
		unset( $data );

		// Set non-exists values as null for preventing errors
		$meta_data += Formats::$event_data_fields;

		if ( ! method_exists( $this, 'main' ) ) return false;

		$this->main( $post_data, $meta_data );

		return true;
	}
}
