<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
die;
}

//Delete the contest and all data about contest and images from this contest
function pc_delete_the_contest($contest_id){
	if (current_user_can( 'manage_options')) {
	global $wpdb;

	//Clear Jury
	$related_contest = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$contest_id);
	$jury_members = $related_contest->jury_members;
	$jury_members_array = explode(',', $jury_members);

	foreach ($jury_members_array as $user_ID) {
    	delete_user_meta($user_ID, 'jury_member_votes_'.$contest_id);
  }

	$wpdb->delete( $wpdb->prefix.'photo_contest_list', array( 'id' => $contest_id ) );
	$wpdb->delete( $wpdb->prefix.'photo_contest_cat', array( 'related_to_contest' => $contest_id ));


	//Search the images
	$args = array(
        'post_type'      => 'attachment',
        'post_status'    => 'any',
        'post_parent'    => null,
		'posts_per_page'=> -1,
        'meta_key'       => 'photo-related-to-contest',
		'meta_value'     => $contest_id,
		'meta_query' => array(
			array(
			'key' => 'contest-active',
			)
		)
        );

	$attachments = get_posts( $args );

	//Clear post meta
	if ( $attachments ) {
	foreach ( $attachments as $post ) {

		$contest_user_images = 'contest_user_images_'.$contest_id;

		delete_user_meta( $post->post_author, $contest_user_images );
		delete_post_meta($post->ID, 'contest-active');
		delete_post_meta($post->ID, 'contest-photo-points');
		delete_post_meta($post->ID, 'post_views_count');
		delete_post_meta($post->ID, 'contest-photo-category');
		delete_post_meta($post->ID, 'photo-related-to-contest');
		delete_post_meta($post->ID, 'contest-photo-author');
		delete_post_meta($post->ID, 'contest-photo-ip');
		delete_post_meta($post->ID, 'contest-photo-users');
		delete_post_meta($post->ID, 'contest-photo-category');
		delete_post_meta($post->ID, 'photo-upload-ip');
		delete_post_meta($post->ID, 'contest-user-name');
		delete_post_meta($post->ID, 'contest-user-email');
		delete_post_meta($post->ID, 'image-country');
		delete_post_meta($post->ID, 'camera-model');
		delete_post_meta($post->ID, 'custom-field');
		delete_post_meta($post->ID, 'contest-photo-emails');
		delete_post_meta($post->ID, 'contest-photo-rate5');
		delete_post_meta($post->ID, 'contest-photo-rate10');
		delete_post_meta($post->ID, 'contest-photo-rate5-total');
		delete_post_meta($post->ID, 'contest-photo-rate10-total');

		}

	}
  }
}

//Reset the contest and all data about contest and images from this contest
function pc_reset_the_contest($contest_id){
	if (current_user_can( 'manage_options')) {
	global $wpdb;

	//Clear Jury
	$related_contest = $wpdb->get_row( "SELECT jury_members FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$contest_id);
	$jury_members = $related_contest->jury_members;
	$jury_members_array = explode(',', $jury_members);

	foreach ($jury_members_array as $user_ID) {
    	update_user_meta($user_ID, 'jury_member_votes_'.$contest_id, '0');
    }

	//Search the images
	$args = array(
			'post_type'      => 'attachment',
			'post_status'    => 'any',
			'post_parent'    => null,
			'posts_per_page'=> -1,
			'meta_key'       => 'photo-related-to-contest',
			'meta_value'     => $contest_id,
			'meta_query' => array(
			array(
			'key' => 'contest-active',
			)
		)
        );

	//Reset IP address list
	$wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'ip_list' => "",	// string
						 ),
					array( 'id' => $contest_id )
						 );
	//Reset User ID list
	$wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'user_vote_list' => "",	// string
						 ),
					array( 'id' => $contest_id )
						 );
	//Reset Email list
	$wpdb->update(
					 $wpdb->prefix.'photo_contest_list',
					array(
						'email_list' => "",	// string
						 ),
					array( 'id' => $contest_id )
						 );
	$attachments = get_posts( $args );

	//Clear post meta
	if ( $attachments ) {
	foreach ( $attachments as $post ) {

		$contest_user_images = 'contest_user_images_'.$contest_id;

		delete_user_meta( $post->post_author, $contest_user_images );
		delete_post_meta($post->ID, 'contest-active');
		delete_post_meta($post->ID, 'contest-photo-points');
		delete_post_meta($post->ID, 'post_views_count');
		delete_post_meta($post->ID, 'contest-photo-category');
		delete_post_meta($post->ID, 'photo-related-to-contest');
		delete_post_meta($post->ID, 'contest-photo-author');
		delete_post_meta($post->ID, 'contest-photo-ip');
		delete_post_meta($post->ID, 'contest-photo-users');
		delete_post_meta($post->ID, 'contest-photo-category');
		delete_post_meta($post->ID, 'photo-upload-ip');
		delete_post_meta($post->ID, 'contest-user-name');
		delete_post_meta($post->ID, 'contest-user-email');
		delete_post_meta($post->ID, 'image-country');
		delete_post_meta($post->ID, 'camera-model');
		delete_post_meta($post->ID, 'custom-field');
		delete_post_meta($post->ID, 'contest-photo-emails');
		delete_post_meta($post->ID, 'contest-photo-rate5');
		delete_post_meta($post->ID, 'contest-photo-rate10');
		delete_post_meta($post->ID, 'contest-photo-rate5-total');
		delete_post_meta($post->ID, 'contest-photo-rate10-total');

		}

	}
  }
}

