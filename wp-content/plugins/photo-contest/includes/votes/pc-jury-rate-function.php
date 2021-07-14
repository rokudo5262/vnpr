<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}
global $wpdb;
//Get info about item and the contest
$postid = $_POST['photo_id'];
$photo_related_to_contest = get_post_meta($postid,'photo-related-to-contest',true);
$related_contest = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$photo_related_to_contest);

$rate_value = $_POST['value_id'];

$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
$user_email = $user_info->user_email;

//Get category
$category_id = get_post_meta($postid,'contest-photo-category',true);
if(empty($category_id)){
  $category_id = 900000;
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


$jury_active = $related_contest->jury;
$contest_id = $related_contest->id;

//Check if user already voted and record that user properly
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

//Jury settings
$jury_members = $related_contest->jury_members;
$jury_members_array = explode(',', $jury_members);

if (in_array($user_ID, $jury_members_array)) {
  $jury_member = 1;
}else{
  $jury_member = 0;
}

if ($related_contest->jury == "2" and $jury_member == 1){

  if(!empty($rate_value)){
    //Get Rates
    $points = get_post_meta($postid, 'contest-photo-rate10', true);
    $rates_for_db = 'd'.$rate_value;
	  if (empty($points)) {;
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
  }



  //Insert to DB
  $wpdb->insert($wpdb->prefix . "photo_contest_votes", array(
  'item_id' => $postid,
  'contest_id' => $contest_id,
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
exit();
