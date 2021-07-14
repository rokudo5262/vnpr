<?php
//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}
include(plugin_dir_path( __DIR__ )."includes/pc-gallery-functions.php");


//Check if exist contest on this page
$current_page_id = get_the_ID();

//Create contest if not exist
if (empty($related_contest)) {
	include(plugin_dir_path( __DIR__ )."includes/pc-create-contest.php");
	$html = pc_insert_contest($current_page_id);
	$html .= pc_create_contest();
} else {
	$columns_number  = $related_contest->contest_columns;
	$lines_number    = $related_contest->contest_rows;
	$post_per_page   = $columns_number * $lines_number;

	$start  = $related_contest->contest_start;
	$end    = $related_contest->contest_end;
	$voting = $related_contest->contest_vote_start;
	$date   = StrFTime('%m/%d/%Y', current_time('timestamp', 0));

	$today_time  = strtotime($date);
	$begin_time  = strtotime($start);
	$expire_time = strtotime($end);
	$voting_time = strtotime($voting);


//Hide Views
if ($related_contest->hide_views == "2" and !is_super_admin()) {
  $hide_views = " pc_displaynone";
} else {
  $hide_views = " pc_visible";
}

$html = '<div class="photo-contest' . $animation . ' ' . $font_size . '">';

$html .= '<style media="screen" type="text/css">
						.pcmodern:hover{
							background-color:' . $related_contest->gallery_layout_color . ';
						}
						.pc-modern-button a, .pc-modern-button {
							color:' . $related_contest->gallery_layout_color . ' !important;
						}
						.classic .imagebox:hover{
							background-color:' . $related_contest->gallery_layout_color . ';
						}
		    </style>';


global $paged;
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} else if (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

if(isset($_GET['contest-search'])){
	$search_term = $_GET['contest-search'];
}else{
	$search_term = "";
}

if (isset($_GET['author-id'])) {
  $author_author = $_GET['author-id'];
} else {
  $author_author = "any";
}

//Get primary gallery order
$gallery_order = $related_contest->gallery_order;

//If all get empty

if ($gallery_order==1 or empty($gallery_order)){
   $orderby = 'post_date';
}elseif ($gallery_order==2){
   $orderby = 'rand';
}

$order   = 'DESC';

$meta_key     = 'contest-photo-author';
$meta_value   = '0';
$meta_compare = '!=';

$category_meta    = 'contest-photo-category';
$category_key     = '0';
$category_compare = '>=';

if (isset($_GET['contest-category-order'])) {
  if ($_GET['contest-category-order'] != '0') {
	  $category_meta    = 'contest-photo-category';
	  $category_key     = $_GET['contest-category-order'];
	  $category_compare = '=';
  }
}

if (isset($_GET['contest-gallery-order'])) {
	if ($_GET['contest-gallery-order'] == 'date-down') {
		$orderby = 'post_date';
		$order   = 'DESC';
	}
	if ($_GET['contest-gallery-order'] == 'date-up') {
		$orderby = 'post_date';
	  $order = 'ASC';
	}
	if ($_GET['contest-gallery-order'] == 'random') {
	  $orderby = 'rand';
	}
	if ($_GET['contest-gallery-order'] == 'points-down') {
	  $orderby      = 'meta_value_num';
	  $meta_key     = 'contest-photo-points';
		if ($related_contest->vote_frequency ==6){
			$meta_key     = 'contest-photo-rate5-total';
		}
		if ($related_contest->vote_frequency ==7){
			$meta_key     = 'contest-photo-rate10-total';
		}
	  $meta_value   = '-1';
	  $meta_compare = '>=';
	}
	if ($_GET['contest-gallery-order'] == 'points-up') {
	  $orderby      = 'meta_value_num';
	  $meta_key     = 'contest-photo-points';
		if ($related_contest->vote_frequency ==6){
			$meta_key     = 'contest-photo-rate5-total';
		}
		if ($related_contest->vote_frequency ==7){
			$meta_key     = 'contest-photo-rate10-total';
		}
	  $meta_value   = '-1';
	  $meta_compare = '>=';
	  $order        = 'ASC';
	}
}

$args   = array(
    'post_type' => 'attachment',
    'posts_per_page' => $post_per_page,
    'post_status' => 'any',
    'post_parent' => null,
    'meta_query' => array(
        array(
            'key' => 'contest-active',
            'value' => '1'
        ),
        array(
            'key' => $category_meta,
            'value' => $category_key,
            'compare' => $category_compare
        ),
        array(
            'key' => 'photo-related-to-contest',
            'value' => $related_contest->id
        )
    ),

    'meta_key' => $meta_key,
    'meta_value' => $meta_value,
    'meta_compare' => $meta_compare,
    'orderby' => $orderby,
    'order' => $order,
		's' => $search_term,
    'paged' => $paged,
    'author' => $author_author
);
$args_2 = array(
    'post_type' => 'attachment',
    'posts_per_page' => 100000,
    'post_status' => 'any',
    'post_parent' => null,
    'author' => $author_author,
    'meta_key' => 'contest-active',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'photo-related-to-contest',
            'value' => $related_contest->id
        )
    )
);

