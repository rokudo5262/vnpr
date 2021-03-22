<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Model;

/**
 * Check the viewing page in admin
 * @return bool
 */
function wud_is_admin() {

	global $wud;

	if ( $wud->get_site_type() === 'admin' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Return site type
 * @return mixed
 */
function wud_get_site_type() {

	global $wud;

	return $wud->get_site_type();

}


/**
 * Get alert
 *
 * @param array $args
 *
 * @return array
 */
function wud_getalert( $args = array() ) {

	$default = array(
		'type'      => 'error',
		'alertHead' => '',
		'alertBody' => '',
		'alertIcon' => 'exclamation-circle',
		'role'      => 'alert',
		'live'      => 'assertive',
		'delay'     => 6000,
		'autoHide'  => true,
	);
	$args    = wp_parse_args( $args, $default );

	return $args;
}

/**
 * Get folder path
 *
 * @param $folder_id
 *
 * @return string
 */
function wud_get_upload_folder( $folder_id ) {

	$upload_dir = wp_upload_dir();
	if ( $folder_id == 0 ) {
		$folder_dir = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'wordpress-user-document' . DIRECTORY_SEPARATOR;
	} else {
		$folder_dir = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'wordpress-user-document' . DIRECTORY_SEPARATOR . $folder_id . DIRECTORY_SEPARATOR;
	}

	if ( ! file_exists( $folder_dir ) ) {
		mkdir( $folder_dir, 0777, true );
		$data = '<html><body bgcolor="#FFFFFF"></body></html>';
		$file = fopen( $folder_dir . 'index.html', 'w' );
		fwrite( $file, $data );
		fclose( $file );
		$data = 'deny from all';
		$file = fopen( $folder_dir . '.htaccess', 'w' );
		fwrite( $file, $data );
		fclose( $file );
	}

	return $folder_dir;
}


/**
 * Get folder url
 *
 * @param $folder_id
 *
 * @return string
 */
function wud_get_upload_folder_url( $folder_id ) {

	$upload_dir = wp_upload_dir();
	if ( $folder_id == 0 ) {
		$folder_url = $upload_dir['baseurl'] . '/wordpress-user-document/';
	} else {
		$folder_url = $upload_dir['baseurl'] . '/wordpress-user-document/' . $folder_id . '/';
	}

	return $folder_url;
}

/**
 * Sort array by property
 *
 * @param a $items array of object
 * @param $key
 * @param $property
 * @param bool|false $reverse
 *
 * @return array sorted items
 */
function wud_sort_array( $items, $key = '', $property, $reverse = false ) {

	$sorted    = array();
	$items_old = $items;
	foreach ( $items as $item ) {
		$sorted[ $item->$key ]    = $item->$property;
		$items_old[ $item->$key ] = $item;
	}

	if ( $reverse ) {
		arsort( $sorted );
	} else {
		asort( $sorted );
	}

	$rows = array();

	foreach ( $sorted as $i => $value ) {
		$rows[] = $items_old[ $i ];
	}

	return $rows;

}

/**
 * Get caps of wud-doc post type
 *
 * @return array
 */
function wud_get_caps() {

	$post_type   = get_post_type_object( 'wud-doc' );
	$permissions = $post_type->cap;
	$caps        = (array) $permissions;

	foreach ( $caps as $key => $val ) {
		$caps[ $key ] = str_replace( 'post', 'document', $val );
	}

	return $caps;
}


/**
 * Get template part
 *
 * @param mixed $slug Template slug.
 * @param string $name Template name (default: '').
 */
function wud_get_template_part( $slug, $name = '' ) {
	$cache_key = sanitize_key( implode( '-', array( 'wud-template-part', $slug, $name ) ) );
	$template  = (string) wp_cache_get( $cache_key, 'wud-template-part' );

	if ( ! $template ) {
		if ( $name ) {
			$template = locate_template(
				array(
					"{$slug}-{$name}.php",
					wud_template_path() . "{$slug}-{$name}.php",
				)
			);

			if ( ! $template ) {
				$fallback = wud_app()->plugin_path . "app/templates/{$slug}-{$name}.php";
				$template = file_exists( $fallback ) ? $fallback : '';
			}
		}

		if ( ! $template ) {
			// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/wordpress-user-document/slug.php.
			$template = locate_template(
				array(
					"{$slug}.php",
					wud_template_path() . "{$slug}.php",
				)
			);

		}

		wp_cache_set( $cache_key, $template, 'wud-template-part' );
	}

	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'wud_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}

/**
 * get template folder of plugin
 * @return mixed|void
 */
function wud_template_path() {
	return apply_filters( 'wud_template_path', 'wordpress-user-document/' );
}

/**
 * Get a template
 */

function wud_get_template( $template, $load = true, $require_once = true ) {

	global $wud;
	// Get the template slug
	if ( strpos( $template, '.php' ) == false ) {
		$template = $template . '.php';
	}
	// Check if a custom template exists in the theme folder, if not, load the plugin template file
	$template_path = wud_template_path() . $template;

	$cache_key = sanitize_key( implode( '-', array( 'template', $template, $template_path ) ) );
	$file      = (string) wp_cache_get( $cache_key, 'wud' );

	if ( ! $file ) {

		if ( $theme_file = locate_template( array( $template_path ) ) ) {
			$file = $theme_file;
		} else {
			$file = $wud->plugin_path . 'app/templates/' . $template;
		}

		wp_cache_set( $cache_key, $file, 'wud' );
	}

	$file_filter = apply_filters( 'wud_get_template', $file, $template );

	if ( $file_filter !== $file ) {
		$file = $file_filter;
	}

	if ( $load && '' != $file ) {
		load_template( $file, $require_once );
	}

	return $file;
}

/**
 * Date format
 *
 * @param $date
 * @param null $format
 *
 * @return bool|int|string
 */
function wud_format_date( $date, $format = null ) {
	if ( empty( $format ) ) {
		$format = get_option( 'date_format' );
	}

	return mysql2date( $format, $date );
}

/**
 * Get file type by extension
 *
 * @param string $ext extension of file.
 *
 * @return mixed|string
 */
function wud_mime_type( $ext = 'txt' ) {

	$mime_types = array(

		'txt'   => 'text/plain',
		'htm'   => 'text/html',
		'html'  => 'text/html',
		'php'   => 'text/html',
		'css'   => 'text/css',
		'js'    => 'application/javascript',
		'json'  => 'application/json',
		'xml'   => 'application/xml',
		//flash
		'swf'   => 'application/x-shockwave-flash',
		'flv'   => 'video/x-flv',
		// images
		'png'   => 'image/png',
		'jpe'   => 'image/jpeg',
		'jpeg'  => 'image/jpeg',
		'jpg'   => 'image/jpeg',
		'gif'   => 'image/gif',
		'bmp'   => 'image/bmp',
		'ico'   => 'image/vnd.microsoft.icon',
		'tiff'  => 'image/tiff',
		'tif'   => 'image/tiff',
		'svg'   => 'image/svg+xml',
		'svgz'  => 'image/svg+xml',

		// audio
		'mid'   => 'audio/midi',
		'midi'  => 'audio/midi',
		'mp2'   => 'audio/mpeg',
		'mp3'   => 'audio/mpeg',
		'mpga'  => 'audio/mpeg',
		'aif'   => 'audio/x-aiff',
		'aifc'  => 'audio/x-aiff',
		'aiff'  => 'audio/x-aiff',
		'ram'   => 'audio/x-pn-realaudio',
		'rm'    => 'audio/x-pn-realaudio',
		'rpm'   => 'audio/x-pn-realaudio-plugin',
		'ra'    => 'audio/x-realaudio',
		'wav'   => 'audio/x-wav',
		'wma'   => 'audio/wma',

		//Video
		'mp4'   => 'video/mp4',
		'mpeg'  => 'video/mpeg',
		'mpe'   => 'video/mpeg',
		'mpg'   => 'video/mpeg',
		'mov'   => 'video/quicktime',
		'qt'    => 'video/quicktime',
		'rv'    => 'video/vnd.rn-realvideo',
		'avi'   => 'video/x-msvideo',
		'movie' => 'video/x-sgi-movie',
		'3gp'   => 'video/3gpp',
		'webm'  => 'video/webm',
		'ogv'   => 'video/ogg',

		// adobe
		'pdf'   => 'application/pdf',
		'psd'   => 'image/vnd.adobe.photoshop',
		'ai'    => 'application/postscript',
		'eps'   => 'application/postscript',
		'ps'    => 'application/postscript',

		// ms office
		'doc'   => 'application/msword',
		'rtf'   => 'application/rtf',
		'xls'   => 'application/vnd.ms-excel',
		'ppt'   => 'application/vnd.ms-powerpoint',

		// open office
		'odt'   => 'application/vnd.oasis.opendocument.text',
		'ods'   => 'application/vnd.oasis.opendocument.spreadsheet',
		'odp'   => 'application/vnd.oasis.opendocument.presentation',
	);

	if ( array_key_exists( $ext, $mime_types ) ) {
		return $mime_types[ $ext ];
	} else {
		return 'application/octet-stream';
	}
}

/**
 * Return
 *
 * @param $id
 * @param string $token
 *
 * @return string
 */
function wud_get_viewer_url( $id, $token = '' ) {
	global $wud;
	$url = $wud->get_admin_ajax_url() . '&controller=doc&task=download&doc_id=' . $id . '&preview=1' . ( $token != '' ? '&token=' . $token : '' );

	return 'https://docs.google.com/viewer?url=' . urlencode( $url ) . '&embedded=true';
}

/**
 * Utility function to format the button count,
 * appending "K" if one thousand or greater,
 * "M" if one million or greater,
 * and "B" if one billion or greater (unlikely).
 * $precision = how many decimal points to display (1.25K)
 */
function wud_format_count( $number ) {
	$precision = 2;
	if ( $number >= 1000 && $number < 1000000 ) {
		$formatted = number_format( $number / 1000, $precision ) . 'K';
	} else if ( $number >= 1000000 && $number < 1000000000 ) {
		$formatted = number_format( $number / 1000000, $precision ) . 'M';
	} else if ( $number >= 1000000000 ) {
		$formatted = number_format( $number / 1000000000, $precision ) . 'B';
	} else {
		$formatted = $number; // Number is less than 1000
	}
	$formatted = str_replace( '.00', '', $formatted );

	return $formatted;
}

/**
 * Return the visited url currently
 * @return mixed|string|void
 */

function wud_get_visited_url() {
	// Get visited URL
	$url = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
	$url .= '://' . $_SERVER['HTTP_HOST'];
	// port is prepopulated here sometimes
	if ( strpos( $_SERVER['HTTP_HOST'], ':' ) === false ) {
		$url .= in_array( $_SERVER['SERVER_PORT'], array( '80', '443' ) ) ? '' : ':' . $_SERVER['SERVER_PORT'];
	}
	$url .= $_SERVER['REQUEST_URI'];

	$url = apply_filters( 'wud_visited_url', $url );

	return $url;
}

/**
 * Utility to retrieve IP address
 */
function wud_get_ip() {
	if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
	}
	$ip = filter_var( $ip, FILTER_VALIDATE_IP );
	$ip = ( $ip === false ) ? '0.0.0.0' : $ip;

	return $ip;
}

/**
 * Store a message to option
 *
 * @param $type
 * @param $m
 * @param bool $success
 * @param string $object name of object need to notice.
 */
function wud_store_notices( $type, $m, $success = true, $object = '' ) {
	// store error notice in option array
	$notices            = get_option( 'wud_notices' );
	$notices[ $type ][] = array( 'message' => $m, 'success' => $success, 'object' => $object );
	update_option( 'wud_notices', $notices );
}

/**
 * Show message from option
 *
 * @param string $action
 * @param string $object_type
 * @param bool $success
 * @param string $custom
 *
 * @return bool|mixed|void
 */
function wud_print_notices( $action = '', $object_type = '', $success = true, $custom = '' ) {

	$class = [];
	if ( wud_is_admin() ) {
		$class[] = $success ? 'updated' : 'error';
		$class[] = 'notice is-dismissible';
	} else {
		$class[] = 'alert';
		$class[] = $success ? 'alert-success' : 'alert-danger';
	}

	$object_type = esc_attr( $object_type );

	$messagewrapstart = '<div id="message" class="' . implode( ' ', $class ) . '"><p>';
	$message          = '';

	$messagewrapend = '</p></div>';

	if ( 'add' === $action ) {
		if ( $success ) {
			$message .= sprintf( esc_html__( '%s has been successfully added', 'wud' ), $object_type );
		} else {
			$message .= sprintf( esc_html__( '%s has failed to be added', 'wud' ), $object_type );
		}
	} elseif ( 'update' === $action ) {
		if ( $success ) {
			$message .= sprintf( esc_html__( '%s has been successfully updated', 'wud' ), $object_type );
		} else {
			$message .= sprintf( esc_html__( '%s has failed to be updated', 'wud' ), $object_type );
		}
	} elseif ( 'delete' === $action ) {
		if ( $success ) {
			$message .= sprintf( esc_html__( '%s has been successfully deleted', 'wud' ), $object_type );
		} else {
			$message .= sprintf( esc_html__( '%s has failed to be deleted', 'wud' ), $object_type );
		}
	} elseif ( 'import' === $action ) {
		if ( $success ) {
			$message .= sprintf( esc_html__( '%s has been successfully imported', 'wud' ), $object_type );
		} else {
			$message .= sprintf( esc_html__( '%s has failed to be imported', 'wud' ), $object_type );
		}
	} elseif ( 'trash' === $action ) {
		if ( $success ) {
			$message .= sprintf( esc_html__( '%s has been successfully trashed', 'wud' ), $object_type );
		} else {
			$message .= sprintf( esc_html__( '%s has failed to be trashed', 'wud' ), $object_type );
		}
	} elseif ( 'reject' === $action ) {
		if ( $success ) {
			$message .= sprintf( esc_html__( '%s has been successfully rejected', 'wud' ), $object_type );
		} else {
			$message .= sprintf( esc_html__( '%s has failed to be rejected', 'wud' ), $object_type );
		}
	} elseif ( 'approved' === $action ) {
		if ( $success ) {
			$message .= sprintf( esc_html__( '%s has been successfully approved', 'wud' ), $object_type );
		} else {
			$message .= sprintf( esc_html__( '%s has failed to be approved', 'wud' ), $object_type );
		}
	} elseif ( 'error' === $action ) {
		if ( ! empty( $custom ) ) {
			$message = $custom;
		}
	} elseif ( 'submit' === $action ) {
		if ( ! empty( $custom ) ) {
			$message = $custom;
		}
	}

	if ( $message ) {
		return apply_filters( 'wud_message_notice', $messagewrapstart . $message . $messagewrapend, $action, $message, $messagewrapstart, $messagewrapend );
	}

	return false;
}

/**
 * Show notices
 */
function wud_show_notices() {
	$notices = get_option( 'wud_notices' );
	if ( empty( $notices ) ) {
		return;
	}
	// Print all messages.
	foreach ( $notices as $type => $ms ) {
		foreach ( $ms as $value ) {
			echo wud_print_notices( $type, $value['object'], $value['success'], $value['message'] );
		}
	}

	delete_option( 'wud_notices' );
}


/**
 * Get current url
 *
 * @return string
 */
function wud_get_current_url() {
	$page_url = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	return $page_url;
}

/**
 * Return pagination
 *
 * @param array $args
 *
 * @return string
 */
function wud_pagination( $args = array() ) {

	$total_items = $args['total_items'];
	$total_pages = $args['total_pages'];
	$pagenum     = $args['pagenum'];

	$output = '<span class="displaying-num">' . sprintf(
		/* translators: %s: Number of items. */
			_n( '%s item', '%s items', $total_items ),
			number_format_i18n( $total_items )
		) . '</span>';

	$current              = max( 1, $pagenum );
	$removable_query_args = wp_removable_query_args();
	$current_url          = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
	$current_url          = remove_query_arg( $removable_query_args, $current_url );

	$page_links = array();

	$total_pages_before = '<span class="paging-input">';
	$total_pages_after  = '</span></span>';

	$disable_first = false;
	$disable_last  = false;
	$disable_prev  = false;
	$disable_next  = false;

	if ( $current === 1 ) {
		$disable_first = true;
		$disable_prev  = true;
	}
	if ( $current === 2 ) {
		$disable_first = true;
	}
	if ( $current === $total_pages ) {
		$disable_last = true;
		$disable_next = true;
	}
	if ( $current === $total_pages - 1 ) {
		$disable_last = true;
	}

	if ( $disable_first ) {
		$page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&laquo;</span>';
	} else {
		$page_links[] = sprintf(
			"<a class='first-page button' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
			esc_url( remove_query_arg( 'pagenum', $current_url ) ),
			esc_html__( 'First page' , 'wud' ),
			'&laquo;'
		);
	}

	if ( $disable_prev ) {
		$page_links[] = '<span class="tablenav-pages-navspan button disabled">&lsaquo;</span>';
	} else {
		$page_links[] = sprintf(
			"<a class='prev-page button' href='%s'><span class='screen-reader-text'>%s</span><span>%s</span></a>",
			esc_url( add_query_arg( 'pagenum', max( 1, $current - 1 ), $current_url ) ),
			esc_html__( 'Previous page' , 'wud' ),
			'&lsaquo;'
		);
	}

	$html_current_page = sprintf(
		"%s<input class='current-page' id='current-page-selector' type='text' name='pagenum' value='%s' size='%d' /><span class='tablenav-paging-text'>",
		'<label for="current-page-selector" class="screen-reader-text">' . esc_html__( 'Current Page', 'wud' ) . '</label>',
		$current,
		strlen( $total_pages )
	);

	$html_total_pages = sprintf( "<span class='total-pages'>%s</span>", number_format_i18n( $total_pages ) );
	$page_links[]     = $total_pages_before . sprintf(
		/* translators: 1: Current page, 2: Total pages. */
			_x( '%1$s of %2$s', 'paging' ),
			$html_current_page,
			$html_total_pages
		) . $total_pages_after;

	if ( $disable_next ) {
		$page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&rsaquo;</span>';
	} else {
		$page_links[] = sprintf(
			"<a class='next-page button' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
			esc_url( add_query_arg( 'pagenum', min( $total_pages, $current + 1 ), $current_url ) ),
			esc_html__( 'Next page', 'wud' ),
			'&rsaquo;'
		);
	}

	if ( $disable_last ) {
		$page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&raquo;</span>';
	} else {
		$page_links[] = sprintf(
			"<a class='last-page button' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
			esc_url( add_query_arg( 'pagenum', $total_pages, $current_url ) ),
			esc_html__( 'Last page', 'wud' ),
			'&raquo;'
		);
	}

	$pagination_links_class = 'pagination-links';
	if ( ! empty( $infinite_scroll ) ) {
		$pagination_links_class .= ' hide-if-js';
	}
	$output .= "\n<span class='$pagination_links_class'>" . join( "\n", $page_links ) . '</span>';

	if ( $total_pages ) {
		$page_class = $total_pages < 2 ? ' one-page' : '';
	} else {
		$page_class = ' no-pages';
	}
	$pagination = "<div class='tablenav-pages{$page_class}'>$output</div>";

	return $pagination;
}

/**
 * Get main content class
 *
 * @param string $sidebar
 * @param string $custom
 *
 * @return mixed|void
 */
function wud_get_main_class( $sidebar = '', $custom = '' ) {
	if ( $sidebar == '' ) {
		$sidebar = wud_get_sidebar_value();
	}

	$class = 'col-sm-8';
	if ( $sidebar == 'no_sidebar' ) {
		$class = 'col-sm-12';
	}

	if ( $sidebar == 'sidebar_left' ) {
		$class .= ' sidebar-left';
	}

	if ( $sidebar == 'no_sidebar' ) {
		$class .= ' full-width-no-sidebar';
	}

	if ( $custom != '' ) {
		$class .= ' ' . $custom;
	}

	return apply_filters( 'wud_main_class', $class, $sidebar );
}

/**
 * Get side bar class
 *
 * @param string $custom
 *
 * @return mixed|void
 */
function wud_sidebar_class( $custom = '' ) {

	$class = 'col-sm-4';
	if ( $custom != '' ) {
		$class .= ' ' . $custom;
	}

	return apply_filters( 'wud_sidebar_class', $class );
}

/**
 * Get page sidebar value
 * value is no_sidebar/sidebar
 *
 * @param int $int
 *
 * @return bool|mixed
 */
function wud_get_sidebar_value() {

	global $wud_settings;

	$sidebar_main   = apply_filters( 'wud_sidebar_main', $wud_settings->get_input_value( 'sidebar', 'sidebar' ) );
	$sidebar        = $sidebar_main;
	$sidebar_single = apply_filters( 'wud_sidebar_single', $wud_settings->get_input_value( 'sidebar_single', 'no_sidebar' ) );
	if ( wud_is_single_document() ) {
		$sidebar = $sidebar_single;
	}

	return apply_filters( 'wud_sidebar_value', $sidebar, $sidebar_main, $sidebar_single );
}

/**
 * Converts a string (e.g. 'yes' or 'no') to a bool.
 *
 * @param string $string String to convert.
 *
 * @return bool
 */
function wud_string_to_bool( $string ) {
	return is_bool( $string ) ? $string : ( 'yes' === strtolower( $string ) || 1 === $string || 'true' === strtolower( $string ) || '1' === $string );
}

/**
 * Page Title function.
 *
 * @param bool $echo Should echo title.
 *
 * @return string
 */
function wud_page_title( $echo = true ) {

	if ( wud_is_search() ) {
		/* translators: %s: search query */
		$page_title = sprintf( esc_html__( 'Search results: &ldquo;%s&rdquo;', 'wud' ), wud_get_search_query() );

		if ( get_query_var( 'paged' ) ) {
			/* translators: %s: page number */
			$page_title .= sprintf( esc_html__( '&nbsp;&ndash; Page %s', 'wud' ), get_query_var( 'paged' ) );
		}
	} elseif ( wud_is_document_category() ) {
		$page_title = esc_html__( 'Category : ', 'wud' ) . single_term_title( '', false );
	}  elseif ( wud_is_author_document()) {
		$page_title = esc_html__( 'Author : ', 'wud' ) . get_the_author();
	} elseif (wud_is_single_document()) {
		$page_title  = get_the_title();
	} else {
		$doc_page_id = wud_get_page_id( 'documents' );
		$page_title  = get_the_title( $doc_page_id );
	}

	$page_title = apply_filters( 'wud_page_title', $page_title );

	if ( $echo ) {
		echo esc_html( $page_title );
	} else {
		return $page_title;
	}
}

/**
 * Returns true if on a page which uses WordPress User Document templates
 *
 * @return bool
 */
function wud_is_document() {
	return apply_filters( 'wud_is_document', wud_is_documents() || wud_is_document_taxonomy() || wud_is_single_document() || wud_is_author_document());
}

/**
 *  Retrieves the contents of the search WordPress query variable.
 *
 * The search query string is passed through esc_attr() to ensure that it is safe
 * for placing in an html attribute.
 *
 */

function wud_get_search_query() {
	return isset( $_GET['wud_search'] ) ? sanitize_text_field( wp_unslash( $_GET['wud_search'] ) ) : '';
}


/**
 * Returns true when user search documents
 *
 * @return bool
 */
function wud_is_search () {
	return apply_filters( 'wud_is_search', isset($_GET['wud_search']) );
}


/**
 *  Returns true when viewing a document category.
 *
 * @param string $term (default: '') The term slug your checking for. Leave blank to return true on any.
 *
 * @return bool
 */

function wud_is_document_category( $term = '' ) {
	return is_tax( 'wud-category', $term );
}

/**
 * Returns true when viewing a document tag.
 *
 * @param string $term (default: '') The term slug your checking for. Leave blank to return true on any.
 *
 * @return bool
 */
function wud_is_document_tag( $term = '' ) {
	return is_tax( 'wud-tag', $term );
}

/**
 * Returns true when viewing a document taxonomy archive.
 *
 * @return bool
 */

function wud_is_document_taxonomy() {
	return is_tax( get_object_taxonomies( 'wud-doc' ) );
}

/**
 * Return true when viewing an author document archive
 * @return bool
 */
function wud_is_author_document() {
	global $wp_query;

	return $wp_query->is_author() && isset( $wp_query->query_vars['post_type'] ) && $wp_query->query_vars['post_type'] === 'wud-doc';
}

/**
 * Return WordPress User Document instance ;
 * @return mixed
 */
function wud_app() {
	global $wud;

	return $wud;
}

/**
 * Returns true when viewing the single document type .
 * @return bool
 */
function wud_is_single_document() {
	return is_singular( array( 'wud-doc' ) );
}

/**
 * Returns true when viewing the document type archive .
 *
 * @return bool
 */

function wud_is_documents() {
	return ( is_post_type_archive( 'wud-doc' ) || is_page( wud_get_page_id( 'documents' ) ) );
}

/**
 * Retrieve page ids
 *
 * @param string $page Page slug.
 *
 * @return int
 */
function wud_get_page_id( $page ) {

	global $wud_settings;
	$page_id = 0;
	if ( $page === 'documents' ) {
		$page_id = $wud_settings->get_input_value( 'doc_page_id', '' );
	} elseif ( $page === 'my-account' ) {
		$page_id = $wud_settings->get_input_value( 'my_account_page_id', '' );
	}

	$page = apply_filters( 'wud_get_' . $page . '_page_id', $page_id );

	return $page ? absint( $page ) : - 1;
}

/**
 * Sets up the document_loop global from the passed args or from the main query.
 *
 * @param array $args Args to pass into the global.
 */
function wud_setup_loop( $args = array() ) {
	global $wud_settings;
	$default_args = array(
		'loop'         => 0,
		'columns'      => wud_get_default_documents_per_row(),
		'name'         => '',
		'is_shortcode' => false,
		'is_paginated' => true,
		'is_search'    => false,
		'total'        => 0,
		'total_pages'  => 0,
		'per_page'     => 0,
		'current_page' => 1,
		'list_type'    => $wud_settings->get_input_value( 'list_type', 'list' ),
	);

	// If this is a main WUD query, use global args as defaults.
	if ( $GLOBALS['wp_query']->get( 'wud_query' ) ) {
		$default_args = array_merge(
			$default_args,
			array(
				'is_search'    => $GLOBALS['wp_query']->is_search(),
				'total'        => $GLOBALS['wp_query']->found_posts,
				'total_pages'  => $GLOBALS['wp_query']->max_num_pages,
				'per_page'     => $GLOBALS['wp_query']->get( 'posts_per_page' ),
				'current_page' => max( 1, $GLOBALS['wp_query']->get( 'paged', 1 ) ),
			)
		);
	}

	// Merge any existing values.
	if ( isset( $GLOBALS['document_loop'] ) ) {
		$default_args = array_merge( $default_args, $GLOBALS['document_loop'] );
	}

	$GLOBALS['document_loop'] = wp_parse_args( $args, $default_args );
}

/**
 * Resets the document_loop global.
 */
function wud_reset_loop() {
	unset( $GLOBALS['document_loop'] );
}

/**
 * Gets a property from the document_loop global.
 *
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 *
 * @return mixed
 */
function wud_get_loop_prop( $prop, $default = '' ) {
	wud_setup_loop(); // Ensure shop loop is setup.

	return isset( $GLOBALS['document_loop'], $GLOBALS['document_loop'][ $prop ] ) ? $GLOBALS['document_loop'][ $prop ] : $default;
}

/**
 * Sets a property in the document_loop global.
 *
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */
function wud_set_loop_prop( $prop, $value = '' ) {
	if ( ! isset( $GLOBALS['document_loop'] ) ) {
		wud_setup_loop();
	}
	$GLOBALS['document_loop'][ $prop ] = $value;
}


/**
 * Output the start of a document loop. By default this is a UL.
 *
 * @param bool $echo Should echo?.
 *
 * @return string
 */
function wud_document_loop_start( $echo = true ) {
	ob_start();

	wud_set_loop_prop( 'loop', 0 );

	wud_get_template( 'loop/loop-start.php' );

	$loop_start = apply_filters( 'wud_document_loop_start', ob_get_clean() );

	if ( $echo ) {
		echo balanceTags( $loop_start );
	} else {
		return $loop_start;
	}
}


/**
 * Output the end of a document loop. By default this is a UL.
 *
 * @param bool $echo Should echo?.
 *
 * @return string
 */
function wud_document_loop_end( $echo = true ) {
	ob_start();

	wud_get_template( 'loop/loop-end.php' );

	$loop_end = apply_filters( 'wud_document_loop_end', ob_get_clean() );

	if ( $echo ) {
		echo balanceTags( $loop_end );
	} else {
		return $loop_end;
	}
}

/**
 * When the_post is called, put Document data into a global.
 *
 * @param mixed $post Post Object.
 *
 * @return Document
 */
function wud_setup_document_data( $post ) {

	if ( is_int( $post ) ) {
		$post = get_post( $post );
	}

	if ( empty( $post->post_type ) || ! in_array( $post->post_type, array( 'wud-doc' ), true ) ) {
		return;
	}

	if (isset($GLOBALS['document']) && $GLOBALS['document']->get_id() == $post->ID ) {
	} else {
		$GLOBALS['document'] = wud_get_document( $post->ID );
	}
}

add_action( 'the_post', 'wud_setup_document_data' );

/**
 * Get a document model object by id
 *
 * @param $document
 *
 * @return mixed
 */
function wud_get_document( $id ) {
	global $wud;
	$doc_model = Model::get_admin_instance( 'doc', $wud );
	$doc_model->set_id( $id );

	return $doc_model;
}

/**
 * Retrieves the classes for the post div as an array.
 *
 * This method was modified from WordPress's get_post_class() to allow the removal of taxonomies
 * (for performance reasons). Previously wud_document_post_class was hooked into post_class.
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post $document Document ID or document object.
 *
 * @return array
 */
function wud_get_document_class( $class = '', $document = null ) {
	if ( is_null( $document ) && ! empty( $GLOBALS['document'] ) ) {
		// Document was null so pull from global.
		$document = $GLOBALS['document'];
	}

	if ( $document && ! is_a( $document, 'wudDocModel' ) ) {
		// Make sure we have a valid document, or set to false.
		$document = wud_get_document( $document );
	}

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
	} else {
		$class = array();
	}

	$post_classes = array_map( 'esc_attr', $class );

	if ( ! $document ) {
		return $post_classes;
	}

	// Run through the post_class hook so 3rd parties using this previously can still append classes.
	// Note, to change classes you will need to use the newer wud_document_post_class filter.
	// @internal This removes the wud_document_post_class filter so classes are not duplicated.
	$filtered = has_filter( 'post_class', 'wud_document_post_class' );

	if ( $filtered ) {
		remove_filter( 'post_class', 'wud_document_post_class', 20 );
	}

	$post_classes = apply_filters( 'post_class', $post_classes, $class, $document->get_id() );

	if ( $filtered ) {
		add_filter( 'post_class', 'wud_document_post_class', 20, 3 );
	}

	$classes = array_merge(
		$post_classes,
		array(
			'wud-document',
			'type-document',
			'post-' . $document->get_id(),
			'status-' . $document->get_status(),
			wud_get_loop_class(),
		),
		wud_get_document_taxonomy_class( $document->get_taxonomy_ids( 'wud-category' ), 'wud-category' ),
		wud_get_document_taxonomy_class( $document->get_taxonomy_ids( 'wud-tag' ), 'wud-tag' )
	);

	if ( $document->get_featured( $document->get_id() ) ) {
		$classes[] = 'featured';
	}

	/**
	 * WordPress User Document Post Class filter.
	 *
	 * @param array $class Array of CSS classes.
	 * @param  $document object.
	 */
	$classes = apply_filters( 'wud_document_post_class', $classes, $document );

	return array_map( 'esc_attr', array_unique( array_filter( $classes ) ) );
}


/**
 * Get classname for WordPress user document loops.
 *
 * @return string
 */
function wud_get_loop_class() {
	$loop_index = wud_get_loop_prop( 'loop', 0 );
	$columns    = absint( max( 1, wud_get_loop_prop( 'columns', wud_get_default_documents_per_row() ) ) );

	$loop_index ++;
	wud_set_loop_prop( 'loop', $loop_index );

	if ( 0 === ( $loop_index - 1 ) % $columns || 1 === $columns ) {
		return 'first';
	}

	if ( 0 === $loop_index % $columns ) {
		return 'last';
	}

	return '';
}


/**
 * Get document taxonomy HTML classes.
 *
 * @param array $term_ids Array of terms IDs or objects.
 * @param string $taxonomy Taxonomy.
 *
 * @return array
 */
function wud_get_document_taxonomy_class( $term_ids, $taxonomy ) {

	$classes = array();

	if ( ! empty( $term_ids ) ) {
		foreach ( $term_ids as $term_id ) {
			$term = get_term( $term_id, $taxonomy );

			if ( empty( $term->slug ) ) {
				continue;
			}

			$term_class = sanitize_html_class( $term->slug, $term->term_id );
			if ( is_numeric( $term_class ) || ! trim( $term_class, '-' ) ) {
				$term_class = $term->term_id;
			}

			// 'post_tag' uses the 'tag' prefix for backward compatibility.
			if ( 'post_tag' === $taxonomy ) {
				$classes[] = 'tag-' . $term_class;
			} else {
				$classes[] = sanitize_html_class( $taxonomy . '-' . $term_class, $taxonomy . '-' . $term->term_id );
			}
		}
	}

	return $classes;
}

/**
 * Get the default rows setting
 * @return int
 */
function wud_get_default_documents_rows_per_page() {

	global $wud_settings;

	$rows = $wud_settings->get_input_value( 'layout_rows', 3 );

	if ( has_filter( 'wud_loop_documents_rows' ) ) {
		$rows = apply_filters( 'wud_loop_documents_rows', $rows );
	}

	$rows = absint( $rows );

	return $rows;
}

/**
 * Get the default columns setting
 * @return int
 */
function wud_get_default_documents_per_row() {

	global $wud_settings;

	$columns = $wud_settings->get_input_value( 'layout_columns', 3 );

	if ( has_filter( 'wud_loop_documents_columns' ) ) {
		$columns = apply_filters( 'wud_loop_documents_columns', $columns );
	}

	$columns = absint( $columns );

	return max( 1, $columns );
}

add_filter( 'body_class', 'wud_add_body_class', 10, 2 );

function wud_add_body_class( $classes, $class ) {
	global $wud_settings;
	$template_type = $wud_settings->get_input_value('template_type', 'plugin');

	if ( wud_is_document() || is_page( wud_get_page_id( 'my-account' ) ) ) {
		$classes[] = 'bootstrap-wrapper wud-body-wrapper';
	}

	$classes[] = 'wud-body-'.$template_type;

	return $classes;
}

/**
 * Adds extra post classes for documents via the WordPress post_class hook, if used.
 *
 * @param array $classes Current classes.
 * @param string|array $class Additional class.
 * @param int $post_id Post ID.
 *
 * @return array
 */
function wud_document_post_class( $classes, $class = '', $post_id = 0 ) {
	if ( ! $post_id || ! in_array( get_post_type( $post_id ), array( 'wud-doc' ), true ) ) {
		return $classes;
	}
	$document = false;

	if ( ! empty( $GLOBALS['document'] ) ) {
		// Document was null so pull from global.
		$document = $GLOBALS['document'];
	}

	if ( $document && ! is_a( $document, 'wudDocModel' ) ) {
		// Make sure we have a valid document, or set to false.
		$document = wud_get_document( $post_id );
	}

	if ( ! $document ) {
		return $classes;
	}

	$classes[] = 'document';
	$classes[] = wud_get_loop_class();

	if ( $document->get_featured( $document->get_id() ) ) {
		$classes[] = 'featured';
	}

	$key = array_search( 'hentry', $classes, true );
	if ( false !== $key ) {
		unset( $classes[ $key ] );
	}

	return $classes;
}

/**
 * Display the classes for the document div.
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post $document_id Document ID or document object.
 */
function wud_document_class( $class = '', $document_id = null ) {
	echo 'class="' . esc_attr( implode( ' ', wud_get_document_class( $class, $document_id ) ) ) . '"';
}

/**
 * Output the start of the container.
 */

function wud_output_container_start() {
	wud_get_template( 'container/start' );
}

/**
 * Output the end of the container.
 */

function wud_output_container_end() {
	wud_get_template( 'container/end' );
}


/**
 * Output before main content
 */

function wud_output_before_main_content() {
	wud_get_template( 'main/before' );
}

/**
 * Output after main content
 */

function wud_output_after_main_content() {
	wud_get_template( 'main/after' );
}


/**
 * Output main content header
 */

function wud_output_main_content_header() {
	wud_get_template( 'main/header' );
}

/**
 * Output pagination
 */

function wud_output_pagination() {

	if ( ! wud_get_loop_prop( 'is_paginated' ) ) {
		return;
	}

	$args = array(
		'total'   => wud_get_loop_prop( 'total_pages' ),
		'current' => wud_get_loop_prop( 'current_page' ),
		'base'    => esc_url_raw( add_query_arg( 'document-page', '%#%', false ) ),
		'format'  => '?document-page=%#%',
	);

	if ( ! wud_get_loop_prop( 'is_shortcode' ) ) {
		$args['format'] = '';
		$args['base']   = esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
	}

	extract( $args );

	include wud_get_template( 'loop/pagination', false );
}


/**
 * Output no documents found template
 */

function wud_output_no_documents_found() {
	wud_get_template_part( 'my-account/no', 'documents' );
}

/**
 * Output menus my account template
 */

function wud_nav_account_content() {

	global $wp;

	if ( isset( $wp->query_vars['edit-document'] ) || isset( $wp->query_vars['create-document'] ) ) {
		return;
	}

	wud_get_template( 'my-account/nav' );
}

/**
 * Output my account template
 */

function wud_account_content() {

	global $wp;

	if ( ! empty( $wp->query_vars ) ) {

		foreach ( $wp->query_vars as $key => $value ) {

			if ( has_action( 'wud_account_' . $key . '_endpoint' ) ) {
				do_action( 'wud_account_' . $key . '_endpoint', $value );

				return;
			}
		}
	}

	// No endpoint found? Default to Home.
	wud_get_template( 'my-account/home' );

}

/**
 * Output create document template
 */

function wud_account_create_document() {
	wud_get_template( 'my-account/form-document' );
}

/**
 * Output edit document template
 */

function wud_account_edit_document() {
	wud_get_template( 'my-account/form-document' );
}

/**
 * Output sidebar left template
 */

function wud_output_siderbar_left() {
	$sidebar_position = wud_get_sidebar_value();
	if ($sidebar_position == 'sidebar_left') {
		wud_get_template( 'sidebar' );
	}
}

/**
 * Output sidebar right template
 */
function wud_output_siderbar_right() {
	$sidebar_position = wud_get_sidebar_value();
	if ($sidebar_position == 'sidebar') {
		wud_get_template( 'sidebar' );
	}
}

/**
 * Utility to test if the post is already liked
 */
function wud_already_liked( $post_id, $is_comment ) {
	$post_users = null;
	$user_id    = null;
	if ( is_user_logged_in() ) { // user is logged in
		$user_id         = get_current_user_id();
		$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "wud_user_comment_liked" ) : get_post_meta( $post_id, "wud_user_liked" );
		if ( count( $post_meta_users ) != 0 ) {
			$post_users = $post_meta_users[0];
		}
	} else { // user is anonymous
		$user_id         = wud_get_ip();
		$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "wud_user_comment_ip" ) : get_post_meta( $post_id, "wud_user_ip" );
		if ( count( $post_meta_users ) != 0 ) { // meta exists, set up values
			$post_users = $post_meta_users[0];
		}
	}
	if ( is_array( $post_users ) && in_array( $user_id, $post_users ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Output the like button
 */
function wud_get_likes_button( $post_id, $is_comment = null ) {
	global $wud;

	$is_comment = ( null == $is_comment ) ? 0 : 1;
	$output     = '';
	$nonce      = wp_create_nonce( 'wud-likes-nonce' ); // Security
	if ( $is_comment == 1 ) {
		$post_id_class = esc_attr( ' wud-comment-button-' . $post_id );
		$comment_class = esc_attr( ' wud-comment' );
		$like_count    = get_comment_meta( $post_id, "wud_comment_like_count", true );
		$like_count    = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
	} else {
		$post_id_class = esc_attr( ' wud-button-like-' . $post_id );
		$comment_class = esc_attr( '' );
		$like_count    = get_post_meta( $post_id, "wud_post_like_count", true );
		$like_count    = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
	}
	$count      = wud_get_like_count( $like_count );
	$icon_empty = wud_get_unliked_icon();
	$icon_full  = wud_get_liked_icon();
	// Loader
	$loader = '<span id="wud-loader"></span>';
	// Liked/Unliked Variables
	if ( wud_already_liked( $post_id, $is_comment ) ) {
		$class = esc_attr( ' liked' );
		$title = esc_attr( 'Unlike', 'wud' );
		$icon  = $icon_full;
	} else {
		$class = '';
		$title = esc_attr( 'Like', 'wud' );
		$icon  = $icon_empty;
	}
	$output = '<span class="wud-wrapper"><a href="' . esc_url( $wud->get_ajax_url() . '&controller=doc&task=like' . '&post_id=' . $post_id . '&nonce=' . $nonce . '&is_comment=' . $is_comment . '&disabled=true' ) . '" class="wud-button-like' . $post_id_class . $class . $comment_class . '" data-nonce="' . esc_attr( $nonce ) . '" data-post-id="' . esc_attr( $post_id ) . '" data-iscomment="' . $is_comment . '" title="' . $title . '">' . $icon . $count . '</a>' . $loader . '</span>';

	return $output;
}

/**
 * Utility retrieves post meta user likes (user id array),
 * then adds new user id to retrieved array
 */
function wud_post_user_likes( $user_id, $post_id, $is_comment ) {
	$post_users      = '';
	$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "wud_user_comment_liked" ) : get_post_meta( $post_id, "wud_user_liked" );
	if ( count( $post_meta_users ) != 0 ) {
		$post_users = $post_meta_users[0];
	}
	if ( ! is_array( $post_users ) ) {
		$post_users = array();
	}
	if ( ! in_array( $user_id, $post_users ) ) {
		$post_users[ 'user-' . $user_id ] = $user_id;
	}

	return $post_users;
}

/**
 * Utility retrieves post meta ip likes (ip array),
 * then adds new ip to retrieved array
 */
function wud_post_ip_likes( $user_ip, $post_id, $is_comment ) {
	$post_users      = '';
	$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "wud_user_comment_ip" ) : get_post_meta( $post_id, "wud_user_ip" );
	// Retrieve post information
	if ( count( $post_meta_users ) != 0 ) {
		$post_users = $post_meta_users[0];
	}
	if ( ! is_array( $post_users ) ) {
		$post_users = array();
	}
	if ( ! in_array( $user_ip, $post_users ) ) {
		$post_users[ 'ip-' . $user_ip ] = $user_ip;
	}

	return $post_users;
}

