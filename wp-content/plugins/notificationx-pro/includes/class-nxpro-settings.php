<?php

class NotificationXPro_Settings {

    public function __construct(){

        add_action( 'nx_before_settings_load', array( $this, 'powered_by_settings' ) );
        add_filter( 'nx_cron_schedules', array( $this, 'cron_schedules' ) );
        add_filter( 'notificationx_settings_tab', array( $this, 'pro_settings' ) );
        add_filter( 'nx_branding_url', array( $this, 'nx_branding_url' ), 12 );
        add_filter( 'nx_advanced_settings_sections', array( $this, 'global_queue_settings' ) );

    }

    public function global_queue_settings( $options ){
        $role_management = $options['role_management'];
        unset( $options['role_management'] );
        $global_queue_management = array(
            'title' => __( 'Global Queue Management', 'notificationx' ),
            'priority' => 20,
            'fields' => array(
                'delay_before' => array(
                    'type'        => 'number',
                    'label'       => __('Delay Before First Notification' , 'notificationx'),
                    'description' => __('seconds', 'notificationx'),
                    'help'        => __('Initial Delay', 'notificationx'),
                    'priority'    => 1,
                    'default'     => 5,
                ),
                'display_for' => array(
                    'type'        => 'number',
                    'label'       => __('Display For' , 'notificationx'),
                    'description' => __('seconds', 'notificationx'),
                    'help'        => __('Display each notification for * seconds', 'notificationx'),
                    'priority'    => 2,
                    'default'     => 5,
                ),
                'delay_between' => array(
                    'type'        => 'number',
                    'label'       => __('Delay Between' , 'notificationx'),
                    'description' => __('seconds', 'notificationx'),
                    'help'        => __('Delay between each notification', 'notificationx'),
                    'priority'    => 70,
                    'default'     => 5,
                )
            )
        ); 

        $options['global_queue_management'] = $global_queue_management;
        $options['role_management'] = $role_management;
        return $options;
    }

    public function powered_by_settings(){
		add_filter( 'nx_powered_by_settings', array( $this, 'settings' ) );
    }
    
