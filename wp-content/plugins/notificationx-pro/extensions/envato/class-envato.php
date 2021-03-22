<?php
/**
 * This Class is responsible for making envato activity
 * notifications.
 * 
 * @since 1.1.4
 */
class NotificationXPro_Envato_Extension extends NotificationX_Extension {
    /**
     *  Type of notification.
     * @var string
     */
    public $type      = 'envato';
    public $template  = 'woo_template';
    public $themeName = 'theme';
    public $meta_key  = 'envato_content';
    private $_token   = '';
    private $temp_data_array = [];

    public function __construct() {
        parent::__construct( $this->template );
        $this->_token = NotificationX_DB::get_settings('envato_token');
        add_action( 'wp_ajax_nx_envato_api', array( $this, 'save_api' ) );
        add_action( 'nx_notification_image_action', array( $this, 'image_action' ) );
        add_action( 'nx_cron_update_data', array( $this, 'update_data' ), 10, 1 );
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

        $data['name'] = $data['first_name'] = $data['last_name'] = __('Someone', 'notificationx-pro');

        return $data;
    }

    public function image_action(){
        add_filter( 'nx_notification_image', array( $this, 'notification_image' ), 10, 3 );
    }

    public function notification_image( $image_data, $data, $settings ){
        if( NotificationX_Helper::get_type( $settings ) != 'envato' ) { 
            return $image_data;
        }
        
        $avatar = '';
        $alt_title = isset( $data['title'] ) ? $data['title'] : '';
        $alt_title = empty( $alt_title ) && isset( $data['name'] ) ? $data['name'] : $alt_title;

        if( $settings->show_notification_image == 'product_image' ) {
            $avatar = $data['icon_url'];
        }

        if( isset( $data['email'] ) ) {
            $avatar = get_avatar_url( $data['email'], array(
                'size' => '100',
            ));
        }

        $image_data['url'] = $avatar;
        $image_data['alt'] = $alt_title;

        return $image_data;
    }

    private function init_fields(){
        $fields = [];
        if( empty( $this->_token ) ) {
            $fields['has_no_envato_token'] = array(
                'type'     => 'message',
                'message'  => __('You have to setup your API Token for <a href="'. admin_url('admin.php?page=nx-settings#api_integrations_tab') .'">Envato</a>.' , 'notificationx-pro'),
                'priority' => 0,
            );
        }

        return $fields;
    }
    

    private function get_fields(){
        return $this->init_fields();
    }

