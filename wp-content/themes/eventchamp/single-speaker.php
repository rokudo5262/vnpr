<?php
/**
	* The template for displaying single speaker
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
								<?php echo eventchamp_speaker_header( $id = get_the_ID() ); ?>

								<div class="gt-content">
									<?php the_content(); ?>
								</div>

								<?php
									$tags_position = ot_get_option( 'speaker-tags-position', 'position-1' );

									if( $tags_position == "position-1" ) {

										echo eventchamp_speaker_tags( $id = get_the_ID(), $position = "position-1" );

									}
								?>

								<?php
									$social_sharing_position = ot_get_option( 'speaker-social-share-position', 'position-1' );

									if( $social_sharing_position == "position-1" ) {

										echo eventchamp_speaker_social_sharing();

									}
								?>
							</div>

							<?php echo eventchamp_speaker_photos_section( $id = get_the_ID() ); ?>

							<?php
								$speaker_comments = ot_get_option( 'speaker-comments', 'on' );

								if( $speaker_comments == "on" ) {

									if ( comments_open() || get_comments_number() ) {

										comments_template();

									}

								}
							?>

						<?php echo eventchamp_content_area_after(); ?>

						<?php echo eventchamp_sidebar_before(); ?>

							<?php echo eventchamp_speaker_detail_box( $id = get_the_ID() ); ?>

							<?php echo eventchamp_speaker_sidebar_buttons( $id = get_the_ID() ); ?>

							<?php echo eventchamp_speaker_sidebar_boxes( $id = get_the_ID() ); ?>

							<?php
								$tags_position = ot_get_option( 'speaker-tags-position', 'position-1' );

								if( $tags_position == "position-2" ) {

									echo eventchamp_speaker_tags( $id = get_the_ID(), $position = "position-2" );

								}
							?>

							<?php
								$social_sharing_position = ot_get_option( 'speaker-social-share-position', 'position-1' );

								if( $social_sharing_position == "position-2" ) {

									echo eventchamp_speaker_social_sharing( $position = "position-2");

								}
							?>

							<?php
								$speaker_sidebar = ot_get_option( 'speaker_detail_sidebar_select' );

								if ( is_active_sidebar( $speaker_sidebar ) )  {

									dynamic_sidebar( $speaker_sidebar );

								}
							?>

						<?php echo eventchamp_sidebar_after(); ?>

					<?php echo eventchamp_row_after(); ?>

					<?php echo eventchamp_speaker_events( $id = get_the_ID() ); ?>

					<?php echo eventchamp_related_speakers( $id = get_the_ID() ); ?>

				<?php } ?>

			<?php echo eventchamp_container_after(); ?>

		<?php } ?>
		
	<?php echo eventchamp_sub_content_after(); ?>

<?php get_footer();