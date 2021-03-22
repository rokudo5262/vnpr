<?php
/**
 * Scripts
 *
 * @package GamiPress\WooCommerce\Points_Per_Purchase_Total\Scripts
 * @since 1.0.0
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Register admin scripts
 *
 * @since       1.0.0
 * @return      void
 */
function gamipress_wc_points_per_purchase_total_admin_register_scripts() {

    // Use minified libraries if SCRIPT_DEBUG is turned off
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    // Scripts
    wp_register_script( 'gamipress-wc-points-per-purchase-total-admin-js', GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_URL . 'assets/js/gamipress-wc-points-per-purchase-total-admin' . $suffix . '.js', array( 'jquery' ), GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_VER, true );

}
add_action( 'admin_init', 'gamipress_wc_points_per_purchase_total_admin_register_scripts' );

/**
 * Enqueue admin scripts
 *
 * @since       1.0.0
 * @return      void
 */
function gamipress_wc_points_per_purchase_total_admin_enqueue_scripts( $hook ) {

    global $post_type;

    //Scripts
    if ( $post_type === 'points-type' ) {

        wp_enqueue_script( 'gamipress-wc-points-per-purchase-total-admin-js' );

    }
}
add_action( 'admin_enqueue_scripts', 'gamipress_wc_points_per_purchase_total_admin_enqueue_scripts', 100 );