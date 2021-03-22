<?php

/**
 * This class is responsible for making pro feature enabled in 
 * options. e.g: Notification Image Customization, Display Last Conversions Limit, etc.
 */

class NotificationXPro_Features {

    private $plugin_name;
    private $version;

    public function __construct( $plugin_name, $version ){

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_action( 'wp_enqueue_scripts', array( $this, 'pro_scripts' ) );
        add_filter( 'nx_frontend_before_content', array( $this, 'fifth_theme_dependency' ), 11, 2 );
        add_filter( 'nx_frontend_before_image', array( $this, 'fifth_theme_image_dependency' ), 11, 2 );
        add_filter( 'nx_frontend_content_classes', array( $this, 'content_class' ), 11, 2 );
        add_filter( 'nx_frontend_classes', array( $this, 'remove_classes' ), 11, 2 );
        add_action( 'nx_before_metabox_load', array( $this, 'nx_metabox_tabs' ) );
        add_action( 'nx_before_builder_load', array( $this, 'nx_builder_tabs' ) );
        add_filter( 'nx_source_types_title', array( $this, 'source_types_title' ) );
        add_filter( 'nx_source_tab_sections', array( $this, 'subscription_source' ) );
        add_filter( 'nx_builder_tabs', array( $this, 'subscription_source_for_builder' ) );
        add_filter( 'nx_enabled_disabled_item', array( $this, 'nx_enabled_disabled_item' ) );
        add_filter( 'nx_modules', array( $this, 'modules_in_settings' ) );
        add_filter( 'nx_modules_source', array( $this, 'modules_source' ) );
        add_filter( 'nx_location_status', array( $this, 'location_status' ), 10, 2 );
        add_filter( 'nx_text_trim_length',array( $this, 'set_content_trim_length' ), 10, 2 );
        add_filter( 'nx_notification_link', array( $this, 'notification_link' ), 99, 2 );
    }

    public function pro_scripts(){
        wp_enqueue_style( $this->plugin_name, NOTIFICATIONX_PRO_URL . 'assets/css/nxpro-public.min.css', array( 'notificationx' ), $this->version, 'all' );
    }

    /**
     * Options which will load in meta boxes.
     */
    public function nx_metabox_tabs(){
        add_filter( 'nx_content_tab_sections', array( $this, 'content_length_option' ) );
        add_filter( 'nx_content_tab_sections', array( $this, 'evergreen_settings' ) );
        add_filter( 'nx_customize_tab_sections', array( $this, 'queue_management_settings' ) );
        add_filter( 'nx_content_tab_sections', array( $this, 'utm_fields' ) );
        add_filter( 'nx_design_tab_sections', array( $this, 'custom_shape_option' ) );
        add_filter( 'nx_metabox_tabs', array( $this, 'customize_tab' ) );
        add_filter( 'nx_design_tab_sections', array( $this, 'themes_dependency' ) );
        add_filter( 'nx_display_tab_sections', array( $this, 'nx_visibility_custom_options' ), 11 );
        add_filter( 'nx_comment_link_options', array( $this, 'custom_link_options' ) );
        add_filter( 'nx_conversion_link_options', array( $this, 'custom_link_options' ) );
        add_filter( 'nx_rs_link_options', array( $this, 'custom_link_options' ) );
        add_filter( 'nx_elearning_link_options', array( $this, 'custom_link_options' ) );
        add_filter( 'nx_donation_link_options', array( $this, 'custom_link_options' ) );
    }
    /**
     * Options which will load in meta boxes.
     */
    public function nx_builder_tabs(){
        add_filter( 'nx_design_tab_sections', array( $this, 'themes_dependency' ), 11 );
        add_filter( 'nx_builder_tabs', array( $this, 'nx_visibility_custom_options_for_builder' ), 11 );
    }
    /**
     * Options for customize tab.
     */
    public function customize_tab( $tabs ){
        unset( $tabs['customize_tab']['sections']['behaviour']['fields']['display_last']['max'] );
        return $tabs;
    }

