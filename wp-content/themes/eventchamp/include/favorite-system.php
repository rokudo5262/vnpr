<?php
/*======
*
* Favorite System Scripts
*
======*/
if( !function_exists( 'eventchamp_favorite_system_scripts' ) ) {

	function eventchamp_favorite_system_scripts() {

		wp_enqueue_script( 'eventchamp-favorite-system', get_template_directory_uri() . '/include/assets/js/favorite-system.min.js', array(), false, true );

		wp_localize_script(
			'eventchamp-favorite-system',
			'ajax_var',
			array(
				'url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'ajax-nonce' ),
			)
		);

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_favorite_system_scripts' );

}



/*======
*
* Favorite System
*
======*/
if( !function_exists( 'eventchamp_content_favorite' ) ) {

	function eventchamp_content_favorite() {

		$nonce = $_POST['nonce'];

	    if( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {

	        die( esc_html__( 'Error!', 'eventchamp' ) );

		} else {
		
			if( isset( $_POST['eventchamp_content_favorite'] ) ) {
			
				$post_id = $_POST['post_id']; // post id
				$post_favorite_count = get_post_meta( $post_id, "_post_favorite_count", true ); // post favorite count
				
				if ( function_exists ( 'wp_cache_post_change' ) ) { // invalidate WP Super Cache if exists

					$GLOBALS["super_cache_enabled"] = 1;
					wp_cache_post_change( $post_id );

				}
				
				if ( is_user_logged_in() ) { // user is logged in

					$user_id = get_current_user_id(); // current user
					$meta_POSTS = get_user_option( '_favorited_posts', $user_id  ); // post ids from user meta
					$meta_USERS = get_post_meta( $post_id, '_user_favorited' ); // user ids from post meta
					$favorited_POSTS = NULL; // setup array variable
					$favorited_USERS = NULL; // setup array variable
					
					if ( count( $meta_POSTS ) != 0 ) { // meta exists, set up values

						$favorited_POSTS = $meta_POSTS;

					}
					
					if ( !is_array( $favorited_POSTS ) ) { // make array just in case

						$favorited_POSTS = array();

					}
						
					if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values

						$favorited_USERS = $meta_USERS[0];

					}		

					if ( !is_array( $favorited_USERS ) ) { // make array just in case

						$favorited_USERS = array();

					}
							
					$favorited_POSTS['post-'.$post_id] = $post_id; // Add post id to user meta array
					$favorited_USERS['user-'.$user_id] = $user_id; // add user id to post meta array
					$user_favorites = count( $favorited_POSTS ); // count user favorites
			
					if ( !eventchamp_favorite_check( $post_id ) ) { // favorite the post

						update_post_meta( $post_id, "_user_favorited", $favorited_USERS ); // Add user ID to post meta
						update_post_meta( $post_id, "_post_favorite_count", ++$post_favorite_count ); // +1 count post meta
						update_user_option( $user_id, "_favorited_posts", $favorited_POSTS ); // Add post ID to user meta
						update_user_option( $user_id, "_user_favorite_count", $user_favorites ); // +1 count user meta
						echo esc_attr( $post_favorite_count ); // update count on front end

					} else { // unfavorite the post

						$pid_key = array_search( $post_id, $favorited_POSTS ); // find the key
						$uid_key = array_search( $user_id, $favorited_USERS ); // find the key
						unset( $favorited_POSTS[$pid_key] ); // remove from array
						unset( $favorited_USERS[$uid_key] ); // remove from array
						$user_favorites = count( $favorited_POSTS ); // recount user favorites
						update_post_meta( $post_id, "_user_favorited", $favorited_USERS ); // Remove user ID from post meta
						update_post_meta($post_id, "_post_favorite_count", --$post_favorite_count ); // -1 count post meta
						update_user_option( $user_id, "_favorited_posts", $favorited_POSTS ); // Remove post ID from user meta			
						update_user_option( $user_id, "_user_favorite_count", $user_favorites ); // -1 count user meta
						echo "already".$post_favorite_count; // NO TRANSLATE -  update count on front end
						
					}
					
				} else { // user is not logged in (anonymous)

					$ip = $_SERVER['REMOTE_ADDR']; // user IP address
					$meta_IPS = get_post_meta( $post_id, "_user_IP" ); // stored IP addresses
					$favorited_IPS = NULL; // set up array variable
					
					if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values

						$favorited_IPS = $meta_IPS[0];

					}
			
					if ( !is_array( $favorited_IPS ) ) {  // make array just in case

						$favorited_IPS = array();

					}
						
					if ( !in_array( $ip, $favorited_IPS ) ) { // if IP not in array

						$favorited_IPS['ip-'.$ip] = $ip; // add IP to array

					}
					
					if ( !eventchamp_favorite_check( $post_id ) ) { // favorite the post

						update_post_meta( $post_id, "_user_IP", $favorited_IPS ); // Add user IP to post meta
						update_post_meta( $post_id, "_post_favorite_count", ++$post_favorite_count ); // +1 count post meta
						echo esc_attr( $post_favorite_count ); // update count on front end
						
					} else { // unfavorite the post

						$ip_key = array_search( $ip, $favorited_IPS ); // find the key
						unset( $favorited_IPS[$ip_key] ); // remove from array
						update_post_meta( $post_id, "_user_IP", $favorited_IPS ); // Remove user IP from post meta
						update_post_meta( $post_id, "_post_favorite_count", --$post_favorite_count ); // -1 count post meta
						echo "already".$post_favorite_count; // NO TRANSLATE - update count on front end
						
					}

				}

			}
		
			exit;
			
		}

	}
	add_action( 'wp_ajax_nopriv_gt-content-favorite', 'eventchamp_content_favorite' );
	add_action( 'wp_ajax_gt-content-favorite', 'eventchamp_content_favorite' );

}



