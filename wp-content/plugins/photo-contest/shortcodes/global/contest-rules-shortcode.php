<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
    die;
}

add_shortcode('contest-rules', 'contest_rules');

function contest_rules($atts)
{
		//set default attributes and values
		$values = shortcode_atts( array(
			'id'   	=> '',
		), $atts );

        if (!empty ($values['id'])){
        global $wpdb;
        //Get Contest
        $contest_id = $values['id'];
        $related_contest= $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$contest_id);
		
			if (!empty($related_contest)){
			//Get variables
			$contest_condition = stripslashes($related_contest->contest_condition);
	
			$content = '<div class="pc-contest-rules-shortcode">';
			$content .= wpautop( $contest_condition );
			$content .= '<div class="clear"></div>';
			$content .= '</div>';
			
			return $content;
			}
			
		}

}