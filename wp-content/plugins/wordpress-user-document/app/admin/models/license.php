<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Model;

/**
 * Class wudLicenseModel
 */
class wudLicenseModel extends Model {

	/**
	 * Add license
	 *
	 * @param $data
	 *
	 * @return int|WP_Error
	 */
	public function add_license( $data ) {
		$post = array(
			'post_type'    => 'wud-license',
			'post_title'   => $data['name'],
			'post_content' => '',
			'post_status'  => 'publish'
		);


		$license_id = wp_insert_post( $post );

		if ( $license_id ) {

			$metadata                   = array();
			$metadata['icon']           = $data['icon'];
			$metadata['reference_link'] = $data['reference_link'];
			update_post_meta( $license_id, 'wud_license_metadata', $metadata );
		}

		return $license_id;
	}

	/**
	 * Get a license by object or ID
	 *
	 * @param $row
	 *
	 * @return array|bool|WP_Post|null
	 */
	public function get_license( $row ) {
		global $wud_settings;
		$license = is_numeric( $row ) ? get_post( $row, ARRAY_A ) : (array) $row;

		if ( $license == false ) {
			return false;
		}

		$license['name'] = $license['post_title'];

		$metadata = get_post_meta( $license['ID'], 'wud_license_metadata', true );
		foreach ( $this->defined_meta_fields() as $key ) {
			if ( isset( $metadata[ $key ] ) ) {
				$license[ $key ] = $metadata[ $key ];
			} else {
				$license[ $key ] = '';
			}
		}

		return $license;
	}

	/**
	 * Define metadata for license
	 *
	 * @return array
	 */
	public function defined_meta_fields() {
		return array(
			'icon',
			'reference_link',
		);
	}

	/**
	 * Update a license
	 *
	 * @param int $id
	 * @param $data
	 *
	 * @return bool|void
	 */
	public function update( $id = 0, $data ) {
		$args = array(
			'ID'            => $id,
			'post_title'    => $data['name'],
			'post_modified' => date( 'Y-m-d H:i:s' ),
			'post_type'     => 'wud-license',
		);

		wp_update_post( $args );

		$metadata = get_post_meta( $id, 'wud_license_metadata', true );

		$metaFields = $this->defined_meta_fields();
		foreach ( $metaFields as $key ) {
			if ( isset( $data[ $key ] ) ) {
				$metadata[ $key ] = $data[ $key ];
			}
		}

		update_post_meta( $id, 'wud_license_metadata', $metadata );

		return true;
	}

	/**
	 * Delete a document by ID
	 *
	 * @param $id
	 *
	 * @return bool|void
	 */
	public function delete( $id ) {
		if ( wp_delete_post( $id, true ) ) {

			delete_post_meta( $id, 'wud_license_metadata' );

			return true;
		}

		return false;
	}
}
