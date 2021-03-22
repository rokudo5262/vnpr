<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Documents shortcode class.
 */
class WUD_Shortcode_Documents {

	/**
	 * Shortcode type.
	 * @var   string
	 */
	protected $type = 'documents';

	/**
	 * Attributes.
	 * @var   array
	 */
	protected $attributes = array();

	/**
	 * Query args.
	 * @var   array
	 */
	protected $query_args = array();

	/**
	 * Initialize shortcode.
	 *
	 * @param array $attributes Shortcode attributes.
	 * @param string $type Shortcode type.
	 */
	public function __construct( $attributes = array(), $type = 'documents' ) {
		$this->type       = $type;
		$this->attributes = $this->parse_attributes( $attributes );
		$this->query_args = $this->parse_query_args();
	}

	/**
	 * Get shortcode attributes.
	 * @return array
	 */
	public function get_attributes() {
		return $this->attributes;
	}

	/**
	 * Get query args.
	 * @return array
	 */
	public function get_query_args() {
		return $this->query_args;
	}

	/**
	 * Get shortcode type.
	 * @return array
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Get shortcode content.
	 * @return string
	 */
	public function get_content() {
		return $this->document_loop();
	}

	/**
	 * Parse attributes.
	 *
	 * @param array $attributes Shortcode attributes.
	 *
	 * @return array
	 */
	protected function parse_attributes( $attributes ) {

		$attributes = shortcode_atts(
			array(
				'limit'          => '-1',
				// Results limit.
				'columns'        => '',
				// Number of columns.
				'rows'           => '',
				// Number of rows. If defined, limit will be ignored.
				'orderby'        => 'title',
				// menu_order, title, date, rand, price, popularity, rating, or id.
				'order'          => 'ASC',
				// ASC or DESC.
				'ids'            => '',
				// Comma separated IDs.
				'category'       => '',
				// Comma separated category slugs or ids.
				'cat_operator'   => 'IN',
				// Operator to compare categories. Possible values are 'IN', 'NOT IN', 'AND'.
				'attribute'      => '',
				// Single attribute slug.
				'terms'          => '',
				// Comma separated term slugs or ids.
				'terms_operator' => 'IN',
				// Operator to compare terms. Possible values are 'IN', 'NOT IN', 'AND'.
				'tag'            => '',
				// Comma separated tag slugs.
				'tag_operator'   => 'IN',
				// Operator to compare tags. Possible values are 'IN', 'NOT IN', 'AND'.
				'class'          => '',
				// HTML class.
				'page'           => 1,
				// Page for pagination.
				'paginate'       => false,
				// Should results be paginated.
				'cache'          => true,
				// Should shortcode output be cached.
				'author'         => 0,
				//  id or array ids of author
				'list_type'      => 'list',
				//  default is list, list_table or table
			),
			$attributes,
			$this->type
		);

		return $attributes;
	}

	/**
	 * Parse query args.
	 * @return array
	 */
	protected function parse_query_args() {
		$query_args = array(
			'post_type'           => 'wud-doc',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => false === wud_string_to_bool( $this->attributes['paginate'] ),
			'orderby'             => empty( $_GET['orderby'] ) ? $this->attributes['orderby'] : sanitize_text_field( wp_unslash( ( $_GET['orderby'] ) ) )
		);

		$orderby_value         = explode( '-', $query_args['orderby'] );
		$orderby               = esc_attr( $orderby_value[0] );
		$order                 = ! empty( $orderby_value[1] ) ? $orderby_value[1] : strtoupper( $this->attributes['order'] );
		$query_args['orderby'] = $orderby;
		$query_args['order']   = $order;

		if ( wud_string_to_bool( $this->attributes['paginate'] ) ) {
			$this->attributes['page'] = absint( empty( $_GET['document-page'] ) ? 1 : absint( $_GET['document-page'] ) );
		}

		if ( ! empty( $this->attributes['rows'] ) ) {
			$this->attributes['limit'] = $this->attributes['columns'] * $this->attributes['rows'];
		}

		$ordering_args         = wud_app()->query->get_catalog_ordering_args( $query_args['orderby'], $query_args['order'] );
		$query_args['orderby'] = $ordering_args['orderby'];
		$query_args['order']   = $ordering_args['order'];
		if ( $ordering_args['meta_key'] ) {
			$query_args['meta_key'] = $ordering_args['meta_key'];
		}

		$query_args['posts_per_page'] = intval( $this->attributes['limit'] );
		if ( 1 < $this->attributes['page'] ) {
			$query_args['paged'] = absint( $this->attributes['page'] );
		}

		$query_args['meta_query'] = wud_app()->query->get_meta_query();
		$query_args['tax_query']  = wud_app()->query->get_tax_query();

		// search keyword
		if ( isset( $_GET['wud_search'] ) ) {
			$search = sanitize_text_field( wp_unslash( $_GET[ 'wud_search' ] ) );
			if ( $search != '' ) {
				$query_args['s'] = $search;
			}

		}


		// IDs.
		$this->set_ids_query_args( $query_args );

		// Set specific types query args.
		if ( method_exists( $this, "set_{$this->type}_query_args" ) ) {
			$this->{"set_{$this->type}_query_args"}( $query_args );
		}

		// Categories.
		$this->set_categories_query_args( $query_args );

		// Tags.
		$this->set_tags_query_args( $query_args );

		$query_args = apply_filters( 'wud_shortcode_documents_query', $query_args, $this->attributes, $this->type );

		// Always query only IDs.
		$query_args['fields'] = 'ids';

		return $query_args;
	}

