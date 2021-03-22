<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Model;

/**
 * Class wudDocModel
 */
class wudDocModel extends Model {

	/**
	 * Get current model when model was setted ID
	 *
	 * @return array|bool|WP_Post|null
	 */
	public function get_current_doc() {
		return $this->get_doc( $this->get_id() );
	}

	/**
	 * Get a document by object or ID
	 *
	 * @param $row
	 *
	 * @return array|bool|WP_Post|null
	 */
	public function get_doc( $row ) {
		global $wud_settings, $wud;
		$doc = is_numeric( $row ) ? get_post( $row, ARRAY_A ) : (array) $row;

		if ( $doc == null || $doc == false ) {
			return false;
		}

		$doc['name'] = $doc['post_title'];

		$featured       = get_post_meta( $doc['ID'], 'wud_doc_featured', true );
		$approved       = get_post_meta( $doc['ID'], 'wud_doc_approved', true );
		$allow_download = get_post_meta( $doc['ID'], 'wud_doc_allow_download', true );
		$count          = get_post_meta( $doc['ID'], 'wud_doc_count', true );
		$download       = get_post_meta( $doc['ID'], 'wud_doc_download', true );
		$likes          = get_post_meta( $doc['ID'], 'wud_post_like_count', true );

		if ( $count == '' ) {
			$count = 0;
			update_post_meta( $doc['ID'], 'wud_doc_count', $count );
		}
		if ( $download == '' ) {
			$download = 0;
			update_post_meta( $doc['ID'], 'wud_doc_download', $download );
		}

		if ( $likes == '' ) {
			$likes = 0;
			update_post_meta( $doc['ID'], 'wud_post_like_count', $likes );
		}

		$license         = get_post_meta( $doc['ID'], 'wud_doc_license', true );

		$metadata = get_post_meta( $doc['ID'], 'wud_doc_metadata', true );

		foreach ( $this->defined_meta_fields() as $key ) {
			if ( isset( $metadata[ $key ] ) ) {
				$doc[ $key ] = $metadata[ $key ];
			} else {
				$doc[ $key ] = '';
			}
		}

		$doc['featured']        = (int) $featured;
		$doc['approved']        = (int) $approved;
		$doc['allow_download']  = (int) $allow_download;
		$doc['download']        = (int) $download;
		$doc['count']           = (int) $count;
		$doc['likes']           = (int) $likes;
		$doc['license']         = (int) $license;
		$doc['group_id']        = (string) wud_get_doc_group_id( $doc['ID'] );

		$category = get_the_terms( $doc['ID'], 'wud-category' );
		$tags     = get_the_terms( $doc['ID'], 'wud-tag' );
		if ( is_array( $tags ) && ! empty( $tags ) ) {
			$items = wp_list_pluck( $tags, 'slug' );
			$tags  = implode( ",", $items );
		}

		$doc['tags'] = (string) $tags;
		if ( $category ) {
			$items = wp_list_pluck( $category, 'term_id' );
			$doc['category'] = $items;
		} else {
			$doc['category'] = array();
		}


		$extension_preview = explode( ',', $wud_settings->get_input_value( 'extension_preview', 'doc,docx,ppt,pptx,pps,xls,xlsx,pdf,ps,odt,odp,sxw,sxi,txt,rtf' ) );
		$extension_preview = array_map( 'trim', $extension_preview );

		$model_token = $this->get_model( 'token', 'admin' );
		$token       = $model_token->store_token();


		if ( in_array( $doc['ext'], $extension_preview ) ) {
			$doc['url_viewer'] = wud_get_viewer_url( $doc['ID'], $token );
		}

		$url_base      = $wud_settings->get_input_value( 'url_base', 'document' );
		$perlink       = get_option( 'permalink_structure' );
		$nonce = wp_create_nonce( 'download-file' );

		if ($doc['ext'] == 'pdf') {
			$doc['url_viewer_iframe_browser'] = $wud->get_admin_ajax_url() . '&controller=doc&task=download&doc_id=' . $doc['ID'] . '&preview=1' . ( $token != '' ? '&token=' . $token : '' );

			if ( strpos( $perlink, 'index.php' ) ) {
				$doc['url_viewer_pdf'] = get_site_url() . '/index.php/' . $url_base . '/preview/'.$nonce .'/'.$token.'/' . $doc['ID'] . '/' . $doc['name'] . $doc['ext'];
			} else {
				$doc['url_viewer_pdf'] = get_site_url() . '/' . $url_base . '/preview/'.$nonce .'/'.$token.'/' . $doc['ID'] . '/' . $doc['name'] . $doc['ext'];
			}

		}

		if ( ! empty( $rewrite_rules ) ) {

			if ( strpos( $perlink, 'index.php' ) ) {
				$doc['link_download'] = get_site_url() . '/index.php/' . $url_base . '/file/' . $doc['ID'] . '/' . $doc['name'];

			} else {
				$doc['link_download'] = get_site_url() . '/' . $url_base . '/file/' . $doc['ID'] . '/' . $doc['name'];
			}

			if ( isset( $doc['ext'] ) ) {
				$doc['link_download'] .= '.' . $doc['ext'];
			};

		} else {

			$doc['link_download'] = $this->app->get_admin_ajax_url() . '&controller=doc&task=download&&doc_id=' . $doc['ID'];
		}

		$doc['link_download'] = $doc['link_download'] . '&nonce=' . $nonce . '&token=' . $token;


		return $doc;
	}

