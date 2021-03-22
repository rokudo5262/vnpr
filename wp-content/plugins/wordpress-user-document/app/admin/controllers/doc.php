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

class wudDocController extends Controller {

	/**
	 * Toggle featured/UnFeatured
	 */
	public function Featured() {
		if ( current_user_can( 'edit_posts' ) && check_admin_referer( 'wud-feature-doc' ) && isset( $_GET['doc_id'] ) ) {

			$doc_model = $this->get_model( 'doc' );
			$doc_id = absint( $_GET['doc_id'] );
			$doc = $doc_model->get_doc( $doc_id );

			if ( $doc ) {
				$doc_model->set_featured( $doc_id, ! $doc_model->get_featured( $doc_id ) );
			}

		} else {
			wud_store_notices( 'error', esc_html__( 'You don\'t have the permission', 'wud' ), false );
		}

		wp_safe_redirect( wp_get_referer() ? remove_query_arg( array(
			'trashed',
			'untrashed',
			'deleted',
			'ids'
		), wp_get_referer() ) : admin_url( 'edit.php?post_type=wud-doc' ) );
		exit;
	}

	/**
	 * Toggle Approved/UnApproved
	 */
	public function Approved() {

		if ( current_user_can( 'edit_posts' ) && check_admin_referer( 'wud-approved-doc' ) && isset( $_GET['doc_id'] ) ) {

			$doc_model = $this->get_model( 'doc' );
			$doc_id = absint( $_GET['doc_id'] );
			$doc = $doc_model->get_doc( $doc_id );

			if ( $doc ) {

				$doc_model->set_approved( $doc_id, ! $doc_model->get_approved( $doc_id ) );
				if ( $doc_model->get_approved( $doc_id ) && $doc['approved'] == 0 ) {
					WUD_Email::send_approved_doc_notification( $doc );
					wud_store_notices( 'approved', '', true, 'Document' );
				}

			}

		} else {
			wud_store_notices( 'error', esc_html__( 'You don\'t have the permission', 'wud' ), false );
		}

		wp_safe_redirect( wp_get_referer() ? remove_query_arg( array(
			'trashed',
			'untrashed',
			'deleted',
			'ids'
		), wp_get_referer() ) : admin_url( 'edit.php?post_type=wud-doc' ) );
		exit;
	}

	/**
	 * Toggle allow download
	 */
	public function Allowdownload() {

		if ( current_user_can( 'edit_posts' ) && check_admin_referer( 'wud-allow-download-doc' ) && isset( $_GET['doc_id'] ) ) {

			$doc_model = $this->get_model( 'doc' );
			$doc_id = absint( $_GET['doc_id'] );
			$doc = $doc_model->get_doc( $doc_id );

			if ( $doc ) {
				$doc_model->set_allow_download( $doc_id, ! $doc_model->get_allow_download( $doc_id ) );
			}

		} else {
			wud_store_notices( 'error', esc_html__( 'You don\'t have the permission', 'wud' ), false );
		}

		wp_safe_redirect( wp_get_referer() ? remove_query_arg( array(
			'trashed',
			'untrashed',
			'deleted',
			'ids'
		), wp_get_referer() ) : admin_url( 'edit.php?post_type=wud-doc' ) );
		exit;
	}

