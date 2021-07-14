<?php

//Secure file from direct access
if (!defined('WPINC')) {
	die;
}

//Include Uplod Form Functions
include(plugin_dir_path(__DIR__) . 'includes/pc-upload-functions.php');
//Important variables


//Get contest data
$contest_id = $related_contest->id;
$contest_user_images = 'contest_user_images_' . $related_contest->id;

//Load options
$allow_reCaptcha = get_option('pcplugin-allow-reCaptcha');
$allow_GDPR = get_option('pcplugin-allow-GDPR');

//If contest not exist
if (empty($related_contest)) {
	wp_redirect(get_permalink());
}
//If is section hidden
if ($related_contest->hide_up == "2" and !is_super_admin()) {
	wp_redirect(get_permalink());
}

//Get contest custom fields
$dateofbirth = $related_contest->date_of_birth;
$city = $related_contest->city;
$address = $related_contest->adress;
$zip_code = $related_contest->zip_code;
$state = $related_contest->state;
$country = $related_contest->country;
$gender = $related_contest->gender;
$gender_3 = $related_contest->gender_3;
$www = $related_contest->www;
$phone = $related_contest->phone;
$fb_page = $related_contest->fb_page;
$twitter_page = $related_contest->twitter_page;
$instagram_page = $related_contest->instagram_page;
$camera_model = $related_contest->camera_model;
$description = stripslashes($related_contest->description);
$custom_field_personal = stripslashes($related_contest->custom_field_personal);
$custom_field_personal_name = stripslashes($related_contest->custom_field_personal_name);
$custom_field_personal_required = stripslashes($related_contest->custom_field_personal_required);
$custom_field_personal_name_required = stripslashes($related_contest->custom_field_personal_name_required);
$custom_field_image = stripslashes($related_contest->custom_field_image);
$custom_field_image_name = stripslashes($related_contest->custom_field_image_name);
$agree_terms = $related_contest->agree_terms;
$agree_age_13 = $related_contest->agree_age_13;
$agree_age_18 = $related_contest->agree_age_18;
$force_registration = $related_contest->force_registration;

//If is custom personal field empty
if (empty($custom_field_personal_name)) {
	$custom_field_personal_name = __('Custom personal field', 'photo-contest');
}
//If is custom personal required field empty
if (empty($custom_field_personal_name_required)) {
	$custom_field_personal_name_required = __('Custom personal field', 'photo-contest');
}
//If is custom image field empty
if (empty($custom_field_image_name)) {
	$custom_field_image_name = __('Custom image field', 'photo-contest');
}

$user_ID = get_current_user_id();
$koncovky = [
	'jpg',
	'jpeg',
	'png',
	'gif'
];

$number_images = get_user_meta($user_ID, 'contest_user_images_' . $contest_id, true);
if (empty($number_images)) {
	$number_images = 0;
}