    public function evergreen_settings( $options ){
        unset( $options['countdown_timer']['fields']['evergreen_timer']['is_pro'] );
        return $options;
    }
    public function queue_management_settings( $options ){
        unset( $options['queue_management']['fields']['global_queue_active']['is_pro'] );
        return $options;
    }

    public function utm_fields( $options ){
        $options['utm_options'] = array(
            'title' => __('UTM Control', 'notificationx-pro'),
            'fields' => array(
                'utm_campaign' => array(
                    'label' => __('Campaign', 'notificationx-pro'),
                    'type'  => 'text',
                    'priority'	=> 5,
                    'default'	=> '',
                ),
                'utm_medium' => array(
                    'label' => __('Medium', 'notificationx-pro'),
                    'type'  => 'text',
                    'priority'	=> 10,
                    'default'	=> '',
                ),
                'utm_source' => array(
                    'label' => __('Source', 'notificationx-pro'),
                    'type'  => 'text',
                    'priority'	=> 15,
                    'default'	=> '',
                ),
            )
        );
        return $options;
    }

    public function content_length_option( $options ){
        $options['content_config']['fields']['content_trim_length'] = array(
            'label' => __('Content Length', 'notificationx-pro'),
            'type'  => 'text',
            'priority'	=> 200,
            'default'	=> 80,
            'description' => __('Enter how many characters you want to show in comment or review'),
        );

        /**
         * Custom Link Options
         * @since 1.4.0
         */
        $custom_link_options_for = [ 
            'comments' => 'link_options',
            'conversions' => 'conversion_link_options',
            'rs' => 'rs_link_options',
            'elearning' => 'elearning_link_options',
            'donation' => 'donation_link_options'
        ];

        $options[ 'link_options' ]['fields'][ 'comments_url' ]['dependency'][ 'custom' ] = [
            'fields' => [ 'comments_custom_url' ]
        ];
        $options[ 'conversion_link_options' ]['fields'][ 'conversion_url' ]['dependency'][ 'custom' ] = [
            'fields' => [ 'conversions_custom_url' ]
        ];
        $options[ 'rs_link_options' ]['fields'][ 'rs_url' ]['dependency'][ 'custom' ] = [
            'fields' => [ 'rs_custom_url' ]
        ];
        $options[ 'elearning_link_options' ]['fields'][ 'elearning_url' ]['dependency'][ 'custom' ] = [
            'fields' => [ 'elearning_custom_url' ]
        ];
        $options[ 'donation_link_options' ]['fields'][ 'donation_url' ]['dependency'][ 'custom' ] = [
            'fields' => [ 'donation_custom_url' ]
        ];

        foreach( $custom_link_options_for as $key => $option ) {
            $options[ $option ]['fields'][ $key . '_custom_url' ] = array(
                'label' => __('Custom URL', 'notificationx-pro'),
                'type'  => 'text',
                'priority'	=> 20,
                'default'	=> '',
                'description' => __('Enter a link starts with http:// or https:// , it apply for all notification', 'notificationx-pro'),
            );
        }

        return $options;
    }

