<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\View;

/**
 * Class WUD_Site_Start
 */
class WUD_Site_Start {
	/**
     * Current app
     *
	 * @var null
	 */
	public $app = null;

	/**
     * View object of current app
     *
	 * @var View|null
	 */
	public $view = null;

	/**
	 * WUD_Site_Start constructor.
	 *
	 * @param $app
	 */
	public function __construct( $app ) {
	    global $wud_settings;

		$this->app  = $app;
		$this->view = new View( $app );

		// Shortcodes
		$this->app->app_require_once( 'app/includes/shortcodes/my-account.php' );
		$this->app->app_require_once( 'app/includes/shortcodes/documents.php' );


		// Main

		$this->app->app_require_once( 'app/includes/hooks.php' );
		$this->app->app_require_once( 'app/includes/classes/handler.php' );
		$this->app->app_require_once( 'app/includes/classes/shortcode.php' );
		$this->app->app_require_once( 'app/includes/classes/shortcodes.php' );
		$this->app->app_require_once( 'app/includes/classes/template.php' );

		add_filter( 'sidebars_widgets', array( $this, 'sidebars_widgets' ) , 12, 1);
		add_filter( 'wp_nav_menu_objects', array( $this, 'current_menus' ) , 14, 2);

		$template_type = $wud_settings->get_input_value('template_type', 'plugin');
		add_filter( 'post_type_archive_title', array( $this, 'archive_title' ), 14, 2 );
		if ($template_type == 'plugin') {
			add_filter( 'document_title_parts', array( $this, 'wp_title_filter' ) );
		}

		// Acripts
		add_action( 'wp_enqueue_scripts', array( $this, 'assets' ), 100 );
		add_action( 'wp_footer', array( $this, 'footer_template' ), 120 );
	}

	/**
	 * Archive title page for feedback
	 * @param $title
	 *
	 * @return mixed
	 */
	public function archive_title( $label, $name) {
		$queried_object = get_queried_object();
		if (current_theme_supports( 'document' ) && $queried_object !=null && is_page(wud_get_page_id('documents'))) {
			$label = '';
		} elseif (wud_is_document_category()) {
			$label = esc_html__('Category', 'wud');
		}
		return $label;
	}

	/**
	 * Document title page for document
	 * @param $title
	 *
	 * @return mixed
	 */
	public function wp_title_filter( $title) {

		if (wud_is_document() || wud_is_search()) {
			$title['title'] = wud_page_title(false);
		}
		return $title;
	}

	/**
	 * Current menu document page
	 * @param $menus
	 * @param $args
	 *
	 * @return mixed
	 */
	public function current_menus($menus, $args) {

		$doc_page_id = wud_get_page_id('documents');
		if  ( is_page($doc_page_id) || wud_is_single_document()) {
			if (!empty($menus)) {
				foreach ( $menus as $key => $item ) {
					if ($item->object_id == $doc_page_id) {
						$item->classes[] = 'current-menu-item';
						$item->classes[] = 'current_page_item';
						$item->current = true;
						break;
					}
				}
			}
		}
		return $menus;
	}

	/**
	 * Replace default widget of theme
	 * @param $widgets
	 *
	 * @return mixed
	 */
	public function sidebars_widgets( $widgets ) {
		global $wud_settings;
		$template_type = $wud_settings->get_input_value('template_type', 'plugin');
		$overwrite_sidebar = $wud_settings->get_input_value('overwrite_sidebar', '');

		if ($template_type == 'theme' && isset($widgets[$overwrite_sidebar]) && wud_is_document() ) {
			if (isset($widgets['document-sidebar'])) {
				$widgets[$overwrite_sidebar] = $widgets['document-sidebar'];
			}
		}

		return $widgets;
	}

