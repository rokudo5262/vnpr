<?php

/**
 * This class is responsible for making pro feature enabled in
 * options. e.g: Notification Image Customization, Display Last Conversions Limit, etc.
 */

class NotificationXPro_RestAPI {
    private static $_instance = null;
    private $namespace = 'notificationx';

    public function __construct(){
        add_action( 'rest_api_init', array( $this, 'routes' ) );
    }

    public function routes(){

        register_rest_route( $this->namespace, '/notification/(?P<id>\d+)', array(
            'methods'   => 'GET',
            'callback'  => array( $this, 'get_response' ),
            'permission_callback' => '__return_true',
            'args'      => array(
                'id' => array(
                    'validate_callback' => function($param, $request, $key) {
                        return is_numeric( $param );
                    }
                ),
            )
        ));

        register_rest_route( $this->namespace, '/notification/(?P<id>\d+)', array(
            'methods'             => 'POST',
            'callback'            => array( $this, 'save_response' ),
            'permission_callback' => '__return_true',
            'args'                => array(
                'id' => array(
                    'validate_callback' => function($param, $request, $key) {
                        return is_numeric( $param );
                    }
                ),
            ),
        ));
    }

    public function get_response( WP_REST_Request $request ){
        $id        = $request['id'];
		$api_key   = $request['api_key'];
        $error     = [];
        $post_type = get_post_type( $id );

		if( $api_key === md5( home_url( '', 'http' ) ) || $api_key === md5( home_url( '', 'https' ) ) ) {
			if( $post_type === 'notificationx' ) {
				$notificationx = get_post( $id );
				if( $notificationx ) {
                    return wp_send_json( true );
				}
			} else {
				$error['message'] = __( 'There is no notification created with this id:' . $id, 'notificationx-pro' );
				return wp_send_json_error( $error, 401 );
			}
		} else {
			$error['message'] = __( 'Error: API Key Invalid!', 'notificationx-pro' );
			return wp_send_json_error( $error, 401 );
		}
    }

    public function save_response( WP_REST_Request $request ){
        $response_data = array(
            'data'      => '',
            'error'     => false
        );

        if ( ! isset( $request['api_key'] ) ) {
            $response_data['error'] = __('Error: You should provide an API key.', 'notificationx-pro');
        } else {
            if( md5( home_url( '', 'http' ) ) != $request['api_key'] && md5( home_url( '', 'https' ) ) != $request['api_key'] ) {
                $response_data['error'] = __('Error: Invalid API key.', 'notificationx-pro');
            }
        }

        if ( ! $response_data['error'] ) {
            $response_data['data'] = $request->get_params();
            if ( isset( $response_data['data']['api_key'] ) ) {
                unset( $response_data['data']['api_key'] );
            }
            do_action( 'nx_api_response_success', $response_data['data'] );
        }

        return apply_filters( 'nx_api_response', $response_data );
    }

    public static function get_instance(){
        if( self::$_instance === null ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
// Instantiate NotificationXPro_RestAPI
NotificationXPro_RestAPI::get_instance();