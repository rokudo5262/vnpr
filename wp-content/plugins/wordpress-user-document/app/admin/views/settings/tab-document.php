<div class="wud-postbox wud-settings-document">
    <h2><?php echo esc_html( $tab_name ); ?></h2>
    <div class="postbox-wrapper">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'doc_page_id' ) ); ?>"><?php echo esc_html__( 'Document page', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Document page', 'wud' ); ?></span>
                        </legend>
						<?php

						$args = array(
							'name'             => $model->get_input_name( 'doc_page_id' ),
							'id'               => $model->get_input_id( 'doc_page_id' ),
							'sort_column'      => 'menu_order',
							'sort_order'       => 'ASC',
							'show_option_none' => esc_attr__( 'Select a page', 'wud' ),
							'class'            => 'form-control',
							'echo'             => true,
							'selected'         => absint( $model->get_input_value( 'doc_page_id', '' ) ),
							'post_status'      => 'publish,private,draft',
						);

						wp_dropdown_pages( $args );

						?>
                        <p class="description"><?php echo esc_html__( 'Set page to display list documents, or you can use [wud_documents] shortcode to display list documents', 'wud' ); ?></p>
                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'my_account_page_id' ) ); ?>"><?php echo esc_html__( 'My account page', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'My account page', 'wud' ); ?></span>
                        </legend>
						<?php

						$args = array(
							'name'             => $model->get_input_name( 'my_account_page_id' ),
							'id'               => $model->get_input_id( 'my_account_page_id' ),
							'sort_column'      => 'menu_order',
							'sort_order'       => 'ASC',
							'show_option_none' => esc_attr__( 'Select a page', 'wud' ),
							'class'            => 'form-control',
							'echo'             => true,
							'selected'         => absint( $model->get_input_value( 'my_account_page_id', '' ) ),
							'post_status'      => 'publish,private,draft',
						);

						wp_dropdown_pages( $args );

						?>
                        <p class="description"><?php echo esc_html__( 'Page content: [wud_my_account]' ); ?></p>
                    </fieldset>
                </td>
            </tr>

            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'new_document_days' ) ); ?>"><?php echo esc_html__( 'New document criteria', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'new_document_days', 'wud' ); ?></span>
                        </legend>
						<?php

						$allowext_options = array(
							'type'        => 'number',
							'name'        => $model->get_input_name( 'new_document_days' ),
							'value'       => $model->get_input_value( 'new_document_days', 3 ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'The uploaded documents will be set as new within this number of days from the creation date', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'terms_and_agreement_url' ) ); ?>"><?php echo esc_html__( 'Terms and agreement URL', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'terms_and_agreement_url', 'wud' ); ?></span>
                        </legend>
						<?php

						$field_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'terms_and_agreement_url' ),
							'value'       => $model->get_input_value( 'terms_and_agreement_url', '' ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Enter the url of the terms and agreement of submission form before submitting a new document. Leave blank to hide', 'wud' ),
						);
						$form->get_field( $field_options );

						?>

                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'allow_media_uploads' ) ); ?>"><?php echo esc_html__( 'Allow media uploads', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Allow media uploads', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'       => 'radio',
							'name'       => $model->get_input_name( 'allow_media_uploads' ),
							'id'         => $model->get_input_id( 'allow_media_uploads' ),
							'value'      => $model->get_input_value( 'allow_media_uploads', 'yes' ),
							'options'    => array(
								'yes' => esc_attr__( 'Yes', 'wud' ),
								'no'  => esc_attr__( 'No', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Set Yes if you want logged in users to upload allowed media files to document', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'auto_approve' ) ); ?>"><?php echo esc_html__( 'Auto approve', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Auto approve', 'wud' ); ?></span>
                        </legend>
						<?php

						global $wp_roles;
						$roles = $wp_roles->roles;

						$roles_options = array( '' => esc_attr__( 'Disable', 'wud' ) );

						foreach ( $roles as $key => $role ) {
							$roles_options[ $key ] = $role['name'];
						}


						$field_args = array(
							'type'       => 'select',
							'name'       => $model->get_input_name( 'auto_approve' ),
							'id'         => $model->get_input_id( 'auto_approve' ),
							'value'      => $model->get_input_value( 'auto_approve', '' ),
							'options'    => $roles_options,
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Allow automatically approve the document created by role, default is disable', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'user_can_edit' ) ); ?>"><?php echo esc_html__( 'Users can edit document', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Users can edit document', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'       => 'radio',
							'name'       => $model->get_input_name( 'user_can_edit' ),
							'id'         => $model->get_input_id( 'user_can_edit' ),
							'value'      => $model->get_input_value( 'user_can_edit', 'yes' ),
							'options'    => array(
								'yes' => esc_attr__( 'Yes', 'wud' ),
								'no'  => esc_attr__( 'No', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Users will be able to edit their own documents', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'user_can_delete' ) ); ?>"><?php echo esc_html__( 'Users can delete document', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Users can delete document', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'       => 'radio',
							'name'       => $model->get_input_name( 'user_can_delete' ),
							'id'         => $model->get_input_id( 'user_can_delete' ),
							'value'      => $model->get_input_value( 'user_can_delete', 'yes' ),
							'options'    => array(
								'yes' => esc_attr__( 'Yes', 'wud' ),
								'no'  => esc_attr__( 'No', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Users will be able to delete their own documents', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'image_mode' ) ); ?>"><?php echo esc_html__( 'Image mode', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Image mode', 'wud' ); ?></span></legend>
			            <?php

			            $field_args = array(
				            'type'       => 'radio',
				            'name'       => $model->get_input_name( 'image_mode' ),
				            'id'         => $model->get_input_id( 'image_mode' ),
				            'value'      => $model->get_input_value( 'image_mode', 'resize' ),
				            'options'    => array(
					            'resize' => esc_attr__( 'Resize', 'wud' ),
					            'crop'  => esc_attr__( 'Crop', 'wud' ),
				            ),
				            'class'      => 'form-control',
				            'label_attr' => '',
				            'desc'       => esc_html__( 'Resize or crop image of document, if you change this option you must regenerate thumbnails with the plugin such as : Regenerate Thumbnails', 'wud' ),
			            );
			            $form->get_field( $field_args );
			            ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'logged_in_download' ) ); ?>"><?php echo esc_html__( 'Require Login to download', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Require Login to download', 'wud' ); ?></span></legend>
			            <?php

			            $field_args = array(
				            'type'       => 'radio',
				            'name'       => $model->get_input_name( 'logged_in_download' ),
				            'id'         => $model->get_input_id( 'logged_in_download' ),
				            'value'      => $model->get_input_value( 'logged_in_download', 'yes' ),
				            'options'    => array(
					            'yes' => esc_attr__( 'Yes', 'wud' ),
					            'no'  => esc_attr__( 'No', 'wud' ),
				            ),
				            'class'      => 'form-control',
				            'label_attr' => '',
				            'desc'       => esc_html__( 'Require users Login to download if the documents are visibility by Anyone', 'wud' ),
			            );
			            $form->get_field( $field_args );
			            ?>
                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'block_ip' ) ); ?>"><?php echo esc_html__( 'IP Block', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'IP Block', 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'textarea',
							'name'        => $model->get_input_name( 'block_ip' ),
							'value'       => $model->get_input_value( 'block_ip' ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Enter one address on each line to block download document', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
    <h2><?php echo esc_html__( 'Layout', 'wud' ); ?></h2>
    <div class="postbox-wrapper">
        <table class="form-table">
            <tbody>

            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'template_type' ) ); ?>"><?php echo esc_html__( 'Template type', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Template type', 'wud' ); ?></span></legend>
			            <?php

			            $field_args = array(
				            'type'       => 'select',
				            'name'       => $model->get_input_name( 'template_type' ),
				            'id'         => $model->get_input_id( 'template_type' ),
				            'value'      => $model->get_input_value( 'template_type', 'plugin' ),
				            'options'    => array(
					            'theme'    => esc_attr__( 'Theme', 'wud' ),
					            'plugin'    => esc_attr__( 'Plugin', 'wud' ),
				            ),
				            'class'      => 'form-control',
				            'label_attr' => '',
				            'desc'       => esc_html__( 'Load template of plugin or your theme, if you use theme so you need to set overwrite sidebar below', 'wud' ),
			            );
			            $form->get_field( $field_args );
			            ?>
                    </fieldset>
                </td>
            </tr>

            <tr depend-id="<?php echo esc_attr($model->get_input_id( 'template_type' ));?>" depend-value="theme">
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'overwrite_sidebar' ) ); ?>"><?php echo esc_html__( 'Overwrite sidebar', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Overwrite sidebar', 'wud' ); ?></span></legend>
			            <?php
			            global $wp_registered_sidebars;
			            $list_sidebar = array('' => esc_html__('Select a sidebar', 'wud'));
			            if ( !empty( $wp_registered_sidebars ) ) {
				            foreach ( $wp_registered_sidebars as $sidebar ) {
					            $list_sidebar[$sidebar['id']] = $sidebar['name'];
				            }
				            unset($list_sidebar['document-sidebar']);
			            }

			            $field_args = array(
				            'type'       => 'select',
				            'name'       => $model->get_input_name( 'overwrite_sidebar' ),
				            'id'         => $model->get_input_id( 'overwrite_sidebar' ),
				            'value'      => $model->get_input_value( 'overwrite_sidebar', '' ),
				            'options'    => $list_sidebar,
				            'class'      => 'form-control',
				            'label_attr' => '',
				            'desc'       => esc_html__( 'Select a sidebar of your theme to overwrite sidebar with document sidebar', 'wud' ),
			            );
			            $form->get_field( $field_args );
			            ?>
                    </fieldset>
                </td>
            </tr>

            <tr depend-id="<?php echo esc_attr($model->get_input_id( 'template_type' ));?>" depend-value="plugin">
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'sidebar' ) ); ?>"><?php echo esc_html__( 'Main layout sidebar', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Main layout sidebar', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'       => 'select',
							'name'       => $model->get_input_name( 'sidebar' ),
							'id'         => $model->get_input_id( 'sidebar' ),
							'value'      => $model->get_input_value( 'sidebar', 'sidebar' ),
							'options'    => array(
								'sidebar'    => esc_attr__( 'Right', 'wud' ),
								'sidebar_left'    => esc_attr__( 'Left', 'wud' ),
								'no_sidebar' => esc_attr__( 'No sidebar', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Select sidebar type for list documents page', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr depend-id="<?php echo esc_attr($model->get_input_id( 'template_type' ));?>" depend-value="plugin">
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'sidebar_single' ) ); ?>"><?php echo esc_html__( 'Single sidebar', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Single sidebar', 'wud' ); ?></span>
                        </legend>
						<?php

						$field_args = array(
							'type'       => 'select',
							'name'       => $model->get_input_name( 'sidebar_single' ),
							'id'         => $model->get_input_id( 'sidebar_single' ),
							'value'      => $model->get_input_value( 'sidebar_single', 'no_sidebar' ),
							'options'    => array(
								'sidebar'    => esc_attr__( 'Right', 'wud' ),
								'sidebar_left'    => esc_attr__( 'Left', 'wud' ),
								'no_sidebar' => esc_attr__( 'No sidebar', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Select sidebar type for single document page', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr depend-id="<?php echo esc_attr($model->get_input_id( 'template_type' ));?>" depend-value="plugin">
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'document_header' ) ); ?>"><?php echo esc_html__( 'Show header', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Show header', 'wud' ); ?></span>
                        </legend>
						<?php

						$field_args = array(
							'type'       => 'select',
							'name'       => $model->get_input_name( 'document_header' ),
							'id'         => $model->get_input_id( 'document_header' ),
							'value'      => $model->get_input_value( 'document_header', 'no' ),
							'options'    => array(
								'yes'    => esc_attr__( 'Yes', 'wud' ),
								'no'    => esc_attr__( 'No', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Show document header', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'list_type' ) ); ?>"><?php echo esc_html__( 'List type', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'List type', 'wud' ); ?></span></legend>
	                    <?php

	                    $field_args = array(
		                    'type'       => 'select',
		                    'name'       => $model->get_input_name( 'list_type' ),
		                    'id'         => $model->get_input_id( 'list_type' ),
		                    'value'      => $model->get_input_value( 'list_type', 'list' ),
		                    'options'    => array(
			                    'list'    => esc_attr__( 'List', 'wud' ),
			                    'list_table'    => esc_attr__( 'List Table', 'wud' ),
		                    ),
		                    'class'      => 'form-control',
		                    'label_attr' => '',
		                    'desc'       => esc_html__( 'Show list type', 'wud' ),
	                    );
	                    $form->get_field( $field_args );
	                    ?>
                    </fieldset>
                </td>
            </tr>

            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'default_document_sortby' ) ); ?>"><?php echo esc_html__( 'Default sort by', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Default sort by', 'wud' ); ?></span>
                        </legend>
						<?php

						$field_options = array(
							'type'        => 'select',
							'name'        => $model->get_input_name( 'default_document_sortby' ),
							'value'       => $model->get_input_value( 'default_document_sortby', 'latest' ),
							'options'     => wud_get_sortby_options(),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Set default sort by for list documents', 'wud' ),
						);

						$form->get_field( $field_options );
						?>
                    </fieldset>
                </td>
            </tr>

            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'default_range_date' ) ); ?>"><?php echo esc_html__( 'Default range date', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Default range date', 'wud' ); ?></span>
                        </legend>
						<?php

						$field_options = array(
							'type'        => 'select',
							'name'        => $model->get_input_name( 'default_range_date' ),
							'value'       => $model->get_input_value( 'default_range_date', 'all' ),
							'options'     => wud_get_range_date_options(),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Set default filter by range date for list documents', 'wud' ),
						);

						$form->get_field( $field_options );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'layout_rows' ) ); ?>"><?php echo esc_html__( 'Rows per page', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Rows per page', 'wud' ); ?></span>
                        </legend>
						<?php

						$allowext_options = array(
							'type'        => 'number',
							'name'        => $model->get_input_name( 'layout_rows' ),
							'value'       => $model->get_input_value( 'layout_rows', 3 ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'the number of rows per page on the document pagination.', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>

            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'layout_columns' ) ); ?>"><?php echo esc_html__( 'Columns per page', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Columns per page', 'wud' ); ?></span>
                        </legend>
						<?php

						$allowext_options = array(
							'type'        => 'number',
							'name'        => $model->get_input_name( 'layout_columns' ),
							'value'       => $model->get_input_value( 'layout_columns', 3 ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'the number of columns per page on the document pagination.', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
    <h2><?php echo esc_html__( 'SEO-Friendly Urls', 'wud' ); ?></h2>
    <div class="postbox-wrapper">
        <table class="form-table">
            <tbody>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'url_base' ) ); ?>"><?php echo esc_html__( 'URL Base', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'URL Base', 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'url_base' ),
							'value'       => $model->get_input_value( 'url_base' ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Enter a custom base to use. A base must be set to your URL.', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'category_base' ) ); ?>"><?php echo esc_html__( 'Category base', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Category base', 'wud' ); ?></span>
                        </legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'category_base' ),
							'value'       => $model->get_input_value( 'category_base', 'document-category' ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Enter a custom base to rewrite the url  of document category.', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>

            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'tag_base' ) ); ?>"><?php echo esc_html__( 'Tag base', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Tag base', 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'tag_base' ),
							'value'       => $model->get_input_value( 'tag_base', 'document-tag' ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Enter a custom base to rewrite the url  of document tag.', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>