	/**
	 * Add a new document
	 *
	 * @param array $data data for document
	 *
	 * @return bool|int|WP_Error
	 *
	 */
	public function add( $data = array() ) {

		$args = array(
			'post_title'   => $data['post_title'],
			'post_name'    => sanitize_title( $data['post_title'] ),
			'post_content' => $data['post_content'],
			'post_excerpt' => $data['post_excerpt'],
			'post_status'  => 'publish',
			'post_type'    => 'wud-doc',
		);

		$id = wp_insert_post( $args );

		if ( $id ) {
			$this->save_extra($id, $data);
			return $id;
		}

		return false;
	}

	/**
	 * Update a document
	 *
	 * @param int $id document ID.
	 * @param array $data data for document.
	 *
	 * @return bool|void
	 */
	public function update( $id = 0, $data = array() ) {

		$args = array(
			'ID'            => $id,
			'post_title'    => $data['post_title'],
			'post_name'     => sanitize_title( $data['post_title'] ),
			'post_content'  => $data['post_content'],
			'post_excerpt'  => $data['post_excerpt'],
			'post_modified' => date( 'Y-m-d H:i:s' ),
			'post_type'     => 'wud-doc',
		);

		if (isset($data['post_status'])) {
			$args['post_status'] = $data['post_status'];
		}

		wp_update_post( $args );
		$this->save_extra($id, $data);
		return true;
	}

	/**
	 * @param $id
	 * @param $data
	 */
	public function save_extra($id, $data) {

		$this->update_meta( $id, $data );

		if ( isset( $data['featured'] ) ) {
			update_post_meta( $id, 'wud_doc_featured', (int)$data['featured'] );
		}
		if ( isset( $data['approved'] ) ) {
			update_post_meta( $id, 'wud_doc_approved', (int)$data['approved'] );
		}

		if ( isset( $data['allow_download'] ) ) {
			update_post_meta( $id, 'wud_doc_allow_download', (int)$data['allow_download'] );
		}
		if ( isset( $data['license'] ) ) {
			update_post_meta( $id, 'wud_doc_license', (int)$data['license'] );
		}
		if ( isset( $data['count'] ) ) {
			update_post_meta( $id, 'wud_doc_count', (int)$data['count'] );
		}
		if ( isset( $data['download'] ) ) {
			update_post_meta( $id, 'wud_doc_download', (int)$data['download'] );
		}

		if ( isset( $data['like_post'] ) ) {
			update_post_meta( $id, 'wud_post_like_count', (int)$data['like_post'] );
		}

		if ( isset( $data['group_id'] )) {
			wud_set_term_group_doc($id, $data['group_id']);
			wud_set_access_doc($id, $data['visibility_by'], $data['group_id'], 'wud-access');
			if ( isset( $data['edit_by'] ) ) {
				wud_set_access_doc($id, $data['edit_by'], $data['group_id'], 'wud-edit-access');
			}

			wud_set_access_doc($id, $data['comment_by'], $data['group_id'], 'wud-comment-access');
		} else {
			wud_set_access_doc($id, $data['visibility_by'], 0, 'wud-access');
			if ( isset( $data['edit_by'] ) ) {
				wud_set_access_doc($id, $data['edit_by'], 0, 'wud-edit-access');
			}
			wud_set_access_doc($id, $data['comment_by'], 0, 'wud-comment-access');
		}

		// category
		wp_set_post_terms( $id, $data['category'], 'wud-category' );
		// tag
		wp_set_post_terms( $id, $data['tags'], 'wud-tag' );
	}

