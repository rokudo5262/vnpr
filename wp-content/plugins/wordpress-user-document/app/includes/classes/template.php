<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Template loader
 * Class WUD_Template_Loader
 */
class WUD_Template_Loader {

	static $doc_page_id = 0;
	static $theme_support = false;
	static $in_content_filter = false;

	/**
	 * Hook in methods.
	 */
	public static function init() {
		self::$theme_support = current_theme_supports( 'document' );
		self::$doc_page_id   = wud_get_page_id( 'documents' );

		// Supported themes.
		if ( self::$theme_support ) {
			add_filter( 'template_include', array( __CLASS__, 'template_loader' ) );
		} else {
			// Unsupported themes.
			add_action( 'template_redirect', array( __CLASS__, 'unsupported_theme_init' ) );
		}
	}

	/**
	 * Unsupported theme compatibility methods.
	 */

	/**
	 * Hook in methods to enhance the unsupported theme experience on pages.
	 */
	public static function unsupported_theme_init() {
		if ( wud_is_document_taxonomy() || wud_is_author_document() ) {
			self::unsupported_theme_tax_archive_init();
		} elseif ( wud_is_single_document() ) {
			self::unsupported_theme_single_document_page_init();
		} else {
			if ( is_page( self::$doc_page_id ) ) {
				self::unsupported_theme_document_page_init();
			}
		}
	}

	/**
	 * Load a template.
	 *
	 * Handles template usage so that we can use our own templates instead of the theme's.
	 *
	 * Templates are in the 'templates' folder. WordPress User Document looks for theme
	 * overrides in /theme/wordpress-user-document/ by default.
	 *
	 * @param string $template Template to load.
	 *
	 * @return string
	 */
	public static function template_loader( $template ) {
		if ( is_embed() ) {
			return $template;
		}

		$default_file = self::get_template_loader_default_file();

		if ( $default_file ) {
			/**
			 * Filter hook to choose which files to find before WordPress User Document does it's own logic.
			 * @var array
			 */
			$search_files = self::get_template_loader_files( $default_file );
			$template     = locate_template( $search_files );
			if ( ! $template ) {
				$template = wud_app()->plugin_path . 'app/templates/' . $default_file;
			}
		}

		return $template;
	}

	/**
	 * Get the default filename for a template.
	 * @return string
	 */
	private static function get_template_loader_default_file() {
		if ( is_singular( 'wud-doc' ) ) {
			$default_file = 'single-wud-doc.php';
		} elseif ( wud_is_author_document() ) {
			$default_file = 'author-wud-doc.php';
		} elseif ( wud_is_document_taxonomy() ) {
			$object = get_queried_object();
			if ( is_tax( 'wud-category' ) || is_tax( 'wud-tag' ) ) {
				$default_file = 'taxonomy-' . $object->taxonomy . '.php';
			} else {
				$default_file = 'archive-wud-doc.php';
			}
		} elseif ( is_post_type_archive( 'wud-doc' ) || is_page( wud_get_page_id( 'documents' ) ) ) {
			$default_file = self::$theme_support ? 'archive-wud-doc.php' : '';
		} else {
			$default_file = '';
		}

		return $default_file;
	}

	/**
	 * Get an array of filenames to search for a given template.
	 *
	 * @param string $default_file The default file name.
	 *
	 * @return string[]
	 */
	private static function get_template_loader_files( $default_file ) {
		$templates = array();

		if ( is_page_template() ) {
			$templates[] = get_page_template_slug();
		}

		if ( is_singular( 'wud-doc' ) ) {
			$object       = get_queried_object();
			$name_decoded = urldecode( $object->post_name );
			if ( $name_decoded !== $object->post_name ) {
				$templates[] = "single-wud-doc-{$name_decoded}.php";
			}
			$templates[] = "single-wud-doc-{$object->post_name}.php";
		}

		if ( wud_is_document_taxonomy() ) {
			$object      = get_queried_object();
			$templates[] = 'taxonomy-' . $object->taxonomy . '-' . $object->slug . '.php';
			$templates[] = wud_app()->plugin_path . 'app/templates/taxonomy-' . $object->taxonomy . '-' . $object->slug . '.php';
			$templates[] = 'taxonomy-' . $object->taxonomy . '.php';
			$templates[] = wud_app()->plugin_path . 'app/templates/taxonomy-' . $object->taxonomy . '.php';
		}

		$templates[] = $default_file;
		$templates[] = wud_app()->plugin_path . 'app/templates/' . $default_file;

		return array_unique( $templates );
	}

	/**
	 * Hook in methods to enhance the unsupported theme experience on the Shop page.
	 */
	private static function unsupported_theme_document_page_init() {
		add_filter( 'the_content', array( __CLASS__, 'unsupported_theme_document_content_filter' ), 10 );
		add_filter( 'the_title', array( __CLASS__, 'unsupported_theme_title_filter' ), 10, 2 );
		add_filter( 'comments_number', array( __CLASS__, 'unsupported_theme_comments_number_filter' ) );
	}

