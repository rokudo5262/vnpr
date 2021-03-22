<?php
/*======
*
* Cookie Bar
*
======*/
if( !function_exists( 'eventchamp_cookie_bar' ) ) {

	function eventchamp_cookie_bar() {

		$output = "";

		$cookie_bar = ot_get_option( 'cookie-bar', 'on' );
		$cookie_bar_style = ot_get_option( 'cookie-bar-style', 'style-1' );
		$cookie_bar_text = ot_get_option( 'cookie-bar-text', esc_html__( 'This site uses cookies. Find out more about cookies and how you can refuse them.', 'eventchamp' ) );
		$cookie_bar_button_text = ot_get_option( 'cookie-bar-button-text', esc_html__( 'I Accept', 'eventchamp' ) );
		$cookie_bar_time = ot_get_option( 'cookie-bar-time', '15' );

		if( $cookie_bar == "on" ) {

			$output .= '<div class="gt-cookie-bar gt-' . esc_attr( $cookie_bar_style ) . '" data-expires="' . esc_attr( $cookie_bar_time ) . '">';

				if( !empty( $cookie_bar_text ) ) {

					$output .= '<div class="gt-cookie-text">' . wpautop( $cookie_bar_text ) . '</div>';

				}

				$output .= '<div class="gt-cookie-button">';
					$output .= '<a href="#">' . esc_attr( $cookie_bar_button_text ) . '</a>';
				$output .= '</div>';

			$output .= '</div>';

		}

		return $output;

	}

}