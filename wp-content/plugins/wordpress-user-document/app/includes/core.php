<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Model;
use Zufusion\Core\Classes\Form;

/**
 * Class WUD_Core
 */
class WUD_Core {

	/**
	 * Current instance of app
	 * @var null
	 */
	public $app = null;
	/**
	 * Store settings model
	 *
	 * @var bool|null
	 */
	public $settings = null;
	/**
	 * Constant custom post type
	 */
	const post_type = 'wud-doc';

	/**
	 * WUD_Core constructor.
	 *
	 * @param $app
	 */
	public function __construct( $app ) {

		$this->app       = $app;
		$this->app->form = new Form();
		$this->app->app_require_once( 'app/includes/classes/query.php' );
		$this->app->query = new WUD_Query();

		$GLOBALS['wud'] = $this->app;

		$settings_model = Model::get_admin_instance( 'settings', $app );
		$this->settings = $settings_model;

		$GLOBALS['wud_settings'] = $this->settings;

		$this->app->app_require_once( 'app/includes/functions.php' );
		$this->app->app_require_once( 'app/includes/classes/email.php' );

		add_action( 'init', array( $this, 'init' ) );
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		add_action( 'wp_ajax_nopriv_' . $this->app->plugin_name, array( $this, 'ajax_call' ) );
		add_action( 'wp_ajax_' . $this->app->plugin_name, array( $this, 'ajax_call' ) );

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_filter( 'rewrite_rules_array', array( $this, 'rewrite_rules' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
		add_action( 'parse_request', array( $this, 'redirect' ), 1, 1 );
		add_action( 'wp_loaded', array( $this, 'flush_rules' ) );
		if ( wud_is_admin() ) {
			register_activation_hook( $this->app->plugin_file, array( $this, 'install' ) );
			add_action( 'switch_theme', array( $this, 'switch_theme' ) );
		}

	}

	/**
	 * Clear rewrite rules cached when switching theme
	 *
	 * @param $new_theme
	 */
	public function switch_theme( $new_theme ) {
		flush_rewrite_rules();
	}

	/**
	 * Add query vars
	 *
	 * @param $vars
	 *
	 * @return array
	 */
	public function add_query_vars( $vars ) {

		$vars[] = 'zufusion';
		$vars[] = 'controller';
		$vars[] = 'task';
		$vars[] = 'doc_id';
		$vars[] = 'nonce';
		$vars[] = 'token';
		$vars[] = 'preview';

		return $vars;
	}

	/*
	 * Matched query if the query includes vars of the plugin
	 */
	public function redirect( $query ) {

		if ( ! empty( $query->query_vars['zufusion'] ) && ! empty( $query->query_vars['controller'] ) && ! empty( $query->query_vars['doc_id'] ) && ! empty( $query->query_vars['nonce'] ) && ! empty( $query->query_vars['token'] ) ) {
			wp_redirect( home_url( '/wp-admin/admin-ajax.php?' . $query->matched_query ), 301 );
			exit;
		}

	}

	/**
	 * only clear rewrite rules cached if the url is document
	 */
	public function flush_rules() {

		$is_template_plugin = $this->settings->get_input_value('template_type', 'plugin') == 'plugin' ? true : false;
		$documents_page_id = wud_get_page_id( 'documents' );
		$archive = $documents_page_id && get_post( $documents_page_id ) ? urldecode( get_page_uri( $documents_page_id ) ) : 'documents';

		$url_base = $this->settings->get_input_value( 'url_base', 'document' );
		$rules    = get_option( 'rewrite_rules' );

		if ( $is_template_plugin && current_theme_supports('document') ) {
			if ( ! isset( $rules[ '^'.$archive.'/page/?([0-9]{1,})/?$' ] ) ) {
				global $wp_rewrite;
				$wp_rewrite->flush_rules();
			}
		}

		if ( ! isset( $rules[ 'index.php/' . $url_base . '/file/([0-9]+)/(.*)&nonce=(.*)&token=(.*)' ] ) ) {
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
		}

		if ( ! isset( $rules[ 'index.php/' . $url_base . '/preview/(.*)/(.*)/([0-9]+)/(.*)' ] ) ) {
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
		}

		//flush rewrite query
		if (isset( $this->app->query )) {
			$count = count($this->app->query->get_query_vars());
			$check_rewrite_rules    = 'wud_doc_rewrite_rules_' . $count;
			$check_rewrite = (int) get_option( $check_rewrite_rules );

			if ( $check_rewrite == 0) {
				flush_rewrite_rules();
				update_option( $check_rewrite_rules, 1 );
			}
		}
		$this->flush_rewrite_rules();

	}

	/**
	 * Add rewrite rule for the link document
	 *
	 * @param $rules
	 *
	 * @return array
	 */
	public function rewrite_rules( $rules ) {

		$is_template_plugin = $this->settings->get_input_value('template_type', 'plugin') == 'plugin' ? true : false;
		$documents_page_id = wud_get_page_id( 'documents' );
		$archive = $documents_page_id && get_post( $documents_page_id ) ? urldecode( get_page_uri( $documents_page_id ) ) : 'documents';

		$url_base = $this->settings->get_input_value( 'url_base', 'document' );

		$rules2                                                                              = array();

		if ( $is_template_plugin && current_theme_supports('document') ) {
			$rules2['^'.$archive.'/page/?([0-9]{1,})/?$'] = 'index.php?pagename='.$archive.'&paged=$matches[1]';
		}

		$rules2[ 'index.php/' . $url_base . '/file/([0-9]+)/(.*)&nonce=(.*)&token=(.*)' ] = 'wp-admin/admin-ajax.php?zufusion=admin&action=wud&controller=doc&task=download&doc_id=$matches[1]&nonce=$matches[3]&token=$matches[4]';
		$rules2[ $url_base . '/file/([0-9]+)/(.*)&nonce=(.*)&token=(.*)' ]                = 'wp-admin/admin-ajax.php?zufusion=admin&action=wud&controller=doc&task=download&doc_id=$matches[1]&nonce=$matches[3]&token=$matches[4]';

		$rules2[ 'index.php/' . $url_base . '/preview/(.*)/(.*)/([0-9]+)/(.*)' ] = 'wp-admin/admin-ajax.php?zufusion=admin&action=wud&controller=doc&task=download&nonce=$matches[1]&token=$matches[2]&doc_id=$matches[3]&preview=1';
		$rules2[ $url_base . '/preview/(.*)/(.*)/([0-9]+)/(.*)' ]                = 'wp-admin/admin-ajax.php?zufusion=admin&action=wud&controller=doc&task=download&nonce=$matches[1]&token=$matches[2]&doc_id=$matches[3]&preview=1';

		return $rules2 + $rules;
	}


	/**
	 * register widgets function.
	 *
	 * @access public
	 * @return void
	 */
	public function register_widgets() {

		include_once( 'widgets/categories.php' );
		include_once( 'widgets/tags.php' );
		include_once( 'widgets/topviewed.php' );
		include_once( 'widgets/mostliked.php' );
		include_once( 'widgets/topdownload.php' );
		include_once( 'widgets/mostdiscussed.php' );
		include_once( 'widgets/statistics.php' );
		include_once( 'widgets/search.php' );
		include_once( 'widgets/documents.php' );

		register_widget( 'WUD_Categories_Widget' );
		register_widget( 'WUD_Tags_Widget' );
		register_widget( 'WUD_Topviewed_Widget' );
		register_widget( 'WUD_Mostliked_Widget' );
		register_widget( 'WUD_Topdownload_Widget' );
		register_widget( 'WUD_Mostdiscussed_Widget' );
		register_widget( 'WUD_Statistics_Widget' );
		register_widget( 'WUD_Search_Widget' );
		register_widget( 'WUD_Documents_Widget' );

		// Main Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Document sidebar', 'wud' ),
			'description'   => esc_html__( 'Main sidebar that appears on the left/right', 'wud' ),
			'id'            => 'document-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		) );

	}

	/**
	 * Call ajax
	 */
	function ajax_call() {
		$this->app->start();
	}

	/**
	 * Init
	 */
	public function init() {
		global $wud_settings;
		$is_template_plugin = $wud_settings->get_input_value('template_type', 'plugin') == 'plugin' ? true : false;

		if (apply_filters('wud_enable_theme_support', $is_template_plugin)) {
			add_theme_support( 'document' );
		}

		// If theme support changes, we may need to flush permalinks since some are changed based on this flag.
		$theme_support = current_theme_supports( 'document' ) ? 'yes' : 'no';
		if ( get_option( 'current_theme_supports_document' ) !== $theme_support && update_option( 'current_theme_supports_document', $theme_support ) ) {
			update_option( 'wud_maybe_flush_rewrite_rules', 'yes' );
		}

		register_post_type( self::post_type,
			array(
				'labels'              => array(
					'name'               => esc_html__( 'Manage Documents', 'wud' ),
					'singular_name'      => esc_html__( 'Document', 'wud' ),
					'add_new'            => esc_html__( 'Add New', 'wud' ),
					'add_new_item'       => esc_html__( 'Add New Document', 'wud' ),
					'edit_item'          => esc_html__( 'Edit Document', 'wud' ),
					'new_item'           => esc_html__( 'Add New Document', 'wud' ),
					'all_items'          => esc_html__( 'All Documents', 'wud' ),
					'view_item'          => esc_html__( 'View Document', 'wud' ),
					'search_items'       => esc_html__( 'Documents Search', 'wud' ),
					'not_found'          => esc_html__( 'No Documents Found', 'wud' ),
					'not_found_in_trash' => esc_html__( 'No Documents found in trash', 'wud' ),
					'menu_name'          => esc_html__( 'Manage Documents', 'wud' )
				),
				'public'              => true,
				'menu_icon'           => 'dashicons-feedback',
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'has_archive'         => false,  // it shouldn't have archive page
				'rewrite'             => $this->settings->get_input_value( 'url_base', 'document' ) ? array(
					'slug'       => $this->settings->get_input_value( 'url_base', 'document' ),
					'with_front' => false,
					'feeds'      => true,
				) : false,

				'query_var'    => true,
				'supports'     => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments' ),
				'show_in_rest' => false,
				'taxonomies'   => array( 'wud-category', 'wud-tag' ),
				'show_in_menu' => true,
				'map_meta_cap' => true,

				'capabilities' => array(
					'wud_license'        => 'manage_licenses',
					'wud_add_license'    => 'create_license',
					'wud_edit_license'   => 'edit_license',
					'wud_delete_license' => 'delete_license',
					'wud_settings'       => 'settings',
				),
			)
		);

		$labels = array(
			'name'                       => esc_html__( 'Document Categories', 'wud' ),
			'singular_name'              => esc_html__( 'Document Category', 'wud' ),
			'menu_name'                  => esc_html__( 'Categories', 'wud' ),
			'add_new_item'               => esc_html__( 'Add New Category', 'wud' ),
			'new_item_name'              => esc_html__( 'New Category Name', 'wud' ),
			'all_items'                  => esc_html__( 'All Categories', 'wud' ),
			'edit_item'                  => esc_html__( 'Edit Category', 'wud' ),
			'update_item'                => esc_html__( 'Update Category', 'wud' ),
			'parent_item'                => esc_html__( 'Parent Category', 'wud' ),
			'parent_item_colon'          => esc_html__( 'Parent Category:', 'wud' ),
			'search_items'               => esc_html__( 'Search Categories', 'wud' ),
			'popular_items'              => esc_html__( 'Popular Categories', 'wud' ),
			'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'wud' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'wud' )
		);

		$args = array(
			'public'            => true,
			'rewrite'           => $this->settings->get_input_value( 'category_base', 'document-category' ) ? array( 'slug' => $this->settings->get_input_value( 'category_base', 'document-category' ) ) : false,
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => false,
			'query_var'         => true,
			'show_in_rest'      => true,
		);

		register_taxonomy( 'wud-category', self::post_type, $args );

		$labels = array(
			'name'                       => _x( 'Document Tags', 'taxonomy general name', 'wud' ),
			'singular_name'              => _x( 'Document Tag', 'taxonomy singular name', 'wud' ),
			'search_items'               => esc_html__( 'Search Document Tags', 'wud' ),
			'popular_items'              => esc_html__( 'Popular Document Tags', 'wud' ),
			'all_items'                  => esc_html__( 'All Document Tags', 'wud' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Tag', 'wud' ),
			'update_item'                => esc_html__( 'Update Tag', 'wud' ),
			'add_new_item'               => esc_html__( 'Add New Tag', 'wud' ),
			'new_item_name'              => esc_html__( 'New Tag Name', 'wud' ),
			'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'wud' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove tags', 'wud' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used tags', 'wud' ),
			'not_found'                  => esc_html__( 'No tags found.', 'wud' ),
			'menu_name'                  => esc_html__( 'Tags', 'wud' ),
		);

		$args = array(
			'public'            => true,
			'rewrite'           => $this->settings->get_input_value( 'tag_base', 'document-tag' ) ? array( 'slug' => $this->settings->get_input_value( 'tag_base', 'document-tag' ) ) : false,
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => false,
			'query_var'         => true,
			'show_in_rest'      => true,
		);

		register_taxonomy( 'wud-tag', self::post_type, $args );

		// Register the wud-group taxonomy
		register_taxonomy( 'wud-group', self::post_type, array(
			'labels'       => array(
				'name'          => __( 'Associated Items', 'wud' ),
				'singular_name' => __( 'Associated Item', 'wud' )
			),
			'hierarchical' => false,
			'show_ui'      => false,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => 'item' ),
		) );

		// Register the access taxonomy
		register_taxonomy( 'wud-access', self::post_type, array(
			'public'       => false,
			'hierarchical' => false,
			'show_ui'      => false,
			'query_var'    => false,
		) );

		// Register the edit access taxonomy.
		register_taxonomy( 'wud-edit-access', self::post_type, array(
			'public'       => false,
			'hierarchical' => false,
			'show_ui'      => false,
			'query_var'    => false,
		) );

		// Register the comment access taxonomy.
		register_taxonomy( 'wud-comment-access', self::post_type, array(
			'public'       => false,
			'hierarchical' => false,
			'show_ui'      => false,
			'query_var'    => false,
		) );

		register_post_type( 'wud-license',
			array(
				'labels'          => array(
					'name'          => esc_html__( 'Manage Licenses', 'wud' ),
					'singular_name' => esc_html__( 'License', 'wud' )
				),
				'public'          => false,
				'has_archive'     => false,
				'show_in_menu'    => false,
				'capability_type' => 'wud-license',
				'map_meta_cap'    => false,
			)
		);
		$this->add_image_sizes();
	}

	/**
	 * Add default image size
	 */
	public function add_image_sizes() {
		$image_mode = $this->settings->get_input_value( 'image_mode', 'resize') == 'resize' ? false : true;
		add_image_size( 'document-widget', 60, 80, $image_mode ); // document widget
		add_image_size( 'document-thumbnail', 400, 300, $image_mode ); // document Thumbnail
		add_image_size( 'document-large', 1140, 710, $image_mode ); // document large
		add_image_size( 'document-xlarge', 1450, '', $image_mode );
	}

	/**
	 * Flush rules if the event is queued.
	 */
	public function flush_rewrite_rules() {
		if ( 'yes' === get_option( 'wud_maybe_flush_rewrite_rules' ) ) {
			update_option( 'wud_maybe_flush_rewrite_rules', 'no' );
			flush_rewrite_rules();
		}
	}


	/**
	 * Install hook
	 */
	public function install() {

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		// set default roles
		$roles = array( 'editor', 'administrator' );
		foreach ( $roles as $value ) {
			$role = get_role( $value );
			if ( $role ) {
				$role->add_cap( 'wud_license' );
				$role->add_cap( 'wud_add_license' );
				$role->add_cap( 'wud_edit_license' );
				$role->add_cap( 'wud_delete_license' );
				$role->add_cap( 'wud_settings' );
			}
		}

		$this->create_page();
	}

	/*
	 * Create pages for WordPress User Document
	 */
	public function create_page() {

		$check_page    = 'wud_doc_check_page';
		$check_page_id = (int) get_option( $check_page );

		if ( $check_page_id > 0 ) {
			return true;
		}
		// document page
		$page_data = array(
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'post_name'      => 'documents',
			'post_title'     => 'Documents',
			'post_content'   => '',
			'comment_status' => 'closed'
		);
		$page_id   = wp_insert_post( $page_data );
		if ( $page_id ) {
			$this->settings->set_input_value( 'doc_page_id', $page_id );
		}

		// my document page
		$page_data = array(
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'post_name'      => 'my-account',
			'post_title'     => 'My Account',
			'post_content'   => '[wud_my_account]',
			'comment_status' => 'closed'
		);

		$page_id = wp_insert_post( $page_data );
		if ( $page_id ) {
			$this->settings->set_input_value( 'my_account_page_id', $page_id );
		}

		update_option( $check_page, 1 );
	}


	/**
	 * Load Localisation files.
	 */
	public function load_textdomain() {

		$domain = 'wud';

		if ( $loaded = load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '.mo' ) ) {
			return $loaded;
		} else {
			load_plugin_textdomain( $domain, false, $this->app->plugin_slug . '/app/lang/' );
		}

	}

}