    public function custom_shape_option( $options ){

        $options['image_design']['fields']['image_shape']['options']['custom'] = __( 'Custom', 'notificationx-pro' );
        $options['comment_image_design']['fields']['comment_image_shape']['options']['custom'] = __( 'Custom', 'notificationx-pro' );


        $options['image_design']['fields']['image_shape']['dependency'] = array(
            'custom' => array(
                'fields' => array( 'image_custom_shape' )
            )
        );

        $options['comment_image_design']['fields']['comment_image_shape']['dependency'] = array(
            'custom' => array(
                'fields' => array( 'comment_image_custom_shape' )
            )
        );

        $options['image_design']['fields']['image_custom_shape'] = array(
            'label'    => __('Custom Radius', 'notificationx-pro'),
            'type'     => 'text',
            'priority' => 6,
            'default'  => '',
        );

        $options['comment_image_design']['fields']['comment_image_custom_shape'] = array(
            'label'    => __('Custom Radius', 'notificationx-pro'),
            'type'     => 'text',
            'priority' => 6,
            'default'  => '',
        );

        return $options;
    }
    /**
     * This function is responsible for printing theme five Masking SVG content in NotificationX Front HTML
     *
     * @param string $output
     * @param string $themeID
     * @return void
     */
    public function fifth_theme_dependency( $output, $themeID ){
        if( empty( $output ) ) {
            if( in_array( $themeID, array( 'theme-five', 'comments-theme-five' ) ) ) {
                $output .= '<?xml version="1.0" encoding="utf-8"?><svg  id="themeFiveSVGShape" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 4.4 20" style="enable-background:new 0 0 4.4 20;" xml:space="preserve"><path class="st0" d="M0.7,0C3,2.6,4.4,5.9,4.4,9.6c0,4-1.7,7.7-4.3,10.4c1.5,0,4,0,5.4,0V0C3.8,0,1.5,0,0.7,0z"/></svg>
                ';
            }
        }
        return $output;
    }
    public function fifth_theme_image_dependency( $output, $themeID ){
        if( empty( $output ) ) {
            if( in_array( $themeID, array( 'theme-five', 'comments-theme-five' ) ) ) {
                $output .= '<?xml version="1.0" encoding="utf-8"?><svg id="themeFiveSVGImageShape" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" style="enable-background:new 0 0 20 20;" xml:space="preserve"><path class="st0" d="M0,7.4c0,4.2,0,8.4,0,12.6c0,0,0,0,0,0C0.1,19.9,13.4,6.5,20,0C14.7,4.6,7.9,7.4,0.4,7.4C0.3,7.4,0.1,7.4,0,7.4z"/></svg>';
            }
        }
        return $output;
    }

    public function content_class( $classes, $settings ){
        // if( $settings->themeName === 'theme-four' ) {
            // $customized_class_name = "nx-customize-style-$settings->id";
            // $classes[] = $customized_class_name;
        // }
        return $classes;
    }

    public function remove_classes( $classes, $settings ){
        // $customized_class_name = "nx-customize-style-$settings->id";

        // switch( $settings->themeName ) {
        //     case 'theme-four' : 
        //         $flipped = array_flip( $classes['inner'] );
        //         if( array_key_exists( $customized_class_name, $flipped ) ) {
        //             unset( $flipped[ $customized_class_name ] );
        //         }
        //         $classes['inner'] = array_flip( $flipped );
        //         break;
        // }

        return $classes;
    }

    protected function alter_array( &$value, $key, $prefix ) {
        $old_data = $value['fields'][0];
        if( $key === 'maps_theme' ) {
            return $value;
        }
        $value = array(
            'fields' => array(
                0 => $prefix . '_' . $old_data
            )
        );
    }

    protected function alter_merge( &$value, $key, $userdata ){
        if( ! isset( $value[ $userdata['key'] ] ) || in_array( $key, array( 'maps_theme', 'conv-theme-six' ) ) ) {
            return $value;
        }
        $value[ $userdata['key'] ] = array_merge( $value[ $userdata['key'] ], $userdata['data'] );
    }

