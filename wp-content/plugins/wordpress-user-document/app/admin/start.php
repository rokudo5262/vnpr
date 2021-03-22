<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\View;
use Zufusion\Core\Classes\Form;
use Zufusion\Core\Classes\Model;
use Zufusion\Core\Helpers\Apphelper;

class WUD_Admin_Start {
	/**
	 * Current app
	 *
	 * @var null
	 */
	public $app = null;

	/**
	 * View object of current app
	 *
	 * @var View|null
	 */
	public $view = null;

	/**
	 * WUD_Admin_Start constructor.
	 *
	 * @param $app
	 */
	public function __construct( $app ) {
		$this->app  = $app;
		$this->view = new View( $app );


		// Load correct list table classes for current screen.
		add_action( 'current_screen', array( $this, 'setup_screen' ) );
		add_action( 'check_ajax_referer', array( $this, 'setup_screen' ) );
		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_post_updated_messages' ), 10, 2 );
		add_action( 'admin_notices', 'wud_show_notices', 0 );
		add_action( 'update_option_wud_settings_options', array( $this, 'settings_after_save' ), 10, 3 );
		add_action( 'admin_enqueue_scripts', array( $this, 'assets' ), 100 );
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 0 );
		add_action( 'add_meta_boxes', array( $this, 'forms_add_custom_box' ) );

		// User Profile List
		add_action( 'show_user_profile', array( $this, 'show_user_likes' ) );
		add_action( 'edit_user_profile', array( $this, 'show_user_likes' ) );
		/*
		 * Init extra_publish_options_save() on save_post action
		 */
		add_action( 'wp_insert_post_data', array( $this, 'before_data' ), 10, 2 );
		add_action( 'save_post_wud-doc', array( $this, 'extra_options_save' ), 10, 3 );

