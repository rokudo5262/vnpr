<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * WUD_Email class.
 */
class WUD_Email {

	/**
	 * Send reject message to author
	 *
	 * @param $doc
	 * @param string $message
	 */
	public static function send_reject_doc_notification( $doc, $message = '' ) {
		global $wud_settings;

		$blogname = get_option( 'blogname' );

		$reject_to = self::prepare_mail_author_content( '%author_email%', $doc['post_author'], $doc );;
		$reject_subject = $wud_settings->get_input_value( 'reject_subject', esc_html__( 'The document has been rejected', 'wud' ) ) != '' ? $wud_settings->get_input_value( 'reject_subject', esc_html__( 'The document has been rejected', 'wud' ) ) : esc_html__( 'The document has been rejected', 'wud' );
		$reject_body    = $message != '' ? $message : $wud_settings->get_input_value( 'reject_message' );


		$headers   = "MIME-Version: 1.0\r\n" . "From: " . $blogname . " " . "<" . $reject_to . ">\n" . "Content-Type: text/html; charset=\"" . get_option( 'blog_charset' ) . "\"\r\n";
		$mail_body = self::prepare_mail_author_content( $reject_body, $doc['post_author'], $doc );
		$to        = $reject_to;
		$subject   = self::prepare_mail_author_content( $reject_subject, $doc['post_author'], $doc );
		$subject   = wp_strip_all_tags( $subject );

		/**
		 * Filters admin email message
		 *
		 * @param string $message
		 * @param int $post_id
		 * */
		wp_mail( $to, $subject, apply_filters( 'wud_reject_doc_message', $mail_body, $doc['ID'] ), $headers );
	}

	/**
	 * Send approved message to author
	 *
	 * @param $doc
	 */
	public static function send_approved_doc_notification( $doc ) {
		global $wud_settings;

		$blogname = get_option( 'blogname' );

		$approved_to = self::prepare_mail_author_content( '%author_email%', $doc['post_author'], $doc );;
		$approved_subject = $wud_settings->get_input_value( 'approved_subject', esc_html__( 'The document has been approved', 'wud' ) ) != '' ? $wud_settings->get_input_value( 'approved_subject', esc_html__( 'The document has been approved', 'wud' ) ) : esc_html__( 'The document has been approved', 'wud' );
		$approved_body    = $wud_settings->get_input_value( 'approved_message', "Hi %author%, \r\nYour document has been approved. \r\n\r\nHere is the details: \r\nDocument Title: %post_title% \r\nContent: %post_content% \r\nAuthor: %author% \r\nDocument URL: %permalink%" );


		$headers   = "MIME-Version: 1.0\r\n" . "From: " . $blogname . " " . "<" . $approved_to . ">\n" . "Content-Type: text/html; charset=\"" . get_option( 'blog_charset' ) . "\"\r\n";
		$mail_body = self::prepare_mail_author_content( $approved_body, $doc['post_author'], $doc );
		$to        = $approved_to;
		$subject   = self::prepare_mail_author_content( $approved_subject, $doc['post_author'], $doc );
		$subject   = wp_strip_all_tags( $subject );

		/**
		 * Filters admin email message
		 *
		 * @param string $message
		 * @param int $post_id
		 * */
		wp_mail( $to, $subject, apply_filters( 'wud_approved_doc_message', $mail_body, $doc['ID'] ), $headers );
	}

	/**
	 * Prepare for author content
	 *
	 * @param $content
	 * @param $user_id
	 * @param $doc
	 *
	 * @return mixed
	 */
	public static function prepare_mail_author_content( $content, $user_id, $doc ) {
		$user = get_user_by( 'id', $user_id );

		$doc_field_search = [
			'%post_title%',
			'%post_content%',
			'%post_excerpt%',
			'%tags%',
			'%category%',
			'%author%',
			'%author_email%',
			'%author_bio%',
			'%sitename%',
			'%siteurl%',
			'%permalink%'
		];

		$doc_field_replace = [
			$doc['post_title'],
			$doc['post_content'],
			$doc['post_excerpt'],
			get_the_term_list( $doc['ID'], 'wud-tag', '', ', ' ),
			get_the_term_list( $doc['ID'], 'wud-category', '', ', ' ),
			$user->display_name,
			$user->user_email,
			( $user->description ) ? $user->description : 'not available',
			get_bloginfo( 'name' ),
			home_url(),
			get_permalink( $doc['ID'] )
		];

		$content = str_replace( $doc_field_search, $doc_field_replace, $content );
		$content = nl2br( $content );

		return wp_specialchars_decode( $content );
	}

