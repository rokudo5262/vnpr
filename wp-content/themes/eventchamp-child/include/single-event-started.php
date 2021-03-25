<?php
/**
	* The template for displaying single event
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
								<?php echo eventchamp_event_header( $id = get_the_ID() ); ?>

								<div class="gt-content">
									<?php the_content(); ?>
								</div>

								<?php
									$tags_position = ot_get_option( 'event-tags-position', 'position-1' );

									if( $tags_position == "position-1" ) {

										echo eventchamp_event_tags( $id = get_the_ID(), $position = "position-1" );

									}
								?>

								<?php
									$social_sharing_position = ot_get_option( 'event-social-share-position', 'position-1' );

									if( $social_sharing_position == "position-1" ) {

										echo eventchamp_event_social_sharing();

									}
								?>
							</div>

							<?php echo eventchamp_event_tabs_sections( $id = get_the_ID() ); ?>

							<?php echo eventchamp_event_photos_section( $id = get_the_ID() ); ?>

							<?php
								$event_comments = ot_get_option( 'event_comments' );

								if( $event_comments == "on" or !$event_comments == "off" ) {

									if ( comments_open() || get_comments_number() ) {

										comments_template();

									}

								}
							?>

						<?php echo eventchamp_content_area_after(); ?>

						<?php echo eventchamp_sidebar_before(); ?>
							<?php echo eventchamp_event_sidebar_buttons_box( $id = get_the_ID() ); ?>
							<?php echo eventchamp_event_detail_box( $id = get_the_ID() ); ?>
							<?php echo eventchamp_event_sponsors_box( $id = get_the_ID() ); ?>
							<?php echo eventchamp_event_sidebar_boxes( $id = get_the_ID() ); ?>
							<?php
								$tags_position = ot_get_option( 'event-tags-position', 'position-1' );

								if( $tags_position == "position-2" ) {

									echo eventchamp_event_tags( $id = get_the_ID(), $position = "position-2" );

								}
							?>

							<?php
								$social_sharing_position = ot_get_option( 'event-social-share-position', 'position-1' );

								if( $social_sharing_position == "position-2" ) {

									echo eventchamp_event_social_sharing( $position = "position-2");

								}
							?>

							<?php
								$event_sidebar = ot_get_option( 'event_detail_sidebar_select' );

								if ( is_active_sidebar( $event_sidebar ) )  {

									dynamic_sidebar( $event_sidebar );

								}
							?>

						<?php echo eventchamp_sidebar_after(); ?>

					<?php echo eventchamp_row_after(); ?>

					<?php echo eventchamp_related_events( $id = get_the_ID() ); ?>

				<?php } ?>

			<?php echo eventchamp_container_after(); ?>

		<?php } ?>
		
	<?php echo eventchamp_sub_content_after(); ?>

<?php get_footer();