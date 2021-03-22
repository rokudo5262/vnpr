<?php
/**
 * NotificationXPro_Google_Analytics
 * Handles google analytics extension
 * @since 1.3.0
 */
class NotificationXPro_Google_Analytics extends NotificationX_Extension {
    /**
     * display type
     * @var string
     */
    public $display_type = 'page_analytics';
    /**
     * type
     * @var string
     */
    public $type = 'google';

    /**
     * theme name for type
     * @var string
     */
    public $themeName = 'page_analytics_theme';

    /**
     * template name for type
     * @var string
     */
    public $template = 'page_analytics_template';
    /**
     * option key for saving google analytics data as option
     * @var string
     */
    public $option_key = 'nx_pa_settings';
    /**
     * meta key for saving google analytics data in the notificationx post
     * @var string
     */
    public $meta_key = 'google_analytics_data';
    /**
     * notificationx google client helper instance
     * @var object
     */
    public $nx_google_client = null;
    /**
     * token information of google client, includes refresh token and timestamp
     * @var array
     */
    public $token_info;
    /**
     * page analytics options
     * @var array
     */
    public $pa_options;

    /**
     * Cache duration for nx google app
     */
    private $nx_app_min_cache_duration = 30;

    /**
     * Async request object
     */
    public $request;


    /**
     * NotificationXPro_Google_Analytics constructor.
     */
    public function __construct() {
        parent::__construct($this->template);
        $this->load_dependencies();
        $this->set_options();
        $this->token_info = !empty($this->pa_options['token_info']) ? $this->pa_options['token_info'] : [];
        add_action('admin_init', array($this, 'init_google_client'));
        add_action('wp', array($this, 'update_post_data'));
        add_action('wp_ajax_nx_save_ga_settings', array($this, 'save_ga_settings'));
        add_action('wp_ajax_nx_ga_disconnect_account', array($this, 'disconnect_account'));
        add_action('wp_ajax_nx_ga_save_user_app_info', array($this, 'save_user_app_info'));
        add_action('nx_notification_image_action', array($this, 'image_action'));
        $this->nx_google_client = NotificationXPro_Google_Client::getInstance();
        $this->request = new NotificationXPro_Google_Analytics_Request();
    }
    /**
     * Load dependencies for google analytics
     * @return void
     */
    public function load_dependencies()
    {
        /**
         * Autoloader
         */
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'google-analytics/inc/class-autoload.php';
        NxProAutoloader::init();
        // Google service
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'google-analytics/vendor/autoload.php';
        // //Manually Include Require Classes fro Google Vendor
        // require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'google-analytics/inc/manual-require-classes.php';
        // Google client helper
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'google-analytics/inc/class-nxpro-google-client-helper.php';

        // Update process
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'google-analytics/inc/class-nxpro-ga-updater.php';

        // wp async request
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'google-analytics/inc/class-wp-async-request.php';

        // Google analytics async request
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'google-analytics/inc/class-nxpro-ga-request.php';
    }

    /**
     * Set page analytics options
     * @return void
     */
    public function set_options() {
        $options = get_option($this->option_key);
        if (!empty( $options ) ) {
            $this->pa_options = $options;
        } else {
            $this->pa_options = [];
        }
    }

