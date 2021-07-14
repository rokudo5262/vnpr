<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

global $wpdb;

//Get info about item and the contest
$postid = $_POST['item_id'];
$rate_value = $_POST['value_id'];
$photo_related_to_contest = get_post_meta($postid,'photo-related-to-contest',true);
$related_contest = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$photo_related_to_contest);
$contest_id = $related_contest->id;
$vote_frequency = $related_contest->vote_frequency;
$user_ID = get_current_user_id();

//Check the date
$date = StrFTime('%m/%d/%Y', current_time('timestamp', 0));
$end = $related_contest->contest_end;
$voting = $related_contest->contest_vote_start;
$today_time = strtotime($date);
$expire_time = strtotime($end);
$voting_time = strtotime($voting);

/*************************/
/****Security-Checks******/
/*************************/

//Verify legality of vote
$nonce = $_POST['nonce_id'];
if ( ! wp_verify_nonce( $nonce, 'pc-nonce' ) ) {
  die( 'Security check' );
}

//Check end date
if($expire_time < $today_time){
  die( 'Date contest-expire check' );
}
//Check end date
if($voting_time > $today_time){
  die( 'Date vote-begin check' );
}

//Check IP address
if ($related_contest->vote_frequency ==5){
	$ips = $related_contest->ip_list;
}else{
	$ips = get_post_meta($postid, 'contest-photo-ip', true);
}
//Check
$ip_address = explode(',', $ips);
if ($related_contest->ip_protection==1 and in_array($_SERVER['REMOTE_ADDR'], $ip_address)) {
	die('ipcheck');
}

//Check if user already voted
if (is_user_logged_in()){
  $users_ids = get_post_meta($postid, 'contest-photo-users', true);
  if ($related_contest->vote_frequency ==5){
    $users_ids = $related_contest->user_vote_list;
  }else{
    $users_ids = get_post_meta($postid, 'contest-photo-users', true);
  }
  $ids_array = explode(',', $users_ids);

  if (in_array($user_ID, $ids_array)) {
  die;
  }

  if (empty($users_ids)) {
    $ids = $user_ID . ',';
    update_post_meta($postid, 'contest-photo-users', $ids);
  } else {
    if (!in_array($user_ID, $ids_array)) {
      $ids = $users_ids . $user_ID . ',';
      update_post_meta($postid, 'contest-photo-users', $ids);
    }
  }
}//end Check if user already voted

/*************************/
/***Security-Checks-END***/
/*************************/

//Get Image IP
if ($related_contest->vote_frequency ==5){
	$ips = $related_contest->ip_list;
}else{
	$ips = get_post_meta($postid, 'contest-photo-ip', true);
}

//Check
$ip_address = explode(',', $ips);
if ($related_contest->ip_protection==1 and in_array($_SERVER['REMOTE_ADDR'], $ip_address)) {
	die;
}

//Get Email
if (isset($_POST['email_id'])){
  $user_email = $_POST['email_id'];
}elseif (is_user_logged_in()){
  $user_info = get_userdata($user_ID);
  $user_email = $user_info->user_email;
}else{
  $user_email = 0;
}

//Get voter´s location
$geoPlugin_array = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']) );
if(!empty ($geoPlugin_array)){
  $country = $geoPlugin_array['geoplugin_countryName'];
  $country_code = $geoPlugin_array['geoplugin_countryCode'];
}else{
  $country = 0;
  $country_code = 0;
}

//Get category
$category_id = get_post_meta($postid,'contest-photo-category',true);
if(empty($category_id)){
  $category_id = 900000;
}

//Record User ID
if (is_user_logged_in()){
  if (empty($users_ids)) {
    $ids = $user_ID . ',';
    update_post_meta($postid, 'contest-photo-users', $ids);
   } else {
    if (!in_array($user_ID, $ids_array)) {
    $ids = $users_ids . $user_ID . ',';
    update_post_meta($postid, 'contest-photo-users', $ids);
    }
  }
}// is user logged in