if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == "new_post") {

	//Sanitize Post
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$nonce = $_REQUEST['_wpnonce'];
	if (!wp_verify_nonce($nonce, 'submit_picture')) {
		exit; // Get out of here, the nonce is rotten!
	}

	$error = [];
	// Do some minor form validation to make sure there is content

	//Email filter
	$email_filter = get_option('pcplugin-email-filter');
	if ($email_filter == 2) {
		if (isset($_POST['email']) and pc_is_disposable_mail($_POST['email']) == 1) {
			$error['disposable-email'] = __('This email domain is not allowed', 'photo-contest');
		}
	}
	//Validate form (Personal data)
	if (!is_user_logged_in()) {

		$profile_url = add_query_arg('contest', 'contest-profile', $current_url);
		if (empty($_POST['username'])) {
			$error['username'] = __('Please state Your Name!', 'photo-contest');
		} else {
			$username = trim($_POST['username']);
		}
		if (username_exists($_POST['username'])) {
			$error['username'] = __('This Name is already taken!', 'photo-contest');
		}
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$error['email'] = __('Invalid email format!', 'photo-contest');
		}
		if (empty($_POST['email'])) {
			$error['email'] = __('Please enter the Email!', 'photo-contest');
		} else {
			$email = trim($_POST['email']);
		}
		if (email_exists($_POST['email'])) {
			$error['email'] = __('This email is already used! If you have already image in the contest please first', 'photo-contest') . ' <a href="' . $profile_url . '">' . __('Log In', 'photo-contest') . '</a>';
		}
	}// END Validate form (Personal data)

	if (is_user_logged_in()) {
		//Get info about user
		$dateofbirth_meta = get_user_meta($user_ID, 'pcplugin-dateofbirth', true);
		$address_meta = get_user_meta($user_ID, 'pcplugin-adress', true);
		$city_meta = get_user_meta($user_ID, 'pcplugin-city', true);
		$zip_code_meta = get_user_meta($user_ID, 'pcplugin-zip_code', true);
		$state_meta = get_user_meta($user_ID, 'pcplugin-state', true);
		$country_meta = get_user_meta($user_ID, 'pcplugin-country', true);
		$gender_meta = get_user_meta($user_ID, 'pcplugin-gender', true);
		$gender_3_meta = get_user_meta($user_ID, 'pcplugin-gender_3', true);
		$www_meta = get_user_meta($user_ID, 'pcplugin-www', true);
		$phone_meta = get_user_meta($user_ID, 'pcplugin-phone', true);
		$facebook_meta = get_user_meta($user_ID, 'pcplugin-facebook', true);
		$twitter_meta = get_user_meta($user_ID, 'pcplugin-twitter', true);
		$instagram_meta = get_user_meta($user_ID, 'pcplugin-instagram', true);
		$custom_field_personal_meta = get_user_meta($user_ID, 'pcplugin-custom_field_personal_' . $related_contest->id, true);
		$custom_field_personal_meta_required = get_user_meta($user_ID, 'pcplugin-custom_field_personal_required_' . $related_contest->id, true);
	} else {
		$dateofbirth_meta = "";
		$address_meta = "";
		$city_meta = "";
		$zip_code_meta = "";
		$state_meta = "";
		$country_meta = "";
		$gender_meta = "";
		$gender_3_meta = "";
		$www_meta = "";
		$phone_meta = "";
		$facebook_meta = "";
		$twitter_meta = "";
		$instagram_meta = "";
		$custom_field_personal_meta = "";
		$custom_field_personal_meta_required = "";
	}
	//Check required custom fields
	if (empty($_POST['dateofbirth']) and $dateofbirth == 2 and (empty($dateofbirth_meta))) {
		$error['dateofbirth'] = __('Please enter the Date of Birth!', 'photo-contest');
	}
	if (empty($_POST['address']) and $address == 2 and (empty($address_meta))) {
		$error['address'] = __('Please enter the address!', 'photo-contest');
	}
	if (empty($_POST['city']) and $city == 2 and (empty($city_meta))) {
		$error['city'] = __('Please enter the City!', 'photo-contest');
	}
	if (empty($_POST['zip_code']) and $zip_code == 2 and (empty($zip_code_meta))) {
		$error['zip_code'] = __('Please enter the Zip/Postal code!', 'photo-contest');
	}
	if (empty($_POST['state']) and $state == 2 and (empty($state_meta))) {
		$error['state'] = __('Please select the State!', 'photo-contest');
	}
	if (empty($_POST['country']) and $country == 2 and (empty($country_meta))) {
		$error['country'] = __('Please select the Country!', 'photo-contest');
	}
	if (empty($_POST['phone']) and $phone == 2 and (empty($phone_meta))) {
		$error['phone'] = __('Please enter the Phone number!', 'photo-contest');
	}
	if (empty($_POST['gender']) and $gender == 2 and (empty($gender_meta))) {
		$error['gender'] = __('Please select the Gender!', 'photo-contest');
	}
	if (empty($_POST['gender_3']) and $gender_3 == 2 and (empty($gender_3_meta))) {
		$error['gender_3'] = __('Please select the Gender!', 'photo-contest');
	}
	if (empty($_POST['custom_field_personal_required']) and $custom_field_personal_required == 2 and (empty($custom_field_personal_meta_required))) {
		$error['custom_field_personal_required'] = sprintf(__('Please fill the form field: %s', 'photo-contest'), $custom_field_personal_name_required);
	}
	if (isset($_POST['facebook']) and !empty($_POST['facebook'])) {
		$fbUrlCheck = '/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/';
		$secondCheck = '/home((\/)?\.[a-zA-Z0-9])?/';

		$validUrl = $_POST['facebook'];

		if (preg_match($fbUrlCheck, $validUrl) == 1 && preg_match($secondCheck, $validUrl) == 0) {
		} else {
			$error['facebook'] = __('Facebook profile URL is not valid', 'photo-contest');
		}
	}
	if (isset($_POST['twitter']) and !empty($_POST['twitter'])) {
		$fbUrlCheck = '/^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9(\.\?)?]/';
		$secondCheck = '/home((\/)?\.[a-zA-Z0-9])?/';
		$validUrl = $_POST['twitter'];
		if (preg_match($fbUrlCheck, $validUrl) == 1 && preg_match($secondCheck, $validUrl) == 0) {
		} else {
			$error['twitter'] = __('Twitter profile URL is not valid', 'photo-contest');
		}
	}
	if (isset($_POST['instagram']) and !empty($_POST['instagram'])) {
		$fbUrlCheck = '/^(https?:\/\/)?(www\.)?instagram.com\/[a-zA-Z0-9(\.\?)?]/';
		$secondCheck = '/home((\/)?\.[a-zA-Z0-9])?/';
		$validUrl = $_POST['instagram'];
		if (preg_match($fbUrlCheck, $validUrl) == 1 && preg_match($secondCheck, $validUrl) == 0) {
		} else {
			$error['instagram'] = __('Instagram profile URL is not valid', 'photo-contest');
		}
	}
	if (!isset($_POST['agree_age_13']) and $agree_age_13 == 2) {
		$error['agree_age_13'] = __('You did not confirm that you are over age of 13!', 'photo-contest');
	}
	if (!isset($_POST['agree_age_18']) and $agree_age_18 == 2) {
		$error['agree_age_18'] = __('You did not confirm that you are over age of 18!', 'photo-contest');
	}
	if (!isset($_POST['agree_terms']) and $agree_terms == 2) {
		$error['agree_terms'] = __('You did not accept contest rules!', 'photo-contest');
	}
	$agreeGDPRTrue = get_user_meta(get_current_user_id(), 'agree-GDPR', true);
	if (!isset($_POST['agree-GDPR']) and $allow_GDPR == 1 and empty($agreeGDPRTrue)) {
		$error['agree_gppr'] = __('We need your presonal data processing agreement!', 'photo-contest');
	}
	//Validate form (Image data)
	if (empty($_POST['photo-name'])) {
		$error['name'] = __('Please enter a Title!', 'photo-contest');
	} else {
		$name = trim($_POST['photo-name']);
	}

	//Check photo
	if ($_FILES['contest-photo']['error'] == UPLOAD_ERR_NO_FILE) {
		$error['photo'] = __('Please select the image', 'photo-contest');
	} else {

		//Control upload and extension
		if (!in_array(strtolower(pathinfo($_FILES['contest-photo']['name'], PATHINFO_EXTENSION)), $koncovky)) {
			$error['extension_error'] = __('Image must be jpg, png or gif.', 'photo-contest');
		} else {

			@$img = getimagesize($_FILES['contest-photo']['tmp_name']);
			$minimum = [
				'width' => '350',
				'height' => '350'
			];
			$width = $img[0];
			$height = $img[1];
			if ($width < $minimum['width']) {
				$error['type_error'] = __('Minimum image width is 350px.', 'photo-contest');
			} elseif ($height < $minimum['height']) {
				$error['type_error'] = __('Minimum image height is 350px.', 'photo-contest');
			}
			$photo_limit = get_option('pcplugin-photo-limit', true);
			$size_maxi = $photo_limit;
			$size = filesize($_FILES['contest-photo']['tmp_name']);
			if ($size > $size_maxi) {
				$error['size_error'] = __('File size is above allowed limitations!', 'photo-contest');
			}
		}
	}

	if (empty($error)) {
		if (!is_user_logged_in()) {
			$user_ID = pc_register($username, $email);
		}
	}

	if (empty($error)) {
		//If no exist error - create attachment post
		if (isset($_POST['photo-description'])) {
			$description = sanitize_text_field($_POST['photo-description']);
		} else {
			$description = '';
		}

		if (!function_exists('wp_handle_upload'))
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		$uploadedfile = $_FILES['contest-photo'];
		$upload_overrides = [
			'test_form' => false
		];

		$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
		if ($movefile) {
			$wp_filetype = $movefile['type'];
			$filename = $movefile['file'];
			$wp_upload_dir = wp_upload_dir();
			$attachment = [
				'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
				'post_mime_type' => $wp_filetype,
				'post_title' => $name,
				'post_content' => $description,
				'post_status' => 'inherit',
				'comment_status' => 'open'
			];
			if (isset ($_POST['upload-action'])) {
				if (!function_exists('wp_crop_image')) {
					include_once(ABSPATH . 'wp-admin/includes/image.php');
				}
			}
			$attach_id = wp_insert_attachment($attachment, $filename);
			$metadata = wp_generate_attachment_metadata($attach_id, $filename);
			$updatemetadata = wp_update_attachment_metadata($attach_id, $metadata);


			//Check and resize image
			$image = wp_get_image_editor($filename); // Return an implementation that extends WP_Image_Editor
			$image_metadata = wp_get_attachment_metadata($attach_id);
			$maxwidth = get_option('pcplugin-maxwidth');
			$maxheight = get_option('pcplugin-maxheight');
			if (empty($maxwidth) or empty($maxheight)) {
				$maxwidth = '1920';
				$maxheight = '1080';
			}
			if ($maxwidth < $image_metadata["width"] or $maxheight < $image_metadata["height"]) {
				if (!is_wp_error($image)) {
					$image->resize($maxwidth, $maxheight, false);
					$image->save($filename);
				}
			}


		}
		//BuddyPress
		if (function_exists('bp_activity_add')) {
			include_once(dirname(__DIR__) . "/includes/pc-BuddyPress.php");
			pc_buddy_press_upload($attach_id);
		}
		update_post_meta($attach_id, 'photo-upload-ip', $_SERVER['REMOTE_ADDR']);
		$activate = get_option('pcplugin-allow-activate');
		if ($activate == '2') {
			update_post_meta($attach_id, 'contest-active', 0);
		} else {
			update_post_meta($attach_id, 'contest-active', 1);
		}
		update_post_meta($attach_id, 'photo-related-to-contest', $contest_id);

		if (isset($_POST['photo-category'])) {
			$im_category = $_POST['photo-category'];
			update_post_meta($attach_id, 'contest-photo-category', $im_category);
		} else {
			update_post_meta($attach_id, 'contest-photo-category', 900000);
		}
		update_post_meta($attach_id, 'contest-photo-points', 0);
		update_post_meta($attach_id, 'contest-photo-author', $user_ID);

		if (!empty($photo_username) and !empty($photo_email)) {
			update_post_meta($attach_id, 'contest-user-name', $photo_username);
			update_post_meta($attach_id, 'contest-user-email', $photo_email);
		} else {
			update_post_meta($attach_id, 'contest-user-name', $current_user->display_name);
			update_post_meta($attach_id, 'contest-user-email', $current_user->user_email);
		}
		if (isset($_POST['camera_model'])) {
			update_post_meta($attach_id, 'camera-model', $_POST['camera_model']);
		}
		if (isset($_POST['custom_field_image'])) {
			update_post_meta($attach_id, 'custom-field', $_POST['custom_field_image']);
		}
		$country = pc_getLocationInfoByIp($_SERVER['REMOTE_ADDR']);
		update_post_meta($attach_id, 'image-country', $country);
		$number_images = $number_images + 1;
		update_user_meta($user_ID, $contest_user_images, $number_images);
		if (isset ($_POST['dateofbirth'])) {
			update_user_meta($user_ID, 'pcplugin-dateofbirth', $_POST['dateofbirth']);
		}
		if (isset ($_POST['address'])) {
			update_user_meta($user_ID, 'pcplugin-adress', $_POST['address']);
		}
		if (isset ($_POST['city'])) {
			update_user_meta($user_ID, 'pcplugin-city', $_POST['city']);
		}
		if (isset ($_POST['zip_code'])) {
			update_user_meta($user_ID, 'pcplugin-zip_code', $_POST['zip_code']);
		}
		if (isset ($_POST['state'])) {
			update_user_meta($user_ID, 'pcplugin-state', $_POST['state']);
		}
		if (isset ($_POST['country'])) {
			update_user_meta($user_ID, 'pcplugin-country', $_POST['country']);
		}
		if (isset ($_POST['gender'])) {
			update_user_meta($user_ID, 'pcplugin-gender', $_POST['gender']);
		}
		if (isset ($_POST['gender_3'])) {
			update_user_meta($user_ID, 'pcplugin-gender_3', $_POST['gender_3']);
		}
		if (isset ($_POST['www'])) {
			update_user_meta($user_ID, 'pcplugin-www', $_POST['www']);
		}
		if (isset ($_POST['phone'])) {
			update_user_meta($user_ID, 'pcplugin-phone', $_POST['phone']);
		}
		if (isset ($_POST['facebook'])) {
			update_user_meta($user_ID, 'pcplugin-facebook', $_POST['facebook']);
		}
		if (isset ($_POST['twitter'])) {
			update_user_meta($user_ID, 'pcplugin-twitter', $_POST['twitter']);
		}
		if (isset ($_POST['instagram'])) {
			update_user_meta($user_ID, 'pcplugin-instagram', $_POST['instagram']);
		}
		if (isset ($_POST['custom_field_personal'])) {
			update_user_meta($user_ID, 'pcplugin-custom_field_personal_' . $related_contest->id, $_POST['custom_field_personal']);
		}
		if (isset ($_POST['custom_field_personal_required'])) {
			update_user_meta($user_ID, 'pcplugin-custom_field_personal_required_' . $related_contest->id, $_POST['custom_field_personal_required']);
		}
		if (isset ($_POST['agree-GDPR'])) {
			update_user_meta($user_ID, 'agree-GDPR', current_time('timestamp'));
		}

		//Email notification
		$email_notification = get_option('pcplugin-email-notification');
		if ($email_notification == '1') {
			global $current_user;
			$admin_email = get_option('pcplugin-admin-email');
			$admin_email_input = get_option('pcplugin-admin-email-input');
			if ($admin_email == 2) {
				$adminemail = $admin_email_input;
			} else {
				$adminemail = get_option('admin_email');
			}
			$to = $adminemail;
			$subject = __('New Image in the Photo Contest', 'photo-contest');
			$body = __('New Image in the Photo Contest', 'photo-contest') . "<br>";
			$body .= __('Uploaded by:', 'photo-contest') . ' ' . $current_user->display_name . '<br>';
			$body .= __('Approve image:', 'photo-contest') . ' ' . get_site_url() . '/wp-admin/admin.php?page=photo-contest-photos <br>';
			$headers = [
				'Content-Type: text/html; charset=UTF-8'
			];
			wp_mail($to, $subject, $body, $headers);
		}//End Email notification

		$image = get_post($attach_id);

		if (!$image || 'attachment' != $image->post_type || 'image/' != substr($image->post_mime_type, 0, 6))
			die(json_encode([
				'error' => sprintf(__('Failed resize: %s is an invalid image ID.', 'photo-contest'), esc_html($attach_id))
			]));

		$fullsizepath = get_attached_file($image->ID);

		if (false === $fullsizepath || !file_exists($fullsizepath))
			@set_time_limit(900); // 5 minutes per image should be PLENTY


		if ($related_contest->contest_mode != 1) {
			$redirect_url = add_query_arg([
				'thank-you' => ''
			], $current_url);
		} else {
			$redirect_url = add_query_arg([
				'contest' => 'contest-share',
				'item-id' => $image->ID,
				'after' => 'upload'
			], $current_url);
		}
		wp_redirect($redirect_url);
	}
}//END if empty ERROR