    /**
     * Render fields for notificationx post
     * @return array
     */
    protected function get_fields() {
        $fields = [];
        $template_tags = [
            '{{siteview}}', '{{title}}', '{{day}}', '{{month}}', '{{year}}'
        ];
        if (empty($this->pa_options)) {
            $fields['ga_not_connected'] = array(
                'type' => 'message',
                'message' => __('You have to connect your  <a rel="nofollow" class="ga-not-connected" href="' . admin_url('admin.php?page=nx-settings#api_integrations_tab') . '">Google Analytics Account</a>  first.', 'notificationx-pro'),
                'priority' => 0,
            );
        }
        if (!empty($this->pa_options) && $this->pa_options['ga_app_type'] == 'nx_app'){
            $fields['not_user_app'] = array(
                'type' => 'message',
                'builder_hidden' => true,
                'row_id' => 'nx_meta_page_analytics_template_new_not_user_app',
                'message' => __('You have to setup your own  <a rel="nofollow" class="no-user-app" href="' . admin_url('admin.php?page=nx-settings#api_integrations_tab') . '">Google App</a>  for enable realtime siteview.', 'notificationx-pro'),
                'priority' => 0,
            );
        }
        if (!empty($this->pa_options) && $this->pa_options['ga_app_type'] == 'user_app'){
            $template_tags = [
                '{{siteview}}', '{{realtime_siteview}}', '{{title}}', '{{day}}', '{{month}}', '{{year}}'
            ];
        }
        $fields['page_analytics_template_new'] = array(
            'type' => 'template',
            'builder_hidden' => true,
            'fields' => array(
                'first_param' => array(
                    'type' => 'select',
                    'label' => __('Notification Template', 'notificationx-pro'),
                    'priority' => 1,
                    'options' => array(
                        'tag_siteview' => __('Total Site View', 'notificationx-pro'),
                        'tag_realtime_siteview' => __('Realtime site view', 'notificationx-pro')
                    ),
                    'default' => 'tag_siteview',
                    'dependency' => array(
                        'tag_siteview' => array(
                            'fields' => array( 'fifth_param', 'sixth_param', 'analytics_fourth_param' )
                        ),
                        'tag_realtime_siteview' => array(
                            'fields' => array( 'not_user_app', 'realtime_fourth_param' )
                        ),
                    ),
                    'hide' => array(
                        'tag_realtime_siteview' => array(
                            'fields' => array( 'fifth_param', 'sixth_param', 'analytics_fourth_param' )
                        ),
                        'tag_siteview' => array(
                            'fields' => array( 'not_user_app', 'realtime_fourth_param' )
                        )
                    )
                ),
                'second_param' => array(
                    'type' => 'text',
                    'priority' => 3,
                    'default' => __('people visited', 'notificationx-pro')
                ),
                'page_third_param' => array(
                    'type' => 'select',
                    'priority' => 4,
                    'options' => array(
                        'tag_title' => __('Site Title', 'notificationx-pro'),
                        'tag_this_page' => __('Custom Title', 'notificationx-pro')
                    ),
                    'dependency' => array(
                        'tag_this_page' => [
                            'fields' => [ 'custom_page_third_param' ]
                        ]
                    ),
                    'hide' => array(
                        'tag_title' => [
                            'fields' => [ 'custom_page_third_param' ]
                        ]
                    ),
                    'default' => 'tag_title',
                ),
                'custom_page_third_param' => array(
                    'type' => 'text',
                    'priority' => 5,
                    'default' => __('this page', 'notificationx-pro')
                ),
                'analytics_fourth_param' => array(
                    'type' => 'text',
                    'priority' => 5,
                    'default' => __('in last ', 'notificationx-pro')
                ),
                'realtime_fourth_param' => array(
                    'type' => 'text',
                    'priority' => 6,
                    'default' => __('right now.', 'notificationx-pro')
                ),
                'fifth_param' => array(
                    'type' => 'text',
                    'priority' => 7,
                    'default' => __('7', 'notificationx-pro')
                ),
                'sixth_param' => array(
                    'type' => 'select',
                    'priority' => 8,
                    'options' => array(
                        'tag_day' => __('Day', 'notificationx-pro'),
                        'tag_month' => __('Month', 'notificationx-pro'),
                        'tag_year' => __('Year', 'notificationx-pro'),
                    ),
                    'default' => 'tag_day',
                ),
            ),
            'label' => __('Notification Template', 'notificationx-pro'),
            'priority' => 90,
        );

        // $fields['page_analytics_template_adv'] = array(
        //     'type' => 'adv_checkbox',
        //     'priority' => 91,
        //     'button_text' => __('Advanced Template', 'notificationx-pro'),
        //     'side' => 'right',
        //     'dependency' => array(
        //         1 => array(
        //             'fields' => array('page_analytics_template')
        //         )
        //     ),
        //     'hide' => array(
        //         0 => array(
        //             'fields' => array('page_analytics_template')
        //         )
        //     ),
        // );

        // $fields['page_analytics_template'] = array(
        //     'type' => 'template',
        //     'builder_hidden' => true,
        //     'priority' => 83,
        //     'defaults' => [
        //         '{{siteview}} '.__('people visited this page', 'notificationx-pro'), '{{title}} '. __('in last 7', 'notificationx-pro').' {{day}}'
        //     ],
        //     'variables' => $template_tags,
        // );

        return $fields;
    }

    /**
     * Render sections for notificationx post
     * @return array
     */
    public function get_sections()
    {
        $sections = [];

        $sections['page_analytics_themes'] = array(
            'title' => __('Themes', 'notificationx'),
            'priority' => 1,
            'fields' => array(
                'page_analytics_theme' => array(
                    'type' => 'theme',
                    'priority' => 5,
                    'default' => 'pa-theme-one',
                    'options' => NotificationXPro_Helper::designs_for_page_analytics(),
                ),
                'page_analytics_advance_edit' => array(
                    'type' => 'adv_checkbox',
                    'priority' => 10,
                    'default' => 0,
                    'dependency' => array(
                        1 => [
                            'sections' => ['design', 'image_design', 'typography']
                        ]
                    ),
                    'hide' => array(
                        0 => [
                            'sections' => ['design', 'image_design', 'typography']
                        ]
                    )
                ),
            )
        );

        return $sections;
    }

