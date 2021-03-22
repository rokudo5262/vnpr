<?php

namespace WPEventsImporter;

use WPEventsImporter\Formats;
use WPEventsImporter\EventsManager;
use WPEventsImporter\AjaxProgress;
use WaspCreators\Wasp;
use WPEventsImporter\Exceptions\APIException;

class Admin
{
	protected $tabs = [
		'welcome'		=> 'Get Started',
		'eventbrite'	=> 'Eventbrite',
		'facebook'		=> 'Facebook',
		'meetup'		=> 'Meetup',
		'ical'			=> 'ICAL',
		//'xml'			=> 'XML',
	];

	protected $import_types;

	protected $import_fields;

	protected $custom_post_types = null;

	protected $params	= [];

	protected $single	= false;

	protected $errors	= [];

	protected $menu_pages;

	protected $setting_form;

	protected $step_nav_params;



	public function __construct()
	{
		$this->ajaxProgress = new AjaxProgress();
		// Admin Form Inıt
		\add_action( 'init', array( $this, 'admin_forms_init' ), -1 );

		// Admin menu
		\add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}



	public function __get( $name )
	{
		if ( isset( $this->{$name} ) ) {
			return $this->{$name};
		} else {
			$this->error( 'ERROR : ' . $name . ' not found!' );

			return null;
		}
	}



	public function init()
	{
		\add_action( 'current_screen', array( $this, 'check_admin_screen' ) );
	}



	public function admin_forms_init()
	{
		// Multi importer Form
		$multi_settings			= self::get_multi_form();

		// Single Importer Form
		$single_settings		= self::get_single_form();

		// API Connections Form
		$connection_settings	= self::get_connection_form();

		// Envato License API Form
		$license_settings		= self::get_license_form();

		// Select form which is ready
		if ( $single_settings->is_ready() ) {
			$this->setting_form = $single_settings;
			$form_func = 'import_settings_form_single';
		} elseif ( $multi_settings->is_ready() ) {
			$this->setting_form = $multi_settings;
			$form_func = 'import_settings_form';
		} elseif ( $connection_settings->is_ready() ) {
			$this->setting_form = $connection_settings;
			$form_func = 'connection_settings_form';
		} elseif ( $license_settings->is_ready() ) {
			$this->setting_form = $license_settings;
			$form_func = 'license_settings_form';
		}

		// Activate selected form
		if ( $this->setting_form instanceof Wasp ) {
			$this->setting_form->wp_form_init( [ $this, $form_func ] );
		}
	}



	/**
	 * in admin_init function
	 * add_action | admin_menu
	 */
	public function admin_menu()
	{
		$this->menu_pages[] = add_menu_page(
			'',
			esc_html__( 'Events Importer', WPEVENTSIMPORTER_DOMAIN ),
			'manage_options',
			'wpeventsimporter',
			array( $this, 'settings_page' ),
			'dashicons-calendar'
		);

		$this->menu_pages[] = add_submenu_page(
			'wpeventsimporter',
			esc_html__( 'WP Events Importer Settings', WPEVENTSIMPORTER_DOMAIN ),
			esc_html__( 'Settings', WPEVENTSIMPORTER_DOMAIN ),
			'manage_options',
			'wpeventsimporter',
			array( $this, 'settings_page' )
		);

		$this->menu_pages[] = add_submenu_page(
			'wpeventsimporter',
			esc_html__( 'WP Events Importer License', WPEVENTSIMPORTER_DOMAIN ),
			esc_html__( 'License', WPEVENTSIMPORTER_DOMAIN ),
			'manage_options',
			'wpeventsimporter-license',
			array( $this, 'license_page' )
		);

		$this->menu_pages[] = add_submenu_page(
			'wpeventsimporter',
			esc_html__( 'WP Events Importer Add an Event', WPEVENTSIMPORTER_DOMAIN ),
			esc_html__( 'Import an Event', WPEVENTSIMPORTER_DOMAIN ),
			'manage_options',
			'wpeventsimporter-add-single',
			array( $this, 'add_single_event' )
		);

		$this->menu_pages[] = add_submenu_page(
			'wpeventsimporter',
			esc_html__( 'WP Events Importer Add Multiple Events', WPEVENTSIMPORTER_DOMAIN ),
			esc_html__( 'Multiple Events Import', WPEVENTSIMPORTER_DOMAIN ),
			'manage_options',
			'wpeventsimporter-add-multiple',
			array( $this, 'add_multiple_events' )
		);
	}



