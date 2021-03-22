<?php 

class NotificationXPro_Extension extends NotificationX_Extension {
    public function template_string_by_theme( $template, $old_template, $posts_data ){
        if( NotificationX_Helper::get_type( $posts_data ) === $this->type ) {
            $theme = NotificationX_Helper::get_theme( $posts_data );
            $breaks_data = apply_filters( 'nx_theme_breaks_data', array( 'br_before' => [ 'third_param', 'fourth_param' ] ));
            switch( $theme ) {
                case 'maps_theme' : 
                    $old_template = $posts_data['nx_meta_maps_theme_template_new'];
                    $template = NotificationX_Helper::regenerate_the_theme( $old_template, $breaks_data );
                    break;
                default : 
                    $template = NotificationX_Helper::regenerate_the_theme( $old_template, $breaks_data );
                    break;
            }
            return $template;
        }
        return $template;
    }
}