//Reset the contest and all data about contest and images from this contest
function pc_reset_votes($contest_id){
	if (current_user_can( 'manage_options')) {
	global $wpdb;

	//Search the images
	$args = array(
        'post_type'      => 'attachment',
        'post_status'    => 'any',
        'post_parent'    => null,
		'posts_per_page'=> -1,
        'meta_key'       => 'photo-related-to-contest',
		'meta_value'     => $contest_id,
		'meta_query' => array(
			array(
			'key' => 'contest-active',
			)
		)
        );

	//Reset IP address list
	$wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'ip_list' => "",	// string
						 ),
					array( 'id' => $contest_id )
						 );
	//Reset User ID list
	$wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'user_vote_list' => "",	// string
						 ),
					array( 'id' => $contest_id )
						 );
	//Reset Email list
	$wpdb->update(
				 	$wpdb->prefix.'photo_contest_list',
					array(
						'email_list' => "",	// string
					 	),
					array( 'id' => $contest_id )
					 );

	$attachments = get_posts( $args );

	//Clear post meta
	if ( $attachments ) {
	foreach ( $attachments as $post ) {
		update_post_meta($post->ID, 'contest-photo-points', 0);
		update_post_meta($post->ID, 'post_views_count', 0);
		update_post_meta($post->ID, 'contest-photo-ip', '');
		update_post_meta($post->ID, 'contest-photo-users', '');
		update_post_meta($post->ID, 'contest-photo-emails', '');
		update_post_meta($post->ID, 'contest-photo-rate5', '');
		update_post_meta($post->ID, 'contest-photo-rate10', '');
		update_post_meta($post->ID, 'contest-photo-rate5-total', 0);
		update_post_meta($post->ID, 'contest-photo-rate10-total', 0);
		}

	}

	//Clear Jury
	$related_contest = $wpdb->get_row( "SELECT jury_members FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$contest_id);
	$jury_members = $related_contest->jury_members;
	$jury_members_array = explode(',', $jury_members);

	foreach ($jury_members_array as $user_ID) {
    	update_user_meta($user_ID, 'jury_member_votes_'.$contest_id, '0');
    }
  }
}

