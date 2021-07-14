<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

$html .= '<div class="pc-image-info-box-button" style="position: relative;">';
//Define basic values
$photo_id = $_GET['photo_id'];

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

$vote_frequency = $related_contest->vote_frequency;


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
				$html .= '<div class="pc-image-info-box-button-btn-text">' . __('You can\'t vote for your photo!','photo-contest') . '</div>';
				$html .= '</div>';
            } else {

				//Cookie name
				$cookie_ID   = 'photo_rate_' . $_GET['photo_id'];


				$button_color = get_option('pcplugin-vote-button-color');
				$button_icon  = get_option('pcplugin-vote-icon');

				$button_text          = get_option('pcplugin-vote-text');
				$button_vote_own_text = get_option('pcplugin-vote-own-text');

				$button_vote_after_text     = get_option('pcplugin-rate-after-text');
				$button_vote_own_text_after = get_option('pcplugin-rate-own-text-after');

				$waiting_for_approval = __('The photo has not been approved yet!','photo-contest');

                if (empty($button_color)) {
                    $button_color = '09F';
                }


                if ($button_vote_after_text == 1 or empty($button_vote_after_text)) {
                    $text_after = __('Thank you!', 'photo-contest');
                } elseif ($button_vote_after_text == 3) {
									if (!empty($button_vote_own_text_after)){
                    $text_after = $button_vote_own_text_after;
									}else{
                    $text_after = __('Thank you!', 'photo-contest');
									}
                }

        //Check if user already voted
        $user_is_in = 0;
        if (is_user_logged_in()){
          $user_ID = get_current_user_id();
          $users_ids = get_post_meta($photo_id, 'contest-photo-users', true);

          $ids_array = explode(',', $users_ids);

          if (in_array($user_ID, $ids_array)) {
            $user_is_in = 1;
          }
        }

				//Check if exist ip address record
				$user_ip_is_in = 0;
				$ips = get_post_meta($photo_id, 'contest-photo-ip', true);
				$ip_address   = explode(',', $ips);
				if (in_array($_SERVER['REMOTE_ADDR'], $ip_address)) {
				$user_ip_is_in = 1;
				}

				//Check if the contest is active
				$is_image_active = get_post_meta($photo_id, 'contest-active', true);
                if ($is_image_active == 0) {
										$html .= '<div class="pc-image-info-box-button-btn greyb">';
										$html .= '<div class="pc-image-info-box-button-btn-text">' . $waiting_for_approval . '</div>';
										$html .= '</div>';
				        //If user is in array or cookie is set
              }elseif ($user_is_in == 1 or $user_ip_is_in == 1 or isset($_COOKIE[$cookie_ID])) {
										$html .= '<div class="pc-image-info-box-button-btn-r pc-showbutton" style="background-color: #' . $button_color . '">';

										$html .= '<div class="rc-rating">';

										if ($vote_frequency ==7){
											$html .= '<span class="rc-rating-star" data-value="10"></span>';
											$html .= '<span class="rc-rating-star" data-value="9"></span>';
											$html .= '<span class="rc-rating-star" data-value="8"></span>';
											$html .= '<span class="rc-rating-star" data-value="7"></span>';
											$html .= '<span class="rc-rating-star" data-value="6"></span>';
										}

										$html .= '<span class="rc-rating-star" data-value="5"></span>';
										$html .= '<span class="rc-rating-star" data-value="4"></span>';
										$html .= '<span class="rc-rating-star" data-value="3"></span>';
										$html .= '<span class="rc-rating-star" data-value="2"></span>';
										$html .= '<span class="rc-rating-star" data-value="1"></span>';

										$html .= '</div>';//rc-rating


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
								}elseif (isset($_COOKIE[$cookie_ID])) {
										$html .= '<div class="pc-image-info-box-button-btn redb pc-hiddenbutton" style="display:none">';
										$html .= '<div class="pc-image-info-box-button-btn-text"><i class="fa fa-exclamation-circle"></i> ' .__('Someone voted out on this computer already!', 'photo-contest'). '</div>';
										$html .= '</div>';
								}

                } else {

						$confirm_votes  = get_option('pcplugin-confirm-votes');

						$nonce = wp_create_nonce( 'pc-nonce' );

						$html .= '<div class="pc-image-info-box-button-btn-r pc-show" style="background-color: #' . $button_color . '">';

						$html .= '<div class="rc-rating">';

						if ($vote_frequency ==7){
							$html .= '<span class="rc-rating-star rate_vote" data-value="10" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';
							$html .= '<span class="rc-rating-star rate_vote" data-value="9" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';
							$html .= '<span class="rc-rating-star rate_vote" data-value="8" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';
							$html .= '<span class="rc-rating-star rate_vote" data-value="7" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';
							$html .= '<span class="rc-rating-star rate_vote" data-value="6" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';
						}

						$html .= '<span class="rc-rating-star rate_vote" data-value="5" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';
						$html .= '<span class="rc-rating-star rate_vote" data-value="4" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';
						$html .= '<span class="rc-rating-star rate_vote" data-value="3" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';
						$html .= '<span class="rc-rating-star rate_vote" data-value="2" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';
						$html .= '<span class="rc-rating-star rate_vote" data-value="1" data-item="' . $photo_id . '" data-nonce="' .$nonce. '" data-option="rate"></span>';

						$html .= '</div>';//rc-rating


						$html .= '</div>';

						$html .= '<div class="pc-image-info-box-button-btn pc-load" style="background-color: #' . $button_color . '">';
						$html .= '<div class="pc-image-info-box-button-btn-text"><i class="fa fa-lg fa-spinner fa-pulse"></i></div>';
						$html .= '</div>';

						$html .= '<div class="pc-image-info-box-button-btn greenb pc-hide">';
						$html .= '<div class="pc-image-info-box-button-btn-text">' . $text_after . '</div>';
						$html .= '</div>';


                }


			}//end if $voting_time > $today_time

		}
	}


	$html .= '</div>'; //pc-image-info-box-button
