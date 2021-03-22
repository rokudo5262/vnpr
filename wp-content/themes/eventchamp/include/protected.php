<?php
/*======
*
* Password Form
*
======*/
if( !function_exists( 'eventchamp_password_form' ) ) {

	function eventchamp_password_form() {

		$output = "";

		$output .= '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
			$output .= '<div class="gt-form-content">';
				$output .= '<input name="post_password" type="password" placeholder="' . esc_attr__( 'Password', 'eventchamp' ) . '" />';
				$output .= '<button type="submit">' . esc_attr__( 'Submit', 'eventchamp' ) . '</button>';
			$output .= '</div> ';
		$output .= '</form> ';

		return $output;

	}

}



/*======
*
* Password Protected Box
*
======*/
if( !function_exists( 'eventchamp_password_protected_box' ) ) {

	function eventchamp_password_protected_box() {

		$output = "";

		$password_protected_title = ot_get_option( 'password-protected-title', esc_html__( 'Protected Page', 'eventchamp' ) );
		$password_protected_text = ot_get_option( 'password-protected-text', esc_html__( 'This is a protected area. To continue please enter your password below.', 'eventchamp' ) );

		$output .= '<div class="gt-password-protected">';
			$output .= '<div class="gt-content">';

				if( !empty( $password_protected_title ) ) {

					$output .= eventchamp_section_title( $primary_title = esc_attr( $password_protected_title ) , $secondary_title = "", $text = $password_protected_text, $style = "dark", $size = "size1", $align = "center", $separator = "true", $icon = "fas fa-lock" );

				}

				if( function_exists( 'eventchamp_password_form' ) ) {

					$output .= eventchamp_password_form();

				}

			$output .= '</div>';
		$output .= '</div>';

		return $output;

	}

}