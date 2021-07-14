<?php

if (!defined('WPINC')) {
    die;
}
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();

$createQuery = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "photo_contest_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `related_to_contest` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) $charset_collate;";
$wpdb->query($createQuery);

$createQuery = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."photo_contest_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote_date` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ip_address` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `country_code` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) $charset_collate;";
$wpdb->query($createQuery);

$createQuery = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "photo_contest_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `contest_name` longtext COLLATE utf8_general_ci NOT NULL,
  `contest_start` longtext COLLATE utf8_general_ci NOT NULL,
  `contest_end` longtext COLLATE utf8_general_ci NOT NULL,
  `contest_vote_start` longtext COLLATE utf8_general_ci NOT NULL,
  `contest_register_end` longtext COLLATE utf8_general_ci NOT NULL,
  `contest_rows` int(11) NOT NULL,
  `contest_columns` int(11) NOT NULL,
  `image_per_user` int(11) NOT NULL,
  `vote_frequency` int(11) NOT NULL,
  `contest_condition` longtext COLLATE utf8_general_ci NOT NULL,
  `menu_color` longtext COLLATE utf8_general_ci NOT NULL,
  `menu_style` longtext COLLATE utf8_general_ci NOT NULL,
  `hide_up` int(11) NOT NULL DEFAULT 1,
  `hide_top` int(11) NOT NULL DEFAULT 1,
  `hide_your` int(11) NOT NULL DEFAULT 1,
  `hide_rules` int(11) NOT NULL DEFAULT 1,
  `hide_author` int(11) NOT NULL DEFAULT 1,
  `hide_votes` int(11) NOT NULL DEFAULT 1,
  `hide_views` int(11) NOT NULL DEFAULT 1,
  `hide_login` int(11) NOT NULL DEFAULT 1,
  `hide_social` int(11) NOT NULL DEFAULT 1,
  `hide_select_bar` int(11) NOT NULL DEFAULT 1,
  `ip_protection` int(11) NOT NULL DEFAULT 1,
  `date_of_birth` int(11) NOT NULL DEFAULT 1,
  `city` int(11) NOT NULL DEFAULT 1,
  `adress` int(11) NOT NULL DEFAULT 1,
  `zip_code` int(11) NOT NULL DEFAULT 1,
  `state` int(11) NOT NULL DEFAULT 1,
  `country` int(11) NOT NULL DEFAULT 1,
  `gender` int(11) NOT NULL DEFAULT 1,
  `gender_3` int(11) NOT NULL DEFAULT 1,
  `www` int(11) NOT NULL DEFAULT 1,
  `phone` int(11) NOT NULL DEFAULT 1,
  `fb_page` int(11) NOT NULL DEFAULT 1,
  `twitter_page` int(11) NOT NULL DEFAULT 1,
  `instagram_page` int(11) NOT NULL DEFAULT 1,
  `camera_model` int(11) NOT NULL DEFAULT 1,
  `description` int(11) NOT NULL DEFAULT 2,
  `custom_field_personal` int(11) NOT NULL DEFAULT 1,
  `custom_field_personal_name` longtext COLLATE utf8_general_ci NULL,
  `custom_field_image` int(11) NOT NULL DEFAULT 1,
  `custom_field_image_name` longtext COLLATE utf8_general_ci NULL,
  `agree_terms` int(11) NOT NULL DEFAULT 1,
  `agree_age_13` int(11) NOT NULL DEFAULT 1,
  `agree_age_18` int(11) NOT NULL DEFAULT 1,
  `gallery_layout` int(11) NOT NULL DEFAULT 1,
  `gallery_layout_color` varchar(10) COLLATE utf8_general_ci NOT NULL DEFAULT '#3dc0f1',
  `gallery_order` int(11) NOT NULL DEFAULT 1,
  `page_id_secondary` int(11) NOT NULL DEFAULT 0,
  `page_id_third` int(11) NOT NULL DEFAULT 0,
  `custom_field_personal_required` int(11) NOT NULL DEFAULT 1,
  `custom_field_personal_name_required` longtext COLLATE utf8_general_ci NULL,
  `jury` int(11) NOT NULL DEFAULT 1,
  `jury_votes` int(11) NOT NULL DEFAULT 1,
  `jury_members` longtext COLLATE utf8_general_ci NULL,
  `jury_vote_type` int(11) NOT NULL DEFAULT 1,
  `allow_user_edit` int(11) NOT NULL DEFAULT 1,
  `contest_mode` int(11) NOT NULL DEFAULT 1,
  `ip_list` longtext COLLATE utf8_general_ci NULL,
  `user_vote_list` longtext COLLATE utf8_general_ci NULL,
  `email_list` longtext COLLATE utf8_general_ci NULL,
  `force_registration` int(11) NOT NULL DEFAULT 1,

  UNIQUE KEY `id` (`id`)
) $charset_collate;";
$wpdb->query($createQuery);

