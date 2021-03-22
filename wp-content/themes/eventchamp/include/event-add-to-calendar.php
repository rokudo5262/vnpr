<?php
/*======
*
* Add to Calendar Button
*
======*/
if( !function_exists( 'eventchamp_add_to_calendar_button' ) ) {

	function eventchamp_add_to_calendar_button( $event_id = "", $style = "style-1" ) {

		$add_to_calendar = ot_get_option( 'event-add-to-calendar-status', 'on' );
		$add_to_calendar_google = ot_get_option( 'event-add-to-calendar-google', 'on' );
		$add_to_calendar_outlook = ot_get_option( 'event-add-to-calendar-outlook', 'on' );
		$add_to_calendar_apple = ot_get_option( 'event-add-to-calendar-apple', 'on' );
		$add_to_calendar_yahoo = ot_get_option( 'event-add-to-calendar-yahoo', 'on' );
		$add_to_calendar_ics = ot_get_option( 'event-add-to-calendar-ics', 'on' );

		if( $add_to_calendar == "on" ) {

			if( $add_to_calendar_google == "on" or $add_to_calendar_outlook == "on" or $add_to_calendar_apple == "on" or $add_to_calendar_yahoo == "on" or $add_to_calendar_ics == "on" ) {

				if( !empty( $event_id ) ) {

					$output = "";

					$output .= '<div class="gt-add-to-calendar">';
						$output .= '<div class="gt-button gt-full gt-align-center gt-' . esc_attr( $style ) . '">';
							$output .= '<a href="" data-target="#gt-add-to-calendar-popup" data-toggle="modal">' . esc_html__( 'Add to Calendar', 'eventchamp' ) . '</a>';
						$output .= '</div>';
					$output .= '</div>';

					return $output;

				}

			}

		}

	}

}



