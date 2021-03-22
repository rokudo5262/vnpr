<?php
/**
	* The template for displaying single venue
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
								<?php echo eventchamp_venue_header( $id = get_the_ID() ); ?>

								<div class="gt-content">
									<?php the_content(); ?>
								</div>

								<?php
									$tags_position = ot_get_option( 'venue-tags-position', 'position-1' );

									if( $tags_position == "position-1" ) {

										echo eventchamp_venue_tags( $id = get_the_ID(), $position = "position-1" );

									}
								?>

								<?php
									$social_sharing_position = ot_get_option( 'venue-social-share-position', 'position-1' );

									if( $social_sharing_position == "position-1" ) {

										echo eventchamp_venue_social_sharing();

									}
								?>
							</div>

							<?php echo eventchamp_venue_photos_section( $id = get_the_ID() ); ?>

							<?php
								$venue_map_position = ot_get_option( 'venue-map-position', 'position-2' );

								if( $venue_map_position == "position-1" ) {

									echo eventchamp_venue_map_box( $id = get_the_ID(), $position = "position-1");

								}
							?>

							<?php
								$venue_comments = ot_get_option( 'venue-comments' );

								if( $venue_comments == "on" or !$venue_comments == "off" ) {

									if ( comments_open() || get_comments_number() ) {

										comments_template();

									}

								}
							?>

						<?php echo eventchamp_content_area_after(); ?>

						<?php echo eventchamp_sidebar_before(); ?>

							<?php echo eventchamp_venue_detail_box( $id = get_the_ID() ); ?>

							<?php echo eventchamp_venue_working_hours_box( $id = get_the_ID() ); ?>

							<?php
								$venue_map_position = ot_get_option( 'venue-map-position', 'position-2' );

								if( $venue_map_position == "position-2" ) {

									echo eventchamp_venue_map_box( $id = get_the_ID(), $position = "position-2");

								}
							?>

							<?php echo eventchamp_venue_sidebar_buttons_box( $id = get_the_ID() ); ?>

							<?php echo eventchamp_venue_sidebar_boxes( $id = get_the_ID() ); ?>

							<?php
								$tags_position = ot_get_option( 'venue-tags-position', 'position-1' );

								if( $tags_position == "position-2" ) {

									echo eventchamp_venue_tags( $id = get_the_ID(), $position = "position-2" );

								}
							?>

							<?php
								$social_sharing_position = ot_get_option( 'venue-social-share-position', 'position-1' );

								if( $social_sharing_position == "position-2" ) {

									echo eventchamp_venue_social_sharing( $position = "position-2");

								}
							?>

							<?php
								$venue_sidebar = ot_get_option( 'venue_detail_sidebar_select' );

								if ( is_active_sidebar( $venue_sidebar ) )  {

									dynamic_sidebar( $venue_sidebar );

								}
							?>

						<?php echo eventchamp_sidebar_after(); ?>

					<?php echo eventchamp_row_after(); ?>

					<?php echo eventchamp_venue_events( $id = get_the_ID() ); ?>

					<?php echo eventchamp_related_venues( $id = get_the_ID() ); ?>

				<?php } ?>

			<?php echo eventchamp_container_after(); ?>

		<?php } ?>
		
	<?php echo eventchamp_sub_content_after(); ?>

<?php get_footer();