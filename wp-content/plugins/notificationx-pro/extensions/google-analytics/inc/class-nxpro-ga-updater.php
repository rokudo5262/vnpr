<?php
/**
 * Insert or update new analytics data
 */
class NotificationXPro_Google_Analytics_Updater{
    /**
     * meta key for saving google analytics data in the notificationx post
     * @var string
     */
    private $meta_key = 'google_analytics_data';

    /**
     * post that need to update
     * @var object
     */
    private $post;

    /**
     * notificationx post settings
     * @var object
     */
    private $notification_settings;

    /**
     * post that need to update
     * @var object
     */
    private $global_settings;

    /**
     * saved data
     * @var object
     */
    private $saved_data;

    /**
     * google api token
     * @var array
     */
    private $token = array();

    /**
     * NotificationXPro_Google_Analytics_Updater constructor.
     * @param $args
     */
    public function __construct($args)
    {
        $this->post = (object) $args['post'];
        $this->notification_settings = (object) $args['notification_settings'];
        $this->global_settings = $args['global_settings'];
        $this->saved_data = $args['saved_data'];
        $this->update();
    }

    /**
     * Perform Inset or update process
     * @return void
     */
    public function update()
    {
        NotificationXPro_Helper::write_log('Update google analytics started at - ' . current_time('Y-m-d h:ia'));
        if (!empty($this->notification_settings) && empty($this->notification_settings->id)) {
            NotificationXPro_Helper::write_log('Update google analytics stopped, Notification id empty');
            return;
        }
        if (empty($this->post)) {
            NotificationXPro_Helper::write_log('Update google analytics stopped, post empty');
            return;
        }
        $site_url = get_bloginfo('url');
        $site_title = get_bloginfo('title');
        $saved_template_meta = $this->unserialize($this->notification_settings->page_analytics_template_new);

        $report_type = $this->get_report_type($saved_template_meta);

        $report = $this->get_data($saved_template_meta, $this->global_settings);
        $this->saved_data[$report_type] = array(
            'id' => 'google_' . $report_type,
            'title' => $site_title,
            'link' => $site_url,
            'last_updated' => current_time('Y-m-d \a\t h:ia'),
            'count' => isset( $saved_template_meta['fifth_param'] ) ? $saved_template_meta['fifth_param'] : 7,
            'type' => $report_type
        );
        if(!empty($report)){
            $this->saved_data[$report_type]['views'] = $report[$report_type];
        }else{
            $this->saved_data[$report_type]['views'] = 1;
        }
        NotificationX_Admin::update_post_meta($this->notification_settings->id, $this->meta_key, $this->saved_data);
        NotificationXPro_Helper::write_log('Update google analytics end at - ' . current_time('Y-m-d h:ia'));
    }

    /**
     * Get analytics data for specific pages
     * @param array $saved_template_meta
     * @param array $pages
     * @return array|bool|void
     */
    private function get_data($saved_template_meta, $global_settings, $pages = array())
    {
        $data = null;
        $duration = isset( $saved_template_meta['fifth_param'] ) ? $saved_template_meta['fifth_param'] : 7;
        $duration_param = isset( $saved_template_meta['sixth_param'] ) ? $saved_template_meta['sixth_param'] : 'tag_day';
        $client = $this->client();
        if (!$client) {
            return;
        }
        $report_type = $this->get_report_type($saved_template_meta);
        $report_args = array(
            'view_id' => (string)$global_settings['ga_profile'],
            'pages' => $pages
        );
        if ($report_type == 'siteview') {
            $report_args['date_range'] = $this->format_date_range($duration, $duration_param);
            $data = $this->get_siteview_data($client, $report_args);
        }
        if ($report_type == 'realtime_siteview') {
            $data = $this->get_realtime_siteview_data($client, $report_args);

        }
        return $data;
    }

    /**
     * Google client instance
     * @return NxPro_Google_Client|bool
     */
    private function client()
    {
        $nx_google_client =  NotificationXPro_Google_Client::getInstance();
        $client = $nx_google_client->getClient();
        $token = $this->get_token();
        if (null == $client->getAccessToken()) {
            if (empty($token)) {
                NotificationXPro_Helper::write_log('Token not found in DB. Account connected but refresh token is removed from db. In: ' . __FILE__ . ', at line ' . __LINE__);
                return false;
            }
            $nx_google_client->setAccessToken($token);
        }
        return $client;
    }

