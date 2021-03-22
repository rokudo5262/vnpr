<?php
$attachment_sidebar = ot_get_option( 'attachment_sidebar_select' );
$event_sidebar = ot_get_option( 'event_sidebar_select' );
$venue_sidebar = ot_get_option( 'venue_sidebar_select' );
$speaker_sidebar = ot_get_option( 'speaker_sidebar_select' );
$post_sidebar = ot_get_option( 'post_sidebar_select' );
$page_sidebar = ot_get_option( 'page_sidebar_select' );
$category_sidebar = ot_get_option( 'sidebar_select_category' );
$tag_sidebar = ot_get_option( 'tag_sidebar_select' );
$author_sidebar = ot_get_option( 'author_sidebar_select' );
$search_sidebar = ot_get_option( 'search_sidebar_select' );
$archive_sidebar = ot_get_option( 'archive_sidebar_select' );

if( is_category() ) {

	$cat = get_queried_object();
	$category_sidebar_settings = ot_get_option( 'sidebar_select_' . esc_attr( $cat->term_id ) );

	if( !empty( $category_sidebar_settings ) ) {

		$category_sidebar = esc_attr( $category_sidebar_settings );

	}

}

if( is_single() ) {

	if( !empty( get_post_meta( get_the_ID(), 'post_sidebar_select', true ) ) ) {

		$post_sidebar = get_post_meta( get_the_ID(), 'post_sidebar_select', true );

	}

}

if( is_page() ) {

	if( !empty( get_post_meta( get_the_ID(), 'page_sidebar_select', true ) ) ) {

		$page_sidebar = get_post_meta( get_the_ID(), 'page_sidebar_select', true );

	}

}

if ( is_attachment() and !empty( $attachment_sidebar ) ) {

	if ( is_active_sidebar( $attachment_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $attachment_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_post_type_archive( 'event' ) and !empty( $event_sidebar ) ) {

	if ( is_active_sidebar( $event_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $event_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_tax( 'event_tags' ) and !empty( $event_sidebar ) ) {

	if ( is_active_sidebar( $event_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $event_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_tax( 'eventcat' ) and !empty( $event_sidebar ) ) {

	if ( is_active_sidebar( $event_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $event_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_tax( 'organizer' ) and !empty( $event_sidebar ) ) {

	if ( is_active_sidebar( $event_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $event_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_post_type_archive( 'venue' ) and !empty( $venue_sidebar ) ) {

	if ( is_active_sidebar( $venue_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $venue_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_tax( 'venue_tags' ) and !empty( $venue_sidebar ) ) {

	if ( is_active_sidebar( $venue_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $venue_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_tax( 'venuecat' ) and !empty( $venue_sidebar ) ) {

	if ( is_active_sidebar( $venue_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $venue_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_post_type_archive( 'speaker' ) and !empty( $speaker_sidebar ) ) {

	if ( is_active_sidebar( $speaker_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $speaker_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_tax( 'speaker-tags' ) and !empty( $speaker_sidebar ) ) {

	if ( is_active_sidebar( $speaker_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $speaker_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_tax( 'speaker-category' ) and !empty( $speaker_sidebar ) ) {

	if ( is_active_sidebar( $speaker_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $speaker_sidebar );
		echo eventchamp_sidebar_after();

	}
	
} elseif( is_single() and !empty( $post_sidebar ) ) {

	if ( is_active_sidebar( $post_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $post_sidebar );
		echo eventchamp_sidebar_after();

	}

} elseif( is_page() and !empty( $page_sidebar ) ) {

	if ( is_active_sidebar( $page_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $page_sidebar );
		echo eventchamp_sidebar_after();

	}

} elseif( is_category() and !empty( $category_sidebar ) ) {

	if ( is_active_sidebar( $category_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $category_sidebar );
		echo eventchamp_sidebar_after();

	}

} elseif( is_tag() and !empty( $tag_sidebar ) ) {

	if ( is_active_sidebar( $tag_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $tag_sidebar );
		echo eventchamp_sidebar_after();

	}

} elseif( is_author() and !empty( $author_sidebar ) ) {

	if ( is_active_sidebar( $author_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $author_sidebar );
		echo eventchamp_sidebar_after();

	}

} elseif( is_search() and !empty( $search_sidebar ) ) {

	if ( is_active_sidebar( $search_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $search_sidebar );
		echo eventchamp_sidebar_after();

	}

} elseif( is_archive() and !empty( $archive_sidebar ) ) {

	if ( is_active_sidebar( $archive_sidebar ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar( $archive_sidebar );
		echo eventchamp_sidebar_after();

	}

} else {

	if ( is_active_sidebar( 'general-sidebar' ) ) {

		echo eventchamp_sidebar_before();
			dynamic_sidebar("general-sidebar");
		echo eventchamp_sidebar_after();

	}

}