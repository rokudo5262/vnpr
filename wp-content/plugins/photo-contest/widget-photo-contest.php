<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'mm_wp_photocontest_widgets' );

// Register widget
function mm_wp_photocontest_widgets() {
	register_widget( 'mm_WP_Photocontest_Widget' );
	register_widget( 'mm_WP_Photocontest_Widget_Gallery' );
	register_widget( 'mm_WP_Photocontest_Widget_Rank' );
	register_widget( 'mm_WP_Photocontest_Widget_Category' );
}
//Load widgets
include( plugin_dir_path( __FILE__ ) . 'includes/widgets/widget-classic.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/widgets/widget-gallery.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/widgets/widget-rank.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/widgets/widget-category.php' );
