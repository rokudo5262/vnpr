<?php
/*======
*
* Event Listing Styles
*
======*/
	/*====== Event Style 1 ======*/
	if( !function_exists( 'eventchamp_event_list_style_1' ) ) {

		function eventchamp_event_list_style_1( $post_id = "", $image = "", $category = "", $date = "", $location = "", $excerpt = "", $status = "", $price = "", $venue = "", $ticket_amount = "", $time = "" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$categories = wp_get_post_terms( esc_attr( $post_id ), 'eventcat' );
				$locations = wp_get_post_terms( esc_attr( $post_id ), 'location' );
				$event_venues = get_post_meta( esc_attr( $post_id ), 'event_venue', true );
				$event_start_date = get_post_meta( esc_attr( $post_id ), 'event_start_date', true );
				$event_start_time = get_post_meta( esc_attr( $post_id ), 'event_start_time', true );
				$event_price = get_post_meta( esc_attr( $post_id ), 'event-ticket-main-price', true );

				$output .= '<div class="gt-event-style-1">';

					if( $image == 'true' ) {

						if ( has_post_thumbnail( esc_attr( $post_id ) ) ) {

							$output .= '<div class="gt-image">';
								$output .= eventchamp_label( esc_attr( $post_id ) );

								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= get_the_post_thumbnail( esc_attr( $post_id ), 'eventchamp-event-list' );
								$output .= '</a>';

								if( $status == 'true' ) {

									$output .= eventchamp_event_status( $post_id = esc_attr( $post_id ) );

								}

								if( $price == 'true' and !empty( $event_price ) ) {

									$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
									$currency = ot_get_option( 'event-price-currency' );

									$output .= '<div class="gt-price">';

										if( $currency_position == "left" ) {

											$output .= esc_attr( $currency );

										}

										if( $currency_position == "left-space" ) {

											$output .= esc_attr( $currency ) . ' ';

										}

										$output .= esc_attr( $event_price );

										if( $currency_position == "right" ) {

											$output .= esc_attr( $currency );

										}

										if( $currency_position == "right-space" ) {

											$output .= ' ' . esc_attr( $currency );

										}

									$output .= '</div>';

								}

								if( $price == 'true' and $event_price == '0' ) {

									$free_event_price = ot_get_option( 'event-free-events-price', 'free' );

									if( $free_event_price != 'hide' ) {

										$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
										$currency = ot_get_option( 'event-price-currency' );
										$event_price = "0";

										$output .= '<div class="gt-price">';

											if( $free_event_price == "free" ) {

												$output .= esc_html__( 'Free', 'eventchamp' );

											} elseif( $free_event_price == "0" ) {

												$output .= '0';

											} elseif( $free_event_price == "0-currency" ) {

												if( $currency_position == "left" ) {

													$output .= esc_attr( $currency );

												}

												if( $currency_position == "left-space" ) {

													$output .= esc_attr( $currency ) . ' ';

												}

												$output .= esc_attr( $event_price );

												if( $currency_position == "right" ) {

													$output .= esc_attr( $currency );

												}

												if( $currency_position == "right-space" ) {

													$output .= ' ' . esc_attr( $currency );

												}

											}

										$output .= '</div>';

									}

								}

							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-title">';
						$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';
					$output .= '</div>';

						if( $date == 'true' or $location == 'true' or $category == 'true' or $venue == 'true' ) {

							if( !empty( $event_cats ) or !empty( $locations ) or !empty( $event_venues ) or !empty( $event_start_date ) ) {

								$output .= '<div class="gt-details">';

									if( $category == 'true' and !empty( $categories ) ) {

										$output .= '<div class="gt-category">';
											$output .= '<ul>';

												foreach( $categories as $cat ) {

													if( !empty( $cat ) ) {

														$output .= '<li class="gt-category-' . esc_attr( $cat->term_id ) . '">';
															$output .= '<a href="' . get_term_link( $cat->term_id ) . '?post_type=event">' . esc_attr( $cat->name ) . '</a>';
														$output .= '</li>';

													}

												}

											$output .= '</ul>';
										$output .= '</div>';

									}

									if( $date == 'true' and !empty( $event_start_date ) ) {

										$output .= '<div class="gt-date">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
										 	$output .= '<span>' . eventchamp_global_date_converter( $date = esc_attr( $event_start_date ) ) . '</span>';
										$output .= '</div>';

									}

									if( $time == 'true' and !empty( $event_start_time ) ) {

										$output .= '<div class="gt-time">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>';
										 	$output .= '<span>' . eventchamp_global_time_converter( $time = esc_attr( $event_start_time ) ) . '</span>';
										$output .= '</div>';

									}

									if( $location == 'true' and !empty( $locations ) ) {

										$output .= '<div class="gt-location">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
											$output .= '<ul>';

												foreach( $locations as $loc ) {

													if( !empty( $loc ) ) {

														$output .= '<li class="gt-category-' . esc_attr( $loc->term_id ) . '">';
															$output .= '<a href="' . get_term_link( $loc->term_id ) . '?post_type=event">' . esc_attr( $loc->name ) . '</a>';
														$output .= '</li>';

													}

												}

											$output .= '</ul>';
										$output .= '</div>';

									}

									if( $venue == 'true' and !empty( $event_venues ) and is_array( $event_venues ) ) {

										$output .= '<div class="gt-venue">';
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
										$output .= '</div>';

									}

									$event_remaining_tickets = get_post_meta( esc_attr( $post_id ), 'event-remaining-tickets', true );
									$event_remaining_tickets_quantity = get_post_meta( esc_attr( $post_id ), 'event-remaining-ticket-quantity', true );
									$event_remaining_tickets_woocommerce = get_post_meta( esc_attr( $post_id ), 'event-remaining-ticket-woocommerce', true );

									if( $ticket_amount == 'true' and $event_remaining_tickets == "manual-quantity" and !empty( $event_remaining_tickets_quantity ) ) {

										$output .= '<div class="gt-stock">';
											$output .= '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <circle cx="361.869" cy="412.123" r="19.975"/> <circle cx="315.921" cy="154.435" r="19.975"/> <path d="M491.711,312.246h19.975V192.393h-50.937c-22.029,0-39.951-17.922-39.951-39.951c0-14.948,8.255-28.532,21.544-35.453 l17.013-8.861L408.489,0L0.782,192.304l0.042,0.089H0.314v119.853H20.29c22.029,0,39.951,17.922,39.951,39.951 c0,22.029-17.922,39.951-39.951,39.951H0.314V512h511.371V392.147h-19.975c-22.029,0-39.951-17.922-39.951-39.951 C451.759,330.168,469.681,312.246,491.711,312.246z M272.143,108.484c4.85,9.631,16.505,13.713,26.323,9.095 c9.83-4.624,14.117-16.229,9.762-26.115l81.134-38.269l18.505,39.335c-16.998,14.961-27.021,36.606-27.021,59.913 c0,14.548,3.928,28.188,10.75,39.951H94.244L272.143,108.484z M471.734,429.57v42.479h-89.889 c0-11.032-8.943-19.975-19.975-19.975c-11.032,0-19.975,8.943-19.975,19.975H40.265V429.57 c34.424-8.892,59.926-40.211,59.926-77.374c0-37.163-25.503-68.483-59.926-77.374v-42.479h301.629 c0,11.032,8.943,19.975,19.975,19.975c11.032,0,19.975-8.943,19.975-19.975h89.889v42.479 c-34.424,8.892-59.926,40.211-59.926,77.374C411.808,389.36,437.31,420.678,471.734,429.57z"/> <circle cx="361.869" cy="292.27" r="19.975"/> <circle cx="361.869" cy="352.197" r="19.975"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= esc_attr( $event_remaining_tickets_quantity );
											$output .= ' ' . esc_html__( 'Tickets' , 'eventchamp' );
										$output .= '</div>';

									}

									if( $ticket_amount == 'true' and $event_remaining_tickets == "woocommerce-product" and !empty( $event_remaining_tickets_woocommerce ) ) {

										if( function_exists( 'wc_get_product' ) ) {

											$product_id = wc_get_product( $event_remaining_tickets_woocommerce );

											if( !empty( $product_id ) ) {

												$output .= '<div class="gt-stock">';
													$output .= '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <circle cx="361.869" cy="412.123" r="19.975"/> <circle cx="315.921" cy="154.435" r="19.975"/> <path d="M491.711,312.246h19.975V192.393h-50.937c-22.029,0-39.951-17.922-39.951-39.951c0-14.948,8.255-28.532,21.544-35.453 l17.013-8.861L408.489,0L0.782,192.304l0.042,0.089H0.314v119.853H20.29c22.029,0,39.951,17.922,39.951,39.951 c0,22.029-17.922,39.951-39.951,39.951H0.314V512h511.371V392.147h-19.975c-22.029,0-39.951-17.922-39.951-39.951 C451.759,330.168,469.681,312.246,491.711,312.246z M272.143,108.484c4.85,9.631,16.505,13.713,26.323,9.095 c9.83-4.624,14.117-16.229,9.762-26.115l81.134-38.269l18.505,39.335c-16.998,14.961-27.021,36.606-27.021,59.913 c0,14.548,3.928,28.188,10.75,39.951H94.244L272.143,108.484z M471.734,429.57v42.479h-89.889 c0-11.032-8.943-19.975-19.975-19.975c-11.032,0-19.975,8.943-19.975,19.975H40.265V429.57 c34.424-8.892,59.926-40.211,59.926-77.374c0-37.163-25.503-68.483-59.926-77.374v-42.479h301.629 c0,11.032,8.943,19.975,19.975,19.975c11.032,0,19.975-8.943,19.975-19.975h89.889v42.479 c-34.424,8.892-59.926,40.211-59.926,77.374C411.808,389.36,437.31,420.678,471.734,429.57z"/> <circle cx="361.869" cy="292.27" r="19.975"/> <circle cx="361.869" cy="352.197" r="19.975"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
													$output .= $product_id->get_stock_quantity();
													$output .= ' ' . esc_html__( 'Tickets' , 'eventchamp' );
												$output .= '</div>';

											}

										}

									}

								$output .= '</div>';

							}

						}

					if( $excerpt == 'true' ) {

						$excerpt_content = get_the_excerpt( esc_attr( $post_id ) );

						if( !empty( $excerpt_content ) ) {

							$output .= '<div class="gt-text">' . get_the_excerpt( esc_attr( $post_id ) ) . '</div>';

						}

					}

				$output .= '</div>';

			}

			return $output;

		}

	}



	/*====== Event Style 2 ======*/
	if( !function_exists( 'eventchamp_event_list_style_2' ) ) {

		function eventchamp_event_list_style_2( $post_id = "", $image = "", $date = "", $location = "", $venue = "" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$output .= '<div class="gt-event-style-2">';

					if( $image == 'true' and has_post_thumbnail( esc_attr( $post_id ) ) ) {

						$output .= '<div class="gt-image">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
								$output .= get_the_post_thumbnail( esc_attr( $post_id ), 'thumbnail' );
							$output .= '</a>';
						$output .= '</div>';

					}

					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-title">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';
						$output .= '</div>';

						if( $date == 'true' or $location == 'true' or $venue == 'true' ) {

							$event_venues = get_post_meta( esc_attr( $post_id ), 'event_venue', true );
							$event_start_date = get_post_meta( esc_attr( $post_id ), 'event_start_date', true );
							$locations = wp_get_post_terms( esc_attr( $post_id ), 'location' );

							if( !empty( $event_location ) or !empty( $event_start_date ) or !empty( $event_venues ) ) {

								$output .= '<div class="gt-information">';

									if( $date == 'true' and !empty( $event_start_date ) ) {

										$output .= '<div class="gt-date">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
										 	$output .= '<span>' . esc_attr( eventchamp_global_date_converter( $date = $event_start_date ) ) . '</span>';
										$output .= '</div>';

									}

									if( $location == 'true' and !empty( $locations ) ) {

										$output .= '<div class="gt-location">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
											$output .= '<ul>';

												foreach( $locations as $loc ) {

													if( !empty( $loc ) ) {

														$output .= '<li class="gt-category-' . esc_attr( $loc->term_id ) . '">';
															$output .= '<a href="' . get_term_link( $loc->term_id ) . '?post_type=event">' . esc_attr( $loc->name ) . '</a>';
														$output .= '</li>';

													}

												}

											$output .= '</ul>';
										$output .= '</div>';

									}

									if( $venue == 'true' and !empty( $event_venues ) and is_array( $event_venues ) ) {

										$output .= '<div class="gt-venue">';
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
										$output .= '</div>';

									}

								$output .= '</div>';

							}

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;

		}

	}



	/*====== Event Style 3 ======*/
	if( !function_exists( 'eventchamp_event_list_style_3' ) ) {

		function eventchamp_event_list_style_3( $post_id = "", $image = "", $category = "", $date = "", $location = "", $excerpt = "", $status = "", $price = "", $venue = "", $ticket_amount = "", $time = "" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$categories = wp_get_post_terms( esc_attr( $post_id ), 'eventcat' );
				$locations = wp_get_post_terms( esc_attr( $post_id ), 'location' );
				$event_venues = get_post_meta( esc_attr( $post_id ), 'event_venue', true );
				$event_start_date = get_post_meta( esc_attr( $post_id ), 'event_start_date', true );
				$event_start_time = get_post_meta( esc_attr( $post_id ), 'event_start_time', true );
				$event_price = get_post_meta( esc_attr( $post_id ), 'event-ticket-main-price', true );

				$output .= '<div class="gt-event-style-3">';

					if( $image == 'true' ) {

						if ( has_post_thumbnail( esc_attr( $post_id ) ) ) {

							$output .= '<div class="gt-image">';
								$output .= eventchamp_label( esc_attr( $post_id ) );

								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= get_the_post_thumbnail( esc_attr( $post_id ), 'eventchamp-event-list' );
								$output .= '</a>';

							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-title">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';
						$output .= '</div>';

						if( $date == 'true' or $location == 'true' or $category == 'true' or $venue == 'true' ) {

							if( !empty( $event_cats ) or !empty( $locations ) or !empty( $event_venues ) or !empty( $event_start_date ) ) {

								$output .= '<div class="gt-details">';

									if( $category == 'true' and !empty( $categories ) ) {

										$output .= '<div class="gt-category">';
											$output .= '<ul>';

												foreach( $categories as $cat ) {

													if( !empty( $cat ) ) {

														$output .= '<li class="gt-category-' . esc_attr( $cat->term_id ) . '">';
															$output .= '<a href="' . get_term_link( $cat->term_id ) . '?post_type=event">' . esc_attr( $cat->name ) . '</a>';
														$output .= '</li>';

													}

												}

											$output .= '</ul>';
										$output .= '</div>';

									}

									if( $date == 'true' and !empty( $event_start_date ) ) {

										$output .= '<div class="gt-date">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
										 	$output .= '<span>' . eventchamp_global_date_converter( $date = esc_attr( $event_start_date ) ) . '</span>';
										$output .= '</div>';

									}

									if( $time == 'true' and !empty( $event_start_time ) ) {

										$output .= '<div class="gt-time">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>';
										 	$output .= '<span>' . eventchamp_global_time_converter( $time = esc_attr( $event_start_time ) ) . '</span>';
										$output .= '</div>';

									}

								$output .= '</div>';

								if( $excerpt == 'true' ) {

									$excerpt_content = get_the_excerpt( esc_attr( $post_id ) );

									if( !empty( $excerpt_content ) ) {

										$output .= '<div class="gt-text">' . get_the_excerpt( esc_attr( $post_id ) ) . '</div>';

									}

								}

								$output .= '<div class="gt-details">';

									if( $status == 'true' and eventchamp_event_status( $post_id = esc_attr( $post_id ) ) ) {

										$output .= '<div class="gt-status">';
											$output .= '<svg fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g transform="translate(1 1)"> <g> <g> <path d="M447,468.333h-42.667v-82.325c0-35.684-17.822-68.993-47.505-88.755l-63.366-42.249l63.377-42.241 c0.658-0.44,1.294-0.906,1.941-1.359c0.359-0.25,0.72-0.498,1.075-0.753c0.564-0.406,1.122-0.818,1.677-1.234 c0.723-0.54,1.436-1.09,2.143-1.646c0.287-0.227,0.58-0.448,0.864-0.678c25.025-20.114,39.794-50.621,39.794-83.1V41.667H447 c11.782,0,21.333-9.551,21.333-21.333C468.333,8.551,458.782-1,447-1h-64H127H63C51.218-1,41.667,8.551,41.667,20.333 c0,11.782,9.551,21.333,21.333,21.333h42.667v82.325c0,32.472,14.762,62.973,39.785,83.093c0.278,0.225,0.564,0.441,0.845,0.663 c0.724,0.57,1.455,1.134,2.196,1.687c0.532,0.398,1.066,0.793,1.606,1.181c0.431,0.309,0.868,0.61,1.304,0.913 c0.583,0.406,1.153,0.827,1.745,1.222l63.393,42.252l-63.38,42.258c-29.671,19.754-47.493,53.063-47.493,88.747v82.325H63 c-11.782,0-21.333,9.551-21.333,21.333S51.218,511,63,511h64h256h64c11.782,0,21.333-9.551,21.333-21.333 S458.782,468.333,447,468.333z M338.079,173.622c-0.06,0.049-0.12,0.097-0.18,0.146c-0.56,0.456-1.135,0.895-1.712,1.331 c-0.423,0.318-0.848,0.633-1.28,0.942c-0.081,0.058-0.164,0.115-0.246,0.173c-0.488,0.345-0.98,0.686-1.479,1.018L255,229.36 l-78.171-52.12c-0.457-0.304-0.906-0.617-1.354-0.932c-0.143-0.101-0.287-0.2-0.429-0.301c-0.41-0.294-0.815-0.593-1.217-0.896 c-0.588-0.445-1.173-0.892-1.744-1.356c-0.07-0.056-0.138-0.113-0.207-0.17c-1.513-1.241-2.966-2.547-4.352-3.918h174.948 C341.074,171.051,339.608,172.37,338.079,173.622z M361.667,41.667v82.325c0,1.006-0.031,2.009-0.078,3.008H148.412 c-0.047-0.999-0.078-2.002-0.078-3.008V41.667H361.667z M148.333,468.333v-82.325c0-21.416,10.689-41.392,28.484-53.24 l62.684-41.794c3.887,4.114,9.382,6.692,15.499,6.692c6.118,0,11.612-2.578,15.499-6.692l62.672,41.786 c17.807,11.855,28.496,31.832,28.496,53.248v82.325H148.333z"/> <path d="M255,383c11.797,0,21.333-9.536,21.333-21.333v-21.333c0-11.797-9.536-21.333-21.333-21.333 c-11.797,0-21.333,9.536-21.333,21.333v21.333C233.667,373.464,243.203,383,255,383z"/> <path d="M255.213,404.333H255c-11.797,0-21.227,9.536-21.227,21.333S243.437,447,255.213,447 c11.776,0,21.333-9.536,21.333-21.333S266.989,404.333,255.213,404.333z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= eventchamp_event_status( $post_id = esc_attr( $post_id ) );
										$output .= '</div>';

									}

									if( $location == 'true' and !empty( $locations ) ) {

										$output .= '<div class="gt-location">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
											$output .= '<ul>';

												foreach( $locations as $loc ) {

													if( !empty( $loc ) ) {

														$output .= '<li class="gt-category-' . esc_attr( $loc->term_id ) . '">';
															$output .= '<a href="' . get_term_link( $loc->term_id ) . '?post_type=event">' . esc_attr( $loc->name ) . '</a>';
														$output .= '</li>';

													}

												}

											$output .= '</ul>';
										$output .= '</div>';

									}

									if( $venue == 'true' and !empty( $event_venues ) and is_array( $event_venues ) ) {

										$output .= '<div class="gt-venue">';
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
										$output .= '</div>';

									}

									if( $price == 'true' and !empty( $event_price ) ) {

										$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
										$currency = ot_get_option( 'event-price-currency' );

										$output .= '<div class="gt-price">';

											$output .= '<svg fill="currentColor" viewBox="0 -98 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m492 0h-472c-11.046875 0-20 8.953125-20 20v275.335938c0 11.042968 8.953125 20 20 20h472c11.046875 0 20-8.957032 20-20v-275.335938c0-11.046875-8.953125-20-20-20zm-118.324219 275.335938h-235.351562c-8.453125-50.175782-48.148438-89.871094-98.324219-98.324219v-38.6875c50.175781-8.453125 89.871094-48.148438 98.324219-98.324219h235.351562c8.453125 50.175781 48.148438 89.871094 98.324219 98.324219v38.6875c-50.175781 8.453125-89.871094 48.148437-98.324219 98.324219zm98.324219-177.867188c-28.070312-7.25-50.21875-29.398438-57.46875-57.46875h57.46875zm-374.53125-57.46875c-7.25 28.070312-29.398438 50.21875-57.46875 57.46875v-57.46875zm-57.46875 177.867188c28.070312 7.25 50.21875 29.394531 57.46875 57.46875h-57.46875zm374.53125 57.46875c7.25-28.074219 29.398438-50.21875 57.46875-57.46875v57.46875zm-158.53125-216.335938c-54.40625 0-98.667969 44.261719-98.667969 98.667969 0 54.402343 44.261719 98.667969 98.667969 98.667969s98.667969-44.265626 98.667969-98.667969c0-54.40625-44.261719-98.667969-98.667969-98.667969zm0 157.335938c-32.347656 0-58.667969-26.320313-58.667969-58.667969 0-32.351563 26.320313-58.667969 58.667969-58.667969s58.667969 26.316406 58.667969 58.667969c0 32.347656-26.320313 58.667969-58.667969 58.667969zm0 0"/></svg>';

											if( $currency_position == "left" ) {

												$output .= esc_attr( $currency );

											}

											if( $currency_position == "left-space" ) {

												$output .= esc_attr( $currency ) . ' ';

											}

											$output .= esc_attr( $event_price );

											if( $currency_position == "right" ) {

												$output .= esc_attr( $currency );

											}

											if( $currency_position == "right-space" ) {

												$output .= ' ' . esc_attr( $currency );

											}

										$output .= '</div>';

									}

									if( $price == 'true' and $event_price == '0' ) {

										$free_event_price = ot_get_option( 'event-free-events-price', 'free' );

										if( $free_event_price != 'hide' ) {

											$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
											$currency = ot_get_option( 'event-price-currency' );
											$event_price = "0";

											$output .= '<div class="gt-price">';

												$output .= '<svg fill="currentColor" viewBox="0 -98 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m492 0h-472c-11.046875 0-20 8.953125-20 20v275.335938c0 11.042968 8.953125 20 20 20h472c11.046875 0 20-8.957032 20-20v-275.335938c0-11.046875-8.953125-20-20-20zm-118.324219 275.335938h-235.351562c-8.453125-50.175782-48.148438-89.871094-98.324219-98.324219v-38.6875c50.175781-8.453125 89.871094-48.148438 98.324219-98.324219h235.351562c8.453125 50.175781 48.148438 89.871094 98.324219 98.324219v38.6875c-50.175781 8.453125-89.871094 48.148437-98.324219 98.324219zm98.324219-177.867188c-28.070312-7.25-50.21875-29.398438-57.46875-57.46875h57.46875zm-374.53125-57.46875c-7.25 28.070312-29.398438 50.21875-57.46875 57.46875v-57.46875zm-57.46875 177.867188c28.070312 7.25 50.21875 29.394531 57.46875 57.46875h-57.46875zm374.53125 57.46875c7.25-28.074219 29.398438-50.21875 57.46875-57.46875v57.46875zm-158.53125-216.335938c-54.40625 0-98.667969 44.261719-98.667969 98.667969 0 54.402343 44.261719 98.667969 98.667969 98.667969s98.667969-44.265626 98.667969-98.667969c0-54.40625-44.261719-98.667969-98.667969-98.667969zm0 157.335938c-32.347656 0-58.667969-26.320313-58.667969-58.667969 0-32.351563 26.320313-58.667969 58.667969-58.667969s58.667969 26.316406 58.667969 58.667969c0 32.347656-26.320313 58.667969-58.667969 58.667969zm0 0"/></svg>';

												if( $free_event_price == "free" ) {

													$output .= esc_html__( 'Free', 'eventchamp' );

												} elseif( $free_event_price == "0" ) {

													$output .= '0';

												} elseif( $free_event_price == "0-currency" ) {

													if( $currency_position == "left" ) {

														$output .= esc_attr( $currency );

													}

													if( $currency_position == "left-space" ) {

														$output .= esc_attr( $currency ) . ' ';

													}

													$output .= esc_attr( $event_price );

													if( $currency_position == "right" ) {

														$output .= esc_attr( $currency );

													}

													if( $currency_position == "right-space" ) {

														$output .= ' ' . esc_attr( $currency );

													}

												}

											$output .= '</div>';

										}

									}

									$event_remaining_tickets = get_post_meta( esc_attr( $post_id ), 'event-remaining-tickets', true );
									$event_remaining_tickets_quantity = get_post_meta( esc_attr( $post_id ), 'event-remaining-ticket-quantity', true );
									$event_remaining_tickets_woocommerce = get_post_meta( esc_attr( $post_id ), 'event-remaining-ticket-woocommerce', true );

									if( $ticket_amount == 'true' and $event_remaining_tickets == "manual-quantity" and !empty( $event_remaining_tickets_quantity ) ) {

										$output .= '<div class="gt-stock">';
											$output .= '<svg fill="currentColor" version="1.1"xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <circle cx="361.869" cy="412.123" r="19.975"/> <circle cx="315.921" cy="154.435" r="19.975"/> <path d="M491.711,312.246h19.975V192.393h-50.937c-22.029,0-39.951-17.922-39.951-39.951c0-14.948,8.255-28.532,21.544-35.453 l17.013-8.861L408.489,0L0.782,192.304l0.042,0.089H0.314v119.853H20.29c22.029,0,39.951,17.922,39.951,39.951 c0,22.029-17.922,39.951-39.951,39.951H0.314V512h511.371V392.147h-19.975c-22.029,0-39.951-17.922-39.951-39.951 C451.759,330.168,469.681,312.246,491.711,312.246z M272.143,108.484c4.85,9.631,16.505,13.713,26.323,9.095 c9.83-4.624,14.117-16.229,9.762-26.115l81.134-38.269l18.505,39.335c-16.998,14.961-27.021,36.606-27.021,59.913 c0,14.548,3.928,28.188,10.75,39.951H94.244L272.143,108.484z M471.734,429.57v42.479h-89.889 c0-11.032-8.943-19.975-19.975-19.975c-11.032,0-19.975,8.943-19.975,19.975H40.265V429.57 c34.424-8.892,59.926-40.211,59.926-77.374c0-37.163-25.503-68.483-59.926-77.374v-42.479h301.629 c0,11.032,8.943,19.975,19.975,19.975c11.032,0,19.975-8.943,19.975-19.975h89.889v42.479 c-34.424,8.892-59.926,40.211-59.926,77.374C411.808,389.36,437.31,420.678,471.734,429.57z"/> <circle cx="361.869" cy="292.27" r="19.975"/> <circle cx="361.869" cy="352.197" r="19.975"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= esc_attr( $event_remaining_tickets_quantity );
											$output .= ' ' . esc_html__( 'Tickets' , 'eventchamp' );
										$output .= '</div>';

									}

									if( $ticket_amount == 'true' and $event_remaining_tickets == "woocommerce-product" and !empty( $event_remaining_tickets_woocommerce ) ) {

										if( function_exists( 'wc_get_product' ) ) {

											$product_id = wc_get_product( $event_remaining_tickets_woocommerce );

											if( !empty( $product_id ) ) {

												$output .= '<div class="gt-stock">';
													$output .= '<svg fill="currentColor" version="1.1"xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <circle cx="361.869" cy="412.123" r="19.975"/> <circle cx="315.921" cy="154.435" r="19.975"/> <path d="M491.711,312.246h19.975V192.393h-50.937c-22.029,0-39.951-17.922-39.951-39.951c0-14.948,8.255-28.532,21.544-35.453 l17.013-8.861L408.489,0L0.782,192.304l0.042,0.089H0.314v119.853H20.29c22.029,0,39.951,17.922,39.951,39.951 c0,22.029-17.922,39.951-39.951,39.951H0.314V512h511.371V392.147h-19.975c-22.029,0-39.951-17.922-39.951-39.951 C451.759,330.168,469.681,312.246,491.711,312.246z M272.143,108.484c4.85,9.631,16.505,13.713,26.323,9.095 c9.83-4.624,14.117-16.229,9.762-26.115l81.134-38.269l18.505,39.335c-16.998,14.961-27.021,36.606-27.021,59.913 c0,14.548,3.928,28.188,10.75,39.951H94.244L272.143,108.484z M471.734,429.57v42.479h-89.889 c0-11.032-8.943-19.975-19.975-19.975c-11.032,0-19.975,8.943-19.975,19.975H40.265V429.57 c34.424-8.892,59.926-40.211,59.926-77.374c0-37.163-25.503-68.483-59.926-77.374v-42.479h301.629 c0,11.032,8.943,19.975,19.975,19.975c11.032,0,19.975-8.943,19.975-19.975h89.889v42.479 c-34.424,8.892-59.926,40.211-59.926,77.374C411.808,389.36,437.31,420.678,471.734,429.57z"/> <circle cx="361.869" cy="292.27" r="19.975"/> <circle cx="361.869" cy="352.197" r="19.975"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
													$output .= $product_id->get_stock_quantity();
													$output .= ' ' . esc_html__( 'Tickets' , 'eventchamp' );
												$output .= '</div>';

											}

										}

									}

								$output .= '</div>';

							}

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;

		}

	}



	/*====== Event Style 4 ======*/
	if( !function_exists( 'eventchamp_event_list_style_4' ) ) {

		function eventchamp_event_list_style_4( $post_id = "", $image = "", $category = "", $date = "", $location = "", $excerpt = "", $status = "", $price = "", $venue = "", $ticket_amount = "", $time = "" ) {

			$output  = "";

			if( !empty( $post_id ) ) {

				$categories = wp_get_post_terms( esc_attr( $post_id ), 'eventcat' );
				$locations = wp_get_post_terms( esc_attr( $post_id ), 'location' );
				$event_venues = get_post_meta( esc_attr( $post_id ), 'event_venue', true );
				$event_start_date = get_post_meta( esc_attr( $post_id ), 'event_start_date', true );
				$event_start_time = get_post_meta( esc_attr( $post_id ), 'event_start_time', true );
				$event_price = get_post_meta( esc_attr( $post_id ), 'event-ticket-main-price', true );

				$output .= '<div class="gt-event-style-4">';

					if( $image == 'true' ) {

						if ( has_post_thumbnail( esc_attr( $post_id ) ) ) {

							$output .= '<div class="gt-image">';
								$output .= eventchamp_label( esc_attr( $post_id ) );

								$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">';
									$output .= get_the_post_thumbnail( esc_attr( $post_id ), 'eventchamp-event-list' );
								$output .= '</a>';

							$output .= '</div>';

						}

					}

					$output .= '<div class="gt-content">';
						$output .= '<div class="gt-title">';
							$output .= '<a href="' . get_the_permalink( esc_attr( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';
						$output .= '</div>';

						if( $date == 'true' or $location == 'true' or $category == 'true' or $venue == 'true' ) {

							if( !empty( $event_cats ) or !empty( $locations ) or !empty( $event_venues ) or !empty( $event_start_date ) ) {

								$output .= '<div class="gt-details">';

									if( $category == 'true' and !empty( $categories ) ) {

										$output .= '<div class="gt-category">';
											$output .= '<ul>';

												foreach( $categories as $cat ) {

													if( !empty( $cat ) ) {

														$output .= '<li class="gt-category-' . esc_attr( $cat->term_id ) . '">';
															$output .= '<a href="' . get_term_link( $cat->term_id ) . '?post_type=event">' . esc_attr( $cat->name ) . '</a>';
														$output .= '</li>';

													}

												}

											$output .= '</ul>';
										$output .= '</div>';

									}

									if( $date == 'true' and !empty( $event_start_date ) ) {

										$output .= '<div class="gt-date">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
										 	$output .= '<span>' . eventchamp_global_date_converter( $date = esc_attr( $event_start_date ) ) . '</span>';
										$output .= '</div>';

									}

									if( $time == 'true' and !empty( $event_start_time ) ) {

										$output .= '<div class="gt-time">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>';
										 	$output .= '<span>' . eventchamp_global_time_converter( $time = esc_attr( $event_start_time ) ) . '</span>';
										$output .= '</div>';

									}

									if( $venue == 'true' and !empty( $event_venues ) and is_array( $event_venues ) ) {

										$output .= '<div class="gt-venue">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>';
											$output .= '<ul>';

												foreach( $event_venues as $event_venue ) {

													if( !empty( $event_venue ) ) {

														$output .= '<li>';
															$output .= '<a href="' . esc_url( get_the_permalink( $event_venue ) ) . '">' . get_the_title( $event_venue ) . '</a>';
														$output .= '</li>';

													}

												}

											$output .= '</ul>';
										$output .= '</div>';

									}

								$output .= '</div>';

								if( $excerpt == 'true' ) {

									$excerpt_content = get_the_excerpt( esc_attr( $post_id ) );

									if( !empty( $excerpt_content ) ) {

										$output .= '<div class="gt-text">' . get_the_excerpt( esc_attr( $post_id ) ) . '</div>';

									}

								}

								$output .= '<div class="gt-details">';

									if( $status == 'true' and !empty( eventchamp_event_status( $post_id = esc_attr( $post_id ) ) ) ) {

										$output .= '<div class="gt-status">';
											$output .= '<svg fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g transform="translate(1 1)"> <g> <g> <path d="M447,468.333h-42.667v-82.325c0-35.684-17.822-68.993-47.505-88.755l-63.366-42.249l63.377-42.241 c0.658-0.44,1.294-0.906,1.941-1.359c0.359-0.25,0.72-0.498,1.075-0.753c0.564-0.406,1.122-0.818,1.677-1.234 c0.723-0.54,1.436-1.09,2.143-1.646c0.287-0.227,0.58-0.448,0.864-0.678c25.025-20.114,39.794-50.621,39.794-83.1V41.667H447 c11.782,0,21.333-9.551,21.333-21.333C468.333,8.551,458.782-1,447-1h-64H127H63C51.218-1,41.667,8.551,41.667,20.333 c0,11.782,9.551,21.333,21.333,21.333h42.667v82.325c0,32.472,14.762,62.973,39.785,83.093c0.278,0.225,0.564,0.441,0.845,0.663 c0.724,0.57,1.455,1.134,2.196,1.687c0.532,0.398,1.066,0.793,1.606,1.181c0.431,0.309,0.868,0.61,1.304,0.913 c0.583,0.406,1.153,0.827,1.745,1.222l63.393,42.252l-63.38,42.258c-29.671,19.754-47.493,53.063-47.493,88.747v82.325H63 c-11.782,0-21.333,9.551-21.333,21.333S51.218,511,63,511h64h256h64c11.782,0,21.333-9.551,21.333-21.333 S458.782,468.333,447,468.333z M338.079,173.622c-0.06,0.049-0.12,0.097-0.18,0.146c-0.56,0.456-1.135,0.895-1.712,1.331 c-0.423,0.318-0.848,0.633-1.28,0.942c-0.081,0.058-0.164,0.115-0.246,0.173c-0.488,0.345-0.98,0.686-1.479,1.018L255,229.36 l-78.171-52.12c-0.457-0.304-0.906-0.617-1.354-0.932c-0.143-0.101-0.287-0.2-0.429-0.301c-0.41-0.294-0.815-0.593-1.217-0.896 c-0.588-0.445-1.173-0.892-1.744-1.356c-0.07-0.056-0.138-0.113-0.207-0.17c-1.513-1.241-2.966-2.547-4.352-3.918h174.948 C341.074,171.051,339.608,172.37,338.079,173.622z M361.667,41.667v82.325c0,1.006-0.031,2.009-0.078,3.008H148.412 c-0.047-0.999-0.078-2.002-0.078-3.008V41.667H361.667z M148.333,468.333v-82.325c0-21.416,10.689-41.392,28.484-53.24 l62.684-41.794c3.887,4.114,9.382,6.692,15.499,6.692c6.118,0,11.612-2.578,15.499-6.692l62.672,41.786 c17.807,11.855,28.496,31.832,28.496,53.248v82.325H148.333z"/> <path d="M255,383c11.797,0,21.333-9.536,21.333-21.333v-21.333c0-11.797-9.536-21.333-21.333-21.333 c-11.797,0-21.333,9.536-21.333,21.333v21.333C233.667,373.464,243.203,383,255,383z"/> <path d="M255.213,404.333H255c-11.797,0-21.227,9.536-21.227,21.333S243.437,447,255.213,447 c11.776,0,21.333-9.536,21.333-21.333S266.989,404.333,255.213,404.333z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= eventchamp_event_status( $post_id = esc_attr( $post_id ) );
										$output .= '</div>';

									}

									if( $location == 'true' and !empty( $locations ) ) {

										$output .= '<div class="gt-location">';
											$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
											$output .= '<ul>';

												foreach( $locations as $loc ) {

													if( !empty( $loc ) ) {

														$output .= '<li class="gt-category-' . esc_attr( $loc->term_id ) . '">';
															$output .= '<a href="' . get_term_link( $loc->term_id ) . '?post_type=event">' . esc_attr( $loc->name ) . '</a>';
														$output .= '</li>';

													}

												}

											$output .= '</ul>';
										$output .= '</div>';

									}

									if( $price == 'true' and !empty( $event_price ) ) {

										$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
										$currency = ot_get_option( 'event-price-currency' );

										$output .= '<div class="gt-price">';
											$output .= '<svg fill="currentColor" viewBox="0 -98 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m492 0h-472c-11.046875 0-20 8.953125-20 20v275.335938c0 11.042968 8.953125 20 20 20h472c11.046875 0 20-8.957032 20-20v-275.335938c0-11.046875-8.953125-20-20-20zm-118.324219 275.335938h-235.351562c-8.453125-50.175782-48.148438-89.871094-98.324219-98.324219v-38.6875c50.175781-8.453125 89.871094-48.148438 98.324219-98.324219h235.351562c8.453125 50.175781 48.148438 89.871094 98.324219 98.324219v38.6875c-50.175781 8.453125-89.871094 48.148437-98.324219 98.324219zm98.324219-177.867188c-28.070312-7.25-50.21875-29.398438-57.46875-57.46875h57.46875zm-374.53125-57.46875c-7.25 28.070312-29.398438 50.21875-57.46875 57.46875v-57.46875zm-57.46875 177.867188c28.070312 7.25 50.21875 29.394531 57.46875 57.46875h-57.46875zm374.53125 57.46875c7.25-28.074219 29.398438-50.21875 57.46875-57.46875v57.46875zm-158.53125-216.335938c-54.40625 0-98.667969 44.261719-98.667969 98.667969 0 54.402343 44.261719 98.667969 98.667969 98.667969s98.667969-44.265626 98.667969-98.667969c0-54.40625-44.261719-98.667969-98.667969-98.667969zm0 157.335938c-32.347656 0-58.667969-26.320313-58.667969-58.667969 0-32.351563 26.320313-58.667969 58.667969-58.667969s58.667969 26.316406 58.667969 58.667969c0 32.347656-26.320313 58.667969-58.667969 58.667969zm0 0"/></svg>';

											if( $currency_position == "left" ) {

												$output .= esc_attr( $currency );

											}

											if( $currency_position == "left-space" ) {

												$output .= esc_attr( $currency ) . ' ';

											}

											$output .= esc_attr( $event_price );

											if( $currency_position == "right" ) {

												$output .= esc_attr( $currency );

											}

											if( $currency_position == "right-space" ) {

												$output .= ' ' . esc_attr( $currency );

											}

										$output .= '</div>';

									}

									if( $price == 'true' and $event_price == '0' ) {

										$free_event_price = ot_get_option( 'event-free-events-price', 'free' );

										if( $free_event_price != 'hide' ) {

											$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
											$currency = ot_get_option( 'event-price-currency' );
											$event_price = "0";

											$output .= '<div class="gt-price">';
												$output .= '<svg fill="currentColor" viewBox="0 -98 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m492 0h-472c-11.046875 0-20 8.953125-20 20v275.335938c0 11.042968 8.953125 20 20 20h472c11.046875 0 20-8.957032 20-20v-275.335938c0-11.046875-8.953125-20-20-20zm-118.324219 275.335938h-235.351562c-8.453125-50.175782-48.148438-89.871094-98.324219-98.324219v-38.6875c50.175781-8.453125 89.871094-48.148438 98.324219-98.324219h235.351562c8.453125 50.175781 48.148438 89.871094 98.324219 98.324219v38.6875c-50.175781 8.453125-89.871094 48.148437-98.324219 98.324219zm98.324219-177.867188c-28.070312-7.25-50.21875-29.398438-57.46875-57.46875h57.46875zm-374.53125-57.46875c-7.25 28.070312-29.398438 50.21875-57.46875 57.46875v-57.46875zm-57.46875 177.867188c28.070312 7.25 50.21875 29.394531 57.46875 57.46875h-57.46875zm374.53125 57.46875c7.25-28.074219 29.398438-50.21875 57.46875-57.46875v57.46875zm-158.53125-216.335938c-54.40625 0-98.667969 44.261719-98.667969 98.667969 0 54.402343 44.261719 98.667969 98.667969 98.667969s98.667969-44.265626 98.667969-98.667969c0-54.40625-44.261719-98.667969-98.667969-98.667969zm0 157.335938c-32.347656 0-58.667969-26.320313-58.667969-58.667969 0-32.351563 26.320313-58.667969 58.667969-58.667969s58.667969 26.316406 58.667969 58.667969c0 32.347656-26.320313 58.667969-58.667969 58.667969zm0 0"/></svg>';

												if( $free_event_price == "free" ) {

													$output .= esc_html__( 'Free', 'eventchamp' );

												} elseif( $free_event_price == "0" ) {

													$output .= '0';

												} elseif( $free_event_price == "0-currency" ) {

													if( $currency_position == "left" ) {

														$output .= esc_attr( $currency );

													}

													if( $currency_position == "left-space" ) {

														$output .= esc_attr( $currency ) . ' ';

													}

													$output .= esc_attr( $event_price );

													if( $currency_position == "right" ) {

														$output .= esc_attr( $currency );

													}

													if( $currency_position == "right-space" ) {

														$output .= ' ' . esc_attr( $currency );

													}

												}

											$output .= '</div>';

										}

									}

									$event_remaining_tickets = get_post_meta( esc_attr( $post_id ), 'event-remaining-tickets', true );
									$event_remaining_tickets_quantity = get_post_meta( esc_attr( $post_id ), 'event-remaining-ticket-quantity', true );
									$event_remaining_tickets_woocommerce = get_post_meta( esc_attr( $post_id ), 'event-remaining-ticket-woocommerce', true );

									if( $ticket_amount == 'true' and $event_remaining_tickets == "manual-quantity" and !empty( $event_remaining_tickets_quantity ) ) {

										$output .= '<div class="gt-stock">';
											$output .= '<svg fill="currentColor" version="1.1"xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <circle cx="361.869" cy="412.123" r="19.975"/> <circle cx="315.921" cy="154.435" r="19.975"/> <path d="M491.711,312.246h19.975V192.393h-50.937c-22.029,0-39.951-17.922-39.951-39.951c0-14.948,8.255-28.532,21.544-35.453 l17.013-8.861L408.489,0L0.782,192.304l0.042,0.089H0.314v119.853H20.29c22.029,0,39.951,17.922,39.951,39.951 c0,22.029-17.922,39.951-39.951,39.951H0.314V512h511.371V392.147h-19.975c-22.029,0-39.951-17.922-39.951-39.951 C451.759,330.168,469.681,312.246,491.711,312.246z M272.143,108.484c4.85,9.631,16.505,13.713,26.323,9.095 c9.83-4.624,14.117-16.229,9.762-26.115l81.134-38.269l18.505,39.335c-16.998,14.961-27.021,36.606-27.021,59.913 c0,14.548,3.928,28.188,10.75,39.951H94.244L272.143,108.484z M471.734,429.57v42.479h-89.889 c0-11.032-8.943-19.975-19.975-19.975c-11.032,0-19.975,8.943-19.975,19.975H40.265V429.57 c34.424-8.892,59.926-40.211,59.926-77.374c0-37.163-25.503-68.483-59.926-77.374v-42.479h301.629 c0,11.032,8.943,19.975,19.975,19.975c11.032,0,19.975-8.943,19.975-19.975h89.889v42.479 c-34.424,8.892-59.926,40.211-59.926,77.374C411.808,389.36,437.31,420.678,471.734,429.57z"/> <circle cx="361.869" cy="292.27" r="19.975"/> <circle cx="361.869" cy="352.197" r="19.975"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= esc_attr( $event_remaining_tickets_quantity );
											$output .= ' ' . esc_html__( 'Tickets' , 'eventchamp' );
										$output .= '</div>';

									}

									if( $ticket_amount == 'true' and $event_remaining_tickets == "woocommerce-product" and !empty( $event_remaining_tickets_woocommerce ) ) {

										if( function_exists( 'wc_get_product' ) ) {

											$product_id = wc_get_product( $event_remaining_tickets_woocommerce );

											if( !empty( $product_id ) ) {

												$output .= '<div class="gt-stock">';
													$output .= '<svg fill="currentColor" version="1.1"xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <circle cx="361.869" cy="412.123" r="19.975"/> <circle cx="315.921" cy="154.435" r="19.975"/> <path d="M491.711,312.246h19.975V192.393h-50.937c-22.029,0-39.951-17.922-39.951-39.951c0-14.948,8.255-28.532,21.544-35.453 l17.013-8.861L408.489,0L0.782,192.304l0.042,0.089H0.314v119.853H20.29c22.029,0,39.951,17.922,39.951,39.951 c0,22.029-17.922,39.951-39.951,39.951H0.314V512h511.371V392.147h-19.975c-22.029,0-39.951-17.922-39.951-39.951 C451.759,330.168,469.681,312.246,491.711,312.246z M272.143,108.484c4.85,9.631,16.505,13.713,26.323,9.095 c9.83-4.624,14.117-16.229,9.762-26.115l81.134-38.269l18.505,39.335c-16.998,14.961-27.021,36.606-27.021,59.913 c0,14.548,3.928,28.188,10.75,39.951H94.244L272.143,108.484z M471.734,429.57v42.479h-89.889 c0-11.032-8.943-19.975-19.975-19.975c-11.032,0-19.975,8.943-19.975,19.975H40.265V429.57 c34.424-8.892,59.926-40.211,59.926-77.374c0-37.163-25.503-68.483-59.926-77.374v-42.479h301.629 c0,11.032,8.943,19.975,19.975,19.975c11.032,0,19.975-8.943,19.975-19.975h89.889v42.479 c-34.424,8.892-59.926,40.211-59.926,77.374C411.808,389.36,437.31,420.678,471.734,429.57z"/> <circle cx="361.869" cy="292.27" r="19.975"/> <circle cx="361.869" cy="352.197" r="19.975"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
													$output .= $product_id->get_stock_quantity();
													$output .= ' ' . esc_html__( 'Tickets' , 'eventchamp' );
												$output .= '</div>';

											}

										}

									}

								$output .= '</div>';

							}

						}

					$output .= '</div>';
				$output .= '</div>';

			}

			return $output;

		}

	}



/*======
*
* Event Header
*
======*/
if( !function_exists( 'eventchamp_event_header' ) ) {

	function eventchamp_event_header( $id = "" ) {

		$output = "";
		$slider_column = ot_get_option( 'event-header-image-slider-column', '1' );
		$slider_space = ot_get_option( 'event-header-image-slider-space', '0' );
		$slider_loop = ot_get_option( 'event-header-image-slider-loop', 'true' );
		$slider_autoplay = ot_get_option( 'event-header-image-slider-autoplay', 'true' );
		$slider_autoplay_delay = ot_get_option( 'event-header-image-slider-autoplay-delay', '1500' );
		$slider_direction = ot_get_option( 'event-header-image-slider-direction', 'horizontal' );
		$slider_effect = ot_get_option( 'event-header-image-slider-effect', 'slide' );
		$label_status = ot_get_option( 'event-header-label-status', 'true' );

		if( !empty( $id ) ) {

			$header_status = get_post_meta( esc_attr( $id ), 'event-header-status', true );

			if( empty( $header_status ) or $header_status == "default" ) {

				$header_status = ot_get_option( 'event-header-status', 'true' );

			}

			$header_type = get_post_meta( esc_attr( $id ), 'event-header-style', true );

			if( $header_type == "default" or empty( $header_type ) ) {

				$header_type = ot_get_option( 'event_header_style', 'image' );

			}

			$image_gallery = explode( ',', get_post_meta( esc_attr( $id ), 'event_image_gallery', true ) );
			$featured_image = get_post_meta( esc_attr( $id ), 'event_featured_image', true );
			$code = get_post_meta( esc_attr( $id ), 'header-type-code', true );

			if( $header_status == "true" ) {

				if( !empty( $header_type ) ) {

					if( $header_type == "image-slider" ) {

						if( !empty( $image_gallery ) ) {

							$output .= '<div class="gt-content-header gt-image-slider">';

								if( $label_status == "true" ) {

									$output .= eventchamp_label( esc_attr( $id ) );

								}

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

								if( $label_status == "true" ) {

									$output .= eventchamp_label( esc_attr( $id ) );

								}

								foreach( $image_gallery as $image ) {

									if( !empty( $image ) ) {

										$output .= '<div class="gt-item">';
											$output .= '<a href="' . esc_url( wp_get_attachment_image_src( esc_attr( $image ), 'full', true, true )[0] ) . '" data-srcset="' . wp_get_attachment_image_srcset( esc_attr( $image ), 'full' ) . '" data-caption="' . wp_get_attachment_caption( esc_attr( $image ) ) . '" data-fancybox="event-feature-images">';
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

								if( $label_status == "true" ) {

									$output .= eventchamp_label( esc_attr( $id ) );

								}

								$output .= get_post_meta( esc_attr( $id ), 'header-type-code', true );
							$output .= '</div>';

						}

					} elseif( $header_type == "image" ) {

						if( !empty( $featured_image ) ) {

							$output .= '<div class="gt-content-header gt-image">';

								if( $label_status == "true" ) {

									$output .= eventchamp_label( esc_attr( $id ) );

								}

								$output .= wp_get_attachment_image( eventchamp_attachment_id( $featured_image ), 'eventchamp-content-header', true, true );
							$output .= '</div>';

						} elseif ( has_post_thumbnail() ) {

							$output .= '<div class="gt-content-header gt-image">';

								if( $label_status == "true" ) {

									$output .= eventchamp_label( esc_attr( $id ) );

								}

								$output .= get_the_post_thumbnail( $id, 'eventchamp-content-header' );
							$output .= '</div>';

						}

					} else {

						if ( has_post_thumbnail() ) {

							$output .= '<div class="gt-content-header gt-image">';

								if( $label_status == "true" ) {

									$output .= eventchamp_label( esc_attr( $id ) );

								}

								$output .= get_the_post_thumbnail( $id, 'eventchamp-content-header' );
							$output .= '</div>';

						}

					}

				} else {

					if ( has_post_thumbnail() ) {

						$output .= '<div class="gt-content-header gt-image">';

							if( $label_status == "true" ) {

								$output .= eventchamp_label( esc_attr( $id ) );

							}

							$output .= get_the_post_thumbnail( $id, 'eventchamp-content-header' );
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
* Event Tabs & Sections
*
======*/
if( !function_exists( 'eventchamp_event_tabs_sections' ) ) {

	function eventchamp_event_tabs_sections( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$contents = get_post_meta( esc_attr( $id ), 'event_extra_tabs', true );
			$type = get_post_meta( esc_attr( $id ), 'event-content-listing-type', true );

			if( $type == "default" or empty( $type ) ) {

				$type = ot_get_option( 'event-content-listing-type', 'tab' );

			}

			if( !empty( $contents ) ) {

				if( $type == "tab" ) {

					$output .= '<div class="gt-event-section-tabs">';
						$output .= '<ul class="gt-event-tabs nav" role="tablist">';

							$i = 0;
							$tab_order_id = 0;

							foreach( $contents as $content ) {

								$i++;
								$tab_order_id++;

								if( !empty( $content ) ) {

									if( !empty( $content["title"] ) ) {

										$output .= '<li>';

											if( $i == "1" ) {

												$output .= '<a data-toggle="tab" class="active show" href="#gt-event-tab-' . esc_attr( $tab_order_id ) . '" data-gt-type="' . esc_attr( $content["type"] ) . '" role="tab" aria-controls="gt-event-tab-' . esc_attr( $tab_order_id ) . '" aria-selected="true">';

											} else {

												$output .= '<a data-toggle="tab" href="#gt-event-tab-' . esc_attr( $tab_order_id ) . '" data-gt-type="' . esc_attr( $content["type"] ) . '" role="tab" aria-controls="gt-event-tab-' . esc_attr( $tab_order_id ) . '" aria-selected="true">';

											}

												$output .= esc_attr( $content["title"] );
											$output .= '</a>';
										$output .= '</li>';

									}

								}

							}

						$output .= '</ul>';

					$output .= '<div class="tab-content">';

				} elseif( $type == "section" ) {

					$output .= '<div class="gt-event-sections">';

				}

					$i = 0;
					$tab_order_id = 0;

					foreach( $contents as $content ) {

						$i++;
						$tab_order_id++;

						if( !empty( $content ) ) {

							if( $type == "tab" ) {

								if( $i == "1" ) {

									$output .= '<div class="tab-pane fade  active show" id="gt-event-tab-' . esc_attr( $tab_order_id ) . '" data-gt-type="' . esc_attr( $content["type"] ) . '" role="tabpanel" aria-labelledby="nav-gt-event-tab-' . esc_attr( $tab_order_id ) . '-tab">';

								} else {

									$output .= '<div class="tab-pane fade" id="gt-event-tab-' . esc_attr( $tab_order_id ) . '" data-gt-type="' . esc_attr( $content["type"] ) . '" role="tabpanel" aria-labelledby="nav-gt-event-tab-' . esc_attr( $tab_order_id ) . '-tab">';

								}

							} elseif( $type == "section" ) {

								$output .= '<div class="gt-section" data-gt-type="' . esc_attr( $content["type"] ) . '">';

									if( !empty( $content["title"] ) ) {

										$output .= '<div class="gt-section-title">' . esc_attr( $content["title"] ) . '</div>';

									}

							}

								if( $content["type"] == "content" ) {

									if( !empty( $content["event_extra_tabs_content"] ) ) {

										$output .= '<div class="gt-content">';
											$output .= do_shortcode( wpautop( $content["event_extra_tabs_content"] ) );
										$output .= '</div>';

									}

								} elseif( $content["type"] == "speakers" ) {

									$event_speakers = get_post_meta( esc_attr( $id ), 'event_speakers', true );

									$event_speaker_style = $content["speaker-style"];

									if( $event_speaker_style == "default" or empty( $event_speaker_style ) ) {

										$event_speaker_style = ot_get_option( 'event-speaker-style', 'style-3' );

									}

									$event_speaker_column = $content["speaker-column"];

									if( $event_speaker_column == "default" or empty( $event_speaker_column ) ) {

										$event_speaker_column = ot_get_option( 'event-speaker-column', '2' );

									}

									$event_speaker_column_space = $content["speaker-column-space"];

									if( $event_speaker_column_space == "default" or empty( $event_speaker_column_space ) ) {

										$event_speaker_column_space = ot_get_option( 'event-speaker-column-space', '20' );

									}

									$event_speaker_photo = $content["speaker-photo"];

									if( $event_speaker_photo == "default" or empty( $event_speaker_photo ) ) {

										$event_speaker_photo = ot_get_option( 'event-speaker-photo', 'true' );

									}

									$event_speaker_profession = $content["speaker-profession"];

									if( $event_speaker_profession == "default" or empty( $event_speaker_profession ) ) {

										$event_speaker_profession = ot_get_option( 'event-speaker-profession', 'true' );

									}

									$event_speaker_summary = $content["speaker-summary"];

									if( $event_speaker_summary == "default" or empty( $event_speaker_summary ) ) {

										$event_speaker_summary = ot_get_option( 'event-speaker-summary', 'true' );

									}

									$event_speaker_social = $content["speaker-social"];

									if( $event_speaker_social == "default" or empty( $event_speaker_social ) ) {

										$event_speaker_social = ot_get_option( 'event-speaker-social', 'true' );

									}

									if( !empty( $event_speakers ) ) {

										if( !empty( eventchamp_event_speakers( $post_id = esc_attr( $id ), $column = $event_speaker_column, $column_space = $event_speaker_column_space, $style = $event_speaker_style, $image = $event_speaker_photo, $profession = $event_speaker_profession, $summary = $event_speaker_summary, $social = $event_speaker_social ) ) ) {

											$output .= '<div class="gt-section-content">';
												$output .= eventchamp_event_speakers( $post_id = esc_attr( $id ), $column = $event_speaker_column, $column_space = $event_speaker_column_space, $style = $event_speaker_style, $image = $event_speaker_photo, $profession = $event_speaker_profession, $summary = $event_speaker_summary, $social = $event_speaker_social );
											$output .= '</div>';

										}

									}

								} elseif( $content["type"] == "schedule" ) {

									if( !empty( eventchamp_schedule( $post_id = esc_attr( $id ), $first_open = "false", $all_open = "false" ) ) ) {

										$output .= '<div class="gt-section-content">';
											$output .= eventchamp_schedule( $post_id = esc_attr( $id ), $first_open = "false", $all_open = "false" );
										$output .= '</div>';

									}

								} elseif( $content["type"] == "tickets" ) {

									if( !empty( eventchamp_event_tickets( $post_id = esc_attr( $id ) ) ) ) {

										$output .= '<div class="gt-section-content">';
											$output .= eventchamp_event_tickets( $post_id = esc_attr( $id ) );
										$output .= '</div>';

									}

								} elseif( $content["type"] == "photos" ) {

									if( !empty( eventchamp_event_photos( $id = esc_attr( $id ) ) ) ) {

										$output .= '<div class="gt-section-content">';
											$output .= eventchamp_event_photos( $id = esc_attr( $id ) );
										$output .= '</div>';

									}

								} elseif( $content["type"] == "map" ) {

									if( !empty( eventchamp_event_map( $id = esc_attr( $id ) ) ) ) {

										$output .= '<div class="gt-section-content">';
											$output .= eventchamp_event_map( $id = esc_attr( $id ) );
										$output .= '</div>';

									}

								} elseif( $content["type"] == "3d-tour" ) {

									if( !empty( eventchamp_event_google_street_view( $event_id = esc_attr( $id ), $height = "450" ) ) ) {

										$output .= '<div class="gt-section-content">';
											$output .= eventchamp_event_google_street_view( $event_id = esc_attr( $id ), $height = "450" );
										$output .= '</div>';

									}

								} elseif( $content["type"] == "faq" ) {

									if( !empty( eventchamp_event_faq( $post_id = esc_attr( $id ), $first_open = "false" ) ) ) {

										$output .= '<div class="gt-section-content">';
											$output .= eventchamp_event_faq( $post_id = esc_attr( $id ), $first_open = "false" );
										$output .= '</div>';

									}

								} elseif( $content["type"] == "contact-form" ) {

									$event_contact_form = $content["event-extra-tabs-contact-form-shortcode"];

									if( empty( $event_contact_form ) ) {

										$event_contact_form = ot_get_option( 'event_contact_form' );
									}

									if( !empty( $event_contact_form ) ) {

										$output .= '<div class="gt-section-content">';
											$output .= do_shortcode( $event_contact_form );
										$output .= '</div>';

									}

								}

							if( $type == "tab" ) {

								$output .= '</div>';

							} elseif( $type == "section" ) {

								$output .= '</div>';

							}

						}

					}

				if( $type == "tab" ) {

						$output .= '</div>';
					$output .= '</div>';

				} elseif( $type == "section" ) {

					$output .= '</div>';

				}

			}

		}

		return $output;
	}

}



/*======
*
* Event Photos Section
*
======*/
if( !function_exists( 'eventchamp_event_photos_section' ) ) {

	function eventchamp_event_photos_section( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$images = get_post_meta( esc_attr( $id ), 'event_media_tab_images', true );
			$photos_status = get_post_meta( esc_attr( $id ), 'event-photos-status', true );

			if( $photos_status == "default" or empty( $photos_status ) ) {

				$photos_status = ot_get_option( 'event-photos-status', 'true' );

			}

			if( $photos_status == "true" and !empty( $images ) ) {

				$output .= '<div class="gt-section">';
					$output .= '<div class="gt-section-title">';
						$output .= esc_html__( 'Photos', 'eventchamp' );
					$output .= '</div>';
					$output .= '<div class="gt-section-content">';
						$output .= eventchamp_event_photos( $id = esc_attr( $id ) );
					$output .= '</div>';
				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Event Photos
*
======*/
if( !function_exists( 'eventchamp_event_photos' ) ) {

	function eventchamp_event_photos( $id = "", $extra_column = "", $extra_column_space = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$photo_column = ot_get_option( 'event-photo-column', '3' );
			$photo_column_space = ot_get_option( 'event-photo-column-space', '0' );

			$event_photo_column = get_post_meta( esc_attr( $id ), 'event-photo-column', true );

			if( $event_photo_column == "default" or empty( $event_photo_column ) ) {

				$event_photo_column = $photo_column;

			}

			if( !empty( $extra_column ) ) {

				$event_photo_column = $extra_column;

			}

			$event_photo_column_space = get_post_meta( esc_attr( $id ), 'event-photo-column-space', true );

			if( $event_photo_column_space == "default" or empty( $event_photo_column_space ) ) {

				$event_photo_column_space = $photo_column_space;

			}

			if( !empty( $extra_column_space ) ) {

				$event_photo_column_space = $extra_column_space;

			}

			$photos = explode( ',', get_post_meta( esc_attr( $id ), 'event_media_tab_images', true ) );

			if( !empty( $photos ) ) {

				$output .= '<div class="gt-photos-sections gt-columns gt-column-' . esc_attr( $event_photo_column ) . ' gt-column-space-' . esc_attr( $event_photo_column_space ) . '">';

					foreach( $photos as $photo ) {

						if( !empty( $photo ) ) {

							if( !empty( $photo ) ) {

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= '<a href="' . esc_url( wp_get_attachment_image_src( esc_attr( $photo ), 'full', true, true )[0] ) . '" data-srcset="' . wp_get_attachment_image_srcset( esc_attr( $photo ), 'full' ) . '" data-caption="' . wp_get_attachment_caption( esc_attr( $photo ) ) . '" data-fancybox="event-photos">';
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
* Event Detail Box
*
======*/
if( !function_exists( 'eventchamp_event_detail_box' ) ) {

	function eventchamp_event_detail_box( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$event_detail_box = ot_get_option( 'event-detail-box-status', 'on' );
			$countdown_status = ot_get_option( 'event-detail-box-countdown', 'on' );
			$start_date_status = ot_get_option( 'event-detail-box-start', 'on' );
			$end_date_status = ot_get_option( 'event-detail-box-end', 'on' );
			$repeat_dates_status = ot_get_option( 'event-detail-repeat-dates', 'on' );
			$event_status_status = ot_get_option( 'event-detail-box-event-status', 'on' );
			$location_status = ot_get_option( 'event-detail-box-location', 'on' );
			$venue_status = ot_get_option( 'event-detail-box-venue', 'on' );
			$organizer_status = ot_get_option( 'event-detail-box-organizer', 'on' );
			$category_status = ot_get_option( 'event-detail-box-category', 'on' );
			$address_status = ot_get_option( 'event-detail-box-address', 'on' );
			$phone_status = ot_get_option( 'event-detail-box-phone', 'on' );
			$email_status = ot_get_option( 'event-detail-box-email', 'on' );
			$fax_status = ot_get_option( 'event-detail-box-fax', 'on' );
			$remaining_tickets_status = ot_get_option( 'event-detail-remaining-tickets', 'on' );
			$social_status = ot_get_option( 'event-detail-box-social', 'on' );
			$extra_status = ot_get_option( 'event-detail-box-extra', 'on' );
			$event_like_system = ot_get_option( 'event-like-system', 'on' );
			$event_favorite_system = ot_get_option( 'event-favorite-system', 'on' );

			$locations = wp_get_post_terms( esc_attr( $id ), 'location' );
			$organizers = wp_get_post_terms( esc_attr( $id ), 'organizer' );
			$categories = wp_get_post_terms( esc_attr( $id ), 'eventcat' );

			$event_venues = get_post_meta( esc_attr( $id ), 'event_venue', true );
			$event_address = get_post_meta( esc_attr( $id ), 'event_detailed_address', true );
			$event_phone = get_post_meta( esc_attr( $id ), 'event_phone', true );
			$event_email = get_post_meta( esc_attr( $id ), 'event_email', true );
			$event_fax = get_post_meta( esc_attr( $id ), 'event-fax', true );
			$event_attendees = get_post_meta( esc_attr( $id ), 'event-attendees', true );
			$event_attendees_count = get_post_meta( esc_attr( $id ), 'event-attendees-count', true );
			$event_attendees_woocommerce = get_post_meta( esc_attr( $id ), 'event-attendees-woocommerce', true );
			$event_remaining_tickets = get_post_meta( esc_attr( $id ), 'event-remaining-tickets', true );
			$event_remaining_tickets_quantity = get_post_meta( esc_attr( $id ), 'event-remaining-ticket-quantity', true );
			$event_remaining_tickets_woocommerce = get_post_meta( esc_attr( $id ), 'event-remaining-ticket-woocommerce', true );
			$social_links = get_post_meta( esc_attr( $id ), 'social-links', true );
			$extra_details_position = get_post_meta( esc_attr( $id ), 'extra-event-details-position', true );
			$extra_details = get_post_meta( esc_attr( $id ), 'extra-event-details', true );
			$event_start_date = get_post_meta( esc_attr( $id ), 'event_start_date', true );
			$event_start_time = get_post_meta( esc_attr( $id ), 'event_start_time', true );
			$event_end_date = get_post_meta( esc_attr( $id ), 'event_end_date', true );
			$event_end_time = get_post_meta( esc_attr( $id ), 'event_end_time', true );
			$event_start_date_last = "";
			$date_now = date( 'Y-m-d H:i' );

			if( !empty( $event_start_date ) and !empty( $event_start_time ) ) {

				$event_start_date_last = date_format( date_create( $event_start_date . $event_start_time ), 'Y-m-d H:i' );

			}

			if( $event_detail_box == "on" or $event_detail_box !== "off" ) {

				$output .= '<div class="gt-widget gt-detail-widget">';
					$output .= '<div class="gt-widget-title">';
						$output .= '<span>' . esc_html__( 'Event Details' , 'eventchamp' ) . '</span>';

						if( $event_like_system == "on" or $event_favorite_system == "on" ) {

							$output .= '<div class="gt-like-box">';
								$output .= '<div class="gt-inner-box">';

									if( $event_like_system == "on" ) {

										$output .= eventchamp_like_button( get_the_ID() );

									}

									if( $event_favorite_system == "on" ) {

										$output .= eventchamp_favorite_button( get_the_ID() );

									}
								$output .= '</div>';
							$output .= '</div>';

						}

					$output .= '</div>';

					$output .= '<div class="gt-widget-content">';
						$output .= '<div class="gt-content-detail-box">';
							$output .= '<ul>';

								if( $countdown_status == "on" and !empty( $event_start_date ) and !empty( $event_start_time ) ) {

									if( !empty( $event_start_date ) and !empty( $event_start_time ) and $event_start_date_last >= $date_now ) {

										$output .= '<li class="gt-event-counter">';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-event-starting-time">';
													$output .= '<div class="gt-days">';
														$output .= '<div class="gt-count"></div>';
														$output .= '<div class="gt-title">' . esc_html__( 'Days', 'eventchamp' ) . '</div>';
													$output .= '</div>';
													$output .= '<div class="gt-hours">';
														$output .= '<div class="gt-count"></div>';
														$output .= '<div class="gt-title">' . esc_html__( 'Hours', 'eventchamp' ) . '</div>';
													$output .= '</div>';
													$output .= '<div class="gt-minutes">';
														$output .= '<div class="gt-count"></div>';
														$output .= '<div class="gt-title">' . esc_html__( 'Min', 'eventchamp' ) . '</div>';
													$output .= '</div>';
													$output .= '<div class="gt-secondes">';
														$output .= '<div class="gt-count"></div>';
														$output .= '<div class="gt-title">' . esc_html__( 'Sec', 'eventchamp' ) . '</div>';
													$output .= '</div>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $extra_status == "on" ) {

									if( $extra_details_position == "before-current" ) {

										if( !empty( $extra_details ) ) {

											foreach( $extra_details as $detail ) {

												if( !empty( $detail ) ) {

													$output .= '<li class="gt-extra-detail">';

														if( $detail["icon-type"] == "font-icon" and !empty( $detail["font-icon"] ) ) {

															$output .= '<div class="gt-icon gt-font-icon">';
																$output .= '<i class="' . esc_attr( $detail["font-icon"] ) . '"></i>';
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

								if( $start_date_status == "on" ) {

									if( !empty( $event_start_date ) and !empty( $event_start_time ) ) {

										$output .= '<li class="gt-start-date">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59 59" xml:space="preserve"> <g> <path d="M51.179,40.429l-5.596,8.04l-3.949-3.241c-0.426-0.352-1.057-0.288-1.407,0.138c-0.351,0.427-0.289,1.058,0.139,1.407 l4.786,3.929c0.18,0.148,0.404,0.228,0.634,0.228c0.045,0,0.091-0.003,0.137-0.01c0.276-0.038,0.524-0.19,0.684-0.419l6.214-8.929 c0.315-0.453,0.204-1.076-0.25-1.392C52.116,39.861,51.494,39.975,51.179,40.429z"/> <path d="M52,34.479V15V5c0-0.553-0.448-1-1-1h-5V1c0-0.553-0.448-1-1-1h-7c-0.552,0-1,0.447-1,1v3H15V1c0-0.553-0.448-1-1-1H7 C6.448,0,6,0.447,6,1v3H1C0.448,4,0,4.447,0,5v10v41c0,0.553,0.448,1,1,1h38.104c2.002,1.26,4.362,2,6.896,2 c7.168,0,13-5.832,13-13C59,40.997,56.154,36.651,52,34.479z M39,2h5v3v3h-5V5V2z M8,2h5v3v3H8V5V2z M2,6h4v3c0,0.553,0.448,1,1,1 h7c0.552,0,1-0.447,1-1V6h22v3c0,0.553,0.448,1,1,1h7c0.552,0,1-0.447,1-1V6h4v8H2V6z M2,55V16h48v17.636 c-0.196-0.063-0.396-0.114-0.596-0.169c-0.185-0.051-0.37-0.101-0.557-0.144c-0.169-0.038-0.34-0.071-0.511-0.102 c-0.244-0.045-0.489-0.082-0.735-0.113c-0.137-0.017-0.273-0.036-0.411-0.049C46.796,33.024,46.399,33,46,33 c-0.338,0-0.669,0.025-1,0.051V32v-2v-9h-9h-2h-7h-2h-7h-2H7v9v2v7v2v9h9h2h7h2h6.636c0.029,0.088,0.065,0.173,0.095,0.26 c0.084,0.243,0.167,0.487,0.266,0.724c0.055,0.133,0.12,0.26,0.18,0.39c0.115,0.254,0.232,0.507,0.363,0.753 c0.058,0.107,0.123,0.21,0.184,0.316c0.148,0.259,0.298,0.515,0.464,0.763c0.061,0.091,0.128,0.177,0.191,0.267 c0.176,0.25,0.356,0.498,0.551,0.736c0.072,0.088,0.15,0.17,0.224,0.256c0.155,0.18,0.303,0.364,0.468,0.536H2z M40.313,34.328 c-0.108,0.052-0.218,0.101-0.324,0.156c-0.188,0.098-0.37,0.206-0.552,0.313c-0.159,0.093-0.318,0.188-0.473,0.287 c-0.157,0.102-0.31,0.206-0.462,0.314c-0.173,0.122-0.341,0.25-0.508,0.38c-0.134,0.105-0.268,0.209-0.397,0.32 c-0.175,0.148-0.342,0.305-0.509,0.462c-0.115,0.109-0.234,0.214-0.345,0.326c-0.181,0.184-0.352,0.379-0.522,0.574 c-0.072,0.083-0.151,0.159-0.222,0.244V32h7v1.362c-0.017,0.004-0.033,0.01-0.049,0.014C42.029,33.599,41.147,33.92,40.313,34.328z M33.57,42.199c-0.035,0.115-0.058,0.233-0.09,0.349c-0.08,0.29-0.162,0.58-0.222,0.879c-0.047,0.231-0.073,0.467-0.107,0.701 c-0.027,0.189-0.065,0.375-0.085,0.567C33.023,45.126,33,45.562,33,46c0,0.361,0.02,0.726,0.053,1.092 c0.006,0.067,0.006,0.135,0.013,0.202c0.016,0.162,0.048,0.319,0.07,0.479c0,0,0,0.001,0,0.001 c0.011,0.076,0.015,0.151,0.027,0.226H27v-7h7v0.007c-0.01,0.024-0.016,0.049-0.026,0.073 C33.824,41.445,33.687,41.818,33.57,42.199z M9,41h7v7H9V41z M9,32h7v7H9V32z M43,30h-7v-7h7V30z M34,30h-7v-7h7V30z M34,39h-7v-7 h7V39z M18,32h7v7h-7V32z M25,30h-7v-7h7V30z M16,30H9v-7h7V30z M18,41h7v7h-7V41z M46,57c-2.258,0-4.359-0.686-6.107-1.858 c-0.341-0.228-0.663-0.476-0.972-0.736c-0.108-0.092-0.21-0.19-0.314-0.286c-0.197-0.179-0.388-0.363-0.57-0.554 c-0.117-0.123-0.23-0.248-0.341-0.375c-0.164-0.189-0.318-0.384-0.468-0.583c-0.096-0.127-0.195-0.25-0.286-0.381 c-0.221-0.321-0.429-0.651-0.615-0.993c-0.043-0.08-0.077-0.164-0.118-0.245c-0.146-0.286-0.282-0.576-0.403-0.874 c-0.052-0.13-0.097-0.263-0.145-0.395c-0.094-0.262-0.18-0.528-0.255-0.797c-0.017-0.062-0.032-0.124-0.048-0.186 c-0.113-0.44-0.196-0.877-0.255-1.312c-0.004-0.031-0.01-0.062-0.014-0.094C35.031,46.882,35,46.437,35,46 c0-0.379,0.019-0.755,0.058-1.128c0.003-0.031,0.011-0.061,0.014-0.092c0.038-0.341,0.088-0.681,0.158-1.016 c0.007-0.032,0.018-0.063,0.025-0.095c0.072-0.332,0.157-0.662,0.26-0.988c0.012-0.038,0.029-0.075,0.041-0.113 c0.103-0.312,0.217-0.622,0.349-0.926c0.124-0.286,0.258-0.567,0.405-0.84l0.099-0.171c0.04-0.072,0.087-0.14,0.129-0.211 c0.174-0.293,0.36-0.577,0.557-0.851c0.049-0.068,0.1-0.135,0.151-0.202c0.18-0.238,0.37-0.467,0.568-0.688 c0.069-0.077,0.138-0.155,0.209-0.23c0.196-0.208,0.402-0.405,0.613-0.596c0.075-0.068,0.148-0.138,0.225-0.204 c0.248-0.212,0.505-0.411,0.77-0.6c0.042-0.03,0.082-0.063,0.124-0.093c1.305-0.902,2.804-1.52,4.412-1.79l0.021-0.003 C44.778,35.064,45.381,35,46,35c0.389,0,0.776,0.021,1.16,0.063c0.06,0.006,0.118,0.02,0.178,0.027 c0.328,0.041,0.655,0.09,0.978,0.16c0.04,0.009,0.078,0.021,0.117,0.03c0.344,0.079,0.685,0.171,1.022,0.284 c0.023,0.008,0.045,0.017,0.068,0.025c0.345,0.118,0.685,0.253,1.022,0.406C54.347,37.729,57,41.557,57,46 C57,52.065,52.065,57,46,57z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Start Date', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= eventchamp_global_date_converter( $date = esc_attr( $event_start_date ) ) . ' ' . eventchamp_global_time_converter( $time = esc_attr( $event_start_time ) );
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $end_date_status == "on" ) {

									if( !empty( $event_end_date ) and !empty( $event_end_time ) ) {

										$output .= '<li class="gt-end-date">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59 59" xml:space="preserve"> <g> <path d="M50.95,41.13c-0.391-0.391-1.023-0.391-1.414,0L46,44.666l-3.536-3.536c-0.391-0.391-1.023-0.391-1.414,0 s-0.391,1.023,0,1.414l3.536,3.536l-3.536,3.536c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293 s0.512-0.098,0.707-0.293L46,47.494l3.536,3.536c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293 c0.391-0.391,0.391-1.023,0-1.414l-3.536-3.536l3.536-3.536C51.34,42.153,51.34,41.521,50.95,41.13z"/> <path d="M52,34.479V15V5c0-0.553-0.448-1-1-1h-5V1c0-0.553-0.448-1-1-1h-7c-0.552,0-1,0.447-1,1v3H15V1c0-0.553-0.448-1-1-1H7 C6.448,0,6,0.447,6,1v3H1C0.448,4,0,4.447,0,5v10v41c0,0.553,0.448,1,1,1h38.104c2.002,1.26,4.362,2,6.896,2 c7.168,0,13-5.832,13-13C59,40.997,56.154,36.651,52,34.479z M39,2h5v3v3h-5V5V2z M8,2h5v3v3H8V5V2z M2,6h4v3c0,0.553,0.448,1,1,1 h7c0.552,0,1-0.447,1-1V6h22v3c0,0.553,0.448,1,1,1h7c0.552,0,1-0.447,1-1V6h4v8H2V6z M2,55V16h48v17.636 c-0.196-0.063-0.396-0.114-0.596-0.169c-0.185-0.051-0.37-0.101-0.557-0.144c-0.169-0.038-0.34-0.071-0.511-0.102 c-0.244-0.045-0.489-0.082-0.735-0.113c-0.137-0.017-0.273-0.036-0.411-0.049C46.796,33.024,46.399,33,46,33 c-0.338,0-0.669,0.025-1,0.051V32v-2v-9h-9h-2h-7h-2h-7h-2H7v9v2v7v2v9h9h2h7h2h6.636c0.029,0.088,0.065,0.173,0.095,0.26 c0.084,0.243,0.167,0.487,0.266,0.724c0.055,0.133,0.12,0.26,0.18,0.39c0.115,0.254,0.232,0.507,0.363,0.753 c0.058,0.107,0.123,0.21,0.184,0.316c0.148,0.259,0.298,0.515,0.464,0.763c0.061,0.091,0.128,0.177,0.191,0.267 c0.176,0.25,0.356,0.498,0.551,0.736c0.072,0.088,0.15,0.17,0.224,0.256c0.155,0.18,0.303,0.364,0.468,0.536H2z M40.313,34.328 c-0.108,0.052-0.218,0.101-0.324,0.156c-0.188,0.098-0.37,0.206-0.552,0.313c-0.159,0.093-0.318,0.188-0.473,0.287 c-0.157,0.102-0.31,0.206-0.462,0.314c-0.173,0.122-0.341,0.25-0.508,0.38c-0.134,0.105-0.268,0.209-0.397,0.32 c-0.175,0.148-0.342,0.305-0.509,0.462c-0.115,0.109-0.234,0.214-0.345,0.326c-0.181,0.184-0.352,0.379-0.522,0.574 c-0.072,0.083-0.151,0.159-0.222,0.244V32h7v1.362c-0.017,0.004-0.033,0.01-0.049,0.014C42.029,33.599,41.147,33.92,40.313,34.328z M33.57,42.199c-0.035,0.115-0.058,0.233-0.09,0.349c-0.08,0.29-0.162,0.58-0.222,0.879c-0.047,0.231-0.073,0.467-0.107,0.701 c-0.027,0.189-0.065,0.375-0.085,0.567C33.023,45.126,33,45.562,33,46c0,0.361,0.02,0.726,0.053,1.092 c0.006,0.067,0.006,0.135,0.013,0.202c0.016,0.162,0.048,0.319,0.07,0.479c0,0,0,0.001,0,0.001 c0.011,0.076,0.015,0.151,0.027,0.226H27v-7h7v0.007c-0.01,0.024-0.016,0.049-0.026,0.073 C33.824,41.445,33.687,41.818,33.57,42.199z M9,41h7v7H9V41z M9,32h7v7H9V32z M43,30h-7v-7h7V30z M34,30h-7v-7h7V30z M34,39h-7v-7 h7V39z M18,32h7v7h-7V32z M25,30h-7v-7h7V30z M16,30H9v-7h7V30z M18,41h7v7h-7V41z M46,57c-2.258,0-4.359-0.686-6.107-1.858 c-0.341-0.228-0.663-0.476-0.972-0.736c-0.108-0.092-0.21-0.19-0.314-0.286c-0.197-0.179-0.388-0.363-0.57-0.554 c-0.117-0.123-0.23-0.248-0.341-0.375c-0.164-0.189-0.318-0.384-0.468-0.583c-0.096-0.127-0.195-0.25-0.286-0.381 c-0.221-0.321-0.429-0.651-0.615-0.993c-0.043-0.08-0.077-0.164-0.118-0.245c-0.146-0.286-0.282-0.576-0.403-0.874 c-0.052-0.13-0.097-0.263-0.145-0.395c-0.094-0.262-0.18-0.528-0.255-0.797c-0.017-0.062-0.032-0.124-0.048-0.186 c-0.113-0.44-0.196-0.877-0.255-1.312c-0.004-0.031-0.01-0.062-0.014-0.094C35.031,46.882,35,46.437,35,46 c0-0.379,0.019-0.755,0.058-1.128c0.003-0.031,0.011-0.061,0.014-0.092c0.038-0.341,0.088-0.681,0.158-1.016 c0.007-0.032,0.018-0.063,0.025-0.095c0.072-0.332,0.157-0.662,0.26-0.988c0.012-0.038,0.029-0.075,0.041-0.113 c0.103-0.312,0.217-0.622,0.349-0.926c0.124-0.286,0.258-0.567,0.405-0.84l0.099-0.171c0.04-0.072,0.087-0.14,0.129-0.211 c0.174-0.293,0.36-0.577,0.557-0.851c0.049-0.068,0.1-0.135,0.151-0.202c0.18-0.238,0.37-0.467,0.568-0.688 c0.069-0.077,0.138-0.155,0.209-0.23c0.196-0.208,0.402-0.405,0.613-0.596c0.075-0.068,0.148-0.138,0.225-0.204 c0.248-0.212,0.505-0.411,0.77-0.6c0.042-0.03,0.082-0.063,0.124-0.093c1.305-0.902,2.804-1.52,4.412-1.79l0.021-0.003 C44.778,35.064,45.381,35,46,35c0.389,0,0.776,0.021,1.16,0.063c0.06,0.006,0.118,0.02,0.178,0.027 c0.328,0.041,0.655,0.09,0.978,0.16c0.04,0.009,0.078,0.021,0.117,0.03c0.344,0.079,0.685,0.171,1.022,0.284 c0.023,0.008,0.045,0.017,0.068,0.025c0.345,0.118,0.685,0.253,1.022,0.406C54.347,37.729,57,41.557,57,46 C57,52.065,52.065,57,46,57z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'End Date', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= eventchamp_global_date_converter( $date = esc_attr( $event_end_date ) ) . ' ' . eventchamp_global_time_converter( $time = esc_attr( $event_end_time ) );
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $repeat_dates_status == "on" ) {

									if( !empty( eventchamp_event_repeat_dates( $post_id = esc_attr( $id ) ) ) ) {

										$output .= '<li class="gt-repeat-dates">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><g id="Calendar"><path d="M15,20H9a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h6a1,1,0,0,0,1-1V21A1,1,0,0,0,15,20Zm-1,6H10V22h4Z"/><path d="M21,28h6a1,1,0,0,0,1-1V21a1,1,0,0,0-1-1H21a1,1,0,0,0-1,1v6A1,1,0,0,0,21,28Zm1-6h4v4H22Z"/><path d="M15,30H9a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h6a1,1,0,0,0,1-1V31A1,1,0,0,0,15,30Zm-1,6H10V32h4Z"/><path d="M15,40H9a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h6a1,1,0,0,0,1-1V41A1,1,0,0,0,15,40Zm-1,6H10V42h4Z"/><path d="M52,26.273V9a5.006,5.006,0,0,0-5-5H45V2H43V4H37V2H35V4H29V2H27V4H21V2H19V4H13V2H11V4H7A5.006,5.006,0,0,0,2,9V49a5.006,5.006,0,0,0,5,5H27.537A18.987,18.987,0,1,0,52,26.273ZM7,6h4V8h2V6h6V8h2V6h6V8h2V6h6V8h2V6h6V8h2V6h2a3,3,0,0,1,3,3v5H4V9A3,3,0,0,1,7,6ZM7,52a3,3,0,0,1-3-3V16H50v9.353a18.891,18.891,0,0,0-22,6.028V31a1,1,0,0,0-1-1H21a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h3.69a18.641,18.641,0,0,0-.429,2H21a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h3.69a18.856,18.856,0,0,0,1.583,4ZM26,34.566c-.233.468-.452.944-.647,1.434H22V32h4ZM24.261,46H22V42h2.051c-.018.333-.051.662-.051,1A18.9,18.9,0,0,0,24.261,46ZM52.345,57.186l-1.479-2.561-1.732,1,1.475,2.555A16.837,16.837,0,0,1,44,59.949V57H42v2.949a16.837,16.837,0,0,1-6.609-1.769l1.475-2.555-1.732-1-1.479,2.561a17.143,17.143,0,0,1-4.841-4.841l2.562-1.479-1-1.732L27.82,50.609A16.841,16.841,0,0,1,26.051,44H29V42H26.051a16.841,16.841,0,0,1,1.769-6.609l2.556,1.475,1-1.732-2.562-1.479a17.143,17.143,0,0,1,4.841-4.841l1.479,2.561,1.732-1L35.391,27.82A16.837,16.837,0,0,1,42,26.051V29h2V26.051a16.837,16.837,0,0,1,6.609,1.769l-1.475,2.555,1.732,1,1.479-2.561a17.143,17.143,0,0,1,4.841,4.841l-2.562,1.479,1,1.732,2.556-1.475A16.841,16.841,0,0,1,59.949,42H57v2h2.949a16.841,16.841,0,0,1-1.769,6.609l-2.556-1.475-1,1.732,2.562,1.479A17.143,17.143,0,0,1,52.345,57.186Z"/><path d="M44,40.184V31H42v9.184A2.993,2.993,0,1,0,45.816,44H51V42H45.816A3,3,0,0,0,44,40.184ZM43,44a1,1,0,1,1,1-1A1,1,0,0,1,43,44Z"/></g></svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'It Will Be Repeated On', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= eventchamp_event_repeat_dates( $post_id = esc_attr( $id ) );
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $event_status_status == "on" and !empty( eventchamp_event_status( $post_id = esc_attr( $id ) ) ) ) {

									$output .= '<li class="gt-status">';
										$output .= '<div class="gt-icon">';
											$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 52 52" xml:space="preserve"> <g> <path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26 S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z"/> <path d="M38.252,15.336l-15.369,17.29l-9.259-7.407c-0.43-0.345-1.061-0.274-1.405,0.156c-0.345,0.432-0.275,1.061,0.156,1.406 l10,8C22.559,34.928,22.78,35,23,35c0.276,0,0.551-0.114,0.748-0.336l16-18c0.367-0.412,0.33-1.045-0.083-1.411 C39.251,14.885,38.62,14.922,38.252,15.336z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
										$output .= '</div>';
										$output .= '<div class="gt-content">';
											$output .= '<div class="gt-title">' . esc_html__( 'Status', 'eventchamp' ) . '</div>';
											$output .= '<div class="gt-inner">';
												$output .= eventchamp_event_status( $post_id = esc_attr( $id ) );
											$output .= '</div>';
										$output .= '</div>';
									$output .= '</li>';

								}

								if( $location_status == "on" ) {

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
																	$output .= '<a href="' . esc_url( get_term_link( $location->term_id ) . '?post_type=event' ) . '">' . esc_attr( $location->name ) . '</a>';
																$output .= '</li>';

															}

														}

													$output .= '</ul>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';
									}

								}

								if( $venue_status == "on" ) {

									if( !empty( $event_venues ) and is_array( $event_venues ) ) {

										$output .= '<li class="gt-venue">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 55.017 55.017" xml:space="preserve"> <g> <path d="M51.688,23.013H40.789c-0.553,0-1,0.447-1,1s0.447,1,1,1h9.102l2.899,27H2.268l3.403-27h9.118c0.553,0,1-0.447,1-1 s-0.447-1-1-1H3.907L0,54.013h55.017L51.688,23.013z"/> <path d="M26.654,38.968c-0.147,0.087-0.304,0.164-0.445,0.255c-0.22,0.142-0.435,0.291-0.646,0.445 c-0.445,0.327-0.541,0.953-0.215,1.398c0.196,0.267,0.5,0.408,0.808,0.408c0.205,0,0.412-0.063,0.591-0.193 c0.178-0.131,0.359-0.257,0.548-0.379c0.321-0.208,0.662-0.403,1.014-0.581c0.468-0.237,0.658-0.791,0.462-1.269 c0.008-0.008,0.018-0.014,0.025-0.022c1.809-1.916,7.905-9.096,10.429-21.058c0.512-2.426,0.627-4.754,0.342-6.919 c-0.86-6.575-4.945-10.051-11.813-10.051c-6.866,0-10.951,3.476-11.813,10.051c-0.284,2.166-0.169,4.494,0.343,6.919 C18.783,29.818,24.783,36.97,26.654,38.968z M17.924,11.314c0.733-5.592,3.949-8.311,9.831-8.311c5.883,0,9.098,2.719,9.83,8.311 c0.255,1.94,0.148,4.043-0.316,6.247C35,28.314,29.59,35.137,27.755,37.207c-1.837-2.072-7.246-8.898-9.514-19.646 C17.776,15.357,17.67,13.255,17.924,11.314z"/> <path d="M27.755,19.925c4.051,0,7.346-3.295,7.346-7.346s-3.295-7.346-7.346-7.346s-7.346,3.295-7.346,7.346 S23.704,19.925,27.755,19.925z M27.755,7.234c2.947,0,5.346,2.398,5.346,5.346s-2.398,5.346-5.346,5.346s-5.346-2.398-5.346-5.346 S24.808,7.234,27.755,7.234z"/> <path d="M31.428,37.17c-0.54,0.114-0.884,0.646-0.769,1.187c0.1,0.47,0.515,0.791,0.977,0.791c0.069,0,0.14-0.007,0.21-0.022 c0.586-0.124,1.221-0.229,1.886-0.313c0.548-0.067,0.938-0.567,0.869-1.115c-0.068-0.549-0.563-0.945-1.115-0.869 C32.763,36.918,32.07,37.033,31.428,37.17z"/> <path d="M36.599,37.576c0.022,0.537,0.466,0.957,0.998,0.957c0.015,0,0.029,0,0.044-0.001l2.001-0.083 c0.551-0.025,0.979-0.493,0.953-1.044c-0.025-0.553-0.539-0.984-1.044-0.954l-1.996,0.083 C37.003,36.557,36.575,37.023,36.599,37.576z"/> <path d="M22.433,42.177c-0.514,0.388-1.045,0.761-1.58,1.107c-0.463,0.301-0.595,0.92-0.294,1.384 c0.191,0.295,0.513,0.455,0.84,0.455c0.187,0,0.375-0.052,0.544-0.161c0.573-0.372,1.144-0.772,1.695-1.188 c0.44-0.333,0.528-0.96,0.196-1.401C23.501,41.936,22.876,41.844,22.433,42.177z"/> <path d="M44.72,35.583c-0.338,0.237-0.777,0.409-1.346,0.526c-0.541,0.111-0.889,0.641-0.777,1.182 c0.098,0.473,0.514,0.798,0.979,0.798c0.067,0,0.135-0.007,0.203-0.021c0.842-0.174,1.526-0.452,2.096-0.853l0.134-0.098 c0.44-0.334,0.527-0.961,0.194-1.401c-0.334-0.44-0.96-0.526-1.401-0.194L44.72,35.583z"/> <path d="M8.86,43.402c0.145-0.533-0.171-1.082-0.704-1.226c-0.529-0.149-1.082,0.169-1.226,0.704 c-0.126,0.464-0.201,0.938-0.225,1.405C6.7,44.4,6.697,44.516,6.697,44.638c0.001,0.196,0.01,0.392,0.029,0.587 c0.053,0.515,0.487,0.898,0.994,0.898c0.033,0,0.067-0.002,0.103-0.005c0.549-0.057,0.949-0.547,0.894-1.097 c-0.014-0.131-0.019-0.264-0.02-0.39c0-0.083,0.003-0.166,0.007-0.248C8.72,44.059,8.772,43.728,8.86,43.402z"/> <path d="M44.698,27.81c-0.794-0.106-1.604-0.041-2.386,0.181c-0.532,0.149-0.841,0.702-0.69,1.233 c0.124,0.441,0.525,0.729,0.961,0.729c0.091,0,0.182-0.012,0.272-0.038c0.52-0.146,1.055-0.192,1.575-0.122 c0.562,0.07,1.052-0.311,1.125-0.857C45.629,28.387,45.245,27.884,44.698,27.81z"/> <path d="M46.688,32.764c-0.163,0.527,0.133,1.088,0.66,1.25c0.099,0.031,0.197,0.045,0.295,0.045c0.428,0,0.823-0.275,0.955-0.705 c0.099-0.318,0.16-0.641,0.183-0.963c0.005-0.083,0.008-0.167,0.008-0.25c0-0.468-0.086-0.937-0.255-1.392 c-0.192-0.519-0.771-0.781-1.285-0.59c-0.519,0.192-0.782,0.768-0.59,1.285c0.086,0.232,0.13,0.467,0.13,0.696l-0.003,0.117 C46.774,32.423,46.742,32.589,46.688,32.764z"/> <path d="M17.481,45.164c-0.586,0.275-1.183,0.53-1.774,0.759c-0.515,0.198-0.771,0.777-0.572,1.293 c0.153,0.396,0.531,0.64,0.933,0.64c0.12,0,0.242-0.021,0.36-0.067c0.635-0.245,1.275-0.519,1.903-0.813 c0.5-0.234,0.715-0.83,0.48-1.33C18.578,45.145,17.984,44.928,17.481,45.164z"/> <path d="M10.201,41.001c0.161,0,0.325-0.039,0.478-0.122c0.288-0.157,0.595-0.255,0.911-0.289c0.135-0.016,0.273-0.016,0.406,0.002 c0.563,0.073,1.05-0.313,1.122-0.86c0.072-0.548-0.313-1.05-0.86-1.122c-0.298-0.039-0.601-0.041-0.891-0.008 c-0.574,0.063-1.128,0.239-1.646,0.521c-0.485,0.265-0.664,0.871-0.399,1.356C9.504,40.813,9.847,41.001,10.201,41.001z"/> <path d="M9.993,48.842c0.216,0.056,0.436,0.098,0.654,0.124c0.256,0.031,0.512,0.047,0.769,0.047c0.313,0,0.627-0.022,0.94-0.062 c0.548-0.069,0.937-0.569,0.867-1.117s-0.567-0.934-1.117-0.867c-0.404,0.052-0.812,0.064-1.216,0.015 c-0.132-0.017-0.264-0.042-0.394-0.075c-0.535-0.143-1.08,0.181-1.22,0.716C9.139,48.158,9.459,48.704,9.993,48.842z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Venue', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<ul>';

														foreach( $event_venues as $event_venue ) {

															if( !empty( $event_venue ) ) {

																$output .= '<li>';
																	$output .= '<a href="' . esc_url( get_the_permalink( $event_venue ) ) . '">' . get_the_title( $event_venue ) . '</a>';
																$output .= '</li>';

															}

														}

													$output .= '</ul>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $organizer_status == "on" ) {

									if( !empty( $organizers ) ) {

										$output .= '<li class="gt-organizers">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve"> <path d="M48.014,42.889l-9.553-4.776C37.56,37.662,37,36.756,37,35.748v-3.381c0.229-0.28,0.47-0.599,0.719-0.951 c1.239-1.75,2.232-3.698,2.954-5.799C42.084,24.97,43,23.575,43,22v-4c0-0.963-0.36-1.896-1-2.625v-5.319 c0.056-0.55,0.276-3.824-2.092-6.525C37.854,1.188,34.521,0,30,0s-7.854,1.188-9.908,3.53C17.724,6.231,17.944,9.506,18,10.056 v5.319c-0.64,0.729-1,1.662-1,2.625v4c0,1.217,0.553,2.352,1.497,3.109c0.916,3.627,2.833,6.36,3.503,7.237v3.309 c0,0.968-0.528,1.856-1.377,2.32l-8.921,4.866C8.801,44.424,7,47.458,7,50.762V54c0,4.746,15.045,6,23,6s23-1.254,23-6v-3.043 C53,47.519,51.089,44.427,48.014,42.889z M51,54c0,1.357-7.412,4-21,4S9,55.357,9,54v-3.238c0-2.571,1.402-4.934,3.659-6.164 l8.921-4.866C23.073,38.917,24,37.354,24,35.655v-4.019l-0.233-0.278c-0.024-0.029-2.475-2.994-3.41-7.065l-0.091-0.396l-0.341-0.22 C19.346,23.303,19,22.676,19,22v-4c0-0.561,0.238-1.084,0.67-1.475L20,16.228V10l-0.009-0.131c-0.003-0.027-0.343-2.799,1.605-5.021 C23.253,2.958,26.081,2,30,2c3.905,0,6.727,0.951,8.386,2.828c1.947,2.201,1.625,5.017,1.623,5.041L40,16.228l0.33,0.298 C40.762,16.916,41,17.439,41,18v4c0,0.873-0.572,1.637-1.422,1.899l-0.498,0.153l-0.16,0.495c-0.669,2.081-1.622,4.003-2.834,5.713 c-0.297,0.421-0.586,0.794-0.837,1.079L35,31.623v4.125c0,1.77,0.983,3.361,2.566,4.153l9.553,4.776 C49.513,45.874,51,48.28,51,50.957V54z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Organizer', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<ul>';

														foreach( $organizers as $organizer ) {

															if( !empty( $organizer ) ) {

																$output .= '<li>';
																	$output .= '<a href="' . esc_url( get_term_link( $organizer->term_id ) . '?post_type=event' ) . '">' . esc_attr( $organizer->name ) . '</a>';
																$output .= '</li>';

															}

														}

													$output .= '</ul>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $category_status == "on" ) {

									if( !empty( $categories ) ) {

										$output .= '<li class="gt-categories">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve"> <path d="M57.49,21.5H54v-6.268c0-1.507-1.226-2.732-2.732-2.732H26.515l-5-7H2.732C1.226,5.5,0,6.726,0,8.232v43.687l0.006,0 c-0.005,0.563,0.17,1.114,0.522,1.575C1.018,54.134,1.76,54.5,2.565,54.5h44.759c1.156,0,2.174-0.779,2.45-1.813L60,24.649v-0.177 C60,22.75,58.944,21.5,57.49,21.5z M2,8.232C2,7.828,2.329,7.5,2.732,7.5h17.753l5,7h25.782c0.404,0,0.732,0.328,0.732,0.732V21.5 H12.731c-0.144,0-0.287,0.012-0.426,0.036c-0.973,0.163-1.782,0.873-2.023,1.776L2,45.899V8.232z M47.869,52.083 c-0.066,0.245-0.291,0.417-0.545,0.417H2.565c-0.243,0-0.385-0.139-0.448-0.222c-0.063-0.082-0.16-0.256-0.123-0.408l10.191-27.953 c0.066-0.245,0.291-0.417,0.545-0.417H54h3.49c0.38,0,0.477,0.546,0.502,0.819L47.869,52.083z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Category', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<ul>';

														foreach( $categories as $category ) {

															if( !empty( $category ) ) {

																$output .= '<li><a href="' . esc_url( get_term_link( $category->term_id ) . '?post_type=event' ) . '">' . esc_attr( $category->name ) . '</a></li>';

															}

														}

													$output .= '</ul>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $address_status == "on" ) {

									if( !empty( $event_address ) ) {

										$output .= '<li class="gt-address">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve"> <path d="M44.18,20l9.668-15.47c0.193-0.309,0.203-0.697,0.027-1.015C53.698,3.197,53.363,3,53,3H8V1c0-0.553-0.447-1-1-1 S6,0.447,6,1v3v29v3v23c0,0.553,0.447,1,1,1s1-0.447,1-1V37h45c0.363,0,0.698-0.197,0.875-0.516 c0.176-0.317,0.166-0.706-0.027-1.015L44.18,20z M8,35v-2V5h43.195l-9.043,14.47c-0.203,0.324-0.203,0.736,0,1.061L51.195,35H8z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Address', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= esc_attr( $event_address );
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $phone_status == "on" ) {

									if( !empty( $event_phone ) ) {

										$output .= '<li class="gt-phone">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.076 512.076" xml:space="preserve"> <g transform="translate(-1 -1)"> <g> <g> <path d="M499.639,396.039l-103.646-69.12c-13.153-8.701-30.784-5.838-40.508,6.579l-30.191,38.818 c-3.88,5.116-10.933,6.6-16.546,3.482l-5.743-3.166c-19.038-10.377-42.726-23.296-90.453-71.04s-60.672-71.45-71.049-90.453 l-3.149-5.743c-3.161-5.612-1.705-12.695,3.413-16.606l38.792-30.182c12.412-9.725,15.279-27.351,6.588-40.508l-69.12-103.646 C109.12,1.056,91.25-2.966,77.461,5.323L34.12,31.358C20.502,39.364,10.511,52.33,6.242,67.539 c-15.607,56.866-3.866,155.008,140.706,299.597c115.004,114.995,200.619,145.92,259.465,145.92 c13.543,0.058,27.033-1.704,40.107-5.239c15.212-4.264,28.18-14.256,36.181-27.878l26.061-43.315 C517.063,422.832,513.043,404.951,499.639,396.039z M494.058,427.868l-26.001,43.341c-5.745,9.832-15.072,17.061-26.027,20.173 c-52.497,14.413-144.213,2.475-283.008-136.32S8.29,124.559,22.703,72.054c3.116-10.968,10.354-20.307,20.198-26.061 l43.341-26.001c5.983-3.6,13.739-1.855,17.604,3.959l37.547,56.371l31.514,47.266c3.774,5.707,2.534,13.356-2.85,17.579 l-38.801,30.182c-11.808,9.029-15.18,25.366-7.91,38.332l3.081,5.598c10.906,20.002,24.465,44.885,73.967,94.379 c49.502,49.493,74.377,63.053,94.37,73.958l5.606,3.089c12.965,7.269,29.303,3.898,38.332-7.91l30.182-38.801 c4.224-5.381,11.87-6.62,17.579-2.85l103.637,69.12C495.918,414.126,497.663,421.886,494.058,427.868z"/> <path d="M291.161,86.39c80.081,0.089,144.977,64.986,145.067,145.067c0,4.713,3.82,8.533,8.533,8.533s8.533-3.82,8.533-8.533 c-0.099-89.503-72.63-162.035-162.133-162.133c-4.713,0-8.533,3.82-8.533,8.533S286.448,86.39,291.161,86.39z"/> <path d="M291.161,137.59c51.816,0.061,93.806,42.051,93.867,93.867c0,4.713,3.821,8.533,8.533,8.533 c4.713,0,8.533-3.82,8.533-8.533c-0.071-61.238-49.696-110.863-110.933-110.933c-4.713,0-8.533,3.82-8.533,8.533 S286.448,137.59,291.161,137.59z"/> <path d="M291.161,188.79c23.552,0.028,42.638,19.114,42.667,42.667c0,4.713,3.821,8.533,8.533,8.533s8.533-3.82,8.533-8.533 c-0.038-32.974-26.759-59.696-59.733-59.733c-4.713,0-8.533,3.82-8.533,8.533S286.448,188.79,291.161,188.79z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Phone', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<a href="tel:' . esc_attr( $event_phone ) . '">' . esc_attr( $event_phone ) . '</a>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $email_status == "on" ) {

									if( !empty( $event_email ) ) {

										$output .= '<li class="gt-email">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <path d="M486.4,59.733H25.6c-14.138,0-25.6,11.461-25.6,25.6v341.333c0,14.138,11.461,25.6,25.6,25.6h460.8 c14.138,0,25.6-11.461,25.6-25.6V85.333C512,71.195,500.539,59.733,486.4,59.733z M494.933,426.667 c0,4.713-3.82,8.533-8.533,8.533H25.6c-4.713,0-8.533-3.82-8.533-8.533V85.333c0-4.713,3.82-8.533,8.533-8.533h460.8 c4.713,0,8.533,3.82,8.533,8.533V426.667z"/> <path d="M470.076,93.898c-2.255-0.197-4.496,0.51-6.229,1.966L266.982,261.239c-6.349,5.337-15.616,5.337-21.965,0L48.154,95.863 c-2.335-1.96-5.539-2.526-8.404-1.484c-2.865,1.042-4.957,3.534-5.487,6.537s0.582,6.06,2.917,8.02l196.864,165.367 c12.688,10.683,31.224,10.683,43.913,0L474.82,108.937c1.734-1.455,2.818-3.539,3.015-5.794c0.197-2.255-0.51-4.496-1.966-6.229 C474.415,95.179,472.331,94.095,470.076,93.898z"/> <path d="M164.124,273.13c-3.021-0.674-6.169,0.34-8.229,2.65l-119.467,128c-2.162,2.214-2.956,5.426-2.074,8.392 c0.882,2.967,3.301,5.223,6.321,5.897c3.021,0.674,6.169-0.34,8.229-2.65l119.467-128c2.162-2.214,2.956-5.426,2.074-8.392 C169.563,276.061,167.145,273.804,164.124,273.13z"/> <path d="M356.105,275.78c-2.059-2.31-5.208-3.324-8.229-2.65c-3.021,0.674-5.439,2.931-6.321,5.897 c-0.882,2.967-0.088,6.178,2.074,8.392l119.467,128c3.24,3.318,8.536,3.442,11.927,0.278c3.391-3.164,3.635-8.456,0.549-11.918 L356.105,275.78z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Email', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<a href="mailto:' . esc_attr( $event_email ) . '">' . esc_attr( $event_email ) . '</a>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $fax_status == "on" ) {

									if( !empty( $event_fax ) ) {

										$output .= '<li class="gt-fax">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <path d="M494.933,128H307.2c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h187.733v349.867H17.067V145.067h17.067 c4.713,0,8.533-3.82,8.533-8.533S38.846,128,34.133,128H17.067C7.641,128,0,135.641,0,145.067v349.867 C0,504.359,7.641,512,17.067,512h477.867c9.426,0,17.067-7.641,17.067-17.067V145.067C512,135.641,504.359,128,494.933,128z"/> <path d="M102.4,443.733h119.467c23.552-0.028,42.638-19.114,42.667-42.667v-358.4C264.505,19.114,245.419,0.028,221.867,0H102.4 C78.848,0.028,59.762,19.114,59.733,42.667v358.4C59.762,424.619,78.848,443.705,102.4,443.733z M76.8,42.667 c0-14.138,11.462-25.6,25.6-25.6h119.467c14.138,0,25.6,11.462,25.6,25.6v358.4c0,14.138-11.461,25.6-25.6,25.6H102.4 c-14.138,0-25.6-11.462-25.6-25.6V42.667z"/> <path d="M315.733,273.067H460.8c9.426,0,17.067-7.641,17.067-17.067v-68.267c0-9.426-7.641-17.067-17.067-17.067h-17.067 c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533H460.8V256H315.733v-68.267h85.333c4.713,0,8.533-3.82,8.533-8.533 s-3.82-8.533-8.533-8.533h-85.333c-9.426,0-17.067,7.641-17.067,17.067V256C298.667,265.426,306.308,273.067,315.733,273.067z"/> <path d="M307.2,315.733h25.6c4.713,0,8.533-3.82,8.533-8.533s-3.821-8.533-8.533-8.533h-25.6c-4.713,0-8.533,3.82-8.533,8.533 S302.487,315.733,307.2,315.733z"/> <path d="M469.333,298.667h-25.6c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h25.6c4.713,0,8.533-3.82,8.533-8.533 S474.046,298.667,469.333,298.667z"/> <path d="M401.067,298.667h-25.6c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h25.6c4.713,0,8.533-3.82,8.533-8.533 S405.78,298.667,401.067,298.667z"/> <path d="M307.2,358.4h25.6c4.713,0,8.533-3.82,8.533-8.533s-3.821-8.533-8.533-8.533h-25.6c-4.713,0-8.533,3.82-8.533,8.533 S302.487,358.4,307.2,358.4z"/> <path d="M469.333,341.333h-25.6c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h25.6c4.713,0,8.533-3.82,8.533-8.533 S474.046,341.333,469.333,341.333z"/> <path d="M401.067,341.333h-25.6c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h25.6c4.713,0,8.533-3.82,8.533-8.533 S405.78,341.333,401.067,341.333z"/> <path d="M307.2,401.067h25.6c4.713,0,8.533-3.821,8.533-8.533c0-4.713-3.821-8.533-8.533-8.533h-25.6 c-4.713,0-8.533,3.821-8.533,8.533C298.667,397.246,302.487,401.067,307.2,401.067z"/> <path d="M469.333,384h-25.6c-4.713,0-8.533,3.821-8.533,8.533c0,4.713,3.82,8.533,8.533,8.533h25.6 c4.713,0,8.533-3.821,8.533-8.533C477.867,387.821,474.046,384,469.333,384z"/> <path d="M401.067,384h-25.6c-4.713,0-8.533,3.821-8.533,8.533c0,4.713,3.82,8.533,8.533,8.533h25.6 c4.713,0,8.533-3.821,8.533-8.533C409.6,387.821,405.78,384,401.067,384z"/> <path d="M307.2,443.733h25.6c4.713,0,8.533-3.82,8.533-8.533s-3.821-8.533-8.533-8.533h-25.6c-4.713,0-8.533,3.82-8.533,8.533 S302.487,443.733,307.2,443.733z"/> <path d="M469.333,426.667h-25.6c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h25.6c4.713,0,8.533-3.82,8.533-8.533 S474.046,426.667,469.333,426.667z"/> <path d="M401.067,426.667h-25.6c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h25.6c4.713,0,8.533-3.82,8.533-8.533 S405.78,426.667,401.067,426.667z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Fax', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';
													$output .= '<a href="fax:' . esc_attr( $event_fax ) . '">' . esc_attr( $event_fax ) . '</a>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $remaining_tickets_status == "on" ) {

									if( !empty( $event_remaining_tickets ) ) {

										if( $event_remaining_tickets == "woocommerce-product" or $event_remaining_tickets == "manual-quantity" ) {

											$output .= '<li class="gt-remaining-tickets">';
												$output .= '<div class="gt-icon">';
													$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 511.998 511.998" xml:space="preserve"> <g> <g> <g> <path d="M509.5,150.623c3.331-3.332,3.331-8.734,0-12.066L373.393,2.451c-3.385-3.201-8.681-3.201-12.066,0 c-9.869,9.908-23.289,15.46-37.274,15.42c-13.985,0.042-27.406-5.51-37.274-15.42c-3.385-3.201-8.681-3.201-12.066,0L2.5,274.664 c-3.331,3.332-3.331,8.734,0,12.066c9.91,9.868,15.462,23.289,15.42,37.274c0.04,13.984-5.511,27.405-15.42,37.274 c-1.6,1.6-2.5,3.77-2.5,6.033c0,2.263,0.9,4.433,2.5,6.033L138.607,509.45c3.385,3.201,8.681,3.201,12.066,0 c20.587-20.582,53.96-20.582,74.547,0c3.332,3.331,8.734,3.331,12.066,0L509.5,237.237c3.331-3.332,3.331-8.734,0-12.066 C488.917,204.583,488.917,171.21,509.5,150.623z M491.759,230.845L230.895,491.709c-25.246-19.683-60.642-19.683-85.888,0 L20.241,366.943c9.602-12.249,14.796-27.376,14.746-42.94c0.051-15.566-5.143-30.696-14.746-42.948L281.105,20.191 c12.252,9.602,27.382,14.797,42.948,14.746c15.566,0.046,30.693-5.155,42.94-14.763l124.766,124.783 C472.076,170.204,472.076,205.599,491.759,230.845z"/> <path d="M466.449,152.663c1.404-3.216,0.697-6.964-1.784-9.446l-95.932-95.932c-2.489-2.495-6.255-3.204-9.481-1.783 c-22.469,9.792-47.999,9.792-70.468,0c-3.218-1.408-6.971-0.701-9.455,1.783L47.334,279.315 c-2.484,2.484-3.192,6.237-1.783,9.455c9.788,22.47,9.788,47.999,0,70.468c-1.404,3.216-0.697,6.964,1.783,9.446l95.932,95.932 c2.483,2.48,6.23,3.188,9.446,1.784c22.47-9.788,47.999-9.788,70.468,0c3.218,1.408,6.971,0.701,9.455-1.784l232.03-232.03 c2.484-2.484,3.192-6.237,1.784-9.455C456.661,200.661,456.661,175.133,466.449,152.663z M448.606,224.505L280.747,392.364 c-2.143-2.218-5.315-3.108-8.299-2.327c-2.983,0.781-5.313,3.111-6.094,6.094c-0.781,2.984,0.109,6.156,2.327,8.299 l-44.126,44.126c-23.622-8.746-49.594-8.746-73.216,0l-87.945-87.945c8.746-23.622,8.746-49.594,0-73.216l44.126-44.126 c2.142,2.218,5.315,3.108,8.299,2.327s5.313-3.111,6.094-6.094s-0.109-6.156-2.327-8.299L287.445,63.344 c23.622,8.742,49.594,8.742,73.216,0l87.945,87.945C439.86,174.911,439.86,200.883,448.606,224.505z"/> <path d="M246.212,357.83c-3.348-3.234-8.671-3.188-11.962,0.104c-3.292,3.292-3.338,8.614-0.104,11.962l11.511,11.494 c3.375,3.017,8.52,2.873,11.721-0.328s3.345-8.346,0.328-11.721L246.212,357.83z"/> <path d="M211.678,323.295c-3.348-3.234-8.671-3.188-11.962,0.104c-3.292,3.292-3.338,8.614-0.104,11.962l11.511,11.511 c3.348,3.234,8.671,3.188,11.962-0.104c3.292-3.292,3.338-8.614,0.104-11.962L211.678,323.295z"/> <path d="M142.054,277.813c2.157,2.157,5.301,2.999,8.247,2.21c2.946-0.79,5.248-3.091,6.037-6.037s-0.053-6.09-2.21-8.247 l-11.52-11.494c-2.108-2.358-5.347-3.357-8.416-2.595c-3.07,0.761-5.466,3.158-6.228,6.228c-0.761,3.07,0.237,6.309,2.595,8.416 L142.054,277.813z"/> <path d="M177.143,288.761c-3.348-3.234-8.671-3.188-11.962,0.104c-3.292,3.292-3.338,8.614-0.104,11.962l11.511,11.511 c3.348,3.234,8.671,3.188,11.962-0.104c3.292-3.292,3.338-8.614,0.104-11.962L177.143,288.761z"/> <path d="M407.134,126.269l-33.28-0.41L353.92,98.084c-1.91-2.649-5.165-3.975-8.383-3.416c-3.218,0.559-5.834,2.906-6.738,6.044 l-8.96,31.087l-31.087,8.951c-3.141,0.904-5.49,3.524-6.048,6.744c-0.558,3.221,0.774,6.477,3.428,8.385l-0.026,0.017 l27.742,19.968l0.41,33.28c0.038,3.199,1.862,6.107,4.724,7.535c2.862,1.428,6.283,1.134,8.861-0.759l25.899-19.038 l31.625,11.426c3.113,1.125,6.596,0.347,8.935-1.994s3.114-5.825,1.987-8.937l-11.418-31.625l19.029-25.899 c1.893-2.577,2.187-5.995,0.761-8.857C413.237,128.135,410.331,126.31,407.134,126.269z M377.276,167.255l6.827,18.773 l-18.773-6.827c-2.677-0.966-5.66-0.534-7.953,1.152l-16.213,11.887l-0.256-20.975c-0.032-2.71-1.35-5.244-3.55-6.827 l-16.981-12.22l18.697-5.308c2.82-0.813,5.024-3.017,5.837-5.837l5.402-18.773l12.211,16.981c1.583,2.2,4.117,3.518,6.827,3.55 l20.975,0.256l-11.896,16.213C376.741,161.595,376.309,164.578,377.276,167.255z"/> <path d="M307.251,226.152l-33.28-0.41l-19.968-27.75c-1.917-2.618-5.154-3.923-8.351-3.365c-3.197,0.558-5.801,2.88-6.719,5.993 l-8.96,31.087l-31.147,8.951c-3.133,0.919-5.466,3.545-6.011,6.764s0.795,6.467,3.451,8.365l27.742,19.959l0.41,33.28 c0.041,3.197,1.866,6.103,4.728,7.528s6.281,1.132,8.857-0.761l25.899-19.029l31.625,11.418c3.112,1.127,6.596,0.353,8.937-1.987 s3.119-5.822,1.994-8.936l-11.426-31.625l18.995-25.899c1.894-2.578,2.187-5.998,0.759-8.861S310.45,226.19,307.251,226.152z M277.436,267.155l6.827,18.773l-18.773-6.827c-2.676-0.969-5.659-0.54-7.953,1.143l-16.213,11.947l-0.256-20.983 c-0.032-2.71-1.35-5.244-3.55-6.827l-16.981-12.211l18.697-5.367c2.82-0.813,5.024-3.017,5.837-5.837l5.402-18.773l12.211,16.981 c1.583,2.2,4.116,3.518,6.827,3.55l20.975,0.256l-11.895,16.213C276.898,261.488,276.466,264.475,277.436,267.155z"/> <path d="M157.906,335.185c-15.326-6.339-32.995-0.969-42.202,12.825c-9.207,13.794-7.389,32.171,4.343,43.893 c6.517,6.53,15.368,10.191,24.593,10.172c16.585-0.01,30.853-11.734,34.079-28.002 C181.946,357.805,173.232,341.524,157.906,335.185z M157.166,379.837c-6.918,6.918-18.134,6.918-25.053,0.001 c-3.339-3.313-5.218-7.823-5.218-12.527c0-4.704,1.878-9.214,5.218-12.527c6.918-6.918,18.135-6.918,25.053,0.001 S164.084,372.919,157.166,379.837z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
												$output .= '</div>';
												$output .= '<div class="gt-content">';
													$output .= '<div class="gt-title">' . esc_html__( 'Remaining Tickets', 'eventchamp' ) . '</div>';
													$output .= '<div class="gt-inner">';

														if( $event_remaining_tickets == "manual-quantity" and !empty( $event_remaining_tickets_quantity ) ) {

															$output .= esc_attr( $event_remaining_tickets_quantity );
															$output .= ' ' . esc_html__( 'Tickets' , 'eventchamp' );

														}

														if( $event_remaining_tickets == "woocommerce-product" and !empty( $event_remaining_tickets_woocommerce ) ) {

															if( function_exists( 'wc_get_product' ) ) {

																$product_id = wc_get_product( $event_remaining_tickets_woocommerce );

																if( !empty( $product_id ) ) {

																	$output .= $product_id->get_stock_quantity();
																	$output .= ' ' . esc_html__( 'Tickets' , 'eventchamp' );

																}

															}

														}

													$output .= '</div>';
												$output .= '</div>';
											$output .= '</li>';

										}

									}

								}

								if( $event_attendees !== "hide" ) {

									if( !empty( $event_attendees_count ) or !empty( $event_attendees_woocommerce ) ) {

										$output .= '<li class="gt-attendees">';
											$output .= '<div class="gt-icon">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <path d="M403.645,125.044c-17.416-8.708-50.07-8.808-51.451-8.808c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5 c8.426,0,32.889,1.298,44.743,7.224c1.077,0.539,2.221,0.793,3.348,0.793c2.751,0,5.4-1.52,6.714-4.147 C408.852,131.401,407.35,126.896,403.645,125.044z"/> </g> </g> <g> <g> <path d="M504.5,348.704h-45.3c2.979-4.814,4.703-10.483,4.703-16.548v-70.038c0-14.011-9.41-26.485-22.882-30.334l-27.045-7.727 c-3.644-1.041-6.188-4.415-6.187-8.205l0.001-6.256c2.519-1.745,4.921-3.698,7.167-5.878 c10.886-10.564,16.881-24.735,16.881-39.901v-14.262l2.993-5.986c3.287-6.572,5.023-13.931,5.023-21.279V83.655 c0-4.142-3.358-7.5-7.5-7.5h-72.146c-26.236,0-47.581,21.345-47.581,47.581v0.447c0,6.109,1.444,12.228,4.177,17.694l3.839,7.678 V161.8c0,19.406,9.563,36.819,24.048,47.298v6.755c0,3.789-2.545,7.163-6.188,8.204l-27.043,7.727 c-13.472,3.849-22.881,16.324-22.881,30.335v6.424h-0.516c-8.556,0-15.516,6.96-15.516,15.516v64.129 c0,0.174,0.02,0.343,0.026,0.516h-37.826c2.979-4.814,4.703-10.483,4.703-16.548v-70.038c0-14.011-9.41-26.485-22.882-30.334 l-27.045-7.727c-0.293-0.083-0.57-0.198-0.849-0.311c12.832-2.501,23.292-5.777,30.002-8.175c3.903-1.395,7.028-4.23,8.797-7.986 c1.753-3.721,1.953-7.889,0.562-11.737c-6.611-18.28-11.597-48.876-12.654-63.936c-2.552-36.358-29.891-63.775-63.591-63.774 c-33.702,0-61.042,27.417-63.594,63.774c-1.058,15.058-6.043,45.654-12.655,63.936c-1.391,3.847-1.191,8.015,0.562,11.736 c1.77,3.755,4.893,6.592,8.796,7.986c6.71,2.398,17.172,5.674,30.006,8.176c-0.279,0.112-0.559,0.225-0.853,0.309l-27.043,7.727 c-13.472,3.849-22.881,16.323-22.881,30.334v70.038c0,6.065,1.725,11.734,4.703,16.548H7.5c-4.142,0-7.5,3.358-7.5,7.5 c0,4.142,3.358,7.5,7.5,7.5h8.532v72.661c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-40.597h65.161v40.597 c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-24.564h81.194v24.564c0,4.142,3.358,7.5,7.5,7.5 c4.142,0,7.5-3.358,7.5-7.5v-40.597h273.581v40.597c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-72.661h8.532 c4.142,0,7.5-3.358,7.5-7.5C512,352.059,508.642,348.704,504.5,348.704z M335.645,161.8v-14.016c0-1.165-0.271-2.313-0.792-3.354 l-4.63-9.262c-1.697-3.394-2.594-7.192-2.594-10.986v-0.447c0-17.965,14.616-32.581,32.581-32.581h64.646v31.135 c0,5.032-1.189,10.07-3.439,14.571l-3.785,7.569c-0.521,1.042-0.792,2.189-0.792,3.354v16.032 c0,11.075-4.378,21.422-12.328,29.137c-7.946,7.711-18.44,11.773-29.523,11.441C353.294,203.744,335.645,184.635,335.645,161.8z M394.096,223.533l-6.153,6.153c-3.125,3.125-7.281,4.847-11.702,4.847c-4.42,0-8.576-1.722-11.701-4.847l-6.154-6.154 c0.75-2.152,1.178-4.433,1.27-6.778c4.73,1.556,9.719,2.479,14.882,2.634c0.577,0.018,1.151,0.026,1.726,0.026 c5.704,0,11.272-0.864,16.57-2.512C392.936,219.195,393.362,221.426,394.096,223.533z M303.58,262.118L303.58,262.118 c0.001-7.35,4.937-13.893,12.003-15.912l27.044-7.727c2.347-0.671,4.519-1.704,6.485-3.009l4.822,4.822 c5.958,5.959,13.881,9.241,22.308,9.241s16.35-3.282,22.308-9.241l4.821-4.821c1.965,1.305,4.138,2.338,6.485,3.008l27.044,7.727 c7.067,2.019,12.003,8.562,12.003,15.912v70.038c0,9.125-7.423,16.548-16.548,16.548h-32.607c0.006-0.173,0.026-0.342,0.026-0.516 V331.64h24.564c4.142,0,7.5-3.358,7.5-7.5v-48.097c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v40.597h-17.064v-32.581 c0-8.556-6.96-15.516-15.516-15.516H303.58V262.118z M287.548,284.059c0-0.285,0.231-0.516,0.516-0.516h96.194 c0.285,0,0.516,0.231,0.516,0.516v64.129c0,0.285-0.231,0.516-0.516,0.516h-96.194c-0.285,0-0.516-0.231-0.516-0.516V284.059z M89.948,201.447c-0.154-0.055-0.234-0.168-0.275-0.254c-0.063-0.135-0.036-0.209-0.024-0.242 c7.075-19.564,12.393-52.055,13.511-67.986c0.96-13.67,6.354-26.266,15.187-35.465c9.021-9.395,20.586-14.36,33.445-14.36 c12.856,0,24.419,4.965,33.44,14.36c8.833,9.199,14.227,21.794,15.187,35.465c1.119,15.933,6.437,48.424,13.511,67.986 c0.012,0.032,0.039,0.107-0.025,0.242c-0.04,0.085-0.121,0.199-0.274,0.254c-11.479,4.102-34.777,10.982-61.843,10.982 C124.721,212.429,101.426,205.548,89.948,201.447z M96.193,380.768H31.032v-17.064h65.161V380.768z M111.193,396.8V292.075 c0-4.705,3.828-8.532,8.532-8.532h64.129c4.705,0,8.532,3.828,8.532,8.532V396.8H111.193z M183.855,268.543h-64.129 c-12.976,0-23.532,10.557-23.532,23.532v56.629h-0.516c-9.125,0-16.548-7.423-16.548-16.548v-70.038 c0-7.35,4.936-13.893,12.002-15.912l27.043-7.727c6.464-1.847,11.675-6.254,14.574-12.059c6.072,0.632,12.449,1.009,19.04,1.009 c6.603,0,12.991-0.379,19.074-1.013c2.915,5.774,8.14,10.234,14.543,12.064l27.044,7.727c7.067,2.019,12.003,8.562,12.003,15.912 v70.038c0,9.125-7.423,16.548-16.548,16.548h-0.516v-56.629C207.387,279.099,196.831,268.543,183.855,268.543z M207.387,380.768 v-17.064h0.516h273.064v17.064H207.387z"/> </g> </g> <g> <g> <circle cx="336" cy="316.002" r="7.5"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
											$output .= '</div>';
											$output .= '<div class="gt-content">';
												$output .= '<div class="gt-title">' . esc_html__( 'Attendees', 'eventchamp' ) . '</div>';
												$output .= '<div class="gt-inner">';

													if( $event_attendees == "manual" and !empty( $event_attendees_count ) ) {

														if( $event_attendees_count == "1" ) {

															$output .= esc_attr( $event_attendees_count ) . ' ' . esc_html__( 'Attendee', 'eventchamp' );

														} elseif( $event_attendees_count > "1" ) {

															$output .= esc_attr( $event_attendees_count ) . ' ' . esc_html__( 'Attendees', 'eventchamp' );

														}

													} elseif( $event_attendees == "woocommerce-product" and !empty( $event_attendees_woocommerce ) ) {

														$woocommerce_product_sales = get_post_meta( esc_attr( $event_attendees_woocommerce ), 'total_sales', true );

														if( $woocommerce_product_sales == "1" ) {

															$output .= esc_attr( $woocommerce_product_sales ) . ' ' . esc_html__( 'Attendee', 'eventchamp' );

														} elseif( $woocommerce_product_sales > "1" ) {

															$output .= esc_attr( $woocommerce_product_sales ) . ' ' . esc_html__( 'Attendees', 'eventchamp' );

														}

													}

												$output .= '</div>';
											$output .= '</div>';
										$output .= '</li>';

									}

								}

								if( $social_status == "on" ) {

									if( !empty( $social_links ) and !empty( eventchamp_social_media_sites( $custom_links = $social_links ) ) ) {

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

								if( $extra_status == "on" ) {

									if( $extra_details_position == "after-current" ) {

										if( !empty( $extra_details ) ) {

											foreach( $extra_details as $detail ) {

												if( !empty( $detail ) ) {

													$output .= '<li class="gt-extra-detail">';

														if( $detail["icon-type"] == "font-icon" and !empty( $detail["font-icon"] ) ) {

															$output .= '<div class="gt-icon gt-font-icon">';
																$output .= '<i class="' . esc_attr( $detail["font-icon"] ) . '"></i>';
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

						if( !empty( eventchamp_add_to_calendar_button( $event_id = get_the_ID() ) ) ) {

							$output .= eventchamp_add_to_calendar_button( $event_id = get_the_ID(), $style = "style-2" );

						}

					$output .= '</div>';
				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Event Sidebar Buttons Box
*
======*/
if( !function_exists( 'eventchamp_event_sidebar_buttons_box' ) ) {

	function eventchamp_event_sidebar_buttons_box( $id = "" ) {

		$output = "";
		$sidebar_buttons = ot_get_option( 'event-sidebar-buttons' );
		$buttons = get_post_meta( esc_attr( $id ), 'event_extra_buttons', true );

		if( !empty( $sidebar_buttons ) or !empty( $buttons ) ) {

			$output .= '<div class="gt-widget gt-transparent-widget gt-detail-widget">';
				$output .= '<div class="gt-widget-content">';
					$output .= '<div class="gt-event-buttons">';
						$output .= '<ul>';

							if( !empty( $buttons ) ) {

								foreach( $buttons as $button ) {

									if( !empty( $button ) ) {

										if( !empty( $button["title"] ) and !empty( $button["event_extra_buttons_link"] ) ) {

											if( empty( $button["event_extra_buttons_target"] ) ) {

												$button["event_extra_buttons_target"] = "_self";

											}

											$output .= '<li>';
												$output .= '<a href="' . esc_url( $button["event_extra_buttons_link"] ) . '" target="' . esc_attr( $button["event_extra_buttons_target"] ) . '">' . esc_attr( $button["title"] ) . '</a>';
											$output .= '</li>';

										}

									}

								}

							}

							if( !empty( $sidebar_buttons ) ) {

								foreach( $sidebar_buttons as $sidebar_button ) {

									if( !empty( $sidebar_button ) ) {

										if( !empty( $sidebar_button["title"] ) and !empty( $sidebar_button["event_extra_buttons_link"] ) ) {

											if( empty( $sidebar_button["event_extra_buttons_target"] ) ) {

												$sidebar_button["event_extra_buttons_target"] = "_self";

											}

											$output .= '<li>';
												$output .= '<a href="' . esc_url( $sidebar_button["event_extra_buttons_link"] ) . '" target="' . esc_attr( $sidebar_button["event_extra_buttons_target"] ) . '">' . esc_attr( $sidebar_button["title"] ) . '</a>';
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
* Event Sponsors Box
*
======*/
if( !function_exists( 'eventchamp_event_sponsors_box' ) ) {

	function eventchamp_event_sponsors_box( $id = "" ) {

		if( function_exists( 'eventchamp_event_sponsors' ) ) {

			$output = "";

			if( !empty( $id ) ) {

				$event_sponsors = get_post_meta( esc_attr( $id ), 'event_sponsors', true );
				$sponsors_style = get_post_meta( esc_attr( $id ), 'event-sponsors-style', true );

				if( $sponsors_style == "default" or empty( $sponsors_style ) ) {

					$sponsors_style = ot_get_option( 'event-sponsors-style', 'style-1' );

				}

				$sponsors_column_space = get_post_meta( esc_attr( $id ), 'event-sponsors-column-space', true );

				if( $sponsors_column_space == "default" or empty( $sponsors_column_space ) ) {

					$sponsors_column_space = ot_get_option( 'event-sponsors-column-space', '10' );

				}

				$sponsors_column = get_post_meta( esc_attr( $id ), 'event-sponsors-column', true );

				if( $sponsors_column == "default" or empty( $sponsors_column ) ) {

					$sponsors_column = ot_get_option( 'event-sponsors-column', '2' );

				}

				$sponsors_status = get_post_meta( esc_attr( $id ), 'event-sponsors-status', true );

				if( $sponsors_status == "default" or empty( $sponsors_status ) ) {

					$sponsors_status = ot_get_option( 'event-sponsors-status', 'true' );

				}

				if( $sponsors_status == "true" ) {

					if( !empty( $event_sponsors ) ) {

						$output .= '<div class="gt-widget gt-detail-widget">';
							$output .= '<div class="gt-widget-title">';
								$output .= '<span>' . esc_html__( 'Sponsors' , 'eventchamp' ) . '</span>';
							$output .= '</div>';
							$output .= '<div class="gt-widget-content">';
								$output .= eventchamp_event_sponsors( $id = $id, $type = 'type-1', $column = $sponsors_column, $style = $sponsors_style, $padding = $sponsors_column_space );
							$output .= '</div>';
						$output .= '</div>';

					}

				}

			}

			return $output;

		}

	}

}



/*======
*
* Event Sidebar Boxes
*
======*/
if( !function_exists( 'eventchamp_event_sidebar_boxes' ) ) {

	function eventchamp_event_sidebar_boxes( $id = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$boxes = get_post_meta( esc_attr( $id ), 'event-sidebar-boxes', true );

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
* Event Sponsors
*
======*/
if( !function_exists( 'eventchamp_event_sponsors' ) ) {

	function eventchamp_event_sponsors( $id = "", $type = "type-1", $column = "1", $style = "style-2", $padding = "10" ) {

		$output = '';

		if( !empty( $id ) ) {

			$event_sponsors = get_post_meta( esc_attr( $id ), 'event_sponsors', true );

			if( !empty( $event_sponsors ) ) {

				$output .= '<div class="gt-event-sponsors gt-type-1 gt-' . esc_attr( $style ) . '">';
					$output .= '<div class="gt-columns gt-column-space-' . esc_attr( $padding ) . ' gt-column-' . esc_attr( $column ) . '">';

						foreach( $event_sponsors as $sponsor ) {

							if( !empty( $sponsor ) ) {

								if( empty( $sponsor["target"] ) ) {

									$sponsor["target"] = "_self";

								}

								if( empty( $sponsor["title"] ) ) {

									$sponsor["title"] = esc_html__( 'Sponsor', 'eventchamp' );

								}

								if( empty( $sponsor["grayscale"] ) ) {

									$sponsor["grayscale"] = esc_html__( 'false', 'eventchamp' );

								}

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';

										if( !empty( $sponsor["event_sponsor_logo"] ) ) {

											$output .= '<div class="gt-logo">';

												if( !empty( $sponsor["event_sponsor_link"] ) ) {

													$output .= '<a href="' . esc_url( $sponsor["event_sponsor_link"] ) . '" target="' . esc_attr( $sponsor["target"] ) . '">';

												}

													$output .= wp_get_attachment_image( eventchamp_attachment_id( $sponsor["event_sponsor_logo"] ), 'eventchamp-event-sponsor-big', true, array( "class" => 'gt-grayscale-' . esc_attr( $sponsor["grayscale"] ) ) );

												if( !empty( $sponsor["event_sponsor_link"] ) ) {

													$output .= '</a>';

												}

												if( !empty( $sponsor["text"] ) ) {

													$output .= '<span>' . esc_attr( $sponsor["text"] ) . '</span>';

												}

											$output .= '</div>';

										}

									$output .= '</div>';
								$output .= '</div>';

							}

						}

					$output .= '</div>';
				$output .= '</div>';

			}

		}

		return $output;

	}

}



/*======
*
* Event FAQ
*
======*/
if( !function_exists( 'eventchamp_event_faq' ) ) {

	function eventchamp_event_faq( $post_id = "", $first_open = "false" ) {

		$output = "";

		if( !empty( $post_id ) ) {

			$event_faq = get_post_meta( esc_attr( $post_id ), 'event_faq', true );
			$i = 0;

			if( !empty( $event_faq ) ) {

				$output .= '<div class="gt-dropdown">';
					$output .= '<div class="gt-panel-group" id="faq-accardion" role="tablist" aria-multiselectable="true">';

						foreach( $event_faq as $faq ) {

							if( !empty( $faq ) ) {

								$i++;
								$faq_rand_id = rand( 0, 999999 );

								if( !empty( $faq["title"] ) or !empty( $faq_date ) or !empty( $faq_time ) ) {

									$output .= '<div class="gt-panel">';

										if( !empty( $faq["title"] ) ) {

											$output .= '<div class="gt-panel-heading" role="tab" id="#faq-heading-' . esc_attr( $faq_rand_id ) . '">';
												$output .= '<a role="button" data-toggle="collapse" data-parent="#faq-accardion" href="#faq-collapse-' . esc_attr( $faq_rand_id ) . '" aria-expanded="true" aria-controls="faq-collapse-' . esc_attr( $faq_rand_id ) . '">';
														$output .= esc_attr( $faq["title"] );
													$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
												$output .= '</a>';
											$output .= '</div>';

										}

										if( !empty( $faq["event_faq_description"] ) or !empty( $faq_speakers ) ) {

											if( $i == "1" and $first_open == "true" ) {

												$output .= '<div id="faq-collapse-' . esc_attr( $faq_rand_id ) . '" class="gt-panel-collapse collapse show" role="tabpanel" aria-labelledby="faq-heading-' . esc_attr( $faq_rand_id ) . '">';

											} else {

												if( $faq["collapse"] == "on" ) {

													$output .= '<div id="faq-collapse-' . esc_attr( $faq_rand_id ) . '" class="gt-panel-collapse collapse show" role="tabpanel" aria-labelledby="faq-heading-' . esc_attr( $faq_rand_id ) . '">';

												} else {

													$output .= '<div id="faq-collapse-' . esc_attr( $faq_rand_id ) . '" class="gt-panel-collapse collapse" role="tabpanel" aria-labelledby="faq-heading-' . esc_attr( $faq_rand_id ) . '">';

												}

											}

												$output .= '<div class="gt-panel-body">';

													if( !empty( $faq["event_faq_description"] ) ) {

														$output .= do_shortcode( wpautop( $faq["event_faq_description"] ) );

													}

												$output .= '</div>';
											$output .= '</div>';

										}

									$output .= '</div>';

								}

							}

						}

					$output .= '</div>';
				$output .= '</div>';

			}

		}

		return $output;
	}

}



/*======
*
* Event Schedule
*
======*/
if( !function_exists( 'eventchamp_schedule' ) ) {

	function eventchamp_schedule( $post_id = "", $first_open = "false", $all_open = "false", $extra_style = "", $extra_all_open = "" ) {

		$output = "";

		if( !empty( $post_id ) ) {

			$schedule_collapsed = ot_get_option( 'event-schedule-collapsed', 'off' );

			if( $schedule_collapsed == "on" ) {

				$all_open = "true";

			}

			$event_schedule = get_post_meta( esc_attr( $post_id ), 'event_schedule', true );

			$schedule_style = get_post_meta( esc_attr( $post_id ), 'event-schedule-style', true );

			if( $schedule_style == "default" or empty( $schedule_style ) ) {

				$schedule_style = ot_get_option( 'event-schedule-style', 'style-1' );

			}

			if( !empty( $extra_style ) ) {

				$schedule_style = esc_attr( $extra_style );

			}

			if( !empty( $extra_all_open ) ) {

				$all_open = esc_attr( $extra_all_open );

			}

			$groups = array();

			$grouped_schedule = get_post_meta( esc_attr( $post_id ), 'event-grouped-schedule', true );

			if( $grouped_schedule == "default" or empty( $grouped_schedule ) ) {

				$grouped_schedule = ot_get_option( 'event-grouped-schedule', 'true' );

			}

			$schedule_rand_id = rand( 0, 999999 );

			if( !empty( $event_schedule ) ) {

				if( $schedule_style == "style-1" or $schedule_style == "style-2" or $schedule_style == "style-3" ) {

					$output .= '<div class="gt-event-schedule gt-' . esc_attr( $schedule_style ) . '">';

						if( $grouped_schedule == "true" ) {

							foreach( $event_schedule as $item ) {

								$groups[] = $item["group-title"];

							}

							if( !empty( $groups ) ) {

								$groups = array_unique( $groups );

								if( !empty( $groups ) ) {

									$i = 0;
									$tab_order_id = 0;

									$output .= '<ul class="gt-schedule-tabs nav" role="tablist">';

										foreach( $groups as $group ) {

											if( !empty( $group ) ) {

												$i++;
												$tab_order_id++;

												$output .= '<li>';

													if( $i == "1" ) {

														$output .= '<a data-toggle="tab" class="active show" href="#gt-event-schedule-' . esc_attr( $tab_order_id ) . '" role="tab" aria-controls="gt-event-schedule-' . esc_attr( $tab_order_id ) . '" aria-selected="true">';

													} else {

														$output .= '<a data-toggle="tab" href="#gt-event-schedule-' . esc_attr( $tab_order_id ) . '" role="tab" aria-controls="gt-event-schedule-' . esc_attr( $tab_order_id ) . '" aria-selected="true">';

													}

														$output .= esc_attr( $group );
													$output .= '</a>';
												$output .= '</li>';

											}

										}

									$output .= '</ul>';

									$i = 0;
									$tab_order_id = 0;

									$output .= '<div class="gt-dropdown">';
										$output .= '<div class="tab-content">';

											foreach( $groups as $group ) {

												$i++;
												$tab_order_id++;

												if( !empty( $group ) ) {

													if( $i == "1" ) {

														$output .= '<div class="tab-pane fade active show" id="gt-event-schedule-' . esc_attr( $tab_order_id ) . '" role="tabpanel" aria-labelledby="nav-gt-event-schedule-' . esc_attr( $tab_order_id ) . '-tab">';

													} else {

														$output .= '<div class="tab-pane fade" id="gt-event-schedule-' . esc_attr( $tab_order_id ) . '" role="tabpanel" aria-labelledby="nav-gt-event-schedule-' . esc_attr( $tab_order_id ) . '-tab">';

													}

														$output .= '<div class="gt-panel-group" id="event-schedule-accardion-' . esc_attr( $schedule_rand_id ) . '" role="tablist" aria-multiselectable="true">';
															$i_inner = 0;

															foreach( $event_schedule as $item ) {

																$i_inner++;

																if( !empty( $item ) ) {

																	if( $item["group-title"] == $group ) {

																		$item_rand_id = rand( 0, 999999 );
																		$output .= '<div class="gt-panel">';

																			if( !empty( $item["title"] ) ) {

																				$output .= '<div class="gt-panel-heading" role="tab" id="event-schedule-heading-' . esc_attr( $item_rand_id ) . '">';
																					$output .= '<a role="button" data-toggle="collapse" data-parent="#event-schedule-accardion-' . esc_attr( $schedule_rand_id ) . '" href="#event-schedule-collapse-' . esc_attr( $item_rand_id ) . '" aria-expanded="true" aria-controls="event-schedule-collapse-' . esc_attr( $item_rand_id ) . '">';

																						if( !empty( $item["event_schedule_date"] ) or !empty( $item["event_schedule_time"] ) or !empty( $item["title"] ) ) {

																							$output .= '<div class="gt-inner">';

																								if( !empty( $item["event_schedule_date"] ) ) {

																									$output .= '<div class="gt-date">';
																										$output .= esc_attr( eventchamp_global_date_converter( $date = $item["event_schedule_date"] ) );
																									$output .= '</div>';

																								}

																								if( !empty( $item["event_schedule_time"] ) ) {

																									$output .= '<div class="gt-time">';
																										$output .= esc_attr( $item["event_schedule_time"] );
																									$output .= '</div>';

																								}

																								if( !empty( $item["title"] ) ) {

																									$output .= '<div class="gt-title">';
																										$output .= esc_attr( $item["title"] );
																									$output .= '</div>';

																								}

																							$output .= '</div>';

																						}

																						$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
																					$output .= '</a>';
																				$output .= '</div>';

																			}

																			if( $i_inner == "1" and $first_open == "true" ) {

																				$output .= '<div id="event-schedule-collapse-' . esc_attr( $item_rand_id ) . '" class="gt-panel-collapse collapse show" role="tabpanel" aria-labelledby="event-schedule-heading-' . esc_attr( $item_rand_id ) . '">';

																			} elseif( $all_open == "true" ) {

																				$output .= '<div id="event-schedule-collapse-' . esc_attr( $item_rand_id ) . '" class="gt-panel-collapse collapse show" role="tabpanel" aria-labelledby="event-schedule-heading-' . esc_attr( $item_rand_id ) . '">';

																			} else {

																				$output .= '<div id="event-schedule-collapse-' . esc_attr( $item_rand_id ) . '" class="gt-panel-collapse collapse" role="tabpanel" aria-labelledby="event-schedule-heading-' . esc_attr( $item_rand_id ) . '">';

																			}

																				$output .= '<div class="gt-panel-body">';

																					if( !empty( $item["event_schedule_description"] ) ) {

																						$output .= '<div class="gt-text">';
																							$output .= do_shortcode( wpautop( $item["event_schedule_description"] ) );
																						$output .= '</div>';

																					}

																					if( !empty( $item["event_schedule_speakers"] ) ) {

																						if( function_exists( 'eventchamp_get_schedule_speakers' ) ) {

																							$output .= eventchamp_get_schedule_speakers( $speakers = $item["event_schedule_speakers"] );

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

												}

											}

										$output .= '</div>';
									$output .= '</div>';

								}

							}

						} else {

							if( !empty( $event_schedule ) ) {

								$output .= '<div class="gt-dropdown">';
									$output .= '<div class="gt-panel-group" id="event-schedule-accardion-' . esc_attr( $schedule_rand_id ) . '" role="tablist" aria-multiselectable="true">';

										foreach( $event_schedule as $item ) {

											if( !empty( $item ) ) {

												$item_rand_id = rand( 0, 999999 );
												$output .= '<div class="gt-panel">';

													if( !empty( $item["title"] ) ) {

														$output .= '<div class="gt-panel-heading" role="tab" id="event-schedule-heading-' . esc_attr( $item_rand_id ) . '">';
															$output .= '<a role="button" data-toggle="collapse" data-parent="#event-schedule-accardion-' . esc_attr( $schedule_rand_id ) . '" href="#event-schedule-collapse-' . esc_attr( $item_rand_id ) . '" aria-expanded="true" aria-controls="event-schedule-collapse-' . esc_attr( $item_rand_id ) . '">';

																if( !empty( $item["event_schedule_date"] ) or !empty( $item["event_schedule_time"] ) or !empty( $item["title"] ) ) {

																	$output .= '<div class="gt-inner">';

																		if( !empty( $item["event_schedule_date"] ) ) {

																			$output .= '<div class="gt-date">';
																				$output .= esc_attr( eventchamp_global_date_converter( $date = $item["event_schedule_date"] ) );
																			$output .= '</div>';

																		}

																		if( !empty( $item["event_schedule_time"] ) ) {

																			$output .= '<div class="gt-time">';
																				$output .= esc_attr( $item["event_schedule_time"] );
																			$output .= '</div>';

																		}

																		if( !empty( $item["title"] ) ) {

																			$output .= '<div class="gt-title">';
																				$output .= esc_attr( $item["title"] );
																			$output .= '</div>';

																		}

																	$output .= '</div>';

																}

																$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
															$output .= '</a>';
														$output .= '</div>';

													}

													if( $first_open == "true" ) {

														$output .= '<div id="event-schedule-collapse-' . esc_attr( $item_rand_id ) . '" class="gt-panel-collapse collapse show" role="tabpanel" aria-labelledby="event-schedule-heading-' . esc_attr( $item_rand_id ) . '">';

													} elseif( $all_open == "true" ) {

														$output .= '<div id="event-schedule-collapse-' . esc_attr( $item_rand_id ) . '" class="gt-panel-collapse collapse show" role="tabpanel" aria-labelledby="event-schedule-heading-' . esc_attr( $item_rand_id ) . '">';

													} else {

														$output .= '<div id="event-schedule-collapse-' . esc_attr( $item_rand_id ) . '" class="gt-panel-collapse collapse" role="tabpanel" aria-labelledby="event-schedule-heading-' . esc_attr( $item_rand_id ) . '">';

													}

														$output .= '<div class="gt-panel-body">';

															if( !empty( $item["event_schedule_description"] ) ) {

																$output .= '<div class="gt-text">';
																	$output .= do_shortcode( wpautop( $item["event_schedule_description"] ) );
																$output .= '</div>';

															}

															if( !empty( $item["event_schedule_speakers"] ) ) {

																$output .= eventchamp_get_schedule_speakers( $speakers = $item["event_schedule_speakers"] );

															}

														$output .= '</div>';
													$output .= '</div>';
												$output .= '</div>';

											}

										}

									$output .= '</div>';
								$output .= '</div>';

							}

						}

					$output .= '</div>';

				} elseif( $schedule_style == "style-4" or $schedule_style == "style-5" or $schedule_style == "style-6" ) {

					$output .= '<div class="gt-event-schedule gt-' . esc_attr( $schedule_style ) . '">';

						if( $grouped_schedule == "true" ) {

							foreach( $event_schedule as $item ) {
								$groups[] = $item["group-title"];
							}

							$groups = array_unique( $groups );

							if( !empty( $groups ) ) {

								$i = 0;
								$tab_order_id = 0;

								foreach( $groups as $group ) {

									$i++;
									$tab_order_id++;

									if( !empty( $group ) ) {

										$output .= '<div class="gt-item">';
											$output .= '<div class="gt-heading">';
												$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 511.634 511.634" xml:space="preserve"> <g> <path d="M482.513,83.942c-7.225-7.233-15.797-10.85-25.694-10.85h-36.541v-27.41c0-12.56-4.477-23.315-13.422-32.261 C397.906,4.475,387.157,0,374.591,0h-18.268c-12.565,0-23.318,4.475-32.264,13.422c-8.949,8.945-13.422,19.701-13.422,32.261v27.41 h-109.63v-27.41c0-12.56-4.475-23.315-13.422-32.261C178.64,4.475,167.886,0,155.321,0H137.05 c-12.562,0-23.317,4.475-32.264,13.422c-8.945,8.945-13.421,19.701-13.421,32.261v27.41H54.823c-9.9,0-18.464,3.617-25.697,10.85 c-7.233,7.232-10.85,15.8-10.85,25.697v365.453c0,9.89,3.617,18.456,10.85,25.693c7.232,7.231,15.796,10.849,25.697,10.849h401.989 c9.897,0,18.47-3.617,25.694-10.849c7.234-7.234,10.852-15.804,10.852-25.693V109.639 C493.357,99.739,489.743,91.175,482.513,83.942z M347.187,45.686c0-2.667,0.849-4.858,2.56-6.567 c1.711-1.711,3.901-2.568,6.57-2.568h18.268c2.67,0,4.853,0.854,6.57,2.568c1.712,1.712,2.567,3.903,2.567,6.567v82.224 c0,2.666-0.855,4.853-2.567,6.567c-1.718,1.709-3.9,2.568-6.57,2.568h-18.268c-2.669,0-4.859-0.855-6.57-2.568 c-1.711-1.715-2.56-3.901-2.56-6.567V45.686z M127.915,45.686c0-2.667,0.855-4.858,2.568-6.567 c1.714-1.711,3.901-2.568,6.567-2.568h18.271c2.667,0,4.858,0.854,6.567,2.568c1.711,1.712,2.57,3.903,2.57,6.567v82.224 c0,2.666-0.855,4.856-2.57,6.567c-1.713,1.709-3.9,2.568-6.567,2.568H137.05c-2.666,0-4.856-0.855-6.567-2.568 c-1.709-1.715-2.568-3.901-2.568-6.567V45.686z M456.812,475.088H54.823v-292.36h401.989V475.088z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
												$output .= '<span>' . esc_attr( $group ) . '</span>';
											$output .= '</div>';

											$output .= '<ul>';

												foreach( $event_schedule as $item ) {

													if( !empty( $item ) ) {

														if( $item["group-title"] == $group ) {

															$output .= '<li>';

																if( !empty( $item["image"] ) ) {

																	$output .= '<div class="gt-image">';
																		$output .= wp_get_attachment_image( eventchamp_attachment_id( esc_url( $item["image"] ) ), 'thumbnail', true, true );
																	$output .= '</div>';

																}

																if( !empty( $item["event_schedule_date"] ) or !empty( $item["event_schedule_time"] ) or !empty( $item["title"] ) ) {

																	$output .= '<div class="gt-content">';

																		if( !empty( $item["event_schedule_date"] ) or $item["event_schedule_time"] ) {

																			$output .= '<div class="gt-date">';

																				if( !empty( $item["event_schedule_date"] ) ) {

																					$output .= esc_attr( eventchamp_global_date_converter( $date = $item["event_schedule_date"] ) );

																				}

																				if( !empty( $item["event_schedule_date"] ) and $item["event_schedule_time"] ) {

																					$output .= ' ';

																				}

																				if( !empty( $item["event_schedule_time"] ) ) {

																					$output .= esc_attr( $item["event_schedule_time"] );

																				}

																			$output .= '</div>';

																		}

																		if( !empty( $item["title"] ) ) {

																			$output .= '<div class="gt-title">';
																				$output .= esc_attr( $item["title"] );
																			$output .= '</div>';

																		}

																	}

																	if( !empty( $item["event_schedule_description"] ) ) {

																		$output .= '<div class="gt-text">';
																			$output .= do_shortcode( wpautop( $item["event_schedule_description"] ) );
																		$output .= '</div>';

																	}

																	if( !empty( $item["event_schedule_speakers"] ) ) {

																		$output .= eventchamp_get_schedule_speakers( $speakers = $item["event_schedule_speakers"] );

																	}

																$output .= '</div>';

															$output .= '</li>';

														}

													}

												}

											$output .= '</ul>';
										$output .= '</div>';

									}
								}


							}

						} else {

							$output .= '<div class="gt-item">';
								$output .= '<ul>';

									foreach( $event_schedule as $item ) {

										if( !empty( $item ) ) {

											$output .= '<li>';

												if( !empty( $item["image"] ) ) {

													$output .= '<div class="gt-image">';
														$output .= wp_get_attachment_image( eventchamp_attachment_id( esc_url( $item["image"] ) ), 'thumbnail', true, true );
													$output .= '</div>';

												}

												if( !empty( $item["event_schedule_date"] ) or !empty( $item["event_schedule_time"] ) or !empty( $item["title"] ) ) {

													$output .= '<div class="gt-content">';

														if( !empty( $item["event_schedule_date"] ) or $item["event_schedule_time"] ) {

															$output .= '<div class="gt-date">';

																if( !empty( $item["event_schedule_date"] ) ) {

																	$output .= esc_attr( eventchamp_global_date_converter( $date = $item["event_schedule_date"] ) );

																}

																if( !empty( $item["event_schedule_date"] ) and $item["event_schedule_time"] ) {

																	$output .= ' ';

																}

																if( !empty( $item["event_schedule_time"] ) ) {

																	$output .= esc_attr( $item["event_schedule_time"] );

																}

															$output .= '</div>';

														}

														if( !empty( $item["title"] ) ) {

															$output .= '<div class="gt-title">';
																$output .= esc_attr( $item["title"] );
															$output .= '</div>';

														}

													}

													if( !empty( $item["event_schedule_description"] ) ) {

														$output .= '<div class="gt-text">';
															$output .= do_shortcode( wpautop( $item["event_schedule_description"] ) );
														$output .= '</div>';

													}

													if( !empty( $item["event_schedule_speakers"] ) ) {

														$output .= eventchamp_get_schedule_speakers( $speakers = $item["event_schedule_speakers"] );

													}

												$output .= '</div>';

											$output .= '</li>';

										}

									}

								$output .= '</ul>';
							$output .= '</div>';

						}

					$output .= '</div>';

				} elseif( $schedule_style == "style-7" ) {

					$output .= '<div class="gt-event-schedule gt-' . esc_attr( $schedule_style ) . '">';

						if( $grouped_schedule == "true" ) {

							foreach( $event_schedule as $item ) {

								$groups[] = $item["group-title"];

							}

							if( !empty( $groups ) ) {

								$groups = array_unique( $groups );

								if( !empty( $groups ) ) {

									$i = 0;
									$tab_order_id = 0;

									$output .= '<ul class="gt-schedule-tabs nav" role="tablist">';

										foreach( $groups as $group ) {

											if( !empty( $group ) ) {

												$i++;
												$tab_order_id++;

												$output .= '<li>';

													if( $i == "1" ) {

														$output .= '<a data-toggle="tab" class="active show" href="#gt-event-schedule-' . esc_attr( $tab_order_id ) . '" role="tab" aria-controls="gt-event-schedule-' . esc_attr( $tab_order_id ) . '" aria-selected="true">';

													} else {

														$output .= '<a data-toggle="tab" href="#gt-event-schedule-' . esc_attr( $tab_order_id ) . '" role="tab" aria-controls="gt-event-schedule-' . esc_attr( $tab_order_id ) . '" aria-selected="true">';

													}

														$output .= esc_attr( $group );
													$output .= '</a>';
												$output .= '</li>';

											}

										}

									$output .= '</ul>';

									$i = 0;
									$tab_order_id = 0;

									$output .= '<div class="gt-dropdown">';
										$output .= '<div class="tab-content">';

											foreach( $groups as $group ) {

												$i++;
												$tab_order_id++;

												if( !empty( $group ) ) {

													if( $i == "1" ) {

														$output .= '<div class="tab-pane fade active show" id="gt-event-schedule-' . esc_attr( $tab_order_id ) . '" role="tabpanel" aria-labelledby="nav-gt-event-schedule-' . esc_attr( $tab_order_id ) . '-tab">';

													} else {

														$output .= '<div class="tab-pane fade" id="gt-event-schedule-' . esc_attr( $tab_order_id ) . '" role="tabpanel" aria-labelledby="nav-gt-event-schedule-' . esc_attr( $tab_order_id ) . '-tab">';

													}

														$output .= '<div class="gt-panel-group" id="event-schedule-accardion-' . esc_attr( $schedule_rand_id ) . '" role="tablist" aria-multiselectable="true">';
															$i_inner = 0;

															$output .= '<div class="gt-item">';
																$output .= '<ul>';

																	foreach( $event_schedule as $item ) {

																		if( !empty( $item ) ) {

																			if( $item["group-title"] == $group ) {

																				$output .= '<li>';

																					if( !empty( $item["event_schedule_speakers"] ) or !empty( $item["event_schedule_description"] ) or !empty( $item["title"] ) ) {

																						$output .= '<div class="gt-content">';
																							$output .= '<div class="gt-inner">';

																								if( !empty( $item["title"] ) ) {

																									$output .= '<div class="gt-title">';
																										$output .= esc_attr( $item["title"] );
																									$output .= '</div>';

																								}

																								if( !empty( $item["event_schedule_description"] ) ) {

																									$output .= '<div class="gt-text">';
																										$output .= do_shortcode( wpautop( $item["event_schedule_description"] ) );
																									$output .= '</div>';

																								}

																								if( !empty( $item["event_schedule_speakers"] ) ) {

																									$output .= eventchamp_get_schedule_speakers( $speakers = $item["event_schedule_speakers"] );

																								}

																							$output .= '</div>';
																						$output .= '</div>';

																					}

																					if( !empty( $item["image"] ) or !empty( $item["event_schedule_date"] ) or !empty( $item["event_schedule_time"] ) ) {

																						$output .= '<div class="gt-details">';

																							if( !empty( $item["image"] ) ) {

																								$output .= '<div class="gt-image">';
																									$output .= wp_get_attachment_image( eventchamp_attachment_id( esc_url( $item["image"] ) ), 'thumbnail', true, true );
																								$output .= '</div>';

																							}

																							if( !empty( $item["event_schedule_date"] ) or !empty( $item["event_schedule_time"] ) ) {

																								$output .= '<div class="gt-date">';

																									if( !empty( $item["event_schedule_date"] ) ) {

																										$output .= esc_attr( eventchamp_global_date_converter( $date = $item["event_schedule_date"] ) );

																									}

																									if( !empty( $item["event_schedule_date"] ) and !empty( $item["event_schedule_time"] ) ) {

																										$output .= ' ';

																									}

																									if( !empty( $item["event_schedule_time"] ) ) {

																										$output .= esc_attr( $item["event_schedule_time"] );

																									}

																								$output .= '</div>';

																							}

																						$output .= '</div>';

																					}

																				$output .= '</li>';

																			}

																		}

																	}

																$output .= '</ul>';
															$output .= '</div>';

														$output .= '</div>';
													$output .= '</div>';

												}
											}

										$output .= '</div>';
									$output .= '</div>';

								}

							}

						} else {

							$output .= '<div class="gt-item">';
								$output .= '<ul>';

									foreach( $event_schedule as $item ) {

										if( !empty( $item ) ) {

											$output .= '<li>';

												if( !empty( $item["event_schedule_speakers"] ) or !empty( $item["event_schedule_description"] ) or !empty( $item["title"] ) ) {

													$output .= '<div class="gt-content">';
														$output .= '<div class="gt-inner">';

															if( !empty( $item["title"] ) ) {

																$output .= '<div class="gt-title">';
																	$output .= esc_attr( $item["title"] );
																$output .= '</div>';

															}

															if( !empty( $item["event_schedule_description"] ) ) {

																$output .= '<div class="gt-text">';
																	$output .= do_shortcode( wpautop( $item["event_schedule_description"] ) );
																$output .= '</div>';

															}

															if( !empty( $item["event_schedule_speakers"] ) ) {

																$output .= eventchamp_get_schedule_speakers( $speakers = $item["event_schedule_speakers"] );

															}

														$output .= '</div>';
													$output .= '</div>';

												}

												if( !empty( $item["image"] ) or !empty( $item["event_schedule_date"] ) or !empty( $item["event_schedule_time"] ) ) {

													$output .= '<div class="gt-details">';

														if( !empty( $item["image"] ) ) {

															$output .= '<div class="gt-image">';
																$output .= wp_get_attachment_image( eventchamp_attachment_id( esc_url( $item["image"] ) ), 'thumbnail', true, true );
															$output .= '</div>';

														}

														if( !empty( $item["event_schedule_date"] ) or !empty( $item["event_schedule_time"] ) ) {

															$output .= '<div class="gt-date">';

																if( !empty( $item["event_schedule_date"] ) ) {

																	$output .= esc_attr( eventchamp_global_date_converter( $date = $item["event_schedule_date"] ) );

																}

																if( !empty( $item["event_schedule_date"] ) and !empty( $item["event_schedule_time"] ) ) {

																	$output .= ' ';

																}

																if( !empty( $item["event_schedule_time"] ) ) {

																	$output .= esc_attr( $item["event_schedule_time"] );

																}

															$output .= '</div>';

														}

													$output .= '</div>';

												}

											$output .= '</li>';

										}

									}

								$output .= '</ul>';
							$output .= '</div>';

						}

					$output .= '</div>';

				}

			}

		}

		return $output;
	}

}



/*======
*
* Get Schedule Speakers
*
======*/
if( !function_exists( 'eventchamp_get_schedule_speakers' ) ) {

	function eventchamp_get_schedule_speakers( $speakers = "" ) {

		$output = "";

		if( !empty( $speakers ) ) {

			$output .= '<div class="gt-schedule-speakers">';
				$output .= '<div class="gt-title">' . esc_html__( 'Speakers', 'eventchamp' ) . ':</div>';
				$output .= '<div class="gt-list">';
					$output .= '<ul>';

						$schedule_speaker_ids = array();

						foreach( $speakers as $schedule_speaker ) {

							if( !empty( $schedule_speaker ) ) {

								$schedule_speaker_ids[] = $schedule_speaker;

							}

						}

						if( !empty( $schedule_speaker_ids ) ) {

							$args_posts = array(
								'posts_per_page' => -1,
								'post__in' => $schedule_speaker_ids,
								'post_status' => 'publish',
								'post_type' => 'speaker',
							); 
							$wp_query = new WP_Query( $args_posts );

							if( !empty( $wp_query ) ) {

								while ( $wp_query->have_posts() ) {

								$wp_query->the_post();
									$output .= '<li>';
										$output .= '<a href="' . get_the_permalink() . '">';
											$speaker_photo = get_post_meta( get_the_ID(), 'speaker-profile-photo', true );

											if( !empty( $speaker_photo ) ) {

												$output .= '<div class="gt-image">';
													$output .= wp_get_attachment_image( eventchamp_attachment_id( $speaker_photo ), 'eventchamp-avatar', true, true );
												$output .= '</div>';

											} elseif ( has_post_thumbnail( esc_attr( $post_id ) ) ) {

												$output .= '<div class="gt-image">';
													$output .= wp_get_attachment_image( get_post_thumbnail_id( $post_id ), 'eventchamp-avatar' );
												$output .= '</div>';

											}

											$speaker_name = get_the_title();

											$schedule_speaker_detail = ot_get_option( 'schedule_speaker_detail' );
											$speaker_profession = get_post_meta( get_the_ID(), 'speaker_profession', true );
											$speaker_company = get_post_meta( get_the_ID(), 'speaker_company', true );

											if( !empty( $speaker_profession ) or !empty( $speaker_company ) or !empty( $speaker_name ) ) {

												$output .= '<div class="gt-detail">';

													if( !empty( $speaker_name ) ) {

														$output .= '<div class="gt-name">' . get_the_title() . '</div>';

													}

													if( $schedule_speaker_detail == "company" ) {

														if( !empty( $speaker_company ) ) {

															$output .= '<div class="gt-company">' . esc_attr( $speaker_company ) . '</div>';

														}

													} else {

														if( !empty( $speaker_profession ) ) {

															$output .= '<div class="gt-profession">' . esc_attr( $speaker_profession ) . '</div>';

														}

													}

												$output .= '</div>';

											}

										$output .= '</a>';
									$output .= '</li>';

								}

								wp_reset_postdata();

							}

						}

				 	$output .= '</ul>';
			 	$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Event Tickets
*
======*/
if( !function_exists( 'eventchamp_event_tickets' ) ) {

	function eventchamp_event_tickets( $post_id = "", $extra_style = "", $extra_column = "", $extra_column_space = "" ) {

		$output = '';

		if( !empty( $post_id ) ) {

			$quantity = ot_get_option( 'event-ticket-quantity', 'true' );
			$max_quantity = ot_get_option( 'event-ticket-max-quantity', '10' );
			$ticket_style = get_post_meta( esc_attr( $post_id ), 'event-ticket-style', true );

			if( empty( $ticket_style ) or $ticket_style == "default" ) {

				$ticket_style = ot_get_option( 'event-ticket-style', 'style-1' );

			}

			if( !empty( $extra_style ) ) {

				$ticket_style = $extra_style;

			}

			$ticket_column = get_post_meta( esc_attr( $post_id ), 'event-ticket-column', true );

			if( empty( $ticket_column ) or $ticket_column == "default" ) {

				$ticket_column = ot_get_option( 'event-ticket-column', '2' );

			}

			if( !empty( $extra_column ) ) {

				$ticket_column = $extra_column;

			}

			$ticket_column_space = get_post_meta( esc_attr( $post_id ), 'event-ticket-column-space', true );

			if( empty( $ticket_column_space ) or $ticket_column_space == "default" ) {

				$ticket_column_space = ot_get_option( 'event-ticket-column-space', '15' );

			}

			if( !empty( $extra_column_space ) ) {

				$ticket_column_space = $extra_column_space;

			}

			$event_tickets = get_post_meta( esc_attr( $post_id ), 'event_tickets', true );

			if( !empty( $event_tickets ) ) {

				$output .= '<div class="gt-columns gt-column-' . esc_attr( $ticket_column ) . ' gt-column-space-' . esc_attr( $ticket_column_space ) . '">';

					foreach( $event_tickets as $ticket ) {

						if( !empty( $ticket ) ) {

							if( $ticket_style == "style-1" ) {

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= '<div class="gt-event-ticket gt-' . esc_attr( $ticket_style ) . ' gt-active-' . esc_attr( $ticket["active-style"] ) . '">';
											$output .= '<div class="gt-ticket-inner">';

												if( empty( $ticket["button-title"] ) ) {

													$ticket["button-title"] = esc_html__( 'Buy Now', 'eventchamp' );

												}

												if( empty( $ticket["button-target"] ) ) {

													$ticket["button-target"] = "_self";

												}

												$output .= '<div class="gt-details">';

													if( !empty( $ticket["subtitle"] ) ) {

														$output .= '<div class="gt-subtitle">';
															$output .= esc_attr( $ticket["subtitle"] );
														$output .= '</div>';

													}

													if( !empty( $ticket["title"] ) ) {

														$output .= '<div class="gt-title">';
															$output .= esc_attr( $ticket["title"] );
														$output .= '</div>';

													}

													if( $ticket["purchase-type"] == "eventbrite" or $ticket["purchase-type"] == "meetup" or $ticket["purchase-type"] == "contact-form" or $ticket["purchase-type"] == "external-link" ) {

														$free_event_price = ot_get_option( 'event-free-events-price', 'free' );
														$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
														$currency = ot_get_option( 'event-price-currency' );

														if( empty( $ticket["price"] ) or $ticket["price"] == "0" ) {

															$output .= '<div class="gt-price">';

																if( $free_event_price == "free" ) {

																	$output .= esc_html__( 'Free', 'eventchamp' );

																} elseif( $free_event_price == "0" ) {

																	$output .= '0';

																} elseif( $free_event_price == "0-currency" ) {

																	if( $currency_position == "left" ) {

																		$output .= esc_attr( $currency );

																	}

																	if( $currency_position == "left-space" ) {

																		$output .= esc_attr( $currency ) . ' ';

																	}

																	$output .= esc_attr( $ticket["price"] );

																	if( $currency_position == "right" ) {

																		$output .= esc_attr( $currency );

																	}

																	if( $currency_position == "right-space" ) {

																		$output .= ' ' . esc_attr( $currency );

																	}

																}

															$output .= '</div>';

														} elseif( !empty( $ticket["price"] ) ) {

															$output .= '<div class="gt-price">';

																if( $currency_position == "left" ) {

																	$output .= esc_attr( $currency );

																}

																if( $currency_position == "left-space" ) {

																	$output .= esc_attr( $currency ) . ' ';

																}

																$output .= esc_attr( $ticket["price"] );

																if( $currency_position == "right" ) {

																	$output .= esc_attr( $currency );

																}

																if( $currency_position == "right-space" ) {

																	$output .= ' ' . esc_attr( $currency );

																}

															$output .= '</div>';

														}

													} elseif( $ticket["purchase-type"] == "woocommerce" and function_exists( 'wc_get_product' ) and !empty( $ticket["woocommerce-product"] ) ) {

														$output .= '<div class="gt-price">';
															$output .= wc_get_product( $ticket["woocommerce-product"] )->get_price_html();
														$output .= '</div>';

													}

													if( $ticket["purchase-type"] == "woocommerce" and function_exists( 'wc_get_product' ) and !empty( $ticket["woocommerce-product"] ) ) {

															$output .= '<form action="' . wc_get_product( $ticket["woocommerce-product"] )->add_to_cart_url() . '" method="post" enctype="multipart/form-data">';
																$output .= '<div class="gt-buy-now gt-woocommerce-button">';

																	if( $ticket["quantity"] == "default" ) {

																		$ticket["quantity"] = esc_attr( $quantity );

																	}

																	if( $ticket["quantity"] == "true" ) {

																		$output .= '<div class="gt-quantity">';
																			$output .= '<select name="quantity" class="gt-select">';
																				$output .= '<option value="">' . esc_html__( 'Quantity', 'eventchamp' ) . '</option>';

																				$q = 1;

																				for( $q = 1; $q <= $max_quantity; $q++ ) {

																					$output .= '<option value="' . esc_attr( $q ) . '">' . esc_attr( $q ) . '</option>';

																				}

																			$output .= '</select>';
																		$output .= '</div>';

																	}

																	$output .= '<button class="gt-button gt-style-3">' . esc_attr( $ticket["button-title"] ) . '</button>';

																$output .= '</div>';
															$output .= '</form>';

													} elseif( $ticket["purchase-type"] == "eventbrite" and !empty( $ticket["eventbrite-link"] ) ) {

														$output .= '<div class="gt-buy-now gt-eventbrite-button gt-button gt-style-3">';
															$output .= '<a href="' . esc_url( $ticket["eventbrite-link"] ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
																$output .= esc_attr( $ticket["button-title"] );
															$output .= '</a>';
														$output .= '</div>';

													} elseif( $ticket["purchase-type"] == "meetup" and !empty( $ticket["meetup-link"] ) ) {

														$output .= '<div class="gt-buy-now gt-meetup-button gt-button gt-style-3">';
															$output .= '<a href="' . esc_url( $ticket["meetup-link"] ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
																$output .= esc_attr( $ticket["button-title"] );
															$output .= '</a>';
														$output .= '</div>';

													} elseif( $ticket["purchase-type"] == "external-link" and !empty( $ticket["external-link"] ) ) {

														$output .= '<div class="gt-buy-now gt-external-button gt-button gt-style-3">';
															$output .= '<a href="' . esc_url( $ticket["external-link"] ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
																$output .= esc_attr( $ticket["button-title"] );
															$output .= '</a>';
														$output .= '</div>';

													} elseif( $ticket["purchase-type"] == "contact-form" ) {

														$output .= '<div class="gt-buy-now gt-contact-button gt-button gt-style-3">';
															$output .= '<a href="' . ( !empty( $ticket["contact-form-link"] ) ? esc_url( $ticket["contact-form-link"] ) : '#tickets' ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
																$output .= esc_attr( $ticket["button-title"] );
															$output .= '</a>';
														$output .= '</div>';

													}

												$output .= '</div>';

												if( !empty( $ticket["event_tickets_package_feature"] ) ) {

													$output .= '<div class="gt-ticket-features">';
														$output .= wpautop( $ticket["event_tickets_package_feature"] );
													$output .= '</div>';

												}

											$output .= '</div>';
										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';

							} elseif( $ticket_style == "style-2" or $ticket_style == "style-3" or $ticket_style == "style-4" or $ticket_style == "style-5" ) {

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= '<div class="gt-event-ticket gt-' . esc_attr( $ticket_style ) . ' gt-active-' . esc_attr( $ticket["active-style"] ) . '">';
											$output .= '<div class="gt-ticket-inner">';

												if( empty( $ticket["button-title"] ) ) {

													$ticket["button-title"] = esc_html__( 'Buy Now', 'eventchamp' );

												}

												if( empty( $ticket["button-target"] ) ) {

													$ticket["button-target"] = "_self";

												}

												if( !empty( $ticket["title"] ) ) {

													$output .= '<div class="gt-title">';
														$output .= esc_attr( $ticket["title"] );
													$output .= '</div>';

												}

												if( !empty( $ticket["subtitle"] ) ) {

													$output .= '<div class="gt-subtitle">';
														$output .= esc_attr( $ticket["subtitle"] );
													$output .= '</div>';

												}

												if( $ticket_style == "style-4" or $ticket_style == "style-5" ) {

													if( $ticket["purchase-type"] == "eventbrite" or $ticket["purchase-type"] == "meetup" or $ticket["purchase-type"] == "contact-form" or $ticket["purchase-type"] == "external-link" ) {

														$free_event_price = ot_get_option( 'event-free-events-price', 'free' );
														$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
														$currency = ot_get_option( 'event-price-currency' );

														if( empty( $ticket["price"] ) or $ticket["price"] == "0" ) {

															$output .= '<div class="gt-price">';

																if( $free_event_price == "free" ) {

																	$output .= esc_html__( 'Free', 'eventchamp' );

																} elseif( $free_event_price == "0" ) {

																	$output .= '0';

																} elseif( $free_event_price == "0-currency" ) {

																	if( $currency_position == "left" ) {

																		$output .= esc_attr( $currency );

																	}

																	if( $currency_position == "left-space" ) {

																		$output .= esc_attr( $currency ) . ' ';

																	}

																	$output .= esc_attr( $ticket["price"] );

																	if( $currency_position == "right" ) {

																		$output .= esc_attr( $currency );

																	}

																	if( $currency_position == "right-space" ) {

																		$output .= ' ' . esc_attr( $currency );

																	}

																}

															$output .= '</div>';

														} elseif( !empty( $ticket["price"] ) ) {

															$output .= '<div class="gt-price">';

																if( $currency_position == "left" ) {

																	$output .= esc_attr( $currency );

																}

																if( $currency_position == "left-space" ) {

																	$output .= esc_attr( $currency ) . ' ';

																}

																$output .= esc_attr( $ticket["price"] );

																if( $currency_position == "right" ) {

																	$output .= esc_attr( $currency );

																}

																if( $currency_position == "right-space" ) {

																	$output .= ' ' . esc_attr( $currency );

																}

															$output .= '</div>';

														}

													} elseif( $ticket["purchase-type"] == "woocommerce" and function_exists( 'wc_get_product' ) and !empty( $ticket["woocommerce-product"] ) ) {

														$output .= '<div class="gt-price">';
															$output .= wc_get_product( $ticket["woocommerce-product"] )->get_price_html();
														$output .= '</div>';

													}

												}

												if( !empty( $ticket["event_tickets_package_feature"] ) ) {

													$output .= '<div class="gt-ticket-features">';
														$output .= wpautop( $ticket["event_tickets_package_feature"] );
													$output .= '</div>';

												}

												if( $ticket_style == "style-2" or $ticket_style == "style-3" ) {

													if( $ticket["purchase-type"] == "eventbrite" or $ticket["purchase-type"] == "meetup" or $ticket["purchase-type"] == "contact-form" or $ticket["purchase-type"] == "external-link" ) {

														$free_event_price = ot_get_option( 'event-free-events-price', 'free' );
														$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
														$currency = ot_get_option( 'event-price-currency' );

														if( empty( $ticket["price"] ) or $ticket["price"] == "0" ) {

															$output .= '<div class="gt-price">';

																if( $free_event_price == "free" ) {

																	$output .= esc_html__( 'Free', 'eventchamp' );

																} elseif( $free_event_price == "0" ) {

																	$output .= '0';

																} elseif( $free_event_price == "0-currency" ) {

																	if( $currency_position == "left" ) {

																		$output .= esc_attr( $currency );

																	}

																	if( $currency_position == "left-space" ) {

																		$output .= esc_attr( $currency ) . ' ';

																	}

																	$output .= esc_attr( $ticket["price"] );

																	if( $currency_position == "right" ) {

																		$output .= esc_attr( $currency );

																	}

																	if( $currency_position == "right-space" ) {

																		$output .= ' ' . esc_attr( $currency );

																	}

																}

															$output .= '</div>';

														} elseif( !empty( $ticket["price"] ) ) {

															$output .= '<div class="gt-price">';

																if( $currency_position == "left" ) {

																	$output .= esc_attr( $currency );

																}

																if( $currency_position == "left-space" ) {

																	$output .= esc_attr( $currency ) . ' ';

																}

																$output .= esc_attr( $ticket["price"] );

																if( $currency_position == "right" ) {

																	$output .= esc_attr( $currency );

																}

																if( $currency_position == "right-space" ) {

																	$output .= ' ' . esc_attr( $currency );

																}

															$output .= '</div>';

														}

													} elseif( $ticket["purchase-type"] == "woocommerce" and function_exists( 'wc_get_product' ) and !empty( $ticket["woocommerce-product"] ) ) {

														$output .= '<div class="gt-price">';
															$output .= wc_get_product( $ticket["woocommerce-product"] )->get_price_html();
														$output .= '</div>';

													}

												}

												if( $ticket["purchase-type"] == "woocommerce" and function_exists( 'wc_get_product' ) and !empty( $ticket["woocommerce-product"] ) ) {

													$output .= '<form action="' . wc_get_product( $ticket["woocommerce-product"] )->add_to_cart_url() . '" method="post" enctype="multipart/form-data">';
														$output .= '<div class="gt-buy-now gt-woocommerce-button">';

															if( $ticket["quantity"] == "default" ) {

																$ticket["quantity"] = esc_attr( $quantity );

															}

															if( $ticket["quantity"] == "true" ) {

																$output .= '<div class="gt-quantity">';
																	$output .= '<select name="quantity" class="gt-select">';
																		$output .= '<option value="">' . esc_html__( 'Quantity', 'eventchamp' ) . '</option>';

																		$q = 1;

																		for( $q = 1; $q <= $max_quantity; $q++ ) {

																			$output .= '<option value="' . esc_attr( $q ) . '">' . esc_attr( $q ) . '</option>';

																		}

																	$output .= '</select>';
																$output .= '</div>';

															}

															$output .= '<button class="gt-button gt-style-3">' . esc_attr( $ticket["button-title"] ) . '</button>';

														$output .= '</div>';
													$output .= '</form>';

												} elseif( $ticket["purchase-type"] == "eventbrite" and !empty( $ticket["eventbrite-link"] ) ) {

													$output .= '<div class="gt-buy-now gt-eventbrite-button gt-button gt-style-3">';
														$output .= '<a href="' . esc_url( $ticket["eventbrite-link"] ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
															$output .= esc_attr( $ticket["button-title"] );
														$output .= '</a>';
													$output .= '</div>';

												} elseif( $ticket["purchase-type"] == "meetup" and !empty( $ticket["meetup-link"] ) ) {

													$output .= '<div class="gt-buy-now gt-meetup-button gt-button gt-style-3">';
														$output .= '<a href="' . esc_url( $ticket["meetup-link"] ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
															$output .= esc_attr( $ticket["button-title"] );
														$output .= '</a>';
													$output .= '</div>';

												} elseif( $ticket["purchase-type"] == "external-link" and !empty( $ticket["external-link"] ) ) {

													$output .= '<div class="gt-buy-now gt-external-button gt-button gt-style-3">';
														$output .= '<a href="' . esc_url( $ticket["external-link"] ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
															$output .= esc_attr( $ticket["button-title"] );
														$output .= '</a>';
													$output .= '</div>';

												} elseif( $ticket["purchase-type"] == "contact-form" ) {

													$output .= '<div class="gt-buy-now gt-contact-button gt-button gt-style-3">';
														$output .= '<a href="' . ( !empty( $ticket["contact-form-link"] ) ? esc_url( $ticket["contact-form-link"] ) : '#tickets' ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
															$output .= esc_attr( $ticket["button-title"] );
														$output .= '</a>';
													$output .= '</div>';

												}

											$output .= '</div>';
										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';

							} elseif( $ticket_style == "style-6" or $ticket_style == "style-7" ) {

								$output .= '<div class="gt-col">';
									$output .= '<div class="gt-inner">';
										$output .= '<div class="gt-event-ticket gt-' . esc_attr( $ticket_style ) . ' gt-active-' . esc_attr( $ticket["active-style"] ) . '">';
											$output .= '<div class="gt-ticket-inner">';

												if( empty( $ticket["button-title"] ) ) {

													$ticket["button-title"] = esc_html__( 'Buy Now', 'eventchamp' );

												}

												if( empty( $ticket["button-target"] ) ) {

													$ticket["button-target"] = "_self";

												}

												$output .= '<div class="gt-ticket-header">';

													if( $ticket["purchase-type"] == "eventbrite" or $ticket["purchase-type"] == "meetup" or $ticket["purchase-type"] == "contact-form" or $ticket["purchase-type"] == "external-link" ) {

														$free_event_price = ot_get_option( 'event-free-events-price', 'free' );
														$currency_position = ot_get_option( 'event-price-currency-position', 'left' );
														$currency = ot_get_option( 'event-price-currency' );

														if( empty( $ticket["price"] ) or $ticket["price"] == "0" ) {

															$output .= '<div class="gt-price">';

																if( $free_event_price == "free" ) {

																	$output .= esc_html__( 'Free', 'eventchamp' );

																} elseif( $free_event_price == "0" ) {

																	$output .= '0';

																} elseif( $free_event_price == "0-currency" ) {

																	if( $currency_position == "left" ) {

																		$output .= esc_attr( $currency );

																	}

																	if( $currency_position == "left-space" ) {

																		$output .= esc_attr( $currency ) . ' ';

																	}

																	$output .= esc_attr( $ticket["price"] );

																	if( $currency_position == "right" ) {

																		$output .= esc_attr( $currency );

																	}

																	if( $currency_position == "right-space" ) {

																		$output .= ' ' . esc_attr( $currency );

																	}

																}

															$output .= '</div>';

														} elseif( !empty( $ticket["price"] ) ) {

															$output .= '<div class="gt-price">';

																if( $currency_position == "left" ) {

																	$output .= esc_attr( $currency );

																}

																if( $currency_position == "left-space" ) {

																	$output .= esc_attr( $currency ) . ' ';

																}

																$output .= esc_attr( $ticket["price"] );

																if( $currency_position == "right" ) {

																	$output .= esc_attr( $currency );

																}

																if( $currency_position == "right-space" ) {

																	$output .= ' ' . esc_attr( $currency );

																}

															$output .= '</div>';

														}

													} elseif( $ticket["purchase-type"] == "woocommerce" and function_exists( 'wc_get_product' ) and !empty( $ticket["woocommerce-product"] ) ) {

														$output .= '<div class="gt-price">';
															$output .= wc_get_product( $ticket["woocommerce-product"] )->get_price_html();
														$output .= '</div>';

													}

													if( !empty( $ticket["title"] ) ) {

														$output .= '<div class="gt-title">';
															$output .= esc_attr( $ticket["title"] );
														$output .= '</div>';

													}

													if( !empty( $ticket["subtitle"] ) ) {

														$output .= '<div class="gt-subtitle">';
															$output .= esc_attr( $ticket["subtitle"] );
														$output .= '</div>';

													}

												$output .= '</div>';

												if( !empty( $ticket["event_tickets_package_feature"] ) ) {

													$output .= '<div class="gt-ticket-features">';
														$output .= wpautop( $ticket["event_tickets_package_feature"] );
													$output .= '</div>';

												}

												if( $ticket["purchase-type"] == "woocommerce" and function_exists( 'wc_get_product' ) and !empty( $ticket["woocommerce-product"] ) ) {

													$output .= '<form action="' . wc_get_product( $ticket["woocommerce-product"] )->add_to_cart_url() . '" method="post" enctype="multipart/form-data">';
														$output .= '<div class="gt-buy-now gt-woocommerce-button">';

															if( $ticket["quantity"] == "default" ) {

																$ticket["quantity"] = esc_attr( $quantity );

															}

															if( $ticket["quantity"] == "true" ) {

																$output .= '<div class="gt-quantity">';
																	$output .= '<select name="quantity" class="gt-select">';
																		$output .= '<option value="">' . esc_html__( 'Quantity', 'eventchamp' ) . '</option>';

																		$q = 1;

																		for( $q = 1; $q <= $max_quantity; $q++ ) {

																			$output .= '<option value="' . esc_attr( $q ) . '">' . esc_attr( $q ) . '</option>';

																		}

																	$output .= '</select>';
																$output .= '</div>';

															}

															$output .= '<button class="gt-button gt-style-3">' . esc_attr( $ticket["button-title"] ) . '</button>';

														$output .= '</div>';
													$output .= '</form>';

												} elseif( $ticket["purchase-type"] == "eventbrite" and !empty( $ticket["eventbrite-link"] ) ) {

													$output .= '<div class="gt-buy-now gt-eventbrite-button gt-button gt-style-3">';
														$output .= '<a href="' . esc_url( $ticket["eventbrite-link"] ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
															$output .= esc_attr( $ticket["button-title"] );
														$output .= '</a>';
													$output .= '</div>';

												} elseif( $ticket["purchase-type"] == "meetup" and !empty( $ticket["meetup-link"] ) ) {

													$output .= '<div class="gt-buy-now gt-meetup-button gt-button gt-style-3">';
														$output .= '<a href="' . esc_url( $ticket["meetup-link"] ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
															$output .= esc_attr( $ticket["button-title"] );
														$output .= '</a>';
													$output .= '</div>';

												} elseif( $ticket["purchase-type"] == "external-link" and !empty( $ticket["external-link"] ) ) {

													$output .= '<div class="gt-buy-now gt-external-button gt-button gt-style-3">';
														$output .= '<a href="' . esc_url( $ticket["external-link"] ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
															$output .= esc_attr( $ticket["button-title"] );
														$output .= '</a>';
													$output .= '</div>';

												} elseif( $ticket["purchase-type"] == "contact-form" ) {

													$output .= '<div class="gt-buy-now gt-contact-button gt-button gt-style-3">';
														$output .= '<a href="' . ( !empty( $ticket["contact-form-link"] ) ? esc_url( $ticket["contact-form-link"] ) : '#tickets' ) . '" target="' . esc_attr( $ticket["button-target"] ) . '">';
															$output .= esc_attr( $ticket["button-title"] );
														$output .= '</a>';
													$output .= '</div>';

												}

											$output .= '</div>';
										$output .= '</div>';
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
* Event Map
*
======*/
if( !function_exists( 'eventchamp_event_map' ) ) {

	function eventchamp_event_map( $id = "", $map_height = "", $extra_style = "", $extra_zoom = "" ) {

		$output = "";

		if( !empty( $id ) ) {

			$google_maps_api = ot_get_option( 'googlemapapi' );
			$map_type = ot_get_option( 'event-map-type', 'true' );
			$map_scale = ot_get_option( 'event-map-scale', 'true' );
			$map_zoom_control = ot_get_option( 'event-map-zoom-control', 'true' );
			$map_street = ot_get_option( 'event-map-street', 'true' );
			$map_fullscreen = ot_get_option( 'event-map-fullscreen', 'true' );

			$address = get_post_meta( esc_attr( $id ), 'event_detailed_address', true );
			$lng = get_post_meta( esc_attr( $id ), 'event-map-lng', true );
			$lat = get_post_meta( esc_attr( $id ), 'event-map-lat', true );
			$zoom = get_post_meta( esc_attr( $id ), 'event-map-zoom', true );
			$style = get_post_meta( esc_attr( $id ), 'event-map-style', true );
			$icon = get_post_meta( esc_attr( $id ), 'event-map-icon', true );

			if( empty( $icon ) ) {

				$icon = ot_get_option( 'event-map-icon', get_template_directory_uri() . '/include/assets/img/map-marker.png' );

			}

			if( empty( $zoom ) ) {

				$zoom = ot_get_option( 'event-map-zoom', '13' );

			}

			if( !empty( $extra_zoom ) ) {

				$zoom = esc_attr( $extra_zoom );

			}

			if( empty( $style ) or $style == "default" ) {

				$style = ot_get_option( 'event-map-style', '1' );

			}

			if( !empty( $extra_style ) ) {

				$style = esc_attr( $extra_style );

			}

			if( !empty( $google_maps_api ) ) {

				if( !empty( $lng ) and !empty( $lat ) ) {

					$output .= '<div class="gt-map">';

						if( !empty( $map_height ) ) {

							$output .= '<div id="event_map" class="gt-map-inner"' . ( !empty( $map_height ) ? ' style="height:' . esc_attr( $map_height ) . ';"' : '' ) . '></div>';

						} else {

							$output .= '<div id="event_map" class="gt-map-inner"></div>';

						}
						
						$output .= '<ul data-zoom="' . esc_attr( $zoom ) . '" data-lat="' . esc_attr( $lat ) . '" data-lng="' . esc_attr( $lng ) . '" data-type="' . esc_attr( $map_type ) . '" data-scale="' . esc_attr( $map_scale ) . '" data-zoom-control="' . esc_attr( $map_zoom_control ) . '" data-map-style="' . esc_attr( $style ) . '" data-street="' . esc_attr( $map_street ) . '" data-fullscreen="' . esc_attr( $map_fullscreen ) . '" data-icon="' . esc_url( $icon ) . '" data-first-info="false" data-close-icon="">';
							$output .= '<li data-lat="' . esc_attr( $lat ) . '" data-lng="' . esc_attr( $lng ) . '" data-icon="' . esc_url( $icon ) . '"></li>';
						$output .= '</ul>';
					$output .= '</div>';

				} elseif( !empty( $address ) ) {

					$output .= '<iframe width="100%" height="450" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=' . esc_attr( $google_maps_api ) . '&q=' . esc_attr( $address ) . '"></iframe>';

				} else {

					$output .= wpautop( esc_html__( 'Enter an address or map lat and lng from the Contact tab.', 'eventchamp' ) );

				}

			} else {

				$output .= wpautop( esc_html__( 'Enter your Google Map API from the Theme Settings panel.', 'eventchamp' ) );

			}

		}

		return $output;

	}

}



/*======
*
* Event Google Street View
*
======*/
if( !function_exists( 'eventchamp_event_google_street_view' ) ) {

	function eventchamp_event_google_street_view( $event_id = "", $height = "450" ) {

		$output = "";

		if( !empty( $event_id ) ) {

			$google_street_view = get_post_meta( esc_attr( $event_id ), 'event_google_street_link', true );

			if( !empty( $google_street_view ) ) {

				$output .= '<iframe width="100%" height="' . esc_attr( $height ) . '" frameborder="0" src="' . esc_url( $google_street_view ) . '"></iframe>';

			}

		}

		return $output;

	}

}



/*======
*
* Event Tags
*
======*/
if( !function_exists( 'eventchamp_event_tags' ) ) {

	function eventchamp_event_tags( $id = "", $position = "position-1" ) {

		$output = "";

		if( !empty( $id ) ) {

			$event_tag_status = ot_get_option( 'event-tags', 'on' );
			$style = ot_get_option( 'event-tags-style', 'style-1' );
			$event_tags = wp_get_post_terms( esc_attr( $id ), 'event_tags' );

			if( $event_tag_status == "on" or $event_tag_status !== "off" ) {

				if( $position == "position-1" ) {

					if( !empty( $event_tags ) ) {

						$output .= '<div class="gt-tags gt-' . esc_attr( $style ) . '">';
							$output .= '<ul>';

								foreach( $event_tags as $tag ) {

									if( !empty( $tag ) ) {

										$output .= '<li>';
											$output .= '<a href="' . esc_url( get_term_link( $tag->term_id ) . '?post_type=event' ) . '">' . esc_attr( $tag->name ) . '</a>';
										$output .= '</li>';

									}

								}

							$output .= '</ul>';
						$output .= '</div>';

					}

				} else {

					$output .= '<div class="gt-widget gt-detail-widget">';
						$output .= '<div class="gt-widget-title">';
							$output .= '<span>' . esc_html__( 'Event Tags' , 'eventchamp' ) . '</span>';
						$output .= '</div>';
						$output .= '<div class="gt-widget-content">';
							$output .= '<div class="gt-content-detail-box">';

								if( !empty( $event_tags ) ) {

									$output .= '<div class="gt-tags gt-' . esc_attr( $style ) . '">';
										$output .= '<ul>';

											foreach( $event_tags as $tag ) {

												if( !empty( $tag ) ) {

													$output .= '<li>';
														$output .= '<a href="' . esc_url( get_term_link( $tag->term_id ) . '?post_type=event' ) . '">' . esc_attr( $tag->name ) . '</a>';
													$output . '</li>';

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
* Event Social Sharing
*
======*/
if( !function_exists( 'eventchamp_event_social_sharing' ) ) {

	function eventchamp_event_social_sharing( $position = "position-1" ) {

		if( function_exists( 'eventchamp_social_share' ) ) {

			$event_social_share = ot_get_option( 'event_social_share' );
			$social_share_title = ot_get_option( 'event-social-share-text' );
			$social_share_style = ot_get_option( 'event-social-sharing-style', 'style-1' );
			$output = "";

			if( $event_social_share == "on" or $event_social_share !== "off" ) {

				if( $position == "position-1" ) {

					$output .= '<div class="gt-page-sharing">';

						if( !empty( $social_share_title ) ) {

							$output .= '<div class="gt-title">' . esc_attr( $social_share_title ) . '</div>';

						} else {

							$output .= '<div class="gt-title">' . esc_html__( 'Share This Event', 'eventchamp' ) . '</div>';

						}

						$output .= eventchamp_social_share( $style = $social_share_style );
					$output .= '</div>';

				} else {

					$output .= '<div class="gt-widget gt-detail-widget">';
						$output .= '<div class="gt-widget-title">';

							if( !empty( $social_share_title ) ) {

								$output .= '<span>' . esc_attr( $social_share_title ) . '</span>';

							} else {

								$output .= '<span>' . esc_html__( 'Share This Event', 'eventchamp' ) . '</span>';

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

}



/*======
*
* Related Events
*
======*/
if( !function_exists( 'eventchamp_related_events' ) ) {

	function eventchamp_related_events( $id = "" ) {

		$output = "";

		$hide_expired_events = ot_get_option( 'event-expired-events-archives', 'off' );

		$tags = wp_get_post_terms( esc_attr( $id ), 'event_tags' );
		$count = ot_get_option( 'event_related_events_count', '3' );
		$related_events = ot_get_option( 'event_related_events', 'on' );
		$related_events_style = ot_get_option( 'related_events_style', 'style-3' );
		$exclude_events = array( $id );

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

			$exclude_expired_events_ids = array_merge( $exclude_events, $expired_events_ids );

		} else {

			$exclude_expired_events_ids = $exclude_events;

		}

		if( $related_events == "on" ) {

			if ( !empty( $tags ) ) {

				$tag_ids = array();

				foreach( $tags as $tag ) {

					if ( !empty( $tag ) ) {

						$tag_ids[] = $tag->term_id;

					}

				}

				$args = array(
					'post__not_in' => $exclude_expired_events_ids,
					'post_status' => 'publish',
					'post_type' => 'event',
					'posts_per_page' => $count,
					'tax_query' => array(
						array(
							'taxonomy' => 'event_tags',
							'field' => 'term_id',
							'terms' => $tag_ids,
						),
					),
				);

				$query = new wp_query( $args );

				if( !empty( $query ) ) {

					$output .= '<div class="gt-related-events">';
						$output .= eventchamp_section_title( $primary_title = esc_html__( 'Related', 'eventchamp' ), $secondary_title = esc_html__( 'Events', 'eventchamp' ), $text = esc_html__( 'You might also love these events.', 'eventchamp' ), $style = "dark", $size = "size1", $align = "center", $separator = "true", $icon = "far fa-calendar-alt" );
							$output .= '<div class="gt-columns gt-column-' . esc_attr( $column_count ) . ' gt-column-space-30">';

							while( $query->have_posts() ) {

								$query->the_post();

								if( $related_events_style == "style-1" ) {

									$output .= '<div class="gt-col">';
										$output .= '<div class="gt-inner">';
											$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "true", $status = "true", $price = "false", $venue = "false" );
										$output .= '</div>';
									$output .= '</div>';

								} elseif( $related_events_style == "style-2" ) {

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

						$output .= '</div>';
					$output .= '</div>';

				}

			}
			wp_reset_postdata();

		}

		return $output;

	}

}



/*======
*
* Event Repeat Dates
*
======*/
if( !function_exists( 'eventchamp_event_repeat_dates' ) ) {

	function eventchamp_event_repeat_dates( $post_id = "" ) {

		if( !empty( $post_id ) ) {

			$output = "";
			$repeat_dates = get_post_meta( esc_attr( $post_id ), 'event_repeat_dates', true );

			if( !empty( $repeat_dates ) ) {

				$output .= '<div class="gt-event-repeat-dates">';
					$output .= '<ul>';

						foreach( $repeat_dates as $repeat_date ) {

							if( !empty( $repeat_date ) ) {

								$repeat_start_date = esc_attr( $repeat_date["event_repeat_date"] );
								$start_date = esc_attr( $repeat_date["event_repeat_start_date"] );
								$start_time = esc_attr( $repeat_date["event_repeat_start_time"] );
								$end_date = esc_attr( $repeat_date["event_repeat_end_date"] );
								$end_time = esc_attr( $repeat_date["event_repeat_end_time"] );
								$expire_date = esc_attr( $repeat_date["event_repeat_expire_date"] );

								$output .= '<li>';

									if( !empty( $start_date ) ) {

										$output .= '<span>';
											$output .= eventchamp_global_date_converter( $start_date );
										$output .= '</span>';

									}

									if( !empty( $end_date ) ) {

										$output .= '<span>';
											$output .= eventchamp_global_date_converter( $end_date );
										$output .= '</span>';

									}

								$output .= '</li>';

							}
							
						}

					$output .= '</ul>';
				$output .= '</div>';

			}

			return $output;

		}

	}

}



/*======
*
* Event Status
*
======*/
if( !function_exists( 'eventchamp_event_status' ) ) {

	function eventchamp_event_status( $post_id = "" ) {

		$event_status = ot_get_option( 'event-status', 'on' );

		if( $event_status == 'on' ) {

			if( !empty( $post_id ) ) {

				$output = "";
				$event_start_date = get_post_meta( esc_attr( $post_id ), 'event_start_date', true );
				$event_start_time = get_post_meta( esc_attr( $post_id ), 'event_start_time', true );
				$event_end_date = get_post_meta( esc_attr( $post_id ), 'event_end_date', true );
				$event_end_time = get_post_meta( esc_attr( $post_id ), 'event_end_time', true );
				$event_start_date_last = date_format( date_create( $event_start_date ), 'Y-m-d' );
				$event_end_date_last = date_format( date_create( $event_end_date ), 'Y-m-d' );
				$date_now = date( 'Y-m-d H:i' );

				if( !empty( $event_start_date ) and !empty( $event_start_time ) and !empty( $event_end_date ) and !empty( $event_end_time ) ) {

					$event_start_date_last = date_format( date_create( $event_start_date . $event_start_time ), 'Y-m-d H:i' );
					$event_end_date_last = date_format( date_create( $event_end_date . $event_end_time ), 'Y-m-d H:i' );

					$output .= '<div class="gt-event-status">';

						if( $event_start_date_last > $date_now ) {

							$output .= esc_html__( 'Upcoming', 'eventchamp' );

						} elseif( $date_now >= $event_start_date_last and $date_now <= $event_end_date_last ) {

							$output .= esc_html__( 'Showing', 'eventchamp' );

						} elseif( $event_start_date_last >= $date_now and $event_start_date_last <= $event_end_date_last ) {

							$output .= esc_html__( 'Showing', 'eventchamp' );

						} elseif( $event_start_date_last <= $date_now and $event_end_date_last >= $date_now ) {

							$output .= esc_html__( 'Showing', 'eventchamp' );

						} else {

							$output .= esc_html__( 'Expired', 'eventchamp' );

						}

					$output .= '</div>';

				}

				return $output;

			}

		}

	}

}



/*======
*
* Expired Event IDs
*
======*/
if( !function_exists( 'eventchamp_expired_event_ids' ) ) {

	function eventchamp_expired_event_ids() {

		$date_now = date( "Y-m-d H:i" );
		$ids = array();
		$args = array(
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'post_type' => 'event',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'event_expire_date',
					'compare' => '<',
					'type' => 'DATETIME',
					'value' => $date_now,
				),
			),
		);

		$wp_query = new WP_Query( $args );

		if( !empty( $wp_query ) ) {

			while ( $wp_query->have_posts() ) {

				$wp_query->the_post();
				$ids[] = get_the_ID();

			}

		}
		wp_reset_postdata();

		return $ids;

	}

}



/*======
*
* Hide Expired Events from Archives
*
======*/
if( !function_exists( 'eventchamp_expired_events_for_archives' ) ) {

	function eventchamp_expired_events_for_archives( $query ) {

		$expired_event_status = ot_get_option( 'event-expired-events-archives', 'off' );

		if( $expired_event_status == "off" ) {

			if ( is_admin() || ! $query->is_main_query() )

				return;

			if ( $query->is_archive() ) {

				$query->set( 'post__not_in', eventchamp_expired_event_ids() );

			}

		}

	}
	add_action( 'pre_get_posts', 'eventchamp_expired_events_for_archives', 1 );

}



/*======
*
* Order Type for Event Archives
*
======*/
if( !function_exists( 'eventchamp_event_archive_order_type' ) ) {

	function eventchamp_event_archive_order_type( $query ) {

		if( is_post_type_archive( 'event' ) or is_tax( 'event_tags' ) or is_tax( 'eventcat' ) or is_tax( 'organizer' ) ) {

			$order_type = ot_get_option( 'event-archive-order-type', 'start-date' );

			if ( is_admin() || ! $query->is_main_query() )

				return;

			if( $query->is_archive() ) {

				if( $order_type == "start-date" ) {

					$meta_query = array(
						'relation' => 'AND',
						'event_start_date_clause' => array(
							'key' => 'event_start_date',
						), 
						'event_start_time_clause' => array(
							'key' => 'event_start_time',
						),
					);

					$orderby = array(
						'event_start_date_clause' => 'ASC',
						'event_start_time_clause' => 'ASC',
					);

					$query->set( 'meta_query', $meta_query );
					$query->set( 'orderby', $orderby );

				} elseif( $order_type == "end-date" ) {

					$meta_query = array(
						'relation' => 'AND',
						'event_start_date_clause' => array(
							'key' => 'event_start_date',
						), 
						'event_start_time_clause' => array(
							'key' => 'event_start_time',
						),
					);

					$orderby = array(
						'event_start_date_clause' => 'DESC',
						'event_start_time_clause' => 'DESC',
					);

					$query->set( 'meta_query', $meta_query );
					$query->set( 'orderby', $orderby );

				}

			}

		}

	}
	add_action( 'pre_get_posts', 'eventchamp_event_archive_order_type', 1 );

}



/*======
*
* Get Event Terms
*
======*/
if( !function_exists( 'eventchamp_get_event_terms' ) ) {

	function eventchamp_get_event_terms( $event_id = "", $taxonomy = "", $link = "true", $html_output = "true" ) {

		if( !empty( $event_id ) and !empty( $taxonomy ) ) {

			$output = "";
			
			$terms = wp_get_post_terms( esc_attr( $event_id ), esc_attr( $taxonomy ) );

			if( !empty( $terms ) ) {

				if( $html_output == "true" ) {

					$output .= '<ul>';

				}

					$last_key = count( $terms ) - 1;

					foreach( $terms as $key => $term ) {

						if( !empty( $term ) ) {

							if( $html_output == "true" ) {

								$output .= '<li class="gt-term-' . esc_attr( $term->term_id ) . '">';

							}

								if( $link == "true" and $html_output == "true" ) {

									$output .= '<a href="' . get_term_link( $term->term_id ) . '?post_type=event">';

								}

									$output .= esc_attr( $term->name );

									if( $html_output == "false" and $key !== $last_key ) {

										$output .= ', ';

									}

								if( $link == "true" and $html_output == "true" ) {

									$output .= '</a>';

								}

							if( $html_output == "true" ) {

								$output .= '</li>';

							}

						}

					}

				if( $html_output == "true" ) {

					$output .= '</ul>';

				}

			}

			return $output;

		}

	}
	add_action( 'pre_get_posts', 'eventchamp_expired_events_for_archives', 1 );

}



/*======
*
* Get Event Meta Field
*
======*/
if( !function_exists( 'eventchamp_get_event_meta_field' ) ) {

	function eventchamp_get_event_meta_field( $event_id = "", $field = "" ) {

		if( !empty( $event_id ) ) {

			$output = "";

			$meta_field = get_post_meta( esc_attr( $event_id ), esc_attr( $field ), true );

			if( !empty( $meta_field ) ) {

				$output .= esc_attr( $meta_field );

			}

			return $output;

		}

	}

}



/*======
*
* Get Event Start Date
*
======*/
if( !function_exists( 'eventchamp_get_event_start_date' ) ) {

	function eventchamp_get_event_start_date( $event_id = "", $date_format = "" ) {

		if( !empty( $event_id ) ) {

			$output = "";

			$event_start_date = get_post_meta( esc_attr( $event_id ), 'event_start_date', true );

			if( !empty( $event_start_date ) ) {

				$output .= eventchamp_global_date_converter( $date = esc_attr( $event_start_date ), $date_format = esc_attr( $date_format ) );

			}

			return $output;

		}

	}

}



/*======
*
* Get Event Start Time
*
======*/
if( !function_exists( 'eventchamp_get_event_start_time' ) ) {

	function eventchamp_get_event_start_time( $event_id = "", $time_format = "" ) {

		if( !empty( $event_id ) ) {

			$output = "";

			$event_start_time = get_post_meta( esc_attr( $event_id ), 'event_start_time', true );

			if( !empty( $event_start_time ) ) {

				$output .= eventchamp_global_time_converter( $time = esc_attr( $event_start_time ), $time_format = esc_attr( $time_format ) );

			}

			return $output;

		}

	}

}



/*======
*
* Get Event End Date
*
======*/
if( !function_exists( 'eventchamp_get_event_end_date' ) ) {

	function eventchamp_get_event_end_date( $event_id = "", $date_format = "" ) {

		if( !empty( $event_id ) ) {

			$output = "";

			$event_end_date = get_post_meta( esc_attr( $event_id ), 'event_end_date', true );

			if( !empty( $event_end_date ) ) {

				$output .= eventchamp_global_date_converter( $date = esc_attr( $event_end_date ), $date_format = esc_attr( $date_format ) );

			}

			return $output;

		}

	}

}



/*======
*
* Get Event End Time
*
======*/
if( !function_exists( 'eventchamp_get_event_end_time' ) ) {

	function eventchamp_get_event_end_time( $event_id = "", $time_format = "" ) {

		if( !empty( $event_id ) ) {

			$output = "";

			$event_end_time = get_post_meta( esc_attr( $event_id ), 'event_end_time', true );

			if( !empty( $event_end_time ) ) {

				$output .= eventchamp_global_time_converter( $time = esc_attr( $event_end_time ), $time_format = esc_attr( $time_format ) );

			}

			return $output;

		}

	}

}