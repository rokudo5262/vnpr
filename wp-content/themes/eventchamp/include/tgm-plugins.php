<?php
/*======
*
* TGM WPBakery Support
*
======*/
if( !function_exists( 'eventchamp_tgm_wpbakery_support' ) ) {

	function eventchamp_tgm_wpbakery_support() {

		if( function_exists( 'vc_set_as_theme' ) ) {

			vc_set_as_theme();

		}

	}
	add_action( 'vc_before_init', 'eventchamp_tgm_wpbakery_support' );

}



/*======
*
* TGM Plugins
*
======*/
require_once get_template_directory() . '/include/class-tgm-plugin-activation.php';

if( !function_exists( 'eventchamp_tgm_plugins' ) ) {

	function eventchamp_tgm_plugins() {

		$plugins = array(
			array(
				'name' => esc_html__( 'WPBakery Page Builder', 'eventchamp' ), 
				'slug' => 'js_composer', 
				'source' => get_template_directory() . '/include/plugins/js_composer.zip',
				'version' => '6.4.2',
				'required' => true, 
				'force_activation' => false,
			),
			array(
				'name' => esc_html__( 'Eventchamp Elements', 'eventchamp' ), 
				'slug' => 'theme-event-champ-elements', 
				'source' => get_template_directory() . '/include/plugins/eventchamp-elements.zip',
				'version' => '1.7.4',
				'required' => true, 
				'force_activation' => false,
			),
			array(
				'name' => esc_html__( 'Slider Revolution', 'eventchamp' ), 
				'slug' => 'revslider', 
				'source' => get_template_directory() . '/include/plugins/revslider.zip',
				'version' => '6.3.2',
				'required' => false, 
				'force_activation' => false,
			),
			array(
				'name' => esc_html__( 'WP Events Impoter', 'eventchamp' ), 
				'slug' => 'wp-events-importer', 
				'source' => get_template_directory() . '/include/plugins/wp-events-importer.zip',
				'version' => '1.0.0',
				'required' => true, 
				'force_activation' => false,
			),
			array(
				'name' => esc_html__( 'Envato Market', 'eventchamp' ), 
				'slug' => 'envato-market', 
				'source' => get_template_directory() . '/include/plugins/envato-market.zip',
				'version' => '2.0.6',
				'required' => true, 
				'force_activation' => false,
			),
			array(
				'name' => esc_html__( 'Contact Form 7', 'eventchamp' ), 
				'slug' => 'contact-form-7', 
				'required' => true, 
				'force_activation' => false,
			),
			array(
				'name' => esc_html__( 'WooCommerce', 'eventchamp' ), 
				'slug' => 'woocommerce', 
				'required' => true, 
				'force_activation' => false,
			),
			array(
				'name' => esc_html__( 'MailChimp for WordPress', 'eventchamp' ), 
				'slug' => 'mailchimp-for-wp', 
				'required' => false, 
				'force_activation' => false,
			),
		);

		$config = array(
			'id' => 'eventchamp', // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '', // Default absolute path to bundled plugins.
			'menu' => 'tgmpa-install-plugins', // Menu slug.
			'has_notices' => true, // Show admin notices or not.
			'dismissable' => true, // If false, a user cannot dismiss the nag message.
			'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false, // Automatically activate plugins after installation or not.
			'message' => '', // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );

	}
	add_action( 'tgmpa_register', 'eventchamp_tgm_plugins' );

}