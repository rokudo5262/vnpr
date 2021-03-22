<?php
/**
 * Class Shortcode For NotificationX Pro
 * @since 1.2.3
 */
class NotificationX_Shortcode {
    /**
     * Instance of
     * @var NotificationX_Shortcode
     */
    public static $_instance = null;
    /**
     * Get single referrence of NotificationX Shortcode
     * @return NotificationX_Shortcode
     */
    public static function instance(){
        return is_null( self::$_instance ) ? self::$_instance = new self() : self::$_instance;
    }
    /**
     * __construct__ is for revoke first time to get ready
     * @return void
     */
    public function __construct(){
        add_action('nx_admin_title_actions', array( $this, 'action_button' ) );
        add_filter('nx_display_tab_sections', array( $this, 'customize_tab' ), 11 );
        add_filter('nx_add_in_queue', array( $this, 'only_as_shortcode' ), 10, 2 );

        add_shortcode('notificationx', array( $this, 'shortcode' ), 999 );
    }
    /**
     * Action Button for Listing Page
     * @param int $id
     * @return void
     */
    public function action_button( $id ) {
        if( ! empty( $id ) ) {
            echo '<a class="nx-admin-title-shortcode nx-shortcode-btn" data-clipboard-text="[notificationx id='. $id .']" href="#">'. __('Shortcode', 'notificationx-pro') .'</a>';
        }
        return false;
    }
    /**
     * Customize tab fields added
     * @param array $options
     * @return array
     */
    public function customize_tab( $options ) {
        $options['visibility']['fields']['show_on']['options']['only_shortcode'] = __('Use Only as Shortcode', 'notificationx-pro');
        $options['visibility']['fields']['show_on']['hide']['only_shortcode'] = array(
            'fields' => array( 'all_localtions' )
        );
        return $options;
    }
    /**
     * Use notification only as shortcode
     * @param string $type
     * @param mixed $settings
     */
    public function only_as_shortcode( $type, $settings ){
        if( isset( $settings->show_on ) && $settings->show_on === 'only_shortcode' ) {
            return false;
        }
        return $type;
    }
    /**
     * Generate Notification For Shortcode
     * @param int $ids
     * @return array
     */
	private static function generate( $ids ) {
        $public = new NotificationX_Public( 'NotificationX', NOTIFICATIONX_VERSION );
		$notifications = $public->notifications;
		$echo = $data = [];
		if( ! empty( $notifications ) ) {
			$data = $notifications;
		}

        $settings = NotificationX_MetaBox::get_metabox_settings( $ids );
		$echo['config'] = apply_filters('nx_frontend_config', array(
			'delay_before'  => ( ! empty( $settings->delay_before ) ) ? intval( $settings->delay_before ) * 1000 : 0,
			'display_for'   => ( ! empty( $settings->display_for ) ) ? intval( $settings->display_for ) * 1000 : 0,
			'delay_between' => ( ! empty( $settings->delay_between ) ) ? intval( $settings->delay_between ) * 1000 : 0,
			'loop'          => ( ! empty( $settings->loop ) ) ? $settings->loop : 0,
            'id'            => $ids,
            'shortcode'     => true
        ), $settings);

        if( $settings->display_type === 'press_bar' ) {
            ob_start();
            NotificationX_PressBar_Extension::display( $settings, true );
            $content = ob_get_clean();
        } else {
            ob_start();
            include NOTIFICATIONX_PUBLIC_PATH . 'partials/nx-public-display.php';
            $content = ob_get_clean();
        }
		$echo['content'] = $content;
		return $echo;
    }
    /**
     * this method is responsible for output the shortcode.
     * @param array $atts
     */
    public static function shortcode( $atts, $content = null ){
        extract( shortcode_atts( array(
            'id' => '',
            'is_shortcode' => true
        ), $atts, 'notificationx' ) );
        if( empty( $id ) ) {
            return '<p class="nx-shortcode-notice">'. __( 'You have to give an ID to generate notificaion.', 'notificationx-pro' ) .'</p>';
        }

        if( ! in_array( $id, NotificationX_Public::get_active_items() ) ) {
            return '<p class="nx-shortcode-notice">'. __( 'Make sure you have enabled the notification which ID you have given.', 'notificationx-pro' ) .'</p>';
        }
        $notifications = self::generate( $id );
        $output = '';
        if( isset( $notifications['config']['sound'] ) ) {
            unset( $notifications['config']['sound'] );
        }

        $output .= '<div class="notificationx-shortcode-wrapper" data-config="'. esc_attr( json_encode( $notifications['config'] ) ) .'">';
            $output .= $notifications['content'];
        $output .= '</div>';
        return $output;
    }
}