/**
 * Utility returns the button icon for "like" action
 */
function wud_get_liked_icon() {
	/* If already using Font Awesome with your theme, replace svg with: <i class="fa fa-heart"></i> */
	$icon = '<span class="wud-icon"><svg role="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve"><path id="heart-full" d="M124 20.4C111.5-7 73.7-4.8 64 19 54.3-4.9 16.5-7 4 20.4c-14.7 32.3 19.4 63 60 107.1C104.6 83.4 138.7 52.7 124 20.4z"/>&#9829;</svg></span>';

	return $icon;
}

/**
 * Utility returns the button icon for "unlike" action
 */
function wud_get_unliked_icon() {
	/* If already using Font Awesome with your theme, replace svg with: <i class="fa fa-heart-o"></i> */
	$icon = '<span class="wud-icon"><svg role="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve"><path id="heart" d="M64 127.5C17.1 79.9 3.9 62.3 1 44.4c-3.5-22 12.2-43.9 36.7-43.9 10.5 0 20 4.2 26.4 11.2 6.3-7 15.9-11.2 26.4-11.2 24.3 0 40.2 21.8 36.7 43.9C124.2 62 111.9 78.9 64 127.5zM37.6 13.4c-9.9 0-18.2 5.2-22.3 13.8C5 49.5 28.4 72 64 109.2c35.7-37.3 59-59.8 48.6-82 -4.1-8.7-12.4-13.8-22.3-13.8 -15.9 0-22.7 13-26.4 19.2C60.6 26.8 54.4 13.4 37.6 13.4z"/>&#9829;</svg></span>';

	return $icon;
}