    public function themes_dependency( $options ) {
        $willBe = array( 'themes', 'comment_themes', 'elearning_themes', 'donation_themes' );

        $maps_template = ['maps_theme_template_new', 'maps_theme_template_adv', 'maps_theme_template'];
        $woo_template = [ 'woo_template_new','woo_template_adv', 'woo_template'];
        $elearning_template = [ 'elearning_template_new','elearning_template_adv', 'elearning_template'];
        $donation_template = [ 'donation_template_new','donation_template_adv', 'donation_template'];

        $dependency = array(
            'theme-four' => [
                'fields' => ['image_position']
            ],
            'theme-three' => [
                'fields' => ['image_position']
            ],
            'theme-two' => [
                'fields' => ['image_position']
            ],
            'theme-one' => [
                'fields' => ['image_position']
            ],
            'theme-six-free' => [
                'fields' => ['image_position']
            ],
            'theme-seven-free' => [
                'fields' => ['image_position']
            ],
            'theme-eight-free' => [
                'fields' => ['image_position']
            ],
            'maps_theme' => [
                'fields' => [ 'maps_theme_template_new', 'maps_theme_template_adv', 'image_position' ]
            ],
            'conv-theme-six' => [
                'fields' => [ 'maps_theme_template_new', 'maps_theme_template_adv', 'image_position' ]
            ]
        );

        $hide = array(
            'theme-five' => [
                'fields' => array_merge( ['image_position'], $maps_template )
            ],
            'theme-four' => [
                'fields' => $maps_template,
            ],
            'theme-three' => [
                'fields' => $maps_template,
            ],
            'theme-two' => [
                'fields' => $maps_template,
            ],
            'theme-one' => [
                'fields' => $maps_template,
            ],
            'theme-seven-free' => [
                'fields' => $maps_template,
            ],
            'theme-eight-free' => [
                'fields' => $maps_template,
            ],
            'conv-theme-six' => [
                'fields' => array_merge( $woo_template, $donation_template, $elearning_template )
            ]
        );

        $donation_maps_theme_dependency = array( 'donation_template_new', 'donation_template_adv' );
        $theme_five_donation_dependency = array(
            'theme-five' => array('fields' => [ 'donation_template_new', 'donation_template_adv' ]),
            'conv-theme-seven' => array('fields' => [ 'donation_template_new', 'donation_template_adv' ]),
            'conv-theme-eight' => array('fields' => [ 'donation_template_new', 'donation_template_adv' ]),
            'conv-theme-nine' => array('fields' => [ 'donation_template_new', 'donation_template_adv' ]),
        );
        $donation_maps_theme_hide = array(
            'maps_theme' => [ 'fields' => $donation_template ],
            'conv-theme-seven' => [ 'fields' => $maps_template ],
            'conv-theme-eight' => [ 'fields' => $maps_template ],
            'conv-theme-nine' => [ 'fields' => $maps_template ],
        );
        $elearning_maps_theme_dependency = array( 'elearning_template_new', 'elearning_template_adv' );
        $theme_five_elearning_dependency = array(
            'theme-five' => array('fields' => [ 'elearning_template_new', 'elearning_template_adv' ]),
            'conv-theme-seven' => array('fields' => [ 'elearning_template_new', 'elearning_template_adv' ]),
            'conv-theme-eight' => array('fields' => [ 'elearning_template_new', 'elearning_template_adv' ]),
            'conv-theme-nine' => array('fields' => [ 'elearning_template_new', 'elearning_template_adv' ]),
        );
        $elearning_maps_theme_hide = array(
            'maps_theme' => [ 'fields' => $elearning_template ],
            'conv-theme-seven' => [ 'fields' => $maps_template ],
            'conv-theme-eight' => [ 'fields' => $maps_template ],
            'conv-theme-nine' => [ 'fields' => $maps_template ],
        );

        $conversions_maps_theme_dependency = array( 'woo_template_new', 'woo_template_adv' );
        $theme_five_conv_dependency = array(
            'theme-five' => array('fields' => [ 'woo_template_new', 'woo_template_adv' ]),
            'conv-theme-seven' => array('fields' => [ 'woo_template_new', 'woo_template_adv' ]),
            'conv-theme-eight' => array('fields' => [ 'woo_template_new', 'woo_template_adv' ]),
            'conv-theme-nine' => array('fields' => [ 'woo_template_new', 'woo_template_adv' ]),
        );
        $conversions_maps_theme_hide = array(
            'maps_theme' => [ 'fields' => $woo_template ],
            'conv-theme-seven' => [ 'fields' => $maps_template ],
            'conv-theme-eight' => [ 'fields' => $maps_template ],
            'conv-theme-nine' => [ 'fields' => $maps_template ],
        );

        $comments_maps_theme_dependency = array( 'comments_template_new', 'comments_template_adv' );
        $theme_five_comment_dependency = array(
            'theme-five' => array('fields' => [ 'comments_template_new', 'comments_template_adv' ]),
            'theme-six-free' => array('fields' => [ 'comments_template_new', 'comments_template_adv', 'content_trim_length' ]),
            'theme-seven-free' => array('fields' => [ 'comments_template_new', 'comments_template_adv', 'content_trim_length' ]),
            'theme-eight-free' => array('fields' => [ 'comments_template_new', 'comments_template_adv', 'content_trim_length' ]),
        );

        $comments_maps_theme_hide = array(
            'maps_theme' => [
                'fields' => [ 'comments_template_new', 'comments_template_adv', 'comments_template' ]
            ],
        );
        foreach( $options as $opt_key => $opt_value ) {
            if( in_array( $opt_key, $willBe ) ) {
                if( $opt_key == 'themes' ) {
                    $themes_dependencty = $dependency;
                    $themes_hide = array_merge( $hide, $conversions_maps_theme_hide );
                    array_walk( $themes_dependencty, array( $this, 'alter_merge' ), array( 'key' => 'fields', 'data' => $conversions_maps_theme_dependency ) );
                    $themes_dependencty = array_merge_recursive( $theme_five_conv_dependency, $themes_dependencty );
                    $options[ $opt_key ]['fields'][ 'theme' ]['dependency'] = $themes_dependencty;
                    $options[ $opt_key ]['fields'][ 'theme' ]['hide'] = $themes_hide;
                    $themes_dependencty = $themes_hide = [];
                }
                if( $opt_key == 'elearning_themes' ) {
                    $themes_dependencty = $dependency;
                    $themes_hide = array_merge( $hide, $elearning_maps_theme_hide );
                    array_walk( $themes_dependencty, array( $this, 'alter_merge' ), array( 'key' => 'fields', 'data' => $elearning_maps_theme_dependency ) );
                    $themes_dependencty = array_merge_recursive( $theme_five_elearning_dependency, $themes_dependencty );
                    $options[ $opt_key ]['fields'][ 'elearning_theme' ]['dependency'] = $themes_dependencty;
                    $options[ $opt_key ]['fields'][ 'elearning_theme' ]['hide'] = $themes_hide;
                    $themes_dependencty = $themes_hide = [];
                }
                if( $opt_key == 'donation_themes' ) {
                    $themes_dependencty = $dependency;
                    $themes_hide = array_merge( $hide, $donation_maps_theme_hide );
                    array_walk( $themes_dependencty, array( $this, 'alter_merge' ), array( 'key' => 'fields', 'data' => $donation_maps_theme_dependency ) );
                    $themes_dependencty = array_merge_recursive( $theme_five_donation_dependency, $themes_dependencty );
                    $options[ $opt_key ]['fields'][ 'donation_theme' ]['dependency'] = $themes_dependencty;
                    $options[ $opt_key ]['fields'][ 'donation_theme' ]['hide'] = $themes_hide;
                    $themes_dependencty = $themes_hide = [];
                }
                if( $opt_key == 'comment_themes' ) {
                    $comments_dependency = $dependency;
                    $comments_hide = array_merge( $hide, $comments_maps_theme_hide );
                    array_walk( $comments_dependency, array( $this, 'alter_array' ), 'comment' );
                    array_walk( $comments_dependency, array( $this, 'alter_merge' ), array( 'key' => 'fields', 'data' => $comments_maps_theme_dependency ) );
                    $comments_dependency = array_merge_recursive( $theme_five_comment_dependency, $comments_dependency );
                    $options[ $opt_key ]['fields'][ 'comment_theme' ]['dependency'] = $comments_dependency;
                    $options[ $opt_key ]['fields'][ 'comment_theme' ]['hide'] = $comments_hide;
                    $comments_dependency = $comments_hide = [];
                }
            }
        }

        return $options;
    }
    /**
     * This method is responsible for Notificationx title
     * @since 1.1.2
     * @param array $options
     * @return void
     */
    public function source_types_title( $options ){
        $options['email_subscription'] = __('Email Subscription', 'notificationx-pro');
        $options['custom'] = __('Custom Notification', 'notificationx-pro');
        $options['page_analytics'] = __('Page Analytics', 'notificationx-pro');
        return $options;
    }
    /**
     * Add email subscription sources
     *
     * @param array $sections
     * @return void
     */
    public function subscription_source( $sections ){
        
        $sections['config']['fields']['subscription_source']  = apply_filters('nx_email_subscription_source', array(
            'type'        => 'theme',
            'inner_title' => __('Source' , 'notificationx-pro'),
            'default'     => 'mailchimp',
            'options'     => NotificationXPro_Helper::subscription_source(),
            'priority'    => 54,
        ));

        $sections['config']['fields']['page_analytics_source']  = apply_filters('nx_page_analytics_source', array(
            'type'        => 'theme',
            'inner_title' => __('Source' , 'notificationx-pro'),
            'default'     => 'google',
            'options'     => NotificationXPro_Helper::page_analytics_source(),
            'priority'    => 55,
        ));

        return $sections;
    }
    public function subscription_source_for_builder( $tabs ){
        
        $tabs['source_tab']['sections']['config']['fields']['subscription_source']  = apply_filters('nx_email_subscription_source', array(
            'type'        => 'theme',
            'inner_title' => __('Source' , 'notificationx-pro'),
            'default'     => 'mailchimp',
            'options'     => NotificationXPro_Helper::subscription_source(),
            'priority'    => 54,
        ));

        $tabs['source_tab']['sections']['config']['fields']['page_analytics_source']  = apply_filters('nx_page_analytics_source', array(
            'type'        => 'theme',
            'inner_title' => __('Source' , 'notificationx-pro'),
            'default'     => 'google',
            'options'     => NotificationXPro_Helper::page_analytics_source(),
            'priority'    => 55,
        ));

        return $tabs;
    }

