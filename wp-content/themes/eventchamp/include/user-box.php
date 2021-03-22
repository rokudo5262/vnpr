<?php
/*======
*
* User Box Popup
*
======*/
if( !function_exists( 'eventchamp_user_popup' ) ) {

	function eventchamp_user_popup() {

		$output = "";
		$header_user_box = ot_get_option( 'header_user_box', 'on' );
		$eventchamp_social_login = ot_get_option( 'eventchamp_social_login', 'off' );
		$eventchamp_social_login_shortcode = ot_get_option( 'eventchamp_social_login_shortcode' );
		$reset_password_button = ot_get_option( 'header_user_box_reset_password_button', 'on' );
		$header_user_box_custom_password = ot_get_option( 'header_user_box_custom_password' );
		$register_button = ot_get_option( 'header_user_box_register_button', 'on' );
		$header_user_box_custom_register = ot_get_option( 'header_user_box_custom_register' );
		$register_notice = ot_get_option( 'header_user_box_register_notice', 'on' );
		$register_notice_text = ot_get_option( 'header_user_box_register_notice_text' );
		$page_terms_and_conditions = ot_get_option( 'page_terms_and_conditions' );
		$page_privacy_policy = ot_get_option( 'page_privacy_policy' );

		if( ! is_user_logged_in() ) {

			$output .= '<div class="modal fade gt-modal gt-login-modal" id="gt-login-popup" tabindex="-1" role="dialog" aria-labelledby="' . esc_html__( 'Sign In', 'eventchamp' ) . '" aria-hidden="true">';
				$output .= '<div class="modal-dialog gt-modal-dialog modal-dialog-centered" role="document">';
					$output .= '<div class="modal-content gt-modal-content">';
						$output .= '<div class="modal-header gt-modal-header">';
							$output .= '<div class="gt-modal-title">' . esc_html__( 'Sign In', 'eventchamp' ) . '</div>';
							$output .= '<button type="button" class="gt-close" data-dismiss="modal" aria-label="' . esc_html__( 'Close', 'eventchamp' ) . '">';
								$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 371.23 371.23" xml:space="preserve"> <polygon points="371.23,21.213 350.018,0 185.615,164.402 21.213,0 0,21.213 164.402,185.615 0,350.018 21.213,371.23 185.615,206.828 350.018,371.23 371.23,350.018 206.828,185.615 "/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
							$output .= '</button>';
						$output .= '</div>';
						$output .= '<div class="modal-body gt-modal-body">';
							$output .= '<div class="gt-login-content">';
								$output .= '<form id="gt-login-form" action="' . esc_url( home_url( '/' ) ) . '" method="POST">';
									$output .= '<div class="gt-columns gt-column-1 gt-column-space-15">';
										$output .= '<div class="gt-col">';
											$output .= '<div class="gt-inner">';
												$output .= '<input class="required" name="gt-login-username" type="text" placeholder="' . esc_html__( 'Username', 'eventchamp' ) . '" />';
											$output .= '</div>';
										$output .= '</div>';
										$output .= '<div class="gt-col">';
											$output .= '<div class="gt-inner">';
												$output .= '<input class="required" name="gt-login-password" type="password" placeholder="' . esc_html__( 'Password', 'eventchamp' ) . '" />';
											$output .= '</div>';
										$output .= '</div>';
										$output .= '<div class="gt-col">';
											$output .= '<div class="gt-inner">';
												$output .= '<input type="checkbox" value="none" class="gt-checkbox" id="gt-remember-me" name="gt-remember-me" />';
												$output .= '<label for="gt-remember-me" class="gt-checkbox-label" id="login-remember-me-wrapper-label">' . esc_html__( 'Remember Me', 'eventchamp' ) . '</label>';
											$output .= '</div>';
										$output .= '</div>';
										$output .= '<div class="gt-col">';
											$output .= '<div class="gt-inner">';
												$output .= '<button data-loading-text="' . esc_html__( 'Loading...', 'eventchamp' ) . '" type="submit">' . esc_html__( 'Sign in', 'eventchamp' ) . '</button>';
												$output .= '<input type="hidden" name="action" value="eventchamp_login"/>';
												$output .= '<div class="gt-errors"></div>';
											$output .= '</div>';
										$output .= '</div>';

										if( $reset_password_button == "on" or $register_button == "on" ) {

											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';
													$output .= '<div class="gt-modal-footer">';

														if( $reset_password_button == "on" ) {

															if( !empty( $header_user_box_custom_password ) ) {

																$output .= '<a href="' . esc_url( $header_user_box_custom_password ) . '">' . esc_html__( 'Lost Password?', 'eventchamp' ) . '</a>';

															} else {

																$output .= '<a href="' . wp_lostpassword_url( get_permalink() ) . '">'. esc_html__( 'Lost Password?', 'eventchamp' ) . '</a>';

															}

														}

														if( $register_button == "on" ) {

															if( !empty( $header_user_box_custom_register ) ) {

																$output .= '<a href="' . esc_url( $header_user_box_custom_register ) . '">' . esc_html__( 'Create an Account', 'eventchamp' ) . '</a>';

															} else {

																$output .= '<a href="" data-target="#gt-register-popup" data-toggle="modal" data-dismiss="modal">' . esc_html__( 'Create an Account', 'eventchamp' ) . '</a>';

															}

														}

													$output .= '</div>';
												$output .= '</div>';
											$output .= '</div>';

										}

										if( $eventchamp_social_login == 'on' and !empty( $eventchamp_social_login_shortcode ) ) {

											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';
													$output .= '<div class="gt-social-login">';
														$output .= do_shortcode( $eventchamp_social_login_shortcode );
													$output .= '</div>';
												$output .= '</div>';
											$output .= '</div>';

										}

									$output .= '</div>';
									$output .= '<div class="gt-loading">';
										$output .= wpautop( esc_html__( 'Loading...', 'eventchamp' ) );
									$output .= '</div>';
									$output .= wp_nonce_field( 'ajax-login-nonce', 'gt-login-security', true, false );
								$output .= '</form>';
							$output .= '</div>';

						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';

			$output .= '<div class="modal fade gt-modal gt-register-modal" id="gt-register-popup" tabindex="-2" role="dialog" aria-labelledby="' . esc_html__( 'Sign Up', 'eventchamp' ) . '" aria-hidden="true">';
				$output .= '<div class="modal-dialog gt-modal-dialog modal-dialog-centered" role="document">';
					$output .= '<div class="modal-content gt-modal-content">';
						$output .= '<div class="modal-header gt-modal-header">';
							$output .= '<div class="gt-modal-title">' . esc_html__( 'Sign Up', 'eventchamp' ) . '</div>';
							$output .= '<button type="button" class="gt-close" data-dismiss="modal" aria-label="' . esc_html__( 'Close', 'eventchamp' ) . '">';
								$output .= '<svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 371.23 371.23" xml:space="preserve"> <polygon points="371.23,21.213 350.018,0 185.615,164.402 21.213,0 0,21.213 164.402,185.615 0,350.018 21.213,371.23 185.615,206.828 350.018,371.23 371.23,350.018 206.828,185.615 "/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
							$output .= '</button>';
						$output .= '</div>';
						$output .= '<div class="modal-body gt-modal-body">';

							if( get_option( 'users_can_register' ) == "0" ) {

								$output .= wpautop( esc_html__( 'New membership are not allowed.', 'eventchamp' ) ) ;

							} else {

								$output .= '<div class="gt-register-content">';
									$output .= '<form id="gt-register-form" action="' . esc_url( home_url( '/' ) ) . '" method="POST">';
										$output .= '<div class="gt-columns gt-column-1 gt-column-space-15">';
											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';
													$output .= '<input class="required" name="gt-register-username" placeholder="' . esc_html__( 'Username', 'eventchamp' ) . '" type="text"/>';
												$output .= '</div>';
											$output .= '</div>';
											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';
													$output .= '<input class="required" name="gt-register-email" placeholder="' . esc_html__( 'Email', 'eventchamp' ) . '" type="email"/>';
												$output .= '</div>';
											$output .= '</div>';
											$output .= '<div class="gt-col">';
												$output .= '<div class="gt-inner">';
													$output .= '<button data-loading-text="' . esc_html__( 'Loading...', 'eventchamp' ) . '" type="submit">' . esc_html__( 'Be Member', 'eventchamp' ) . '</button>';
													$output .= '<input type="hidden" name="action" value="eventchamp_register"/>';
													$output .= '<div class="gt-errors"></div>';
												$output .= '</div>';
											$output .= '</div>';

											if( $register_notice == "on" ) {

												$output .= '<div class="gt-col">';
													$output .= '<div class="gt-inner">';
														$output .= '<div class="gt-modal-footer">';

															if( !empty( $register_notice_text ) ) {

																$output .= wpautop( do_shortcode( $register_notice_text ) );

															} else {

																$output .= wpautop( esc_html__( 'By creating an account you agree to our', 'eventchamp' ) . ' <a href="' . esc_url( get_the_permalink( $page_terms_and_conditions ) ) . '" target="_blank"> ' . esc_html__( 'terms and conditions', 'eventchamp' ) . '</a> ' . esc_html__( 'and our', 'eventchamp' ) . ' <a href="' . esc_url( get_the_permalink( $page_privacy_policy ) ) . '" target="_blank"> ' . esc_html__( 'privacy policy.', 'eventchamp' ) . '</a>' );

															}
														$output .= '</div>';
													$output .= '</div>';
												$output .= '</div>';

											}

											if( $eventchamp_social_login == 'on' and !empty( $eventchamp_social_login_shortcode ) ) {

												$output .= '<div class="gt-col">';
													$output .= '<div class="gt-inner">';
														$output .= '<div class="gt-social-login">';
															$output .= do_shortcode( $eventchamp_social_login_shortcode );
														$output .= '</div>';
													$output .= '</div>';
												$output .= '</div>';

											}

										$output .= '</div>';
										$output .= '<div class="gt-loading">';
											$output .= wpautop( esc_html__( 'Loading...', 'eventchamp' ) );
										$output .= '</div>';
										$output .= wp_nonce_field( 'ajax-login-nonce', 'gt-register-security', true, false );
									$output .= '</form>';
								$output .= '</div>';

							}

						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;

	}

}



if( !function_exists( 'eventchamp_user_box' ) ) {

	function eventchamp_user_box() {

		$header_user_box = ot_get_option( 'header_user_box', 'on' );

		if( $header_user_box == 'on' ) {

			echo eventchamp_user_popup();

		}

	}
	add_action( 'wp_footer', 'eventchamp_user_box' );

}



/*======
*
* Login
*
======*/
if( !function_exists( 'eventchamp_login' ) ) {

	function eventchamp_login() {

		$header_user_box = ot_get_option( 'header_user_box', 'on' );

		if( $header_user_box == 'on' ) {

			$user_login = esc_attr( esc_js( $_POST['gt-login-username'] ) );
			$user_pass = esc_attr( esc_js( $_POST['gt-login-password'] ) );
			$remember = esc_attr( esc_js( $_POST['gt-remember-me'] ) );

			if( isset( $_POST['gt-remember-me'] ) ) {

				$remember_me = "true";

			} else {

				$remember_me = "false";

			}

			if( !check_ajax_referer( 'ajax-login-nonce', 'gt-login-security', false ) ) {

				echo json_encode( array( 'error' => true, 'message' => '<p class="gt-alert">' . esc_html__( 'Session token has expired, please reload the page and try again.', 'eventchamp' ) . '</p>' ) );

			} elseif( empty( $user_login ) || empty( $user_pass ) ) {

				echo json_encode( array( 'error' => true, 'message' => '<p class="gt-alert">' . esc_html__( 'Please fill all form fields.', 'eventchamp' ) . '</p>' ) );

			} else {

				$user = wp_signon( array( 'user_login' => $user_login, 'user_password' => $user_pass, 'remember' => $remember_me ), false );

				if( is_wp_error( $user ) ) {

					echo json_encode( array( 'error' => true, 'message' => '<p class="gt-alert">' . $user->get_error_message() . '</p>' ) );

				} else {

					echo json_encode( array( 'error' => false, 'message' => '<p class="gt-alert">' . esc_html__( 'Login successful, you are being redirected.', 'eventchamp' ) . '</p>' ) );

				}

			}

			die();

		}

	}
	add_action( 'wp_ajax_nopriv_eventchamp_login', 'eventchamp_login' );

}



/*======
*
* Register
*
======*/
if( !function_exists( 'eventchamp_register' ) ) {

	function eventchamp_register() {

		$header_user_box = ot_get_option( 'header_user_box', 'on' );

		if( $header_user_box == 'on' ) {

			$user_login	= esc_attr( esc_js( $_POST['gt-register-username'] ) );	
			$user_email	= esc_attr( esc_js( $_POST['gt-register-email'] ) );
			
			if( !check_ajax_referer( 'ajax-login-nonce', 'gt-register-security', false ) ) {

				echo json_encode( array( 'error' => true, 'message' => '<p class="gt-alert">' . esc_html__( 'Session token has expired, please reload the page and try again.', 'eventchamp' ).'</p>' ) );

				die();

			} elseif( empty( $user_login ) || empty( $user_email ) ) {

				echo json_encode( array( 'error' => true, 'message' => '<p class="gt-alert">' . esc_html__( 'Please fill all form fields.', 'eventchamp' ) . '</p>' ) );

				die();

			}
			
			$errors = register_new_user( $user_login, $user_email );

			if( is_wp_error( $errors ) ) {

				$registration_error_messages = $errors->errors;

				foreach( $registration_error_messages as $error ) {

					$display_errors .= '<p class="gt-alert">' . $error[0] . '</p>';

				}

				echo json_encode( array( 'error' => true, 'message' => $display_errors ) );

			} else {

				echo json_encode( array( 'error' => false, 'message' => '<p class="gt-alert">' . esc_html__( 'Registration completed. Please check your e-mail.', 'eventchamp' ) . '</p>' ) );

			}

			die();

		}

	}
	add_action( 'wp_ajax_nopriv_eventchamp_register', 'eventchamp_register' );

}



/*======
*
* Custom User Box Links
*
======*/
if( !function_exists( 'eventchamp_custom_user_box_links' ) ) {

	function eventchamp_custom_user_box_links() {

		$header_user_box = ot_get_option( 'header_user_box', 'on' );

		if( $header_user_box == 'on' ) {

			$custom_links = ot_get_option( 'header_user_box_custom_links' );
			$output = "";

			if( !empty( $custom_links ) ) {

				foreach( $custom_links as $link ) {

					if( !empty( $link ) ) {

						if( !empty( $link["link"] ) and !empty( $link["title"] ) ) {

							if( empty( $link["target"] ) ) {

								$link["target"] = "_self";

							}

							if( $link["only-members"] == "on" and is_user_logged_in() ) {

								$output .= '<li><a href="' . esc_url( $link["link"] ) . '" target="' . esc_attr( $link["target"] ) . '">' . esc_attr( $link["title"] ) . '</a></li>';

							} elseif( $link["only-members"] == "off" ) {

								$output .= '<li><a href="' . esc_url( $link["link"] ) . '" target="' . esc_attr( $link["target"] ) . '">' . esc_attr( $link["title"] ) . '</a></li>';

							}

						}

					}

				}

			}

			return $output;

		}

	}

}



/*======
*
* User Box Scripts
*
======*/
if( !function_exists( 'eventchamp_user_box_scripts' ) ) {

	function eventchamp_user_box_scripts() {

		$header_user_box = ot_get_option( 'header_user_box', 'on' );

		if( $header_user_box == 'on' ) {

			wp_enqueue_script( 'ajax-app' );
			wp_enqueue_script( 'ajax-login-register-script', get_template_directory_uri() . '/include/assets/js/user-box.min.js', array(), false, true );
			wp_localize_script( 'ajax-login-register-script', 'ptajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), ) );

		}

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_user_box_scripts' );

}



/*======
*
* User Box Languages
*
======*/
if( !function_exists( 'eventchamp_user_box_language' ) ) {

	function eventchamp_user_box_language() {

		if( function_exists( 'wpml_loaded' ) or function_exists( 'pll_the_languages' ) or function_exists( 'eventchamp_demo_languages' ) ) {

			$user_box_language = ot_get_option( 'header_user_box_language', 'on' );

			if( $user_box_language == 'on' ) {

				$output = '<li class="gt-language">';
					$output .= '<a class="dropdown-toggle gt-active-language" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdownMenuButton">' . eventchamp_get_active_language() . '</a>';
					$output .= '<div class="dropdown-menu gt-language-switcher-dropdown" aria-labelledby="dropdownMenuButton">';
						$output .= eventchamp_language_switcher();
					$output .= '</div>';
				$output .= '</li>';

				return $output;
			}

		}

	}

}