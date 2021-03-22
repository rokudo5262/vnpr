<?php
get_header( 'doc' );

/**
 * Hook: wud_before_container.
 *
 */
do_action( 'wud_before_container' );

/**
 * Hook: wud_sidebar_right.
 *
 */
do_action( 'wud_sidebar_left' );

/**
 * Hook: wud_before_main_content.
 */
do_action( 'wud_before_main_content' );

if ( have_posts() ) {

	/**
	 * Hook: wud_before_document_loop.
	 */
	do_action( 'wud_before_document_loop' );

	wud_document_loop_start();

	if ( wud_get_loop_prop( 'total' ) ) {
		if ( wud_get_loop_prop ('list_type') == 'list_table') {
			$type = 'table_list';
		} else {
			$type = 'content';
		}
		while ( have_posts() ) {
			the_post();
			do_action( 'wud_doc_in_loop' );
			wud_get_template_part( 'single/' . $type, 'document' );
		}
	}

	wud_document_loop_end();

	/**
	 * Hook: wud_after_document_loop.
	 */
	do_action( 'wud_after_document_loop' );
} else {
	/**
	 * Hook: wud_no_documents_found.
	 */
	do_action( 'wud_no_documents_found' );
}


/**
 * Hook: wud_after_main_content.
 *
 */
do_action( 'wud_after_main_content' );

/**
 * Hook: wud_sidebar_right.
 *
 */
do_action( 'wud_sidebar_right' );

/**
 * Hook: wud_after_container.
 *
 */
do_action( 'wud_after_container' );
?>

<?php get_footer( 'doc' ); ?>
