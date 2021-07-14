<?php
/**
 * @package   Photo Contest WordPress Plugin
 * @author    Zbyněk Hovorka
 * @link      http://www.contest.w4y.cz/
 * @copyright 2014 Zbyněk Hovorka
 */
 //Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

function pc_export_data($export_attachments){
	global $wpdb;
	$date_format = get_option('date_format', true);
    ob_clean();
    ob_start();
	$FileName = 'Photo-Contest-Export-'.date($date_format) . '.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$FileName.'"');
    header('Pragma: no-cache');
    header('Expires: 0');
    $fp = fopen('php://output', 'w');

	$names = array("ID","Title","Author","Author Email","Votes","5 Stars","10 Stars","Upload Date","Contest","Category","Upload IP","Photo URL","Country","Description","Custom field");

	//Load categories
	$categories= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat ORDER BY id DESC");
	if (!empty ($categories)){
		$category_list = array();
		foreach ($categories as $category) {
		  $category_list[$category->id] = $category->name;
		}
	}
	//Load contests
	$contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list ORDER BY id DESC");
	if (!empty ($contests)){
		$contests_list = array();
		foreach ($contests as $contest) {
		  $contests_list[$contest->id] = stripslashes($contest->contest_name);
		}
	}

	fputcsv($fp, $names);
    foreach ($export_attachments as $post) {
		//Photo Title
		$title = $post->post_title;
		$description = $post->post_content;
		//Image URL
		$photo_url = wp_get_attachment_url($post->ID);
		//Author
		$author_id = get_post_meta($post->ID,'contest-photo-author',true);
    $user = get_user_by( 'id', $author_id );
		$author = $user->display_name;
		$author_email = $user->user_email;
		//IP
		$photo_upload_ip = get_post_meta($post->ID,'photo-upload-ip',true);
		if (empty ($photo_upload_ip)){
			$photo_upload_ip = __('No Data','photo-contest');
			}
		//Upload Country
	    $photo_country = get_post_meta($post->ID,'image-country',true);
		if (!empty ($photo_country)){
		$photo_country = $photo_country[0];
		}else{
		$photo_country="";
		}
		//Votes
		$photoVotes = get_post_meta($post->ID,'contest-photo-points',true);
		$photo5stars = get_post_meta($post->ID,'contest-photo-rate5-total',true);
		$photo10stars = get_post_meta($post->ID,'contest-photo-rate10-total',true);
		//Category
		$image_category= get_post_meta($post->ID,'contest-photo-category',true);
		if ($image_category!=900000){
		$category = $category_list[$image_category];
		}else{
		$category= __('Uncategorized','photo-contest');
		}
		//Contest
		$image_contest= get_post_meta($post->ID,'photo-related-to-contest',true);
		$contest = $contests_list[$image_contest];

		//Custom field
		$custom_field_image = get_post_meta($post->ID,'custom-field',true);

		//Date
		$photo_date = get_the_date( $date_format, $post->ID );

        $fields = array($post->ID,$title,$author,$author_email,$photoVotes,$photo5stars,$photo10stars,$photo_date,$contest,$category,$photo_upload_ip,$photo_url,$photo_country,$description,$custom_field_image);
		fputcsv($fp, $fields);
    }
    fclose($fp);
	exit;

}

function pc_export_users($contest_id){
	global $wpdb;
	$contest = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$contest_id );
	$custom_field_personal_name = stripslashes($contest->custom_field_personal_name);
	$custom_field_personal_name_required = stripslashes($contest->custom_field_personal_name_required);

	$date_format = get_option('date_format', true);
	$time_format = get_option('time_format', true);

	ob_clean();
    ob_start();
	$FileName = 'User-Export-'.stripslashes($contest->contest_name) . '.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$FileName.'"');
    header('Pragma: no-cache');
    header('Expires: 0');
    $fp = fopen('php://output', 'w');

	//Fields names
	$names = array("User ID","Author name","Email","Phone","Date of birth","Address","City","Zip/Postal code","Sate","Country","Gender","www","Facebook","Twitter","Instagram",$custom_field_personal_name,$custom_field_personal_name_required,"GDPR agreement");
	//Create first line
	fputcsv($fp, $names);
	//Create data
	$args = array(
	'meta_key'     => 'contest_user_images_'.$contest->id,
    );
	$users = get_users($args );
	foreach ($users as $user) {
		$author_id =$user->ID;
		$author =$user->display_name;
		$email =$user->user_email;

		//About User
		$dateofbirth = get_user_meta($author_id, 'pcplugin-dateofbirth', true);
		$address = get_user_meta($author_id, 'pcplugin-adress', true);
		$city = get_user_meta($author_id, 'pcplugin-city', true);
    $zip_code = get_user_meta($author_id, 'pcplugin-zip_code', true);
		$state = get_user_meta($author_id, 'pcplugin-state', true);
		$country = get_user_meta($author_id, 'pcplugin-country', true);
		$gender = get_user_meta($author_id, 'pcplugin-gender', true);
		$gender_3 = get_user_meta($author_id, 'pcplugin-gender_3', true);
		$www = get_user_meta($author_id, 'pcplugin-www', true);
		$phone = get_user_meta($author_id, 'pcplugin-phone', true);
		$facebook = get_user_meta($author_id, 'pcplugin-facebook', true);
		$twitter = get_user_meta($author_id, 'pcplugin-twitter', true);
		$instagram = get_user_meta($author_id, 'pcplugin-instagram', true);
		$custom_field_personal = get_user_meta($author_id, 'pcplugin-custom_field_personal_'.$contest->id, true);
		$custom_field_personal_required = get_user_meta($author_id, 'pcplugin-custom_field_personal_required_'.$contest->id, true);
		$agree_GDPR = get_user_meta($author_id, 'agree-GDPR', true);

		if (!empty($gender)){
			if ($gender == "male"){$gender= __('Male', 'photo-contest');}
		    if ($gender == "female"){$gender= __('Female', 'photo-contest');}
			}
		if (!empty($gender_3)){
			if ($gender_3 == "male"){$gender = __('Male', 'photo-contest');}
		    if ($gender_3 == "female"){$gender = __('Female', 'photo-contest');}
		    if ($gender_3 == "other"){$gender = __('Other', 'photo-contest');}
			}
		if (!empty($dateofbirth)){
		$dateofbirth = date_i18n($date_format, strtotime($dateofbirth));
		}else{
		$dateofbirth = "";
		}
		if (!empty($agree_GDPR)){
		$agree_GDPR = date( $date_format.' - '.$time_format, $agree_GDPR );
		}else{
		$agree_GDPR = "";
		}


		$fields = array($author_id,$author,$email,$phone,$dateofbirth,$address,$city,$zip_code,$state,$country,$gender,$www,$facebook,$twitter,$instagram,stripslashes($custom_field_personal),stripslashes($custom_field_personal_required),$agree_GDPR);
		fputcsv($fp, $fields);
	}

    fclose($fp);
	exit;

}