/**
 * Utility retrieves count plus count options,
 * returns appropriate format based on options
 */
function wud_get_like_count( $like_count ) {
	$like_text = esc_html__( 'Like', 'wud' );
	if ( is_numeric( $like_count ) && $like_count > 0 ) {
		$number = wud_format_count( $like_count );
	} else {
		$number = $like_text;
	}
	$count = '<span class="wud-count">' . esc_html( $number ) . '</span>';

	return $count;
}

/**
 * Get author documents link
 *
 * @param int $author_id
 * @param string $before
 * @param string $after
 *
 * @return string
 */
function wud_get_doc_author_link( $author_id = 0, $before = '', $after = '' ) {

	if ( $author_id ) {
		$link        = get_author_posts_url( $author_id );
		$author_name = get_the_author_meta( 'display_name', $author_id );
	} else {
		global $authordata;
		$link        = get_author_posts_url( $authordata->ID );
		$author_name = get_the_author();
	}

	$link = sprintf( '<a href="%1$s" title="%2$s" rel="author" class="author-link">%3$s%4$s%5$s</a>',
		esc_url( add_query_arg( 'post_type', 'wud-doc', $link ) ),
		esc_attr( sprintf( esc_attr__( 'Documents by %s', 'wud' ), $author_name ) ),
		$before,
		$author_name,
		$after
	);

	return $link;
}

