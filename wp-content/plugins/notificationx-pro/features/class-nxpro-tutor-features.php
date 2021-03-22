<?php

class NotificationXPro_TutorLMS_Features {

    private $plugin_name;
    private $version;
    public static $categories;
    public static $products;

    public function __construct( $plugin_name, $version ){

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_filter( 'nx_filtered_data', array( $this, 'show_purchaseof' ), 10, 2 );
        // add_filter( 'nx_filtered_data', array( $this, 'excludes_product' ), 10, 2 );
        add_action( 'nx_before_metabox_load', array( $this, 'before_metabox_loaded' ) );
    }

    public function before_metabox_loaded(){
        add_action( 'nx_metabox_tabs', array( $this, 'product_control' ), 100 );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_elearning_source', array( $this, 'toggle_fields' ), 11 );
    }

    private function fields(){
        $fields = array();

        $fields['tutor_product_control'] = array(
            'label'    => __('Show Notification Of', 'notificationx-pro'),
            'type'     => 'select',
            'priority' => 200,
            'default'  => 'none',
            'options'  => array(
                'none'      => __('All', 'notificationx-pro'),
                'tutor_course' => __('By Course', 'notificationx-pro'),
            ),
            'dependency' => array(
                'tutor_course' => array(
                    'fields' => array( 'tutor_course_list' )
                ),
            )
        );
        $fields['tutor_course_list'] = array(
            'label'    => __('Select Course', 'notificationx-pro'),
            'type'     => 'select',
            'multiple' => true,
            'priority' => 201,
            'options'  => self::courses()
        );
        return $fields;
    }

    public function product_control( $options ){
        $fields = $this->fields();

        foreach ( $fields as $name => $field ) {
            $options[ 'content_tab' ]['sections']['content_config']['fields'][ $name ] = $field;
        }

        return $options;
    }

    protected static function courses(){
        $course_list = [];
        if( ! function_exists( 'tutor' ) ) {
            return $course_list;
        }
        $courses = get_posts(array(
            'post_type' => 'courses',
            'numberposts' => -1,
        ));
        if( ! empty( $courses ) ) {
            foreach( $courses as $course ) {
                $course_list[ $course->ID ] = $course->post_title;
            }
        }
        return $course_list;
    }

    public function hide_fields( $options ){
        $fields = $this->fields();

        foreach ( $fields as $name => $field ) {
            foreach( $options as $opt_key => $opt_value ) {
                $options[ $opt_key ][ 'fields' ][] = $name;
            }
        }

        return $options;
    }

    public function toggle_fields( $options ){

        $options['dependency'][ 'tutor' ]['fields'] = array_merge(
            [ 'tutor_product_control', 'tutor_course_list' ],
            isset( $options['dependency'][ 'tutor' ]['fields'] ) ? $options['dependency'][ 'tutor' ]['fields'] : []
        );

        return $options;
    }

    public function show_purchaseof( $data, $settings ){
        if( $settings->display_type != 'elearning' ) {
            return $data;
        }
        if( $settings->elearning_source != 'tutor' ) {
            return $data;
        }
        if( empty( $settings->tutor_product_control ) || $settings->tutor_product_control === 'none' ) {
            return $data;
        }


        if( empty( $settings->tutor_course_list ) ){
            return $data;
        }
        $new_data_array = [];
        if( ! empty( $data ) ) {
            foreach( $data as $key => $single ) {
                if( in_array( $single['product_id'], $settings->tutor_course_list ) ) {
                    $new_data_array[ $key ] = $single;
                }
            }
        }
        return $new_data_array;
    }
}