<?php
$custom_class = 'document';
global $document, $wud_settings;
$doc = $document->get_current_doc();
?>
<tr class="wud-table-row file-info">
    <td class="wud-file-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	        <?php echo esc_html( $doc['name'] ); ?>
        </a>
    </td>
    <td class="wud-file-date">
		<?php echo wud_format_date( $doc['post_date'] ); ?>
    </td>
    <td class="wud-file-type">
		<?php echo esc_html( $doc['ext'] ) ?>
    </td>
    <td class="wud-file-categories">
	    <?php
	    $category_html = get_the_term_list( $doc['ID'], 'wud-category', '', ', ', '' );
	    ?>
	    <?php if ( $category_html != '' ) { ?>
            <?php echo wp_kses( $category_html, array(
				    'a' => array(
					    'href' => array(),
					    'rel' => array(),
				    )
			    ) ); ?>
	    <?php } else {
	        echo esc_html__('--', 'wud');
        } ?>
    </td>
</tr>