	/**
	 * Set ids query args.
	 *
	 * @param array $query_args Query args.
	 */
	protected function set_ids_query_args( &$query_args ) {
		if ( ! empty( $this->attributes['ids'] ) ) {
			$ids = array_map( 'trim', explode( ',', $this->attributes['ids'] ) );

			if ( 1 === count( $ids ) ) {
				$query_args['p'] = $ids[0];
			} else {
				$query_args['post__in'] = $ids;
			}
		}
	}


	/**
	 * Set categories query args.
	 *
	 * @param array $query_args Query args.
	 */
	protected function set_categories_query_args( &$query_args ) {
		if ( ! empty( $this->attributes['category'] ) ) {
			$categories = array_map( 'sanitize_title', explode( ',', $this->attributes['category'] ) );
			$field      = 'slug';

			if ( is_numeric( $categories[0] ) ) {
				$field      = 'term_id';
				$categories = array_map( 'absint', $categories );
				// Check numeric slugs.
				foreach ( $categories as $cat ) {
					$the_cat = get_term_by( 'slug', $cat, 'wud-category' );
					if ( false !== $the_cat ) {
						$categories[] = $the_cat->term_id;
					}
				}
			}

			$query_args['tax_query'][] = array(
				'taxonomy'         => 'wud-category',
				'terms'            => $categories,
				'field'            => $field,
				'operator'         => $this->attributes['cat_operator'],

				/*
				 * When cat_operator is AND, the children categories should be excluded,
				 * as only products belonging to all the children categories would be selected.
				 */
				'include_children' => 'AND' === $this->attributes['cat_operator'] ? false : true,
			);
		}
	}

