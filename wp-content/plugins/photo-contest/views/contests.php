<?php

//Secure file from direct access
if (!defined('WPINC')) {
    die;
}
//Admin functions
include_once(plugin_dir_path(__DIR__) . "includes/pc-gallery-functions.php");
include_once(plugin_dir_path(__DIR__) . "includes/pc-create-contest.php");


//Get all contests
global $wpdb;
$sql = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "photo_contest_list ORDER BY id ASC");

//Variables
$blogurl = home_url();

//Create the contest
if (isset($_POST['create_contest']) and current_user_can('manage_options')) {
    include_once(plugin_dir_path(__DIR__) . "includes/admin/pc-contests-functions.php");
    $insert = pc_insert_contest_admin();
    if (!empty ($insert)) {
        wp_redirect(admin_url() . 'admin.php?page=photo-contest-contests&success=' . $insert . '');
    } else {
        wp_redirect(admin_url() . 'admin.php?page=photo-contest-contests&fail=yes');
    }
}
//Delete the contest
if (isset($_GET['delete']) and current_user_can('manage_options')) {
    include_once(plugin_dir_path(__DIR__) . "includes/admin/pc-contests-functions.php");
    pc_delete_the_contest($_GET['delete']);
    wp_redirect(admin_url() . 'admin.php?page=photo-contest-contests');
}
//Save the contest
if (isset($_POST['plugin_setting']) and isset($_GET["edit"]) and current_user_can('manage_options')) {
    include_once(plugin_dir_path(__DIR__) . "includes/admin/pc-contests-functions.php");
    pc_save_contest();
    wp_redirect(admin_url() . 'admin.php?page=photo-contest-contests&edit=' . $_GET["edit"]);
}

