<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

//If contest not exist
if (empty ($related_contest)){
	wp_redirect(get_permalink());
}
//If is there Upload form mode
if ($related_contest->contest_mode != 1){
	wp_redirect(get_permalink());
}
//If not set image id
if (!isset ($_GET['item-id'])){
	wp_redirect(get_permalink());
}

$photo_id = $_GET['item-id'];
$photo = get_post($photo_id);
$title = $photo->post_title;


//Redirect If photo is related to another contest
$photo_related_to_contest = get_post_meta($photo_id, 'photo-related-to-contest', true);
if ($photo_related_to_contest != $related_contest->id) {
  wp_redirect(get_permalink());
}
//Confirm email hash
$email_validation="failed";
$email_in_array="no";
if (isset($_GET['hash']) and isset($_GET['email'])) {
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

  //Get Hash and email
	$hash = $_GET['hash'];
	$email = $_GET['email'];

	if (md5($photo_id.$email.$current_url) == $hash){
		$vote_frequency = $related_contest->vote_frequency;
		if ($vote_frequency==5) {
			$users_emails = $related_contest->email_list;
		}else{
			$users_emails = get_post_meta($photo_id, 'contest-photo-emails', true);
		}
		$emails_array = explode(',', $users_emails);
		$email_validation="success";

		if (in_array($email, $emails_array)) {
			$email_in_array="yes";
		}

		if (empty($users_emails)) {

			$emails = $email . ',';

			if ($vote_frequency==5) {
				$wpdb->update(
				$wpdb->prefix.'photo_contest_list',
				array(
				'email_list' => $emails,	// string
				),
				array( 'id' => $related_contest->id )
				);
			}else{
				update_post_meta($photo_id, 'contest-photo-emails', $emails);
			}
		}else{
			if (!in_array($email, $emails_array)) {
				$emails = $users_emails . $email . ',';
				if ($vote_frequency==5) {
					$wpdb->update(
					$wpdb->prefix.'photo_contest_list',
					array(
					'email_list' => $emails,	// string
					),
					array( 'id' => $related_contest->id )
					);
				}else{
					update_post_meta($photo_id, 'contest-photo-emails', $emails);
				}
			}
		}

		//If is not email used run vote
		if (!in_array($email, $emails_array)) {
			$nonce = wp_create_nonce( 'pc-nonce' );
			?>
			<script>
				(function ( $ ) {
				"use strict";
				$(function () {
				var photoId = "<?php echo $photo_id; ?>";
				var nonceId = "<?php echo $nonce; ?>";
				var email = "<?php echo $email; ?>";
				var optionId = "basic";
				var data = {
				action: 'vote_for_photo',
				photo_id: photoId,
				nonce_id: nonceId,
				email_id: email,
				option_id: optionId,
				};
				$.post(ajaxurl, data, function(response) {
				});
				});
				}(jQuery));
			</script>
			<?php
		}//If is not email used run vote


		$redirect_url = add_query_arg(array(
		'contest' => 'contest-share',
		'item-id' => $photo_id,
		'after' => 'vote'
		), $current_url);
	}
}

