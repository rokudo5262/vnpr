<?php
/*======
*
* Loader
*
======*/
if( !function_exists( 'eventchamp_loader' ) ) {

	function eventchamp_loader() {

		$output = "";
		$eventchamp_loader = ot_get_option( 'eventchamp_loader', 'off' );
		$loader_style = ot_get_option( 'loader_style', 'style1' );

		if( $eventchamp_loader == 'on' ) {

			if( $loader_style == 'style2' ) {

				$output .= '<div class="gt-loader gt-style-2">';
					$output .= '<div class="spinner">';
						$output .= '<div class="bounce1"></div>';
						$output .= '<div class="bounce2"></div>';
						$output .= '<div class="bounce3"></div>';
					$output .= '</div>';
				$output .= '</div>';

			} elseif( $loader_style == 'style3' ) {

				$output .= '<div class="gt-loader gt-style-3">';
					$output .= '<div class="spinner"></div>';
				$output .= '</div>';

			} elseif( $loader_style == 'style4' ) {

				$output .= '<div class="gt-loader gt-style-4">';
					$output .= '<div class="sk-fading-circle">';
						$output .= '<div class="sk-circle1 sk-circle"></div>';
						$output .= '<div class="sk-circle2 sk-circle"></div>';
						$output .= '<div class="sk-circle3 sk-circle"></div>';
						$output .= '<div class="sk-circle4 sk-circle"></div>';
						$output .= '<div class="sk-circle5 sk-circle"></div>';
						$output .= '<div class="sk-circle6 sk-circle"></div>';
						$output .= '<div class="sk-circle7 sk-circle"></div>';
						$output .= '<div class="sk-circle8 sk-circle"></div>';
						$output .= '<div class="sk-circle9 sk-circle"></div>';
						$output .= '<div class="sk-circle10 sk-circle"></div>';
						$output .= '<div class="sk-circle11 sk-circle"></div>';
						$output .= '<div class="sk-circle12 sk-circle"></div>';
					$output .= '</div>';
				$output .= '</div>';

			} else {

				$output .= '<div class="gt-loader gt-style-1">';
					$output .= '<div class="spinner">';
						$output .= '<div class="double-bounce1"></div>';
						$output .= '<div class="double-bounce2"></div>';
					$output .= '</div>';
				$output .= '</div>';

			}

		}

		return $output;

	}

}