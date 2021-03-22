<?php 
/**
 * This class is responsible for making stats for each NotificationX
 * 
 * @since 1.0.2
 */
class NotificationXPro_Analytics {
    /**
     * Get a single Instance of Analytics
     * @var NotificationXPro_Analytics
     */
    private static $_instance = null;
    /**
     * List of NotificationX
     * @var arrau
     */
    private static $notificationx = array();
    private $impressions = [];
    private $results = null;
    /**
     * Colors for Bar
     */
    private $colors = array(
        '#1abc9c',
        '#27ae60',
        '#3498db',
        '#8e44ad',
        '#e67e22',
        '#e74c3c',
        '#f39c12',
        '#34495e',
        '#9b59b6',
        '#16a085'
    );

    private $nx_reporting = null;

    public function __construct() {
        add_action( 'admin_init', array( $this, 'notificationx' ) );
        add_action( 'notificationx_after_analytics_header', array( $this, 'analytics_display_pro' ), 12 );
        add_action( 'wp_ajax_nx_analytics_calc', array( $this, 'analytics_calc' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueues' ) );       
        add_filter( 'nx_email_analytics_reporting_sections', array( $this, 'reporting_settings' ) );
        $this->nx_reporting = NotificationX_Report_Email::get_instance();
        if( isset( $this->nx_reporting->settings['disable_reporting'] ) && ! $this->nx_reporting->settings['disable_reporting'] ) {
            add_action('admin_init', array( $this, 'set_reporting_event' ));
            add_action('monthly_email_reporting', array( $this, 'send_email_monthly' ));
            add_action('daily_email_reporting', array( $this, 'send_email_daily' ));
        }
    }


    public function send_email_monthly(){
        return $this->nx_reporting->send_email_weekly( 'nx_monthly' );
    }
    public function send_email_daily(){
        return $this->nx_reporting->send_email_weekly( 'nx_daily' );
    }

    public function reporting_settings( $options ){
        unset( $options['email_reporting']['fields']['reporting_frequency']['disable'] );
        unset( $options['email_reporting']['fields']['reporting_subject']['disable'] );
        return $options;
    }

    public function set_reporting_event(){
        if( isset( $this->nx_reporting->settings['enable_analytics'] ) && ! $this->nx_reporting->settings['enable_analytics'] ) {
            return;
        }

        if( $this->nx_reporting->reporting_frequency() === 'nx_daily' ) {
            $datetime = strtotime( "+1days 9AM" );
            $this->nx_reporting->mail_report_deactivation( 'weekly_email_reporting' );
            $this->nx_reporting->mail_report_deactivation( 'monthly_email_reporting' );
            if ( ! wp_next_scheduled ( 'daily_email_reporting' ) ) {
                wp_schedule_event( $datetime, $this->nx_reporting->reporting_frequency(), 'daily_email_reporting' );
            }
        }
        if( $this->nx_reporting->reporting_frequency() === 'nx_monthly' ) {
            $datetime = strtotime( "first day of next month 9AM" );
            $this->nx_reporting->mail_report_deactivation( 'daily_email_reporting' );
            $this->nx_reporting->mail_report_deactivation( 'weekly_email_reporting' );
            if ( ! wp_next_scheduled ( 'monthly_email_reporting' ) ) {
                wp_schedule_event( $datetime, $this->nx_reporting->reporting_frequency(), 'monthly_email_reporting' );
            }
        }
    }

    /**
     * Get || Making a Single Instance of Analytics
     * @return self
     */
    public static function get_instance(){
        if( self::$_instance === null ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public static function notificationx(){
        $notificationx = new WP_Query(array(
            'post_type'      => 'notificationx',
            'posts_per_page' => -1,
        ));

        return self::$notificationx = $notificationx->posts;
    }
    /**
     * This method is responsible for adding analytics Pro table in frontend.
     * @return void
     */
    public function analytics_display_pro(){   
            
        $comparison_factor_list = array(
            'views' => 'Views',
            'clicks' => 'Clicks',
            'ctr' => 'CTR',
        );

        if( file_exists( NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'admin/reports/nxpro-admin-analytics-display.php' ) ) {
            return include_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'admin/reports/nxpro-admin-analytics-display.php';
        }
    }

    private function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    private function random_color( $index = '' ) {
        if( ! empty( $index ) ) {
            if( isset( $this->colors[ $index ] ) ) {
                return $this->colors[ $index ];
            } else {
                return '#' . $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
            }
        }
    }

    protected function labels( $query_vars = array() ){
        $current_date = date('d-m-Y', current_time('timestamp'));
        $start_date = date('d-m-Y', strtotime( $current_date . ' -7days' ));
        if( isset( $query_vars['start_date'] ) && ! empty( $query_vars['start_date'] ) ) {
            $start_date = $query_vars['start_date'];
        }

        if( isset( $query_vars['end_date'] ) && ! empty( $query_vars['end_date'] ) ) {
            $current_date = $query_vars['end_date'];
        }

        $dates = array();
        $start_date_diff = new DateTime( $start_date );
        $current_date_diff = new DateTime( $current_date );
        $diff = $current_date_diff->diff($start_date_diff);
        $counter = isset( $diff->days ) ? $diff->days : 0;
        for( $i = 0; $i <= $counter; $i++ ) {
            $date = $i === 0 ? $start_date : $start_date . " +$i days";
            $dates[] = date( 'M d', strtotime( $date ) );
        }

        $this->dates = $dates;

        return $dates;
    }

    protected function datasets( $query_vars = array() ){
        global $wpdb;

        $ids = $nx_all = $nx_all_separate = false;
        $extra_sql_input = $extra_sql = $xTra_SQL = '';
        if( ! isset( $query_vars['notificationx'] ) ) {
            $ids = true;
            $nx_all = true;
        }


        if( isset( $query_vars['notificationx'] ) ) {
            $notificationx = trim($query_vars['notificationx']);
            if( strpos( $notificationx, 'all' ) === false ) {
                $ids = false;
            } else {
                $ids = true;
                if( strpos( $notificationx, 'all_separate' ) === 0 ) { 
                    $nx_all_separate = true;
                } else {
                    $nx_all = true;
                }
            }
        }

        if( ! $ids ) {
            $extra_sql_input = $notificationx;
            $extra_sql = "AND POSTS.ID IN ( $extra_sql_input )";
            $xTra_SQL = "WHERE D_POSTS.ID IN ( $extra_sql_input )";
        }
        // $inner_sql = "SELECT DISTINCT INNER_POSTS.ID, INNER_POSTS.post_title FROM $wpdb->posts AS INNER_POSTS INNER JOIN $wpdb->postmeta AS INNER_META ON INNER_POSTS.ID = INNER_META.post_id WHERE INNER_POSTS.post_type = '%s'";

        $sql = "SELECT D_POSTS.ID, D_POSTS.post_title, FEELINGS_IMPRESSIONS.meta_key, FEELINGS_IMPRESSIONS.meta_value  FROM ( SELECT POSTS.ID, POSTS.post_title, META.meta_key, META.meta_value FROM $wpdb->posts AS POSTS LEFT JOIN $wpdb->postmeta AS META ON ( POSTS.ID = META.post_id ) WHERE 1 = 1 AND ( META.meta_key = %s OR META.meta_key = %s ) AND POSTS.post_type = %s AND ( ( POSTS.post_status = %s ) ) ) AS FEELINGS_IMPRESSIONS RIGHT JOIN $wpdb->posts AS D_POSTS ON ( FEELINGS_IMPRESSIONS.ID = D_POSTS.ID ) $xTra_SQL";

        $query = $wpdb->prepare(
            $sql,
            array(
                '',
                '_nx_meta_impression_per_day',
                'notificationx',
                'publish'
            )
        );
        $results = $wpdb->get_results( $query, ARRAY_A );

        $default_value = array(
            "fill" => false,
        );

        $datasets = $views = $data = $impressions = $comaprison_factor = $available_data = array();
        $impressions = $this->impressions['views'] = $this->impressions[ 'ctr' ] = $this->impressions['clicks'] = $clicks = $ctr = $default_factor_data = array_fill_keys( $this->dates, 0 );

        if( isset( $query_vars['comparison_factor'] ) && ! empty( $query_vars['comparison_factor'] ) && $query_vars['comparison_factor'] != null ) {
            if( strpos( $query_vars['comparison_factor'], ',' ) !== false && strpos( $query_vars['comparison_factor'], ',' ) >= 0 ) {
                $comaprison_factor = explode( ',', $query_vars['comparison_factor'] );
            } else {
                if( $query_vars['comparison_factor'] != 'undefined' ) {
                    $comaprison_factor = [ $query_vars['comparison_factor'] ];
                }
            }
        }

        if( empty( $comaprison_factor ) ) {
            $comaprison_factor = array( 'views' );
        }
        $number_of_impressions = $number_of_clicks = $number_of_ctr = $max_stepped_size = 0;

        if( ! empty( $results ) ) {
            $index = 0;

            if( ! $nx_all ) {
                foreach( $results as $value ) {
                    if( ! isset( $value['meta_key'] ) || ( isset( $value['meta_key'] ) && $value['meta_key'] !== '_nx_meta_impression_per_day' ) || ! isset(  $value['meta_value'] ) ) {
                        continue;
                    }
                    $unserialize = unserialize( $value['meta_value'] );
                    if( ! $unserialize ) {
                        continue;
                    }
                    if( ! empty( $unserialize ) ) {
                        foreach( $unserialize as $date => $single ) {
                            $temp_date = date('M d', strtotime( $date ));
                            if( isset( $impressions[ $temp_date ] ) ) {
                                $impressions[ $temp_date ] = $number_of_impressions = isset( $single['impressions'] ) ? $single['impressions'] : 0;
                            }
                            if( in_array( 'views', $comaprison_factor ) ) {
                                $available_data[ 'views' ] = $impressions;
                                if( $max_stepped_size < $number_of_impressions ) {
                                    $max_stepped_size = $number_of_impressions;
                                }
                            }
                            if( isset( $clicks[ $temp_date ] ) ) {
                                $clicks[ $temp_date ] = $number_of_clicks = isset( $single['clicks'] ) ? $single['clicks'] : 0;
                            }
                            if( in_array( 'clicks', $comaprison_factor ) ) { 
                                $available_data[ 'clicks' ] = $clicks;
                                if( $max_stepped_size < $number_of_clicks ) {
                                    $max_stepped_size = $number_of_clicks;
                                }
                            }
                            if( isset( $ctr[ $temp_date ] ) ) {
                                $ctr[ $temp_date ] = $number_of_ctr = $number_of_impressions > 0 ? number_format( ( intval( $number_of_clicks ) / intval( $number_of_impressions ) ) * 100, 2) : 0;
                            }
                            if( in_array( 'ctr', $comaprison_factor ) ) { 
                                $available_data[ 'ctr' ] = $ctr;
                                if( $max_stepped_size < $number_of_ctr ) {
                                    $max_stepped_size = $number_of_ctr;
                                }
                            }
    
                            $number_of_impressions = $number_of_clicks = $number_of_ctr = 0; 
                        }
                        $impressions = $clicks = $ctr = $default_factor_data;
                    }  else {
                        foreach( $comaprison_factor as $cFactor ) {
                            $available_data[ $cFactor ] = $default_factor_data;
                        }
                    }
                    if( $available_data ) {
                        foreach( $available_data as $factor => $factor_data ){
                            $data['data'] = array_values( $factor_data );
                            $data = array_merge( $default_value, $data );
                            $color = $this->random_color( ++$index );
                            $data['backgroundColor'] = $color;
                            $data['borderColor'] = $color;
                            $factor_label = $factor == 'ctr' ? 'CTR' : ucwords( $factor );
                            $data['label'] = $value['post_title'] . ' - ' . $factor_label;
                            $data['labelString'] = 'Impressions';
                            $this->results[ $value['ID'] . '_' . $factor ] = $data;
                            $this->results[ 'stepped_size' ] = $max_stepped_size;
    
                            // $views[ $value->ID . '_' . $factor ] = $data;
                            // $views[ 'stepped_size' ] = $max_stepped_size;
                        }
                    }
                }
            }
            // FOR ALL VIEWS, FEELINGS
            if( $nx_all ) {
                array_walk_recursive( $results, function( $value, $key, $userdata ) use( $number_of_clicks, $number_of_ctr, $number_of_impressions, $max_stepped_size ) {
                    if( $key === 'meta_value' ) {
                        $unserialize = unserialize( $value );
                        if( is_array( $unserialize ) ) {
                            array_walk( $unserialize, function( $value, $date, $userdata ) use( $number_of_clicks, $number_of_ctr, $number_of_impressions, $max_stepped_size ) {
                                $temp_date = date('M d', strtotime( $date ));
                                $comaprison_factor = $userdata[ 'comaprison_factor' ];
                                if( in_array( 'views', $comaprison_factor ) ) {
                                    if( isset( $this->impressions['views'][ $temp_date ] ) ) {
                                        $this->impressions['views'][ $temp_date ] += isset( $value['impressions'] ) ? $value['impressions'] : 0;
                                        $number_of_impressions = $this->impressions['views'][ $temp_date ];
                                    }
                                }
                                if( in_array( 'clicks', $comaprison_factor ) ) { 
                                    if( isset( $this->impressions[ 'clicks' ][ $temp_date ] ) ) {
                                        $this->impressions['clicks'][ $temp_date ] += isset( $value['clicks'] ) ? $value['clicks'] : 0;
                                        $number_of_clicks = $this->impressions['clicks'][ $temp_date ];
                                    }
                                    if( $max_stepped_size < $number_of_clicks ) {
                                        $max_stepped_size = $number_of_clicks;
                                    }
                                }
                                if( in_array( 'ctr', $comaprison_factor ) ) { 
                                    if( isset( $this->impressions[ 'clicks' ][ $temp_date ] ) ) {
                                        $number_of_ctr = $number_of_impressions > 0 ? 
                                            number_format( ( intval( $number_of_clicks ) / intval( $number_of_impressions ) ) * 100, 2) : 0;
                                            $this->impressions[ 'ctr' ][ $temp_date ] = $number_of_ctr;
                                        }
                                    if( $max_stepped_size < $number_of_ctr ) {
                                        $max_stepped_size = $number_of_ctr;
                                    }
                                }
                                $number_of_impressions = $number_of_clicks = $number_of_ctr = 0;
                            }, $userdata );
                        }
                    }
                }, array( 'comaprison_factor' => $comaprison_factor ) );
                $data = [];
                foreach( $this->impressions as $factor => $single_factor_data ){
                    if( ! in_array( $factor, $comaprison_factor ) ) {
                        unset( $this->impressions [ $factor ] );
                        continue;
                    }
                    foreach( $single_factor_data as $single ){
                        if( $max_stepped_size < $single ) {
                            $max_stepped_size = $single;
                        }
                    }
                }
                // FIXME: need to check lower php version
                $max_stepped_size = round( $max_stepped_size,  -( strlen( $max_stepped_size ) - 1 ) );

                foreach( $this->impressions as $factor => $factor_data ){
                    $data['data'] = array_values( $factor_data );
                    $data = array_merge( $default_value, $data );
                    $color = $this->random_color( ++$index );
                    $data['backgroundColor'] = $color;
                    $data['borderColor'] = $color;
                    $factor_label = $factor === 'ctr' ? 'CTR' : ucwords( $factor );
                    $data['labelString'] = 'Impressions';
                    $data['label'] =  $factor_label;
                    $this->results[ $factor ] = $data;
                    $this->results[ 'stepped_size' ] = $max_stepped_size;
                    // $views[ $factor ] = $data;
                    // $views[ 'stepped_size' ] = $max_stepped_size;
                }
                $this->impressions = [];
            }

            return $this->results;
        }
        return array();
    }

    public function enqueues( $hook ) {
        if( $hook !== 'notificationx_page_nx-analytics' ) {
            return;
        }
        wp_enqueue_style(
			'notificationx-select2', 
			NOTIFICATIONX_ADMIN_URL . 'assets/css/select2.min.css', 
			array(), '1.0.1', 'all' 
		);
        wp_enqueue_style( 
			'notificationx-chart', 
			NOTIFICATIONX_ADMIN_URL . 'assets/css/Chart.css', 
			array(), '1.0.1', 'all' 
        );
        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_script( 
			'notificationx-select2', 
			NOTIFICATIONX_ADMIN_URL . 'assets/js/select2.min.js', 
			array( 'jquery' ), '1.0.1', true 
		);
		wp_enqueue_script( 
			'chartjs', 
			NOTIFICATIONX_ADMIN_URL . 'assets/js/Chart.min.js', 
			array( 'jquery' ), '1.0.1', true 
		);
		wp_enqueue_script( 
			'notificationx-analytics', 
			NOTIFICATIONX_ADMIN_URL . 'assets/js/nx-analytics.js', 
			array( 'jquery', 'jquery-ui-datepicker', 'chartjs' ), '1.0.1', true 
        );
    }

    public function analytics_calc(){
        if ( empty( $_POST ) || ! check_admin_referer( '_nx_analytics_nonce', 'nonce' ) ) {
            return;
        }
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], '_nx_analytics_nonce' ) ) {
            return;
        }

        $dates = $this->labels( $_POST['query_vars'] );
        $datasets = $this->datasets( $_POST['query_vars'] );

        echo json_encode( array(
            'labels'   => $dates,
            'datasets' => $datasets,
        ));

        wp_die();
    }
}

NotificationXPro_Analytics::get_instance();