<?php
/*
	* The template for displaying 404 page
*/
get_header(); ?>

	<?php echo eventchamp_sub_content_before(); ?>

		<div class="gt-404-page">

			<?php echo eventchamp_container_before(); ?>

				<?php echo eventchamp_content_title( $title = esc_html__( '404', 'eventchamp' ), $sec_title =  esc_html__( 'Page', 'eventchamp' ), $text = esc_html__( 'The page you are looking for does not exist; it may have been moved or removed altogether.', 'eventchamp' ), $separate = "true", $icon = "fas fa-exclamation-triangle" ); ?>

			<?php echo eventchamp_container_after(); ?>

		</div>

	<?php echo eventchamp_sub_content_after(); ?>
	
<?php get_footer();
