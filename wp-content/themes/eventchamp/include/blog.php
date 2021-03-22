<?php
/*======
*
* Post Styles
*
======*/
	/*====== Blog Post Style 1 ======*/
	if( !function_exists( 'eventchamp_post_list_style_1' ) ) {

		function eventchamp_post_list_style_1( $post_id = "", $image = "", $category = "", $excerpt = "", $read_more = "", $post_info = "" ) {

			if( !empty( $post_id ) ) {

				$output = "";
				$post_excerpt = get_the_excerpt( esc_attr( $post_id ) );

				if ( is_sticky( $post_id ) ) {

					$output .= '<div class="gt-post-style-1 gt-sticky-post">';

				} else {

					$output .= '<div class="gt-post-style-1">';

				}

					if( $image == 'true' ) {

						if ( has_post_thumbnail( esc_attr( $post_id ) ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= get_the_post_thumbnail( esc_attr( $post_id ), 'eventchamp-big-post' );
								$output .= '</a>';

								if( $category == 'true' ) {

									$output .= '<div class="gt-category">';
										$output .= get_the_category_list( '', '', esc_attr( $post_id ) );
									$output .= '</div>';

								}

							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-title">';
						$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( esc_attr( $post_id ) ) . '</a>';
					$output .= '</div>';

					if( $excerpt == 'true' and !empty( $post_excerpt ) ) {

						$output .= '<div class="gt-excerpt">' . get_the_excerpt( esc_attr( $post_id ) ) . '</div>';

					}

					if( $read_more == 'true' or $post_info == 'true' ) {

						$output .= '<div class="gt-bottom">';

							if( $post_info == 'true' ) {

								$output .= '<ul>';
									$output .= '<li>';
										$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
										$output .= get_the_time( get_option( 'date_format' ), esc_attr( $post_id ) );
									$output .= '</li>';

									if ( comments_open( $post_id ) ) {

										$output .= '<li>';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>';

											$num_comments = get_comments_number( $post_id );

											if ( $num_comments == 0 ) {

												$output .= esc_html__( '0 Comment', 'eventchamp' );

											} elseif ( $num_comments > 1 ) {

												$output .= sprintf( esc_html__( '%s Comments', 'eventchamp' ), esc_attr( $num_comments ) );

											} else {

												$output .= esc_html__( '1 Comment', 'eventchamp' );

											}

										$output .= '</li>';

									}

								$output .= '</ul>';

							}

							if( $read_more == 'true' ) {

								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '" class="gt-more">' . esc_html__( 'Read More', 'eventchamp' ) . '</a>';

							}

						$output .= '</div>';
					}

				$output .= '</div>';

				return $output;

			}

		}

	}



	/*====== Blog Post Style 2 ======*/
	if( !function_exists( 'eventchamp_post_list_style_2' ) ) {

		function eventchamp_post_list_style_2( $post_id = "", $image = "", $category = "", $excerpt = "", $read_more = "", $post_info = "" ) {

			$output = "";
			$post_excerpt = get_the_excerpt( esc_attr( $post_id ) );

			if( !empty( $post_id ) ) {

				if ( is_sticky( get_the_ID() ) ) {

					$output .= '<div class="gt-post-style-2 gt-sticky-post">';

				} else {

					$output .= '<div class="gt-post-style-2">';

				}

					if( $image == 'true' ) {

						if ( has_post_thumbnail( esc_attr( $post_id ) ) ) {

							$output .= '<div class="gt-image">';
								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= get_the_post_thumbnail( esc_attr( $post_id ), 'eventchamp-small-post' );
								$output .= '</a>';

								if( $category == 'true' ) {

									$output .= '<div class="gt-category">';
										$output .= get_the_category_list( '', '', esc_attr( $post_id ) );
									$output .= '</div>';

								}

							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-title">';
						$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( esc_attr( $post_id ) ) . '</a>';
					$output .= '</div>';

					if( $excerpt == 'true' and !empty( $post_excerpt ) ) {

						$output .= '<div class="gt-excerpt">' . get_the_excerpt( esc_attr( $post_id ) ) . '</div>';

					}

					if( $read_more == 'true' or $post_info == 'true' ) {

						$output .= '<div class="gt-bottom">';

							if( $post_info == 'true' ) {

								$output .= '<ul>';
									$output .= '<li>';
										$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
										$output .= get_the_time( get_option( 'date_format' ), esc_attr( $post_id ) );
									$output .= '</li>';

									if ( comments_open( $post_id ) ) {

										$output .= '<li>';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>';

											$num_comments = get_comments_number( $post_id );

											if ( $num_comments == 0 ) {

												$output .= esc_html__( '0 Comment', 'eventchamp' );

											} elseif ( $num_comments > 1 ) {

												$output .= sprintf( esc_html__( '%s Comments', 'eventchamp' ), esc_attr( $num_comments ) );

											} else {

												$output .= esc_html__( '1 Comment', 'eventchamp' );

											}

										$output .= '</li>';

									}

								$output .= '</ul>';

							}

							if( $read_more == 'true' ) {

								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '" class="gt-more">' . esc_html__( 'Read More', 'eventchamp' ) . '</a>';

							}

						$output .= '</div>';
					}

				$output .= '</div>';

			}

			return $output;

		}

	}



	/*====== Blog Post Style 3 ======*/
	if( !function_exists( 'eventchamp_post_list_style_3' ) ) {

		function eventchamp_post_list_style_3( $post_id = "", $image = "", $post_info = "" ) {

			$output = "";

			if( !empty( $post_id ) ) {

				$output .= '<div class="gt-post-style-3">';

					if( $image == 'true' and has_post_thumbnail( esc_attr( $post_id ) ) ) {

						$output .= '<div class="gt-image">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
								$output .= get_the_post_thumbnail( esc_attr( $post_id ), 'thumbnail' );
							$output .= '</a>';

						$output .= '</div>';

					}

					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-title">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( esc_attr( $post_id ) ) . '</a>';
						$output .= '</div>';

						if( $post_info == 'true' ) {

							$output .= '<div class="gt-information">';
								$output .= '<div class="gt-item">';
									$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
									$output .= get_the_time( get_option( 'date_format' ), esc_attr( $post_id ) );
								$output .= '</div>';
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
* Post Styles for Archives
*
======*/
if( !function_exists( 'eventchamp_post_listing' ) ) {

	function eventchamp_post_listing() {

		/*====== Post Listing Style 1 ======*/
		if( !function_exists( 'eventchamp_post_listing_style_1' ) ) {

			function eventchamp_post_listing_style_1() {

				$output = "";
				$output .= '<div class="gt-columns gt-column-1 gt-column-space-45">';

					while ( have_posts() ) {

						the_post();

						$output .= '<div class="gt-col">';
							$output .= '<div class="gt-inner">';
								$output .= eventchamp_post_list_style_1( $post_id = get_the_ID(), $image = "true", $category = "true", $excerpt = "true", $read_more = "true", $post_info = "true" );
							$output .= '</div>';
						$output .= '</div>';

					}

				$output .= '</div>';

				return $output;

			}

		}



		/*====== Post Listing Style 2 ======*/
		if( !function_exists( 'eventchamp_post_listing_style_2' ) ) {

			function eventchamp_post_listing_style_2() {

				$output = "";
				$output .= '<div class="gt-columns gt-column-2 gt-column-space-30">';

					while ( have_posts() ) {

						the_post();

						$output .= '<div class="gt-col">';
							$output .= '<div class="gt-inner">';
								$output .= eventchamp_post_list_style_2( $post_id = get_the_ID(), $image = "true", $category = "true", $excerpt = "true", $read_more = "true", $post_info = "true" );
							$output .= '</div>';
						$output .= '</div>';

					}

				$output .= '</div>';

				return $output;

			}

		}



		/*====== HTML Output ======*/
		if( is_category() ) {

			$archive_archive_post_list_style = ot_get_option( 'blog_category_post_list_style', 'style1' );

		} elseif( is_tag() ) {

			$archive_archive_post_list_style = ot_get_option( 'tag_tag_post_list_style', 'style1' );

		} elseif( is_search() ) {

			$archive_archive_post_list_style = ot_get_option( 'search_search_post_list_style', 'style1' );

		} else {

			$archive_archive_post_list_style = ot_get_option( 'archive_archive_post_list_style', 'style1' );

		}
		
		if( $archive_archive_post_list_style == "style2" ) {

			if( function_exists( 'eventchamp_post_listing_style_2' ) ) {

				$output = eventchamp_post_listing_style_2();

				return $output;

			}

		} else {

			if( function_exists( 'eventchamp_post_listing_style_1' ) ) {

				$output = eventchamp_post_listing_style_1();

				return $output;

			}

		}
	}

}



/*======
*
* Post Header
*
======*/
if( !function_exists( 'eventchamp_post_header' ) ) {

	function eventchamp_post_header( $id = "" ) {

		$output = "";
		$slider_column = ot_get_option( 'post-header-image-slider-column', '1' );
		$slider_space = ot_get_option( 'post-header-image-slider-space', '0' );
		$slider_loop = ot_get_option( 'post-header-image-slider-loop', 'true' );
		$slider_autoplay = ot_get_option( 'post-header-image-slider-autoplay', 'true' );
		$slider_autoplay_delay = ot_get_option( 'post-header-image-slider-autoplay-delay', '1500' );
		$slider_direction = ot_get_option( 'post-header-image-slider-direction', 'horizontal' );
		$slider_effect = ot_get_option( 'post-header-image-slider-effect', 'slide' );

		if( !empty( $id ) ) {

			$header_status = get_post_meta( esc_attr( $id ), 'post-header-status', true );

			if( empty( $header_status ) or $header_status == "default" ) {

				$header_status = ot_get_option( 'post-header-status', 'true' );

			}

			$header_type = get_post_meta( esc_attr( $id ), 'post-header-style', true );

			if( $header_type == "default" or empty( $header_type ) ) {

				$header_type = ot_get_option( 'post-header-style', 'image' );

			}

			$image_gallery = explode( ',', get_post_meta( esc_attr( $id ), 'header-image-gallery', true ) );
			$featured_image = get_post_meta( esc_attr( $id ), 'post-featured-image', true );
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
											$output .= '<a href="' . esc_url( wp_get_attachment_image_src( esc_attr( $image ), 'full', true, true )[0] ) . '" data-srcset="' . wp_get_attachment_image_srcset( esc_attr( $image ), 'full' ) . '" data-caption="' . wp_get_attachment_caption( esc_attr( $image ) ) . '" data-fancybox="post-feature-images">';
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
* Post Meta
*
======*/
if( !function_exists( 'eventchamp_post_meta' ) ) {

	function eventchamp_post_meta( $id = "" ) {

		$output = "";
		$post_meta = ot_get_option( 'post_post_information', 'on' );

		if ( !empty( $id ) ) {

			if ( $post_meta == 'on' ) {

				$output .= '<div class="gt-post-meta">';
					$output .= '<ul>';
						$output .= '<li>';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>';
							$output .= get_the_category_list( '', '', $id );
						$output .= '</li>';
						$output .= '<li>';
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
							$output .= get_the_time( get_option( 'date_format' ), $id );
						$output .= '</li>';

						if ( comments_open( $id ) ) {

							$output .= '<li>';
								$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>';

								$num_comments = get_comments_number( $id );

								if ( $num_comments == 0 ) {

									$output .= esc_html__( '0 Comment', 'eventchamp' );

								} elseif ( $num_comments > 1 ) {

									$output .= esc_attr( $num_comments ) . ' ' . esc_html__( 'Comments', 'eventchamp' );

								} else {

									$output .= esc_html__( '1 Comment', 'eventchamp' );

								}

							$output .= '</li>';

						}

					$output .= '</ul>';
				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Post Sharing
*
======*/
if( !function_exists( 'eventchamp_post_social_sharing' ) ) {

	function eventchamp_post_social_sharing() {

		$output = "";
		$social_sharing = ot_get_option( 'post_post_share_buttons', 'on' );
		$social_share_title = ot_get_option( 'post-social-share-text' );
		$social_share_style = ot_get_option( 'post-social-sharing-style', 'style-1' );

		if( $social_sharing == "on" ) {

			$output .= '<div class="gt-page-sharing">';

				if( !empty( $social_share_title ) ) {

					$output .= '<div class="gt-title">' . esc_attr( $social_share_title ) . '</div>';

				} else {

					$output .= '<div class="gt-title">' . esc_html__( 'Share This Post', 'eventchamp' ) . '</div>';

				}

				$output .= eventchamp_social_share( $style = $social_share_style );
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Post Navigation
*
======*/
if( !function_exists( 'eventchamp_post_navigation' ) ) {

	function eventchamp_post_navigation() {

		$output = "";
		$post_navigation = ot_get_option( 'post_post_navigation', 'on' );

		if ( $post_navigation == 'on' ) {

			$prev_post = get_previous_post( false );
			$next_post = get_next_post( false );

			if( !empty( $prev_post ) or !empty( $next_post ) ) {

				$output .= '<div class="gt-post-pagination">';
					$output .= '<nav>';
						$output .= '<ul>';

							if( !empty( $prev_post ) ) {

								$output .= '<li>';
									$output .= get_previous_post_link( '%link', esc_html__( 'Previous Post', 'eventchamp' ) );
								$output .= '</li>';

							}

							if( !empty( $next_post ) ) {

								$output .= '<li>';
									$output .= get_next_post_link( '%link', esc_html__( 'Next Post', 'eventchamp' ) );
								$output .= '</li>';

							}

						$output .= '</ul>';
					$output .= '</nav>';
				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Author Box
*
======*/
if( !function_exists( 'eventchamp_author_box' ) ) {

	function eventchamp_author_box() {

		$output = "";
		$post_author = ot_get_option( 'post_author_biography', 'on' );
		$author = get_the_author();
		$author_description = get_the_author_meta( 'description' );
		$author_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );

		if ( !empty( $author_description ) and $post_author == "on" ) {

			$output .= '<div class="gt-section gt-post-author">';
				$output .= '<div class="gt-section-title">' . esc_html__( 'About the Author', 'eventchamp' ) . '</div>';
				$output .= '<div class="gt-section-content">';
					$output .= '<div class="gt-avatar">';
						$output .= '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">';
							$output .= get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 150 ) );
						$output .= '</a>';
					$output .= '</div>';
					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-author-name">';
							$output .= '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">';
								$output .= get_the_author_meta( 'display_name' );
							$output .= '</a>';
						$output .= '</div>';
						$output .= get_the_author_meta( 'description' );
						$output .= eventchamp_user_social_media_sites( $user_id = get_the_author_meta( 'ID' ) );
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Related Posts
*
======*/
if( !function_exists( 'eventchamp_related_posts' ) ) {

	function eventchamp_related_posts( $id = "" ) {

		$output = "";
		$tags = wp_get_post_tags( $id );
		$related_posts = ot_get_option( 'post_related_posts', 'on' );
		$count = ot_get_option( 'post_related_posts_column', '2' );

		if( $count >= 3 ) {

			$column_count = "3";

		} else {

			$column_count = esc_attr( $count );

		}

		if( $related_posts == "on" ) {

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
					'posts_type' => 'post',
					'ignore_sticky_posts' => true,
					'posts_per_page' => $count,
					'tag__in' => $tag_ids,
				);
				$query = new wp_query( $args );

				if( !empty( $query ) ) {

					$output .= '<div class="gt-related-posts gt-section">';
						$output .= '<div class="gt-section-title">' . esc_html__( 'Related Posts', 'eventchamp' ) . '</div>';
						$output .= '<div class="gt-section-content">';
							$output .= '<div class="gt-columns gt-column-' . esc_attr( $column_count ) . ' gt-column-space-30">';

								while( $query->have_posts() ) {

									$query->the_post();
									
									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= eventchamp_post_list_style_2( $post_id = get_the_ID(), $image = "true", $category = "false", $excerpt = "false", $read_more = "false", $post_info = "true" );
										$output .= '</div>';
									$output .= '</div>';

								}

							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';

				}

			}
			wp_reset_postdata();


		}

		return $output;

	}

}