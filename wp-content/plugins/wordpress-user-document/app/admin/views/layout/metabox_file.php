<?php
global $wud_settings;
// The actual fields for data entry
$max_upload_size = wp_max_upload_size();
if ( ! $max_upload_size ) {
	$max_upload_size = 0;
}

$max_file_size_mb = number_format_i18n( $max_upload_size / MB_IN_BYTES, 0 );

?>
<div id="forms_field_wud_browse_file" class="form-field-wrapper field-file ">

    <div class="field-text">
        <label class="field-label"><?php echo esc_html__( 'Select file', 'wud' ); ?></label>
    </div>
    <div class="field-wrapper">

        <div id="versions">
            <div id="versions-list-files">
				<?php if ( count( $versions ) ) { ?>
                    <table class="wp-list-table widefat">
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
                                    <input type="radio" name="doc_version_chosen"
                                           data-id="<?php echo esc_attr( $doc_var['doc_id'] ); ?>"
                                           data-mtid="<?php echo esc_attr( $doc_var['meta_id'] ); ?>" <?php checked( $doc['real_file'], $doc_var['real_file'], true ); ?>
                                           value="<?php echo esc_attr( $doc_var['meta_id'] ); ?>"/>
                                </td>
                                <td>
                                    <input type="checkbox" name="doc_version_delete[]"
                                           data-id="<?php echo esc_attr( $doc_var['doc_id'] ); ?>"
                                           data-mtid="<?php echo esc_attr( $doc_var['meta_id'] ); ?>"
                                           value="<?php echo esc_attr( $doc_var['meta_id'] ); ?>"/>
                                </td>
                            </tr>
						<?php } ?>
                        </tbody>
                    </table>
				<?php } ?>
            </div>
        </div>
        <hr>
        <input type="file" name="wud_doc_file"
               id="wud_doc_file" <?php echo empty( $versions ) ? 'data-parsley-required="true"' : 'data-parsley-required="false"'; ?>
               data-parsley-maxfilesize="<?php echo esc_attr( $max_file_size_mb ); ?>">
        <p class="description"><?php printf( esc_html__( 'Add a document file with file type is : %s, maximum upload file size: %s.' ), implode( ', ', $wud_settings->get_exts() ), esc_html( size_format( $max_upload_size ) ) ); ?></p>

    </div>
</div>
<div id="forms_field_wud_params_version" class="form-field-wrapper field-text ">
    <div class="field-text">
        <label class="field-label"><?php echo esc_html__( 'Version', 'wud' ); ?></label>
    </div>
	<?php
	$field_options = array(
		'type'    => 'text',
		'name'    => 'wud_params[version]',
		'value'   => $doc['version'],
		'class'   => '',
		'desc'    => '',
		'extra_attr'    => 'data-parsley-required="true"',
		'wrapper' => '',
	);
	$form->get_field( $field_options );
	?>
</div>