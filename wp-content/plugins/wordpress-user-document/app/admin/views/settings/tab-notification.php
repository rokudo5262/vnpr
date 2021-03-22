<div class="wud-postbox wud-settings-notification">
    <h2><?php echo esc_html__( 'New Document Notification', 'wud' ); ?></h2>
    <div class="postbox-wrapper">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'new_enable_notification' ) ); ?>"><?php echo esc_html__( 'Enable Notification', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Enable Notification', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'       => 'radio',
							'name'       => $model->get_input_name( 'new_enable_notification' ),
							'id'         => $model->get_input_id( 'new_enable_notification' ),
							'value'      => $model->get_input_value( 'new_enable_notification', 'yes' ),
							'options'    => array(
								'yes' => esc_attr__( 'Yes', 'wud' ),
								'no'  => esc_attr__( 'No', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Set yes if you want admin to recieve notification email after submitting of a new document.', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'new_to' ) ); ?>"><?php echo esc_html__( 'To', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'To', 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'new_to' ),
							'value'       => $model->get_input_value( 'new_to', get_option( 'admin_email' ) ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => '',
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'new_subject' ) ); ?>"><?php echo esc_html__( 'Subject', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Subject', 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'new_subject' ),
							'value'       => $model->get_input_value( 'new_subject', esc_html__( 'A new document has been submitted', 'wud' ) ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => '',
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'new_message' ) ); ?>"><?php echo esc_html__( 'Message', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Message', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'        => 'editor',
							'name'        => $model->get_input_name( 'new_message' ),
							'id'          => $model->get_input_id( 'new_message' ),
							'value'       => $model->get_input_value( 'new_message', "Hi Admin, \r\n\r\nA new document has been created in your site %sitename% (%siteurl%). \r\n\r\nHere is the details: \r\nDocument Title: %post_title% \r\nContent: %post_content% \r\nAuthor: %author% \r\nDocument URL: %permalink% \r\nEdit URL: %editlink%" ),
							'label_class' => '',
							'label_attr'  => '',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'You may use in to, subject & message:', 'wud' ) . '<code>%post_title%</code>, <code>%post_content%</code>, <code>%post_excerpt%</code>, <code>%tags%</code>, <code>%category%</code>,
            <code>%author%</code>, <code>%author_email%</code>, <code>%author_bio%</code>, <code>%sitename%</code>, <code>%siteurl%</code>, <code>%permalink%</code>, <code>%editlink%</code> '
						);

						$form->get_field( $field_args );

						?>
                    </fieldset>
                </td>
            </tr>
            </tbody>

        </table>
    </div>
    <h2><?php echo esc_html__( 'Update Document Notification', 'wud' ); ?></h2>
    <div class="postbox-wrapper">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'update_enable_notification' ) ); ?>"><?php echo esc_html__( 'Enable Notification', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Enable Notification', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'       => 'radio',
							'name'       => $model->get_input_name( 'update_enable_notification' ),
							'id'         => $model->get_input_id( 'update_enable_notification' ),
							'value'      => $model->get_input_value( 'update_enable_notification', 'yes' ),
							'options'    => array(
								'yes' => esc_attr__( 'Yes', 'wud' ),
								'no'  => esc_attr__( 'No', 'wud' ),
							),
							'class'      => 'form-control',
							'label_attr' => '',
							'desc'       => esc_html__( 'Set yes if you want admin to recieve notification email after a new document has beed updated.', 'wud' ),
						);
						$form->get_field( $field_args );
						?>
                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'update_to' ) ); ?>"><?php echo esc_html__( 'To', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__('To' , 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'update_to' ),
							'value'       => $model->get_input_value( 'update_to', get_option( 'admin_email' ) ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => '',
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'update_subject' ) ); ?>"><?php echo esc_html__( 'Subject', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Subject', 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'update_subject' ),
							'value'       => $model->get_input_value( 'update_subject', esc_html__( 'The document has been updated', 'wud' ) ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
							'desc'        => '',
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'update_message' ) ); ?>"><?php echo esc_html__( 'Message', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Message', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'        => 'editor',
							'name'        => $model->get_input_name( 'update_message' ),
							'id'          => $model->get_input_id( 'update_message' ),
							'value'       => $model->get_input_value( 'update_message', "Hi Admin, \r\n\r\nA new document has been updated in your site %sitename% (%siteurl%). \r\n\r\nHere is the details: \r\nDocument Title: %post_title% \r\nContent: %post_content% \r\nAuthor: %author% \r\nDocument URL: %permalink% \r\nEdit URL: %editlink%" ),
							'label_class' => '',
							'label_attr'  => '',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'You may use in to, subject & message:', 'wud' ) . '<code>%post_title%</code>, <code>%post_content%</code>, <code>%post_excerpt%</code>, <code>%tags%</code>, <code>%category%</code>,
            <code>%author%</code>, <code>%author_email%</code>, <code>%author_bio%</code>, <code>%sitename%</code>, <code>%siteurl%</code>, <code>%permalink%</code>, <code>%editlink%</code> '
						);

						$form->get_field( $field_args );

						?>
                    </fieldset>
                </td>
            </tr>
            </tbody>

        </table>
    </div>
    <h2><?php echo esc_html__( 'Approved Document Notification', 'wud' ); ?></h2>
    <div class="postbox-wrapper">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'aprroved_enable_notification' ) ); ?>"><?php echo esc_html__( 'Enable Notification', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Enable Notification', 'wud' ); ?></span></legend>
			            <?php

			            $field_args = array(
				            'type'       => 'radio',
				            'name'       => $model->get_input_name( 'aprroved_enable_notification' ),
				            'id'         => $model->get_input_id( 'aprroved_enable_notification' ),
				            'value'      => $model->get_input_value( 'aprroved_enable_notification', 'yes' ),
				            'options'    => array(
					            'yes' => esc_attr__( 'Yes', 'wud' ),
					            'no'  => esc_attr__( 'No', 'wud' ),
				            ),
				            'class'      => 'form-control',
				            'label_attr' => '',
				            'desc'       => esc_html__( 'Set yes if you want admin to recieve notification email after a document has beed aprroved.', 'wud' ),
			            );
			            $form->get_field( $field_args );
			            ?>
                    </fieldset>
                </td>
            </tr>
            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'approved_subject' ) ); ?>"><?php echo esc_html__( 'Subject', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Subject', 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'approved_subject' ),
							'value'       => $model->get_input_value( 'approved_subject', esc_html__( 'The document has been approved', 'wud' ) ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'approved_message' )) ; ?>"><?php echo esc_html__( 'Message', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Message', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'        => 'editor',
							'name'        => $model->get_input_name( 'approved_message' ),
							'id'          => $model->get_input_id( 'approved_message' ),
							'value'       => $model->get_input_value( 'approved_message', "Hi %author%, \r\n\r\n Your document has been approved. \r\n\r\nHere is the details: \r\nDocument Title: %post_title% \r\nContent: %post_content% \r\nAuthor: %author% \r\nDocument URL: %permalink%" ),
							'label_class' => '',
							'label_attr'  => '',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'You may use in to, subject & message:', 'wud' ) . '<code>%post_title%</code>, <code>%post_content%</code>, <code>%post_excerpt%</code>, <code>%tags%</code>, <code>%category%</code>,
            <code>%author%</code>, <code>%author_email%</code>, <code>%author_bio%</code>, <code>%sitename%</code>, <code>%siteurl%</code>, <code>%permalink%</code> '
						);

						$form->get_field( $field_args );

						?>
                    </fieldset>
                </td>
            </tr>
            </tbody>

        </table>
    </div>

    <h2><?php echo esc_html__( 'Reject Document Notification', 'wud' ); ?></h2>
    <div class="postbox-wrapper">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'reject_enable_notification' ) ); ?>"><?php echo esc_html__( 'Enable Notification', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php echo esc_html__( 'Enable Notification', 'wud' ); ?></span></legend>
			            <?php

			            $field_args = array(
				            'type'       => 'radio',
				            'name'       => $model->get_input_name( 'reject_enable_notification' ),
				            'id'         => $model->get_input_id( 'reject_enable_notification' ),
				            'value'      => $model->get_input_value( 'reject_enable_notification', 'yes' ),
				            'options'    => array(
					            'yes' => esc_attr__( 'Yes', 'wud' ),
					            'no'  => esc_attr__( 'No', 'wud' ),
				            ),
				            'class'      => 'form-control',
				            'label_attr' => '',
				            'desc'       => esc_html__( 'Set yes if you want admin to recieve notification email after a document has beed rejected.', 'wud' ),
			            );
			            $form->get_field( $field_args );
			            ?>
                    </fieldset>
                </td>
            </tr>

            <tr>

                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'reject_subject' ) ); ?>"><?php echo esc_html__( 'Subject', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Subject', 'wud' ); ?></span></legend>
						<?php

						$allowext_options = array(
							'type'        => 'text',
							'name'        => $model->get_input_name( 'reject_subject' ),
							'value'       => $model->get_input_value( 'reject_subject', esc_html__( 'The document has been rejected', 'wud' ) ),
							'label_class' => 'control-label',
							'class'       => 'form-control',
						);
						$form->get_field( $allowext_options );

						?>

                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr( $model->get_input_id( 'reject_message' ) ); ?>"><?php echo esc_html__( 'Message', 'wud' ); ?>
                        : </label>
                </th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html__( 'Message', 'wud' ); ?></span></legend>
						<?php

						$field_args = array(
							'type'        => 'editor',
							'name'        => $model->get_input_name( 'reject_message' ),
							'id'          => $model->get_input_id( 'reject_message' ),
							'value'       => $model->get_input_value( 'reject_message', "Hi %author%, \r\n\r\n Your document has been rejected. \r\n\r\nHere is the details: \r\nDocument Title: %post_title% \r\nContent: %post_content% \r\nAuthor: %author% " ),
							'label_class' => '',
							'label_attr'  => '',
							'class'       => 'form-control',
							'desc'        => esc_html__( 'You may use in to, subject & message:', 'wud' ) . '<code>%post_title%</code>, <code>%post_content%</code>, <code>%post_excerpt%</code>, <code>%tags%</code>, <code>%category%</code>,
            <code>%author%</code>, <code>%author_email%</code>, <code>%author_bio%</code>, <code>%sitename%</code>, <code>%siteurl%</code>'
						);

						$form->get_field( $field_args );

						?>
                    </fieldset>
                </td>
            </tr>
            </tbody>

        </table>
    </div>
</div>