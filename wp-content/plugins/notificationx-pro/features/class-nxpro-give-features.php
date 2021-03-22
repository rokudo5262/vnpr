<?php
/**
 * @since 1.2.2
 */
class NotificationXPro_GiveFeatures {

    private $plugin_name;
    private $version;
    public static $categories;
    public static $products;

    public function __construct( $plugin_name, $version ){
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_filter( 'nx_filtered_data', array( $this, 'filtered_data' ), 10, 2 );
        add_action( 'nx_before_metabox_load', array( $this, 'before_metabox_loaded' ) );
    }
    /**
     * Get donation forms
     * @return array
     */
    protected static function donation_forms(){
        $forms_list = [];
        if( ! class_exists( 'Give' ) ) {
            return $forms_list;
        }
        $forms = get_posts(array(
            'post_type' => 'give_forms',
            'numberposts' => -1,
        ));
        if( ! empty( $forms ) ) {
            foreach( $forms as $form ) {
                $forms_list[ $form->ID ] = $form->post_title;
            }
        }
        return $forms_list;
    }

    public function before_metabox_loaded(){
        add_action( 'nx_metabox_tabs', array( $this, 'product_control' ), 100 );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_donation_source', array( $this, 'hide_fields_by_from' ) );
        add_filter( 'nx_donation_source', array( $this, 'toggle_fields' ), 11 );
    }

    private function fields(){
        $fields = array();
        $fields['give_forms_control'] = array(
            'label'    => __('Show Notification Of', 'notificationx-pro'),
            'type'     => 'select',
            'priority' => 200,
            'default'  => 'none',
            'options'  => array(
                'none'      => __('All', 'notificationx-pro'),
                'give_form' => __('By Form', 'notificationx-pro'),
            ),
            'dependency' => array(
                'give_form' => array(
                    'fields' => array( 'give_form_list' )
                ),
            )
        );
        $fields['give_form_list'] = array(
            'label'    => __('Select Donation Form', 'notificationx-pro'),
            'type'     => 'select',
            'multiple' => true,
            'priority' => 201,
            'options'  => self::donation_forms()
        );
        return $fields;
    }

    public function product_control( $options ){
        $fields = $this->fields();
        
        foreach ( $fields as $name => $field ) {
            $options[ 'content_tab' ]['sections']['content_config']['fields'][ $name ] = $field;
        }
        
        if( isset( $options['content_tab']['sections']['content_config']['fields']['woo_template_adv']['swal'] ) ) {
            unset( $options['content_tab']['sections']['content_config']['fields']['woo_template_adv']['swal'] );
            $options['content_tab']['sections']['content_config']['fields']['woo_template_adv']['dependency'] = array(
                1 => array(
                    'fields' => array( 'woo_template' )
                )
            );
        }

        return $options;
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

    public function hide_fields_by_from( $options ) {
        $fields = $this->fields();
        foreach ( $fields as $name => $field ) {
            $options[ 'hide' ]['woocommerce'][ 'fields' ][] = "$name";
            $options[ 'hide' ]['edd'][ 'fields' ][] = "$name";
            $options[ 'hide' ]['custom_notification'][ 'fields' ][] = "$name";
        }
        return $options;
    }

    public function toggle_fields( $options ){
        $options['dependency'][ 'give' ]['fields'] = array_merge( 
            [ 'give_forms_control', 'give_form_list' ], 
            isset( $options['dependency'][ 'give' ]['fields'] ) ? $options['dependency'][ 'give' ]['fields'] : []
        );
        return $options;
    }
    /**
     * This function is hooked
     * @hooked 'nx_filtered_data'
     * @param array $data
     * @param stdClass $settings
     * @return array
     */
    public function filtered_data( $data, $settings ){
        if( $settings->display_type != 'donation' ) {
            return $data;
        }
        if( $settings->donation_source != 'give' ) {
            return $data;
        }
        if( empty( $settings->give_forms_control ) || $settings->give_forms_control === 'none' ) {
            return $data;
        }

        if( empty( $settings->give_form_list ) ){
            return $data;
        }
        $new_data_array = [];
        if( ! empty( $data ) ) {
            foreach( $data as $key => $single ) {
                if( in_array( $single['give_form_id'], $settings->give_form_list ) ) {
                    $new_data_array[ $key ] = $single;
                }
            }
        }

        return $new_data_array;
    }
}