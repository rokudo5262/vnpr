<?php
//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}
function pc_insert_contest ($current_page_id){

	if (isset($_POST['plugin_setting'])) {
	global $wpdb;
	$wpdb->insert($wpdb->prefix . "photo_contest_list", array(
		'page_id' => $current_page_id,
		'contest_name' => stripslashes($_POST['contest-name']),
		'contest_start' => sanitize_text_field($_POST['contest-start']),
		'contest_end' => sanitize_text_field($_POST['contest-end']),
		'contest_vote_start' => sanitize_text_field($_POST['contest-start-vote']),
		'contest_register_end' => sanitize_text_field($_POST['contest-reg-ends']),
		'image_per_user' => "3",
		'contest_rows' => "3",
		'contest_columns' => "3",
		'vote_frequency' => "1",
		'contest_condition' => $_POST['contest-condition'],
		'menu_color' => "grey",
		'menu_style' => "thin"

	));

	 wp_redirect(get_permalink());
	}
}

function pc_insert_contest_admin (){

  global $wpdb;

	$pageid = $_POST['contest-to-page'];
	//Check page if contest on that page already exists
	if ($_POST['contest-to-page'] == 9999999){
	 // Gather post data.
		$my_post = array(
		    'post_type'     => 'page',
			'post_title'    => $_POST['contest-name'],
			'post_content'  => '<!-- wp:photo-contest/block -->[contest-menu][contest-page]<!-- /wp:photo-contest/block -->',
			'post_status'   => 'publish',
			'post_author'   => 1
		);

        // Insert the post into the database.
       $pageid = wp_insert_post( $my_post );
	}

	$page_check= $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE page_id = ".$pageid);
  if (empty ($page_check)){
		if (!isset($_POST['copy_setting']) or isset($_POST['copy_setting']) and $_POST['copy_setting']=='9999999'){
			$wpdb->insert($wpdb->prefix . "photo_contest_list", array(
				'page_id' => $pageid,
				'contest_name' => stripslashes($_POST['contest-name']),
				'contest_start' => sanitize_text_field($_POST['contest-start']),
				'contest_end' => sanitize_text_field($_POST['contest-end']),
				'contest_vote_start' => sanitize_text_field($_POST['contest-start-vote']),
				'contest_register_end' => sanitize_text_field($_POST['contest-reg-ends']),
				'image_per_user' => "3",
				'contest_rows' => "3",
				'contest_columns' => "3",
				'vote_frequency' => "1",
				'contest_condition' => $_POST['contest-condition'],
				'menu_color' => "grey",
				'menu_style' => "thin"

			));
		}

		//Duplicate contest
		if (isset($_POST['copy_setting']) and $_POST['copy_setting']!='9999999'){
			$contest = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$_POST['copy_setting']);

			$wpdb->insert($wpdb->prefix . "photo_contest_list", array(
				'page_id' => $pageid,
				'page_id_secondary' => '',
				'contest_name' => $_POST['contest-name'],
				'contest_start' => sanitize_text_field($_POST['contest-start']),
				'contest_end' => sanitize_text_field($_POST['contest-end']),
				'contest_vote_start' => sanitize_text_field($_POST['contest-start-vote']),
				'contest_register_end' => sanitize_text_field($_POST['contest-reg-ends']),
				'contest_rows' =>$contest->contest_rows,
				'contest_columns' =>$contest->contest_columns,
				'image_per_user' =>$contest->image_per_user,
				'vote_frequency' =>$contest->vote_frequency,
				'contest_condition' =>$contest->contest_condition,
				'menu_color' =>$contest->menu_color,
				'menu_style' =>$contest->menu_style,
				'hide_up' =>$contest->hide_up,
				'hide_top' =>$contest->hide_top,
				'hide_your' =>$contest->hide_your,
				'hide_rules' =>$contest->hide_rules,
				'hide_author' =>$contest->hide_author,
				'hide_votes' =>$contest->hide_votes,
				'hide_views' =>$contest->hide_views,
				'hide_login' =>$contest->hide_login,
				'hide_social' =>$contest->hide_social,
				'ip_protection' =>$contest->ip_protection,
				'date_of_birth' =>$contest->date_of_birth,
				'city' =>$contest->city,
				'adress' =>$contest->adress,
				'zip_code' =>$contest->zip_code,
				'state' =>$contest->state,
				'country' =>$contest->country,
				'gender' =>$contest->gender,
				'gender_3' =>$contest->gender_3,
				'www' =>$contest->www,
				'phone' =>$contest->phone,
				'fb_page' =>$contest->fb_page,
				'twitter_page' =>$contest->twitter_page,
				'instagram_page' =>$contest->instagram_page,
				'camera_model' =>$contest->camera_model,
				'description' =>$contest->description,
				'custom_field_personal' =>$contest->custom_field_personal,
				'custom_field_personal_name' =>$contest->custom_field_personal_name,
				'custom_field_personal_required' =>$contest->custom_field_personal_required,
				'custom_field_personal_name_required' =>$contest->custom_field_personal_name_required,
				'custom_field_image' =>$contest->custom_field_image,
				'custom_field_image_name' =>$contest->custom_field_image_name,
				'agree_terms' =>$contest->agree_terms,
				'agree_age_13' =>$contest->agree_age_13,
				'agree_age_18' =>$contest->agree_age_18,
				'gallery_layout' =>$contest->gallery_layout,
				'gallery_layout_color' =>$contest->gallery_layout_color,
				'jury' =>$contest->jury,
				'jury_votes' =>$contest->jury_votes,
				'jury_members' =>$contest->jury_members,
				'allow_user_edit' =>$contest->allow_user_edit,
				'contest_mode' =>$contest->contest_mode,
				'force_registration' =>$contest->force_registration,

			));
		}//duplicate contest end



		 return $pageid;
	 }else{
		 return 0;
	 }


}

