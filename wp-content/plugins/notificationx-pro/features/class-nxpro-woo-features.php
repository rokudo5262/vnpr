<?php

class NotificationXPro_WooFeatures {

    private $plugin_name;
    private $version;
    public static $categories;
    public static $products;

    public function __construct( $plugin_name, $version ){

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        if( class_exists( 'WooCommerce' ) ) {
            self::categories();
            self::products();
        }

        add_filter( 'nx_filtered_data', array( $this, 'show_purchaseof' ), 10, 2 );
        add_filter( 'nx_filtered_data', array( $this, 'excludes_product' ), 10, 2 );
        add_action( 'nx_before_metabox_load', array( $this, 'before_metabox_loaded' ) );
    }

    public function before_metabox_loaded(){
        // if( class_exists( 'WooCommerce' ) ) {
        //     self::categories();
        //     self::products();
        // }

        add_action( 'nx_metabox_tabs', array( $this, 'product_control' ), 100 );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide_fields' ) );
        add_filter( 'nx_conversion_from', array( $this, 'hide_fields_by_from' ) );
        add_filter( 'nx_conversion_from', array( $this, 'toggle_fields' ), 11 );
    }

    private function fields(){
        $fields = array();
        $fields['woo_template'] = array(
            'type'     => 'template',
            'priority' => 92,
            'defaults' => [
                __('{{name}} recently purchased', 'notificationx-pro'), '{{title}}', '{{time}}'
            ],
            'variables' => [
                '{{name}}', '{{first_name}}', '{{last_name}}', '{{title}}', '{{time}}'
            ],
        );

        $fields['combine_multiorder_text'] = array(
            'label'    => __('Combine Multi Order Text', 'notificationx-pro'),
            'type'     => 'text',
            'priority' => 91,
            'default' => __('more products', 'notificationx-pro'),
        );

        $fields['product_control'] = array(
            'label'      => __('Show Purchase Of', 'notificationx-pro'),
            'type'       => 'select',
            'priority'   => 93,
            'options'    => self::options(),
            'dependency' => array(
                'product_category' => array(
                    'fields' => array( 'category_list' )
                ),
                'manual_selection' => array(
                    'fields' => array( 'product_list' )
                ),
            )
        );

        $fields['category_list'] = array(
            'label'    => __('Select Product Category', 'notificationx-pro'),
            'type'     => 'select',
            'multiple' => true,
            'priority' => 95,
            'options'  => self::$categories
        );

        $fields['product_list'] = array(
            'label'    => __('Select Product', 'notificationx-pro'),
            'type'     => 'select',
            'multiple' => true,
            'priority' => 96,
            'options'  => self::$products,
        );

        $fields['product_exclude_by'] = array(
            'label'      => __('Exclude By', 'notificationx-pro'),
            'type'       => 'select',
            'priority'   => 97,
            'options'    => self::exclude_by(),
            'dependency' => array(
                'product_category' => array(
                    'fields' => array( 'exclude_categories' )
                ),
                'manual_selection' => array(
                    'fields' => array( 'exclude_products' )
                ),
            )
        );

        $fields['exclude_categories'] = array(
            'label'    => __('Select Product Category', 'notificationx-pro'),
            'type'     => 'select',
            'multiple' => true,
            'priority' => 98,
            'options'  => self::$categories
        );
        $fields['exclude_products'] = array(
            'label'    => __('Select Product', 'notificationx-pro'),
            'type'     => 'select',
            'multiple' => true,
            'priority' => 99,
            'options'  => self::$products,
        );

        return $fields;
    }

    public function product_control( $options ){
        $fields = $this->fields();

        foreach ( $fields as $name => $field ) {
            $options[ 'content_tab' ]['sections']['content_config']['fields'][ $name ] = $field;
        }

        $options['content_tab']['sections']['content_config']['fields']['combine_multiorder']['description'] = __('Combine order like, 2 more products.', 'notificationx-pro');

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
            $options[ 'hide' ]['edd'][ 'fields' ][] = "$name";
            $options[ 'hide' ]['custom_notification'][ 'fields' ][] = "$name";
        }