		add_filter( 'post_row_actions', array( $this, 'remove_quick_edit' ), 10, 1 );

	}

	/**
	 * Change messages when a post type is updated.
	 *
	 * @param array $messages Array of messages.
	 *
	 * @return array
	 */
	public function post_updated_messages( $messages ) {
		global $post;

		$messages['wud-doc'] = array(
			0  => '', // Unused. Messages start at index 1.
			/* translators: %s: Product view URL. */
			1  =>  sprintf( wp_kses( __( 'Document updated. <a href="%s">View Document</a>', 'wud' ) , array(
				'a' => array(
					'href' => true
				)
			) ), esc_url( get_permalink( $post->ID ) )),
			2  => esc_html__( 'Custom field updated.', 'wud' ),
			3  => esc_html__( 'Custom field deleted.', 'wud' ),
			4  => esc_html__( 'Document updated.', 'wud' ),
			5  => esc_html__( 'Revision restored.', 'wud' ),
			/* translators: %s: document url */
			6  => sprintf( wp_kses( __( 'Document published. <a href="%s">View Document</a>', 'wud' ), array( 'a' => array( 'href' => true ) )) , esc_url( get_permalink( $post->ID ) ) ),
			7  => esc_html__( 'Document saved.', 'wud' ),
			/* translators: %s: document url */
			8  => sprintf( wp_kses( __( 'Document submitted. <a target="_blank" href="%s">Preview document</a>', 'wud' ), array( 'a' => array( 'href' => true , 'target' => true ) )), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
			9  => sprintf(
			/* translators: 1: date 2: document url */
				wp_kses( __( 'Document scheduled for: %1$s. <a target="_blank" href="%2$s">Preview document</a>', 'wud' ), array(
					'a' => array( 'href' => true, 'target' => true ),
					'strong' => array(),
                )),
				'<strong>' . date_i18n( esc_html__( 'M j, Y @ G:i', 'wud' ), strtotime( $post->post_date ) ),
				esc_url( get_permalink( $post->ID ) ) . '</strong>'
			),
			/* translators: %s: document url */
			10 => sprintf( wp_kses( __( 'Document draft updated. <a target="_blank" href="%s">Preview document</a>', 'wud' ), array( 'a' => array( 'href' => true , 'target' => true ) ) ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
		);


		return $messages;
	}

	/**
	 * Specify custom bulk actions messages for different post types.
	 *
	 * @param array $bulk_messages Array of messages.
	 * @param array $bulk_counts Array of how many objects were updated.
	 *
	 * @return array
	 */
	public function bulk_post_updated_messages( $bulk_messages, $bulk_counts ) {
		$bulk_messages['wud-doc'] = array(
			/* translators: %s: document count */
			'updated'   => _n( '%s document updated.', '%s documents updated.', $bulk_counts['updated'], 'wud' ),
			/* translators: %s: document count */
			'locked'    => _n( '%s document not updated, somebody is editing it.', '%s documents not updated, somebody is editing them.', $bulk_counts['locked'], 'wud' ),
			/* translators: %s: document count */
			'deleted'   => _n( '%s document permanently deleted.', '%s documents permanently deleted.', $bulk_counts['deleted'], 'wud' ),
			/* translators: %s: document count */
			'trashed'   => _n( '%s document moved to the Trash.', '%s documents moved to the Trash.', $bulk_counts['trashed'], 'wud' ),
			/* translators: %s: document count */
			'untrashed' => _n( '%s document restored from the Trash.', '%s documents restored from the Trash.', $bulk_counts['untrashed'], 'wud' ),
		);

		return $bulk_messages;
	}


	 public function before_data( $data, $postarr ) {

		if ( isset( $postarr['wud_approved'] ) ) {
			$approved = $postarr['wud_approved'];
			if ( $approved == - 1 ) {
				$data['post_status'] = 'trash';
			}

		}

		return $data;
	}


	/**
	 * Adds meta boxes document
	 */
	public function forms_add_custom_box() {
		add_meta_box(
			'wud_forms_doc_file',
			esc_html__( 'Document file', 'wud' ),
			array( $this, 'forms_doc_file' ),
			'wud-doc',
			'normal',
			'high'
		);
		add_meta_box(
			'wud_forms_privacy',
			esc_html__( 'Privacy', 'wud' ),
			array( $this, 'forms_doc_privacy' ),
			'wud-doc',
			'side',
			'high'
		);
		add_meta_box(
			'wud_forms_license',
			esc_html__( 'License', 'wud' ),
			array( $this, 'forms_doc_license' ),
			'wud-doc',
			'side',
			'default'
		);

	}

	/**
	 * Display document file meta box
	 *
	 * @param $post
	 * @param $metabox
	 */
	public function forms_doc_file( $post, $metabox ) {
		global $wud;

		$form      = new Form();
		$doc_model = Model::get_instance( 'doc', $wud );
		$doc       = $doc_model->get_doc( $post->ID );

		$versions = $doc_model->get_versions( $post->ID );

		$this->view->render( 'layout/metabox_file', array(
			'versions'  => $versions,
			'doc_model' => $doc_model,
			'doc'       => $doc,
			'form'      => $form,
		) );

	}

	/**
	 * Display privacy meta box
	 *
	 * @param $post
	 * @param $metabox
	 */
	public function forms_doc_privacy( $post, $metabox ) {
		global $wud, $wud_settings;

		$doc_model = Model::get_instance( 'doc', $wud );
		$doc       = $doc_model->get_doc( $post->ID );
		$form      = new Form();
		$this->view->render( 'layout/metabox_privacy', array(
			'doc_model'    => $doc_model,
			'doc'          => $doc,
			'form'         => $form,
			'wud_settings' => $wud_settings,
		) );

	}


	/**
	 * Display license meta box
	 *
	 * @param $post
	 * @param $metabox
	 */
	public function forms_doc_license( $post, $metabox ) {
		global $wud;

		$license_model = Model::get_instance( 'licenses', $wud );
		list( $total, $licenses ) = $license_model->get_licenses();
		$doc_model = Model::get_instance( 'doc', $wud );
		$doc       = $doc_model->get_doc( $post->ID );
		$form      = new Form();

		$this->view->render( 'layout/metabox_license', array(
			'doc_model' => $doc_model,
			'doc'       => $doc,
			'form'      => $form,
			'licenses'  => $licenses,
		) );

	}

	public function setup_screen() {
		global $wc_list_table;

		$screen_id = false;

		if ( function_exists( 'get_current_screen' ) ) {
			$screen    = get_current_screen();
			$screen_id = isset( $screen, $screen->id ) ? $screen->id : '';
		}

		if ( ! empty( $_REQUEST['screen'] ) ) {
			$screen_id = wp_unslash( $_REQUEST['screen'] );
		}
		switch ( $screen_id ) {
			case 'edit-wud-doc':
				$this->app->app_require_once( 'app/includes/list-tables/docs-table-list.php' );
				$wc_list_table = new WUD_Docs_Table_List();
				break;
		}

		// Ensure the table handler is only loaded once. Prevents multiple loads if a plugin calls check_ajax_referer many times.
		remove_action( 'current_screen', array( $this, 'setup_screen' ) );
		remove_action( 'check_ajax_referer', array( $this, 'setup_screen' ) );
	}

	/**
	 * @param $actions
	 *
	 * @return mixed
	 */
	public function remove_quick_edit( $actions ) {
		global $post_type;
		if ( $post_type == 'wud-doc' ) {
			unset( $actions['inline hide-if-no-js'] );
		}

		return $actions;
	}

	/**
     * Save extra options
     *
	 * @param $post_id
	 * @param $post
	 * @param $update
	 */
	public function extra_options_save( $post_id, $post, $update ) {
		global $wud_settings, $wud;

		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		@ini_set( 'max_execution_time', 0 );

		$doc_model = Model::get_admin_instance( 'doc', $wud );

		// doc metadata
		$doc_meta = array();
		if ( isset( $_POST['wud_params']['version'] ) ) {
			$doc_meta['version'] = sanitize_text_field( $_POST['wud_params']['version'] );
		}
		if ( isset( $_POST['wud_params']['email_attachment'] ) ) {
			$doc_meta['email_attachment'] = intval( $_POST['wud_params']['email_attachment'] );
		}
		if ( isset( $_POST['wud_params']['visibility_by'] ) ) {
			$doc_meta['visibility_by'] = sanitize_key( $_POST['wud_params']['visibility_by'] );
		}
		if ( isset( $_POST['wud_params']['comment_by'] ) ) {
			$doc_meta['comment_by'] = sanitize_key( $_POST['wud_params']['comment_by'] );
		}
		if ( isset( $_POST['wud_params']['edit_by'] ) ) {
			$doc_meta['edit_by'] = sanitize_key( $_POST['wud_params']['edit_by'] );
		}

		// BuddyPress Group
        $group_id = isset( $_POST['group_id'] ) ? sanitize_key( $_POST['group_id'] ) : '';
        wud_set_term_group_doc($post_id, $group_id);

        if (isset($doc_meta['visibility_by'])) {
            wud_set_access_doc($post_id, $doc_meta['visibility_by'], $group_id, 'wud-access');
        }
        if (isset($doc_meta['edit_by'])) {
            wud_set_access_doc($post_id, $doc_meta['edit_by'], $group_id, 'wud-edit-access');
        }

        if (isset($doc_meta['comment_by'])) {
            wud_set_access_doc($post_id, $doc_meta['comment_by'], $group_id, 'wud-comment-access');
        }

		$doc_model->update_meta( $post_id, $doc_meta );
		$doc = $doc_model->get_doc( $post_id );

		$featured = isset( $_POST['wud_featured'] ) ? intval( $_POST['wud_featured'] ) : 0;
		update_post_meta( $post_id, 'wud_doc_featured', $featured );

		$approved = isset( $_POST['wud_approved'] ) ? intval( $_POST['wud_approved'] ) : 0;
		if ( $approved === -1 ) {
			$reject_enable_notification = $wud_settings->get_input_value( 'reject_enable_notification', 'yes' );
			if ($reject_enable_notification == 'yes') {
				WUD_Email::send_reject_doc_notification( $doc, sanitize_textarea_field( $_POST['reject_notify'] ) );
			}

			wud_store_notices( 'reject', '', true, 'Document' );
			wp_safe_redirect( admin_url( 'edit.php?post_type=wud-doc' ) );
			exit();
		} else {
			if ( $approved == 1 && $doc['approved'] == 0 ) {
				$aprrove_enable_notification = $wud_settings->get_input_value( 'aprroved_enable_notification', 'yes' );
				if ($aprrove_enable_notification == 'yes') {
					WUD_Email::send_approved_doc_notification( $doc );
                }
				wud_store_notices( 'approved', '', true, 'Document' );
			}
		}

		update_post_meta( $post_id, 'wud_doc_approved', $approved );


		$allow_download = isset( $_POST['wud_allow_download'] ) ? intval( $_POST['wud_allow_download'] ) : 0;
		update_post_meta( $post_id, 'wud_doc_allow_download', $allow_download );


		$doc_license = isset( $_POST['wud_doc_license'] ) ? intval( $_POST['wud_doc_license'] ) : 0;
		update_post_meta( $post_id, 'wud_doc_license', $doc_license );



		$object          = 'Document';

        // delete versions
		$delete_versions = Apphelper::get_var( 'doc_version_delete', 'POST', 'none', array() );
		$delete_versions = array_map('intval', $delete_versions);
		$chosen_version  = Apphelper::get_var( 'doc_version_chosen', 'POST', 'int' );

		if ( $chosen_version && ! in_array( $chosen_version, $delete_versions ) ) {
			$version = $doc_model->get_version( $chosen_version );
			if ( $version['real_file'] != $doc['real_file'] ) {
				$doc_model->update_meta( $post_id, array(
					'ext'       => $version['ext'],
					'size'      => $version['size'],
					'real_file' => $version['real_file'],
				) );
			}
		}

		if ( ! empty( $delete_versions ) && in_array( $chosen_version, $delete_versions )) {
			wud_store_notices( 'error', esc_html__( "Can't delete selected file, please try again", 'wud' ), false, $object );
			return;
		} else {
			foreach ( $delete_versions as $version_id ) {
				$doc_model->delete_version( $version_id );
			}
        }

		// doc file
		$file = Apphelper::get_var( 'wud_doc_file', 'FILES', 'none', array() );
		if ( ! empty( $file ) && $file['name'] !== '' ) {

			$limit       = $wud_settings->get_input_value( 'max_upload_filesize', 10 );
			$filesize_mb = number_format_i18n( $file['size'] / MB_IN_BYTES, 0 );

			if ( $filesize_mb > $limit ) {
				wud_store_notices( 'error', $file['name'] . sprintf( esc_html__( " is not uploaded because file size is larger %d MB. You can config maximum file size to be uploaded in the settings page", 'wud') , $limit ), false, $object );

				return;
			}

			$ext = strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) );

			$allowed_ext = $wud_settings->get_exts();

			if ( ! in_array( $ext, $allowed_ext ) ) {
				wud_store_notices( 'error', $file['name'] . esc_html__( ' this type of file is not allowed to be uploaded. You can config file types in the settings page', 'wud' ), false, $object );

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

				$doc_model->update_meta( $post_id, array(
					'real_file' => $newname,
					'ext'       => $ext,
					'size'      => $file['size']
				) );

				$doc = $doc_model->get_doc( $post_id );
				$doc_model->add_version( $doc );
			} else {
				wud_store_notices( 'error', $file['name'] . esc_html__( ' error while uploading', 'wud' ), false, $object );

				return;
			}

		}

	}

	/**
     * Save settings
	 * @param $old
	 * @param $new
	 * @param $option
	 */
	public function settings_after_save( $old, $new, $option ) {
		if (isset( $new['roles'] )) {

			global $wp_roles;

			$roles_old = $old['roles'];
			$roles_new = $new['roles'];
			$roles = $wp_roles->role_objects;
			$caps  = wud_get_caps();

			foreach ( $roles as $role_key => $role ) {

				$role_caps = isset( $roles_new[ $role_key ] ) ? $roles_new[ $role_key ] : array();

				foreach ( $caps as $cap_key => $cap ) {

					if ( in_array( $cap_key, $role_caps ) ) {
						$role->add_cap( $cap_key );
					} else {
						if ( $cap_key == 'wud_settings' && $role_key == 'administrator' ) {

						} else {
							$role->remove_cap( $cap_key );
						}

					}

				}

			}

			wud_store_notices( 'update', '', true, 'Settings' );
        }

		do_action('wud_save_settings');
	}

	/**
	 * Admin menu page
	 */
	public function admin_menu() {
		add_submenu_page( 'edit.php?post_type=wud-doc', esc_html__( 'Manage Licenses', 'wud' ), esc_html__( 'Manage Licenses', 'wud' ), 'wud_license', 'wud-licenses', array( $this, 'manage_licenses' ) );
		add_submenu_page( 'edit.php?post_type=wud-doc', esc_html__( 'Add License', 'wud' ), esc_html__( 'Add License', 'wud' ), 'wud_add_license', 'wud-add-license', array( $this, 'add_license' ) );
		add_submenu_page( 'edit.php?post_type=wud-doc', esc_html__( 'Settings', 'wud' ), esc_html__( 'Settings', 'wud' ), 'wud_settings', 'wud-settings', array( $this, 'settings' ) );
		register_setting( 'wud_settings_fields', 'wud_settings_options' );
	}

	/**
	 * Display form license
	 */
	public function add_license() {
		$this->app->start( 'license', 'index' );
	}

	/**
	 * Manage licenses
	 */
	public function manage_licenses() {
		$this->app->start( 'licenses', 'index' );
	}

	/**
	 * Settings page
	 */
	public function settings() {
		$this->app->start( 'settings', 'index' );
	}

	/**
	 * Load scripts
	 */
	public function assets() {
		global $typenow;

		$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) )  : '';

		if ( $page == 'wud-docs' || $page == 'wud-settings' || $page == 'wud-add-license' || $page == 'wud-licenses' ) {
			wp_enqueue_style( 'fontawesome', ZUFUSION_MU_PLUGIN_VENDOR_URL . 'fortawesome/font-awesome/css/all.min.css', array(), null );
			wp_enqueue_style( 'bootstrap', ZUFUSION_MU_PLUGIN_VENDOR_URL . 'twbs/bootstrap/dist/css/bootstrap.min.css', array(), null );
			wp_enqueue_script( 'bootstrap', ZUFUSION_MU_PLUGIN_VENDOR_URL . 'twbs/bootstrap/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), null, true );
			add_thickbox();
			wp_enqueue_media();
		}

		if ( $page == 'wud-settings' ) {
			wp_enqueue_style( 'wud-settings', $this->app->plugin_url . 'app/admin/assets/css/settings.css', array(), null );
			wp_enqueue_script( 'wud-settings', $this->app->plugin_url . 'app/admin/assets/js/settings.js', array( 'jquery' ), null, true );
		} else {
			if ( $typenow == 'wud-doc' ) {
				wp_enqueue_script( 'parsley', $this->app->plugin_url . 'vendor/assets/parsley/parsley.min.js', array( 'jquery' ), null, true );
				wp_enqueue_style( 'wud-doc', $this->app->plugin_url . 'app/admin/assets/css/doc.css', array(), null );
				wp_enqueue_script( 'wud-doc', $this->app->plugin_url . 'app/admin/assets/js/doc.js', array( 'jquery' ), null, true );
				wp_localize_script( 'wud-doc', 'wud_vars', array(
					'ajaxurl' => esc_url( $this->app->get_ajax_url() ),
					'translate' => array(
						'max_file_size' => esc_html__( 'This file should not be larger than %s MB', 'wud' ),
					)
				) );
			}
		}

		if ( $page == 'wud-add-license' || $page == 'wud-licenses' ) {
			wp_enqueue_script( 'wud-add-license', $this->app->plugin_url . 'app/admin/assets/js/license.js', array( 'jquery' ), null, true );
		}

	}

	/**
	 * Show liked documents of user
	 *
	 * @param $user
	 */
	public function show_user_likes( $user ) { ?>
        <table class="form-table">
            <tr>
                <th><label for="user_likes"><?php esc_html_e( 'You Like:', 'wud' ); ?></label></th>
                <td>
					<?php
					$types      = get_post_types( array( 'public' => true ) );
					$args       = array(
						'numberposts' => - 1,
						'post_type'   => $types,
						'meta_query'  => array(
							array(
								'key'     => 'wud_user_liked',
								'value'   => $user->ID,
								'compare' => 'LIKE'
							)
						)
					);
					$sep        = '';
					$like_query = new WP_Query( $args );
					if ( $like_query->have_posts() ) : ?>
                        <p>
							<?php while ( $like_query->have_posts() ) : $like_query->the_post();
								echo esc_attr( $sep ); ?><a href="<?php the_permalink(); ?>"
                                                title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								<?php
								$sep = ' &middot; ';
							endwhile;
							?>
                        </p>
					<?php else : ?>
                        <p><?php esc_html_e( 'You do not like anything yet.', 'wud' ); ?></p>
					<?php
					endif;
					wp_reset_postdata();
					?>
                </td>
            </tr>
        </table>
	<?php }


}
