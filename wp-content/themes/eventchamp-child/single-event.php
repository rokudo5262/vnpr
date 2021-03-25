<?php
/**
	* The template for displaying single event
*/
//Bắt thời gian bắt đầu của sự kiện theo ID
$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
$event_start_time = get_post_meta( get_the_ID(), 'event_start_time', true );

$date_now = date( 'Y-m-d H:i' );

$event_start_date_last = "";
if( !empty( $event_start_date ) && !empty( $event_start_time ) ) {
	$event_start_date_last = date_format( date_create( $event_start_date . $event_start_time ), 'Y-m-d H:i' );
}

//Nếu sự kiện chưa diễn ra thì dùng FRONTEND: single-event-not-started.php
if( !empty( $event_start_date ) && !empty( $event_start_time ) && $event_start_date_last >= $date_now ) {
	include 'include/single-event-not-started.php';
} else {
	include 'include/single-event-started.php';
}