    public function nx_enabled_disabled_item( $returned_value ){
        return false;
    }

    protected function modules_pro_tag_remove( &$item ){
        if( is_array( $item  ) && isset( $item['is_pro'] ) ) {
            $item['is_pro'] = false;
        }
    }

    public function modules_in_settings( $modules ) {
        array_walk( $modules, array( $this, 'modules_pro_tag_remove' ) );
        return $modules;
    }

    public function modules_source( $modules_source ) {
        $modules_source['conversions'][]        = 'modules_zapier';
        $modules_source['conversions'][]        = 'modules_freemius';
        $modules_source['conversions'][]        = 'modules_envato';
        $modules_source['reviews'][]            = 'modules_zapier';
        $modules_source['reviews'][]            = 'modules_freemius';
        $modules_source['download_stats'][]     = 'modules_freemius';
        $modules_source['conversions'][]        = 'modules_custom_notification';
        $modules_source['email_subscription'][] = 'modules_mailchimp';
        $modules_source['email_subscription'][] = 'modules_convertkit';
        $modules_source['email_subscription'][] = 'modules_zapier';
        $modules_source['elearning'][]          = 'modules_learndash';
        $modules_source['page_analytics'][]     = 'modules_google_analytics';
        $modules_source['form'][]               = 'modules_grvf';
        
        $modules_source['freemius']            = 'modules_freemius';
        $modules_source['custom_notification'] = 'modules_custom_notification';
        $modules_source['custom']              = 'modules_custom_notification';
        $modules_source['mailchimp']           = 'modules_mailchimp';
        $modules_source['convertkit']          = 'modules_convertkit';
        $modules_source['zapier']              = 'modules_zapier';
        $modules_source['envato']              = 'modules_envato';
        $modules_source['learndash']           = 'modules_learndash';
        $modules_source['google']              = 'modules_google_analytics';
        $modules_source['grvf']                = 'modules_grvf';

        return $modules_source;
    }

