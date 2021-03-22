<?php
/*======
*
* Datepicker
*
======*/
if( !function_exists( 'eventchamp_datepicker' ) ) {

	function eventchamp_datepicker() {

		$datepicker_format = ot_get_option( 'datepicker_date_format' );

		if( empty( $datepicker_format ) ) {

			$datepicker_format = "MM dd, yy";

		}

		$datepicker_other_months = ot_get_option( 'datepicker_other_months' );

		if( $datepicker_other_months == "on" ) {

			$other_months = "true";

		} else {

			$other_months = "false";

		}

		$datepicker_apply_button = ot_get_option( 'datepicker_apply_button' );

		if( $datepicker_apply_button == "on" ) {

			$apply_button = "true";

		} else {

			$apply_button = "false";

		}

		$first_day = ot_get_option( 'datepicker_first_day', '1' );

		$duration = ot_get_option( 'datepicker_duration', 'normal' );

		wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
			jQuery('.eventsearchdate-datepicker').datepicker({
					dateFormat: '" . esc_attr( $datepicker_format ) . "',
					showOtherMonths: " . esc_attr( $other_months ) . ",
					showButtonPanel: " . esc_attr( $apply_button ) . ",
					firstDay: " . esc_attr( $first_day ) . ",
					duration: '" . esc_attr( $duration ) . "',
					closeText: '" . esc_html__( 'Apply', 'eventchamp' )  . "',
					prevText: '" . esc_html__( 'Prev', 'eventchamp' )  . "',
					nextText: '" . esc_html__( 'Next', 'eventchamp' )  . "',
					monthNames: [ '" . esc_html__( 'January', 'eventchamp' ) . "', '" . esc_html__( 'February', 'eventchamp' ) . "', '" . esc_html__( 'March', 'eventchamp' ) . "', '" . esc_html__( 'April', 'eventchamp' ) . "', '" . esc_html__( 'May', 'eventchamp' ) . "', '" . esc_html__( 'June', 'eventchamp' ) . "', '" . esc_html__( 'July', 'eventchamp' ) . "', '" . esc_html__( 'August', 'eventchamp' ) . "', '" . esc_html__( 'September', 'eventchamp' ) . "', '" . esc_html__( 'October', 'eventchamp' ) . "', '" . esc_html__( 'November', 'eventchamp' ) . "', '" . esc_html__( 'December', 'eventchamp' ) . "' ],
					monthNamesMin: [ '" . esc_html__( 'Jan', 'eventchamp' ) . "', '" . esc_html__( 'Feb', 'eventchamp' ) . "', '" . esc_html__( 'Mar', 'eventchamp' ) . "', '" . esc_html__( 'Apr', 'eventchamp' ) . "', '" . esc_html__( 'May', 'eventchamp' ) . "', '" . esc_html__( 'Jun', 'eventchamp' ) . "', '" . esc_html__( 'Jul', 'eventchamp' ) . "', '" . esc_html__( 'Aug', 'eventchamp' ) . "', '" . esc_html__( 'Sep', 'eventchamp' ) . "', '" . esc_html__( 'Oct', 'eventchamp' ) . "', '" . esc_html__( 'Nov', 'eventchamp' ) . "', '" . esc_html__( 'Dec', 'eventchamp' ) . "' ],
					dayNames: [ '" . esc_html__( 'Saturday', 'eventchamp' ) . "', '" . esc_html__( 'Monday', 'eventchamp' ) . "', '" . esc_html__( 'Tuesday', 'eventchamp' ) . "', '" . esc_html__( 'Wednesday', 'eventchamp' ) . "', '" . esc_html__( 'Thursday', 'eventchamp' ) . "', '" . esc_html__( 'Friday', 'eventchamp' ) . "', '" . esc_html__( 'Saturday', 'eventchamp' ) . "' ],
					dayNamesMin: [ '" . esc_html__( 'Su', 'eventchamp' ) . "', '" . esc_html__( 'Mo', 'eventchamp' ) . "', '" . esc_html__( 'Tu', 'eventchamp' ) . "', '" . esc_html__( 'We', 'eventchamp' ) . "', '" . esc_html__( 'Th', 'eventchamp' ) . "', '" . esc_html__( 'Fr', 'eventchamp' ) . "', '" . esc_html__( 'Sa', 'eventchamp' ) . "' ],
					dayNamesShort : [ '" . esc_html__( 'Sun', 'eventchamp' ) . "', '" . esc_html__( 'Mon', 'eventchamp' ) . "', '" . esc_html__( 'Tue', 'eventchamp' ) . "', '" . esc_html__( 'Wed', 'eventchamp' ) . "', '" . esc_html__( 'Thu', 'eventchamp' ) . "', '" . esc_html__( 'Fri', 'eventchamp' ) . "', '" . esc_html__( 'Sat', 'eventchamp' ) . "' ],
				});
		});" );

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_datepicker' );

}