$html = '<div class="photo-contest' . $animation . ' ' . $font_size . '">';

if ($force_registration == 1 or $force_registration == 2 and is_user_logged_in()) {

	$html .= '<div class="clear"></div>';

	$contest_start = $related_contest->contest_start;
	$contest_end = $related_contest->contest_end;
	$contest_reg_ends = $related_contest->contest_register_end;
	$photo_number = $related_contest->image_per_user;
	$contest_id = $related_contest->id;

	$start = $contest_start;
	$end = $contest_end;
	$regends = $contest_reg_ends;
	$date = StrFTime('%m/%d/%Y', current_time('timestamp', 0));

	$today_time = strtotime($date);
	$begin_time = strtotime($start);
	$expire_time = strtotime($end);
	$registration_time = strtotime($regends);

	$source = $regends;
	$daten = new DateTime($source);
	$dates = new DateTime($start);

	//Check if contest started
	if ($begin_time > $today_time) {
		$date_format = get_option('date_format', true);
		$html .= '<div class="contest-info-bar"><i class="fa fa-exclamation-triangle"></i> ' . __('The contest has not yet started. It will launch on:', 'photo-contest') . ' ' . date_i18n($date_format, strtotime($contest_start)) . '</div>';
	} elseif ($begin_time <= $today_time) {
		if ($expire_time < $today_time) {
			$html .= '<div class="contest-info-bar"><i class="fa fa-exclamation-triangle"></i> ' . __('Contest already finished.', 'photo-contest') . '</div>';
		} else {

			if ($registration_time < $today_time) {
				$date_format = get_option('date_format', true);
				$html .= '<div class="contest-info-bar"><i class="fa fa-exclamation-triangle"></i> ' . __('Ability to enter the contest has expired to date', 'photo-contest') . ' ' . $daten->format($date_format) . '</div>';
			} else {
				//Main Form
				$nmb_img = $photo_number;
				$photo_limit = get_option('pcplugin-photo-limit', true);

				if ($photo_limit == 209715) {
					$photo_limit = '0,2 MB';
				} elseif ($photo_limit == 314573) {
					$photo_limit = '0,3 MB';
				} elseif ($photo_limit == 524288) {
					$photo_limit = '0,5 MB';
				} elseif ($photo_limit == 734003) {
					$photo_limit = '0,7 MB';
				} elseif ($photo_limit == 1048576) {
					$photo_limit = '1,0 MB';
				} elseif ($photo_limit == 1572864) {
					$photo_limit = '1,5 MB';
				} elseif ($photo_limit == 2097152) {
					$photo_limit = '2,0 MB';
				} elseif ($photo_limit == 2621440) {
					$photo_limit = '2,5 MB';
				} elseif ($photo_limit == 3145728) {
					$photo_limit = '3,0 MB';
				} elseif ($photo_limit == 3670016) {
					$photo_limit = '3,5 MB';
				} elseif ($photo_limit == 4194304) {
					$photo_limit = '4,0 MB';
				} elseif ($photo_limit == 5242880) {
					$photo_limit = '5,0 MB';
				} elseif ($photo_limit == 10485760) {
					$photo_limit = '10,0 MB';
				} elseif ($photo_limit == 15728640) {
					$photo_limit = '15,0 MB';
				} elseif ($photo_limit == 52428800) {
					$photo_limit = '50,0 MB';
				} elseif ($photo_limit == 157286400) {
					$photo_limit = '150,0 MB';
				}

				if (isset($_GET['thank-you'])) {
					$html .= '<div class="contest-info-bar-green"><i class="fa fa-check"></i> ' . __('Thank you!', 'photo-contest') . '</div>';
				}

				$html .= '<div class="contest-upload-form-box">';
				$html .= '<div class="modern-p-form p-form-modern-slateGray form-white-back">';
				$html .= '<div data-base-class="p-form" class="p-form p-bordered">';

				if (!($nmb_img == '1000000')) {
					$html .= '<div class="contest-small-font"><i class="fa fa-info-circle" aria-hidden="true" style="font-size: 1.1em;"></i> ' . __('You can upload max.', 'photo-contest') . ' ' . $nmb_img . ' ' . __('photo/photos.', 'photo-contest') . '</div>';
				}
				$html .= '<div class="contest-small-font"><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 1.1em;"></i> ' . __('You have already uploaded', 'photo-contest') . ' ' . $number_images . ' ' . __('photo/photos.', 'photo-contest') . '</div>';
				if (!empty($error)) {
					foreach ($error as $item) {
						$html .= '<div class="contest-small-font contest-red-color"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 1.1em;"></i> ' . $item . '</div>';
					}
				}


				if (($nmb_img - $number_images) < 1) {
					$html .= '<div class="contest-small-font"><i class="fa fa-check-circle" aria-hidden="true" style="font-size: 1.1em;"></i> <span class="contest-red-color">' . __('You have uploaded the maximum number of photos. Thank you!', 'photo-contest') . '</span></div>';
				} else {

					$html .= '<form id="new-post" enctype="multipart/form-data" action="" method="post">';

					if (isset($_POST['photo-name'])) {
						$photo_name = $_POST['photo-name'];
					} else {
						$photo_name = "";
					}
					if (isset($_POST['photo-title'])) {
						$photo_title = $_POST['photo-title'];
					} else {
						$photo_title = "";
					}
					if (isset($_POST['photo-description'])) {
						$photo_description = $_POST['photo-description'];
					} else {
						$photo_description = "";
					}
					if (isset($_POST['username'])) {
						$photo_username = $_POST['username'];
					} else {
						$photo_username = "";
					}
					if (isset($_POST['email'])) {
						$photo_email = $_POST['email'];
					} else {
						$photo_email = "";
					}
					if (isset($_POST['dateofbirth'])) {
						$dateofbirth_value = $_POST['dateofbirth'];
					} else {
						$dateofbirth_value = "";
					}
					if (isset($_POST['address'])) {
						$address_value = $_POST['address'];
					} else {
						$address_value = "";
					}
					if (isset($_POST['city'])) {
						$city_value = $_POST['city'];
					} else {
						$city_value = "";
					}
					if (isset($_POST['zip_code'])) {
						$zip_code_value = $_POST['zip_code'];
					} else {
						$zip_code_value = "";
					}
					if (isset($_POST['state'])) {
						$state_value = $_POST['state'];
					} else {
						$state_value = "";
					}
					if (isset($_POST['country'])) {
						$country_value = $_POST['country'];
					} else {
						$country_value = "";
					}
					if (isset($_POST['gender'])) {
						$gender_value = $_POST['gender'];
					} else {
						$gender_value = "";
					}
					if (isset($_POST['gender_3'])) {
						$gender_3_value = $_POST['gender_3'];
					} else {
						$gender_3_value = "";
					}
					if (isset($_POST['www'])) {
						$www_value = $_POST['www'];
					} else {
						$www_value = "";
					}
					if (isset($_POST['phone'])) {
						$phone_value = $_POST['phone'];
					} else {
						$phone_value = "";
					}
					if (isset($_POST['facebook'])) {
						$facebook_value = $_POST['facebook'];
					} else {
						$facebook_value = "";
					}
					if (isset($_POST['twitter'])) {
						$twitter_value = $_POST['twitter'];
					} else {
						$twitter_value = "";
					}
					if (isset($_POST['instagram'])) {
						$instagram_value = $_POST['instagram'];
					} else {
						$instagram_value = "";
					}
					if (isset($_POST['custom_field_personal'])) {
						$custom_field_personal_value = $_POST['custom_field_personal'];
					} else {
						$custom_field_personal_value = "";
					}
					if (isset($_POST['custom_field_personal_required'])) {
						$custom_field_personal_value_required = $_POST['custom_field_personal_required'];
					} else {
						$custom_field_personal_value_required = "";
					}
					if (isset($_POST['camera_model'])) {
						$camera_model_value = $_POST['camera_model'];
					} else {
						$camera_model_value = "";
					}
					if (isset($_POST['custom_field_image'])) {
						$custom_field_image_value = $_POST['custom_field_image'];
					} else {
						$custom_field_image_value = "";
					}

					//Get info about user
					$dateofbirth_meta = get_user_meta($user_ID, 'pcplugin-dateofbirth', true);
					$address_meta = get_user_meta($user_ID, 'pcplugin-adress', true);
					$city_meta = get_user_meta($user_ID, 'pcplugin-city', true);
					$zip_code_meta = get_user_meta($user_ID, 'pcplugin-zip_code', true);
					$state_meta = get_user_meta($user_ID, 'pcplugin-state', true);
					$country_meta = get_user_meta($user_ID, 'pcplugin-country', true);
					$gender_meta = get_user_meta($user_ID, 'pcplugin-gender', true);
					$gender_3_meta = get_user_meta($user_ID, 'pcplugin-gender_3', true);
					$www_meta = get_user_meta($user_ID, 'pcplugin-www', true);
					$phone_meta = get_user_meta($user_ID, 'pcplugin-phone', true);
					$facebook_meta = get_user_meta($user_ID, 'pcplugin-facebook', true);
					$twitter_meta = get_user_meta($user_ID, 'pcplugin-twitter', true);
					$instagram_meta = get_user_meta($user_ID, 'pcplugin-instagram', true);
					$custom_field_personal_meta = get_user_meta($user_ID, 'pcplugin-custom_field_personal_' . $related_contest->id, true);
					$custom_field_personal_meta_required = get_user_meta($user_ID, 'pcplugin-custom_field_personal_required_' . $related_contest->id, true);

					$sql_cat = $wpdb->get_results("SELECT name,id,related_to_contest FROM " . $wpdb->prefix . "photo_contest_cat WHERE related_to_contest = " . $contest_id . " ORDER BY name ASC");

					if (!is_user_logged_in()
						or $dateofbirth == 2 and empty($dateofbirth_meta)
						or $address == 2 and empty($address_meta)
						or $city == 2 and empty($city_meta)
						or $zip_code == 2 and empty($zip_code_meta)
						or $state == 2 and empty($state_meta)
						or $country == 2 and empty($country_meta)
						or $phone == 2 and empty($phone_meta)
						or $www == 2 and empty($www_meta)
						or $fb_page == 2 and empty($facebook_meta)
						or $twitter_page == 2 and empty($twitter_meta)
						or $instagram_page == 2 and empty($instagram_meta)
						or $custom_field_personal == 2 and empty($custom_field_personal_meta)
						or $custom_field_personal_required == 2 and empty($custom_field_personal_meta_required)
						or $gender == 2 and empty($gender_meta)
						or $gender_3 == 2 and empty($gender_3_meta)
					) {
						$html .= '<div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side">' . __('Personal details:', 'photo-contest') . '</span></div>';
					}

					if (function_exists('wsl_render_auth_widget')) {
						$html .= wsl_render_auth_widget();
					}
					if (function_exists('oa_social_login_render_login_form') and !is_user_logged_in()) {
						$html .= oa_social_login_render_login_form('shortcode');
					}

					if (!is_user_logged_in()) {
						//Username
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="username"><strong>' . __('Your Name:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_username" name="username" class="form-control" value="' . $photo_username . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-user-o" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
						//Email
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="email"><strong>' . __('Your Email:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_email" name="email" class="form-control" value="' . $photo_email . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-envelope-o"></i></span></div>';
						$html .= '</div>';
					}


					//Date of birth
					if ($dateofbirth == 2 and empty($dateofbirth_meta)) {
						$html .= pcplugin_datepicker_java();
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="dateofbirth"><strong>' . __('Date of birth:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="dateofbirth" name="dateofbirth" class="form-control" value="' . $dateofbirth_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Address
					if ($address == 2 and empty($address_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="address"><strong>' . __('Address:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_address" name="address" class="form-control" value="' . $address_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-home" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//City
					if ($city == 2 and empty($city_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="city"><strong>' . __('City:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_city" name="city" class="form-control" value="' . $city_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-building-o" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Zip/Postal Code
					if ($zip_code == 2 and empty($zip_code_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="zip_code"><strong>' . __('Zip/Postal Code:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_zip_code" name="zip_code" class="form-control" value="' . $zip_code_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-bookmark-o" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//State
					if ($state == 2 and empty($state_meta)) {
						$html .= '<div class="upload-label"><label for="state"><strong>' . __('State:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="form-group">';
						$html .= '<label class="input-group p-custom-arrow p-has-icon">';
						$html .= pcplugin_states($state_value);
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>';
						$html .= '</div>';
					}
					//Country
					if ($country == 2 and empty($country_meta)) {
						$html .= '<div class="upload-label"><label for="country"><strong>' . __('Country:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="form-group">';
						$html .= '<label class="input-group p-custom-arrow p-has-icon">';
						$html .= pcplugin_countries($country_value);
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-globe" aria-hidden="true"></i></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>';
						$html .= '</div>';
					}
					//Phone number
					if ($phone == 2 and empty($phone_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="phone"><strong>' . __('Phone number:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_phone" name="phone" class="form-control" value="' . $phone_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-phone" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//www
					if ($www == 2 and empty($www_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="www"><strong>' . __('Blog/Gallery/Website:', 'photo-contest') . '</strong> <span class="contest-small-font-2">' . __('(Optional)', 'photo-contest') . '</span></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_www" name="www" class="form-control" value="' . $www_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-link" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Facebook
					if ($fb_page == 2 and empty($facebook_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="facebook"><strong>' . __('Facebook:', 'photo-contest') . '</strong> <span class="contest-small-font-2">' . __('(Optional)', 'photo-contest') . '</span></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_facebook" name="facebook" class="form-control" value="' . $facebook_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-facebook" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Twitter
					if ($twitter_page == 2 and empty($twitter_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="twitter"><strong>' . __('Twitter:', 'photo-contest') . '</strong> <span class="contest-small-font-2">' . __('(Optional)', 'photo-contest') . '</span></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_twitter" name="twitter" class="form-control" value="' . $twitter_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-twitter" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Instagram
					if ($instagram_page == 2 and empty($instagram_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="instagram"><strong>' . __('Instagram:', 'photo-contest') . '</strong> <span class="contest-small-font-2">' . __('(Optional)', 'photo-contest') . '</span></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_instagram" name="instagram" class="form-control" value="' . $instagram_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-instagram" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Custom Field
					if ($custom_field_personal == 2 and empty($custom_field_personal_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="custom_field_personal"><strong>' . $custom_field_personal_name . '</strong> <span class="contest-small-font-2">' . __('(Optional)', 'photo-contest') . '</span></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_custom_field_personal" name="custom_field_personal" class="form-control" value="' . $custom_field_personal_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Custom Field Required
					if ($custom_field_personal_required == 2 and empty($custom_field_personal_meta_required)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="custom_field_personal_required"><strong>' . $custom_field_personal_name_required . '</strong></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_custom_field_personal_required" name="custom_field_personal_required" class="form-control" value="' . $custom_field_personal_value_required . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Gender
					if ($gender == 2 and empty($gender_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="gender"><strong>' . __('Gender:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="p-form-cg pt-form-inline">';
						$html .= '<div class="radio">';
						$html .= '<label>';
						$html .= '<input ' . ($gender_value == "male" ? "checked" : "") . ' type="radio" name="gender" value="male">';
						$html .= '<span class="p-check-icon"><span class="p-check-middle"><i class="fa fa-male"></i></span></span> <span class="p-label">Male</span></label>';
						$html .= '</div>';
						$html .= ' <div class="radio">';
						$html .= '<label>';
						$html .= '<input ' . ($gender_value == "female" ? "checked" : "") . ' type="radio" name="gender" value="female">';
						$html .= '<span class="p-check-icon"><span class="p-check-middle"><i class="fa fa-female"></i></span></span> <span class="p-label">Female</span></label>';
						$html .= '</div>';
						$html .= '</div>';
						$html .= '</div>';
					}
					//Gender 3
					if ($gender_3 == 2 and empty($gender_3_meta)) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="gender_3"><strong>' . __('Gender:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="p-form-cg pt-form-inline">';
						$html .= '<div class="radio">';
						$html .= '<label>';
						$html .= '<input ' . ($gender_3_value == "male" ? "checked" : "") . ' type="radio" name="gender_3" value="male">';
						$html .= '<span class="p-check-icon"><span class="p-check-middle"><i class="fa fa-male"></i></span></span> <span class="p-label">Male</span></label>';
						$html .= '</div>';
						$html .= ' <div class="radio">';
						$html .= '<label>';
						$html .= '<input ' . ($gender_3_value == "female" ? "checked" : "") . ' type="radio" name="gender_3" value="female">';
						$html .= '<span class="p-check-icon"><span class="p-check-middle"><i class="fa fa-female"></i></span></span> <span class="p-label">Female</span></label>';
						$html .= '</div>';
						$html .= '<div class="radio">';
						$html .= '<label>';
						$html .= '<input ' . ($gender_3_value == "other" ? "checked" : "") . ' type="radio" name="gender_3" value="other">';
						$html .= '<span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">other</span></label>';
						$html .= '</div>';
						$html .= '</div>';
						$html .= '</div>';
					}

					if (

						!is_user_logged_in()
						or $dateofbirth == 2 and empty($dateofbirth_meta)
						or $address == 2 and empty($address_meta)
						or $city == 2 and empty($city_meta)
						or $zip_code == 2 and empty($zip_code_meta)
						or $state == 2 and empty($state_meta)
						or $country == 2 and empty($country_meta)
						or $phone == 2 and empty($phone_meta)
						or $www == 2 and empty($www_meta)
						or $fb_page == 2 and empty($facebook_meta)
						or $twitter_page == 2 and empty($twitter_meta)
						or $instagram_page == 2 and empty($instagram_meta)
						or $custom_field_personal == 2 and empty($custom_field_personal_meta)
						or $custom_field_personal_required == 2 and empty($custom_field_personal_meta_required)
						or $gender == 2 and empty($gender_meta)
						or $gender_3 == 2 and empty($gender_3_meta)
					) {
						$html .= '<div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side">' . __('Image details:', 'photo-contest') . '</span></div>';
					}
					//Title
					$html .= '<div class="form-group">';
					$html .= '<div class="upload-label"><label for="photo-name"><strong>' . __('Title:', 'photo-contest') . '</strong></label></div>';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<input type="text" id="pc_photo-name" name="photo-name" class="form-control" value="' . $photo_name . '">';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></div>';
					$html .= '</div>';
					//Description
					if ($description == 2) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="photo-description"><strong>' . __('Description:', 'photo-contest') . '</strong> <span class="contest-small-font-2">' . __('(Optional)', 'photo-contest') . '</span></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<textarea id="textarea" name="photo-description" class="form-control">' . $photo_description . '</textarea>';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-file-text-o"></i></span></div>';
						$html .= '</div>';
					}
					//Camera model
					if ($camera_model == 2) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="camera_model"><strong>' . __('Camera model:', 'photo-contest') . '</strong> <span class="contest-small-font-2">' . __('(Optional)', 'photo-contest') . '</span></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_camera_model" name="camera_model" class="form-control" value="' . $camera_model_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-camera" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Custom image Field
					if ($custom_field_image == 2) {
						$html .= '<div class="form-group">';
						$html .= '<div class="upload-label"><label for="custom_field_image"><strong>' . $custom_field_image_name . '</strong> <span class="contest-small-font-2">' . __('(Optional)', 'photo-contest') . '</span></label></div>';
						$html .= '<div class="input-group p-has-icon">';
						$html .= '<input type="text" id="pc_custom_field_image" name="custom_field_image" class="form-control" value="' . $custom_field_image_value . '">';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></div>';
						$html .= '</div>';
					}
					//Category
					if (!empty($sql_cat)) {
						$html .= '<div class="upload-label"><label for="photo-category"><strong>' . __('Category:', 'photo-contest') . '</strong></label></div>';
						$html .= '<div class="form-group">';
						$html .= '<label class="input-group p-custom-arrow p-has-icon">';
						$html .= '<select name="photo-category" id="photo-category" class="form-control">';
						foreach ($sql_cat as $item) {
							$html .= '<option value="' . $item->id . '">' . stripslashes($item->name) . '</option>';
						}
						$html .= '</select>';
						$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-sort" aria-hidden="true"></i></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>';
						$html .= '</div>';
					}
					//Select Image
					$html .= '<div class="upload-label"><label for="contest-photo"><strong>' . __('Select image: (max.', 'photo-contest') . ' ' . $photo_limit . ')</strong></label></div>';
					$html .= '<div class="p-file-wrap">';
					$html .= '<input type="file" id="contest-photo" name="contest-photo" placeholder="' . __('select image', 'photo-contest') . '" onchange="document.getElementById(\'contest-photo-fake\').value = this.value; document.getElementById(\'pcphoto\').src = window.URL.createObjectURL(this.files[0])" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/png onchange="loadFile(event)">';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<input type="text" id="contest-photo-fake" placeholder="' . __('select image', 'photo-contest') . '" readonly class="form-control p-ignore-field" accept="image/x-png,image/gif,image/jpeg">';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-download"></i></span> <span class="input-group-btn">';
					$html .= '<button type="button" class="pc-btn">' . __('browse', 'photo-contest') . '</button>';
					$html .= '</span></div>';
					$html .= '</div>';

					$html .= '<div class="prewphoto"><img id="pcphoto" alt="" width="auto" max-width="100%" height="auto"  max-height="100%" display="none" object-fit="contain"; /></div>';
					$html .= '<div class="clear"></div>';

					//Agree checkboxes
					if ($agree_age_13 == 2 or $agree_age_18 == 2 or $agree_terms == 2 or $allow_GDPR == 1 and !is_user_logged_in() or $allow_GDPR == 1 and is_user_logged_in() and empty(get_user_meta(get_current_user_id(), 'agree-GDPR', true))) {
						$html .= '<div class="form-group">';
						$html .= '<div class="p-form-cg  pt-form-panel">';
					}
					if ($agree_age_13 == 2) {
						$html .= '<div class="checkbox" style="display:block">';
						$html .= '<label>';
						$html .= '<input type="checkbox" name="agree_age_13" ' . (isset($_POST['agree_age_13']) ? "checked" : "") . ' value="ch">';
						$html .= '<span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">' . __('I confirm that I am over the age of 13', 'photo-contest') . '</span></label>';
						$html .= '</div>';
					}
					if ($agree_age_18 == 2) {
						$html .= '<div class="checkbox" style="display:block">';
						$html .= '<label>';
						$html .= '<input type="checkbox" name="agree_age_18" ' . (isset($_POST['agree_age_18']) ? "checked" : "") . ' value="ch">';
						$html .= '<span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">' . __('I confirm that I am over the age of 18', 'photo-contest') . '</span></label>';
						$html .= '</div>';
					}
					if ($agree_terms == 2) {
						$condition_url = add_query_arg('contest', 'contest-condition', $current_url);
						$html .= '<div class="checkbox" style="display:block">';
						$html .= '<label>';
						$html .= '<input type="checkbox" name="agree_terms" ' . (isset($_POST['agree_terms']) ? "checked" : "") . ' value="ch">';
						if ($related_contest->contest_mode == 3) {
							$html .= '<span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">' . __('I have read and accept Official contest rules', 'photo-contest') . '</span></label>';
							$html .= '</div>';
						} else {
							$html .= '<span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">' . sprintf(__('I have read and accept <a href="%s" target="_blank">Official contest rules</a>', 'photo-contest'), esc_url($condition_url)) . '</span></label>';
							$html .= '</div>';
						}
					}
					//GDPR
					if ($allow_GDPR == 1 and !is_user_logged_in() or $allow_GDPR == 1 and is_user_logged_in() and empty(get_user_meta(get_current_user_id(), 'agree-GDPR', true))) {
						$allow_GDPR_text = get_option('pcplugin-allow-GDPR-text');
						$allow_GDPR_notice = stripslashes(get_option('pcplugin-allow-GDPR-notice'));


						$html .= '<div class="checkbox" style="display:block">';
						$html .= '<label>';
						$html .= '<input type="checkbox" name="agree-GDPR" ' . (isset($_POST['agree-GDPR']) ? "checked" : "") . ' value="ch">';
						$html .= '<span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">' . stripslashes($allow_GDPR_text) . '</span></label>';
						$html .= '</div>';

						$html .= '<div class="gdprtext">';
						$html .= $allow_GDPR_notice;
						$html .= '</div>';
					}
					if ($agree_age_13 == 2 or $agree_age_18 == 2 or $agree_terms == 2 or $allow_GDPR == 1 and !is_user_logged_in() or $allow_GDPR == 1 and is_user_logged_in() and empty(get_user_meta(get_current_user_id(), 'agree-GDPR', true))) {
						$html .= '</div>';//form-group
						$html .= '</div>';//p-form-cg
					}

					//Hidden inputs and security
					$html .= '<input type="hidden" name="user_id" />';
					$html .= wp_nonce_field('submit_picture');
					$html .= '<input type="hidden" name="action" value="new_post" />';
					$html .= '<input type="hidden" name="upload-action" value="new_post" />';
					$html .= '<input type="hidden" name="photo-upload-hidden" value="new_post" />';//important for welcome email
					$html .= '<div class="clear"></div>';

					//reCaptcha
					$site_key = get_option('pcplugin-site-key');
					if ($allow_reCaptcha == 1 && $site_key || $allow_reCaptcha == 3 && $site_key && !is_super_admin()) {
						$html .= '<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
							<script>
								var recaptcha1;
								var myCallBack = function() {
								//Render the recaptcha1 on the element with ID "recaptcha1"
								recaptcha1 = grecaptcha.render(\'recaptcha1\', {
									\'sitekey\' : \'' . $site_key . '\', //Replace this with your Site key
									\'theme\' : \'light\',
									\'callback\' : \'enableBtn2\'
								});
								};
							</script>';
					}
					//reCaptcha
					if ($allow_reCaptcha == 1 && $site_key || $allow_reCaptcha == 3 && $site_key && !is_super_admin()) {
						$html .= '<div id="recaptcha1" class="g-recaptcha"></div>';
						$html .= "<script type='text/javascript'>
							function enableBtn2(){
							document.getElementById('wp-submit2').disabled = false;
							}
							</script>
							";
						$html .= '<div class="preview-btn text-center p-buttons"><button class="pc-btn" type="submit" name="wp-submit2" id="wp-submit2" disabled="disabled">' . __('Submit Photo', 'photo-contest') . '</button></div>';
					} else {
						$html .= '<div class="preview-btn text-center p-buttons"><button class="pc-btn" type="submit" name="wp-submit2" id="wp-submit2">' . __('Submit Photo', 'photo-contest') . '</button></div>';
					}

					$html .= '<div class="clear"></div>';

					$html .= '</form>';
				}
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
			}
		} //Main Form End
	}

}//if ($force_registration==1 or $force_registration==2 and is_user_logged_in) {

if ($force_registration == 2 and !is_user_logged_in()) {
	include_once(plugin_dir_path(__DIR__) . 'includes/pc-loginform.php');
	$html .= '<div class="pc-register-bottom-box pc-bordered">';
	$html .= '<div class="contest-message-box">' . __('You are not logged in. Only registered users can participate in the contest. Please log in or sign up to continue!', 'photo-contest');
	$html .= pc_loginform($related_contest->contest_mode);
	$html .= '</div>';
}

//End control user login
$html .= '</div>'; // class photo-contest end
$html .= '<div class="clear"></div>';//important

?>
