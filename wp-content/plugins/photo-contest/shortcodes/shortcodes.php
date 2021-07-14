<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Add menu shortcode
add_shortcode('contest-menu', 'photo_menu');
function photo_menu($atts){

	//set default attributes and values
	$values = shortcode_atts( array(
		'id'   	=> '',
	), $atts );

	global $post;
	if (!empty($post)){
		global $wpdb;
		if (empty($values['id'])){
			$related_contest = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "photo_contest_list WHERE page_id = " . $post->ID." or page_id_secondary = ".$post->ID." or page_id_third = ".$post->ID);
	 	}else{
			$related_contest = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "photo_contest_list WHERE id = " . $values['id']);
	 	}
		$html = '';//very important
		include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/contest-menu.php');
		return $html;//very important
	}
}

//Add contest-page shortcode
add_shortcode('contest-page', 'contest_page');
function contest_page($atts){

	//set default attributes and values
	$values = shortcode_atts( array(
		'id'   	=> '',
	), $atts );


	global $post;

	if (!empty($post)){

		global $wpdb;
		if (empty($values['id'])){
			$related_contest = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "photo_contest_list WHERE page_id = " . $post->ID." or page_id_secondary = ".$post->ID." or page_id_third = ".$post->ID);
	 	}else{
			$related_contest = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "photo_contest_list WHERE id = " . $values['id']);
	 	}

		//Global contest variable. Very important!
		if(!empty($related_contest)){
		  $GLOBALS['photo_contest'] = $related_contest;
		}else{
		  $GLOBALS['photo_contest'] = "";
		}

		if (!empty($related_contest)){
			include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/contest-basic.php'); //Get basic values
			include_once( plugin_dir_path( __DIR__ ) . 'includes/pc-basic-functions.php' );//Get basic functions
		}
		//Load SEO
		if (isset($_GET['contest']) and $_GET['contest'] == 'photo-detail') {
			include_once(plugin_dir_path( __DIR__ ) .'includes/pc-seo.php');
		}
		// Load functions only when is needed
		if (
		 isset($_GET['contest']) and $_GET['contest'] == 'photo-detail' or
		 isset($_GET['contest']) and $_GET['contest'] == 'contest-profile') {
		 include_once( plugin_dir_path( __DIR__ ) . 'includes/pc-loginform.php' );
		}
		// Load functions only when is needed
		if (isset($_POST['action']) and $_POST['action'] == 'new_post') {
			include_once( plugin_dir_path( __DIR__ ) . 'includes/pc-registration.php' );
		}


		$html = '';//very important

		//Add Gallery
		if (empty($related_contest)){
			include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/contest-gallery.php');
		}
		//Add Gallery
		if (!empty($related_contest)){
			if (!isset($_GET['contest']) or  isset($_GET['contest'])and $_GET['contest'] == 'gallery') {
				if (!empty($related_contest) and $related_contest->contest_mode != 1){
							include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/upload-photo.php');
					}else{
							include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/contest-gallery.php');
				}
			}
		}
		//Add Upload section
		if (!empty($related_contest)){
			if (isset($_GET['contest']) and $_GET['contest'] == 'upload-photo') {
					include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/upload-photo.php');
			}
		}
		//Add Profile
		if (!empty($related_contest)){
			if (isset($_GET['contest']) and $_GET['contest'] == 'contest-profile') {
					include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/contest-profile.php');
			}
		}
		//Add Contest rules
		if (!empty($related_contest)){
			if (isset($_GET['contest']) and $_GET['contest'] == 'contest-condition') {
					include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/contest-condition.php');
			}
		}
		//Add Gallery detail
		if (!empty($related_contest)){
			if (isset($_GET['contest']) and $_GET['contest'] == 'photo-detail') {
					include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/contest-gallery-detail.php');
			}
		}
		//Add Top 10
		if (!empty($related_contest)){
			if (isset($_GET['contest']) and $_GET['contest'] == 'contest-top10') {
					include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/contest-top10.php');
			}
		}
		//Add Contest Share page
		if (!empty($related_contest)){
			if (isset($_GET['contest']) and $_GET['contest'] == 'contest-share') {
					include_once( plugin_dir_path( __DIR__ ) . 'shortcodes/contest-share.php');
			}
		}

		return $html; //very important

	}//if (!empty($post))
}


//Global shortcodes
include_once('global/contest-width.php');
include_once('global/contest-single-image.php');
include_once('global/contest-rules-shortcode.php');