//Save contests
function pc_save_contest(){
	global $wpdb;

	if ($_POST['contest-mode']!=1){
        $reg_ends = $_POST['contest-end'];
    }else{
        $reg_ends = $_POST['contest-reg-ends'];
    }

	if(!empty($_POST['contest-name'])){
			$wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'contest_name' => stripslashes($_POST['contest-name']),	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
        }
		if(!empty($_POST['contest-to-page'])){
			$wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'page_id' => $_POST['contest-to-page'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
        }
			$wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'page_id_secondary' => $_POST['contest-to-page-secondary'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		 $wpdb->update(
 	           $wpdb->prefix.'photo_contest_list',
 	            array(
 		            'page_id_third' => $_POST['contest-to-page-third'],	// string
 	                 ),
 	            array( 'id' => $_GET["edit"] )
 	                 );
        if(!empty($_POST['contest-start'])){
			$wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'contest_start' => sanitize_text_field($_POST['contest-start']),	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
        }
        if(!empty($_POST['contest-end'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'contest_end' => sanitize_text_field($_POST['contest-end']),	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
        }
		if(!empty($_POST['contest-start-vote'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'contest_vote_start' => sanitize_text_field($_POST['contest-start-vote']),	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
        }
		if(!empty($_POST['contest-reg-ends'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'contest_register_end' => $reg_ends,	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
        }
        if(!empty($_POST['photo_number'])){
          if(is_numeric($_POST['photo_number'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'image_per_user' => $_POST['photo_number'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
          }
        }
        if(!empty($_POST['lines_number'])){
          if(is_numeric($_POST['lines_number'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'contest_rows' => $_POST['lines_number'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
          }
        }
        if(!empty($_POST['columns_number'])){
          if(is_numeric($_POST['columns_number'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'contest_columns' => $_POST['columns_number'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
          }
        }
		if(!empty($_POST['oneday-vote'])){
          if(is_numeric($_POST['oneday-vote'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'vote_frequency' => $_POST['oneday-vote'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
          }
        }
		if(!empty($_POST['menu-color'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'menu_color' => $_POST['menu-color'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
        }
		if(!empty($_POST['menu-style'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'menu_style' => $_POST['menu-style'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
        }
		if(!empty($_POST['gallery-layout'])){
            $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'gallery_layout' => $_POST['gallery-layout'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
        }
		if(!empty($_POST['gallery-layout-color'])){
	           $wpdb->update(
		           $wpdb->prefix.'photo_contest_list',
		            array(
			            'gallery_layout_color' => $_POST['gallery-layout-color'],	// string
		                 ),
		            array( 'id' => $_GET["edit"] )
		                 );
	       }
		 if(!empty($_POST['gallery-order'])){
							$wpdb->update(
								$wpdb->prefix.'photo_contest_list',
								 array(
									 'gallery_order' => $_POST['gallery-order'],	// string
											),
								 array( 'id' => $_GET["edit"] )
											);
					}
      $wpdb->update(
           $wpdb->prefix.'photo_contest_list',
            array(
	            'contest_condition' => stripslashes($_POST['contest_condition']),	// string
                 ),
            array( 'id' => $_GET["edit"] )
                 );


	   //Hide upload
	   if(isset($_POST['hide_up'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_up' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_up' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
	   //Hide top
	   if(isset($_POST['hide_top'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_top' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_top' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
	   //Hide your
	   if(isset($_POST['hide_your'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_your' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_your' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
	   //Hide rules
	   if(isset($_POST['hide_rules']) and $_POST['contest-mode']!=2){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_rules' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_rules' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
	   //Hide author
	   if(isset($_POST['hide_author'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_author' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_author' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Hide votes
	   if(isset($_POST['hide_votes'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_votes' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_votes' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Hide views
	   if(isset($_POST['hide_views'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_views' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_views' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}

		//Date of birth
	   if(isset($_POST['dateofbirth'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'date_of_birth' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'date_of_birth' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//City
	   if(isset($_POST['city'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'city' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'city' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Address
	   if(isset($_POST['address'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'adress' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'adress' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Zip/Postal code
	   if(isset($_POST['zip_code'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'zip_code' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'zip_code' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//State
	   if(isset($_POST['state'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'state' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'state' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Country
	   if(isset($_POST['country'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'country' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'country' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Gender
	   if(isset($_POST['gender'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'gender' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'gender' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Gender 3
	   if(isset($_POST['gender_3'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'gender_3' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'gender_3' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//WWW
	   if(isset($_POST['www'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'www' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'www' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Phone
	   if(isset($_POST['phone'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'phone' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'phone' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Facebook
	   if(isset($_POST['fb_page'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'fb_page' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'fb_page' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Twitter
	   if(isset($_POST['twitter_page'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'twitter_page' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'twitter_page' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Instagram
	   if(isset($_POST['instagram_page'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'instagram_page' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'instagram_page' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Custom field
	   if(isset($_POST['custom_field_personal'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'custom_field_personal' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'custom_field_personal' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Custom field name
	   if(isset($_POST['custom_field_personal_name'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'custom_field_personal_name' => $_POST['custom_field_personal_name'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Custom field _required
	   if(isset($_POST['custom_field_personal_required'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'custom_field_personal_required' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'custom_field_personal_required' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Custom field name
	   if(isset($_POST['custom_field_personal_name_required'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'custom_field_personal_name_required' => $_POST['custom_field_personal_name_required'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Description
	   if(isset($_POST['description'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'description' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'description' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
	   //Camera model
	   if(isset($_POST['camera_model'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'camera_model' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'camera_model' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Custom image field
	   if(isset($_POST['custom_field_image'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'custom_field_image' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'custom_field_image' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Custom image field name
	   if(isset($_POST['custom_field_image_name'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'custom_field_image_name' => $_POST['custom_field_image_name'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
	   //I am over 13
	   if(isset($_POST['agree_age_13'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'agree_age_13' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'agree_age_13' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
	   //I am over 18
	   if(isset($_POST['agree_age_18'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'agree_age_18' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'agree_age_18' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
	   //Agree rules
	   if(isset($_POST['agree_terms'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'agree_terms' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'agree_terms' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
       //IP protection
		$wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'ip_protection' => stripslashes($_POST['ip-protection']),	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		//Allow User to Edit Image
		$wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'allow_user_edit' => stripslashes($_POST['allow-user-edit']),	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
	   //Contest Mode
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'contest_mode' => $_POST['contest-mode'],	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
	   //Hide Login Button
	   if(isset($_POST['hide_login'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_login' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_login' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
	   //Hide Social icons
	   if(isset($_POST['hide_social'])){
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_social' => "2",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}else{
	   $wpdb->update(
	           $wpdb->prefix.'photo_contest_list',
	            array(
		            'hide_social' => "1",	// string
	                 ),
	            array( 'id' => $_GET["edit"] )
	                 );
		}
		//Force Registration
		if(!empty($_POST['force-registration'])){
						$wpdb->update(
						$wpdb->prefix.'photo_contest_list',
						 array(
							 'force_registration' => $_POST['force-registration'],	// string
									),
						 array( 'id' => $_GET["edit"] )
									);
		}
		//Hide select Bar
		if(isset($_POST['hide_select_bar'])){
		$wpdb->update(
						$wpdb->prefix.'photo_contest_list',
						 array(
							 'hide_select_bar' => "2",	// string
									),
						 array( 'id' => $_GET["edit"] )
									);
	 }else{
		$wpdb->update(
						$wpdb->prefix.'photo_contest_list',
						 array(
							 'hide_select_bar' => "1",	// string
									),
						 array( 'id' => $_GET["edit"] )
									);
	 }
}
