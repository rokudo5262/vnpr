<?php
/*======
*
* Label
*
======*/
if( !function_exists( 'eventchamp_label' ) ) {

	function eventchamp_label( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$labels = get_post_meta( $id, 'labels', true );
			$labels_status = get_post_meta( $id, 'labels_status', true );

			if( !$labels_status == 'off' or $labels_status == "on" ) {

				if( !empty( $labels ) ) {

					foreach( $labels as $label ) {

						if( !empty( $label ) ) {

							$style = $label["style"];

							if( empty( $style ) ) {

								$style = "style-1";

							}

							$position = $label["position"];

							if( empty( $position ) ) {

								$position = "top-left";

							}

							$text = $label["title"];
							$link = $label["link"];
							$target = $label["target"];

							if( empty( $target ) ) {

								$target = "_self";

							}

							/*====== Label ID ======*/
							$label_id_class = "gt-label-" . esc_attr( $id );

							/*====== HTML Output ======*/
							$output .= '<div class="gt-label gt-' . esc_attr( $style ) . ' gt-position-' . esc_attr( $position ) . ' ' . esc_attr( $label_id_class ) . '">';

								if( !empty( $link ) and !empty( $text ) ) {

									$output .= '<a href="' . esc_url( $link ) . '" target="' . esc_url( $target ) . '">' . esc_attr( $text ) . '</a>';

								} elseif( !empty( $text ) ) {

									$output .= '<span>' . esc_attr( $text ) . '</span>';

								}

							$output .= '</div>';

						}

					}

				}

			}

		}

		return $output;

	}

}



/*======
*
* Label CSS Output
*
======*/
if( !function_exists( 'eventchamp_custom_label' ) ) {

	function eventchamp_custom_label() {

		$label_css = "";
		$args = array(
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'post_type' => 'event',
		);

		$wp_query = new WP_Query( $args );

		if( !empty( $wp_query ) ) {

			while ( $wp_query->have_posts() ) {

				$wp_query->the_post();

				$labels = get_post_meta( get_the_ID(), 'labels', true );
				$labels_status = get_post_meta( get_the_ID(), 'labels_status', true );

				if( !$labels_status == 'off' or $labels_status == "on" ) {

					if( !empty( $labels ) ) {

						foreach( $labels as $label ) {

							if( !empty( $label ) ) {

								$label_id_class = "gt-label-" . esc_attr( get_the_ID() );
								$background = $label["background"];

								if( !empty( $label["top-position"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{top: " . esc_attr( $label["top-position"] ) . " !important;}";

								}

								if( !empty( $label["bottom-position"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{bottom: " . esc_attr( $label["bottom-position"] ) . " !important;}";

								}

								if( !empty( $label["left-position"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{left: " . esc_attr( $label["left-position"] ) . " !important;}";

								}

								if( !empty( $label["right-position"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{right: " . esc_attr( $label["right-position"] ) . " !important;}";

								}

								if( !empty( $label["height"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{height: " . esc_attr( $label["height"] ) . " !important;}";

								}

								if( !empty( $label["width"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{width: " . esc_attr( $label["width"] ) . " !important;}";

								}

								if( !empty( $label["z-index"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{z-index: " . esc_attr( $label["z-index"] ) . " !important;}";

								}

								if( !empty( $background["background-color"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{background-color: " . esc_attr( $background["background-color"] ) . " !important;}";

								}

								if( !empty( $background["background-repeat"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{background-repeat: " . esc_attr( $background["background-repeat"] ) . " !important;}";

								}

								if( !empty( $background["background-attachment"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{background-attachment: " . esc_attr( $background["background-attachment"] ) . " !important;}";

								}

								if( !empty( $background["background-position"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{background-position: " . esc_attr( $background["background-position"] ) . " !important;}";

								}

								if( !empty( $background["background-size"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{background-size: " . esc_attr( $background["background-size"] ) . " !important;}";

								}

								if( !empty( $background["background-image"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{background-image: url(" . esc_attr( $background["background-image"] ) . ") !important;}";

								}

								if( !empty( $label["text-color"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . " a{color: " . esc_attr( $label["text-color"] ) . " !important;}";

								}

								if( !empty( $label["text-color"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . " a:visited{color: " . esc_attr( $label["text-color"] ) . " !important;}";

								}

								if( !empty( $label["text-color"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . " span{color: " . esc_attr( $label["text-color"] ) . " !important;}";

								}

								if( !empty( $label["font-size"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{font-size: " . esc_attr( $label["font-size"] ) . " !important;}";

								}

								if( !empty( $label["top-padding"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{padding-top: " . esc_attr( $label["top-padding"] ) . " !important;}";

								}

								if( !empty( $label["bottom-padding"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{padding-bottom: " . esc_attr( $label["bottom-padding"] ) . " !important;}";

								}

								if( !empty( $label["left-padding"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{padding-left: " . esc_attr( $label["left-padding"] ) . " !important;}";

								}

								if( !empty( $label["right-padding"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{padding-right: " . esc_attr( $label["right-padding"] ) . " !important;}";

								}

								if( !empty( $label["border-color"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-color: " . esc_attr( $label["border-color"] ) . " !important;}";

								}

								if( !empty( $label["border-style"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-style: " . esc_attr( $label["border-style"] ) . " !important;}";

								}

								if( !empty( $label["border-top-width"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-top-width: " . esc_attr( $label["border-top-width"] ) . " !important;}";

								}

								if( !empty( $label["border-bottom-width"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-bottom-width: " . esc_attr( $label["border-bottom-width"] ) . " !important;}";

								}

								if( !empty( $label["border-right-width"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-right-width: " . esc_attr( $label["border-right-width"] ) . " !important;}";

								}

								if( !empty( $label["border-left-width"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-left-width: " . esc_attr( $label["border-left-width"] ) . " !important;}";

								}

								if( !empty( $label["border-top-left-radius"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-top-left-radius: " . esc_attr( $label["border-top-left-radius"] ) . " !important;}";

								}

								if( !empty( $label["border-top-right-radius"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-top-right-radius: " . esc_attr( $label["border-top-right-radius"] ) . " !important;}";

								}

								if( !empty( $label["border-bottom-left-radius"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-bottom-left-radius: " . esc_attr( $label["border-bottom-left-radius"] ) . " !important;}";

								}

								if( !empty( $label["border-bottom-right-radius"] ) ) {

									$label_css .= "." . esc_attr( $label_id_class ) . "{border-bottom-right-radius: " . esc_attr( $label["border-bottom-right-radius"] ) . " !important;}";

								}

							}

						}

					}

				}

			}

		}
		wp_reset_postdata();

		wp_add_inline_style( 'eventchamp', $label_css );

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_custom_label' );

}