?>
<div class="wrap">

    <?php if (!isset ($_GET["edit"])) { ?>

        <form method="post" class="modern-p-form p-form-modern-steelBlue">

            <div data-base-class="p-form" class="p-form p-bordered" style="max-width:1200px">
                <div class="p-title">
                    <span class="p-title-line"><?php echo esc_html(get_admin_page_title()); ?>&nbsp;&nbsp;<i class="fa fa-fw fa-list"></i></span>
                </div>
                <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Create a new Contest', 'photo-contest'); ?></span></div>

                <?php if (isset ($_GET["fail"])) { ?>
                    <div class="alert alert-error"><strong><i class="fa fa-fw fa-times"></i> <?php _e('Error:', 'photo-contest'); ?></strong> <?php _e('This contest cannot be created because on selected page contest already exists', 'photo-contest'); ?> </div>
                <?php } ?>

                <?php if (isset ($_GET["success"])) {
                    $page_url = '/wp-admin/post.php?post=' . $_GET["success"] . '&action=edit';
                    if (isset($_POST['contest-to-page']) and $_POST['contest-to-page'] == 9999999) {
                        ?>
                        <div class="alert alert-valid"><strong><i class="fa fa-fw fa-times"></i> <?php _e('Success:', 'photo-contest'); ?></strong> <?php echo __('The contest is created! Please add these contest shortcodes: <strong>[contest-menu][contest-page]</strong> to the page:', 'photo-contest'); ?> "<strong><a href="<?php echo $page_url; ?>"><?php echo get_the_title($_GET["success"]); ?></a></strong>"</div>
                    <?php } else {
                        ?>
                        <div class="alert alert-valid"><strong><i class="fa fa-fw fa-times"></i> <?php _e('Success:', 'photo-contest'); ?></strong> <?php echo __('The contest is created! Now you can visit the contest:', 'photo-contest'); ?> "<strong><a href="<?php echo get_permalink($_GET["success"]); ?>"><?php echo get_the_title($_GET["success"]); ?></a></strong>"</div>


                    <?php }
                } ?>
                <?php echo pc_create_contest_admin($sql); ?>

                <?php if (!empty($sql)) { ?>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Contests', 'photo-contest'); ?></span></div>

                    <table class="pc-responisve">
                        <thead>
                        <tr>
                            <th scope="col"><?php _e('Active', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('ID', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('Page ID', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('Name', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('Contest Start', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('Contest End', 'photo-contest'); ?></th>
                            <th scope="col"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i> <?php _e('Edit', 'photo-contest'); ?></th>
                            <th scope="col"><i class="fa fa-fw fa-home" aria-hidden="true"></i> <?php _e('Visit', 'photo-contest'); ?></th>
                            <th scope="col"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> <?php _e('Delete', 'photo-contest'); ?></th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th scope="col"><?php _e('Active', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('ID', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('Page ID', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('Name', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('Contest Start', 'photo-contest'); ?></th>
                            <th scope="col"><?php _e('Contest End', 'photo-contest'); ?></th>
                            <th scope="col"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i> <?php _e('Edit', 'photo-contest'); ?></th>
                            <th scope="col"><i class="fa fa-fw fa-home" aria-hidden="true"></i> <?php _e('Visit', 'photo-contest'); ?></th>
                            <th scope="col"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> <?php _e('Delete', 'photo-contest'); ?></th>
                        </tr>
                        </tfoot>
                        <tbody id="the-list">
                        <?php
                        foreach ($sql as $item) {
                            $start = $item->contest_start;
                            $end = $item->contest_end;
                            $date = StrFTime('%m/%d/%Y', current_time('timestamp', 0));

                            $today_time = strtotime($date);
                            $begin_time = strtotime($start);
                            $expire_time = strtotime($end);
                            $date_format = get_option('date_format', true);

                            ?>
                            <tr>
                                <?php
                                if ($begin_time <= $today_time and $expire_time >= $today_time) {
                                    ?>
                                    <td scope="row" data-label="<?php _e('Active', 'photo-contest'); ?>"><img src="<?php echo plugins_url('assets/admin/ok.png', dirname(__FILE__)); ?>" width="24" style="width:24px; height:24px;"/></td>
                                <?php } else {
                                    ?>
                                    <td scope="row" data-label="<?php _e('Active', 'photo-contest'); ?>"><img src="<?php echo plugins_url('assets/admin/ko.png', dirname(__FILE__)); ?>" width="24" style="width:24px; height:24px;"/></td>
                                <?php } ?>
                                <td data-label="<?php _e('ID', 'photo-contest'); ?>"><?php echo $item->id; ?></td>
                                <td data-label="<?php _e('Page ID', 'photo-contest'); ?>"><?php echo $item->page_id; ?></td>
                                <td data-label="<?php _e('Name', 'photo-contest'); ?>"><a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-contests&edit=<?php echo $item->id; ?>"><?php echo stripslashes($item->contest_name); ?></a></td>
                                <td data-label="<?php _e('Contest Start', 'photo-contest'); ?>"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i> <?php echo date_i18n($date_format, strtotime($item->contest_start)); ?></td>
                                <td data-label="<?php _e('Contest End', 'photo-contest'); ?>"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i> <?php echo date_i18n($date_format, strtotime($item->contest_end)); ?></td>
                                <td data-label="<?php _e('Edit', 'photo-contest'); ?>"><a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-contests&edit=<?php echo $item->id; ?>"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i> <?php _e('Edit', 'photo-contest'); ?></a></td>
                                <td data-label="<?php _e('Visit', 'photo-contest'); ?>"><a href="<?php echo get_permalink($item->page_id); ?>"><i class="fa fa-fw fa-home" aria-hidden="true"></i> <?php _e('Visit', 'photo-contest'); ?></a></td>
                                <td data-label="<?php _e('Delete', 'photo-contest'); ?>">
                                    <a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-contests&delete=<?php echo $item->id; ?>" class="photo_delete" data-item="<?php echo $item->id; ?>" onclick="if (!confirm('<?php _e('Do you want delete this contest? Are you sure?', 'photo-contest'); ?>')) return false;"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> <?php _e('Delete', 'photo-contest'); ?></a></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>

                <?php } ?>


            </div>
        </form>

        <?php
    }
    //Edit Contest
    if (isset ($_GET["edit"])) {
        $sql2 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "photo_contest_list WHERE id = " . $_GET["edit"]);
        foreach ($sql2 as $item) {

            //Get option values
            $page_id = $item->page_id;
            $page_id_secondary = $item->page_id_secondary;
            $page_id_third = $item->page_id_third;
            $contest_name = stripslashes($item->contest_name);
            $contest_start = $item->contest_start;
            $contest_end = $item->contest_end;
            $contest_reg_ends = $item->contest_register_end;
            $contest_start_vote = $item->contest_vote_start;
            $photo_number = $item->image_per_user;
            $lines_number = $item->contest_rows;
            $columns_number = $item->contest_columns;
            $oneday_vote = $item->vote_frequency;
            $menu_color = $item->menu_color;
            $menu_style = $item->menu_style;
            $condition = $item->contest_condition;
            $editor_id = 'contest_condition';
            $hide_ubutton = $item->hide_up;
            $hide_topbutton = $item->hide_top;
            $hide_profilebutton = $item->hide_your;
            $hide_rules = $item->hide_rules;
            $ip_protection = $item->ip_protection;
            $hide_author = $item->hide_author;
            $hide_votes = $item->hide_votes;
            $hide_views = $item->hide_views;
            $dateofbirth = $item->date_of_birth;
            $city = $item->city;
            $address = $item->adress;
            $zip_code = $item->zip_code;
            $state = $item->state;
            $country = $item->country;
            $gender = $item->gender;
            $gender_3 = $item->gender_3;
            $www = $item->www;
            $phone = $item->phone;
            $fb_page = $item->fb_page;
            $twitter_page = $item->twitter_page;
            $instagram_page = $item->instagram_page;
            $camera_model = $item->camera_model;
            $description = $item->description;
            $custom_field_personal = stripslashes($item->custom_field_personal);
            $custom_field_personal_name = stripslashes($item->custom_field_personal_name);
            $custom_field_personal_required = stripslashes($item->custom_field_personal_required);
            $custom_field_personal_name_required = stripslashes($item->custom_field_personal_name_required);
            $custom_field_image = stripslashes($item->custom_field_image);
            $custom_field_image_name = stripslashes($item->custom_field_image_name);
            $agree_terms = $item->agree_terms;
            $agree_age_13 = $item->agree_age_13;
            $agree_age_18 = $item->agree_age_18;
            $gallery_layout = $item->gallery_layout;
            $gallery_layout_color = $item->gallery_layout_color;
            $gallery_order = $item->gallery_order;
            $allow_user_edit = $item->allow_user_edit;
            $contest_mode = $item->contest_mode;
            $hide_login = $item->hide_login;
            $hide_social = $item->hide_social;
            $jury = $item->jury;
            $force_registration = $item->force_registration;
            $hide_select_bar = $item->hide_select_bar;

            if(empty($page_id_third)){
                $page_id_third = "";
            }

            if ($contest_mode != 1) {
                $disabled = " p-field-disabled";
                $disabled2 = "";
                $infotext = __('(This field is not active in this mode!)', 'photo-contest');
                $infotext2 = "";
            } else {
                $disabled = "";
                $disabled2 = "";
                $infotext = "";
                $infotext2 = "";
            }
            if ($contest_mode == 3) {
                $disabled2 = " p-field-disabled";
                $infotext2 = __('(This field is not active in this mode!)', 'photo-contest');
            }
            if ($jury == 2 and $contest_mode == 1) {
                $disabled3 = " p-field-disabled";
                $infotext3 = __('(Jury mode for this contest is active! Standard vote options for ordinary users or visitors are disabled )', 'photo-contest');
            } else {
                $disabled3 = "";
                $infotext3 = "";
            }
            ?>

            <form method="post" class="modern-p-form p-form-modern-steelBlue" id="contest-form">

                <div data-base-class="p-form" class="p-form p-bordered" style="max-width:1200px">

                    <div class="p-title">
                        <span class="p-title-line"><?php _e('Edit Contest', 'photo-contest'); ?>&nbsp;-&nbsp;<a href="<?php echo get_permalink($page_id); ?>" style="color:#FFFFFF"><?php echo $contest_name; ?></a>&nbsp;&nbsp;<i class="fa fa-fw fa-camera-retro"></i></span>
                    </div>
                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Contest mode', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="contest-mode"><?php _e('Contest mode', 'photo-contest'); ?></label>
                        <p><?php _e('The contest can be set to three modes. The first mode is a just classic contest with all parts, the second mode is set as upload form with the menu in this mode is also enabled Rules and Prizes section and in the third mode is allowed only upload form. In the second and third mode is not possible to share images, it is not possible to vote, it is not possible tho show gallery, but you can switch between all three modes anytime you want.', 'photo-contest'); ?></p>
                        <div class="p-form-cg pt-form-panel">

                            <div class="radio">
                                <label>
                                    <input <?php if ($contest_mode == 1 or empty($contest_mode)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="contest-mode" value="1" onchange="document.forms['contest-form'].submit();">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Gallery mode', 'photo-contest'); ?> - <?php _e('Classic contest with all sections, the menu and with the voting', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($contest_mode == 2) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="contest-mode" value="2" onchange="document.forms['contest-form'].submit();">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Upload form mode', 'photo-contest'); ?> - <strong><?php _e('With Menu', 'photo-contest'); ?></strong> - <?php _e('In this mode only Upload Form, Menu and Rules & Prizes section will be visible', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($contest_mode == 3) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="contest-mode" value="3" onchange="document.forms['contest-form'].submit();">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Upload form mode', 'photo-contest'); ?> - <strong><?php _e('Without Menu', 'photo-contest'); ?></strong> - <?php _e('In this mode only Upload Form will be visible', 'photo-contest'); ?></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Basic Settings', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="contest-name"><?php _e('Name of the contest', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon"><input type="text" id="contest-name" name="contest-name" placeholder="<?php _e('Name of the contest', 'photo-contest'); ?>" required="required" value="<?php echo $contest_name; ?>" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-fw fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-pencil"></i></span></div>
                    </div>


                    <div class="form-group form-group-width">
                        <label for="contest-start"><?php _e('Start date', 'photo-contest'); ?> <small><?php _e('(Format: MM/DD/YYYY)', 'photo-contest'); ?></small></label>
                        <div class="input-group p-has-icon"><input type="text" id="contest-start" name="contest-start" placeholder="<?php _e('Select date', 'photo-contest'); ?>" required="required" value="<?php echo $contest_start; ?>" class="form-control contest-start"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-fw fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-clock-o"></i></span></div>
                    </div>


                    <div class="form-group form-group-width">
                        <label for="contest-end"><?php _e('End date', 'photo-contest'); ?> <small><?php _e('(Format: MM/DD/YYYY)', 'photo-contest'); ?></small></label>
                        <div class="input-group p-has-icon"><input type="text" id="contest-end" name="contest-end" placeholder="<?php _e('Select date', 'photo-contest'); ?>" required="required" value="<?php echo $contest_end; ?>" class="form-control contest-end"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-fw fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-clock-o"></i></span></div>
                    </div>


                    <div class="form-group form-group-width<?php echo $disabled; ?>">
                        <label for="contest-reg-ends"><?php _e('Registration will end on:', 'photo-contest'); ?> <small><?php _e('(Format: MM/DD/YYYY)', 'photo-contest'); ?> <span class="pc-red"><?php echo $infotext; ?></span></small></label>
                        <div class="input-group p-has-icon"><input type="text" id="contest-reg-ends" name="contest-reg-ends" placeholder="<?php _e('Select date', 'photo-contest'); ?>" required="required" value="<?php echo $contest_reg_ends; ?>" class="form-control contest-start-vote"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-fw fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-clock-o"></i></span></div>
                    </div>


                    <div class="form-group form-group-width<?php echo $disabled; ?>">
                        <label for="contest-start-vote"><?php _e('Voting will begin on:', 'photo-contest'); ?> <small><?php _e('(Format: MM/DD/YYYY)', 'photo-contest'); ?> <span class="pc-red"><?php echo $infotext; ?></span></small></label>
                        <div class="input-group p-has-icon"><input type="text" id="contest-start-vote" name="contest-start-vote" placeholder="<?php _e('Select date', 'photo-contest'); ?>" required="required" value="<?php echo $contest_start_vote; ?>" class="form-control contest-start-vote"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-fw fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-clock-o"></i></span></div>
                    </div>


                    <div class="form-group form-group-width">
                        <label for="contest-to-page"><?php _e('Contest page', 'photo-contest'); ?> - <?php _e('Primary Page', 'photo-contest'); ?> <small><?php _e('(Required)', 'photo-contest'); ?></small></label>
                        <?php $args = ['post_type' => 'page', 'post_status' => 'publish'];
                        $pages = get_pages($args);
                        ?>
                        <label class="input-group p-custom-arrow">
                            <select name="contest-to-page" id="contest-to-page" class="form-control">
                                <?php if (empty ($page_id)) { ?>
                                    <option><?php _e('Important: Select Page!', 'photo-contest'); ?></option><?php } ?>
                                <?php foreach ($pages as $item) { ?>
                                    <option <?php if ($item->ID == $page_id) {
                                        echo 'selected="selected"';
                                    } ?> value="<?php echo $item->ID; ?>"><?php echo $item->post_title; ?></option>
                                <?php } ?>
                            </select>
                            <span class="input-group-state">
                                    <span class="p-position">
                                        <span class="p-text">
                                            <span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span>
                                            <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span>
                                        </span>
                                    </span>
                                </span>
                            <span class="p-field-cb"></span>
                            <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span>
                        </label>
                    </div>


                    <div class="form-group form-group-width">
                        <label for="contest-to-page-secondary"><?php _e('Contest page', 'photo-contest'); ?> - <?php _e('Secondary page', 'photo-contest'); ?> <small><?php _e('(Optional)', 'photo-contest'); ?></small></label>
                        <label class="input-group p-custom-arrow">
                            <select name="contest-to-page-secondary" id="contest-to-page-secondary" class="form-control">
                                <?php if (empty ($page_id_secondary) or $page_id_secondary == 0) { ?>
                                    <option value="0"><?php _e('Select secondary page (optional)', 'photo-contest'); ?></option><?php } ?>
                                <?php foreach ($pages as $item) { ?>
                                    <option <?php if ($item->ID == $page_id_secondary) {
                                        echo 'selected="selected"';
                                    } ?> value="<?php echo $item->ID; ?>"><?php echo $item->post_title; ?></option>
                                    <?php
                                }
                                ?>
                                <option value="0"><?php _e('==No page needed==', 'photo-contest'); ?></option>
                            </select>
                            <span class="input-group-state">
						    <span class="p-position">
						    	<span class="p-text">
						      	<span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span>
						      	<span class="p-error-text"><i class="fa fa-fw fa-times"></i></span>
						    	</span>
						    </span>
							</span>
                            <span class="p-field-cb"></span>
                            <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span>
                        </label>
                    </div>


                    <div class="form-group form-group-width">
                        <label for="contest-to-page-third"><?php _e('Contest page', 'photo-contest'); ?> - <?php _e('Third page', 'photo-contest'); ?> <small><?php _e('(Optional)', 'photo-contest'); ?> (<?php _e('Use ID of the page', 'photo-contest'); ?>)</small></label>
                        <div class="input-group p-has-icon">
                                <input type="text" name="contest-to-page-third" id="contest-to-page-third" value="<?php echo $page_id_third; ?>" class="form-control">
                                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-fw fa-star"></i></span></span></span></span>
                                <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-file-o"></i></span>
                            </div>
                    </div>


                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Users Settings', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="cphoto_number"><?php _e('Photos per User', 'photo-contest'); ?></label>
                        <label class="input-group p-custom-arrow">
                            <select name="photo_number" id="photo_number" class="form-control">
                                <option <?php if ($photo_number == 1) {
                                    echo 'selected="selected"';
                                } ?> value="1">1
                                </option>
                                <option <?php if ($photo_number == 2) {
                                    echo 'selected="selected"';
                                } ?> value="2">2
                                </option>
                                <option <?php if ($photo_number == 3) {
                                    echo 'selected="selected"';
                                } ?> value="3">3
                                </option>
                                <option <?php if ($photo_number == 4) {
                                    echo 'selected="selected"';
                                } ?> value="4">4
                                </option>
                                <option <?php if ($photo_number == 5) {
                                    echo 'selected="selected"';
                                } ?> value="5">5
                                </option>
                                <option <?php if ($photo_number == 6) {
                                    echo 'selected="selected"';
                                } ?> value="6">6
                                </option>
                                <option <?php if ($photo_number == 7) {
                                    echo 'selected="selected"';
                                } ?> value="7">7
                                </option>
                                <option <?php if ($photo_number == 8) {
                                    echo 'selected="selected"';
                                } ?> value="8">8
                                </option>
                                <option <?php if ($photo_number == 9) {
                                    echo 'selected="selected"';
                                } ?> value="9">9
                                </option>
                                <option <?php if ($photo_number == 10) {
                                    echo 'selected="selected"';
                                } ?> value="10">10
                                </option>
                                <option <?php if ($photo_number == 20) {
                                    echo 'selected="selected"';
                                } ?> value="20">20
                                </option>
                                <option <?php if ($photo_number == 30) {
                                    echo 'selected="selected"';
                                } ?> value="30">30
                                </option>
                                <option <?php if ($photo_number == 1000000) {
                                    echo 'selected="selected"';
                                } ?> value="1000000"><?php _e('Unlimited', 'photo-contest'); ?></option>
                            </select>
                            <span class="input-group-state">
                                    <span class="p-position">
                                        <span class="p-text">
                                            <span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span>
                                            <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span>
                                        </span>
                                    </span>
                                </span>
                            <span class="p-field-cb"></span>
                            <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span>
                        </label>
                    </div>

                    <div class="form-group form-group-width<?php echo $disabled; ?>">
                        <label for="allow-user-edit"><?php _e('Allow users to edit their own image', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?></span></small></label>
                        <div class="p-form-cg pt-form-panel">

                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_user_edit == 1 or empty($allow_user_edit)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="allow-user-edit" value="1">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('No', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_user_edit == 2) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="allow-user-edit" value="2">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Allow to Edit the image', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_user_edit == 3) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="allow-user-edit" value="3">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Allow to Edit and Delete the image', 'photo-contest'); ?></span>
                                </label>
                            </div>

                        </div>
                    </div>


                    <div class="form-group form-group-width">
                        <label for="allow-user-edit"><?php _e('Reguire registration before image upload', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">

                            <div class="radio">
                                <label>
                                    <input <?php if ($force_registration == 1 or empty($force_registration)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="force-registration" value="1">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('No', 'photo-contest'); ?><small> <?php _e('(Default)', 'photo-contest'); ?></small></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($force_registration == 2) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="force-registration" value="2">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Yes', 'photo-contest'); ?></span>
                                </label>
                            </div>

                        </div>
                    </div>


                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Layout', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width<?php echo $disabled2; ?>">
                        <label for="menu-style"><?php _e('Select Menu Style', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext2; ?></span></small></label>
                        <div class="p-form-cg pt-form-panel">

                            <div class="radio">
                                <label>
                                    <input <?php if ($menu_style == 'normal') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-style" value="normal">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Menu Height - Normal', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($menu_style == 'thin') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-style" value="thin">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Menu Height - Thin', 'photo-contest'); ?></span>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group form-group-width<?php echo $disabled2; ?>">
                        <label for="menu-color"><?php _e('Menu Color', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext2; ?></span></small></label>
                        <div class="p-form-colorpick pt-form-panel">

                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'ff0000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="ff0000"><span class="p-color-block" style="background: #ff0000"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'd70000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="d70000"><span class="p-color-block" style="background: #d70000"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'maroon') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="maroon"><span class="p-color-block" style="background: #940303"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'deepskyblue') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="deepskyblue"><span class="p-color-block" style="background: #3dc0f1"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'light-blue') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="light-blue"><span class="p-color-block" style="background: #1e5799"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'blue') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="blue"><span class="p-color-block" style="background: #153e6a"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'light-green') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="light-green"><span class="p-color-block" style="background: #92e428"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'green') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="green"><span class="p-color-block" style="background: #6fba0f"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'dark-green') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="dark-green"><span class="p-color-block" style="background: #4f8c00"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'light-yellow') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="light-yellow"><span class="p-color-block" style="background: #eeda30"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'yellow') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="yellow"><span class="p-color-block" style="background: #dcc81f"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'dark-yellow') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="dark-yellow"><span class="p-color-block" style="background: #c4b003"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'orange') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="orange"><span class="p-color-block" style="background: #fd8603"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'dark-orange') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="dark-orange"><span class="p-color-block" style="background: #c64900"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'brown') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="brown"><span class="p-color-block" style="background: #854502"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'light-purple') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="light-purple"><span class="p-color-block" style="background: #df2dd5"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'purple') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="purple"><span class="p-color-block" style="background: #c914be"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'dark-purple') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="dark-purple"><span class="p-color-block" style="background: #9b0492"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'light-pink') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="light-pink"><span class="p-color-block" style="background: #d70081"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'pink') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="pink"><span class="p-color-block" style="background: #ba0371"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'dark-pink') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="dark-pink"><span class="p-color-block" style="background: #9a015d"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'turquoise') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="turquoise"><span class="p-color-block" style="background: #18c8c6"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'turquoise1') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="turquoise1"><span class="p-color-block" style="background: #0ea4a2"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'turquoise2') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="turquoise2"><span class="p-color-block" style="background: #058482"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'silver') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="silver"><span class="p-color-block" style="background: #969696"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'grey') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="grey"><span class="p-color-block" style="background: #707070"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($menu_color == 'black') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-color" value="black"><span class="p-color-block" style="background: #000000"></span></label></div>


                        </div>
                    </div>

                    <div class="form-group form-group-width<?php echo $disabled; ?>">
                        <label for="contest-name"><?php _e('Gallery Grid Layout', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?></span></small></label>
                        <div class="p-form-cg pt-form-panel">

                            <div class="radio">
                                <label>
                                    <input <?php if ($gallery_layout == '1' or empty($gallery_layout)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout" value="1">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Classic', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($gallery_layout == '2') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout" value="2">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Modern', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($gallery_layout == '3') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout" value="3">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Modern', 'photo-contest'); ?> (<?php _e('With Lightbox', 'photo-contest'); ?>)</span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($gallery_layout == '4') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout" value="4">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Modern', 'photo-contest'); ?> (<?php _e('With Lightbox and vote button', 'photo-contest'); ?>)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label for="colorpick"><?php _e('Gallery layout color', 'photo-contest'); ?></label>
                        <div class="p-form-colorpick pt-form-panel">
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#ff0000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#ff0000"><span class="p-color-block" style="background: #ff0000"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#d70000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#d70000"><span class="p-color-block" style="background: #d70000"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#940303') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#940303"><span class="p-color-block" style="background: #940303"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#3dc0f1') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#3dc0f1"><span class="p-color-block" style="background: #3dc0f1"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#1e5799') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#1e5799"><span class="p-color-block" style="background: #1e5799"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#153e6a') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#153e6a"><span class="p-color-block" style="background: #153e6a"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#92e428') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#92e428"><span class="p-color-block" style="background: #92e428"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#6fba0f') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#6fba0f"><span class="p-color-block" style="background: #6fba0f"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#4f8c00') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#4f8c00"><span class="p-color-block" style="background: #4f8c00"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#eeda30') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#eeda30"><span class="p-color-block" style="background: #eeda30"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#dcc81f') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#dcc81f"><span class="p-color-block" style="background: #dcc81f"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#c4b003') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#c4b003"><span class="p-color-block" style="background: #c4b003"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#fd8603') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#fd8603"><span class="p-color-block" style="background: #fd8603"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#c64900') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#c64900"><span class="p-color-block" style="background: #c64900"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#854502') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#854502"><span class="p-color-block" style="background: #854502"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#df2dd5') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#df2dd5"><span class="p-color-block" style="background: #df2dd5"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#c914be') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#c914be"><span class="p-color-block" style="background: #c914be"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#9b0492') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#9b0492"><span class="p-color-block" style="background: #9b0492"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#d70081') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#d70081"><span class="p-color-block" style="background: #d70081"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#ba0371') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#ba0371"><span class="p-color-block" style="background: #ba0371"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#9a015d') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#9a015d"><span class="p-color-block" style="background: #9a015d"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#18c8c6') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#18c8c6"><span class="p-color-block" style="background: #18c8c6"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#0ea4a2') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#0ea4a2"><span class="p-color-block" style="background: #0ea4a2"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#058482') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#058482"><span class="p-color-block" style="background: #058482"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#969696') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#969696"><span class="p-color-block" style="background: #969696"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#707070') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#707070"><span class="p-color-block" style="background: #707070"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($gallery_layout_color == '#000000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-layout-color" value="#000000"><span class="p-color-block" style="background: #000000"></span></label></div>


                        </div>
                    </div>

                    <div class="form-group form-group-width<?php echo $disabled; ?>">
                        <label for="lines_number"><?php _e('Rows in the Gallery', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?></span></small></label>
                        <label class="input-group p-custom-arrow">
                            <select name="lines_number" id="lines_number" class="form-control">
                                <option <?php if ($lines_number == 1) {
                                    echo 'selected="selected"';
                                } ?> value="1">1
                                </option>
                                <option <?php if ($lines_number == 2) {
                                    echo 'selected="selected"';
                                } ?> value="2">2
                                </option>
                                <option <?php if ($lines_number == 3) {
                                    echo 'selected="selected"';
                                } ?> value="3">3
                                </option>
                                <option <?php if ($lines_number == 4) {
                                    echo 'selected="selected"';
                                } ?> value="4">4
                                </option>
                                <option <?php if ($lines_number == 5) {
                                    echo 'selected="selected"';
                                } ?> value="5">5
                                </option>
                                <option <?php if ($lines_number == 6) {
                                    echo 'selected="selected"';
                                } ?> value="6">6
                                </option>
                                <option <?php if ($lines_number == 7) {
                                    echo 'selected="selected"';
                                } ?> value="7">7
                                </option>
                                <option <?php if ($lines_number == 8) {
                                    echo 'selected="selected"';
                                } ?> value="8">8
                                </option>
                                <option <?php if ($lines_number == 9) {
                                    echo 'selected="selected"';
                                } ?> value="9">9
                                </option>
                                <option <?php if ($lines_number == 10) {
                                    echo 'selected="selected"';
                                } ?> value="10">10
                                </option>
                                <option <?php if ($lines_number == 20) {
                                    echo 'selected="selected"';
                                } ?> value="20">20
                                </option>
                            </select>
                            <span class="input-group-state">
                                    <span class="p-position">
                                        <span class="p-text">
                                            <span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span>
                                            <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span>
                                        </span>
                                    </span>
                                </span>
                            <span class="p-field-cb"></span>
                            <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span>
                        </label>
                    </div>


                    <div class="form-group form-group-width<?php echo $disabled; ?>">
                        <label for="columns_number"><?php _e('Columns in the Gallery', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?></span></small></label>
                        <label class="input-group p-custom-arrow">
                            <select name="columns_number" id="columns_number" class="form-control">
                                <option <?php if ($columns_number == 1) {
                                    echo 'selected="selected"';
                                } ?> value="1">1
                                </option>
                                <option <?php if ($columns_number == 2) {
                                    echo 'selected="selected"';
                                } ?> value="2">2
                                </option>
                                <option <?php if ($columns_number == 3) {
                                    echo 'selected="selected"';
                                } ?> value="3">3 <?php _e('- Recommended', 'photo-contest'); ?> </option>
                                <option <?php if ($columns_number == 4) {
                                    echo 'selected="selected"';
                                } ?> value="4">4 <?php _e('- Only for wide pages', 'photo-contest'); ?></option>
                                <option <?php if ($columns_number == 5) {
                                    echo 'selected="selected"';
                                } ?> value="5">5 <?php _e('- Only for very wide pages', 'photo-contest'); ?></option>
                            </select>
                            <span class="input-group-state">
                                    <span class="p-position">
                                        <span class="p-text">
                                            <span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span>
                                            <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span>
                                        </span>
                                    </span>
                                </span>
                            <span class="p-field-cb"></span>
                            <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span>
                        </label>
                    </div>

                    <div class="form-group form-group-width<?php echo $disabled; ?>">
                        <label for="gallery-order"><?php _e('Primary gallery order', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?></span></small></label>
                        <div class="p-form-cg pt-form-panel">

                            <div class="radio">
                                <label>
                                    <input <?php if ($gallery_order == '1' or empty($gallery_order)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-order" value="1">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Latest', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($gallery_order == '2') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="gallery-order" value="2">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Random', 'photo-contest'); ?></span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Voting', 'photo-contest'); ?></span></div>


                    <div class="form-group form-group-width<?php echo $disabled; ?><?php echo $disabled3; ?>">
                        <label for="oneday-vote"><?php _e('How often should users vote!', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?><?php echo $infotext3; ?></span></small></label>
                        <div class="p-form-cg pt-form-panel">

                            <div class="radio">
                                <label>
                                    <input <?php if ($oneday_vote == 5) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="oneday-vote" value="5">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Only one single vote', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($oneday_vote == 6) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="oneday-vote" value="6">
                                    <span class="p-check-icon">
										<span class="p-check-block"></span>
								 </span>
                                    <span class="p-label"><?php _e('A rate mode - 5 stars rating', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($oneday_vote == 7) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="oneday-vote" value="7">
                                    <span class="p-check-icon">
										<span class="p-check-block"></span>
								 </span>
                                    <span class="p-label"><?php _e('A rate mode - 10 stars rating', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($oneday_vote == 1) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="oneday-vote" value="1">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Once for each Photo (Like the "Like button" - Photo with most likes/votes wins)', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($oneday_vote == 2) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="oneday-vote" value="2">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Once a Day (Every new day) (for each Photo)', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($oneday_vote == 3) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="oneday-vote" value="3">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Twice a Day (Every 12 hours) (for each Photo)', 'photo-contest'); ?></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($oneday_vote == 4) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="oneday-vote" value="4">
                                    <span class="p-check-icon">
                    <span class="p-check-block"></span>
                 </span>
                                    <span class="p-label"><?php _e('Once an Hour (for each Photo)', 'photo-contest'); ?></span>
                                </label>
                            </div>

                        </div>
                    </div>


                    <div class="form-group form-group-width<?php echo $disabled; ?>">
                        <label for="ip-protection"><?php _e('IP Address Vote Protection', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?></span></small></label>
                        <div class="p-form-cg pt-form-panel">

                            <div class="radio">
                                <label>
                                    <input <?php if ($ip_protection == 1) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="ip-protection" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Yes', 'photo-contest'); ?> <small><?php _e('(Highly recommended!)', 'photo-contest'); ?></small>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($ip_protection == 2) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="ip-protection" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('No', 'photo-contest'); ?> <small><?php _e('(Choose this option only if you are in closed or private network (like company network) and all computers/devices have the same IP address!)', 'photo-contest'); ?></small>
                      </span> </label>
                            </div>


                        </div>
                    </div>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Manage the Content', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width<?php echo $disabled; ?>">
                        <div class="p-form-sg pt-form-panel">
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_up" value="ch" <?php if ($hide_ubutton == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Upload Section', 'photo-contest'); ?> <small><?php _e('(Section will be still visible for Admins)', 'photo-contest'); ?> <span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_top" value="ch" <?php if ($hide_topbutton == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Top 10 Section', 'photo-contest'); ?> <small><?php _e('(Section will be still visible for Admins)', 'photo-contest'); ?> <span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_your" value="ch" <?php if ($hide_profilebutton == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Your Image Section', 'photo-contest'); ?> <small><?php _e('(Section will be still visible for Admins)', 'photo-contest'); ?> <span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_rules" value="ch" <?php if ($hide_rules == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Rules & Prizes Section', 'photo-contest'); ?> <small><?php _e('(Section will be still visible for Admins)', 'photo-contest'); ?> <span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_author" value="ch" <?php if ($hide_author == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Author\'s Name', 'photo-contest'); ?> <small><?php _e('(Author\'s name will be still visible for Admins)', 'photo-contest'); ?> <span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_votes" value="ch" <?php if ($hide_votes == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Votes', 'photo-contest'); ?> <small><?php _e('(Votes, Top 10 and order by votes in Gallery will be hidden but still visible for Admins)', 'photo-contest'); ?> <span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_views" value="ch" <?php if ($hide_views == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Views', 'photo-contest'); ?> <small><?php _e('(Views will be still visible for Admins)', 'photo-contest'); ?> <span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_login" value="ch" <?php if ($hide_login == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Login Button', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_social" value="ch" <?php if ($hide_social == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Social Icons', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="hide_select_bar" value="ch" <?php if ($hide_select_bar == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Select Bars and Search Bar in the gallery', 'photo-contest'); ?> <small><span class="pc-red"><?php echo $infotext; ?></span></small></span></label>
                            </div>
                        </div>
                    </div>


                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Manage Upload Form', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="dateofbirth">
                            <?php _e('Custom registration form fields', 'photo-contest'); ?>
                            <small><?php _e('(This fields are connected to user so it is visible only during registration process. Already registered users can not see this fields)', 'photo-contest'); ?></small>
                        </label>
                        <div class="p-form-sg pt-form-panel">
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="dateofbirth" value="ch" <?php if ($dateofbirth == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Date of birth', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="address" value="ch" <?php if ($address == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Address', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="city" value="ch" <?php if ($city == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('City', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="zip_code" value="ch" <?php if ($zip_code == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Zip/Postal code', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="state" value="ch" <?php if ($state == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('State', 'photo-contest'); ?> <small>(<?php _e('Only US', 'photo-contest'); ?>)</small></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="country" value="ch" <?php if ($country == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Country', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="gender" value="ch" <?php if ($gender == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Gender (Male/Female)', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="gender_3" value="ch" <?php if ($gender_3 == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Gender (Male/Female/Other)', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="www" value="ch" <?php if ($www == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Website/Blog/Gallery URL', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="phone" value="ch" <?php if ($phone == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Phone number', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="fb_page" value="ch" <?php if ($fb_page == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Facebook', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="twitter_page" value="ch" <?php if ($twitter_page == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Twitter', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="instagram_page" value="ch" <?php if ($instagram_page == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Instagram', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label class="p-check-input">
                                    <input type="checkbox" name="custom_field_personal" value="ch" <?php if ($custom_field_personal == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Custom personal field', 'photo-contest'); ?><?php _e('(Optional)', 'photo-contest'); ?></span><span class="form-group">
                  <div class="input-group p-has-icon">
                    <input type="text" id="switch-other" name="custom_field_personal_name" value="<?php echo $custom_field_personal_name; ?>" placeholder="<?php _e('Name of the field', 'photo-contest'); ?>" class="form-control">
                    <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-pencil-square-o"></i></span></div>
                  </span>
                                </label>
                            </div>
                            <div class="p-switch">
                                <label class="p-check-input">
                                    <input type="checkbox" name="custom_field_personal_required" value="ch" <?php if ($custom_field_personal_required == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Custom personal field', 'photo-contest'); ?><?php _e('(Required)', 'photo-contest'); ?></span><span class="form-group">
                  <div class="input-group p-has-icon">
                    <input type="text" id="switch-other" name="custom_field_personal_name_required" value="<?php echo $custom_field_personal_name_required; ?>" placeholder="<?php _e('Name of the field', 'photo-contest'); ?>" class="form-control">
                    <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-pencil-square-o"></i></span></div>
                  </span>
                                </label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="agree_age_13" value="ch" <?php if ($agree_age_13 == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('I am over the age of 13 - checkbox', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="agree_age_18" value="ch" <?php if ($agree_age_18 == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('I am over the age of 18  - checkbox', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="agree_terms" value="ch" <?php if ($agree_terms == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('I have read and accept official contest rules - checkbox', 'photo-contest'); ?></span></label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group form-group-width">
                        <label for="hide-ubutton">
                            <?php _e('Custom image details form fields', 'photo-contest'); ?>
                            <small><?php _e('(This fields are connected to uploaded image)', 'photo-contest'); ?></small>
                        </label>
                        <div class="p-form-sg pt-form-panel">
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="description" value="ch" <?php if ($description == 2 or empty($description)) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Description', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label>
                                    <input type="checkbox" name="camera_model" value="ch" <?php if ($camera_model == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Camera model', 'photo-contest'); ?></span></label>
                            </div>
                            <div class="p-switch">
                                <label class="p-check-input">
                                    <input type="checkbox" name="custom_field_image" value="ch" <?php if ($custom_field_image == 2) {
                                        echo 'checked="checked"';
                                    } ?>>
                                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Custom image field', 'photo-contest'); ?></span><span class="form-group">
                  <div class="input-group p-has-icon">
                    <input type="text" id="switch-other" name="custom_field_image_name" value="<?php echo $custom_field_image_name; ?>" placeholder="<?php _e('Name of the field', 'photo-contest'); ?>" class="form-control">
                    <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-pencil-square-o"></i></span></div>
                  </span>
                                </label>
                            </div>

                        </div>

                    </div>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Rules & Prizes!', 'photo-contest'); ?></span></div>

                    <div class="form-group">

                        <?php wp_editor(stripslashes($condition), strtolower($editor_id)); ?>

                    </div>

                    <input type="hidden" name="plugin_setting" id="plugin_setting" value="ok"/>
                    <div class="text-right"><input type="submit" name="btnsubmit" id="btnsubmit" class="pc-btn" value="<?php _e('Save Changes', 'photo-contest'); ?>"></div>
                </div>
            </form>

        <?php }
    } ?>

</div>
