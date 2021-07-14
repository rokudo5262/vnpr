<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $wpdb;


if (!empty($related_contest) and $related_contest->contest_mode != 3) {
	$current_url = get_permalink();
	$upload_url    = add_query_arg('contest', 'upload-photo', $current_url);
	//Change URL if Upload Form mode
	if ($related_contest->contest_mode != 1){
	$upload_url    = $current_url;
	}
	$gallery_url   = add_query_arg('contest', 'gallery', $current_url);
	$condition_url = add_query_arg('contest', 'contest-condition', $current_url);
	$profile_url   = add_query_arg('contest', 'contest-profile', $current_url);
	$rank_url      = add_query_arg('contest', 'contest-top10', $current_url);
	$date          = StrFTime('%m/%d/%Y', current_time('timestamp', 0));
	$voting        = $related_contest->contest_vote_start;
	$start         = $related_contest->contest_start;
	$voting_time   = strtotime($voting);
	$begin_time    = strtotime($start);
	$today_time    = strtotime($date);


	$vote_menu_gallery     = get_option('pcplugin-menu-gallery');
	$vote_menu_upload      = get_option('pcplugin-menu-upload');
	$vote_menu_rules       = get_option('pcplugin-menu-rules');
	$vote_menu_your_images = get_option('pcplugin-menu-your-images');
	$vote_menu_top10       = get_option('pcplugin-menu-top10');
	$menu_open             = get_option('pcplugin-menu-open');


	if (empty($vote_menu_gallery)) {
	  $vote_menu_gallery = __('Gallery', 'photo-contest');
	}
	if (empty($vote_menu_upload)) {
	  $vote_menu_upload = __('Upload photo', 'photo-contest');
	}
	if (empty($vote_menu_rules)) {
	  $vote_menu_rules = __('Rules & Prizes', 'photo-contest');
	}
	if (empty($vote_menu_your_images)) {
	  $vote_menu_your_images = __('Your Images', 'photo-contest');
	}
	if (empty($vote_menu_top10)) {
	  $vote_menu_top10 = __('Top 10', 'photo-contest');
	}


	//Load color and style of menu
	$color_class = " " . $related_contest->menu_color;
	$style_class = " " . $related_contest->menu_style;

	//Menu animation
	$animation = get_option('pcplugin-allow-animation');
	if (!empty($animation)) {
		if ($animation == 1) {
			$animation = ' class="pc-menu-animation pc-menu-position"';
		}else {
			$animation = ' class="pc-menu-position"';
		}
	}else {
		$animation = ' class="pc-menu-animation"';
	}

	if ($menu_open==1 or empty($menu_open)){
		$menu_open_value =  '<li id="toggle"><a href="#pcmenu"><i class="fa fa-bars"></i></a></li>';
		$menu_open_value2=  '<li id="hide"><a href="#toggle"><i class="fa fa-bars"></i></a></li>';
	}else{
		$menu_open_value =  '<li id="toggle"><a><i class="fa fa-bars"></i></a></li>';
		$menu_open_value2=  '<li id="hide"><a><i class="fa fa-bars"></i></a></li>';
	}
	$html = '<div' . $animation . '>';
	$html .= '<div class="clear"></div><a name="img" class="imganchor"></a>';

	$menu_layout = get_option('pcplugin-menu-layout');
	if ($menu_layout == '1' or empty($menu_layout)) {
		include(plugin_dir_path( __DIR__ )."includes/menu/pc-menu-v1.php");
	}
	if ($menu_layout == '2') {
		include(plugin_dir_path( __DIR__ )."includes/menu/pc-menu-v2.php");
	}

	$html .= '</div>';
	$html .= '<div class="clear"></div>';//important


	}

?>