	/**
	 * Set tags query args.
	 *
	 * @param array $query_args Query args.
	 */
	protected function set_tags_query_args( &$query_args ) {
		if ( ! empty( $this->attributes['tag'] ) ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => 'wud-tag',
				'terms'    => array_map( 'sanitize_title', explode( ',', $this->attributes['tag'] ) ),
				'field'    => 'slug',
				'operator' => $this->attributes['tag_operator'],
			);
		}
	}

	/**
	 * Set author query args.
	 *
	 * @param array $query_args Query args.
	 */
	protected function set_author_query_args( &$query_args ) {
		if ( ! empty( $this->attributes['author'] ) ) {
			global $wp_query;
			$query_args['author']      = $this->attributes['author'];
			$query_args['post_status'] = 'publish,private,pending';
			$query_args['date_query']  = wud_app()->query->get_date_query( array(), true );

			$my_account_tab = $wp_query->get( 'tab-document' );
			if ( $my_account_tab != '' ) {

				if ( $my_account_tab == 'pending' ) {
					$query_args['meta_query'] = array_merge( $query_args['meta_query'], array(
						array(
							'key'   => 'wud_doc_approved',
							'value' => 0,
						)
					) );
				} elseif ( $my_account_tab == 'approved' ) {

					$query_args['meta_query'] = array_merge( $query_args['meta_query'], array(
						array(
							'key'   => 'wud_doc_approved',
							'value' => 1,
						)
					) );
				}

			}

		}
	}

	/**
	 * Set documents query args.
	 *
	 * @param array $query_args Query args.
	 */
	protected function set_documents_query_args( &$query_args ) {
		$query_args['meta_query'] = array_merge( $query_args['meta_query'], wud_app()->query->get_meta_query( array(), true ) );
		$query_args['date_query'] = wud_app()->query->get_date_query( array(), true );
		if ( ! empty( $this->attributes['author'] ) ) {
			$query_args['author']      = $this->attributes['author'];
		}
	}

	/**
	 * Get wrapper classes.
	 *
	 * @param array $columns Number of columns.
	 *
	 * @return array
	 */
	protected function get_wrapper_classes() {
		$classes = array( 'wud-shortcode-'.$this->get_type().'-wrapper' );

		$classes[] = $this->attributes['class'];

		return $classes;
	}

	/**
	 * Generate and return the transient name for this shortcode based on the query args.
	 * @return string
	 */
	protected function get_transient_name() {
		$transient_name = 'wud_doc_loop_' . md5( wp_json_encode( $this->query_args ) . $this->type );

		if ( 'rand' === $this->query_args['orderby'] ) {
			// When using rand, we'll cache a number of random queries and pull those to avoid querying rand on each page load.
			$rand_index     = wp_rand( 0, max( 1, absint( apply_filters( 'wud_doc_query_max_rand_cache_count', 5 ) ) ) );
			$transient_name .= $rand_index;
		}

		return $transient_name;
	}

	/**
	 * Run the query and return an array of data, including queried ids and pagination information.
	 * @return object Object with the following props; ids, per_page, found_posts, max_num_pages, current_page
	 */
	protected function get_query_results() {
		$transient_name  = $this->get_transient_name();
		$cache           = wud_string_to_bool( $this->attributes['cache'] ) === true;
		$transient_value = $cache ? get_transient( $transient_name ) : false;

		if ( $transient_value ) {
			$results = $transient_value;
		} else {
			$query = new WP_Query( $this->query_args );

			$paginated = ! $query->get( 'no_found_rows' );

			$results = (object) array(
				'ids'          => wp_parse_id_list( $query->posts ),
				'total'        => $paginated ? (int) $query->found_posts : count( $query->posts ),
				'total_pages'  => $paginated ? (int) $query->max_num_pages : 1,
				'per_page'     => (int) $query->get( 'posts_per_page' ),
				'current_page' => $paginated ? (int) max( 1, $query->get( 'paged', 1 ) ) : 1,
			);

			if ( $cache ) {
				set_transient( $transient_name, $results, DAY_IN_SECONDS * 30 );
			}
		}

		return $results;
	}

	/**
	 * Loop over found documents.
	 * @return string
	 */
	protected function document_loop() {
		$columns   = absint( $this->attributes['columns'] );
		$classes   = $this->get_wrapper_classes();
		$documents = $this->get_query_results();

		ob_start();

		do_action( "wud_doc_shortcode_before_{$this->type}_wrapper", $this->attributes );

		if ( $documents && $documents->ids ) {
			// Prime caches to reduce future queries.
			if ( is_callable( '_prime_post_caches' ) ) {
				_prime_post_caches( $documents->ids );
			}

			// Setup the loop.
			wud_setup_loop(
				array(
					'columns'      => $columns,
					'name'         => $this->type,
					'is_shortcode' => true,
					'is_search'    => false,
					'is_paginated' => wud_string_to_bool( $this->attributes['paginate'] ),
					'total'        => $documents->total,
					'total_pages'  => $documents->total_pages,
					'per_page'     => $documents->per_page,
					'current_page' => $documents->current_page,
					'list_type'    => $this->attributes['list_type'],
				)
			);

			$original_post = $GLOBALS['post'];

			do_action( "wud_doc_shortcode_before_{$this->type}_loop", $this->attributes );

			// Fire standard shop loop hooks when paginating results so we can show result counts and so on.
			if ( wud_string_to_bool( $this->attributes['paginate'] ) ) {
				do_action( 'wud_doc_before_loop' );
			}

			wud_document_loop_start();

			if ( wud_get_loop_prop( 'total' ) ) {
				foreach ( $documents->ids as $doc_id ) {
					$GLOBALS['post'] = get_post( $doc_id );
					setup_postdata( $GLOBALS['post'] );
					// Render document template.
					if ( $this->attributes['list_type'] == 'table' ) {
						wud_get_template_part( 'single/table', 'document' );
					} else if ( $this->attributes['list_type'] == 'list_table' ) {
						wud_get_template_part( 'single/table_list', 'document' );
					} else {
						wud_get_template_part( 'single/content', 'document' );
					}

				}
			}

			wud_document_loop_end();
			$GLOBALS['post'] = $original_post;

			// Fire standard shop loop hooks when paginating results so we can show result counts and so on.
			if ( wud_string_to_bool( $this->attributes['paginate'] ) ) {
				do_action( 'wud_doc_after_loop' );
			}

			do_action( "wud_doc_shortcode_after_{$this->type}_loop", $this->attributes );

			wp_reset_postdata();
			wud_reset_loop();
		} else {
			do_action( "wud_doc_shortcode_{$this->type}_loop_no_results", $this->attributes );
		}

		do_action( "wud_doc_shortcode_after_{$this->type}_wrapper", $this->attributes );

		return '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">' . ob_get_clean() . '</div>';
	}

}
