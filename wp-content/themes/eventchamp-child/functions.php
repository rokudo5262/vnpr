<?php
/*======
*
* Theme Scripts & Styles
*
======*/
if( !function_exists( 'eventchamp_child_theme_setup' ) ) {

	function eventchamp_child_theme_setup() {

		wp_enqueue_style( 'eventchamp', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'eventchamp-child-style', get_stylesheet_directory_uri() . '/style.css' );

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_child_theme_setup' );

}





// Set up Cutsom BP navigation
define ( 'BP_ACTIVITY_SLUG', 'streams' );
function my_setup_nav() {
      global $bp;

      bp_core_new_nav_item( array( 
            'name' => __( 'Trang Cá Nhân', 'buddypress' ), 
            'slug' => 'streams', 
            'position' =>10,
            'screen_function' => 'my_item_two_template', 
      ) );


      // Change the order of menu items
      //$bp->bp_nav['messages']['position'] = 100;

      // Remove a menu item
      $bp->bp_nav['activity'] = true;

      // Change name of menu item
      //$bp->bp_nav['groups']['name'] = ‘community’;
}
add_action( 'bp_setup_nav', 'my_setup_nav' );


// Load a page template for your custom item. You'll need to have an item-one-template.php and item-two-template.php in your theme root.
function my_item_one_template() {
      bp_core_load_template( 'item-two-template' );
}
/*an tạo forum ở user*/
function get_current_user_role() {
    global $wp_roles;
    $current_user = wp_get_current_user();
    $roles = $current_user->roles;
    $role = array_shift($roles);
    return isset($wp_roles->role_names[$role]) ? translate_user_role($wp_roles->role_names[$role] ) : false;
}

function hook_css() {
    ?>
        <style>
            div#text-2{
					display:none;
				}
        </style>
    <?php
}

function userRoleCheck() {
    global $current_user;
     $userRole = get_current_user_role();
	 if ($userRole == 'Author') {
				hook_css();
          } 
}
add_action('wp_head', 'userRoleCheck');
/*an tạo forum ở user*/

// remove logo wordpress admin bar
function example_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0 );


/*tạo blog*/
function buddyblog_my_post_type( $post_type ) {
    // it can be say 'events' or 'movies' or anything,
    // just make sure you have already registered the post type.
    return 'custom_post_type';
 
}
 
add_filter( 'buddyblog_get_post_type', 'buddyblog_my_post_type' );

function buddyblog_my_postform_settings( $settings ) {
 
    $settings = array(
        'post_type'   => buddyblog_get_posttype(),
        'post_status' => 'draft', // 'publish'|'draft' etc
 
        'tax'          => array( // all the associated taxonomies, the below settings are for post category and post tag.
            'category' => array(
                'taxonomy'  => 'category',
                'view_type' => 'checkbox',
            ),
            'post_tag' => array(
                'taxonomy'  => 'post_tag',
                'view_type' => 'checkbox',
            ),
 
        ),
        'upload_count' => 2, // how may uploads.
    );
 
    return $settings;
 
}
add_filter('buddyblog_post_form_settings','buddyblog_my_postform_settings');


/*hide filter admin*/
add_action('pre_user_query','ra_hide_all_administrators');
function ra_hide_all_administrators( $u_query ) {
	// let's do the trick only for non-administrators
	$current_user = wp_get_current_user();
	if ( $current_user->roles[0] != 'administrator' ) { 
		global $wpdb;
		$u_query->query_where = str_replace(
			'WHERE 1=1', 
			"WHERE 1=1 AND {$wpdb->users}.ID IN (
				SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
					WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities'
					AND {$wpdb->usermeta}.meta_value NOT LIKE '%administrator%')", 
			$u_query->query_where
		);
	}
}

add_filter('views_users', 'misha_change_user_count');
function misha_change_user_count( $views ){
	$current_user = wp_get_current_user();
	if ( $current_user->roles[0] != 'administrator' ) { 
		unset($views['administrator']);
	}
 
	return $views;
}

add_filter( 'woocommerce_add_to_cart_redirect', 'redirect_to_cart_when_buying_tickets');

function redirect_to_cart_when_buying_tickets() {
	$cart_url = wc_get_cart_url();
	return $cart_url;
}