//Total images = 0
$total_querys = get_posts($args);
$immages      = count($total_querys);
$contestrules = stripslashes($related_contest->contest_condition);

if ($immages == 0 and !isset($_GET['contest-category-order']) and !isset($_GET['contest-search'])) {
	$html .= '<div class="clear"></div>';
	$html .= '<div class="contest-info-bar"><i class="fa fa-exclamation-triangle"></i> ' . __('No photo has been submitted for the contest. Be the first!', 'photo-contest') . '</div>';
	$html .= '<div class="contest-rules">' . wpautop($contestrules) . '';
	$html .= '<div class="clear"></div></div>';
} else {
	if ($immages > 0 or isset($_GET['contest-search'])) {
		//Check if exist category
		$sql = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "photo_contest_cat WHERE related_to_contest = " . $related_contest->id . " ORDER BY name ASC");
		if (!empty($sql)) {
			$pc_gal_select = 'pc-gal-select';
			$pc_gal_select_last = 'pc-gal-select-last';
		}else{
			$pc_gal_select = 'pc-gal-select2';
			$pc_gal_select_last = 'pc-gal-select-last2';
		}

		$lightbox = get_option('pcplugin-allow-lightbox');
		if ($lightbox == '2' or $lightbox == '3') {
			$html .= '<script src="'.plugins_url().'/photo-contest/assets/lightbox/lightbox.js"></script>';
		}
		//Hide Select and Search Bar in the gallery
		$hide_select_bar = $related_contest->hide_select_bar;
		if ($hide_select_bar==2){
			$hide_select_bar_display = ' style="display:none"';
		}else{
			$hide_select_bar_display = '"';
		}

		$html .= '<div class="modern-p-form p-form-modern-steelBlue">';
		$html .= '<div data-base-class="p-form" class="p-form">';
		$html .= '<form action="' . get_permalink() . '" method="get" id="order-by-form"' . $hide_select_bar_display . '>';
		if (isset($_GET['page_id'])) {
			$html .= '<input type="hidden" name="page_id" value="' . $_GET['page_id'] . '" />';
		}

		//Order
		$html .= '<div class="form-group '.$pc_gal_select.'">';
		$html .= '<label class="input-group p-custom-arrow">';
		$html .= '<select name="contest-gallery-order" id="contest-gallery-order" onchange="this.form.submit()" class="form-control">';

		//Random
		if ($gallery_order==2){
			$html .= '<option value="random" ';
		 if (isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'random') {
			 $html .= ' selected="selected" ';
		 }
			$html .= '>' . __('Random', 'photo-contest') . '</option>';
		}

		//Newest
		$html .= '<option value="date-down"';
		if (isset($_GET['contest-gallery-order']) && $_GET['contest-gallery-order'] == 'date-down') {
			$html .= ' selected="selected" ';
		}
		$html .= '>' . __('Newest', 'photo-contest') . '</option>';

		//Oldest
    $html .= '<option value="date-up" ';
		if (isset($_GET['contest-gallery-order']) && $_GET['contest-gallery-order'] == 'date-up') {
			$html .= ' selected="selected" ';
		}
    $html .= '>' . __('Oldest', 'photo-contest') . '</option>';

		if ($related_contest->hide_votes == "1" or is_super_admin()) {

			$most_voted = __('Most voted', 'photo-contest');
			$least_voted = __('Least voted', 'photo-contest');
			if ($related_contest->vote_frequency ==6 or $related_contest->vote_frequency ==7){
				$most_voted = __('Top Rated', 'photo-contest');
				$least_voted = __('Lowest Rated', 'photo-contest');
			}

			//Most Voted
			$html .= '<option value="points-down" ';
			if (isset($_GET['contest-gallery-order']) && $_GET['contest-gallery-order'] == 'points-down') {
				$html .= ' selected="selected" ';
			}
			$html .= '>' . $most_voted . '</option>';

			//Least Votes
			$html .= '<option value="points-up" ';
			if (isset($_GET['contest-gallery-order']) && $_GET['contest-gallery-order'] == 'points-up') {
				$html .= ' selected="selected" ';
			}
			$html .= '>' .$least_voted . '</option>';

		}
		if ($gallery_order!=2){
			//Random
			$html .= '<option value="random" ';
			if (isset($_GET['contest-gallery-order']) && $_GET['contest-gallery-order'] == 'random') {
			$html .= ' selected="selected" ';
			}
			$html .= '>' . __('Random', 'photo-contest') . '</option>';
		}


		$html .= '</select>';
		$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span>';
		$html .= '</label>';
		$html .= '</div>';


		//Category Select Box
		if (!empty($sql)) {
			$html .= '<div class="form-group pc-gal-select">';
			$html .= '<label class="input-group p-custom-arrow">';
			$html .= '<select id="contest-category-order" name="contest-category-order" class="form-control" onchange="this.form.submit()">';

			if (isset($_GET['contest-category-order'])) {
				$catid = $_GET['contest-category-order'];
			} else {
				$catid = 0;
			}
			$html .= '<option ' . (($catid == 0) ? 'selected="selected"' : "") . ' value="0">' . __('All Categories', 'photo-contest') . '</option>';

			foreach ($sql as $item) {
				$html .= '<option ' . (($item->id == $catid) ? 'selected="selected"' : "") . ' value="' . $item->id . '">' . stripslashes ($item->name) . '</option>';
			}

			$html .= '</select>';
			$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>';
			$html .= '</div>';
    }

		//SearchBox
		$html .= '<div class="form-group '.$pc_gal_select_last.'">';
		$html .= '<div class="input-group">';
		$html .= '<input type="text" id="contest-search" name="contest-search" class="form-control" placeholder="' . __('Search....', 'photo-contest') . '">';
		$html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-btn">';
		$html .= '<button type="button" class="pc-btn" onclick="this.form.submit()"><i class="fa fa-search"></i></button>';
		$html .= '</span></div>';
		$html .= '</div>';

		$html .= '</form>';
		$html .= '</div>';
		$html .= '</div>';

  }
}

