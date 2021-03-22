<?php 
/**
 * Advanced Style Class
 * @since 1.2.*
 */
class NotificationXPro_Advanced_Style {
    /**
     * Auto Revoke in Call
     */
    public function __construct(){
        add_filter( 'nx_frontend_inner_classes', array( $this, 'subscription_frontend_inner_class' ), 10, 2 );
        add_action( 'nx_style_generation', array( $this, 'style_generation' ), 11 );
    }
    /**
     * advanced customize class for 
     * Email Subscription 
     *
     * @param array $classes
     * @param stdClass $settings
     * @return void
     */
    public function subscription_frontend_inner_class( $classes, $settings ) {
        if( $settings->display_type === 'email_subscription' ) {
            if( $settings->mailchimp_advance_edit ) {
                $classes[] = 'nx-customize-style-' . $settings->id;
            }
        }
        if( $settings->display_type === 'custom' ) {
            if( $settings->custom_advance_edit ) {
                $classes[] = 'nx-customize-style-' . $settings->id;
            }
        }
        if( $settings->display_type === 'page_analytics' ) {
        if( $settings->page_analytics_advance_edit ) {
                $classes[] = 'nx-customize-style-' . $settings->id;
            }
        }
        return $classes;
    }
    /**
     * Style for Subscription Notification
     */
    public function style_generation(){
        add_filter( 'nx_style_string', array( $this, 'advanced_styles' ), 11, 2 );
    }
    /**
     * CSS Generator
     */
    public static function advanced_styles( $css_string, $settings ){ 
        $theme = NotificationX_Helper::get_theme( $settings );
        $advanced_edit_enabled = NotificationX_Advanced_Style::enabled_edit( $settings );
        $css = '';
        if( $advanced_edit_enabled ) {
            if( $settings->display_type === 'conversions' 
                && in_array( $theme, array( 'theme-four', 'theme-five', 'maps_theme', 'conv-theme-six', 'conv-theme-eight', 'conv-theme-nine', 'conv-theme-seven' ) ) ) {
                $css = self::conversions_edit( $settings, $theme );
            }
            if( $settings->display_type === 'comments' && in_array( $theme, array( 'theme-four', 'theme-five', 'maps_theme' ) ) ) {
                $css = self::comments_edit( $settings, $theme );
            }
        }
        if( $settings->display_type === 'email_subscription' ) {
            if( $settings->mailchimp_advance_edit ) {
                $css = self::subscription_edit( $settings, $theme );
            }
        }
        if( $settings->display_type === 'custom' ) {
            if( $settings->custom_advance_edit ) {
                $css = self::custom_edit( $settings, $theme );
            }
        }
        if( $settings->display_type === 'page_analytics' ) {
            if( $settings->page_analytics_advance_edit ) {
                $css = self::analytics_edit( $settings, $theme );
            }
        }

        if( ! empty( $css ) ) {
            $css_string = '<style type="text/css">' . $css . '</style>';
        }

        return $css_string;
    }
    /**
     * Subscription CSS Generator
     *
     * @param stdClass $settings
     * @param string $theme
     * @return string
     */
    public static function subscription_edit( $settings, $theme = 'theme-four' ){
        $css_object = [];
        $css_string = '';

        if( ! empty( $settings->mailchimp_bg_color ) ) {
            $css_object[ 'wrapper' ][] = 'background-color:' . $settings->mailchimp_bg_color;
            $css_object['shadow']['color'] = $settings->mailchimp_bg_color;
        }
        if( ! empty( $settings->mailchimp_text_color ) ) {
            $css_object[ 'wrapper' ][] = 'color:' . $settings->mailchimp_text_color;
            $css_object[ 'color' ][] = 'color:' . $settings->mailchimp_text_color;
        }
        if( $settings->mailchimp_border ) {
            if( ! empty( $settings->mailchimp_border_size ) ) {
                $css_object[ 'border' ][] = 'border-width:' . $settings->mailchimp_border_size . 'px';
                if( ! empty( $settings->mailchimp_border_style ) ) {
                    $css_object[ 'border' ][] = 'border-style:' . $settings->mailchimp_border_style;
                }
                if( ! empty( $settings->mailchimp_border_color ) ) {
                    $css_object[ 'border' ][] = 'border-color:' . $settings->mailchimp_border_color;
                    $css_object[ 'shadow' ]['border-color'] = $settings->mailchimp_border_color;
                }
            }
        }

        $css_object[ 'first_row' ][]  = 'font-size:' . $settings->mailchimp_first_font_size . 'px';
        $css_object[ 'second_row' ][] = 'font-size:' . $settings->mailchimp_second_font_size . 'px';
        $css_object[ 'third_row' ][]  = 'font-size:' . $settings->mailchimp_third_font_size . 'px';

        $custom_class = '.nx-notification.nx-' . $settings->display_type . ' .nx-customize-style-' . $settings->id;
        $inner_class = $custom_class . '.nx-notification-' . $theme . '.notificationx-inner';
        $content_class = $inner_class . ' .notificationx-content';
        $image_class = $inner_class . ' .notificationx-image';

        if( ! empty( $css_object['wrapper'] ) ) {
            $wrapper_css = $inner_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            // Theme MAPS _THEME
            if( $theme === 'maps_theme' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            }
            $css_string .= $wrapper_css;
        }
        if( ! empty( $css_object['border'] ) ) {
            $border_css = $inner_class . '{' . implode( ';', $css_object['border'] ) . '}';
            if( $theme === 'maps_theme' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            $css_string .= $border_css;
        }
        if( ! empty( $css_object['first_row'] ) ) {
            $css_string .= $content_class . ' .nx-first-row{' . implode( ';', $css_object['first_row'] ) . '}';
        }
        if( ! empty( $css_object['second_row'] ) ) {
            $css_string .= $content_class . ' .nx-second-row{' . implode( ';', $css_object['second_row'] ) . '}';
        }
        if( ! empty( $css_object['third_row'] ) ) {
            $css_string .= $content_class . ' .nx-third-row{' . implode( ';', $css_object['third_row'] ) . '}';
        }
        if( ! empty( $css_object[ 'color' ] ) ) {
            $css_string .= $content_class . ' > div {' . implode( ';', $css_object['color'] ) . '}';
            $css_string .= $content_class . ' > div > span {' . implode( ';', $css_object['color'] ) . '}';
        }
        if( ! empty( $settings->mailchimp_text_color ) ) {
            $css_string .= $content_class . ' .nx-branding > a > svg { fill: ' . $settings->mailchimp_text_color . '}';
        }

        return $css_string;
    }
    /**
     * Custom Conversions CSS Generator
     *
     * @param stdClass $settings
     * @param string $theme
     * @return string
     */
    public static function custom_edit( $settings, $theme = 'theme-one' ){
        $css_object = [];
        $css_string = '';

        if( ! empty( $settings->bg_color ) ) {
            $css_object[ 'wrapper' ][] = 'background-color:' . $settings->bg_color;
            $css_object['shadow']['color'] = $settings->bg_color;
        }
        if( ! empty( $settings->text_color ) ) {
            $css_object[ 'wrapper' ][] = 'color:' . $settings->text_color;
            $css_object[ 'color' ][] = 'color:' . $settings->text_color;
        }
        if( $settings->border ) {
            if( ! empty( $settings->border_size ) ) {
                $css_object[ 'border' ][] = 'border-width:' . $settings->border_size . 'px';
                if( ! empty( $settings->border_style ) ) {
                    $css_object[ 'border' ][] = 'border-style:' . $settings->border_style;
                }
                if( ! empty( $settings->border_color ) ) {
                    $css_object[ 'border' ][] = 'border-color:' . $settings->border_color;
                    $css_object[ 'shadow' ]['border-color'] = $settings->border_color;
                }
            }
        }

        $css_object[ 'first_row' ][]  = 'font-size:' . $settings->first_font_size . 'px';
        $css_object[ 'second_row' ][] = 'font-size:' . $settings->second_font_size . 'px';
        $css_object[ 'third_row' ][]  = 'font-size:' . $settings->third_font_size . 'px';

        $custom_class = '.nx-notification.nx-' . $settings->display_type . ' .nx-customize-style-' . $settings->id;
        $inner_class = $custom_class . '.nx-notification-' . $theme . '.notificationx-inner';
        $content_class = $inner_class . ' .notificationx-content';
        $image_class = $inner_class . ' .notificationx-image';

        if( ! empty( $css_object['wrapper'] ) ) {
            $wrapper_css = $inner_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            $wrapper_css .= $image_class . '{background-color: '. $css_object['shadow']['color'] .'}';
            if( $theme === 'theme-four' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                if( ! empty( $css_object['shadow']['color'] ) ) {
                    $box_shadow = '0 0 0px 10px ' . $css_object['shadow']['color'];
                }
                if( ! empty( $css_object['shadow']['border-color'] ) ) {
                    $box_shadow .= ',0 0 0px 11px ' . $css_object['shadow']['border-color'];
                }
                $box_shadow .= ',-10px 0px 30px -20px #b3b3b3';

                $wrapper_css .= $image_class . '{background-color: '. $css_object['shadow']['color'] .'}';
                $wrapper_css .= $image_class . '{box-shadow: '. $box_shadow .'}';
            }
            // Theme five
            if( $theme === 'theme-five' || $theme === 'comments-theme-five' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                if( ! empty( $css_object['shadow']['color'] ) ) {
                    $wrapper_css .= $content_class . ' >  svg#themeFiveSVGShape { fill: '. $css_object['shadow']['color'] .' }';
                    $wrapper_css .= $image_class . ' >  svg#themeFiveSVGImageShape { fill: '. $css_object['shadow']['color'] .' }';
                }
            }
            // THEME SIX
            if( $theme === 'review-comment' || $theme === 'theme-six-free' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . ':after{border-right-color: '. $css_object['shadow']['color'] .' }';
            }
            // Theme MAPS _THEME
            if( $theme === 'maps_theme' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            }
            // Theme MAPS _THEME
            if( $theme === 'conv-theme-nine' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            }
            $css_string .= $wrapper_css;
        }
        if( ! empty( $css_object['border'] ) ) {
            $border_css = $inner_class . '{' . implode( ';', $css_object['border'] ) . '}';
            if( $theme === 'theme-four' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            if( $theme === 'theme-five' || $theme === 'comments-theme-five' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
                $border_css .= $image_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            if( $theme === 'maps_theme' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            if( $theme === 'conv-theme-six' || $theme === 'conv-theme-eight' ) {
                $border_css = $inner_class . '{' . implode( ';', $css_object['border'] ) . '}';
                $border_css .= $image_class . '{ border-color: '. $css_object[ 'shadow' ]['border-color'] .'}';
            }
            if( $theme === 'conv-theme-nine' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
                $border_css .= $image_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            if( $theme === 'theme-six-free' || $theme === 'review-comment' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
                $border_css .= $image_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            $css_string .= $border_css;
        }
        if( ! empty( $css_object['first_row'] ) ) {
            $css_string .= $content_class . ' .nx-first-row{' . implode( ';', $css_object['first_row'] ) . '}';
        }
        if( ! empty( $css_object['second_row'] ) ) {
            $css_string .= $content_class . ' .nx-second-row{' . implode( ';', $css_object['second_row'] ) . '}';
        }
        if( ! empty( $css_object['third_row'] ) ) {
            $css_string .= $content_class . ' .nx-third-row{' . implode( ';', $css_object['third_row'] ) . '}';
        }
        if( ! empty( $css_object[ 'color' ] ) ) {
            $css_string .= $content_class . ' > div {' . implode( ';', $css_object['color'] ) . '}';
            $css_string .= $content_class . ' > div > span {' . implode( ';', $css_object['color'] ) . '}';
        }
        if( ! empty( $settings->text_color ) ) {
            $css_string .= $content_class . ' .nx-branding > a > svg { fill: ' . $settings->text_color . '}';
        }

        return $css_string;
    }
    /**
     * Conversions CSS Generator
     *
     * @param stdClass $settings
     * @param string $theme
     * @return string
     */
    public static function conversions_edit( $settings, $theme = 'theme-four' ){
        $css_object = [];
        $css_string = '';

        if( ! empty( $settings->bg_color ) ) {
            $css_object[ 'wrapper' ][] = 'background-color:' . $settings->bg_color;
            $css_object['shadow']['color'] = $settings->bg_color;
        }
        if( ! empty( $settings->text_color ) ) {
            $css_object[ 'wrapper' ][] = 'color:' . $settings->text_color;
            $css_object[ 'color' ][] = 'color:' . $settings->text_color;
        }
        if( $settings->border ) {
            if( ! empty( $settings->border_size ) ) {
                $css_object[ 'border' ][] = 'border-width:' . $settings->border_size . 'px';
                if( ! empty( $settings->border_style ) ) {
                    $css_object[ 'border' ][] = 'border-style:' . $settings->border_style;
                }
                if( ! empty( $settings->border_color ) ) {
                    $css_object[ 'border' ][] = 'border-color:' . $settings->border_color;
                    $css_object[ 'shadow' ]['border-color'] = $settings->border_color;
                }
            }
        }

        $css_object[ 'first_row' ][]  = 'font-size:' . $settings->first_font_size . 'px';
        $css_object[ 'second_row' ][] = 'font-size:' . $settings->second_font_size . 'px';
        $css_object[ 'third_row' ][]  = 'font-size:' . $settings->third_font_size . 'px';

        $custom_class = '.nx-notification.nx-' . $settings->display_type . ' .nx-customize-style-' . $settings->id;
        $inner_class = $custom_class . '.nx-notification-' . $theme . '.notificationx-inner';
        $content_class = $inner_class . ' .notificationx-content';
        $image_class = $inner_class . ' .notificationx-image';

        if( ! empty( $css_object['wrapper'] ) ) {
            $wrapper_css = $inner_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            if( $theme === 'theme-four' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                if( ! empty( $css_object['shadow']['color'] ) ) {
                    $box_shadow = '0 0 0px 10px ' . $css_object['shadow']['color'];
                }
                if( ! empty( $css_object['shadow']['border-color'] ) ) {
                    $box_shadow .= ',0 0 0px 11px ' . $css_object['shadow']['border-color'];
                }
                $box_shadow .= ',-10px 0px 30px -20px #b3b3b3';
                $wrapper_css .= $image_class . '{background-color: '. $css_object['shadow']['color'] .'}';
                $wrapper_css .= $image_class . '{box-shadow: '. $box_shadow .'}';
            }
            // Theme five
            if( $theme === 'theme-five' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                if( ! empty( $css_object['shadow']['color'] ) ) {
                    $wrapper_css .= $content_class . ' >  svg#themeFiveSVGShape { fill: '. $css_object['shadow']['color'] .' }';
                    $wrapper_css .= $image_class . ' >  svg#themeFiveSVGImageShape { fill: '. $css_object['shadow']['color'] .' }';
                }
            }
            // Theme MAPS _THEME
            if( $theme === 'maps_theme' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            }
            // Theme MAPS _THEME
            if( $theme === 'conv-theme-nine' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            }
            $css_string .= $wrapper_css;
        }
        if( ! empty( $css_object['border'] ) ) {
            $border_css = $inner_class . '{' . implode( ';', $css_object['border'] ) . '}';
            if( $theme === 'theme-four' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            if( $theme === 'theme-five' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
                $border_css .= $image_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            if( $theme === 'maps_theme' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            if( $theme === 'conv-theme-six' || $theme === 'conv-theme-eight' ) {
                $border_css = $inner_class . '{' . implode( ';', $css_object['border'] ) . '}';
                $border_css .= $image_class . '{ border-color: '. $css_object[ 'shadow' ]['border-color'] .'}';
            }
            if( $theme === 'conv-theme-nine' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
                $border_css .= $image_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            $css_string .= $border_css;
        }
        if( ! empty( $css_object['first_row'] ) ) {
            $css_string .= $content_class . ' .nx-first-row{' . implode( ';', $css_object['first_row'] ) . '}';
        }
        if( ! empty( $css_object['second_row'] ) ) {
            $css_string .= $content_class . ' .nx-second-row{' . implode( ';', $css_object['second_row'] ) . '}';
        }
        if( ! empty( $css_object['third_row'] ) ) {
            $css_string .= $content_class . ' .nx-third-row{' . implode( ';', $css_object['third_row'] ) . '}';
        }
        if( ! empty( $css_object[ 'color' ] ) ) {
            $css_string .= $content_class . ' > div {' . implode( ';', $css_object['color'] ) . '}';
            $css_string .= $content_class . ' > div > span {' . implode( ';', $css_object['color'] ) . '}';
        }
        if( ! empty( $settings->text_color ) ) {
            $css_string .= $content_class . ' .nx-branding > a > svg { fill: ' . $settings->text_color . '}';
        }

        return $css_string;
    }
    /**
     * Page Analytics CSS Generator
     *
     * @param stdClass $settings
     * @param string $theme
     * @return string
     */
    public static function analytics_edit( $settings, $theme = 'pa-theme-one' ){
        $css_object = [];
        $css_string = '';

        if( ! empty( $settings->bg_color ) ) {
            $css_object[ 'wrapper' ][] = 'background-color:' . $settings->bg_color;
            $css_object['shadow']['color'] = $settings->bg_color;
        }
        if( ! empty( $settings->text_color ) ) {
            $css_object[ 'wrapper' ][] = 'color:' . $settings->text_color;
            $css_object[ 'color' ][] = 'color:' . $settings->text_color . '!important';
        }
        if( $settings->border ) {
            if( ! empty( $settings->border_size ) ) {
                $css_object[ 'border' ][] = 'border-width:' . $settings->border_size . 'px';
                if( ! empty( $settings->border_style ) ) {
                    $css_object[ 'border' ][] = 'border-style:' . $settings->border_style;
                }
                if( ! empty( $settings->border_color ) ) {
                    $css_object[ 'border' ][] = 'border-color:' . $settings->border_color;
                    $css_object[ 'shadow' ]['border-color'] = $settings->border_color;
                }
            }
        }

        $css_object[ 'first_row' ][]  = 'font-size:' . $settings->first_font_size . 'px';
        $css_object[ 'second_row' ][] = 'font-size:' . $settings->second_font_size . 'px';
        $css_object[ 'third_row' ][]  = 'font-size:' . $settings->third_font_size . 'px';

        $custom_class = '.nx-notification.nx-' . $settings->display_type . ' .nx-customize-style-' . $settings->id;
        $inner_class = $custom_class . '.nx-notification-' . $theme . '.notificationx-inner';
        $content_class = $inner_class . ' .notificationx-content';
        $image_class = $inner_class . ' .notificationx-image';

        if( ! empty( $css_object['wrapper'] ) ) {
            $wrapper_css = $inner_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            // Theme Two
            if( $theme === 'pa-theme-two' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            }
            $css_string .= $wrapper_css;
        }
        if( ! empty( $css_object['border'] ) ) {
            $border_css = $inner_class . '{' . implode( ';', $css_object['border'] ) . '}';
            if( $theme === 'pa-theme-two' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
                $border_css .= $image_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            $css_string .= $border_css;
        }
        if( ! empty( $css_object['first_row'] ) ) {
            $css_string .= $content_class . ' .nx-first-row{' . implode( ';', $css_object['first_row'] ) . '}';
        }
        if( ! empty( $css_object['second_row'] ) ) {
            $css_string .= $content_class . ' .nx-second-row{' . implode( ';', $css_object['second_row'] ) . '}';
        }
        if( ! empty( $css_object['third_row'] ) ) {
            $css_string .= $content_class . ' .nx-third-row{' . implode( ';', $css_object['third_row'] ) . '}';
        }
        if( ! empty( $css_object[ 'color' ] ) ) {
            $css_string .= $content_class . ' > div {' . implode( ';', $css_object['color'] ) . '}';
            $css_string .= $content_class . ' > div > span {' . implode( ';', $css_object['color'] ) . '}';
        }
        if( ! empty( $settings->text_color ) ) {
            $css_string .= $content_class . ' .nx-branding > a > svg { fill: ' . $settings->text_color . '}';
        }

        return $css_string;
    }
    /**
     * Comments PRO Theme CSS Generator
     *
     * @param stdClass $settings
     * @param string $theme
     * @return string
     */
    public static function comments_edit( $settings, $theme = 'theme-one' ){
        $css_object = [];
        $css_string = '';

        if( ! empty( $settings->comment_bg_color ) ) {
            $css_object[ 'wrapper' ][] = 'background-color:' . $settings->comment_bg_color;
            $css_object['shadow']['color'] = $settings->comment_bg_color;
        }
        if( ! empty( $settings->comment_text_color ) ) {
            $css_object[ 'wrapper' ][] = 'color:' . $settings->comment_text_color;
            $css_object[ 'color' ][] = 'color:' . $settings->comment_text_color;
        }
        if( $settings->comment_border ) {
            if( ! empty( $settings->comment_border_size ) ) {
                $css_object[ 'border' ][] = 'border-width:' . $settings->comment_border_size . 'px';
                if( ! empty( $settings->comment_border_style ) ) {
                    $css_object[ 'border' ][] = 'border-style:' . $settings->comment_border_style;
                }
                if( ! empty( $settings->comment_border_color ) ) {
                    $css_object[ 'border' ][] = 'border-color:' . $settings->comment_border_color;
                    $css_object[ 'shadow' ]['border-color'] = $settings->comment_border_color;
                }
            }
        }

        $css_object[ 'first_row' ][]  = 'font-size:' . $settings->comment_first_font_size . 'px';
        $css_object[ 'second_row' ][] = 'font-size:' . $settings->comment_second_font_size . 'px';
        $css_object[ 'third_row' ][]  = 'font-size:' . $settings->comment_third_font_size . 'px';

        $custom_class = '.nx-notification.nx-' . $settings->display_type . ' .nx-customize-style-' . $settings->id;
        $inner_class = $custom_class . '.nx-notification-' . $theme . '.notificationx-inner';
        $content_class = $inner_class . ' .notificationx-content';
        $image_class = $inner_class . ' .notificationx-image';

        if( ! empty( $css_object['wrapper'] ) ) {
            $wrapper_css = $inner_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            // Theme FOUR
            if( $theme === 'theme-four' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                if( ! empty( $css_object['shadow']['color'] ) ) {
                    $box_shadow = '0 0 0px 10px ' . $css_object['shadow']['color'];
                }
                if( ! empty( $css_object['shadow']['border-color'] ) ) {
                    $box_shadow .= ',0 0 0px 11px ' . $css_object['shadow']['border-color'];
                }
                $box_shadow .= ',-10px 0px 30px -20px #b3b3b3';
                $wrapper_css .= $image_class . '{background-color: '. $css_object['shadow']['color'] .'}';
                $wrapper_css .= $image_class . '{box-shadow: '. $box_shadow .'}';
            }
            // Theme five
            if( $theme === 'theme-five' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                if( ! empty( $css_object['shadow']['color'] ) ) {
                    $wrapper_css .= $content_class . ' >  svg#themeFiveSVGShape { fill: '. $css_object['shadow']['color'] .' }';
                    $wrapper_css .= $image_class . ' >  svg#themeFiveSVGImageShape { fill: '. $css_object['shadow']['color'] .' }';
                }
            }
            // Theme MAPS _THEME
            if( $theme === 'maps_theme' ) {
                $wrapper_css = $content_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
                $wrapper_css .= $image_class . '{' . implode( ';', $css_object['wrapper'] ) . '}';
            }
            $css_string .= $wrapper_css;
        }
        if( ! empty( $css_object['border'] ) ) {
            $border_css = $inner_class . '{' . implode( ';', $css_object['border'] ) . '}';
            if( $theme === 'theme-four' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            if( $theme === 'theme-five' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
                $border_css .= $image_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            if( $theme === 'maps_theme' ) {
                $border_css = $content_class . '{' . implode( ';', $css_object['border'] ) . '}';
            }
            $css_string .= $border_css;
        }
        if( ! empty( $css_object['first_row'] ) ) {
            $css_string .= $content_class . ' .nx-first-row{' . implode( ';', $css_object['first_row'] ) . '}';
        }
        if( ! empty( $css_object['second_row'] ) ) {
            $css_string .= $content_class . ' .nx-second-row{' . implode( ';', $css_object['second_row'] ) . '}';
        }
        if( ! empty( $css_object['third_row'] ) ) {
            $css_string .= $content_class . ' .nx-third-row{' . implode( ';', $css_object['third_row'] ) . '}';
        }
        if( ! empty( $css_object[ 'color' ] ) ) {
            $css_string .= $content_class . ' > div {' . implode( ';', $css_object['color'] ) . '}';
            $css_string .= $content_class . ' > div > span {' . implode( ';', $css_object['color'] ) . '}';
        }
        if( ! empty( $settings->comment_text_color ) ) {
            $css_string .= $content_class . ' .nx-branding > a > svg { fill: ' . $settings->comment_text_color . '}';
        }

        return $css_string;
    }
}