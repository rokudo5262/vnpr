<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}


//Define basic values

//Control date
$start  = $related_contest->contest_start;
$end    = $related_contest->contest_end;
$voting = $related_contest->contest_vote_start;
$date   = StrFTime('%m/%d/%Y', current_time('timestamp', 0));

$today_time  = strtotime($date);
$begin_time  = strtotime($start);
$expire_time = strtotime($end);
$voting_time = strtotime($voting);

$vote    = get_option('pcplugin-who-vote');
$user_ID = get_current_user_id();




	if ($expire_time < $today_time) {
        $html .= '<div class="pc-image-info-box-button-btn redb">';
	    $html .= '<div class="pc-image-info-box-button-btn-text">' . __('Contest is finished!', 'photo-contest') . '</div>';
	    $html .= '</div>';
    }

	if ($expire_time >= $today_time) {
		$dates           = strtotime($voting);
		$remaining       = $dates - current_time('timestamp', 0);
		$days_remaining  = floor($remaining / 86400);
		$hours_remaining = floor(($remaining % 86400) / 3600);
		if ($days_remaining == 1) {
			$days = __('day', 'photo-contest');
		} else {
			$days = __('days', 'photo-contest');
		}
		if ($hours_remaining == 1) {
			$hours = __('hour', 'photo-contest');
		} else {
			$hours = __('hours', 'photo-contest');
		}

		if ($vote == '1' && empty($user_ID)) {
			$html .= '<div class="pc-image-info-box-button-btn redb">';
			$html .= '<div class="pc-image-info-box-button-btn-text">' . __('You must be logged in to vote!', 'photo-contest') . '</div>';
			$html .= '</div>';
		}else{
			if ($voting_time > $today_time) {
				$html .= '<div class="pc-image-info-box-button-btn redb">';
				$html .= '<div class="pc-image-info-box-button-btn-text">' . __('Voting starts in:', 'photo-contest') . ' ' . $days_remaining . ' ' . $days . ' ' . $hours_remaining . ' ' . $hours . '</div>';
				$html .= '</div>';
			}elseif (get_current_user_id() == $author_id and get_option('pcplugin-author-vote') == 2){
				$html .= '<div class="pc-image-info-box-button-btn redb">';
				$html .= '<div class="pc-image-info-box-button-btn-text">' . __('You can\'t vote for your image!','photo-contest') . '</div>';
				$html .= '</div>';
            } else {

				//Cookie name
				$image_ID       = 'image_vote_' . $_GET['photo_id'];
				$contest_vote_ID       = 'vote_contest_id_' . $related_contest->id;

				$vote_frequency = $related_contest->vote_frequency;

				//Check if cookie match to vote_frequency (if not match cookie is set to expire)
				pc_cookiechecker($vote_frequency,$image_ID);

				$button_color = get_option('pcplugin-vote-button-color');
				$button_icon  = get_option('pcplugin-vote-icon');

				$button_text          = get_option('pcplugin-vote-text');
				$button_vote_own_text = get_option('pcplugin-vote-own-text');

				$button_vote_after_text     = get_option('pcplugin-vote-after-text');
				$button_vote_own_text_after = get_option('pcplugin-vote-own-text-after');

				$waiting_for_approval = __('The image has not been approved yet!','photo-contest');

                if (empty($button_color)) {
                    $button_color = '09F';
                }

                if ($button_icon == 1 or empty($button_icon)) {
                    $icon = '';
                } elseif ($button_icon == 2) {
                    $icon = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                } elseif ($button_icon == 3) {
                    $icon = '<i class="fa fa-heart" aria-hidden="true"></i>';
                } elseif ($button_icon == 4) {
                    $icon = '<i class="fa fa-star" aria-hidden="true"></i>';
                } elseif ($button_icon == 5) {
                    $icon = '<i class="fa fa-check" aria-hidden="true"></i>';
                } elseif ($button_icon == 6) {
                    $icon = '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
                } elseif ($button_icon == 7) {
                    $icon = '<i class="fa fa-hand-o-right" aria-hidden="true"></i>';
                } elseif ($button_icon == 8) {
                    $icon = '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>';
                }

                if ($button_text == 1) {
                    $text = '';
                } elseif ($button_text == 2 or empty($button_text)) {
                    $text = __('Vote for this photo!', 'photo-contest');
                } elseif ($button_text == 3) {
                    $text = __('Vote!', 'photo-contest');
                } elseif ($button_text == 5) {
                    $text = __('Vote Now!', 'photo-contest');
                } elseif ($button_text == 4) {
                    $text = $button_vote_own_text;
                }

                if ($button_vote_after_text == 1 or empty($button_vote_after_text)) {
                    $text_after = __('Thank you for vote!', 'photo-contest');
                } elseif ($button_vote_after_text == 2) {
                    $text_after = __('Thank You!', 'photo-contest');
                } elseif ($button_vote_after_text == 3) {
                    $text_after = $button_vote_own_text_after;
                }

				//Check if user already voted
				$user_is_in = 0;
				if (is_user_logged_in()){
					$user_ID = get_current_user_id();
					if ($related_contest->vote_frequency ==5){
					$users_ids = $related_contest->user_vote_list;
				    }else{
					$users_ids = get_post_meta($photo_id, 'contest-photo-users', true);
				    }

					$ids_array = explode(',', $users_ids);

					if (in_array($user_ID, $ids_array)) {
					$user_is_in = 1;
					}
				}

				//Check if exist ip address record
				$user_ip_is_in = 0;
				if ($related_contest->vote_frequency ==5){
					$ips = $related_contest->ip_list;
				}else{
					$ips = get_post_meta($photo_id, 'contest-photo-ip', true);
				}

				$ip_address   = explode(',', $ips);
				if (in_array($_SERVER['REMOTE_ADDR'], $ip_address)) {
				$user_ip_is_in = 1;
				}

				//Check if the image is active
				$is_image_active = get_post_meta($photo_id, 'contest-active', true);
                if ($is_image_active == 0) {
										$html .= '<div class="pc-image-info-box-button-btn greyb">';
										$html .= '<div class="pc-image-info-box-button-btn-text">' . $waiting_for_approval . '</div>';
										$html .= '</div>';
				        //If user is in array or cookie is set
                }elseif ($user_is_in == 1 or $user_ip_is_in == 1 or isset($_COOKIE[$image_ID]) and $related_contest->vote_frequency !=5 or isset($_COOKIE[$contest_vote_ID]) and $related_contest->vote_frequency ==5) {
										$html .= '<div class="pc-image-info-box-button-btn pc-showbutton" style="background-color: #' . $button_color . '">';
										$html .= '<div class="pc-image-info-box-button-btn-text">' . $icon . ' ' . $text . '</div>';
										$html .= '</div>';

 								if ($user_is_in == 1) {
									  $current_user = wp_get_current_user();
										$html .= '<div class="pc-image-info-box-button-btn redb pc-hiddenbutton" style="display:none">';
										$html .= '<div class="pc-image-info-box-button-btn-text"><i class="fa fa-exclamation-circle"></i> ' . __('You have voted already', 'photo-contest') .' ' . $current_user->display_name. '!</div>';
										$html .= '</div>';
								}elseif ($user_ip_is_in == 1) {
										$html .= '<div class="pc-image-info-box-button-btn redb pc-hiddenbutton" style="display:none">';
										$html .= '<div class="pc-image-info-box-button-btn-text"><i class="fa fa-exclamation-circle"></i> ' . __('Someone has already voted out of this IP address:', 'photo-contest'). ' ' . $_SERVER["REMOTE_ADDR"] . '</div>';
										$html .= '</div>';
								}elseif (isset($_COOKIE[$image_ID]) and $related_contest->vote_frequency !=5) {
										$html .= '<div class="pc-image-info-box-button-btn redb pc-hiddenbutton" style="display:none">';
										$html .= '<div class="pc-image-info-box-button-btn-text"><i class="fa fa-exclamation-circle"></i> ' .__('Someone voted out on this computer already!', 'photo-contest'). '</div>';
										$html .= '</div>';
								}elseif (isset($_COOKIE[$contest_vote_ID]) and $related_contest->vote_frequency ==5) {
										$html .= '<div class="pc-image-info-box-button-btn redb pc-hiddenbutton" style="display:none">';
										$html .= '<div class="pc-image-info-box-button-btn-text"><i class="fa fa-exclamation-circle"></i> ' . __('You can vote only once!', 'photo-contest'). '</div>';
										$html .= '</div>';
								}

                } else {

                    $confirm_votes  = get_option('pcplugin-confirm-votes');
				    $who_vote       = get_option('pcplugin-who-vote');

                     if ($who_vote == 2 and $confirm_votes==1 and !is_user_logged_in()) {
						$redirect_url = add_query_arg(array(
										'contest' => 'contest-share',
										'item-id' => $photo_id,
										'verify' => 'email'
										), $current_url);

						$html .= '<div class="pc-image-info-box-button-btn" style="background-color: #' . $button_color . '"  onclick="javascript:location.href=\'' . $redirect_url . '\'">';
						$html .= '<div class="pc-image-info-box-button-btn-text">' . $icon . ' ' . $text . '</div>';
						$html .= '</div>';
                    }else{
						$nonce = wp_create_nonce( 'pc-nonce' );
						$html .= '<div class="pc-image-info-box-button-btn photo_vote pc-show" style="background-color: #' . $button_color . '"   data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-share="' . $allow_redirect . '">';
						$html .= '<div class="pc-image-info-box-button-btn-text">' . $icon . ' ' . $text . '</div>';
						$html .= '</div>';

						$html .= '<div class="pc-image-info-box-button-btn pc-load" style="background-color: #' . $button_color . '">';
						$html .= '<div class="pc-image-info-box-button-btn-text"><i class="fa fa-lg fa-spinner fa-pulse"></i></div>';
						$html .= '</div>';

						$html .= '<div class="pc-image-info-box-button-btn greenb pc-hide">';
						$html .= '<div class="pc-image-info-box-button-btn-text">' . $text_after . '</div>';
						$html .= '</div>';

                    }
                }



			}//end if $voting_time > $today_time

		}
	}
