<?php
/**
 * @package   Photo Contest WordPress Plugin
 * @author    Zbyněk Hovorka
 * @link      http://galleryplugins.com/photo-contest/
 * @copyright 2014 Zbyněk Hovorka
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}


class Photo_Contest_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		/**
		 * Call $plugin_slug from public plugin class.
		 */
		$plugin = Photo_Contest::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __FILE__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		/*
		 * Define custom functionality.
		 */
		add_action('admin_init', array( $this, 'photo_contest_output_buffer' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

	$plugin_version = get_option('pcplugin-version');

	if(isset($_GET['page']) and is_admin()){
      if($_GET['page']=='photo-contest' or $_GET['page']=='photo-contest-contests' or $_GET['page']=='photo-contest-photos' or $_GET['page']=='photo-contest-categories' or $_GET['page']=='photo-contest-info' or $_GET['page']=='photo-contest-tools' or $_GET['page']=='photo-contest-jury' or $_GET['page']=='photo-contest-votes'){

		  wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), $plugin_version);
		  wp_enqueue_style('jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css');
		  wp_enqueue_style( $this->plugin_slug .'-form-1', plugins_url( 'css/bootstrap.css', __FILE__ ), array(), $plugin_version );
		  wp_enqueue_style( $this->plugin_slug .'-form-2', plugins_url( 'css/forms-plus.css', __FILE__ ), array(), $plugin_version );
		  wp_enqueue_style( $this->plugin_slug .'-form-3', plugins_url( 'css/forms-plus-steelBlue.css', __FILE__ ), array(), $plugin_version );
		  wp_enqueue_style( $this->plugin_slug .'-font-awesome', plugins_url( 'css/font-awesome.min.css', __FILE__ ), array(), $plugin_version );

      }
	 }
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
	$plugin_version = get_option('pcplugin-version');
		if(isset($_GET['page'])){
		  if($_GET['page']=='photo-contest' or $_GET['page']=='photo-contest-contests' or $_GET['page']=='photo-contest-photos' or $_GET['page']=='photo-contest-categories' or $_GET['page']=='photo-contest-info' or $_GET['page']=='photo-contest-export' or $_GET['page']=='photo-contest-votes' or $_GET['page']=='photo-contest-tools'){

		  wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), $plugin_version );
		  wp_enqueue_script( 'jquery-ui-datepicker', plugins_url( 'js/jquery.ui.datepicker.min.js', __FILE__ ), array('jquery-ui-core') , $plugin_version );

		  }
		}
		if(isset($_GET['page'])){
		  if($_GET['page']=='photo-contest-tools'){

		  //media uploader
		  wp_enqueue_media();
		  wp_enqueue_script( $this->plugin_slug . '-media-script', plugins_url( 'js/media.js' , __FILE__ ), array('jquery'), $plugin_version );

		  }
		}
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 * TODO:
		 *
		 * - Change 'Page Title' to the title of your plugin admin page
		 * - Change 'Menu Text' to the text for menu item for the plugin settings page
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 */



		add_menu_page(
			__( 'General Settings','photo-contest' ),
			__( 'Photo Contest','photo-contest' ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' ),
		   'dashicons-camera'
		);
    add_submenu_page($this->plugin_slug, __( 'General Settings','photo-contest' ), __( 'General Settings','photo-contest' ), 'manage_options', $this->plugin_slug);
    add_submenu_page(
      $this->plugin_slug,
      __( 'Contests', 'photo-contest' ),
      __( 'Contests', 'photo-contest' ),
      'manage_options',
      $this->plugin_slug.'-contests',
      array( $this, 'display_plugin_contest_contests_page' )
    );
    add_submenu_page(
      $this->plugin_slug,
      __( 'Photos', 'photo-contest' ),
      __( 'Photos', 'photo-contest' ),
      'manage_options',
      $this->plugin_slug.'-photos',
      array( $this, 'display_plugin_photos_page' )
    );
	add_submenu_page(
      $this->plugin_slug,
      __( 'Vote Log', 'photo-contest' ),
      __( 'Vote Log', 'photo-contest' ),
      'manage_options',
      $this->plugin_slug.'-votes',
      array( $this, 'display_plugin_contest_votes' )
    );
	add_submenu_page(
      $this->plugin_slug,
      __( 'Categories', 'photo-contest' ),
      __( 'Categories', 'photo-contest' ),
      'manage_options',
      $this->plugin_slug.'-categories',
      array( $this, 'display_plugin_contest_categories_page' )
    );
	add_submenu_page(
      $this->plugin_slug,
      __( 'Juries', 'photo-contest' ),
      __( 'Juries', 'photo-contest' ),
      'manage_options',
      $this->plugin_slug.'-jury',
      array( $this, 'display_plugin_contest_jury_page' )
    );
	add_submenu_page(
      $this->plugin_slug,
      __( 'Tools', 'photo-contest' ),
      __( 'Tools', 'photo-contest' ),
      'manage_options',
      $this->plugin_slug.'-tools',
      array( $this, 'display_plugin_contest_tools' )
    );
    add_submenu_page(
      $this->plugin_slug,
      __( 'Info & Help', 'photo-contest' ),
      __( 'Info & Help', 'photo-contest' ),
      'manage_options',
      $this->plugin_slug.'-info',
      array( $this, 'display_plugin_info_page' )
    );


	}

	/**
	 * Render the overview page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		if (is_admin() and isset($_GET['page']) and $_GET['page']=='photo-contest'){
		 include_once( 'views/admin.php' );
		}
	}
  /**
	 * Render the info page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_contest_contests_page() {
		if (is_admin() and isset($_GET['page']) and $_GET['page']=='photo-contest-contests'){
		include_once( 'views/contests.php' );
		}
	}
  /**
	 * Render the photos page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_photos_page() {
		if (is_admin() and isset($_GET['page']) and $_GET['page']=='photo-contest-photos'){
		include_once( 'views/photos.php' );
		}
	}
	/**
	 * Render the info page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_contest_categories_page() {
		if (is_admin() and isset($_GET['page']) and $_GET['page']=='photo-contest-categories'){
		include_once( 'views/categories.php' );
		}
	}
    /**

	 * Render the conditions page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_info_page() {
		if (is_admin() and isset($_GET['page']) and $_GET['page']=='photo-contest-info'){
		include_once( 'views/info.php' );
		}
	}
	/**

	 * Render the conditions page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_contest_tools() {
		if (is_admin() and isset($_GET['page']) and $_GET['page']=='photo-contest-tools'){
		include_once( 'views/tools.php' );
		}
	}
	/** Render the conditions page for this plugin.
	 *
	 * @since    2.8.0
	 */

	public function display_plugin_contest_votes() {
		if (is_admin() and isset($_GET['page']) and $_GET['page']=='photo-contest-votes'){
		include_once( 'views/votes.php' );
		}
	}
	/**

	 * Render the conditions page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_contest_jury_page() {
		if (is_admin() and isset($_GET['page']) and $_GET['page']=='photo-contest-jury'){
		include_once( 'views/jury.php' );
		}
	}


	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
    //Upravit na správnou url
		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', 'photo-contest' ) . '</a>'
			),
			$links
		);

	}

	/**
	 * NOTE:     Actions are points in the execution of a page or process
	 *           lifecycle that WordPress fires.
	 *
	 *           Actions:    http://codex.wordpress.org/Plugin_API#Actions
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.0.0
	 */
	public function action_method_name() {
		// TODO: Define your action hook callback here
	}

  /**
	 * Headers allready sent fix
	 */
	public function photo_contest_output_buffer() {
    ob_start();
  }

}
function inf_remove_junk() {
    if (!is_admin()) {
          wp_dequeue_style('js_composer_front');
          wp_dequeue_style('js_composer_custom_css');
          wp_dequeue_script('wpb_composer_front_js');
     }

}

add_action( 'wp_enqueue_scripts', 'inf_remove_junk' );