/*======
*
* Add to Calendar Popup
*
======*/
if( !function_exists( 'eventchamp_add_to_calendar_popup' ) ) {

	function eventchamp_add_to_calendar_popup( $event_id = "" ) {

		$add_to_calendar_google = ot_get_option( 'event-add-to-calendar-google', 'on' );
		$add_to_calendar_outlook = ot_get_option( 'event-add-to-calendar-outlook', 'on' );
		$add_to_calendar_apple = ot_get_option( 'event-add-to-calendar-apple', 'on' );
		$add_to_calendar_yahoo = ot_get_option( 'event-add-to-calendar-yahoo', 'on' );
		$add_to_calendar_ics = ot_get_option( 'event-add-to-calendar-ics', 'on' );

		if( $add_to_calendar_google == "on" or $add_to_calendar_outlook == "on" or $add_to_calendar_apple == "on" or $add_to_calendar_yahoo == "on" or $add_to_calendar_ics == "on" ) {

			if( !empty( $event_id ) ) {

				$output = "";

				/*====== Get Meta Data ======*/
				$google_date = "";
				$outlook_start_date = "";
				$outlook_end_date = "";
				$yahoo_start_date = "";
				$yahoo_end_date = "";
				$ics_start_date = "";
				$ics_end_date = "";
				$location = "";
				$excerpt = "";

				if( !empty( eventchamp_get_event_start_date( $event_id = esc_attr( $event_id ) ) and eventchamp_get_event_start_time( $event_id = esc_attr( $event_id ) ) and eventchamp_get_event_end_date( $event_id = esc_attr( $event_id ) ) and eventchamp_get_event_end_time( $event_id = esc_attr( $event_id ) ) ) ) {

					$google_date = eventchamp_get_event_start_date( $event_id = esc_attr( $event_id ), $date_format = "Ymd" ) . 'T' . eventchamp_get_event_start_time( $event_id = esc_attr( $event_id ), $time_format = "Hi00" ) . '/' . eventchamp_get_event_end_date( $event_id = esc_attr( $event_id ), $date_format = "Ymd" ) . 'T' . eventchamp_get_event_end_time( $event_id = esc_attr( $event_id ), $time_format = "Hi00" );

				}

				if( !empty( eventchamp_get_event_start_date( $event_id = esc_attr( $event_id ) ) and eventchamp_get_event_start_time( $event_id = esc_attr( $event_id ) ) ) ) {

					$outlook_start_date = eventchamp_get_event_start_date( $event_id = esc_attr( $event_id ), $date_format = "Ymd" ) . 'T' . eventchamp_get_event_start_time( $event_id = esc_attr( $event_id ), $time_format = "Hi00" ) . 'Z';

				}

				if( !empty( eventchamp_get_event_end_date( $event_id = esc_attr( $event_id ) ) and eventchamp_get_event_end_time( $event_id = esc_attr( $event_id ) ) ) ) {

					$outlook_end_date = eventchamp_get_event_end_date( $event_id = esc_attr( $event_id ), $date_format = "Ymd" ) . 'T' . eventchamp_get_event_end_time( $event_id = esc_attr( $event_id ), $time_format = "Hi00" ) . 'Z';

				}

				if( !empty( eventchamp_get_event_start_date( $event_id = esc_attr( $event_id ) ) and eventchamp_get_event_start_time( $event_id = esc_attr( $event_id ) ) ) ) {

					$yahoo_start_date = eventchamp_get_event_start_date( $event_id = esc_attr( $event_id ), $date_format = "Ymd" ) . 'T' . eventchamp_get_event_start_time( $event_id = esc_attr( $event_id ), $time_format = "Hi00" ) . 'Z';

				}

				if( !empty( eventchamp_get_event_end_date( $event_id = esc_attr( $event_id ) ) and eventchamp_get_event_end_time( $event_id = esc_attr( $event_id ) ) ) ) {

					$yahoo_end_date = eventchamp_get_event_end_date( $event_id = esc_attr( $event_id ), $date_format = "Ymd" ) . 'T' . eventchamp_get_event_end_time( $event_id = esc_attr( $event_id ), $time_format = "Hi00" ) . 'Z';

				}

				if( !empty( eventchamp_get_event_start_date( $event_id = esc_attr( $event_id ) ) and eventchamp_get_event_start_time( $event_id = esc_attr( $event_id ) ) ) ) {

					$ics_start_date = eventchamp_get_event_start_date( $event_id = esc_attr( $event_id ), $date_format = "d/m/Y" ) . ' ' . eventchamp_get_event_start_time( $event_id = esc_attr( $event_id ), $time_format = "H:i" );

				}

				if( !empty( eventchamp_get_event_end_date( $event_id = esc_attr( $event_id ) ) and eventchamp_get_event_end_time( $event_id = esc_attr( $event_id ) ) ) ) {

					$ics_end_date = eventchamp_get_event_end_date( $event_id = esc_attr( $event_id ), $date_format = "d/m/Y" ) . ' ' . eventchamp_get_event_end_time( $event_id = esc_attr( $event_id ), $time_format = "H:i" );

				}

				if( !empty( eventchamp_get_event_meta_field( $event_id = esc_attr( $event_id ), $field = "event_detailed_address" ) ) ) {

					$location = eventchamp_get_event_meta_field( $event_id = esc_attr( $event_id ), $field = "event_detailed_address" );

				}

				if( !empty( get_the_excerpt( esc_attr( $event_id ) ) ) ) {

					$excerpt = sprintf( esc_html__( '%2$s For details, go here: %1$s', 'eventchamp' ), get_the_permalink( esc_attr( $event_id ) ), esc_attr( get_post_field( 'post_excerpt', $event_id, 'display' ) ) );

				}

				/*====== URL Create ======*/
				$google_calendar_url = esc_url( 'http://www.google.com/calendar/render?action=TEMPLATE&text=' . 
					get_the_title( esc_attr( $event_id ) ) . 
					( !empty( $google_date ) ? '&dates=' . esc_attr( $google_date ) . '' : '' ) . 
					( !empty( $location ) ? '&location=' . esc_attr( $location ) . '' : '' ) . 
					( !empty( $excerpt ) ? '&details=' . esc_attr( $excerpt ) . '' : '' ) . 
					'sf=true' );

				$outlook_url = esc_url( 'https://outlook.live.com/owa/?path=/calendar/view/Month&rru=addevent&subject=' . 
					get_the_title( esc_attr( $event_id ) ) . 
					( !empty( $outlook_start_date ) ? '&startdt=' . esc_attr( $outlook_start_date ) . '' : '' ) . 
					( !empty( $outlook_end_date ) ? '&enddt=' . esc_attr( $outlook_end_date ) . '' : '' ) . 
					( !empty( $location ) ? '&location=' . esc_attr( $location ) . '' : '' ) . 
					( !empty( $excerpt ) ? '&body=' . esc_attr( $excerpt ) . '' : '' ) 
					);

				$yahoo_url = esc_url( 'https://calendar.yahoo.com/?v=60&title=' . 
					get_the_title( esc_attr( $event_id ) ) . 
					( !empty( $yahoo_start_date ) ? '&st=' . esc_attr( $yahoo_start_date ) . '' : '' ) . 
					( !empty( $yahoo_end_date ) ? '&et=' . esc_attr( $yahoo_end_date ) . '' : '' ) . 
					( !empty( $location ) ? '&in_loc=' . esc_attr( $location ) . '' : '' ) . 
					( !empty( $excerpt ) ? '&desc=' . esc_attr( $excerpt ) . '' : '' ) 
					);

				/*====== ICS File Create ======*/
				if( $add_to_calendar_apple == "on" or $add_to_calendar_ics == "on" ) {

					wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
						gt_event_ics = ics();
						gt_event_ics.addEvent( '" . get_the_title( esc_attr( $event_id ) ) . "', '" . str_replace( "

", " ", $excerpt ) . "', '" . esc_attr( $location ) . "', '" . esc_attr( $ics_start_date ) . "', '" . esc_attr( $ics_end_date ) . "' );
					});" );

				}

				/*====== HTML Output ======*/
				$output .= '<div class="modal fade gt-modal gt-add-to-calendar-modal" id="gt-add-to-calendar-popup" tabindex="-1" role="dialog" aria-labelledby="' . esc_html__( 'Sign In', 'eventchamp' ) . '" aria-hidden="true">';
					$output .= '<div class="modal-dialog gt-modal-dialog modal-dialog-centered" role="document">';
						$output .= '<div class="modal-content gt-modal-content">';
							$output .= '<div class="modal-header gt-modal-header">';
								$output .= '<div class="gt-modal-title">' . esc_html__( 'Add to Calendar', 'eventchamp' ) . '</div>';
								$output .= '<button type="button" class="gt-close" data-dismiss="modal" aria-label="' . esc_html__( 'Close', 'eventchamp' ) . '">';
									$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 371.23 371.23" xml:space="preserve"> <polygon points="371.23,21.213 350.018,0 185.615,164.402 21.213,0 0,21.213 164.402,185.615 0,350.018 21.213,371.23 185.615,206.828 350.018,371.23 371.23,350.018 206.828,185.615 "/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
								$output .= '</button>';
							$output .= '</div>';
							$output .= '<div class="modal-body gt-modal-body">';
								$output .= '<div class="gt-add-to-calendar gt-style-1">';
									$output .= '<ul>';

										if( $add_to_calendar_google == "on" ) {

											$output .= '<li>';
												$output .= '<a href="' . esc_url( $google_calendar_url ) . '" target="_blank">';
													$output .= '<div class="gt-content">';
														$output .= '<div class="gt-icon">';
															$output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g> <g> <g> <path d="M490.771,298.667l20.833-156.177c0.271-2.094,0.396-4.208,0.396-6.323c0-17.007-8.471-31.999-21.333-41.232V42.667 C490.667,19.135,471.521,0,448,0H64C40.479,0,21.333,19.135,21.333,42.667v52.268C8.471,104.168,0,119.16,0,136.167 c0,2.115,0.125,4.229,0.396,6.385l20.833,156.115L0.396,454.844C0.125,456.938,0,459.052,0,461.167 C0,489.198,22.813,512,50.833,512h410.333C489.188,512,512,489.198,512,461.167c0-2.115-0.125-4.229-0.396-6.385L490.771,298.667 z M42.667,42.667c0-11.76,9.563-21.333,21.333-21.333h384c11.771,0,21.333,9.573,21.333,21.333V86.16 c-2.674-0.438-5.37-0.827-8.167-0.827H50.833c-2.797,0-5.492,0.389-8.167,0.827V42.667z M469.417,300.073l21.021,157.458 c0.146,1.198,0.229,2.417,0.229,3.635c0,16.271-13.229,29.5-29.5,29.5H50.833c-16.271,0-29.5-13.229-29.5-29.5 c0-1.219,0.083-2.438,0.208-3.573l21.042-157.521c0.104-0.927,0.104-1.885,0-2.813L21.563,139.802 c-0.146-1.198-0.229-2.417-0.229-3.635c0-16.271,13.229-29.5,29.5-29.5h410.333c16.271,0,29.5,13.229,29.5,29.5 c0,1.219-0.083,2.438-0.208,3.573L469.417,297.26C469.313,298.188,469.313,299.146,469.417,300.073z"/> <path d="M256,245.333c0-35.292-28.708-64-64-64s-64,28.708-64,64c0,5.896,4.771,10.667,10.667,10.667 c5.896,0,10.667-4.771,10.667-10.667c0-23.531,19.146-42.667,42.667-42.667s42.667,19.135,42.667,42.667S215.521,288,192,288 c-5.896,0-10.667,4.771-10.667,10.667c0,5.896,4.771,10.667,10.667,10.667c23.521,0,42.667,19.135,42.667,42.667 S215.521,394.667,192,394.667S149.333,375.531,149.333,352c0-5.896-4.771-10.667-10.667-10.667 c-5.896,0-10.667,4.771-10.667,10.667c0,35.292,28.708,64,64,64s64-28.708,64-64c0-22.264-11.454-41.865-28.751-53.333 C244.546,287.198,256,267.598,256,245.333z"/> <path d="M378.375,182.594c-3.479-1.854-7.667-1.646-10.958,0.531l-64,42.667c-4.896,3.271-6.229,9.885-2.958,14.792 c3.271,4.896,9.917,6.188,14.792,2.958l47.417-31.615v193.406c0,5.896,4.771,10.667,10.667,10.667 c5.896,0,10.667-4.771,10.667-10.667V192C384,188.063,381.833,184.448,378.375,182.594z"/> <circle cx="138.667" cy="53.333" r="10.667"/> <circle cx="373.333" cy="53.333" r="10.667"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
														$output .= '</div>';
														$output .= '<span>';
															$output .= esc_html__( 'Google Calendar', 'eventchamp' );
														$output .= '</span>';
													$output .= '</div>';
													$output .= '<div class="gt-more">';
														$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
													$output .= '</div>';
												$output .= '</a>';
											$output .= '</li>';

										}

										if( $add_to_calendar_outlook == "on" ) {

											$output .= '<li>';
												$output .= '<a href="' . esc_url( $outlook_url ) . '" target="_blank">';
													$output .= '<div class="gt-content">';
														$output .= '<div class="gt-icon">';
															$output .= '<svg version="1.1" x="0px" y="0px" viewBox="0 0 103.17322 104.31332"  xml:space="preserve" inkscape:version="0.48.2 r9819"><metadata id="metadata45"><rdf:RDF><cc:Work rdf:about=""><dc:format>image/svg+xml</dc:format><dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage" /><dc:title></dc:title></cc:Work></rdf:RDF></metadata><defs id="defs43" /><sodipodi:namedview borderopacity="1" objecttolerance="10" gridtolerance="10" guidetolerance="10" inkscape:pageopacity="0" inkscape:pageshadow="2" inkscape:window-width="1600" inkscape:window-height="837" id="namedview41" showgrid="false" fit-margin-top="0" fit-margin-left="0" fit-margin-right="0" fit-margin-bottom="0" inkscape:zoom="1" inkscape:cx="91.558992" inkscape:cy="89.87632" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1" inkscape:current-layer="Layer_1" /> <path d="m 64.566509,22.116383 v 20.404273 l 7.130526,4.489881 c 0.188058,0.05485 0.595516,0.05877 0.783574,0 L 103.16929,26.320259 c 0,-2.44867 -2.28412,-4.203876 -3.573094,-4.203876 H 64.566509 z" id="path3" inkscape:connector-curvature="0" /> <path d="m 64.566509,50.13308 6.507584,4.470291 c 0.916782,0.673874 2.021622,0 2.021622,0 -1.100922,0.673874 30.077495,-20.035993 30.077495,-20.035993 v 37.501863 c 0,4.082422 -2.61322,5.794531 -5.551621,5.794531 H 64.562591 V 50.13308 z" id="path5" inkscape:connector-curvature="0" /> <g id="g23" transform="matrix(3.9178712,0,0,3.9178712,-13.481403,-41.384473)"> <path d="m 11.321,20.958 c -0.566,0 -1.017,0.266 -1.35,0.797 -0.333,0.531 -0.5,1.234 -0.5,2.109 0,0.888 0.167,1.59 0.5,2.106 0.333,0.517 0.77,0.774 1.31,0.774 0.557,0 0.999,-0.251 1.325,-0.753 0.326,-0.502 0.49,-1.199 0.49,-2.09 0,-0.929 -0.158,-1.652 -0.475,-2.169 -0.317,-0.516 -0.75,-0.774 -1.3,-0.774 z" id="path25" inkscape:connector-curvature="0" /> <path d="m 3.441,13.563 v 20.375 l 15.5,3.25 V 10.563 l -15.5,3 z m 10.372,13.632 c -0.655,0.862 -1.509,1.294 -2.563,1.294 -1.027,0 -1.863,-0.418 -2.51,-1.253 C 8.094,26.4 7.77,25.312 7.77,23.97 c 0,-1.417 0.328,-2.563 0.985,-3.438 0.657,-0.875 1.527,-1.313 2.61,-1.313 1.023,0 1.851,0.418 2.482,1.256 0.632,0.838 0.948,1.942 0.948,3.313 10e-4,1.409 -0.327,2.545 -0.982,3.407 z" id="path27" inkscape:connector-curvature="0" /> </g> </svg>';
														$output .= '</div>';
														$output .= '<span>';
															$output .= esc_html__( 'Outlook Calendar', 'eventchamp' );
														$output .= '</span>';
													$output .= '</div>';
													$output .= '<div class="gt-more">';
														$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
													$output .= '</div>';
												$output .= '</a>';
											$output .= '</li>';

										}

										if( $add_to_calendar_apple == "on" ) {

											$output .= '<li class="gt-apple-calendar">';
												$output .= '<a href="javascript:void(0);" onclick="javascript:gt_event_ics.download()">';
													$output .= '<div class="gt-content">';
														$output .= '<div class="gt-icon">';
															$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"></path></svg>';
														$output .= '</div>';
														$output .= '<span>';
															$output .= esc_html__( 'Apple Calendar', 'eventchamp' );
														$output .= '</span>';
													$output .= '</div>';
													$output .= '<div class="gt-more">';
														$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
													$output .= '</div>';
												$output .= '</a>';
											$output .= '</li>';

										}

										if( $add_to_calendar_yahoo == "on" ) {

											$output .= '<li class="gt-yahoo-calendar">';
												$output .= '<a href="' . esc_url( $yahoo_url ) . '" target="_blank">';
													$output .= '<div class="gt-content">';
														$output .= '<div class="gt-icon">';
															$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M252 292l4 220c-12.7-2.2-23.5-3.9-32.3-3.9-8.4 0-19.2 1.7-32.3 3.9l4-220C140.4 197.2 85 95.2 21.4 0c11.9 3.1 23 3.9 33.2 3.9 9 0 20.4-.8 34.1-3.9 40.9 72.2 82.1 138.7 135 225.5C261 163.9 314.8 81.4 358.6 0c11.1 2.9 22 3.9 32.9 3.9 11.5 0 23.2-1 35-3.9C392.1 47.9 294.9 216.9 252 292z"></path></svg>';
														$output .= '</div>';
														$output .= '<span>';
															$output .= esc_html__( 'Yahoo Calendar', 'eventchamp' );
														$output .= '</span>';
													$output .= '</div>';
													$output .= '<div class="gt-more">';
														$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
													$output .= '</div>';
												$output .= '</a>';
											$output .= '</li>';

										}

										if( $add_to_calendar_ics == "on" ) {

											$output .= '<li class="gt-ics-export">';
												$output .= '<a href="javascript:void(0);" onclick="javascript:gt_event_ics.download()">';
													$output .= '<div class="gt-content">';
														$output .= '<div class="gt-icon">';
															$output .= '<svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g sketch:type="MSArtboardGroup" fill="currentColor"> <path d="M21,13 L21,10 L21,10 L15,3 L4.00276013,3 C2.89666625,3 2,3.89833832 2,5.00732994 L2,27.9926701 C2,29.1012878 2.89092539,30 3.99742191,30 L19.0025781,30 C20.1057238,30 21,29.1017876 21,28.0092049 L21,26 L28.9931517,26 C30.6537881,26 32,24.6577357 32,23.0012144 L32,15.9987856 C32,14.3426021 30.6640085,13 28.9931517,13 L21,13 L21,13 L21,13 Z M20,26 L20,28.0066023 C20,28.5550537 19.5523026,29 19.0000398,29 L3.9999602,29 C3.45470893,29 3,28.5543187 3,28.004543 L3,4.99545703 C3,4.45526288 3.44573523,4 3.9955775,4 L14,4 L14,8.99408095 C14,10.1134452 14.8944962,11 15.9979131,11 L20,11 L20,13 L12.0068483,13 C10.3462119,13 9,14.3422643 9,15.9987856 L9,23.0012144 C9,24.6573979 10.3359915,26 12.0068483,26 L20,26 L20,26 L20,26 Z M15,4.5 L15,8.99121523 C15,9.54835167 15.4506511,10 15.9967388,10 L19.6999512,10 L15,4.5 L15,4.5 Z M11.9945615,14 C10.8929956,14 10,14.9001762 10,15.992017 L10,23.007983 C10,24.1081436 10.9023438,25 11.9945615,25 L29.0054385,25 C30.1070044,25 31,24.0998238 31,23.007983 L31,15.992017 C31,14.8918564 30.0976562,14 29.0054385,14 L11.9945615,14 L11.9945615,14 Z M14,17 L14,22 L13,22 L13,23 L16,23 L16,22 L15,22 L15,17 L16,17 L16,16 L13,16 L13,17 L14,17 L14,17 Z M21.9999916,21 C21.9968339,22.1165689 21.1004316,23 19.9951185,23 L19.0048815,23 C17.8938998,23 17,22.1019194 17,20.9940809 L17,18.0059191 C17,16.8865548 17.897616,16 19.0048815,16 L19.9951185,16 C21.1041209,16 21.9968142,16.8948834 21.9999915,18 L21,18 C21,17.4476291 20.5573397,17 20.0010434,17 L18.9989566,17 C18.4472481,17 18,17.4437166 18,17.9998075 L18,21.0001925 C18,21.5523709 18.4426603,22 18.9989566,22 L20.0010434,22 C20.5527519,22 21,21.5562834 21,21.0001925 L21.9999923,21 L21.9999916,21 L21.9999916,21 Z M25.0048815,16 C23.897616,16 23,16.8877296 23,18 C23,19.1045695 23.8877296,20 25,20 L25.9906311,20 C26.5480902,20 27,20.4438648 27,21 C27,21.5522847 26.5573397,22 26.0010434,22 L24.9989566,22 C24.4472481,22 24,21.543716 24,21.0044713 L24,20.9931641 L23,20.9931641 L23,20.998921 C23,22.1040864 23.8938998,23 25.0048815,23 L25.9951185,23 C27.102384,23 28,22.1122704 28,21 C28,19.8954305 27.1122704,19 26,19 L25.0093689,19 C24.4519098,19 24,18.5561352 24,18 C24,17.4477153 24.4426603,17 24.9989566,17 L26.0010434,17 C26.5527519,17 27,17.453186 27,18 L28,18 C28,16.8954305 27.1061002,16 25.9951185,16 L25.0048815,16 L25.0048815,16 Z" sketch:type="MSShapeGroup"></path> </g> </g> </svg>';
														$output .= '</div>';
														$output .= '<span>';
															$output .= esc_html__( 'ICS Export', 'eventchamp' );
														$output .= '</span>';
													$output .= '</div>';
													$output .= '<div class="gt-more">';
														$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
													$output .= '</div>';
												$output .= '</a>';
											$output .= '</li>';

										}

									$output .= '</ul>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';

				return $output;

			}

		}

	}

}