	/**
	 * Update document metadata
	 * @param $id
	 * @param $data
	 */
	public function update_meta( $id, $data ) {
		$metadata    = (array) get_post_meta( $id, 'wud_doc_metadata', true );
		$meta_fields = $this->defined_meta_fields();
		foreach ( $meta_fields as $key ) {
			if ( isset( $data[ $key ] ) ) {
				$metadata[ $key ] = $data[ $key ];
			}
		}

		update_post_meta( $id, 'wud_doc_metadata', $metadata );
	}

	/**
	 * Define fields for document metadata
	 * @return array
	 */
	public function defined_meta_fields() {
		return array(
			'ext',
			'size',
			'real_file',
			'version',
			'visibility_by',
			'comment_by',
			'edit_by',
			'email_attachment',
		);
	}

	/**
	 * Get featured value by document ID
	 *
	 * @param $id
	 *
	 * @return int
	 */
	public function get_featured( $id ) {
		$featured = get_post_meta( $id, 'wud_doc_featured', true );

		return (int) $featured;
	}

	/**
	 * Set featured value by document ID
	 *
	 * @param $id
	 * @param $featured
	 */
	public function set_featured( $id, $featured ) {
		update_post_meta( $id, 'wud_doc_featured', (int) $featured );
	}

	/**
	 * Get approved value by document ID
	 *
	 * @param $id
	 *
	 * @return int
	 */
	public function get_approved( $id ) {
		$approved = get_post_meta( $id, 'wud_doc_approved', true );

		return (int) $approved;
	}

	/**
	 * Set approved value by document ID
	 *
	 * @param $id
	 * @param $approved
	 */
	public function set_approved( $id, $approved ) {
		update_post_meta( $id, 'wud_doc_approved', (int) $approved );
	}

	/**
	 * Get allow download value
	 *
	 * @param $id
	 *
	 * @return int
	 */
	public function get_allow_download( $id ) {
		$allow_download = get_post_meta( $id, 'wud_doc_allow_download', true );

		return (int) $allow_download;
	}

	/**
	 * Set allow download value
	 *
	 * @param $id
	 * @param $allow_download
	 */
	public function set_allow_download( $id, $allow_download ) {
		update_post_meta( $id, 'wud_doc_allow_download', (int) $allow_download );
	}

	/**
	 * Get view document counter
	 *
	 * @param $id
	 *
	 * @return int
	 */
	public function get_count( $id ) {
		$allow_download = get_post_meta( $id, 'wud_doc_count', true );

		return (int) $allow_download;
	}

	/**
	 * Set view document counter
	 *
	 * @param $id
	 * @param $count
	 */
	public function set_count( $id, $count ) {
		update_post_meta( $id, 'wud_doc_count', (int) $count );
	}

	/**
	 * Delete a document by ID
	 *
	 * @param $id
	 *
	 * @return bool|void
	 */
	public function delete( $id ) {
		$doc = $this->get_doc( $id );

		$_thumbnail_id       = get_post_meta( $id, '_thumbnail_id', true );
		$user = wp_get_current_user();

		if ( wp_delete_post( $id, true ) ) {

			$post = get_post($_thumbnail_id);
			if ($post) {
				if ($post->post_author == $user->ID) {
					wp_delete_attachment( $_thumbnail_id, true );
				}
			}

			delete_post_meta( $id, 'wud_doc_featured' );
			delete_post_meta( $id, 'wud_doc_approved' );
			delete_post_meta( $id, 'wud_doc_allow_download' );
			delete_post_meta( $id, 'wud_doc_license' );
			delete_post_meta( $id, 'wud_doc_count' );
			delete_post_meta( $id, 'wud_post_like_count' );

			$filename = wud_get_upload_folder( 0 ) . $doc['real_file'];
			if ( file_exists( $filename ) ) {
				unlink( $filename );
			}

			$versions = $this->get_versions( $id );
			if ( ! empty( $versions ) ) {
				foreach ( $versions as $version ) {
					$this->delete_version( $version['meta_id'] );
				}
			}

			return true;
		}

		return false;
	}