/*======
*
* User Favorites
*
======*/
if( !function_exists( 'eventchamp_favorite_check' ) ) {

	function eventchamp_favorite_check( $post_id ) { // test if user favorited before

		if ( is_user_logged_in() ) { // user is logged in

			$user_id = get_current_user_id(); // current user
			$meta_USERS = get_post_meta( $post_id, "_user_favorited" ); // user ids from post meta
			$favorited_USERS = ""; // set up array variable
			
			if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values

				$favorited_USERS = $meta_USERS[0];

			}
			
			if( !is_array( $favorited_USERS ) ) { // make array just in case

				$favorited_USERS = array();

			}

			if ( in_array( $user_id, $favorited_USERS ) ) { // True if User ID in array

				return true;

			}

			return false;
			
		} else { // user is anonymous, use IP address for voting
		
			$meta_IPS = get_post_meta( $post_id, "_user_IP" ); // get previously voted IP address
			$ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
			$favorited_IPS = ""; // set up array variable

			if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
				$favorited_IPS = $meta_IPS[0];
			}
			
			if ( !is_array( $favorited_IPS ) ) { // make array just in case

				$favorited_IPS = array();

			}
			
			if ( in_array( $ip, $favorited_IPS ) ) { // True is IP in array

				return true;

			}

			return false;

		}
		
	}

}



/*======
*
* Favorite Button
*
======*/
if( !function_exists( 'eventchamp_favorite_button' ) ) {

	function eventchamp_favorite_button( $post_id ) {

		$favorite_count = get_post_meta( $post_id, "_post_favorite_count", true ); // get post favorites
		$count = ( empty( $favorite_count ) || $favorite_count == "0" ) ? '' : esc_attr( $favorite_count );

		if( empty( $count ) ) {

			$count = "0";

		}

		if ( eventchamp_favorite_check( $post_id ) ) {

			$title = esc_attr__( 'Unfavorite', 'eventchamp' );
			$extra_class = " gt-favorited";

		} else {

			$title = esc_attr__( 'Favorite', 'eventchamp' );
			$extra_class = "";

		}

		if( !is_user_logged_in() ) {

			$output = '<a href="" data-target="#gt-login-popup" data-toggle="modal" class="gt-login-for-favorite">';
				$output .= '<span></span>';
			$output .= '</a>';

		} else {

			$output = '<a href="#" class="gt-content-favorite ' . esc_attr( $extra_class ) . '" data-post_id="' . esc_attr( $post_id ) . '"
			data-favorite-title="' . esc_attr__( 'Add to favorites', 'eventchamp' ) . '"
			data-added-title="' . esc_attr__( 'Remove from favorites', 'eventchamp' ) . '"
			data-add-popup-text="' . esc_attr__( 'You added this to your favorites.', 'eventchamp' ) .  '" data-remove-popup-text="' . esc_attr__( 'This content removed from your favorites.', 'eventchamp' ) .  '">';
				$output .= '<span></span>';
			$output .= '</a>';

		}

		return $output;

	}

}