/**
 * Retrieve page permalink.
 *
 * @param string $page page slug.
 * @param string|bool $fallback Fallback URL if page is not set. Defaults to home URL.
 *
 * @return string
 */
function wud_get_page_permalink( $page, $fallback = null ) {
	$page_id   = wud_get_page_id( $page );
	$permalink = 0 < $page_id ? get_permalink( $page_id ) : '';

	if ( ! $permalink ) {
		$permalink = is_null( $fallback ) ? get_home_url() : $fallback;
	}

	return apply_filters( 'wud_get_' . $page . '_page_permalink', $permalink );
}

/**
 * Get endpoint URL of account url
 *
 * @param $endpoint
 * @param $value
 *
 * @return string
 */
function wud_get_account_endpoint_url( $endpoint, $value = '' ) {

	return wud_get_endpoint_url( $endpoint, $value, wud_get_page_permalink( 'my-account' ) );
}


/**
 * Get endpoint URL.
 *
 * Gets the URL for an endpoint, which varies depending on permalink settings.
 *
 * @param string $endpoint Endpoint slug.
 * @param string $value Query param value.
 * @param string $permalink Permalink.
 *
 * @return string
 */
function wud_get_endpoint_url( $endpoint, $value = '', $permalink = '' ) {
	if ( ! $permalink ) {
		$permalink = get_permalink();
	}

	// Map endpoint to options.
	$query_vars = wud_app()->query->get_query_vars();
	$endpoint   = ! empty( $query_vars[ $endpoint ] ) ? $query_vars[ $endpoint ] : $endpoint;

	if ( get_option( 'permalink_structure' ) ) {
		if ( strstr( $permalink, '?' ) ) {
			$query_string = '?' . wp_parse_url( $permalink, PHP_URL_QUERY );
			$permalink    = current( explode( '?', $permalink ) );
		} else {
			$query_string = '';
		}
		$url = trailingslashit( $permalink );

		if ( $value ) {
			$url .= trailingslashit( $endpoint ) . user_trailingslashit( $value );
		} else {
			$url .= user_trailingslashit( $endpoint );
		}

		$url .= $query_string;
	} else {
		$url = add_query_arg( $endpoint, $value, $permalink );
	}

	return apply_filters( 'wud_get_endpoint_url', $url, $endpoint, $value, $permalink );
}

