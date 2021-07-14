<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Include functions
$allow_comments = get_option('pcplugin-allow-comments');

//Redirect to share page
if (isset($_GET['photo_id']) and isset($_GET['vote'])) {
	$redirect_url = add_query_arg(array(
	'contest' => 'contest-share',
	'item-id' => $_GET['photo_id'],
	'after' => 'vote'
	), $current_url);
	wp_redirect( $redirect_url );
	exit;
}

//Redirect If is photo ID empty
if (!isset($_GET["photo_id"])) {
    wp_redirect($current_url);
}

//If contest not exist
if (empty($related_contest)) {
    wp_redirect($current_url);
}

//If is there Upload form mode
if ($related_contest->contest_mode != 1){
  wp_redirect($current_url);
}

//Redirect If photo is related to another contest
$photo_related_to_contest = get_post_meta($_GET["photo_id"], 'photo-related-to-contest', true);
if ($photo_related_to_contest != $related_contest->id) {
    wp_redirect($current_url);
}
//Set Views
if (isset($_GET['photo_id'])) {
    $photo_id = $_GET['photo_id'];
    setContestViews($photo_id);
}
//Get Basic info
$photo_id  = $_GET['photo_id'];
$author_id = get_post_meta($photo_id, 'contest-photo-author', true);
$user      = get_user_by('id', $author_id);
$votes     = get_post_meta($photo_id, 'contest-photo-points', true);
$views     = getContestViews($photo_id);
$allow_reCaptcha = get_option('pcplugin-allow-reCaptcha');
$allow_redirect  = get_option('pcplugin-redirect-after-vote');
$photo    = get_post($photo_id);
$title    = $photo->post_title;
$blogurl  = home_url('url');
$lightbox = get_option('pcplugin-allow-lightbox');


//IP protection
$ip_protection = $related_contest->ip_protection;
if ($ip_protection == '2') {
	$ips = update_post_meta($photo_id, 'contest-photo-ip', "");
	$wpdb->update(
	$wpdb->prefix.'photo_contest_list',
		array(
		'ip_list' => "",	// string
		 ),
		array( 'id' => $related_contest->id )
	 );
}

//BuddyPress - Comments
if (isset($_GET['pc-comment']) and function_exists('bp_activity_add')) {
	include_once(dirname(__DIR__)."/includes/pc-BuddyPress.php");
	pc_buddy_press_comments();
}

$html = '<div class="photo-contest' . $animation . ' ' . $font_size . '">';
$image_attributes = wp_get_attachment_image_src($photo_id, 'pc-large');
if ($lightbox == '1' or empty($lightbox)) {
	$html .= '<div class="photo-contest-image"><img src="' . $image_attributes[0] . '" border="0">';
}
if ($lightbox == '2') {
	$html .= '<script src="'.plugins_url().'/photo-contest/assets/lightbox/lightbox.js"></script><div class="photo-contest-image"><a href="' . wp_get_attachment_url($photo_id) . '" data-lightbox="image-1"><img src="' . $image_attributes[0] . '" border="0"></a>';
}
if ($lightbox == '3') {
	$html .= '<script src="'.plugins_url().'/photo-contest/assets/lightbox/lightbox.js"></script><div class="photo-contest-image"><a href="' . wp_get_attachment_url($photo_id) . '" data-lightbox="image-1"><img src="' . $image_attributes[0] . '" border="0"></a>';
}

//Prev Next
$args = array(
    'post_type' => 'attachment',
    'posts_per_page' => -1,
    'post_status' => 'any',
    'post_parent' => null,
    'meta_key' => 'photo-related-to-contest',
    'meta_value' => $related_contest->id,
    'meta_query' => array(
        array(
            'key' => 'contest-active',
            'value' => '1'
        )
    )
);

$all_attachments_id = array();
$iterator           = 1;
$attachments        = get_posts($args);
if ($attachments) {
    foreach ($attachments as $contestitem) {

        $all_attachments_id[$iterator] = $contestitem->ID;

        if ($_GET['photo_id'] == $contestitem->ID) {
            $offset = $iterator;
        }

        $iterator++;
    }
}

if (empty($offset)) {
	$offset = $_GET["photo_id"];
}
if (!empty($all_attachments_id[$offset - 1])) {
	$blogurl_minus = add_query_arg(array(
	'contest' => 'photo-detail',
	'photo_id' => $all_attachments_id[$offset - 1]
	), $current_url);
	$html .= '<a class="previous_photo" href="' . $blogurl_minus . '#img" onclick="javascript:location.href=\'' . $blogurl_minus . '#img\'"><img src="' . plugins_url() . '/photo-contest/assets/next.png" alt="' . __('Previous photo', 'photo-contest') . '" title="' . __('Previous photo', 'photo-contest') . '"></a>';
}
if (!empty($all_attachments_id[$offset + 1])) {
	$blogurl_plus = add_query_arg(array(
	'contest' => 'photo-detail',
	'photo_id' => $all_attachments_id[$offset + 1]
	), $current_url);
	$html .= '<a class="next_photo" href="' . $blogurl_plus . '#img" onclick="javascript:location.href=\'' . $blogurl_plus . '#img\'"><img src="' . plugins_url() . '/photo-contest/assets/previous.png" alt="' . __('Next photo', 'photo-contest') . '" title="' . __('Next photo', 'photo-contest') . '"></a>';
}

