<?php
/*======
*
* Page Header
*
======*/
if( !function_exists( 'eventchamp_page_header' ) ) {

	function eventchamp_page_header( $id = "" ) {

		$output = "";
		$slider_column = ot_get_option( 'page-header-image-slider-column', '1' );
		$slider_space = ot_get_option( 'page-header-image-slider-space', '0' );
		$slider_loop = ot_get_option( 'page-header-image-slider-loop', 'true' );
		$slider_autoplay = ot_get_option( 'page-header-image-slider-autoplay', 'true' );
		$slider_autoplay_delay = ot_get_option( 'page-header-image-slider-autoplay-delay', '1500' );
		$slider_direction = ot_get_option( 'page-header-image-slider-direction', 'horizontal' );
		$slider_effect = ot_get_option( 'page-header-image-slider-effect', 'slide' );

		if( !empty( $id ) ) {

			$header_status = get_post_meta( esc_attr( $id ), 'page-content-header-status', true );

			if( empty( $header_status ) or $header_status == "default" ) {

				$header_status = ot_get_option( 'page-header-status', 'true' );

			}

			$header_type = get_post_meta( esc_attr( $id ), 'page-content-header-style', true );

			if( $header_type == "default" or empty( $header_type ) ) {

				$header_type = ot_get_option( 'page-header-style', 'image' );

			}

			$image_gallery = explode( ',', get_post_meta( esc_attr( $id ), 'page-gallery-images', true ) );
			$featured_image = get_post_meta( esc_attr( $id ), 'page-featured-image', true );
			$code = get_post_meta( esc_attr( $id ), 'header-type-code', true );

			if( $header_status == "true" ) {

				if( !empty( $header_type ) ) {

					if( $header_type == "image-slider" ) {

						if( !empty( $image_gallery ) ) {

							$output .= '<div class="gt-content-header gt-image-slider">';
								$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item="' . esc_attr( $slider_column ) . '" data-gt-item-space="' . esc_attr( $slider_space ) . '" data-gt-loop="' . esc_attr( $slider_loop ) . '" data-gt-speed="1500" data-gt-direction="' . esc_attr( $slider_direction ) . '" data-gt-effect="' . esc_attr( $slider_effect ) . '" data-gt-centered-slides="false" data-gt-free-mode="false">';
									$output .= '<div class="swiper-wrapper">';

										foreach( $image_gallery as $image ) {

											if( !empty( $image ) ) {

												if( $slider_autoplay ) {

													$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $slider_autoplay_delay ) . '">';

												} else {

													$output .= '<div class="swiper-slide">';

												}

													$output .= wp_get_attachment_image( esc_attr( $image ), 'eventchamp-content-header', true, true );
												$output .= '</div>';
											}

										}

									$output .= '</div>';
									$output .= '<div class="gt-slider-prev gt-slider-control">';
										$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
									$output .= '</div>';
									$output .= '<div class="gt-slider-next gt-slider-control">';
										$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div>';

						}

					} elseif( $header_type == "image-gallery" ) {

						if( !empty( $image_gallery ) ) {

							$output .= '<div class="gt-content-header gt-image-gallery">';

								foreach( $image_gallery as $image ) {

									if( !empty( $image ) ) {

										$output .= '<div class="gt-item">';
											$output .= '<a href="' . esc_url( wp_get_attachment_image_src( esc_attr( $image ), 'full', true, true )[0] ) . '" data-srcset="' . wp_get_attachment_image_srcset( esc_attr( $image ), 'full' ) . '" data-caption="' . wp_get_attachment_caption( esc_attr( $image ) ) . '" data-fancybox="page-featured-images">';
												$output .= wp_get_attachment_image( esc_attr( $image ), 'eventchamp-thumbnail', true, true );
											$output .= '</a>';
										$output .= '</div>';

									}

								}

							$output .= '</div>';

						}

					} elseif( $header_type == "video" or $header_type == "audio" or $header_type == "code" ) {

						if( !empty( $code ) ) {

							$output .= '<div class="gt-content-header gt-code">';
								$output .= get_post_meta( esc_attr( $id ), 'header-type-code', true );
							$output .= '</div>';

						}

					} elseif( $header_type == "image" ) {

						if( !empty( $featured_image ) ) {

							$output .= '<div class="gt-content-header gt-image">';
								$output .= wp_get_attachment_image( eventchamp_attachment_id( $featured_image ), 'eventchamp-content-header', true, true );
							$output .= '</div>';

						} elseif ( has_post_thumbnail() ) {

							$output .= '<div class="gt-content-header gt-image">';
								$output .= get_the_post_thumbnail( $id, 'eventchamp-content-header' );
							$output .= '</div>';

						}

					} else {

						if ( has_post_thumbnail() ) {

							$output .= '<div class="gt-content-header gt-image">';
								$output .= get_the_post_thumbnail( $id, 'eventchamp-content-header' );
							$output .= '</div>';

						}

					}

				} else {

					if ( has_post_thumbnail() ) {

						$output .= '<div class="gt-content-header gt-image">';
							$output .= get_the_post_thumbnail( $id, 'eventchamp-content-header' );
						$output .= '</div>';

					}

				}

			}

		}

		return $output;

	}

}