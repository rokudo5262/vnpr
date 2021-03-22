<?php
/**
 * This Class is responsible for making freemius activity
 * notifications.
 */
define( 'NOTIFICATIONX_PRO_FREEMIUS_DIR_URI', dirname( __FILE__ ) );

class NotificationXPro_Freemius_Extension extends NotificationXPro_Extension {
    /**
     *  Type of notification.
     * @var string
     */
    public  $type     = 'freemius';
    public  $template = 'wp_reviews_template';
    public  $themeName = 'freemius_theme';
    public  $meta_key = 'freemius_content';
    public  $dev_id = '';
    public  $dev_public_key = '';
    public  $dev_secret_key = '';
    public  $lists;

    public function __construct() {
        parent::__construct();
        $this->load_dependencies();
        
        $this->dev_id         = NotificationX_DB::get_settings('freemius_dev_id');
        $this->dev_public_key = trim( NotificationX_DB::get_settings('freemius_dev_pk') );
        $this->dev_secret_key = htmlspecialchars_decode( trim( NotificationX_DB::get_settings('freemius_dev_sk') ) );
        $this->lists          = get_option( 'nxpro_freemius_data' );
        
        add_action( 'nx_notification_image_action', array( $this, 'image_action' ) );
        add_action( 'wp_ajax_nx_freemius_connect', 'NotificationXPro_Freemius_Helper::freemius_connect' );
        add_action( 'nx_cron_update_data', array( $this, 'update_data' ), 10, 1 );
        add_filter( 'nxpro_js_scripts', array( $this, 'freemius_js_text' ), 10, 1 );
    }

