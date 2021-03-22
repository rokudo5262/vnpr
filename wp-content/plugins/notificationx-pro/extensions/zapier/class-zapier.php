<?php
/**
* This Class is responsible for making mailchimp activity
* notifications.
*/
class NotificationXPro_Zapier_Extension extends NotificationX_Extension {
    /**
    *  Type of notification.
    * @var string
    */
    public  $type     = 'zapier';
    public  $template = 'mailchimp_template';
    public  $themeName = 'mailchimp_theme';
    public  $meta_key = 'zapier_content';
    public  $api_key = '';
    public $notifications = array();
    
    public function __construct() {
        parent::__construct();
        /**
         * @since 1.1.3
         */
        add_action( 'add_meta_boxes',array( $this, 'add_metabox' ) );
        add_action( 'nx_api_response_success', array( $this, 'get_response' ) );
        add_action( 'nx_notification_image_action', array( $this, 'image_action' ) );
        add_filter( 'nx_data_key', array( $this, 'key' ), 10, 2 );
    }
    /**
     * Instructions Box
     * @since 1.1.3
     */
    public function add_metabox(){
        add_meta_box( 'nxpro-zapier-instructions', __( 'Zapier setup instructions', 'notificationx-pro' ), array( $this,'metabox_content'), 'notificationx', 'side' );
    }
    /**
     * Instructions Content
     * @since 1.1.3
     */
    public function metabox_content(){
        ob_start();
        ?>
        <div class="instructions-wrapper">
            <div class="instructions-header">
                <i class="dashicons dashicons-info"></i>
                <span class="title"><?php _e('Zapier setup Instructions', 'notificationx-pro'); ?></span>
            </div>
            <div class="instructions">
                <p><?php 
                    $format = sprintf('Make sure that you have <a target="_blank" rel="nofollow" href="%1$s">created a Zap</a> with your preferred Application. From Zap Builder, you need to choose <strong>NotificationX</strong> as your Action App. You can get the public invitation link from <a href="%2$s" target="_blank" rel="nofollow">here</a>', 'https://zapier.com/learn/getting-started-guide/build-zap-workflow', 'https://zapier.com/developer/public-invite/28239/62de3486b323cd5830e27b251183a456' );
                    _e( $format, 'notificationx-pro' );
                ?></p>
                <p><?php 
                    $format = sprintf("For further assistance, check out this <a href='%s' rel='nofollow'>Documentation</a>", "https://notificationx.com/docs/zapier-notification-alert/");
                    _e( $format, 'notificationx-pro' );
                ?>
                </p>
                <div class="nx-template-keys-wrapper">
                    <h3><?php _e( 'Template Keys', 'notificationx' ); ?></h3>
                    <ul class="conversions nx-template-keys">
                        <li><span>Field Name:</span> <strong>Field Key</strong></li>
                        <li><span>Full Name:</span> <strong>name</strong></li>
                        <li><span>First Name:</span> <strong>first_name</strong></li>
                        <li><span>Last Name:</span> <strong>last_name</strong></li>
                        <li><span>Sales Count:</span> <strong>sales_count</strong></li>
                        <li><span>Customer Email:</span> <strong>email</strong></li>
                        <li><span>Title, Product Title:</span> <strong>title</strong></li>
                        <li><span>Anonymous Title, Product:</span> <strong>anonymous_title</strong></li>
                        <li><span>Definite Time:</span> <strong>timestamp</strong></li>
                        <li><span>Sometime:</span> <strong>sometime</strong></li>
                        <li><span>In last 1 day:</span> <strong>1day</strong></li>
                        <li><span>In last 7 days:</span> <strong>7days</strong></li>
                        <li><span>In last 30 days:</span> <strong>30days</strong></li>
                        <li><span>City:</span> <strong>city</strong></li>
                        <li><span>Country:</span> <strong>country</strong></li>
                        <li><span>City,Country:</span> <strong>city_country</strong></li>
                    </ul>
                    <ul class="reviews nx-template-keys">
                        <li><span>Field Name:</span> <strong>Field Key</strong></li>
                        <li><span>Username:</span> <strong>username</strong></li>
                        <li><span>Email:</span> <strong>email</strong></li>
                        <li><span>Rated:</span> <strong>rated</strong></li>
                        <li><span>Plugin Name:</span> <strong>plugin_name</strong></li>
                        <li><span>Plugin Review:</span> <strong>plugin_review</strong></li>
                        <li><span>Review Title:</span> <strong>title</strong></li>
                        <li><span>Anonymous Title:</span> <strong>anonymous_title</strong></li>
                        <li><span>Rating:</span> <strong>rating</strong></li>
                        <li><span>Definite Time:</span> <strong>timestamp</strong></li>
                        <li><span>Some time ago:</span> <strong>sometime</strong></li>
                    </ul>
                    <ul class="email_subscription nx-template-keys">
                        <li><span>Field Name:</span> <strong>Field Key</strong></li>
                        <li><span>Full Name:</span> <strong>name</strong></li>
                        <li><span>First Name:</span> <strong>first_name</strong></li>
                        <li><span>Last Name:</span> <strong>last_name</strong></li>
                        <li><span>Email:</span> <strong>email</strong></li>
                        <li><span>Title, Product Title:</span> <strong>title</strong></li>
                        <li><span>Anonymous Title:</span> <strong>anonymous_title</strong></li>
                        <li><span>Definite Time:</span> <strong>timestamp</strong></li>
                        <li><span>Some time ago:</span> <strong>sometime</strong></li>
                        <li><span>City:</span> <strong>city</strong></li>
                        <li><span>Country:</span> <strong>country</strong></li>
                        <li><span>City,Country:</span> <strong>city_country</strong></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        return ob_get_flush();
    }
    /**
    * This method is used for fallback data
    * @since 1.1.2
    */
    public function fallback_data( $data, $saved_data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) !== $this->type ) {
            return $data;
        }
        
        if( isset( $saved_data['display_type'] ) && $saved_data['display_type'] == 2 ) {
            if( ! isset( $saved_data['username'] ) ) {
                $data['username'] = __('Someone', 'notificationx-pro');
            }

            if( ! isset( $saved_data['plugin_name'] ) ) {
                $data['plugin_name'] = __('', 'notificationx-pro');
            }

            if( ! isset( $saved_data['plugin_review'] ) && isset( $saved_data['content'] ) ) {
                $data['plugin_review'] = __($saved_data['content'], 'notificationx-pro');
            }
            
            if( ! isset( $saved_data['rating'] ) ) {
                $data['rating'] = 5;
            }
        }
        
        return $data;
    }
    
    public function key( $key, $settings ){
        if( $settings->display_type === 'email_subscription' && $settings->subscription_source === 'zapier' ) {
            $key = $key . '_' . $settings->id;
        }
        
        if( $settings->display_type === 'reviews' && $settings->reviews_source === 'zapier' ) {
            $key = $key . '_' . $settings->id;
        }
        
        if( $settings->display_type === 'conversions' && $settings->conversion_from === 'zapier' ) {
            $key = $key . '_' . $settings->id;
        }
        
        return $key;
    }
    
    public function get_response( $response ){
        if ( isset( $response['id'] ) ) {
            $response['entry_id'] = time();
            $response['timestamp'] = time();
            
            if( isset( $response['ip'] ) ) {
                $remote_response = self::remote_get( 'http://ip-api.com/json/' . $response['ip'] );
                
                if( $remote_response ) {
                    $response['country'] = $remote_response->country;
                    $response['city'] = $remote_response->country;
                }
            }
            
            if( isset( $response['display_type'] ) && $response['display_type'] == 2 ) {
                if( isset( $response['plugin_name'] ) && empty( $response['plugin_name'] ) ) {
                    $response['plugin_name'] = $response['plugin_name'];
                }
            }
            
            $key = $this->type . '_' . $response['id'];
            
            if( isset( $response['display_type'] ) && $response['display_type'] == 1 ) {
                $products = $this->extract_data( $response['products'] );
                unset( $response['products'] );
                if( ! empty( $products ) ) {
                    foreach( $products as $product ) {
                        $product_item = array_merge($response, $product);
                        $this->save( $key, $product_item, $response['timestamp'] );
                    }
                    return true;
                }
            }
            if( isset( $response['display_type'] ) && $response['display_type'] == 4 ) {
                if( isset( $response['custom_data'] ) && ! empty( $response['custom_data'] ) ) {
                    $custom_data = $response['custom_data'];
                    unset( $response['custom_data'] );
                    $response = array_merge( $response, $custom_data );
                }
            }
            if( isset( $response['rest_route'] ) ) {
                unset( $response['rest_route'] );
            }
            if( isset( $response['display_type'] ) ) {
                unset( $response['display_type'] );
            }

            if( isset( $response['timestamp'] ) && ! is_numeric( $response['timestamp'] ) ) {
                $response['timestamp'] = strtotime( $response['timestamp'] );
            }

            $this->save( $key, $response, $response['timestamp'] );
        }
    }
    
    public function init_hooks(){
        add_filter( 'nx_email_subscription_source', array( $this, 'toggle_fields' ) );
        add_filter( 'nx_conversion_from', array( $this, 'conversion_toggle_fields' ) );
        add_filter( 'nx_reviews_source', array( $this, 'reviews_toggle_fields' ) );
    }
    
    public function init_builder_hooks(){
        add_filter( 'nx_builder_tabs', array( $this, 'builder_toggle_fields' ) );
    }
    /**
    * This function is responsible for render toggle data for conversion
    *
    * @param array $options
    * @return void
    */
    public function toggle_fields( $options ) {
        $fields = array();
        $fields = array_merge( NotificationX_ToggleFields::common_fields(), $fields, array( 'mailchimp_template_new', 'mailchimp_template_adv' ) );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        
        $options['dependency'][ $this->type ]['fields'] = $fields;
        $options['dependency'][ $this->type ]['sections'] = ['image', 'mailchimp_themes'];
        $options['hide'][ $this->type ]['fields'] = [ 'mailchimp_list', 'has_no_edd', 'has_no_woo' ];
        
        return $options;
    }
    
    public function conversion_toggle_fields( $options ) {
        $fields = array();
        $fields = array_merge( NotificationX_ToggleFields::common_fields(), $fields, array( 'conversion_from', 'show_notification_image', 'woo_template_new', 'woo_template_adv') );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        
        $options['dependency'][ $this->type ]['fields'] = $fields;
        $options['dependency'][ $this->type ]['sections'] = ['themes', 'image', 'conversion_link_options'];     
        $options['hide'][ $this->type ][ 'fields' ] = [ 'woo_template', 'has_no_edd', 'has_no_woo', 'product_control', 'product_exclude_by', 'product_list', 'category_list', 'exclude_categories', 'exclude_products', 'edd_product_control', 'edd_product_exclude_by', 'edd_product_list', 'edd_category_list', 'edd_exclude_categories', 'edd_exclude_products', 'custom_contents', 'show_custom_image' ];
        return $options;
    }
    public function reviews_toggle_fields( $options ) {
        $fields = array( 'wp_reviews_template_new', 'review_saying_template_new', 'wp_reviews_template_adv', 'show_notification_image' );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        $options['dependency'][ $this->type ]['fields'] = $fields;
        $options['dependency'][ $this->type ]['sections'] = array( 'wporg_themes' );
        return $options;
    }
    
    public function builder_toggle_fields( $options ) {
        $fields = array();
        $sections = array();
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        $options['source_tab']['sections']['config']['fields']['display_type']['dependency'][ $this->type ]['fields'] = $fields;
        $options['source_tab']['sections']['config']['fields']['display_type']['dependency'][ $this->type ]['sections'] = $sections;
        return $options;
    }
    
    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'notification_image' ), 10, 3 );
    }
    
    public function notification_image( $image_data, $data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) != 'zapier' ) { 
            return $image_data;
        }
        
        $avatar = '';
        $alt_title = isset( $data['title'] ) ? $data['title'] : '';
        $alt_title = empty( $alt_title ) && isset( $data['plugin_name'] ) ? $data['plugin_name'] : $alt_title;
        
        if( isset( $data['review_from'] ) && $data['review_from'] == 'twitter' && ! isset( $data['avatar'] ) ) {
            $avatar = NOTIFICATIONX_PRO_URL . 'assets/images/icons/twitter.png';
        }

        if( isset( $data['review_from'] ) && $data['review_from'] == 'facebook' && ! isset( $data['avatar'] ) ) {
            $avatar = NOTIFICATIONX_PRO_URL . 'assets/images/icons/facebook.png';
        }

        if( isset( $data['avatar'] ) && ! empty( $data['avatar'] ) ) {
            $avatar = $data['avatar'];
        }
        
        $image_data['url'] = $avatar;
        $image_data['alt'] = $alt_title;
        
        return $image_data;
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
    }
    public function admin_actions(){
        if( ! $this->is_created( $this->type ) ) {
            return;
        }
    }
    
    public function frontend_html( $data = [], $settings = false, $args = [] ){
        if( $settings->display_type === 'reviews' ) {
            $args['template'] = 'wp_reviews_template';
            $args['themeName'] = 'wporg_theme';
            if( ! isset( $data['rating'] ) ) {
                $data['rating'] = 5;
            }
            if( ! empty( $data['rating'] ) ) {
                for( $i = 1; $i <= $data['rating']; $i++ ) {
                    $star .= '<svg height="14" viewBox="0 -10 511.98685 511" width="14" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0" fill="#ffc107"/></svg>';
                }
                if( ( $data['rating'] + 1 ) <= 5 ) {
                    for( $i = $data['rating'] + 1; $i <= 5; $i++ ) {
                        $star .= '<svg height="14" viewBox="0 -10 511.98685 511" width="14" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0" fill="#f2f2f2"/></svg>';
                    }
                }
                $data['rating'] = $star;
            }
        }
        
        if( $settings->display_type === 'conversions' ) {
            $args['template'] = 'woo_template';
            $args['themeName'] = 'theme';
        }
        
        return parent::frontend_html( $data, $settings, $args );
    }
    
    protected function extract_data( $data ) {
        if( empty( $data ) ) {
            return [];
        }
        
        $new_data = [];
        $i = 0;
        
        $data = explode("\n", $data);
        foreach( $data as $value ) {
            if( empty( $value ) ){
                $i++;
                continue;
            }
            $inner_array = explode(":", $value);
            if( is_array( $inner_array ) ) {
                if( $inner_array[0] === 'product_id' ) {
                    $new_data[$i]['product_id'] = trim( $inner_array[1] );
                }
                if( $inner_array[0] === 'name' ) {
                    $new_data[$i]['title'] = trim( $inner_array[1] );
                }
            }
            $inner_array = [];
        }
        
        return $new_data;
    }
}