<?php
/*======
*
* Like System Scripts
*
======*/
if( !function_exists( 'eventchamp_like_system_scripts' ) ) {

	function eventchamp_like_system_scripts() {

		wp_enqueue_script( 'eventchamp-like-system', get_template_directory_uri() . '/include/assets/js/like-system.min.js', array(), false, true );

		wp_localize_script(
			'eventchamp-like-system',
			'ajax_var',
			array(
				'url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'ajax-nonce' ),
			)
		);

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_like_system_scripts' );

}



/*======
*
* Like System
*
======*/
if( !function_exists( 'eventchamp_content_like' ) ) {

	function eventchamp_content_like() {

		$nonce = $_POST['nonce'];

	    if( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {

	        die( esc_html__( 'Error!', 'eventchamp' ) );

		} else {
		
			if( isset( $_POST['eventchamp_content_like'] ) ) {
			
				$post_id = $_POST['post_id']; // post id
				$post_like_count = get_post_meta( $post_id, "_post_like_count", true ); // post like count
				
				if ( function_exists ( 'wp_cache_post_change' ) ) { // invalidate WP Super Cache if exists

					$GLOBALS["super_cache_enabled"] = 1;
					wp_cache_post_change( $post_id );

				}
				
				if ( is_user_logged_in() ) { // user is logged in

					$user_id = get_current_user_id(); // current user
					$meta_POSTS = get_user_option( '_liked_posts', $user_id  ); // post ids from user meta
					$meta_USERS = get_post_meta( $post_id, '_user_liked' ); // user ids from post meta
					$liked_POSTS = NULL; // setup array variable
					$liked_USERS = NULL; // setup array variable
					
					if ( count( $meta_POSTS ) != 0 ) { // meta exists, set up values

						$liked_POSTS = $meta_POSTS;

					}
					
					if ( !is_array( $liked_POSTS ) ) { // make array just in case

						$liked_POSTS = array();

					}
						
					if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values

						$liked_USERS = $meta_USERS[0];

					}		

					if ( !is_array( $liked_USERS ) ) { // make array just in case

						$liked_USERS = array();

					}
							
					$liked_POSTS['post-'.$post_id] = $post_id; // Add post id to user meta array
					$liked_USERS['user-'.$user_id] = $user_id; // add user id to post meta array
					$user_likes = count( $liked_POSTS ); // count user likes
			
					if ( !eventchamp_like_check( $post_id ) ) { // like the post

						update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Add user ID to post meta
						update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
						update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Add post ID to user meta
						update_user_option( $user_id, "_user_like_count", $user_likes ); // +1 count user meta
						echo esc_attr( $post_like_count ); // update count on front end

					} else { // unlike the post

						$pid_key = array_search( $post_id, $liked_POSTS ); // find the key
						$uid_key = array_search( $user_id, $liked_USERS ); // find the key
						unset( $liked_POSTS[$pid_key] ); // remove from array
						unset( $liked_USERS[$uid_key] ); // remove from array
						$user_likes = count( $liked_POSTS ); // recount user likes
						update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Remove user ID from post meta
						update_post_meta($post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
						update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Remove post ID from user meta			
						update_user_option( $user_id, "_user_like_count", $user_likes ); // -1 count user meta
						echo "already".$post_like_count; // NO TRANSLATE -  update count on front end
						
					}
					
				} else { // user is not logged in (anonymous)

					$ip = $_SERVER['REMOTE_ADDR']; // user IP address
					$meta_IPS = get_post_meta( $post_id, "_user_IP" ); // stored IP addresses
					$liked_IPS = NULL; // set up array variable
					
					if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values

						$liked_IPS = $meta_IPS[0];

					}
			
					if ( !is_array( $liked_IPS ) ) {  // make array just in case

						$liked_IPS = array();

					}
						
					if ( !in_array( $ip, $liked_IPS ) ) { // if IP not in array

						$liked_IPS['ip-'.$ip] = $ip; // add IP to array

					}
					
					if ( !eventchamp_like_check( $post_id ) ) { // like the post

						update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Add user IP to post meta
						update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
						echo esc_attr( $post_like_count ); // update count on front end
						
					} else { // unlike the post

						$ip_key = array_search( $ip, $liked_IPS ); // find the key
						unset( $liked_IPS[$ip_key] ); // remove from array
						update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Remove user IP from post meta
						update_post_meta( $post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
						echo "already".$post_like_count; // NO TRANSLATE - update count on front end
						
					}

				}

			}
		
			exit;
			
		}

	}
	add_action( 'wp_ajax_nopriv_gt-content-like', 'eventchamp_content_like' );
	add_action( 'wp_ajax_gt-content-like', 'eventchamp_content_like' );

}



/*======
*
* User Likes
*
======*/
if( !function_exists( 'eventchamp_like_check' ) ) {

	function eventchamp_like_check( $post_id ) { // test if user liked before

		if ( is_user_logged_in() ) { // user is logged in

			$user_id = get_current_user_id(); // current user
			$meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
			$liked_USERS = ""; // set up array variable
			
			if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values

				$liked_USERS = $meta_USERS[0];

			}
			
			if( !is_array( $liked_USERS ) ) { // make array just in case

				$liked_USERS = array();

			}

			if ( in_array( $user_id, $liked_USERS ) ) { // True if User ID in array

				return true;

			}

			return false;
			
		} else { // user is anonymous, use IP address for voting
		
			$meta_IPS = get_post_meta( $post_id, "_user_IP" ); // get previously voted IP address
			$ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
			$liked_IPS = ""; // set up array variable

			if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
				$liked_IPS = $meta_IPS[0];
			}
			
			if ( !is_array( $liked_IPS ) ) { // make array just in case

				$liked_IPS = array();

			}
			
			if ( in_array( $ip, $liked_IPS ) ) { // True is IP in array

				return true;

			}

			return false;

		}
		
	}

}



/*======
*
* Like Button
*
======*/
if( !function_exists( 'eventchamp_like_button' ) ) {

	function eventchamp_like_button( $post_id ) {

		$output = "";
		$like_count = get_post_meta( $post_id, "_post_like_count", true ); // get post likes
		$count = ( empty( $like_count ) || $like_count == "0" ) ? '' : esc_attr( $like_count );

		if( empty( $count ) ) {

			$count = "0";

		}

		if ( eventchamp_like_check( $post_id ) ) {

			$title = esc_attr__( 'Unlike', 'eventchamp' );
			$extra_class = " gt-liked";

		} else {

			$title = esc_attr__( 'Like', 'eventchamp' );
			$extra_class = "";

		}

		if( !is_user_logged_in() ) {

			$output .= '<a href="" data-target="#gt-login-popup" data-toggle="modal" class="gt-login-for-like ' . esc_attr( $extra_class ) . '">';
				$output .= '<span>';
					$output .= esc_attr( $count );
				$output .= '</span>';
			$output .= '</a>';

		} else {

			$output .= '<a href="#" class="gt-content-like ' . esc_attr( $extra_class ) . '" data-post_id="' . esc_attr( $post_id ) . '" data-like-title="' . esc_attr__( 'Like', 'eventchamp' ) . '" data-unlike-title="' . esc_attr__( 'Unlike', 'eventchamp' ) . '" data-add-popup-text="' . esc_attr__( 'Thanks! You liked this.', 'eventchamp' ) .  '" data-remove-popup-text="' . esc_attr__( 'This content removed from your likes.', 'eventchamp' ) .  '">';
				$output .= '<span>';
					$output .= esc_attr( $count );
				$output .= '</span>';
			$output .= '</a>';

		}

		return $output;

	}

}