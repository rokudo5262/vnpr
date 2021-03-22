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
 * Class wudDocsModel
 */
class wudDocsModel extends Model {


	/**
	 * Get top viewed documents for widget
	 *
	 * @param $category_id
	 * @param int $limit
	 *
	 * @return array
	 */
	public function get_top_viewed_documents( $category_id, $limit = 5 ) {

		$args = array(
			'posts_per_page' => $limit,
			'post_type'      => 'wud-doc',
			'post_status'    => 'publish',
			'orderby'        => 'meta_value_num',
			'meta_key'       => 'wud_doc_count',
			'order'          => 'DESC'
		);

		$args['meta_query'] = wud_app()->query->get_meta_query(
			array(
				array(
					'key'     => 'wud_doc_count',
					'value'   => 0,
					'compare' => '>'
				)
			), true );

		if ( is_numeric( $category_id ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'wud-category',
					'terms'            => (int) $category_id,
					'include_children' => false
				)
			);
		}


		$rows = get_posts( $args );

		$docs = array();

		$doc_model = $this->get_model( 'doc', 'admin' );

		foreach ( $rows as $row ) {
			$doc    = $doc_model->get_doc( $row );
			$docs[] = (object) $doc;
		}

		return $docs;

	}

	/**
	 * Get most liked documents for widget
	 *
	 * @param $category_id
	 * @param int $limit
	 *
	 * @return array
	 */
	public function get_most_liked_documents( $category_id, $limit = 5 ) {
		$args = array(
			'posts_per_page' => $limit,
			'post_type'      => 'wud-doc',
			'post_status'    => 'publish',
			'orderby'        => 'wud_post_like_count',
			'order'          => 'DESC'
		);

		$args['meta_query'] = wud_app()->query->get_meta_query(
			array(
				array(
					'key'     => 'wud_post_like_count',
					'value'   => 0,
					'compare' => '>'
				)
			), true );

		if ( is_numeric( $category_id ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'wud-category',
					'terms'            => (int) $category_id,
					'include_children' => false
				)
			);
		}


		$rows = get_posts( $args );

		$docs = array();

		$doc_model = $this->get_model( 'doc', 'admin' );

		foreach ( $rows as $row ) {
			$doc    = $doc_model->get_doc( $row );
			$docs[] = (object) $doc;
		}

		return $docs;
	}

	/**
	 * Get top download documents for widget
	 *
	 * @param $category_id
	 * @param int $limit
	 *
	 * @return array
	 */
	public function get_top_download_documents( $category_id, $limit = 5 ) {
		$args = array(
			'posts_per_page' => $limit,
			'post_type'      => 'wud-doc',
			'post_status'    => 'publish',
			'orderby'        => 'wud_doc_download',
			'order'          => 'DESC'
		);

		$args['meta_query'] = wud_app()->query->get_meta_query(
			array(
				array(
					'key'     => 'wud_doc_download',
					'value'   => 0,
					'compare' => '>'
				)
			), true );

		if ( is_numeric( $category_id ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'wud-category',
					'terms'            => (int) $category_id,
					'include_children' => false
				)
			);
		}


		$rows = get_posts( $args );

		$docs = array();

		$doc_model = $this->get_model( 'doc', 'admin' );

		foreach ( $rows as $row ) {
			$doc    = $doc_model->get_doc( $row );
			$docs[] = (object) $doc;
		}

		return $docs;
	}

	/**
	 * Get most discussed documents for widget
	 *
	 * @param $category_id
	 * @param int $limit
	 *
	 * @return array
	 */
	public function get_most_discussed_documents( $category_id, $limit = 5 ) {
		$args = array(
			'posts_per_page' => $limit,
			'post_type'      => 'wud-doc',
			'post_status'    => 'publish',
			'comment_count'  => array( 'value' => 0, 'compare' => '>' ),
			'orderby'        => 'comment_count',
			'order'          => 'DESC'
		);

		$args['meta_query'] = wud_app()->query->get_meta_query( array(), true );

		if ( is_numeric( $category_id ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'wud-category',
					'terms'            => (int) $category_id,
					'include_children' => false
				)
			);
		}


		$rows = get_posts( $args );

		$docs = array();

		$doc_model = $this->get_model( 'doc', 'admin' );

		foreach ( $rows as $row ) {
			$doc    = $doc_model->get_doc( $row );
			$docs[] = (object) $doc;
		}

		return $docs;
	}

	/**
	 *
	 * Get documents for widget
	 *
	 * @param $category_id
	 * @param string $show_by
	 * @param string $order_by
	 * @param string $order
	 * @param int $limit
	 *
	 * @return array
	 */
	public function get_documents( $category_id, $show_by = '', $order_by = 'date', $order = 'desc', $limit = 5 ) {
		$args = array(
			'posts_per_page' => $limit,
			'post_type'      => 'wud-doc',
			'post_status'    => 'publish',
			'orderby'        => $order_by,
			'order'          => $order
		);

		if ( is_numeric( $category_id ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'wud-category',
					'terms'            => (int) $category_id,
					'include_children' => false
				)
			);
		}

		$args['meta_query'] = wud_app()->query->get_meta_query( array(), true );

		if ( $show_by != '' ) {
			if ( $show_by == 'featured' ) {
				$args['meta_query'][] = array(
					'key'   => 'wud_doc_featured',
					'value' => 1,
				);
			}
		}
		$rows = get_posts( $args );

		$docs = array();

		$doc_model = $this->get_model( 'doc', 'admin' );

		foreach ( $rows as $row ) {
			$doc    = $doc_model->get_doc( $row );
			$docs[] = (object) $doc;
		}

		return $docs;
	}
}