$html .= '</div>';

$ogurl        = add_query_arg(array('contest' => 'photo-detail','photo_id' => $_GET['photo_id']), $current_url);
$ogurl_encode = urlencode($ogurl);
$jury_members = $related_contest->jury_members;
$jury_members_array = explode(',', $jury_members);
$jury_member = 0;

if (in_array($current_user->ID, $jury_members_array) and is_user_logged_in()) {
  $jury_member = 1;
}

	//Image info box


$html .= '<div class="pc-image-info-box">';

$html .= '<div class="pc-image-info-box-button">';

if ($related_contest->jury == "2" and $jury_member == 1){
	if ($related_contest->jury_vote_type ==1){
		include (plugin_dir_path( __DIR__ ) ."includes/votes/pc-jury-vote-code.php");
	}
	if ($related_contest->jury_vote_type ==2){
		include (plugin_dir_path( __DIR__ ) ."includes/votes/pc-jury-rate-code.php");
	}
}elseif ($related_contest->jury == "2" and $jury_member == 0){

}else{
	if ($related_contest->vote_frequency <=5){
		include (plugin_dir_path( __DIR__ ) ."includes/votes/pc-basic-vote-code.php");
	}
	if ($related_contest->vote_frequency ==6 or $related_contest->vote_frequency ==7){
		include (plugin_dir_path( __DIR__ ) ."includes/votes/pc-rate-code.php");
 	}
}

$html .= '</div>'; //pc-image-info-box-button

//InfoBox
$html .= '<div class="pc-image-info-box-text">';

$category_id = get_post_meta($photo_id, 'contest-photo-category', true);

$html .= '<div class="pc-main-title">';
$html .= '<span>' . __('Title:', 'photo-contest') . '</span> ' . $title . '';
$html .= '</div>'; //pc-main-title

////////
//Author
////////
if (!empty($user)) {
	$author = $user->display_name;
} elseif (empty($user) and !empty($photo_username)) {
	$author = $photo_username;
} else {
	$author = __('Deleted user', 'photo-contest');
}
//Hide Author
if ($related_contest->hide_author == "2" and !is_super_admin()) {
	$hide_author = " pc_displaynone";
} else {
	$hide_author = "";
}
//Display Author
$html .= '<div class="pc-main-author' . $hide_author . '">';
$html .= '<span>' . __('Author:', 'photo-contest') . '</span> ' . $author . '';
$html .= '</div>'; //pc-main-author


//Votes
if ($related_contest->hide_votes == "2" and !is_super_admin()) {
	$hide_votes = " pc_displaynone";
	$votes      = "?";
} else {
	$hide_votes = " pc_visible";
}
//Display Votes
$html .= '<div class="pc-main-votes' . $hide_votes . '">';
if ($related_contest->vote_frequency <=5){
	$html .= '<span>' . __('Votes:', 'photo-contest') . '</span> <span class="pc-votes-count">'.$votes.'</span>';
}
//Show rating
if ($related_contest->vote_frequency ==6 or $related_contest->vote_frequency ==7){
	$html .= '<span class="starsfield">';//important
	$html .= pc_create_stars($photo_id);
	$html .= '</span>';
}
$html .= '</div>'; //pc-main-votes

$html .= '<hr/>'; //pc-main-author

$html .= '<div class="pc-main-others">';

//Categories
if (!empty($category_id) and $category_id != 900000) {
	$category      = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "photo_contest_cat WHERE id = " . $category_id . "");
	$category_name = $category->name;
	$html .= '<div><span>' . __('Category:', 'photo-contest') . '</span> ' . stripslashes($category_name) . '</div>';
}

//Views
if ($related_contest->hide_views == "2" and !is_super_admin()) {
	$hide_views = " pc_displaynone";
	$views      = "?";
} else {
	$hide_views = " pc_visible";
}
$html .= '<div class="' . $hide_views . '"><span>' . __('Views:', 'photo-contest') . '</span> ' . $views . '</div>';

//Description
if (!empty($photo->post_content)) {
	$html .= '<div><span>' . __('Description:', 'photo-contest') . '</span> ' . stripslashes($photo->post_content) . '</div>';
}
$html .= '</div>'; //pc-main-author

