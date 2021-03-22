<?php
if( !function_exists( 'eventchamp_sidebars_init' ) ) {

	function eventchamp_sidebars_init() {

		register_sidebar(
				array(
				'id' => 'general-sidebar',
				'name' => esc_html__( 'General Sidebar', 'eventchamp' ),
				'before_widget' => '<div id="%1$s" class="gt-general-widget gt-widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="gt-widget-title">',
				'after_title' => '</div>',
			)
		);
		
		if( class_exists( 'woocommerce' ) ) {

			register_sidebar(
				array(
					'id' => 'shop-sidebar',
					'name' => esc_html__( 'Shop Sidebar', 'eventchamp' ),
					'before_widget' => '<div id="%1$s" class="gt-shop-widget gt-widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<div class="gt-widget-title">',
					'after_title' => '</div>',
				)
			);

		}

	}
	add_action( 'widgets_init', 'eventchamp_sidebars_init' );

}