//Vote from gallery
$gallery_vote_validation="failed";
$gallery_user_validation="";
$gallery_ip_validation="";
$vote_frequency = $related_contest->vote_frequency;
//Check cookie
if ($vote_frequency==5){
	$cookiename= 'vote_contest_id_' . $related_contest->id;
}else{
	$cookiename= 'image_vote_' . $_GET['item-id'];
}
if (isset($_GET['item-id']) and isset($_GET['action']) and $_GET['action'] == 'vote' and isset($_GET['vhash']) and md5($_SERVER['REMOTE_ADDR']) == $_GET['vhash'] and !isset($_COOKIE[$cookiename]) and $related_contest->jury==1) {

	$action = $_GET['action'];
	$photo_id = $_GET['item-id'];

	//Check user
	if (is_user_logged_in()){
		$user_ID = get_current_user_id();
		if ($related_contest->vote_frequency ==5){
			$users_ids = $related_contest->user_vote_list;
		}else{
			$users_ids = get_post_meta($photo_id, 'contest-photo-users', true);
		}

		$ids_array = explode(',', $users_ids);

		if (!in_array($user_ID, $ids_array)) {
			$gallery_vote_validation="success";
			$gallery_user_validation="success";
		}else{
			$gallery_user_validation="failed";
		}
	}

	//Check IP Address
	if ($related_contest->vote_frequency ==5){
		$ips = $related_contest->ip_list;
	}else{
		$ips = get_post_meta($photo_id, 'contest-photo-ip', true);
	}

	$ip_address = explode(',', $ips);
	if (!in_array($_SERVER['REMOTE_ADDR'], $ip_address)) {
		$gallery_vote_validation="success";
		$gallery_ip_validation="success";
	}else{
		$gallery_ip_validation="failed";
	}

	$nonce = wp_create_nonce( 'pc-nonce' );
	?>
	<script>
		(function ( $ ) {
		"use strict";
		$(function () {
		var photoId = "<?php echo $photo_id; ?>";
		var nonceId = "<?php echo $nonce; ?>";
		var optionId = "basic";
		var data = {
		action: 'vote_for_photo',
		photo_id: photoId,
		nonce_id: nonceId,
		option_id: optionId,
		};
		$.post(ajaxurl, data, function(response) {
		});
		});
		}(jQuery));
	</script>
	<?php

}

$html = '<div class="photo-contest'.$animation.' '.$font_size.'">';
$html .= '<div class="pc-share-page">';

if (isset($_GET['after'])){
	$after = $_GET['after'];
}else{
	$after = "";
}
//Get verify parameter
if (isset($_GET['verify']) and $_GET['verify']=='email'){
	$verify = $_GET['verify'];
}elseif (isset($_GET['verify']) and $_GET['verify']=='email-send'){
	$verify = $_GET['verify'];
}else{
	$verify = "";
}

$error = array();
if (isset($_POST['valide-email']) and empty($_POST['valide-email'])) {
	$error['valide-email'] = 1;
}
//Email filter
$email_filter = get_option('pcplugin-email-filter');
if ($email_filter==2) {
	if (isset($_POST['valide-email']) and !empty($_POST['valide-email']) and pc_is_disposable_mail($_POST['valide-email'])==1) {
				$error['disposable-email'] = 1;
	}
}
//Send email
if (isset($_POST['valide-email']) and empty($error)) {
	$nonce = $_REQUEST['_wpnonce'];
	if ( ! wp_verify_nonce( $nonce, 'submit_email' ) ) {
	exit; // Get out of here, the nonce is rotten!
	}
	if (!is_user_logged_in()) {
		$email = $_POST['valide-email'];
		$hash = md5($photo_id.$email.$current_url);

		$link = add_query_arg(array(
		'contest' => 'contest-share',
		'item-id' => $photo_id,
		'email' => urlencode($email),
		'hash' => $hash,
		), $current_url);

		$to = $email;
		$subject = __('Email validation', 'photo-contest');
		$body = __('Thank you for your vote!', 'photo-contest').'<br />';
		$body .= __('Please follow this link to activate your vote:', 'photo-contest').'<br />';
		$body .= $link.'<br />';
		$body .= __('This is an automatically generated email, please do not reply!', 'photo-contest');
		$headers = array('Content-Type: text/html; charset=UTF-8');

		wp_mail( $to, $subject, $body, $headers );

		$redirect_url = add_query_arg(array(
		'contest' => 'contest-share',
		'item-id' => $photo_id,
		'verify' => 'email-send'
		), $current_url);
		wp_redirect($redirect_url);
	}
}

$allow_activate = get_option('pcplugin-allow-activate');
$image_attributes = wp_get_attachment_image_src( $photo_id, 'full' );