//Social Icons
if ($related_contest->hide_social == "1") {
$html .= '<ul class="pc-social">';
$html .= '<li class="pc-showlink"><i class="fa fa-lg fa-link"></i></li>';
$html .= '<li class="pc-showqrcode"><i class="fa fa-lg fa-qrcode"></i></li>';
$html .= '<li><a href="https://www.facebook.com/sharer.php?u=' . $ogurl_encode . '&t=' . $title . '" target="_blank"><i class="fa fa-fw fa-lg fa-facebook"></i></a></li>';
$html .= '<li><a href="https://twitter.com/intent/tweet?source=SOURCE&text=' . $title . '&url=' . $ogurl_encode . '" target="_blank"><i class="fa fa-fw fa-lg fa-twitter"></i></a></li>';
$html .= '<li><a href="https://pinterest.com/pin/create/link/?url=' . $ogurl_encode . '&description=' . $title . '&media=' . urlencode(wp_get_attachment_url($photo_id)) . '" target="_blank"><i class="fa fa-fw fa-lg fa-pinterest"></i></a></li>';
$html .= '<li><a href="https://www.tumblr.com/share/link?url=' . $ogurl_encode . '&name=' . $title . '" target="_blank"><i class="fa fa-fw fa-lg fa-tumblr"></i></a></li>';
$html .= '<li><a href="https://reddit.com/submit?url=' . $ogurl_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-fw fa-lg fa-reddit"></i></a></li>';
$html .= '<li><a href="https://del.icio.us/post?url=' . $ogurl_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-lg fa-delicious"></i></a></li>';
$html .= '<li><a href="https://digg.com/submit?url=' . $ogurl_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-fw fa-lg fa-digg"></i></a></li>';
$html .= '<li><a href="https://www.stumbleupon.com/submit?url=' . $ogurl_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-fw fa-lg fa-stumbleupon"></i></a></li>';
$html .= '<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=' . $ogurl_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-fw fa-lg fa-linkedin"></i></a></li>';
$html .= '<li><a href="https://vk.com/share.php?url=' . $ogurl_encode . '" target="_blank"><i class="fa fa-fw fa-lg fa-vk"></i></a></li>';
$html .= '<li><a href="whatsapp://send?text=' . $ogurl_encode . '" data-action="share/whatsapp/share" target="_blank"><i class="fa fa-fw fa-lg fa-whatsapp"></i></a></li>';
$html .= '</ul>';
$html .= '<div class="pc-hiddenlink" style="display:none">';
$html .= '<div class="modern-p-form p-form-modern-steelBlue">';
$html .= '<div data-base-class="p-form" class="p-form">';
$html .= '<form>';
$html .= '<div class="form-group">';
$html .= '<div class="input-group p-has-icon">';
$html .= '<input type="text" id="linkurl" name="linkurl" value="' . $ogurl . '" class="form-control">';
$html .= '<span class="input-group-icon"><i class="fa fa-link"></i></span><span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-btn">';
$html .= '<button type="button" onclick="pc_copylink()" class="pc-btn">' . __('Copy', 'photo-contest') . '</button>';
$html .= '</span></div>';
$html .= '</div>';
$html .= '</form>';
$html .= '</div>';
$html .= '</div></div>';
$html .= '<div class="pc-control-img pc-hiddenqrcode" style="display:none"><img src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=' . $ogurl_encode . '&choe=UTF-8&chld=L|0" border="0" alt="" class="pc-shared-image"></div>';
}

$html .= '</div>'; //pc-image-info-box-text
$html .= '<div class="clear"></div> ';