        return $options;
    }

    public function toggle_fields( $options ){
        $options['dependency'][ 'woocommerce' ]['fields'] = array_merge( [ 'product_control', 'product_exclude_by' ], $options['dependency'][ 'woocommerce' ]['fields']);
        return $options;
    }

    public static function options(){
        return array(
            'none'             => __('All', 'notificationx-pro'),
            'product_category' => __('Product Category', 'notificationx-pro'),
            'manual_selection' => __('Selected Product', 'notificationx-pro'),
        );
    }

    public static function exclude_by(){
        return array(
            'none'             => __('None', 'notificationx-pro'),
            'product_category' => __('Product Category', 'notificationx-pro'),
            'manual_selection' => __('Selected Product', 'notificationx-pro'),
        );
    }

    public static function categories(){

        $product_categories = get_terms(array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
        ));

        $category_list = [];

        if( ! is_wp_error( $product_categories ) ) {
            foreach( $product_categories as $product ) {
                $category_list[ $product->slug ] = $product->name;
            }
        }

        self::$categories = $category_list;
    }

    public static function products(){
        $products = get_posts(array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'numberposts' => -1,
        ));
        $product_list = [];

        if( ! empty( $products ) ) {
            foreach( $products as $product ) {
                $product_list[ $product->ID ] = $product->post_title;
            }
        }
        wp_reset_postdata();
        self::$products = $product_list;
    }

    public function excludes_product( $data, $settings ){
        if( $settings->display_type != 'conversions' ) {
            return $data;
        }
        if( $settings->conversion_from != 'woocommerce' ) {
            return $data;
        }
        if( empty( $settings->product_exclude_by ) || $settings->product_exclude_by === 'none' ) {
            return $data;
        }

        $product_category_list = $new_data = [];

        if( ! empty( $data ) ) {
            foreach( $data as $key => $product ) {
                $product_id = $product['product_id'];
                if( $settings->product_exclude_by == 'product_category' ) {
                    $product_categories = get_the_terms( $product_id, 'product_cat' );
                    if( ! is_wp_error( $product_categories ) ) {
                        foreach( $product_categories as $category ) {
                            $product_category_list[] = $category->slug;
                        }
                    }

                    $product_category_count = count( $product_category_list );
                    $array_diff = array_diff( $product_category_list, $settings->exclude_categories );
                    $array_diff_count = count( $array_diff );

                    if( ! ( $array_diff_count < $product_category_count ) ) {
                        $new_data[ $key ] = $product;
                    }
                    $product_category_list = [];
                }
                if( $settings->product_exclude_by == 'manual_selection' ) {
                    if( ! in_array( $product_id, $settings->exclude_products ) ) {
                        $new_data[ $key ] = $product;
                    }
                }
            }
        }

        return $new_data;

    }

    public function show_purchaseof( $data, $settings ){
        if( $settings->display_type != 'conversions' ) {
            return $data;
        }
        if( $settings->conversion_from != 'woocommerce' ) {
            return $data;
        }
        if( empty( $settings->product_control ) || $settings->product_control === 'none' ) {
            return $data;
        }

        $product_category_list = $new_data = [];

        if( ! empty( $data ) ) {
            foreach( $data as $key => $product ) {
                $product_id = $product['product_id'];
                if( $settings->product_control == 'product_category' ) {
                    $product_categories = get_the_terms( $product_id, 'product_cat' );
                    if( ! is_wp_error( $product_categories ) ) {
                        foreach( $product_categories as $category ) {
                            $product_category_list[] = $category->slug;
                        }
                    }

                    $product_category_count = count( $product_category_list );
                    $array_diff = array_diff( $settings->category_list, $product_category_list );
                    $array_diff_count = count( $array_diff );
                    $cute_logic = ( count( $settings->category_list ) - ( $product_category_count +  $array_diff_count) );

                    if( ! $cute_logic ) {
                        $new_data[ $key ] = $product;
                    }
                    $product_category_list = [];
                }
                if( $settings->product_control == 'manual_selection' ) {
                    if( in_array( $product_id, $settings->product_list ) ) {
                        $new_data[ $key ] = $product;
                    }
                }
            }
        }
        return $new_data;
    }

}

