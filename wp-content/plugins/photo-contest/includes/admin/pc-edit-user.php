<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
die;
}

function pc_edit_user($user_id){

  //Include Uplod Form Functions
	include (ABSPATH . 'wp-content/plugins/photo-contest/includes/pc-upload-functions.php');

  //About User
  $dateofbirth = get_user_meta($user_id, 'pcplugin-dateofbirth', true);
  $adress = get_user_meta($user_id, 'pcplugin-adress', true);
  $city = get_user_meta($user_id, 'pcplugin-city', true);
  $zip_code = get_user_meta($user_id, 'pcplugin-zip_code', true);
  $state = get_user_meta($user_id, 'pcplugin-state', true);
  $country = get_user_meta($user_id, 'pcplugin-country', true);
  $gender = get_user_meta($user_id, 'pcplugin-gender', true);
  $gender_3 = get_user_meta($user_id, 'pcplugin-gender_3', true);
  $www = get_user_meta($user_id, 'pcplugin-www', true);
  $phone = get_user_meta($user_id, 'pcplugin-phone', true);
  $facebook = get_user_meta($user_id, 'pcplugin-facebook', true);
  $twitter = get_user_meta($user_id, 'pcplugin-twitter', true);
  $instagram = get_user_meta($user_id, 'pcplugin-instagram', true);
	$agree_GDPR = get_user_meta($user_id, 'agree-GDPR', true);


  $html = '<div class="row">';

  //Date of birth
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="dateofbirth">'.__('Date of birth','photo-contest').' <small>'.__('(Format: MM/DD/YYYY)','photo-contest').'</small></label>';
  $html .= '<div class="input-group p-has-icon"><input type="text" id="dateofbirth" name="dateofbirth" value="'.$dateofbirth.'" class="form-control contest-start"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-birthday-cake"></i></span></div></div></div>';
  //www
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="www">' . __('Blog/Gallery/Website', 'photo-contest') . '</label>';
  $html .= '<div class="input-group p-has-icon"><input type="text" id="www" name="www" value="'.$www.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-link"></i></span></div></div></div>';
  //Address
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="address">'.__('Address','photo-contest').'</label>';
  $html .= '<div class="input-group p-has-icon"><input type="text" id="address" name="address" value="'.$adress.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-home"></i></span></div></div></div>';
  //City
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="city">'.__('City','photo-contest').'</label>';
  $html .= '<div class="input-group p-has-icon"><input type="text" id="city" name="city" value="'.$city.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-building-o"></i></span></div></div></div>';
  //State
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="state">' . __('State', 'photo-contest') . '</label>';
  $html .= '<label class="input-group p-custom-arrow p-has-icon">';
  $html .= pcplugin_states($state);
  $html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>';
  $html .= '</div>';
  $html .= '</div>';
  //Country
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="country">' . __('Country', 'photo-contest') . '</label>';
  $html .= '<label class="input-group p-custom-arrow p-has-icon">';
  $html .= pcplugin_countries($country);
  $html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>';
  $html .= '</div>';
  $html .= '</div>';
  //Zip_code
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="zip">'.__('Zip','photo-contest').'</label>';
  $html .= '<div class="input-group p-has-icon"><input type="text" id="zip" name="zip" value="'.$zip_code.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-bookmark-o"></i></span></div></div></div>';
  //Phone
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="phone">'.__('Phone','photo-contest').'</label>';
  $html .= '<div class="input-group p-has-icon"><input type="text" id="phone" name="phone" value="'.$phone.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-bookmark-o"></i></span></div></div></div>';
  //Gender
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group">';
  $html .= '<div class="upload-label"><label for="gender">' . __('Gender', 'photo-contest') . ' ' . __('(two options)', 'photo-contest') . '</label></div>';
  $html .= '<div class="p-form-cg pt-form-bordered pt-form-inline">';
  $html .= '<div class="radio">';
  $html .= '<label>';
  $html .= '<input '.($gender == "male" ? "checked" : "").' type="radio" name="gender" value="male">';
  $html .= '<span class="p-check-icon"><span class="p-check-middle"><i class="fa fa-male"></i></span></span> <span class="p-label">Male</span></label>';
  $html .= '</div>';
  $html .= ' <div class="radio">';
  $html .= '<label>';
  $html .= '<input '.($gender == "female" ? "checked" : "").' type="radio" name="gender" value="female">';
  $html .= '<span class="p-check-icon"><span class="p-check-middle"><i class="fa fa-female"></i></span></span> <span class="p-label">Female</span></label>';
  $html .= '</div>';
  $html .= '</div>';
  $html .= '</div>';
  $html .= '</div>';
  //Gender
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group">';
  $html .= '<div class="upload-label"><label for="gender_3">' . __('Gender', 'photo-contest') . ' ' . __('(three options)', 'photo-contest') . '</label></div>';
  $html .= '<div class="p-form-cg pt-form-bordered pt-form-inline">';
  $html .= '<div class="radio">';
  $html .= '<label>';
  $html .= '<input '.($gender_3 == "male" ? "checked" : "").' type="radio" name="gender_3" value="male">';
  $html .= '<span class="p-check-icon"><span class="p-check-middle"><i class="fa fa-male"></i></span></span> <span class="p-label">Male</span></label>';
  $html .= '</div>';
  $html .= ' <div class="radio">';
  $html .= '<label>';
  $html .= '<input '.($gender_3 == "female" ? "checked" : "").' type="radio" name="gender_3" value="female">';
  $html .= '<span class="p-check-icon"><span class="p-check-middle"><i class="fa fa-female"></i></span></span> <span class="p-label">Female</span></label>';
  $html .= '</div>';
  $html .= '<div class="radio">';
  $html .= '<label>';
  $html .= '<input '.($gender_3 == "other" ? "checked" : "").' type="radio" name="gender_3" value="other">';
  $html .= '<span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">other</span></label>';
  $html .= '</div>';
  $html .= '</div>';
  $html .= '</div>';
  $html .= '</div>';
  //Facebook
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="facebook">'.__('Facebook','photo-contest').'</label>';
  $html .= '<div class="input-group p-has-icon"><input type="text" id="facebook" name="facebook" value="'.$facebook.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-facebook"></i></span></div></div></div>';
  //Twitter
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="twitter">'.__('Twitter','photo-contest').'</label>';
  $html .= '<div class="input-group p-has-icon"><input type="text" id="twitter" name="twitter" value="'.$twitter.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-twitter"></i></span></div></div></div>';
  //Instagram
  $html .= '<div class="col-sm-6">';
  $html .= '<div class="form-group"><label for="instagram">'.__('Instagram','photo-contest').'</label>';
  $html .= '<div class="input-group p-has-icon"><input type="text" id="instagram" name="instagram" value="'.$instagram.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-instagram"></i></span></div></div></div>';

  $html .= '</div>'; //row

	//GDPR condition
	$allow_GDPR = get_option('pcplugin-allow-GDPR');
	if ($allow_GDPR==1){
		if(!empty($agree_GDPR)){
		  $date_format = get_option('date_format', true);
			$time_format = get_option('time_format', true);
			$html .= '<div class="form-group p-field-disabled"><div class="checkbox"><label class="p-field-disabled"><input type="checkbox" id="terms" name="terms" disabled="disabled" checked> <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">'.__('User agreed with GDPR on date:','photo-contest').' <strong>'.date( $date_format.'', $agree_GDPR ).'</strong> '.__('at the time:','photo-contest').' <strong>'.date( $time_format, $agree_GDPR ).'</strong>.</span></label></div></div>';
		}else{
			$html .= '<div class="form-group p-field-disabled"><div class="checkbox"><label class="p-field-disabled"><input type="checkbox" id="terms" name="terms" disabled="disabled"> <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">'.__('User did not agreed with GDPR conditions yet!','photo-contest').'</span></label></div></div>';
		}
	}
  return $html;


  }
  function pc_save_edit_user($user_id){


		if (!isset($_POST['gender'])) {
			$gender = '';
		}else{
			$gender = $_POST['gender'];
		}
		if (!isset($_POST['gender_3'])) {
			$gender_3 = '';
		}else{
			$gender_3 = $_POST['gender_3'];
		}


    update_user_meta($user_id, 'pcplugin-dateofbirth', $_POST['dateofbirth']);
    update_user_meta($user_id, 'pcplugin-adress', $_POST['address']);
    update_user_meta($user_id, 'pcplugin-city', $_POST['city']);
    update_user_meta($user_id, 'pcplugin-zip_code', $_POST['zip']);
    update_user_meta($user_id, 'pcplugin-state', $_POST['state']);
    update_user_meta($user_id, 'pcplugin-country', $_POST['country']);
    update_user_meta($user_id, 'pcplugin-gender', $gender);
    update_user_meta($user_id, 'pcplugin-gender_3', $gender_3);
    update_user_meta($user_id, 'pcplugin-www', $_POST['www']);
    update_user_meta($user_id, 'pcplugin-phone', $_POST['phone']);
    update_user_meta($user_id, 'pcplugin-facebook', $_POST['facebook']);
    update_user_meta($user_id, 'pcplugin-twitter', $_POST['twitter']);
    update_user_meta($user_id, 'pcplugin-instagram', $_POST['instagram']);

    }

    function pc_edit_user_contest($contest,$user_id){
      global $wpdb;

      $custom_field_personal_name = $contest->custom_field_personal_name;
      $custom_field_personal_name_required = $contest->custom_field_personal_name_required;
      if (empty($custom_field_personal_name)){
        $custom_field_personal_name = __('Custom optional form field','photo-contest');
      }
      if (empty($custom_field_personal_name_required)){
        $custom_field_personal_name_required = __('Custom required form field','photo-contest');
      }

      $custom_field_personal_meta = get_user_meta($user_id, 'pcplugin-custom_field_personal_'.$contest->id, true);
      $custom_field_personal_meta_required = get_user_meta($user_id, 'pcplugin-custom_field_personal_required_'.$contest->id, true);
      $contest_user_images = get_user_meta($user_id, 'contest_user_images_' . $contest->id, true);

      if (empty($contest_user_images)){
        $contest_user_images = 0;
      }




      $html = '<div class="row">';

      //Custom field optional
      $html .= '<div class="col-sm-6">';
      $html .= '<div class="form-group"><label for="custom_field_optional">'.$custom_field_personal_name.'</label>';
      $html .= '<div class="input-group p-has-icon"><input type="text" id="custom_field_optional" name="custom_field_optional" value="'.$custom_field_personal_meta.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil"></i></span></div></div></div>';

      //Custom field required
      $html .= '<div class="col-sm-6">';
      $html .= '<div class="form-group"><label for="custom_field_optional_required">'.$custom_field_personal_name_required.'</label>';
      $html .= '<div class="input-group p-has-icon"><input type="text" id="custom_field_optional_required" name="custom_field_optional_required" value="'.$custom_field_personal_meta_required.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil"></i></span></div></div></div>';

      //Total images in the contest
      $html .= '<div class="col-sm-6">';
      $html .= '<div class="form-group"><label for="contest_user_images">'.__('Total submitted photos in the contest','photo-contest').'</label>';
      $html .= '<div class="input-group p-has-icon"><input type="text" id="contest_user_images" name="contest_user_images" value="'.$contest_user_images.'" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil"></i></span></div></div></div>';


      $html .= '</div>'; //row

      return $html;

    }

    function pc_save_edit_user_contest_meta($user_id){

      update_user_meta($user_id, 'pcplugin-custom_field_personal_'.$_GET['contest_id'], $_POST['custom_field_optional']);
      update_user_meta($user_id, 'pcplugin-custom_field_personal_required_'.$_GET['contest_id'], $_POST['custom_field_optional_required']);
      update_user_meta($user_id, 'contest_user_images_' . $_GET['contest_id'], $_POST['contest_user_images']);

    }


?>