//Confirm Email
if ($verify=='email'){
	$html .= '<div class="pc-thank-you"><span>'.__('Verify Vote!', 'photo-contest').'</span></div>';
}
if ($after=='upload' or $verify=='email-send'){
	$html .= '<div class="pc-thank-you"><span>'.__('Thank you!', 'photo-contest').'</span></div>';
}
if (
$after=='vote'
or $email_validation=="success" and $email_in_array=="no"
or $gallery_vote_validation=="success" and $gallery_user_validation!="failed"
){
	$end    = $related_contest->contest_end;
	$date   = StrFTime('%m/%d/%Y', current_time('timestamp', 0));
	$today_time  = strtotime($date);
	$expire_time = strtotime($end);

	if ($expire_time < $today_time) {
		$html .= '<div class="pc-thank-you"><span>'.__('Sorry!', 'photo-contest').'</span></div>';
	}elseif(empty($error)) {
		$html .= '<div class="pc-thank-you"><span>'.__('Thank you!', 'photo-contest').'</span></div>';
	}
}
//Email was verifed but already used for this image
if (isset($_GET['hash']) and isset($_GET['email']) and $email_in_array=="yes"){
	$html .= '<div class="pc-thank-you"><span>'.__('Email confirmation failed!', 'photo-contest').'</span></div>';
}
//Vote failed - User or IP or Email is in list already
if (
	isset($_GET['action']) and $_GET['action']=='vote' and $gallery_user_validation=='failed'
	or isset($_GET['action']) and $_GET['action']=='vote' and $gallery_ip_validation=='failed'
	or isset($_GET['vhash']) and md5($_SERVER['REMOTE_ADDR']) != $_GET['vhash']
	or isset($_COOKIE[$cookiename]) and !isset($_GET['after']) and !isset($_GET['verify']) and !isset($_GET['hash'])
	or $related_contest->jury==2 and !isset($_GET['after'])){
	$html .= '<div class="pc-thank-you"><span>'.__('Vote failed!', 'photo-contest').'</span></div>';
}

