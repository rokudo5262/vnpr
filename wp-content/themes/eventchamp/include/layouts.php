<?php
/*======
*
* Sidebar & Content Layout
*
======*/
if( !function_exists( 'eventchamp_content_area_before' ) ) {

	function eventchamp_content_area_before() {

		$output = "";

		if ( is_post_type_archive( 'event' ) or is_tax( 'event_tags' ) or is_tax( 'eventcat' ) or is_tax( 'organizer' ) ) {

			$sidebar_position = ot_get_option( 'event_sidebar_position', 'right' );

		} elseif ( is_post_type_archive( 'venue' ) or is_tax( 'venue_tags' ) or is_tax( 'venuecat' ) ) {

			$sidebar_position = ot_get_option( 'venue_sidebar_position', 'right' );

		} elseif ( is_post_type_archive( 'speaker' ) or is_tax( 'speaker-tags' ) or is_tax( 'speaker-category' ) ) {

			$sidebar_position = ot_get_option( 'speaker_sidebar_position', 'right' );

		} elseif( is_category() ) {

			$sidebar_position = ot_get_option( 'category_sidebar_position', 'right' );

		} elseif( is_tag() ) {

			$sidebar_position = ot_get_option( 'tag_sidebar_position', 'right' );

		} elseif( is_author() ) {

			$sidebar_position = ot_get_option( 'author_sidebar_position', 'right' );

		} elseif( is_search() ) {

			$sidebar_position = ot_get_option( 'search_sidebar_position', 'right' );

		} elseif( is_archive() ) {

			$sidebar_position = ot_get_option( 'archive_sidebar_position', 'right' );

		} elseif( is_attachment() ) {

			$sidebar_position = ot_get_option( 'attachment_sidebar_position', 'nosidebar' );

		} elseif( is_singular( 'event' ) or is_singular( 'venue' ) or is_singular( 'speaker' ) ) {

			$sidebar_position = "right";

		} elseif( is_single() ) {

			$sidebar_position = get_post_meta( get_the_ID(), 'sidebar_position', true );

			if( empty( $sidebar_position ) or $sidebar_position == "default" ) {

				$sidebar_position = ot_get_option( 'post_sidebar_position', 'right' );

			}

		} elseif( is_page() ) {

			$sidebar_position = get_post_meta( get_the_ID(), 'sidebar_position', true );

			if( empty( $sidebar_position ) or $sidebar_position == "default" ) {

				$sidebar_position = ot_get_option( 'page_sidebar_position', 'nosidebar' );

			}

		} else {

			$sidebar_position = ot_get_option( 'sidebar_position', 'right' );

		}

		if( $sidebar_position == 'nosidebar' ) {

			$output = '<div class="col-md-12 col-sm-12 col-xs-12 gt-site-left gt-full-width-site">';

		} elseif( $sidebar_position == 'left' ) {

			$output = '<div class="col-md-8 col-sm-12 col-xs-12 gt-site-left gt-fixed-sidebar">';

		} elseif( $sidebar_position == 'right' ) {

			$output = '<div class="col-md-8 col-sm-12 col-xs-12 gt-site-left gt-fixed-sidebar">';

		}

		return $output;

	}

}



if( !function_exists( 'eventchamp_content_area_after' ) ) {

	function eventchamp_content_area_after() {

		$output = '</div>';

		return $output;

	}

}



