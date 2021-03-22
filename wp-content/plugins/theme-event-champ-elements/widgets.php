<?php
/*======
*
* Blog Widget
*
======*/
	if( !function_exists( 'eventchamp_latest_posts_register_widgets' ) ) {

		function eventchamp_latest_posts_register_widgets() {

			register_widget( 'eventchamp_latest_posts_widget' );

		}
		add_action( 'widgets_init', 'eventchamp_latest_posts_register_widgets' );

	}



	if( !class_exists( 'eventchamp_latest_posts_widget' ) ) {

		class eventchamp_latest_posts_widget extends WP_Widget {

			function __construct() {

				parent::__construct(
			            'eventchamp_latest_posts_widget',
		        	    esc_html__( 'Eventchamp: Blog', 'eventchamp' ),
		 	           array( 'description' => esc_html__( 'Blog widget.', 'eventchamp' ), )
				);

			}
			
			function widget( $args, $instance ) {

				echo $args['before_widget'];

					if ( !empty( $instance['latest_posts_widget_title'] ) ) {

						echo '<div class="gt-widget-title">';
							echo '<span>' . esc_attr( $instance['latest_posts_widget_title'] ) . '</span>';
						echo '</div>';

					}

					/*====== Instance ======*/
					if( !empty( $instance ) ) {

						$latest_posts_widget_title = esc_attr( $instance['latest_posts_widget_title'] );
						$latest_posts_widget_category = esc_attr( $instance['latest_posts_widget_category'] );
						$latest_posts_widget_exclude = esc_attr( $instance['latest_posts_widget_exclude'] );
						$latest_posts_widget_offset = esc_attr( $instance['latest_posts_widget_offset'] );
						$latest_posts_widget_post_count = esc_attr( $instance['latest_posts_widget_post_count'] );

					}
					
					/*====== Exclude ======*/
					if( !empty( $latest_posts_widget_exclude ) ) {

						$latest_posts_widget_exclude = $latest_posts_widget_exclude;
						$latest_posts_widget_exclude = explode( ',', $latest_posts_widget_exclude );

					}

					/*====== HTML Output ======*/
					echo eventchamp_widget_before();

						echo '<div class="gt-blog-widget">';

							$args_latest_posts = array(
								'post_status' => 'publish',
								'post_type' => 'post',
								'posts_per_page' => $latest_posts_widget_post_count,
								'post__not_in' => $latest_posts_widget_exclude,
								'offset' => $latest_posts_widget_offset,
								'cat' => $latest_posts_widget_category
							);
							$wp_query = new WP_Query( $args_latest_posts );

							if( $wp_query->have_posts() ) {

								echo '<div class="gt-columns gt-column-1 gt-column-space-15">';

									while ( $wp_query->have_posts() ) {

										$wp_query->the_post();

										echo '<div class="gt-col">';
											echo '<div class="gt-inner">';
												echo eventchamp_post_list_style_3( $post_id = get_the_ID(), $image = "true", $post_info = "true" );
											echo '</div>';
										echo '</div>';

									}
									wp_reset_postdata();

								echo '</div>';

							}

						echo '</div>';

					echo eventchamp_widget_after();

				echo $args['after_widget'];

			}

			function update( $new_instance, $old_instance ) {

				$instance = $old_instance;
				$instance['latest_posts_widget_title'] = esc_attr( $new_instance['latest_posts_widget_title'] );
				$instance['latest_posts_widget_category'] = esc_attr( $new_instance['latest_posts_widget_category'] );
				$instance['latest_posts_widget_exclude'] = esc_attr( $new_instance['latest_posts_widget_exclude'] );
				$instance['latest_posts_widget_offset'] = esc_attr( $new_instance['latest_posts_widget_offset'] );
				$instance['latest_posts_widget_post_count'] = esc_attr( $new_instance['latest_posts_widget_post_count'] );

				return $instance;

			}

			function form( $instance ) {

				$latest_posts_widget_title = '';
				$latest_posts_widget_category = '';
				$latest_posts_widget_exclude = '';
				$latest_posts_widget_offset = '';
				$latest_posts_widget_post_count = '';

				if( !empty( $instance ) ) {

					$latest_posts_widget_title = esc_attr( $instance['latest_posts_widget_title'] );
					$latest_posts_widget_category = esc_attr( $instance['latest_posts_widget_category'] );
					$latest_posts_widget_exclude = esc_attr( $instance['latest_posts_widget_exclude'] );
					$latest_posts_widget_offset = esc_attr( $instance['latest_posts_widget_offset'] );
					$latest_posts_widget_post_count = esc_attr( $instance['latest_posts_widget_post_count'] );

				}

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ) . '">' . esc_html__( 'Widget Title', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_posts_widget_title' ) ) . '" type="text" value="' . esc_attr( $latest_posts_widget_title ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_posts_widget_post_count' ) ) . '">' . esc_html__( 'Post Count', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_posts_widget_post_count' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_posts_widget_post_count' ) ) . '" type="text" value="' . esc_attr( $latest_posts_widget_post_count ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_posts_widget_category' ) ) . '">' . esc_html__( 'Category', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'latest_posts_widget_category' ) ) . '" id="' . esc_attr( $this->get_field_id( 'latest_posts_widget_category' ) ) . '" class="widefat"> ';
						echo '<option value="">' . esc_html__( 'All Categories', 'eventchamp' ) . '</option>';

						 $categories = get_categories( 'child_of=0' );

						 if( !empty( $categories ) ) {

							 foreach ( $categories as $category ) {

								if( !empty( $categories ) ) {

									$selected = '';

									if ( $latest_posts_widget_category == $category->cat_ID ) {
										$selected = "selected";
									}

									echo '<option value="' . esc_attr( $category->cat_ID ) . '" ' . esc_attr( $selected ) . '>' . esc_attr( $category->cat_name ) . '</option>';
								}

							 }

						 }

					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_posts_widget_exclude' ) ) . '">' . esc_html__( 'Exclude Posts', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_posts_widget_exclude' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_posts_widget_exclude' ) ) . '" type="text" value="' . esc_attr( $latest_posts_widget_exclude ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_posts_widget_offset' ) ) . '">' . esc_html__( 'Offset', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_posts_widget_offset' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_posts_widget_offset' ) ) . '" type="text" value="' . esc_attr( $latest_posts_widget_offset ) . '" />';
				echo '</p>';

			}

		}

	}