    public function pro_settings( $settings ){
        $settings[ 'api_integrations_tab' ] = array(
            'title' => __( 'API Integrations', 'notificationx' ),
            'priority' => 12,
            'is_pro' => ! NX_CONSTANTS::is_pro(),
            'sections' => apply_filters('nx_api_integration_sections', array(
                'mailchimp_settings_section' => array(
                    'modules' => 'modules_mailchimp',
                    'title' => __( 'MailChimp Settings', 'notificationx' ),
                    'has_button' => true,
                    'fields' => array(
                        'mailchimp_api_key' => array(
                            'type'        => 'text',
                            'label'       => __('MailChimp API Key' , 'notificationx-pro'),
                            'default'     => __('', 'notificationx'),
                            'priority'    => 5,
                            'description' => '<a target="_blank" rel="nofollow" href="https://mailchimp.com/help/about-api-keys/">Click Here</a> to get your API KEY',
                        ),
                        'mailchimp_cache_duration' => array(
                            'type'        => 'text',
                            'label'       => __('Cache Duration' , 'notificationx-pro'),
                            'default'     => 5,
                            'priority'    => 5,
                            'description' => __('Minutes, scheduled duration for collect new data', 'notificationx-pro'),
                        )
                    )
                ),
                'convertkit_settings_section' => array(
                    'title' => __( 'ConvertKit Settings', 'notificationx' ),
                    'modules' => 'modules_convertkit',
                    'has_button' => true,
                    'fields' => array(
                        'convertkit_api_key' => array(
                            'type'        => 'text',
                            'label'       => __('API Key' , 'notificationx-pro'),
                            'default'     => '',
                            'priority'    => 5,
                            'description' => '<a target="_blank" rel="nofollow" href="https://developers.convertkit.com">Click Here</a> to get API KEY.',
                        ),
                        'convertkit_api_secret' => array(
                            'type'        => 'text',
                            'label'       => __('API Secret' , 'notificationx-pro'),
                            'default'     => '',
                            'priority'    => 5,
                            'description' => '<a target="_blank" rel="nofollow" href="https://developers.convertkit.com">Click Here</a> to get API Secret.',
                        ),
                        'convertkit_cache_duration' => array(
                            'type'        => 'text',
                            'label'       => __('Cache Duration' , 'notificationx-pro'),
                            'default'     => 3,
                            'priority'    => 5,
                            'description' => __('Minutes, scheduled duration for collect new data', 'notificationx-pro'),
                        )
                    )
                ),
                'freemius_settings_section' => array(
                    'title' => __( 'Freemius Settings', 'notificationx' ),
                    'modules' => 'modules_freemius',
                    'has_button' => true,
                    'fields' => array(
                        'freemius_dev_id' => array(
                            'type'        => 'text',
                            'label'       => __('Developer ID' , 'notificationx-pro'),
                            'priority'    => 5,
                            'default'     => '',
                            'description' => '<a target="_blank" rel="nofollow" href="https://dashboard.freemius.com">Click Here</a> to get Developer ID.',
                        ),
                        'freemius_dev_pk' => array(
                            'type'      => 'text',
                            'label'     => __('Developer Public Key' , 'notificationx-pro'),
                            'priority'	=> 6,
                            'default'	=> '',
                            'description' => '<a target="_blank" rel="nofollow" href="https://dashboard.freemius.com">Click Here</a> to get Developer Public KEY.',
                        ),
                        'freemius_dev_sk' => array(
                            'type'      => 'text',
                            'label'     => __('Developer Secret Key' , 'notificationx-pro'),
                            'priority'	=> 7,
                            'default'	=> '',
                            'description' => '<a target="_blank" rel="nofollow" href="https://dashboard.freemius.com">Click Here</a> to get Developer Secret KEY.',
                        ),
                        'freemius_cache_duration' => array(
                            'type'      => 'text',
                            'label'     => __('Cache Duration' , 'notificationx-pro'),
                            'default'	=> 5,
                            'priority'	=> 5,
                            'description'	=> __( 'Minutes, scheduled duration for collect new data', 'notificationx-pro' ),
                        ),
                    )
                ),
                'zapier_settings_section' => array(
                        'title' => __( 'Zapier Settings', 'notificationx' ),
                        'modules' => 'modules_zapier',
                        'has_button' => true,
                        'button_text' => 'Save',
                        'fields' => array(
                            'zapier_api_key' => array(
                            'description'	=> __( '<a target="_blank" rel="nofollow" href="https://zapier.com/developer/public-invite/28239/62de3486b323cd5830e27b251183a456/">Click here</a> to get invitaion.', 'notificationx-pro' ),
                            'type'      => 'text',
                            'label'     => __('API Key' , 'notificationx-pro'),
                            'default'	=> md5( home_url( '', 'http' ) ),
                            'priority'	=> 5,
                            'readonly' => true
                        )
                    )
                ),
                'envato_settings_section' => array(
                    'title' => __( 'Envato Settings', 'notificationx' ),
                    'modules' => 'modules_envato',
                    'has_button' => true,
                    'button_text' => 'Save',
                    'fields' => array(
                        'envato_token' => array(
                            'description'	=> __( '<a target="_blank" rel="nofollow" href="https://build.envato.com">Click here</a> to get your API Access Token.', 'notificationx-pro' ),
                            'type'      => 'text',
                            'label'     => __('API Access Token' , 'notificationx-pro'),
                            'priority'	=> 5,
                        ),
                        'envato_cache_duration' => array(
                            'type'      => 'text',
                            'label'     => __('Cache Duration' , 'notificationx-pro'),
                            'default'	=> 5,
                            'priority'	=> 5,
                            'description'	=> __( 'Minutes, scheduled duration for collect new data', 'notificationx-pro' ),
                        ),
                    )
                ),
                
            )),
            'views' => 'NotificationX_Settings::integrations'
        );

        $settings['go_license_tab'] = array(
            'title' => __( 'License', 'notificationx' ),
            'priority' => 19,
            'views' => 'NotificationXPro_Settings::license'
        );

        return $settings;
    }

