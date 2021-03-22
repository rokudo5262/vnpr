<?php
/**
 * This Class is responsible for making custom
 * notifications.
 */
class NotificationXPro_CustomNotification_AsType extends NotificationX_Extension {
    /**
     *  Type of notification.
     *
     * @var string
     */
    public $type = 'custom';
    public $template = 'woo_template';
    public $themeName = 'custom_theme';
    public $meta_key = 'type_custom_contents';
    public static $new_array = null;
    /**
     * An array of all notifications
     *
     * @var [type]
     */
    protected $notifications = [];
    protected static $sales_themes = [];
    protected static $comments_themes = [];
    protected static $reviews_themes = [];
    protected static $stats_themes = [];
    protected static $subs_themes = [];

    public function __construct() {
        parent::__construct();

        self::$sales_themes = NotificationX_Helper::colored_themes();

        $comments_themes = NotificationX_Helper::comment_colored_themes();
        self::$new_array = null;
        array_walk($comments_themes, 'NotificationXPro_CustomNotification_AsType::add_prefix', array( 'prefix' => 'comments-' ) );
        self::$comments_themes = self::$new_array;

        $reviews_themes = NotificationX_Helper::designs_for_review();
        self::$new_array = null;
        array_walk($reviews_themes, 'NotificationXPro_CustomNotification_AsType::add_prefix', array( 'prefix' => 'reviews-' ) );
        self::$reviews_themes = self::$new_array;

        $stats_themes = NotificationX_Helper::designs_for_stats();
        self::$new_array = null;
        array_walk($stats_themes, 'NotificationXPro_CustomNotification_AsType::add_prefix', array( 'prefix' => 'stats-' ) );
        self::$stats_themes = self::$new_array;
        
        $subs_themes = NotificationXPro_Helper::designs_for_subscription();
        self::$new_array = null;
        array_walk($subs_themes, 'NotificationXPro_CustomNotification_AsType::add_prefix', array( 'prefix' => 'subs-' ) );
        self::$subs_themes = self::$new_array;

        add_action( 'nx_notification_image_action', array( $this, 'image_action' ) ); // Image Action for gravatar
        add_action( 'nx_builder_tabs', array( $this, 'quick_builder_tabs' ) ); // Image Action for gravatar
        add_filter( 'nx_frontend_image_classes', array( $this, 'classes' ), 10, 2 ); // Image Action for gravatar
        add_filter( 'nx_get_theme', array( $this, 'get_theme' ), 10, 2 ); // Image Action for gravatar
    }
    /**
     * TODO: Template Has an Issue have to check is anything is broken or not.
     */
    public function template_string_by_theme( $template, $old_template, $posts_data ){
        if( NotificationX_Helper::get_type( $posts_data ) === $this->type ) {
            $template = NotificationX_Helper::regenerate_the_theme( 
                $old_template, array( 'br_before' => [ 'third_param', 'fourth_param' ] ) 
            );

            if( in_array( $posts_data['nx_meta_custom_theme'], array( 'subs-maps_theme', 'comments-maps_theme' ) ) ) {
                $old_template = $posts_data['nx_meta_maps_theme_template_new'];
                $template = NotificationX_Helper::regenerate_the_theme( 
                    $old_template, array( 'br_before' => [ 'fourth_param', 'fifth_param' ] ) 
                );
            }

            if( in_array( $posts_data['nx_meta_custom_theme'], 
                array( 'reviews-review-comment-3', 'reviews-review-comment-2', 'reviews-review-comment', 'reviews-reviewed', 'reviews-total-rated' ) ) ) {
                $old_template = $posts_data['nx_meta_wp_reviews_template_new'];
                $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'third_param', 'fourth_param' ] ) );
            }

            if( $posts_data['nx_meta_custom_theme'] === 'reviews-review_saying' ) {
                $old_template = $posts_data['nx_meta_review_saying_template_new'];
                $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'fifth_param', 'sixth_param' ] ) );
            }

            if( in_array( $posts_data['nx_meta_custom_theme'], array( 'stats-today-download', 'stats-total-download', 'stats-7day-download' ) ) ) {
                $old_template = $posts_data['nx_meta_wp_stats_template_new'];
                $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'second_param', 'fourth_param' ] ) );
            }

            if( $posts_data['nx_meta_custom_theme'] === 'stats-actively_using' ) {
                $old_template = $posts_data['nx_meta_actively_using_template_new'];
                $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'third_param' ] ) );
            }
        }
        return $template;
    }

    public function quick_builder_tabs( $tabs ) {
        $source_tab = $tabs['source_tab'];
        $design_tab = $tabs['design_tab'];
        $display_tab = $tabs['display_tab'];
        $finalize_tab = $tabs['finalize_tab'];
        $content_tab = array(
            'title'      => __('Content', 'notificationx'),
            'icon'       => 'pencil.svg',
            'sections'   => array(
                'custom_content_fields' => array(
                    'title'      => __('', 'notificationx'),
                    'priority' => 0,
                    'fields'   => array()
                )
            )
        );

        $tabs = array(
            'source_tab' => $source_tab,
            'design_tab' => $design_tab,
            'content_tab' => $content_tab,
            'display_tab' => $display_tab,
            'finalize_tab' => $finalize_tab,
        );

        return $tabs;
    }

    /**
     * Image Action
     */
    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'notification_image' ), 10, 3 );
    }

    public function notification_image( $image_data, $data, $settings ){
        if( $settings->display_type != $this->type ) { 
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
            $image = wp_get_attachment_image_src( $data['image']['id'], 'medium', true );
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

    public function classes( $classes, $settings ) {
        if( $settings->display_type === 'custom' && $settings->custom_advance_edit ) {
            $classes = [];
            $classes[] = 'nx-img-' . $settings->image_position;
            $classes[] = 'nx-img-' . $settings->image_shape;
            return $classes;
        }
        return $classes;
    }

    public function fallback_data( $data, $saved_data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) !== $this->type ) {
            return $data;
        }

        $theme = $settings->custom_theme;

        if( isset( $saved_data['name'] ) && ! empty( $saved_data['name'] ) ) {
            $names = explode( ' ', $saved_data['name'] );
            $data['first_name'] = isset( $names[0] ) ? $names[0] : __('Someone', 'notificationx-pro');
            $data['last_name'] = isset( $names[1] ) ? $names[1] : __('Someone', 'notificationx-pro');
        }

        if( isset( $saved_data['time'] ) ) {
            $time = str_replace( ',', '', $saved_data['time'] );
            $data['timestamp'] = strtotime( $time );
        }

        if( array_key_exists( $theme, self::$sales_themes ) ) {
            if( isset( $saved_data['sales_count'] ) ) {
                $data['sales_count'] = $saved_data['sales_count'];
            }
        }
        if( array_key_exists( $theme, self::$reviews_themes ) ) {
            if($theme == 'review-comment-2' || $theme == 'review-comment-3'){
                $trim_length = 80;
                $exploded_username = explode(' ',$saved_data['username']);
                if($exploded_username >= 1){
                    $name = ucfirst($exploded_username[0]);
                    if( isset( $exploded_username[1] ) ) {
                        $surname = $exploded_username[1];
                        if( ! empty( $surname ) ){
                            $surname_substr = substr( $surname, 0, 1 );
                            if (ctype_alpha( $surname_substr ) !== false){
                                $name .= ' '. $surname_substr . '.';
                            }
                        }
                    }
                }
            }
            $data['name'] = $name;
            $data['plugin_name_text'] = __('try it out', 'notificationx');
            $data['anonymous_title'] = __('Anonymous', 'notificationx');
            $data['plugin_review'] = htmlspecialchars( $review_content );
        }

        $nx_trimmed_length = apply_filters( 'nx_text_trim_length', 80, $settings );
        if( isset( $saved_data['post_comment'] ) ) {
            if( $this->notEmpty( 'post_comment', $saved_data ) ){
                $comment = $saved_data['post_comment'];
                if(strlen($comment) > $nx_trimmed_length){
                    $data['post_comment'] = substr( $comment, 0, $nx_trimmed_length ).'...';
                }
            }
        }
        if( isset( $saved_data['plugin_review'] ) ) {
            if( $this->notEmpty( 'plugin_review', $saved_data ) ){
                $comment = $saved_data['plugin_review'];
                if(strlen($comment) > $nx_trimmed_length){
                    $data['plugin_review'] = substr( $comment, 0, $nx_trimmed_length ).'...';
                }
            }
        }

        if( array_key_exists( $theme, self::$stats_themes ) ) {
            $data['today'] = __( NotificationX_Helper::nice_number( $saved_data['today'] ) . ' times today', 'notificationx' );
            if( isset( $saved_data['yesterday'] ) ) {
                $data['yesterday'] = __( NotificationX_Helper::nice_number( $saved_data['yesterday'] ) . ' times', 'notificationx' );
            }
            if( isset( $saved_data['last_week'] ) ) {
                $data['last_week'] = __( NotificationX_Helper::nice_number( $saved_data['last_week'] ) . ' times in last 7 days', 'notificationx' );
            }
            if( isset( $saved_data['all_time'] ) ) {
                $data['all_time'] = __( NotificationX_Helper::nice_number( $saved_data['all_time'] ) . ' times', 'notificationx' );
            }
            if( isset( $saved_data['active_installs'] ) ) {
                $data['active_installs'] = __( NotificationX_Helper::nice_number( $saved_data['active_installs'] ), 'notificationx' );
            }

            if( $theme !== 'active_installs' ) {
                $data['active_installs_text'] = __( 'Try It Out', 'notificationx' );
            }
            
            $data['today_text'] = __( 'Try It Out', 'notificationx' );
            $data['last_week_text'] = __( 'Get Started for Free.', 'notificationx' );
            $data['all_time_text'] = __( 'Why Don\'t You?', 'notificationx' );
        }

        $data['sometime'] = __( 'Some time ago', 'notificationx-pro' );
        return $data;
    }

    public function init_hooks(){
        add_filter( 'nx_metabox_tabs', array( $this, 'add_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_display_type', array( $this, 'toggle_fields' ) );
    }

    public function init_builder_hooks(){
        add_filter( 'nx_builder_tabs', array( $this, 'add_builder_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_builder_fields' ) );
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
        add_filter( 'nx_fields_data', array( $this, 'conversions' ), 10, 2 );
    }

    public function get_fields(){
        $fields = [];

        $fields['type_custom_contents']  = array(
            'type'     => 'group',
            'priority' => 150,
            'title'    => __('Custom Conversion', 'notificationx-pro'),
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
                'time' => array(
                    'type'  => 'datepicker',
                    'label'    => __('Time' , 'notificationx-pro'),
                    'priority' => 40,
                ),
            ],
        );
        $fields['type_custom_contents_sales_count']  = array(
            'type'     => 'group',
            'priority' => 151,
            'title'    => __('Custom Conversion', 'notificationx-pro'),
            'fields' => [
                'title' => array(
                    'type'     => 'text',
                    'label'    => __('Product Title' , 'notificationx-pro'),
                    'priority' => 1,
                ),
                'sales_count' => array(
                    'type'     => 'text',
                    'label'    => __('Number of Sales' , 'notificationx-pro'),
                    'priority' => 2,
                ),
                'image' => array(
                    'type'     => 'media',
                    'label'    => __('Image' , 'notificationx-pro'),
                    'priority' => 30,
                ),
                'link' => array(
                    'type'     => 'text',
                    'label'    => __('Product URL' , 'notificationx-pro'),
                    'priority' => 3,
                ),
            ]
        );
        $fields['type_custom_contents_maps_theme']  = array(
            'type'     => 'group',
            'priority' => 112,
            'title'    => __('Custom Conversion', 'notificationx-pro'),
            'fields' => [
                'name' => array(
                    'type'     => 'text',
                    'label'    => __('Name' , 'notificationx-pro'),
                    'priority' => 0,
                ),
                'title' => array(
                    'type'     => 'text',
                    'label'    => __('Title' , 'notificationx-pro'),
                    'priority' => 1,
                ),
                'city' => array(
                    'type'     => 'text',
                    'label'    => __('City' , 'notificationx-pro'),
                    'priority' => 2,
                ),
                'country' => array(
                    'type'     => 'text',
                    'label'    => __('Country' , 'notificationx-pro'),
                    'priority' => 3,
                ),
                'image' => array(
                    'type'     => 'media',
                    'label'    => __('Image' , 'notificationx-pro'),
                    'priority' => 4,
                ),
                'link' => array(
                    'type'     => 'text',
                    'label'    => __('URL' , 'notificationx-pro'),
                    'priority' => 5,
                ),
                'time' => array(
                    'type'     => 'datepicker',
                    'label'    => __('Time' , 'notificationx-pro'),
                    'priority' => 6,
                ),
            ]
        );
        $fields['type_custom_contents_comments']  = array(
            'type'     => 'group',
            'priority' => 152,
            'title'    => __('Custom Conversion', 'notificationx-pro'),
            'fields' => [
                'name' => array(
                    'type'     => 'text',
                    'label'    => __('Commenter Name' , 'notificationx-pro'),
                    'priority' => 0,
                ),
                'post_title' => array(
                    'type'     => 'text',
                    'label'    => __('Title' , 'notificationx-pro'),
                    'priority' => 1,
                ),
                'post_comment' => array(
                    'type'     => 'textarea',
                    'label'    => __('Comment' , 'notificationx-pro'),
                    'priority' => 2,
                ),
                'image' => array(
                    'type'     => 'media',
                    'label'    => __('Image' , 'notificationx-pro'),
                    'priority' => 3,
                ),
                'link' => array(
                    'type'     => 'text',
                    'label'    => __('URL' , 'notificationx-pro'),
                    'priority' => 4,
                ),
                'time' => array(
                    'type'     => 'datepicker',
                    'label'    => __('Time' , 'notificationx-pro'),
                    'priority' => 5,
                ),
            ]
        );
        $fields['type_custom_contents_reviews']  = array(
            'type'     => 'group',
            'priority' => 153,
            'title'    => __('Custom Conversion', 'notificationx-pro'),
            'fields' => [
                'username' => array(
                    'type'     => 'text',
                    'label'    => __('Name' , 'notificationx-pro'),
                    // 'default' => 'A Marketer',
                    'priority' => 0,
                ),
                'rated' => array(
                    'type'     => 'text',
                    'label'    => __('Number of Peoples Rated' , 'notificationx-pro'),
                    // 'default' => '10K+',
                    'priority' => 1,
                ),
                'plugin_name' => array(
                    'type'     => 'text',
                    'label'    => __('Review For' , 'notificationx-pro'),
                    // 'default' => 'My Plugin or Theme Name',
                    'priority' => 2,
                ),
                'title' => array(
                    'type'     => 'text',
                    'label'    => __('Review Title' , 'notificationx-pro'),
                    'priority' => 3,
                ),
                'plugin_review' => array(
                    'type'     => 'textarea',
                    'label'    => __('Review Text' , 'notificationx-pro'),
                    'priority' => 4,
                ),
                'rating' => array(
                    'type'     => 'number',
                    'max'     => 5,
                    'default'     => 5,
                    'label'    => __('Rating' , 'notificationx-pro'),
                    'priority' => 5,
                ),
                'image' => array(
                    'type'     => 'media',
                    'label'    => __('Image' , 'notificationx-pro'),
                    'priority' => 6,
                ),
                'link' => array(
                    'type'     => 'text',
                    'label'    => __('URL' , 'notificationx-pro'),
                    'priority' => 7,
                ),
                'time' => array(
                    'type'     => 'datepicker',
                    'label'    => __('Time' , 'notificationx-pro'),
                    'priority' => 8,
                ),
            ]
        );
        $fields['type_custom_contents_stats']  = array(
            'type'     => 'group',
            'priority' => 154,
            'title'    => __('Custom Conversion', 'notificationx-pro'),
            'fields' => [
                'name' => array(
                    'type'     => 'text',
                    'label'    => __('Product Name' , 'notificationx-pro'),
                    'priority' => 0,
                ),
                'today' => array(
                    'type'     => 'number',
                    'label'    => __('Todays Download' , 'notificationx-pro'),
                    'description'    => __('Number of items downloaded in one day.' , 'notificationx-pro'),
                    'priority' => 1,
                ),
                'last_week' => array(
                    'type'     => 'number',
                    'label'    => __('7 Days Downloads' , 'notificationx-pro'),
                    'description'    => __('Number of items downloaded in last 7 days.' , 'notificationx-pro'),
                    'priority' => 2,
                ),
                'all_time' => array(
                    'type'     => 'number',
                    'label'    => __('Total Downloads' , 'notificationx-pro'),
                    'description'    => __('Number of items downloaded in total.' , 'notificationx-pro'),
                    'priority' => 3,
                ),
                'active_installs' => array(
                    'type'     => 'number',
                    'label'    => __('Number of Active Installs' , 'notificationx-pro'),
                    'priority' => 4,
                ),
                'image' => array(
                    'type'     => 'media',
                    'label'    => __('Image' , 'notificationx-pro'),
                    'priority' => 3,
                ),
                'link' => array(
                    'type'     => 'text',
                    'label'    => __('URL' , 'notificationx-pro'),
                    'priority' => 4,
                ),
            ]
        );
        $fields['type_custom_contents_subs']  = array(
            'type'     => 'group',
            'priority' => 155,
            'title'    => __('Custom Conversion', 'notificationx-pro'),
            'fields' => [
                'name' => array(
                    'type'     => 'text',
                    'label'    => __('Name' , 'notificationx-pro'),
                    'priority' => 0,
                ),
                'email' => array(
                    'type'     => 'text',
                    'label'    => __('Email' , 'notificationx-pro'),
                    'priority' => 1,
                ),
                'title' => array(
                    'type'     => 'text',
                    'label'    => __('Subscribed To' , 'notificationx-pro'),
                    'priority' => 2,
                ),
                'image' => array(
                    'type'     => 'media',
                    'label'    => __('Image' , 'notificationx-pro'),
                    'priority' => 3,
                ),
                'link' => array(
                    'type'     => 'text',
                    'label'    => __('URL' , 'notificationx-pro'),
                    'priority' => 4,
                ),
                'time' => array(
                    'type'     => 'datepicker',
                    'label'    => __('Time' , 'notificationx-pro'),
                    'priority' => 5,
                ),
            ]
        );

        return $fields;
    }
    public function get_sections(){
        $sections = [];

        $sales_counts_contents_theme = array( 'conv-theme-seven', 'conv-theme-eight', 'conv-theme-nine' );
        $all_template_hide           = array( 'woo_template', 'comments_template', 'wp_reviews_template', 'wp_stats_template', 'mailchimp_template', 'maps_theme_template' );

        $sale_template            = array( 'woo_template_new', 'woo_template_adv', 'type_custom_contents' );
        $map_template             = array( 'maps_theme_template_new', 'maps_theme_template_adv', 'type_custom_contents_maps_theme' );
        $comments_template        = array( 'comments_template_new', 'comments_template_adv', 'type_custom_contents_comments' );
        $reviews_content          = array( 'type_custom_contents_reviews' );
        $reviews_template         = array( 'wp_reviews_template_new', 'wp_reviews_template_adv' );
        $reviews_saying_template  = array( 'review_saying_template_new', 'review_saying_template_adv', 'type_custom_contents_review_saying' );
        $stats_contents           = array( 'type_custom_contents_stats' );
        $stats_template           = array( 'wp_stats_template_new', 'wp_stats_template_adv' );
        $active_installs_template = array( 'actively_using_template_new', 'actively_using_template_adv' );
        $subs_template            = array( 'mailchimp_template_new', 'mailchimp_template_adv', 'type_custom_contents_subs' );

        $themes_key = array_keys( self::themes() );
        $dependency = $hide = [];

        if( ! empty( $themes_key ) ) {
            // For Templates Dependency
            foreach( $themes_key as $theme_name ) {
                $theme_name = trim( $theme_name );
                switch( true ) {
                    case array_key_exists( $theme_name, self::$sales_themes ) : 
                        if( in_array( $theme_name, array( 'maps_theme', 'conv-theme-six' ) ) ) {
                            $dependency[ $theme_name ]['fields'] = $map_template;
                            $hide[ $theme_name ]['fields'] = array_merge( 
                                $comments_template, $sale_template, $reviews_template, $subs_template, $stats_template, $reviews_saying_template, $active_installs_template, $stats_contents, $reviews_content, $all_template_hide );
                        } else {
                            $dependency[ $theme_name ]['fields'] = $sale_template;
                            $hide[ $theme_name ]['fields'] = array_merge( 
                                $comments_template, $map_template, $reviews_template, $subs_template, $stats_template, $reviews_saying_template, $active_installs_template, $stats_contents, $reviews_content, $all_template_hide );
                            if( in_array( $theme_name, $sales_counts_contents_theme ) ) {
                                $sale_template[2] = 'type_custom_contents_sales_count';
                                $dependency[ $theme_name ]['fields'] = $sale_template;
                            } else {
                                $hide[ $theme_name ]['fields'][] = 'type_custom_contents_sales_count';
                            }
                        }
                        break;
                    case array_key_exists( $theme_name, self::$comments_themes ) : 
                        if( in_array( $theme_name, array( 'comments-maps_theme' ) ) ) { 
                            $dependency[ $theme_name ]['fields'] = $map_template;
                            $hide[ $theme_name ]['fields'] = array_merge( $sale_template, $comments_template, $reviews_template, $subs_template, $stats_template, $reviews_saying_template, $active_installs_template, $stats_contents, $reviews_content, $all_template_hide );
                        } else {
                            $dependency[ $theme_name ]['fields'] = $comments_template;
                            $hide[ $theme_name ]['fields'] = array_merge( $sale_template, $map_template, $reviews_template, $subs_template, $stats_template, $reviews_saying_template, $active_installs_template, $stats_contents, $reviews_content, $all_template_hide );
                        }
                        break;
                    case array_key_exists( $theme_name, self::$reviews_themes ) : 
                        if( in_array( $theme_name, array( 'review_saying' ) ) ) {
                            $dependency[ $theme_name ]['fields'] = array_merge( $reviews_saying_template, $reviews_content );
                            $hide[ $theme_name ]['fields'] = array_merge( $sale_template, $map_template, $comments_template, $subs_template, $stats_template, $reviews_template, $active_installs_template, $stats_contents, $all_template_hide );
                        } else {
                            $dependency[ $theme_name ]['fields'] = array_merge( $reviews_template, $reviews_content );
                            $hide[ $theme_name ]['fields'] = array_merge( $sale_template, $map_template, $comments_template, $subs_template, $stats_template, $reviews_saying_template, $active_installs_template, $stats_contents, $all_template_hide );
                        }
                        break;
                    case array_key_exists( $theme_name, self::$stats_themes ) : 
                        if( in_array( $theme_name, array( 'actively_using' ) ) ) {
                            $dependency[ $theme_name ]['fields'] = array_merge( $active_installs_template, $stats_contents );
                            $hide[ $theme_name ]['fields'] = array_merge( $sale_template, $map_template, $comments_template, $subs_template, $reviews_template, $reviews_saying_template, $stats_template, $reviews_content, $all_template_hide );
                        } else {
                            $dependency[ $theme_name ]['fields'] = array_merge( $stats_template, $stats_contents );
                            $hide[ $theme_name ]['fields'] = array_merge( $sale_template, $map_template, $comments_template, $subs_template, $reviews_template, $reviews_saying_template, $active_installs_template, $reviews_content, $all_template_hide );
                        }
                        break;
                    case array_key_exists( $theme_name, self::$subs_themes ) : 
                        if( in_array( $theme_name, array( 'subs-maps_theme' ) ) ) { 
                            $dependency[ $theme_name ]['fields'] = $map_template;
                            $hide[ $theme_name ]['fields'] = array_merge( $sale_template, $subs_template, $comments_template, $stats_template, $reviews_template, $reviews_saying_template, $active_installs_template, $stats_contents, $reviews_content, $all_template_hide );
                        } else {
                            $dependency[ $theme_name ]['fields'] = $subs_template;
                            $hide[ $theme_name ]['fields'] = array_merge( $sale_template, $map_template, $comments_template, $stats_template, $reviews_template, $reviews_saying_template, $active_installs_template, $stats_contents, $reviews_content, $all_template_hide );
                        }
                        break;
                }
            }
        }

        $sections['custom_themes']  = array(
            'title'      => __('Themes', 'notificationx'),
            'priority' => 1,
            'fields'   => array(
                'custom_theme' => array(
                    'type'       => 'theme',
                    'priority'   => 5,
                    'default'    => 'theme-one',
                    'options'    => self::themes(),
                    'dependency' => $dependency,
                    'hide'       => $hide,
                ),
                'custom_advance_edit' => array(
                    'type'      => 'adv_checkbox',
                    'priority'	=> 10,
                    'default'	=> 0,
                    'dependency' => array(
                        1 => [
                            'sections' => ['design', 'image_design', 'typography']
                        ]
                    ),
                    'hide' => array(
                        0 => [
                            'sections' => ['design', 'image_design', 'typography']
                        ]
                    ),
                ),
            )
        );

        return $sections;
    }

    public static function add_prefix( $value, $key, $userdata = [] ){
        $key = isset( $userdata['prefix'] ) ? $userdata['prefix'] . $key : '';
        self::$new_array[ $key ] = $value;
    }

    public static function themes(){
        $themes = array_merge( self::$sales_themes, self::$comments_themes, self::$reviews_themes, self::$stats_themes, self::$subs_themes );
        return $themes;
    }

    public function add_fields( $options ){
        $fields = $this->get_fields();
        $sections = $this->get_sections();
        foreach ( $fields as $key => $field ) {
            $options['content_tab']['sections']['content_config']['fields'][ $key ] = $field;
        }
        foreach ( $sections as $s_key => $section ) {
            $options['design_tab']['sections'][ $s_key ] = $section;
        }
        return $options;
    }

    public function add_builder_fields( $options ){
        $fields = $this->get_fields();
        $sections = $this->get_sections();

        foreach ( $fields as $key => $field ) {
            $options['content_tab']['sections']['custom_content_fields']['fields'][ $key ] = $field;
        }
        foreach ( $sections as $s_key => $section ) {
            $options['design_tab']['sections'][ $s_key ] = $section;
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
        $sections = $this->get_sections();
        // Hide fields from other field types.
        foreach ( $fields as $name => $field ) {
            foreach( $options as $opt_key => $opt_value ) {
                if( $opt_key !== $this->type ) {
                    $options[ $opt_key ][ 'fields' ][] = $name;
                }
            }
        }
        foreach ( $sections as $s_name => $section ) {
            foreach( $options as $opt_key => $opt_value ) {
                if( $opt_key !== $this->type ) {
                    $options[ $opt_key ][ 'sections' ][] = $s_name;
                }
            }
        }
        return $options;
    }


    public function hide_builder_fields( $options ) {
        $fields = $this->get_fields();
        // Hide fields from other field types.
        foreach( $options as $opt_key => $opt_value ) {
            foreach( $fields as $field_key => $field_value ) {
                if( $opt_key !== $this->type ) {
                    $options[ $opt_key ]['fields'][] = $field_key;
                }
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
        $default = NotificationX_ToggleFields::common_fields();
        $d_sections = NotificationX_ToggleFields::common_sections();
        $fields = array_keys( $this->get_fields() );
        $sections = array_keys( $this->get_sections() );
        $fields = array_merge( $default, $fields, array( 'show_notification_image' ) );
        $sections = array_merge( $d_sections, $sections );

        $options['dependency'][ $this->type ]['fields'] = $fields;
        $options['dependency'][ $this->type ]['sections'] = $sections;

        return $options;
    }

    public function conversions( $data, $id ) {
        $settings = NotificationX_MetaBox::get_metabox_settings( intval( $id ) );
        if( $settings->display_type !== 'custom' ) {
            return $data;
        }
        $theme = $settings->custom_theme;

        $temp_meta_key = $this->meta_key;

        switch( true ) {
            case array_key_exists( $theme, self::$sales_themes ) : 
                $final_meta_key = $temp_meta_key;
                if( in_array( $theme, array( 'conv-theme-seven', 'conv-theme-eight', 'conv-theme-nine' )) ) {
                    $final_meta_key = $temp_meta_key . '_sales_count';
                }
                if( in_array( $theme, array( 'maps_theme', 'conv-theme-six' )) ) {
                    $final_meta_key = $temp_meta_key . '_maps_theme';
                }
                break;
            case array_key_exists( $theme, self::$comments_themes ) : 
                $final_meta_key = $temp_meta_key . '_comments';
                if( in_array( $theme, array( 'comments-maps_theme' )) ) {
                    $final_meta_key = $temp_meta_key . '_maps_theme';
                }
                break;
            case array_key_exists( $theme, self::$reviews_themes ) : 
                $final_meta_key = $temp_meta_key . '_reviews';
                break;
            case array_key_exists( $theme, self::$stats_themes ) : 
                $final_meta_key = $temp_meta_key . '_stats';
                break;
            case array_key_exists( $theme, self::$subs_themes ) : 
                $final_meta_key = $temp_meta_key . '_subs';
                if( in_array( $theme, array( 'subs-maps_theme' )) ) {
                    $final_meta_key = $temp_meta_key . '_maps_theme';
                }
                break;
        }
        $this->meta_key = $final_meta_key;
        $data[ $this->type ] = NotificationX_Admin::get_post_meta( intval( $id ), $this->meta_key, true );
        return $data;
    }

    public function get_theme( $theme_name, $settings ){
        if( $settings->display_type === 'custom' ) {
            $theme_name = str_replace('comments-', '', $theme_name);
            $theme_name = str_replace('subs-', '', $theme_name);
            $theme_name = str_replace('stats-', '', $theme_name);
            $theme_name = str_replace('reviews-', '', $theme_name);
            return $theme_name;
        }
        return $theme_name;
    }

    public function frontend_html( $data = [], $settings = false, $args = [] ){
        if( $settings->display_type === 'custom' ) {
            $args['themeName'] = 'custom_theme';
            $temp_theme_name = $settings->custom_theme;
            $theme_name = NotificationX_Helper::get_theme( $settings );

            unset( self::$sales_themes['maps_theme'] );
            unset( self::$sales_themes['conv-theme-six'] );
            unset( self::$comments_themes['comments-maps_theme'] );
            unset( self::$subs_themes['subs-maps_theme'] );

            switch( $temp_theme_name ) {
                case array_key_exists( $temp_theme_name, self::$sales_themes ) : 
                    $args['template'] = 'woo_template';
                    break;
                case array_key_exists( $temp_theme_name, self::$comments_themes ) : 
                    $args['template'] = 'comments_template';
                    break;
                case array_key_exists( $temp_theme_name, self::$reviews_themes ) : 
                    $args['template'] = 'wp_reviews_template';
                    if( $temp_theme_name === 'reviews-review_saying' ) {
                        $args['template'] = 'review_saying_template';
                    }
                    break;
                case array_key_exists( $temp_theme_name, self::$stats_themes ) : 
                    $args['template'] = 'wp_stats_template';
                    if( $temp_theme_name === 'stats-actively_using' ) {
                        $args['template'] = 'actively_using_template';
                    }
                    break;
                case array_key_exists( $temp_theme_name, self::$subs_themes ) : 
                    $args['template'] = 'mailchimp_template';
                    break;
                case 'maps_theme' || 'conv-theme-six' || 'comments-maps_theme' || 'subs-maps_theme' : 
                    $args['template'] = 'maps_theme_template';
                    break;
            }
        }

        if( ! empty( $data['rating'] ) ) {
            $star = '';
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

        return parent::frontend_html( $data, $settings, $args );
    }
}