	//send admin notification if enabled from backend
	public static function send_new_doc_notification( $doc ) {
		global $wud_settings;

		$blogname = get_option( 'blogname' );
		$email    = get_option( 'admin_email' );

		$new_mail_body = "Hi Admin,\r\n";
		$new_mail_body .= "A new document has been created in your site %sitename% (%siteurl%).\r\n\r\n";

		$mail_body = "Here is the details:\r\n";
		$mail_body .= "Document Title: %post_title%\r\n";
		$mail_body .= "Content: %post_content%\r\n";
		$mail_body .= "Author: %author%\r\n";
		$mail_body .= "Document URL: %permalink%\r\n";
		$mail_body .= 'Edit URL: %editlink%';

		$new_to      = $wud_settings->get_input_value( 'new_to', $email ) != '' ? $wud_settings->get_input_value( 'new_to', $email ) : $email;
		$new_subject = $wud_settings->get_input_value( 'new_subject', esc_html__( 'New Document Submission', 'wud' ) ) != '' ? $wud_settings->get_input_value( 'new_subject', esc_html__( 'New Document Submission', 'wud' ) ) : esc_html__( 'New Document Submission', 'wud' );
		$new_body    = $wud_settings->get_input_value( 'new_message' ) != '' ? $wud_settings->get_input_value( 'new_message' ) : $new_mail_body . $mail_body;

		$headers   = "MIME-Version: 1.0\r\n" . "From: " . $blogname . " " . "<" . $new_to . ">\n" . "Content-Type: text/html; charset=\"" . get_option( 'blog_charset' ) . "\"\r\n";
		$mail_body = self::prepare_mail_content( $new_body, $doc['post_author'], $doc );
		$to        = self::prepare_mail_content( $new_to, $doc['post_author'], $doc );
		$subject   = self::prepare_mail_content( $new_subject, $doc['post_author'], $doc );
		$subject   = wp_strip_all_tags( $subject );

		/**
		 * Filters admin email message
		 *
		 * @param string $message
		 * @param int $post_id
		 * */
		wp_mail( $to, $subject, apply_filters( 'wud_admin_new_doc_message', $mail_body, $doc['ID'] ), $headers );
	}

	/**
	 * Send update notification to admin when author updates the document
	 *
	 * @param $doc
	 */
	public static function send_update_doc_notification( $doc ) {
		global $wud_settings;

		$blogname       = get_option( 'blogname' );
		$email          = get_option( 'admin_email' );
		$edit_mail_body = "Hi Admin,\r\n";
		$edit_mail_body .= "The Document \"%post_title%\" has been updated.\r\n\r\n";

		$mail_body = "Here is the details:\r\n";
		$mail_body .= "Document Title: %post_title%\r\n";
		$mail_body .= "Content: %post_content%\r\n";
		$mail_body .= "Author: %author%\r\n";
		$mail_body .= "Document URL: %permalink%\r\n";
		$mail_body .= 'Edit URL: %editlink%';


		$update_to      = $wud_settings->get_input_value( 'update_to', $email ) != '' ? $wud_settings->get_input_value( 'update_to', $email ) : $email;
		$update_subject = $wud_settings->get_input_value( 'update_subject', esc_html__( 'The document has been updated', 'wud' ) ) != '' ? $wud_settings->get_input_value( 'update_subject', esc_html__( 'The document has been updated', 'wud' ) ) : esc_html__( 'The document has been updated', 'wud' );
		$update_body    = $wud_settings->get_input_value( 'update_message' ) != '' ? $wud_settings->get_input_value( 'update_message' ) : $edit_mail_body . $mail_body;


		$headers   = "MIME-Version: 1.0\r\n" . "From: " . $blogname . " " . "<" . $update_to . ">\n" . "Content-Type: text/html; charset=\"" . get_option( 'blog_charset' ) . "\"\r\n";
		$mail_body = self::prepare_mail_content( $update_body, $doc['post_author'], $doc );
		$to        = self::prepare_mail_content( $update_to, $doc['post_author'], $doc );
		$subject   = self::prepare_mail_content( $update_subject, $doc['post_author'], $doc );
		$subject   = wp_strip_all_tags( $subject );

		/**
		 * Filters admin email message
		 *
		 * @param string $message
		 * @param int $post_id
		 * */
		wp_mail( $to, $subject, apply_filters( 'wud_admin_update_doc_message', $mail_body, $doc['ID'] ), $headers );
	}

	/**
	 * Prepare email content
	 *
	 * @param $content
	 * @param $user_id
	 * @param $doc
	 *
	 * @return mixed
	 */
	public static function prepare_mail_content( $content, $user_id, $doc ) {
		$user = get_user_by( 'id', $user_id );

		$doc_field_search = [
			'%post_title%',
			'%post_content%',
			'%post_excerpt%',
			'%tags%',
			'%category%',
			'%author%',
			'%author_email%',
			'%author_bio%',
			'%sitename%',
			'%siteurl%',
			'%permalink%',
			'%editlink%',
		];

		$doc_field_replace = [
			$doc['post_title'],
			$doc['post_content'],
			$doc['post_excerpt'],
			get_the_term_list( $doc['ID'], 'wud-tag', '', ', ' ),
			get_the_term_list( $doc['ID'], 'wud-category', '', ', ' ),
			$user->display_name,
			$user->user_email,
			( $user->description ) ? $user->description : 'not available',
			get_bloginfo( 'name' ),
			home_url(),
			get_permalink( $doc['ID'] ),
			esc_url( admin_url( 'post.php?action=edit&post=' . $doc['ID'] ) ),
		];

		$content = str_replace( $doc_field_search, $doc_field_replace, $content );
		$content = nl2br( $content );

		return wp_specialchars_decode( $content );
	}

}