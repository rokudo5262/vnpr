<?php
//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}
include (plugin_dir_path( __DIR__ )."includes/pc-gallery-functions.php");


$error = array();

//Check if exist contest to this page
$current_user_id   = get_current_user_id();

$allow_reCaptcha = get_option('pcplugin-allow-reCaptcha');

//If contest not exist
if (empty($related_contest)) {
	wp_redirect(get_permalink());
}
//If is there Upload form mode
if ($related_contest->contest_mode != 1 and is_user_logged_in()){
  wp_redirect(get_permalink());
}
//Hide your images section
$hide_profilebutton = $related_contest->hide_your;
if ($hide_profilebutton == 2 and !is_super_admin() and is_user_logged_in()) {
	wp_redirect(get_permalink());
}
//Redirect if the editation is not allowed
if (isset($_GET['image-edit']) and $related_contest->allow_user_edit==1 or empty($related_contest->allow_user_edit)){
	wp_redirect(get_permalink());
}
//Redirect if user try to edit someone else's image
if (isset($_GET['image-edit'])){
	$author_id = get_post_meta($_GET['image-edit'],'contest-photo-author',true);
	if ($current_user_id != $author_id){
		wp_redirect(get_permalink());
	}
}
//Redirect if user try to delete someone else's image
if (isset($_GET['delete'])){
	$author_id = get_post_meta($_GET['delete'],'contest-photo-author',true);
	if ($current_user_id != $author_id){
		wp_redirect(get_permalink());
	}
}
// Recaptcha Validation
if (isset($_POST['g-recaptcha-response']) && $allow_reCaptcha == 1 or isset($_POST['g-recaptcha-response']) && $allow_reCaptcha == 3) {
	//your site secret key
	$secret         = get_option('pcplugin-secret-key');
	//get verify response data
	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
	$responseData   = json_decode($verifyResponse);
	if ($responseData->success) {
	} else {
		$error['recaptcha'] = __('ReCaptcha was not validated correctly!', 'photo-contest');
	}
}
//Delete image
if(isset($_GET['delete']) and $related_contest->allow_user_edit==3){
	$author_id = get_post_meta($_GET['delete'],'contest-photo-author',true);
	if ($current_user_id == $author_id){
		delete_post_meta($_GET['delete'],'contest-active');
		delete_post_meta($_GET['delete'],'contest-photo-points');
		delete_post_meta($_GET['delete'],'contest-photo-category');
		delete_post_meta($_GET['delete'],'post_views_count');
		delete_post_meta($_GET['delete'],'contest-photo-ip');
		delete_post_meta($_GET['delete'],'contest-user-name');
		delete_post_meta($_GET['delete'],'contest-user-email');
		delete_post_meta($_GET['delete'],'contest-photo-users');
		delete_post_meta($_GET['delete'],'photo-upload-ip');
		delete_post_meta($_GET['delete'],'camera-model');
		delete_post_meta($_GET['delete'],'custom-field');
		delete_post_meta($_GET['delete'],'contest-photo-emails');
		delete_post_meta($_GET['delete'],'image-country');
		//Version 4.1
		delete_post_meta($_GET['delete'],'contest-photo-rate5');
		delete_post_meta($_GET['delete'],'contest-photo-rate10');
		delete_post_meta($_GET['delete'],'contest-photo-rate5-total');
		delete_post_meta($_GET['delete'],'contest-photo-rate10-total');

		$related_to_contest = get_post_meta($_GET['delete'],'photo-related-to-contest',true);
		delete_post_meta($_GET['delete'],'contest-photo-author');

		$contest_user_images = 'contest_user_images_'.$related_to_contest;
		$number_images = get_user_meta($author_id, $contest_user_images, true);
		$number_images = $number_images-1;
		update_user_meta($author_id, 'contest_user_images_'.$related_to_contest, $number_images);
		delete_post_meta($_GET['delete'],'photo-related-to-contest');
		wp_redirect(get_permalink().'?contest=contest-profile');
		}else{
			wp_redirect(get_permalink().'?contest=contest-profile');
		}
	}


	if (isset($_POST['action'])) {
		$nonce = $_REQUEST['_wpnonce'];
		if ( ! wp_verify_nonce( $nonce, 'register_pcontest' ) ) {
			exit; // Get out of here, the nonce is rotten!
		}
		//Sanitize Post
		$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if (empty($_POST['username'])) {
			$error['username'] = __('Please state Username!', 'photo-contest');
		} else {
			$username = trim($_POST['username']);
		}
		if (username_exists($_POST['username'])) {
			$error['username'] = __('This Name is already taken!', 'photo-contest');
		}
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$error['email'] = "Invalid email format";
		}
		//Email filter
		$email_filter = get_option('pcplugin-email-filter');
		if ($email_filter==2) {
			if (isset($_POST['email']) and pc_is_disposable_mail($_POST['email'])==1) {
				$error['disposable-email'] = __('This email domain is not allowed', 'photo-contest');
			}
		}
		if (empty($_POST['email'])) {
			$error['email'] = __('Please enter the Email!', 'photo-contest');
		} else {
			$email = trim($_POST['email']);
		}
		if (email_exists($_POST['email'])) {
			$error['email'] = __('This email is already used! If you have already registered to the contest please first log in!', 'photo-contest') . '';
		}

		if (empty($error)) {
			if (!is_user_logged_in()) {
				$register = pc_register($username, $email);
			}
		}

    }
		//Log In user
		if (isset($_POST['log']) and !is_user_logged_in()){
			$user_log = wp_signon();
			if ( is_wp_error($user_log) ){
				$error['login'] = __('Username or Password was not correct!', 'photo-contest');
			}else{
				$redirect = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				wp_redirect(get_permalink());
			}
		}

    if (is_user_logged_in()) {
      $args      = array(
          'post_type' => 'attachment',
          'posts_per_page' => 100,
          'post_status' => 'any',
          'post_parent' => null,
          'author' => $current_user_id,
          'orderby' => 'post_date',
          'order' => 'DESC',
          'meta_query' => array(
              array(
                  'key' => 'contest-active'
              ),
              array(
                  'key' => 'photo-related-to-contest',
                  'value' => $related_contest->id
              )
          )

      );


			//Hide Views
			if ($related_contest->hide_views == "2" and !is_super_admin()) {
				$hide_views = " pc_displaynone";
			} else {
				$hide_views = " pc_visible";
			}

			$html = '<div class="photo-contest ' . $animation . ' ' . $font_size . '">';
			$columns_number = $related_contest->contest_columns;
			if ($columns_number == 4 or $columns_number == 5) {
				$addwidth = " plusfive";
			} elseif ($columns_number == 2) {
				$addwidth = " plusthree";
			} elseif ($columns_number == 3 or $columns_number == 4) {
				$addwidth = " plussix";
			} else {
				$addwidth = "";
			}

			//EDIT image
			if (isset($_GET['image-edit'])){

				$postid = $_GET['image-edit'];
				$user_current_ID = get_current_user_id();
				$authorid = get_post_field( 'post_author', $postid );

				if ($authorid != $user_current_ID){
					die();
				}
				$image_attributes = wp_get_attachment_image_src( $postid, 'full' );

				//Description value
				$description = "";
				if (isset($_POST['photo-description'])){
					$description = $_POST['photo-description'];
				}

				if (isset ($_POST['photo-name'])){
					$my_post = array(
					'ID'           => $postid,
					'post_title' => $_POST['photo-name'],
					'post_content' => $description,
					);

					// Update the post into the database
					if (!empty($_POST['photo-name'])){
						wp_update_post( $my_post );
					}
				}
				// Update camera model
				if (isset($_POST['camera-model'])) {
					update_post_meta($postid, 'camera-model', $_POST['camera-model']);
				}
				// Update custom field
				if (isset($_POST['custom_field_image'])) {
					update_post_meta($postid, 'custom-field', $_POST['custom_field_image']);
				}
				$photo_name = get_the_title($postid);
				$photo_description = get_post_field('post_content', $postid);
				$camera_model_value =  get_post_meta($postid,'camera-model',true);
				$custom_field_image_value =  get_post_meta($postid,'custom-field',true);
				$image_delete_url = add_query_arg( array('contest' => 'contest-profile','delete' => $postid), $current_url );
				if (isset ($_POST['photo-name'])){
					if (empty($_POST['photo-name'])){
						$error['name'] = __('Please enter a Title!','photo-contest');
					}
				}
				if (isset ($_POST['photo-edit-category-select'])){
					if (empty($_POST['photo-edit-category-select']) || $_POST['photo-edit-category-select']==0 ){
						$error['category'] = __('Please select a category!','photo-contest');
					}
				}
				$html .='<div class="pc-profile-box">';
				$html .='<h2>'.__('Edit Image','photo-contest').'</h2>';
				$html .='<div class="pc-edit-thumb"><img src="'.$image_attributes[0].'" alt=""></div>';
				$html .='<div style="margin-top:20px;"></div>';
				$html .='<div class="modern-p-form p-form-modern-slateGray">';
				$html .='<form action="" method="post" enctype="multipart/form-data" class="form-group p-field-error">';

				//Title
				$html .= '<div class="form-group">';
				$html .= '<label for="photo-name">'.__('Title','photo-contest').'</label>';
				$html .= '<div class="input-group p-has-icon">';
				$html .= '<input type="text" id="photo-name" name="photo-name" placeholder="'.__('Title:','photo-contest').'" class="form-control" value="'.$photo_name.'">';
				$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span>';
				if (isset($error['name'])) {
					$html .= '<span class="p-error-text"><i class="fa fa-times"></i></span>';
				}
				$html .= '</span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o"></i></span></div>';
				if (isset($error['name'])) {
					$html .= '<span class="p-field-sub-text"><i class="fa fa-times p-error-text"></i> '.__('please enter a title!', 'photo-contest').'</span>';
				}
				$html .= '</div>';

				// Category
				$photo_id = $_GET['image-edit'];
				$category_id = get_post_meta($photo_id,'contest-photo-category',true);
				$sql= $wpdb->get_results("SELECT name,id FROM ".$wpdb->prefix."photo_contest_cat ORDER BY name ASC");

				if (isset ($_POST['photo-edit-category-select'])) {
					update_post_meta($photo_id, 'contest-photo-category', $_POST['photo-edit-category-select']);
				}

				if(!empty($sql)){
					$html .= '<div class="form-group">';
					$html .= '<label for="photo-edit-category-select">'.__('Category:','photo-contest').'</label>';
					$html .= '<label class="input-group p-custom-arrow">';
					$html .= '<select id="photo-edit-category-select" name="photo-edit-category-select" class="form-control">';
					$category_id = get_post_meta($photo_id,'contest-photo-category',true);
					if (empty($category_id)){
						$category_id = "0";
					}
					$html .= '<option '. (($category_id==900000)?'selected="selected"':"").' value="0">'.__('No Category').'</option>';
					if(!empty($sql)){
						foreach($sql as $item){
							$html .= '<option '. (($item->id==$category_id)?'selected="selected"':"").' value="'.$item->id.'">'.stripslashes($item->name).'</option>';
						}
					}

					$html .= '</select>';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span>';
					if (isset($error['category'])) {
						$html .= '<span class="p-error-text"><i class="fa fa-times"></i></span>';
					}
					$html .= '</span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>';
					if (isset($error['category'])) {
						$html .= '<span class="p-field-sub-text"><i class="fa fa-times p-error-text"></i> '.__('please select a category!', 'photo-contest').'</span>';
					}
					$html .= '</div>';
				}//if(!empty($sql))

				//Description field
				$description = $related_contest->description;
				if ($description ==2){
					$html .= '<div class="form-group">';
					$html .= '<label for="photo-description">'.__('Description','photo-contest').' <em><small>'.__('(Optional)','photo-contest').'</small></em></label>';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<textarea id="photo-description" name="photo-description" class="form-control">'.stripslashes($photo_description).'</textarea>';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-file-text-o"></i></span></div>';
					$html .= '</div>';
				}
				//Camera Model
				$camera_model = $related_contest->camera_model;
				if ($camera_model ==2){
					$html .= '<div class="form-group">';
					$html .= '<label for="camera-model">' . __('Camera model', 'photo-contest') . '</label>';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<input type="text" id="camera-model" name="camera-model" class="form-control" value="'.$camera_model_value.'">';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span>';
					$html .= '</span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-camera"></i></span></div>';
					$html .= '</div>';
				}
				//Custom image field
				$custom_field_image = $related_contest->custom_field_image;
				$custom_field_image_name = $related_contest->custom_field_image_name;
				if ($custom_field_image ==2){
					//If is custom image field empty
					if (empty($custom_field_image_name)) {
						$custom_field_image_name = __('Custom image field', 'photo-contest');
					}
					$html .= '<div class="form-group">';
					$html .= '<label for="custom_field_image">' .stripslashes($custom_field_image_name). '</label>';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<input type="text" id="custom_field_image" name="custom_field_image" class="form-control" value="'.stripslashes($custom_field_image_value).'">';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span>';
					$html .= '</span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o"></i></span></div>';
					$html .= '</div>';
			 }

			$html .='<div class="preview-btn text-center p-buttons"><button class="pc-btn" type="submit" name="submit"><i class="fa fa-sign-in"></i>&nbsp;'.__('Edit','photo-contest').'</button></div>';
			$html .='</form>';
			$html .= '</div>';
			$html .= '<div class="clear"></div>';

			if ($related_contest->allow_user_edit==3){
				$html .= '<div class="us-delete-image"><a href="'.$image_delete_url.'" onclick="return confirm(\''.__('Are you really sure that you want delete this image?','photo-contest').'\');"><i class="fa fa-trash-o"></i> '.__('Delete Image!','photo-contest').'</a> '.__('Warning! After click "Delete Image!" will be item permanently deleted!').'</div>';
			}

			$html .= '</div>';
		}

		$attachments = get_posts($args);
		if (empty($attachments)) {
		  $html .= '<div class="contest-info-bar"><i class="fa fa-exclamation-triangle"></i> ' . __('You must first upload an image!!', 'photo-contest') . '</div>';
		}

		$html .= '<div class="gallery-wrap' . $addwidth . '">';
		if ($attachments) {
			foreach ($attachments as $contestitem) {
				$image_attributes = wp_get_attachment_image_src($contestitem->ID, 'gallery-middle');
				$full_image       = wp_get_attachment_image_src($contestitem->ID, 'full');
				$current_url      = get_permalink();
				$author_id        = get_post_meta($contestitem->ID, 'contest-photo-author', true);
				$user             = get_user_by('id', $author_id);
				$image_edit_url   = add_query_arg( array('contest' => 'contest-profile','image-edit' => $contestitem->ID), $current_url );
				if (!empty($user)) {
					$author = $user->display_name;
				}else {
					$author = __('Deleted user', 'photo-contest');
				}
				$title           = $contestitem->post_title;
				$getallow        = get_post_meta($contestitem->ID, 'contest-active', true);

				//Hide Votes
				if ($related_contest->hide_votes == "2" and !is_super_admin()) {
					$hide_votes = " pc_displaynone";
					$votes = "";
					$vote_rate_text = __('Votes:', 'photo-contest');
					$vote_rate_symbol= '<i class="fa fa-heart fa-fw"></i>';
				} else {
					$hide_votes = " pc_visible";
					$votes = get_post_meta($contestitem->ID,'contest-photo-points',true);
					//Vote-rate counts and symbols
					$vote_rate_text = __('Votes:', 'photo-contest');
					$vote_rate_symbol= '<i class="fa fa-heart fa-fw"></i>';
					if ($related_contest->vote_frequency ==6){
						$numberofstars=5;
						$rating_total = round(get_post_meta($contestitem->ID, 'contest-photo-rate5-total', true),1);
						$votes = $rating_total.'/'.$numberofstars;
						$vote_rate_text = __('Rating:', 'photo-contest');
						$vote_rate_symbol= '<i class="fa fa-star fa-fw"></i>';
					}
					if ($related_contest->vote_frequency ==7){
						$numberofstars=10;
						$rating_total = round(get_post_meta($contestitem->ID, 'contest-photo-rate10-total', true),1);
						$votes = $rating_total.'/'.$numberofstars;
						$vote_rate_text = __('Rating:', 'photo-contest');
						$vote_rate_symbol= '<i class="fa fa-star fa-fw"></i>';
					}//Vote-rate counts and symbols
				}


				//Hide Views
				if ($related_contest->hide_views == "2" and !is_super_admin()) {
					$views = "";
				}else {
					$views = getContestViews($contestitem->ID);
				}

				$blogurl = add_query_arg(array(
				'contest' => 'photo-detail',
				'photo_id' => $contestitem->ID
				), $current_url);
				if ($getallow == 1) {
					$allowed = '<span style="color:#49ba05;">' . __('Active!', 'photo-contest') . '</span>';
				} else {
					$allowed = '<span style="color:#e03b02;">' . __('Waiting for Approval!', 'photo-contest') . '</span>';
				}

				$category_id  = get_post_meta($contestitem->ID, 'contest-photo-category', true);
				$category_url = add_query_arg(array(
				'contest' => 'gallery',
				'order-category' => $category_id
				), $current_url);

				if (empty($category_id)) {
					$category_id = "10000000";
				}


				$sql = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "photo_contest_cat WHERE id = " . $category_id . "");
				if ($related_contest->allow_user_edit==2 or $related_contest->allow_user_edit==3){
					$edit_line = '<div class="pc-edit-image"><a href="'.$image_edit_url.'"><span>'.__('Edit','photo-contest').'</span></a></div>';
				}else{
					$edit_line = '';
				}

				if (!empty($sql)) {
					foreach ($sql as $item) {
						$category_name = $item->name;
						$category      = '<span class="left" title="' . $category_name . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . stripslashes ($category_name) . '</span></span>';
						$category2     = '<span class="left" title="' . $category_name . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . stripslashes (contest_shorter($category_name, 18)) . '</span></span>';
						$category3     = '<span class="left" title="' . $category_name . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . stripslashes (contest_shorter($category_name, 16)) . '</span></span>';
					}
				}else{
					$category  = '';
					$category2 = '';
					$category3 = '';
				}
				if ($author_id == $current_user_id) {
					//Mobile version
					$html .= '<div class="one-full classic zip pcmobile">';
					$html .= '<div class="imagebox"><a data-test="full" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" /></a><div class="clear"></div></div>';
					$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author">' . $allowed . '</div><div class="pc-title">' . $title . '</div><div class="clear"></div>';
					$html .= $edit_line;
					$html .= '<div class="clear"></div>';
					$html .= '</div>';
					$html .= '<div class="gallery-votes">' . $category . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
					$html .= '</div>';

					$html .= '<div class="one-half classic zip pcmobile">';
					$html .= '<div class="imagebox"><a data-test="full" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" /></a><div class="clear"></div></div>';
					$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author">' . $allowed . '</div><div class="pc-title">' . $title . '</div><div class="clear"></div>';
					$html .= $edit_line;
					$html .= '<div class="clear"></div>';
					$html .= '</div>';
					$html .= '<div class="gallery-votes">' . $category . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
					$html .= '</div>';


					if ($columns_number == 1) {
						$html .= '<div class="one-full classic zip pcdesktop">';
						$html .= '<div class="imagebox"><a data-test="full" href="' . $blogurl . '"><img src="' . $full_image[0] . '" /></a><div class="clear"></div></div>';
						$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author">' . $allowed . '</div><div class="pc-title">' . $title . '</div><div class="clear"></div>';
						$html .= $edit_line;
						$html .= '</div>';
						$html .= '<div class="gallery-votes">' . $category . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
						$html .= '</div>';
					} elseif ($columns_number == 2) {
						$html .= '<div class="one-half classic pop pcdesktop">';
						$html .= '<div class="imagebox"><a data-test="middle" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" /></a><div class="clear"></div></div>';
						$html .= '<div class="gallery-title-autor"><div class="author">' . $allowed . '</div><div class="pc-title">' . $title . '</div><div class="clear"></div>';
						$html .= $edit_line;
						$html .= '<div class="clear"></div>';
						$html .= '</div>';
						$html .= '<div class="clear"></div>';
						$html .= '<div class="gallery-votes">' . $category2 . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
						$html .= '</div>';
					} elseif ($columns_number == 3) {
						$html .= '<div class="one-third classic pop pcdesktop">';
						$html .= '<div class="imagebox"><a data-test="middle" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" /></a><div class="clear"></div></div>';
						$html .= '<div class="gallery-title-autor"><div class="author">' . $allowed . '</div><div class="pc-title">' . $title . '</div><div class="clear"></div>';
						$html .= $edit_line;
						$html .= '<div class="clear"></div>';
						$html .= '</div>';
						$html .= '<div class="clear"></div>';
						$html .= '<div class="gallery-votes">' . $category2 . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
						$html .= '</div>';
					} elseif ($columns_number == 4) {
						$html .= '<div class="one-fourth classic pop pcdesktop">';
						$html .= '<div class="imagebox"><a data-test="middle" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" /></a><div class="clear"></div></div>';
						$html .= '<div class="gallery-title-autor"><div class="author">' . $allowed . '</div><div class="pc-title">' . contest_shorter($title, 30) . '</div><div class="clear"></div>';
						$html .= $edit_line;
						$html .= '<div class="clear"></div>';
						$html .= '</div>';
						$html .= '<div class="clear"></div>';
						$html .= '<div class="gallery-votes">' . $category2 . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
						$html .= '</div>';
					} elseif ($columns_number == 5) {
						$html .= '<div class="one-fifth classic pop pcdesktop">';
						$html .= '<div class="imagebox"><a data-test="middle" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" /></a><div class="clear"></div></div>';
						$html .= '<div class="gallery-title-autor"><div class="author">' . $allowed . '</div><div class="pc-title">' . contest_shorter($title, 20) . '</div><div class="clear"></div>';
						$html .= $edit_line;
						$html .= '<div class="clear"></div>';
						$html .= '</div>';
						$html .= '<div class="clear"></div>';
						$html .= '<div class="gallery-votes">' . $category2 . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
						$html .= '</div>';
					}
				}
			}
		}

		$html .= '<div class="clear"></div>';
		$html .= '</div>'; // Gallery wrap end
		$html .= '</div>'; // class photo-contest end
		$html .= '<div class="clear"></div>';//important

	}else{

		$current_url = get_permalink();
		$upload_url  = add_query_arg('contest', 'upload-photo', $current_url);
		//Animation
		$animation   = get_option('pcplugin-allow-animation');
		if (!empty($animation)) {
			if ($animation == 1) {
				$animation = ' photo-contest-animation';
			} else {
				$animation = '';
			}
		} else {
			$animation = ' photo-contest-animation';
		}
		//Font Size
		$font_size = get_option('pcplugin-font-size');
		if (empty($font_size)) {
			$font_size = 'pcfontsize';
		}
		$html = '<div class="photo-contest' . $animation . ' ' . $font_size . '">';
		$html .= '<div class="clear"></div>';

		if (isset($_GET['registration']) and $_GET['registration']=='success'){
			$html .= '<div class="contest-message-box" style="color:#0f79c0;">' . __('Your registration was successful! Please check your email for a password!', 'photo-contest');
		}else{
			$html .= '<div class="contest-message-box">' . __('You are not logged in. To log in, use the information emailed after your first image upload!', 'photo-contest');
		}
		if (isset($error) and !empty($error)) {
			foreach ($error as $item) {
				$html .= '<div class="contest-small-font contest-red-color">' . $item . '</div>';
			}
		}

		$html .= '</div>';
		$html .= '<div class="pc-register-bottom-box">' . pc_loginform($related_contest->contest_mode) . '</div>';
		$html .= '</div>'; // class photo-contest end
		$html .= '<div class="clear"></div>';//important
	}

?>
