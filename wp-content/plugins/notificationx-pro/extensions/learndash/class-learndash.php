<?php
/**
 * This Class is responsible for LearnDash integration.
 * 
 * @since 1.1.4
 */
class NotificationXPro_LearnDash_Extension extends NotificationX_Extension {
    /**
     * Type of notification.
     * @var string
     */
    public $type = 'learndash';
    /**
     * Template name
     * @var string
     */
    public $template = 'elearning_template';
    /**
     * Theme name
     * @var string
     */
    public $themeName = 'elearning_theme';
    /**
     * An array of all notifications
     * @var [type]
     */
    protected $notifications = [];

    /**
     * NotificationXPro_LearnDash_Extension constructor.
     */
    public function __construct() {
        parent::__construct( $this->template );
        $this->notifications = $this->get_notifications( $this->type );
        add_filter( 'nx_notification_link', array( $this, 'notification_link' ), 10, 2 );
        add_action( 'nx_notification_image_action', array( $this, 'image_action' ) );
        add_filter( 'nx_filtered_data', array( $this, 'filtered_data' ), 10, 2 );
    }
    /**
     * @param array $data
     * @param array $saved_data
     * @param stdClass $settings
     * @return array
     */
    public function fallback_data($data, $saved_data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) !== $this->type ) {
            return $data;
        }
        $data['name']            = $this->notEmpty( 'name', $saved_data ) ? $saved_data['name'] : __( 'Someone', 'notificationx' );
        $data['first_name']      = $this->notEmpty( 'first_name', $saved_data ) ? $saved_data['first_name'] : __( 'Someone', 'notificationx' );
        $data['last_name']       = $this->notEmpty( 'last_name', $saved_data ) ? $saved_data['last_name'] : __( 'Someone', 'notificationx' );
        $data['anonymous_title'] = __( 'Anonymous Product', 'notificationx' );
        $data['sometime']        = __( 'Some time ago', 'notificationx' );

        return $data;
    }
    /**
     * Main Screen Hooks
     */
    public function init_hooks(){
        add_filter( 'nx_metabox_tabs', array( $this, 'add_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_elearning_source', array( $this, 'toggle_fields' ) );
    }
    /**
     * Builder Hooks
     */
    public function init_builder_hooks(){
        add_filter( 'nx_builder_tabs', array( $this, 'add_builder_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_builder_fields' ) );
        add_filter( 'nx_builder_tabs', array( $this, 'builder_toggle_fields' ) );
    }
    public function notification_link( $link, $settings ){
        if( $settings->display_type === 'elearning' && $settings->elearning_url === 'none' ) {
            return '';
        }

        return $link;
    }
    /**
     * Image action
     * @hooked nx_notification_image_action
     * @return void
     */
    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'notification_image' ), 10, 3 );
    }
    /**
     * Image action callback
     * @param array $image_data
     * @param array $data
     * @param stdClass $settings
     * @return array
     */
    public function notification_image( $image_data, $data, $settings ){
        if( $settings->display_type != 'elearning' || $settings->elearning_source != $this->type ) {
            return $image_data;
        }
        $image_url = $alt_title =  '';

        if( $settings->show_default_image ) {
            $default_image = $settings->image_url['url'];
        }

        switch( $settings->show_notification_image ) {
            case 'product_image' :
                $image_url = get_the_post_thumbnail_url($data['id'],'thumbnail');
                $alt_title = !empty( $data['title'] ) ? $data['title'] : '';
                break;
            case 'gravatar':
                $image_url = get_avatar_url($data['user_id'],['size' => '100']);
                $alt_title = !empty( $data['name']) ? $data['name'] : '';
        }

        if( ! $image_url && ! empty( $default_image ) ) {
            $image_url = $default_image;
        }

        $image_data['classes'] = $settings->show_notification_image;

        $image_data['url'] = $image_url;
        $image_data['alt'] = $alt_title;

        return $image_data;
    }
    /**
     * Needed content fields
     * @return array
     */
    private function init_fields(){
        $fields = [];
        if( ! class_exists( 'LDLMS_Post_Types' ) ) {
            $fields['has_no_ld'] = array(
                'type'     => 'message',
                'message'    => __('You have to install <a target="_blank" rel="nofollow" href="https://www.learndash.com">LearnDash</a> plugin first.' , 'notificationx-pro'),
                'priority' => 0,
            );
        }
        $fields['ld_product_control'] = array(
            'label'    => __('Show Notification Of', 'notificationx-pro'),
            'type'     => 'select',
            'priority' => 200,
            'default'  => 'none',
            'options'  => array(
                'none'      => __('All', 'notificationx-pro'),
                'ld_course' => __('By Course', 'notificationx-pro'),
            ),
            'dependency' => array(
                'ld_course' => array(
                    'fields' => array( 'ld_course_list' )
                ),
            )
        );
        $fields['ld_course_list'] = array(
            'label'    => __('Select Course', 'notificationx-pro'),
            'type'     => 'select',
            'multiple' => true,
            'priority' => 201,
            'options'  => self::courses()
        );

        return $fields;
    }
    protected static function courses(){
        $course_list = [];
        if( ! class_exists( 'LDLMS_Post_Types' ) ) {
            return $course_list;
        }
        $courses = get_posts(array(
            'post_type' => 'sfwd-courses',
            'numberposts' => -1,
        ));
        if( ! empty( $courses ) ) {
            foreach( $courses as $course ) {
                $meta = get_post_meta( $course->ID, '_sfwd-courses', true );
                $access_mode = $meta['sfwd-courses_course_price_type'];
                if( $access_mode != 'open' ) {
                    $course_list[ $course->ID ] = $course->post_title;
                }
            }
        }
        return $course_list;
    }
    /**
     * This function is responsible for adding fields in main screen
     *
     * @param array $options
     * @return array
     */
    public function add_fields( $options ){

        $fields = $this->init_fields();
        if( empty( $fields ) ) {
            return $options;
        }
        foreach ( $fields as $name => $field ) {
            if( $name === 'has_no_ld' ) {
                $options[ 'source_tab' ]['sections']['config']['fields'][ $name ] = $field;
            }
            $options[ 'content_tab' ]['sections']['content_config']['fields'][ $name ] = $field;
        }
        return $options;
    }
    /**
     * This function is responsible for adding fields in builder
     *
     * @param array $options
     * @return array
     */
    public function add_builder_fields( $options ){
        $fields = $this->init_fields();
        unset( $fields['ld_product_control'] );
        unset( $fields['ld_course_list'] );
        if( empty( $fields ) ) {
            return $options;
        }

        foreach ( $fields as $name => $field ) {
            $options[ 'source_tab' ]['sections']['config']['fields'][ $name ] = $field;
        }

        return $options;
    }
    /**
     * This functions is hooked
     * 
     * @hooked nx_public_action
     * @return void
     */
    public function public_actions(){
        if( ! $this->is_created( $this->type ) ) {
            return;
        }
        // public actions will be here
        add_action( 'learndash_update_course_access', [ $this, 'save_new_enrollment' ], 10, 2 );
    }
    /**
     * This functions is hooked
     * 
     * @hooked nx_admin_action
     * @return void
     */
    public function admin_actions(){
        if( ! $this->is_created( $this->type ) ) {
            return;
        }
        // admin actions will be here ... 
    }
    /**
     * This function is responsible for hide fields in main screen
     *
     * @param array $options
     * @return void
     */
    public function hide_fields( $options ) {
        $fields = $this->init_fields();
        foreach ( $fields as $name => $field ) {
            foreach( $options as $opt_key => $opt_value ) {
                $options[ $opt_key ][ 'fields' ][] = $name;
            }
        }
        return $options;
    }
    /**
     * This function is responsible for hide fields on toggle
     * in builder
     *
     * @param array $options
     * @return array
     */
    public function hide_builder_fields( $options ) {
        $fields = $this->init_fields();
        foreach ( $fields as $name => $field ) {
            foreach( $options as $opt_key => $opt_value ) {
                $options[ $opt_key ][ 'fields' ][] = $name;
            }
        }
        return $options;
    }
    /**
     * Some toggleData & hideData manipulation.
     *
     * @param array $options
     * @return array
     */
    public function toggle_fields( $options ) {
        $fields = $this->init_fields();
        $fields = array_keys( $fields );
        $sales_fields = NotificationX_ToggleFields::tutor();
        $fields = array_merge( $sales_fields['fields'], $fields, array('show_notification_image') );
        $sales_fields['fields'] = $fields;
        $options['dependency'][ $this->type ] = $sales_fields;
        $options['hide'][ $this->type ][ 'fields' ] = [ 'woo_template', 'has_no_edd', 'has_no_woo', 'product_control', 'product_exclude_by', 'product_list', 'category_list', 'exclude_categories', 'exclude_products', 'edd_product_control', 'edd_product_exclude_by', 'edd_product_list', 'edd_category_list', 'edd_exclude_categories', 'edd_exclude_products', 'custom_contents', 'show_custom_image' ];

        return $options;
    }
    /**
     * This function is responsible for builder fields
     *
     * @param array $options
     * @return array
     */
    public function builder_toggle_fields( $options ) {
        $fields = $this->init_fields();
        return $options;
    }
    /**
     * This function is generate and save a new notification when user enroll in a new course
     * @param int $user_id
     * @param int $course_id
     * @return void
     */

    public function save_new_enrollment($user_id, $course_id) {
        if( empty( $user_id ) || empty( $course_id ) ) {
            return;
        }
        $key = $course_id . '-' . $user_id;

        $this->save( $this->type, array_merge( $this->get_enrolled_course( $course_id ),  $this->get_enrolled_user( $user_id ) ), $key );
    }
    /**
     * This function is responsible for making the notification ready for first time we make the notification.
     *
     * @param string $type
     * @param array $data
     * @return void
     */
    public function get_notification_ready( $type, $data = array() ) {
        if( ! class_exists( 'LDLMS_Post_Types' ) ) {
            return;
        }
        if( $this->type === $type ) {
            $enrollments = $this->get_course_enrollments( $data );
            if( ! empty( $enrollments ) ) {
                $this->update_notifications( $this->type, $enrollments );
            }
        }
    }

    private function get_course_enrollments( $data ) {
        if( empty( $data ) ) {
            return null;
        }
        global $wpdb;
        $enrollments = [];
        $from = strtotime( date( get_option( 'date_format' ), strtotime( '-' . intval( $data[ '_nx_meta_display_from' ] ) . ' days') ) );
        $query = 'SELECT ld.user_id,ld.post_id,ld.activity_started,post.post_title FROM '.$wpdb->prefix.'learndash_user_activity AS ld JOIN '.$wpdb->prefix.'posts as post ON ld.post_id=post.ID WHERE activity_type="access" AND activity_started >'.$from.' ORDER BY activity_started DESC';
        $results = $wpdb->get_results( $query );

        if( ! empty( $results ) ) {
            foreach( $results as $result ) {
                $enrollments[] = array_merge( 
                    array(
                        'id'=> $result->post_id,
                        'title' => $result->post_title,
                        'link' => get_the_permalink($result->post_id),
                        'timestamp' => $result->activity_started
                    ), 
                    $this->get_enrolled_user( $result->user_id )
                );
            }
        }
        return $enrollments;
    }

    /**
     * Get enrolled course information
     * @param int $course_id
     * @return array
     */
    private function get_enrolled_course( $course_id ) {
        return array(
            'id' => $course_id,
            'title' => get_the_title( $course_id ),
            'link' => get_the_permalink( $course_id ),
            'timestamp' => time()
        );
    }

    /**
     * Get enrolled user information
     * @param $user_id
     * @return array
     */
    private function get_enrolled_user( $user_id ) {
        $user_data = [];
        $user_meta = get_user_meta( $user_id );
        $first_name = $user_meta['first_name'][0];
        $last_name = $user_meta['last_name'][0];
        $user_data['user_id'] = $user_id;
        if( ! empty( $first_name ) ) {
            $user_data['first_name'] = $first_name;
        } else {
            $user_data['first_name'] = $user_meta['nickname'][0];
        }
        if( ! empty( $last_name ) ) {
            $user_data['last_name'] = $last_name;
        } else {
            $user_data['last_name'] = '';
        }
        $user_data['name'] = trim( $user_data[ 'first_name' ].' '.$user_data[ 'last_name' ] );
        $user_data['email'] = get_userdata( $user_id )->data->user_email;
        /**
         * User City and Country added
         */
        if( isset( $_SERVER['REMOTE_ADDR'] ) ) {
            $user_data['ip'] = $_SERVER['REMOTE_ADDR'];
            if( ! empty( $user_data['ip'] ) ) {
                $user_ip_data = self::remote_get('http://ip-api.com/json/' . $user_data['ip'] );
                if( $user_ip_data ) {
                    $user_data['country'] = isset( $user_ip_data->country ) ? $user_ip_data->country : '';
                    $user_data['city']    = isset( $user_ip_data->city ) ? $user_ip_data->city : '';
                    $user_data['state']    = isset( $user_ip_data->state ) ? $user_ip_data->state : '';
                }
            }
        }
        $user_data['email'] = get_userdata( $user_id )->data->user_email;
        return $user_data;
    }

    public function filtered_data( $data, $settings ){
        if( $settings->display_type != 'elearning' ) {
            return $data;
        }
        if( $settings->elearning_source != 'learndash' ) {
            return $data;
        }
        if( empty( $settings->ld_product_control ) || $settings->ld_product_control === 'none' ) {
            return $data;
        }

        if( empty( $settings->ld_course_list ) ){
            return $data;
        }
        $new_data_array = [];
        if( ! empty( $data ) ) {
            foreach( $data as $key => $single ) {
                if( in_array( $single['id'], $settings->ld_course_list ) ) {
                    $new_data_array[ $key ] = $single;
                }
            }
        }
        
        return $new_data_array;
    }

    public function frontend_html( $data = [], $settings = false, $args = [] ){    
        if( class_exists( 'LDLMS_Post_Types' ) ) {
            return parent::frontend_html( $data, $settings, $args );
        }
    }
}