function pc_create_contest(){

$allow_lightbox  = get_option('pcplugin-allow-lightbox');
global $current_user;
        if (!empty($current_user->roles)) {
            foreach ($current_user->roles as $key => $value) {
                if ($value == 'administrator' and !empty($allow_lightbox)) {

                    //Install form
                    //Date Picker

$html = '<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    function loadCSS(filename){
       var file = document.createElement("link")
       file.setAttribute("rel", "stylesheet")
       file.setAttribute("type", "text/css")
       file.setAttribute("href", filename)
       if (typeof file !== "undefined")
          document.getElementsByTagName("head")[0].appendChild(file)
    }
   //just call a function to load a new CSS:
   loadCSS("http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css")
</script>
<script>
      $(function() {
     $( "#datepicker" ).datepicker({ dateFormat: "mm/dd/yy" });
	 $( "#datepicker2" ).datepicker({ dateFormat: "mm/dd/yy" });
	 $( "#datepicker3" ).datepicker({ dateFormat: "mm/dd/yy" });
	 $( "#datepicker4" ).datepicker({ dateFormat: "mm/dd/yy" });
    });
    </script>';



          $html .= '<div class="photo-contest" style="height:800px;">';
					$html .= '<div class="contest-upload-form-box">';
					$html .= '<div class="modern-p-form p-form-modern-slateGray form-white-back">';
					$html .= '<div data-base-class="p-form" class="p-form p-bordered">';

					$html .= '<div class="p-title" data-base-class="p-title"><span data-p-role="title" class="p-title-line">' . __('Create a Contest', 'photo-contest') . ' <i class="fa fa-list"></i></span></div>';
                    if (!empty($error)) {
                        foreach ($error as $item) {
                            $html .= '<div class="contest-small-font contest-red-color">' . $item . '</div>';
                        }
                    }

                    $html .= '<form action="" method="post">';
                    $html .= '<fieldset>';
          //Contest Name
					$html .= '<div class="form-group">';
					$html .= '<label for="contest-name">' . __('Contest Name:', 'photo-contest') . '</label>';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<input required="required" type="text" id="contest-name" name="contest-name" value="" placeholder="' . __('Contest Name:', 'photo-contest') . '" class="form-control">';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>';
					$html .= '</div>';

          //Contest Start
					$html .= '<div class="form-group">';
					$html .= '<label for="contest-start">' . __('Contest Start:', 'photo-contest') . '</label>';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<input autocomplete="off" required="required" type="text" id="datepicker" name="contest-start" value="" placeholder="' . __('MM/DD/YYYY', 'photo-contest') . '" class="form-control">';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span></div>';
					$html .= '</div>';

          //Contest End
					$html .= '<div class="form-group">';
					$html .= '<label for="contest-end">' . __('Contest End:', 'photo-contest') . '</label>';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<input autocomplete="off" required="required" type="text" id="datepicker2" name="contest-end" value="" placeholder="' . __('MM/DD/YYYY', 'photo-contest') . '" class="form-control">';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span></div>';
					$html .= '</div>';

          //Vote begins
					$html .= '<div class="form-group">';
					$html .= '<label for="contest-start-vote">' . __('Vote begins:', 'photo-contest') . ' - ' . __('From this day can users vote. The date must be between "Contest Start" and "Contest End".', 'photo-contest') . '</label>';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<input autocomplete="off" required="required" type="text" id="datepicker3" name="contest-start-vote" value="" placeholder="' . __('MM/DD/YYYY', 'photo-contest') . '" class="form-control">';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-hourglass-start" aria-hidden="true"></i></span></div>';
					$html .= '</div>';

          //End of registration
					$html .= '<div class="form-group">';
					$html .= '<label for="contest-reg-ends">' . __('End of registration to the contest:', 'photo-contest') . ' - ' . __('After this day users can not upload photos to the contest.', 'photo-contest') . '</label>';
					$html .= '<div class="input-group p-has-icon">';
					$html .= '<input autocomplete="off" required="required" type="text" id="datepicker4" name="contest-reg-ends" value="" placeholder="' . __('MM/DD/YYYY', 'photo-contest') . '" class="form-control">';
					$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-hourglass-end" aria-hidden="true"></i></span></div>';
					$html .= '</div>';


          $html .= '<input type="hidden" name="contest-condition" value="'.htmlentities(default_rules()).'" />';
          $html .= '<input type="hidden" name="plugin_setting" id="plugin_setting" value="ok" />';
          $html .= '<div class="preview-btn text-center p-buttons"><button class="pc-btn" type="submit" name="submit">' . __('Create a Contest', 'photo-contest') . '</button></div>';
          $html .= '</fieldset>';
          $html .= '</form>';
          $html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';
                    return $html;

                } else {
                    $html = '<form id="p-form-skin" method="post" action="#" class="modern-p-form p-form-modern-slateGray form-white-back">
  <div data-base-class="p-form" class="p-form p-bordered">
    <div class="p-title" data-base-class="p-title"><span data-p-role="title" class="p-title-line">' . __('Notice', 'photo-contest') . '&nbsp;&nbsp;<i class="fa fa-list"></i></span></div>
    <div class="alert alert-error"><strong><i class="fa fa-times"></i> ' . __('Notice', 'photo-contest') . ':</strong> '.sprintf(__( 'Contest is not set up correctly. Please do visit <a href="%s">General Settings</a> and set and save settings first. Thank You!', 'photo-contest'),  home_url('/') . 'wp-admin/admin.php?page=photo-contest').'</div>

  </div>
</form>';
                    return $html;
					}
            }
        } //end of if is admin
		}