$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_cat` LIKE 'related_to_contest'");
if (empty($result)) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_cat` ADD `related_to_contest` int(11) NOT NULL DEFAULT 0 ");
}
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'hide_up'");
if (empty($result)) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_up` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_top` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_your` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_rules` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_author` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_votes` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_views` int(11) NOT NULL DEFAULT 1");
}
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'ip_protection'");
if (empty($result)) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `ip_protection` int(11) NOT NULL DEFAULT 1");
}
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'date_of_birth'");
if (empty($result)) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `date_of_birth` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `city` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `adress` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `zip_code` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `state` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `country` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `gender` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `gender_3` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `www` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `phone` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `fb_page` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `twitter_page` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `instagram_page` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `camera_model` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `description` int(11) NOT NULL DEFAULT 2");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `custom_field_personal` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `custom_field_personal_name` longtext COLLATE utf8_general_ci NULL");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `custom_field_image` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `custom_field_image_name` longtext COLLATE utf8_general_ci NULL");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `agree_terms` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `agree_age_13` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `agree_age_18` int(11) NOT NULL DEFAULT 1");
}
//From version 2.8
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'gallery_layout'");
if (empty($result)) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `gallery_layout` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `page_id_secondary` int(11) NOT NULL DEFAULT 0");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `custom_field_personal_required` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `custom_field_personal_name_required` longtext COLLATE utf8_general_ci NULL");
}
//From version 3.0
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'jury'");
if (empty($result)) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `jury` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `jury_votes` int(11) NOT NULL DEFAULT 1");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `jury_members` longtext COLLATE utf8_general_ci NULL");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `allow_user_edit` int(11) NOT NULL DEFAULT 1");
}
//From version 3.1
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'contest_mode'");
if (empty($result)) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `contest_mode` int(11) NOT NULL DEFAULT 1");
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_login` int(11) NOT NULL DEFAULT 1 AFTER `hide_views`");
}
//From version 3.3
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'ip_list'");
if (empty($result)) {
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `ip_list` longtext COLLATE utf8_general_ci NULL");
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `user_vote_list` longtext COLLATE utf8_general_ci NULL");
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_social` int(11) NOT NULL DEFAULT 1 AFTER `hide_login`");
  $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `email_list` longtext COLLATE utf8_general_ci NULL");
}
//From version 3.4
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'gallery_layout_color'");
if (empty($result)) {
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `gallery_layout_color` varchar(10) COLLATE utf8_general_ci NOT NULL DEFAULT '#3dc0f1' AFTER `gallery_layout`");
}
//From version 4.0
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'jury_vote_type'");
if (empty($result)) {
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `jury_vote_type` int(11) NOT NULL DEFAULT 1 AFTER `jury_members`");
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `gallery_order` int(11) NOT NULL DEFAULT 1 AFTER `gallery_layout_color`");
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `page_id_third` int(11) NOT NULL DEFAULT 0 AFTER `page_id_secondary`");
}
//From version 4.1
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_votes` LIKE 'vote_rating_value'");
if (empty($result)) {
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_votes` ADD `vote_rating_value` varchar(100) CHARACTER SET utf8 DEFAULT 'v1'");
  $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_votes` ADD `remove_vote` int(11) NOT NULL DEFAULT 1");
}
$result = $wpdb->query("SHOW COLUMNS FROM `" . $wpdb->prefix . "photo_contest_list` LIKE 'force_registration'");
if (empty($result)) {
	$wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `force_registration` int(11) NOT NULL DEFAULT 1");
  $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "photo_contest_list` ADD `hide_select_bar` int(11) NOT NULL DEFAULT 1");
}
