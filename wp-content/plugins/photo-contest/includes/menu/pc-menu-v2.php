<?php

$html .= '<ul id="pcmenu" class="pcmenu full-width' . $color_class . '' . $style_class . '">';
        $html .= $menu_open_value;
        $html .= $menu_open_value2;
        if ($related_contest->contest_mode == 1) {
            if (isset($_GET['contest']) && $_GET['contest'] == "gallery") {
                $html .= '<li class="active cmenuvisible"><a href="' . $gallery_url . '">' . $vote_menu_gallery . '</a></li>';
				$html .= '<li class="active cmenuhidden"><a href="' . $gallery_url . '"><i class="fa fa-home"></i></a></li>';
            } else {
                $html .= '<li class="cmenuvisible"><a href="' . $gallery_url . '">' . $vote_menu_gallery . '</a></li>';
				$html .= '<li class="cmenuhidden"><a href="' . $gallery_url . '"><i class="fa fa-home"></i></a></li>';
            }
        }
        if ($related_contest->hide_up == 1 or empty($related_contest->hide_up)) {
            if (isset($_GET['contest']) && $_GET['contest'] == "upload-photo") {
                $html .= '<li class="active"><a href="' . $upload_url . '">' . $vote_menu_upload . '</a></li>';
            } else {
                $html .= '<li><a href="' . $upload_url . '">' . $vote_menu_upload . '</a></li>';
            }
        } else {
            if (is_super_admin()) {
                if (isset($_GET['contest']) && $_GET['contest'] == "upload-photo") {
                    $html .= '<li class="active"><a href="' . $upload_url . '">' . $vote_menu_upload . ' <i class="fa fa-ban rightside" aria-hidden="true"></i></a></li>';
                } else {
                    $html .= '<li><a href="' . $upload_url . '">' . $vote_menu_upload . ' <i class="fa fa-ban rightside" aria-hidden="true"></i></a></li>';
                }
            }
        }

        if ($related_contest->hide_rules == 1 or empty($related_contest->hide_rules)) {
            if (isset($_GET['contest']) && $_GET['contest'] == "contest-condition") {
                $html .= '<li class="active"><a href="' . $condition_url . '">' . $vote_menu_rules . '</a></li>';
            } else {
                $html .= '<li><a href="' . $condition_url . '">' . $vote_menu_rules . '</a></li>';
            }
        } else {
            if (is_super_admin()) {
                if (isset($_GET['contest']) && $_GET['contest'] == "contest-condition") {
                    $html .= '<li class="active"><a href="' . $condition_url . '">' . $vote_menu_rules . ' <i class="fa fa-ban rightside" aria-hidden="true"></i></a></li>';
                } else {
                    $html .= '<li><a href="' . $condition_url . '">' . $vote_menu_rules . ' <i class="fa fa-ban rightside" aria-hidden="true"></i></a></li>';
                }
            }
        }
        if ($related_contest->contest_mode == 1) {
            if ($begin_time <= $today_time) {
                if ($related_contest->hide_your == 1 or empty($related_contest->hide_your)) {
                    if (isset($_GET['contest']) && $_GET['contest'] == "contest-profile") {
                        $html .= '<li class="active"><a href="' . $profile_url . '">' . $vote_menu_your_images . '</a></li>';
                    } else {
                        $html .= '<li><a href="' . $profile_url . '">' . $vote_menu_your_images . '</a></li>';
                    }
                } else {
                    if (is_super_admin()) {
                        if (isset($_GET['contest']) && $_GET['contest'] == "contest-profile") {
                            $html .= '<li class="active"><a href="' . $profile_url . '">' . $vote_menu_your_images . ' <i class="fa fa-ban rightside" aria-hidden="true"></i></a></li>';
                        } else {
                            $html .= '<li><a href="' . $profile_url . '">' . $vote_menu_your_images . ' <i class="fa fa-ban rightside" aria-hidden="true"></i></a></li>';
                        }
                    }
                }
            }
        }
        if ($related_contest->contest_mode == 1) {
            if ($voting_time <= $today_time) {

                $args            = array(
                    'post_type' => 'attachment',
                    'post_status' => 'any',
                    'post_parent' => null,
                    'meta_key' => 'photo-related-to-contest',
                    'meta_value' => $related_contest->id,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key' => 'contest-active',
                            'value' => '1'
                        )
                    )
                );

                $attachments = get_posts($args);

                if (!empty($attachments)) {

                    if ($related_contest->hide_top == 1 and $related_contest->hide_votes == 1) {
                        if (isset($_GET['contest']) && $_GET['contest'] == "contest-top10") {
                            $html .= '<li class="active"><a href="' . $rank_url . '">' . $vote_menu_top10 . '</a></li>';
                        } else {
                            $html .= '<li><a href="' . $rank_url . '">' . $vote_menu_top10 . '</a></li>';
                        }
                    } else {
                        if (is_super_admin()) {
                            if (isset($_GET['contest']) && $_GET['contest'] == "contest-top10") {
                                $html .= '<li class="active"><a href="' . $rank_url . '">' . $vote_menu_top10 . ' <i class="fa fa-ban rightside" aria-hidden="true"></i></a></li>';
                            } else {
                                $html .= '<li><a href="' . $rank_url . '">' . $vote_menu_top10 . ' <i class="fa fa-ban rightside" aria-hidden="true"></i></a></li>';
                            }
                        }
                    }
                }

            }

        }

        //Edit Section for Admins
        global $current_user;
        if (!empty($current_user->roles)) {
            foreach ($current_user->roles as $key => $value) {
                if ($value == 'administrator') {

                    $html .= '<li class="pc-last"><a href="' . get_site_url() . '/wp-admin/admin.php?page=photo-contest-contests&edit=' . $related_contest->id . '">' . __('Edit', 'photo-contest') . '</a></li>';
                }
            }
        }
		//Login button
		if ($related_contest->contest_mode == 1 and $related_contest->hide_login == 1) {
            $allow_login_button = get_option('pcplugin-allow-login-button');
            if ($allow_login_button == 1 or empty($allow_login_button)) {
                if (!is_user_logged_in()) {
                        $html .= '<li class="pc-last"><a href="' . $profile_url . '">'.__('Log in', 'photo-contest').'</a></li>';
                        } else {
                        $html .= '<li class="pc-last"><a href="' . wp_logout_url( get_permalink() ) . '">'.__('Log out', 'photo-contest').'</a></li>';
                }
            }
        }
        $html .= '</ul>';