    /**
     * Init filter hooks
     * @return void
     */
    public function init_hooks()
    {
        add_filter('nx_metabox_tabs', array($this, 'add_fields'));
        add_filter('nx_display_types_hide_data', array($this, 'hide_fields'));
        add_filter('nx_page_analytics_source', array($this, 'toggle_fields'));
        add_filter('nx_template_string_generate', array($this, 'template_string_by_theme'), 999, 3);
    }
    /**
     * Initial Settings Hook
     * @since 1.4.0 - in NotificationX
     * @return void
     */
    public function settings_init_hook() {
        add_filter('nx_api_integration_sections', array($this, 'integration_section'));
    }
    /**
     * Init builder hooks
     * @return void
     */
    public function init_builder_hooks() {
        add_filter( 'nx_builder_tabs', array( $this, 'add_builder_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_builder_fields' ) );
        add_filter( 'nx_builder_tabs', array( $this, 'builder_toggle_fields' ) );
    }
    /**
     * Add builder fields
     *
     * @param array $options
     * @return array
     */
    public function add_builder_fields( $options ){
        $fields = $this->get_fields();
        $sections = $this->get_sections();
        unset( $sections['page_analytics_themes']['fields']['page_analytics_advance_edit'] );
        unset( $fields['page_analytics_template_adv'] );

        foreach ( $fields as $name => $field ) {
            $options['source_tab']['sections']['config']['fields'][ $name ] = $field;
        }
        foreach ( $sections as $sec_name => $section ) {
            $options['design_tab']['sections'][ $sec_name ] = $section;
        }
        return $options;
    }
    public function hide_builder_fields( $options ) {
        // $fields = array_merge( $this->get_fields() );
        // Hide fields from other field types.
        // foreach( $fields as $field_key => $field_value ) {
        //     foreach( $options as $opt_key => $opt_value ) {
        //         $options[ $opt_key ][ 'fields' ][] = $field_key;
        //     }
        // }
        return $options;
    }
    /**
     * This function is responsible for builder fields
     *
     * @param array $options
     * @return void
     */
    public function builder_toggle_fields( $options ) {
        // $fields = $this->get_fields();
        // unset( $fields[ $this->template ] );
        // $old_fields = $options['source_tab']['sections']['config']['fields']['page_analytics_source']['dependency'][ $this->type ]['fields'];
        // $options['source_tab']['sections']['config']['fields']['page_analytics_source']['dependency'][ $this->type ]['fields'] = array_merge( array_keys( $fields ), $old_fields);
        return $options;
    }
    /**
     * Add fields for notificationx post
     * @param array $options
     * @return array
     */
    public function add_fields($options)
    {
        $fields = $this->get_fields();
        $sections = $this->get_sections();
        foreach ($fields as $key => $field) {
            if ($key === 'ga_not_connected') {
                $options['source_tab']['sections']['config']['fields'][$key] = $field;
                continue;
            }
            $options['content_tab']['sections']['content_config']['fields'][$key] = $field;
        }

        foreach ($sections as $s_key => $section) {
            $options['design_tab']['sections'][$s_key] = $section;
        }

        return $options;
    }
    /**
     * This function is responsible for hide fields when others type selected.
     *
     * @param array $options
     * @return array
     */
    public function hide_fields( $options ) {
        $fields = $this->get_fields();
        $sections = $this->get_sections();
        foreach ( $fields as $name => $field ) {
            foreach( $options as $opt_key => $opt_value ) {
                if( $opt_key != 'page_analytics' ) {
                    $options[ $opt_key ][ 'fields' ][] = $name;
                }
            }
        }
        foreach ( $sections as $sname => $section ) {
            foreach( $options as $opt_key => $opt_value ) {
                if( $opt_key != 'page_analytics' ) {
                    $options[ $opt_key ][ 'sections' ][] = $sname;
                }
            }
        }
        return $options;
    }

    /**
     * This function is responsible for render toggle data for conversion
     * @param array $options
     * @return array
     */
    public function toggle_fields($options) {
        $common_fields = NotificationX_ToggleFields::common_fields();
        $thisfields = $this->get_fields();
        unset( $thisfields['page_analytics_template'] );
        $thisfields = array_keys( $thisfields );
        $thisSections = array_keys($this->get_sections());
        $common_sections = NotificationX_ToggleFields::common_sections();
        $fields = array_merge( $common_fields, $thisfields );
        $sections = array_merge( $common_sections, $thisSections );

        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }

        $options['dependency'][$this->type]['fields'] = $fields;
        $options['dependency'][$this->type]['sections'] = $sections;
        $options['hide'][$this->type]['fields'][] = 'display_last';
        $options['hide'][$this->type]['fields'][] = 'display_from';

