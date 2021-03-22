<?php

class NotificationXPro_Sound {

    public $sound = '';
    public $sound_id = '';
    protected $audio_list;

    public function __construct(){
        $this->audio_list = array(
            'optgroup_comments' => array(
                'none' => __('None', 'notificationx-pro'),
                'to-the-point' => __('To the Point', 'notificationx-pro'),
                'intuition'    => __('Intuition', 'notificationx-pro'),
            ),
            'optgroup_sales' => array(
                'none' => __('None', 'notificationx-pro'),
                'to-the-point' => __('To the Point', 'notificationx-pro'),
                'intuition'    => __('Intuition', 'notificationx-pro'),
                'sales-one'    => __('Sound One', 'notificationx-pro'),
                'sales-two'    => __('Sound Two', 'notificationx-pro'),
            ),
            'optgroup_review' => array(
                'none' => __('None', 'notificationx-pro'),
                'to-the-point' => __('To the Point', 'notificationx-pro'),
                'review-one' => __('Sound One', 'notificationx-pro'),
                'review-two' => __('Sound Two', 'notificationx-pro'),
            ),
            'optgroup_stats' => array(
                'none' => __('None', 'notificationx-pro'),
                'to-the-point' => __('To the Point', 'notificationx-pro'),
                'stats-one' => __('Sound One', 'notificationx-pro'),
                'stats-two' => __('Sound Two', 'notificationx-pro'),
            ),
            'optgroup_subscription' => array(
                'none' => __('None', 'notificationx-pro'),
                'to-the-point' => __('To the Point', 'notificationx-pro'),
                'subscription-one' => __('Sound One', 'notificationx-pro'),
                'subscription-two' => __('Sound Two', 'notificationx-pro'),
            ),
            'optgroup_custom' => array(
                'none' => __('None', 'notificationx-pro'),
                'to-the-point' => __('To the Point', 'notificationx-pro'),
                'subscription-one' => __('Subscription Sound One', 'notificationx-pro'),
                'subscription-two' => __('Subscription Sound Two', 'notificationx-pro'),
            )
        );
        add_filter( 'admin_footer', array( $this, 'add_sounds' ), 9 );
        add_filter( 'nx_metabox_tabs', array( $this, 'add_section' ) );
        add_filter( 'nx_frontend_config', array( $this, 'frontend_config' ), 10, 2 );
        add_filter( 'nx_frontend_after_html', array( $this, 'add_sound' ), 10, 2 );
        add_filter( 'nx_display_types_hide_data', array( $this, 'hide' ) );
        add_filter( 'nx_meta_common_sections', array( $this, 'sections' ), 99 );
        add_filter( 'nx_comments_toggle_data', array( $this, 'comments_toggle' ) );
        add_filter( 'nx_reviews_toggle_fields', array( $this, 'review_toggle' ) );
        add_filter( 'nx_display_type', array( $this, 'subsciption_toggle' ) );
        add_filter( 'nx_stats_toggle_fields', array( $this, 'stats_toggle' ) );
        add_filter( 'nx_conversion_from', array( $this, 'toggle' ), 12 );
        add_filter( 'nx_page_analytics_source', array( $this, 'page_analytics_toggle' ), 12 );
        add_filter( 'nx_display_type', array( $this, 'custom_toggle' ), 12 );
    }

    public function subsciption_toggle( $options ){
        $options['dependency']['email_subscription']['fields'][] = 'email_subscription_sound';
        return $options;
    }
    public function comments_toggle( $options ){
        $options['fields'][] = 'comments_sound';
        return $options;
    }
    public function review_toggle( $options ){
        $options['fields'][] = 'reviews_sound';
        return $options;
    }
    public function stats_toggle( $options ){
        $options['fields'][] = 'download_stats_sound';
        return $options;
    }
    public function toggle( $options ){
        $options['dependency'][ 'woocommerce' ]['fields'][] = 'conversions_sound';
        $options['dependency'][ 'edd' ]['fields'][] = 'conversions_sound';
        $options['dependency'][ 'freemius' ]['fields'][] = 'conversions_sound';
        $options['dependency'][ 'zapier' ]['fields'][] = 'conversions_sound';
        $options['dependency'][ 'custom_notification' ]['fields'][] = 'conversions_sound';
        return $options;
    }
    public function page_analytics_toggle( $options ){
        $options['dependency'][ 'google' ]['fields'][] = 'conversions_sound';
        return $options;
    }
    public function custom_toggle( $options ){
        $options['dependency']['custom']['fields'][] = 'custom_sound';
        return $options;
    }

