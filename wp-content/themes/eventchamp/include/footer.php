<?php
/*======
*
* Footer
*
======*/
if( !function_exists( 'eventchamp_footer' ) ) {

	function eventchamp_footer() {

		if( !function_exists( 'eventchamp_copyright' ) ) {

			function eventchamp_copyright() {

				$output = "";
				$hide_footer_logo = ot_get_option( 'hide_footer_logo', 'on' );
				$eventchamp_footer_logo = ot_get_option( 'eventchamp_footer_logo' );
				$footer_logo_attachment_id = eventchamp_attachment_id( $eventchamp_footer_logo );
				$logo_height = ot_get_option( 'footer_logo_height' );
				$logo_width = ot_get_option( 'footer_logo_width' );
				$footer_copyright_text = ot_get_option( 'footer_copyright_text' );

				if( !empty( $logo_height ) ) {

					$logo_height = ' height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"';

				}

				if( !empty( $logo_width ) ) {

					$logo_width = ' width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"';

				}

				if( !empty( $footer_copyright_text ) or $hide_footer_logo == "on" or !empty( $eventchamp_footer_logo )  ) {

					$output .= '<div class="gt-copyright">';
						$output .= '<div class="container">';

							if( $hide_footer_logo == "on" ) {

								if( !empty( $eventchamp_footer_logo ) ) {

									$output .= '<a href="' . esc_url( home_url( '/' ) ) . '" class="gt-logo">';
										$output .= '<img src="' . esc_url( wp_get_attachment_url( $footer_logo_attachment_id ) ) . '" srcset="' . wp_get_attachment_image_srcset( $footer_logo_attachment_id, 'full' ) . '" alt="' . get_bloginfo( 'name' ) . '"' . $logo_height . ' ' . $logo_width . ' />';
									$output .= '</a>';

								}

							}

							if( !empty( $footer_copyright_text ) ) {

								$output .= wpautop( ot_get_option( 'footer_copyright_text' ) );

							}

						$output .= '</div>';
					$output .= '</div>';

				}

				return $output;

			}

		}



		if( !function_exists( 'eventchamp_footer_style_1' ) ) {

			function eventchamp_footer_style_1() {

				$output = "";
				$footer_gap = "";
				$footer_page = ot_get_option( 'page_footer_style_1' );

				if ( is_page() or is_single() ) {

					$footer_gap = get_post_meta( get_the_ID(), 'footer_gap', true );

				}

				if( !empty( $footer_page ) ) {

					if( $footer_gap == "on" or empty( $footer_gap ) ) {

						$output .= '<footer class="gt-footer gt-style-1">';

					} else {

						$output .= '<footer class="gt-footer gt-style-1 gt-remove-gap">';

					}

						$output .= '<div class="container">';

							$args = array(
								'p' => $footer_page,
								'ignore_sticky_posts' => true,
								'post_type' => 'page',
								'post_status' => 'publish'
							);
							$wp_query = new WP_Query( $args );

							while ( $wp_query->have_posts() ) {

								if ( $wp_query->have_posts() ) {

									$wp_query->the_post();

									$output .= '<div class="gt-footer-content">';
										$output .= do_shortcode( get_the_content( get_the_ID() ) );
									$output .= '</div>';

								}

							}
							wp_reset_postdata();
						$output .= '</div>';
						$output .= eventchamp_copyright();
					$output .= '</footer>';

				}

				return $output;

			}

		}



		if( !function_exists( 'eventchamp_footer_style_2' ) ) {

			function eventchamp_footer_style_2() {

				$output = "";
				$footer_gap = "";

				$footer_page = ot_get_option( 'page_footer_style_1' );
				if ( is_page() or is_single() ) {

					$footer_gap = get_post_meta( get_the_ID(), 'footer_gap', true );

				}

				if( !empty( $footer_page ) ) {

					if( $footer_gap == "on" or empty( $footer_gap ) ) {

						$output .= '<footer class="gt-footer gt-style-2">';

					} else {

						$output .= '<footer class="gt-footer gt-style-2 gt-remove-gap">';

					}

						$output .= '<div class="container">';
							$args = array(
								'p' => $footer_page,
								'ignore_sticky_posts' => true,
								'post_type' => 'page',
								'post_status' => 'publish'
							);
							$wp_query = new WP_Query( $args );

							while ( $wp_query->have_posts() ) {

								if ( $wp_query->have_posts() ) {

									$wp_query->the_post();

									$output .= '<div class="gt-footer-content">';
										$output .= do_shortcode( get_the_content( get_the_ID() ) );
									$output .= '</div>';

								}

							}
							wp_reset_postdata();
						$output .= '</div>';
						$output .= eventchamp_copyright();
					$output .= '</footer>';
				}

				return $output;

			}

		}



		if ( is_page() ) {

			global $post;
			$header_style = get_post_meta( $post->ID, 'footer_layout_select', true );
			$footer_status = get_post_meta( $post->ID, 'footer_status', true );

			if( empty( $header_style ) or $header_style == "default" ) {

				$header_style = ot_get_option( 'default_footer_style' , 'footer-style-1' );

			}

			if( empty( $footer_status ) or $footer_status == "default" ) {

				$footer_status = ot_get_option( 'hide_footer' , 'on' );

			}

		} else {

			$header_style = ot_get_option( 'default_footer_style' , 'footer-style-1' );
			$footer_status = ot_get_option( 'hide_footer' , 'on' );

		}

		if( $footer_status == "on" ) {

			if( $header_style == "footer-style-1" ) {

				if( function_exists( 'eventchamp_footer_style_1' ) ) {

					echo eventchamp_footer_style_1();

				}

			} elseif( $header_style == "footer-style-2" ) {

				if( function_exists( 'eventchamp_footer_style_2' ) ) {

					echo eventchamp_footer_style_2();

				}

			}

		}

	}

}