	public function set_param( $name, $value )
	{
		if ( ! is_string( $name ) ) return false;

		if ( $this->params[ $name ] = $value ) {
			return true;
		}

		return false;
	}



	protected function _set_platform( $platform )
	{
		$tabs = $this->tabs;

		if ( ! empty( $platform ) ) {
			if ( isset( $tabs[ $platform ] ) ) {
				$this->platform = sanitize_title( $platform );
			}
		}
		else {
			$tabs = array_keys( $tabs );
			$this->platform = $tabs[ 0 ];
		}
	}



	/**
	 * Only runs while we're on this plugin pages
	 *
	 * in admin_init function
	 * add_action | current_screen
	 */
	public function check_admin_screen()
	{
		$screen = get_current_screen();

		if ( ! is_array( $this->menu_pages ) ) return;

		if ( in_array( $screen->id, $this->menu_pages ) ) {
			$this->_plugin_zone();
		}
	}



	protected function _plugin_zone()
	{
		add_action( 'admin_notices', 'WPEventsImporter\ErrorHandler::notices' );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_theme_files' ), 1 );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
	}



	protected function _get_admin_file( $page, $dir = 'View' )
	{
		if ( ! preg_match( '#^[a-z0-9\-\_\.]+$#ui', $page ) ) {
			return false;
		}

		$page = WPEVENTSIMPORTER_PATH . 'admin/' . $dir . '/' . $page . '.php';

		if ( file_exists( $page ) ) {
			include_once( $page );

			return true;
		}

		return false;
	}



	/**
	 * "Settings" Page Content
	*/
	public function settings_page()
	{
		$this->_get_admin_file( 'api-settings' );
	}



	/**
	 * "Settings" Page Content
	*/
	public function license_page()
	{
		$this->_get_admin_file( 'license' );
	}



	/**
	* "Import an Event" Page Content
	*/
	public function add_single_event()
	{
		$this->_get_admin_file( 'add-single-event' );
	}



	/**
 	* "Multiple Events Import" Page Content
	*/
	public function add_multiple_events()
	{
		$this->_get_admin_file( 'add-multiple-events' );
	}



	public function tab_generator( $tabs, $query_args )
	{
		$active_tab = function( $key, $current ) {

			if ( ! empty( $key ) ) {
				if ( empty( $current ) ) {
					$active_tab = null;
					echo ' active';
				}
				elseif ( $key == $current ) {
					echo ' active';
				}
			}
		};
		?>
		<div class="tabs-grid">
		<?php
		foreach( $tabs as $tab_key => $tab_value ) :
			$query_args[ 'platform' ] = $tab_key;
		?>
			<div class="tab-button<?php $active_tab( $tab_key, $this->platform )?>">
				<a href="<?php echo add_query_arg( $query_args ); ?>">
					<?php esc_html_e( $tab_value, WPEVENTSIMPORTER_DOMAIN )?>
				</a>
			</div>
		<?php
		endforeach;
		?>
		</div>
		<?php
	}



	public function error( $text )
	{
		if ( ! empty( $text ) ) {
			$this->errors[] = $text;
		}
	}



	public function has_errors()
	{
		if ( is_array( $this->errors ) ) {
			if ( count( $this->errors ) > 0 ) {
				return true;
			}
		}

		return false;
	}



	public function show_errors( $echo = true )
	{
		$print_errors = '<p>' . implode( '</p><p>', $this->errors ) . '</p>';

		if ( ! $echo ) {
			return $print_errors;
		}

		echo $print_errors;
	}



	public function admin_footer_text( $text )
	{
		// $text .= __( '<div class="admin-footer-text"></div>', WPEVENTSIMPORTER_DOMAIN );
		return $text;
	}



