<div class="wrap">
    <div class="sfwd sfwd_options">

        <div id="myCred_override_hook_field" class="sfwd_input sfwd_input_type_checkbox-switch ">
            <span class="sfwd_option_label">
                <a class="sfwd_help_text_link">
                    <label for="myCred_override_hook" class="sfwd_label"><?php _e('Enable Custom Points', "mycred-learndash"); ?></label>
                </a>
            </span>
            <span class="sfwd_option_input">
                <div class="sfwd_option_div">
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php _e('Enable Custom Points', "mycred-learndash"); ?></span>
                        </legend> 
                        <label for="myCred_override_hook">
                            <div class="ld-switch-wrapper">
                                <span class="ld-switch">
                                    <input type="checkbox" autocomplete="off" id="myCred_override_hook" name="myCred_override_hook" class="learndash-section-field learndash-section-field-checkbox-switch ld-switch__input" <?php checked($override_checked, 'on'); ?> value="on" data-settings-sub-trigger="myCred_override_hook_sub">
                                    <span class="ld-switch__track"></span>
                                    <span class="ld-switch__thumb"></span>
                                    <span class="ld-switch__on-off"></span>
                                </span>
                                <span class="label-text"><?php _e("Dont enable if you don't want to override general settings", "mycred-learndash") ?></span>
                            </div>
                        </label>
                    </fieldset>
                </div>
            </span>
            <p class="ld-clear"></p>                                        
        </div>

        <div class="ld-settings-sub ld-settings-sub-level-1 myCred_override_hook_sub ld-settings-sub-state-<?php echo $override_checked == 'on' ? 'open' : 'closed' ;?>" data-parent-field="myCred_override_hook_field">
                           
            <div id="myCred_point_field" class="sfwd_input sfwd_input_type_text">
                <span class="sfwd_option_label">
                    <a class="sfwd_help_text_link">
                        <label for="myCred_point" class="sfwd_label"><?php _e("Override myCred general Points", "mycred-learndash"); ?></label>
                    </a>
                </span>
                <span class="sfwd_option_input">
                    <div class="sfwd_option_div">
                        <input autocomplete="off" id="myCred_point" type="text" name="myCred_point" class="learndash-section-field learndash-section-field-text -medium" value="<?php echo $point ?>">                       
                    </div>
                </span>
                <p class="ld-clear"></p>
            </div>

             <?php if (get_post_type() == 'sfwd-quiz'): 
                $quiz_pts = get_post_meta($post->ID, 'myCred_quiz_point_fail', true); ?>
                <div id="myCred_quiz_point_fail_field" class="sfwd_input sfwd_input_type_text">
                    <span class="sfwd_option_label">
                        <a class="sfwd_help_text_link">
                            <label for="myCred_quiz_point_fail" class="sfwd_label"><?php _e("Override myCred quiz on fail Points", "mycred-learndash"); ?></label>
                        </a>
                    </span>
                    <span class="sfwd_option_input">
                        <div class="sfwd_option_div">
                            <input autocomplete="off" id="myCred_quiz_point_fail" type="text" name="myCred_quiz_point_fail" class="learndash-section-field learndash-section-field-text -medium" value="<?php echo $quiz_pts ?>">                       
                        </div>
                    </span>
                    <p class="ld-clear"></p>
                </div>
            <?php endif; ?>

            <div id="learndash-course-display-content-settings_certificate_field" class="sfwd_input sfwd_input_type_select ">
                <span class="sfwd_option_label">
                    <a class="sfwd_help_text_link">
                        <label for="myCred_point_type" class="sfwd_label"><?php _e("Select Point Type", "mycred-learndash"); ?></label>
                    </a>
                </span>
                <span class="sfwd_option_input">
                    <div class="sfwd_option_div">
                        <span class="ld-select ld-select2">
                            <select autocomplete="off" type="select" name="myCred_point_type" id="myCred_point_type" data-ld-select2="1" tabindex="-1" aria-hidden="true">
                                <option value=""><?php _e("Select Point Type", "mycred-learndash"); ?></option>
                                <?php foreach (mycred_get_types() as $key => $pt_type) { ?>
                                    <option value="<?php echo $key; ?>" <?php echo $point_type == $key ? "selected" : ""; ?>>
                                        <?php echo $pt_type; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </span>                          
                    </div>
                </span>
                <p class="ld-clear"></p>                                        
            </div>

        </div>

        <?php if (get_post_type() == 'sfwd-quiz'): 
                $percentage = get_post_meta($post->ID, 'min_percentage', true); ?>
            <div id="min_percentage_field" class="sfwd_input sfwd_input_type_text">
                <span class="sfwd_option_label">
                    <a class="sfwd_help_text_link">
                        <label for="min_percentage_input" class="sfwd_label"><?php _e("Minimum percentage", "mycred-learndash"); ?></label>
                    </a>
                </span>
                <span class="sfwd_option_input">
                    <div class="sfwd_option_div">
                        <input autocomplete="off" id="min_percentage_input" type="text" name="min_percentage" class="learndash-section-field learndash-section-field-text -medium" value="<?php echo $percentage ?>"> %                         
                    </div>
                </span>
                <p class="ld-clear"></p>
            </div>
        <?php endif; ?>

    </div>
</div>