<?php
/**
 * Admin
 *
 * @package GamiPress\BuddyPress\Admin
 * @since 1.0.3
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

require_once GAMIPRESS_BP_DIR . 'includes/admin/recount-activity.php';

/**
 * Shortcut function to get plugin options
 *
 * @since  1.0.8
 *
 * @param string    $option_name
 * @param bool      $default
 *
 * @return mixed
 */
function gamipress_bp_get_option( $option_name, $default = false ) {

    $prefix = 'bp_';

    return gamipress_get_option( $prefix . $option_name, $default );
}

/**
 * BuddyPress Settings meta boxes
 *
 * @since  1.0.3
 *
 * @param $meta_boxes
 *
 * @return mixed
 */
function gamipress_bp_settings_meta_boxes( $meta_boxes ) {

    $prefix = 'bp_';

    // Setup dynamic achievement fields
    $achievement_fields = array();

    foreach( GamiPress()->shortcodes['gamipress_achievement']->fields as $field_id => $field_args ) {

        if( $field_id === 'id' ) {
            continue;
        }

        if( $field_args['type'] === 'checkbox' && isset( $field_args['default'] ) ) {
            unset( $field_args['default'] );
        }

        $achievement_fields[$prefix . 'members_achievements_' . $field_id] = $field_args;

    }

    // Setup dynamic rank fields
    $rank_fields = array();

    foreach( GamiPress()->shortcodes['gamipress_rank']->fields as $field_id => $field_args ) {

        if( $field_id === 'id' ) {
            continue;
        }

        if( $field_args['type'] === 'checkbox' && isset( $field_args['default'] ) ) {
            unset( $field_args['default'] );
        }

        $rank_fields[$prefix . 'members_ranks_' . $field_id] = $field_args;

    }

    $meta_boxes['gamipress-bp-settings'] = array(
        'title' => __( 'BuddyPress', 'gamipress-buddypress-integration' ),
        'fields' => apply_filters( 'gamipress_bp_settings_fields', array(

            // Points Types

            $prefix . 'points_placement' => array(
                'name' => __( 'Where Place User Points?', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Check the areas you wish to show the user points.', 'gamipress-buddypress-integration' ),
                'type' => 'multicheck',
                'classes' => 'gamipress-switch',
                'options' => array(
                    'top'       => __( 'At top of the user profile (before the user name)', 'gamipress-buddypress-integration' ),
                    'listing'   => __( 'On members listing', 'gamipress-buddypress-integration' ),
                    'activity'   => __( 'On activities', 'gamipress-buddypress-integration' ),
                ),
            ),
            $prefix . 'members_points_types' => array(
                'name' => __( 'Points Types', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Choose the points types you want to show.', 'gamipress-buddypress-integration' )
                    . '<br>' . __( '<strong>Note:</strong> You can drag and drop this options to reorder them. The order you set will affect to the order they will get displayed.', 'gamipress-buddypress-integration' ),
                'type' => 'multicheck',
                'options_cb' => 'gamipress_bp_members_points_types_option_cb',
            ),
            $prefix . 'members_points_types_top_thumbnail' => array(
                'name' => __( 'Show Thumbnail', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Show the points type featured image.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'members_points_types_top_thumbnail_size' => array(
                'name' => __( 'Thumbnail Size', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Set the thumbnail size (in pixels).', 'gamipress-buddypress-integration' ),
                'type' => 'text',
                'default' => '25',
            ),
            $prefix . 'members_points_types_top_label' => array(
                'name' => __( 'Show Label', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Show the points type singular or plural label.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),

            // Achievement Types

            $prefix . 'achievements_placement' => array(
                'name' => __( 'Where Place User Achievements?', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Check the areas you wish to show the user achievements.', 'gamipress-buddypress-integration' ),
                'type' => 'multicheck',
                'classes' => 'gamipress-switch',
                'options' => array(
                    'top'       => __( 'At top of the user profile (before the user name)', 'gamipress-buddypress-integration' ),
                    'listing'   => __( 'On members listing', 'gamipress-buddypress-integration' ),
                    'activity'   => __( 'On activities', 'gamipress-buddypress-integration' ),
                ),
            ),
            $prefix . 'members_achievements_types' => array(
                'name' => __( 'User Profile Achievement Types', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Choose the achievement types you want to show.', 'gamipress-buddypress-integration' )
                    . '<br>' . __( '<strong>Note:</strong> You can drag and drop this options to reorder them. The order you set will affect to the order they will get displayed.', 'gamipress-buddypress-integration' ),
                'type' => 'multicheck',
                'options_cb' => 'gamipress_bp_members_achievements_types_option_cb',
            ),
            $prefix . 'members_achievements_top_thumbnail' => array(
                'name' => __( 'Show Thumbnail', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Show the achievement featured image.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'members_achievements_top_thumbnail_size' => array(
                'name' => __( 'Thumbnail Size', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Set the thumbnail size (in pixels).', 'gamipress-buddypress-integration' ),
                'type' => 'text',
                'default' => '25',
            ),
            $prefix . 'members_achievements_top_title' => array(
                'name' => __( 'Show Title', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Show the achievements title.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'members_achievements_top_link' => array(
                'name' => __( 'Show Link', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Add a link to the achievement page.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'members_achievements_top_label' => array(
                'name' => __( 'Show Label', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Show the achievement type label.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'members_achievements_top_limit' => array(
                'name' => __( 'Limit', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Number of achievements to display.', 'gamipress-buddypress-integration' ),
                'type' => 'text',
                'default' => '10',
            ),

            // Rank Types

            $prefix . 'ranks_placement' => array(
                'name' => __( 'Where Place User Ranks?', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Check the areas you wish to show the user ranks.', 'gamipress-buddypress-integration' ),
                'type' => 'multicheck',
                'classes' => 'gamipress-switch',
                'options' => array(
                    'top'       => __( 'At top of the user profile (before the user name)', 'gamipress-buddypress-integration' ),
                    'listing'   => __( 'On members listing', 'gamipress-buddypress-integration' ),
                    'activity'   => __( 'On activities', 'gamipress-buddypress-integration' ),
                ),
            ),
            $prefix . 'members_ranks_types' => array(
                'name' => __( 'Rank Types', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Choose the rank types you want to show.', 'gamipress-buddypress-integration' )
                    . '<br>' . __( '<strong>Note:</strong> You can drag and drop this options to reorder them. The order you set will affect to the order they will get displayed.', 'gamipress-buddypress-integration' ),
                'type' => 'multicheck',
                'options_cb' => 'gamipress_bp_members_ranks_types_option_cb',
            ),
            $prefix . 'members_ranks_top_thumbnail' => array(
                'name' => __( 'Show Thumbnail', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Show the achievement featured image.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'members_ranks_top_thumbnail_size' => array(
                'name' => __( 'Thumbnail Size', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Set the thumbnail size (in pixels).', 'gamipress-buddypress-integration' ),
                'type' => 'text',
                'default' => '25',
            ),
            $prefix . 'members_ranks_top_title' => array(
                'name' => __( 'Show Title', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Show the rank title.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'members_ranks_top_link' => array(
                'name' => __( 'Show Link', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Add a link to the rank page.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'members_ranks_top_label' => array(
                'name' => __( 'Show Label', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Show the rank type label.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),

        ) ),
        'vertical_tabs' => true,
        'tabs' => apply_filters( 'gamipress_bp_settings_tabs', array(
            'points' => array(
                'title' => __( 'Points', 'gamipress-buddypress-integration' ),
                'icon' => 'dashicons-star-filled',
                'fields' => array(
                    $prefix . 'points_placement',
                    $prefix . 'members_points_types',
                    $prefix . 'members_points_types_top_thumbnail',
                    $prefix . 'members_points_types_top_thumbnail_size',
                    $prefix . 'members_points_types_top_label'
                )
            ),
            'achievements' => array(
                'title' => __( 'Achievements', 'gamipress-buddypress-integration' ),
                'icon' => 'dashicons-awards',
                'fields' => array(
                    $prefix . 'achievements_placement',
                    $prefix . 'members_achievements_types',
                    $prefix . 'members_achievements_top_thumbnail',
                    $prefix . 'members_achievements_top_thumbnail_size',
                    $prefix . 'members_achievements_top_title',
                    $prefix . 'members_achievements_top_link',
                    $prefix . 'members_achievements_top_label',
                    $prefix . 'members_achievements_top_limit',
                ),
            ),
            'ranks' => array(
                'title' => __( 'Ranks', 'gamipress-buddypress-integration' ),
                'icon' => 'dashicons-rank',
                'fields' => array(
                    $prefix . 'ranks_placement',
                    $prefix . 'members_ranks_types',
                    $prefix . 'members_ranks_top_thumbnail',
                    $prefix . 'members_ranks_top_thumbnail_size',
                    $prefix . 'members_ranks_top_title',
                    $prefix . 'members_ranks_top_link',
                    $prefix . 'members_ranks_top_label',
                ),
            )
        ) )
    );

    // Profile Tab settings
    $meta_boxes['gamipress-bp-tab-settings'] = array(
        'title' => __( 'BuddyPress Profile Tab', 'gamipress-buddypress-integration' ),
        'fields' => apply_filters( 'gamipress_bp_tab_settings_fields', array_merge( array(

            // Points Types

            $prefix . 'points_tab' => array(
                'name' => __( 'Enable Profile Points Tab', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Check this option to show the user points on a profile tab.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'points_tab_title' => array(
                'name' => __( 'Tab Title', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Text to show on the BuddyPress user profile.', 'gamipress-buddypress-integration' ),
                'type' => 'text',
                'default' => __( 'Points', 'gamipress-buddypress-integration' ),
            ),
            $prefix . 'points_tab_slug' => array(
                'name' => __( 'Tab Slug (Optional)', 'gamipress-buddypress-integration' ),
                'desc' => __( 'URL slug to use on the profile tab. Leave blank and slug will be a URL version of the tab title (eg: "My Tab Title" will have a slug like "my-tab-title").', 'gamipress-buddypress-integration' )
                    . '<br>' . __( '<strong>Important:</strong> If you set a tab title with special characters then provide a slug with URL friendly characters.', 'gamipress-buddypress-integration' ),
                'type' => 'text',
            ),
            $prefix . 'tab_points_types' => array(
                'name' => __( 'Points Types', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Choose the points types you want to show on BuddyPress user profile.', 'gamipress-buddypress-integration' )
                    . '<br>' . __( '<strong>Note:</strong> You can drag and drop this options to reorder them. The order you set will affect to the order they will get displayed on the profile.', 'gamipress-buddypress-integration' ),
                'type' => 'multicheck',
                'options_cb' => 'gamipress_bp_tab_points_types_option_cb',
            ),

            // Achievement Types

            $prefix . 'achievements_tab' => array(
                'name' => __( 'Enable Profile Achievements Tab', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Check this option to show the user achievements on a profile tab.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'achievements_tab_title' => array(
                'name' => __( 'Tab Title', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Text to show on the BuddyPress user profile.', 'gamipress-buddypress-integration' ),
                'type' => 'text',
                'default' => __( 'Achievements', 'gamipress-buddypress-integration' ),
            ),
            $prefix . 'achievements_tab_slug' => array(
                'name' => __( 'Tab Slug (Optional)', 'gamipress-buddypress-integration' ),
                'desc' => __( 'URL slug to use on the profile tab. Leave blank and slug will be a URL version of the tab title (eg: "My Tab Title" will have a slug like "my-tab-title").', 'gamipress-buddypress-integration' )
                    . '<br>' . __( '<strong>Important:</strong> If you set a tab title with special characters then provide a slug with URL friendly characters.', 'gamipress-buddypress-integration' ),
                'type' => 'text',
            ),
            $prefix . 'tab_achievements_types' => array(
                'name' => __( 'Achievement Types', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Choose the achievement types you want to show on BuddyPress user profile achievements tab.', 'gamipress-buddypress-integration' )
                    . '<br>' . __( '<strong>Note:</strong> You can drag and drop this options to reorder them. The order you set will affect to the order they will get displayed on the profile.', 'gamipress-buddypress-integration' ),
                'type' => 'multicheck',
                'options_cb' => 'gamipress_bp_tab_achievements_types_option_cb',
            ),
            $prefix . 'members_achievements_template_title' => array(
                'name'        => __( 'Achievements Tab Display Options', 'gamipress-buddypress-integration' ),
                'description' => __( 'Setup how achievements should look on the BuddyPress user profile tab.', 'gamipress-buddypress-integration' ),
                'type'        => 'title',
            ),
            $prefix . 'members_achievements_columns' => array(
                'name'        => __( 'Columns', 'gamipress-buddypress-integration' ),
                'description' => __( 'Columns to divide achievements.', 'gamipress-buddypress-integration' ),
                'type'  => 'select',
                'options' => array(
                    '1' => __( '1 Column', 'gamipress-buddypress-integration' ),
                    '2' => __( '2 Columns', 'gamipress-buddypress-integration' ),
                    '3' => __( '3 Columns', 'gamipress-buddypress-integration' ),
                    '4' => __( '4 Columns', 'gamipress-buddypress-integration' ),
                    '5' => __( '5 Columns', 'gamipress-buddypress-integration' ),
                    '6' => __( '6 Columns', 'gamipress-buddypress-integration' ),
                ),
                'default' => '1'
            ),
            $prefix . 'members_achievements_limit' => array(
                'name'        => __( 'Limit', 'gamipress-buddypress-integration' ),
                'description' => __( 'Number of achievements to display.', 'gamipress-buddypress-integration' ),
                'type'        => 'text',
                'default'     => 10,
            ),
            $prefix . 'members_achievements_orderby' => array(
                'name'        => __( 'Order By', 'gamipress-buddypress-integration' ),
                'description' => __( 'Parameter to use for sorting.', 'gamipress-buddypress-integration' ),
                'type'        => 'select',
                'options'      => array(
                    'menu_order' => __( 'Menu Order', 'gamipress-buddypress-integration' ),
                    'ID'         => __( 'Achievement ID', 'gamipress-buddypress-integration' ),
                    'title'      => __( 'Achievement Title', 'gamipress-buddypress-integration' ),
                    'date'       => __( 'Published Date', 'gamipress-buddypress-integration' ),
                    'modified'   => __( 'Last Modified Date', 'gamipress-buddypress-integration' ),
                    'author'     => __( 'Achievement Author', 'gamipress-buddypress-integration' ),
                    'rand'       => __( 'Random', 'gamipress-buddypress-integration' ),
                ),
                'default'     => 'menu_order',
            ),
            $prefix . 'members_achievements_order' => array(
                'name'        => __( 'Order', 'gamipress-buddypress-integration' ),
                'description' => __( 'Sort order.', 'gamipress-buddypress-integration' ),
                'type'        => 'select',
                'options'      => array( 'ASC' => __( 'Ascending', 'gamipress-buddypress-integration' ), 'DESC' => __( 'Descending', 'gamipress-buddypress-integration' ) ),
                'default'     => 'ASC',
            ),

            // Rank Types

            $prefix . 'ranks_tab' => array(
                'name' => __( 'Enable Profile Ranks Tab', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Check this option to show the user ranks on a profile tab.', 'gamipress-buddypress-integration' ),
                'type' => 'checkbox',
                'classes' => 'gamipress-switch',
            ),
            $prefix . 'ranks_tab_title' => array(
                'name' => __( 'Tab Title', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Text to show on the BuddyPress user profile.', 'gamipress-buddypress-integration' ),
                'type' => 'text',
                'default' => __( 'Ranks', 'gamipress-buddypress-integration' ),
            ),
            $prefix . 'ranks_tab_slug' => array(
                'name' => __( 'Tab Slug (Optional)', 'gamipress-buddypress-integration' ),
                'desc' => __( 'URL slug to use on the profile tab. Leave blank and slug will be a URL version of the tab title (eg: "My Tab Title" will have a slug like "my-tab-title").', 'gamipress-buddypress-integration' )
                    . '<br>' . __( '<strong>Important:</strong> If you set a tab title with special characters then provide a slug with URL friendly characters.', 'gamipress-buddypress-integration' ),
                'type' => 'text',
            ),
            $prefix . 'tab_ranks_types' => array(
                'name' => __( 'Rank Types', 'gamipress-buddypress-integration' ),
                'desc' => __( 'Choose the rank types you want to show on BuddyPress user profile ranks tab.', 'gamipress-buddypress-integration' )
                    . '<br>' . __( '<strong>Note:</strong> You can drag and drop this options to reorder them. The order you set will affect to the order they will get displayed on the profile.', 'gamipress-buddypress-integration' ),
                'type' => 'multicheck',
                'options_cb' => 'gamipress_bp_tab_ranks_types_option_cb',
            ),
            $prefix . 'members_ranks_template_title' => array(
                'name'        => __( 'Ranks Tab Display Options', 'gamipress-buddypress-integration' ),
                'description' => __( 'Setup how ranks should look on the BuddyPress user profile tab.', 'gamipress-buddypress-integration' ),
                'type'        => 'title',
            ),
            $prefix . 'members_ranks_columns' => array(
                'name'        => __( 'Columns', 'gamipress-buddypress-integration' ),
                'description' => __( 'Columns to divide ranks.', 'gamipress-buddypress-integration' ),
                'type'  => 'select',
                'options' => array(
                    '1' => __( '1 Column', 'gamipress-buddypress-integration' ),
                    '2' => __( '2 Columns', 'gamipress-buddypress-integration' ),
                    '3' => __( '3 Columns', 'gamipress-buddypress-integration' ),
                    '4' => __( '4 Columns', 'gamipress-buddypress-integration' ),
                    '5' => __( '5 Columns', 'gamipress-buddypress-integration' ),
                    '6' => __( '6 Columns', 'gamipress-buddypress-integration' ),
                ),
                'default' => '1'
            ),
            $prefix . 'members_ranks_orderby' => array(
                'name'        => __( 'Order By', 'gamipress-buddypress-integration' ),
                'description' => __( 'Parameter to use for sorting.', 'gamipress-buddypress-integration' ),
                'type'        => 'select',
                'options'      => array(
                    'priority'   => __( 'Priority', 'gamipress-buddypress-integration' ),
                    'ID'         => __( 'Rank ID', 'gamipress-buddypress-integration' ),
                    'title'      => __( 'Rank Title', 'gamipress-buddypress-integration' ),
                    'date'       => __( 'Published Date', 'gamipress-buddypress-integration' ),
                    'modified'   => __( 'Last Modified Date', 'gamipress-buddypress-integration' ),
                    'rand'       => __( 'Random', 'gamipress-buddypress-integration' ),
                ),
                'default'     => 'priority',
            ),
            $prefix . 'members_ranks_order' => array(
                'name'        => __( 'Order', 'gamipress-buddypress-integration' ),
                'description' => __( 'Sort order.', 'gamipress-buddypress-integration' ),
                'type'        => 'select',
                'options'      => array( 'ASC' => __( 'Ascending', 'gamipress-buddypress-integration' ), 'DESC' => __( 'Descending', 'gamipress-buddypress-integration' ) ),
                'default'     => 'DESC',
            ),

        ), $achievement_fields, $rank_fields ) ),
        'vertical_tabs' => true,
        'tabs' => apply_filters( 'gamipress_bp_settings_tabs', array(
            'points' => array(
                'title' => __( 'Points', 'gamipress-buddypress-integration' ),
                'icon' => 'dashicons-star-filled',
                'fields' => array(
                    $prefix . 'points_tab',
                    $prefix . 'points_tab_title',
                    $prefix . 'points_tab_slug',
                    $prefix . 'tab_points_types',
                )
            ),
            'achievements' => array(
                'title' => __( 'Achievements', 'gamipress-buddypress-integration' ),
                'icon' => 'dashicons-awards',
                'fields' => array_merge( array(
                    $prefix . 'achievements_tab',
                    $prefix . 'achievements_tab_title',
                    $prefix . 'achievements_tab_slug',
                    $prefix . 'tab_achievements_types',
                    $prefix . 'members_achievements_template_title',
                    $prefix . 'members_achievements_columns',
                    $prefix . 'members_achievements_limit',
                    $prefix . 'members_achievements_orderby',
                    $prefix . 'members_achievements_order',
                ), array_keys( $achievement_fields ) )
            ),
            'ranks' => array(
                'title' => __( 'Ranks', 'gamipress-buddypress-integration' ),
                'icon' => 'dashicons-rank',
                'fields' => array_merge( array(
                    $prefix . 'ranks_tab',
                    $prefix . 'ranks_tab_title',
                    $prefix . 'ranks_tab_slug',
                    $prefix . 'tab_ranks_types',
                    $prefix . 'members_ranks_template_title',
                    $prefix . 'members_ranks_columns',
                    $prefix . 'members_ranks_orderby',
                    $prefix . 'members_ranks_order',
                ), array_keys( $rank_fields ) )
            )
        ) )
    );

    return $meta_boxes;

}
add_filter( 'gamipress_settings_addons_meta_boxes', 'gamipress_bp_settings_meta_boxes' );

/**
 * Block users settings meta boxes
 *
 * @since  1.0.0
 *
 * @param array $meta_boxes
 *
 * @return array
 */
function gamipress_bp_block_users_settings_meta_boxes( $meta_boxes ) {

    $prefix = 'bp_';

    $meta_boxes['gamipress-bp-block-users-settings'] = array(
        'title' => __( 'BuddyPress Block Users', 'gamipress-buddypress-integration' ),
        'fields' => apply_filters( 'gamipress_bp_block_users_settings_fields', array(
            $prefix . 'blocked_member_types' => array(
                'name'          => __( 'Blocked Profile Types', 'gamipress-buddypress-integration' ),
                'desc'          => __( 'Block users earnings by profile type. Users with those profile types will not be able to earn any GamiPress element.', 'gamipress-buddypress-integration' )
                . '<br>' . sprintf(
                    __( '<strong>Note:</strong> To block users by role or block specific users, check the <a href="%s" target="_blank">GamiPress - Block Users</a> add-on.', 'gamipress-buddypress-integration' ),
                    'https://wordpress.org/plugins/gamipress-block-users/'
                ),
                'type'          => 'advanced_select',
                'multiple'      => true,
                'classes'       => 'gamipress-selector',
                'options_cb'    => 'gamipress_bp_block_users_get_roles_options',
            ),
        ) )
    );

    return $meta_boxes;

}
add_filter( 'gamipress_settings_addons_meta_boxes', 'gamipress_bp_block_users_settings_meta_boxes' );

function gamipress_bp_block_users_get_roles_options() {

    $options = array();

    if( ! function_exists( 'bp_get_member_types' ) ) {
        return $options;
    }

    $member_types = bp_get_member_types( array(), 'objects' );

    foreach( $member_types as $member_type => $member_type_obj ) {
        $options[$member_type] = $member_type_obj->labels['singular_name'];
    }

    return $options;

}

function gamipress_bp_members_points_types_option_cb() {
    return gamipress_bp_points_types_option_cb( 'bp_members_points_types' );
}

function gamipress_bp_tab_points_types_option_cb() {
    return gamipress_bp_points_types_option_cb( 'bp_tab_points_types' );
}

function gamipress_bp_points_types_option_cb( $key = '' ) {

    $points_types_slugs = gamipress_get_points_types_slugs();

    $gamipress_settings = ( $exists = get_option( 'gamipress_settings' ) ) ? $exists : array();

    $points_types_order = isset( $gamipress_settings[$key . '_order'] ) ?
        $gamipress_settings[$key . '_order'] : $points_types_slugs;

    $points_types = gamipress_get_points_types();

    $options = array();

    foreach( $points_types_order as $points_type_slug ) {

        // Skip if points type not exists
        if( ! isset( $points_types[$points_type_slug] ) ) {
            continue;
        }

        $options[$points_type_slug] = '<input type="hidden" name="' . $key . '_order[]" value="' . $points_type_slug . '" />'
            . $points_types[$points_type_slug]['plural_name'];
    }

    $unordered_points_types = array_diff( $points_types_slugs, $points_types_order );

    // Append new achievement types
    foreach( $unordered_points_types as $unordered_points_type ) {

        // Skip if points type not exists
        if( ! isset( $points_types[$unordered_points_type] ) ) {
            continue;
        }

        $options[$unordered_points_type] = '<input type="hidden" name="' . $key . '_order[]" value="' . $unordered_points_type . '" />'
            . $points_types[$unordered_points_type]['plural_name'];
    }

    return $options;

}

function gamipress_bp_members_achievements_types_option_cb() {
    return gamipress_bp_achievements_types_option_cb( 'bp_members_achievements_types' );
}

function gamipress_bp_tab_achievements_types_option_cb() {
    return gamipress_bp_achievements_types_option_cb( 'bp_tab_achievements_types' );
}

function gamipress_bp_achievements_types_option_cb( $key = '' ) {

    $achievement_types_slugs = array_diff(
        gamipress_get_achievement_types_slugs(),
        gamipress_get_requirement_types_slugs()
    );

    $gamipress_settings = ( $exists = get_option( 'gamipress_settings' ) ) ? $exists : array();

    $achievement_types_order = isset( $gamipress_settings[$key . '_order'] ) ?
        $gamipress_settings[$key . '_order'] : $achievement_types_slugs;

    $achievement_types = gamipress_get_achievement_types();

    $options = array();

    foreach( $achievement_types_order as $achievement_type_slug ) {

        // Skip if is a requirement type or not exists on $achievement_types
        if( in_array( $achievement_type_slug, gamipress_get_requirement_types_slugs() ) || ! isset( $achievement_types[$achievement_type_slug] ) ) {
            continue;
        }

        $options[$achievement_type_slug] = '<input type="hidden" name="' . $key . '_order[]" value="' . $achievement_type_slug . '" />'
            . $achievement_types[$achievement_type_slug]['plural_name'];
    }

    $unordered_achievement_types = array_diff( $achievement_types_slugs, $achievement_types_order );

    // Append new achievement types
    foreach( $unordered_achievement_types as $unordered_achievement_type ) {

        // Skip if achievement not exists
        if( ! isset( $achievement_types[$unordered_achievement_type] ) ) {
            continue;
        }

        $options[$unordered_achievement_type] = '<input type="hidden" name="' . $key . '_order[]" value="' . $unordered_achievement_type . '" />'
            . $achievement_types[$unordered_achievement_type]['plural_name'];
    }

    return $options;

}

function gamipress_bp_members_ranks_types_option_cb() {
    return gamipress_bp_ranks_types_option_cb( 'bp_members_ranks_types' );
}

function gamipress_bp_tab_ranks_types_option_cb() {
    return gamipress_bp_ranks_types_option_cb( 'bp_tab_ranks_types' );
}

function gamipress_bp_ranks_types_option_cb( $key = '' ) {

    $rank_types_slugs = gamipress_get_rank_types_slugs();

    $gamipress_settings = ( $exists = get_option( 'gamipress_settings' ) ) ? $exists : array();

    $rank_types_order = isset( $gamipress_settings[$key . '_order'] ) ?
        $gamipress_settings[$key . '_order'] : $rank_types_slugs;

    $rank_types = gamipress_get_rank_types();

    $options = array();

    foreach( $rank_types_order as $rank_type_slug ) {

        // Skip if rank not exists
        if( ! isset( $rank_types[$rank_type_slug] ) ) {
            continue;
        }

        $options[$rank_type_slug] = '<input type="hidden" name="' . $key . '_order[]" value="' . $rank_type_slug . '" />'
            . $rank_types[$rank_type_slug]['plural_name'];

    }

    $unordered_rank_types = array_diff( $rank_types_slugs, $rank_types_order );

    // Append new rank types
    foreach( $unordered_rank_types as $unordered_rank_type ) {

        // Skip if rank not exists
        if( ! isset( $rank_types[$unordered_rank_type] ) ) {
            continue;
        }

        $options[$unordered_rank_type] = '<input type="hidden" name="' . $key . '_order[]" value="' . $unordered_rank_type . '" />'
            . $rank_types[$unordered_rank_type]['plural_name'];

    }

    return $options;

}

function gamipress_bp_save_gamipress_settings() {

    if( ! isset( $_POST['submit-cmb'] ) ) {
        return;
    }

    if( ! ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 'gamipress_settings' ) ) {
        return;
    }

    if( ! isset( $_POST['bp_members_points_types_order'] ) || ! isset( $_POST['bp_members_achievements_types_order'] ) || ! isset( $_POST['bp_members_ranks_types_order'] ) ) {
        return;
    }

    if( ! isset( $_POST['bp_tab_points_types_order'] ) || ! isset( $_POST['bp_tab_achievements_types_order'] ) || ! isset( $_POST['bp_tab_ranks_types_order'] ) ) {
        return;
    }

    // Setup GamiPress options
    $gamipress_settings = ( $exists = get_option( 'gamipress_settings' ) ) ? $exists : array();

    // Setup new setting
    $gamipress_settings['bp_members_points_types_order'] = $_POST['bp_members_points_types_order'];
    $gamipress_settings['bp_members_achievements_types_order'] = $_POST['bp_members_achievements_types_order'];
    $gamipress_settings['bp_members_ranks_types_order'] = $_POST['bp_members_ranks_types_order'];

    $gamipress_settings['bp_tab_points_types_order'] = $_POST['bp_tab_points_types_order'];
    $gamipress_settings['bp_tab_achievements_types_order'] = $_POST['bp_tab_achievements_types_order'];
    $gamipress_settings['bp_tab_ranks_types_order'] = $_POST['bp_tab_ranks_types_order'];

    // Update GamiPress settings
    update_option( 'gamipress_settings', $gamipress_settings );

}
add_action( 'cmb2_save_options-page_fields', 'gamipress_bp_save_gamipress_settings' );

/**
 * BuddyPress automatic updates
 *
 * @since  1.0.4
 *
 * @param array $automatic_updates_plugins
 *
 * @return array
 */
function gamipress_bp_automatic_updates( $automatic_updates_plugins ) {

    $automatic_updates_plugins['gamipress-buddypress-integration'] = __( 'BuddyPress integration', 'gamipress-buddypress-integration' );

    return $automatic_updates_plugins;
}
add_filter( 'gamipress_automatic_updates_plugins', 'gamipress_bp_automatic_updates' );