<?php

//Secure file from direct access
if (!defined('WPINC')) {
    die;
}

//Reset the contest and all data about contest and images from this contest
function pc_delete_the_image($image_id)
{
    if (current_user_can('manage_options')) {

        $related_to_contest = get_post_meta($image_id, 'photo-related-to-contest', true);
        $author_id = get_post_meta($image_id, 'contest-photo-author', true);

        delete_post_meta($image_id, 'contest-active');
        delete_post_meta($image_id, 'contest-photo-points');
        delete_post_meta($image_id, 'contest-photo-category');
        delete_post_meta($image_id, 'post_views_count');
        delete_post_meta($image_id, 'contest-photo-ip');
        delete_post_meta($image_id, 'contest-user-name');
        delete_post_meta($image_id, 'contest-user-email');
        delete_post_meta($image_id, 'contest-photo-users');
        delete_post_meta($image_id, 'photo-upload-ip');
        delete_post_meta($image_id, 'camera-model');
        delete_post_meta($image_id, 'custom-field');
        delete_post_meta($image_id, 'contest-photo-emails');
        delete_post_meta($image_id, 'image-country');
        delete_post_meta($image_id, 'contest-photo-author');
        delete_post_meta($image_id, 'photo-related-to-contest');
        //Version 4.1
        delete_post_meta($image_id, 'contest-photo-rate5');
        delete_post_meta($image_id, 'contest-photo-rate10');
        delete_post_meta($image_id, 'contest-photo-rate5-total');
        delete_post_meta($image_id, 'contest-photo-rate10-total');

        $user = get_userdata($author_id);
        if ($user === false) {
            //user id does not exist
        } else {
            $contest_user_images = 'contest_user_images_' . $related_to_contest;
            $number_images = get_user_meta($author_id, $contest_user_images, true);
            $number_images = $number_images - 1;
            update_user_meta($author_id, 'contest_user_images_' . $related_to_contest, $number_images);
        }

    }
}

//Reset the contest and all data about contest and images from this contest
function pc_approval_notification($item_id)
{
    global $wpdb;
    $subject = get_option('pcplugin-image-approval-email-subject');
    $body = get_option('pcplugin-image-approval-email-body');
    $contest_id = get_post_meta($item_id, 'photo-related-to-contest', true);
    $author_id = get_post_meta($item_id, 'contest-photo-author', true);
    $user = get_user_by('ID', $author_id);
    $related_contest = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "photo_contest_list WHERE id = " . $contest_id);
    $contest_url = get_permalink($related_contest->page_id);

    $message = str_replace("{CONTEST-URL}", $contest_url, stripslashes($body));
    $message = str_replace("{CONTEST-NAME}", stripslashes($related_contest->contest_name), $message);
    $message = str_replace("{PHOTO-NAME}", stripslashes(get_the_title($item_id)), $message);

    $to = $user->user_email;

    $headers = [
        'Content-Type: text/html; charset=UTF-8'
    ];

    wp_mail($to, $subject, $message, $headers);
}

function pc_editor_style($url)
{

    if (!empty($url))
        $url .= ',';

    // Change the path here if using sub-directory
    $url .= plugins_url() . '/photo-contest/css/tinymce-style.css';

    return $url;

}

add_filter('mce_css', 'pc_editor_style');


add_action('media_buttons', 'add_photo_contest_tinymce_media_button');
function add_photo_contest_tinymce_media_button($context)
{

    if (isset($_GET['page']) && $_GET['page'] == 'photo-contest-contests') {
        return $context;
    } elseif (isset ($_GET['post_type'])) {
        if ($_GET['post_type'] == 'page') {
            return $context .= '<a  class="button" id="id_of_button_clicked" title="' . __('Add Photo Contest Shorcode', 'photo-contest') . '" style="display:inline-block">' . __('Add Photo Contest', 'photo-contest') . '</a>';
        }
    } elseif (isset($_GET['post'])) {
        if (get_post_type($_GET['post']) == 'page') {
            return $context .= '<a  class="button" id="id_of_button_clicked" title="' . __('Add Photo Contest Shorcode', 'photo-contest') . '" style="display:inline-block">' . __('Add Photo Contest', 'photo-contest') . '</a>';
        }
    } else {
        return $context;
    }

}

//javascript code needed to make shortcode appear in TinyMCE edtor
add_action('admin_footer', 'photo_contest_shortcode_add_shortcode_to_editor');
function photo_contest_shortcode_add_shortcode_to_editor()
{
    ?>
    <script>
        jQuery('#id_of_button_clicked ').on('click', function () {
            var shortcode = '[contest-menu]' + '[contest-page]';
            if (!tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
                jQuery('textarea#content').val(shortcode);
            } else {
                tinyMCE.execCommand('mceInsertContent', false, shortcode);
            }

        });
    </script>
    <?php
}


//Gutenberg function
function gutenberg_photocontest_block()
{

    if (function_exists('register_block_type')) {

        wp_register_script(
            'gutenberg-photocontest',
            plugins_url('../js/block.js', __DIR__),
            ['wp-blocks', 'wp-element']
        );

        register_block_type('photo-contest/block', [
            'editor_script' => 'gutenberg-photocontest',
        ]);
    }
}

add_action('init', 'gutenberg_photocontest_block');
