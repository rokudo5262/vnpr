<?php

//Secure file from direct access
if (!defined('WPINC')) {
    die;
}

if (isset($_POST['plugin_setting']) and current_user_can('manage_options')) {


    if (!empty($_POST['photo_limit'])) {
        if (is_numeric($_POST['photo_limit'])) {
            update_option('pcplugin-photo-limit', $_POST['photo_limit']);
        }
    }
    if (!empty($_POST['who-vote'])) {
        if (is_numeric($_POST['who-vote'])) {
            update_option('pcplugin-who-vote', $_POST['who-vote']);
        }
    }
    if (!empty($_POST['author-vote'])) {
        if (is_numeric($_POST['author-vote'])) {
            update_option('pcplugin-author-vote', $_POST['author-vote']);
        }
    }
    if (!empty($_POST['allow-lightbox'])) {
        if (is_numeric($_POST['allow-lightbox'])) {
            update_option('pcplugin-allow-lightbox', $_POST['allow-lightbox']);
        }
    }
    if (!empty($_POST['allow-activate'])) {
        if (is_numeric($_POST['allow-activate'])) {
            update_option('pcplugin-allow-activate', $_POST['allow-activate']);
        }
    }
    if (!empty($_POST['email-notification'])) {
        if (is_numeric($_POST['email-notification'])) {
            update_option('pcplugin-email-notification', $_POST['email-notification']);
        }
    }
    if (!empty($_POST['show-adminbar'])) {
        if (is_numeric($_POST['show-adminbar'])) {
            update_option('pcplugin-show-adminbar', $_POST['show-adminbar']);
        }
    }
    if (!empty($_POST['maxwidth'])) {
        if (is_numeric($_POST['maxwidth'])) {
            update_option('pcplugin-maxwidth', $_POST['maxwidth']);
        }
    }
    if (!empty($_POST['maxheight'])) {
        if (is_numeric($_POST['maxheight'])) {
            update_option('pcplugin-maxheight', $_POST['maxheight']);
        }
    }
    if (!empty($_POST['allow-comments'])) {
        if ($_POST['allow-comments'] == "3") {

            $args = [
                'post_type' => 'attachment',
                'posts_per_page' => -1,
                'post_status' => 'any',
                'post_parent' => null,
                'meta_key' => 'contest-active',
                'orderby' => 'post_date',
                'order' => 'DESC',
                'comment_status' => 'closed'
            ];
            $attachments = get_posts($args);

            if (!empty($attachments)) {
                foreach ($attachments as $post) {
                    // Update comment status
                    $my_post = [
                        'ID' => $post->ID,
                        'comment_status' => 'open'
                    ];
                    // Update the post into the database
                    wp_update_post($my_post);

                }

            }
        }
        if (is_numeric($_POST['allow-comments'])) {
            update_option('pcplugin-allow-comments', $_POST['allow-comments']);
        }
    }
    if (!empty($_POST['disqus-code'])) {
        $diskusmode = stripslashes($_POST['disqus-code']);
        update_option('pcplugin-disqus-code', $diskusmode);
    }
    if (!empty($_POST['allow-custom-welcome-mail'])) {
        if (is_numeric($_POST['allow-custom-welcome-mail'])) {
            update_option('pcplugin-allow-custom-welcome-mail', $_POST['allow-custom-welcome-mail']);
        }
    }
    if (!empty($_POST['email-headline'])) {
        update_option('pcplugin-email-headline', $_POST['email-headline']);
    }
    if (isset($_POST['email-body'])) {
        update_option('pcplugin-email-body', stripslashes($_POST['email-body']));
    }
    if (!empty($_POST['email-menu-font-color'])) {
        update_option('pcplugin-email-menu-font-color', $_POST['email-menu-font-color']);
    }
    if (!empty($_POST['email-menu-bg-color'])) {
        update_option('pcplugin-email-menu-bg-color', $_POST['email-menu-bg-color']);
    }
    if (!empty($_POST['send-login'])) {
        update_option('pcplugin-send-login', $_POST['send-login']);
    }
    if (!empty($_POST['vote-button-color'])) {
        update_option('pcplugin-vote-button-color', $_POST['vote-button-color']);
    }
    if (!empty($_POST['vote-icon'])) {
        update_option('pcplugin-vote-icon', $_POST['vote-icon']);
    }
    if (!empty($_POST['vote-text'])) {
        if (is_numeric($_POST['vote-text'])) {
            update_option('pcplugin-vote-text', $_POST['vote-text']);
        }
    }
    if (!empty($_POST['vote-own-text'])) {
        update_option('pcplugin-vote-own-text', $_POST['vote-own-text']);
    } else {
        update_option('pcplugin-vote-own-text', '');
    }
    if (!empty($_POST['vote-after-text'])) {
        if (is_numeric($_POST['vote-after-text'])) {
            update_option('pcplugin-vote-after-text', $_POST['vote-after-text']);
        }
    }
    if (!empty($_POST['vote-own-text-after'])) {
        update_option('pcplugin-vote-own-text-after', $_POST['vote-own-text-after']);
    } else {
        update_option('pcplugin-vote-own-text-after', '');
    }
    if (!empty($_POST['allow-animation'])) {
        if (is_numeric($_POST['allow-animation'])) {
            update_option('pcplugin-allow-animation', $_POST['allow-animation']);
        }
    }
    if (!empty($_POST['admin-email'])) {
        if (is_numeric($_POST['admin-email'])) {
            update_option('pcplugin-admin-email', $_POST['admin-email']);
        }
    }
    if (!empty($_POST['admin-email-input'])) {
        update_option('pcplugin-admin-email-input', $_POST['admin-email-input']);
    }
    if (!empty($_POST['font-size'])) {
        update_option('pcplugin-font-size', $_POST['font-size']);
    }
    if (!empty($_POST['font'])) {
        update_option('pcplugin-font', $_POST['font']);
    }

    //Menu items
    if (isset($_POST['menu-gallery'])) {
        update_option('pcplugin-menu-gallery', $_POST['menu-gallery']);
    }
    if (isset($_POST['menu-upload'])) {
        update_option('pcplugin-menu-upload', $_POST['menu-upload']);
    }
    if (isset($_POST['menu-rules'])) {
        update_option('pcplugin-menu-rules', $_POST['menu-rules']);
    }
    if (isset($_POST['menu-your-images'])) {
        update_option('pcplugin-menu-your-images', $_POST['menu-your-images']);
    }
    if (isset($_POST['menu-top10'])) {
        update_option('pcplugin-menu-top10', $_POST['menu-top10']);
    }


    //BuddyPress
    if (isset($_POST['allow_buddy_images'])) {
        update_option('pcplugin-allow_buddy_images', '2');
    } else {
        update_option('pcplugin-allow_buddy_images', '1');
    }
    if (isset($_POST['allow_buddy_comments'])) {
        update_option('pcplugin-allow_buddy_comments', '2');
    } else {
        update_option('pcplugin-allow_buddy_comments', '1');
    }
    if (isset($_POST['allow_buddy_votes'])) {
        update_option('pcplugin-allow_buddy_votes', '2');
    } else {
        update_option('pcplugin-allow_buddy_votes', '1');
    }

    //reCaptcha
    if (!empty($_POST['allow-reCaptcha'])) {
        if (is_numeric($_POST['allow-reCaptcha'])) {
            update_option('pcplugin-allow-reCaptcha', $_POST['allow-reCaptcha']);
        }
    }
    if (!empty($_POST['site-key'])) {
        update_option('pcplugin-site-key', $_POST['site-key']);
    }
    if (!empty($_POST['secret-key'])) {
        update_option('pcplugin-secret-key', $_POST['secret-key']);
    }
    if (!empty($_POST['confirm-votes'])) {
        if (is_numeric($_POST['confirm-votes'])) {
            update_option('pcplugin-confirm-votes', $_POST['confirm-votes']);
        }
    }

    //Version 2.8
    if (!empty($_POST['menu-open'])) {
        if (is_numeric($_POST['menu-open'])) {
            update_option('pcplugin-menu-open', $_POST['menu-open']);
        }
    }

    //Version 3.0
    if (!empty($_POST['admin-new-user-email'])) {
        if (is_numeric($_POST['admin-new-user-email'])) {
            update_option('pcplugin-admin-new-user-email', $_POST['admin-new-user-email']);
        }
    }

    //Version 3.1
    if (!empty($_POST['redirect-vote'])) {
        if (is_numeric($_POST['redirect-vote'])) {
            update_option('pcplugin-redirect-after-vote', $_POST['redirect-vote']);
        }
    }
    if (!empty($_POST['allow-login-button'])) {
        if (is_numeric($_POST['allow-login-button'])) {
            update_option('pcplugin-allow-login-button', $_POST['allow-login-button']);
        }
    }
    //Version 3.2
    if (!empty($_POST['email-notification-about-user'])) {
        if (is_numeric($_POST['email-notification-about-user'])) {
            update_option('pcplugin-email-notification-about-user', $_POST['email-notification-about-user']);
        }
    }
    if (!empty($_POST['email-sender'])) {
        update_option('pcplugin-email-sender', stripslashes($_POST['email-sender']));
    }
    if (!empty($_POST['image-approval-email'])) {
        if (is_numeric($_POST['image-approval-email'])) {
            update_option('pcplugin-image-approval-email', $_POST['image-approval-email']);
        }
    }
    if (!empty($_POST['image-approval-email-subject'])) {
        update_option('pcplugin-image-approval-email-subject', $_POST['image-approval-email-subject']);
    }
    if (!empty($_POST['image-approval-email-body'])) {
        update_option('pcplugin-image-approval-email-body', $_POST['image-approval-email-body']);
    }
    //Version 3.3
    if (!empty($_POST['menu-layout'])) {
        update_option('pcplugin-menu-layout', $_POST['menu-layout']);
    }
    //Version 3.4
    if (!empty($_POST['allow-GDPR'])) {
        update_option('pcplugin-allow-GDPR', $_POST['allow-GDPR']);
    }
    if (!empty($_POST['allow-GDPR-text'])) {
        update_option('pcplugin-allow-GDPR-text', $_POST['allow-GDPR-text']);
    }
    if (isset($_POST['allow-GDPR-notice'])) {
        update_option('pcplugin-allow-GDPR-notice', $_POST['allow-GDPR-notice']);
    }//
    //Version 4.1
    if (isset($_POST['header-code'])) {
        $headermode = stripslashes($_POST['header-code']);
        update_option('pcplugin-header-code', $headermode);
    }
    if (!empty($_POST['login-form'])) {
        if (is_numeric($_POST['login-form'])) {
            update_option('pcplugin-login-form', $_POST['login-form']);
        }
    }
    if (!empty($_POST['login-form-input'])) {
        update_option('pcplugin-login-form-input', htmlentities(stripslashes($_POST['login-form-input'])));
    }
    if (!empty($_POST['rate-after-text'])) {
        if (is_numeric($_POST['rate-after-text'])) {
            update_option('pcplugin-rate-after-text', $_POST['rate-after-text']);
        }
    }
    if (!empty($_POST['rate-own-text-after'])) {
        update_option('pcplugin-rate-own-text-after', $_POST['rate-own-text-after']);
    } else {
        update_option('pcplugin-rate-own-text-after', '');
    }

}

