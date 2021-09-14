<?php
/**
 * Filters
 *
 * @package GamiPress\WooCommerce\Points_Per_Purchase_Total\Filters
 * @since 1.0.0
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Payment complete
 *
 * @param int $order_id
 */
function gamipress_wc_points_per_purchase_total_payment_complete( $order_id ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_gamipress_wc_points_per_purchase_total_';

    $order = wc_get_order( $order_id );

    // Bail if not a valid order
    if( ! $order ) {
        return;
    }

    // Bail if order is not marked as completed
    if ( $order->get_status() !== 'completed' ) {
        return;
    }

    $points_awarded = get_post_meta( $order_id, $prefix . 'points_awarded', true );

    // Bail if points already awarded
    if( (bool) $points_awarded ) {
        return;
    }

    $user_id = $order->get_user_id();

    foreach( gamipress_get_points_types() as $points_type => $data ) {

        // If award points is not checked, bail here
        if( ! (bool) gamipress_get_post_meta( $data['ID'], $prefix . 'award_points' ) )
            continue;

        $percent = (int) gamipress_get_post_meta( $data['ID'], $prefix . 'percent' );

        // If percent is not higher than 0, bail
        if( $percent <= 0 ) {
            continue;
        }

        // Setup the ratio value used to convert the amount spent into points
        $ratio = $percent / 100;

        $points_to_award = absint( $order->get_total() * $ratio );

        /**
         * Filter to allow override this amount at any time
         *
         * @since 1.0.0
         *
         * @param int       $points_to_award    Points amount that will be awarded
         * @param int       $user_id            User ID that will receive the points
         * @param string    $points_type        Points type slug of the points amount
         * @param int       $order_id           Order ID
         * @param int       $percent            Percent setup on the points type
         *
         * @return int
         */
        $points_to_award = (int) apply_filters( 'gamipress_wc_points_per_purchase_total_points_to_award', $points_to_award, $user_id, $points_type, $order_id, $percent );

        // Award the points to the user
        if( $points_to_award > 0 ) {

            gamipress_award_points_to_user( $user_id, $points_to_award, $points_type );

            $register_on_user_earnings = (bool) gamipress_get_post_meta( $data['ID'], $prefix . 'user_earnings' );

            if( $register_on_user_earnings ) {

                // Insert the custom user earning for the manual balance adjustment
                gamipress_insert_user_earning( $user_id, array(
                    'title'	        => sprintf(
                        __( '%s for made a purchase of %s', 'gamipress-wc-points-per-purchase-total' ),
                        gamipress_format_points( $points_to_award, $points_type ),
                        strip_tags( wc_price( $order->get_total(), array( 'currency' => get_woocommerce_currency() ) ) )
                    ),
                    'user_id'	    => $user_id,
                    'post_id'	    => $data['ID'],
                    'post_type' 	=> 'points-type',
                    'points'	    => $points_to_award,
                    'points_type'	=> $points_type,
                    'date'	        => date( 'Y-m-d H:i:s', current_time( 'timestamp' ) ),
                ) );

            }

        }
    }

    // Set a post meta to meet that points have been awarded
    update_post_meta( $order_id, $prefix . 'points_awarded', '1' );

}
add_action( 'woocommerce_order_status_completed', 'gamipress_wc_points_per_purchase_total_payment_complete');

/**
 * Revoke points to the user if order gets marked as refunded
 *
 * @since 1.0.0
 *
 * @param int $order_id
 */
function gamipress_wc_points_per_purchase_total_payment_refunded( $order_id ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_gamipress_wc_points_per_purchase_total_';

    $order = wc_get_order( $order_id );

    // Bail if not a valid order
    if( ! $order ) {
        return;
    }

    $points_awarded = get_post_meta( $order_id, $prefix . 'points_awarded', true );

    // Bail if points hasn't been awarded
    if( ! (bool) $points_awarded ) {
        return;
    }

    $user_id = $order->get_user_id();

    foreach( gamipress_get_points_types() as $points_type => $data ) {

        // If award points is not checked, bail here
        if( ! (bool) gamipress_get_post_meta( $data['ID'], $prefix . 'award_points' ) )
            continue;

        $percent = (int) gamipress_get_post_meta( $data['ID'], $prefix . 'percent' );

        // If percent is not higher than 0, bail
        if( $percent <= 0 ) {
            continue;
        }

        // Setup the ratio value used to convert the amount spent into points
        $ratio = $percent / 100;

        $points_to_award = absint( $order->get_total() * $ratio );

        /**
         * Filter to allow override this amount at any time
         *
         * @since 1.0.0
         *
         * @param int       $points_to_award    Points amount that will be awarded
         * @param int       $user_id            User ID that will receive the points
         * @param string    $points_type        Points type slug of the points amount
         * @param int       $order_id           Order ID
         * @param int       $percent            Percent setup on the points type
         *
         * @return int
         */
        $points_to_award = (int) apply_filters( 'gamipress_wc_points_per_purchase_total_points_to_award', $points_to_award, $user_id, $points_type, $order_id, $percent );

        // Deduct the points to the user
        if( $points_to_award > 0 ) {
            gamipress_deduct_points_to_user( $user_id, $points_to_award, $points_type );

        }
    }

    // Set a post meta to meet that points have been revoked
    update_post_meta( $order_id, $prefix . 'points_awarded', '0' );
    update_post_meta( $order_id, $prefix . 'points_deducted', '1' );

}

/**
 * Check order status changes to meet if should award points to the user
 *
 * @since 1.0.0
 *
 * @param $order_id
 * @param $from
 * @param $to
 * @param $order
 */
function gamipress_wc_points_per_purchase_total_check_order_status_change( $order_id, $from, $to, $order ) {

    if( $from !== 'completed' && $to === 'completed' ) {
        gamipress_wc_points_per_purchase_total_payment_complete( $order_id );
    }

    if( $from !== 'refunded' && $to === 'refunded' ) {
        gamipress_wc_points_per_purchase_total_payment_refunded( $order_id );
    }

}
add_action( 'woocommerce_order_status_changed', 'gamipress_wc_points_per_purchase_total_check_order_status_change', 10, 4 );