<?php
/*======
*
* Eventchamp Slider
*
======*/
if( !function_exists( 'eventchamp_slider_output' ) ) {

	function eventchamp_slider_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'slides' => '',
				'separator' => '',
				'separator-color' => '',
				'slider-height' => '100vh',
				'slider-column' => '1',
				'slider-space' => '0',
				'slider-autoplay' => 'false',
				'slider-loop' => 'false',
				'slider-slide-speed' => '1000',
				'slider-centered-slides' => 'false',
				'slider-direction' => 'horizontal',
				'slider-effect' => 'slide',
				'slider-free-mode' => 'false',
				'navigation' => 'false',
				'navigation-style' => 'style-1',
				'pagination' => 'false',
				'pagination-style' => 'style-1',
			), $atts
		);
		
		$output = '';

		/*====== Slides ======*/
		$slides = vc_param_group_parse_atts( $atts['slides'] );

		/*====== Separator Color ======*/
		if( empty( $atts["separator-color"] ) ) {

			$separator_color = "#FFFFFF";

		} else {

			$separator_color = esc_attr( $atts["separator-color"] );

		}

		/*====== Slider Height ======*/
		if( empty( $atts["slider-height"] ) ) {

			$atts["slider-height"] = "100vh";

		}

		/*====== Column ======*/
		if( empty( $atts["slider-column"] ) ) {

			$atts["slider-column"] = "1";

		}

		/*====== Column Space ======*/
		if( empty( $atts["slider-space"] ) ) {

			$atts["slider-space"] = "0";

		}

		/*====== Slider Autoplay ======*/
		if( empty( $atts["slider-autoplay"] ) ) {

			$atts["slider-autoplay"] = "false";

		}

		/*====== Slider Loop ======*/
		if( empty( $atts["slider-loop"] ) ) {

			$atts["slider-loop"] = "false";

		}

		/*====== Slider Slide Speed ======*/
		if( empty( $atts["slider-slide-speed"] ) ) {

			$atts["slider-slide-speed"] = "1000";

		}

		/*====== Slider Direction ======*/
		if( empty( $atts["slider-direction"] ) ) {

			$atts["slider-direction"] = "horizontal";

		}

		/*====== Slider Effect ======*/
		if( empty( $atts["slider-effect"] ) ) {

			$atts["slider-effect"] = "slide";

		}

		/*====== Centered Slides ======*/
		if( empty( $atts["slider-centered-slides"] ) ) {

			$atts["slider-centered-slides"] = "false";

		}

		/*====== Slider Free Mode ======*/
		if( empty( $atts["slider-free-mode"] ) ) {

			$atts["slider-free-mode"] = "false";

		}

		/*====== HTML Output ======*/
		if( !empty( $slides ) ) {

			$output .= '<div class="gt-eventchamp-slider" style="height:' . esc_attr( $atts["slider-height"] ) . ';">';
				$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item="' . esc_attr( $atts["slider-column"] ) . '" data-gt-item-space="' . esc_attr( $atts["slider-space"] ) . '" data-gt-loop="' . esc_attr( $atts["slider-loop"] ) . '" data-gt-speed="' . esc_attr( $atts["slider-slide-speed"] ) . '" data-gt-direction="' . esc_attr( $atts["slider-direction"] ) . '" data-gt-effect="' . esc_attr( $atts["slider-effect"] ) . '" data-gt-centered-slides="' . esc_attr( $atts["slider-centered-slides"] ) . '" data-gt-free-mode="' . esc_attr( $atts["slider-free-mode"] ) . '">';
					$output .= '<div class="swiper-wrapper">';

						foreach( $slides as $slide ) {

							if( !empty( $slide ) ) {

								/*====== Autoplay Delay ======*/
								if( empty( $slide["autoplay-delay"] ) ) {

									$slide["autoplay-delay"] == "15000";

								}

								/*====== Opacity Color ======*/
								if( empty( $slide["opacity-color"] ) ) {

									$slide["opacity-color"] = "#000000";

								}

								/*====== Background Image Position ======*/
								if( empty( $slide["background-image-position"] ) ) {

									$slide["background-image-position"] = "default";

								}

								/*====== Background Image Attachment ======*/
								if( empty( $slide["background-image-attachment"] ) ) {

									$slide["background-image-attachment"] = "default";

								}

								/*====== Background Image Size ======*/
								if( empty( $slide["background-image-size"] ) ) {

									$slide["background-image-size"] = "default";

								}

								/*====== Background Image Repeat ======*/
								if( empty( $slide["background-image-repeat"] ) ) {

									$slide["background-image-repeat"] = "default";

								}

								if( $atts["slider-autoplay"] == "true" ) {

									$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $slide["autoplay-delay"] ) . '">';

								} else {

									$output .= '<div class="swiper-slide">';

								}

									if( !empty( $slide["background-image"] ) ) {

										$output .= '<div class="gt-slide-inner gt-background-position-' . esc_attr( $slide["background-image-position"] ) . ' gt-background-attachment-' . esc_attr( $slide["background-image-attachment"] ) . ' gt-background-size-' . esc_attr( $slide["background-image-size"] ) . ' gt-background-repeat-' . esc_attr( $slide["background-image-repeat"] ) . ' gt-lazy-load" data-background="' . esc_url( wp_get_attachment_image_src( $slide["background-image"], 'eventchamp-event-slider' )[0] ) . '">';

									} else {

										$output .= '<div class="gt-slide-inner">';

									}

										if( $slide["opacity"] == "true" ) {

											$output .= '<div class="gt-opacity" style="opacity: ' . esc_attr( $slide["opacity-value"] ) . '; background-color: ' . esc_attr( $slide["opacity-color"] ) . ';"></div>';

										}

										$output .= '<div class="gt-slider-content">';

											if( !empty( $slide["subtitle"] ) ) {

												$output .= '<div class="gt-subtitle">' . esc_attr( $slide["subtitle"] ) . '</div>';

											}

											if( !empty( $slide["primary-title"] ) or !empty( $slide["secondary-title"] ) ) {

												$output .= '<div class="gt-title">';

													if( !empty( $slide["primary-title"] ) ) {

														$output .= '<span class="gt-primary">' . esc_attr( $slide["primary-title"] ) . '</span>';

													}

													if( !empty( $slide["secondary-title"] ) ) {

														$output .= '<span class="gt-secondary">' . esc_attr( $slide["secondary-title"] ) . '</span>';

													}

												$output .= '</div>';

											}

											if( !empty( $slide["text"] ) ) {

												$output .= '<div class="gt-text">' . wpautop( esc_attr( $slide["text"] ) ) . '</div>';

											}

											if( !empty( $slide["button-1"] ) ) {

												$output .= '<div class="gt-buttons">';

													if( !empty( $slide["button-1"] ) ) {

														if( $slide["button-1-status"] == "true" ) {

															$href = $slide["button-1"];
															$href = vc_build_link( $href );

															if( !empty( $href["target"] ) ) {

																$target = $href["target"];

															} else {

																$target = "_parent";

															}

															if( !empty( $href["title"] ) ) {

																$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';
																	$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
																$output .= '</a>';

															}

														}

													}

													if( !empty( $slide["button-2"] ) ) {

														if( $slide["button-2-status"] == "true" ) {

															$href = $slide["button-2"];
															$href = vc_build_link( $href );

															if( !empty( $href["target"] ) ) {

																$target = $href["target"];

															} else {

																$target = "_parent";

															}

															if( !empty( $href["title"] ) ) {

																$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';
																	$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
																$output .= '</a>';

															}

														}

													}

												$output .= '</div>';

											}

										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';

							}

						}

					$output .= '</div>';

					if( $atts["separator"] == "style-1" ) {

						$output .= '<div class="gt-separator gt-style-1">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 51" preserveAspectRatio="none"><path d="M1480 51V8c-17 0-34 2.3-47 6.8l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0L1157 25.1c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0L787 14.8c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.5-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0L47 14.8C34 10.3 17 8 0 8v43h1480z"></path></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-2" ) {

						$output .= '<div class="gt-separator gt-style-2">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 103.5" preserveAspectRatio="none"><path d="M1480 103.5V7.7c-6.8.2-13.5.6-20.3.7-45.5 1.1-90.4 6.9-134 20.1-23.9 7.2-47 16.8-70.6 24.8-14 4.7-28.2 8.7-42.4 12.8-23.7 6.8-47.9 9.9-72.4 11.3-17 1-34.3 2.7-51.2 1.1-26.2-2.4-52.3-6.5-78.1-11.2-30.8-5.7-60.1-17-89.3-28.2C865.3 17.4 806.6 7.1 746.3 7c-57.8-.1-115.1 5.7-170.4 24-22.1 7.3-43.6 16.1-65.7 23.6-38.6 13.1-78.2 21.1-118.9 23.7-66.6 4.2-130.7-7.7-192.7-31.8-40.5-15.8-81.9-28.1-125-33.8C49.3 9.4 24.7 7.1 0 7.7v95.8h1480z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-3" ) {

						$output .= '<div class="gt-separator gt-style-3">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 142.3" preserveAspectRatio="none"><path d="M704.6 52.7C430.3 1.4 174.9 23 0 43.7v98.7h1480V43.7c-192.5 22.8-441.9 71.3-775.4 9z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-4" ) {

						$output .= '<div class="gt-separator gt-style-4">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 117"  preserveAspectRatio="none"><path d="M0 24.5c246.7 46.3 493.3 69.4 740 69.4s493.3-23.1 740-69.4V117H0V24.5z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-5" ) {

						$output .= '<div class="gt-separator gt-style-5">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 160"><path d="M0 160L1480 12v148z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-6" ) {

						$output .= '<div class="gt-separator gt-style-6">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 60"><path d="M74 22.5C33.1 22.5 0 39.3 0 60h148c0-20.7-33.1-37.5-74-37.5zM222 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM370 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM518 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM666 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM814 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM962 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1110 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1258 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1406 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-7" ) {

						$output .= '<div class="gt-separator gt-style-7">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 60"><path d="M43.5 22L0 60h87.1zM130.6 22L87.1 60h87zM217.6 22l-43.5 38h87.1zM304.7 22l-43.5 38h87zM391.8 22l-43.6 38h87.1zM478.8 22l-43.5 38h87.1zM565.9 22l-43.5 38h87zM652.9 22l-43.5 38h87.1zM740 22l-43.5 38h87zM827.1 22l-43.6 38h87.1zM914.1 22l-43.5 38h87zM1001.2 22l-43.6 38h87.1zM1088.2 22l-43.5 38h87.1zM1175.3 22l-43.5 38h87zM1262.4 22l-43.6 38h87.1zM1349.4 22l-43.5 38h87zM1436.5 22l-43.6 38h87.1z"/></svg>';
						$output .= '</div>';

					}

					if( $atts["pagination"] == "true" ) {

						if( $atts["separator"] !== "false" ) {

							$output .= '<div class="swiper-pagination gt-slider-pagination gt-' . esc_attr( $atts["pagination-style"] ) . '"></div>';

						} else {

							$output .= '<div class="swiper-pagination gt-slider-pagination gt-' . esc_attr( $atts["pagination-style"] ) . '"></div>';

						}

					}

					if( $atts["navigation"] == "true" ) {

						$output .= '<div class="gt-slider-prev gt-slider-control gt-' . esc_attr( $atts["navigation-style"] ) . '">';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
						$output .= '</div>';
						$output .= '<div class="gt-slider-next gt-slider-control gt-' . esc_attr( $atts["navigation-style"] ) . '">';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
						$output .= '</div>';

					}

				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_slider", "eventchamp_slider_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Eventchamp Slider', 'eventchamp' ),
				"base" => "eventchamp_slider",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-slider.jpg',
				"description" => esc_html__( 'Eventchamp slider element.', 'eventchamp' ),
				"params" => array(
					array(
						'type' => 'param_group',
						'param_name' => 'slides',
						"heading" => esc_html__( 'Slides', 'eventchamp' ),
						"description" => esc_html__( 'You can create slides from this panel.', 'eventchamp' ),
						"save_always" => true,
						'params' => array(
							array(
								"type" => "textfield",
								"param_name" => "primary-title",
								"heading" => esc_html__( 'Primary Title', 'eventchamp' ),
								"description" => esc_html__( 'You can enter a primary title.', 'eventchamp' ),
								'admin_label' => true,
								'save_always' => true,
							),
							array(
								"type" => "textfield",
								"param_name" => "secondary-title",
								"heading" => esc_html__( 'Secondary Title', 'eventchamp' ),
								"description" => esc_html__( 'You can enter a secondary title.', 'eventchamp' ),
								'admin_label' => true,
								'save_always' => true,
							),
							array(
								"type" => "textfield",
								"param_name" => "subtitle",
								"heading" => esc_html__( 'Subtitle', 'eventchamp' ),
								"description" => esc_html__( 'You can enter a subtitle.', 'eventchamp' ),
								'admin_label' => true,
								'save_always' => true,
							),
							array(
								"type" => "textfield",
								"param_name" => "text",
								"heading" => esc_html__( 'Text', 'eventchamp' ),
								"description" => esc_html__( 'You can enter a text.', 'eventchamp' ),
								'save_always' => true,
							),
							array(
								"type" => "dropdown",
								"param_name" => "button-1-status",
								"heading" => esc_html__( 'Button 1 Status', 'eventchamp' ),
								"description" => esc_html__( 'You can choose status of the button 1.', 'eventchamp' ),
								"save_always" => true,
								"value" => array(
									esc_html__( 'False', 'eventchamp' ) => 'false',
									esc_html__( 'True', 'eventchamp' ) => 'true',
								),
							),
							array(
								"type" => "vc_link",
								"param_name" => "button-1",
								"heading" => esc_html__( 'Button 1', 'eventchamp' ),
								"description" => esc_html__( 'You can create a button.', 'eventchamp' ),
								'save_always' => true,
							),
							array(
								"type" => "dropdown",
								"param_name" => "button-2-status",
								"heading" => esc_html__( 'Button 2 Status', 'eventchamp' ),
								"description" => esc_html__( 'You can choose status of the button 2.', 'eventchamp' ),
								"save_always" => true,
								"value" => array(
									esc_html__( 'False', 'eventchamp' ) => 'false',
									esc_html__( 'True', 'eventchamp' ) => 'true',
								),
							),
							array(
								"type" => "vc_link",
								"param_name" => "button-2",
								"heading" => esc_html__( 'Button 2', 'eventchamp' ),
								"description" => esc_html__( 'You can create a button.', 'eventchamp' ),
								'save_always' => true,
							),
							array(
								"type" => "attach_image",
								"param_name" => "background-image",
								"heading" => esc_html__( 'Background Image', 'eventchamp' ),
								"description" => esc_html__( 'You can upload a background image. Recommended size: 1920x1100', 'eventchamp' ),
								"save_always" => true,
							),
							array(
								"type" => "dropdown",
								"param_name" => "background-image-position",
								"heading" => esc_html__( 'Background Image Position', 'eventchamp' ),
								"description" => esc_html__( 'You can choose a background image position. Default: Center Center.', 'eventchamp' ),
								"save_always" => true,
								"value" => array(
									esc_html__( 'Default', 'eventchamp' ) => 'default',
									esc_html__( 'Initial', 'eventchamp' ) => 'initial',
									esc_html__( 'Inherit', 'eventchamp' ) => 'inherit',
									esc_html__( 'Center Center', 'eventchamp' ) => 'center-center',
									esc_html__( 'Center Top', 'eventchamp' ) => 'center-top',
									esc_html__( 'Center Bottom', 'eventchamp' ) => 'center-top',
									esc_html__( 'Left Top', 'eventchamp' ) => 'left-top',
									esc_html__( 'Left Center', 'eventchamp' ) => 'left-center',
									esc_html__( 'Left Bottom', 'eventchamp' ) => 'left-bottom',
									esc_html__( 'Right Top', 'eventchamp' ) => 'right-top',
									esc_html__( 'Right Center', 'eventchamp' ) => 'right-center',
									esc_html__( 'Right Bottom', 'eventchamp' ) => 'right-bottom',
								),
							),
							array(
								"type" => "dropdown",
								"param_name" => "background-image-attachment",
								"heading" => esc_html__( 'Background Image Attachment', 'eventchamp' ),
								"description" => esc_html__( 'You can choose a background image attachment. Default: Scroll', 'eventchamp' ),
								"save_always" => true,
								"value" => array(
									esc_html__( 'Default', 'eventchamp' ) => 'default',
									esc_html__( 'Initial', 'eventchamp' ) => "initial",
									esc_html__( 'Inherit', 'eventchamp' ) => "inherit",
									esc_html__( 'Scroll', 'eventchamp' ) => "scroll",
									esc_html__( 'Fixed', 'eventchamp' ) => "fixed",
									esc_html__( 'Local', 'eventchamp' ) => "local",
								),
							),
							array(
								"type" => "dropdown",
								"param_name" => "background-image-size",
								"heading" => esc_html__( 'Background Image Size', 'eventchamp' ),
								"description" => esc_html__( 'You can choose a background image size. Default: Cover', 'eventchamp' ),
								"save_always" => true,
								"value" => array(
									esc_html__( 'Default', 'eventchamp' ) => 'default',
									esc_html__( 'Initial', 'eventchamp' ) => "initial",
									esc_html__( 'Inherit', 'eventchamp' ) => "inherit",
									esc_html__( 'Auto', 'eventchamp' ) => "auto",
									esc_html__( 'Cover', 'eventchamp' ) => "cover",
									esc_html__( 'Contain', 'eventchamp' ) => "contain",
								),
							),
							array(
								"type" => "dropdown",
								"param_name" => "background-image-repeat",
								"heading" => esc_html__( 'Background Image Repeat', 'eventchamp' ),
								"description" => esc_html__( 'You can choose a background image repeat. Default: No Repeat', 'eventchamp' ),
								"save_always" => true,
								"value" => array(
									esc_html__( 'Default', 'eventchamp' ) => 'default',
									esc_html__( 'Initial', 'eventchamp' ) => "initial",
									esc_html__( 'Inherit', 'eventchamp' ) => "inherit",
									esc_html__( 'Repeat', 'eventchamp' ) => "repeat",
									esc_html__( 'Repeat X', 'eventchamp' ) => "repeat-x",
									esc_html__( 'Repeat Y', 'eventchamp' ) => "repeat-y",
									esc_html__( 'No Repeat', 'eventchamp' ) => "no-repeat",
									esc_html__( 'Space', 'eventchamp' ) => "space",
									esc_html__( 'Round', 'eventchamp' ) => "round",
								),
							),
							array(
								"type" => "textfield",
								"param_name" => "autoplay-delay",
								"heading" => esc_html__( 'Slide Autoplay Delay', 'eventchamp' ),
								"description" => esc_html__( 'You can enter an autoplay delay. Default: 15000', 'eventchamp' ),
								"save_always" => true,
							),
							array(
								"type" => "dropdown",
								"param_name" => "opacity",
								"heading" => esc_html__( 'Opacity', 'eventchamp' ),
								"description" => esc_html__( 'You can choose status of the opacity.', 'eventchamp' ),
								"group" => esc_html__( 'Design', 'eventchamp' ),
								'save_always' => true,
								"value" => array(
									esc_html__( 'False', 'eventchamp' ) => 'false',
									esc_html__( 'True', 'eventchamp' ) => 'true',
								),
							),
							array(
								"type" => "dropdown",
								"param_name" => "opacity-value",
								"heading" => esc_html__( 'Opacity Value', 'eventchamp' ),
								"description" => esc_html__( 'You can choose an opacity value. Default: 0.3.', 'eventchamp' ),
								"group" => esc_html__( 'Design', 'eventchamp' ),
								'save_always' => true,
								"value" => array(
									esc_html__( '5', 'eventchamp' ) => '0.05',
									esc_html__( '10', 'eventchamp' ) => '0.1',
									esc_html__( '15', 'eventchamp' ) => '0.15',
									esc_html__( '20', 'eventchamp' ) => '0.2',
									esc_html__( '25', 'eventchamp' ) => '0.25',
									esc_html__( '30', 'eventchamp' ) => '0.3',
									esc_html__( '35', 'eventchamp' ) => '0.35',
									esc_html__( '40', 'eventchamp' ) => '0.4',
									esc_html__( '45', 'eventchamp' ) => '0.45',
									esc_html__( '50', 'eventchamp' ) => '0.5',
									esc_html__( '55', 'eventchamp' ) => '0.55',
									esc_html__( '60', 'eventchamp' ) => '0.6',
									esc_html__( '65', 'eventchamp' ) => '0.65',
									esc_html__( '70', 'eventchamp' ) => '0.7',
									esc_html__( '75', 'eventchamp' ) => '0.75',
									esc_html__( '80', 'eventchamp' ) => '0.8',
									esc_html__( '85', 'eventchamp' ) => '0.85',
									esc_html__( '90', 'eventchamp' ) => '0.9',
									esc_html__( '95', 'eventchamp' ) => '0.95',
									esc_html__( '100', 'eventchamp' ) => '1',
								),
							),
							array(
								"type" => "colorpicker",
								"param_name" => "opacity-color",
								"heading" => esc_html__( 'Opacity Color', 'eventchamp' ),
								"description" => esc_html__( 'You can choose a color for the separator. Default: #000000', 'eventchamp' ),
								"group" => esc_html__( 'Design', 'eventchamp' ),
								'save_always' => true,
							),
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "separator",
						"heading" => esc_html__( 'Separator', 'eventchamp' ),
						"description" => esc_html__( 'You can choose style of the separator.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'False',
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style-3',
							esc_html__( 'Style 4', 'eventchamp' ) => 'style-4',
							esc_html__( 'Style 5', 'eventchamp' ) => 'style-5',
							esc_html__( 'Style 6', 'eventchamp' ) => 'style-6',
							esc_html__( 'Style 7', 'eventchamp' ) => 'style-7',
						),
					),
					array(
						"type" => "colorpicker",
						"param_name" => "separator-color",
						"heading" => esc_html__( 'Separator Color', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a color for the separator. Default: #FFFFFF', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-height",
						"heading" => esc_html__( 'Slider Height', 'eventchamp' ),
						"description" => esc_html__( 'Enter a slider height. Example: 600px. If enter blank, it will have full height.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-space",
						"heading" => esc_html__( 'Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a space value for space between the slides.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0px', 'eventchamp' ) => '0',
							esc_html__( '1px', 'eventchamp' ) => '1',
							esc_html__( '2px', 'eventchamp' ) => '2',
							esc_html__( '3px', 'eventchamp' ) => '3',
							esc_html__( '4px', 'eventchamp' ) => '4',
							esc_html__( '5px', 'eventchamp' ) => '5',
							esc_html__( '10px', 'eventchamp' ) => '10',
							esc_html__( '15px', 'eventchamp' ) => '15',
							esc_html__( '20px', 'eventchamp' ) => '20',
							esc_html__( '25px', 'eventchamp' ) => '25',
							esc_html__( '30px', 'eventchamp' ) => '30',
							esc_html__( '45px', 'eventchamp' ) => '45',
							esc_html__( '50px', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-autoplay",
						"heading" => esc_html__( 'Slider Autoplay', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the autoplay.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-loop",
						"heading" => esc_html__( 'Slider Loop', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the loop.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-slide-speed",
						"heading" => esc_html__( 'Slide Speed', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a slide speed. Duration of transition between the slides. Default: 1000', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-centered-slides",
						"heading" => esc_html__( 'Centered Slides', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the centered slides. If you choose true, then active slide will be centered, not always on the left side.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-direction",
						"heading" => esc_html__( 'Slider Direction', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a direction.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Horizontal', 'eventchamp' ) => 'horizontal',
							esc_html__( 'Vertical', 'eventchamp' ) => 'vertical',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-effect",
						"heading" => esc_html__( 'Slider Effect', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an effect.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Slide', 'eventchamp' ) => 'slide',
							esc_html__( 'Fade', 'eventchamp' ) => 'fade',
							esc_html__( 'Cube', 'eventchamp' ) => 'cube',
							esc_html__( 'Coverflow', 'eventchamp' ) => 'coverflow',
							esc_html__( 'Flip', 'eventchamp' ) => 'flip',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-free-mode",
						"heading" => esc_html__( 'Free Mode', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the free mode. If true then slides will not have fixed positions', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "navigation",
						"heading" => esc_html__( 'Navigation', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the navigation.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "navigation-style",
						"heading" => esc_html__( 'Navigation Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a navigation style.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "pagination",
						"heading" => esc_html__( 'Pagination', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "pagination-style",
						"heading" => esc_html__( 'Pagination Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a pagination style.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Events Slider
*
======*/
if( !function_exists( 'eventchamp_latest_events_slider_output' ) ) {

	function eventchamp_latest_events_slider_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'eventcount' => '',
				'eventids' => '',
				'excludeevents' => '',
				'offset' => '',
				'order' => '',
				'order-type' => '',
				'hide-expired' => '',
				'exclude-categories' => '',
				'exclude-locations' => '',
				'exclude-organizers' => '',
				'exclude-tags' => '',
				'include-categories' => '',
				'include-locations' => '',
				'include-organizers' => '',
				'include-tags' => '',
				'separator' => 'false',
				'separator-color' => '',
				'details-button' => 'true',
				'customtextdetailsbutton' => '',
				'buy-now-button' => 'true',
				'customtextbuynowbutton' => '',
				'category' => 'true',
				'startdate' => '',
				'enddate' => '',
				'location' => '',
				'venue' => '',
				'slider-height' => '100vh',
				'opacity' => 'true',
				'opacity-value' => '0.3',
				'opacity-color' => '0.3',
				'slider-column' => '1',
				'slider-space' => '0',
				'slider-autoplay' => 'false',
				'slider-autoplay-delay' => '15000',
				'slider-loop' => 'false',
				'slider-slide-speed' => '1000',
				'slider-centered-slides' => 'false',
				'slider-direction' => 'horizontal',
				'slider-effect' => 'slide',
				'slider-free-mode' => 'false',
				'navbuttons' => 'false',
				'navigation-style' => 'style-1',
				'dots' => 'false',
				'pagination-style' => 'style-1',
			), $atts
		);
		
		$output = '';

		/*====== Separator ======*/
		if( empty( $atts["separator-color"] ) ) {

			$separator_color = "#FFFFFF";

		} else {

			$separator_color = esc_attr( $atts["separator-color"] );

		}

		/*====== Slider Height ======*/
		if( empty( $atts["slider-height"] ) ) {

			$atts["slider-height"] = "100vh";

		}

		/*====== Opacity ======*/
		if( empty( $atts["opacity"] ) ) {

			$atts["opacity"] = "true";

		}

		/*====== Opacity Value ======*/
		if( empty( $atts["opacity-value"] ) ) {

			$atts["opacity-value"] = "0.3";

		}

		/*====== Opacity Color ======*/
		if( empty( $atts["opacity-color"] ) ) {

			$opacity_color = "#000000";

		} else {

			$opacity_color = esc_attr( $atts["opacity-color"] );

		}

		/*====== Column ======*/
		if( empty( $atts["slider-column"] ) ) {

			$atts["slider-column"] = "1";

		}

		/*====== Column Space ======*/
		if( empty( $atts["slider-space"] ) ) {

			$atts["slider-space"] = "0";

		}

		/*====== Slider Autoplay Delay ======*/
		if( empty( $atts["slider-autoplay-delay"] ) ) {

			$atts["slider-autoplay-delay"] = "15000";

		}

		/*====== Slider Loop ======*/
		if( empty( $atts["slider-loop"] ) ) {

			$atts["slider-loop"] = "false";

		}

		/*====== Slider Slide Speed ======*/
		if( empty( $atts["slider-slide-speed"] ) ) {

			$atts["slider-slide-speed"] = "1000";

		}

		/*====== Centered Slides ======*/
		if( empty( $atts["slider-centered-slides"] ) ) {

			$atts["slider-centered-slides"] = "false";

		}

		/*====== Slider Direction ======*/
		if( empty( $atts["slider-direction"] ) ) {

			$atts["slider-direction"] = "horizontal";

		}

		/*====== Slider Effect ======*/
		if( empty( $atts["slider-effect"] ) ) {

			$atts["slider-effect"] = "slide";

		}

		/*====== Slider Free Mode ======*/
		if( empty( $atts["slider-free-mode"] ) ) {

			$atts["slider-free-mode"] = "false";

		}

		/*====== Expired Events Status ======*/
		if( !empty( $atts['hide-expired'] ) ) {

			$hideexpired = esc_attr( $atts["hide-expired"] );

		} else {

			$hideexpired = "false";

		}

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['exclude-categories'] ) ) {

			$exclude_categories = $atts['exclude-categories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Organizers ======*/
		$exclude_organizer_array = "";

		if( !empty( $atts['exclude-organizers'] ) ) {

			$exclude_organizers = $atts['exclude-organizers'];
			$exclude_organizers = explode( ',', $exclude_organizers );

		} else {

			$exclude_organizers = "";

		}

		if( !empty( $exclude_organizers ) ) {

			$exclude_organizer_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $exclude_organizers,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $atts['include-categories'] ) ) {

			$include_categories = $atts['include-categories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		if( !empty( $include_categories ) ) {

			$include_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $include_categories,
				'operator' => 'IN',
			);

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		if( !empty( $include_locations ) ) {

			$include_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $include_locations,
				'operator' => 'IN',
			);

		}

		/*====== Include Organizers ======*/
		$include_organizers_array = "";

		if( !empty( $atts['include-organizers'] ) ) {

			$include_organizers = $atts['include-organizers'];
			$include_organizers = explode( ',', $include_organizers );

		} else {

			$include_organizers = "";

		}

		if( !empty( $include_organizers ) ) {

			$include_organizers_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $include_organizers,
				'operator' => 'IN',
			);

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		if( !empty( $include_tags ) ) {

			$include_tags_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $include_tags,
				'operator' => 'IN',
			);

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'event',
			'tax_query' => array (
				'relation' => 'AND',
				$include_location_array,
				$include_category_array,
				$include_organizers_array,
				$include_tags_array,
				$exclude_category_array,
				$exclude_location_array,
				$exclude_organizer_array,
				$exclude_tag_array,
			)
		);

		/*====== Order & Order By ======*/
		if( $atts["order"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		if( $atts["order-type"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["order-type"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["order-type"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["order-type"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["order-type"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["order-type"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["order-type"] == "none" ) {

			$order_by = "none";

		} elseif( $atts["order-type"] == "post__in" ) {

			$order_by = "post__in";

		} elseif( $atts["order-type"] == "event-date" ) {

			$order_by = "";

			$extra_query = array(
				'meta_query' => array(
					'relation' => 'AND',
					'event_start_date_clause' => array(
						'key' => 'event_start_date',
					), 
					'event_start_time_clause' => array(
						'key' => 'event_start_time',
					),
				),
				'orderby' => array(
					'event_start_date_clause' => $order,
					'event_start_time_clause' => $order,
				),
			);
			$arg = wp_parse_args( $arg, $extra_query );

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Event Count ======*/
		if( !empty( $atts["eventcount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["eventcount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Events ======*/
		if( !empty( $atts['eventids'] ) ) {

			$eventids = $atts['eventids'];
			$include_events = explode( ',', $eventids );

		} else {

			$include_events = "";

		}

		if( !empty( $include_events ) ) {

			$extra_query = array(
				'post__in' => $include_events,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Events ======*/
		$excludeevents = $atts['excludeevents'];

		if( $hideexpired == "false" ) {

			if( !empty( $atts['excludeevents'] ) ) {

				$exclude_events = $atts['excludeevents'];
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			if( !empty( $exclude_events ) ) {

				$extra_query = array(
					'post__not_in' => $exclude_events,
				);
				$arg = wp_parse_args( $arg, $extra_query );

			}

		}

		/*====== Add Expired Events in Exclude Events ======*/
		if( $hideexpired == "true" ) {

			$expired_ids = eventchamp_expired_event_ids();

		} else {

			$expired_ids = array();

		}

		if( !empty( $expired_ids ) ) {

			if( !empty( $excludeevents ) ) {

				$exclude_events = $excludeevents;
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			$excludeevents_with_expired = array_merge( $exclude_events, $expired_ids );

			$extra_query = array(
				'post__not_in' => $excludeevents_with_expired,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== HTML Output ======*/
		$wp_query = new WP_Query( $arg );

		if( !empty( $wp_query ) ) {

			$output .= '<div class="gt-events-slider" style="height:' . esc_attr( $atts["slider-height"] ) . ';">';
				$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item="' . esc_attr( $atts["slider-column"] ) . '" data-gt-item-space="' . esc_attr( $atts["slider-space"] ) . '" data-gt-loop="' . esc_attr( $atts["slider-loop"] ) . '" data-gt-speed="' . esc_attr( $atts["slider-slide-speed"] ) . '" data-gt-direction="' . esc_attr( $atts["slider-direction"] ) . '" data-gt-effect="' . esc_attr( $atts["slider-effect"] ) . '" data-gt-centered-slides="' . esc_attr( $atts["slider-centered-slides"] ) . '" data-gt-free-mode="' . esc_attr( $atts["slider-free-mode"] ) . '">';
					$output .= '<div class="swiper-wrapper">';

						while( $wp_query->have_posts() ) {

							$wp_query->the_post();
							$event_tickets = get_post_meta( get_the_ID(), 'event_tickets', true );
							$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
							$event_end_date = get_post_meta( get_the_ID(), 'event_end_date', true );
							$event_venues = get_post_meta( get_the_ID(), 'event_venue', true );
							$event_cats = wp_get_post_terms( get_the_ID(), 'eventcat' );
							$event_locations = wp_get_post_terms( get_the_ID(), 'location' );

							if( $atts["slider-autoplay"] == "true" ) {

								$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $atts["slider-autoplay-delay"] ) . '">';

							} else {

								$output .= '<div class="swiper-slide">';

							}

								if( has_post_thumbnail() ) {

									$output .= '<div class="gt-slide-inner gt-lazy-load" data-background="' . esc_url( wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'eventchamp-event-slider' )[0] ) . '">';

								} else {

									$output .= '<div class="gt-slide-inner">';

								}

									if( $atts["opacity"] == "true" ) {

										$output .= '<div class="gt-opacity" style="opacity: ' . esc_attr( $atts["opacity-value"] ) . '; background-color: ' . esc_attr( $opacity_color ) . ';"></div>';

									}

									$output .= '<div class="container">';
										$output .= '<div class="gt-content">';

											if( $atts["category"] == "true" ) {

												if( !empty( $event_cats ) ) {

													$output .= '<ul class="gt-category">';

														foreach( $event_cats as $event_cat ) {

															if( !empty( $event_cat ) ) {

																if( !empty( $event_cat->name ) ) {

																	$output .= '<li>';
																		$output .= '<a href="' . get_term_link( $event_cat->term_id ) . '?post_type=event">' . esc_attr( $event_cat->name ) . '</a>';
																	$output .= '</li>';

																}

															}

														}

													$output .= '</ul>';

												}

											}

											$output .= '<div class="gt-title">' . get_the_title() . '</div>';

											if( !empty( $event_start_date ) or !empty( $event_end_date ) or !empty( $event_locations ) or !empty( $event_venues ) ) {

												if( $atts["startdate"] == "true" or $atts["enddate"] == "true" or $atts["location"] == "true" or $atts["venue"] == "true" ) {

													$output .= '<ul class="gt-information">';

														if( $atts["startdate"] == "true" and !empty( $event_start_date ) ) {

															$output .= '<li>';
																$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
																$output .= '<span>' . eventchamp_global_date_converter( $event_start_date ) . '</span>';
															$output .= '</li>';

														}

														if( $atts["enddate"] == "true" and !empty( $event_end_date ) ) {

															$output .= '<li>';
																$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>';
																$output .= '<span>' . eventchamp_global_date_converter( $event_end_date ) . '</span>';
															$output .= '</li>';

														}

														if( $atts["location"] == "true" and !empty( $event_locations ) ) {

															$output .= '<li>';
																$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
																$output .= '<ul>';

																	foreach( $event_locations as $loc ) {

																		if( !empty( $loc ) ) {

																			if( !empty( $loc->name ) ) {

																				$output .= '<li>';
																					$output .= '<a href="' . get_term_link( $loc->term_id ) . '?post_type=event">' . esc_attr( $loc->name ) . '</a>';
																				$output .= '</li>';

																			}

																		}

																	}

																$output .= '</ul>';
															$output .= '</li>';

														}

														if( $atts["venue"] == "true" ) {

															if( !empty( $event_venues ) and is_array( $event_venues ) ) {

																$output .= '<li>';
																	$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>';
																	$output .= '<ul>';

																		foreach( $event_venues as $event_venue ) {

																			if( !empty( $event_venue ) ) {

																				$output .= '<li>';
																					$output .= '<a href="' . esc_url( get_the_permalink( $event_venue ) ) . '">' . get_the_title( $event_venue ) . '</a>';
																				$output .= '</li>';

																			}

																		}

																	$output .= '</ul>';
																$output .= '</li>';

															}

														}
													$output .= '</ul>';
												}
											}

											if( $atts["details-button"] == "true" or $atts["buy-now-button"] == "true" ) {

												$output .= '<div class="buttons">';

													if( !empty( $atts["customtextdetailsbutton"] ) ) {

														$button1_text = esc_attr( $atts["customtextdetailsbutton"] );

													} else {

														$button1_text = esc_html__( 'Details', 'eventchamp' );

													}

													if( !empty( $atts["customtextbuynowbutton"] ) ) {

														$button2_text = esc_attr( $atts["customtextbuynowbutton"] );

													} else {

														$button2_text = esc_html__( 'Buy Ticket', 'eventchamp' );

													}

													if( $atts["details-button"] == "true" ) {

														$output .= '<a href="' . get_the_permalink() . '">';
															$output .= '<span>' . esc_attr( $button1_text ) . '</span>';
														$output .= '</a>';

													}

													if( $atts["buy-now-button"] == "true" and !empty( $event_tickets ) ) {

														$output .= '<a href="' . get_the_permalink() . '?section=tickets">';
															$output .= '<span>' . esc_attr( $button2_text ) . '</span>';
														$output .= '</a>';

													}

												$output .= '</div>';

											}

										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div>';

						}

					$output .= '</div>';

					if( $atts["separator"] == "style-1" ) {

						$output .= '<div class="gt-separator gt-style-1">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 51" preserveAspectRatio="none"><path d="M1480 51V8c-17 0-34 2.3-47 6.8l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0L1157 25.1c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0L787 14.8c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.5-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0L47 14.8C34 10.3 17 8 0 8v43h1480z"></path></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-2" ) {

						$output .= '<div class="gt-separator gt-style-2">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 103.5" preserveAspectRatio="none"><path d="M1480 103.5V7.7c-6.8.2-13.5.6-20.3.7-45.5 1.1-90.4 6.9-134 20.1-23.9 7.2-47 16.8-70.6 24.8-14 4.7-28.2 8.7-42.4 12.8-23.7 6.8-47.9 9.9-72.4 11.3-17 1-34.3 2.7-51.2 1.1-26.2-2.4-52.3-6.5-78.1-11.2-30.8-5.7-60.1-17-89.3-28.2C865.3 17.4 806.6 7.1 746.3 7c-57.8-.1-115.1 5.7-170.4 24-22.1 7.3-43.6 16.1-65.7 23.6-38.6 13.1-78.2 21.1-118.9 23.7-66.6 4.2-130.7-7.7-192.7-31.8-40.5-15.8-81.9-28.1-125-33.8C49.3 9.4 24.7 7.1 0 7.7v95.8h1480z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-3" ) {

						$output .= '<div class="gt-separator gt-style-3">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 142.3" preserveAspectRatio="none"><path d="M704.6 52.7C430.3 1.4 174.9 23 0 43.7v98.7h1480V43.7c-192.5 22.8-441.9 71.3-775.4 9z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-4" ) {

						$output .= '<div class="gt-separator gt-style-4">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 117"  preserveAspectRatio="none"><path d="M0 24.5c246.7 46.3 493.3 69.4 740 69.4s493.3-23.1 740-69.4V117H0V24.5z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-5" ) {

						$output .= '<div class="gt-separator gt-style-5">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 160"><path d="M0 160L1480 12v148z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-6" ) {

						$output .= '<div class="gt-separator gt-style-6">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 60"><path d="M74 22.5C33.1 22.5 0 39.3 0 60h148c0-20.7-33.1-37.5-74-37.5zM222 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM370 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM518 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM666 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM814 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM962 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1110 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1258 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1406 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-7" ) {

						$output .= '<div class="gt-separator gt-style-7">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 60"><path d="M43.5 22L0 60h87.1zM130.6 22L87.1 60h87zM217.6 22l-43.5 38h87.1zM304.7 22l-43.5 38h87zM391.8 22l-43.6 38h87.1zM478.8 22l-43.5 38h87.1zM565.9 22l-43.5 38h87zM652.9 22l-43.5 38h87.1zM740 22l-43.5 38h87zM827.1 22l-43.6 38h87.1zM914.1 22l-43.5 38h87zM1001.2 22l-43.6 38h87.1zM1088.2 22l-43.5 38h87.1zM1175.3 22l-43.5 38h87zM1262.4 22l-43.6 38h87.1zM1349.4 22l-43.5 38h87zM1436.5 22l-43.6 38h87.1z"/></svg>';
						$output .= '</div>';

					}

					if( $atts["dots"] == "true" ) {

						if( $atts["separator"] !== "false" ) {

							$output .= '<div class="swiper-pagination gt-slider-pagination gt-' . esc_attr( $atts["pagination-style"] ) . '"></div>';

						} else {

							$output .= '<div class="swiper-pagination gt-slider-pagination gt-' . esc_attr( $atts["pagination-style"] ) . '"></div>';

						}

					}

					if( $atts["navbuttons"] == "true" ) {

						$output .= '<div class="gt-slider-prev gt-slider-control gt-' . esc_attr( $atts["navigation-style"] ) . '">';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
						$output .= '</div>';
						$output .= '<div class="gt-slider-next gt-slider-control gt-' . esc_attr( $atts["navigation-style"] ) . '">';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
						$output .= '</div>';

					}

				$output .= '</div>';
			$output .= '</div>';

		}
		wp_reset_postdata();

		return $output;

	}
	add_shortcode( "eventchamp_latest_events_slider", "eventchamp_latest_events_slider_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Events Slider', 'eventchamp' ),
				"base" => "eventchamp_latest_events_slider",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/events-slider.jpg',
				"description" => esc_html__( 'Events slider element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "eventcount",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "eventids",
						"heading" => esc_html__( 'Include Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "excludeevents",
						"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"param_name" => "order",
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "order-type",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Event Date', 'eventchamp' ) => 'event-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-expired",
						"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-categories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-organizers",
						"heading" => esc_html__( 'Exclude Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-categories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-organizers",
						"heading" => esc_html__( 'Include Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "separator",
						"heading" => esc_html__( 'Separator', 'eventchamp' ),
						"description" => esc_html__( 'You can choose style of the separator.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'False',
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style-3',
							esc_html__( 'Style 4', 'eventchamp' ) => 'style-4',
							esc_html__( 'Style 5', 'eventchamp' ) => 'style-5',
							esc_html__( 'Style 6', 'eventchamp' ) => 'style-6',
							esc_html__( 'Style 7', 'eventchamp' ) => 'style-7',
						),
					),
					array(
						"type" => "colorpicker",
						"param_name" => "separator-color",
						"heading" => esc_html__( 'Separator Color', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a color for the separator. Default: #FFFFFF', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "details-button",
						"heading" => esc_html__( 'Details Button', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the details button.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "customtextdetailsbutton",
						"heading" => esc_html__( 'Details Button Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the details button. Default: Details.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "buy-now-button",
						"heading" => esc_html__( 'Buy Now Button', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the buy now button.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "customtextbuynowbutton",
						"heading" => esc_html__( 'Buy Now Button Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the buy now button. Default: Buy Now.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "category",
						"heading" => esc_html__( 'Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the category.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "startdate",
						"heading" => esc_html__( 'Start Date', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event start date.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "enddate",
						"heading" => esc_html__( 'End Date', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event end date.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "location",
						"heading" => esc_html__( 'Location', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event location.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "venue",
						"heading" => esc_html__( 'Venue', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event venue.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-height",
						"heading" => esc_html__( 'Slider Height', 'eventchamp' ),
						"description" => esc_html__( 'Enter a slider height. Example: 600px. If enter blank, it will have full height.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "opacity",
						"heading" => esc_html__( 'Opacity', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the opacity.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "opacity-value",
						"heading" => esc_html__( 'Opacity Value', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an opacity value. Default: 0.3.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '10', 'eventchamp' ) => '0.1',
							esc_html__( '20', 'eventchamp' ) => '0.2',
							esc_html__( '30', 'eventchamp' ) => '0.3',
							esc_html__( '40', 'eventchamp' ) => '0.4',
							esc_html__( '50', 'eventchamp' ) => '0.5',
							esc_html__( '60', 'eventchamp' ) => '0.6',
							esc_html__( '70', 'eventchamp' ) => '0.7',
							esc_html__( '80', 'eventchamp' ) => '0.8',
							esc_html__( '90', 'eventchamp' ) => '0.9',
							esc_html__( '100', 'eventchamp' ) => '1',
						),
					),
					array(
						"type" => "colorpicker",
						"param_name" => "opacity-color",
						"heading" => esc_html__( 'Opacity Color', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a color for the separator. Default: #000000', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-space",
						"heading" => esc_html__( 'Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a space value for space between the slides.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0px', 'eventchamp' ) => '0',
							esc_html__( '1px', 'eventchamp' ) => '1',
							esc_html__( '2px', 'eventchamp' ) => '2',
							esc_html__( '3px', 'eventchamp' ) => '3',
							esc_html__( '4px', 'eventchamp' ) => '4',
							esc_html__( '5px', 'eventchamp' ) => '5',
							esc_html__( '10px', 'eventchamp' ) => '10',
							esc_html__( '15px', 'eventchamp' ) => '15',
							esc_html__( '20px', 'eventchamp' ) => '20',
							esc_html__( '25px', 'eventchamp' ) => '25',
							esc_html__( '30px', 'eventchamp' ) => '30',
							esc_html__( '45px', 'eventchamp' ) => '45',
							esc_html__( '50px', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-autoplay",
						"heading" => esc_html__( 'Slider Autoplay', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the autoplay.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-autoplay-delay",
						"heading" => esc_html__( 'Slider Autoplay Delay', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an autoplay delay value. Default: 15000', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-loop",
						"heading" => esc_html__( 'Slider Loop', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the loop.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-slide-speed",
						"heading" => esc_html__( 'Slide Speed', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a slide speed. Duration of transition between the slides. Default: 1500', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-centered-slides",
						"heading" => esc_html__( 'Centered Slides', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the centered slides. If you choose true, then active slide will be centered, not always on the left side.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-direction",
						"heading" => esc_html__( 'Slider Direction', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a direction.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Horizontal', 'eventchamp' ) => 'horizontal',
							esc_html__( 'Vertical', 'eventchamp' ) => 'vertical',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-effect",
						"heading" => esc_html__( 'Slider Effect', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an effect.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Slide', 'eventchamp' ) => 'slide',
							esc_html__( 'Fade', 'eventchamp' ) => 'fade',
							esc_html__( 'Cube', 'eventchamp' ) => 'cube',
							esc_html__( 'Coverflow', 'eventchamp' ) => 'coverflow',
							esc_html__( 'Flip', 'eventchamp' ) => 'flip',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-free-mode",
						"heading" => esc_html__( 'Free Mode', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the free mode. If true then slides will not have fixed positions', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "navbuttons",
						"heading" => esc_html__( 'Navigation', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the navigation.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "navigation-style",
						"heading" => esc_html__( 'Navigation Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a navigation style.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "dots",
						"heading" => esc_html__( 'Pagination', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "pagination-style",
						"heading" => esc_html__( 'Pagination Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a pagination style.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Countdown Slider
*
======*/
if( !function_exists( 'eventchamp_event_counter_slider_output' ) ) {

	function eventchamp_event_counter_slider_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'titleone' => '',
				'titletwo' => '',
				'bgtext' => '',
				'addressdate' => '',
				'excerpt' => '',
				'detail-button-status' => '',
				'detaillink' => '',
				'detaillinkicon' => '',
				'detail-button-svg-icon' => '',
				'ticket-button-status' => '',
				'ticketlink' => '',
				'ticketlinkicon' => '',
				'ticket-button-svg-icon' => '',
				'eventdate' => '',
				'datebgtext' => '',
				'day-text' => '',
				'hour-text' => '',
				'minute-text' => '',
				'second-text' => '',
				'bgimages' => '',
				'style' => 'style-1',
				'separator' => '',
				'separator-color' => '',
				'sliderheight' => '100vh',
				'opacity' => '',
				'opacity-value' => '0.3',
				'opacity-color' => '',
				'slider-column' => '1',
				'slider-space' => '0',
				'autoplay' => '',
				'slider-autoplay-delay' => '15000',
				'loopstatus' => '',
				'slider-slide-speed' => 'false',
				'slider-centered-slides' => 'false',
				'slider-direction' => 'false',
				'slider-effect' => 'false',
				'slider-free-mode' => 'false',
				'navbuttons' => '',
				'navigation-style' => 'style-1',
				'dots' => '',
			), $atts
		);
		
		$output = '';

		/*====== Separator ======*/
		if( empty( $atts["separator-color"] ) ) {

			$separator_color = "#FFFFFF";

		} else {

			$separator_color = esc_attr( $atts["separator-color"] );

		}

		/*====== Day Text ======*/
		if( empty( $atts["day-text"] ) ) {

			$day_text = esc_html__( 'Days', 'eventchamp' );

		} else {

			$day_text = esc_attr( $atts["day-text"] );

		}

		/*====== Hour Text ======*/
		if( empty( $atts["hour-text"] ) ) {

			$hour_text = esc_html__( 'Hours', 'eventchamp' );

		} else {

			$hour_text = esc_attr( $atts["hour-text"] );

		}

		/*====== Minute Text ======*/
		if( empty( $atts["minute-text"] ) ) {

			$minute_text = esc_html__( 'Minutes', 'eventchamp' );

		} else {

			$minute_text = esc_attr( $atts["minute-text"] );

		}

		/*====== Second Text ======*/
		if( empty( $atts["second-text"] ) ) {

			$second_text = esc_html__( 'Seconds', 'eventchamp' );

		} else {

			$second_text = esc_attr( $atts["second-text"] );

		}

		/*====== Slider Height ======*/
		if( empty( $atts["sliderheight"] ) ) {

			$atts["sliderheight"] = "100vh";

		}

		/*====== Opacity ======*/
		if( empty( $atts["opacity"] ) ) {

			$atts["opacity"] = "true";

		}

		/*====== Opacity Value ======*/
		if( empty( $atts["opacity-value"] ) ) {

			$atts["opacity-value"] = "0.3";

		}

		/*====== Opacity Color ======*/
		if( empty( $atts["opacity-color"] ) ) {

			$opacity_color = "#000000";

		} else {

			$opacity_color = esc_attr( $atts["opacity-color"] );

		}

		/*====== Column ======*/
		if( empty( $atts["slider-column"] ) ) {

			$atts["slider-column"] = "1";

		}

		/*====== Column Space ======*/
		if( empty( $atts["slider-space"] ) ) {

			$atts["slider-space"] = "0";

		}

		/*====== Slider Autoplay Delay ======*/
		if( empty( $atts["slider-autoplay-delay"] ) ) {

			$atts["slider-autoplay-delay"] = "15000";

		}

		/*====== Slider Loop ======*/
		if( empty( $atts["slider-loop"] ) ) {

			$atts["slider-loop"] = "false";

		}

		/*====== Slider Slide Speed ======*/
		if( empty( $atts["slider-slide-speed"] ) ) {

			$atts["slider-slide-speed"] = "1000";

		}

		/*====== Centered Slides ======*/
		if( empty( $atts["slider-centered-slides"] ) ) {

			$atts["slider-centered-slides"] = "false";

		}

		/*====== Slider Direction ======*/
		if( empty( $atts["slider-direction"] ) ) {

			$atts["slider-direction"] = "horizontal";

		}

		/*====== Slider Effect ======*/
		if( empty( $atts["slider-effect"] ) ) {

			$atts["slider-effect"] = "slide";

		}

		/*====== Slider Free Mode ======*/
		if( empty( $atts["slider-free-mode"] ) ) {

			$atts["slider-free-mode"] = "false";

		}

		/*====== HTML Output ======*/
		if( !empty( $atts["addressdate"] ) or !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) or !empty( $atts["excerpt"] ) or !empty( $atts["eventdate"] ) ) {

			if( $atts["style"] == "style-1" ) {

				$output .= '<div class="gt-countdown-slider gt-style-1" style="height:' . esc_attr( $atts["sliderheight"] ) . ';">';
					$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item="' . esc_attr( $atts["slider-column"] ) . '" data-gt-item-space="' . esc_attr( $atts["slider-space"] ) . '" data-gt-loop="' . esc_attr( $atts["loopstatus"] ) . '" data-gt-speed="' . esc_attr( $atts["slider-slide-speed"] ) . '" data-gt-direction="' . esc_attr( $atts["slider-direction"] ) . '" data-gt-effect="' . esc_attr( $atts["slider-effect"] ) . '" data-gt-centered-slides="' . esc_attr( $atts["slider-centered-slides"] ) . '" data-gt-free-mode="' . esc_attr( $atts["slider-free-mode"] ) . '">';
						$output .= '<div class="swiper-wrapper">';
							$slider_images = explode( ',', $atts["bgimages"] ); 

							if( !empty( $slider_images ) ) {

								foreach( $slider_images as $slider_image ) {

									if( !empty( $slider_image ) ) {

										if( $atts["autoplay"] == "true" ) {

											$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $atts["slider-autoplay-delay"] ) . '">';

										} else {

											$output .= '<div class="swiper-slide">';

										}

											$output .= '<div class="gt-image gt-lazy-load" data-background="' . esc_url( wp_get_attachment_image_src( esc_attr( $slider_image ), "eventchamp-event-slider" )[0] ) . '">';

												if( $atts["opacity"] == "true" ) {

													$output .= '<div class="gt-opacity" style="opacity: ' . esc_attr( $atts["opacity-value"] ) . '; background-color: ' . esc_attr( $opacity_color ) . ';"></div>';

												}

											$output .= '</div>';
										$output .= '</div>';

									}

								}

							}

						$output .= '</div>';

						if( $atts["dots"] == "true" ) {

							$output .= '<div class="swiper-pagination gt-slider-pagination"></div>';

						}

						if( $atts["navbuttons"] == "true" ) {

							$output .= '<div class="gt-slider-prev gt-slider-control gt-' . esc_attr( $atts["navigation-style"] ) . '">';
								$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
							$output .= '</div>';
							$output .= '<div class="gt-slider-next gt-slider-control gt-' . esc_attr( $atts["navigation-style"] ) . '">';
								$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
							$output .= '</div>';

						}

					$output .= '</div>';

					$output .= '<div class="gt-slider-content">';

						if( !empty( $atts["addressdate"] ) ) {

							$output .= '<div class="gt-address-date">' . esc_attr( $atts["addressdate"] ) . '</div>';

						}

						if( !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) ) {

							$output .= '<div class="gt-title">';

								if( !empty( $atts["bgtext"] ) ) {

									$output .= '<div class="gt-background-text">' . esc_attr( $atts["bgtext"] ) . '</div>';

								}

								if( !empty( $atts["titleone"] ) or !empty( $atts["titleone"] ) ) {

									$output .= '<div class="gt-title-inner">';

										if( !empty( $atts["titleone"] ) ) {

											$output .= '<span class="gt-primary">' . esc_attr( $atts["titleone"] ) . '</span>';

										}

										if( !empty( $atts["titletwo"] ) ) {

											$output .= '<span class="gt-secondary">' . esc_attr( $atts["titletwo"] ) . '</span>';

										}

									$output .= '</div>';

								}

							$output .= '</div>';

						}

						if( !empty( $atts["excerpt"] ) ) {

							$output .= '<div class="gt-text">' . esc_attr( $atts["excerpt"] ) . '</div>';

						}

						if( !empty( $atts["detaillink"] ) or !empty( $atts["ticketlink"] ) ) {

							if( $atts["detail-button-status"] == "true" or $atts["ticket-button-status"] == "true" ) {

								$output .= '<div class="gt-buttons">';

									if( !empty( $atts["detaillink"] ) ) {

										if( $atts["detail-button-status"] == "true" ) {

											$href = $atts["detaillink"];
											$href = vc_build_link( $href );

											if( !empty( $href["target"] ) ) {

												$target = $href["target"];

											} else {

												$target = "_parent";

											}

											if( !empty( $href["title"] ) ) {

												$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';

													if( !empty( $atts["detaillinkicon"] ) ) {

														$output .= '<i class="' . esc_attr( $atts["detaillinkicon"] ) . '"></i>';

													} elseif( !empty( $atts["detail-button-svg-icon"] ) ) {

														$output .= rawurldecode( base64_decode( $atts["detail-button-svg-icon"] ) );

													}

													$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
												$output .= '</a>';

											}

										}

									}

									if( !empty( $atts["ticketlink"] ) ) {

										if( $atts["ticket-button-status"] == "true" ) {

											$href = $atts["ticketlink"];
											$href = vc_build_link( $href );

											if( !empty( $href["target"] ) ) {

												$target = $href["target"];

											} else {

												$target = "_parent";

											}

											if( !empty( $href["title"] ) ) {

												$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';

													if( !empty( $atts["ticketlinkicon"] ) ) {

														$output .= '<i class="' . esc_attr( $atts["ticketlinkicon"] ) . '"></i>';

													} elseif( !empty( $atts["ticket-button-svg-icon"] ) ) {

														$output .= rawurldecode( base64_decode( $atts["ticket-button-svg-icon"] ) );

													}

													$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
												$output .= '</a>';

											}

										}

									}

								$output .= '</div>';

							}

						}

					$output .= '</div>';

					if( !empty( $atts["eventdate"] ) ) {

						$output .= '<div class="gt-counter">';

							if( !empty( $atts["datebgtext"] ) ) {

								$output .= '<div class="gt-background-text">' . esc_attr( $atts["datebgtext"] ) . '</div>';

							}

							$output .= '<div class="gt-counter-inner">';
								$output .= '<div class="gt-day">';
									$output .= '<div class="wrapper">';
										$output .= '<div class="gt-count"></div>';
										$output .= '<div class="gt-title">' . esc_attr( $day_text ) . '</div>';
									$output .= '</div>';
								$output .= '</div>';
								$output .= '<div class="gt-hour">';
									$output .= '<div class="wrapper">';
										$output .= '<div class="gt-count"></div>';
										$output .= '<div class="gt-title">' . esc_attr( $hour_text ) . '</div>';
									$output .= '</div>';
								$output .= '</div>';
								$output .= '<div class="gt-minute">';
									$output .= '<div class="wrapper">';
										$output .= '<div class="gt-count"></div>';
										$output .= '<div class="gt-title">' . esc_attr( $minute_text ) . '</div>';
									$output .= '</div>';
								$output .= '</div>';
								$output .= '<div class="gt-second">';
									$output .= '<div class="wrapper">';
										$output .= '<div class="gt-count"></div>';
										$output .= '<div class="gt-title">' . esc_attr( $second_text ) . '</div>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div>';
							$output .= "<script type='text/javascript'>
								jQuery(document).ready(function($){
									$('.gt-counter-inner').countdown('" . date( 'Y/m/d H:i:s', strtotime( $atts["eventdate"] ) ) . "', function(event) {
										$('.gt-day .gt-count').html(event.strftime('%D'));
										$('.gt-hour .gt-count').html(event.strftime('%H'));
										$('.gt-minute .gt-count').html(event.strftime('%M'));
										$('.gt-second .gt-count').html(event.strftime('%S'));
									});
								});
							</script>";
						$output .= '</div>';

					}

					if( $atts["separator"] == "style-1" ) {

						$output .= '<div class="gt-separator gt-style-1">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 51" preserveAspectRatio="none"><path d="M1480 51V8c-17 0-34 2.3-47 6.8l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0L1157 25.1c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0L787 14.8c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.5-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0L47 14.8C34 10.3 17 8 0 8v43h1480z"></path></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-2" ) {

						$output .= '<div class="gt-separator gt-style-2">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 103.5" preserveAspectRatio="none"><path d="M1480 103.5V7.7c-6.8.2-13.5.6-20.3.7-45.5 1.1-90.4 6.9-134 20.1-23.9 7.2-47 16.8-70.6 24.8-14 4.7-28.2 8.7-42.4 12.8-23.7 6.8-47.9 9.9-72.4 11.3-17 1-34.3 2.7-51.2 1.1-26.2-2.4-52.3-6.5-78.1-11.2-30.8-5.7-60.1-17-89.3-28.2C865.3 17.4 806.6 7.1 746.3 7c-57.8-.1-115.1 5.7-170.4 24-22.1 7.3-43.6 16.1-65.7 23.6-38.6 13.1-78.2 21.1-118.9 23.7-66.6 4.2-130.7-7.7-192.7-31.8-40.5-15.8-81.9-28.1-125-33.8C49.3 9.4 24.7 7.1 0 7.7v95.8h1480z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-3" ) {

						$output .= '<div class="gt-separator gt-style-3">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 142.3" preserveAspectRatio="none"><path d="M704.6 52.7C430.3 1.4 174.9 23 0 43.7v98.7h1480V43.7c-192.5 22.8-441.9 71.3-775.4 9z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-4" ) {

						$output .= '<div class="gt-separator gt-style-4">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 117"  preserveAspectRatio="none"><path d="M0 24.5c246.7 46.3 493.3 69.4 740 69.4s493.3-23.1 740-69.4V117H0V24.5z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-5" ) {

						$output .= '<div class="gt-separator gt-style-5">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 160"><path d="M0 160L1480 12v148z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-6" ) {

						$output .= '<div class="gt-separator gt-style-6">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 60"><path d="M74 22.5C33.1 22.5 0 39.3 0 60h148c0-20.7-33.1-37.5-74-37.5zM222 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM370 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM518 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM666 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM814 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM962 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1110 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1258 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1406 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-7" ) {

						$output .= '<div class="gt-separator gt-style-7">';
							$output .= '<svg fill="fill:' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 60"><path d="M43.5 22L0 60h87.1zM130.6 22L87.1 60h87zM217.6 22l-43.5 38h87.1zM304.7 22l-43.5 38h87zM391.8 22l-43.6 38h87.1zM478.8 22l-43.5 38h87.1zM565.9 22l-43.5 38h87zM652.9 22l-43.5 38h87.1zM740 22l-43.5 38h87zM827.1 22l-43.6 38h87.1zM914.1 22l-43.5 38h87zM1001.2 22l-43.6 38h87.1zM1088.2 22l-43.5 38h87.1zM1175.3 22l-43.5 38h87zM1262.4 22l-43.6 38h87.1zM1349.4 22l-43.5 38h87zM1436.5 22l-43.6 38h87.1z"/></svg>';
						$output .= '</div>';

					}

				$output .= '</div>';

			} elseif( $atts["style"] == "style-2" ) {

				$output .= '<div class="gt-countdown-slider gt-style-2" style="height:' . esc_attr( $atts["sliderheight"] ) . ';">';
					$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item="' . esc_attr( $atts["slider-column"] ) . '" data-gt-item-space="' . esc_attr( $atts["slider-space"] ) . '" data-gt-loop="' . esc_attr( $atts["loopstatus"] ) . '" data-gt-speed="' . esc_attr( $atts["slider-slide-speed"] ) . '" data-gt-direction="' . esc_attr( $atts["slider-direction"] ) . '" data-gt-effect="' . esc_attr( $atts["slider-effect"] ) . '" data-gt-centered-slides="' . esc_attr( $atts["slider-centered-slides"] ) . '" data-gt-free-mode="' . esc_attr( $atts["slider-free-mode"] ) . '">';
						$output .= '<div class="swiper-wrapper">';
							$slider_images = explode( ',', $atts["bgimages"] ); 

							if( !empty( $slider_images ) ) {

								foreach( $slider_images as $slider_image ) {

									if( !empty( $slider_image ) ) {

										if( $atts["autoplay"] == "true" ) {

											$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $atts["slider-autoplay-delay"] ) . '">';

										} else {

											$output .= '<div class="swiper-slide">';

										}

											$output .= '<div class="gt-image gt-lazy-load" data-background="' . esc_url( wp_get_attachment_image_src( esc_attr( $slider_image ), "eventchamp-event-slider" )[0] ) . '">';

												if( $atts["opacity"] == "true" ) {

													$output .= '<div class="gt-opacity" style="opacity: ' . esc_attr( $atts["opacity-value"] ) . '; background-color: ' . esc_attr( $opacity_color ) . ';"></div>';

												}

											$output .= '</div>';
										$output .= '</div>';

									}

								}

							}

						$output .= '</div>';

						if( $atts["dots"] == "true" ) {

							$output .= '<div class="swiper-pagination gt-slider-pagination"></div>';

						}

						if( $atts["navbuttons"] == "true" ) {

							$output .= '<div class="gt-slider-prev gt-slider-control gt-' . esc_attr( $atts["navigation-style"] ) . '">';
								$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
							$output .= '</div>';
							$output .= '<div class="gt-slider-next gt-slider-control gt-' . esc_attr( $atts["navigation-style"] ) . '">';
								$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
							$output .= '</div>';

						}

					$output .= '</div>';

					$output .= '<div class="gt-slider-content">';

						if( !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) ) {

							$output .= '<div class="gt-title">';

								if( !empty( $atts["bgtext"] ) ) {

									$output .= '<div class="gt-background-text">' . esc_attr( $atts["bgtext"] ) . '</div>';

								}

								if( !empty( $atts["titleone"] ) or !empty( $atts["titleone"] ) ) {

									if( !empty( $atts["bgtext"] ) ) {

										$output .= '<div class="gt-title-inner">';

									} else {

										$output .= '<div class="gt-title-inner gt-relative">';

									}

										if( !empty( $atts["titleone"] ) ) {

											$output .= '<span class="gt-primary">' . esc_attr( $atts["titleone"] ) . '</span>';

										}

										if( !empty( $atts["titletwo"] ) ) {

											$output .= '<span class="gt-secondary">' . esc_attr( $atts["titletwo"] ) . '</span>';

										}

									$output .= '</div>';

								}

							$output .= '</div>';

						}

						if( !empty( $atts["addressdate"] ) ) {

							$output .= '<div class="gt-address-date">' . esc_attr( $atts["addressdate"] ) . '</div>';

						}

						if( !empty( $atts["excerpt"] ) ) {

							$output .= '<div class="gt-text">' . esc_attr( $atts["excerpt"] ) . '</div>';

						}

						if( !empty( $atts["eventdate"] ) ) {

							$output .= '<div class="gt-counter">';

								if( !empty( $atts["datebgtext"] ) ) {

									$output .= '<div class="gt-background-text">' . esc_attr( $atts["datebgtext"] ) . '</div>';

								}

								if( !empty( $atts["datebgtext"] ) ) {

									$output .= '<div class="gt-counter-inner">';

								} else {

									$output .= '<div class="gt-counter-inner gt-relative">';

								}

									$output .= '<div class="gt-day">';
										$output .= '<div class="wrapper">';
											$output .= '<div class="gt-count"></div>';
											$output .= '<div class="gt-title">' . esc_attr( $day_text ) . '</div>';
										$output .= '</div>';
									$output .= '</div>';
									$output .= '<div class="gt-hour">';
										$output .= '<div class="wrapper">';
											$output .= '<div class="gt-count"></div>';
											$output .= '<div class="gt-title">' . esc_attr( $hour_text ) . '</div>';
										$output .= '</div>';
									$output .= '</div>';
									$output .= '<div class="gt-minute">';
										$output .= '<div class="wrapper">';
											$output .= '<div class="gt-count"></div>';
											$output .= '<div class="gt-title">' . esc_attr( $minute_text ) . '</div>';
										$output .= '</div>';
									$output .= '</div>';
									$output .= '<div class="gt-second">';
										$output .= '<div class="wrapper">';
											$output .= '<div class="gt-count"></div>';
											$output .= '<div class="gt-title">' . esc_attr( $second_text ) . '</div>';
										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';
								$output .= "<script type='text/javascript'>
									jQuery(document).ready(function($){
										$('.gt-counter-inner').countdown('" . date( 'Y/m/d H:i:s', strtotime( $atts["eventdate"] ) ) . "', function(event) {
											$('.gt-day .gt-count').html(event.strftime('%D'));
											$('.gt-hour .gt-count').html(event.strftime('%H'));
											$('.gt-minute .gt-count').html(event.strftime('%M'));
											$('.gt-second .gt-count').html(event.strftime('%S'));
										});
									});
								</script>";
							$output .= '</div>';

						}

						if( !empty( $atts["detaillink"] ) or !empty( $atts["ticketlink"] ) ) {

							if( $atts["detail-button-status"] == "true" or $atts["ticket-button-status"] == "true" ) {

								$output .= '<div class="gt-buttons">';

									if( !empty( $atts["detaillink"] ) ) {

										if( $atts["detail-button-status"] == "true" ) {

											$href = $atts["detaillink"];
											$href = vc_build_link( $href );

											if( !empty( $href["target"] ) ) {

												$target = $href["target"];

											} else {

												$target = "_parent";

											}

											if( !empty( $href["title"] ) ) {

												$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';

													if( !empty( $atts["detaillinkicon"] ) ) {

														$output .= '<i class="' . esc_attr( $atts["detaillinkicon"] ) . '"></i>';

													} elseif( !empty( $atts["detail-button-svg-icon"] ) ) {

														$output .= rawurldecode( base64_decode( $atts["detail-button-svg-icon"] ) );

													}

													$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
												$output .= '</a>';

											}

										}

									}

									if( !empty( $atts["ticketlink"] ) ) {

										if( $atts["ticket-button-status"] == "true" ) {

											$href = $atts["ticketlink"];
											$href = vc_build_link( $href );

											if( !empty( $href["target"] ) ) {

												$target = $href["target"];

											} else {

												$target = "_parent";

											}

											if( !empty( $href["title"] ) ) {

												$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';

													if( !empty( $atts["ticketlinkicon"] ) ) {

														$output .= '<i class="' . esc_attr( $atts["ticketlinkicon"] ) . '"></i>';

													} elseif( !empty( $atts["ticket-button-svg-icon"] ) ) {

														$output .= rawurldecode( base64_decode( $atts["ticket-button-svg-icon"] ) );

													}

													$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
												$output .= '</a>';

											}

										}

									}

								$output .= '</div>';

							}

						}

					$output .= '</div>';

					if( $atts["separator"] == "style-1" ) {

						$output .= '<div class="gt-separator gt-style-1">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 51" preserveAspectRatio="none"><path d="M1480 51V8c-17 0-34 2.3-47 6.8l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0L1157 25.1c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0L787 14.8c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.4-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0l-29.5-10.3c-25.8-9-68.1-9-93.9 0l-29.4 10.3c-25.8 9-68.1 9-93.9 0L47 14.8C34 10.3 17 8 0 8v43h1480z"></path></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-2" ) {

						$output .= '<div class="gt-separator gt-style-2">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 103.5" preserveAspectRatio="none"><path d="M1480 103.5V7.7c-6.8.2-13.5.6-20.3.7-45.5 1.1-90.4 6.9-134 20.1-23.9 7.2-47 16.8-70.6 24.8-14 4.7-28.2 8.7-42.4 12.8-23.7 6.8-47.9 9.9-72.4 11.3-17 1-34.3 2.7-51.2 1.1-26.2-2.4-52.3-6.5-78.1-11.2-30.8-5.7-60.1-17-89.3-28.2C865.3 17.4 806.6 7.1 746.3 7c-57.8-.1-115.1 5.7-170.4 24-22.1 7.3-43.6 16.1-65.7 23.6-38.6 13.1-78.2 21.1-118.9 23.7-66.6 4.2-130.7-7.7-192.7-31.8-40.5-15.8-81.9-28.1-125-33.8C49.3 9.4 24.7 7.1 0 7.7v95.8h1480z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-3" ) {

						$output .= '<div class="gt-separator gt-style-3">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 142.3" preserveAspectRatio="none"><path d="M704.6 52.7C430.3 1.4 174.9 23 0 43.7v98.7h1480V43.7c-192.5 22.8-441.9 71.3-775.4 9z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-4" ) {

						$output .= '<div class="gt-separator gt-style-4">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 117"  preserveAspectRatio="none"><path d="M0 24.5c246.7 46.3 493.3 69.4 740 69.4s493.3-23.1 740-69.4V117H0V24.5z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-5" ) {

						$output .= '<div class="gt-separator gt-style-5">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 160"><path d="M0 160L1480 12v148z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-6" ) {

						$output .= '<div class="gt-separator gt-style-6">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 60"><path d="M74 22.5C33.1 22.5 0 39.3 0 60h148c0-20.7-33.1-37.5-74-37.5zM222 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM370 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM518 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM666 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM814 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM962 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1110 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1258 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5zM1406 22.5c-40.9 0-74 16.8-74 37.5h148c0-20.7-33.1-37.5-74-37.5z"/></svg>';
						$output .= '</div>';

					} elseif( $atts["separator"] == "style-7" ) {

						$output .= '<div class="gt-separator gt-style-7">';
							$output .= '<svg fill="' . esc_attr( $separator_color ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480 60"><path d="M43.5 22L0 60h87.1zM130.6 22L87.1 60h87zM217.6 22l-43.5 38h87.1zM304.7 22l-43.5 38h87zM391.8 22l-43.6 38h87.1zM478.8 22l-43.5 38h87.1zM565.9 22l-43.5 38h87zM652.9 22l-43.5 38h87.1zM740 22l-43.5 38h87zM827.1 22l-43.6 38h87.1zM914.1 22l-43.5 38h87zM1001.2 22l-43.6 38h87.1zM1088.2 22l-43.5 38h87.1zM1175.3 22l-43.5 38h87zM1262.4 22l-43.6 38h87.1zM1349.4 22l-43.5 38h87zM1436.5 22l-43.6 38h87.1z"/></svg>';
						$output .= '</div>';

					}

				$output .= '</div>';

			}

		}

		return $output;

	}
	add_shortcode( "eventchamp_event_counter_slider", "eventchamp_event_counter_slider_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Countdown Slider', 'eventchamp' ),
				"base" => "eventchamp_event_counter_slider",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/countdown-slider.jpg',
				"description" => esc_html__( 'Event counter slider element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "titleone",
						"heading" => esc_html__( 'Primary Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"admin_label" => true,
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "titletwo",
						"heading" => esc_html__( 'Secondary Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"admin_label" => true,
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "bgtext",
						"heading" => esc_html__( 'Background Text for the Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a background text for the title on the style 1 and the style 2.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "addressdate",
						"heading" => esc_html__( 'Address & Date', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an address and date.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "excerpt",
						"heading" => esc_html__( 'Description Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "detail-button-status",
						"heading" => esc_html__( 'Detail Button', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the detail button.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "vc_link",
						"param_name" => "detaillink",
						"heading" => esc_html__( 'Detail Button Link', 'eventchamp' ),
						"description" => esc_html__( 'You can create a link.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "detaillinkicon",
						"heading" => esc_html__( 'Detail Button Font Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can add an icon to the detail button. If you want to use SVG icon, enter blank it. You can enter an icon. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textarea_raw_html",
						"param_name" => "detail-button-svg-icon",
						"heading" => esc_html__( 'Detail Button SVG Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a SVG icon code.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "ticket-button-status",
						"heading" => esc_html__( 'Ticket Button', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the ticket button.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "vc_link",
						"param_name" => "ticketlink",
						"heading" => esc_html__( 'Ticket Button Link', 'eventchamp' ),
						"description" => esc_html__( 'You can create a link.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "ticketlinkicon",
						"heading" => esc_html__( 'Ticket Button Font Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can add an icon to the ticket button. If you want to use SVG icon, enter blank it. You can enter an icon. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textarea_raw_html",
						"param_name" => "ticket-button-svg-icon",
						"heading" => esc_html__( 'Detail Button SVG Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a SVG icon code.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "eventdate",
						"heading" => esc_html__( 'Event Date', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a event date. Enter date with this format: 2020/09/23 10:24:00', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "datebgtext",
						"heading" => esc_html__( 'Background Text for Date', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a background text for the date on the style 1 and the style 2.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "day-text",
						"heading" => esc_html__( 'Day Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the day. Default: Days.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "hour-text",
						"heading" => esc_html__( 'Hour Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the hour. Default: Hours.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "minute-text",
						"heading" => esc_html__( 'Minute Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the minute. Default: Minutes.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "second-text",
						"heading" => esc_html__( 'Second Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the second. Default: Seconds.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "attach_images",
						"param_name" => "bgimages",
						"heading" => esc_html__( 'Slider Images', 'eventchamp' ),
						"description" => esc_html__( 'You can upload slider images.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "separator",
						"heading" => esc_html__( 'Separator', 'eventchamp' ),
						"description" => esc_html__( 'You can choose style of the separator.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'False',
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style-3',
							esc_html__( 'Style 4', 'eventchamp' ) => 'style-4',
							esc_html__( 'Style 5', 'eventchamp' ) => 'style-5',
							esc_html__( 'Style 6', 'eventchamp' ) => 'style-6',
							esc_html__( 'Style 7', 'eventchamp' ) => 'style-7',
						),
					),
					array(
						"type" => "colorpicker",
						"param_name" => "separator-color",
						"heading" => esc_html__( 'Separator Color', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a color for the separator. Default: #FFFFFF', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "sliderheight",
						"heading" => esc_html__( 'Slider Height', 'eventchamp' ),
						"description" => esc_html__( 'Enter a slider height. Example: 600px. If enter blank, it will have full height.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "opacity",
						"heading" => esc_html__( 'Opacity', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the opacity.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "opacity-value",
						"heading" => esc_html__( 'Opacity Value', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an opacity value. Default: 0.3.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '10', 'eventchamp' ) => '0.1',
							esc_html__( '20', 'eventchamp' ) => '0.2',
							esc_html__( '30', 'eventchamp' ) => '0.3',
							esc_html__( '40', 'eventchamp' ) => '0.4',
							esc_html__( '50', 'eventchamp' ) => '0.5',
							esc_html__( '60', 'eventchamp' ) => '0.6',
							esc_html__( '70', 'eventchamp' ) => '0.7',
							esc_html__( '80', 'eventchamp' ) => '0.8',
							esc_html__( '90', 'eventchamp' ) => '0.9',
							esc_html__( '100', 'eventchamp' ) => '1',
						),
					),
					array(
						"type" => "colorpicker",
						"param_name" => "opacity-color",
						"heading" => esc_html__( 'Opacity Color', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a color for the separator. Default: #000000', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-space",
						"heading" => esc_html__( 'Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a space value for space between the slides.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0px', 'eventchamp' ) => '0',
							esc_html__( '1px', 'eventchamp' ) => '1',
							esc_html__( '2px', 'eventchamp' ) => '2',
							esc_html__( '3px', 'eventchamp' ) => '3',
							esc_html__( '4px', 'eventchamp' ) => '4',
							esc_html__( '5px', 'eventchamp' ) => '5',
							esc_html__( '10px', 'eventchamp' ) => '10',
							esc_html__( '15px', 'eventchamp' ) => '15',
							esc_html__( '20px', 'eventchamp' ) => '20',
							esc_html__( '25px', 'eventchamp' ) => '25',
							esc_html__( '30px', 'eventchamp' ) => '30',
							esc_html__( '45px', 'eventchamp' ) => '45',
							esc_html__( '50px', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "autoplay",
						"heading" => esc_html__( 'Slider Autoplay', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the autoplay.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-autoplay-delay",
						"heading" => esc_html__( 'Slider Autoplay Delay', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an autoplay delay value. Default: 15000', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "loopstatus",
						"heading" => esc_html__( 'Slider Loop', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the loop.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-slide-speed",
						"heading" => esc_html__( 'Slide Speed', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a slide speed. Duration of transition between the slides. Default: 1500', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-centered-slides",
						"heading" => esc_html__( 'Centered Slides', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the centered slides. If you choose true, then active slide will be centered, not always on the left side.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-direction",
						"heading" => esc_html__( 'Slider Direction', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a direction.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Horizontal', 'eventchamp' ) => 'horizontal',
							esc_html__( 'Vertical', 'eventchamp' ) => 'vertical',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-effect",
						"heading" => esc_html__( 'Slider Effect', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an effect.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Slide', 'eventchamp' ) => 'slide',
							esc_html__( 'Fade', 'eventchamp' ) => 'fade',
							esc_html__( 'Cube', 'eventchamp' ) => 'cube',
							esc_html__( 'Coverflow', 'eventchamp' ) => 'coverflow',
							esc_html__( 'Flip', 'eventchamp' ) => 'flip',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-free-mode",
						"heading" => esc_html__( 'Free Mode', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the free mode. If true then slides will not have fixed positions', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "navbuttons",
						"heading" => esc_html__( 'Navigation', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the navigation.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "navigation-style",
						"heading" => esc_html__( 'Navigation Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a navigation style.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "dots",
						"heading" => esc_html__( 'Pagination', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Countdown
*
======*/
if( !function_exists( 'eventchamp_countdown_output' ) ) {

	function eventchamp_countdown_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '1',
				'date' => '',
				'day-text' => '',
				'hour-text' => '',
				'minute-text' => '',
				'second-text' => '',
			), $atts
		);
		
		$output = '';

		/*====== Day Text ======*/
		$rand_id = rand( 0, 99999 );

		/*====== Day Text ======*/
		if( empty( $atts["day-text"] ) ) {

			$day_text = esc_html__( 'Days', 'eventchamp' );

		} else {

			$day_text = esc_attr( $atts["day-text"] );

		}

		/*====== Hour Text ======*/
		if( empty( $atts["hour-text"] ) ) {

			$hour_text = esc_html__( 'Hours', 'eventchamp' );

		} else {

			$hour_text = esc_attr( $atts["hour-text"] );

		}

		/*====== Minute Text ======*/
		if( empty( $atts["minute-text"] ) ) {

			$minute_text = esc_html__( 'Minutes', 'eventchamp' );

		} else {

			$minute_text = esc_attr( $atts["minute-text"] );

		}

		/*====== Second Text ======*/
		if( empty( $atts["second-text"] ) ) {

			$second_text = esc_html__( 'Seconds', 'eventchamp' );

		} else {

			$second_text = esc_attr( $atts["second-text"] );

		}

		/*====== HTML Output ======*/
		if( !empty( $atts["date"] ) ) {

			$output .= '<div class="gt-countdown gt-style-' . esc_attr( $atts["style"] ) . '" id="gt-countdown-' . esc_attr( $rand_id ) . '">';

				$output .= '<ul>';
					$output .= '<li class="gt-day">';
						$output .= '<div class="gt-inner">';
							$output .= '<div class="gt-count"></div>';
							$output .= '<div class="gt-title">' . esc_attr( $day_text ) . '</div>';
						$output .= '</div>';
					$output .= '</li>';
					$output .= '<li class="gt-hour">';
						$output .= '<div class="gt-inner">';
							$output .= '<div class="gt-count"></div>';
							$output .= '<div class="gt-title">' . esc_attr( $hour_text ) . '</div>';
						$output .= '</div>';
					$output .= '</li>';
					$output .= '<li class="gt-minute">';
						$output .= '<div class="gt-inner">';
							$output .= '<div class="gt-count"></div>';
							$output .= '<div class="gt-title">' . esc_attr( $minute_text ) . '</div>';
						$output .= '</div>';
					$output .= '</li>';
					$output .= '<li class="gt-second">';
						$output .= '<div class="gt-inner">';
							$output .= '<div class="gt-count"></div>';
							$output .= '<div class="gt-title">' . esc_attr( $second_text ) . '</div>';
						$output .= '</div>';
					$output .= '</li>';
				$output .= '</ul>';

				$output .= "<script type='text/javascript'>
					jQuery(document).ready(function($){
						$('#gt-countdown-" . esc_attr( $rand_id ) . "').countdown('" . date( 'Y/m/d H:i:s', strtotime( $atts["date"] ) ) . "', function(event) {
							$('.gt-day .gt-count').html(event.strftime('%D'));
							$('.gt-hour .gt-count').html(event.strftime('%H'));
							$('.gt-minute .gt-count').html(event.strftime('%M'));
							$('.gt-second .gt-count').html(event.strftime('%S'));
						});
					});
				</script>";

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_countdown", "eventchamp_countdown_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Countdown', 'eventchamp' ),
				"base" => "eventchamp_countdown",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/countdown.jpg',
				"description" => esc_html__( 'Countdown element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						'save_always' => true,
						'admin_label' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "date",
						"heading" => esc_html__( 'Date', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a date. Enter date with this format: 2020/09/23 10:24:00', 'eventchamp' ),
						'save_always' => true,
						'admin_label' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "day-text",
						"heading" => esc_html__( 'Day Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the day. Default: Days.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "hour-text",
						"heading" => esc_html__( 'Hour Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the hour. Default: Hours.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "minute-text",
						"heading" => esc_html__( 'Minute Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the minute. Default: Minutes.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "second-text",
						"heading" => esc_html__( 'Second Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text for the second. Default: Seconds.', 'eventchamp' ),
						'save_always' => true,
					),
				),
			)
		);

	}

}



/*======
*
* Event Search Tool
*
======*/
if( !function_exists( 'eventchamp_event_search_output' ) ) {

	function eventchamp_event_search_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => 'white',
				'column' => 'column-1',
				'dark-background' => '',
				'title' => '',
				'custom-title' => '',
				'startdate' => '',
				'enddate' => '',
				'keyword' => '',
				'custom-keyword-text' => '',
				'category' => '',
				'location' => '',
				'venues' => 'false',
				'venue-count' => '',
				'include-venues' => '',
				'exclude-venues' => '',
				'venue-order' => 'ASC',
				'venue-order-type' => 'added-date',
				'speakers' => 'false',
				'speaker-count' => '',
				'include-speakers' => '',
				'exclude-speakers' => '',
				'speaker-order' => 'ASC',
				'speaker-order-type' => 'added-date',
				'organizer' => 'false',
				'status' => '',
				'upcoming-status' => '',
				'showing-status' => '',
				'expired-status' => '',
				'tag' => '',
				'custom-tag-text' => '',
				'sort' => '',
				'price-slider' => 'false',
				'price-slider-grid' => 'false',
				'price-slider-min-price' => '0',
				'price-slider-max-price' => '999',
				'price-slider-from' => '0',
				'price-slider-to' => '299',
				'price-slider-step' => '1',
				'price-slider-min-max' => 'false',
				'price-slider-from-to' => 'false',
				'price-slider-prefix' => '',
				'price-slider-postfix' => '',
				'exclude-categories' => '',
				'exclude-locations' => '',
				'exclude-organizers' => '',
				'include-categories' => '',
				'include-locations' => '',
				'include-organizers' => '',
				'taxonomy-order' => 'ASC',
				'taxonomy-order-type' => 'name',
				'empty-taxonomies' => '',
				'childless' => '',
				'hide-children' => '',
				'slider-images' => '',
				'slider-column' => '1',
				'slider-space' => '0',
				'slider-height' => '100vh',
				'slider-autoplay' => 'false',
				'slider-autoplay-delay' => '15000',
				'slider-loop' => 'false',
				'slider-slide-speed' => '1000',
				'slider-centered-slides' => 'false',
				'slider-direction' => 'horizontal',
				'slider-effect' => 'slide',
				'slider-free-mode' => 'false',
			), $atts
		);

		$output = "";

		/*====== Price Slider ======*/
		if( empty( $atts["price-slider"] ) ) {

			$atts["price-slider"] = "false";

		}

		/*====== Price Slider Grid ======*/
		if( empty( $atts["price-slider-grid"] ) ) {

			$atts["price-slider-grid"] = "false";

		}

		/*====== Price Slider Min Price ======*/
		if( empty( $atts["price-slider-min-price"] ) ) {

			$atts["price-slider-min-price"] = "0";

		}

		/*====== Price Slider Max Price ======*/
		if( empty( $atts["price-slider-max-price"] ) ) {

			$atts["price-slider-max-price"] = "999";

		}

		/*====== Price Slider From ======*/
		if( empty( $atts["price-slider-from"] ) ) {

			$atts["price-slider-from"] = "0";

		}

		/*====== Price Slider To ======*/
		if( empty( $atts["price-slider-to"] ) ) {

			$atts["price-slider-to"] = "299";

		}

		/*====== Price Slider Step ======*/
		if( empty( $atts["price-slider-step"] ) ) {

			$atts["price-slider-step"] = "1";

		}

		/*====== Hide Price Slider Min Max ======*/
		if( empty( $atts["price-slider-min-max"] ) ) {

			$atts["price-slider-min-max"] = "false";

		}

		/*====== Hide Price Slider From To ======*/
		if( empty( $atts["price-slider-from-to"] ) ) {

			$atts["price-slider-from-to"] = "false";

		}

		/*====== Column ======*/
		if( empty( $atts["slider-column"] ) ) {

			$atts["slider-column"] = "1";

		}

		/*====== Column Space ======*/
		if( empty( $atts["slider-space"] ) ) {

			$atts["slider-space"] = "0";

		}

		/*====== Slider Height ======*/
		if( empty( $atts["slider-height"] ) ) {

			$atts["slider-height"] = "100vh";

		}

		/*====== Slider Autoplay Delay ======*/
		if( empty( $atts["slider-autoplay-delay"] ) ) {

			$atts["slider-autoplay-delay"] = "15000";

		}

		/*====== Slider Loop ======*/
		if( empty( $atts["slider-loop"] ) ) {

			$atts["slider-loop"] = "false";

		}

		/*====== Slider Slide Speed ======*/
		if( empty( $atts["slider-slide-speed"] ) ) {

			$atts["slider-slide-speed"] = "1000";

		}

		/*====== Centered Slides ======*/
		if( empty( $atts["slider-centered-slides"] ) ) {

			$atts["slider-centered-slides"] = "false";

		}

		/*====== Slider Direction ======*/
		if( empty( $atts["slider-direction"] ) ) {

			$atts["slider-direction"] = "horizontal";

		}

		/*====== Slider Effect ======*/
		if( empty( $atts["slider-effect"] ) ) {

			$atts["slider-effect"] = "slide";

		}

		/*====== Slider Free Mode ======*/
		if( empty( $atts["slider-free-mode"] ) ) {

			$atts["slider-free-mode"] = "false";

		}

		/*====== Taxonomy Order ======*/
		if( empty( $atts["taxonomy-order"] ) ) {

			$atts["taxonomy-order"] = "ASC";

		}

		/*====== Taxonomy Order Type ======*/
		if( empty( $atts["taxonomy-order-type"] ) ) {

			$atts["taxonomy-order-type"] = "name";

		}

		/*====== Empty Categories ======*/
		if( $atts['empty-taxonomies'] == 'false' ) {

			$empty_taxonomies = false;

		} else {

			$empty_taxonomies = true;

		}

		/*====== Childless ======*/
		if( $atts['childless'] == 'false' ) {

			$childless = false;

		} else {

			$childless = true;

		}

		/*====== Hide Children ======*/
		if( $atts['hide-children'] == 'false' ) {

			$hide_children = '';

		} else {

			$hide_children = 0;

		}

		/*====== Dark Background ======*/
		if( !empty( $atts["dark-background"] ) ) {

			$dark_bg = $atts["dark-background"];
			$dark_bg = esc_url( wp_get_attachment_url( $dark_bg, 'full', true, true ) );

		} else {

			$dark_bg = '';

		}

		/*====== Include Categories ======*/
		if( !empty( $atts['include-categories'] ) ) {

			$include_categories = $atts['include-categories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		/*====== Include Locations ======*/
		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		/*====== Include Organizers ======*/
		if( !empty( $atts['include-organizers'] ) ) {

			$include_organizers = $atts['include-organizers'];
			$include_organizers = explode( ',', $include_organizers );

		} else {

			$include_organizers = "";

		}

		/*====== Exclude Categories ======*/
		if( !empty( $atts['exclude-categories'] ) ) {

			$exclude_categories = $atts['exclude-categories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		/*====== Exclude Locations ======*/
		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		/*====== Exclude Organizers ======*/
		if( !empty( $atts['exclude-organizers'] ) ) {

			$exclude_organizers = $atts['exclude-organizers'];
			$exclude_organizers = explode( ',', $exclude_organizers );

		} else {

			$exclude_organizers = "";

		}

		/*====== Keep Options ======*/
		$keep_options = ot_get_option( 'event-keep-search-options', 'on' );

		/*====== HTML Output ======*/
		$event_search_result_page = ot_get_option( 'event_search_result_page' );

		if( $atts["style"] == "dark" ) {

			$output .= '<div class="gt-event-search-tool gt-dark gt-style-2 gt-lazy-load" data-bg="' . $dark_bg . '">';

		} elseif( $atts["style"] == "style-3" ) {

			$output .= '<div class="gt-event-search-tool gt-style-3" style="height:' . esc_attr( $atts["slider-height"] ) . ';">';
				$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item-space="' . esc_attr( $atts["slider-space"] ) . '" data-gt-item-column="' . esc_attr( $atts["slider-column"] ) . '" data-gt-loop="' . esc_attr( $atts["slider-loop"] ) . '" data-gt-speed="' . esc_attr( $atts["slider-slide-speed"] ) . '" data-gt-direction="' . esc_attr( $atts["slider-direction"] ) . '" data-gt-effect="' . esc_attr( $atts["slider-effect"] ) . '" data-gt-centered-slides="' . esc_attr( $atts["slider-centered-slides"] ) . '" data-gt-free-mode="' . esc_attr( $atts["slider-free-mode"] ) . '">';
					$output .= '<div class="swiper-wrapper">';

						$slider_images = explode( ',', $atts["slider-images"] );

						if( !empty( $slider_images ) ) {

							foreach( $slider_images as $slider_image ) {

								if( !empty( $slider_image ) ) {

									$image_url = wp_get_attachment_image_src( esc_attr( $slider_image ), "eventchamp-event-slider" );

									if( $atts["slider-autoplay"] == "true" ) {

										$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $atts["slider-autoplay-delay"] ) . '">';

									} else {

										$output .= '<div class="swiper-slide">';

									}

										$output .= '<div class="gt-image gt-lazy-load" data-background="' . esc_url( $image_url[0] ) . '"></div>';
									$output .= '</div>';

								}

							}

						}

					$output .= '</div>';
				$output .= '</div>';

		} elseif( $atts["style"] == "style-4" ) {

			$output .= '<div class="gt-event-search-tool gt-style-4">';

		} elseif( $atts["style"] == "style-5" ) {

			$output .= '<div class="gt-event-search-tool gt-style-5">';

		} else {

			$output .= '<div class="gt-event-search-tool gt-white gt-style-1">';

		}

			$output .= '<div class="gt-form container">';

				if( !empty( $event_search_result_page ) ) {

					$output .= '<form method="get" action="' . get_the_permalink( $event_search_result_page ) . '">';
						$output .= '<div class="search-content">';
							$output .= '<div class="gt-columns gt-column-' . esc_attr( $atts["column"] ) . ' gt-columns-center gt-column-space-20">';

								if( $atts["title"] == "true" )  {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';

											if( !empty( $atts["custom-title"] ) ) {

												$output .= '<div class="title">' . esc_attr( $atts["custom-title"] ) . '</div>';

											} else {

												$output .= '<div class="title">' . esc_html__( 'Event Search', 'eventchamp' ) . ':</div>';

											}

										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["keyword"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';

											$search_keyword = "";

											if( $keep_options == "on" ) {

												if( isset( $_GET['keyword'] ) ) {

													$search_keyword = esc_js( esc_sql( esc_attr( $_GET["keyword"] ) ) );

												}
											}

											$keyword_placeholder = esc_html__( 'e.g. event, meetup', 'eventchamp' );

											if( !empty( $atts["custom-keyword-text"] ) ) {

												$keyword_placeholder = esc_attr( $atts["custom-keyword-text"] );

											}

											$output .= '<input name="keyword" type="text" placeholder="' . esc_attr( $keyword_placeholder ) . '" value="' . esc_attr( $search_keyword ) . '">';

										$output .= '</div>';
									$output .= '</div>';

								} else {

									$output .= '<div class="gt-col d-none">';
										$output .= '<div class="gt-inner">';
											$output .= '<input name="keyword" type="hidden">';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["category"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= '<select name="category" class="gt-select">';
												$output .= '<option value="">' . esc_html__( 'Category', 'eventchamp' ) . '</option>';
												$eventcat_terms = get_terms(
													array(
														'taxonomy' => 'eventcat',
														'order' => $atts["taxonomy-order"],
														'orderby' => $atts["taxonomy-order-type"],
														'hide_empty' => $empty_taxonomies,
														'childless' => $childless,
														'include' => $include_categories,
														'exclude' => $exclude_categories,
														'parent' => 0,
													)
												);

												if( ! empty( $eventcat_terms ) && ! is_wp_error( $eventcat_terms ) ) {

													foreach ( $eventcat_terms as $eventcat_term ) {

														if( !empty( $eventcat_term ) ) {

															if( $atts['hide-children'] == 'false' ) {

																$eventcat_sub_terms = get_terms(
																	array(
																		'taxonomy' => 'eventcat',
																		'order' => $atts["taxonomy-order"],
																		'orderby' => $atts["taxonomy-order-type"],
																		'hide_empty' => $empty_taxonomies,
																		'childless' => $childless,
																		'exclude' => $exclude_categories,
																		'parent' => $eventcat_term->term_id,
																	)
																);

															} else {

																$eventcat_sub_terms = "";

															}

															if( empty( $eventcat_sub_terms ) ) {

																$search_category = "";

																if( $keep_options == "on" ) {

																	if( isset( $_GET['category'] ) ) {

																		$search_category = esc_js( esc_sql( esc_attr( $_GET["category"] ) ) );

																	}
																}

																if( $search_category == $eventcat_term->term_id or get_queried_object_id() == $eventcat_term->term_id ) {

																	$output .= '<option value="' . esc_attr( $eventcat_term->term_id ) . '" selected>' . esc_attr( $eventcat_term->name ) . '</option>';

																} else {

																	$output .= '<option value="' . esc_attr( $eventcat_term->term_id ) . '">' . esc_attr( $eventcat_term->name ) . '</option>';

																}

															}

															if( $atts['hide-children'] == 'false' ) {

																if( ! empty( $eventcat_sub_terms ) && ! is_wp_error( $eventcat_sub_terms ) ) {

																	$output .= '<optgroup label="' . esc_attr( $eventcat_term->name ) . '">';

																		foreach ( $eventcat_sub_terms as $eventcat_sub_term ) {

																			if( !empty( $eventcat_sub_term ) ) {

																				$search_sub_category = "";

																				if( $keep_options == "on" ) {

																					if( isset( $_GET['category'] ) ) {

																						$search_sub_category = esc_js( esc_sql( esc_attr( $_GET["category"] ) ) );

																					}

																				}

																				if( $search_sub_category == $eventcat_sub_term->term_id or get_queried_object_id() == $eventcat_sub_term->term_id ) {

																					$output .= '<option class="gt-sub-option gt-inner-sub-option" value="' . esc_attr( $eventcat_sub_term->term_id ) . '" selected>' . esc_attr( $eventcat_sub_term->name ) . '</option>';

																				} else {

																					$output .= '<option class="gt-sub-option gt-inner-sub-option" value="' . esc_attr( $eventcat_sub_term->term_id ) . '">' . esc_attr( $eventcat_sub_term->name ) . '</option>';

																				}

																			}

																		}

																	$output .= '</optgroup>';

																}

															}

														}

													}

												}

											$output .= '</select>';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["location"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= '<select name="location" class="gt-select">';
												$output .= '<option value="">' . esc_html__( 'Location', 'eventchamp' ) . '</option>';
												$location_terms = get_terms(
													array(
														'taxonomy' => 'location',
														'order' => $atts["taxonomy-order"],
														'orderby' => $atts["taxonomy-order-type"],
														'hide_empty' => $empty_taxonomies,
														'childless' => $childless,
														'include' => $include_locations,
														'exclude' => $exclude_locations,
														'parent' => 0,
													)
												);

												if( ! empty( $location_terms ) && ! is_wp_error( $location_terms ) ) {

													foreach ( $location_terms as $location_term ) {

														if( !empty( $location_term ) ) {

															if( $atts['hide-children'] == 'false' ) {

																$location_sub_terms = get_terms(
																	array(
																		'taxonomy' => 'location',
																		'order' => $atts["taxonomy-order"],
																		'orderby' => $atts["taxonomy-order-type"],
																		'hide_empty' => $empty_taxonomies,
																		'childless' => $childless,
																		'exclude' => $exclude_locations,
																		'parent' => $location_term->term_id,
																	)
																);

															} else {

																$location_sub_terms = "";

															}

															if( empty( $location_sub_terms ) ) {

																$search_location = "";

																if( $keep_options == "on" ) {

																	if( isset( $_GET['location'] ) ) {

																		$search_location = esc_js( esc_sql( esc_attr( $_GET["location"] ) ) );

																	}
																}

																if( $search_location == $location_term->term_id or get_queried_object_id() == $location_term->term_id ) {

																	$output .= '<option value="' . esc_attr( $location_term->term_id ) . '" selected>' . esc_attr( $location_term->name ) . '</option>';

																} else {

																	$output .= '<option value="' . esc_attr( $location_term->term_id ) . '">' . esc_attr( $location_term->name ) . '</option>';

																}

															}

															if( $atts['hide-children'] == 'false' ) {

																if( ! empty( $location_sub_terms ) && ! is_wp_error( $location_sub_terms ) ) {

																	$output .= '<optgroup label="' . esc_attr( $location_term->name ) . '">';

																		foreach ( $location_sub_terms as $location_sub_term ) {

																			if( !empty( $location_sub_term ) ) {

																				$search_location = "";

																				if( $keep_options == "on" ) {

																					if( isset( $_GET['location'] ) ) {

																						$search_location = esc_js( esc_sql( esc_attr( $_GET["location"] ) ) );

																					}
																				}

																				if( $search_location == $location_sub_term->term_id or get_queried_object_id() == $location_sub_term->term_id ) {

																					$output .= '<option class="gt-sub-option" value="' . esc_attr( $location_sub_term->term_id ) . '" selected>' . esc_attr( $location_sub_term->name ) . '</option>';

																				} else {

																					$output .= '<option class="gt-sub-option" value="' . esc_attr( $location_sub_term->term_id ) . '">' . esc_attr( $location_sub_term->name ) . '</option>';

																				}

																			}

																		}

																	$output .= '</optgroup>';

																}

															}

														}

													}

												}

											$output .= '</select>';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["venues"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= '<select name="event-venue" class="gt-select">';
												$output .= '<option value="">' . esc_html__( 'Venue', 'eventchamp' ) . '</option>';

												/*====== Venue Query ======*/
												$venue_query_arg = array(
													'posts_per_page' => esc_attr( $atts["venue-count"] ),
													'post_status' => 'publish',
													'post_type' => 'venue',
												);

												/*====== Exclude Venues ======*/
												if( !empty( $atts['exclude-venues'] ) ) {

													$exclude_venues = $atts['exclude-venues'];
													$exclude_venues = explode( ',', $exclude_venues );

												} else {

													$exclude_venues = "";

												}

												if( !empty( $exclude_venues ) ) {

													$venue_extra_query = array(
														'post__not_in' => $exclude_venues,
													);
													$venue_query_arg = wp_parse_args( $venue_query_arg, $venue_extra_query );

												}

												/*====== Include Venues ======*/
												if( !empty( $atts['include-venues'] ) ) {

													$include_venues = $atts['include-venues'];
													$include_venues = explode( ',', $include_venues );

												} else {

													$include_venues = "";

												}

												if( !empty( $include_venues ) ) {

													$venue_extra_query = array(
														'post__in' => $include_venues,
													);
													$venue_query_arg = wp_parse_args( $venue_query_arg, $venue_extra_query );

												}

												/*====== Venue Order ======*/
												if( !empty( $atts["venue-order"] ) ) {

													$venue_extra_query = array(
														'order' => $atts["venue-order"],
													);
													$venue_query_arg = wp_parse_args( $venue_query_arg, $venue_extra_query );

												}

												/*====== Venue Order Type ======*/
												if( empty( $atts["venue-order-type"] ) ) {

													if( $atts["venue-order-type"] == "popular-comment" ) {

														$atts["venue-order-type"] = "comment_count";

													} elseif( $atts["venue-order-type"] == "id" ) {

														$atts["venue-order-type"] = "ID";

													} elseif( $atts["venue-order-type"] == "popular" ) {

														$atts["venue-order-type"] = "comment_count";

													} elseif( $atts["venue-order-type"] == "title" ) {

														$atts["venue-order-type"] = "title";

													} elseif( $atts["venue-order-type"] == "menu_order" ) {

														$atts["venue-order-type"] = "menu_order";

													} elseif( $atts["venue-order-type"] == "rand" ) {

														$atts["venue-order-type"] = "rand";

													} elseif( $atts["venue-order-type"] == "post__in" ) {

														$atts["venue-order-type"] = "post__in";

													} elseif( $atts["venue-order-type"] == "none" ) {

														$atts["venue-order-type"] = "none";

													} else {

														$atts["venue-order-type"] = "date";

													}

												}

												if( !empty( $atts["venue-order-type"] ) ) {

													$venue_extra_query = array(
														'orderby' => $atts["venue-order-type"],
													);
													$venue_query_arg = wp_parse_args( $venue_query_arg, $venue_extra_query );

												}

												$wp_query = new WP_Query( $venue_query_arg );

												if( !empty( $wp_query ) ) {

													if( $wp_query->have_posts() ) {

														while( $wp_query->have_posts() ) {

															$wp_query->the_post();

															$search_venue = "";

															if( $keep_options == "on" ) {

																if( isset( $_GET['event-venue'] ) ) {

																	$search_venue = esc_js( esc_sql( esc_attr( $_GET["event-venue"] ) ) );

																}
															}

															if( $search_venue == get_the_ID() ) {

																$output .= '<option value="' . get_the_ID() . '" selected>' . get_the_title() . '</option>';

															} else {

																$output .= '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';

															}
															
														}

													}

												}
												wp_reset_postdata();

											$output .= '</select>';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["speakers"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= '<select name="event-speaker" class="gt-select">';
												$output .= '<option value="">' . esc_html__( 'Speaker', 'eventchamp' ) . '</option>';

												/*====== Speaker Query ======*/
												$speaker_query_arg = array(
													'posts_per_page' => esc_attr( $atts["speaker-count"] ),
													'post_status' => 'publish',
													'post_type' => 'speaker',
												);

												/*====== Exclude Speakers ======*/
												if( !empty( $atts['exclude-speakers'] ) ) {

													$exclude_speakers = $atts['exclude-speakers'];
													$exclude_speakers = explode( ',', $exclude_speakers );

												} else {

													$exclude_speakers = "";

												}

												if( !empty( $exclude_speakers ) ) {

													$speaker_extra_query = array(
														'post__not_in' => $exclude_speakers,
													);
													$speaker_query_arg = wp_parse_args( $speaker_query_arg, $speaker_extra_query );

												}

												/*====== Include Speakers ======*/
												if( !empty( $atts['include-speakers'] ) ) {

													$include_speakers = $atts['include-speakers'];
													$include_speakers = explode( ',', $include_speakers );

												} else {

													$include_speakers = "";

												}

												if( !empty( $include_speakers ) ) {

													$speaker_extra_query = array(
														'post__in' => $include_speakers,
													);
													$speaker_query_arg = wp_parse_args( $speaker_query_arg, $speaker_extra_query );

												}

												/*====== Speaker Order ======*/
												if( !empty( $atts["speaker-order"] ) ) {

													$speaker_extra_query = array(
														'order' => $atts["speaker-order"],
													);
													$speaker_query_arg = wp_parse_args( $speaker_query_arg, $speaker_extra_query );

												}

												/*====== Speaker Order Type ======*/
												if( empty( $atts["speaker-order-type"] ) ) {

													if( $atts["speaker-order-type"] == "popular-comment" ) {

														$atts["speaker-order-type"] = "comment_count";

													} elseif( $atts["speaker-order-type"] == "id" ) {

														$atts["speaker-order-type"] = "ID";

													} elseif( $atts["speaker-order-type"] == "popular" ) {

														$atts["speaker-order-type"] = "comment_count";

													} elseif( $atts["speaker-order-type"] == "title" ) {

														$atts["speaker-order-type"] = "title";

													} elseif( $atts["speaker-order-type"] == "menu_order" ) {

														$atts["speaker-order-type"] = "menu_order";

													} elseif( $atts["speaker-order-type"] == "rand" ) {

														$atts["speaker-order-type"] = "rand";

													} elseif( $atts["speaker-order-type"] == "post__in" ) {

														$atts["speaker-order-type"] = "post__in";

													} elseif( $atts["speaker-order-type"] == "none" ) {

														$atts["speaker-order-type"] = "none";

													} else {

														$atts["speaker-order-type"] = "date";

													}

												}

												if( !empty( $atts["speaker-order-type"] ) ) {

													$speaker_extra_query = array(
														'orderby' => $atts["speaker-order-type"],
													);
													$speaker_query_arg = wp_parse_args( $speaker_query_arg, $speaker_extra_query );

												}

												$wp_query = new WP_Query( $speaker_query_arg );

												if( !empty( $wp_query ) ) {

													if( $wp_query->have_posts() ) {

														while( $wp_query->have_posts() ) {

															$wp_query->the_post();

															$search_speaker = "";

															if( $keep_options == "on" ) {

																if( isset( $_GET['event-speaker'] ) ) {

																	$search_speaker = esc_js( esc_sql( esc_attr( $_GET["event-speaker"] ) ) );

																}
															}

															if( $search_speaker == get_the_ID() ) {

																$output .= '<option value="' . get_the_ID() . '" selected>' . get_the_title() . '</option>';

															} else {

																$output .= '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';

															}
															
														}

													}

												}
												wp_reset_postdata();

											$output .= '</select>';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["organizer"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= '<select name="organizer" class="gt-select">';
												$output .= '<option value="">' . esc_html__( 'Organizer', 'eventchamp' ) . '</option>';
												$organizer_terms = get_terms(
													array(
														'taxonomy' => 'organizer',
														'order' => $atts["taxonomy-order"],
														'orderby' => $atts["taxonomy-order-type"],
														'hide_empty' => $empty_taxonomies,
														'childless' => $childless,
														'include' => $include_organizers,
														'exclude' => $exclude_organizers,
														'parent' => 0,
													)
												);

												if( ! empty( $organizer_terms ) && ! is_wp_error( $organizer_terms ) ) {

													foreach ( $organizer_terms as $organizer_term ) {

														if( !empty( $organizer_term ) ) {

															if( $atts['hide-children'] == 'false' ) {

																$organizer_sub_terms = get_terms(
																	array(
																		'taxonomy' => 'organizer',
																		'order' => $atts["taxonomy-order"],
																		'orderby' => $atts["taxonomy-order-type"],
																		'hide_empty' => $empty_taxonomies,
																		'childless' => $childless,
																		'exclude' => $exclude_organizers,
																		'parent' => $organizer_term->term_id,
																	)
																);

															} else {

																$organizer_sub_terms = "";

															}

															if( empty( $organizer_sub_terms ) ) {

																$search_organizer = "";

																if( $keep_options == "on" ) {

																	if( isset( $_GET['organizer'] ) ) {

																		$search_organizer = esc_js( esc_sql( esc_attr( $_GET["organizer"] ) ) );

																	}
																}

																if( $search_organizer == $organizer_term->term_id or get_queried_object_id() == $organizer_term->term_id ) {

																	$output .= '<option value="' . esc_attr( $organizer_term->term_id ) . '" selected>' . esc_attr( $organizer_term->name ) . '</option>';

																} else {

																	$output .= '<option value="' . esc_attr( $organizer_term->term_id ) . '">' . esc_attr( $organizer_term->name ) . '</option>';

																}

															}

															if( $atts['hide-children'] == 'false' ) {

																if( ! empty( $organizer_sub_terms ) && ! is_wp_error( $organizer_sub_terms ) ) {

																	$output .= '<optgroup label="' . esc_attr( $organizer_term->name ) . '">';

																		foreach ( $organizer_sub_terms as $organizer_sub_term ) {

																			if( !empty( $organizer_sub_term ) ) {

																				$search_organizer = "";

																				if( $keep_options == "on" ) {

																					if( isset( $_GET['organizer'] ) ) {

																						$search_organizer = esc_js( esc_sql( esc_attr( $_GET["organizer"] ) ) );

																					}
																				}

																				if( $search_organizer == $organizer_term->term_id or get_queried_object_id() == $term_id->term_id ) {

																					$output .= '<option value="' . esc_attr( $organizer_term->term_id ) . '" selected>' . esc_attr( $organizer_term->name ) . '</option>';

																				} else {

																					$output .= '<option value="' . esc_attr( $organizer_term->term_id ) . '">' . esc_attr( $organizer_term->name ) . '</option>';

																				}

																			}

																		}

																	$output .= '</optgroup>';

																}

															}

														}

													}

												}

											$output .= '</select>';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["status"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= '<select name="status" class="gt-select">';
												$output .= '<option value="">' . esc_html__( 'Status', 'eventchamp' ) . '</option>';

												if( $atts["upcoming-status"] == "true" ) {

													$search_upcoming_status = "";

													if( $keep_options == "on" ) {

														if( isset( $_GET['status'] ) ) {

															$search_upcoming_status = esc_js( esc_sql( esc_attr( $_GET["status"] ) ) );

														}
													}

													if( $search_upcoming_status == "upcoming" ) {

														$output .= '<option value="upcoming" selected>' . esc_html__( 'Upcoming', 'eventchamp' ) . '</option>';

													} else {

														$output .= '<option value="upcoming">' . esc_html__( 'Upcoming', 'eventchamp' ) . '</option>';

													}

												}

												if( $atts["showing-status"] == "true" ) {

													$search_showing_status = "";

													if( $keep_options == "on" ) {

														if( isset( $_GET['status'] ) ) {

															$search_showing_status = esc_js( esc_sql( esc_attr( $_GET["status"] ) ) );

														}
													}

													if( $search_showing_status == "showing" ) {

														$output .= '<option value="showing" selected>' . esc_html__( 'Showing', 'eventchamp' ) . '</option>';

													} else {

														$output .= '<option value="showing">' . esc_html__( 'Showing', 'eventchamp' ) . '</option>';

													}

												}

												if( $atts["expired-status"] == "true" ) {

													$search_expired_status = "";

													if( $keep_options == "on" ) {

														if( isset( $_GET['status'] ) ) {

															$search_expired_status = esc_js( esc_sql( esc_attr( $_GET["status"] ) ) );

														}
													}

													if( $search_expired_status == "expired" ) {

														$output .= '<option value="expired" selected>' . esc_html__( 'Expired', 'eventchamp' ) . '</option>';

													} else {

														$output .= '<option value="expired">' . esc_html__( 'Expired', 'eventchamp' ) . '</option>';

													}

												}

											$output .= '</select>';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["startdate"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';

											$search_start_date = "";

											if( $keep_options == "on" ) {

												if( isset( $_GET['startdate'] ) ) {

													$search_start_date = esc_js( esc_sql( esc_attr( $_GET["startdate"] ) ) );

												}
											}

											$end_date_placeholder = esc_html__( 'Start Date', 'eventchamp' );

											$output .= '<input type="text" name="startdate" autocomplete="off" class="eventsearchdate-datepicker" placeholder="' . esc_attr( $end_date_placeholder ) . '" value="' . esc_attr( $search_start_date ) . '" />';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["enddate"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';

											$search_end_date = "";

											if( $keep_options == "on" ) {

												if( isset( $_GET['enddate'] ) ) {

													$search_end_date = esc_js( esc_sql( esc_attr( $_GET["enddate"] ) ) );

												}
											}

											$end_date_placeholder = esc_html__( 'End Date', 'eventchamp' );

											$output .= '<input type="text" name="enddate" autocomplete="off" class="eventsearchdate-datepicker" placeholder="' . esc_attr( $end_date_placeholder ) . '" value="' . esc_attr( $search_end_date ) . '" />';

										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["tag"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';

											$search_tag = "";

											if( $keep_options == "on" ) {

												if( isset( $_GET['tag'] ) ) {

													$search_tag = esc_js( esc_sql( esc_attr( $_GET["tag"] ) ) );

												}
											}

											$tag_placeholder = esc_html__( 'Enter a tag: art, food', 'eventchamp' );

											if( !empty( $atts["custom-tag-text"] ) ) {

												$tag_placeholder = esc_attr( $atts["custom-tag-text"] );

											}

											$output .= '<input type="text"  name="tag" placeholder="' . esc_attr( $tag_placeholder ) . '" value="' . esc_attr( $search_tag ) . '" />';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["sort"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= '<select name="sort" class="gt-select">';

												if( $keep_options == "on" and isset( $_GET['sort'] ) ) {

													$output .= '<option>' . esc_html__( 'Sort by', 'eventchamp' ) . '</option>';
													$output .= '<option value="start-date" ' . ( esc_js( esc_sql( esc_attr( $_GET["sort"] ) ) ) == 'start-date' ? 'selected' : ''  ) . '>' . esc_html__( 'Start Date', 'eventchamp' ) . '</option>';
													$output .= '<option value="end-date" ' . ( esc_js( esc_sql( esc_attr( $_GET["sort"] ) ) ) == 'end-date' ? 'selected' : ''  ) . '>' . esc_html__( 'End Date', 'eventchamp' ) . '</option>';
													$output .= '<option value="added-date" ' . ( esc_js( esc_sql( esc_attr( $_GET["sort"] ) ) ) == 'added-date' ? 'selected' : ''  ) . '>' . esc_html__( 'Added Date', 'eventchamp' ) . '</option>';
													$output .= '<option value="name-az" ' . ( esc_js( esc_sql( esc_attr( $_GET["sort"] ) ) ) == 'name-az' ? 'selected' : ''  ) . '>' . esc_html__( 'Name A > Z', 'eventchamp' ) . '</option>';
													$output .= '<option value="name-za" ' . ( esc_js( esc_sql( esc_attr( $_GET["sort"] ) ) ) == 'name-za' ? 'selected' : ''  ) . '>' . esc_html__( 'Name Z > A', 'eventchamp' ) . '</option>';

												} else {

													$output .= '<option value="">' . esc_html__( 'Sort by', 'eventchamp' ) . '</option>';
													$output .= '<option value="start-date">' . esc_html__( 'Start Date', 'eventchamp' ) . '</option>';
													$output .= '<option value="end-date">' . esc_html__( 'End Date', 'eventchamp' ) . '</option>';
													$output .= '<option value="added-date">' . esc_html__( 'Added Date', 'eventchamp' ) . '</option>';
													$output .= '<option value="name-az">' . esc_html__( 'Name A > Z', 'eventchamp' ) . '</option>';
													$output .= '<option value="name-za">' . esc_html__( 'Name Z > A', 'eventchamp' ) . '</option>';

												}

											$output .= '</select>';
										$output .= '</div>';
									$output .= '</div>';

								}

								if( $atts["price-slider"] == "true" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';

											$search_price = "";

											if( $keep_options == "on" ) {

												if( isset( $_GET['price'] ) ) {

													$search_price = esc_js( esc_sql( esc_attr( $_GET["price"] ) ) );

												}

												if( !empty( $search_price ) ) {

													$prices = explode( ';', $search_price );

													$atts["price-slider-from"] = $prices[0];
													$atts["price-slider-to"] = $prices[1];

												}

											}

											$output .= '<input class="gt-range-slider" data-gt-grid="' . esc_attr( $atts["price-slider-grid"] ) . '" data-gt-min="' . esc_attr( $atts["price-slider-min-price"] ) . '" data-gt-max="' . esc_attr( $atts["price-slider-max-price"] ) . '" data-gt-from="' . esc_attr( $atts["price-slider-from"] ) . '" data-gt-to="' . esc_attr( $atts["price-slider-to"] ) . '" data-gt-step="' . esc_attr( $atts["price-slider-step"] ) . '" data-gt-hide-min-max="' . esc_attr( $atts["price-slider-min-max"] ) . '" data-gt-hide-from-to="' . esc_attr( $atts["price-slider-from-to"] ) . '" data-gt-postfix="' . esc_attr( $atts["price-slider-postfix"] ) . '" data-gt-prefix="' . esc_attr( $atts["price-slider-prefix"] ) . '" type="text" name="price" value="' . esc_attr( $search_price ) . '" autocomplete="off" />';
										$output .= '</div>';
									$output .= '</div>';

								}

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= '<button type="submit" class="gt-submit">' . esc_html__( 'Search', 'eventchamp' ) . '</button>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</form>';

				} else {

					$output .= '<div class="gt-choose-page">';
						$output .= wpautop( esc_html__( 'You should choose a search result page. You can choose the page from the Theme Options > Events > Event Search Results Page option.', 'eventchamp' ) );
					$output .= '</div>';

				}

			$output .= '</div>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_event_search", "eventchamp_event_search_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Event Search Tool', 'eventchamp' ),
				"base" => "eventchamp_event_search",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/event-search-tool.jpg',
				"description" => esc_html__( 'Event search tool element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style. Style 3 for the slider background, style 2 for the image background, style 1 for the color background.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'white',
							esc_html__( 'Style 2', 'eventchamp' ) => 'dark',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style-3',
							esc_html__( 'Style 4', 'eventchamp' ) => 'style-4',
							esc_html__( 'Style 5', 'eventchamp' ) => 'style-5',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
							esc_html__( '7 Column', 'eventchamp' ) => '7',
							esc_html__( '8 Column', 'eventchamp' ) => '8',
							esc_html__( '9 Column', 'eventchamp' ) => '9',
							esc_html__( '10 Column', 'eventchamp' ) => '10',
						),
					),
					array(
						"type" => "attach_image",
						"param_name" => "dark-background",
						"heading" => esc_html__( 'Background Image for the Style 2', 'eventchamp' ),
						"description" => esc_html__( 'You can upload a background image for the style 2.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "title",
						"heading" => esc_html__( 'Search Title', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the search title.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "custom-title",
						"heading" => esc_html__( 'Custom Search Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text. Default: Event Search:', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "startdate",
						"heading" => esc_html__( 'Start Date', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the start date.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "enddate",
						"heading" => esc_html__( 'End Date', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the end date.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "keyword",
						"heading" => esc_html__( 'Keyword', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the keyword.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "custom-keyword-text",
						"heading" => esc_html__( 'Custom Keyword Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text. Default: e.g. event, meetup', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "category",
						"heading" => esc_html__( 'Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the categories.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "location",
						"heading" => esc_html__( 'Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the locations.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "venues",
						"heading" => esc_html__( 'Venues', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the venues.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "venue-count",
						"heading" => esc_html__( 'Venue Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a venue count.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-venues",
						"heading" => esc_html__( 'Include Venues', 'eventchamp' ),
						"description" => esc_html__( 'You can enter venue ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-venues",
						"heading" => esc_html__( 'Exclude Venues', 'eventchamp' ),
						"description" => esc_html__( 'You can enter venue ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "venue-order",
						"heading" => esc_html__( 'Venue Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "venue-order-type",
						"heading" => esc_html__( 'Venue Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speakers",
						"heading" => esc_html__( 'Speakers', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the speakers.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "speaker-count",
						"heading" => esc_html__( 'Speaker Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a speaker count.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-speakers",
						"heading" => esc_html__( 'Include Speakers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter speaker ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-speakers",
						"heading" => esc_html__( 'Exclude Speakers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter speaker ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-order",
						"heading" => esc_html__( 'Speaker Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-order-type",
						"heading" => esc_html__( 'Speaker Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "organizer",
						"heading" => esc_html__( 'Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the organizers.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "status",
						"heading" => esc_html__( 'Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event status.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "upcoming-status",
						"heading" => esc_html__( 'Upcoming for the Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the upcoming status for the status dropdown.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "showing-status",
						"heading" => esc_html__( 'Showing for the Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the showing status for the status dropdown.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "expired-status",
						"heading" => esc_html__( 'Expired for the Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the expired status for the status dropdown.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "tag",
						"heading" => esc_html__( 'Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the tag.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "custom-tag-text",
						"heading" => esc_html__( 'Custom Tag Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag text. Enter a tag: art, food', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "sort",
						"heading" => esc_html__( 'Sort Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the sort type.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "price-slider",
						"heading" => esc_html__( 'Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the price slider.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "price-slider-grid",
						"heading" => esc_html__( 'Grid for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the grid for the price slider.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "price-slider-min-price",
						"heading" => esc_html__( 'Min Price for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a min price for the price slider. Default: 0', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "price-slider-max-price",
						"heading" => esc_html__( 'Max Price for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a max price for the price slider. Default: 999', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "price-slider-from",
						"heading" => esc_html__( 'From Price for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a from price for the price slider. Set start position for left handle (or for single handle). Default: 0', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "price-slider-to",
						"heading" => esc_html__( 'To Price for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a to price for the price slider. Set start position for right handle. Default: 299', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "price-slider-step",
						"heading" => esc_html__( 'Step for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a step for the price slider. Set sliders step. Always > 0. Could be fractional. Default: 1', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "price-slider-min-max",
						"heading" => esc_html__( 'Hide Min-Max Label for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the min-max info label for the price slider.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "price-slider-from-to",
						"heading" => esc_html__( 'Hide From-To Label for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the from-to info label for the price slider.', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "price-slider-prefix",
						"heading" => esc_html__( 'Prefix for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a prefix text. Will be set up right before the number. Example: $100', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "price-slider-postfix",
						"heading" => esc_html__( 'Postfix for the Price Slider', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a postfix text. Will be set up right after the number. Example: 100k', 'eventchamp' ),
						"group" => esc_html__( 'Fields', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-categories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-organizers",
						"heading" => esc_html__( 'Exclude Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizer ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-categories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Example: 1, 2, 3 etc. If you have sub categories, it will work only for parents.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc. If you have sub locations, it will work only for parents.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-organizers",
						"heading" => esc_html__( 'Include Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizer ids. Separate with commas. Example: 1,2,3 etc. If you have sub organizers, it will work only for parents.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "taxonomy-order",
						"heading" => esc_html__( 'Taxonomy Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "taxonomy-order-type",
						"heading" => esc_html__( 'Taxonomy Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Name', 'eventchamp' ) => 'name',
							esc_html__( 'Slug', 'eventchamp' ) => 'slug',
							esc_html__( 'Term Group', 'eventchamp' ) => 'term_group',
							esc_html__( 'Term ID', 'eventchamp' ) => 'term_id',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Description', 'eventchamp' ) => 'description',
							esc_html__( 'Parent', 'eventchamp' ) => 'parent',
							esc_html__( 'Count', 'eventchamp' ) => 'count',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "empty-taxonomies",
						"heading" => esc_html__( 'Hide Empty Taxonomies', 'eventchamp' ),
						"description" => esc_html__( 'You can choose visible status of the empty taxonomies. If you choose true option empty taxonomies will be hide.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "childless",
						"heading" => esc_html__( 'Childless', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the childless taxonomies.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-children",
						"heading" => esc_html__( 'Hide Children', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the children.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "attach_images",
						"param_name" => "slider-images",
						"heading" => esc_html__( 'Slider Images', 'eventchamp' ),
						"description" => esc_html__( 'You can upload slider images for the style 3.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-height",
						"heading" => esc_html__( 'Slider Height', 'eventchamp' ),
						"description" => esc_html__( 'If you use the style 3, Enter a slider height. Example: 600px. If enter blank, it will have full height.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
							esc_html__( '7 Column', 'eventchamp' ) => '7',
							esc_html__( '8 Column', 'eventchamp' ) => '8',
							esc_html__( '9 Column', 'eventchamp' ) => '9',
							esc_html__( '10 Column', 'eventchamp' ) => '10',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-space",
						"heading" => esc_html__( 'Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a space value for space between the slides.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0px', 'eventchamp' ) => '0',
							esc_html__( '1px', 'eventchamp' ) => '1',
							esc_html__( '2px', 'eventchamp' ) => '2',
							esc_html__( '3px', 'eventchamp' ) => '3',
							esc_html__( '4px', 'eventchamp' ) => '4',
							esc_html__( '5px', 'eventchamp' ) => '5',
							esc_html__( '10px', 'eventchamp' ) => '10',
							esc_html__( '15px', 'eventchamp' ) => '15',
							esc_html__( '20px', 'eventchamp' ) => '20',
							esc_html__( '25px', 'eventchamp' ) => '25',
							esc_html__( '30px', 'eventchamp' ) => '30',
							esc_html__( '45px', 'eventchamp' ) => '45',
							esc_html__( '50px', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-autoplay",
						"heading" => esc_html__( 'Slider Autoplay', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the autoplay.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-autoplay-delay",
						"heading" => esc_html__( 'Slider Autoplay Delay', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an autoplay delay value. Default: 15000', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-loop",
						"heading" => esc_html__( 'Slider Loop', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the loop.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-slide-speed",
						"heading" => esc_html__( 'Slide Speed', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a slide speed. Duration of transition between the slides. Default: 1500', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-centered-slides",
						"heading" => esc_html__( 'Centered Slides', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the centered slides. If you choose true, then active slide will be centered, not always on the left side.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-direction",
						"heading" => esc_html__( 'Slider Direction', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a direction.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Horizontal', 'eventchamp' ) => 'horizontal',
							esc_html__( 'Vertical', 'eventchamp' ) => 'vertical',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-effect",
						"heading" => esc_html__( 'Slider Effect', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an effect.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Slide', 'eventchamp' ) => 'slide',
							esc_html__( 'Fade', 'eventchamp' ) => 'fade',
							esc_html__( 'Cube', 'eventchamp' ) => 'cube',
							esc_html__( 'Coverflow', 'eventchamp' ) => 'coverflow',
							esc_html__( 'Flip', 'eventchamp' ) => 'flip',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-free-mode",
						"heading" => esc_html__( 'Free Mode', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the free mode. If true then slides will not have fixed positions', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Event Search Results
*
======*/
if( !function_exists( 'eventchamp_events_search_results_output' ) ) {

	function eventchamp_events_search_results_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'eventcount' => '',
				'eventids' => '',
				'excludeevents' => '',
				'offset' => '',
				'order' => '',
				'order-type' => '',
				'hideexpired' => '',
				'pagination' => '',
				'excludecategories' => '',
				'exclude-locations' => '',
				'exclude-organizers' => '',
				'exclude-tags' => '',
				'includecategories' => '',
				'include-locations' => '',
				'include-organizers' => '',
				'include-tags' => '',
				'style' => '',
				'column' => '',
				'price' => '',
				'status' => '',
				'category' => '',
				'location' => '',
				'venue' => '',
				'date' => '',
				'start-time' => '',
				'ticket-amount' => '',
				'excerpt' => '',
			), $atts
		);

		$output = "";

		/*====== Date Now ======*/
		$date_now = date( 'Y-m-d' );

		/*====== Expired Events Status ======*/
		if( !empty( $atts["hideexpired"] ) ) {

			$hideexpired = esc_attr( $atts["hideexpired"] );

		} else {

			$hideexpired = "";

		}

		/*====== Column ======*/
		if( !empty( $atts["column"] ) ) {

			$column = esc_attr( $atts["column"] );

		} else {

			$column = "column-1";

		}

		/*====== Price Status ======*/
		if( $atts["price"] == "true" ) {

			$price_status = "true";

		} else {

			$price_status = "false";

		}

		/*====== Status Status ======*/
		if( $atts["status"] == "true" ) {

			$status_status = "true";

		} else {

			$status_status = "false";

		}

		/*====== Category Status ======*/
		if( $atts["category"] == "true" ) {

			$category_status = "true";

		} else {

			$category_status = "false";

		}

		/*====== Location Status ======*/
		if( $atts["location"] == "true" ) {

			$location_status = "true";

		} else {

			$location_status = "false";

		}

		/*====== Venue Status ======*/
		if( $atts["venue"] == "true" ) {

			$venue_status = "true";

		} else {

			$venue_status = "false";

		}

		/*====== Date Status ======*/
		if( $atts["date"] == "true" ) {

			$date_status = "true";

		} else {

			$date_status = "false";

		}

		/*====== Start Time Status ======*/
		if( $atts["start-time"] == "true" ) {

			$start_time_status = "true";

		} else {

			$start_time_status = "false";

		}

		/*====== Ticket Amount Status ======*/
		if( $atts["ticket-amount"] == "true" ) {

			$ticket_amount_status = "true";

		} else {

			$ticket_amount_status = "false";

		}

		/*====== Excerpt Status ======*/
		if( $atts["excerpt"] == "true" ) {

			$excerpt_status = "true";

		} else {

			$excerpt_status = "false";

		}

		/*====== Search Results ======*/
		if( isset( $_GET['keyword'] ) or isset( $_GET['category'] ) or isset( $_GET['status'] ) or isset( $_GET['sort'] ) or isset( $_GET['tag'] ) or isset( $_GET['location'] ) or isset( $_GET['event-venue'] ) or isset( $_GET['event-speaker'] ) or isset( $_GET['startdate'] ) or isset( $_GET['enddate'] ) or isset( $_GET['price'] ) ) {

			if( isset( $_GET['keyword'] ) ) {

				$search_keyword = esc_js( esc_sql( esc_attr( $_GET["keyword"] ) ) );

			} else {

				$search_keyword = "";

			}

			if( isset( $_GET['category'] ) ) {

				$search_category = esc_js( esc_sql( esc_attr( $_GET["category"] ) ) );

			} else {

				$search_category = "";

			}

			if( isset( $_GET['status'] ) ) {

				$search_status = esc_js( esc_sql( esc_attr( $_GET["status"] ) ) );

			} else {

				$search_status = "";

			}

			if( isset( $_GET['sort'] ) ) {

				$search_sort = esc_js( esc_sql( esc_attr( $_GET["sort"] ) ) );

			} else {

				$search_sort = "";

			}

			if( isset( $_GET['tag'] ) ) {

				$search_tag = esc_js( esc_sql( esc_attr( $_GET["tag"] ) ) );

			} else {

				$search_tag = "";

			}

			if( isset( $_GET['location'] ) ) {

				$search_location = esc_js( esc_sql( esc_attr( $_GET["location"] ) ) );

			} else {

				$search_location = "";

			}

			if( isset( $_GET['event-venue'] ) ) {

				$search_venue = esc_js( esc_sql( esc_attr( $_GET["event-venue"] ) ) );

			} else {

				$search_venue = "";

			}

			if( isset( $_GET['event-speaker'] ) ) {

				$search_speaker = esc_js( esc_sql( esc_attr( $_GET["event-speaker"] ) ) );

			} else {

				$search_speaker = "";

			}

			if( isset( $_GET['organizer'] ) ) {

				$search_organizer = esc_js( esc_sql( esc_attr( $_GET["organizer"] ) ) );

			} else {

				$search_organizer = "";

			}

			if( isset( $_GET['startdate'] ) ) {

				if( !empty( $_GET['startdate'] ) ) {

					$search_startdate = esc_js( esc_sql( esc_attr( $_GET["startdate"] ) ) );
					$search_startdate = date( 'Y-m-d', strtotime( $search_startdate ) );
					$search_startdate_compare = ">=";

				} else {

					$search_startdate = "";
					$search_startdate_compare = "";

				}

			} else {

				$search_startdate = "";
				$search_startdate_compare = "";

			}

			if( isset( $_GET['enddate'] ) ) {

				if( !empty( $_GET['enddate'] ) ) {

					$search_enddate = esc_js( esc_sql( esc_attr( $_GET["enddate"] ) ) );
					$search_enddate = date( 'Y-m-d', strtotime( $search_enddate ) );
					$search_enddate_compare = "<=";

				} else {

					$search_enddate = "";
					$search_enddate_compare = "";

				}

			} else {

				$search_enddate = "";
				$search_enddate_compare = "";

			}
			
			if( $search_status == "upcoming" ) {

				$search_compare = ">";
				$search_compare2 = ">";

			} elseif( $search_status == "showing" ) {

				$search_compare = "<=";
				$search_compare2 = ">=";

			} elseif( $search_status == "expired" ) {

				$search_compare = "<";
				$search_compare2 = "<";

			} else {

				$search_compare = "<=";
				$search_compare2 = ">=";

			}

			$prices = array();

			if( isset( $_GET['price'] ) ) {

				$search_price = esc_js( esc_sql( esc_attr( $_GET["price"] ) ) );

				if( !empty( $search_price ) ) {

					$prices = explode( ';', $search_price );

				}

			}

		} else {

			$search_startdate = "";
			$search_startdate_compare = "";
			$search_enddate = "";
			$search_enddate_compare = "";
			$search_keyword = "";
			$search_category = "";
			$search_status = "";
			$search_sort = "";
			$search_location = "";
			$search_venue = "";
			$search_speaker = "";
			$search_organizer = "";
			$search_compare = "";
			$search_compare2 = "";
			$order = "";
			$order_by = "";
			$meta_key = "event_start_date";
			$search_tag = "";
			$prices = array();

		}

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['excludecategories'] ) ) {

			$exclude_categories = $atts['excludecategories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Organizers ======*/
		$exclude_organizer_array = "";

		if( !empty( $atts['exclude-organizers'] ) ) {

			$exclude_organizers = $atts['exclude-organizers'];
			$exclude_organizers = explode( ',', $exclude_organizers );

		} else {

			$exclude_organizers = "";

		}

		if( !empty( $exclude_organizers ) ) {

			$exclude_organizer_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $exclude_organizers,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $search_category ) ) {

			$include_categories = explode( ',', $search_category );

			if( !empty( $include_categories ) ) {

				$include_category_array = array(
					'taxonomy' => 'eventcat',
					'field' => 'term_id',
					'terms' => $include_categories,
					'operator' => 'IN',
				);

			}

		} else {

			if( !empty( $atts['includecategories'] ) ) {

				$include_categories = $atts['includecategories'];
				$include_categories = explode( ',', $include_categories );

			} else {

				$include_categories = "";

			}

			if( !empty( $include_categories ) ) {

				$include_category_array = array(
					'taxonomy' => 'eventcat',
					'field' => 'term_id',
					'terms' => $include_categories,
					'operator' => 'IN',
				);

			}

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $search_location ) ) {

			$include_locations = explode( ',', $search_location );

			if( !empty( $include_locations ) ) {

				$include_location_array = array(
					'taxonomy' => 'location',
					'field' => 'term_id',
					'terms' => $include_locations,
					'operator' => 'IN',
				);

			}

		} else {

			if( !empty( $atts['include-locations'] ) ) {

				$include_locations = $atts['include-locations'];
				$include_locations = explode( ',', $include_locations );

			} else {

				$include_locations = "";

			}

			if( !empty( $include_locations ) ) {

				$include_location_array = array(
					'taxonomy' => 'location',
					'field' => 'term_id',
					'terms' => $include_locations,
					'operator' => 'IN',
				);

			}

		}

		/*====== Include Organizers ======*/
		$include_organizers_array = "";

		if( !empty( $search_organizer ) ) {

			$include_organizers = explode( ',', $search_organizer );

			if( !empty( $include_organizers ) ) {

				$include_organizers_array = array(
					'taxonomy' => 'organizer',
					'field' => 'term_id',
					'terms' => $include_organizers,
					'operator' => 'IN',
				);

			}

		} else {

			if( !empty( $atts['include-organizers'] ) ) {

				$include_organizers = $atts['include-organizers'];
				$include_organizers = explode( ',', $include_organizers );

			} else {

				$include_organizers = "";

			}

			if( !empty( $include_organizers ) ) {

				$include_organizers_array = array(
					'taxonomy' => 'organizer',
					'field' => 'term_id',
					'terms' => $include_organizers,
					'operator' => 'IN',
				);

			}

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $search_tag ) ) {

			$include_tags = explode( ',', $search_tag );

			if( !empty( $include_tags ) ) {

				$include_tags_array = array(
					'taxonomy' => 'event_tags',
					'field' => 'name',
					'terms' => $include_tags,
					'operator' => 'IN',
				);

			}

		} else {

			if( !empty( $atts['include-tags'] ) ) {

				$include_tags = $atts['include-tags'];
				$include_tags = explode( ',', $include_tags );

			} else {

				$include_tags = "";

			}

			if( !empty( $include_tags ) ) {

				$include_tags_array = array(
					'taxonomy' => 'event_tags',
					'field' => 'term_id',
					'terms' => $include_tags,
					'operator' => 'IN',
				);

			}

		}

		/*====== Filtrable by Venue ======*/
		$venue_array = array();

		if( !empty( $search_venue ) ) {

			$venue_array = array(
				'key' => 'event_venue',
				'compare' => 'LIKE',
				'value' => ':' . esc_attr( $search_venue ) . ';',
			);

		}

		/*====== Filtrable by Speaker ======*/
		$speaker_array = array();

		if( !empty( $search_speaker ) ) {

			$speaker_array = array(
				'key' => 'event_speakers',
				'compare' => 'LIKE',
				'value' => ':' . esc_attr( $search_speaker ) . ';',
			);

		}

		/*====== Filter by Price ======*/
		$prices_array = array();

		if( !empty( $prices ) ) {

			if( !empty( $prices[0] ) and !empty( $prices[1] ) ) {

				$prices_array = array(
					array(
						'key' => 'event-ticket-main-price',
						'compare' => '>=',
						'value' => $prices[0],
						'type' => 'NUMERIC',
					),
					array(
						'key' => 'event-ticket-main-price',
						'compare' => '<=',
						'value' => $prices[1],
						'type' => 'NUMERIC',
					),
				);

			}

		}

		/*====== Filtrable by Start Date ======*/
		$start_date_array = array();

		if( !empty( $search_startdate ) ) {

			$start_date_array = array(
				'key' => 'event_start_date',
				'compare' => $search_startdate_compare,
				'value' => $search_startdate,
			);

		}

		/*====== Filtrable by End Date ======*/
		$end_date_array = array();

		if( !empty( $search_enddate ) ) {

			$end_date_array = array(
				'key' => 'event_end_date',
				'compare' => $search_enddate_compare,
				'value' => $search_enddate,
			);

		}

		/*====== Order by Event Date ======*/
		$order_event_start_date_array = array();

		if( $atts["order-type"] == "event-date" or $search_sort == "start-date" ) {

			$order_event_start_date_array = array(
				'relation' => 'AND',
				'event_start_date_clause' => array(
					'key' => 'event_start_date',
				), 
				'event_start_time_clause' => array(
					'key' => 'event_start_time',
				),
			);

 		}

		/*====== Order by End Date ======*/
		$order_event_end_date_array = array();

		if( $search_sort == "end-date" ) {

			$order_event_end_date_array = array(
				'relation' => 'AND',
				'event_end_date_clause' => array(
					'key' => 'event_end_date',
				), 
				'event_end_time_clause' => array(
					'key' => 'event_end_time',
				),
			);

 		}

		/*====== Filtrable by Event Status ======*/
		$status_array = array();
		$status_array_2 = array();

		if( !empty( $search_status ) ) {

			if( $search_status == "expired" ) {

				$expire_date_now = date("Y-m-d H:i");
				$status_array = array(
					'key' => 'event_expire_date',
					'compare' => '<=',
					'value' => $expire_date_now,
				);

			} else {

				$status_array = array(
					'key' => 'event_start_date',
					'compare' => $search_compare,
					'value' => $date_now,
				);
				$status_array_2 = array(
					'key' => 'event_end_date',
					'compare' => $search_compare2,
					'value' => $date_now,
				);

			}

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'event',
			'tax_query' => array (
				'relation' => 'AND',
				$include_location_array,
				$include_category_array,
				$include_organizers_array,
				$include_tags_array,
				$exclude_category_array,
				$exclude_location_array,
				$exclude_organizer_array,
				$exclude_tag_array,
			),
			'meta_query' => array(
				$status_array,
				$status_array_2,
				$start_date_array,
				$end_date_array,
				$venue_array,
				$speaker_array,
				$prices_array,
				$order_event_start_date_array,
				$order_event_end_date_array,
			),
		);

		/*====== Pagination ======*/
		$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );

		if( empty( $paged ) ) {

			$paged = 1;

		}

		if( !empty( $paged ) ) {

			$extra_query = array(
				'paged' => $paged,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Event Count ======*/
		if( !empty( $atts["eventcount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["eventcount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Event Keyword ======*/
		if( !empty( $search_keyword ) ) {

			$extra_query = array(
				's' => $search_keyword,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Events ======*/
		if( !empty( $atts['eventids'] ) ) {

			$eventids = $atts['eventids'];
			$include_events = explode( ',', $eventids );

		} else {

			$include_events = "";

		}

		if( !empty( $include_events ) ) {

			$extra_query = array(
				'post__in' => $include_events,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Events ======*/
		$excludeevents = $atts['excludeevents'];

		if( $hideexpired == "false" ) {

			if( !empty( $excludeevents ) ) {

				$exclude_events = $excludeevents;
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			if( !empty( $exclude_events ) ) {

				$extra_query = array(
					'post__not_in' => $exclude_events,
				);
				$arg = wp_parse_args( $arg, $extra_query );

			}

		}

		/*====== Add Expired Events in Exclude Events ======*/
		if( $hideexpired == "true" ) {

			$expired_ids = eventchamp_expired_event_ids();

		} else {

			$expired_ids = array();

		}

		if( !empty( $expired_ids ) ) {

			if( !empty( $excludeevents ) ) {

				$exclude_events = $excludeevents;
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			$excludeevents_with_expired = array_merge( $exclude_events, $expired_ids );

			$extra_query = array(
				'post__not_in' => $excludeevents_with_expired,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order & Order By ======*/
		if( empty( $order ) ) {

			if( $atts["order"] == "ASC" ) {

				$order = "ASC";

			} else {

				$order = "DESC";

			}

		}

		if( $search_sort == "name-za" or $search_sort == "end-date" ) {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		if( empty( $order_by ) ) {

			if( $atts["order-type"] == "popular-comment" ) {

				$order_by = "comment_count";

			} elseif( $atts["order-type"] == "id" ) {

				$order_by = "ID";

			} elseif( $atts["order-type"] == "popular" ) {

				$order_by = "comment_count";

			} elseif( $atts["order-type"] == "title" or $search_sort == "name-az" or $search_sort == "name-za" ) {

				$order_by = "title";

			} elseif( $atts["order-type"] == "menu_order" ) {

				$order_by = "menu_order";

			} elseif( $atts["order-type"] == "rand" ) {

				$order_by = "rand";

			} elseif( $atts["order-type"] == "none" ) {

				$order_by = "none";

			} elseif( $atts["order-type"] == "post__in" ) {

				$order_by = "post__in";

			} elseif( $atts["order-type"] == "added-date" or $search_sort == "added-date" ) {

				$order_by = "date";

			}

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order by Start Date ======*/
		if( $atts["order-type"] == "event-date" or $search_sort == "start-date" ) {

			$extra_query = array(
				'orderby' => array(
					'event_start_date_clause' => $order,
					'event_start_time_clause' => $order,
				),
			);
			$arg = wp_parse_args( $arg, $extra_query );

 		}

		/*====== Order by End Date ======*/
		if( $search_sort == "end-date" ) {

			$extra_query = array(
				'orderby' => array(
					'event_end_date_clause' => $order,
					'event_end_time_clause' => $order,
				),
			);
			$arg = wp_parse_args( $arg, $extra_query );

 		}

		/*====== HTML Output ======*/
		$output .= '<div class="events-list-grid eventchamp-search-results">';
			$wp_query = new WP_Query( $arg );

			if( !empty( $wp_query ) ) {

				if( $wp_query->have_posts() ) {

					$output .= '<div class="gt-columns gt-' . esc_attr( $column ) . '">';

						while( $wp_query->have_posts() ) {

							$wp_query->the_post();

							if( $atts["style"] == "style2" ) {

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status, $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
									$output .= '</div>';
								$output .= '</div>';

							} elseif( $atts["style"] == "style3" ) {

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status, $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
									$output .= '</div>';
								$output .= '</div>';

							} else {

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status, $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
									$output .= '</div>';
								$output .= '</div>';

							}
							
						}

					$output .= '</div>';

				} else {

					$output .= wpautop( esc_html__( 'There are no results that match your search.', 'eventchamp' ) );

				}

			}
			wp_reset_postdata();

			if( $atts['pagination'] == 'true' ) {

				$output .= eventchamp_element_pagination( $paged = $paged, $query = $wp_query );

			}

		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_events_search_results", "eventchamp_events_search_results_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Event Search Results', 'eventchamp' ),
				"base" => "eventchamp_events_search_results",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/event-search-results.jpg',
				"description" => esc_html__( 'Event search results element.', 'eventchamp' ),
				"params" => array(
				array(
					"type" => "textfield",
					"param_name" => "eventcount",
					"heading" => esc_html__( 'Count', 'eventchamp' ),
					"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
					"group" => esc_html__( 'General', 'eventchamp' ),
					'admin_label' => true,
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "eventids",
					"heading" => esc_html__( 'Include Events', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "excludeevents",
					"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "offset",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "dropdown",
					"param_name" => "order",
					"heading" => esc_html__( 'Default Order', 'eventchamp' ),
					"description" => esc_html__( 'You can choose an order. If you do not choose an order type on the event search tool, this option will apply.', 'eventchamp' ),
					"group" => esc_html__( 'General', 'eventchamp' ),
					"save_always" => true,
					"value" => array(
						esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "order-type",
					"heading" => esc_html__( 'Default Order Type', 'eventchamp' ),
					"description" => esc_html__( 'You can choose an order type. If you do not choose an order type on search tool this option visible.', 'eventchamp' ),
					"group" => esc_html__( 'General', 'eventchamp' ),
					"save_always" => true,
					"value" => array(
						esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
						esc_html__( 'Event Date', 'eventchamp' ) => 'event-date',
						esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
						esc_html__( 'ID', 'eventchamp' ) => 'id',
						esc_html__( 'Title', 'eventchamp' ) => 'title',
						esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
						esc_html__( 'Random', 'eventchamp' ) => 'rand',
						esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
						esc_html__( 'None', 'eventchamp' ) => 'none',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "hideexpired",
					"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
					"description" => esc_html__( 'You can hide the expired events.', 'eventchamp' ),
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "pagination",
					"heading" => esc_html__( 'Pagination', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "textfield",
					"param_name" => "excludecategories",
					"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter category ids. Example: 1,2,3 etc.', 'eventchamp' ),
					"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "exclude-locations",
					"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
					"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
					"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "exclude-organizers",
					"heading" => esc_html__( 'Exclude Organizers', 'eventchamp' ),
					"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
					"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "exclude-tags",
					"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
					"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
					"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "includecategories",
					"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter category ids. Example: 1, 2, 3 etc.', 'eventchamp' ),
					"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "include-locations",
					"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
					"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
					"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "include-organizers",
					"heading" => esc_html__( 'Include Organizers', 'eventchamp' ),
					"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
					"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"param_name" => "include-tags",
					"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
					"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
					"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					'save_always' => true,
				),
				array(
					"type" => "dropdown",
					"param_name" => "style",
					"heading" => esc_html__( 'Style', 'eventchamp' ),
					"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
						esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
						esc_html__( 'Style 3', 'eventchamp' ) => 'style3',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "column",
					"heading" => esc_html__( 'Column', 'eventchamp' ),
					"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( '1 Column', 'eventchamp' ) => 'column-1',
						esc_html__( '2 Column', 'eventchamp' ) => 'column-2',
						esc_html__( '3 Column', 'eventchamp' ) => 'column-3',
						esc_html__( '4 Column', 'eventchamp' ) => 'column-4',
						esc_html__( '5 Column', 'eventchamp' ) => 'column-5',
						esc_html__( '6 Column', 'eventchamp' ) => 'column-6',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "price",
					"heading" => esc_html__( 'Price', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the event price.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "status",
					"heading" => esc_html__( 'Status', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the event status.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "category",
					"heading" => esc_html__( 'Category', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the event category.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "location",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the event location.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "venue",
					"heading" => esc_html__( 'Venue', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the event venue.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "date",
					"heading" => esc_html__( 'Start Date', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the event start date.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "start-time",
					"heading" => esc_html__( 'Start Time', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the event start time.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "ticket-amount",
					"heading" => esc_html__( 'Ticket Amount', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the event ticket amount.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "excerpt",
					"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the event excerpt.', 'eventchamp' ),
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				),
			)
		);

	}

}



/*======
*
* Event Listing
*
======*/
if( !function_exists( 'eventchamp_events_list_grid_output' ) ) {

	function eventchamp_events_list_grid_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'eventcount' => '',
				'eventids' => '',
				'excludeevents' => '',
				'offset' => '',
				'ordertype' => '',
				'sortby' => '',
				'hideexpired' => '',
				'show-expired-events' => '',
				'pagination' => '',
				'excludecategories' => '',
				'exclude-locations' => '',
				'exclude-organizers' => '',
				'exclude-tags' => '',
				'includecategories' => '',
				'include-locations' => '',
				'include-organizers' => '',
				'include-tags' => '',
				'style' => '',
				'column' => '',
				'price' => '',
				'status' => '',
				'category' => '',
				'location' => '',
				'venue' => '',
				'date' => '',
				'start-time' => '',
				'ticket-amount' => 'false',
				'excerpt' => '',
			), $atts
		);

		$output = "";

		/*====== Column ======*/
		if( $atts["column"] ) {

			$column = esc_attr( $atts["column"] );

		} else {

			$column = "2";

		}

		/*====== Expired Events Status ======*/
		if( !empty( $atts['hideexpired'] ) ) {

			$hideexpired = esc_attr( $atts["hideexpired"] );

		} else {

			$hideexpired = "false";

		}

		/*====== Price Status ======*/
		if( $atts["price"] == "true" ) {

			$price_status = "true";

		} else {

			$price_status = "false";

		}

		/*====== Status Status ======*/
		if( $atts["status"] == "true" ) {

			$status_status = "true";

		} else {

			$status_status = "false";

		}

		/*====== Category Status ======*/
		if( $atts["category"] == "true" ) {

			$category_status = "true";

		} else {

			$category_status = "false";

		}

		/*====== Location Status ======*/
		if( $atts["location"] == "true" ) {

			$location_status = "true";

		} else {

			$location_status = "false";

		}

		/*====== Venue Status ======*/
		if( $atts["venue"] == "true" ) {

			$venue_status = "true";

		} else {

			$venue_status = "false";

		}

		/*====== Ticket Amount Status ======*/
		if( $atts["ticket-amount"] == "true" ) {

			$ticket_amount_status = "true";

		} else {

			$ticket_amount_status = "false";

		}

		/*====== Date Status ======*/
		if( $atts["date"] == "true" ) {

			$date_status = "true";

		} else {

			$date_status = "false";

		}

		/*====== Start Time Status ======*/
		if( $atts["start-time"] == "true" ) {

			$start_time_status = "true";

		} else {

			$start_time_status = "false";

		}

		/*====== Excerpt Status ======*/
		if( $atts["excerpt"] == "true" ) {

			$excerpt_status = "true";

		} else {

			$excerpt_status = "false";

		}

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['excludecategories'] ) ) {

			$exclude_categories = $atts['excludecategories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Organizers ======*/
		$exclude_organizer_array = "";

		if( !empty( $atts['exclude-organizers'] ) ) {

			$exclude_organizers = $atts['exclude-organizers'];
			$exclude_organizers = explode( ',', $exclude_organizers );

		} else {

			$exclude_organizers = "";

		}

		if( !empty( $exclude_organizers ) ) {

			$exclude_organizer_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $exclude_organizers,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $atts['includecategories'] ) ) {

			$include_categories = $atts['includecategories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		if( !empty( $include_categories ) ) {

			$include_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $include_categories,
				'operator' => 'IN',
			);

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		if( !empty( $include_locations ) ) {

			$include_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $include_locations,
				'operator' => 'IN',
			);

		}

		/*====== Include Organizers ======*/
		$include_organizers_array = "";

		if( !empty( $atts['include-organizers'] ) ) {

			$include_organizers = $atts['include-organizers'];
			$include_organizers = explode( ',', $include_organizers );

		} else {

			$include_organizers = "";

		}

		if( !empty( $include_organizers ) ) {

			$include_organizers_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $include_organizers,
				'operator' => 'IN',
			);

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		if( !empty( $include_tags ) ) {

			$include_tags_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $include_tags,
				'operator' => 'IN',
			);

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'event',
			'tax_query' => array (
				'relation' => 'AND',
				$include_location_array,
				$include_category_array,
				$include_organizers_array,
				$include_tags_array,
				$exclude_category_array,
				$exclude_location_array,
				$exclude_organizer_array,
				$exclude_tag_array,
			)
		);

		/*====== Pagination ======*/
		$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );

		if( empty( $paged ) ) {

			$paged = 1;

		}

		if( !empty( $paged ) ) {

			$extra_query = array(
				'paged' => $paged,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Event Count ======*/
		if( !empty( $atts["eventcount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["eventcount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Events ======*/
		if( !empty( $atts['eventids'] ) ) {

			$eventids = $atts['eventids'];
			$include_events = explode( ',', $eventids );

		} else {

			$include_events = "";

		}

		if( !empty( $include_events ) ) {

			$extra_query = array(
				'post__in' => $include_events,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Events ======*/
		$excludeevents = $atts['excludeevents'];

		if( $hideexpired == "false" ) {

			if( !empty( $excludeevents ) ) {

				$exclude_events = $excludeevents;
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			if( !empty( $exclude_events ) ) {

				$extra_query = array(
					'post__not_in' => $exclude_events,
				);
				$arg = wp_parse_args( $arg, $extra_query );

			}

		}

		/*====== Add Expired Events in Exclude Events ======*/
		if( $hideexpired == "true" ) {

			$expired_ids = eventchamp_expired_event_ids();

		} else {

			$expired_ids = array();

		}

		if( !empty( $expired_ids ) ) {

			$excludeevents = $atts['excludeevents'];

			if( !empty( $excludeevents ) ) {

				$exclude_events = $excludeevents;
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			$excludeevents_with_expired = array_merge( $exclude_events, $expired_ids );

			$extra_query = array(
				'post__not_in' => $excludeevents_with_expired,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Show Expired Events ======*/
		if( $atts["show-expired-events"] == "true" ) {

			$expired_events = eventchamp_expired_event_ids();

			$extra_query = array(
				'post__in' => $expired_events,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order & Order By ======*/
		if( $atts["ordertype"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		if( $atts["sortby"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["sortby"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["sortby"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["sortby"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["sortby"] == "none" ) {

			$order_by = "none";

		} elseif( $atts["sortby"] == "post__in" ) {

			$order_by = "post__in";

		} elseif( $atts["sortby"] == "event-date" ) {

			$order_by = "";

			$extra_query = array(
				'meta_query' => array(
					'relation' => 'AND',
					'event_start_date_clause' => array(
						'key' => 'event_start_date',
					), 
					'event_start_time_clause' => array(
						'key' => 'event_start_time',
					),
				),
				'orderby' => array(
					'event_start_date_clause' => $order,
					'event_start_time_clause' => $order,
				),
			);
			$arg = wp_parse_args( $arg, $extra_query );

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== HTML Output ======*/
		$output .= '<div class="gt-event-listing">';

			$wp_query = new WP_Query( $arg );

			if( !empty( $wp_query ) ) {

				$output .= '<div class="gt-columns gt-column-' . esc_attr( $column ) . '">';

					while( $wp_query->have_posts() ) {

						$wp_query->the_post();

						if( $atts["style"] == "style2" ) {

							$output .= '<div class="gt-col">';
								$output .= '<div class="gt-inner">';
									$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status, $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
								$output .= '</div>';
							$output .= '</div>';

						} elseif( $atts["style"] == "style3" ) {

							$output .= '<div class="gt-col">';
								$output .= '<div class="gt-inner">';
									$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status, $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
								$output .= '</div>';
							$output .= '</div>';

						} else {

							$output .= '<div class="gt-col">';
								$output .= '<div class="gt-inner">';
									$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status, $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
								$output .= '</div>';
							$output .= '</div>';

						}

					}

				$output .= '</div>';

			}
			wp_reset_postdata();

			if( $atts['pagination'] == 'true' ) {

				$output .= eventchamp_element_pagination( $paged = $paged, $query = $wp_query );

			}

		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_events_list_grid", "eventchamp_events_list_grid_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Event Listing', 'eventchamp' ),
				"base" => "eventchamp_events_list_grid",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/event-listing.jpg',
				"description" => esc_html__( 'Event listing element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "eventcount",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "eventids",
						"heading" => esc_html__( 'Include Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "excludeevents",
						"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "ordertype",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sortby",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Event Date', 'eventchamp' ) => 'event-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hideexpired",
						"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'You can hide the expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "show-expired-events",
						"heading" => esc_html__( 'Show Only Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'If you choose this option, you can list expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "pagination",
						"heading" => esc_html__( 'Pagination', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "excludecategories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-organizers",
						"heading" => esc_html__( 'Exclude Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "includecategories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-organizers",
						"heading" => esc_html__( 'Include Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style3',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "price",
						"heading" => esc_html__( 'Price', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event price.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "status",
						"heading" => esc_html__( 'Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event status.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "category",
						"heading" => esc_html__( 'Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event category.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "location",
						"heading" => esc_html__( 'Location', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event location.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "venue",
						"heading" => esc_html__( 'Venue', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event venue.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "date",
						"heading" => esc_html__( 'Start Date', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event start date.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "start-time",
						"heading" => esc_html__( 'Start Time', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event start time.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "ticket-amount",
						"heading" => esc_html__( 'Ticket Amount', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event ticket amount.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "excerpt",
						"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Categorized Events
*
======*/
if( !function_exists( 'eventchamp_categorized_events_output' ) ) {

	function eventchamp_categorized_events_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'eventcount' => '',
				'excludeevents' => '',
				'offset' => '',
				'sortby' => '',
				'ordertype' => '',
				'hideexpired' => '',
				'show-expired-events' => '',
				'excludecategories' => '',
				'exclude-locations' => '',
				'exclude-organizers' => '',
				'exclude-tags' => '',
				'includecategories' => '',
				'include-locations' => '',
				'include-organizers' => '',
				'include-tags' => '',
				'taxonomy-order' => '',
				'taxonomy-order-type' => '',
				'empty-taxonomies' => '',
				'childless' => '',
				'cat-list-align' => '',
				'style' => '',
				'column' => '',
				'alleventstab' => '',
				'allbutton' => '',
				'price' => '',
				'status' => '',
				'category' => '',
				'location' => '',
				'venue' => '',
				'date' => '',
				'start-time' => '',
				'ticket-amount' => 'false',
				'excerpt' => '',
			), $atts
		);

		$output = "";

		/*====== Expired Events Status ======*/
		if( !empty( $atts["hideexpired"] ) ) {

			$hideexpired = esc_attr( $atts["hideexpired"] );

		} else {

			$hideexpired = "false";

		}

		/*====== Column ======*/
		if( !empty( $atts["column"] ) ) {

			$column = esc_attr( $atts["column"] );

		} else {

			$column = "column-1";

		}

		/*====== Category List Align ======*/
		if( !empty( $atts['cat-list-align'] ) ) {

			$cat_list_align = esc_attr( $atts['cat-list-align'] );

		} else {

			$cat_list_align = "center";

		}

		/*====== Taxonomy Order ======*/
		if( empty( $atts["taxonomy-order"] ) ) {

			$atts["taxonomy-order"] = "ASC";

		}

		/*====== Taxonomy Order Type ======*/
		if( empty( $atts["taxonomy-order-type"] ) ) {

			$atts["taxonomy-order-type"] = "name";

		}

		/*====== Empty Categories ======*/
		if( $atts['empty-taxonomies'] == 'false' ) {

			$empty_taxonomies = false;

		} else {

			$empty_taxonomies = true;

		}

		/*====== Childless ======*/
		if( $atts['childless'] == 'false' ) {

			$childless = false;

		} else {

			$childless = true;

		}

		/*====== Price Status ======*/
		if( $atts["price"] == "true" ) {

			$price_status = "true";

		} else {

			$price_status = "false";

		}

		/*====== Status Status ======*/
		if( $atts["status"] == "true" ) {

			$status_status = "true";

		} else {

			$status_status = "false";

		}

		/*====== Category Status ======*/
		if( $atts["category"] == "true" ) {

			$category_status = "true";

		} else {

			$category_status = "false";

		}

		/*====== Location Status ======*/
		if( $atts["location"] == "true" ) {

			$location_status = "true";

		} else {

			$location_status = "false";

		}

		/*====== Venue Status ======*/
		if( $atts["venue"] == "true" ) {

			$venue_status = "true";

		} else {

			$venue_status = "false";

		}

		/*====== Ticket Amount Status ======*/
		if( $atts["ticket-amount"] == "true" ) {

			$ticket_amount_status = "true";

		} else {

			$ticket_amount_status = "false";

		}

		/*====== Date Status ======*/
		if( $atts["date"] == "true" ) {

			$date_status = "true";

		} else {

			$date_status = "false";

		}

		/*====== Start Time Status ======*/
		if( $atts["start-time"] == "true" ) {

			$start_time_status = "true";

		} else {

			$start_time_status = "false";

		}

		/*====== Excerpt Status ======*/
		if( $atts["excerpt"] == "true" ) {

			$excerpt_status = "true";

		} else {

			$excerpt_status = "false";

		}

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['excludecategories'] ) ) {

			$exclude_categories = $atts['excludecategories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Organizers ======*/
		$exclude_organizer_array = "";

		if( !empty( $atts['exclude-organizers'] ) ) {

			$exclude_organizers = $atts['exclude-organizers'];
			$exclude_organizers = explode( ',', $exclude_organizers );

		} else {

			$exclude_organizers = "";

		}

		if( !empty( $exclude_organizers ) ) {

			$exclude_organizer_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $exclude_organizers,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $atts['includecategories'] ) ) {

			$include_categories = $atts['includecategories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		if( !empty( $include_categories ) ) {

			$include_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $include_categories,
				'operator' => 'IN',
			);

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		if( !empty( $include_locations ) ) {

			$include_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $include_locations,
				'operator' => 'IN',
			);

		}

		/*====== Include Organizers ======*/
		$include_organizers_array = "";

		if( !empty( $atts['include-organizers'] ) ) {

			$include_organizers = $atts['include-organizers'];
			$include_organizers = explode( ',', $include_organizers );

		} else {

			$include_organizers = "";

		}

		if( !empty( $include_organizers ) ) {

			$include_organizers_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $include_organizers,
				'operator' => 'IN',
			);

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		if( !empty( $include_tags ) ) {

			$include_tags_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $include_tags,
				'operator' => 'IN',
			);

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'event',
			'tax_query' => array (
				'relation' => 'AND',
				$include_location_array,
				$include_category_array,
				$include_organizers_array,
				$include_tags_array,
				$exclude_category_array,
				$exclude_location_array,
				$exclude_organizer_array,
				$exclude_tag_array,
			)
		);

		$tab_arg = array(
			'post_status' => 'publish',
			'post_type' => 'event',
		);

		/*====== Event Count ======*/
		if( !empty( $atts["eventcount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["eventcount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Exclude Events ======*/
		$excludeevents = $atts['excludeevents'];

		if( $hideexpired == "false" ) {

			if( !empty( $excludeevents ) ) {

				$exclude_events = $excludeevents;
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			if( !empty( $exclude_events ) ) {

				$extra_query = array(
					'post__not_in' => $exclude_events,
				);
				$arg = wp_parse_args( $arg, $extra_query );
				$tab_arg = wp_parse_args( $tab_arg, $extra_query );

			}

		}

		/*====== Add Expired Events in Exclude Events ======*/
		if( $hideexpired == "true" ) {

			$expired_ids = eventchamp_expired_event_ids();

		} else {

			$expired_ids = array();

		}

		if( !empty( $expired_ids ) ) {

			if( !empty( $excludeevents ) ) {

				$exclude_events = $excludeevents;
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			$excludeevents_with_expired = array_merge( $exclude_events, $expired_ids );

			$extra_query = array(
				'post__not_in' => $excludeevents_with_expired,
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Show Expired Events ======*/
		if( $atts["show-expired-events"] == "true" ) {

			$expired_events = eventchamp_expired_event_ids();

			$extra_query = array(
				'post__in' => $expired_events,
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Order & Order By ======*/
		if( $atts["ordertype"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		if( $atts["sortby"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["sortby"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["sortby"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["sortby"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["sortby"] == "none" ) {

			$order_by = "none";

		} elseif( $atts["sortby"] == "post__in" ) {

			$order_by = "post__in";

		} elseif( $atts["sortby"] == "event-date" ) {

			$order_by = "";

			$extra_query = array(
				'meta_query' => array(
					'relation' => 'AND',
					'event_start_date_clause' => array(
						'key' => 'event_start_date',
					), 
					'event_start_time_clause' => array(
						'key' => 'event_start_time',
					),
				),
				'orderby' => array(
					'event_start_date_clause' => $order,
					'event_start_time_clause' => $order,
				),
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Get Terms ======*/
		$eventcat_terms = get_terms(
			array(
				'taxonomy' => 'eventcat',
				'order' => $atts["taxonomy-order"],
				'orderby' => $atts["taxonomy-order-type"],
				'exclude' => $exclude_categories,
				'include' => $include_categories,
				'hide_empty' => $empty_taxonomies,
				'childless' => $childless,
			)
		);

		/*====== HTML Output ======*/
		if( ! empty( $eventcat_terms ) && ! is_wp_error( $eventcat_terms ) ) {

			$output .= '<div class="gt-categorized-contents gt-tab-panel">';
				$output .= '<ul class="nav gt-nav gt-' . esc_attr( $cat_list_align ) . '" role="tablist">';

					if( $atts["alleventstab"] == "true" ) {

						$output .= '<li>';
							$output .= '<a href="#categorized-events-all" aria-controls="categorized-events-all" role="tab" data-toggle="tab" class="active">' . esc_html__( 'All', 'eventchamp' ) . '</a>';
						$output .= '</li>';

					}

					$i = 0;

					foreach ( $eventcat_terms as $eventcat_term ) {

						if( !empty( $eventcat_term ) ) {

							$i++;

							$output .= '<li>';
								$output .= '<a href="#categorized-events-' . esc_attr( $eventcat_term->slug ) . '-' . esc_attr( $i ) . '" aria-controls="categorized-events-' . esc_attr( $eventcat_term->slug ) . '" role="tab" data-toggle="tab"' . ( $i == '1' && $atts["alleventstab"] == "false" ? ' class="active"' : '' )  . '>' . esc_attr( $eventcat_term->name ) . '</a>';
							$output .= '</li>';

						}

					}

				$output .= '</ul>';

				$output .= '<div class="tab-content">';

					if( $atts["alleventstab"] == "true" ) {

						$output .= '<div role="tabpanel" class="tab-pane fade active show" aria-labelledby="categorized-events-all" id="categorized-events-all">';

							$wp_query = new WP_Query( $arg );

							if( !empty( $wp_query ) ) {

								$output .= '<div class="gt-columns gt-' . esc_attr( $column ) . '">';

									while( $wp_query->have_posts() ) {

										$wp_query->the_post();

										if( $atts["style"] == "style2" ) {

											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';
													$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status,  $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
												$output .= '</div>';
											$output .= '</div>';

										} elseif( $atts["style"] == "style3" ) {

											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';
													$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status,  $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
												$output .= '</div>';
											$output .= '</div>';

										} else {

											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';
													$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status,  $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
												$output .= '</div>';
											$output .= '</div>';

										}

									}
									wp_reset_postdata();

								$output .= '</div>';

							}

							if( $atts["allbutton"] == "true" ) {

								$output .= '<div class="gt-pagination">';
									$output .= '<a href="' . esc_url( get_post_type_archive_link( 'event' ) ) . '" class="gt-all-button">' . esc_html__( 'All Events', 'eventchamp' ) . '</a>';
								$output .= '</div>';

							}

						$output .= '</div>';
 
					}

					$i = 0;

					foreach ( $eventcat_terms as $eventcat_term ) {

						if( !empty( $eventcat_term ) ) {

							$i++;

							$output .= '<div role="tabpanel" class="tab-pane fade' . ( $i == "1" && $atts["alleventstab"] == "false" ? ' active show' : '' )  . '" id="categorized-events-' . esc_attr( $eventcat_term->slug ) . '-' . esc_attr( $i ) . '" aria-labelledby="categorized-events-' . esc_attr( $eventcat_term->slug ) . '">';

								$tax_extra_query = array(
									'tax_query' => array(
										'relation' => 'AND',
										$include_location_array,
										$include_category_array,
										$include_organizers_array,
										$include_tags_array,
										$exclude_location_array,
										$exclude_organizer_array,
										$exclude_tag_array,
										array(
											'taxonomy' => 'eventcat',
											'field' => 'slug',
											'terms' => array( $eventcat_term->slug ),
										),
									),
								);

								$tab_arg_tab = wp_parse_args( $tab_arg, $tax_extra_query );

								$wp_query_tab = new WP_Query( $tab_arg_tab );

								if( !empty( $wp_query_tab ) ) {

									$output .= '<div class="gt-columns gt-' . esc_attr( $column ) . '">';

										while( $wp_query_tab->have_posts() ) {

											$wp_query_tab->the_post();

											if( $atts["style"] == "style2" ) {

												$output .= '<div class="gt-col">';
													$output .= '<div class="gt-inner">';
														$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status,  $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
													$output .= '</div>';
												$output .= '</div>';

											} elseif( $atts["style"] == "style3" ) {

												$output .= '<div class="gt-col">';
													$output .= '<div class="gt-inner">';
														$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status,  $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
													$output .= '</div>';
												$output .= '</div>';

											} else {

												$output .= '<div class="gt-col">';
													$output .= '<div class="gt-inner">';
														$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status,  $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );
													$output .= '</div>';
												$output .= '</div>';

											}

										}

									$output .= '</div>';

									if( $atts["allbutton"] == "true" ) {

										$output .= '<div class="gt-pagination">';
											$output .= '<a href="' . esc_url( get_term_link( $eventcat_term->term_id ) . '?post_type=event' ) . '" class="gt-all-button">';
												$output .= sprintf( esc_html__( 'All %1$s Events', 'eventchamp' ), esc_attr( $eventcat_term->name ) );
											$output .= '</a>';
										$output .= '</div>';

									}

								}
								wp_reset_postdata();

							$output .= '</div>';

						}

					}

				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_categorized_events", "eventchamp_categorized_events_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Categorized Events', 'eventchamp' ),
				"base" => "eventchamp_categorized_events",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/categorized-events.jpg',
				"description" => esc_html__( 'Categorized events element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "eventcount",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an event count for each tab.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "excludeevents",
						"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "ordertype",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sortby",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Event Date', 'eventchamp' ) => 'event-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hideexpired",
						"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'You can hide the expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "show-expired-events",
						"heading" => esc_html__( 'Show Only Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'If you choose this option, you can list expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "excludecategories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-organizers",
						"heading" => esc_html__( 'Exclude Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "includecategories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-organizers",
						"heading" => esc_html__( 'Include Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "taxonomy-order",
						"heading" => esc_html__( 'Taxonomy Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "taxonomy-order-type",
						"heading" => esc_html__( 'Taxonomy Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Name', 'eventchamp' ) => 'name',
							esc_html__( 'Slug', 'eventchamp' ) => 'slug',
							esc_html__( 'Term Group', 'eventchamp' ) => 'term_group',
							esc_html__( 'Term ID', 'eventchamp' ) => 'term_id',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Description', 'eventchamp' ) => 'description',
							esc_html__( 'Parent', 'eventchamp' ) => 'parent',
							esc_html__( 'Count', 'eventchamp' ) => 'count',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "empty-taxonomies",
						"heading" => esc_html__( 'Hide Empty Taxonomies', 'eventchamp' ),
						"description" => esc_html__( 'You can choose visible status of the empty taxonomies. If you choose true option empty taxonomies will be hide.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "childless",
						"heading" => esc_html__( 'Childless', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the childless taxonomies.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "cat-list-align",
						"heading" => esc_html__( 'Category List Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose align of the category list.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style3',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => 'column-1',
							esc_html__( '2 Column', 'eventchamp' ) => 'column-2',
							esc_html__( '3 Column', 'eventchamp' ) => 'column-3',
							esc_html__( '4 Column', 'eventchamp' ) => 'column-4',
							esc_html__( '5 Column', 'eventchamp' ) => 'column-5',
							esc_html__( '6 Column', 'eventchamp' ) => 'column-6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "alleventstab",
						"heading" => esc_html__( 'All Events Tab', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the all events tab.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "allbutton",
						"heading" => esc_html__( 'All Events Button', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the all events button.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "price",
						"heading" => esc_html__( 'Price', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event price.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "status",
						"heading" => esc_html__( 'Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event status.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "category",
						"heading" => esc_html__( 'Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event category.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "location",
						"heading" => esc_html__( 'Location', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event location.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "venue",
						"heading" => esc_html__( 'Venue', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event venue.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "date",
						"heading" => esc_html__( 'Start Date', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event start date.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "start-time",
						"heading" => esc_html__( 'Start Time', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event start time.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "ticket-amount",
						"heading" => esc_html__( 'Ticket Amount', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the ticket amount.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "excerpt",
						"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Events Carousel
*
======*/
if( !function_exists( 'eventchamp_events_list_output' ) ) {

	function eventchamp_events_list_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'eventcount' => '',
				'eventids' => '',
				'excludeevents' => '',
				'offset' => '',
				'ordertype' => '',
				'sortby' => '',
				'hideexpired' => '',
				'show-expired-events' => '',
				'excludecategories' => '',
				'exclude-locations' => '',
				'exclude-organizers' => '',
				'exclude-tags' => '',
				'includecategories' => '',
				'include-locations' => '',
				'include-organizers' => '',
				'include-tags' => '',
				'style' => '',
				'allbutton' => '',
				'price' => '',
				'status' => '',
				'category' => '',
				'location' => '',
				'venue' => '',
				'date' => '',
				'start-time' => '',
				'ticket-amount' => '',
				'excerpt' => '',
				'column' => '',
				'slider-space' => '',
				'autoplay' => '',
				'slider-autoplay-delay' => '',
				'loopstatus' => '',
				'slider-slide-speed' => '',
				'slider-centered-slides' => '',
				'slider-direction' => '',
				'slider-effect' => '',
				'slider-free-mode' => '',
				'navbuttons' => '',
			), $atts
		);

		$output = "";

		/*====== Expired Events Status ======*/
		if( !empty( $atts['hideexpired'] ) ) {

			$hideexpired = esc_attr( $atts["hideexpired"] );

		} else {

			$hideexpired = "false";

		}

		/*====== Style ======*/
		if( !empty( $atts['style'] ) ) {

			$style = esc_attr( $atts["style"] );

		} else {

			$style = "style1";

		}

		/*====== Column ======*/
		if( empty( $atts["column"] ) ) {

			$atts["column"] = "1";

		}

		/*====== Column Space ======*/
		if( empty( $atts["slider-space"] ) ) {

			$atts["slider-space"] = "0";

		}

		/*====== Price Status ======*/
		if( $atts["price"] == "true" ) {

			$price_status = "true";

		} else {

			$price_status = "false";

		}

		/*====== Status Status ======*/
		if( $atts["status"] == "true" ) {

			$status_status = "true";

		} else {

			$status_status = "false";

		}

		/*====== Category Status ======*/
		if( $atts["category"] == "true" ) {

			$category_status = "true";

		} else {

			$category_status = "false";

		}

		/*====== Location Status ======*/
		if( $atts["location"] == "true" ) {

			$location_status = "true";

		} else {

			$location_status = "false";

		}

		/*====== Venue Status ======*/
		if( $atts["venue"] == "true" ) {

			$venue_status = "true";

		} else {

			$venue_status = "false";

		}

		/*====== Ticket Amount Status ======*/
		if( $atts["ticket-amount"] == "true" ) {

			$ticket_amount_status = "true";

		} else {

			$ticket_amount_status = "false";

		}

		/*====== Date Status ======*/
		if( $atts["date"] == "true" ) {

			$date_status = "true";

		} else {

			$date_status = "false";

		}

		/*====== Start Time Status ======*/
		if( $atts["start-time"] == "true" ) {

			$start_time_status = "true";

		} else {

			$start_time_status = "false";

		}

		/*====== Column Space ======*/
		if( empty( $atts["slider-space"] ) ) {

			$atts["slider-space"] = "30";

		}

		/*====== Slider Autoplay ======*/
		if( empty( $atts["autoplay"] ) ) {

			$atts["autoplay"] = "false";

		}

		/*====== Slider Autoplay Delay ======*/
		if( empty( $atts["slider-autoplay-delay"] ) ) {

			$atts["slider-autoplay-delay"] = "15000";

		}

		/*====== Slider Loop ======*/
		if( empty( $atts["loopstatus"] ) ) {

			$atts["loopstatus"] = "false";

		}

		/*====== Slider Slide Speed ======*/
		if( empty( $atts["slider-slide-speed"] ) ) {

			$atts["slider-slide-speed"] = "1000";

		}

		/*====== Centered Slides ======*/
		if( empty( $atts["slider-centered-slides"] ) ) {

			$atts["slider-centered-slides"] = "false";

		}

		/*====== Slider Direction ======*/
		if( empty( $atts["slider-direction"] ) ) {

			$atts["slider-direction"] = "horizontal";

		}

		/*====== Slider Effect ======*/
		if( empty( $atts["slider-effect"] ) ) {

			$atts["slider-effect"] = "slide";

		}

		/*====== Slider Free Mode ======*/
		if( empty( $atts["slider-free-mode"] ) ) {

			$atts["slider-free-mode"] = "false";

		}

		/*====== Navigation ======*/
		if( empty( $atts["navbuttons"] ) ) {

			$atts["navbuttons"] = "false";

		}

		/*====== Excerpt Status ======*/
		if( $atts["excerpt"] == "true" ) {

			$excerpt_status = "true";

		} else {

			$excerpt_status = "false";

		}

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['excludecategories'] ) ) {

			$exclude_categories = $atts['excludecategories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Organizers ======*/
		$exclude_organizer_array = "";

		if( !empty( $atts['exclude-organizers'] ) ) {

			$exclude_organizers = $atts['exclude-organizers'];
			$exclude_organizers = explode( ',', $exclude_organizers );

		} else {

			$exclude_organizers = "";

		}

		if( !empty( $exclude_organizers ) ) {

			$exclude_organizer_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $exclude_organizers,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $atts['includecategories'] ) ) {

			$include_categories = $atts['includecategories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		if( !empty( $include_categories ) ) {

			$include_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $include_categories,
				'operator' => 'IN',
			);

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		if( !empty( $include_locations ) ) {

			$include_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $include_locations,
				'operator' => 'IN',
			);

		}

		/*====== Include Organizers ======*/
		$include_organizers_array = "";

		if( !empty( $atts['include-organizers'] ) ) {

			$include_organizers = $atts['include-organizers'];
			$include_organizers = explode( ',', $include_organizers );

		} else {

			$include_organizers = "";

		}

		if( !empty( $include_organizers ) ) {

			$include_organizers_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $include_organizers,
				'operator' => 'IN',
			);

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		if( !empty( $include_tags ) ) {

			$include_tags_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $include_tags,
				'operator' => 'IN',
			);

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'event',
			'tax_query' => array (
				'relation' => 'AND',
				$include_location_array,
				$include_category_array,
				$include_organizers_array,
				$include_tags_array,
				$exclude_category_array,
				$exclude_location_array,
				$exclude_organizer_array,
				$exclude_tag_array,
			)
		);

		/*====== Event Count ======*/
		if( !empty( $atts["eventcount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["eventcount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Events ======*/
		if( !empty( $atts['eventids'] ) ) {

			$eventids = $atts['eventids'];
			$include_events = explode( ',', $eventids );

		} else {

			$include_events = "";

		}

		if( !empty( $include_events ) ) {

			$extra_query = array(
				'post__in' => $include_events,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Events ======*/
		$excludeevents = $atts['excludeevents'];

		if( $hideexpired == "false" ) {

			if( !empty( $excludeevents ) ) {

				$exclude_events = $excludeevents;
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			if( !empty( $exclude_events ) ) {

				$extra_query = array(
					'post__not_in' => $exclude_events,
				);
				$arg = wp_parse_args( $arg, $extra_query );

			}

		}

		/*====== Add Expired Events in Exclude Events ======*/
		if( $hideexpired == "true" ) {

			$expired_ids = eventchamp_expired_event_ids();

		} else {

			$expired_ids = array();

		}

		if( !empty( $expired_ids ) ) {

			$excludeevents = $atts['excludeevents'];

			if( !empty( $excludeevents ) ) {

				$exclude_events = $excludeevents;
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			$excludeevents_with_expired = array_merge( $exclude_events, $expired_ids );

			$extra_query = array(
				'post__not_in' => $excludeevents_with_expired,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Show Expired Events ======*/
		if( $atts["show-expired-events"] == "true" ) {

			$expired_events = eventchamp_expired_event_ids();

			$extra_query = array(
				'post__in' => $expired_events,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order & Order By ======*/
		if( $atts["ordertype"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		if( $atts["sortby"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["sortby"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["sortby"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["sortby"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["sortby"] == "none" ) {

			$order_by = "none";

		} elseif( $atts["sortby"] == "post__in" ) {

			$order_by = "post__in";

		} elseif( $atts["sortby"] == "event-date" ) {

			$order_by = "";

			$extra_query = array(
				'meta_query' => array(
					'relation' => 'AND',
					'event_start_date_clause' => array(
						'key' => 'event_start_date',
					), 
					'event_start_time_clause' => array(
						'key' => 'event_start_time',
					),
				),
				'orderby' => array(
					'event_start_date_clause' => $order,
					'event_start_time_clause' => $order,
				),
			);
			$arg = wp_parse_args( $arg, $extra_query );

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== HTML Output ======*/
		$output .= '<div class="gt-events-carousel">';

			$wp_query = new WP_Query( $arg );

			if( !empty( $wp_query ) ) {

				$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item="' . esc_attr( $atts["column"] ) . '" data-gt-item-space="' . esc_attr( $atts["slider-space"] ) . '" data-gt-loop="' . esc_attr( $atts["loopstatus"] ) . '" data-gt-speed="' . esc_attr( $atts["slider-slide-speed"] ) . '" data-gt-direction="' . esc_attr( $atts["slider-direction"] ) . '" data-gt-effect="' . esc_attr( $atts["slider-effect"] ) . '" data-gt-centered-slides="' . esc_attr( $atts["slider-centered-slides"] ) . '" data-gt-free-mode="' . esc_attr( $atts["slider-free-mode"] ) . '">';
					$output .= '<div class="swiper-wrapper">';

						while( $wp_query->have_posts() ) {

							$wp_query->the_post();

							if( $atts["autoplay"] == "true" ) {

								$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $atts["slider-autoplay-delay"] ) . '">';

							} else {

								$output .= '<div class="swiper-slide">';

							}

								if( $style == "style2" ) {

									$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status, $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );

								} elseif( $style == "style3" ) {

									$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status, $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );

								} else {

									$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status, $venue = $venue_status, $ticket_amount = $ticket_amount_status, $time = $start_time_status );

								}

							$output .= '</div>';

						}

					$output .= '</div>';

					$output .= '<div class="gt-pagination">';

						if( $atts["navbuttons"] == "true" ) {

							$output .= '<div class="gt-slider-prev">';
								$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
							$output .= '</div>';

						}

						if( $atts["allbutton"] == "true" ) {

							$output .= '<div>';
								$output .= '<a href="' . esc_url( get_post_type_archive_link( 'event' ) ) . '" class="gt-all-button">' . esc_html__( 'All Events', 'eventchamp' ) . '</a>';
							$output .= '</div>';

						}

						if( $atts["navbuttons"] == "true" ) {

							$output .= '<div class="gt-slider-next">';
								$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
							$output .= '</div>';

						}

					$output .= '</div>';

				$output .= '</div>';

			}
			wp_reset_postdata();

		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_events_list", "eventchamp_events_list_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Events Carousel', 'eventchamp' ),
				"base" => "eventchamp_events_list",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/events-carousel.jpg',
				"description" => esc_html__( 'Events carousel element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "eventcount",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "eventids",
						"heading" => esc_html__( 'Include Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "excludeevents",
						"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "ordertype",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sortby",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Event Date', 'eventchamp' ) => 'event-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hideexpired",
						"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'You can hide the expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "show-expired-events",
						"heading" => esc_html__( 'Show Only Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'If you choose this option, you can list expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "excludecategories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"param_name" => "exclude-locations",
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-organizers",
						"heading" => esc_html__( 'Exclude Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "includecategories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-organizers",
						"heading" => esc_html__( 'Include Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style3',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "allbutton",
						"heading" => esc_html__( 'All Events Button', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the all events button.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "price",
						"heading" => esc_html__( 'Price', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event price.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "status",
						"heading" => esc_html__( 'Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event status.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "category",
						"heading" => esc_html__( 'Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event category.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "location",
						"heading" => esc_html__( 'Location', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event location.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "venue",
						"heading" => esc_html__( 'Venue', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event venue.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "date",
						"heading" => esc_html__( 'Start Date', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event start date.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "start-time",
						"heading" => esc_html__( 'Start Time', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event start time.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "ticket-amount",
						"heading" => esc_html__( 'Ticket Amount', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the ticket amount.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "excerpt",
						"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-space",
						"heading" => esc_html__( 'Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a space value for space between the slides.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0px', 'eventchamp' ) => '0',
							esc_html__( '1px', 'eventchamp' ) => '1',
							esc_html__( '2px', 'eventchamp' ) => '2',
							esc_html__( '3px', 'eventchamp' ) => '3',
							esc_html__( '4px', 'eventchamp' ) => '4',
							esc_html__( '5px', 'eventchamp' ) => '5',
							esc_html__( '10px', 'eventchamp' ) => '10',
							esc_html__( '15px', 'eventchamp' ) => '15',
							esc_html__( '20px', 'eventchamp' ) => '20',
							esc_html__( '25px', 'eventchamp' ) => '25',
							esc_html__( '30px', 'eventchamp' ) => '30',
							esc_html__( '45px', 'eventchamp' ) => '45',
							esc_html__( '50px', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "autoplay",
						"heading" => esc_html__( 'Slider Autoplay', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the autoplay.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-autoplay-delay",
						"heading" => esc_html__( 'Slider Autoplay Delay', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an autoplay delay value. Default: 15000', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "loopstatus",
						"heading" => esc_html__( 'Slider Loop', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the loop.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-slide-speed",
						"heading" => esc_html__( 'Slide Speed', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a slide speed. Duration of transition between the slides. Default: 1500', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-centered-slides",
						"heading" => esc_html__( 'Centered Slides', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the centered slides. If you choose true, then active slide will be centered, not always on the left side.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-direction",
						"heading" => esc_html__( 'Slider Direction', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a direction.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Horizontal', 'eventchamp' ) => 'horizontal',
							esc_html__( 'Vertical', 'eventchamp' ) => 'vertical',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-effect",
						"heading" => esc_html__( 'Slider Effect', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an effect.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Slide', 'eventchamp' ) => 'slide',
							esc_html__( 'Fade', 'eventchamp' ) => 'fade',
							esc_html__( 'Cube', 'eventchamp' ) => 'cube',
							esc_html__( 'Coverflow', 'eventchamp' ) => 'coverflow',
							esc_html__( 'Flip', 'eventchamp' ) => 'flip',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-free-mode",
						"heading" => esc_html__( 'Free Mode', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the free mode. If true then slides will not have fixed positions', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "navbuttons",
						"heading" => esc_html__( 'Navigation', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the navigation.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Events Map
*
======*/
if( !function_exists( 'eventchamp_events_map_output' ) ) {

	function eventchamp_events_map_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'include-events' => '',
				'exclude-events' => '',
				'hide-expired' => '',
				'exclude-categories' => '',
				'exclude-locations' => '',
				'exclude-organizers' => '',
				'exclude-tags' => '',
				'include-categories' => '',
				'include-locations' => '',
				'include-organizers' => '',
				'include-tags' => '',
				'map-height' => '450px',
				'map-style' => '1',
				'map-lat' => '1',
				'map-lng' => '1',
				'map-zoom' => '13',
				'map-zoom-control' => 'false',
				'map-icon' => '',
				'map-type' => 'false',
				'map-scale' => 'false',
				'map-fullscreen' => 'false',
				'map-streets' => 'false',
				'event-categories' => 'false',
				'event-locations' => 'false',
				'event-venue' => 'false',
				'event-start-date' => 'false',
				'event-status' => 'false',
				'event-price' => 'false',
			), $atts
		);
		
		$output = '';

		/*====== Map Zoom ======*/
		if( empty( $atts["map-zoom"] ) ) {

			$atts["map-zoom"] = "13";

		}

		/*====== Map Height ======*/
		if( empty( $atts["map-height"] ) ) {

			$atts["map-height"] = "450px";

		}

		/*====== Map Style ======*/
		if( empty( $atts["map-style"] ) ) {

			$atts["map-style"] = "1";

		}

		/*====== Map Lat ======*/
		if( empty( $atts["map-lat"] ) ) {

			$atts["map-lat"] = "1";

		}

		/*====== Map Lng ======*/
		if( empty( $atts["map-lng"] ) ) {

			$atts["map-lng"] = "1";

		}

		/*====== Map Icon ======*/
		if( !empty( $atts["map-icon"] ) ) {

			$map_icon = wp_get_attachment_image_src( esc_attr( $atts["map-icon"] ), 'full' )[0];

		} else {

			$map_icon = get_template_directory_uri() . '/include/assets/img/map-marker.png';

		}

		/*====== Expired Events Status ======*/
		if( !empty( $atts['hide-expired'] ) ) {

			$hide_expired = esc_attr( $atts["hide-expired"] );

		} else {

			$hide_expired = "false";

		}

		/*====== Search Results ======*/
		if( isset( $_GET['keyword'] ) or isset( $_GET['category'] ) or isset( $_GET['status'] ) or isset( $_GET['sort'] ) or isset( $_GET['tag'] ) or isset( $_GET['location'] ) or isset( $_GET['event-venue'] ) or isset( $_GET['event-speaker'] ) or isset( $_GET['startdate'] ) or isset( $_GET['enddate'] ) or isset( $_GET['price'] ) ) {

			if( isset( $_GET['keyword'] ) ) {

				$search_keyword = esc_js( esc_sql( esc_attr( $_GET["keyword"] ) ) );

			} else {

				$search_keyword = "";

			}

			if( isset( $_GET['category'] ) ) {

				$search_category = esc_js( esc_sql( esc_attr( $_GET["category"] ) ) );

			} else {

				$search_category = "";

			}

			if( isset( $_GET['status'] ) ) {

				$search_status = esc_js( esc_sql( esc_attr( $_GET["status"] ) ) );

			} else {

				$search_status = "";

			}

			if( isset( $_GET['sort'] ) ) {

				$search_sort = esc_js( esc_sql( esc_attr( $_GET["sort"] ) ) );

			} else {

				$search_sort = "";

			}

			if( isset( $_GET['tag'] ) ) {

				$search_tag = esc_js( esc_sql( esc_attr( $_GET["tag"] ) ) );

			} else {

				$search_tag = "";

			}

			if( isset( $_GET['location'] ) ) {

				$search_location = esc_js( esc_sql( esc_attr( $_GET["location"] ) ) );

			} else {

				$search_location = "";

			}

			if( isset( $_GET['event-venue'] ) ) {

				$search_venue = esc_js( esc_sql( esc_attr( $_GET["event-venue"] ) ) );

			} else {

				$search_venue = "";

			}

			if( isset( $_GET['event-speaker'] ) ) {

				$search_speaker = esc_js( esc_sql( esc_attr( $_GET["event-speaker"] ) ) );

			} else {

				$search_speaker = "";

			}

			if( isset( $_GET['organizer'] ) ) {

				$search_organizer = esc_js( esc_sql( esc_attr( $_GET["organizer"] ) ) );

			} else {

				$search_organizer = "";

			}

			if( isset( $_GET['startdate'] ) ) {

				if( !empty( $_GET['startdate'] ) ) {

					$search_startdate = esc_js( esc_sql( esc_attr( $_GET["startdate"] ) ) );
					$search_startdate = date( 'Y-m-d', strtotime( $search_startdate ) );
					$search_startdate_compare = ">=";

				} else {

					$search_startdate = "";
					$search_startdate_compare = "";

				}

			} else {

				$search_startdate = "";
				$search_startdate_compare = "";

			}

			if( isset( $_GET['enddate'] ) ) {

				if( !empty( $_GET['enddate'] ) ) {

					$search_enddate = esc_js( esc_sql( esc_attr( $_GET["enddate"] ) ) );
					$search_enddate = date( 'Y-m-d', strtotime( $search_enddate ) );
					$search_enddate_compare = "<=";

				} else {

					$search_enddate = "";
					$search_enddate_compare = "";

				}

			} else {

				$search_enddate = "";
				$search_enddate_compare = "";

			}
			
			if( $search_status == "upcoming" ) {

				$search_compare = ">";
				$search_compare2 = ">";

			} elseif( $search_status == "showing" ) {

				$search_compare = "<=";
				$search_compare2 = ">=";

			} elseif( $search_status == "expired" ) {

				$search_compare = "<";
				$search_compare2 = "<";

			} else {

				$search_compare = "<=";
				$search_compare2 = ">=";

			}

			$prices = array();

			if( isset( $_GET['price'] ) ) {

				$search_price = esc_js( esc_sql( esc_attr( $_GET["price"] ) ) );

				if( !empty( $search_price ) ) {

					$prices = explode( ';', $search_price );

				}

			}

		} else {

			$search_startdate = "";
			$search_startdate_compare = "";
			$search_enddate = "";
			$search_enddate_compare = "";
			$search_keyword = "";
			$search_category = "";
			$search_status = "";
			$search_sort = "";
			$search_location = "";
			$search_venue = "";
			$search_speaker = "";
			$search_organizer = "";
			$search_compare = "";
			$search_compare2 = "";
			$order = "";
			$order_by = "";
			$meta_key = "event_start_date";
			$search_tag = "";
			$prices = array();

		}

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['exclude-categories'] ) ) {

			$exclude_categories = $atts['exclude-categories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Organizers ======*/
		$exclude_organizer_array = "";

		if( !empty( $atts['exclude-organizers'] ) ) {

			$exclude_organizers = $atts['exclude-organizers'];
			$exclude_organizers = explode( ',', $exclude_organizers );

		} else {

			$exclude_organizers = "";

		}

		if( !empty( $exclude_organizers ) ) {

			$exclude_organizer_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $exclude_organizers,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $search_category ) ) {

			$include_categories = explode( ',', $search_category );

			if( !empty( $include_categories ) ) {

				$include_category_array = array(
					'taxonomy' => 'eventcat',
					'field' => 'term_id',
					'terms' => $include_categories,
					'operator' => 'IN',
				);

			}

		} else {

			if( !empty( $atts['includecategories'] ) ) {

				$include_categories = $atts['includecategories'];
				$include_categories = explode( ',', $include_categories );

			} else {

				$include_categories = "";

			}

			if( !empty( $include_categories ) ) {

				$include_category_array = array(
					'taxonomy' => 'eventcat',
					'field' => 'term_id',
					'terms' => $include_categories,
					'operator' => 'IN',
				);

			}

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $search_location ) ) {

			$include_locations = explode( ',', $search_location );

			if( !empty( $include_locations ) ) {

				$include_location_array = array(
					'taxonomy' => 'location',
					'field' => 'term_id',
					'terms' => $include_locations,
					'operator' => 'IN',
				);

			}

		} else {

			if( !empty( $atts['include-locations'] ) ) {

				$include_locations = $atts['include-locations'];
				$include_locations = explode( ',', $include_locations );

			} else {

				$include_locations = "";

			}

			if( !empty( $include_locations ) ) {

				$include_location_array = array(
					'taxonomy' => 'location',
					'field' => 'term_id',
					'terms' => $include_locations,
					'operator' => 'IN',
				);

			}

		}

		/*====== Include Organizers ======*/
		$include_organizers_array = "";

		if( !empty( $search_organizer ) ) {

			$include_organizers = explode( ',', $search_organizer );

			if( !empty( $include_organizers ) ) {

				$include_organizers_array = array(
					'taxonomy' => 'organizer',
					'field' => 'term_id',
					'terms' => $include_organizers,
					'operator' => 'IN',
				);

			}

		} else {

			if( !empty( $atts['include-organizers'] ) ) {

				$include_organizers = $atts['include-organizers'];
				$include_organizers = explode( ',', $include_organizers );

			} else {

				$include_organizers = "";

			}

			if( !empty( $include_organizers ) ) {

				$include_organizers_array = array(
					'taxonomy' => 'organizer',
					'field' => 'term_id',
					'terms' => $include_organizers,
					'operator' => 'IN',
				);

			}

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $search_tag ) ) {

			$include_tags = explode( ',', $search_tag );

			if( !empty( $include_tags ) ) {

				$include_tags_array = array(
					'taxonomy' => 'event_tags',
					'field' => 'name',
					'terms' => $include_tags,
					'operator' => 'IN',
				);

			}

		} else {

			if( !empty( $atts['include-tags'] ) ) {

				$include_tags = $atts['include-tags'];
				$include_tags = explode( ',', $include_tags );

			} else {

				$include_tags = "";

			}

			if( !empty( $include_tags ) ) {

				$include_tags_array = array(
					'taxonomy' => 'event_tags',
					'field' => 'term_id',
					'terms' => $include_tags,
					'operator' => 'IN',
				);

			}

		}

		/*====== Filtrable by Venue ======*/
		$venue_array = array();

		if( !empty( $search_venue ) ) {

			$venue_array = array(
				'key' => 'event_venue',
				'compare' => 'LIKE',
				'value' => ':' . esc_attr( $search_venue ) . ';',
			);

		}

		/*====== Filtrable by Speaker ======*/
		$speaker_array = array();

		if( !empty( $search_speaker ) ) {

			$speaker_array = array(
				'key' => 'event_speakers',
				'compare' => 'LIKE',
				'value' => ':' . esc_attr( $search_speaker ) . ';',
			);

		}

		/*====== Filter by Price ======*/
		$prices_array = array();

		if( !empty( $prices ) ) {

			if( !empty( $prices[0] ) and !empty( $prices[1] ) ) {

				$prices_array = array(
					array(
						'key' => 'event-ticket-main-price',
						'compare' => '>=',
						'value' => $prices[0],
						'type' => 'NUMERIC',
					),
					array(
						'key' => 'event-ticket-main-price',
						'compare' => '<=',
						'value' => $prices[1],
						'type' => 'NUMERIC',
					),
				);

			}

		}

		/*====== Filtrable by Start Date ======*/
		$start_date_array = array();

		if( !empty( $search_startdate ) ) {

			$start_date_array = array(
				'key' => 'event_start_date',
				'compare' => $search_startdate_compare,
				'value' => $search_startdate,
			);

		}

		/*====== Filtrable by End Date ======*/
		$end_date_array = array();

		if( !empty( $search_enddate ) ) {

			$end_date_array = array(
				'key' => 'event_end_date',
				'compare' => $search_enddate_compare,
				'value' => $search_enddate,
			);

		}

		/*====== Order by Event Date ======*/
		$order_event_start_date_array = array();

		if( $search_sort == "start-date" ) {

			$order_event_start_date_array = array(
				'relation' => 'AND',
				'event_start_date_clause' => array(
					'key' => 'event_start_date',
				), 
				'event_start_time_clause' => array(
					'key' => 'event_start_time',
				),
			);

 		}

		/*====== Order by End Date ======*/
		$order_event_end_date_array = array();

		if( $search_sort == "end-date" ) {

			$order_event_end_date_array = array(
				'relation' => 'AND',
				'event_end_date_clause' => array(
					'key' => 'event_end_date',
				), 
				'event_end_time_clause' => array(
					'key' => 'event_end_time',
				),
			);

 		}

		/*====== Filtrable by Event Status ======*/
		$status_array = array();
		$status_array_2 = array();

		if( !empty( $search_status ) ) {

			if( $search_status == "expired" ) {

				$expire_date_now = date("Y-m-d H:i");
				$status_array = array(
					'key' => 'event_expire_date',
					'compare' => '<=',
					'value' => $expire_date_now,
				);

			} else {

				$status_array = array(
					'key' => 'event_start_date',
					'compare' => $search_compare,
					'value' => $date_now,
				);
				$status_array_2 = array(
					'key' => 'event_end_date',
					'compare' => $search_compare2,
					'value' => $date_now,
				);

			}

		}

		/*====== Main Query ======*/
		$arg = array(
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'post_type' => 'event',
			'tax_query' => array (
				'relation' => 'AND',
				$include_location_array,
				$include_category_array,
				$include_organizers_array,
				$include_tags_array,
				$exclude_category_array,
				$exclude_location_array,
				$exclude_organizer_array,
				$exclude_tag_array,
			),
			'meta_query' => array(
				$status_array,
				$status_array_2,
				$start_date_array,
				$end_date_array,
				$venue_array,
				$speaker_array,
				$prices_array,
				$order_event_start_date_array,
				$order_event_end_date_array,
			),
		);

		/*====== Keyword ======*/
		if( !empty( $search_keyword ) ) {

			$extra_query = array(
				's' => $search_keyword,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Events ======*/
		if( !empty( $atts['include-events'] ) ) {

			$event_ids = $atts['include-events'];
			$include_events = explode( ',', $event_ids );

		} else {

			$include_events = "";

		}

		if( !empty( $include_events ) ) {

			$extra_query = array(
				'post__in' => $include_events,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Events ======*/
		if( $hide_expired == "false" ) {

			if( !empty( $atts['exclude-events'] ) ) {

				$exclude_events = $atts['exclude-events'];
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			if( !empty( $exclude_events ) ) {

				$extra_query = array(
					'post__not_in' => $exclude_events,
				);
				$arg = wp_parse_args( $arg, $extra_query );

			}

		}

		/*====== Add Expired Events in Exclude Events ======*/
		if( $hide_expired == "true" ) {

			$expired_ids = eventchamp_expired_event_ids();

		} else {

			$expired_ids = array();

		}

		if( !empty( $expired_ids ) ) {

			if( !empty( $exclude_events ) ) {

				$exclude_events_expired = $exclude_events;
				$exclude_events_expired = explode( ',', $exclude_events_expired );

			} else {

				$exclude_events_expired = array();

			}

			$excludeevents_with_expired = array_merge( $exclude_events_expired, $expired_ids );

			$extra_query = array(
				'post__not_in' => $excludeevents_with_expired,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order by Start Date ======*/
		if( $search_sort == "start-date" ) {

			$extra_query = array(
				'orderby' => array(
					'event_start_date_clause' => $order,
					'event_start_time_clause' => $order,
				),
			);
			$arg = wp_parse_args( $arg, $extra_query );

 		}

		/*====== Order by End Date ======*/
		if( $search_sort == "end-date" ) {

			$extra_query = array(
				'orderby' => array(
					'event_end_date_clause' => $order,
					'event_end_time_clause' => $order,
				),
			);
			$arg = wp_parse_args( $arg, $extra_query );

 		}

		/*====== HTML Output ======*/
		$wp_query = new WP_Query( $arg );

		if( !empty( $wp_query ) ) {

			$output .= '<div class="gt-map gt-events-map">';
				$output .= '<div id="event_map" class="gt-map-inner" style="height:' . esc_attr( $atts["map-height"] ) .  '"></div>';
				$output .= '<ul data-zoom="' . esc_attr( $atts["map-zoom"] ) . '" data-lat="' . esc_attr( $atts["map-lat"] ) . '" data-lng="' . esc_attr( $atts["map-lng"] ) . '" data-type="' . esc_attr( $atts["map-type"] ) . '" data-scale="' . esc_attr( $atts["map-scale"] ) . '" data-zoom-control="' . esc_attr( $atts["map-zoom-control"] ) . '" data-map-style="' . esc_attr( $atts["map-style"] ) . '" data-street="' . esc_attr( $atts["map-streets"] ) . '" data-icon="' . esc_url( $map_icon ) . '" data-fullscreen="' . esc_attr( $atts["map-fullscreen"] ) . '" data-first-info="false" data-close-icon="' . get_template_directory_uri() . '/include/assets/img/map-close.svg' . '" data-cluster-icon="' . get_template_directory_uri() . '/include/assets/img/map-cluster/m' . '">';

					while( $wp_query->have_posts() ) {

						$wp_query->the_post();

						$categories = wp_get_post_terms( get_the_ID(), 'eventcat' );
						$locations = wp_get_post_terms( get_the_ID(), 'location' );
						$event_venues = get_post_meta( get_the_ID(), 'event_venue', true );
						$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
						$event_price = get_post_meta( get_the_ID(), 'event-ticket-main-price', true );
						$event_lat = get_post_meta( get_the_ID(), 'event-map-lat', true );
						$event_lng = get_post_meta( get_the_ID(), 'event-map-lng', true );
						$event_icon = get_post_meta( get_the_ID(), 'event-map-icon', true );

						if( empty( $event_icon ) ) {

							$event_icon = $map_icon;

						}

						$popup_content = '<div class="gt-map-popup-wrapper">';
							$popup_content .= '<div class="gt-map-popup" style="background-image:url(' . esc_url( wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'eventchamp-thumbnail' )[0] ) . ');">';
								$popup_content .= '<a href="' . get_the_permalink() . '"></a>';

								$popup_content .= '<div class="gt-inner">';

									if( $atts["event-price"] == 'true' and !empty( $event_price ) or $atts["event-status"] == 'true' ) {

										$popup_content .= '<ul class="gt-top-links">';

											if( $atts["event-price"] == 'true' and !empty( $event_price ) ) {

												$popup_content .= '<li class="gt-price">';
													$popup_content .= esc_attr( $event_price );
												$popup_content .= '</li>';

											}

											if( $atts["event-status"] == 'true' ) {

												$popup_content .= '<li class="gt-status">';
													$popup_content .= eventchamp_event_status( $post_id = get_the_ID() );
												$popup_content .= '</li>';

											}

										$popup_content .= '</ul>';

									}

									$popup_content .= '<div class="gt-title">' . get_the_title() . '</div>';

									if( $atts["event-categories"] == 'true' and !empty( $categories ) or  $atts["event-locations"] == 'true' and !empty( $locations ) or $atts["event-start-date"] == 'true' and !empty( $event_start_date ) or $atts["event-venue"] == 'true' and !empty( $event_venues ) ) {

										$popup_content .= '<ul class="gt-bottom-links">';

											if( $atts["event-categories"] == 'true' and !empty( $categories ) ) {

												$popup_content .= '<li class="gt-category">';
													$popup_content .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>';
													$popup_content .= '<ul>';

														foreach( $categories as $cat ) {

															if( !empty( $cat ) ) {

																$popup_content .= '<li class="gt-category-' . esc_attr( $cat->term_id ) . '">';
																	$popup_content .= '<a href="' . get_term_link( $cat->term_id ) . '?post_type=event">' . esc_attr( $cat->name ) . '</a>';
																$popup_content .= '</li>';

															}

														}

													$popup_content .= '</ul>';
												$popup_content .= '</li>';

											}

											if( $atts["event-locations"] == 'true' and !empty( $locations ) ) {

												$popup_content .= '<li class="gt-location">';
													$popup_content .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
													$popup_content .= '<ul>';

														foreach( $locations as $loc ) {

															if( !empty( $loc ) ) {

																$popup_content .= '<li class="gt-category-' . esc_attr( $loc->term_id ) . '">';
																	$popup_content .= '<a href="' . get_term_link( $loc->term_id ) . '?post_type=event">' . esc_attr( $loc->name ) . '</a>';
																$popup_content .= '</li>';

															}

														}

													$popup_content .= '</ul>';
												$popup_content .= '</li>';

											}

											if( $atts["event-start-date"] == 'true' and !empty( $event_start_date ) ) {

												$popup_content .= '<li class="gt-date">';
													$popup_content .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
												 	$popup_content .= '<span>' . eventchamp_global_date_converter( $date = esc_attr( $event_start_date ) ) . '</span>';
												$popup_content .= '</li>';

											}

											if( $atts["event-venue"] == 'true' and !empty( $event_venues ) ) {

												$popup_content .= '<li class="gt-venue">';
													$popup_content .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>';
													$popup_content .= '<ul>';

														foreach( $event_venues as $event_venue ) {

															if( !empty( $event_venue ) ) {

																$popup_content .= '<li><a href="' . esc_url( get_the_permalink( $event_venue ) ) . '">' . get_the_title( $event_venue ) . '</a></li>';

															}

														}

													$popup_content .= '</ul>';
												$popup_content .= '</li>';

											}

										$popup_content .= '</ul>';

									}

								$popup_content .= '</div>';

							$popup_content .= '</div>';
						$popup_content .= '</div>';

						$output .= '<li data-lat="' . esc_attr( $event_lat ) . '" data-lng="' . esc_attr( $event_lng ) . '" data-icon="' . esc_url( $event_icon ) . '">';
							$output .= $popup_content;
						$output .= '</li>';

					}

				$output .= '</ul>';
			$output .= '</div>';

		}
		wp_reset_postdata();

		return $output;

	}
	add_shortcode( "eventchamp_events_map", "eventchamp_events_map_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Events Map', 'eventchamp' ),
				"base" => "eventchamp_events_map",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/events-map.jpg',
				"description" => esc_html__( 'Events map element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "include-events",
						"heading" => esc_html__( 'Include Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-events",
						"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-expired",
						"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'You can hide the expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-categories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-organizers",
						"heading" => esc_html__( 'Exclude Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-categories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-organizers",
						"heading" => esc_html__( 'Include Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "map-height",
						"heading" => esc_html__( 'Map Height', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a map height. If you want to make it full height, enter 100vh value. Default: 450px', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-style",
						"heading" => esc_html__( 'Map Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a map style.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
							esc_html__( 'Style 7', 'eventchamp' ) => '7',
							esc_html__( 'Style 8', 'eventchamp' ) => '8',
							esc_html__( 'Style 9', 'eventchamp' ) => '9',
							esc_html__( 'Style 10', 'eventchamp' ) => '10',
							esc_html__( 'Style 11', 'eventchamp' ) => '11',
							esc_html__( 'Style 12', 'eventchamp' ) => '12',
							esc_html__( 'Style 13', 'eventchamp' ) => '13',
							esc_html__( 'Style 14', 'eventchamp' ) => '14',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "map-lat",
						"heading" => esc_html__( 'Map Lat', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a lat coordinate. The map will open on this lat coordinate.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "map-lng",
						"heading" => esc_html__( 'Map Lng', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a lng coordinate. The map will open on this lng coordinate.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "map-zoom",
						"heading" => esc_html__( 'Map Zoom', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a map zoom value. Default: 13', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-zoom-control",
						"heading" => esc_html__( 'Map Zoom Control', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map zoom control.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "attach_image",
						"param_name" => "map-icon",
						"heading" => esc_html__( 'Map Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can upload a map icon. If an event has not any map icon, this icon will show on the map.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-type",
						"heading" => esc_html__( 'Map Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map type.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-scale",
						"heading" => esc_html__( 'Map Scale', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map scale.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-fullscreen",
						"heading" => esc_html__( 'Map Fullscreen', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map fullscreen control.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-streets",
						"heading" => esc_html__( 'Map Streets', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map streets.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-categories",
						"heading" => esc_html__( 'Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event categories.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-locations",
						"heading" => esc_html__( 'Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event locations.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-venue",
						"heading" => esc_html__( 'Venue', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event venue.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-start-date",
						"heading" => esc_html__( 'Start Date', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event start date.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-status",
						"heading" => esc_html__( 'Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event status.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-price",
						"heading" => esc_html__( 'Price', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event ticket price.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Events Calendar
*
======*/
if( !function_exists( 'eventchamp_event_calendar_output' ) ) {

	function eventchamp_event_calendar_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '',
				'contenttype' => '',
				'include-events' => '',
				'exclude-events' => '',
				'hide-expired' => '',
				'first-day' => '',
				'nav-links' => '',
				'editable' => '',
				'current-dates' => '',
				'title-format' => '',
				'height' => '',
				'content-height' => '',
				'exclude-categories' => '',
				'exclude-locations' => '',
				'exclude-organizers' => '',
				'exclude-tags' => '',
				'include-categories' => '',
				'include-locations' => '',
				'include-organizers' => '',
				'include-tags' => '',
			), $atts
		);
		
		$output = '';
		$items = '';

		/*====== Nav Links ======*/
		if( empty( $atts["style"] ) ) {

			$atts["style"] = "style-1";

		}

		/*====== Nav Links ======*/
		if( empty( $atts["nav-links"] ) ) {

			$atts["nav-links"] = "false";

		}

		/*====== Editable ======*/
		if( empty( $atts["editable"] ) ) {

			$atts["editable"] = "false";

		}

		/*====== Editable ======*/
		if( empty( $atts["current-dates"] ) ) {

			$atts["current-dates"] = "false";

		}

		/*====== Title Format ======*/
		if( empty( $atts["title-format"] ) ) {

			$atts["title-format"] = "MMMM YYYY";

		}

		/*====== Height ======*/
		if( empty( $atts["height"] ) ) {

			$atts["height"] = "1000";

		}

		/*====== Content Height ======*/
		if( empty( $atts["content-height"] ) ) {

			$atts["content-height"] = "auto";

		}

		/*====== Expired Events Status ======*/
		if( !empty( $atts['hide-expired'] ) ) {

			$hide_expired = esc_attr( $atts["hide-expired"] );

		} else {

			$hide_expired = "false";

		}

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['exclude-categories'] ) ) {

			$exclude_categories = $atts['exclude-categories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Organizers ======*/
		$exclude_organizer_array = "";

		if( !empty( $atts['exclude-organizers'] ) ) {

			$exclude_organizers = $atts['exclude-organizers'];
			$exclude_organizers = explode( ',', $exclude_organizers );

		} else {

			$exclude_organizers = "";

		}

		if( !empty( $exclude_organizers ) ) {

			$exclude_organizer_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $exclude_organizers,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $atts['include-categories'] ) ) {

			$include_categories = $atts['include-categories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		if( !empty( $include_categories ) ) {

			$include_category_array = array(
				'taxonomy' => 'eventcat',
				'field' => 'term_id',
				'terms' => $include_categories,
				'operator' => 'IN',
			);

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		if( !empty( $include_locations ) ) {

			$include_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $include_locations,
				'operator' => 'IN',
			);

		}

		/*====== Include Organizers ======*/
		$include_organizers_array = "";

		if( !empty( $atts['include-organizers'] ) ) {

			$include_organizers = $atts['include-organizers'];
			$include_organizers = explode( ',', $include_organizers );

		} else {

			$include_organizers = "";

		}

		if( !empty( $include_organizers ) ) {

			$include_organizers_array = array(
				'taxonomy' => 'organizer',
				'field' => 'term_id',
				'terms' => $include_organizers,
				'operator' => 'IN',
			);

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		if( !empty( $include_tags ) ) {

			$include_tags_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $include_tags,
				'operator' => 'IN',
			);

		}

		/*====== Main Query ======*/
		$arg = array(
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'post_type' => 'event',
			'tax_query' => array (
				'relation' => 'AND',
				$include_location_array,
				$include_category_array,
				$include_organizers_array,
				$include_tags_array,
				$exclude_category_array,
				$exclude_location_array,
				$exclude_organizer_array,
				$exclude_tag_array,
			)
		);

		/*====== Include Events ======*/
		if( !empty( $atts['include-events'] ) ) {

			$event_ids = $atts['include-events'];
			$include_events = explode( ',', $event_ids );

		} else {

			$include_events = "";

		}

		if( !empty( $include_events ) ) {

			$extra_query = array(
				'post__in' => $include_events,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Events ======*/
		if( $hide_expired == "false" ) {

			if( !empty( $atts['exclude-events'] ) ) {

				$exclude_events = $atts['exclude-events'];
				$exclude_events = explode( ',', $exclude_events );

			} else {

				$exclude_events = array();

			}

			if( !empty( $exclude_events ) ) {

				$extra_query = array(
					'post__not_in' => $exclude_events,
				);
				$arg = wp_parse_args( $arg, $extra_query );

			}

		}

		/*====== Add Expired Events in Exclude Events ======*/
		if( $hide_expired == "true" ) {

			$expired_ids = eventchamp_expired_event_ids();

		} else {

			$expired_ids = array();

		}

		if( !empty( $expired_ids ) ) {

			if( !empty( $exclude_events ) ) {

				$exclude_events_expired = $exclude_events;
				$exclude_events_expired = explode( ',', $exclude_events_expired );

			} else {

				$exclude_events_expired = array();

			}

			$excludeevents_with_expired = array_merge( $exclude_events_expired, $expired_ids );

			$extra_query = array(
				'post__not_in' => $excludeevents_with_expired,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== HTML Output ======*/
		$wp_query = new WP_Query( $arg );

		if( !empty( $wp_query ) ) {

			while( $wp_query->have_posts() ) {

				$wp_query->the_post();
				$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );

				if( empty( $event_start_date ) ) {

					$event_start_date = "";

				}

				$event_start_time = get_post_meta( get_the_ID(), 'event_start_time', true );

				if( !empty( $event_start_time ) ) {

					$event_start_time = "T" . $event_start_time;

				} else {

					$event_start_time = "";		

				}

				$event_end_date = get_post_meta( get_the_ID(), 'event_end_date', true );

				if( empty( $event_end_date ) ) {

					$event_end_date = "";

				}

				$event_end_time = get_post_meta( get_the_ID(), 'event_end_time', true );

				if( !empty( $event_end_time ) ) {

					$event_end_time = "T" . $event_end_time;

				} else {

					$event_end_time = "";

				}

				$items .= '{
							id: ' . get_the_ID() . ',
							title: "' . get_post_field( 'post_title', get_the_ID(), 'display' ) . '",
							url: "' . get_the_permalink() . '",
							start: "' . $event_start_date . $event_start_time . '",
							end: "' . $event_end_date . $event_end_time . '",
						},';
			}

			if( !empty( $atts["first-day"] ) ) {

				$first_day = $atts["first-day"];

			} else {

				$first_day = 0;

			}

			if( $atts["contenttype"] == "calendar" ) {

				$type = 'month';
				$def = '';

			} elseif( $atts["contenttype"] == "calendarlistweek" ) {

				$type = 'month,listWeek';
				$def = '';

			} elseif( $atts["contenttype"] == "calendarlistday" ) {

				$type = 'month,listDay';
				$def = '';

			} elseif( $atts["contenttype"] == "fully" ) {

				$type = 'month,agendaWeek,agendaDay,listWeek';
				$def = '';

			} elseif( $atts["contenttype"] == "listweek" ) {

				$type = 'listWeek';
				$def = 'defaultView: "listWeek",';

			} elseif( $atts["contenttype"] == "listyear" ) {

				$type = 'listYear';
				$def = 'defaultView: "listYear",';

			} elseif( $atts["contenttype"] == "listmonth" ) {

				$type = 'listMonth';
				$def = 'defaultView: "listMonth",';

			} elseif( $atts["contenttype"] == "listday" ) {

				$type = 'listDay';
				$def = 'defaultView: "listDay",';

			} else {

				$type = 'month';
				$def = '';

			}

			$local = get_locale();

			if( !empty( $local ) ) {

				$local_code = substr( $local, 0, 2 );

			} else {

				$local_code = "en";

			}

			$rtl = ot_get_option( 'rtl', 'off' );

			if( $rtl == 'on' ) {

				$rtl_status = "true";

			} else {

				$rtl_status = "false";

			}

			/*====== Inline Script ======*/
			wp_add_inline_script( 'eventchamp', 'jQuery(document).ready(function($){
				$(".gt-events-calendar .gt-calendar").fullCalendar({
					header: {
						left: "prev,next,today",
						center: "title",
						right: "' . esc_attr( $type ) .  '",
					},
					' . $def . '
					navLinks: "' . esc_attr( $atts["nav-links"] ) . '",
					editable: "' . esc_attr( $atts["editable"] ) . '",
					showNonCurrentDates: "' . esc_attr( $atts["current-dates"] ) . '",
					eventLimit: true,
					firstDay: ' . esc_attr( $first_day ) . ',
					locale: "' . esc_attr( $local_code ) . '",
					titleFormat: "' . esc_attr( $atts["title-format"] ) . '",
					events: [' . $items . '],
					themeSystem: "standard",
					height: ' . esc_attr( $atts["height"] ) . ',
					contentHeight: "' . esc_attr( $atts["content-height"] ) . '",
					allDayText: "' . esc_html__( 'All Day', 'eventchamp' ) . '",
					noEventsMessage: "' . esc_html__( 'No events to display.', 'eventchamp' ) . '",
					isRTL: ' . esc_attr( $rtl_status ) . ',
					buttonText: {
						today: "' . esc_html__( 'Today', 'eventchamp' ) . '",
						month: "' . esc_html__( 'Month', 'eventchamp' ) . '",
						week: "' . esc_html__( 'Week', 'eventchamp' ) . '",
						day: "' . esc_html__( 'Day', 'eventchamp' ) . '",
						list: "' . esc_html__( 'List', 'eventchamp' ) . '",
					}
				});
			});' );

		}
		wp_reset_postdata();

		$output .= '<div class="gt-events-calendar gt-' . esc_attr( $atts["style"] ) . '">';
			$output .= '<div class="gt-calendar"></div>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_event_calendar", "eventchamp_event_calendar_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Events Calendar', 'eventchamp' ),
				"base" => "eventchamp_event_calendar",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/events-calendar.jpg',
				"description" => esc_html__( 'Events calendar element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "contenttype",
						"heading" => esc_html__( 'Calendar Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a calendar type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'Calendar', 'eventchamp' ) => 'calendar',
							esc_html__( 'Calendar + List Week', 'eventchamp' ) => 'calendarlistweek',
							esc_html__( 'Calendar + List Day', 'eventchamp' ) => 'calendarlistday',
							esc_html__( 'Fully', 'eventchamp' ) => 'fully',
							esc_html__( 'List Year', 'eventchamp' ) => 'listyear',
							esc_html__( 'List Month', 'eventchamp' ) => 'listmonth',
							esc_html__( 'List Week', 'eventchamp' ) => 'listweek',
							esc_html__( 'List Day', 'eventchamp' ) => 'listday',
							esc_html__( 'External Dragging', 'eventchamp' ) => 'externaldragging',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "include-events",
						"heading" => esc_html__( 'Include Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-events",
						"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
						"description" => esc_html__( 'You can enter event ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-expired",
						"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'You can hide the expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "first-day",
						"heading" => esc_html__( 'First Day of Week', 'eventchamp' ),
						"description" => esc_html__( 'You can enter first day of the week. Sunday = 0, Monday = 1, Tuesday = 2, etc. Default: 0', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "nav-links",
						"heading" => esc_html__( 'Nav Links', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the nav links.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "editable",
						"heading" => esc_html__( 'Editable', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the editable function.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "current-dates",
						"heading" => esc_html__( 'Show Non Current Dates', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the show non current dates.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "title-format",
						"heading" => esc_html__( 'Date Format for the Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a date format for the title. Default: MMMM YYYY.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "height",
						"heading" => esc_html__( 'Calendar Height', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a calendar height. Default: 1000.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-categories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-organizers",
						"heading" => esc_html__( 'Exclude Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-categories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-organizers",
						"heading" => esc_html__( 'Include Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizers ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
				),
			)
		);
	}

}



/*======
*
* Get An Event Content
*
======*/
if( !function_exists( 'eventchamp_event_content_output' ) ) {

	function eventchamp_event_content_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'eventid' => '',
				'contenttype' => 'speaker',
				'speaker-style' => '1',
				'speaker-column' => '1',
				'speaker-column-space' => '0',
				'speaker-profession' => 'true',
				'speaker-summary' => 'true',
				'speaker-social-links' => 'true',
				'schedule-style' => '1',
				'schedule-collapsed' => 'true',
				'ticket-style' => '1',
				'price-list-column' => '1',
				'ticket-column-space' => '0',
				'sponsor-style' => '1',
				'sponsor-column' => '1',
				'sponsor-column-space' => '0',
				'photo-column' => '1',
				'photo-column-space' => '0',
				'map-style' => '1',
				'map-height' => '',
				'map-zoom' => '',
			), $atts
		);

		$output = "";

		/*====== HTML Output ======*/
		if( !empty( $atts["contenttype"] ) and !empty( $atts["eventid"] ) ) {

			$output .= '<div class="gt-get-event-content">';

				if( $atts["contenttype"] == "speaker" ) {

					$output .= eventchamp_event_speakers( $post_id = esc_attr( $atts["eventid"] ), $column = esc_attr( $atts["speaker-column"] ), $column_space = esc_attr( $atts["speaker-column-space"] ), $style = esc_attr( 'style-' . $atts["speaker-style"] ), $image = "true", $profession = esc_attr( $atts["speaker-profession"] ), $summary = esc_attr( $atts["speaker-summary"] ), $social = esc_attr( $atts["speaker-social-links"] ) );

				} elseif( $atts["contenttype"] == "schedule" ) {

					$output .= eventchamp_schedule( $post_id = esc_attr( $atts["eventid"] ), $first_open = "false", $all_open = "false", $extra_style = esc_attr( 'style-' . $atts["schedule-style"] ), $extra_all_open = esc_attr( $atts["schedule-collapsed"] ) );

				} elseif( $atts["contenttype"] == "ticket" ) {

					$output .= eventchamp_event_tickets( $post_id = esc_attr( $atts["eventid"] ), $extra_style = esc_attr( 'style-' . $atts["ticket-style"] ), $extra_column = esc_attr( $atts["price-list-column"] ), $extra_column_space = esc_attr( $atts["ticket-column-space"] ) );

				} elseif( $atts["contenttype"] == "sponsor" ) {

					$output .= eventchamp_event_sponsors( $id = esc_attr( $atts["eventid"] ), $type = "type-1", $column = esc_attr( $atts["sponsor-column"] ), $style = esc_attr( 'style-' . $atts["sponsor-style"] ), $padding = esc_attr( $atts["sponsor-column-space"] ) );

				} elseif( $atts["contenttype"] == "photo" ) {

					$output .= eventchamp_event_photos( $id = esc_attr( $atts["eventid"] ), $extra_column = esc_attr( $atts["photo-column"] ), $extra_column_space = esc_attr( $atts["photo-column-space"] ) );

				} elseif( $atts["contenttype"] == "map" ) {

					$output .= eventchamp_event_map( $id = esc_attr( $atts["eventid"] ), $map_height = esc_attr( $atts["map-height"] ), $extra_style = esc_attr( $atts["map-style"] ), $extra_zoom = esc_attr( $atts["map-zoom"] ) );

				} elseif( $atts["contenttype"] == "faq" ) {

					$output .= eventchamp_event_faq( $post_id = esc_attr( $atts["eventid"] ), $first_open = "false" );

				}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_event_content", "eventchamp_event_content_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Get an Event Content', 'eventchamp' ),
				"base" => "eventchamp_event_content",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/get-event-content.jpg',
				"description" => esc_html__( 'The element gets event contents.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "eventid",
						"heading" => esc_html__( 'Event ID', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an event ID. The content will get from this event.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"admin_label" => true,
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "contenttype",
						"heading" => esc_html__( 'Content Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a content type. Which content do you want to get?', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"admin_label" => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'Speakers', 'eventchamp' ) => 'speaker',
							esc_html__( 'Schedule', 'eventchamp' ) => 'schedule',
							esc_html__( 'Tickets', 'eventchamp' ) => 'ticket',
							esc_html__( 'Sponsors', 'eventchamp' ) => 'sponsor',
							esc_html__( 'Photos', 'eventchamp' ) => 'photo',
							esc_html__( 'Map', 'eventchamp' ) => 'map',
							esc_html__( 'FAQ', 'eventchamp' ) => 'faq',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-style",
						"heading" => esc_html__( 'Speaker Listing Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Speakers', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
							esc_html__( 'Style 7', 'eventchamp' ) => '7',
							esc_html__( 'Style 8', 'eventchamp' ) => '8',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-column",
						"heading" => esc_html__( 'Speaker Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Speakers', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-column-space",
						"heading" => esc_html__( 'Speaker Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column space.', 'eventchamp' ),
						"group" => esc_html__( 'Speakers', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '0', 'eventchamp' ) => '0',
							esc_html__( '5', 'eventchamp' ) => '5',
							esc_html__( '10', 'eventchamp' ) => '10',
							esc_html__( '15', 'eventchamp' ) => '15',
							esc_html__( '20', 'eventchamp' ) => '20',
							esc_html__( '25', 'eventchamp' ) => '25',
							esc_html__( '30', 'eventchamp' ) => '30',
							esc_html__( '35', 'eventchamp' ) => '35',
							esc_html__( '40', 'eventchamp' ) => '40',
							esc_html__( '45', 'eventchamp' ) => '45',
							esc_html__( '50', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-profession",
						"heading" => esc_html__( 'Speaker Profession', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the speaker profession.', 'eventchamp' ),
						"group" => esc_html__( 'Speakers', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-summary",
						"heading" => esc_html__( 'Speaker Summary', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the speaker summary.', 'eventchamp' ),
						"group" => esc_html__( 'Speakers', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-social-links",
						"heading" => esc_html__( 'Speaker Social Links', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the speaker social links.', 'eventchamp' ),
						"group" => esc_html__( 'Speakers', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "schedule-style",
						"heading" => esc_html__( 'Schedule Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Schedule', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
							esc_html__( 'Style 7', 'eventchamp' ) => '7',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "schedule-collapsed",
						"heading" => esc_html__( 'Schedule Items Collapsed for the Dropdown', 'eventchamp' ),
						"description" => esc_html__( 'You can choose opening status of the schedule items for the dropdown version (Style 1, Style 2 and Style 3).', 'eventchamp' ),
						"group" => esc_html__( 'Schedule', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "ticket-style",
						"heading" => esc_html__( 'Ticket Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Tickets', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
							esc_html__( 'Style 7', 'eventchamp' ) => '7',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "price-list-column",
						"heading" => esc_html__( 'Ticket Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Tickets', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "ticket-column-space",
						"heading" => esc_html__( 'Ticket Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column space.', 'eventchamp' ),
						"group" => esc_html__( 'Tickets', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0', 'eventchamp' ) => '0',
							esc_html__( '5', 'eventchamp' ) => '5',
							esc_html__( '10', 'eventchamp' ) => '10',
							esc_html__( '15', 'eventchamp' ) => '15',
							esc_html__( '20', 'eventchamp' ) => '20',
							esc_html__( '25', 'eventchamp' ) => '25',
							esc_html__( '30', 'eventchamp' ) => '30',
							esc_html__( '35', 'eventchamp' ) => '35',
							esc_html__( '40', 'eventchamp' ) => '40',
							esc_html__( '45', 'eventchamp' ) => '45',
							esc_html__( '50', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sponsor-style",
						"heading" => esc_html__( 'Sponsor Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Sponsors', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sponsor-column",
						"heading" => esc_html__( 'Sponsor Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Sponsors', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
							esc_html__( '7 Column', 'eventchamp' ) => '7',
							esc_html__( '8 Column', 'eventchamp' ) => '8',
							esc_html__( '9 Column', 'eventchamp' ) => '9',
							esc_html__( '10 Column', 'eventchamp' ) => '10',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sponsor-column-space",
						"heading" => esc_html__( 'Sponsor Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column space.', 'eventchamp' ),
						"group" => esc_html__( 'Sponsors', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0', 'eventchamp' ) => '0',
							esc_html__( '5', 'eventchamp' ) => '5',
							esc_html__( '10', 'eventchamp' ) => '10',
							esc_html__( '15', 'eventchamp' ) => '15',
							esc_html__( '20', 'eventchamp' ) => '20',
							esc_html__( '25', 'eventchamp' ) => '25',
							esc_html__( '30', 'eventchamp' ) => '30',
							esc_html__( '35', 'eventchamp' ) => '35',
							esc_html__( '40', 'eventchamp' ) => '40',
							esc_html__( '45', 'eventchamp' ) => '45',
							esc_html__( '50', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "photo-column",
						"heading" => esc_html__( 'Photo Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Photos', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "photo-column-space",
						"heading" => esc_html__( 'Photo Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column space.', 'eventchamp' ),
						"group" => esc_html__( 'Photos', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0', 'eventchamp' ) => '0',
							esc_html__( '5', 'eventchamp' ) => '5',
							esc_html__( '10', 'eventchamp' ) => '10',
							esc_html__( '15', 'eventchamp' ) => '15',
							esc_html__( '20', 'eventchamp' ) => '20',
							esc_html__( '25', 'eventchamp' ) => '25',
							esc_html__( '30', 'eventchamp' ) => '30',
							esc_html__( '35', 'eventchamp' ) => '35',
							esc_html__( '40', 'eventchamp' ) => '40',
							esc_html__( '45', 'eventchamp' ) => '45',
							esc_html__( '50', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-style",
						"heading" => esc_html__( 'Map Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a map style.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
							esc_html__( 'Style 7', 'eventchamp' ) => '7',
							esc_html__( 'Style 8', 'eventchamp' ) => '8',
							esc_html__( 'Style 9', 'eventchamp' ) => '9',
							esc_html__( 'Style 10', 'eventchamp' ) => '10',
							esc_html__( 'Style 11', 'eventchamp' ) => '11',
							esc_html__( 'Style 12', 'eventchamp' ) => '12',
							esc_html__( 'Style 13', 'eventchamp' ) => '13',
							esc_html__( 'Style 14', 'eventchamp' ) => '14',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "map-height",
						"heading" => esc_html__( 'Map Height', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a map height. If enter blank it, the standart height will be apply.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "map-zoom",
						"heading" => esc_html__( 'Map Zoom', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a map zoom. If enter blank it, the standart zoom will be apply.', 'eventchamp' ),
						"group" => esc_html__( 'Map', 'eventchamp' ),
						"save_always" => true,
					),
				),
			)
		);

	}

}



/*======
*
* Speaker Listing
*
======*/
if( !function_exists( 'eventchamp_speakers_list_grid_output' ) ) {

	function eventchamp_speakers_list_grid_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'speakercount' => '',
				'speakerids' => '',
				'excludespeakers' => '',
				'offset' => '',
				'ordertype' => '',
				'sortby' => '',
				'pagination' => '',
				'style' => '1',
				'column' => '',
				'profession-company' => 'false',
				'short-biography' => 'false',
				'social-links' => 'false',
			), $atts
		);

		$output = "";

		/*====== Column ======*/
		if( $atts["column"] ) {

			$column = esc_attr( $atts["column"] );

		} else {

			$column = "column-1";

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'speaker',
		);

		/*====== Pagination ======*/
		$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );

		if( empty( $paged ) ) {

			$paged = 1;

		}

		if( !empty( $paged ) ) {

			$extra_query = array(
				'paged' => $paged,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Speakers ======*/
		if( !empty( $atts['speakerids'] ) ) {

			$speakerids = $atts['speakerids'];
			$include_speakers = explode( ',', $speakerids );

		} else {

			$include_speakers = "";

		}

		if( !empty( $include_speakers ) ) {

			$extra_query = array(
				'post__in' => $include_speakers,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Speaker Count ======*/
		if( !empty( $atts["speakercount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["speakercount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Speakers ======*/
		$excludespeakers = $atts['excludespeakers'];

		if( !empty( $excludespeakers ) ) {

			$exclude_speakers = $excludespeakers;
			$exclude_speakers = explode( ',', $exclude_speakers );

		} else {

			$exclude_speakers = array();

		}


		if( !empty( $exclude_speakers ) ) {

			$extra_query = array(
				'post__not_in' => $exclude_speakers,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order & Order By ======*/
		if( $atts["ordertype"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		if( $atts["sortby"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["sortby"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["sortby"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["sortby"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["sortby"] == "post__in" ) {

			$order_by = "post__in";

		} elseif( $atts["sortby"] == "none" ) {

			$order_by = "none";

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== HTML Output ======*/
		$output .= '<div class="gt-speakers-listing gt-style-1">';
			$wp_query = new WP_Query( $arg );

			if( !empty( $wp_query ) ) {

				$output .= '<div class="gt-columns gt-' . esc_attr( $column ) . '">';

						while( $wp_query->have_posts() ) {
							$wp_query->the_post();

							$output .= '<div class="gt-col">';
								$output .= '<div class="gt-inner">';

									if( $atts["style"] == "1" ) {

										$output .= eventchamp_speaker_style_1( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

									} elseif( $atts["style"] == "2" ) {

										$output .= eventchamp_speaker_style_2( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

									} elseif( $atts["style"] == "3" ) {

										$output .= eventchamp_speaker_style_3( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

									} elseif( $atts["style"] == "4" ) {

										$output .= eventchamp_speaker_style_4( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

									} elseif( $atts["style"] == "5" ) {

										$output .= eventchamp_speaker_style_5( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

									} elseif( $atts["style"] == "6" ) {

										$output .= eventchamp_speaker_style_6( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

									} elseif( $atts["style"] == "7" ) {

										$output .= eventchamp_speaker_style_7( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

									} elseif( $atts["style"] == "8" ) {

										$output .= eventchamp_speaker_style_8( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

									}

								$output .= '</div>';
							$output .= '</div>';

						}

				$output .= '</div>';

			}
			wp_reset_postdata();

			if( $atts['pagination'] == 'true' ) {

				$output .= eventchamp_element_pagination( $paged = $paged, $query = $wp_query );

			}

		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_speakers_list_grid", "eventchamp_speakers_list_grid_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Speaker Listing', 'eventchamp' ),
				"base" => "eventchamp_speakers_list_grid",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/speakers-listing.jpg',
				"description" => esc_html__( 'Speakers list element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "speakercount",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "speakerids",
						"heading" => esc_html__( 'Include Speakers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter speaker ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "excludespeakers",
						"heading" => esc_html__( 'Exclude Speakers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter speaker ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "ordertype",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sortby",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "pagination",
						"heading" => esc_html__( 'Pagination', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
							esc_html__( 'Style 7', 'eventchamp' ) => '7',
							esc_html__( 'Style 8', 'eventchamp' ) => '8',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => 'column-1',
							esc_html__( '2 Column', 'eventchamp' ) => 'column-2',
							esc_html__( '3 Column', 'eventchamp' ) => 'column-3',
							esc_html__( '4 Column', 'eventchamp' ) => 'column-4',
							esc_html__( '5 Column', 'eventchamp' ) => 'column-5',
							esc_html__( '6 Column', 'eventchamp' ) => 'column-6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "profession-company",
						"heading" => esc_html__( 'Profession / Company', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the profession / company info. You can choose the field you want to show from the Theme Settings > Speakers page.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "short-biography",
						"heading" => esc_html__( 'Short Biography', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the short biography.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "social-links",
						"heading" => esc_html__( 'Social Links', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the social links.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Categorized Speakers
*
======*/
if( !function_exists( 'eventchamp_categorized_speakers_output' ) ) {

	function eventchamp_categorized_speakers_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'count' => '',
				'exclude-speakers' => '',
				'offset' => '',
				'order' => '',
				'order-type' => '',
				'exclude-categories' => '',
				'exclude-locations' => '',
				'exclude-tags' => '',
				'include-categories' => '',
				'include-locations' => '',
				'include-tags' => '',
				'taxonomy-order' => '',
				'taxonomy-order-type' => '',
				'hide-empty-taxonomies' => '',
				'childless' => '',
				'category-list-align' => '',
				'style' => '',
				'column' => '',
				'all-speakers-tab' => '',
				'all-speakers-button' => '',
				'profession-company' => '',
				'short-biography' => '',
				'social-links' => '',
			), $atts
		);

		$output = "";

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['exclude-categories'] ) ) {

			$exclude_categories = $atts['exclude-categories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'speaker-category',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'speaker-tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $atts['include-categories'] ) ) {

			$include_categories = $atts['include-categories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		if( !empty( $include_categories ) ) {

			$include_category_array = array(
				'taxonomy' => 'speaker-category',
				'field' => 'term_id',
				'terms' => $include_categories,
				'operator' => 'IN',
			);

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		if( !empty( $include_locations ) ) {

			$include_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $include_locations,
				'operator' => 'IN',
			);

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		if( !empty( $include_tags ) ) {

			$include_tags_array = array(
				'taxonomy' => 'speaker-tags',
				'field' => 'term_id',
				'terms' => $include_tags,
				'operator' => 'IN',
			);

		}

		/*====== Hide Empty Categories ======*/
		if( $atts['hide-empty-taxonomies'] == 'false' ) {

			$hide_empty_taxonomies = false;

		} else {

			$hide_empty_taxonomies = true;

		}

		/*====== Childless ======*/
		if( $atts['childless'] == 'false' ) {

			$childless = false;

		} else {

			$childless = true;

		}

		/*====== Category List Align ======*/
		if( !empty( $atts['category-list-align'] ) ) {

			$category_list_align = esc_attr( $atts['category-list-align'] );

		} else {

			$category_list_align = "center";

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'speaker',
			'tax_query' => array (
				'relation' => 'AND',
				$include_category_array,
				$include_tags_array,
				$include_location_array,
				$exclude_category_array,
				$exclude_tag_array,
				$exclude_location_array,
			)
		);

		$tab_arg = array(
			'post_status' => 'publish',
			'post_type' => 'speaker',
		);

		/*====== Count ======*/
		if( !empty( $atts["count"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["count"],
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Exclude Speakers ======*/
		$exclude_speakers = $atts['exclude-speakers'];

		if( !empty( $atts['exclude-speakers'] ) ) {

			$exclude_speakers = explode( ',', $exclude_speakers );

			if( !empty( $exclude_speakers ) ) {

				$extra_query = array(
					'post__not_in' => $exclude_speakers,
				);
				$arg = wp_parse_args( $arg, $extra_query );
				$tab_arg = wp_parse_args( $tab_arg, $extra_query );

			}

		}

		/*====== Order & Order By ======*/
		if( $atts["order"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		if( $atts["order-type"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["order-type"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["order-type"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["order-type"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["order-type"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["order-type"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["order-type"] == "none" ) {

			$order_by = "none";

		} elseif( $atts["order-type"] == "post__in" ) {

			$order_by = "post__in";

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Get Terms ======*/
		$category_terms = get_terms(
			array(
				'taxonomy' => 'speaker-category',
				'order' => $atts["taxonomy-order"],
				'orderby' => $atts["taxonomy-order-type"],
				'exclude' => $exclude_categories,
				'include' => $include_categories,
				'hide_empty' => $hide_empty_taxonomies,
				'childless' => $childless,
			)
		);

		/*====== HTML Output ======*/
		if( ! empty( $category_terms ) && ! is_wp_error( $category_terms ) ) {

			$output .= '<div class="gt-categorized-contents gt-tab-panel">';
				$output .= '<ul class="nav gt-nav gt-' . esc_attr( $category_list_align ) . '" role="tablist">';

					if( $atts["all-speakers-tab"] == "true" ) {

						$output .= '<li>';
							$output .= '<a href="#categorized-speakers-all" aria-controls="categorized-speakers-all" role="tab" data-toggle="tab" class="active">' . esc_html__( 'All', 'eventchamp' ) . '</a>';
						$output .= '</li>';

					}

					$i = 0;

					foreach ( $category_terms as $category_term ) {

						if( !empty( $category_term ) ) {

							$i++;

							$output .= '<li>';
								$output .= '<a href="#categorized-speakers-' . esc_attr( $category_term->slug ) . '-' . esc_attr( $i ) . '" aria-controls="categorized-speakers-' . esc_attr( $category_term->slug ) . '" role="tab" data-toggle="tab"' . ( $i == '1' && $atts["all-speakers-tab"] == "false"  ? ' class="active"' : '' )  . '>' . esc_attr( $category_term->name ) . '</a>';
							$output .= '</li>';

						}

					}

				$output .= '</ul>';

				$output .= '<div class="tab-content">';

					if( $atts["all-speakers-tab"] == "true" ) {

						$output .= '<div role="tabpanel" class="tab-pane fade active show" aria-labelledby="categorized-speakers-all" id="categorized-speakers-all">';

							$wp_query = new WP_Query( $arg );

							if( !empty( $wp_query ) ) {

								$output .= '<div class="gt-columns gt-column-' . esc_attr( $atts["column"] ) . '">';

									while( $wp_query->have_posts() ) {

										$wp_query->the_post();

										$output .= '<div class="gt-col">';
											$output .= '<div class="gt-inner">';

												if( $atts["style"] == "style-1" ) {

													$output .= eventchamp_speaker_style_1( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

												} elseif( $atts["style"] == "style-2" ) {

													$output .= eventchamp_speaker_style_2( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

												} elseif( $atts["style"] == "style-3" ) {

													$output .= eventchamp_speaker_style_3( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

												} elseif( $atts["style"] == "style-4" ) {

													$output .= eventchamp_speaker_style_4( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

												} elseif( $atts["style"] == "style-5" ) {

													$output .= eventchamp_speaker_style_5( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

												} elseif( $atts["style"] == "style-6" ) {

													$output .= eventchamp_speaker_style_6( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

												} elseif( $atts["style"] == "style-7" ) {

													$output .= eventchamp_speaker_style_7( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

												} elseif( $atts["style"] == "style-8" ) {

													$output .= eventchamp_speaker_style_8( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

												}

											$output .= '</div>';
										$output .= '</div>';

									}
									wp_reset_postdata();

								$output .= '</div>';

							}

							if( $atts["all-speakers-button"] == "true" ) {

								$output .= '<div class="gt-pagination">';
									$output .= '<a href="' . esc_url( get_post_type_archive_link( 'speaker' ) ) . '" class="gt-all-button">' . esc_html__( 'All Speakers', 'eventchamp' ) . '</a>';
								$output .= '</div>';

							}

						$output .= '</div>';
 
					}

					$i = 0;

					foreach ( $category_terms as $category_term ) {

						if( !empty( $category_term ) ) {

							$i++;

							$output .= '<div role="tabpanel" class="tab-pane fade' . ( $i == "1" && $atts["all-speakers-tab"] == "false" ? ' active show' : '' )  . '" id="categorized-speakers-' . esc_attr( $category_term->slug ) . '-' . esc_attr( $i ) . '" aria-labelledby="categorized-speakers-' . esc_attr( $category_term->slug ) . '">';

								$tax_extra_query = array(
									'tax_query' => array(
										'relation' => 'AND',
										$include_category_array,
										$include_tags_array,
										$include_location_array,
										$exclude_category_array,
										$exclude_tag_array,
										$exclude_location_array,
										array(
											'taxonomy' => 'speaker-category',
											'field' => 'slug',
											'terms' => array( $category_term->slug ),
										),
									),
								);

								$tab_arg_tab = wp_parse_args( $tab_arg, $tax_extra_query );

								$wp_query_tab = new WP_Query( $tab_arg_tab );

								if( !empty( $wp_query_tab ) ) {

									$output .= '<div class="gt-columns gt-column-' . esc_attr( $atts["column"] ) . '">';

										while( $wp_query_tab->have_posts() ) {

											$wp_query_tab->the_post();

											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';

													if( $atts["style"] == "style-1" ) {

														$output .= eventchamp_speaker_style_1( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

													} elseif( $atts["style"] == "style-2" ) {

														$output .= eventchamp_speaker_style_2( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

													} elseif( $atts["style"] == "style-3" ) {

														$output .= eventchamp_speaker_style_3( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

													} elseif( $atts["style"] == "style-4" ) {

														$output .= eventchamp_speaker_style_4( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

													} elseif( $atts["style"] == "style-5" ) {

														$output .= eventchamp_speaker_style_5( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

													} elseif( $atts["style"] == "style-6" ) {

														$output .= eventchamp_speaker_style_6( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

													} elseif( $atts["style"] == "style-7" ) {

														$output .= eventchamp_speaker_style_7( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

													} elseif( $atts["style"] == "style-8" ) {

														$output .= eventchamp_speaker_style_8( $post_id = get_the_ID(), $image = "true", $profession = esc_attr( $atts["profession-company"] ), $summary = esc_attr( $atts["short-biography"] ), $social = esc_attr( $atts["social-links"] ) );

													}

												$output .= '</div>';
											$output .= '</div>';

										}

									$output .= '</div>';

									if( $atts["all-speakers-button"] == "true" ) {

										$output .= '<div class="gt-pagination">';
											$output .= '<a href="' . esc_url( get_term_link( $category_term->term_id ) . '?post_type=speaker' ) . '" class="gt-all-button">';
												$output .= sprintf( esc_html__( 'All %1$s Speakers', 'eventchamp' ), esc_attr( $category_term->name ) );
											$output .= '</a>';
										$output .= '</div>';

									}

								}
								wp_reset_postdata();

							$output .= '</div>';

						}

					}

				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_categorized_speakers", "eventchamp_categorized_speakers_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Categorized Speakers', 'eventchamp' ),
				"base" => "eventchamp_categorized_speakers",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/categorized-speakers.jpg',
				"description" => esc_html__( 'Categorized speakers element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "count",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count for each tab.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-speakers",
						"heading" => esc_html__( 'Exclude Speakers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter speaker ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "order",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "order-type",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-categories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-categories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "taxonomy-order",
						"heading" => esc_html__( 'Taxonomy Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "taxonomy-order-type",
						"heading" => esc_html__( 'Taxonomy Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Name', 'eventchamp' ) => 'name',
							esc_html__( 'Slug', 'eventchamp' ) => 'slug',
							esc_html__( 'Term Group', 'eventchamp' ) => 'term_group',
							esc_html__( 'Term ID', 'eventchamp' ) => 'term_id',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Description', 'eventchamp' ) => 'description',
							esc_html__( 'Parent', 'eventchamp' ) => 'parent',
							esc_html__( 'Count', 'eventchamp' ) => 'count',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-empty-taxonomies",
						"heading" => esc_html__( 'Hide Empty Taxonomies', 'eventchamp' ),
						"description" => esc_html__( 'You can choose visible status of the empty taxonomies. If you choose true option empty taxonomies will be hide.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "childless",
						"heading" => esc_html__( 'Childless', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the childless taxonomies.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "category-list-align",
						"heading" => esc_html__( 'Category List Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose align of the category list.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style-3',
							esc_html__( 'Style 4', 'eventchamp' ) => 'style-4',
							esc_html__( 'Style 5', 'eventchamp' ) => 'style-5',
							esc_html__( 'Style 6', 'eventchamp' ) => 'style-6',
							esc_html__( 'Style 7', 'eventchamp' ) => 'style-7',
							esc_html__( 'Style 8', 'eventchamp' ) => 'style-8',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "all-speakers-tab",
						"heading" => esc_html__( 'All Speakers Tab', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the all speakers tab.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "all-speakers-button",
						"heading" => esc_html__( 'All Speakers Button', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the all speakers button.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "profession-company",
						"heading" => esc_html__( 'Profession / Company', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the profession / company info. You can choose the field you want to show from the Theme Settings > Speakers page.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "short-biography",
						"heading" => esc_html__( 'Short Biography', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the short biography.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "social-links",
						"heading" => esc_html__( 'Social Links', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the social links.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Venue Listing
*
======*/
if( !function_exists( 'eventchamp_venues_list_grid_output' ) ) {

	function eventchamp_venues_list_grid_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'venuecount' => '',
				'include-venues' => '',
				'excludevenues' => '',
				'offset' => '',
				'ordertype' => '',
				'sortby' => '',
				'pagination' => '',
				'exclude-categories' => '',
				'exclude-locations' => '',
				'exclude-tags' => '',
				'include-categories' => '',
				'include-locations' => '',
				'include-tags' => '',
				'column' => '',
				'location' => '',
				'excerpt' => '',
			), $atts
		);

		$output = "";

		/*====== Location Status ======*/
		if( $atts["location"] == "true" ) {

			$location_status = "true";

		} else {

			$location_status = "false";

		}

		/*====== Excerpt Status ======*/
		if( $atts["excerpt"] == "true" ) {

			$excerpt_status = "true";

		} else {

			$excerpt_status = "false";

		}

		/*====== Column ======*/
		if( !empty( $atts['column'] ) ) {

			$column = esc_attr( $atts["column"] );

		} else {

			$column = "column-1";

		}

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['exclude-categories'] ) ) {

			$exclude_categories = $atts['exclude-categories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'venuecat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $atts['include-categories'] ) ) {

			$include_categories = $atts['include-categories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		if( !empty( $include_categories ) ) {

			$include_category_array = array(
				'taxonomy' => 'venuecat',
				'field' => 'term_id',
				'terms' => $include_categories,
				'operator' => 'IN',
			);

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		if( !empty( $include_locations ) ) {

			$include_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $include_locations,
				'operator' => 'IN',
			);

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		if( !empty( $include_tags ) ) {

			$include_tags_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $include_tags,
				'operator' => 'IN',
			);

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'venue',
			'tax_query' => array (
				'relation' => 'AND',
				$include_location_array,
				$include_category_array,
				$include_tags_array,
				$exclude_category_array,
				$exclude_location_array,
				$exclude_tag_array,
			)
		);

		/*====== Pagination ======*/
		$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );

		if( empty( $paged ) ) {

			$paged = 1;

		}

		if( !empty( $paged ) ) {

			$extra_query = array(
				'paged' => $paged,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Venues ======*/
		if( !empty( $atts['include-venues'] ) ) {

			$venue_ids = $atts['include-venues'];
			$include_venues = explode( ',', $venue_ids );

		} else {

			$include_venues = "";

		}

		if( !empty( $include_venues ) ) {

			$extra_query = array(
				'post__in' => $include_venues,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Event Count ======*/
		if( !empty( $atts["venuecount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["venuecount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Events ======*/
		$excludevenues = $atts['excludevenues'];

		if( !empty( $excludevenues ) ) {

			$exclude_venues = $excludevenues;
			$exclude_venues = explode( ',', $exclude_venues );

		} else {

			$exclude_venues = array();

		}

		if( !empty( $exclude_venues ) ) {

			$extra_query = array(
				'post__not_in' => $exclude_venues,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order & Order By ======*/
		if( $atts["ordertype"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		if( $atts["sortby"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["sortby"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["sortby"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["sortby"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["sortby"] == "none" ) {

			$order_by = "none";

		} elseif( $atts["sortby"] == "post__in" ) {

			$order_by = "post__in";

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== HTML Output ======*/
		$wp_query = new WP_Query( $arg );

		if( !empty( $wp_query ) ) {

			$output .= '<div class="gt-venue-listing">';
				$output .= '<div class="gt-columns gt-' . esc_attr( $column ) . '">';

					while( $wp_query->have_posts() ) {

						$wp_query->the_post();

						$output .= '<div class="gt-col">';
							$output .= '<div class="gt-inner">';
								$output .= eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = $location_status, $excerpt = $excerpt_status );
							$output .= '</div>';
						$output .= '</div>';

					}

				$output .= '</div>';


				if( $atts['pagination'] == 'true' ) {

					$output .= eventchamp_element_pagination( $paged = $paged, $query = $wp_query );

				}

			$output .= '</div>';

		}
		wp_reset_postdata();

		return $output;

	}
	add_shortcode( "eventchamp_venues_list_grid", "eventchamp_venues_list_grid_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Venue Listing', 'eventchamp' ),
				"base" => "eventchamp_venues_list_grid",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/venue-listing.jpg',
				"description" => esc_html__( 'Venue listing element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "venuecount",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
					),
					array(
						"type" => "textfield",
						"param_name" => "include-venues",
						"heading" => esc_html__( 'Include Venues', 'eventchamp' ),
						"description" => esc_html__( 'You can enter venue ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
					),
					array(
						"type" => "textfield",
						"param_name" => "excludevenues",
						"heading" => esc_html__( 'Exclude Venues', 'eventchamp' ),
						"description" => esc_html__( 'You can enter venue ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
					),
					array(
						"type" => "dropdown",
						"param_name" => "ordertype",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sortby",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "pagination",
						"heading" => esc_html__( 'Pagination', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-categories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					),
					array(
						"type" => "textfield",
						"param_name" => "include-categories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => 'column-1',
							esc_html__( '2 Column', 'eventchamp' ) => 'column-2',
							esc_html__( '3 Column', 'eventchamp' ) => 'column-3',
							esc_html__( '4 Column', 'eventchamp' ) => 'column-4',
							esc_html__( '5 Column', 'eventchamp' ) => 'column-5',
							esc_html__( '6 Column', 'eventchamp' ) => 'column-6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "location",
						"heading" => esc_html__( 'Location', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the venue location.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "excerpt",
						"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the venue excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Categorized Venues
*
======*/
if( !function_exists( 'eventchamp_categorized_venues_output' ) ) {

	function eventchamp_categorized_venues_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'count' => '',
				'exclude-venues' => '',
				'offset' => '',
				'order' => '',
				'order-type' => '',
				'exclude-categories' => '',
				'exclude-locations' => '',
				'exclude-tags' => '',
				'include-categories' => '',
				'include-locations' => '',
				'include-tags' => '',
				'taxonomy-order' => '',
				'taxonomy-order-type' => '',
				'hide-empty-taxonomies' => '',
				'childless' => '',
				'category-list-align' => '',
				'column' => '',
				'all-venues-tab' => '',
				'all-venues-button' => '',
				'location' => '',
				'excerpt' => '',
			), $atts
		);

		$output = "";

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['exclude-categories'] ) ) {

			$exclude_categories = $atts['exclude-categories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'venuecat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'venue_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $atts['include-categories'] ) ) {

			$include_categories = $atts['include-categories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		if( !empty( $include_categories ) ) {

			$include_category_array = array(
				'taxonomy' => 'venuecat',
				'field' => 'term_id',
				'terms' => $include_categories,
				'operator' => 'IN',
			);

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		if( !empty( $include_locations ) ) {

			$include_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $include_locations,
				'operator' => 'IN',
			);

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		if( !empty( $include_tags ) ) {

			$include_tags_array = array(
				'taxonomy' => 'venue_tags',
				'field' => 'term_id',
				'terms' => $include_tags,
				'operator' => 'IN',
			);

		}

		/*====== Hide Empty Categories ======*/
		if( $atts['hide-empty-taxonomies'] == 'false' ) {

			$hide_empty_taxonomies = false;

		} else {

			$hide_empty_taxonomies = true;

		}

		/*====== Childless ======*/
		if( $atts['childless'] == 'false' ) {

			$childless = false;

		} else {

			$childless = true;

		}

		/*====== Category List Align ======*/
		if( !empty( $atts['category-list-align'] ) ) {

			$category_list_align = esc_attr( $atts['category-list-align'] );

		} else {

			$category_list_align = "center";

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'venue',
			'tax_query' => array (
				'relation' => 'AND',
				$include_category_array,
				$include_tags_array,
				$include_location_array,
				$exclude_category_array,
				$exclude_tag_array,
				$exclude_location_array,
			)
		);

		$tab_arg = array(
			'post_status' => 'publish',
			'post_type' => 'venue',
		);

		/*====== Count ======*/
		if( !empty( $atts["count"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["count"],
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Exclude Venues ======*/
		$exclude_venues = $atts['exclude-venues'];

		if( !empty( $atts['exclude-venues'] ) ) {

			$exclude_venues = explode( ',', $exclude_venues );

			if( !empty( $exclude_venues ) ) {

				$extra_query = array(
					'post__not_in' => $exclude_venues,
				);
				$arg = wp_parse_args( $arg, $extra_query );
				$tab_arg = wp_parse_args( $tab_arg, $extra_query );

			}

		}

		/*====== Order & Order By ======*/
		if( $atts["order"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		if( $atts["order-type"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["order-type"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["order-type"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["order-type"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["order-type"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["order-type"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["order-type"] == "none" ) {

			$order_by = "none";

		} elseif( $atts["order-type"] == "post__in" ) {

			$order_by = "post__in";

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );
			$tab_arg = wp_parse_args( $tab_arg, $extra_query );

		}

		/*====== Get Terms ======*/
		$category_terms = get_terms(
			array(
				'taxonomy' => 'venuecat',
				'order' => $atts["taxonomy-order"],
				'orderby' => $atts["taxonomy-order-type"],
				'exclude' => $exclude_categories,
				'include' => $include_categories,
				'hide_empty' => $hide_empty_taxonomies,
				'childless' => $childless,
			)
		);

		/*====== HTML Output ======*/
		if( ! empty( $category_terms ) && ! is_wp_error( $category_terms ) ) {

			$output .= '<div class="gt-categorized-contents gt-tab-panel">';
				$output .= '<ul class="nav gt-nav gt-' . esc_attr( $category_list_align ) . '" role="tablist">';

					if( $atts["all-venues-tab"] == "true" ) {

						$output .= '<li>';
							$output .= '<a href="#categorized-venues-all" aria-controls="categorized-venues-all" role="tab" data-toggle="tab" class="active">' . esc_html__( 'All', 'eventchamp' ) . '</a>';
						$output .= '</li>';

					}

					$i = 0;

					foreach ( $category_terms as $category_term ) {

						if( !empty( $category_term ) ) {

							$i++;

							$output .= '<li>';
								$output .= '<a href="#categorized-venues-' . esc_attr( $category_term->slug ) . '-' . esc_attr( $i ) . '" aria-controls="categorized-venues-' . esc_attr( $category_term->slug ) . '" role="tab" data-toggle="tab"' . ( $i == '1' && $atts["all-venues-tab"] == "false"  ? ' class="active"' : '' )  . '>' . esc_attr( $category_term->name ) . '</a>';
							$output .= '</li>';

						}

					}

				$output .= '</ul>';

				$output .= '<div class="tab-content">';

					if( $atts["all-venues-tab"] == "true" ) {

						$output .= '<div role="tabpanel" class="tab-pane fade active show" aria-labelledby="categorized-venues-all" id="categorized-venues-all">';

							$wp_query = new WP_Query( $arg );

							if( !empty( $wp_query ) ) {

								$output .= '<div class="gt-columns gt-column-' . esc_attr( $atts["column"] ) . '">';

									while( $wp_query->have_posts() ) {

										$wp_query->the_post();

										$output .= '<div class="gt-col">';
											$output .= '<div class="gt-inner">';
												$output .= eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = $atts["location"], $excerpt = $atts["excerpt"] );
											$output .= '</div>';
										$output .= '</div>';

									}
									wp_reset_postdata();

								$output .= '</div>';

							}

							if( $atts["all-venues-button"] == "true" ) {

								$output .= '<div class="gt-pagination">';
									$output .= '<a href="' . esc_url( get_post_type_archive_link( 'venue' ) ) . '" class="gt-all-button">' . esc_html__( 'All Venues', 'eventchamp' ) . '</a>';
								$output .= '</div>';

							}

						$output .= '</div>';
 
					}

					$i = 0;

					foreach ( $category_terms as $category_term ) {

						if( !empty( $category_term ) ) {

							$i++;

							$output .= '<div role="tabpanel" class="tab-pane fade' . ( $i == "1" && $atts["all-venues-tab"] == "false" ? ' active show' : '' )  . '" id="categorized-venues-' . esc_attr( $category_term->slug ) . '-' . esc_attr( $i ) . '" aria-labelledby="categorized-venuesvenuesvenues-' . esc_attr( $category_term->slug ) . '">';

								$tax_extra_query = array(
									'tax_query' => array(
										'relation' => 'AND',
										$include_category_array,
										$include_tags_array,
										$include_location_array,
										$exclude_category_array,
										$exclude_tag_array,
										$exclude_location_array,
										array(
											'taxonomy' => 'venuecat',
											'field' => 'slug',
											'terms' => array( $category_term->slug ),
										),
									),
								);

								$tab_arg_tab = wp_parse_args( $tab_arg, $tax_extra_query );

								$wp_query_tab = new WP_Query( $tab_arg_tab );

								if( !empty( $wp_query_tab ) ) {

									$output .= '<div class="gt-columns gt-column-' . esc_attr( $atts["column"] ) . '">';

										while( $wp_query_tab->have_posts() ) {

											$wp_query_tab->the_post();

											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';
													$output .= eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = $atts["location"], $excerpt = $atts["excerpt"] );
												$output .= '</div>';
											$output .= '</div>';

										}

									$output .= '</div>';

									if( $atts["all-venues-button"] == "true" ) {

										$output .= '<div class="gt-pagination">';
											$output .= '<a href="' . esc_url( get_term_link( $category_term->term_id ) . '?post_type=venue' ) . '" class="gt-all-button">';
												$output .= sprintf( esc_html__( 'All %1$s Venues', 'eventchamp' ), esc_attr( $category_term->name ) );
											$output .= '</a>';
										$output .= '</div>';

									}

								}
								wp_reset_postdata();

							$output .= '</div>';

						}

					}

				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_categorized_venues", "eventchamp_categorized_venues_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Categorized Venues', 'eventchamp' ),
				"base" => "eventchamp_categorized_venues",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/categorized-venues.jpg',
				"description" => esc_html__( 'Categorized venues element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "count",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count for each tab.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-venues",
						"heading" => esc_html__( 'Exclude Venues', 'eventchamp' ),
						"description" => esc_html__( 'You can enter venue ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "order",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "order-type",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-categories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-categories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "taxonomy-order",
						"heading" => esc_html__( 'Taxonomy Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "taxonomy-order-type",
						"heading" => esc_html__( 'Taxonomy Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Name', 'eventchamp' ) => 'name',
							esc_html__( 'Slug', 'eventchamp' ) => 'slug',
							esc_html__( 'Term Group', 'eventchamp' ) => 'term_group',
							esc_html__( 'Term ID', 'eventchamp' ) => 'term_id',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Description', 'eventchamp' ) => 'description',
							esc_html__( 'Parent', 'eventchamp' ) => 'parent',
							esc_html__( 'Count', 'eventchamp' ) => 'count',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-empty-taxonomies",
						"heading" => esc_html__( 'Hide Empty Taxonomies', 'eventchamp' ),
						"description" => esc_html__( 'You can choose visible status of the empty taxonomies. If you choose true option empty taxonomies will be hide.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "childless",
						"heading" => esc_html__( 'Childless', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the childless taxonomies.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "category-list-align",
						"heading" => esc_html__( 'Category List Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose align of the category list.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "all-venues-tab",
						"heading" => esc_html__( 'All Venues Tab', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the all venues tab.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "all-venues-button",
						"heading" => esc_html__( 'All Venues Button', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the all venues button.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "location",
						"heading" => esc_html__( 'Location', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the venue location.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "excerpt",
						"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the venue excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Venues Carousel
*
======*/
if( !function_exists( 'eventchamp_venues_list_carousel_output' ) ) {

	function eventchamp_venues_list_carousel_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'venuecount' => '',
				'include-venues' => '',
				'excludevenues' => '',
				'offset' => '',
				'ordertype' => '',
				'sortby' => '',
				'exclude-categories' => '',
				'exclude-locations' => '',
				'exclude-tags' => '',
				'include-categories' => '',
				'include-locations' => '',
				'include-tags' => '',
				'style' => '',
				'allbutton' => '',
				'location' => '',
				'excerpt' => '',
				'column' => '',
				'slider-space' => '',
				'slider-autoplay' => '',
				'slider-autoplay-delay' => '',
				'slider-loop' => '',
				'slider-slide-speed' => '',
				'slider-centered-slides' => '',
				'slider-direction' => '',
				'slider-effect' => '',
				'slider-free-mode' => '',
				'navbuttons' => '',
			), $atts
		);

		$output = "";

		/*====== Column ======*/
		if( empty( $atts["column"] ) ) {

			$atts["column"] = "1";

		}

		/*====== Location Status ======*/
		if( $atts["location"] == "true" ) {

			$location_status = "true";

		} else {

			$location_status = "false";

		}

		/*====== Excerpt Status ======*/
		if( $atts["excerpt"] == "true" ) {

			$excerpt_status = "true";

		} else {

			$excerpt_status = "false";

		}

		/*====== Column Space ======*/
		if( empty( $atts["slider-space"] ) ) {

			$atts["slider-space"] = "30";

		}

		/*====== Slider Autoplay ======*/
		if( empty( $atts["slider-autoplay"] ) ) {

			$atts["slider-autoplay"] = "false";

		}

		/*====== Slider Autoplay Delay ======*/
		if( empty( $atts["slider-autoplay-delay"] ) ) {

			$atts["slider-autoplay-delay"] = "15000";

		}

		/*====== Slider Loop ======*/
		if( empty( $atts["slider-loop"] ) ) {

			$atts["slider-loop"] = "false";

		}

		/*====== Slider Slide Speed ======*/
		if( empty( $atts["slider-slide-speed"] ) ) {

			$atts["slider-slide-speed"] = "1000";

		}

		/*====== Centered Slides ======*/
		if( empty( $atts["slider-centered-slides"] ) ) {

			$atts["slider-centered-slides"] = "false";

		}

		/*====== Slider Direction ======*/
		if( empty( $atts["slider-direction"] ) ) {

			$atts["slider-direction"] = "horizontal";

		}

		/*====== Slider Effect ======*/
		if( empty( $atts["slider-effect"] ) ) {

			$atts["slider-effect"] = "slide";

		}

		/*====== Slider Free Mode ======*/
		if( empty( $atts["slider-free-mode"] ) ) {

			$atts["slider-free-mode"] = "false";

		}

		/*====== Navigation ======*/
		if( empty( $atts["navbuttons"] ) ) {

			$atts["navbuttons"] = "false";

		}

		/*====== Exclude Categories ======*/
		$exclude_category_array = "";

		if( !empty( $atts['exclude-categories'] ) ) {

			$exclude_categories = $atts['exclude-categories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		if( !empty( $exclude_categories ) ) {

			$exclude_category_array = array(
				'taxonomy' => 'venuecat',
				'field' => 'term_id',
				'terms' => $exclude_categories,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Locations ======*/
		$exclude_location_array = "";

		if( !empty( $atts['exclude-locations'] ) ) {

			$exclude_locations = $atts['exclude-locations'];
			$exclude_locations = explode( ',', $exclude_locations );

		} else {

			$exclude_locations = "";

		}

		if( !empty( $exclude_locations ) ) {

			$exclude_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $exclude_locations,
				'operator' => 'NOT IN',
			);

		}

		/*====== Exclude Tags ======*/
		$exclude_tag_array = "";

		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		if( !empty( $exclude_tags ) ) {

			$exclude_tag_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $exclude_tags,
				'operator' => 'NOT IN',
			);

		}

		/*====== Include Categories ======*/
		$include_category_array = "";

		if( !empty( $atts['include-categories'] ) ) {

			$include_categories = $atts['include-categories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		if( !empty( $include_categories ) ) {

			$include_category_array = array(
				'taxonomy' => 'venuecat',
				'field' => 'term_id',
				'terms' => $include_categories,
				'operator' => 'IN',
			);

		}

		/*====== Include Locations ======*/
		$include_location_array = "";

		if( !empty( $atts['include-locations'] ) ) {

			$include_locations = $atts['include-locations'];
			$include_locations = explode( ',', $include_locations );

		} else {

			$include_locations = "";

		}

		if( !empty( $include_locations ) ) {

			$include_location_array = array(
				'taxonomy' => 'location',
				'field' => 'term_id',
				'terms' => $include_locations,
				'operator' => 'IN',
			);

		}

		/*====== Include Tags ======*/
		$include_tags_array = "";

		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		if( !empty( $include_tags ) ) {

			$include_tags_array = array(
				'taxonomy' => 'event_tags',
				'field' => 'term_id',
				'terms' => $include_tags,
				'operator' => 'IN',
			);

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'venue',
			'tax_query' => array (
				'relation' => 'AND',
				$include_location_array,
				$include_category_array,
				$include_tags_array,
				$exclude_category_array,
				$exclude_location_array,
				$exclude_tag_array,
			)
		);

		/*====== Pagination ======*/
		$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );

		if( empty( $paged ) ) {

			$paged = 1;

		}

		if( !empty( $paged ) ) {
			$extra_query = array(
				'paged' => $paged,
			);
			$arg = wp_parse_args( $arg, $extra_query );
		}

		/*====== Include Venues ======*/
		if( !empty( $atts['include-venues'] ) ) {

			$venue_ids = $atts['include-venues'];
			$include_venues = explode( ',', $venue_ids );

		} else {

			$include_venues = "";

		}

		if( !empty( $include_venues ) ) {

			$extra_query = array(
				'post__in' => $include_venues,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Event Count ======*/
		if( !empty( $atts["venuecount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["venuecount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Events ======*/
		$excludevenues = $atts['excludevenues'];

		if( !empty( $excludevenues ) ) {

			$exclude_venues = $excludevenues;
			$exclude_venues = explode( ',', $exclude_venues );

		} else {

			$exclude_venues = array();

		}

		if( !empty( $exclude_venues ) ) {

			$extra_query = array(
				'post__not_in' => $exclude_venues,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order & Order By ======*/
		if( $atts["ordertype"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		if( $atts["sortby"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["sortby"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["sortby"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["sortby"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["sortby"] == "none" ) {

			$order_by = "none";

		} elseif( $atts["sortby"] == "post__in" ) {

			$order_by = "post__in";

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== HTML Output ======*/
		$wp_query = new WP_Query( $arg );

		if( !empty( $wp_query ) ) {

			$output .= '<div class="gt-venues-carousel gt-' . esc_attr( $atts["style"] ) . '">';
				$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item="' . esc_attr( $atts["column"] ) . '" data-gt-item-space="' . esc_attr( $atts["slider-space"] ) . '" data-gt-loop="' . esc_attr( $atts["slider-loop"] ) . '" data-gt-speed="' . esc_attr( $atts["slider-slide-speed"] ) . '" data-gt-direction="' . esc_attr( $atts["slider-direction"] ) . '" data-gt-effect="' . esc_attr( $atts["slider-effect"] ) . '" data-gt-centered-slides="' . esc_attr( $atts["slider-centered-slides"] ) . '" data-gt-free-mode="' . esc_attr( $atts["slider-free-mode"] ) . '">';
					$output .= '<div class="swiper-wrapper">';

						while( $wp_query->have_posts() ) {

							$wp_query->the_post();

							if( $atts["slider-autoplay"] == "true" ) {

								$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $atts["slider-autoplay-delay"] ) . '">';

							} else {

								$output .= '<div class="swiper-slide">';

							}

								if( $atts["style"] == "white" or $atts["style"] == "dark" ) {

									$output .= eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = $location_status, $excerpt = $excerpt_status );
								}

							$output .= '</div>';

						}

					$output .= '</div>';
					$output .= '<div class="gt-pagination">';

						if( $atts["navbuttons"] == "true" ) {

							$output .= '<div class="gt-slider-prev">';
								$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
							$output .= '</div>';

						}

						if( $atts["allbutton"] == "true" ) {

							$output .= '<div>';
								$output .= '<a href="' . esc_url( get_post_type_archive_link( 'venue' ) ) . '" class="gt-all-button">' . esc_html__( 'All Venues', 'eventchamp' ) . '</a>';
							$output .= '</div>';

						}

						if( $atts["navbuttons"] == "true" ) {

							$output .= '<div class="gt-slider-next">';
								$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
							$output .= '</div>';

						}

					$output .= '</div>';

				$output .= '</div>';
			$output .= '</div>';

		}
		wp_reset_postdata();

		return $output;

	}
	add_shortcode( "eventchamp_venues_list_carousel", "eventchamp_venues_list_carousel_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Venues Carousel', 'eventchamp' ),
				"base" => "eventchamp_venues_list_carousel",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/venues-carousel.jpg',
				"description" => esc_html__( 'Venues carousel element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "venuecount",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-venues",
						"heading" => esc_html__( 'Include Venues', 'eventchamp' ),
						"description" => esc_html__( 'You can enter venue ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "excludevenues",
						"heading" => esc_html__( 'Exclude Venues', 'eventchamp' ),
						"description" => esc_html__( 'You can enter venue ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "ordertype",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sortby",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'By Include IDs', 'eventchamp' ) => 'post__in',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-categories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter categories ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-locations",
						"heading" => esc_html__( 'Exclude Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-categories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-locations",
						"heading" => esc_html__( 'Include Locations', 'eventchamp' ),
						"description" => esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a tag. Example: Event.', 'eventchamp' ),
						"group" => esc_html__( 'Taxonomies', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'dark',
							esc_html__( 'Style 2', 'eventchamp' ) => 'white',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "allbutton",
						"heading" => esc_html__( 'All Venues Button', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of all venues button.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "location",
						"heading" => esc_html__( 'Location', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the venue location.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "excerpt",
						"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the venue excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-space",
						"heading" => esc_html__( 'Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a space value for space between the slides.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0px', 'eventchamp' ) => '0',
							esc_html__( '1px', 'eventchamp' ) => '1',
							esc_html__( '2px', 'eventchamp' ) => '2',
							esc_html__( '3px', 'eventchamp' ) => '3',
							esc_html__( '4px', 'eventchamp' ) => '4',
							esc_html__( '5px', 'eventchamp' ) => '5',
							esc_html__( '10px', 'eventchamp' ) => '10',
							esc_html__( '15px', 'eventchamp' ) => '15',
							esc_html__( '20px', 'eventchamp' ) => '20',
							esc_html__( '25px', 'eventchamp' ) => '25',
							esc_html__( '30px', 'eventchamp' ) => '30',
							esc_html__( '45px', 'eventchamp' ) => '45',
							esc_html__( '50px', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-autoplay",
						"heading" => esc_html__( 'Slider Autoplay', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the autoplay.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-autoplay-delay",
						"heading" => esc_html__( 'Slider Autoplay Delay', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an autoplay delay value. Default: 15000', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-loop",
						"heading" => esc_html__( 'Slider Loop', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the loop.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-slide-speed",
						"heading" => esc_html__( 'Slide Speed', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a slide speed. Duration of transition between the slides. Default: 1500', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-centered-slides",
						"heading" => esc_html__( 'Centered Slides', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the centered slides. If you choose true, then active slide will be centered, not always on the left side.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-direction",
						"heading" => esc_html__( 'Slider Direction', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a direction.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Horizontal', 'eventchamp' ) => 'horizontal',
							esc_html__( 'Vertical', 'eventchamp' ) => 'vertical',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-effect",
						"heading" => esc_html__( 'Slider Effect', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an effect.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Slide', 'eventchamp' ) => 'slide',
							esc_html__( 'Fade', 'eventchamp' ) => 'fade',
							esc_html__( 'Cube', 'eventchamp' ) => 'cube',
							esc_html__( 'Coverflow', 'eventchamp' ) => 'coverflow',
							esc_html__( 'Flip', 'eventchamp' ) => 'flip',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-free-mode",
						"heading" => esc_html__( 'Free Mode', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the free mode. If true then slides will not have fixed positions', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "navbuttons",
						"heading" => esc_html__( 'Navigation', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the navigation.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Sponsors
*
======*/
if( !function_exists( 'eventchamp_sponsors_output' ) ) {

	function eventchamp_sponsors_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '1',
				'column' => '1',
				'column-space' => '0',
				'sponsors' => '',
			), $atts
		);

		$output = "";

		/*====== Sponsors ======*/
		$sponsors = vc_param_group_parse_atts( $atts['sponsors'] );

		/*====== HTML Output ======*/
		if( !empty( $sponsors ) ) {

			$output .= '<div class="gt-event-sponsors gt-type-1 gt-style-' . esc_attr( $atts["style"] ) . '">';
				$output .= '<div class="gt-columns gt-column-space-' . esc_attr( $atts["column-space"] ) . ' gt-column-' . esc_attr( $atts["column"] ) . '">';

					foreach( $sponsors as $sponsor ) {

						if( !empty( $sponsor ) ) {

							if( !empty( $sponsor["logo"] ) ) {

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= '<div class="gt-logo">';
										
											if( $sponsor["link-status"] == "true" ) {

												$link = $sponsor["link"];
												$link = vc_build_link( $link );

												if( !empty( $sponsor["link"] ) ) {

													if( !empty( $link["target"] ) ) {

														$link_target = $link["target"];

													} else {

														$link_target = "_parent";

													}

													$output .= '<a href="' . esc_url( $link["url"] ) . '" target="' . esc_attr( $link_target ) . '">';

												}

											}

												$output .= '<img data-src="' . esc_url( wp_get_attachment_image_src( esc_attr( $sponsor["logo"] ), 'eventchamp-event-sponsor-big' )[0] ) . '" class="gt-grayscale-' . esc_attr( $sponsor["grayscale"] ) . ' gt-lazy-load" alt="' . esc_attr( $sponsor["text"] ) . '">';

												if( !empty( $sponsor["text"] ) ) {

													$output .= '<span>' . esc_attr( $sponsor["text"] ) . '</span>';

												}

											if( $sponsor["link-status"] == "true" ) {

												$link = $sponsor["link"];
												$link = vc_build_link( $link );

												if( !empty( $sponsor["link"] ) ) {

													$output .= '</a>';

												}

											}

										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';

							}

						}

					}

				$output .= '</div>';
			$output .= '</div>';

			return $output;

		}

	}
	add_shortcode( "eventchamp_sponsors", "eventchamp_sponsors_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Sponsors', 'eventchamp' ),
				"base" => "eventchamp_sponsors",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/sponsors.jpg',
				"description" => esc_html__( 'You can create a sponsor list.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
							esc_html__( '7 Column', 'eventchamp' ) => '7',
							esc_html__( '8 Column', 'eventchamp' ) => '8',
							esc_html__( '9 Column', 'eventchamp' ) => '9',
							esc_html__( '10 Column', 'eventchamp' ) => '10',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column-space",
						"heading" => esc_html__( 'Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column space.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( '0', 'eventchamp' ) => '0',
							esc_html__( '5', 'eventchamp' ) => '5',
							esc_html__( '10', 'eventchamp' ) => '10',
							esc_html__( '15', 'eventchamp' ) => '15',
							esc_html__( '20', 'eventchamp' ) => '20',
							esc_html__( '25', 'eventchamp' ) => '25',
							esc_html__( '30', 'eventchamp' ) => '30',
							esc_html__( '35', 'eventchamp' ) => '35',
							esc_html__( '40', 'eventchamp' ) => '40',
							esc_html__( '45', 'eventchamp' ) => '45',
							esc_html__( '50', 'eventchamp' ) => '50',
						),
					),
					array(
						'type' => 'param_group',
						'param_name' => 'sponsors',
						"heading" => esc_html__( 'Clients', 'eventchamp' ),
						"description" => esc_html__( 'You can create sponsors from this panel.', 'eventchamp' ),
						"save_always" => true,
						'params' => array(
							array(
								"type" => "attach_image",
								"param_name" => "logo",
								"heading" => esc_html__( 'Logo', 'eventchamp' ),
								"description" => esc_html__( 'You can upload a client logo. Recommended size: 540x540', 'eventchamp' ),
								"admin_label" => true,
								"save_always" => true,
							),
							array(
								"type" => "textfield",
								"param_name" => "text",
								"heading" => esc_html__( 'Text', 'eventchamp' ),
								"description" => esc_html__( 'You can enter a text.', 'eventchamp' ),
								"admin_label" => true,
								"save_always" => true,
							),
							array(
								"type" => "dropdown",
								"param_name" => "grayscale",
								"heading" => esc_html__( 'Grayscale', 'eventchamp' ),
								"description" => esc_html__( 'You can choose status of the grayscale. You can make the logo gray.', 'eventchamp' ),
								"save_always" => true,
								"value" => array(
									esc_html__( 'False', 'eventchamp' ) => 'false',
									esc_html__( 'True', 'eventchamp' ) => 'true',
								),
							),
							array(
								"type" => "dropdown",
								"param_name" => "link-status",
								"heading" => esc_html__( 'Link Status', 'eventchamp' ),
								"description" => esc_html__( 'You can choose status of the link.', 'eventchamp' ),
								"save_always" => true,
								"value" => array(
									esc_html__( 'False', 'eventchamp' ) => 'false',
									esc_html__( 'True', 'eventchamp' ) => 'true',
								),
							),
							array(
								"type" => "vc_link",
								"param_name" => "link",
								"heading" => esc_html__( 'Link', 'eventchamp' ),
								"description" => esc_html__( 'You can create a link.', 'eventchamp' ),
								"save_always" => true,
							),
						)
					),
				),
			)
		);

	}

}



/*======
*
* Banner Box
*
======*/
if( !function_exists( 'eventchamp_banner_output' ) ) {

	function eventchamp_banner_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'bannertitleone' => '',
				'bannertitletwo' => '',
				'link' => '',
				'bannerbg' => '',
			), $atts
		);

		$output = "";

		if( !empty( $atts["bannertitleone"] ) or !empty( $atts["bannertitletwo"] ) or !empty( $atts["link"] ) ) {

			if( !empty( $atts["link"] ) ) {

				$href = $atts["link"];
				$href = vc_build_link( $href );

				if( !empty( $href["target"] ) ) {

					$target = $href["target"];

				} else {

					$target = "_parent";

				}

			}

			if( !empty( $atts["bannerbg"] ) ) {

				$bannerbg = esc_attr( $atts["bannerbg"] );

			} else {

				$bannerbg = "";

			}

			$output .= '<div class="gt-banner-box gt-lazy-load" data-bg="' . esc_url( wp_get_attachment_url( esc_attr( $bannerbg ), 'full', true, true ) ) . '">';

				if( !empty( $atts["link"] ) ) {

					$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';

				}

					$output .= '<div class="gt-content">';

						if( !empty( $atts["bannertitleone"] ) ) {

							$output .= '<span class="primary">' . esc_attr( $atts["bannertitleone"] ) . '</span>';

						}

						if( !empty( $atts["bannertitletwo"] ) ) {

							$output .= '<span class="secondary">' . esc_attr( $atts["bannertitletwo"] ) . '</span>';

						}

					$output .= '</div>';

				if( !empty( $atts["link"] ) ) {

					$output .= '</a>';

				}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_banner", "eventchamp_banner_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Banner Box', 'eventchamp' ),
				"base" => "eventchamp_banner",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/banner-box.jpg',
				"description" => esc_html__( 'Banner box element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "bannertitleone",
						"heading" => esc_html__( 'Primary Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "bannertitletwo",
						"heading" => esc_html__( 'Secondary Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "vc_link",
						"param_name" => "link",
						"heading" => esc_html__( 'Link', 'eventchamp' ),
						"description" => esc_html__( 'You can create a link.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "attach_image",
						"param_name" => "bannerbg",
						"heading" => esc_html__( 'Image', 'eventchamp' ),
						"description" => esc_html__( 'You can upload an image for background of the banner.', 'eventchamp' ),
						"save_always" => true,
					),
				),
			)
		);

	}

}



/*======
*
* Feature Box
*
======*/
if( !function_exists( 'eventchamp_feature_box_output' ) ) {

	function eventchamp_feature_box_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => 'style-1',
				'alignment' => 'left',
				'title' => '',
				'subtitle' => '',
				'content' => '',
				'number' => '',
				'image' => '',
				'image-background-color' => '',
				'opacity-effect' => 'false',
				'icon' => '',
				'svg-icon' => '',
				'link-status' => 'false',
				'link' => '',
			), $atts
		);

		$output = "";

		/*====== Content ======*/
		$atts['content'] = $content;

		/*====== Image Background Color ======*/
		if( !empty( $atts["image-background-color"] ) ) {

			$image_color = ' style="background-color:' . esc_attr( $atts["image-background-color"] ) . ';"';

		} else {

			$image_color = "";

		}

		/*====== HTML Output ======*/
		if( $atts["style"] == "style-1" ) {

			$output .= '<div class="gt-feature-box gt-align-' . esc_attr( $atts["alignment"] ) . ' gt-' . esc_attr( $atts["style"] ) . ' gt-opacity-effect-' . esc_attr( $atts["opacity-effect"] ) . '">';

				if( !empty( $atts["image"] ) ) {

					$output .= '<div class="gt-img"' . $image_color . '>';
						$output .= wp_get_attachment_image( $atts["image"], 'eventchamp-feature-box-1' );
					$output .= '</div>';

				}

				if( !empty( $atts["subtitle"] ) or !empty( $atts["title"] ) or !empty( $atts["content"] ) or !empty( $atts["number"] ) ) {

					$output .= '<div class="gt-content">';

						if( !empty( $atts["subtitle"] ) ) {

							$output .= '<div class="gt-subtitle">' . esc_attr( $atts["subtitle"] ) . '</div>';

						}

						if( !empty( $atts["title"] ) ) {

							$output .= '<h3 class="gt-title">' . esc_attr( $atts["title"] ) . '</h3>';

						}

						if( !empty( $atts["content"] ) ) {

							$output .= '<div class="gt-excerpt">' . wpautop( $atts["content"] ) . '</div>';

						}

						if( !empty( $atts["number"] ) ) {

							$output .= '<div class="gt-number">' . esc_attr( $atts["number"] ) . '</div>';

						}

						if( $atts["link-status"] == "true" ) {

							if( !empty( $atts["link"] ) ) {

								$link = $atts["link"];
								$link = vc_build_link( $link );

								if( !empty( $link["target"] ) ) {

									$link_target = $link["target"];

								} else {

									$link_target = "_parent";

								}

								if( !empty( $link["url"] ) ) {

									$output .= '<a href="' . esc_url( $link["url"] ) . '" target="' . esc_attr( $link_target ) . '" class="gt-btn gt-btn-primary">' . esc_attr( $link["title"] ) . '</a>';

								}

							}

						}

					$output .= '</div>';

				}

			$output .= '</div>';

		} elseif( $atts["style"] == "style-2" ) {

			$output .= '<div class="gt-feature-box gt-align-' . esc_attr( $atts["alignment"] ) . ' gt-' . esc_attr( $atts["style"] ) . '">';

				if( !empty( $atts["icon"] ) ) {

					$output .= '<div class="gt-icon">';
						$output .= '<i class="' . esc_attr( $atts["icon"] ) . '"></i>';
					$output .= '</div>';

				} elseif( !empty( $atts["svg-icon"] ) ) {

					$output .= '<div class="gt-icon">';
						$output .= rawurldecode( base64_decode( $atts["svg-icon"] ) );
					$output .= '</div>';

				}

				if( !empty( $atts["subtitle"] ) or !empty( $atts["title"] ) or !empty( $atts["content"] ) or !empty( $atts["number"] ) ) {

					$output .= '<div class="gt-content">';

						if( !empty( $atts["subtitle"] ) ) {

							$output .= '<div class="gt-subtitle">' . esc_attr( $atts["subtitle"] ) . '</div>';

						}

						if( !empty( $atts["title"] ) ) {

							$output .= '<h3 class="gt-title">' . esc_attr( $atts["title"] ) . '</h3>';

						}

						if( !empty( $atts["content"] ) ) {

							$output .= '<div class="gt-excerpt">' . wpautop( $atts["content"] ) . '</div>';

						}

						if( !empty( $atts["number"] ) ) {

							$output .= '<div class="gt-number">' . esc_attr( $atts["number"] ) . '</div>';

						}

						if( $atts["link-status"] == "true" ) {

							if( !empty( $atts["link"] ) ) {

								$link = $atts["link"];
								$link = vc_build_link( $link );

								if( !empty( $link["target"] ) ) {

									$link_target = $link["target"];

								} else {

									$link_target = "_parent";

								}

								if( !empty( $link["url"] ) ) {

									$output .= '<a href="' . esc_url( $link["url"] ) . '" target="' . esc_attr( $link_target ) . '" class="gt-btn gt-btn-primary">' . esc_attr( $link["title"] ) . '</a>';

								}

							}

						}

					$output .= '</div>';

				}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_feature_box", "eventchamp_feature_box_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Feature Box', 'eventchamp' ),
				"base" => "eventchamp_feature_box",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/feature-box.jpg',
				"description" => esc_html__( 'You can create a feature box.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "alignment",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "title",
						"heading" => esc_html__( 'Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "subtitle",
						"heading" => esc_html__( 'Subtitle', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a subtitle.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textarea_html",
						"param_name" => "content",
						"heading" => esc_html__( 'Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "number",
						"heading" => esc_html__( 'Number', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a number.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "attach_image",
						"param_name" => "image",
						"heading" => esc_html__( 'Image', 'eventchamp' ),
						"description" => esc_html__( 'You can upload an image for style 1. Recommended sizes: Style 1: 540x540', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "colorpicker",
						"param_name" => "image-background-color",
						"heading" => esc_html__( 'Image Background Color', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a background color for the feature box image.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "opacity-effect",
						"heading" => esc_html__( 'Opacity Effect', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the opacity effect.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "icon",
						"heading" => esc_html__( 'Font Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an icon for style 2. If you want to use SVG icon, enter blank it. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textarea_raw_html",
						"param_name" => "svg-icon",
						"heading" => esc_html__( 'SVG Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a SVG icon code.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "link-status",
						"heading" => esc_html__( 'Link Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the link.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "vc_link",
						"param_name" => "link",
						"heading" => esc_html__( 'Link', 'eventchamp' ),
						"description" => esc_html__( 'You can create a link.', 'eventchamp' ),
						"save_always" => true,
					),
				),
			)
		);

	}

}



/*======
*
* Service Box
*
======*/
if( !function_exists( 'eventchamp_service_box_output' ) ) {

	function eventchamp_service_box_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => 'style-1',
				'title' => '',
				'text' => '',
				'icon' => '',
				'svg-icon' => '',
				'servicelink' => '',
				'align' => 'left',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts["title"] ) or !empty( $atts["text"] ) ) {

			$output .= '<div class="gt-eventchamp-service-box gt-' . esc_attr( $atts["style"] ) . ' gt-align-' . esc_attr( $atts["align"] ) . '">';

				if( !empty( $atts["icon"] ) ) {

					$output .= '<div class="gt-icon">';
						$output .= '<i class="' . esc_attr( $atts["icon"] ) . '"></i>';
					$output .= '</div>';

				} elseif( !empty( $atts["svg-icon"] ) ) {

					$output .= '<div class="gt-icon">';
						$output .= rawurldecode( base64_decode( $atts["svg-icon"] ) );
					$output .= '</div>';

				}

					if( !empty( $atts["title"] ) ) {

						if( !empty( $atts["servicelink"] ) ) {

							$href = $atts["servicelink"];
							$href = vc_build_link( $href );

							if( !empty( $href["target"] ) ) {

								$target = $href["target"];

							} else {

								$target = "_parent";

							}

							if( !empty( $href["url"] ) ) {

								$output .= '<div class="title">';
									$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '" class="button-link">' . esc_attr( $atts["title"] ) . '</a>';
								$output .= '</div>';

							}

						} else {

							$output .= '<div class="gt-title">' . esc_attr( $atts["title"] ) . '</div>';

						}

					}

				if( !empty( $atts["text"] ) ) {

					$output .= wpautop( esc_attr( $atts["text"] ) );

				}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_service_box", "eventchamp_service_box_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Service Box', 'eventchamp' ),
				"base" => "eventchamp_service_box",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/service-box.jpg',
				"description" => esc_html__( 'Service Box element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"admin_label" => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "align",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "title",
						"heading" => esc_html__( 'Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "text",
						"heading" => esc_html__( 'Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "icon",
						"heading" => esc_html__( 'Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an icon. If you want to use SVG icon, enter blank it. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textarea_raw_html",
						"param_name" => "svg-icon",
						"heading" => esc_html__( 'SVG Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a SVG icon code.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "vc_link",
						"param_name" => "servicelink",
						"heading" => esc_html__( 'Link', 'eventchamp' ),
						"description" => esc_html__( 'You can crete a link.', 'eventchamp' ),
						"save_always" => true,
					),
				),
			)
		);

	}

}



/*======
*
* Blog
*
======*/
if( !function_exists( 'eventchamp_latest_posts_output' ) ) {

	function eventchamp_latest_posts_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'postcount' => '',
				'category' => '',
				'postids' => '',
				'excludeposts' => '',
				'posttag' => '',
				'offset' => '',
				'ordertype' => '',
				'sortby' => '',
				'ignore-sticky-posts' => '',
				'pagination' => '',
				'style' => '',
				'categoryname' => '',
				'postinformation' => '',
				'excerpt' => '',
				'readmore' => '',
			), $atts
		);
		
		$output = '';

		/*====== Category Name Status ======*/
		if( $atts['categoryname'] == "true" ) {

			$category_status = "true";

		} else {

			$category_status = "";

		}

		/*====== Post Information Status ======*/
		if( $atts['postinformation'] == "true" ) {

			$information_status = "true";

		} else {

			$information_status = "";

		}

		/*====== Excerpt Status ======*/
		if( $atts['excerpt'] == "true" ) {

			$excerpt_status = "true";

		} else {

			$excerpt_status = "";

		}

		/*====== Read More Status ======*/
		if( $atts['readmore'] == "true" ) {

			$readmore_status = "true";

		} else {

			$readmore_status = "";

		}

		/*====== Style ======*/
		$style = $atts['style'];

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'post',
		);

		/*====== Pagination ======*/
		$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );

		if( empty( $paged ) ) {

			$paged = 1;

		}

		if( !empty( $paged ) ) {

			$extra_query = array(
				'paged' => $paged,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Categories ======*/
		if( !empty( $atts['category'] ) ) {

			$category_ids = $atts['category'];
			$include_cats = explode( ',', $category_ids );

		} else {

			$include_cats = "";

		}

		if( !empty( $include_cats ) ) {

			$extra_query = array(
				'cat' => $include_cats,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Posts ======*/
		if( !empty( $atts['postids'] ) ) {

			$postids = $atts['postids'];
			$include_posts = explode( ',', $postids );

		} else {

			$include_posts = "";

		}

		if( !empty( $include_posts ) ) {

			$extra_query = array(
				'post__in' => $include_posts,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Post Count ======*/
		if( !empty( $atts["postcount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["postcount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Post Tag ======*/
		if( !empty( $atts["posttag"] ) ) {

			$extra_query = array(
				'tag' => $atts['posttag'],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Posts ======*/
		$excludeposts = $atts['excludeposts'];

		if( !empty( $excludeposts ) ) {

			$exclude_posts = $excludeposts;
			$exclude_posts = explode( ',', $exclude_posts );

		} else {

			$exclude_posts = array();

		}

		if( !empty( $exclude_posts ) ) {

			$extra_query = array(
				'post__not_in' => $exclude_posts,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order & Order By ======*/
		if( $atts["ordertype"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		if( $atts["sortby"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["sortby"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["sortby"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["sortby"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["sortby"] == "none" ) {

			$order_by = "none";

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Ignore Sticky Posts ======*/
		if( $atts["ignore-sticky-posts"] == "true" ) {

			$extra_query = array(
				'ignore_sticky_posts' => true,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		} else {

			$extra_query = array(
				'ignore_sticky_posts' => false,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		$post_query = new WP_Query( $arg );

		if( $post_query->have_posts() ) {

			$output .= '<div class="gt-blog gt-' . esc_attr( $style ) . '">';

					if( $style == "style2" ) {

						$output .= '<div class="gt-columns gt-column-2 gt-column-space-30">';

							while( $post_query->have_posts() ) {

								$post_query->the_post();
								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
									$output .= eventchamp_post_list_style_2( $post_id = get_the_ID(), $image = "true", $category = $category_status, $excerpt = $excerpt_status, $read_more = $readmore_status, $post_info = $information_status );
									$output .= '</div>';
								$output .= '</div>';

							}
							wp_reset_postdata();

						$output .= '</div>';

					} elseif( $style == "style3" ) {

						$output .= '<div class="gt-columns gt-column-1 gt-column-space-15">';

							while( $post_query->have_posts() ) {

								$post_query->the_post();
								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
									$output .= eventchamp_post_list_style_3( $post_id = get_the_ID(), $image = "true", $post_info = $information_status );
									$output .= '</div>';
								$output .= '</div>';

							}
							wp_reset_postdata();

						$output .= '</div>';

					} elseif( $style == "style4" ) {

						$output .= '<div class="gt-columns gt-column-2 gt-column-space-30">';

							while( $post_query->have_posts() ) {

								$post_query->the_post();
								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= eventchamp_post_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $excerpt = $excerpt_status, $read_more = $readmore_status, $post_info = $information_status );
									$output .= '</div>';
								$output .= '</div>';

							}
							wp_reset_postdata();

						$output .= '</div>';

					} else {

						$output .= '<div class="gt-columns gt-column-1 gt-column-space-45">';

							while( $post_query->have_posts() ) {

								$post_query->the_post();
								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= eventchamp_post_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $excerpt = $excerpt_status, $read_more = $readmore_status, $post_info = $information_status );
									$output .= '</div>';
								$output .= '</div>';

							}
							wp_reset_postdata();

						$output .= '</div>';

					}

					if( $atts['pagination'] == 'true' ) {

						$output .= eventchamp_element_pagination( $paged = $paged, $query = $post_query );

					}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_latest_posts", "eventchamp_latest_posts_output" );

	if( function_exists( 'vc_map' ) ) {

		$post_categories = get_terms( "category" );
		$post_categories_array = array();
		$post_categories_array[esc_html__( 'All Categories', 'eventchamp' )] = "-";

		if( !empty( $post_categories ) ) {

			foreach( $post_categories as $post_category ) {

				if( !empty( $post_category ) ) {

					$post_categories_array[$post_category->name] = $post_category->term_id;

				}

			}

		}

		vc_map(
			array(
				"name" => esc_html__( 'Blog', 'eventchamp' ),
				"base" => "eventchamp_latest_posts",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/blog.jpg',
				"description" => esc_html__( 'Blog post listing element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "postcount",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a post count.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "category",
						"heading" => esc_html__( 'Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a post category.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => $post_categories_array,
					),
					array(
						"type" => "textfield",
						"param_name" => "postids",
						"heading" => esc_html__( 'Include Posts', 'eventchamp' ),
						"description" => esc_html__( 'You can enter post ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "excludeposts",
						"heading" => esc_html__( 'Exclude Posts', 'eventchamp' ),
						"description" => esc_html__( 'You can enter post ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "posttag",
						"heading" => esc_html__( 'Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a post tag. Example: Event', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "ordertype",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sortby",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "ignore-sticky-posts",
						"heading" => esc_html__( 'Ignore Sticky Posts', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the ignore sticky posts.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "pagination",
						"heading" => esc_html__( 'Pagination', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style3',
							esc_html__( 'Style 4', 'eventchamp' ) => 'style4',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "categoryname",
						"heading" => esc_html__( 'Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the category name.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "postinformation",
						"heading" => esc_html__( 'Details', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the post information.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "excerpt",
						"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the post excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "readmore",
						"heading" => esc_html__( 'Read More', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the read more button.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					)
				),
			)
		);

	}

}



/*======
*
* Blog Carousel
*
======*/
if( !function_exists( 'eventchamp_latest_posts_carousel_output' ) ) {

	function eventchamp_latest_posts_carousel_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'postcount' => '',
				'category' => '',
				'postids' => '',
				'excludeposts' => '',
				'posttag' => '',
				'offset' => '',
				'ordertype' => '',
				'sortby' => '',
				'ignore-sticky-posts' => '',
				'style' => '',
				'link' => '',
				'categoryname' => '',
				'postinformation' => '',
				'excerpt' => '',
				'readmore' => '',
				'column' => '',
				'slider-space' => '',
				'slider-autoplay' => '',
				'slider-autoplay-delay' => '',
				'slider-loop' => '',
				'slider-slide-speed' => '',
				'slider-centered-slides' => '',
				'slider-direction"' => '',
				'slider-effect' => '',
				'slider-free-mode' => '',
				'navigation' => '',
			), $atts
		);
		
		$output = '';

		/*====== Column ======*/
		if( empty( $atts["column"] ) ) {

			$atts["column"] = "1";

		}

		/*====== Category Name Status ======*/
		if( $atts['categoryname'] == "true" ) {

			$category_status = "true";

		} else {

			$category_status = "false";

		}

		/*====== Post Information Status ======*/
		if( $atts['postinformation'] == "true" ) {

			$information_status = "true";

		} else {

			$information_status = "false";

		}

		/*====== Excerpt Status ======*/
		if( $atts['excerpt'] == "true" ) {

			$excerpt_status = "true";

		} else {

			$excerpt_status = "false";

		}

		/*====== Read More Status ======*/
		if( $atts['readmore'] == "true" ) {

			$readmore_status = "true";

		} else {

			$readmore_status = "false";

		}

		/*====== Column Space ======*/
		if( empty( $atts["slider-space"] ) ) {

			$atts["slider-space"] = "30";

		}

		/*====== Slider Autoplay ======*/
		if( empty( $atts["slider-autoplay"] ) ) {

			$atts["slider-autoplay"] = "false";

		}

		/*====== Slider Autoplay Delay ======*/
		if( empty( $atts["slider-autoplay-delay"] ) ) {

			$atts["slider-autoplay-delay"] = "15000";

		}

		/*====== Slider Loop ======*/
		if( empty( $atts["slider-loop"] ) ) {

			$atts["slider-loop"] = "false";

		}

		/*====== Slider Slide Speed ======*/
		if( empty( $atts["slider-slide-speed"] ) ) {

			$atts["slider-slide-speed"] = "1000";

		}

		/*====== Centered Slides ======*/
		if( empty( $atts["slider-centered-slides"] ) ) {

			$atts["slider-centered-slides"] = "false";

		}

		/*====== Slider Direction ======*/
		if( empty( $atts["slider-direction"] ) ) {

			$atts["slider-direction"] = "horizontal";

		}

		/*====== Slider Effect ======*/
		if( empty( $atts["slider-effect"] ) ) {

			$atts["slider-effect"] = "slide";

		}

		/*====== Slider Free Mode ======*/
		if( empty( $atts["slider-free-mode"] ) ) {

			$atts["slider-free-mode"] = "false";

		}

		/*====== Pagination ======*/
		if( empty( $atts["pagination"] ) ) {

			$atts["pagination"] = "false";

		}

		/*====== Main Query ======*/
		$arg = array(
			'post_status' => 'publish',
			'post_type' => 'post',
		);

		/*====== Pagination ======*/
		$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );

		if( empty( $paged ) ) {

			$paged = 1;

		}

		if( !empty( $paged ) ) {

			$extra_query = array(
				'paged' => $paged,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Categories ======*/
		if( !empty( $atts['category'] ) ) {

			$category_ids = $atts['category'];
			$include_cats = explode( ',', $category_ids );

		} else {

			$include_cats = "";

		}

		if( !empty( $include_cats ) ) {

			$extra_query = array(
				'cat' => $include_cats,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Include Posts ======*/
		if( !empty( $atts['postids'] ) ) {

			$postids = $atts['postids'];
			$include_posts = explode( ',', $postids );

		} else {

			$include_posts = "";

		}

		if( !empty( $include_posts ) ) {

			$extra_query = array(
				'post__in' => $include_posts,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Post Count ======*/
		if( !empty( $atts["postcount"] ) ) {

			$extra_query = array(
				'posts_per_page' => $atts["postcount"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Offset ======*/
		if( !empty( $atts["offset"] ) ) {

			$extra_query = array(
				'offset' => $atts["offset"],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Post Tag ======*/
		if( !empty( $atts["posttag"] ) ) {

			$extra_query = array(
				'tag' => $atts['posttag'],
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Exclude Posts ======*/
		$excludeposts = $atts['excludeposts'];

		if( !empty( $excludeposts ) ) {

			$exclude_posts = $excludeposts;
			$exclude_posts = explode( ',', $exclude_posts );

		} else {

			$exclude_posts = array();

		}

		if( !empty( $exclude_posts ) ) {

			$extra_query = array(
				'post__not_in' => $exclude_posts,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Order & Order By ======*/
		if( $atts["ordertype"] == "ASC" ) {

			$order = "ASC";

		} else {

			$order = "DESC";

		}

		if( !empty( $order ) ) {

			$extra_query = array(
				'order' => $order,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		if( $atts["sortby"] == "popular-comment" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "id" ) {

			$order_by = "ID";

		} elseif( $atts["sortby"] == "popular" ) {

			$order_by = "comment_count";

		} elseif( $atts["sortby"] == "title" ) {

			$order_by = "title";

		} elseif( $atts["sortby"] == "menu_order" ) {

			$order_by = "menu_order";

		} elseif( $atts["sortby"] == "rand" ) {

			$order_by = "rand";

		} elseif( $atts["sortby"] == "none" ) {

			$order_by = "none";

		} else {

			$order_by = "date";

		}

		if( !empty( $order_by ) ) {

			$extra_query = array(
				'orderby' => $order_by,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== Ignore Sticky Posts ======*/
		if( $atts["ignore-sticky-posts"] == "true" ) {

			$extra_query = array(
				'ignore_sticky_posts' => true,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		} else {

			$extra_query = array(
				'ignore_sticky_posts' => false,
			);
			$arg = wp_parse_args( $arg, $extra_query );

		}

		/*====== HTML Output ======*/
		$post_query = new WP_Query( $arg );

		if( $post_query->have_posts() ) {

			$output .= '<div class="gt-blog-carousel">';
				$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item="' . esc_attr( $atts["column"] ) . '" data-gt-item-space="' . esc_attr( $atts["slider-space"] ) . '" data-gt-loop="' . esc_attr( $atts["slider-loop"] ) . '" data-gt-speed="' . esc_attr( $atts["slider-slide-speed"] ) . '" data-gt-direction="' . esc_attr( $atts["slider-direction"] ) . '" data-gt-effect="' . esc_attr( $atts["slider-effect"] ) . '" data-gt-centered-slides="' . esc_attr( $atts["slider-centered-slides"] ) . '" data-gt-free-mode="' . esc_attr( $atts["slider-free-mode"] ) . '">';
					$output .= '<div class="swiper-wrapper">';

						while( $post_query->have_posts() ) {

							$post_query->the_post();

							if( $atts["slider-autoplay"] == "true" ) {

								$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $atts["slider-autoplay-delay"] ) . '">';

							} else {

								$output .= '<div class="swiper-slide">';

							}

								if( $atts["style"] == "style2" ) {

									$output .= eventchamp_post_list_style_2( $post_id = get_the_ID(), $image = "true", $category = $category_status, $excerpt = $excerpt_status, $read_more = $readmore_status, $post_info = $information_status );

								} elseif( $atts["style"] == "style3" ) {

									$output .= eventchamp_post_list_style_3( $post_id = get_the_ID(), $image = "true", $post_info = $information_status );

								} else {

									$output .= eventchamp_post_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $excerpt = $excerpt_status, $read_more = $readmore_status, $post_info = $information_status );

								}

							$output .= '</div>';

						}
						wp_reset_postdata();

					$output .= '</div>';
				
					if( $atts['navigation'] == 'true' or !empty( $atts["link"] ) ) {

						$output .= '<div class="gt-pagination">';

							if( $atts['navigation'] == 'true' ) {

								$output .= '<div class="gt-slider-prev">';
									$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
								$output .= '</div>';

							}

							if( !empty( $atts["link"] ) ) {

								$href = $atts["link"];
								$href = vc_build_link( $href );

								if( !empty( $href["target"] ) ) {

									$target = $href["target"];

								} else {

									$target = "_parent";

								}

								$output .= '<div>';
									$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '" class="gt-all-button">' . esc_attr( $href["title"] ) . '</a>';
								$output .= '</div>';

							}

							if( $atts['navigation'] == 'true' ) {

								$output .= '<div class="gt-slider-next">';
									$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
								$output .= '</div>';

							}

						$output .= '</div>';

					}

				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_latest_posts_carousel", "eventchamp_latest_posts_carousel_output" );

	if( function_exists( 'vc_map' ) ) {

		$post_categories = get_terms( "category" );
		$post_categories_array = array();
		$post_categories_array[esc_html__( 'All Categories', 'eventchamp' )] = "-";

		if( !empty( $post_categories ) ) {

			foreach( $post_categories as $post_category ) {

				if( !empty( $post_category ) ) {

				$post_categories_array[$post_category->name] =  $post_category->term_id;

				}

			}

		}

		vc_map(
			array(
				"name" => esc_html__( 'Blog Carousel', 'eventchamp' ),
				"base" => "eventchamp_latest_posts_carousel",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/blog-carousel.jpg',
				"description" => esc_html__( 'Blog carousel element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "postcount",
						"heading" => esc_html__( 'Post Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a post count.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "category",
						"heading" => esc_html__( 'Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a post category.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => $post_categories_array,
					),
					array(
						"type" => "textfield",
						"param_name" => "postids",
						"heading" => esc_html__( 'Include Posts', 'eventchamp' ),
						"description" => esc_html__( 'You can enter post ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "excludeposts",
						"heading" => esc_html__( 'Exclude Posts', 'eventchamp' ),
						"description" => esc_html__( 'You can enter post ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "posttag",
						"heading" => esc_html__( 'Tag', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a post tag. Example: Event', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "ordertype",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "sortby",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "ignore-sticky-posts",
						"heading" => esc_html__( 'Ignore Sticky Posts', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the ignore sticky posts.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style3',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
							esc_html__( '5 Column', 'eventchamp' ) => '5',
							esc_html__( '6 Column', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "vc_link",
						"param_name" => "link",
						"heading" => esc_html__( 'Blog Page Link', 'eventchamp' ),
						"description" => esc_html__( 'You can create a all posts.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
					),
					array(
						"type" => "dropdown",
						"param_name" => "categoryname",
						"heading" => esc_html__( 'Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the category name.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "postinformation",
						"heading" => esc_html__( 'Details', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the post information.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "excerpt",
						"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the post excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "readmore",
						"heading" => esc_html__( 'Read More', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the read more button.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-space",
						"heading" => esc_html__( 'Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a space value for space between the slides.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0px', 'eventchamp' ) => '0',
							esc_html__( '1px', 'eventchamp' ) => '1',
							esc_html__( '2px', 'eventchamp' ) => '2',
							esc_html__( '3px', 'eventchamp' ) => '3',
							esc_html__( '4px', 'eventchamp' ) => '4',
							esc_html__( '5px', 'eventchamp' ) => '5',
							esc_html__( '10px', 'eventchamp' ) => '10',
							esc_html__( '15px', 'eventchamp' ) => '15',
							esc_html__( '20px', 'eventchamp' ) => '20',
							esc_html__( '25px', 'eventchamp' ) => '25',
							esc_html__( '30px', 'eventchamp' ) => '30',
							esc_html__( '45px', 'eventchamp' ) => '45',
							esc_html__( '50px', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-autoplay",
						"heading" => esc_html__( 'Slider Autoplay', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the autoplay.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-autoplay-delay",
						"heading" => esc_html__( 'Slider Autoplay Delay', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an autoplay delay value. Default: 15000', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-loop",
						"heading" => esc_html__( 'Slider Loop', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the loop.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-slide-speed",
						"heading" => esc_html__( 'Slide Speed', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a slide speed. Duration of transition between the slides. Default: 1500', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-centered-slides",
						"heading" => esc_html__( 'Centered Slides', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the centered slides. If you choose true, then active slide will be centered, not always on the left side.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-direction",
						"heading" => esc_html__( 'Slider Direction', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a direction.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Horizontal', 'eventchamp' ) => 'horizontal',
							esc_html__( 'Vertical', 'eventchamp' ) => 'vertical',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-effect",
						"heading" => esc_html__( 'Slider Effect', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an effect.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Slide', 'eventchamp' ) => 'slide',
							esc_html__( 'Fade', 'eventchamp' ) => 'fade',
							esc_html__( 'Cube', 'eventchamp' ) => 'cube',
							esc_html__( 'Coverflow', 'eventchamp' ) => 'coverflow',
							esc_html__( 'Flip', 'eventchamp' ) => 'flip',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-free-mode",
						"heading" => esc_html__( 'Free Mode', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the free mode. If true then slides will not have fixed positions', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "navigation",
						"heading" => esc_html__( 'Navigation', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the navigation.', 'eventchamp' ),
						"group" => esc_html__( 'Slider', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Organizers
*
======*/
if( !function_exists( 'eventchamp_organizers_output' ) ) {

	function eventchamp_organizers_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '1',
				'align' => 'center',
				'count' => '',
				'include-organizers' => '',
				'exclude-organizers' => '',
				'order' => 'ASC',
				'order-type' => 'name',
				'empty-organizers' => 'false',
				'childless' => 'false',
				'hide-children' => 'false',
				'event-count' => 'false',
				'show-count' => 'false',
			), $atts
		);

		$output = "";

		/*====== Include Organizers ======*/
		if( !empty( $atts['include-organizers'] ) ) {

			$include_organizers = $atts['include-organizers'];
			$include_organizers = explode( ',', $include_organizers );

		} else {

			$include_organizers = "";

		}

		/*====== Exclude Organizers ======*/
		if( !empty( $atts['exclude-organizers'] ) ) {

			$exclude_organizers = $atts['exclude-organizers'];
			$exclude_organizers = explode( ',', $exclude_organizers );

		} else {

			$exclude_organizers = "";

		}

		/*====== Order ======*/
		if( empty( $atts["order"] ) ) {

			$atts["order"] = "ASC";

		}

		/*====== Order Type ======*/
		if( empty( $atts["order-type"] ) ) {

			$atts["order-type"] = "name";

		}

		/*====== Empty Organizers ======*/
		if( $atts['empty-organizers'] == 'false' ) {

			$empty_organizers = false;

		} else {

			$empty_organizers = true;

		}

		/*====== Childless ======*/
		if( $atts['childless'] == 'false' ) {

			$childless = false;

		} else {

			$childless = true;

		}

		/*====== Hide Children ======*/
		if( $atts['hide-children'] == 'false' ) {

			$hide_children = '';

		} else {

			$hide_children = 0;

		}

		/*====== Query ======*/
		$organizers = get_terms(
			array(
				'taxonomy' => 'organizer',
				'number' => $atts["count"],
				'include' => $include_organizers,
				'exclude' => $exclude_organizers,
				'order' => $atts["order"],
				'orderby' => $atts["order-type"],
				'hide_empty' => $empty_organizers,
				'childless' => $childless,
				'parent' => $hide_children,
			)
		);

		/*====== HTML Output ======*/
		if( !empty( $organizers ) ) {

			$output .= '<div class="gt-organizers gt-style-' . esc_attr( $atts["style"] ) . ' gt-align-' . esc_attr( $atts["align"] ) . '">';
				$output .= '<ul>';

					foreach( $organizers as $organizer ) {

						if( !empty( $organizer ) ) {

							$output .= '<li>';
								$output .= '<a href="' . esc_url( get_term_link( $organizer->term_id ) . '?post_type=event' ) . '">';
									$output .= esc_attr( $organizer->name );

									if( $atts["show-count"] == "true" ) {

										$output .= ' (' . eventchamp_taxonomy_post_count( $cat_id = esc_attr( $organizer->term_id ), $taxonomy = "organizer" ) . ')';

									}

								$output .= '</a>';
							$output .= '</li>';

						}

					}

				$output .= '</ul>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_organizers", "eventchamp_organizers_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Organizers', 'eventchamp' ),
				"base" => "eventchamp_organizers",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/organizers.jpg',
				"description" => esc_html__( 'You can list the organizers.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '4',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "align",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "count",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-organizers",
						"heading" => esc_html__( 'Exclude Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizer ids. Example: 1,2,3 etc.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-organizers",
						"heading" => esc_html__( 'Include Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can enter organizer ids. Example: 1,2,3 etc.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "order",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "order-type",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Name', 'eventchamp' ) => 'name',
							esc_html__( 'Slug', 'eventchamp' ) => 'slug',
							esc_html__( 'Term Group', 'eventchamp' ) => 'term_group',
							esc_html__( 'Term ID', 'eventchamp' ) => 'term_id',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Description', 'eventchamp' ) => 'description',
							esc_html__( 'Parent', 'eventchamp' ) => 'parent',
							esc_html__( 'Count', 'eventchamp' ) => 'count',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "empty-organizers",
						"heading" => esc_html__( 'Empty Organizers', 'eventchamp' ),
						"description" => esc_html__( 'You can choose visible status of the empty organizers. If you choose true option empty organizers will be hide.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "childless",
						"heading" => esc_html__( 'Childless', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the childless taxonomies.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-children",
						"heading" => esc_html__( 'Hide Children', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the children.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "show-count",
						"heading" => esc_html__( 'Show Count', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of show the post count.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Tags
*
======*/
if( !function_exists( 'eventchamp_post_type_tags_output' ) ) {

	function eventchamp_post_type_tags_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '1',
				'align' => 'center',
				'post-type' => 'post',
				'count' => '',
				'include-tags' => '',
				'exclude-tags' => '',
				'order' => 'ASC',
				'order-type' => 'name',
				'empty-tags' => 'false',
				'childless' => 'false',
				'hide-children' => 'false',
				'show-count' => 'false',
			), $atts
		);

		$output = "";

		/*====== Taxonomy ======*/
		if( $atts["post-type"] == "post" ) {

			$taxonomy = "post_tag";

		} elseif( $atts["post-type"] == "event" ) {

			$taxonomy = "event_tags";

		} elseif( $atts["post-type"] == "venue" ) {

			$taxonomy = "venue_tags";

		} elseif( $atts["post-type"] == "speaker" ) {

			$taxonomy = "speaker-tags";

		}

		/*====== Include Tags ======*/
		if( !empty( $atts['include-tags'] ) ) {

			$include_tags = $atts['include-tags'];
			$include_tags = explode( ',', $include_tags );

		} else {

			$include_tags = "";

		}

		/*====== Exclude Tags ======*/
		if( !empty( $atts['exclude-tags'] ) ) {

			$exclude_tags = $atts['exclude-tags'];
			$exclude_tags = explode( ',', $exclude_tags );

		} else {

			$exclude_tags = "";

		}

		/*====== Order ======*/
		if( empty( $atts["order"] ) ) {

			$atts["order"] = "ASC";

		}

		/*====== Order Type ======*/
		if( empty( $atts["order-type"] ) ) {

			$atts["order-type"] = "name";

		}

		/*====== Empty Tags ======*/
		if( $atts['empty-tags'] == 'false' ) {

			$empty_tags = false;

		} else {

			$empty_tags = true;

		}

		/*====== Childless ======*/
		if( $atts['childless'] == 'false' ) {

			$childless = false;

		} else {

			$childless = true;

		}

		/*====== Hide Children ======*/
		if( $atts['hide-children'] == 'false' ) {

			$hide_children = '';

		} else {

			$hide_children = 0;

		}

		/*====== Query ======*/
		$tags = get_terms(
			array(
				'taxonomy' => $taxonomy,
				'number' => $atts["count"],
				'include' => $include_tags,
				'exclude' => $exclude_tags,
				'order' => $atts["order"],
				'orderby' => $atts["order-type"],
				'hide_empty' => $empty_tags,
				'childless' => $childless,
				'parent' => $hide_children,
			)
		);

		/*====== HTML Output ======*/
		if( !empty( $tags ) ) {

			$output .= '<div class="gt-tags gt-style-' . esc_attr( $atts["style"] ) . ' gt-align-' . esc_attr( $atts["align"] ) . '">';
				$output .= '<ul>';

					foreach( $tags as $tag ) {

						if( !empty( $tag ) ) {

							$output .= '<li>';
								$output .= '<a href="' . esc_url( get_term_link( $tag->term_id ) . '?post_type=' . esc_attr( $atts["post-type"] ) ) . '">';
									$output .= esc_attr( $tag->name );

									if( $atts["show-count"] == "true" ) {

										$output .= ' (' . eventchamp_taxonomy_post_count( $cat_id = esc_attr( $tag->term_id ), $taxonomy = esc_attr( $taxonomy ) ) . ')';

									}

								$output .= '</a>';
							$output .= '</li>';

						}

					}

				$output .= '</ul>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_post_type_tags", "eventchamp_post_type_tags_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Tags', 'eventchamp' ),
				"base" => "eventchamp_post_type_tags",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/tags.jpg',
				"description" => esc_html__( 'You can list the tags.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "align",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "post-type",
						"heading" => esc_html__( 'Post Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a post type.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Post Tags', 'eventchamp' ) => 'post',
							esc_html__( 'Event Tags', 'eventchamp' ) => 'event',
							esc_html__( 'Venue Tags', 'eventchamp' ) => 'venue',
							esc_html__( 'Speaker Tags', 'eventchamp' ) => 'speaker',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "count",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-tags",
						"heading" => esc_html__( 'Exclude Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter tag ids. Example: 1,2,3 etc.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-tags",
						"heading" => esc_html__( 'Include Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can enter tag ids. Example: 1,2,3 etc.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "order",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "order-type",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Name', 'eventchamp' ) => 'name',
							esc_html__( 'Slug', 'eventchamp' ) => 'slug',
							esc_html__( 'Term Group', 'eventchamp' ) => 'term_group',
							esc_html__( 'Term ID', 'eventchamp' ) => 'term_id',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Description', 'eventchamp' ) => 'description',
							esc_html__( 'Parent', 'eventchamp' ) => 'parent',
							esc_html__( 'Count', 'eventchamp' ) => 'count',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "empty-tags",
						"heading" => esc_html__( 'Empty Tags', 'eventchamp' ),
						"description" => esc_html__( 'You can choose visible status of the empty tags. If you choose true option empty tags will be hide.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "childless",
						"heading" => esc_html__( 'Childless', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the childless taxonomies.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-children",
						"heading" => esc_html__( 'Hide Children', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the children.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "show-count",
						"heading" => esc_html__( 'Show Count', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of show the post count.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Categories
*
======*/
if( !function_exists( 'eventchamp_post_type_categories_output' ) ) {

	function eventchamp_post_type_categories_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '1',
				'align' => 'center',
				'post-type' => 'post',
				'count' => '',
				'include-categories' => '',
				'exclude-categories' => '',
				'order' => 'ASC',
				'order-type' => 'name',
				'empty-categories' => 'false',
				'childless' => 'false',
				'hide-children' => 'false',
				'show-count' => 'false',
			), $atts
		);

		$output = "";

		/*====== Taxonomy ======*/
		if( $atts["post-type"] == "post" ) {

			$taxonomy = "category";

		} elseif( $atts["post-type"] == "event" ) {

			$taxonomy = "eventcat";

		} elseif( $atts["post-type"] == "venue" ) {

			$taxonomy = "venuecat";

		}

		/*====== Order ======*/
		if( empty( $atts["order"] ) ) {

			$atts["order"] = "ASC";

		}

		/*====== Order Type ======*/
		if( empty( $atts["order-type"] ) ) {

			$atts["order-type"] = "name";

		}

		/*====== Childless ======*/
		if( $atts['childless'] == 'false' ) {

			$childless = false;

		} else {

			$childless = true;

		}

		/*====== Hide Children ======*/
		if( $atts['hide-children'] == 'false' ) {

			$hide_children = '';

		} else {

			$hide_children = 0;

		}

		/*====== Empty Categories ======*/
		if( $atts['empty-categories'] == 'false' ) {

			$empty_categories = false;

		} else {

			$empty_categories = true;

		}

		/*====== Include Categories ======*/
		if( !empty( $atts['include-categories'] ) ) {

			$include_categories = $atts['include-categories'];
			$include_categories = explode( ',', $include_categories );

		} else {

			$include_categories = "";

		}

		/*====== Exclude Categories ======*/
		if( !empty( $atts['exclude-categories'] ) ) {

			$exclude_categories = $atts['exclude-categories'];
			$exclude_categories = explode( ',', $exclude_categories );

		} else {

			$exclude_categories = "";

		}

		/*====== Query ======*/
		$categories = get_terms(
			array(
				'taxonomy' => $taxonomy,
				'number' => $atts["count"],
				'include' => $include_categories,
				'exclude' => $exclude_categories,
				'order' => $atts["order"],
				'orderby' => $atts["order-type"],
				'hide_empty' => $empty_categories,
				'childless' => $childless,
				'parent' => $hide_children,
			)
		);

		/*====== HTML Output ======*/
		if( !empty( $categories ) ) {

			$output .= '<div class="gt-categories gt-style-' . esc_attr( $atts["style"] ) . ' gt-align-' . esc_attr( $atts["align"] ) . '">';
				$output .= '<ul>';

					foreach( $categories as $category ) {

						if( !empty( $category ) ) {

							$output .= '<li>';
								$output .= '<a href="' . esc_url( get_term_link( $category->term_id ) . '?post_type=' . esc_attr( $atts["post-type"] ) ) . '" class="gt-category-' . esc_attr( $category->term_id ) . '">';
									$output .= esc_attr( $category->name );

									if( $atts["show-count"] == "true" ) {

										$output .= ' (' . eventchamp_taxonomy_post_count( $cat_id = esc_attr( $category->term_id ), $taxonomy = esc_attr( $taxonomy ) ) . ')';

									}

								$output .= '</a>';
							$output .= '</li>';

						}

					}

				$output .= '</ul>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_post_type_categories", "eventchamp_post_type_categories_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Categories', 'eventchamp' ),
				"base" => "eventchamp_post_type_categories",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/categories.jpg',
				"description" => esc_html__( 'You can list the categories.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "post-type",
						"heading" => esc_html__( 'Post Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a post type.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Post Categories', 'eventchamp' ) => 'post',
							esc_html__( 'Event Categories', 'eventchamp' ) => 'event',
							esc_html__( 'Venue Categories', 'eventchamp' ) => 'venue',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "align",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "count",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a count.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "exclude-categories",
						"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Example: 1,2,3 etc.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "include-categories",
						"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can enter category ids. Example: 1,2,3 etc.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "order",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "order-type",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Name', 'eventchamp' ) => 'name',
							esc_html__( 'Slug', 'eventchamp' ) => 'slug',
							esc_html__( 'Term Group', 'eventchamp' ) => 'term_group',
							esc_html__( 'Term ID', 'eventchamp' ) => 'term_id',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Description', 'eventchamp' ) => 'description',
							esc_html__( 'Parent', 'eventchamp' ) => 'parent',
							esc_html__( 'Count', 'eventchamp' ) => 'count',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "empty-categories",
						"heading" => esc_html__( 'Empty Categories', 'eventchamp' ),
						"description" => esc_html__( 'You can choose visible status of the empty categories. If you choose true option empty categories will be hide.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "childless",
						"heading" => esc_html__( 'Childless', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the childless taxonomies.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-children",
						"heading" => esc_html__( 'Hide Children', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the children.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "show-count",
						"heading" => esc_html__( 'Show Count', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of show the post count.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Testimonial
*
======*/
if( !function_exists( 'eventchamp_testimonials_output' ) and !function_exists( 'eventchamp_testimonials_item_shortcode' ) ) {

	function eventchamp_testimonials_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'align' => 'left',
				'column' => '',
				'slider-space' => '',
				'slider-loop' => '',
				'slider-slide-speed' => '',
				'slider-centered-slides' => '',
				'slider-direction"' => '',
				'slider-effect' => '',
				'slider-free-mode' => '',
				'pagination' => '',
			), $atts
		);

		$output = '';

		/*====== Column ======*/
		if( empty( $atts["column"] ) ) {

			$atts["column"] = "1";

		}

		/*====== Column Space ======*/
		if( empty( $atts["slider-space"] ) ) {

			$atts["slider-space"] = "30";

		}

		/*====== Slider Loop ======*/
		if( empty( $atts["slider-loop"] ) ) {

			$atts["slider-loop"] = "false";

		}

		/*====== Slider Slide Speed ======*/
		if( empty( $atts["slider-slide-speed"] ) ) {

			$atts["slider-slide-speed"] = "1000";

		}

		/*====== Centered Slides ======*/
		if( empty( $atts["slider-centered-slides"] ) ) {

			$atts["slider-centered-slides"] = "false";

		}

		/*====== Slider Direction ======*/
		if( empty( $atts["slider-direction"] ) ) {

			$atts["slider-direction"] = "horizontal";

		}

		/*====== Slider Effect ======*/
		if( empty( $atts["slider-effect"] ) ) {

			$atts["slider-effect"] = "slide";

		}

		/*====== Slider Free Mode ======*/
		if( empty( $atts["slider-free-mode"] ) ) {

			$atts["slider-free-mode"] = "false";

		}

		/*====== Pagination ======*/
		if( empty( $atts["pagination"] ) ) {

			$atts["pagination"] = "false";

		}

		/*====== HTML Output ======*/
		$output .= '<div class="gt-testimonials-carousel gt-align-' . esc_attr( $atts["align"] ) . '">';
			$output .= '<div class="swiper-container gt-swiper-slider" data-gt-item="' . esc_attr( $atts["column"] ) . '" data-gt-item-space="' . esc_attr( $atts["slider-space"] ) . '" data-gt-loop="' . esc_attr( $atts["slider-loop"] ) . '" data-gt-speed="' . esc_attr( $atts["slider-slide-speed"] ) . '" data-gt-direction="' . esc_attr( $atts["slider-direction"] ) . '" data-gt-effect="' . esc_attr( $atts["slider-effect"] ) . '" data-gt-centered-slides="' . esc_attr( $atts["slider-centered-slides"] ) . '" data-gt-free-mode="' . esc_attr( $atts["slider-free-mode"] ) . '">';
				$output .= '<div class="swiper-wrapper">';
					$output .= do_shortcode( $content );
				$output .= '</div>';

				if( $atts["pagination"] == "true" ) {

					$output .= '<div class="swiper-pagination gt-slider-pagination"></div>';

				}

			$output .= '</div>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_testimonials", "eventchamp_testimonials_output" );

	function eventchamp_testimonials_item_shortcode( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'image' => '',
				'name' => '',
				'text' => '',
				'slider-autoplay' => '',
				'slider-autoplay-delay' => '',
			), $atts
		);
		
		$output = '';

		/*====== Slide Autoplay ======*/
		if( empty( $atts["slider-autoplay"] ) ) {

			$atts["slider-autoplay"] = "false";

		}

		/*====== Slide Autoplay Delay ======*/
		if( empty( $atts["slider-autoplay-delay"] ) ) {

			$atts["slider-autoplay-delay"] = "15000";

		}

		/*====== HTML Output ======*/
		if( !empty( $atts["name"] ) or !empty( $atts["text"] ) ) {

			if( $atts["slider-autoplay"] == "true" ) {

				$output .= '<div class="swiper-slide" data-swiper-autoplay="' . esc_attr( $atts["slider-autoplay-delay"] ) . '">';

			} else {

				$output .= '<div class="swiper-slide">';

			}

				if( !empty( $atts["image"] ) ) {

					$output .= '<div class="gt-image">';
						$output .= wp_get_attachment_image( esc_attr( $atts["image"] ), 'thumbnail', true, array( "alt" => $atts["name"] ) );
					$output .= '</div>';

				}

				if( !empty( $atts["name"] ) ) {

					$output .= '<div class="gt-name">' . esc_attr( $atts["name"] ) . '</div>';

				}

				if( !empty( $atts["text"] ) ) {

					$output .= '<div class="gt-content">';
						$output .= wpautop( esc_attr( $atts["text"] ) );
					$output .= '</div>';

				}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_testimonials_item", "eventchamp_testimonials_item_shortcode" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Testimonials', 'eventchamp' ),
				"base" => "eventchamp_testimonials",
				"as_parent" => array( 'only' => 'eventchamp_testimonials_item' ),
				"js_view" => "VcColumnView",
				"content_element" => true,
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/testimonials-carousel.jpg',
				"description" => esc_html__( 'Testimonial carousel element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "align",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "column",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => '1',
							esc_html__( '2 Column', 'eventchamp' ) => '2',
							esc_html__( '3 Column', 'eventchamp' ) => '3',
							esc_html__( '4 Column', 'eventchamp' ) => '4',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-space",
						"heading" => esc_html__( 'Column Space', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a space value for space between the slides.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( '0px', 'eventchamp' ) => '0',
							esc_html__( '1px', 'eventchamp' ) => '1',
							esc_html__( '2px', 'eventchamp' ) => '2',
							esc_html__( '3px', 'eventchamp' ) => '3',
							esc_html__( '4px', 'eventchamp' ) => '4',
							esc_html__( '5px', 'eventchamp' ) => '5',
							esc_html__( '10px', 'eventchamp' ) => '10',
							esc_html__( '15px', 'eventchamp' ) => '15',
							esc_html__( '20px', 'eventchamp' ) => '20',
							esc_html__( '25px', 'eventchamp' ) => '25',
							esc_html__( '30px', 'eventchamp' ) => '30',
							esc_html__( '45px', 'eventchamp' ) => '45',
							esc_html__( '50px', 'eventchamp' ) => '50',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-loop",
						"heading" => esc_html__( 'Slider Loop', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the loop.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-slide-speed",
						"heading" => esc_html__( 'Slide Speed', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a slide speed. Duration of transition between the slides. Default: 1500', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-centered-slides",
						"heading" => esc_html__( 'Centered Slides', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the centered slides. If you choose true, then active slide will be centered, not always on the left side.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-direction",
						"heading" => esc_html__( 'Slider Direction', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a direction.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Horizontal', 'eventchamp' ) => 'horizontal',
							esc_html__( 'Vertical', 'eventchamp' ) => 'vertical',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-effect",
						"heading" => esc_html__( 'Slider Effect', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an effect.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Slide', 'eventchamp' ) => 'slide',
							esc_html__( 'Fade', 'eventchamp' ) => 'fade',
							esc_html__( 'Cube', 'eventchamp' ) => 'cube',
							esc_html__( 'Coverflow', 'eventchamp' ) => 'coverflow',
							esc_html__( 'Flip', 'eventchamp' ) => 'flip',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-free-mode",
						"heading" => esc_html__( 'Free Mode', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the free mode. If true then slides will not have fixed positions', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "pagination",
						"heading" => esc_html__( 'Pagination', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				)
			)
		);

	}

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Testimonials Carousel Item', 'eventchamp' ),
				"base" => "eventchamp_testimonials_item",
				"as_child" => array( 'only' => 'eventchamp_testimonials' ),
				"content_element" => true,
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/testimonials-carousel.jpg',
				"description" => esc_html__( 'Testimonials carousel item element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "attach_image",
						"param_name" => "image",
						"heading" => esc_html__( 'Image', 'eventchamp' ),
						"description" => esc_html__( 'You can upload a customer image. Recommended size: 110x110', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "name",
						"heading" => esc_html__( 'Name', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a customer name.', 'eventchamp' ),
						"admin_label" => true,
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "text",
						"heading" => esc_html__( 'Content', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a customer feedback.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "slider-autoplay",
						"heading" => esc_html__( 'Slide Autoplay', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the autoplay.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "slider-autoplay-delay",
						"heading" => esc_html__( 'Slide Autoplay Delay', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an autoplay delay value. Default: 15000', 'eventchamp' ),
						'save_always' => true,
					),
				)
			)
		);

	}

	if( class_exists( 'WPBakeryShortCodesContainer' ) ) {

		class WPBakeryShortCode_eventchamp_testimonials extends WPBakeryShortCodesContainer {}

	}

}



/*======
*
* Heading
*
======*/
if( !function_exists( 'eventchamp_content_title_output' ) ) {

	function eventchamp_content_title_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'title' => '',
				'size' => '',
				'align' => '',
				'titleone' => '',
				'titletwo' => '',
				'description' => '',
				'separator' => 'true',
				'icon' => '',
				'svg-icon' => '',
			), $atts
		);

		$output = "";

		/*====== Align ======*/
		if( !empty( $atts['align'] ) ) {

			$align = esc_attr( $atts['align'] );

		} else {

			$align = "center";

		}

		/*====== HTML Output ======*/
		if( !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) or !empty( $atts["description"] ) ) {

			$output .= '<div class="gt-heading gt-' . esc_attr( $atts["title"] ) . ' gt-' . esc_attr( $atts["size"] ) . ' gt-align-' . esc_attr( $align ) . '">';

				if( !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) ) {

					$output .= '<div class="gt-title">';

						if( !empty( $atts["titleone"] ) ) {

							$output .= esc_attr( $atts["titleone"] );

						}

						if( !empty( $atts["titleone"] ) and !empty( $atts["titletwo"] ) ) {

							$output .= ' ';

						}

						if( !empty( $atts["titletwo"] ) ) {

							$output .= '<span>' . esc_attr( $atts["titletwo"] ) . '</span>';

						}

					$output .= '</div>';

				}

				if( $atts["separator"] == "true" ) {

					$output .= '<div class="gt-separate">';

						if( !empty( $atts["icon"] ) ) {

							$output .= '<i class="' . esc_attr( $atts["icon"] ) . '"></i>';

						} elseif( !empty( $atts["svg-icon"] ) ) {

							$output .= '<div class="gt-icon">';
								$output .= rawurldecode( base64_decode( $atts["svg-icon"] ) );
							$output .= '</div>';

						} else {

							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>';

						}

					$output .= '</div>';

				}

				if( !empty( $atts["description"] ) ) {

					$output .= '<div class="gt-text">' . esc_attr( $atts["description"] ) . '</div>';

				}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_content_title", "eventchamp_content_title_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Heading', 'eventchamp' ),
				"base" => "eventchamp_content_title",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/heading.jpg',
				"description" => esc_html__( 'Heading element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "title",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						'save_always' => true,
						"admin_label" => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'dark',
							esc_html__( 'Style 2', 'eventchamp' ) => 'white',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "size",
						"heading" => esc_html__( 'Size', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a size.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Size 1', 'eventchamp' ) => 'size1',
							esc_html__( 'Size 2', 'eventchamp' ) => 'size2',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "align",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "titleone",
						"heading" => esc_html__( 'Primary Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "titletwo",
						"heading" => esc_html__( 'Secondary Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "description",
						"heading" => esc_html__( 'Description Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "separator",
						"heading" => esc_html__( 'Separator', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the separator.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'True', 'eventchamp' ) => 'true',
							esc_html__( 'False', 'eventchamp' ) => 'false',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "icon",
						"heading" => esc_html__( 'Font Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an icon. If you want to use SVG icon, enter blank it. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textarea_raw_html",
						"param_name" => "svg-icon",
						"heading" => esc_html__( 'SVG Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a SVG icon code.', 'eventchamp' ),
						"save_always" => true,
					),
				),
			)
		);

	}

}



/*======
*
* Counter
*
======*/
if( !function_exists( 'eventchamp_step_boxes_shortcode' ) ) {

	function eventchamp_step_boxes_shortcode( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '',
				'align' => '',
				'countertitle' => '',
				'counternumber' => '',
				'delay' => '',
				'time' => '',
			), $atts
		);
		
		$output = '';

		/*====== Delay ======*/
		if( empty( $atts["delay"] ) ) {

			$atts["delay"] = "10";

		}

		/*====== Time ======*/
		if( empty( $atts["time"] ) ) {

			$atts["time"] = "2000";

		}

		/*====== HTML Output ======*/
		if( !empty( $atts['counternumber'] ) or !empty( $atts['countertitle'] ) ) {

			$output .= '<div class="gt-counter gt-' . esc_attr( $atts["style"] ) . ' gt-align-' . esc_attr( $atts["align"] ) . '" data-gt-delay="' . esc_attr( $atts["delay"] ) . '" data-gt-time="' . esc_attr( $atts["time"] ) . '">';

				if( !empty( $atts['counternumber'] ) ) {

					if( !empty( $atts['counternumber'] ) ) {

						$counternumber = esc_attr( $atts['counternumber'] );

					} else {

						$counternumber = "1";

					}

					if( !empty( $atts['counternumber'] ) ) {

						$output .= '<div class="gt-number">' . esc_attr( $atts['counternumber'] ) . '</div>';

					}

					if( !empty( $atts['countertitle'] ) ) {

						$output .= '<div class="gt-title">' . esc_attr( $atts['countertitle'] ) . '</div>';

					}

				}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_step_boxes", "eventchamp_step_boxes_shortcode" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Counter', 'eventchamp' ),
				"base" => "eventchamp_step_boxes",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/counter.jpg',
				"description" => esc_html__( 'Number counter element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'colored',
							esc_html__( 'Style 2', 'eventchamp' ) => 'white',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "align",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "countertitle",
						"heading" => esc_html__( 'Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
						"admin_label" => true,
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "counternumber",
						"heading" => esc_html__( 'Number', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a number.', 'eventchamp' ),
						"admin_label" => true,
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "delay",
						"heading" => esc_html__( 'Delay', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a delay value. The delay in milliseconds per number count up. Default: 10.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "time",
						"heading" => esc_html__( 'Time', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a time. The total duration of the count up animation. Default: 2000.', 'eventchamp' ),
						'save_always' => true,
					),
				)
			)
		);

	}

}



/*======
*
* Google Maps
*
======*/
if( !function_exists( 'eventchamp_google_maps_output' ) ) {

	function eventchamp_google_maps_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'map-height' => '450px',
				'map-style' => '1',
				'map-lat' => '1',
				'map-lng' => '1',
				'map-zoom' => '13',
				'map-zoom-control' => 'false',
				'map-icon' => '',
				'map-type' => 'false',
				'map-scale' => 'false',
				'map-fullscreen' => 'false',
				'map-streets' => 'false',
				'markers' => '',
			), $atts
		);
		
		$output = '';

		/*====== Map Zoom ======*/
		if( empty( $atts["map-zoom"] ) ) {

			$atts["map-zoom"] = "13";

		}

		/*====== Map Height ======*/
		if( empty( $atts["map-height"] ) ) {

			$atts["map-height"] = "450px";

		}

		/*====== Map Style ======*/
		if( empty( $atts["map-style"] ) ) {

			$atts["map-style"] = "1";

		}

		/*====== Map Lat ======*/
		if( empty( $atts["map-lat"] ) ) {

			$atts["map-lat"] = "1";

		}

		/*====== Map Lng ======*/
		if( empty( $atts["map-lng"] ) ) {

			$atts["map-lng"] = "1";

		}

		/*====== Map Icon ======*/
		if( !empty( $atts["map-icon"] ) ) {

			$map_icon = wp_get_attachment_image_src( esc_attr( $atts["map-icon"] ), 'full' )[0];

		} else {

			$map_icon = get_template_directory_uri() . '/include/assets/img/map-marker.png';

		}

		/*====== Markers ======*/
		$markers = vc_param_group_parse_atts( $atts['markers'] );

		/*====== HTML Output ======*/
		$output .= '<div class="gt-map gt-google-maps">';
			$output .= '<div id="google_maps" class="gt-map-inner" style="height:' . esc_attr( $atts["map-height"] ) .  '"></div>';
			$output .= '<ul data-zoom="' . esc_attr( $atts["map-zoom"] ) . '" data-lat="' . esc_attr( $atts["map-lat"] ) . '" data-lng="' . esc_attr( $atts["map-lng"] ) . '" data-type="' . esc_attr( $atts["map-type"] ) . '" data-scale="' . esc_attr( $atts["map-scale"] ) . '" data-zoom-control="' . esc_attr( $atts["map-zoom-control"] ) . '" data-map-style="' . esc_attr( $atts["map-style"] ) . '" data-street="' . esc_attr( $atts["map-streets"] ) . '" data-icon="' . esc_url( $map_icon ) . '" data-fullscreen="' . esc_attr( $atts["map-fullscreen"] ) . '" data-first-info="false" data-close-icon="">';

				if( !empty( $markers ) ) {

					foreach ( $markers as $marker ) {

						if( !empty( $marker ) ) {

							if( !empty( $marker["map-icon"] ) ) {

								$map_icon = wp_get_attachment_image_src( esc_attr( $marker["map-icon"] ), 'full' )[0];

							}

							$output .= '<li data-lat="' . esc_attr( $marker["marker-lat"] ) . '" data-lng="' . esc_attr( $marker["marker-lng"] ) . '" data-icon="' . esc_url( $map_icon ) . '"></li>';

						}

					}

				}

			$output .= '</ul>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_google_maps", "eventchamp_google_maps_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Google Maps', 'eventchamp' ),
				"base" => "eventchamp_google_maps",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/map.jpg',
				"description" => esc_html__( 'Google Map element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "map-height",
						"heading" => esc_html__( 'Map Height', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a map height. If you want to make it full height, enter 100vh value. Default: 450px', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-style",
						"heading" => esc_html__( 'Map Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a map style.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
							esc_html__( 'Style 7', 'eventchamp' ) => '7',
							esc_html__( 'Style 8', 'eventchamp' ) => '8',
							esc_html__( 'Style 9', 'eventchamp' ) => '9',
							esc_html__( 'Style 10', 'eventchamp' ) => '10',
							esc_html__( 'Style 11', 'eventchamp' ) => '11',
							esc_html__( 'Style 12', 'eventchamp' ) => '12',
							esc_html__( 'Style 13', 'eventchamp' ) => '13',
							esc_html__( 'Style 14', 'eventchamp' ) => '14',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "map-lat",
						"heading" => esc_html__( 'Map Lat', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a lat coordinate. The map will open on this lat coordinate.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "map-lng",
						"heading" => esc_html__( 'Map Lng', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a lng coordinate. The map will open on this lng coordinate.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "map-zoom",
						"heading" => esc_html__( 'Map Zoom', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a map zoom value. Default: 13', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-zoom-control",
						"heading" => esc_html__( 'Map Zoom Control', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map zoom control.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "attach_image",
						"param_name" => "map-icon",
						"heading" => esc_html__( 'Map Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can upload a map icon. If you will not upload any map icon, the default icon will show.', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-type",
						"heading" => esc_html__( 'Map Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map type.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-scale",
						"heading" => esc_html__( 'Map Scale', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map scale.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-fullscreen",
						"heading" => esc_html__( 'Map Fullscreen', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map fullscreen control.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "map-streets",
						"heading" => esc_html__( 'Map Streets', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the map streets.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						'type' => 'param_group',
						'param_name' => 'markers',
						"heading" => esc_html__( 'Markers', 'eventchamp' ),
						"description" => esc_html__( 'You can create markers from this panel.', 'eventchamp' ),
						"save_always" => true,
						'params' => array(
							array(
								"type" => "textfield",
								"param_name" => "marker-lat",
								"heading" => esc_html__( 'Map Lat', 'eventchamp' ),
								"description" => esc_html__( 'You can enter a lat coordinate.', 'eventchamp' ),
								'save_always' => true,
							),
							array(
								"type" => "textfield",
								"param_name" => "marker-lng",
								"heading" => esc_html__( 'Map Lng', 'eventchamp' ),
								"description" => esc_html__( 'You can enter a lng coordinate.', 'eventchamp' ),
								'save_always' => true,
							),
							array(
								"type" => "attach_image",
								"param_name" => "map-icon",
								"heading" => esc_html__( 'Map Icon', 'eventchamp' ),
								"description" => esc_html__( 'You can upload a map icon for this marker. If you will not upload any map icon, the default icon will show.', 'eventchamp' ),
								'save_always' => true,
							),
						)
					),
				),
			)
		);

	}

}



/*======
*
* Contact Box
*
======*/
if( !function_exists( 'eventchamp_contact_box_output' ) ) {

	function eventchamp_contact_box_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'address' => '',
				'email' => '',
				'phone' => '',
				'fax' => '',
				'abouttext' => '',
				'about-link-status' => '',
				'aboutlink' => '',
			), $atts
		);
		
		$output = '';

		/*====== HTML Output ======*/
		if( !empty( $atts["address"] ) or !empty( $atts["email"] ) or !empty( $atts["phone"] ) or !empty( $atts["fax"] ) or !empty( $atts["abouttext"] ) or !empty( $atts["aboutlink"] ) ) {

			$output .= '<div class="gt-contact-box">';

				if( !empty( $atts["abouttext"] ) ) {

					$output .= '<div class="gt-item gt-text">';
						$output .= esc_attr( $atts["abouttext"] );
					$output .= '</div>';

				}

				if( !empty( $atts["address"] ) ) {

					$output .= '<div class="gt-item gt-address">';
						$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
						$output .= esc_attr( $atts["address"] );
					$output .= '</div>';

				}

				if( !empty( $atts["email"] ) ) {

					$output .= '<div class="gt-item gt-email">';
						$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>';
						$output .= '<a href="mailto:' . esc_attr( str_replace( ' ', '', $atts["email"] ) ) . '">';
						$output .= esc_attr( $atts["email"] );
					$output .= '</a></div>';

				}

				if( !empty( $atts["phone"] ) ) {

					$output .= '<div class="gt-item gt-phone">';
						$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>';
						$output .= '<a href="tel:+' . esc_attr( str_replace( ' ', '', $atts["phone"] ) ) . '">' . esc_attr( $atts["phone"] ) . '</a>';
					$output .= '</div>';

				}

				if( !empty( $atts["fax"] ) ) {

					$output .= '<div class="gt-item gt-fax">';
						$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>';
						$output .= esc_attr( $atts["fax"] );
					$output .= '</div>';

				}

				if( $atts["about-link-status"] == "true" ) {

					if( !empty( $atts["aboutlink"] ) ) {

						$href = $atts["aboutlink"];
						$href = vc_build_link( $href );

						if( !empty( $href["target"] ) ) {

							$target = $href["target"];

						} else {

							$target = "_parent";

						}

						$output .= '<div class="gt-item gt-link gt-button gt-style-2">';
							$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">' . esc_attr( $href["title"] ) . '</a>';
						$output .= '</div>';

					}

				}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_contact_box", "eventchamp_contact_box_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Contact Box', 'eventchamp' ),
				"base" => "eventchamp_contact_box",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/contact-box.jpg',
				"description" => esc_html__( 'Contact box element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "address",
						"heading" => esc_html__( 'Address', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an address.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "email",
						"heading" => esc_html__( 'Email Address', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an email address.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "phone",
						"heading" => esc_html__( 'Phone Number', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a phone number.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "fax",
						"heading" => esc_html__( 'Fax Number', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a fax number.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "abouttext",
						"heading" => esc_html__( 'Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "about-link-status",
						"heading" => esc_html__( 'Link Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the link.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "vc_link",
						"param_name" => "aboutlink",
						"heading" => esc_html__( 'Link', 'eventchamp' ),
						"description" => esc_html__( 'You can create a link.', 'eventchamp' ),
						"save_always" => true,
					),
				),
			)
		);

	}

}



/*======
*
* App Box
*
======*/
if( !function_exists( 'eventchamp_app_box_output' ) ) {

	function eventchamp_app_box_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'applestore' => '',
				'googleplay' => '',
				'windowstore' => '',
				'amazon' => '',
			), $atts
		);
		
		$output = '';

		/*====== HTML Output ======*/
		if( !empty( $atts["applestore"] ) or !empty( $atts["googleplay"] ) or !empty( $atts["windowstore"] ) or !empty( $atts["amazon"] ) ) {

			$output .= '<div class="gt-app-box">';

				if( !empty( $atts["applestore"] ) ) {

					$href = $atts["applestore"];
					$href = vc_build_link( $href );

					if( !empty( $href["target"] ) ) {

						$target = $href["target"];

					} else {
						
						$target = "_parent";

					}

					$output .= '<div class="gt-item gt-applestore">';
						$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"></path></svg>';
							$output .= '<div class="gt-inner">';
								$output .= '<span class="gt-name">' . esc_html__( 'Download via', 'eventchamp' ) . '</span>';
								$output .= '<span class="gt-app-name">' . esc_html__( 'Apple Store', 'eventchamp' ) . '</span>';
							$output .= '</div>';
						$output .= '</a>';
					$output .= '</div>';

				}

				if( !empty( $atts["googleplay"] ) ) {

					$href = $atts["googleplay"];
					$href = vc_build_link( $href );

					if( !empty( $href["target"] ) ) {

						$target = $href["target"];

					} else {

						$target = "_parent";

					}

					$output .= '<div class="gt-item gt-googleplay">';
						$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"></path></svg>';
							$output .= '<div class="gt-inner">';
								$output .= '<span class="gt-name">' . esc_html__( 'Download via', 'eventchamp' ) . '</span>';
								$output .= '<span class="gt-app-name">' . esc_html__( 'Google Play', 'eventchamp' ) . '</span>';
							$output .= '</div>';
						$output .= '</a>';
					$output .= '</div>';

				}

				if( !empty( $atts["windowstore"] ) ) {

					$href = $atts["windowstore"];
					$href = vc_build_link( $href );

					if( !empty( $href["target"] ) ) {

						$target = $href["target"];

					} else {

						$target = "_parent";

					}

					$output .= '<div class="gt-item gt-windowstore">';
						$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M0 93.7l183.6-25.3v177.4H0V93.7zm0 324.6l183.6 25.3V268.4H0v149.9zm203.8 28L448 480V268.4H203.8v177.9zm0-380.6v180.1H448V32L203.8 65.7z"></path></svg>';
							$output .= '<div class="gt-inner">';
								$output .= '<span class="gt-name">' . esc_html__( 'Download via', 'eventchamp' ) . '</span>';
								$output .= '<span class="gt-app-name">' . esc_html__( 'Windows', 'eventchamp' ) . '</span>';
							$output .= '</div>';
						$output .= '</a>';
					$output .= '</div>';

				}

				if( !empty( $atts["amazon"] ) ) {

					$href = $atts["amazon"];
					$href = vc_build_link( $href );

					if( !empty( $href["target"] ) ) {

						$target = $href["target"];

					} else {

						$target = "_parent";

					}

					$output .= '<div class="gt-item gt-amazon">';
						$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M257.2 162.7c-48.7 1.8-169.5 15.5-169.5 117.5 0 109.5 138.3 114 183.5 43.2 6.5 10.2 35.4 37.5 45.3 46.8l56.8-56S341 288.9 341 261.4V114.3C341 89 316.5 32 228.7 32 140.7 32 94 87 94 136.3l73.5 6.8c16.3-49.5 54.2-49.5 54.2-49.5 40.7-.1 35.5 29.8 35.5 69.1zm0 86.8c0 80-84.2 68-84.2 17.2 0-47.2 50.5-56.7 84.2-57.8v40.6zm136 163.5c-7.7 10-70 67-174.5 67S34.2 408.5 9.7 379c-6.8-7.7 1-11.3 5.5-8.3C88.5 415.2 203 488.5 387.7 401c7.5-3.7 13.3 2 5.5 12zm39.8 2.2c-6.5 15.8-16 26.8-21.2 31-5.5 4.5-9.5 2.7-6.5-3.8s19.3-46.5 12.7-55c-6.5-8.3-37-4.3-48-3.2-10.8 1-13 2-14-.3-2.3-5.7 21.7-15.5 37.5-17.5 15.7-1.8 41-.8 46 5.7 3.7 5.1 0 27.1-6.5 43.1z"></path></svg>';
							$output .= '<div class="gt-inner">';
								$output .= '<span class="gt-name">' . esc_html__( 'Download via', 'eventchamp' ) . '</span>';
								$output .= '<span class="gt-app-name">' . esc_html__( 'Amazon', 'eventchamp' ) . '</span>';
							$output .= '</div>';
						$output .= '</a>';
					$output .= '</div>';

				}

			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_app_box", "eventchamp_app_box_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'App Box', 'eventchamp' ),
				"base" => "eventchamp_app_box",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/app-box.jpg',
				"description" => esc_html__( 'App box element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "vc_link",
						"param_name" => "applestore",
						"heading" => esc_html__( 'Apple Store', 'eventchamp' ),
						"description" => esc_html__( 'You can create an Apple Store link.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "vc_link",
						"param_name" => "googleplay",
						"heading" => esc_html__( 'Google Play', 'eventchamp' ),
						"description" => esc_html__( 'You can create a Google Play link.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "vc_link",
						"param_name" => "windowstore",
						"heading" => esc_html__( 'Windows Store', 'eventchamp' ),
						"description" => esc_html__( 'You can create a Windows Store link.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "vc_link",
						"param_name" => "amazon",
						"heading" => esc_html__( 'Amazon', 'eventchamp' ),
						"description" => esc_html__( 'You can create an Amazon link.', 'eventchamp' ),
						"save_always" => true,
					),
				),
			)
		);

	}

}



/*======
*
* Button
*
======*/
if( !function_exists( 'eventchamp_button_output' ) ) {

	function eventchamp_button_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '1',
				'align' => 'left',
				'buttonlink' => '',
				'icon' => '',
				'svg-icon' => '',
				'inline' => '',
				'margin' => '',
			), $atts
		);
		
		$output = '';

		/*====== HTML Output ======*/
		if( !empty( $atts["buttonlink"] ) ) {

			$output .= '<div class="gt-button gt-style-' . esc_attr( $atts["style"] ) . ' gt-align-' . esc_attr( $atts["align"] ) . ' gt-inline-' . esc_attr( $atts["inline"] ) . ' gt-margin-' . esc_attr( $atts["margin"] ) . '">';

				$href = vc_build_link( $atts["buttonlink"] );

				if( !empty( $href["target"] ) ) {

					$target = $href["target"];

				} else {

					$target = "_parent";

				}

				$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '">';

					if( !empty( $atts["icon"] ) ) {

						$output .= '<i class="' . esc_attr( $atts["icon"] ) . '"></i>';

					} elseif( !empty( $atts["svg-icon"] ) ) {

						$output .= rawurldecode( base64_decode( $atts["svg-icon"] ) );

					}

					$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
				$output .= '</a>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_button", "eventchamp_button_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Button', 'eventchamp' ),
				"base" => "eventchamp_button",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/button.jpg',
				"description" => esc_html__( 'Button element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "align",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "vc_link",
						"param_name" => "buttonlink",
						"heading" => esc_html__( 'Button Link', 'eventchamp' ),
						"description" => esc_html__( 'You can create a button link.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "icon",
						"heading" => esc_html__( 'Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an icon. If you want to use SVG icon, enter blank it. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textarea_raw_html",
						"param_name" => "svg-icon",
						"heading" => esc_html__( 'SVG Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a SVG icon code.', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "inline",
						"heading" => esc_html__( 'Inline', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the inline.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "margin",
						"heading" => esc_html__( 'Margin', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the margin.', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Modal Button
*
======*/
if( !function_exists( 'eventchamp_modal_button_output' ) ) {

	function eventchamp_modal_button_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '1',
				'align' => 'left',
				'buttontitle' => '',
				'icon' => '',
				'svg-icon' => '',
				'inline' => 'false',
				'margin' => 'false',
				'text' => '',
				'content' => '',
				'shortcode' => '',
				'iframe' => '',
			), $atts
		);
		
		$output = '';

		/*====== Content ======*/
		 $atts['content'] = $content;

		/*====== Random Modal Number ======*/
		$rand = rand( 1, 99999 );

		/*====== HTML Output ======*/
		if( !empty( $atts["buttontitle"] ) ) {

			$output .= '<div class="gt-button gt-style-' . esc_attr( $atts["style"] ) . ' gt-align-' . esc_attr( $atts["align"] ) . ' gt-inline-' . esc_attr( $atts["inline"] ) . ' gt-margin-' . esc_attr( $atts["margin"] ) . '">';
				$output .= '<a data-toggle="modal" data-target="#modal-' . esc_attr( $rand ) . '">';

					if( !empty( $atts["icon"] ) ) {

						$output .= '<i class="' . esc_attr( $atts["icon"] ) . '"></i>';

					} elseif( !empty( $atts["svg-icon"] ) ) {

						$output .= rawurldecode( base64_decode( $atts["svg-icon"] ) );

					}

					$output .= '<span>' . esc_attr( $atts["buttontitle"] ) . '</span>';
				$output .= '</a>';
			$output .= '</div>';

			$output .= '<div class="modal fade gt-modal gt-large-modal gt-modal-button-modal" id="modal-' . esc_attr( $rand ) . '" tabindex="-6" role="dialog" aria-labelledby="modal-' . esc_attr( $rand ) . '-label">';
				$output .= '<div class="modal-dialog gt-modal-dialog modal-dialog-centered" role="document">';
					$output .= '<div class="modal-content gt-modal-content">';
						$output .= '<div class="modal-header gt-modal-header">';
							$output .= '<div class="gt-modal-title">' . esc_attr( $atts["buttontitle"] ) . '</div>';
							$output .= '<button type="button" class="gt-close" data-dismiss="modal" aria-label="' . esc_html__( 'Close', 'eventchamp' ) . '">';
								$output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 371.23 371.23" xml:space="preserve"> <polygon points="371.23,21.213 350.018,0 185.615,164.402 21.213,0 0,21.213 164.402,185.615 0,350.018 21.213,371.23 185.615,206.828 350.018,371.23 371.23,350.018 206.828,185.615 "/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
							$output .= '</button>';
						$output .= '</div>';
						$output .= '<div class="modal-body gt-modal-body">';

							if( !empty( $atts["text"] ) ) {

								$output .= '<div class="gt-modal-inner-content">' . wpautop( do_shortcode( $atts["text"] ) )  . '</div>';

							}

							if( !empty( $atts["content"] ) ) {

								$output .= '<div class="gt-modal-inner-content">' . wpautop( do_shortcode( $atts["content"] ) ) . '</div>';

							}

							if( !empty( $atts["shortcode"] ) ) {

								$output .= '<div class="gt-modal-inner-content">' . do_shortcode( '[mc4wp_form id="' . esc_attr( $atts["shortcode"] ) . '"]' ) . '</div>';

							}

							if( !empty( $atts["iframe"] ) ) {

								$output .= '<div class="gt-modal-inner-content"><iframe width="800" height="550" frameborder="0" src="' . esc_url( $atts["iframe"] ) . '"></iframe></div>';

							}

						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_modal_button", "eventchamp_modal_button_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Modal Button', 'eventchamp' ),
				"base" => "eventchamp_modal_button",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/button.jpg',
				"description" => esc_html__( 'Modal button element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "align",
						"heading" => esc_html__( 'Align', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an align.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Left', 'eventchamp' ) => 'left',
							esc_html__( 'Center', 'eventchamp' ) => 'center',
							esc_html__( 'Right', 'eventchamp' ) => 'right',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "buttontitle",
						"heading" => esc_html__( 'Title', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a button title.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"admin_label" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "icon",
						"heading" => esc_html__( 'Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an icon. If you want to use SVG icon, enter blank it. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textarea_raw_html",
						"param_name" => "svg-icon",
						"heading" => esc_html__( 'SVG Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a SVG icon code.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "inline",
						"heading" => esc_html__( 'Inline', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the inline.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "margin",
						"heading" => esc_html__( 'Margin', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the margin.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textarea",
						"param_name" => "text",
						"heading" => esc_html__( 'Standard Content', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a content.', 'eventchamp' ),
						"group" => esc_html__( 'Modal', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textarea_html",
						"param_name" => "content",
						"heading" => esc_html__( 'HTML Content', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a HTML content.', 'eventchamp' ),
						"group" => esc_html__( 'Modal', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textarea",
						"param_name" => "shortcode",
						"heading" => esc_html__( 'Shortcode', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a shortcode.', 'eventchamp' ),
						"group" => esc_html__( 'Modal', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "iframe",
						"heading" => esc_html__( 'Map Iframe Link', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a map iframe link.', 'eventchamp' ),
						"group" => esc_html__( 'Modal', 'eventchamp' ),
						"save_always" => true,
					)
				),
			)
		);

	}

}



/*======
*
* MailChimp Newsletter
*
======*/
if( !function_exists( 'eventchamp_mailchimp_newsletter_output' ) ) {

	function eventchamp_mailchimp_newsletter_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'id' => '',
				'style' => '',
			), $atts
		);
		
		$output = '';

		/*====== HTML Output ======*/
		if( !empty( $atts["id"] ) ) {

			$output = '<div class="gt-mailchimp-newsletter gt-' . esc_attr( $atts["style"] ) . '">';
				$output .= do_shortcode( '[mc4wp_form id="' . esc_attr( $atts["id"] ) . '"]' );
			$output .= '</div>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_mailchimp_newsletter", "eventchamp_mailchimp_newsletter_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'MailChimp Newsletter', 'eventchamp' ),
				"base" => "eventchamp_mailchimp_newsletter",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/mailchimp-newsletter.jpg',
				"description" => esc_html__( 'MailChimp newsletter element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'dark',
							esc_html__( 'Style 2', 'eventchamp' ) => 'white',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "id",
						"heading" => esc_html__( 'Form ID', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a MailChimp newsletter form id.', 'eventchamp' ),
						"admin_label" => true,
					),
				),
			)
		);

	}

}



/*======
*
* Social Links
*
======*/
if( !function_exists( 'eventchamp_social_links_element_output' ) ) {

	function eventchamp_social_links_element_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '',
			), $atts
		);

		$output = "";

		/*====== HTML Output ======*/
		$output .= '<div class="gt-social-links-element gt-style-' . esc_attr( $atts["style"] ) . '">';
			$output .= eventchamp_social_media_sites();
		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_social_links_element", "eventchamp_social_links_element_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Social Links', 'eventchamp' ),
				"base" => "eventchamp_social_links_element",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/social-links.jpg',
				"description" => esc_html__( 'Social links element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => '1',
							esc_html__( 'Style 2', 'eventchamp' ) => '2',
							esc_html__( 'Style 3', 'eventchamp' ) => '3',
							esc_html__( 'Style 4', 'eventchamp' ) => '4',
							esc_html__( 'Style 5', 'eventchamp' ) => '5',
							esc_html__( 'Style 6', 'eventchamp' ) => '6',
							esc_html__( 'Style 7', 'eventchamp' ) => '7',
						),
					),
				),
			)
		);

	}

}



/*======
*
* FAQ
*
======*/
if( !function_exists( 'eventchamp_faq_output' ) ) {

	function eventchamp_faq_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'first-open' => '',
				'all-open' => '',
				'items' => '',
			), $atts
		);

		$output = "";
		$i = 0;

		/*====== Items ======*/
		$items = vc_param_group_parse_atts( $atts['items'] );

		/*====== HTML Output ======*/
		if( !empty( $items ) ) {

			$output .= '<div class="gt-dropdown">';
				$output .= '<div class="gt-panel-group" id="faq-accardion" role="tablist" aria-multiselectable="true">';

					foreach ( $items as $item ) {

						if( !empty( $item ) ) {

							$i++;
							$faq_rand_id = rand( 0, 999999 );

							if( !empty( $item["title"] ) and !empty( $item["content"] ) ) {

								$output .= '<div class="gt-panel">';

									if( !empty( $item["title"] ) ) {

										$output .= '<div class="gt-panel-heading" role="tab" id="#faq-heading-' . esc_attr( $faq_rand_id ) . '">';
											$output .= '<a role="button" data-toggle="collapse" data-parent="#faq-accardion" href="#faq-collapse-' . esc_attr( $faq_rand_id ) . '" aria-expanded="true" aria-controls="faq-collapse-' . esc_attr( $faq_rand_id ) . '">';
												$output .= esc_attr( $item["title"] );
												$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
											$output .= '</a>';
										$output .= '</div>';

									}

									if( !empty( $item["content"] ) ) {

										if( $i == "1" and $atts["first-open"] == "true" ) {

											$output .= '<div id="faq-collapse-' . esc_attr( $faq_rand_id ) . '" class="gt-panel-collapse collapse show" role="tabpanel" aria-labelledby="faq-heading-' . esc_attr( $faq_rand_id ) . '">';

										} else {

											if( $atts["all-open"] == "on" ) {

												$output .= '<div id="faq-collapse-' . esc_attr( $faq_rand_id ) . '" class="gt-panel-collapse collapse show" role="tabpanel" aria-labelledby="faq-heading-' . esc_attr( $faq_rand_id ) . '">';

											} else {

												$output .= '<div id="faq-collapse-' . esc_attr( $faq_rand_id ) . '" class="gt-panel-collapse collapse" role="tabpanel" aria-labelledby="faq-heading-' . esc_attr( $faq_rand_id ) . '">';

											}

										}

											$output .= '<div class="gt-panel-body">';
												$output .= do_shortcode( wpautop( $item["content"] ) );
											$output .= '</div>';
										$output .= '</div>';

									}

								$output .= '</div>';
							}

						}

					}

				$output .= '</div>';
			$output .= '</div>';

			return $output;

		}

	}
	add_shortcode( "eventchamp_faq", "eventchamp_faq_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'FAQ', 'eventchamp' ),
				"base" => "eventchamp_faq",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/faq.jpg',
				"description" => esc_html__( 'You can create a FAQ list.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "first-open",
						"heading" => esc_html__( 'First Open', 'eventchamp' ),
						"description" => esc_html__( 'Will first item comes open automatically?', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "all-open",
						"heading" => esc_html__( 'All Open', 'eventchamp' ),
						"description" => esc_html__( 'All item comes open automatically?', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						'type' => 'param_group',
						'param_name' => 'items',
						"heading" => esc_html__( 'Items', 'eventchamp' ),
						"description" => esc_html__( 'You can create items from this panel.', 'eventchamp' ),
						"save_always" => true,
						'params' => array(
							array(
								"type" => "textfield",
								"param_name" => "title",
								"heading" => esc_html__( 'Title', 'eventchamp' ),
								"description" => esc_html__( 'You can enter a title.', 'eventchamp' ),
								"admin_label" => true,
								"save_always" => true,
							),
							array(
								"type" => "textarea",
								"param_name" => "content",
								"heading" => esc_html__( 'Text', 'eventchamp' ),
								"description" => esc_html__( 'You can enter a text.', 'eventchamp' ),
								"save_always" => true,
							),
						)
					),
				),
			)
		);

	}

}



/*======
*
* Icon List
*
======*/
if( !function_exists( 'eventchamp_icon_list_output' ) and !function_exists( 'eventchamp_icon_list_item_shortcode' ) ) {

	function eventchamp_icon_list_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'style' => '',
			), $atts
		);

		$output = '';

		/*====== HTML Output ======*/
		$output .= '<div class="gt-icon-list gt-' . esc_attr( $atts["style"] ) . '">';
			$output .= '<ul>';
				$output .= do_shortcode( $content );
			$output .= '</ul>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( "eventchamp_icon_list", "eventchamp_icon_list_output" );

	function eventchamp_icon_list_item_shortcode( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'text' => '',
				'icon' => '',
				'svg-icon' => '',
			), $atts
		);
		
		$output = '';

		/*====== HTML Output ======*/
		if( !empty( $atts["text"] ) ) {

			$output .= '<li>';

				if( !empty( $atts["icon"] ) ) {

					$output .= '<i class="' . esc_attr( $atts["icon"] ) . '"></i>';

				} elseif( !empty( $atts["svg-icon"] ) ) {

					$output .= rawurldecode( base64_decode( $atts["svg-icon"] ) );

				}

				if( !empty( $atts["text"] ) ) {

					$output .= '<div class="text">' . esc_attr( $atts["text"] ) . '</div>';

				}

			$output .= '</li>';

		}

		return $output;

	}
	add_shortcode( "eventchamp_icon_list_item", "eventchamp_icon_list_item_shortcode" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Icon List', 'eventchamp' ),
				"base" => "eventchamp_icon_list",
				"as_parent" => array( 'only' => 'eventchamp_icon_list_item' ),
				"js_view" => "VcColumnView",
				"content_element" => true,
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/icon-list.jpg',
				"description" => esc_html__( 'Icon list element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						'admin_label' => true,
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
						),
					),
				)
			)
		);

	}

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'Icon List Item', 'eventchamp' ),
				"base" => "eventchamp_icon_list_item",
				"as_child" => array( 'only' => 'eventchamp_icon_list' ),
				"content_element" => true,
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/icon-list.jpg',
				"description" => esc_html__( 'Icon list item element.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"param_name" => "text",
						"heading" => esc_html__( 'Text', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a text.', 'eventchamp' ),
						"admin_label" => true,
						"save_always" => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "icon",
						"heading" => esc_html__( 'Font Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an icon. If you want to use SVG icon, enter blank it. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
						"save_always" => true,
					),
					array(
						"type" => "textarea_raw_html",
						"param_name" => "svg-icon",
						"heading" => esc_html__( 'SVG Icon', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a SVG icon code.', 'eventchamp' ),
						"save_always" => true,
					),
				)
			)
		);

	}

	if( class_exists( 'WPBakeryShortCodesContainer' ) ) {

		class WPBakeryShortCode_eventchamp_icon_list extends WPBakeryShortCodesContainer {}

	}

}



/*======
*
* User Activity
*
======*/
if( !function_exists( 'eventchamp_user_activity_output' ) ) {

	function eventchamp_user_activity_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'content-type' => '',
				'post-type' => '',
				'count' => '',
				'offset' => '',
				'order' => '',
				'order-type' => '',
				'hide-expired-events' => '',
				'pagination' => '',
				'style' => '',
				'listing-column' => '',
				'event-listing-style' => '',
				'event-price' => '',
				'event-status' => '',
				'event-category' => '',
				'event-location' => '',
				'event-venue' => '',
				'event-date' => '',
				'event-start-time' => '',
				'event-ticket-amount' => '',
				'event-excerpt' => '',
				'speaker-listing-style' => '',
				'speaker-profession-company' => '',
				'speaker-short-biography' => '',
				'speaker-social-links' => '',
				'venue-location' => '',
				'venue-excerpt' => '',
			), $atts
		);
		
		$output = '';

		if( is_user_logged_in() ) {

			$current_user = wp_get_current_user();

			$user_liked_posts = get_user_option( "_liked_posts", $current_user->ID );
			$user_favorited_posts = get_user_option( "_favorited_posts", $current_user->ID );

			if( !empty( $user_liked_posts ) ) {

				$user_likes = array_reverse( $user_liked_posts, true );

			} else {

				$user_likes = "";

			}

			if( !empty( $user_favorited_posts ) ) {

				$user_favorites = array_reverse( $user_favorited_posts, true );

			} else {

				$user_favorites = "";

			}

			if( $atts["content-type"] == "likes" and !empty( $user_likes ) or $atts["content-type"] == "favorites" and !empty( $user_favorites ) ) {

				/*====== Main Query ======*/
				$arg = array(
					'post_status' => 'publish',
				);

				/*====== Post Type ======*/
				if( $atts["post-type"] == "all" ) {

					$extra_query = array(
						'post_type' => array( 'event', 'speaker', 'venue' ),
					);
					$arg = wp_parse_args( $arg, $extra_query );

				}

				if( $atts["post-type"] == "events" ) {

					$extra_query = array(
						'post_type' => 'event',
					);
					$arg = wp_parse_args( $arg, $extra_query );

				}

				if( $atts["post-type"] == "venues" ) {

					$extra_query = array(
						'post_type' => 'venue',
					);
					$arg = wp_parse_args( $arg, $extra_query );

				}

				if( $atts["post-type"] == "speakers" ) {

					$extra_query = array(
						'post_type' => 'speaker',
					);
					$arg = wp_parse_args( $arg, $extra_query );

				}

				/*====== Pagination ======*/
				$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );

				if( empty( $paged ) ) {

					$paged = 1;

				}

				if( !empty( $paged ) ) {

					$extra_query = array(
						'paged' => $paged,
					);
					$arg = wp_parse_args( $arg, $extra_query );

				}

				/*====== Order & Order By ======*/
				if( !empty( $atts["order"] ) ) {

					if( $atts["order"] == "ASC" ) {

						$order = "ASC";

					} else {

						$order = "DESC";

					}

				}

				if( !empty( $atts["order"] ) ) {

					$extra_query = array(
						'order' => $order,
					);
					$arg = wp_parse_args( $arg, $extra_query );

				}

				if( !empty( $atts["order-type"] ) ) {

					if( $atts["order-type"] == "popular-comment" ) {

						$order_by = "comment_count";

					} elseif( $atts["order-type"] == "id" ) {

						$order_by = "ID";

					} elseif( $atts["order-type"] == "popular" ) {

						$order_by = "comment_count";

					} elseif( $atts["order-type"] == "title" ) {

						$order_by = "title";

					} elseif( $atts["order-type"] == "menu_order" ) {

						$order_by = "menu_order";

					} elseif( $atts["order-type"] == "rand" ) {

						$order_by = "rand";

					} elseif( $atts["order-type"] == "none" ) {

						$order_by = "none";

					} elseif( $atts["order-type"] == "liked-favorited-date" ) {

						$order_by = "post__in";

					} else {

						$order_by = "date";

					}

				}

				if( !empty( $order_by ) ) {

					$extra_query = array(
						'orderby' => $order_by,
					);
					$arg = wp_parse_args( $arg, $extra_query );

				}

				/*====== Count ======*/
				if( !empty( $atts["count"] ) ) {

					$extra_query = array(
						'posts_per_page' => $atts["count"],
					);
					$arg = wp_parse_args( $arg, $extra_query );

				}

				/*====== Offset ======*/
				if( !empty( $atts["offset"] ) ) {

					$extra_query = array(
						'offset' => $atts["offset"],
					);
					$arg = wp_parse_args( $arg, $extra_query );

				}

				/*====== Remove Expired Events to Likes and Favorites ======*/
				if( $atts["hide-expired-events"] == "true" ) {

					$expired_events_ids = eventchamp_expired_event_ids();

					$user_favorites = array_intersect( $user_favorites, $expired_events_ids );
					$user_likes = array_intersect( $user_likes, $expired_events_ids );

				}

				/*====== Include Contents ======*/
				if( $atts["content-type"] == "favorites" and !empty( $user_favorites ) ) {

					if( !empty( $user_favorites ) ) {

						$extra_query = array(
							'post__in' => $user_favorites,
						);
						$arg = wp_parse_args( $arg, $extra_query );

					}

				} elseif( !empty( $user_likes ) ) {

					if( !empty( $user_likes ) ) {

						$extra_query = array(
							'post__in' => $user_likes,
						);
						$arg = wp_parse_args( $arg, $extra_query );

					}

				}

				/*====== HTML Output ======*/
				$output .= '<div class="gt-user-activity">';

					$wp_query = new WP_Query( $arg );

					if( !empty( $wp_query ) ) {

						if( $wp_query->have_posts() ) {

							if( $atts["style"] == "activity-style" ) {

								$output .= '<ul>';

									while( $wp_query->have_posts() ) {

										$wp_query->the_post();

										$output .= '<li>';
											$output .= '<a href="' . get_the_permalink() . '">';

												if( get_post_type( get_the_ID() ) == "event" ) {

												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59 59" xml:space="preserve"> <g> <path d="M51.179,40.429l-5.596,8.04l-3.949-3.241c-0.426-0.352-1.057-0.288-1.407,0.138c-0.351,0.427-0.289,1.058,0.139,1.407 l4.786,3.929c0.18,0.148,0.404,0.228,0.634,0.228c0.045,0,0.091-0.003,0.137-0.01c0.276-0.038,0.524-0.19,0.684-0.419l6.214-8.929 c0.315-0.453,0.204-1.076-0.25-1.392C52.116,39.861,51.494,39.975,51.179,40.429z"></path> <path d="M52,34.479V15V5c0-0.553-0.448-1-1-1h-5V1c0-0.553-0.448-1-1-1h-7c-0.552,0-1,0.447-1,1v3H15V1c0-0.553-0.448-1-1-1H7 C6.448,0,6,0.447,6,1v3H1C0.448,4,0,4.447,0,5v10v41c0,0.553,0.448,1,1,1h38.104c2.002,1.26,4.362,2,6.896,2 c7.168,0,13-5.832,13-13C59,40.997,56.154,36.651,52,34.479z M39,2h5v3v3h-5V5V2z M8,2h5v3v3H8V5V2z M2,6h4v3c0,0.553,0.448,1,1,1 h7c0.552,0,1-0.447,1-1V6h22v3c0,0.553,0.448,1,1,1h7c0.552,0,1-0.447,1-1V6h4v8H2V6z M2,55V16h48v17.636 c-0.196-0.063-0.396-0.114-0.596-0.169c-0.185-0.051-0.37-0.101-0.557-0.144c-0.169-0.038-0.34-0.071-0.511-0.102 c-0.244-0.045-0.489-0.082-0.735-0.113c-0.137-0.017-0.273-0.036-0.411-0.049C46.796,33.024,46.399,33,46,33 c-0.338,0-0.669,0.025-1,0.051V32v-2v-9h-9h-2h-7h-2h-7h-2H7v9v2v7v2v9h9h2h7h2h6.636c0.029,0.088,0.065,0.173,0.095,0.26 c0.084,0.243,0.167,0.487,0.266,0.724c0.055,0.133,0.12,0.26,0.18,0.39c0.115,0.254,0.232,0.507,0.363,0.753 c0.058,0.107,0.123,0.21,0.184,0.316c0.148,0.259,0.298,0.515,0.464,0.763c0.061,0.091,0.128,0.177,0.191,0.267 c0.176,0.25,0.356,0.498,0.551,0.736c0.072,0.088,0.15,0.17,0.224,0.256c0.155,0.18,0.303,0.364,0.468,0.536H2z M40.313,34.328 c-0.108,0.052-0.218,0.101-0.324,0.156c-0.188,0.098-0.37,0.206-0.552,0.313c-0.159,0.093-0.318,0.188-0.473,0.287 c-0.157,0.102-0.31,0.206-0.462,0.314c-0.173,0.122-0.341,0.25-0.508,0.38c-0.134,0.105-0.268,0.209-0.397,0.32 c-0.175,0.148-0.342,0.305-0.509,0.462c-0.115,0.109-0.234,0.214-0.345,0.326c-0.181,0.184-0.352,0.379-0.522,0.574 c-0.072,0.083-0.151,0.159-0.222,0.244V32h7v1.362c-0.017,0.004-0.033,0.01-0.049,0.014C42.029,33.599,41.147,33.92,40.313,34.328z M33.57,42.199c-0.035,0.115-0.058,0.233-0.09,0.349c-0.08,0.29-0.162,0.58-0.222,0.879c-0.047,0.231-0.073,0.467-0.107,0.701 c-0.027,0.189-0.065,0.375-0.085,0.567C33.023,45.126,33,45.562,33,46c0,0.361,0.02,0.726,0.053,1.092 c0.006,0.067,0.006,0.135,0.013,0.202c0.016,0.162,0.048,0.319,0.07,0.479c0,0,0,0.001,0,0.001 c0.011,0.076,0.015,0.151,0.027,0.226H27v-7h7v0.007c-0.01,0.024-0.016,0.049-0.026,0.073 C33.824,41.445,33.687,41.818,33.57,42.199z M9,41h7v7H9V41z M9,32h7v7H9V32z M43,30h-7v-7h7V30z M34,30h-7v-7h7V30z M34,39h-7v-7 h7V39z M18,32h7v7h-7V32z M25,30h-7v-7h7V30z M16,30H9v-7h7V30z M18,41h7v7h-7V41z M46,57c-2.258,0-4.359-0.686-6.107-1.858 c-0.341-0.228-0.663-0.476-0.972-0.736c-0.108-0.092-0.21-0.19-0.314-0.286c-0.197-0.179-0.388-0.363-0.57-0.554 c-0.117-0.123-0.23-0.248-0.341-0.375c-0.164-0.189-0.318-0.384-0.468-0.583c-0.096-0.127-0.195-0.25-0.286-0.381 c-0.221-0.321-0.429-0.651-0.615-0.993c-0.043-0.08-0.077-0.164-0.118-0.245c-0.146-0.286-0.282-0.576-0.403-0.874 c-0.052-0.13-0.097-0.263-0.145-0.395c-0.094-0.262-0.18-0.528-0.255-0.797c-0.017-0.062-0.032-0.124-0.048-0.186 c-0.113-0.44-0.196-0.877-0.255-1.312c-0.004-0.031-0.01-0.062-0.014-0.094C35.031,46.882,35,46.437,35,46 c0-0.379,0.019-0.755,0.058-1.128c0.003-0.031,0.011-0.061,0.014-0.092c0.038-0.341,0.088-0.681,0.158-1.016 c0.007-0.032,0.018-0.063,0.025-0.095c0.072-0.332,0.157-0.662,0.26-0.988c0.012-0.038,0.029-0.075,0.041-0.113 c0.103-0.312,0.217-0.622,0.349-0.926c0.124-0.286,0.258-0.567,0.405-0.84l0.099-0.171c0.04-0.072,0.087-0.14,0.129-0.211 c0.174-0.293,0.36-0.577,0.557-0.851c0.049-0.068,0.1-0.135,0.151-0.202c0.18-0.238,0.37-0.467,0.568-0.688 c0.069-0.077,0.138-0.155,0.209-0.23c0.196-0.208,0.402-0.405,0.613-0.596c0.075-0.068,0.148-0.138,0.225-0.204 c0.248-0.212,0.505-0.411,0.77-0.6c0.042-0.03,0.082-0.063,0.124-0.093c1.305-0.902,2.804-1.52,4.412-1.79l0.021-0.003 C44.778,35.064,45.381,35,46,35c0.389,0,0.776,0.021,1.16,0.063c0.06,0.006,0.118,0.02,0.178,0.027 c0.328,0.041,0.655,0.09,0.978,0.16c0.04,0.009,0.078,0.021,0.117,0.03c0.344,0.079,0.685,0.171,1.022,0.284 c0.023,0.008,0.045,0.017,0.068,0.025c0.345,0.118,0.685,0.253,1.022,0.406C54.347,37.729,57,41.557,57,46 C57,52.065,52.065,57,46,57z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';

													$output .= sprintf( esc_html__( '%1$s has liked %2$s event.', 'eventchamp' ), $current_user->display_name, get_the_title() );

												} elseif( get_post_type( get_the_ID() ) == "speaker" ) {

													$output .= '<svg viewBox="0 0 497 497.048" xmlns="http://www.w3.org/2000/svg"><path d="m359.015625 375.574219-102.992187-28.605469v-24.769531l21.703124 6.511719 11.464844.335937c25.824219 0 46.832032-21.007813 46.832032-46.832031 0-4.765625 1.128906-9.527344 3.257812-13.789063l9.695312-19.402343c10.589844-.496094 19.046876-9.269532 19.046876-19.976563 0-4.292969-1.414063-8.550781-4-12l-2.984376-3.976563c-10.976562-14.628906-17.015624-32.757812-17.015624-51.054687 0-8.390625-2.121094-16.449219-6.0625-23.589844l2.648437-2.648437c17.679687-17.679688 27.414063-41.183594 27.414063-66.191406 0-20.121094-6.648438-40.074219-18.71875-56.171876l-10.089844-13.414062-5.152344 1.289062c-41.816406 10.453126-85.191406 15.757813-128.925781 15.757813h-4.394531c-70.972657 0-128.71875 57.746094-128.71875 128.722656 0 21.824219 5.601562 43.4375 16.550781 63.085938l27.929687 41.511719c8.144532 12.089843 14.609375 25.25 19.222656 39.097656 5.503907 16.511718 8.296876 33.703125 8.296876 51.101562v6.402344l-102.992188 28.605469c-24.144531 6.714843-41.0078125 28.898437-41.0078125 53.960937v67.511719h400.0000005v-67.511719c0-25.0625-16.863282-47.246094-41.007813-53.960937zm-109.609375-13.839844 5.792969 1.609375-11.847657 47.398438-29.984374-24.980469zm98.832031-139.0625 2.976563 3.96875c.527344.703125.808594 1.535156.808594 2.40625 0 2.210937-1.792969 4-4 4h-8.945313l-14.101563 28.21875c-3.242187 6.460937-4.953124 13.710937-4.953124 20.949219 0 17-13.832032 30.832031-30.832032 30.832031h-7.992187l-78.878907-23.664063-4.59375 15.328126 42.296876 12.6875v31.371093l-40 26.664063-40-26.664063v-8.203125c0-7.589844-.625-15.132812-1.582032-22.621094l2.949219-2.953124c19.753906-19.753907 30.632813-46.015626 30.632813-73.945313v-8h-16c-8.824219 0-16-7.175781-16-16s7.175781-16 16-16h16v-18.382813c0-12.128906 4.167968-24.023437 11.746093-33.496093 10.238281-12.785157 25.496094-20.121094 41.871094-20.121094h49.414063c8.808593 0 17.089843 3.433594 23.3125 9.65625 6.226562 6.226563 9.65625 14.511719 9.65625 23.3125 0 21.738281 7.175781 43.273437 20.214843 60.65625zm-197.597656 139.0625 36.039063 24.027344-29.984376 24.980469-11.847656-47.398438zm-20.863281-120.292969-27.570313-40.9375c-9.277343-16.695312-14.183593-35.625-14.183593-54.734375 0-62.152343 50.570312-112.722656 112.71875-112.722656h4.394531c43.359375 0 86.382812-5.0625 127.664062-14.976563l3.703125 4.945313c10.007813 13.351563 15.519532 29.886719 15.519532 46.570313 0 20.726562-8.070313 40.214843-22.726563 54.878906l-1.351563 1.351562c-9.035156-8.222656-20.601562-12.769531-32.890624-12.769531h-49.414063c-21.265625 0-41.074219 9.519531-54.359375 26.128906-9.839844 12.296875-15.257812 27.734375-15.257812 43.488281v2.382813c-17.648438 0-32 14.351563-32 32 0 17.527344 14.167968 31.808594 31.648437 32-1.625 18.265625-8.824219 35.359375-20.734375 49.335937-1.152344-4.703124-2.488281-9.367187-4.027344-13.976562-5.070312-15.222656-12.191406-29.679688-21.132812-42.964844zm254.246094 239.605469h-368v-51.511719c0-17.894531 12.046874-33.75 29.296874-38.542968l84.105469-23.359376 17.933594 71.71875 52.664063-43.886718 52.664062 43.894531 17.9375-71.71875 84.101562 23.359375c17.25 4.785156 29.296876 20.632812 29.296876 38.535156zm0 0"/><path d="m463.214844 169.855469-11.3125 11.3125c18.136718 18.128906 28.121094 42.238281 28.121094 67.878906s-9.984376 49.753906-28.121094 67.882813l11.3125 11.308593c21.160156-21.148437 32.808594-49.269531 32.808594-79.191406 0-29.917969-11.648438-58.039063-32.808594-79.191406zm0 0"/><path d="m440.59375 192.480469-11.3125 11.3125c12.085938 12.085937 18.742188 28.160156 18.742188 45.253906 0 17.097656-6.65625 33.167969-18.742188 45.257813l11.3125 11.3125c15.101562-15.105469 23.429688-35.203126 23.429688-56.570313s-8.328126-41.460937-23.429688-56.566406zm0 0"/><path d="m417.96875 215.105469-11.3125 11.308593c6.039062 6.050782 9.367188 14.089844 9.367188 22.632813 0 8.546875-3.328126 16.585937-9.367188 22.632813l11.3125 11.3125c9.0625-9.070313 14.054688-21.121094 14.054688-33.945313s-4.992188-24.871094-14.054688-33.941406zm0 0"/></svg>';

													$output .= sprintf( esc_html__( '%1$s has liked %2$s speaker.', 'eventchamp' ), $current_user->display_name, get_the_title() );

												} elseif( get_post_type( get_the_ID() ) == "venue" ) {

													$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 55.017 55.017" xml:space="preserve"> <g> <path d="M51.688,23.013H40.789c-0.553,0-1,0.447-1,1s0.447,1,1,1h9.102l2.899,27H2.268l3.403-27h9.118c0.553,0,1-0.447,1-1 s-0.447-1-1-1H3.907L0,54.013h55.017L51.688,23.013z"></path> <path d="M26.654,38.968c-0.147,0.087-0.304,0.164-0.445,0.255c-0.22,0.142-0.435,0.291-0.646,0.445 c-0.445,0.327-0.541,0.953-0.215,1.398c0.196,0.267,0.5,0.408,0.808,0.408c0.205,0,0.412-0.063,0.591-0.193 c0.178-0.131,0.359-0.257,0.548-0.379c0.321-0.208,0.662-0.403,1.014-0.581c0.468-0.237,0.658-0.791,0.462-1.269 c0.008-0.008,0.018-0.014,0.025-0.022c1.809-1.916,7.905-9.096,10.429-21.058c0.512-2.426,0.627-4.754,0.342-6.919 c-0.86-6.575-4.945-10.051-11.813-10.051c-6.866,0-10.951,3.476-11.813,10.051c-0.284,2.166-0.169,4.494,0.343,6.919 C18.783,29.818,24.783,36.97,26.654,38.968z M17.924,11.314c0.733-5.592,3.949-8.311,9.831-8.311c5.883,0,9.098,2.719,9.83,8.311 c0.255,1.94,0.148,4.043-0.316,6.247C35,28.314,29.59,35.137,27.755,37.207c-1.837-2.072-7.246-8.898-9.514-19.646 C17.776,15.357,17.67,13.255,17.924,11.314z"></path> <path d="M27.755,19.925c4.051,0,7.346-3.295,7.346-7.346s-3.295-7.346-7.346-7.346s-7.346,3.295-7.346,7.346 S23.704,19.925,27.755,19.925z M27.755,7.234c2.947,0,5.346,2.398,5.346,5.346s-2.398,5.346-5.346,5.346s-5.346-2.398-5.346-5.346 S24.808,7.234,27.755,7.234z"></path> <path d="M31.428,37.17c-0.54,0.114-0.884,0.646-0.769,1.187c0.1,0.47,0.515,0.791,0.977,0.791c0.069,0,0.14-0.007,0.21-0.022 c0.586-0.124,1.221-0.229,1.886-0.313c0.548-0.067,0.938-0.567,0.869-1.115c-0.068-0.549-0.563-0.945-1.115-0.869 C32.763,36.918,32.07,37.033,31.428,37.17z"></path> <path d="M36.599,37.576c0.022,0.537,0.466,0.957,0.998,0.957c0.015,0,0.029,0,0.044-0.001l2.001-0.083 c0.551-0.025,0.979-0.493,0.953-1.044c-0.025-0.553-0.539-0.984-1.044-0.954l-1.996,0.083 C37.003,36.557,36.575,37.023,36.599,37.576z"></path> <path d="M22.433,42.177c-0.514,0.388-1.045,0.761-1.58,1.107c-0.463,0.301-0.595,0.92-0.294,1.384 c0.191,0.295,0.513,0.455,0.84,0.455c0.187,0,0.375-0.052,0.544-0.161c0.573-0.372,1.144-0.772,1.695-1.188 c0.44-0.333,0.528-0.96,0.196-1.401C23.501,41.936,22.876,41.844,22.433,42.177z"></path> <path d="M44.72,35.583c-0.338,0.237-0.777,0.409-1.346,0.526c-0.541,0.111-0.889,0.641-0.777,1.182 c0.098,0.473,0.514,0.798,0.979,0.798c0.067,0,0.135-0.007,0.203-0.021c0.842-0.174,1.526-0.452,2.096-0.853l0.134-0.098 c0.44-0.334,0.527-0.961,0.194-1.401c-0.334-0.44-0.96-0.526-1.401-0.194L44.72,35.583z"></path> <path d="M8.86,43.402c0.145-0.533-0.171-1.082-0.704-1.226c-0.529-0.149-1.082,0.169-1.226,0.704 c-0.126,0.464-0.201,0.938-0.225,1.405C6.7,44.4,6.697,44.516,6.697,44.638c0.001,0.196,0.01,0.392,0.029,0.587 c0.053,0.515,0.487,0.898,0.994,0.898c0.033,0,0.067-0.002,0.103-0.005c0.549-0.057,0.949-0.547,0.894-1.097 c-0.014-0.131-0.019-0.264-0.02-0.39c0-0.083,0.003-0.166,0.007-0.248C8.72,44.059,8.772,43.728,8.86,43.402z"></path> <path d="M44.698,27.81c-0.794-0.106-1.604-0.041-2.386,0.181c-0.532,0.149-0.841,0.702-0.69,1.233 c0.124,0.441,0.525,0.729,0.961,0.729c0.091,0,0.182-0.012,0.272-0.038c0.52-0.146,1.055-0.192,1.575-0.122 c0.562,0.07,1.052-0.311,1.125-0.857C45.629,28.387,45.245,27.884,44.698,27.81z"></path> <path d="M46.688,32.764c-0.163,0.527,0.133,1.088,0.66,1.25c0.099,0.031,0.197,0.045,0.295,0.045c0.428,0,0.823-0.275,0.955-0.705 c0.099-0.318,0.16-0.641,0.183-0.963c0.005-0.083,0.008-0.167,0.008-0.25c0-0.468-0.086-0.937-0.255-1.392 c-0.192-0.519-0.771-0.781-1.285-0.59c-0.519,0.192-0.782,0.768-0.59,1.285c0.086,0.232,0.13,0.467,0.13,0.696l-0.003,0.117 C46.774,32.423,46.742,32.589,46.688,32.764z"></path> <path d="M17.481,45.164c-0.586,0.275-1.183,0.53-1.774,0.759c-0.515,0.198-0.771,0.777-0.572,1.293 c0.153,0.396,0.531,0.64,0.933,0.64c0.12,0,0.242-0.021,0.36-0.067c0.635-0.245,1.275-0.519,1.903-0.813 c0.5-0.234,0.715-0.83,0.48-1.33C18.578,45.145,17.984,44.928,17.481,45.164z"></path> <path d="M10.201,41.001c0.161,0,0.325-0.039,0.478-0.122c0.288-0.157,0.595-0.255,0.911-0.289c0.135-0.016,0.273-0.016,0.406,0.002 c0.563,0.073,1.05-0.313,1.122-0.86c0.072-0.548-0.313-1.05-0.86-1.122c-0.298-0.039-0.601-0.041-0.891-0.008 c-0.574,0.063-1.128,0.239-1.646,0.521c-0.485,0.265-0.664,0.871-0.399,1.356C9.504,40.813,9.847,41.001,10.201,41.001z"></path> <path d="M9.993,48.842c0.216,0.056,0.436,0.098,0.654,0.124c0.256,0.031,0.512,0.047,0.769,0.047c0.313,0,0.627-0.022,0.94-0.062 c0.548-0.069,0.937-0.569,0.867-1.117s-0.567-0.934-1.117-0.867c-0.404,0.052-0.812,0.064-1.216,0.015 c-0.132-0.017-0.264-0.042-0.394-0.075c-0.535-0.143-1.08,0.181-1.22,0.716C9.139,48.158,9.459,48.704,9.993,48.842z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';

													$output .= sprintf( esc_html__( '%1$s has liked %2$s venue.', 'eventchamp' ), $current_user->display_name, get_the_title() );

												}

											$output .= '</a>';
										$output .= '</li>';

									}

								$output .= '</ul>';

							} else {

								$output .= '<div class="gt-columns gt-' . esc_attr( $atts["listing-column"] ) . '">';

									while( $wp_query->have_posts() ) {

										$wp_query->the_post();

										$output .= '<div class="gt-col">';
											$output .= '<div class="gt-inner">';

												if( get_post_type( get_the_ID() ) == "event" ) {

													if( $atts["event-listing-style"] == "style-1" ) {

														$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $atts["event-category"], $date = $atts["event-date"], $location = $atts["event-location"], $excerpt = $atts["event-excerpt"], $status = $atts["event-status"], $price = $atts["event-price"], $venue = $atts["event-venue"], $ticket_amount = $atts["event-ticket-amount"], $time = $atts["event-start-time"] );

													} elseif( $atts["event-listing-style"] == "style-2" ) {

														$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = $atts["event-category"], $date = $atts["event-date"], $location = $atts["event-location"], $excerpt = $atts["event-excerpt"], $status = $atts["event-status"], $price = $atts["event-price"], $venue = $atts["event-venue"], $ticket_amount = $atts["event-ticket-amount"], $time = $atts["event-start-time"] );


													} elseif( $atts["event-listing-style"] == "style-3" ) {

														$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = $atts["event-category"], $date = $atts["event-date"], $location = $atts["event-location"], $excerpt = $atts["event-excerpt"], $status = $atts["event-status"], $price = $atts["event-price"], $venue = $atts["event-venue"], $ticket_amount = $atts["event-ticket-amount"], $time = $atts["event-start-time"] );

													}

												} elseif( get_post_type( get_the_ID() ) == "speaker" ) {

													if( $atts["speaker-listing-style"] == "style-1" ) {

														$output .= eventchamp_speaker_style_1( $post_id = get_the_ID(), $image = "true", $profession = $atts["speaker-profession-company"], $summary = $atts["speaker-short-biography"], $social = $atts["speaker-social-links"] );

													} elseif( $atts["speaker-listing-style"] == "style-2" ) {

														$output .= eventchamp_speaker_style_2( $post_id = get_the_ID(), $image = "true", $profession = $atts["speaker-profession-company"], $summary = $atts["speaker-short-biography"], $social = $atts["speaker-social-links"] );

													} elseif( $atts["speaker-listing-style"] == "style-3" ) {

														$output .= eventchamp_speaker_style_3( $post_id = get_the_ID(), $image = "true", $profession = $atts["speaker-profession-company"], $summary = $atts["speaker-short-biography"], $social = $atts["speaker-social-links"] );

													} elseif( $atts["speaker-listing-style"] == "style-4" ) {

														$output .= eventchamp_speaker_style_4( $post_id = get_the_ID(), $image = "true", $profession = $atts["speaker-profession-company"], $summary = $atts["speaker-short-biography"], $social = $atts["speaker-social-links"] );

													} elseif( $atts["speaker-listing-style"] == "style-5" ) {

														$output .= eventchamp_speaker_style_5( $post_id = get_the_ID(), $image = "true", $profession = $atts["speaker-profession-company"], $summary = $atts["speaker-short-biography"], $social = $atts["speaker-social-links"] );

													} elseif( $atts["speaker-listing-style"] == "style-6" ) {

														$output .= eventchamp_speaker_style_6( $post_id = get_the_ID(), $image = "true", $profession = $atts["speaker-profession-company"], $summary = $atts["speaker-short-biography"], $social = $atts["speaker-social-links"] );

													} elseif( $atts["speaker-listing-style"] == "style-7" ) {

														$output .= eventchamp_speaker_style_7( $post_id = get_the_ID(), $image = "true", $profession = $atts["speaker-profession-company"], $summary = $atts["speaker-short-biography"], $social = $atts["speaker-social-links"] );

													} elseif( $atts["speaker-listing-style"] == "style-8" ) {

														$output .= eventchamp_speaker_style_8( $post_id = get_the_ID(), $image = "true", $profession = $atts["speaker-profession-company"], $summary = $atts["speaker-short-biography"], $social = $atts["speaker-social-links"] );

													}

												} elseif( get_post_type( get_the_ID() ) == "venue" ) {

													$output .= eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = $atts["venue-location"], $excerpt = $atts["venue-excerpt"] );

												}

											$output .= '</div>';
										$output .= '</div>';

									}

								$output .= '</div>';

							}

						}

					}
					wp_reset_postdata();

					if( $atts['pagination'] == 'true' ) {

						$output .= eventchamp_element_pagination( $paged = $paged, $query = $wp_query );

					}
				$output .= '</div>';

			} else {

				$output .= wpautop( esc_html__( 'Your list of activities seems empty.', 'eventchamp' ) );

			}

		}

		return $output;

	}
	add_shortcode( "eventchamp_user_activity", "eventchamp_user_activity_output" );

	if( function_exists( 'vc_map' ) ) {

		vc_map(
			array(
				"name" => esc_html__( 'User Activity', 'eventchamp' ),
				"base" => "eventchamp_user_activity",
				"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
				"icon" => get_template_directory_uri() . '/include/assets/img/icons/user-activity.jpg',
				"description" => esc_html__( 'Get user activities.', 'eventchamp' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"param_name" => "content-type",
						"heading" => esc_html__( 'Content Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a content type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'Likes', 'eventchamp' ) => 'likes',
							esc_html__( 'Favorites', 'eventchamp' ) => 'favorites',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "post-type",
						"heading" => esc_html__( 'Post Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a post type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'admin_label' => true,
						"save_always" => true,
						"value" => array(
							esc_html__( 'All', 'eventchamp' ) => 'all',
							esc_html__( 'Events', 'eventchamp' ) => 'events',
							esc_html__( 'Venues', 'eventchamp' ) => 'venues',
							esc_html__( 'Speakers', 'eventchamp' ) => 'speakers',
						),
					),
					array(
						"type" => "textfield",
						"param_name" => "count",
						"heading" => esc_html__( 'Count', 'eventchamp' ),
						"description" => esc_html__( 'You can enter a content count. If you want to list all content, enter -1.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"param_name" => "offset",
						"heading" => esc_html__( 'Offset', 'eventchamp' ),
						"description" => esc_html__( 'You can enter an offset number.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"param_name" => "order",
						"heading" => esc_html__( 'Order', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
							esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "order-type",
						"heading" => esc_html__( 'Order Type', 'eventchamp' ),
						"description" => esc_html__( 'You can choose an order type.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						"save_always" => true,
						"value" => array(
							esc_html__( 'Liked and Favorited Date', 'eventchamp' ) => 'liked-favorited-date',
							esc_html__( 'Added Date', 'eventchamp' ) => 'added-date',
							esc_html__( 'Popular by Comment', 'eventchamp' ) => 'popular-comment',
							esc_html__( 'ID', 'eventchamp' ) => 'id',
							esc_html__( 'Title', 'eventchamp' ) => 'title',
							esc_html__( 'Menu Order', 'eventchamp' ) => 'menu_order',
							esc_html__( 'Random', 'eventchamp' ) => 'rand',
							esc_html__( 'None', 'eventchamp' ) => 'none',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "hide-expired-events",
						"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
						"description" => esc_html__( 'You can hide the expired events.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "pagination",
						"heading" => esc_html__( 'Pagination', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the pagination.', 'eventchamp' ),
						"group" => esc_html__( 'General', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "style",
						"heading" => esc_html__( 'Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Activity Style', 'eventchamp' ) => 'activity-style',
							esc_html__( 'Custom Style', 'eventchamp' ) => 'custom-style',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "listing-column",
						"heading" => esc_html__( 'Listing Column', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
						"group" => esc_html__( 'Design', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( '1 Column', 'eventchamp' ) => 'column-1',
							esc_html__( '2 Column', 'eventchamp' ) => 'column-2',
							esc_html__( '3 Column', 'eventchamp' ) => 'column-3',
							esc_html__( '4 Column', 'eventchamp' ) => 'column-4',
							esc_html__( '5 Column', 'eventchamp' ) => 'column-5',
							esc_html__( '6 Column', 'eventchamp' ) => 'column-6',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-listing-style",
						"heading" => esc_html__( 'Event Listing Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style-3',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-price",
						"heading" => esc_html__( 'Event Price', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event price.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-status",
						"heading" => esc_html__( 'Event Status', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event status.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-category",
						"heading" => esc_html__( 'Event Category', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event category.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-location",
						"heading" => esc_html__( 'Event Location', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event location.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-venue",
						"heading" => esc_html__( 'Event Venue', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event venue.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-date",
						"heading" => esc_html__( 'Event Start Date', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event date.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-start-time",
						"heading" => esc_html__( 'Event Start Time', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event start time.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-ticket-amount",
						"heading" => esc_html__( 'Event Ticket Amount', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event ticket amount.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "event-excerpt",
						"heading" => esc_html__( 'Event Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the event excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Event', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-listing-style",
						"heading" => esc_html__( 'Speaker Listing Style', 'eventchamp' ),
						"description" => esc_html__( 'You can choose a style.', 'eventchamp' ),
						"group" => esc_html__( 'Speaker', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'Style 1', 'eventchamp' ) => 'style-1',
							esc_html__( 'Style 2', 'eventchamp' ) => 'style-2',
							esc_html__( 'Style 3', 'eventchamp' ) => 'style-3',
							esc_html__( 'Style 4', 'eventchamp' ) => 'style-4',
							esc_html__( 'Style 5', 'eventchamp' ) => 'style-5',
							esc_html__( 'Style 6', 'eventchamp' ) => 'style-6',
							esc_html__( 'Style 7', 'eventchamp' ) => 'style-7',
							esc_html__( 'Style 8', 'eventchamp' ) => 'style-8',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-profession-company",
						"heading" => esc_html__( 'Speaker Profession / Company', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the speaker profession / company info. You can choose the field you want to show from the Theme Settings > Speakers page.', 'eventchamp' ),
						"group" => esc_html__( 'Speaker', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-short-biography",
						"heading" => esc_html__( 'Speaker Short Biography', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the speaker short biography.', 'eventchamp' ),
						"group" => esc_html__( 'Speaker', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "speaker-social-links",
						"heading" => esc_html__( 'Speaker Social Links', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the speaker social links.', 'eventchamp' ),
						"group" => esc_html__( 'Speaker', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "venue-location",
						"heading" => esc_html__( 'Venue Location', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the venue location.', 'eventchamp' ),
						"group" => esc_html__( 'Venue', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"param_name" => "venue-excerpt",
						"heading" => esc_html__( 'Venue Excerpt', 'eventchamp' ),
						"description" => esc_html__( 'You can choose status of the venue excerpt.', 'eventchamp' ),
						"group" => esc_html__( 'Venue', 'eventchamp' ),
						'save_always' => true,
						"value" => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
				),
			)
		);

	}

}



/*======
*
* Image Gallery
*
======*/
if( !function_exists( 'eventchamp_image_gallery_element_output' ) ) {

	function eventchamp_image_gallery_element_output( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'images' => '',
				'caption' => '',
				'column' => '',
				'column-space' => '',
			), $atts
		);

		$output = "";

		/*====== HTML Output ======*/
		if( !empty( $atts["images"] ) ) {

			$images = explode( ',', $atts["images"] );

			$rand = rand( 0, 9999 );

			$output .= '<div class="gt-image-gallery">';

				$output .= '<div class="gt-columns gt-column-' . esc_attr( $atts["column"] ) . ' gt-column-space-' . esc_attr( $atts["column-space"] ) . '">';

					foreach( $images as $image ) {

						if( !empty( $image ) ) {

							$output .= '<div class="gt-col">';

								$output .= '<div class="gt-inner">';

									$output .= '<div class="gt-photo">';

										$output .= '<a data-fancybox="gallery-' . esc_attr( $rand ) . '" href="' . wp_get_attachment_image_src( esc_attr( $image ), 'full' )[0] . '" data-srcset="' . wp_get_attachment_image_srcset( esc_attr( $image ), 'full' ) . '" data-caption="' . ( $atts["caption"] == "true" ? wp_get_attachment_caption( esc_attr( $image ) ) : '' ) . '"></a>';

											if( $atts["column"] == "1" ) {

												$output .= wp_get_attachment_image( esc_attr( $image ), 'eventchamp-thumbnail-3' );

											} elseif( $atts["column"] == "1" or $atts["column"] == "2" or $atts["column"] == "3" or $atts["column"] == "4" ) {

												$output .= wp_get_attachment_image( esc_attr( $image ), 'eventchamp-thumbnail-2' );

											} else {
												$output .= wp_get_attachment_image( esc_attr( $image ), 'eventchamp-thumbnail' );

											}

									$output .= '</div>';

								$output .= '</div>';

							$output .= '</div>';

						}

					}

				$output .= '</div>';

			$output .= '</div>';

			return $output;

		}

	}
	add_shortcode( "eventchamp_image_gallery_element", "eventchamp_image_gallery_element_output" );

}

if( function_exists( 'vc_map' ) ) {

	vc_map(
		array(
			"name" => esc_html__( 'Image Gallery', 'eventchamp' ),
			"base" => "eventchamp_image_gallery_element",
			"category" => esc_html__( 'Eventchamp Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/image-gallery.jpg',
			"description" => esc_html__( 'You can create an image gallery.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "attach_images",
					"param_name" => "images",
					"heading" => esc_html__( 'Images', 'eventchamp' ),
					"description" => esc_html__( 'You can upload images.', 'eventchamp' ),
					"save_always" => true,
				),
				array(
					"type" => "dropdown",
					"param_name" => "caption",
					"heading" => esc_html__( 'Caption', 'eventchamp' ),
					"description" => esc_html__( 'You can choose status of the caption.', 'eventchamp' ),
					"save_always" => true,
					"value" => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "column",
					"heading" => esc_html__( 'Column', 'eventchamp' ),
					"description" => esc_html__( 'You can choose a column.', 'eventchamp' ),
					"admin_label" => true,
					"save_always" => true,
					"value" => array(
						esc_html__( '1', 'eventchamp' ) => '1',
						esc_html__( '2', 'eventchamp' ) => '2',
						esc_html__( '3', 'eventchamp' ) => '3',
						esc_html__( '4', 'eventchamp' ) => '4',
						esc_html__( '5', 'eventchamp' ) => '5',
						esc_html__( '6', 'eventchamp' ) => '6',
						esc_html__( '7', 'eventchamp' ) => '7',
						esc_html__( '8', 'eventchamp' ) => '8',
						esc_html__( '9', 'eventchamp' ) => '9',
						esc_html__( '10', 'eventchamp' ) => '10',
					),
				),
				array(
					"type" => "dropdown",
					"param_name" => "column-space",
					"heading" => esc_html__( 'Column Space', 'eventchamp' ),
					"description" => esc_html__( 'You can choose a column space.', 'eventchamp' ),
					"save_always" => true,
					"value" => array(
						esc_html__( '0', 'eventchamp' ) => '0',
						esc_html__( '5', 'eventchamp' ) => '5',
						esc_html__( '10', 'eventchamp' ) => '10',
						esc_html__( '15', 'eventchamp' ) => '15',
						esc_html__( '20', 'eventchamp' ) => '20',
						esc_html__( '25', 'eventchamp' ) => '25',
						esc_html__( '30', 'eventchamp' ) => '30',
						esc_html__( '35', 'eventchamp' ) => '35',
						esc_html__( '40', 'eventchamp' ) => '40',
						esc_html__( '45', 'eventchamp' ) => '45',
						esc_html__( '50', 'eventchamp' ) => '50',
						esc_html__( '55', 'eventchamp' ) => '55',
						esc_html__( '60', 'eventchamp' ) => '60',
					),
				),
			),
		)
	);

}