//Get option values
$photo_limit = get_option('pcplugin-photo-limit');
$allow_lightbox = get_option('pcplugin-allow-lightbox');
$allow_activate = get_option('pcplugin-allow-activate');
$email_notification = get_option('pcplugin-email-notification');
$show_adminbar = get_option('pcplugin-show-adminbar');
$allow_animation = get_option('pcplugin-allow-animation');
$maxwidth = get_option('pcplugin-maxwidth');
$maxheight = get_option('pcplugin-maxheight');
$who_vote = get_option('pcplugin-who-vote');
$author_vote = get_option('pcplugin-author-vote');
$allow_comments = get_option('pcplugin-allow-comments');
$disqus_code = get_option('pcplugin-disqus-code');
$allow_custom_welcome_mail = get_option('pcplugin-allow-custom-welcome-mail');
$email_headline = get_option('pcplugin-email-headline');
$email_body = get_option('pcplugin-email-body');
$email_menu_bg_color = get_option('pcplugin-email-menu-bg-color');
$send_login = get_option('pcplugin-send-login');
$vote_button_color = get_option('pcplugin-vote-button-color');
$vote_icon = get_option('pcplugin-vote-icon');
$vote_text = get_option('pcplugin-vote-text');
$vote_own_text = get_option('pcplugin-vote-own-text');
$vote_after_text = get_option('pcplugin-vote-after-text');
$vote_own_text_after = get_option('pcplugin-vote-own-text-after');
$admin_email = get_option('pcplugin-admin-email');
$admin_email_input = get_option('pcplugin-admin-email-input');
$font_size = get_option('pcplugin-font-size');
$font = get_option('pcplugin-font');
$confirm_votes = get_option('pcplugin-confirm-votes');

//menu items
$vote_menu_gallery = get_option('pcplugin-menu-gallery');
$vote_menu_upload = get_option('pcplugin-menu-upload');
$vote_menu_rules = get_option('pcplugin-menu-rules');
$vote_menu_your_images = get_option('pcplugin-menu-your-images');
$vote_menu_top10 = get_option('pcplugin-menu-top10');

//BuddyPress
$allow_buddy_images = get_option('pcplugin-allow_buddy_images');
$allow_buddy_comments = get_option('pcplugin-allow_buddy_comments');
$allow_buddy_votes = get_option('pcplugin-allow_buddy_votes');

//reCaptcha
$allow_reCaptcha = get_option('pcplugin-allow-reCaptcha');
$site_key = get_option('pcplugin-site-key');
$secret_key = get_option('pcplugin-secret-key');

//Version 2.8
$menu_open = get_option('pcplugin-menu-open');

//Version 3.0
$admin_new_user_email = get_option('pcplugin-admin-new-user-email');

//Version 3.1
$redirect_vote = get_option('pcplugin-redirect-after-vote');

//Version 3.2
$email_notification_about_user = get_option('pcplugin-email-notification-about-user');
$email_sender = stripslashes(get_option('pcplugin-email-sender'));
$image_approval_email = get_option('pcplugin-image-approval-email');
$image_approval_email_subject = get_option('pcplugin-image-approval-email-subject');
$image_approval_email_body = get_option('pcplugin-image-approval-email-body');

//Version 3.3
$menu_layout = get_option('pcplugin-menu-layout');
//Version 3.4
$allow_GDPR = get_option('pcplugin-allow-GDPR');
$allow_GDPR_text = get_option('pcplugin-allow-GDPR-text');
$allow_GDPR_notice = get_option('pcplugin-allow-GDPR-notice');
//Version 4.1
$header_code = get_option('pcplugin-header-code');
$login_form = get_option('pcplugin-login-form');
$login_form_input = get_option('pcplugin-login-form-input');
$rate_after_text = get_option('pcplugin-rate-after-text');
$rate_own_text_after = get_option('pcplugin-rate-own-text-after');

