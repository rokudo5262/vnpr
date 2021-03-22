<?php
/*======
*
* Breadcrumbs
*
======*/
if( !function_exists( 'eventchamp_breadcrumbs' ) ) {

	function eventchamp_breadcrumbs() {

		if ( !is_front_page() or !is_home() ) {

			$output = '<div class="gt-breadcrumb">';
				$output .= '<nav aria-label="breadcrumb">';

					if( function_exists( 'bcn_display' ) ) {

						$output .= '<ol>';
							$output .= bcn_display_list( $return = true );
						$output .= '</ol>';

					} elseif ( function_exists( 'yoast_breadcrumb' ) ) {

						$yoast_breadcrumb = yoast_breadcrumb( '', '', false );
						$output .= '<ol>';
							$output .= str_replace( 'span', 'li', $yoast_breadcrumb );
						$output .= '</ol>';

					} else {

						$output .= '<ol>';

							/*====== Homepages ======*/
							$home_title = esc_html__( 'Home', 'eventchamp' );
							$output .= '<li class="gt-item gt-item-home">';
								$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_attr( $home_title ) . '</a>';
							$output .= '</li>';

							/*====== Main global variables ======*/
							global $post, $wp_query;
							$custom_taxonomy = 'product_cat'; // Custom taxonomy names. If you have any post type posts, these taxonomies will add to breadcrumb in those posts.

							/*====== Post types ======*/
							if ( is_post_type_archive() ) {

								$output .= '<li class="gt-item gt-item-current">' . post_type_archive_title( '', false ) . '</li>';

							/*====== Taxonomies ======*/
							} elseif ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

								$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
								$terms = $term;
								$terms_items = array();

								if( !empty( $terms ) ) {

									while( $terms->parent > 0 ) {

										$terms = get_term( esc_attr( $terms->parent ), get_query_var( 'taxonomy' ) );

										$tax_item = '<li class="gt-item">';
											$tax_item .= '<a href="' . get_term_link( $terms, get_query_var( 'taxonomy' ) ) . '">' . esc_attr( $terms->name ) . '</a>';
										$tax_item .= '</li>';

										array_push( $terms_items, $tax_item );

									}

								}

								$output .= implode( '', array_reverse( $terms_items ) );
								$output .= '<li class="gt-item gt-item-current">' . esc_attr( $term->name ) . '</li>';

							/*====== Attachments ======*/
							} elseif ( is_attachment() ) {

								if ( !empty( $post->post_parent ) ) {

									$output .= '<li class="gt-item">';
										$output .= '<a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a>';
									$output .= '</li>';

								}

								$output .= '<li class="gt-item gt-item-current">' . get_the_title() . '</li>';

							/*====== Singles ======*/
							} elseif ( is_single() ) {

								$post_type = get_post_type();
								$category = get_the_category();
								$taxonomy_exists = taxonomy_exists( $custom_taxonomy );

								/*====== Single of post types ======*/
								if( $post_type != 'post' ) {

									if( !empty( $post_type ) ) {

										$post_type_object = get_post_type_object( $post_type );
										$post_type_archive = get_post_type_archive_link( $post_type );

										if( !empty( $post_type_object ) and !empty( $post_type_archive ) ) {

											$output .= '<li class="gt-item">';
												$output .= '<a href="' . esc_url( $post_type_archive ) . '">' . esc_attr( $post_type_object->labels->name ) . '</a>';
											$output .= '</li>';

										}

									}

								}

								/*====== Categories of singles ======*/
								if( !empty( $category ) ) {

									$last_category = end( $category );
									$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
									$cat_parents = explode( ',', $get_cat_parents );
									
								}

								if( empty( $last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {

									$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );

									if ( $taxonomy_terms && ! is_wp_error( $taxonomy_terms ) ) {

										$cat_id = $taxonomy_terms[0]->term_id;
										$cat_nicename = $taxonomy_terms[0]->slug;
										$cat_link = get_term_link( $taxonomy_terms[0]->term_id, $custom_taxonomy );
										$cat_name = $taxonomy_terms[0]->name;

									} else {

										$cat_id = "";
										$cat_nicename = "";
										$cat_link = "";
										$cat_name = "";

									}

								}

								if( !empty( $last_category ) ) {

									if( !empty( $cat_parents ) ) {

										foreach( $cat_parents as $parents ) {

											if( !empty( $parents ) ) {

												$output .= '<li class="gt-item">' . $parents . '</li>';

											}

										}

									}

									/*====== Title of singles ======*/
									$output .= '<li class="gt-item gt-item-current">' . get_the_title() . '</li>';

								} elseif( !empty( $cat_id ) ) {

									$output .= '<li class="gt-item">';
										$output .= '<a href="' . esc_url( $cat_link ) . '">' . esc_attr( $cat_name ) . '</a>';
									$output .= '</li>';
									$output .= '<li class="gt-item gt-item-current">' . get_the_title() . '</li>';

								} else {

									$output .= '<li class="gt-item gt-item-current">' . get_the_title() . '</li>';

								}

							/*====== Categories ======*/
							} elseif ( is_category() ) {

								if ( $term_ids = get_ancestors( get_queried_object_id(), 'category', 'taxonomy' ) ) {

									$cats = array();

									if( !empty( $term_ids ) ) {

										foreach ( $term_ids as $term_id ) {

											if( !empty( $term_id ) ) {

												$term = get_term( $term_id, 'category' );

												if ( $term && ! is_wp_error( $term ) ) {

													$cats[] = sprintf( '<li class="gt-item"><a href="%1$s">%2$s</a></li>', esc_url( get_term_link( $term ) ), esc_html( $term->name ) );

												}

											}

										}

									}

									$output .= implode( '', array_reverse( $cats ) );

								}

								$output .= '<li class="gt-item gt-item-current">' . single_cat_title( '', false ) . '</li>';

							/*====== Pages ======*/
							} elseif ( is_page() ) {

								if( $post->post_parent ) {

									$page_parents = get_post_ancestors( $post->ID );
									$page_parents = array_reverse( $page_parents );

									if ( !isset( $parents ) ) {

										$parents = null;

										if( !empty( $page_parents ) ) {

											foreach ( $page_parents as $parent ) {

												if( !empty( $parent ) ) {

													$output .= '<li class="gt-item">';
														$output .= '<a href="' . get_permalink( $parent ) . '">' . get_the_title( $parent ) . '</a>';
													$output .= '</li>';

												}

											}

										}

									}

									$output .= '<li class="gt-item gt-item-current">' . get_the_title() . '</li>';

								} else {

									$output .= '<li class="gt-item gt-item-current">' . get_the_title() . '</li>';

								}

							/*====== Tags ======*/
							} elseif ( is_tag() ) {

								$output .= '<li class="gt-item gt-item-current">' . single_tag_title( '', false ) . '</li>';

							/*====== Days ======*/
							} elseif ( is_day() ) {

								$output .= '<li class="gt-item">';
									$output .= '<a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a>';
								$output .= '</li>';

								$output .= '<li class="gt-item">';
									$output .= '<a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . get_the_time( 'F' ) . '</a>';
								$output .= '</li>';

								$output .= '<li class="gt-item gt-item-current">' . get_the_time( 'd' ) . '</li>';

							/*====== Months ======*/
							} else if ( is_month() ) {

								$output .= '<li class="gt-item">';
									$output .= '<a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a>';
								$output .= '</li>';

								$output .= '<li class="gt-item gt-item-current">' . get_the_time( 'F' ) . '</li>';

							/*====== Years ======*/
							} elseif ( is_year() ) {

								$output .= '<li class="gt-item gt-item-current">' . get_the_time( 'Y' ) . '</li>';

							/*====== Authors ======*/
							} elseif ( is_author() ) {

								global $author;
								$userdata = get_userdata( $author );

								$output .= '<li class="gt-item gt-item-current">' . esc_html__( 'Author', 'eventchamp' ) . ': ' . esc_attr( $userdata->display_name ) . '</li>';

							/*====== Search ======*/
							} elseif ( is_search() ) {

								$output .= '<li class="gt-item gt-item-current">' . esc_html__( 'Search Results for', 'eventchamp' ) . ': ' . get_search_query() . '</li>';

							/*====== Page 404 ======*/
							} elseif ( is_404() ) {

								$output .= '<li class="gt-item-current gt-item-404">' . esc_html__( 'Error 404', 'eventchamp' ) . '</li>';

							/*====== bbPress ======*/
							} elseif ( function_exists( 'is_bbpress' ) ) {

								if( bbp_is_single_user() ) {

									$output .= '<li class="gt-item-current">' . bbp_get_displayed_user_field( 'display_name' ) . '</li>';

								}

							}
							/*====== Page 404 ======*/
						$output .= '</ol>';

					}

				$output .= '</nav>';
			$output .= '</div>';

			return $output;

		}

	}

}