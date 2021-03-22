<?php
/**
 * Admin
 *
 * @package GamiPress\WooCommerce\Points_Per_Purchase_Total\Admin
 * @since 1.0.0
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Plugin meta boxes
 *
 * @since  1.0.0
 */
function gamipress_wc_points_per_purchase_total_meta_boxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_gamipress_wc_points_per_purchase_total_';

    gamipress_add_meta_box(
        'gamipress-wc-points-per-purchase-total',
        __( 'Points per purchase total', 'gamipress-wc-points-per-purchase-total' ),
        'points-type',
        array(
            $prefix . 'award_points' => array(
                'name' 	=> __( 'Award points to users per purchase total?', 'gamipress-wc-points-per-purchase-total' ),
                'desc' 	=> '',
                'type' 	=> 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'percent' => array(
                'name' => __( 'Percent to award', 'gamipress-wc-points-per-purchase-total' ),
                'desc' => __( 'Set the amount\'s percent to award.', 'gamipress-wc-points-per-purchase-total' )
                    . '<br>' . __( 'A 100% will award the same purchase total as points (e.g. $40 = 40 points).', 'gamipress-wc-points-per-purchase-total' )
                    . '<br>' . __( 'A 200% will award the double of the purchase total as points (e.g. $40 = 80 points).', 'gamipress-wc-points-per-purchase-total' )
                    . '<br>' . __( 'A 50% will award the half of the purchase total as points (e.g. $40 = 20 points).', 'gamipress-wc-points-per-purchase-total' ),
                'type' => 'text',
                'attributes' => array(
                    'type' => 'number',
                    'min' => '1',
                ),
                'default' => '100',
            ),
            $prefix . 'user_earnings' => array(
                'name' 	=> __( 'Register amount awarded on user earnings?', 'gamipress-wc-points-per-purchase-total' ),
                'desc' 	=> '',
                'type' 	=> 'checkbox',
                'classes' => 'gamipress-switch',
            ),
        ),
        array( 'context' => 'side' )
    );

}
add_action( 'cmb2_admin_init', 'gamipress_wc_points_per_purchase_total_meta_boxes' );

/**
 * Plugin automatic updates
 *
 * @since  1.0.0
 *
 * @param array $automatic_updates_plugins
 *
 * @return array
 */
function gamipress_wc_points_per_purchase_total_automatic_updates( $automatic_updates_plugins ) {

    $automatic_updates_plugins['gamipress-wc-points-per-purchase-total'] = __( 'WooCommerce Points Per Order Total', 'gamipress-wc-points-per-purchase-total' );

    return $automatic_updates_plugins;
}
add_filter( 'gamipress_automatic_updates_plugins', 'gamipress_wc_points_per_purchase_total_automatic_updates' );