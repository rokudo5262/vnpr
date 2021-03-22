<?php
/*======
*
* Pagination for Archive
*
======*/
if( !function_exists( 'eventchamp_pagination' ) ) {

	function eventchamp_pagination() {

		$output = "";
		$pagination_style = ot_get_option( 'pagination-style', '1' );

		if( $pagination_style == "1" ) {

			$output .= '<nav class="gt-pagination">';
				$output .= '<ul>';

					if( !empty( get_previous_posts_link() ) ) {

						$output .= '<li>';
							$output .= get_previous_posts_link( esc_html__( 'Previous', 'eventchamp' ) );
						$output .= '</li>';

					}

					if( !empty( get_next_posts_link() ) ) {

						$output .= '<li>';
							$output .= get_next_posts_link( esc_html__( 'Next', 'eventchamp' ) );
						$output .= '</li>';

					}

				$output .= '</ul>';
			$output .= '</nav>';

		} else {

			$args = array(
				'prev_text' => esc_html__( 'Previous', 'eventchamp' ),
				'next_text' => esc_html__( 'Next', 'eventchamp' ),
				'type' => 'list',
			);

			if( !empty( paginate_links( $args ) ) ) {

				$output .= '<nav class="gt-pagination">';
					$output .= paginate_links( $args );
				$output .= '</nav>';

			}

		}

		return $output;

	}

}



/*======
*
* Pagination for Elements
*
======*/
if( !function_exists( 'eventchamp_element_pagination' ) ) {

	function eventchamp_element_pagination( $paged = "", $query = "" ) {

		$output = "";
		$pagination_style = ot_get_option( 'pagination-style', '1' );

		if( !empty( $paged ) or !empty( $query ) ) {

			if( $pagination_style == "1" ) {

				$prev_link = get_previous_posts_link();
				$next_link = get_next_posts_link( esc_html__( 'Next', 'eventchamp' ), $query->max_num_pages );

				if( !empty( $prev_link ) or !empty( $next_link ) ) {

					$output .= '<nav class="gt-pagination">';
						$output .= '<ul>';

							if( !empty( $prev_link ) ) {

								$output .= '<li>';
									$output .= get_previous_posts_link( esc_html__( 'Previous', 'eventchamp' ) );
								$output .= '</li>';	

							}

							if( !empty( $next_link ) ) {

								$output .= '<li>';
									$output .= get_next_posts_link( esc_html__( 'Next', 'eventchamp' ), $query->max_num_pages );
								$output .= '</li>';

							}

						$output .= '</ul>';
					$output .= '</nav>';

				}

			} else {

				$args = array(
					'prev_text' => esc_html__( 'Previous', 'eventchamp' ),
					'next_text' => esc_html__( 'Next', 'eventchamp' ),
					'current' => $paged,
					'total' => $query->max_num_pages,
					'type' => 'list',
				);

				if( !empty( paginate_links( $args ) ) ) {

					$output .= '<nav class="gt-pagination">';
						$output .= paginate_links( $args );
					$output .= '</nav>';

				}

			}

		}

		return $output;

	}

}