//Show text after upload
if ($after=='upload'){
	if ($allow_activate==2){
		$html .= '<div class="pc-control-text">'.__('Your photo is not activated yet, you must wait for approval!', 'photo-contest').'</div>';
		$html .= '<div class="pc-control-text">'.__('But you can share it already!', 'photo-contest').'</div>';
	}else{
		$html .= '<div class="pc-control-text">'.__('Your photo was uploaded successfully and is active!', 'photo-contest').'</div>';
		$html .= '<div class="pc-control-text">'.__('So share it and get some votes!', 'photo-contest').'</div>';
	}
}
//Vote failed - User or email or IP is in list already
if (isset($_GET['action']) and $_GET['action']=='vote' and $gallery_user_validation=='failed'){
	$html .= '<div class="pc-control-text">' . __('You have voted already', 'photo-contest') .' ' . $current_user->display_name. '!</div>';
}
if (isset($_GET['action']) and $_GET['action']=='vote' and $gallery_ip_validation=='failed'){
	$html .= '<div class="pc-control-text">' . __('Someone has already voted out of this IP address:', 'photo-contest') .' ' . $_SERVER["REMOTE_ADDR"] . '</div>';
}
if (isset($_GET['vhash']) and md5($_SERVER['REMOTE_ADDR']) != $_GET['vhash']){
	$html .= '<div class="pc-control-text">'.__('Vote unique ID did not match', 'photo-contest').'</div>';
}
if (isset($_COOKIE[$cookiename]) and !isset($_GET['after']) and !isset($_GET['verify'])){
	$html .= '<div class="pc-control-text">'.__('Someone voted out on this computer already!', 'photo-contest').'</div>';
}
if ($related_contest->jury==2 and !isset($_GET['after'])){
	$html .= '<div class="pc-control-text">'.__('It is not possible to vote this way in jury mode!', 'photo-contest').'</div>';
}
//Show text after vote
if ($after=='vote' or $email_validation=="success" and $email_in_array=="no" or $gallery_vote_validation=="success"){
	$end    = $related_contest->contest_end;
	$date   = StrFTime('%m/%d/%Y', current_time('timestamp', 0));

	$today_time  = strtotime($date);
	$expire_time = strtotime($end);

	if ($expire_time < $today_time) {
		$html .= '<div class="pc-control-text pc-bigger">'.__('You cannot vote anymore!', 'photo-contest').'</div>';
		$html .= '<div class="pc-control-text">' . __('Contest is finished!', 'photo-contest') . '</div>';
	}else {
		$html .= '<div class="pc-control-text pc-bigger">'.__('Your vote for this photo was successfully counted!', 'photo-contest').'</div>';
		if($related_contest->hide_social==1){
			$html .= '<div class="pc-control-text">'.__('Please share this photo with your friends!', 'photo-contest').'</div>';
	  }
	}
}
//Confirm Email
if ($verify=='email'){
	$html .= '<div class="pc-control-text pc-bigger">'.__('We now need to verify your vote by email!', 'photo-contest').'</div>';
	$html .= '<div class="pc-control-text pc-small">'.__('Your email address will NOT be shared with a third party!', 'photo-contest').'</div>';
	$html .= '<div class="pc-control-text pc-small">'.__('Your email address will NOT be sold or used for purposes other than confirmation for this vote!', 'photo-contest').'</div>';
}
//Email was send
if ($verify=='email-send'){
	$html .= '<div class="pc-control-text pc-bigger">'.__('Message with confirmation link was sent!', 'photo-contest').'</div>';
	$html .= '<div class="pc-control-text">'.__('Please check your email!', 'photo-contest').'</div>';
}
//Email confirmation failed
if (isset($_GET['hash']) and isset($_GET['email']) and $email_validation=="failed"){
	$html .= '<div class="pc-control-text pc-bigger">'.__('Check if you copied URL from your email correctly', 'photo-contest').'</div>';
	$html .= '<div class="pc-control-text">'.__('And try it again!', 'photo-contest').'</div>';
}
//Email was verifed but already used for this image
if (isset($_GET['hash']) and isset($_GET['email']) and $email_in_array=="yes"){
	$html .= '<div class="pc-control-text pc-bigger">'.sprintf(__('Sorry this email %s was already used for vote!', 'photo-contest'), $_GET['email']).'</div>';
	$html .= '<div class="pc-control-text">'.__('You cannot vote twice!', 'photo-contest').'</div>';
}
//Detail page URL
$share_url = add_query_arg(array('contest' => 'photo-detail','photo_id' => $photo_id), $current_url);
$html .= '<div class="pc-control-img"><a href="'.$share_url.'"><img src="'.$image_attributes[0].'" border="0" alt="" class="pc-shared-image"></a></div>';
//Confirm Email
if ($verify=='email' and !is_user_logged_in()){
	$html .= '<div class="pc-control-text">'.__('Please enter your email!', 'photo-contest').'</div>';
}
//Confirm Email when user is logged
if ($verify=='email' and is_user_logged_in()){
	$html .= '<div class="pc-control-text">'.__('You are logged in. You cannot confirm vote by email!', 'photo-contest').'</div>';
}
//Confirm Emai
if ($verify=='email'){
	$html .= '<div class="modern-p-form p-form-modern-slateGray form-white-back valid-email">';

	//Check errors
	if (isset($_POST['valide-email']) and empty($_POST['valide-email']) and $error['valide-email']==1) {
		$html .= '<form class="form-group p-field-error" action="" method="post">';
	}elseif ($verify=='email' and is_user_logged_in()) {
		$html .= '<form class="form-group  p-field-disabled" action="" method="post">';
	}else{
		$html .= '<form class="form-group" action="" method="post">';
	}

	$html .= '<div class="input-group p-has-icon">';
	$html .= '<input type="email" id="subscribe" name="valide-email" placeholder="'.__('enter your email', 'photo-contest').'" class="form-control">';
	$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-at"></i></span> <span class="input-group-btn">';
	$html .=  wp_nonce_field( 'submit_email' );
	$html .= '<button type="submit" class="pc-btn">'.__('verify vote', 'photo-contest').'</button>';
	$html .= '</span></div>';

	if (isset($_POST['valide-email']) and empty($_POST['valide-email']) and isset($error['valide-email'])) {
		$html .= '<span class="p-field-sub-text"><i class="fa fa-times p-error-text"></i> '.__('email field is empty or email is not in valid format', 'photo-contest').'</span>';
	}
	if (isset($error['disposable-email'])) {
		$html .= '<span class="p-field-sub-text"><i class="fa fa-times p-error-text"></i> '.__('This email domain is not allowed', 'photo-contest').'</span>';
	}

	$html .= '</form>';
	$html .= '</div>';
}


