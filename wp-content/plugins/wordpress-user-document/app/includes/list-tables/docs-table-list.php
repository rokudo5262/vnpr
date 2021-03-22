<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Model;

class WUD_Docs_Table_List {
	/**
	 * Post type.
	 *
	 * @var string
	 */
	protected $list_table_type = 'wud-doc';

	public function __construct( $args = array() ) {
		global $typenow;

		if ( $this->list_table_type == $typenow ) {

			add_action( 'restrict_manage_posts', array( $this, 'restrict_manage_posts' ) );
			add_filter( 'query_vars', array( $this, 'add_custom_query_var' ) );
			add_filter( 'request', array( $this, 'request_query' ) );
			add_filter( 'manage_edit-' . $this->list_table_type . '_sortable_columns', array(
				$this,
				'define_sortable_columns'
			) );
			add_filter( 'manage_' . $this->list_table_type . '_posts_columns', array( $this, 'define_columns' ) );
			add_filter( 'bulk_actions-edit-' . $this->list_table_type, array( $this, 'define_bulk_actions' ) );
			add_action( 'manage_' . $this->list_table_type . '_posts_custom_column', array(
				$this,
				'render_columns'
			), 10, 2 );

		}

	}


	/**
	 * Query vars for custom searches.
	 *
	 * @param mixed $public_query_vars Array of query vars.
	 *
	 * @return array
	 */
	public function add_custom_query_var( $public_query_vars ) {
		$public_query_vars[] = 'doc_cat';
		$public_query_vars[] = 'doc_author_id';
		$public_query_vars[] = 'doc_approved_status';

		return $public_query_vars;
	}

	public function request_query( $query_vars ) {

		global $typenow;

		if ( $this->list_table_type === $typenow ) {
			return $this->query_filters( $query_vars );
		}

		return $query_vars;

	}

	/**
	 * Handle any custom filters.
	 *
	 * @param array $query_vars Query vars.
	 *
	 * @return array
	 */
	protected function query_filters( $query_vars ) {
		// Custom order by arguments.
		if ( isset( $query_vars['orderby'] ) ) {
			$orderby = strtolower( $query_vars['orderby'] );
			$order   = isset( $query_vars['order'] ) ? strtoupper( $query_vars['order'] ) : 'DESC';

			if ( 'views' === $orderby ) {
				$query_vars['meta_key'] = 'wud_doc_count';
				$query_vars['orderby']  = 'meta_value_num';
				$query_vars['order']  = $order;
			}
		}


		// Category filtering.
		if ( isset( $query_vars['doc_cat'] ) && $query_vars['doc_cat'] ) {

			$query_vars['tax_query'][] = array(
				'taxonomy'         => 'wud-category',
				'terms'            => (int) $query_vars['doc_cat'],
				'include_children' => false
			);

		}

		// Author filtering.
		if ( isset( $query_vars['doc_author_id'] ) && $query_vars['doc_author_id'] ) {
			$query_vars['author'] = $query_vars['doc_author_id'];
		}

		// Approved status filtering.
		if ( isset( $query_vars['doc_approved_status'] ) && $query_vars['doc_approved_status'] != '' ) {

			$query_vars['meta_query'][] = array(
				'key'   => 'wud_doc_approved',
				'value' => $query_vars['doc_approved_status'],
			);

		}


		return $query_vars;
	}

	/**
	 * Define which columns are sortable.
	 *
	 * @param array $columns Existing columns.
	 *
	 * @return array
	 */
	public function define_sortable_columns( $columns ) {
		$custom = array(
			'views' => 'views',
		);

		return wp_parse_args( $custom, $columns );
	}


	/**
	 * See if we should render search filters or not.
	 */
	public function restrict_manage_posts() {
		$this->render_filters();
	}