if ($immages == 0 and isset($_GET['contest-category-order']) and $_GET['contest-category-order']!=0 or
	$immages == 0 and isset($_GET['contest-search']) and !empty($_GET['contest-search'])) {
	$html .= '<div class="contest-info-bar"><i class="fa fa-exclamation-triangle"></i> ' . __('No results found', 'photo-contest') . '</div>';
}


if ($columns_number == 4 or $columns_number == 5) {
	$addwidth = " plusfive";
}elseif ($columns_number == 2) {
	$addwidth = " plusthree";
}elseif ($columns_number == 3 or $columns_number == 4) {
	$addwidth = " plussix";
}else {
	$addwidth = "";
}

$html .= '<div class="gallery-wrap' . $addwidth . '">';
$button_icon  = get_option('pcplugin-vote-icon');
$button_text = get_option('pcplugin-vote-text');
$button_vote_own_text = get_option('pcplugin-vote-own-text');
$button_vote_after_text = get_option('pcplugin-vote-after-text');
$button_vote_own_text_after = get_option('pcplugin-vote-own-text-after');

if ($related_contest->gallery_layout == 4){
	if ($button_icon == 1 or empty($button_icon)) {
		$icon = '';
	} elseif ($button_icon == 2) {
		$icon = '<i class="fa fa-fw fa-thumbs-up" aria-hidden="true"></i>';
	} elseif ($button_icon == 3) {
		$icon = '<i class="fa fa-f fa-heart" aria-hidden="true"></i>';
	} elseif ($button_icon == 4) {
		$icon = '<i class="fa fa-f fa-star" aria-hidden="true"></i>';
	} elseif ($button_icon == 5) {
		$icon = '<i class="fa fa-f fa-check" aria-hidden="true"></i>';
	} elseif ($button_icon == 6) {
		$icon = '<i class="fa fa-f fa-arrow-circle-right" aria-hidden="true"></i>';
	} elseif ($button_icon == 7) {
		$icon = '<i class="fa fa-f fa-hand-o-right" aria-hidden="true"></i>';
	} elseif ($button_icon == 8) {
		$icon = '<i class="fa fa-f fa-thumbs-o-up" aria-hidden="true"></i>';
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
}//if gallery_layout == 4

$attachments = get_posts($args);
if ($attachments) {
	$vhash = md5($_SERVER['REMOTE_ADDR']);
	$allow_redirect  = get_option('pcplugin-redirect-after-vote');
	$confirm_votes  = get_option('pcplugin-confirm-votes');
	$who_vote       = get_option('pcplugin-who-vote');

	//get info if is user a jury member
	$jury_member_check = false;
	if ($related_contest->jury==2 and is_user_logged_in()){
		$jury_members = $related_contest->jury_members;
		$jury_members_array = explode(',', $jury_members);

		if (in_array(get_current_user_id(), $jury_members_array)) {
			$jury_member_check = true;
		}
	}
	foreach ($attachments as $contestitem) {
		$photo_active = get_post_meta($contestitem->ID, 'contest-active', true);
		$photo_points = get_post_meta($contestitem->ID, 'contest-photo-points', true);

		$blogurl     = add_query_arg(array(
		'contest' => 'photo-detail',
		'photo_id' => $contestitem->ID
		), $current_url);

		if ($photo_active != 0) {
			$author_id        = get_post_meta($contestitem->ID, 'contest-photo-author', true);
			$author_url       = add_query_arg(array(
			  'contest' => 'gallery',
			  'author-id' => $author_id
			), $current_url);
			$image_attributes = wp_get_attachment_image_src($contestitem->ID, 'gallery-middle');
			//If thumbnail not exist
			if (stripos(strtolower($image_attributes[0]), '350x350') !== false) {

			}else{
				$image_attributes = wp_get_attachment_image_src($contestitem->ID, 'thumbnail');
			}
			$full_image       = wp_get_attachment_image_src($contestitem->ID, 'full');
			$large_image       = wp_get_attachment_image_src($contestitem->ID, 'pc-large');
			$title            = $contestitem->post_title;
			$user             = get_user_by('id', $author_id);

			//Load name if user is deleted or registration fail
			$photo_username = get_post_meta($contestitem->ID, 'contest-user-name', true);

			//Hide Author
			if ($related_contest->hide_author == "2" and !is_super_admin()) {
			  $hide_author = " pc_displaynone";
			} else {
			  $hide_author = "";
			}

			if (!empty($user)) {
			  $author = $user->display_name;
			}elseif (empty($user) and !empty($photo_username)) {
			  $author = $photo_username;
			}else {
			  $author = __('Deleted user', 'photo-contest');
			}
			//Icon for modern theme
			if ($related_contest->gallery_layout > 1) {
				$loveicon= 'pc-loveicon';
				if ($related_contest->vote_frequency ==6 or $related_contest->vote_frequency ==7){
					$loveicon= 'pc-rateicon';
				}
			}

			//Hide Votes
			if ($related_contest->hide_votes == "2" and !is_super_admin()) {
				$hide_votes =  " pc_displaynone";
			  $votes = "";
				$vote_rate_text = __('Votes:', 'photo-contest');
				$vote_rate_symbol= '<i class="fa fa-heart fa-fw"></i>';

			}else {
				$hide_votes =  " pc_visible";
			  $votes = get_post_meta($contestitem->ID, 'contest-photo-points', true);
				$vote_rate_text = __('Votes:', 'photo-contest');
				$vote_rate_symbol= '<i class="fa fa-heart fa-fw"></i>';
				if ($related_contest->vote_frequency ==6){
					$numberofstars=5;
					$rating_total = round(get_post_meta($contestitem->ID, 'contest-photo-rate5-total', true),1);
					$votes = $rating_total.'/'.$numberofstars;
					$vote_rate_text = __('Rating:', 'photo-contest');
					$vote_rate_symbol= '<i class="fa fa-star fa-fw"></i>';

				}
				if ($related_contest->vote_frequency ==7){
					$numberofstars=10;
					$rating_total = round(get_post_meta($contestitem->ID, 'contest-photo-rate10-total', true),1);
					$votes = $rating_total.'/'.$numberofstars;
					$vote_rate_text = __('Rating:', 'photo-contest');
					$vote_rate_symbol= '<i class="fa fa-star fa-fw"></i>';
				}//Vote-rate counts and symbols
			}

			//Hide Views
			if ($related_contest->hide_views == "2" and !is_super_admin()) {
			  $views = "";
			}else {
			  $views = getContestViews($contestitem->ID);
			}


      $category_id  = get_post_meta($contestitem->ID, 'contest-photo-category', true);
      $category_url = add_query_arg(array(
          'contest' => 'gallery',
          'contest-category-order' => $category_id
      ), $current_url);

      if (empty($category_id) or $category_id == 900000) {
				$category_id = "10000000";
      }


			$sql = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "photo_contest_cat WHERE id = " . $category_id . " AND related_to_contest = " . $related_contest->id . "");

			if (!empty($sql)) {
				foreach ($sql as $item) {
					$category_name = $item->name;
					//Classic
					$category      = '<span class="left" title="' . $category_name . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . stripslashes ($category_name) . '</span></span>';
					$category1     = '<span class="left" title="' . $category_name . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . stripslashes (contest_shorter($category_name, 35)) . '</span></span>';
					$category2     = '<span class="left" title="' . $category_name . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . stripslashes (contest_shorter($category_name, 18)) . '</span></span>';
					$category3     = '<span class="left" title="' . $category_name . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . stripslashes (contest_shorter($category_name, 16)) . '</span></span>';
				}
			}else {
				$category  = '<span class="left" title="' . __('No Category', 'photo-contest') . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . __('No Category', 'photo-contest') . '</span></span>';
				$category1 = '<span class="left" title="' . __('No Category', 'photo-contest') . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . __('No Category', 'photo-contest') . '</span></span>';
				$category2 = '<span class="left" title="' . __('No Category', 'photo-contest') . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . __('No Category', 'photo-contest') . '</span></span>';
				$category3 = '<span class="left" title="' . __('No Category', 'photo-contest') . '"><i class="fa fa-book fa-fw"></i>&nbsp;<span>' . __('No Category', 'photo-contest') . '</span></span>';
			}

			//Cookie Checker
			if ($related_contest->gallery_layout == 4) {
				$image_ID       = 'image_vote_' . $contestitem->ID;
				$vote_frequency = $related_contest->vote_frequency;
				//Check if cookie match to vote_frequency (if not match cookie is set to expire)
				pc_cookiechecker($vote_frequency,$image_ID);
			}

			//Gallery Layout
			if ($related_contest->gallery_layout == 1 or empty($related_contest->gallery_layout)) {
				include (plugin_dir_path( __DIR__ ) . 'includes/templates/pc-classic-gallery.php');
			}
			if ($related_contest->gallery_layout == 2) {
				include (plugin_dir_path( __DIR__ ) . 'includes/templates/pc-modern-gallery.php');
			}
			if ($related_contest->gallery_layout == 3) {
				include (plugin_dir_path( __DIR__ ) . 'includes/templates/pc-modern-gallery-lightbox.php');
			}
			if ($related_contest->gallery_layout == 4) {
				if ($expire_time < $today_time){
					include (plugin_dir_path( __DIR__ ) . 'includes/templates/pc-modern-gallery-lightbox.php');
				}elseif ($voting_time > $today_time){
					include (plugin_dir_path( __DIR__ ) . 'includes/templates/pc-modern-gallery-lightbox.php');
				}else{
					if ($related_contest->vote_frequency ==6 or $related_contest->vote_frequency ==7){
						include (plugin_dir_path( __DIR__ ) . 'includes/templates/pc-modern-gallery-lightbox.php');
					}else{
						include (plugin_dir_path( __DIR__ ) . 'includes/templates/pc-modern-gallery-lightbox-vote.php');
					}
				}
			}
		}
	}
}


