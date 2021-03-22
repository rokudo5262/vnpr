<?php
/*======
*
* Theme Setup
*
======*/
if( !function_exists( 'eventchamp_setup' ) ) {

	function eventchamp_setup() {

		load_theme_textdomain( 'eventchamp', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'dark-editor-style' );
		add_theme_support( 'editor-style' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'post-formats', array( 'quote', 'gallery', 'image', 'video', 'audio', 'chat', 'link' ) );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		if( function_exists( 'add_image_size' ) ) { 

			add_image_size( 'eventchamp-content-header', 1130, 650, true );
			add_image_size( 'eventchamp-feature-box-1', 540, 330, true );
			add_image_size( 'eventchamp-thumbnail', 350, 350, true );
			add_image_size( 'eventchamp-thumbnail-2', 650, 650, true );
			add_image_size( 'eventchamp-thumbnail-3', 1200, 1200, true );
			add_image_size( 'eventchamp-big-post', 870, 550, true );
			add_image_size( 'eventchamp-small-post', 420, 290, true );
			add_image_size( 'eventchamp-event-sponsor', 130, 80, true );
			add_image_size( 'eventchamp-event-sponsor-big', 250, 220, true );
			add_image_size( 'eventchamp-speaker', 615, 640, true );
			add_image_size( 'eventchamp-avatar', 85, 85, true );
			add_image_size( 'eventchamp-event-slider', 1920, 1100, true );
			add_image_size( 'eventchamp-event-list', 952, 579, true );
			add_image_size( 'eventchamp-big-event', 870, 560, true );
			add_image_size( 'eventchamp-page-banner', 1920, 350, true );

		}

		if( !isset( $content_width ) ) {

			$content_width = 600;

		}

	}
	add_action( 'after_setup_theme', 'eventchamp_setup' );

}



