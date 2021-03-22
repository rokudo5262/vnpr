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

while ( have_posts() ) : the_post();
	wud_get_template( 'single/single' );
endwhile;
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