/**
 * Get label of document
 *
 * @param int $approved
 * @param int $featured
 * @param string $created_date
 *
 * @return string
 */
function wud_get_download_label( $approved = 1, $featured = 0, $created_date = '' ) {
	global $wud_settings;
	$label_class = array();

	$labels = array(
		'pending'  => esc_html__( 'Pending', 'wud' ),
		'new'      => esc_html__( 'New', 'wud' ),
		'featured' => esc_html__( 'Featured', 'wud' ),
	);

	$html_content = '';
	if ( ! $approved ) {
		$label_class[] = 'pending';
		$html_content  .= '<span class="document-pending">' . $labels['pending'] . '</span>';
	} else {

		$new_days = $wud_settings->get_input_value( 'new_document_days', 3 );
		if ( $new_days > 0 ) {
			if ( $new_days == 1 ) {
				$check_date = strtotime( "+1 day", strtotime( $created_date ) );
			} else {
				$check_date = strtotime( "+" . $new_days . " days", strtotime( $created_date ) );
			}

			if ( $check_date >= time() ) {
				$label_class[] = 'new';
				$html_content  .= '<span class="document-new">' . $labels['new'] . '</span>';
			}
		}

		if ( $featured ) {
			$label_class[] = 'featured';
			$html_content  .= '<span class="document-featured">' . $labels['featured'] . '</span>';
		}

	}

	if ( ! empty( $label_class ) ) {
		$html = '<div class="document-label ' . esc_attr( implode( ' ', $label_class ) ) . '">';
		$html .= $html_content;
		$html .= '</div>';

		return $html;
	}

	// return empty if don't have label
	return '';

}