//Commments
$allow_comments = get_option('pcplugin-allow-comments');
if ($allow_comments == '3') {
	$defaults = array(
	'order' => 'ASC',
	'post_id' => $photo_id
	);
	$html .= '<hr/>';

	$html .= '<div class="pc-main-votes">';
	$html .= '<span>' . __('Comments:', 'photo-contest') . '</span>';
	$html .= '</div>'; //pc-main-votes

	$comments = get_comments($defaults);
	if (!empty($comments)) {
		$i =0;
		$html .= '<div class="image-bottom-box">';
		foreach ($comments as $comment):
			$i++;
			//comment foreach
			$html .= '<div class="pc-comment-bottom-box" id="comment-' . $comment->comment_ID . '">';
			if ($i % 2 == 0){
				$html .= '<div class="pc-comment-list-box pc-comment-odd">';
			}else{
				$html .= '<div class="pc-comment-list-box">';
			}
			$photo_date  = $comment->comment_date;
			$date_format = get_option('time_format', true) . ' (' . get_option('date_format', true) . ')';
			$daten       = new DateTime($photo_date);
			$date        = $daten->format($date_format);
			$html .= '<div class="pc-right-comments-list">';
			$html .= '<div class="pc-autor-comments-list" ><span>' . $comment->comment_author . '</span><i class="fa fa-calendar"></i>&nbsp;&nbsp;' . date_i18n(get_option('time_format', true) . ' (' . get_option('date_format', true) . ')', strtotime($photo_date)) . '';

			$admin_url  = admin_url();
			$comment_id = $comment->comment_ID;
			$nonce      = wp_create_nonce('delete-comment_' . $comment_id);

			if (current_user_can('editor') || current_user_can('administrator')) {
			$html .= '&nbsp;&nbsp;<a href="' . $admin_url . 'comment.php?action=editcomment&c=' . $comment_id . '">' . __('Edit', 'photo-contest') . '</a>';
			$html .= '&nbsp;&nbsp;<a href="' . $admin_url . 'comment.php?action=trashcomment&c=' . $comment_id . '&_wpnonce=' . $nonce . '">' . __('Delete', 'photo-contest') . '</a>';
			}

			$html .= '</div>';
			$html .= '<div class="pc-text-comments-list" >' . $comment->comment_content . '</div>   ';
			$html .= '</div>';
			$html .= '<div class="clear"></div> ';
			$html .= '</div>';
			$html .= '</div><!--pc-comment-bottom-box end-->';
		endforeach;
    //comment foreach
		$html .= '</div>';//<div class="image-bottom-box">
	} else {
		$html .= '<div class="image-bottom-box">';
		$html .= '<span class="nocomment">' . __('There are no comments.', 'photo-contest') . '</span>';
		$html .= '</div>';
	}

	//Comment Form
	if (is_user_logged_in()) {
		$redirect_url = add_query_arg(array(
		'contest' => 'photo-detail',
		'photo_id' => $_GET['photo_id']
		), $current_url);
		if (function_exists('bp_activity_add')) {
		$allow_comments = get_option('pcplugin-allow_buddy_comments');
			if ($allow_comments == 2) {
			$redirect_url = add_query_arg(array(
			'contest' => 'photo-detail',
			'photo_id' => $_GET['photo_id'],
			'pc-comment' => 'ok'
			), $current_url);
			}
		}

    //Comment Form Box
    $html .= '<div class="image-bottom-box">';
    $html .= '<div class="pc-comment-form-box">';
    $html .= '<form action="' . site_url() . '/wp-comments-post.php" method="post" id="comment-form" class="comment-form" novalidate="">';
    $html .= '<table width="100%">';
    $html .= '<tr>';
    $html .= '<td valign="top"><div class="pc-comment-form-author">' . __('You are logged in as', 'photo-contest') . ' "' . $current_user->display_name . '" - <a href="' . wp_logout_url($redirect_url) . '">' . __('Log out', 'photo-contest') . '</a></div></td>';
    $html .= '<td valign="top"></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td colspan="2" valign="top"><div class="pc-comment-form-textarea"><textarea id="comment" name="comment"></textarea></div></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td colspan="2" valign="top"><input name="submit" type="submit" id="submit" value="' . __('Post Comment', 'photo-contest') . '" class="pc-comment-button pc-btn"></td>';
    $html .= '</tr>';
    $html .= '</table>';
    $html .= '<input type="hidden" name="comment_post_ID" value="' . $_GET['photo_id'] . '" id="comment_post_ID">';
    $html .= '<input type="hidden" name="comment_parent" id="comment_parent" value="0">';
    $html .= '<input type="hidden" name="redirect_to" value="' . $redirect_url . '" />';
    $html .= '</form>';
    $html .= '<div class="clear"></div>';
    $html .= '</div>';
    $html .= '</div>';


	}else { //if logged in
		$html .= '<div class="image-bottom-box">';
		$html .= '<div class="pc-form-warning">' . __('You must be logged in to post a comment', 'photo-contest') . '';
		if (!empty($error)) {
			$html .= '<div class="clear" style="height:5px;"></div>';
			foreach ($error as $item) {
				$html .= '<div class="contest-small-font contest-red-color">' . $item . '</div>';
			}
		}
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="pc-register-bottom-box">' . pc_loginform($related_contest->contest_mode) . '</div>';
	}

}

//Disqus comments
$disqus_code    = get_option('pcplugin-disqus-code');
$allow_comments = get_option('pcplugin-allow-comments');
if ($allow_comments == '1') {
  $html .= '<div class="image-bottom-box">';
  $html .= '<div id="disqus_thread" class="disqus_thread"></div>' . $disqus_code . '';
  $html .= '</div>';
}

$html .= '</div>'; //pc-image-info-box

$html .= '</div>'; // class photo-contest end
$html .= '<div class="clear"></div>';//important


?>
