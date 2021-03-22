<?php
/*======
*
* WooCommerce Support for Theme
*
======*/
if( class_exists( 'woocommerce' ) ) {

	if( !function_exists( 'eventchamp_woocommerce_support' ) ) {

		function eventchamp_woocommerce_support() {

			add_theme_support( 'woocommerce' );

		}
		add_action( 'after_setup_theme', 'eventchamp_woocommerce_support' );

	}

}



/*======
*
* Eventchamp WooCommerce Scripts
*
======*/
if( !function_exists( 'eventchamp_woocommerce_styles' ) ) {

	function eventchamp_woocommerce_styles() {

		wp_enqueue_style( 'eventchamp-woocommerce', get_template_directory_uri() . '/include/assets/css/woocommerce.min.css' );

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_woocommerce_styles' );

}