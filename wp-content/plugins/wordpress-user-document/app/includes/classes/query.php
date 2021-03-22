<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

class WUD_Query {

	/**
	 * User id
	 */
	public $user_id = 0;
	/**
	 * Query vars to add to wp.
	 *
	 * @var array
	 */
	public $query_vars = array();

	/**
	 * Reference to the main document query on the page.
	 *
	 * @var array
	 */
	private static $document_query;

	/**
	 * Constructor for the query class. Hooks in methods.
	 */
	public function __construct( ) {
		$this->init_query_vars();

		add_action( 'init', array( $this, 'add_endpoints' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars' ), 0 );
		add_action( 'parse_request', array( $this, 'parse_request' ), 0 );
		if (!is_admin()) {
			add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
		}

	}

	/**
	 * Init query vars by loading options.
	 */
	public function init_query_vars() {
		// Query vars to add to WP.
		$this->query_vars = array(
			'create-document' => 'create-document',
			'edit-document'   => 'edit-document',
			'user-logout'     => 'user-logout',
			'tab-document'    => 'tab-document',
		);
	}

	/**
	 * Endpoint mask describing the places the endpoint should be added.
	 * @return int
	 */
	public function get_endpoints_mask() {
		if ( 'page' === get_option( 'show_on_front' ) ) {
			$page_on_front     = get_option( 'page_on_front' );
			$myaccount_page_id = wud_get_page_id( 'my-account' );

			if ( in_array( $page_on_front, array( $myaccount_page_id ), true ) ) {
				return EP_ROOT | EP_PAGES;
			}
		}

		return EP_PAGES;
	}

	/**
	 * Add endpoints for query vars.
	 */
	public function add_endpoints() {
		$mask = $this->get_endpoints_mask();

		foreach ( $this->get_query_vars() as $key => $var ) {
			if ( ! empty( $var ) ) {
				add_rewrite_endpoint( $var, $mask );
			}
		}

	}

	/**
	 * Add query vars.
	 *
	 * @param array $vars Query vars.
	 *
	 * @return array
	 */
	public function add_query_vars( $vars ) {
		foreach ( $this->get_query_vars() as $key => $var ) {
			$vars[] = $key;
		}

		return $vars;
	}

	/**
	 * Get query vars.
	 *
	 * @return array
	 */
	public function get_query_vars() {
		return apply_filters( 'wud_get_query_vars', $this->query_vars );
	}

	/**
	 * Get query current active query var.
	 *
	 * @return string
	 */
	public function get_current_endpoint() {
		global $wp;

		foreach ( $this->get_query_vars() as $key => $value ) {
			if ( isset( $wp->query_vars[ $key ] ) ) {
				return $key;
			}
		}

		return '';
	}

	/**
	 * Parse the request and look for query vars - endpoints may not be supported.
	 */
	public function parse_request() {
		global $wp;

		// Map query vars to their keys, or get them if endpoints are not supported.
		foreach ( $this->get_query_vars() as $key => $var ) {
			if ( isset( $_GET[ $var ] ) ) {
				$wp->query_vars[ $key ] = sanitize_text_field( wp_unslash( $_GET[ $var ] ) );
			} elseif ( isset( $wp->query_vars[ $var ] ) ) {
				$wp->query_vars[ $key ] = $wp->query_vars[ $var ];
			}
		}
	}

	/**
	 * Are we currently on the front page?
	 *
	 * @param WP_Query $q Query instance.
	 *
	 * @return bool
	 */
	private function is_showing_page_on_front( $q ) {
		return $q->is_home() && 'page' === get_option( 'show_on_front' );
	}

	/**
	 * Is the front page a page we define?
	 *
	 * @param int $page_id Page ID.
	 *
	 * @return bool
	 */
	private function page_on_front_is( $page_id ) {
		return absint( get_option( 'page_on_front' ) ) === absint( $page_id );
	}

	/**
	 * Hook into pre_get_comments to do the main comment query.
	 *
	 * @param WP_Query $query Comment Query instance.
	 */
	public function pre_get_comments( $query ) {

		// Access is unlimited when the current user is a site admin.
		if ( current_user_can( 'bp_moderate' ) ) {
			return;
		}
		// Since we're using post__not_in, we have to be aware of post__in requests.
		$exclude_comment_doc_ids = $this->get_exclude_comment_doc_ids();
		if ( ! empty( $exclude_comment_doc_ids ) ) {
			if ( ! empty( $query->query_vars['post__not_in'] ) ) {
				$query->query_vars['post__not_in'] = array_merge( (array) $query->query_vars['post__not_in'], $exclude_comment_doc_ids );
			} else {
				$query->query_vars['post__not_in'] = $exclude_comment_doc_ids;
			}
		}
	}

	/**
	 * Hook into pre_get_posts to do the main document query.
	 *
	 * @param WP_Query $q Query instance.
	 */
	public function pre_get_posts( $q ) {
		// We only want to affect the main query.

		if ( ! $q->is_main_query() ) {
			return;
		}

		// Fixes for queries on static homepages.
		if ( $this->is_showing_page_on_front( $q ) ) {

			// Fix for endpoints on the homepage.
			if ( ! $this->page_on_front_is( $q->get( 'page_id' ) ) ) {
				$_query = wp_parse_args( $q->query );
				if ( ! empty( $_query ) && array_intersect( array_keys( $_query ), array_keys( $this->get_query_vars() ) ) ) {
					$q->is_page     = true;
					$q->is_home     = false;
					$q->is_singular = true;
					$q->set( 'page_id', (int) get_option( 'page_on_front' ) );
					add_filter( 'redirect_canonical', '__return_false' );
				}
			}

			// When orderby is set, WordPress shows posts on the front-page. Get around that here.
			if ( $this->page_on_front_is( wud_get_page_id( 'documents' ) ) ) {
				$_query = wp_parse_args( $q->query );
				if ( empty( $_query ) || ! array_diff( array_keys( $_query ), array( 'preview', 'page', 'paged', 'cpage', 'orderby' ) ) ) {
					$q->set( 'page_id', (int) get_option( 'page_on_front' ) );
					$q->is_page = true;
					$q->is_home = false;

					// WP supporting themes show post type archive.
					if ( current_theme_supports( 'document' ) ) {
						$q->set( 'post_type', 'wud-doc' );
					} else {
						$q->is_singular = true;
					}
				}
			} elseif ( ! empty( $_GET['orderby'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$q->set( 'page_id', (int) get_option( 'page_on_front' ) );
				$q->is_page     = true;
				$q->is_home     = false;
				$q->is_singular = true;
			}
		}

		// Fix document feeds.
		if ( $q->is_feed() && $q->is_post_type_archive( 'wud-doc' ) ) {
			$q->is_comment_feed = false;
		}

		// Special check for documents with the DOCUMENT POST TYPE ARCHIVE on front.
		if ( current_theme_supports( 'document' ) && $q->is_page() && 'page' === get_option( 'show_on_front' ) && absint( $q->get( 'page_id' ) ) === wud_get_page_id( 'documents' ) ) {
			// Define a variable so we know this is the front page feedback later on.
			if ( ! defined( 'DOC_IS_ON_FRONT' ) ) {
				define( 'DOC_IS_ON_FRONT', true );
			}

			if ( isset( $q->query['paged'] ) ) {
				$q->set( 'paged', $q->query['paged'] );
			}

			$this->pre_query_document($q);
		} else if (current_theme_supports( 'document' ) && $q->queried_object !=null && is_page(wud_get_page_id('documents'))) {
			$this->pre_query_document($q);
		}  else if ( $q->is_single && isset( $q->query['post_type'] ) && $q->query['post_type'] == 'wud-doc' ) {
			// check visibility document
			$exclude = $this->get_exclude_doc_ids();
			if ( ! empty( $exclude ) ) {
				$not_in = $q->get( 'post__not_in' );
				$q->set( 'post__not_in', array_merge( (array) $not_in, $exclude ) );
			}
			// check comment
			add_action( 'pre_get_comments', array( $this, 'pre_get_comments' ) );

		} else if ( wud_is_author_document() ) {

		} elseif ( ! $q->is_post_type_archive( 'wud-doc' ) && ! $q->is_tax( get_object_taxonomies( 'wud-doc' ) ) ) {
			// Only apply to document categories, the document post archive, the document page, document tags taxonomies.
			return;
		}

		$this->document_query( $q );
	}

	/**
	 * Set query for document
	 * @param $q
	 */
	private function pre_query_document($q) {

		// This is a front-page feedback.
		$q->set( 'post_type', 'wud-doc' );
		$q->set( 'page_id', '' );

		// Get the actual WP page to avoid errors and let us use is_front_page().
		// This is hacky but works. Awaiting https://core.trac.wordpress.org/ticket/21096.
		global $wp_post_types;

		$documents_page = get_post( wud_get_page_id( 'documents' ) );

		$wp_post_types['wud-doc']->ID         = $documents_page->ID;
		$wp_post_types['wud-doc']->post_title = $documents_page->post_title;
		$wp_post_types['wud-doc']->post_name  = $documents_page->post_name;
		$wp_post_types['wud-doc']->post_type  = $documents_page->post_type;
		$wp_post_types['wud-doc']->ancestors  = get_ancestors( $documents_page->ID, $documents_page->post_type );

		// Fix conditional Functions like is_front_page.
		$q->is_singular          = false;
		$q->is_post_type_archive = true;
		$q->is_archive           = true;
		$q->is_page              = true;
		$q->set('wud_query', true);
		$q->set('name', '');
		$q->set('pagename', '');
		// Fix WP SEO.
		if ( class_exists( 'WPSEO_Meta' ) ) {
			add_filter( 'wpseo_metadesc', array( $this, 'wpseo_metadesc' ) );
			add_filter( 'wpseo_metakey', array( $this, 'wpseo_metakey' ) );
		}
	}

	/**
	 * Fetch a exclude list of doc IDs that are forbidden for the user
	 */
	public function get_exclude_doc_ids() {

		$user = wp_get_current_user();
		// Check the cache first.
		$last_changed = wp_cache_get( 'last_changed', 'wud_exclude_doc_ids' );
		if ( false === $last_changed ) {
			$last_changed = microtime();
			wp_cache_set( 'last_changed', $last_changed, 'wud_exclude_doc_ids' );
		}

		$cache_key = 'wud_docs_for_user_' . $user->ID . '_' . $last_changed;
		$cached = wp_cache_get( $cache_key, 'wud_exclude_doc_ids' );
		if ( false !== $cached ) {
			return $cached;
		} else {

			$tax_query = $this->get_tax_query( array(), true );
			foreach ( $tax_query as &$tq ) {
				$tq['operator'] = "NOT IN";
			}

			// If the tax_query is empty, no docs are forbidden
			if ( empty( $tax_query ) ) {
				$doc_ids = array( 0 );
			} else {
				$query = new WP_Query( array(
					'post_type' => 'wud-doc',
					'posts_per_page' => -1,
					'nopaging' => true,
					'tax_query' => $tax_query,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'no_found_rows' => 1,
					'fields' => 'ids',
				) );
				if ( $query->posts ) {
					$doc_ids = $query->posts;
				} else {
					/*
					 * If no results are returned, we save a 0 value to avoid the
					 * post__in => array() fetches everything problem.
					 */
					$doc_ids = array( 0 );
				}
			}

			// Set the cache to avoid duplicate requests.
			wp_cache_set( $cache_key, $doc_ids, 'wud_exclude_doc_ids' );

			return $doc_ids;
		}
	}

	/**
	 * Fetch a exclude list of doc IDs that are forbidden for the user
	 */
	public function get_exclude_edit_doc_ids() {

		$user = wp_get_current_user();
		// Check the cache first.
		$last_changed = wp_cache_get( 'last_changed', 'wud_exclude_edit_doc_ids' );
		if ( false === $last_changed ) {
			$last_changed = microtime();
			wp_cache_set( 'last_changed', $last_changed, 'wud_exclude_edit_doc_ids' );
		}

		$cache_key = 'wud_edit_docs_for_user_' . $user->ID . '_' . $last_changed;
		$cached = wp_cache_get( $cache_key, 'wud_exclude_edit_doc_ids' );
		if ( false !== $cached ) {
			return $cached;
		} else {

			$tax_query = $this->get_edit_doc_tax_query( array(), true );
			foreach ( $tax_query as &$tq ) {
				$tq['operator'] = "NOT IN";
			}

			// If the tax_query is empty, no docs are forbidden
			if ( empty( $tax_query ) ) {
				$doc_ids = array( 0 );
			} else {
				$query = new WP_Query( array(
					'post_type' => 'wud-doc',
					'posts_per_page' => -1,
					'nopaging' => true,
					'tax_query' => $tax_query,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'no_found_rows' => 1,
					'fields' => 'ids',
				) );
				if ( $query->posts ) {
					$doc_ids = $query->posts;
				} else {
					/*
					 * If no results are returned, we save a 0 value to avoid the
					 * post__in => array() fetches everything problem.
					 */
					$doc_ids = array( 0 );
				}
			}

			// Set the cache to avoid duplicate requests.
			wp_cache_set( $cache_key, $doc_ids, 'wud_exclude_edit_doc_ids' );

			return $doc_ids;
		}
	}

	/**
	 * Fetch a list of comment IDs that are forbidden for the user
	 */
	public function get_exclude_comment_ids() {

		$user = wp_get_current_user();
		// Check the cache first.
		$last_changed = wp_cache_get( 'last_changed', 'wud_exclude_comment_ids' );
		if ( false === $last_changed ) {
			$last_changed = microtime();
			wp_cache_set( 'last_changed', $last_changed, 'wud_exclude_comment_ids' );
		}

		$cache_key = 'wud_comment_for_user_' . $user->ID . '_' . $last_changed;
		$cached = wp_cache_get( $cache_key, 'wud_exclude_comment_ids' );
		if ( false !== $cached ) {
			return $cached;
		} else {
			$comment_ids = get_comments( array(
				'post__in' => $this->get_exclude_comment_doc_ids(),
				'fields' => 'ids',
			) );
			if ( ! $comment_ids ) {
				/*
				 * If no results are returned, we save a 0 value to avoid the
				 * post__in => array() fetches everything problem.
				 */
				$comment_ids = array( 0 );
			}

			// Set the cache to avoid duplicate requests.
			wp_cache_set( $cache_key, $comment_ids, 'wud_exclude_comment_ids' );

			return $comment_ids;
		}
	}

	/**
	 * Fetch a list of comment doc IDs that are forbidden for the user
	 */
	public function get_exclude_comment_doc_ids() {

		$user = wp_get_current_user();
		// Check the cache first.
		$last_changed = wp_cache_get( 'last_changed', 'wud_exclude_comment_doc_ids' );
		if ( false === $last_changed ) {
			$last_changed = microtime();
			wp_cache_set( 'last_changed', $last_changed, 'wud_exclude_comment_doc_ids' );
		}

		$cache_key = 'wud_exclude_comment_docs_for_user_' . $user->ID . '_' . $last_changed;
		$cached = wp_cache_get( $cache_key, 'wud_exclude_comment_doc_ids' );
		if ( false !== $cached ) {
			return $cached;
		} else {

			$tax_query = $this->get_comment_tax_query( array(), true );
			foreach ( $tax_query as &$tq ) {
				$tq['operator'] = "NOT IN";
			}

			// If the tax_query is empty, no docs are forbidden
			if ( empty( $tax_query ) ) {
				$doc_ids = array( 0 );
			} else {
				$query = new WP_Query( array(
					'post_type' => 'wud-doc',
					'posts_per_page' => -1,
					'nopaging' => true,
					'tax_query' => $tax_query,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'no_found_rows' => 1,
					'fields' => 'ids',
				) );
				if ( $query->posts ) {
					$doc_ids = $query->posts;
				} else {
					/*
					 * If no results are returned, we save a 0 value to avoid the
					 * post__in => array() fetches everything problem.
					 */
					$doc_ids = array( 0 );
				}
			}

			// Set the cache to avoid duplicate requests.
			wp_cache_set( $cache_key, $doc_ids, 'wud_exclude_comment_doc_ids' );

			return $doc_ids;
		}
	}


	/**
	 * WP SEO meta description.
	 *
	 * Hooked into wpseo_ hook already, so no need for function_exist.
	 *
	 * @return string
	 */
	public function wpseo_metadesc() {
		return WPSEO_Meta::get_value( 'metadesc', wud_get_page_id( 'documents' ) );
	}

	/**
	 * WP SEO meta key.
	 *
	 * Hooked into wpseo_ hook already, so no need for function_exist.
	 *
	 * @return string
	 */
	public function wpseo_metakey() {
		return WPSEO_Meta::get_value( 'metakey', wud_get_page_id( 'documents' ) );
	}

	/**
	 * Query the document, applying sorting/ordering etc.
	 * This applies to the main WordPress loop.
	 *
	 * @param WP_Query $q Query instance.
	 */
	public function document_query( $q ) {
		if ( ! is_feed() ) {
			$ordering = $this->get_catalog_ordering_args();
			$q->set( 'orderby', $ordering['orderby'] );
			$q->set( 'order', $ordering['order'] );

			if ( isset( $ordering['meta_key'] ) ) {
				$q->set( 'meta_key', $ordering['meta_key'] );
			}
		}

		// Query vars that affect posts shown.
		$q->set( 'meta_query', $this->get_meta_query( $q->get( 'meta_query' ), true ) );
		$q->set( 'tax_query', $this->get_tax_query( $q->get( 'tax_query' ), true ) );
		$q->set( 'date_query', $this->get_date_query( $q->get( 'date_query' ), true ) );
		$q->set( 'wud_query', 'document_query' );
		$q->set( 'post__in', array_unique( (array) apply_filters( 'loop_doc_post_in', array() ) ) );

		// Work out how many documents to query.
		$q->set( 'posts_per_page', $q->get( 'posts_per_page' ) ? $q->get( 'posts_per_page' ) : apply_filters( 'loop_doc_per_page', wud_get_default_documents_per_row() * wud_get_default_documents_rows_per_page() ) );
		if ( isset( $_GET['wud_search'] ) ) {
			$search = sanitize_text_field( wp_unslash( $_GET['wud_search'] ) );
			if ($search != '') {
				$q->set( 's', $search );
			}

		}

		// Store reference to this query.
		self::$document_query = $q;

		do_action( 'wud_query', $q, $this );
	}

	/**
	 * Remove the query.
	 */
	public function remove_document_query() {
		remove_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
	}

	/**
	 * Returns an array of arguments for ordering products based on the selected values.
	 *
	 * @param string $orderby Order by param.
	 * @param string $order Order param.
	 *
	 * @return array
	 */
	public function get_catalog_ordering_args( $orderby = '', $order = '' ) {
		global $wud_settings;
		// Get ordering from query string unless defined.
		if ( ! $orderby ) {
			$orderby_value = isset( $_GET['orderby'] ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : get_query_var( 'orderby' ); // WPCS: sanitization ok, input var ok, CSRF ok.

			if ( ! $orderby_value ) {
				if ( is_search() ) {
					$orderby_value = 'relevance';
				} else {
					$orderby_value = apply_filters( 'wud_default_document_orderby', $wud_settings->get_input_value( 'default_document_sortby', 'latest' ) );
				}
			}

			// Get order + orderby args from string.
			$orderby_value = is_array( $orderby_value ) ? $orderby_value : explode( '-', $orderby_value );
			$orderby       = esc_attr( $orderby_value[0] );
			$order         = ! empty( $orderby_value[1] ) ? $orderby_value[1] : $order;
		}

		// Convert to correct format.
		$orderby = strtolower( is_array( $orderby ) ? (string) current( $orderby ) : (string) $orderby );
		$order   = strtoupper( is_array( $order ) ? (string) current( $order ) : (string) $order );
		$args    = array(
			'orderby'  => $orderby,
			'order'    => ( 'DESC' === $order ) ? 'DESC' : 'ASC',
			'meta_key' => '',
		);

		switch ( $orderby ) {
			case 'id':
				$args['orderby'] = 'ID';
				break;
			case 'menu_order':
				$args['orderby'] = 'menu_order title';
				break;
			case 'title':
				$args['orderby'] = 'title';
				$args['order']   = ( 'DESC' === $order ) ? 'DESC' : 'ASC';
				break;
			case 'relevance':
				$args['orderby'] = 'relevance';
				$args['order']   = 'DESC';
				break;
			case 'rand':
				$args['orderby'] = 'rand';
				break;
			case 'date':
				$args['orderby'] = 'date ID';
				$args['order']   = ( 'ASC' === $order ) ? 'ASC' : 'DESC';
				break;
			case 'latest':
				$args['orderby'] = 'date ID';
				$args['order']   = 'DESC';
				break;
			case 'oldest':
				$args['orderby'] = 'date ID';
				$args['order']   = 'ASC';
				break;
			case 'featured':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'wud_doc_featured';
				$args['order']    = 'DESC';
				break;
			case 'most_viewed':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'wud_doc_count';
				$args['order']    = 'DESC';
				break;
			case 'most_discussed':
				$args['orderby'] = 'comment_count';
				$args['order']   = 'DESC';
				break;
			case 'most_liked':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'wud_post_like_count';
				$args['order']    = 'DESC';
				break;
		}

		return apply_filters( 'wud_get_catalog_ordering_args', $args, $orderby, $order );
	}


	/**
	 * Appends meta queries to an array.
	 *
	 * @param array $meta_query Meta query.
	 * @param bool $main_query If is main query.
	 *
	 * @return array
	 */
	public function get_meta_query( $meta_query = array(), $main_query = false ) {
		if ( ! is_array( $meta_query ) ) {
			$meta_query = array();
		}

		if ( $main_query ) {

			// only for approved
			$meta_query[] = array(
				'key'   => 'wud_doc_approved',
				'value' => 1,
			);

		}


		return array_filter( apply_filters( 'wud_doc_query_meta_query', $meta_query, $this ) );
	}

	/**
	 * Appends tax queries to an array.
	 *
	 * @param array $tax_query Tax query.
	 * @param bool $main_query If is main query.
	 *
	 * @return array
	 */
	public function get_tax_query( $tax_query = array(), $main_query = false ) {
		if ( ! is_array( $tax_query ) ) {
			$tax_query = array(
				'relation' => 'AND',
			);
		}

		if ( $main_query ) {
			// filter taxonomy
			$user = wp_get_current_user();
			$access_terms = wud_get_doc_access_terms();
			// bp_moderate users can see anything, so no query needed
			if ( wud_installed_buddypress() && user_can( $user->ID, 'bp_moderate' ) ) {

			} else {

				$tax_query[] = array(
					'terms'    => $access_terms['access_terms'],
					'taxonomy' => 'wud-access',
					'field'    => 'slug',
					'operator' => 'IN',
				);
			}

		}

		return array_filter( apply_filters( 'wud_doc_query_tax_query', $tax_query, $this ) );
	}

	/**
	 * Appends tax queries to an array.
	 *
	 * @param array $tax_query Tax query.
	 * @param bool $main_query If is main query.
	 *
	 * @return array
	 */
	public function get_comment_tax_query( $tax_query = array(), $main_query = false ) {
		if ( ! is_array( $tax_query ) ) {
			$tax_query = array(
				'relation' => 'AND',
			);
		}

		if ( $main_query ) {
			// filter taxonomy
			$user = wp_get_current_user();
			$access_terms = wud_get_doc_access_terms();
			// bp_moderate users can see anything, so no query needed
			if ( wud_installed_buddypress() && user_can( $user->ID, 'bp_moderate' ) ) {

			} else {

				$tax_query[] = array(
					'terms'    => $access_terms['comment_terms'],
					'taxonomy' => 'wud-comment-access',
					'field'    => 'slug',
					'operator' => 'IN',
				);
			}

		}

		return array_filter( apply_filters( 'wud_doc_query_comment_tax_query', $tax_query, $this ) );
	}

	/**
	 * Appends tax queries to an array.
	 *
	 * @param array $tax_query Tax query.
	 * @param bool $main_query If is main query.
	 *
	 * @return array
	 */
	public function get_edit_doc_tax_query( $tax_query = array(), $main_query = false ) {
		if ( ! is_array( $tax_query ) ) {
			$tax_query = array(
				'relation' => 'AND',
			);
		}

		if ( $main_query ) {
			// filter taxonomy
			$user = wp_get_current_user();
			$access_terms = wud_get_doc_access_terms();
			// bp_moderate users can see anything, so no query needed
			if ( wud_installed_buddypress() && user_can( $user->ID, 'bp_moderate' ) ) {

			} else {

				$tax_query[] = array(
					'terms'    => $access_terms['edit_terms'],
					'taxonomy' => 'wud-edit-access',
					'field'    => 'slug',
					'operator' => 'IN',
				);
			}

		}

		return array_filter( apply_filters( 'wud_doc_query_comment_tax_query', $tax_query, $this ) );
	}


	/**
	 * Appends tax queries to an array.
	 *
	 * @param array $date_query Date query.
	 * @param bool $main_query If is main query.
	 *
	 * @return array
	 */
	public function get_date_query( $date_query = array(), $main_query = false ) {
		global $wud_settings;
		if ( ! is_array( $date_query ) ) {
			$date_query = array(
				'relation' => 'AND',
			);
		}

		if ( $main_query ) {
			// filter date
			$range_date = isset( $_GET['range_date'] ) ? sanitize_text_field( wp_unslash( $_GET['range_date'] ) ) : apply_filters( 'wud_default_range_date', $wud_settings->get_input_value( 'default_range_date', 'all' ) );
			if ( $range_date != 'all' && $range_date != '' ) {

				switch ( $range_date ) {
					case 'all':
						break;
					case 'this_month':
						$query_date = date( 'Y-m-d' );
						$date       = new DateTime( $query_date );
						$date->modify( 'first day of this month' );
						$firstday = $date->format( 'Y-m-d' );
						$date->modify( 'last day of this month' );
						$lastday = $date->format( 'Y-m-d' );

						$date_query[] = array(
							'after'     => $firstday,
							'before'    => $lastday,
							'inclusive' => true,
						);

						break;
					case 'this_week':

						$firstday     = date( "Y-m-d", strtotime( 'monday this week' ) );
						$lastday      = date( "Y-m-d", strtotime( 'sunday this week' ) );
						$date_query[] = array(
							'after'     => $firstday,
							'before'    => $lastday,
							'inclusive' => true,
						);

						break;
					case 'to_day':

						$date_query[] = array(
							'after'     => date( 'Y-m-d' ),
							'inclusive' => true,
						);

						break;
				}
			}
		}

		return array_filter( apply_filters( 'wud_doc_query_date_query', $date_query, $this ) );
	}

	/**
	 * Get the main query which document queries ran against.
	 *
	 * @return array
	 */
	public function get_main_query() {
		return self::$document_query;
	}

	/**
	 * Get the tax query which was used by the main query.
	 *
	 * @return array
	 */
	public function get_main_tax_query() {
		$tax_query = isset( self::$document_query->tax_query, self::$document_query->tax_query->queries ) ? self::$document_query->tax_query->queries : array();

		return $tax_query;
	}

	/**
	 * Get the meta query which was used by the main query.
	 *
	 * @return array
	 */
	public function get_main_meta_query() {
		$args       = self::$document_query->query_vars;
		$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

		return $meta_query;
	}

}