/*======
*
* Events Widget
*
======*/
	if( !function_exists( 'eventchamp_latest_events_register_widgets' ) ) {

		function eventchamp_latest_events_register_widgets() {

			register_widget( 'eventchamp_latest_events_widget' );

		}
		add_action( 'widgets_init', 'eventchamp_latest_events_register_widgets' );

	}



	if( !class_exists( 'eventchamp_latest_events_widget' ) ) {

		class eventchamp_latest_events_widget extends WP_Widget {

			function __construct() {

				parent::__construct(

					'eventchamp_latest_events_widget',
					esc_html__( 'Eventchamp: Events', 'eventchamp' ),
					array( 'description' => esc_html__( 'Event listing widget.', 'eventchamp' ), )

				);

			}

			function widget( $args, $instance ) {

				echo $args['before_widget'];

					if ( !empty( $instance['latest_events_widget_title'] ) ) {

						echo '<div class="gt-widget-title">';
							echo '<span>' . esc_attr( $instance['latest_events_widget_title'] ) . '</span>';
						echo '</div>';

					}

					if( !empty( $instance ) ) {

						$latest_events_widget_style = esc_attr( $instance['latest_events_widget_style'] );
						$latest_events_widget_title = esc_attr( $instance['latest_events_widget_title'] );
						$latest_events_widget_category = esc_attr( $instance['latest_events_widget_category'] );
						$latest_events_widget_exclude = esc_attr( $instance['latest_events_widget_exclude'] );
						$latest_events_widget_ids = esc_attr( $instance['latest_events_widget_ids'] );
						$latest_events_widget_offset = esc_attr( $instance['latest_events_widget_offset'] );
						$latest_events_widget_event_count = esc_attr( $instance['latest_events_widget_event_count'] );

					}
					
					/*====== Exclude ======*/
					if( !empty( $latest_events_widget_exclude ) ) {

						$latest_events_widget_exclude = $latest_events_widget_exclude;
						$latest_events_widget_exclude = explode( ',', $latest_events_widget_exclude );

					}
					
					/*====== Include ======*/
					if( !empty( $latest_events_widget_ids ) ) {

						$latest_events_widget_ids = $latest_events_widget_ids;
						$latest_events_widget_ids = explode( ',', $latest_events_widget_ids );

					}

					/*====== HTML Output ======*/
					echo eventchamp_widget_before();

						echo '<div class="gt-events-widget">';

							if( !empty( $latest_events_widget_category ) ) {

								$query_args = array(
									'posts_per_page' => $latest_events_widget_event_count,
									'post_status' => 'publish',
									'post__not_in' => $latest_events_widget_exclude,
									'post__in' => $latest_events_widget_ids,
									'offset' => $latest_events_widget_offset,
									'post_type' => 'event',
									'tax_query' => array(
										array(
											'taxonomy' => 'eventcat',
											'field' => 'term_id',
											'terms' => $latest_events_widget_category,
										),
									),
								);

							} else {

								$query_args = array(
									'posts_per_page' => $latest_events_widget_event_count,
									'post_status' => 'publish',
									'post__not_in' => $latest_events_widget_exclude,
									'post__in' => $latest_events_widget_ids,
									'offset' => $latest_events_widget_offset,
									'post_type' => 'event',
								);

							}

							$wp_query = new WP_Query( $query_args );

							if( $wp_query->have_posts() ) {

								if( $latest_events_widget_style == "style2" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-15">';

										while ( $wp_query->have_posts() ) {
											$wp_query->the_post();
											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_event_list_style_2( $post_id = get_the_ID(), $image = "true", $date = "true", $location = "true", $venue = "false" );
												echo '</div>';
											echo '</div>';
										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_events_widget_style == "style1" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {
											$wp_query->the_post();
											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "", $status = "true", $price = "true", $venue = "false", $ticket_amount = "false", $time = "false" );
												echo '</div>';
											echo '</div>';
										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_events_widget_style == "style3" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-10">';

										while ( $wp_query->have_posts() ) {
											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "", $status = "true", $price = "true", $venue = "false", $ticket_amount = "false", $time = "false" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_events_widget_style == "style4" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {

											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "", $status = "true", $price = "true", $venue = "false", $ticket_amount = "false", $time = "false" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								}

							}

						echo '</div>';

					echo eventchamp_widget_after();

				echo $args['after_widget'];
				
			}

			function update( $new_instance, $old_instance ) {

				$instance = $old_instance;
				$instance['latest_events_widget_style'] = esc_attr( $new_instance['latest_events_widget_style'] );
				$instance['latest_events_widget_title'] = esc_attr( $new_instance['latest_events_widget_title'] );
				$instance['latest_events_widget_category'] = esc_attr( $new_instance['latest_events_widget_category'] );
				$instance['latest_events_widget_exclude'] = esc_attr( $new_instance['latest_events_widget_exclude'] );
				$instance['latest_events_widget_ids'] =  esc_attr( $new_instance['latest_events_widget_ids'] );
				$instance['latest_events_widget_offset'] = esc_attr( $new_instance['latest_events_widget_offset'] );
				$instance['latest_events_widget_event_count'] = esc_attr( $new_instance['latest_events_widget_event_count'] );

				return $instance;

			}

			function form( $instance ) {

				$latest_events_widget_style = '';
				$latest_events_widget_title = '';
				$latest_events_widget_category = '';
				$latest_events_widget_exclude = '';
				$latest_events_widget_ids = '';
				$latest_events_widget_offset = '';
				$latest_events_widget_event_count = '';

				if( !empty( $instance ) ) {

					$latest_events_widget_style = esc_attr( $instance['latest_events_widget_style'] );
					$latest_events_widget_title = esc_attr( $instance['latest_events_widget_title'] );
					$latest_events_widget_category = esc_attr( $instance['latest_events_widget_category'] );
					$latest_events_widget_exclude = esc_attr( $instance['latest_events_widget_exclude'] );
					$latest_events_widget_ids = esc_attr( $instance['latest_events_widget_ids'] );
					$latest_events_widget_offset = esc_attr( $instance['latest_events_widget_offset'] );
					$latest_events_widget_event_count = esc_attr( $instance['latest_events_widget_event_count'] );

				}

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_events_widget_title' ) ) . '">' . esc_html__( 'Widget Title', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_events_widget_title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_events_widget_title' ) ) . '" type="text" value="' . esc_attr( $latest_events_widget_title ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_events_widget_event_count' ) ) . '">' . esc_html__( 'Event Count', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_events_widget_event_count' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_events_widget_event_count' ) ) . '" type="text" value="' . esc_attr( $latest_events_widget_event_count ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_events_widget_category' ) ) . '">' . esc_html__( 'Event Category', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_events_widget_category' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_events_widget_category' ) ) . '" type="text" value="' . esc_attr( $latest_events_widget_category ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_events_widget_exclude' ) ) . '">' . esc_html__( 'Exclude Events', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_events_widget_exclude' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_events_widget_exclude' ) ) . '" type="text" value="' . esc_attr( $latest_events_widget_exclude ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_events_widget_ids' ) ) . '">' . esc_html__( "Include Events:", "eventchamp" ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_events_widget_ids' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_events_widget_ids' ) ) . '" type="text" value="' . esc_attr( $latest_events_widget_ids ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_events_widget_offset' ) ) . '">' . esc_html__( 'Offset', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_events_widget_offset' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_events_widget_offset' ) ) . '" type="text" value="' . esc_attr( $latest_events_widget_offset ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_events_widget_style' ) ) . '">' . esc_html__( 'Style', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'latest_events_widget_style' ) ) . '" id="' . esc_attr( $this->get_field_id( 'latest_events_widget_style' ) ) . '" class="widefat"> ';
						echo '<option value="style1" ' . ( $latest_events_widget_style == "style1" ? 'selected' : '' ) . '>' . esc_html__( 'Style 1', 'eventchamp' ) . '</option>';
						echo '<option value="style2" ' . ( $latest_events_widget_style == "style2" ? 'selected' : '' ) . '>' . esc_html__( 'Style 2', 'eventchamp' ) . '</option>';
						echo '<option value="style3" ' . ( $latest_events_widget_style == "style3" ? 'selected' : '' ) . '>' . esc_html__( 'Style 3', 'eventchamp' ) . '</option>';
						echo '<option value="style4" ' . ( $latest_events_widget_style == "style4" ? 'selected' : '' ) . '>' . esc_html__( 'Style 4', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

			}

		}

	}