	/**
	 * Load scripts
	 */
	public function assets() {

		global $wud, $wud_settings, $post;

		if ( wud_is_document() || is_page( wud_get_page_id( 'my-account' ) ) || ( ! empty( $post ) && ( has_shortcode( $post->post_content, 'wud_my_account' ) || has_shortcode( $post->post_content, 'wud_documents' ) )) || wud_is_author_document() ) {
			$enable_font = apply_filters( 'wud_load_font_awesome', $wud_settings->get_input_value( 'load_fontawesome', 'yes' ), $wud, $wud_settings );
			$enable_grid = apply_filters( 'wud_load_grid', $wud_settings->get_input_value( 'load_bootstrap_grid', 'yes' ), $wud, $wud_settings );

			if ( $enable_font === 'yes' ) {
				wp_enqueue_style( 'fontawesome', ZUFUSION_MU_PLUGIN_VENDOR_URL . 'fortawesome/font-awesome/css/all.min.css', array(), null );
			}
			if ( $enable_grid === 'yes' ) {
				wp_enqueue_style( 'bootstrap-grid', ZUFUSION_MU_PLUGIN_VENDOR_URL . 'twbs/bootstrap/dist/css/bootstrap-grid.min.css', array(), null );
			}

			wp_enqueue_script( 'thickbox' );
			wp_enqueue_style( 'thickbox' );

			wp_enqueue_script( 'wud-table', ZUFUSION_MU_PLUGIN_URL . 'core/assets/js/table.min.js', array( 'jquery' ), null );

			wp_enqueue_style( 'amsify-suggestags', $this->app->plugin_url . 'vendor/assets/tags/amsify.suggestags.css', array(), null );
			wp_enqueue_script( 'amsify-suggestags', $this->app->plugin_url . 'vendor/assets/tags/jquery.amsify.suggestags.min.js', array( 'jquery' ), null, true );
			wp_enqueue_style( 'select2', $this->app->plugin_url . 'vendor/assets/select2/css/select2.min.css', array(), null );
			wp_enqueue_script( 'select2', $this->app->plugin_url . 'vendor/assets/select2/js/select2.min.js', array( 'jquery' ), null, true );

			wp_enqueue_script( 'parsley', $this->app->plugin_url . 'vendor/assets/parsley/parsley.min.js', array( 'jquery' ), null, true );

			wp_enqueue_style( 'wud-site', $this->app->plugin_url . 'app/site/assets/css/site.css', array(), null );
			wp_enqueue_script( 'wud-site', $this->app->plugin_url . 'app/site/assets/js/site.min.js', array(
				'jquery',
				'jquery-ui-autocomplete'
			), null, true );
			$tags = wud_get_document_tags();

			wp_localize_script( 'wud-site', 'wud_vars', array(
				'ajaxurl'   => esc_url( $this->app->get_ajax_url() ),
				'admin_ajaxurl'   => esc_url( $this->app->get_admin_ajax_url() ),
				'like'      => esc_html__( 'Like', 'wud' ),
				'unlike'    => esc_html__( 'Unlike', 'wud' ),
				'tags'      => json_encode( $tags ),
				'translate' => array(
					'delete_document'    => esc_html__( 'Are you sure to delete selected documents', 'wud' ),
					'are_you_sure'    => esc_html__( 'Are you sure', 'wud' ),
					'incorrect_response' => esc_html__( 'Incorrect response', 'wud' ),
					'max_file_size'      => esc_html__( 'This file should not be larger than %s MB', 'wud' ),
					'fileextension'      => esc_html__( 'The extension doesn\'t match the required', 'wud' ),
					'sending'            => esc_html__( 'Sending', 'wud' )
				)
			) );
		}
	}

	/**
	 * Load footer
	 */
	public function footer_template() {
        ?>
        <div id="wud-overlay-loading" class="wud-overlay-loading" style="display: none">
            <div class="wud-spinner"></div>
            <p class="wud-process-text"><?php echo esc_html__('Processing, please wait…', 'wud');?></p>
        </div>
        <?php
	}

}