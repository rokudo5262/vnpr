<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

//BuddyPress - Comments
function pc_buddy_press_comments(){

  $user_ID  = get_current_user_id();
  $args     = array(
      'author__in' => $user_ID,
      'number' => '1',
      'post_id' => $_GET['photo_id'],
      'status' => 'all',
      'order' => 'DESC'
  );
  $comments = get_comments($args);
  if (!empty($comments)) {
      foreach ($comments as $comment):
        $allow_comments = get_option('pcplugin-allow_buddy_comments');
        if ($allow_comments == 2) {
            $userlink         = bp_core_get_userlink($user_ID);
            $detail_link      = get_permalink() . '?contest=photo-detail&photo_id=' . $_GET['photo_id'] . '#comment-' . $comment->comment_ID;
            $image_attributes = wp_get_attachment_image_src($_GET['photo_id'], 'gallery-middle-widget');
            $action_text      = $userlink . ' ' . sprintf(__('added a new <a href="%s">comment</a> in <a href="%s">Photo Contest</a>', 'photo-contest'), esc_url($detail_link), esc_url(get_permalink()));
            $action    = $action_text;
            $component = 'bp-photo-contest-activity';
            $type= 'comment_update'; //filtering in activity stream
            $content   = '<a href="' . $detail_link . '"><img src="' . $image_attributes[0] . '" alt=""></a><hr>' . $comment->comment_content . '';
            bp_activity_add(array(
                'user_id' => $user_ID,
                'action' => $action,
                'content' => $content,
                'component' => $component,
                'primary_link' => $detail_link,
                'type' => $type
            ));
        }
      endforeach;
  }

}

//BuddyPress - Upload
function pc_buddy_press_upload($attach_id){
  $allow_images = get_option('pcplugin-allow_buddy_images');
  if ($allow_images == 2) {
    $user_ID  = get_current_user_id();
    $userlink         = bp_core_get_userlink($user_ID);
    $image_attributes = wp_get_attachment_image_src($attach_id, 'gallery-middle-widget');
    $detail_link      = get_permalink() . '?contest=photo-detail&photo_id=' . $attach_id . '';
    $action_text      = $userlink . ' ' . sprintf(__('added a new <a href="%s">photo</a> in <a href="%s">Photo Contest</a>', 'photo-contest'), esc_url($detail_link), esc_url(get_permalink()));
    $action    = $action_text;
    $component = 'bp-photo-contest-activity';
    $type      = 'contest_image_upload'; //filtering in activity stream
    $content   = '<a href="' . $detail_link . '"><img src="' . $image_attributes[0] . '"></a>';
    bp_activity_add(array(
    'user_id' => $user_ID,
    'action' => $action,
    'content' => $content,
    'component' => $component,
    'primary_link' => $detail_link,
    'type' => $type
    ));
  }
}

//BuddyPress Rating
function pc_buddy_press_rate($postid,$pageid){

	$allow_votes = get_option('pcplugin-allow_buddy_votes');
	if ($allow_votes == 2) {
		$user_ID  = get_current_user_id();
		$userlink = bp_core_get_userlink($user_ID);
    $image_attributes = wp_get_attachment_image_src($postid, 'gallery-middle-widget');
		$detail_link = get_page_link($pageid) . '?contest=photo-detail&photo_id=' . $postid . '';
		$action_text = $userlink . ' ' . sprintf(__('rated <a href="%s">a photo</a> in <a href="%s">Photo Contest</a>', 'photo-contest'), esc_url($detail_link), esc_url(get_page_link($pageid)));
		$action    = $action_text;
		$component = 'bp-photo-contest-activity';
		$type      = 'photo_rating_update'; //filtering in activity stream
		$content   = '<a href="' . $detail_link . '"><img src="' . $image_attributes[0] . '"></a>';
		bp_activity_add(array(
		'user_id' => $user_ID,
		'action' => $action,
		'content' => $content,
		'component' => $component,
		'primary_link' => $detail_link,
		'type' => $type
		));
	}

}

//BuddyPress
function pc_buddy_press_vote($postid,$pageid){
		$allow_votes = get_option('pcplugin-allow_buddy_votes');
		if ($allow_votes == 2) {
			$user_ID  = get_current_user_id();
			$userlink = bp_core_get_userlink($user_ID);
			$image_attributes = wp_get_attachment_image_src($postid, 'gallery-middle-widget');
	    $detail_link =  get_page_link($pageid).'?contest=video-detail&video_id='.$postid.'';
	    $action_text = $userlink.' '.sprintf(__( 'voted for <a href="%s">photo</a> in <a href="%s">Photo Contest</a>', 'photo-contest'), esc_url( $detail_link ), esc_url( get_page_link($pageid) ));
			$action    = $action_text;
			$component = 'bp-photo-contest-activity';
			$type      = 'photo_voting_update'; //filtering in activity stream
			$content   = '<a href="' . $detail_link . '"><img src="' . $image_attributes[0] . '"></a>';
			bp_activity_add(array(
			'user_id' => $user_ID,
			'action' => $action,
			'content' => $content,
			'component' => $component,
			'primary_link' => $detail_link,
			'type' => $type
			));
		}
}//function pc_buddy_press_vote
