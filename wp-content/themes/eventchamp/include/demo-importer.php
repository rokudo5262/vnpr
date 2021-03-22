<?php
/*======
*
* Merlin Integrations
*
======*/
require_once get_parent_theme_file_path( '/include/merlin/vendor/autoload.php' );
require_once get_parent_theme_file_path( '/include/merlin/class-merlin.php' );
require_once get_parent_theme_file_path( '/include/merlin/merlin-config.php' );



/*======
*
* Demo Importer
*
======*/
if( !function_exists( 'eventchamp_demo_importer' ) ) {

	function eventchamp_demo_importer() {

		return array(
			array(
				'import_file_name' => esc_html__( 'Import Demo', 'eventchamp' ),
				'local_import_file' => get_parent_theme_file_path( '/include/merlin/demo-content/demo-content.xml' ),
				'local_import_widget_file' => get_parent_theme_file_path( '/include/merlin/demo-content/widgets.wie' ),
				'preview_url' => esc_url( 'https://demo.gloriathemes.com/eventchamp/demo/' ),
			),
		);

	}
	add_filter( 'merlin_import_files', 'eventchamp_demo_importer' );

}



/*======
*
* Demo Settings
*
======*/
if( !function_exists( 'eventchamp_demo_settings' ) ) {

	function eventchamp_demo_settings() {

		/*====== Menu Settings ======*/
		$main_menu 	  = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		
		set_theme_mod(
			'nav_menu_locations', array(
				'mainmenu' => $main_menu->term_id,
			)
		);

		/*====== Homepage Settings ======*/
		$front_page_id = get_page_by_title( 'Home - Multiple v1' );
		$blog_page_id = get_page_by_title( 'Blog' );

		if( !empty( $front_page_id ) ) {

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );

		}

		if( !empty( $blog_page_id ) ) {

			update_option( 'page_for_posts', $blog_page_id->ID );

		}

	}
	add_action( 'merlin_after_all_import', 'eventchamp_demo_settings' );

}