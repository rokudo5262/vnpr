<div class="wud-postbox wud-settings-home">
    <h2><?php echo esc_html( $tab_name ); ?></h2>
    <div class="postbox-wrapper">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'load_fontawesome' ) ); ?>"><?php echo esc_html__( 'Load  Font Awesome', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Load  Font Awesome', 'wud' ); ?></span>
                        </legend>
						<?php

						$field_args = array(
							'type'       => 'radio',
							'name'       => $model->get_input_name( 'load_fontawesome' ),
							'id'         => $model->get_input_id( 'load_fontawesome' ),
							'value'      => $model->get_input_value( 'load_fontawesome', 'yes' ),
							'options'    => array(
								'yes' => esc_attr__( 'Yes', 'wud' ),
								'no'  => esc_attr__( 'No', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Set Yes to load, set no if you know that it was loaded before by another the plugins/themes', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'load_bootstrap_grid' ) ); ?>"><?php echo esc_html__( 'Load  Bootstrap Grid', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Load  Bootstrap Grid', 'wud' ); ?></span>
                        </legend>
			            <?php

			            $field_args = array(
				            'type'       => 'radio',
				            'name'       => $model->get_input_name( 'load_bootstrap_grid' ),
				            'id'         => $model->get_input_id( 'load_bootstrap_grid' ),
				            'value'      => $model->get_input_value( 'load_bootstrap_grid', 'yes' ),
				            'options'    => array(
					            'yes' => esc_attr__( 'Yes', 'wud' ),
					            'no'  => esc_attr__( 'No', 'wud' ),
				            ),
				            'class'      => 'form-control',
				            'label_attr' => '',
				            'desc'       => esc_html__( 'Set Yes to load, set no if you know that Bootstrap was loaded before by another the plugins/themes', 'wud' ),
			            );
			            $form->get_field( $field_args );
			            ?>
                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'allowed_ext' ) ); ?>"><?php echo esc_html__( 'Allowed file type', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Allowed file type', 'wud' ); ?></span>
                        </legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'allowed_ext' ),
							'value'       => $model->get_input_value( 'allowed_ext' ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'File type allowed to be uploaded', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>

            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'max_upload_filesize' ) ); ?>"><?php echo esc_html__( 'Maximum upload file size (MB)', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Maximum upload file size (MB)', 'wud' ); ?></span></legend>
						<?php
						$max_upload_size = wp_max_upload_size();
						if ( ! $max_upload_size ) {
							$max_upload_size = 0;
						}
						$server_size = esc_html__( 'Currently, Max file size the server is ', 'wud' ) . ': ' . esc_html( size_format( $max_upload_size ) ) . ' ';

						$allowext_options = array(
							'type'        => 'number',
							'name'        => $model->get_input_name( 'max_upload_filesize' ),
							'value'       => $model->get_input_value( 'max_upload_filesize', 10 ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => $server_size . esc_html__( 'You can set this value with upload_max_filesize and post_max_size in your php.ini ', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'use_previewer' ) ); ?>"><?php echo esc_html__( 'Use previewer', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Use previewer', 'wud' ); ?></span>
                        </legend>
						<?php

						$field_args = array(
							'type'       => 'radio',
							'name'       => $model->get_input_name( 'use_previewer' ),
							'id'         => $model->get_input_id( 'use_previewer' ),
							'value'      => $model->get_input_value( 'use_previewer', 'yes' ),
							'options'    => array(
								'yes' => esc_attr__( 'Yes', 'wud' ),
								'no'  => esc_attr__( 'No', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Set Yes to preview files or set No to use image of document', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'preview_by' ) ); ?>"><?php echo esc_html__( 'Preview by', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Preview by', 'wud' ); ?></span>
                        </legend>
						<?php

						$field_args = array(
							'type'       => 'radio',
							'name'       => $model->get_input_name( 'preview_by' ),
							'id'         => $model->get_input_id( 'preview_by' ),
							'value'      => $model->get_input_value( 'preview_by', 'google_viewer' ),
							'options'    => array(
								'google_viewer' => esc_attr__( 'Google Viewer', 'wud' ),
								'pdfjs'  => esc_attr__( 'PDF.js', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Use Google Viewer is free so sometimes it does not work, use PDF.js only can preview with file type is pdf', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'extension_preview' ) ); ?>"><?php echo esc_html__( 'Extensions to preview', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Extensions to preview', 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'extension_preview' ),
							'value'       => $model->get_input_value( 'extension_preview', 'doc,docx,ppt,pptx,pps,xls,xlsx,pdf,ps,odt,odp,sxw,sxi,txt,rtf' ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Allow file type to be previewed.', 'wud' ),
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'submission_message' ) ); ?>"><?php echo esc_html__( 'Submission Message', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Submission Message', 'wud' ); ?></span>
                        </legend>
						<?php


						$field_args = array(
							'type'        => 'textarea',
							'name'        => $model->get_input_name( 'submission_message' ),
							'id'          => $model->get_input_id( 'submission_message' ),
							'value'       => $model->get_input_value( 'submission_message', '' ),
							'label_class' => '',
							'label_attr'  => '',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Message displayed after successful document submission. Leave blank to use default', 'wud' ),
						);

						$form->get_field( $field_args );

						?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'login_message' ) ); ?>"><?php echo esc_html__( 'Login Message', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Login Message', 'wud' ); ?></span>
                        </legend>
						<?php


						$field_args = array(
							'type'        => 'textarea',
							'name'        => $model->get_input_name( 'login_message' ),
							'id'          => $model->get_input_id( 'login_message' ),
							'value'       => $model->get_input_value( 'login_message', 'Please login to view this page' ),
							'label_class' => '',
							'label_attr'  => '',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Message to be displayed if the user is not logged in. Leave blank to use default', 'wud' ),
						);

						$form->get_field( $field_args );

						?>
                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'login_text_link' ) ); ?>"><?php echo esc_html__( 'Login Link Text', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Login Link Text', 'wud' ); ?></span>
                        </legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'login_text_link' ),
							'value'       => $model->get_input_value( 'login_text_link', 'Click here' ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'Text to be shown in login link if the user is not logged in. Leave blank to use default', 'wud' ),
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