<?php
/**
 * This Class is responsible for making convertkit activity
 * notifications.
 */
define( 'NOTIFICATIONX_PRO_CONVERTKIT_DIR_URI', dirname( __FILE__ ) );

class NotificationXPro_ConvertKit_Extension extends NotificationX_Extension {
    /**
     *  Type of notification.
     * @var string
     */
    public  $type     = 'convertkit';
    public  $template = 'mailchimp_template';
    public  $themeName = 'mailchimp_theme';
    public  $meta_key = 'convertkit_content';
    public  $api_key = '';
    public  $api_secret = '';

    public function __construct() {
        parent::__construct();

        $this->api_key = get_option( 'nxpro_convertkit_api_key' );
        $this->api_secret = get_option( 'nxpro_convertkit_api_secret' );
        
        add_action( 'nx_notification_image_action', array( $this, 'image_action' ) );
        add_action( 'wp_ajax_nx_convertkit_connect', array( $this, 'convertkit_tab_settings' ) );
        add_action( 'nx_cron_update_data', array( $this, 'update_data' ), 10, 1 );
        add_filter( 'nxpro_js_scripts', array( $this, 'convertkit_js_text' ), 10, 1 );
    }

    public function fallback_data( $data, $saved_data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) !== $this->type ) {
            return $data;
        }

        $data['name']       = $this->notEmpty( 'name', $saved_data ) ? $saved_data['name'] : __( 'Someone', 'notificationx-pro' );
        $data['first_name'] = $this->notEmpty( 'first_name', $saved_data ) ? $saved_data['first_name'] : __( 'Someone', 'notificationx-pro' );
        $data['last_name']  = $this->notEmpty( 'last_name', $saved_data ) ? $saved_data['last_name'] : __( 'Someone', 'notificationx-pro' );
        $data['sometime']   = __( 'Some time ago', 'notificationx-pro' );

        if( NotificationX_Helper::get_theme( $settings ) === 'maps_theme' ) {
            $data['city']  = $this->notEmpty( 'city', $saved_data ) ? __( 'from ', 'notificationx-pro' ) . $saved_data['city'] : __( 'Somewhere', 'notificationx-pro' );
            $data['country']  = $this->notEmpty( 'country', $saved_data ) ? __( 'from ', 'notificationx-pro' ) . $saved_data['country'] : __( 'Somewhere', 'notificationx-pro' );
        }

        return $data;
    }
    
    public function convertkit_js_text( $data ){
        $data['mc_on_success'] = __('You have successfully connected with ConvertKit, Your lists has been recorded for future use.', 'notificationx-pro');
        $data['mc_on_error'] = __('Something went wrong. Try again.', 'notificationx-pro');

        return $data;
    }

    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'notification_image' ), 10, 3 );
    }

    public function notification_image( $image_data, $data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) != 'convertkit' ) { 
            return $image_data;
        }
        if( ! $settings->show_avatar ) {
            return $image_data;
        }
    
        $avatar = '';
        $alt_title = isset( $data['title'] ) ? $data['title'] : '';
        $alt_title = empty( $alt_title ) && isset( $data['name'] ) ? $data['name'] : $alt_title;

        if( isset( $data['email'] ) ) {
            $avatar = get_avatar_url( $data['email'], array(
                'size' => '100',
            ));
        }

        $image_data['url'] = $avatar;
        $image_data['alt'] = $alt_title;

        return $image_data;
    }

    private function get_forms( $convertkit = false ){
        $options = [ '' => 'Select One' ];

        if( $convertkit !== false ) {
            if( isset( $convertkit->forms ) && ! empty( $convertkit->forms ) ) {
                foreach( $convertkit->forms as $form ) {
                    $options[ $form->id ] = $form->name;
                }
                return $options;
            } else {
                return false;
            }
        }


        $results = get_option( 'nxpro_convertkit_forms' );
        
        if( ! empty( $results ) ) {
            foreach($results as $key => $list) {
                $options[ $key ] = $list;
            }
        }

        return $options;
    }

    private function init_fields(){
        $fields = [];
        $api_key = NotificationX_DB::get_settings( 'convertkit_api_key' );
        if( empty( $api_key ) ) {
            $fields['has_no_convertkit_key'] = array(
                'type'     => 'message',
                'message'    => __('You have to setup your API Key for <a href="'. admin_url('admin.php?page=nx-settings#api_integrations_tab') .'">ConvertKit</a>.' , 'notificationx-pro'),
                'priority' => 0,
            );
        }

        $fields['convertkit_form'] = array(
            'type'     => 'select',
            'label'    => __('ConvertKit Form' , 'notificationx-pro'),
            'priority' => 61,
            'options'  => $this->get_forms(),
        );
        
        return $fields;
    }

    private function get_fields(){
        return $this->init_fields();
    }

    public function init_hooks(){
        add_filter( 'nx_metabox_tabs', array( $this, 'add_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_email_subscription_source', array( $this, 'toggle_fields' ) );
    }

    public function init_builder_hooks(){
        add_filter( 'nx_builder_tabs', array( $this, 'add_builder_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_builder_fields' ) );
        add_filter( 'nx_builder_tabs', array( $this, 'builder_toggle_fields' ) );
    }

    /**
     * This function is responsible for adding fields to helper files.
     *
     * @param array $options
     * @return void
     */
    public function add_fields( $options ){
        $fields = $this->get_fields();
        foreach ( $fields as $name => $field ) {
            if( $name == 'has_no_convertkit_key' ) {
                $options[ 'source_tab' ]['sections']['config']['fields'][ $name ] = $field;
                continue;    
            }
            $options[ 'content_tab' ]['sections']['content_config']['fields'][ $name ] = $field;
        }
        return $options;
    }

    public function add_builder_fields( $options ){
        $fields = $this->get_fields();
        foreach ( $fields as $name => $field ) {
            $options['source_tab']['sections']['config']['fields'][ $name ] = $field;
        }
        return $options;
    }
    /**
     * This function is responsible for hide fields when others type selected.
     *
     * @param array $options
     * @return void
     */
    public function hide_fields( $options ) {
        $fields = array_merge( $this->get_fields() );        
        foreach ( $fields as $name => $field ) {
            foreach( $options as $opt_key => $opt_value ) {
                if( $opt_key != 'email_subscription' ) {
                    $options[ $opt_key ][ 'fields' ][] = $name;
                }
            }
        }
        return $options;
    }
    public function hide_builder_fields( $options ) {
        $fields = array_merge( $this->get_fields(), ['edd_template', 'woo_template'] );
        foreach( $fields as $field_key => $field_value ) {
            foreach( $options as $opt_key => $opt_value ) {
                $options[ $opt_key ][ 'fields' ][] = $field_key;
            }
        }
        return $options;
    }
    /**
     * This function is responsible for render toggle data for conversion
     *
     * @param array $options
     * @return void
     */
    public function toggle_fields( $options ) {
        $fields = array_keys( $this->get_fields() );
        $fields = array_merge( NotificationX_ToggleFields::common_fields(), $fields, array( 'mailchimp_template_new', 'mailchimp_template_adv', 'show_avatar' ) );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        $options['dependency'][ $this->type ]['fields'] = $fields;
        $options['dependency'][ $this->type ]['sections'] = ['image', 'mailchimp_themes'];
        $options['hide'][ $this->type ][ 'fields' ] = [ 'mailchimp_list', 'show_notification_image' ];

        return $options;
    }
    public function builder_toggle_fields( $options ) {
        $fields = $this->get_fields();
        unset( $fields[ $this->template ] );
        $fields = array_keys( $fields );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        $options['source_tab']['sections']['config']['fields']['display_type']['dependency'][ $this->type ]['fields'] = $fields;
        return $options;
    }

    /**
     * This functions is hooked
     * 
     * @hooked nx_public_action
     *
     * @return void
     */
    public function public_actions(){
        if( ! $this->is_created( $this->type ) ) {
            return;
        }
        
        add_filter( 'nx_fields_data', array( $this, 'conversion_data' ), 10, 2 );
    }
    public function admin_actions(){
        if( ! $this->is_created( $this->type ) ) {
            return;
        }
    }

    public function save_post( $post_id, $post, $update ) {
        if( $post->post_type !== 'notificationx' || ! $update ) {
            return;
        }
        if( ! $this->check_type( $post_id ) ) {
            return;
        }
        if( $post->post_status === 'trash' ) {
            NotificationX_Cron::clear_schedule( array( 'post_id' => $post_id ) );
            return;
        }

        $this->update_data( $post_id );
		NotificationX_Cron::set_cron( $post_id, 'nx_convertkit_interval' );
    }

    public function update_data( $post_id ){
        if ( empty( $post_id ) ) {
            return;
        }
        if( ! $this->check_type( $post_id ) ) {
            return;
        }

        $members = $this->get_member( $post_id );
        NotificationX_Admin::update_post_meta( $post_id, $this->meta_key, $members );
    }

    public function conversion_data( $data, $id ){
        if( ! $id ) {
            return $data;
        }
        $data[ $this->type ] = NotificationX_Admin::get_post_meta( intval( $id ), $this->meta_key, true );
        return $data;
    }

    public function get_member( $post_id ) {
        $members = [];
        $conversion_source = NotificationX_Admin::get_post_meta( $post_id, 'subscription_source' );

        if ( 'convertkit' != $conversion_source ) {
            return $post_id;
        }

        $form_id = NotificationX_Admin::get_post_meta( $post_id, 'convertkit_form' );

        // Return of convertkit list field is empty.
        if ( ! $form_id || empty( $form_id ) ) {
            return $post_id;
        }

        // Return if api key is empty.
        if ( ! $this->api_secret || empty( $this->api_secret ) ) {
            return $post_id;
        }

        // Get limit.
        $limit = NotificationX_Admin::get_post_meta( $post_id, 'display_last' );

        // Set limit to 100 if empty.
        if ( empty( $limit ) || ! $limit ) {
            $limit = 20;
        }

		$response = $this->get_members( $this->api_secret, $form_id, $limit );
        

		if ( $response['error'] ) {
            $response->errors[] = $response['error'];
            return $post_id;
        }

        $list_name = get_option( 'nxpro_convertkit_forms' );

        if( empty( $list_name[ $form_id ] ) ) {
            return $post_id;
        }

        if( ! empty( $response['members'] ) ) {

            $api_data = $response['members']->subscriptions;

            foreach( $api_data as $member ) {
                $members[] = $this->member( $member, $list_name[ $form_id ] );
            }

        }

        return $members;
    }

    private function member( $data, $title ){
        $member['title'] = $title;
        $member['email'] = $data->subscriber->email_address;

        $first_name = isset( $data->subscriber->first_name ) ? $data->subscriber->first_name : '';
        $last_name  = isset( $data->subscriber->last_name ) ? $data->subscriber->last_name : '';

        $member['first_name'] = isset( $data->subscriber->first_name ) ? $data->subscriber->first_name : '';
        $member['last_name']  = isset( $data->subscriber->last_name ) ? $data->subscriber->last_name : '';
        $member['name']       = $first_name . ' ' . $last_name;
        $member['timestamp']  = strtotime( $data->subscriber->created_at );
        $member['link']       = '';

        return $member;
    }

    public function frontend_html( $data = [], $settings = false, $args = [] ){
        $convertkit_api_key = get_option('nxpro_convertkit_api_key');
        if( ! empty( $convertkit_api_key ) ) {
            return parent::frontend_html( $data, $settings, $args );
        }
    }

    private function convertkit( $api_key, $api_secret ){
        if( empty( $api_key ) || empty( $api_secret ) ) {
            return false;
        }
        
        $request = self::remote_get( 'https://api.convertkit.com/v3/forms', array(
            'body' => array(
                'api_key' => $api_key,
                'api_secret' => $api_secret,
            )
        ) );
        
        return $request;
    }

    public function convertkit_tab_settings(){
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

        if( isset( $_POST['api_key'], $_POST['api_secret'] ) ) {
            $api_key = $_POST['api_key'];
            $api_secret = $_POST['api_secret'];
            if( ! empty( $api_key ) && ! empty( $api_secret ) ) {
                $connection = self::convertkit( $api_key, $api_secret );
                if( $connection ) {                    
                    if( ! isset( $connection->error ) ) {
                        update_option( 'nxpro_convertkit_api_key', $api_key );
                        update_option( 'nxpro_convertkit_api_secret', $api_secret );
                        $forms = $this->get_forms( $connection );

                        if( $forms ) {
                            update_option( 'nxpro_convertkit_forms', $forms );
                        }
                        echo json_encode(array(
                            'status' => 'success',
                        ));
                    } else {
                        echo json_encode(array(
                            'status' => 'error', 
                            'message' => $connection->error . '. ' . $connection->message
                        ));
                    }

                    die;

                } else {
                    echo json_encode(array(
                        'status' => 'error', 
                        'message' => $connection->error . '. ' . $connection->message
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

    protected function get_members( $api_secret = '', $form_id = '', $limit = 20 ) {
        $response = array(
			'error'      => false,
			'members'    => array()
		);

        // Make sure we have an API key.
		if ( empty( $api_secret ) ) {
			$response['error'] = __( 'Error: You must provide an API key.', 'notificationx-pro' );
		}

        // Make sure we have list id.
		if ( empty( $form_id ) ) {
			$response['error'] = __( 'Error: You must provide a Form.', 'notificationx-pro' );
        }
        
        $url = "https://api.convertkit.com/v3/forms/$form_id/subscriptions";

        if ( ! $response['error'] ) { 
            try {
                $request = self::remote_get( $url, array(
                    'body' => array(
                        'api_secret' => $api_secret,
                    )
                ) );

                if( isset( $request->error ) ) {
                    $response['error'] = $request->error . '. ' . $request->message;
                } else {
                    $response['members'] = $request;
                }

            } catch ( \Exceptions $e ) {
                $response['error'] = __( 'Error: Something wrong ', 'notificationx-pro' );
            }
        }

        return $response;
    }
}