/*======
*
* Theme Scripts & Styles
*
======*/
if( !function_exists( 'eventchamp_scripts' ) ) {

	function eventchamp_scripts() {

		/*====== Scripts ======*/
		wp_enqueue_script( 'popper', get_template_directory_uri() . '/include/assets/js/popper.min.js', array(), false, true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/include/assets/js/bootstrap.min.js', array(), false, true );
		wp_enqueue_script( 'jquery-ui-datepicker', true, array(), false, true );
		wp_enqueue_script( 'moment', get_template_directory_uri() . '/include/assets/js/moment.min.js', array(), false, true );
		wp_enqueue_script( 'fullcalendar', get_template_directory_uri() . '/include/assets/js/fullcalendar.min.js', array(), false, true );
		wp_enqueue_script( 'fullcalendar-locale-all', get_template_directory_uri() . '/include/assets/js/locale-all.min.js', array(), false, true );
		wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/include/assets/js/waypoints.min.js', array(), false, true );
		wp_enqueue_script( 'scrollbar', get_template_directory_uri() . '/include/assets/js/scrollbar.min.js', array(), false, true );
		wp_enqueue_script( 'counterup', get_template_directory_uri() . '/include/assets/js/counterup.min.js', array(), false, true );
		wp_enqueue_script( 'flexmenu', get_template_directory_uri() . '/include/assets/js/flexmenu.min.js', array(), false, true );
		wp_enqueue_script( 'countdown', get_template_directory_uri() . '/include/assets/js/countdown.min.js', array(), false, true );
		wp_enqueue_script( 'bootstrap-select', get_template_directory_uri() . '/include/assets/js/bootstrap-select.min.js', array(), false, true );
		wp_enqueue_script( 'ion-range-slider', get_template_directory_uri() . '/include/assets/js/ion-range-slider.min.js', array(), false, true );

		/*====== Comment Support ======*/
		if( is_singular() ) {

			wp_enqueue_script( 'comment-reply' );

		}

		/*====== Cookie Bar ======*/
		$cookie_bar = ot_get_option( 'cookie-bar', 'on' );

		if( $cookie_bar == 'on' ) {

			wp_enqueue_script( 'js.cookie', get_template_directory_uri() . '/include/assets/js/js.cookie.min.js', array(), false, true  );

		}

		/*====== Sticky Sidebar ======*/
		$sticky_sidebar = ot_get_option( 'sticky-sidebar', 'off' );

		if( $sticky_sidebar == 'on' ) {

			wp_enqueue_script( 'eventchamp-sticky-sidebar', get_template_directory_uri() . '/include/assets/js/sticky-sidebar.min.js', array(), false, true  );

		}

		/*====== Sticky Header ======*/
		$sticky_header = ot_get_option( 'header_fixed', 'off' );

		if( $sticky_header == 'on' ) {

			wp_enqueue_script( 'eventchamp-sticky-header', get_template_directory_uri() . '/include/assets/js/sticky-header.min.js', array(), false, true  );

		}

		/*====== Instant Click ======*/
		$instantclick = ot_get_option( 'instantclick', 'off' );

		if( $instantclick == 'on' ) {

			wp_enqueue_script( 'instantclick', get_template_directory_uri() . '/include/assets/js/instantclick.min.js', array(), false, true  );

		}

		/*====== Google Maps ======*/
		$google_map_api = ot_get_option( 'googlemapapi' );

		if( !empty( $google_map_api ) ) {

			wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?v=3&key=' . esc_attr( $google_map_api ) . '&libraries=places', array(), false, true );
			wp_enqueue_script( 'google-maps-infobox', get_template_directory_uri() . '/include/assets/js/google-maps-infobox.min.js', array(), false, true );
			wp_enqueue_script( 'markerclusterer', get_template_directory_uri() . '/include/assets/js/markerclusterer.min.js', array(), false, true );
			wp_enqueue_script( 'eventchamp-google-maps', get_template_directory_uri() . '/include/assets/js/google-maps.min.js', array(), false, true );

		}

		wp_enqueue_script( 'swiper', get_template_directory_uri() . '/include/assets/js/swiper.min.js', array(), false, true );
		wp_enqueue_script( 'eventchamp', get_template_directory_uri() . '/include/assets/js/eventchamp.min.js', array(), false, true );

		/*====== Styles ======*/
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/include/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/include/assets/css/fontawesome.min.css' );
		wp_enqueue_style( 'swiper', get_template_directory_uri() . '/include/assets/css/swiper.min.css' );
		wp_enqueue_style( 'scrollbar', get_template_directory_uri() . '/include/assets/css/scrollbar.min.css' );
		wp_enqueue_style( 'bootstrap-select', get_template_directory_uri() . '/include/assets/css/bootstrap-select.min.css' );
		wp_enqueue_style( 'fullcalendar', get_template_directory_uri() . '/include/assets/css/fullcalendar.min.css' );
		wp_enqueue_style( 'ion-range-slider', get_template_directory_uri() . '/include/assets/css/ion-range-slider.min.css' );
		wp_enqueue_style( 'ion-range-slider-flat-theme', get_template_directory_uri() . '/include/assets/css/ion-range-slider-flat-theme.min.css' );
		wp_enqueue_style( 'eventchamp-wp-core', get_template_directory_uri() . '/include/assets/css/wp-core.min.css' );
		wp_enqueue_style( 'eventchamp-main', get_template_directory_uri() . '/include/assets/css/gt-style.min.css' );
		wp_enqueue_style( 'eventchamp', get_stylesheet_uri() );

		/*====== Dark Skin ======*/
		$dark_skin = ot_get_option( 'dark-skin', 'off' );

		if( $dark_skin == 'on' ) {

			wp_enqueue_style( 'eventchamp-dark-skin', get_template_directory_uri() . '/include/assets/css/dark.min.css' );

		}

		/*====== RTL ======*/
		$rtl = ot_get_option( 'rtl', 'off' );

		if( $rtl == 'on' ) {

			wp_enqueue_style( 'eventchamp-rtl', get_template_directory_uri() . '/include/assets/css/rtl.min.css' );

		}

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_scripts' );

}



/*======
*
* Admin Scripts & Styles
*
======*/
if( !function_exists( 'eventchamp_admin_scripts' ) ) {

	function eventchamp_admin_scripts() {

		if( is_admin() ) {

			wp_enqueue_style( 'ot-admin-css', get_template_directory_uri() . '/include/admin/assets/css/ot-admin.css', false, '1.0' );
			wp_enqueue_style( 'eventchamp-admin', get_template_directory_uri() . '/include/assets/css/admin.min.css', false, '1.0' );
			wp_enqueue_script( 'eventchamp-admin', get_template_directory_uri() . '/include/assets/js/admin.min.js', false, '1.0' );

		}

	}
	add_action( 'admin_enqueue_scripts', 'eventchamp_admin_scripts' );

}



/*======
*
* Body Classes
*
======*/
if( !function_exists( 'eventchamp_class_names' ) ) {

	function eventchamp_class_names( $classes ) {

		$classes[] = 'eventchamp-theme';

		return $classes;

	}
	add_filter( 'body_class', 'eventchamp_class_names' );

}



/*======
*
* Excerpt Length
*
======*/
if( !function_exists( 'eventchamp_excerpt_length' ) ) {

	function eventchamp_excerpt_length( $length ) {

		$length = ot_get_option( 'event-excerpt-length', '40' );

		return $length;

	}
	add_filter( 'excerpt_length', 'eventchamp_excerpt_length', 999 );

}



/*======
*
* Excerpt More
*
======*/
if( !function_exists( 'eventchamp_excerpt_more' ) ) {

	function eventchamp_excerpt_more( $more ) {

		return '...';

	}
	add_filter( 'excerpt_more', 'eventchamp_excerpt_more' );

}



/*======
*
* Excerpt for Pages
*
======*/
if( !function_exists( 'eventchamp_excerpts_for_pages' ) ) {

	function eventchamp_excerpts_for_pages() {

		add_post_type_support( 'page', 'excerpt' );

	}
	add_action( 'init', 'eventchamp_excerpts_for_pages' );

}



/*======
*
* Word Cutter
*
======*/
if( !function_exists( 'eventchamp_word_cutter' ) ) {

	function eventchamp_word_cutter( $string, $word_limit ) {

		$words = explode( ' ', $string, ( $word_limit + 1 ) );

		if( count( $words ) > $word_limit ) {

			array_pop( $words );

		}

		return implode( ' ', $words );

	}

}



/*======
*
* Global Date Converter
*
======*/
if( !function_exists( 'eventchamp_global_date_converter' ) ) {

	function eventchamp_global_date_converter( $date = "", $date_format = "" ) {

		if( empty( $date_format ) ) {

			$date_format = get_option( 'date_format' );

		}

		$date = date_i18n( esc_attr( $date_format ), strtotime( $date ) );

		return $date;

	}

}



/*======
*
* Global Time Converter
*
======*/
if( !function_exists( 'eventchamp_global_time_converter' ) ) {

	function eventchamp_global_time_converter( $time = "", $time_format = "" ) {

		if( empty( $time_format ) ) {

			$time_format = get_option( 'time_format' );

		}

		$time = date_i18n( esc_attr( $time_format ), strtotime( $time ) );

		return $time;

	}

}



/*======
*
* Finding Slug
*
======*/
if( !function_exists( 'eventchamp_to_slug' ) ) {

	function eventchamp_to_slug( $string ) {

		return strtolower( trim( preg_replace('/[^A-Za-z0-9-]+/', '-', $string ) ) );

	}

}



/*======
*
* Get a Posts of Category
*
======*/
if( !function_exists( 'eventchamp_taxonomy_post_count' ) ) {

	function eventchamp_taxonomy_post_count( $cat_id = "", $taxonomy = "category" ) {

		$main_count = 0;
		$child_count = 0;
		$main_args = array(
			'include' => $cat_id,
			'child_of' => 0,
		);
		$main_terms = get_terms( esc_attr( $taxonomy ), $main_args );
		$child_args = array(
			'child_of' => $cat_id,
		);
		$child_terms = get_terms( esc_attr( $taxonomy ), $child_args );

		if( !empty( $main_terms ) ) {

			foreach( $main_terms as $main_term ) {

				if( !empty( $main_term ) ) {

					$main_count += esc_attr( $main_term->count );

				}

			}

		}

		if( !empty( $child_terms ) ) {

			foreach( $child_terms as $child_term ) {

				if( !empty( $child_term ) ) {

					$child_count += esc_attr( $child_term->count );

				}

			}

		}

		$total = $main_count + $child_count;

		return $total;

	}

}



/*======
*
* Finding Attachment ID from Guid
*
======*/
if( !function_exists( 'eventchamp_attachment_id' ) ) {

	function eventchamp_attachment_id( $url ) {

		$attachment_id = 0;
		$dir = wp_upload_dir();

		if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) {

			$file = basename( $url );
			$query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'fields'      => 'ids',
				'meta_query'  => array(
					array(
						'value'   => $file,
						'compare' => 'LIKE',
						'key'     => '_wp_attachment_metadata',
					),
				)
			);
			$query = new WP_Query( $query_args );

			if ( $query->have_posts() ) {

				foreach ( $query->posts as $post_id ) {

					if( !empty( $post_id ) ) {

						$meta = wp_get_attachment_metadata( $post_id );
						$original_file       = basename( $meta['file'] );
						$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );

						if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
							$attachment_id = $post_id;
							break;
						}

					}

				}

			}

		}

		return $attachment_id;

	}

}



/*======
*
* Add Pingback to Header
*
======*/
function eventchamp_pingback_add_header() {

	if( is_singular() && pings_open() ) {

		echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';

	}

}
add_action( 'wp_head', 'eventchamp_pingback_add_header' );