    public function init_hooks(){
        add_filter( 'nx_metabox_tabs', array( $this, 'add_fields' ) );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_conversion_from', array( $this, 'toggle_fields' ) );
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
            if( $name == 'has_no_envato_token' ) {
                $options[ 'source_tab' ]['sections']['config']['fields'][ $name ] = $field;
            }
        }
        return $options;
    }

    public function add_builder_fields( $options ){
        $fields = $this->get_fields();

        foreach ( $fields as $name => $field ) {
            $options['source_tab']['sections']['config']['fields'][ $name ] = $field;
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

        if( empty( $fields ) ) {
            return $options;
        }

        foreach ( $fields as $name => $field ) {
            foreach( $options as $opt_key => $opt_value ) {
                $options[ $opt_key ][ 'fields' ][] = $name;
            }
        }
        
        return $options;
    }

    public function hide_builder_fields( $options ) {
        $fields = array_merge( $this->get_fields(), ['edd_template', 'woo_template'] );
        // Hide fields from other field types.
        foreach( $fields as $field_key => $field_value ) {
            foreach( $options as $opt_key => $opt_value ) {
                $options[ $opt_key ][ 'fields' ][] = $field_key;
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
        $sales_fields = NotificationX_ToggleFields::woocommerce();
        $fields = array_merge( $sales_fields['fields'], $fields, array('show_notification_image') );

        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }

        $options['dependency'][ $this->type ]['fields'] = $fields;
        $options['dependency'][ $this->type ]['sections'] = $sales_fields['sections'];

        $options['hide'][ $this->type ][ 'fields' ] = [ 'woo_template', 'has_no_edd', 'has_no_woo', 'product_control', 'product_exclude_by', 'product_list', 'category_list', 'exclude_categories', 'exclude_products', 'edd_product_control', 'edd_product_exclude_by', 'edd_product_list', 'edd_category_list', 'edd_exclude_categories', 'edd_exclude_products', 'custom_contents', 'show_custom_image' ];

        return $options;
    }
    public function builder_toggle_fields( $options ) {
        $fields = $this->get_fields();
        unset( $fields[ $this->template ] );

        $fields = array_keys( $fields );
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            $fields[] = 'has_no_cron';
        }

        $options['source_tab']['sections']['config']['fields']['display_type']['dependency'][ $this->type ]['fields'] = $fields;
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
		NotificationX_Cron::set_cron( $post_id, 'nx_envato_interval' );
    }

    public function update_data( $post_id ){
        if ( empty( $post_id ) ) {
            return;
        }
        if( ! $this->check_type( $post_id ) ) {
            return;
        }
        
        $sales = $this->get_sales();
        NotificationX_Admin::update_post_meta( $post_id, $this->meta_key, $sales );
    }

    public function conversion_data( $data, $id ){
        if( ! $id ) {
            return $data;
        }
        $data[ $this->type ] = NotificationX_Admin::get_post_meta( intval( $id ), $this->meta_key, true );
        return $data;
    }

    protected function get_sales(){
        if( empty( $this->_token ) ) {
            return [];
        }
        $request = wp_remote_get(
            'https://api.envato.com/v3/market/author/sales',
            array(
                'headers'     => array(
                    'Authorization' => 'Bearer ' . $this->_token,
                ),
            )
        );

        if( is_wp_error( $request ) ) {
            return [];
        }

        $decoded_body = json_decode( wp_remote_retrieve_body( $request ), true );

        $data_array = $this->temp_data_array = array();

        $needed_key = array(
            'sold_at', 'id', 'name', 'number_of_sales', 'url', 'rating', 'rating_count', 'published_at', 'icon_url' 
        );
        if( ! empty( $decoded_body ) ) {
            foreach( $decoded_body as $single ) {
                if( isset( $single['item']['attributes'] ) ) {
                    unset( $single['item']['attributes'] );
                }
                array_walk_recursive( $single, array( $this, 'walker' ), $needed_key );
                $data_array[] = $this->temp_data_array;
                $this->temp_data_array = [];
            }
        }

        return $data_array;
    }

    private function walker( $value, $key, $needed_key ){
        if( $this->in_array_r( $key, $needed_key, true ) ) {
            if( $key === 'sold_at' ) {
                $value = strtotime( $value );
                $key = 'timestamp';
            }
            if( $key === 'name' ) {
                $key = 'title';
            }
            if( $key === 'url' ) {
                $key = 'link';
            }
            $this->temp_data_array[ $key ] = $value;
        }
    }

    private function in_array_r( $needle, $haystack, $strict = false ){
        foreach( $haystack as $item ) {
            if( ( $strict ? $item === $needle : $item == $needle ) || ( is_array( $item ) && $this->in_array_r( $needle, $item, $strict ) ) ) {
                return true;
            }
        }
        return false;
    }

    /**
     * This method is responsible for saving settings data
     */
    public function save_api() {
        /**
         * Verify the Nonce
         */
        if ( ( ! isset( $_POST['nonce'] ) && ! isset( $_POST['key'] ) ) || ! 
        wp_verify_nonce( $_POST['nonce'], 'nx_'. $_POST['key'] .'_nonce' ) ) {
            return;
        }
        
        if( isset( $_POST['form_data'] ) ) {
            NotificationX_Settings::save_settings( $_POST['form_data'] );
            echo json_encode(array(
                'status' => 'success',
            ));
        }
        die;
    }

    /**
     * For FrontEnd
     *
     * @param array $data
     * @param boolean $settings
     * @param array $args
     * @return void
     */
    public function frontend_html( $data = [], $settings = false, $args = [] ){
        if( ! empty( $this->_token ) ) {
            return parent::frontend_html( $data, $settings, $args );
        }
    }
}