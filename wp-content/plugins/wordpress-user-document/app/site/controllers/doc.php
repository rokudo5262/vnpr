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
 * Class wudDocController
 */
class wudDocController extends Controller {

	/**
	 * Save and and update a document if the
	 * form was submitted through the user account page.
	 */
	public function Save() {

		global $wud_settings;

		if ( ! wud_check_post_file_size() ) {
			wud_store_notices( 'error', esc_html__( 'The file is too large', 'wud' ), false );

			return;
		}

		$nonce_value = Apphelper::get_var( 'wud-edit-doc-nonce', 'POST', 'string', '' );

		if ( ! wp_verify_nonce( $nonce_value, 'wud-edit-doc' ) ) {
			return;
		}

		$action  = sanitize_text_field( $_POST['action'] );
		if ( empty( $action ) ) {
			return;
		}

		$user = wp_get_current_user();

		if ( $user->ID <= 0 ) {
			return;
		}

		$post_id = intval( $_POST['post_id'] );

		$doc_model = $this->get_model( 'doc', 'admin' );


		$object = 'Document';


		$doc = false;
		$data = array();
		$data['post_title'] = sanitize_post_field( 'post_title', $_POST['post_title'], 0, 'db' );
		$data['post_content'] = sanitize_post_field( 'post_content', $_POST['post_content'], 0, 'db' );
		$data['post_excerpt'] = sanitize_post_field( 'post_excerpt', $_POST['post_excerpt'], 0, 'db' );
		$data['license'] = sanitize_key( $_POST['license'] );
		$data['allow_download'] = absint( $_POST['allow_download'] );
		$data['email_attachment'] = absint( $_POST['email_attachment'] );
		$data['version'] = sanitize_text_field( $_POST['version'] );
		$data['visibility_by'] = sanitize_key( $_POST['visibility_by'] );
		$data['comment_by'] = sanitize_key( $_POST['comment_by'] );

		if (isset($_POST['edit_by'])) {
			$data['edit_by'] = sanitize_key( $_POST['edit_by'] );
		}

		if (isset($_POST['group_id'])) {
			$data['group_id'] = sanitize_key( $_POST['group_id'] );
		}
		$data['category'] = array_map( 'sanitize_key', wp_unslash( $_POST['category'] ) );
		$data['tags'] = sanitize_text_field( $_POST['tags'] );
		if ( $post_id && $action === 'update' ) {
			$doc = $doc_model->get_doc( $post_id );
			$post_author = $doc['post_author'];
			$data['post_author'] = $post_author;
			if (!wud_user_can_edit_doc($doc)) {
				wud_store_notices( 'error', esc_html__( 'You don\'t have permission to edit the document', 'wud' ), false, $object );
				return;
			}

			$doc_model->update( $post_id,  $data);
		}

		//
		$delete_versions = Apphelper::get_var( 'version_delete', 'POST', 'none', array() );
		$delete_versions = array_map('intval', $delete_versions);
		$chosen_version  = Apphelper::get_var( 'version_chosen', 'POST', 'int' );

		if ( $chosen_version && ! in_array( $chosen_version, $delete_versions ) ) {
			$version = $doc_model->get_version( $chosen_version );
			if ( $version['real_file'] !== $doc['real_file'] ) {
				if ( $post_id ) {
					$doc_model->update_meta( $post_id, array(
						'ext'       => $version['ext'],
						'size'      => $version['size'],
						'real_file' => $version['real_file'],
					) );
				}
			}
		}

		// Delete versions
		if ( ! empty( $delete_versions ) && in_array( $chosen_version, $delete_versions )) {
			wud_store_notices( 'error', esc_html__( "Can't delete selected file, please try again", 'wud' ), false, $object );
			return;
		} else {
			foreach ( $delete_versions as $version_id ) {
				$doc_model->delete_version( $version_id );
			}
		}
		// Valid document image
		$image = Apphelper::get_var( 'doc_image', 'FILES', 'none', '' );
		if ( is_array( $image ) && $image['name'] !== '' ) {
			$wp_filetype = wp_check_filetype_and_ext( $image['tmp_name'], $image['name'] );

			if ( ! wp_match_mime_types( 'image', $wp_filetype['type'] ) ) {
				wud_store_notices( 'error', $image['name'] . esc_html__( ' The uploaded file is not a valid image. Please try again.', 'wud' ), false );

				return;
			}
		}

		// doc file
		$file = Apphelper::get_var( 'doc_file', 'FILES', 'none', array() );
		if ( is_array( $file ) && $file['name'] != '' ) {

			$limit       = $wud_settings->get_input_value( 'max_upload_filesize', 10 );
			$filesize_mb = number_format_i18n( $file['size'] / MB_IN_BYTES, 0 );
			if ( $filesize_mb > $limit ) {
				wud_store_notices( 'error', $file['name'] . sprintf( esc_html__(" is not uploaded because file size is larger %d MB.", 'wud'), $limit ), false, $object );

				return;
			}

			$ext = strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) );

