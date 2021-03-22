<?php
$exclude = wud_app()->query->get_exclude_doc_ids();
?>
<form id="share-email-form" method="post" action="#" data-parsley-validate>

    <div class="form-group">
        <label for="share_email"><?php echo esc_html__( 'Email address :', 'wud' ); ?></label>
        <input type="text" class="form-control" id="share_email" name="val[to]" required>
        <small id="emailHelp"
               class="form-text text-muted"><?php echo esc_html__( 'Separate multiple emails with a comma.', 'wud' ); ?></small>
    </div>
    <div class="table form-group">
        <label for="subject"><?php echo esc_html__( 'Subject :', 'wud' ); ?></label>
        <input type="text" class="form-control" name="val[subject]" size="30"
               value="<?php echo esc_attr__( 'Check out: ', 'wud' ) . esc_attr( $doc['name'] ); ?>" required>
    </div>
    <div class="table form-group">
        <label for="subject"><?php echo esc_html__( 'Message :', 'wud' ); ?></label>

        <textarea cols="30" rows="10" name="val[message]" class="form-control" required><?php echo esc_textarea( 'Hi, Check this out...', 'wud' ); ?>

<a href="<?php echo get_permalink( $doc['ID'] ); ?>"><?php echo get_permalink( $doc['ID'] ); ?></a>
        </textarea>
    </div>
	<?php if ( $doc['email_attachment'] == 1
               && $doc['allow_download'] == 1 &&
	            !in_array($doc['ID'], $exclude)) { ?>
        <div class="form-group">
            <label for="subject"><?php echo esc_html__( 'Attachment :', 'wud' ); ?></label>
            <a href="javascript:void(0);"
               onclick="window.location.href='<?php echo esc_url( $doc['link_download'] ); ?>';return false;"><?php echo esc_html($doc['name'] . '.' . $doc['ext']); ?></a>
        </div>
	<?php } else { ?>
        <div class="form-group">
            <p><?php echo esc_html__( 'Attachment is not available, you can still send to emails', 'wud' ); ?></p>
        </div>
	<?php } ?>
    <div class="table_clear">
        <input type="submit" value="<?php echo esc_attr__( 'Send', 'wud' ); ?>" id="send_email" class="button button-regular">
        <small id="message_response" class="form-text text-muted"></small>
    </div>
    <input type="hidden" name="val[id]" value="<?php echo esc_attr( $doc['ID'] ); ?>">
</form>
