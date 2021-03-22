<?php
/**
 * This class is a Helper Class for Mailchimp
 * 
 * @package NotificationX Pro
 * @subpackage  NotificationX Pro/extensions
 */
class NotificationXPro_Freemius_Helper {

    public static function freemius( $scope, $dev_id, $dev_public_key, $dev_secret_key ){
        return new Freemius_Api_WordPress( $scope, $dev_id, $dev_public_key, $dev_secret_key );
    }
    
    public static function freemius_connect(){
        if ( ( ! isset( $_POST['nonce'] ) && ! isset( $_POST['key'] ) ) || ! 
            wp_verify_nonce( $_POST['nonce'], 'nx_'. $_POST['key'] .'_nonce' ) ) {
            return;
        }

        if( isset( $_POST['form_data'] ) ) {
            NotificationX_Settings::save_settings( $_POST['form_data'] );
        }

        $dev_id = $_POST['dev_id'];
        $dev_public_key = trim( $_POST['dev_public_key'] );
        $dev_secret_key = trim( $_POST['dev_secret_key'] );

        if( empty( $dev_id ) || empty( $dev_id ) || empty( $dev_id ) ) {
            echo json_encode(array(
                'status' => 'error', 
                'message' => __( 'Make sure your Dev ID or Public Key or Secret Key is valid.', 'notificationx-pro' )
            ));
        }

        if( $dev_id && $dev_public_key && $dev_secret_key ) {
            if( ! empty( $dev_id ) && ! empty( $dev_public_key ) && ! empty( $dev_secret_key ) ) {
                $connection = self::freemius( 'developer', $dev_id, $dev_public_key, $dev_secret_key );

                if( $connection instanceof Freemius_Api_WordPress ) {

                    $api_data = $connection->Api( '/plugins.json' );

                    $results = self::get_theme_or_plugin_list( $api_data );

                    if( ! empty( $results ) ) {
                        update_option( 'nxpro_freemius_data', $results );

                        echo json_encode(array(
                            'status' => 'success',
                        ));
                    } else {
                        echo json_encode(array(
                            'status' => 'error', 
                            'message' => __( 'Something went wrong.', 'notificationx-pro' )
                        ));
                    }
                } else {
                    echo json_encode(array(
                        'status' => 'error', 
                        'message' => __( 'Something went wrong.', 'notificationx-pro' )
                    ));
                }
                die;
            }
        } else {
            echo json_encode(array(
                'status' => 'error', 
                'message' => __( 'Make sure your Dev ID or Public Key or Secret Key is valid.', 'notificationx-pro' )
            ));
        }

        die;
    }

    public static function get_theme_or_plugin_list( $api_data = array() ){
        $data = array();
        $new_data = array();

        $needed_key = array( 'slug', 'title', 'installs_count', 'active_installs_count', 'free_releases_count', 'premium_releases_count', 'total_purchases', 'total_subscriptions', 'total_renewals', 'accepted_payments', 'id', 'created', 'icon' );

        if( ! empty( $api_data->plugins ) ) {
            foreach( $api_data->plugins as $single_data ) {
                $type = $single_data->type;
                foreach( $needed_key as $key ) {
                    if( $key == 'created' ) {
                        if( isset( $single_data->$key ) ) {
                            $new_data[ 'timestamp' ] = strtotime( $single_data->$key );
                        }
                        continue;
                    }
                    if( isset( $single_data->$key ) ) {
                        $new_data[ $key ] = $single_data->$key;
                    }
                }
                $data[ $type . 's' ][ $new_data['id'] ] = $new_data;
                $new_data = array();
            }
        }

        return $data;
    }

    public static function get_reviews_ready( $reviews, $plugin_name = '' ){
        if( empty( $reviews ) ) { return []; }
        $new_reviews = array();
        $unsets = array( 'plugin_id', 'external_id', 'user_id', 'license_id', 'is_verified', 'environment', 'updated' );

        if( isset( $reviews->reviews ) ) {
            foreach( $reviews->reviews as $review ) {
                $review = json_decode(json_encode( $review ), true);
                foreach( $review as $key => $value ) {
                    if( in_array( $key, $unsets ) ) {
                        unset( $review[ $key ] );
                    }
                    if( $key === 'created' ) {
                        $review['timestamp'] = strtotime( $review['created'] );
                        unset( $review[ 'created' ] );
                    }
                    if( $key === 'rate' ) {
                        $review['rating'] = ceil( ( 5 * intval( $review['rate'] ) ) / 100 );
                        unset( $review[ 'rate' ] );
                    }
                    if( $key === 'name' ) {
                        $review['username'] = $review['name'];
                        unset( $review[ 'name' ] );
                    }
                }
    
                $review['plugin_name'] = $plugin_name;
                $review['link'] = '';
                $new_reviews[] = $review;
            }
        }
        return $new_reviews;
    }

