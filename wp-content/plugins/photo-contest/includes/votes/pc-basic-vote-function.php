<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}
//Basic public vote/like system
global $wpdb;
//Verify legality of vote
$nonce = $_POST['nonce_id'];
if ( ! wp_verify_nonce( $nonce, 'pc-nonce' ) ) {
  die( 'Security check' );
}
//Get info about item and the contest
$postid = $_POST['photo_id'];
$photo_related_to_contest = get_post_meta($postid,'photo-related-to-contest',true);
$related_contest = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$photo_related_to_contest);

//Get contest info
$vote_frequency = $related_contest->vote_frequency;

//Get user info
$user_ID = get_current_user_id();

//Set Item ID
if (isset($_GET['item-id'])){
  $postid = $_GET['item-id'];
}else{
  $postid = $_POST['photo_id'];
}
//Get Points
$points = get_post_meta($postid, 'contest-photo-points', true);
$points = $points + 1;

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


//Check the date
$date = StrFTime('%m/%d/%Y', current_time('timestamp', 0));
$end = $related_contest->contest_end;
$voting = $related_contest->contest_vote_start;
$today_time = strtotime($date);
$expire_time = strtotime($end);
$voting_time = strtotime($voting);

//Check end date
if($expire_time < $today_time){
     die( 'Date check' );
}
//Check vote start date
if($voting_time > $today_time){
  die( 'Date vote-begin check' );
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

//Calculate vote
  update_post_meta($postid, 'contest-photo-points', $points);
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
  'category_id' => $category_id
  ));
//end Calculate vote

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
}

$image_ID       = 'image_vote_' . $postid;
$contest_vote_ID       = 'vote_contest_id_' . $related_contest->id;
$vote_frequency = $related_contest->vote_frequency;

//Set Cookie for LIKE
if (!isset($_COOKIE[$image_ID]) and $vote_frequency != '5') {

  if ($vote_frequency == '1') {
    setcookie($image_ID, $vote_frequency, time() + 3600 * 24 * 100, COOKIEPATH, COOKIE_DOMAIN, false);
  } elseif ($vote_frequency == '2') {
    setcookie($image_ID, $vote_frequency, time() + 3600 * 24, COOKIEPATH, COOKIE_DOMAIN, false);
  } elseif ($vote_frequency == '3') {
    setcookie($image_ID, $vote_frequency, time() + 3600 * 12, COOKIEPATH, COOKIE_DOMAIN, false);
  } elseif ($vote_frequency == '4') {
    setcookie($image_ID, $vote_frequency, time() + 3600, COOKIEPATH, COOKIE_DOMAIN, false);
  }

}//end Set Cookie for LIKE

//Set Cookie for Vote
if (!isset($_COOKIE[$contest_vote_ID]) and $vote_frequency == '5') {
  setcookie($contest_vote_ID, $vote_frequency, time() + 3600 * 360 * 24 * 10, COOKIEPATH, COOKIE_DOMAIN, false);
}//end Set Cookie for Vote

//BuddyPress
if (function_exists('bp_activity_add') and is_user_logged_in() and $related_contest->contest_mode == 1) {
  include_once(dirname(__DIR__)."/pc-BuddyPress.php");
  pc_buddy_press_vote($postid,$related_contest->page_id);
}//BuddyPress



    exit();
