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

								if( is_post_type_archive( 'speaker' ) or is_tax( 'speaker-tags' ) or is_tax( 'speaker-category' ) ) {
				
									echo '<div class="gt-columns gt-column-2 gt-column-space-30">';

										while ( have_posts() ) {

											the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_speaker_style_3( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );
												echo '</div>';
											echo '</div>';

										}

									echo '</div>';

								} elseif( is_post_type_archive( 'event' ) or is_tax( 'event_tags' ) or is_tax( 'eventcat' ) or is_tax( 'organizer' ) ) {

									$style = ot_get_option( 'event-listing-style', 'style-1' );
									$column = ot_get_option( 'event-listing-column', '2' );

									echo '<div class="gt-columns gt-column-' . esc_attr( $column ) . ' gt-column-space-30">';

										while ( have_posts() ) {

											the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';

													if( $style == "style-1" ) {

														echo eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "true", $status = "true", $price = "true", $venue = "false" );

													} elseif( $style == "style-2" ) {

														echo eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "true", $status = "true", $price = "true", $venue = "false" );

													} elseif( $style == "style-3" ) {

														echo eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "true", $status = "true", $price = "true", $venue = "false" );

													}

												echo '</div>';
											echo '</div>';

										}

									echo '</div>';

								} elseif( is_post_type_archive( 'venue' ) or is_tax( 'venue_tags' ) or is_tax( 'venuecat' ) ) {

									echo '<div class="gt-columns gt-column-2 gt-column-space-30">';

										while ( have_posts() ) {

											the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';

													echo eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = "true", $excerpt = "true" );

												echo '</div>';
											echo '</div>';

										}

									echo '</div>';

								} else {

									echo eventchamp_post_listing();

								}

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