<?php
define( 'EVENTCHAMP_VERSION', '2.0.2' );

include( get_template_directory() . '/include/tgm-plugins.php' );
include( get_template_directory() . '/include/demo-importer.php' );
include( get_template_directory() . '/include/lazy-loading.php' );
include( get_template_directory() . '/include/fancybox.php' );
include( get_template_directory() . '/include/woocommerce-integration.php' );
include( get_template_directory() . '/include/theme-setup.php' );
include( get_template_directory() . '/include/layouts.php' );
include( get_template_directory() . '/include/meta-boxes.php' );
include( get_template_directory() . '/include/event-multiple-categories.php' );
include( get_template_directory() . '/include/event-category-colors.php' );
include( get_template_directory() . '/include/event-category-meta.php' );
include( get_template_directory() . '/include/theme-options.php' );
include( get_template_directory() . '/include/theme-options-extended.php' );
include( get_template_directory() . '/include/sidebars.php' );
include( get_template_directory() . '/include/titles.php' );
include( get_template_directory() . '/include/breadcrumbs.php' );
include( get_template_directory() . '/include/social-media.php' );
include( get_template_directory() . '/include/menus.php' );
include( get_template_directory() . '/include/loader.php' );
include( get_template_directory() . '/include/header.php' );
include( get_template_directory() . '/include/footer.php' );
include( get_template_directory() . '/include/pagination.php' );
include( get_template_directory() . '/include/blog.php' );
include( get_template_directory() . '/include/page-modules.php' );
include( get_template_directory() . '/include/event-modules.php' );
include( get_template_directory() . '/include/speaker-modules.php' );
include( get_template_directory() . '/include/venue-modules.php' );
include( get_template_directory() . '/include/user-box.php' );
include( get_template_directory() . '/include/label.php' );
include( get_template_directory() . '/include/datepicker.php' );
include( get_template_directory() . '/include/multilingual.php' );
include( get_template_directory() . '/include/wpbakery-extended.php' );
include( get_template_directory() . '/include/protected.php' );
include( get_template_directory() . '/include/cookie-bar.php' );
include( get_template_directory() . '/include/admin-columns.php' );
include( get_template_directory() . '/include/wp-user-frontend.php' );
include( get_template_directory() . '/include/like-system.php' );
include( get_template_directory() . '/include/favorite-system.php' );
include( get_template_directory() . '/include/event-repeater.php' );
include( get_template_directory() . '/include/event-add-to-calendar.php' );
include( get_template_directory() . '/include/customize.php' );

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );

if ( !class_exists( 'OT_Loader' ) ) {

	require get_template_directory() . '/include/admin/ot-loader.php';

}