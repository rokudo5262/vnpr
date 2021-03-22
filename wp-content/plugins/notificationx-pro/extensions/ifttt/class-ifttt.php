<?php
/**
 * This Class is responsible for making mailchimp activity
 * notifications.
 */

class NotificationXPro_IFTTT_Extension extends NotificationX_Extension {
    /**
     *  Type of notification.
     * @var string
     */
    public  $type     = 'ifttt';
    public  $template = 'ifttt_template';
    public  $themeName = 'ifttt_theme';
    public  $meta_key = 'ifttt_content';
    public  $api_key = '';
    public $notifications = array();

    public function __construct() {
        parent::__construct();

        add_filter( 'nx_notification_types', array( $this, 'notification_types' ) );
        add_action( 'nx_before_settings_load', array( $this, 'add_settings' ) );
        add_action( 'nx_api_response_success', array( $this, 'get_response' ) );
        add_action( 'nx_notification_image_action', array( $this, 'image_action' ) );
        add_filter( 'nx_data_key', array( $this, 'key' ), 10, 2 );
    }

    public function key( $key, $settings ){
        if( $settings->display_type === 'ifttt' ) {
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


            $key = $this->type . '_' . $response['id'];
            $this->save( $key, $response, $response['timestamp'] );
        }
    }

    public static function get_notification_ready( $type, $data = [] ) {
        return;
    }

    public function add_settings(){
        add_filter( 'notificationx_settings_tab', array( $this, 'add_settings_tab' ) );
    }

    public function add_settings_tab( $options ){
        $options[ 'ifttt_tab' ] = array(
            'title' => __( 'IFTTT', 'notificationx-pro' ),
            'priority' => 5,
            'sections' => array(
                'ifttt_settings' => array(
                    'title' => __( 'IFTTT Settings', 'notificationx-pro' ),
                    'priority' => 5,
                    'fields' => array(
                        'ifttt_api_key' => array(
                            'type'      => 'text',
                            'label'     => __('API Key' , 'notificationx-pro'),
                            'default'	=> md5( home_url() ),
                            'priority'	=> 5,
                            'readonly' => true
                        )
                    ),
                ),
            )
        );

        return $options;
    }

    public function notification_types( $options ){
        $options['ifttt'] = __('IFTTT' , 'notificationx-pro');
        return $options;
    }

    public function themes(){
        return apply_filters('nxpro_ifttt_themes', array(
            'theme-one'   => NOTIFICATIONX_PRO_URL . 'assets/images/themes/mailchimp-theme-one.png',
            'theme-two'   => NOTIFICATIONX_PRO_URL . 'assets/images/themes/mailchimp-theme-two.jpg',
            'theme-three' => NOTIFICATIONX_PRO_URL . 'assets/images/themes/mailchimp-theme-three.jpg',
        ));
    }

    private function init_fields(){
        $fields = [];

        $fields['ifttt_template'] = array(
            'type'     => 'template',
            'label'    => __('Notification Template' , 'notificationx-pro'),
            'priority' => 85,
            'defaults' => [
                __('{{name}} recently subscribed to', 'notificationx-pro'), '{{title}}', '{{time}}'
            ],
            'variables' => [
                '{{name}}', '{{title}}', '{{time}}', '{{city}}', '{{state}}', '{{country}}'
            ],
        );
        
        return $fields;
    }
    private function init_sections(){
        $sections = [];

        $sections['ifttt_themes'] = array(
            'title'      => __('Themes', 'notificationx-pro'),
            'priority' => 14,
            'fields'   => array(
                'ifttt_theme' => array(
                    'type'      => 'theme',
                    'priority'	=> 3,
                    'default'	=> 'theme-one',
                    'options'   => $this->themes(),
                ),
                'ifttt_advance_edit' => array(
                    'type'      => 'adv_checkbox',
                    'priority'	=> 10,
                    'default'	=> 0,
                    'dependency' => [
                        1 => [
                            'sections' => ['ifttt_design', 'ifttt_typography']
                        ]
                    ]
                ),
            )
        );

        $sections['ifttt_design'] = array(
            'title'    => __('Design', 'notificationx-pro'),
            'priority' => 15,
            'reset'    => true,
            'fields'   => array(
                'ifttt_bg_color' => array(
                    'type'      => 'colorpicker',
                    'label'     => __('Background Color' , 'notificationx-pro'),
                    'priority'	=> 5,
                    'default'	=> ''
                ),
                'ifttt_text_color' => array(
                    'type'      => 'colorpicker',
                    'label'     => __('Text Color' , 'notificationx-pro'),
                    'priority'	=> 10,
                    'default'	=> ''
                ),
                'ifttt_border' => array(
                    'type'      => 'checkbox',
                    'label'     => __('Want Border?' , 'notificationx-pro'),
                    'priority'	=> 15,
                    'default'	=> 0,
                    'dependency'	=> [
                        1 => [
                            'fields' => [ 'ifttt_border_size', 'ifttt_border_style', 'ifttt_border_color' ]
                        ]
                    ],
                ),
                'ifttt_border_size' => array(
                    'type'      => 'number',
                    'label'     => __('Border Size' , 'notificationx-pro'),
                    'priority'	=> 20,
                    'default'	=> '1',
                    'description'	=> 'px',
                ),
                'ifttt_border_style' => array(
                    'type'      => 'select',
                    'label'     => __('Border Style' , 'notificationx-pro'),
                    'priority'	=> 25,
                    'default'	=> 'solid',
                    'options'	=> [
                        'solid' => __('Solid', 'notificationx-pro'),
                        'dashed' => __('Dashed', 'notificationx-pro'),
                        'dotted' => __('Dotted', 'notificationx-pro'),
                    ],
                ),
                'ifttt_border_color' => array(
                    'type'      => 'colorpicker',
                    'label'     => __('Border Color' , 'notificationx-pro'),
                    'priority'	=> 30,
                    'default'	=> ''
                ),
            )
        );

        $sections['ifttt_typography'] = array(
            'title'      => __('Typography', 'notificationx-pro'),
            'priority' => 16,
            'reset'    => true,
            'fields'   => array(
                'ifttt_first_font_size' => array(
                    'type'      => 'number',
                    'label'     => __('Font Size' , 'notificationx-pro'),
                    'priority'	=> 5,
                    'default'	=> '13',
                    'description'	=> 'px',
                    'help'	=> __( 'This font size will be applied for <mark>first</mark> row', 'notificationx-pro' ),
                ),
                'ifttt_second_font_size' => array(
                    'type'      => 'number',
                    'label'     => __('Font Size' , 'notificationx-pro'),
                    'priority'	=> 10,
                    'default'	=> '14',
                    'description'	=> 'px',
                    'help'	=> __( 'This font size will be applied for <mark>second</mark> row', 'notificationx-pro' ),
                ),
                'ifttt_third_font_size' => array(
                    'type'      => 'number',
                    'label'     => __('Font Size' , 'notificationx-pro'),
                    'priority'	=> 15,
                    'default'	=> '11',
                    'description'	=> 'px',
                    'help'	=> __( 'This font size will be applied for <mark>third</mark> row', 'notificationx-pro' ),
                ),
            )
        );
        
        return $sections;
    }

