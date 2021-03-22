<?php
/**
 * This Class is responsible for making mailchimp activity
 * notifications.
 */
define( 'NOTIFICATIONX_PRO_MAILCHIMP_DIR_URI', dirname( __FILE__ ) );

class NotificationXPro_MailChimp_Extension extends NotificationX_Extension {
    /**
     *  Type of notification.
     * @var string
     */
    public $type      = 'mailchimp';
    public $template  = 'mailchimp_template';
    public $themeName = 'mailchimp_theme';
    public $meta_key  = 'mailchimp_content';
    public $api_key   = '';

    public function __construct() {
        parent::__construct();
        $this->api_key = NotificationX_DB::get_settings('mailchimp_api_key');
        
        $this->load_dependencies();
        
        add_action( 'nx_notification_image_action', array( $this, 'image_action' ) );
        add_action( 'wp_ajax_nx_mailchimp_connect', 'NotificationXPro_MailChimpHelper::mailchimp_tab_settings' );
        add_action( 'nx_cron_update_data', array( $this, 'update_data' ), 10, 1 );
        add_filter( 'nxpro_js_scripts', array( $this, 'mailchimp_js_text' ), 10, 1 );
    }

    public function template_string_by_theme( $template, $old_template, $posts_data ){
        if( NotificationX_Helper::get_type( $posts_data ) === $this->type ) {
            $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'third_param', 'fourth_param' ] ) );
            return $template;
        }
        return $template;
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

    public function mailchimp_js_text( $data ){
        $data['mc_on_success'] = __('You have successfully connected with MailChimp, Your lists has been recorded for future use.', 'notificationx-pro');
        $data['mc_on_error']   = __('Something went wrong. Try again.', 'notificationx-pro');

        return $data;
    }

    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'notification_image' ), 10, 3 );
    }

    public function notification_image( $image_data, $data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) != 'mailchimp' ) { 
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

    private function load_dependencies(){
        require_once NOTIFICATIONX_PRO_MAILCHIMP_DIR_URI . '/inc/class-mailchimp-api.php';
        if( ! class_exists( 'NotificationXPro_MailChimpHelper' ) ) {
            require NOTIFICATIONX_PRO_MAILCHIMP_DIR_URI . '/inc/class-mailchimp-helper.php';
        }
    }

    private function get_lists(){
        $options = [ '' => 'Select One' ];

        $results = get_option( 'nxpro_mailchimp_lists' );
        
        if( ! empty( $results ) ) {
            foreach($results as $key => $list) {
                $options[ $key ] = $list;
            }
        }

        return $options;
    }

    private function init_fields(){
        $fields = [];
        if( empty( $this->api_key ) ) {
            $fields['has_no_mailchimp_key'] = array(
                'type'     => 'message',
                'message'  => __('You have to setup your API Key for <a href="'. admin_url('admin.php?page=nx-settings#api_integrations_tab') .'">MailChimp</a>.' , 'notificationx-pro'),
                'priority' => 0,
            );
        }

        $fields['mailchimp_list'] = array(
            'type'     => 'select',
            'label'    => __('MailChimp List' , 'notificationx-pro'),
            'priority' => 80,
            'options'  => $this->get_lists(),
        );

        $fields['mailchimp_template_new'] = array(
            'type'   => 'template',
            'builder_hidden' => true,
            'fields' => array(
                'first_param' => array(
                    'type'     => 'select',
                    'label'    => __('Notification Template' , 'notificationx-pro'),
                    'priority' => 1,
                    'options'  => array(
                        'tag_name'       => __('Full Name' , 'notificationx-pro'),
                        'tag_first_name' => __('First Name' , 'notificationx-pro'),
                        'tag_last_name'  => __('Last Name' , 'notificationx-pro'),
                        'tag_custom'     => __('Custom' , 'notificationx-pro'),
                    ),
                    'dependency' => array(
                        'tag_custom' => array(
                            'fields' => [ 'custom_first_param' ]
                        )
                    ),
                    'hide' => array(
                        'tag_name' => array(
                            'fields' => [ 'custom_first_param' ]
                        ),
                        'tag_first_name' => array(
                            'fields' => [ 'custom_first_param' ]
                        ),
                        'tag_last_name' => array(
                            'fields' => [ 'custom_first_param' ]
                        ),
                    ),
                    'default' => 'tag_first_name'
                ),
                'custom_first_param' => array(
                    'type'     => 'text',
                    'priority' => 2,
                    'default'  => __('Someone' , 'notificationx-pro')
                ),
                'second_param' => array(
                    'type'     => 'text',
                    'priority' => 3,
                    'default'  => __('just subscribed to' , 'notificationx-pro')
                ),
                'third_param' => array(
                    'type'     => 'select',
                    'priority' => 4,
                    'options'  => array(
                        'tag_title'           => __('List Title' , 'notificationx-pro'),
                        'tag_anonymous_title' => __('Anonymous Title' , 'notificationx-pro'),
                    ),
                    'default' => 'tag_title'
                ),
                'fourth_param' => array(
                    'type'     => 'select',
                    'priority' => 5,
                    'options'  => array(
                        'tag_time' => __('Definite Time' , 'notificationx-pro'),
                        'tag_sometime' => __('Some time ago' , 'notificationx-pro'),
                    ),
                    'default' => 'tag_time',
                    'dependency' => array(
                        'tag_sometime' => array(
                            'fields' => [ 'custom_fourth_param' ]
                        )
                    ),
                    'hide' => array(
                        'tag_time' => array(
                            'fields' => [ 'custom_fourth_param' ]
                        ),
                    ),
                ),
                'custom_fourth_param' => array(
                    'type'     => 'text',
                    'priority' => 6,
                    'default' => __( 'Some time ago', 'notificationx' )
                ),
            ),
            'label'    => __('Notification Template' , 'notificationx-pro'),
            'priority' => 81,
        );

        $fields['mailchimp_template_adv'] = array(
            'type'        => 'adv_checkbox',
            'builder_hidden' => true,
            'priority'    => 82,
            'button_text' => __('Advanced Template' , 'notificationx-pro'),
            'side'        => 'right',
            'dependency'  => array(
                1 => array(
                    'fields' => array( 'mailchimp_template' )
                )
            ),
        );

        $fields['mailchimp_template'] = array(
            'type'     => 'template',
            'priority' => 85,
            'defaults' => [
                __('{{name}} recently subscribed to', 'notificationx-pro'), '{{title}}', '{{time}}'
            ],
            'variables' => [
                '{{name}}', '{{title}}', '{{time}}'
            ],
        );
        
        return $fields;
    }
    private function init_sections(){
        $sections = [];

        $sections['mailchimp_themes'] = array(
            'title'    => __('Themes', 'notificationx-pro'),
            'priority' => 14,
            'fields'   => array(
                'mailchimp_theme' => array(
                    'type'       => 'theme',
                    'priority'   => 3,
                    'default'    => 'theme-one',
                    'options'    => NotificationXPro_Helper::designs_for_subscription(),
                    'dependency' => [
                        'maps_theme' => [
                            'fields' => ['maps_theme_template_new', 'maps_theme_template_adv']
                        ],
                        'theme-one' => [
                            'fields' => ['mailchimp_template_new', 'mailchimp_template_adv']
                        ],
                        'theme-two' => [
                            'fields' => ['mailchimp_template_new', 'mailchimp_template_adv']
                        ],
                        'theme-three' => [
                            'fields' => ['mailchimp_template_new', 'mailchimp_template_adv']
                        ],
                    ],
                    'hide' => [
                        'maps_theme' => [
                            'fields' => ['mailchimp_template_new']
                        ],
                        'theme-one' => [
                            'fields' => ['maps_theme_template_new', 'maps_theme_template']
                        ],
                        'theme-two' => [
                            'fields' => ['maps_theme_template_new', 'maps_theme_template']
                        ],
                        'theme-three' => [
                            'fields' => ['maps_theme_template_new', 'maps_theme_template']
                        ],
                    ]
                ),
                'mailchimp_advance_edit' => array(
                    'type'       => 'adv_checkbox',
                    'priority'   => 10,
                    'default'    => 0,
                    'dependency' => [
                        1 => [
                            'sections' => ['mailchimp_design', 'mailchimp_typography']
                        ]
                    ]
                ),
            )
        );

        $sections['mailchimp_design'] = array(
            'title'    => __('Design', 'notificationx-pro'),
            'priority' => 15,
            'reset'    => true,
            'fields'   => array(
                'mailchimp_bg_color' => array(
                    'type'     => 'colorpicker',
                    'label'    => __('Background Color' , 'notificationx-pro'),
                    'priority' => 5,
                    'default'  => ''
                ),
                'mailchimp_text_color' => array(
                    'type'     => 'colorpicker',
                    'label'    => __('Text Color' , 'notificationx-pro'),
                    'priority' => 10,
                    'default'  => ''
                ),
                'mailchimp_border' => array(
                    'type'       => 'checkbox',
                    'label'      => __('Want Border?' , 'notificationx-pro'),
                    'priority'   => 15,
                    'default'    => 0,
                    'dependency' => [
                        1 => [
                            'fields' => [ 'mailchimp_border_size', 'mailchimp_border_style', 'mailchimp_border_color' ]
                        ]
                    ],
                ),
                'mailchimp_border_size' => array(
                    'type'        => 'number',
                    'label'       => __('Border Size' , 'notificationx-pro'),
                    'priority'    => 20,
                    'default'     => '1',
                    'description' => 'px',
                ),
                'mailchimp_border_style' => array(
                    'type'     => 'select',
                    'label'    => __('Border Style' , 'notificationx-pro'),
                    'priority' => 25,
                    'default'  => 'solid',
                    'options'  => [
                        'solid'  => __('Solid', 'notificationx-pro'),
                        'dashed' => __('Dashed', 'notificationx-pro'),
                        'dotted' => __('Dotted', 'notificationx-pro'),
                    ],
                ),
                'mailchimp_border_color' => array(
                    'type'     => 'colorpicker',
                    'label'    => __('Border Color' , 'notificationx-pro'),
                    'priority' => 30,
                    'default'  => ''
                ),
            )
        );

        $sections['mailchimp_typography'] = array(
            'title'    => __('Typography', 'notificationx-pro'),
            'priority' => 16,
            'reset'    => true,
            'fields'   => array(
                'mailchimp_first_font_size' => array(
                    'type'        => 'number',
                    'label'       => __('Font Size' , 'notificationx-pro'),
                    'priority'    => 5,
                    'default'     => '13',
                    'description' => 'px',
                    'help'        => __( 'This font size will be applied for <mark>first</mark> row', 'notificationx-pro' ),
                ),
                'mailchimp_second_font_size' => array(
                    'type'        => 'number',
                    'label'       => __('Font Size' , 'notificationx-pro'),
                    'priority'    => 10,
                    'default'     => '14',
                    'description' => 'px',
                    'help'        => __( 'This font size will be applied for <mark>second</mark> row', 'notificationx-pro' ),
                ),
                'mailchimp_third_font_size' => array(
                    'type'        => 'number',
                    'label'       => __('Font Size' , 'notificationx-pro'),
                    'priority'    => 15,
                    'default'     => '11',
                    'description' => 'px',
                    'help'        => __( 'This font size will be applied for <mark>third</mark> row', 'notificationx-pro' ),
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

            if( $name == 'has_no_mailchimp_key' ) {
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
        unset( $sections['mailchimp_themes']['fields']['mailchimp_advance_edit'] );
        unset( $fields[ 'mailchimp_template' ] );
        // unset( $fields[ 'mailchimp_template_new' ] );
        unset( $fields[ 'mailchimp_template_adv' ] );
        unset( $sections['mailchimp_design'] );
        unset( $sections['mailchimp_typography'] );

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
        $fields = array_keys( $this->get_fields() );
        $sections = array_keys( $this->get_sections() );

        unset( NX_CONSTANTS::$COMMENT_FIELDS[1] );
        unset( NX_CONSTANTS::$CONVERSION_FIELDS[1] );

        foreach( $options as $opt_key => $value ) {
            if( $opt_key != 'email_subscription' ) {
                $options[ $opt_key ][ 'fields' ] = array_merge( 
                    isset( $options[ $opt_key ][ 'fields' ] ) ? $options[ $opt_key ][ 'fields' ] : [], 
                    $fields
                );
            } else {
                $options[ $opt_key ][ 'fields' ] = array_merge(
                    isset( $options[ $opt_key ][ 'fields' ] ) ? $options[ $opt_key ][ 'fields' ] : [], 
                    NX_CONSTANTS::$COMMENT_FIELDS,
                    NX_CONSTANTS::$CONVERSION_FIELDS
                );
            }
        }

        foreach( $options as $opt_key => $value ) {
            if( $opt_key != 'email_subscription' ) {
                $options[ $opt_key ][ 'sections' ] = array_merge( 
                    isset( $options[ $opt_key ][ 'sections' ] ) ? $options[ $opt_key ][ 'sections' ] : [], 
                    $sections
                );
            } else {
                $options[ $opt_key ][ 'sections' ] = array_merge( 
                    isset( $options[ $opt_key ][ 'sections' ] ) ? $options[ $opt_key ][ 'sections' ] : [], 
                    NX_CONSTANTS::$COMMENT_SECTIONS,
                    NX_CONSTANTS::$CONVERSION_SECTIONS
                );
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
        $fields = array_merge( NotificationX_ToggleFields::common_fields(), $fields, [ 'show_avatar' ] );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }
        $options['dependency'][ $this->type ]['fields'] = $fields;
        $options['dependency'][ $this->type ]['sections'] = [ 'image', 'mailchimp_themes'];
        $options['hide'][ $this->type ]['fields'] = array( 'show_notification_image' );
        return $options;
    }
    public function builder_toggle_fields( $options ) {
        $fields = $this->get_fields();
        $sections = $this->get_sections();
        unset( $fields[ $this->template ] );

        $fields = array_keys( $fields );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }

        $options['source_tab']['sections']['config']['fields']['display_type']['dependency'][ $this->type ]['fields'] = $fields;
        $options['source_tab']['sections']['config']['fields']['display_type']['dependency'][ $this->type ]['sections'] = array_keys( $sections );
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
		NotificationX_Cron::set_cron( $post_id, 'nx_mailchimp_interval' );
    }

    public function update_data( $post_id ){
        if ( empty( $post_id ) ) {
            return;
        }
        if( ! $this->check_type( $post_id ) ) {
            return;
        }
        
        $members = $this->get_members( $post_id );       
        NotificationX_Admin::update_post_meta( $post_id, $this->meta_key, $members );
    }

    public function conversion_data( $data, $id ){
        if( ! $id ) {
            return $data;
        }
        $data[ $this->type ] = NotificationX_Admin::get_post_meta( intval( $id ), $this->meta_key, true );
        return $data;
    }

    private function member( $data, $title ){
        $firstName = $lastName = $name = '';
        if( ! empty( $data['merge_fields'] ) ) {
            $firstName = isset( $data['merge_fields']['FNAME'] ) ? $data['merge_fields']['FNAME'] : '';
            $lastName = isset( $data['merge_fields']['LNAME'] ) ? $data['merge_fields']['LNAME'] : '';

            if( ! empty( $firstName ) ) {
                $member['first_name'] = $firstName;
            }
            if( ! empty( $lastName ) ) {
                $member['last_name'] = $lastName;
            }

            $name = $firstName . ' ' . $lastName;
            $trimed_val = trim( $name );
            if( ! empty( $trimed_val ) ) {
                $member['name'] = $name;
            }
        }

        if( ! empty( $data['email_address'] ) ) {
            $member['email'] = $data['email_address'];
        }
        if( ! empty( $title ) ) {
            $member['title'] = $title;
        }
        if( ! empty( $data['status'] ) ) {
            $member['status'] = $data['status'];
        }
        if( ! empty( $data['timestamp_opt'] ) ) {
            $member['timestamp'] = strtotime( $data['timestamp_opt'] );
        }
        $member['link'] = '';
        $member['ip'] = $data['ip_opt'];

        if( isset( $data['ip_opt'] ) && ! empty( $data['ip_opt'] ) ) {
            $user_ip_data = self::remote_get('http://ip-api.com/json/' . $data['ip_opt'] );
            if( $user_ip_data && ! is_wp_error( $user_ip_data ) ) {
                $member['country'] = isset( $user_ip_data->country ) ? $user_ip_data->country : '';
                $member['city']    = isset( $user_ip_data->city ) ? $user_ip_data->city : '';
                $member['state']    = isset( $user_ip_data->state ) ? $user_ip_data->state : '';
            }
        }

        return $member;
    }

    public function get_members( $post_id ) {
        $members = [];
        $subscription_source = NotificationX_Admin::get_post_meta( $post_id, 'subscription_source' );

        if ( 'mailchimp' != $subscription_source ) {
            return $post_id;
        }

        $list_id = NotificationX_Admin::get_post_meta( $post_id, 'mailchimp_list' );

        // Return of mailchimp list field is empty.
        if ( ! $list_id || empty( $list_id ) ) {
            return $post_id;
        }

        // Return if api key is empty.
        if ( ! $this->api_key || empty( $this->api_key ) ) {
            return $post_id;
        }
        // Get limit.
        $limit = NotificationX_Admin::get_post_meta( $post_id, 'display_last' );
        // Set limit to 100 if empty.
        if ( empty( $limit ) || ! $limit ) {
            $limit = 20;
        }

        $response = NotificationXPro_MailChimpHelper::get_members( $this->api_key, $list_id, $limit );

		if ( $response['error'] ) {
            $response->errors[] = $response['error'];
            return $post_id;
        } 

        $list_name = get_option( 'nxpro_mailchimp_lists' );

        if( empty( $list_name[ $list_id ] ) ) {
            return $post_id;
        }

        if( is_array( $response['members']['members'] ) ) {
            foreach( $response['members']['members'] as $parent_key => $member ) {
                $members[] = $this->member( $member, $list_name[ $list_id ] );
            }
        }

        return $members;
    }

    public function frontend_html( $data = [], $settings = false, $args = [] ){
        if( ! empty( $this->api_key ) ) {
            return parent::frontend_html( $data, $settings, $args );
        }
    }
}