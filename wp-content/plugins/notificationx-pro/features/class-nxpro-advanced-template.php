<?php

class NotificationXPro_Advanced_Template {

    public function __construct(){
        add_action( 'nx_before_metabox_load', array( $this, 'before_metabox_loaded' ), 99 );
    }

    public function before_metabox_loaded(){
        add_action( 'nx_metabox_tabs', array( $this, 'content_tab_fields' ), 99 );
    }

    public function content_tab_fields( $options ){
        $options[ 'content_tab' ]['sections']['content_config']['fields']['comments_template'] = $this->comments_template();
        $options[ 'content_tab' ]['sections']['content_config']['fields']['wp_reviews_template'] = $this->wp_reviews_template();
        $options[ 'content_tab' ]['sections']['content_config']['fields']['wp_stats_template'] = $this->wp_stats_template();
        $options[ 'content_tab' ]['sections']['content_config']['fields']['elearning_template'] = $this->elearning_template();
        $options[ 'content_tab' ]['sections']['content_config']['fields']['donation_template'] = $this->donation_template();

        if( isset( $options[ 'content_tab' ]['sections']['content_config']['fields']['comments_template_adv']['swal'] ) ) {
            unset( $options[ 'content_tab' ]['sections']['content_config']['fields']['comments_template_adv']['swal'] );
            $options[ 'content_tab' ]['sections']['content_config']['fields']['comments_template_adv']['dependency'] = array(
                1 => array(
                    'fields' => array( 'comments_template' )
                )
            );
        }
        if( isset( $options[ 'content_tab' ]['sections']['content_config']['fields']['wp_reviews_template_adv']['swal'] ) ) {
            unset( $options[ 'content_tab' ]['sections']['content_config']['fields']['wp_reviews_template_adv']['swal'] );
            $options[ 'content_tab' ]['sections']['content_config']['fields']['wp_reviews_template_adv']['dependency'] = array(
                1 => array(
                    'fields' => array( 'wp_reviews_template' )
                )
            );
        }
        if( isset( $options[ 'content_tab' ]['sections']['content_config']['fields']['wp_stats_template_adv']['swal'] ) ) {
            unset( $options[ 'content_tab' ]['sections']['content_config']['fields']['wp_stats_template_adv']['swal'] );
            $options[ 'content_tab' ]['sections']['content_config']['fields']['wp_stats_template_adv']['dependency'] = array(
                1 => array(
                    'fields' => array( 'wp_stats_template' )
                )
            );
        }
        if( isset( $options[ 'content_tab' ]['sections']['content_config']['fields']['elearning_template_adv']['swal'] ) ) {
            unset( $options[ 'content_tab' ]['sections']['content_config']['fields']['elearning_template_adv']['swal'] );
            $options[ 'content_tab' ]['sections']['content_config']['fields']['elearning_template_adv']['dependency'] = array(
                1 => array(
                    'fields' => array( 'elearning_template' )
                )
            );
        }
        if( isset( $options[ 'content_tab' ]['sections']['content_config']['fields']['donation_template_adv']['swal'] ) ) {
            unset( $options[ 'content_tab' ]['sections']['content_config']['fields']['donation_template_adv']['swal'] );
            $options[ 'content_tab' ]['sections']['content_config']['fields']['donation_template_adv']['dependency'] = array(
                1 => array(
                    'fields' => array( 'donation_template' )
                )
            );
        }

        return $options;
    }

    public function donation_template(){
        return array(
            'type'     => 'template',
            'priority' => 92,
            'defaults' => [
                __('{{name}} recently donated', 'notificationx-pro'), '{{title}}', '{{time}}'
            ],
            'variables' => [
                '{{name}}', '{{amount}}', '{{first_name}}', '{{last_name}}', '{{title}}', '{{time}}'
            ],
        );
    }
    public function elearning_template(){
        return array(
            'type'     => 'template',
            'priority' => 92,
            'defaults' => [
                __('{{name}} recently enrolled', 'notificationx-pro'), '{{title}}', '{{time}}'
            ],
            'variables' => [
                '{{name}}', '{{first_name}}', '{{last_name}}', '{{title}}', '{{time}}'
            ],
        );
    }
    public function comments_template(){
        return array(
            'type'     => 'template',
            'label'    => __('' , 'notificationx-pro'),
            'priority' => 82,
            'defaults' => [
                __('{{name}} commented on', 'notificationx-pro'), '{{post_title}}', '{{time}}'
            ],
            'variables' => [
                '{{name}}', '{{first_name}}', '{{last_name}}', '{{post_title}}', '{{time}}'
            ],
        );
    }
    public function wp_reviews_template(){
        return array(
            'type'     => 'template',
            'priority' => 85,
            'defaults' => [
                __('{{username}} recently reviewed', 'notificationx-pro'), '{{plugin_name}}', '{{time}}'
            ],
            'variables' => [
                '{{username}}', '{{rated}}', '{{plugin_name}}', '{{title}}', '{{rating}}', '{{time}}'
            ],
        );
    }
    public function wp_stats_template(){
        return array(
            'type'     => 'template',
            'priority' => 85,
            'defaults' => [
                __('{{name}}', 'notificationx-pro'), 'has been downloaded {{all_time}} times', 'Why not you?'
            ],
            'variables' => [
                '{{name}}', '{{today}}', '{{last_week}}', '{{yesterday}}', '{{all_time}}', '{{active_installs}}'
            ],
        );
    }
}