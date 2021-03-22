<?php
/*======
*
* Header
*
======*/
if( !function_exists( 'eventchamp_header' ) ) {

	function eventchamp_header() {

		if( !function_exists( 'eventchamp_header_style_1' ) ) {

			function eventchamp_header_style_1() {

				$output = "";

				$hide_header_logo = ot_get_option( 'hide_header_logo', 'on' );
				$menu_location = "";
				$header_gap = "";

				if ( is_page() or is_single() ) {

					$menu_location = get_post_meta( get_the_ID(), 'page_menu_location', true );
					$header_gap = get_post_meta( get_the_ID(), 'header_gap', true );

				}
			
				if( $menu_location == "onepage" ) {

					$location = "onepagemenu";

				} else {

					$location = "mainmenu";

				}

				if( $header_gap == "on" or empty( $header_gap ) ) {

					$output .= '<header class="gt-header gt-style-1">';

				} else {

					$output .= '<header class="gt-header gt-style-1 gt-remove-gap">';

				}

					$output .= '<div class="container gt-container">';

						if( $hide_header_logo == "on" ) {

							$output .= eventchamp_header_logo();

						}

						$output .= '<div class="gt-content">';
							$output .= '<div class="gt-elements">';
								$output .= eventchamp_header_elements();
							$output .= '</div>';
							$output .= '<nav class="gt-navbar">';
								$output .= wp_nav_menu(
									array(
										'menu' => 'mainmenu',
										'theme_location' => $location,
										'depth' => 5,
										'echo' => false,
										'menu_class' => 'gt-menu',
										'fallback_cb' => 'eventchamp_walker::fallback',
										'walker' => new eventchamp_walker(),
									)
								);
							$output .= '</nav>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</header>';

				return $output;

			}

		}



		if( !function_exists( 'eventchamp_header_style_2' ) ) {

			function eventchamp_header_style_2() {

				$output = "";

				$hide_header_logo = ot_get_option( 'hide_header_logo', 'on' );
				$menu_location = "";
				$header_gap = "";

				if ( is_page() or is_single() ) {

					$menu_location = get_post_meta( get_the_ID(), 'page_menu_location', true );
					$header_gap = get_post_meta( get_the_ID(), 'header_gap', true );

				}
			
				if( $menu_location == "onepage" ) {
					$location = "onepagemenu";
				} else {
					$location = "mainmenu";
				}

				if( $header_gap == "on" or empty( $header_gap ) ) {

					$output .= '<header class="gt-header gt-style-1 gt-style-2">';

				} else {

					$output .= '<header class="gt-header gt-style-1 gt-style-2 gt-remove-gap">';

				}

					$output .= '<div class="container gt-container">';

						if( $hide_header_logo == "on" ) {

							$output .= eventchamp_header_alternative_logo();
							$output .= eventchamp_header_logo();

						}

						$output .= '<div class="gt-content">';
							$output .= '<div class="gt-elements">';
								$output .= eventchamp_header_elements();
							$output .= '</div>';
							$output .= '<nav class="gt-navbar">';
								$output .= wp_nav_menu(
									array(
										'menu' => 'mainmenu',
										'theme_location' => $location,
										'depth' => 5,
										'echo' => false,
										'menu_class' => 'gt-menu',
										'fallback_cb' => 'eventchamp_walker::fallback',
										'walker' => new eventchamp_walker(),
									)
								);
							$output .= '</nav>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</header>';

				return $output;

			}

		}



		if( !function_exists( 'eventchamp_header_style_3' ) ) {

			function eventchamp_header_style_3() {

				$output = "";

				$hide_header_logo = ot_get_option( 'hide_header_logo', 'on' );
				$menu_location = "";
				$header_gap = "";

				if ( is_page() or is_single() ) {

					$menu_location = get_post_meta( get_the_ID(), 'page_menu_location', true );
					$header_gap = get_post_meta( get_the_ID(), 'header_gap', true );

				}
			
				if( $menu_location == "onepage" ) {
					$location = "onepagemenu";
				} else {
					$location = "mainmenu";
				}

				if( $header_gap == "on" or empty( $header_gap ) ) {

					$output .= '<header class="gt-header gt-style-3">';

				} else {

					$output .= '<header class="gt-header gt-style-3 gt-remove-gap">';

				}

					$output .= '<div class="container gt-container">';

						if( $hide_header_logo == "on" ) {

							$output .= eventchamp_header_logo();

						}

						$output .= '<div class="gt-content">';
							$output .= '<nav class="gt-navbar">';
								$output .= wp_nav_menu(
									array(
										'menu' => 'mainmenu',
										'theme_location' => $location,
										'depth' => 5,
										'echo' => false,
										'menu_class' => 'gt-menu',
										'fallback_cb' => 'eventchamp_walker::fallback',
										'walker' => new eventchamp_walker(),
									)
								);
							$output .= '</nav>';
							$output .= '<div class="gt-elements">';
								$output .= eventchamp_header_elements();
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</header>';

				return $output;

			}

		}



		if( !function_exists( 'eventchamp_header_style_4' ) ) {

			function eventchamp_header_style_4() {

				$output = "";

				$hide_header_logo = ot_get_option( 'hide_header_logo', 'on' );
				$menu_location = "";
				$header_gap = "";

				if ( is_page() or is_single() ) {

					$menu_location = get_post_meta( get_the_ID(), 'page_menu_location', true );
					$header_gap = get_post_meta( get_the_ID(), 'header_gap', true );

				}
			
				if( $menu_location == "onepage" ) {
					$location = "onepagemenu";
				} else {
					$location = "mainmenu";
				}

				if( $header_gap == "on" or empty( $header_gap ) ) {

					$output .= '<header class="gt-header gt-style-3 gt-style-4">';

				} else {

					$output .= '<header class="gt-header gt-style-3 gt-style-4 gt-remove-gap">';

				}

					$output .= '<div class="container gt-container">';

						if( $hide_header_logo == "on" ) {

							$output .= eventchamp_header_alternative_logo();
							$output .= eventchamp_header_logo();

						}

						$output .= '<div class="gt-content">';
							$output .= '<nav class="gt-navbar">';
								$output .= wp_nav_menu(
									array(
										'menu' => 'mainmenu',
										'theme_location' => $location,
										'depth' => 5,
										'echo' => false,
										'menu_class' => 'gt-menu',
										'fallback_cb' => 'eventchamp_walker::fallback',
										'walker' => new eventchamp_walker(),
									)
								);
							$output .= '</nav>';
							$output .= '<div class="gt-elements">';
								$output .= eventchamp_header_elements();
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</header>';

				return $output;

			}

		}



		if( !function_exists( 'eventchamp_header_style_5' ) ) {

			function eventchamp_header_style_5() {

				$output = "";

				$hide_header_logo = ot_get_option( 'hide_header_logo', 'on' );
				$menu_location = "";
				$header_gap = "";

				if ( is_page() or is_single() ) {

					$menu_location = get_post_meta( get_the_ID(), 'page_menu_location', true );
					$header_gap = get_post_meta( get_the_ID(), 'header_gap', true );

				}
			
				if( $menu_location == "onepage" ) {
					$location = "onepagemenu";
				} else {
					$location = "mainmenu";
				}

				if( $header_gap == "on" or empty( $header_gap ) ) {

					$output .= '<header class="gt-header gt-style-5">';

				} else {

					$output .= '<header class="gt-header gt-style-5 gt-remove-gap">';

				}

					$output .= '<div class="container gt-container">';

						if( $hide_header_logo == "on" ) {

							$output .= eventchamp_header_logo();

						}

						$output .= '<div class="gt-content">';
							$output .= '<nav class="gt-navbar">';
								$output .= wp_nav_menu(
									array(
										'menu' => 'mainmenu',
										'theme_location' => $location,
										'depth' => 5,
										'echo' => false,
										'menu_class' => 'gt-menu',
										'fallback_cb' => 'eventchamp_walker::fallback',
										'walker' => new eventchamp_walker(),
									)
								);
							$output .= '</nav>';
							$output .= '<div class="gt-elements">';
								$output .= eventchamp_header_elements();
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</header>';

				return $output;

			}

		}



		if( !function_exists( 'eventchamp_header_style_6' ) ) {

			function eventchamp_header_style_6() {

				$output = "";

				$hide_header_logo = ot_get_option( 'hide_header_logo', 'on' );
				$menu_location = "";
				$header_gap = "";

				if ( is_page() or is_single() ) {

					$menu_location = get_post_meta( get_the_ID(), 'page_menu_location', true );
					$header_gap = get_post_meta( get_the_ID(), 'header_gap', true );

				}
			
				if( $menu_location == "onepage" ) {
					$location = "onepagemenu";
				} else {
					$location = "mainmenu";
				}

				if( $header_gap == "on" or empty( $header_gap ) ) {

					$output .= '<header class="gt-header gt-style-5 gt-style-6">';

				} else {

					$output .= '<header class="gt-header gt-style-5 gt-style-6 gt-remove-gap">';

				}

					$output .= '<div class="container gt-container">';

						if( $hide_header_logo == "on" ) {

							$output .= eventchamp_header_alternative_logo();
							$output .= eventchamp_header_logo();

						}

						$output .= '<div class="gt-content">';
							$output .= '<nav class="gt-navbar">';
								$output .= wp_nav_menu(
									array(
										'menu' => 'mainmenu',
										'theme_location' => $location,
										'depth' => 5,
										'echo' => false,
										'menu_class' => 'gt-menu',
										'fallback_cb' => 'eventchamp_walker::fallback',
										'walker' => new eventchamp_walker(),
									)
								);
							$output .= '</nav>';
							$output .= '<div class="gt-elements">';
								$output .= eventchamp_header_elements();
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</header>';

				return $output;

			}

		}



		if ( is_page() ) {

			$header_style = get_post_meta( get_the_ID(), 'header_layout_select', true );
			$header_status = get_post_meta( get_the_ID(), 'header_status', true );

			if( empty( $header_style ) or $header_style == "default" ) {

				$header_style = ot_get_option( 'header_layout_select' , 'header-style-1' );

			}

			if( empty( $header_status ) or $header_status == "default" ) {

				$header_status = ot_get_option( 'hide_header' , 'on' );

			}

		} else {

			$header_style = ot_get_option( 'header_layout_select' , 'header-style-1' );
			$header_status = ot_get_option( 'hide_header' , 'on' );

		}

		if( $header_status == "on" ) {

			if( $header_style == "header-style-1" ) {

				$output = eventchamp_header_style_1();

				return $output;

			} elseif( $header_style == "header-style-2" ) {

				$output = eventchamp_header_style_2();

				return $output;

			} elseif( $header_style == "header-style-3" ) {

				$output = eventchamp_header_style_3();

				return $output;

			} elseif( $header_style == "header-style-4" ) {

				$output = eventchamp_header_style_4();

				return $output;

			} elseif( $header_style == "header-style-5" ) {

				$output = eventchamp_header_style_5();

				return $output;

			} elseif( $header_style == "header-style-6" ) {

				$output = eventchamp_header_style_6();

				return $output;

			}

		}

	}

}