	/**
	 * Render any custom filters and search inputs for the list table.
	 */
	protected function render_filters() {
		$filters = apply_filters(
			'wud_docs_admin_list_table_filters',
			array(
				'doc_category' => array( $this, 'render_docs_category_filter' ),
				'doc_author'   => array( $this, 'render_docs_author_filter' ),
				'doc_status'   => array( $this, 'render_docs_approved_status_filter' ),
			)
		);

		ob_start();
		foreach ( $filters as $filter_callback ) {
			call_user_func( $filter_callback );
		}
		$output = ob_get_clean();

		echo apply_filters( 'wud_doc_filters', $output );
	}

	/**
	 * Render the document category filter for the list table.
	 *
	 */
	protected function render_docs_category_filter() {
		global $typenow;
		$current_category = isset( $_GET['doc_cat'] ) ? absint( $_GET['doc_cat'] ) : false;

		if ( $this->list_table_type === $typenow ) {
			$dropdown_options = array(
				'name'            => 'doc_cat',
				'show_option_all' => esc_attr__( 'Select a category', 'wud' ),
				'hide_empty'      => 0,
				'hierarchical'    => 1,
				'show_count'      => 0,
				'orderby'         => 'name',
				'selected'        => $current_category,
				'taxonomy'        => 'wud-category',
			);

			wp_dropdown_categories( $dropdown_options );
		}
	}

	/**
	 * Render the category category filter for the list table.
	 *
	 */
	protected function render_docs_author_filter() {
		wp_dropdown_users( array(
			'show_option_all' => esc_attr__( 'Filter by author', 'wud' ),
			'name'            => 'doc_author_id',
			'selected'        => isset( $_GET['doc_author_id'] ) ? absint( $_GET['doc_author_id'] ) : false
		) );
	}

	/**
	 * Render the doc status filter for the list table.
	 *
	 */
	protected function render_docs_approved_status_filter() {
		$current_status = isset( $_REQUEST['doc_approved_status'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['doc_approved_status'] ) ): false;
		$statuses       = array(
			1 => esc_attr__( 'Approved', 'wud' ),
			0 => esc_attr__( 'UnApproved', 'wud' ),
		);
		$output         = '<select name="doc_approved_status"><option value="">' . esc_attr__( 'Filter by approved status', 'wud' ) . '</option>';

		foreach ( $statuses as $status => $label ) {
			$output .= '<option ' . selected( $status, $current_status, false ) . ' value="' . esc_attr( $status ) . '">' . esc_html( $label ) . '</option>';
		}

		$output .= '</select>';
		echo wp_kses( $output, array(
			'select' => array(
				'name' => true,
			),
			'option' => array(
				'value' => true,
				'selected' => true,
			),
		));
	}

	/**
	 * @return array
	 */
	protected function get_bulk_actions() {
		$actions       = array();
		$post_type_obj = get_post_type_object( $this->screen->post_type );

		if ( current_user_can( $post_type_obj->cap->edit_posts ) ) {
			if ( $this->is_trash ) {
				$actions['untrash'] = esc_attr__( 'Restore' );
			} else {
				$actions['edit'] = esc_attr__( 'Edit' );
			}
		}

		if ( current_user_can( $post_type_obj->cap->delete_posts ) ) {
			if ( $this->is_trash || ! EMPTY_TRASH_DAYS ) {
				$actions['delete'] = esc_attr__( 'Delete Permanently' );
			} else {
				$actions['trash'] = esc_attr__( 'Move to Trash' );
			}
		}

		return $actions;
	}

	/**
	 * Define bulk actions.
	 *
	 * @param array $actions Existing actions.
	 *
	 * @return array
	 */
	public function define_bulk_actions( $actions ) {

		unset( $actions['edit'] );

		return $actions;
	}