/*======
*
* Venues Widget
*
======*/
	if( !function_exists( 'eventchamp_latest_venues_register_widgets' ) ) {

		function eventchamp_latest_venues_register_widgets() {

			register_widget( 'eventchamp_latest_venues_widget' );

		}
		add_action( 'widgets_init', 'eventchamp_latest_venues_register_widgets' );

	}



	if( !class_exists( 'eventchamp_latest_venues_widget' ) ) {

		class eventchamp_latest_venues_widget extends WP_Widget {

			function __construct() {

				parent::__construct(
					'eventchamp_latest_venues_widget',
					esc_html__( 'Eventchamp: Venues', 'eventchamp' ),
					array( 'description' => esc_html__( 'Venue listing widget.', 'eventchamp' ), )
				);

			}
			
			function widget( $args, $instance ) {

				echo $args['before_widget'];

					if ( !empty( $instance['latest_venues_widget_title'] ) ) {

						echo '<div class="gt-widget-title">';
							echo '<span>' . esc_attr( $instance['latest_venues_widget_title'] ) . '</span>';
						echo '</div>';

					}

					if( !empty( $instance ) ) {

						$latest_venues_widget_style = esc_attr( $instance['latest_venues_widget_style'] );
						$latest_venues_widget_title = esc_attr( $instance['latest_venues_widget_title'] );
						$latest_venues_widget_exclude = esc_attr( $instance['latest_venues_widget_exclude'] );
						$latest_venues_widget_ids = esc_attr( $instance['latest_venues_widget_ids'] );
						$latest_venues_widget_offset = esc_attr( $instance['latest_venues_widget_offset'] );
						$latest_venues_widget_venue_count = esc_attr( $instance['latest_venues_widget_venue_count'] );

					}
					
					/*====== Exclude ======*/
					if( !empty( $latest_venues_widget_exclude ) ) {

						$latest_venues_widget_exclude = $latest_venues_widget_exclude;
						$latest_venues_widget_exclude = explode( ',', $latest_venues_widget_exclude );

					}
					
					/*====== Include ======*/
					if( !empty( $latest_venues_widget_ids ) ) {

						$latest_venues_widget_ids = $latest_venues_widget_ids;
						$latest_venues_widget_ids = explode( ',', $latest_venues_widget_ids );

					}

					/*====== HTML Output ======*/
					echo eventchamp_widget_before();

						echo '<div class="gt-venues-widget">';

							$query_args = array(
								'posts_per_page' => $latest_venues_widget_venue_count,
								'post_status' => 'publish',
								'post__not_in' => $latest_venues_widget_exclude,
								'post__in' => $latest_venues_widget_ids,
								'offset' => $latest_venues_widget_offset,
								'post_type' => 'venue',
							);

							$wp_query = new WP_Query( $query_args );

							if( $wp_query->have_posts() ) {

								if( $latest_venues_widget_style == "style1" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {
											$wp_query->the_post();
											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = "true", $excerpt = "false" );
												echo '</div>';
											echo '</div>';
										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_venues_widget_style == "style2" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-15">';

										while ( $wp_query->have_posts() ) {
											$wp_query->the_post();
											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_venue_list_style_2( $post_id = get_the_ID(), $image = "true", $location = "true" );
												echo '</div>';
											echo '</div>';
										}
										wp_reset_postdata();

									echo '</div>';

								}

							}

						echo '</div>';

					echo eventchamp_widget_after();

				echo $args['after_widget'];

			}

			function update( $new_instance, $old_instance ) {

				$instance = $old_instance;
				$instance['latest_venues_widget_style'] = esc_attr( $new_instance['latest_venues_widget_style'] );
				$instance['latest_venues_widget_title'] = esc_attr( $new_instance['latest_venues_widget_title'] );
				$instance['latest_venues_widget_exclude'] = esc_attr( $new_instance['latest_venues_widget_exclude'] );
				$instance['latest_venues_widget_ids'] = esc_attr( $new_instance['latest_venues_widget_ids'] );
				$instance['latest_venues_widget_offset'] = esc_attr( $new_instance['latest_venues_widget_offset'] );
				$instance['latest_venues_widget_venue_count'] = esc_attr( $new_instance['latest_venues_widget_venue_count'] );

				return $instance;

			}

			function form( $instance ) {

				$latest_venues_widget_style = '';
				$latest_venues_widget_title = '';
				$latest_venues_widget_exclude = '';
				$latest_venues_widget_ids = '';
				$latest_venues_widget_offset = '';
				$latest_venues_widget_venue_count = '';

				if( !empty( $instance ) ) {

					$latest_venues_widget_style = esc_attr( $instance['latest_venues_widget_style'] );
					$latest_venues_widget_title = esc_attr( $instance['latest_venues_widget_title'] );
					$latest_venues_widget_exclude = esc_attr( $instance['latest_venues_widget_exclude'] );
					$latest_venues_widget_ids = esc_attr( $instance['latest_venues_widget_ids'] );
					$latest_venues_widget_offset = esc_attr( $instance['latest_venues_widget_offset'] );
					$latest_venues_widget_venue_count = esc_attr( $instance['latest_venues_widget_venue_count'] );

				}

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_venues_widget_title' ) ) . '">' . esc_html__( 'Widget Title', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_venues_widget_title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_venues_widget_title' ) ) . '" type="text" value="' . esc_attr( $latest_venues_widget_title ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_venues_widget_venue_count' ) ) . '">' . esc_html__( 'Venue Count', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_venues_widget_venue_count' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_venues_widget_venue_count' ) ) . '" type="text" value="' . esc_attr( $latest_venues_widget_venue_count ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_venues_widget_exclude' ) ) . '">' . esc_html__( 'Exclude Venues', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_venues_widget_exclude' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_venues_widget_exclude' ) ) . '" type="text" value="' . esc_attr( $latest_venues_widget_exclude ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_venues_widget_ids' ) ) . '">' . esc_html__( "Include Venues:", "eventchamp" ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_venues_widget_ids' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_venues_widget_ids' ) ) . '" type="text" value="' . esc_attr( $latest_venues_widget_ids ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_venues_widget_offset' ) ) . '">' . esc_html__( 'Offset', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_venues_widget_offset' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_venues_widget_offset' ) ) . '" type="text" value="' . esc_attr( $latest_venues_widget_offset ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_venues_widget_style' ) ) . '">' . esc_html__( 'Style', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'latest_venues_widget_style' ) ) . '" id="' . esc_attr( $this->get_field_id( 'latest_venues_widget_style' ) ) . '" class="widefat"> ';
						echo '<option value="style1" ' . ( $latest_venues_widget_style == "style1" ? 'selected' : '' ) . '>' . esc_html__( 'Style 1', 'eventchamp' ) . '</option>';
						echo '<option value="style2" ' . ( $latest_venues_widget_style == "style2" ? 'selected' : '' ) . '>' . esc_html__( 'Style 2', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

			}

		}

	}