    public static function get_stats_ready( $total_stats, $item_stats, $type, $item_id ){
        $total_stats_results = self::get_theme_or_plugin_list( $total_stats );
        $total_stats_results = isset( $total_stats_results[ $type . 's' ], $total_stats_results[ $type . 's' ][ $item_id ] ) ? $total_stats_results[ $type . 's' ][ $item_id ] : [];
        if( isset( $total_stats_results['active_installs_count'] ) ) {
            $total_stats_results['active_installs'] = $total_stats_results['active_installs_count'];
            unset( $total_stats_results['active_installs_count'] );
        }
        if( isset( $total_stats_results['installs_count'] ) ) {
            $total_stats_results['all_time'] = $total_stats_results['installs_count'];
            unset( $total_stats_results['installs_count'] );
        }
        if( isset( $total_stats_results['title'] ) ) {
            $total_stats_results['name'] = $total_stats_results['title'];
            unset( $total_stats_results['title'] );
        }
        if( isset( $total_stats_results['timestamp'] ) ) {
            unset( $total_stats_results['timestamp'] );
        }
        $today_to_last_week = self::today_to_last_week( $item_stats->installs );
        return array_merge( $total_stats_results, $today_to_last_week );
    }

    private static function today_to_last_week( $data ){
        if( empty( $data ) ) {
            return array();
        }
        $new_data = array();
        $timestamp = current_time( 'timestamp' );
        $date = date( 'Y-m-d', $timestamp );
        $date_7_days_back = date( 'Y-m-d', strtotime( $date . ' -8 days' ) );
        $counter_7days = 0;
        $counter_todays = 0;
        foreach( $data as $single_install ) {
            date( 'Y-m-d', strtotime( $single_install->created ) ) > $date_7_days_back ? $counter_7days++ : $counter_7days;
            date( 'Y-m-d', strtotime( $single_install->created ) ) == $date ? $counter_todays++ : $counter_todays;
        }
        return array(
            'last_week' => $counter_7days,
            'today'     => $counter_todays,
        );
    }

    public static function get_sales_data( $subscriptions, $users ){
        if( empty( $subscriptions ) || empty( $users ) ) {
            return array();
        }
        if( ! isset( $subscriptions->subscriptions ) || empty( $subscriptions->subscriptions ) || ! isset( $users->users ) || empty( $users->users ) ) {
            return array();
        }

        $needed_key_from_users         = array( 'id', 'ip', 'picture', 'first', 'last', 'email' );
        $needed_key_from_subscriptions = array( 'plugin_id', 'user_id', 'country_code', 'created' );
        $sales_data         = array();
        $subscribtions_data = array();
        $users_data = array();

        foreach( $users->users as $user ) {
            foreach( $user as $u_key => $u_value ) {
                if( ! in_array( $u_key, $needed_key_from_users ) ) {
                    unset( $user->{ $u_key } );
                }
            }
            $user = json_decode( json_encode( $user ), true );
            $user['first_name'] = isset( $user['first'] ) && ! empty( $user['first'] ) ? $user['first'] : '';
            $user['last_name'] = isset( $user['last'] ) && ! empty( $user['last'] ) ? $user['last'] : '';
            unset( $user['first'] ); unset( $user['last'] );
            
            $user['name'] = $user['first_name'] . ' ' . $user['last_name'];

            $users_data[ $user['id'] ] = $user;
        }
        $user = array();
        foreach( $subscriptions->subscriptions as $subscribtion ) {
            foreach( $subscribtion as $key => $value ) {
                if( ! in_array( $key, $needed_key_from_subscriptions ) ) {
                    unset( $subscribtion->{ $key } );
                }
            }

            if( isset( $subscribtion->created ) ) {
                $subscribtion->timestamp = strtotime( $subscribtion->created );
                unset( $subscribtion->created );
            }

            // $subscribtions_data[ $subscribtion->user_id ] = json_decode( json_encode( $subscribtion ), true );
            if( isset( $users_data[ $subscribtion->user_id ] ) ) {
                $user = $users_data[ $subscribtion->user_id ];
            }
            $sales_data[ $subscribtion->user_id . '-' . $subscribtion->plugin_id ] = array_merge( 
                json_decode( json_encode( $subscribtion ), true ), 
                $user
            );
        }

        return $sales_data;
    }
}