	public function admin_theme_files()
	{
		wp_enqueue_style( 'admin-theme-main-css', plugins_url( 'css/admin.css', WPEVENTSIMPORTER_BASENAME ), '', '0.1.2' );
		wp_enqueue_script( 'admin-theme-main-js', plugins_url( 'js/admin.js', WPEVENTSIMPORTER_BASENAME ), [ 'jquery' ], '0.0.2', true );
	}



	public function connection_settings_form()
	{
		$formConfig = [
			[
				'name'	=> 'wpeventsimporter_conn_fb',
				'title'	=> 'Facebook API Setting',
				'desc'	=> 'Fill the below gaps about your Facebook api',
				'items'	=> [
					[
						'type'	=> 'text_input',
						'name'	=> 'facebook_api_id',
						'label'	=> 'Facebook API ID'
					],
					[
						'type'	=> 'text_input',
						'name'	=> 'facebook_api_secret',
						'label'	=> 'Facebook API secret'
					]
				]
			],
			[
				'name'	=> 'wpeventsimporter_conn_eventbrite',
				'title'	=> 'Eventbrite API Setting',
				'desc'	=> 'Fill the below gaps about your Eventbrite api',
				'items'	=> [
					[
						'type'	=> 'text_input',
						'name'	=> 'eventbrite_api_id',
						'label'	=> 'Eventbrite API ID'
					],
					[
						'type'	=> 'text_input',
						'name'	=> 'eventbrite_api_secret',
						'label'	=> 'Eventbrite API secret'
					]
				]
			],
			[
				'name'	=> 'wpeventsimporter_conn_meetup',
				'title'	=> 'Meetup API Setting',
				'desc'	=> 'Fill the below gaps about your Meetup api',
				'items'	=> [
					[
						'type'	=> 'text_input',
						'name'	=> 'meetup_api_key',
						'label'	=> 'Meetup OAuth Key'
					],
					[
						'type'	=> 'text_input',
						'name'	=> 'meetup_api_secret',
						'label'	=> 'Meetup OAuth Secret'
					]
				]
			]
		];

		$this->setting_form->loadForm( $formConfig );
		$this->setting_form->register();
	}



	public function license_settings_form()
	{
		$formConfig = [
			[
				'name'	=> 'wpeventsimporter_license',
				'title'	=> 'Envato API Update Setting',
				'desc'	=> 'Fill the below gaps for Envato auto update',
				'items'	=> [
					[
						'type'	=> 'text_input',
						'name'	=> 'license_token',
						'label'	=> 'Your Envato Token'
					],
					[
						'type'	=> 'text_input',
						'name'	=> 'purchase_code',
						'label'	=> 'Your Envato Purchase Code'
					]
				]
			],
		];

		$this->setting_form->loadForm( $formConfig );
		$this->setting_form->register();
	}



	public function import_settings_form()
	{
		$this->_import_settings_form_common();
	}



	public function import_settings_form_single()
	{
		$this->_import_settings_form_common( true );
	}



	protected function _import_settings_form_common( $single = false )
	{
		$this->custom_post_types	= Formats::get_custom_post_types();
		$this->import_types				= Formats::$import_types;
		$this->import_fields			= Formats::$import_fields;

		if ( empty( $this->setting_form ) ) return;

		$this->single = $single;

		$platform = $this->setting_form->_get( 'platform' );

		if ( $single ) {
			if ( $platform === 'result' ) {
				$this->tabs[ 'result' ] = 'Import Results';
			}
		}
		else {
			$this->tabs[ 'list' ] = 'All Imports';
		}

		$platform = $this->setting_form->_get( 'platform' );

		// Set platform
		$this->_set_platform( $platform );

		$this->_get_admin_file( 'setting-steps', 'Controller' );
	}



	public static function get_single_form()
	{
		return new Wasp(
			'wpeventsimporter-add-single',
			Formats::get_option_name( 'single_settings' ),
			WPEVENTSIMPORTER_DOMAIN
		);
	}



	public static function get_multi_form()
	{
		return new Wasp(
			'wpeventsimporter-add-multiple',
			Formats::get_option_name( 'multiple_settings' ),
			WPEVENTSIMPORTER_DOMAIN,
			'edit'
		);
	}