if( !function_exists( 'eventchamp_sidebar_before' ) ) {

	function eventchamp_sidebar_before() {

		$output = "";

		if ( is_post_type_archive( 'event' ) or is_tax( 'event_tags' ) or is_tax( 'eventcat' ) or is_tax( 'organizer' ) ) {

			$sidebar_position = ot_get_option( 'event_sidebar_position', 'right' );

		} elseif ( is_post_type_archive( 'venue' ) or is_tax( 'venue_tags' ) or is_tax( 'venuecat' ) ) {

			$sidebar_position = ot_get_option( 'venue_sidebar_position', 'right' );

		} elseif ( is_post_type_archive( 'speaker' ) or is_tax( 'speaker-tags' ) or is_tax( 'speaker-category' ) ) {

			$sidebar_position = ot_get_option( 'speaker_sidebar_position', 'right' );

		} elseif( is_category() ) {

			$sidebar_position = ot_get_option( 'category_sidebar_position', 'right' );

		} elseif( is_tag() ) {

			$sidebar_position = ot_get_option( 'tag_sidebar_position', 'right' );

		} elseif( is_author() ) {

			$sidebar_position = ot_get_option( 'author_sidebar_position', 'right' );

		} elseif( is_search() ) {

			$sidebar_position = ot_get_option( 'search_sidebar_position', 'right' );

		} elseif( is_archive() ) {

			$sidebar_position = ot_get_option( 'archive_sidebar_position', 'right' );

		} elseif( is_attachment() ) {

			$sidebar_position = ot_get_option( 'attachment_sidebar_position', 'nosidebar' );

		} elseif( is_singular( 'event' ) or is_singular( 'venue' ) or is_singular( 'speaker' ) ) {

			$sidebar_position = "right";

		} elseif( is_single() ) {

			$sidebar_position = get_post_meta( get_the_ID(), 'sidebar_position', true );

			if( empty( $sidebar_position ) or $sidebar_position == "default" ) {

				$sidebar_position = ot_get_option( 'post_sidebar_position', 'right' );

			}

		} elseif( is_page() ) {

			$sidebar_position = get_post_meta( get_the_ID(), 'sidebar_position', true );

			if( empty( $sidebar_position ) or $sidebar_position == "default" ) {

				$sidebar_position = ot_get_option( 'page_sidebar_position', 'nosidebar' );

			}

		} else {

			$sidebar_position = ot_get_option( 'sidebar_position', 'right' );

		}

		if( $sidebar_position == 'nosidebar' ) {

			$output .= '<div class="col-md-12 col-sm-12 col-xs-12 gt-site-right d-none gt-fixed-sidebar">';
				$output .= '<div class="theiaStickySidebar">';

		} elseif( $sidebar_position == 'left' ) {

			$output .= '<div class="col-md-4 col-sm-12 col-xs-12 gt-site-right gt-pull-left gt-fixed-sidebar">';
				$output .= '<div class="theiaStickySidebar">';

		} elseif( $sidebar_position == 'right' ) {

			$output .= '<div class="col-md-4 col-sm-12 col-xs-12 gt-site-right gt-fixed-sidebar">';
				$output .= '<div class="theiaStickySidebar">';

		}

		return $output;

	}

}



if( !function_exists( 'eventchamp_sidebar_after' ) ) {

	function eventchamp_sidebar_after() {

			$output = '</div>';
		$output .= '</div>';

		return $output;

	}

}



/*======
*
* Wrapper Layout
*
======*/
if( !function_exists( 'eventchamp_wrapper_before' ) ) {

	function eventchamp_wrapper_before() {

		$eventchamp_boxed = ot_get_option( 'eventchamp_boxed', 'off' );

		if( $eventchamp_boxed == "on" ) {

			$eventchamp_boxed = "gt-boxed-active";

		}

		$output = '<div class="gt-site-wrapper ' . esc_attr( $eventchamp_boxed ) . '">';

		return $output;

	}

}



if( !function_exists( 'eventchamp_wrapper_after' ) ) {

	function eventchamp_wrapper_after() {

		$output = '</div>';

		return $output;

	}

}



/*======
*
* Theme Sub Content Layout
*
======*/
if( !function_exists( 'eventchamp_sub_content_before' ) ) {

	function eventchamp_sub_content_before() {

		$output = '<div class="gt-site-inner">';

		return $output;

	}

}



if( !function_exists( 'eventchamp_sub_content_after' ) ) {

	function eventchamp_sub_content_after() {

		$output = '</div>';

		return $output;

	}

}



/*======
*
* Widget Layout
*
======*/
if( !function_exists( 'eventchamp_widget_before' ) ) {

	function eventchamp_widget_before() {

		$output = '<div class="gt-widget-content">';

		return $output;

	}

}



if( !function_exists( 'eventchamp_widget_after' ) ) {

	function eventchamp_widget_after() {

		$output = '</div>';

		return $output;

	}

}



/*======
*
* Page Content Layout
*
======*/
if( !function_exists( 'eventchamp_page_content_before' ) ) {

	function eventchamp_page_content_before() {

		$output = '<div class="gt-site-page-content">';

		return $output;

	}

}



if( !function_exists( 'eventchamp_page_content_after' ) ) {

	function eventchamp_page_content_after() {

		$output = '</div>';

		return $output;

	}

}



/*======
*
* Row
*
======*/
if( !function_exists( 'eventchamp_row_before' ) ) {

	function eventchamp_row_before() {

		$output = '<div class="row">';

		return $output;

	}

}



if( !function_exists( 'eventchamp_row_after' ) ) {

	function eventchamp_row_after() {

		$output = '</div>';

		return $output;

	}

}



/*======
*
* Container
*
======*/
if( !function_exists( 'eventchamp_container_before' ) ) {

	function eventchamp_container_before() {

		$output = '<div class="container">';

		return $output;

	}

}



if( !function_exists( 'eventchamp_container_after' ) ) {

	function eventchamp_container_after() {

		$output = '</div>';

		return $output;

	}

}