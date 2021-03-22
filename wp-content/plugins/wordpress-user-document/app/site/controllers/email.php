<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Controller;
use Zufusion\Core\Helpers\Apphelper;

/**
 * Class wudEmailController
 */
class wudEmailController extends Controller {

	/**
	 * Send email the document to emails
	 */
	public function Send() {
		$val               = Apphelper::get_var( 'val', 'POST', 'none' );
		$id                = intval( $val['id'] );
		$subject           = sanitize_text_field( $val['subject'] );
		$message           = sanitize_textarea_field( $val['message'] );
		$to                = sanitize_email( $val['to'] );
		$message           = wp_specialchars_decode( nl2br( $message ) );
		$email_array       = preg_split( '/[,\s]+/', urldecode( $to ) );
		$email_array_valid = array();

		foreach ( $email_array as $email ) {
			if ( is_email( $email ) ) {
				$email_array_valid[] = $email;
			}
		}

		$email = implode( ',', $email_array_valid );

		$doc_model = $this->get_model( 'doc', 'admin' );
		$doc       = $doc_model->get_doc( $id );


		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem();
		$fs = new WP_Filesystem_Direct( array() );

		$blogname    = get_option( 'blogname' );
		$headers     = "MIME-Version: 1.0\r\n" . "From: " . $blogname . " " . "<" . $email . ">\n" . "Content-Type: text/HTML; charset=\"" . get_option( 'blog_charset' ) . "\"\r\n";
		$attachments = array();

		$file_path      = wud_get_upload_folder( 0 ) . $doc['real_file'];
		$temp_file_path = wud_get_upload_folder( 'temp' ) . $doc['name'] . '.' . $doc['ext'];

		$exclude = wud_app()->query->get_exclude_doc_ids();
		if (  !in_array($doc['ID'], $exclude) && $doc['email_attachment'] == 1 && $doc['allow_download'] == 1 ) {
			if ( file_exists( $file_path ) ) {
				$fs->copy( $file_path, $temp_file_path, true );
				$attachments[] = $temp_file_path;
			}
		}

		wp_mail( $email, $subject, $message, $headers, $attachments );

		if ( file_exists( $temp_file_path ) ) {
			$fs->delete( $temp_file_path );
		}

		$response            = array();
		$response['message'] = esc_html__( 'Sent email successfully', 'wud' );
		wp_send_json( $response );
	}
}