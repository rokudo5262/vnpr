<?php
/*======
*
* Post Types
*
======*/
	/*====== Events ======*/
	if( !function_exists( 'eventchamp_events_post_type' ) ) {

		function eventchamp_events_post_type() {

			$labels = array(
				'name' => esc_html__( 'Events', 'eventchamp' ),
				'singular_name' => esc_html__( 'Event', 'eventchamp' ),
				'menu_name' => esc_html__( 'Events', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Event:', 'eventchamp' ),
				'all_items' => esc_html__( 'All Events', 'eventchamp' ),
				'view_item' => esc_html__( 'View Event', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Event Item', 'eventchamp' ),
				'add_new' => esc_html__( 'Add New Event', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Event', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Event', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Event', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Event Found', 'eventchamp' ),
				'not_found_in_trash' => esc_html__( 'Not Event Found in Trash', 'eventchamp' ),
			);
			$args = array(
				'label' => esc_html__( 'Events', 'eventchamp' ),
				'description' => esc_html__( 'Event post type description.', 'eventchamp' ),
				'labels' => $labels,
				'supports' => array( 'title', 'comments', 'author', 'excerpt', 'thumbnail', 'revisions', 'editor', 'custom-fields' ),
				'show_in_rest' => true,
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 20,
				'menu_icon' => 'dashicons-calendar-alt',
				'can_export' => true,
				'has_archive' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'capability_type' => 'post',
			);
			register_post_type( 'event', $args );

		}
		add_action( 'init', 'eventchamp_events_post_type', 0 );

	}



	/*====== Venues ======*/
	if( !function_exists( 'eventchamp_venues_post_type' ) ) {

		function eventchamp_venues_post_type() {

			$labels = array(
				'name' => esc_html__( 'Venues', 'eventchamp' ),
				'singular_name' => esc_html__( 'Venue', 'eventchamp' ),
				'menu_name' => esc_html__( 'Venues', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Venue:', 'eventchamp' ),
				'all_items' => esc_html__( 'All Venues', 'eventchamp' ),
				'view_item' => esc_html__( 'View Venue', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Venue Item', 'eventchamp' ),
				'add_new' => esc_html__( 'Add New Venue', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Venue', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Venue', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Venue', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Venue Found', 'eventchamp' ),
				'not_found_in_trash' => esc_html__( 'Not Venue Found in Trash', 'eventchamp' ),
			);
			$args = array(
				'label' => esc_html__( 'Venues', 'eventchamp' ),
				'description' => esc_html__( 'Venue post type description.', 'eventchamp' ),
				'labels' => $labels,
				'supports' => array( 'title', 'comments', 'author', 'excerpt', 'thumbnail', 'revisions', 'editor', 'custom-fields' ),
				'show_in_rest' => true,
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 20,
				'menu_icon' => 'dashicons-store',
				'can_export' => true,
				'has_archive' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'capability_type' => 'post',
			);
			register_post_type( 'venue', $args );

		}
		add_action( 'init', 'eventchamp_venues_post_type', 0 );

	}



	/*====== Speakers ======*/
	if( !function_exists( 'eventchamp_speakers_post_type' ) ) {

		function eventchamp_speakers_post_type() {

			$labels = array(
				'name' => esc_html__( 'Speakers', 'eventchamp' ),
				'singular_name' => esc_html__( 'Speaker', 'eventchamp' ),
				'menu_name' => esc_html__( 'Speakers', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Speaker:', 'eventchamp' ),
				'all_items' => esc_html__( 'All Speakers', 'eventchamp' ),
				'view_item' => esc_html__( 'View Speaker', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Speaker Item', 'eventchamp' ),
				'add_new' => esc_html__( 'Add New Speaker', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Speaker', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Speaker', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Speaker', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Speaker Found', 'eventchamp' ),
				'not_found_in_trash' => esc_html__( 'Not Speaker Found in Trash', 'eventchamp' ),
			);
			$args = array(
				'label' => esc_html__( 'Speakers', 'eventchamp' ),
				'description' => esc_html__( 'Speaker post type description.', 'eventchamp' ),
				'labels' => $labels,
				'supports' => array( 'title', 'comments', 'author', 'excerpt', 'thumbnail', 'revisions', 'editor', 'custom-fields' ),
				'show_in_rest' => true,
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 20,
				'menu_icon' => 'dashicons-microphone',
				'can_export' => true,
				'has_archive' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'capability_type' => 'post',
			);
			register_post_type( 'speaker', $args );

		} 
		add_action( 'init', 'eventchamp_speakers_post_type', 0 );

	}



/*======
*
* Taxonomies
*
======*/
	/*====== Event Categories ======*/
	if( !function_exists( 'eventchamp_eventcat_taxonomy' ) ) {

		function eventchamp_eventcat_taxonomy() {

			$labels = array(
				'name' => esc_html__( 'Categories', 'eventchamp' ),
				'singular_name' => esc_html__( 'Category', 'eventchamp' ),
				'menu_name' => esc_html__( 'Categories', 'eventchamp' ),
				'all_items' => esc_html__( 'All Categories', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Category', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Category:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Category Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Category', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Category', 'eventchamp' ),
				'view_item' => esc_html__( 'View Category', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Category', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Categories', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove categories', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used categories', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => true,
				'show_in_rest' => true,
			);
			register_taxonomy( 'eventcat', array( 'event'), $args );

		}
		add_action( 'init', 'eventchamp_eventcat_taxonomy', 0 );

	}



	/*====== Event Organizers ======*/
	if( !function_exists( 'eventchamp_organizer_taxonomy' ) ) {

		function eventchamp_organizer_taxonomy() {

			$labels = array(
				'name' => esc_html__( 'Organizers', 'eventchamp' ),
				'singular_name' => esc_html__( 'Organizer', 'eventchamp' ),
				'menu_name' => esc_html__( 'Organizers', 'eventchamp' ),
				'all_items' => esc_html__( 'All Organizers', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Organizer', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Organizer:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Organizer Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Organizer', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Organizer', 'eventchamp' ),
				'view_item' => esc_html__( 'View Organizer', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Organizer', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate organizers with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Organizers', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove organizers', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used organizers', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => true,
				'show_in_rest' => true,
			);
			register_taxonomy( 'organizer', array( 'event' ), $args );

		}
		add_action( 'init', 'eventchamp_organizer_taxonomy', 0 );

	}



	/*====== Event Tags ======*/
	if( !function_exists( 'eventchamp_event_tags_taxonomy' ) ) {

		function eventchamp_event_tags_taxonomy() {

			$labels = array(
				'name' => esc_html__( 'Tags', 'eventchamp' ),
				'singular_name' => esc_html__( 'Tag', 'eventchamp' ),
				'menu_name' => esc_html__( 'Tags', 'eventchamp' ),
				'all_items' => esc_html__( 'All Tags', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Tag', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Tag:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Tag Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Tag', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Tag', 'eventchamp' ),
				'view_item' => esc_html__( 'View Tag', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Tag', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Tags', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove tags', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used tags', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => true,
				'show_in_rest' => true,
			);
			register_taxonomy( 'event_tags', array( 'event' ), $args );

		}
		add_action( 'init', 'eventchamp_event_tags_taxonomy', 0 );

	}



	/*====== Venue Categories ======*/
	if( !function_exists( 'eventchamp_venuecat_taxonomy' ) ) {

		function eventchamp_venuecat_taxonomy() {

			$labels = array(
				'name' => esc_html__( 'Categories', 'eventchamp' ),
				'singular_name' => esc_html__( 'Category', 'eventchamp' ),
				'menu_name' => esc_html__( 'Categories', 'eventchamp' ),
				'all_items' => esc_html__( 'All Categories', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Category', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Category:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Category Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Category', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Category', 'eventchamp' ),
				'view_item' => esc_html__( 'View Category', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Category', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Categories', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove categories', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used categories', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => true,
				'show_in_rest' => true,
			);
			register_taxonomy( 'venuecat', array( 'venue'), $args );

		}
		add_action( 'init', 'eventchamp_venuecat_taxonomy', 0 );

	}



	/*====== Venue Tags ======*/
	if( !function_exists( 'eventchamp_venue_tags_taxonomy' ) ) {

		function eventchamp_venue_tags_taxonomy() {

			$labels = array(
				'name' => esc_html__( 'Tags', 'eventchamp' ),
				'singular_name' => esc_html__( 'Tag', 'eventchamp' ),
				'menu_name' => esc_html__( 'Tags', 'eventchamp' ),
				'all_items' => esc_html__( 'All Tags', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Tag', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Tag:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Tag Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Tag', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Tag', 'eventchamp' ),
				'view_item' => esc_html__( 'View Tag', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Tag', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Tags', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove tags', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used tags', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => true,
				'show_in_rest' => true,
			);
			register_taxonomy( 'venue_tags', array( 'venue' ), $args );

		}
		add_action( 'init', 'eventchamp_venue_tags_taxonomy', 0 );

	}



	/*====== Speaker Categories ======*/
	if( !function_exists( 'eventchamp_speaker_category_taxonomy' ) ) {

		function eventchamp_speaker_category_taxonomy() {

			$labels = array(
				'name' => esc_html__( 'Categories', 'eventchamp' ),
				'singular_name' => esc_html__( 'Category', 'eventchamp' ),
				'menu_name' => esc_html__( 'Categories', 'eventchamp' ),
				'all_items' => esc_html__( 'All Categories', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Category', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Category:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Category Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Category', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Category', 'eventchamp' ),
				'view_item' => esc_html__( 'View Category', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Category', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Categories', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove categories', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used categories', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => true,
				'show_in_rest' => true,
			);
			register_taxonomy( 'speaker-category', array( 'speaker'), $args );

		}
		add_action( 'init', 'eventchamp_speaker_category_taxonomy', 0 );

	}



	/*====== Speaker Tags ======*/
	if( !function_exists( 'eventchamp_speaker_tags_taxonomy' ) ) {

		function eventchamp_speaker_tags_taxonomy() {

			$labels = array(
				'name' => esc_html__( 'Tags', 'eventchamp' ),
				'singular_name' => esc_html__( 'Tag', 'eventchamp' ),
				'menu_name' => esc_html__( 'Tags', 'eventchamp' ),
				'all_items' => esc_html__( 'All Tags', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Tag', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Tag:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Tag Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Tag', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Tag', 'eventchamp' ),
				'view_item' => esc_html__( 'View Tag', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Tag', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Tags', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove tags', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used tags', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => true,
				'show_in_rest' => true,
			);
			register_taxonomy( 'speaker-tags', array( 'speaker' ), $args );

		}
		add_action( 'init', 'eventchamp_speaker_tags_taxonomy', 0 );

	}



	/*====== Global Locations ======*/
	if( !function_exists( 'eventchamp_location_taxonomy' ) ) {

		function eventchamp_location_taxonomy() {

			$labels = array(
				'name' => esc_html__( 'Locations', 'eventchamp' ),
				'singular_name' => esc_html__( 'Location', 'eventchamp' ),
				'menu_name' => esc_html__( 'Locations', 'eventchamp' ),
				'all_items' => esc_html__( 'All Locations', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Location', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Location:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Location Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Location', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Location', 'eventchamp' ),
				'view_item' => esc_html__( 'View Location', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Location', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate locations with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Locations', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove locations', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used locations', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => true,
				'show_in_rest' => true,
			);
			register_taxonomy( 'location', array( 'event', 'venue', 'speaker' ), $args );

		}
		add_action( 'init', 'eventchamp_location_taxonomy', 0 );

	}