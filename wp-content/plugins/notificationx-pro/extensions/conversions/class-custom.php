<?php
/**
 * This Class is responsible for making custom
 * notifications.
 */
class NotificationXPro_Custom_Extension extends NotificationX_Extension {
    /**
     *  Type of notification.
     *
     * @var string
     */
    public $type = 'custom_notification';
    public $template = 'woo_template';
    public $themeName = 'theme';
    /**
     * An array of all notifications
     *
     * @var [type]
     */
    protected $notifications = [];

    public function __construct() {
        parent::__construct();        
        $this->notifications = $this->get_notifications( $this->type );

        add_action( 'nx_notification_image_action', array( $this, 'image_action' ) ); // Image Action for gravatar
    }

    /**
     * Image Action
     */
    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'notification_image' ), 10, 3 );
    }

    public function notification_image( $image_data, $data, $settings ){
        if( $settings->display_type != 'conversions' || $settings->conversion_from != $this->type ) { 
            return $image_data;
        }
        $avatar = $image_url = $alt_title =  '';
        
        $show_default_image = intval( $settings->show_default_image );
        $show_image = $settings->show_notification_image;

        if( $show_default_image && $show_image === 'none' ) {
            $data['image']['url'] = $settings->image_url['url'];
            $data['image']['id'] = $settings->image_url['id'];
        }
        if( isset( $data['image'], $data['image']['id'] ) && $show_image === 'product_image' ) {
            $image = wp_get_attachment_image_src( $data['image']['id'], 'medium', false );
            $image_data['url'] = $image[0];
        }
        if( isset( $data['email'] ) && $show_image === 'gravatar' ) {
            if( isset( $data['email'] ) ) {
                $avatar = get_avatar_url( $data['email'], array(
                    'size' => '100',
                ));
            }
            $image_data['url'] = $avatar;
        }
        return $image_data;
    }

    public function fallback_data( $data, $saved_data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) !== $this->type ) {
            return $data;
        }
        $data['time'] = __( 'Some time ago', 'notificationx-pro' );
        $data['sometime'] = __( 'Some time ago', 'notificationx-pro' );
        return $data;
    }

    public function init_hooks(){
        add_filter( 'nx_metabox_tabs', array( $this, 'add_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_conversion_from', array( $this, 'toggle_fields' ) );
    }

    public function init_builder_hooks(){
        add_filter( 'nx_builder_tabs', array( $this, 'add_builder_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_builder_fields' ) );
        add_filter( 'nx_builder_tabs', array( $this, 'builder_toggle_fields' ) );
    }

    public function get_fields(){
        $fields = [];

        $fields['custom_contents']  = array(
            'type'     => 'group',
            'priority' => 150,
            'title'    => __('Conversion', 'notificationx-pro'),
            'fields'   => [
                'title' => array(
                    'type'     => 'text',
                    'label'    => __('Title' , 'notificationx-pro'),
                    'priority' => 5,
                ),
                'name' => array(
                    'type'     => 'text',
                    'label'    => __('Name' , 'notificationx-pro'),
                    'priority' => 10,
                ),
                'email' => array(
                    'type'     => 'text',
                    'label'    => __('Email Address' , 'notificationx-pro'),
                    'priority' => 15,
                ),
                'city' => array(
                    'type'     => 'text',
                    'label'    => __('City' , 'notificationx-pro'),
                    'priority' => 20,
                ),
                'country' => array(
                    'type'     => 'text',
                    'label'    => __('Country' , 'notificationx-pro'),
                    'priority' => 25,
                ),
                'image' => array(
                    'type'     => 'media',
                    'label'    => __('Image' , 'notificationx-pro'),
                    'priority' => 30,
                ),
                'link' => array(
                    'type'     => 'text',
                    'label'    => __('URL' , 'notificationx-pro'),
                    'priority' => 35,
                ),
                // 'time' => array(
                //     'type'     => 'time',
                //     'label'    => __('Time' , 'notificationx-pro'),
                //     'priority' => 35,
                // ),
            ],
        );

        return $fields;
    }

    public function add_fields( $options ){
        $fields = $this->get_fields();
        foreach ( $fields as $key => $field ) {
            $options['content_tab']['sections']['content_config']['fields'][ $key ] = $field;
        }

        return $options;
    }

    public function add_builder_fields( $options ){
        $fields = $this->get_fields();

        foreach ( $fields as $key => $field ) {
            $options['source_tab']['sections']['config']['fields'][ $key ] = $field;
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
        $fields = $this->get_fields();
        // Hide fields from other field types.
        foreach ( $fields as $name => $field ) {
            foreach( $options as $opt_key => $opt_value ) {
                $options[ $opt_key ][ 'fields' ][] = $name;
            }
        }
        // foreach ( $fields as $field_key => $field_value ) {
        //     $options[ 'conversions' ]['fields'][] = $field_key;
        //     foreach( $options as $opt_key => $opt_value ) {
        //         $options[ $opt_key ]['fields'][] = $field_key;
        //     }
        // }
        return $options;
    }

    public function hide_builder_fields( $options ) {
        $fields = $this->get_fields();
        unset( $fields[ $this->template ] );
        // Hide fields from other field types.
        foreach( $options as $opt_key => $opt_value ) {
            foreach( $fields as $field_key => $field_value ) {
                $options[ $opt_key ]['fields'][] = $field_key;
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
        $default = NotificationX_ToggleFields::conversions();
        $fields = array_keys( $this->get_fields() );

        $fields = array_merge( $default['fields'], $fields, array( 'show_notification_image', 'woo_template_new', 'woo_template_adv') );
        
        $options['dependency'][ $this->type ]['fields'] = $fields;
        $options['dependency'][ $this->type ]['sections'] = $default['sections'];
        $options['hide'][ $this->type ][ 'fields' ] = [ 'woo_template', 'has_no_edd', 'has_no_woo', 'product_control', 'product_exclude_by', 'product_list', 'category_list', 'exclude_categories', 'exclude_products', 'edd_product_control', 'edd_product_exclude_by', 'edd_product_list', 'edd_category_list', 'edd_exclude_categories', 'edd_exclude_products' ];

        return $options;
    }
    public function builder_toggle_fields( $options ) {
        $fields = $this->get_fields();
        unset( $fields[ $this->template ] );
        $default = NotificationX_ToggleFields::conversions();
        $options['source_tab']['sections']['config']['fields']['display_type']['dependency'][ $this->type ]['fields'] = array_merge( $default['fields'], array_keys( $fields ));
        return $options;
    }
}