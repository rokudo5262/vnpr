<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

function contest_width($atts, $content = null)
{
    
    // Attributes
    extract(shortcode_atts(array(
        'width' => ''
    ), $atts));
    
    // Code
    
    if (!empty($atts['width'])) {
        $width = 'style="max-width:' . $atts['width'] . 'px;margin:auto;"';
    } else {
        $width = '';
    }
    
    return '<div ' . $width . '>' . do_shortcode($content) . '</div>';
    
}
add_shortcode('contest-width', 'contest_width');
