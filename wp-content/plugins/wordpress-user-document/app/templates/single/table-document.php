<?php
$custom_class = 'document';
global $document, $wud_settings;
$doc = $document->get_current_doc();
?>
<tr class="wud-table-row file-info">
	<?php if ( $wud_settings->get_input_value( 'user_can_delete', 'yes' ) === 'yes' ) { ?>
        <td><input id="cb-select-<?php echo esc_attr( $doc['ID'] ); ?>" type="checkbox" name="post[]"
                   value="<?php echo esc_attr( $doc['ID'] ); ?>" class="post-checkbox"></td>
	<?php } ?>
    <td>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php echo wud_get_download_label( $doc['approved'], $doc['featured'], $doc['post_date'] ); ?>
			<?php the_post_thumbnail( 'document-thumbnail',
				array(
					'class' => 'img-responsive document-thumbnail',
					'title' => $doc['name'],
					'alt'   => $doc['name']
				)
			);
			?>
        </a>
    </td>
    <td class="wud-file-title"><?php echo esc_html( $doc['name'] ); ?></td>
    <td class="wud-file-desc">
		<?php echo wp_trim_words( get_the_excerpt(), 20, ' ...' ) ?>
    </td>
    <td class="wud-file-size">
		<?php echo esc_html( size_format( $doc['size'] ) ); ?>
    </td>
    <td class="wud-file-views">
		<?php echo wud_format_count( $doc['count'] ); ?>
    </td>
    <td class="wud-file-version">
		<?php echo esc_html( $doc['version'] ); ?>
    </td>
    <td class="wud-file-date">
		<?php echo wud_format_date( $doc['post_date'] ); ?>
    </td>
    <td class="wud-file-modified-date">
		<?php echo wud_format_date( $doc['post_modified'] ); ?>
    </td>
    <td class="wud-file-link">
        <a class="wud-file-linkdown" href="<?php echo esc_url( $doc['link_download'] ); ?>" data-id="<?php echo esc_attr( $doc['ID'] ); ?>"
           title="<?php echo esc_attr( $doc['name'] ); ?>"><i class="fas fa-download"></i> <?php echo esc_html__( 'Download', 'wud' ); ?>
        </a>
		<?php if ( wud_user_can_edit_doc($doc) ) { ?>
            <a class="wud-file-edit" href="<?php echo esc_url( wud_get_account_endpoint_url( 'edit-document', $doc['ID'] ) ); ?>"
               data-id="<?php echo esc_attr( $doc['ID'] ); ?>"
               title="<?php echo esc_attr( $doc['name'] ); ?>"><i class="fas fa-edit"></i> <?php echo esc_html__( 'Edit', 'wud' ); ?></a>
		<?php } ?>
    </td>
</tr>
