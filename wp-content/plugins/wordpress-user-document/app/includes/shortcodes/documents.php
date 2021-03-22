<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Shortcodes class.
 */
class WUD_Documents_Shortcode {

	/**
	 * Output the shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 */
	public static function output( $atts ) {

		$args      = (object) array(
			'page'    => absint( max( 1, absint( get_query_var( 'paged' ) ) ) ),
			'columns' => wud_get_default_documents_per_row(),
			'rows'    => wud_get_default_documents_rows_per_page(),
		);

		$shortcode = new WUD_Shortcode_Documents(
			array_merge(
				wud_app()->query->get_catalog_ordering_args(),
				array(
					'page'     => $args->page,
					'columns'  => $args->columns,
					'rows'     => $args->rows,
					'orderby'  => '',
					'order'    => '',
					'paginate' => true,
					'cache'    => false,
				)
			),
			'documents' );

		// Allow queries to run e.g.
		add_action( 'pre_get_posts', array( wud_app()->query, 'document_query' ) );

		$content = $shortcode->get_content();

		// Remove actions and self to avoid nested calls.
		remove_action( 'pre_get_posts', array( wud_app()->query, 'document_query' ) );
		wud_app()->query->remove_document_query();

		echo balanceTags($content);
	}

}