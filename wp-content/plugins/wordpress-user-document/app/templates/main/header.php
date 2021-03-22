<?php
global $wud_settings;
if ($wud_settings->get_input_value('document_header', 'no') == 'no') {
	return;
}

?>
<header class="wud-documents-header">
	<?php if ( apply_filters( 'wud_show_page_title', true ) ) : ?>
        <h1 class="wud-documents-header__title page-title"><?php wud_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: wud_archive_description.
	 */
	do_action( 'wud_archive_description' );
	?>
</header>
