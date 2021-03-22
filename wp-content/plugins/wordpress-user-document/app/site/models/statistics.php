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
 * Class wudStatisticsModel
 */
class wudStatisticsModel extends Model {

	/**
	 * Get statistic archive page
	 * @return array
	 */
	public function get_statistics() {
		global $wp_query;
		$args = array(
			'posts_per_page' => - 1,
			'post_type'      => 'wud-doc',
			'post_status'    => 'publish',
		);

		$args['meta_query'] = wud_app()->query->get_meta_query( array(), true );

		if ( isset( $wp_query->query_vars['wud-category'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'wud-category',
					'terms'            => $wp_query->query_vars['wud-category'],
					'field'            => 'slug',
					'include_children' => false
				)
			);
		}

		if ( isset( $wp_query->query_vars['wud-tag'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'wud-tag',
					'terms'            => $wp_query->query_vars['wud-tag'],
					'field'            => 'slug',
					'include_children' => false
				)
			);
		}

		if ( wud_is_single_document() ) {
			$args['p'] = $wp_query->post->ID;
		}

		$rows = get_posts( $args );

		$doc_model = $this->get_model( 'doc', 'admin' );

		$total = 0;
		$likes = 0;
		$views = 0;

		foreach ( $rows as $row ) {
			$total ++;
			$doc   = $doc_model->get_doc( $row );
			$likes += $doc['likes'];
			$views += $doc['count'];
		}

		return array( 'total' => $total, 'likes' => $likes, 'views' => $views );
	}
}