/*======
*
* Sticky Header
*
======*/
if( !function_exists( 'eventchamp_sticky_header' ) ) {

	function eventchamp_sticky_header() {

		$output = "";

		$sticky_header = ot_get_option( 'header_fixed', 'off' );
		$hide_header_logo = ot_get_option( 'hide_header_logo', 'on' );
		$menu_location = "";
		$header_gap = "";

		if ( is_page() or is_single() ) {

			$menu_location = get_post_meta( get_the_ID(), 'page_menu_location', true );
			$header_gap = get_post_meta( get_the_ID(), 'header_gap', true );

		}
		
		if( $menu_location == "onepage" ) {

			$location = "onepagemenu";

		} else {

			$location = "mainmenu";

		}

		if( $sticky_header == "on" ) {

			$output .= '<header class="gt-sticky-header">';
				$output .= '<div class="container gt-container">';

					if( $hide_header_logo == "on" ) {

						$output .= eventchamp_header_logo();

					}

					$output .= '<div class="gt-content">';
						$output .= '<nav class="gt-navbar">';
							$output .= wp_nav_menu(
								array(
									'menu' => 'mainmenu',
									'theme_location' => $location,
									'depth' => 5,
									'echo' => false,
									'menu_class' => 'gt-menu',
									'fallback_cb' => 'eventchamp_walker::fallback',
									'walker' => new eventchamp_walker(),
								)
							);
						$output .= '</nav>';
						$output .= '<div class="gt-elements">';
							$output .= eventchamp_header_elements();
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</header>';

		}

		return $output;

	}

}



