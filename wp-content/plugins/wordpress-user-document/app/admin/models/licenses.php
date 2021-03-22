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
 * Class wudLicensesModel
 */
class wudLicensesModel extends Model {
	/**
	 * Delete license by list IDs
	 *
	 * @param $ids
	 *
	 * @return bool
	 */
	public function delete_items( $ids ) {
		$license_model = $this->get_model( 'license', 'admin' );
		if ( ! empty( $ids ) ) {
			foreach ( $ids as $id ) {
				$license_model->delete( $id );
			}
		}

		return true;
	}

	/**
	 * Get licenses with pagination
	 *
	 * @param int $perpage the number of licenses per page.
	 * @param int $paged current paged.
	 *
	 * @return array
	 */
	public function get_licenses( $perpage = - 1, $paged = 1 ) {
		$args = array(
			'posts_per_page' => $perpage,
			'paged'          => $paged,
			'post_type'      => 'wud-license',
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'desc',
		);

		$query       = new WP_Query();
		$rows        = $query->query( $args );
		$total_posts = $query->found_posts;

		$licenses = array();

		$license_model = $this->get_model( 'license', 'admin' );
		foreach ( $rows as $row ) {
			$license    = $license_model->get_license( $row );
			$licenses[] = (object) $license;
		}

		return array( $total_posts, $licenses );
	}

}