    public function nx_visibility_custom_options( $options ) {
        $locations_key = NotificationX_Locations::locations( '' );
        $options['visibility']['fields']['show_on']['hide']['everywhere']['fields'][] = 'custom_ids';
        $options['visibility']['fields']['all_locations']['options'] = $locations_key;
        unset( $options['visibility']['fields']['show_on_display']['help'] );
        $options['visibility']['fields']['all_locations']['options']['is_custom'] = __('Custom Post or Page IDs', 'notificationx-pro');
        $options['visibility']['fields']['all_locations']['dependency'] = array(
            'is_custom' => array(
                'fields' => array( 'custom_ids' )
            )
        );
        if( ! empty( $locations_key ) ) {
            foreach( $locations_key as $key => $location ) {
                $options['visibility']['fields']['all_locations']['hide'][ $key ] = array(
                    'fields' => array('custom_ids')
                );
            }
        }

        $options['visibility']['fields']['custom_ids'] =  array(
            'label'       => __('IDs ( Posts or Pages )', 'notificationx-pro'),
            'type'        => 'text',
            'priority'    => 30,
            'description' => __('Comma separated ID of post, page or custom post type posts', 'notificationx-pro'),
        );
        return $options;
    }
    public function nx_visibility_custom_options_for_builder( $options ) {
        $locations_key = NotificationX_Locations::locations( '' );
        $options['display_tab']['sections']['visibility']['fields']['show_on']['hide']['everywhere']['fields'][] = 'custom_ids';
        $options['display_tab']['sections']['visibility']['fields']['all_locations']['options'] = $locations_key;
        unset( $options['display_tab']['sections']['visibility']['fields']['show_on_display']['help'] );
        $options['display_tab']['sections']['visibility']['fields']['all_locations']['options']['is_custom'] = __('Custom Post or Page IDs', 'notificationx-pro');
        $options['display_tab']['sections']['visibility']['fields']['all_locations']['dependency'] = array(
            'is_custom' => array(
                'fields' => array( 'custom_ids' )
            )
        );

        if( ! empty( $locations_key ) ) {
            foreach( $locations_key as $key => $location ) {
                $options['display_tab']['sections']['visibility']['fields']['all_locations']['hide'][ $key ] = array(
                    'fields' => array('custom_ids')
                );
            }
        }

        $options['display_tab']['sections']['visibility']['fields']['custom_ids'] =  array(
            'label'       => __('IDs ( Posts or Pages )', 'notificationx-pro'),
            'type'        => 'text',
            'priority'    => 30,
            'description' => __('Comma separated ID of post, page or custom post type posts', 'notificationx-pro'),
        );
        return $options;
    }
    /**
     * This method is responsible for display notification on specific page
     *
     * @param array $status
     * @return array
     * @since 1.1.2
     */
    public function location_status( $status, $custom_ids ) {
        $status['is_custom'] = NotificationXPro::check_location_custom_ids( $custom_ids );
        return $status;
    }