/**
 * Display toolbar
 *
 * @param $attributes
 */
function wud_documents_toolbar( $attributes ) {
	include wud_get_template( 'toolbar/main', false );
}

/**
 * Return licenses options from database
 * @return mixed|void
 */
function wud_get_licenses_options() {

	global $wud;
	$licenses_options = array();

	$licenses_model = Model::get_admin_instance( 'licenses', $wud );
	list( $total, $licenses ) = $licenses_model->get_licenses();

	if ( ! empty( $licenses ) ) {
		foreach ( $licenses as $row ) {
			$licenses_options[ $row->ID ] = $row->name;
		}
	}

	return $licenses_options;
}

/**
 * Get document tags
 *
 * @param array $args
 *
 * @return array/false
 */
function wud_get_document_tags( $args = array() ) {

	$args = wp_parse_args( $args, array(
		'taxonomy'   => 'wud-tag',
		'orderby'    => 'count',
		'order'      => 'DESC',
		'type_key'   => 'slug',
		'hide_empty' => false
	) );

	if ( ! taxonomy_exists( $args['taxonomy'] ) ) {
		return false;
	}
	$items = array();
	$tags  = get_terms( $args );
	if ( ! empty( $tags ) ) {
		foreach ( $tags as $tag ) {
			$items[ $tag->{$args['type_key']} ] = $tag->name;
		}
	}

	return array_unique( $items );
}