if( !function_exists( 'eventchamp_add_to_calendar' ) ) {

	function eventchamp_add_to_calendar() {

		if( is_singular( 'event' ) ) {

			$add_to_calendar = ot_get_option( 'event-add-to-calendar-status', 'on' );

			if( $add_to_calendar == "on" ) {

				echo eventchamp_add_to_calendar_popup( $event_id = get_the_ID() );

			}

		}

	}
	add_action( 'wp_footer', 'eventchamp_add_to_calendar' );

}



/*======
*
* Add to Calendar Scripts
*
======*/
if( !function_exists( 'eventchamp_add_to_calendar_scripts' ) ) {

	function eventchamp_add_to_calendar_scripts() {

		$add_to_calendar = ot_get_option( 'event-add-to-calendar-status', 'on' );
		$add_to_calendar_apple = ot_get_option( 'event-add-to-calendar-apple', 'on' );
		$add_to_calendar_ics = ot_get_option( 'event-add-to-calendar-ics', 'on' );

		if( $add_to_calendar == "on" ) {

			if( $add_to_calendar_apple == "on" or $add_to_calendar_ics == "on" ) {

				wp_enqueue_script( 'ics', get_template_directory_uri() . '/include/assets/js/ics.deps.min.js', array(), false, true );

			}

		}

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_add_to_calendar_scripts' );

}