	/**
	 * Get access options
	 */
	public function Getaccessoptions() {

		$group_id = absint( $_POST['group_id'] );
		$access_option = '';
		$edit_option = '';
		if ($group_id) {
			$options = wud_get_access_groups();
		} else {
			$options = wud_get_access_roles();
		}

		$edit_options = $options;
		unset($edit_options['anyone']);

		foreach ( $options as $key => $option ) {
			$access_option .= '<option value="'.esc_attr( $key) .'">'.esc_html__( $option ).'</option>';
		}

		$edit_option .= '<option value="">'.esc_html__('Not set', 'wud').'</option>';

		foreach ( $edit_options as $key2 => $option2 ) {
			$edit_option .= '<option value="'.esc_attr( $key2) .'">'.esc_html__( $option2 ).'</option>';
		}

		echo wp_json_encode(array('access_options' => $access_option, 'edit_option' => $edit_option));
		exit();
	}
	/**
	 * Download file or preview
	 */
	public function Download() {

		global $wud_settings;
		$doc_id      = Apphelper::get_var( 'doc_id', 'GET', 'int' );
		$preview     = Apphelper::get_var( 'preview', 'GET', 'int', '' );
		$nonce_value = Apphelper::get_var( 'nonce', 'GET', 'string', '' );

		$doc_model = $this->get_model( 'doc', 'admin' );
		$doc_model->set_id( $doc_id );
		$doc = $doc_model->get_doc( $doc_id );

		if ( $preview == 1 ) {
			$contenType = wud_mime_type( $doc['ext'] );
		} else {
			$contenType = 'application/octet-stream';

			// check logged in
			if ($wud_settings->get_input_value( 'logged_in_download', 'yes') == 'yes' ) {
				if ( ! is_user_logged_in() ) {
					wp_safe_redirect( wp_login_url( wud_get_current_url() ) );
					exit();
				}
			}

		}

		// detect block ips
		if ( wud_block_ips() ) {
			wp_die( esc_html__( 'You was blocked', 'wud' ) );
		}

		if ( ! empty( $doc ) && $doc['ID'] ) {
			if ( ! isset( $_GET['preview'] ) ) {

				if ( ! wp_verify_nonce( $nonce_value, 'download-file' ) ) {
					wp_die( esc_html__( 'Action is not permitted', 'wud' ) );
				}
			} else if ( $preview === 1 ) {
				// check if hack download
				$user_agent = $_SERVER['HTTP_USER_AGENT'];
				if ( strpos( $user_agent, 'drive.google.com' ) !== false || $wud_settings->get_input_value( 'preview_by', 'google_viewer') == 'pdfjs') {

				} else {
					wp_die( esc_html__( 'Can not preview/download', 'wud' ) );
				}
			}

			// Visibility by
			$exclude_docs = wud_app()->query->get_exclude_doc_ids();
			if (( in_array($doc['ID'], $exclude_docs) || !$doc['allow_download'])  && $preview == '') {
				// apply for not preview
				wp_die( esc_html__( 'Not permitted', 'wud' ) );
			}

			// check token
			$token = Apphelper::get_var( 'token', 'GET', 'none', '' );
			if ( $token == '' ) {
				wp_die( esc_html__( 'Token is empty', 'wud' ) );
			}

			$model_token = $this->get_model( 'token', 'admin' );
			// remove tokens expired
			$model_token->remove_tokens();

			if ( $token_id = $model_token->token_exists( $token ) ) {
				$model_token->update_token( $token_id );
			} else {
				wp_die( esc_html__( 'Token is expired', 'wud' ) );
			}

			$file_path = wud_get_upload_folder( 0 ) . $doc['real_file'];

			if ( file_exists( $file_path ) ) {

				@set_time_limit( 0 );
				@ob_end_clean();
				ob_start();
				if ( $preview == 1 ) {
					header( "Access-Control-Allow-Origin: *" );
					header( "Access-Control-Allow-Credentials: true" );
				}

				$open_browser = $wud_settings->get_input_value( 'preview_by', 'google_viewer') == 'browser' ? 'inline' : 'attachment';
				header( 'Content-Description: File Transfer' );
				header( 'Content-Type: ' . $contenType );
				header( 'Content-Disposition: attachment; filename=' . basename( $doc['name'] . '.' . $doc['ext'] ) );
				header( 'Content-Transfer-Encoding: binary' );
				header( 'Expires: 0' );
				header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
				header( 'Pragma: public' );
				header( 'Content-Length: ' . filesize( $file_path ) );
				ob_clean();
				flush();
				readfile( $file_path );
			}

			$doc_model->set_download();

		} else {
			exit( esc_html__( 'The document doesn\'t exist', 'wud' ) );
		}

		exit();

	}

}