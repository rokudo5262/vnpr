<?php
/**
	* The template for displaying single
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

							<div class="gt-page-content">
								<?php echo eventchamp_post_header( $id = get_the_ID() ); ?>

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

								<?php echo eventchamp_post_meta( $id = get_the_ID() ); ?>

								<?php 
									$post_tags = ot_get_option( 'post_post_tags', 'on' );
									$tag_style = ot_get_option( 'post-tags-style', 'style-1' );

									if ( $post_tags == 'on' ) {

										the_tags( '<div class="gt-tags gt-' . esc_attr( $tag_style ) . '"><ul><li>', '</li><li>', '</li></ul></div>' );

									}
								?>

								<?php echo eventchamp_post_social_sharing(); ?>
							</div>

							<?php echo eventchamp_post_navigation(); ?>

							<?php echo eventchamp_author_box(); ?>

							<?php echo eventchamp_related_posts( $id = get_the_ID() ); ?>

							<?php
								$post_comments = ot_get_option( 'post_post_comment_area', 'on' );

								if( $post_comments == "on" ) {

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