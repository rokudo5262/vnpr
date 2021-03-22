<?php


class NotificationXPro_Google_Analytics_Request extends WP_Async_Request
{

    /**
     * @var string
     */
    protected $action = 'nx_ga_update_request';



    /**
     * Handle
     *
     * Override this method to perform any actions required
     * during the async request.
     */
    protected function handle()
    {
        NotificationXPro_Helper::write_log('Update request started at: '. current_time('Y-m-d h:ia'));

        $post = $_POST['post'];
        $notification_settings = $_POST['notification_settings'];
        $global_settings = $_POST['global_settings'];
        $saved_data = $_POST['saved_data'];
        // update analytics data
        new NotificationXPro_Google_Analytics_Updater(array(
            'post'=> $post,
            'notification_settings' => $notification_settings,
            'global_settings' => $global_settings,
            'saved_data' => $saved_data
        ));
        NotificationXPro_Helper::write_log('Update request end at: ' . current_time('Y-m-d h:ia'));
    }
}
