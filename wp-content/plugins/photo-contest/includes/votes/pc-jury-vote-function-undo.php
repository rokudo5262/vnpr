<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

global $wpdb;
//Get info about item and the contest
$postid = $_POST['photo_id'];
$photo_related_to_contest = get_post_meta($postid,'photo-related-to-contest',true);
$related_contest = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$photo_related_to_contest);

$user_ID = get_current_user_id();


$jury_active = $related_contest->jury;
$contest_id = $related_contest->id;

$users_ids = get_post_meta($postid, 'contest-photo-users', true);
$users_ids = str_replace($user_ID.',', '', $users_ids);
update_post_meta($postid, 'contest-photo-users', $users_ids);

//Jury settings
$jury_members = $related_contest->jury_members;
$jury_members_array = explode(',', $jury_members);

if (in_array($user_ID, $jury_members_array)) {
  $jury_member = 1;
}else{
  $jury_member = 0;
}
if ($related_contest->jury == "2" and $jury_member == 1){
  $points = get_user_meta($user_ID, 'jury_member_votes_'.$contest_id, true);
  $points = $points - 1;
  update_user_meta($user_ID, 'jury_member_votes_'.$contest_id, $points);

  //Get Votes
  $votes = get_post_meta($postid, 'contest-photo-points', true);
  $votes = $votes - 1;

  //Save Votes
  update_post_meta($postid, 'contest-photo-points', $votes);

  //Delete vote from log
  $wpdb->delete( $wpdb->prefix . "photo_contest_votes", array( 'item_id' => $postid, 'user_id' => $user_ID, 'contest_id' => $contest_id,));

}
exit();
