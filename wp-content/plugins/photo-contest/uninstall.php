<?php
/**
 * @package   Photo Contest WordPress Plugin
 * @author    Zbyněk Hovorka
 * @link      http://galleryplugins.com/photo-contest/
 * @copyright 2014 Zbyněk Hovorka
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
exit;

}
    //Clean all data of the contest
	delete_post_meta_by_key( 'contest-photo-ip' );
	delete_post_meta_by_key( 'contest-photo-points' );
	delete_post_meta_by_key( 'contest-photo-author' );
	delete_post_meta_by_key( 'contest-active');
	delete_post_meta_by_key( 'post_views_count');
	delete_post_meta_by_key( 'photo-related-to-contest');
	delete_post_meta_by_key( 'contest-photo-category');
	delete_post_meta_by_key( 'contest-photo-users');
	delete_post_meta_by_key( 'contest-user-name');
	delete_post_meta_by_key( 'contest-user-email');
	delete_post_meta_by_key( 'photo-upload-ip');
	delete_post_meta_by_key( 'camera-model');
	delete_post_meta_by_key( 'custom-field');
	delete_post_meta_by_key( 'contest-photo-emails');
	delete_post_meta_by_key( 'image-country');
	delete_post_meta_by_key( 'contest-photo-rate10-total');
	delete_post_meta_by_key( 'contest-photo-rate5');
	delete_post_meta_by_key( 'contest-photo-rate10');
	delete_post_meta_by_key( 'contest-photo-rate5-total');




	delete_option( 'pcplugin-contest-start' );
	delete_option( 'pcplugin-contest-end' );
	delete_option( 'pcplugin-contest-start-vote' );
	delete_option( 'pcplugin-contest-reg-ends' );
	delete_option( 'pcplugin-date-format' );
	delete_option( 'pcplugin-photo-number' );
	delete_option( 'pcplugin-photo-limit' );
	delete_option( 'pcplugin-columns-number' );
	delete_option( 'pcplugin-allow-lightbox' );
	delete_option( 'pcplugin-allow-activate' );
	delete_option( 'pcplugin-email-notification' );
	delete_option( 'pcplugin-oneday-vote' );
	delete_option( 'pcplugin-show-adminbar' );
	delete_option( 'pcplugin-maxwidth' );
	delete_option( 'pcplugin-maxheight' );
	delete_option( 'pcplugin-who-vote' );
	delete_option( 'pcplugin-condition' );
	delete_option( 'pcplugin-allow-custom-welcome-mail' );
	delete_option( 'pcplugin-email-headline' );
	delete_option( 'pcplugin-email-menu-font-color' );
	delete_option( 'pcplugin-email-menu-bg-color' );
	delete_option( 'pcplugin-email-body' );
	delete_option( 'pcplugin-disqus-code' );
	delete_option( 'pcplugin-allow-comments' );
	delete_option( 'pcplugin-allow-animation' );
	delete_option( 'pcplugin-send-login' );
	delete_option( 'pcplugin-vote-button-color' );
	delete_option( 'pcplugin-vote-icon' );
	delete_option( 'pcplugin-vote-text' );
	delete_option( 'pcplugin-vote-own-text' );
	delete_option( 'pcplugin-vote-after-text' );
	delete_option( 'pcplugin-vote-own-text-after' );
	delete_option( 'pcplugin-admin-email' );
	delete_option( 'pcplugin-admin-email-input' );
	delete_option( 'pcplugin-font-size' );
	delete_option( 'pcplugin-font' );
	delete_option( 'pcplugin-allow_buddy_images' );
	delete_option( 'pcplugin-allow_buddy_votes' );
	delete_option( 'pcplugin-allow_buddy_comments' );
	delete_option( 'pcplugin-site-key' );
	delete_option( 'pcplugin-secret-key' );
	delete_option( 'pcplugin-allow-reCaptcha' );
	delete_option( 'pcplugin-author-vote' );
	delete_option( 'pcplugin-author-vote' );
	delete_option( 'pcplugin-confirm-votes' );
	delete_option( 'pcplugin-menu-upload' );
	delete_option( 'pcplugin-menu-rules' );
	delete_option( 'pcplugin-menu-your-images' );
	delete_option( 'pcplugin-menu-top10' );
	delete_option( 'pcplugin-menu-open' );
	delete_option( 'pcplugin-menu-layout' );
	delete_option( 'pcplugin-menu-gallery' );
	delete_option( 'pcplugin-allow-GDPR' );
	delete_option( 'pcplugin-allow-GDPR-text' );
	delete_option( 'pcplugin-allow-GDPR-notice' );

	//Version 3.0
	delete_option( 'pcplugin-version' );
	delete_option( 'pcplugin-admin-new-user-email' );
	delete_option( 'pcplugin-email-filter' );

	//Version 3.1
	delete_option( 'pcplugin-redirect-after-vote' );

	//Version 3.2
	delete_option( 'pcplugin-items-number' );
	delete_option( 'pcplugin-photos-number' );

	delete_option( 'pcplugin-email-notification-about-user' );
	delete_option( 'pcplugin-email-sender' );
	delete_option( 'pcplugin-image-approval-email' );
	delete_option( 'pcplugin-image-approval-email-subject' );
	delete_option( 'pcplugin-image-approval-email-body' );


	//Version 4.1
	delete_option( 'pcplugin-rate-after-text' );
	delete_option( 'pcplugin-rate-own-text-after' );
	delete_option( 'pcplugin-header-code');
	delete_option( 'pcplugin-login-form' );
	delete_option( 'pcplugin-login-form-input' );


	global $wpdb;

	//Delete User Meta - Images number
	$contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list ORDER BY id DESC");
	   foreach ( $contests as $contest ) {

		$users = get_users(array(
          'meta_key'     => 'contest_user_images_'.$contest->id ,
        ));
		foreach ( $users as $user ) {
			delete_user_meta( $user->ID, 'contest_user_images_'.$contest->id );
			delete_user_meta( $user->ID, 'pcplugin-dateofbirth');
			delete_user_meta( $user->ID, 'pcplugin-adress');
			delete_user_meta( $user->ID, 'pcplugin-city');
			delete_user_meta( $user->ID, 'pcplugin-state');
			delete_user_meta( $user->ID, 'pcplugin-zip_code');
			delete_user_meta( $user->ID, 'pcplugin-country');
			delete_user_meta( $user->ID, 'pcplugin-gender');
			delete_user_meta( $user->ID, 'pcplugin-gender_3');
			delete_user_meta( $user->ID, 'pcplugin-www');
			delete_user_meta( $user->ID, 'pcplugin-phone');
			delete_user_meta( $user->ID, 'pcplugin-facebook');
			delete_user_meta( $user->ID, 'pcplugin-twitter');
			delete_user_meta( $user->ID, 'pcplugin-instagram');
			delete_user_meta( $user->ID, 'pcplugin-custom_field_personal');
        }



        }
  $table_contests = $wpdb->prefix."photo_contest_list";
	$table_categories = $wpdb->prefix."photo_contest_cat";
	$table_votes = $wpdb->prefix."photo_contest_votes";

	$wpdb->query("DROP TABLE IF EXISTS $table_contests");
	$wpdb->query("DROP TABLE IF EXISTS $table_categories");
	$wpdb->query("DROP TABLE IF EXISTS $table_votes");