if (!in_array($_SERVER['REMOTE_ADDR'], $ip_address)) {
	//Get Points
	if ($related_contest->vote_frequency ==6){$points = get_post_meta($postid, 'contest-photo-rate5', true);}
	if ($related_contest->vote_frequency ==7){$points = get_post_meta($postid, 'contest-photo-rate10', true);}

	//Record points 5 stars
	if ($related_contest->vote_frequency ==6){
		$rates_for_db = 'r'.$rate_value;
		if (empty($points)) {
	    $rates = $rate_value . ',';
			$v_ar = array();
			if ($rate_value==1){$v_ar[0]='1';}else{$v_ar[0]='0';}
			if ($rate_value==2){$v_ar[1]='1';}else{$v_ar[1]='0';}
			if ($rate_value==3){$v_ar[2]='1';}else{$v_ar[2]='0';}
			if ($rate_value==4){$v_ar[3]='1';}else{$v_ar[3]='0';}
			if ($rate_value==5){$v_ar[4]='1';}else{$v_ar[4]='0';}

			$list_of_values= $v_ar[0].','.$v_ar[1].','.$v_ar[2].','.$v_ar[3].','.$v_ar[4];
			update_post_meta($postid, 'contest-photo-rate5', $list_of_values);
			update_post_meta($postid, 'contest-photo-rate5-total', $rate_value);
			$rating_total_count= $v_ar[0]+$v_ar[1]+$v_ar[2]+$v_ar[3]+$v_ar[4];
	   } else {
			$v_ar = explode(',', $points);
			if ($rate_value==1){$v_ar[0]=$v_ar[0]+1;}
			if ($rate_value==2){$v_ar[1]=$v_ar[1]+1;}
			if ($rate_value==3){$v_ar[2]=$v_ar[2]+1;}
			if ($rate_value==4){$v_ar[3]=$v_ar[3]+1;}
			if ($rate_value==5){$v_ar[4]=$v_ar[4]+1;}
			$list_of_values= $v_ar[0].','.$v_ar[1].','.$v_ar[2].','.$v_ar[3].','.$v_ar[4];
			update_post_meta($postid, 'contest-photo-rate5', $list_of_values);
			$rating_total_value= $v_ar[0]*1+$v_ar[1]*2+$v_ar[2]*3+$v_ar[3]*4+$v_ar[4]*5;
			$rating_total_count= $v_ar[0]+$v_ar[1]+$v_ar[2]+$v_ar[3]+$v_ar[4]+$v_ar[5];
			$rate_value = $rating_total_value/$rating_total_count;
			update_post_meta($postid, 'contest-photo-rate5-total', $rate_value);
	  }
	}//Record points 5 stars

	//Record points 10 stars
	if ($related_contest->vote_frequency ==7){
	  $rates_for_db = 'd'.$rate_value;
	  if (empty($points)) {
			$v_ar = array();
			if ($rate_value==1){$v_ar[0]='1';}else{$v_ar[0]='0';}
			if ($rate_value==2){$v_ar[1]='1';}else{$v_ar[1]='0';}
			if ($rate_value==3){$v_ar[2]='1';}else{$v_ar[2]='0';}
			if ($rate_value==4){$v_ar[3]='1';}else{$v_ar[3]='0';}
			if ($rate_value==5){$v_ar[4]='1';}else{$v_ar[4]='0';}
			if ($rate_value==6){$v_ar[5]='1';}else{$v_ar[5]='0';}
			if ($rate_value==7){$v_ar[6]='1';}else{$v_ar[6]='0';}
			if ($rate_value==8){$v_ar[7]='1';}else{$v_ar[7]='0';}
			if ($rate_value==9){$v_ar[8]='1';}else{$v_ar[8]='0';}
			if ($rate_value==10){$v_ar[9]='1';}else{$v_ar[9]='0';}
			$list_of_values= $v_ar[0].','.$v_ar[1].','.$v_ar[2].','.$v_ar[3].','.$v_ar[4].','.$v_ar[5].','.$v_ar[6].','.$v_ar[7].','.$v_ar[8].','.$v_ar[9];
			update_post_meta($postid, 'contest-photo-rate10', $list_of_values);
			update_post_meta($postid, 'contest-photo-rate10-total', $rate_value);
			$rating_total_count= $v_ar[0]+$v_ar[1]+$v_ar[2]+$v_ar[3]+$v_ar[4]+$v_ar[5]+$v_ar[6]+$v_ar[7]+$v_ar[8]+$v_ar[9];
	   } else {
			$v_ar = explode(',', $points);
			if ($rate_value==1){$v_ar[0]=$v_ar[0]+1;}
			if ($rate_value==2){$v_ar[1]=$v_ar[1]+1;}
			if ($rate_value==3){$v_ar[2]=$v_ar[2]+1;}
			if ($rate_value==4){$v_ar[3]=$v_ar[3]+1;}
			if ($rate_value==5){$v_ar[4]=$v_ar[4]+1;}
			if ($rate_value==6){$v_ar[5]=$v_ar[5]+1;}
			if ($rate_value==7){$v_ar[6]=$v_ar[6]+1;}
			if ($rate_value==8){$v_ar[7]=$v_ar[7]+1;}
			if ($rate_value==9){$v_ar[8]=$v_ar[8]+1;}
			if ($rate_value==10){$v_ar[9]=$v_ar[9]+1;}
			$list_of_values= $v_ar[0].','.$v_ar[1].','.$v_ar[2].','.$v_ar[3].','.$v_ar[4].','.$v_ar[5].','.$v_ar[6].','.$v_ar[7].','.$v_ar[8].','.$v_ar[9];
			update_post_meta($postid, 'contest-photo-rate10', $list_of_values);
			$rating_total_value= $v_ar[0]*1+$v_ar[1]*2+$v_ar[2]*3+$v_ar[3]*4+$v_ar[4]*5+$v_ar[5]*6+$v_ar[6]*7+$v_ar[7]*8+$v_ar[8]*9+$v_ar[9]*10;
			$rating_total_count= $v_ar[0]+$v_ar[1]+$v_ar[2]+$v_ar[3]+$v_ar[4]+$v_ar[5]+$v_ar[6]+$v_ar[7]+$v_ar[8]+$v_ar[9];
			$rate_value = $rating_total_value/$rating_total_count;
			update_post_meta($postid, 'contest-photo-rate10-total', $rate_value);
	  }
	}//Record points 10 stars


  //Insert to DB
  $wpdb->insert($wpdb->prefix . "photo_contest_votes", array(
  'item_id' => $postid,
  'contest_id' => $related_contest->id,
  'user_id' => $user_ID,
  'vote_date' => current_time( 'timestamp' ),
  'email' => $user_email,
  'ip_address' => $_SERVER['REMOTE_ADDR'],
  'country' => $country,
  'country_code' => $country_code,
  'category_id' => $category_id,
	'vote_rating_value' => $rates_for_db
  ));
}

