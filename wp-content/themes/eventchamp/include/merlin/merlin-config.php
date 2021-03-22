<?php
/*======
*
* Merlin Settings
*
======*/
if ( ! class_exists( 'Merlin' ) ) {

	return;

}

$wizard = new Merlin(

	$config = array(
		'directory' => 'include/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url' => 'demo-importer', // The wp-admin page slug where Merlin WP loads.
		'parent_slug' => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability' => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode' => true, // Enable development mode for testing.
		'license_step' => false, // EDD license activation step.
		'license_required' => false, // Require the license activation step.
		'license_help_url' => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url' => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name' => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug' => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => '', // Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu' => esc_html__( 'Theme Setup', 'eventchamp' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s' => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'eventchamp' ),
		'return-to-dashboard' => esc_html__( 'Return to the dashboard', 'eventchamp' ),
		'ignore' => esc_html__( 'Disable this wizard', 'eventchamp' ),

		'btn-skip' => esc_html__( 'Skip', 'eventchamp' ),
		'btn-next' => esc_html__( 'Next', 'eventchamp' ),
		'btn-start' => esc_html__( 'Start', 'eventchamp' ),
		'btn-no' => esc_html__( 'Cancel', 'eventchamp' ),
		'btn-plugins-install' => esc_html__( 'Install', 'eventchamp' ),
		'btn-child-install' => esc_html__( 'Install', 'eventchamp' ),
		'btn-content-install' => esc_html__( 'Install', 'eventchamp' ),
		'btn-import' => esc_html__( 'Import', 'eventchamp' ),
		'btn-license-activate' => esc_html__( 'Activate', 'eventchamp' ),
		'btn-license-skip' => esc_html__( 'Later', 'eventchamp' ),

		/* translators: Theme Name */
		'license-header%s' => esc_html__( 'Activate %s', 'eventchamp' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'eventchamp' ),
		/* translators: Theme Name */
		'license%s' => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'eventchamp' ),
		'license-label' => esc_html__( 'License key', 'eventchamp' ),
		'license-success%s' => esc_html__( 'The theme is already registered, so you can go to the next step!', 'eventchamp' ),
		'license-json-success%s' => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'eventchamp' ),
		'license-tooltip' => esc_html__( 'Need help?', 'eventchamp' ),

		/* translators: Theme Name */
		'welcome-header%s' => esc_html__( 'Welcome to %s', 'eventchamp' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'eventchamp' ),
		'welcome%s' => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'eventchamp' ),
		'welcome-success%s' => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'eventchamp' ),

		'child-header' => esc_html__( 'Install Child Theme', 'eventchamp' ),
		'child-header-success' => esc_html__( 'You\'re good to go!', 'eventchamp' ),
		'child' => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'eventchamp' ),
		'child-success%s' => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'eventchamp' ),
		'child-action-link' => esc_html__( 'Learn about child themes', 'eventchamp' ),
		'child-json-success%s' => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'eventchamp' ),
		'child-json-already%s' => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'eventchamp' ),

		'plugins-header' => esc_html__( 'Install Plugins', 'eventchamp' ),
		'plugins-header-success' => esc_html__( 'You\'re up to speed!', 'eventchamp' ),
		'plugins' => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'eventchamp' ),
		'plugins-success%s' => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'eventchamp' ),
		'plugins-action-link' => esc_html__( 'Advanced', 'eventchamp' ),

		'import-header' => esc_html__( 'Import Content', 'eventchamp' ),
		'import' => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'eventchamp' ),
		'import-action-link' => esc_html__( 'Advanced', 'eventchamp' ),

		'ready-header' => esc_html__( 'All done. Have fun!', 'eventchamp' ),

		/* translators: Theme Author */
		'ready%s' => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'eventchamp' ),
		'ready-action-link' => esc_html__( 'Extras', 'eventchamp' ),
		'ready-big-button' => esc_html__( 'View your website', 'eventchamp' ),
		'ready-link-1' => sprintf( '<a href="%1$s">%2$s</a>', esc_url( admin_url( 'customize.php' ) ), esc_html__( 'Start Customizing', 'eventchamp' ) ),
		'ready-link-2' => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://support.gloriathemes.com/' ), esc_html__( 'Get Theme Support', 'eventchamp' ) ),
		'ready-link-3' => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://gloriathemes.com/' ), esc_html__( 'Explore WordPress Themes', 'eventchamp' ) ),
	)

);