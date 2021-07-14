<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

//If contest not exist
if (empty ($related_contest)){
	wp_redirect($current_url);
}
//If is there Upload form mode
if ($related_contest->contest_mode != 1){
	wp_redirect($current_url);
}
//Hide top10
$hide_topbutton = $related_contest->hide_top;
if ($hide_topbutton == 2 and !is_super_admin() or $related_contest->hide_votes== 2  and !is_super_admin() ){
	wp_redirect($current_url);
}
//Post per Page
$post_per_page = 10;
$i = 0;

$category_meta    = 'contest-photo-category';
$category_key     = '0';
$category_compare = '>=';

if (isset($_POST['contest-category-order'])) {
	if ($_POST['contest-category-order'] != '0') {
		$category_meta    = 'contest-photo-category';
		$category_key     = $_POST['contest-category-order'];
		$category_compare = '=';
	}
}

$meta_key     = 'contest-photo-points';
if ($related_contest->vote_frequency ==6){
	$meta_key     = 'contest-photo-rate5-total';
}
if ($related_contest->vote_frequency ==7){
	$meta_key     = 'contest-photo-rate10-total';
}

	$args = array(
	'post_type'      => 'attachment',
	'posts_per_page' => $post_per_page,
	'post_status'    => 'any',
	'post_parent'    => null,
	'meta_query' => array(
	array(
		'key'     => 'contest-active',
		'value'   => '1'),
	array(
		'key'     => 'photo-related-to-contest',
		'value'   => $related_contest->id),
	array(
		'key' => $category_meta,
		'value' => $category_key,
		'compare' => $category_compare)
	),
	'meta_key'       => $meta_key,
	'orderby'        => 'meta_value_num',
	'order'          => 'DESC',
	);


	//Total images = 0
	$total_querys = get_posts($args);
	$immages = count($total_querys);

	$html = '<div class="photo-contest'.$animation.' '.$font_size.'">';
	$html .= '<div class="gallery-wrap">';

  $sql = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "photo_contest_cat WHERE related_to_contest = " . $related_contest->id . " ORDER BY id ASC");
	//Category Select Box
	if (!empty($sql)) {
		$html .= '<div class="modern-p-form p-form-modern-steelBlue">';
		$html .= '<div data-base-class="p-form" class="p-form">';
		$html .= '<form action="" method="post" id="order-by-form">';
		$html .= '<div class="form-group pc-gal-select3">';
		$html .= '<label class="input-group p-custom-arrow">';
		$html .= '<select id="contest-category-order" name="contest-category-order" class="form-control" onchange="this.form.submit()">';

		if (isset($_POST['contest-category-order'])) {
			$catid = $_POST['contest-category-order'];
		} else {
			$catid = 0;
		}
		$html .= '<option ' . (($catid == 0) ? 'selected="selected"' : "") . ' value="0">' . __('All Categories', 'photo-contest') . '</option>';

		foreach ($sql as $item) {
			$html .= '<option ' . (($item->id == $catid) ? 'selected="selected"' : "") . ' value="' . $item->id . '">' . __('Category:', 'photo-contest') . ' ' . stripslashes ($item->name) . '</option>';
		}

		$html .= '</select>';
		$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>';
		$html .= '</div>';

		$html .= '</form>';
		$html .= '</div>';
		$html .= '</div>';
	}

	if($immages == 0){
		$html .= '<div class="contest-info-bar"><i class="fa fa-exclamation-triangle"></i> ' . __('There are no photos in this category!', 'photo-contest') . '</div>';
	}else{
		$html .= '<div class="top10wrap">';
		$attachments = get_posts( $args );
		if ( $attachments ) {
			foreach ( $attachments as $contestitem ) {

				$photo_active = get_post_meta($contestitem->ID,'contest-active',true);
				$votes = get_post_meta($contestitem->ID,'contest-photo-points',true);

				//Vote-rate counts and symbols
				$vote_rate_text = __('Votes', 'photo contest');
				$vote_rate_symbol= '<i class="fa fa-heart fa-fw"></i>';
				if ($related_contest->vote_frequency ==6){
					$numberofstars=5;
					$rating_total = round(get_post_meta($contestitem->ID, 'contest-photo-rate5-total', true),1);
					$votes = $rating_total.'/'.$numberofstars;
					$vote_rate_text = __('Rating', 'photo contest');
					$vote_rate_symbol= '<i class="fa fa-star fa-fw"></i>';
				}
				if ($related_contest->vote_frequency ==7){
					$numberofstars=10;
					$rating_total = round(get_post_meta($contestitem->ID, 'contest-photo-rate10-total', true),1);
					$votes = $rating_total.'/'.$numberofstars;
					$vote_rate_text = __('Rating', 'photo contest');
					$vote_rate_symbol= '<i class="fa fa-star fa-fw"></i>';
				}//Vote-rate counts and symbols

				$author_id = get_post_meta($contestitem->ID,'contest-photo-author',true);
				$blogurl = add_query_arg( array('contest' => 'photo-detail','photo_id' => $contestitem->ID), $current_url );
				$image_attributes = wp_get_attachment_image_src( $contestitem->ID, 'thumbnail' );
				$user = get_user_by( 'id', $author_id );
				$title = $contestitem->post_title;
				$shareurl = urlencode($blogurl);
				$thmburl = wp_get_attachment_thumb_url( $contestitem->ID );
				//Load name if user is deleted or registration fail
				$photo_username = get_post_meta($contestitem->ID,'contest-user-name',true);
				if (!empty ($user)){
					$author = $user->display_name;
				}elseif (empty ($user) and !empty ($photo_username)){
					$author = $photo_username;
				}else{
					$author = __('Deleted user','photo-contest');
				}
				$i++;
				if ($i == "1"){
					$number_bg_color = "#daa520";
					$margin = "margin: 0 10px 10px 0;";
				}elseif ($i == "2"){
					$number_bg_color = "#a5a5a5";
					$margin = "margin: 0 10px 10px 0;";
				}elseif ($i == "3"){
					$number_bg_color = "#CD7F32";
					$margin = "margin: 0 10px 10px 0;";
				}else{
					$number_bg_color = "#3876c3";
					$margin = "margin: 0 10px 10px 0;";
				}

				if($photo_active!=0){
					//Hide Author
					if ($related_contest->hide_author=="2" and !is_super_admin()){
						$hide_author =  " pc_displaynone";
						$pc_marginbottom =  " pc_marginbottom";
					}else{
						$hide_author =  "";
						$pc_marginbottom =  "";
					}
					//First place box
					$html .= '<div class="firstbox" style="'.$margin.'">';
					$html .= '<div onclick="location.href=\''.$blogurl.'\'" class="firstbox_number" style="background-color:'.$number_bg_color.';">';
					$html .= $i;
					$html .= '</div>';
					$html .= '<div class="firstbox_image" onclick="location.href=\''.$blogurl.'\'">';
					$html .= '<img src="'.$image_attributes[0].'" width="102" height="102">';
					$html .= '</div>';
					$html .= '<div class="clear'.$pc_marginbottom.'""></div>';
					$html .= '<div class="firstbox_author'.$hide_author.'">';
					$html .= $author;
					$html .= '</div>';
					$html .= '<div class="firstbox_title" onclick="location.href=\''.$blogurl.'\'">';
					$html .= contest_shorter($title, 40);
					$html .= '</div>';
					$html .= '<div class="clear"></div>';
					$html .= '<div class="firstbox_count">';
					$html .= '<span>' .$vote_rate_symbol. ' '.$votes.'</span>';
					$html .= '</div>';

					if ($related_contest->hide_social=="1"){
						$html .= '<div class="firstbox_share">';
						$html .= '<a href="http://www.facebook.com/sharer.php?u='.$shareurl.'" target="_blank"><i class="fa fa-facebook-square"></i></a> ';
						$html .= '<a href="https://twitter.com/home?status='.$shareurl.'" target="_blank"><i class="fa fa-twitter-square"></i></a> ';
						$html .= '<a href="http://www.tumblr.com/share/photo?source='.urlencode($thmburl).'&caption='.$title.'&clickthru='.$shareurl.'" target="_blank" target="_blank"><i class="fa fa-tumblr-square"></i></a> ';
						$html .= '<a href="http://www.pinterest.com/pin/create/button/?url='.$shareurl.'&media='.urlencode (wp_get_attachment_url( $contestitem->ID )).'" target="_blank" target="_blank"><i class="fa fa-pinterest-square"></i></a> ';
						$html .= '<a href="http://reddit.com/submit?url='.$shareurl.'&title='.$title.'" target="_blank"><i class="fa fa-reddit-square"></i></a>';
						$html .= '</div>';
					}

					$html .= '</div>';
					//First place box end
					if ($i == "1"){
						$html .= '<div class="clear"></div>';
					}
				}
			}
		}
		$html .= '<div class="clear"></div>';
		$html .= '</div>';
	}
	$html .= '</div>';
	$html .= '</div>';  // class photo-contest end
	$html .= '<div class="clear"></div>';//important
