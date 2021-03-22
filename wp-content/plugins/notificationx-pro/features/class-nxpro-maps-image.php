<?php
/**
 * This class is responsible for making pro feature enabled in 
 * options. e.g: Notification Image Customization, Display Last Conversions Limit, etc.
 */

class NotificationXPro_MapsImages_Features {

    private $_upload_dir;
    private $_map_created = 'nx_pro_map_created_list';
    public  $template = 'maps_theme_template_new';
    private $maps;

    public function __construct(){
        $this->_upload_dir = wp_upload_dir();
        $this->maps = NotificationX_DB::get_settings( $this->_map_created );
        if( ! $this->maps ) {
            $this->maps = array();
        }
        
        add_action( 'nx_before_metabox_load', array( $this, 'init_hooks' ) );
        add_action( 'nx_before_builder_load', array( $this, 'init_builder_hooks' ) );
        add_action( 'nx_notification_image_action', array( $this, 'image_action' ), 13 );
        add_filter( 'nx_show_image_options', array( $this, 'show_image_options' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_template' ) );
        add_filter( 'nx_template_id', array( $this, 'map_template' ), 10, 2 );
        add_filter( 'nx_fallback_data', array( $this, 'fallback_data' ), 12, 3 );
        add_filter( 'nx_template_settings_by_theme', array( $this, 'settings_by_theme' ), 99 );
        add_filter( 'nx_template_string_generate', array( $this, 'template_string_by_theme'), 99, 3 );
    }

    public function show_image_options( $options ){
        unset( $options['none'] );
        $options['maps_image'] = __( 'Map Image', 'notificationx-pro' );
        $options['none'] = __( 'None', 'notificationx-pro' );
        return $options;
    }

    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'map_image' ), 13, 3 );
    }

    public function settings_by_theme( $data ){
        global $post, $pagenow;
        $maps_theme_template_field = get_post_meta( $post->ID, '_nx_meta_maps_theme_template_new', true );

        if( isset( $data['nx_meta_comments_template_new'] ) ) {
            $data['nx_meta_comments_template_new']['maps_theme'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'commented on',
            );
            $data['nx_meta_comments_template_new']['comments-maps_theme'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'commented on',
            );
        }

        if( isset( $data['nx_meta_mailchimp_template_new'] ) ) {
            $data['nx_meta_mailchimp_template_new']['maps_theme'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'subscribed to',
            );
            $data['nx_meta_mailchimp_template_new']['subs-maps_theme'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'subscribed to',
            );
        }

        if( isset( $data['nx_meta_woo_template_new'] ) ) {
            $data['nx_meta_woo_template_new']['maps_theme'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'purchased',
            );
            $data['nx_meta_woo_template_new']['conv-theme-six'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'purchased',
            );
        }

        if( isset( $data['nx_meta_elearning_template_new'] ) ) {
            $data['nx_meta_elearning_template_new']['maps_theme'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'recently enrolled',
            );
            $data['nx_meta_elearning_template_new']['conv-theme-six'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'recently enrolled',
            );
        }

        if( isset( $data['nx_meta_donation_template_new'] ) ) {
            $data['nx_meta_donation_template_new']['maps_theme'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'recently enrolled',
            );
            $data['nx_meta_donation_template_new']['conv-theme-six'] = array(
                'third_param' => isset( $maps_theme_template_field['third_param'] ) ? $maps_theme_template_field['third_param'] : 'recently enrolled',
            );
        }

        return $data;
    }

    public function template_string_by_theme( $template, $old_template, $posts_data ){
        $theme = NotificationX_Helper::get_theme( $posts_data );
        if( $theme === 'maps_theme' ) {
            $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'fourth_param', 'fifth_param' ] ) );
        }
        if( $theme === 'conv-theme-six' ) {
            $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'third_param', 'fifth_param' ] ) );
        }
        return $template;
    }

    public function fallback_data( $data, $saved_data, $settings ){
        $theme = NotificationX_Helper::get_theme( $settings );
        $has_city = NotificationX_Extension::notEmpty('city', $saved_data);
        $has_country = NotificationX_Extension::notEmpty('country', $saved_data);

        if( ! $has_city || ! $has_country ) {
            $has_ip = NotificationX_Extension::notEmpty('ip', $saved_data);
            if( $has_ip ) {
                $user_ip_data = NotificationX_Extension::remote_get('http://ip-api.com/json/' . $has_ip );
                if( $user_ip_data ) {
                    $has_country = $user_ip_data->country;
                    $has_city    = $user_ip_data->city;
                }
            }
        }

        if( $theme === 'maps_theme' || $theme === 'conv-theme-six' ) {
            $data['city'] = $has_city ?  $saved_data['city'] : '<span class="extra">' . __('Somewhere', 'notificationx-pro') . '</span>';
            $data['country'] = $has_country ? $saved_data['country'] : '<span class="extra">' . __('Somewhere', 'notificationx-pro') . '</span>';
            $data['city_country'] = $has_country && $has_city ? $saved_data['city'] . ', ' . $saved_data['country'] : '<span class="extra">' . __('Somewhere', 'notificationx-pro') . '</span>';

            switch ($settings->display_type) {
                case 'comments' :
                    $data['title'] = $saved_data['post_title'];
                    break;
                case 'conversions' || 'elearning' || 'donation':
                    $data['title'] = $saved_data['title'];
                    break;
            }
            if($theme == 'conv-theme-six'){
                $data['title'] = '<span class="product-title">' . $saved_data['title'] . '</span>';
            }
            return $data;
        }
        return $data;
    }

    public function init_hooks(){
        add_filter( 'nx_metabox_tabs', array( $this, 'add_fields' ), 12 );
    }
    public function init_builder_hooks(){
        add_filter( 'nx_builder_tabs', array( $this, 'add_builder_fields' ), 12 );
    }

    private function fields(){
        $fields = [];
        $fields['maps_theme_template_new'] = array(
            'type'     => 'template',
            'builder_hidden' => true,
            'fields' => array(
                'first_param' => array(
                    'type'     => 'select',
                    'label'    => __('Notification Template' , 'notificationx'),
                    'priority' => 1,
                    'options'  => array(
                        'tag_name' => __('Full Name' , 'notificationx'),
                        'tag_first_name' => __('First Name' , 'notificationx'),
                        'tag_last_name' => __('Last Name' , 'notificationx'),
                        'tag_custom' => __('Custom' , 'notificationx'),
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
                    'default' => 'tag_name'
                ),
                'custom_first_param' => array(
                    'type'     => 'text',
                    'priority' => 2,
                    'default' => __('Someone' , 'notificationx')
                ),
                'from' => array(
                    'type'     => 'text',
                    'priority' => 3,
                    'default' => __('from' , 'notificationx')
                ),
                'second_param' => array(
                    'type'     => 'select',
                    'priority' => 4,
                    'options'  => array(
                        'tag_city'            => __('City' , 'notificationx'),
                        'tag_country'         => __('Country' , 'notificationx'),
                        'tag_city_country'         => __('City, Country' , 'notificationx'),
                    ),
                    'default' => 'tag_city'
                ),
                'third_param' => array(
                    'type'     => 'text',
                    'priority' => 3,
                    'default' => __('subscribed' , 'notificationx')
                ),
                'fourth_param' => array(
                    'type'     => 'select',
                    'priority' => 4,
                    'options'  => array(
                        'tag_title'       => __('Title' , 'notificationx'),
                        'tag_anonymous_title' => __('Anonymous Title' , 'notificationx'),
                    ),
                    'default' => 'tag_title'
                ),
                'fifth_param' => array(
                    'type'     => 'select',
                    'priority' => 5,
                    'options'  => array(
                        'tag_time'       => __('Definite Time' , 'notificationx'),
                        'tag_sometime' => __('Some time ago' , 'notificationx'),
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
            'label'    => __('Notification Template' , 'notificationx'),
            'priority' => 81,
        );

        $fields['maps_theme_template_adv'] = array(
            'type'        => 'adv_checkbox',
            'builder_hidden' => true,
            'priority'    => 82,
            'button_text' => __('Advanced Template' , 'notificationx-pro'),
            'side'        => 'right',
            'dependency'  => array(
                1 => array(
                    'fields' => array( 'maps_theme_template' )
                )
            ),
        );

        $fields['maps_theme_template'] = array(
            'type'     => 'template',
            'builder_hidden' => true,
            'priority' => 83,
            'defaults' => [
                __('Someone {{city}}, your text', 'notificationx-pro'), '{{title}}', '{{time}}'
            ],
            'variables' => [
                '{{name}}', '{{first_name}}', '{{last_name}}', '{{title}}', '{{time}}', '{{city}}', '{{country}}', '{{city_country}}'
            ],
        );

        return $fields;
    }

    public function add_fields( $options ){
        $fields = $this->fields();
        foreach ( $fields as $name => $field ) {
            $options[ 'content_tab' ]['sections']['content_config']['fields'][ $name ] = $field;
        }
        return $options;
    }

    public function add_builder_fields( $options ){
        $fields = $this->fields();
        foreach ( $fields as $name => $field ) {
            $options[ 'source_tab' ]['sections']['config']['fields'][ $name ] = $field;
        }
        return $options;
    }

    public function map_image( $image_data, $data, $settings ){
        $image_enabled = true;
        $type = NotificationX_Helper::get_type( $settings );
        $theme = NotificationX_Helper::get_theme( $settings );
        $image_enabled = $settings->show_notification_image === 'maps_image';
        if(  (  $theme === 'maps_theme' || $theme === 'conv-theme-six' ) && $image_enabled ) {
            $map_image_url = NOTIFICATIONX_PRO_URL . 'assets/images/maps/'. rand(1, 10) .'.jpg';
            $image_data['url'] = $map_image_url;

            $city = isset( $data['city'] ) ? $data['city'] : __('Somewhere', 'notificationx-pro');
            $country = isset( $data['country'] ) ? $data['country'] : __('Somewhere', 'notificationx-pro');

            $image_data['attr'] = [
                'data-city="'. $city .'"',
                'data-country="'. $country .'"'
            ];
        }
        return $image_data;
    }

    public function map_template( $template, $settings ){
        $theme = NotificationX_Helper::get_theme( $settings );
        if( in_array( $theme , array( 'conv-theme-six', 'maps_theme' ) ) ) {
            $template = 'maps_theme_template_new_string';
            if( $settings->maps_theme_template_adv ) {
                $template = 'maps_theme_template';
            }
        }
        return $template;
    }
    /**
     * Hide Maps Template
     * @param array $data
     * @return array
     */
    public function hide_template( $data ){
        $data['press_bar']['fields'][] = 'maps_theme_template_new';
        $data['press_bar']['fields'][] = 'maps_theme_template_adv';
        $data['reviews']['fields'][] = 'maps_theme_template_new';
        $data['reviews']['fields'][] = 'maps_theme_template_adv';
        $data['download_stats']['fields'][] = 'maps_theme_template_new';
        $data['download_stats']['fields'][] = 'maps_theme_template_adv';
        return $data;
    }
}