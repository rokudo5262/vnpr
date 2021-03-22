<?php

use Zufusion\Core\Classes\Model;

global $wp, $wud, $wud_settings;
$user      = wp_get_current_user();
$doc_id    = 0;
$doc_id    = get_query_var( 'edit-document' ) != '' ? get_query_var( 'edit-document' ) : 0;
$action    = $doc_id ? 'update' : 'add';
$doc_model = Model::get_admin_instance( 'doc', $wud );

if ( $doc_id ) {
	$doc = $doc_model->get_doc( $doc_id );
	if ( $doc ) {

		if (!wud_user_can_edit_doc($doc)) {
			echo wud_print_notices( 'error', '', false, esc_html__( 'You don\'t have permission to edit the document', 'wud' ) );

			return;
        }

	} else {
		echo wud_print_notices( 'error', '', false, esc_html__( 'Document is not exist ', 'wud' ) );

		return;
	}

	$versions = $doc_model->get_versions( $doc_id );
} else {
	$doc = array();
	$versions = array();
}

// The actual fields for data entry
$max_upload_size = wp_max_upload_size();
if ( ! $max_upload_size ) {
	$max_upload_size = 0;
}
$max_file_size_mb = number_format_i18n( $max_upload_size / MB_IN_BYTES, 0 );
?>

