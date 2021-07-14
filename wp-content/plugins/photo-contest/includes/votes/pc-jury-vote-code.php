<?php
	//Secure file from direct access
	 if ( ! defined( 'WPINC' ) ) {
		die;
	 }
	$user_ID = get_current_user_id();
	$jury_votes = $related_contest->jury_votes;
	$points = get_user_meta($user_ID, 'jury_member_votes_'.$related_contest->id, true);

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

	if ($related_contest->jury == "2" and $jury_member == 1 and $user_is_in == 1){
	 $html .= '<div class="pc-image-info-box-button-btn3">';
	 $html .= '<div class="pc-image-info-box-button-btn-text jury_vote_undo" data-item="' . $photo_id . '" data-option="jury_undo">' . __('Remove the vote!', 'photo-contest') . '</div>';
	 $html .= '</div>';
	}else{
	 $html .= '<div class="pc-image-info-box-button-btn2">';
	 $html .= '<div class="pc-image-info-box-button-btn-text" style="cursor:	auto">' . __('You are member of the jury. You can vote!', 'photo-contest') . '</div>';
	 $html .= '</div>';
  }


    //Control date
    $start  = $related_contest->contest_start;
    $end    = $related_contest->contest_end;
    $voting = $related_contest->contest_vote_start;
    $date   = StrFTime('%m/%d/%Y', current_time('timestamp', 0));

    $today_time  = strtotime($date);
    $begin_time  = strtotime($start);
    $expire_time = strtotime($end);
    $voting_time = strtotime($voting);
    //Check end date
    if ($expire_time < $today_time) {
        $html .= '<div class="pc-image-info-box-button-btn redb">';
	    $html .= '<div class="pc-image-info-box-button-btn-text">' . __('Contest is finished!', 'photo-contest') . '</div>';
	    $html .= '</div>';
    } else {

        //Check who can vote
        $vote    = get_option('pcplugin-who-vote');
		if ($voting_time > $today_time) {
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
			$html .= '<div class="pc-image-info-box-button-btn redb">';
			$html .= '<div class="pc-image-info-box-button-btn-text">' . __('Voting starts in:', 'photo-contest') . ' ' . $days_remaining . ' ' . $days . ' ' . $hours_remaining . ' ' . $hours . '</div>';
			$html .= '</div>';
		}elseif (get_current_user_id() == $author_id and get_option('pcplugin-author-vote') == 2){

			$html .= '<div class="pc-image-info-box-button-btn redb">';
			$html .= '<div class="pc-image-info-box-button-btn-text">' . __('You can\'t vote for your image!','photo-contest') . '</div>';
			$html .= '</div>';

		}else{

			$button_color = get_option('pcplugin-vote-button-color');
			$button_icon  = get_option('pcplugin-vote-icon');

			$button_text          = get_option('pcplugin-vote-text');
			$button_vote_own_text = get_option('pcplugin-vote-own-text');

			$button_vote_after_text     = get_option('pcplugin-vote-after-text');
			$button_vote_own_text_after = get_option('pcplugin-vote-own-text-after');

			if (empty($button_color)) {
				$button_color = '09F';
			}


			//If user is in array or cookie is set
			if ($user_is_in == 1 and $points < $jury_votes) {
				$html .= '<div class="pc-image-info-box-button-btn greenb">';
				$html .= '<div class="pc-image-info-box-button-btn-text">' . __('You have voted for this image!', 'photo-contest') . '</div>';
				$html .= '</div>';
			}elseif ($points >= $jury_votes) {
				$html .= '<div class="pc-image-info-box-button-btn redb">';
				$html .= '<div class="pc-image-info-box-button-btn-text">' . __('You cannot vote anymore!', 'photo-contest') . '</div>';
				$html .= '</div>';
			} else {
				$html .= '<div class="pc-image-info-box-button-btn jury_vote" style="background-color: #' . $button_color . '" data-item="' . $photo_id . '" data-option="jury">';
				$html .= '<div class="pc-image-info-box-button-btn-text">' . __('Vote!', 'photo-contest') . '</div>';
				$html .= '</div>';
			}
		}

    }


	if ($jury_votes == 1){
		$votes_count = "vote";
	}else{
		$votes_count = "votes";
	}
	if (empty($points)){
		$points = "0";
	}



	$html .= '<div class="pc-jury-info-box"><strong>'. sprintf(__('You have %s %s as Jury member. You have already voted %sx.', 'photo-contest'), $jury_votes, $votes_count, $points).'</strong>';
	$html .= '<br>';

	         //users who votes
            if( current_user_can('administrator') ) {
			  $html .= '<div>'.__('Jury member who voted for this image (for admins eyes only)', 'photo-contest').'</div>';
		      $users_ids = get_post_meta($photo_id, 'contest-photo-users', true);


				if (!empty ($users_ids)){
					$html .= '<div class="pc-users-list">';
					$users_array = explode(',', $users_ids);
					foreach ($users_array as $member_id) {

					   if (is_numeric($member_id)) {

						   $user = get_userdata( $member_id );
						   if ( $user === false ) {
						   $html .= '<span style="color:red">'.__('Invalid ID', 'photo-contest').'('.$member_id.')(Deleted User maybe)</span>, ';
						   } else {
						   $member = get_user_by( 'ID', $member_id );

						   $html .= '<span><strong>'.$member->nickname.'</strong> ('.$member_id.')</span>, ';
						  }
					   }
				    }
					$html .= '</div>';
				}else{
					$html .= '<div class="pc-users-list" ><strong>'.__('List is empty', 'photo-contest').'</strong></div>';
				}

		   }//users who votes

	$html .= '</div>';
