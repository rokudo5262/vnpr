<?php
/**
 * @package   Photo Contest WordPress Plugin
 * @author    Zbyněk Hovorka
 * @link      http://www.contest.w4y.cz/
 * @copyright 2014 Zbyněk Hovorka
 */

if (!defined('WPINC')) {
    die;
}
function pc_loginform($contest_mode)
{

    $redirect = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $allow_reCaptcha = get_option('pcplugin-allow-reCaptcha');
    $site_key = get_option('pcplugin-site-key');
    $login_form = get_option('pcplugin-login-form');
    $login_form_input = get_option('pcplugin-login-form-input');


    $loginform = '<div class="contest-loginform-box">';

    if ($allow_reCaptcha != 2 && $site_key) {
        $loginform .= '<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
			<script>
				var recaptcha1;
				var recaptcha2;
				var myCallBack = function() {
				//Render the recaptcha1 on the element with ID "recaptcha1"
				recaptcha1 = grecaptcha.render(\'recaptcha1\', {
					\'sitekey\' : \'' . $site_key . '\', //Replace this with your Site key
					\'theme\' : \'light\',
					\'callback\' : \'enableBtn2\'
				});

				//Render the recaptcha2 on the element with ID "recaptcha2"
				recaptcha2 = grecaptcha.render(\'recaptcha2\', {
					\'sitekey\' : \'' . $site_key . '\', //Replace this with your Site key
					\'theme\' : \'light\',
					\'callback\' : \'enableBtn\'
				});
				};
			</script>';
    }

    if ($login_form == 1 or empty($login_form)) {
        $loginform .= '<div class="modern-p-form p-form-modern-slateGray form-white-back">';
        $loginform .= '<div data-base-class="p-form" class="p-form">';

        if (function_exists('wsl_render_auth_widget')) {

            $loginform .= '<div class="pc-social-wiget">';
            $loginform .= wsl_render_auth_widget();
            $loginform .= '</div>';
            $loginform .= '<div class="clear"></div>';
        }
        if (function_exists('oa_social_login_render_login_form') and !is_user_logged_in()) {
            $loginform .= '<div class="pc-social-wiget">';
            $loginform .= oa_social_login_render_login_form('shortcode');
            $loginform .= '</div>';
            $loginform .= '<div class="clear"></div>';
        }

        //LOGIN
        $loginform .= '<div class="halfform">';
        $loginform .= '<form name="loginform" id="loginform" action="' . wp_login_url($redirect) . '" method="post">';
        $loginform .= '<div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side">' . __('Log In', 'photo-contest') . '</span></div>';

        //Username
        $loginform .= '<div class="form-group">';
        $loginform .= '<label for="log" class="p-label-required">' . __('Username:', 'photo-contest') . '</label>';
        $loginform .= '<div class="input-group p-has-icon">';
        $loginform .= '<input type="text" name="log" id="user_login" placeholder="' . __('Username:', 'photo-contest') . '" required class="form-control">';
        $loginform .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-user-o" aria-hidden="true"></i></span></div>';
        $loginform .= '</div>';

        //Password
        $loginform .= '<div class="form-group">';
        $loginform .= '<label for="pwd" class="p-label-required">' . __('Password:', 'photo-contest') . '</label>';
        $loginform .= '<div class="input-group p-has-icon">';
        $loginform .= '<input type="password" name="pwd" id="user_pass" placeholder="' . __('Password:', 'photo-contest') . '" required class="form-control">';
        $loginform .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-lock" aria-hidden="true"></i></span></div>';
        $loginform .= '</div>';

        //Remember Me
        $loginform .= '<div class="form-group">';
        $loginform .= '<div class="checkbox">';
        $loginform .= '<label>';
        $loginform .= '<input type="checkbox" name="rememberme" id="rememberme" value="forever">';
        $loginform .= '<span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">' . __('Remember Me', 'photo-contest') . '</span></label>';
        $loginform .= '</div>';
        $loginform .= '</div>';

        //reCaptcha
        if ($allow_reCaptcha != 2 && $site_key) {
            $loginform .= '<div id="recaptcha1"></div>';
            $loginform .= "<script type='text/javascript'>
				function enableBtn2(){
				document.getElementById('wp-submit2').disabled = false;
				}
				</script>
				";
            $loginform .= '<div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit" name="wp-submit2" id="wp-submit2" disabled="disabled">' . __('Log In', 'photo-contest') . '</button></div>';
        } else {
            $loginform .= '<div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit" name="wp-submit2" id="wp-submit2">' . __('Log In', 'photo-contest') . '</button></div>';
        }

        //Security and other fields
        $loginform .= '<div><input name="redirect_to" value="' . $redirect . '" type="hidden"></div>';
        $loginform .= wp_nonce_field();
        $loginform .= '<div class="clear"></div>';
        $loginform .= '</form>';
        $loginform .= '</div>';

        $loginform .= '<div class="formbreak"></div>';

        //REGISTER
        $loginform .= '<div class="halfform pc-lev-pad">';

        $redirect = $redirect . '&registration=success';
        $loginform .= '<form name="registerform" id="registerform" action="' . wp_registration_url() . '" method="post">';
        $loginform .= '<div><input name="redirect_to" value="' . $redirect . '" type="hidden"></div>';
        $loginform .= '<div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side">' . __('Register', 'photo-contest') . '</span></div>';

        //Username
        $loginform .= '<div class="form-group">';
        $loginform .= '<label for="username" class="p-label-required">' . __('Username:', 'photo-contest') . '</label>';
        $loginform .= '<div class="input-group p-has-icon">';
        $loginform .= '<input type="text" name="user_login" id="user_login2" placeholder="' . __('Username:', 'photo-contest') . '" required class="form-control">';
        $loginform .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-user-o" aria-hidden="true"></i></span></div>';
        $loginform .= '</div>';

        //Email
        $loginform .= '<div class="form-group">';
        $loginform .= '<label for="email" class="p-label-required">' . __('Email:', 'photo-contest') . '</label>';
        $loginform .= '<div class="input-group p-has-icon">';
        $loginform .= '<input type="text" name="user_email" id="user_email2" placeholder="' . __('Email:', 'photo-contest') . '" required class="form-control">';
        $loginform .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-at" aria-hidden="true"></i></span></div>';
        $loginform .= '</div>';

        //lost password
        $loginform .= '<div class="form-group">';
        $loginform .= '<div class="pc-lostpwd">';
        $loginform .= '<label style="padding-top:7px; display:block; height:24px;">';
        $loginform .= '<a href="' . wp_lostpassword_url($redirect) . '" title="' . __('Lost Password', 'photo-contest') . '"><i class="fa fa-lock" aria-hidden="true"></i> ' . __('Lost Password', 'photo-contest') . '</a>';
        $loginform .= '</label>';
        $loginform .= '</div>';
        $loginform .= '</div>';

        //reCaptcha
        if ($allow_reCaptcha != 2 && $site_key) {
            $loginform .= '<div id="recaptcha2"></div>';
            $loginform .= "<script type='text/javascript'>
				function enableBtn(){
				document.getElementById('wp-submit').disabled = false;
				}
				</script>
				";
            $loginform .= '<div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit" name="wp-submit" id="wp-submit" disabled="disabled">' . __('Register', 'photo-contest') . '</button></div>';
        } else {
            $loginform .= '<div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit" name="wp-submit" id="wp-submit">' . __('Register', 'photo-contest') . '</button></div>';
        }


        $loginform .= '<div class="clear"></div>';

        $loginform .= '</form>';

        $loginform .= '</div>';
        $loginform .= '<div class="clear"></div>';

        $loginform .= '</div>';
        $loginform .= '</div>';

    }

    //Own shortcode
    if ($login_form == 2) {
        $loginform .= '<div class="ug-shortcode-form">';
        $loginform .= do_shortcode($login_form_input);
        $loginform .= '</div>';
    }

    $loginform .= '</div>';


    return $loginform;
}