	public static function get_connection_form()
	{
		return new Wasp(
			'wpeventsimporter',
			Formats::get_option_name( 'connections' ),
			WPEVENTSIMPORTER_DOMAIN
		);
	}



	public static function get_license_form()
	{
		return new Wasp(
			'wpeventsimporter-license',
			Formats::get_option_name( 'license' ),
			WPEVENTSIMPORTER_DOMAIN
		);
	}



	/**
	 * Gets license settings for Envato activation
	 *
	 * @return array|bool
	 */
	public static function get_license_settings()
	{
		$form = self::get_license_form();

		return $form->get_settings();
	}



	/**
	 * Gets connection settings facebook, meetup, eventbrite
	 *
	 * @return array|bool
	 */
	public static function get_connection_settings()
	{
		$form = self::get_connection_form();

		return $form->get_settings();
	}



	/**
	 * Gets single event form settings data once intended for using into cron imports.
	 *
	 * @return bool|array
	 */
	public static function get_single_settings()
	{
		$single_settings = self::get_single_form();

		if ( $single_settings->get_setting( 'ready' ) === 'ok' ) {
			$settings = $single_settings->get_settings();
			$single_settings->delete_setting();

			return $settings;
		}

		return false;
	}



	/**
	 * Gets multi event form settings data intended for using into cron import process.
	 *
	 * @return bool|array
	 */
	public static function get_multi_settings()
	{
		$multi_settings = self::get_multi_form();

		if ( ! empty( $multi_settings ) ) {
			$return_array	= array();
			$indexes			= $multi_settings->getRows();

			if ( empty( $indexes ) || ! is_array( $indexes ) ) return false;

			foreach ( $indexes as $setting_id => $setting_values ) {
				$import_setting = $setting_values[ 'fields' ];

				if ( empty( $import_setting ) ) continue;

				if ( isset( $import_setting[ 'ready' ] ) && $import_setting[ 'ready' ] === 'ok' ) {
					$return_array[ $setting_id ] = $import_setting;
				}
			}

			if ( ! empty( $return_array ) ) {
				return $return_array;
			}
		}

		return false;
	}



	/**
	 *
	 */
	public static function get_events_options( $settings )
	{
		$results	= [];
		$events		= EventsManager::get( $settings );

		if ( $events ) {
			foreach ( $events as $e_key => $event ) {
				$results[] = [
					'value'	=> $e_key,
					'label'	=> $event[ 'post_data' ][ 'name' ],
				];
			}

			return $results;
		}

		return false;
	}



	/**
	 *
	 */
	public static function get_fb_page_options()
	{
		$results	= [];
		$pages		= EventsManager::connect( 'facebook' )->get_user_pages();

		if ( $pages !== false ) {

			foreach ( $pages as $value ) {
				$results[] = [
					'value'	=> $value[ 'id' ],
					'label'	=> $value[ 'name' ],
				];
			}

			return $results;
		}

		return false;
	}



	public function set_step_nav( $args )
	{
		$this->step_nav_params = $args;
	}



	public function get_step_nav()
	{
		$html		= '';
		$step		= (string)$this->step_nav_params[ 'step' ];
		$steps		= $this->step_nav_params[ 'steps' ];
		$last_step	= $this->step_nav_params[ 'ready' ];
		$disable	= false;

		foreach ( $steps as $nav_key => $nav_val ) {
			$nav_key	= (string)$nav_key;
			$active		= false;
			$class		= [ 'step_nav' ];

			$href = add_query_arg(
				[
					'step' => $nav_key,
					'settings-updated' => null
				]
			);

			if ( $disable ) {
				$href		= '#';
				$class[]	= 'disable';
			}

			if ( $step === $nav_key ) {
				$active		= true;
			}

			if ( $last_step !== 'ok' && ( empty( $last_step ) || $last_step == $nav_key ) ) {
				$disable	= true;
			}

			if ( $active ) {
				$href		= '#';
				$class[]	= 'active';
			}

			$class	= implode( ' ', $class );

			$html .= '<a href="' . $href . '" class="' . $class . '">';
			$html .= $nav_val;
			$html .= '</a>';
		}

		return $html;
	}
}
