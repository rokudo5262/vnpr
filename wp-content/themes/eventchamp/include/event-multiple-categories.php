<?php
/*======
*
* Multiple Categories
*
======*/
if( !function_exists( 'eventchamp_event_multiple_categories' ) ) {

	function eventchamp_event_multiple_categories() {

		$multiple_categories = ot_get_option( 'event_multiple_categories', 'off' );
		$custom_css = "";

		if( $multiple_categories == 'off' ) {

			$custom_css= ".event-list-style-1 .details .category .post-categories li {
							display: none;
						}

						.event-list-style-1 .details .category .post-categories li:first-child {
							display: block;
						}

						.event-list-style-3 .details .category .post-categories li {
							display: none;
						}

						.event-list-style-3 .details .category .post-categories li:first-child {
							display: block;
						}

						.event-list-style-4 .details .category .post-categories li {
							display: none;
						}

						.event-list-style-4 .details .category .post-categories li:first-child {
							display: block;
						}";

		}

		wp_enqueue_style( 'eventchamp-custom', get_template_directory_uri() . '/include/assets/css/custom.css', array(), '1.0.0' );
		wp_add_inline_style( 'eventchamp-custom', $custom_css );

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_event_multiple_categories' );

}