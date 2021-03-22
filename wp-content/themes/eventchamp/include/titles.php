<?php
/*======
*
* Page Titles
*
======*/
if( !function_exists( 'eventchamp_page_titles' ) ) {

	function eventchamp_page_titles() {

		if( is_category() ) {

			$title = single_cat_title( '', false );

		} elseif( is_tag() ) {

			$title = single_tag_title( '', false );

		} elseif( is_search() ) {

			$title = get_search_query();

		} elseif( is_author() ) {

			$title = get_the_author();

		} elseif( is_home() ) {

			$title = esc_html__( 'Home', 'eventchamp' );

		} elseif( is_404() ) {

			$title = esc_html__( '404 Page', 'eventchamp' );

		} elseif( is_attachment() or is_page() or is_single() ) {

			$title = get_the_title();

		} elseif( is_post_type_archive() ) {

			$title = post_type_archive_title( '', false );

		} elseif( is_tax() ) {

			$title = single_term_title( '', false );

		} else {

			if ( is_day() or is_month() or is_year() ) {

				$title = get_the_archive_title();

			} else {

				$title = esc_html__( 'Archive', 'eventchamp' );
			}

		}

		return $title;

	}

}



/*======
*
* Page Title Bar
*
======*/
if( !function_exists( 'eventchamp_page_title_bar' ) ) {

	function eventchamp_page_title_bar() {

		$output = '';
		$page_title_bar = ot_get_option( 'page_title_bar', 'on' );
		$breadcrumbs = ot_get_option( 'page_title_bar_breadcrumbs', 'on' );

		if( is_page() or is_single() ) {

			$page_title_bar = get_post_meta( get_the_ID(), 'page_title', true );

			if( empty( $page_title_bar ) or $page_title_bar == "default" ) {

				$page_title_bar = ot_get_option( 'page_title_bar', 'on' );

			}

		}

		if( $page_title_bar == 'on' ) {

			$output .= '<div class="gt-page-title-bar">';

				if( is_singular( 'event' ) or is_singular( 'venue' ) or is_singular( 'speaker' ) or is_singular( 'post' ) or is_page() ) {

					if( is_singular( 'event' ) ) {

						$background = get_post_meta( get_the_ID(), 'event_custom_title_bg', true );

					} else {

						$background = get_post_meta( get_the_ID(), 'custom_title_bg', true );

					}

					if ( !empty( $background ) ) {

						$output .= '<div class="gt-background" style="background-image:url(' . esc_url( $background ) . ');"></div>';

					} else {

						$output .= '<div class="gt-background"></div>';

					}

				} else {

					$output .= '<div class="gt-background"></div>';

				}
				
				$output .= '<div class="container">';
					$output .= '<h1>' . eventchamp_page_titles() . '</h1>';

					if( is_tax() or is_category() ) {

						$category_description = category_description();

						if( !empty( $category_description ) ) {

							$output .= wpautop( category_description() );

						}

					}

					if( $breadcrumbs == 'on' ) {

						$output .= eventchamp_breadcrumbs();

					}

				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Content Titles
*
======*/
if( !function_exists( 'eventchamp_section_title' ) ) {

	function eventchamp_section_title( $primary_title = "", $secondary_title = "", $text = "", $style = "dark", $size = "size1", $align = "center", $separator = "true", $icon = "" ) {

		$output = "";

		if( !empty( $primary_title ) or !empty( $secondary_title ) ) {

			$output .= '<div class="gt-heading gt-' . esc_attr( $style ) . ' gt-' . esc_attr( $style ) . ' gt-align-' . esc_attr( $align ) . '">';
				$output .= '<div class="gt-title">';

					if( !empty( $primary_title ) ) {

						$output .= esc_attr( $primary_title );

					}

					if( !empty( $primary_title ) and !empty( $secondary_title ) ) {
						$output .= ' ';
					}

					if( !empty( $secondary_title ) ) {

						$output .= '<span>';
							$output .= esc_attr( $secondary_title );
						$output .= '</span>';

					}

				$output .= '</div>';

				if( $separator == "true" ) {

					$output .= '<div class="gt-separate">';

						if( !empty( $icon ) ) {

							$output .= '<i class="' . esc_attr( $icon ) . '"></i>';

						} else {
							$output .= '<i class="fas fa-cubes"></i>';

						}

					$output .= '</div>';

				}

				if( !empty( $text ) ) {

					$output .= '<div class="gt-text">' . esc_attr( $text ) . '</div>';

				}

			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Content Titles
*
======*/
if( !function_exists( 'eventchamp_content_title' ) ) {

	function eventchamp_content_title( $title = "", $sec_title = "", $text = "", $separate = "", $icon = "" ) {

		$output = "";

		$output .= '<div class="gt-heading gt-dark gt-size1 gt-align-center">';

			if( !empty( $title ) ) {

				$output .= '<div class="gt-title">';

					if( !empty( $title ) ) {

						$output .= esc_attr( $title );

					}

					if( !empty( $title ) and !empty( $sec_title ) ) {

						$output .= ' ';

					}

					if( !empty( $sec_title ) ) {

						$output .= '<span>' . esc_attr( $sec_title ) . '</span>';

					}

				$output .= '</div>';

			}

			if( $separate == "true" ) {

				$output .= '<div class="gt-separate">';

					if( !empty( $icon ) ) {

						$output .= '<i class="' . esc_attr( $icon ) . '" aria-hidden="true"></i>';

					} else {

						$output .= '<i class="fas fa-cubes" aria-hidden="true"></i>';

					}

				$output .= '</div>';

			}

			if( !empty( $text ) ) {

				$output .= '<div class="gt-text">';
					$output .= esc_attr( $text );
				$output .= '</div>';

			}

		$output .= '</div>';

		return $output;

	}

}



/*======
*
* Content Alternative Title
*
======*/
if( !function_exists( 'eventchamp_content_alternative_title' ) ) {

	function eventchamp_content_alternative_title( $text = "" ) {

		echo '<span class="content-alternative-wrapper-title">' . $text . '</span>';

	}

}