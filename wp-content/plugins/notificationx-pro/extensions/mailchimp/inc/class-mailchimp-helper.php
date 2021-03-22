<?php
/**
 * This class is a Helper Class for Mailchimp
 * 
 * @package NotificationX Pro
 * @subpackage  NotificationX Pro/extensions
 */
class NotificationXPro_MailChimpHelper {
    public static function get_members( $api_key = '', $list_id = '', $limit = 20 ) {
        $response = array(
			'error'      => false,
			'members'    => array()
		);

        // Make sure we have an API key.
		if ( empty( $api_key ) ) {
			$response['error'] = __( 'Error: You must provide an API key.', 'notificationx-pro' );
		}

        // Make sure we have list id.
		if ( empty( $list_id ) ) {
			$response['error'] = __( 'Error: You must provide a list ID.', 'notificationx-pro' );
		}

        if ( ! $response['error'] ) { 
            try {
                $api = self::mailchimp( $api_key );
                $members = $api->get( 'lists/' . $list_id . '/members', [
                    'count' => $limit,
                    'sort_dir' => 'DESC',
                    'sort_field' => 'timestamp_opt'
                ]);

                $response['members'] = $members;
            } catch ( \Exceptions $e ) {
                $response['error'] = __( 'Error: Something wrong ', 'notificationx-pro' );
            }
        }

        return $response;
    }
    
    public static function mailchimp_tab_settings(){
        /**
         * Verify the Nonce
         */
        if ( ( ! isset( $_POST['nonce'] ) && ! isset( $_POST['key'] ) ) || ! 
        wp_verify_nonce( $_POST['nonce'], 'nx_'. $_POST['key'] .'_nonce' ) ) {
            return;
        }
        
        if( isset( $_POST['form_data'] ) ) {
            NotificationX_Settings::save_settings( $_POST['form_data'] );
        }
        
        if( isset( $_POST['api_key'] ) ) {
            $mailchimp_key = $_POST['api_key'];
            if( ! empty( $mailchimp_key ) ) {
                $connection = self::mailchimp( $mailchimp_key );

                if( $connection instanceof NotificationXPro_MailChimp ) {
                    $last_status = $connection->getLastError();
                    if( ! $last_status ) {
                        $lists = self::get_lists( $connection );

                        if( $lists ) {
                            update_option( 'nxpro_mailchimp_lists', $lists );
                        }
                        echo json_encode(array(
                            'status' => 'success',
                        ));
                    } else {
                        echo json_encode(array(
                            'status' => 'error', 
                            'message' => $last_status
                        ));
                    }

                } else {
                    echo json_encode(array(
                        'status' => 'error', 
                        'message' => 'Something went wrong.'
                    ));
                }
                die;
            }
        } else {
            echo json_encode(array(
                'status' => 'error', 
                'message' => 'Please insert a valid API key.'
            ));
        }

        die;
    }

    private static function get_lists( $mailchimp ){
        $options = [ '' => 'Select One' ];
        if( ! empty( $mailchimp ) ) {
            $results = $mailchimp->get( 'lists' );
            foreach($results['lists'] as $list) {
                $options[ $list['id'] ] = $list['name'];
            }
            return $options;
        } else {
            return false;
        }
    }

    private static function mailchimp( $api_key ){
        if( empty( $api_key ) ) {
            return false;
        }
        try {
            $mailchimp = new NotificationXPro_MailChimp( $api_key );
            $mailchimp->get('ping');
        } catch( \Exception $e ) {
            return false;
        }

        return $mailchimp;
    }
}