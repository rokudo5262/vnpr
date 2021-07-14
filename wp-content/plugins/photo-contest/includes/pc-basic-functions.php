<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Show/Hide Admin Bar
add_action('after_setup_theme', 'pcplugin_remove_admin_bar');
function pcplugin_remove_admin_bar() {
	    $show_adminbar = get_option('pcplugin-show-adminbar');
		if($show_adminbar =='2'){
		if (!current_user_can('administrator') && !is_admin()) {
		  show_admin_bar(false);
		}
	}
}

//Show Image Views
function getContestViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}

//Set Image Views
function setContestViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//Text Shorterer
function contest_shorter($text, $chars_limit) {
  if (strlen($text) > $chars_limit) {
    $rpos = strrpos(substr($text, 0, $chars_limit), " ");
    if ($rpos!==false) {
      // if there's whitespace, cut off at last whitespace
      return substr($text, 0, $rpos).'...';
    }else{
      // otherwise, just cut after $chars_limit chars
      return substr($text, 0, $chars_limit).'...';
    }
  } else {
    return $text;
  }
}
//Check the email
function pc_is_disposable_mail($mail) {
	$file =  plugin_dir_path( __DIR__  ) . "assets/disposable_email_blacklist.conf";
	$disposable_list = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

	$domain = substr(strrchr($mail, "@"), 1); //extract domain name from email

	if(in_array($domain, $disposable_list)){
		$mail_in= 1;
	}else{
		$mail_in= 2;
	}

return $mail_in;
}
//Cookie Checker
function pc_cookiechecker($vote_frequency,$image_ID) {
	if (isset($_COOKIE[$image_ID])) {

			if ($vote_frequency == '1') {
					if ($_COOKIE[$image_ID] != '1') {
							setcookie($image_ID, '1', time() - 3600, COOKIEPATH, COOKIE_DOMAIN, false);
					}
					;
			} elseif ($vote_frequency == '2') {
					if ($_COOKIE[$image_ID] != '2') {
							setcookie($image_ID, '2', time() - 3600, COOKIEPATH, COOKIE_DOMAIN, false);
					}
					;
			} elseif ($vote_frequency == '3') {
					if ($_COOKIE[$image_ID] != '3') {
							setcookie($image_ID, '3', time() - 3600, COOKIEPATH, COOKIE_DOMAIN, false);
					}
					;
			} elseif ($vote_frequency == '4') {
					if ($_COOKIE[$image_ID] != '4') {
							setcookie($image_ID, '4', time() - 3600, COOKIEPATH, COOKIE_DOMAIN, false);
					}
					;
			}

	} //end if isset cookie
}

function pc_create_stars($item_id) {
	$related_contest = $GLOBALS['photo_contest'];
	$html = '';
	if ($related_contest->vote_frequency ==6){
		$numberofstars=5;
		$rating = get_post_meta($item_id, 'contest-photo-rate5', true);
		$rating_total = get_post_meta($item_id, 'contest-photo-rate5-total', true);
	}
	if ($related_contest->vote_frequency ==7){
		$numberofstars=10;
		$rating = get_post_meta($item_id, 'contest-photo-rate10', true);
		$rating_total = get_post_meta($item_id, 'contest-photo-rate10-total', true);
	}
	if (empty($rating)){$html .= '<span>' . __('Rating:', 'photo-contest') . ' ' . __('Not rated yet!', 'photo-contest') . '</span> ';}
	if (!empty($rating)){
		
		if ($related_contest->vote_frequency ==6){
			//Count all total rates
			$v_ar = explode(',', $rating);
			$rating_total_count= $v_ar[0]+$v_ar[1]+$v_ar[2]+$v_ar[3]+$v_ar[4];
		}
		if ($related_contest->vote_frequency ==7){
			//Count all total rates
			$v_ar = explode(',', $rating);
			$rating_total_count= $v_ar[0]+$v_ar[1]+$v_ar[2]+$v_ar[3]+$v_ar[4]+$v_ar[5]+$v_ar[6]+$v_ar[7]+$v_ar[8]+$v_ar[9];
		}

		$html .= '<span>' . __('Rating:', 'photo-contest') . '</span> ';

		//Calculate number of stars
		$rating_stars = round($rating_total,2);
		$stars = round( $rating_stars  * 2, 0, PHP_ROUND_HALF_UP);

		// Add full stars:
		$i = 1;
		$d = 0;
		while ($i <= $stars - 1) {
			$html .= '<i class="fa fa-star" aria-hidden="true"></i>';
			$i += 2;
			$d++;
		}
		// Add half star if needed:

		if ( $stars & 1 ) {
			$html .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
			$d++;
		}
		//Empty stars
		if ($related_contest->vote_frequency ==6){
			$a = 5-$d;
		}
		if ($related_contest->vote_frequency ==7){
			$a = 10-$d;
		}
		for ($x = 0; $x < $a; $x++) {
			$html .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
		}
		$html .= '&nbsp;&nbsp;<span>('.$rating_stars.'/'.$numberofstars.') - '.$rating_total_count.'<span style="text-transform:lowercase;">x</span> ' . __('rated', 'photo-contest') . ' </span>';//Empty stars end

	}
	return $html;
}

?>
