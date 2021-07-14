<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_shortcode('contest-single-image', 'contest_single_image');

function contest_single_image($atts)
{
    
    // Attributes
    extract(shortcode_atts(array(
        'id' => ''
    ), $atts));
    
    // Code
    if (!empty($atts['width'])) {
        $width = 'style="width:' . $atts['width'] . 'px"';
    } else {
        $width = '';
    }
    
    if (isset($id)) {
        $html = '<div class="photo-contest-single-image" ' . $width . '>' . wp_get_attachment_image($id, 'full') . '</div>';
        return $html;
    }  
}