    /**
     * Callback for 'nx_text_trim_length' filter
     * @param int $trim_length
     * @param stdClass $settings
     * @return int
     * @since 1.1.4
     */
    public function set_content_trim_length( $trim_length, $settings ) {
        if( ! empty( $settings->content_trim_length ) ) {
            $trim_length = $settings->content_trim_length;
        }
        return $trim_length;
    }
    /**
     * Custom Link Options
     */
    public function custom_link_options( $options ){
        $options['custom'] = __('Custom URL', 'notificationx-pro');
        return $options;
    }
    /**
     * Custom Link Options
     */
    public function notification_link( $link, $settings ){
        if( $settings->display_type === 'elearning' ) {
            if( $settings->elearning_url === 'custom' ) {
                $link = $settings->elearning_custom_url;
            }
        } elseif( $settings->display_type === 'comments' ) {
            if( $settings->comments_url === 'custom' ) {
                $link = $settings->comments_custom_url;
            }
        } elseif( $settings->display_type === 'conversions' ) {
            if( $settings->conversion_url === 'custom' ) {
                $link = $settings->conversions_custom_url;
            }
        } elseif( in_array( $settings->display_type, array( 'reviews', 'download_stats' ) ) ) {
            if( $settings->rs_url === 'custom' ) {
                $link = $settings->rs_custom_url;
            }
        } elseif( $settings->display_type === 'donation' ) {
            if( $settings->donation_url === 'custom' ) {
                $link = $settings->donation_custom_url;
            }
        }
        return $link;
    }
}