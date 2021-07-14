<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Get variables
$contest_condition = stripslashes($related_contest->contest_condition);
//If contest not exist
if (empty ($related_contest)) {
	wp_redirect(get_permalink());
}
//If is there Upload form mode
if ($related_contest->contest_mode == 3){
	wp_redirect(get_permalink());
}

//Hide section
$hide_rules = $related_contest->hide_rules;
if ($hide_rules == 2 and !is_super_admin()){
	wp_redirect(get_permalink());
}


$html = '<div class="photo-contest'.$animation.' '.$font_size.'">';
$html .= '<div class="clear"></div>';
$html .= '<div class="contest-rules">'.wpautop( $contest_condition ).'';
$html .= '<div class="clear"></div>';
$html .= '</div>';
$html .= '</div>';  // class photo-contest end
$html .= '<div class="clear"></div>';//important

?>