    private function get_fields(){
        return $this->init_fields();
    }

    private function get_sections(){
        return $this->init_sections();
    }

    public function init_hooks(){
        add_filter( 'nx_metabox_tabs', array( $this, 'add_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_display_type', array( $this, 'toggle_fields' ) );
        add_filter( 'nx_conversion_from', array( $this, 'toggle_fields' ) );
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

            if( $name == 'has_no_ifttt_key' ) {
                $options[ 'source_tab' ]['sections']['config']['fields'][ $name ] = $field;
                continue;    
            }

            $options[ 'content_tab' ]['sections']['content_config']['fields'][ $name ] = $field;
        }

        $sections = $this->get_sections();
        foreach ( $sections as $parent_key => $section ) {
            $options[ 'design_tab' ]['sections'][ $parent_key ] = $section;
        }

        return $options;
    }

    public function add_builder_fields( $options ){
        $fields = $this->get_fields();
        $sections = $this->get_sections();
        unset( $sections['ifttt_themes']['fields']['ifttt_advance_edit'] );
        unset( $fields[ $this->template ] );
        unset( $sections['ifttt_design'] );
        unset( $sections['ifttt_typography'] );

        foreach ( $fields as $name => $field ) {
            $options['source_tab']['sections']['config']['fields'][ $name ] = $field;
        }
        foreach ( $sections as $sec_name => $section ) {
            $options['design_tab']['sections'][ $sec_name ] = $section;
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
        $sections = $this->get_sections();

        foreach ( $fields as $name => $field ) {
            foreach( $options as $opt_key => $opt_value ) {
                if( $opt_key != $this->type ) {
                    $options[ $opt_key ][ 'fields' ][] = $name;
                }
            }
        }

        foreach ( $sections as $section_name => $section ) {
            foreach( $options as $opt_key => $opt_value ) {
                if( $opt_key != $this->type ) { 
                    $options[ $opt_key ][ 'sections' ][] = $section_name;
                }
            }
        }

        return $options;
    }

    public function hide_builder_fields( $options ) {
        $fields = array_merge( $this->get_fields(), ['edd_template', 'woo_template'] );
        $sections = $this->get_sections();
        // Hide fields from other field types.
        foreach( $fields as $field_key => $field_value ) {
            foreach( $options as $opt_key => $opt_value ) {
                $options[ $opt_key ][ 'fields' ][] = $field_key;
            }
        }

        foreach( $sections as $sec_key => $sec_value ) {
            foreach( $options as $opt_key => $opt_value ) {
                $options[ $opt_key ][ 'sections' ][] = $sec_key;
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
        $fields = array_merge( 
            ['display_last', 'conversion_position', 'display_from', 'delay_before', 'display_for', 'delay_between', 'loop', 'notification_preview'], 
            $fields
        );

        $options['dependency'][ $this->type ]['fields'] = $fields;
        $options['dependency'][ $this->type ]['sections'] = ['image', 'ifttt_themes'];
        $options['hide'][ $this->type ][ 'fields' ] = [ 'woo_template', 'has_no_edd', 'has_no_woo', 'product_control', 'product_exclude_by', 'product_list', 'category_list', 'exclude_categories', 'exclude_products', 'edd_product_control', 'edd_product_exclude_by', 'edd_product_list', 'edd_category_list', 'edd_exclude_categories', 'edd_exclude_products', 'custom_contents', 'show_custom_image' ];

        return $options;
    }
    public function builder_toggle_fields( $options ) {
        $fields = $this->get_fields();
        $sections = $this->get_sections();
        unset( $fields[ $this->template ] );
        $options['source_tab']['sections']['config']['fields']['display_type']['dependency'][ $this->type ]['fields'] = array_keys( $fields );
        $options['source_tab']['sections']['config']['fields']['display_type']['dependency'][ $this->type ]['sections'] = array_keys( $sections );
        return $options;
    }

    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'notification_image' ), 10, 3 );
    }

    public function notification_image( $image_data, $data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) != 'ifttt' ) { 
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
        return parent::frontend_html( $data, $settings, $args );
    }
}