if (empty($allow_GDPR_text)) {
    $allow_GDPR_text = __('I agree to the processing of my personal data', 'photo-contest');
}
if (empty ($email_headline)) {
    $email_headline = __('Welcome to our Photo Contest!');
}
if (empty ($email_sender)) {
    $email_sender = __('Thank you for your registration!');
}
if (empty ($image_approval_email_subject)) {
    $image_approval_email_subject = __('Your image was approved!');
}
if (empty ($image_approval_email_body)) {
    $image_approval_email_body = __('Your image "{PHOTO-NAME}" in the contest <a href="{CONTEST-URL}">{CONTEST-NAME}</a> was approved!');
}

?>

<div class="wrap">
    <form method="post" class="modern-p-form p-form-modern-steelBlue" style="max-width:1200px">
        <div data-base-class="p-form" class="p-form p-bordered">

            <input type="radio" id="tab-1" name="activeTab" class="p-tab-sel" checked>
            <input type="radio" id="tab-2" name="activeTab" class="p-tab-sel">
            <input type="radio" id="tab-3" name="activeTab" class="p-tab-sel">
            <input type="radio" id="tab-4" name="activeTab" class="p-tab-sel">
            <input type="radio" id="tab-5" name="activeTab" class="p-tab-sel">

            <ul class="nav nav-tabs">
                <li>
                    <label for="tab-1"><i class="fa fa-cogs" aria-hidden="true"></i>
                        <?php _e('Basic Settings', 'photo-contest'); ?>
                    </label>
                </li>
                <li>
                    <label for="tab-2"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        <?php _e('Voting Settings', 'photo-contest'); ?>
                    </label>
                </li>
                <li>
                    <label for="tab-3"><i class="fa fa-envelope" aria-hidden="true"></i>
                        <?php _e('Emails and Notifications', 'photo-contest'); ?>
                    </label>
                </li>
                <li>
                    <label for="tab-4"><i class="fa fa-bars" aria-hidden="true"></i>
                        <?php _e('Menu', 'photo-contest'); ?>
                    </label>
                </li>
                <li>
                    <label for="tab-5"><i class="fa fa-handshake-o" aria-hidden="true"></i>
                        <?php _e('Integrations', 'photo-contest'); ?>
                    </label>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane">
                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side">
          <?php _e('Basic Settings', 'photo-contest'); ?>
          </span></div>

                    <div class="form-group form-group-width">
                        <label for="photo_limit"><?php _e('Image File Size Limit', 'photo-contest'); ?> <small>(<?php _e('Your server/hosting limit is', 'photo-contest'); ?> <?php echo ini_get('upload_max_filesize'); ?>)</small></label>
                        <label class="input-group p-custom-arrow">
                            <select name="photo_limit" id="photo_limit" class="form-control">
                                <option <?php if ($photo_limit == 209715) {
                                    echo 'selected="selected"';
                                } ?> value="209715">0,2 MB
                                </option>
                                <option <?php if ($photo_limit == 314573) {
                                    echo 'selected="selected"';
                                } ?> value="314573">0,3 MB
                                </option>
                                <option <?php if ($photo_limit == 524288) {
                                    echo 'selected="selected"';
                                } ?> value="524288">0,5 MB
                                </option>
                                <option <?php if ($photo_limit == 734003) {
                                    echo 'selected="selected"';
                                } ?> value="734003">0,7 MB
                                </option>
                                <option <?php if ($photo_limit == 1048576) {
                                    echo 'selected="selected"';
                                } ?> value="1048576">1,0 MB
                                </option>
                                <option <?php if ($photo_limit == 1572864) {
                                    echo 'selected="selected"';
                                } ?> value="1572864">1,5 MB
                                </option>
                                <option <?php if ($photo_limit == 2097152) {
                                    echo 'selected="selected"';
                                } ?> value="2097152">2,0 MB
                                </option>
                                <option <?php if ($photo_limit == 2621440) {
                                    echo 'selected="selected"';
                                } ?> value="2621440">2,5 MB
                                </option>
                                <option <?php if ($photo_limit == 3145728) {
                                    echo 'selected="selected"';
                                } ?> value="3145728">3,0 MB
                                </option>
                                <option <?php if ($photo_limit == 3670016) {
                                    echo 'selected="selected"';
                                } ?> value="3670016">3,5 MB
                                </option>
                                <option <?php if ($photo_limit == 4194304) {
                                    echo 'selected="selected"';
                                } ?> value="4194304">4,0 MB
                                </option>
                                <option <?php if ($photo_limit == 5242880) {
                                    echo 'selected="selected"';
                                } ?> value="5242880">5,0 MB
                                </option>
                                <option <?php if ($photo_limit == 10485760) {
                                    echo 'selected="selected"';
                                } ?> value="10485760">10,0 MB
                                </option>
                                <option <?php if ($photo_limit == 15728640) {
                                    echo 'selected="selected"';
                                } ?> value="15728640">15,0 MB
                                </option>
                                <option <?php if ($photo_limit == 52428800) {
                                    echo 'selected="selected"';
                                } ?> value="52428800">50,0 MB
                                </option>
                                <option <?php if ($photo_limit == 157286400) {
                                    echo 'selected="selected"';
                                } ?> value="157286400">150,0 MB
                                </option>
                            </select>
                            <span class="input-group-state"> <span class="p-position"> <span class="p-text"> <span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span> </span> </span> </span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span> </label>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="maxwidth"><?php _e('Max Image Width', 'photo-contest'); ?> <small>(<?php _e('All images above this size will be automatically resized', 'photo-contest'); ?>)</small></label>
                        <label class="input-group p-custom-arrow">
                            <select name="maxwidth" id="maxwidth" class="form-control">
                                <option <?php if ($maxwidth == 1920) {
                                    echo 'selected="selected"';
                                } ?> value="1920">1920px <?php _e('(Recommended)', 'photo-contest'); ?></option>
                                <option <?php if ($maxwidth == 500) {
                                    echo 'selected="selected"';
                                } ?> value="500">500px
                                </option>
                                <option <?php if ($maxwidth == 600) {
                                    echo 'selected="selected"';
                                } ?> value="600">600px
                                </option>
                                <option <?php if ($maxwidth == 700) {
                                    echo 'selected="selected"';
                                } ?> value="700">700px
                                </option>
                                <option <?php if ($maxwidth == 800) {
                                    echo 'selected="selected"';
                                } ?> value="800">800px
                                </option>
                                <option <?php if ($maxwidth == 900) {
                                    echo 'selected="selected"';
                                } ?> value="900">900px
                                </option>
                                <option <?php if ($maxwidth == 1000) {
                                    echo 'selected="selected"';
                                } ?> value="1000">1000px
                                </option>
                                <option <?php if ($maxwidth == 1100) {
                                    echo 'selected="selected"';
                                } ?> value="1100">1100px
                                </option>
                                <option <?php if ($maxwidth == 1200) {
                                    echo 'selected="selected"';
                                } ?> value="1200">1200px
                                </option>
                                <option <?php if ($maxwidth == 1300) {
                                    echo 'selected="selected"';
                                } ?> value="1300">1300px
                                </option>
                                <option <?php if ($maxwidth == 1400) {
                                    echo 'selected="selected"';
                                } ?> value="1400">1400px
                                </option>
                                <option <?php if ($maxwidth == 1500) {
                                    echo 'selected="selected"';
                                } ?> value="1500">1500px
                                </option>
                                <option <?php if ($maxwidth == 1600) {
                                    echo 'selected="selected"';
                                } ?> value="1600">1600px
                                </option>
                                <option <?php if ($maxwidth == 1700) {
                                    echo 'selected="selected"';
                                } ?> value="1700">1700px
                                </option>
                                <option <?php if ($maxwidth == 1800) {
                                    echo 'selected="selected"';
                                } ?> value="1800">1800px
                                </option>
                                <option <?php if ($maxwidth == 1900) {
                                    echo 'selected="selected"';
                                } ?> value="1900">1900px
                                </option>
                                <option <?php if ($maxwidth == 2000) {
                                    echo 'selected="selected"';
                                } ?> value="2000">2000px
                                </option>
                                <option <?php if ($maxwidth == 2100) {
                                    echo 'selected="selected"';
                                } ?> value="2100">2100px
                                </option>
                                <option <?php if ($maxwidth == 2200) {
                                    echo 'selected="selected"';
                                } ?> value="2200">2200px
                                </option>
                                <option <?php if ($maxwidth == 2300) {
                                    echo 'selected="selected"';
                                } ?> value="2300">2300px
                                </option>
                                <option <?php if ($maxwidth == 2400) {
                                    echo 'selected="selected"';
                                } ?> value="2400">2400px
                                </option>
                                <option <?php if ($maxwidth == 2500) {
                                    echo 'selected="selected"';
                                } ?> value="2500">2500px
                                </option>
                                <option <?php if ($maxwidth == 2600) {
                                    echo 'selected="selected"';
                                } ?> value="2600">2600px
                                </option>
                                <option <?php if ($maxwidth == 3000) {
                                    echo 'selected="selected"';
                                } ?> value="3000">3000px
                                </option>
                                <option <?php if ($maxwidth == 5000) {
                                    echo 'selected="selected"';
                                } ?> value="5000">5000px
                                </option>
                                <option <?php if ($maxwidth == 10000) {
                                    echo 'selected="selected"';
                                } ?> value="10000">10000px
                                </option>
                            </select>
                            <span class="input-group-state"> <span class="p-position"> <span class="p-text"> <span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span> </span> </span> </span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span> </label>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="maxheight"><?php _e('Max Image Height', 'photo-contest'); ?> <small>(<?php _e('All images above this size will be automatically resized', 'photo-contest'); ?>)</small></label>
                        <label class="input-group p-custom-arrow">
                            <select name="maxheight" id="maxheight" class="form-control">
                                <option <?php if ($maxheight == 1080) {
                                    echo 'selected="selected"';
                                } ?> value="1080">1080px <?php _e('(Recommended)', 'photo-contest'); ?></option>
                                <option <?php if ($maxheight == 500) {
                                    echo 'selected="selected"';
                                } ?> value="500">500px
                                </option>
                                <option <?php if ($maxheight == 600) {
                                    echo 'selected="selected"';
                                } ?> value="600">600px
                                </option>
                                <option <?php if ($maxheight == 700) {
                                    echo 'selected="selected"';
                                } ?> value="700">700px
                                </option>
                                <option <?php if ($maxheight == 800) {
                                    echo 'selected="selected"';
                                } ?> value="800">800px
                                </option>
                                <option <?php if ($maxheight == 900) {
                                    echo 'selected="selected"';
                                } ?> value="900">900px
                                </option>
                                <option <?php if ($maxheight == 1000) {
                                    echo 'selected="selected"';
                                } ?> value="1000">1000px
                                </option>
                                <option <?php if ($maxheight == 1100) {
                                    echo 'selected="selected"';
                                } ?> value="1100">1100px
                                </option>
                                <option <?php if ($maxheight == 1200) {
                                    echo 'selected="selected"';
                                } ?> value="1200">1200px
                                </option>
                                <option <?php if ($maxheight == 1300) {
                                    echo 'selected="selected"';
                                } ?> value="1300">1300px
                                </option>
                                <option <?php if ($maxheight == 1400) {
                                    echo 'selected="selected"';
                                } ?> value="1400">1400px
                                </option>
                                <option <?php if ($maxheight == 1500) {
                                    echo 'selected="selected"';
                                } ?> value="1500">1500px
                                </option>
                                <option <?php if ($maxheight == 1600) {
                                    echo 'selected="selected"';
                                } ?> value="1600">1600px
                                </option>
                                <option <?php if ($maxheight == 1700) {
                                    echo 'selected="selected"';
                                } ?> value="1700">1700px
                                </option>
                                <option <?php if ($maxheight == 1800) {
                                    echo 'selected="selected"';
                                } ?> value="1800">1800px
                                </option>
                                <option <?php if ($maxheight == 1900) {
                                    echo 'selected="selected"';
                                } ?> value="1900">1900px
                                </option>
                                <option <?php if ($maxheight == 2000) {
                                    echo 'selected="selected"';
                                } ?> value="2000">2000px
                                </option>
                                <option <?php if ($maxheight == 2100) {
                                    echo 'selected="selected"';
                                } ?> value="2100">2100px
                                </option>
                                <option <?php if ($maxheight == 2200) {
                                    echo 'selected="selected"';
                                } ?> value="2200">2200px
                                </option>
                                <option <?php if ($maxheight == 2300) {
                                    echo 'selected="selected"';
                                } ?> value="2300">2300px
                                </option>
                                <option <?php if ($maxheight == 2400) {
                                    echo 'selected="selected"';
                                } ?> value="2400">2400px
                                </option>
                                <option <?php if ($maxheight == 2500) {
                                    echo 'selected="selected"';
                                } ?> value="2500">2500px
                                </option>
                                <option <?php if ($maxheight == 2600) {
                                    echo 'selected="selected"';
                                } ?> value="2600">2600px
                                </option>
                                <option <?php if ($maxheight == 3000) {
                                    echo 'selected="selected"';
                                } ?> value="3000">3000px
                                </option>
                                <option <?php if ($maxheight == 5000) {
                                    echo 'selected="selected"';
                                } ?> value="5000">5000px
                                </option>
                                <option <?php if ($maxheight == 10000) {
                                    echo 'selected="selected"';
                                } ?> value="10000">10000px
                                </option>
                            </select>
                            <span class="input-group-state"> <span class="p-position"> <span class="p-text"> <span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span> </span> </span> </span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span> </label>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="allow-lightbox"><?php _e('Allow Lightbox', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_lightbox == 1 or empty($allow_lightbox)) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-lightbox" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('No', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_lightbox == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-lightbox" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Yes', 'photo-contest'); ?>
                      <small>
                      <?php _e('(Lightbox without jquery.min.js file - Try this option first)', 'photo-contest'); ?>
                      </small></span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_lightbox == 3) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-lightbox" value="3">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Yes', 'photo-contest'); ?>
                      <small>
                      <?php _e('(Lightbox with jquery.min.js - This setup can create conflict with your theme or other plugins)', 'photo-contest'); ?>
                      </small></span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="allow-activate"><?php _e('Automatically activate uploaded images', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_activate == 1) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-activate" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Yes', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_activate == 2 or empty($allow_activate)) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-activate" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('No', 'photo-contest'); ?>
                      <small>
                      <?php _e('(Recommended)', 'photo-contest'); ?>
                      </small>
                      </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="show-adminbar"><?php _e('Show Frontend Admin Bar', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($show_adminbar == 1 or empty($show_adminbar)) {
                                        echo 'checked';
                                    } ?> type="radio" name="show-adminbar" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Show', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($show_adminbar == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="show-adminbar" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Hide', 'photo-contest'); ?>
                      <small>
                      <?php _e('(Excerpt Admin) (Higly Recommended)', 'photo-contest'); ?>
                      </small></span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="allow-animation"><?php _e('Allow menu and gallery animation', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_animation == 1 or empty($allow_animation)) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-animation" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Yes', 'photo-contest'); ?> <small><?php _e('(It is pure CSS animation)', 'photo-contest'); ?></small>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_animation == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-animation" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('No', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Comments', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="allow-comments"><?php _e('Allow Comment Box', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_comments == 2 or empty($allow_comments)) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-comments" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('No', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_comments == 1) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-comments" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Allow Disqus Comments', 'photo-contest'); ?> <small>
					  <?php add_thickbox(); ?>
                        <div id="disqus" style="display:none;">
                             <iframe width="600" height="315" src="https://www.youtube.com/embed/S2k5KCndjOI?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen autoplay></iframe>
                        </div>
                      <a href="#TB_inline?width=580&height=330&inlineId=disqus" class="thickbox"><?php _e('(Tutorial)', 'photo-contest'); ?></a></small></span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_comments == 3) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-comments" value="3">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Allow WordPress Comments', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="disqus-code"><?php _e('Disqus Code', 'photo-contest'); ?> <small>
                                <?php add_thickbox(); ?>
                                <a href="#TB_inline?width=580&height=330&inlineId=disqus" class="thickbox"><?php _e('(Tutorial)', 'photo-contest'); ?></a></small></label>
                        <div class="input-group p-has-icon">
                            <textarea id="disqus-code" name="disqus-code" class="form-control"><?php echo $disqus_code; ?></textarea>
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span><span class="input-group-icon"><i class="fa fa-code"></i></span></div>
                    </div>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Typography', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="font"><?php _e('Font', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($font == "1" or empty($font)) {
                                        echo 'checked';
                                    } ?> type="radio" name="font" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Oswald', 'photo-contest'); ?> <small><?php _e('(Recommended)', 'photo-contest'); ?></small>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($font == "2") {
                                        echo 'checked';
                                    } ?> type="radio" name="font" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Work Sans', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($font == "6") {
                                        echo 'checked';
                                    } ?> type="radio" name="font" value="6">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Roboto Condensed', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($font == "3") {
                                        echo 'checked';
                                    } ?> type="radio" name="font" value="3">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Noto Sans', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($font == "4") {
                                        echo 'checked';
                                    } ?> type="radio" name="font" value="4">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Noto Serif', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($font == "5") {
                                        echo 'checked';
                                    } ?> type="radio" name="font" value="5">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Default', 'photo-contest'); ?> <small><?php _e('(Default font from your theme will be used)', 'photo-contest'); ?></small>
                      </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="font-size"><?php _e('Font Size', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($font_size == "pcfontsize" or empty($font_size)) {
                                        echo 'checked';
                                    } ?> type="radio" name="font-size" value="pcfontsize">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Normal', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($font_size == "pcfontsizebig") {
                                        echo 'checked';
                                    } ?> type="radio" name="font-size" value="pcfontsizebig">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Big', 'photo-contest'); ?> <small>(+1px)</small>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($font_size == "pcfontsizebigger") {
                                        echo 'checked';
                                    } ?> type="radio" name="font-size" value="pcfontsizebigger">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Bigger', 'photo-contest'); ?> <small>(+2px)</small>
                      </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Security', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="allow-reCaptcha"><?php _e('Allow reCaptcha', 'photo-contest'); ?> V2</label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_reCaptcha == 1) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-reCaptcha" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Yes - For Everyone', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_reCaptcha == 3) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-reCaptcha" value="3">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Yes - But the reCaptcha will be hidden for Admins', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_reCaptcha == 2 or empty($allow_reCaptcha)) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-reCaptcha" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('No', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="site-key"><?php _e('reCaptcha Site Key', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="site-key" name="site-key" class="form-control" value="<?php echo $site_key; ?>">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-key" aria-hidden="true"></i></span></div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="site-key"><?php _e('reCaptcha Secret Key', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="secret-key" name="secret-key" class="form-control" value="<?php echo $secret_key; ?>">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-user-secret" aria-hidden="true"></i></span></div>
                    </div>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('GDPR - General Data Protection Regulation', 'photo-contest'); ?></span></div>

                    <p><?php _e('The General Data Protection Regulation (GDPR) (EU) 2016/679 is a regulation in EU law on data protection and privacy for all individuals within the European Union (EU) and the European Economic Area (EEA). It also addresses the export of personal data outside the EU and EEA. The GDPR aims primarily to give control to citizens and residents over their personal data and to simplify the regulatory environment for international business by unifying the regulation within the EU.', 'photo-contest'); ?></p>

                    <div class="form-group form-group-width">
                        <label for="font"><?php _e('Allow GDPR confirmation box', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_GDPR == "1") {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-GDPR" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Yes', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_GDPR == "2" or empty($allow_GDPR)) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-GDPR" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('No', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="email-headline"><?php _e('GDPR text (for checkbox)', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="allow-GDPR-text" name="allow-GDPR-text" value="<?php echo stripslashes($allow_GDPR_text); ?>" class="form-control">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-shield"></i></span></div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="disqus-code"><?php _e('GDPR Privacy Notice', 'photo-contest'); ?></label>
                        <p><small><?php _e('The area for your privacy notice text or if it is too long add html link to your privacy notice page with target _blank', 'photo-contest'); ?></small></p>

                        <?php wp_editor(stripslashes($allow_GDPR_notice), 'allow-GDPR-notice'); ?>

                    </div>


                    <input type="hidden" name="plugin_setting" id="plugin_setting" value="ok"/>
                    <div class="text-right">
                        <input type="submit" name="submit" id="submit" class="pc-btn" value="<?php _e('Save Changes', 'photo-contest'); ?>">
                    </div>
                </div>


                <div class="tab-pane">
                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Vote Settings', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="who-vote"><?php _e('Who can vote', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($who_vote == 1 or empty($who_vote)) {
                                        echo 'checked';
                                    } ?> type="radio" name="who-vote" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Registered Users', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($who_vote == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="who-vote" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Everyone', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="confirm-votes"><?php _e('Confirm votes from guests by email?', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($confirm_votes == 1) {
                                        echo 'checked';
                                    } ?> type="radio" name="confirm-votes" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Yes', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($confirm_votes == 2 or empty($confirm_votes)) {
                                        echo 'checked';
                                    } ?> type="radio" name="confirm-votes" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('No', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="author-vote"><?php _e('Can author vote for own photo?', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($author_vote == 1 or empty($author_vote)) {
                                        echo 'checked';
                                    } ?> type="radio" name="author-vote" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Yes', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($author_vote == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="author-vote" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('No', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="redirect-vote"><?php _e('Redirect the user to Share page after vote?', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($redirect_vote == 1 or empty($redirect_vote)) {
                                        echo 'checked';
                                    } ?> type="radio" name="redirect-vote" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Yes', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($redirect_vote == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="redirect-vote" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('No', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="vote-button-color"><?php _e('Vote button color', 'photo-contest'); ?></label>
                        <div class="p-form-colorpick pt-form-panel">

                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'ff0000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="ff0000"><span class="p-color-block" style="background: #ff0000"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'd70000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="d70000"><span class="p-color-block" style="background: #d70000"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '940303') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="940303"><span class="p-color-block" style="background: #940303"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '09F' or empty($vote_button_color)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="09F"><span class="p-color-block" style="background: #09F"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '1e5799') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="1e5799"><span class="p-color-block" style="background: #1e5799"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '153e6a') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="153e6a"><span class="p-color-block" style="background: #153e6a"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '92e428') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="92e428"><span class="p-color-block" style="background: #92e428"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '6fba0f') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="6fba0f"><span class="p-color-block" style="background: #6fba0f"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '4f8c00') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="4f8c00"><span class="p-color-block" style="background: #4f8c00"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'eeda30') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="eeda30"><span class="p-color-block" style="background: #eeda30"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'dcc81f') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="dcc81f"><span class="p-color-block" style="background: #dcc81f"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'c4b003') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="c4b003"><span class="p-color-block" style="background: #c4b003"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'fd8603') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="fd8603"><span class="p-color-block" style="background: #fd8603"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'c64900') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="c64900"><span class="p-color-block" style="background: #c64900"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '854502') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="854502"><span class="p-color-block" style="background: #854502"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'df2dd5') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="df2dd5"><span class="p-color-block" style="background: #df2dd5"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'c914be') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="c914be"><span class="p-color-block" style="background: #c914be"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '9b0492') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="9b0492"><span class="p-color-block" style="background: #9b0492"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'd70081') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="d70081"><span class="p-color-block" style="background: #d70081"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == 'ba0371') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="ba0371"><span class="p-color-block" style="background: #ba0371"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '9a015d') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="9a015d"><span class="p-color-block" style="background: #9a015d"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '18c8c6') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="18c8c6"><span class="p-color-block" style="background: #18c8c6"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '0ea4a2') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="0ea4a2"><span class="p-color-block" style="background: #0ea4a2"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '058482') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="058482"><span class="p-color-block" style="background: #058482"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '969696') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="969696"><span class="p-color-block" style="background: #969696"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '707070') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="707070"><span class="p-color-block" style="background: #707070"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($vote_button_color == '000000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="vote-button-color" value="000000"><span class="p-color-block" style="background: #000000"></span></label></div>

                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="vote-icon"><?php _e('Use Icon in Vote Button', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_icon == 1 or empty($vote_icon)) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-icon" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('No Icon', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_icon == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-icon" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_icon == 8) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-icon" value="8">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_icon == 3) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-icon" value="3">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <i class="fa fa-heart" aria-hidden="true"></i>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_icon == 4) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-icon" value="4">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_icon == 5) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-icon" value="5">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <i class="fa fa-check" aria-hidden="true"></i>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_icon == 6) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-icon" value="6">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_icon == 7) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-icon" value="7">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                      </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="vote-icon"><?php _e('Vote text', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_text == 2 or empty($vote_text)) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-text" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Standart text', 'photo-contest'); ?>
                        (<?php _e('Vote for this photo!', 'photo-contest'); ?>) </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_text == 3) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-text" value="3">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Vote!', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_text == 5) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-text" value="5">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Vote Now!', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_text == 1) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-text" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('No text at all', 'photo-contest'); ?>
                        </span>
                                </label>
                            </div>
                            <div class="radio">
                                <label class="p-check-input">
                                    <input <?php if ($vote_text == 4) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-text" value="4" class="p-check-input">
                                    <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="form-group">
                      <div class="input-group p-has-icon">
                        <input type="text" id="radio-other" name="vote-own-text" placeholder="<?php _e('your text', 'photo-contest'); ?>" class="form-control" value="<?php echo $vote_own_text; ?>">
                        <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o"></i></span></div>
                      </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="vote-icon"><?php _e('Vote text after Vote', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_after_text == 1 or empty($vote_icon)) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-after-text" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label"><?php _e('Standart text', 'photo-contest'); ?> (<?php _e('Thank you for vote!', 'photo-contest'); ?>)</span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($vote_after_text == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-after-text" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Thank You!', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label class="p-check-input">
                                    <input <?php if ($vote_after_text == 3) {
                                        echo 'checked';
                                    } ?> type="radio" name="vote-after-text" value="3" class="p-check-input">
                                    <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="form-group">
                      <div class="input-group p-has-icon">
                        <input type="text" id="radio-other" name="vote-own-text-after" placeholder="<?php _e('your text', 'photo-contest'); ?>" class="form-control" value="<?php echo $vote_own_text_after; ?>">
                        <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o"></i></span></div>
                      </span>
                                </label>
                            </div>

                        </div>
                    </div>


                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side">
				<?php _e('Settings for a 5-star and 10-star rating mode', 'photo-contest'); ?>
				</span></div>


                    <div class="form-group form-group-width">
                        <label for="vote-icon"><?php _e('Text after rating', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($rate_after_text == 1 or empty($rate_after_text)) {
                                        echo 'checked';
                                    } ?> type="radio" name="rate-after-text" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label"><?php _e('Standart text', 'photo-contest'); ?> (<?php _e('Thank you!', 'photo-contest'); ?>)</span> </label>
                            </div>
                            <div class="radio">
                                <label class="p-check-input">
                                    <input <?php if ($rate_after_text == 3) {
                                        echo 'checked';
                                    } ?> type="radio" name="rate-after-text" value="3" class="p-check-input">
                                    <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="form-group">
                      <div class="input-group p-has-icon">
                        <input type="text" id="radio-other" name="rate-own-text-after" placeholder="<?php _e('your text', 'photo-contest'); ?>" class="form-control" value="<?php echo $rate_own_text_after; ?>">
                        <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o"></i></span></div>
                      </span>
                                </label>
                            </div>

                        </div>
                    </div>


                    <div class="text-right">
                        <input type="submit" name="submit" id="submit" class="pc-btn" value="<?php _e('Save Changes', 'photo-contest'); ?>">
                    </div>

                </div>
                <div class="tab-pane">
                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('General Settings', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="email-notification"><?php _e('Automatically send email nofitication (to admin) when new contest image is uploaded', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($email_notification == 1) {
                                        echo 'checked';
                                    } ?> type="radio" name="email-notification" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Yes', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($email_notification == 2 or empty($email_notification)) {
                                        echo 'checked';
                                    } ?> type="radio" name="email-notification" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('No', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="email-notification-about-user"><?php _e('Automatically send email nofitication (to admin) about new user registration', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($email_notification_about_user == 1) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-notification-about-user" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Yes', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($email_notification_about_user == 2 or empty($email_notification_about_user)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-notification-about-user" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('No', 'photo-contest'); ?>
                      </span> </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="admin-email"><?php _e('Email address for notifications (for admin)', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($admin_email == 1 or empty($admin_email)) {
                                        echo 'checked';
                                    } ?> type="radio" name="admin-email" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Standard admin email address', 'photo-contest'); ?> (<?php echo get_option('admin_email'); ?>) </span> </label>
                            </div>
                            <div class="radio">
                                <label class="p-check-input">
                                    <input <?php if ($admin_email == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="admin-email" value="2" class="p-check-input">
                                    <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="form-group">
                      <div class="input-group p-has-icon">
                        <input type="email" id="radio-other" name="admin-email-input" placeholder="<?php _e('alternative@email.tld', 'photo-contest'); ?>" class="form-control" value="<?php echo $admin_email_input; ?>">
                        <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-envelope-o"></i></span></div>
                      </span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"> <?php _e('Notification email after image approval', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="admin-new-user-email"><?php _e('Send notification email (to user) after image approval', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($image_approval_email == 1) {
                                        echo 'checked';
                                    } ?> type="radio" name="image-approval-email" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Yes', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($image_approval_email == 2 or empty($image_approval_email)) {
                                        echo 'checked';
                                    } ?> type="radio" name="image-approval-email" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('No', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="image-approval-email-subject"><?php _e('Subject (Email Title)', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="email-sender" name="image-approval-email-subject" value="<?php echo $image_approval_email_subject; ?>" class="form-control">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-font"></i></span></div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="image-approval-email-body"><?php _e('Email Body', 'photo-contest'); ?></label>

                        <?php
                        $settings = [
                            'wpautop' => true,
                            'media_buttons' => true,
                            'textarea_name' => 'image-approval-email-body',
                            'textarea_rows' => 10,
                            'tabindex' => '',
                            'tabfocus_elements' => ':prev,:next',
                            'editor_css' => '',
                            'editor_class' => '',
                            'teeny' => false,
                            'dfw' => false,
                            'tinymce' => false, // <-----
                            'quicktags' => true
                        ];
                        wp_editor(stripslashes($image_approval_email_body), strtolower("image-approval-email-body"), $settings); ?>

                        <p style="padding-top:10px;">
                            <strong><?php _e('Notice:', 'photo-contest'); ?></strong>
                        </p>
                        <pre><?php _e('If you add an image to the email it should be secured by SSL (hosted on https://) otherwise the email can be stopped!', 'photo-contest'); ?></pre>
                        <pre>(<?php _e('{PHOTO-NAME},{CONTEST-URL} and {CONTEST-NAME} will be autoamtically replaced for real Photo name, Contest URL and Contest name', 'photo-contest'); ?>)</pre>
                        <p>
                            <strong><?php _e('Example:', 'photo-contest'); ?></strong>
                        </p>
                        <pre>Your image "{PHOTO-NAME}" in the contest &lt;a href="{CONTEST-URL}"&gt;{CONTEST-NAME}&lt;/a&gt; was approved!</pre>

                    </div>


                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"> <?php _e('Welcome email', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="allow-custom-welcome-mail"><?php _e('Allow custom "Welcome email"', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_custom_welcome_mail == 1) {
                                        echo 'checked';
                                    } ?> type="radio" name="allow-custom-welcome-mail" value="1" checked>
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Yes', 'photo-contest'); ?>
                        <small>
                        <?php _e('(Recommended)', 'photo-contest'); ?>
                        </small></span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($allow_custom_welcome_mail == 2 or empty($allow_custom_welcome_mail)) {
                                        echo 'checked';
                                    }
                                    ?> type="radio" name="allow-custom-welcome-mail" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('No', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="email-menu-bg-color"><?php _e('Menu background color', 'photo-contest'); ?></label>
                        <div class="p-form-colorpick  pt-form-panel">
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'ff0000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="ff0000"><span class="p-color-block" style="background: #ff0000"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'd70000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="d70000"><span class="p-color-block" style="background: #d70000"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '940303') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="940303"><span class="p-color-block" style="background: #940303"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '3dc0f1') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="3dc0f1"><span class="p-color-block" style="background: #3dc0f1"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '1e5799' or empty($email_menu_bg_color)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="1e5799"><span class="p-color-block" style="background: #1e5799"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '153e6a') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="153e6a"><span class="p-color-block" style="background: #153e6a"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '92e428') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="92e428"><span class="p-color-block" style="background: #92e428"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '6fba0f') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="6fba0f"><span class="p-color-block" style="background: #6fba0f"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '4f8c00') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="4f8c00"><span class="p-color-block" style="background: #4f8c00"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'eeda30') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="eeda30"><span class="p-color-block" style="background: #eeda30"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'dcc81f') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="dcc81f"><span class="p-color-block" style="background: #dcc81f"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'c4b003') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="c4b003"><span class="p-color-block" style="background: #c4b003"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'fd8603') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="fd8603"><span class="p-color-block" style="background: #fd8603"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'c64900') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="c64900"><span class="p-color-block" style="background: #c64900"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '854502') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="854502"><span class="p-color-block" style="background: #854502"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'df2dd5') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="df2dd5"><span class="p-color-block" style="background: #df2dd5"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'c914be') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="c914be"><span class="p-color-block" style="background: #c914be"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '9b0492') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="9b0492"><span class="p-color-block" style="background: #9b0492"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'd70081') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="d70081"><span class="p-color-block" style="background: #d70081"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == 'ba0371') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="ba0371"><span class="p-color-block" style="background: #ba0371"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '9a015d') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="9a015d"><span class="p-color-block" style="background: #9a015d"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '18c8c6') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="18c8c6"><span class="p-color-block" style="background: #18c8c6"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '0ea4a2') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="0ea4a2"><span class="p-color-block" style="background: #0ea4a2"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '058482') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="058482"><span class="p-color-block" style="background: #058482"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '969696') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="969696"><span class="p-color-block" style="background: #969696"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '707070') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="707070"><span class="p-color-block" style="background: #707070"></span></label></div>
                            <div class="p-radio-color"><label><input <?php if ($email_menu_bg_color == '000000') {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="email-menu-bg-color" value="000000"><span class="p-color-block" style="background: #000000"></span></label></div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="email-sender"><?php _e('Subject (Email Title)', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="email-sender" name="email-sender" value="<?php echo $email_sender; ?>" class="form-control">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-font"></i></span></div>
                    </div>


                    <div class="form-group form-group-width">
                        <label for="email-headline"><?php _e('Headline', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="email-headline" name="email-headline" required="required" value="<?php echo $email_headline; ?>" class="form-control">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-header"></i></span></div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="email-body"><?php _e('Email Body', 'photo-contest'); ?></label>
                        <?php
                        $settings = [
                            'wpautop' => true,
                            'media_buttons' => true,
                            'textarea_name' => 'email-body',
                            'textarea_rows' => 15,
                            'tabindex' => '',
                            'tabfocus_elements' => ':prev,:next',
                            'editor_css' => '',
                            'editor_class' => '',
                            'teeny' => false,
                            'dfw' => false,
                            'tinymce' => false, // <-----
                            'quicktags' => true
                        ];
                        wp_editor(stripslashes($email_body), strtolower("email-body"), $settings); ?>


                        <p style="padding-top:10px;">
                            <strong><?php _e('Notice:', 'photo-contest'); ?></strong>
                        </p>
                        <pre><?php _e('If you add an image to the email it should be secured by SSL (hosted on https://) otherwise the email can be stopped!', 'photo-contest'); ?></pre>
                        <pre>(<?php _e('{USER-NAME},{CONTEST-URL} and {CONTEST-NAME} will be autoamtically replaced for real Username, Contest URL and Contest name', 'photo-contest'); ?>)</pre>
                        <p>
                            <strong><?php _e('Example:', 'photo-contest'); ?></strong>
                        </p>
                        <pre>Hello "{USER-NAME}"! Welcome to our Photo Contest &lt;a href="{CONTEST-URL}"&gt;{CONTEST-NAME}&lt;/a&gt;!</pre>

                    </div>

                    <div class="form-group form-group-width">
                        <label for="allow-custom-welcome-mail"><?php _e('Send login details with "Welcome" email?', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($send_login == 1) {
                                        echo 'checked';
                                    } ?> type="radio" name="send-login" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Yes, send direct password', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($send_login == 3 or empty($send_login)) {
                                        echo 'checked';
                                    } ?> type="radio" name="send-login" value="3">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('Yes, but not password directly only "generate password" link.', 'photo-contest'); ?>
												<small>
                        <?php _e('(Recommended)', 'photo-contest'); ?>
                        </small></span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($send_login == 2) {
                                        echo 'checked';
                                    } ?> type="radio" name="send-login" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                        <?php _e('No', 'photo-contest'); ?>
                        </span> </label>
                            </div>
                        </div>
                    </div>


                    <div class="text-right">
                        <input type="submit" name="submit" id="submit" class="pc-btn" value="<?php _e('Save Changes', 'photo-contest'); ?>">
                    </div>

                </div>
                <div class="tab-pane">
                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Menu settings', 'photo-contest'); ?></span></div>
                    <p>
                        <?php _e('Menu color and style you can set for every contest differently in contest settings.', 'photo-contest'); ?>
                    </p>

                    <div class="form-group form-group-width">
                        <label for="menu-open"><?php _e('Menu layout', 'photo-contest'); ?></label>

                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($menu_layout == 1) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-layout" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Menu layout 1', 'photo-contest'); ?></span><img style="max-width:100%" src="<?php echo plugins_url('assets/menuV1.jpg', dirname(__FILE__)); ?>"/></label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($menu_layout == 2 or empty($menu_layout)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-layout" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                  <?php _e('Menu layout 2', 'photo-contest'); ?></span><img style="max-width:100%" src="<?php echo plugins_url('assets/menuV2.jpg', dirname(__FILE__)); ?>"/></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="menu-open"><?php _e('Mobile Menu', 'photo-contest'); ?>
                            <div><small><?php _e('Some WordPress themes have javascripts for animation. This animation block CSS selector :target so instead of opening menu (on mobile devices) create slide animation. If you have this issue you have two options. Option one is disable this animation in your theme and for option two is possible to use jQuery menu opening script.', 'photo-contest'); ?></small></div>
                        </label>

                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($menu_open == 1) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-open" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Open mobile menu using CSS', 'photo-contest'); ?></span> </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php if ($menu_open == 2 or empty($menu_open)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="menu-open" value="2">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                      <?php _e('Open mobile menu using jQuery', 'photo-contest'); ?>
                      </span> </label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group form-group-width">
                        <label for="menu-gallery"><?php _e('Change text "Gallery"', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="menu-gallery" name="menu-gallery" <?php if (empty($vote_menu_gallery)) { ?>placeholder="<?php _e('Gallery', 'photo-contest'); ?>" <?php } else { ?> value="<?php echo $vote_menu_gallery; ?>" <?php } ?>class="form-control">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-image"></i></span></div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="menu-upload"><?php _e('Change text "Upload Photo"', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="menu-upload" name="menu-upload" <?php if (empty($vote_menu_upload)) { ?>placeholder="<?php _e('Upload photo', 'photo-contest'); ?>" <?php } else { ?> value="<?php echo $vote_menu_upload; ?>" <?php } ?>class="form-control">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-upload"></i></span></div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="menu-rules"><?php _e('Change text "Rules & Prizes"', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="menu-rules" name="menu-rules" <?php if (empty($vote_menu_rules)) { ?>placeholder="<?php _e('Rules & Prizes', 'photo-contest'); ?>" <?php } else { ?> value="<?php echo $vote_menu_rules; ?>" <?php } ?>class="form-control">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-info"></i></span></div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="menu-rules"><?php _e('Change text "Your Images"', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="menu-your-images" name="menu-your-images" <?php if (empty($vote_menu_your_images)) { ?>placeholder="<?php _e('Your Images', 'photo-contest'); ?>" <?php } else { ?> value="<?php echo $vote_menu_your_images; ?>" <?php } ?>class="form-control">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-user"></i></span></div>
                    </div>

                    <div class="form-group form-group-width">
                        <label for="menu-rules"><?php _e('Change text "Top 10"', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <input type="text" id="menu-top10" name="menu-top10" <?php if (empty($vote_menu_top10)) { ?>placeholder="<?php _e('Top 10', 'photo-contest'); ?>" <?php } else { ?> value="<?php echo $vote_menu_top10; ?>" <?php } ?>class="form-control">
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-star"></i></span></div>
                    </div>


                    <div class="text-right">
                        <input type="submit" name="submit" id="submit" class="pc-btn" value="<?php _e('Save Changes', 'photo-contest'); ?>">
                    </div>

                </div>
                <div class="tab-pane">
                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Login and registration form', 'photo-contest'); ?></span></div>

                    <div class="form-group form-group-width">
                        <label for="login-form"><?php _e('What to use for login and registration', 'photo-contest'); ?></label>
                        <div class="p-form-cg pt-form-panel">
                            <div class="radio">
                                <label>
                                    <input <?php if ($login_form == 1 or empty($login_form)) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="login-form" value="1">
                                    <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
											 <?php _e('Standard Photo Contest login and registration form', 'photo-contest'); ?>
											</span> </label>
                            </div>
                            <div class="radio">
                                <label class="p-check-input">
                                    <input <?php if ($login_form == 2) {
                                        echo 'checked="checked"';
                                    } ?> type="radio" name="login-form" value="2" class="p-check-input">
                                    <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="form-group">
												<?php _e('3rd party plugin for login and registration. Please add shortcode for that form!', 'photo-contest'); ?>
											<div class="input-group p-has-icon">
												<input type="text" id="radio-other" name="login-form-input" placeholder="" class="form-control" value="<?php echo stripslashes($login_form_input); ?>">
												<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-code"></i></span></div>
											</span>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Own code injection to the header section', 'photo-contest'); ?></span></div>

                    <p><?php _e('Be very careful. If you add code to the header section it must be properly coded! You must define attributes correctly. And please remember the code will be added to the header only where the gallery is. So if you need add code for every single post or page please use a special plugin for that.', 'photo-contest'); ?> <a href="<?php echo plugins_url('assets/admin/codescreenshot.png', dirname(__FILE__)); ?>"><i class="fa fa-info-circle"></i></a>
                    </p>

                    <div class="form-group form-group-width">
                        <label for="disqus-code"><?php _e('Header Code', 'photo-contest'); ?></label>
                        <div class="input-group p-has-icon">
                            <textarea id="header-code" name="header-code" class="form-control" style="min-height:200px;"><?php echo $header_code; ?></textarea>
                            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span><span class="input-group-icon"><i class="fa fa-code"></i></span></div>
                    </div>

                    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('BuddyPress integration', 'photo-contest'); ?></span></div>
                    <?php if (is_plugin_active('buddypress/bp-loader.php')) { ?>

                        <div class="form-group form-group-width">
                            <div class="p-form-sg pt-form-panel">

                                <div class="p-switch">
                                    <label>
                                        <input type="checkbox" name="allow_buddy_images" value="ch" <?php if ($allow_buddy_images == 2) {
                                            echo 'checked';
                                        } ?>>
                                        <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Show images after upload in activity stream', 'photo-contest'); ?></span></label>
                                </div>
                                <div class="p-switch">
                                    <label>
                                        <input type="checkbox" name="allow_buddy_comments" value="ch" <?php if ($allow_buddy_comments == 2) {
                                            echo 'checked';
                                        } ?>>
                                        <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Show new comments in activity stream (works only with Wordpress comments)', 'photo-contest'); ?></span></label>
                                </div>
                                <div class="p-switch">
                                    <label>
                                        <input type="checkbox" name="allow_buddy_votes" value="ch" <?php if ($allow_buddy_votes == 2) {
                                            echo 'checked';
                                        } ?>>
                                        <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('After voting display info about vote in user activity stream', 'photo-contest'); ?></span></label>
                                </div>


                            </div>
                        </div>


                    <?php } else { ?>
                        <div class="form-group form-group-width">
                            <div class="p-form-sg pt-form-panel">
                                <?php _e('BuddyPress is NOT active. Activate and set BuddyPress first!', 'photo-contest'); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="text-right">
                        <input type="submit" name="submit" id="submit" class="pc-btn" value="<?php _e('Save Changes', 'photo-contest'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