$html .= '</div>';
$html .= '<div class="clear"></div>';


//Gallery paggination
$range     = 3;
$showitems = ($range * 2) + 1;

//If all get empty
$orderby = 'post_date';
$oder    = 'DESC';

$meta_key     = 'contest-photo-author';
$meta_value   = '0';
$meta_compare = '!=';

$category_meta    = 'contest-photo-category';
$category_key     = '0';
$category_compare = '>=';

if (isset($_GET['contest-category-order'])) {
	if ($_GET['contest-category-order'] != '0') {
	$category_meta    = 'contest-photo-category';
	$category_key     = $_GET['contest-category-order'];
	$category_compare = '=';
	}
}

if(isset($_GET['contest-search'])){
	$search_term = $_GET['contest-search'];
}else{
	$search_term = "";
}

$arguments   = array(
	'post_type' => 'attachment',
	'posts_per_page' => -1,
	'post_status' => 'any',
	'post_parent' => null,
	'meta_query' => array(
	    array(
	        'key' => 'contest-active',
	        'value' => '1'
	    ),
	    array(
	        'key' => $category_meta,
	        'value' => $category_key,
	        'compare' => $category_compare
	    ),
	    array(
	        'key' => 'photo-related-to-contest',
	        'value' => $related_contest->id
	    )
	),

	'meta_key' => $meta_key,
	'meta_value' => $meta_value,
	'meta_compare' => $meta_compare,
	'orderby' => $orderby,
	's' => $search_term,
	'order' => $oder,
	'paged' => $paged,
	'author' => $author_author
);

