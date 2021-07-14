<?php

 //Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $wpdb;
$contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list ORDER BY contest_name ASC");
$photo_contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list");


add_action("admin_enqueue_scripts", "enqueue_media_uploader");

//Reset function only votes and views
if (isset ($_POST['reset-id']) and current_user_can( 'manage_options') and $_POST['reset-mode']==1) {
	include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-contests-functions.php");
	pc_reset_votes($_POST['reset-id']);
	wp_redirect(admin_url().'admin.php?page=photo-contest-tools&success=1');
}
//Reset function whole contest
if (isset ($_POST['reset-id']) and current_user_can( 'manage_options') and $_POST['reset-mode']==2) {
	include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-contests-functions.php");
	pc_reset_the_contest($_POST['reset-id']);
	wp_redirect(admin_url().'admin.php?page=photo-contest-tools&success=1');
}
//Export users function
if (isset ($_POST['send']) and current_user_can( 'manage_options') and isset($_POST['selected_contest'])) {
	include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-export-data.php");
	 $contest_id = $_POST['selected_contest'];
	 pc_export_users($contest_id);
}
//Edit users tool
if (isset ($_GET['edit-user']) and current_user_can( 'manage_options')) {
  $user = get_user_by('id', $_GET['edit-user']);
  if (empty( $user )) {
    $user = get_user_by('email', $_GET['edit-user']);
  }
  if (empty( $user )) {
    $user = get_user_by('login', $_GET['edit-user']);
  }
  if (!empty( $user )) {
	   include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-edit-user.php");
  }
}
//Save edit user
if (isset ($_GET['edit-user']) and current_user_can( 'manage_options') and isset($_POST['dateofbirth']) and !empty( $user )) {
   pc_save_edit_user($user->ID);
}
//Save edit user meta for contest
if (isset ($_GET['edit-user']) and current_user_can( 'manage_options') and isset($_POST['custom_field_optional']) and !empty( $user ) and isset ($_GET['contest_id'])) {
   pc_save_edit_user_contest_meta($user->ID);
}
//Check Tools section
if (isset ($_GET['items']) and empty ($_GET['items'])
or !isset ($_GET['items'])) {
    include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-tools.php");
}
//Check Tools section
if (isset ($_GET['items']) and !empty ($_GET['items']) and current_user_can( 'manage_options')) {
    include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-add-images.php");
}
