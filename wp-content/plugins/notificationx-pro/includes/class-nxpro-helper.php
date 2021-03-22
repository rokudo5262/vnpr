<?php 

class NotificationXPro_Helper {
    public function __construct(){
        add_filter( 'nx_template_settings_by_theme', array( $this, 'settings_by_theme' ), 99 );
        add_filter('nx_display_types_hide_data', array( $this, 'hide_types' ), 100);
        add_filter('nx_display_type', array( $this, 'display_type_dependency' ), 10);
        add_filter('nx_display_types_hide_data', array( $this, 'hide_fields_data' ), 9);
        add_filter('nx_template_name', array( $this, 'template_name' ), 11);
        add_filter('nx_source_types', array( $this, 'source_types' ), 11);
        add_filter('nx_themes_types', array( $this, 'source_themes' ), 11);
        add_filter('nx_template_keys', array( $this, 'template_keys' ), 11);
        add_filter('nx_themes_for_template', array( $this, 'themes_for_template' ), 11);
        add_filter('nx_theme_source', array( $this, 'nxpro_theme_source' ), 11, 2);
    }

    public function template_name( $data ){
        $data[] = 'mailchimp_template_new';
        $data[] = 'custom_template_new';
        $data[] = 'maps_theme_template_new';
        $data[] = 'page_analytics_template_new';

        return $data;
    }

    public function hide_types( $types ){
        $fields = array('content_trim_length');
        $new_types = array();
        if( ! empty( $types ) ) {
            foreach( $types as $key => $type ) {
                $new_types[ $key ]['fields'] = array_merge( $type['fields'], $fields );
                $new_types[ $key ]['sections'] = $type['sections'];
            }
        }
        return $new_types;
    }

    public function display_type_dependency( $options ){
        $fields = NotificationX_ToggleFields::common_fields();
        $sections = NotificationX_ToggleFields::common_sections();
        $options['dependency']['email_subscription'] = array(
            'fields' => array( 'subscription_source' ),
            'sections' => $sections
        );
        $options['dependency']['page_analytics'] = array(
            'fields' => array( 'page_analytics_source' ),
            'sections' => $sections
        );
        return $options;
    }

    public static function subscription_source( $from = '' ){
        $froms = array(
            'mailchimp'  => array(
                'source' => NOTIFICATIONX_PRO_ADMIN_URL . 'assets/images/sources/mailchimp.jpg',
                'is_pro' => false,
                'title' => __('MailChimp', 'notificationx-pro')
            ),
            'convertkit'  => array(
                'source' => NOTIFICATIONX_PRO_ADMIN_URL . 'assets/images/sources/convertkit.jpg',
                'is_pro' => false,
                'title' => __('ConvertKit', 'notificationx-pro')
            ),
            'zapier'  => array(
                'source' => NOTIFICATIONX_ADMIN_URL . 'assets/img/sources/zapier.png',
                'is_pro' => false,
                'title' => __('Zapier', 'notificationx-pro')
            ),
        );
        $forms = apply_filters('nx_subscription_source_options', $froms );
        $forms = NotificationX_Helper::active_modules( $forms );

        if( $from ){
            return $froms[ $from ];
        }
        return $forms;
    }

    public static function page_analytics_source( $from = '' ){
        $froms = array(
            'google'  => array(
                'source' => NOTIFICATIONX_ADMIN_URL . 'assets/img/sources/google-analytics.jpg',
                'is_pro' => false,
                'title' => __('Google Analytics', 'notificationx-pro')
            ),
        );
        $forms = apply_filters('nx_page_analytics_options', $froms );
        $forms = NotificationX_Helper::active_modules( $forms );

        if( $from ){
            return $froms[ $from ];
        }
        return $forms;
    }

    public static function hide_fields_data( $options ){
        $options['email_subscription'] = array(
            'fields' => array(),
            'sections' => array(),
        );
        $options['custom'] = array(
            'fields' => array(),
            'sections' => array(),
        );
        $options['page_analytics'] = array(
            'fields' => array(),
            'sections' => array(),
        );
        return $options;
    }

    public static function hide_fields( $options ){
        $options['freemius'] = array(
            'fields' => array(),
            'sections' => array(),
        );
        $options['zapier'] = array(
            'fields' => array(),
            'sections' => array(),
        );
        $options['convertkit'] = array(
            'fields' => array(),
            'sections' => array(),
        );
        $options['learndash'] = array(
            'fields' => array(),
            'sections' => array(),
        );
        $options['envato'] = array(
            'fields' => array(),
            'sections' => array(),
        );
        return $options;
    }

    public static function get_type( $settings ) {
        $type = '';
        if( ! empty( $settings ) ) {
            switch( $settings->display_type ) {
                case 'email_subscription' :
                    $type = $settings->subscription_source;
                    break;
                case 'page_analytics' :
                    $type = $settings->page_analytics_source;
                    break;
                case 'custom' :
                    $type = $settings->display_type;
                    break;
            }
        }
        return $type;
    }
    public function source_types( $types ) {
        $types['email_subscription'] = 'subscription_source';
        $types['custom'] = 'display_type';
        $types['page_analytics'] = 'page_analytics_source';
        return $types;
    }

    public function source_themes( $themes ) {
        $themes['mailchimp'] = 'mailchimp_theme';
        $themes['convertkit'] = 'mailchimp_theme';
        $themes['custom_notification'] = 'theme';
        $themes['envato'] = 'theme';
        $themes['freemius'] = array(
            'reviews' => 'wporg_theme',
            'download_stats' => 'wpstats_theme',
            'conversions' => 'theme',
        );
        $themes['learndash'] = 'elearning_theme';
        $themes['zapier'] = array(
            'reviews'            => 'wporg_theme',
            'conversions'        => 'theme',
            'email_subscription' => 'mailchimp_theme',
        );
        $themes['custom'] = 'custom_theme';
        $themes['google'] = 'page_analytics_theme';
        return $themes;
    }

