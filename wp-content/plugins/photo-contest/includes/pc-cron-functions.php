<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Voting 24 hour cron
//Daily Voting
if ( ! wp_next_scheduled( 'daily_voting' ) ) {
  wp_schedule_event( time(), 'daily', 'daily_voting' );
}

add_action( 'daily_voting', 'daily_voting_function' );

function daily_voting_function() {
  global $wpdb;
    $sql= $wpdb->get_results("SELECT id FROM ".$wpdb->prefix."photo_contest_list WHERE vote_frequency = 2 and jury = 1");
	if (!empty($sql)){
    foreach ( $sql as $item ) {    
	$args = array( 
        'post_type'      => 'attachment', 
        'post_status'    => 'any', 
		'posts_per_page'=> -1, 
        'post_parent'    => null,
        'meta_key'       => 'photo-related-to-contest',
		'meta_value'     => $item->id,
		
        );	
	$attachments = get_posts( $args );
	
	foreach ( $attachments as $post ) {
		delete_post_meta($post->ID, 'contest-photo-ip');
		delete_post_meta($post->ID, 'contest-photo-users');
		delete_post_meta($post->ID, 'contest-photo-emails');
		} 
  }
}
}

//Twice a day voting
if ( ! wp_next_scheduled( 'twicedaily_voting' ) ) {
  wp_schedule_event( time(), 'twicedaily', 'twicedaily_voting' );
}

add_action( 'twicedaily_voting', 'twicedaily_voting_function' );

function twicedaily_voting_function() {
  global $wpdb;
    $sql= $wpdb->get_results("SELECT id FROM ".$wpdb->prefix."photo_contest_list WHERE vote_frequency = 3 and jury = 1");
	if (!empty($sql)){
    foreach ( $sql as $item ) {    
	$args = array( 
        'post_type'      => 'attachment', 
        'post_status'    => 'any', 
		'posts_per_page'=> -1, 
        'post_parent'    => null,
        'meta_key'       => 'photo-related-to-contest',
		'meta_value'     => $item->id,
		
        );	
	$attachments = get_posts( $args );
	
	foreach ( $attachments as $post ) {
		delete_post_meta($post->ID, 'contest-photo-ip');
		delete_post_meta($post->ID, 'contest-photo-users');
		delete_post_meta($post->ID, 'contest-photo-emails');
		} 
  }
}
}

//Hourly Voting
if ( ! wp_next_scheduled( 'hourly_voting' ) ) {
  wp_schedule_event( time(), 'hourly', 'hourly_voting' );
}

add_action( 'hourly_voting', 'hourly_voting_function' );

function hourly_voting_function() {
    global $wpdb;
    $sql= $wpdb->get_results("SELECT id FROM ".$wpdb->prefix."photo_contest_list WHERE vote_frequency = 4 and jury = 1");
	if (!empty($sql)){
    foreach ( $sql as $item ) {    
	$args = array( 
        'post_type'      => 'attachment', 
        'post_status'    => 'any', 
		'posts_per_page'=> -1, 
        'post_parent'    => null,
        'meta_key'       => 'photo-related-to-contest',
		'meta_value'     => $item->id,
		
        );	
	$attachments = get_posts( $args );
	
	foreach ( $attachments as $post ) {
		delete_post_meta($post->ID, 'contest-photo-ip');
		delete_post_meta($post->ID, 'contest-photo-users');
		delete_post_meta($post->ID, 'contest-photo-emails');
		} 
  }
}
}