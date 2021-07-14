<?php

if (!defined('WPINC')) {
    die;
}
global $wpdb;
//Get info about item and the contest
$postid = $_POST['photo_id'];
$photo_related_to_contest = get_post_meta($postid, 'photo-related-to-contest', true);
$related_contest = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "photo_contest_list WHERE id = " . $photo_related_to_contest);

$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
$user_email = $user_info->user_email;

//Get category
$category_id = get_post_meta($postid, 'contest-photo-category', true);
if (empty($category_id)) {
    $category_id = 900000;
}

//Get voter´s location
$geoPlugin_array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
if (!empty ($geoPlugin_array)) {
    $country = $geoPlugin_array['geoplugin_countryName'];
    $country_code = $geoPlugin_array['geoplugin_countryCode'];
} else {
    $country = 0;
    $country_code = 0;
}


$jury_active = $related_contest->jury;
$contest_id = $related_contest->id;

//Check if user already voted and record that user properly
if (is_user_logged_in()) {
    $users_ids = get_post_meta($postid, 'contest-photo-users', true);
    if ($related_contest->vote_frequency == 5) {
        $users_ids = $related_contest->user_vote_list;
    } else {
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
} else {
    $jury_member = 0;
}

if ($related_contest->jury == "2" and $jury_member == 1) {
    $points = get_user_meta($user_ID, 'jury_member_votes_' . $contest_id, true);
    if(empty($points)){
        $points = 0;
    }
    $points = $points + 1;

    update_user_meta($user_ID, 'jury_member_votes_' . $contest_id, $points);

    //Get Votes
    $votes = get_post_meta($postid, 'contest-photo-points', true);
    $votes = $votes + 1;

    //Save Votes
    update_post_meta($postid, 'contest-photo-points', $votes);

    //Insert to DB
    $wpdb->insert($wpdb->prefix . "photo_contest_votes", [
        'item_id' => $postid,
        'contest_id' => $contest_id,
        'user_id' => $user_ID,
        'vote_date' => current_time('timestamp'),
        'email' => $user_email,
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'country' => $country,
        'country_code' => $country_code,
        'category_id' => $category_id

    ]);

}
exit();