    public function template_keys( $templates ) {
        $templates['mailchimp']           = 'mailchimp_template_new';
        $templates['convertkit']          = 'mailchimp_template_new';
        $templates['custom_notification'] = 'custom_template_new';
        $templates['freemius'] = array(
            'reviews'        => 'wp_reviews_template_new',
            'download_stats' => 'wp_stats_template_new',
            'conversions'    => 'woo_template_new',
        );
        $templates['zapier'] = array(
            'conversions'        => 'woo_template_new',
            'reviews'            => 'wp_reviews_template_new',
            'email_subscription' => 'mailchimp_template_new',
        );
        $templates['learndash']        = 'elearning_template_new';
        $templates['envato']           = 'woo_template_new';
        $templates['custom']           = 'woo_template_new';
        $templates['google']           = 'page_analytics_template_new';
        return $templates;
    }

    public function themes_for_template( $themes ) {
        $themes[] = 'maps_theme';
        $themes[] = 'conv-theme-six';
        return $themes;
    }

    public function nxpro_theme_source( $source, $type ){
        if( $type === 'email_subscription') {
            return self::designs_for_subscription();
        }
        if( $type === 'custom' ) {
            return NotificationXPro_CustomNotification_AsType::themes();
        }
        if( $type === 'page_analytics' ) {
            return NotificationXPro_Helper::designs_for_page_analytics();
        }
    }

    public static function designs_for_subscription(){
        return apply_filters('nxpro_mailchimp_themes', array(
            'theme-one'   => NOTIFICATIONX_PRO_URL . 'assets/images/themes/mailchimp-theme-two.jpg',
            'theme-two'   => NOTIFICATIONX_PRO_URL . 'assets/images/themes/mailchimp-theme-one.png',
            'theme-three' => NOTIFICATIONX_PRO_URL . 'assets/images/themes/mailchimp-theme-three.jpg',
            'maps_theme'  => NOTIFICATIONX_PRO_URL . 'assets/images/themes/maps-theme-subscribed.png',
        ));
    }

    public static function designs_for_page_analytics(){
        return apply_filters('nxpro_page_analytics_themes', array(
            'pa-theme-one'   => NOTIFICATIONX_PRO_URL . 'assets/images/themes/ga-theme-one.jpg',
            'pa-theme-two'   => NOTIFICATIONX_PRO_URL . 'assets/images/themes/pa-theme-one.png',
            'pa-theme-three'   => NOTIFICATIONX_PRO_URL . 'assets/images/themes/pa-theme-two.png',
        ));
    }

    /**
     * Template Settings By Theme
     */
    public function settings_by_theme( $data ){
        global $post;
        $save_field = get_post_meta( $post->ID, '_nx_meta_page_analytics_template_new', true );
        $data['nx_meta_page_analytics_template_new']['pa-theme-one'] = array(
            'first_param'  => isset( $save_field['first_param'] ) ? $save_field['first_param'] : 'tag_siteview',
            'second_param' => isset( $save_field['second_param'] ) ? $save_field['second_param'] : 'visited',
            'page_third_param'  => isset( $save_field['page_third_param'] ) ? $save_field['page_third_param'] : 'tag_title',
            'custom_page_third_param'  => isset( $save_field['custom_page_third_param'] ) ? $save_field['custom_page_third_param'] : 'this page',
            'fourth_param'  => isset( $save_field['fourth_param'] ) ? $save_field['fourth_param'] : 'in last',
            'fifth_param'  => isset( $save_field['fifth_param'] ) ? $save_field['fifth_param'] : '7',
            'sixth_param'  => isset( $save_field['sixth_param'] ) ? $save_field['sixth_param'] : 'tag_day',
        );
        $data['nx_meta_page_analytics_template_new']['pa-theme-two'] = array(
            'first_param'  => isset( $save_field['first_param'] ) ? $save_field['first_param'] : 'tag_siteview',
            'second_param' => isset( $save_field['second_param'] ) ? $save_field['second_param'] : 'people visited',
            'page_third_param'  => isset( $save_field['page_third_param'] ) ? $save_field['page_third_param'] : 'tag_title',
            'custom_page_third_param'  => isset( $save_field['custom_page_third_param'] ) ? $save_field['custom_page_third_param'] : 'this page',
            'fourth_param'  => isset( $save_field['fourth_param'] ) ? $save_field['fourth_param'] : 'in last',
            'fifth_param'  => isset( $save_field['fifth_param'] ) ? $save_field['fifth_param'] : '7',
            'sixth_param'  => isset( $save_field['sixth_param'] ) ? $save_field['sixth_param'] : 'tag_day',
        );
        $data['nx_meta_page_analytics_template_new']['pa-theme-three'] = array(
            'first_param'  => isset( $save_field['first_param'] ) ? $save_field['first_param'] : 'tag_siteview',
            'second_param' => isset( $save_field['second_param'] ) ? $save_field['second_param'] : 'people visited',
            'page_third_param'  => isset( $save_field['page_third_param'] ) ? $save_field['page_third_param'] : 'tag_title',
            'custom_page_third_param'  => isset( $save_field['custom_page_third_param'] ) ? $save_field['custom_page_third_param'] : 'this page',
            'fourth_param'  => isset( $save_field['fourth_param'] ) ? $save_field['fourth_param'] : 'in last',
            'fifth_param'  => isset( $save_field['fifth_param'] ) ? $save_field['fifth_param'] : '7',
            'sixth_param'  => isset( $save_field['sixth_param'] ) ? $save_field['sixth_param'] : 'tag_day',
        );
        return $data;
    }

    public static function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}