    public function hide( $options ){
        $options['press_bar']['sections'][] = 'sound_section';

        $options['comments']['fields'][]           = 'reviews_sound';
        $options['conversions']['fields'][]        = 'reviews_sound';
        $options['download_stats']['fields'][]     = 'reviews_sound';
        $options['email_subscription']['fields'][] = 'reviews_sound';

        $options['reviews']['fields'][]        = 'email_subscription_sound';
        $options['comments']['fields'][]       = 'email_subscription_sound';
        $options['conversions']['fields'][]    = 'email_subscription_sound';
        $options['download_stats']['fields'][] = 'email_subscription_sound';

        $options['reviews']['fields'][]            = 'download_stats_sound';
        $options['comments']['fields'][]           = 'download_stats_sound';
        $options['conversions']['fields'][]        = 'download_stats_sound';
        $options['email_subscription']['fields'][] = 'download_stats_sound';

        $options['reviews']['fields'][]            = 'conversions_sound';
        $options['comments']['fields'][]           = 'conversions_sound';
        $options['download_stats']['fields'][]     = 'conversions_sound';
        $options['email_subscription']['fields'][] = 'conversions_sound';

        $options['reviews']['fields'][]            = 'comments_sound';
        $options['conversions']['fields'][]        = 'comments_sound';
        $options['download_stats']['fields'][]     = 'comments_sound';
        $options['email_subscription']['fields'][] = 'comments_sound';

        $options['reviews']['fields'][]            = 'custom_sound';
        $options['comments']['fields'][]           = 'custom_sound';
        $options['conversions']['fields'][]        = 'custom_sound';
        $options['download_stats']['fields'][]     = 'custom_sound';
        $options['email_subscription']['fields'][] = 'custom_sound';

        return $options;
    }
    public function sections( $sections ){
        $sections[] = 'sound_section';
        return $sections;
    }

    public function add_sounds(){
        global $pagenow;
        if( get_post_type() != 'notificationx' || ! in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) {
            return;
        }

        $file_list = [];
        if( ! empty( $this->audio_list ) ) {
            foreach( $this->audio_list as $file_name => $value ) {
                if( is_array( $value ) ) {
                    unset( $value['none'] );
                    foreach( $value as $i_file_name => $i_value ) {
                        $file_list[ $i_file_name ] = $i_value;
                    }
                } else {
                    $file_list[ $file_name ] = $value;
                }
            }
        }
        if( ! empty( $file_list ) ) :
            ?>
            <div class="nx-admin-audio-list">
                <?php
                    foreach( $file_list as $file => $file_v ) {
                        $mp3_source = NOTIFICATIONX_PRO_URL . "assets/sounds/" . $file . '.mp3';
                        $ogg_source = NOTIFICATIONX_PRO_URL . "assets/sounds/" . $file . '.ogg';
                        $m4r_source = NOTIFICATIONX_PRO_URL . "assets/sounds/" . $file . '.m4r';
                        ?>
                            <audio id="<?php echo $file; ?>">
                                <source src="<?php echo $mp3_source; ?>" type="audio/mpeg">
                            </audio>
                        <?php
                    }
                ?>
            </div>
            <?php
        endif;
    }

