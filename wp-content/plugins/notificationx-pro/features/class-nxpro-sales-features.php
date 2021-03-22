<?php
/**
 * Class NotificationXPro_Sales_Features
 * Handles Pro features for sales notifications
 * @since 1.2.2
 */
class NotificationXPro_Sales_Features {
    /**
     * Woocommerce orders with days count
     * @var array
     */
    private $orders;
    /**
     * EDD payments with days count
     * @var array
     */
    private $edd_payments;
    /**
     * Learndash course enrollments with day counts
     * @var array
     */
    private $ld_enrolls;
    /**
     * Give donations with day counts
     * @var array
     */
    private $give_donations;
    /**
     * contents field meta key
     */
    private $meta_key = '_nx_sales_counts';
    /**
     * Sales count source types
     * @var array
     */
    private $sales_count_sources = [
        'woocommerce',
        'edd',
        'learndash',
        'tutor',
        'give'
    ];
    /**
     * Sales count supported themes
     * @var array
     */
    private $sales_count_themes = [
        'conv-theme-seven',
        'conv-theme-eight',
        'conv-theme-nine'
    ];
    /**
     * NotificationXPro_Sales_Features constructor.
     */
    public function __construct() {
        add_filter( 'nx_cache_settings_sections', array( $this, 'cache_settings' ), 10 );
        add_filter( 'nx_metabox_tabs', array( $this, 'add_fields' ), 20 );

        add_filter( 'nx_fallback_data', array( $this, 'fallback_data' ), 22, 3 );

        add_action( 'save_post', array( $this, 'save_post' ), 10, 3 );

        add_action( 'nx_cron_update_data', array( $this, 'update_data' ), 10, 1 );

        add_filter( 'nx_template_string_generate', array( $this, 'template_string_by_theme'), 999, 3 );

        add_filter( 'nx_fields_data', array( $this, 'conversion_data' ), 10, 2 );

        add_filter( 'nx_template_settings_by_theme', array( $this, 'settings_by_theme' ), 999 );
    }
    /**
     * Template Settings By Theme
     */
    public function settings_by_theme( $data ){
        global $post, $pagenow;
        $save_field = get_post_meta( $post->ID, '_nx_meta_woo_template_new', true );
        $esave_field = get_post_meta( $post->ID, '_nx_meta_elearning_template_new', true );
        $dsave_field = get_post_meta( $post->ID, '_nx_meta_donation_template_new', true );

        if( isset( $data['nx_meta_woo_template_new'] ) ) {
            $data['nx_meta_woo_template_new']['conv-theme-seven'] = array(
                'first_param'  => isset( $save_field['first_param'] ) ? $save_field['first_param'] : 'tag_sales_count',
                'second_param' => isset( $save_field['second_param'] ) ? $save_field['second_param'] : 'people purchased',
                'third_param'  => isset( $save_field['third_param'] ) ? $save_field['third_param'] : 'tag_title',
                'fourth_param' => isset( $save_field['fourth_param'] ) ? $save_field['fourth_param'] :'tag_7days',
            );
            $data['nx_meta_woo_template_new']['conv-theme-eight'] = array(
                'first_param' => isset( $save_field['first_param'] ) ? $save_field['first_param'] :'tag_sales_count',
                'second_param' => isset( $save_field['second_param'] ) ? $save_field['second_param'] :'people purchased',
                'third_param' => isset( $save_field['third_param'] ) ? $save_field['third_param'] :'tag_title',
                'fourth_param' => isset( $save_field['fourth_param'] ) ? $save_field['fourth_param'] :'tag_7days',
            );
            $data['nx_meta_woo_template_new']['conv-theme-nine'] = array(
                'first_param' => isset( $save_field['first_param'] ) ? $save_field['first_param'] :'tag_sales_count',
                'second_param' => isset( $save_field['second_param'] ) ? $save_field['second_param'] :'people purchased',
                'third_param' => isset( $save_field['third_param'] ) ? $save_field['third_param'] :'tag_title',
                'fourth_param' => isset( $save_field['fourth_param'] ) ? $save_field['fourth_param'] :'tag_7days',
            );
        }

        if( isset( $data['nx_meta_elearning_template_new'] ) ) {
            $data['nx_meta_elearning_template_new']['conv-theme-seven'] = array(
                'first_param'  => isset( $esave_field['first_param'] ) ? $esave_field['first_param'] : 'tag_sales_count',
                'second_param' => isset( $esave_field['second_param'] ) ? $esave_field['second_param'] : 'people enrolled',
                'third_param'  => isset( $esave_field['third_param'] ) ? $esave_field['third_param'] : 'tag_title',
                'fourth_param' => isset( $esave_field['fourth_param'] ) ? $esave_field['fourth_param'] :'tag_7days',
            );
            $data['nx_meta_elearning_template_new']['conv-theme-eight'] = array(
                'first_param' => isset( $esave_field['first_param'] ) ? $esave_field['first_param'] :'tag_sales_count',
                'second_param' => isset( $esave_field['second_param'] ) ? $esave_field['second_param'] :'people enrolled',
                'third_param' => isset( $esave_field['third_param'] ) ? $esave_field['third_param'] :'tag_title',
                'fourth_param' => isset( $esave_field['fourth_param'] ) ? $esave_field['fourth_param'] :'tag_7days',
            );
            $data['nx_meta_elearning_template_new']['conv-theme-nine'] = array(
                'first_param' => isset( $esave_field['first_param'] ) ? $esave_field['first_param'] :'tag_sales_count',
                'second_param' => isset( $esave_field['second_param'] ) ? $esave_field['second_param'] :'people enrolled',
                'third_param' => isset( $esave_field['third_param'] ) ? $esave_field['third_param'] :'tag_title',
                'fourth_param' => isset( $esave_field['fourth_param'] ) ? $esave_field['fourth_param'] :'tag_7days',
            );
        }

        if( isset( $data['nx_meta_donation_template_new'] ) ) {
            $data['nx_meta_donation_template_new']['conv-theme-seven'] = array(
                'first_param'  => isset( $dsave_field['first_param'] ) ? $dsave_field['first_param'] : 'tag_sales_count',
                'second_param' => isset( $dsave_field['second_param'] ) ? $dsave_field['second_param'] : 'people donated',
                'third_param'  => isset( $dsave_field['third_param'] ) ? $dsave_field['third_param'] : 'tag_title',
                'fourth_param' => isset( $dsave_field['fourth_param'] ) ? $dsave_field['fourth_param'] :'tag_7days',
            );
            $data['nx_meta_donation_template_new']['conv-theme-eight'] = array(
                'first_param' => isset( $dsave_field['first_param'] ) ? $dsave_field['first_param'] :'tag_sales_count',
                'second_param' => isset( $dsave_field['second_param'] ) ? $dsave_field['second_param'] :'people donated',
                'third_param' => isset( $dsave_field['third_param'] ) ? $dsave_field['third_param'] :'tag_title',
                'fourth_param' => isset( $dsave_field['fourth_param'] ) ? $dsave_field['fourth_param'] :'tag_7days',
            );
            $data['nx_meta_donation_template_new']['conv-theme-nine'] = array(
                'first_param' => isset( $dsave_field['first_param'] ) ? $dsave_field['first_param'] :'tag_sales_count',
                'second_param' => isset( $dsave_field['second_param'] ) ? $dsave_field['second_param'] :'people donated',
                'third_param' => isset( $dsave_field['third_param'] ) ? $dsave_field['third_param'] :'tag_title',
                'fourth_param' => isset( $dsave_field['fourth_param'] ) ? $dsave_field['fourth_param'] :'tag_7days',
            );
        }

        $common_fields = array(
            'first_param' => isset( $save_field['first_param'] ) ? $save_field['first_param'] : 'tag_name',
            'second_param' => isset( $save_field['second_param'] ) ? $save_field['second_param'] : 'just purchased',
            'third_param' => isset( $save_field['third_param'] ) ? $save_field['third_param'] : 'tag_title',
            'fourth_param' => isset( $save_field['fourth_param'] ) ? $save_field['fourth_param'] : 'tag_time',
        );
        $ecommon_fields = array(
            'first_param' => isset( $esave_field['first_param'] ) ? $esave_field['first_param'] : 'tag_name',
            'second_param' => isset( $esave_field['second_param'] ) ? $esave_field['second_param'] : 'just enrolled',
            'third_param' => isset( $esave_field['third_param'] ) ? $esave_field['third_param'] : 'tag_title',
            'fourth_param' => isset( $esave_field['fourth_param'] ) ? $esave_field['fourth_param'] : 'tag_time',
        );
        $dcommon_fields = array(
            'first_param' => isset( $dsave_field['first_param'] ) ? $dsave_field['first_param'] : 'tag_name',
            'second_param' => isset( $dsave_field['second_param'] ) ? $dsave_field['second_param'] : 'recently donated for',
            'third_param' => isset( $dsave_field['third_param'] ) ? $dsave_field['third_param'] : 'tag_title',
            'fourth_param' => isset( $dsave_field['fourth_param'] ) ? $dsave_field['fourth_param'] : 'tag_time',
        );

        if( isset( $data['nx_meta_woo_template_new'] ) ) {
            $data['nx_meta_woo_template_new']['theme-one'] = $common_fields;
            $data['nx_meta_woo_template_new']['theme-two'] = $common_fields;
            $data['nx_meta_woo_template_new']['theme-three'] = $common_fields;
            $data['nx_meta_woo_template_new']['theme-four'] = $common_fields;
            $data['nx_meta_woo_template_new']['theme-five'] = $common_fields;
        }
        if( isset( $data['nx_meta_donation_template_new'] ) ) {
            $data['nx_meta_donation_template_new']['theme-one'] = $dcommon_fields;
            $data['nx_meta_donation_template_new']['theme-two'] = $dcommon_fields;
            $data['nx_meta_donation_template_new']['theme-three'] = $dcommon_fields;
            $data['nx_meta_donation_template_new']['theme-four'] = $dcommon_fields;
            $data['nx_meta_donation_template_new']['theme-five'] = $dcommon_fields;
        }
        if( isset( $data['nx_meta_elearning_template_new'] ) ) {
            $data['nx_meta_elearning_template_new']['theme-one'] = $ecommon_fields;
            $data['nx_meta_elearning_template_new']['theme-two'] = $ecommon_fields;
            $data['nx_meta_elearning_template_new']['theme-three'] = $ecommon_fields;
            $data['nx_meta_elearning_template_new']['theme-four'] = $ecommon_fields;
            $data['nx_meta_elearning_template_new']['theme-five'] = $ecommon_fields;
        }
        return $data;
    }
    /**
     * Cache Settings for Regenerate data
     * @param array $sections
     * @return array
     */
    public function cache_settings( $sections ){
        $sections['cache_settings']['fields']['sales_count_cache_duration'] = array(
            'type' => 'text',
            'label' => __('Sales count Cache Duration', 'notificationx-pro'),
            'description' => __('Minutes (Schedule Duration to fetch new data).', 'notificationx-pro'),
            'default' => 3,
            'priority' => 4
        );
        return $sections;
    }
    /**
     * It will revoke when admin post is saved
     * @param int $post_id
     * @param WP_Post $post
     * @param boolean $update
     */
    public function save_post( $post_id, $post, $update ) {
        if( $post->post_type !== 'notificationx' || ! $update ) {
            return;
        }
        if( $post->post_status === 'trash' ) {
            NotificationX_Cron::clear_schedule( array( 'post_id' => $post_id ) );
            return;
        }
        $settings = NotificationX_MetaBox::get_metabox_settings( $post_id );
        $type     = NotificationX_Helper::get_type( $settings );
        $theme    = NotificationX_Helper::get_theme( $settings );
        if( ! in_array($type, $this->sales_count_sources) ) {
            return;
        }

        $this->update_data( $post_id );
		NotificationX_Cron::set_cron( $post_id, 'nx_sales_count_interval' );
    }
    /**
     * It will revoke when save_post action will fire and nx_cron_data occurs.
     * @param int $post_id
     */
    public function update_data( $post_id ){
        if ( empty( $post_id ) ) {
            return;
        }

        $settings = NotificationX_MetaBox::get_metabox_settings( $post_id );
        $type     = NotificationX_Helper::get_type( $settings );
        $theme    = NotificationX_Helper::get_theme( $settings );

        if( ! in_array($type, $this->sales_count_sources) ) {
            return;
        }
        $results = $this->get_sales_count( $settings);
        NotificationX_Admin::update_post_meta( $post_id, $this->meta_key, $results );
    }
    /**
     * This method is hooked
     * @hooked nx_metabox_tabs
     * @param array $options
     * @return array
     */
    public function add_fields( $options ) {
        $woo_template_new = $options[ 'content_tab' ]['sections']['content_config']['fields'][ 'woo_template_new' ];
        $woo_template_new['fields']['first_param']['options']['tag_sales_count'] = __('Sales Count','notificationx-pro');
        $woo_template_new['fields']['first_param']['hide']['tag_sales_count'] = array(
            'fields' => array( 'custom_first_param' )
        );

        $hide_custom_4th_param = array(
            'fields' => array( 'custom_fourth_param' )
        );

        $woo_template_new['fields']['fourth_param']['hide']['tag_1day'] = $hide_custom_4th_param;
        $woo_template_new['fields']['fourth_param']['hide']['tag_7days'] = $hide_custom_4th_param;
        $woo_template_new['fields']['fourth_param']['hide']['tag_30days'] = $hide_custom_4th_param;

        $woo_template_new['fields']['fourth_param']['options']['tag_1day'] = __('In last 1 day' , 'notificationx-pro');
        $woo_template_new['fields']['fourth_param']['options']['tag_7days'] = __('In last 7 days' , 'notificationx-pro');
        $woo_template_new['fields']['fourth_param']['options']['tag_30days'] = __('In last 30 days' , 'notificationx-pro');

        if( isset( $options[ 'content_tab' ]['sections']['content_config']['fields'][ 'elearning_template_new' ] ) ) {
            $elearning_template_new = $options[ 'content_tab' ]['sections']['content_config']['fields'][ 'elearning_template_new' ];
            $elearning_template_new['fields']['first_param']['options']['tag_sales_count'] = __('Sales Count','notificationx-pro');
            $elearning_template_new['fields']['first_param']['hide']['tag_sales_count'] = array(
                'fields' => array( 'custom_first_param' )
            );

            $elearning_template_new['fields']['fourth_param']['hide']['tag_1day'] = $hide_custom_4th_param;
            $elearning_template_new['fields']['fourth_param']['hide']['tag_7days'] = $hide_custom_4th_param;
            $elearning_template_new['fields']['fourth_param']['hide']['tag_30days'] = $hide_custom_4th_param;

            $elearning_template_new['fields']['fourth_param']['options']['tag_1day'] = __('In last 1 day' , 'notificationx-pro');
            $elearning_template_new['fields']['fourth_param']['options']['tag_7days'] = __('In last 7 days' , 'notificationx-pro');
            $elearning_template_new['fields']['fourth_param']['options']['tag_30days'] = __('In last 30 days' , 'notificationx-pro');

            $options[ 'content_tab' ]['sections']['content_config']['fields'][ 'elearning_template_new' ] = $elearning_template_new;
        }

        if( isset( $options[ 'content_tab' ]['sections']['content_config']['fields'][ 'donation_template_new' ] ) ) {
            $donation_template_new = $options[ 'content_tab' ]['sections']['content_config']['fields'][ 'donation_template_new' ];
            $donation_template_new['fields']['first_param']['options']['tag_sales_count'] = __('Sales Count','notificationx-pro');
            $donation_template_new['fields']['first_param']['hide']['tag_sales_count'] = array(
                'fields' => array( 'custom_first_param' )
            );

            $donation_template_new['fields']['fourth_param']['hide']['tag_1day'] = $hide_custom_4th_param;
            $donation_template_new['fields']['fourth_param']['hide']['tag_7days'] = $hide_custom_4th_param;
            $donation_template_new['fields']['fourth_param']['hide']['tag_30days'] = $hide_custom_4th_param;

            $donation_template_new['fields']['fourth_param']['options']['tag_1day'] = __('In last 1 day' , 'notificationx-pro');
            $donation_template_new['fields']['fourth_param']['options']['tag_7days'] = __('In last 7 days' , 'notificationx-pro');
            $donation_template_new['fields']['fourth_param']['options']['tag_30days'] = __('In last 30 days' , 'notificationx-pro');

            $options[ 'content_tab' ]['sections']['content_config']['fields'][ 'donation_template_new' ] = $donation_template_new;
        }

        $options[ 'content_tab' ]['sections']['content_config']['fields'][ 'woo_template_new' ] = $woo_template_new;

        return $options;
    }
    /**
     * This method is responsible for make data available in frontend
     * @param array $data
     * @param int $id
     * @return array
     */
    public function conversion_data( $data, $id ){
        if( ! $id ) {
            return $data;
        }

        $settings = NotificationX_MetaBox::get_metabox_settings( $id );
        $type     = NotificationX_Helper::get_type( $settings );
        $theme    = NotificationX_Helper::get_theme( $settings );

        if( ! in_array( $type, $this->sales_count_sources ) ) {
            return $data;
        }

        $this->main_array = isset( $data[ $type ] ) ? $data[ $type ] : [];

        $this->meta_array = NotificationX_Admin::get_post_meta( intval( $id ), $this->meta_key, true );
        if( is_array( $this->main_array ) ) {
            $new_array = [];
            array_walk( $this->main_array, function( &$s_array, $key ) use( &$new_array, $type ){
                $s_key = 0;
                if( in_array( $type, array('woocommerce', 'tutor', 'edd'))) {
                    $s_key = isset( $s_array['product_id'] ) ? $s_array['product_id'] : 0;
                }
                if( in_array( $type, array('give'))) {
                    $s_key = isset( $s_array['give_form_id'] ) ? $s_array['give_form_id'] : 0;
                }
                $s_key = $s_key === 0 && isset( $s_array['id'] ) ? $s_array['id'] : $s_key;

                $met = isset( $this->meta_array[ $s_key ] ) ? $this->meta_array[ $s_key ] : [];
                $s_array = array_merge( $s_array, $met);

                $new_array[ $key ] = $s_array;
            } );
        }

        $data[ $type ] = $new_array;

        if( $type === 'custom' ){
            $data[ $type ] = NotificationX_Admin::get_post_meta( intval( $id ), 'type_custom_contents', true );
        }

        return $data;
    }
    /**
     * This method is hooked
     * @hooked nx_fallback_data
     * @param array $data
     * @param array $saved_data
     * @param stdClass $settings
     * @return array
     */
    public function fallback_data( $data, $saved_data, $settings ) {
        $theme = NotificationX_Helper::get_theme( $settings );
        // if( in_array( $theme, $this->sales_count_themes) ) {
            if( isset( $saved_data['sales_count'] ) ) {
                $data['sales_count'] = NotificationX_Helper::nice_number( $saved_data['sales_count'] );
            } else {
                $data['sales_count'] = 0;
            }
            $data['1day']        = __('in last 1 day' , 'notificationx-pro');
            $data['7days']       = __('in last 7 days' , 'notificationx-pro');
            $data['30days']      = __('in last 30 days' , 'notificationx-pro');
        // }
        return $data;
    }
    /**
     * It will revoke when save_post action occurs.
     * @param array $template
     * @param array $old_template
     * @param array $posts_data
     * @return array
     */
    public function template_string_by_theme( $template, $old_template, $posts_data ){
        $theme = NotificationX_Helper::get_theme( $posts_data );
        if(in_array($theme,$this->sales_count_themes)) {
            $template = NotificationX_Helper::regenerate_the_theme( $old_template, array( 'br_before' => [ 'third_param' ] ) );
        }
        return $template;
    }
    /**
     * Get sales count for sales notifications
     * @param stdClass $settings
     * @param array $data
     * @return array|null
     */
    private function get_sales_count( $settings ) {
        $sales_count = null;
        $type     = NotificationX_Helper::get_type( $settings );
        if( $settings->display_type == 'conversions' ) {
            $template_params = get_post_meta( $settings->id, '_nx_meta_woo_template_new', true );
        }
        if( $settings->display_type == 'elearning' ) {
            $template_params = get_post_meta( $settings->id, '_nx_meta_elearning_template_new', true );
        }
        if( $settings->display_type == 'donation' ) {
            $template_params = get_post_meta( $settings->id, '_nx_meta_donation_template_new', true );
        }
        $matches = [];
        preg_match('/[\d]+/', $template_params['fourth_param'], $matches);
        $days = isset( $matches[0] ) ? $matches[0] : '';
        switch ( $type ){
            case 'woocommerce':
                $sales_count = $this->get_wc_product_sales_count( !empty($days) ? (int)$days : 1 );
                break;
            case 'edd':
                $sales_count = $this->get_edd_download_count( !empty($days) ? (int)$days : 1 );
                break;
            case 'learndash':
                $sales_count = $this->get_ld_course_enroll_counts( !empty($days) ? (int)$days : 1 );
                break;
            case 'tutor':
                $sales_count = $this->get_tutor_enroll_counts( ! empty( $days ) ? ( int ) $days : 1 );
                break;
            case 'give':
                $sales_count = $this->get_give_donation_counts( !empty($days) ? (int)$days : 1 );
                break;
        }
        return $sales_count;
    }
    /**
     * Get woocommerce sales count for specific product
     * @param int $product_id
     * @param int $days
     * @return array
     */
    private function get_wc_product_sales_count( $days ) {
        $orders = $this->get_wc_orders( $days );
        $status = ['processing','completed'];
        $counts = [];
        $products_data = [];
        if(!empty($orders['items'])){
            foreach ( $orders['items'] as $order ){
                if( in_array( $order->get_status(), $status ) && $order instanceof WC_Order ) {
                    foreach ( $order->get_items() as $item_id => $item_data ) {
                        $product = $item_data->get_product();
                        if( ! $product instanceof WC_Product ) {
                            continue;
                        }
                        $product_id = $product->get_id();
                        $products_data['title'] = $product->get_title();
                        $products_data[ 'product_id' ] = $product_id;
                        if( isset( $counts[ $product_id ] ) ) {
                            $products_data[ 'sales_count' ] = $counts[ $product_id ][ 'sales_count' ] + $item_data->get_quantity();
                        } else {
                            $products_data[ 'sales_count' ] = $item_data->get_quantity();
                        }
                        $products_data['link'] = get_permalink($product_id);
                        $counts[ $product_id ] = $products_data;
                        $products_data = [];
                    }
                }
            }
        }

        return $counts;
    }
    /**
     * Get all woocommerce orders after specific date
     * @param int $days
     * @return array
     */
    private function get_wc_orders( $days = 7 ) {
        if( ! empty( $this->orders ) ) {
            if( $this->orders['days'] == $days && $this->orders['items'] ) {
                return $this->orders;
            }
        }
        $this->orders['days'] = $days;
        $args = array(
            'limit' => -1,
            'date_created' => '>= '. $this->format_date($days),
        );
        $this->orders['items'] = [];
        if( function_exists( 'wc_get_orders' ) ) {
            $this->orders['items'] = wc_get_orders( $args );
        }
        return $this->orders;
    }
    /**
     * Get edd download counts
     * @param int $days
     * @return array
     */
    private function get_edd_download_count($days) {
        $counts = [];
        $payments = $this->get_edd_payments($days);
        if(!empty($payments['items'])){
            foreach ($payments['items'] as $payment){
                $products_data = [];
                $product = get_post_meta($payment->ID,'_edd_payment_meta',true)['cart_details'][0];
                $products_data['title'] = $product['name'];
                $products_data[ 'product_id' ] = $product['id'];
                if(isset($counts[$product['id']])){
                    $products_data[ 'sales_count' ] = $counts[$product['id']][ 'sales_count' ] + $product['quantity'];
                }else{
                    $products_data[ 'sales_count' ] = $product['quantity'];
                }
                $products_data[ 'link' ] = get_permalink($product['id']);
                $counts[$product['id']] = $products_data;
            }
        }
        return $counts;
    }
    /**
     * Get edd payments
     * @param int $days
     * @return array
     */
    private function get_edd_payments($days) {
        $days = intval( $days );
        if( ! empty( $this->edd_payments ) ) {
            if( $this->edd_payments['days'] == $days && !empty($this->edd_payments['items'])) {
                return $this->edd_payments;
            }
        }
        $this->edd_payments['days'] = $days;
        $args = array(
            'number'    => -1,
            'status'    => array('publish'),
            'date_query'	=> array(
                'after'			=> date( 'Y-m-d', strtotime( $this->format_date($days) ) )
            )
        );
        $this->edd_payments['items'] = [];
        if( function_exists( 'edd_get_payments' ) ) {
            $this->edd_payments['items'] = edd_get_payments( $args );
        }
        return $this->edd_payments;
    }
    /**
     * Get learndash course enrollment counts
     * @param $days
     * @return array
     */
    private function get_ld_course_enroll_counts($days) {
        $counts = [];
        $course_enrollments = $this->get_ld_enrolls($days);
        if(!empty($course_enrollments['items'])){
            foreach ($course_enrollments['items'] as $course_enrollment){
                $products_data = [];
                $products_data['title'] = $course_enrollment->post_title;
                $products_data[ 'product_id' ] = $course_enrollment->post_id;
                if(isset($counts[$course_enrollment->post_id])){
                    $products_data[ 'sales_count' ] = $counts[$course_enrollment->post_id][ 'sales_count' ] + 1;
                }else{
                    $products_data[ 'sales_count' ] = 1;
                }
                $products_data[ 'link' ] = get_permalink($course_enrollment->post_id);
                $counts[$course_enrollment->post_id] = $products_data;
            }
        }
        return $counts;
    }
    /**
     * @param $days
     * @return array
     */
    private function get_ld_enrolls($days) {
        if( ! empty( $this->ld_enrolls ) ) {
            if( $this->ld_enrolls['days'] == $days && !empty($this->ld_enrolls['items'])) {
                return $this->ld_enrolls;
            }
        }
        $this->ld_enrolls['days'] = $days;
        global $wpdb;
        $from = strtotime( date( get_option( 'date_format' ), strtotime( '-' . intval($days) . ' days') ) );

        $query = 'SELECT ld.post_id,ld.activity_started,post.post_title FROM '.$wpdb->prefix.'learndash_user_activity AS ld JOIN '.$wpdb->prefix.'posts as post ON ld.post_id=post.ID WHERE activity_type="access" AND activity_started >'.$from.' ORDER BY activity_started DESC';
        $results = $wpdb->get_results( $query );

        $this->ld_enrolls['items'] = [];
        if( ! empty( $results ) ) {
            $this->ld_enrolls['items'] = $results;
        }

        return $this->ld_enrolls;
    }
    /**
     * Get give donation counts
     * @param int $days
     * @return array
     */
    private function get_give_donation_counts($days) {
        $counts = [];
        $donations = $this->get_give_payments($days);
        if(!empty($donations['items'])){
            foreach ($donations['items'] as $donation){
                if(!empty($donation->form_id)){
                    $products_data = [];
                    $products_data['title'] = $donation->form_title;
                    $products_data[ 'give_form_id' ] = $donation->form_id;
                    $products_data[ 'product_id' ] = $donation->form_id;
                    $products_data['give_page_id'] = $donation->payment_meta['_give_current_page_id'];
                    $products_data[ 'link' ] = $donation->payment_meta['_give_current_url'];
                    if(isset($counts[$donation->form_id])){
                        $products_data[ 'sales_count' ] = $counts[$donation->form_id][ 'sales_count' ] + 1;
                    }else{
                        $products_data[ 'sales_count' ] = 1;
                    }
                    $counts[$donation->form_id] = $products_data;
                }

            }
        }
        return $counts;
    }
    /**
     * @param int $days
     * @return array
     */
    private function get_give_payments($days) {
        if( ! empty( $this->give_donations ) ) {
            if( $this->give_donations['days'] == $days && !empty($this->give_donations['items'])) {
                return $this->give_donations;
            }
        }
        $this->give_donations['days'] = $days;
        $from = date( get_option( 'date_format' ), strtotime( '-' . intval( $days ) . ' days') );
        $args = array(
            'number' => -1,
            'date_query' => array(
                array(
                    'after'     => $from,
                ),
            ),
        );
        $this->give_donations['items'] = [];
        if( class_exists( 'Give_Payments_Query' ) ) {
            $results = new Give_Payments_Query( $args );
            $this->give_donations['items'] = $results->get_payments();
        }
        return $this->give_donations;
    }
    /**
     * Convert days in 'Y-m-d' format for query
     * @param int $days
     * @return false|string
     */
    private function format_date($days) {
        if( $days == 1 ) {
            return date( 'Y-m-d', strtotime( '- 24 Hours' ) );
        } else {
            return date( 'Y-m-d', strtotime( '-' . intval( $days ) . ' days') );
        }
    }
    /**
     * Get learndash course enrollment counts
     * @param $days
     * @return array
     */
    private function get_tutor_enroll_counts($days) {
        if( ! function_exists( 'tutor_lms' ) ) {
            return;
        }
        global $wpdb;
        $counts = [];
        $from = date_i18n( 'Y-m-d H:i:s', strtotime( '-' . intval( $days ) . ' days', strtotime( date_i18n( 'Y-m-d H:i:s' ) ) ), true );
        $enrolments = $wpdb->get_results("SELECT
                enrol.ID as enrol_id,
                COUNT( enrol.ID ) as counts,
                enrol.post_author as student_id,
                enrol.post_date as enrol_date,
                enrol.post_title as enrol_title,
                enrol.post_status as status,
                enrol.post_parent as course_id,
                course.post_title as course_title,
                student.user_nicename,
                student.user_email,
                student.display_name
                FROM {$wpdb->posts} enrol
                INNER JOIN {$wpdb->posts} course ON enrol.post_parent = course.ID
                INNER JOIN {$wpdb->users} student ON enrol.post_author = student.ID
                WHERE enrol.post_type = 'tutor_enrolled' AND enrol.post_date > '$from' AND enrol.post_status IN ( 'completed', 'processing' )
                GROUP BY course_id
                ORDER BY enrol_date DESC" );
        if( ! empty( $enrolments ) ) {
            foreach( $enrolments as $course_enrollment ) {
                $products_data = [];
                $products_data[ 'product_id' ] = $course_enrollment->course_id;
                $products_data[ 'sales_count' ] = $course_enrollment->counts;
                $counts[ $course_enrollment->course_id ] = $products_data;
            }
        }
        return $counts;
    }
}