<?php
/*======
*
* Theme Scripts & Styles
*
======*/
if( !function_exists( 'eventchamp_child_theme_setup' ) ) {

	function eventchamp_child_theme_setup() {

		wp_enqueue_style( 'eventchamp', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'eventchamp-child-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.3' );
    wp_enqueue_script( 'eventchamp-child-script', get_stylesheet_directory_uri() . '/custom.js', array(), '1.0.2', true );

    wp_enqueue_style( 'owl-carousel-min-style', get_stylesheet_directory_uri() . '/asset/owlcarousel/owl.carousel.min.css' );
    wp_enqueue_style( 'owl-theme-default-min-style', get_stylesheet_directory_uri() . '/asset/owlcarousel/owl.theme.default.min.css' );
    wp_enqueue_script( 'owl-carousel-script', get_stylesheet_directory_uri() . '/asset/owlcarousel/owl.carousel.js');
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

/*======
*
* Event Sidebar Buttons Box
*
======*/
if( !function_exists( 'eventchamp_event_sidebar_buttons_box' ) ) {

    function eventchamp_event_sidebar_buttons_box( $id = "" ) {
  
      $output = "";
      $sidebar_buttons = ot_get_option( 'event-sidebar-buttons' );
      $buttons = get_post_meta( esc_attr( $id ), 'event_extra_buttons', true );
  
      if( !empty( $sidebar_buttons ) or !empty( $buttons ) ) {
  
        $output .= '<div class="gt-widget gt-transparent-widget gt-detail-widget">';
          $output .= '<div class="gt-widget-content">';
            $output .= '<div class="gt-event-buttons">';
              $output .= '<ul>';
              if( !empty( $sidebar_buttons ) ) {
  
                  foreach( $sidebar_buttons as $sidebar_button ) {
  
                    if( !empty( $sidebar_button ) ) {
  
                      if( !empty( $sidebar_button["title"] ) and !empty( $sidebar_button["event_extra_buttons_link"] ) ) {
  
                        if( empty( $sidebar_button["event_extra_buttons_target"] ) ) {
  
                          $sidebar_button["event_extra_buttons_target"] = "_self";
  
                        }
  
                        $output .= '<li>';
                          $output .= '<a href="' . esc_url( $sidebar_button["event_extra_buttons_link"] ) . '" target="' . esc_attr( $sidebar_button["event_extra_buttons_target"] ) . '">' . esc_attr( $sidebar_button["title"] ) . '</a>';
                        $output .= '</li>';
  
                      }
  
                    }
  
                  }
                }
                if( !empty( $buttons ) ) {
                  foreach( $buttons as $button ) {
                    if( !empty( $button ) ) {
                      if( !empty( $button["title"] ) and !empty( $button["event_extra_buttons_link"] ) ) {
                        if( empty( $button["event_extra_buttons_target"] ) ) {
  
                          $button["event_extra_buttons_target"] = "_self";
                        }
                        $output .= '<li>';
                          $output .= '<a href="' . esc_url( $button["event_extra_buttons_link"] ) . '" target="' . esc_attr( $button["event_extra_buttons_target"] ) . '">' . esc_attr( $button["title"] ) . '</a>';
                        $output .= '</li>';
                      }
                    }
                  }
                }
              $output .= '</ul>';
            $output .= '</div>';
          $output .= '</div>';
        $output .= '</div>';
      }
      return $output;
    }
  }
  
  if ( ! function_exists( 'ot_get_option' ) ) {
      function ot_get_option( $option_id, $default = '' ) {
      global $hardcode_options;
      if (isset($hardcode_options[$option_id])) {
        return $hardcode_options[$option_id];
      }
          // Get the saved options.
          $options = get_option( ot_options_id() );
          // Look for the saved value.
          if ( isset( $options[ $option_id ] ) && '' !== $options[ $option_id ] ) {
  
              return ot_wpml_filter( $options, $option_id );
          }
          return $default;
      }
  }
  
  
  if( !function_exists( 'eventchamp_footer_style_1' ) ) {
    function eventchamp_footer_style_1() {
      global $hardcode_options;
      $output = "";
      $footer_gap = "";
      $footer_page = ot_get_option( 'page_footer_style_1' );
      if ( is_page() or is_single() ) {
        if (isset($hardcode_options['footer_gap'])) {
          $footer_gap = $hardcode_options['footer_gap'];
        } else {
          $footer_gap = get_post_meta( get_the_ID(), 'footer_gap', true );
        }  
      }
  
      if( !empty( $footer_page ) ) {
        if( $footer_gap == "on" or empty( $footer_gap ) ) {
          $output .= '<footer class="gt-footer gt-style-1">';
        } else {
          $output .= '<footer class="gt-footer gt-style-1 gt-remove-gap">';
        }
          $output .= '<div class="container">';
            $args = array(
              'p' => $footer_page,
              'ignore_sticky_posts' => true,
              'post_type' => 'page',
              'post_status' => 'publish'
            );
            $wp_query = new WP_Query( $args );
            while ( $wp_query->have_posts() ) {
              if ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                $output .= '<div class="gt-footer-content">';
                  $output .= do_shortcode( get_the_content( get_the_ID() ) );
                $output .= '</div>';
              }
            }
            wp_reset_postdata();
          $output .= '</div>';
          $output .= eventchamp_copyright();
        $output .= '</footer>';
      }
      return $output;
    }
  }
  
  //Layout Chi tiet su kien;
  if( !function_exists( 'eventchamp_content_area_before' ) ) {
  
      function eventchamp_content_area_before() {
          $output = "";
  
          if ( is_post_type_archive( 'event' ) or is_tax( 'event_tags' ) or is_tax( 'eventcat' ) or is_tax( 'organizer' ) ) {
  
              $sidebar_position = ot_get_option( 'event_sidebar_position', 'right' );
  
          } elseif ( is_post_type_archive( 'venue' ) or is_tax( 'venue_tags' ) or is_tax( 'venuecat' ) ) {
  
              $sidebar_position = ot_get_option( 'venue_sidebar_position', 'right' );
  
          } elseif ( is_post_type_archive( 'speaker' ) or is_tax( 'speaker-tags' ) or is_tax( 'speaker-category' ) ) {
  
              $sidebar_position = ot_get_option( 'speaker_sidebar_position', 'right' );
  
          } elseif( is_category() ) {
  
              $sidebar_position = ot_get_option( 'category_sidebar_position', 'right' );
  
          } elseif( is_tag() ) {
  
              $sidebar_position = ot_get_option( 'tag_sidebar_position', 'right' );
  
          } elseif( is_author() ) {
  
              $sidebar_position = ot_get_option( 'author_sidebar_position', 'right' );
  
          } elseif( is_search() ) {
  
              $sidebar_position = ot_get_option( 'search_sidebar_position', 'right' );
  
          } elseif( is_archive() ) {
  
              $sidebar_position = ot_get_option( 'archive_sidebar_position', 'right' );
  
          } elseif( is_attachment() ) {
  
              $sidebar_position = ot_get_option( 'attachment_sidebar_position', 'nosidebar' );
  
          } elseif( is_singular( 'event' ) or is_singular( 'venue' ) or is_singular( 'speaker' ) ) {
        
        if(is_singular( 'event' )){
  
          $event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
          $event_start_time = get_post_meta( get_the_ID(), 'event_start_time', true );
  
          $date_now = date( 'Y-m-d H:i' );
          $event_start_date_last = "";
          
          if( !empty( $event_start_date ) && !empty( $event_start_time ) ) {
            $event_start_date_last = date_format( date_create( $event_start_date . $event_start_time ), 'Y-m-d H:i' );
          }
  
          if(!empty( $event_start_date ) && !empty( $event_start_time ) && $event_start_date_last >= $date_now ){ 
            $sidebar_position == 'nosidebar';
          }else{
          $sidebar_position = "right";
          } 
  
        }else{
          $sidebar_position = "right";
        }
  
          } elseif( is_single() ) {
  
              $sidebar_position = get_post_meta( get_the_ID(), 'sidebar_position', true );
  
              if( empty( $sidebar_position ) or $sidebar_position == "default" ) {
  
                  $sidebar_position = ot_get_option( 'post_sidebar_position', 'right' );
  
              }
  
          } elseif( is_page() ) {
  
              $sidebar_position = get_post_meta( get_the_ID(), 'sidebar_position', true );
  
              if( empty( $sidebar_position ) or $sidebar_position == "default" ) {
  
                  $sidebar_position = ot_get_option( 'page_sidebar_position', 'nosidebar' );
  
              }
  
          } else {
  
              $sidebar_position = ot_get_option( 'sidebar_position', 'right' );
  
          }
  
          if( $sidebar_position == 'nosidebar' ) {
  
              $output = '<div class="col-md-12 col-sm-12 col-xs-12 gt-site-left gt-full-width-site">';
  
          } elseif( $sidebar_position == 'left' ) {
  
              $output = '<div class="col-md-8 col-sm-12 col-xs-12 gt-site-left gt-fixed-sidebar">';
  
          } elseif( $sidebar_position == 'right' ) {
  
              $output = '<div class="col-md-8 col-sm-12 col-xs-12 gt-site-left gt-fixed-sidebar">';
  
          }
  
          return $output;
  
      }
  
  }
// Hide element
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
add_action('admin_footer-profile.php', 'remove_profile_fields');
function remove_profile_fields(){
  $user = wp_get_current_user();
  if(!in_array( 'administrator', (array) $user->roles )){ 
    ?>
<script type="text/javascript">
jQuery(function($) {
    $(document).ready(function() {
        $("h2:contains('Personal Options')").next('.form-table').remove();
        $("h2:contains('Personal Options')").remove();
        $(".user-profile-picture p.description").remove();
    });
});
</script>
<?php 
  }
}

function CustomCssHide() {
  $user = wp_get_current_user();
  if(!in_array( 'administrator', (array) $user->roles )){
  ?>
<style>
.editor-post-excerpt a.components-external-link,
.editor-post-link p,
h3.edit-post-post-link__preview-label,
a.components-external-link.edit-post-post-link__link,
button.components-button.edit-post-sidebar__panel-tab[data-label=Block],
.block-editor-block-list__empty-block-inserter,
.components-dropdown.components-dropdown-menu.edit-post-more-menu,
.edit-post-header-toolbar .composer-switch,
button.components-button.block-editor-inserter__toggle.has-icon,
.edit-post-header__settings .components-dropdown.block-editor-post-preview__dropdown,
div#slider_revolution_metabox,
.components-panel__body.block-editor-block-inspector__advanced,
.edit-post-header__toolbar button.components-button.edit-post-header-toolbar__inserter-toggle.is-primary {
    display: none !important;
}

.block-editor__container div#post_settings {
    display: none;
}

.components-modal__screen-overlay {
    display: none;
}

#wpcontent .edit-post-layout.is-mode-visual.is-sidebar-opened.has-metaboxes.interface-interface-skeleton {
    top: 35px !important;
    left: 202px !important;
}

.acf-gallery-backdrop {
    display: none !important;
}
</style>
<?php
  }
}
add_action( 'admin_head', 'CustomCssHide' );

function Hide_index() {
  $user = wp_get_current_user();
  if(!in_array( 'administrator', (array) $user->roles )){
  ?>
<script type="text/javascript">
jQuery(function($) {
    $(document).ready(function() {
        $("h2:contains('Multilingual Content Setup')").parent().next('.inside').remove();
        $("h2:contains('Multilingual Content Setup')").parent().remove();
        $("h2:contains('Language')").next('.handle-actions.hide-if-no-js').remove();
        $("h2:contains('Language')").remove();
        $('#icl_document_language_dropdown').parent().css('display', 'none');
        $("h2:contains('Attach a BuddyForm')").parent().next('.inside').remove();
        $("h2:contains('Attach a BuddyForm')").parent().remove();
        $('label .title:contains("Template")').next('select[name=page_template]').remove();
        $('label .title:contains("Template")').remove();
        $('#wpseo_meta .postbox-header h2.hndle.ui-sortable-handle').text('SEO');
    });
});
</script>
<?php
  }
}
add_action('admin_footer', 'Hide_index');
