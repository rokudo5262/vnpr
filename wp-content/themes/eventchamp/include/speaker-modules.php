<?php
/*======
*
* Speaker Styles
*
======*/
	/*====== Speaker Style 1 ======*/
	if( !function_exists( 'eventchamp_speaker_style_1' ) ) {

		function eventchamp_speaker_style_1( $post_id = "", $image = "true", $profession = "true", $summary = "true", $social = "true" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$speaker_photo = get_post_meta( esc_attr( $post_id ), 'speaker-profile-photo', true );
				$speaker_profession = get_post_meta( esc_attr( $post_id ), 'speaker_profession', true );
				$speaker_summary = get_post_meta( esc_attr( $post_id ), 'speaker-short-biography', true );
				$speaker_social_links = get_post_meta( esc_attr( $post_id ), 'social-links', true );

				$output .= '<div class="gt-speaker gt-style-1">';

					if( $image == 'true' ) {

						if( !empty( $speaker_photo ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( eventchamp_attachment_id( $speaker_photo ), 'eventchamp-speaker', true, true );
								$output .= '</a>';
							$output .= '</div>';

						} elseif ( has_post_thumbnail( $post_id ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( get_post_thumbnail_id( esc_attr( $post_id ) ), 'eventchamp-speaker' );
								$output .= '</a>';
							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-name">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( esc_attr( $post_id ) ) . '</a>';
						$output .= '</div>';

						if( $profession == 'true' and !empty( $speaker_profession ) ) {

							$output .= '<div class="gt-profession">' . esc_attr( $speaker_profession ) . '</div>';

						}

						if( $summary == 'true' and !empty( $speaker_summary ) ) {

							$output .= '<div class="gt-text">';
								$output .= esc_attr( $speaker_summary );
							$output .= '</div>';

						}

						if( $social == 'true' and !empty( $speaker_social_links ) and !empty( eventchamp_social_media_sites( $custom_links = $speaker_social_links ) ) ) {

							$output .= '<div class="gt-social-links">';
								$output .= eventchamp_social_media_sites( $custom_links = $speaker_social_links );
							$output .= '</div>';

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;

		}

	}



	/*====== Speaker Style 2 ======*/
	if( !function_exists( 'eventchamp_speaker_style_2' ) ) {

		function eventchamp_speaker_style_2( $post_id = "", $image = "true", $profession = "true", $summary = "true", $social = "true" ) {
			$output  = "";

			if( !empty( $post_id ) ) {

				$speaker_photo = get_post_meta( esc_attr( $post_id ), 'speaker-profile-photo', true );
				$speaker_profession = get_post_meta( esc_attr( $post_id ), 'speaker_profession', true );
				$speaker_summary = get_post_meta( esc_attr( $post_id ), 'speaker-short-biography', true );
				$speaker_social_links = get_post_meta( esc_attr( $post_id ), 'social-links', true );

				$output .= '<div class="gt-speaker gt-style-2">';

					if( $image == 'true' ) {

						if( !empty( $speaker_photo ) ) {

							$output .= '<div class="gt-image">';
								$output .= wp_get_attachment_image( eventchamp_attachment_id( $speaker_photo ), 'eventchamp-speaker', true, true );
							$output .= '</div>';

						} elseif ( has_post_thumbnail( $post_id ) ) {

							$output .= '<div class="gt-image">';
								$output .= wp_get_attachment_image( get_post_thumbnail_id( esc_attr( $post_id ) ), 'eventchamp-speaker' );
							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '"></a>';

						$output .= '<div class="gt-name">' . get_the_title( esc_attr( $post_id ) ) . '</div>';

						if( $profession == 'true' and !empty( $speaker_profession ) ) {

							$output .= '<div class="gt-profession">' . esc_attr( $speaker_profession ) . '</div>';

						}

						if( $summary == 'true' and !empty( $speaker_summary ) ) {

							$output .= '<div class="gt-text">';
								$output .= esc_attr( $speaker_summary );
							$output .= '</div>';

						}

						if( $social == 'true' and !empty( $speaker_social_links ) and !empty( eventchamp_social_media_sites( $custom_links = $speaker_social_links ) ) ) {

							$output .= '<div class="gt-social-links">';
								$output .= eventchamp_social_media_sites( $custom_links = $speaker_social_links );
							$output .= '</div>';

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;

		}

	}



	/*====== Speaker Style 3 ======*/
	if( !function_exists( 'eventchamp_speaker_style_3' ) ) {

		function eventchamp_speaker_style_3( $post_id = "", $image = "true", $profession = "true", $summary = "true", $social = "true" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$speaker_photo = get_post_meta( esc_attr( $post_id ), 'speaker-profile-photo', true );
				$speaker_profession = get_post_meta( esc_attr( $post_id ), 'speaker_profession', true );
				$speaker_summary = get_post_meta( esc_attr( $post_id ), 'speaker-short-biography', true );
				$speaker_summary = get_post_meta( esc_attr( $post_id ), 'speaker-short-biography', true );
				$speaker_social_links = get_post_meta( esc_attr( $post_id ), 'social-links', true );

				$output .= '<div class="gt-speaker gt-style-3">';

					if( $image == 'true' ) {

						if( !empty( $speaker_photo ) ) {

							$output .= '<div class="gt-image">';
								$output .= wp_get_attachment_image( eventchamp_attachment_id( $speaker_photo ), 'eventchamp-speaker', true, true );
							$output .= '</div>';

						} elseif ( has_post_thumbnail( $post_id ) ) {

							$output .= '<div class="gt-image">';
								$output .= wp_get_attachment_image( get_post_thumbnail_id( esc_attr( $post_id ) ), 'eventchamp-speaker' );
							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '"></a>';
						$output .= '<div class="gt-name">' . get_the_title( esc_attr( $post_id ) ) . '</div>';

						if( $profession == 'true' and !empty( $speaker_profession ) ) {

							$output .= '<div class="gt-profession">' . esc_attr( $speaker_profession ) . '</div>';

						}

						if( $summary == 'true' and !empty( $speaker_summary ) ) {

							$output .= '<div class="gt-text">';
								$output .= esc_attr( $speaker_summary );
							$output .= '</div>';

						}

						if( $social == 'true' and !empty( $speaker_social_links ) and !empty( eventchamp_social_media_sites( $custom_links = $speaker_social_links ) ) ) {

							$output .= '<div class="gt-social-links">';
								$output .= eventchamp_social_media_sites( $custom_links = $speaker_social_links );
							$output .= '</div>';

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;

		}

	}



	/*====== Speaker Style 4 ======*/
	if( !function_exists( 'eventchamp_speaker_style_4' ) ) {

		function eventchamp_speaker_style_4( $post_id = "", $image = "true", $profession = "true", $summary = "true", $social = "true" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$speaker_photo = get_post_meta( esc_attr( $post_id ), 'speaker-profile-photo', true );
				$speaker_profession = get_post_meta( esc_attr( $post_id ), 'speaker_profession', true );
				$speaker_summary = get_post_meta( esc_attr( $post_id ), 'speaker-short-biography', true );
				$speaker_social_links = get_post_meta( esc_attr( $post_id ), 'social-links', true );

				$output .= '<div class="gt-speaker gt-style-4">';

					if( $image == 'true' ) {

						if( !empty( $speaker_photo ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( eventchamp_attachment_id( $speaker_photo ), 'eventchamp-thumbnail', true, true );
								$output .= '</a>';
							$output .= '</div>';

						} elseif ( has_post_thumbnail( $post_id ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( get_post_thumbnail_id( esc_attr( $post_id ) ), 'eventchamp-thumbnail' );
								$output .= '</a>';
							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '"></a>';

						$output .= '<div class="gt-name">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
								$output .= get_the_title( esc_attr( $post_id ) );
							$output .= '</a>';
						$output .= '</div>';

						if( $profession == 'true' and !empty( $speaker_profession ) ) {

							$output .= '<div class="gt-profession">' . esc_attr( $speaker_profession ) . '</div>';

						}

						if( $summary == 'true' and !empty( $speaker_summary ) ) {

							$output .= '<div class="gt-text">';
								$output .= esc_attr( $speaker_summary );
							$output .= '</div>';

						}

						if( $social == 'true' and !empty( $speaker_social_links ) and !empty( eventchamp_social_media_sites( $custom_links = $speaker_social_links ) ) ) {

							$output .= '<div class="gt-social-links">';
								$output .= eventchamp_social_media_sites( $custom_links = $speaker_social_links );
							$output .= '</div>';

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;
		}

	}



	/*====== Speaker Style 5 ======*/
	if( !function_exists( 'eventchamp_speaker_style_5' ) ) {

		function eventchamp_speaker_style_5( $post_id = "", $image = "true", $profession = "true", $summary = "true", $social = "true" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$speaker_photo = get_post_meta( esc_attr( $post_id ), 'speaker-profile-photo', true );
				$speaker_profession = get_post_meta( esc_attr( $post_id ), 'speaker_profession', true );
				$speaker_summary = get_post_meta( esc_attr( $post_id ), 'speaker-short-biography', true );
				$speaker_social_links = get_post_meta( esc_attr( $post_id ), 'social-links', true );

				$output .= '<div class="gt-speaker gt-style-5">';

					if( $image == 'true' ) {

						if( !empty( $speaker_photo ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( eventchamp_attachment_id( $speaker_photo ), 'eventchamp-speaker', true, true );
								$output .= '</a>';
							$output .= '</div>';

						} elseif ( has_post_thumbnail( $post_id ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( get_post_thumbnail_id( esc_attr( $post_id ) ), 'eventchamp-speaker' );
								$output .= '</a>';
							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-name">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( esc_attr( $post_id ) ) . '</a>';
						$output .= '</div>';

						if( $profession == 'true' and !empty( $speaker_profession ) ) {

							$output .= '<div class="gt-profession">' . esc_attr( $speaker_profession ) . '</div>';

						}

						if( $summary == 'true' and !empty( $speaker_summary ) ) {

							$output .= '<div class="gt-text">';
								$output .= esc_attr( $speaker_summary );
							$output .= '</div>';

						}

						if( $social == 'true' and !empty( $speaker_social_links ) and !empty( eventchamp_social_media_sites( $custom_links = $speaker_social_links ) ) ) {

							$output .= '<div class="gt-social-links">';
								$output .= eventchamp_social_media_sites( $custom_links = $speaker_social_links );
							$output .= '</div>';

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;
		}

	}



	/*====== Speaker Style 6 ======*/
	if( !function_exists( 'eventchamp_speaker_style_6' ) ) {

		function eventchamp_speaker_style_6( $post_id = "", $image = "true", $profession = "true", $summary = "true", $social = "true" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$speaker_photo = get_post_meta( esc_attr( $post_id ), 'speaker-profile-photo', true );
				$speaker_profession = get_post_meta( esc_attr( $post_id ), 'speaker_profession', true );
				$speaker_summary = get_post_meta( esc_attr( $post_id ), 'speaker-short-biography', true );
				$speaker_social_links = get_post_meta( esc_attr( $post_id ), 'social-links', true );

				$output .= '<div class="gt-speaker gt-style-6">';

					if( $image == 'true' ) {

						if( !empty( $speaker_photo ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( eventchamp_attachment_id( $speaker_photo ), 'eventchamp-thumbnail', true, true );
								$output .= '</a>';
							$output .= '</div>';

						} elseif ( has_post_thumbnail( $post_id ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( get_post_thumbnail_id( esc_attr( $post_id ) ), 'eventchamp-thumbnail' );
								$output .= '</a>';
							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-name">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( esc_attr( $post_id ) ) . '</a>';
						$output .= '</div>';

						if( $profession == 'true' and !empty( $speaker_profession ) ) {

							$output .= '<div class="gt-profession">' . esc_attr( $speaker_profession ) . '</div>';

						}

						if( $summary == 'true' and !empty( $speaker_summary ) ) {

							$output .= '<div class="gt-text">';
								$output .= esc_attr( $speaker_summary );
							$output .= '</div>';

						}

						if( $social == 'true' and !empty( $speaker_social_links ) and !empty( eventchamp_social_media_sites( $custom_links = $speaker_social_links ) ) ) {

							$output .= '<div class="gt-social-links">';
								$output .= eventchamp_social_media_sites( $custom_links = $speaker_social_links );
							$output .= '</div>';

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;

		}

	}



	/*====== Speaker Style 7 ======*/
	if( !function_exists( 'eventchamp_speaker_style_7' ) ) {

		function eventchamp_speaker_style_7( $post_id = "", $image = "true", $profession = "true", $summary = "true", $social = "true" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$speaker_photo = get_post_meta( esc_attr( $post_id ), 'speaker-profile-photo', true );
				$speaker_profession = get_post_meta( esc_attr( $post_id ), 'speaker_profession', true );
				$speaker_summary = get_post_meta( esc_attr( $post_id ), 'speaker-short-biography', true );
				$speaker_social_links = get_post_meta( esc_attr( $post_id ), 'social-links', true );

				$output .= '<div class="gt-speaker gt-style-7">';

					if( $image == 'true' ) {

						if( !empty( $speaker_photo ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( eventchamp_attachment_id( $speaker_photo ), 'eventchamp-thumbnail', true, true );
								$output .= '</a>';
							$output .= '</div>';

						} elseif ( has_post_thumbnail( $post_id ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( get_post_thumbnail_id( esc_attr( $post_id ) ), 'eventchamp-thumbnail' );
								$output .= '</a>';
							$output .= '</div>';
						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-name">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( esc_attr( $post_id ) ) . '</a>';
						$output .= '</div>';

						if( $profession == 'true' and !empty( $speaker_profession ) ) {

							$output .= '<div class="gt-profession">' . esc_attr( $speaker_profession ) . '</div>';

						}

						if( $summary == 'true' and !empty( $speaker_summary ) ) {

							$output .= '<div class="gt-text">';
								$output .= esc_attr( $speaker_summary );
							$output .= '</div>';

						}

						if( $social == 'true' and !empty( $speaker_social_links ) and !empty( eventchamp_social_media_sites( $custom_links = $speaker_social_links ) ) ) {

							$output .= '<div class="gt-social-links">';
								$output .= eventchamp_social_media_sites( $custom_links = $speaker_social_links );
							$output .= '</div>';

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;

		}

	}



	/*====== Speaker Style 8 ======*/
	if( !function_exists( 'eventchamp_speaker_style_8' ) ) {

		function eventchamp_speaker_style_8( $post_id = "", $image = "true", $profession = "true", $summary = "true", $social = "true" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$speaker_photo = get_post_meta( esc_attr( $post_id ), 'speaker-profile-photo', true );
				$speaker_profession = get_post_meta( esc_attr( $post_id ), 'speaker_profession', true );
				$speaker_summary = get_post_meta( esc_attr( $post_id ), 'speaker-short-biography', true );
				$speaker_social_links = get_post_meta( esc_attr( $post_id ), 'social-links', true );

				$output .= '<div class="gt-speaker gt-style-8">';

					if( $image == 'true' ) {

						if( !empty( $speaker_photo ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( eventchamp_attachment_id( $speaker_photo ), 'eventchamp-speaker', true, true );
								$output .= '</a>';
							$output .= '</div>';

						} elseif ( has_post_thumbnail( $post_id ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= wp_get_attachment_image( get_post_thumbnail_id( esc_attr( $post_id ) ), 'eventchamp-speaker' );
								$output .= '</a>';
							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-name">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( esc_attr( $post_id ) ) . '</a>';
						$output .= '</div>';

						if( $profession == 'true' and !empty( $speaker_profession ) ) {

							$output .= '<div class="gt-profession">' . esc_attr( $speaker_profession ) . '</div>';

						}

						if( $summary == 'true' and !empty( $speaker_summary ) ) {

							$output .= '<div class="gt-text">';
								$output .= esc_attr( $speaker_summary );
							$output .= '</div>';

						}

						if( $social == 'true' and !empty( $speaker_social_links ) and !empty( eventchamp_social_media_sites( $custom_links = $speaker_social_links ) ) ) {

							$output .= '<div class="gt-social-links">';
								$output .= eventchamp_social_media_sites( $custom_links = $speaker_social_links );
							$output .= '</div>';

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;

		}

	}



/*======
*
* Speaker Header
*
======*/
if( !function_exists( 'eventchamp_speaker_header' ) ) {

	function eventchamp_speaker_header( $id = "" ) {

		$output = "";
		$slider_column = ot_get_option( 'speaker-header-image-slider-column', '1' );
		$slider_space = ot_get_option( 'speaker-header-image-slider-space', '0' );
		$slider_loop = ot_get_option( 'speaker-header-image-slider-loop', 'true' );
		$slider_autoplay = ot_get_option( 'speaker-header-image-slider-autoplay', 'true' );
		$slider_autoplay_delay = ot_get_option( 'speaker-header-image-slider-autoplay-delay', '1500' );
		$slider_direction = ot_get_option( 'speaker-header-image-slider-direction', 'horizontal' );
		$slider_effect = ot_get_option( 'speaker-header-image-slider-effect', 'slide' );

		if( !empty( $id ) ) {

			$header_status = get_post_meta( esc_attr( $id ), 'speaker-header-status', true );

			if( empty( $header_status ) or $header_status == "default" ) {

				$header_status = ot_get_option( 'speaker-header-status', 'true' );

			}

			$header_type = get_post_meta( esc_attr( $id ), 'speaker-header-style', true );

			if( $header_type == "default" or empty( $header_type ) ) {

				$header_type = ot_get_option( 'speaker-header-style', 'image' );

			}

			$image_gallery = explode( ',', get_post_meta( esc_attr( $id ), 'header-image-gallery', true ) );
			$featured_image = get_post_meta( esc_attr( $id ), 'speaker-featured-image', true );
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
											$output .= '<a href="' . esc_url( wp_get_attachment_image_src( esc_attr( $image ), 'full', true, true )[0] ) . '" data-srcset="' . wp_get_attachment_image_srcset( esc_attr( $image ), 'full' ) . '" data-caption="' . wp_get_attachment_caption( esc_attr( $image ) ) . '" data-fancybox="speaker-feature-images">';
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
								$output .= get_the_post_thumbnail( esc_attr( $id ), 'eventchamp-content-header' );
							$output .= '</div>';

						}

					} else {

						if ( has_post_thumbnail() ) {

							$output .= '<div class="gt-content-header gt-image">';
								$output .= get_the_post_thumbnail( esc_attr( $id ), 'eventchamp-content-header' );
							$output .= '</div>';

						}

					}

				} else {

					if ( has_post_thumbnail() ) {

						$output .= '<div class="gt-content-header gt-image">';
							$output .= get_the_post_thumbnail( esc_attr( $id ), 'eventchamp-content-header' );
						$output .= '</div>';

					}

				}

			}

		}

		return $output;

	}

}



/*======
*
* Speaker Detail Box
*
======*/
if( !function_exists( 'eventchamp_speaker_detail_box' ) ) {

	function eventchamp_speaker_detail_box( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$event_detail_box = ot_get_option( 'speaker-detail-box-status', 'on' );
			$category_status = ot_get_option( 'speaker-detail-box-category', 'on' );
			$location_status = ot_get_option( 'speaker-detail-box-location', 'on' );
			$address_status = ot_get_option( 'speaker-detail-box-address', 'on' );
			$phone_status = ot_get_option( 'speaker-detail-box-phone', 'on' );
			$email_status = ot_get_option( 'speaker-detail-box-email', 'on' );
			$website_status = ot_get_option( 'speaker-detail-box-website', 'on' );
			$social_status = ot_get_option( 'speaker-detail-box-social', 'on' );
			$extra_status = ot_get_option( 'speaker-detail-box-extra', 'on' );
			$speaker_like_system = ot_get_option( 'speaker-like-system', 'on' );
			$speaker_favorite_system = ot_get_option( 'speaker-favorite-system', 'on' );

			$categories = wp_get_post_terms( $id, 'speaker-category' );
			$locations = wp_get_post_terms( $id, 'location' );

			$speaker_profession = get_post_meta( esc_attr( $id ), 'speaker_profession', true );
			$speaker_company = get_post_meta( esc_attr( $id ), 'speaker_company', true );
			$speaker_location = get_post_meta( esc_attr( $id ), 'speaker_location', true );
			$speaker_address = get_post_meta( esc_attr( $id ), 'speaker_address', true );
			$speaker_phone = get_post_meta( esc_attr( $id ), 'speaker_phone', true );
			$speaker_email = get_post_meta( esc_attr( $id ), 'speaker_email', true );
			$speaker_website = get_post_meta( esc_attr( $id ), 'speaker_website', true );
			$social_links = get_post_meta( esc_attr( $id ), 'social-links', true );
			$extra_details_position = get_post_meta( esc_attr( $id ), 'extra-speaker-details-position', true );
			$extra_details = get_post_meta( esc_attr( $id ), 'extra-speaker-details', true );

			if( $event_detail_box == "on" ) {

				$output .= '<div class="gt-widget gt-detail-widget">';
					$output .= '<div class="gt-widget-title">';
						$output .= '<span>' . esc_html__( 'Speaker Details' , 'eventchamp' ) . '</span>';

						if( $speaker_like_system == "on" or $speaker_favorite_system == "on" ) {

							$output .= '<div class="gt-like-box">';
								$output .= '<div class="gt-inner-box">';

									if( $speaker_like_system == "on" ) {

										$output .= eventchamp_like_button( get_the_ID() );

									}


									if( $speaker_favorite_system == "on" ) {

										$output .= eventchamp_favorite_button( get_the_ID() );

									}
								$output .= '</div>';
							$output .= '</div>';

						}

					$output .= '</div>';
					$output .= '<div class="gt-widget-content">';
						$output .= '<div class="gt-content-detail-box">';
							$output .= '<ul>';

								if( $extra_status == "on" or $extra_status !== "off" ) {

									if( $extra_details_position == "before-current" ) {

										if( !empty( $extra_details ) ) {

											foreach( $extra_details as $detail ) {

												if( !empty( $detail ) ) {

													$output .= '<li class="gt-extra-detail">';

														if( $detail["icon-type"] == "font-icon" and !empty( $detail["font-icon"] ) ) {

															$output .= '<div class="gt-icon gt-font-icon">';
																$output .= '<i class="' . esc_attr( $detail["font-icon"] ) . '" aria-hidden="true"></i>';
															$output .= '</div>';

														} elseif( $detail["icon-type"] == "svg-icon" and !empty( $detail["svg-icon"] ) ) {

															$output .= '<div class="gt-icon gt-svg-icon">';
																$output .= $detail["svg-icon"];
															$output .= '</div>';

														} elseif( $detail["icon-type"] == "image-icon" and !empty( $detail["image-icon"] ) ) {

															$output .= '<div class="gt-icon gt-svg-icon">';
																$output .= '<img src="' . esc_url( $detail["image-icon"] ) . '" alt="' . esc_attr( $detail["title"] ) . '" />';
															$output .= '</div>';

														}

														if( !empty( $detail["title"] ) or !empty( $detail["text"] ) ) {

															$output .= '<div class="gt-content">';

																if( !empty( $detail["title"] ) ) {

																	$output .= '<div class="gt-title">' . esc_attr( $detail["title"] ) . '</div>';

																}

																if( !empty( $detail["text"] ) ) {

																	$output .= '<div class="gt-inner">';
																		$output .= wpautop( $detail["text"] );
																	$output .= '</div>';

																}

															$output .= '</div>';

														}

													$output .= '</li>';

												}

											}

										}

									}

								}

								if( $category_status == "on" or $category_status !== "off" ) {

									if( !empty( $locations ) ) {

										$output .= '<li class="gt-categories">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve"> <path d="M57.49,21.5H54v-6.268c0-1.507-1.226-2.732-2.732-2.732H26.515l-5-7H2.732C1.226,5.5,0,6.726,0,8.232v43.687l0.006,0 c-0.005,0.563,0.17,1.114,0.522,1.575C1.018,54.134,1.76,54.5,2.565,54.5h44.759c1.156,0,2.174-0.779,2.45-1.813L60,24.649v-0.177 C60,22.75,58.944,21.5,57.49,21.5z M2,8.232C2,7.828,2.329,7.5,2.732,7.5h17.753l5,7h25.782c0.404,0,0.732,0.328,0.732,0.732V21.5 H12.731c-0.144,0-0.287,0.012-0.426,0.036c-0.973,0.163-1.782,0.873-2.023,1.776L2,45.899V8.232z M47.869,52.083 c-0.066,0.245-0.291,0.417-0.545,0.417H2.565c-0.243,0-0.385-0.139-0.448-0.222c-0.063-0.082-0.16-0.256-0.123-0.408l10.191-27.953 c0.066-0.245,0.291-0.417,0.545-0.417H54h3.49c0.38,0,0.477,0.546,0.502,0.819L47.869,52.083z"></path> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Category', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<ul>';

														foreach( $categories as $category ) {

															if( !empty( $category ) ) {

																$output .= '<li>';
																	$output .= '<a href="' . esc_url( get_term_link( $category->term_id ) . '?post_type=speaker' ) . '">' . esc_attr( $category->name ) . '</a>';
																$output .= '</li>';

															}

														}

													$output .= '</ul>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $location_status == "on" or $location_status !== "off" ) {

									if( !empty( $locations ) ) {

										$output .= '<li class="gt-locations">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 54.757 54.757" xml:space="preserve"> <g> <path d="M27.557,12c-3.859,0-7,3.141-7,7s3.141,7,7,7s7-3.141,7-7S31.416,12,27.557,12z M27.557,24c-2.757,0-5-2.243-5-5 s2.243-5,5-5s5,2.243,5,5S30.314,24,27.557,24z"/> <path d="M40.94,5.617C37.318,1.995,32.502,0,27.38,0c-5.123,0-9.938,1.995-13.56,5.617c-6.703,6.702-7.536,19.312-1.804,26.952 L27.38,54.757L42.721,32.6C48.476,24.929,47.643,12.319,40.94,5.617z M41.099,31.431L27.38,51.243L13.639,31.4 C8.44,24.468,9.185,13.08,15.235,7.031C18.479,3.787,22.792,2,27.38,2s8.901,1.787,12.146,5.031 C45.576,13.08,46.321,24.468,41.099,31.431z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Location', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<ul>';

														foreach( $locations as $location ) {

															if( !empty( $location ) ) {

																$output .= '<li>';
																	$output .= '<a href="' . esc_url( get_term_link( $location->term_id ) . '?post_type=speaker' ) . '">' . esc_attr( $location->name ) . '</a>';
																$output .= '</li>';

															}

														}

													$output .= '</ul>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $address_status == "on" or $address_status !== "off" ) {

									if( !empty( $speaker_address ) ) {

										$output .= '<li class="gt-address">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve"> <path d="M44.18,20l9.668-15.47c0.193-0.309,0.203-0.697,0.027-1.015C53.698,3.197,53.363,3,53,3H8V1c0-0.553-0.447-1-1-1 S6,0.447,6,1v3v29v3v23c0,0.553,0.447,1,1,1s1-0.447,1-1V37h45c0.363,0,0.698-0.197,0.875-0.516 c0.176-0.317,0.166-0.706-0.027-1.015L44.18,20z M8,35v-2V5h43.195l-9.043,14.47c-0.203,0.324-0.203,0.736,0,1.061L51.195,35H8z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Address', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= esc_attr( $speaker_address );
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $phone_status == "on" or $phone_status !== "off" ) {

									if( !empty( $speaker_phone ) ) {

										$output .= '<li class="gt-phone">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.076 512.076" xml:space="preserve"> <g transform="translate(-1 -1)"> <g> <g> <path d="M499.639,396.039l-103.646-69.12c-13.153-8.701-30.784-5.838-40.508,6.579l-30.191,38.818 c-3.88,5.116-10.933,6.6-16.546,3.482l-5.743-3.166c-19.038-10.377-42.726-23.296-90.453-71.04s-60.672-71.45-71.049-90.453 l-3.149-5.743c-3.161-5.612-1.705-12.695,3.413-16.606l38.792-30.182c12.412-9.725,15.279-27.351,6.588-40.508l-69.12-103.646 C109.12,1.056,91.25-2.966,77.461,5.323L34.12,31.358C20.502,39.364,10.511,52.33,6.242,67.539 c-15.607,56.866-3.866,155.008,140.706,299.597c115.004,114.995,200.619,145.92,259.465,145.92 c13.543,0.058,27.033-1.704,40.107-5.239c15.212-4.264,28.18-14.256,36.181-27.878l26.061-43.315 C517.063,422.832,513.043,404.951,499.639,396.039z M494.058,427.868l-26.001,43.341c-5.745,9.832-15.072,17.061-26.027,20.173 c-52.497,14.413-144.213,2.475-283.008-136.32S8.29,124.559,22.703,72.054c3.116-10.968,10.354-20.307,20.198-26.061 l43.341-26.001c5.983-3.6,13.739-1.855,17.604,3.959l37.547,56.371l31.514,47.266c3.774,5.707,2.534,13.356-2.85,17.579 l-38.801,30.182c-11.808,9.029-15.18,25.366-7.91,38.332l3.081,5.598c10.906,20.002,24.465,44.885,73.967,94.379 c49.502,49.493,74.377,63.053,94.37,73.958l5.606,3.089c12.965,7.269,29.303,3.898,38.332-7.91l30.182-38.801 c4.224-5.381,11.87-6.62,17.579-2.85l103.637,69.12C495.918,414.126,497.663,421.886,494.058,427.868z"/> <path d="M291.161,86.39c80.081,0.089,144.977,64.986,145.067,145.067c0,4.713,3.82,8.533,8.533,8.533s8.533-3.82,8.533-8.533 c-0.099-89.503-72.63-162.035-162.133-162.133c-4.713,0-8.533,3.82-8.533,8.533S286.448,86.39,291.161,86.39z"/> <path d="M291.161,137.59c51.816,0.061,93.806,42.051,93.867,93.867c0,4.713,3.821,8.533,8.533,8.533 c4.713,0,8.533-3.82,8.533-8.533c-0.071-61.238-49.696-110.863-110.933-110.933c-4.713,0-8.533,3.82-8.533,8.533 S286.448,137.59,291.161,137.59z"/> <path d="M291.161,188.79c23.552,0.028,42.638,19.114,42.667,42.667c0,4.713,3.821,8.533,8.533,8.533s8.533-3.82,8.533-8.533 c-0.038-32.974-26.759-59.696-59.733-59.733c-4.713,0-8.533,3.82-8.533,8.533S286.448,188.79,291.161,188.79z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Phone', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<a href="tel:' . esc_attr( $speaker_phone ) . '">' . esc_attr( $speaker_phone ) . '</a>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $email_status == "on" or $email_status !== "off" ) {

									if( !empty( $speaker_email ) ) {

										$output .= '<li class="gt-email">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <path d="M486.4,59.733H25.6c-14.138,0-25.6,11.461-25.6,25.6v341.333c0,14.138,11.461,25.6,25.6,25.6h460.8 c14.138,0,25.6-11.461,25.6-25.6V85.333C512,71.195,500.539,59.733,486.4,59.733z M494.933,426.667 c0,4.713-3.82,8.533-8.533,8.533H25.6c-4.713,0-8.533-3.82-8.533-8.533V85.333c0-4.713,3.82-8.533,8.533-8.533h460.8 c4.713,0,8.533,3.82,8.533,8.533V426.667z"/> <path d="M470.076,93.898c-2.255-0.197-4.496,0.51-6.229,1.966L266.982,261.239c-6.349,5.337-15.616,5.337-21.965,0L48.154,95.863 c-2.335-1.96-5.539-2.526-8.404-1.484c-2.865,1.042-4.957,3.534-5.487,6.537s0.582,6.06,2.917,8.02l196.864,165.367 c12.688,10.683,31.224,10.683,43.913,0L474.82,108.937c1.734-1.455,2.818-3.539,3.015-5.794c0.197-2.255-0.51-4.496-1.966-6.229 C474.415,95.179,472.331,94.095,470.076,93.898z"/> <path d="M164.124,273.13c-3.021-0.674-6.169,0.34-8.229,2.65l-119.467,128c-2.162,2.214-2.956,5.426-2.074,8.392 c0.882,2.967,3.301,5.223,6.321,5.897c3.021,0.674,6.169-0.34,8.229-2.65l119.467-128c2.162-2.214,2.956-5.426,2.074-8.392 C169.563,276.061,167.145,273.804,164.124,273.13z"/> <path d="M356.105,275.78c-2.059-2.31-5.208-3.324-8.229-2.65c-3.021,0.674-5.439,2.931-6.321,5.897 c-0.882,2.967-0.088,6.178,2.074,8.392l119.467,128c3.24,3.318,8.536,3.442,11.927,0.278c3.391-3.164,3.635-8.456,0.549-11.918 L356.105,275.78z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Email', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<a href="mailto:' . esc_attr( $speaker_email ) . '">' . esc_attr( $speaker_email ) . '</a>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $website_status == "on" or $website_status !== "off" ) {

									if( !empty( $speaker_website ) ) {

										$output .= '<li class="gt-website">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 470 470" xmlns:xlink="https://www.w3.org/1999/xlink"> <g> <path d="m462.5,22.5h-455c-4.142,0-7.5,3.357-7.5,7.5v410c0,4.143 3.358,7.5 7.5,7.5h455c4.142,0 7.5-3.357 7.5-7.5v-80c0-4.143-3.358-7.5-7.5-7.5s-7.5,3.357-7.5,7.5v72.5h-440v-335h440v232.5c0,4.143 3.358,7.5 7.5,7.5s7.5-3.357 7.5-7.5v-300c0-4.143-3.358-7.5-7.5-7.5zm-447.5,15h277.5v45h-277.5v-45zm292.5,45v-45h147.5v45h-147.5z"/> <path d="m381.5,52c-4.411,0-8,3.589-8,8s3.589,8 8,8 8-3.589 8-8-3.589-8-8-8z"/> <path d="m340.5,52c-4.411,0-8,3.589-8,8s3.589,8 8,8 8-3.589 8-8-3.589-8-8-8z"/> <path d="m422.5,52c-4.411,0-8,3.589-8,8s3.589,8 8,8 8-3.589 8-8-3.589-8-8-8z"/> <path d="m148.714,225.989c2.949-0.369 5.402-2.443 6.254-5.29l17.253-57.594c1.188-3.968-1.064-8.148-5.032-9.337-3.966-1.188-8.148,1.064-9.337,5.032l-12.374,41.306-11.928-19.908c-1.355-2.262-3.797-3.646-6.434-3.646s-5.079,1.384-6.434,3.646l-11.928,19.908-12.372-41.298c-1.188-3.968-5.369-6.221-9.337-5.032-3.968,1.188-6.221,5.369-5.032,9.337l17.251,57.586c0.853,2.847 3.306,4.921 6.254,5.29 0.312,0.039 0.623,0.058 0.932,0.058 2.612,0 5.066-1.366 6.432-3.646l14.233-23.756 14.233,23.756c1.53,2.549 4.42,3.959 7.366,3.588z"/> <path d="m206.358,225.982c0.312,0.039 0.623,0.058 0.932,0.058 2.612,0 5.066-1.366 6.432-3.646l14.233-23.756 14.233,23.756c1.527,2.549 4.416,3.957 7.364,3.588 2.949-0.369 5.402-2.443 6.254-5.29l17.253-57.594c1.188-3.968-1.064-8.148-5.032-9.337-3.968-1.189-8.148,1.063-9.337,5.032l-12.374,41.307-11.928-19.908c-1.355-2.262-3.797-3.646-6.434-3.646s-5.079,1.384-6.434,3.646l-11.926,19.908-12.372-41.299c-1.188-3.968-5.367-6.222-9.337-5.032-3.968,1.188-6.221,5.369-5.032,9.337l17.251,57.587c0.853,2.846 3.306,4.92 6.254,5.289z"/> <path d="m368.865,153.755c-3.967-1.188-8.148,1.064-9.337,5.032l-12.374,41.305-11.928-19.908c-1.355-2.262-3.797-3.646-6.434-3.646s-5.079,1.384-6.434,3.646l-11.928,19.908-12.372-41.298c-1.189-3.967-5.367-6.22-9.337-5.032-3.968,1.188-6.221,5.369-5.032,9.337l17.251,57.586c0.853,2.847 3.306,4.921 6.254,5.29 2.949,0.369 5.836-1.038 7.364-3.588l14.233-23.756 14.233,23.756c1.366,2.279 3.819,3.646 6.432,3.646 0.309,0 0.621-0.019 0.932-0.058 2.949-0.369 5.402-2.443 6.254-5.29l17.253-57.593c1.19-3.968-1.062-8.149-5.03-9.337z"/> <path d="m136.7,268.547c0-4.143-3.358-7.5-7.5-7.5h-40c-4.142,0-7.5,3.357-7.5,7.5v40c0,4.143 3.358,7.5 7.5,7.5h40c4.142,0 7.5-3.357 7.5-7.5v-40zm-15,32.5h-25v-25h25v25z"/> <path d="m129.2,331.047h-40c-4.142,0-7.5,3.357-7.5,7.5v40c0,4.143 3.358,7.5 7.5,7.5h40c4.142,0 7.5-3.357 7.5-7.5v-40c0-4.143-3.358-7.5-7.5-7.5zm-7.5,40h-25v-25h25v25z"/> <path d="m366.712,281.047h-30c-4.142,0-7.5,3.357-7.5,7.5s3.358,7.5 7.5,7.5h30c4.142,0 7.5-3.357 7.5-7.5s-3.358-7.5-7.5-7.5z"/> <path d="m306.712,281.047h-147.512c-4.142,0-7.5,3.357-7.5,7.5s3.358,7.5 7.5,7.5h147.513c4.142,0 7.5-3.357 7.5-7.5s-3.359-7.5-7.501-7.5z"/> <path d="m366.712,351.047h-30c-4.142,0-7.5,3.357-7.5,7.5s3.358,7.5 7.5,7.5h30c4.142,0 7.5-3.357 7.5-7.5s-3.358-7.5-7.5-7.5z"/> <path d="m306.712,351.047h-147.512c-4.142,0-7.5,3.357-7.5,7.5s3.358,7.5 7.5,7.5h147.513c4.142,0 7.5-3.357 7.5-7.5s-3.359-7.5-7.501-7.5z"/> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Website', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<a href="' . esc_url( $speaker_website ) . '" target="_blank">' . esc_url( $speaker_website ) . '</a>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $social_status == "on" or $social_status !== "off" ) {

									if( !empty( $social_links ) and eventchamp_social_media_sites( $custom_links = $social_links ) ) {

										$output .= '<li class="gt-social-links">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 58.995 58.995" xml:space="preserve"> <path d="M39.927,41.929c-0.524,0.524-0.975,1.1-1.365,1.709l-17.28-10.489c0.457-1.144,0.716-2.388,0.716-3.693 c0-1.305-0.259-2.549-0.715-3.693l17.284-10.409C40.342,18.142,43.454,20,46.998,20c5.514,0,10-4.486,10-10s-4.486-10-10-10 s-10,4.486-10,10c0,1.256,0.243,2.454,0.667,3.562L20.358,23.985c-1.788-2.724-4.866-4.529-8.361-4.529c-5.514,0-10,4.486-10,10 s4.486,10,10,10c3.495,0,6.572-1.805,8.36-4.529L37.661,45.43c-0.43,1.126-0.664,2.329-0.664,3.57c0,2.671,1.04,5.183,2.929,7.071 c1.949,1.949,4.51,2.924,7.071,2.924s5.122-0.975,7.071-2.924c1.889-1.889,2.929-4.4,2.929-7.071s-1.04-5.183-2.929-7.071 C50.169,38.029,43.826,38.029,39.927,41.929z M46.998,2c4.411,0,8,3.589,8,8s-3.589,8-8,8s-8-3.589-8-8S42.586,2,46.998,2z M11.998,37.456c-4.411,0-8-3.589-8-8s3.589-8,8-8s8,3.589,8,8S16.409,37.456,11.998,37.456z M52.654,54.657 c-3.119,3.119-8.194,3.119-11.313,0c-1.511-1.511-2.343-3.521-2.343-5.657s0.832-4.146,2.343-5.657 c1.56-1.56,3.608-2.339,5.657-2.339s4.097,0.779,5.657,2.339c1.511,1.511,2.343,3.521,2.343,5.657S54.166,53.146,52.654,54.657z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Network', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= eventchamp_social_media_sites( $custom_links = $social_links );
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $extra_status == "on" or $extra_status !== "off" ) {
									
									if( $extra_details_position == "after-current" ) {

										if( !empty( $extra_details ) ) {

											foreach( $extra_details as $detail ) {

												if( !empty( $detail ) ) {

													$output .= '<li class="gt-extra-detail">';

														if( $detail["icon-type"] == "font-icon" and !empty( $detail["font-icon"] ) ) {

															$output .= '<div class="gt-icon gt-font-icon">';
																$output .= '<i class="' . esc_attr( $detail["font-icon"] ) . '" aria-hidden="true"></i>';
															$output .= '</div>';

														} elseif( $detail["icon-type"] == "svg-icon" and !empty( $detail["svg-icon"] ) ) {

															$output .= '<div class="gt-icon gt-svg-icon">';
																$output .= esc_attr( $detail["svg-icon"] );
															$output .= '</div>';

														} elseif( $detail["icon-type"] == "image-icon" and !empty( $detail["image-icon"] ) ) {

															$output .= '<div class="gt-icon gt-svg-icon">';
																$output .= '<img src="' . esc_url( $detail["image-icon"] ) . '" alt="' . esc_attr( $detail["title"] ) . '" />';
															$output .= '</div>';

														}

														if( !empty( $detail["title"] ) or !empty( $detail["text"] ) ) {

															$output .= '<div class="gt-content">';

																if( !empty( $detail["title"] ) ) {

																	$output .= '<div class="gt-title">' . esc_attr( $detail["title"] ) . '</div>';

																}

																if( !empty( $detail["text"] ) ) {

																	$output .= '<div class="gt-inner">';
																		$output .= wpautop( $detail["text"] );
																	$output .= '</div>';
																}

															$output .= '</div>';

														}

													$output .= '</li>';

												}

											}

										}

									}

								}

							$output .= '</ul>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Speaker Sidebar Boxes
*
======*/
if( !function_exists( 'eventchamp_speaker_sidebar_boxes' ) ) {

	function eventchamp_speaker_sidebar_boxes( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$boxes = get_post_meta( esc_attr( $id ), 'speaker-sidebar-boxes', true );

			if( !empty( $boxes ) ) {

				foreach( $boxes as $box ) {

					if( !empty( $box ) ) {

						$output .= '<div class="gt-widget gt-detail-widget">';

							if( !empty( $box["title"] ) ) {

								$output .= '<div class="gt-widget-title">';
									$output .= '<span>' . esc_attr( $box["title"] ) . '</span>';
								$output .= '</div>';

							}

							if( !empty( $box["text"] ) ) {

								$output .= '<div class="gt-widget-content">';
									$output .= do_shortcode( wpautop( $box["text"] ) );
								$output .= '</div>';

							}

						$output .= '</div>';

					}

				}

			}

		}

		return $output;

	}

}



/*======
*
* Speaker Tags
*
======*/
if( !function_exists( 'eventchamp_speaker_tags' ) ) {

	function eventchamp_speaker_tags( $id = "", $position = "position-1" ) {

		$output = "";

		if( !empty( $id ) ) {

			$speaker_tag_status = ot_get_option( 'speaker-tags', 'on' );
			$style = ot_get_option( 'speaker-tags-style', 'style-1' );

			$tags = wp_get_post_terms( $id, 'speaker-tags' );

			if( $speaker_tag_status == "on" or $speaker_tag_status !== "off" ) {

				if( $position == "position-1" ) {

					if( !empty( $tags ) ) {

						$output .= '<div class="gt-tags gt-' . esc_attr( $style ) . '">';
							$output .= '<ul>';

								foreach( $tags as $tag ) {

									if( !empty( $tag ) ) {

										$output .= '<li>';
											$output .= '<a href="' . esc_url( get_term_link( $tag->term_id ) . '?post_type=speaker' ) . '">' . esc_attr( $tag->name ) . '</a>';
										$output .= '</li>';

									}

								}

							$output .= '</ul>';
						$output .= '</div>';

					}

				} else {

					$output .= '<div class="gt-widget gt-detail-widget">';
						$output .= '<div class="gt-widget-title">';
							$output .= '<span>' . esc_html__( 'Speaker Tags' , 'eventchamp' ) . '</span>';
						$output .= '</div>';
						$output .= '<div class="gt-widget-content">';
							$output .= '<div class="gt-content-detail-box">';

								if( !empty( $tags ) ) {

									$output .= '<div class="gt-tags gt-' . esc_attr( $style ) . '">';
										$output .= '<ul>';

											foreach( $tags as $tag ) {

												if( !empty( $tag ) ) {

													$output .= '<li>';
														$output .= '<a href="' . esc_url( get_term_link( $tag->term_id ) . '?post_type=speaker' ) . '">' . esc_attr( $tag->name ) . '</a>';
													$output .= '</li>';

												}

											}

										$output .= '</ul>';
									$output .= '</div>';

								}

							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';

				}

			}

		}

		return $output;

	}

}



/*======
*
* Speaker Social Sharing
*
======*/
if( !function_exists( 'eventchamp_speaker_social_sharing' ) ) {

	function eventchamp_speaker_social_sharing( $position = "position-1" ) {

		$speaker_social_share = ot_get_option( 'speaker-social-sharing', 'on' );
		$social_share_title = ot_get_option( 'speaker-social-share-text' );
		$social_share_style = ot_get_option( 'speaker-social-sharing-style', 'style-1' );
		$output = "";

		if( $speaker_social_share == "on" ) {

			if( $position == "position-1" ) {

				$output .= '<div class="gt-page-sharing">';

					if( !empty( $social_share_title ) ) {

						$output .= '<div class="gt-title">' . esc_attr( $social_share_title ) . '</div>';

					} else {

						$output .= '<div class="gt-title">' . esc_html__( 'Share This Speaker', 'eventchamp' ) . '</div>';

					}

					$output .= eventchamp_social_share( $style = $social_share_style );
				$output .= '</div>';

			} else {

				$output .= '<div class="gt-widget gt-detail-widget">';
					$output .= '<div class="gt-widget-title">';

						if( !empty( $social_share_title ) ) {

							$output .= '<span>' . esc_attr( $social_share_title ) . '</span>';

						} else {

							$output .= '<span>' . esc_html__( 'Share This Speaker', 'eventchamp' ) . '</span>';

						}

					$output .= '</div>';
					$output .= '<div class="gt-widget-content">';
						$output .= '<div class="gt-content-detail-box">';
							$output .= eventchamp_social_share( $style = $social_share_style );
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Speaker Sidebar Buttons
*
======*/
if( !function_exists( 'eventchamp_speaker_sidebar_buttons' ) ) {

	function eventchamp_speaker_sidebar_buttons( $id = "" ) {

		$output = "";
		$sidebar_buttons = ot_get_option( 'speaker-sidebar-buttons' );
		$buttons = get_post_meta( esc_attr( $id ), 'speaker-extra-buttons', true );

		if( !empty( $sidebar_buttons ) or !empty( $buttons ) ) {

			$output .= '<div class="gt-widget gt-transparent-widget">';
				$output .= '<div class="gt-widget-content">';
					$output .= '<div class="gt-event-buttons">';
						$output .= '<ul>';

							if( !empty( $buttons ) ) {

								foreach( $buttons as $button ) {

									if( !empty( $button ) ) {

										if( !empty( $button["title"] ) and !empty( $button["link"] ) ) {

											if( empty( $button["target"] ) ) {

												$button["target"] = "_self";

											}

											$output .= '<li>';
												$output .= '<a href="' . esc_url( $button["link"] ) . '" target="' . esc_attr( $button["target"] ) . '">' . esc_attr( $button["title"] ) . '</a>';
											$output .= '</li>';

										}

									}

								}

							}

							if( !empty( $sidebar_buttons ) ) {

								foreach( $sidebar_buttons as $sidebar_button ) {

									if( !empty( $sidebar_button ) ) {

										if( !empty( $sidebar_button["title"] ) and !empty( $sidebar_button["link"] ) ) {

											if( empty( $sidebar_button["target"] ) ) {

												$sidebar_button["target"] = "_self";

											}

											$output .= '<li>';
												$output .= '<a href="' . esc_url( $sidebar_button["link"] ) . '" target="' . esc_attr( $sidebar_button["target"] ) . '">' . esc_attr( $sidebar_button["title"] ) . '</a>';
											$output .= '</li>';

										}

									}

								}

							}

						$output .= '</ul>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Speaker Photos
*
======*/
if( !function_exists( 'eventchamp_speaker_photos' ) ) {

	function eventchamp_speaker_photos( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$photo_column = ot_get_option( 'speaker-photo-column', '3' );
			$photo_column_space = ot_get_option( 'speaker-photo-column-space', '0' );

			$speaker_photo_column = get_post_meta( esc_attr( $id ), 'speaker-photo-column', true );

			if( $speaker_photo_column == "default" or empty( $speaker_photo_column ) ) {

				$speaker_photo_column = $photo_column;

			}

			$speaker_photo_column_space = get_post_meta( esc_attr( $id ), 'speaker-photo-column-space', true );

			if( $speaker_photo_column_space == "default" or empty( $speaker_photo_column_space ) ) {

				$speaker_photo_column_space = $photo_column_space;

			}

			$photos = explode( ',', get_post_meta( esc_attr( $id ), 'speaker_image_gallery', true ) );

			if( !empty( $photos ) ) {

				$output .= '<div class="gt-photos-sections gt-columns gt-column-' . esc_attr( $speaker_photo_column ) . ' gt-column-space-' . esc_attr( $speaker_photo_column_space ) . '">';

					foreach( $photos as $photo ) {

						if( !empty( $photo ) ) {

							if( !empty( $photo ) ) {

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= '<a href="' . esc_url( wp_get_attachment_image_src( esc_attr( $photo ), 'full', true, true )[0] ) . '" data-srcset="' . wp_get_attachment_image_srcset( esc_attr( $photo ), 'full' ) . '" data-caption="' . wp_get_attachment_caption( esc_attr( $photo ) ) . '" data-fancybox="speaker-photos">';
											$output .= wp_get_attachment_image( esc_attr( $photo ), 'eventchamp-thumbnail', true, true );
										$output .= '</a>';
									$output .= '</div>';
								$output .= '</div>';

							}

						}

					}

				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Speaker Photos Section
*
======*/
if( !function_exists( 'eventchamp_speaker_photos_section' ) ) {

	function eventchamp_speaker_photos_section( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$photos_status = get_post_meta( esc_attr( $id ), 'speaker-photos-status', true );
			$photos = get_post_meta( esc_attr( $id ), 'speaker_image_gallery', true );

			if( $photos_status == "default" or empty( $photos_status ) ) {

				$photos_status = ot_get_option( 'speaker-photos-status', 'true' );

			}

			if( $photos_status == "true" and !empty( $photos ) ) {

				$output .= '<div class="gt-section">';
					$output .= '<div class="gt-section-title">';
						$output .= esc_html__( 'Photos', 'eventchamp' );
					$output .= '</div>';
					$output .= '<div class="gt-section-content">';
						$output .= eventchamp_speaker_photos( $id = $id );
					$output .= '</div>';
				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Speaker of Events
*
======*/
if( !function_exists( 'eventchamp_event_speakers' ) ) {

	function eventchamp_event_speakers( $post_id = "", $column = "4", $column_space = "0", $style = "style-1", $image = "true", $profession = "true", $summary = "true", $social = "true" ) {

		$output = '';

		if( !empty( $post_id ) ) {

			$event_speakers = get_post_meta( esc_attr( $post_id ), 'event_speakers', true );

			if( !empty( $event_speakers ) ) {

				$output .= '<div class="gt-speakers gt-columns gt-column-' . esc_attr( $column ) . ' gt-column-space-' . esc_attr( $column_space ) . '">';

					foreach ( $event_speakers as $event_speaker ) {

						if( !empty( $event_speaker ) ) {

							$event_speaker_ids[] = $event_speaker;

						}

					}

					$args_posts = array(
						'posts_per_page' => -1,
						'post__in' => $event_speaker_ids,
						'post_status' => 'publish',
						'ignore_sticky_posts'    => true,
						'post_type' => 'speaker',
					);

					$wp_query = new WP_Query($args_posts);

					if( !empty( $wp_query ) ) {

						while ( $wp_query->have_posts() ) {

							$wp_query->the_post();
							$output .= '<div class="gt-col">';
								$output .= '<div class="gt-inner">';

									if( $style == "style-1" ) {

										$output .= eventchamp_speaker_style_1( $post_id = get_the_ID(), $image = $image, $profession = $profession, $summary = $summary, $social = $social );

									} elseif( $style == "style-2" ) {

										$output .= eventchamp_speaker_style_2( $post_id = get_the_ID(), $image = $image, $profession = $profession, $summary = $summary, $social = $social );

									} elseif( $style == "style-3" ) {

										$output .= eventchamp_speaker_style_3( $post_id = get_the_ID(), $image = $image, $profession = $profession, $summary = $summary, $social = $social );

									} elseif( $style == "style-4" ) {

										$output .= eventchamp_speaker_style_4( $post_id = get_the_ID(), $image = $image, $profession = $profession, $summary = $summary, $social = $social );

									} elseif( $style == "style-5" ) {

										$output .= eventchamp_speaker_style_5( $post_id = get_the_ID(), $image = $image, $profession = $profession, $summary = $summary, $social = $social );

									} elseif( $style == "style-6" ) {

										$output .= eventchamp_speaker_style_6( $post_id = get_the_ID(), $image = $image, $profession = $profession, $summary = $summary, $social = $social );

									} elseif( $style == "style-7" ) {

										$output .= eventchamp_speaker_style_7( $post_id = get_the_ID(), $image = $image, $profession = $profession, $summary = $summary, $social = $social );

									} elseif( $style == "style-8" ) {

										$output .= eventchamp_speaker_style_8( $post_id = get_the_ID(), $image = $image, $profession = $profession, $summary = $summary, $social = $social );

									}

								$output .= '</div>';
							$output .= '</div>';

						}

					}

					wp_reset_postdata();

				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Events of Speaker
*
======*/
if( !function_exists( 'eventchamp_speaker_events' ) ) {

	function eventchamp_speaker_events( $id = "" ) {

		$output = "";

		$hide_expired_events = ot_get_option( 'event-expired-events-archives', 'off' );

		$speaker_events = ot_get_option( 'speaker-events', 'on' );
		$count = ot_get_option( 'speaker-events-count', '9' );

		if( $count >= 3 ) {

			$column_count = "3";

		} else {

			$column_count = esc_attr( $count );

		}

		if( $hide_expired_events == "on" ) {

			$expired_events_ids = eventchamp_expired_event_ids();

		} else {

			$expired_events_ids = array();

		}

		if( !empty( $expired_events_ids ) ) {

			$expired_events_ids = array_merge( $expired_events_ids, $expired_events_ids );

		}

		if( !empty( $id ) ) {

			if( $speaker_events == 'on' ) {

				$speaker_style = ot_get_option( 'speaker-events-style', 'style-3' );

				$args = array(
					'post__not_in' => $expired_events_ids,
					'posts_per_page' => esc_attr( $count ),
					'post_status' => 'publish',
					'meta_key'   => 'event_speakers',
					'post_type' => 'event',
					'meta_query' => array(
						array(
							'key' => 'event_speakers',
							'compare' => 'LIKE',
							'value' => ':' . esc_attr( $id ) . ';',
						)
					),
				);

				$wp_query = new WP_Query( $args );

				if( !empty( $wp_query->have_posts() ) ) {

					$output .= '<div class="gt-speaker-events">';
						$output .= eventchamp_section_title( $primary_title = esc_html__( 'Events of the Speaker', 'eventchamp' ), $secondary_title = "", $text = esc_html__( 'You might also love these events.', 'eventchamp' ), $style = "dark", $size = "size1", $align = "center", $separator = "true", $icon = "far fa-calendar-alt" );
						$output .= '<div class="gt-columns gt-column-' . esc_attr( $column_count ) . ' gt-column-space-30">';

							while( $wp_query->have_posts() ) {

								$wp_query->the_post();

								if( $speaker_style == "style-1" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "true", $status = "true", $price = "false", $venue = "false" );
										$output .= '</div>';
									$output .= '</div>';

								} elseif( $speaker_style == "style-2" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "true", $status = "true", $price = "false", $venue = "false" );
										$output .= '</div>';
									$output .= '</div>';

								} else {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "true", $status = "true", $price = "false", $venue = "false" );
										$output .= '</div>';
									$output .= '</div>';

								}

							}
							wp_reset_postdata();

						$output .= '</div>';
					$output .= '</div>';

				}

			}

		}

		return $output;

	}

}



/*======
*
* Related Speakers
*
======*/
if( !function_exists( 'eventchamp_related_speakers' ) ) {

	function eventchamp_related_speakers( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$tags = wp_get_post_terms( $id, 'speaker-tags' );
			$related_speakers = ot_get_option( 'speaker-related-speakers', 'on' );
			$speaker_style = ot_get_option( 'speaker-related-speakers-style', 'style-3' );
			$count = ot_get_option( 'speaker-related-speakers-count', '3' );

			if( $count >= 3 ) {

				$column_count = "3";

			} else {

				$column_count = esc_attr( $count );

			}

			if( $related_speakers == "on" ) {

				if ( !empty( $tags ) ) {

					$tag_ids = array();

					foreach( $tags as $tag ) {

						if ( !empty( $tag ) ) {

							$tag_ids[] = $tag->term_id;

						}

					}

					$args = array(
						'post__not_in' => array( $id ),
						'post_status' => 'publish',
						'post_type' => 'speaker',
						'ignore_sticky_posts' => true,
						'posts_per_page' => $count,
						'tax_query' => array(
							array(
								'taxonomy' => 'speaker-tags',
								'field' => 'term_id',
								'terms' => $tag_ids,
							),
						),
					);
					$query = new wp_query( $args );

					if( !empty( $query->have_posts() ) ) {

						$output .= '<div class="gt-related-speakers">';
							$output .= eventchamp_section_title( $primary_title = esc_html__( 'Related', 'eventchamp' ), $secondary_title = esc_html__( 'Speakers', 'eventchamp' ), $text = esc_html__( 'You might also love these speakers.', 'eventchamp' ), $style = "dark", $size = "size1", $align = "center", $separator = "true", $icon = "fas fa-headphones-alt" );
								$output .= '<div class="gt-columns gt-column-' . esc_attr( $column_count ) . ' gt-column-space-30">';

								while( $query->have_posts() ) {

									$query->the_post();

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';

											if( $speaker_style == "style-1" ) {

												$output .= eventchamp_speaker_style_1( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );

											} elseif( $speaker_style == "style-2" ) {

												$output .= eventchamp_speaker_style_2( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );

											} elseif( $speaker_style == "style-3" ) {

												$output .= eventchamp_speaker_style_3( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );

											} elseif( $speaker_style == "style-4" ) {

												$output .= eventchamp_speaker_style_4( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );

											} elseif( $speaker_style == "style-5" ) {

												$output .= eventchamp_speaker_style_5( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );

											} elseif( $speaker_style == "style-6" ) {

												$output .= eventchamp_speaker_style_6( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );

											} elseif( $speaker_style == "style-7" ) {

												$output .= eventchamp_speaker_style_7( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );

											} elseif( $speaker_style == "style-8" ) {

												$output .= eventchamp_speaker_style_8( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );

											}

										$output .= '</div>';
									$output .= '</div>';

								}
								wp_reset_postdata();

							$output .= '</div>';
						$output .= '</div>';

					}

				}

			}

		}

		return $output;

	}

}