			$allowed_ext = $wud_settings->get_exts();

			if ( ! in_array( $ext, $allowed_ext ) ) {
				wud_store_notices( 'error', $file['name'] . esc_html__( ' this type of file is not allowed to be uploaded. you can only upload file with type of file is: ', 'wud' ) . implode( ', ', $allowed_ext ), false, $object );

				return;
			}

			$folder_path = wud_get_upload_folder( 0 );

			if ( $file['error'] == 0 ) {

				$newname = uniqid() . '.' . $ext;

				if ( ! move_uploaded_file( $file['tmp_name'], $folder_path . $newname ) ) {
					wud_store_notices( 'error', $file['name'] . esc_html__( " can't be uploaded file", 'wud' ), false, $object );

					return;
				}

				chmod( $folder_path . $newname, 0777 );

				if ( $action == 'add' && $post_id == 0 ) {
					$check_id = $doc_model->add( $data );
					if ( $check_id ) {
						// set default is un-approve
						$doc_model->set_approved( $check_id, 0 );
						$post_id = $check_id;
					}
				}

				$doc_model->update_meta( $post_id, array(
					'real_file' => $newname,
					'ext'       => $ext,
					'size'      => $file['size']
				) );

				$doc = $doc_model->get_doc( $post_id );
				$doc_model->add_version( $doc );
			} else {
				if ( $action == 'add' ) {
					wud_store_notices( 'error', esc_html__( 'Please select a document file to upload' ), false, $object );

					return;
				} else if ( $action == 'update' ) {
					$versions = $doc_model->get_versions( $post_id );
					if ( empty( $versions ) ) {
						wud_store_notices( 'error', esc_html__( 'Please select a document file to upload' ), false, $object );

						return;
					}
				}

			}

		}

		// document image
		if ( intval( $_POST['_thumbnail_id'] ) == - 1 ) {

			$attachment_id = get_post_meta( $post_id, '_thumbnail_id', true );
			wp_delete_attachment( $attachment_id, true );

			if ( is_array( $image ) && $image['name'] != '' ) {

				if ( ! function_exists( 'media_handle_upload' ) ) {
					require_once( ABSPATH . '/wp-admin/includes/media.php' );
					require_once( ABSPATH . '/wp-admin/includes/file.php' );
					require_once( ABSPATH . '/wp-admin/includes/image.php' );
				}

				$thumbnail_id = media_handle_upload( 'doc_image', $post_id );

				if ( is_wp_error( $thumbnail_id ) ) {
					wud_store_notices( 'error', $image['name'] . $thumbnail_id->get_error_message(), false );
				} else {
					set_post_thumbnail( $post_id, $thumbnail_id );
				}

			}

		}

		if ( $action == 'add' ) {
			// send email to admin when user is submitted a new document
			if ( $wud_settings->get_input_value( 'new_enable_notification', 'yes' ) == 'yes' ) {
				WUD_Email::send_new_doc_notification( $doc );
			}

			// Auto approve when user is submitted a new document
			$user_roles = $user->roles;
			if ( $wud_settings->get_input_value( 'auto_approve', '' ) != '' && in_array( $wud_settings->get_input_value( 'auto_approve', '' ), $user_roles ) ) {
				$doc_model->set_approved( $post_id, 1 );
				$aprrove_enable_notification = $wud_settings->get_input_value( 'aprroved_enable_notification', 'yes' );
				if ($aprrove_enable_notification == 'yes') {
					WUD_Email::send_approved_doc_notification( $doc );
				}
				wud_store_notices( 'approved', '', true, 'Document' );
			} else {
				$message_added = $wud_settings->get_input_value( 'submission_message', '' ) != '' ? $wud_settings->get_input_value( 'submission_message', '' ) : esc_html__( 'Document has been successfully submitted, the admin needs to review the document, and the publish (if approved), or reject (if not approved).' );
				wud_store_notices( 'submit', $message_added, true, $object );
			}

		} else {
			// send email to admin when a document is updated
			if ( $wud_settings->get_input_value( 'update_enable_notification', 'yes' ) == 'yes' ) {
				WUD_Email::send_update_doc_notification( $doc );
			}

			wud_store_notices( $action, '', true, $object );
			wp_safe_redirect( wud_get_account_endpoint_url( 'edit-document', $post_id ) );
			exit;
		}

		wp_safe_redirect( wud_get_page_permalink( 'my-account' ) );
		exit;
	}

	/**
	 * Delete a doc
	 */
	public function Delete() {

		global $wud_settings;

		$nonce_value = Apphelper::get_var( '_wpnonce', 'REQUEST', 'string', '' );

		if ( ! wp_verify_nonce( $nonce_value, 'wud-delete-doc' ) ) {
			return;
		}

		$user = wp_get_current_user();

		if ( $user->ID <= 0 ) {
			return;
		}
		$delete  = intval( $_GET['wud_delete_doc'] );
		$post_id = intval( $_GET['wud_delete_doc_id'] );
		$doc_model = $this->get_model( 'doc', 'admin' );
		$object = 'Document';

		if ( $post_id ) {

			$doc = $doc_model->get_doc( $post_id );
			if (!wud_user_can_edit_doc($doc)) {
				wud_store_notices( 'error', esc_html__( 'You don\'t have permission to edit the document', 'wud' ), false, $object );
				return;
			}

			// delete doc of author

			if ( $delete == 1 && $doc['post_author'] == $user->ID && $wud_settings->get_input_value( 'user_can_delete', 'yes' ) == 'yes' ) {
				if ( $doc_model->delete( $post_id ) ) {
					wud_store_notices( 'delete', '', true, $object );
					$delete_redirect = apply_filters( 'wud_delete_redirect', wud_get_page_permalink( 'my-account' ) );
					wp_safe_redirect( $delete_redirect );
					exit;
				}
			}

		}

	}
	/**
	 * Like/DisLike
	 */
	public function Like() {

		// Security
		$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : 0;
		if ( ! wp_verify_nonce( $nonce, 'wud-likes-nonce' ) ) {
			exit( esc_html__( 'Not permitted', 'wud' ) );
		}
		// Test if javascript is disabled
		$disabled = ( isset( $_REQUEST['disabled'] ) && sanitize_text_field( $_REQUEST['disabled'] ) == true ) ? true : false;
		// Test if this is a comment
		$is_comment = ( isset( $_REQUEST['is_comment'] ) && intval( $_REQUEST['is_comment'] ) == 1 ) ? 1 : 0;
		// Base variables
		$post_id    = ( isset( $_REQUEST['post_id'] ) && is_numeric( $_REQUEST['post_id'] ) ) ? intval( $_REQUEST['post_id'] )  : '';
		$result     = array();
		$post_users = null;
		$like_count = 0;
		// Get plugin options
		if ( $post_id != '' ) {
			$count = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "wud_comment_like_count", true ) : get_post_meta( $post_id, "wud_post_like_count", true ); // like count
			$count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;
			if ( ! wud_already_liked( $post_id, $is_comment ) ) { // Like the post
				if ( is_user_logged_in() ) { // user is logged in
					$user_id    = get_current_user_id();
					$post_users = wud_post_user_likes( $user_id, $post_id, $is_comment );
					if ( $is_comment == 1 ) {
						// Update User & Comment
						$user_like_count = get_user_option( "wud_comment_like_count", $user_id );
						$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
						update_user_option( $user_id, "wud_comment_like_count", ++ $user_like_count );
						if ( $post_users ) {
							update_comment_meta( $post_id, "wud_user_comment_liked", $post_users );
						}
					} else {
						// Update User & Post
						$user_like_count = get_user_option( "wud_user_like_count", $user_id );
						$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
						update_user_option( $user_id, "wud_user_like_count", ++ $user_like_count );
						if ( $post_users ) {
							update_post_meta( $post_id, "wud_user_liked", $post_users );
						}
					}
				} else { // user is anonymous
					$user_ip    = wud_get_ip();
					$post_users = wud_post_ip_likes( $user_ip, $post_id, $is_comment );
					// Update Post
					if ( $post_users ) {
						if ( $is_comment == 1 ) {
							update_comment_meta( $post_id, "wud_user_comment_ip", $post_users );
						} else {
							update_post_meta( $post_id, "wud_user_ip", $post_users );
						}
					}
				}
				$like_count         = ++ $count;
				$response['status'] = "liked";
				$response['icon']   = wud_get_liked_icon();
			} else { // Unlike the post
				if ( is_user_logged_in() ) { // user is logged in
					$user_id    = get_current_user_id();
					$post_users = wud_post_user_likes( $user_id, $post_id, $is_comment );
					// Update User
					if ( $is_comment == 1 ) {
						$user_like_count = get_user_option( "wud_comment_like_count", $user_id );
						$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
						if ( $user_like_count > 0 ) {
							update_user_option( $user_id, "wud_comment_like_count", -- $user_like_count );
						}
					} else {
						$user_like_count = get_user_option( "wud_user_like_count", $user_id );
						$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
						if ( $user_like_count > 0 ) {
							update_user_option( $user_id, 'wud_user_like_count', -- $user_like_count );
						}
					}
					// Update Post
					if ( $post_users ) {
						$uid_key = array_search( $user_id, $post_users );
						unset( $post_users[ $uid_key ] );
						if ( $is_comment == 1 ) {
							update_comment_meta( $post_id, "wud_user_comment_liked", $post_users );
						} else {
							update_post_meta( $post_id, "wud_user_liked", $post_users );
						}
					}
				} else { // user is anonymous
					$user_ip    = wud_get_ip();
					$post_users = wud_post_ip_likes( $user_ip, $post_id, $is_comment );
					// Update Post
					if ( $post_users ) {
						$uip_key = array_search( $user_ip, $post_users );
						unset( $post_users[ $uip_key ] );
						if ( $is_comment == 1 ) {
							update_comment_meta( $post_id, "wud_user_comment_ip", $post_users );
						} else {
							update_post_meta( $post_id, "wud_user_ip", $post_users );
						}
					}
				}
				$like_count         = ( $count > 0 ) ? -- $count : 0; // Prevent negative number
				$response['status'] = "unliked";
				$response['icon']   = wud_get_unliked_icon();
			}
			if ( $is_comment == 1 ) {
				update_comment_meta( $post_id, "wud_comment_like_count", $like_count );
				update_comment_meta( $post_id, "wud_comment_like_modified", date( 'Y-m-d H:i:s' ) );
			} else {
				update_post_meta( $post_id, "wud_post_like_count", $like_count );
				update_post_meta( $post_id, "wud_post_like_modified", date( 'Y-m-d H:i:s' ) );
			}
			$response['count']   = wud_get_like_count( $like_count );
			$response['testing'] = $is_comment;
			if ( $disabled == true ) {
				if ( $is_comment == 1 ) {
					wp_redirect( get_permalink( get_the_ID() ) );
					exit();
				} else {
					wp_redirect( get_permalink( $post_id ) );
					exit();
				}
			} else {
				wp_send_json( $response );
			}
		}
	}

}