    public function template_string_by_theme( $template, $old_template, $posts_data ){
        if( $posts_data['nx_meta_display_type'] === 'download_stats' && NotificationX_Helper::get_type( $posts_data ) === $this->type ) {
            $theme = NotificationX_Helper::get_theme( $posts_data );
            switch( $theme ) {
                case 'theme-one' : 
                    $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'second_param', 'fourth_param' ] ) );
                    break;
                case 'theme-two' : 
                    $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'second_param', 'fourth_param' ] ) );
                    break;
                case 'actively_using' : 
                    $old_template = $posts_data['nx_meta_actively_using_template_new'];
                    $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'third_param' ] ) );
                    break;
                default : 
                    $old_template = $posts_data['nx_meta_wp_stats_template_new'];
                    $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'second_param', 'fourth_param' ] ) );
                    break;
            }

            return $template;
        }

        if( $posts_data['nx_meta_display_type'] === 'reviews' && NotificationX_Helper::get_type( $posts_data ) === $this->type ) {
            $theme = $posts_data['nx_meta_wporg_theme'];
            switch( $theme ) {
                case 'review_saying': 
                    $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'fifth_param', 'sixth_param' ] ) );
                    break;
                default : 
                    $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'third_param', 'fourth_param' ] ) );
                    break;
            }
            return $template;
        }
        if( $posts_data['nx_meta_display_type'] === 'conversions' && NotificationX_Helper::get_type( $posts_data ) === $this->type ) {
            return parent::template_string_by_theme( $template, $old_template, $posts_data );
        }

        return $template;
    }

    public function fallback_data( $data, $saved_data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) !== $this->type ) {
            return $data;
        }

        if( $settings->display_type == 'download_stats' ) {
            if( isset( $data['name'] ) ) {
                unset( $data['name'] );
            }
            $data['today']     = __( ( isset( $saved_data['today'] ) ? NotificationX_Helper::nice_number( $saved_data['today'] ) : '0' ) . ' times today', 'notificationx-pro' );
            $data['last_week'] = __( ( isset( $saved_data['last_week'] ) ? NotificationX_Helper::nice_number( $saved_data['last_week'] ) : '0' ) . ' times in last 7 days', 'notificationx-pro' );
            $data['all_time']  = __( ( isset( $saved_data['all_time'] ) ? NotificationX_Helper::nice_number( $saved_data['all_time'] ): '0' ) . ' times', 'notificationx-pro' );
            
            $data['today_text']     = __( 'Try it out', 'notificationx-pro' );
            $data['last_week_text'] = __( 'Get started free.', 'notificationx-pro' );
            $data['all_time_text']  = __( 'why not you?', 'notificationx-pro' );
            return $data;
        }

        if( $settings->display_type == 'reviews' ) { 
            $data['username']         = isset( $saved_data['username'] ) ? $saved_data['username'] : __('Someone', 'notificationx-pro');
            $data['plugin_name']      = isset( $saved_data['plugin_name'] ) ? $saved_data['plugin_name'] : __('Anonymous', 'notificationx-pro');
            $data['plugin_review']    = isset( $saved_data['text'] ) ? $saved_data['text'] : __('', 'notificationx-pro');
            $data['plugin_name_text'] = __('try it out', 'notificationx-pro');
            $data['anonymous_title']  = __('Anonymous', 'notificationx-pro');

            return $data;
        }

        if( $settings->display_type == 'conversions' ) { 
            $item_type = $settings->freemius_item_type;
            $item_id = $item_type === 'plugin' ? $settings->freemius_plugins : $settings->freemius_themes;
            $plugin_name = isset( $this->lists[ $item_type . 's' ], $this->lists[ $item_type . 's' ][ $item_id ] ) ? $this->lists[ $item_type . 's' ][ $item_id ]['title'] : '';
            $data['title'] = $plugin_name;

            $data['name'] = isset( $saved_data['name'] ) ? $saved_data['name'] : __( 'Someone', 'notificationx-pro' );
            $data['first_name'] = isset( $saved_data['first_name'] ) ? $saved_data['first_name'] : __( 'Someone', 'notificationx-pro' );
            $data['last_name'] = isset( $saved_data['last_name'] ) ? $saved_data['last_name'] : __( 'Someone', 'notificationx-pro' );
            $data['anonymous_title'] = __( 'Anonymous Product', 'notificationx-pro' );
            $data['sometime'] = __( 'Some time ago', 'notificationx-pro' );

            return $data;
        }

        return [];
    }

    public function freemius_js_text( $data ){
        $data['mc_on_success'] = __('You have successfully connected with Freemius, Your lists has been recorded for future use.', 'notificationx-pro');
        $data['mc_on_error'] = __('Something went wrong. Try again.', 'notificationx-pro');

        return $data;
    }

    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'notification_image' ), 10, 3 );
    }

    public function notification_image( $image_data, $data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) != 'freemius' ) { 
            return $image_data;
        }
        $avatar = '';
        $alt_title = isset( $data['plugin_name'] ) ? $data['plugin_name'] : '';
        $alt_title = empty( $alt_title ) && isset( $data['name'] ) ? $data['name'] : $alt_title;

        $item_type = $settings->freemius_item_type;
        $item_id = $item_type === 'plugin' ? $settings->freemius_plugins : $settings->freemius_themes;

        if( $settings->display_type === 'download_stats' ) {
            if( isset( $this->lists[ $item_type . 's' ], $this->lists[ $item_type . 's' ][ $item_id ] ) ) {
                $avatar = $this->lists[ $item_type . 's' ][ $item_id ]['icon'];
            }
        }

        if( $settings->display_type === 'conversions' ) {
            if( $settings->show_notification_image === 'product_image' ) {
                if( isset( $this->lists[ $item_type . 's' ], $this->lists[ $item_type . 's' ][ $item_id ] ) ) {
                    $avatar = $this->lists[ $item_type . 's' ][ $item_id ]['icon'];
                }
            }
            if( $settings->show_notification_image === 'gravatar' ) {
                $avatar = $data['picture'];
            }
        }

        if( $settings->display_type === 'reviews' ) {
            if( $settings->show_notification_image === 'gravatar' ) {
                $avatar = $data['picture'];
            }
            if( $settings->show_notification_image === 'product_image' ) {
                if( isset( $this->lists[ $item_type . 's' ], $this->lists[ $item_type . 's' ][ $item_id ] ) ) {
                    $avatar = $this->lists[ $item_type . 's' ][ $item_id ]['icon'];
                }
            }
        }
        
        if( empty( $avatar ) ) {
            if( $settings->show_default_image ) {
                $avatar = $settings->image_url['url'];
            }

            if( $settings->show_notification_image === 'gravatar' ) {
                if( isset( $data['email'] ) ) {
                    $avatar = get_avatar_url( $data['email'], array(
                        'size' => '100',
                    ));
                }
            }
        }
    
        $image_data['url'] = $avatar;
        $image_data['alt'] = $alt_title;

        return $image_data;
    }

    private function load_dependencies(){
        require_once NOTIFICATIONX_PRO_FREEMIUS_DIR_URI . '/inc/freemius/FreemiusBase.php';
        require_once NOTIFICATIONX_PRO_FREEMIUS_DIR_URI . '/inc/freemius/FreemiusWordPress.php';
        if( ! class_exists( 'NotificationXPro_Freemius_Helper' ) ) {
            require NOTIFICATIONX_PRO_FREEMIUS_DIR_URI . '/inc/class-freemius-helper.php';
        }
    }

    private function get_lists( $type = '' ){
        $options = [ '' => 'Select One' ];
        if( $type == '' ) {
            return $options;
        }
        if( ! empty( $this->lists[ $type ] ) ) {
            foreach($this->lists[ $type ] as $list) {
                $options[ $list['id'] ] = $list['title'];
            }
        }
        return $options;
    }

    private function init_fields(){
        $fields = [];

        if( ! $this->dev_id ) {
            $fields['has_no_freemius_settings'] = array(
                'type'     => 'message',
                'message'    => __('You have to setup your Dev ID, Public Key, Secret Key from <a href="'. admin_url('admin.php?page=nx-settings#api_integrations_tab') .'">settings</a>.' , 'notificationx-pro'),
                'priority' => 0,
            );
        }

        $fields['freemius_item_type'] = array(
            'type'     => 'select',
            'label'    => __('Item Type' , 'notificationx-pro'),
            'priority' => 76,
            'options'  => array(
                'plugin' => __('Plugin' , 'notificationx-pro'),
                'theme' => __('Theme' , 'notificationx-pro'),
            ),
            'default' => 'plugin',
            'dependency' => [
                'plugin' => [
                    'fields' => ['freemius_plugins']
                ],
                'theme' => [
                    'fields' => ['freemius_themes']
                ]
            ],
            'hide' => [
                'plugin' => [
                    'fields' => ['freemius_themes']
                ],
                'theme' => [
                    'fields' => ['freemius_plugins']
                ]
            ]
        );

        $fields['freemius_themes'] = array(
            'type'     => 'select',
            'label'    => __('Select a Theme' , 'notificationx-pro'),
            'priority' => 77,
            'options'  => $this->get_lists('themes'),
        );

        $fields['freemius_plugins'] = array(
            'type'     => 'select',
            'label'    => __('Select a Plugin' , 'notificationx-pro'),
            'priority' => 78,
            'options'  => $this->get_lists('plugins'),
        );

        return $fields;
    }

    private function get_fields(){
        return $this->init_fields();
    }

    public function init_hooks(){
        add_filter( 'nx_metabox_tabs', array( $this, 'add_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_reviews_source', array( $this, 'toggle_fields' ) );
        add_filter( 'nx_stats_source', array( $this, 'stats_toggle_fields' ) );
        add_filter( 'nx_conversion_from', array( $this, 'conversion_toggle_fields' ) );
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
            if( $name == 'has_no_freemius_settings' ) {
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
                $options[ $opt_key ][ 'fields' ][] = $name;
            }
        }
        return $options;
    }

    public function hide_builder_fields( $options ) {
        $fields = array_merge( $this->get_fields(), ['edd_template', 'woo_template'] );
        // Hide fields from other field types.
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
        $fields = $this->get_fields();
        $fields = array_keys( $fields );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        $options['dependency'][ $this->type ]['fields'] = array_merge( $fields, [ 'wp_reviews_template_adv', 'show_notification_image' ] );
        $options['dependency'][ $this->type ]['sections'] = ['wporg_themes'];

        return $options;
    }
    public function stats_toggle_fields( $options ) {
        $fields = $this->get_fields();
        $fields = array_keys( $fields );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        $options['dependency'][ $this->type ]['fields'] = array_merge( $fields, [ 'wp_stats_template_adv' ] );
        $options['dependency'][ $this->type ]['sections'] = ['wpstats_themes', 'image'];

        return $options;
    }
    public function conversion_toggle_fields( $options ) {
        $fields = $this->get_fields();
        $fields = array_keys( $fields );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        $options['dependency'][ $this->type ]['fields'] = array_merge( $fields, NotificationX_ToggleFields::common_fields(), [ 'conversion_from', 'show_notification_image', 'woo_template_new', 'woo_template_adv' ] );
        $options['dependency'][ $this->type ]['sections'] = ['themes', 'image'];     
        $options['hide'][ $this->type ][ 'fields' ] = [ 'woo_template', 'has_no_edd', 'has_no_woo', 'product_control', 'product_exclude_by', 'product_list', 'category_list', 'exclude_categories', 'exclude_products', 'edd_product_control', 'edd_product_exclude_by', 'edd_product_list', 'edd_category_list', 'edd_exclude_categories', 'edd_exclude_products', 'custom_contents', 'show_custom_image' ];
        return $options;
    }
    public function builder_toggle_fields( $options ) {
        $fields = $this->get_fields();
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

    public function get_data( $post_id, $type, $item_slug ){
        if( empty( $post_id ) || empty( $type ) ) {
            return;
        }

        $dev_id         = NotificationX_DB::get_settings('freemius_dev_id');
        $dev_public_key = trim( NotificationX_DB::get_settings('freemius_dev_pk') );
        $dev_secret_key = trim( NotificationX_DB::get_settings('freemius_dev_sk') );
        
        $dev_secret_key = htmlspecialchars_decode( $dev_secret_key );

        $connection = NotificationXPro_Freemius_Helper::freemius( 'developer', intval( $dev_id ), $dev_public_key, $dev_secret_key );
        $api_data = $connection->Api( '/plugins.json' );

        $results = NotificationXPro_Freemius_Helper::get_theme_or_plugin_list( $api_data );

        return isset( $results[ $type . 's' ], $results[ $type . 's' ][ $item_slug ] ) ? $results[ $type . 's' ][ $item_slug ] : [];
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
		NotificationX_Cron::set_cron( $post_id, 'nx_freemius_interval' );
    }

    public function update_data( $post_id ){
        if ( empty( $post_id ) ) {
            return;
        }
        if( ! $this->check_type( $post_id ) ) {
            return;
        }

        $settings = NotificationX_MetaBox::get_metabox_settings( $post_id );
        $type = NotificationX_Helper::get_type( $settings );
        $item_type = $settings->freemius_item_type;
        $item_id = $item_type === 'plugin' ? $settings->freemius_plugins : $settings->freemius_themes;
        $results = [];

        if( $settings->display_type === 'reviews' ) {
            $plugin_name = isset( $this->lists[ $item_type . 's' ], $this->lists[ $item_type . 's' ][ $item_id ] ) ? $this->lists[ $item_type . 's' ][ $item_id ]['title'] : '';
            $results = $this->get_reviews( $item_id, $plugin_name );
            NotificationX_Admin::update_post_meta( $post_id, $this->meta_key, $results );
        }

        if( $settings->display_type === 'download_stats' ) {
            $results = $this->get_stats( $item_id, $item_type, $item_id );
            NotificationX_Admin::update_post_meta( $post_id, $this->meta_key, array( $results ) );
        }

        if( $settings->display_type === 'conversions' ) {
            $results = $this->get_conversions( $item_id, $item_type );
            NotificationX_Admin::update_post_meta( $post_id, $this->meta_key, $results );
        }
    }

    private function freemius(){
        $connection = NotificationXPro_Freemius_Helper::freemius( 'developer', intval( $this->dev_id ), $this->dev_public_key, $this->dev_secret_key );
        if( ! is_wp_error( $connection ) ) {
            return $connection;
        } 
        return false;
    }

    public function conversion_data( $data, $id ){
        if( ! $id ) {
            return $data;
        }

        $data[ $this->type ] = NotificationX_Admin::get_post_meta( intval( $id ), $this->meta_key, true );
        return $data;
    }

    public function get_reviews( $item_id, $plugin_name ){
        if( ! $item_id ) {
            return [];
        }
        $reviews = $this->freemius()->Api("/plugins/$item_id/reviews.json");
        return NotificationXPro_Freemius_Helper::get_reviews_ready( $reviews, $plugin_name );
    }

    public function get_stats( $item_id, $type = '' ){
        if( ! $item_id ) {
            return [];
        }
        $item_stats = $this->freemius()->Api("/plugins/$item_id/installs.json");
        $total_stats = $this->freemius()->Api("/plugins.json");

        return NotificationXPro_Freemius_Helper::get_stats_ready( $total_stats, $item_stats, $type, $item_id );
    }

    public function get_conversions( $item_id, $type = '' ){
        if( ! $item_id ) {
            return [];
        }
        $subscriptions = $this->freemius()->Api("/plugins/$item_id/subscriptions.json");
        $users         = $this->freemius()->Api("/plugins/$item_id/users.json");

        return NotificationXPro_Freemius_Helper::get_sales_data( $subscriptions, $users );
    }

    public function frontend_html( $data = [], $settings = false, $args = [] ){
        if( $settings->display_type === 'reviews' ) {
            $args['template'] = 'wp_reviews_template';
            $args['themeName'] = 'wporg_theme';

            $star = '';
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
        if( $settings->display_type === 'download_stats' ) {
            $args['template'] = 'wp_stats_template';
            $args['themeName'] = 'wpstats_theme';
        }

        if( $settings->display_type === 'conversions' ) {
            $args['template'] = 'woo_template';
            $args['themeName'] = 'theme';
        }

        return parent::frontend_html( $data, $settings, $args );
    }
}