<?php
/*======
*
* Language Switcher
*
======*/
if( !function_exists( 'eventchamp_language_switcher' ) ) {

	function eventchamp_language_switcher() {

		$output = "";
		$language_flag = ot_get_option( 'header_user_box_language_flag_dropdown', 'on' );
		$name_type = ot_get_option( 'header_user_box_language_name_type' );

		if( function_exists( 'wpml_loaded' ) ) {

			$languages = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );

			if( !empty( $languages ) ) {

				$output .= '<div class="gt-language-switcher">';
					$output .= '<ul>';

						foreach( $languages as $lang ) {

							if( !empty( $lang ) ) {

								$output .= '<li>';
									$output .= '<a href="' . esc_url( $lang['url'] ) . '" class="' . ( $lang['active'] ? 'gt-active' : ''  ) . '">';

										if( $language_flag == 'on' ) {

											$output .= '<img src="' . esc_attr( $lang['country_flag_url'] ) . '" alt="' . esc_attr( $lang['native_name'] ) . '" />';

										}

										if( $name_type == "short-name" ) {

											$output .= '<span>' . esc_attr( $lang['language_code'] ) . '</span>';

										} else {

											$output .= '<span>' . esc_attr( $lang['native_name'] ) . '</span>';

										}

									$output .= '</a>';
								$output .= '</li>';

							}

						}

					$output .= '</ul>';
				$output .= '</div>';

			}

		} elseif( function_exists( 'pll_the_languages' ) ) {

			$args = array(
				'echo' => 0,
				'show_flags' => 0,
				'hide_if_empty' => 0,
				'hide_if_no_translation' => 0,
				'hide_current' => 0,
				'raw' => 1,
			);

			$languages = pll_the_languages( $args );

			if( !empty( $languages ) ) {

				$output .= '<div class="gt-language-switcher">';
					$output .= '<ul>';

						foreach( $languages as $lang ) {

							if( !empty( $lang ) ) {

								$output .= '<li>';
									$output .= '<a href="' . esc_url( $lang['url'] ) . '" class="' . ( $lang['current_lang'] == '1' ? 'gt-active' : ''  ) . '">';

										if( $language_flag == 'on' ) {

											$output .= '<img src="' . esc_attr( $lang['flag'] ) . '" alt="' . esc_attr( $lang['name'] ) . '" />';

										}

										if( $name_type == "short-name" ) {

											$output .= '<span>' . esc_attr( $lang['slug'] ) . '</span>';

										} else {

											$output .= '<span>' . esc_attr( $lang['name'] ) . '</span>';

										}

									$output .= '</a>';
								$output .= '</li>';

							}

						}

					$output .= '</ul>';
				$output .= '</div>';

			}

		} elseif( function_exists( 'eventchamp_demo_languages' ) ) {

			$output = eventchamp_demo_languages();

		}

		return $output;
	}

}



/*======
*
* Get Active Language
*
======*/
if( !function_exists( 'eventchamp_get_active_language' ) ) {

	function eventchamp_get_active_language() {

		$output = "";
		$language_flag = ot_get_option( 'header_user_box_language_flag', 'off' );
		$name_type = ot_get_option( 'header_user_box_language_name_type', 'full-name' );

		if( function_exists( 'wpml_loaded' ) ) {

			$languages = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );

			if( !empty( $languages ) ) {

				foreach( $languages as $lang ) {

					if( !empty( $lang ) ) {

						if( $lang["active"] == "1" ) {

							if( $language_flag == 'on' ) {

								$output .= '<img src="' . esc_attr( $lang['country_flag_url'] ) . '" alt="' . esc_attr( $lang['native_name'] ) . '" />';

							}

							if( $name_type == "short-name" ) {

								$output .= '<span>' . esc_attr( $lang['language_code'] ) . '</span>';

							} else {

								$output .= '<span>' . esc_attr( $lang['native_name'] ) . '</span>';

							}

						}

					}

				}

			}

		} elseif( function_exists( 'pll_the_languages' ) ) {

			$args = array(
				'echo' => 0,
				'show_flags' => 0,
				'hide_if_empty' => 0,
				'hide_if_no_translation' => 0,
				'hide_current' => 0,
				'raw' => 1,
			);

			$languages = pll_the_languages( $args );

			if( !empty( $languages ) ) {

				foreach( $languages as $lang ) {

					if( !empty( $lang ) ) {

						if( $lang["current_lang"] == "1" ) {

							if( $language_flag == 'on' ) {

								$output .= '<img src="' . esc_attr( $lang['flag'] ) . '" alt="' . esc_attr( $lang['name'] ) . '" />';

							}

							if( $name_type == "short-name" ) {

								$output .= '<span>' . esc_attr( $lang['slug'] ) . '</span>';

							} else {

								$output .= '<span>' . esc_attr( $lang['name'] ) . '</span>';

							}

						}

					}

				}

			}

		} elseif( function_exists( 'eventchamp_demo_active_language' ) ) {

			$output = eventchamp_demo_active_language();

		}

		return $output;

	}

}