function pc_export_votes($votes){
	global $wpdb;


	ob_clean();
    ob_start();
	$FileName = 'Votes-Export.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$FileName.'"');
    header('Pragma: no-cache');
    header('Expires: 0');
    $fp = fopen('php://output', 'w');

	//Fields names
	$names = array("Vote ID","Item ID","Value","Voter","Contest","Category","Country","Country code","Date","Time","Email","IP address");
	//Create first line
	fputcsv($fp, $names);
	//Create data

	//Load contests
		$contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list ORDER BY id DESC");
		if (!empty ($contests)){
			$contests_list = array();
			foreach ($contests as $contest) {
			  $contests_list[$contest->id] = stripslashes($contest->contest_name);
			  $contests_page[$contest->id] = $contest->page_id;
			}
		}
	//Load categories
	    $categories= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat ORDER BY id DESC");
		if (!empty ($categories)){
			$category_list = array();
			foreach ($categories as $category) {
			  $category_list[$category->id] = $category->name;
			}
		}

	foreach($votes as $item){

		$vote_id = $item->id;
		$item_id = $item->item_id;

		//Vote value
    if ($item->vote_rating_value=='v1' or empty($item->vote_rating_value)){$rate_value = '+1';}

    if ($item->vote_rating_value=='r1'){$rate_value = '* 1/5';}
    if ($item->vote_rating_value=='r2'){$rate_value = '* 2/5';}
    if ($item->vote_rating_value=='r3'){$rate_value = '* 3/5';}
    if ($item->vote_rating_value=='r4'){$rate_value = '* 4/5';}
    if ($item->vote_rating_value=='r5'){$rate_value = '* 5/5';}

    if ($item->vote_rating_value=='d1'){$rate_value = '* 1/10';}
    if ($item->vote_rating_value=='d2'){$rate_value = '* 2/10';}
    if ($item->vote_rating_value=='d3'){$rate_value = '* 3/10';}
    if ($item->vote_rating_value=='d4'){$rate_value = '* 4/10';}
    if ($item->vote_rating_value=='d5'){$rate_value = '* 5/10';}
    if ($item->vote_rating_value=='d6'){$rate_value = '* 6/10';}
    if ($item->vote_rating_value=='d7'){$rate_value = '* 7/10';}
    if ($item->vote_rating_value=='d8'){$rate_value = '* 8/10';}
    if ($item->vote_rating_value=='d9'){$rate_value = '* 9/10';}
    if ($item->vote_rating_value=='d10'){$rate_value = '* 10/10';}



		if($item->user_id==0 or !get_user_by('id',$item->user_id)){
	     $voter = __('Guest','photo-contest');
	    }else{
		 $user = get_user_by( 'id', $item->user_id );
	     $voter = $user->display_name;
	    }

		//Contest
		$image_contest= $item->contest_id;
		if (!empty($contests_list[$image_contest])){
		$contest = $contests_list[$image_contest];
		}else{
		 $contest= __('Contest was deleted','photo-contest');
	    }

		//Category
		$image_category= $item->category_id;
		if ($image_category!=900000 and $image_category!=0 and !empty($category_list[$image_category])){
		$category = $category_list[$image_category];
		$category_name = $category;
		}else{
		$category_name= __('Uncategorized','photo-contest');
		}

		//Country and country code
		$country = $item->country;
		if (empty($country)){
		  $country = __('No data','photo-contest');
        }
		$country_code = $item->country_code;
		if (empty($country_code)){
		  $country_code = __('No data','photo-contest');
        }

		//Date and time
		$timestamp = $item->vote_date;
		$date = date(get_option("date_format"), $timestamp);
		$time = date('H:i:s', $timestamp);

		//Email
		$email = $item->email;
		if (empty($email)){
		  $email = __('No data','photo-contest');
        }
		//IP ADDRESS
		$ip_address = $item->ip_address;

		$fields = array($vote_id,$item_id,$rate_value,$voter,$contest,$category_name,$country,$country_code,$date,$time,$email,$ip_address);
		fputcsv($fp,$fields);
	}

    fclose($fp);
	exit;

}