function pc_create_contest_admin($sql){
	$allow_lightbox  = get_option('pcplugin-allow-lightbox');
	if (!empty($allow_lightbox)) {
	$html = '<form action="" method="post">';
	$html .= '<fieldset>';
	//Contest Name
	$html .= '<div class="form-group form-show">';
	$html .= '<label for="contest-name">' . __('Contest Name:', 'photo-contest') . '</label>';
	$html .= '<div class="input-group p-has-icon">';
	$html .= '<input required="required" type="text" id="contest-name" name="contest-name" value="" placeholder="' . __('Contest Name:', 'photo-contest') . '" class="form-control">';
	$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>';
	$html .= '</div>';

	//Select contest

	$html .= '<div class="form-group form-hide">';
	$html .= '<label for="contest-to-page">'.__('Contest page','photo-contest').' - '.__('Select a page where where will be the contest','photo-contest').'</label>';

	$args = array('post_type' => 'page','post_status' => 'publish' );
	$pages = get_pages( $args );

	$html .= '<label class="input-group p-custom-arrow" >';
	$html .= '<div class="input-group p-has-icon">';
	$html .= '<select name="contest-to-page" id="contest-to-page" class="form-control" required="required">';

	$html .= '<optgroup label="' . __('NEW PAGE', 'photo-contest') . '">';
	$html .= '<option value="9999999">' . __('Create a new page', 'photo-contest') . '</option>';
	$html .= '</optgroup>';

	$html .= '<optgroup label="' . __('EXISTING PAGES', 'photo-contest') . '">';
	foreach( $pages as $item ){
		$html .= '<option value="'.$item->ID.'">'.$item->post_title.'</option>';
	}
	$html .= '</optgroup>';

	$html .= '</select>';
	$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span><span class="input-group-icon"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>';
	$html .= '</div>';
	$html .= '</label>';
	$html .= '</div>';

	//Contest Start
	$html .= '<div class="form-group form-hide">';
	$html .= '<label for="contest-start">' . __('Contest Start:', 'photo-contest') . '</label>';
	$html .= '<div class="input-group p-has-icon">';
	$html .= '<input autocomplete="off" required="required" type="text" id="datepicker" name="contest-start" value="" placeholder="' . __('MM/DD/YYYY', 'photo-contest') . '" class="form-control">';
	$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span></div>';
	$html .= '</div>';

	//Contest End
	$html .= '<div class="form-group form-hide">';
	$html .= '<label for="contest-end">' . __('Contest End:', 'photo-contest') . '</label>';
	$html .= '<div class="input-group p-has-icon">';
	$html .= '<input autocomplete="off" required="required" type="text" id="datepicker2" name="contest-end" value="" placeholder="' . __('MM/DD/YYYY', 'photo-contest') . '" class="form-control">';
	$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span></div>';
	$html .= '</div>';

	//Vote begins
	$html .= '<div class="form-group form-hide">';
	$html .= '<label for="contest-start-vote">' . __('Vote begins:', 'photo-contest') . ' - ' . __('From this day can users vote. The date must be between "Contest Start" and "Contest End".', 'photo-contest') . '</label>';
	$html .= '<div class="input-group p-has-icon">';
	$html .= '<input autocomplete="off" required="required" type="text" id="datepicker3" name="contest-start-vote" value="" placeholder="' . __('MM/DD/YYYY', 'photo-contest') . '" class="form-control">';
	$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-hourglass-start" aria-hidden="true"></i></span></div>';
	$html .= '</div>';

	//End of registration
	$html .= '<div class="form-group form-hide">';
	$html .= '<label for="contest-reg-ends">' . __('End of registration to the contest:', 'photo-contest') . ' - ' . __('After this day users can not upload photos to the contest.', 'photo-contest') . '</label>';
	$html .= '<div class="input-group p-has-icon">';
	$html .= '<input autocomplete="off" required="required" type="text" id="datepicker4" name="contest-reg-ends" value="" placeholder="' . __('MM/DD/YYYY', 'photo-contest') . '" class="form-control">';
	$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span> </span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-hourglass-end" aria-hidden="true"></i></span></div>';
	$html .= '</div>';

	//Copy contest Settings
	if(!empty($sql)){
	$html .= '<div class="form-group form-hide">';
	$html .= '<label for="contest-to-page">'.__('Basic Settings or Duplicate Settings','photo-contest').' - '.__('Set basic settings or copy settings from a previous contest','photo-contest').'</label>';
	$html .= '<label class="input-group p-custom-arrow" >';
	$html .= '<div class="input-group p-has-icon">';
	$html .= '<select name="copy_setting" id="copy_setting" class="form-control" required="required">';

	$html .= '<optgroup label="' . __('Set basic settings', 'photo-contest') . '">';
	$html .= '<option value="9999999">' . __('Basic settings', 'photo-contest') . '</option>';
	$html .= '</optgroup>';

	$html .= '<optgroup label="' . __('Copy/Duplicate settings from a previous contest', 'photo-contest') . '">';
	foreach( $sql as $item ){
	$html .= '<option value="'.$item->id.'">'.$item->contest_name.'</option>';
	}
	$html .= '</optgroup>';

	$html .= '</select>';
	$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span><span class="input-group-icon"><i class="fa fa-cogs" aria-hidden="true"></i></span>';
	$html .= '</div>';
	$html .= '</label>';
	$html .= '</div>';
	}

	$html .= '<input type="hidden" name="contest-condition" value="'.htmlentities(default_rules()).'" />';

	$html .= '<input type="hidden" name="create_contest" id="create_contest" value="ok" />';

	$html .= '<div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit" name="submit">' . __('Create a Contest', 'photo-contest') . '</button></div>';

	$html .= '</fieldset>';
	$html .= '</form>';
	return $html;
	 }else {
                    $html = '<form id="p-form-skin" method="post" action="#" class="modern-p-form p-form-modern-slateGray form-white-back">
    <div class="alert alert-error"><strong><i class="fa fa-times"></i> ' . __('Notice', 'photo-contest') . ':</strong> '.sprintf(__( 'Contest is not set up correctly. Please do visit <a href="%s">General Settings</a> and set and save settings first. Thank You!', 'photo-contest'),  home_url('/') . 'wp-admin/admin.php?page=photo-contest').'</div>


</form>';
                    return $html;

	}


}
