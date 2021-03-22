<?php
/*
	* The template for displaying page
*/
get_header(); ?>

	<?php echo eventchamp_sub_content_before(); ?>

		<?php echo eventchamp_page_title_bar(); ?>

		<?php while ( have_posts() ) { ?>

			<?php the_post(); ?>

			<?php echo eventchamp_container_before(); ?>

				<?php
					if( post_password_required() ) {

						if( function_exists( 'eventchamp_password_protected_box' ) ) {

							echo eventchamp_password_protected_box();

						}

					} else {
				?>

					<?php echo eventchamp_row_before(); ?>

						<?php echo eventchamp_content_area_before(); ?>

							<?php
								$box_layout = get_post_meta( get_the_ID(), 'box_layout', true );

								if( empty( $box_layout ) or $box_layout == "default" ) {

									$box_layout = ot_get_option( 'eventchamp_box_layout', 'on' );

								}
							?>

							<?php if( $box_layout == "on" ) { ?>

								<div class="gt-page-content">

							<?php } ?>

								<?php echo eventchamp_page_header( $id = get_the_ID() ); ?>

								<div class="gt-content">
									<?php the_content(); ?>
								</div>

								<?php
									wp_link_pages(
										array(
											'before' => '<div class="gt-post-pages"><span class="gt-title">' . esc_html__( 'Pages:', 'eventchamp' ) . '</span>',
											'after' => '</div>',
											'link_before' => '<span>',
											'link_after' => '</span>',
										)
									);
								?>

							<?php if( $box_layout == "on" ) { ?>

								</div>

							<?php } ?>

							<?php
								$comments = ot_get_option( 'page_comment_area', 'on' );

								if( $comments == "on" ) {

									if ( comments_open() || get_comments_number() ) {

										comments_template();

									}

								}
							?>

						<?php echo eventchamp_content_area_after(); ?>
						
						<?php get_sidebar(); ?> 

					<?php echo eventchamp_row_after(); ?>

				<?php } ?>

			<?php echo eventchamp_container_after(); ?>

		<?php } ?>
		
	<?php echo eventchamp_sub_content_after(); ?>

<?php get_footer();