	/**
	 * Delete a version by ID
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	public function delete_version( $id ) {
		$version = $this->get_version( $id );
		$result  = delete_metadata_by_mid( 'post', $id );
		if ( $result ) {
			$filename = wud_get_upload_folder( 0 ) . $version['real_file'];
			if ( file_exists( $filename ) ) {
				unlink( $filename );
			}

		}

		return $result;
	}

	/**
	 * Get a version by ID
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	public function get_version( $id ) {
		$metaData = get_metadata_by_mid( 'post', $id );
		$version  = false;

		if ( $metaData !== null ) {
			$version = $metaData->meta_value;
		}

		return $version;
	}

	/**
	 * Add a version
	 *
	 * @param $doc
	 */
	public function add_version( $doc ) {
		$metadata                 = array();
		$metadata['ext']          = $doc['ext'];
		$metadata['size']         = $doc['size'];
		$metadata['version']      = $doc['version'];
		$metadata['real_file']    = $doc['real_file'];
		$metadata['created_time'] = date( 'Y-m-d H:i:s' );

		add_post_meta( $doc['ID'], 'wud_doc_version_metadata', $metadata );
	}

	/**
	 * Get versions array
	 *
	 * @param $doc_id
	 *
	 * @return array
	 */
	public function get_versions( $doc_id ) {
		global $wpdb;
		$query    = $wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s ORDER BY meta_id DESC", $doc_id, "wud_doc_version_metadata" );
		$results  = $wpdb->get_results( $query, ARRAY_A );
		$versions = array();
		if ( ! empty( $results ) ) {
			foreach ( $results as $result ) {
				$version              = unserialize( $result['meta_value'] );
				$version['meta_id']   = $result['meta_id'];
				$version['doc_id']    = $doc_id;
				$version['size_html'] = size_format( $version['size'] );
				$versions[]           = $version;
			}
		}

		return $versions;
	}

	/**
	 * Set view count for document
	 */
	public function set_view() {
		$views = (int)get_post_meta( $this->get_id(), 'wud_doc_count', true );
		$views++;
		update_post_meta( $this->get_id(), 'wud_doc_count', $views );
	}

	/**
	 * Set download count for document
	 */
	public function set_download() {
		$download = (int)get_post_meta( $this->get_id(), 'wud_doc_download', true );
		$download++;
		update_post_meta( $this->get_id(), 'wud_doc_download', $download );
	}

	/**
	 * get list term ids of taxonomy
	 *
	 * @param $taxonomy
	 *
	 * @return array|bool|false|WP_Error|WP_Term[]
	 */
	public function get_taxonomy_ids( $taxonomy ) {
		$terms = get_the_terms( $this->id, $taxonomy );
		if ( is_wp_error( $terms ) ) {
			return $terms;
		}

		if ( empty( $terms ) ) {
			return false;
		}

		$ids = array();

		foreach ( $terms as $term ) {
			$ids[] = $term->term_id;
		}

		return $ids;
	}

	/**
	 * Get status approved or pending
	 *
	 * @param int $id
	 *
	 * @return int
	 */
	public function get_status( $id = 0 ) {
		$id = $id > 0 ? $id : $this->get_id();

		return $this->get_approved( $id ) == 1 ? 'approved' : 'pending';
	}

	/**
	 * Get license name
	 *
	 * @param int $id
	 *
	 * @return int
	 */
	public function get_license( $id = 0 ) {
		$id = $id > 0 ? $id : $this->get_id();

		$license_id = get_post_meta( $id, 'wud_doc_license', true );

		if ( $license_id ) {
			$license_model = $this->get_model( 'license', 'admin' );
			$license       = $license_model->get_license( $license_id );

			return $license;
		}

		return false;
	}

	/**
	 * Check allow user/anyone comment by role
	 *
	 * @param int $doc
	 *
	 * @return bool
	 */
	public function allow_comment( $doc = 0 ) {
		$document    = is_array( $doc ) ? $doc : $this->get_current_doc();
		$user        = wp_get_current_user();
		$role_values = array( 'anyone' );
		if ( $user->ID ) {

			$user_roles  = $user->roles;
			$role_values = array_merge( $role_values, $user_roles );
		}

		if ( in_array( $document['comment_role'], $role_values ) ) {
			return true;
		}

		return false;
	}

}