        return $options;
    }

    /**
     * This method adds google analytics settings section in admin settings
     * @param array $sections
     * @return array
     */
    public function integration_section($sections)
    {
        $sections['google_analytics_settings_section'] = array(
            'title' => __('Google Analytics Settings', 'notificationx'),
            'modules' => 'modules_google_analytics',
            'has_button' => true,
            'button_text' => 'Save',
            'fields' => array()
        );
        if (empty($this->pa_options['ga_profiles'])) {
            $sections['google_analytics_settings_section']['fields']['ga_connect'] = array(
                'type' => 'link',
                'label' => __('Connect with Google Analytics', 'notificationx-pro'),
                'link_text' => __('Connect your account', 'notificationx-pro'),
                'css_class' => 'ga-btn connect-analytics',
                'link' => 'https://accounts.google.com/o/oauth2/auth?next=' . urlencode(admin_url('admin.php')) . '&amp;scope=' . urlencode('https://www.googleapis.com/auth/analytics.readonly') . '&amp;response_type=code&amp;access_type=offline&amp;approval_prompt=force&amp;redirect_uri=' . urlencode($this->nx_google_client->redirect_uri) . '&amp;client_id=' . $this->nx_google_client->client_id . '&amp;state=' . urlencode(admin_url('admin.php'))
            );
            $sections['google_analytics_settings_section']['fields']['ga_own_app'] = array(
                'type' => 'link',
                'label' => __('Setup your Google App', 'notificationx-pro'),
                'link_text' => __('Setup Now', 'notificationx-pro'),
                'css_class' => 'ga-btn setup-google-app',
                'link' => '#',
                'help' => 'By setting up your app, you will be disconnected from current account. See our <a target="_blank" rel="nofollow" href="https://notificationx.com/docs/google-analytics/">Creating Google App in Cloud</a> documentation for help'
            );
        }
        if (!empty($this->pa_options['ga_profiles'])) {
            $sections['google_analytics_settings_section']['fields']['ga_disconnect'] = array(
                'type' => 'link',
                'label' => __('Disconnect from google analytics', 'notificationx-pro'),
                'link_text' => __('Logout from account', 'notificationx-pro'),
                'css_class' => 'ga-btn disconnect-analytics',
            );
            $sections['google_analytics_settings_section']['fields']['ga_profile'] = array(
                'type' => 'select',
                'label' => __('Select Profile', 'notificationx-pro'),
                'options' => $this->pa_options['ga_profiles'],
                'default' => 'everyone',
                'priority' => 0,
            );
            $sections['google_analytics_settings_section']['fields']['ga_cache_duration'] = array(
                'type' => 'number',
                'label' => __('Cache Duration', 'notificationx-pro'),
                'default' => $this->nx_app_min_cache_duration,
                'min' => $this->pa_options['ga_app_type'] == 'nx_app' ? $this->nx_app_min_cache_duration : 1,
                'priority' => 5,
                'description' => __('Minutes, scheduled duration for collect new data', 'notificationx-pro'),
            );
        }
        $sections['google_analytics_settings_section']['fields']['ga_redirect_uri'] = array(
            'type' => 'text',
            'label' => __('Redirect URI', 'notificationx-pro'),
            'class' => 'ga-client-id ga-hidden',
            'default' => admin_url('admin.php?page=nx-settings'),
            'readonly'=> true,
            'help' => 'Copy this and paste it in your google app redirect uri field',
            'description' => __( 'Keep it in your google cloud project app redirect uri.', 'notification-pro' ),
        );
        $sections['google_analytics_settings_section']['fields']['ga_client_id'] = array(
            'type' => 'text',
            'label' => __('Client ID', 'notificationx-pro'),
            'class' => 'ga-client-id ga-hidden',
            'description' => __( '<a target="_blank" rel="nofollow" href="https://console.cloud.google.com/apis/dashboard">Click here</a> to get Client ID by Creating a Project or you can follow our <a rel="nofollow" target="_blank" href="https://notificationx.com/docs/google-analytics/">documentation</a>.', 'notification-pro' ),
        );
        $sections['google_analytics_settings_section']['fields']['ga_client_secret'] = array(
            'type' => 'text',
            'label' => __('Client Secret', 'notificationx-pro'),
            'class' => 'ga-client-secret ga-hidden',
            'description' => __( '<a target="_blank" rel="nofollow" href="https://console.cloud.google.com/apis/dashboard">Click here</a> to get Client Secret by Creating a Project or you can follow our <a target="_blank" rel="nofollow" href="https://notificationx.com/docs/google-analytics/">documentation</a>.', 'notification-pro' ),
        );
        $sections['google_analytics_settings_section']['fields']['ga_user_app_connect'] = array(
            'type' => 'link',
            'label' => __('Connect with Google Analytics', 'notificationx-pro'),
            'link_text' => __('Connect your account', 'notificationx-pro'),
            'css_class' => 'ga-btn connect-user-app',
            'data_atts' => array(
                'data-nonce' => wp_create_nonce('nx_save_user_app_info_nonce'),
                'data-key' => 'google_analytics_settings_section'
            ),
            'link' => '#'
        );

        return $sections;
    }

    /**
     * Init Google client with auth code
     * @return void
     */
    public function init_google_client() {
        if (isset($_GET['code']) && 'nx-settings' == $_GET['page']) {
            if(!empty($this->pa_options['auth_code'])){
                if($this->pa_options['auth_code'] === $_GET['code']){
                    return;
                }
            }
            try {
                $this->authenticate($_GET['code']);
            } catch (\Exception $e) {
                NotificationXPro_Helper::write_log(['error' => $e->getMessage()]);
            }
        }
        if (!empty($this->token_info)) {
            $this->nx_google_client->setAccessToken($this->token_info);
            if (empty($this->pa_options['ga_profiles'])) {
                try {
                    $this->set_profiles();
                } catch (\Exception $e) {
                    NotificationXPro_Helper::write_log(['error' => 'Set Profile failed. Details: ' . $e->getMessage()]);
                }
            }
        }
    }

    /**
     * Public actions
     * @return void
     */
    public function public_actions()
    {
        if (!$this->is_created($this->type)) {
            return;
        }
        add_filter('nx_fields_data', array($this, 'conversions'), 10, 2);
    }

    /**
     * Generate conversions data
     * @param array $data
     * @param int|string $id
     * @return array
     */
    public function conversions($data, $id) {
        $post_metas = $this->get_post_meta($id);
        $type = NotificationX_Helper::get_type($post_metas);
        if ($type !== $this->type) {
            return $data;
        }
        $report_type = $this->get_report_type(unserialize($post_metas->page_analytics_template_new));
        $conversions = unserialize($post_metas->{$this->meta_key});
        if($report_type == 'siteview' || $report_type == 'realtime_siteview'){
            $data[$this->type] = array(
                $report_type =>  $conversions[$report_type]
            );
        }else{
            unset($conversions['siteview']);
            unset($conversions['realtime_siteview']);
            $data[$this->type] = $conversions;
        }
        return $data;
    }

    /**
     * Set data for frontend
     * @param array $data
     * @param array $saved_data
     * @param array $settings
     * @return array
     */
    public function fallback_data( $data, $saved_data, $settings ) {
        $type = NotificationX_Helper::get_type($settings);
        if ($type !== $this->type) {
            return $data;
        }
        $saved_template_meta = NotificationX_Admin::get_post_meta($settings->id,'page_analytics_template_new');
        $report_type = $this->get_report_type($saved_template_meta);
        $data['title'] = !empty($saved_data['title']) ? $saved_data['title'] : 'Some page title';
        $data['link'] = $saved_data['link'];
        $data['id'] = $report_type;
        $data[$report_type] = !empty($saved_data['views']) ? $saved_data['views'] : $report_type . ' not found';
        $data['this_page'] = 'this page';
        $data['day'] = 'days';
        $data['month'] = 'months';
        $data['year'] = 'years';
        $data['report_type'] = $report_type;
        return $data;
    }

    /**
     * Update post analytics data if required
     * @hooked in 'wp'
     * @return void
     */
    public function update_post_data()
    {
        if(is_admin()) {
            return;
        }
        $active_items = NotificationX_Public::get_active_items();

        if(empty($active_items)){
            return;
        }
        $post = $this->get_post_details();
        $global_settings = NotificationX_DB::get_settings();
        foreach ($active_items as $item) {
            $notification_meta = $this->get_post_meta($item);
            if(isset($global_settings['ga_profile']) && empty($global_settings['ga_profile'])){
                return;
            }
            $type = NotificationX_Helper::get_type($notification_meta);
            if ($notification_meta->display_type == $this->display_type && $type == $this->type) {
                $existing_data = null;
                $saved_template_meta = unserialize($notification_meta->page_analytics_template_new);
                if(isset($notification_meta->{$this->meta_key})){
                    $existing_data = unserialize($notification_meta->{$this->meta_key});
                }
                if (!empty($existing_data)) {
                    $existing_pa_data = $this->get_existing_page_analytics_data($this->get_report_type($saved_template_meta), $post, $existing_data);
                    if ($existing_pa_data) {
                        $cache_duration = $this->get_cache_duration($global_settings);
                        $target_update_time = strtotime(str_replace(' at', '', $existing_pa_data['last_updated']) . " +" . $cache_duration . " minutes");
                        if (strtotime(current_time('Y-m-d h:ia')) > $target_update_time) {
                            $this->update_data($post, $notification_meta, $global_settings, $existing_data);
                        }
                    } else {
                        $this->insert_data($post, $notification_meta, $global_settings, $existing_data);
                    }

                } else {
                    $this->insert_data($post, $notification_meta, $global_settings);
                }
            }
        }
    }

    /**
     * update post analytics data
     * @param object $post
     * @param object $notification_settings
     * @param array $saved_data
     * @return void
     */
    public function update_data($post, $notification_settings, $global_settings, $saved_data = array())
    {
        $this->request->data(array(
            'post'=> $post,
            'notification_settings' => $notification_settings,
            'global_settings' => $global_settings,
            'saved_data' => $saved_data
        ));
        $this->request->dispatch();
    }
    /**
     * insert post analytics data
     * @param object $post
     * @param object $notification_settings
     * @param array $saved_data
     * @return void
     */
    public function insert_data($post, $notification_settings, $global_settings, $saved_data = array())
    {
        new NotificationXPro_Google_Analytics_Updater(array(
            'post'=> $post,
            'notification_settings' => $notification_settings,
            'global_settings' => $global_settings,
            'saved_data' => $saved_data
        ));
    }

    /**
     * Image action
     * @hooked nx_notification_image_action
     * @return void
     */
    public function image_action()
    {
        add_filter('nx_notification_image', array($this, 'notification_image'), 10, 3);
    }

    /**
     * Render image link and alt title for conversions
     * Set default image if post featured image is not found
     * @hooked nx_notification_image
     * @return void
     */
    public function notification_image($image_data, $data, $settings)
    {
        if (NotificationX_Helper::get_type($settings) != $this->type) {
            return $image_data;
        }
        $image_url = $alt_title = '';

        if ($settings->show_default_image) {
            $default_image = $settings->image_url['url'];
        }
        $image_url = get_the_post_thumbnail_url($data['id'], 'thumbnail');
        $alt_title = !empty($data['title']) ? $data['title'] : '';

        if (!$image_url && !empty($default_image)) {
            $image_url = $default_image;
        }

        $image_data['classes'] = $settings->show_notification_image;

        $image_data['url'] = $image_url;
        $image_data['alt'] = $alt_title;

        return $image_data;
    }

    /**
     * Regenerate theme template string
     * @hooked nx_template_string_generate
     * @param array $template
     * @param array $old_template
     * @param array $posts_data
     * @return array
     */
    public function template_string_by_theme($template, $old_template, $posts_data) {
        if( $posts_data['nx_meta_display_type'] === 'page_analytics' ) {
            $theme_name = NotificationX_Helper::get_theme( $posts_data );
            $old_template = $posts_data['nx_meta_page_analytics_template_new'];

            if( isset( $old_template['first_param'] ) && $old_template['first_param'] !== 'tag_realtime_siteview' ) {
                unset( $old_template['realtime_fourth_param'] );
            }
            if( isset( $old_template['first_param'] ) && $old_template['first_param'] === 'tag_realtime_siteview' ) {
                unset( $old_template['analytics_fourth_param'] );
                unset( $old_template['fifth_param'] );
                unset( $old_template['sixth_param'] );
            }

            $template = NotificationX_Helper::regenerate_the_theme( $old_template, array('br_before' => [ 'page_third_param'] ) );

            if( $theme_name == 'pa-theme-one' ) {
                $template = NotificationX_Helper::regenerate_the_theme( $old_template, array('br_before' => [ 'branding'] ) );
            }
        }
        return $template;
    }
    /**
     * Render frontend html for the extensio
     * @param array $data
     * @param array|bool $settings
     * @param array $args
     * @return void
     */

    public function frontend_html($data = [], $settings = false, $args = []) {
        if( $settings->page_analytics_theme == 'pa-theme-one' ) {
            return $this->themeone_frontent_html( $data, $settings, $args );
        }
        return parent::frontend_html($data, $settings, $args);
    }

    /**
     * Save admin settings of google analytics
     * @hooked 'wp_ajax_nx_save_ga_settings'
     * @return void
     */
    public function save_ga_settings()
    {
        /**
         * Verify the Nonce
         */
        if ((!isset($_POST['nonce']) && !isset($_POST['key'])) || !
            wp_verify_nonce($_POST['nonce'], 'nx_' . $_POST['key'] . '_nonce')) {
            return;
        }

        if (isset($_POST['form_data'])) {
            NotificationX_Settings::save_settings($_POST['form_data']);
            echo json_encode(array(
                'status' => 'success',
            ));
        }
        wp_die();
    }

    /**
     * Disconnect user account from google analytics
     * Delete option of page analytics
     * @hooked 'wp_ajax_nx_save_ga_settings'
     * @return void
     */
    public function disconnect_account()
    {
        $this->nx_google_client->revokeToken();
        delete_option($this->option_key);
        $settings = NotificationX_DB::get_settings();
        unset($settings['ga_client_id']);
        unset($settings['ga_client_secret']);
        NotificationX_DB::update_settings($settings);
        echo json_encode(array(
            'status' => 'success',
        ));
        wp_die();
    }

    /**
     * Save user google app info in database
     * @hooked 'wp_ajax_nx_ga_save_user_app_info'
     * @return void
     */
    public function save_user_app_info()
    {
        /**
         * Verify the Nonce
         */
        if ((!isset($_POST['nonce']) && !isset($_POST['key'])) || !
            wp_verify_nonce($_POST['nonce'], 'nx_save_user_app_info_nonce')) {
            return;
        }
        if(!isset($_POST['client_id']) && !isset($_POST['client_secret'])){
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Client id or client secret is empty'
            ));
            wp_die();
        }

        if (isset($_POST['form_data'])) {
            NotificationX_Settings::save_settings($_POST['form_data']);
            $redirect_url = admin_url('admin.php?page=nx-settings');
            echo json_encode(array(
                'status' => 'success',
                'auth_url' => 'https://accounts.google.com/o/oauth2/auth?&scope=' . urlencode('https://www.googleapis.com/auth/analytics.readonly') . '&response_type=code&access_type=offline&approval_prompt=force&redirect_uri=' . urlencode($redirect_url) . '&client_id=' . $_POST['client_id']
            ));
        }
        wp_die();
    }

    /******** Class helper methods **********/

    /**
     * Google client instance
     * @return NxPro_Google_Client|bool
     */
    private function client()
    {
        if ($this->nx_google_client == null) {
            $this->nx_google_client = NotificationXPro_Google_Client::getInstance();
        }
        $client = $this->nx_google_client->getClient();
        if (null == $client->getAccessToken()) {
            if (empty($this->token_info)) {
                NotificationXPro_Helper::write_log('Token not found in DB. Account connected but refresh token is removed from db. In: ' . __FILE__ . ', at line ' . __LINE__);
                return false;
            }
            $this->nx_google_client->setAccessToken($this->token_info);
        }
        return $client;
    }

    /**
     * Authenticate user with auth code
     * Set access token for get data
     * Save token information in database
     * @throws \Exception
     */
    private function authenticate($code)
    {
        if (empty($this->token_info)) {
            $token_info = $this->nx_google_client->getTokenWithAuthCode($code);
            if (!array_key_exists('error', $token_info)) {
                $this->nx_google_client->setAccessToken($token_info);
                $this->pa_options['token_info'] = $token_info;
                $this->pa_options['auth_code'] = $code;
                if($this->nx_google_client->getRedirectUri() == admin_url('admin.php?page=nx-settings')){
                    $this->pa_options['ga_app_type'] = 'user_app';
                }else{
                    $this->pa_options['ga_app_type'] = 'nx_app';
                }

                $this->token_info = $token_info;
                update_option($this->option_key, $this->pa_options);
            } else {
                throw new \Exception('Get token with auth code failed.' . $token_info['error']);
            }
        }
    }

    /**
     * Get profiles in user google analytics account
     * Save profiles in database
     * @throws \Exception
     */

    private function set_profiles()
    {
        $client = $this->client();
        $analytics = new NxPro_Google_Service_Analytics($client);
        $accounts = $analytics->management_accounts->listManagementAccounts();
        $views = array();
        $items = $accounts->getItems();
        if ( ! empty( $items ) ) {
            foreach ($items as $account) {
                if (is_array($account)) {
                    $account = (object) ($account);
                }
                $properties = $analytics->management_webproperties
                    ->listManagementWebproperties($account->id);
                    $pItems = $properties->getItems();
                if (!empty($pItems)) {
                    foreach ($pItems as $property) {
                        $profiles = $analytics->management_profiles
                            ->listManagementProfiles($account->id, $property->id);
                            $profileItems = $profiles->getItems();
                        if (!empty( $profileItems )) {
                            foreach ( $profileItems as $profile) {
                                $views[$profile->getId()] = $account->name . ' => ' . $property->name . ' (' . $profile->name . ': ' . $profile->webPropertyId . ')';
                            }
                            $this->pa_options['ga_profiles'] = $views;
                            update_option($this->option_key, $this->pa_options);
                        } else {
                            throw new \Exception('No views (profiles) found for this user.');
                        }
                    }
                } else {
                    throw new \Exception('No properties found for this user.');
                }
            }
        } else {
            throw new \Exception('No accounts found for this user.');
        }
    }

    /**
     * Get current page analytics data based on type or id or archive name
     * @param string $type
     * @param object $post
     * @param array $data
     * @return array|bool
     */
    private function get_existing_page_analytics_data($type, $post, $data){
        if($type == 'siteview' || $type == 'realtime_siteview'){
            if(isset($data[$type]))
                return $data[$type];
            return false;
        }else{
            if(isset($post->is_archive)){
                if(!empty($data[$post->archive_name])){
                    return $data[$post->archive_name];
                }
            }else{
                if(!empty($data[$post->ID])){
                    return $data[$post->ID];
                }
            }
            return false;
        }
    }

    /**
     * Get current page info for updating page analytics data
     * @return array|int|object|WP_Post|null
     */
    private function get_post_details(){
        global $post;
        if(is_archive()){
            global $wp;
            $queried_object = get_queried_object();
            if(!empty($queried_object)){
                if(is_category() || is_tax()){
                    return (object) array(
                        'ID' => $queried_object->slug . '-' . $queried_object->term_id,
                        'is_archive' => true,
                        'title' => $queried_object->name,
                        'archive_name' => $queried_object->slug,
                        'link' => get_term_link($queried_object->term_id)
                    );
                }
                return (object) array(
                    'is_archive' => true,
                    'archive_name' => isset( $wp->query_vars['post_type'] ) ? $wp->query_vars['post_type'] : '',
                    'title' => isset( $queried_object->label ) ? $queried_object->label : '',
                    'link' => isset( $wp->query_vars['post_type'] ) ? get_post_type_archive_link( $wp->query_vars['post_type'] ) : ''
                );
            }else{
                $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                return (object) array(
                    'is_archive' => true,
                    'archive_name' => str_replace('/', '_',substr($link, strlen(get_bloginfo('url')))),
                    'title' => get_the_archive_title(),
                    'link' => $link
                );
            }
        }
        return $post;

    }

    /**
     * Get all metas of a notificationx post in a single query
     * Reduce the load time in frontend
     * @param int $id
     * @return object
     */
    private function get_post_meta($id)
    {
        $metas = get_post_meta($id);
        $nx_metas = array();
        foreach ($metas as $key=>$meta){
            if(strpos($key,'_nx_meta_') === 0){
                $nx_metas[str_replace('_nx_meta_','',$key)] = $meta[0];
            }
        }
        $nx_metas['id'] = $id;
        return (object) $nx_metas;
    }

    /**
     * @param array $settings
     * @return int
     */
    private function get_cache_duration($settings)
    {
        if(!empty($settings['ga_cache_duration'])){
            if(isset($this->pa_options['ga_app_type']) && $this->pa_options['ga_app_type'] == 'user_app'){
                return $settings['ga_cache_duration'];
            }else{
                if((int)$settings['ga_cache_duration'] >= $this->nx_app_min_cache_duration){
                    return $settings['ga_cache_duration'];
                }
            }
        }
        return $this->nx_app_min_cache_duration;
    }

    /**
     * Get report type
     * Remove 'tag_' from first param of saved template meta
     * @param array $template_meta
     * @return mixed
     */
    private function get_report_type($template_meta)
    {
        return str_replace('tag_','', isset( $template_meta['first_param'] ) && ! empty( $template_meta['first_param'] ) ? $template_meta['first_param'] : 'tag_siteview');
    }

    /**
     * This function responsible for all
     *
     * @param array $data
     * @param boolean $settings
     * @return void
     */
    public function themeone_frontent_html( $data = [], $settings = false, $args = [] ){
        if( ! is_object( $settings ) || empty( $data ) ) {
            return;
        }

        $raw_data = $data;
        array_walk( $data, array( $this, 'trimed' ) );
        $this->defaults = apply_filters('nx_fallback_data', array(), $data, $settings );
        $data = array_merge( $data, $this->defaults );

        extract( $args );
        $settings->themeName = $settings->{ $themeName };
        if( empty( $settings->{ $template . '_adv' } ) ) {
            $template =  $template . '_new_string';
            $theme_names = apply_filters( 'nx_themes_for_template', array( 'review_saying', 'actively_using' ));
            if( in_array( $settings->themeName, $theme_names ) ) {
                $template =  $settings->themeName . '_template_new_string';
            }
        }

        $template = apply_filters( 'nx_template_id' , $template, $settings);

        $image_class = apply_filters( 'nx_frontend_image_classes', self::get_classes( $settings, 'img' ), $settings );

        $content_class = apply_filters( 'nx_frontend_content_classes', array(), $settings );

        $inner_class = apply_filters( 'nx_frontend_inner_classes', array_merge(
            ['notificationx-inner'], self::get_classes( $settings, 'inner' ), $image_class
        ), $settings );
        $if_is_mobile = wp_is_mobile() ? 'nx-mobile-notification' : '';
        $wrapper_class = apply_filters( 'nx_frontend_wrapper_classes', array_merge(
            ['nx-notification'], self::get_classes( $settings ), array( $if_is_mobile )
        ), $settings );

        $frontend_classes = apply_filters( 'nx_frontend_classes', array(
            'wrapper' => $wrapper_class,
            'inner' => $inner_class,
            'content' => $content_class,
            'image' => $image_class,
        ), $settings );

        $output = '';
        $unique_id = uniqid( 'notificationx-' );
        $image_data = self::get_image_url( $raw_data, $settings );
        $has_no_image = '';
        if( $image_data == false || empty( $image_data ) ) {
            $has_no_image = 'has-no-image';
        }
        $output .= '<div id="'. esc_attr( $unique_id ) .'" class="'. implode( ' ', $frontend_classes['wrapper'] ) .'">';
            $output .= apply_filters( 'nx_frontend_before_html', '', $settings );
            $file = apply_filters( 'nx_frontend_before_inner', '', $settings->themeName );
            if( ! empty( $file ) ) {
                $output .= $file;
            }
            $output .= '<div class="'. implode( ' ', $frontend_classes['inner'] ) .' '. $has_no_image .'">';
                $output .= '<div class="notificationx-views">';
                    $output .= '<p class="notificationx-views-count">'. NotificationX_Helper::nice_number( $data['views'] ) .'</p>';
                    $output .= '<p class="notificationx-views-marketer">'.__( 'marketers', 'notification-pro' ) .'</p>';
                $output .= '</div>';
                unset( $data['views'] );
                $output .= '<div class="notificationx-content '. implode(' ', $frontend_classes['content'] ) .'">';
                    $before_content = apply_filters( 'nx_frontend_before_content', '', $settings->themeName );
                    if( ! empty( $before_content ) ) {
                        $output .= $before_content;
                    }

                    if( $settings->page_analytics_theme == 'pa-theme-one' ) {
                        $temp_template = $settings->{ $template };
                        $temp_o = str_replace('{{siteview}}', '', $temp_template[0]);
                        $temp_template[0] = $temp_o;

                        $settings->{ $template } = $temp_template;
                    }

                    $output .= NotificationX_Template::get_template_ready( $settings->{ $template }, self::newData( $data ), $settings, is_null( self::$powered_by ) );

                $output .= '</div>';
                if( $settings->close_button ) :
                    $output .= '<span class="notificationx-close"><svg width="8px" height="8px" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd"><g id="close" fill-rule="nonzero"><path d="M28.228,23.986 L47.092,5.122 C48.264,3.951 48.264,2.051 47.092,0.88 C45.92,-0.292 44.022,-0.292 42.85,0.88 L23.986,19.744 L5.121,0.88 C3.949,-0.292 2.051,-0.292 0.879,0.88 C-0.293,2.051 -0.293,3.951 0.879,5.122 L19.744,23.986 L0.879,42.85 C-0.293,44.021 -0.293,45.921 0.879,47.092 C1.465,47.677 2.233,47.97 3,47.97 C3.767,47.97 4.535,47.677 5.121,47.091 L23.986,28.227 L42.85,47.091 C43.436,47.677 44.204,47.97 44.971,47.97 C45.738,47.97 46.506,47.677 47.092,47.091 C48.264,45.92 48.264,44.02 47.092,42.849 L28.228,23.986 Z" id="Shape"></path></g></g></svg></span>';
                endif;
            $output .= '</div>';
            if( self::is_link_visible( $settings ) ) :
                $notx_link = self::get_link( $data, $settings );
                if( ! empty( $notx_link ) ) {
                    if( $settings->link_open ) {
                        $output .= '<a class="notificationx-link" target="_blank" href="'. esc_url( $notx_link ) .'"></a>';
                    } else {
                        $output .= '<a class="notificationx-link" href="'. esc_url( $notx_link ) .'"></a>';
                    }
                }
            endif;
            $output .= apply_filters( 'nx_frontend_after_html', '', $settings );
        $output .= '</div>';

        return $output;
    }
}