<?php
/*======
*
* Dequeue WPUF Styles
*
======*/
if( !function_exists( 'eventchamp_dequeue_wpuf_styles' ) ) {

	function eventchamp_dequeue_wpuf_styles() {

		wp_dequeue_style( 'jquery-ui' );

	}
	add_action( 'wp_print_styles', 'eventchamp_dequeue_wpuf_styles', 1 );

}