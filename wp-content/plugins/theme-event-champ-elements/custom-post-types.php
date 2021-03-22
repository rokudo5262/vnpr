<?php
/*======
*
* Custom Post Types
*
======*/
if( !function_exists( 'eventchamp_custom_post_types' ) ) {

	function eventchamp_custom_post_types() {

		if( function_exists( 'ot_get_option' ) ) {

			$custom_post_types = ot_get_option( 'custom-post-types' );

			if( !empty( $custom_post_types ) ) {

				foreach( $custom_post_types as $post_type ) {

					if( !empty( $post_type ) ) {

						if( !empty( $post_type["name"] ) and !empty( $post_type["singular-name"] ) and !empty( $post_type["slug"] ) ) {

							if( empty( $post_type["position"] ) ) {

								$post_type["position"] = "20";

							}

							if( empty( $post_type["icon"] ) ) {

								$post_type["icon"] = "dashicons-menu";

							}

							$labels = array(
								'name' => esc_attr( $post_type["name"] ),
								'singular_name' => esc_attr( $post_type["singular-name"] ),
								'menu_name' => esc_attr( $post_type["name"] ),
								'parent_item_colon' => esc_html__( 'Parent Item:', 'eventchamp' ),
								'all_items' => esc_html__( 'All Items', 'eventchamp' ),
								'view_item' => esc_html__( 'View Item', 'eventchamp' ),
								'add_new_item' => esc_html__( 'Add New Item', 'eventchamp' ),
								'add_new' => esc_html__( 'Add New', 'eventchamp' ),
								'edit_item' => esc_html__( 'Edit Item', 'eventchamp' ),
								'update_item' => esc_html__( 'Update Item', 'eventchamp' ),
								'search_items' => esc_html__( 'Search Items', 'eventchamp' ),
								'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
								'not_found_in_trash' => esc_html__( 'Not Found in Trash', 'eventchamp' ),
							);

							$args = array(
								'labels' => $labels,
								'label' => esc_attr( $post_type["name"] ),
								'description' => esc_attr( $post_type["description"] ),
								'supports' => array( 'title', 'comments', 'author', 'excerpt', 'thumbnail', 'revisions', 'editor', 'editor', 'custom-fields' ),
								'show_in_rest' => true,
								'hierarchical' => false,
								'public' => true,
								'show_ui' => true,
								'show_in_menu' => true,
								'show_in_nav_menus' => true,
								'show_in_admin_bar' => true,
								'menu_position' => esc_attr( $post_type["position"] ),
								'menu_icon' => esc_attr( $post_type["icon"] ),
								'can_export' => true,
								'has_archive' => true,
								'exclude_from_search' => false,
								'publicly_queryable' => true,
								'capability_type' => 'post',
							);
							register_post_type( esc_attr( $post_type["slug"] ), $args );

						}

					}

				}

			}

		}

	}
	add_action( 'init', 'eventchamp_custom_post_types', 0 );

}



/*======
*
* Custom Taxonomies
*
======*/
if( !function_exists( 'eventchamp_custom_taxonomies' ) ) {

	function eventchamp_custom_taxonomies() {

		if( function_exists( 'ot_get_option' ) ) {

			$custom_taxonomies = ot_get_option( 'custom-taxonomies' );

			if( !empty( $custom_taxonomies ) ) {

				foreach( $custom_taxonomies as $taxonomy ) {

					if( !empty( $taxonomy ) ) {

						if( !empty( $taxonomy["name"] ) and !empty( $taxonomy["singular-name"] ) and !empty( $taxonomy["slug"] ) and !empty( $taxonomy["post-type"] ) ) {

							$labels = array(
								'name' => esc_attr( $taxonomy["name"] ),
								'singular_name' => esc_attr( $taxonomy["singular-name"] ),
								'menu_name' => esc_attr( $taxonomy["name"] ),
								'all_items' => esc_html__( 'All Items', 'eventchamp' ),
								'parent_item' => esc_html__( 'Parent Item', 'eventchamp' ),
								'parent_item_colon' => esc_html__( 'Parent Item:', 'eventchamp' ),
								'new_item_name' => esc_html__( 'New Item Name', 'eventchamp' ),
								'add_new_item' => esc_html__( 'Add New Item', 'eventchamp' ),
								'edit_item' => esc_html__( 'Edit Item', 'eventchamp' ),
								'view_item' => esc_html__( 'View Item', 'eventchamp' ),
								'update_item' => esc_html__( 'Update Item', 'eventchamp' ),
								'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'eventchamp' ),
								'search_items' => esc_html__( 'Search Items', 'eventchamp' ),
								'add_or_remove_items' => esc_html__( 'Add or remove items', 'eventchamp' ),
								'choose_from_most_used' => esc_html__( 'Choose from the most used items', 'eventchamp' ),
								'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
							);
							$args = array(
								'labels' => $labels,
								'show_in_rest' => true,
								'hierarchical' => true,
								'public' => true,
								'show_ui' => true,
								'show_admin_column' => true,
								'show_in_nav_menus' => true,
								'show_tagcloud' => true,
							);
							register_taxonomy( esc_attr( $taxonomy["slug"] ), array( $taxonomy["post-type"] ), $args );

						}
					}

				}

			}

		}

	}
	add_action( 'init', 'eventchamp_custom_taxonomies', 0 );

}