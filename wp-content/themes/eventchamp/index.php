<?php
/*
	* The template for displaying archive
*/
get_header(); ?>

	<?php echo eventchamp_sub_content_before(); ?>

		<?php echo eventchamp_page_title_bar(); ?>

		<?php echo eventchamp_container_before(); ?>

			<?php echo eventchamp_row_before(); ?>

				<?php echo eventchamp_content_area_before(); ?>

					<?php
						echo '<div class="gt-page-content">';

							if ( have_posts() ) {

								echo eventchamp_post_listing();

								echo eventchamp_pagination();	

							} else {

								get_template_part( 'include/formats/content', 'none' );

							}

						echo '</div>';
					?>

				<?php echo eventchamp_content_area_after(); ?>
				
				<?php get_sidebar(); ?> 

			<?php echo eventchamp_row_after(); ?>
			
		<?php echo eventchamp_container_after(); ?>

	<?php echo eventchamp_sub_content_after(); ?>
	
<?php get_footer();