<?php
global $wud_settings;
$field_options = array(
	'type'    => 'radio',
	'name'    => 'wud_approved',
	'value'   => $doc['approved'],
	'options' => array(
		1   => esc_attr__( 'Approved', 'wud' ),
		0   => esc_attr__( 'Pending', 'wud' ),
		- 1 => esc_attr__( 'Reject', 'wud' ),
	),
	'label'   => esc_attr__( 'Approved status', 'wud' ),
	'class'   => '',
	'desc'    => esc_html__( 'When you set reject then the document will be moved to trash', 'wud' ),
);

$form->get_field( $field_options );

$reject_enable_notification = $wud_settings->get_input_value( 'reject_enable_notification', 'yes' );
if ($reject_enable_notification == 'yes') {
	$field_options = array(
		'type'        => 'textarea',
		'name'        => 'reject_notify',
		'id'          => 'reject_notify',
		'value'       => $wud_settings->get_input_value( 'reject_message', "Hi %author%, \r\n\r\n Your document has been rejected. \r\n\r\nHere is the details: \r\nDocument Title: %post_title% \r\nContent: %post_content% \r\nAuthor: %author%" ),
		'label_class' => '',
		'label_attr'  => '',
		'label'       => esc_attr__( 'Reject message', 'wud' ),
		'class'       => 'form-control',
		'desc'        => esc_html__( 'Send to author some reasons to reject, you can use theses tags in message box', 'wud' ) . '<p>: <code>%post_title%</code>, <code>%post_content%</code>, <code>%post_excerpt%</code>, <code>%tags%</code>, <code>%category%</code>,
            <code>%author%</code>, <code>%author_email%</code>, <code>%author_bio%</code>, <code>%sitename%</code>, <code>%siteurl%</code>
        </p>',
	);

	if ( $doc['approved'] == - 1 ) {
		$field_options['wrapper_class'] = 'wud-show';
	}

	$form->get_field( $field_options );

}

$field_options = array(
	'type'    => 'radio',
	'name'    => 'wud_featured',
	'value'   => $doc['featured'],
	'options' => array(
		1 => esc_attr__( 'Yes', 'wud' ),
		0 => esc_html__( 'No', 'wud' ),
	),
	'label'   => esc_attr__( 'Featured', 'wud' ),
	'class'   => '',
	'desc'    => '',
);
$form->get_field( $field_options );

$field_options = array(
	'type'    => 'radio',
	'name'    => 'wud_allow_download',
	'value'   => $doc['allow_download'],
	'options' => array(
		1 => esc_attr__( 'Yes', 'wud' ),
		0 => esc_attr__( 'No', 'wud' ),
	),
	'label'   => esc_attr__( 'Allow download', 'wud' ),
	'class'   => '',
	'desc'    => esc_html__( 'allow other users to download the document', 'wud' ),
);

$form->get_field( $field_options );

$field_options = array(
	'type'    => 'radio',
	'name'    => 'wud_params[email_attachment]',
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


if ( wud_installed_buddypress() && bp_is_active('groups') ) {
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
			'selected'     => $doc['group_id'],
			'echo'         => true,
			'null_option'  => true,
		) );
		?>
        <br><span
                class="description"><?php echo esc_html__( '(Optional) Set BuddyPress group for the document', 'wud' ); ?></span>
    </div>
	<?php
}

$visibility_options = array();
$comment_options    = array();

if ( wud_installed_buddypress() && bp_is_active('groups') && $doc['group_id'] != '' ) {
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
	'name'        => 'wud_params[visibility_by]',
	'id'          => 'wud_params_visibility_by',
	'value'       => isset( $doc['visibility_by'] ) ? $doc['visibility_by'] : 'anyone',
	'options'     => $visibility_options,
	'label'       => esc_attr__( 'Visibility by', 'wfd' ),
	'label_class' => 'control-label',
	'class'       => 'form-control',
	'label_attr'  => '',
	'desc'        => esc_html__( 'who can see the document', 'wud' ),
);

$form->get_field( $field_args );


$field_args = array(
	'type'        => 'select',
	'name'        => 'wud_params[edit_by]',
	'id'          => 'wud_params_edit_by',
	'value'       => isset( $doc['edit_by'] ) ? $doc['edit_by'] : '',
	'options'     => $edit_options,
	'label'       => esc_attr__( 'Edit by', 'wfd' ),
	'label_class' => 'control-label',
	'class'       => 'form-control',
	'label_attr'  => '',
	'desc'        => esc_html__( 'who can edit the document, if not set only author can edit', 'wud' ),
);

wud_app()->form->get_field( $field_args );


$field_args = array(
	'type'        => 'select',
	'name'        => 'wud_params[comment_by]',
	'id'          => 'wud_params_comment_by',
	'value'       => isset( $doc['comment_by'] ) ? $doc['comment_by'] : 'anyone',
	'options'     => $comment_options,
	'label'       => esc_attr__( 'Comment by', 'wfd' ),
	'label_class' => 'control-label',
	'class'       => 'form-control',
	'label_attr'  => '',
	'desc'        => esc_html__( 'who can see the comment', 'wud' ),
);

$form->get_field( $field_args );