//Record IP related to image
if ($related_contest->ip_protection==1 and $vote_frequency!=5){
	if (empty($ips)) {
	  $ips = $_SERVER['REMOTE_ADDR'] . ',';
	  update_post_meta($postid, 'contest-photo-ip', $ips);
	} else {
		if (!in_array($_SERVER['REMOTE_ADDR'], $ip_address)) {
	    $ips = $ips . $_SERVER['REMOTE_ADDR'] . ',';
	    update_post_meta($postid, 'contest-photo-ip', $ips);
			}
	}//end Record IP related to image
}

//Record user IP
if ($vote_frequency==5 and $related_contest->ip_protection==1) {
  //Get users ID
  $contest_ips        = $related_contest->ip_list;
  $contest_ip_address = explode(',', $contest_ips);
  if (empty($contest_ips)) {
    $ips = $_SERVER['REMOTE_ADDR'] . ',';
    $wpdb->update(
    $wpdb->prefix.'photo_contest_list',
    array(
    'ip_list' => $ips,	// string
    ),
    array( 'id' => $related_contest->id )
    );
  } else {
    if (!in_array($_SERVER['REMOTE_ADDR'], $contest_ip_address)) {
      $ips = $contest_ips . $_SERVER['REMOTE_ADDR'] . ',';
      $wpdb->update(
      $wpdb->prefix.'photo_contest_list',
      array(
      'ip_list' => $ips,	// string
      ),
      array( 'id' => $related_contest->id )
      );
    }
  }
}//end Record user IP

//Record user ID
if (is_user_logged_in()){
  if ($vote_frequency==5) {
    //Users_vote_list
    $users_vote_list = $related_contest->user_vote_list;
    $users_vote_list_explode = explode(',', $users_vote_list);
    if (empty($users_vote_list)) {
      $ids = $user_ID . ',';
      $wpdb->update(
         $wpdb->prefix.'photo_contest_list',
        array(
          'user_vote_list' => $ids,	// string
           ),
        array( 'id' => $related_contest->id )
           );
    } else {
      if (!in_array($_SERVER['REMOTE_ADDR'], $users_vote_list_explode)) {
        $ids = $users_vote_list . $user_ID . ',';
        $wpdb->update(
           $wpdb->prefix.'photo_contest_list',
          array(
            'user_vote_list' => $ids,	// string
             ),
          array( 'id' => $related_contest->id )
             );
      }
    }
  }
}///Record user ID end

//Set Cookie for the Rate
$cookie_ID       = 'photo_rate_' . $postid;
if (!isset($_COOKIE[$cookie_ID])) {
  setcookie($cookie_ID , $postid, time() + 3600 * 360 * 24 * 2, COOKIEPATH, COOKIE_DOMAIN, false);
}//end Set Cookie for Vote


//BuddyPress
if (function_exists('bp_activity_add') and is_user_logged_in() and $related_contest->contest_mode == 1) {
	include_once(dirname(__DIR__)."/pc-BuddyPress.php");
	pc_buddy_press_rate($postid,$related_contest->page_id);
}//BuddyPress

$html  = '';
if ($related_contest->vote_frequency ==6){
	$numberofstars=5;
	$rating = get_post_meta($postid, 'contest-photo-rate5', true);
	$rating_total = get_post_meta($postid, 'contest-photo-rate5-total', true);
}
if ($related_contest->vote_frequency ==7){
	$numberofstars=10;
	$rating = get_post_meta($postid, 'contest-photo-rate10', true);
	$rating_total = get_post_meta($postid, 'contest-photo-rate10-total', true);
}
if (empty($rating)){$html .= '<span>' . __('Rating:', 'photo-contest') . ' ' . __('Not rated yet!', 'photo-contest') . '</span> ';}
if (!empty($rating)){
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
echo $html;
wp_die();