$total_query = get_posts($arguments);
$gallery_layout_color = $related_contest->gallery_layout_color;
if (empty($gallery_layout_color)){$gallery_layout_color = "#38b3e5";}
	$pages = count($total_query);
	if ($gallery_order==2 and !isset($_GET['contest-gallery-order']) or
	 isset($_GET['contest-gallery-order']) && $_GET['contest-gallery-order'] == 'random'){
		$html .= '<div class="clear"></div><div class="contest-pagination">';
		$html .= '<div class="pc-pagination">';
		$html .= '<span class="active" style="background-color:'.$gallery_layout_color.'; border:1px solid '.$gallery_layout_color.';"  onclick="location=\''.get_permalink().'?contest-gallery-order=random\'"><a href="'.get_permalink().'?contest-gallery-order=random" style="color:white;" title="'.__('Generate random photos','photo-contest').'"><i class="fa fa-random" aria-hidden="true"></i></a></span>';
		$html .= "</div>";
		$html .= "</div>";//vc-pagination end
	}else{
	global $paged;
	if (get_query_var('paged')) {
	    $paged = get_query_var('paged');
	} else if (get_query_var('page')) {
	    $paged = get_query_var('page');
	} else {
	    $paged = 1;
	}
	if (empty($paged))
		$paged = 1;
		$pages = ceil($pages / $post_per_page);
		if ($pages != 1) {
			if (isset($_GET['contest-gallery-order']) and $_GET['contest-gallery-order']!='random' or !isset($_GET['contest-gallery-order']) ) { //just exclude random order
			$html .= '<div class="clear"></div><div class="contest-pagination">';
			$html .= '<div class="pc-pagination">';

			if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
				$html .= '<span  onclick="location=\''.get_pagenum_link(1).'\'"><a href="'.get_pagenum_link(1).'" title="'.__("First","photo-contest").'"><i class="fa fa-fast-backward"></i></a></span>';
			}
			if($paged > 1 && $showitems < $pages) {
				$html .= '<span  onclick="location=\''.get_pagenum_link($paged - 1).'\'"><a href="'.get_pagenum_link($paged - 1).'" title="'.__("Previous","photo-contest").'"><i class="fa fa-step-backward"></i></a></span>';
			}

			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range || $i <= $paged-$range) || $pages <= $showitems )){
					$onclick = "location='".get_pagenum_link($i)."'";
					$html .= ($paged == $i)? '<span class="active" style="background-color:'.$gallery_layout_color.'; border:1px solid '.$gallery_layout_color.';" onclick="'.$onclick.'">'.$i.'</span>':'<span  onclick="'.$onclick.'"><a href="'.get_pagenum_link($i).'">'.$i.'</a></span>';
				}
			}

			if ($paged < $pages && $showitems < $pages) {
				$html .= '<span  onclick="location=\''.get_pagenum_link($paged + 1).'\'"><a href="'.get_pagenum_link($paged + 1).'" title="'.__('Next','photo-contest').'"><i class="fa fa-step-forward"></i></a></span>';
			}
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
				$html .= '<span  onclick="location=\''.get_pagenum_link($pages).'\'"><a href="'.get_pagenum_link($pages).'" title="'.__('Last','photo-contest').'"><i class="fa fa-fast-forward"></i></a></span>';
			}
			$html .= "</div>";

			$html .= "</div>";//pc-pagination end
		}//and if not random order
		}//if ($gallery_order==2 and !isset($_GET['gallery-order'])
	}
	$html .= '<div class="clear" style="height:20px;"></div>';
	$html .= '</div>'; // class photo-contest end
	$html .= '<div class="clear"></div>';//important
} //end of if empty sql

?>