/**
 * Return default options for sortby
 * @return mixed|void
 */
function wud_get_sortby_options() {
	$sor_options = array(
		'latest'         => esc_attr__( 'Latest', 'wud' ),
		'oldest'         => esc_attr__( 'Oldest', 'wud' ),
		'featured'       => esc_attr__( 'Featured', 'wud' ),
		'most_viewed'    => esc_attr__( 'Most Viewed', 'wud' ),
		'most_discussed' => esc_attr__( 'Most Discussed', 'wud' ),
		'most_liked'     => esc_attr__( 'Most Liked', 'wud' ),
	);

	return apply_filters( 'wud_sortby_options', $sor_options );
}

/**
 * Return default options for range date
 * @return mixed|void
 */
function wud_get_range_date_options() {
	$range_date_options = array(
		'all'        => esc_attr__( 'All Time', 'wud' ),
		'this_month' => esc_attr__( 'This Month', 'wud' ),
		'this_week'  => esc_attr__( 'This Week', 'wud' ),
		'to_day'     => esc_attr__( 'To Day', 'wud' ),
	);

	return apply_filters( 'wud_range_date_options', $range_date_options );
}


/**
 * Return true if post file size <= max upload size
 * @return bool
 */
function wud_check_post_file_size() {

	if ( isset( $_SERVER['REQUEST_METHOD'] ) and $_SERVER['REQUEST_METHOD'] === 'POST' and isset( $_SERVER['CONTENT_LENGTH'] ) and empty( $_POST )//if is a post request and $_POST variable is empty(a symptom of "post max size error")
	) {

		$max_upload_size = wp_max_upload_size();
		$send            = $_SERVER['CONTENT_LENGTH'];//get the sent post size

		if ( $max_upload_size < $send ) {
			return false;
		}

	}

	return true;
}

/**
 * Block IPs
 *
 * @param string $ips comma-separated list of IDs
 *
 * @return bool
 */
function wud_block_ips( $ips = '' ) {
	global $wud_settings;

	if ($ips == '') {
		$ips = $wud_settings->get_input_value( 'block_ip', $ips );
	}
	$ips = preg_split( '/\r\n|\r|\n/', $ips );
	$block = false;
	if ( ! empty( $ips ) ) {

		$user_octets       = explode( '.', wud_get_ip() ); // get the client's IP address and split it by the period character
		$user_octets_count = count( $user_octets );  // Number of octets we found, should always be four

		 // boolean that says whether or not we should block this user

		foreach ( $ips as $ip_address ) { // iterate through the list of IP addresses
			$octets = explode( '.', $ip_address );
			if ( count( $octets ) != $user_octets_count ) {
				continue;
			}

			for ( $i = 0; $i < $user_octets_count; $i ++ ) {
				if ( $user_octets[ $i ] == $octets[ $i ] || $octets[ $i ] == '*' ) {
					continue;
				} else {
					break;
				}
			}

			if ( $i == $user_octets_count ) { // if we looked at every single octet and there is a match, we should block the user
				$block = true;
				break;
			}
		}

	}

	return $block;
}

/**
 * Return access terms of doc
 * @param int $user_id user id
 *
 * @return array
 */

function wud_get_doc_access_terms( $user_id = 0) {

	$user        = wp_get_current_user();
	$final_user_id = $user_id ? $user_id : $user->ID;
	$access_levels = array();
	$comment_levels = array();
	$edit_levels = array();

	// Everyone can see 'anyone' docs
	$access_levels[] = wud_get_access_term_role('anyone');
	$comment_levels[] = wud_get_access_term_role('anyone');
	//Logged-in

	if ( $final_user_id ) {
		$user_roles  = $user->roles;
		if (!empty($user_roles)) {
			foreach ( $user_roles as $user_role ) {
				$access_levels[] = wud_get_access_term_role($user_role);;
				$edit_levels[] = wud_get_access_term_role($user_role);;
				$comment_levels[] = wud_get_access_term_role($user_role);;
			}
		}
	}

	if ( wud_installed_buddypress() ) {
		// Everyone can see 'anyone' docs
		$access_levels[] = wud_get_access_term_anyone();
		$comment_levels[] = wud_get_access_term_anyone();

		// Logged-in users
		if ( $final_user_id != 0 ) {
			$access_levels[] = wud_get_access_term_loggedin();
			$comment_levels[] = wud_get_access_term_loggedin();
			$edit_levels[] = wud_get_access_term_loggedin();
			if ( bp_is_active('groups') ) {
				$groups                      = BP_Groups_Member::get_group_ids( $final_user_id );
				$user_groups['groups']       = $groups['groups'];
				$admin_groups                      = BP_Groups_Member::get_is_admin_of( $final_user_id );
				$mod_groups                        = BP_Groups_Member::get_is_mod_of( $final_user_id );
				$user_groups['admin_mod_of'] = array_merge( wp_list_pluck( $admin_groups['groups'], 'id' ), wp_list_pluck( $mod_groups['groups'], 'id' ) );

				if ( isset($user_groups['groups']) ) {
					foreach ( $user_groups['groups'] as $member_group ) {
						$access_levels[] = wud_get_access_term_group_member( $member_group );
						$edit_levels[] = wud_get_access_term_group_member( $member_group );
						$comment_levels[] = wud_get_access_term_group_member( $member_group );
					}
				}

				// admins-mods
				if ( isset($user_groups['admin_mod_of']) ) {
					foreach ( $user_groups['admin_mod_of'] as $adminmod_group ) {
						$access_levels[] = wud_get_access_term_group_adminmod( $adminmod_group );
						$edit_levels[] = wud_get_access_term_group_adminmod( $adminmod_group );
						$comment_levels[] = wud_get_access_term_group_adminmod( $adminmod_group );
					}
				}
			}
			// creator
			$access_levels[] = wud_get_access_term_user( $final_user_id );
			$comment_levels[] = wud_get_access_term_user( $final_user_id );
		}

	}

	return array('access_terms' => $access_levels, 'edit_terms' => $edit_levels, 'comment_terms' => $comment_levels);
}

/**
 * Check if BuddyPress already installed
 *
 * @return bool
 */
function wud_installed_buddypress() {
	if (class_exists('BuddyPress')) {
		return true;
	} else {
		return false;
	}
}
/**
 * Get a dropdown of groups for the current user.

 */