	/**
	 * Define which columns to show on this screen.
	 *
	 * @param array $columns Existing columns.
	 *
	 * @return array
	 */
	public function define_columns( $columns ) {
		if ( empty( $columns ) && ! is_array( $columns ) ) {
			$columns = array();
		}
		$comments = $columns['comments'];
		$date     = $columns['date'];
		unset( $columns['comments'], $columns['date'] );

		$show_columns                   = array();
		$show_columns['views']          = '<span class="approved">' . esc_attr__( 'Views', 'wud' ) . '</span>';
		$show_columns['approved']       = '<span class="approved">' . esc_attr__( 'Approved', 'wud' ) . '</span>';
		$show_columns['featured']       = '<span class="wud-featured">' . esc_attr__( 'Featured', 'wud' ) . '</span>';
		$show_columns['allow_download'] = '<span class="wud-allow-download">' . esc_attr__( 'Allow download', 'wud' ) . '</span>';
		$show_columns['comments']       = $comments;
		$show_columns['date']           = $date;

		return array_merge( $columns, $show_columns );
	}

	/**
	 * Render individual columns.
	 *
	 * @param string $column Column ID to render.
	 * @param int $post_id Post ID being shown.
	 */
	public function render_columns( $column, $post_id ) {
		global $wud;

		$doc_model    = Model::get_admin_instance( 'doc', $wud );
		$this->object = $doc_model->get_doc( $post_id );
		if ( is_callable( array( $this, 'render_' . $column . '_column' ) ) ) {
			$this->{"render_{$column}_column"}();
		}
	}

	/**
	 * Render columm: Approved.
	 */
	protected function render_approved_column() {
		global $wud;
		$url = wp_nonce_url( $wud->get_admin_ajax_url() . '&controller=doc&task=approved&doc_id=' . $this->object['ID'], 'wud-approved-doc' );
		echo '<a href="' . esc_url( $url ) . '" aria-label="' . esc_attr__( 'Toggle approved', 'wud' ) . '">';
		if ( $this->object['approved'] == 1 ) {
			echo '<span class="wud-switch dashicons dashicons-yes" title="' . esc_attr__( 'Yes', 'wud' ) . '"></span>';
		} else {
			echo '<span class="wud-switch dashicons dashicons-no" title="' . esc_attr__( 'No', 'wud' ) . '"></span>';
		}
		echo '</a>';
	}

	/**
	 * Render columm: featured.
	 */
	protected function render_featured_column() {
		global $wud;

		$url = wp_nonce_url( $wud->get_admin_ajax_url() . '&controller=doc&task=featured&doc_id=' . $this->object['ID'], 'wud-feature-doc' );
		echo '<a href="' . esc_url( $url ) . '" aria-label="' . esc_attr__( 'Toggle featured', 'wud' ) . '">';
		if ( $this->object['featured'] == 1 ) {
			echo '<span class="wud-switch dashicons dashicons-star-filled" title="' . esc_attr__( 'Yes', 'wud' ) . '"></span>';
		} else {
			echo '<span class="wud-switch dashicons dashicons-star-empty" title="' . esc_attr__( 'No', 'wud' ) . '"></span>';
		}
		echo '</a>';
	}

	/**
	 * Render columm: featured.
	 */
	protected function render_views_column() {
		global $wud;
		echo '<span class="">' . wud_format_count( $this->object['count'] ) . '</span>';
	}

	/**
	 * Render columm: allow download.
	 */
	protected function render_allow_download_column() {
		global $wud;
		$url = wp_nonce_url( $wud->get_admin_ajax_url() . '&controller=doc&task=allowdownload&doc_id=' . $this->object['ID'], 'wud-allow-download-doc' );
		echo '<a href="' . esc_url( $url ) . '" aria-label="' . esc_attr__( 'Toggle allow download', 'wud' ) . '">';
		if ( $this->object['allow_download'] == 1 ) {
			echo '<span class="wud-switch dashicons dashicons-unlock" title="' . esc_attr__( 'Yes', 'wud' ) . '"></span>';
		} else {
			echo '<span class="wud-switch dashicons dashicons-lock" title="' . esc_attr__( 'No', 'wud' ) . '"></span>';
		}
		echo '</a>';
	}


}