    public function add_section( $sections ){
        $old_sections = $sections['customize_tab']['sections'];
        $old_sections['sound_section'] = array(
            'title'       => __('Sound Settings', 'notificationx-pro'),
            'priority'    => 300,
            'collapsable' => true,
            'fields'      => array(
                'conversions_sound'  => array(
                    'type'        => 'select',
                    'label'       => __('Select a sound' , 'notificationx'),
                    'description' => 'Select a notification sound to play with Notificaion.',
                    'default'     => 'none',
                    'priority'    => 1,
                    'options'     => $this->audio_list['optgroup_sales'],
                ),
                'reviews_sound'  => array(
                    'type'        => 'select',
                    'label'       => __('Select a sound' , 'notificationx'),
                    'description' => 'Select a notification sound to play with Notificaion.',
                    'default'     => 'none',
                    'priority'    => 1,
                    'options'     => $this->audio_list['optgroup_review'],
                ),
                'download_stats_sound'  => array(
                    'type'        => 'select',
                    'label'       => __('Select a sound' , 'notificationx'),
                    'description' => 'Select a notification sound to play with Notificaion.',
                    'default'     => 'none',
                    'priority'    => 2,
                    'options'     => $this->audio_list['optgroup_stats'],
                ),
                'email_subscription_sound'  => array(
                    'type'        => 'select',
                    'label'       => __('Select a sound' , 'notificationx'),
                    'description' => 'Select a notification sound to play with Notificaion.',
                    'default'     => 'none',
                    'priority'    => 3,
                    'options'     => $this->audio_list['optgroup_subscription'],
                ),
                'comments_sound'  => array(
                    'type'        => 'select',
                    'label'       => __('Select a sound' , 'notificationx'),
                    'description' => 'Select a notification sound to play with Notificaion.',
                    'default'     => 'none',
                    'priority'    => 4,
                    'options'     => $this->audio_list['optgroup_comments'],
                ),
                'custom_sound'  => array(
                    'type'        => 'select',
                    'label'       => __('Select a sound' , 'notificationx'),
                    'description' => 'Select a notification sound to play with Notificaion.',
                    'default'     => 'none',
                    'priority'    => 6,
                    'options'     => $this->audio_list['optgroup_custom'],
                ),
                'volume'  => array(
                    'type'        => 'slider',
                    'label'       => __('Volume' , 'notificationx'),
                    'default'     => '0.03',
                    'priority'    => 10,
                ),
            )
        );
        $sections['customize_tab']['sections'] = $old_sections;
        return $sections;
    }

    public function frontend_config( $config, $settings ){
        if( is_array( $settings ) ) {
            return $config;
        }
        if( isset( $settings->{ $settings->display_type . "_sound" } ) && ! empty( $settings->{ $settings->display_type . "_sound" } ) ) {
            $settings->sound = $settings->{ $settings->display_type . "_sound" };
        }
        $old_sound = get_post_meta( $settings->id, '_nx_meta_sound', true );
        if( $old_sound !== 'none' && isset( $settings->sound ) && $settings->sound === 'none' ){
            $settings->sound = $old_sound;
        }

        if( isset( $settings->sound ) && $settings->sound !== 'none' && ! empty( $settings->sound ) ) {
            $config['sound'] = 1;
            $config['volume'] = $settings->volume;
        }
        return $config;
    }

    public function add_sound( $output, $settings ){
        if( isset( $settings->{ $settings->display_type . "_sound" } ) && ! empty( $settings->{ $settings->display_type . "_sound" } ) ) {
            $settings->sound = $settings->{ $settings->display_type . "_sound" };
        }

        $old_sound = get_post_meta( $settings->id, '_nx_meta_sound', true );
        if( $old_sound !== 'none' && isset( $settings->sound ) && $settings->sound === 'none' ){
            $settings->sound = $old_sound;
        }

        if( isset( $settings->sound ) && $settings->sound !== 'none' && ! empty( $settings->sound ) ) {
            $this->sound    = $settings->sound;
            $this->sound_id = $settings->id;
            $output .= '<audio type="audio/mpeg" id="nx_sound_'. $this->sound_id .'" src="'. NOTIFICATIONX_PRO_URL .'assets/sounds/'. $this->sound .'.mp3"></audio>';
        }
        return $output;
    }
}