	/**
	 * Hook in methods to enhance the unsupported theme experience on Document pages.
	 */
	private static function unsupported_theme_single_document_page_init() {
		add_filter( 'post_thumbnail_html', array( __CLASS__, 'unsupported_theme_single_featured_image_filter' ));
		add_filter( 'the_content', array( __CLASS__, 'unsupported_theme_single_document_content_filter' ) );
	}

	/**
	 * Prevent the main featured image on document pages because there will be another featured image
	 * in the gallery.
	 * @param string $html Img element HTML.
	 * @return string
	 */
	public static function unsupported_theme_single_featured_image_filter( $html ) {

		if ( ! is_main_query() || ! in_the_loop() ) {
			return $html;
		}

		global $show_thumbnail;
		if ($show_thumbnail) {
			return $html;
		}

		return '';
	}

	/**
	 * Filter the content and insert WordPress User Document content on the document page.
	 *
	 * For non themes, this will setup the main document page to be shortcode based to improve default appearance.
	 *
	 * @param string $content Existing post content.
	 *
	 * @return string
	 */
	public static function unsupported_theme_single_document_content_filter( $content ) {

		if ( self::$theme_support || ! is_main_query() || ! in_the_loop() ) {
			return $content;
		}

		self::$in_content_filter = true;

		// Remove the filter we're in to avoid nested calls.
		remove_filter( 'the_content', array( __CLASS__, 'unsupported_theme_single_document_content_filter' ) );
		ob_start();
		$disable_comment = true;
		include wud_get_template( 'single/single',  false, false);
		$content = ob_get_clean();
		self::$in_content_filter = false;

		return $content;
	}