/*======
*
* Speakers Widget
*
======*/
	if( !function_exists( 'eventchamp_latest_speakers_register_widgets' ) ) {

		function eventchamp_latest_speakers_register_widgets() {

			register_widget( 'eventchamp_latest_speakers_widget' );

		}
		add_action( 'widgets_init', 'eventchamp_latest_speakers_register_widgets' );

	}



	if( !class_exists( 'eventchamp_latest_speakers_widget' ) ) {

		class eventchamp_latest_speakers_widget extends WP_Widget {

			function __construct() {

				parent::__construct(
					'eventchamp_latest_speakers_widget',
					esc_html__( 'Eventchamp: Speakers', 'eventchamp' ),
					array( 'description' => esc_html__( 'Speaker listing widget.', 'eventchamp' ), )
				);

			}
			
			function widget( $args, $instance ) {

				echo $args['before_widget'];

					if ( !empty( $instance['latest_speakers_widget_title'] ) ) {

						echo '<div class="gt-widget-title">';
							echo '<span>' . esc_attr( $instance['latest_speakers_widget_title'] ) . '</span>';
						echo '</div>';

					}

					if( !empty( $instance ) ) {

						$latest_speakers_widget_title = esc_attr( $instance['latest_speakers_widget_title'] );
						$latest_speakers_widget_exclude = esc_attr( $instance['latest_speakers_widget_exclude'] );
						$latest_speakers_widget_ids = esc_attr( $instance['latest_speakers_widget_ids'] );
						$latest_speakers_widget_offset = esc_attr( $instance['latest_speakers_widget_offset'] );
						$latest_speakers_widget_style = esc_attr( $instance['latest_speakers_widget_style'] );
						$latest_speakers_widget_speaker_count = esc_attr( $instance['latest_speakers_widget_speaker_count'] );

					}
					
					/*====== Exclude ======*/
					if( !empty( $latest_speakers_widget_exclude ) ) {

						$latest_speakers_widget_exclude = $latest_speakers_widget_exclude;
						$latest_speakers_widget_exclude = explode( ',', $latest_speakers_widget_exclude );

					}

					/*====== Include ======*/
					if( !empty( $latest_speakers_widget_ids ) ) {

						$latest_speakers_widget_ids = $latest_speakers_widget_ids;
						$latest_speakers_widget_ids = explode( ',', $latest_speakers_widget_ids );

					}

					/*====== HTML Output ======*/
					echo eventchamp_widget_before();

						echo '<div class="gt-speakers-widget">';

							$query_args = array(
								'posts_per_page' => $latest_speakers_widget_speaker_count,
								'post_status' => 'publish',
								'post__not_in' => $latest_speakers_widget_exclude,
								'post__in' => $latest_speakers_widget_ids,
								'offset' => $latest_speakers_widget_offset,
								'post_type' => 'speaker',
							);

							$wp_query = new WP_Query( $query_args );

							if( $wp_query->have_posts() ) {

								if( $latest_speakers_widget_style == "style1" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {

											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_speaker_style_1( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_speakers_widget_style == "style2" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {

											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_speaker_style_2( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_speakers_widget_style == "style3" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {

											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_speaker_style_3( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_speakers_widget_style == "style4" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {

											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_speaker_style_4( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_speakers_widget_style == "style5" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {

											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_speaker_style_5( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_speakers_widget_style == "style6" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {

											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_speaker_style_6( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_speakers_widget_style == "style7" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {

											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_speaker_style_7( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								} elseif( $latest_speakers_widget_style == "style8" ) {

									echo '<div class="gt-columns gt-column-1 gt-column-space-30">';

										while ( $wp_query->have_posts() ) {

											$wp_query->the_post();

											echo '<div class="gt-col">';
												echo '<div class="gt-inner">';
													echo eventchamp_speaker_style_8( $post_id = get_the_ID(), $image = "true", $profession = "true", $summary = "true", $social = "true" );
												echo '</div>';
											echo '</div>';

										}
										wp_reset_postdata();

									echo '</div>';

								}

							}

						echo '</div>';

					echo eventchamp_widget_after();

				echo $args['after_widget'];

			}

			function update( $new_instance, $old_instance ) {

				$instance = $old_instance;
				$instance['latest_speakers_widget_title'] = esc_attr( $new_instance['latest_speakers_widget_title'] );
				$instance['latest_speakers_widget_exclude'] = esc_attr( $new_instance['latest_speakers_widget_exclude'] );
				$instance['latest_speakers_widget_ids'] = esc_attr( $new_instance['latest_speakers_widget_ids'] );
				$instance['latest_speakers_widget_offset'] = esc_attr( $new_instance['latest_speakers_widget_offset'] );
				$instance['latest_speakers_widget_style'] = esc_attr( $new_instance['latest_speakers_widget_style'] );
				$instance['latest_speakers_widget_speaker_count'] = esc_attr( $new_instance['latest_speakers_widget_speaker_count'] );

				return $instance;

			}

			function form( $instance ) {

				$latest_speakers_widget_title = '';
				$latest_speakers_widget_exclude = '';
				$latest_speakers_widget_ids = '';
				$latest_speakers_widget_offset = '';
				$latest_speakers_widget_style = '';
				$latest_speakers_widget_speaker_count = '';

				if( !empty( $instance ) ) {

					$latest_speakers_widget_title = esc_attr( $instance['latest_speakers_widget_title'] );
					$latest_speakers_widget_exclude = esc_attr( $instance['latest_speakers_widget_exclude'] );
					$latest_speakers_widget_ids = esc_attr( $instance['latest_speakers_widget_ids'] );
					$latest_speakers_widget_offset = esc_attr( $instance['latest_speakers_widget_offset'] );
					$latest_speakers_widget_style = esc_attr( $instance['latest_speakers_widget_style'] );
					$latest_speakers_widget_speaker_count = esc_attr( $instance['latest_speakers_widget_speaker_count'] );

				}

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_title' ) ) . '">' . esc_html__( 'Widget Title', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_speakers_widget_title' ) ) . '" type="text" value="' . esc_attr( $latest_speakers_widget_title ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_speaker_count' ) ) . '">' . esc_html__( 'Speaker Count', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_speaker_count' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_speakers_widget_speaker_count' ) ) . '" type="text" value="' . esc_attr( $latest_speakers_widget_speaker_count ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_exclude' ) ) . '">' . esc_html__( 'Exclude Speakers', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_exclude' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_speakers_widget_exclude' ) ) . '" type="text" value="' . esc_attr( $latest_speakers_widget_exclude ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_ids' ) ) . '">' . esc_html__( "Include Speakers:", "eventchamp" ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_ids' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_speakers_widget_ids' ) ) . '" type="text" value="' . esc_attr( $latest_speakers_widget_ids ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_offset' ) ) . '">' . esc_html__( 'Offset', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_offset' ) ) . '" name="' . esc_attr( $this->get_field_name( 'latest_speakers_widget_offset' ) ) . '" type="text" value="' . esc_attr( $latest_speakers_widget_offset ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_style' ) ) . '">' . esc_html__( 'Style', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'latest_speakers_widget_style' ) ) . '" id="' . esc_attr( $this->get_field_id( 'latest_speakers_widget_style' ) ) . '" class="widefat"> ';
						echo '<option value="style1" ' . ( $latest_speakers_widget_style == "style1" ? 'selected' : '' ) . '>' . esc_html__( 'Style 1', 'eventchamp' ) . '</option>';
						echo '<option value="style2" ' . ( $latest_speakers_widget_style == "style2" ? 'selected' : '' ) . '>' . esc_html__( 'Style 2', 'eventchamp' ) . '</option>';
						echo '<option value="style3" ' . ( $latest_speakers_widget_style == "style3" ? 'selected' : '' ) . '>' . esc_html__( 'Style 3', 'eventchamp' ) . '</option>';
						echo '<option value="style4" ' . ( $latest_speakers_widget_style == "style4" ? 'selected' : '' ) . '>' . esc_html__( 'Style 4', 'eventchamp' ) . '</option>';
						echo '<option value="style5" ' . ( $latest_speakers_widget_style == "style5" ? 'selected' : '' ) . '>' . esc_html__( 'Style 5', 'eventchamp' ) . '</option>';
						echo '<option value="style6" ' . ( $latest_speakers_widget_style == "style6" ? 'selected' : '' ) . '>' . esc_html__( 'Style 6', 'eventchamp' ) . '</option>';
						echo '<option value="style7" ' . ( $latest_speakers_widget_style == "style7" ? 'selected' : '' ) . '>' . esc_html__( 'Style 7', 'eventchamp' ) . '</option>';
						echo '<option value="style8" ' . ( $latest_speakers_widget_style == "style8" ? 'selected' : '' ) . '>' . esc_html__( 'Style 8', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

			}

		}

	}



/*======
*
* Event Search Widget
*
======*/
	if( !function_exists( 'eventchamp_event_search_register_widgets' ) ) {

		function eventchamp_event_search_register_widgets() {

			register_widget( 'eventchamp_event_search_widget' );

		}
		add_action( 'widgets_init', 'eventchamp_event_search_register_widgets' );

	}



	if( !class_exists( 'eventchamp_event_search_widget' ) ) {

		class eventchamp_event_search_widget extends WP_Widget {

			function __construct() {

				parent::__construct(
					'eventchamp_event_search_widget',
					esc_html__( 'Eventchamp: Event Search', 'eventchamp' ),
					array( 'description' => esc_html__( 'Event search widget.', 'eventchamp' ), )
				);

			}
			
			function widget( $args, $instance ) {

				echo $args['before_widget'];

					if ( !empty( $instance['widget-title'] ) ) {

						echo '<div class="gt-widget-title">';
							echo '<span>' . esc_attr( $instance['widget-title'] ) . '</span>';
						echo '</div>';

					}

					/*====== HTML Output ======*/
					echo eventchamp_widget_before();

						echo '<div class="gt-event-search-widget">';
							echo do_shortcode( '[eventchamp_event_search
								style="' . esc_attr( $instance['style'] ) . '"
								column="' . esc_attr( $instance['column'] ) . '"
								title="' . esc_attr( $instance['search-title'] ) . '"
								startdate="' . esc_attr( $instance['start-date'] ) . '"
								enddate="' . esc_attr( $instance['end-date'] ) . '"
								keyword="' . esc_attr( $instance['keyword'] ) . '"
								category="' . esc_attr( $instance['category'] ) . '"
								location="' . esc_attr( $instance['location'] ) . '"
								venues="' . esc_attr( $instance['venue'] ) . '"
								venue-order="' . esc_attr( $instance['venue-order'] ) . '"
								venue-order-type="' . esc_attr( $instance['venue-order-type'] ) . '"
								speakers="' . esc_attr( $instance['speaker'] ) . '"
								speaker-order="' . esc_attr( $instance['speaker-order'] ) . '"
								speaker-order-type="' . esc_attr( $instance['speaker-order-type'] ) . '"
								organizer="' . esc_attr( $instance['organizer'] ) . '"
								status="' . esc_attr( $instance['status'] ) . '"
								upcoming-status="' . esc_attr( $instance['upcoming-status'] ) . '"
								showing-status="' . esc_attr( $instance['showing-status'] ) . '"
								expired-status="' . esc_attr( $instance['expired-status'] ) . '"
								tag="' . esc_attr( $instance['tag'] ) . '"
								sort="' . esc_attr( $instance['sort'] ) . '"
								price-slider="' . esc_attr( $instance['price-slider'] ) . '"
								price-slider-grid="' . esc_attr( $instance['price-slider-grid'] ) . '"
								price-slider-min-max="' . esc_attr( $instance['price-slider-min-max'] ) . '"
								price-slider-from-to="' . esc_attr( $instance['price-slider-from-to'] ) . '"
								empty-taxonomies="' . esc_attr( $instance['empty-taxonomies'] ) . '"
								childless="' . esc_attr( $instance['childless'] ) . '"
								hide-children="' . esc_attr( $instance['hide-children'] ) . '"
								taxonomy-order="' . esc_attr( $instance['taxonomy-order'] ) . '"
								taxonomy-order-type="' . esc_attr( $instance['taxonomy-order-type'] ) . '"
								slider-column="1"
								slider-space="0"
								slider-autoplay="false"
								slider-loop="false"
								slider-centered-slides="false"
								slider-direction="horizontal"
								slider-effect="slide"
								slider-free-mode="false"
								dark-background=""
								custom-title="' . esc_attr( $instance['custom-search-text'] ) . '"
								custom-keyword-text="' . esc_attr( $instance['custom-keyword-text'] ) . '"
								custom-tag-text="' . esc_attr( $instance['custom-tag-text'] ) . '"
								price-slider-min-price="' . esc_attr( $instance['price-slider-min-price'] ) . '"
								price-slider-max-price="' . esc_attr( $instance['price-slider-max-price'] ) . '"
								price-slider-from="' . esc_attr( $instance['price-slider-from'] ) . '"
								price-slider-to="' . esc_attr( 	$instance['price-slider-to'] ) . '"
								price-slider-step="' . esc_attr( $instance['price-slider-step'] ) . '"
								price-slider-prefix="' . esc_attr( $instance['price-slider-prefix'] ) . '"
								price-slider-postfix="' . esc_attr( $instance['price-slider-postfix'] ) . '"
								exclude-categories="' . esc_attr( $instance['exclude-categories'] ) . '"
								exclude-locations="' . esc_attr( $instance['exclude-locations'] ) . '"
								exclude-organizers="' . esc_attr( $instance['exclude-organizers'] ) . '"
								include-categories="' . esc_attr( $instance['include-categories'] ) . '"
								include-locations="' . esc_attr( $instance['include-locations'] ) . '"
								include-organizers="' . esc_attr( $instance['include-organizers'] ) . '"
								slider-images=""
								slider-height=""
								slider-autoplay-delay=""
								slider-slide-speed=""
								venue-count="' . esc_attr( $instance['venue-count'] ) . '"
								include-venues="' . esc_attr( $instance['include-venues'] ) . '"
								exclude-venues="' . esc_attr( $instance['exclude-venues'] ) . '"
								speaker-count="' . esc_attr( $instance['speaker-count'] ) . '"
								include-speakers="' . esc_attr( $instance['include-speakers'] ) . '"
								exclude-speakers="' . esc_attr( $instance['exclude-speakers'] ) . '"]' );
						echo '</div>';

					echo eventchamp_widget_after();

				echo $args['after_widget'];

			}

			function update( $new_instance, $old_instance ) {

				$instance = $old_instance;
				$instance['widget-title'] = esc_attr( $new_instance['widget-title'] );
				$instance['style'] = esc_attr( $new_instance['style'] );
				$instance['column'] = esc_attr( $new_instance['column'] );
				$instance['search-title'] = esc_attr( $new_instance['search-title'] );
				$instance['custom-search-text'] = esc_attr( $new_instance['custom-search-text'] );
				$instance['start-date'] = esc_attr( $new_instance['start-date'] );
				$instance['end-date'] = esc_attr( $new_instance['end-date'] );
				$instance['keyword'] = esc_attr( $new_instance['keyword'] );
				$instance['custom-keyword-text'] = esc_attr( $new_instance['custom-keyword-text'] );
				$instance['category'] = esc_attr( $new_instance['category'] );
				$instance['location'] = esc_attr( $new_instance['location'] );
				$instance['venue'] = esc_attr( $new_instance['venue'] );
				$instance['venue-count'] = esc_attr( $new_instance['venue-count'] );
				$instance['include-venues'] = esc_attr( $new_instance['include-venues'] );
				$instance['exclude-venues'] = esc_attr( $new_instance['exclude-venues'] );
				$instance['venue-order'] = esc_attr( $new_instance['venue-order'] );
				$instance['venue-order-type'] = esc_attr( $new_instance['venue-order-type'] );
				$instance['speaker'] = esc_attr( $new_instance['speaker'] );
				$instance['speaker-count'] = esc_attr( $new_instance['speaker-count'] );
				$instance['include-speakers'] = esc_attr( $new_instance['include-speakers'] );
				$instance['exclude-speakers'] = esc_attr( $new_instance['exclude-speakers'] );
				$instance['speaker-order'] = esc_attr( $new_instance['speaker-order'] );
				$instance['speaker-order-type'] = esc_attr( $new_instance['speaker-order-type'] );
				$instance['organizer'] = esc_attr( $new_instance['organizer'] );
				$instance['status'] = esc_attr( $new_instance['status'] );
				$instance['upcoming-status'] = esc_attr( $new_instance['upcoming-status'] );
				$instance['showing-status'] = esc_attr( $new_instance['showing-status'] );
				$instance['expired-status'] = esc_attr( $new_instance['expired-status'] );
				$instance['tag'] = esc_attr( $new_instance['tag'] );
				$instance['custom-tag-text'] = esc_attr( $new_instance['custom-tag-text'] );
				$instance['sort'] = esc_attr( $new_instance['sort'] );
				$instance['price-slider'] = esc_attr( $new_instance['price-slider'] );
				$instance['price-slider-grid'] = esc_attr( $new_instance['price-slider-grid'] );
				$instance['price-slider-min-price'] = esc_attr( $new_instance['price-slider-min-price'] );
				$instance['price-slider-max-price'] = esc_attr( $new_instance['price-slider-max-price'] );
				$instance['price-slider-from'] = esc_attr( $new_instance['price-slider-from'] );
				$instance['price-slider-to'] = esc_attr( $new_instance['price-slider-to'] );
				$instance['price-slider-step'] = esc_attr( $new_instance['price-slider-step'] );
				$instance['price-slider-min-max'] = esc_attr( $new_instance['price-slider-min-max'] );
				$instance['price-slider-from-to'] = esc_attr( $new_instance['price-slider-from-to'] );
				$instance['price-slider-prefix'] = esc_attr( $new_instance['price-slider-prefix'] );
				$instance['price-slider-postfix'] = esc_attr( $new_instance['price-slider-postfix'] );
				$instance['empty-taxonomies'] = esc_attr( $new_instance['empty-taxonomies'] );
				$instance['childless'] = esc_attr( $new_instance['childless'] );
				$instance['hide-children'] = esc_attr( $new_instance['hide-children'] );
				$instance['exclude-categories'] = esc_attr( $new_instance['exclude-categories'] );
				$instance['exclude-locations'] = esc_attr( $new_instance['exclude-locations'] );
				$instance['exclude-organizers'] = esc_attr( $new_instance['exclude-organizers'] );
				$instance['include-categories'] = esc_attr( $new_instance['include-categories'] );
				$instance['include-locations'] = esc_attr( $new_instance['include-locations'] );
				$instance['include-organizers'] = esc_attr( $new_instance['include-organizers'] );
				$instance['taxonomy-order'] = esc_attr( $new_instance['taxonomy-order'] );
				$instance['taxonomy-order-type'] = esc_attr( $new_instance['taxonomy-order-type'] );

				return $instance;

			}

			function form( $instance ) {

				if( !empty( $instance ) ) {

					$instance['widget-title'] = esc_attr( $instance['widget-title'] );
					$instance['style'] = esc_attr( $instance['style'] );
					$instance['column'] = esc_attr( $instance['column'] );
					$instance['search-title'] = esc_attr( $instance['search-title'] );
					$instance['custom-search-text'] = esc_attr( $instance['custom-search-text'] );
					$instance['start-date'] = esc_attr( $instance['start-date'] );
					$instance['end-date'] = esc_attr( $instance['end-date'] );
					$instance['keyword'] = esc_attr( $instance['keyword'] );
					$instance['custom-keyword-text'] = esc_attr( $instance['custom-keyword-text'] );
					$instance['category'] = esc_attr( $instance['category'] );
					$instance['location'] = esc_attr( $instance['location'] );
					$instance['venue'] = esc_attr( $instance['venue'] );
					$instance['venue-count'] = esc_attr( $instance['venue-count'] );
					$instance['include-venues'] = esc_attr( $instance['include-venues'] );
					$instance['exclude-venues'] = esc_attr( $instance['exclude-venues'] );
					$instance['venue-order'] = esc_attr( $instance['venue-order'] );
					$instance['venue-order-type'] = esc_attr( $instance['venue-order-type'] );
					$instance['speaker'] = esc_attr( $instance['speaker'] );
					$instance['speaker-count'] = esc_attr( $instance['speaker-count'] );
					$instance['include-speakers'] = esc_attr( $instance['include-speakers'] );
					$instance['exclude-speakers'] = esc_attr( $instance['exclude-speakers'] );
					$instance['speaker-order'] = esc_attr( $instance['speaker-order'] );
					$instance['speaker-order-type'] = esc_attr( $instance['speaker-order-type'] );
					$instance['organizer'] = esc_attr( $instance['organizer'] );
					$instance['status'] = esc_attr( $instance['status'] );
					$instance['upcoming-status'] = esc_attr( $instance['upcoming-status'] );
					$instance['showing-status'] = esc_attr( $instance['showing-status'] );
					$instance['expired-status'] = esc_attr( $instance['expired-status'] );
					$instance['tag'] = esc_attr( $instance['tag'] );
					$instance['custom-tag-text'] = esc_attr( $instance['custom-tag-text'] );
					$instance['sort'] = esc_attr( $instance['sort'] );
					$instance['price-slider'] = esc_attr( $instance['price-slider'] );
					$instance['price-slider-grid'] = esc_attr( $instance['price-slider-grid'] );
					$instance['price-slider-min-price'] = esc_attr( $instance['price-slider-min-price'] );
					$instance['price-slider-max-price'] = esc_attr( $instance['price-slider-max-price'] );
					$instance['price-slider-from'] = esc_attr( $instance['price-slider-from'] );
					$instance['price-slider-to'] = esc_attr( $instance['price-slider-to'] );
					$instance['price-slider-step'] = esc_attr( $instance['price-slider-step'] );
					$instance['price-slider-min-max'] = esc_attr( $instance['price-slider-min-max'] );
					$instance['price-slider-from-to'] = esc_attr( $instance['price-slider-from-to'] );
					$instance['price-slider-prefix'] = esc_attr( $instance['price-slider-prefix'] );
					$instance['price-slider-postfix'] = esc_attr( $instance['price-slider-postfix'] );
					$instance['empty-taxonomies'] = esc_attr( $instance['empty-taxonomies'] );
					$instance['childless'] = esc_attr( $instance['childless'] );
					$instance['hide-children'] = esc_attr( $instance['hide-children'] );
					$instance['exclude-categories'] = esc_attr( $instance['exclude-categories'] );
					$instance['exclude-locations'] = esc_attr( $instance['exclude-locations'] );
					$instance['exclude-organizers'] = esc_attr( $instance['exclude-organizers'] );
					$instance['include-categories'] = esc_attr( $instance['include-categories'] );
					$instance['include-locations'] = esc_attr( $instance['include-locations'] );
					$instance['include-organizers'] = esc_attr( $instance['include-organizers'] );
					$instance['taxonomy-order'] = esc_attr( $instance['taxonomy-order'] );
					$instance['taxonomy-order-type'] = esc_attr( $instance['taxonomy-order-type'] );

				} else {

					$instance['widget-title'] = "";
					$instance['style'] = "";
					$instance['column'] = "";
					$instance['search-title'] = "";
					$instance['custom-search-text'] = "";
					$instance['start-date'] = "";
					$instance['end-date'] = "";
					$instance['keyword'] = "";
					$instance['custom-keyword-text'] = "";
					$instance['category'] = "";
					$instance['location'] = "";
					$instance['venue'] = "";
					$instance['venue-count'] = "";
					$instance['include-venues'] = "";
					$instance['exclude-venues'] = "";
					$instance['venue-order'] = "";
					$instance['venue-order-type'] = "";
					$instance['speaker'] = "";
					$instance['speaker-count'] = "";
					$instance['include-speakers'] = "";
					$instance['exclude-speakers'] = "";
					$instance['speaker-order'] = "";
					$instance['speaker-order-type'] = "";
					$instance['organizer'] = "";
					$instance['status'] = "";
					$instance['upcoming-status'] = "";
					$instance['showing-status'] = "";
					$instance['expired-status'] = "";
					$instance['tag'] = "";
					$instance['custom-tag-text'] = "";
					$instance['sort'] = "";
					$instance['price-slider'] = "";
					$instance['price-slider-grid'] = "";
					$instance['price-slider-min-price'] = "";
					$instance['price-slider-max-price'] = "";
					$instance['price-slider-from'] = "";
					$instance['price-slider-to'] = "";
					$instance['price-slider-step'] = "";
					$instance['price-slider-min-max'] = "";
					$instance['price-slider-from-to'] = "";
					$instance['price-slider-prefix'] = "";
					$instance['price-slider-postfix'] = "";
					$instance['empty-taxonomies'] = "";
					$instance['childless'] = "";
					$instance['hide-children'] = "";
					$instance['exclude-categories'] = "";
					$instance['exclude-locations'] = "";
					$instance['exclude-organizers'] = "";
					$instance['include-categories'] = "";
					$instance['include-locations'] = "";
					$instance['include-organizers'] = "";
					$instance['taxonomy-order'] = "";
					$instance['taxonomy-order-type'] = "";

				}

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'widget-title' ) ) . '">' . esc_html__( 'Widget Title', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'widget-title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'widget-title' ) ) . '" type="text" value="' . esc_attr( $instance['widget-title'] ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'style' ) ) . '">' . esc_html__( 'Style', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'style' ) ) . '" id="' . esc_attr( $this->get_field_id( 'style' ) ) . '" class="widefat"> ';
						echo '<option value="white" ' . ( $instance['style'] == "white" ? 'selected' : '' ) . '>' . esc_html__( 'Style 1', 'eventchamp' ) . '</option>';
						echo '<option value="dark" ' . ( $instance['style'] == "dark" ? 'selected' : '' ) . '>' . esc_html__( 'Style 2', 'eventchamp' ) . '</option>';
						echo '<option value="style-3" ' . ( $instance['style'] == "style-3" ? 'selected' : '' ) . '>' . esc_html__( 'Style 3', 'eventchamp' ) . '</option>';
						echo '<option value="style-4" ' . ( $instance['style'] == "style-4" ? 'selected' : '' ) . '>' . esc_html__( 'Style 4', 'eventchamp' ) . '</option>';
						echo '<option value="style-5" ' . ( $instance['style'] == "style-5" ? 'selected' : '' ) . '>' . esc_html__( 'Style 5', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'column' ) ) . '">' . esc_html__( 'Column', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'column' ) ) . '" id="' . esc_attr( $this->get_field_id( 'column' ) ) . '" class="widefat"> ';
						echo '<option value="1" ' . ( $instance['column'] == "1" ? 'selected' : '' ) . '>' . esc_html__( 'Column 1', 'eventchamp' ) . '</option>';
						echo '<option value="2" ' . ( $instance['column'] == "2" ? 'selected' : '' ) . '>' . esc_html__( 'Column 2', 'eventchamp' ) . '</option>';
						echo '<option value="3" ' . ( $instance['column'] == "3" ? 'selected' : '' ) . '>' . esc_html__( 'Column 3', 'eventchamp' ) . '</option>';
						echo '<option value="4" ' . ( $instance['column'] == "4" ? 'selected' : '' ) . '>' . esc_html__( 'Column 4', 'eventchamp' ) . '</option>';
						echo '<option value="5" ' . ( $instance['column'] == "5" ? 'selected' : '' ) . '>' . esc_html__( 'Column 5', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'search-title' ) ) . '">' . esc_html__( 'Search Title', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'search-title' ) ) . '" id="' . esc_attr( $this->get_field_id( 'search-title' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['search-title'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['search-title'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'custom-search-text' ) ) . '">' . esc_html__( 'Custom Search Text', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'custom-search-text' ) ) . '" name="' . esc_attr( $this->get_field_name( 'custom-search-text' ) ) . '" type="text" value="' . esc_attr( $instance['custom-search-text'] ) . '" />';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'start-date' ) ) . '">' . esc_html__( 'Start Date', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'start-date' ) ) . '" id="' . esc_attr( $this->get_field_id( 'start-date' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['start-date'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['start-date'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'end-date' ) ) . '">' . esc_html__( 'End Date', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'end-date' ) ) . '" id="' . esc_attr( $this->get_field_id( 'end-date' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['end-date'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['end-date'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'keyword' ) ) . '">' . esc_html__( 'Keyword', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'keyword' ) ) . '" id="' . esc_attr( $this->get_field_id( 'keyword' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['keyword'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['keyword'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'custom-keyword-text' ) ) . '">' . esc_html__( 'Custom Keyword Text', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'custom-keyword-text' ) ) . '" name="' . esc_attr( $this->get_field_name( 'custom-keyword-text' ) ) . '" type="text" value="' . esc_attr( $instance['custom-keyword-text'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter a text. Default: e.g. event, meetup', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'category' ) ) . '">' . esc_html__( 'Category', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'category' ) ) . '" id="' . esc_attr( $this->get_field_id( 'category' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['category'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['category'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'location' ) ) . '">' . esc_html__( 'Locations', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'location' ) ) . '" id="' . esc_attr( $this->get_field_id( 'location' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['location'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['location'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'venue' ) ) . '">' . esc_html__( 'Venues', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'venue' ) ) . '" id="' . esc_attr( $this->get_field_id( 'venue' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['venue'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['venue'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'venue-count' ) ) . '">' . esc_html__( 'Venue Count', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'venue-count' ) ) . '" name="' . esc_attr( $this->get_field_name( 'venue-count' ) ) . '" type="text" value="' . esc_attr( $instance['venue-count'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter an venue count.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'include-venues' ) ) . '">' . esc_html__( 'Include Venues', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'include-venues' ) ) . '" name="' . esc_attr( $this->get_field_name( 'include-venues' ) ) . '" type="text" value="' . esc_attr( $instance['include-venues'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter venue ids. Example: 1,2,3 etc.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'exclude-venues' ) ) . '">' . esc_html__( 'Exclude Venues', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'exclude-venues' ) ) . '" name="' . esc_attr( $this->get_field_name( 'exclude-venues' ) ) . '" type="text" value="' . esc_attr( $instance['exclude-venues'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter venue ids. Example: 1,2,3 etc.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'venue-order' ) ) . '">' . esc_html__( 'Venue Order', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'venue-order' ) ) . '" id="' . esc_attr( $this->get_field_id( 'venue-order' ) ) . '" class="widefat"> ';
						echo '<option value="DESC" ' . ( $instance['venue-order'] == "DESC" ? 'selected' : '' ) . '>' . esc_html__( 'DESC', 'eventchamp' ) . '</option>';
						echo '<option value="ASC" ' . ( $instance['venue-order'] == "ASC" ? 'selected' : '' ) . '>' . esc_html__( 'ASC', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'venue-order-type' ) ) . '">' . esc_html__( 'Venue Order Type', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'venue-order-type' ) ) . '" id="' . esc_attr( $this->get_field_id( 'venue-order-type' ) ) . '" class="widefat"> ';
						echo '<option value="added-date" ' . ( $instance['venue-order-type'] == "added-date" ? 'selected' : '' ) . '>' . esc_html__( 'Added Date', 'eventchamp' ) . '</option>';
						echo '<option value="popular-comment" ' . ( $instance['venue-order-type'] == "popular-comment" ? 'selected' : '' ) . '>' . esc_html__( 'Popular by Comments', 'eventchamp' ) . '</option>';
						echo '<option value="id" ' . ( $instance['venue-order-type'] == "id" ? 'selected' : '' ) . '>' . esc_html__( 'ID', 'eventchamp' ) . '</option>';
						echo '<option value="title" ' . ( $instance['venue-order-type'] == "title" ? 'selected' : '' ) . '>' . esc_html__( 'Title', 'eventchamp' ) . '</option>';
						echo '<option value="menu_order" ' . ( $instance['venue-order-type'] == "menu_order" ? 'selected' : '' ) . '>' . esc_html__( 'Menu Order', 'eventchamp' ) . '</option>';
						echo '<option value="rand" ' . ( $instance['venue-order-type'] == "rand" ? 'selected' : '' ) . '>' . esc_html__( 'Random', 'eventchamp' ) . '</option>';
						echo '<option value="post__in" ' . ( $instance['speaker-order-type'] == "post__in" ? 'selected' : '' ) . '>' . esc_html__( 'By Include IDs', 'eventchamp' ) . '</option>';
						echo '<option value="none" ' . ( $instance['venue-order-type'] == "none" ? 'selected' : '' ) . '>' . esc_html__( 'None', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'speaker' ) ) . '">' . esc_html__( 'Speakers', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'speaker' ) ) . '" id="' . esc_attr( $this->get_field_id( 'speaker' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['speaker'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['speaker'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'speaker-count' ) ) . '">' . esc_html__( 'Speaker Count', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'speaker-count' ) ) . '" name="' . esc_attr( $this->get_field_name( 'speaker-count' ) ) . '" type="text" value="' . esc_attr( $instance['speaker-count'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter an speaker count.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'include-speakers' ) ) . '">' . esc_html__( 'Include Speakers', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'include-speakers' ) ) . '" name="' . esc_attr( $this->get_field_name( 'include-speakers' ) ) . '" type="text" value="' . esc_attr( $instance['include-speakers'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter speaker ids. Example: 1,2,3 etc.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'exclude-speakers' ) ) . '">' . esc_html__( 'Exclude Speakers', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'exclude-speakers' ) ) . '" name="' . esc_attr( $this->get_field_name( 'exclude-speakers' ) ) . '" type="text" value="' . esc_attr( $instance['exclude-speakers'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter speaker ids. Example: 1,2,3 etc.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'speaker-order' ) ) . '">' . esc_html__( 'Speaker Order', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'speaker-order' ) ) . '" id="' . esc_attr( $this->get_field_id( 'speaker-order' ) ) . '" class="widefat"> ';
						echo '<option value="DESC" ' . ( $instance['speaker-order'] == "DESC" ? 'selected' : '' ) . '>' . esc_html__( 'DESC', 'eventchamp' ) . '</option>';
						echo '<option value="ASC" ' . ( $instance['speaker-order'] == "ASC" ? 'selected' : '' ) . '>' . esc_html__( 'ASC', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'speaker-order-type' ) ) . '">' . esc_html__( 'Speaker Order Type', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'speaker-order-type' ) ) . '" id="' . esc_attr( $this->get_field_id( 'speaker-order-type' ) ) . '" class="widefat"> ';
						echo '<option value="added-date" ' . ( $instance['speaker-order-type'] == "added-date" ? 'selected' : '' ) . '>' . esc_html__( 'Added Date', 'eventchamp' ) . '</option>';
						echo '<option value="popular-comment" ' . ( $instance['speaker-order-type'] == "popular-comment" ? 'selected' : '' ) . '>' . esc_html__( 'Popular by Comments', 'eventchamp' ) . '</option>';
						echo '<option value="id" ' . ( $instance['speaker-order-type'] == "id" ? 'selected' : '' ) . '>' . esc_html__( 'ID', 'eventchamp' ) . '</option>';
						echo '<option value="title" ' . ( $instance['speaker-order-type'] == "title" ? 'selected' : '' ) . '>' . esc_html__( 'Title', 'eventchamp' ) . '</option>';
						echo '<option value="menu_order" ' . ( $instance['speaker-order-type'] == "menu_order" ? 'selected' : '' ) . '>' . esc_html__( 'Menu Order', 'eventchamp' ) . '</option>';
						echo '<option value="rand" ' . ( $instance['speaker-order-type'] == "rand" ? 'selected' : '' ) . '>' . esc_html__( 'Random', 'eventchamp' ) . '</option>';
						echo '<option value="post__in" ' . ( $instance['speaker-order-type'] == "post__in" ? 'selected' : '' ) . '>' . esc_html__( 'By Include IDs', 'eventchamp' ) . '</option>';
						echo '<option value="none" ' . ( $instance['speaker-order-type'] == "none" ? 'selected' : '' ) . '>' . esc_html__( 'None', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'organizer' ) ) . '">' . esc_html__( 'Organizers', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'organizer' ) ) . '" id="' . esc_attr( $this->get_field_id( 'organizer' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['organizer'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['organizer'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'status' ) ) . '">' . esc_html__( 'Status', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'status' ) ) . '" id="' . esc_attr( $this->get_field_id( 'status' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['status'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['status'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'upcoming-status' ) ) . '">' . esc_html__( 'Upcoming for the Status', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'upcoming-status' ) ) . '" id="' . esc_attr( $this->get_field_id( 'upcoming-status' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['upcoming-status'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['upcoming-status'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'showing-status' ) ) . '">' . esc_html__( 'Upcoming for the Status', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'showing-status' ) ) . '" id="' . esc_attr( $this->get_field_id( 'showing-status' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['showing-status'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['showing-status'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'expired-status' ) ) . '">' . esc_html__( 'Upcoming for the Status', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'expired-status' ) ) . '" id="' . esc_attr( $this->get_field_id( 'expired-status' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['expired-status'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['expired-status'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'tag' ) ) . '">' . esc_html__( 'Tag', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'tag' ) ) . '" id="' . esc_attr( $this->get_field_id( 'tag' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['tag'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['tag'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'custom-tag-text' ) ) . '">' . esc_html__( 'Custom Tag Text', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'custom-tag-text' ) ) . '" name="' . esc_attr( $this->get_field_name( 'custom-tag-text' ) ) . '" type="text" value="' . esc_attr( $instance['custom-tag-text'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter a tag text. Enter a tag: art, food', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'sort' ) ) . '">' . esc_html__( 'Sort', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'sort' ) ) . '" id="' . esc_attr( $this->get_field_id( 'sort' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['sort'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['sort'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider' ) ) . '">' . esc_html__( 'Price Slider', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'price-slider' ) ) . '" id="' . esc_attr( $this->get_field_id( 'price-slider' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['price-slider'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['price-slider'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-grid' ) ) . '">' . esc_html__( 'Grid for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'price-slider-grid' ) ) . '" id="' . esc_attr( $this->get_field_id( 'price-slider-grid' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['price-slider-grid'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['price-slider-grid'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-min-price' ) ) . '">' . esc_html__( 'Min Price for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'price-slider-min-price' ) ) . '" name="' . esc_attr( $this->get_field_name( 'price-slider-min-price' ) ) . '" type="text" value="' . esc_attr( $instance['price-slider-min-price'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter a min price for the price slider. Default: 0', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-max-price' ) ) . '">' . esc_html__( 'Max Price for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'price-slider-max-price' ) ) . '" name="' . esc_attr( $this->get_field_name( 'price-slider-max-price' ) ) . '" type="text" value="' . esc_attr( $instance['price-slider-max-price'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter a max price for the price slider. Default: 999', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-from' ) ) . '">' . esc_html__( 'From Price for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'price-slider-from' ) ) . '" name="' . esc_attr( $this->get_field_name( 'price-slider-from' ) ) . '" type="text" value="' . esc_attr( $instance['price-slider-from'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter a from price for the price slider. Set start position for left handle (or for single handle). Default: 0', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-to' ) ) . '">' . esc_html__( 'To Price for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'price-slider-to' ) ) . '" name="' . esc_attr( $this->get_field_name( 'price-slider-to' ) ) . '" type="text" value="' . esc_attr( $instance['price-slider-to'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter a to price for the price slider. Set start position for right handle. Default: 299', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-step' ) ) . '">' . esc_html__( 'Step for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'price-slider-step' ) ) . '" name="' . esc_attr( $this->get_field_name( 'price-slider-step' ) ) . '" type="text" value="' . esc_attr( $instance['price-slider-step'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter a step for the price slider. Set sliders step. Always > 0. Could be fractional. Default: 1', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-min-max' ) ) . '">' . esc_html__( 'Hide Min-Max Label for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'price-slider-min-max' ) ) . '" id="' . esc_attr( $this->get_field_id( 'price-slider-min-max' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['price-slider-min-max'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['price-slider-min-max'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-from-to' ) ) . '">' . esc_html__( 'Hide From-To Label for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'price-slider-from-to' ) ) . '" id="' . esc_attr( $this->get_field_id( 'price-slider-from-to' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['price-slider-min-max'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['price-slider-min-max'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-prefix' ) ) . '">' . esc_html__( 'Prefix for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'price-slider-prefix' ) ) . '" name="' . esc_attr( $this->get_field_name( 'price-slider-prefix' ) ) . '" type="text" value="' . esc_attr( $instance['price-slider-prefix'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter a prefix text. Will be set up right before the number. Example: $100', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'price-slider-postfix' ) ) . '">' . esc_html__( 'Postfix for the Price Slider', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'price-slider-postfix' ) ) . '" name="' . esc_attr( $this->get_field_name( 'price-slider-postfix' ) ) . '" type="text" value="' . esc_attr( $instance['price-slider-postfix'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter a postfix text. Will be set up right after the number. Example: 100k', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'empty-taxonomies' ) ) . '">' . esc_html__( 'Empty Taxonomies', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'empty-taxonomies' ) ) . '" id="' . esc_attr( $this->get_field_id( 'empty-taxonomies' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['empty-taxonomies'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['empty-taxonomies'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
					echo '<i>' . esc_html__( 'You can choose visible status of the empty taxonomies. If you choose true option empty taxonomies will be hide.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'childless' ) ) . '">' . esc_html__( 'Childless', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'childless' ) ) . '" id="' . esc_attr( $this->get_field_id( 'childless' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['childless'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['childless'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'hide-children' ) ) . '">' . esc_html__( 'Hide Children', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'hide-children' ) ) . '" id="' . esc_attr( $this->get_field_id( 'hide-children' ) ) . '" class="widefat"> ';
						echo '<option value="false" ' . ( $instance['hide-children'] == "false" ? 'selected' : '' ) . '>' . esc_html__( 'False', 'eventchamp' ) . '</option>';
						echo '<option value="true" ' . ( $instance['hide-children'] == "true" ? 'selected' : '' ) . '>' . esc_html__( 'True', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'exclude-categories' ) ) . '">' . esc_html__( 'Exclude Categories', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'exclude-categories' ) ) . '" name="' . esc_attr( $this->get_field_name( 'exclude-categories' ) ) . '" type="text" value="' . esc_attr( $instance['exclude-categories'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter category ids. Example: 1,2,3 etc.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'exclude-locations' ) ) . '">' . esc_html__( 'Exclude Locations', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'exclude-locations' ) ) . '" name="' . esc_attr( $this->get_field_name( 'exclude-locations' ) ) . '" type="text" value="' . esc_attr( $instance['exclude-locations'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'exclude-organizers' ) ) . '">' . esc_html__( 'Exclude Organizers', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'exclude-organizers' ) ) . '" name="' . esc_attr( $this->get_field_name( 'exclude-organizers' ) ) . '" type="text" value="' . esc_attr( $instance['exclude-organizers'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter organizer ids. Separate with commas. Example: 1,2,3 etc.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'include-categories' ) ) . '">' . esc_html__( 'Include Categories', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'include-categories' ) ) . '" name="' . esc_attr( $this->get_field_name( 'include-categories' ) ) . '" type="text" value="' . esc_attr( $instance['include-categories'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter category ids. Example: 1, 2, 3 etc. If you have sub categories, it will work only for parents.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'include-locations' ) ) . '">' . esc_html__( 'Include Locations', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'include-locations' ) ) . '" name="' . esc_attr( $this->get_field_name( 'include-locations' ) ) . '" type="text" value="' . esc_attr( $instance['include-locations'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter location ids. Separate with commas. Example: 1,2,3 etc. If you have sub locations, it will work only for parents.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'include-organizers' ) ) . '">' . esc_html__( 'Include Organizers', 'eventchamp' ) . '</label>';
					echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'include-organizers' ) ) . '" name="' . esc_attr( $this->get_field_name( 'include-organizers' ) ) . '" type="text" value="' . esc_attr( $instance['include-organizers'] ) . '" />';
					echo '<i>' . esc_html__( 'You can enter organizer ids. Separate with commas. Example: 1,2,3 etc. If you have sub organizers, it will work only for parents.', 'eventchamp' ) . '</i>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'taxonomy-order' ) ) . '">' . esc_html__( 'Taxonomy Order', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'taxonomy-order' ) ) . '" id="' . esc_attr( $this->get_field_id( 'taxonomy-order' ) ) . '" class="widefat"> ';
						echo '<option value="ASC" ' . ( $instance['taxonomy-order'] == "ASC" ? 'selected' : '' ) . '>' . esc_html__( 'ASC', 'eventchamp' ) . '</option>';
						echo '<option value="DESC" ' . ( $instance['taxonomy-order'] == "DESC" ? 'selected' : '' ) . '>' . esc_html__( 'DESC', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';

				echo '<p>';
					echo '<label for="' . esc_attr( $this->get_field_id( 'taxonomy-order-type' ) ) . '">' . esc_html__( 'Taxonomy Order Type', 'eventchamp' ) . '</label>';
					echo '<select name="' . esc_attr( $this->get_field_name( 'taxonomy-order-type' ) ) . '" id="' . esc_attr( $this->get_field_id( 'taxonomy-order-type' ) ) . '" class="widefat"> ';
						echo '<option value="name" ' . ( $instance['taxonomy-order-type'] == "name" ? 'selected' : '' ) . '>' . esc_html__( 'Name', 'eventchamp' ) . '</option>';
						echo '<option value="slug" ' . ( $instance['taxonomy-order-type'] == "slug" ? 'selected' : '' ) . '>' . esc_html__( 'Slug', 'eventchamp' ) . '</option>';
						echo '<option value="term_group" ' . ( $instance['taxonomy-order-type'] == "term_group" ? 'selected' : '' ) . '>' . esc_html__( 'Term Group', 'eventchamp' ) . '</option>';
						echo '<option value="term_id" ' . ( $instance['taxonomy-order-type'] == "term_id" ? 'selected' : '' ) . '>' . esc_html__( 'Term ID', 'eventchamp' ) . '</option>';
						echo '<option value="id" ' . ( $instance['taxonomy-order-type'] == "id" ? 'selected' : '' ) . '>' . esc_html__( 'ID', 'eventchamp' ) . '</option>';
						echo '<option value="description" ' . ( $instance['taxonomy-order-type'] == "description" ? 'selected' : '' ) . '>' . esc_html__( 'Description', 'eventchamp' ) . '</option>';
						echo '<option value="parent" ' . ( $instance['taxonomy-order-type'] == "parent" ? 'selected' : '' ) . '>' . esc_html__( 'Parent', 'eventchamp' ) . '</option>';
						echo '<option value="count" ' . ( $instance['taxonomy-order-type'] == "count" ? 'selected' : '' ) . '>' . esc_html__( 'Count', 'eventchamp' ) . '</option>';
					echo '</select>';
				echo '</p>';


			}

		}

	}