/*======
*
* Mobile Header
*
======*/
if( !function_exists( 'eventchamp_mobile_header' ) ) {

	function eventchamp_mobile_header() {

		$output = "";
		$menu_location = "";
		$header_status = ot_get_option( 'hide_header' , 'on' );


		if( $header_status == "on" ) {

			if ( is_page() or is_single() ) {

				$menu_location = get_post_meta( get_the_ID(), 'page_menu_location', true );

			}
		
			if( $menu_location == "onepage" ) {
				$location = "onepagemenu";
			} else {
				$location = "mainmenu";
			}

			$output .= '<header class="gt-mobile-header">';
				$output .= '<div class="container gt-container">';
					$output .= eventchamp_mobile_header_logo();
					$output .= '<div class="gt-menu-icon">';
						$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 344.339 344.339" xml:space="preserve"> <g> <g> <g> <rect y="46.06" width="344.339" height="29.52"/> </g> <g> <rect y="156.506" width="344.339" height="29.52"/> </g> <g> <rect y="268.748" width="344.339" height="29.531"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</header>';
			$output .= '<div class="gt-mobile-background"></div>';
			$output .= '<div class="gt-mobile-menu scrollbar-outer">';
				$output .= '<div class="gt-top">';
					$output .= '<div class="gt-inner">';
						$output .= eventchamp_mobile_menu_logo();
						$output .= '<div class="gt-menu-icon">';
							$output .= '<svg version="1.1" id="Layer_1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 371.23 371.23" xml:space="preserve"> <polygon points="371.23,21.213 350.018,0 185.615,164.402 21.213,0 0,21.213 164.402,185.615 0,350.018 21.213,371.23 185.615,206.828 350.018,371.23 371.23,350.018 206.828,185.615 "/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<nav class="gt-navbar">';
						$output .= wp_nav_menu(
							array(
								'menu' => 'mainmenu',
								'theme_location' => $location,
								'depth' => 5,
								'echo' => false,
								'menu_class' => 'gt-menu',
								'fallback_cb' => 'eventchamp_walker::fallback',
								'walker' => new eventchamp_walker(),
							)
						);
					$output .= '</nav>';
				$output .= '</div>';
				$output .= '<div class="gt-bottom">';
					$output .= eventchamp_header_elements();
				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Header Logo
*
======*/
if( !function_exists( 'eventchamp_header_logo' ) ) {

	function eventchamp_header_logo() {

		$output = "";

		$logo = ot_get_option( 'eventchamp_logo' );
		$logo_attachment_id = eventchamp_attachment_id( $logo );
		$logo_height = ot_get_option( 'logo_height' );
		$logo_width = ot_get_option( 'logo_width' );

		if( !empty( $logo_height ) ) {

			$logo_height = ' height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"';

		}

		if( !empty( $logo_width ) ) {

			$logo_width = ' width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"';

		}

		if( !empty( $logo ) ) {

			$output .= '<div class="gt-logo">';
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
					$output .= '<img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( wp_get_attachment_url( $logo_attachment_id ) ) . '" srcset="' . wp_get_attachment_image_srcset( $logo_attachment_id, 'full' ) . '"' . $logo_height . $logo_width . ' />';
				$output .= '</a>';
			$output .= '</div>';

		} else {

			$output .= '<div class="gt-logo gt-text-logo">';
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
					$output .= '<span>' . esc_attr( get_bloginfo( 'name' ) ) . '</span>';
				$output .= '</a>';
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Header Alternative Logo
*
======*/
if( !function_exists( 'eventchamp_header_alternative_logo' ) ) {

	function eventchamp_header_alternative_logo() {

		$output = "";

		$logo = ot_get_option( 'eventchamp_logo_alternative' );
		$logo_attachment_id = eventchamp_attachment_id( $logo );
		$logo_height = ot_get_option( 'logo_height' );
		$logo_width = ot_get_option( 'logo_width' );

		if( !empty( $logo_height ) ) {

			$logo_height = ' height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"';

		}

		if( !empty( $logo_width ) ) {

			$logo_width = ' width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"';

		}

		if( !empty( $logo ) ) {

			$output .= '<div class="gt-logo gt-logo-alternative">';
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
					$output .= '<img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( wp_get_attachment_url( $logo_attachment_id ) ) . '" srcset="' . wp_get_attachment_image_srcset( $logo_attachment_id, 'full' ) . '"' . $logo_height . $logo_width . ' />';
				$output .= '</a>';
			$output .= '</div>';

		} else {

			$output .= '<div class="gt-logo gt-text-logo gt-logo-alternative">';
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
					$output .= '<span>' . esc_attr( get_bloginfo( 'name' ) ) . '</span>';
				$output .= '</a>';
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Mobile Header Logo
*
======*/
if( !function_exists( 'eventchamp_mobile_header_logo' ) ) {

	function eventchamp_mobile_header_logo() {

		$output = "";

		$logo = ot_get_option( 'eventchamp_mobile_logo' );
		$logo_attachment_id = eventchamp_attachment_id( $logo );
		$logo_height = ot_get_option( 'mobile_header_logo_height' );
		$logo_width = ot_get_option( 'mobile_header_logo_width' );

		if( !empty( $logo_height ) ) {

			$logo_height = ' height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"';

		}

		if( !empty( $logo_width ) ) {

			$logo_width = ' width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"';

		}

		if( !empty( $logo ) ) {

			$output .= '<div class="gt-logo">';
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
					$output .= '<img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( wp_get_attachment_url( $logo_attachment_id ) ) . '" srcset="' . wp_get_attachment_image_srcset( $logo_attachment_id, 'full' ) . '"' . $logo_height . $logo_width . ' />';
				$output .= '</a>';
			$output .= '</div>';

		} else {

			$output .= '<div class="gt-logo gt-text-logo">';
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
					$output .= '<span>' . esc_attr( get_bloginfo( 'name' ) ) . '</span>';
				$output .= '</a>';
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Mobile Menu Logo
*
======*/
if( !function_exists( 'eventchamp_mobile_menu_logo' ) ) {

	function eventchamp_mobile_menu_logo() {

		$output = "";

		$logo = ot_get_option( 'eventchamp_mobile_logo' );
		$logo_attachment_id = eventchamp_attachment_id( $logo );
		$logo_height = ot_get_option( 'mobile_menu_logo_height' );
		$logo_width = ot_get_option( 'mobile_menu_logo_width' );

		if( !empty( $logo_height ) ) {

			$logo_height = ' height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"';

		}

		if( !empty( $logo_width ) ) {

			$logo_width = ' width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"';

		}

		if( !empty( $logo ) ) {

			$output .= '<div class="gt-logo">';
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
					$output .= '<img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( wp_get_attachment_url( $logo_attachment_id ) ) . '" srcset="' . wp_get_attachment_image_srcset( $logo_attachment_id, 'full' ) . '"' . $logo_height . $logo_width . ' />';
				$output .= '</a>';
			$output .= '</div>';

		} else {

			$output .= '<div class="gt-logo gt-text-logo">';
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
					$output .= '<span>' . esc_attr( get_bloginfo( 'name' ) ) . '</span>';
				$output .= '</a>';
			$output .= '</div>';

		}

		return $output;

	}

}



/*======
*
* Header Elements
*
======*/
if( !function_exists( 'eventchamp_header_elements' ) ) {

	function eventchamp_header_elements() {

		$output = "";

		$header_user_box = ot_get_option( 'header_user_box', 'on' );
		$custom_login_link = ot_get_option( 'header_user_box_custom_login' );
		$custom_register_link = ot_get_option( 'header_user_box_custom_register' );
		$custom_profile_link = ot_get_option( 'header_user_box_custom_profile' );
		$custom_tickets_link = ot_get_option( 'header_user_box_custom_tickets' );
		$custom_logout_link = ot_get_option( 'header_user_box_custom_logout' );
		$custom_user_box_position = ot_get_option( 'header_custom_user_box_position', 'before-log-out' );
		$language_position = ot_get_option( 'header_user_box_language_position', 'before-log-out' );
		$login_button = ot_get_option( 'header_user_box_login_button', 'on' );
		$register_button = ot_get_option( 'header_user_box_register_button', 'on' );
		$reset_password_button = ot_get_option( 'header_user_box_reset_password_button', 'on' );
		$profile_button = ot_get_option( 'header_user_box_profile_button', 'on' );
		$my_tickets_button = ot_get_option( 'header_user_box_my_tickets_button', 'on' );
		$logout_button = ot_get_option( 'header_user_box_logout_button', 'on' );
		$header_social_media = ot_get_option( 'header_social_media', 'off' );
		$header_cart = ot_get_option( 'header_cart', 'off' );
		$header_cart_custom_link = ot_get_option( 'header_cart_custom_link' );

		if( $header_cart == 'on' ) {

			$output .= '<div class="gt-cart">';
				
				if( !empty( $header_cart_custom_link ) ) {

					$output .= '<a href="' . esc_url( $header_cart_custom_link ) . '">';

				} elseif( function_exists( 'is_woocommerce' ) ) {

					$output .= '<a href="' . esc_url( wc_get_cart_url() ) . '">';

					if( WC()->cart->get_cart_contents_count() > 0 ) {

						$output .= '<div class="gt-total">';
							$output .= WC()->cart->get_cart_contents_count();
						$output .= '</div>';

					}

				}

					$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>';
				$output .= '</a>';
			$output .= '</div>';

		}

		if( $header_social_media == 'on' ) {

			$output .= eventchamp_social_media_sites();

		}

		if( $header_user_box == 'on' ) {

			if( !is_user_logged_in() ){

				$output .= '<ul class="gt-user-box">';

					if( $custom_user_box_position == "before-content" ) {

						$output .= eventchamp_custom_user_box_links();

					}

					if( $language_position == "before-content" ) {

						$output .= eventchamp_user_box_language();

					}

					if( $login_button == "on" ) {

						if( !empty( $custom_login_link ) ) {

							$output .= '<li>';
								$output .= '<a href="' . esc_url( $custom_login_link ) . '">' . esc_html__( 'Sign In', 'eventchamp' ) . '</a>';
							$output .= '</li>';

						} else {

							$output .= '<li>';
								$output .= '<a href="" data-target="#gt-login-popup" data-toggle="modal">' . esc_html__( 'Sign In', 'eventchamp' ) . '</a>';
							$output .= '</li>';

						}

					}

					if( $custom_user_box_position == "after-profile" ) {

						$output .= eventchamp_custom_user_box_links();

					}

					if( $language_position == "after-profile" ) {

						$output .= eventchamp_user_box_language();

					}

					if( $custom_user_box_position == "before-log-out" ) {

						$output .= eventchamp_custom_user_box_links();

					}

					if( $language_position == "before-log-out" ) {

						$output .= eventchamp_user_box_language();

					}

					if( $register_button == "on" ) {

						if( !empty( $custom_register_link ) ) {

							$output .= '<li>';
								$output .= '<a href="' . esc_url( $custom_register_link ) . '">' . esc_html__( 'Sign Up', 'eventchamp' ) . '</a>';
							$output .= '</li>';

						} else {

							$output .= '<li>';
								$output .= '<a href="" data-target="#gt-register-popup" data-toggle="modal">' . esc_html__( 'Sign Up', 'eventchamp' ) . '</a>';
							$output .= '</li>';

						}

					}

					if( $custom_user_box_position == "after-content" ) {

						$output .= eventchamp_custom_user_box_links();

					}

					if( $language_position == "after-content" ) {

						$output .= eventchamp_user_box_language();

					}

				$output .= '</ul>';

			} else {

				$current_user = wp_get_current_user();

				$output .= '<ul class="gt-user-box">';

					if( $custom_user_box_position == "before-content" ) {

						$output .= eventchamp_custom_user_box_links();

					}

					if( $language_position == "before-content" ) {

						$output .= eventchamp_user_box_language();

					}

					if( $profile_button == "on" ) {

						// if( !empty( $custom_profile_link ) ) {

						// 	$output .= '<li class="link">';
						// 		$output .= '<a href="' . esc_url( $custom_profile_link ) . '">' . esc_html__( 'Profile', 'eventchamp' ) . '</a>';
						// 	$output .= '</li>';

						// } elseif( class_exists( 'woocommerce' ) ) {

						// 	if( !empty( get_option( 'woocommerce_myaccount_page_id' ) ) ) {

						// 		$output .= '<li>';
						// 			$output .= '<a href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '">' . esc_html__( 'Profile', 'eventchamp' ) . '</a>';
						// 		$output .= '</li>';

						// 	}

						// } else {

							$output .= '<li class="nolink">';
								$output .= '<a href="' . esc_url( bbp_get_user_profile_url( $current_user->ID ) ) . '">' . esc_html__( 'Profile', 'eventchamp' ) . '</a>';
							$output .= '</li>';

						// }

					}

					if( $custom_user_box_position == "after-profile" ) {

						$output .= eventchamp_custom_user_box_links();

					}

					if( $language_position == "after-profile" ) {

						$output .= eventchamp_user_box_language();

					}

					if( $my_tickets_button == "on" ) {

						if( !empty( $custom_tickets_link ) ) {

							$output .= '<li>';
								$output .= '<a href="' . esc_url( $custom_tickets_link ) . '">' . esc_html__( 'My Tickets', 'eventchamp' ) . '</a>';
							$output .= '</li>';

						} elseif( class_exists( 'woocommerce' ) ) {

							if( !empty( get_option( 'woocommerce_myaccount_page_id' ) ) and !empty( get_option( 'woocommerce_myaccount_orders_endpoint' ) ) ) {

								$output .= '<li>';
									$output .= '<a href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) . get_option( 'woocommerce_myaccount_orders_endpoint' ) ) . '">' . esc_html__( 'My Tickets', 'eventchamp' ) . '</a>';
								$output .= '</li>';

							}

						}

					}

					if( $custom_user_box_position == "before-log-out" ) {

						$output .= eventchamp_custom_user_box_links();

					}

					if( $language_position == "before-log-out" ) {

						$output .= eventchamp_user_box_language();

					}

					if( $logout_button == "on" ) {

						if( !empty( $custom_logout_link ) ) {

							$output .= '<li>';
								$output .= '<a href="' . esc_url( $custom_logout_link ) . '">' . esc_html__( 'Log Out', 'eventchamp' ) . '</a>';
							$output .= '</li>';

						} else {

							$output .= '<li>';
								$output .= '<a href="' . esc_url( wp_logout_url( home_url( '/' ) ) ) . '">' . esc_html__( 'Log Out', 'eventchamp' ) . '</a>';
							$output .= '</li>';

						}

					}

					if( $custom_user_box_position == "after-content" ) {

						$output .= eventchamp_custom_user_box_links();

					}

					if( $language_position == "after-content" ) {

						$output .= eventchamp_user_box_language();

					}

				$output .= '</ul>';

			}

		}

		return $output;

	}

}