	/**
	 * Filter the content and insert WordPress User Document content on the document page.
	 *
	 * For non-WC themes, this will setup the main document page to be shortcode based to improve default appearance.
	 *
	 * @param string $content Existing post content.
	 *
	 * @return string
	 */
	public static function unsupported_theme_document_content_filter( $content ) {
		global $wp_query, $wud_settings;

		if ( self::$theme_support || ! is_main_query() || ! in_the_loop() ) {
			return $content;
		}

		self::$in_content_filter = true;

		// Remove the filter we're in to avoid nested calls.
		remove_filter( 'the_content', array( __CLASS__, 'unsupported_theme_document_content_filter' ) );

		// Unsupported theme document page.
		if ( is_page( self::$doc_page_id ) && !has_shortcode( $content, 'wud_documents' ) ) {
			$args      = self::get_current_doc_view_args();
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
						'list_type'    => $wud_settings->get_input_value( 'list_type', 'list' ),
					)
				),
				'documents' );

			// Allow queries to run e.g.
			add_action( 'pre_get_posts', array( wud_app()->query, 'document_query' ) );

			$content = $content . $shortcode->get_content();

			// Remove actions and self to avoid nested calls.
			remove_action( 'pre_get_posts', array( wud_app()->query, 'document_query' ) );
			wud_app()->query->remove_document_query();
		}

		self::$in_content_filter = false;

		return $content;
	}


	/**
	 * Enhance the unsupported theme experience on Document Category and Attribute pages by rendering
	 * those pages using the single template and shortcode-based content. To do this we make a dummy
	 * post and set a shortcode as the post content. This approach is adapted from bbPress.
	 *
	 */
	private static function unsupported_theme_tax_archive_init() {
		global $wp_query, $post;
		$queried_object = get_queried_object();
		$args           = self::get_current_doc_view_args();
		$shortcode_args = array(
			'page'     => $args->page,
			'columns'  => $args->columns,
			'rows'     => $args->rows,
			'orderby'  => '',
			'order'    => '',
			'paginate' => true,
			'cache'    => false,
		);
		$post_title = '';
		if ( wud_is_document_category() ) {
			$shortcode_args['category'] = sanitize_title( $queried_object->slug );
		} elseif (wud_is_author_document()) {
			$shortcode_args['author'] = sanitize_title( $queried_object->ID );
		} else {
			// Default theme archive for all other taxonomies.
			return;
		}

		// Description handling.
		if ( ! empty( $queried_object->description ) && ( empty( $_GET['document-page'] ) || 1 === absint( $_GET['document-page'] ) ) ) {
			$prefix = '<div class="term-description">' . do_shortcode( $queried_object->description ) . '</div>';
		} else {
			$prefix = '';
		}

		$shortcode = new WUD_Shortcode_Documents(
			array_merge(
				array(
					'page'     => $args->page,
					'columns'  => $args->columns,
					'rows'     => $args->rows,
					'orderby'  => '',
					'order'    => '',
					'paginate' => true,
					'cache'    => false,
				), $shortcode_args
			),
			'documents' );

		$documents_page = get_post( self::$doc_page_id );

		$dummy_post_properties = array(
			'ID'                    => 0 ,
			'post_status'           => 'publish',
			'post_author'           => $documents_page->post_author,
			'post_parent'           => 0,
			'post_type'             => 'page',
			'post_date'             => $documents_page->post_date,
			'post_date_gmt'         => $documents_page->post_date_gmt,
			'post_modified'         => $documents_page->post_modified,
			'post_modified_gmt'     => $documents_page->post_modified_gmt,
			'post_content'          => $prefix . $shortcode->get_content(),
			'post_title'            => wud_page_title(false),
			'post_excerpt'          => '',
			'post_content_filtered' => '',
			'post_mime_type'        => '',
			'post_password'         => '',
			'post_name'             => $queried_object->slug,
			'guid'                  => '',
			'menu_order'            => 0,
			'pinged'                => '',
			'to_ping'               => '',
			'ping_status'           => '',
			'comment_status'        => 'closed',
			'comment_count'         => 0,
			'filter'                => 'raw',
		);

		// Set the $post global.
		$post = new WP_Post( (object) $dummy_post_properties ); // @codingStandardsIgnoreLine.

		// Copy the new post global into the main $wp_query.
		$wp_query->post  = $post;
		$wp_query->posts = array( $post );

		// Prevent comments form from appearing.
		$wp_query->post_count    = 1;
		$wp_query->is_404        = false;
		$wp_query->is_page       = false;
		$wp_query->is_single     = true;
		$wp_query->is_archive    = true;
		if (wud_is_author_document()) {
			$wp_query->is_author    = true;
		} else {
			$wp_query->is_tax        = true;
		}
		$wp_query->max_num_pages = 0;

		// Prepare everything for rendering.
		setup_postdata( $post );
		remove_all_filters( 'the_content' );
		remove_all_filters( 'the_excerpt' );
		add_filter( 'template_include', array( __CLASS__, 'force_single_template_filter' ) );
	}

	/**
	 * Filter the title and insert WordPress User Document content on the document page.
	 *
	 * For non themes, this will setup the main document page to be shortcode based to improve default appearance.
	 *
	 * @param string $title Existing title.
	 * @param int $id ID of the post being filtered.
	 *
	 * @return string
	 */
	public static function unsupported_theme_title_filter( $title, $id ) {
		if ( self::$theme_support || ! $id !== self::$doc_page_id ) {
			return $title;
		}

		if ( wud_is_search() ) {
			$title = sprintf( esc_html__( 'Search results: &ldquo;%s&rdquo;', 'wud' ), wud_get_search_query() );
		}

		if ( is_page( self::$doc_page_id ) || ( is_home() && 'page' === get_option( 'show_on_front' ) && absint( get_option( 'page_on_front' ) ) === self::$doc_page_id ) ) {
			$args         = self::get_current_doc_view_args();
			$title_suffix = array();

			if ( $args->page > 1 ) {
				/* translators: %d: Page number. */
				$title_suffix[] = sprintf( esc_html__( 'Page %d', 'wud' ), $args->page );
			}

			if ( $title_suffix ) {
				$title = $title . ' &ndash; ' . implode( ', ', $title_suffix );
			}
		}

		return $title;
	}

	/**
	 * Force the loading of one of the single templates instead of whatever template was about to be loaded.
	 *
	 * @param string $template Path to template.
	 * @return string
	 */
	public static function force_single_template_filter( $template ) {
		$default = self::get_template_loader_default_file();
		$template     = locate_template( $default );
		if ( ! $template ) {
			$slug = self::$doc_page_id && get_post( self::$doc_page_id ) ? urldecode( get_page_uri( self::$doc_page_id ) ) : 'documents';

			$possible_templates = array(
				'page-' . $slug.'.php',
				'page.php',
				'single.php',
				'index.php',
			);

			$template = locate_template( $possible_templates );
		}

		return $template;
	}

	/**
	 * Get information about the current document page view.
	 *
	 * @return array
	 */
	private static function get_current_doc_view_args() {
		return (object) array(
			'page'    => absint( max( 1, absint( get_query_var( 'paged' ) ) ) ),
			'columns' => wud_get_default_documents_per_row(),
			'rows'    => wud_get_default_documents_rows_per_page(),
		);
	}


	/**
	 * Suppress the comments number on the documents page for unsupported themes since there is no commenting on the documents page.
	 *
	 * @param string $comments_number The comments number text.
	 *
	 * @return string
	 */
	public static function unsupported_theme_comments_number_filter( $comments_number ) {
		if ( is_page( self::$doc_page_id ) ) {
			return '';
		}

		return $comments_number;
	}

}

add_action( 'init', array( 'WUD_Template_Loader', 'init' ) );