//Social icons
if($related_contest->hide_social==1){
	//Email was send
	if ($verify=='email-send'){
		$html .= '<div class="pc-control-text">'.__('Please share this photo with your friends!', 'photo-contest').'</div>';
	}

	$share_url_encode = urlencode($share_url);
	$html .= '<div class="pc-share-icons">';
	$html .= '<ul class="pc-social">';
	$html .= '<li class="pc-showlink"><i class="fa fa-lg fa-link"></i></li>';
	$html .= '<li class="pc-showqrcode"><i class="fa fa-lg fa-qrcode"></i></li>';
	$html .= '<li><a href="https://www.facebook.com/sharer.php?u=' . $share_url_encode . '" target="_blank"><i class="fa fa-lg fa-facebook"></i></a></li>';
	$html .= '<li><a href="https://twitter.com/intent/tweet?source=SOURCE&text=' . $title . '&url=' . $share_url_encode . '" target="_blank"><i class="fa fa-lg fa-twitter"></i></a></li>';
	$html .= '<li><a href="http://pinterest.com/pin/create/link/?url=' . $share_url_encode . '&description=' . $title . '&media=' . urlencode(wp_get_attachment_url($photo_id)) . '" target="_blank"><i class="fa fa-lg fa-pinterest"></i></a></li>';
	$html .= '<li><a href="http://www.tumblr.com/share/link?url=' . $share_url_encode . '&name=' . $title . '" target="_blank"><i class="fa fa-lg fa-tumblr"></i></a></li>';
	$html .= '<li><a href="http://reddit.com/submit?url=' . $share_url_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-lg fa-reddit"></i></a></li>';
	$html .= '<li><a href="http://del.icio.us/post?url=' . $share_url_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-lg fa-delicious"></i></a></li>';
	$html .= '<li><a href="https://digg.com/submit?url=' . $share_url_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-lg fa-digg"></i></a></li>';
	$html .= '<li><a href="http://www.stumbleupon.com/submit?url=' . $share_url_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-lg fa-stumbleupon"></i></a></li>';
	$html .= '<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=' . $share_url_encode . '&title=' . $title . '" target="_blank"><i class="fa fa-lg fa-linkedin"></i></a></li>';
	$html .= '<li><a href="http://vk.com/share.php?url=' . $share_url_encode . '" target="_blank"><i class="fa fa-fw fa-lg fa-vk"></i></a></li>';
	$html .= '<li><a href="whatsapp://send?text=' . $share_url_encode . '" data-action="share/whatsapp/share" target="_blank"><i class="fa fa-fw fa-lg fa-whatsapp"></i></a></li>';
	$html .= '</ul>';

	$html .= '<div class="pc-hiddenlink" style="display:none">';
	$html .= '<div class="modern-p-form p-form-modern-steelBlue">';
	$html .= '<div data-base-class="p-form" class="p-form">';
	$html .= '<form>';
	$html .= '<div class="form-group">';
	$html .= '<div class="input-group p-has-icon">';
	$html .= '<input type="text" id="linkurl" name="linkurl" value="'.$share_url.'" class="form-control">';
	$html .= '<span class="input-group-icon"><i class="fa fa-link"></i></span><span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-btn">';
	$html .= '<button type="button" onclick="pc_copylink()" class="pc-btn">Copy</button>';
	$html .= '</span></div>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div></div>';
	$html .= '<div class="pc-control-img pc-hiddenqrcode" style="display:none"><img src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=' . $share_url_encode . '&choe=UTF-8&chld=L|0" border="0" alt="" class="pc-shared-image"></div>';

	$html .= '</div>';
}
$html .= '</div>';//pc-share-page
$html .= '</div>';//photo-contest
$html .= '<div class="clear"></div>';//important