<div id="wud-form-document">

    <form method="post" enctype="multipart/form-data" data-parsley-validate>
        <input type="hidden" name="post_id" value="<?php echo esc_attr( $doc_id ); ?>">
        <input type="hidden" name="zufusion" value="site">
        <input type="hidden" name="zufusionapp" value="wud">
        <input type="hidden" name="controller" value="doc">
        <input type="hidden" name="task" value="save">
        <input type="hidden" name="action" value="<?php echo esc_attr( $action ); ?>">
		<?php wp_nonce_field( 'wud-edit-doc', 'wud-edit-doc-nonce' ); ?>
        <div class="form-header">
			<?php if ( $action === 'update' ) { ?>
                <a href="<?php echo esc_url( the_permalink( $doc_id ) ); ?>" target="_blank"><i
                            class="fas fa-eye"></i> <?php echo esc_html__( 'View', 'wud' ); ?></a> |
			<?php } ?>
            <a href="<?php echo esc_url( wud_get_page_permalink( 'my-account' ) ); ?>"><i
                        class="fas fa-arrow-alt-circle-left"></i> <?php echo esc_html__( 'Back', 'wud' ); ?></a>
        </div>
		<?php

		$field_options = array(
			'type'        => 'text',
			'name'        => 'post_title',
			'id'          => 'post_title',
			'value'       => isset( $doc['name'] ) ? $doc['name'] : '',
			'label_class' => 'control-label',
			'label'       => esc_attr__( 'Document title', 'wud' ),
			'class'       => 'form-control',
			'extra_attr'  => 'required=""',
			'desc'        => '',
		);

		wud_app()->form->get_field( $field_options );

		?>
        <div class="form-field-wrapper wud_text-editor">

            <label for="post_content" id="post_content_label"
                   class="control-label field-label"><?php echo esc_html__( 'Document content', 'wfd' ); ?> : </label>

			<?php
			$media_button        = $wud_settings->get_input_value( 'allow_media_uploads', 'yes' ) == 'yes' ? true : false;
			$wud_editor_settings = array(
				'wpautop'          => true,  // enable rich text editor
				'media_buttons'    => $media_button,  // enable add media button
				'textarea_name'    => 'post_content', // name
				'textarea_rows'    => '10',  // number of textarea rows
				'tabindex'         => '',    // tabindex
				'editor_css'       => '',    // extra CSS
				'editor_class'     => 'wud-rich-textarea', // class
				'teeny'            => false, // output minimal editor config
				'dfw'              => false, // replace fullscreen with DFW
				'tinymce'          => true,  // enable TinyMCE
				'quicktags'        => true,  // enable quicktags
				'drag_drop_upload' => true,  // enable drag-drop
			);
			$wud_editor_settings = apply_filters( 'wud_editor_settings', $wud_editor_settings );
			$wud_editor_content  = apply_filters( 'wud_editor_content', isset( $doc['post_content'] ) ? $doc['post_content'] : '' );
			wp_editor( $wud_editor_content, 'wudcontent', $wud_editor_settings ); ?>
        </div>

		<?php

		$field_options = array(
			'type'        => 'textarea',
			'name'        => 'post_excerpt',
			'id'          => 'post_excerpt',
			'value'       => isset( $doc['post_excerpt'] ) ? $doc['post_excerpt'] : '',
			'label'       => esc_attr__( 'Document excerpt', 'wud' ),
			'label_class' => 'control-label',
			'class'       => 'form-control',
			'desc'        => '',
		);

		wud_app()->form->get_field( $field_options );

		?>
        <div id="forms_field_post_image" class="form-field-wrapper field-image ">
            <label class="control-label field-label"><?php echo esc_html__( 'Document Image', 'wud' ); ?></label>
			<?php

			$thumbnail_id = get_post_meta( $doc_id, '_thumbnail_id', true );
			$extra_file   = $thumbnail_id ? 'class="wud-hide" data-parsley-required="false"' : 'class="wud-show" data-parsley-required="true"';
			$content      = '<input type="file" name="doc_image" id="doc_image" ' . $extra_file  . ' data-parsley-maxfilesize="' . $max_file_size_mb . '" data-parsley-fileextension="jpg,jpeg,png,gif">';
			$content      .= '<p class="description ' . ( $thumbnail_id ? 'wud-hide' : 'wud-show' ) . '">' . sprintf( esc_html__( 'Add a document image, maximum upload image size: %s.' ), esc_html( size_format( $max_upload_size ) ) ) . '</p>';
			if ( $thumbnail_id && get_post( $thumbnail_id ) ) {
				$size           = array( 266, 266 );
				$thumbnail_html = wp_get_attachment_image( $thumbnail_id, $size );

				if ( ! empty( $thumbnail_html ) ) {
					$content .= $thumbnail_html;
					$content .= '<p><a href="#" id="wud-remove-post-thumbnail">' . esc_html__( 'Remove image', 'wud' ) . '</a></p>';
				}

			}

			$content .= '<input type="hidden" id="_thumbnail_id" name="_thumbnail_id" value="' . esc_attr( $thumbnail_id ? $thumbnail_id : '-1' ) . '" />';
			echo wp_kses($content, array(
				'input'   => array(
					'type'      => array(),
					'id'      => array(),
					'name'      => array(),
					'class' => array(),
					'value'     => array(),
					'checked'   => array(),
					'data-parsley-maxfilesize'   => array(),
					'data-parsley-fileextension'   => array(),
					'data-parsley-required'   => array(),
                ),
				'img'        => array(
					'alt'      => true,
					'align'    => true,
					'border'   => true,
					'height'   => true,
					'hspace'   => true,
					'longdesc' => true,
					'vspace'   => true,
					'src'      => true,
					'usemap'   => true,
					'width'    => true,
					'srcset'    => true,
					'sizes'    => true,
				),
				'p'   => array(
				        'class' => array()
                ),
				'a'    => array(
                    'href' => array(),
                    'id' => array(),
                ),
			));
			?>
        </div>

		<?php
		$taxonomy_args = array(
			'set_all'    => '',
			''           => esc_attr__( 'Select a category', 'wud' ),
			'taxonomy'   => 'wud-category',
			'orderby'    => 'title',
			'order'      => 'ASC',
			'show_count' => false,
			'hide_empty' => false,
			'term_type'  => 'term_id',
		);
		$field_args    = array(
			'type'          => 'taxonomy_multiple',
			'name'          => 'category[]',
			'id'            => 'category',
			'value'         => isset( $doc['category'] ) ? $doc['category'] : array(),
			'taxonomy_args' => $taxonomy_args,
			'label'         => esc_attr__( 'Select category', 'wud' ),
			'label_class'   => 'control-label',
			'class'         => 'form-control wud-multiple',
			'extra_attr'    => 'required',
			'label_attr'    => '',
			'desc'          => '',
		);

		wud_app()->form->get_field( $field_args );

		$field_args = array(
			'type'        => 'text',
			'name'        => 'tags',
			'id'          => 'tags',
			'value'       => isset( $doc['tags'] ) ? $doc['tags'] : '',
			'label'       => esc_attr__( 'Tags', 'wud' ),
			'label_class' => 'control-label',
			'class'       => 'form-control wud-tags',
			'label_attr'  => '',
			'desc'        => '',
		);

		wud_app()->form->get_field( $field_args );


		$licenses_options = array( '' => esc_html__( 'No license', 'wud' ) );
		$licenses_options = $licenses_options + wud_get_licenses_options();

		$field_options = array(
			'type'        => 'select',
			'name'        => 'license',
			'id'          => 'license',
			'value'       => isset( $doc['license'] ) ? $doc['license'] : '',
			'options'     => $licenses_options,
			'label_class' => 'control-label',
			'label'       => esc_attr__( 'Select license', 'wud' ),
			'class'       => 'form-control',
			'desc'        => '',
		);
		wud_app()->form->get_field( $field_options );

		?>

        <fieldset class="form-group">
            <legend><?php echo esc_html__( 'Document file', 'wud' ); ?>:</legend>
            <div id="forms_field_wud_browse_file" class="form-field-wrapper field-file ">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="field-label"><?php echo esc_html__( 'Select file', 'wud' ); ?></label>
                    </div>
                    <div class="col-sm-11">
                        <div class="field-wrapper">

                            <div id="versions">
                                <div id="versions-list-files">
									<?php if ( ! empty( $versions ) ) { ?>
                                        <table class="wud-table wud-theme-table">
                                            <thead>
                                            <tr>
                                                <th><?php echo esc_html__( 'Date', 'wud' ); ?></th>
                                                <th><?php echo esc_html__( 'Size', 'wud' ); ?></th>
                                                <th><?php echo esc_html__( 'File type', 'wud' ); ?></th>
                                                <th><?php echo esc_html__( 'Selected', 'wud' ); ?></th>
                                                <th><?php echo esc_html__( 'Delete ?', 'wud' ); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php
											foreach ( $versions as $doc_var ) {
												?>
                                                <tr>
                                                    <td><?php echo esc_html( $doc_var['created_time'] ); ?></td>
                                                    <td><?php echo esc_html( $doc_var['size_html'] ); ?></td>
                                                    <td><?php echo esc_html( $doc_var['ext'] ); ?></td>
                                                    <td>
                                                        <input type="radio" name="version_chosen"
                                                               data-id="<?php echo esc_attr( $doc_var['doc_id'] ); ?>"
                                                               data-mtid="<?php echo esc_attr( $doc_var['meta_id'] ); ?>" <?php checked( $doc['real_file'], $doc_var['real_file'], true ); ?>
                                                               value="<?php echo esc_attr( $doc_var['meta_id'] ); ?>"/>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="version_delete[]"
                                                               data-id="<?php echo esc_attr( $doc_var['doc_id'] ); ?>"
                                                               data-mtid="<?php echo esc_attr( $doc_var['meta_id'] ); ?>"
                                                               value="<?php echo esc_attr( $doc_var['meta_id'] ); ?>"/>
                                                    </td>
                                                </tr>
											<?php } ?>
                                            </tbody>
                                        </table>
									<?php } else { ?>
                                        <p><?php echo esc_html__( 'There are no document files to be uploaded.', 'wud' ); ?></p>
									<?php } ?>
                                </div>
                            </div>
                            <hr>
                            <input type="file" name="doc_file"
                                   id="doc_file" <?php echo empty( $versions ) ? 'data-parsley-required="true"' : 'data-parsley-required="false"'; ?>
                                   data-parsley-maxfilesize="<?php echo esc_attr( $max_file_size_mb ); ?>"/>
                            <p class="description"><?php printf( esc_html__( 'Add a document file with file type is : %s, maximum upload file size: %s.' ), implode( ', ', $wud_settings->get_exts() ), esc_html( size_format( $max_upload_size ) ) ); ?></p>
                        </div>
                    </div>
                </div>

            </div>
            <div id="forms_field_params_version" class="form-field-wrapper field-text ">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="control-label field-label"><?php echo esc_html__( 'Version', 'wud' ); ?></label>
                    </div>
                    <div class="col-sm-11">
						<?php
						$field_options = array(
							'type'       => 'text',
							'name'       => 'version',
							'value'      => isset( $doc['version'] ) ? $doc['version'] : '1.0',
							'class'      => 'form-control',
							'desc'       => '',
							'extra_attr' => 'required',
							'wrapper'    => '',
						);
						wud_app()->form->get_field( $field_options );
						?>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend><?php echo esc_html__( 'Privacy', 'wud' ); ?>:</legend>
			<?php
			$field_options = array(
				'type'    => 'radio',
				'name'    => 'allow_download',
				'value'   => isset( $doc['allow_download'] ) ? $doc['allow_download'] : 0,
				'options' => array(
					1 => esc_attr__( 'Yes', 'wud' ),
					0 => esc_attr__( 'No', 'wud' ),
				),
				'label'   => esc_attr__( 'Allow download', 'wud' ),
				'class'   => '',
				'desc'    => esc_html__( 'allow other users to download the document', 'wud' ),
			);

			wud_app()->form->get_field( $field_options );

			$field_options = array(
				'type'    => 'radio',
				'name'    => 'email_attachment',
				'value'   => isset( $doc['email_attachment'] ) ? (int) $doc['email_attachment'] : 0,
				'options' => array(
					1 => esc_attr__( 'Yes', 'wud' ),
					0 => esc_attr__( 'No', 'wud' ),
				),
				'label'   => esc_attr__( 'Email attachment', 'wud' ),
				'class'   => '',
				'desc'    => esc_html__( 'allow other users to share or attach the document into their personal emails', 'wud' ),
			);

			wud_app()->form->get_field( $field_options );

			if ( wud_installed_buddypress() && bp_is_active('groups')) {
				?>
                <div id="forms_field_group_id" class="form-field-wrapper field-select ">
                    <label for="forms_field_group_id" id="forms_field_group_id_label"
                           class="field-label control-label"><?php echo esc_html__( 'Group', 'wud' ); ?>: </label>
					<?php
					wud_group_dropdown( array(
						'name'         => 'group_id',
						'id'           => 'group_id',
						'class'           => 'form-control',
						'options_only' => false,
						'selected'     => isset( $doc['group_id'] ) ? $doc['group_id'] : '',
						'echo'         => true,
						'null_option'  => true,
					) );
					?>
                    <br><span
                            class="description"><?php echo esc_html__( '(Optional) Set BuddyPress group for the document', 'wud' ); ?></span>
                </div>
				<?php
			}

			if ( wud_installed_buddypress() && bp_is_active('groups') && isset( $doc['group_id'] ) && $doc['group_id'] != '' ) {
				$visibility_options = wud_get_access_groups();
				$comment_options    = wud_get_access_groups();
				$edit_options       = wud_get_access_groups();
				unset( $edit_options['anyone'] );
			} else {
				$visibility_options = wud_get_access_roles();
				$comment_options    = wud_get_access_roles();
				$edit_options       = wud_get_access_roles();
				unset( $edit_options['anyone'] );
			}
			$edit_options = array( '' => esc_html__( 'Not set', 'wud' ) ) + $edit_options;

			$field_args = array(
				'type'        => 'select',
				'name'        => 'visibility_by',
				'id'          => 'visibility_by',
				'value'       => isset( $doc['visibility_by'] ) ? $doc['visibility_by'] : 'anyone',
				'options'     => $visibility_options,
				'label'       => esc_attr__( 'Visibility by', 'wfd' ),
				'label_class' => 'control-label',
				'class'       => 'form-control',
				'label_attr'  => '',
				'desc'        => esc_html__( 'who can see the document', 'wud' ),
			);

			wud_app()->form->get_field( $field_args );
			if ( $wud_settings->get_input_value( 'user_can_edit', 'yes' ) == 'yes' ) {
				$field_args = array(
					'type'        => 'select',
					'name'        => 'edit_by',
					'id'          => 'edit_by',
					'value'       => isset( $doc['edit_by'] ) ? $doc['edit_by'] : '',
					'options'     => $edit_options,
					'label'       => esc_attr__( 'Edit by', 'wfd' ),
					'label_class' => 'control-label',
					'class'       => 'form-control',
					'label_attr'  => '',
					'desc'        => esc_html__( 'who can edit the document, if not set only author can edit', 'wud' ),
				);

				wud_app()->form->get_field( $field_args );
			}
			$field_args = array(
				'type'        => 'select',
				'name'        => 'comment_by',
				'id'          => 'comment_by',
				'value'       => isset( $doc['comment_by'] ) ? $doc['comment_by'] : 'anyone',
				'options'     => $comment_options,
				'label'       => esc_attr__( 'Comment by', 'wfd' ),
				'label_class' => 'control-label',
				'class'       => 'form-control',
				'label_attr'  => '',
				'desc'        => esc_html__( 'who can see the comment', 'wud' ),
			);

			wud_app()->form->get_field( $field_args );
			?>

        </fieldset>

        <hr>
		<?php if ( $action === 'add' ) { ?>
            <div id="forms_field_spam" class="form-field-wrapper field-text ">
                <label class="control-label field-label"><?php echo esc_html__( 'Captcha', 'wud' ); ?></label>

				<?php
				$field_options = array(
					'type'       => 'text',
					'name'       => 'captcha',
					'id'         => 'captcha',
					'value'      => '',
					'class'      => 'form-control',
					'desc'       => '',
					'extra_attr' => 'required data-parsley-captcha="3"',
					'wrapper'    => '',
				);
				wud_app()->form->get_field( $field_options );
				?>
            </div>
		<?php } ?>
		<?php if ( $wud_settings->get_input_value( 'terms_and_agreement_url', '' ) !== '' && $action === 'add' ) { ?>
            <div id="forms_field_terms" class="form-field-wrapper field-terms ">
                <div class="checkbox-wrapper">
                    <label class="checkbox-label">
                        <input type="checkbox" value="1" name="term_and_agreement" class="" required> <?php echo sprintf( wp_kses( __( 'I agree to the <a href="%s" target="_blank">terms and agreement of this form</a>', 'wud' ), array( 'a' => array( 'href' => true , 'target' => true ) )), esc_url( $wud_settings->get_input_value( 'terms_and_agreement_url', '' ) ) ); ?>
                    </label>
                </div>
            </div>
		<?php } ?>
        <div class="wud-form-footer-buttons">
            <div class="row">
                <div class="col-8">
                    <input type="submit" class="button button-regular" id="wud-submit-doc" name="wud-submit-doc"
                           value="<?php echo ( $action === 'update' ) ? esc_attr__( 'Update', 'wud' ) : esc_html__( 'Submit', 'wud' ); ?>">
                    <?php if ($action == 'update') { ?>
                        <a class="button button-regular" href="<?php echo esc_url( the_permalink( $doc_id ) ); ?>"><?php echo esc_html__( 'Cancel', 'wud' );?></a>
                    <?php } ?>
                </div>
                <div class="col-4">
                    <?php
                    if ($action == 'update' && $doc['post_author'] == $user->ID && $wud_settings->get_input_value( 'user_can_delete', 'yes' ) == 'yes') {
	                    $action_delete = wp_nonce_url( add_query_arg( array(
		                    'wud_delete_doc' => 1,
		                    'wud_delete_doc_id' => $doc_id,
	                    ), wud_get_account_endpoint_url('edit-document', $doc_id) ), 'wud-delete-doc');
	                    ?>
                        <div class="button-container button-right">
                            <a class="button button-salmon" id="wud-delete-doc" href="<?php echo esc_url($action_delete);?>"><?php echo esc_html__( 'Delete', 'wud' );?></a>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </form>
</div>