    public function settings( $options ){
        $options['fields']['disable_powered_by']['disable'] = false;
        $options['fields']['affiliate_link'] = array(
            'type' => 'text',
            'label' => __('Affiliate Link'),
            'default' => '',
            'priority' => 11,
        );
        return $options;
    }

    public function cron_schedules( $schedules ){
        $sales_count_cache_duration = NotificationX_DB::get_settings( 'sales_count_cache_duration' );
        $convertkit_cache_duration = NotificationX_DB::get_settings( 'convertkit_cache_duration' );
        $freemius_cache_duration   = NotificationX_DB::get_settings( 'freemius_cache_duration' );
        $mailchimp_cache_duration  = NotificationX_DB::get_settings( 'mailchimp_cache_duration' );
        $envato_cache_duration     = NotificationX_DB::get_settings( 'envato_cache_duration' ); // @since 1.1.4
        $ga_cache_duration     = NotificationX_DB::get_settings( 'ga_cache_duration' ); // @since 1.1.4

        if ( ! $convertkit_cache_duration || empty( $convertkit_cache_duration ) ) {
            $convertkit_cache_duration = 3;
        }
        if ( ! $freemius_cache_duration || empty( $freemius_cache_duration ) ) {
            $freemius_cache_duration = 3;
        }
        if ( ! $mailchimp_cache_duration || empty( $mailchimp_cache_duration ) ) {
            $mailchimp_cache_duration = 3;
        }
        // @since 1.1.4
        if ( ! $envato_cache_duration || empty( $envato_cache_duration ) ) {
            $envato_cache_duration = 3;
        }

        if ( ! $ga_cache_duration || empty( $ga_cache_duration ) ) {
            $ga_cache_duration = 3;
        }
        if ( ! $sales_count_cache_duration || empty( $sales_count_cache_duration ) ) {
            $sales_count_cache_duration = 3;
        }
        
        $schedules['nx_convertkit_interval'] = array(
            'interval'	=> MINUTE_IN_SECONDS * $convertkit_cache_duration,
            'display'	=> sprintf( __('Every %s minutes', 'notificationx'), $convertkit_cache_duration )
		);
		
        $schedules['nx_freemius_interval'] = array(
            'interval'	=> MINUTE_IN_SECONDS * $freemius_cache_duration,
            'display'	=> sprintf( __('Every %s minutes', 'notificationx'), $freemius_cache_duration )
        );

        $schedules['nx_mailchimp_interval'] = array(
            'interval'	=> MINUTE_IN_SECONDS * $mailchimp_cache_duration,
            'display'	=> sprintf( __('Every %s minutes', 'notificationx'), $mailchimp_cache_duration )
        );
        // @since 1.1.4
        $schedules['nx_envato_interval'] = array(
            'interval'	=> MINUTE_IN_SECONDS * $envato_cache_duration,
            'display'	=> sprintf( __('Every %s minutes', 'notificationx'), $envato_cache_duration )
        );
        // @since 1.2.11
        $schedules['nx_ga_cache_duration'] = array(
            'interval'	=> MINUTE_IN_SECONDS * $ga_cache_duration,
            'display'	=> sprintf( __('Every %s minutes', 'notificationx'), $ga_cache_duration )
        );
        // @since 1.5.0
        $schedules['nx_sales_count_interval'] = array(
            'interval'	=> MINUTE_IN_SECONDS * $sales_count_cache_duration,
            'display'	=> sprintf( __('Every %s minutes', 'notificationx'), $sales_count_cache_duration )
        );
        
        return $schedules;
    }

    public static function license(){
        include NOTIFICATIONX_ADMIN_DIR_PATH . 'partials/nx-settings-sidebar.php';
    }

    public function nx_branding_url( $link ){
        $affiliate_link = NotificationX_DB::get_settings('affiliate_link');
        if( ! empty( $affiliate_link ) ) {
            $link = $affiliate_link;
        }
        return $link;
    }

}

new NotificationXPro_Settings;