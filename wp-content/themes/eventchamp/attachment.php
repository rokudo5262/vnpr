<?php
/**
	* The template for displaying attachment
*/
get_header(); ?>

	<?php echo eventchamp_sub_content_before(); ?>

		<?php echo eventchamp_page_title_bar(); ?>

		<?php while ( have_posts() ) { ?>

			<?php the_post(); ?>

			<?php echo eventchamp_container_before(); ?>

				<?php echo eventchamp_row_before(); ?>

					<?php echo eventchamp_content_area_before(); ?>

						<div class="gt-page-content">

							<div class="gt-content">
								<p><?php echo wp_get_attachment_link( get_the_ID(), 'full', true, true ); ?></p>

								<?php the_content(); ?>

							</div>

						</div>

						<?php
							$comments = ot_get_option( 'attachment_comment_area', 'on' );

							if( $comments == "on" ) {

								if ( comments_open() || get_comments_number() ) {

									comments_template();

								}

							}
						?>

					<?php echo eventchamp_content_area_after(); ?>
					
					<?php get_sidebar(); ?> 

				<?php echo eventchamp_row_after(); ?>

			<?php echo eventchamp_container_after(); ?>

		<?php } ?>
		
	<?php echo eventchamp_sub_content_after(); ?>

<?php get_footer();