function wud_group_dropdown( $args = array() ) {

	if ( ! bp_is_active( 'groups' ) ) {
		return;
	}
	$r = wp_parse_args( $args, array(
		'name'         => 'group_id',
		'id'           => 'group_id',
		'class'        => '',
		'selected'     => null,
		'options_only' => false,
		'echo'         => true,
		'null_option'  => true,
		'include'      => null,
	) );

	$groups_args = array(
		'per_page' => false,
		'populate_extras' => false,
		'type' => 'alphabetical',
		'update_meta_cache' => false,
	);

	if ( ! bp_current_user_can( 'bp_moderate' ) ) {
		$groups_args['user_id'] = bp_loggedin_user_id();
	}

	if ( ! is_null( $r['include'] ) ) {
		$groups_args['include'] = wp_parse_id_list( $r['include'] );
	}

	ksort( $groups_args );
	ksort( $r );

	$cache_key = 'wud_group_dropdown_key:' . md5( serialize( $groups_args ) . serialize( $r ) );
	$cached = wp_cache_get( $cache_key, 'wud_group_dropdown' );
	if ( false !== $cached ) {
		return $cached;
	}

	// Populate the $groups_template global, but stash the old one
	// This ensures we don't mess anything up inside the group
	global $groups_template;
	$old_groups_template = $groups_template;

	bp_has_groups( $groups_args );


	$html = '';

	if ( ! $r['options_only'] ) {
		$html .= sprintf( '<select name="%s" id="%s" class="%s">', esc_attr( $r['name'] ), esc_attr( $r['id'] ), esc_attr( $r['class'] ));
	}

	if ( $r['null_option'] ) {
		$html .= '<option value="">' . __( 'None', 'buddypress-docs' ) . '</option>';
	}

	foreach ( $groups_template->groups as $g ) {
		$html .= sprintf(
			'<option value="%s" %s>%s</option>',
			esc_attr( $g->id ),
			selected( $r['selected'], $g->id, false ),
			esc_html( stripslashes( $g->name ) )
		);
	}

	if ( ! $r['options_only'] ) {
		$html .= '</select>';
	}

	$groups_template = $old_groups_template;

	wp_cache_set( $cache_key, $html, 'wud_group_dropdown' );

	if ( false === $r['echo'] ) {
		return $html;
	} else {
		echo wp_kses_normalize_entities($html);
	}
}


/**
 * Set group for doc
 * @param $id
 * @param string $group_id
 */
function wud_set_term_group_doc( $id, $group_id = '' ) {
	$term_group = $group_id != '' ? wud_get_term_slug_from_group_id( $group_id ) : array();
	wp_set_post_terms( $id, $term_group, 'wud-group' );

}

/**
 * Get the group id with a doc
 *
 * In order to be forward-compatible, this function will return an array when more than one group
 * is found.
 * @param int $doc_id The id of the Doc
 * @param bool $single_array This is a funky one. If only a single group_id is found, should it be
 *    returned as a singleton array, or as an int? Defaults to the latter.
 * @return mixed $group_id Either an array or a string of the group id(s)
 */
function wud_get_doc_group_id( $doc_id, $single_array = false ) {

	$post_terms = get_the_terms( $doc_id, 'wud-group' );
	$group_ids = array();
	if ( $post_terms ) {
		foreach ( $post_terms as $post_term ) {
			if ( 0 === strpos( $post_term->slug, 'wud_group_' ) ) {
				$group_id = wud_get_group_id_from_term_slug( $post_term->slug );
				if ( $group_id ) {
					$group_ids[] = $group_id;
				}
			}
		}
	}

	if ( !$single_array && ( count( $group_ids ) <= 1 ) ) {
		$return = implode( ',', $group_ids );
	} else {
		$return = $group_ids;
	}

	return apply_filters( 'wud_group_id', $return, $doc_id, $single_array );
}


function wud_get_group_id_from_term_slug( $term_slug ) {
	$value = explode( 'wud_group_', $term_slug );
	return intval( array_pop( $value ) );
}

function wud_get_term_slug_from_group_id( $group_id ) {
	return 'wud_group_' . (int) $group_id;
}

/**
 * Get the access term for 'anyone'
 *
 * @return string The term slug
 */
function wud_get_access_term_anyone() {
	return apply_filters( 'wud_get_access_term_anyone', 'wud_access_anyone' );
}

/**
 * Get the access term for 'loggedin'

 * @return string The term slug
 */
function wud_get_access_term_loggedin() {
	return apply_filters( 'wud_get_access_term_loggedin', 'wud_access_loggedin' );
}

/**
 * Get the access term for a user id
 *
 * @param int|bool $user_id Defaults to logged in user
 * @return string The term slug
 */
function wud_get_access_term_user( $user_id = false ) {

	if ( false === $user_id ) {
		$user_id = bp_loggedin_user_id();
	}

	return apply_filters( 'wud_get_access_term_user', 'wud_access_user_' . intval( $user_id ) );
}

/**
 * Get the access term for a role
 *
 * @param string $role role name
 * @return string The term slug
 */
function wud_get_access_term_role( $role = 'anyone' ) {
	return apply_filters( 'wud_get_access_term_role', 'wud_access_role_' . $role );
}

/**
 * Get the access term corresponding to group-members for a given group
 *
 * @param int $group_id
 * @return string The term slug
 */
function wud_get_access_term_group_member( $group_id = false ) {
	return apply_filters( 'wud_get_access_term_group_member', 'wud_access_group_member_' . intval( $group_id ) );
}

/**
 * Get the access term corresponding to admins-mods for a given group
 *
 * @param int $group_id
 * @return string The term slug
 */
function wud_get_access_term_group_adminmod( $group_id = false ) {
	return apply_filters( 'wud_get_access_term_group_adminmod', 'wud_access_group_adminmod_' . intval( $group_id ) );
}

/**
 * Set access term for doc
 *
 * @param $doc_id
 * @param string $access
 * @param integer $group
 * @param string $taxonomy
 *
 * @return bool
 */
function wud_set_access_doc( $doc_id, $access = 'anyone', $group_id = 0,  $taxonomy = 'wud-access') {

	$doc = get_post( $doc_id );

	if ( ! $doc || is_wp_error( $doc ) ) {
		return false;
	}
	// access by role
	$access_term = wud_get_access_term_role($access);

	if ($group_id) {

		switch ( $access ) {
			case 'anyone' :
				$access_term = wud_get_access_term_anyone();
				break;
			case 'loggedin' :
				$access_term = wud_get_access_term_loggedin();
				break;
			case 'group-members' :
			case 'admins-mods' :
				$access_term = 'group-members' == $access ? wud_get_access_term_group_member( $group_id ) : wud_get_access_term_group_adminmod( $group_id );
				break;
			case 'creator' :
				$access_term = wud_get_access_term_user( $doc->post_author );
				break;
			default:

				break;
		}
	}

	$retval = wp_set_post_terms( $doc_id, $access_term, $taxonomy );

	if ( empty( $retval ) || is_wp_error( $retval ) ) {
		return false;
	} else {
		return true;
	}

}


/**
 * Return options array of access by role
 *
 * @return mixed|void
 */
function wud_get_access_roles() {

	global $wp_roles;
	$roles = $wp_roles->roles;

	$roles_options = array( 'anyone' => esc_attr__( 'Anyone', 'wud' ) );

	foreach ( $roles as $key => $role ) {
		$roles_options[ $key ] = $role['name'];
	}

	return apply_filters('wud_get_access_role_options', $roles_options);
}

/**
 * Return options array of access by group
 *
 * @return mixed|void
 */
function wud_get_access_groups() {

	$options = array(
		'anyone' => esc_attr__( 'Anyone', 'wud' ),
		'loggedin' => esc_attr__( 'Logged-in', 'wud' ),
		'group-members' => esc_attr__( 'Members of group', 'wud' ),
		'admins-mods' => esc_attr__( 'Admins and Mods of group', 'wud' ),
		'creator' => esc_attr__( 'Author only', 'wud' ),
	);

	return apply_filters('wud_get_access_group_options', $options);
}

/*
 * Check user can edit document
 */
function wud_user_can_edit_doc( $doc ) {
	global $wud_settings;
	if ( current_user_can( 'bp_moderate' ) ) {
		return true;
	}

	if ( $wud_settings->get_input_value( 'user_can_edit', 'yes' ) == 'no' ) {
		return false;
	}

	$user    = wp_get_current_user();
	$exclude = wud_app()->query->get_exclude_edit_doc_ids();

	$can = false;
	if ( ! in_array( $doc['ID'], $exclude ) ) {
		$can = true;
	} elseif ( $user->ID == $doc['post_author'] ) {
		$can = true;
	}

	return $can;
}