    /**
     * Set date range for get page view data
     * @param string|int $duration
     * @param string $duration_param
     * @return array
     */
    private function format_date_range($duration, $duration_param)
    {
        $duration = intval($duration);
        switch ($duration_param) {
            case 'tag_year':
                $duration_param_string = 'years';
                break;
            case 'tag_month':
                $duration_param_string = 'months';
                break;
            default:
                $duration_param_string = 'days';
                $duration = $duration - 1;
                break;
        }
        return array(
            'start' => date('Y-m-d', strtotime('-' . intval($duration) . ' ' . $duration_param_string)),
            'end' => date('Y-m-d')
        );
    }

    /**
     * Get total siteview data
     * @param NxPro_Google_Client $client
     * @param array $report_args
     * @return array|bool
     */
    private function get_siteview_data($client, $report_args)
    {
        try {
            $results = $this->get_siteview_reports($client, (object)$report_args);
            if (!empty($results)) {
                if(!empty($results->reports[0])){
                    $rows = $results->reports[0]->getData()->getRows();
                    if(!empty($rows[0])){
                        $metrics = $rows[0]->getMetrics();
                        if(!empty($metrics[0])){
                            $values = $metrics[0]->getValues();
                            if(!empty($values[0])){
                                return array(
                                    'siteview' => $values[0]
                                );
                            }
                        }
                    }
                }
                return false;
            }else {
                NotificationXPro_Helper::write_log([
                    'error' => 'No data found for current profile or page',
                    'query_profile' => $report_args['view_id'],
                    'query_pages' => $report_args['pages']
                ]);
                return false;
            }
        } catch (\Exception $e) {
            NotificationXPro_Helper::write_log('Error in get report. ' . $e->getMessage() . ', at line ' . $e->getLine());
            return false;
        }
    }

    /**
     * Get realtime active users in all site
     * @param NxPro_Google_Client $client
     * @param array $args
     * @return array|bool|void
     */
    private function get_realtime_siteview_data($client, $args)
    {
        try {
            $analytics = new NxPro_Google_Service_Analytics($client);
            $realtime_users = $analytics->data_realtime->get('ga:' . $args['view_id'], 'rt:activeUsers');
            $rows = $realtime_users->getRows();
            if (!empty($rows)) {
                $realtime_data = $rows[0];
                if(!empty($realtime_data)){
                    return array(
                        'realtime_siteview' => $realtime_data[0]
                    );
                }
            }
            return false;
        } catch (\Exception $e) {
            NotificationXPro_Helper::write_log('Get realtime siteview failed. Google error: ' . $e->getMessage() . ' , Trace: ' . $e->getTrace());
            return false;
        }
    }

    /**
     * @param NxPro_Google_Client $client
     * @param object $args
     * @return NxPro_Google_Service_AnalyticsReporting_GetReportsResponse
     * @throws Exception
     */
    private function get_siteview_reports($client, $args)
    {
        $metrics = array();
        $analytics = new NxPro_Google_Service_AnalyticsReporting($client);
        $view_id = (string)$args->view_id;
        if (empty($view_id)) {
            throw new \Exception('View id is empty, required view id for report');
        }
        if (empty($args->date_range)) {
            throw new \Exception('Date range is required for analytics report');
        }

        // Create the DateRange object.
        $dateRange = new NxPro_Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($args->date_range['start']);
        $dateRange->setEndDate($args->date_range['end']);
        // Create the metrics object.
        foreach ($this->get_reportable_metrics() as $each) {
            $metric = new NxPro_Google_Service_AnalyticsReporting_Metric();
            $metric->setExpression($each['expression']);
            $metric->setAlias($each['alias']);
            $metrics[] = $metric;
        }

        // Create the report object.
        $request = new NxPro_Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($view_id);
        $request->setDateRanges($dateRange);
        $request->setMetrics($metrics);

        // get reports.
        $body = new NxPro_Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request));
        return $analytics->reports->batchGet($body);
    }

    /**
     * Determine which metrics we want to show in AnalyticsReporting query
     * @return array
     */
    private function get_reportable_metrics() {
        return array(
            array(
                'expression' => 'ga:pageviews',
                'alias' => 'Pageview'
            )
        );
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
     * @return array
     */
    private function get_token()
    {
        if(!empty($this->token)){
            return $this->token;
        }
        $options = get_option('nx_pa_settings');
        if(!empty($options) && !empty($options['token_info'])){
            $this->token = $options['token_info'];
        }
        return $this->token;
    }

    private function unserialize($str)
    {
        return unserialize(stripslashes($str));
    }
}
