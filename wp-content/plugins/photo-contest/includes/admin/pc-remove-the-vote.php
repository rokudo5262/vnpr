<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
die;
}

function remove_the_vote($voteID,$removed_from,$removed_value){
  global $wpdb;

  $points = $points = get_post_meta($removed_from, 'contest-photo-points', true);
  if ($points>0){
    $points = $points-1;
    update_post_meta($removed_from, 'contest-photo-points', $points);
  }
  $wpdb->update(
         $wpdb->prefix.'photo_contest_votes',
          array(
            'remove_vote' => 2,	// string
               ),
          array( 'id' => $voteID )
               );

}

function remove_the_rate_10($voteID,$removed_from,$removed_value){

  global $wpdb;

  $removed_value = str_replace('d', '', $removed_value);

  $points = get_post_meta($removed_from, 'contest-photo-rate10', true);

  $v_ar = explode(',', $points);
  if ($removed_value==1){$v_ar[0]=$v_ar[0]-1;}
  if ($removed_value==2){$v_ar[1]=$v_ar[1]-1;}
  if ($removed_value==3){$v_ar[2]=$v_ar[2]-1;}
  if ($removed_value==4){$v_ar[3]=$v_ar[3]-1;}
  if ($removed_value==5){$v_ar[4]=$v_ar[4]-1;}
  if ($removed_value==6){$v_ar[5]=$v_ar[5]-1;}
  if ($removed_value==7){$v_ar[6]=$v_ar[6]-1;}
  if ($removed_value==8){$v_ar[7]=$v_ar[7]-1;}
  if ($removed_value==9){$v_ar[8]=$v_ar[8]-1;}
  if ($removed_value==10){$v_ar[9]=$v_ar[9]-1;}
  $list_of_values= $v_ar[0].','.$v_ar[1].','.$v_ar[2].','.$v_ar[3].','.$v_ar[4].','.$v_ar[5].','.$v_ar[6].','.$v_ar[7].','.$v_ar[8].','.$v_ar[9];
  if ($list_of_values=='0,0,0,0,0,0,0,0,0,0'){$list_of_values='0';}
  update_post_meta($removed_from, 'contest-photo-rate10', $list_of_values);
  $rating_total_value= $v_ar[0]*1+$v_ar[1]*2+$v_ar[2]*3+$v_ar[3]*4+$v_ar[4]*5+$v_ar[5]*6+$v_ar[6]*7+$v_ar[7]*8+$v_ar[8]*9+$v_ar[9]*10;
  $rating_total_count= $v_ar[0]+$v_ar[1]+$v_ar[2]+$v_ar[3]+$v_ar[4]+$v_ar[5]+$v_ar[6]+$v_ar[7]+$v_ar[8]+$v_ar[9];
  if (!empty($rating_total_value)){
       $rate_value = $rating_total_value/$rating_total_count;
  }else{
       $rate_value = "0";
  }
  update_post_meta($removed_from, 'contest-photo-rate10-total', $rate_value);

  $wpdb->update(
         $wpdb->prefix.'photo_contest_votes',
          array(
            'remove_vote' => 2,	// string
               ),
          array( 'id' => $voteID )
               );
  }

function remove_the_rate_5($voteID,$removed_from,$removed_value){

  global $wpdb;

  $removed_value = str_replace('r', '', $removed_value);

  $points = get_post_meta($removed_from, 'contest-photo-rate5', true);

  $v_ar = explode(',', $points);
  if ($removed_value==1){$v_ar[0]=$v_ar[0]-1;}
  if ($removed_value==2){$v_ar[1]=$v_ar[1]-1;}
  if ($removed_value==3){$v_ar[2]=$v_ar[2]-1;}
  if ($removed_value==4){$v_ar[3]=$v_ar[3]-1;}
  if ($removed_value==5){$v_ar[4]=$v_ar[4]-1;}
  $list_of_values= $v_ar[0].','.$v_ar[1].','.$v_ar[2].','.$v_ar[3].','.$v_ar[4];
  if ($list_of_values=='0,0,0,0,0'){$list_of_values='0';}
  update_post_meta($removed_from, 'contest-photo-rate5', $list_of_values);
  $rating_total_value= $v_ar[0]*1+$v_ar[1]*2+$v_ar[2]*3+$v_ar[3]*4+$v_ar[4]*5;
  $rating_total_count= $v_ar[0]+$v_ar[1]+$v_ar[2]+$v_ar[3]+$v_ar[4];
  if (!empty($rating_total_value)){
       $rate_value = $rating_total_value/$rating_total_count;
  }else{
       $rate_value = "0";
  }
  update_post_meta($removed_from, 'contest-photo-rate5-total', $rate_value);

  $wpdb->update(
         $wpdb->prefix.'photo_contest_votes',
          array(
            'remove_vote' => 2,	// string
               ),
          array( 'id' => $voteID )
               );
}
